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
    <!--begin::Page Custom Styles(used by this page) -->
    <link href="/resources/assets/css/login-v3.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
    <link href="/resources/assets/css/login.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
    <link href="/themes/default/custom.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
    <!--end::Page Custom Styles -->
    <link href="/themes/default/css/toastr.min.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
    <!--end::Layout Skins -->
    <?php
    $favicon = "/public/img/favicon.ico";
    if(!empty($app_settings["favicon"])) {
        $favicon = "/storage/branding/" . $app_settings["favicon"];
    }
    ?>
    <link rel="shortcut icon" href="{{$favicon}}" />
    <link rel="stylesheet" type="text/css" href="/resources/assets/css/two-fa.css?v={{$local_version}}">
    <!-- Scripts -->
    <script>
        window.Laravel = <?php
        echo json_encode([
            'csrfToken' => csrf_token(),
        ]);
        ?>
    </script>
    {!! hook_get_output('HeadEnd',$vars) !!}

    <style> 
        div#license_info {
        display: none !important;
    }
    </style>
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
<div class="kt-page-loader kt-page-loader--logo" data-name="JuqfdEkz">
    <img alt="Logo" src="{{$thumb}}" height="100px">
    <div class="kt-spinner kt-spinner--danger" data-name="GRupqxrW"></div>
</div>
<!-- end::Page Loader -->

<!-- begin:: Page -->
<div class="kt-grid kt-grid--ver kt-grid--root" data-name="hynNrUjG">
    <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v3 kt-login--signin" id="kt_login" data-name="MXPmpxXN">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(/public/img/bg/bg-3.jpg);" data-name="CxAXVDhS">
            <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper" data-name="mqLPYCcb">
                <div class="kt-login__container" data-name="RZUGRcCZ">
                    <div class="kt-login__logo" data-name="sDRbWxyF">
                        <a href="#">
                            <?php
                            $logo_dark = "public/img/logo_dark.png";
                            if(!empty($app_settings["logo_dark"])) {
                                $logo_dark = "/storage/branding/" . $app_settings["logo_dark"];
                            }
                            ?>
                            <img src="{{$logo_dark}}">
                        </a>
                    </div>

                 

                    <div class="kt-login__signin" data-name="oHpSoUkQ">
                        <div class="kt-login__head" data-name="iUmSjwCX">
                            <h3 class="kt-login__title">{{isset($app_settings['login_title']) && !empty($app_settings['login_title']) ? $app_settings['login_title'] : trans('users.login.title') }}</h3>
                        </div>
                        <form class="kt-form" id="2fa" role="form" method="POST" action="">
                            {{ csrf_field() }}

                            <div class="input-group" data-name="YURSxqZL">
                                <div class="alert alert-solid-brand alert-bold" role="alert" id="textinfo" data-name="aItZMhvq">
                                    <div class="alert-text" data-name="UccigDVj">Second factor authentication is required to login. Copy the code from your Authenticator application</div>
                                </div>
                            </div>
                            <div class="input-group" data-name="ZbsfnzoT">
                                <div id="2fa_alert" class="alert alert-solid-danger alert-bold" style="display: none;" data-name="tKqXDvTW"></div>
                                <!-- <div id="copycode" onclick="copyFunction()" style="display: none;" data-name="WzlYoPJm">
                                    <svg class="octicon octicon-clippy" viewBox="0 0 14 16" version="1.1" width="30" height="30" aria-hidden="true"><path fill-rule="evenodd" d="M2 13h4v1H2v-1zm5-6H2v1h5V7zm2 3V8l-3 3 3 3v-2h5v-2H9zM4.5 9H2v1h2.5V9zM2 12h2.5v-1H2v1zm9 1h1v2c-.02.28-.11.52-.3.7-.19.18-.42.28-.7.3H1c-.55 0-1-.45-1-1V4c0-.55.45-1 1-1h3c0-1.11.89-2 2-2 1.11 0 2 .89 2 2h3c.55 0 1 .45 1 1v5h-1V6H1v9h10v-2zM2 5h8c0-.55-.45-1-1-1H8c-.55 0-1-.45-1-1s-.45-1-1-1-1 .45-1 1-.45 1-1 1H3c-.55 0-1 .45-1 1z"></path></svg>
                                </div> -->
                                <span id="br-code" style="display: none;"></span>
                            </div>

                            <div class="input-group" id="backup-message" style="display: none;" data-name="srmTZXLL">
                                Write this down on paper and keep it safe. It will be needed if you ever lose your 2nd factor device or it is unavailable to you again in future.
                            </div>

                            <div class="input-group" id="pass-field" data-name="UrgcaAux">
                                <input class="form-control" id="one_time_password" type="text" autocomplete="on" placeholder="{{trans('Two-Factor Authentication Code')}}" name="one_time_password" required autofocus />
                            </div>
                            <div class="kt-login__actions" data-name="svHdIICt">
                                <button type="submit" id="one_time_try" class="btn btn-brand btn-elevate otp">{{trans('users.login.heading')}}</button>
                                <a type="button" id="link_go" class="btn btn-brand btn-elevate" style="display: none;">{{trans('Continue')}} <i class="la la-angle-double-right"></i></a>
                            </div>
                            <div class="row kt-login__extra alert alert-solid-dark alert-bold" data-name="FUdrjdjV">
                                <div class="col" id="via_backup" data-name="qSjyoSkZ">
                                    Can`t access your 2fa device?<br>Login using backup code
                                </div>
                                <div class="col" id="via_auth" data-name="nIEXcZFg">
                                    Login using Two-Factor code
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- end:: Page -->

    <div class="blockUI blockMsg blockPage" data-name="lDwNPuAE">
        <div class="blockui" style="margin-left:-83.5px;" data-name="PYSHaFMu">
            <span>Processing...</span>
            <span>
                <div class="kt-spinner kt-spinner--v2 kt-spinner--primary" data-name="jBFFVVqK"></div>
            </span>
        </div>
        <div class="blockUI blockOverlay" data-name="QqKzhDOI"></div>
    </div>

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
    <script src="/themes/default/js/jquery.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/sticky.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/themes/default/js/init.js" type="text/javascript"></script>
    <script src="/themes/default/js/scripts.bundle.js" type="text/javascript"></script>
    <script src="/themes/default/js/login-general.js" type="text/javascript"></script>
    <script src="/themes/default/js/toastr.min.js" type="text/javascript"></script>
    <!--end::Page Scripts -->

    <!--end::Global App Bundle -->
    <script type="text/javascript">
      toastr.options = {
        "positionClass" : "toast-top-right",
        "closeButton" : false,
        "debug" : false,
        "newestOnTop" : false,
        "progressBar" : true,
        "preventDuplicates" : false,
        "onclick" : null,
        "showDuration" : "300",
        "hideDuration" : "1000",
        "timeOut" : "5000",
        "extendedTimeOut" : "1000",
        "showEasing" : "swing",
        "hideEasing" : "linear",
        "showMethod" : "fadeIn",
        "hideMethod" : "fadeOut"
      }
    </script>
    <script type="text/javascript">

        function copyFunction() {
            var range = document.createRange();
            range.selectNode(document.getElementById("br-code"));
            window.getSelection().removeAllRanges(); // clear current selection
            window.getSelection().addRange(range); // to select text
            document.execCommand("copy");
            window.getSelection().removeAllRanges();// to deselect
            // console.log("Copied the text: " + range);
            Command: toastr["success"] ("Backup Code Successfully Copied.");
        }

           

        function createOrUpdate(method,route,formId,e,btn_id)
        {
            e.preventDefault();
            data = $(formId).serialize();
            $.ajax({
                type: method,
                url: route,
                data: data,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#2fa_alert').hide();
                    $('#2fa_alert').removeClass('alert-success alert-danger');
                    $('.blockUI').show();
                },
                success: function (data) {
                    $('.blockUI').hide();
                    if (data.status==true) {
                        $('#'+btn_id).hide();
                        $('#via_backup').hide();
                        $('#copycode').hide();
                        if(data.message!==undefined) {
                            $('#2fa_alert').addClass('alert-solid-success');
                            $('#2fa_alert').html(data.message);
                            $('#br-code').text(data.back_up_code);
                            $('#2fa_alert').show();
                            $('#2fa_alert').removeClass('alert-solid-danger');
                            $("#pass-field").hide();
                            $(".kt-login__extra.alert").hide();
                            $("#textinfo>.alert-text").text("The login was successful. Press the continue button to navigate to the Dashboard!");
                            $('#copycode').show();
                        }
                        if(data.redirectTo!==undefined) {
                            $('#link_go').attr('href',data.redirectTo);
                            $('#link_go').show();
                        }
                    }
                    else {
                        window.location.reload();
                    }
                    return false;
                }, error: function (jqXHR, status, err) {
                    $('.blockUI').hide();
                    if(jqXHR.responseJSON.message!==undefined)
                    {
                        $('#2fa_alert').text(jqXHR.responseJSON.message);
                        $('#2fa_alert').show();
                    }
                }
            });
        }
        $(".otp").click(function (e) {
            id = this.id;
            if(id=='one_time_try') {
                formId = "#2fa";
                method = "POST";
                route = '{{route('2fa')}}';
            }
            createOrUpdate(method, route, formId, e, id);

        });
        
        $('#via_backup').on('click',function () {
            $(this).hide();
            $("#via_auth").show();
            $("#2fa_alert").hide();
            $("#one_time_password").val("");
            $('#one_time_password').attr('placeholder','Backup Code');
            $("#one_time_try").click(function() {
                if($("#one_time_password").val() !== "") {
                    $("#via_backup").show();
                    $('#via_backup').hide();
                    setTimeout(function(){
                        $(".kt-login__extra.alert").hide();
                        $("#backup-message").show();
                        $("#copycode").css("display", "inline-block");
                        $("#textinfo>.alert-text").text("Backup Codes are valid once only. It will now be reset.");
                    }, 1000);
                    setTimeout(function(){
                       $(".blockUI").hide();
                    }, 2000);
                }
                else {
                    return;
                }
            });
        });

        $('#via_auth').on('click',function () {
            $(this).hide();
            $("#via_backup").show();
            $("#2fa_alert").hide();
            $("#one_time_password").val("");
            $('#one_time_password').attr('placeholder','Two-Factor Authentication Code');
            $("#one_time_try").click(function() {
                if($("#one_time_password").val() !== "") {
                    $(".blockUI").show();
                    $('#via_auth').hide();
                    setTimeout(function(){
                        $(".kt-login__extra.alert").hide();
                        $("#backup-message").hide();
                        $("#copycode").hide();
                        $("#textinfo>.alert-text").text("You are successfully passed authentication. Click Continue to go on dashboard.");
                    }, 1000);
                    setTimeout(function(){
                       $(".blockUI").hide();
                    }, 2000);
                } else{
                    return;
                }
            });
        });

        $("#license_info").hide();
    </script>
{!! hook_get_output('Footer',$vars) !!}
        <!--end::Page Scripts -->
         {!! hook_get_output('BodyEnd',$vars) !!}
</body>
<!-- end::Body -->
</html>