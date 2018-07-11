@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Setup Goal <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Set up Goal</a>
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
								<i class="fa fa-briefcase"></i>Set a new goal
							</div>
						</div>
						<div class="portlet-body form">
						@if(!is_null($goal))
							{{ Form::model($goal, array('url' => '/dashboard/marketing-material/update', 'class' => 'form-horizontal', 'role'=>'form', 'files' => true)) }}
						@else
							{{ Form::open(array('url' => '/dashboard/goals/store', 'class' => 'form-horizontal', 'role'=>'form',)) }}
						@endif
							<!-- BEGIN FORM-->
							
								<div class="form-body">
									<div class="form-group">
										{{ HTML::decode(Form::label('monthly_goal', 'Monthly Goal ($)<span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('monthly_goal', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('monthly_goal') }} </div>
										</div>
									</div>
									<div class="form-group">
										{{ HTML::decode(Form::label('yearly_goal', 'Yearly Goal ($)<span class="require">*</span>', array('class' => 'control-label col-md-3'))) }}
										<div class="col-md-9">
											{{ Form::text('yearly_goal', $value = null, array('class' => 'form-control' )) }}
											<div class='help-block'> {{ $errors->first('yearly_goal') }} </div>
										</div>
									</div>
								<div class="form-actions fluid">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-offset-3 col-md-9">
												@if(!is_null($goal))
													<button type="submit" class="btn green" id="update-goal"><i class="fa fa-check"></i> Update</button>
												@else 
													<button type="submit" class="btn green" id="add-goal"><i class="fa fa-check"></i> Submit</button>
												@endif
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