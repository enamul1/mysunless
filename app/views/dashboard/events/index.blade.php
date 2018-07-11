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
            {{User::getCompanyByCustomerId()}} Upcoming Events
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{url(URL::to('/dashboard'))}}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">{{User::getCompanyByCustomerId()}} Upcoming Events</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->

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
        <!-- BEGIN Recenet Events List -->
        <div class="portlet box blue-madison calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list"></i>Upcoming Appointments
                </div>
            </div>
            @if(isset($nearestFiveEvents))
                @foreach($nearestFiveEvents as $event)
                    <div class="portlet-body light-grey blog-feed">
                        {{$event['date']}} with {{$event['full_name']}}
                        <a target="_blank" href="https://www.google.com/maps/dir/{{User::getLoggedInUserFullAddress()}}/{{Client::getClientFullAddress($event['client_id'])}}/">Route</a>
                    </div>
                @endforeach
                @if(empty($nearestFiveEvents))
                    <div class="portlet-body light-grey blog-feed">
                        You don't have any upcoming events.
                    </div>
                @endif
            @endif
        </div>
        <!-- END Recenet Events List -->
    </div>
</div>


@stop
