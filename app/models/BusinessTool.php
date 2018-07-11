<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class BusinessTool extends BaseModel {

    protected $table = 'business_tools';

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
    public static function validator(array $input, $update=false )
    {
    	if(!$update) {
    		$rules = array(
    				'name' =>  'required',
    				'description' =>  'required',
    				'upload' =>  'required',
    				'business_tool_type_id' => 'required',
					'thumbnail' =>  'mimes:jpg,jpeg|max:5000',
    		);
    	} else {
    		$rules = array(
    				'name' =>  'required',
    				'description' =>  'required',
					'thumbnail' =>  'mimes:jpg,jpeg|max:5000',
    		);
    	}
    	
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
	 * get all Marketing Materials
	*
	* @return array $marketingMaterials
	*/
	public static function getAllBusinessTools()
	{
		$marketingMaterials = self::get();
		return $marketingMaterials;
	}
	

	/*
	 * get Business Tool by id
	*
	* @param string $id
	* @return array $businessTool
	*/
	public static function getBusinessToolById($id)
	{
		$businessTool= self::where('id',$id)->first();
		return $businessTool;
	}
	
	/**
	 * get all business tools by type
	 *
	 * @param string $type
	 * @return array
	 */
	public static function getlAllBusinessToolsByType($type = 'all')
	{
		if ($type != 'all') {
			return self::where('business_tool_type_id', $type)->get();
		} else {
			return self::all();
		}
	}

	/*
	 * get all Marketing Materials
	*
	* @return array $marketingMaterials
	*/
	public static function getlAllBusinessToolsByTypeWithPagination($type = 'all')
	{
		if ($type != 'all') {
			return self::where('business_tool_type_id', $type)->paginate(1);
		} else {
			return self::paginate(1);
		}
	}
}
