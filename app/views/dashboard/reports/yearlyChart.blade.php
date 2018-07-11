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
				<a href="#">Yearly Goal Meter</a>
			</li>
		</ul>
		<!-- END PAGE TITLE & BREADCRUMB-->
	</div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
<div class="row">
	<div class="col-md-12">
		<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-bar-chart-o"></i>Yearly Chart
				</div>
			</div>
			<div class="portlet-body">
				<div id="chart_2" class="chart">
				</div>
				<div style="margin: 20px 0 10px 30px">
					<div class="row">
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
							<span class="label label-sm label-success">
							Total Income: </span>
							<h3>${{$yearlyIncome[0]->total_income}}</h3>
						</div>
						<div class="col-md-3 col-sm-3 col-xs-6 text-stat">
							<span class="label label-sm label-info">
							Goal: </span>
							<h3>${{$yearlyGoal}}</h3>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop