<?php 
    // $app_setting = getApplicationSettings();
    $app_setting =  \App\applicationSettings::pluck("setting_value", 'setting_name')->toArray();
    $local_version = !empty($app_setting['updated_version']) ? $app_setting['updated_version'] : "";
?>
<!DOCTYPE html>
<html lang="en">
<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>
        {{isset($app_setting['title']) && !empty($app_setting['title']) ? $app_setting['title'] : 'Application' }} | {{trans('notifications.errors_505_blade.access_denied_title')}}
    </title>
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="/themes/default/css/pr-fonts.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/resources/assets/css/access-denied.css?v={{$local_version}}">
    <link rel="stylesheet" type="text/css" href="/resources/assets/css/base-404.css?v={{$local_version}}">
    <?php 
    $favicon = "public/img/favicon.ico";
        if(!empty($app_setting["favicon"])) { 
    $favicon = "storage/branding/" . $app_setting["favicon"];
        }
    ?>
    <link rel="shortcut icon" href="{{$favicon}}" />
</head>
<!-- end::Head -->
<!-- begin::Body -->
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root" data-name="mMYhhxor">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v6" style="background-image: url(/public/img/bg/bg6.jpg);" data-name="RJMkKrKn">
        <div class="kt-error_container" data-name="aJwZDGiv">
            <div class="kt-error_subtitle kt-font-light" data-name="CmHwDtYV">
                <h1 class="oops">{{trans('notifications.errors_404_blade.oops_heading_title')}}...</h1>
                <h1 class="counter">404</h1>
            </div>
            <p class="kt-error_description kt-font-light">
                {{trans('notifications.errors_404_blade.something_wrong_para')}}<br>
               {{trans('notifications.errors_404_blade.we_working_para')}}  <br>
            </p>
                <a href="/" class="btn btn-info">{{trans('notifications.errors_404_blade.go_dashboard_action')}}</a>
        </div>
    </div>
</div>

<!-- end:: Page -->

<script src="/themes/default/js/jquery.1.10.2.min.js" type="text/javascript"></script>
<script src="/themes/default/js/waypoints.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.counterup.min.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {

        setTimeout(function(){
            $(".oops").hide();
            $('.counter').show();

        }, 100);
        setTimeout(function(){
            $('.counter').counterUp({
                delay: 10,
                time: 2500
            });
        }, 1000);

    });
</script>


</body>

<!-- end::Body -->
</html>