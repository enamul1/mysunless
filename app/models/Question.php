<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Question extends BaseModel {

    protected $table = 'questions';
    
    /**
     * Soft delete
     *
     * @var bool
     */
    protected $softDelete = true;

    public static $unguarded = true;
    
    /**
     * validate user input
     *
     * @param array $input
     * @return \Illuminate\Validation\Validator
     */
    public static function validator(array $input)
    {
    	$rules = array(
    				'name' =>  'required',
    				'email' =>  'required|email',
    				'question' =>  'required'
    		);
    	return Validator::make($input, $rules);
    }
    
    /**
     * add a question
     *
     * @param array $data
     * @return Question
     */
    public static function add(array $data)
    {
    	$question = self::create($data);
    	$email = $data['email'];
    	$name = ucfirst($data['name']);
    	$mysunlessEmail = Setting::getEmail();
    	if($question instanceof Question ) {
			self::sendEmail($mysunlessEmail, $name, 'Mysunless Question', 'common/contact-us/email', array('question' => $data));
		}
    }
    
    
    
}
