@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		All Business Tools <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">All Business Tools </a>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box blue">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-globe"></i>All Business Tools
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="business-tool-list">
				<thead>
				<tr>
					<th>
						 Name
					</th>
					<th>
						 Type
					</th>
					<th>
						 Description
					</th>
					<th>
						 File
					</th>
					@if(UserRole::isAdminUser())
					<th>
						 Action
					</th>
					@endif
				</tr>
				</thead>
				<tbody>
				@foreach($businessTools as $businessTool)
					<tr id='{{$businessTool->id}}'>
						<td>{{$businessTool->name}}</td>
						<td>{{BusinessToolsType::getBusinessToolsTypeById($businessTool->business_tool_type_id)}}</td>
						<td>{{$businessTool->description}}</td>

						<td>
                       		<a target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/{{$businessTool->uploaded_file}}">Download</a>
                    	</td>
                    	@if(UserRole::isAdminUser())
						<td>
							<a href="{{url(URL::to('/dashboard/business/tool/edit/'.$businessTool->id))}}">Edit </a> |
							{{ Form::open(array('url' => '/dashboard/business/tool/destroy', 'class' => $businessTool->id)) }}
							{{ Form::hidden('id', $value = $businessTool->id, array('required' => 'required', 'class'=>'faq-id' )) }}
							<a class='delete-business-tool' id='{{$businessTool->id}}' href='#'>Delete</a>
							{{ Form::close() }}						
						</td>
						@endif
					</tr>
				@endforeach	
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop