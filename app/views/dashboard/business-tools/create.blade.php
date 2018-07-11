@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Add New Business Tool <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Add New Business Tool</a>
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
								<i class="fa fa-briefcase"></i>Add new Business Tool
							</div>
						</div>
						<div class="portlet-body form">
							@if($notificationMessage)
				                <div class="alert alert-success">
				                    <a class="close" data-dismiss="alert">×</a>
				                    <strong>You have successfully added a new Business Tool.</strong>
				                </div>
				            @endif
							<!-- BEGIN FORM-->
							{{ Form::open(array('url' => '/dashboard/business/tool/store', 'class' => 'form-horizontal', 'role'=>'form', 'files' => true)) }}
								<div class="form-body">
									<div class="form-group">
										{{ HTML::decode(Form::label('name', 'Name <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::text('name', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('name') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('business_tool_type_id', 'Business Tool Type <span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
                                            {{ Form::select('business_tool_type_id', $business_tool_type , Input::old('business_tool_type'), array('rows' => '3', 'required' => 'required', 'autofocus' => 'autofocus', 'class' => 'form-control')) }}
                                            <div class='help-block'> {{ $errors->first('business_tool_type') }} </div>
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
										{{ HTML::decode(Form::label('upload', 'Upload<span class="require">*</span>', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::file('upload', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('upload') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('thumbnail', 'Thumbnail', array('class' => 'control-label col-md-4'))) }}
										<div class="col-md-4">
											{{ Form::file('thumbnail', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('thumbnail') }} </div>
										</div>
									</div>
									<div class="form-actions right">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-4 col-md-4">
												<button type="submit" class="btn green" id="add-client"><i class="fa fa-check"></i> Submit</button>
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