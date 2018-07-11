<?php
namespace App\Controllers\Dashboard;

use Doctrine\DBAL\Driver\PDOIbm\Driver;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\File\File;

class SettingsController extends BaseDashboardController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function index()
    {
    	$this->requirePermission('edit-admins');
    	$settings = \Setting::getAllSettings();
    	return \View::make('dashboard/settings/index',array(
    			'notificationMessage' => \Session::get('notificationMessage'),
    			'notificationType'    => \Session::get('notificationType')
    			))->with('settings', $settings);        
    }
    
    public function update()
	{
		$this->requirePermission('edit-admins');
		$input = \Input::only('backend_logo');
		$validator = \Validator::make($input, array('backend_logo' =>  'image'));
		if ($validator->fails()) {
			return \Redirect::back();
		}
		$destinationPath = 'assets/dashboard/layout/img';
		if (\Input::hasFile('backend_logo')) {
			$filename = 'backend-logo.png';
			$uploadSuccess = \Input::file('backend_logo')->move($destinationPath, $filename);		
		}
		$data = \Input::except('_token','_method', 'id','backend_logo');
		$settingsValue = array();
		foreach($data as $key => $value ) {
			$id = $key;     	
			$settingsValue['value'] = $value;
			\Setting::where('id', $id)->update($settingsValue);
		}
		$settings = \Setting::getAllSettings();
		return \Redirect::to('/dashboard/settings/')->with('settings', $settings)->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));
	}
}
