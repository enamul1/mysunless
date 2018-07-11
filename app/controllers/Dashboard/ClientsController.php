<?php
namespace App\Controllers\Dashboard;

use Doctrine\DBAL\Driver\PDOIbm\Driver;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManagerStatic;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Session\Session;

class ClientsController extends BaseDashboardController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function index()
    {
        
    }
    
    public function createClient()
    {
    	$this->requirePermission('edit-clients');
    	$countries = \Client::countryList();
    	return \View::make("dashboard/clients/create",array(
    			'notificationMessage' => \Session::get('notificationMessage'),
    			'notificationType'    => \Session::get('notificationType')
    	))->with('countries',$countries);
    }
	
    public function storeClient()
    {
    	$this->requirePermission('edit-clients');
    	$input = \Input::all();
        $validator = \Client::validator($input);
        $input = \Input::except('photo','profile_photo');
        
        if ($validator->fails()) {
            return \Redirect::to('/dashboard/add-client')->withInput($input)->withErrors($validator);
        }
              
        $input = \Input::except('photo','profile_photo','_token');
        $previousId = \DB::table('clients')->max('id');
        $currentId = $previousId+1;
        $destinationPath = 'uploads/clients/';
        if (\Input::hasFile('photo')) {       	
            $extension = \Input::file('photo')->getClientOriginalExtension();
            $filename = 'cover_photo_' . $currentId . '.' . $extension;
            $uploadSuccess = \Input::file('photo')->move($destinationPath, $filename);
            if ($uploadSuccess){
            	$input['cover_photo'] = $destinationPath.$filename;
            	self::cropCoverPhoto($destinationPath, $filename);
            }
        }
        if (\Input::hasFile('profile_photo')) {
            $extension = \Input::file('profile_photo')->getClientOriginalExtension();
            $filename = 'user_' . $currentId . '.' . $extension;
            $uploadSuccess = \Input::file('profile_photo')->move($destinationPath, $filename);
            if ($uploadSuccess)  {
                self::cropImage($destinationPath, $filename, $currentId);
            }
        	$input['profile_photo'] = $destinationPath.$filename;
        }
        $input['customer_id'] = Auth::user()->ID;
        \Client::add($input);
        return \Redirect::to('/dashboard/add-client')->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));
    	
    }
    
    public function getAllClients()
    {
    	$this->requirePermission('edit-clients');
    	if(\UserRole::isAdminUser()) {
    		$clients = \Client::getAllClient();
    		return \View::make('/dashboard/clients/index')->with('clients', $clients);
    	}
    	$customerID = Auth::user()->ID;
    	$clients = \Client::getClientsByCustomerID($customerID);
    	return \View::make('/dashboard/clients/index')->with('clients', $clients);
    }
    
    public function getClientDetail($id)
    {
    	$this->requirePermission('edit-clients');   	
    	if(\UserRole::isCustomer()) {
    		$customerID = Auth::user()->ID;
    		if(!\Client::isAClientOfThisCustomer($customerID, $id)) {
    			$this->returnError('You don\'t have permission');
    		}
    	}
    	$client = \Client::getClientByID($id);
    	$files = \ClientsFiles::getAllFilesByClientId($id);
    	$eventHistory = \Schedule::getClientEventHistoryByClientId($id);
    	$countries = \Client::countryList();
    	return \View::make('dashboard/clients/profile',array(
    			'notificationMessage' => \Session::get('notificationMessage'),
    			'notificationType'    => \Session::get('notificationType')
    	))->with('client',$client)->with('files', $files)->with('eventHistory', $eventHistory)->with('countries', $countries);
    }
    
    public function updateClient($id)
    {
    	$this->requirePermission('edit-clients');
    	if(\UserRole::isCustomer()) {
    		$customerID = Auth::user()->ID;
    		if(!\Client::isAClientOfThisCustomer($customerID, $id)) {
    			$this->returnError('You don\'t have permission');
    		}
    	}
    	if (\Request::ajax())
    	{
    		$input = \Input::all();
    		// process input
    	}
    	$validator = \Client::validator($input,true);
    	if ($validator->fails()) {
    		return \Response::json(array(
    				'errors' => $validator->getMessageBag()->toArray()
    		));
    	}
    	$id = \Input::get('id');
    	$data = \Input::except('_token', 'id');
    	\Client::where('id', $id)->update($data);
    	 
    	return \Response::json(array('success' => true), 200);
    }
    
    public function updateClientNote($id)
    {
    	$this->requirePermission('edit-clients');
    	if(\UserRole::isCustomer()) {
    		$customerID = Auth::user()->ID;
    		if(!\Client::isAClientOfThisCustomer($customerID, $id)) {
    			$this->returnError('You don\'t have permission');
    		}
    	}
    	if (\Request::ajax())
    	{
    		$input = \Input::all();
    		// process input
    	}
    	$id = \Input::get('id');
    	$data = \Input::except('_token', 'id');
    	\Client::where('id', $id)->update($data);
    	
    	return \Response::json(array('success' => true), 200);
    }

    public function updateClientPhoto()
    {
        $input = \Input::all();
        $validator = \Validator::make($input, array('avatar' =>  'image'));
        $coverPhotoValidator = \Validator::make($input, array('cover_photo' =>  'image'));
        if ($validator->fails()) {
            return \Redirect::back();
        }

        $clientId = \Input::get('clientId');
        $destinationPath = 'uploads/clients/';
        if (\Input::hasFile('avatar')) {
			$extension = \Input::file('avatar')->getClientOriginalExtension();
	        $filename = 'user_' . $clientId . '.' . $extension;
	        $uploadSuccess = \Input::file('avatar')->move($destinationPath, $filename);
	        if ($uploadSuccess)  {
	            self::cropImage($destinationPath, $filename, $clientId);
	            //return \Redirect::back()->with(array('notificationMessage' => 'Avatar uploaded successfully', 'notificationType' => 'success'));
	        }
        }    
        if (\Input::hasFile('cover_photo')) {
        	$extension = \Input::file('cover_photo')->getClientOriginalExtension();
        	$filename = 'cover_photo_'.$clientId.'.'.$extension;
        	$uploadSuccess = \Input::file('cover_photo')->move($destinationPath, $filename);
	        if ($uploadSuccess)  {
	        	\Client::where('id', $clientId)->update(array('cover_photo' => $destinationPath.$filename));
	            self::cropCoverPhoto($destinationPath, $filename);
	            return \Redirect::back()->with(array('notificationMessage' => 'Avatar uploaded successfully', 'notificationType' => 'success'));
	        }
        }
        return \Redirect::back()->with(array('notificationMessage' => 'No photo uploaded', 'notificationType' => 'fail'));
    }

    private function cropImage($destinationPath, $filename, $clientId)
    {
        $thumbnailImage = ImageManagerStatic::make($destinationPath . $filename);
        $thumbnailImage->resize(200, 150);

        $smallImage = ImageManagerStatic::make($destinationPath . $filename);
        $smallImage->resize(29, 29);

        $thumbnailImage->save($destinationPath. 'user_thumbnail_' . $clientId . '.jpg');
        $smallImage->save($destinationPath. 'user_small_' . $clientId . '.jpg');
        unlink($destinationPath . $filename); //remove
        \Client::where('id', $clientId)->update(array('has_photo' => 'Y'));
    }
    
    private function cropCoverPhoto($destinationPath, $filename)
    {
        $thumbnailImage = ImageManagerStatic::make($destinationPath . $filename);
        $thumbnailImage->resize(300, 250);
        $thumbnailImage->save($destinationPath. $filename);
    }
    
    /*
     * Remove the specified resource from storage.
     * 
     * @return Response
     */
	public function destroy()
	{
		$this->requirePermission('edit-clients');
		if (\Request::ajax())
		{
			$id = \Input::get('id');
			// process input
		}		
		$client = \Client::find($id);
		$client->delete();
		
		\Schedule::where('client_id', $id)->delete();
		
	}
	
	public function storeClientFiles()
	{
		$this->requirePermission('edit-clients');
		$input = \Input::all();
		$validator = \ClientsFiles::validator($input);
		$input = \Input::except('file');
		$id = \Input::get('client_id');
		if ($validator->fails()) {
			return \Redirect::to('/dashboard/client/'.$id.'#files')->withInput($input)->withErrors($validator);
		}
	
		$input = \Input::except('file','_token');
		$customerId = \Auth::user()->ID;
		$destinationPath = 'uploads/'.$customerId.'/'.$id.'/';
		if (\Input::hasFile('file')) {
			$extension = \Input::file('file')->getClientOriginalExtension();
			$filename = $input['title'] . '_'.$customerId .'_'.$input['client_id']. '.' . $extension;
			$uploadSuccess = \Input::file('file')->move($destinationPath, $filename);
	
		}
		$input['customer_id'] = $customerId;
		$input['file'] = $destinationPath.$filename;
		\ClientsFiles::add($input);
		return \Redirect::to('/dashboard/client/'.$id.'#files')->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));
		 
	}
	
	/*
	 * Remove the specified resource from storage.
	*
	* @return Response
	*/
	public function destroyClientFiles()
	{
		$this->requirePermission('edit-clients');
		if (\Request::ajax())
		{
			$id = \Input::get('id');
			// process input
		}
		$client = \ClientsFiles::find($id);
		$client->delete();
		unlink($client->file);
	
	}
}
