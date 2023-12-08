<!DOCTYPE html>
<html lang="en">
    <?php 
        $app_settings = getApplicationSettings();
        if(isset($app_settings['return_all_vars_in_hooks']) && $app_settings['return_all_vars_in_hooks']=="on"){
            $vars =get_defined_vars();
        }
        $vars['route'] =request()->route()->getName();
        // sideMenuNew views data
        $common_data=\App\Helpers\Common::common_data();
        $app_settings = getApplicationSettings();

        $updated_title = isset($app_settings['title']) && !empty($app_settings['title']) ? $app_settings['title'] : 'Mumara';
        if(!empty(Auth::user()->branding)) { 
            $branding = json_decode(Auth::user()->branding);
            if(!empty($branding->branding_title)) $updated_title = $branding->branding_title;
        }

        $lattr = json_decode($app_settings["license_attributes"], true);
    ?>
    <!-- begin::Head -->
    <head>
        @include('includes.head_master_dashboard')
        @include('includes.head')
    </head>

    <!-- end::Head -->
    <?php
        $body_default_classes="kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading mode-option";
        if( \Config('app.env')=="development"){
          $body_default_classes="kt-aside--fixed header-static header-mobile-fixed subheader-enabled aside-enabled aside-static aside-minimize-hoverable mode-option";  
        }
    ?>
    <!-- begin::Body -->
    <body class="{{ $body_default_classes }}">
        @php
        
        try {
            echo hook_get_output('BodyTop',$vars);
        } catch (\Exception $e) {
            \Log::error($e->getMessage());
        }
        @endphp

        <script type="text/javascript">
            var app_url = "<?php echo url('/');  ?>";
        </script>

        <!-- begin:: Page -->
        @include('includes.preloader',['app_settings'=>$app_settings])


        <!-- begin:: Header Mobile -->
        @include('includes.mobileTopBranding',['app_settings'=>$app_settings])
        <!-- end:: Header Mobile -->
        @if( \Config('app.env')=="development" && !isClient())
        <div class="dev-mode alert alert-solid-brand alert-bold" id="developers-mode" data-name="vpWAoQOi">
            <div class="content" data-name="sazlRgtd">
                <span>{{trans('common.message.mode',['mode'=>'development'])}}</span>
                <button class="btn btn-xs btn-info" id="switch-production">{{trans('common.message.switch',['mode'=>'Production'])}}</button>
            </div>
        </div>
        @endif
        @if(!empty($lattr["package"]) and $lattr["package"] == "Mumara Developers")
        <div class="dev-license alert alert-solid-danger alert-bold" data-name="vpWAoQOi">
            <div class="content" data-name="sazlRgtd">
            <span>{{trans('common.message.developer_license')}}</span>
            </div>
        </div>
      
        @endif
        <?php 
            $checklimits = \App\Campaign::checkLimitTop(Auth::user()->id);
           
        ?>
        

        

        <div class="kt-grid kt-grid--hor kt-grid--root" data-name="knPzoTEt">
            <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page" data-name="GRbtMjXQ">

                <!-- begin:: Aside -->
                <button class="kt-aside-close" id="kt_aside_close_btn"><i class="la la-close"></i></button>
                <div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside" data-name="DDNdTkFH">

                    <!-- begin:: Aside -->
                    @include('includes.topBranding',['app_settings'=>$app_settings])
                    <!-- end:: Aside -->

                    <!-- begin:: Aside Menu -->
                    @include('includes.sideMenuNew',$common_data)
                    <!-- end:: Aside Menu -->
                </div>


                <?php

$cloud_package = "";
if(!empty($lattr["package"])) { 
    $cloud_package = $lattr["package"];
}


$styleeee = "display:none;";
$date = "";
if(trim($cloud_package) == "Machine - Trial (14-Days)") { 
    $styleeee = "";
    $rdate = $lattr["registered"];
    $date = date("Y-m-d H:i:s" , strtotime("$rdate +14 days"));
}

?>
@if(trim($cloud_package) == "Machine - Trial (14-Days)")  
<input type="hidden" value="{{$date}}" id="expireDate">

<script>
var trieldate = "<?php echo $date; ?>";
const countdown = () => {
    const countDate = new Date(trieldate).getTime();
    const now = new Date().getTime();
    const gap = countDate - now;

    // How does the time work?
    const second = 1000;
    const minute = second * 60;
    const hour = minute * 60;
    const day = hour * 24;

    // calculate
    const textDay = Math.floor(gap / day);
    const textHour = Math.floor((gap % day) / hour);
    const textMinute = Math.floor((gap % hour) / minute);
    const textSecond = Math.floor((gap % minute) / second);

    document.querySelector(".day").innerText = textDay;
    document.querySelector(".hour").innerText = textHour;
    document.querySelector(".minute").innerText = textMinute;
    document.querySelector(".second").innerText = textSecond;

    if (gap <= 0) {
        clearInterval(watchCountdown);
        document.querySelector(".day").innerHTML = "0";
        document.querySelector(".hour").innerHTML = "0";
        document.querySelector(".minute").innerHTML = "0";
        document.querySelector(".second").innerHTML = "0";
    }
};

let watchCountdown = setInterval(countdown, 1000);
</script>
@endif

<!-- end:: Aside -->
<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper" data-name="eMMJygWW">

        @if($checklimits == "Daily")
        <div class=" alert alert-solid-warning alert-bold daily-limit" data-name="vpWAoQOi">
            <div class="content" data-name="sazlRgtd">
            <span>{!!trans('common.message.limit_exceeded' , ["type" => "Daily"])!!}</span>
            </div>
        </div>
        @endif
        @if($checklimits == "Monthly")
        <div class=" alert alert-solid-warning alert-bold daily-limit" data-name="vpWAoQOi">
            <div class="content" data-name="sazlRgtd">
            <span>{!!trans('common.message.limit_exceeded' , ["type" => "Monthly"])!!}</span>
            </div>
        </div>
        @endif

<div class="dev-mode alert alert-warning alert-light alert-bold" style="<?php echo $styleeee; ?>" id="trial-mode" data-name="vpWAoQOi">
                        <div class="content" data-name="sazlRgtd">
                            <span>{{trans('layouts_master.master_dashboard_blade.your_trial_expires_span')}}</span>
                            <div class="countdown">
                                <div class="container-day">
                                    <h4 class="day">00</h4>
                                    <span>{{trans('layouts_master.master_dashboard_blade.day_span')}} </span>
                                </div>
                                <div class="container-hour">
                                    <h4 class="hour">00</h4>
                                    <span>{{trans('layouts_master.master_dashboard_blade.hour_span')}} </span>
                                </div>
                                <div class="container-minute">
                                    <h4 class="minute">00</h4>
                                    <span>{{trans('layouts_master.master_dashboard_blade.minute_span')}} </span>
                                </div>
                                <div class="container-second">
                                    <h4 class="second">00</h4>
                                    <span>{{trans('layouts_master.master_dashboard_blade.second_span')}} </span>
                                </div>
                            </div>
                            <a href="https://billing.mumara.com" class="btn btn-xs btn-warning">{{trans('layouts_master.master_dashboard_blade.upgrade_plan_span')}}</a>
                        </div>
                    </div>

                    <!-- begin:: Header Topbar -->
                    @include('includes.topBar')
                    <!-- end:: Header Topbar -->

                    <!-- end:: Header -->
                    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" data-name="sHQzVSuD">
                        <!-- begin:: Content Head -->
                         <!-- Getting $vars from layout -->
                        {!! hook_get_output('AlertBar',$vars) !!}
                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="ZiYcQNkL">
                            @yield('content')
                        </div>
                        <!-- end:: Content -->

                    </div>

                    <!-- begin:: Footer -->
                    @include('includes.footer',['app_settings'=>$app_settings])
                    <!-- end:: Footer -->
                </div>
            </div>
        </div>

       

        <!-- begin::Quick Panel -->
        @include('includes.rightSidebar')
        <!-- end::Quick Panel -->
        <!-- begin::Scrolltop -->
        <div id="kt_scrolltop" class="kt-scrolltop" data-name="cTCTWIbX">
            <i class="fa fa-arrow-up"></i>
        </div>
        <!-- end::Scrolltop -->
        @include('includes.scriptGlobal')
        @yield('page_scripts')
         @php
          echo hook_get_output('Footer',$vars);
        @endphp
        @include('includes.common_script')
        @yield('dashboard_scripts')
        <!-- JS stack -->
        @stack('js')
        <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAcbHtY9xjILsJxvSoN63-5u9xb-_rBkpI&callback=initMap" async defer></script> -->
        <script type="text/javascript">
            @if(auth()->user()->role_id==1)
             $("#parent-5 ul li").last().insertBefore("#parent-5 #child-82");
            @endif
            
            $(window).load(function() {
                setTimeout(function() {
                    $(".content__main").hide();
                    $(".kt-menu__loader").hide();
                    $(".portel-hide").css("display", "flex");
                    $(".op0").css("opacity", "1");
                    $("ul.kt-menu__nav").show();
                    $(".kt-portlet").show();
                    $(".heading").show();
                    $("#issue-note").css("display", "flex");
                    $(".headerTodo").show();
                }, 100);
            });

            $(document).ready(function () {
                $(".kt-dialog").hide();
            });
        
            function changeImportStatus(list_id) {
                $.ajax({
                    url: "{{ url('/') }}"+'/list/import/status/change/'+list_id,
                    type: 'GET',
                    success: function (data) {
                        if(data == 'success') {
                            // window.location.href = "{{ url('/') }}"+"/list/" + list_id + "/contacts";
                        } else {
                            alert("{{trans('common.label.note_no_list_found')}}");
                        }
                    }
                }); 
            }
            $('.ret').on('click',function () {
               btn_id = this.id;
               data = $('#'+btn_id).attr("data");
                if(data.includes('checkPmtaStatus'))
                {
                    str = data.replace('checkPmtaStatus','');
                    route = "{{route('checkPmtaStatus')}}";
                }
                else {
                    alert("{{trans('layouts_master.master_dashboard_blade.define_route_alert')}}");
                    return;
                }

                str = str.replace('(','');
              str = str.replace(')','');
                var res = str.split(",");
                strToCheck = res[0].replace("'",'');
                strToCheck = strToCheck.replace("'",'');
                pmta_id = res[1];
                ref_id = res[2];
                $.ajax({
                    type: "POST",
                    url: route,
                    data: {'string':strToCheck,'pmta_id':pmta_id,'ref':ref_id},
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                      //  $('#li_issue_'+ref_id).css('display','table-row');
                        $('#process_notify_'+ref_id).slideDown('slow');
                        $('#success_notify_'+ref_id).hide();
                        $('#error_notify_'+ref_id).hide();
                    },
                    success: function (data) {
                        if (data.status==true) {
                            btn = $('#btn_'+ref_id);
                            setTimeout(function () {
                                $('#process_notify_'+ref_id).hide();
                                $('#success_notify_'+ref_id).slideDown('slow');
                                btn.fadeOut('slow');
                            },1000);
                            setTimeout(function () {
                                $('#li_issue_'+ref_id).slideUp('slow');
                            },2000);
                        }
                        else {

                            setTimeout(function () {
                                $('#process_notify_'+ref_id).hide();
                                $('#error_notify_'+ref_id).slideDown('slow');
                            },1500);
                        }
                        return false;
                    }
                });
            });
            function resolveIssue (id) {
                $.ajax({
                    type: "POST",
                    url: '{{route('deleteIssue')}}',
                    data: {'id':id},
                    cache: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $(".blockUI").show();

                    },
                    success: function (data) {
                        $(".blockUI").hide();
                        if (data.status) {
                            $('#li_issue_'+data.issue.ref_id).fadeOut(1500, function () {
                                $(this).remove();
                            });
                        }
                        return false;
                    }
                });
            }
        </script>
@include('includes.validator-functions')
@php
$access = true;
if(isClient()){
$routes = skipRoutesFor(getPackage());
if(!empty($routes))
    $access = !in_array('templates.marketplace',$routes);
}
    try {
        echo hook_get_output('BodyEnd',$vars);
    } catch (\Exception $e) {
    \Log::error($e->getMessage());
}
@endphp

<script type="text/javascript">
    @if(!$access)
        $(document).find('#child-94').hide();
    @endif
    
        @php
          $data=hook_get_all('addPageHtml',$vars);

        @endphp
        @foreach ($data as $value)
            @if(!empty($value['html']) && !empty($value['selector']) && !empty($value['action']) && !empty($value['routeNames']) && ((is_array($value['routeNames']) && in_array($vars['route'], $value['routeNames'])) || ( !is_array($value['routeNames']) && $value['routeNames']=="*")))
                @php
                $html= str_replace('"','\\"',$value['html']);
                $selector= str_replace('"','\\"',$value['selector']);
                @endphp
                @if($value['action']=="append")
                    $("{{$selector}}").append(`{!!$html!!}`);
                @elseif($value['action']=="prepend")
                    $("{{$selector}}").prepend(`{!!$html!!}`);
                @elseif($value['action']=="before")
                    $("{{$selector}}").before(`{!!$html!!}`);
                @elseif($value['action']=="after")
                    $("{{$selector}}").after(`{!!$html!!}`);

                @endif
            @endif
        @endforeach 
</script>

    </body>

    <!-- end::Body -->
</html>