@extends('common.layouts.default')

@section('content')
	    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url(URL::to('/'))}}">Home</a></li>
            <li><a href="#">Pages</a></li>
            <li class="active">Frequently Asked Questions</li>
        </ul>
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12 col-sm-12">
            <h1>Frequently Asked Questions</h1>
            <div class="content-page">
              <div class="row">
                <div class="col-md-3 col-sm-3">
                  <ul class="tabbable faq-tabbable">
                    <li class="active"><a href="#tab_1" data-toggle="tab">General Questions</a></li>
                  </ul>
                </div>
                <div class="col-md-9 col-sm-9">
                    <div class="tab-content" style="padding:0; background: #fff;">
                      <!-- START TAB 1 -->
                      <div class="tab-pane active" id="tab_1">
                         <div class="panel-group" id="accordion1">
                         	@foreach($faqs as $faq)
                            <div class="panel panel-default">
                               <div class="panel-heading">
                                  <h4 class="panel-title">
                                     <a href="{{'#accordion1_'.$faq->id}}" data-parent="#accordion1" data-toggle="collapse" class="accordion-toggle collapsed">
                                     	{{$faq->question}}
                                     </a>
                                  </h4>
                               </div>
                               <div class="panel-collapse collapse" id="{{'accordion1_'.$faq->id}}">
                                  <div class="panel-body">
                                     {{$faq->answer}}
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
          <!-- END CONTENT -->
        </div>
      </div>
    </div>
@stop
