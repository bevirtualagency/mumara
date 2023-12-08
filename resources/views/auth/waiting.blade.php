<!DOCTYPE html>
<html lang="en">
    @php
        $app_settings = getApplicationSettings();
        if(isset($app_settings['return_all_vars_in_hooks']) && $app_settings['return_all_vars_in_hooks']=="on"){
          $vars =get_defined_vars();
        }
        $vars['route'] =request()->route()->getName();
    @endphp
    <!-- begin::Head -->
    <head>
         {!! hook_get_output('HeadTop',$vars) !!}
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <title>{{isset($app_settings['title']) && !empty($app_settings['title']) ? $app_settings['title'] : 'Mumara' }}</title>
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
        <link href="/resources/assets/css/login-v3.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
        <link href="/resources/assets/css/login.css?v={{$local_version}}?v=1" rel="stylesheet" type="text/css" />
        <link href="/themes/default/custom.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
        <!-- Scripts -->
        <script>
            window.Laravel = <?php
                echo json_encode([
                    'csrfToken' => csrf_token(),
                ]);
            ?>
        </script>
        <style>
            .kt-login__logo .h-60px {
                max-height: 60px !important;
                width: auto !important;
            }
        </style>
        {!! hook_get_output('HeadEnd',$vars) !!}
    </head>

    <!-- end::Head -->

    <!-- begin::Body -->
    <body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
        {!! hook_get_output('BodyTop',$vars) !!}
        <?php 
            $thumb = "/public/img/thumb.jpg";
            if(!empty($app_settings["thumb"])) { 
                $thumb = "/storage/branding/" . $app_settings["thumb"];
            }
         ?>
        <!-- begin::Page loader -->
        <div class="kt-page-loader kt-page-loader--logo" data-name="pVOXdaLT">
            <img alt="Logo" src="{{$thumb}}" height="100px">
            <div class="kt-spinner kt-spinner--danger" data-name="XDLEHTMq"></div>
        </div>
        <!-- end::Page Loader -->

        <!-- begin:: Page -->
        <div class="kt-grid kt-grid--ver kt-grid--root" data-name="RKXFcURk">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login" data-name="PkHUMcDW">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(public/img/bg/bg-3.jpg);" data-name="AZvEoLlw">
                    <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper" data-name="oRYAUIXn">
                        <div class="kt-login__container" data-name="tvsDZdxu">
                            <div class="kt-login__logo" data-name="yGqRZzXF">
                                <a href="#">
                                    <?php 
                                    $logo_dark = "/public/img/logo_dark.png";
                                        if(!empty($app_settings["logo_dark"])) { 
                                    $logo_dark = "/storage/branding/" . $app_settings["logo_dark"];
                                        }
                                     ?>
                                    <img src="{{$logo_dark}}" class="h-60px">
                                </a>
                            </div>
                            <div class="kt-login__signin" data-name="kjOkgdMK">
                                <div class="kt-login__head" data-name="CTeSuLJg">
                                    <h3 class="kt-login__title">{{isset($setting['tagline']) && !empty($setting['tagline']) ? $setting['tagline'] : trans('users.login.title') }}</h3>
                                    <p class="text-center">{{trans('users.login.description')}}</p>
                                    <h3 class="text-center kt-login__title">{{trans('users.waiting.message')}}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
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

        <!--begin::Page Scripts -->
        <script src="/themes/default/js/jquery.min.js" type="text/javascript"></script>
        <script src="/themes/default/js/sticky.min.js" type="text/javascript"></script>
        <script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
        <script src="/themes/default/js/init.js" type="text/javascript"></script>
        <script src="/themes/default/js/scripts.bundle.js" type="text/javascript"></script>
        <script src="/themes/default/js/login-general.js" type="text/javascript"></script>
          {!! hook_get_output('Footer',$vars) !!}
        <!--end::Page Scripts -->
         {!! hook_get_output('BodyEnd',$vars) !!}
    </body>
    <!-- end::Body -->
</html>