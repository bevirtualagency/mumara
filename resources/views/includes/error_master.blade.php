<?php 
    $app_setting = getApplicationSettings();
?>
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

@include('includes.user-head')