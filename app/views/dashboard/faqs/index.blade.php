@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		All FAQs <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">All FAQs</a>
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
					<i class="fa fa-globe"></i>All FAQs
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="faq-list">
				<thead>
				<tr>
					<th>
						 Question
					</th>
					<th>
						 Answer
					</th>
					@if(UserRole::isAdminUser())
					<th>
						 Action
					</th>
					@endif
				</tr>
				</thead>
				<tbody>
				@foreach($faqs as $faq)
					<tr id='{{$faq->id}}'>
						<td>{{$faq->question}}</td>
						<td>{{$faq->answer}}</td>
						@if(UserRole::isAdminUser())
						<td>
							<a href="{{url(URL::to('/dashboard/faq/'.$faq->id))}}">Edit </a> |
							{{ Form::open(array('url' => '/dashboard/faq/destroy', 'class' => $faq->id)) }}
							{{ Form::hidden('id', $value = $faq->id, array('required' => 'required', 'class'=>'faq-id' )) }}
							<a class='delete-faq' id='{{$faq->id}}' href='#'>Delete</a>
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