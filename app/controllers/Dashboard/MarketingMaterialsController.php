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

class MarketingMaterialsController extends BaseDashboardController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function index()
    {
        
    }
    
    public function create()
    {
    	$this->requirePermission('edit-admins');
    	return \View::make("dashboard/marketing-materials/create",array(
    			'notificationMessage' => \Session::get('notificationMessage'),
    			'notificationType'    => \Session::get('notificationType')
    	));
    }
    
    public function store()
    {
    	if(!\UserRole::isAdminUser()) {
	    		$this->returnError('You don\'t have permission');    	
	    }
	    $input = \Input::all();
	    $validator = \MarketingMaterial::validator($input);   	
        if ($validator->fails()) {
        	$input = \Input::except('upload');
            return \Redirect::to('/dashboard/marketing-material/create')->withInput($input)->withErrors($validator);
        }
    	if (\Input::hasFile('upload')) {
    		$destinationPath = 'uploads/marketing-materials';
	        $filename = \Input::file('upload')->getClientOriginalName();
	        $filename = Date('m-d-Y H:i:s').'-'.$filename;
	        $upload_success = \Input::file('upload')->move($destinationPath, $filename);
	        $input['photo'] = $destinationPath.'/'.$filename;
        }
    	$data = \Input::except('_token','upload');
    	$data['uploaded_file'] = $input['photo']; 
        \MarketingMaterial::add($data);
        return \Redirect::to('/dashboard/marketing-material/create')->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));
    }
    
    public function getAllMarketingMaterials()
    {
    	$this->beforeFilter('auth');
    	$marketingMaterials = \MarketingMaterial::getAllMarketingMaterials();
    	return \View::make('/dashboard/marketing-materials/index')->with('marketingMaterials', $marketingMaterials);
    }
    
    public function edit($id)
    {
    	if(!\UserRole::isAdminUser()) {
	    	$this->returnError('You don\'t have permission');    	
	    }
	    $marketingMaterial = \MarketingMaterial::getMarketingMaterialById($id);
	    return \View::make("dashboard/marketing-materials/edit",array(
    			'notificationMessage' => \Session::get('notificationMessage'),
    			'notificationType'    => \Session::get('notificationType')
    	))->with('marketingMaterial', $marketingMaterial);
    }
    
    public function update()
    {
	    $this->requirePermission('edit-admins');	
	    $input = \Input::all();	    	
	    $validator = \MarketingMaterial::validator($input,true);
	    $id = \Input::get('id');
	    $data = \Input::except('_token', 'id','upload');
    	if (\Input::hasFile('upload')) {
    		$destinationPath = 'uploads/marketing-materials';
	        $filename = \Input::file('upload')->getClientOriginalName();
	        $filename = Date('m-d-Y H:i:s').'-'.$filename;
	        $upload_success = \Input::file('upload')->move($destinationPath, $filename);
	        $input['photo'] = $destinationPath.'/'.$filename;
	        $data['uploaded_file'] = $input['photo'];
        }
	    
	    \MarketingMaterial::where('id', $id)->update($data);
	    return \Redirect::to('/dashboard/marketing-material/create')->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));   	  	
    }
    
    /**
     * Remove the specified resource from storage.
     * 
     * @return Response
     */
    public function destroy()
    {
    	$this->requirePermission('edit-admins');
    	if (\Request::ajax())
		{
			$id = \Input::get('id');
			// process input
		}		
		$marketingMaterial = \MarketingMaterial::find($id);
		$marketingMaterial->delete();
    }    
}
