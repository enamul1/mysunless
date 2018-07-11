@extends('dashboard.layouts.default')

@section('content')

@section('pageCSS')
<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/basic/jquery.qtip.min.css"/>
@stop

@section('pageJS')
<script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/qtip2/2.2.0/basic/jquery.qtip.min.js"></script>

@stop

<!-- BEGIN PAGE HEADER-->
<div class="row">
    <span id="customer-id" data-customer-id="{{Auth::user()->ID}}" class="hidden"></span>
    <input type="hidden" value="{{csrf_token()}}" name="_token">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Dashboard 
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{url(URL::to('/dashboard'))}}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Dashboard</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
@if (UserRole::isCustomer())
    <div class="row ">
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet box blue-madison calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-calendar"></i>Calendar
                    </div>
                </div>
                <div class="portlet-body light-grey">
                    <div id="calendar">
                    </div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
        <div class="col-md-6 col-sm-6">
            <!-- BEGIN PORTLET-->
            <div class="portlet box blue-madison calendar">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-comment"></i>My Sunless Blog
                    </div>
                </div>
                <?php
                    $i = 0;
                ?>
				@if(isset($feed))
                @foreach($feed as $item)
                    @if($i>4)
                        <?php break; ?>
                    @endif
                    <div class="portlet-body light-grey blog-feed">
                        <a href="{{$item['link']}}" target="_blank">{{$item['title']}}</a>
                    </div>
                    <?php $i++; ?>
                @endforeach
				@endif
                <div class="portlet-body light-grey blog-feed">
                    <a href="http://www.sjoliespraytan.com/blog/" target="_blank">More Blog Articles Here</a>
                </div>
            </div>
            <!-- END PORTLET-->

            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
                <a href="{{url(URL::to('/dashboard/clients'))}}">
					<div class="dashboard-stat blue-madison my-dashboard-stat">
						<div class="visual">
							<i class="fa fa-list-alt"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php
									$totalClientCount = count(Client::getClientsByCustomerID(Auth::user()->ID))
								?>
								{{$totalClientCount}}
							</div>
							<div class="desc">
								Your Total Clients
							</div>
						</div>

					</div>
				</a>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
				<a href="{{url(URL::to('/dashboard/monthly-goal'))}}">
					<div class="dashboard-stat purple-plum my-dashboard-stat">
						<div class="visual">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php

									$totalCurrentMonthIncomeArr = Schedule::getTotalMonthlyIncomeByCustomerId(Auth::user()->ID);
									if(!$totalCurrentMonthIncomeArr[0]->total_income) {
										$totalCurrentMonthIncome = 0;
									} else {
										$totalCurrentMonthIncome = $totalCurrentMonthIncomeArr[0]->total_income;
									}
								 ?>
								 {{$totalCurrentMonthIncome}}$
							</div>
							<div class="desc">
								Total Income<br>
								{{ date("M, Y")}}
							</div>
						</div>

					</div>
				</a>
            </div>
            <div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
				<a href="{{url(URL::to('/events'))}}">
					<div class="dashboard-stat green-haze my-dashboard-stat">
						<div class="visual">
							<i class="fa fa-shopping-cart"></i>
						</div>
						<div class="details">
							<div class="number">
								<?php
									$totalCurrentMonthEventArr = Schedule::getMonthlyEventsCountByCustomerId(Auth::user()->ID);
									if(!$totalCurrentMonthEventArr[0]->total_event) {
										$totalCurrentMonthEvent = 0;
									} else {
										$totalCurrentMonthEvent = $totalCurrentMonthEventArr[0]->total_event;
									}
								?>
								{{$totalCurrentMonthEvent}}
							</div>
							<div class="desc">
								Number of Event
								<br>
								{{ date("M, Y")}}
							</div>
						</div>

					</div>
				</a>
            </div>
        </div>
    </div>
@endif


@stop