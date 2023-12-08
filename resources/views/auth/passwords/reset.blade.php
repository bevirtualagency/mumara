<!DOCTYPE html>
<html lang="en">
   @php
        $app_settings =  getApplicationSettings();
        $vars =get_defined_vars();
        $vars['route'] =request()->route()->getName();
    @endphp
    <!-- begin::Head -->
    <head>
         {!! hook_get_output('HeadTop',$vars) !!}
        <meta charset="utf-8" />
        <title>{{ config('app.name', 'Mumara') }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <meta name="description" content="Login page">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!--begin::Fonts -->
        <link href="/themes/default/css/pr-fonts.css" rel="stylesheet" type="text/css" />
        <!--end::Fonts -->
        
        <?php 
        $favicon = "/public/img/favicon.ico";
            if(!empty($app_settings["favicon"])) { 
        $favicon = "/storage/branding/" . $app_settings["favicon"];
            }
         ?>
        <link rel="shortcut icon" href="{{$favicon}}" />
        <link href="/resources/assets/css/login-v3.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
        <link href="/resources/assets/css/login.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
        <style type="text/css">
            body {
                color: #6c7293;
                font-weight: 400;
                font-size: 13px;
            }
            .invalid-feedback {
                display: none;
                width: 100%;
                margin-top: 0.25rem;
                color: #fd397a;
                font-weight: 500;
                font-size: 12px;
                padding-left: 1.6rem;
            }
            .invalid-feedback, span.help-block strong {
                width: 100%;
                margin-top: 0.25rem;
                color: #fd397a;
                font-weight: 500;
                font-size: 12px;
                padding-left: 5px;
            }
            .kt-spinner.kt-spinner--danger:before {
                border: 2px solid #1cb09a;
                border-right: 2px solid transparent;
            }
            .kt-login__logo a img {
                max-width: 100%;
            }
            button#kt_login_signin_submit {
                min-width: 100px;
            }
            .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-form .form-control.is-invalid + .invalid-feedback {
                padding-left: .3rem;
            }
            .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-form .form-control {
                border: 1px solid #dee2ea;
            }
            .kt-login__actions {
                text-align: center;
            }
            .invalid-feedback {
                padding-left: 4px;
                font-size: 12px;
            }
            .form-group {
                margin-bottom: 20px;
            }
            form.form-horizontal input {
                border: 1px solid #bec4d0;
                outline: 0 none;
                height: 46px;
                padding-left: 1.5rem;
                padding-right: 1.5rem;
                background: rgba(235,237,242,.4);
            }
            .kt-login__logo a img.h-60px {
                max-height: 60px !important;
                width: auto !important;
            }
        </style>
        <style>
            .kt-login__logo .h-60px {
                max-height: 60px !important;
                width: auto !important;
            }
        </style>
        <!-- Scripts -->
        <script>
            window.Laravel = <?php
                echo json_encode([
                    'csrfToken' => csrf_token(),
                ]);
            ?>
        </script>
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
        <div class="kt-page-loader kt-page-loader--logo" data-name="UajuEDoc">
            <img alt="Logo" src="{{$thumb}}" height="100px">
            <div class="kt-spinner kt-spinner--danger" data-name="mpAgblwL"></div>
        </div>
        <!-- end::Page Loader -->

        <!-- begin:: Page -->
        <div class="kt-grid kt-grid--ver kt-grid--root" data-name="KiCiYrqd">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login" data-name="VIAKmEpH">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(/public/img/bg/bg-3.jpg);" data-name="dZXsoFSP">
                    <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper" data-name="YfhuAYHn">
                        <div class="kt-login__container" data-name="MNNhZmbF">
                            <div class="kt-login__logo" data-name="uYEmHenh">
                                <a href="#">
                                    <?php 
                                    $logo_dark = "public/img/logo_dark.png";
                                        if(!empty($app_settings["logo_dark"])) { 
                                    $logo_dark = "storage/branding/" . $app_settings["logo_dark"];
                                        }
                                     ?>
                                    <img src="{{$logo_dark}}" class="h-60px">
                                </a>
                            </div>

                            <div class="kt-login__signin" data-name="pyegprOq">
                                <div class="kt-login__head" data-name="fRBnsgWE">
                                    <h3 class="kt-login__title">{{trans('authentication.email_blade.reset_password_heading')}}</h3>
                                    <p class="text-center">{{trans('authentication.email_blade.valid_email_para')}}</p>
                                </div>

                                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                                    {{ csrf_field() }}

                                    <input type="hidden" name="token" value="{{ $token }}">

                                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" data-name="gLfRgsaO">
                                        <input id="email" type="email" class="form-control" name="email" value="{{ $email or old('email') }}" required autofocus placeholder="E-Mail Address">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}" data-name="oeAqoVxJ">
                                        <input id="password" type="password" class="form-control" name="password" required placeholder="Password">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}" data-name="epgEBTJP">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="kt-login__actions" data-name="jPGxMEhH">
                                        <button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-elevate">{{trans('Reset Password')}}</button>
                                    </div>
                                </form>

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
        <!--end::Page Scripts -->
        <script type="text/javascript">
            var imagePath = "{{ asset('resources/assets/images/') }}";
            $(document).ready(function() {
                $('#kt_login_forgot').click(function() {
                    //$('.alert').hide('');
                });
                /*$('#kt_login_forgot').click(function() {
                    $(".kt-login__signin").hide();
                    $(".kt-login__forgot").show();

                });
                $('#kt_login_forgot_cancel').click(function() {
                    $(".kt-login__signin").show();
                    $(".kt-login__forgot").hide();
                });*/
            });
        </script>
         {!! hook_get_output('Footer',$vars) !!}
        <!--end::Page Scripts -->
         {!! hook_get_output('BodyEnd',$vars) !!}
    </body>

    <!-- end::Body -->
</html>