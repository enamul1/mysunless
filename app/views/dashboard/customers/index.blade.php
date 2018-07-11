@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		All Customer <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">All Customer</a>
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
					<i class="fa fa-globe"></i>Customer Lists
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="customer-list">
				<thead>
				<tr>
					<th>
						 First Name
					</th>
					<th>
						 Last Name
					</th>
					<th>
						 Company Name
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
				@foreach($customers as $customer)
					<tr id='{{$customer->ID}}'>
						<td>{{$customer->firstName}}</td>
						<td>{{$customer->lastName}}</td>
						<td>{{$customer->company}}</td>
						<td>{{$customer->workPhone}}</td>
						<td>{{$customer->email}}</td>
						<td>{{$customer->address1}}</td>
						<td>
							<a href="{{url(URL::to('/dashboard/customer/'.$customer->ID))}}">Details</a> | 
							{{ Form::open(array('url' => '/dashboard/admin/destroy', 'class' => $customer->ID)) }}
							{{ Form::hidden('ID', $value = $customer->ID, array('required' => 'required', 'class'=>'admin-id' )) }}
							<a class='delete-customer' id='{{$customer->ID}}' href='#'>Delete</a>
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