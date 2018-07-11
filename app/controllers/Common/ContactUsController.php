<?php
namespace App\Controllers\Common;

class ContactUsController extends BaseCommonController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return \View::make('common/contact-us/create');
    }
    
    public function process()
    {
        if (\Request::ajax()) {
    	$input = \Input::all();    		
    	$validator = \Question::validator($input);   		 
    	if ($validator->fails()) {
    		return \Response::json(array(
    				'errors' => $validator->getMessageBag()->toArray()
    		));
    	}		 
    	$data = \Input::except('_token'); 
    	\Question::add($data);    	 
    	return \Response::json(array('success' => true), 200);
    	}
    }

}
