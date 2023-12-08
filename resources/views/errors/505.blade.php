<?php 
    $app_setting = getApplicationSettings();
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
<!-- end::Body -->
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

    <div class="kt-grid kt-grid--ver kt-grid--root" data-name="leXdxvnj">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v3" style="background-image: url({{ asset('/public/img/bg/bg3.jpg') }});" data-name="Glordrwj">
            <div class="px-10 px-md-30 py-10 py-md-0 d-flex flex-column justify-content-md-center" data-name="ZgzaRKqp">
                <h1 class="error-title text-stroke text-transparent">{{trans('notifications.errors_505_blade.access_denied_title')}}</h1>
                <p class="display-4 font-weight-boldest text-white mb-12">
                    {{trans('notifications.errors_503_blade.how_you_get_para')}} 
                </p>
                <p class="font-size-h1 font-weight-boldest text-dark-75">
                   {{trans('notifications.errors_503_blade.not_find_page_para')}}  
                </p>
                <p class="font-size-h4 line-height-md">
                    {{trans('notifications.errors_503_blade.mis_spelling_url_para')}} <br>
                    {{trans('notifications.errors_503_blade.page_no_exist_para')}} 
                </p>
            </div>
        </div>
    </div>

    <!--end::Base Scripts -->   
</body>
<!-- end::Body -->
</html>