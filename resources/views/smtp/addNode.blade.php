@extends('layouts.master2')

@section('title', $page_data['title'] )

@section('page_styles')
<link href="/resources/assets/css/node-create-smtp.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
.col-md-6>.kt-switch.reply-click, .col-md-6>.kt-switch.bounce-click {
    margin-top: 0px !important;
}    
#amazonRes {
    padding-left: 30px;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/lib.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.input.js" type="text/javascript"></script>
<script src="/themes/default/js/repeater.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/validate-form.js?t=5" type="text/javascript"></script>
<script>
    $("#masked_domain_id").change(function(){
        $("#masked_domain_id_error_message").hide().text('');
        $("#masked_domain_intec_id_error_message").hide().text('');
        $.ajax({
            url: '/broadcasts/checkTrackingDomainStatus',
            type: 'POST',
            dataType: 'json',
            data: {"_token": '{{Session::token()}}','masked_domain_id':$(this).val()},
            success: function(result) {
                if(result.status == 'fail'){
                    $("#masked_domain_id_error_message").show().html(result.message);
                }else if(result.status == 'warning'){
                    $("#masked_domain_intec_id_error_message").show().html(result.message);
                }else{
                    $("#masked_domain_id_error_message").hide().text('');
                }
            }
        });

    });
    $('#masked_domain_id').trigger('change');
    $('#cncl').live('click',function (){
        window.location.href = '{{route('node.index')}}';
    });
    $('.form-control').live('keypress keyup change', function(e) {
        id = this.id;
        id = '#'+id;
        if(id=="#")
            return;
        err_id = '#'+this.id+'-error';
        $(id).removeClass('is-invalid');
        $(err_id).css('display','none');
    });
    $("#process1").live('click',function() {
        $("#modal-loading").show();
        setTimeout(function(){
            $("#process2").removeAttr("disabled");
            $("#modal-loading").hide();
        }, 1500);
    });
    $("#process2").live('click',function() {
        //$("#modal-loading").show();
        /*setTimeout(function(){
            $("#process3").removeAttr("disabled");
            $("#modal-loading").hide();
        }, 1500);
        */
        $.ajax({
            url: "/storage/amazonsns.txt",
            type: 'get',
            error: function(XMLHttpRequest, textStatus, errorThrown){
                toastr.error('{{trans('response.amazon.subscription.not_found')}}');
            },
            success: function(data){
                $("#process3").removeAttr("disabled");
            }
        });
    });





    $("#process3").live('click',function() {
        $("#modal-loading").show();
        setTimeout(function(){
            $("#config_name").focus();
            $("#modal-loading").hide();
        }, 1500);
    });
    function showModalLog() {
        $('#debug_output').modal('show');
    }
    $('.sb').live('click',function(e){
        btn_id = this.id;
        id = $("#id").val();
        method = "POST";
        route = '{{route('nodeSave')}}';
        if(id!==undefined && id>0)
        {
            method = "PUT";
            route = '{{route('nodeUpdate',"")}}'+'/'+id;
        }
        formId = "#nodeForm";
        createOrUpdate(method, route, formId,e,btn_id);
    });

    var error_message = "{{trans('common.message.opps')}}";
    var redirect="{{ route('node.index') }}";
</script>
<script src="/themes/default/js/includes/smtp.js" type="text/javascript"></script>
<script>
    $('#additional-settings').live('click',function(){
        $( ".custom-show" ).toggle();
    });
    $(document).ready(function (){
        $('#gateway').trigger("change");
    });
    $(document).on('change','#smtp_encryption',function(){
        if(this.value=="ssl" || this.value=="tls"){
            $('#smtp_options').show();
            if(this.value=="tls")
                $('#allow_self_signed').prop('checked',true);
        }else{
            $('#smtp_options').hide();
        }
    });
    var esp;
    var esp_id;
    $('#gateway').change(function ()
    {
      //  $('#validateSmtpNode').hide();
        esp = $('#gateway').val();
        if(esp=='-1') {
            $('#esp_config').html('');
            $(".gateway-iconblk").css('background-image', 'url(/public/img/icon/ask.gif)');
            return;
        }
        const nodes = ["yahoo", "outlook", "gmail", "aol"];
        if(nodes.includes(esp))
        {
            $('#reply_bounce_div').hide();
            $('#sender_email_div').hide();
            $('#mail_encoding_div').show();
           // $('#validateSmtpNode').show();
        }
        else if(esp=='smtp'){
            $('#reply_bounce_div').show();
            $('#sender_email_div').show();
            $('#mail_encoding_div').show();
            //$('#validateSmtpNode').show();
        }
        else{
            $('#reply_bounce_div').show();
            $('#sender_email_div').show();
            $('#mail_encoding_div').hide();
        }
        esp_id = $('#id').val();
        $.ajax({
            url: '{{route('getNodeConfig','')}}/'+esp,
            type: 'POST',
            dataType: 'json',
            beforeSend:function (){
                $(".blockUI").show();
                $('#esp_config').html('');
            },
            data: {"_token": token,'esp_id':esp_id},
            success: function(result) {
                $(".blockUI").hide();
                if(result.status=='success') {
                    $('#esp_config').html(result.html);
                    $('.m-select2 ').select2();
                    $(".gateway-iconblk").removeClass('smtp');
                   $(".gateway-iconblk").css('background-image', 'url(' + result.background_image + ')');
                   if(!result.canAddBounce_)
                   {
                        $('#bnc_div').hide();
                       $('#reply_bounce_div').show();
                        $('#bounce_email_id').prop('disabled',true);
                       $('#bounce_block').prop('checked',false);
                   }
                   else
                       {
                       $('#bnc_div').show();
                       $('#reply_bounce_div').show();
                       $('#bounce_email_id').prop('disabled',false);
                   }
                    $("body").popover({
                        trigger: "hover",
                        sanitize: false,
                        html: true,
                        animation: true,
                        selector: '.popovers',
                    });
                    if(nodes.includes(esp))
                        $('#smtp_encryption').change();
                }
                else
                Command: toastr["error"] (result.message);
            },complete: function () {
                $('.blockUI').hide();
            }
        });
    });
    var form_error="{{trans('common.message.form_error')}}";
     var groups_msg="{{trans('common.label.groups_msg')}}";
    var token = "{{ csrf_token() }}";
    var node_id_db = "{{ $iid }}";
    function copy_user(containerid) {
        var range = document.createRange();
        range.selectNode(containerid); //changed here
        window.getSelection().removeAllRanges(); 
        window.getSelection().addRange(range); 
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        Command: toastr["success"] ("{{trans('sending_nodes.add_node_blade.value_copied_command')}}");
    }
    function copyFunction() {
        var copyText = document.getElementById("copyurl");
        copyText.select();
        document.execCommand("copy");
        //alert("Copied the text: " + copyText.value);
         Command: toastr["success"] ("{{trans('sending_nodes.message.domain_url_copied')}}");
    }
    function copyFunction2() {
        var copyText = document.getElementById("copyurl2");
        copyText.select();
        document.execCommand("copy");
        //alert("Copied the text: " + copyText.value);
        Command: toastr["success"] ("{{trans('sending_nodes.message.domain_url_copied')}}");
    }

    $( "#additional-settings" ).click(function() {
        $( ".custom-show" ).toggle();
    });

    $( "#additional-settings-sender" ).click(function() {
        $( ".custom-show-sender" ).toggle();
    });

    $("#username").on("change paste keyup", function() {
        $("#reply_email").val($("#username").val());
        $("#sender_username").val($("#username").val());
    });


    $(window).on("load",function() {
      /*  $("#p1 .bootstrap-switch").attr("id", "check1");
        $("#p2 .bootstrap-switch").attr("id", "check2");
        $("#p3 .bootstrap-switch").attr("id", "check3");
        var iid = $("#sending_node_id").val();
        if(iid == 5 || iid == 6 || iid == 7  || iid == 8) {
            $('.custom-show').hide();
            $('.custom-show-sender').hide();
        }*/
        var hss = $("#hss").val();
        var dbs = $("#dbs").val();
        var pds = $("#pds").val();
        var ahh = $("#ahh").val();

       /* if(hss == "on") {
            $("#hourlyspeed").show();
        }
        if(dbs == "on") {
            $("#delaybatch").show();
        }

        if(pds == 1){
            $("#phBncBlk").show();
            $("#dtlBlk").show();
            $("#pbounce_status").prop("checked", true);
        }else if (pds == ''){
            $("#phBncBlk").show();
            $("#dtlBlk").show();
            $("#pbounce_status").prop("checked", true);
        } else{
            $("#phBncBlk").hide();
            $("#dtlBlk").hide();
            $("#pbounce_status").prop("checked", false);
        }*/

        if(ahh != ""){
            $(".mt-repeater").show();
        }

    });

    $(document).ready(function() {

        $(".reply-click").on("click",function(){
            var check = $("#reply_block").is(":checked");
            // console.log(check);
            if (check === true) {

                $(".reply-block").slideDown();
            } else if (check === false) {

                $(".reply-block").slideUp();
            }
        });

        $("#tr_domain").on("click",function(){

            var check = $("#tr_domain").is(":checked");
            if (check === true)
                $("#tr-block").slideDown();
             else {
                $("#tr-block").slideUp();
                $('#masked_domain_id').val("");
                $('#masked_domain_id').select2();
            }

        });

        $(".bounce-click").on("click",function(){
            var check = $("#bounce_block").is(":checked");
            // console.log(check);
            if (check === true) {

                $(".bounce-block").slideDown();
            } else if (check === false) {
                $(".bounce-block").slideUp();
            }
        });

        $('#copydbug2').click(function(e) {
            var text = $("#msg_body").html().trim();
            var copyHex = document.createElement('input');
            copyHex.value = text
            document.body.appendChild(copyHex);
            copyHex.select();
            document.execCommand('copy');
            //console.log(copyHex.value)
            document.body.removeChild(copyHex);
            Command: toastr["success"] ("{{trans('sending_nodes.add_node_blade.code_copied_command')}}");
        });

        $(".m-select2").select2({
            placeholder: 'Select Option'
        });

        $("#process1").click(function() {
            $("#modal-loading").show();
            setTimeout(function(){
                $("#process2").removeAttr("disabled");
                $("#modal-loading").hide();
            }, 1500);
        });
        $("#process2").click(function() {
            //$("#modal-loading").show();
            /*setTimeout(function(){
                $("#process3").removeAttr("disabled");
                $("#modal-loading").hide();
            }, 1500);
            */
            $.get( "/storage/amazonsns.txt", function( data ) {
                $('#confirm-sub-amazon').attr("href", data)
                $("#process3").removeAttr("disabled");
            });
        });
        $("#process3").click(function() {
            $("#modal-loading").show();
            setTimeout(function(){
                $("#config_name").focus();
                $("#modal-loading").hide();
            }, 1500);
        });


        $(".new-btn").click(function(){
            $(this).remove();
            $(".mt-repeater").slideDown();
            $("#btn-new").css("display", "flex");
        });

        /*$('input[type=radio][name=pbounce]').change(function() {
          $("input[name='pbounce']").parent().removeClass("selected");
          $("input[name='pbounce']:checked").parent().addClass("selected");
        });*/

        $("#pbounce_status").live('click',function() {
            if($('#pbounce_status').is(':checked')) {
                $("#phBncBlk").slideDown();
                $("#dtlBlk").slideDown();
            }
            else {
                $("#phBncBlk").slideUp();
                $("#dtlBlk").slideUp();
            }
        });

        $("#p1 .bootstrap-switch-label, #p1 .bootstrap-switch-default").click(function () {
            $("#phBncBlk").toggle(500);
            $("#dtlBlk").toggle(500);
        });
        $("#p1 .bootstrap-switch-handle-on").click(function () {
            $("#phBncBlk").hide(500);
            $("#dtlBlk").hide(500);
        });

        $("#p2 .bootstrap-switch-label, #p2 .bootstrap-switch-default").click(function () {
            $("#hourlyspeed").toggle(500);
        });
        $("#p2 .bootstrap-switch-handle-on").click(function () {
            $("#hourlyspeed").hide(500);
        });

        $("#p3 .bootstrap-switch-label, #p3 .bootstrap-switch-default").click(function () {
            $("#delaybatch").toggle(500);
        });
        $("#p3 .bootstrap-switch-handle-on").click(function () {
            $("#delaybatch").hide(500);
        });

        $("#pbo1").click(function() {
            $(".pbo11").addClass("show");
            $(".pbo22").removeClass("show");
            $(".pbo33").removeClass("show");
            $(".pbo44").removeClass("show");
            $(".pbo22").addClass("hide");
            $(".pbo33").addClass("hide");
            $(".pbo44").addClass("hide");
        });
        $("#pbo2").click(function() {
            $(".pbo22").addClass("show");
            $(".pbo11").removeClass("show");
            $(".pbo33").removeClass("show");
            $(".pbo44").removeClass("show");
            $(".pbo11").addClass("hide");
            $(".pbo33").addClass("hide");
            $(".pbo44").addClass("hide");
        });
        $("#pbo3").click(function() {
            $(".pbo33").addClass("show");
            $(".pbo11").removeClass("show");
            $(".pbo22").removeClass("show");
            $(".pbo44").removeClass("show");
            $(".pbo11").addClass("hide");
            $(".pbo22").addClass("hide");
            $(".pbo44").addClass("hide");
        });
        $("#pbo4").click(function() {
            $(".pbo44").addClass("show");
            $(".pbo11").removeClass("show");
            $(".pbo22").removeClass("show");
            $(".pbo33").removeClass("show");
            $(".pbo11").addClass("hide");
            $(".pbo22").addClass("hide");
            $(".pbo33").addClass("hide");
        });

        setTimeout(function(){
            $(".form-wizard .steps").fadeIn('300');
        }, 300);
        $("#sender_host").change(function(){
            // if(node_id_db==1 || node_id_db==2 || node_id_db==3 || node_id_db==4 || node_id_db==13){
                $.ajax({
                    url: '/broadcasts/change-masking-domain',
                    type: 'POST',
                    dataType: 'json',
                    data: {"_token": token,'tracking_domain':$("#sender_host").val(),'id':node_id_db},
                    success: function(result) {
                        if(result.status == 'success'){
                            $("#masked_domain_id").val(result.id);
                            $('#masked_domain_id').trigger('change');
                        }
                    }
                });
            // }

        });

    });
     $("#masked_domain_id").change(function(){
            $("#masked_domain_id_error_message").hide().text('');
                $.ajax({
                    url: '/broadcasts/checkTrackingDomainStatus',
                    type: 'POST',
                    dataType: 'json',
                    data: {"_token": token,'masked_domain_id':$(this).val()},
                    success: function(result) {
                        if(result.status == 'fail'){
                            $("#masked_domain_id_error_message").show().html(result.message);
                        }else{
                             $("#masked_domain_id_error_message").hide().text('');
                        }
                    }
                });

        });
         $('#masked_domain_id').trigger('change');

    function domainMailgun()
    {
        var domain = $("#domain_name").val();
        var url = 'http://' + domain + '/callbacks/mailgun';
        $("#copyurl").val(url);
    }
    function domainMailgun4()
    {
        var domain = $("#domain_name").val();
        var url = 'http://' + domain + '/callbacks/amazonses';
        $("#copyurl").val(url);
    }
</script>
<script type="text/javascript">
    var KTFormRepeater = function() {
        var demo1 = function() {
            $('#kt_repeater_3').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    if(confirm('@lang("common.message.delete_warning")')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        }
        return {
            init: function() {
                demo1();
            }
        };
    }();
    jQuery(document).ready(function() {
        KTFormRepeater.init();
    });
    function validateEmail(email)
    {
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
    $(".testEmail").click(function(){
        //if(!$('#gateway').is(':checked'))
        $('#authUser').hide();
        $('#email-error').hide();
        $('#smtp_email').remove('is-invalid');
        $("#copydbug").hide();
        gateway = $('#gateway').val();
        $("#mail-sent-msg").attr("style", "display:none");
        $("#mail-sent-log-link").attr("style", "display:none");
        $("#mail-sent-log").attr("style", "display:none");
        var el = $('#php_mailer');
        var debug_log = el!==undefined && $(el).is(":checked") && this.id!='validateSmtpNode';
        if(debug_log)
            debug_log = 1;
        else
            debug_log = 0
        var validate_only = 0;
        var email =  $('#smtp_email').val();
        if(this.id=='validateSmtpNode') {
            $('#authUser').show();
            email = 'sample@gmail.com';
            validate_only=1;
        }
        if(!validateEmail(email)) {
            $('#email-error').show();
            $('#smtp_email').addClass('is-invalid');
            return ;
        }
        nodeType = $('#gateway').val();
        var form_data =  $("#nodeForm").serialize();
        $.ajax({
            url: '{{route('sendTestMail')}}',
            type: "post",
            data: form_data+'&test_email='+email+'&debug_log='+debug_log+'&esp='+nodeType+'&validate_only='+validate_only+'&gateway='+gateway,
            beforeSend: function( xhr ) {
                $('.form-control').removeClass('is-invalid');
                $('.error').css('display','none');
                $('#validate-mail-sent-msg').hide();
                $('#validate-mail-sent-msg').html('');
                $("#modal_span").hide();
                $("#mail-sent-msg").html("");
                $("#msg_body").html("");
                $("#mail-sent-msg").removeClass("alert alert-success");
                $("#smpt-send-mail").prop("type", "button");
                $("#smpt-send-mail").html("Sending Email...");
                //$("#send-test-mail").prop("disabled",true);
                $(".blockUI").show();
            },
            success: function(msg) {
                $(".blockUI").hide();
                // console.log(msg);
                $("#mail-sent-msg").removeAttr("style", "display:none");
                $("#copydbug").removeAttr("style", "display:none");
                if (msg.status == 1) {
                    if(validate_only==1)
                    {
                        $('#validate-mail-sent-msg').removeClass("alert-danger");
                        $('#validate-mail-sent-msg').addClass("alert alert-success");
                        $("#validate-mail-sent-msg").html("{{trans('sending_nodes.validated')}}");
                        $("#validate-mail-sent-msg").show();
                    }
                    else {
                        $("#mail-sent-msg").removeClass("alert-danger");
                        $("#mail-sent-msg").addClass("alert alert-success");
                        $("#mail-sent-msg").html(msg.text);
                        $("#mail-sent-msg").show();
                        $("#modal_span").hide();
                        $("#mail-sent-log").html('');
                        $('#msg_body').html('');
                    }
                }
                else if(msg.status=='error')
                {
                    toastr.error(msg.message);
                    return;
                }
               else if(msg.status=='validation_failed')
                {
                    var x;
                    messages = msg.messages;
                    for (x in messages) {
                        $('#'+x).addClass('is-invalid');
                        id = '#'+x+'-error';
                        $(id).html(messages[x]);
                        $(id).css('display','block');
                    }
                    $('html, body').animate({
                        scrollTop: $('#name').offset().top
                    }, 800);
                }
                else {
                    if(validate_only==1)
                    {

                        $('#validate-mail-sent-msg').removeClass("alert-success");
                        $('#validate-mail-sent-msg').addClass("alert alert-danger");
                        $('#validate-mail-sent-msg').html(msg.text);
                        $('#validate-mail-sent-msg').show();
                    }
                    else {

                         $("#mail-sent-msg").removeClass("alert-success");
                        $("#mail-sent-msg").addClass("alert alert-danger");
                        $("#mail-sent-msg").html(msg.text);
                        $("#mail-sent-msg").show();
                    }
                }

                    if(msg.log!==undefined) {
                        $("#modal_span").show();
                        $('#msg_body').html(msg.log);
                        $("#copydbug").show();
                    }
                    else{
                        $("#modal_span").hide();
                        //$("#mail-sent-log").html('');
                        $('#msg_body').html('');
                    }


               // $("#send-test-mail").prop("disabled",false);
               // $("#send-test-mail").html("Test Email");
              //  $("#smpt-send-mail").prop("type", "submit");
            },complete: function () {
                $('#authUser').hide();
                $("#send-test-mail").prop("disabled",false);
            $('.blockUI').hide();
        }
        });
        return false;
    });
    $('#confirm-sub-amazon').live('click',function ()
    {
        $.ajax({
            url: "{{route('confirmAmazonSubscription')}}",
            type: 'post',
            beforeSend:function ()
            {
              $('#amazonResponse').hide();
                $('.blockUI').show();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown){
                toastr.error('{{trans('response.amazon.subscription.not_found')}}');
                $('.blockUI').hide();
            },
            success: function(data){
                $('.blockUI').hide();
                if(data.status=='error')
                    toastr.error(data.message)
                else {
                    $('#amazonRes').html(data.message);
                    $('#disc').html(data.disclaimer);
                    $('#amazonResponse').show();
                }
            }
        });
    });
</script>
@endsection

@section('content')

@if (Session::has('msg'))
    <div class="alert alert-success">
        {{ Session::get('msg') }}
    </div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->



<div class="row">
    <div class="col-md-6 create-form wizardNew node-add">

        <div class="kt-content  kt-grid__item kt-grid__item--fluid pb0" id="kt_content">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first">
                <!--begin: Form Wizard Nav -->

                <div class="kt-portlet">
                    <div id="kt-portlet__body kt-portlet__body--fit">
                        <div class="kt-grid">

                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper">

                                <form method="POST" id="nodeForm" class="kt-form kt-form--label-right" novalidate>
                                <input name="id" type="hidden" id="id" value="{{isset($smtp) ? $smtp->id : 0}}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="dbs" value="{{ isset($additional_settings->dbatch_status) ? $additional_settings->dbatch_status : '' }}">
                                    <input type="hidden" id="hss" value="{{ isset($additional_settings->hourlyspeed_status) ? $additional_settings->hourlyspeed_status : '' }}">
                                    <input type="hidden" id="pds" value="{{ isset($smtp->process_delivery_status) ? $smtp->process_delivery_status : '' }}">
                                    <input type="hidden" id="ahh" value="{{ isset($additional_headers) ? 'data' : '' }}">

                                    <div class="form-body">

                                        <div class="tab-content">
                                            <div class="alert alert-danger display-none">
                                                <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}}
                                            </div>
                                            <div class="alert alert-success display-none">
                                                <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}}
                                            </div>


                                                <div class="kt-form__section kt-form__section--first">
                                                    <div class="kt-wizard-v4__form">


                                                      <div class="form-group row mb0">
                                                            <div class="col-md-12">
                                                                <div class="kt-heading kt-heading--md mt0">
                                                                    {{trans('sending_nodes.add_new.sender_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.account_tab.form.description')}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row mb0">
                                                            <label class="col-form-label pl12"> {{trans('common.label.status')}}
                                                                {!! popover('sending_nodes.add_new.form.status_help','common.description') !!}</label>
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                    <label>
                                                                        <input type="checkbox" name="node_status" {{(isset($smtp) && $smtp->status ==1) || (!isset($smtp))  ? 'checked' : '' }}>
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                        </div>
                                                        <div class="form-group row">

                                                             <div class="col-md-6">
                                                                <label class="col-form-label">  {{trans('sending_nodes.add_new.form.node_name')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.node_name_help','common.description') !!} </label>
                                                                <input type="text" id="name" name="name" class="form-control" value="{{isset($smtp->name) ? $smtp->name : '' }}" required />
                                                                 <small id="name-error" class="error invalid-feedback"></small>
                                                             </div>
                                                             <div class="col-md-6">
                                                               <label class="col-form-label">
                                                                    {{trans('common.label.group')}}
                                                                    <span class="required"> * </span>
                                                                    <span>
                                                                        <a href="#modal-group-label" data-toggle="modal"><i class="fa fa-plus-square text-success"></i></a>
                                                                    </span>
                                                                     {!! popover('common.label.group_help','common.description') !!}
                                                                </label>
                                                                <select class="form-control m-select2" data-placeholder="{{ trans('common.label.select_group') }}" name="group_id" id="group_id" >
                                                                    <option value="">{{ trans('common.label.select_group') }}</option>
                                                                    @foreach($groups as $group)
                                                                        <option value="{{ $group->id }}" {{ (isset($smtp->group_id) && $smtp->group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <small id="group_id-error" class="error invalid-feedback"></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>






                                                <div class="form-group row mb0 kt-hide">
                                                    <div class="col-md-12">
                                                        <div class="kt-heading kt-heading--md">
                                                            {{trans('sending_nodes.add_new.sender_tab.form.heading')}}
                                                        </div>
                                                        <p>{{trans('sending_nodes.add_new.sender_tab.form.description')}}</p>
                                                    </div>
                                                </div>

                                                <div class="form-group row filter-block">
                                                    <div class="col-md-12">
                                                        <label class="col-form-label">
                                                            {{trans('sending_nodes.add_node_blade.gateway_txt_label')}}
                                                            {!! popover('sending_nodes.add_node_blade.gateway_relay_email_popover','common.description') !!}
                                                            <span class="required"> * </span>
                                                        </label>
                                                        <div class="gateway-block">
                                                            <div class="gateway-iconblk"></div>
                                                            <div class="gatewaydd">
                                                                <select {{isset($smtp)  ? 'disabled' : ''}} class="form-control m-select2" name="gateway" id="gateway" required data-placeholder="{{ trans('Esp') }}">
                                                                    <option  value="-1">{{ trans('sending_nodes.select_gateway') }}</option>
                                                                    @if(routeAccess('smtp'))
                                                                    <option {{(isset($smtp) && $smtp->type  == 'smtp')  ? 'selected' : ''}} value="smtp">{{ trans('SMTP') }}</option>
                                                                    @endif
                                                                        @foreach($espList as $esp)
                                                                        @if($esp['file_name']=='smtp')
                                                                            @continue
                                                                        @endif
                                                                        <option value="{{ $esp['file_name'] }}" {{ (isset($smtp) && $smtp->type == $esp['file_name']) ? 'selected' : '' }}>{{ $esp['file_name'] }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <small style="color: red;" id="esp-error" class="error invalid-feedback"></small>
                                                    </div>
                                                </div>


                                                <div class="kt-form__section kt-form__section--first">
                                                    <div class="kt-wizard-v4__form" >
                                                        <div id="esp_config" >

                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="kt-form__section kt-form__section--first" >
                                                    <div class="kt-wizard-v4__form">
                                                        <div class="form-group row">
                                                            <div class="col-md-6">
                                                                <label class="col-form-label">
                                                                        {{trans('sending_nodes.add_new.form.sender_name')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.sender_name_help','common.description') !!}
                                                                </label>

                                                                <input required type="text" id="from_name" name="from_name" class="form-control" value="{{isset($smtp->from_name) ? $smtp->from_name : '' }}">
                                                                <small id="from_name-error" class="error invalid-feedback"></small>
                                                            </div>
                                                            <div class="col-md-6" id="sender_email_div">
                                                                <label class="col-form-label">
                                                                    {{trans('sending_nodes.add_new.form.sender_email')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.sender_email_help','common.description') !!}
                                                                </label>
                                                                <div class="row from-email">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control" id="sender_username" name="sender_username" value="{{ isset($from_email_part1) ? $from_email_part1 : '' }}"  >
                                                                            <small id="sender_username-error" class="error invalid-feedback"></small>
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text" id="basic-addon2">@</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="input-icon right">
                                                                            <select class="form-control m-select2" data-placeholder="{{trans('sending_nodes.choose_domain')}}" name="sender_host" id="sender_host" >
                                                                                    <option value="" selected="">{{trans('sending_nodes.choose_domain')}}</option>

                                                                                    <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); ?>
                                                                                    @foreach($domain_maskings as $domain)
                                                                                        @php
                                                                                            $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                                            $replace = '';
                                                                                            $subdomain = str_replace($order, $replace, $domain->domain);
                                                                                        @endphp

                                                                            @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                                            <option   @if(!empty($from_domain) and $from_domain == $domain->domain) selected @endif value="{{ '@' . $subdomain }}">{{ $subdomain }} </option>
                                                                           
                                                                            @else 
                                                                                @php 
                                                                                   $disableTxt = "inactive";
                                                                                    if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                                                    if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                                                
                                                                                @endphp
                                                                                <option  disabled @if(!empty($from_domain) and $from_domain == $domain->domain) selected @endif value="{{ '@' . $subdomain }}">{{ $subdomain }} <small>({{$disableTxt}}) </small></option>
                                                                                    
                                                                            @endif


                                                                                        
                                                                                    @endforeach
                                                                                </select>
                                                                            <small id="sender_host-error" class="error invalid-feedback"></small>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         <div class="form-group row custom-show-sender mb1" id="reply_bounce_div">
                                                            <div class="col-md-6">
                                                                <label class="col-form-label text-link" for="reply_block">

                                                                     {{trans('common.label.reply_path')}}
                                                                    <span class="required"> * </span>
                                                                     {!! popover('common.label.reply_email_help','common.description') !!}
                                                                </label>
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12 pull-right zoom8 reply-click">
                                                                    <label>
                                                                        <input {{isset($smtp->reply_email) ? 'checked' : '' }} name="reply_block" type="checkbox" id="reply_block" value="1" />
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                <div class="reply-block" style="display: {{isset($smtp->reply_email) ? 'block;' : 'none;' }}">
                                                                    <input type="text" name="reply_email" id="reply_email" class="form-control" value="{{isset($smtp->reply_email) ? $smtp->reply_email : '' }}" >
                                                                    <small id="reply_email-error" class="error invalid-feedback"></small>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" id="bnc_div">
                                                                <label class="col-form-label text-link" for="bounce_block">

                                                                  {{trans('common.label.return_path')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('common.label.bounce_email_help','common.description') !!}
                                                                </label>
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12 pull-right zoom8 bounce-click">
                                                                    <label>
                                                                        <input {{isset($smtp->bounce_email_id) && $smtp->bounce_email_id > 0  ? 'checked' : '' }} name="bounce_block" type="checkbox" id="bounce_block" value="1" />
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                <div class="bounce-block" style="display: {{ isset($smtp) && $smtp->bounce_email_id!=null  ? 'block;' : 'none;' }}">
                                                                    <select class="form-control m-select2" data-placeholder="{{ trans('sending_nodes.add_new.form.choose_bounce_email') }}" name="bounce_email_id" id="bounce_email_id">
                                                                        <option value="">{{ trans('sending_nodes.add_new.form.choose_bounce_email') }}</option>
                                                                        @foreach($bounce_emails as $bounce_email)
                                                                            <option value="{{ $bounce_email->id }}" {{ (isset($smtp->bounce_email_id) && $smtp->bounce_email_id == $bounce_email->id) ? 'selected' : '' }} > {{ $bounce_email->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    <small id="bounce_email_id-error" class="error invalid-feedback"></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if(moduleCheck('masking_domains'))
                                                        <div class="form-group row">
                                                            <div class="col-md-12">
                                                                <label class="col-form-label">

                                                                     {{trans('sending_nodes.add_new.form.tracking_domain')}}

                                                                    {!! popover('sending_nodes.add_new.form.tracking_domain_help','common.description') !!}
                                                                </label>
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12 pull-right zoom8 reply-click">
                                                                    <label>
                                                                        <input {{ (isset($smtp) && !empty($smtp->masked_domain_id)) || !isset($smtp) ? 'checked':''}} name="tr_domain" type="checkbox" id="tr_domain" value="1">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                <div id="tr-block" {{ (isset($smtp) && !empty($smtp->masked_domain_id)) || !isset($smtp) ? 'style=display:block;':'style=display:none;'}}">
                                                                <select  class="form-control m-select2" name="masked_domain_id" id="masked_domain_id" data-placeholder="{{ trans('sending_nodes.add_new.form.choose_tracking_domain') }}" required  >
                                                                        <option>{{ trans('sending_nodes.add_new.form.choose_tracking_domain') }}</option>
                                                                        @foreach($domain_maskings as $masked_domain)
                                                                            <option value="{{ $masked_domain->id }}" {{ (isset($smtp->masked_domain_id) && $smtp->masked_domain_id == $masked_domain->id) ? 'selected' : '' }}> {{ $masked_domain->tracking_domain }}.{{ $masked_domain->domain }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                <small id="masked_domain_id-error" class="error invalid-feedback"></small>
                                                                <p class="text-danger" style="padding-top:5px;" id="masked_domain_id_error_message"></p>
                                                                <p class="text-warning" style="padding-top:5px;" id="masked_domain_intec_id_error_message"></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>



                                                <div class="kt-form__section kt-form__section--first">
                                                    <div class="kt-wizard-v4__form">

                                                         <div class="form-group row mb0">
                                                            <div class="col-md-12">
                                                                <button type="button" class="btn btn-info testEmail" id="validateSmtpNode">Validate</button>
                                                                <div><small>{{trans('sending_nodes.validate_node')}} <b>{{$authUser->email}}</b></small></div>
                                                                <div id="authUser" style="display: none;">
                                                                    <span>
                                                                        <i class="fa fa-spinner fa-spin fa-lg"></i> 
                                                                        {{trans('sending_nodes.validating_node')}}
                                                                    </span>
                                                                </div>
                                                                <div id="validate-mail-sent-msg"></div>
                                                                <div class="kt-heading kt-heading--md">
                                                                    {{trans('sending_nodes.add_new.settings_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.settings_tab.form.description')}} <br />
                                                                <small>{{trans('sending_nodes.add_new.settings_tab.form.note')}}</small>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div id="kt_repeater_3" >
                                                            <div class="form-group row mb0">
                                                                <label class="col-form-label col-md-12 pl12">
                                                                    {{trans('sending_nodes.add_new.form.additional_headers')}}
                                                                    {!! popover('sending_nodes.add_new.form.additional_headers_help','common.description') !!}
                                                                </label>
                                                                <div class="col-md-12" data-repeater-list="subscriber_filter">
                                                                    @if(isset($additional_headers) && is_array($additional_headers))
                                                                    <div class="mt-repeater" style="display: none;" >
                                                                        <div data-repeater-item >
                                                                            @foreach($additional_headers as $key => $value)
                                                                                <div data-repeater-item class="mt-repeater-item" >
                                                                                    <div class="row mt-repeater-row">
                                                                                        <div class="col-md-6">
                                                                                            <input type="text" name="header" placeholder="Header" class="form-control" value="{{ isset($value->header) ? $value->header : '' }}">
                                                                                            <span class="clnfld">:</span>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <input type="text" name="header_value" placeholder="Value" class="form-control" value="{{ isset($value->header_value) ? $value->header_value : ''  }}">
                                                                                        </div>
                                                                                        <div class="col-md-1">
                                                                                            <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <div class="mt-repeater" style="display: none;">
                                                                        <div data-repeater-item="" class="mt-repeater-item">
                                                                            <div class="row mt-repeater-row">
                                                                                <div class="col-md-6">
                                                                                    <input type="text" name="header" placeholder="Header" class="form-control" value="">
                                                                                    <span class="clnfld">:</span>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <input type="text" name="header_value" placeholder="Value" class="form-control" value="">
                                                                                </div>
                                                                                <div class="col-md-1">
                                                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    <a href="javascript:;" class="btn btn btn-info btn-xs new-btn">
                                                                        {{ trans('common.form.buttons.add_new') }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="btn-new">
                                                                <div class="col">
                                                                    <div data-repeater-create="" class="btn btn btn-info btn-sm">
                                                                        <span>
                                                                            <i class="la la-plus"></i>
                                                                            <span>{{ trans('common.form.buttons.add_new') }}</span>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>
                                                </div>
                                        </div>

                                        <div class="row block-action" >
                                            <div class="col">
                                                <div  class="btn btn btn-success sb btn-set" id="save_new">
                                                    <span>
                                                        <span>{{ trans('common.form.buttons.save_add') }}</span>
                                                    </span>
                                                </div>
                                                <div  class="btn btn btn-success sb btn-set" id="exit" >
                                                    <span>
                                                        <span>{{ trans('common.form.buttons.save_exit') }}</span>
                                                    </span>
                                                </div>
                                                <div  class="btn btn btn-success sb btn-set" id="edit" >
                                                    <span>
                                                        <span>{{ trans('common.form.buttons.save_and_keep_editing') }}</span>
                                                    </span>
                                                </div>
                                                <div  class="btn btn btn-secondary cancel" id="cncl">
                                                    <span>
                                                        <span>{{ trans('common.form.buttons.cancel') }}</span>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="row">
    <div class="col-md-6 create-form" id="testmail" >
        <div class="kt-content ">
            <div class="kt-portlet kt-portlet--height-fluid">
                <div class="kt-portlet__head">
                    <div class="kt-portlet__head-label">
                        <h3 class="kt-portlet__head-title">
                            {{trans('sending_nodes.test_email.form.heading')}}
                        </h3>
                    </div>
                </div>
                <!-- BEGIN FORM-->
                <div class="kt-portlet__body">
                    <form action="" method="POST" id="smtp-validation-frm" class="kt-form kt-form--label-right">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-form-label col-md-12">{{trans('sending_nodes.test_email.form.heading')}}
                                    </label>
                                    <div class="col-md-12">
                                        <div class="input-icon right">
                                            <input type="email" placeholder="{{trans('common.label.email_address')}}" name="smtp_email" id="smtp_email" class="form-control" value="" />
                                            <small id="email-error" class="error invalid-feedback">{{trans('sending_nodes.add_node_blade.email_required_small_text')}}</small>
                                            <div id="mail-sent-msg" style="display:none"></div>
                                        </div>
                                    </div>
                                </div>
                                @if(isset($smtp) && in_array($smtp->type,smtps()))
                                    <div class="form-group row">
                                        <div class="col-md-12">
                                            <div class="input-icon right">
                                                <input type="checkbox" id="php_mailer" name="php_mailer" value="1"> {{trans('sending_nodes.add_node_blade.debug_log_input')}} 
                                                <span></span>
                                            </div>
                                            <span id="modal_span"  style="display: none;"><a onclick="showModalLog()" href="javascript:;" class="btn btn-info btn-xs">
                                            {{trans('sending_nodes.test_email.form.debug_log')}} </a></span>
                                            <div id="mail-sent-log" style="display: none;"></div>
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group row">
                                    <div class="col-md-12">
                                        <button type="button" class="btn btn-success testEmail" id="send-test-mail">{{trans('sending_nodes.test_email.form.heading')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>
    
<!--
-->
<div id="modal-group-label" class="modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('common.label.add_new_group')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body">
                <div id="msg-group" class="display-hide alert alert-success text-left">
                    <span id='msg-text-group' class="text-left alert-text"></span>
                </div>
                <br>
                <form action="" id="frm-group" method="post" class="form-horizontal ">
                    @for ($i = 1; $i < 2; $i++)
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-md-3 col-form-label" >{{trans('common.label.group_name')}}</label>

                                <div class="col-md-8">
                                    <input type="text"  name="name[]" class="form-control"  {{ ($i == 1) ? 'required' : '' }} >
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="form-actions col-md-12">
                        <div class="row">
                            <label class="col-md-3 col-form-label" ></label>
                            <div class="col-md-9">
                                <button type="submit" class="btn btn-success ml8">{{trans('common.form.buttons.submit')}}</button>
                                <button type="reset" class="btn btn-default">{{trans('common.form.buttons.reset')}}</button>
                                <input type="hidden" value="2" name="section_id">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="debug_output" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">@lang('sending_nodes.debug_log')</h5>
            </div>
            <div class="modal-body">
                <a href="javascript:;" id="copydbug" onclick="copy_user(msg_body)" class=""><i class="la la-copy"></i> {{trans('sending_nodes.add_node_blade.copy_txt_action')}} </a>
                <p id="msg_body"></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm" data-dismiss="modal">{{trans('common.form.buttons.close')}}</button>
            </div>
        </div>
    </div>
</div>

@endsection