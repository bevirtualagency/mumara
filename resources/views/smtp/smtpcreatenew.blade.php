@extends(decide_template())

@section('title', $pageTitle )

@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/node-create-smtp.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
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
<script>
var error_message = "{{trans('common.message.opps')}}";
var redirect="{{ route('node.index') }}";
</script>
<script src="/themes/default/js/includes/smtp.js?t={{time()}}" type="text/javascript"></script>
<script>
    function showModalLog() {
        $('#debug_output').modal('show');
    }
    var validate_button ="{{trans('sending_nodes.add_new.form.validate')}}";
    var form_error="{{trans('common.message.form_error')}}";
    var groups_msg="{{trans('common.message.groups_created')}}";
    var token = "{{ csrf_token() }}";
    var node_id_db = "{{ $iid }}";
    // console.log(node_id_db);
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
          Command: toastr["success"] ("{{trans('sending_nodes.message.domain_url_copied')}}");
    }

        $( "#additional-settings" ).click(function() {
          $( ".custom-show" ).toggle();
        });

        $( "#additional-settings-sender" ).click(function() {
          $( ".custom-show-sender" ).toggle();
        });

        $("#username").on("change paste keyup", function() {
           $("#reply_email").val($("#reply_email").val());
           $("#from_email_part1").val($("#username").val());
        });


    $(window).on("load",function() {
        $("#p1 .bootstrap-switch").attr("id", "check1");
        $("#p2 .bootstrap-switch").attr("id", "check2");
        $("#p3 .bootstrap-switch").attr("id", "check3");
        //$("#p1 .bootstrap-switch .bootstrap-switch-container .bootstrap-switch-label").attr("id", "p11");
        var iid = $("#sending_node_id").val();
        if(iid == 5 || iid == 6 || iid == 7  || iid == 8) {
            $('.custom-show').hide();
            $('.custom-show-sender').hide();
        }
        var hss = $("#hss").val();
        var dbs = $("#dbs").val();
        var pds = $("#pds").val();
        var ahh = $("#ahh").val();

        if(hss == "on") {
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
        }

        if(ahh != ""){
            $(".mt-repeater").show();
         //   $(".mt-repeater-add").show();
         //   $(".new-btn").hide();
        }

    });

    //var switch_id

    $(document).ready(function() {

        $('.header_class').keydown(function(e) {
            if (e.keyCode == 32) {
                return false;
            }
        });

        $(document).on('change','#smtp_encryption',function(){
            if(this.value=="ssl" || this.value=="tls"){
                $('#smtp_options').show();
            }else{
                 $('#smtp_options').hide();
            }
        });
        if($("#action").val() == "add") {
            $("#span#select2-from_email_part2_id-container").html("@lang('sending_nodes.choose_domain')");
        }

        $(".new-btn").click(function(){
            $(this).remove();
            $(".mt-repeater").show();
            $("#btn-new").css("display", "flex");
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

        /*$('input[type=radio][name=pbounce]').change(function() {
          $("input[name='pbounce']").parent().removeClass("selected");
          $("input[name='pbounce']:checked").parent().addClass("selected");
        });*/

        $("#pbounce_status").click(function() {
            $("#phBncBlk").slideToggle();
            $("#dtlBlk").slideToggle();
        });

        $("#replyEmail .bootstrap-switch-label, #replyEmail .bootstrap-switch-default").click(function () {
            $("#reply_email").toggle(500);
            $("#reply_email").removeAttr("disabled", "disabled");
        });
        $("#replyEmail .bootstrap-switch-handle-on").click(function () {
            $("#reply_email").hide(500);
            $("#reply_email").attr("disabled", "disabled");
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
        $("#from_email_part2_id").change(function(){
            // if(node_id_db==1 || node_id_db==2 || node_id_db==3 || node_id_db==4){
                $.ajax({
                    url: '/broadcasts/change-masking-domain',
                    type: 'POST',
                    dataType: 'json',
                    data: {"_token": token,'tracking_domain':$("#from_email_part2_id").val(),'id':node_id_db},
                    success: function(result) {
                        if(result.status == 'success'){
                            $("#masked_domain_id").val(result.id);
                            $('#masked_domain_id').trigger('change');
                        }
                    }
                });
            // }

        });
         $("#masked_domain_id").change(function(){
            $("#masked_domain_id_error_message").hide().text('');
            $("#masked_domain_intec_id_error_message").hide().text('');
                $.ajax({
                    url: '/broadcasts/checkTrackingDomainStatus',
                    type: 'POST',
                    dataType: 'json',
                    data: {"_token": token,'masked_domain_id':$(this).val()},
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

    });

   /* function domainMailgun()
    {
        var domain = $("#domain_name").val();
        var url = 'http://' + domain + '/callbacks/mailgun';
        $("#copyurl").val(url);
    }*/
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
</script>
@endsection

@section(decide_content())

@if (Session::has('msg'))
<div class="alert alert-success" data-name="ZyGIEMcB">
    {{ Session::get('msg') }}
</div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="QwMOHpAE">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="qwLYwpVC">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>


<div class="row" data-name="WSRdtjyc">
    <div class="col-md-6  create-form wizardNew" data-name="lhEqmxzh">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid pb0" id="kt_content" data-name="HcoKFcVg">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="ZbwwnLzJ">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="IIKVzgCH">
                    <div class="kt-wizard-v4__nav-items" data-name="jTNWcIcr">
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="uvPOtgLT">
                                <div class="kt-wizard-v4__nav-number" data-name="LlKsORxB">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="oLLcCYdQ">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="aBPwiyMQ">
                                        {{trans('sending_nodes.add_new.account_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="zsZLenoH">
                                        {{trans('sending_nodes.add_new.account_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="auyoHQqS">
                                <div class="kt-wizard-v4__nav-number" data-name="oixYQbXB">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="lUMosHYG">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="vijWPZsH">
                                        {{trans('sending_nodes.add_new.sender_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="xkBLxJWz">
                                        {{trans('sending_nodes.add_new.sender_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="BFRbsWsY">
                                <div class="kt-wizard-v4__nav-number" data-name="MulXhdmM">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="XKvLYdhg">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="ikUZzTWL">
                                        {{trans('sending_nodes.add_new.connectivity_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="pkvmVcHo">
                                         {{trans('sending_nodes.add_new.connectivity_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="LYKrRgcL"> 
                                <div class="kt-wizard-v4__nav-number" data-name="tHVJOebp">
                                    4
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="djdZCUcO">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="mPHspQRs">
                                        {{trans('sending_nodes.add_new.settings_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="iFHrIYJg">
                                        {{trans('sending_nodes.add_new.settings_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="kt-portlet" data-name="OmSpMGLl">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="JarJOqIr">
                        <div class="kt-grid" data-name="uxnqUatD">

                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="OEoFXYvr">
                            @if ($page_data['action'] == 'add')
                                <form method="POST" id="smtp-frm" class="kt-form kt-form--label-right">
                                <input type="hidden" id="action" value="add">
                                    <input type="hidden"  name="node_id" value="0">
                            @else
                                <form action="{{ route('node.update', $smtp->id) }}" method="POST" id="smtp-frm" class="kt-form kt-form--label-right">
                                <input type="hidden" id="action" value="edit">
                                <input type="hidden" id="smtp-id" name="node_id" value="{{$smtp->id}}">
                                <input type="hidden" name="_method" value="PUT">
                            @endif
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="sending_node_id" id="sending_node_id" value="{{ $iid }}">
                                <input type="hidden" id="dbs" value="{{ isset($additional_settings->dbatch_status) ? $additional_settings->dbatch_status : '' }}">
                                <input type="hidden" id="hss" value="{{ isset($additional_settings->hourlyspeed_status) ? $additional_settings->hourlyspeed_status : '' }}">
                                <input type="hidden" id="pds" value="{{ isset($smtp->process_delivery_status) ? $smtp->process_delivery_status : '' }}">
                                <input type="hidden" id="ahh" value="{{ isset($additional_headers) ? 'data' : '' }}">

                                    <div class="form-body" data-name="ZrQpaPUS">

                                        <div class="tab-content" data-name="mFkivHuM">
                                            <div class="alert alert-danger display-none" data-name="sNBsyGzS">
                                                <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} </div>
                                            <div class="alert alert-success display-none" data-name="CxnDdUxP">
                                                <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} </div>



                                            @if($iid != 4)
                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="jvhgaBtX">
                                                <div class="kt-form__section kt-form__section--first" data-name="AzfCcoKZ">
                                                    <div class="kt-wizard-v4__form" data-name="SBjudPwM">

                                                        @if($iid == 2)
                                                            <div class="signme" data-name="gBaUNpiN">
                                                                {{trans('sending_nodes.signup',['app'=>"Sendgrid"])}}
                                                                <a href="https://signup.sendgrid.com/" target="_blank" class="">{{trans('sending_nodes.signup_here')}}.</a>
                                                            </div>
                                                        @endif
                                                        @if($iid == 3)
                                                            <div class="signme" data-name="AtjFYVAN">
                                                                {{trans('sending_nodes.signup',['app'=>"Mailgun"])}}
                                                                <a href="https://signup.mailgun.com/new/signup" target="_blank" class="">{{ trans('sending_nodes.signup_here') }}</a>
                                                            </div>
                                                        @endif


                                                        <div class="form-group row tab1heading" data-name="YYHLchPY">
                                                            <div class="col-md-12" data-name="OPeiNgkk">
                                                                <div class="kt-heading kt-heading--md" data-name="VyCvzygX">
                                                                    {{trans('sending_nodes.add_new.account_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.account_tab.form.description')}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="VLuRcVtc">
                                                            <label class="col-form-label pl12">
                                                                {{trans('common.label.status')}}
                                                                {!! popover('sending_nodes.add_new.form.status_help','common.description') !!}
                                                            </label>
                                                            @if((isset($smtp->status) && $smtp->status == 1) || Request::segment(3)=='add')
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                <label>
                                                                    <input type="checkbox" checked="checked" name="node_status">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            @else
                                                            <div class="col-md-8" data-name="BonMdbjg">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                    <label>
                                                                        <input type="checkbox" name="node_status">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                @if(isset($smtp->status) && $smtp->status == 2)
                                                                    {{ trans("sending_nodes.auto_inactive") }}
                                                                @endif

                                                            </div>
                                                            @endif

                                                        </div>

                                                        <div class="form-group row" data-name="HrdxwIsc">
                                                                
                                                            <div class="col-md-12" data-name="mkyLaKRJ">
                                                                <label class="col-form-label">
                                                                    {{trans('sending_nodes.add_new.form.node_name')}}
                                                                    <span class="required"> * </span>
                                                                     {!! popover('sending_nodes.add_new.form.node_name_help','common.description') !!}
                                                                </label>
                                                                <input type="text" name="name" class="form-control" value="{{isset($smtp->name) ? $smtp->name : '' }}" required />
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="form-group row" data-name="DLtdeptQ">
                                                            <div class="col-md-6" data-name="pCaOSRHu">
                                                                <label class="col-form-label">
                                                                    {{trans('common.label.group')}}
                                                                    <span class="required"> * </span>
                                                                    <span>
                                                                        <a href="#modal-group-label" data-toggle="modal"><i class="fa fa-plus-square text-success"></i></a>
                                                                    </span>
                                                                     {!! popover('common.label.group_help','common.description') !!}
                                                                </label>
                                                                <select class="form-control m-select2" data-placeholder="{{ trans('common.label.select_group') }}" name="group_id" id="group_id" required="">
                                                                    <option value="">{{ trans('common.label.select_group') }}</option>
                                                                    @foreach($groups as $group)
                                                                        <option value="{{ $group->id }}" {{ (isset($smtp->group_id) && $smtp->group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6" data-name="mtLmilxP">
                                                                <label class="col-form-label">
                                                                    {{trans('sending_nodes.add_new.form.mail_encoding')}}
                                                                    {!! popover('sending_nodes.add_new.form.mail_encoding_help','common.description') !!}
                                                                </label>
                                                                 <select  id="mail_encoding" name="mail_encoding" class="form-control">
                                                                    <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'quoted-printable') ? 'selected' : '' }} value="quoted-printable"> {{trans('sending_nodes.add_new.form.quoted_printable')}} </option>
                                                                    <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == '8bit') ? 'selected' : '' }} value="8bit"> {{trans('sending_nodes.add_new.form.8bit')}} </option>
                                                                    <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'base64') ? 'selected' : '' }} value="base64"> {{trans('sending_nodes.add_new.form.base64')}} </option>
                                                                    <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'binary') ? 'selected' : '' }} value="binary"> {{trans('sending_nodes.add_new.form.binary')}} </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            @else
                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="JuoPcOvM">
                                                <div class="kt-form__section kt-form__section--first" data-name="jrMGqkfJ">
                                                    <div class="kt-wizard-v4__form" data-name="TKHLFTqW">

                                                        @if($iid == 4)
                                                            <div class="signme" data-name="ZXMeuAkq">
                                                                {{trans('sending_nodes.signup',['app'=>"Amazon SES"])}}
                                                                <a href="https://portal.aws.amazon.com/gp/aws/developer/registration" target="_blank" class="">{{trans('sending_nodes.signup_here')}}</a>
                                                            </div>
                                                        @endif

                                                        <div class="form-group row tab1heading" data-name="HIPIwjja">
                                                            <div class="col-md-12" data-name="oVvhRdzA">
                                                                <div class="kt-heading kt-heading--md" data-name="TZEDwzfB">
                                                                   {{trans('sending_nodes.add_new.account_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.account_tab.form.description')}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="ivZVBXfl">
                                                            <div class="col-md-12" data-name="Ncaqwkqz">
                                                                <label class="col-form-label pl12">
                                                                    {{trans('common.label.status')}}
                                                                    {!! popover('sending_nodes.add_new.form.status_help','common.description') !!}
                                                                </label>
                                                                @if((isset($smtp->status) && $smtp->status == 1) || Request::segment(3)=='add')
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12" style="margin-top: 6px !important;">
                                                                    <label>
                                                                        <input type="checkbox" checked="checked" name="node_status">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                @else
                                                                <div class="col-md-6" data-name="fdcuhkRx">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                        <label>
                                                                            <input type="checkbox" name="node_status">
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                                @endif
                                                            </div>

                                                            <div class="col-md-6" data-name="Nccoikqz">
                                                                <label class="col-form-label">
                                                                    
                                                                    {{trans('sending_nodes.add_new.form.node_name')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.node_name_help','common.description') !!}
                                                                </label>
                                                                <input type="text" name="name" class="form-control" value="{{isset($smtp->name) ? $smtp->name : '' }}" required />
                                                            </div>
                                                            <div class="col-md-6" data-name="JCFlaJkD">
                                                                <label class="col-form-label">
                                                                    {{trans('common.label.group')}}
                                                                    <span class="required"> * </span>
                                                                    <span>
                                                                        <a href="#modal-group-label" data-toggle="modal"><i class="fa fa-plus-square text-success"></i></a>
                                                                    </span>
                                                                    {!! popover('common.label.group_help','common.description') !!}
                                                                </label>
                                                                <select class="form-control" data-placeholder="{{ trans('common.label.select_group') }}" name="group_id" id="group-id" required="">
                                                                    <option value="">{{ trans('common.label.select_group') }}</option>
                                                                    @foreach($groups as $group)
                                                                        <option value="{{ $group->id }}" {{ (isset($smtp->group_id) && $smtp->group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        @if($iid != 4)
                                                        <div class="form-group row" data-name="QfwJbGzH">
                                                                
                                                            <div class="col-md-6" data-name="eyuLIYtn">
                                                                <label class="col-form-label col-md-3">
                                                                    {{trans('common.label.username')}}
                                                                </label>
                                                                <input type="text" name="username" class="form-control" value="{{isset($smtp->name) ? $smtp->username : '' }}" />
                                                            </div>
                                                            <div class="col-md-6" data-name="zaZYImYS">
                                                                <label class="col-form-label">
                                                                    {{trans('common.label.password')}}
                                                                </label>
                                                                 <input type="password" name="password" id="password" value="{{isset($smtp->password) && !empty($smtp->password) ? Crypt::decrypt($smtp->password) : '' }}" class="form-control" />
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="wtqGeOEf">
                                                <div class="kt-form__section kt-form__section--first" data-name="QdXrNAll">
                                                    <div class="kt-wizard-v4__form" data-name="mMWsoNFn">

                                                        <div class="form-group col-md-12" data-name="FWTaYFBD">
                                                            <h3 class="m-form__heading-title">
                                                               {{trans('sending_nodes.add_new.sender_tab.form.heading')}}
                                                            </h3>
                                                            <p>{{trans('sending_nodes.add_new.sender_tab.form.description')}}</p>
                                                        </div>
                                                        <div class="form-group row" data-name="KQGnGCTm">
                                                            <div class="col-md-6" data-name="NKPucWoT">
                                                                <label class="col-form-label">
                                                                    {{trans('sending_nodes.add_new.form.sender_name')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.sender_name_help','common.description') !!}
                                                                </label>
                                                                <input required="" type="text" id="from_name" name="from_name" class="form-control" value="{{isset($smtp->from_name) ? $smtp->from_name : '' }}"  />
                                                            </div>
                                                        @if($iid == 5 || $iid == 6 || $iid == 7 || $iid == 8)
                                                            @if(moduleCheck('masking_domains'))
                                                                <div class="col-md-6" data-name="TXHjMReA">
                                                                    <label class="col-form-label">
                                                                        {{trans('sending_nodes.add_new.form.tracking_domain')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('sending_nodes.add_new.form.tracking_domain_help','common.description') !!}
                                                                    </label>
                                                                    <select class="form-control m-select2" name="masked_domain_id" id="masked_domain_id" required data-placeholder="{{trans('sending_nodes.add_new.form.choose_tracking_domain')}}">
                                                                        <option value="">{{trans('sending_nodes.add_new.form.choose_tracking_domain')}}</option>
                                                                        <?php 
                                                                            $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); 
                                                                            $masked_domain_id = $smtp->masked_domain_id;
                                                                        ?>
                                                                        @foreach($domain_maskings as $domain)
                                                                            
                                                                            @include('common.domain_list' , compact("domain" , "unauth_sending_domain" , "masked_domain_id"));

                                                                            
                                                                        @endforeach
                                                                    </select>
                                                                    <p class="text-danger" style="padding-top:5px;" id="masked_domain_id_error_message"></p>
                                                                    <p class="text-warning" style="padding-top:5px;" id="masked_domain_intec_id_error_message"></p>
                                                                </div>
                                                            @endif
                                                                <input type="hidden" class="form-control" id="from_email_part1" name="from_email_part1" value="{{ isset($from_email_part1) ? $from_email_part1 : '' }}" required />
                                                                <input type="hidden" class="form-control" name="bounce_email_id" value="0" required />
                                                        @endif

                                                        @if($iid != 5 && $iid != 6 && $iid != 7 && $iid != 8)
                                                                <div class="col-md-6" data-name="lgNhZobP">
                                                                    <label class="col-form-label">
                                                                        {{trans('sending_nodes.add_new.form.sender_email')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('sending_nodes.add_new.form.sender_email_help','common.description') !!}
                                                                    </label>
                                                                    <div class="row from-email" data-name="pPCGvtEX">
                                                                        <div class="col-md-6" data-name="FwQQGsIL">
                                                                            <div class="input-group" data-name="RuJBaaXA">
                                                                                <input type="text" class="form-control" id="from_email_part11" name="from_email_part1" value="{{ isset($from_email_part1) ? $from_email_part1 : '' }}" required />
                                                                                <div class="input-group-append" data-name="eAdSvpDX">
                                                                                    <span class="input-group-text" id="basic-addon2">@</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6" data-name="boMSGvCN">
                                                                            <div class="input-icon right cdmn" data-name="suidrFVS">
                                                                                <select class="form-control m-select2" data-placeholder="{{trans('sending_nodes.choose_domain')}}" name="from_email_part2" id="from_email_part2_id" required>
                                                                                    <option value="" selected="">{{trans('sending_nodes.choose_domain')}}</option>
                                                                                    <!-- <option value="{{ isset($from_email_part2) ? '@'.$from_email_part2 : ''  }}" selected>{{ isset($from_email_part2) ? $from_email_part2 : '' }}</option> -->
                                                                                    <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); ?>
                                                                                    @foreach($domain_maskings as $domain)
                                                                                    @include('common.domain_list_smtp_1' , compact("from_email_part2", "domain" , "unauth_sending_domain"));
                                                                                        
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 custom-show-sender" data-name="zoorerOt">
                                                                    <label class="col-form-label">
                                                                        {{trans('common.label.reply_email')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('common.label.reply_email_help','common.description') !!}
                                                                    </label>
                                                                    <input type="text" name="reply_email" id="reply_email" class="form-control" value="{{isset($smtp->reply_email) ? $smtp->reply_email : '' }}" required />
                                                                </div>
                                                                <?php 
                                                                        $license_attributes = json_decode(getSetting("license_attributes"), true);
                                                                        $license_type = "";
                                                                        if(!empty($license_attributes["package"])) { 
                                                                            $license_type = $license_attributes["package"];
                                                                        }
                                                                        $imap_switch = getApplicationSettings('imap_switch');
                                                                        if($license_type != "Commercial ESP" OR $imap_switch != 2) { 
                                                                 ?>
                                                                <div class="col-md-6" data-name="jOogILzs">
                                                                    <label class="col-form-label">
                                                                        {{trans('common.label.bounce_email')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('common.label.bounce_email_help','common.description') !!}
                                                                    </label>

                                                                    <select class="form-control m-select2" data-placeholder="{{ trans('sending_nodes.add_new.form.choose_bounce_email') }}" name="bounce_email_id" id="bounce_email_id">
                                                                        <option value="">{{ trans('sending_nodes.add_new.form.choose_bounce_email') }}</option>
                                                                        @foreach($bounce_emails as $bounce_email)
                                                                            <option value="{{ $bounce_email->id }}" {{ (isset($smtp->bounce_email_id) && $smtp->bounce_email_id == $bounce_email->id) ? 'selected' : '' }}>{{ $bounce_email->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <?php } ?>
                                                            @if(moduleCheck('masking_domains'))
                                                                @if($license_type != "Commercial ESP" OR $imap_switch != 2)
                                                                <div class="col-md-12" data-name="XJKhLrkB">
                                                                @else 
                                                                <div class="col-md-6" data-name="ThxDLnqc">
                                                                @endif
                                                                    <label class="col-form-label">
                                                                        {{trans('sending_nodes.add_new.form.tracking_domain')}}
                                                                        <span class="required"> * </span>
                                                                         {!! popover('sending_nodes.add_new.form.tracking_domain_help','common.description') !!}
                                                                    </label>
                                                                    <select class="form-control m-select2" name="masked_domain_id" id="masked_domain_id" required data-placeholder="{{ trans('sending_nodes.add_new.form.choose_tracking_domain') }}">
                                                                        <option>{{ trans('sending_nodes.add_new.form.choose_tracking_domain') }}</option>
                                                                        <?php 
                                                                            $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); 
                                                                            $masked_domain_id = $smtp->masked_domain_id;
                                                                        ?>  

                                                                        @foreach($domain_maskings as $domain)
                                                                            @include('common.domain_list' , compact("domain" , "unauth_sending_domain" , "masked_domain_id"));
                                                                        @endforeach
                                                                    </select>
                                                                    <p class="text-danger" style="padding-top:5px;" id="masked_domain_id_error_message"></p>
                                                                    <p class="text-warning" style="padding-top:5px;" id="masked_domain_intec_id_error_message"></p>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kt-wizard-v4__content connectivity-filter" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="CKaRURVZ">
                                                <div class="kt-form__section kt-form__section--first" data-name="JwCdiviP">
                                                    <div class="kt-wizard-v4__form" data-name="hlbcsTcz">

                                                        <div class="form-group row" data-name="tZxLRtjA">
                                                            @if($iid == 1 || $iid == 5 || $iid == 6 || $iid == 7 || $iid == 8)
                                                                @if($iid == 1 || $iid == 5 || $iid == 6 || $iid == 7 || $iid == 8)
                                                                @if($iid == 1)
                                                                    <div class="col-md-6" data-name="PPQiKyxF">
                                                                        <label class="col-form-label">
                                                                            {{trans('sending_nodes.add_new.form.host')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('sending_nodes.add_new.form.host_help','common.description') !!}
                                                                        </label>
                                                                         <input type="text" name="host" class="form-control" value="{{isset($smtp->host) ? $smtp->host : '' }}" required />
                                                                    </div>
                                                                @endif
                                                                    <div class="col-md-6" data-name="ESWRXCYK">
                                                                        <label class="col-form-label">
                                                                            @if($iid == 1)
                                                                                {{trans('common.label.username')}}
                                                                                <!-- <span class="required"> * </span> -->
                                                                            {!! popover('sending_nodes.add_new.form.username_help','common.description') !!}
                                                                            @else
                                                                            {{trans('sending_nodes.email_address')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('sending_nodes.email_address_help','common.description') !!}
                                                                                 
                                                                            @endif
                                                                        </label>
                                                                        <input type="text" name="username" id="username" class="form-control" value="{{isset($smtp->name) ? $smtp->username : '' }}" {{($iid == 5 || $iid == 6 || $iid == 7 || $iid == 8) ? 'required="required"' : '' }} />
                                                                    </div>
                                                                    <div class="col-md-6" data-name="dOIVaMqp">
                                                                        <label class="col-form-label">
                                                                            @if($iid == 1)
                                                                                {{trans('common.label.password')}}
                                                                            @else
                                                                                {{trans('common.label.password')}} <span class="required"> * </span>
                                                                            @endif
                                                                            {!! popover('sending_nodes.add_new.form.password_help','common.description') !!}
                                                                        </label>
                                                                         <input type="password" name="password" id="password" value="{{isset($smtp->password) && !empty($smtp->password) ? Crypt::decrypt($smtp->password) : '' }}" class="form-control" {{($iid == 5 || $iid == 6 || $iid == 7 || $iid == 8) ? 'required="required"' : '' }} />
                                                                    </div>
                                                                @php
                                                                $smtp_encryption = isset($smtp->smtp_encryption) ? $smtp->smtp_encryption : '';
                                                                @endphp

                                                                @if($iid == 5 || $iid == 6 || $iid == 7 || $iid == 8)
                                                                    <div class="col-md-12" data-name="aylQRGjC">
                                                                        <span id="additional-settings">
                                                                            <a href="javascript:;">
                                                                                {{trans('sending_nodes.add_new.settings_tab.form.heading')}}
                                                                            </a>
                                                                        </span>
                                                                    </div>
                                                                    @php
                                                                    if($page_data['action'] != 'edit') {
                                                                        if($iid == 5) {
                                                                            $port = '587';
                                                                            $smtp_host = 'smtp.gmail.com';
                                                                            $smtp_encryption = 'tls';
                                                                        } elseif($iid == 6) {
                                                                            $port = '587';
                                                                            //$smtp_host = 'smtp.live.com';
                                                                            $smtp_host = 'smtp-mail.outlook.com';
                                                                            $smtp_encryption = 'tls';
                                                                        } elseif($iid == 7) {
                                                                            $port = '587';
                                                                            $smtp_host = 'smtp.mail.yahoo.com';
                                                                            $smtp_encryption = 'tls';
                                                                        } elseif($iid == 8) {
                                                                            $port = '587';
                                                                            $smtp_host = 'smtp.aol.com';
                                                                            $smtp_encryption = 'tls';
                                                                        }
                                                                    }
                                                                    @endphp
                                                                @else
                                                                    @php
                                                                        $port = '';
                                                                        $smtp_host = '';
                                                                        $smtp_encryption = '';
                                                                    @endphp
                                                                @endif
                                                                    <div class="col-md-6 custom-show" data-name="MIBMUnBI">
                                                                        <label class="col-form-label">
                                                                            {{trans('sending_nodes.add_new.form.port')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('sending_nodes.add_new.form.port_help','common.description') !!}
                                                                        </label>
                                                                         <input type="number" name="port" class="form-control" value="{{isset($smtp->port) ? $smtp->port : $port }}" required />
                                                                    </div>
                                                                @endif

                                                                @if($iid == 5 || $iid == 6 || $iid == 7 || $iid == 8)
                                                                    <div class="col-md-6 custom-show" data-name="WQdbCkfv">
                                                                        <label class="col-form-label">
                                                                            {{trans('sending_nodes.add_new.form.host')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('sending_nodes.add_new.form.host_help','common.description') !!}
                                                                        </label>
                                                                         <input type="text" name="host" class="form-control" value="{{isset($smtp->host) ? $smtp->host : $smtp_host }}" required />
                                                                    </div>
                                                                @endif

                                                                @if($iid == 1 || $iid == 5 || $iid == 6 || $iid == 7 || $iid == 8)
                                                                <?php /*
                                                                    @if($iid ==0)
                                                                        <div class="col-md-6 custom-show">
                                                                            <label class="col-form-label">
                                                                                {{trans('sending_nodes.add_new.form.mail_encoding')}}
                                                                    {!! popover('sending_nodes.add_new.form.mail_encoding_help','sending_nodes.add_new.form.mail_encoding') !!}
                                                                            </label>
                                                                             <select  id="mail_encoding" name="mail_encoding" class="form-control">
                                                                                <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'quoted-printable') ? 'selected' : '' }} value="quoted-printable" > {{trans('sending_nodes.add_new.form.quoted_printable')}} </option>
                                                                                <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == '8bit') ? 'selected' : '' }} value="8bit"> {{trans('sending_nodes.add_new.form.8bit')}} </option>
                                                                                <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'base64') ? 'selected' : '' }} value="base64"> {{trans('sending_nodes.add_new.form.base64')}} </option>
                                                                                <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'binary') ? 'selected' : '' }} value="binary"> {{trans('sending_nodes.add_new.form.binary')}} </option>
                                                                            </select>
                                                                        </div>
                                                                    @endif
                                                                    */?>
                                                                        <div class="col-md-6 custom-show" data-name="AubiKled">
                                                                            <label class="col-form-label">
                                                                                {{trans('common.label.encryption')}}
                                                                                {!! popover('sending_nodes.add_new.form.encryption_help','common.description') !!}
                                                                            </label>
                                                                             <select class="form-control" name="smtp_encryption" id="smtp_encryption">
                                                                                <option value="">{{trans('common.label.none')}}</option>
                                                                                <option value="tls" {{ (isset($smtp->smtp_encryption) && $smtp->smtp_encryption == 'tls') ? 'selected': ((isset($smtp_encryption) && $smtp_encryption=='tls'?'selected':''))  }}>{{trans('common.label.tls')}}</option>
                                                                                <option value="ssl" {{ (isset($smtp->smtp_encryption) && $smtp->smtp_encryption == 'ssl') ? 'selected' : ((isset($smtp_encryption) && $smtp_encryption=='ssl'?'selected':'')) }}>{{trans('common.label.ssl')}}</option>
                                                                            </select>
                                                                        </div>
                                                                         <div data-name="aLclYrfL" @if(isset($smtp->smtp_encryption) && ($smtp->smtp_encryption == 'tls' || $smtp->smtp_encryption == 'ssl' ))  style="display:block;" @else style="display:none;" @endif class="col-md-12 custom-show" id="smtp_options">
                                                                            <div class="form-group smtp-ssl-option" data-name="RaGuyYLq">
                                                                                <label class="col-form-label" data-name="BhcpLCSp">
                                                                                    {{trans('sending_nodes.smtp_create_blade.self_signed_certificate_label')}} 
                                                                                </label>
                                                                                <label for="allow_self_signed" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" name="allow_self_signed" id="allow_self_signed" value="1" @if((isset($smtp->allow_self_signed) && $smtp->allow_self_signed == 1)) checked @endif>{{trans('sending_nodes.step_blade.yes_only_label')}}
                                                                                    <span></span>
                                                                                </label>

                                                                                <label for="allow_self_signed_no" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" name="allow_self_signed" id="allow_self_signed_no" value="0"@if((isset($smtp->allow_self_signed) && $smtp->allow_self_signed == 0)  || Request::segment(3)=='add') checked @endif>{{trans('sending_nodes.step_blade.no_only_label')}}
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-group smtp-ssl-option" data-name="jFUTHTTJ">
                                                                                <label class="col-form-label">
                                                                                   {{trans('sending_nodes.smtp_create_blade.verify_peer_certificate_label')}} 
                                                                                </label>
                                                                                <label for="verify_peer" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" name="verify_peer" id="verify_peer" value="1" @if((isset($smtp->verify_peer) && $smtp->verify_peer == 1)) checked @endif>{{trans('sending_nodes.step_blade.yes_only_label')}}
                                                                                    <span></span>
                                                                                </label>
                                                                                <label for="verify_peer_no" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" name="verify_peer" id="verify_peer_no" value="0" @if((isset($smtp->verify_peer) && $smtp->verify_peer == 0)  || Request::segment(3)=='add') checked @endif>{{trans('sending_nodes.step_blade.no_only_label')}}
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="form-group smtp-ssl-option" data-name="eQaIbcAY">
                                                                                <label class="col-form-label">
                                                                                    {{trans('sending_nodes.smtp_create_blade.verify_peer_name_label')}} 
                                                                                </label>
                                                                                <label for="verify_peer_name" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" name="verify_peer_name" id="verify_peer_name" value="1" @if((isset($smtp->verify_peer_name) && $smtp->verify_peer_name == 1)) checked @endif>{{trans('sending_nodes.step_blade.yes_only_label')}}
                                                                                    <span></span>
                                                                                </label>
                                                                                <label for="verify_peer_name_no" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" name="verify_peer_name" id="verify_peer_name_no" value="0" @if((isset($smtp->verify_peer_name) && $smtp->verify_peer_name == 0)  || Request::segment(3)=='add') checked @endif >{{trans('sending_nodes.step_blade.no_only_label')}}
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12" data-name="MtwAfXGx">
                                                                             <button type="button" class="btn btn-info" id="validate-smpt-send-mail">{{trans('sending_nodes.add_new.form.validate')}}</button>
                                                                            <div id="validate-mail-sent-msg" data-name="bKCqEmwm"></div>
                                                                            <span id="validate-mail-sent-log-link" style="display: none;"><a href="javascript:;">
                                                                                {{trans('sending_nodes.add_new.form.show_logs')}}
                                                                            </a></span>
                                                                            <div id="validate-mail-sent-log" style="display: none;" data-name="yqgpRTar"></div>
                                                                        </div>
                                                                    @if($iid == 5)
                                                                            <div class="col-md-12" data-name="YsNyoqXC">
                                                                                <div class="accordion accordion-solid accordion-toggle-plus mt18" id="accordionExample6" data-name="JkUjIWCs">
                                                                                    <div class="card" data-name="cDpMfJxG">
                                                                                        <div class="card-header" id="headingOne6" data-name="evhpllcG">
                                                                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="vuURTzUr">
                                                                                                <i class="flaticon2-copy"></i> {{trans('sending_nodes.problem_with_gmail.title')}}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="QPgtEosk">
                                                                                            <div class="card-body" data-name="qqHuNiHr">
                                                                                                <div class="helpheader" data-name="yJDGNpJF">
                                                                                                    <p>{{trans('sending_nodes.problem_with_gmail.method_gmail_smtp')}}</p>
                                                                                                </div>

                                                                                                <h3 class="m-form__heading-title">
                                                                                                    {{trans('sending_nodes.problem_with_gmail.method_one')}}:
                                                                                                </h3>
                                                                                                <h6 class="sbold">{{trans('sending_nodes.using_app_password')}}</h6>
                                                                                                <ol class="helpList">
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.go_to_your')}} <a href="https://myaccount.google.com/" target="_blank">{{trans('sending_nodes.problem_with_gmail.google_account')}}</a>.</li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.left_click_security')}}</li>
                                                                                                    <li>
                                                                                                        {{trans('sending_nodes.problem_with_gmail.signing_in_google_panel_password')}}:
                                                                                                        <ul class="helpListChild">
                                                                                                            <li>{{trans('sending_nodes.problem_with_gmail.not_set_up_for_your_account')}}</li>
                                                                                                            <li>{{trans('sending_nodes.problem_with_gmail.set_up_for_security_keys_only')}}</li>
                                                                                                        </ul>
                                                                                                    </li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.select_app_youre_using')}}</li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.select_device_youre_using')}}</li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.click_generate')}}</li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.use_your_password_gmail_validate')}}</li>
                                                                                                </ol>
                                                                                                <hr>
                                                                                                <h3 class="m-form__heading-title">
                                                                                                    {{trans('sending_nodes.method_two')}}:
                                                                                                </h3>
                                                                                                <ol class="helpList">
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.login_to_your')}} <a href="https://www.gmail.com/" target="_blank">{{trans('sending_nodes.problem_with_gmail.gmail_account')}}</a></li>
                                                                                                    <li>Go to <a href="https://myaccount.google.com/" target="_blank">{{trans('sending_nodes.problem_with_gmail.my_account')}}</a></li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.turn_off_2step_verification')}}</li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_gmail.turn_on_access_for')}} <a href="https://www.google.com/settings/security/lesssecureapps" target="_blank">{{trans('sending_nodes.problem_with_gmail.less_secure_apps_link')}}</a></li>
                                                                                                </ol>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    @endif
                                                                    @if($iid == 6)
                                                                            <div class="col-md-12" data-name="nTbOjStC">
                                                                                <div class="accordion accordion-solid accordion-toggle-plus mt18" id="accordionExample6" data-name="MbuvJlcs">
                                                                                    <div class="card" data-name="DOiqgoBm">
                                                                                        <div class="card-header" id="headingOne6" data-name="OpjOxjTk">
                                                                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="XcgcSUmI">
                                                                                                <i class="flaticon2-copy"></i> {{trans('sending_nodes.problem_with_hotmail.title')}}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="xlJgWllP">
                                                                                            <div class="card-body" data-name="vmjgZWFn">
                                                                                                <div class="helpheader" data-name="eDpVkbpw">
                                                                                                    <p>{{trans('sending_nodes.problem_with_hotmail.connect_hotmail_smtp')}}</p>
                                                                                                </div>
                                                                                                <h3 class="m-form__heading-title">
                                                                                                    {{trans('sending_nodes.method')}}:
                                                                                                </h3>
                                                                                                <h6 class="sbold">{{trans('sending_nodes.using_app_password')}}</h6>
                                                                                                <ol>
                                                                                                    <li>{{trans('sending_nodes.problem_with_hotmail.username_field_hotmail')}}</li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_hotmail.password_field_hotmail')}}</li>
                                                                                                </ol>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    @endif
                                                                    @if($iid == 7)
                                                                            <div class="col-md-12" data-name="xaecoQcs">
                                                                                <div class="accordion accordion-solid accordion-toggle-plus mt18" id="accordionExample6" data-name="FQcEtmEu">
                                                                                    <div class="card" data-name="ZwizYqjg">
                                                                                        <div class="card-header" id="headingOne6" data-name="HbqDrXSC">
                                                                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="qnkzKvSm">
                                                                                                <i class="flaticon2-copy"></i> {{trans('sending_nodes.problem_with_yahoo.title')}}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="yDArTEqN">
                                                                                            <div class="card-body" data-name="wNQTSqEP">
                                                                                                <div class="helpheader" data-name="bptTOGNq">
                                                                                                    <p>{{trans('sending_nodes.problem_with_yahoo.methods_to_use_yahoo_smtp')}}</p>
                                                                                                </div>
                                                                                                <h3 class="m-form__heading-title">
                                                                                                    {{trans('sending_nodes.problem_with_yahoo.method_one_recommended')}}
                                                                                                </h3>
                                                                                                <ol>
                                                                                                    <li><a href="https://login.yahoo.com/account/security" target="_blank">{{trans('sending_nodes.signin_to_go_security_page')}}</a>.</li>
                                                                                                    <li>{{trans('sending_nodes.turn_on_verification')}}</li>
                                                                                                    <li>{{trans('sending_nodes.generate_app_password')}}</li>
                                                                                                    <li>{{trans('sending_nodes.select_other_app')}}</li>
                                                                                                    <li>{{trans('sending_nodes.app_password_as_smtp')}}</li>
                                                                                                </ol>
                                                                                                <hr>
                                                                                                <h3 class="m-form__heading-title">
                                                                                                    {{trans('sending_nodes.method_two')}}:
                                                                                                </h3>
                                                                                                <h6 class="sbold">{{trans('sending_nodes.using_app_password')}}</h6>
                                                                                                <ol>
                                                                                                    <li><a href="https://login.yahoo.com/account/security" target="_blank">{{trans('sending_nodes.signin_to_go_security_page')}}</a></li>
                                                                                                    <li>{{trans('sending_nodes.turn_off_verification')}}</li>
                                                                                                    <li>{{trans('sending_nodes.enable_allow_apps')}}</li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_yahoo.yahoo_password_as_smtp')}}</li>
                                                                                                </ol>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    @endif
                                                                    @if($iid == 8)
                                                                            <div class="col-md-12" data-name="OZfvOivh">
                                                                                <div class="accordion accordion-solid accordion-toggle-plus mt18" id="accordionExample6" data-name="eGahmzQm">
                                                                                    <div class="card" data-name="kzsdetpR">
                                                                                        <div class="card-header" id="headingOne6" data-name="BGxFiYXl">
                                                                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="rzeojpQZ">
                                                                                                <i class="flaticon2-copy"></i> {{trans('sending_nodes.problem_with_aol.title')}}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="VrmoTfwX">
                                                                                            <div class="card-body" data-name="gADMCAmt">
                                                                                                <div class="helpheader" data-name="iMSOpmDt">
                                                                                                    <p>{{trans('sending_nodes.problem_with_aol.methods_to_use_aol_smtp')}}</p>
                                                                                                </div>
                                                                                                <h3 class="m-form__heading-title">
                                                                                                    {{trans('sending_nodes.problem_with_aol.method_one_recommended')}}:
                                                                                                </h3>
                                                                                                <ol>
                                                                                                    <li><a href="https://login.aol.com/account/security" target="_blank">{{trans('sending_nodes.signin_to_go_security_page')}}</a>.</li>
                                                                                                    <li>{{trans('sending_nodes.turn_on_verification')}}</li>
                                                                                                    <li>{{trans('sending_nodes.generate_app_password')}}</li>
                                                                                                    <li>{{trans('sending_nodes.select_other_app')}}</li>
                                                                                                    <li>{{trans('sending_nodes.app_password_as_smtp')}}</li>
                                                                                                </ol>
                                                                                                <hr>
                                                                                                <h3 class="m-form__heading-title">
                                                                                                    {{trans('sending_nodes.method_two')}}
                                                                                                </h3>
                                                                                                <h6 class="sbold">{{trans('sending_nodes.using_app_password')}}</h6>
                                                                                                <ol>
                                                                                                    <li><a href="https://login.aol.com/account/security" target="_blank">{{trans('sending_nodes.signin_to_go_security_page')}}</a></li>
                                                                                                    <li>{{trans('sending_nodes.turn_off_verification')}}</li>
                                                                                                    <li>{{trans('sending_nodes.enable_allow_apps')}}</li>
                                                                                                    <li>{{trans('sending_nodes.problem_with_aol.aol_password_as_smtp')}}</li>
                                                                                                </ol>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    @endif
                                                                @endif
                                                                
                                                                @elseif($iid == 3)
                                                                <div class="form-group row" data-name="gDbLwATn">
                                                                    <div class="col-md-12 tab1heading" data-name="raaYLQKp">
                                                                        <div class="kt-heading kt-heading--md" data-name="xCpJzoKq">
                                                                           {{trans('sending_nodes.connectivity.mailgun.title')}}
                                                                        </div>
                                                                        <p>{{trans('sending_nodes.connectivity.mailgun.description')}}</p>
                                                                    </div>
                                                                </div>
                                                                {{-- <div class="form-group row" data-name="wvPDSPHj">
                                                                    <label class="col-form-label col-md-3">
                                                                        {{trans('sending_nodes.domain_name')}}
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-8" data-name="jSuFveHK">
                                                                        <input type="text" name="domain_name" id="domain_name" class="form-control" value="{{isset($smtp->domain_name) ? $smtp->domain_name : '' }}" required onBlur="domainMailgun()" />
                                                                        <div class="form-text text-muted" data-name="nEJoVwMb">{{trans('sending_nodes.domain_name_eg')}}</div>
                                                                    </div>
                                                                    
                                                                </div>--}}
                                                                <div class="form-group col-md-12" data-name="ScXDQUHV">
                                                                    <div class="row" data-name="CpkhCmWq">
                                                                        <label class="col-form-label">
                                                                            {{trans('sending_nodes.api_key')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('sending_nodes.api_key_help','common.description',['app'=>'Mailgun']) !!}
                                                                        </label>
                                                                        <input type="text" required name="api_key" id="api_key" value="{{isset($smtp->api_key) ? $smtp->api_key : '' }}" class="form-control" />
                                                                        <div class="form-text text-muted" data-name="tHJsyklA">{{trans('sending_nodes.smtp_create_blade.eg_txt_key_div')}}</div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group  col-md-12" data-name="ZsaoGBeL">
                                                                    <div class="row" data-name="ykrFHkWN">
                                                                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6" data-name="tQmWNmXO">
                                                                            <div class="card" data-name="RFsiYNQJ">
                                                                                <div class="card-header" id="headingOne6" data-name="PYUziaiA">
                                                                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="wUeRzywZ">
                                                                                        <i class="flaticon2-copy"></i> {{trans('sending_nodes.api_key_link')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="XZQwZqir">
                                                                                    <div class="card-body" data-name="LDkZYYPA">
                                                                                        <h3 class="m-form__heading-title">
                                                                                             {{trans('sending_nodes.get_api_keys',['app' =>"Mailgun"])}}
                                                                                        </h3>
                                                                                        @lang('sending_nodes.connectivity.mailgun.api_key_find_help')
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="jQfNtRvv">
                                                                    <label class="col-form-label pl12">
                                                                        {{trans('sending_nodes.process_delivery_reports')}}
                                                                        {!! popover('sending_nodes.process_delivery_reports_help','common.description') !!}
                                                                    </label>
                                                                    @if(isset($smtp->process_delivery_status) && $smtp->process_delivery_status == 1)
                                                                    <div class="col-md-8" id="p1" data-name="kXxAuNPF">
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                                    @else
                                                                        
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                        <label>
                                                                            <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group row" data-name="GQgznCtG">
                                                                    <div class="col-md-12 kt-radio-list" id="phBncBlk" data-name="NUGeNmsW">
                                                                        @php
                                                                            $pbounce = isset($smtp->process_delivery_reports) ? $smtp->process_delivery_reports : '';
                                                                        @endphp
                                                                        <label class="pbounceopt kt-radio" for="pbo2">
                                                                            <input type="radio" name="pbounce" id="pbo2" value="WebHooks" checked="checked" {{ isset($pbounce) && $pbounce == 'WebHooks' ? 'checked' : 'checked="checked"' }}>
                                                                             {{trans('sending_nodes.connectivity.sendgrid.form.webhooks_recommended')}}
                                                                            <span></span>
                                                                            {!! popover('sending_nodes.connectivity.sendgrid.form.webhooks_recommended_help','common.description') !!}
                                                                        </label>
                                                                        <!-- <span class="pbounceopt">
                                                                            <input type="radio" name="pbounce" id="pbo3" value="API" {{ isset($pbounce) && $pbounce == 'API' ? 'checked' : '' }}>
                                                                            <label for="pbo3">{{trans('app.smtp_management.add_new.tabs.mailgun.api')}}</label>
                                                                        </span>
                                                                        <span class="pbounceopt">
                                                                            <input type="radio" name="pbounce" id="pbo4" value="POP/IMAP" {{ isset($pbounce) && $pbounce == 'POP/IMAP' ? 'checked' : '' }}>
                                                                            <label for="pbo4">{{trans('app.smtp_management.add_new.tabs.mailgun.pop')}}</label>
                                                                        </span> -->
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="TTGPjbaR">
                                                                    <div class="col-md-12" id="dtlBlk" data-name="qwErOPlz">
                                                                        <div class="pbo11 hide" data-name="lkEZgnSx">
                                                                            <h3 class="m-form__heading-title"></h3>
                                                                            <p></p>
                                                                        </div>
                                                                        <div class="pbo22 show" data-name="ugeeWqIR">

                                                                            <h3 class="m-form__heading-title">
                                                                            {{trans('sending_nodes.process_details_title',['app'=>"Mailgun"])}}
                                                                            </h3>
                                                                           @lang('sending_nodes.connectivity.mailgun.api_configure_help')
                                                                            @php
                                                                                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".'/callbacks/mailgun';
                                                                            @endphp
                                                                            @if(isset($smtp->domain_name))
                                                                              @php
                                                                                $url = $actual_link;
                                                                              @endphp
                                                                            @endif

                                                                            <div class="urldmn" data-name="SYRkvkmc"><input type="text" id="copyurl" class="form-control" name="" value="{{ isset($url) ? $url : $actual_link }}" readonly="" ><i class="fa fa-copy" title="{{trans('sending_nodes.connectivity.sendgrid.form.click_copy_button')}}" onclick="copyFunction()"></i></div>
                                                                        </div>
                                                                        <div class="pbo33 hide" data-name="AFcksXnB">
                                                                            <h3 class="m-form__heading-title"></h3>
                                                                            <p></p>
                                                                        </div>
                                                                        <div class="pbo44 hide" data-name="ClXbyAiv">
                                                                            <h3 class="m-form__heading-title"></h3>
                                                                            <p></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($iid == 2)
                                                                <div class="form-group col-md-12" data-name="sWKRydeM">
                                                                    <h3 class="m-form__heading-title">
                                                                        {{trans('sending_nodes.connectivity.sendgrid.title')}}
                                                                    </h3>
                                                                    <p>{{trans('sending_nodes.connectivity.sendgrid.description')}}</p>
                                                                </div>
                                                                <div class="form-group col-md-12" data-name="qwXprSyU">
                                                                    <div class="row" data-name="FimYwTsL">
                                                                        <label class="col-form-label">
                                                                            {{trans('sending_nodes.api_key')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('sending_nodes.api_key_help','common.description',['app'=>'SendGrid']) !!}
                                                                        </label>
                                                                        <input type="text" required name="api_key" id="api_key" value="{{isset($smtp->api_key) ? $smtp->api_key : '' }}" class="form-control" />
                                                                        <div class="form-text text-muted" data-name="UDdUZhUr"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12" data-name="qigDAcYm">
                                                                    <div class="row" data-name="DtAdOPlI">
                                                                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6" data-name="dfmvnhRZ">
                                                                            <div class="card" data-name="VaYMMMTs">
                                                                                <div class="card-header" id="headingOne6" data-name="dUjWblZS">
                                                                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="JCoxWlah">
                                                                                        <i class="flaticon2-copy"></i> {{trans('sending_nodes.api_key_link')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="hIouNGeE">
                                                                                    <div class="card-body" data-name="YiMKYMov">
                                                                                        <h3 class="m-form__heading-title">
                                                                                            {{trans('sending_nodes.get_api_keys',['app' =>"SendGrid"])}}
                                                                                        </h3>
                                                                                            <ol>
                                                                                                <li><a href="https://app.sendgrid.com/login" target="_blank">{{trans('common.label.login')}}</a> {{trans('sending_nodes.connectivity.sendgrid.form.to_your_sendgrid_account')}}</li>
                                                                                                <li>{{trans('sending_nodes.connectivity.sendgrid.form.navigate_to_settings')}} -> <a href="https://app.sendgrid.com/settings/api_keys" target="_blank">{{trans('sending_nodes.connectivity.sendgrid.form.api_key')}}</a></li>
                                                                                                <li>{{trans('sending_nodes.connectivity.sendgrid.form.create_api_key')}}</li>
                                                                                            </ol>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="ZBRarFiC">
                                                                    <label class="col-form-label pl12">
                                                                        {{trans('sending_nodes.process_delivery_reports')}}
                                                                        {!! popover('sending_nodes.process_delivery_reports_help','common.description') !!}
                                                                    </label>
                                                                    @if(isset($smtp->process_delivery_status) && $smtp->process_delivery_status == 1)
                                                                        
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                                <span></span>
                                                                            </label>
                                                                    @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="form-group row" data-name="vSACiFPZ">
                                                                    <div class="col-md-8 kt-radio-list" id="phBncBlk" data-name="DNeMAZXt">
                                                                        @php
                                                                            $pbounce = isset($smtp->process_delivery_reports) ? $smtp->process_delivery_reports : '';
                                                                        @endphp
                                                                        <label class="pbounceopt kt-radio" for="pbo2">
                                                                            <input type="radio" name="pbounce" id="pbo2" value="WebHooks" checked="checked" {{ isset($pbounce) && $pbounce == 'WebHooks' ? 'checked' : 'checked="checked"' }}>
                                                                            <span></span>
                                                                            {{trans('sending_nodes.connectivity.sendgrid.form.webhooks_recommended')}}
                                                                            {!! popover('sending_nodes.connectivity.sendgrid.form.webhooks_recommended_help','common.description') !!}
                                                                        </label>
                                                                        <!-- <span class="pbounceopt">
                                                                            <input type="radio" name="pbounce" id="pbo3" value="API" {{ isset($pbounce) && $pbounce == 'API' ? 'checked' : '' }}>
                                                                            <label for="pbo3">{{trans('app.smtp_management.add_new.tabs.mailgun.api')}}</label>
                                                                        </span>
                                                                        <span class="pbounceopt">
                                                                            <input type="radio" name="pbounce" id="pbo4" value="POP/IMAP" {{ isset($pbounce) && $pbounce == 'POP/IMAP' ? 'checked' : '' }}>
                                                                            <label for="pbo4">{{trans('app.smtp_management.add_new.tabs.mailgun.pop')}}</label>
                                                                        </span> -->
                                                                    </div>
                                                                    <div class="col-md-12" id="dtlBlk" data-name="AnvDEOqw">
                                                                        <div class="pbo11 hide" data-name="imPVZhlJ">
                                                                            <h3 class="m-form__heading-title"></h3>
                                                                            <p></p>
                                                                        </div>
                                                                        <div class="pbo22 show" data-name="PSzMqoIL">

                                                                            <h3 class="m-form__heading-title">
                                                                                @php
                                                                                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".'/callbacks/sendgrid';
                                                                                @endphp
                                                                            {{trans('sending_nodes.process_details_title',['app'=>"Sendgrid"])}}
                                                                            </h3>
                                                                            <ol>
                                                                                <li><a href="https://app.sendgrid.com/login" target="_blank">{{trans('common.label.login')}}</a> {{trans('sending_nodes.connectivity.sendgrid.form.to_your_sendgrid_account')}}</li>
                                                                                <li>{{trans('sending_nodes.connectivity.sendgrid.form.navigate_to_settings')}} -> <a href="https://app.sendgrid.com/settings/mail_settings" target="_blank">{{trans('sending_nodes.connectivity.sendgrid.form.mail_settings')}}</a>.</li>
                                                                                <li>{{trans('sending_nodes.connectivity.sendgrid.form.turn_on_notification')}}</li>
                                                                            </ol>

                                                                            @if(isset($smtp->domain_name))
                                                                              @php
                                                                                $url = $actual_link;
                                                                              @endphp
                                                                            @endif

                                                                            <div class="urldmn" data-name="tTcdOouV"><input type="text" id="copyurl" class="form-control" name="" value="{{ isset($url) ? $url : $actual_link }}" readonly="" ><i class="fa fa-copy" title="{{trans('sending_nodes.connectivity.sendgrid.form.click_copy_button')}}" onclick="copyFunction()" ></i></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @elseif($iid == 4)
                                                                <div class="form-group col-md-12" data-name="PdRfNZYP">
                                                                    <h3 class="m-form__heading-title">
                                                                        {{trans('sending_nodes.connectivity.amazon.title')}}
                                                                    </h3>
                                                                    <p>{{trans('sending_nodes.connectivity.amazon.description')}}</p>
                                                                </div>
                                                                <div class="form-group col-md-12" data-name="lYuROuCV"> 
                                                                    <div class="row" data-name="HWqkLJeu">
                                                                        <label class="col-form-label">
                                                                            {{trans('sending_nodes.connectivity.amazon.form.access_key_id')}}
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <input type="text" name="domain_name" id="domain_name" class="form-control" value="{{isset($smtp->domain_name) ? $smtp->domain_name : '' }}" required onBlur="domainMailgun4()" />
                                                                        <div class="form-text text-muted" data-name="qFzTIxgR"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12" data-name="fFTWpxYw">
                                                                    <div class="row" data-name="xMmXBdly">
                                                                        <label class="col-form-label">
                                                                            {{trans('sending_nodes.connectivity.amazon.form.secret_access_key')}}
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <input type="text" required name="api_key" id="api_key" value="{{isset($smtp->api_key) ? $smtp->api_key : '' }}" class="form-control" />
                                                                        <div class="form-text text-muted" data-name="bijiUmAo"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12" data-name="GcVpCnyM">
                                                                    <div class="row" data-name="KraUDCVc">
                                                                        <label class="col-form-label">
                                                                           @lang('sending_nodes.connectivity.amazon.form.region.title')
                                                                        </label>
                                                                         <select class="form-control m-select2" name="amazon_region" id="amazon_region" required data-placeholder="Choose Region">
                                                                            <option value="us-east-2" {{ (isset($smtp->host) && $smtp->host == 'us-east-2') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt1')</option>
                                                                            <option value="us-east-1" {{ (isset($smtp->host) && $smtp->host == 'us-east-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt2')</option>
                                                                            <option value="us-west-1" {{ (isset($smtp->host) && $smtp->host == 'us-west-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt3')</option>
                                                                            <option value="us-west-2" {{ (isset($smtp->host) && $smtp->host == 'us-west-2') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt4')</option>
                                                                            <option value="ap-south-1" {{ (isset($smtp->host) && $smtp->host == 'ap-south-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt5')</option>
                                                                            <option value="ap-northeast-3" {{ (isset($smtp->host) && $smtp->host == 'ap-northeast-3') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt6')</option>
                                                                            <option value="ap-northeast-2" {{ (isset($smtp->host) && $smtp->host == 'ap-northeast-2') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt7')</option>
                                                                            <option value="ap-southeast-1" {{ (isset($smtp->host) && $smtp->host == 'ap-southeast-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt8')</option>
                                                                            <option value="ap-southeast-2" {{ (isset($smtp->host) && $smtp->host == 'ap-southeast-2') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt9')</option>
                                                                            <option value="ap-northeast-1" {{ (isset($smtp->host) && $smtp->host == 'ap-northeast-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt10')</option>
                                                                            <option value="ca-central-1" {{ (isset($smtp->host) && $smtp->host == 'ca-central-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt11')</option>
                                                                            <option value="cn-north-1" {{ (isset($smtp->host) && $smtp->host == 'cn-north-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt12')</option>
                                                                            <option value="cn-northwest-1" {{ (isset($smtp->host) && $smtp->host == 'cn-northwest-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt13')</option>
                                                                            <option value="eu-central-1" {{ (isset($smtp->host) && $smtp->host == 'eu-central-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt14')</option>
                                                                            <option value="eu-west-1" {{ (isset($smtp->host) && $smtp->host == 'eu-west-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt15')</option>
                                                                            <option value="eu-west-2" {{ (isset($smtp->host) && $smtp->host == 'eu-west-2') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt16')</option>
                                                                            <option value="eu-west-3">@lang('sending_nodes.connectivity.amazon.form.region.opt17')</option>
                                                                            <option value="eu-north-1" {{ (isset($smtp->host) && $smtp->host == 'eu-north-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt18')</option>
                                                                            <option value="sa-east-1" {{ (isset($smtp->host) && $smtp->host == 'sa-east-1') ? 'selected' : '' }}>@lang('sending_nodes.connectivity.amazon.form.region.opt19')</option>
                                                                         </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12" data-name="oTcCjerL">
                                                                    <div class="row" data-name="mhfUtrNf">
                                                                        <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6" data-name="WTCCkRFO">
                                                                            <div class="card" data-name="FjonQFGn">
                                                                                <div class="card-header" id="headingOne6" data-name="JMHmSnjo">
                                                                                    <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="husEGudG">
                                                                                        <i class="flaticon2-copy"></i> {{trans('sending_nodes.api_key_link')}}
                                                                                    </div>
                                                                                </div>
                                                                                <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="vizgeLli">
                                                                                    <div class="card-body" data-name="clxYvezL">
                                                                                        <h3 class="m-form__heading-title">
                                                                                            {{trans('sending_nodes.connectivity.amazon.form.get_api_keys')}}
                                                                                        </h3>
                                                                                       @lang('sending_nodes.connectivity.amazon.form.how_to_get_api_keys')
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group col-md-12" data-name="pUiFSLxF">
                                                                        
                                                                    <div class="row" id="p1" data-name="evXgjtdg">
                                                                        <label class="col-form-label pl12">
                                                                             {{trans('sending_nodes.process_delivery_reports')}}
                                                                        {!! popover('sending_nodes.process_delivery_reports_help','common.description') !!} 
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="jLJyfLnn">
                                                                    <div class="col-md-12 kt-radio-list" id="phBncBlk" data-name="biumVSBD">
                                                                        <label class="pbounceopt kt-radio" for="pbo2">
                                                                            <input type="radio" name="pbounce" id="pbo2" value="WebHooks" checked="checked">
                                                                            {{trans('sending_nodes.connectivity.amazon.form.simple_notification_service')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <div class="pbo22 show" data-name="NLprkVsn">
                                                                             @php
                                                                                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".'/callbacks/amazonses';
                                                                                @endphp
                                                                            <h3 class="m-form__heading-title">{{trans('sending_nodes.connectivity.amazon.form.process_delivery_reports_using_sns')}}</h3>
                                                                           @lang('sending_nodes.connectivity.amazon.form.configure_sns',['url'=>$actual_link])
                                                                            <div class="form-group" id="pro3Blk" data-name="TGIqsrCq">
                                                                                <a id="confirm-sub-amazon" href="#" target="_blank"><button type="button" id="process3" class="btn btn-info btn-sm" disabled="">{{trans('sending_nodes.connectivity.amazon.form.confirm_subscription')}}</button></a>
                                                                            </div>

                                                                            <div class="form-group" data-name="smbYBCsL">
                                                                                {{trans('sending_nodes.connectivity.amazon.form.you_are_all_set_now')}}
                                                                            </div>
                                                                            <div class="form-group" data-name="RErAFjrw">
                                                                                <label class="col-form-label sbold pull-left">{{trans('sending_nodes.connectivity.amazon.form.configuration_set_name')}}</label>
                                                                                <div class="col-md-8" data-name="WJdtkdCH">
                                                                                    <input type="text" class="form-control" id="config_name" name="config_name" value="{{!empty($amazon_header_type) ? $amazon_header_type : ''}}">
                                                                                    <div class="form-text text-muted" data-name="jCqcmTlI">
                                                                                        {{trans('sending_nodes.connectivity.amazon.form.configuration_set_name_step4')}}
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="huVOzraT">
                                                <div class="kt-form__section kt-form__section--first" data-name="WNTlMFnc">
                                                    <div class="kt-wizard-v4__form" data-name="CWNfCpfX">

                                                        <div class="form-group row" data-name="oaRMKldb">
                                                            <div class="col-md-12" data-name="MSzUVQlB">
                                                                <div class="kt-heading kt-heading--md" data-name="OYAXixZw">
                                                                    {{trans('sending_nodes.add_new.settings_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.settings_tab.form.description')}} <br />
                                                                <small>{{trans('sending_nodes.add_new.settings_tab.form.note')}}</small>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div id="kt_repeater_3" data-name="ymfiXAJx">
                                                            <div class="form-group row mb0" data-name="GacVvoJt">
                                                                <label class="col-form-label col-md-3">
                                                                    {{trans('sending_nodes.add_new.form.additional_headers')}} 
                                                                    {!! popover('sending_nodes.add_new.form.additional_headers_help','common.description') !!}
                                                                     <br>
                                                                </label>
                                                                <div class="col-md-12" data-repeater-list="subscriber_filter" data-name="peVIZZUq">
                                                                   @if(isset($additional_headers) and is_array($additional_headers))
                                                                    <div class="mt-repeater" style="display: none;" data-name="qibukKay">
                                                                        <div data-repeater-item data-name="bIRjcpqN">
                                                                        @foreach($additional_headers as $key => $value)
                                                                            <div data-repeater-item="" class="mt-repeater-item" data-name="jBPUjDXt">
                                                                                <div class="row mt-repeater-row" data-name="aufbUvry">
                                                                                    <div class="col-md-6" data-name="xPdGYNKw">
                                                                                        <input type="text" name="header" placeholder="Header" class="form-control header_class" value="{{ isset($value->header) ? $value->header : '' }}">
                                                                                        <span class="clnfld">:</span>
                                                                                    </div>
                                                                                    <div class="col-md-6" data-name="TDMYGezR">
                                                                                        <input type="text" name="header_value" placeholder="Value" class="form-control" value="{{ isset($value->header_value) ? $value->header_value : ''  }}">
                                                                                    </div>
                                                                                    <div class="col-md-1" data-name="vSqJwsCR">
                                                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <div class="mt-repeater" style="display: none;" data-name="ZYQIJigW">
                                                                        <div data-repeater-item="" class="mt-repeater-item" data-name="UhBHLoUU">
                                                                            <div class="row mt-repeater-row" data-name="hZPGhPnd">
                                                                                <div class="col-md-6" data-name="gqezPhKT">
                                                                                    <input type="text" name="header" placeholder="Header" class="form-control header_class" value="">
                                                                                    <span class="clnfld">:</span>
                                                                                </div>
                                                                                <div class="col-md-6" data-name="qzlreRmS">
                                                                                    <input type="text" name="header_value" placeholder="Value" class="form-control" value="">
                                                                                </div>
                                                                                <div class="col-md-1" data-name="EJauZBQH">
                                                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                    <a href="javascript:;" class="btn btn btn-info btn-sm new-btn">
                                                                        <i class="la la-plus"></i> {{ trans('common.form.buttons.add_new') }}
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="row" id="btn-new" data-name="lbQdFVxm">
                                                                <div class="col" data-name="QYfixfCl">
                                                                    <div data-repeater-create="" class="btn btn btn-info btn-sm" data-name="YxKVBXOG">
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
                                        </div>
                                    </div>
                                    <div class="kt-form__actions" data-name="HmbAseuD">
                                        <div class="btn btn-secondary btn-md" data-ktwizard-type="action-prev" data-name="qbWiDUwT">
                                            {{trans('common.form.buttons.back')}}
                                        </div>
                                        <div class="btn btn-success btn-md" data-ktwizard-type="action-submit" data-name="muxqhvmO">
                                            {{trans('common.form.buttons.submit')}}
                                        </div>
                                        <div class="btn btn-success btn-md" data-ktwizard-type="action-next" data-name="UVfdbXGN">
                                            {{trans('common.form.buttons.continue')}}
                                        </div>
                                    </div>
                                </form>
                                <div class="tab-pane" id="tabSuccess" data-name="KecOFwII">
                                    <div class="text-success" data-name="QSuzLtBN">
                                        <i class="fa fa-thumbs-up"></i>
                                        <h2>{{trans('sending_nodes.message.congratulations')}}</h2>
                                        <h4>
                                            {{trans('sending_nodes.message.success_node_configure')}}
                                        </h4>
                                        <a href="{{ route('node.index') }}" class="btn btn-success">{{trans('sending_nodes.sending_nodes')}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="col-md-6 create-form" id="testmail" @if($page_data['action'] != 'edit') style="display: none;" @endif data-name="YfkCTfMY">
    <div class="kt-content" data-name="CMZmVPim">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="vfdqfMQn">
            <div class="kt-portlet__head" data-name="HCvfSkYW">
                <div class="kt-portlet__head-label" data-name="ZumlOHto">
                    <h3 class="kt-portlet__head-title">
                        {{trans('sending_nodes.test_email.form.heading')}}
                    </h3>
                </div>
            </div>
            <!-- BEGIN FORM-->
            <div class="kt-portlet__body" data-name="cJDaTdCI">
                <form action="" method="POST" id="smtp-validation-frm" class="kt-form kt-form--label-right">
                    <div class="row" data-name="ACtxTHMK">
                        <div class="col-md-12" data-name="FoGxJmEG">
                            <div class="form-group row" data-name="IvguEBAS">
                                <label class="col-form-label col-md-3" style="text-align: right !important;">{{trans('sending_nodes.test_email.form.heading')}}
                                </label>
                                <div class="col-md-7" data-name="crJScMRz">
                                    <div class="input-icon right" data-name="kxWabFxJ">
                                        <input type="text" placeholder="{{trans('common.label.email_address')}}" name="smtp_email" id="smtp_email" class="form-control" value="" />
                                    </div>
                                    <div id="mail-sent-msg" data-name="pUSHVyFp"></div>
                                </div>
                               
                            </div>
                            @if(isset($phpMailer) && $phpMailer)
                                <div class="form-group row" data-name="SlzYzTGN">
                                    <label class="col-form-label col-md-3" style="text-align: right !important;">
                                    </label>
                                    <div class="col-md-7" data-name="sBwCaPrg">
                                    <div class="input-icon right" data-name="ThXMDcLq">
                                        <input  type="checkbox"   id="php_mailer" name="php_mailer" value="1">   {{trans('sending_nodes.test_email.form.get_debug_log')}}
                                        <span></span>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row" data-name="PGalIRvi">
                                    <label class="col-form-label col-md-3" style="text-align: right !important;">
                                    </label>
                                <div class="col-md-7" data-name="hZMBcKdI">
                                    <span id="modal_span"  style="display: none;"><a onclick="showModalLog()" href="javascript:;">
                                        {{trans('sending_nodes.test_email.form.debug_log')}}
                                    </a></span>
                                    <div id="mail-sent-log" style="display: none;" data-name="QoujJPen"></div>
                                </div>
                                </div>

                            @endif
                            <div class="form-group row" data-name="KfcMPFES">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-8" data-name="uoFJIgmP">
                                    <button type="button" class="btn btn-success" id="smpt-send-mail">{{trans('sending_nodes.test_email.form.heading')}}</button>
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

@if($iid == 5)
    <div id="slider" class="iid5" style="right:-500px;" data-name="FngiGznh">
        <div id="sidebar" onclick="open_panel()" data-name="zarBzPne">
            <img src="{{ URL('resources/assets/images/help.png') }}" alt="{{trans('common.label.need_help')}}" title="{{trans('common.label.need_help')}}" />
        </div>
        <div id="heads" data-name="blDsfieg">
            <button type="button" class="close" onclick="close_panel2()">&times;</button>
            <div class="kt-portlet kt-portlet--height-fluid" id="helpBlk" data-name="QLAPHoED">
                <div class="kt-portlet__head" data-name="TzZueodz">
                    <div class="kt-portlet__head-label" data-name="XjgPHxJQ">
                        <h3 class="kt-portlet__head-title">
                            {{trans('sending_nodes.smtp.problem_with_gmail.title')}}
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="JHwwvQuT">
                    <div class="helpheader" data-name="cnJlVYEq">
                        <p>{{trans('sending_nodes.problem_with_gmail.method_gmail_smtp')}}</p>
                    </div>
                    <hr>
                    <b>{{trans('sending_nodes.problem_with_gmail.method_one')}}:</b>
                    <h4 class="sbold">{{trans('sending_nodes.using_app_password')}}</h4>
                    <ul class="helpList">
                        <li>{{trans('sending_nodes.problem_with_gmail.go_to_your')}} <a href="https://myaccount.google.com/" target="_blank">{{trans('sending_nodes.problem_with_gmail.google_account')}}</a>.</li>
                        <li>{{trans('sending_nodes.problem_with_gmail.left_click_security')}}</li>
                        <li>
                            {{trans('sending_nodes.problem_with_gmail.signing_in_google_panel_password')}}:
                            <ul class="helpListChild">
                                <li>{{trans('sending_nodes.problem_with_gmail.not_set_up_for_your_account')}}</li>
                                <li>{{trans('sending_nodes.problem_with_gmail.set_up_for_security_keys_only')}}</li>
                            </ul>
                        </li>
                        <li>{{trans('sending_nodes.problem_with_gmail.select_app_youre_using')}}</li>
                        <li>{{trans('sending_nodes.problem_with_gmail.select_device_youre_using')}}</li>
                        <li>{{trans('sending_nodes.problem_with_gmail.click_generate')}}</li>
                        <li>{{trans('sending_nodes.problem_with_gmail.use_your_password_gmail_validate')}}</li>
                    </ul>

                    <hr>

                    <b>Method 2:</b>
                    <ul class="helpList">
                        <li>{{trans('sending_nodes.problem_with_gmail.login_to_your')}} 
                            <a href="https://www.gmail.com/" target="_blank">{{trans('sending_nodes.problem_with_gmail.gmail_account')}}</a></li>
                        <li>Go to <a href="https://myaccount.google.com/" target="_blank">{{trans('sending_nodes.problem_with_gmail.my_account')}}</a></li>
                        <li>{{trans('sending_nodes.problem_with_gmail.turn_off_2step_verification')}}</li>
                        <li>{{trans('sending_nodes.problem_with_gmail.turn_on_access_for')}} <a href="https://www.google.com/settings/security/lesssecureapps" target="_blank">{{trans('sending_nodes.problem_with_gmail.less_secure_apps_link')}}</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
@if($iid == 6)
    <div id="slider" class="iid6" style="right:-500px;" data-name="reUJXhaz">
        <div id="sidebar" onclick="open_panel()" data-name="DjSEcXfu">
            <img src="{{ URL('resources/assets/images/help.png') }}" alt="Need Help?" title="Need Help?" />
        </div>
        <div id="heads" data-name="WOcOXowN">
            <button type="button" class="close" onclick="close_panel2()">&times;</button>
            <div class="kt-portlet kt-portlet--height-fluid" id="helpBlk" data-name="TKRpZesf">
                <div class="kt-portlet__head" data-name="TGEdvOOI">
                    <div class="kt-portlet__head-label" data-name="WbDvxYgt">
                        <h3 class="kt-portlet__head-title">
                            {{trans('sending_nodes.problem_with_hotmail.title')}}
                        </h3>
                    </div>
                </div>
                <div class="portlet-body" data-name="sTiXZELJ">
                    <div class="helpheader" data-name="WhRbqkbt">
                        <p>{{trans('sending_nodes.problem_with_hotmail.connect_hotmail_smtp')}}</p>
                    </div>
                    <hr>
                    <b>{{trans('sending_nodes.method')}}:</b>
                    <ul class="helpList">
                        <li>{{trans('sending_nodes.problem_with_hotmail.username_field_hotmail')}}</li>
                        <li>{{trans('sending_nodes.problem_with_hotmail.password_field_hotmail')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
@if($iid == 7)
    <div id="slider" class="iid7" style="right:-500px;" data-name="cITQJArS">
        <div id="sidebar" onclick="open_panel()" data-name="tDIawOII">
            <img src="{{ URL('resources/assets/images/help.png') }}" alt="Need Help?" title="Need Help?" />
        </div>
        <div id="heads" data-name="BjjwSOeO">
            <button type="button" class="close" onclick="close_panel2()">&times;</button>
            <div class="kt-portlet kt-portlet--height-fluid" id="helpBlk" data-name="ACrjkKSy">
                <div class="kt-portlet__head" data-name="jbCQrfvl">
                    <div class="kt-portlet__head-label" data-name="qFgWiJwx">
                        <h3 class="kt-portlet__head-title">
                            {{trans('sending_nodes.problem_with_yahoo.problem_with_yahoo.title')}}
                        </h3>
                    </div>
                </div>
                <div class="portlet-body" data-name="iZoiIxmU">
                    <div class="helpheader" data-name="FhmHTDhn">
                        <p>{{trans('sending_nodes.problem_with_yahoo.methods_to_use_yahoo_smtp')}}</p>
                    </div>
                    <hr>
                    <b>{{trans('sending_nodes.problem_with_aol.method_one_recommended')}}:</b>
                    <ul class="helpList">
                        <li><a href="https://login.yahoo.com/account/security" target="_blank">{{trans('sending_nodes.signin_to_go_security_page')}}</a>.</li>
                        <li>{{trans('sending_nodes.turn_on_verification')}}</li>
                        <li>{{trans('sending_nodes.generate_app_password')}}</li>
                        <li>{{trans('sending_nodes.select_other_app')}}</li>
                        <li>{{trans('sending_nodes.app_password_as_smtp')}}</li>
                    </ul>

                    <hr>

                    <b>{{trans('sending_nodes.method_two')}}:</b>
                    <ul class="helpList">
                        <li><a href="https://login.yahoo.com/account/security" target="_blank">{{trans('sending_nodes.signin_to_go_security_page')}}</a></li>
                        <li>{{trans('sending_nodes.turn_off_verification')}}</li>
                        <li>{{trans('sending_nodes.enable_allow_apps')}}</li>
                        <li>{{trans('sending_nodes.problem_with_yahoo.yahoo_password_as_smtp')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif
@if($iid == 8)
    <div id="slider" class="iid7" style="right:-500px;" data-name="XwfyXzkx">
        <div id="sidebar" onclick="open_panel()" data-name="skpPsdQF">
            <img src="{{ URL('resources/assets/images/help.png') }}" alt="{{trans('common.label.need_help')}}" title="{{trans('common.label.need_help')}}" />
        </div>
        <div id="heads" data-name="rcdVMily">
            <button type="button" class="close" onclick="close_panel2()">&times;</button>
            <div class="kt-portlet kt-portlet--height-fluid" id="helpBlk" data-name="vEBggmDy">
                <div class="kt-portlet__head" data-name="NSFCAQvl">
                    <div class="kt-portlet__head-label" data-name="AdzpYtiE">
                        <h3 class="kt-portlet__head-title">
                            {{trans('sending_nodes.problem_with_aol.title')}}
                        </h3>
                    </div>
                </div>
                <div class="portlet-body" data-name="utvSUoZx">
                    <div class="helpheader" data-name="VgzCtBMW">
                        <p>{{trans('sending_nodes.problem_with_aol.methods_to_use_aol_smtp')}}</p>
                    </div>
                    <hr>
                    <b>{{trans('sending_nodes.problem_with_aol.method_one_recommended')}}:</b>
                    <ul class="helpList">
                        <li><a href="https://login.aol.com/account/security" target="_blank">{{trans('sending_nodes.signin_to_go_security_page')}}</a>.</li>
                        <li>{{trans('sending_nodes.turn_on_verification')}}</li>
                        <li>{{trans('sending_nodes.generate_app_password')}}</li>
                        <li>{{trans('sending_nodes.select_other_app')}}</li>
                        <li>{{trans('sending_nodes.app_password_as_smtp')}}</li>
                    </ul>

                    <hr>

                    <b>{{trans('sending_nodes.method_two')}}:</b>
                    <ul class="helpList">
                        <li><a href="https://login.aol.com/account/security" target="_blank">{{trans('sending_nodes.signin_to_go_security_page')}}</a></li>
                        <li>{{trans('sending_nodes.turn_off_verification')}}</li>
                        <li>{{trans('sending_nodes.enable_allow_apps')}}</li>
                        <li>{{trans('sending_nodes.problem_with_aol.aol_password_as_smtp')}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endif


<div id="modal-group-label" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="NgwQnBFl">
    <div class="modal-dialog" data-name="OQvAGATH">
        <div class="modal-content" data-name="VmyrIORQ">
            <div class="modal-header" data-name="lkqtiGsJ">
                <h5 class="modal-title">{{trans('common.label.add_new_group')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="objdqUrS">
                <div id="msg-group" class="display-hide alert alert-success text-left" data-name="yxOwnazC">
                    <span id='msg-text-group' class="text-left alert-text"><span>
                </div>
                <br>
                <form action="" id="frm-group" method="post" class="form-horizontal">
                    @for ($i = 1; $i < 2; $i++)
                        <div class="col-md-12" data-name="IkxglMMx">
                            <div class="form-group row" data-name="XPrnChPs">
                                <label class="col-md-3 col-form-label" >{{trans('common.label.group_name')}}</label>
                                </label>
                                <div class="col-md-8" data-name="XqvfVzRh">
                                    <input type="text"  name="name[]" class="form-control"  {{ ($i == 1) ? 'required' : '' }}>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="form-actions col-md-12" data-name="tXAefupA">
                        <div class="row" data-name="SPbNPIOI">
                            <label class="col-md-3 col-form-label" ></label>
                            <div class="col-md-9" data-name="ximAZthZ">
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
<div id="debug_output" class="modal" tabindex="-1" role="dialog" data-name="nGIetGVA">
    <div class="modal-dialog" role="document" data-name="NojAiBBq">
        <div class="modal-content" data-name="FnRXrBgA">
            <div class="modal-header" data-name="fhGVaIVu">
                <h5 class="modal-title">@lang('sending_nodes.debug_log')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" data-name="zLdgSufp">
                <p id="msg_body"></p>
            </div>
            <div class="modal-footer" data-name="eptBrspF">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('common.form.buttons.close')}}</button>
            </div>
        </div>
    </div>
</div>
@endsection