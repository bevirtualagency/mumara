@extends(decide_template())

@section('title',$pageTitle )

@section('page_styles')
<link href="/resources/assets/css/setting.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style type="text/css">
    #route_bounce_server_ok {
        margin-top: -15px;
        margin-bottom: 30px;
        display: none;
    }
    .notification_settings_text{
        margin-bottom: 25px!important;
    }
    .days-right{
        float: right;
    }
    .pl8 {
        padding-left: 8px;
    }
    .db-warning {
        padding: 2px 10px;
        border-radius: 5px;
        background: #fffad0;
        margin-top: 8px;
        margin-bottom: 10px;
        text-align: center;
        width: 100%;
        font-size: 12px;
    }
    #session-alert:before {display:none;}
</style>
@endsection

@php
if(config('app.type') =="demo"){
    $attribute="disabled";
}else{
    $attribute=""; 
}
@endphp
@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>

    var token = "{{ csrf_token() }}";

    $("body").on("change keyup" , "#clicked_files_path", function() {
        $.ajax({
            url: "{{ url('checkFoldrePermission') }}",
            type: 'POST',
            data: {'dir':$(this).val()},
          
            success: function(result) {
                $("#folderPermissionClick").html("");
                if(result == 0) { 
                    $("#folderPermissionClick").html('<span class="text-danger">{{trans("settings.message.folder_not_found")}}</span>')
                }
                if(result == 2) { 
                    $("#folderPermissionClick").html('<span class="text-success">{{trans("settings.message.folder_permission_error")}}</span>')
                }
              
              
                
            }
        });
    });
    $("body").on("change keyup" , "#opened_files_path", function() {
        $.ajax({
            url: "{{ url('checkFoldrePermission') }}",
            type: 'POST',
            data: {'dir':$(this).val()},
          
            success: function(result) {
                $("#folderPermissionOpened").html("");
                if(result == 0) { 
                    $("#folderPermissionOpened").html('<span class="text-danger">{{trans("settings.message.folder_not_found")}}</span>')
                }
                if(result == 2) { 
                    $("#folderPermissionOpened").html('<span class="text-success">{{trans("settings.message.folder_permission_error")}}</span>')
                } 
              
              
                
            }
        });
    });

    function changeDomainStatuses(status){
        $.ajax({
            url: "{{ URL::route('verify.all.domains') }}",
            type: 'POST',
            dataType:'json',
            data: {'_token':token,'status':status},
            beforeSend: function () {
                $(".blockUI").show();
            },
            complete: function () {
                $(".blockUI").hide();
            },
            success: function(result) {
                if(result)
                    $("#verifyModal").modal("hide");
            }
        });
    }

    function saveDomainSetting(){
       // alert('aaaa');
      ///  return false;
        var form_data = $("#domain-masking-setting").serialize();
            $.ajax({
                url: "{{ URL::route('setting.general') }}",
                type: 'POST',
                data: form_data,
                 beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function(result) {
                    $.ajax({
                        url: "{{route('setting.update_domainStatus')}}",
                        type: 'GET'
                    });
                    showMsg();
                    $("#vercheck").hide();
                }
            }); 
    }

    function copyFunction2() {
        var copyText = document.getElementById("public_key_textarea");
        var textArea = document.createElement("textarea")
        textArea.value = copyText.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("copy",false);
        Command: toastr["success"] ("Public Key {{trans('common.message.success_copied')}}");
    }

    function copyFunction() {
        var copyText = document.getElementById("private_key_textarea");
        var textArea = document.createElement("textarea")
        textArea.value = copyText.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("copy",false);
        Command: toastr["success"] ("Private Key {{trans('common.message.success_copied')}}");
    }

    function copyFunction3() {
        var copyText = document.getElementById("cnamecopy");
        var textArea = document.createElement("textarea")
        textArea.value = copyText.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand("copy",false);
        Command: toastr["success"] ("TXT Value {{trans('common.message.success_copied')}}");
    }

    $(document).ready(function() {

        // $("#email_global_header").on("change", function() {
        //     var html = $("#email_global_header").html();
        //     $("#email_global_header").html(html);
        // })
        // $("#email_global_footer").on("change", function() {
        //     var html = $("#email_global_footer").html();
        //     $("#email_global_footer").html(html);
        // })

        $("#egh").click(function() {
            var html = $("#email_global_header").val();
            $("#priview").html(html);
            $("#preview_html").modal("show");
        });

        $("#egf").click(function() {
            var html = $("#mail_global_footer").val();
            $("#priview2").html(html);
            $("#preview_html2").modal("show");
        });

        $("#feild1").slideUp();
        $("#feild2").slideUp();
        $("#feild3").slideUp();
        $("#feild4").slideUp();
        $("#feild5").slideUp();
        $("#feild6").slideUp();

        <?php if(!empty($app_settings['delete_schedule_broadcast_flag']) && $app_settings['delete_schedule_broadcast_flag'] == "on") { ?>
            $(function() { 
            setTimeout(() => { $("#logs1").click(); },500) 
           });
        <?php } ?>
       
        $("#logs1").click(function() {
            var checked = $("#logs1").is(":checked");
            if(checked) {
                $("#feild1").slideDown();
                $(".delete-child").slideUp();
            } else {
                $("#feild1").slideUp();
                $(".delete-child").slideDown();
            }
        });

        <?php if(!empty($app_settings['delete_emailopenlogs_flag']) && $app_settings['delete_emailopenlogs_flag'] == "on") { ?>
            $(function() { 
            setTimeout(() => { $("#logs2").click(); },500) 
           });
        <?php } ?>
        $("#logs2").click(function() {
            var checked = $("#logs2").is(":checked");
            if(checked) {
                $("#feild2").slideDown();
            } else {
                $("#feild2").slideUp();
            }
        });

        <?php if(!empty($app_settings['delete_emailclicks_flag']) && $app_settings['delete_emailclicks_flag'] == "on") { ?>
           $(function() { 
            setTimeout(() => { $("#logs3").click(); },500) 
           });
        <?php } ?>



        $("#logs3").click(function() {
            var checked = $("#logs3").is(":checked");
            if(checked) {
                $("#feild3").slideDown();
            } else {
                $("#feild3").slideUp();
            }
        });

        <?php if(!empty($app_settings['delete_emailbounced_flag']) && $app_settings['delete_emailbounced_flag'] == "on") { ?>
           $(function() { 
            setTimeout(() => { $("#logs4").click(); },500) 
           });
        <?php } ?>


        $("#logs4").click(function() {
            var checked = $("#logs4").is(":checked");
            if(checked) {
                $("#feild4").slideDown();
            } else {
                $("#feild4").slideUp();
            }
        });

        <?php if(!empty($app_settings['delete_unsubscribed_flag']) && $app_settings['delete_unsubscribed_flag'] == "on") { ?>
           $(function() { 
            setTimeout(() => { $("#logs5").click(); },500) 
           });
        <?php } ?>


        $("#logs5").click(function() {
            var checked = $("#logs5").is(":checked");
            if(checked) {
                $("#feild5").slideDown();
            } else {
                $("#feild5").slideUp();
            }
        });

        <?php if(!empty($app_settings['delete_user_logs_flag']) && $app_settings['delete_user_logs_flag'] == "on") { ?>
           $(function() { 
            setTimeout(() => { $("#logs6").click(); },500) 
           });
        <?php } ?>

        $("#logs6").click(function() {
            var checked = $("#logs6").is(":checked");
            if(checked) {
                $("#feild6").slideDown();
            } else {
                $("#feild6").slideUp();
            }
        });

        $("#session-check .kt-radio>input").click(function() {
            $("#session-alert").slideDown();
        });
        <?php 
            $supp_count = DB::table("alter_tables")->where("name" , "md5suppression")->count();
            if($supp_count > 0) {  
        ?>
                setTimeout(() => {
                    $("#switchb_md5").hide();
                    $(".spinnerb_md5").show();
                    $("#md5").prop("checked", true);
                    $("#encrypt_enable").val("1")
                    // Command: toastr["success"] ("md5 enabled successfully!");
                }, 1000);
                <?php } else {  
                     $eArray = array("md5");
                         
                     $encryptedTypes = getSetting("encrypted_email_types");
                     $et_array = array();
                     $md_flag = false;
                     if(!empty($encryptedTypes)) { 
                        $encryptedTypes = json_decode($encryptedTypes);
                        foreach($encryptedTypes as $kk=>$et) { 
                            $et_array[] = $kk; 
                            if($et == "yes") $md_flag = true;
                        }
                     }
                    if(in_array("md5" , $et_array) and $md_flag == 1) {
                ?>  
                
                    setTimeout(() => {
                        $("#switchb_md5").show();
                        $(".spinnerb_md5").hide();
                        $("#md5").prop("checked", true);
                        $("#encrypt_enable").val("1")
                        // Command: toastr["success"] ("md5 enabled successfully!");
                    }, 3000);
                <?php } else { 
                     if(in_array("md5" , $et_array)) {    
                ?> 
                    $("#encrypt_enable").val("1");
                <?php } }  } ?>


        $("#close-modal").click(function() {
            $("#md5").prop("checked", false);
            $("#encryptMsgBlk").modal("hide");
        });

        $(".en-activate").click(function(e) {
            var id = e.target.dataset.id;            
            $("#active_id").val(id);
            $("#encryptMsgBlk").modal("show");
        });

        $("#password").change(function() {

        });

        $(document).on('keypress', '#password', function (event) {
            // var regex = new RegExp("^[a-zA-Z0-9]+$");
            // var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (event.charCode==47) {
               event.preventDefault();
               return false;
            }
        });
        $("#enc_process").click(function() {
            $("#md5").prop("checked", false);
            $("#encryptMsgBlk").modal("hide");
            $("#switchb_md5").hide();
            $(".spinnerb_md5").show();
            var name = "md5";
            var enable = "yes";
            var form_data = {
                name,
                enable
            };
            $.ajax({
                url: "{{ url('/') }}" + '/suppression/addType',
                type: "POST",
                data: form_data,
                success: function(result) {
                    $("#loading").hide();
                }
            });

            
        });

        $("#md5").click(function(){
            var val = $("#md5").val();
            var enc_enable = $("#encrypt_enable").val();
            var checked = $("#md5").is(":checked");
            if(enc_enable === "") {
                $("#md5").prop("checked", false);
                $("#encryptMsgBlk").modal("show");
            } else if(enc_enable === "1") {
                var name = "md5";
                var enable = "no";
                if(checked) enable = "yes";
                var form_data = {
                    name,
                    enable
                };
                $.ajax({
                    url: "{{ url('/') }}" + '/suppression/addType',
                    type: "POST",
                    data: form_data,
                    success: function(result) {
                        if($("#md5").is(":checked")) { 
                            Command: toastr["success"] ("{{trans('settings.md5_enables_successfull')}}");
                        } else { 
                            Command: toastr["success"] ("{{trans('settings.md5_disable_successfull')}}");
                        }
                       
                    }
                });

                
            }
            else {
                $("#encryptMsgBlk").modal("hide");
            } 
        });


        $("body").on("click", ".encryptedType" , function(event) {
            var name = $(this).attr("data-value");
            var enable = "no";
            if($(this).is(":checked")) { 
                enable = "yes";
            }
            var form_data = {
                name,
                enable
            };
            $.ajax({
                url: "{{ url('/') }}" + '/suppression/addType',
                type: "POST",
                data: form_data,
                success: function(result) {
                    $("#loading").hide();
                }
            });
        });


        $("#route_bounce_server").click(function() {
            $("#route_bounce_server_ok").slideDown();

        });

        @if(!empty($app_settings['imap_switch']) and $app_settings['imap_switch'] == "2") 
        $("#route_bounce_server_ok").slideDown();
        @endif

        $("#imape_switch").click(function() {
            $("#route_bounce_server_ok").slideUp();
            
        });

        $("#unauthenticated").click(function() {
            if($(this).attr("checked")) {
                $(".blockUI").show();
                setTimeout(() => {
                    $(".blockUI").hide();
                    $("#unauthChildBlk").slideDown();
                }, 500);
            } else {
                $("#unauthChildBlk").slideUp();
            }

            if($("#intellectual_tracking").is(":checked")) {
                $(".intellectualPatternStatus").hide();
            } else { 
                $(".intellectualPatternStatus").show();
            }

        });

        @if(!empty($app_settings['enablefdkim']) and $app_settings['enablefdkim'] == "on")
            setTimeout(() => {
                $("#fallbackChildBlk").slideDown();
                $("#fallbackDkimStatus").hide();

                if($("#enablefdkim").is(":checked")) {
                    $(".fallbackDkimStatus").hide();
                } else { 
                    $(".fallbackDkimStatus").show();
                }
                    

            }, 1000);
        @endif
        @if(!empty($app_settings['unauth_sending_domain']) and $app_settings['unauth_sending_domain'] == "on")
            setTimeout(() => {
                $(".blockUI").show();
                setTimeout(() => {
                    $(".blockUI").hide();
                    $("#unauthChildBlk").slideDown();
                    if($("#intellectual_tracking").is(":checked")) {
                        $(".intellectualPatternStatus").hide();
                    } else { 
                        $(".intellectualPatternStatus").show();
                    }
                    
                    
                }, 500);

            }, 1000);
        @endif

        $("#intellectual_tracking").on("change" , function() {
            if($("#intellectual_tracking").is(":checked")) {
                $(".intellectualPatternStatus").hide();
            } else { 
                $(".intellectualPatternStatus").show();
            }
        });

        $("#enablefdkim").click(function() {
            if($(this).attr("checked")) {
                $("#fallbackChildBlk").slideDown();
            } else {
                $("#fallbackChildBlk").slideUp();
            }

            if($("#enablefdkim").is(":checked")) {
                $(".fallbackDkimStatus").hide();
            } else { 
                $(".fallbackDkimStatus").show();
            }

        });

        $("#overwrite_tracking_domain").click(function() {
            if($(this).attr("checked")) {
                $("#otd_value_blk").slideDown();
            } else {
                $("#otd_value_blk").slideUp();
            }
        });

        $("#verify_it").click(function() {
            var key = $("#fallbackselector").val();
            var domain = $("#fallbackdomain").val();
            var form_data = {
                key,
                domain
            };
            $("#load").show();
            $.ajax({
                url: "{{ URL::route('setting.verify_keys') }}",
                type: 'POST',
                data: form_data,
                beforeSend: function () {
                    $("#load").show();
                },
                complete: function () {
                    $("#load").hide();
                },
                success: function(result) {
                    $(".checked2").hide();
                    $("#checked-txt-value").hide();
                    $("#verify-txt-value").hide();
                    if(result == "success") { 
                        $("#load").hide();
                         $("#checked-txt-value").show();
                         Command: toastr["success"] ("{{trans('settings.domain_verification_successfull')}}");
                         $("#verify_status").val("1")
                    } else { 
                        $("#verify-txt-value").show();
                        Command: toastr["error"] ("{{trans('settings.domain_verification_error')}}");
                        $("#verify_status").val("2")
                    }
                    
                }
            });

            // var status = $("#verify_status").val();
            // if(status == 1 ) {
            //     $(".checked2").hide();
            //     $("#checked-txt-value").hide();
            //     $("#verify-txt-value").hide();
            //     $("#load").show();
            //     setTimeout(() => {
            //         $("#load").hide();
            //         $("#checked-txt-value").show();
            //         Command: toastr["success"] ("{{trans('Domain verified successfully.')}}");
            //         $("#verify_status").val("2")
            //     }, 1500);
            // } else {
            //     $(".checked2").hide();
            //     $("#checked-txt-value").hide();
            //     $("#verify-txt-value").hide();
            //     $("#load").show();
            //     setTimeout(() => {
            //         $("#load").hide();
            //         $("#verify-txt-value").show();
            //         Command: toastr["error"] ("{{trans('Domain verification error.')}}");
            //         $("#verify_status").val("1")
            //     }, 1500);
            // }
        });

        $("body").on("keyup" , "#fallbackselector , #fallbackdomain" , function() { 
            $(".domaintrack").html($("#fallbackselector").val() + "._domain." + $("#fallbackdomain").val());
        });
            
        $("#generate_keys").click(function() {
            $(".blockUI").show();
           
            var key = $("#fallbackselector").val();
            var domain = $("#fallbackdomain").val();
            var key_size = 4096;
            if($("#dkey_size_2").is(":checked")) { 
                var key_size = 2048;
            }
            if($("#dkey_size_1").is(":checked")) { 
                var key_size = 1024;
            }

            var form_data = {
                key_size,
                key,
                domain
            };
            $.ajax({
                url: "{{ URL::route('setting.generate_keys') }}",
                type: 'POST',
                data: form_data,
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function(result) {
                    var obj = JSON.parse(result);
                    $(".blockUI").hide();
                    if(obj["status"] == "success") { 
                        $("#public_key_textarea").val(obj["public_key"]);
                        $("#private_key_textarea").val(obj["private_key"]);
                        $("#cnamecopy").html(obj["dkim_txt_record"]);
                        Command: toastr["success"] ("{{trans('settings.key_generated')}}");
                    
                        // $.ajax({
                        //     url: "{{route('configCache')}}",
                        //     type: 'GET'
                        // });
                    } else { 
                        Command: toastr["error"] ("{{trans('settings.key_generated')}}");
                    }
                   
                }
            });

           
            // setTimeout(() => {
            //     $(".blockUI").hide();
            //     $("#public_key_textarea").html("public-key-9sd7f98s7df897dsf97sd9f87s87df89s7df98sdf798sd7f987sd98f789sdf798sd9sd7f98s7df897dsf97sd9f87s87df89s7df98sdf7989sd7f98s7df897dsf97sd9f87s87df89s7df98sdf798sd7f987sd98f789sdf798sd9sd7f98s7df897dsf97sd9f87s87df89s7df98sdf798");
            //     $("#private_key_textarea").html("private-key-9sd7f98s7df897dsf97sd9f87s87df89s7df98sdf798sd7f987sd98f789sdf798sd9sd7f98s7df897dsf97sd9f87s87df89s7df98sdf7989sd7f98s7df897dsf97sd9f87s87df89s7df98sdf798sd7f987sd98f789sdf798sd9sd7f98s7df897dsf97sd9f87s87df89s7df98sdf798");
            //     Command: toastr["success"] ("{{trans('Private and Public Key Generated.')}}");
            // }, 1500);
        });

        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Settings/Application-Settings");


        $("#bcc_mail_switch").click(function() {
            if($(this).is(":checked") == true) {
                $("#bcc-Blk").slideDown();
            } else {
                $("#bcc-Blk").slideUp();
            }
        });

        $("#esp-method1").click(function() {
            $(".esp-option1").show();
            $(".esp-option2").hide();
        });

        $("#esp-method2").click(function() {
            $(".esp-option2").show();
            $(".esp-option1").hide();
        });

        $(".m-select2").select2({
            placeholder: 'Select Option'
        });

        $("#addnew").click(function() {
            $(this).hide();
            $(".repeaterBlk").slideToggle();
        });

        $(function() { 
            $(".openTrackingCron").slideUp();
           if($("#ocustom_path").is(":checked")) { 
                $(".openTrackingCron").slideDown();
           }

           $("body").on("click" , "#ocustom_path" , function() { 
                if($("#ocustom_path").is(":checked")) { 
                    $(".openTrackingCron").slideDown();
                }
           });
           $("body").on("click" , "#open_default_pathtrack" , function() { 
                $(".openTrackingCron").slideUp();
                $(".clickedFilesPath").slideUp();
                $("#default_path").prop( "checked", true );
           });
          
        });

        $(function() { 
            $(".clickTrackingCron").slideUp();
           if($("#ccustom_path").is(":checked")) { 
                $(".clickTrackingCron").slideDown();
           }

           $("body").on("click" , "#ccustom_path" , function() { 
                if($("#ccustom_path").is(":checked")) { 
                    $(".clickTrackingCron").slideDown();
                }
           });
           $("body").on("click" , "#click_default_path" , function() { 
                $(".clickTrackingCron").slideUp();
                $(".openedFilesPath").slideUp();
                $("#open_default_path").prop( "checked", true );
           });
          
        });
      
        $(function() { 
            $(".clickedFilesPath").slideUp();
           if($("#custom_path").is(":checked")) { 
                $(".clickedFilesPath").slideDown();
           }

           $("body").on("click" , "#custom_path" , function() { 
                if($("#custom_path").is(":checked")) { 
                    $(".clickedFilesPath").slideDown();
                }
           });
           $("body").on("click" , "#default_path" , function() { 
                $(".clickedFilesPath").slideUp();
           });
           $("body").on("change" , "#fallback_return_path" , function() { 
                if($(this).is(":checked")) { 
                    $("#fallbackReturnPath").show();
                } else { 
                    $("#fallbackReturnPath").hide();
                }
                
           });
          
        });

        $(function() { 
            $(".openedFilesPath").slideUp();
           if($("#open_custom_path").is(":checked")) { 
                $(".openedFilesPath").slideDown();
           }

           $("body").on("click" , "#open_custom_path" , function() { 
                if($("#open_custom_path").is(":checked")) { 
                    $(".openedFilesPath").slideDown();
                }
           });
           $("body").on("click" , "#open_default_path" , function() { 
                $(".openedFilesPath").slideUp();
           });
            $("body").on("change" , "#when-to-execute-queues" , function() { 
            if(this.value=="cronjob"){
                $('#cronjobalert').css('display','flex');
                $('#realtimealert').css('display','none');
                $('#supervisoralert').css('display','none');
            }else if(this.value=="realtime"){
                $('#realtimealert').css('display','flex');
                $('#cronjobalert').css('display','none');
                $('#supervisoralert').css('display','none');
            }else if(this.value=="supervisor"){
                $('#supervisoralert').css('display','flex');
                $('#realtimealert').css('display','none');
                $('#cronjobalert').css('display','none');
            }
           });
           $("body").on("change" , "#queue_driver" , function() { 
            if(this.value=="database"){
                $('#when-to-execute-queues-row').slideDown();
                $('#when-to-execute-queues').change();
            }else{
                $('#when-to-execute-queues-row').slideUp();
            }
           });
           $("#queue_driver").change();
        });
       

        $("#ownsversw .bootstrap-switch-label, #ownsversw .bootstrap-switch-default").click(function () { 
            $("#vercheck").toggle();
        });
        $("#ownsversw .bootstrap-switch-label, #ownsversw .bootstrap-switch-handle-on").click(function () {
            $("#vercheck").hide();
        });
        
        $("#verify1").click(function() {
            $("#versnote").css("display", "flex");
            $("#vercheck p").addClass("linethr");
            //changeDomainStatuses(1);
        });

        $("#verify2").click(function() {
            $("#versnote").hide();
            $("#vercheck p").show();
            $("#vercheck p").removeClass("linethr");
            //changeDomainStatuses(1);
        });

        $("#verify3").click(function() {
            $("#versnote").hide();
            $("#vercheck p").hide();
            //changeDomainStatuses(1);
        });
        $("#unverify1").click(function() {
            //changeDomainStatuses(0);
        });
    });
    
    $("#general-setting").validate({
        rules: {
            'segment_chunk_size': {
                required: !0,
                min: 10
            },
            'sleep_between_two_chunk_size': {
                required: !0
            },
        },
        
        submitHandler: function (form) {
            var form_data = $("#general-setting").serialize();
            $.ajax({
                url: "{{ URL::route('setting.general') }}",
                type: 'POST',
                data: form_data,
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function(result) {
                   showMsg();
                    $.ajax({
                        url: "{{route('configCache')}}",
                        type: 'GET'
                    });
                }
            });
            return false;
        }
    });
    
    $('#trigger-setting,#campaign-setting,#segment-setting,#logs-setting,#security-setting,#api_keys_settings,#contact_setting,#notifications_settings,#queue_path_settings').submit(function() {

        var form_data = $(this).serialize();
        $.ajax({
            url: "{{ URL::route('setting.general') }}",
            type: 'POST',
            data: form_data,
            beforeSend: function () {
                $(".blockUI").show();
            },
            complete: function () {
                $(".blockUI").hide();
            },
            success: function(result) {
               showMsg();
                $.ajax({
                    url: "{{route('configCache')}}",
                    type: 'GET'
                });
            }
        });
        return false;
    });

    $('#mail-setting').submit(function(){
        for (instance in CKEDITOR.instances) {
            // console.log(instance);
            CKEDITOR.instances[instance].updateElement();
        }

        var form_data = $(this).serialize();

        $.ajax({
            url: "{{ URL::route('setting.general') }}",
            type: 'POST',
            data: form_data,
            beforeSend: function () {
                $(".blockUI").show();
            },
            complete: function () {
                $(".blockUI").hide();
            },
            success: function(result) {
               showMsg();
            }
        });
        return false;
    });

    $(".maskingDmns").click(function(){
        // var is_all_domain_verify = $("#is_all_domain_verify").val();
        // changeDomainStatuses(is_all_domain_verify);
        saveDomainSetting();

    });

    // if($("#domain_verification").is(":checked")){
    //     $("#vercheck").show();
    // } else {
    //     $("#vercheck").hide();
    // }

    $("#domain_verification").click(function() {
        if($(this).is(":checked")){
            $("#versnote").hide();
            $("#vercheck p").hide();
            $("#vercheck").show();
        } else {
            $("#vercheck").hide();
        }
    });

    $('#domain-masking-setting').submit(function(){
        // var status =  $("#domain_verification").bootstrapSwitch('state');
        if($("#verify1").is(':checked')) {
            changeDomainStatuses(0);
            saveDomainSetting();
            return false;
        } else if($("#verify1").is(":not(:checked)")) {
            changeDomainStatuses(1);
            saveDomainSetting();
            return false;
        } else {
           saveDomainSetting();
            return false;
        }

    });
    function showMsg(){
       window.parent.scrollTo(0,0);
        $('#msg-text').html('{{trans('settings.message.settings_updated')}}');
        $('#msg').css("display", "flex");
        $('#msg').removeClass('display-hide alert-danger')
        $('#msg').addClass('alert alert-success')
        $('#msg').delay(3000).hide('slow'); 
    }
   
    function loadDatbaseDetails() {
        $(".blockUI").show();
        $.ajax({
            url: "{{ URL::route('setting.database.details') }}",
            type: "GET",
            success: function(result) {
                $('#tbody-data').html(result);
                $("#modal-db-details").modal('show');
                $(".blockUI").hide();
            }
        });
    }

    $('#mail-type').change(function (){
        if (this.value == 'smtp') {
                $('#thesmtp-fields').hide();
                $('#smtp-fields').show();
                $("#phpMailFunction").show();
            } else if (this.value == 'thesmtp.com') {
                $('#smtp-fields').hide();
                $('#thesmtp-fields').hide();
                $("#phpMailFunction").hide();
            } else if (this.value == 'php_mail_function') {
                $('#smtp-fields').hide();
                $('#thesmtp-fields').hide();
                $("#phpMailFunction").show();
            }
        });
    $("#mail-type").change();

    // $("#mail-type").val('smtp').change();
    function showOrHide(id,switch_id) {
        if($(switch_id).is(':checked'))
            $(id).slideDown('slow');
        else
            $(id).slideUp('slow');

    }
    $(".dns_lookup_alert").hide();
    $(".dns_lookup_domain_alert").hide();
    if($("#dns_lookup_domain").is(":checked")) $(".dns_lookup_domain_alert").show();
    if($("#dns_lookup").is(":checked")) $(".dns_lookup_alert").show();

    
    $(function() { 
        $(".mumara_dns_checkup_key").hide();
        if($("#dns_lookup_3").is(":checked")) $(".mumara_dns_checkup_key").show();
        if($("#dns_lookup_domain_3").is(":checked")) $(".mumara_dns_checkup_key").show();
    });

    $("body").on("click" , "#validateMumApi" , function() {
        $.ajax({
            url: "{{route('verify.dns.api')}}",
            type: 'POST',
            data: {'key':$("#mumara_dns_checkup_key").val()},
            complete: function(result) {
                
            },
            success: function(result) {
                var obj = JSON.parse(result);
                if(obj["status"] == "success") { 
                    Command: toastr["success"] ("Verification passed");
                } else { 
                    Command: toastr["error"] ("Verification failed");
                }
            }

        });
    });
    $("body").on("click" , "#dns_lookup_domain, #dns_lookup, #dns_lookup_2, #dns_lookup_domain_2,#dns_lookup_3, #dns_lookup_domain_3" , function() { 
        $(".dns_lookup_alert").hide();
        $(".dns_lookup_domain_alert").hide();
        if($("#dns_lookup_domain").is(":checked")) $(".dns_lookup_domain_alert").show();
        if($("#dns_lookup").is(":checked")) $(".dns_lookup_alert").show();
        $(".mumara_dns_checkup_key").hide();
        if($("#dns_lookup_3").is(":checked")) $(".mumara_dns_checkup_key").show();
        if($("#dns_lookup_domain_3").is(":checked")) $(".mumara_dns_checkup_key").show();
    });

    function showDisclaimer(id,switch_id) {
        showOrHide(id,switch_id);
    }
    showDisclaimer('#hooks_vars_disclaimer','#return_all_vars_in_hooks');

    var suppress_domain_limit = "";
    $(document).ready(function(){
      
        $("#suppress_domain_limit").keypress(function(){
            setTimeout(() => {
            var doaminLimit = $("#suppress_domain_limit").val();    
            if(doaminLimit<0){
                $("#suppress_domain_limit").val("");
            }
        }, 500);
            
            
        });
        var suppress_domain_limit = $("#suppress_domain_limit").val();
        @if(isset($app_settings['suppress_domain_limit']) && $app_settings['suppress_domain_limit']==-1)
            $("#suppress_domain_limit").val("")
        @endif
      
      $("#limit_domain_supression").click(function(){
           setTimeout(() => {
            if($('#limit_domain_supression').is(":checked")){
                $("#suppress_domain_limit_div").slideDown();
                if(suppress_domain_limit==-1) suppress_domain_limit = "";
                $("#suppress_domain_limit").val(suppress_domain_limit);
            }else{
                $("#suppress_domain_limit_div").slideUp();
                $("#suppress_domain_limit").val("");
            }
        }, 500);
      });
    });

    // $("body").on("click" , ".submitAction" , function() { 
    //     for (instance in CKEDITOR.instances) {
    //         console.log(instance);
    //         CKEDITOR.instances[instance].updateElement();
    //     }
    // });

    $("#restart_stucked_campaign_yes").click(function() {
        if($(this).is(":checked")) {
            $(".stuckedYes").slideDown();
        } else {
            $(".stuckedYes").slideUp();
        }
    });
    $("#restart_stucked_campaign_no").click(function() {
        $(".stuckedYes").slideUp();
    });


    <?php if(!empty($app_settings['google_analytics'])) {?>
        $("#g_analytic").trigger("click");
    <?php } ?>
    <?php if(!empty($app_settings['recaptcha_site_key'])) {?>
        $("#g_captcha").trigger("click");
    <?php } ?>
</script>
@endsection

@section(decide_content())

<script src="/js/libs/ckeditor/ckeditor.js"></script>
<script src="/js/libs/ckeditor/plugins/font/plugin.js"></script> 
<script src="/js/libs/ckeditor/plugins/colorbutton/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/zsuploader/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/smiley/plugin.js"></script>
<script src="/js/libs/ckfinder/ckfinder.js"></script>
@php
$recount_contact_limit = isset($app_settings['recount_contact_limit'])? $app_settings['recount_contact_limit']:'real_time';
@endphp
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="lXkSMHhx">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="zwBbOFEp">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="col-md-9 create-form" data-name="MHDQVTiX">
    <div class="row" data-name="tnAyPHus">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="NYkxcOEW">
            <div class="kt-portlet__body" data-name="mfWOsvCF">
                <div class="tabbable tabbable-tabdrop" data-name="GhYZTrxk">
                    <ul class="nav nav-tabs" role="tablist">
                    @if(rolePermission(257))
                        <li class="nav-item">
                            <a href="#tab1" class="nav-link active" data-toggle="tab">{{trans('settings.application.general.title')}}</a>
                        </li>
                    @endif
                    @if(rolePermission(258))
                        <li class="nav-item">
                            <a href="#tab2" class="nav-link" data-toggle="tab">{{trans('settings.application.mail.title')}}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a href="#tab3" class="nav-link" data-toggle="tab">
                            {{trans('settings.application.sending_domain.title')}}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#tab10" class="nav-link" data-toggle="tab">
                            Contacts
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#tab4" class="nav-link" data-toggle="tab">
                            {{trans('settings.application.broadcast.title')}}
                        </a>
                    </li>
<!--                    <li class="nav-item">
                        <a href="#tab5" class="nav-link" data-toggle="tab">
                            {{trans('settings.application.segment.title')}}
                        </a>
                    </li>-->
                    <li class="nav-item">
                        <a href="#tab6" class="nav-link" data-toggle="tab">
                        {{trans('settings.application.trigger.title')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab7" class="nav-link" data-toggle="tab">
                        {{trans('settings.application.log.title')}}
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="#tab8" class="nav-link" data-toggle="tab">
                            {{trans('settings.application.security.title')}}
                        
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="#tab9" class="nav-link" data-toggle="tab">
                            {{trans('settings.application.api_keys.title')}}
                        
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab11" class="nav-link" data-toggle="tab">
                            {{trans('settings.application.notifications.title')}}
                        
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tab12" class="nav-link" data-toggle="tab">
                            {{trans('settings.application.queue.paths')}}
                        
                        </a>
                    </li>
                    <!-- @if(rolePermission(259))
                        <li>
                            <a href="#tab3" data-toggle="tab">{{trans('Database')}}</a>
                        </li>
                    @endif -->
                    </ul>
                    <div class="tab-content" data-name="wsGMZsLW">
                    @if(rolePermission(257))
                        <div class="tab-pane active" id="tab1" data-name="sUBKevmu">
                            <div class="col-md-12" data-name="oYKRhaMS">
                                <form action="" method="POST" id="general-setting" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="general">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="lHHhFrGQ">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="pJODGrdA">
                                        <div class="kt-portlet__head" data-name="qTHZIBmc">
                                            <div class="kt-portlet__head-label" data-name="ATccxBNh">
                                                <h3 class="kt-portlet__head-title">
                                                {{trans('settings.application.general.form.heading')}}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="vztGIoPd">
                                            <div class="form-body" data-name="AwEKJyfH">
                                                <div class="form-group row" data-name="IGPJtZzm">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label switch-label top-label label-link" for="secure_url">
                                                            {{ trans('settings.application.general.form.force_secure_url') }}
                                                            {!! popover('settings.application.general.form.force_secure_url_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" data-name="DzcuEOsx" >
                                                        <div class="input-icon" data-name="QgtLpqEt">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch top-switch">
                                                                <label>
                                                                    <input  type="checkbox" id="secure_url" name="secure_url" @if(!empty($app_settings['secure_url']) and $app_settings['secure_url'] == "on") checked="" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                  <!--   <small class="dpblk pt10">{{ trans('Enable this option if you want the primary links to use HTTPS instead of HTTP') }}</small> -->
                                                    <div id="secureMsg" class="pl12" style="color:red" data-name="nwSJrYKy"></div>
                                                </div>
                                                 <div class="form-group row" data-name="lEelVvIZ">
                                                   <div class="col-md-12" id="pops" data-name="BCrPWgNz">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="col-form-label switch-label top-label label-link" for="app_debug">
                                                                    {{ trans('settings.application.general.form.debug_mode') }}
                                                                    {!! popover('settings.application.general.form.debug_mode_help','common.description') !!}
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1" data-name="vFpPbpNR">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success top-switch">
                                                                    <label>
                                                                        <input id="app_debug" type="checkbox" name="app_debug" @if($debug_mode===true) checked @endif>
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                            <!-- <small class="col-md-8 mt10">{{ trans('app.general.setting.logs_debug_help') }}</small> -->
                                                        </div>
                                                   </div>
                                               </div>
                                               <div class="form-group row" data-name="evGscJpN">
                                                   <div class="col-md-12" id="pops" data-name="PNvxUzbp">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label class="col-form-label switch-label top-label label-link" for="app_env">
                                                                    {{ trans('settings.application.general.form.development_mode') }}
                                                                    {!! popover('settings.application.general.form.development_mode_help','common.description') !!}
                                                                </label>
                                                            </div>
                                                            <div class="col-md-1" data-name="LhSRprsl">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success top-switch">
                                                                    <label>
                                                                        <input id="app_env" type="checkbox" name="app_env" @if($app_env =="development") checked @endif>
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                            <!-- <small class="col-md-8 dpblk pt10">{{ trans('app.general.setting.logs_maintenance_help') }}</small> -->
                                                        </div>
                                                   </div>
                                               </div>
                                                <div class="form-group row" data-name="TYsVPTSy">
                                                        
                                                    <div class="col-md-6" data-name="qUaAhYia">
                                                        <label class="col-form-label">
                                                              {{ trans('settings.application.general.form.url') }}
                                                        {!! popover('settings.application.general.form.url_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="QuhfVfze">
                                                            <input type="text" name="app_url" value="{{isset($setting->app_url) ? $setting->app_url : $currentHost }}" class="form-control" readonly />
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.complete_url_mumara') }}</small> -->
                                                    </div>
                                                    <div class="col-md-6" data-name="qUaAhYia">
                                                        <label class="col-form-label">
                                                              {{ trans('Application Title') }}
                                                        {!! popover('Your Application Title','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="QuhfVfze">
                                                            <input type="text" name="title" value="{{isset($app_settings['title']) ? $app_settings['title'] : "Application" }}" class="form-control" />
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.complete_url_mumara') }}</small> -->
                                                    </div>
                                                    <div class="col-md-6" data-name="FbZQxksA">
                                                        <label class="col-form-label">
                                                             {{ trans('settings.application.general.form.server_ip') }}
                                                        {!! popover('settings.application.general.form.server_ip_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="sgffvAsS">
                                                            <input type="text" name="server_ip" value="{{isset($setting->server_ip) ? $setting->server_ip : $_SERVER['SERVER_ADDR'] }}" class="form-control" readonly>
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.server_ip_help') }}</small> -->
                                                    </div>
                                                
                                                        
                                                    <div class="col-md-6" data-name="ezVqUdXg">
                                                        <label class="col-form-label">
                                                            {{ trans('settings.application.general.form.time_zone') }}
                                                        {!! popover('settings.application.general.form.time_zone_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="YxbOeveP">
                                                            <select name="time_zone" class="form-control m-select2">{
                                                                @foreach ($time_zones as $time_zone => $time_zone_name) {
                                                                    <option value="{{$time_zone}}" {{ (isset($timeZones->setting_value) && $timeZones->setting_value == $time_zone) ? 'selected' : '' }}>{{ $time_zone_name }}</option>
                                                                }
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.app_timezone_help') }}</small> -->
                                                    </div>

                                                     
                                                    <div class="col-md-6" data-name="lynqNDij">
                                                        <label class="col-form-label"> {{ trans('settings.application.general.form.msg_per_connection') }}
                                                        {!! popover('settings.application.general.form.msg_per_connection_help','common.description') !!}
                                                        </label>
                                                        <select class="form-control m-select2" name="campaign_batch_size" id="batch-size">
                                                            @foreach($camapign_batch_sizes as $batch_size)
                                                                <option value="{{ $batch_size }}" {{ (isset($app_settings['batch_size']) && $app_settings['batch_size'] == $batch_size) ? 'selected' : '' }}>{{ $batch_size }}</option>
                                                            @endforeach
                                                        </select>
                                                        <!-- <small>{{ trans('app.general.setting.number_msg_per_conn') }}</small> -->
                                                    </div>
                                                        
                                                    <div class="col-md-6" data-name="fgTpBKgo">
                                                        <label class="col-form-label"> {{ trans('settings.application.general.form.delete_log_after') }}
                                                        {!! popover('settings.application.general.form.delete_log_after_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="nAPcREGm">
                                                            <input type="number" name="keep_log_for" value="{{isset($app_settings['keep_log_for']) ? $app_settings['keep_log_for'] : -1 }}" class="form-control" />  
                                                            <small>@lang('common.label.minus_1_for_unlimited')</small>
                                                        </div>
                                                        
                                                    </div>
                                                    <!-- <div class="col-md-6">
                                                        <label class="col-form-label">{{ trans('settings.application.general.form.hourly_speed') }}
                                                        {!! popover('settings.application.general.form.hourly_speed_help','settings.application.general.form.hourly_speed') !!}
                                                        </label>
                                                        <div class="input-icon right">
                                                            <input type="text" name="hourly_sending_limit" value="{{isset($app_settings['hourly_sending_limit']) ? $app_settings['hourly_sending_limit'] : '-1' }}" class="form-control" />
                                                        </div>
                                                       <small>@lang('common.label.minus_1_for_unlimited')</small>
                                                    </div>

                                                    -->
                                                        
                                                    <div class="col-md-6" data-name="CnXPBkvK">
                                                        <label class="col-form-label">{{ trans('settings.application.general.form.daily_sending_limit') }}
                                                        {!! popover('settings.application.general.form.daily_sending_limit_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="uHPcRowm">
                                                            <input type="text" name="daily_sending_limit" value="{{isset($app_settings['daily_sending_limit']) ? $app_settings['daily_sending_limit'] : '-1' }}" class="form-control" />
                                                            <small>@lang('common.label.minus_1_for_unlimited')</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" data-name="erLLrJgC">
                                                        <label class="col-form-label">{{ trans('settings.application.general.form.monthly_sending_limit') }}
                                                        {!! popover('settings.application.general.form.monthly_sending_limit_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="QPLkedXI">
                                                            <input type="text" name="monthly_sending_limit" value="{{isset($app_settings['monthly_sending_limit']) ? $app_settings['monthly_sending_limit'] : '-1' }}" class="form-control" />
                                                            <small>@lang('common.label.minus_1_for_unlimited')</small>
                                                        </div>
                                                    </div> 
                                                    @if(!empty($package) and $package != "Lite")  
                                                    <div class="col-md-6" data-name="EWovzSmy">
                                                        <label class="col-form-label">{{ trans('settings.Maximum_contact_limit') }}
                                                        {!! popover('settings.whole_system_max_contacts','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="LxxwFsQL">
                                                            <input type="text" name="contacts_limit" value="{{isset($app_settings['contacts_limit']) ? $app_settings['contacts_limit'] : '-1' }}" class="form-control" />
                                                            <small>@lang('common.label.minus_1_for_unlimited')</small>
                                                        </div>
                                                    </div>   
                                                    @endif 

                                                    @php
                                                         $user_email = DB::table('users')->where("id" , 2)->value("email");
                                                    @endphp

                                                    <div class="col-md-6" data-name="kpOVeSCg">
                                                        <label class="col-form-label">{{ trans('settings.email_support_txt') }}
                                                        {!! popover('settings.email_support_users','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="jqOsZAIQ">
                                                            <input type="text" name="support_email" value="{{isset($app_settings['support_email']) ? $app_settings['support_email'] : $user_email }}" class="form-control" />
                                                        </div>
                                                    </div>   
                                                    
                                                    <div class="col-md-6" data-name="MdPNyXXf">
                                                        <label class="col-form-label">
                                                            {{ trans('settings.application.segment.form.chunk_size') }}
                                                             {!! popover('settings.application.segment.form.chunk_size_help','common.description') !!}
                                                        </label>
                                                        <input type="number" name="segment_chunk_size" id="segment_chunk_size" value="{{ @$app_settings['segment_chunk_size'] }}" class="form-control" required="" />
                                                    </div>
                                                    <div class="col-md-6" data-name="EubKyTgz">
                                                        <label class="col-form-label">
                                                            {{ trans('settings.application.segment.form.sleep_chunks') }}
                                                             {!! popover('settings.application.segment.form.sleep_chunks_help','common.description') !!}
                                                        </label>
                                                        <input type="number" name="sleep_between_two_chunk_size" id="sleep_between_two_chunk_size" required="" value="{{ @$app_settings['sleep_between_two_chunk_size'] }}" class="form-control" />
                                                        <small class="time-right">{{ trans('common.miliseconds') }}</small>
                                                    </div>
                                                    <div class="col-md-6" data-name="EubKyTgz">
                                                        <label class="col-form-label">
                                                            {{ trans('settings.application.segment.form.suppression_processing_chunk_size') }}
                                                             {!! popover('settings.application.segment.form.suppression_processing_chunk_size_help','common.description') !!}
                                                        </label>
                                                        <input type="number" name="suppression_processing_chunk_size" id="suppression_processing_chunk_size" required="" value="{{ @$app_settings['suppression_processing_chunk_size'] }}" class="form-control" />
                                                    </div>

                                                </div>
                                           

                                                 <div class="form-group" data-name="AiHTiXge">
                                                    <h3 class="mini_heading">@lang('settings.application.general.section.hooks')</h3>
                                                    <hr>
                                                  </div>
                                                  <div class="form-group row" data-name="lPTeosvl">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="enable_hooks_error_logging">
                                                            {{ trans('settings.application.general.form.enable_hooks_error_logging') }}
                                                            {!! popover('settings.application.general.form.enable_hooks_error_logging_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" data-name="fKTYgOJu" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!empty($app_settings['enable_hooks_error_logging']) and $app_settings['enable_hooks_error_logging'] == "on") checked @endif type="checkbox" id="enable_hooks_error_logging" name="enable_hooks_error_logging">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                                 <div class="form-group row" data-name="lPTeoxysvl">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="return_all_vars_in_hooks">
                                                            {{ trans('settings.application.general.form.return_all_vars_in_hooks') }}
                                                            {!! popover('settings.application.general.form.hooks_vars_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="fKTYxygOJu" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input onchange="showDisclaimer('#hooks_vars_disclaimer','#return_all_vars_in_hooks')" @if(!empty($app_settings['return_all_vars_in_hooks']) and $app_settings['return_all_vars_in_hooks'] == "on") checked @endif type="checkbox" id="return_all_vars_in_hooks" name="return_all_vars_in_hooks">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <div class="alert alert-warning col-md-6" style="display:none;" id="hooks_vars_disclaimer">
                                                        <div class="alert-text">{{ trans('settings.application.general.form.hooks_vars_disclaimer') }}</div>
                                                    </div>
                                                </div>

                                                <div class="form-group row" data-name="DxGNZnEx">
                                                    <label class="col-form-label col-md-12">
                                                        {{ trans('settings.application.general.form.queue_driver') }}
                                                        {!! popover('settings.application.general.form.queue_driver_help','common.description') !!}
                                                    </label>
                                                    <div class="col-md-6" data-name="wEBpFfcY" >
                                                       <select name="queue_driver" class="form-control" id="queue_driver">
                                                        <option @if( $queue_driver == "database") selected @endif value="database">@lang('settings.application.general.form.queue_driver_database')</option>
                                                        <option @if( $queue_driver == "sync") selected @endif value="sync">@lang('settings.application.general.form.queue_driver_sync')</option>
                                                       </select>
                                                    </div>
                                                    <div id="when-to-execute-queues-row" style="display:none;"  class="col-md-12 row" data-name="DxGNZnEx">
                                                        <label class="col-form-label col-md-12">
                                                            {{ trans('settings.application.general.form.when-to-execute-queues') }}
                                                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="<b>Cronjob:</b> By configuring a cronjob, you can automate the execution of queues based on your predefined schedule. <br /><br /><b>Realtime:</b> Realtime execution refers to processing queues immediately as soon as they are received. This approach ensures that tasks are executed without any delay, providing instant results. <br /><br /><b>Supervisor:</b> Supervisor is a process control system that enables you to monitor and control processes in a Unix-like environment. It provides a reliable and automated way to manage queues by supervising their execution. " data-original-title="Description"></i>
                                                        </label>
                                                        @php
                                                        $wteq=!empty($app_settings['when-to-execute-queues']) ? $app_settings['when-to-execute-queues']:'';
                                                        @endphp
                                                        <div class="col-md-6 pr0" data-name="QEBpFfcY" >
                                                        <select name="when-to-execute-queues" class="form-control mb1" id="when-to-execute-queues">
                                                            <option @if($wteq == "cronjob") selected @endif value="cronjob">@lang('settings.application.general.form.cronjob')</option>
                                                            <option @if($wteq == '' || $wteq == "realtime") selected @endif value="realtime">@lang('settings.application.general.form.realtime')</option>
                                                            <option @if($wteq == "supervisor") selected @endif value="supervisor">@lang('settings.application.general.form.supervisor')</option>
                                                        </select>
                                                            <div class="alert alert-warning mb0" style="display:none;" id="cronjobalert">
                                                                <div class="alert-text">{{ trans('settings.application.general.form.cronjob_disclaimer') }}</div>
                                                            </div>
                                                            <div class="alert alert-warning mb0" style="display:none;" id="realtimealert">
                                                                <div class="alert-text">{{ trans('settings.application.general.form.realtime_disclaimer') }}</div>
                                                            </div>
                                                            <div class="alert alert-warning mb0" style="display:none;" id="supervisoralert">
                                                                <div class="alert-text">{{ trans('settings.application.general.form.supervisor_disclaimer') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                    

                                                  <div class="form-group" data-name="TQKPOvEP">
                                                    <h3 class="mini_heading">@lang('settings.application.general.section.miscellaneous')</h3>
                                                    <hr>
                                                  </div>
                                                <div class="form-group row" data-name="sWumykuq">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="help_disable">
                                                            {{ trans('settings.application.general.form.help_article_button') }}
                                                            {!! popover('settings.application.general.form.help_article_button_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="BuuADAvz" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!empty($app_settings['help_disable']) and $app_settings['help_disable'] == "on") checked @endif type="checkbox" id="help_disable" name="help_disable">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group row" data-name="sWumykuq">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="gavatar_state">
                                                            {{ trans('settings.application.general.form.gravatar') }}
                                                            {!! popover('settings.application.general.form.gravatar_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="BuuADAvz" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!empty($app_settings['gravatar']) and $app_settings['gravatar'] == "on") checked @endif type="checkbox" id="gavatar_state" name="gavatar_state">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="alert alert-success mb0" style="display:none;" id="gravatar_allowed">
                                                                    <div class="alert-text">{{ trans('settings.application.general.form.gravatar_allowed') }}</div>
                                                        </div>
                                                        <div class="alert alert-warning mb0" style="display:none;" id="gravatar_not_allowed">
                                                            <div class="alert-text">{{ trans('settings.application.general.form.gravatar_not_allowed') }}</div>
                                                        </div> 
                                                    </div>
                                                          
                                                </div>

                                                @if($package == "Commercial ESP")
                                                <div class="form-group row" data-name="sWumykuq">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="allow_user_branding">
                                                            {{ trans('settings.application.general.form.allow_user_branding') }}
                                                            {!! popover('','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="BuuADAvz" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!empty($app_settings['allow_user_branding']) and $app_settings['allow_user_branding'] == "on") checked @endif type="checkbox" id="allow_user_branding" name="allow_user_branding">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    
                                                          
                                                </div>
                                                @endif

                                                <div class="form-group row" data-name="QqpIlBwL">
                                                   <div class="col-md-6" data-name="UrAJrqxe">
                                                        <label class="col-form-label">
                                                         {{ trans('settings.application.general.form.auto_refresh_live_events') }}
                                                        {!! popover('settings.application.general.form.auto_refresh_live_events_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="WGmofbFk">
                                                            <input type="number" name="auto_refresh_live_events" value="{{!empty($app_settings['auto_refresh_live_events']) ? $app_settings['auto_refresh_live_events'] : 3 }}" class="form-control" />
                                                        </div>
                                                        <small class="pull-right">@lang('common.seconds')</small>
                                                    </div> 
                                                </div>

                                                <div class="form-group row" data-name="QqpIlBwL">
                                                   <div class="col-md-6" data-name="UrAJrqxe">
                                                        <label class="col-form-label">
                                                         {{ trans('CTR Formula') }}
                                                        {!! popover('CTR Formula','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="WGmofbFkd">
                                                            <select name="ctr_formula" class="form-control"> 
                                                                <option @if(!empty($app_settings['ctr_formula']) && $app_settings['ctr_formula'] == "opened") selected @endif value="opened">Clicked/Opened</option>    
                                                                <option @if(!empty($app_settings['ctr_formula']) && $app_settings['ctr_formula'] == "sent") selected @endif value="sent">Clicked/Sent</option>    
                                                                <option @if(!empty($app_settings['ctr_formula']) && $app_settings['ctr_formula'] == "delivered") selected @endif value="delivered">Clicked/Delivered</option>    
                                                            </select>
                                                            
                                                        </div>
                                                    </div> 
                                                </div>

                                                {{--<div class="form-group row">
                                                    <label class="col-form-label col-md-4">
                                                        {{ trans('settings.application.general.form.sending_node_module') }}
                                                    </label>
                                                    <div class="col-md-6" >
                                                    <div class="kt-radio-inline">
                                                        <label for="modular_new" class="kt-radio">
                                                            <input {{isset($app_settings['use_esp_module'])  && $app_settings['use_esp_module']== 1 ? 'checked'  : '' }} type="radio" name="use_esp_module" value="1" id="modular_new">
                                                            {{ trans('settings.new_little_txt') }}<small>{{ trans('settings.modular_small_txt') }}</small>
                                                            <span></span>
                                                        </label>
                                                        <label for="modular_old" class="kt-radio">
                                                            <input {{(isset($app_settings['use_esp_module'])  && $app_settings['use_esp_module'] == 0) || (!isset($app_settings['use_esp_module'])) ? 'checked'  : '' }} type="radio" name="use_esp_module" value="0" id="modular_old" >
                                                            {{ trans('settings.old_little_txt') }} <small>{{ trans('settings.core_small_txt') }}</small>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    </div>
                                                </div> --}}
                                                
                                                  
                                            </div>
                                        </div>
                                        <div class="kt-portlet__footer" data-name="tOfuRCDk">
                                            <div class="form-actions" data-name="tMMXHaoT">
                                               <button {{$attribute}} type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    @endif
                    @if(rolePermission(257))
                        <div class="tab-pane" id="tab2" data-name="rsLdTFpY">
                            <div class="col-md-12" data-name="rgHXSydU">
                                <form action="" method="POST" id="mail-setting" class="kt-form kt-form--label-right" novalidate>
                                <input type="hidden" name="setting_type" value="mail">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="yGRCbNTD">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="xYFzxoVi">
                                        <div class="kt-portlet__head" data-name="ENjtBKsO">
                                            <div class="kt-portlet__head-label" data-name="PDBIUKCn">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.application.mail.form.heading')}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="VJeadNzb">
                                            <div class="form-body" data-name="ozqoMzeS">
                                                <div class="form-group row" data-name="JbrxgiqT">
                                                    <!-- <p class="pl12 col-md-12">{{trans('settings.application.mail.form.desc')}}</p> -->
                                                    <div class="col-md-6" data-name="BKaiWLfp">
                                                        <label class="col-form-label">{{ trans('settings.application.mail.form.mail_type') }}
                                                        {!! popover('settings.application.mail.form.mail_type_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="WfDGwHGb">
                                                            <select name="mail_type" class="form-control" id="mail-type">
                                                                <option value="php_mail_function" {{ (isset($app_settings["mail_type"]) && $app_settings["mail_type"] == 'php_mail_function') ? 'selected' : '' }}>{{ trans('settings.application.mail.form.mail_function') }}</option> 
                                                                <option value="smtp" {{ (isset($app_settings["mail_type"]) && $app_settings["mail_type"] == 'smtp') ? 'selected' : '' }}>{{ trans('settings.application.mail.form.smtp') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                                 <div id="smtp-fields" style="display: none;" data-name="nVLHioGp">
                                                    <div class="form-group row" data-name="eFVUmdTE">
                                                        <div class="col-md-6" data-name="oucalAiS" >
                                                            <label class="col-form-label">{{trans('common.label.host')}}
                                                                 {!! popover('settings.application.mail.form.host_help','common.description') !!}
                                                            </label>
                                                            <div class="input-icon right" data-name="fctkfAue">
                                                                <input type="text" name="host" class="form-control" value="{{isset($mail_attributes['host']) ? $mail_attributes['host'] : '' }}" required />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" data-name="RDlEELmk">
                                                            <label class="col-form-label">{{trans('common.label.username')}}
                                                                {!! popover('settings.application.mail.form.username_help','common.description') !!}
                                                            </label>
                                                            <div class="input-icon right" data-name="NzWcMeRK">
                                                                <input type="text" name="username" class="form-control" value="{{isset($mail_attributes['username']) ? $mail_attributes['username'] : '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="xTYuNMcm">
                                                            
                                                        <div class="col-md-6" data-name="LadYeCyC">
                                                            <label class="col-form-label">{{trans('common.label.password')}}
                                                                {!! popover('settings.application.mail.form.password_help','common.description') !!}
                                                            </label>
                                                            <div class="input-icon right" data-name="iYgRiOmS">
                                                                @php
                                                                try {
                                                                    $password =decrypt($mail_attributes['password']);
                                                                } catch(\Exception $e) {
                                                                    $password = '';
                                                                }
                                                                @endphp
                                                                <input type="password" name="password" id="password" value="{{$password}}" class="form-control"  autocomplete="off" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" data-name="fSNQOpUy">
                                                            <label class="col-form-label">{{trans('common.label.port')}}
                                                                {!! popover('settings.application.mail.form.port_help','common.description') !!}
                                                            </label>
                                                            <div class="input-icon right" data-name="SzSuiKOG">
                                                                <input type="text" name="port" class="form-control" value="{{isset($mail_attributes['port']) ? $mail_attributes['port'] : '' }}" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" data-name="RkBvSTHx">
                                                            
                                                        <div class="col-md-6" data-name="PortaQEv">
                                                            <label class="col-form-label">{{trans('common.label.encryption')}}
                                                                 {!! popover('settings.application.mail.form.encryption_help','common.description') !!}
                                                            </label>
                                                            <select class="form-control" name="smtp_encryption">
                                                                <option value="">{{trans('common.label.none')}}</option>
                                                                <option value="ssl" {{ (isset($mail_attributes['smtp_encryption']) && $mail_attributes['smtp_encryption'] == 'ssl') ? 'selected' : '' }}>{{trans('common.label.ssl')}}</option>
                                                                <option value="tls" {{ (isset($mail_attributes['smtp_encryption']) && $mail_attributes['smtp_encryption'] == 'tls') ? 'selected' : '' }}>{{trans('common.label.tls')}}</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6" data-name="XrPDqOtf">
                                                            <label class="col-form-label">{{trans('common.label.mail_encoding')}}
                                                                 {!! popover('settings.application.mail.form.mail_encoding_help','common.description') !!}
                                                            </label>
                                                            <select class="form-control" name="mail_encoding">
                                                                <option value="8bit" {{ (isset($mail_attributes['mail_encoding']) && $mail_attributes['mail_encoding'] == '8bit') ? 'selected' : '' }}>{{trans('common.label.8bit')}}</option>
                                                                <option value="7bit" {{ (isset($mail_attributes['mail_encoding']) && $mail_attributes['mail_encoding'] == '7bit') ? 'selected' : '' }}>{{trans('common.label.7bit')}}</option>
                                                                <option value="binary" {{ (isset($mail_attributes['mail_encoding']) && $mail_attributes['mail_encoding'] == 'binary') ? 'selected' : '' }}>{{trans('common.label.binary')}}</option>
                                                                <option value="base64" {{ (isset($mail_attributes['mail_encoding']) && $mail_attributes['mail_encoding'] == 'base64') ? 'selected' : '' }}>{{trans('common.label.base64')}}</option>
                                                                <option value="quoted_printable" {{ (isset($mail_attributes['mail_encoding']) && $mail_attributes['mail_encoding'] == 'quoted_printable') ? 'selected' : '' }}>{{trans('common.label.quoted_printable')}}</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="phpMailFunction" style="display: none;" data-name="exfCtTsT">
                                                    <div class="form-group row" data-name="wDpAVUoH">

                                                        <div class="col-md-6" data-name="AJmVCQio">
                                                            <label class="col-form-label">{{trans('settings.application.mail.form.sender_name')}}
                                                                {!! popover('settings.application.mail.form.sender_name_help','common.description') !!}
                                                            </label>
                                                            <?php 
                                                                $title = getSetting("title");
                                                                $sendeing_email = Auth::user()->email;
                                                            ?>
                                                            <div class="input-icon right" data-name="cAuVlONs">
                                                                <input type="text" name="from_name" value="{{isset($mail_attributes['from_name']) ? $mail_attributes['from_name'] :  $title  }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" data-name="wcXmCZkb">
                                                            <label class="col-form-label">{{trans('settings.application.mail.form.sender_email')}}
                                                                 {!! popover('settings.application.mail.form.sender_email_help','common.description') !!}
                                                            </label>
                                                            <div class="input-icon right" data-name="FKFHLxhz">
                                                                <input type="text" name="from_email" value="{{isset($mail_attributes['from_email']) ? $mail_attributes['from_email'] : $sendeing_email  }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" data-name="WpdRSxsl">

                                                        <div class="col-md-4" data-name="qoRvpYkG">
                                                            <label class="col-form-label label-link" for="bcc_mail_switch">{{trans('settings.application.mail.form.bcc_email')}}
                                                                 {!! popover('settings.application.mail.form.bcc_email_help','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch">
                                                                <label>
                                                                    <input name="bcc_mail_switch" id="bcc_mail_switch" type="checkbox" {{isset($mail_attributes['bcc_email'])?'checked':''}}>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div class="input-icon col-md-6" id="bcc-Blk" data-name="bOmMqiNT" style="display:{{isset($mail_attributes['bcc_email'])?'block;':'none;'}};">
                                                            <input type="text" name="bcc_email" value="{{isset($mail_attributes['bcc_email']) ? $mail_attributes['bcc_email'] : '' }}" class="form-control" />
                                                            <!-- <small>{{ trans('app.general.setting.bcc_email_help') }}</small> -->
                                                        </div>
                                                    </div>
                                                    <hr class="mails-hr" />
                                                    <div class="form-group row" data-name="QUDkrNIo">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label setting-mail-label-option label-link" for="add_header_footer">{{trans('settings.application.mail.form.global_header_footer')}}
                                                                {!! popover('settings.application.mail.form.global_header_footer_help','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" data-name="suYPBWAh">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input onchange="showOrHide('#add_header_footer_div','#add_header_footer')" id="add_header_footer" type="checkbox" name="add_header_footer"  @if(isset($app_settings['add_header_footer']) && $app_settings['add_header_footer']=='1') checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>

                                                        </div>
                                                    </div>

                                                    <?php
                                                        $defaulHtml = "<html>\n";
                                                        $defaulHtml .= "<head>\n";
                                                        $defaulHtml .= "    <title> </title>\n "   ;
                                                        $defaulHtml .= "</head>\n";
                                                        $defaulHtml .= "<body> \n";
                                                        $defaulHtml .= "</body>\n";
                                                        $defaulHtml .= "</html>\n";
                                                    ?>
                                                    <div id="add_header_footer_div" style="@if(isset($app_settings['add_header_footer']) && $app_settings['add_header_footer']=='1') display: block; @else display: none; @endif" data-name="PjHZYhHq">
                                                        <div class="form-group row" data-name="uiroDVKv">
                                                            <div class="col-md-12" data-name="sJLPCkq6">
                                                                <span class="alert alert-solid-dark alert-bold mb1">{{ trans('settings.application.mail.form.global_header_footer_alert') }}</span>
                                                            </div>
                                                            <div class="col-md-12" data-name="sJLPCkqQ">
                                                                <label class="col-form-label" for="email_global_header">{{ trans('settings.application.mail.form.email_global_header') }}
                                                                    {!! popover('settings.application.mail.form.email_global_header_help','common.description') !!}
                                                                </label>
                                                                <div class="input-icon right position-relative" data-name="DxOxSLFH">
                                                                    <a id="egh" href="javascript:;" class="pageview"><i class="fa fa-eye"></i></a>
                                                                    <textarea name="email_global_header" id="email_global_header" class="form-control" rows="8">{{isset($mail_attributes['email_global_header']) ? $mail_attributes['email_global_header'] : $defaulHtml }}</textarea>
                                                                </div>
                                                                <!-- <small>{{ trans('app.general.setting.email_global_header_help') }}</small> -->
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" data-name="vSqUkZMo">
                                                            <div class="col-md-12" data-name="ffOjqgji">
                                                                <label class="col-form-label">{{ trans('settings.application.mail.form.email_global_footer') }}
                                                                    {!! popover('settings.application.mail.form.email_global_footer_help','common.description') !!}
                                                                </label>
                                                                <div class="input-icon right position-relative" data-name="cegOdBaG">
                                                                    <a id="egf" href="javascript:;" class="pageview"><i class="fa fa-eye"></i></a>
                                                                    <textarea name="email_global_footer" id="mail_global_footer" class="form-control" rows="8">{{isset($mail_attributes['email_global_footer']) ? $mail_attributes['email_global_footer'] : $defaulHtml }}</textarea>
                                                                </div>
                                                                <!-- <small>{{ trans('app.general.setting.email_globalfooter_help') }}</small> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="hQCuWJTE">
                                                        <div class="col-md-4" data-name="UzkNMuV4">
                                                            <label class="col-form-label setting-mail-label-option label-link" for="pops01">{{ trans('settings.application.mail.form.force_unsubscribe_link') }}
                                                                {!! popover('settings.application.mail.form.force_unsubscribe_link_help','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" data-name="UzkNMuVa">
                                                            @if(isset($mail_attributes['force_unsubscribe_link']))
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input id="pops01" type="checkbox" name="force_unsubscribe_link" checked="">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            @else
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input id="pops01" type="checkbox" name="force_unsubscribe_link" >
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            @endif
                                                            <!-- <small class="mail-switch">{{ trans('app.general.setting.force_unsubscribe_link_help') }}</small> -->
                                                        </div>
                                                    </div>
                                                     <div class="form-group row" data-name="ByYwiCgq">
                                                        <div class="col-md-4" data-name="EzpoIypw">
                                                            <label class="col-form-label setting-mail-label-option label-link" for="send_systematic_email_to_admin">{{ trans('settings.application.mail.form.send_systematic_email_to_admin') }}
                                                                {!! popover('settings.application.mail.form.send_systematic_email_to_admin_help','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" data-name="EzpoIypy">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input id="send_systematic_email_to_admin" type="checkbox" name="send_systematic_email_to_admin" @if( (!isset($app_settings['send_systematic_email_to_admin']) || (isset($app_settings['send_systematic_email_to_admin']) && $app_settings['send_systematic_email_to_admin']=='1'))) checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            <!-- <small class="mail-switch">{{ trans('app.general.setting.force_unsubscribe_link_help') }}</small> -->
                                                        </div>
                                                    </div>


                                                    <div class="form-group row" data-name="iqAppyNM">
                                                        <div class="col-md-4" data-name="EzpoIype">
                                                            <label class="col-form-label setting-mail-label-option label-link" for="gmail_header_feedback">{{ trans('settings.feedback_id_gmail') }}
                                                                {!! popover('settings.header_feedback_outgoing', 'common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" data-name="FzXcqFYP">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input id="gmail_header_feedback" type="checkbox" name="gmail_header_feedback" @if((isset($app_settings['gmail_header_feedback']) && $app_settings['gmail_header_feedback']=='1'))) checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            <!-- <small class="mail-switch">{{ trans('app.general.setting.force_unsubscribe_link_help') }}</small> -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="iqAppyNM">
                                                        <div class="col-md-4" data-name="EzpoIypg">
                                                            <label class="col-form-label setting-mail-label-option label-link" for="enable_unsubscribe_form">{{ trans('settings.application.enable_unsub_form_title') }}
                                                                <?php $msg = trans('settings.application.enable_unsub_form_desc' ,  ["domain_name" => url('unsubscribe')]) ?>
                                                                {!! popover("$msg", 'common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" data-name="FzXcqFYP">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input id="enable_unsubscribe_form" type="checkbox" name="enable_unsubscribe_form" @if((isset($app_settings['enable_unsubscribe_form']) && $app_settings['enable_unsubscribe_form']=='1'))) checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            <!-- <small class="mail-switch">{{ trans('app.general.setting.force_unsubscribe_link_help') }}</small> -->
                                                        </div>
                                                    </div>



                                                    <div class="form-group row" data-name="iqAppyNM">
                                                        <div class="col-md-4" data-name="EzpoIypg">
                                                            <label class="col-form-label setting-mail-label-option label-link" for="enable_msgId_tracking">{{ trans('Embed Message ID in the tracking links') }}
                                                                <?php $msg = trans('settings.application.enable_unsub_form_desc' ,  ["domain_name" => url('unsubscribe')]) ?>
                                                                {!! popover("Embed Message ID in the tracking links.", 'common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" data-name="FzXcqFYP">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input id="enable_msgId_tracking" type="checkbox" name="enable_msgId_tracking" @if((isset($app_settings['enable_msgId_tracking']) && $app_settings['enable_msgId_tracking']=='1')) checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            <!-- <small class="mail-switch">{{ trans('app.general.setting.force_unsubscribe_link_help') }}</small> -->
                                                        </div>
                                                    </div>


                                                    <div class="form-group row" data-name="iqAppyNM">
                                                        <div class="col-md-4" data-name="EzpoIypg">
                                                            <label class="col-form-label setting-mail-label-option label-link" for="enable_utc_timestamp">{{ trans('Embed Current UTC timestamp in the tracking links') }}
                                                                <?php $msg = trans('Embed Current UTC timestamp in the tracking links.'); ?>
                                                                {!! popover("$msg", 'common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" data-name="FzXcqFYP">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input id="enable_utc_timestamp" type="checkbox" name="enable_utc_timestamp" @if((isset($app_settings['enable_utc_timestamp']) && $app_settings['enable_utc_timestamp']=='1'))) checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            <!-- <small class="mail-switch">{{ trans('app.general.setting.force_unsubscribe_link_help') }}</small> -->
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" data-name="iqAppyNM">
                                                        <div class="col-md-4" data-name="EzpoIypg">
                                                            <label class="col-form-label setting-mail-label-option label-link" for="enable_from_email">{{ trans('Embed from name/email in the tracking links') }}
                                                                <?php $msg = trans('Embed from name/email in the tracking links.'); ?>
                                                                {!! popover("$msg", 'common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" data-name="FzXcqFYP">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success bcc-switch setting-mail-switch-option">
                                                                <label>
                                                                    <input id="enable_from_email" type="checkbox" name="enable_from_email" @if((isset($app_settings['enable_from_email']) && $app_settings['enable_from_email']=='1'))) checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            <!-- <small class="mail-switch">{{ trans('app.general.setting.force_unsubscribe_link_help') }}</small> -->
                                                        </div>
                                                    </div>


                                                </div>
                                               
                                                <div id="thesmtp-fields" style="display: none;" data-name="OfEVhUkb">
                                                    <div class="form-group row" data-name="GPUESpFL">
                                                            
                                                        <div class="col-md-6" data-name="fkxLsBDF">
                                                            <label class="col-form-label col-md-3">{{trans('app.settings.cron.heading')}}
                                                            </label>
                                                            <div class="input-icon right" data-name="gWumYpcI">
                                                                <input type="text" name="api_token" value="{{isset($mail_attributes['api_token']) ? $mail_attributes['api_token'] : '' }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="FJRJPHmD">
                                                        <label class="col-form-label col-md-3">{{trans('app.general.setting.login_email')}}
                                                        </label>
                                                        <div class="col-md-6" data-name="fYQifoVR">
                                                            <div class="input-icon right" data-name="VEHqkfjf">
                                                                <input type="text" name="login_email" value="{{isset($mail_attributes['login_email']) ? $mail_attributes['login_email'] : '' }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="vyotkRlb">
                                                        <label class="col-form-label col-md-3">{{trans('app.general.setting.connect')}}
                                                        </label>
                                                        <div class="col-md-6" data-name="RKLCdRVS">
                                                            <div class="input-icon right" data-name="Pxoowasz">
                                                                <button type="button" name="submit" class="btn green">{{trans('common.form.buttons.submit')}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="nXVOucUF">
                                                    <label class="col-form-label col-md-3">{{trans('app.general.setting.email_from_name')}}
                                                    </label>
                                                    <div class="col-md-6" data-name="OIdiYczy">
                                                        <div class="input-icon right" data-name="QqKcnNDC">
                                                            <input type="text" name="from_namek" value="{{isset($mail_attributes['from_name']) ? $mail_attributes['from_name'] : '' }}" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="form-group row" data-name="sthfThwt">
                                                        <label class="col-form-label col-md-3">{{trans('app.general.setting.email_from_email')}}
                                                        </label>
                                                        <div class="col-md-6" data-name="gHoxbcPL">
                                                            <div class="input-icon right" data-name="TdlnSmJH">
                                                                <input type="text" name="from_emailk" value="{{isset($mail_attributes['from_email']) ? $mail_attributes['from_email'] : '' }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group" data-name="hCPJupRo">
                                                        <label class="col-form-label col-md-3">{{trans('app.general.setting.bcc_emails')}}
                                                        </label>
                                                        <div class="col-md-6" data-name="RQwsfEOw">
                                                            <div class="input-icon right" data-name="LwcbtSOU">
                                                                <input type="text" name="bcc_emailk" value="{{isset($mail_attributes['bcc_email']) ? $mail_attributes['bcc_email'] : '' }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="ORuZSAzW">
                                                        <label class="col-form-label col-md-3">{{trans('app.general.setting.email_global_header')}}</label>
                                                        <div class="col-md-6" data-name="nRufbcRE">
                                                            <div class="input-icon right" data-name="kEbiGZZJ">
                                                                <textarea name="email_global_header_smtp" class="form-control" rows="8">{{isset($mail_attributes['email_global_header']) ? $mail_attributes['email_global_header'] : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="SjBrCvNq">
                                                        <label class="col-form-label col-md-3">{{trans('app.general.setting.email_global_footer')}}</label>
                                                        <div class="col-md-6" data-name="VXWyCVMI">
                                                            <div class="input-icon right" data-name="UrokLKOz">
                                                                <textarea name="email_global_footer_smtp" class="form-control" rows="8">{{isset($mail_attributes['email_global_footer']) ? $mail_attributes['email_global_footer'] : '' }}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="tYOjvDlM">
                                                        <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.unsubscribe_link')}}</label>
                                                        <div class="col-md-6" data-name="oWqjNeth">
                                                            <div class="input-icon right" data-name="wyxSxsyb">
                                                            @if(isset($mail_attributes['unsubscribe_link']))
                                                            <input type="checkbox" data-switch="true" data-on-color="success" name="unsubscribe_link" data-on-text="Yes" checked data-off-text="No">
                                                            @else
                                                            <input type="checkbox" data-switch="true" data-on-color="success" name="unsubscribe_link" data-on-text="Yes" data-off-text="No">
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php /*
                                                    <div class="form-group row" data-name="tPXceCvD">
                                                        <label class="col-form-label col-md-3">{{trans('app.general.setting.force_unsubscribe_link')}}</label>
                                                        <div class="col-md-6" data-name="XkodHPQc">
                                                            <div class="input-icon right" data-name="RWJpxsnE">
                                                            @if(isset($mail_attributes['force_unsubscribe_link']))
                                                                <input type="checkbox" data-switch="true" data-on-color="success" name="force_unsubscribe_link" data-on-text="Yes" data-off-text="No" checked>
                                                            @else
                                                                <input type="checkbox" data-switch="true" data-on-color="success" name="force_unsubscribe_link" data-on-text="Yes" data-off-text="No">
                                                            @endif
                                                            </div>
                                                        </div>
                                                    </div> */?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__footer" data-name="DesjohJT">
                                            <div class="form-actions" data-name="dntmXpiJ">
                                                <div class="row" data-name="PgFLGXJy">
                                                    <div class="col-md-12" data-name="dCwnLDKF">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success submitAction">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        </div>
                    @endif
                    <div class="tab-pane" id="tab3" data-name="DlWhRMIr">
                            <div class="col-md-12" data-name="vTavTNlo">
                                <form action="" method="POST" id="domain-masking-setting" class="kt-form kt-form--label-right" novalidate>
                                <input type="hidden" name="setting_type" value="domain_masking">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="lRdNXtYC">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="NpJjfhXu">
                                        <div class="kt-portlet__head" data-name="AaBTTsra">
                                            <div class="kt-portlet__head-label" data-name="WPiaUnkN">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.application.sending_domain.form.heading')}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="ChPauQEB">
                                            <div class="form-body" data-name="hoVwunRN">
                                                <div class="form-group row" data-name="ZwKZxuIR">
                                                        
                                                    <div class="col-md-6" data-name="XmdOSDLP">
                                                        <label class="col-form-label"> 
                                                            {{trans('settings.application.sending_domain.form.default_dkim_selector')}}
                                                            {!! popover('settings.application.sending_domain.form.default_dkim_selector_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="CROevjZg">
                                                            <input type="text" name="default_dkim_selector" value="{{isset($app_settings['default_dkim_selector']) ? $app_settings['default_dkim_selector'] : 'key' }}" class="form-control" />
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.dkim_selector_help') }}</small> -->
                                                    </div>
                                                    <div class="col-md-6" data-name="EetdKzgb">
                                                        <label class="col-form-label">
                                                            {{trans('settings.application.sending_domain.form.default_tracking_domain_selector')}}
                                                            {!! popover('settings.application.sending_domain.form.default_tracking_domain_selector_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="VCQvyssG">
                                                            <input type="text" name="default_tracking_selector" value="{{isset($app_settings['default_tracking_selector']) ? $app_settings['default_tracking_selector'] : 'click' }}" class="form-control" />
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.tracking_domain_selector_help') }}</small> -->
                                                    </div>
                                                </div>

                                                <div class="form-group row" data-name="csSqRnkL">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            {{trans('settings.application.sending_domain.form.domain_key_size_in_bits')}}
                                                            {!! popover('settings.application.sending_domain.form.domain_key_size_in_bits_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="keys_size kt-radio-inline" data-name="bsIzZGfr">
                                                            <label for="key_size_1" class="kt-radio first-radio lg"><input type="radio" name="key_size" value="512" id="key_size_1" {{isset($app_settings['key_size']) && $app_settings['key_size']=='512'? "checked":"" }}>
                                                            512 <span></span></label>
                                                            <label for="key_size_2" class="kt-radio first-radio lg"><input type="radio" name="key_size" value="1024" id="key_size_2" {{isset($app_settings['key_size']) && $app_settings['key_size']=='1024'? "checked":"" }}>
                                                            1024 <span></span></label>
                                                            <label for="key_size_3" class="kt-radio"><input type="radio" name="key_size" value="2048" id="key_size_3" {{isset($app_settings['key_size']) && $app_settings['key_size']=='2048'? "checked":"" }}>
                                                            2048 <span></span></label>
                                                            <label for="key_size_4" class="kt-radio"><input type="radio" name="key_size" value="4096" id="key_size_4" {{isset($app_settings['key_size']) && $app_settings['key_size']=='4096'? "checked":"" }}>
                                                            4096 <span></span></label>
                                                        </div>
                                                    </div>
                                                    <!-- <small class="pl12 col-md-5 sdomain-blt-help">{{ trans('app.general.setting.domain_key_size_help') }}</small> -->
                                                </div>


                                                <div class="form-group row" data-name="csSqRnkL">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            {{trans('settings.application.sending_domain.form.domain_dns_check_domain')}}
                                                            {!! popover('settings.application.sending_domain.form.domain_dns_check_desc_domain','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="keys_size kt-radio-inline" data-name="bsIzZGfr">
                                                            <label for="dns_lookup_domain" class="kt-radio first-radio lg"><input type="radio" name="dns_lookup_domain" value="1" id="dns_lookup_domain" {{!isset($app_settings['dns_lookup_domain']) || isset($app_settings['dns_lookup_domain']) && $app_settings['dns_lookup_domain']=='1'? "checked":"" }}>
                                                            {{trans('settings.application.sending_domain.form.domain_dns_check_option1')}} <span></span></label>
                                                            <label for="dns_lookup_domain_2" class="kt-radio"><input type="radio" name="dns_lookup_domain" value="2" id="dns_lookup_domain_2" {{isset($app_settings['dns_lookup_domain']) && $app_settings['dns_lookup_domain']=='2'? "checked":"" }}>
                                                            {{trans('settings.application.sending_domain.form.domain_dns_check_option2')}} <span></span></label>
                                                            @if($package == "Commercial ESP")
                                                                <label for="dns_lookup_domain_3" class="kt-radio"><input type="radio" name="dns_lookup_domain" value="3" id="dns_lookup_domain_3" {{isset($app_settings['dns_lookup_domain']) && $app_settings['dns_lookup_domain']=='3'? "checked":"" }}>
                                                                {{trans('settings.application.sending_domain.form.commercial_esp_mumara')}} <span></span></label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">  
                                                        <small class=" dns_lookup_domain_alert" style='display:none'><b>{{ trans('settings.note_bold') }} </b> <code>{{ trans('settings.dig_code') }}</code> {{ trans('settings.your_server_install') }}</small>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row" data-name="csSqRnkL">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            {{trans('settings.application.sending_domain.form.domain_dns_check')}}
                                                            {!! popover('settings.application.sending_domain.form.domain_dns_check_desc','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="keys_size kt-radio-inline" data-name="bsIzZGfr">
                                                            <label for="dns_lookup" class="kt-radio first-radio lg"><input type="radio" name="dns_lookup" value="1" id="dns_lookup" {{isset($app_settings['dns_lookup']) && $app_settings['dns_lookup']=='1'? "checked":"" }}>
                                                            {{trans('settings.application.sending_domain.form.domain_dns_check_option1')}} <span></span></label>
                                                            <label for="dns_lookup_2" class="kt-radio"><input type="radio" name="dns_lookup" value="2" id="dns_lookup_2" {{!isset($app_settings['dns_lookup']) || isset($app_settings['dns_lookup']) && $app_settings['dns_lookup']=='2'? "checked":"" }}>
                                                            {{trans('settings.application.sending_domain.form.domain_dns_check_option2')}} <span></span></label>

                                                            @if($package == "Commercial ESP")
                                                                <label for="dns_lookup_3" class="kt-radio"><input type="radio" name="dns_lookup" value="3" id="dns_lookup_3" {{isset($app_settings['dns_lookup']) && $app_settings['dns_lookup']=='3'? "checked":"" }}>
                                                                {{trans('settings.application.sending_domain.form.commercial_esp_mumara')}} <span></span></label>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12"> 
                                                        <small class=" sdomain-blt-help dns_lookup_alert" style="display:none"><b> {{ trans('settings.note_bold') }} </b> <code>{{ trans('settings.dig_code') }}</code> {{ trans('settings.your_server_install') }} </small>
                                                    </div>
                                                </div>


                                                @if($package == "Commercial ESP")


                                                    <div class="form-group row mumara_dns_checkup_key" data-name="xTYuNMcm"  @if(empty($app_settings['mumara_dns_checkup_key'])) style="display:none" @endif >
                                                        <label class="col-form-label col-md-4">{{ trans('settings.application.sending_domain.form.mumara_dns_checkup_key') }}
                                                            {!! popover('settings.application.sending_domain.form.mumara_dns_checkup_key_desc','common.description') !!}
                                                        </label>
                                                        <div class="col-md-5" data-name="LadYeCyC">
                                                            <div class="input-icon right" data-name="iYgRiOmS">
                                                                    <input type="text" name="mumara_dns_checkup_key" id="mumara_dns_checkup_key" value="{{isset($app_settings['mumara_dns_checkup_key']) ? $app_settings['mumara_dns_checkup_key'] : '' }}"  class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        <div class="input-icon right" data-name="iYgRiOmS">
                                                            <a href="javascript:void(0);" id="validateMumApi" class="btn btn-primary">Validate </a>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" data-name="zmUpVsuh">
                                                        <div class="col-md-4 l-icon">
                                                            <label class="col-form-label switch label-link" for="fallback_return_path">
                                                                {{ trans('Enable Fallback Return-Path') }}
                                                                {!! popover('Enable Fallback Return-Path','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" id="pops" data-name="MLpbsJlj">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success oppo">
                                                                <label>
                                                                    <input id="fallback_return_path" type="checkbox"  name="fallback_return_path"  @if(!empty($app_settings['fallback_return_path']) and $app_settings['fallback_return_path'] == "on") checked="" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>    

                                                    <div class="form-group row" data-name="xTYuNMcm" id="fallbackReturnPath" @if(!empty($app_settings['fallback_return_path']) and $app_settings['fallback_return_path'] == "off") style="display:none" @endif >
                                                        <div class="col-md-6" data-name="LadYeCyC">
                                                            <label class="col-form-label">Fallback Domain
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Password" data-original-title="Description"></i>
                                                            </label>
                                                            <div class="input-icon right" data-name="iYgRiOmS">
                                                                    <input type="text" name="fallback_return_path_domain" id="fallback_return_path_domain" value="{{isset($app_settings['fallback_return_path_domain']) ? $app_settings['fallback_return_path_domain'] : '' }}"  class="form-control" autocomplete="off">
                                                            </div>
                                                        </div>
                                                        
                                                    </div>


                                                    <div class="form-group row" data-name="WSbsQHXu">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label">
                                                                {{ trans('settings.bounce_methord_label') }}
                                                                {!! popover('settings.popover_set_pop_imap','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="keys_size kt-radio-inline" data-name="vAwFfRLB" >
                                                                <label for="imape_switch" class="kt-radio"><input type="radio" name="imap_switch" @if(!empty($app_settings['imap_switch']) and $app_settings['imap_switch'] == "1") checked @endif id="imape_switch" value="1">
                                                                {{trans('settings.label_pop_imap')}}  <span></span></label>
                                                                <label for="route_bounce_server" class="kt-radio"><input type="radio" name="imap_switch" @if(!empty($app_settings['imap_switch']) and $app_settings['imap_switch'] == "2") checked="" @endif id="route_bounce_server" value="2">{{trans('settings.route_bounce')}} <span></span></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div id="route_bounce_server_ok" data-name="FZzicfLa">
                                                        <div class="form-group row" data-name="btkBeKKl">
                                                            <div class="col-md-4" data-name="WAJWpBTK">
                                                                <label class="col-form-label">
                                                                    {{trans('settings.application.sending_domain.form.spf_include_prefix')}}
                                                                </label>
                                                                <div class="input-icon right" data-name="JNhrIRPS">
                                                                    <input type="text" name="bounce_domain_prefix" value="{{isset($app_settings['bounce_domain_prefix']) ? $app_settings['bounce_domain_prefix'] : '' }}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" data-name="TiFwsTsp">
                                                                <label class="col-form-label"> 
                                                                    {{trans('settings.application.sending_domain.form.bounce_domain_for_mx')}}
                                                                </label>
                                                                <div class="input-icon right" data-name="ShDiVowf">
                                                                    <input type="text" name="bounce_domain_for_mx" value="{{isset($app_settings['bounce_domain_for_mx']) ? $app_settings['bounce_domain_for_mx'] : '' }}" class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4" data-name="GXZPKSqq">
                                                                <label class="col-form-label">
                                                                    {{trans('settings.application.sending_domain.form.spf_include_domain')}}
                                                                </label>
                                                                <div class="input-icon right" data-name="XkyIPBvD">
                                                                    <input type="text" name="bounce_domain_for_spf" value="{{isset($app_settings['bounce_domain_for_spf']) ? $app_settings['bounce_domain_for_spf'] : '' }}" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="form-group row" data-name="jBpQLNHC">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label switch label-link" for="allow_duplicate_sending_domains">
                                                        {{trans('settings.application.sending_domain.form.allow_duplicate_sending_domains')}}
                                                        {!! popover('settings.application.sending_domain.form.allow_duplicate_sending_domains_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" data-name="pDpQfqYM">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success dup-sending-domain">
                                                            <label>
                                                                <input type="checkbox" name="allow_duplicate_sending_domains" @if(isset($app_settings['allow_duplicate_sending_domains']) && $app_settings['allow_duplicate_sending_domains']=='1') checked="checked" @endif id="allow_duplicate_sending_domains">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>

                                              

                                                <div class="form-group row" data-name="BUYvsTEp">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label switch label-link" for="domain_verification">
                                                            {{trans('settings.application.sending_domain.form.require_domain_ownership_verification')}}
                                                            {!! popover('settings.application.sending_domain.form.require_domain_ownership_verification_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" id="ownsversw" data-name="zDCqOsHD">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" name="domain_verification" @if(isset($app_settings['domain_verification']) && $app_settings['domain_verification']=='1') checked="checked" @endif id="domain_verification">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                        <input type="hidden"  id="is_all_domain_verify" value="">
                                                        <!-- <small>{{ trans('app.general.setting.ownership_verify_help') }}</small> -->
                                                    </div>
                                                </div>
                                             

                                                <div class="form-group row" id="vercheck" data-name="qwYzbdQR" >
                                                    <div class="col-md-12" data-name="cYXPffhE">
                                                        <div class="veroptins text-center" data-name="kKNNrkmy">
                                                            <div class="verslabel" data-name="svaqETiw">{{trans('settings.application.sending_domain.form.confirmation')}}</div>
                                                            <div class="kt-checkbox-list" data-name="GQHKmEzh">
                                                                <label class="kt-radio">
                                                                    <input type="radio" value="1" name="is_all_domain_verify" id="verify1">
                                                                    <span></span>
                                                                    {{trans('settings.application.sending_domain.form.set_existing_sending_domains_as_unverified')}}
                                                                </label>
                                                                <br>
                                                                <label class="kt-radio">
                                                                    <input type="radio" value="2" name="is_all_domain_verify"  id="verify2">
                                                                    <span></span>
                                                                    {{trans('settings.set_domains_send')}}
                                                                </label>
                                                                  <br>
                                                                <label class="kt-radio">
                                                                    <input type="radio" value="3" name="is_all_domain_verify" checked id="verify3">
                                                                    <span></span>
                                                                    {{trans('settings.leave_domains')}}
                                                                </label>
                                                            </div>
                                                            <p>{{trans('settings.application.sending_domain.form.all_domains_ownership')}}</p>
                                                            <div id="versnote" class="alert alert-danger" data-name="MQmExNiY">
                                                                {{trans('settings.application.sending_domain.form.note_disable_existing_domains')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="form-group row" data-name="lNGIevnW">
                                                    <div class="col-md-6" data-name="zGSenpzl">
                                                        <label class="col-form-label"> 
                                                            {{trans('settings.application.sending_domain.form.enable_recheck_button_title')}}
                                                            {!! popover('settings.application.sending_domain.form.enable_recheck_button_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="vSbyRnUx">
                                                            <input type="number" name="default_recheck_domain" value="{{isset($setting->default_recheck_domain) ? $setting->default_recheck_domain : 5 }}" class="form-control" />
                                                        </div>
                                                        <small class="time-right">
                                                            <!-- {{trans('app.general.setting.enable_recheck_button_title_minutes')}}</span> -->
                                                            <!-- <small class="dpblk">{{trans('app.general.setting.enable_recheck_button_help')}}</small> -->
                                                        </small>
                                                    </div>
                                                    <div class="col-md-6" data-name="jTjlHwcT">
                                                        <label class="col-form-label"> 
                                                            {{trans('settings.php_redirect')}}
                                                            {!! popover('settings.php_redirect_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="iLiydFdK">
                                                            <input type="text" name="php_redirect_file" value="{{isset($app_settings['php_redirect_file']) ? $app_settings['php_redirect_file'] : 'index.php' }}" class="form-control" />
                                                        </div>
                                                        <small class="time-right">
                                                            <!-- {{trans('app.general.setting.enable_recheck_button_title_minutes')}}</span> -->
                                                            <!-- <small class="dpblk">{{trans('app.general.setting.enable_recheck_button_help')}}</small> -->
                                                        </small>
                                                    </div>
                                                </div>

                                                <div class="form-group row" data-name="zmUpVsuh">
                                                    <div class="col-md-4 l-icon">
                                                        <label class="col-form-label switch label-link" for="intellectual_tracking">
                                                            {{ trans('settings.application.broadcast.form.intellectual_pattern') }}
                                                            {!! popover('settings.application.broadcast.form.intellectual_pattern_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" id="pops" data-name="MLpbsJlj">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success oppo">
                                                            <label>
                                                                <input id="intellectual_tracking" type="checkbox"  name="intellectual_tracking"  @if(!empty($app_settings['intellectual_tracking']) and $app_settings['intellectual_tracking'] == "on") checked="" @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>                                             

                                                <div class="form-group row" id="unauthParentBlk" data-name="zRiXhsZn">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label unauth-label switch label-link" for="unauthenticated">
                                                            {{trans('settings.disable_send_unauthenticated')}} 
                                                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Disable sending from unauthenticated domains" data-original-title="{{trans('common.description')}}"></i>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" name="unauthenticated" id="unauthenticated" @if(!empty($app_settings['unauth_sending_domain']) and $app_settings['unauth_sending_domain'] == "on") checked="" @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>

                                                @if($package == "Commercial ESP")
                                                    <div class="form-group row" data-name="ibxYyuou" >
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="allow_editing_dkim_selector">
                                                                {{trans('settings.disable_users_edit_DKIM')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="You have the option to disable users from editing the default DKIM selector in this system." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="allow_editing_dkim_selector" id="allow_editing_dkim_selector" @if(!empty($app_settings['allow_editing_dkim_selector']) and $app_settings['allow_editing_dkim_selector'] == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="iKOKwpEu">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="allow_editing_tracking_selector">
                                                                {{trans('settings.disable_users_edit_prefix')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="You can choose to disable users from editing the default tracking domain prefix in this system." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="allow_editing_tracking_selector" id="allow_editing_tracking_selector" @if(!empty($app_settings['allow_editing_tracking_selector']) and $app_settings['allow_editing_tracking_selector'] == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="mLQQUsJt" >
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="allow_editing_bounce_selector">
                                                                {{trans('settings.disable_users_bounce')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Turning it off will disable the user from defining their own bounce subdomain." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="allow_editing_bounce_selector" id="allow_editing_bounce_selector" @if(!empty($app_settings['allow_editing_bounce_selector']) and $app_settings['allow_editing_bounce_selector'] == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div> 
                                                    </div>
                                                    <div class="form-group row" data-name="sKEpXSIO" >
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="allow_user_to_domain_keys">
                                                                {{trans('settings.disable_users_download')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Turning it off will disable the functionality of downloading the domain keys pair for the users." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="allow_user_to_domain_keys" id="allow_user_to_domain_keys" @if(!empty($app_settings['allow_user_to_domain_keys']) and $app_settings['allow_user_to_domain_keys'] == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="AQJkLLNl">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="allow_users_to_regenerate_keys">
                                                                {{trans('settings.disable_users_regenerate')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Turning it off will disable the functionality of regenerating the domain keys pair for the users." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="allow_users_to_regenerate_keys" id="allow_users_to_regenerate_keys" @if(!empty($app_settings['allow_users_to_regenerate_keys']) and $app_settings['allow_users_to_regenerate_keys'] == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="CetlknQG">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="enable_cname_option_tracking_domain">
                                                                {{trans('settings.disable_cname_domain')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="You can choose to disable the CNAME option for the tracking domain within the system, restricting users from utilizing it." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="enable_cname_option_tracking_domain" id="enable_cname_option_tracking_domain" @if(!empty($app_settings['enable_cname_option_tracking_domain']) and $app_settings['enable_cname_option_tracking_domain'] == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="JVhxQDsd" >
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="enable_htaccess_option_tracking_domain">
                                                                {{trans('settings.disable_htaccess_domain')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="You can configure the system to disable the .htaccess option for the tracking domain, preventing users from utilizing it." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="enable_htaccess_option_tracking_domain" id="enable_htaccess_option_tracking_domain" @if(!empty($app_settings['enable_htaccess_option_tracking_domain']) and $app_settings['enable_htaccess_option_tracking_domain'] == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="zTxFzRDI" >
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="enable_clock_option_tracking_domain">
                                                                {{trans('settings.disable_cloak_label')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="You have the capability to disable the CLOAK option for the tracking domain, restricting users from utilizing it within the system." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="enable_clock_option_tracking_domain" id="enable_clock_option_tracking_domain" @if(!empty($app_settings['enable_clock_option_tracking_domain']) and $app_settings['enable_clock_option_tracking_domain'] == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>                                               
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="LLmYvtwK" >
                                                        <div class="col-md-4">
                                                            <label class="col-form-label unauth-label switch label-link" for="overwrite_tracking_domain">
                                                                {{trans('settings.label_overwrite_domain')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="It will replace your primary domain with this domain for the redirection and tracking links." data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" @if(!empty($app_settings['overwrite_tracking_domain']) and $app_settings['overwrite_tracking_domain'] == "on") checked="checked" @endif name="overwrite_tracking_domain" id="overwrite_tracking_domain">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div id="otd_value_blk" class="col-md-6" @if(!empty($app_settings['overwrite_tracking_domain']) and $app_settings['overwrite_tracking_domain'] == "on") style="display:block" @else @endif data-name="DjSNTxOC">
                                                            <input type="text" name="overwrite_tracking_domain_value" value="{{isset($app_settings['overwrite_tracking_domain_value']) ? $app_settings['overwrite_tracking_domain_value'] : '' }}" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="unauthChildBlk" id="unauthChildBlk" data-name="xfffMzuc">
                                                        <div class="alert alert-warning alert-bold intellectualPatternStatus" role="alert" data-name="TmFiRjhS">
                                                            <div class="alert-text" data-name="hNbBErzn"><b>{{trans('settings.tip_bold_heading')}}</b>{{trans('settings.select_domain')}}<span class="semibold">{{trans('settings.off_dkim_span')}}</span>. {{trans('settings.end_consider_para')}} </div>
                                                        </div>
                                                        <div class="alert alert-warning alert-bold fallbackDkimStatus" role="alert" data-name="rCjDCamx">
                                                            <div class="alert-text" data-name="djbfjsDH"><b>{{trans('settings.tip_bold_heading')}}</b>{{trans('settings.start_dkim_para')}}  <span class="semibold">{{trans('settings.off_dkim_span')}} </span>. {{trans('settings.end_dkim_div')}} </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="ZkjkUREd">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label switch label-link" for="enablefdkim">
                                                                {{trans('settings.enable_dkim_label')}} 
                                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enable Fallback DKIM" data-original-title="{{trans('common.description')}}"></i>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" name="enablefdkim" id="enablefdkim"  @if(!empty($app_settings['enablefdkim']) and $app_settings['enablefdkim'] == "on") checked @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="fallbackChildBlk" id="fallbackChildBlk" data-name="gUqKGAzk">
                                                        <div class="kt-portlet kt-portlet--bordered" data-name="fTfhqXgr">
                                                            <div class="kt-portlet__head" data-name="McgKoQDB">
                                                                <div class="kt-portlet__head-label" data-name="KhKxkOSc">
                                                                    <h3 class="kt-portlet__head-title">{{trans('settings.fallback_dkim_heading')}} </h3>
                                                                </div>
                                                            </div>
                                                            <div class="kt-portlet__body" data-name="NapztTwc">
                                                                <div class="form-body" data-name="GSWJXMaf">
                                                                    <div class="form-group row" data-name="nvlLXUMf">
                                                                        <div class="col-md-4" data-name="vLSIKmYN">
                                                                            <label class="col-form-label">{{trans('settings.fallback_selector_label')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Fallback DKIM Selector" data-original-title="{{trans('common.description')}}"></i> </label>
                                                                            <div class="input-icon right" data-name="cYynoGpq">
                                                                                <input type="text" id="fallbackselector" name="fallbackselector" value="{{isset($app_settings['fallbackselector']) ? $app_settings['fallbackselector'] : '' }}" class="form-control" placeholder="key">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-8" data-name="lNSeBUgW">
                                                                            <label class="col-form-label">{{trans('settings.fallback_dkim_label')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Fallback DKIM Domain" data-original-title="{{trans('common.description')}}"></i> </label>
                                                                            <div class="input-icon right" data-name="mLgooOHi">
                                                                                <input type="text" id="fallbackdomain" name="fallbackdomain" value="{{isset($app_settings['fallbackdomain']) ? $app_settings['fallbackdomain'] : '' }}" class="form-control" placeholder="{{$primary_domain}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row" data-name="THuwdyiG">
                                                                        <label class="col-form-label col-md-4">{{trans('settings.size_bits_label')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Key Size in Bits" data-original-title="{{trans('common.description')}}"></i> </label>
                                                                        <div class="keys_size kt-radio-inline" data-name="oqQDPIyW">
                                                                            <label for="dkey_size_1" class="kt-radio">
                                                                                <input type="radio" name="dkey_size" @if(!empty($app_settings['dkim_key_size']) and $app_settings['dkim_key_size'] == "1024") checked="" @endif value="1024" id="dkey_size_1"> 1024 <span></span></label>
                                                                            <label for="dkey_size_2" class="kt-radio">
                                                                                <input type="radio" name="dkey_size" @if(!empty($app_settings['dkim_key_size']) and $app_settings['dkim_key_size'] == "2048") checked="" @endif value="2048" id="dkey_size_2"> 2048 <span></span></label>
                                                                            <label for="dkey_size_3" class="kt-radio">
                                                                                <input type="radio" name="dkey_size" @if(!empty($app_settings['dkim_key_size']) and $app_settings['dkim_key_size'] == "4096") checked="" @endif value="4096" id="dkey_size_3"> 4096 <span></span></label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row" data-name="PkeoNAqb">
                                                                        <div class="col-md-12 form-group" data-name="vGlWkEJC">
                                                                        @if(empty($app_settings['fallback_public_key']) || empty($app_settings['fallback_private_key']) )
                                                                            <label class="col-form-label">{{trans('settings.public_key_div')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Public Key " data-original-title="{{trans('common.description')}}"></i> </label><a class="generatekey-label text-success pull-right" href="javascript:;" id="generate_keys">{{trans('settings.generate_key_div')}}</a>
                                                                        @else
                                                                            <label class="col-form-label">{{trans('settings.public_key_div')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Public Key " data-original-title="{{trans('common.description')}}"></i> </label><a class="generatekey-label text-success pull-right" href="javascript:;" id="generate_keys">{{trans('settings.regenerate_key_div')}} </a>
                                                                        @endif
                                                                            <div id="publickey" data-name="uLdOpKqg">
                                                                                <textarea name="fallback_public_key" id="public_key_textarea" class="form-control">{{isset($app_settings['fallback_public_key']) ? $app_settings['fallback_public_key'] : '' }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" data-name="ZqTSPwhp">
                                                                            <label class="col-form-label">{{trans('settings.privte_key_div')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Private Key " data-original-title="{{trans('common.description')}}"></i> </label>
                                                                            <div id="privatekey" data-name="eJEdiXnl">
                                                                                <textarea name="fallback_private_key"  id="private_key_textarea" class="form-control">{{isset($app_settings['fallback_private_key']) ? $app_settings['fallback_private_key'] : '' }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="contentBlk1 contentBlk" data-name="EIJdUCoR">
                                                                        <h2>{{trans('settings.txt_para')}} </h2>
                                                                        <div class="content" data-name="RKlegGge">{{trans('settings.content_dns_domain')}} <b> @if(!empty($app_settings['fallbackdomain']))   {{$app_settings['fallbackdomain']}} @else {{$primary_domain}} @endif </b>{{trans('settings.content_and_entry')}}</div>
                                                                    </div>
                                                                    <table class="table table-striped table-hover table-checkable responsive" id="fallback_result">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>{{trans('settings.host_table_th')}}</th>
                                                                                <th>{{trans('settings.type_table_th')}}</th>
                                                                                <th>{{trans('settings.value_table_th')}}</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr id="cnm" style="">
                                                                                <td>
                                                                                    <div class="option" data-name="IaVNvmxF">
                                                                                        <span id="load" class="loadg loader2"><i class="la la-refresh fa-spin"></i></span> 
                                                                                        @if(!empty($app_settings['fallback_value_verify']) and $app_settings['fallback_value_verify'] == 1)
                                                                                        <span  class="icock" style="display: block;"><i class="la la-check text-success"></i></span>
                                                                                        @elseif(!empty($app_settings['fallback_value_verify']) and $app_settings['fallback_value_verify'] == 2)
                                                                                        <span  class="icock" style="display: block;"><i class="la la-close text-danger"></i></span>
                                                                                        @else
                                                                                            <span class="chck checked2"><i class="fa fa-question"></i></span> 
                                                                                        @endif
                                                                                        
                                                                                        <span id="verify-txt-value" class="icock"><i class="la la-close text-danger"></i></span>
                                                                                        <span id="checked-txt-value" class="icock"><i class="la la-check text-success"></i></span>
                                                                                        <div class="domaintrack" data-name="jDYUAdRC"> @if(!empty($app_settings['fallbackselector']) and !empty($app_settings['fallbackdomain']))   {{$app_settings['fallbackselector'] . "._domainkey." . $app_settings['fallbackdomain']}} @else {{$primary_domain}} @endif </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td>
                                                                                    <div class="option" data-name="LhNJzqqk">{{trans('settings.txt_div_t')}}</div>
                                                                                </td>
                                                                                <td>
                                                                                    <div id="optkey" data-name="SqQxiYTa">
                                                                                        <button type="button" class="btn btn-default btn-copy icon-copy" title="Click here to Copy to clipboard" id="cp_btn23" onclick="copyFunction3()"> <i class="la la-copy"></i></button>
                                                                                        <span id="cnamecopy">{{isset($app_settings['dkim_txt_record']) ? $app_settings['dkim_txt_record'] : 'No TXT record found' }}</span>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <input type="hidden" name="verify_status" id="verify_status"  value="{{isset($app_settings['fallback_value_verify']) ? $app_settings['fallback_value_verify'] : '' }}" />
                                                                    <div class="reload_dkimBlk" data-name="OGZDJHgK">
                                                                        <button type="button" id="verify_it" class="btn btn-sm btn-info">{{trans('settings.button_verify')}}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="kt-portlet__foot" data-name="TzWkVvyT">
                                            <div class="form-actions" data-name="gvLufWvQ">
                                                <div class="row" data-name="eTJmWUqG">
                                                    <div class="col-md-12" data-name="iAyeXKbS">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab4" data-name="kKcpmcKN">
                        <div class="col-md-12" data-name="TrhGxXll">
                            <form action="" method="POST" id="campaign-setting" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="campaign">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="PbmyytiK">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="blivXanN">
                                        <div class="kt-portlet__head" data-name="oRThjXXw">
                                            <div class="kt-portlet__head-label" data-name="azQsDDFg">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.application.broadcast.form.heading')}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="ZwlpXUPj">
                                            <div class="form-body" data-name="BvUmfQei">
                                                {{--<div class="form-group row" data-name="nbkIZufp">
                                                    <label class="col-form-label col-md-3">
                                                        {{ trans('settings.application.broadcast.form.allow_verify_domain') }}
                                                    </label>
                                                    <div class="col-md-4 mt10" data-name="cLjTPoia">
                                                        <input type="checkbox" data-switch="true" data-on-color="success" name="">
                                                    </div>
                                                </div>--}}
                                                <div class="form-group row" data-name="bVAupVMb">
                                                    <div class="col-md-4" data-name="hZHynErs">
                                                        <label class="col-form-label top-label label-link" for="pops02">
                                                            {{ trans('settings.application.broadcast.form.auto_resume') }}
                                                            {!! popover('settings.application.broadcast.form.auto_resume_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" id="pops" data-name="hZHynErX">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success oppo">
                                                            <label>
                                                                <input id="pops02" type="checkbox" name="broadcast_connection_reestablishment" @if(!empty($app_settings['broadcast_connection_reestablishment']) and $app_settings['broadcast_connection_reestablishment'] == 1) checked="" @endif />
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group row" data-name="wcioeSeE">
                                                    <div class="col-md-4" data-name="hZHynErs">
                                                        <label class="col-form-label top-label label-link" for="pops234">
                                                            {{ trans('settings.application.broadcast.form.double_optin_newsletter') }}
                                                             {!! popover('settings.application.broadcast.form.double_optin_newsletter_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" id="pops" data-name="pKCPXBlX">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success oppo">
                                                            <label>
                                                                <input id="pops234" type="checkbox" name="unsubscribe_check"  @if(!empty($app_settings['unsubscribe_check']) and $app_settings['unsubscribe_check'] == "on") checked="" @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>

                                                    <div class="form-group row">
                                                        <div class="col-md-4" data-name="hZHynEr4">
                                                            <label class="col-form-label top-label label-link" for="pops2345">
                                                                {{ trans('settings.application.broadcast.form.disable_selection_sender_id') }}
                                                                {!! popover('settings.application.general.form.disable_selection_sender_id_help','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" id="pops">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success oppo">
                                                                <label>
                                                                    <input id="pops2345" type="checkbox" name="broadcast_sender_info"  @if(!empty($app_settings['broadcast_sender_info']) and $app_settings['broadcast_sender_info'] == "on") checked="" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
    
                                                    </div>

                                                    @php
                                                        $unsubscribe_link=getSetting("unsubscribe_link");
                                                        $sending_info_options=getSetting("sending_info_options");
                                                    @endphp


                                                    <div class="form-group row" data-name="TMgUDMSg">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label top-label label-link" for="pops235">
                                                                {!! trans('settings.application.broadcast.form.broadcast_unsubscribe_link') !!}
                                                                {!! popover('settings.application.general.form.broadcast_unsubscribe_link_help','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-1" id="pops" data-name="mlCuXecj">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success oppo">
                                                                <label>
                                                                    <input id="pops235" type="checkbox" name="unsubscribe_link"  @if($unsubscribe_link == "on") checked="checked" @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row" data-name="IxxsHJne">
                                                        <div class="col-md-4">
                                                            <label class="col-form-label top-label">
                                                                {{ trans('settings.application.broadcast.form.sender_info_option') }}
                                                                {!! popover('settings.application.broadcast.form.sender_info_option_help','common.description') !!}
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6" data-name="XAJcnpCj">
                                                            <div class="pt5 kt-radio-inline inline-block" data-name="esgjFmlj">
                                                                <label  class="kt-radio kt-radio--default first-radio" for="contact_list">
                                                                    <input id="contact_list" @if($sending_info_options == "contact_list") checked @endif type="radio"  name="sending_info_options" value="contact_list">
                                                                    <span></span>
                                                                    {{ trans('settings.contact_label') }} 
                                                                </label> 
                                                                <label  class="kt-radio kt-radio--default first-radio" for="sending_node">
                                                                    <input id="sending_node" @if(!$sending_info_options || $sending_info_options == "sending_node") checked @endif type="radio"  name="sending_info_options" value="sending_node">
                                                                    <span></span>
                                                                    {{ trans('settings.sending_label') }}
                                                                </label>
                                                                <label  class="kt-radio kt-radio--default first-radio" for="custom">
                                                                    <input id="custom" @if($sending_info_options == "custom") checked @endif type="radio"  name="sending_info_options" value="custom">
                                                                    <span></span>
                                                                    {{ trans('settings.custom_label') }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

    


                                                <div class="form-group row" data-name="pIpaNRUm">
                                                        
                                                    <div class="col-md-6" data-name="crmRhLzL">
                                                        <label class="col-form-label">{{trans('settings.application.broadcast.form.auto_inactive_minutes')}}
                                                            {!! popover('settings.application.broadcast.form.auto_inactive_minutes_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="hmOWQxws">
                                                            <input type="text" name="auto_inactive_delay" value="{{!empty($app_settings['auto_inactive_delay']) ? $app_settings['auto_inactive_delay'] : '30' }}" class="form-control" /> <small class="time-right">{{ trans('common.minutes') }}</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" data-name="UdEozhaj">
                                                        <label class="col-form-label">{{trans('settings.application.broadcast.form.auto_inactive_hours')}}
                                                              {!! popover('settings.application.broadcast.form.auto_inactive_hours_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="WOaPinzL">
                                                            <input type="text" name="auto_inactive_attempts" value="{{!empty($app_settings['auto_inactive_attempts']) ? $app_settings['auto_inactive_attempts'] : '24' }}" class="form-control" /> <small class="time-right">{{ trans('common.hours') }}</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row" data-name="mwxxtAzJ">
                                                        
                                                    <div class="col-md-6" data-name="PdZWQIXM">
                                                        <label class="col-form-label">{{trans('settings.application.broadcast.form.duplicate_open_after')}}
                                                            {!! popover('settings.application.broadcast.form.duplicate_open_after_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="XzJfyqRs">
                                                            <input type="text" id="duplicate_clicks_opens" name="duplicate_clicks_opens" value="{{!empty($app_settings['duplicate_clicks_opens']) ? $app_settings['duplicate_clicks_opens'] : '10' }}" class="form-control" /> <small class="time-right">{{ trans('common.seconds') }}</small>
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.ignore_duplicate_opened_help') }}</small> -->
                                                    </div>
                                                    <div class="col-md-6" data-name="flsVUsEJ">
                                                        <label class="col-form-label">{{trans('settings.application.broadcast.form.list_unsub_email_title')}}
                                                             {!! popover('settings.application.broadcast.form.list_unsub_email_title_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="MsBGVChE">
                                                            <input type="text" id="header_unsubscribe_email" name="header_unsubscribe_email" value="{{!empty($app_settings['header_unsubscribe_email']) ? $app_settings['header_unsubscribe_email'] : '' }}" class="form-control" /> 
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.list_unsub_email_help') }}</small> -->
                                                    </div>
                                                </div>

                                                <?php $smtp_sending_type = !empty($app_settings['smtp_sending_type']) ? $app_settings['smtp_sending_type'] : 'swift'; ?>

                                                <div class="form-group row" data-name="CwYCFCNk">
                                                        
                                                    <div class="col-md-6" data-name="YxoUagfh">
                                                        <label class="col-form-label">{{ trans('settings.application.broadcast.form.smtp_driver') }}
                                                             {!! popover('settings.application.broadcast.form.smtp_driver_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="mtruVkax">
                                                            <select name="smtp_sending_type" class="form-control" id="mail-type2">
                                                                 <option {{$smtp_sending_type=='swift'?'selected':''}} value="swift" NO NUMERIC NOISE KEY 1063> {{ trans('settings.application.broadcast.form.SwiftMailer') }} </option>
                                                                <option {{$smtp_sending_type=='phpmailer'?'selected':''}} value="phpmailer" NO NUMERIC NOISE KEY 1062>{{ trans('settings.application.broadcast.form.PHPMailer') }}</option>
                                                                <option {{$smtp_sending_type=='symfony'?'selected':''}} value="symfony" NO NUMERIC NOISE KEY 1062>{{ trans('settings.application.broadcast.form.symfony') }}</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6" data-name="qMJOEcoX">
                                                        <label class="col-form-label">{{ trans('settings.application.broadcast.form.bounce_not_older_then_title') }} 
                                                            {!! popover('settings.application.broadcast.form.bounce_not_older_then_title_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="sMkvcnqj">
                                                        <input type="number" id="process_bounce_days" name="process_bounce_days" value="{{!empty($app_settings['process_bounce_days']) ? $app_settings['process_bounce_days'] : '2' }}" class="form-control" />
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.bounce_not_older_then_help') }}</small> -->
                                                    </div>
                                                </div>
                                                <div  class="form-group row" data-name="oHFAOSnq" >
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            {{trans('settings.application.broadcast.form.esp_method_title')}}
                                                            {!! popover('settings.application.general.form.esp_method_title_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="pt5 kt-radio-inline" data-name="AeFqozzE">
                                                            <label class="kt-radio kt-radio--default first-radio">
                                                                <input type="radio" id="esp-method1" name="process_callbacks_via_file" @if(!$processingViaFile) checked @endif value="0">{{trans('settings.application.broadcast.form.realtime')}}
                                                                <span></span>
                                                            </label>
                                                            &nbsp;&nbsp;
                                                            <label class="kt-radio kt-radio--default first-radio">
                                                                <input type="radio" id="esp-method2" name="process_callbacks_via_file" @if($processingViaFile) checked @endif value="1" >{{trans('settings.application.broadcast.form.cron_based')}}
                                                                <span></span>
                                                            </label>&nbsp;&nbsp;                       
                                                        </div>
                                                    </div>
                                                    <!-- <small class="esp-option1 col-md-4">{{ trans('app.general.setting.esp_method_help1') }}</small> -->
                                                    <!-- <small class="esp-option2 col-md-4">{{ trans('app.general.setting.esp_method_help2') }}</small> -->
                                                </div>
                                                <div  class="form-group row" data-name="oHFAOSnq" >
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="pops03">
                                                            {{ trans('settings.application.broadcast.form.broadcast_filter_dashboard') }}
                                                            {!! popover('settings.application.broadcast.form.broadcast_filter_dashboard_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" data-name="AeFqozzE">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success oppo">
                                                            <label>
                                                                <input id="pops03" type="checkbox" name="broadcast_filter_dashboard" @if(!empty($app_settings['broadcast_filter_dashboard']) and $app_settings['broadcast_filter_dashboard'] == 1) checked="" @endif>
                                                                    <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                                    
                                                <div class="form-group row" data-name="oHFAOSnq" >
                                                    <div class="col-md-4">
                                                        <label class="col-form-label setting-mail-label-option" for="open_unopen_chart_bar">
                                                            {{ trans('settings.application.log.form.open_unopen_chart') }}
                                                            {!! popover('settings.application.log.form.open_unopen_chart_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="pt5 kt-radio-inline" data-name="AeFqozzE">
                                                            <label class="kt-radio kt-radio--default first-radio">
                                                                <input type="radio" id="open_unopen_chart_bar" name="open_unopen_chart" @if(isset($app_settings['open_unopen_chart']) && $app_settings['open_unopen_chart']=='horizontal_bar_graph') checked @endif value="horizontal_bar_graph">@lang("settings.application.log.form.horizontal_bar_graph")

                                                                <span></span>
                                                            </label>
                                                            &nbsp;&nbsp;
                                                            <label class="kt-radio kt-radio--default first-radio">
                                                                <input type="radio" id="open_unopen_chart_pie" name="open_unopen_chart"@if(isset($app_settings['open_unopen_chart']) && $app_settings['open_unopen_chart']=='pie_chart') checked @endif value="pie_chart" >@lang("settings.application.log.form.pie_chart")
                                                                <span></span>
                                                            </label>&nbsp;&nbsp;                       
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row" data-name="oHFAOSnqd" >
                                                    <div class="col-md-4">
                                                        <label class="col-form-label setting-mail-label-option" for="restart_stucked_campaign_yes"> 
                                                            {{ trans('settings.application.broadcast.form.broadcast_restart_stuck') }}
                                                            {!! popover('settings.application.broadcast.form.broadcast_restart_stuck_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="pt5 kt-radio-inline" data-name="AeFqozzE">
                                                            <label class="kt-radio kt-radio--default first-radio">
                                                                <input type="radio" id="restart_stucked_campaign_yes" name="restart_stucked_campaign" checked value="yes">Yes
                                                                <span></span>
                                                            </label>
                                                            &nbsp;&nbsp;
                                                            <label class="kt-radio kt-radio--default first-radio">
                                                                <input type="radio" id="restart_stucked_campaign_no" name="restart_stucked_campaign"@if(isset($app_settings['restart_stucked_campaign']) && $app_settings['restart_stucked_campaign']=='no') checked @endif value="no" >No
                                                                <span></span>
                                                            </label>&nbsp;&nbsp;                       
                                                        </div>
                                                    </div>
                                                    <div class="form-group stuckedYes col-md-6 mb0" data-name="oHFAOSnqd" @if(isset($app_settings['restart_stucked_campaign']) && $app_settings['restart_stucked_campaign']=='no') style="display:none" @endif >
                                                        <label class="col-form-label col-md-12">{{trans('Restart campaigns when found stuck for')}}
                                                                {!! popover('You have the ability to configure a timer within the system, enabling automatic restart of your broadcast at specified intervals.','common.description') !!}
                                                        </label>
                                                        <div class="col-md-12" data-name="AeFqozzdE">
                                                            <select name="restart_stucked_campaign_after_hours" class="form-control">
                                                            @for($i = 1; $i<=24; $i++)
                                                            <option value="{{$i}}" @if(isset($app_settings['restart_stucked_campaign_after_hours']) && $i ==  $app_settings['restart_stucked_campaign_after_hours']) selected @endif>{{$i}}</option>
                                                            @endfor
                                                            </select> <small class="time-right">hour's</small>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div> 
                                        </div>
                                        <div class="kt-portlet__foot" data-name="wkTvUMfA">
                                            <div class="form-actions" data-name="HARXGdDt">
                                                <div class="row" data-name="ZPtMtmuT">
                                                    <div class="col-md-12" data-name="WjWCxsdE">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
<!--                    <div class="tab-pane" id="tab5" data-name="tgROvMTH">
                        <div class="col-md-12" data-name="feapFeTu">
                            <form action="" method="POST" id="segment-setting" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="segment">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="CDXKlsBI">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="PsNgiAVJ">
                                        <div class="kt-portlet__head" data-name="YPqxFxpr">
                                            <div class="kt-portlet__head-label" data-name="CecTVsIt">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.application.segment.form.heading')}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="ZcOifPyj">
                                           <div class="form-body" data-name="lMRNoHYq">                                                
                                               <div class="form-group row" data-name="soBhaPve">
                                                        
                                                    <div class="col-md-6" data-name="kMeMSMgo">
                                                        <label class="col-form-label">
                                                            {{ trans('settings.application.segment.form.delete_export_segment') }}
                                                             {!! popover('settings.application.segment.form.delete_export_segment_help','common.description') !!}
                                                        </label>
                                                        <input type="text" name="delete_exported_segments_after" id="delete_exported_segments_after" value="{{ @$app_settings['delete_exported_segments_after'] }}" class="form-control" />
                                                        <span>{{ trans('common.days') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__foot" data-name="hQrDnQqu">
                                            <div class="form-actions" data-name="CZMrikyk">
                                                <div class="row" data-name="BDHSWddQ">
                                                    <div class="col-md-12" data-name="DThEFvJT">
                                                        <button type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>-->


                    <div class="tab-pane" id="tab6" data-name="kkDTDvkP">
                        <div class="col-md-12" data-name="TCgGnWcR">
                            <form action="" method="POST" id="trigger-setting" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="trigger">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="DhaXcSAl">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="zafppBwa">
                                        <div class="kt-portlet__head" data-name="pqyxlYys">
                                            <div class="kt-portlet__head-label" data-name="RkQMbfEw">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.application.trigger.form.heading')}}</span>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="otiIdGRm">
                                           <div class="form-body" data-name="HNFnjwhC">
                                                <div class="form-group row" data-name="ugZPdcCj">
                                                        
                                                    <div class="col-md-6" data-name="DwgUbyXb">
                                                        <label class="col-form-label">
                                                        {{ trans('settings.application.trigger.form.triggers_cronjob_title') }}
                                                         {!! popover('settings.application.trigger.form.triggers_cronjob_title_help','common.description') !!}
                                                        </label>
                                                        <input type="number" name="trigger_no_of_records_reg" id="trigger_no_of_records" value="{{!empty($app_settings['trigger_no_of_records_reg']) ? $app_settings['trigger_no_of_records_reg'] : '-1' }}" class="form-control" />
                                                        <!-- <small>{{ trans('app.general.setting.triggers_cronjob_help') }}</small> -->
                                                    </div>
                                                    <div class="col-md-6" data-name="PACoqKAb">
                                                        <label class="col-form-label">
                                                        {{ trans('settings.application.trigger.form.triggers_execution_title') }}
                                                         {!! popover('settings.application.trigger.form.triggers_execution_title_help','common.description') !!}
                                                        </label>
                                                        <input type="number" name="trigger_no_of_records_exe" id="trigger_no_of_records_exe" value="{{!empty($app_settings['trigger_no_of_records_exe']) ? $app_settings['trigger_no_of_records_exe'] : '20' }}" class="form-control" />
                                                        <!-- <small>{{ trans('app.general.setting.triggers_execution_help') }}</small> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__foot" data-name="Rxrbhzfi">
                                            <div class="form-actions" data-name="iybkhYRy">
                                                <div class="row" data-name="IUxFZZvs">
                                                    <div class="col-md-12" data-name="TBRfQrtC">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

 					<div class="tab-pane" id="tab7" data-name="qMXNJNAK">
                        <div class="col-md-12" data-name="maTbOolR">
                            <form action="" method="POST" id="logs-setting" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="logs">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="WiqxWbsS">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="xiKkKiRj">
                                        <div class="kt-portlet__head" data-name="QNSPMLml">
                                            <div class="kt-portlet__head-label" data-name="VHlGvUtP">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.application.log.form.heading')}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="XGubrrnd">
                                           <div class="form-body" data-name="WyDWXbId">
                                   

                                               @php
                                     				$fileLogging = false;
                                                   if(!is_null($callBacksLogging)){
                                                    $callBackSettings = json_decode($callBacksLogging->setting_value);
                                                    $fileLogging = $callBackSettings->log_callbacks->enabled;
                                                    $fileCount = $callBackSettings->log_callbacks->file_count;
                                                   }
                                               @endphp
                                              

                                                
                                                <div class="form-group row delete-child2" data-name="fJObSmGY">
                                                    <div class=" col-md-4">
                                                        <label class="col-form-label label-link" for="logs6">{{ trans('settings.application.log.form.delete_user_logs') }}
                                                            {!! popover('settings.application.log.form.delete_user_logs_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="logs6" name="delete_user_logs_flag">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-6 mb0" data-name="dAtunjWu">
                                                        <div id="feild6" class="logs-sfield">
                                                            <input type="number" min="-1" value="{{!empty($app_settings['delete_user_logs']) ? $app_settings['delete_user_logs'] : '-1' }}" name="delete_user_logs" class="form-control" />
                                                            <small class="days-right fdays">{{ trans('settings.days_t') }}</small>
                                                        </div>
                                                   </div>
                                                </div>

                                                <div class="form-group row" data-name="fJObSmGY">
                                                   <div id="debug_log_div" class="col-md-6" data-name="dAtunjzW">
                                                        <label class="col-form-label">{{ trans('settings.application.log.form.reporting_level') }}
                                                            {!! popover('settings.application.log.form.reporting_level_help','common.description') !!}
                                                        </label>
                                                        <select class="form-control m-select2" name="app_log_level" data-placeholder="Select Error">
                                                            <option value="debug" @if($log_level=='debug') selected @endif>@lang("settings.application.log.form.debug")</option>
                                                            <option value="error" @if($log_level=='error') selected @endif>@lang("settings.application.log.form.error")</option>
                                                            <option @if($log_level=='critical') selected @endif value="critical">@lang("settings.application.log.form.critical")</option>
                                                            <option @if($log_level=='info') selected @endif value="info">@lang("settings.application.log.form.info")</option>
                                                            <option @if($log_level=='notice') selected @endif value="notice">@lang("settings.application.log.form.notice")</option>
                                                            <option @if($log_level=='warning') selected @endif value="warning">@lang("settings.application.log.form.warning")</option>
                                                            <option @if($log_level=='alert') selected @endif value="alert">@lang("settings.application.log.form.alert")</option>
                                                        </select>
                                                        <!-- <small>{{ trans('app.general.setting.logs_reporting_level_help') }}</small> -->
                                                   </div>
                                               </div>
                                               <div class="form-group row" data-name="tZsbLPrE">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="enabled">
                                                            {{ trans('settings.application.log.form.logs_callbacks_title') }}
                                                            {!! popover('settings.application.log.form.logs_callbacks_title_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                   <div class="col-md-6 row label-block" id="pops" data-name="dTpsXoaq">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success mbpb0">
                                                            <label class="mbpb0">
                                                                <input onchange="showOrHide('#file_count_div','#enabled')" id="enabled" type="checkbox" name="enabled" @if($fileLogging) checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                        <!-- <small class="pl12 pt15">{{ trans('app.general.setting.logs_callbacks_help') }}</small> -->
                                                   </div>
                                                   <div id="file_count_div" class="col-md-6" style="{{!isset($fileCount)?'display:none;':''}}" data-name="laxtxJLi">
                                                        <div class="row" data-name="mUMOmqQn">
                                                            <div class="input-icon col-md-12" data-name="ufOfjaRh">
                                                                    <label class="col-form-label">{{trans('settings.application.log.form.no_of_files')}}
                                                                        {!! popover('settings.application.log.form.no_of_files_help','common.description') !!}
                                                                    </label>
                                                                <input type="number" name="file_count" value="{{isset($fileCount) ? $fileCount : '500' }}" class="form-control" />
                                                                    <!-- <small>specify number of files for each esp node</small> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                               </div>

                                               {{-- <div class="form-group row" data-name="tZsbLPrE">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="subscriber_logs">
                                                           {{ trans('Keep subscriber logs history') }}
                                                            {!! popover('','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1 row" id="pops" data-name="dTpsXoaq">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success mbpb0">
                                                            <label class="mbpb0">
                                                                <input  id="subscriber_logs" type="checkbox" name="subscriber_logs" @if(empty($app_settings['subscriber_logs']) OR (!empty($app_settings['subscriber_logs']) && $app_settings['subscriber_logs'] != "off")) checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                   </div>
                                               </div> --}}
                                            </div> 
                                        </div>
                                        <div class="kt-portlet__foot" data-name="rXhexlTJ">
                                            <div class="form-actions" data-name="wktQYdaV">
                                                <div class="row" data-name="vBxihLrr">
                                                    <div class="col-md-12" data-name="ndPqICuA">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                                                <!--  -->

                        <!-- security tab starts -->
                       @php
                       $time = 0;
                            $session_idle_time = false;
                            $remeber_session = true;
                           if(isset($securitySetting)){
                            $config = json_decode($securitySetting->setting_value);
                            if(isset($config->remeber_session))
                            $remeber_session = $config->remeber_session;
                            if(isset($config->session_idle_time)){
                            $time = $config->session_idle_time->time;
                            $session_idle_time = $config->session_idle_time->enabled;
                            }
                           }
                       @endphp
 					<div class="tab-pane" id="tab8" data-name="sgLSwMrD">
                        <div class="col-md-12" data-name="VVSsWjmw">
                            <form action="" method="POST" id="security-setting" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="security_settings">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="djaRfmcd">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="FCEPfEqb">
                                        <div class="kt-portlet__head" data-name="OYrPrFvA">
                                            <div class="kt-portlet__head-label" data-name="kSNeZSxU">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.application.security.form.heading')}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="ASAyGnqW">
                                           <div class="form-body" data-name="legxwjnI">
                                                <div class="form-group row" data-name="nXsHYldd">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label top-label label-link" for="session_idle_time">
                                                            {{ trans('settings.application.security.form.security_logout_title') }}
                                                                {!! popover('settings.application.security.form.security_logout_title_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" id="pops" data-name="NDzVlJsr">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input onchange="showOrHide('#session_idle_time_div','#session_idle_time')" id="session_idle_time" type="checkbox" @if($session_idle_time) checked @endif name="session_idle_time">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <div id="session_idle_time_div"class="col-md-6" @if(!$session_idle_time) style="display:none;" @endif data-name="LdcjuwbB">
                                                        <label class="col-form-label pt0">{{ trans('common.time') }}
                                                        </label>
                                                        <div class="input-icon right" data-name="VuYRtQxj">
                                                            <select name="time" class="form-control" id="time">
                                                                <option @if($time==1) selected @endif value="1">1</option>
                                                                <option @if($time==5) selected @endif value="5">5</option>
                                                                <option @if($time==15) selected @endif value="15">15</option>
                                                                <option @if($time==30) selected @endif value="30">30</option>
                                                                <option @if($time==60) selected @endif value="60">60</option>
                                                                <option @if($time==90) selected @endif value="90">90</option>
                                                                <option @if($time==120) selected @endif value="120">120</option>
                                                                <!-- <option value="thesmtp.com" >theSMTP.com</option> -->
                                                            </select>
                                                            <small>{{ trans('common.minutes') }}</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div class="form-group row" data-name="xpAKEqRb">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label top-label label-link" for="remeber_session">
                                                            {{ trans('settings.application.security.form.remember_me') }}
                                                            {!! popover('settings.application.security.form.remember_me_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8" id="pops" data-name="MXprbuLW">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="remeber_session" @if($remeber_session) checked @endif name="remeber_session">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>

                                               <div class="form-group row" data-name="py0WpVgBGy">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            {{ trans('settings.application.security.form.session_storage') }}
                                                            {!! popover('settings.application.security.form.session_storage_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="GAeFHBLqex">
                                                       <div class="pt5 kt-radio-inline" id="session-check" data-name="BDSrYLUBrg">
                                                           <label class="kt-radio kt-radio--default first-radio" for="session_storage_file">
                                                               <input id="session_storage_file" @if(!$active_session_storage_db) checked @endif  type="radio" name="active_session_storage" value="file">
                                                               <span></span>
                                                               {{trans('settings.active_session.type.file')}}
                                                           </label>
                                                           <label class="kt-radio kt-radio--default" for="session_storage_db">
                                                               <input id="session_storage_db" @if($active_session_storage_db) checked @endif type="radio" name="active_session_storage" value="database">
                                                               <span></span>
                                                               {{trans('settings.active_session.type.db')}}
                                                           </label>
                                                       </div>
                                                   </div>
                                                   <div class="col-md-6" data-name="GAeFHBLqex">
                                                        <div class="alert alert-warning alert-bold mb0" id="session-alert" role="alert" style="display:none;">
                                                            <div class="alert-text" data-name="RGLOYFZg"><span class="semibold">{{ trans('settings.note_bold') }} </span> {{ trans('settings.note_text_changing_driver') }}</div>
                                                        </div>
                                                   </div>
                                               </div>
                                               <div class="form-group row" data-name="ZpsPcksd">
                                                    <div class="col-md-6" data-name="xpAKEqRb">
                                                       <label class="col-form-label top-label">
                                                           {{ trans('settings.app_setting.label.delete_export_file_after_days') }}
                                                           {!! popover('settings.app_setting.label.delete_export_file_after_days_description','common.description') !!}
                                                       </label>
                                                       <div class="input-icon right" data-name="jqOsZAIQ">
                                                           <input type="number" name="delete_export_file_after_days" value="{{isset($app_settings['delete_export_file_after_days']) ? $app_settings['delete_export_file_after_days'] : $delete_export_file_after_days }}" class="form-control" />
                                                            <small class="days-right">@lang('common.hours')</small>
                                                        </div>
                                                   </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="kt-portlet__foot" data-name="dmoxOLHd">
                                            <div class="form-actions" data-name="mbYzCYxX">
                                                <div class="row" data-name="IWUjoNNz">
                                                    <div class="col-md-6" data-name="WyKYmzWp">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- security tab ends -->
                    <div class="tab-pane" id="tab9" data-name="rXaDYmWO">
                        <div class="col-md-12" data-name="AtMvbcQN">
                            <form action="" method="POST" id="api_keys_settings" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="api_keys_settings">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="cBxsDARt">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="aQdwlNcy">
                                        <div class="kt-portlet__head" data-name="SMNMlnIb">
                                            <div class="kt-portlet__head-label" data-name="XHUWlMFS">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.application.api_keys.form.heading')}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="BViFQKNB">
                                           <div class="form-body" data-name="SDHGuBgh">
                                                <div class="form-group row" data-name="tZsbLPrE">
                                                   <div class=" col-md-4" data-name="dTpsXoaq">
                                                        <label class="col-form-label top-label label-link" for="g_analytic">
                                                            {{ trans('settings.application.api_keys.form.google_analytics') }}
                                                            {!! popover('settings.application.api_keys.form.google_analytics_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-4" data-name="ChrtBBuy">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success mbpb0">
                                                            <label class="mbpb0">
                                                                <input id="g_analytic" onchange="showOrHide('#analytics-blk','#g_analytic')" type="checkbox" name="analytics_enabled">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                               </div>

                                                <div class="form-group row" id="analytics-blk" data-name="yCyiRqkp">
                                                    <label class="col-form-label sub-label col-md-12 pt0">
                                                        {{ trans('settings.application.api_keys.form.google_analytics_code') }}
                                                    </label>
                                                    <div class="col-md-6" data-name="kpOVeSCT" >
                                                        <div class="nextrow"><i class="la la-level-down lshap"></i></div>
                                                        <div class="input-icon right" data-name="jqOsZAIQ">
                                                            <input type="text" placeholder="G-12345" name="google_analytics" class="form-control" value="{{ !empty($app_settings['google_analytics']) ? $app_settings['google_analytics']:''}}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" data-name="tZsbLPrE">
                                                   <div class="form-group col-md-12 row mb1" data-name="dTpsXoaq">
                                                        <label class="col-form-label top-label col-md-4">
                                                        {{ trans('settings.application.api_keys.form.google_recaptcha') }}
                                                            {!! popover('settings.application.api_keys.form.google_recaptcha_help','common.description') !!}
                                                        </label>
                                                        <div class="col-md-4" data-name="ChrtBBuy">
                                                            <div class="input-icon pl8">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success mbpb0">
                                                                    <label class="mbpb0">
                                                                        <input id="g_captcha" onchange="showOrHide('#captcha-blk','#g_captcha')" type="checkbox" name="captcha_enabled">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                   </div>
                                               </div>

                                                <div id="captcha-blk">
                                                    <div class="form-group row mb0" data-name="yCyiRqkp">
                                                        <label class="col-form-label sub-label col-md-2">
                                                            <div class="nextrow"><i class="la la-level-down lshap"></i></div> <span>{{ trans('settings.application.api_keys.form.version') }}</span>
                                                        </label>
                                                        <div class="col-md-6" data-name="kpOVeSCT" >
                                                            <div class="pt5 kt-radio-inline" data-name="BDSrYLUBrg">
                                                                <label class="kt-radio kt-radio--default first-radio" for="recaptcha_version_v2">
                                                                    <input id="recaptcha_version_v2" @if(!empty($app_settings['recaptcha_version']) and $app_settings['recaptcha_version'] == "v2") checked @endif type="radio" checked value="v2" name="recaptcha_version">
                                                                    <span></span>
                                                                    V2
                                                                </label>
                                                                <label class="kt-radio kt-radio--default first-radio" for="recaptcha_version_v3">
                                                                    <input id="recaptcha_version_v3" @if(!empty($app_settings['recaptcha_version']) and $app_settings['recaptcha_version'] == "v3") checked @endif type="radio" value="v3" name="recaptcha_version">
                                                                    <span></span>
                                                                    v3 (invisible)
                                                                </label>
                                                            </div>
                                                            <!-- <select class="for-control m-select2" name="recaptcha_version" id="recaptcha_version"  data-placeholder="{{ trans('settings.application.api_keys.form.select_version') }}">
                                                                <option value="">{{ trans('settings.application.api_keys.form.select_version') }}<option>
                                                                <option value="Disabled">Disable<option>
                                                                <option <?php if(!empty($app_settings['recaptcha_version']) and $app_settings['recaptcha_version'] == "v2")  echo "selected"; ?> value="v2">v2<option>
                                                                <option <?php if(!empty($app_settings['recaptcha_version']) and $app_settings['recaptcha_version'] == "v3")  echo "selected"; ?> value="v3">v3 (invisible)<option>
                                                            </select> -->
                                                        </div>
                                                    </div>
                                                    <div class="form-group row mb0" data-name="yCyiRqkp">
                                                        <label class="col-form-label sub-label col-md-12">
                                                            {{ trans('settings.application.api_keys.form.site_key') }}
                                                        </label>
                                                        <div class="col-md-6" data-name="kpOVeSCT" >
                                                            <div class="nextrow"><i class="la la-level-down lshap"></i></div>
                                                            <div class="input-icon right" data-name="jqOsZAIQ">
                                                                <input type="text" placeholder="{{ trans('settings.application.api_keys.form.site_key') }}" name="recaptcha_site_key" class="form-control" value="{{ !empty($app_settings['recaptcha_site_key']) ? $app_settings['recaptcha_site_key']:''}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="yCyiRqkp">
                                                        <label class="col-form-label sub-label col-md-12">
                                                            {{ trans('settings.application.api_keys.form.secret_key') }}
                                                        </label>
                                                        <div class="col-md-6" data-name="kpOVeSCT" >
                                                            <div class="nextrow"><i class="la la-level-down lshap"></i></div>
                                                            <div class="input-icon right" data-name="jqOsZAIQ">
                                                                <input type="text" placeholder="{{ trans('settings.application.api_keys.form.secret_key') }}" name="recaptcha_secret_key" class="form-control" value="{{ !empty($app_settings['recaptcha_secret_key']) ? $app_settings['recaptcha_secret_key']:''}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                               </div>

                                            </div> 
                                        </div>
                                        <div class="kt-portlet__foot" data-name="YYUgrbqJ">
                                            <div class="form-actions" data-name="dLVQMfvs">
                                                <div class="row" data-name="qgsBoJdI">
                                                    <div class="col-md-6" data-name="ZgLdRAIo">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- security tab ends -->

                          <!-- Contacts tab ends -->
                    <div class="tab-pane" id="tab10" data-name="vtmbGdJE">
                        <div class="col-md-12" data-name="jhpGduEV">
                            <form action="" method="POST" id="contact_setting" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="contact_setting">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="ppBHctJi">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="sUfoqzmY">
                                        <div class="kt-portlet__head" data-name="elBZLUvO">
                                            <div class="kt-portlet__head-label" data-name="GnmeiSOA">
                                                <h3 class="kt-portlet__head-title">{{trans('settings.heading_contacts_setting')}}</h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="SDEfVpPU">
                                           <div class="form-body" data-name="ufYYRmpA">
                                           
                                                @php
                                                    $user_can_select_file_from_server=config('appSettings.user_can_select_file_from_server');
                                                    $rocket_import_default_mode =config('appSettings.rocket_import_default_mode');
                                                @endphp
                                                <div class="form-group row" data-name="ToIbUTXE">
                                                     <div class="col-md-6" data-name="EdsnUYQK">
                                                        <label class="col-form-label">  {{ trans('settings.application.general.form.rocket_import_chunk_size') }}
                                                        {!! popover('settings.application.general.form.rocket_import_chunk_size_help','common.description') !!}
                                                        </label>
                                                        <div class="input-icon right" data-name="CzGFhNJD">
                                                            <input type="text" name="default_import_chunk_size" value="{{isset($app_settings['default_import_chunk_size']) ? $app_settings['default_import_chunk_size'] : 10000 }}" class="form-control">
                                                        </div>
                                                        <!-- <small>{{ trans('app.general.setting.chunk_size_help') }}</small> -->
                                                    </div>
                                                </div>
                                                <div class="form-group row" data-name="iBcnUnHE">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            {{ trans('settings.application.general.form.rocket_import_default_mode') }}
                                                            {!! popover('settings.application.general.form.rocket_import_default_mode','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="OYPJaTfS" >
                                                        <div class="pt5 kt-radio-inline" data-name="PXzHmeLu">
                                                            <label  class="kt-radio kt-radio--default first-radio" for="normal_mode">
                                                                <input id="normal_mode" @if(!$rocket_import_default_mode || $rocket_import_default_mode == "normal") checked @endif type="radio"  name="rocket_import_default_mode" value="normal">
                                                                <span></span>
                                                                {{ trans('settings.normal_l') }}
                                                            </label> 
                                                            <label  class="kt-radio kt-radio--default first-radio" for="rocket_mode">
                                                                <input id="rocket_mode" @if($rocket_import_default_mode == "rocket") checked @endif type="radio"  name="rocket_import_default_mode" value="rocket">
                                                                <span></span>
                                                                {{ trans('settings.rocket_l') }}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="form-group row" data-name="hXWlatRV">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            {{ trans('settings.application.count_limits.title') }}
                                                            {!! popover('settings.application.general.form.count_limits_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                   <div class="col-md-6" data-name="kXwcUEvp" >
                                                       <div class="pt5 kt-radio-inline" data-name="lwBDfHja">
                                                           <label  class="kt-radio kt-radio--default first-radio" >
                                                               <input @if($recount_contact_limit=='real_time') checked @endif type="radio"  name="recount_contact_limit" value="real_time">
                                                               <span></span>
                                                               {{trans('settings.application.count_limits.realtime')}}
                                                           </label>
                                                           <label  class="kt-radio kt-radio--default first-radio" >
                                                               <input @if($recount_contact_limit=='monthly') checked @endif   type="radio"  name="recount_contact_limit" value="monthly">
                                                               <span></span>
                                                               {{trans('settings.application.count_limits.monthly')}}
                                                           </label>
                                                           <label  class="kt-radio kt-radio--default first-radio" >
                                                               <input @if($recount_contact_limit=='never') checked @endif   type="radio"  name="recount_contact_limit" value="never">
                                                               <span></span>
                                                               {{trans('settings.application.count_limits.never')}}
                                                           </label>
                                                       </div>
                                                   </div>
                                                </div>

                                                
                                                <div class="form-group row" data-name="CzscclFK">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="user_can_select_file_from_server">
                                                            {{ trans('settings.application.general.form.user_can_select_file_from_server') }}
                                                            {!! popover('settings.application.general.form.user_can_select_file_from_server_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="fQiyHllk" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!isset($app_settings['user_can_select_file_from_server']) || isset($app_settings['user_can_select_file_from_server']) && $app_settings['user_can_select_file_from_server'] == "on") checked @endif type="checkbox" id="user_can_select_file_from_server" name="user_can_select_file_from_server">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group row" data-name="yKFLNtzM">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="user_import_contacts_confirmed">
                                                            {{ trans('settings.application.general.form.allow_user_import-contacts_confirmed') }}
                                                            {!! popover('settings.application.general.form.allow_user_import-contacts_confirmed_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="CqATHyLc" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!empty($app_settings['user_import_contacts_confirmed']) and $app_settings['user_import_contacts_confirmed'] == "on") checked @endif type="checkbox" id="user_import_contacts_confirmed" name="user_import_contacts_confirmed">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="form-group row" data-name="wDZXmzuB">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="allow_sending_email_unconfirmed">
                                                            {{ trans('settings.application.general.form.allow_seding_node_email_unconfirmed_contacts') }}
                                                            {!! popover('settings.application.general.form.allow_seding_node_email_unconfirmed_contacts_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="DrsUndMo" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!empty($app_settings['allow_sending_email_unconfirmed']) and $app_settings['allow_sending_email_unconfirmed'] == "on") checked @endif type="checkbox" id="allow_sending_email_unconfirmed" name="allow_sending_email_unconfirmed">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                               
                                                <div class="form-group row" data-name="GiNznZLE">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="force_double_opt_in_webform">
                                                            {{ trans('settings.force_webforms') }}
                                                            {!! popover('settings.popover_double_webform','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="KtCscGKe" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!empty($app_settings['force_double_opt_in_webform']) and $app_settings['force_double_opt_in_webform'] == "on") checked @endif type="checkbox" id="force_double_opt_in_webform" name="force_double_opt_in_webform">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group row" data-name="ZJGQOjYC">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="allow_edit_email_address">
                                                            {{ trans('settings.disable_editemail') }}
                                                            {!! popover('settings.disable_editemail_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="gjaxCDfy" >
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                            <label>
                                                                <input @if(!empty($app_settings['allow_edit_email_address']) and $app_settings['allow_edit_email_address'] == "on") checked @endif type="checkbox" id="allow_edit_email_address" name="allow_edit_email_address">
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group row encrypt-option activated" data-name="jlBmzuUh">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="md5">
                                                            {{ trans('settings.md5_suppression') }}
                                                            {!! popover('settings.popover_suppression_md5','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <input type="hidden" id="encrypt_enable" value=""/>
                                                    <div class="loadspin spinnerb_md5" data-name="EWHtYaVt"><i class="fa fa-spin fa-spinner"></i> </div>
                                                    <div id="switchb_md5"  class="sw-encrypt col-md-1" data-name="sKniRkRL">
                                                        <div class="input-icon" data-name="HnytiZlM">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch top-switch">
                                                                <label>
                                                                    <input type="checkbox" id="md5" name="md5">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row encrypt-option activated" data-name="jlBmzuUh">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label label-link" for="limit_domain_supression">
                                                            {{ trans('settings.application.contact.form.limit_domain_suppressed_support') }}
                                                            {!! popover(trans('settings.application.contact.form.limit_user_description'),'common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="loadspin spinnerb_md5" data-name="EWHtYaVt"><i class="fa fa-spin fa-spinner"></i> </div>
                                                    <div id="limit_domain_supression_dev"  class="sw-encrypt col-md-4" data-name="sKniRkRL">
                                                        <div class="input-icon" data-name="HnytiZlM">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch top-switch">
                                                                <label for="limit_domain_supression">
                                                                    <input  type="checkbox" id="limit_domain_supression" name="limit_domain_supression"  @if(isset($app_settings['limit_domain_supression']) && $app_settings['limit_domain_supression']=='on') checked="" @endif >
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group encrypt-option activated col-md-6" data-name="jlBmzuUh" id="suppress_domain_limit_div" style="display: @if(isset($app_settings['limit_domain_supression']) && $app_settings['limit_domain_supression']=='on') flex; @else none; @endif">
                                                        <label class="col-form-label" for="suppress_domain_limit">
                                                            {{ trans("suppression.suppress_system_limit_title") }}
                                                        </label>
                                                        <input type="number" id="suppress_domain_limit" name="suppress_domain_limit" value="{{isset($app_settings['suppress_domain_limit']) ? $app_settings['suppress_domain_limit'] : '-1' }}" class="form-control" />
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                        <div class="kt-portlet__foot" data-name="sZtDEizg">
                                            <div class="form-actions" data-name="rxczqomE">
                                                <div class="row" data-name="xNEGZtAg">
                                                    <div class="col-md-6" data-name="znAsQYwa">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Contacts tab ends -->
                    
                    <!-- security tab ends -->
                    <div class="tab-pane" id="tab11" data-name="CVxzkayz">
                        <div class="col-md-12" data-name="pwKhUHiL">
                            <form action="" method="POST" id="notifications_settings" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="notifications_settings">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="JfaAToxW">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="OWlXbgPg">
                                        <div class="kt-portlet__head" data-name="AuGdxGia">
                                            <div class="kt-portlet__head-label" data-name="dpltxRVy">                                                
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('settings.application.notifications.heading')}}<br />
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="cZAuvwoy">
                                            <div class="form-body" data-name="AwEKJyf7">
                                                <p class="notification_settings_text"> {{trans('settings.application.notifications.heading_description')}}</p>
                                                <div class="form-group row" data-name="xPIWeIAl">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label switch-label top-label label-link" for="contact_list_imported">
                                                            {{ trans('settings.application.notifications.form.vclist') }}
                                                            {!! popover('settings.application.notifications.form.vclist_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="contact_list_imported" name="contact_list_imported" @if(!empty($app_settings['contact_list_imported']) and $app_settings['contact_list_imported'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="form-group row" data-name="XgKuQPpJ">
                                                    <div class="col-md-4" data-name="NBdrmVgf">
                                                        <label class="col-form-label switch-label top-label label-link" for="list_exported">
                                                            {{ trans('settings.application.notifications.form.list_exported') }}
                                                            {!! popover('settings.application.notifications.form.list_exported_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="NBdrmVg9">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="list_exported" name="list_exported"  @if(!empty($app_settings['list_exported']) and $app_settings['list_exported'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="ShFVVyVY">
                                                    <div class="col-md-4" data-name="JGPjQjfL">
                                                        <label class="col-form-label switch-label top-label label-link" for="segment_exported">
                                                            {{ trans('settings.application.notifications.form.segment_exported') }}
                                                            {!! popover('settings.application.notifications.form.segment_exported_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="JGPjQjf5">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="segment_exported" name="segment_exported" @if(!empty($app_settings['segment_exported']) and $app_settings['segment_exported'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="ahxkCdkb">
                                                    <div class="col-md-4" data-name="KUyCgof6">
                                                        <label class="col-form-label switch-label top-label label-link" for="segment_created">
                                                            {{ trans('settings.application.notifications.form.segment_created') }}
                                                            {!! popover('settings.application.notifications.form.segment_created_help','common.description') !!}
                                                        </label>
                                                    </div> 
                                                    <div class="col-md-6" data-name="KUyCgofo">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="segment_created" name="segment_created" @if(!empty($app_settings['segment_created']) and $app_settings['segment_created'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="wIeWjgZB">
                                                    <div class="col-md-4" data-name="rnZzDeY5">
                                                        <label class="col-form-label switch-label top-label label-link" for="broadcast_scheduled">
                                                            {{ trans('settings.application.notifications.form.broadcast_scheduled') }}
                                                            {!! popover('settings.application.notifications.form.broadcast_scheduled_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="rnZzDeYc">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="broadcast_scheduled" name="broadcast_scheduled" @if(!empty($app_settings['broadcast_scheduled']) and $app_settings['broadcast_scheduled'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="IVboeCyv">
                                                    <div class="col-md-4" data-name="lktdIPy2">
                                                        <label class="col-form-label switch-label top-label label-link" for="broadcast_started">
                                                            {{ trans('settings.application.notifications.form.broadcast_started') }}
                                                            {!! popover('settings.application.notifications.form.broadcast_started_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="lktdIPym">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="broadcast_started" name="broadcast_started" @if(!empty($app_settings['broadcast_started']) and $app_settings['broadcast_started'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="oYGhDKND">
                                                    <div class="col-md-4" data-name="QCXeIEE9">
                                                        <label class="col-form-label switch-label top-label label-link" for="broadcast_finished">
                                                            {{ trans('settings.application.notifications.form.broadcast_finished') }}
                                                            {!! popover('settings.application.notifications.form.broadcast_finished_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="QCXeIEEh">
                                                        
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="broadcast_finished" name="broadcast_finished" @if(!empty($app_settings['broadcast_finished']) and $app_settings['broadcast_finished'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="fKzUvzLj">
                                                    <div class="col-md-4" data-name="eCxhHaD1">
                                                        <label class="col-form-label switch-label top-label label-link" for="broadcast_autopaused_monthly_limit">
                                                            {{ trans('settings.application.notifications.form.broadcast_autopaused_monthly_limit') }}
                                                            {!! popover('settings.application.notifications.form.broadcast_autopaused_monthly_limit_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="eCxhHaDv">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="broadcast_autopaused_monthly_limit" name="broadcast_autopaused_monthly_limit" @if(!empty($app_settings['broadcast_autopaused_monthly_limit']) and $app_settings['broadcast_autopaused_monthly_limit'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="pquPlQIr">
                                                    <div class="col-md-4" data-name="XJBgkej3">
                                                        <label class="col-form-label switch-label top-label label-link" for="broadcast_autopaused_daily_limit">
                                                            {{ trans('settings.application.notifications.form.broadcast_autopaused_daily_limit') }}
                                                            {!! popover('settings.application.notifications.form.broadcast_autopaused_daily_limit_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="XJBgkeju">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="broadcast_autopaused_daily_limit" name="broadcast_autopaused_daily_limit" @if(!empty($app_settings['broadcast_autopaused_daily_limit']) and $app_settings['broadcast_autopaused_daily_limit'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="JZDvcknG">
                                                    <div class="col-md-4" data-name="ZLUFzKXd">
                                                        <label class="col-form-label switch-label top-label label-link" for="broadcast_systempaused_node">
                                                            {{ trans('settings.application.notifications.form.broadcast_systempaused_node') }}
                                                            {!! popover('settings.application.notifications.form.broadcast_systempaused_node_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="ZLUFzKXz">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="broadcast_systempaused_node" name="broadcast_systempaused_node" @if(!empty($app_settings['broadcast_systempaused_node']) and $app_settings['broadcast_systempaused_node'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <div class="form-group row" data-name="JZDvcknG">
                                                    <div class="col-md-4" data-name="ZLUFzKX8">
                                                        <label class="col-form-label switch-label top-label label-link" for="trigger_notifications">
                                                            {{ trans('settings.application.notifications.form.trigger_notifications') }}
                                                            {!! popover('settings.application.notifications.form.trigger_notifications_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="ZLUFzKXz">                                                    
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="trigger_notifications" name="trigger_notifications" @if(!empty($app_settings['trigger_notifications']) and $app_settings['trigger_notifications'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> 
                                                <!--<div class="form-body" data-name="KjaPQaQi">
                                                    <div class="form-group" data-name="hVnAzuXk">
                                                        <label class="col-form-label pl12 switch-label top-label text-link" for="sending_node_failed">
                                                        {{ trans('settings.application.notifications.form.sending_node_failed') }}
                                                        </label>
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                            <label>
                                                                <input type="checkbox" id="sending_node_failed" name="sending_node_failed"  @if(!empty($app_settings['sending_node_failed']) and $app_settings['sending_node_failed'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> -->
                                                <!--<div class="form-body" data-name="MNAygxDD">
                                                    <div class="form-group" data-name="sPJCqwXH">
                                                        <label class="col-form-label pl12 switch-label top-label text-link" for="trigger_action_status">
                                                        {{ trans('settings.application.notifications.form.trigger_action_status') }}
                                                        </label>
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                            <label>
                                                                <input type="checkbox" id="trigger_action_status" name="trigger_action_status" @if(!empty($app_settings['trigger_action_status']) and $app_settings['trigger_action_status'] == "on") checked @endif>
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                </div> -->
                                            </div>
                                        </div>
                                        <div class="kt-portlet__foot" data-name="WYZUBGCt">
                                            <div class="form-actions" data-name="bPwGmyom">
                                                <div class="row" data-name="xCnTvrRF">
                                                    <div class="col-md-6" data-name="txYhMMGs">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- security tab ends --> 

                     <!-- security tab ends -->
                     <div class="tab-pane" id="tab12" data-name="CVxzkayz">
                        <div class="col-md-12" data-name="pwKhUHiL">
                            <form action="" method="POST" id="queue_path_settings" class="kt-form kt-form--label-right">
                                <input type="hidden" name="setting_type" value="queue_path_settings">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row mainBlk" data-name="JfaAToxW">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="OWlXbgPg">
                                        <div class="kt-portlet__head" data-name="AuGdxGia">
                                            <div class="kt-portlet__head-label" data-name="dpltxRVy">                                                
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('settings.application.queue.title')}}<br />
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body" data-name="vztGIoPd">
                                            <div class="form-body" data-name="AwEKJyfH">

                                                <div class="form-group row mb0" data-name="iBcnUnHE">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            {{trans('settings.application.open_tracking')}}
                                                            {!! popover('settings.application.queue.open_tracking_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="OYPJaTfS">
                                                        <div class="pt5 kt-radio-inline" data-name="PXzHmeLu">
                                                            <label class="kt-radio kt-radio--default first-radio" for="open_default_pathtrack">
                                                                <input id="open_default_pathtrack"  checked type="radio" name="open_tracking" value="realtime">
                                                                <span></span>
                                                                {{trans('settings.application.realtime')}}
                                                            </label> 
                                                            <label class="kt-radio kt-radio--default" for="ocustom_path">
                                                                <input id="ocustom_path" @if(!empty($app_settings['open_tracking']) and $app_settings['open_tracking'] == "cron") checked @endif type="radio" name="open_tracking" value="cron">
                                                                <span></span>
                                                                {{trans('settings.application.cron')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row mb0 openTrackingCron " data-name="iBcnUnHE" style="display:none">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label">
                                                            <div class="nextrow"><i class="la la-level-down lshap"></i></div>
                                                            <span>{{trans('settings.application.queue.opened_toggle_name')}}
                                                            {!! popover('settings.application.queue.opened_toggle_name','') !!}</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6" data-name="OYPJaTfS">
                                                        <div class="pt5 kt-radio-inline" data-name="PXzHmeLu">
                                                            <label class="kt-radio kt-radio--default first-radio" for="open_default_path">
                                                                <input id="open_default_path"  checked type="radio" name="opened_path" value="off">
                                                                <span></span>
                                                                Default
                                                            </label> 
                                                            <label class="kt-radio kt-radio--default" for="open_custom_path">
                                                                <input id="open_custom_path" @if(!empty($app_settings['opened_path']) and $app_settings['opened_path'] == "on") checked @endif type="radio" name="opened_path" value="on">
                                                                <span></span>
                                                                Custom
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row openedFilesPath mt15" data-name="iBcnUnHE">
                                                    <div class="col-md-4 " data-name="kpOVeSCT"  >
                                                        <div class="nextrow"><i class="la la-level-down lshap"></i></div>
                                                        <div class="input-icon right" data-name="jqOsZAIQ">
                                                            <input type="text" id="opened_files_path" name="opened_files_path" value="{{isset($app_settings['opened_files_path']) ? $app_settings['opened_files_path'] : '' }}" class="form-control" />
                                                            <span id="folderPermissionOpened"></span>
                                                        </div>
                                                    </div>  
                                                </div> 
                                              

                                                <div class="form-group row mb0" data-name="iBcnUnHE">
                                                    <label class="col-form-label col-md-4">
                                                    {{trans('settings.application.click_tracking')}}
                                                    {!! popover('settings.application.queue.click_tracking_help','common.description') !!}
                                                    </label>
                                                    <div class="col-md-3" data-name="OYPJaTfS">
                                                        <div class="pt5 kt-radio-inline" data-name="PXzHmeLu">
                                                            <label class="kt-radio kt-radio--default first-radio" for="click_default_path">
                                                                <input id="click_default_path"  checked type="radio" name="click_tracking" value="realtime">
                                                                <span></span>
                                                                {{trans('settings.application.realtime')}}
                                                            </label> 
                                                            <label class="kt-radio kt-radio--default" for="ccustom_path">
                                                                <input id="ccustom_path" @if(!empty($app_settings['click_tracking']) and $app_settings['click_tracking'] == "cron") checked @endif type="radio" name="click_tracking" value="cron">
                                                                <span></span>
                                                                {{trans('settings.application.cron')}}
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group row mb0 clickTrackingCron" data-name="iBcnUnHE" style="display:none">
                                                    <label class="col-form-label col-md-4">
                                                        <div class="nextrow"><i class="la la-level-down lshap"></i></div>
                                                        <span>{{trans('settings.application.queue.clicked_toggle_name')}}
                                                        {!! popover('settings.application.queue.clicked_toggle_name','common.description') !!}</span>
                                                    
                                                    </label>
                                                    <div class="col-md-3" data-name="OYPJaTfS">
                                                        <div class="pt5 kt-radio-inline" data-name="PXzHmeLu">
                                                            <label class="kt-radio kt-radio--default first-radio" for="default_path">
                                                                <input id="default_path"  checked type="radio" name="clicked_path" value="off">
                                                                <span></span>
                                                                Default
                                                            </label> 
                                                            <label class="kt-radio kt-radio--default" for="custom_path">
                                                                <input id="custom_path" @if(!empty($app_settings['clicked_path']) and $app_settings['clicked_path'] == "on") checked @endif type="radio" name="clicked_path" value="on">
                                                                <span></span>
                                                                Custom
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>



                                              


                                                <div class="form-group row clickedFilesPath mt15" data-name="iBcnUnHE">
                                                    <div class="col-md-4 " data-name="kpOVeSCT"  >
                                                        <div class="input-icon right" data-name="jqOsZAIQ">
                                                            <div class="nextrow"><i class="la la-level-down lshap"></i></div>
                                                            <input type="text" id="clicked_files_path" name="clicked_files_path" value="{{isset($app_settings['clicked_files_path']) ? $app_settings['clicked_files_path'] : '' }}" class="form-control" />
                                                            <span id="folderPermissionClick"></span>
                                                        </div>
                                                    </div>  
                                                </div> 

                                              

                                                <div  class="form-group row mb0" data-name="oHFAOSnq" >
                                                    <label class="col-form-label col-md-4">
                                                        {{trans('settings.application.broadcast.form.esp_method_title')}}
                                                        {!! popover('settings.application.queue.esp_method_help','common.description') !!}
                                                    </label>
                                                    <div class="col-md-4" data-name="OYPJaTfS">
                                                        <div class="pt5 kt-radio-inline" data-name="AeFqozzE">
                                                            <label class="kt-radio kt-radio--default first-radio">
                                                                <input type="radio" id="esp-method11" name="process_callbacks_via_file" checked   value="0">{{trans('settings.application.broadcast.form.realtime')}}
                                                                <span></span>
                                                            </label>
                                                            <label class="kt-radio kt-radio--default">
                                                                <input type="radio" id="esp-method22" name="process_callbacks_via_file" @if(!empty($app_settings['process_callbacks_via_file']) and $app_settings['process_callbacks_via_file'] == 1) checked  @endif value="1" >{{trans('settings.application.broadcast.form.cron_based')}}
                                                                <span></span>
                                                            </label>                      
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group" data-name="AiHTiXge">
                                                    <h3 class="mini_heading">{{trans('settings.application.queue.title2')}}</h3>
                                                    <hr>
                                                </div>


                                                <div class="form-group row delete-child2" data-name="fJObSmGY">
                                                    <div class="col-md-4 label-block" data-name="dAtunjW5">
                                                        <label class="col-form-label label-link" for="logs1">{{ trans('settings.application.log.form.delete_subscriper') }}
                                                            {!! popover('settings.application.log.form.delete_subscriper_help','common.description') !!}
                                                        </label>
                                                    </div>
                                                    <div class="col-md-1" data-name="dAtunjWz">
                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                            <label>
                                                                <input type="checkbox" id="logs1" name="delete_schedule_broadcast_flag" >
                                                                <span></span>
                                                            </label>
                                                        </span>
                                                    </div>
                                                    <div class="col-md-2 mb0">
                                                        <div id="feild1">
                                                            <input type="number" min="1"  value="{{!empty($app_settings['delete_schedule_broadcast']) ? $app_settings['delete_schedule_broadcast'] : '30' }}" name="delete_schedule_broadcast" class="form-control" />
                                                            <small class="days-right f1days">Days</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="delete-child">
                                                    <div class="form-group row" data-name="fJObSmGY">
                                                        <div class="child-block col-md-4 label-block">
                                                            <div class="lshapeBlk" data-name="DryEbTIz"><i class="la la-level-down lshap"></i></div>
                                                            <div class="lshBlksl" data-name="MQacFCdo">
                                                                <label class="col-form-label label-link" for="logs2">{{ trans('settings.application.log.form.delete_emailopenlogs') }}
                                                                    {!! popover('settings.application.log.form.delete_emailopenlogs_help','common.description') !!}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" id="logs2" name="delete_emailopenlogs_flag">
                                                                        <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 mb0">
                                                            <div id="feild2" class="logs-sfield">
                                                                <input type="number" min="1"  value="{{!empty($app_settings['delete_emailopenlogs']) ? $app_settings['delete_emailopenlogs'] : '30' }}" name="delete_emailopenlogs" class="form-control " />
                                                                <small class="days-right fdays">Days</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="delete-child">
                                                    <div class="form-group row" data-name="fJObSmGY">
                                                        <div class="child-block col-md-4 label-block">
                                                            <div class="lshapeBlk" data-name="DryEbTIz"><i class="la la-level-down lshap"></i></div>
                                                            <div class="lshBlksl" data-name="MQacFCdo">
                                                                <label class="col-form-label label-link" for="logs3">{{ trans('settings.application.log.form.delete_emailclicks') }}
                                                                    {!! popover('settings.application.log.form.delete_emailclicks_help','common.description') !!}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" id="logs3" name="delete_emailclicks_flag">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div class="form-group col-md-2 mb0" data-name="dAtunjWx">
                                                            <div id="feild3" class="logs-sfield">
                                                                <input type="number" min="1" value="{{!empty($app_settings['delete_emailclicks']) ? $app_settings['delete_emailclicks'] : '30' }}" name="delete_emailclicks" class="form-control" />
                                                                <small class="days-right fdays">Days</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="delete-child">
                                                    <div class="form-group row" data-name="fJObSmGY">   
                                                        <div class="child-block col-md-4 label-block">
                                                            <div class="lshapeBlk" data-name="DryEbTIz"><i class="la la-level-down lshap"></i></div>
                                                            <div class="lshBlksl" data-name="MQacFCdo">
                                                                <label class="col-form-label label-link" for="logs4">{{ trans('settings.application.log.form.delete_emailbounced') }}
                                                                    {!! popover('settings.application.log.form.delete_emailbounced_help','common.description') !!}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" id="logs4" name="delete_emailbounced_flag">
                                                                        <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div class="col-md-2 mb0" data-name="dAtunjWw">
                                                            <div id="feild4" class="logs-sfield">
                                                                <input type="number" min="1"  value="{{!empty($app_settings['delete_emailbounced']) ? $app_settings['delete_emailbounced'] : '30' }}" name="delete_emailbounced" class="form-control" />
                                                                <small class="days-right fdays">Days</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="delete-child">
                                                    <div class="form-group row " data-name="fJObSmGY">
                                                        <div class="child-block col-md-4 label-block">
                                                            <div class="lshapeBlk" data-name="DryEbTIz"><i class="la la-level-down lshap"></i></div>
                                                            <div class="lshBlksl" data-name="MQacFCdo">
                                                                <label class="col-form-label label-link" for="logs5">{{ trans('settings.application.log.form.delete_unsubscribed') }}
                                                                    {!! popover('settings.application.log.form.delete_unsubscribed_help','common.description') !!}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" id="logs5" name="delete_unsubscribed_flag">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                        <div class="form-group col-md-2 mb0" data-name="dAtunjWv">
                                                            <div id="feild5" class="logs-sfield">
                                                                <input type="number" min="1" value="{{!empty($app_settings['delete_unsubscribed']) ? $app_settings['delete_unsubscribed'] : '30' }}" name="delete_unsubscribed" class="form-control" />
                                                                <small class="days-right fdays">Days</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                       </div>

                                        <div class="kt-portlet__foot" data-name="WYZUBGCt">
                                            <div class="form-actions" data-name="bPwGmyom">
                                                <div class="row" data-name="xCnTvrRF">
                                                    <div class="col-md-6" data-name="txYhMMGs">
                                                        <button {{$attribute}}  type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- security tab ends -->    


                  

                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<div id="modal-db-details" class="modal" role="dialog" aria-hidden="true" data-name="oNpKLcgw">
    <div class="modal-dialog" style="width: 800px;" data-name="bfrKxvCu">
        <div class="modal-content" data-name="UQFZezVB">
            <div class="modal-body" data-name="wxfQuEmX">
                <div class="dataTables_wrapper no-footer" data-name="osHOrsYa">
                    <div id ="tbody-data" data-name="xRvGJuAb"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="verifyModal2" class="modal" tabindex="-1" role="dialog" data-name="czyZOoaL">
    <div class="modal-dialog" style="width: 500px;" role="document" data-name="sHzJYpeJ">
        <div class="modal-content" data-name="JXTIpVeu">
            <div class="modal-header" data-name="QYAAPviq">
                <h3 class="modal-title">{{trans('settings.confirmation')}}</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </div>
            <div class="modal-body" data-name="DHJcYpMW">
                <div class="form-row" data-name="anMpHxHr">
                    <div class="form-group" data-name="fzkLpbZC">
                        {{trans('settings.message.all_domains_ownership')}}
                    </div>
                    <div class="form-group" data-name="EvSauQPF">
                        <div class="mt-checkbox-list" data-name="ERlbknza">
                            <label class="mt-checkbox">
                                <input type="radio" value="1" name="is_all_domain_verify" id="verify1">{{trans('settings.first_name')}}
                                <span></span>
                            </label>
                        </div>
                        <div class="form-" data-name="SlaNLOOE"></div>
                    </div>
                    <div class="form-group" data-name="kiPHRtMe">
                        <button type="button" class="btn btn-success" id="ownersVer">{{trans('settings.verify_domains')}}</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="modal-loading" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="wSFzsDJn">
        <i class="fa fa-spinner fa-spin fa-5x"></i>
</div>

<div class="modal fade" id="encryptMsgBlk" tabindex="-1" role="dialog" data-keyboard="false" data-backdrop="static" aria-modal="true"  aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="BWXJfpFc">
    <div class="modal-dialog  modal-dialog-centered" role="document" data-name="EVzYZYoh">
        <div class="modal-content" data-name="FKfAwFqq">
            <div class="modal-header" data-name="xqZibrAI">
                <h5 class="modal-title">{{trans('settings.database_backup')}}</h5>
            </div>
            <div class="modal-body" data-name="FKLUDmxJ">
                <input type="hidden" id="active_id" name="active_id" value=""/>
                <p>{{trans('settings.para_enabling')}}</p>
            </div>
            <div class="modal-footer" data-name="YDkdLRUh">
                <button type="button" class="btn btn-default btn-sm pull-left" id="close-modal">{{trans('settings.close_b')}}</button>
                <button type="button" class="btn btn-success btn-sm pull-right" id="enc_process">{{trans('settings.proceed_b')}}</button>
            </div>
        </div>
    </div>
</div>

<div id="preview_html" class="modal" tabindex="-1" role="dialog" data-name="gjdDLaEE" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" data-name="OSKEgspQ">
        <div class="modal-content" data-name="MUkFwvoN">
            <div class="modal-header" data-name="vKvPDqGY">
                <h5 class="modal-title">{{trans('settings.email_header')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body scroll scroll-300" data-name="vFnUPWoi">
                <div id="priview"></div>
            </div>
        </div>
    </div>
</div>

<div id="preview_html2" class="modal" tabindex="-1" role="dialog" data-name="gjdDLaEE" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" data-name="OSKEgspQ">
        <div class="modal-content" data-name="MUkFwvoN">
            <div class="modal-header" data-name="vKvPDqGY">
                <h5 class="modal-title">{{trans('settings.email_footer')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body scroll scroll-300" data-name="vFnUPWoi">
                <div id="priview2"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  
    $('#gavatar_state').on('change', function() { 
        $(".blockUI").show();
        var checked = $(this).is(":checked");
        console.log(checked);
        if(checked == true) {
            $.get('/checkGravatarAccess', function(data){ 
                $(".blockUI").show();
                if(data=='Allowed'){
                    $('#gravatar_allowed').css('display','flex');
                    $('#gravatar_not_allowed').css('display','none');
                    $(".blockUI").hide();
                }
                else if(data=='Not Allowed'){
                    $('#gravatar_not_allowed').css('display','flex');
                    $('#gravatar_allowed').css('display','none');
                    $(".blockUI").hide();
                }
            });
        } else {
            $('#gravatar_allowed').hide();
            $('#gravatar_not_allowed').hide();
            $(".blockUI").hide();
        }
       
    });

    
    // editor = CKEDITOR.replace( 'email_global_header', {
    //     fullPage: true,
    //     allowedContent: true,
    //     height: 200
    // });
    // editor2 = CKEDITOR.replace( 'mail_global_footer', {
    //     fullPage: true,
    //     allowedContent: true,
    //     height: 200
    // });

    // enter work as <p> instead <br>
    // CKEDITOR.config.enterMode = CKEDITOR.ENTER_P;

    // // CKEDITOR.config.extraPlugins = 'imageuploader,preview,font,';
    // CKEDITOR.config.extraPlugins = 'preview,font,zsuploader,emojione';

    // CKFinder.setupCKEditor( editor );
    // CKFinder.setupCKEditor( editor2 );


    // config.uploadUrl = '/uploader/upload.php';
</script>
@endsection