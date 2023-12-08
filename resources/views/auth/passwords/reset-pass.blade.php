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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
        <title>{{isset($app_settings['title']) && !empty($app_settings['title']) ? $app_settings['title'] : 'Mumara' }}</title>
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="description" content="Login page">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!--begin::Fonts -->
        <link href="/themes/default/css/pr-fonts.css" rel="stylesheet" type="text/css" />
        <?php 
        $favicon = "/public/img/favicon.ico";
            if(!empty($app_settings["favicon"])) { 
        $favicon = "/storage/branding/" . $app_settings["favicon"];
            }
         ?>
        <!--Favicon -->
        <link rel="shortcut icon" href="{{$favicon}}" />
        <!--end::Fonts -->
        <link href="/resources/assets/css/login-v3.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
        <link href="/resources/assets/css/login.css?v={{$local_version}}?v=1" rel="stylesheet" type="text/css" />
        <link href="/themes/default/custom.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
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
        <div class="kt-page-loader kt-page-loader--logo" data-name="QiHSkcFZ">
            <img alt="Logo" src="{{$thumb}}" height="100px">
            <div class="kt-spinner kt-spinner--danger" data-name="EYQHUvqO"></div>
        </div>
        <!-- end::Page Loader -->

        <!-- begin:: Page -->
        <div class="kt-grid kt-grid--ver kt-grid--root" data-name="dGiZGNys">
            <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login" data-name="rxaiIcyS">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(/public/img/bg/bg-3.jpg);background:#FFF !important" data-name="vlxDyqMz">

                    <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper login-wrap w-lg-50 p-10 order-2 order-lg-1" data-name="xqCcJwRi">
                        <div class="kt-login__container" data-name="bmSpYvWV">
                            <div class="kt-login__logo" data-name="yGqRZzXF">
								<?php
								$logo_dark = "/public/img/logo_dark.png";
								$disclaimerFlag = 1;
									if(!empty($app_settings["logo_dark"])) { 
										$disclaimerFlag = 0; 
										$logo_dark = "/storage/branding/" . $app_settings["logo_dark"];
									?>
								<img src="{{$logo_dark}}" class="h-60px">
								<?php } else { 
										$applicationTitle = isset($app_settings['title']) && !empty($app_settings['title']) ? $app_settings['title'] : 'Application Title'; 	
									?>
										<h1><?php echo $applicationTitle; ?></h1>
								<?php } ?>
							</div>
                            <?php  $title = getSetting("title"); 
                                $title = isset($title) ? $title . " " . trans('users.login.reset_password.title_h1') : trans('users.login.reset_password.title_h1');
                            ?>

                            <div class="kt-login__signin" data-name="VQvvPnNS">
                                <div class="kt-login__head" data-name="YQgKQvnO">
                                    <h3 class="kt-login__title">{{$title}}</h3>
                                    <p class="text-center">{{trans('users.login.reset_password.heading_desc')}}</p>
                                </div>

                                <form class="kt-form" role="form" method="POST" action="{{ url('/reset/password') }}">
                                    {{ csrf_field() }}

                                    @if ($errors->has('email'))
                                    <div class="alert alert-danger" id="msgEmail" data-name="bPHyCWRN">
                                        <button class="close" data-close="alert"></button>
                                        <span>{{ $errors->first('email') }}</span>
                                    </div>
                                    @endif
                                    @if ($errors->has('login_ips'))
                                    <div class="alert alert-danger" id="log" data-name="MoYyvuFy">
                                        <button class="close" data-close="alert"></button>
                                        <span>{{ $errors->first('login_ips') }}</span>
                                    </div>
                                    @endif

                                    @if ($errors->has('password'))
                                    <div class="alert alert-danger" id="msgPassword" data-name="nMqzyFFL">
                                        <button class="close" data-close="alert"></button>
                                        <span>{{ $errors->first('password') }}</span>
                                    </div>
                                    @endif

                                    @if (Session::has('msg'))
                                    <div class="alert alert-success" data-name="eEneDZzN">
                                        {{ Session::get('msg') }}
                                    </div>
                                    @endif

                                    @if (Session::has('alert'))
                                    <div class="alert alert-danger" data-name="amYMrJFP">
                                        {{ Session::get('alert') }}
                                    </div>
                                    @endif

                                    <input type="hidden" name="token" value="{{ $reset->token }}">
                                    <div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}" data-name="zKEBEbAR">
                                        <input id="email" type="email" readonly class="form-control" name="email" value="{{ old('email',$reset->email) }}" required autofocus placeholder="{{trans('users.login.reset_password.email')}}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}" data-name="azKqtEsy">
                                        <input id="password" type="password" class="form-control" name="password" required placeholder="{{trans('users.login.reset_password.title')}}">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="input-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}" data-name="DnpnddEY">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="{{trans('users.login.reset_password.confirm')}}">

                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="kt-login__actions" data-name="VnbCxQip">
                                        <button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-elevate">
                                            <span class="indicator-label">{{trans('users.login.reset_password.heading')}}</span>
											<span class="indicator-progress">
												Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
											</span>
                                        </button>
                                    </div>
                                </form>
                                
                                <!-- END FORGOT PASSWORD FORM -->
                            </div>
                        </div>
                    </div>
                    <?php
						$login_background = "/public/img/bg.png";
						
						if(!empty($app_settings["login_background"])) 
							$login_background = "/storage/branding/" . $app_settings["login_background"];
					?>
                    <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2 w-lg-50 h-sm-150" style="background-image: url(<?php echo $login_background; ?>)">
						<div class="d-flex flex-column flex-center py-15 px-5 px-md-15 w-100 py-20"></div>
					</div>

                </div>
            </div>
        </div>
        <!-- end:: Page -->
        <!-- Scripts -->
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
    </body>
        {!! hook_get_output('Footer',$vars) !!}
        <!--end::Page Scripts -->
         {!! hook_get_output('BodyEnd',$vars) !!}
    <!-- end::Body -->
</html>