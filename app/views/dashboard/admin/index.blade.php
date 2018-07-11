@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		All Admin <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">All Admin</a>
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
					<i class="fa fa-globe"></i>Admin Lists
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="admin-list">
				<thead>
				<tr>
					<th>
						 First Name
					</th>
					<th>
						 Last Name
					</th>
					<th>
						 Phone
					</th>
					<th>
						 Email
					</th>
					<th>
						 Address
					</th>
					<th>
						 Action
					</th>
				</tr>
				</thead>
				<tbody>
				@foreach($admins as $admin)
					<tr id='{{$admin->ID}}'>
						<td>{{$admin->firstName}}</td>
						<td>{{$admin->lastName}}</td>
						<td>{{$admin->workPhone}}</td>
						<td>{{$admin->email}}</td>
						<td>{{$admin->address1}}</td>
						<td>
							<a href="{{url(URL::to('/dashboard/admin/'.$admin->ID))}}">Details</a> | 
							{{ Form::open(array('url' => '/dashboard/admin/destroy', 'class' => $admin->ID)) }}
							{{ Form::hidden('ID', $value = $admin->ID, array('required' => 'required', 'class'=>'admin-id' )) }}
							<a class='delete-admin' id='{{$admin->ID}}' href='#'>Delete</a>
							{{ Form::close() }}	
						</td>
					</tr>
				@endforeach	
				</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
@stop