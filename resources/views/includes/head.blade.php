<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="csrf-token" content="{{ csrf_token() }}">

<?php
    $favicon = "/public/img/favicon.ico";
    if(!empty($app_settings["favicon"])) {
        $favicon = "/storage/branding/" . $app_settings["favicon"];
    }

    $user_branding = Auth::user()->branding;
    if(!empty($user_branding)) { 
        $branding = json_decode($user_branding); 
        if(!empty($branding->favicon_img)) $favicon  = asset($branding->favicon_img); 
    }

?>
<!--end::Layout Skins -->
<link href="{{$favicon}}" rel="shortcut icon" />
<link href="/themes/default/css/pr-fonts.css?v={{$local_version}}.1" rel="stylesheet" type="text/css" />
<link href="/themes/default/default.css?v={{$local_version}}.25" rel="stylesheet" type="text/css" />
@yield('page_styles')
<link href="/themes/default/custom.css" rel="stylesheet" type="text/css" />
<script src="/themes/default/js/jquery.min.js"></script>
@php
// Hook is adding css or other head data
try {
    echo hook_get_output('HeadEnd',$vars);
} catch (\Exception $e) {
    \Log::error($e->getMessage());
}
@endphp
<!-- CSS stack -->
@stack('css')
@include('includes.user-head')
@include('includes.common_head')

<?php $addonStatus = DB::table("addons")->where("name" , "Subscriptions")->orWhere("name" , "Subscriptions")->value("status"); 
if($addonStatus == "active") {  ?>
<link href="/Addons/Subscriptions/Resources/assets/css/main.css" rel="stylesheet" type="text/css">
<?php }?>