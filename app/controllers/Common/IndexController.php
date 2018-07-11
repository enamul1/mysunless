<?php
namespace App\Controllers\Common;

class IndexController extends BaseCommonController
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return \View::make('common/index/index');
    }

}
