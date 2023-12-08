@extends('layouts.master2')

@section('title', trans('app.lang_view_sessions'))

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/session.css?v={{$local_version}}.01">
@endsection

@section('page_scripts')
<script src="/public/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/public/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>

@include('includes.view-pages-filter-script')
<script type="text/javascript">

    function show_selected_session(el) {
        $("#session-mini-popup").modal("show");
        $("#link-session").val(el);
        // console.log(el);
        $("#activesession_entry1").click(function() {
            $("#current_session_remove").hide();
            setTimeout(function() {
                $("#session-mini-popup #device_pic").removeClass("device_mobiledevice").addClass("device_personalcomputer");
                $("#session-mini-popup .device_name").html("{{trans('sessions.session_index_blade.device_name_computer')}}");
                $("#session-mini-popup .device_time").html("{{trans('sessions.session_index_blade.device_time_seconds')}}");
                $("#session-mini-popup #pop_up_time").html("1/22/20");
                $("#session-mini-popup #pop_up_os").html("<div class='asession_os_popup minios_windows'></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span>");
            }, 200);
        });
        $("#activesession_entry2").click(function() {
            $("#current_session_remove").show();
            setTimeout(function() {
                $("#session-mini-popup #device_pic").removeClass("device_personalcomputer").addClass("device_mobiledevice");
                $("#session-mini-popup .device_name").html("{{trans('sessions.session_index_blade.device_name_mobile')}}");
                $("#session-mini-popup .device_time").html("8 {{trans('sessions.session_index_blade.device_time_days_ago')}}");
                $("#session-mini-popup #pop_up_time").html("1/25/20");
                $("#session-mini-popup #pop_up_os").html("<div class='asession_os_popup minios_android'></div><span>{{trans('sessions.session_index_blade.android_span')}} 7.1</span>");
            }, 200);
        });
        $("#activesession_entry3").click(function() {
            $("#current_session_remove").show();
            setTimeout(function() {
                $("#session-mini-popup #device_pic").removeClass("device_mobiledevice").addClass("device_personalcomputer");
                $("#session-mini-popup .device_name").html("{{trans('sessions.session_index_blade.device_name_computer')}}");
                $("#session-mini-popup .device_time").html("13 {{trans('sessions.session_index_blade.device_time_days_ago')}}");
                $("#session-mini-popup #pop_up_time").html("1/20/20");
                $("#session-mini-popup #pop_up_os").html("<div class='asession_os_popup minios_windows'></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span>");
            }, 200);
        });
    }
    function show_all_sessions() {
        $("#view_all_sessions").modal("show");
        $("#sessions-blk").css("height", "auto");
    }
        

    $(document).ready(function() {

        $("#view_all_sessions .Field_session").click(function(){
            if($(event.target).parents().hasClass("select_holder")){
                return;
            }
            var id=$(this).attr('id');
            $("#view_all_sessions .Field_session").addClass("autoheight");
            $("#view_all_sessions .aw_info").slideUp(500);
            $("#view_all_sessions .activesession_entry_info").show();
            if($("#view_all_sessions #"+id).hasClass("web_email_specific_popup"))
            {
                $(".aw_info a").unbind();
                $("#view_all_sessions #"+id+" .aw_info").slideUp(500,function(){
                    $("#view_all_sessions #"+id).removeClass("web_email_specific_popup");
                    $("#view_all_sessions .Field_session").removeClass("autoheight");
                });
                $("#view_all_sessions .activesession_entry_info").show();
            }
            else
            {
                $("#view_all_sessions .Field_session").removeClass("Active_sessions_showall_hover_primary");
                $("#view_all_sessions .Field_session").removeClass("web_email_specific_popup");
                $("#view_all_sessions #"+id).addClass("web_email_specific_popup");
                $("#view_all_sessions #"+id+" .aw_info").slideDown("fast",function(){
                    $("#view_all_sessions .Field_session").removeClass("autoheight");
                });
                $("#view_all_sessions #"+id+" .activesession_entry_info").hide();
            }
        });

        $("#current_session_remove").on("click",function() {
            var sessioncount = $("#sessions-blk .Field_session").length;
            var allsessioncount = $("#view_all_sessions .Field_session").length;
            $("#loading").show();
            setTimeout(function() {
                if($("#link-session").val() == "1") {
                    $("#session_alert").show();
                    $("#sessions-name").html("{{trans('sessions.session_index_blade.device_name_computer')}}");
                    $("#activesession_entry1").remove();
                    $("#activesession_entry4").remove();
                } else if ($("#link-session").val() == "2") {
                    $("#session_alert").show();
                    $("#sessions-name").html("{{trans('sessions.session_index_blade.device_name_mobile')}}");
                    $("#activesession_entry2").remove();
                    $("#activesession_entry5").remove();
                } else {
                    $("#session_alert").show();
                    $("#sessions-name").html("{{trans('sessions.session_index_blade.device_name_computer')}}");
                    $("#activesession_entry3").remove();
                    $("#activesession_entry6").remove();
                }
                if(sessioncount == 1) {
                    $(".no_session").show();
                    $("#sessions_showall").hide();
                } else {
                    $(".no_session").hide();
                    $("#sessions_showall").show();
                }
                if(allsessioncount == 1) {
                    $("#no_sessions").show();
                } else {
                    $("#no_sessions").hide();
                }
                $("#loading").hide();
                setTimeout(function() {
                    $("#session-mini-popup").modal("hide");
                    setTimeout(function() {
                        $("#session_alert").hide();
                        $("#sessions-name").html("");
                    },500);
                }, 1000);
            }, 1000); 
        });
        $("#view_all_sessions button").click(function() {
            var parent = $(this).closest(".Field_session");
            var dname =  $(this).closest(".Field_session .device_name").html();
            $("#loading").show();
            var systemname = $(this).parent().parent().children(".info_tab").children(".device_div").children(".device_details").children(".device_name").html();
            setTimeout(function() {
                $(parent).remove();
                $("#sessionAll_alert").show();
                $("#sessionsAll-name").html(systemname);
                $("#loading").hide();
                // console.log("Device Name: " + dname);
                // console.log("Parent HTML: " + parent);
            }, 1000);
            setTimeout(function() {
                $("#sessionAll_alert").fadeOut(1000);
            }, 2000);
            // console.log($("#view_all_sessions .Field_session").length);
            if($("#view_all_sessions .Field_session").length == 1) {
                $("#no_sessions").show();
                /*setTimeout(function() {
                    $("#view_all_sessions").modal("hide");
                }, 2000);*/
            }
        });
        $("#activesession_entry4 button").click(function() {
            var parent = $(this).closest(".Field_session");
            var dname =  $(this).closest(".Field_session .device_name").html();
            var sessioncount = $("#sessions-blk .Field_session").length;
            var allsessioncount = $("#view_all_sessions .Field_session").length;
            $("#loading").show();
            setTimeout(function() {
                $(parent).remove();
                $("#activesession_entry1").remove();
                $("#sessionAll_alert").show();
                $("#sessionsAll-name").html(dname);
                $("#loading").hide();
                // console.log("Device Name: " + dname);
                // console.log("Parent HTML: " + parent);
            }, 1000);
            setTimeout(function() {
                $("#sessionAll_alert").fadeOut(1000);
            }, 2000);
            // console.log($("#view_all_sessions .Field_session").length);
            if($("#view_all_sessions .Field_session").length == 1) {
                $("#no_sessions").show();
            }
            if(sessioncount == 1) {
                $(".no_session").show();
                $("#sessions_showall").hide();
            } else {
                $(".no_session").hide();
                $("#sessions_showall").show();
            }
            if(allsessioncount == 1) {
                $("#no_sessions").show();
            } else {
                $("#no_sessions").hide();
            }
        });
        $("#activesession_entry5 button").click(function() {
            var parent = $(this).closest(".Field_session");
            var dname =  $(this).closest(".Field_session .device_name").html();
            var sessioncount = $("#sessions-blk .Field_session").length;
            var allsessioncount = $("#view_all_sessions .Field_session").length;
            $("#loading").show();
            setTimeout(function() {
                $(parent).remove();
                $("#activesession_entry2").remove();
                $("#sessionAll_alert").show();
                $("#sessionsAll-name").html(dname);
                $("#loading").hide();
               // console.log("Device Name: " + dname);
                // console.log("Parent HTML: " + parent);
            }, 1000);
            setTimeout(function() {
                $("#sessionAll_alert").fadeOut(1000);
            }, 2000);
            // console.log($("#view_all_sessions .Field_session").length);
            if($("#view_all_sessions .Field_session").length == 1) {
                $("#no_sessions").show();
            }
            if(sessioncount == 1) {
                $(".no_session").show();
                $("#sessions_showall").hide();
            } else {
                $(".no_session").hide();
                $("#sessions_showall").show();
            }
            if(allsessioncount == 1) {
                $("#no_sessions").show();
            } else {
                $("#no_sessions").hide();
            }
        });
        $("#activesession_entry6 button").click(function() {
            var parent = $(this).closest(".Field_session");
            var dname =  $(this).closest(".Field_session .device_name").html();
            var sessioncount = $("#sessions-blk .Field_session").length;
            var allsessioncount = $("#view_all_sessions .Field_session").length;
            $("#loading").show();
            setTimeout(function() {
                $(parent).remove();
                $("#activesession_entry3").remove();
                $("#sessionAll_alert").show();
                $("#sessionsAll-name").html(dname);
                $("#loading").hide();
               // console.log("Device Name: " + dname);
                // console.log("Parent HTML: " + parent);
            }, 1000);
            setTimeout(function() {
                $("#sessionAll_alert").fadeOut(1000);
            }, 2000);
            // console.log($("#view_all_sessions .Field_session").length);
            if($("#view_all_sessions .Field_session").length == 1) {
                $("#no_sessions").show();
            }
            if(sessioncount == 1) {
                $(".no_session").show();
                $("#sessions_showall").hide();
            } else {
                $(".no_session").hide();
                $("#sessions_showall").show();
            }
            if(allsessioncount == 1) {
                $("#no_sessions").show();
            } else {
                $("#no_sessions").hide();
            }
        });

        $("#clients").on("change", function() {
            $("#sessions-blk").css("height", "382px");
            $("#loading").show();
            setTimeout(function() {
                $("#all_sessions_active").css("opacity", "0");
                setTimeout(function() {
                    $("#all_sessions_active").css("opacity", "1");
                    $("#sessions-blk .kt-portlet__head-label h3").html("{{trans('sessions.session_index_blade.active_sessions_txt')}}");
                    setTimeout(function() {
                        $("#loading").hide();
                    }, 500);
                }, 500);
            }, 1000);
        });

        $("ul.multiselect-container li a label.kt-checkbox").on("click", function() {
            var admin = $(this).text();
            $("#sessions-blk").css("height", "382px");
            $("#loading").show();
            setTimeout(function() {
                $("#all_sessions_active").css("opacity", "0");
                setTimeout(function() {
                    $("#all_sessions_active").css("opacity", "1");
                    $("#sessions-blk .kt-portlet__head-label h3").html("{{trans('sessions.session_index_blade.active_session_head')}}");
                    setTimeout(function() {
                        $("#loading").hide();
                    }, 500);
                }, 500);
            }, 1000);
        });
        /*$("body")on("click",function() {
            $("#sessions-blk").removeAttr("style");
        });*/
        
    });
</script>
@endsection
@section('content')

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="NaFyGWWH">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="yrVkhlQd">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="HleZhxEB">
    <div class="col-md-12" data-name="ZxPVKqUG">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" id="filters" data-name="GZBSyuVa">
            <div class="kt-portlet__body" data-name="RBHZklgL">
                @include('includes.view-pages-filter')
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<div class="loading" id="loading" data-name="PmEuGvjV"><div class="loader" data-name="sUvtstmK"></div></div>
<div class="row" data-name="bSmVoiQv">
    <div class="col-md-12" data-name="RhxsulZk">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" id="sessions-blk" data-name="HPQBZmES">
            <div class="kt-portlet__head" data-name="RyECjITp">
                <div class="kt-portlet__head-label" data-name="IRrzcVUb">
                    <h3 class="kt-portlet__head-title">{{trans('app.session.active')}}</h3>
                    <div class="discrption" data-name="lehHHCxJ">{{trans('app.session.manage')}}</div>
                </div>
            </div>
            <div class="kt-portlet__body no-padding" data-name="JxNgcyTB">
                <input type="hidden" id="link-session" value="1">
                <div class="no_session" data-name="XJhDPGZX">
                    <div class="image_block" data-name="rKjOuFCn">
                        <img src="/public/img/no-session.png" width="100" height="100">
                    </div>
                    <div data-name="ShCJAFfQ">{{ trans('users.session.no_record') }}</div>
                </div>
                <div id="all_sessions_active" class="baseblock" data-name="TyDJwDXN">
                    <div id="current_sesion" data-name="RbkugsWW">
                        <div class="Field_session" id="activesession_entry1" onclick="show_selected_session(1);" data-name="QqUBWrTA">
                            <div class="info_tab" data-name="ScPRSbsn">  
                                    
                                <div class="device_div" data-name="SxLlQksB">
                                    <span class="device_pic device_personalcomputer"></span>
                                    <span class="device_details">
                                        <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                                        <span class="device_time">{{trans('sessions.session_index_blade.device_time_seconds')}} </span>
                                    </span>
                                </div>
                                <div class="activesession_entry_info" data-name="ncOXgSvD">
                                    <div class="asession_os os_windows" data-tippy="" data-original-title="Windows 10.0" data-name="wtyTrKIZ"></div>
                                    <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="CvhRNlxB"></div>
                                    <div class="asession_ip hide" data-name="csuEcvZh">182.180.148.77</div>
                                    <div class="asession_location" data-name="DPiPDCzD">{{trans('sessions.session_index_blade.div_chishtian_mandi')}} </div>
                                    <div class="asession_action current" data-name="PtXIrpwZ">{{trans('sessions.index.csid')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="other_sesion" data-name="bNRQUvjh">
                        <div class="Field_session" id="activesession_entry2" onclick="show_selected_session(2);" data-name="ZFHKabLo">  
                            <div class="info_tab" data-name="DeURGlmG">  
                                <div class="device_div" data-name="QjHzhYOa">
                                    <span class="device_pic device_mobiledevice"></span>
                                    <span class="device_details">
                                        <span class="device_name">{{trans('sessions.session_index_blade.device_name_mobile')}}</span>
                                        <span class="device_time">8 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                    </span>
                                </div>
                                <div class="activesession_entry_info" data-name="QIUsNifF">
                                    <div class="asession_os os_android" data-tippy="" data-original-title="Windows 10.0" data-name="nWTbqLJT"></div>
                                    <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="rIUjgybY"></div>
                                    <div class="asession_ip hide" data-name="TaWkpjnw">182.180.148.77</div>
                                    <div class="asession_location" data-name="TgsNktGt">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                    <div class="asession_action session_logout" data-name="VoAGUOXc">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="Field_session" id="activesession_entry3" onclick="show_selected_session(3);" data-name="eHGzCldX">
                            <div class="info_tab" data-name="mkKXDyzA">
                                <div class="device_div" data-name="TTpkdumQ">
                                    <span class="device_pic device_personalcomputer"></span>
                                    <span class="device_details">
                                        <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                                        <span class="device_time">13 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                        
                                    </span>
                                </div>
                                <div class="activesession_entry_info" data-name="rVeXeQLw">
                                    <div class="asession_os os_windows" data-tippy="" data-original-title="Windows 10.0" data-name="OVHTLMeY"></div>
                                    <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="CMznHLcV"></div>
                                    <div class="asession_ip hide" data-name="vggZeutH">182.180.148.77</div>
                                    <div class="asession_location" data-name="qyAStNHF">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                    <div class="asession_action session_logout" data-name="XQbYrCFg">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="icon-showall" id="sessions_showall" onclick="show_all_sessions()" data-name="IYqcLPkC"><i class="la la la-bars"></i> <span>{{trans('common.label.View_more')}}</span></div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="session-mini-popup" tabindex="-1" role="dialog" aria-labelledby="integration" data-backdrop="static" data-keyboard="false" aria-modal="true" data-name="rUdOpVWO">
    <div class="modal-dialog modal-dialog-centered" role="document" data-name="wtGxRNmw">
        <div class="modal-content" data-name="QojdGmoP">
            <div class="modal-body" data-name="NOLehIbx">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="alert alert-success alert-dismissible" id="session_alert" role="alert" data-name="MlcMOqOA">
                    <span class="alert-msg">{{trans('sessions.session_index_blade.span_session_account')}}  <span id="sessions-name"></span> {{trans('sessions.session_index_blade.span_successfully_removed')}}</span>
                </div>
                <div class="device_div on_popup" data-name="mmIBBpzV">
                    <span id="device_pic" class="device_personalcomputer"></span>
                    <span class="device_details">
                        <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                        <span class="device_time">{{trans('sessions.session_index_blade.device_time_seconds')}}</span>
                    </span>
                </div>
                <div id="sessions_current_info" class="list_show" data-name="RYApFvUj">
                    <div class="info_div" data-name="QuFEDrLQ">
                        <div class="info_lable" data-name="NmaRWORL">{{trans('sessions.session_index_blade.started_time_div')}} </div>
                        <div class="info_value" id="pop_up_time" data-name="NImdojTt">1/22/20</div>
                    </div>
                    <div class="info_div" data-name="MRREZeiF">
                        <div class="info_lable" data-name="wogdCSNF">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                        <div class="info_value" id="pop_up_os" data-name="QyNxLiEW"><div class="asession_os_popup minios_windows" data-name="dBwZcZUI"></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span></div>
                    </div>
                    <div class="info_div" data-name="LfMbCFdX">
                        <div class="info_lable" data-name="qNEleNAr">{{trans('sessions.index.th.browser')}}</div>
                        <div class="info_value" id="pop_up_browser" data-name="QrxCERTN"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                    </div>
                    <div class="info_div" data-name="FxMziFoX">
                        <div class="info_lable" data-name="vJqmXfPf">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                        
                        <div class="info_value location_unavail" id="pop_up_location" data-name="BYeXDItw">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                         
                        <div class="info_ip" data-name="BNrWTogE"></div>
                    </div>                                 
                </div>
                <button id="current_session_remove" class="btn btn-danger" style="display: none;">{{trans('sessions.session_index_blade.terminate_txt')}}</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="view_all_sessions" tabindex="-1" role="dialog" aria-labelledby="integration" data-backdrop="static" data-keyboard="false" aria-modal="true" data-name="pVBeSdzO">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" data-name="mddJMQDO">
        <div class="modal-content" data-name="ooxNkcqQ">
            <div class="modal-body no-padding popupblock" data-name="UoMGqEUP">
                <div class="box_info" data-name="FYQUhQhH">
                    <div class="box_head" data-name="vDqLlMMS">{{trans('sessions.session_index_blade.active_sessions_txt')}}<span class="icon-info"></span></div>
                    <div class="box_discrption" data-name="OQvvSqmp">{{trans('sessions.session_index_blade.view_manage_active_div')}} </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="alert alert-success alert-dismissible" id="sessionAll_alert" role="alert" data-name="TzeGQrll">
                    <span class="alert-msg">{{trans('sessions.session_index_blade.span_session_account')}} <span id="sessionsAll-name"></span> {{trans('sessions.session_index_blade.span_successfully_removed')}}</span>
                </div>
                <div id="no_sessions" class="box_content_div" data-name="YtyQcVaD">
                    <div class="no_data" data-name="aeQcpQEL"></div>
                    <div class="no_data_text" data-name="pLbqAzSp">{{trans('sessions.session_index_blade.do_not_session_account')}}  </div>
                </div>
                <div id="current_sesion" data-name="POzjUtPT">
                    <div class="Field_session" id="activesession_entry4" data-name="sYbxKONV">
                        <div class="info_tab" data-name="siHKVRAb">  
                            <div class="device_div" data-name="rzeQhBVt">
                                <span class="device_pic device_personalcomputer"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                                    <span class="device_time">1 {{trans('sessions.session_index_blade.span_hour_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" data-name="SClJwGTN">
                                <div class="asession_os os_windows" data-tippy="" data-original-title="Windows 10.0" data-name="gIEVZigl"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="OxTUhoRx"></div>
                                <div class="asession_ip hide" data-name="hFFCoPol">182.180.148.77</div>
                                <div class="asession_location" data-name="YwLeNdEf">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action current" data-name="IwDZfxVQ">{{trans('sessions.index.csid')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info8" data-name="kAhUREAG">
                            <div class="info_div" data-name="eXYOXHGD">
                                <div class="info_lable" data-name="KBTcxWga">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="IpxFsssM">2/3/20</div>
                            </div>
                            <div class="info_div" data-name="LOifAVfM">
                                <div class="info_lable" data-name="gnvIAhuT">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="GptyxISc"><div class="asession_os_popup minios_windows" data-name="PWSDtKTq"></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span></div>
                            </div>
                            <div class="info_div" data-name="XPnoHpds">
                                <div class="info_lable" data-name="UoMtbSPU">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="WhvSkeos"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="uolBdQnr">
                                <div class="info_lable" data-name="GesgMXiH">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="YzJqYnNT">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="tTSmojpi"></div>
                            </div> 
                            <button class="btn btn-danger">
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                   
                        </div>
                    </div>
                </div>
                <div id="other_sesion" data-name="QovHInnA">
                    <div class="Field_session" id="activesession_entry5" data-name="eRHyGpGE">
                        <div class="info_tab" data-name="QtpHFKzo">
                            <div class="device_div" data-name="PToeWNze">
                                <span class="device_pic device_mobiledevice"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_mobile')}}</span>
                                    <span class="device_time">12 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="kKjMYWWd">
                                <div class="asession_os os_android" data-tippy="" data-original-title="Windows 10.0" data-name="WXsYXqVT"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="qZofnSmd"></div>
                                <div class="asession_ip hide" data-name="mwILiReL">182.180.148.77</div>
                                <div class="asession_location" data-name="LpyDbkcw">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="sWwOULdP">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info1" style="display: none;" data-name="uecGQbOB">
                            <div class="info_div" data-name="sobvDiwt">
                                <div class="info_lable" data-name="EGLhaldU">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="ZJZffail">1/22/20</div>
                            </div>
                            <div class="info_div" data-name="tpgSmwhl">
                                <div class="info_lable" data-name="iFnSmayV">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="PYTVSqkw"><div class="asession_os_popup minios_android" data-name="oWUKbbwD"></div><span>{{trans('sessions.session_index_blade.android_span')}} 7.1</span></div>
                            </div>
                            <div class="info_div" data-name="ythWRuaX">
                                <div class="info_lable" data-name="YjeNeDbg">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="qjEDXknY"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="GYSltPOK">
                                <div class="info_lable" data-name="OsZTbYou">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="LnvmfvkZ">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="afIkrYzK"></div>
                            </div>
                            <button class="btn btn-danger">
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry6" data-name="wAFlStrJ">
                        <div class="info_tab" data-name="OUKXJwcT">
                            <div class="device_div" data-name="ZomhXdRs">
                                <span class="device_pic device_personalcomputer"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                                    <span class="device_time">7 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="gMojZwJX">
                                <div class="asession_os os_windows" data-tippy="" data-original-title="Windows 10.0" data-name="ubWmfgft"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="UsWAmKws"></div>
                                <div class="asession_ip hide" data-name="jOXvpLhS">182.180.148.77</div>
                                <div class="asession_location" data-name="tPLHHbii">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="MiUUxVlz">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info2" style="display: none;" data-name="dGhQsGJC">
                            <div class="info_div" data-name="EIOzRFoY">
                                <div class="info_lable" data-name="LGUitxfW">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="yxPPbUGp">1/27/20</div>
                            </div>
                            <div class="info_div" data-name="fHyjijzB">
                                <div class="info_lable" data-name="FyqXbKnG">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="MPlQTYmL"><div class="asession_os_popup minios_windows" data-name="hbWNZQgz"></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span></div>
                            </div>
                            <div class="info_div" data-name="oSiYEpgv">
                                <div class="info_lable" data-name="kbDVUqon">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="ktfljvxm"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="XzfQlXWJ">
                                <div class="info_lable" data-name="HmhzXIsI">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="pXlzrXmy">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="HFKOSbxg"></div>
                            </div>
                            <button class="btn btn-danger" >
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry7" data-name="mYShlhlE">
                        <div class="info_tab" data-name="PyYkJdto">
                            <div class="device_div" data-name="LtUWMapi">
                                <span class="device_pic device_mobiledevice"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_mobile')}}</span>
                                    <span class="device_time">12 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="WsiFdZTP">
                                <div class="asession_os os_android" data-tippy="" data-original-title="Windows 10.0" data-name="zcehymdW"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="kDlOlCOF"></div>
                                <div class="asession_ip hide" data-name="kYcVPCVk">182.180.148.77</div>
                                <div class="asession_location" data-name="YHkrLYxd">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="bwKfzDgz">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info1" style="display: none;" data-name="hMfPYEws">
                            <div class="info_div" data-name="wqsKhHpF">
                                <div class="info_lable" data-name="nlCFTtHj">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="PsgDHUMk">1/22/20</div>
                            </div>
                            <div class="info_div" data-name="UnmeVNDu">
                                <div class="info_lable" data-name="iCwLoQxM">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="qbbApagz"><div class="asession_os_popup minios_android" data-name="SjioDuXT"></div><span>{{trans('sessions.session_index_blade.android_span')}} 7.1</span></div>
                            </div>
                            <div class="info_div" data-name="kPDGUzXy">
                                <div class="info_lable" data-name="CvWuHdao">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="cLBhMWzk"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="jznlHJKd">
                                <div class="info_lable" data-name="BYevKVxe">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="pnlrHfBZ">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="KmlhrBpj"></div>
                            </div>
                            <button class="btn btn-danger">
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry8" data-name="DGTvExZz">
                        <div class="info_tab" data-name="SZGBmCMK">
                            <div class="device_div" data-name="JFnhhjoP">
                                <span class="device_pic device_personalcomputer"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                                    <span class="device_time">7 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="zzgzVoVG">
                                <div class="asession_os os_windows" data-tippy="" data-original-title="Windows 10.0" data-name="ZYUYipLk"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="JqVxJTpO"></div>
                                <div class="asession_ip hide" data-name="dOsfLQOU">182.180.148.77</div>
                                <div class="asession_location" data-name="JQQsyMbr">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="LVrrUCkQ">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info2" style="display: none;" data-name="tjfQyxzn">
                            <div class="info_div" data-name="gkwqCUtC">
                                <div class="info_lable" data-name="LIzqLPhD">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="TBWqMrFz">1/27/20</div>
                            </div>
                            <div class="info_div" data-name="SipRvGll">
                                <div class="info_lable" data-name="lEODmsnv">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="RaOFIJdo"><div class="asession_os_popup minios_windows" data-name="vFOewCpD"></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span></div>
                            </div>
                            <div class="info_div" data-name="kcXgXuxO">
                                <div class="info_lable" data-name="pTKYftSW">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="jPTtusgH"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="CkUpNbpQ">
                                <div class="info_lable" data-name="RKaFgYel">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="gSiwIhdQ">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="qDgWyRcX"></div>
                            </div>
                            <button class="btn btn-danger" >
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry9" data-name="fqNVkEad">
                        <div class="info_tab" data-name="zzLWoKxn">
                            <div class="device_div" data-name="vqXNqeZx">
                                <span class="device_pic device_mobiledevice"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_mobile')}}</span>
                                    <span class="device_time">12 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="IZDbRyOg">
                                <div class="asession_os os_android" data-tippy="" data-original-title="Windows 10.0" data-name="uKITDMdz"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="ZcwfelBL"></div>
                                <div class="asession_ip hide" data-name="VkmdWyqj">182.180.148.77</div>
                                <div class="asession_location" data-name="ZeooUTqf">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="CMuYMFGA">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info1" style="display: none;" data-name="kikDtMos">
                            <div class="info_div" data-name="FSJWnlRG">
                                <div class="info_lable" data-name="CdhHKNDo">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="WecyaIer">1/22/20</div>
                            </div>
                            <div class="info_div" data-name="BglnrsWD">
                                <div class="info_lable" data-name="RcUoceIL">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="ldlVwFpk"><div class="asession_os_popup minios_android" data-name="eYoSMtUT"></div><span>{{trans('sessions.session_index_blade.android_span')}} 7.1</span></div>
                            </div>
                            <div class="info_div" data-name="vztHnjdt">
                                <div class="info_lable" data-name="nqsvOQSD">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="xGLLvVgF"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="xUaeZnqC">
                                <div class="info_lable" data-name="TIrdGRRy">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="AUKgohLQ">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="oSQpxkDd"></div>
                            </div>
                            <button class="btn btn-danger">
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry10" data-name="ByLRiZJu">
                        <div class="info_tab" data-name="VXABocop">
                            <div class="device_div" data-name="GXqDxUXq">
                                <span class="device_pic device_personalcomputer"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                                    <span class="device_time">7 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="YYASobCC">
                                <div class="asession_os os_windows" data-tippy="" data-original-title="Windows 10.0" data-name="CSVTNsnk"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="OgIvWWii"></div>
                                <div class="asession_ip hide" data-name="KETnaJKM">182.180.148.77</div>
                                <div class="asession_location" data-name="VbBZefMc">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="HknhmyjQ">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info2" style="display: none;" data-name="ECmilHmO">
                            <div class="info_div" data-name="eTarheNg">
                                <div class="info_lable" data-name="uWMNYMkk">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="gFvwjSAh">1/27/20</div>
                            </div>
                            <div class="info_div" data-name="GsJUPNsk">
                                <div class="info_lable" data-name="CyKsXSiZ">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="nUJjrGFy"><div class="asession_os_popup minios_windows" data-name="rrnxiSTv"></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span></div>
                            </div>
                            <div class="info_div" data-name="TQxFNzNF">
                                <div class="info_lable" data-name="ggZJLyMH">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="RktWgasj"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="apMgmjkM">
                                <div class="info_lable" data-name="liKcPkcb">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="wpTTriln">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="sVkEVELP"></div>
                            </div>
                            <button class="btn btn-danger" >
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry11" data-name="XbZgvNDr">
                        <div class="info_tab" data-name="qZPpqVFx">
                            <div class="device_div" data-name="DEoeDqaC">
                                <span class="device_pic device_mobiledevice"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_mobile')}}</span>
                                    <span class="device_time">12 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="VeidtnQH">
                                <div class="asession_os os_android" data-tippy="" data-original-title="Windows 10.0" data-name="KPMmrYGG"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="JgrkJaAt"></div>
                                <div class="asession_ip hide" data-name="ZKYuJdkI">182.180.148.77</div>
                                <div class="asession_location" data-name="SrUBAFrl">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="qPpMzMmQ">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info1" style="display: none;" data-name="KZjStaIO">
                            <div class="info_div" data-name="XujHFnur">
                                <div class="info_lable" data-name="RgfCchlj">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="pNloXuat">1/22/20</div>
                            </div>
                            <div class="info_div" data-name="tNMUxXcW">
                                <div class="info_lable" data-name="BtMlGRSR">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="tyMxbmBl"><div class="asession_os_popup minios_android" data-name="OyXeVJrZ"></div><span>{{trans('sessions.session_index_blade.android_span')}} 7.1</span></div>
                            </div>
                            <div class="info_div" data-name="EXnivUjo">
                                <div class="info_lable" data-name="lJBCXQzu">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="fzKRtJUM"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="JWSLqnDw">
                                <div class="info_lable" data-name="HlePfuQj">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="RLpuPTHf">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="Lslntmps"></div>
                            </div>
                            <button class="btn btn-danger">
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry12" data-name="YVlrCAUo">
                        <div class="info_tab" data-name="wvbLRjiB">
                            <div class="device_div" data-name="NicSttNa">
                                <span class="device_pic device_personalcomputer"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                                    <span class="device_time">7 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="yjxIIlNu">
                                <div class="asession_os os_windows" data-tippy="" data-original-title="Windows 10.0" data-name="PPTcKfgE"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="nCRhSWxu"></div>
                                <div class="asession_ip hide" data-name="zHCEMhuu">182.180.148.77</div>
                                <div class="asession_location" data-name="thWqtXLK">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="JzFNkNdH">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info2" style="display: none;" data-name="taGTEQYR">
                            <div class="info_div" data-name="DrYthAde">
                                <div class="info_lable" data-name="NNQeHOoH">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="VNXVCbHd">1/27/20</div>
                            </div>
                            <div class="info_div" data-name="uVqshiqQ">
                                <div class="info_lable" data-name="yMyrOqPb">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="IhODGGcP"><div class="asession_os_popup minios_windows" data-name="QwXqVKrp"></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span></div>
                            </div>
                            <div class="info_div" data-name="XsWenMTe">
                                <div class="info_lable" data-name="CBaSglwH">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="hffJeGli"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="TZSYBGuH">
                                <div class="info_lable" data-name="aeQgBeBo">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="OzFkxQQK">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="nBbCYPgw"></div>
                            </div>
                            <button class="btn btn-danger" >
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry13" data-name="cgmMYygx">
                        <div class="info_tab" data-name="YvCgQPWg">
                            <div class="device_div" data-name="LTtxOYVD">
                                <span class="device_pic device_mobiledevice"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_mobile')}}</span>
                                    <span class="device_time">12 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="sjMguJqa">
                                <div class="asession_os os_android" data-tippy="" data-original-title="Windows 10.0" data-name="CfLjkKsS"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="buLMsRaR"></div>
                                <div class="asession_ip hide" data-name="TrYPSueK">182.180.148.77</div>
                                <div class="asession_location" data-name="AiGkJyOd">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="kTsiBFDK">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info1" style="display: none;" data-name="YHxKFjtV">
                            <div class="info_div" data-name="FHdQVyto">
                                <div class="info_lable" data-name="gsmAXlfR">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="CzCoOMZD">1/22/20</div>
                            </div>
                            <div class="info_div" data-name="uHTSUBwT">
                                <div class="info_lable" data-name="RIVFPvjf">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="xlTHrBxb"><div class="asession_os_popup minios_android" data-name="DaqCfqRg"></div><span>{{trans('sessions.session_index_blade.android_span')}} 7.1</span></div>
                            </div>
                            <div class="info_div" data-name="wrBEzGhm">
                                <div class="info_lable" data-name="RcOsdlqq">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="FsgwNCmx"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="KYPxHjcs">
                                <div class="info_lable" data-name="hpzNINYb">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="lQMYxaIc">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="HVoUycWY"></div>
                            </div>
                            <button class="btn btn-danger">
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                    <div class="Field_session" id="activesession_entry14" data-name="IUJFsxbm">
                        <div class="info_tab" data-name="CSSovvpV">
                            <div class="device_div" data-name="dpBsmzhF">
                                <span class="device_pic device_personalcomputer"></span>
                                <span class="device_details">
                                    <span class="device_name">{{trans('sessions.session_index_blade.device_name_computer')}}</span>
                                    <span class="device_time">7 {{trans('sessions.session_index_blade.device_time_days_ago')}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="FCFoBKEP">
                                <div class="asession_os os_windows" data-tippy="" data-original-title="Windows 10.0" data-name="QjWPVHYk"></div>
                                <div class="asession_browser browser_googlechrome" data-tippy="" data-original-title="Google Chrome 79" data-name="fdpiYlaE"></div>
                                <div class="asession_ip hide" data-name="JoxIUbDn">182.180.148.77</div>
                                <div class="asession_location" data-name="frjNKYRu">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="asession_action session_logout" data-name="idFSpCRk">{{trans('sessions.session_index_blade.terminate_txt')}}</div>
                            </div>
                        </div>
                        <div class="aw_info" id="activesession_info2" style="display: none;" data-name="cqAzmOIj">
                            <div class="info_div" data-name="JxyydPDZ">
                                <div class="info_lable" data-name="FlifqOPR">{{trans('sessions.session_index_blade.started_time_div')}}</div>
                                <div class="info_value" id="pop_up_time" data-name="qzcNgBtX">1/27/20</div>
                            </div>
                            <div class="info_div" data-name="VqctOomt">
                                <div class="info_lable" data-name="IaKqLAts">{{trans('sessions.session_index_blade.div_operating_system')}}</div>
                                <div class="info_value" id="pop_up_os" data-name="ugAnZwKH"><div class="asession_os_popup minios_windows" data-name="cSgUOShR"></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span></div>
                            </div>
                            <div class="info_div" data-name="gbRvDDgQ">
                                <div class="info_lable" data-name="tBSsNcxH">{{trans('sessions.index.th.browser')}}</div>
                                <div class="info_value" id="pop_up_browser" data-name="NRaliOfw"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}}</span></div>
                            </div>
                            <div class="info_div" data-name="UdTTaClY">
                                <div class="info_lable" data-name="EZEbkgyt">{{trans('sessions.session_index_blade.location_div_txt')}}</div>
                                <div class="info_value location_unavail" id="pop_up_location" data-name="VnHpByiV">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                                <div class="info_ip" data-name="IjkwsnHb"></div>
                            </div>
                            <button class="btn btn-danger" >
                                <span>{{trans('sessions.session_index_blade.terminate_txt')}}</span>
                            </button>                                  
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->
@endsection