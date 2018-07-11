<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class Goal extends BaseModel {

    protected $table = 'goals';

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
    				'monthly_goal' =>  'required|numeric',
    				'yearly_goal' =>  'required|numeric'
    		);
    	return Validator::make($input, $rules);
    }
    
    /**
     * add a goal
     *
     * @param array $data
     * @return Goal
     */
    public static function add(array $data)
    {
    	return self::create($data);
    }
      
    /*
     * get monthly goal by customer id
     * 
     * @param string $customerId
     * @retrun string $monthlyGoal
     */
    public static function getMonthlyGoal($customerId)
    {
    	$monthlyGoal = self::where('customer_id', $customerId)->pluck('monthly_goal');
    	return $monthlyGoal;
    }
    
  	/*
     * get yearly goal by customer id
     * 
     * @param string $customerId
     * @retrun string $yearlyGoal
     */
    public static function getYearlyGoal($customerId)
    {
    	$yearlyGoal = self::where('customer_id', $customerId)->pluck('yearly_goal');
    	return $yearlyGoal;
    }
    
    /*
     * get goal by customer id
    *
    * @param string $customerId
    * @retrun Goal
    */
    public static function getGoal($customerId)
    {
    	return self::where('customer_id', $customerId)->first();
    }
    
}
