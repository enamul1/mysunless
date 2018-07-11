@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Web Site Settings
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Web Site Settings</a>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row profile">
	<div class="col-md-12">
		<!--BEGIN TABS-->
		<div class="tabbable tabbable-custom tabbable-full-width">
			<ul class="nav nav-tabs">			
				<li>
					<a href="#tab_1_3" data-toggle="tab">
					Account </a>
				</li>
			</ul>
			<div class="tab-content">
				<!--tab_1_2-->
				<div class="tab-pane active" id="tab_1_3">
					<div class="row profile-account">
						<div class="col-md-3">
							<ul class="ver-inline-menu tabbable margin-bottom-10">
								<li class="active">
									<a data-toggle="tab" href="#tab_1-1">
									<i class="fa fa-cog"></i> Settings </a>
									<span class="after">
									</span>
								</li>
							</ul>
						</div>
						<div class="col-md-9">
							<div class="tab-content" id="success-message">
								<div id="tab_1-1" class="tab-pane active">
									@if($notificationMessage)
						                <div class="alert alert-success">
						                    <a class="close" data-dismiss="alert">×</a>
						                    <strong>App settings successfully updated.</strong>
						                </div>
					            	@endif
									{{ Form::open(array('url' => '/dashboard/settings/update', 'role'=>'form', 'files' => true)) }}									
									@foreach($settings as $setting)
									<?php
            							$name = $setting->name;
            							$name = str_replace(' ', '_', $name);
            						?>
									
									<div class="form-group">
								    {{ HTML::decode(Form::label($setting->name, $name, array('class' => 'control-label'))) }}
								    
								    {{ Form::text($setting->id, $value = $setting->value, array('required' => 'required', 'class' => 'form-control' )) }}
									</div>
									@endforeach
									<div class="fileinput fileinput-new" data-provides="fileinput">
										{{ HTML::decode(Form::label('backend_logo', 'Back-End Logo', array('class' => 'control-label'))) }}
										</br>
										<div class="fileinput-new thumbnail" style="width: 235px; height: 46px; background-color:black">
											<img src="/assets/dashboard/layout/img/backend-logo.png" alt="logo"/>
										</div>
										<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
										</div>
										<div>
											<span class="btn default btn-file">
											<span class="fileinput-new">
											Select image </span>
											<span class="fileinput-exists">
											Change </span>
											{{Form::file('backend_logo', array('class' => 'avatar'))}}
											</span>
										</div>
									</div>
									<div class="margiv-top-10">
										<button id="edit-settings" class="btn green">
											Save Changes
										</button>
										<a href="{{url(URL::to('/dashboard'))}}"" type="button" class="btn default">Cancel</a>
									</div>
									{{ Form::close() }}
								</div>							
							</div>
						</div>
						<!--end col-md-9-->
					</div>
				</div>
				<!--end tab-pane-->
			</div>
		</div>
		<!--END TABS-->
	</div>
</div>
<!-- END PAGE CONTENT-->
@stop