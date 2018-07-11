@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Event Settings
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Settings</a>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row profile">
    <div class="col-md-9">
        <div class="tab-content" id="success-message">
            <div id="tab_1-1" class="tab-pane active">
                @if($notificationMessage)
                <div class="alert alert-success">
                    <a class="close" data-dismiss="alert">×</a>
                    <strong>Service settings successfully updated.</strong>
                </div>
                @endif
                {{ Form::model($settings, array('url' => '/dashboard/events/save-settings', 'role'=>'form', 'files' => true)) }}

                <div class="form-group">
                    <div class="col-md-5">
                    {{ HTML::decode(Form::label('default-email-instruction', 'Default Email Instructions:<span class="require">*</span>', array('class' => 'control-label col-md-7'))) }}
                    <br>
                        <p class="help-block col-md-9">This instructions will be set as default email instruction that is sent to client when a new event is created.</p>
                    </div>
                    <div class="col-md-7">
                        {{ Form::textarea('email_instructions', $value = null, array('class' => 'form-control' )) }}
                        <div class='help-block'> {{ $errors->first('email_instructions') }} </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group margin-top-10">
                    <div class="col-md-5">
                        {{ HTML::decode(Form::label('default-cost', 'Default Cost Of Service:<span class="require">*</span>', array('class' => 'control-label col-md-7'))) }}
                        <br>
                        <p class="help-block col-md-9">Defult price of service</p>
                    </div>
                    <div class="col-md-3">
                        {{ Form::text('default_cost', $value = null, array('class' => 'form-control' )) }}
                        <div class='help-block'> {{ $errors->first('default_cost') }} </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="form-group margin-top-10">
                    <div class="col-md-5">
                        {{ HTML::decode(Form::label('reminder', 'Send Reminder To Clients:<span class="require">*</span>', array('class' => 'control-label col-md-7'))) }}
                        <br>
                        <p class="help-block col-md-9">This reminder will be sent as reminder to book another appointment</p>
                    </div>
                    <div class="col-md-3">
                        {{ Form::checkbox('reminder_15', 1, false, array('class' => 'form-control' )) }} Before 15 days
                        <br>
                        {{ Form::checkbox('reminder_30', 1, false, array('class' => 'form-control' )) }} Before 30 days
                        <br>
                        {{ Form::checkbox('reminder_45', 1, false, array('class' => 'form-control' )) }} Before 45 days
                    </div>
                </div>
                <div class="clearfix"></div>
                <br>
                <br>
                <br>
                <div class="form-group">
                    <div class="col-md-5">
                        {{ HTML::decode(Form::label('reminder-message', 'Email Reminder Text:<span class="require">*</span>', array('class' => 'control-label col-md-7'))) }}
                        <br>
                        <p class="help-block col-md-9">This message will be sent as a reminder</p>
                    </div>
                    <div class="col-md-7">
                        {{ Form::textarea('reminder_message', $value = null, array('class' => 'form-control' )) }}
                        <div class='help-block'> {{ $errors->first('reminder_message') }} </div>
                    </div>
                </div>

                <div class="clearfix"></div>
                <div class="margin-top-10 pull-right">
                    <button id="edit-settings" class="btn green">
                        Save Changes
                    </button>
                    <a href="{{url(URL::to('/dashboard'))}}"" type="button" class="btn default">Cancel</a>
                </div>
                <div class="clearfix"></div>
                {{ Form::close() }}
            </div>
        </div>
        <br><br>
        <br><br>
        <br><br>
    </div>
</div>
<!-- END PAGE CONTENT-->
@stop
