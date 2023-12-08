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
        $lattr = json_decode($app_settings["license_attributes"], true);
    ?>
	<!-- begin::Head -->
	<head>
        @include('includes.head_master')
		@include('includes.head')
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
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
        @if(!empty($lattr["package"]) and $lattr["package"] == "Mumara Developers")
        <div class="dev-license alert alert-solid-warning alert-bold" data-name="vpWAoQOi">
            <div class="content" data-name="sazlRgtd">
                <span>{{trans('common.message.developer_license')}}</span>
            </div>
        </div>
        @endif

        <?php 
            $checklimits = \App\Campaign::checkLimitTop(Auth::user()->id);
           
        ?>



		<div class="kt-grid kt-grid--hor kt-grid--root" data-name="rzgQowKV">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page" data-name="ZijYzgtS">

				<!-- begin:: Aside -->
				<button class="kt-aside-close" id="kt_aside_close_btn"><i class="la la-close"></i></button>
				<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside" data-name="jSjJOUeE">

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
                                    <span>{{trans('layouts_master.master_dashboard_blade.day_span')}}</span>
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
					<div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" data-name="qmWApXoS">
                        <!-- begin:: Content Head -->
                        @include('includes.breadcrumb')
                        <!-- end:: Content Head -->
                        <!-- Getting $vars from layout -->
                        {!! hook_get_output('AlertBar',$vars) !!} 
                        @include('includes.pageTitle')
                        <!-- Getting $vars from layout -->
                        {!! hook_get_output('TitleBar',$vars) !!} 

                        <!-- begin:: Content -->
                        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="qPOLWSAq">
                            <div class="col-md-12 content__main" data-name="Oyssajde">
                                <div class="row" data-name="VvNndVFb">
                                    <div class="content__loader" data-name="HGakMajj">
                                        <div class="box_content_load row" data-name="IZEBSTvA">
                                            <div class="col-md-12" data-name="ghwfnNmI">
                                                <div class="box_head_load w25" data-name="lVGCsDTw"></div>
                                            </div>
                                            <div class="col-md-12" data-name="cbeVUYhJ">
                                                <div class="box_text_load w50" data-name="lsljrlnd"></div>
                                            </div>
                                            <div class="col-md-12" data-name="nVrYOivK">
                                                <div class="box_text_load w75" data-name="qVyKfutZ"></div>
                                            </div>
                                            <div class="col-md-12" data-name="guaiCHgk">
                                                <div class="box_text_load w75" data-name="FLYdPjrS"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @yield('content')
                            {!! hook_get_output('ContentEnd',$vars) !!} 
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
		<div id="kt_scrolltop" class="kt-scrolltop" data-name="GmwAZAJl">
			<i class="fa fa-arrow-up"></i>
		</div>
		<!-- end::Scrolltop -->

		@include('includes.scriptGlobal')
        <!-- page scripts -->
		@yield('page_scripts')
        <!-- Addons JS -->
        @php
          echo hook_get_output('Footer',$vars);
        @endphp
        @include('includes.common_script')
        <!-- JS Stack -->
        @stack('js')
        </script>
        <script type="text/javascript">
             @if(auth()->user()->role_id==1)
            $("#parent-5 ul li").last().insertBefore("#parent-5 #child-82");
            @endif
            $(".kt-portlet").hide();
            $("ul.kt-wizard-v4").hide();
            $(window).on("load", function() {
                setTimeout(function() {
                    $(".content__main").hide();
                    $(".kt-menu__loader").hide();
                    $(".kt-portlet").fadeIn(500);
                    $(".kt-portlet").show();
                    $(".kt-wizard-v4").show();
                    $("ul.kt-menu__nav").show();
                    $(".heading").show();
                    $(".pagetitle").show();
                }, 100);
                $('input[type="search"]').attr("placeholder","{{ trans('common.search.all') }}");
            });       
            $(document).ready(function () {

                $("#report_bug_switch").on("click", function() {
                    $("#report_bug").toggleClass("hide");
                })
                $("#help_icon_switch").on("click", function() {
                    $("#help_icon_header").toggleClass("hide");
                })

            $("ul.scroll").addClass(" ps ps--active-y ps--scrolling-y");
            });
            function changeImportStatus(list_id) {

                $.ajax({
                    url: "{{ url('/') }}"+'/list/import/status/change/'+list_id,
                    type: 'GET',
                    success: function (data) {
                        if(data == 'success') {
                            //  window.location.href = "{{ url('/') }}"+"/list/" + list_id + "/contacts";
                        } else {
                            alert("{{trans('app.header.list_not_found')}}");
                        }
                    }
                }); 
            }

       

        function checkPmtaStatus(error_to_verify,pmta_id,row_id) {
            $.ajax({
                type: "POST",
                url: '{{route('checkPmtaStatus')}}',
                data: {'string':error_to_verify,'pmta_id':pmta_id,'ref':row_id},
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#notify_'+row_id).css('display','table-row');
                    $('#process_'+row_id).slideDown('slow');
                    $('#success_'+row_id).hide();
                    $('#error_'+row_id).hide();
                },
                success: function (data) {
                    if (data.status==true) {
                        btn = $('#btn_'+row_id);
                        setTimeout(function () {
                            $('#process_'+row_id).hide();
                            $('#success_'+row_id).slideDown('slow');
                            btn.fadeOut('slow');
                        },1000);
                         btn_id = btn.siblings().last().attr('id');
                        setTimeout(function () {
                            $('.r_'+btn_id).slideUp('slow');
                            $('#notify_'+row_id).slideUp('slow');
                        },2000);
                    }
                    else {

                        setTimeout(function () {
                            $('#process_'+row_id).hide();
                            $('#error_'+row_id).slideDown('slow');
                        },2000);
                    }
                    return false;
                }
            });
        }


        <?php  $max_file = (file_upload_max_size()/1024)/1024; ?>
        function ValidateSize(file) {
            $("#FileSizeError").hide();
            var FileSize = file.files[0].size / 1024 / 1024; // in MB
            if (FileSize > <?php echo $max_file; ?>) {
               $("#FileSizeError").show();
               $(file).val(''); //for clearing with Jquery
            } else {
            }
        }
/*  */
function showOrHideElement(element,showOrHideEl)
{
    checked = $(element).is(':checked');
    if(checked)
        $(showOrHideEl).slideDown('slow');
    else
        $(showOrHideEl).slideUp('slow');
}
    </script>
@include('includes.validator-functions')
 {!! hook_get_output('BodyEnd',$vars) !!}
<script type="text/javascript">
    @php
    $access = true;
if(isClient()){
$routes = skipRoutesFor(getPackage());
if(!empty($routes))
    $access = !in_array('templates.marketplace',$routes);
}
    @endphp
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