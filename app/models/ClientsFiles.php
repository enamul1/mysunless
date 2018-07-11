<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class ClientsFiles extends BaseModel {

    protected $table = 'clients_files';

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
    				'title' =>  'required',
    				'file' =>  'required'
    		);
    	return Validator::make($input, $rules);
    }
    
    /**
     * add a faq
     *
     * @param array $data
     * @return Faq
     */
    public static function add(array $data)
    {
    	return self::create($data);
    }
    
    /*
     * get all files by client id
     * 
     * @param string $id
     * @return array $files
     */
    public static function getAllFilesByClientId($id)
    {
    	$files = self::where('client_id',$id)->get();
    	return $files;
    }   
}
