<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends BaseModel implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Users';
	
	protected $softDelete = true;
	
	public static $unguarded = true;
	
	protected $primaryKey = 'ID';
    
	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->app_password;
	}

	/**
	 * Get the token value for the "remember me" session.
	 *
	 * @return string
	 */
	public function getRememberToken()
	{
		return $this->remember_token;
	}

	/**
	 * Set the token value for the "remember me" session.
	 *
	 * @param  string  $value
	 * @return void
	 */
	public function setRememberToken($value)
	{
		$this->remember_token = $value;
	}

	/**
	 * Get the column name for the "remember me" token.
	 *
	 * @return string
	 */
	public function getRememberTokenName()
	{
		return 'remember_token';
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}
	
	/**
	 * validate user input
	 *
	 * @param array $input
	 * @return \Illuminate\Validation\Validator
	 */
	public static function validator(array $input, $update=false, $changePassword=false)
	{
		if(!$update && !$changePassword) {
			$rules = array(
					'firstName' =>  'required',
					'lastName' =>  'required',
					'email' =>  'required | email|unique:Users',
					'company' => 'required',
					'company_type' => 'required',
					'workPhone' => 'required',
					'address'=>'required',
					'city' => 'required',
					'state' => 'required',
					'zip' => 'required',
					'password'=>'required|between:6,12|confirmed',
					'password_confirmation'=>'required|between:6,12'
			);
		}elseif(!$changePassword) {
			$rules = array(
					'firstName' =>  'required',
					'lastName' =>  'required',
					'email' =>  'required |email',
					'company' => 'required',
					'workPhone' => 'required',
					'address1'=>'required',
					'city' => 'required',
					'state' => 'required',
					'zip' => 'required'
			);
		} else {
			$rules = array(
					'current_password' => 'required|between:6,12',
					'password' => 'required|between:6,12|confirmed',
					'password_confirmation'=>'required|between:6,12'
			);
		}	
		return Validator::make($input, $rules);
	}
	
	/**
	 * validate user input
	 *
	 * @param array $input
	 * @return \Illuminate\Validation\Validator
	 */
	public static function customerPasswordValidatorForAdmin(array $input)
	{
		$rules = array(
				'password' => 'required|between:6,12|confirmed',
				'password_confirmation'=>'required|between:6,12'
		);
		return Validator::make($input, $rules);
	}
	/**
	 * add a custumer
	 *
	 * @param array $data
	 */
	public static function add(array $data)
	{
		$user = self::create($data);
		$email = $data['email'];
		$name = ucfirst($data['firstName']).' '.ucfirst($data['lastName']);
		if($user instanceof User ) {
			self::sendEmail($email, $name, 'Mysunless signup', 'common/customers/email', array('customer' => $data));
		}
	}
	
	/**
	 * get User details by id
	 * 
	 * @param string $id
	 * @return array $user
	 */
	public static function getUserById($id)
	{
		$user = self::where('ID',$id)->first();
		return $user;
	}
	
	/**
	 * add an Admin
	 *
	 * @param array $data
	 */
	public static function addAdmin(array $data)
	{
		$user = self::create($data);
		$email = $data['email'];
		$name = ucfirst($data['firstName']).' '.ucfirst($data['lastName']);
		if($user instanceof User ) {
			self::sendEmail($email, $name, 'Mysunless signup', 'dashboard/admin/email', array('admin' => $data));
		}
	}
	
	/**
	 * validate user input
	 *
	 * @param array $input
	 * @return \Illuminate\Validation\Validator
	 */
	public static function adminValidator(array $input, $update=false, $changePassword=false)
	{
		if(!$update && !$changePassword) {
			$rules = array(
					'firstName' =>  'required',
					'lastName' =>  'required',
					'email' =>  'required | email|unique:Users',
					'workPhone' => 'required',
					'address'=>'required',
					'city' => 'required',
					'state' => 'required',
					'zip' => 'required',
					'password'=>'required|between:6,12|confirmed',
					'password_confirmation'=>'required|between:6,12'
			);
		} elseif(!$changePassword) {
			$rules = array(
					'firstName' =>  'required',
					'lastName' =>  'required',
					'email' =>  'required |email',
					'workPhone' => 'required',
					'address1'=>'required',
					'city' => 'required',
					'state' => 'required',
					'zip' => 'required'
			);
		} else {
			$rules = array(
					'current_password' => 'required|between:6,12',
					'password' => 'required|between:6,12|confirmed',
					'password_confirmation'=>'required|between:6,12'
			);
		}		
		return Validator::make($input, $rules);
	}
	
	/*
	 * get all admins
	 * 
	 * @return array $admins
	 */
	public static function getAllAdmins()
	{
		$admins = self::where('users_role',UserRole::ADMIN_ROLE_ID)->get();
		return $admins;
	}
	
	/*
	 * get all customers
	 * 
	 * @return array $customers
	 */
	public static function getAllCustomers()
	{
		$customers = self::where('users_role',UserRole::CUSTOMER_ROLE_ID)->get();
		return $customers;
	}

    /**
     * get url of user profile pic
     *
     * @param string $type
     * @return string
     */
    public static function getLoggedInUserPicture($type = 'thumbnail',$userId=false)
    {
        if (Auth::getUser()->has_photo == 'N') {
            if ($type == 'small') {
                return '/assets/dashboard/layout/img/Tan-Avatar.jpg';
            } else {
                return 'http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image';
            }

        }
		if(!$userId) {
			$userId = Auth::getUser()->ID;
		}   
        switch ($type) {
            case 'thumbnail' :
                $url = '/uploads/avatar/user_thumbnail_' . $userId . '.jpg';
                break;
            case 'small' :
                $url = '/uploads/avatar/user_small_' . $userId . '.jpg';
                break;
            default :
                $url = '/uploads/avatar/user_thumbnail_' . $userId . '.jpg';
        }
        return $url;

    }
    
    /*
     * get logged in user address
     * 
     * @return string $address
     */
    public static function getLoggedInUserFullAddress()
    {
    	$userId = Auth::getUser()->ID;
    	$user = self::select('address1','zip','city','state')->where('ID', $userId)->first();
    	$address = str_ireplace(" ","+",$user->address1).',+'.$user->zip.',+'.str_ireplace(" ","+",$user->city).',+'.str_ireplace(" ","+",$user->state);
    	return $address;
    }

	/*
	 * get company name by customer id
	 *
	 * @return string $companyName
	 */
	public static function getCompanyByCustomerId()
	{
		$userId = Auth::getUser()->ID;
		$companyName = self::select('company')->where('ID', $userId)->first()->company;
		return $companyName;
	}

	

}
