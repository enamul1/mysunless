<!-- BEGIN PRE-HEADER -->
<div class="pre-header">
    <div class="container">
        <div class="row">
            <!-- BEGIN TOP BAR LEFT PART -->
            <div class="col-md-6 col-sm-6 additional-shop-info">
                <ul class="list-unstyled list-inline">
                    <li><i class="fa fa-phone"></i><span>{{Setting::getPhone()}}</span></li>
                    <li><i class="fa fa-envelope-o"></i><span>{{Setting::getEmail()}}</span></li>
                </ul>
            </div>
            <!-- END TOP BAR LEFT PART -->
            <!-- BEGIN TOP BAR MENU -->
            <div class="col-md-6 col-sm-6 additional-nav">
                <ul class="list-unstyled list-inline pull-right">
                	@if(!Auth::user())
                    <li><a href="{{url('/login')}}">Log In</a></li>             
                    <li><a href="{{url('/signup')}}">Registration</a></li>
                    @endif
                    @if(Auth::user())
                    <li><a href="{{url('/logout')}}">Log Out</a></li>
                     <li><a href="{{url('/dashboard')}}">Dashboard</a></li>
                    @endif
                </ul>
            </div>
            <!-- END TOP BAR MENU -->
        </div>
    </div>
</div>
<!-- END PRE-HEADER -->

<!-- BEGIN HEADER -->
<div class="header">
    <div class="container">
        <a href="{{url(URL::to('/'))}}" class="site-logo"><img alt="My Sunless" src="/assets/common/layout/img/logos/front-end-logo.png"></a>

        <a class="mobi-toggler" href="javascript:void(0);"><i class="fa fa-bars"></i></a>

        <!-- BEGIN NAVIGATION -->
        <div class="header-navigation pull-right font-transform-inherit">
            <ul>
                <li class="home active">
					<a href="{{url(URL::to('/'))}}">Home</a>
                </li>
                <li class="contact-us">
                	<a href="{{url(URL::to('/contact-us'))}}">Contacts</a>
                </li>
                <li><a target="_blank" href="http://www.sjoliespraytan.com">Shop</a></li>
            </ul>
        </div>
        <!-- END NAVIGATION -->
    </div>
</div>
<!-- Header END -->
