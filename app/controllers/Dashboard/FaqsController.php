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

class FaqsController extends BaseDashboardController
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
    	return \View::make("dashboard/faqs/create",array(
    			'notificationMessage' => \Session::get('notificationMessage'),
    			'notificationType'    => \Session::get('notificationType')
    	));
    }
    
    public function storeFaq()
    {
    	if(!\UserRole::isAdminUser()) {
	    		$this->returnError('You don\'t have permission');    	
	    }
	    $input = \Input::all();
	    $validator = \Faq::validator($input);   	
        if ($validator->fails()) {
            return \Redirect::to('/dashboard/faqs/create')->withInput($input)->withErrors($validator);
        }
    	$data = \Input::except('_token'); 
        \Faq::add($data);
        return \Redirect::to('/dashboard/faqs/create')->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));
    }
    
    public function getAllFaqs()
    {
    	$this->beforeFilter('auth');
    	if(\UserRole::isAdminUser()) {
    		$faqs = \Faq::getAllFaqs();
    		return \View::make('/dashboard/faqs/index')->with('faqs', $faqs);
    	}else {
    		$faqs = \Faq::getAllFaqsWithPagination();
    		return \View::make('/dashboard/faqs/all')->with('faqs', $faqs);
    	}    	
    }
    
    public function editFaq($id)
    {
    	if(!\UserRole::isAdminUser()) {
	    	$this->returnError('You don\'t have permission');    	
	    }
	    $faq = \Faq::getFaqById($id);
	    return \View::make('dashboard/faqs/edit')->with('faq',$faq);
    }
    
    public function updateFaq($id)
    {
	    $this->requirePermission('edit-admins');
	    if (\Request::ajax())
	    {
	    	$input = \Input::all();
	    	// process input
	    }
	    $validator = \Faq::validator($input);
	    $id = \Input::get('id');
	    $data = \Input::except('_token', 'id');
	    \Faq::where('id', $id)->update($data);   	
	    return \Response::json(array('success' => true), 200);
    	
    }
    
	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy()
	{	
		if (\Request::ajax())
		{
			$id = \Input::get('id');
			// process input
		}		
		$faq = \Faq::find($id);
		$faq->delete();
	}
    
}
