<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Faq extends BaseModel {

    protected $table = 'faqs';

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
    				'question' =>  'required',
    				'answer' =>  'required'
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
     * get all faqs
     * 
     * @return array $faqs
     */
    public static function getAllFaqs()
    {
    	$faqs = self::get();
    	return $faqs;
    }
    
	/*
	 * get FAQ details by id
	 * 
	 * @param string $id
	 * @return array Faq
	 */
	public static function getFaqById($id)
	{
		$faq = self::where('id',$id)->first();
		return $faq;
	}
	
	/*
     * get all faqs
     * 
     * @return array $faqs
     */
    public static function getAllFaqsWithPagination()
    {
    	$faqs = self::paginate(10);
    	return $faqs;
    }
    
}
