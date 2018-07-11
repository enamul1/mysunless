<?php

namespace App\Controllers\Dashboard;

class BaseDashboardController extends \BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
	/**
     * show error page if user has no permission
     *
     * @param string $resource
     * @return Boolean
     * @throw Exception
     */
    public function requirePermission($resource)
    {
        if (\UserRole::hasPermission($resource)) {
            return true;
        } else {
            $this->returnError('You don\'t have permission');
        }
    }

}
