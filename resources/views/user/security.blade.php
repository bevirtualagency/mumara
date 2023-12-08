@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/session.css?v={{rand(0,1)}}.01">
<link rel="stylesheet" type="text/css" href="/resources/assets/css/passtrengths.css?v={{rand(0,1)}}.01">
@endsection
@section('page_scripts')
<script type="text/javascript" src="/themes/default/js/passtrengths.js"></script>
<script type="text/javascript" src="/themes/default/js/ip_addresses.js"></script>
<script type="text/javascript" src="{{ asset('themes/default/js/includes/form-validator.js') }}"></script>
<script type="text/javascript">
    function showMiniModal(ip,id,geo_info,date,time,name) {
        $('.loc').html(geo_info);
        $('#popup_ipname').html(ip);
        $('.range_name').html(name);
        $('.device_time').html(time);
        $('#pop_up_time_c').html(date);
        $('#m_name').html(name.substring(0, 2));
        $('#popup_ip_show_small').modal('show');
        method = 'delete_ip("'+ip+'","'+id+'")';
        $('#current_ip_del').attr('onclick',method);
    }
    function delete_ip(ip,id) {
        $.ajax({
            url: "{{route('deleteIp')}}",
            type: "POST",
            data:{'ip':ip},
            dataType:'json',
            beforeSend: function() {
                $("#loading").show();
            },
            success: function(result) {
                $("#loading").hide();
                if(result.status)
                {
                    var div_2 = $('#allowed_ip_entry1'+id);
                    var div_popup = $('#popup_ip_block'+id);
                    div_2.slideUp('slow');
                    div_popup.slideUp('slow');
                    $("#popup_ip_show_small").modal("hide");
                    $("#ip-terminate-small").show();
                    setTimeout(function() {
                        $("#session_alert").hide();
                        $("#sessions-name").html("");
                    },500);
                    setTimeout(function() {
                        $("#ip-terminate-small").fadeOut(1500);
                    }, 1000);
                }
            }
        });
    }
    function deleteSession(id,div_id) {
        $.ajax({
            url: "{{route('unsetSession')}}",
            type: "POST",
            data:{'sid':id},
            dataType:'json',
            beforeSend: function() {
                $("#loading").show();
            },
            success: function(result) {
                $("#loading").hide();
                if(result.status)
                {
                    var div = $('#activesession_entry'+div_id);
                    var div_2 = $('#as_'+div_id);
                    div.slideUp('slow');
                    div_2.slideUp('slow');
                    $("#session-mini-popup").modal("hide");
                    setTimeout(function() {
                        $("#session_alert").hide();
                        $("#sessions-name").html("");
                    },500);
                }
                var sessioncount = $("#sessions-blk .Field_session").length;
                var allsessioncount = $("#view_all_sessions .Field_session").length;
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

            }
        });
    }
    function showModal(key,div_id) {
        var method = 'deleteSession("'+key+'","'+div_id+'")';
        $('#current_session_remove').attr('onclick',method);
        setTimeout(function() {
            $('#current_session_remove').show();
        }, 300);
    }
    function show_selected_session(el,human_readable_time,time,os,browser,location,ip) {
        $("#session-mini-popup").modal("show");
        $("#link-session").val(el);
        // console.log(el);
            $("#current_session_remove").hide();
            setTimeout(function() {
                $('#device_pic').removeClass('device_personalcomputer device_mobiledevice');
                var class_ = 'device_mobiledevice';
                var device = 'Phone';
                if(os=='windows') {
                    class_ = 'device_personalcomputer';
                    device = 'Computer';
                }
                $('#device_pic').addClass(class_);
                var osClasses = {"iPhone":"os_mac", "Android":"os_android", "linux":"os_linux","mac":"os_mac","windows":"os_windows","Unknown":"Unknown"};
                var browserClasses = {"Unknown":"Unknown","Internet Explorer":"browser_iexplorer","Mozilla Firefox":"browser_firefox","Opera":"browser_opera","Google Chrome":"browser_googlechrome","Apple Safari":"browser_safari"};
             //   $("#session-mini-popup #device_pic").removeClass("device_mobiledevice").addClass("device_personalcomputer");
                $("#session-mini-popup .device_name").html(device);
                $("#session-mini-popup .device_time").html(human_readable_time);
                $("#session-mini-popup #pop_up_time").html(time);
                $("#session-mini-popup #pop_up_os").html('<div class="asession_os_popup mini'+osClasses[os]+'"></div><span>'+os+'</span>');
                $("#session-mini-popup .pop_up_location").html(location);
                $("#session-mini-popup .pop_up_ip").html('<span class="pop-img-ip"></span> '+ip);
                $("#session-mini-popup #pop_up_browser").html('<div class="info_value" id="pop_up_browser"><span class="asession_browser_popup mini'+browserClasses[browser]+'"></span><span>'+browser+'</span></div>');
                }, 200);

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
            }
        });
        $(".as").click(function() {
            var id =  $(this).attr('id');
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
                    $("#sessions-blk .kt-portlet__head-label h3").html("{{trans('sessions.session_index_blade.active_sessions_txt')}}");
                    setTimeout(function() {
                        $("#loading").hide();
                    }, 500);
                }, 500);
            }, 1000);
        });
    });
</script>
<script>
    function togglePass(ele){
        if($("#password").attr("type")=="password"){
            $("#password").attr("type","text");
            $("#confirm_password").attr("type","text");
            $(ele).addClass("pass_hide");
        }   
        else{
            $("#password").attr("type","password");
            $("#confirm_password").attr("type","password");
            $(ele).removeClass("pass_hide");
        }
    }
    function check_pp()
    {
        if($("#password").val()=="")
        {
            $(".pass_policy").show();
            $(".pass_policy_error").hide();
        }
        else
        {
            $(".pass_policy").hide();
            $(".pass_policy_error").show();

            var pass = $("#password").val();
            if(pass.length>7) {
                $(".pass_policy").hide();
                $(".pass_policy_error").hide();
            } else {
                 $(".pass_policy").hide();
                $(".pass_policy_error").show();
            }
        }    
    }
    function enableOrDisable2fa() {
          @if(config('app.type') =="demo")
              Command: toastr["error"] ("@lang('common.label.demo_service_not_available')");
            return false;
            @endif
        // console.log("check error");
        if ($('#2fa').is(':checked')) {
            // console.log("1111");
            $('#2fa').prop('checked', false);
        } else {
            // console.log("2222");
            $('#2fa').prop('checked', true);
        }
        $('#twofaModal').modal("show");
    }
    function handleForm(form_id, route, hide_div_id_1) {
        $.ajax({
            type: 'POST',
            url: route,
            cache: false,
            data: $('#' + form_id).serialize(),
            dataType: 'json',
            beforeSend: function() {
                $('#twoFA_modal_alert').hide();
                $('#bc_code_div').hide();
                $('#twoFA_modal_alert').removeClass('alert-success alert-danger');
                $('.blockUI').show();
                $('.form-control').removeClass('is-invalid');
                $('.error').css('display', 'none');
            },
            success: function(data) {
                $('.blockUI').hide();
                if (data.status) {
                    $('#' + hide_div_id_1).hide();
                    if (form_id == 'f_step') {
                        $('#2fa_img').attr('src', data.url).show();
                        $('#second_step').show();
                        $('#alt-code').text('"' + data.secret + '"');
                    } else if (form_id == 's_step') {
                        $('#twoFA_modal_alert2').text(data.message).show();
                        $('#bc_code').text(data.back_up_code);
                        $('#br-code').text(data.back_up_code);
                        $('#bc_code_div').show();
                        $('#enable_2fa').hide();
                        $('#2fa').prop('checked', true);
                        $("#twofaModal .modal-footer").show();
                        $("#dismiss_btn").html("Finished");
                        $("#close, #dismiss_btn").click(function() {
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                           // console.log("Enabled and Closed");
                        });
                    } else {
                        $('#twoFA_modal_alert').addClass('alert-success');
                        $('#twoFA_modal_alert').css("text-align", "center");
                        $('#twoFA_modal_alert').css("display", "block");
                        $('#twoFA_modal_alert').text(data.message).show();
                        $("#third_step").hide();
                        $("#dismiss_btn").html("Finished");
                        $('#2fa').prop('checked', false);
                        setTimeout(function() {
                            $("#twofaModal").modal("hide");
                            location.reload();
                        }, 2000);
                        $("#close").click(function() {
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                           // console.log("Disabled and Closed");
                        });
                    }
                } else if (data.validation_failed) {
                    var x;
                    messages = data.messages;
                    for (x in messages) {
                        $('#' + x).addClass('is-invalid');
                        id = '#' + x + '-error';
                        $(id).html(messages[x]);
                        $(id).css('display', 'block');
                    }
                } else {
                    $('#twoFA_modal_alert').addClass('alert-danger');
                    $('#twoFA_modal_alert').text(
                            "@lang('security.message.code_not_matched')")
                        .show();
                }

                return false;
            },
            error: function(jqXHR, status, err) {
                $('.blockUI').hide();
                if (jqXHR.responseJSON.message !== undefined) {
                    $('#twoFA_modal_alert').addClass('alert-danger');
                    $('#twoFA_modal_alert').text(jqXHR.responseJSON.message);
                    $('#twoFA_modal_alert').show();
                }
            }
        });
    }
    if ($("#2fa").is(":checked")) {
        $("#twofaModal .modal-header").html(
            '<i class="la la-info-circle"></i><h5 class="modal-title" id="twoMT"></h5><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>'
        );
        $("#twoMT").html("@lang('users.profile.Disable_Two_Factor')");
        $("#twofaModal .modal-header").addClass("disable2fa");
        $("#twofaModal .modal-footer").hide();
    } else {
        $("#twoMT").html("@lang('users.profile.Enable_Two_Factor')");
    }
    $(document).ready(function(){

        $('#password').passtrength({
          minChars: 8,
          passwordToggle: true,
          tooltip: true
        });
        $("#forgot-pass").click(function() {
            $(".password-section").hide();
            $(".email-section").show();
        });
        $("#backpass").click(function() {
            $(".email-section").hide();
            $(".password-section").show();
        });
        $("body").on("click" , "#updatePassword" , function(e) {
            var formId = '#changePassword';
            var route = '{{route('updatePassword')}}';
            processFrom('POST',route,formId,e,'updatePassword','password-success','password-error');
        });
        $("body").on("click" , "#sendEmail" , function() {
            //var regEmail = $("#reg-email").val();
            $("#validemail").hide(); 
            $("#loading").show();
            var email = $("#reg-email").val();
            if($("#reg-email").val() == "") { 
                $("#forgot-password-success").hide(); 
                $("#validemail").show(); 
            } else {
                setTimeout(function() {
                    $("#loading").hide();
                    $("#backpass").hide();
                    $("#resetpassclose").css("display", "inline-block");
                    $("#forgot-password-success").show();
                    $("#forgot-password-success>.alert-msg").html("@lang('security.message.verification_link_sent')").show();
                },1000);
            }
        });
        $("#code-confirm").click(function() {
            $("#second_step .qr-codeBlk").hide();
            $("form#s_step").show();
        });
        $("#backtocode").click(function() {
            $("form#s_step").hide();
            $("#second_step .qr-codeBlk").show();
        });
        if ($("#2fa").is(":checked")) {
            $("#twofaModal .modal-header").html(
                '<i class="la la-info-circle"></i><h5 class="modal-title" id="twoMT"></h5><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>'
            );
            $("#twoMT").html("@lang('users.profile.Disable_Two_Factor')");
            $("#twofaModal .modal-header").addClass("disable2fa");
            $("#twofaModal .modal-footer").hide();
            $("#twofaModal #first_step").hide();
            $("#twofaModal #third_step").show();
        } else {
            $("#twoMT").html("@lang('users.profile.Enable_Two_Factor')");
            $("#twofaModal .modal-header").removeClass("disable2fa");
            $("#twofaModal #first_step").show();
            $("#twofaModal #third_step").hide();
        }
        $("#view_all_allow_ip .allowed_ip_entry").click(function(){
            var id= $(this).attr('id');
            // console.log(id);
            var bar = $("#"+id+">.info_tab>.activesession_entry_info");
            $(".allowed_ip_entry .activesession_entry_info").removeClass("show").addClass("hide");
            $(bar).addClass("show");
            $(this).children(".aw_info").slideDown("");
            $(".allowed_ip_entry").not(this).find(".aw_info").slideUp();
            $(".slidedown .activesession_entry_info").removeClass("hide").addClass("show");
            $("#"+id+".slidedown .activesession_entry_info").removeClass("show").addClass("hide");
            $(this).children(".activesession_entry_info").removeClass("show").addClass("hide");
            $("#ip-block-main .activesession_entry_info").removeClass("hide").addClass("show");
        });

        /*$("#view_all_allow_ip .allowed_ip_entry").click(function(){
            var id= $(this).attr('id');
            console.log(id);
            var bar = $("#"+id+">.info_tab>.activesession_entry_info");
            if($(bar).hasClass("hide")){
                $(".allowed_ip_entry .activesession_entry_info").removeClass("show").addClass("hide");
                $(this).children(".aw_info").slideUp("");
                $(".allowed_ip_entry").not(this).find(".aw_info").slideUp();
                $("#"+id+".slidedown .activesession_entry_info").addClass("show").removeClass("hide");
                $(".slidedown .activesession_entry_info").addClass("show").removeClass("hide");
                $(this).children(".activesession_entry_info").removeClass("hide").addClass("show");
                $("#ip-block-main .activesession_entry_info").removeClass("hide").addClass("show");
            } else {
                $(".allowed_ip_entry .activesession_entry_info").removeClass("show").addClass("hide");
                $(bar).addClass("show");
                $(this).children(".aw_info").slideDown("");
                $(".allowed_ip_entry").not(this).find(".aw_info").slideUp();
                $(".slidedown .activesession_entry_info").removeClass("hide").addClass("show");
                $("#"+id+".slidedown .activesession_entry_info").removeClass("show").addClass("hide");
                $(this).children(".activesession_entry_info").removeClass("show").addClass("hide");
                $("#ip-block-main .activesession_entry_info").removeClass("hide").addClass("show");
            }
        });*/
  
        $("#current_ip_del").click(function() {
            $("#loading").show();
            $("#ip-showall").hide();
            $("#btn-addnew2").removeClass("half");
            setTimeout(function() {
                $("#ip-terminate-small").show();
                $("#ip-terminate-small>.alert-msg").html("@lang('security.message.ip_terminated')");
                $("#loading").hide();
                if ($("#sm-ip-popup").val() == "1") {
                    $("#allowed_ip_entry1").hide();
                } else {
                    $("#allowed_ip_entry2").hide();
                    $("#static_ip").hide();
                    $("#current_ip").show();
                    $("#current_ip_sel").prop("checked", true);
                }
                if($("#allowed_ip_entry1").is(":hidden") && $("#allowed_ip_entry2").is(":hidden")) {
                    $("#allowed_ip_entry0").show();
                    $("#allowed_ip_entry2").hide();
                    $("#static_ip").hide();
                    $("#current_ip").show();
                    $("#current_ip_sel").prop("checked", true);
                    $("#IP_content").hide();
                    $(".no_ip_add_here").show();
                    $("#IP_content").hide();
                    $("#allowed_ip_entry1").show();
                    $("#sm-ip-terminate").val("0");
                    $(".no_ip_add_here .description").removeClass("hide");
                  //  console.log("terminate 0");
                }
                setTimeout(function() {
                    $("#popup_ip_show_small").modal("hide");
                    $("#ip-terminate-small").hide();
                    $("#sm-ip-terminate").val("1");
                   // console.log("terminate 1");
                }, 1000);
            }, 1000);
        });
        $("#allowed_ip_entry0").click(function() {
            $("#current_ip_sel").prop("checked", true);
            $("#static_ip_sel").prop("checked", false);
            $("#current_ip").show();
            $("#static_ip").hide();
            $("#range_ip").hide();
            $("#ip-address-error").hide();
            $("#ip-address-success").hide();
            $("#popup_ip_new").modal("show");
        });
  
        $("#add_new_ip").click(function() {
            var toIp =null;
            var ip_name = $("#ip_name").val();
            var ip_name2 = ip_name;
            var ip_address = $(".base-ip-name").html();
            if (ip_name == "") {
                $("#ip-name-blk>.field_error").show();
            }
            else  {
               // console.log(ip_name + ip_address + " First Data");
                $("#loading").show();
                $.ajax({
                    url: "{{route('saveAuthIps')}}",
                    type: "POST",
                    data:{'ip_address':ip_address,'name':ip_name2},
                    dataType:'json',
                    beforeSend: function() {
                        $("#loading").show();
                    },
                    success: function(result) {
                        $("#loading").hide();
                        if(result.status==false){
                            Command: toastr["error"](result.message);
                            return false;
                        }
                        if(result.status)
                        {
                            if(result.cip)
                                $('#allowed_ip_entry0').slideUp('slow');
                            setTimeout(function() {
                                $("#allowed_ip_entry1 #range_name").html(ip_name);
                                $("#allowed_ip_entry1 .IP_tab_info").html(ip_address);
                                $("#allowed_ip_entry1 .device_pic").html(ip_name2);
                                $("#ip-name-blk>.field_error").hide();
                                $("#loading").hide();
                                $("#ip-address-success").show();
                                $("#ip-address-success>.alert-msg").html("<span class='caps'>"+ip_name+"</span> {{trans('users.security_blade.successfully_added_msg')}}").show();
                                $(".no_ip_add_here").hide();
                                $("#IP_content").show();
                                setTimeout(function() {
                                    $("#popup_ip_new").modal("hide");
                                }, 500);
                            }, 1000);
                            setTimeout(function() {
                                window.location.reload();
                            }, 1200);
                        }
                    },complete: function (data) {

                        $('.blockUI').hide();
                        $("#loading").hide();

                        var  status = data['status']
                        if(status==422)
                        {
                            var response =data['responseJSON']['errors'];
                            for (x in response) {
                                $('#'+x).addClass('is-invalid');
                                id = '#'+x+'-error';
                                $(id).html(response[x]);
                                $(id).css('display','block');
                            }
                           // console.log(response);
                        }

                    }
                });
            }
        });
        $("#ip-next").on("click", function() {
            if($("#current_ip_sel").is(":checked") == true) {
                var cur_ip = $("#cur_ip").val();
                $("#get_ip").hide();
                $("#get_name").show();
                $(".base-ip-name").html(cur_ip);
                //console.log($(".base-ip-name").html());
                $(".popuphead_define .ip_note").show();
            } else if($("#static_ip_sel").is(":checked") == true) {
                if($("#static_ip>.sip .one_cell").val() == "") {
                    $("#static_ip .field_error").show();
                    $("#static_ip>.sip .one_cell").focus();
                    return false;
                }
                else {
                    sip=$("#static_ip .1_cell").val()+"."+$("#static_ip .2_cell").val()+"."+$("#static_ip .3_cell").val()+"."+$("#static_ip .4_cell").val();
                    $(".base-ip-name").html(sip);
                    //console.log(sip);
                    $("#get_ip").hide();
                    $("#get_name").show();
                    $(".popuphead_define .ip_note").show();
                }
            } else {
               /* if($("#range_ip>div>.fip>.one_cell").val() == "") {
                    // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.fip>.one_cell").val() > "255") {
                   // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.fip>.two_cell").val() == "") {
                    // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.fip>.two_cell").val() > "255") {
                   // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.fip>.three_cell").val() == "") {
                    // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.fip>.three_cell").val() > "255") {
                   // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.fip>.four_cell").val() == "") {
                    // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.fip>.four_cell").val() > "255") {
                  //  $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.tip>.one_cell").val() == "") {
                    // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.tip>.one_cell").val() > "255") {
                   // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.tip>.two_cell").val() == "") {
                   //  $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.tip>.two_cell").val() > "255") {
                   // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.tip>.three_cell").val() == "") {
                    // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.tip>.three_cell").val() > "255") {
                    //$("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.tip>.four_cell").val() == "") {
                    // $("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                } else if($("#range_ip>div>.tip>.four_cell").val() > "255") {
                    //$("#empty-ip-range").show();
                    $("#range_ip>div>.fip>.one_cell").focus();
                    return false;
                }
                else {*/
                    fip=$("#range_ip .fip .1_cell").val()+"."+$("#range_ip .fip .2_cell").val()+"."+$("#range_ip .fip .3_cell").val()+"."+$("#range_ip .fip .4_cell").val();
                    tip=$("#range_ip .tip .1_cell").val()+"."+$("#range_ip .tip .2_cell").val()+"."+$("#range_ip .tip .3_cell").val()+"."+$("#range_ip .tip .4_cell").val();
                    tip = toIp = $('#toIp').val();
                    $("#empty-ip-range").hide();
                    $(".base-ip-name").html(fip+"&nbsp; / &nbsp;"+tip);
                    if($('#ip_range').is(':checked'))
                        $(".base-ip-name").html(fip+"&nbsp; - &nbsp;"+tip);
                    //console.log($(".base-ip-name").html());
                    $("#get_ip").hide();
                    $("#get_name").show();
                    $(".popuphead_define .ip_note").show();
               // }
            }
        });
        $("#current_ip_sel").click(function() {
            $("#static_ip").slideUp(300);
            $("#range_ip").slideUp(300);
        });
        $("#static_ip_sel").click(function() {
            $(".ip_field.sip").addClass("success");
            $("#static_ip").slideDown(300);
            $("#range_ip").slideUp(300);
            $("#static_ip>.sip .one_cell").focus();
        });
        $("#range_ip_sel").click(function() {
            $("#static_ip").slideUp(300);
            $("#range_ip").slideDown(300);
            $("#rangeOrSubNet").html('/');
            $("#range_ip>div>.fip>.one_cell").focus();
        });
        $("#ip_range").click(function() {
            $("#static_ip").slideUp(300);
            $("#range_ip").slideDown(300);
            $("#rangeOrSubNet").html('-');
            $("#range_ip>div>.fip>.one_cell").focus();
        });

        $("#static_ip>.sip .one_cell, #static_ip>.sip .two_cell, #static_ip>.sip .three_cell, #static_ip>.sip .four_cell").focus(function() {
            $(this).parent().addClass("success");
        });

        $("#static_ip>.sip .one_cell, #static_ip>.sip .two_cell, #static_ip>.sip .three_cell, #static_ip>.sip .four_cell").focusout(function() {
            $(this).parent().removeClass("success");
        });

        $("#static_ip>.sip .one_cell, #static_ip>.sip .two_cell, #static_ip>.sip .three_cell, #static_ip>.sip .four_cell").keydown(function() {
            $(this).parent().addClass("success");
            $("#static_ip .field_error").hide();
        });

        $("#range_ip .ip_field").focus(function() {
            $(this).parent("#range_ip").addClass("success");
        });

        $("#range_ip .ip_field").focusout(function() {
            $(this).parent("#range_ip").removeClass("success");
        });
    });
</script>
<script type="text/javascript">
    function copyFunction() {
        var range = document.createRange();
        range.selectNode(document.getElementById("bc_code"));
        window.getSelection().removeAllRanges(); // clear current selection
        window.getSelection().addRange(range); // to select text
        document.execCommand("copy");
        window.getSelection().removeAllRanges(); // to deselect
        // console.log("Copied the text: " + range);
        Command: toastr["success"]("@lang('users.message.Backup_Code_Copied')");
    }
</script>
@endsection

@section(decide_content())
@php($osClasses = ['iPhone' => 'os_mac','Android' =>'os_android','linux'=>'os_linux','mac' => 'os_mac','windows' => 'os_windows','Unknown' => 'Unknown','unknown' => 'unknown'])
@php($osimage = ['iPhone' => 'device_mobiledevice','Android' =>'device_mobiledevice','linux'=>'device_mobiledevice','mac' => 'device_mobiledevice','windows' => 'device_personalcomputer','Unknown' => 'device_personalcomputer','unknown'=>'device_personalcomputer'])
@php($browserClasses = ['unknown' => 'unknown','Unknown' => 'Unknown','Internet Explorer' => 'browser_iexplorer','Mozilla Firefox' =>'browser_firefox','Opera'=>'browser_opera','Google Chrome' => 'browser_googlechrome','Apple Safari' => 'browser_safari'])
<!-- END PAGE HEADER-->
@if($errors->any())
<!-- For PHP validations errors-->
<div class="alert alert-danger" data-name="yvfyKcmr">
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="vZiAvsGG">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="ZWjaIrrz">
    <span id='msg-text'><span>
</div>

<div class="row" data-name="PZLnHhlz">
    <div class="col-lg-12" data-name="oKHdOeKN">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid" id="password-blk" data-name="fIYWAnAH">
            <div class="kt-portlet__head" data-name="GjgRCWIx">
                <div class="kt-portlet__head-label" data-name="dlKyfCQJ">
                    <h3 class="kt-portlet__head-title">@lang('security.section1.title')</h3>
                    <div class="discrption" data-name="xJgNuBds">@lang('security.section1.description')</div>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="YVFRXjum">
                <div class="no_password" data-name="SaTpROXT">
                    <div class="image_block" data-name="UspUlJpe">
                        <img src="/public/img/password.png" width="100" height="100">
                    </div>
                    <div class="button_block" data-name="qGARzuGd">
                        <button class="btn btn-success" data-toggle="modal" data-target="#password-popup">@lang('security.section1.Change_Password')</button>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
</div>

<div class="row" data-name="XTkjlkzT">
    <div class="col-lg-12" data-name="OqiexnnI">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid" id="ip-block-main" data-name="raARSQLy">
            <div class="kt-portlet__head" data-name="ZoxgkGhn">
                <div class="kt-portlet__head-label" data-name="EOegRsfg">
                    <h3 class="kt-portlet__head-title">@lang('security.section2.title')</h3>
                    <div class="discrption" data-name="yyQxCMRY">@lang('security.section2.description')</div>
                </div>
            </div>
            <div class="kt-portlet__body ip-block-main no-padding" data-name="otcpxDpw">
                @if(empty($userIps))
                <div class="no_ip_add_here" data-name="FrpIEQqu">
                    <div class="image_block" data-name="XiexyXPm">
                        <img src="/public/img/ip-address.png" width="100" height="100">
                    </div>
                    <div class="button_block" data-name="ONdlxcIR">
                        <button class="btn btn-success" data-toggle="modal" data-target="#popup_ip_new" onclick="add_new_ip_popup();">@lang('security.section2.Add_ip_Address') </button>
                    </div>
                </div>
                @endif
                <div id="IP_content" style="display: block;" data-name="dGqXJshC">
                    <div class="allowed_ip_entry always_hover not_included_current" style="display: {{empty($userIps) || (array_key_exists($userip,$userIps) || in_array($userip,$userIps)) ? 'none' : 'block' }};" id="allowed_ip_entry0" data-name="cVOwLJth">
                    
                       @lang('security.message.ip_alert',['ip'=>$userip])
                        <div class="asession_action current ip_add_btn" data-name="hvRDiTsM">@lang('common.label.add') </div>
                    </div>
                    <div id="IPdisplay_others" data-name="gjCvayOi">
                        @php($ipExists = false)
                        @php($i = 0)
                        @if(is_array($userIps) && !empty($userIps)  )
                        @foreach($userIps as $ip => $info)
                            @php($ipExists = true)
                            @php($i++)
                        @if($i==4)
                            @break
                            @endif
                        <div class="allowed_ip_entry" id="allowed_ip_entry{{$i}}" data-name="PFLIOUBh">
                            <div class="info_tab" data-name="EJVbUUNn">  
                                <div class="device_div" data-name="YLvyZyrP">
                                    <span class="device_pic dp_green">{{substr(isset($info['name']) ? $info['name'] : 'N/A', 0, 2)}}</span>
                                    <span class="device_details">
                                        <div class="device_name" data-name="rTXFwPrQ">
                                            <span id="range_name">{{isset($info['name']) ? $info['name'] : 'N/A'}}</span>
                                        </div>
                                        <div class="device_time" data-name="IQIFRfws">{{readAbleDate(isset($info['added_on']) ? $info['added_on'] : 'N/A')}}</div>
                                    </span>
                                </div>
                                <div class="activesession_entry_info" data-name="YoERmgfm">
                                    <div class="IP_tab_info" id="ip_add{{$i}}" data-name="yZZcNebr">{{is_int($ip) ? $info : $ip}}</div>
                                    <div class="asession_location" data-name="UXoeUDOo">{{isset($info['geoInfo']) ? $info['geoInfo'] : 'N/A'}}</div>
                                    <div onclick="showMiniModal('{{is_int($ip) ? $info : $ip}}','{{$i}}','{{isset($info['geoInfo']) ? $info['geoInfo'] : 'N/A'}}','{{readAbleDate(isset($info['added_on']) ? $info['added_on'] : 'N/A')}}','{{showDateTime($authUser->id,isset($info['added_on']) ? $info['added_on'] : 'N/A')}}','{{isset($info['name']) ? $info['name'] : 'N/A'}}')" class="asession_action ip_delete" data-name="tEDMldDQ">Remove</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <div id="IP_add_view_more" style="display: {{$ipExists?'block':'none'}};" data-name="AVZEEkOn">
                        <div style="display: {{$i==4?'inline-block':'none'}}" class="icon-showall half" id="ip-showall" data-toggle="modal" data-target="#popup_ip_show_lg" data-name="kEXSRvzK"><i class="la la-file-text-o"></i> {{trans('users.security_blade.view_more_div')}}</div>
                        <div style="display: {{$i>0?'block':'none'}}" class="addnew {{$i==4?'half':''}}" id="btn-addnew2" onclick="add_new_ip_popup();" data-name="uUzSPGXx"><i class="la la-plus-square-o"></i> @lang('security.section2.Add_ip_Address')</div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
</div>

<!-- BEGIN FORM-->
<div class="loading" id="loading" data-name="QyskKcnb"><div class="loader" data-name="kCBIgUYG"></div></div>
<div class="row" data-name="BSPRwIRu">
    <div class="col-md-12" data-name="xVZmFZVh">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" id="sessions-blk" data-name="AhxffaWh">
            <div class="kt-portlet__head" data-name="xPalRfMS">
                <div class="kt-portlet__head-label" data-name="UzPXgQhh">
                    <h3 class="kt-portlet__head-title">{{trans('users.session.active')}}</h3>
                    <div class="discrption" data-name="DNcGZkIV">{{trans('users.session.manage')}}</div>
                </div>
            </div>
            <div class="kt-portlet__body no-padding" data-name="GrJuDlfB">
                <input type="hidden" id="link-session" value="1">
                <div class="no_session" data-name="jzcTpLMq">
                    <div class="image_block" data-name="aoZwjrCB">
                        <img src="/public/img/no-session.png" width="100" height="100">
                    </div>
                    <div data-name="fpTWrrhw">{{ trans('users.session.no_record') }}</div>
                </div>
                <div id="all_sessions_active" class="baseblock" data-name="VwCqtxLA">
                    @php($i=1)
                    @if(isset($sessions[$current_sid]))
                        @php($currentSession = $sessions[$current_sid])
                        @php($humanTime = readAbleDate($currentSession['first_login']))
                        @php($time = showDateTime($authUser,$currentSession['first_login']))
                    <div id="current_sesion" data-name="qomNoKUU">
                        {{--human_readable_time,time,os,browser,location--}}
                        <div class="Field_session" id="activesession_entry{{$i}}" onclick="show_selected_session({{$i}},'{{$humanTime}}','{{$time}}','{{$currentSession['os']}}','{{$currentSession['browser']}}','{{!empty($currentSession['geoInfo']) ? $currentSession['geoInfo'] : '-'}}','{{$currentSession['ip']}}')" data-name="DeNtuCDX">
                            <div class="info_tab" data-name="zMWwMxbD">  
                                    
                                <div class="device_div" data-name="kqhOEgjd">
                                    <span class="device_pic {{$osClasses[$currentSession['os']]=='windows'?'device_mobiledevice':'device_personalcomputer'}}"></span>
                                    <span class="device_details">
                                        <span class="device_name">{{$currentSession['os']}}</span>
                                        <span class="device_time">{{$humanTime}}</span>
                                    </span>
                                </div>
                                <div class="device_div ip_dv" data-name="kqhOEgjZ">
                                    <span class="ip_pic"></span>
                                    <div class="asession_location" data-name="xiHZoKRZ">{{$currentSession['ip']}}</div>
                                </div>
                                <div class="activesession_entry_info" data-name="CPHaFXqi">
                                    <div class="asession_os {{$osClasses[$currentSession['os']]}}" data-tippy="" data-original-title="Windows 10.0" data-name="PEZVMfCl"></div>
                                    <div class="asession_browser {{$browserClasses[$currentSession['browser']]}}" data-tippy="" data-original-title="Google Chrome 79" data-name="sZWJFmlS"></div>
                                    <div class="asession_ip hide" data-name="jvymXIJc">{{$currentSession['ip']}}</div>
                                    <div class="asession_location" data-name="xiHZoKRR">{{!empty($currentSession['geoInfo']) ? $currentSession['geoInfo'] : "-"}}</div>
                                    <div class="asession_action current" data-name="SZbuVDAS">{{trans('sessions.index.csid')}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div id="other_sesion" data-name="jlPFdisY">
                        @foreach($sessions as $key => $session)
                         
                            @if(!$dbBaseActiveSession && !file_exists($sessionPath.$key.'.json'))
                                @continue
                            @endif
                            @php($en_key= \Illuminate\Support\Facades\Crypt::encrypt($key))
                            @if($current_sid==$key)
                                @continue
                            @endif
                            @php($i++)
                                @if($i==4)
                                    @break
                                @endif
                                @php($humanTime = readAbleDate($session['first_login']))
                                @php($time = showDateTime($authUser,$session['first_login']))
                        <div class="Field_session" id="activesession_entry{{$i}}" onclick="show_selected_session({{$i}},'{{$humanTime}}','{{$time}}','{{$session['os']}}','{{$session['browser']}}','{{!empty($session['geoInfo']) ? $session['geoInfo'] : '-'}}','{{$session['ip']}}')" data-name="LiVFCmjr">
                            <div class="info_tab" data-name="jzcPnoSL">  
                                <div class="device_div" data-name="ytURlmyN">
                                    <span class="device_pic {{$session['os']=='windows'?'device_personalcomputer':'device_mobiledevice'}}"></span>
                                    <span class="device_details">
                                        <span class="device_name">{{$session['os']}}</span>
                                        <span class="device_time">{{$humanTime}}</span>
                                    </span>
                                </div>
                                <div class="device_div ip_dv" data-name="kqhOEgjZ">
                                    <span class="ip_pic"></span>
                                    <div class="asession_location" data-name="xiHZoKRZ">{{$session['ip']}}</div>
                                </div>
                                <div class="activesession_entry_info" data-name="QuEVNRWk">
                                    <div class="asession_os {{$osClasses[$session['os']]}}" data-tippy="" data-original-title="Windows 10.0" data-name="gsTGOgLb"></div>
                                    <div class="asession_browser {{$browserClasses[$session['browser']]}}" data-tippy="" data-original-title="Google Chrome 79" data-name="yNBkYFDB"></div>
                                    <div class="asession_ip hide" data-name="KUnkICfS">{{$session['ip']}}</div>
                                    <div class="asession_location" data-name="NvUIgrvh">{{!empty($session['geoInfo']) ? $session['geoInfo'] : '-'}}</div>
                                    <div onclick="showModal('{{$en_key}}','{{$i}}') "class="asession_action session_logout" data-name="UjjbpbCJ">@lang('common.label.terminate')</div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <div class="icon-showall {{$i>3?'':'hide'}}" id="sessions_showall" onclick="show_all_sessions()" data-name="YgaXffJd"><i class="la la la-bars"></i> <span>@lang('common.label.View_more')</span></div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- END FORM-->

<!-- BEGIN FORM-->
@php($twoFa = $authUser->twoFa)
@if(routeAccess('enable2fa'))
<div class="row" data-name="rOyaepkK">
    <div class="col-lg-12" data-name="LpOvUtBc">
        <!--begin::Portlet-->
        <div class="kt-portlet kt-portlet--height-fluid" id="two-factor-blk" data-name="BhiIgIdx">
            <div class="kt-portlet__head" data-name="YMYZTSby">
                <div class="kt-portlet__head-label" data-name="xuIEZzpX">
                    <h3 class="kt-portlet__head-title">@lang('security.section4.title')</h3>
                    <div class="discrption" data-name="PIXBBUSJ">@lang('security.section4.description')</div>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="heHzmMZt">
                <div class="tfa-switch-block" data-name="RpHkQTZm">
                    <i class="flaticon-lock"></i>
                    <span class="auth-title">
                        @lang('security.section4.protect_your_account')
                    </span>
                    <span class="auth-desc">
                        @lang('security.section4.multi_factor_authentication')
                    </span>
                    <div class="input-icon dis-dang" data-name="AKMOMMwV">
                        <span class="auth-enable">@lang('common.label.Enable_Disable')</span>
                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                            <label>
                               <input {{!is_null($twoFa) && $twoFa->google2fa_enable==1?'checked':''}} type="checkbox" id="2fa" onchange="enableOrDisable2fa()">
                                <span></span>
                            </label>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Portlet-->
    </div>
</div>
@endif
<!-- END FORM-->

<!--begin::Modal-->
<div class="modal fade" id="popup_ip_show_lg" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-hidden="true" data-name="vnqxNfCE">
    <div class="modal-dialog modal-lg" role="document" data-name="OWRcRghd">
        <div class="modal-content" data-name="ugwmclvn">
            <div class="modal-body" data-name="BWQHSsmg">
                <div class="popuphead_details" data-name="EnoDbHww">
                    <span class="popuphead_text">@lang('security.section2.title')</span>
                    <span class="popuphead_define">@lang('security.section2.description')</span>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="alert alert-success alert-dismissible fade show" id="ip-terminate-small" role="alert" data-name="iYodlswl">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <span class="alert-msg">@lang('security.message.ip_terminated')</span>
                </div>
                <div class="no_ip_add_here" style="display: none;" data-name="XhENFlKA">
                    <div class="image_block" data-name="IcdEIHuO">
                        <img src="/public/img/ip-address.png" width="100" height="100">
                    </div>
                    <p>@lang('common.label.No_data_found').</p>
                </div>
                <div id="view_all_allow_ip" class="all_elements_space" data-name="BvZIUTpX">
                    <div class="ip_content" data-name="UAVRQfkX">
                        <div class="ip_display_others" data-name="OrTgMXMA">
                            @php($i=0)
                            @if(!empty($userIps))
                            @foreach($userIps as $ip => $info)
                                @php($i++)
                            <div class="allowed_ip_entry popup_ipBlk slidedown" id="popup_ip_block{{$i}}" data-name="QiaofvcQ">
                                <div class="info_tab" data-name="MNqKyyDK">  
                                    <div class="device_div" data-name="CJzOnUHa">
                                        <span class="device_pic dp_green">{{substr(isset($info['name']) ? $info['name'] : 'N/A', 0, 2)}}</span>
                                        <span class="device_details">
                                            <div class="device_name" data-name="xSBUrsiK">
                                                <span class="range_name">{{isset($info['name']) ? $info['name'] : 'N/A'}}</span>
                                            </div>
                                            <div class="device_time" data-name="EcdebcpO">{{readAbleDate(isset($info['added_on']) ? $info['added_on'] : 'N/A')}}</div>
                                        </span>
                                    </div>
                                    <div class="activesession_entry_info show" data-name="ukCKWbeA">
                                        <div class="IP_tab_info" data-name="adRXNWqA">{{is_int($ip) ? $info : $ip}}</div>
                                        <div class="asession_location" data-name="HfNlnjug">{{isset($info['geoInfo']) ? $info['geoInfo'] : 'N/A'}}</div>
                                        <div class="asession_action ip_delete" data-name="KLfvaOdQ">@lang('common.label.remove')</div>
                                    </div>
                                </div>
                                <div class="aw_info" data-name="dAJfEaKM">
                                    <div class="info_div" data-name="GlmBAZxX">
                                        <div class="info_lable" data-name="beNDNtrp">@lang('security.section4.Started_Time') </div>
                                        <div class="info_value" id="pop_up_time" data-name="hogRcnrR">{{showDateTime($authUser->id,isset($info['added_on']) ? $info['added_on'] : 'N/A')}}</div>
                                    </div>
                                    <div class="info_div" data-name="vXtVnLSg">
                                            <div class="info_lable" data-name="iDZOggsk">@lang('security.section2.title') </div>
                                            <div class="info_value range" data-name="JMZKruBW">{{is_int($ip) ? $info : $ip}}</div>
                                    </div>
                                    <div class="info_div" data-name="iDrBzSVr">
                                        <div class="info_lable" data-name="pHMgUyEG">@lang('common.label.location') </div>
                                        <div class="info_value" data-name="AMejzEpi">{{isset($info['geoInfo']) ? $info['geoInfo'] : 'N/A'}}</div>
                                        <!-- <div class="info_ip loc"></div> -->
                                    </div>
                                    <a class="btn btn-danger">
                                        <span  onclick="delete_ip('{{$ip}}','{{$i}}')">@lang('common.label.remove')</span>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="popup_ip_show_small" tabindex="-1" role="dialog" aria-hidden="true" data-name="GsuejQOF">
    <div class="modal-dialog" role="document" data-name="EBXksvJd">
        <div class="modal-content" data-name="hXVnaGLQ">
            <div class="modal-body" data-name="inMFmPcw">
                <input type="hidden" id="sm-ip-popup" value="1">
                <input type="hidden" id="sm-ip-terminate" value="0">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="alert alert-success alert-dismissible fade show" id="ip-terminate-small" role="alert" data-name="IsgenHRY">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                    <span class="alert-msg"></span>
                </div>
                <div class="device_div on_popup" data-name="BnnidGtu">
                    <span id="m_name" class="device_pic dp_green"></span>
                    <span class="device_details">
                        <span class="device_name range_name">
                            <span id="range_name3"></span>
                        </span>
                        <span class="device_time">19 {{trans('users.security_blade.hours_ago_span')}}</span>
                    </span>
                </div>
                <div id="ip_current_info" data-name="yhNNXKJE">
                    <div class="info_div" data-name="qvyXVQUB">
                        <div class="info_lable" data-name="wvQshOcn">@lang('security.section4.Started_Time')</div>
                        <div class="info_value" id="pop_up_time_c" data-name="GToTDNEl"></div>
                    </div>
                    <div class="info_div" data-name="lApLxokw">
                        <div class="info_lable" data-name="qjeeedGo">@lang('security.section2.title')</div>
                        <div class="info_value static" id="popup_ipname" data-name="IISOuoAu"></div>
                    </div>
                    <div class="info_div" data-name="onDaoVjJ">
                        <div class="info_lable" data-name="AXWpPMGL">@lang('common.label.location') </div>
                        <div class="info_value loc" data-name="SlrdCBKP"></div>
                    </div>
                    <a class="btn btn-danger" id="current_ip_del"><span>@lang('common.label.remove')</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="popup_ip_new" tabindex="-1" role="dialog" aria-hidden="true" data-name="ndTukyuM">
    <div class="modal-dialog" role="document" data-name="obKPYPiT">
        <div class="modal-content" data-name="QQrzLBCd">
            <div class="modal-body" data-name="lbHZBSvJ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="popuphead_details" data-name="sjigPzNs">
                    <span class="popuphead_text">@lang('security.section2.title')</span>
                    <span class="popuphead_define">@lang('security.section2.Ensure_static_IP_address') <br>
                    <span class="ip_note">@lang('security.section2.further_sign_ins')</span>    
                    </span>
                </div>
                <form name="addip" class="m-form m-form--fit m-form--label-align-left" id="allowedipform" onsubmit="return addipaddress(this)">
                    <div class="form-body" data-name="jORumEKR">
                        <div class="alert alert-danger alert-dismissible fade show" id="ip-address-error" role="alert" data-name="GBKMIBYW">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            <span class="alert-msg"></span>
                        </div>
                        <div class="alert alert-success alert-dismissible fade show" id="ip-address-success" role="alert" data-name="eBovjkRl">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                            <span class="alert-msg"></span>
                        </div>
                        <div id="get_ip" data-name="KmlmFaPO">
                            <div class="form-group" data-name="OAkSjBPU">
                                <div class="kt-radio-list" data-name="eGJeeepK">
                                    <label class="kt-radio kt-radio--state-success" for="current_ip_sel" id="current_ip">
                                        <input type="radio" name="ipaddress" id="current_ip_sel" value="1" checked>
                                        @lang('security.section2.current_IP_address') ( <div class="ip_blue" data-name="zkKeaZRZ">{{is_int($userip) ? $info : $userip}}</div> )
                                        <span></span>
                                    </label>
                                    <input type="hidden" id="cur_ip" name="cur_ip" value="{{is_int($userip) ? $info : $userip}}">
                                    <label class="kt-radio kt-radio--state-success" for="static_ip_sel">
                                        <input type="radio" name="ipaddress" value="2" id="static_ip_sel">
                                        @lang('security.section2.static_IP_address')
                                        <span></span>
                                    </label>
                                    <div id="static_ip" class="ip_cell_parent" data-name="ccFMbphJ">
                                        <div class="ip_field sip" style="border: 2px solid rgb(204, 204, 204);" data-name="kEwxzyAE">
                                            <input class="ip_field_cell 1_cell one_cell" autocomplete="address-line1" type="tel" maxlength="3"><span class="ip_dot">.</span>
                                            <input class="ip_field_cell 2_cell two_cell" type="tel" maxlength="3"><span class="ip_dot">.</span>
                                            <input class="ip_field_cell 3_cell three_cell" type="tel" maxlength="3"><span class="ip_dot">.</span>
                                            <input class="ip_field_cell 4_cell four_cell" type="tel" maxlength="3">
                                        </div>
                                        <div class="field_error" data-name="UkbFCnCt">@lang('security.message.enter_a_valid_IP')</div>
                                    </div>
                                    <div class="field_error" id="empty-ip-static" data-name="xDbnEaxP">@lang('security.message.enter_a_valid_IP')</div>
                                    <label class="kt-radio kt-radio--state-success" id="range_ip_sele">
                                        <input type="radio" name="ipaddress" value="3" id="range_ip_sel">
                                        @lang('security.section2.SubNet')
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--state-success" id="ip_range_label">
                                        <input type="radio" name="ipaddress" value="4" id="ip_range">
                                        @lang('security.section2.Add_IP_range')
                                        <span></span>
                                    </label>
                                    <div id="range_ip" class="ip_cell_parent" data-name="FxiXmiWN">
                                        <div data-name="KwSDhHQr">
                                            <div class="ip_field fip" style="border: 2px solid rgb(204, 204, 204);" data-name="wqgpmPER">
                                                <input class="ip_field_cell 1_cell one_cell" autocomplete="address-line1" type="tel" maxlength="3"><span class="ip_dot">.</span>
                                                <input class="ip_field_cell 2_cell two_cell" type="tel" maxlength="3"><span class="ip_dot">.</span>
                                                <input class="ip_field_cell 3_cell three_cell" type="tel" maxlength="3"><span class="ip_dot">.</span>
                                                <input class="ip_field_cell 4_cell four_cell" type="tel" maxlength="3">
                                            </div>                  
                                            <span class="range_to_sep" id="rangeOrSubNet">/</span>
                                            <div class="ip_field tip" style="border: 2px solid rgb(204, 204, 204); display: none;" data-name="uxaHbPpR">

                                            </div>
                                            <input type="tel" id="toIp" class="ip_field tip" style="border: 2px solid rgb(204, 204, 204);">
                                        </div>
                                    </div>
                                    <div class="field_error" id="empty-ip-range" data-name="ypdkhbKg">@lang('security.message.enter_a_valid_IP')</div>
                                </div>
                            </div>
                            <div class="form-group" data-name="AoVwhqal">
                                <button type="button" class="btn btn-success primary_btn_check" id="ip-next"> @lang('common.form.buttons.next') </button>
                            </div>
                        </div>
                        <div class="" id="get_name" style="display: none;" data-name="HNBBUpdC">
                            <div class="info_div" data-name="TEePSySi">
                                <div class="info_lable" data-name="HhZRuBxp">@lang('security.section2.Your_IP_address')</div>
                                <div class="info_value base-ip-name" id="ip_range_forNAME" data-name="yimiiUAs">182.180.148.77</div>
                            </div>
                            <div class="field full" id="ip-name-blk" data-name="wjsOiCdD">
                                <label class="textbox_label">@lang('security.section2.IP_Name') </label>
                                <input class="textbox" data-optional="true" tabindex="0" name="ip_name" id="ip_name" type="text">
                                <div class="field_error" data-name="jjBSybnK">@lang('security.section2.friendly_ip_name')</div>
                            </div>
                            <div id="creatgrp_butt2" style="display: block;" data-name="oMMuTnLb">
                                <button class="btn btn-success primary_btn_check" type="button" id="add_new_ip"> @lang('common.form.buttons.add') </button>
                                <button class="btn btn-secondary primary_btn_check high_cancel" tabindex="0" id="ip_name_bak" onclick="return back_to_addip();"><span>@lang('common.form.buttons.back') </span></button>
                            </div>
                        </div> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<div class="modal fade" id="twofaModal" tabindex="-1" role="dialog" aria-labelledby="integration" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="LMkueTyr">
    <div class="modal-dialog" role="document" data-name="LHEUSljB">
        <div class="modal-content" data-name="cYzlbeKu">
            <div class="modal-header" data-name="ooVQKETl">
                <i class="la la-check-circle"></i>
                <h5 class="modal-title" id="twoMT">@lang('users.profile.Enable_Two_Factor')</h5>
                <button type="button" id="close" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="JuSSUmbY">
                <span style="display: none;" class="spinner"><i class="fa fa-spinner fa-spin"></i></span>
                <div id="twoFA_modal_alert" style="display: none;" class="alert" data-name="EVbmcvXv"></div>
                <div id="bc_code_div" style="display: none;" class="" data-name="JYMmaQbr">
                    <h4>@lang('security.message.2fa_authentication_complete')</h4>
                    <div id="twoFA_modal_alert2" class="alert alert-success" data-name="idiHIBfc"></div>
                    <h4 class="bcode-text">@lang('security.section4.Backup_Code'):</h4>
                    <div class="alert alert-warning bcode-section" role="alert" data-name="mOhVqFOW">
                        <div class="alert-text" id="bc_code" data-name="GjuNPAOa"></div>
                        <div id="copycode" onclick="copyFunction()" data-name="aRkgyuIQ">
                            <svg class="octicon octicon-clippy" viewBox="0 0 14 16" version="1.1" width="30"
                                height="30" aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M2 13h4v1H2v-1zm5-6H2v1h5V7zm2 3V8l-3 3 3 3v-2h5v-2H9zM4.5 9H2v1h2.5V9zM2 12h2.5v-1H2v1zm9 1h1v2c-.02.28-.11.52-.3.7-.19.18-.42.28-.7.3H1c-.55 0-1-.45-1-1V4c0-.55.45-1 1-1h3c0-1.11.89-2 2-2 1.11 0 2 .89 2 2h3c.55 0 1 .45 1 1v5h-1V6H1v9h10v-2zM2 5h8c0-.55-.45-1-1-1H8c-.55 0-1-.45-1-1s-.45-1-1-1-1 .45-1 1-.45 1-1 1H3c-.55 0-1 .45-1 1z">
                                </path>
                            </svg>
                        </div>
                        <span id="br-code" style="display: none;"></span>

                    </div>
                    <p class="text-center">
                        @lang('security.message.save_2fa')
                    </p>
                </div>
                
                <div id="first_step" data-name="hwfzbxta">
                    <form id="f_step" class="form-horizontal" method="POST" novalidate>
                        {{ csrf_field() }}
                        <div class="row fBlk" data-name="uigOZiSA">
                            <div class="col-md-12" data-name="XdGfnxFD">
                                <div class="alert alert-info alert-bold" role="alert" data-name="ZYxzMoGv">
                                    <div class="alert-icon" data-name="OQVjgqck"><i class="la la-info-circle"></i></div>
                                    <div class="alert-text" data-name="nibSbNTC">
                                        @lang('security.section4.2fa_desc',['title' => isset($app_setting['title']) && !empty($app_setting['title']) ? $app_setting['title'] : 'Mumara'])
                                        </div>
                                </div>

                                <div class="text-center" data-name="VconkUSy">
                                    <button
                                        onclick="handleForm('f_step','{{route('generate2faSecret')}}','first_step')"
                                        type="button" class="btn btn-success">
                                           @lang('security.section4.Get_Started') <i class="la la-angle-double-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div id="second_step" class="fBlk" style="display: none;" data-name="UAWSkLGu">
                    <div class="qr-codeBlk" data-name="zNlORZJz">
                       @lang('security.section4.One_Time_Password')
                        <div class="qr-codeBlk" data-name="LNftErsX">
                            <img id="2fa_img" src="..">
                            <div class="menual-code-block" data-name="DTQdeIdb">
                                <span class="mentry">@lang('security.section4.MANUAL_ENTRY')</span>
                                <div id="alt-code" data-name="DNeUTxCa"></div> 
                                <span>@lang('security.section4.ignore_spaces')</span>
                            </div>
                        </div>
                        <button type="button" class="btn btn-success" id="code-confirm">
                            {{ trans('common.label.confirm') }} <i class="la la-angle-double-right"></i>
                        </button>
                    </div>
                    <form id="s_step" class="form-horizontal" method="POST" novalidate style="display: none">
                        {{ csrf_field() }}
                        <h4>@lang('security.section4.Verification_Step')</h4>
                        <p>@lang('security.section4.Enter_Security_code')</p>
                        <div class="form-group" data-name="DsEJcwqY">
                            <div class="col-md-6 offset-md-3" data-name="ptvpMJxt">
                                <input id="verify_code" type="text" class="form-control" name="verify_code" required autofocus>
                                <span id="verify_code-error" class="error"></span>
                            </div>
                        </div>
                        <div class="form-group mb0" data-name="oWazhhcj">
                            <div class="col-md-12" data-name="ypruAfpR">
                                <button class="btn btn-default pull-left" type="button" id="backtocode"> <i
                                        class="la la-angle-double-left"></i> @lang('common.form.buttons.back')</button>
                                <button id="enable_2fa" type="button"
                                    onclick="handleForm('s_step','{{route('enable2fa')}}','second_step')"
                                    class="btn btn-success pull-right">
                                    {{ trans('common.label.confirm') }} <i class="la la-angle-double-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
                <div id="third_step" style="display: none" data-name="yfLJgXfy">
                    <p class="text-center">@lang('security.section4.disable_2fa')</p>
                    <form id="t_step" class="form-horizontal" method="POST" novalidate>
                        {{ csrf_field() }}
                        <div class="form-group mb30" data-name="LTueCqMd">
                            <div class="col-md-6 offset-md-3" data-name="RrCIUVhH">
                                <input id="current_password" type="password" class="form-control"
                                    name="current_password" placeholder="Password" required autofocus>
                                <span id="current_password-error" class="error"></span>
                            </div>
                        </div>
                        <div class="form-group mb10" data-name="SidNcLfv">
                            <div class="col-md-6 offset-md-3 text-center" data-name="UJNCbbFN">
                                <button id="disable2fa"
                                    onclick="handleForm('t_step','{{route('disable2fa')}}','disable2fa')"
                                    type="button" class="btn btn-danger"> {{ trans('common.label.disable') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="modal-footer" style="display: none;" data-name="fmhAFTwe">
                <button id="dismiss_btn" type="button" class="btn btn-default" data-dismiss="modal">@lang('common.form.buttons.cancel')</button>
            </div>
        </div>
    </div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="password-popup" tabindex="-1" role="dialog" aria-labelledby="integration" data-backdrop="static" data-keyboard="false" aria-modal="true" data-name="hCeaBVvg">
    <div class="modal-dialog" role="document" data-name="GqgFdmpG">
        <div class="modal-content" data-name="vrejCIil">
            <div class="modal-body" data-name="QvLhPLCI">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="password-section" data-name="toWOZVsQ">
                    <div class="popuphead_details" data-name="nyQNwDVE">
                        <span class="popuphead_text">{{ trans('common.label.password') }}</span>
                        <span class="popuphead_define">@lang('security.message.Set_strong_password')</span>
                    </div>
                    <form class="m-form m-form--fit m-form--label-align-left" id="changePassword" >
                        <div class="form-body" data-name="PCTDepCF">
                            <div class="alert alert-danger alert-dismissible fade show" id="password-error" role="alert" data-name="yzKvdpmR">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <span class="alert-msg"></span>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" id="password-success" role="alert" data-name="eEpNYxHs">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <span class="alert-msg"></span>
                            </div>
                            <div class="form-group" data-name="aurKvMwD">
                                <label>{{ trans('common.label.current_password') }} </label>
                                <input type="password" class="form-control m-input" autofocus="true" id="old_password" name="old_password" required="">
                                <div id="old_password-error" class="error invalid-feedback" data-name="znBZDDyF"></div>
                            </div>
                            <div class="form-group" data-name="GuhEGRuV">
                                <label>{{ trans('common.label.new_password') }}</label>
                                <div class="password-div" data-name="PCBDkDgY">
                                    <input type="password" id="password" class="form-control m-input" name="password" onkeyup="check_pp()" required="">
                                    <span class="pass_icon" onclick="togglePass(this)"></span>
                                    <div class="pass_policy" data-name="hSKYFgmW"> @lang('security.message.atleast_characters')</div>
                                    <div class="pass_policy_error" style="display: none;" data-name="tUSZjZkA"> @lang('security.message.atleast_characters')</div>
                                    <div id="password-error" class="error invalid-feedback" data-name="uzGwlQrF"></div>
                                </div>
                            </div>
                            <div class="form-group" data-name="seRXiwsH">
                                <label>{{ trans('common.label.confirm_password') }} </label>
                                <input type="password" id="password_confirmation" class="form-control m-input" name="password_confirmation" required="">
                                <div id="password_confirmation-error" class="error invalid-feedback" data-name="XZQVvBvg"></div>
                            </div>
                            <div class="form-group" data-name="GyPxcgYs">
                                <button type="button" id="updatePassword" class="btn btn-success"> @lang('security.section1.Change_Password') </button>
                            </div>
                        </div>
                    </form>
                </div>
                    
                <div class="email-section" data-name="KkLagTxF">
                    <div class="popuphead_details" data-name="lnJWApCH">
                        <span class="popuphead_text">@lang('security.section4.Password_Reset_Request')</span>
                        <span class="popuphead_define">@lang('security.section4.Enter_email_address')</span>
                    </div>
                    <form class="m-form m-form--fit m-form--label-align-left" id="forgotPassword" action="" mathod="POST">
                        <div class="form-body" data-name="BoaddWsq">
                            <div class="alert alert-danger alert-dismissible fade show" id="forgot-password-error" role="alert" data-name="iDHFpDqN">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <span class="alert-msg"></span>
                            </div>
                            <div class="alert alert-success alert-dismissible fade show" id="forgot-password-success" role="alert" data-name="RCctPgDz">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                                <span class="alert-msg"></span>
                            </div>
                            <div class="form-group" data-name="wdBLcEeF">
                                <label>{{ trans('common.label.email') }} </label>
                                <input type="email" placeholder="Registered Email" class="form-control m-input" id="reg-email" name="email" value="{{ Auth::user()->email }}" required="">
                                <div class="field_error" id="validemail" data-name="utaFRsgL">@lang('security.message.enter_a_valid_email')</div>
                            </div>
                            <div class="form-group" data-name="yVFZFTLT">
                                <button type="button" id="sendEmail" class="btn btn-success"> @lang('security.request') </button>
                                <button type="button" id="backpass" class="btn btn-secondary"> @lang('common.form.buttons.back') </button>
                                <button type="button" id="resetpassclose"  data-dismiss="modal" aria-label="Close" class="btn btn-secondary"> @lang('common.form.buttons.close') </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal-->
{{--  $("#session-mini-popup #device_pic").removeClass("device_mobiledevice").addClass("device_personalcomputer");
                $("#session-mini-popup .device_name").html("Computer");
                $("#session-mini-popup .device_time").html(human_readable_time);
                $("#session-mini-popup #pop_up_time").html(time);
                $("#session-mini-popup #pop_up_os").html('<div class="asession_os_popup minios_mac" data-name="lHvmfVjy"></div><span>'+os+'</span>');
                $("#session-mini-popup .pop_up_location'").html(location);
                $("#session-mini-popup #pop_up_browser").html--}}
<div class="modal fade" id="session-mini-popup" tabindex="-1" role="dialog" aria-labelledby="integration" data-backdrop="static" data-keyboard="false" aria-modal="true" data-name="ckUDdIMF">
    <div class="modal-dialog modal-dialog-centered" role="document" data-name="IzQZVOJT">
        <div class="modal-content" data-name="QzYACkDo">
            <div class="modal-body" data-name="pamcTUUX">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="alert alert-success alert-dismissible" id="session_alert" role="alert" data-name="hFRQQJiq">
                    <span class="alert-msg">@lang('security.message.Session_Account_removed')</span>
                </div>
                <div class="device_div on_popup" data-name="xvWPSUXb">
                    <span id="device_pic" class="device_personalcomputer"></span>
                    <span class="device_details">
                        <span class="device_name">@lang('security.device_name')</span>
                        <span class="device_time">@lang('security.device_time')</span>
                    </span>
                </div>
                <div id="sessions_current_info" class="list_show" data-name="aKCtoVgM">
                    <div class="info_div" data-name="ysICgZeD">
                        <div class="info_lable" data-name="sDHaizhl">@lang('security.section4.Started_Time')</div>
                        <div class="info_value" id="pop_up_time" data-name="MkanlNYJ">1/22/20</div>
                    </div>
                    <div class="info_div" data-name="ysICgZeD">
                        <div class="info_lable" data-name="sDHaizhl">@lang('IP Address')</div>
                        <div class="info_value pop_up_ip" id="pop_up_ip" data-name="MkanlNYJ"><span class="pop-img-ip"></span> 192.168.124.214</div>
                    </div>
                    <div class="info_div" data-name="SHUXCpWT">
                        <div class="info_lable" data-name="nObcwTyK">{{ trans('common.label.Operating_System') }}</div>
                        <div class="info_value" id="pop_up_os" data-name="sUoLAWew"><div class="asession_os_popup minios_mac" data-name="LkbCHDvB"></div><span>{{trans('sessions.session_index_blade.windows_txt')}} 10.0</span></div>
                    </div>
                    <div class="info_div" data-name="KfJHiDVS">
                        <div class="info_lable" data-name="SSijSgCb">{{ trans('common.label.Browser') }}</div>
                        <div class="info_value" id="pop_up_browser" data-name="MwWnEtPH"><span class="asession_browser_popup minibrowser_googlechrome"></span><span>{{trans('sessions.session_index_blade.google_chrome_span')}} </span></div>
                    </div>
                    <div class="info_div" data-name="gZLKDfBX">
                        <div class="info_lable" data-name="fdKOQRnS">@lang('common.label.location')</div>
                        
                        <div class="info_value location_unavail pop_up_location" data-name="PUxsAIyi">{{trans('sessions.session_index_blade.div_chishtian_mandi')}}</div>
                         
                        <div class="info_ip" data-name="sitylhrR"></div>
                    </div>                                 
                </div>
                <button id="current_session_remove" class="btn btn-danger" style="display: none;">@lang('common.label.terminate')</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<!--begin::Modal-->
<div class="modal fade" id="view_all_sessions" tabindex="-1" role="dialog" aria-labelledby="integration" data-backdrop="static" data-keyboard="false" aria-modal="true" data-name="ADcjPstT">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" data-name="ukLMRFKM">
        <div class="modal-content" data-name="slNRfupV">
            <div class="modal-body no-padding popupblock" data-name="ZZObMODg">
                <div class="box_info" data-name="zRohKoPT">
                    <div class="box_head" data-name="qamgdWQQ">{{ trans('security.section3.title') }}<span class="icon-info"></span></div>
                    <div class="box_discrption" data-name="PfLPqRxz">@lang('security.section3.description')</div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <div class="alert alert-success alert-dismissible" id="sessionAll_alert" role="alert" data-name="pMwoCihM">
                    <span class="alert-msg">{{trans('users.security_blade.session_account_span')}}  <span id="sessionsAll-name"></span>{{trans('sessions.session_index_blade.span_successfully_removed')}}</span>
                </div>
                <div id="no_sessions" class="box_content_div" data-name="wDvAIZkM">
                    <div class="no_data" data-name="NnADInjm"></div>
                    <div class="no_data_text" data-name="KbieQkeT">@lang('users.session.no_record') </div>
                </div>
                @php($i=1)
                @if(isset($sessions[$current_sid]))
                    @php($currentSession = $sessions[$current_sid])
                    @php($en_key= \Illuminate\Support\Facades\Crypt::encrypt($current_sid))
                <div id="current_session" data-name="NfDZtcYn">
                    <div class="Field_session as" id="as_{{$i}}" data-name="LmgEwnxN">
                        <div class="info_tab" data-name="WxgEcSCj">  
                            <div class="device_div" data-name="CJyMXNIt">
                                <span class="device_pic {{$currentSession['os']=='windows'?'device_personalcomputer':'device_mobiledevice'}}"></span>
                                <span class="device_details">
                                    <span class="device_name">{{$currentSession['os']}}</span>
                                    <span class="device_time">{{readAbleDate($currentSession['first_login'])}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" data-name="MCbkcUiw">
                                <div class="device_div lip-blk" data-name="CJyMXNIt">
                                    <span class="ipl_pic"></span>
                                    <div class="asession_location ip-address" data-name="HpspclGf">{{$currentSession['ip']}}</div>
                                </div>
                                <div class="asession_os {{$osClasses[$currentSession['os']]}}" data-tippy="" data-original-title="Windows 10.0" data-name="SsNXxGHe"></div>
                                <div class="asession_browser {{$browserClasses[$currentSession['browser']]}}" data-tippy="" data-original-title="Google Chrome 79" data-name="uGMkWQLE"></div>
                                <div class="asession_ip hide" data-name="OtzEGnEz">{{$currentSession['ip']}}</div>
                                <div class="asession_location" data-name="HpspclGf">{{!empty($currentSession['geoInfo']) ? $currentSession['geoInfo'] : '' }}</div>
                                <div class="asession_action current" data-name="eTppiudU">{{trans('sessions.index.csid')}}</div>
                            </div>
                        </div>
                        <div class="aw_info as_info as_{{$i}}" id="activesession_info{{$i}}" data-name="rnvWEsmZ">
                            <div class="info_div" data-name="RgCYrEIN">
                                <div class="info_lable" data-name="YUjzqkbq">@lang('security.section4.Started_Time')</div>
                                <div class="info_value" id="pop_up_time" data-name="WVaXeeaI">{{showDateTime($authUser,$currentSession['first_login'])}}</div>
                            </div>
                            <div class="info_div" data-name="ysICgZeD">
                                <div class="info_lable" data-name="sDHaizhl">IP Address</div>
                                <div class="info_value pop_up_ip" id="pop_up_ip" data-name="MkanlNYJ"><span class="pop-img-ip"></span> {{$currentSession['ip']}}</div>
                            </div>
                            <div class="info_div" data-name="tgvmaKsy">
                                <div class="info_lable" data-name="QUqFghCZ">{{ trans('common.label.Operating_System') }}</div>
                                <div class="info_value" id="pop_up_os" data-name="dEEoAcwF"><div class="asession_os_popup minios_windows" data-name="BeOSeqgD"></div><span>{{$currentSession['os']}}</span></div>
                            </div>
                            <div class="info_div" data-name="SQYWBmRZ">
                                <div class="info_lable" data-name="nTBqoPxZ">{{ trans('common.label.Browser') }}</div>
                                <div class="info_value" id="pop_up_browser" data-name="yxBPWZoa"><span class="asession_browser_popup mini{{$browserClasses[$currentSession['browser']]}}"></span><span>{{$currentSession['browser']}}</span></div>
                            </div>
                            <div class="info_div" data-name="hfZwSwog">
                                <div class="info_lable" data-name="ehtbYsZN">@lang('common.label.location')</div>
                                <div class="info_value location_unavail" data-name="bYLNdJmN">{{!empty($currentSession['geoInfo']) ? $currentSession['geoInfo'] : ''}}</div>
                                <div class="info_ip" data-name="xllnWoBM"></div>
                            </div>
                        </div>
                    </div>
                </div>

                @endif

                <div id="other_sessions" data-name="GVPXSeuz">
                    @foreach($sessions as $key => $session)
                        @if(!file_exists($sessionPath.$key.'.json'))
                            @continue
                        @endif
                        @php($en_key= \Illuminate\Support\Facades\Crypt::encrypt($key))
                        @if($current_sid==$key)
                            @continue
                        @endif
                        @php($i++)
                    <div class="Field_session as" id="as_{{$i}}" data-name="DxHevCbs">
                        <div class="info_tab" data-name="mQdxcAne">
                            <div class="device_div" data-name="VRiyzqQn">
                                <span class="device_pic {{$session['os']=='windows'?'device_personalcomputer':'device_mobiledevice'}}"></span>
                                <span class="device_details">
                                    <span class="device_name">{{$session['os']}}</span>
                                    <span class="device_time">{{readAbleDate($session['first_login'])}}</span>
                                </span>
                            </div>
                            <div class="activesession_entry_info" style="" data-name="VvPJaOvr">
                                <div class="device_div lip-blk" data-name="CJyMXNIt">
                                    <span class="ipl_pic"></span>
                                    <div class="asession_location ip-address" data-name="HpspclGf">{{$session['ip']}}</div>
                                </div>
                                <div class="asession_os {{$osClasses[$session['os']]}}" data-tippy="" data-original-title="Windows 10.0" data-name="jiecqlXp"></div>
                                <div class="asession_browser {{$browserClasses[$session['browser']]}}" data-tippy="" data-original-title="Google Chrome 79" data-name="wURwGIOU"></div>
                                <div class="asession_ip hide" data-name="PTAhbImq">{{$session['ip']}}</div>
                                <div class="asession_location" data-name="MqCzlPPP">{{!empty($session['geoInfo']) ? $session['geoInfo'] : ''}}</div>
                                <div class="asession_action session_logout" data-name="vPzIAEda">@lang('common.label.terminate')</div>
                            </div>
                        </div>
                        <div class="aw_info as_info as_{{$i}}" id="activesession_info{{$i}}" style="display: none;" data-name="doyaXApj">
                            <div class="info_div" data-name="RWSmmkQx">
                                <div class="info_lable" data-name="LmqBPqeG">@lang('security.section4.Started_Time')</div>
                                <div class="info_value" id="pop_up_time" data-name="TKTGTBdU">{{showDateTime($authUser,$session['first_login'])}}</div>
                            </div>
                            <div class="info_div" data-name="ysICgZeD">
                                <div class="info_lable" data-name="sDHaizhl">IP Address</div>
                                <div class="info_value pop_up_ip"  data-name="MkanlNYJ"><span class="pop-img-ip"></span> {{$session['ip']}}</div>
                            </div>
                            <div class="info_div" data-name="PtHXtyUg">
                                <div class="info_lable" data-name="PrNfhzUi">{{ trans('common.label.Operating_System') }}</div>
                                <div class="info_value" id="pop_up_os" data-name="UcNzGNfD"><div class="asession_os_popup mini{{$osClasses[$session['os']]}}" data-name="uuVAfoxc"></div><span>{{$session['os']}}</span></div>
                            </div>
                            <div class="info_div" data-name="SXqmWqXu">
                                <div class="info_lable" data-name="IexPEkPz">{{ trans('common.label.Browser') }}</div>
                                <div class="info_value" id="pop_up_browser" data-name="jclRUKTf"><span class="asession_browser_popup mini{{$browserClasses[$session['browser']]}}"></span><span>{{$session['browser']}}</span></div>
                            </div>
                            <div class="info_div" data-name="mMHMbCRr">
                                <div class="info_lable" data-name="ZuCpKsFz">@lang('common.label.location')</div>
                                <div class="info_value location_unavail" data-name="uztsfXOo">{{!empty($session['geoInfo']) ? $session['geoInfo'] : '-'}}</div>
                                <div class="info_ip" data-name="FiqKCjuw"></div>
                            </div>
                            <button onclick="deleteSession('{{$en_key}}','{{$i}}')" class="btn btn-danger">
                                <span>@lang('common.label.terminate')</span>
                            </button>                                  
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

@endsection