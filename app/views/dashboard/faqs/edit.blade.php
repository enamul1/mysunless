@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Edit FAQ <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Edit FAQ</a>
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
					FAQ </a>
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
									<i class="fa fa-cog"></i> FAQ info </a>
									<span class="after">
									</span>
								</li>
							</ul>
						</div>
						<div class="col-md-9">
							<div class="tab-content" id="success-message">
								<div id="tab_1-1" class="tab-pane active">
									<div class='success'></div>							
									{{ Form::model($faq, array('url' => array('dashboard/faq/update', $faq->id),'files' => true,'method' => 'POST', 'class' => 'faq-edit', 'role'=>'form')) }}									
									{{ Form::hidden('id', $value = null) }}
									<div class="form-group">
									    {{ HTML::decode(Form::label('question', 'Question:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::text('question', $value = null, array( 'required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="form-group">
									    {{ HTML::decode(Form::label('answer', 'Answer:<span class="require">*</span>', array('class' => 'control-label'))) }}
									    
									    {{ Form::textarea('answer', $value = null, array('required' => 'required', 'class' => 'form-control' )) }}
									</div>
									<div class="margiv-top-10">
										<button id="edit-faq" class="btn green">
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