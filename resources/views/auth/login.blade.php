<!DOCTYPE html>
<html lang="en">
	@php
		// $app_settings = getApplicationSettings();
		$app_settings =  \App\applicationSettings::pluck("setting_value", 'setting_name')->toArray();
		if(isset($app_settings['return_all_vars_in_hooks']) && $app_settings['return_all_vars_in_hooks']=="on"){
			$vars =get_defined_vars();
		}

		$login_background = "/public/img/bg.png";		
		if(!empty($app_settings["login_background"])) 
			$login_background = "/storage/branding/" . $app_settings["login_background"];

		$favicon = "public/img/favicon.ico";
		if(!empty($app_settings["favicon"])) { 
			$favicon = "storage/branding/" . $app_settings["favicon"];
		}

		$thumb = "/public/img/thumb.jpg";
		if(!empty($app_settings["thumb"])) { 
			$thumb = "/storage/branding/" . $app_settings["thumb"];
		}


		$vars['route'] =request()->route()->getName();
		$recaptcha_version = getSetting("recaptcha_version");
		$logo_dark = "/public/img/logo_dark.png";
		$applicationTitle = isset($app_settings['title']) && !empty($app_settings['title']) ? $app_settings['title'] : 'Application Title';
		try {
			$actual_link = "$_SERVER[HTTP_HOST]";
			$user_branding = DB::table("users")->where('application_domain', "$actual_link")->value("branding");
			if(!empty($user_branding)) { 
				$branding = json_decode($user_branding);
				if(!empty($branding->branding_img_logo)) $logo_dark = asset($branding->branding_img_logo); 
				if(!empty($branding->branding_title)) $applicationTitle  = $branding->branding_title; 
				if(!empty($branding->favicon_img)) $favicon  = asset($branding->favicon_img); 
				if(!empty($branding->banner_image)) $login_background  = asset($branding->banner_image); 
				if(!empty($branding->preloader_image)) $thumb  = asset($branding->preloader_image); 
			}
		} catch(\Exception $ee) { }

		// echo "<pre>"; print_r($branding); exit;
	@endphp
	<!-- begin::Head -->
	<head>

		 {!! hook_get_output('HeadTop',$vars) !!}
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>{{ $applicationTitle }}</title>
		<!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="description" content="Login page">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!--begin::Fonts -->
		<link href="/themes/default/css/pr-fonts.css" rel="stylesheet" type="text/css" />
		
        <!--Favicon -->
		<link rel="shortcut icon" href="{{$favicon}}" />
		<!--end::Fonts -->
		<link href="/resources/assets/css/login-v3.default.css?v={{$local_version}}?v=11" rel="stylesheet" type="text/css" />
		<link href="/resources/assets/css/login.css?v={{$local_version}}?v=11" rel="stylesheet" type="text/css" />
		<link href="/themes/default/custom.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
		<?php if(!empty($recaptcha_version)) { ?>
			<script src="https://www.google.com/recaptcha/api.js" async defer></script>
		<?php } ?>

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
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		{!! hook_get_output('BodyTop',$vars) !!}
		
		<!-- begin::Page loader -->
		<div class="kt-page-loader kt-page-loader--logo" data-name="pVOXdaLT">
			<img alt="Logo" src="{{$thumb}}" height="100px">
			<div class="kt-spinner kt-spinner--danger" data-name="XDLEHTMq"></div>
		</div>
		<!-- end::Page Loader -->

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root" data-name="RKXFcURk">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login" data-name="PkHUMcDW">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(public/img/bg/bg-3.jpg); background:#FFF !important;" data-name="AZvEoLlw">
					
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper login-wrap w-lg-50 p-10 order-2 order-lg-1" data-name="oRYAUIXn">
						<div class="kt-login__container" data-name="tvsDZdxu">
							<div class="kt-login__logo" data-name="yGqRZzXF">
								<?php
								// $logo_dark = "/public/img/logo_dark.png";
								$disclaimerFlag = 1;
									if(!empty($logo_dark)) { 
										$disclaimerFlag = 0; 
										// $logo_dark = "/storage/branding/" . $app_settings["logo_dark"];
									?>
								<img src="{{$logo_dark}}" class="h-60px">
								<?php } else { 
											
									?>
										<h1><?php echo $applicationTitle; ?></h1>
								<?php } ?>
							</div>							
							<div class="kt-login__signin" data-name="ZonNMFzY">
								<div class="kt-login__head" data-name="vZaMQuXO">
									<h3 class="kt-login__title">{{isset($app_settings['login_title']) && !empty($app_settings['login_title']) ? $app_settings['login_title'] : trans('users.login.title') }}</h3>
									<p class="text-center">{{isset($app_settings['login_desc']) && !empty($app_settings['login_desc']) ? $app_settings['login_desc'] : trans('users.login.description') }}</p>
								</div>
								<form class="kt-form" id="login-form" role="form" method="POST" action="{{ url('/login') }}">
                                	{{ csrf_field() }}

                                	@if ($errors->has('email'))
                                    <div class="alert alert-danger" id="msgEmail" data-name="BgkuxAQz">
                                        <button class="close" data-close="alert"></button>
                                        <span>{{ $errors->first('email') }}</span>
                                    </div>
                                    @endif
									@if ($errors->has('login_ips'))
                                    <div class="alert alert-danger" id="log" data-name="NsapbLSu">
                                        <button class="close" data-close="alert"></button>
                                        <span>{{ $errors->first('login_ips') }}</span>
                                    </div>
                                    @endif

                                    @if ($errors->has('password'))
                                    <div class="alert alert-danger" id="msgPassword" data-name="EVwTnaEb">
                                        <button class="close" data-close="alert"></button>
                                        <span>{{ $errors->first('password') }}</span>
                                    </div>
                                    @endif

                                    @if (Session::has('msg'))
                                    <div class="alert alert-success" data-name="EJolayee">
                                        {{ Session::get('msg') }}
                                    </div>
                                    @endif

                                    @if (Session::has('alert'))
                                    <div class="alert alert-danger" data-name="NWNtTAzr">
                                        {{ Session::get('alert') }}
                                    </div>
                                    @endif

									<div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}" data-name="jcFpJBSx">
										<input class="form-control" id="email" type="email" autocomplete="on" placeholder="{{trans('common.label.email_address')}}" name="email" required value="{{ old('email') }}"/> 
									</div>
									<div class="input-group {{ $errors->has('password') ? ' has-error' : '' }}" data-name="VKtggvxz">
										<input class="form-control" id="password" type="password" autocomplete="on" placeholder="{{trans('common.label.password')}}" name="password" required>
									</div>
									
									<div class="row kt-login__extra" data-name="PNBFYtWY">
									@if(rememberTokenAllowed())
										<div class="col" data-name="VFjfDPSX">
											<label class="kt-checkbox">
												<input type="checkbox" name="remember" value="1"  /> {{trans('users.login.remember_me')}}
												<span></span>
											</label>
										</div>
									@endif
										<div class="col kt-align-right" data-name="MMkaPWNy">
											<a href="javascript:;" id="kt_login_forgot" class="kt-login__link">{{trans('users.login.forget_password')}}</a>
										</div>
									</div>

									<?php if(isset($recaptcha_version) and $recaptcha_version == "v2") { ?>
										<div class="g-recaptcha" 
											data-sitekey="<?php echo $app_settings['recaptcha_site_key']; ?>">
										</div>
									<?php } ?>
									<?php if(isset($recaptcha_version) and $recaptcha_version == "v3") { ?>
										<div class="kt-login__actions" data-name="ZYgiDDjT">
											<button type="submit" data-sitekey="<?php echo $app_settings['recaptcha_site_key']; ?>" id="kt_login_signin_submit"  data-callback="submitForm" class="g-recaptcha btn btn-brand btn-elevate">{{trans('users.login.heading')}}</button>
										</div>

									<?php } else { ?>
										<div class="kt-login__actions" data-name="ZYgiDDjT">
											<button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-elevate">
												<span class="indicator-label">{{trans('users.login.heading')}}</span>
												<span class="indicator-progress">
													Please wait...
													<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
												</span>
											</button>
										</div>
									<?php } ?>

									{!! hook_get_output('SocialLogin',$vars) !!}

								</form>
								@if($disclaimerFlag)
								<br>
								<small> {!!trans('users.login.disclaimer')!!} </small>
								@endif
							</div>
							<div class="kt-login__forgot" data-name="LsFsLDdq">
								<div class="kt-login__head" data-name="VTokXBIF">
									<h3 class="kt-login__title">{{trans('users.login.reset_password.title')}}</h3>
									<div class="kt-login__desc" data-name="VizijVbl">{{trans('users.login.reset_password.description')}}</div>
								</div>
								<form class="kt-form" action="{{ route('forget.password.user') }}" method="post" >
                                	{{ csrf_field() }}

									<div class="input-group" data-name="rVwNcEYf">
										<input class="form-control" type="text" autocomplete="off" placeholder="{{trans('common.label.email_address')}}" name="email" required />
									</div>
									<!-- @if ($errors->has('email'))
	                                <div class="alert alert-danger" id="msgEmail" data-name="EYgjEsYE">
	                                    <button class="close" data-close="alert"></button>
	                                    <span>{{ $errors->first('email') }}</span>
	                                </div>
	                                @endif -->
									<div class="kt-login__actions d-flex" data-name="glbFqveR">
										<button type="submit" id="kt_login_forgot_submit" class="btn btn-brand btn-elevate w-lg-50">
											<span class="indicator-label indicatorl2">{{trans('common.form.buttons.submit')}}</span>
											<span class="indicator-progress indicator2">
												Please wait...
												<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
											</span>

										</button>
										&nbsp;&nbsp;
										<button id="kt_login_forgot_cancel" class="btn btn-light btn-elevate w-lg-50">{{trans('common.form.buttons.back')}}</button>

									</div>
								</form>
							</div>
						</div>
					</div>


				
					<div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2 w-lg-50 h-sm-150" style="background-image: url(<?php echo $login_background; ?>)">
						<div class="d-flex flex-column flex-center py-15 px-5 px-md-15 w-100 py-20"></div>
					</div>

				</div>
			</div>
		</div>


		<?php  if(isset($app_settings['recaptcha_version']) and $app_settings['recaptcha_version'] == "v3") { ?>
			<script>
				function submitForm() {
					var email = $("#email").val();
					var password = $("#password").val();
					if(email == '' && password == '') { 
						return false;
					}
					document.getElementById('login-form').submit();
				}
			</script>
		<?php } ?>

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