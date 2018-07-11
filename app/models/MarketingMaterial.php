<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class MarketingMaterial extends BaseModel {

    protected $table = 'marketing_materials';

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
    				'upload' =>  'required'
    		);
    	} else {
    		$rules = array(
    				'name' =>  'required',
    				'description' =>  'required',
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
    public static function getAllMarketingMaterials()
    {
    	$marketingMaterials = self::get();
    	return $marketingMaterials;
    }
    
	/*
	 * get Marketing details by id
	 * 
	 * @param string $id
	 * @return array MarketingMaterial
	 */
	public static function getMarketingMaterialById($id)
	{
		$marketingMaterial= self::where('id',$id)->first();
		return $marketingMaterial;
	}

	/*
	 * get all Marketing Materials
	 * 
	 * @return array $marketingMaterials
	 */
	public static function getAllMarketingMaterialsWithPagination()
	{
		$marketingMaterials = self::paginate(10);
    	return $marketingMaterials;
	}
}
