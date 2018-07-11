@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		You are seeing profile of client, <?php echo Client::getClinetNameByClientId($client->id); ?></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Client Profile</a>
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
									<i class="fa fa-cog"></i> Treatment Info </a>
								</li>
								<li>
									<a data-toggle="tab" href="#tab_2-3">
									<i class="fa fa-picture-o"></i> Change Photo </a>
								</li>
								<li>
									<a data-toggle="tab" href="#files">
									<i class="fa fa-picture-o"></i> Files/Documents </a>
								</li>
								<li>
									<a data-toggle="tab" href="#eventHistory">
									<i class="fa fa-picture-o"></i> Schedule History </a>
								</li>
							</ul>
							<img class="cover_photo" src="/{{$client->cover_photo}}" alt=""/>
						</div>
						<div class="col-md-9">
							<div class="tab-content" id="success-message">
								<div id="tab_1-1" class="tab-pane active">
									<div class='success'></div>
									{{ Form::model($client, array('url' => array('/dashboard/client/update-client', $client->id),'files' => true,'method' => 'POST', 'class' => 'profile-edit', 'role'=>'form')) }}									
									{{ Form::hidden('id', $value = null) }}
									<div class="form-group">
									    {{ HTML::decode(Form::label('first_name', 'First Name:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('first_name', $value = null, array('placeholder' => 'ex-Jon', 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('last_name', 'Last Name:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('last_name', $value = null, array('placeholder' => 'ex-Jon', 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('email', 'Email:', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('email', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('phone', 'Phone:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('phone', $value = null, array( 'required' => 'required', 'class' => 'form-control phone' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('address', 'Address:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('address', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
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
										<div class="form-group">
									    {{ HTML::decode(Form::label('country', 'Country<span class="require">*</span>', array('class' => 'control-label'))) }}
									    {{Form::select('country', $countries, Input::old('countries'), array('required' => 'required', 'class' => 'form-control' )) }}
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
									{{ Form::model($client, array('url' => array('/dashboard/client/update-client-note', $client->id),'files' => true,'method' => 'POST', 'class' => 'note-edit', 'role'=>'form')) }}									
									{{ Form::hidden('id', $value = null) }}
								
									<div class="form-group">
									    {{ HTML::decode(Form::label('solution_strength_used', 'Solution Strength:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::textarea('solution_strength_used', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('private_note', 'Private Notes:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::textarea('private_note', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="margiv-top-10">
										<button id="edit-note" class="btn green">
											Save Changes
										</button>
										<a href="{{url(URL::to('/dashboard'))}}"" type="button" class="btn default">Cancel</a>
									</div>
									{{ Form::close() }}
								</div>
                                <div id="tab_2-3" class="tab-pane">
                                    <p>
                                        Best resolution for avatar is 200x150 px
                                    </p>
                                    {{ Form::open(array('url' => '/dashboard/client-avatar', 'role'=>'form', 'class'=>'edit-password', 'files' => true)) }}
                                    {{Form::hidden('clientId', $client->id)}}
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <img src="{{Client::getClientPictureById($client->id)}}" alt=""/>
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
                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 300px; height: 250px;">
                                                <img src="/{{$client->cover_photo}}" alt=""/>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 250px;">
                                            </div>
                                            <div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													Select Cover Photo </span>
													<span class="fileinput-exists">
													Change </span>
													{{Form::file('cover_photo', array('class' => 'avatar'))}}
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
                                <div id="files" class="tab-pane">
                                	
									<div class='success'></div>
									@if($notificationMessage)
						                <div class="alert alert-success">
						                    <a class="close" data-dismiss="alert">×</a>
						                    <strong>You have successfully attached a new file.</strong>
						                </div>
				            		@endif
									<p>
                                        You can upload one file at a time
                                    </p>
									{{ Form::open(array('url' => '/dashboard/client/file-store', 'class' => 'file-upload', 'role'=>'form', 'files' => true)) }}									
									{{ Form::hidden('client_id', $value = $client->id) }}			
									<div class="form-group">
									    {{ HTML::decode(Form::label('title', 'File Title:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('title', $value = null, array('class' => 'form-control fileinput-new' )) }}
									    <div class='help-block'> {{ $errors->first('title') }} </div>
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('file', 'Upload File/Document<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::file('file', $value = null, array('class' => 'form-control' )) }}
										<div class='help-block'> {{ $errors->first('file') }} </div>
									</div>
									<div class="margiv-top-10">
										<button id="edit-note" class="btn green">
											Upload
										</button>
										<a href="{{url(URL::to('/dashboard'))}}"" type="button" class="btn default">Cancel</a>
									</div>
									{{ Form::close() }}<hr/>
									<table class="table table-striped table-bordered table-hover" id="material-list">
										<thead>
											<tr>
												<th>
													 Title
												</th>
												<th>
													 View/Download
												</th>
												<th>
													 Action
												</th>
											</tr>
										</thead>
										<tbody>
										@foreach($files as $file)
											<tr id='{{$file->id}}'>
												<td>{{$file->title}}</td>
												<td>
						                       		<a target="_blank" href="http://<?php echo $_SERVER['SERVER_NAME'];?>/{{$file->file}}">View/Download</a>
						                    	</td>
												<td>
													{{ Form::open(array('url' => '/dashboard/client-file/destroy', 'class' => $file->id)) }}
													{{ Form::hidden('id', $value = $file->id, array('required' => 'required', 'class'=>'faq-id' )) }}
													<a class='delete-client-file' id='{{$file->id}}' href='#'>Delete</a>
													{{ Form::close() }}						
												</td>
											</tr>
										@endforeach	
										</tbody>
									</table>
								</div>
								<div id="eventHistory" class="tab-pane">
                                	<table class="table table-striped table-bordered table-hover" id="schedule-history">
										<thead>
											<tr>
												<th>
													 Date of Event
												</th>
												<th>
													 Cost of Service ($)
												</th>
											</tr>
										</thead>
										<tbody>
										@foreach($eventHistory as $event)
											<tr>
												<td>
													<?php $eventDate = date('F jS, Y',strtotime($event->from_time)); ?>
													{{$eventDate}}</td>
												<td>{{$event->cost}}</td>
											</tr>
										@endforeach	
										</tbody>
									</table>
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
