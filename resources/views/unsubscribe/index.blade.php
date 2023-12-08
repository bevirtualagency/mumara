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
		<link href="/resources/assets/css/login.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
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
            .unsubscribe {
                padding: 0 !important;
                margin: 0 !important;
                width: 100%;
                height: 100vh;
            }
            .unsubscribe .kt-login__container {
                width: 520px !important;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100%;
            }
            .unsubscribe .kt-login__signin {
                padding: 20px  45px 25px;
                border-radius: 6px;
                background-color: #ffffff;
                box-shadow: 0 0 59px 0 rgb(0 0 0 / 10%);
            }
            .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-login__head {
                margin-bottom: 0;
                margin-top: 0;
            }
            p.text-center {
                margin: 0;
            }
            .kt-login.kt-login--v3 .kt-login__wrapper .kt-login__container .kt-form .kt-login__actions {
                margin-top: 15px;
            }       
            #submit {
                width: 100%;
                font-size: 15px !important;
            }
            .form-result {
                margin-bottom: 0 !important;
                margin-top: 15px;
                padding: 0;
            }
            .alert-danger, .alert-success {
                padding: 12px;
                border-radius: 5px;
            }
            form {
                position: relative;
            }
            span.countdown {
                position: absolute;
                right: 2px;
                font-size: 13px;
                font-weight: 500;
                letter-spacing: 0.1px;
            }
            #message {
                font-size: 14px;
                text-align: center;
                font-weight: 400;
            }
            #submit[disabled] {
                opacity: 0.6;
                pointer-events: none;
            }
            .loading {
                position: fixed;
                z-index: 9999;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                width: 100%;
                background: rgba(0,0,0,.5);
                display: none;
            }
            .loader {
                border: 6px solid #f3f3f3;
                border-radius: 50%;
                border-top: 6px solid #9f9f9f;
                width: 60px;
                height: 60px;
                -webkit-animation: spin 2s linear infinite;
                animation: spin 2s linear infinite;
            }
            .loading .loader {
                position: absolute;
                left: calc(50% - 30px);
                top: calc(50% - 30px);
            }
            @keyframes spin{0%{transform:rotate(0)}100%{transform:rotate(360deg)}}
        </style>

        @include('includes.common_head')
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
		<!-- begin::Page loader -->
        <?php 
			$thumb = "/public/img/thumb.jpg";
			if(!empty($app_settings["thumb"])) { 
				$thumb = "/storage/branding/" . $app_settings["thumb"];
			}
		 ?>
		<div class="kt-page-loader kt-page-loader--logo" data-name="pVOXdaLT">
			<img alt="Logo" src="{{$thumb}}" height="100px">
			<div class="kt-spinner kt-spinner--danger" data-name="XDLEHTMq"></div>
		</div>
        <div class="loading" id="loading">
            <div class="loader"></div>
        </div>
		<!-- end::Page Loader -->

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root" data-name="RKXFcURk">
			<div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login" data-name="PkHUMcDW">
				<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(public/img/bg/bg1.jpg);" data-name="AZvEoLlw">
					<div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper unsubscribe" data-name="oRYAUIXn">
						<div class="kt-login__container" data-name="tvsDZdxu">
							
							<div class="kt-login__signin" data-name="ZonNMFzY">
								<div class="kt-login__head" data-name="vZaMQuXO">
									<h3 class="kt-login__title">{{trans('unsubscribe.index_blade.unsubscribe_email_heading')}}</h3>
									<p class="text-center">{{trans('unsubscribe.index_blade.want_to_stop_receiving_para')}} </p>
								</div>
								<form class="kt-form" id="login-form" role="form" method="POST" action="{{ url('/login') }}">
                                	{{ csrf_field() }}
                                    <span class="countdown"></span>    
									<div class="input-group {{ $errors->has('email') ? ' has-error' : '' }}" data-name="jcFpJBSx">
										<input class="form-control" id="email" type="email" autocomplete="on" placeholder="{{trans('common.label.email_address')}}" name="email" required value="{{ old('email') }}"/> 
									</div>
								
									<div class="kt-login__actions" data-name="ZYgiDDjT">
										<button type="button" id="submit" class="btn btn-brand btn-elevate">{{trans('unsubscribe.index_blade.unsubscribe_button')}}</button>
									</div>

                                    <div class="clearfix"></div>
                                    <div class="form-result alert">
                                        <div class="content" id="message"></div>
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
        <script>
            function validateEmail($email) {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                return emailReg.test( $email );
            }
            $(document).ready(function() {
                $("#submit").click(function () {
                    $('.form-result').removeClass('alert-success').removeClass('alert-danger').hide();
                    $('.form-result > .content').html("");
                    var email = $("#email").val();
                    if(email === "") {
                        $('.form-result').addClass('alert-danger').removeClass('alert-success').css('display', 'block');
                        // $('.form-result > .content', $this).html(obj["result"]);
                        $('#submit').removeClass('clicked');
                        $("#message").text("{{trans('unsubscribe.index_blade.text_email_required')}}");
                        return false;
                    } else if( !validateEmail(email)) {
                        $('.form-result').addClass('alert-danger').removeClass('alert-success').css('display', 'block');
                        // $('.form-result > .content', $this).html(obj["result"]);
                        $('#submit').removeClass('clicked');
                        $("#message").text("{{trans('unsubscribe.index_blade.text_invalid_email')}}");
                    } else {
                        $('.form-result').addClass('alert-success').removeClass('alert-danger').fadeIn(200).hide();
                        $('.form-result > .content').html("");
                        $("#loading").show();
                        $('.countdown').html("");
                        $('#submit').attr('disabled', 'disabled');
                        localStorage.removeItem('time');
                        localStorage.setItem('timer' , 0);
                        var timer = 60;
                        localStorage.setItem("timer" , timer)

                        var formdata = {
                            email
                        };
                        $.ajax({
                            url: '{{url('unsubscribed')}}',
                            type: "POST",
                            data: formdata,
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(result) {

                                if(result == "notfound") { 
                                    setTimeout(() => {
                                        $("#loading").hide();
                                        $('.form-result').addClass('alert-danger').removeClass('alert-success').fadeIn(200).show();
                                        $('.form-result > .content').html("{{trans('unsubscribe.index_blade.html_email_address_not')}}");
                                        $("#email").val("");
                                        localStorage.setItem('time', new Date());
                                    }, 1000);
                                }
                                if(result == "already") { 
                                    setTimeout(() => {
                                        $("#loading").hide();
                                        $('.form-result').addClass('alert-danger').removeClass('alert-success').fadeIn(200).show();
                                        $('.form-result > .content').html("{{trans('unsubscribe.index_blade.html_email_unsubscribed')}}");
                                        $("#email").val("");
                                        localStorage.setItem('time', new Date());
                                    }, 1000);
                                }
                                if(result == "success") { 
                                    setTimeout(() => {
                                        $("#loading").hide();
                                        $('.form-result').addClass('alert-success').removeClass('alert-danger').removeClass('alert-warning').fadeIn(200).show();
                                        $('.form-result > .content').html("{{trans('unsubscribe.index_blade.html_email_unsub_successfully')}}");
                                        $("#email").val("");
                                        localStorage.setItem('time', new Date());
                                    }, 1000); 
                                }
                                setTimeout(() => {
                                    timerFunction();
                                }, 1000);

                               
                            }
                        });

                      

                       
                    }
                    return false;
                });
            });

            $(function() {
                timerFunction();
            })

            function timerFunction() { 

                            var timerN = localStorage.getItem("timer");
                            if(timerN > 0)  $('#submit').attr('disabled' , true);
                            var timer2 = "00:" + timerN;
                            var interval = setInterval(function() {
                                // var  = timer2.split(':');
                                //by parsing integer, I avoid all extra string processing
                                var minutes = 0;
                                var seconds = parseInt(Number(timerN), 10);
                                --seconds;
                                minutes = (seconds < 0) ? --minutes : minutes;
                                // console.log(minutes, seconds);
                                seconds = (seconds < 0) ? 59 : seconds;
                                seconds = (seconds < 10) ? '0' + seconds : seconds;
                                //minutes = (minutes < 10) ?  minutes : minutes;
                                if (minutes < 0) {
                                    clearInterval(interval);
                                    $('.countdown').html("");
                                } else {
                                    $(".countdown").show();
                                    $('.countdown').html(minutes + ':' + seconds);
                                    timer2 = minutes + ':' + seconds;
                                } 
                                timerN = Number(timerN) - 1;
                                localStorage.setItem("timer" , timerN)
                                if(Number(timerN) <= 0) {    
                                    localStorage.setItem('timer' , 0);
                                }  
                               
                            }, 1000);
                            setTimeout(() => {
                                $(".countdown").html("");
                                $(".countdown").hide();
                                localStorage.removeItem('time');
                                localStorage.removeItem('timer');
                                $('#submit').removeAttr('disabled');
                                $('.form-result').removeClass('alert-success').removeClass('alert-danger').fadeIn(200).hide();
                            }, Number(localStorage.getItem("timer")) * 1000);
                                  

            }
        </script>
	</body>
	<!-- end::Body -->
</html>