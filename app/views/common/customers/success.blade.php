@extends('common.layouts.default')

@section('content')
    <div class="main">
      <div class="container">
        <ul class="breadcrumb">
            <li><a href="{{url(URL::to('/'))}}">Home</a></li>
            <li class="active">Success</li>
        </ul>
        <div class="row margin-bottom-40">
          <!-- BEGIN CONTENT -->
          <div class="col-md-12">
            <div class="content-page">
              <div class="row">
                <div class="col-md-9 col-sm-9">
                  <h2>You have successfully created an account</h2>
                  <p class='success'>Your username and password has been sent to the associate email address</p>
                  <p class='success'>Please login <span><a class="link" href="{{url(URL::to('/login'))}}">here</a></span> to access you account</p>
                </div>

                <div class="col-md-3 col-sm-3 sidebar2">
                  <h2>Our Contacts</h2>
                  <address>
                    <strong>Loop, Inc.</strong><br>
                    795 Park Ave, Suite 120<br>
                    San Francisco, CA 94107<br>
                    Phone : {{Setting::getPhone()}}
                  </address>
                  <address>
                    <strong>Email</strong><br>
                    <a href="mailto:{{Setting::getEmail()}}">{{Setting::getEmail()}}</a><br>
                  </address>
                  <ul class="social-icons margin-bottom-40">
                    <li><a href="#" data-original-title="facebook" class="facebook"></a></li>
                    <li><a href="#" data-original-title="Goole Plus" class="googleplus"></a></li>
                    <li><a href="#" data-original-title="linkedin" class="linkedin"></a></li>
                    <li><a href="#" data-original-title="rss" class="rss"></a></li>
                  </ul>

                  <h2 class="padding-top-30">About Us</h2>
                  <p>Sediam nonummy nibh euismod tation ullamcorper suscipit</p>
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check"></i> Officia deserunt molliti</li>
                    <li><i class="fa fa-check"></i> Consectetur adipiscing </li>
                    <li><i class="fa fa-check"></i> Deserunt fpicia</li>
                  </ul>        
                </div>
              </div>
            </div>
          </div>
          <!-- END CONTENT -->
        </div>
      </div>
    </div>
@stop