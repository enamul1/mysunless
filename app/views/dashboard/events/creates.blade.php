@extends('dashboard.layouts.default')

@section('pageCSS')
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="/assets/global/plugins/clockface/css/clockface.css"/>
<link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
<link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
<link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-colorpicker/css/colorpicker.css"/>
<link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css"/>
<link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-datetimepicker/css/datetimepicker.css"/>
<link rel="stylesheet" type="text/css" href="/assets/global/plugins/typeahead/typeahead.css">
<!-- END PAGE LEVEL STYLES -->
@stop

@section('pageJS')
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/clockface/js/clockface.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script src="/assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script src="/assets/dashboard/pages/scripts/components-pickers.js"></script>
@stop

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
            {{$pageTitle}} <small></small>
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
								<i class="fa fa-briefcase"></i>Event Details
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
							{{ Form::open(array('url' => 'events/create', 'class' => 'form-horizontal', 'role'=>'form', 'files' => true)) }}
                            {{ Form::hidden('client_id', $value = 0, array('required' => 'required', 'class'=>'client-id' )) }}
                            <?php $defaultCost = CustomersSetting::getDefaultCost(); ?>
                            @if(!empty($eventDetails))
                                {{ Form::model($eventDetails, array('method' => 'POST', 'role'=>'form')) }}
                                {{ Form::hidden('id', $value = null) }}
                                <?php $defaultCost = null; ?>
                            @endif
                            <div class="form-body">
									<div class="form-group">
										{{ HTML::decode(Form::label('first_name', 'First Name <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('first_name', $value = null, array('class' => 'form-control' )) }}
                                            <span class="label label-success label-sm select-existing-client">Select Existing Clients</span>
											<div class='help-block'> {{ $errors->first('first_name') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('last_name', 'Last Name <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('last_name', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('last_name') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('phone', 'Phone <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('phone', $value = null, array('class' => 'form-control phone', 'placeholder'=>'Please enter a 10 digit phone no.' )) }}
											<div class='help-block'> {{ $errors->first('phone') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('email', 'Email <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('email', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('email') }} </div>
										</div>
										
									</div>
                                    <div class="form-group">
                                        {{ HTML::decode(Form::label('event_date', 'Time of Event <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
                                        <div class="event_date col-md-4 input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                            {{ Form::text('event_date', $value = null, array('class' => 'form-control event-date-picker', 'readonly' => '' )) }}
                                            <span class="input-group-btn">
												<button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
												</span>
                                            <div class='help-block'> {{ $errors->first('event_date') }} </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {{ HTML::decode(Form::label('event_time', 'Time Range <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
                                        <div class="col-md-4">
                                            <div class="input-group input-large">
                                                {{ Form::text('event_hour_from', $value = null, array('class' => 'form-control form-control timepicker timepicker-no-seconds', 'readonly' => '' )) }}
												<span class="input-group-addon col-offset-6">
												to </span>
                                                {{ Form::text('event_hour_to', $value = null, array('class' => 'form-control form-control timepicker timepicker-no-seconds', 'readonly' => '' )) }}
                                            </div>
                                            <div class='help-block'> {{ $errors->first('event_hour_from') }} </div>
                                            <div class='help-block'> {{ $errors->first('event_hour_to') }} </div>
                                        </div>
                                    </div>
									<div class="form-group">
										{{ HTML::decode(Form::label('address', 'Address <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('address', $value = null, array('class' => 'form-control' )) }}
                                            <div class='help-block'> {{ $errors->first('address') }} </div>
                                        </div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('zip', 'Zip<span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('zip', $value = null, array('class' => 'form-control' )) }}
                                            <div class='help-block'> {{ $errors->first('zip') }} </div>
                                        </div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('city', 'City <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('city', $value = null, array('class' => 'form-control' )) }}
                                            <div class='help-block'> {{ $errors->first('city') }} </div>
                                        </div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('state', 'State <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('state', $value = null, array('class' => 'form-control' )) }}
                                            <div class='help-block'> {{ $errors->first('state') }} </div>
                                        </div>
									</div>
									
									<div class="form-group">
										{{ HTML::decode(Form::label('cost', 'Cost of Service <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('cost', $value = $defaultCost, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('cost') }} </div>
										</div>
									</div>
                                    <div class="form-group">
                                        {{ HTML::decode(Form::label('email_instruction', 'Email Instruction <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
                                        <div class="col-md-4">
                                            {{ Form::textarea('email_instruction', $value = CustomersSetting::getEmailInstructionsText(), array('class' => 'form-control')) }}
                                            <div class='help-block email_instruction'> This Text will be sent to the client as a instruction by email </div>
                                            <div class='help-block'> {{ $errors->first('email_instruction') }} </div>
                                        </div>
                                    </div>
								<div class="form-actions right">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-4 col-md-4">
												<button type="submit" class="btn green" id="add-client"><i class="fa fa-check"></i> Submit</button>
												<a href="{{url(URL::to('/dashboard'))}}"" type="button" class="btn default">Cancel</a>
                                                <br><br>
                                                @if(isset($eventDetails['id']))
                                                    <a href="{{url(URL::to('/event/delete/'. $eventDetails['id']))}}"" type="button" class="btn red pull-right">Delete</a>
                                                @endif
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
