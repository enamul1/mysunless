@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		All Videos <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">All Videos</a>
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
					<i class="fa fa-globe"></i>Videos Lists
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-striped table-bordered table-hover" id="client-list">
				<thead>
				<tr>
					<th>
						 Title
					</th>
					<th>
						 Description
					</th>
					<th>
						 Type
					</th>
					<th>
						 Source
					</th>
					<th>
						 Acrtion
					</th>
				</tr>
				</thead>
				<tbody>
				@foreach($videos as $video)
					<tr id='{{$video->id}}'>
						<td>{{$video->title}}</td>
						<td>{{str_limit($video->description, 20)}}</td>
						<td>{{VideoType::getVideoTypeById($video->video_type_id)}}</td>
						<td>{{$video->source}}</td>
						<td>
							<a href="{{url(URL::to('/dashboard/video/'.$video->id))}}">Details</a> |
							{{ Form::open(array('url' => '/dashboard/video/destroy', 'class' => $video->id)) }}
							{{ Form::hidden('id', $value = $video->id, array('required' => 'required', 'class'=>'video-id' )) }}
							<a class='delete-video' id='{{$video->id}}' href='#'>Delete</a>
							{{ Form::close() }}	
						</td>
						
					</tr>
				@endforeach	
				</tbody>
				</table>
                {{$videos->links()}}
			</div>
		</div>
	</div>
</div>
@stop
