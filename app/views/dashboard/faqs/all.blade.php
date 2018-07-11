@extends('dashboard.layouts.default')

@section('content')

<!-- BEGIN PAGE HEADER-->
<div class="row">
	<div class="col-md-12">
		<!-- BEGIN PAGE TITLE & BREADCRUMB-->
		<h3 class="page-title">
		Frequently Asked Question <small></small>
		</h3>
		<ul class="page-breadcrumb breadcrumb">
			<li>
				<i class="fa fa-home"></i>
				<a href="{{url(URL::to('/dashboard'))}}">Home</a>
				<i class="fa fa-angle-right"></i>
			</li>
			<li>
				<a href="#">Frequently Asked Question </a>
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
					<i class="fa fa-globe"></i>All Frequently Asked Question
				</div>
			</div>
			<div class="portlet-body">
				<div class="tab-content" style="padding:0; background: #fff;">
                      <!-- START TAB 1 -->
                      <div class="tab-pane active" id="tab_1">
                         <div class="panel-group" id="accordion1">
                         	@foreach($faqs as $faq)
                            <div class="panel panel-default">
                               <div class="panel-heading">
                                  <h4 class="panel-title">
                                     <a href="{{'#accordion1_'.$faq->id}}" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">
                                     	<span style="font-size: 30px; color:#e74023;">Q</span>  <spna class='faq-question'>&nbsp;{{$faq->question}}</spna>
                                     </a>
                                  </h4>
                               </div>
                               <div class="panel-collapse collapse" id="{{'accordion1_'.$faq->id}}">
                                  <div class="panel-body">
                                     <span style="font-size: 30px; color:#e74023;">A</span> <spna class='faq-answer'> &nbsp;{{$faq->answer}} </span>
                                  </div>
                               </div>
                            </div>
                            @endforeach
                         </div>
                         {{ $faqs->links() }}
                      </div>
                      <!-- END TAB 1 -->          
                    </div>
			</div>
		</div>
	</div>
</div>
@stop