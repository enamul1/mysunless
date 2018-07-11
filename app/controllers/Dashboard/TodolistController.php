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

class TodolistController extends BaseDashboardController
{
	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth');
	}
	
	public function index()
	{	
		$tags = \TodoTag::getTags();
		$tasks = \TodoList::getTasksByCustomerId();
		return \View::make('dashboard/todolist/index')->with('tags', $tags)->with("tasks", $tasks);
	}
	
	public function saveTask()
	{ 
		/* if(\Request::ajax()) {
			$input = \Input::except("_token");
			$validator = \TodoList::validator($input,false,true);
			if ($validator->fails()) {
				return \Response::json(array(
						'errors' => $validator->getMessageBag()->toArray()
				));
			} else {
				\TodoList::add($input);
				return \Response::json(array('success' => 'true'));				
			}
		} */
		$this->requirePermission('edit-clients');
		$input = \Input::all();
		$validator = \TodoList::validator($input);		
		if ($validator->fails()) {
			return \Redirect::to('/dashboard/todo')->withInput($input)->withErrors($validator);
		} else {
			$input = \Input::except("_token");
			\TodoList::add($input);
			return \Redirect::to('/dashboard/todo');
		}
		
	}
	
	public function getTaskById($id)
	{
		$tags = \TodoTag::getTags();
		$tasks = \TodoList::getTasksByCustomerId();
		$todo = \TodoList::getTasksByTaskId($id);
		return \View::make('dashboard/todolist/task')->with('tags', $tags)->with("tasks", $tasks)->with("todo", $todo);
	}
	
	public function updateTask()
	{
		$this->requirePermission('edit-clients');
		$input = \Input::all();
		$id = $input['id'];
		$validator = \TodoList::validator($input);
		if ($validator->fails()) {
			return \Redirect::to("/dashboard/todo/task/$id")->withInput($input)->withErrors($validator);
		} else {
			$input = \Input::except("_token");
			$input['due_date'] = date("Y-m-d", strtotime($input['due_date']));
			\TodoList::where('id', $id)->update($input);
			return \Redirect::to("/dashboard/todo/task/$id");
		} 
	
	}
	
	public function removeTaskById($id)
	{
		if(\Request::ajax()) {
			\TodoList::where('id', $id)->delete();
			return \Response::json(array('success' => true), 200);
		}
				
	}
	
	public function markTaskAsComplete($id)
	{
		if(\Request::ajax()) {
			\TodoList::where('id', $id)->update(array('status'=>2));
			return \Response::json(array('success' => true), 200);
		}
	
	}
}

