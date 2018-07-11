@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Add New Marketing Material <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Edit Marketing Material</a>
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
								<i class="fa fa-briefcase"></i>Edit marketing material
							</div>
						</div>
						<div class="portlet-body form">
							@if($notificationMessage)
				                <div class="alert alert-success">
				                    <a class="close" data-dismiss="alert">×</a>
				                    <strong>You have successfully updated the marketing material.</strong>
				                </div>
				            @endif
							<!-- BEGIN FORM-->
							{{ Form::model($marketingMaterial, array('url' => '/dashboard/marketing-material/update', 'class' => 'form-horizontal', 'role'=>'form', 'files' => true)) }}
							{{ Form::hidden('id', $value = null) }}
								<div class="form-body">
									<div class="form-group">
										{{ HTML::decode(Form::label('name', 'Name <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('name', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('name') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('description', 'Description <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('description', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('description') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('link', 'Link', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('link', $value = null, array('class' => 'form-control' )) }}
										</div>			
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('upload', 'Upload', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::file('upload', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('upload') }} </div>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="row">
											<div class="col-md-12">
												<div class="col-md-offset-3 col-md-9">
													<button type="submit" class="btn green" id="add-client"><i class="fa fa-check"></i> Save</button>
													<a href="{{url(URL::to('/dashboard'))}}" type="button" class="btn default">Cancel</a>
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