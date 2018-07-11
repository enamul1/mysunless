@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		All Marketing Materials <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">All Marketing Materials </a>
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
					<i class="fa fa-globe"></i>All Marketing Materials 
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="material-list">
				<thead>
				<tr>
					<th>
						 Name
					</th>
					<th>
						 Description
					</th>
					<th>
						 link
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
				@foreach($marketingMaterials as $marketingMaterial)
					<tr id='{{$marketingMaterial->id}}'>
						<td>{{$marketingMaterial->name}}</td>
						<td>{{$marketingMaterial->description}}</td>
						<td><a href="{{$marketingMaterial->link}}" target="_blank">{{$marketingMaterial->link}}</a></td>
						<td>
                       		<a target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/{{$marketingMaterial->uploaded_file}}">Download</a>
                    	</td>
                    	@if(UserRole::isAdminUser())
						<td>
							<a href="{{url(URL::to('/dashboard/marketing-material/'.$marketingMaterial->id))}}">Edit </a> |
							{{ Form::open(array('url' => '/dashboard/marketing-material/destroy', 'class' => $marketingMaterial->id)) }}
							{{ Form::hidden('id', $value = $marketingMaterial->id, array('required' => 'required', 'class'=>'faq-id' )) }}
							<a class='delete-faq' id='{{$marketingMaterial->id}}' href='#'>Delete</a>
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