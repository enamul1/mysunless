@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Add New Client <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Add New Client</a>
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
								<i class="fa fa-briefcase"></i>Add new client
							</div>
						</div>
						<div class="portlet-body form">
							@if($notificationMessage)
				                <div class="alert alert-success">
				                    <a class="close" data-dismiss="alert">×</a>
				                    <strong>You have successfully added a new client.</strong>
				                </div>
				            @endif
							<!-- BEGIN FORM-->
							{{ Form::open(array('url' => 'client/store', 'class' => 'form-horizontal', 'role'=>'form', 'files' => true)) }}
								<div class="form-body">
									<div class="form-group">
										{{ HTML::decode(Form::label('first_name', 'First Name <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('first_name', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('first_name') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('last_name', 'Last Name <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('last_name', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('last_name') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('phone', 'Phone <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('phone', $value = null, array('class' => 'form-control phone', 'placeholder'=>'Please enter a 10 digit phone no.' )) }}
											<div class='help-block'> {{ $errors->first('phone') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('email', 'Email', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('email', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('email') }} </div>
										</div>
										
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('photo', 'Client\'s Photo<span class="require"> (jpg/jpeg)</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::file('photo', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('photo') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('profile_photo', 'Profile Photo<span class="require"> (jpg/jpeg)</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::file('profile_photo', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('profile_photo') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('solution_strength_used', 'Solution Strength', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::textarea('solution_strength_used', $value = null, array('class' => 'form-control' )) }}
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('private_note', 'Private Notes ', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::textarea('private_note', $value = null, array('class' => 'form-control' )) }}
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
											{{ Form::text('zip', $value = null, array('class' => 'form-control' )) }}
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
										{{ HTML::decode(Form::label('country', 'Country', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{Form::select('country', $countries, Input::old('countries'), array('class' => 'form-control' )) }}			
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