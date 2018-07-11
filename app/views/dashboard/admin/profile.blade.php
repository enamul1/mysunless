@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		User Profile <small>welcome, {{$user->firstName}}</small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">User Profile</a>
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
									<i class="fa fa-cog"></i> Personal info </a>
									<span class="after">
									</span>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_2-2">
									<i class="fa fa-picture-o"></i> Change Avatar </a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_3-3">
									<i class="fa fa-lock"></i> Change Password </a>
								</li>
							</ul>
						</div>
						<div class="col-md-9">
							<div class="tab-content" id="success-message">
								<div id="tab_1-1" class="tab-pane active">
									<div class='success'></div>	
									{{ Form::model($user, array('url' => array('customer/store', $user->id),'files' => true,'method' => 'POST', 'class' => 'profile-edit', 'role'=>'form')) }}									
									{{ Form::hidden('ID', $value = null) }}
									<div class="form-group">
									    {{ HTML::decode(Form::label('firstName', 'First Name:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('firstName', $value = null, array('placeholder' => 'ex-Jon', 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('firstName', 'Last Name:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('lastName', $value = null, array('placeholder' => 'ex-Jon', 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('email', 'Email:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('email', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('workPhone', 'Work Phone:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('workPhone', $value = null, array( 'required' => 'required', 'class' => 'form-control phone' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('address1', 'Primary Address:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('address1', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('zip', 'ZIP:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('zip', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('city', 'City:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('city', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('state', 'State:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('state', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="margiv-top-10">
										<button id="edit-profile" class="btn green">
											Save Changes
										</button>
										<a href="{{url(URL::to('/dashboard'))}}"" type="button" class="btn default">Cancel</a>
									</div>
									{{ Form::close() }}
								</div>
								<div id="tab_2-2" class="tab-pane">
									<div class='success'></div>
									<p>
										 Best resolution for avatar is 200x150 px
									</p>
                                    {{ Form::open(array('url' => '/user/change-avatar', 'role'=>'form', 'class'=>'edit-password', 'files' => true)) }}
										<div class="form-group">
											{{ Form::hidden('ID', $value = $user->ID) }}
											<div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
													<img src="{{User::getLoggedInUserPicture('thumbnail',$user->ID)}}" alt=""/>
												</div>
												<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
												</div>
												<div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													Select image </span>
													<span class="fileinput-exists">
													Change </span>
													{{Form::file('avatar', array('class' => 'avatar'))}}
													</span>
													<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
													<a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
													Remove </a>
												</div>
											</div>
											<div class="clearfix margin-top-10">
												<span class="label label-danger">
												NOTE! </span>
												<span>
												Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only </span>
											</div>
										</div>
										<div class="margin-top-10">
                                            {{Form::submit('Submit!', array('class' => 'btn green'))}}
										</div>
									</form>
								</div>
								<div id="tab_3-3" class="tab-pane">
									<div class='success'></div>
									{{ Form::open(array('url' => '/user/change-password', 'role'=>'form', 'class'=>'edit-password')) }}
										{{ Form::hidden('ID', $value = $user->ID) }}
										<div class="form-group">
										    {{ HTML::decode(Form::label('current_password', 'Current Password:<span class="require">*</span>', array('class' => 'control-label'))) }}
										    
										    {{ Form::password('current_password', array( 'required' => 'required', 'class' => 'form-control' )) }}
										</div>
										<div class="form-group">
										    {{ HTML::decode(Form::label('password', 'New Password:<span class="require">*</span>', array('class' => 'control-label'))) }}
										    
										    {{ Form::password('password', array('class' => 'form-control' )) }}
										</div>
										<div class="form-group">
										    {{ HTML::decode(Form::label('password_confirmation', 'Re-type New Password:<span class="require">*</span>', array('class' => 'control-label'))) }}
										    
										    {{ Form::password('password_confirmation', array( 'required' => 'required', 'class' => 'form-control' )) }}
										</div>
										<div class="margin-top-10">
											<button class="btn green" id="change-password">
											Change Password </button>
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