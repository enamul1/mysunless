<!-- BEGIN GLOBAL MANDATORY STYLES -->

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL PLUGIN STYLES -->
<link href="/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/fullcalendar/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/jqvmap/jqvmap/jqvmap.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE LEVEL PLUGIN STYLES -->
<!-- BEGIN PAGE STYLES -->
<link href="/assets/dashboard/pages/css/tasks.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css"/>
<link href="/assets/dashboard/pages/css/profile.css" rel="stylesheet" type="text/css"/>
<!-- END PAGE STYLES -->
<!-- BEGIN THEME STYLES -->
<link href="/assets/global/css/components.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/assets/dashboard/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link href="/assets/dashboard/layout/css/themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
<link href="/assets/dashboard/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->

<link href="/assets/global/plugins/data-tables/DT_bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
<link href="/assets/css/dashboard/global.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/bootstrap-datepicker/css/datepicker3.css" rel="stylesheet" type="text/css"/>
@yield('pageCSS')

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

