@extends('dashboard.layouts.default')

@section('content')

@section('pageCSS')
<link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
@stop

@section('pageJS')
<script src="/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
@stop



<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <h3 class="page-title">
            Videos - {{$videoType}}<small></small>
        </h3>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="{{url(URL::to('/dashboard'))}}">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Videos - {{$videoType}}</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->

<!-- BEGIN PAGE CONTENT-->
<div class="row">
    <div class="col-md-12">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-globe video-type" data-video-type-id="{{$videoTypeId}}"></i>Videos - {{$videoType}}
                </div>
            </div>
            <div class="portlet-body">
                <div class="row margin-bottom-40">
                    <!-- BEGIN CONTENT -->
                    <div class="col-md-12">
                        <div class="content-page">
                            @foreach($videos as $video)
                            <div class="row video-list-item">
                                <div class="col-md-4 front-carousel">

                                    <img class='watch-videos' id='{{$video->id}}' src="http://img.youtube.com/vi/{{Video::getYoutubeVideoIdFromSource($video->source)}}/mqdefault.jpg" />
                                </div>
                                <div class="col-md-7">
                                    <h2>{{$video->title}}</h2>
                                    <p>{{$video->description}}</p>
                                    <br>
                                    <a href="{{$video->source}}" class="btn btn-primary watch-videos watch-video-{{$video->id}}"> Watch This Video</a>
                                </div>
                            </div>
                            <div class="clearfix visible-xs-block"></div>
                            @endforeach
                        </div>


                    </div>
                    <!-- END CONTENT -->
                </div>
            </div>
        </div>
    </div>
</div>
@stop
