<!-- Fonts START -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all" rel="stylesheet" type="text/css">
<!-- Fonts END -->

<!-- Global styles START -->
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link href="/assets/global/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
<!-- Global styles END -->
<!-- Page level plugin styles START -->
<link href="/assets/global/plugins/fancybox/source/jquery.fancybox.css" rel="stylesheet">
<link href="/assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.css" rel="stylesheet">
<link href="/assets/global/plugins/slider-revolution-slider/rs-plugin/css/settings.css" rel="stylesheet">
<!-- Page level plugin styles END -->

<!-- Theme styles START -->
<link href="/assets/global/css/components.css" rel="stylesheet">
<link href="/assets/common/layout/css/style.css" rel="stylesheet">
<link href="/assets/common/pages/css/style-revolution-slider.css" rel="stylesheet"><!-- metronic revo slider styles -->
<link href="/assets/common/layout/css/style-responsive.css" rel="stylesheet">
<link href="/assets/common/layout/css/custom.css" rel="stylesheet">
<!-- Theme styles END -->

<?php

//@todo will be moved by creating a helper
//@see http://forums.laravel.io/viewtopic.php?id=8834

if (isset($module) && isset($controller) && isset($action)) {
    $path = strtolower($module . '/' . Str::snake($controller, '-'));

    $cssFile = 'assets/css/' . $path . '.css';
    $jsFile = 'assets/js/' . $path . '.js';
    if (file_exists($cssFile)) {
        echo '<link href=' . URL::asset($cssFile) . ' rel="stylesheet">';
    }
    
    if (file_exists($jsFile)) {
        echo <<<SCRIPT
    <script type="text/javascript">
        jsFile = '/{$jsFile}';
        MySunLessModule = '{$module}';
        MySunLessController = '{$controller}';
        MySunLessAction = '{$action}';
    </script>
SCRIPT;

    }
}
?>

