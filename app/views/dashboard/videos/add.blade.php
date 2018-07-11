@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		{{$pageTitle}}<small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">{{$pageTitle}}</a>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="tabbable tabbable-custom boxless tabbable-reversed">
			<div class="tab-content">				
				<div class="tab-pane active" id="tab_5">
					<div class="portlet box blue ">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-briefcase"></i>Video Details
							</div>
						</div>
						<div class="portlet-body form">
							@if($notificationMessage)
				                <div class="alert alert-success">
				                    <a class="close" data-dismiss="alert">×</a>
				                    <strong>{{$notificationMessage}}</strong>
				                </div>
				            @endif
							<!-- BEGIN FORM-->
							{{ Form::open(array('url' => 'dashboard/video/add', 'class' => 'form-horizontal', 'role'=>'form', 'files' => true)) }}
                            @if(isset($video))
                                {{ Form::model($video, array('url' => array('/dashboard/client/update-client', $video->id),'method' => 'POST', 'role'=>'form')) }}
                                {{ Form::hidden('id', $value = null) }}
                            @endif
                            <div class="form-body">
									<div class="form-group">
										{{ HTML::decode(Form::label('title', 'Video Title <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('title', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('title') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('description', 'Description <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('description', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('description') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('source', 'Video Source <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('source', $value = null, array('class' => 'form-control', 'placeholder'=>'https://www.youtube.com/watch?v=fuLfXfSBMP8' )) }}
											<div class='help-block'> {{ $errors->first('source') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('video_type_id', 'Video Type <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
                                            {{ Form::select('video_type_id', $video_types , Input::old('video_type_id'), array('rows' => '3', 'required' => 'required', 'autofocus' => 'autofocus', 'class' => 'form-control')) }}
                                            <div class='help-block'> {{ $errors->first('video_type_id') }} </div>
										</div>
									</div>
								<div class="form-actions right">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-4 col-md-4">
												<button type="submit" class="btn green" id="add-client"><i class="fa fa-check"></i> Submit</button>
												<a href="{{url(URL::to('/dashboard'))}}"" type="button" class="btn default">Cancel</a>
											</div>
										</div>
									</div>
								</div>
							{{ Form::close() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
