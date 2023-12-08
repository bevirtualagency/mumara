<!DOCTYPE html>
<html lang="en">
<?php 
$app_setting = getApplicationSettings();
?>

<!-- begin::Head -->
<head>
    <meta charset="utf-8" />
    <title>{{isset($app_setting['title']) && !empty($app_setting['title']) ? $app_setting['title'] : 'Application' }} | {{trans('notifications.errors_404_blade.not_found_title')}}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!--begin::Page Custom Styles(used by this page) -->
    <link href="/themes/default/css/pr-fonts.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
    <link href="/themes/default/default.css?v={{$local_version}}.22" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/resources/assets/css/base-404.css?v={{$local_version}}">
    <?php 
    $favicon = "public/img/favicon.ico";
        if(!empty($app_setting["favicon"])) { 
    $favicon = "storage/branding/" . $app_setting["favicon"];
        }
    ?>
    <link rel="shortcut icon" href="{{$favicon}}" />

    <!--end::Layout Skins -->
    <link rel="shortcut icon" href="../public/img/favicon.ico" />
    <style type="text/css">
        h1 {
            font-size: 8rem !important;
            -webkit-text-stroke-width: 0.15rem !important;
        }
    </style>
</head>

<!-- end::Head -->

<!-- begin::Body -->
<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root" data-name="ORNLTXEk">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v3" style="background-image: url(/public/img/bg/bg-3.jpg);" data-name="OajyBOji">
        <div class="kt-error_container" data-name="PjmdixpG">
					<span class="kt-error_number">
						<h1>{{trans('notifications.errors_503_blade.access_denied_heading')}}</h1>
					</span>
            <p class="kt-error_title kt-font-light">
                {{trans('notifications.errors_503_blade.how_you_get_para')}} 
            </p>
            <p class="kt-error_subtitle">
                {{trans('notifications.errors_503_blade.not_find_page_para')}} 
            </p>
            <p class="kt-error_description">
                {{trans('notifications.errors_503_blade.mis_spelling_url_para')}} <br>
                {{trans('notifications.errors_503_blade.page_no_exist_para')}} 
            </p>
        </div>
    </div>
</div>

<!-- end:: Page -->

<!-- begin::Global Config(global config for global JS sciprts) -->
<script>
    var KTAppOptions = {
        "colors": {
            "state": {
                "brand": "#5d78ff",
                "dark": "#282a3c",
                "light": "#ffffff",
                "primary": "#5867dd",
                "success": "#34bfa3",
                "info": "#36a3f7",
                "warning": "#ffb822",
                "danger": "#fd3995"
            },
            "base": {
                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
            }
        }
    };
</script>

<!-- end::Global Config -->

<!--begin:: Global Mandatory Vendors -->
<script src="/themes/default/js/jquery.1.10.2.min.js" type="text/javascript"></script>
<script src="/themes/default/js/waypoints.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.counterup.min.js" type="text/javascript"></script>
<!--end:: Global Mandatory Vendors -->

<!--begin::Global Theme Bundle(used by all pages) -->
<script src="/themes/default/js/jquery.1.10.2.min.js" type="text/javascript"></script>
<script src="/themes/default/js/waypoints.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.counterup.min.js" type="text/javascript"></script>

<!--end::Global App Bundle -->
</body>

<!-- end::Body -->
</html>