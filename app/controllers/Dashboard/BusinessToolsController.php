<?php
namespace App\Controllers\Dashboard;

use Doctrine\DBAL\Driver\PDOIbm\Driver;

class BusinessToolsController extends BaseDashboardController
{
	public function __construct()
	{
		parent::__construct();
		$this->beforeFilter('auth');
	}
	
	public function index()
	{
		if(!\UserRole::isAdminUser()) {
			$this->returnError('You don\'t have permission');
			//exit;
		}
		$businessTools = \BusinessTool::getAllBusinessTools();
		return \View::make('/dashboard/business-tools/index')->with('businessTools', $businessTools);
	}
	
	public function create()
	{
		if(!\UserRole::isAdminUser()) {
			$this->returnError('You don\'t have permission');
			//exit;
		}
		$businessToolType = \BusinessToolsType::lists('name','id');
		return \View::make('dashboard/business-tools/create',array(
				'notificationMessage' => \Session::get('notificationMessage'),
				'notificationType'    => \Session::get('notificationType'),
		))->with('business_tool_type',$businessToolType)->with('pageTitle','Add New Business Tool');
	}
	
	public function store()
	{
		if(!\UserRole::isAdminUser()) {
			$this->returnError('You don\'t have permission');
		}
		$input = \Input::all();
		$validator = \BusinessTool::validator($input);
		if ($validator->fails()) {
			$input = \Input::except('upload', 'thumbnail');
			return \Redirect::to('/dashboard/business/tool/add')->withInput($input)->withErrors($validator);
		}
		if (\Input::hasFile('upload')) {
			$destinationPath = 'uploads/marketing-materials';
			$filename = \Input::file('upload')->getClientOriginalName();
			$filename = Date('m-d-Y H:i:s').'-'.$filename;
			//$upload_success = \Input::file('upload')->move($destinationPath, $filename);
			$input['photo'] = $destinationPath.'/'.$filename;
		}
		if (\Input::hasFile('thumbnail')) {
			$destinationPath = 'uploads/marketing-materials/thumbnails';
			$filename = \Input::file('upload')->getClientOriginalName();
			$filename = Date('m-d-Y H:i:s').'-'.$filename;
			$upload_success = \Input::file('upload')->move($destinationPath, $filename);
			$input['thumbnail'] = $filename;
		}
		$data = \Input::except('_token','upload','thumbnail');
		$data['uploaded_file'] = $input['photo'];
		$data['thumbnail'] = $input['thumbnail'];
		\BusinessTool::add($data);
		return \Redirect::to('/dashboard/business/tool/add')->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));
	}
	
	public function edit($id)
	{
		if(!\UserRole::isAdminUser()) {
			$this->returnError('You don\'t have permission');
		}
		$businessTool = \BusinessTool::getBusinessToolById($id);
		return \View::make("dashboard/business-tools/edit",array(
				'notificationMessage' => \Session::get('notificationMessage'),
				'notificationType'    => \Session::get('notificationType')
		))->with('businessTool', $businessTool);
	}
	
	
	public function update()
	{
		$this->requirePermission('edit-admins');
		$input = \Input::all();
		$validator = \BusinessTool::validator($input,true);
		$id = \Input::get('id');
		$data = \Input::except('_token', 'id','upload', 'thumbnail');
		if (\Input::hasFile('upload')) {
			$destinationPath = 'uploads/marketing-materials';
			$filename = \Input::file('upload')->getClientOriginalName();
			$filename = Date('m-d-Y H:i:s').'-'.$filename;
			$upload_success = \Input::file('upload')->move($destinationPath, $filename);
			$input['photo'] = $destinationPath.'/'.$filename;
			$data['uploaded_file'] = $input['photo'];
		}
		if (\Input::hasFile('thumbnail')) {
			$destinationPath = 'uploads/marketing-materials/thumbnails';
			$filename = \Input::file('thumbnail')->getClientOriginalName();
			$filename = Date('m-d-Y H:i:s').'-'.$filename;
			$upload_success = \Input::file('thumbnail')->move($destinationPath, $filename);
			$input['thumbnail'] = $filename;
			$data['thumbnail'] = $input['thumbnail'];
		}
		 
		\BusinessTool::where('id', $id)->update($data);
		return \Redirect::to('/dashboard/business/tool/add')->with(array('notificationMessage' => 'success', 'notificationType' => 'success'));
	}
	
	/**
	 * show videos to customer
	 *
	 * @param string $type
	 * @return \Illuminate\View\View
	 */
	public function show($type = 'all')
	{
		$this->requirePermission('show-videos');
		$businessTools = \BusinessTool::getlAllBusinessToolsByTypeWithPagination($type);
		$businessToolType = \BusinessToolsType::getBusinessToolsTypeById($type);
		if (empty($videoType)) {
			$videoType = 'All';
		}
		return \View::make('dashboard/business-tools/show')->with('businessTools', $businessTools)->with('businessToolType', $businessToolType)->with('businessToolTypeId', $type);
	}
	
	/**
	 * Remove the specified resource from storage.
	 *
	 * @return Response
	 */
	public function destroy()
	{
		$this->requirePermission('edit-admins');
		if (\Request::ajax())
		{
			$id = \Input::get('id');
			// process input
		}
		$businessTool = \BusinessTool::find($id);
		$businessTool->delete();
	}
}