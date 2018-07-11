<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- Head BEGIN -->
<head>
    <meta charset="utf-8">
    <title>My Sunless</title>

    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <meta content="Metronic Shop UI description" name="description">
    <meta content="Metronic Shop UI keywords" name="keywords">
    <meta content="keenthemes" name="author">

    <meta property="og:site_name" content="-CUSTOMER VALUE-">
    <meta property="og:title" content="-CUSTOMER VALUE-">
    <meta property="og:description" content="-CUSTOMER VALUE-">
    <meta property="og:type" content="website">
    <meta property="og:image" content="-CUSTOMER VALUE-"><!-- link to image for socio -->
    <meta property="og:url" content="-CUSTOMER VALUE-">

    <link rel="shortcut icon" href="favicon.ico">
    <link href="favicon.ico" rel="SHORTCUT ICON" type="image/ico">
    @include('common.layouts.assets')

</head>
<!-- Head END -->

@include('common.layouts.header')

@yield('slider')

<!-- BEGIN CONTAINER -->
<div class="main">
    <div class="container">
        @yield('content')
    </div>
</div>
<!-- END CONTAINER -->


@include('common.layouts.footer')
