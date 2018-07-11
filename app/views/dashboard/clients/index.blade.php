@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		My Clients <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">All Clients</a>
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
					<i class="fa fa-globe"></i>Clients Lists
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="client-list">
				<thead>
				<tr>
					<th>
						Photo
					</th>
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
						 Routte
					</th>
					<th>
						 Action
					</th>
				</tr>
				</thead>
				<tbody>
				@foreach($clients as $client)
					<tr id='{{$client->id}}'>
						<td><img alt="" class="img-circle" src="{{Client::getClientPictureById($client->id,'small')}}"/></td>
						<td>{{$client->first_name}}</td>
						<td>{{$client->last_name}}</td>
						<td>{{$client->phone}}</td>
						<td>{{$client->email}}</td>
						<td>{{$client->address}}</td>
						<td><a target="_blank" href="https://www.google.com/maps/dir/{{User::getLoggedInUserFullAddress()}}/{{Client::getClientFullAddress($client->id)}}/">Route</a></td>
						<td>
							<a href="{{url(URL::to('/dashboard/client/'.$client->id))}}">Details</a> | 
							{{ Form::open(array('url' => '/dashboard/client/destroy', 'class' => $client->id)) }}
							{{ Form::hidden('id', $value = $client->id, array('required' => 'required', 'class'=>'client-id' )) }}
							<a class='delete-client' id='{{$client->id}}' href='#'>Delete</a>
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