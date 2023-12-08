@extends(decide_template())
@section('title', $page_data['title'])



<?php 
//************************************************** */
    try { 
      
        $restrictions = json_decode($restrictions, true);
      
        $dkim_restriction = "";
        $tracking_restriction = "";
        $bounce_restriction = "";
        $license_type = '';
        $license_attributes = json_decode(getSetting('license_attributes'), true);
        if (! empty($license_attributes['package'])) {
            $license_type = trim($license_attributes['package']);
        }
        if (count($restrictions) > 0 and $license_type == 'Commercial ESP') {
            $dkim_restriction = $restrictions["dkim_restriction"];
            $tracking_restriction = $restrictions["tracking_restriction"];
            $bounce_restriction = $restrictions["bounce_restriction"];
        }

        
    } catch(\Exception $e) { 
        $dkim_restriction = "";
        $tracking_restriction = "";
        $bounce_restriction = "";
    }
  //************************************************** */
?>

@section('page_styles')
<link href="/resources/assets/css/domain-masking-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
.heading-toggles>label {
    margin-bottom: 0;
    vertical-align: middle;
}
.secure-lock-blk {
    display: inline-block;
    vertical-align: middle;
    margin-right: 10px;
    margin-top: -4px;
}
.popover-body {
    text-align: center !important;
}
span.lock-spinner {
    display: block;
    vertical-align: middle;
}
.secure-lock-blk i.fa {
    font-size: 20px;
    vertical-align: middle;
}
.secure-lock-blk .lock-danger, .secure-lock-blk .lock-success {
    display: none;
    vertical-align: middle;
}
.secure-lock-blk .lock-danger img, .secure-lock-blk .lock-success img {
    vertical-align: middle;
    width: 26px;
    height: 26px;
}
table a.btn.btn-cancel {
    border: 0 !important;
    padding: 0 !important;
    margin-top: 1px !important;
    background: 0 0;
    cursor: pointer;
    display:none;
}
table a.btn.btn-cancel i.la.la-times.text-danger.subcancel {
    color: #fd397a !important;
}
.btn.btn-copy {
    min-width: 20px !important;
}
#dkim::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
#dkim::-webkit-scrollbar-button {
    display: none;
}
#dkim::-webkit-scrollbar-thumb {
    background: #bcbcbc;
    border-radius: 0px;
}
#dkim::-webkit-scrollbar-track {
    box-shadow: inset 0 0 5px #cccccc;
    border-radius: 0px;
    background: #eaeaea;
}
</style>
@endsection

@section('page_scripts')
<?php $imap_switch = getSetting("imap_switch"); ?>
    <script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
    <script src="/themes/default/js/init.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript"></script>
    <script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
    <script src="{{asset('themes/default/js/includes/validate-form.js')}}" type="text/javascript"></script>
    <script> var form_error="{{trans('common.message.form_error')}}"; </script>
    <script src="/themes/default/js/includes/domain_masking.js" type="text/javascript"></script>

    <script src="/themes/default/js/jquery.plugin.min.js"></script>
    <script src="/themes/default/js/jquery.countdown.js"></script>
    <script>



        var token = "{{ csrf_token() }}";
        function changeDkimStatus(dkim_status){

            $.ajax({
                url: "{{ URL::route('change.dkim.status') }}",
                type: 'POST',
                dataType:"json",
                data: {domain_id: $("#domain_db_id").val(), '_token': token,'dkim_status':dkim_status},
                success: function (data) {
                    $(".blockUI").hide(); 
                    if(data.status=='success'){
                        if(dkim_status==0){
                            //generateDKIM();
                            // Command: toastr["success"] ("Enabled DKIM");
                            $("#dkimswt2").attr('onchange','changeDkimStatus(1)');

                        }else{
                            //Command: toastr["error"] ("Disabled DKIM");
                            $("#dkimswt2").attr('onchange','changeDkimStatus(0)');
                            //show
                        }
                    }

                }
            });
        }

        $(document).ready(function() {
            var url = "{{isset($domain_masking->domain) ? $domain_masking->tracking_domain . '.' . $domain_masking->domain : ''}}";
            var form_data = {
                url
            };
            $.ajax({
                method:"POST",
                url:"{{url('checkDomainSsl?t=' . rand(000,1111))}}",
                data:form_data,
                success: function (result) {
                    $(".lock-spinner").hide();
                    $("#lockDanger").val(0);
                    var obj = JSON.parse(result)
                    if(obj["status"] == "fopen") {
                        $(".lock-success").show();
                        $(".lock-success").attr("data-content" , obj["erorr"]);
                        $(".successImage").attr("src" , "/public/img/icon/warning.png");
                       
                    } else if(obj["status"] == true) { 
                        $(".lock-success").show();
                        $(".lock-success").attr("data-content" , "Valid SSL Detected: Expires on " + obj["valid_to"]);

                    } else { 
                        $(".lock-danger").show();
                        $("#lockDanger").val(1);
                    }
                }
            });

            $('#domain').keypress();

            $('#domain').on('paste', function () {
                setTimeout(function () {
                    var $this = $('#domain').val();
                    // console.log($this);         
                    setTimeout(function() {
                        $('#domain').val("");
                        $('#domain').val($this);
                        $('#domain').keypress();
                        $('.form-body').keypress();
                        // console.log("Domain Name: "+$this);
                    }, 10);       
                }, 10);
            });

            $("input#dkimswt").collapse("hide");
            

            $("#dkimswt").click(function () {
                $("#processBtn1").html("{{trans('sending_domains.edit.page.generate_keys')}}");
                $("#processDesc").html("{{trans('sending_domains.edit.page.dkim_info')}}");
                $("#proccess").modal('show');
            });
            $( ".regenrate_dkimswt").click(function () {
                $("#processBtn1").html("{{trans('sending_domains.edit.page.regenerate_keys')}}");
                $("#processDesc").html("{{trans('sending_domains.message.regenerate_keys')}}");
                $("#proccess").modal('show');
            });
            $("#switchRow .bootstrap-switch-id-dkimswt .bootstrap-switch-label, #switchRow .bootstrap-switch-id-dkimswt .bootstrap-switch-handle-on").click(function () {
                //$("#proccess2").modal('show');
                $("hr.swroll").show();
                $(".switchMsg").show();
                $("#dkim").hide();
            });

            $("#dkimswt2").click(function () { 
                $(".blockUI").show();
                setTimeout(function () {
                    $(".blockUI").hide();
                },1000);
                if($(this).is(":checked")) { 
                    $("#dkim").show();
                } else { 
                    $("#dkim").hide();
                }
                // $(".switchMsg").toggle();
                $("hr.swroll").toggle();
                // $("#dkim").toggle();
               
            });
            $("#switchRow .bootstrap-switch-id-dkimswt2 .bootstrap-switch-default").click(function () {
                $('input#dkimswt2').is('checked', true);// ON!
                $(".switchMsg").hide();
                $("hr.swroll").hide();
                $("#dkim").show();
            });
            $("#switchRow .bootstrap-switch-id-dkimswt2 .bootstrap-switch-handle-on").click(function () {
                $("hr.swroll").show();
                $(".switchMsg").show();
                $("#dkim").hide();
            });


            $("#processBtn1").click(function() {
                setTimeout(function(){
                    // $('input#dkimswt').prop('checked', true);// ON!
                    $(".switchMsg").hide();
                    $("hr.swroll").hide();
                    $("#dkim").slideDown();
                    $("#dkimswt").hide();
                    $("#dkimswt2").css("display", "inline-block");
                    $("#proccess").modal('hide');
                    $(".blockUI").hide();
                }, 3000);
                $.ajax({
                    url: "{{ URL::route('save.domain.keys') }}",
                    type: 'POST',
                    dataType:"json",
                    data: {domain_id: $("#domain_db_id").val(), '_token': token,'type':$('input[name=type]:checked').val()},
                    beforeSend: function () {
                        $(".blockUI").show();
                    },
                    complete: function () {
                        $(".blockUI").hide();
                    },
                    success: function (data) {
                        if(data.status=='success'){
                            location.reload();
                            $('input#dkimswt').prop('checked', true);// ON!
                            $(".switchMsg").hide();
                            $("hr.swroll").hide();
                            $("#dkim").slideDown();
                            $("#dkimswt").hide();
                            $("#dkimswt2").css("display", "inline-block");
                            $("#proccess").modal('hide');

                        }else{
                            alert("{{trans('sending_domains.message.problem_generate_key')}}')}}");
                        }
                    }
                });
            });
            $("#processBtn2").click(function() {
                $(".blockUI").show();
                setTimeout(function(){
                    $('input#dkimswt').prop('checked', false);// OFF!
                    $(".switchMsg").show();
                    $("hr.swroll").show();
                    $("#dkim").slideUp();
                    $("#proccess2").modal('hide');
                    $(".blockUI").hide();
                }, 3000);
            });
            $("#cancel1").click(function() {
                $('input#dkimswt').prop('checked', false);// OFF!
            });
            $("#cancel2").click(function() {
                $('input#dkimswt').prop('checked', true);// ON!
            });
        });

        // $('#generate-dkim').click(function() {
        function generateDKIM() {
            var domain = $('#domain').val();
            if (domain == '') {
                alert("{{trans('sending_domains.message.alert')}}");
                return;
            }
            $.ajax({
                url: "{{ URL::route('domain.generate.dkim') }}",
                type: 'POST',
                data: {key: 'dkim', domain: domain},
                success: function (data) {
                    //console.log(data);
                    $('#public_key').val(data.public_key);
                    $('#private_key').val(data.private_key);

                    if (data.private_key != 'No key found') {
                        $('#public_key').prop('readonly',true);
                    }

                    if (data.private_key != 'No key found') {
                        $('#private_key').prop('readonly',true);
                    }
                    $('#modal-dkim').show();
                }
            });
        }

        $('#generate-spf').click(function() {
            var domain = $('#domain').val();
            if (domain == '') {
                alert("{{trans('sending_domains.message.alert')}}");
                return;
            }
            $.ajax({
                url: "{{ URL::route('domain.generate.spf') }}",
                type: 'POST',
                data: {key: 'spf', domain: domain},
                success: function (data) {
                   //  console.log(data);
                    $('#spf').val(data);
                    $('#modal-spf').show();
                }
            });
        });

        $('#btn_verify_domain').click(function() {
            $(".blockUI").show();
            $.ajax({
                url: "{{ URL::route('is.verified.domain') }}",
                type: 'POST',
                dataType:"json",
                data: {domain_db_id: $("#domain_db_id").val(), '_token': token,'verify_method':$('input[name=verify_method]:checked').val()},
                success: function (data) {
                    $(".blockUI").hide();
                    if(data.status=='success'){
                        Command: toastr["success"] ("{{trans('sending_domains.domain_verified')}}");

                        location.reload();
                    }else{
                        Command: toastr["error"] (data.message);
                    }
                }
            });
        });


        $('#confirm').click(function() {
            $(".loader2").css("display", "inline-block");
            var type = "cname";
            if($("#htaccess").is(":checked")) { 
                type = "htaccess";
            }
            if($("#index").is(":checked")) { 
                type = "index";
            }
            var type = $('input[name=type]:checked').val();
            var domain = $('#domain').val();
            $('#confirm').attr('disabled', 'disabled');
            var track_domain = $(".domaintrack").find(".subdomain").last().html() + '.' +$('#domain').val();
            $.ajax({
                url: "{{ URL::route('domain.generate.vtd') }}",
                type: 'POST',
                data: {key: 'verify-track-domain', domain: domain, track_domain: track_domain, type: type},
                success: function (data) {
                    //console.log(data);
                    if(data == 'available') {
                        $('#confirm').removeAttr('disabled');
                        $('#verify-masking-htaccess').css("display", "inline");
                        $('#verify-masking-htaccess').html('<i class="la la-check text-success"></i>');
                        $('#verify-masking-cname').css("display", "inline-block");
                        $('#verify-masking-cname').html('<i class="la la-check text-success"></i>');
                        $(".loader2").hide();
                        $('.checked2').hide();
                        $('#confirm').hide();
                    } else {
                        $('#confirm').removeAttr('disabled');
                        $('#verify-masking-cname').css("display", "inline-block");
                        $('#verify-masking-cname').html('<i class="la la-close text-danger"></i>');
                        $('#verify-masking-htaccess').css("display", "inline");
                        $('#verify-masking-htaccess').html('<i class="la la-close text-danger"></i>');
                        $(".loader2").hide();
                        $('.checked2').hide();
                        Command: toastr["error"] ("@lang('sending_domains.message.alert_confirmation')");
                    }
                }
            });
        });

        $('#dnscheck').click(function() {
            $(".loader1").css("display", "inline-block");
            var domain = $('#domain').val();
            var dns_domain = $(".domaintrack").find(".subdomain").first().html() + '._domainkey.' +$('#domain').val();

            $.ajax({
                url: "{{ URL::route('domain.generate.dns') }}",
                type: 'POST',
                data: {key: 'verify-dns', domain: domain, dns_domain: dns_domain},
                success: function (data) {
                    // console.log(data);
                    if(data == 'available') {
                        $('#verify-dns').css("display", "inline-block");
                        $('#verify-dns').html('<i class="la la-check text-success"></i>');
                        $(".loader1").hide();
                        $('.checked1').hide();
                        $('#confirm').hide();
                    } else {
                        $(".loader1").hide();
                        $('#verify-dns').css("display", "inline-block");
                        $('#verify-dns').html('<i class="la la-close text-danger"></i>');
                        $('.checked1').hide();
                        //Command: toastr["error"] ("Confirmation failed.");
                    }
                }
            });
        });

        function verifyDNS() {

            $(".loader1").css("display", "inline-block");
            var main_domain = $('#domain').val();
            var domain = $(".domaintrack").find(".subdomain").last().html()+'.'+$('#domain').val();
            var dns_domain = $(".domaintrack").find(".subdomain").first().html() + '._domainkey.' +$('#domain').val();

            $.ajax({
                url: "{{ URL::route('domain.generate.dns') }}",
                type: 'POST',
                data: {key: 'verify-dns', domain: domain, main_domain: main_domain, dns_domain: dns_domain},
                success: function (data) {
                    if(data == 'available') {
                        //$("#confirm_b").hide();
                        $('#verify-dns').css("display", "inline-block");
                        $('#verify-dns').html('<i class="la la-check text-success tooltips" data-original-title="{{trans('sending_domains.dkim_verified')}}"></i>');
                        $(".loader1").hide();
                        $('.checked1').hide();
                        $('#confirm').hide();
                    } else {
                        //$("#confirm_b").show();
                        $(".loader1").hide();
                        $('#verify-dns').css("display", "inline-block");
                        $('#verify-dns').html('<i class="la la-close text-danger tooltips" data-original-title="{{trans('sending_domains.dkim_failed')}}"></i>');
                        $('.checked1').hide();
                        //Command: toastr["error"] ("Confirmation failed.");
                    }
                    setTimeout(() => {
                        //location.reload();
                    }, 3000);
                }
            });

        }
        
        function disabelBtn(btn) { 
                <?php
                $default_recheck_domain = getSetting('default_recheck_domain');
                ?>

               
            var time='+{{ $default_recheck_domain ? $default_recheck_domain:5}}m +0s';
           
            var old_time=sessionStorage.getItem('time{{isset($domain_masking)?$domain_masking->id: ""}}') || '';
            if(old_time){  
                time=old_time;
            }
          
            if(btn && time !="+0m +0s") {  
               
                $('#'+btn).prop('disabled', true);
                $('#timer_parent').show();
                $('#timer').countdown({until: time ,format: 'MS',significant: 2, layout: '{d<}{dn} {dl} {d>}{h<}{hn} {hl} {h>}{m<}{mn} {ml} {m>}{s<}{sn} {sl}{s>}',onExpiry: liftOff, onTick: watchCountdowns});
            }
        }
        function liftOff() { 
                sessionStorage.removeItem('time{{isset($domain_masking)?$domain_masking->id: ""}}'); 
                $('#recheck').prop('disabled', false);
                $('#timer_parent').hide();
                //location.reload();
            } 
 
function watchCountdowns(periods) { 
    sessionStorage.setItem('time{{isset($domain_masking)?$domain_masking->id: ""}}', `+${periods[5]}m +${periods[6]}s`);
}   
        
        var old_time=sessionStorage.getItem('time{{isset($domain_masking)?$domain_masking->id: ""}}') || '';
        if(old_time){
                disabelBtn('recheck');
            }

        function verifyTrackDomain(btn='') {

            $(".loader2").css("display", "inline-block");
            var type = "cname";
            if($("#htaccess").is(":checked")) { 
                type = "htaccess";
            }
            if($("#index").is(":checked")) { 
                type = "index";
            }
            var domain = $('#domain').val();
            //$('#confirm_b').attr('disabled', 'disabled');
            var track_domain = $(".domaintrack").find(".subdomain").last().html() + '.' +$('#domain').val();
            $.ajax({
                url: "{{ URL::route('domain.generate.vtd') }}",
                type: 'POST',
                data: {key: 'verify-track-domain', domain: domain, track_domain: track_domain, type: type},
                success: function (data) {
                    if(btn)
                    disabelBtn(btn);

                    if(data == 'available') {
                        $('#confirm_b').hide();
                        $('#confirm').removeAttr('disabled');
                        $('#verify-masking-htaccess').css("display", "inline");
                        $('#verify-masking-htaccess').html('<i class="la la-check text-success tooltips" data-original-title="{{trans('sending_domains.tracking_domain_verified')}}"></i>');
                        $('#verify-masking-cname').css("display", "inline-block");
                        $('#verify-masking-cname').html('<i class="la la-check text-success tooltips" data-original-title="{{trans('sending_domains.tracking_domain_verified')}}"></i>');
                        $(".loader2").hide();
                        $('.checked2').hide();
                        $('#confirm').hide();
                    } else {
                        //    $('#confirm_b').removeAttr('disabled');
                        $('#confirm_b').show();
                        $('#verify-masking-cname').css("display", "inline-block");
                        $('#verify-masking-cname').html('<i class="la la-close text-danger tooltips" data-original-title="{{trans('sending_domains.tracking_domain_failed')}}"></i>');
                        $('#verify-masking-htaccess').css("display", "inline");
                        $('#verify-masking-htaccess').html('<i class="la la-close text-danger tooltips" data-original-title="{{trans('sending_domains.tracking_domain_failed')}}"></i>');
                        $(".loader2").hide();
                        $('.checked2').hide();
                        Command: toastr["error"] ("{{trans('sending_domains.message.alert_confirmation')}}");
                       
                    }

                    if(!$("#dkimswt2").is(":checked")) { 
                        setTimeout(() => {
                            //location.reload();
                        }, 3000);
                    }
                }
            });
        }

        // function checkDomain(button='') {

        //     $('#confirm_b').hide();
        //     $('#recheck').html("Checking");
        //     $('#recheck').prop("disabled" , true);
        //     verifyTrackDomain(button);
        //     //if($(""))/dkimswt2
        //     if($("#dkimswt2").is(":checked")) { 
        //         verifyDNS(); 
        //     }
        // }

        // function checkDomain() {
        //     $('.loadg').show();
        //     $('.icock').hide();
        //     $('.la-check').hide();
        //     $('.la-close').hide();
        //     $('#spf_q').hide();
        //     $('#spf_q2').hide();
        //     $('#load_').show();
        //     $('#confirm_b').hide();
        //     $('#recheck').html("Checking");
        //     $('#recheck').prop("disabled" , true);
        //     if($("#custom_tr_domain").is(":checked"))
        //         verifyTrackDomain();
        //     //if($(""))/dkimswt2
        //     if($("#dkimswt2").is(":checked"))
        //         verifyDNS();

        //     if($("#spf_switch").is(":checked"))
        //         verifySpf($("#domain_db_id").val(),true);


        //     //location.reload();
        

        // }


        function confirmClicked(status) {
            $.ajax({
                url: "{{ URL::route('confirm.clicked') }}",
                type: 'POST',
                dataType:"json",
                data: {domain_id: $("#domain_db_id").val(), '_token': token,'status':status},

                success: function (data) {
                    if(data.status=='success'){
                        if(status==1){
                            $("#confirm_b").hide();
                            //location.reload();
                        }  else {
                            $("#confirm_b").show();
                            return false;
                        }
                    }
                }
            });
        }

        function copy_domain(containerid) {
        var range = document.createRange();
        range.selectNode(containerid); //changed here
        window.getSelection().removeAllRanges(); 
        window.getSelection().addRange(range); 
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        Command: toastr["success"] ("{{trans('common.message.success_copied')}}");
    }

        function copyFunction() { 
            var copyText = document.getElementById("cnamecopy2");
            var textArea = document.createElement("textarea")
            textArea.value = copyText.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy",false);
            // console.log("Copied the text: " + textArea.html);
            Command: toastr["success"] ("{{trans('common.message.success_copied')}}");
        }
        function copyFunction2() {
            var copyText = document.getElementById("cnamecopy");
            var textArea = document.createElement("textarea")
            textArea.value = copyText.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy",false);
            Command: toastr["success"] ("{{trans('common.message.success_copied')}}");
        }

        function copyFunction3() {
            var copyText = document.getElementById("optkey2");
            var textArea = document.createElement("textarea")
            textArea.value = copyText.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy",false);
            // console.log("Copied the text: " + textArea.html);
            Command: toastr["success"] ("{{trans('common.message.success_copied')}}");
        }


        function copyFunction4() {
            var copyText = document.getElementById("optkey4");
            var textArea = document.createElement("textarea")
            textArea.value = copyText.textContent;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand("copy",false);
           //  console.log("Copied the text: " + textArea.html);
            Command: toastr["success"] ("{{trans('common.message.success_copied')}}");
        }


        $(document).ready(function() {
            $(".btn-edit").click(function() {
                $(this).closest(".option").find(".btn-save").css("display", "inline-block");
                $(this).closest(".option").find(".btn-cancel").css("display", "inline-block");
                $(this).closest(".option").find("input.track").css("display", "inline-block");
                $(this).closest(".option").find("input.track").focus();
                $(this).closest(".option").find(".subdomain").hide();
                $(this).closest(".option").find(".btn-edit").hide();
                $(this).closest(".option").find("input.track").val($(this).closest(".option").find(".subdomain").html());

            });

            $(".btn-cancel").click(function() {
                $(this).closest(".option").find(".btn-cancel").hide();
                $(this).closest(".option").find(".btn-save").hide();
                $(this).closest(".option").find(".btn-cancel").hide();
                $(this).closest(".option").find("input.track").hide();
                $(this).closest(".option").find("input.track").show();
                $(this).closest(".option").find(".subdomain").show();
                $(this).closest(".option").find(".track").hide();
                $(this).closest(".option").find(".btn-edit").css("display", "inline-block");

            });

            $(".btn-save").click(function() {
                $(this).closest(".option").find(".btn-save").hide();
                $(this).closest(".option").find("input.track").hide();
                $(this).closest(".option").find(".btn-cancel").hide();
                $(this).closest(".option").find(".subdomain").show();
                $(this).closest(".option").find(".btn-edit").css("display", "inline-block");
                $(this).closest(".option").find(".chck").css("display", "inline-block");
                $(this).closest(".option").find(".icock").hide();
                $(this).closest(".option").find(".subdomain").html($(this).closest(".option").find("input.track").val());

                var selector = $(this).closest(".option").find("input.track").attr('id');
                var domain = $('#domain').val();
                var val = $(this).closest(".option").find("input.track").val();
                $.ajax({
                    url: "{{ URL::route('domain.generate.keys') }}",
                    type: 'POST',
                    data: {key: 'selector', selector: selector, domain: domain, val: val},
                    success: function (data) {
                        $("#recheckFlag").val(1);
                        recheckFunction();
                    }
                });
            });

           $(function() { 
                    $("#htacs").hide();
                    $("#indexphp").hide();
               <?php if(empty($domain_masking) or (!empty($domain_masking) and $domain_masking->type == "cname" and $domain_masking->tracking_status == "Active")) { ?>
                        $(".contentBlk2").hide();
                        $(".contentBlkIndex").hide();
                        $("#htacs").hide();
                        $("#indexphp").hide();
                        $(".contentBlk1").show();
                        $("#indexphp").css("display", "none");  
                        $("#cnm").css("display", "inline-table");  
                        $(".not-resolved").show();
                       
                <?php } ?>
               <?php if(!empty($domain_masking) and  $domain_masking->type == "htaccess" and $domain_masking->tracking_status == "Active") { ?>
                        $(".contentBlk1").hide();
                        $(".contentBlkIndex").hide();
                        $("#cnm").hide();
                        $("#indexphp").hide();
                        $(".contentBlk2").show();
                        $(".not-resolved").hide();
                        $("#htacs").css("display", "inline-table"); 
                <?php } ?>
                <?php if(!empty($domain_masking) and $domain_masking->type == "index" and $domain_masking->tracking_status == "Active") { ?>
                        $(".contentBlk2").hide();
                        $(".contentBlk1").hide();
                        $("#htacs").hide();
                        $("#cnm").hide();
                        $(".contentBlkIndex").show();
                        $(".not-resolved").hide();
                        $("#indexphp").css("display", "inline-table");  
                <?php } ?>
           });

            $(".verify_type").change(function() {
               
                $(".blockUI").show();
                $.ajax({
                    url: "{{ route('domain_change_type') }}",
                    type: 'POST',
                    data: { type: this.value,id:{{ !empty($domain_masking->id) ? $domain_masking->id:0}} },
                    context:this,
                    success: function (result) {
                        if(this.value=="cname"){
                              $(".contentBlk2").hide();
                              $(".contentBlkIndex").hide();
                              $("#htacs").hide();
                              $("#indexphp").hide();
                              $(".contentBlk1").show();
                              $("#cnm").css("display", "inline-table");  
                              $(".not-resolved").show();
                        } else if(this.value=="index"){
                              $(".contentBlk2").hide();
                              $(".contentBlk1").hide();
                              $("#htacs").hide();
                              $("#cnm").hide();
                              $(".contentBlkIndex").show();
                              $(".not-resolved").hide();
                              $("#indexphp").css("display", "inline-table");  
                        } else{ 
                              $(".contentBlk1").hide();
                              $(".contentBlkIndex").hide();
                              $("#cnm").hide();
                              $("#indexphp").hide();
                              $(".contentBlk2").show();
                              $(".not-resolved").hide();
                              $("#htacs").css("display", "inline-table");  
                        }
                        $("#recheckFlag").val(1);
                        recheckFunction();
                        $(".blockUI").hide();
                    }
                });
                
                
            });

            $(".acclbl2 input").change(function() {
                if(this.value=="dnc"){
                   $(".meth1").hide();
                   $(".meth2").show();
                }else{
                   $(".meth2").hide();
                   $(".meth1").show(); 
                }
                // alert(this.value);

            });
            
            $(".acclbl2 input:checked").change();
        });
        $(".verify_type").change();
       

        @if ($page_data['action'] != 'add')
        $("#https").click(function() {
            checked = 0;
            if($('#https').is(':checked'))
                checked = 1;


            var lockDanger = $("#lockDanger").val();
            if(checked && lockDanger) { 
                $(".ssl-error-blk").show();
            } else {  
                $(".ssl-error-blk").hide();
            }
            $.ajax({
                url: "{{ route('updateDomain', isset($domain_masking)?$domain_masking->id: "") }}",
                type: 'PUT',
                dataType:"json",
                data: {'_token': token,'is_ssl_enabled':checked},
                beforeSend: function(){
                    $(".blockUI").show();
                },
                success: function (data) {
                    $(".blockUI").hide();
                    
                    updateTrackingStatus()
                    setTimeout(function() {
                        location.reload();
                    }, 2000)
                    if(data.status){

                    }
                    else
                        Command: toastr["error"] ('{{trans('common.message.opps')}}');

                }
            });
        });
        $("#domain_status").click(function() {
            checked = 0;
            if($('#domain_status').is(':checked'))
                checked = 1;
            $.ajax({
                url: "{{ route('updateDomain', isset($domain_masking)?$domain_masking->id: "") }}",
                type: 'PUT',
                dataType:"json",
                data: {'_token': token,'domain_status':checked , "type":"domain_status"},
                beforeSend: function(){
                    $(".blockUI").show();
                },
                success: function (data) {
                    $(".blockUI").hide();
                    updateTrackingStatus()
                    if(data.status){
                        Command: toastr["success"] ('@lang("sending_domains.message.successfully_updated")');
                    }
                    else
                        Command: toastr["error"] ('{{trans('common.message.opps')}}');

                }
            });
        });

        @endif


        $("#bounceChange").click(function() {
            var bounceval = $("#change-bounce").val();
            $("#change-bounce").css("display", "inline-block");
            $("#bounce-dmn").hide();
            $(this).hide();
            $("#bounceSave").css("display", "inline-block");
            $("#bounceCancel").css("display", "inline-block");
        });

        $("a.btn-cancel").click(function() {
            $(this).hide();
            $("#bounceSave").hide();
            $("#change-bounce").hide();
            $("#bounce-dmn").show();
            $("#bounceChange").show();
        });


        @if ($page_data['action'] != 'add')

        $("#bounceSave").click(function() { 
                var bounceval = $("#change-bounce").val();
                $.ajax({
                    url: "{{ route('updateDomain',['id' => isset($domain_masking)?$domain_masking->id: null]) }}",
                    type: 'PUT',
                    dataType:"json",
                    data: {'_token': token,'bounce_selector':bounceval},
                    beforeSend: function(){
                        $("#bounce-dmn").show();
                        $("#bounce-dmn").html(bounceval);
                        $(".bounce_selector").html(bounceval);
                        $("#bounceCancel").hide();
                        $("#spf_q").hide();
                        $("#spf_fail").hide();
                        $("#spf_pass").hide();
                        $("#spf_reload").css("display", "none");
                        $("#spf_q2").hide();
                        $("#spf_fail2").hide();
                        $("#spf_pass2").hide();
                        $("#bounceCancel").css("display", "none");
                        $("#change-bounce").hide();
                        $("#spf_reload2").css("display", "none");
                        $("#bounceSave").hide()
                        $("#bounceChange").show();

                       

                    },
                    success: function (data) {
                        if(data.status){
                            //location.reload();
                            $("#recheckFlag").val(1);
                            recheckFunction();
                            updateTrackingStatus();
                        }
                        

                    }
                });
            });

            @endif


    // function changeStatus(id , status) { 
    //     if($("#custom_tr_domain").is(":checked")) {
    //         $(".customTrackingDomainClass").show();
    //         $(".contentBlk1").hide();
    //         $(".contentBlk2").hide();
    //         $(".contentBlkIndex").hide();
    //         $("#indexphp").hide();
    //         if($("#cname").is(":checked")) { 
    //             $(".contentBlk1").show();
    //         }
    //         if($("#htaccess").is(":checked")) {
    //             $(".contentBlk2").show();
    //         }
    //         if($("#index").is(":checked")) {
    //             $(".contentBlkIndex").show();
    //         }
    //     } else { 
    //         alert("hello");
    //         $(".customTrackingDomainClass").hide();
    //     }
    //     $(".blockUI").show();

    //     $.ajax({
    //              url: "{{ URL::route('change.dkim.status') }}",
    //              type: 'POST',
    //              dataType:"json",
    //              data: {domain_id: $("#domain_db_id").val(), '_token': token, 'field': id, 'value':value},
    //              success: function (data) {
    //                 $(".blockUI").hide(); 
    //              }
    //          });

    //     // $.ajax({
    //     //     url: "{{ url('domain/get_tracking_status') }}",
    //     //     type: 'POST',
    //     //     data: {id: id, status: status},
    //     //     success: function (result) {
    //     //         $(".blockUI").hide(); 
    //     //         Command: toastr["success"] ('@lang("sending_domains.message.successfully_updated")');
    //     //     }
    //     // });
    // }




    var verify_spf = 0;
        function verifySpf(domain_id,make_active=false){
            $.ajax({
                url: "{{ URL::route('verify.spf.domain') }}",
                type: 'POST',
                dataType:"json",
                data: {'domain_id': domain_id, '_token': token,'active':make_active},
                beforeSend: function () {
                    $("#spf_reload").css("display", "inline");
                },
                complete: function () {
                    $("#spf_reload").hide();
                },
                success: function (data) {
                    //location.reload();
                    // if(data.status=='success'){
                    //     if(data.is_confirm_spf==0){
                    //         $('#spf_q').hide();
                    //         $('#spf_q2').hide();
                    //         $('#spf_fail').show();
                    //         $('#spf_fail2').show();
                    //     }else{

                    //         $('#spf_q').hide();
                    //         $('#spf_q2').hide();
                    //         $('#spf_pass').show();
                    //         $('#spf_pass2').show();

                    //     }
                    // }
                }
            });
        }

    

        function changeStatus(dkim_status , value) {
            if($("#custom_tr_domain").is(":checked")) {
            $(".customTrackingDomainClass").show();
            $(".contentBlk1").hide();
            $(".contentBlk2").hide();
            $(".contentBlkIndex").hide();
            $("#htacs").hide();
            $("#indexphp").hide();
            if($("#cname").is(":checked")) { 
                $(".contentBlk1").show();
            }
            if($("#htaccess").is(":checked")) {
                $(".contentBlk2").show();
            }
            if($("#index").is(":checked")) {
                $(".contentBlkIndex").show();
            }
        } else { 
            $(".customTrackingDomainClass").hide();
        }

        $(".blockUI").show();
        $.ajax({
                 url: "{{ URL::route('change.dkim.status') }}",
                 type: 'POST',
                 dataType:"json",
                 data: {domain_id: $("#domain_db_id").val(), '_token': token, 'field': dkim_status, 'value':value},
                 success: function (data) {
                    $("#confirm_b").hide();
                    $("#recheck").prop("disabled", false);
                     if(data["is_confirm_clicked"] == 0) { 
                         $("#confirm_b").show();
                         $("#recheck").prop("disabled", true);
                     } 
                    $(".blockUI").hide(); 
                    updateTrackingStatus();
                 },
                 complete: function(data) { 
                    $(".blockUI").hide(); 
                 }
             });
     }

     $("body").on("change" , "#dkimswt2, #custom_tr_domain,#spf_switch" , function() { 
         var id = $(this).attr("id");
         var value = $(this).val();
         if(value == 0) { 
            value = 1
         } else { 
            value = 0
         } 
         
         cdkimStatus1(id , value );
         if(id== "dkimswt2") { 
            changeStatus("is_enable_dkim" , value);
         }
         if(id== "custom_tr_domain") { 
            changeStatus("tracking_status" , value);
         }
         if(id== "spf_switch") { 
            changeStatus("bounce_status" , value);
         }
        
     });


     @if(!empty($domain_masking) and $domain_masking->is_enable_dkim == 0)
        cdkimStatus("dkimswt2" , 0)
        $("#dkim").hide();
     @endif
     @if(!empty($domain_masking) and $domain_masking->is_enable_dkim == 1)
        cdkimStatus("dkimswt2" , 1)
        $("#dkim").show();
     @endif
     @if(!empty($domain_masking) and $domain_masking->tracking_status != "Active")
        cdkimStatus("custom_tr_domain" , 0)
        $("#tr-domain-blk").hide();
     @endif
     @if(!empty($domain_masking) and $domain_masking->tracking_status  == "Active")
        cdkimStatus("custom_tr_domain" , 1)
        $("#tr-domain-blk").show();
        
     @endif
     @if(!empty($domain_masking) and $domain_masking->bounce_status == 0)
        cdkimStatus("spf_switch" , 0)
        $("#dSetting3").hide();
     @endif
     @if(!empty($domain_masking) and $domain_masking->bounce_status == 1)
        cdkimStatus("spf_switch" , 1)
        $("#dSetting3").show();
     @endif


     function cdkimStatus1(id , value ) { 
        if(id == "dkimswt2" &&  value == 0) $("#dkim").hide();
        if(id == "spf_switch" &&  value == 0) $("#dSetting3").hide();
        if(id == "custom_tr_domain" &&  value == 0) $("#tr-domain-blk").hide();
        $("#" + id).val(value);
        if(value == 1) { 
            if(id == "dkimswt2") $("#dkim").show();
            if(id == "custom_tr_domain") $("#tr-domain-blk").show();
            if(id == "spf_switch") $("#dSetting3").show();
        }
     }


     function cdkimStatus(id , value ) { 
        if(id == "dkimswt2" &&  value == 0) $("#dkim").show();
        if(id == "spf_switch" &&  value == 0) $("#dSetting3").hide();
        if(id == "custom_tr_domain" &&  value == 0) $("#tr-domain-blk").hide();
        $("#" + id).val(value);
        if(value == 1) { 
            $("#" + id).prop("checked" , true);
            if(id == "dkimswt2") $("#dkim").show();
            if(id == "custom_tr_domain") $("#tr-domain-blk").show();
            if(id == "spf_switch") $("#dSetting3").show();
        }
       
     }

   
    <?php if(!empty($domain_masking) and $domain_masking->tracking_status != "Active") { ?>
        $(function() { 
            $(".customTrackingDomainClass").hide();
        })
    <?php } ?>

    ////////////////////////////// New code For Recheck and Confirm  //////////////////////////////////////////////

    @if ($page_data['action'] != 'add')
    $(function() {
        $("#recheckFlag").val(1);
        recheckFunction();
    });

    
    $("body").on("click" , "#recheck" , function() { 
        $("#recheckFlag").val(0);
        recheckFunction();
    });
    $("body").on("click" , "#confirm_b" , function() { 
        $(".blockUI").show(); 
        $.ajax({
            url: "{{ url('confirmDomainStatus') }}",
            type: 'POST',
            dataType:"json",
            data: {domain_id: $("#domain_db_id").val(), '_token': token},
            success: function (data) {
                $("#recheck").prop("disabled",false);
                $("#confirm_b").hide();
                $("#recheckFlag").val(1);
                recheckFunction();
                $(".blockUI").hide(); 
            }

        });
               
    });




    function recheckFunction() { 
        $(".dkimLoader").css("display" , "inline-block");
        $(".loader2").css("display" , "inline-block");
        if($("#cname").is(":checked")) { 
            $(".loaderCname").css("display" , "inline-block");
        }
        if($("#htaccess").is(":checked")) { 
            $(".loaderHtaccess").css("display" , "inline-block");
        }
        if($("#index").is(":checked")) { 
            $(".loaderIndex").css("display" , "inline-block");
        }
        $(".blockUI").show(); 

        $.ajax({
            url: "{{ url('recheckDomainStatus') }}",
            type: 'POST',
            dataType:"json",
            data: {domain_id: $("#domain_db_id").val(),  recheckFlag: $("#recheckFlag").val(),'_token': token},
            success: function (data) {
                updateTrackingStatus();
                $("#msgInfo").hide(); 
                $(".blockUI").hide(); 
                
                var mx_status = data["mx_status"];
                var spf_status = data["spf_status"];
                /// DKIM checks
                if(data["is_confirm_dns"] == 0) { 
                    $("#dkimStatusIcon").html('<span class="chck checked1"><i class="fa fa-question"></i></span>')
                }
                if(data["is_confirm_dns"] == 2) { 
                    $("#msgInfo").show(); 
                    $("#dkimStatusIcon").html('<i class="la la-close text-danger tooltips" data-original-title="{{trans("sending_domains.dkim_failed")}}"></i>')
                }
                if(data["is_confirm_dns"] == 1) { 
                    $("#dkimStatusIcon").html('<span style="display: inline;"><i class="la la-check text-success tooltips" data-original-title="{{trans("sending_domains.dkim_verified")}}"></i></span>')
                }

                //// Domain Status Checks 
                if(data["is_confirm"] == 0) { 
                    $(".loaderCname").css("display" , "none");
                    $(".loaderHtaccess").css("display" , "none");
                    $(".loaderIndex").css("display" , "none");
                    if(data["domain_status_type"] == "cname") { 
                        $("#domainStatusIconCname").html('<span class="chck checked1"><i class="fa fa-question"></i></span>')
                    }
                    if(data["domain_status_type"] == "htaccess") { 
                        $("#domainStatusIconHtaccess").html('<span class="chck checked1"><i class="fa fa-question"></i></span>')
                    }
                    if(data["domain_status_type"] == "index") { 
                        $("#domainStatusIconIndex").html('<span class="chck checked1"><i class="fa fa-question"></i></span>')
                    }  
                }
                if(data["is_confirm"] == 2) { 
                    $(".loaderCname").css("display" , "none");
                    $(".loaderHtaccess").css("display" , "none");
                    $(".loaderIndex").css("display" , "none");
                    if(data["domain_status_type"] == "cname") { 
                        $("#msgInfo").show(); 
                        $("#domainStatusIconCname").html('<i class="la la-close text-danger tooltips" data-original-title="{{trans("sending_domains.dkim_failed")}}"></i>')
                    }
                    if(data["domain_status_type"] == "htaccess") { 
                        $("#domainStatusIconHtaccess").html('<i class="la la-close text-danger tooltips" data-original-title="{{trans("sending_domains.dkim_failed")}}"></i>')
                    }
                    if(data["domain_status_type"] == "index") { 
                        $("#domainStatusIconIndex").html('<i class="la la-close text-danger tooltips" data-original-title="{{trans("sending_domains.dkim_failed")}}"></i>')
                    }  
                }
                if(data["is_confirm"] == 1) { 
                    $(".loaderCname").css("display" , "none");
                    $(".loaderHtaccess").css("display" , "none");
                    $(".loaderIndex").css("display" , "none");
                    if(data["domain_status_type"] == "cname") { 
                        $("#domainStatusIconCname").html('<span  style="display: inline;"><i class="la la-check text-success tooltips" data-original-title="{{trans("sending_domains.dkim_verified")}}"></i></span>')
                    }
                    if(data["domain_status_type"] == "htaccess") { 
                        $("#domainStatusIconHtaccess").html('<span  style="display: inline;"><i class="la la-check text-success tooltips" data-original-title="{{trans("sending_domains.dkim_verified")}}"></i></span>')
                    }

                    if(data["domain_status_type"] == "index") { 
                        $("#domainStatusIconIndex").html('<span  style="display: inline;"><i class="la la-check text-success tooltips" data-original-title="{{trans("sending_domains.dkim_verified")}}"></i></span>')
                    }
                }

                $("#cnameResolveMsg1").hide();
                $("#cnameResolveMsg2").hide();
                if(data["is_confirm"] == 1 && data["is_confirm_redirect"] == 2) { 
                    $("#cnameResolveMsg1").show();
                }
                if(data["is_confirm_redirect"] == 3) { 
                    $("#cnameResolveMsg2").show();
                }

                ////// SPF Checks
                if(data["is_confirm_spf"] == 1) { 
                    $("#spfStatusIcon").html('<span  style="display: inline;"><i class="la la-check text-success tooltips" data-original-title="{{trans("sending_domains.dkim_verified")}}"></i></span>')
                }
                if(data["is_confirm_spf"] == 2) {
                    <?php if($imap_switch == 2) { ?>
                        $("#msgInfo").show(); 
                    <?php } ?>
                    $("#spfStatusIcon").html('<i class="la la-close text-danger tooltips" data-original-title="{{trans("sending_domains.dkim_failed")}}"></i>')
                }
                if(data["is_confirm_spf"] == 0) { 
                    $("#spfStatusIcon").html('<span class="chck checked1"><i class="fa fa-question"></i></span>')
                }

                //// MX checks 
                if(data["is_confirm_mx"] == 1) {
                    $("#mxStatusIcon").html('<span  style="display: inline;"><i class="la la-check text-success tooltips" data-original-title="{{trans("sending_domains.dkim_verified")}}"></i></span>')
                }  
                if(data["is_confirm_mx"] == 2) {
                    <?php if($imap_switch == 2) { ?>
                        $("#msgInfo").show(); 
                    <?php } ?>
                    $("#mxStatusIcon").html('<i class="la la-close text-danger tooltips" data-original-title="{{trans("sending_domains.dkim_failed")}}"></i>')
                }
                if(data["is_confirm_mx"] == 0) {
                    $("#mxStatusIcon").html('<span class="chck checked1"><i class="fa fa-question"></i></span>')
                }

                
                $(".dkimLoader").css("display" , "none");
                $(".loader2").css("display" , "none");
                $("#recheckFlag").val(0);
               
            }
        });
    }


   
    function updateTrackingStatus() {
        $.ajax({
            url: "{{ url('domain/get_tracking_status') }}",
            type: 'POST',
            data: {id: {{$domain_masking->id}}},
            success: function (result) {
                var obj = JSON.parse(result);
                var status = obj['status'];
                $(".secure-lock-blk").hide();
                if(status == true) { 
                    $(".secure-lock-blk").show();
                }
                $("#DomainStatus").html(obj["html"]);
            }
        });
    }
    @endif



        $(function() { 
            setTimeout(() => {
                <?php if($tracking_restriction == "on") {  ?>
                    @if($domain_masking->tracking_status != "Active")
                        $("#custom_tr_domain").trigger("click");
                    @endif
                    $(".custom_tr_domain").hide();
                <?php } ?>
                <?php if($bounce_restriction == "on") {  ?>
                    @if($domain_masking->bounce_status == 0)
                        $("#spf_switch").trigger("click");
                    @endif
                    $(".spf_switch").hide();
                <?php } ?>
                <?php if($dkim_restriction == "on") {  ?>
                    @if($domain_masking->is_enable_dkim == 0)
                        $("#dkimswt2").trigger("click");
                        $("#dkimswt").trigger("click");
                    @endif
                    $(".dkimswt").hide();
                    $(".dkimswt2").hide();
                <?php } ?>
            }, 300);
        });
      
      


    </script>
@endsection


@section(decide_content())

    @if($errors->any())
        <!-- For PHP validations errors-->
        <div class="alert alert-danger" data-name="bjWcppdG">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="CULsJoiJ">
            {{ Session::get('msg') }}
        </div>
    @endif
    @if (Session::has('error_msg'))
        <div class="alert alert-danger" data-name="WDhoxzfZ">
            {{ Session::get('error_msg') }}
        </div>
    @endif
    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="KbfgGtiL">
        <span id='msg-text'><span>
    </div>
    <!-- BEGIN FORM-->
    
    <div class="col-md-12" data-name="kJGxXzjf">

        @if(empty($primary_domain))
        <div class="note prDomain" data-name="fItkYaLu">
            <p>
                {{trans('sending_domains.modal_note')}}
                <a href="{{ route('setting.primary.domain') }}" type="button" class="btn btn-warning btn-md">{{trans('sending_domains.set_primary_domain')}}</a>
            </p>
        </div>
        @else

        @if ($page_data['action'] == 'add')
        <form action="{{route('domain.store')}}" method="POST" id="domain-frm" class="kt-form kt-form--label-right">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="action" value="add">
        @else
        <form action="{{ route('domain.update',  $domain_masking->id) }}" method="POST" id="domain-frm" class="kt-form kt-form--label-right">
            <input type="hidden" id="action" value="edit">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="domain-masking-id" value="{{$domain_masking->id}}">
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="domain_db_id" id="domain_db_id" value="{{ $domain_masking->id }}">
            <input type="hidden" name="recheckFlag" id="recheckFlag" value="0">
        @endif
            <input type="hidden" id="htaccess_hdn" value="add">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="SMsVvgsI">
                <div class="kt-portlet__head" data-name="TnAJjhhh">
                    <div class="kt-portlet__head-label" data-name="UNzrdLIj">
                        <h3 class="kt-portlet__head-title">{{trans('sending_domains.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="twLgQsVa">
                    <div class="form-body" data-name="dWElqZNn">

                        @if ($page_data['action'] == 'add')
                            <div class="form-group row" data-name="gtRkAkCs">
                                <label class="col-form-label col-md-3 text-right">{{trans('sending_domains.add_new.form.sending_domain')}}
                                        <span class="required"> * </span>
                                        {!! popover('sending_domains.add_new.form.sending_domain_help','common.description') !!}
                                    </label>
                                <div class="col-md-6" data-name="ajcBPHWE">
                                    <div class="input-icon right" data-name="oMiuQaLg">
                                        <input type="text" name="domain" placeholder="myagency.com" id="domain" value="{{isset($domain_masking->domain) ? $domain_masking->domain : '' }}" class="form-control" required />
                                        <span class="text-help">{{trans('sending_domains.add_new.form.sending_domain_text')}}</span>
                                    </div>
                                </div>
                              
                            </div>
                            <div class="form-group row" data-name="qyMnvWnc">
                                <label class="col-form-label col-md-3 text-right">
                                    @lang('sending_domains.use_secure_url')
                                    {!! popover('sending_domains.use_secure_url_help','common.description') !!} 
                                </label>
                                <div class="col-md-4" data-name="tSjELAGM">
                                    <div class="input-icon" data-name="HxerlYwU">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                            <label>
                                                <input type="checkbox" name="is_ssl_enabled" {{isset($domain_masking) && $domain_masking->is_ssl_enabled==1?'checked':''}} value="1">
                                                <span></span>
                                            </label>
                                        </span>

                                    </div>
                                </div>
                            </div>
                            <div class="form-actions" data-name="EPGwCNdZ">
                                <div class="row" data-name="qLwKzCLb">
                                    <div class="col-md-6 offset-md-3" data-name="gpUIgnQT">
                                    <!--  <button type="submit" name="save_add" class="btn green" value="save_add">{{trans('app.domain_masking.add_new.buttons.save_add')}}</button> -->
                                    @if ($page_data['action'] == 'add')
                                        <!-- <button type="submit" name="save_exit" class="btn green" value="save_exit">{{trans('app.domain_masking.add_new.buttons.save_exit')}}</button> -->
                                        @else
                                            <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                                        @endif

                                        @if ($page_data['action'] == 'add')
                                            <button type="submit" name="save_add_generate_keys" class="btn btn-success" value="save_add_generate_keys">{{trans('common.form.buttons.add')}}</button>
                                        @endif
                                        <a href="{{ route('domain.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row" data-name="cSwekNIn">
                                @php $showSllLock = false; @endphp
                                <input type="hidden" name="domain" id="domain" value="{{$domain_masking->domain}}" class="form-control" />
                                @if($domain_masking->is_verified)
                                <div class="col-md-12 dmnlbl" data-name="PKWDwYDt">
                                    {{isset($domain_masking->domain) ? $domain_masking->domain : '' }} @if($domain_verification==1) @if($domain_masking->is_verified) <span class="verify">{{trans('common.label.verified')}} <i class="la la-check"></i></span> @else <span class="unverify">{{trans('common.label.unverified')}} <i class="la la-close"></i></span> @endif @endif
                                    
                                    <div class="pull-right text-right status-right" id="DomainStatus" data-name="ZmVemiQd">
                                        @if($domain_masking->domain_status == 0) 
                                            <span class="btn btn-sm btn-domain btn-label-warning is-confirm-error">{{trans('common.label.inactive')}}</span> 
                                        @elseif($domain_masking->domain_status == 1)
                                        @php $showSllLock = true; @endphp
                                            <span class="btn btn-sm btn-domain btn-label-success is-confirm-error"> {{trans('common.label.active')}} </span>
                                        @elseif($domain_masking->domain_status == 2)
                                            <span class="btn btn-sm btn-domain btn-label-danger is-confirm-error"> {{trans('sending_domains.create_blade.suspended_span')}} </span>
                                        @elseif($domain_masking->domain_status == 4)
                                        @php $unauth_sending_domain = getSetting("unauth_sending_domain"); @endphp
                                                @if($unauth_sending_domain != "on")  
                                                @php $showSllLock = true; @endphp
                                                <span class="btn btn-sm btn-domain btn-label-success is-confirm-error">{{trans('common.label.active')}}</span> 
                                                @endif
                                                <span class="btn btn-sm btn-domain btn-label-warning is-confirm-error"> {{trans('sending_domains.create_blade.pending_authentication_span')}}</span>
                                        @else
                                            @php $unauth_sending_domain = getSetting("unauth_sending_domain"); @endphp
                                                @if($unauth_sending_domain != "on")  
                                                @php $showSllLock = true; @endphp
                                                <span class="btn btn-sm btn-domain btn-label-success is-confirm-error">{{trans('common.label.active')}}</span> 
                                                @endif
                                                <span class="btn btn-sm btn-domain btn-label-danger is-confirm-error">{{trans('sending_domains.create_blade.authentication_failed_span')}}</span> 
                                        @endif
                                    </div>

                                    
                                </div>
                                @endif
                            </div>
                           
                            @if($domain_masking->domain_status == 3 && $domain_masking->is_verified) 
                                     <br>
                                    <div id="msgInfo" style="display: none !important; " class="alert alert-info text-center" data-name="YPgnxtXA" >
                                    <span id="msg-text">
                                        {{trans('sending_domains.message.dns_alert_info')}}
                                    </span>
                                    </div>
                            @endif

                        @endif
                    </div>
                </div>
            </div>
        </form>

            @if ($page_data['action'] != 'add')
                <div class="kt-portlet kt-portlet--bordered proccess" data-name="hyRtgVAL">
                    <div class="kt-portlet__head" data-name="QcptuqqV">
                        <div class="kt-portlet__head-label" data-name="RGcInQOS">
                            <h3 class="kt-portlet__head-title">{{trans('sending_domains.edit.page.authenticate_your_domain')}} </h3>
                            
                        </div>


                        <div class="kt-portlet__head-toolbar" data-name="nLobkeic">
                            <input type="hidden" id="lockDanger" value="0">

                           <!-- DNS Hooks Switch -->
                           {!! hook_get_output('SendingDomainPageTitleBar',['id'=>$domain_masking->id]) !!}
                           <!-- DNS Hooks Switch Modal -->
                           
                            <div class="heading-toggles pull-right" data-name="abhgloSS" >
                                <div class="secure-lock-blk" @if($showSllLock == false) style="display:none" @endif data-name="GOzOwuXS">
                                    <span class="lock-spinner"><i class="fa fa-spinner fa-spin"></i></span>
                                    <span class="lock-danger popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="No SSL Detected" data-original-title="{{trans('common.description')}}">
                                        <img src="/public/img/icon/uncheck.png" alt="No SSL Detected" />
                                    </span>
                                    <span class="lock-success popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="" data-original-title="{{trans('common.description')}}">
                                    <img src="/public/img/icon/check.png" class="successImage" alt="Valid SSL Detected" />
                                    </span>
                                </div>
                                <label for="https"> @lang('sending_domains.use_secure_url'): </label>
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input {{isset($domain_masking) && $domain_masking->is_ssl_enabled ? 'checked':''}} type="checkbox" id="https" name="https">
                                        <span></span>
                                    </label>
                                </span>
                                @if($domain_masking->domain_status != 4 && $domain_masking->domain_status != 3)
                                <label for="https"> @lang('sending_domains.domain_status'): </label>
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input {{isset($domain_masking) && $domain_masking->domain_status ? 'checked':''}} type="checkbox" id="domain_status" name="domain_status">
                                        <span></span>
                                    </label>
                                </span>
                                @endif
                            </div>
                            @if($domain_masking->is_verified==1 || $domain_verification==0)
                            <!-- id="dnscheck" -->
                                <button @if($domain_masking->is_confirm_clicked == 0) disabled @endif type="button" id="recheck" class="btn btn-info" >@lang('sending_domains.edit.page.recheck')</button>
                                <small style="margin-left: 5px;display: none;" id="timer_parent">@lang('sending_domains.edit.page.recheck_msg') <div id="timer" data-name="tnSxIzqN"></div></small>
                            @endif
                        </div>
                    </div>
                    <div class="kt-portlet__body" data-name="TiumWrih">
                        @if(($domain_verification==1 && $domain_masking->is_verified==0))
                            <div class="kt-portlet kt-portlet--bordered" style="" data-name="eVIMzfSC">
                                <div class="kt-portlet__head" data-name="tNtAlmpN">
                                    <div class="kt-portlet__head-label" data-name="zzZJYCFn">
                                        <h3 class="kt-portlet__head-title">
                                            {{trans('sending_domains.edit.page.domain_ownership_required')}}
                                        </h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body" data-name="sWdIYmor">
                                    <div class="contentBlk" data-name="eEHMfZbS">
                                        <h2 class="display-hide">{{trans('sending_domains.edit.page.domain_ownership_required')}}</h2>
                                        <div class="content" data-name="QRSTOHtV">{{trans('sending_domains.edit.page.domain_ownership_note')}}</div>
                                    </div>
                                    <div id="selectopt" class="kt-radio-inline" data-name="UuEHSGvP">
                                        <label for="method2" class="acclbl2 kt-radio based"><input type="radio" name="verify_method" id="method2" checked="" value="dnc"> {{trans('sending_domains.edit.page.dns_record')}} <span></span></label>
                                        <label for="method1" class="acclbl2 kt-radio based"><input type="radio" name="verify_method" id="method1" value="upload_file" > {{trans('sending_domains.edit.page.upload_file')}} <span></span></label>
                                        

                                    </div>
                                    <?php
                                    $str=trim(md5($domain_masking->domain));
                                    ?>
                                    <div class="contentBlk3 contentBlk meth1" data-name="ToIbLqal">
                                        <h2>{{trans('sending_domains.edit.page.upload_file')}}:</h2>
                                        <div class="content meth" data-name="KLmUKfRS">
                                            {{trans('sending_domains.edit.page.download_and_upload_file')}} {{ $domain_masking->domain }}
                                            <ol>
                                                <li>{{trans('sending_domains.edit.page.download_this_file')}}</li>
                                                <li>{{trans('sending_domains.edit.page.access_publicly_url')}} http://{{ $domain_masking->domain }}/{{ $str }}.html</li>
                                                <li>{{trans('sending_domains.edit.page.verify_link')}}</li>
                                            </ol>
                                            <a href="{{ URL('download-file') }}/{{ $str }}" download="" class="btn-download">{{trans('sending_domains.edit.page.download_here')}}</a>

                                        </div>
                                    </div>
                                    <div class="contentBlk3 contentBlk meth2" data-name="XLsOUmQH">
                                        <h2>{{trans('sending_domains.edit.page.dns_record')}}:</h2>
                                        <div class="content meth" data-name="fTicXTTK">{{trans('sending_domains.edit.page.add_txt_record')}}</div>
                                        <div class="table-scrollable" data-name="dYZszfta">
                                            <table class="table table-striped table-hover table-checkable responsive dataTable no-footer" id="dSetting2">
                                                <input type="hidden" name="dns_domain" id="dns_domain" value="{{ $dns_domain }}" />
                                                <thead>
                                                <tr>
                                                    <th width="30%"> {{trans('common.label.host')}} </th>
                                                    <th> {{trans('common.label.type')}} </th>
                                                    <th width="30%" class="cnamevalue-enter"> {{trans('sending_domains.create_blade.enter_value_th')}} </th>
                                                    <th width="30%" class="cnamevalue-current"> {{trans('sending_domains.create_blade.current_value_th')}} </th>
                                                    @if(isset($domain_masking) && $domain_masking->is_verified ==0)
                                                    <th width="30%" class="cnamevalue-current">  </th>
                                                    @endif
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        {{ $dns_domain }}
                                                    </td>
                                                    <td>TXT</td>
                                                    <td>
                                                        <div id="optkey21" data-name="XbQTIIjF">
                                                            <button class="btn btn-default btn-copy icon-copy" title="Click here Copy to clipboard" onclick="copyFunction2();"  id="cp_btn21"> <i class="flaticon2-copy"></i></button>
                                                            <span id="cnamecopy2">{{ md5($domain_masking->domain) }}</span>
                                                            <input type="hidden" id="dns_domain_value" value="{{ md5($domain_masking->domain) }}">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                             $dns = new \App\Classes\DNSLookUp();
                                                             $verify_key_value = $dns->getDNS("TXT" , $dns_domain);
                                                        ?>
                                                        <div id="optkey24" data-name="LFDzDvMv">
                                                            @if(!empty($verify_key_value))
                                                            <span id="pr-domain2">{{$verify_key_value}}</span>
                                                            @else 
                                                            <span id="pr-domain2">{!!getDNSCurrentvalue($dns_domain , "TXT")!!}</span>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <div class="form-actions" data-name="fRkHmhQv">
                                        <div class="row" data-name="snVUvpva">
                                            <div class="col-md-12" data-name="YgfLRcTa">
                                                {{-- <!-- <span id='confirm-button'>  -->
                                                    @if($domain_masking->is_confirm_clicked == 0)
                                                        <!-- <button type="button" name="" class="btn btn-success" id="confirm_b" onClick="checkDomain($(this).attr('id'));confirmClicked(1);">{{trans('common.label.confirm')}}</button> -->
                                                    @endif
                                                <!-- </span> --> --}}
                                                <button type="button" name="btn_verify_domain" id="btn_verify_domain" value="{{ trans('sending_domains.edit.page.button.verify_domain') }}" class="btn btn-success" /> {{ trans('sending_domains.edit.page.button.verify_domain') }} </button>
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        
                        @else

                        <div class="kt-portlet kt-portlet--bordered"  style="display: @if(($domain_verification==1 && $domain_masking->is_verified==1) || ($domain_verification==0 && $domain_masking->is_verified==0) || ($domain_verification==0 && $domain_masking->is_verified==1)) block; @else none; @endif" data-name="BxzVLEWe">
                            <div class="kt-portlet__head" data-name="XRtbWglj">
                                <div class="kt-portlet__head-label" data-name="tGPDFjno">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('sending_domains.edit.page.dkim_auth')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body" data-name="VQGmVsPh">
                                @if($domain_masking->dkim_public !="" && $domain_masking->dkim_private!="")
                                    <div class="row switchRow dkimswt2" id="switchRow" data-name="WMSwelgl">
                                        <!-- <label>{{trans('app.setup.domains.add.enable_dkim')}}</label> -->
                                        <label>{{trans('sending_domains.edit.page.enable_dkim')}}</label>

                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                            <label>
                                                <input type="checkbox"  id="dkimswt2" name="dkimswt2" @if($domain_masking->is_enable_dkim==1) checked=""  @endif>
                                                <span></span>
                                            </label>
                                        </span>

                                        <div class="switchMsg" data-name="PxaBuSsT">{{trans('sending_domains.edit.page.enable_mumara')}}</div>
                                        <!-- <hr class="swroll"> -->
                                    </div>
                                @endif

                                @if($domain_masking->dkim_private=="")
                                    <div class="row switchRow dkimswt" id="switchRow" data-name="xxAyMEPu">
                                        <label for="dkimswt">{{trans('sending_domains.edit.page.generate_dkim.title')}}</label>
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                            <label>
                                                <input type="checkbox" id="dkimswt" name="dkimswt">
                                                <span></span>
                                            </label>
                                        </span>
                                        <div class="switchMsg" data-name="MMYruTlt">{{trans('sending_domains.edit.page.generate_dkim.description')}}</div>
                                    </div>
                                @endif

                                <!-- <div id="dkim" style="display: @if($domain_masking->is_enable_dkim==1 && $domain_masking->dkim_public!="" && $domain_masking->dkim_private!="") block; @else none; @endif;"> -->
                                <div id="dkim" class="table-responsive" data-name="zprXnxbv">
                                    <div class="contentBlk" data-name="CnnTaIMC">
                                        <h2>{{trans('sending_domains.edit.page.authenticate_title')}}</h2>
                                        <div class="content" data-name="BEOXAOnM">{{trans('sending_domains.edit.page.authenticate_help1')}} {{$domain_masking->domain}}. {{trans('sending_domains.edit.page.authenticate_help2')}}</div>
                                    </div>
                                    <table class="table table-striped table-hover table-checkable" id="dSetting">
                                        <thead>
                                        <tr>
                                            <th width="28%"> {{trans('sending_domains.edit.page.host')}} </th>
                                            <th width="8%"> {{trans('sending_domains.edit.page.type')}} </th>
                                            <th width="32%" class="brn" style="border-bottom: 1px solid #e7ecf1 !important;"> {{trans('sending_domains.edit.page.value')}} </th>
                                            <th width="32%" class="cnamevalue-current"> {{trans('sending_domains.create_blade.current_value_th')}} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="option" data-name="bhwuLOvZ">
                                                    
                                                    <span id="dkimStatusIcon"></span>
                                                    <span id="load" class="loadg loader1 dkimLoader"><i class="la la-refresh fa-spin"></i></span>
                                                    
                                                  
                                                    <input type="text" name="" class="track" value="" style="padding: 5px;" id="email_track">
                                                    <div class="domaintrack" data-name="oeMHTSWi"><span class="subdomain">{{$domain_masking->email_selector}}</span>._domainkey.{{$domain_masking->domain}}</div>
                                                        <input type="hidden" id="dkim_domain" value="{{$domain_masking->email_selector}}._domainkey.{{$domain_masking->domain}}">
                                                        <input type="hidden" id="tr_domain" value="{{$domain_masking->tracking_domain}}.{{$domain_masking->domain}}">
                                                        <a href="javascript:;" class="btn btn-success btn-save" onClick="confirmClicked(0);"><i class="la la-save subsave"></i></a>
                                                        <a href="javascript:;" class="btn btn-success btn-cancel"><i class="la la-times text-danger subcancel"></i></a>
                                                    @php 
                                                        $allow_editing_dkim_selector = getSetting("allow_editing_dkim_selector");
                                                    @endphp
                                                    @if($allow_editing_dkim_selector != "on")
                                                    <a href="javascript:;" class="btn btn-default btn-edit"><i class="la la-edit"></i></a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option" data-name="cCNxCLWo">{{trans('sending_domains.create_blade.txt_text_th')}}</div>
                                            </td>
                                            <td>
                                                <div id="optkey" data-name="kcrvKVPI">
                                                    <button class="btn btn-default btn-copy icon-copy" title="@lang('common.label.copy_clipboard')"  id="cp_btn21" onclick="copy_domain(cnamecopy)"> <i class="flaticon2-copy"></i></button>
                                                    <span id="cnamecopy">{{$public_key}}</span>
                                                    <input type="hidden" id="dkim_domain_value" value="{{$public_key}}">
                                                </div>
                                            </td>

                                            <td>
                                                <div id="optkey-current" data-name="CDMaglEz">
                                                    <span id="optkey-content">{{$domain_key_value}}</span>
                                                </div>
                                            </td>

                                        </tr>

                                        </tbody>

                                    </table>
                                    @php 
                                        $allow_user_to_domain_keys = getSetting("allow_user_to_domain_keys");
                                        $allow_users_to_regenerate_keys = getSetting("allow_users_to_regenerate_keys");
                                    @endphp
                                    @if($allow_users_to_regenerate_keys != "on")
                                    <a href="javascript:;" title="@lang('sending_domains.edit.page.regenerate_DKIM')" style="float:right" class="kt-font-info regenrate_dkimswt pull-right">@lang('sending_domains.edit.page.regenerate_keys')</a>
                                    @endif
                                    @if($allow_user_to_domain_keys != "on")
                                    <a href="/download-keys/{{!empty($domain_masking->id) ? $domain_masking->id : 0}}" title="{{trans('sending_domains.edit.page.download_private_key')}}" class="dwnld"><i class="fa fa-download"></i></a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="kt-portlet kt-portlet--bordered"  style="display: @if(($domain_verification==1 && $domain_masking->is_verified==1) || ($domain_verification==0 && $domain_masking->is_verified==0) || ($domain_verification==0 && $domain_masking->is_verified==1)) block; @else none; @endif" data-name="DBeilDDZ">
                            <div class="kt-portlet__head" data-name="fqtdAMhM">
                                <div class="kt-portlet__head-label" data-name="dxaIjULr">
                                    <h3 class="kt-portlet__head-title">
                                        <!-- {{trans('app.setup.domains.add.setup_tracking_domain')}}  -->
                                        {{trans('sending_domains.edit.page.custom_tracking_domain')}} 
                                    </h3> 
                                </div>
                            </div>
                            <div class="kt-portlet__body" data-name="qslNHuqr">
                                <div class="contentBlk custom_tr_domain" data-name="QJsjEKly">

                                    <div class="row switchRow" id="switchRow" data-name="ASmhUboB">
                                        <label for="custom_tr_domain">{{trans('sending_domains.edit.page.enable_custom_tracking_domain')}}</label>
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                            <label>
                                                <input type="checkbox" NO NUMERIC NOISE KEY 1035 1034 id ="custom_tr_domain" name="custom_tracking">
                                                <span></span>
                                            </label>
                                        </span>
                                        <div class="switchMsg" data-name="ILnLiFAd">{{trans('sending_domains.edit.page.enable_custom_tracking_domain_msg')}}</div>
                                    </div>
                                </div>
                                @php 
                                    $enable_cname_option_tracking_domain = getSetting("enable_cname_option_tracking_domain");
                                    $enable_htaccess_option_tracking_domain = getSetting("enable_htaccess_option_tracking_domain");
                                    $enable_clock_option_tracking_domain = getSetting("enable_clock_option_tracking_domain");
                                @endphp

                                <div id="selectopt" class="kt-radio-inline customTrackingDomainClass" data-name="jcYvQFgC" >
                                @if($enable_cname_option_tracking_domain != "on")
                                    <label for="cname" class="acclbl kt-radio base"><input class="verify_type" type="radio" name="type" id="cname" value="cname" {{ ($domain_masking->type=="cname" || $domain_masking->type=="" ? "checked":'')}} > {{trans('sending_domains.edit.page.cname')}} <span></span></label>
                                @endif
                                @if($enable_htaccess_option_tracking_domain != "on")
                                    <label for="htaccess" class="acclbl kt-radio base"><input class="verify_type" type="radio" name="type" id="htaccess" {{ ($domain_masking->type=="htaccess" ? "checked":'')}} value="htaccess"> {{trans('sending_domains.edit.page.htaccess')}} <span></span></label>
                                @endif
                                @if($enable_clock_option_tracking_domain != "on")
                                    <label for="index" class="acclbl kt-radio base"><input class="verify_type" type="radio" name="type" id="index" {{ ($domain_masking->type=="index" ? "checked":'')}} value="index"> {{trans('sending_domains.create_blade.cloak_txt_div')}} <span></span></label>
                                @endif
                                </div>

                               

                              
                                <div class="contentBlk1 contentBlk customTrackingDomainClass" data-name="jJVSVlth">
                                    <h2>{{trans('sending_domains.edit.page.cname')}}</h2>
                                    <div class="content" data-name="vQMpnJtg">{{trans('sending_domains.edit.page.cname_help1')}} {{$domain_masking->domain}} {{trans('sending_domains.edit.page.cname_help2')}}</div>
                                </div>
                               
                                <div class="contentBlk2 contentBlk customTrackingDomainClass" data-name="RcCyoqox">
                                    <h2>.{{trans('sending_domains.edit.page.htaccess')}}</h2>
                                    <div class="content" data-name="YgTvKmbv">{{trans('sending_domains.edit.page.htaccess_help1')}} {{$domain_masking->tracking_domain}}.{{$domain_masking->domain}}. {{trans('sending_domains.edit.page.htaccess_help2')}}
                                    </div>
                                </div>
                               
                                <div class="contentBlkIndex contentBlk customTrackingDomainClass" data-name="aYawPzcS">
                                    <h2>{{trans('sending_domains.create_blade.cloak_txt_div')}}</h2>
                                    <div class="content" data-name="eFOHKneU"> {{trans('sending_domains.create_blade.download_generated_php_file_div')}} i.e. {{$domain_masking->tracking_domain}}.{{$domain_masking->domain}}
                                    </div>
                                    <div class="php-tracking-note" data-name="AvIUEnEq">
                                        <b>{{trans('sending_domains.edit.page.php_redirect.note')}} </b>
                                        <code>{{trans('sending_domains.edit.page.php_redirect.code')}}</code> {{trans('sending_domains.edit.page.php_redirect.message')}}
                                    </div>
                                </div>
                               
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-checkable customTrackingDomainClass" id="cnm">
                                        <thead>
                                        <tr>
                                            <th> {{trans('sending_domains.edit.page.host')}} </th> </th>
                                            <th> {{trans('sending_domains.edit.page.type')}} </th> </th>
                                            <th> {{trans('sending_domains.edit.page.value')}} </th> </th>
                                            <th class="cnamevalue-current"> {{trans('sending_domains.create_blade.current_value_th')}} </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="option rh30" data-name="pEpIvpCB">
                                                    <span id="domainStatusIconCname"></span>
                                                    <span id="load" class="loadg  loaderCname"><i class="la la-refresh fa-spin"></i></span>
                                                    
                                                    <input type="text" name="" class="track" value="" id="cname_track">
                                                    <div class="domaintrack" data-name="GuiInJBG"><span class="subdomain">{{$domain_masking->tracking_domain}}</span>.{{$domain_masking->domain}}</div>
                                                    <a href="javascript:;" class="btn btn-success btn-save" onClick="confirmClicked(0);"><i class="la la-save subsave"></i></a>
                                                    <a href="javascript:;" class="btn btn-success btn-cancel"><i class="la la-times text-danger subcancel"></i></a>
                                                    @php 
                                                        $allow_editing_tracking_selector = getSetting("allow_editing_tracking_selector");
                                                    @endphp
                                                    @if($allow_editing_tracking_selector != "on")
                                                    <a href="javascript:;" class="btn btn-default btn-edit"><i class="la la-edit"></i></a>
                                                   
                                                    @endif

                                                   
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option" data-name="SvpOjEaf">
                                                    {{trans('sending_domains.edit.page.cname')}}
                                                </div>
                                            </td>
                                            <td>
                                                <div id="optkey-current" data-name="mGfqpLzF"><button class="btn btn-default btn-copy icon-copy" title="@lang('common.label.copy_clipboard')" id="cp_btn21" onclick="copy_domain(cnamecopy2)"> <i class="flaticon2-copy"></i>
                                                        <input type="hidden" id="tr_domain_value" value="{{$primary_domain}}">
                                                    </button><span id="cnamecopy2">{{$primary_domain}}</span><input type="hidden" id="tr_cname_value" value="{{$primary_domain}}"></div>
                                            </td>
                                            <td>

                                                    <?php 
                                                            $dns = new \App\Classes\DNSLookUp();
                                                            $dns_domain = $domain_masking->tracking_domain . "." . $domain_masking->domain;
                                                            $verify_key_value = $dns->getDNS("CNAME" , $dns_domain);
                                                    ?>
                                                    <div id="optkey24" data-name="GBYBinuF">
                                                        @if(!empty($verify_key_value))
                                                        <span id="pr-domain2">{{$verify_key_value}}</span>
                                                        @else 
                                                        <span id="pr-domain2">{!!getDNSCurrentvalue($domain_masking->tracking_domain . "." . $domain_masking->domain  , "CNAME")!!}</span>
                                                        @endif
                                                    </div>

                                                   
                                                </div>
                                            </td>
                                        </tr>
                                       
                                        <tr id="cnameResolveMsg1" style="display:none"> <td colspan="4" ><div class="alert alert-warning alert-bold" data-name="xQFUCHpw"><span class="alert-text">
                                        {!!trans('sending_domains.message.cname_resolve_msg1',['domain'=>$domain_masking->tracking_domain . "." .$domain_masking->domain])!!}
                                        
                                        </span></div></td> </tr>
                                       
                                        <tr id="cnameResolveMsg2" style="display:none"> <td colspan="4" >
                                        <div class="alert alert-warning alert-bold" data-name="zErdsFZs"><span class="alert-text">
                                        
                                        {!!trans('sending_domains.message.cname_resolve_msg2',['domain'=>$domain_masking->tracking_domain . "." .$domain_masking->domain])!!}
                                        
                                        </span></div></td> </tr>
                                       
                                        </tbody>
                                    </table>

                                    <table class="table table-striped table-hover table-checkable responsive customTrackingDomainClass" id="htacs">
                                        <thead>
                                        <tr>
                                            <th> {{trans('sending_domains.edit.page.host')}} </th> </th>
                                            <th> {{trans('sending_domains.edit.page.type')}} </th> </th>
                                            <th> {{trans('sending_domains.create_blade.download_file_th')}} </th> </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="option" data-name="ZSTgomDP">
                                                    <span id="domainStatusIconHtaccess"></span>
                                                    <span id="load" class="loadg  loaderHtaccess"><i class="la la-refresh fa-spin"></i></span>
                                                   

                                                    <input type="text" name="" class="track" value="" id="htaccess_track">
                                                    <div class="domaintrack" data-name="uNtGHFum"><span class="subdomain">{{$domain_masking->tracking_domain}}</span>.{{$domain_masking->domain}}</div>
                                                    <a href="javascript:;" class="btn btn-success btn-save" onClick="confirmClicked(0);"><i class="la la-save subsave"></i></a>
                                                    <a href="javascript:;" class="btn btn-success btn-cancel"><i class="la la-times text-danger subcancel"></i></a>
                                                    @php 
                                                        $allow_editing_tracking_selector = getSetting("allow_editing_tracking_selector");
                                                    @endphp
                                                    @if($allow_editing_tracking_selector != "on")
                                                    <a href="javascript:;" class="btn btn-default btn-edit"><i class="la la-edit"></i></a>
                                                    @endif
                                                    
                                                </div>
                                                
                                            </td>
                                            <td>
                                                <div class="option" data-name="KeyOdUJu">
                                                    {{trans('sending_domains.edit.page.htaccess')}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option" data-name="nzeYzLQs">
                                                    <div class="downfile" data-name="tODMgaHu">
                                                        <a  href="{{ route('domain.htaccess.download') }}" download>{{trans('sending_domains.edit.page.htaccess_download_button')}}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>

                                        <tr id="cnameResolveMsg2" style="display:none"> <td colspan="4" >
                                        <div class="alert alert-warning alert-bold" data-name="ekmWnkSP"><span class="alert-text">
                                        
                                        {!!trans('sending_domains.message.cname_resolve_msg2',['domain'=>$domain_masking->tracking_domain . "." .$domain_masking->domain])!!}
                                        
                                        </span></div></td> </tr>

                                        </tbody>
                                    </table>

                                    <table class="table table-striped table-hover table-checkable responsive customTrackingDomainClass" id="indexphp">
                                        <thead>
                                        <tr>
                                            <th> {{trans('sending_domains.edit.page.host')}} </th> </th>
                                            <th> {{trans('sending_domains.edit.page.type')}} </th> </th>
                                            <th> {{trans('sending_domains.create_blade.download_file_th')}} </th> </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="option" data-name="wgOctfeM">
                                                    <span id="domainStatusIconIndex"></span>
                                                    <span id="load" class="loadg loaderIndex"><i class="la la-refresh fa-spin"></i></span>
                                                    
                                                    <input type="text" name="" class="track" value="" id="index_track">
                                                    <div class="domaintrack" data-name="HxRrOVKk"><span class="subdomain">{{$domain_masking->tracking_domain}}</span>.{{$domain_masking->domain}}</div>
                                                    <a href="javascript:;" class="btn btn-success btn-save" onClick="confirmClicked(0);"><i class="la la-save subsave"></i></a>
                                                    <a href="javascript:;" class="btn btn-success btn-cancel"><i class="la la-times text-danger subcancel"></i></a>
                                                    @php 
                                                        $allow_editing_tracking_selector = getSetting("allow_editing_tracking_selector");
                                                    @endphp
                                                    @if($allow_editing_tracking_selector != "on")
                                                    <a href="javascript:;" class="btn btn-default btn-edit"><i class="la la-edit"></i></a>
                                                    @endif
                                                    
                                                </div>
                                                
                                            </td>
                                            <td>
                                                <div class="option" data-name="BokKrYty">
                                                    {{trans('sending_domains.create_blade.cloak_txt_div')}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option" data-name="KMUtUXmH">
                                                    <div class="downfile" data-name="EPvyyzke">
                                                        <a  href="{{ route('domain.phpredirect.download') }}" download>{{trans('sending_domains.create_blade.download_php_file_action')}}</a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>


                                        <tr id="cnameResolveMsg2" style="display:none"> <td colspan="4" >
                                        <div class="alert alert-warning alert-bold" data-name="IvqFSKcx"><span class="alert-text">
                                        
                                        {!!trans('sending_domains.message.cname_resolve_msg2',['domain'=>$domain_masking->tracking_domain . "." .$domain_masking->domain])!!}
                                        
                                        </span></div></td> </tr>
                                        
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>

                       
                        @if($imap_switch == 2)
                        <!-- Custom Bounce Domain --> 
                        <div class="kt-portlet kt-portlet--bordered" style="display: {{$domain_masking->is_verified==1 ? 'block;': 'none;'}}" data-name="kgKMjMAn" >
                            <div class="kt-portlet__head" data-name="AKEAANHh">
                                <div class="kt-portlet__head-label" data-name="lSTGeXuy">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('sending_domains.create_blade.custom_bounce_domain_label')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body" data-name="kTDwqmne">

                                <div class="row switchRow spf_switch" data-name="grPckqIe">
                                    <label for="spf_switch">{{trans('sending_domains.create_blade.custom_bounce_domain_label')}}</label>
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="spf_switch" id="spf_switch" >
                                            <span></span>
                                        </label>
                                    </span>
                                    <div class="switchMsg" data-name="zKgMbpFo">{{trans('sending_domains.create_blade.spf_record_domain_div')}}</div>
                                </div>
                                <div class="form-group row custom_bounce_dblk" data-name="fJorGUOQ">
                                    <div class="input-copyBlk" data-name="ktWSfBrO">
                                        <div class="domaintrack" data-name="RnQWcYmA"><input type="text" name="" class="track" value="{{isset($domain_masking->bounce_selector)?$domain_masking->bounce_selector:'bounce'}}" id="change-bounce"><span class="subdomain" id="bounce-dmn">{{isset($domain_masking)?$domain_masking->bounce_selector:''}}</span>.{{isset($domain_masking)?$domain_masking->domain:''}}</div>
                                         <input type="hidden" id="bounce_host" value="{{isset($domain_masking)?$domain_masking->bounce_selector:''}}">
                                         @php 
                                            $allow_editing_bounce_selector = getSetting("allow_editing_bounce_selector");
                                         @endphp

                                        
                                        <a href="javascript:void(0);" class="btn text-success"  style="display:none" id="bounceSave">
                                            <i class="la la-save"></i>
                                        </a>
                                        @if($allow_editing_bounce_selector != "on")
                                        <a href="javascript:;" class="btn text-success btn-edit" id="bounceChange"><i class="la la-edit"></i></a>
                                        @endif
                                        <a href="javascript:;" class="btn btn-success btn-cancel" id="bounceCancel"><i class="la la-times text-danger subcancel"></i></a>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-checkable" id="dSetting3">
                                        <thead>
                                        <tr>
                                            <th width="30%"> {{trans('sending_domains.create_blade.domain_txt_th')}} </th>
                                            <th> {{trans('sending_domains.create_blade.txt_text_th')}} </th>
                                            <th width="30%"> {{trans('sending_domains.create_blade.enter_value_th')}} </th>
                                            <th width="30%"> {{trans('sending_domains.create_blade.current_value_th')}}  <!-- <button type="button" class="btn btn-xs btn-label-info pull-right">Recheck</button>--> </th> 
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <div class="option rh30" data-name="pcOczFwL">
                                                    <span id="spfStatusIcon"></span>
                                                    <span id="spf_reload" class="loadg loader2 spfloaderIcon"><i class="la la-refresh fa-spin"></i></span>

                                                    <span class="spf-domn-txt"><span class="bounce bounce_selector">{{isset($domain_masking->bounce_selector)?$domain_masking->bounce_selector:'bounce'}}</span><span class="bounce2">.</span>{{ $domain_masking->domain }}</span>
                                                    <a href="javascript:;" class="btn btn-default btn-edit2">{{--<i class="la la-save" onclick="verifySpf({{ $domain_masking->id }})" ></i>--}}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option" data-name="tZUcjUxH">
                                                    {{trans('sending_domains.create_blade.txt_text_th')}}
                                                </div>
                                            </td>
                                        
                                            <td>
                                                <div class="input-group" id="optkey33" data-name="lldKFBsN">
                                                    <button class="btn btn-default btn-copy icon-copy" id="cp_btn" title="Click here Copy to clipboard" onclick="copyFunction3()"> <i class="flaticon2-copy"></i></button>
                                                    <span id="optkey2">{{ $spf_record }}</span>
                                                    <input type="hidden" id="spf_value" value="{{$spf_record}}">
                                                </div>
                                            </td>
                                            <td>
                                                <div id="optkey33_value" data-name="sDpFnnkQ">
                                                    <?php $ss_domain_part1 =  isset($domain_masking->bounce_selector)?$domain_masking->bounce_selector:'bounce';
                                                     
                                                      $dns_domain = $ss_domain_part1 .  "." . $domain_masking->domain;
                                                      $verify_key_value = $dns->getDNS("TXT" , $dns_domain);
                                                      ?>
                                                  
                                                      
                                                    @if(!empty($verify_key_value))
                                                    <span>{{$verify_key_value}}</span>
                                                    @else 
                                                    <span>{{getDNSCurrentvalue($ss_domain_part1 .  "." . $domain_masking->domain  , "TXT")}} </span>
                                                    @endif
                                                        
                                                   
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="option rh30" data-name="hQyNbrUB">
                                                    <span id="mxStatusIcon"></span>
                                                    <span id="spf_reload2" class="loadg loader2 mxloaderIcon"><i class="la la-refresh fa-spin"></i></span>
                                                   
                                                    <span class="spf-domn-txt"><span class="bounce bounce_selector">{{isset($domain_masking->bounce_selector)?$domain_masking->bounce_selector:'bounce'}}</span><span class="bounce2">.</span>{{ $domain_masking->domain }}</span>
                                                    <a href="javascript:;" class="btn btn-default btn-edit2">{{--<i class="la la-save" onclick="verifySpf({{ $domain_masking->id }})" ></i>--}}</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="option" data-name="JXajvUfK">
                                                    {{trans('sending_domains.create_blade.mx_txt_div')}} <small>(10 {{trans('sending_domains.create_blade.small_priority')}})</small>
                                                </div>
                                            </td>
                                        
                                            <td>
                                                <div class="input-group" id="optkey34" data-name="KsAUTdhA">
                                                    <button class="btn btn-default btn-copy icon-copy" id="cp_btn" title="Click here Copy to clipboard" onclick="copyFunction4()"> <i class="flaticon2-copy"></i></button>
                                                    <span id="optkey4">{{isset($default_return_path_domain)? $default_return_path_domain:'return.mumara.net'}}</span>

                                                    <input type="hidden" id="cs_bs" value="{{isset($custom_bounce_selector)?$custom_bounce_selector->setting_value:''}}{{isset($default_return_path_domain)? $default_return_path_domain:''}}">
                                                </div>
                                            </td>
                                            <td>
                                                <div id="optkey34_value" data-name="uGkPLCON">
                                                    <span>{{$mx_key_value}}</span>
                                                </div>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                        @endif


                        <div class="form-actions" style="display: @if(($domain_verification==1 && $domain_masking->is_verified==1) || ($domain_verification==0 && $domain_masking->is_verified==0) || ($domain_verification==0 && $domain_masking->is_verified==1)) block; @else none; @endif" data-name="rDjkYOZK">
                            <div class="row" data-name="cshalRBN">
                                <div class="col-md-12" data-name="mBYWDSqT">
                                    <span id='confirm-button'> <!-- id="confirm" -->
                                       
                                            <button type="button"  @if($domain_masking->is_confirm_clicked == 1) style="display:none"   @endif name="" class="btn btn-success" id="confirm_b" >{{trans('common.label.confirm')}}</button>
                                       
                                    </span>
                                </div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            @endif
        @endif
    </div>

    <div id="modal-dkim" class="modal" role="dialog" aria-hidden="true" data-name="lZBhfhzA">
        <div class="modal-dialog" style="width: 500px;" data-name="UGYWpPDN">
            <div class="modal-content" data-name="mvUCcGUk">
                <div class="modal-header" data-name="cNADrfst">
                    <h5 class="modal-title">{{trans('sending_domains.edit.page.dkim')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="$('#modal-dkim').hide();" aria-hidden="true"></button>
                </div>
                <div class="modal-body" data-name="VKmwSWxN">
                    <div class="form-group row" data-name="rTydQdZY">
                        {{trans('sending_domains.edit.page.public_key')}}
                        <textarea name="public_key" id="public_key" class="form-control" rows="10"></textarea>
                    </div>
                    <div class="form-group row" data-name="NdQygxMO">
                        {{trans('sending_domains.edit.page.private_key')}}
                        <textarea name="private_key" id="private_key" class="form-control" rows="10"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="modal-spf" class="modal" role="dialog" aria-hidden="true" data-name="LmFHxBta">
        <div class="modal-dialog" style="width: 600px;" data-name="lKtPGUkK">
            <div class="modal-content" data-name="RfdmPwbl">
                <div class="modal-header" data-name="CqIzAIzZ">
                    <h5 class="modal-title">{{trans('sending_domains.edit.page.spf')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="$('#modal-spf').hide();" aria-hidden="true"></button>
                </div>
                <div class="modal-body" data-name="froIKwxm">
                    <div class="form-group row" data-name="GTwySLfE">
                        <textarea name="spf" id="spf" class="form-control" rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="proccess" class="modal" role="dialog" aria-hidden="true" data-name="vPeQVFCB">
        <div class="modal-dialog" data-name="YRgrTQKk">
            <div class="modal-content" data-name="JmBCKyil">
                <div class="modal-header" data-name="xZOwRcvb">
                    <h5 class="modal-title">{{trans('sending_domains.edit.page.domain_key_identification_method')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="$('#modal-spf').hide();" aria-hidden="true"></button>
                </div>
                <div class="modal-body" data-name="gHkRiZNB">
                    <div class="portlet" data-name="FfUiQjCi">
                        <div class="portlet-body" data-name="MMfAMcYK">
                            <div id="dkimyes" data-name="pbFpWikR">
                                <p id="processDesc">{{trans('sending_domains.edit.page.dkim_info')}}</p>
                                <button type="button" class="btn btn-success" id="processBtn1">{{trans('sending_domains.edit.page.generate_keys')}}</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="cancel1">{{trans('common.form.buttons.cancel')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

 
<div class="modal fade" id="integrats" tabindex="-1" role="dialog" aria-labelledby="integration" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="iRFCDeIz">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" data-name="AthLcksK">
        <div class="modal-content" data-name="uanocqoR">
            <div class="modal-header" data-name="ngriqChr">
                <h5 class="modal-title" id="exampleModalLongTitle">{{trans('domains.update_dns.modal.heading')}}</h5>
            </div>
            <div class="modal-body" data-name="sTTVPbCq">
                <span style="display: none;"  class="spinner spinner_2"><i class="fa fa-spinner fa-spin"></i></span>
                <div style="display: none;"   class="alert_msg alert alert-danger" data-name="kfllsHFZ"></div>
                <div id=""  class="{{--scroll scroll-300--}}" data-name="AWANAltc">

                    <table class="table table-striped table-bordered table-responsive" id="update-zone">
                        <thead id="t_head">
                        <tr>
                            <th width="25%">{{trans('sending_domains.create_blade.host_txt_th')}} </th>
                            <th width="20%">{{trans('sending_domains.create_blade.value_txt_th')}} </th>
                            <th width="5%">{{trans('sending_domains.create_blade.type_txt_th')}} </th>
                            <th width="20%">{{trans('sending_domains.create_blade.provider_txt_th')}} </th>
                            <th width="5%">{{trans('sending_domains.create_blade.status_txt_th')}} </th>
                            <th width="25%">{{trans('sending_domains.create_blade.response_txt_th')}} </th>
                        </tr>
                        </thead>
                        <tbody id="t_body">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" data-name="lrhKxPBV">
                <button type="button" style="display:{{isset($domain_masking) && $domain_masking->is_verified == 0?'block;':'none;'}}" name="btn_verify_domain2" id="btn_verify_domain2" value="{{ trans('dns::app.verify_domain') }}" class="btn btn-success" /> {{ trans('dns::app.verify_domain') }} </button>
                <button type="button" style="display:{{isset($domain_masking) && $domain_masking->is_verified == 1?'block;':'none;'}}" name="" class="btn btn-success" onClick="checkDomain();confirmClicked(1);">{{trans('domains.button.confirm')}}</button>
                <button id="dismiss_btn" type="button" class="btn btn-primary" data-dismiss="modal">{{trans('common.form.buttons.close')}}</button>
            </div>
        </div>
    </div>
</div>
@endsection