@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Add New FAQ <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Add New FAQ</a>
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
								<i class="fa fa-briefcase"></i>Add new FAQ
							</div>
						</div>
						<div class="portlet-body form">
							@if($notificationMessage)
				                <div class="alert alert-success">
				                    <a class="close" data-dismiss="alert">×</a>
				                    <strong>You have successfully added a new FAQ.</strong>
				                </div>
				            @endif
							<!-- BEGIN FORM-->
							{{ Form::open(array('url' => '/dashboard/faqs/store', 'class' => 'form-horizontal', 'role'=>'form', 'files' => true)) }}
								<div class="form-body">
									<div class="form-group">
										{{ HTML::decode(Form::label('question', 'Question <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('question', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('question') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('answer', 'Answer <span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::textarea('answer', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('answer') }} </div>
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