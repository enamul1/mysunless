<?php
namespace App\Controllers\Common;

class CustomersController extends BaseCommonController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

    }
    
    public function signup()
    {
    	return \View::make("common/customers/signup");
    }
    
    
    public function store()
    {
    	if (\Request::ajax()) {
    		$input = \Input::all();    		
    		$validator = \User::validator($input);   		 
    		if ($validator->fails()) {
    			return \Response::json(array(
    					'errors' => $validator->getMessageBag()->toArray()
    			));
    		}   		 
    		$data = \Input::except('_token','address','password_confirmation'); 
    		$address = \Input::only('address');
    		$data['address1'] = $address['address'];
    		$data['app_password'] = \Hash::make($data['password']);
    		\User::add($data);	 
    		self::success();
    	}
    	
    }
    
    public function success()
    {
    	return \View::make("common/customers/success");
    }


}
