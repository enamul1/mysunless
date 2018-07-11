@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Add New Admin <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Add New Admin</a>
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
								<i class="fa fa-briefcase"></i>Add new admin
							</div>
						</div>
						<div class="portlet-body form">
							@if($notificationMessage)
				                <div class="alert alert-success">
				                    <a class="close" data-dismiss="alert">×</a>
				                    <strong>You have successfully added a new Admin.</strong>
				                </div>
				            @endif
							<!-- BEGIN FORM-->
							{{ Form::open(array('url' => '/dashboard/user/store-admin', 'class' => 'form-horizontal', 'role'=>'form', 'files' => true)) }}
								<div class="form-body">
									{{ Form::hidden('add-admin-user', $value = 'true') }}
									<div class="form-group">
										{{ HTML::decode(Form::label('firstName', 'First Name <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('firstName', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('firstName') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('lastName', 'Last Name <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('lastName', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('lastName') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('workPhone', 'Work Phone <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('workPhone', $value = null, array('class' => 'form-control phone', 'placeholder'=>'Please enter a 10 digit phone no.' )) }}
											<div class='help-block'> {{ $errors->first('workPhone') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('email', 'Email <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('email', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('email') }} </div>
										</div>
										
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('address', 'Address <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('address', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('address') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('zip', 'Zip <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('zip', $value = null, array('class' => 'form-control', 'placeholder'=>'Please enter a 5 digit zip.' )) }}
											<div class='help-block'> {{ $errors->first('zip') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('city', 'City <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('city', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('city') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('state', 'State <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('state', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('state') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('password', 'Password <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::password('password', array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('password') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('password_confirmation', 'Confirm Password <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::password('password_confirmation', array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('password_confirmation') }} </div>
										</div>
									</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
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