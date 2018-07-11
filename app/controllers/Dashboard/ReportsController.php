<?php
namespace App\Controllers\Dashboard;

use Doctrine\DBAL\Driver\PDOIbm\Driver;
use Illuminate\Pagination\Paginator;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;
use Symfony\Component\HttpFoundation\Session\Session;

class ReportsController extends BaseDashboardController
{

    public function __construct()
    {
        parent::__construct();
        $this->beforeFilter('auth');
    }

    public function index()
    {
        
    }
    
    public function create()
    {
    	$this->requirePermission('edit-clients');
    	$customerId = \Auth::user()->ID;
    	$goal = \Goal::getGoal($customerId);
    	return \View::make("dashboard/reports/create")->with('goal', $goal);
    }
    
    public function store()
    {
    	$this->requirePermission('edit-clients');
    	if (\Request::ajax()) {
    		$input = \Input::all();    		
    		$validator = \Goal::validator($input);   		 
    		if ($validator->fails()) {
    			return \Response::json(array(
    					'errors' => $validator->getMessageBag()->toArray()
    			));
    		}   		 
    		$data = \Input::except('_token'); 
    		$data['customer_id'] = Auth::user()->ID;
    		\Goal::add($data);
    		 
    		return \Response::json(array('success' => true), 200);
    	}        
    }
    
    public function showMonthlyChart()
    {
    	$this->requirePermission('edit-clients');
    	$customerId = \Auth::user()->ID;
    	$monthlyIncome = \Schedule::getTotalMonthlyIncomeByCustomerId($customerId);
    	$monthlyGoal = \Goal::getMonthlyGoal($customerId);
    	return \View::make('/dashboard/reports/monthlyChart')
    						->with('monthlyIncome',$monthlyIncome)
    						->with('monthlyGoal', $monthlyGoal);
    }
    
    public function getMonthlyData()
    {
		$this->requirePermission('edit-clients');
		$monthly_goal = \Schedule::getMonthlyIncomes();
		if(!empty($monthly_goal)) {
			$cost = array();
			for ($i = 0; $i <= 30; $i++) {
				$cost[] = array($i, 0);
			}
			foreach ($monthly_goal as $key => $value) {
				$cost[$value->day] = array($value->day, $value->cost);
			}
			return \Response::json($cost);
		}
    }

    public function showYearlyChart()
    {
		$this->requirePermission('edit-clients');
		$customerId = \Auth::user()->ID;
		$yearlyIncome = \Schedule::getTotalYearlyIncomeByCustomerId($customerId);
		$yearlyGoal = \Goal::getYearlyGoal($customerId);
		return \View::make('/dashboard/reports/yearlyChart')
						->with('yearlyIncome',$yearlyIncome)
						->with('yearlyGoal', $yearlyGoal);
    }
    
    public function getYearlyData()
    {
		$this->requirePermission('edit-clients');
		$yearlyGoal = \Schedule::getYearlyIncomes();
		if(!empty($yearlyGoal)) {
			$cost = array();
			for ($i = 0; $i <= 12; $i++) {
				$cost[] = array($i, 0);
			}
			foreach ($yearlyGoal as $key => $value) {
				$cost[$value->month] = array($value->month, $value->cost);
			}
			return \Response::json($cost);
		}
    }
    
    public function update()
    {
    	$this->requirePermission('edit-clients');
    	if (\Request::ajax()) {
    		$input = \Input::all();
    		$validator = \Goal::validator($input);
    		if ($validator->fails()) {
    			return \Response::json(array(
    					'errors' => $validator->getMessageBag()->toArray()
    			));
    		}
    		$data = \Input::except('_token');
    		$customer_id = Auth::user()->ID;
    		\Goal::where('customer_id', $customer_id)->update($data);
    		 
    		return \Response::json(array('success' => true), 200);
    	}
    }
}
