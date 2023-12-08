{!! hook_get_output('HeadTop',$vars) !!}
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>{{isset($app_settings['title']) && !empty($app_settings['title']) ? $app_settings['title'] : 'Application' }}</title>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="description" content="Login page">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!--begin::Fonts -->
<link href="/themes/default/css/pr-fonts.css" rel="stylesheet" type="text/css" />
<?php 
$favicon = "public/img/favicon.ico";
    if(!empty($app_settings["favicon"])) { 
$favicon = "storage/branding/" . $app_settings["favicon"];
    }
    ?>
<!--Favicon -->
<link rel="shortcut icon" href="{{$favicon}}" />
<!--end::Fonts -->
<link href="/resources/assets/css/login-v3.default.css?v={{$local_version}}?v=11" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/login.css?v={{$local_version}}?v=11" rel="stylesheet" type="text/css" />
<link href="/themes/default/custom.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<style>
    .kt-login__logo .h-60px {
        max-height: 60px !important;
        width: auto !important;
    }
</style>
<script>
    window.Laravel = <?php
        echo json_encode([
            'csrfToken' => csrf_token(),
        ]);
    ?>
</script>
{!! hook_get_output('HeadEnd',$vars) !!}
@include('includes.common_head')