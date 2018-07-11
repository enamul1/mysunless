<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2>About us</h2>
                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam sit nonummy nibh euismod tincidunt ut laoreet dolore magna aliquarm erat sit volutpat.</p>

                <div class="photo-stream">
                    <h2>Photos Stream</h2>
                    <ul class="list-unstyled">
                        <li><a href="#"><img src="/assets/common/pages/img/people/img5-small.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img1.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/people/img4-large.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img6.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img3.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/people/img2-large.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img2.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img5.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/people/img5-small.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img1.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/people/img4-large.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img6.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img3.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/people/img2-large.jpg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/common/pages/img/works/img2.jpg" alt=""></a></li>
                    </ul>
                </div>
            </div>
            <!-- END BOTTOM ABOUT BLOCK -->

            <!-- BEGIN BOTTOM CONTACTS -->
            <div class="col-md-4 col-sm-6 pre-footer-col">
                <h2>Our Contacts</h2>
                <address class="margin-bottom-40">
                    35, Lorem Lis Street, Park Ave<br>
                    California, US<br>
                    Phone: {{Setting::getPhone()}}<br>
                    Email: <a href="mailto:{{Setting::getEmail()}}">{{Setting::getEmail()}}</a><br>
                    Skype: <a href="skype:metronic">metronic</a>
                </address>
            </div>
            <!-- END BOTTOM CONTACTS -->
        </div>
    </div>
</div>
<!-- END PRE-FOOTER -->

<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN COPYRIGHT -->
            <div class="col-md-6 col-sm-6 padding-top-10">
                2014 &copy; mysunless.com. ALL Rights Reserved.
            </div>
            <!-- END COPYRIGHT -->
            <!-- BEGIN PAYMENTS -->
            <div class="col-md-6 col-sm-6">
                <ul class="social-footer list-unstyled list-inline pull-right">
                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fa fa-skype"></i></a></li>
                    <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                </ul>
            </div>
            <!-- END PAYMENTS -->
        </div>
    </div>
</div>
<!-- END FOOTER -->

<!-- Load javascripts at bottom, this will reduce page load time -->
<!-- BEGIN CORE PLUGINS (REQUIRED FOR ALL PAGES) -->
<!--[if lt IE 9]>
<script src="assets/plugins/respond.min.js"></script>
<![endif]-->
<script src="/assets/global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<script src="/assets/common/layout/scripts/back-to-top.js" type="text/javascript"></script>

<!-- BEGIN PAGE LEVEL JAVASCRIPTS (REQUIRED ONLY FOR CURRENT PAGE) -->
<script src="/assets/global/plugins/fancybox/source/jquery.fancybox.pack.js" type="text/javascript"></script><!-- pop up -->
<script src="/assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min.js" type="text/javascript"></script><!-- slider for products -->

<!-- BEGIN RevolutionSlider -->
<script src="/assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.plugins.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/slider-revolution-slider/rs-plugin/js/jquery.themepunch.revolution.min.js" type="text/javascript"></script>
<script src="/assets/common/pages/scripts/revo-slider-init.js" type="text/javascript"></script>
<!-- END RevolutionSlider -->


<script src="/assets/common/layout/scripts/layout.js" type="text/javascript"></script>
@include('globalAssets')
<script type="text/javascript">
    jQuery(document).ready(function() {
        Layout.init();
        Layout.initOWL();
        RevosliderInit.initRevoSlider();
        Layout.initTwitter();
    });
</script>
<!-- END PAGE LEVEL JAVASCRIPTS -->
