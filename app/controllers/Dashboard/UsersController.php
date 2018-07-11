<?php
namespace App\Controllers\Dashboard;

use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

class UsersController extends BaseDashboardController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function index()
    {
        
    }
    
    public function profile()
    {
        $userId = \Auth::user()->ID;
    	$userDetails = \User::getUserById($userId);
		if(\UserRole::isAdminUser()) {
    		return \View::make('dashboard/admin/profile')->with('user',$userDetails);
    	}
    	return \View::make('dashboard/users/profile')->with('user',$userDetails);
    }
    
    public function updateProfile()
    {
    	if (\Request::ajax())
    	{
    		$input = \Input::all();
    		// process input
    	}  
    	if(\UserRole::isAdminUser()) {
    		$validator = \User::adminValidator($input,true); 
    	} else {
    		$validator = \User::validator($input,true);
    	}	   	
    	if ($validator->fails()) {   	
    		return \Response::json(array(   	
    				'errors' => $validator->getMessageBag()->toArray()   	
    		));
    	}
    	if (\UserRole::isAdminUser()) {
    		$id = \Input::get('ID');
    	} elseif (\UserRole::isCustomer()) {
    		$id = \Auth::user()->ID;
    	}
    	
    	$data = \Input::except('_token', 'id');
    	\User::where('ID', $id)->update($data);
    	
    	return \Response::json(array('success' => true), 200);
    }
    
    public function changePassword()
    {
    	if (\Request::ajax())
    	{
    		$input = \Input::all();
    		// process input
    	}
    	$user = Auth::user();
    	$validator = \User::validator($input,false,true);   	
    	if ($validator->fails()) {   	
    		return \Response::json(array(   	
    				'errors' => $validator->getMessageBag()->toArray()   	
    		));
    	} else {
    		if (!\Hash::check(\Input::get('current_password'), $user->app_password)) {
    			return \Response::json(array('fail' => 'true'));
    		} else {
    			$user->app_password = \Hash::make(\Input::get('password'));
    			$user->password = \Input::get('password');
    			$user->save();
    			return \Response::json(array('success' => 'true'));
    		}
    	}
    	
    }

    public function changeAvatar()
    {
        $input = \Input::all();
        $validator = \Validator::make($input, array('avatar' =>  'required|image'));
        if ($validator->fails()) {
            return \Redirect::back();
        }
    	if (\UserRole::isAdminUser()) {
    		$userId = \Input::get('ID');
    	} elseif (\UserRole::isCustomer()) {
    		$userId = \Auth::getUser()->ID;
    	}
        $destinationPath = 'uploads/avatar/';
        $extension = \Input::file('avatar')->getClientOriginalExtension();
        $filename = 'user_' . $userId . '.' . $extension;
        $uploadSuccess = \Input::file('avatar')->move($destinationPath, $filename);
        if ($uploadSuccess)  {
            $thumbnailImage = ImageManagerStatic::make($destinationPath . $filename);
            $thumbnailImage->resize(200, 150);

            $smallImage = ImageManagerStatic::make($destinationPath . $filename);
            $smallImage->resize(29, 29);

            $thumbnailImage->save($destinationPath. 'user_thumbnail_' . $userId . '.jpg');
            $smallImage->save($destinationPath. 'user_small_' . $userId . '.jpg');
            unlink($destinationPath . $filename); //remove
            \User::where('ID', $userId)->update(array('has_photo' => 'Y'));

            return \Redirect::back()->with(array('notificationMessage' => 'Avatar uploaded successfully', 'notificationType' => 'success'));
        }

    }
        
    public function createAdmin()
    {
    	if(\UserRole::isAdminUser()) {
    		return \View::make("dashboard/admin/create",array(
    			'notificationMessage' => \Session::get('notificationMessage'),
    			'notificationType'    => \Session::get('notificationType')
    	));
    	}
    	$this->returnError('You don\'t have permission'); 
    }
    
    public function storeAdmin()
    {
    	
    	$input = \Input::all();
    	if($input['add-admin-user']=='true') {
	    	if(!\UserRole::isAdminUser()) {
	    		$this->returnError('You don\'t have permission');    	
	    	}
	    	$validator = \User::adminValidator($input);
    	}       	
        if ($validator->fails()) {
            return \Redirect::to('/dashboard/add-admin')->withInput($input)->withErrors($validator);
        }
    	$data = \Input::except('_token','address','password_confirmation','add-admin-user'); 
    	$address = \Input::only('address');
    	$data['address1'] = $address['address'];
    	$data['app_password'] = \Hash::make($data['password']);
    	$data['users_role'] = \UserRole::ADMIN_ROLE_ID;
        \User::addAdmin($data);
        return \Redirect::to('/dashboard/add-admin')->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));
    }
    
    public function getAllAdmins()
    {
    	if(!\UserRole::isAdminUser()) {
	    	$this->returnError('You don\'t have permission');    	
	    }
	    $admins = \User::getAllAdmins();
	    return \View::make('/dashboard/admin/index')->with('admins', $admins);
    }
    
    public function adminProfile($userId)
    {
    	if(!\UserRole::isAdminUser()) {
	    	$this->returnError('You don\'t have permission');    	
	    }
	    $userDetails = \User::getUserById($userId);
	    return \View::make('dashboard/admin/profile')->with('user',$userDetails);
    }
        
    public function changeAdminPassword($id)
    {
    	$this->requirePermission('edit-admins');
    	if (\Request::ajax())
    	{
    		$input = \Input::all();
    		// process input
    	}
    	$user = \User::getUserById($id);
    	if(\UserRole::isCustomer($user->users_role)) {
    		$validator = \User::customerPasswordValidatorForAdmin($input,false,true);
    	} else {
    		$validator = \User::validator($input,false,true);
    	}   	
    	if ($validator->fails()) {   	
    		return \Response::json(array(   	
    				'errors' => $validator->getMessageBag()->toArray()   	
    		));
    	} else {
    		if(\UserRole::isCustomer($user->users_role)) {
    			$user->app_password = \Hash::make(\Input::get('password'));
    			$user->password = \Input::get('password');
    			$user->save();
    			return \Response::json(array('success' => 'true'));
    		} else {
    			if (!\Hash::check(\Input::get('current_password'), $user->app_password)) {
    				return \Response::json(array('fail' => 'true'));
    			} else {
    				$user->app_password = \Hash::make(\Input::get('password'));
    				$user->password = \Input::get('password');
    				$user->save();
    				return \Response::json(array('success' => 'true'));
    			}
    		}	
    	}
    }
    
    /**
     * Remove the specified resource from storage.
     * 
     * @return Response
     */
	public function destroy()
	{
		if(!\UserRole::isAdminUser()) {
	    	$this->returnError('You don\'t have permission');    	
	    }
		if (\Request::ajax())
		{
			$id = \Input::get('ID');
			// process input
		}
		$user = \User::find($id);
		$user->delete();
	}
	
	public function getAllCustomers()
    {
    	$this->requirePermission('edit-admins');
	    $customers = \User::getAllCustomers();
	    return \View::make('/dashboard/customers/index')->with('customers', $customers);
    }
    
    public function getCustomer($userId)
    {
    	$this->requirePermission('edit-admins');
    	$userDetails = \User::getUserById($userId);
    	return \View::make('dashboard/users/profile')->with('user',$userDetails);
    }
}
