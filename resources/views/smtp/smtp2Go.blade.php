@extends(decide_template())

@section('title', $page_data['title'] )

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
<script src="/themes/default/js/includes/smtp.js" type="text/javascript"></script>
<script>

    var form_error="{{trans('common.message.form_error')}}";
    var groups_msg="{{trans('common.label.groups_msg')}}";
    var token = "{{ csrf_token() }}";
    var node_id_db = "{{ $iid }}";
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
            //   $(".new-btn").hide();;
        }

    });
    
    $(document).ready(function() {

        $(".m-select2").select2({
            placeholder: 'Select Option'
        });

        $("#process1").click(function() {
            $(".blockUI").show();
            setTimeout(function(){
                $("#process2").removeAttr("disabled");
                $(".blockUI").hide();
            }, 1500);
        });
        $("#process2").click(function() {
            //$("#modal-loading").show();
            /*setTimeout(function(){
                $("#process3").removeAttr("disabled");
                $("#modal-loading").hide();
            }, 1500);
            */
            $.get( app_url+"/storage/amazonsns.txt", function( data ) {
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
            $(".mt-repeater").show();
            $("#btn-new").css("display", "flex");
        });

        /*$('input[type=radio][name=pbounce]').change(function() {
          $("input[name='pbounce']").parent().removeClass("selected");
          $("input[name='pbounce']:checked").parent().addClass("selected");
        });*/

        $("#pbounce_status").click(function() {
            $("#phBncBlk").slideToggle();
            $("#dtlBlk").slideToggle();
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
            // if(node_id_db==1 || node_id_db==2 || node_id_db==3 || node_id_db==4 || node_id_db==12){
                $.ajax({
                    url: app_url+'/broadcasts/change-masking-domain',
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
                            $("#masked_domain_id_error_message").show().text(result.message);
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
</script>
@endsection

@section(decide_content())

@if (Session::has('msg'))
<div class="alert alert-success" data-name="tvIzJNTl">
    {{ Session::get('msg') }}
</div>
@endif
@if($errors->any())
<!-- For PHP validations errors-->
<div class="alert alert-danger" data-name="hlTVEzwE">
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="eSELOpHD">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>


<div class="row" data-name="gGmkYWeb">
    <div class="col-md-6 create-form wizardNew" data-name="FprpMadT">

        <div class="kt-content  kt-grid__item kt-grid__item--fluid pb0" id="kt_content" data-name="DkaTmpjo">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="wEYUQgrN">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="xCdctMMH">
                    <div class="kt-wizard-v4__nav-items" data-name="KjnbwVUu">
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="SErpArGH">
                                <div class="kt-wizard-v4__nav-number" data-name="naWhIENi">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="mSZUzFTk">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="AAPvyvlf">
                                        {{trans('sending_nodes.add_new.account_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="WGFXlmfc">
                                        {{trans('sending_nodes.add_new.account_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="eVgwmopO">
                                <div class="kt-wizard-v4__nav-number" data-name="UgHXdGla">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="RErLPLKD">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="CUGPrTky">
                                        {{trans('sending_nodes.add_new.sender_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="xdLFdfTa">
                                        {{trans('sending_nodes.add_new.sender_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="cwgQRSFt">
                                <div class="kt-wizard-v4__nav-number" data-name="VEPYEDwm">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="JUKfGZmd">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="jAyNycTi">
                                        {{trans('sending_nodes.add_new.connectivity_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="FqNiDjmI">
                                         {{trans('sending_nodes.add_new.connectivity_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="ZuBmeuBp"> 
                                <div class="kt-wizard-v4__nav-number" data-name="LqUYfSRV">
                                    4
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="uqnBmTFu">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="LqmKfSGw">
                                        {{trans('sending_nodes.add_new.settings_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="JpawrdHw">
                                        {{trans('sending_nodes.add_new.settings_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="kt-portlet" data-name="ulpkXQhV">
                    <div id="kt-portlet__body kt-portlet__body--fit" data-name="SwnpEFNE">
                        <div class="kt-grid" data-name="JbZsfnIj">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="JZOwfHXp">
                                @if ($page_data['action'] == 'add')
                                <form method="POST" id="smtp-frm" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="add">
                                @else
                                <form action="{{ route('node.update', $smtp->id) }}" method="POST" id="smtp-frm" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="edit">
                                    <input type="hidden" id="smtp-id" value="{{$smtp->id}}">
                                    <input type="hidden" name="_method" value="PUT">
                                    @endif
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="sending_node_id" id="sending_node_id" value="{{ $iid }}">
                                    <input type="hidden" id="dbs" value="{{ isset($additional_settings->dbatch_status) ? $additional_settings->dbatch_status : '' }}">
                                    <input type="hidden" id="hss" value="{{ isset($additional_settings->hourlyspeed_status) ? $additional_settings->hourlyspeed_status : '' }}">
                                    <input type="hidden" id="pds" value="{{ isset($smtp->process_delivery_status) ? $smtp->process_delivery_status : '' }}">
                                    <input type="hidden" id="ahh" value="{{ isset($additional_headers) ? 'data' : '' }}">

                                    <div class="form-body" data-name="AcnyvOxP">

                                        <div class="tab-content" data-name="NslEqJfA">

                                            <div class="alert alert-danger display-none" data-name="bjLXnRlS">
                                                <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} 
                                            </div>
                                            <div class="alert alert-success display-none" data-name="VvXWqdvr">
                                                <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}}
                                            </div>

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="LdHvzXtP">
                                                <div class="kt-form__section kt-form__section--first" data-name="SDKNHOiB">
                                                    <div class="kt-wizard-v4__form" data-name="CyCxnKAj">

                                                        <div class="signme" data-name="UARSkIhg">
                                                            {{trans('sending_nodes.signup',['app'=>"Smtp2go"])}}
                                                            <a href="https://www.smtp2go.com/pricing/" target="_blank" class="">{{trans('sending_nodes.signup_here')}}</a> 
                                                        </div>
                                                        <div class="form-group row" data-name="QKsbGlEM">
                                                            <div class="col-md-12" data-name="tWYAmvgo">
                                                                <div class="kt-heading kt-heading--md" data-name="avAEgfRF">
                                                                    {{trans('sending_nodes.add_new.account_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.account_tab.form.description')}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="RfiUhBEv">
                                                            <label class="col-form-label pl12"> {{trans('common.label.status')}}
                                                                {!! popover('sending_nodes.add_new.form.status_help','common.description') !!}</label>
                                                            @if((isset($smtp->status) && $smtp->status == 1) || Request::segment(3)=='add')
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                <label>
                                                                    <input type="checkbox" checked="checked" name="node_status">
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                            @else
                                                                <div class="col-md-8" data-name="jqBpImwH">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                        <label>
                                                                            <input type="checkbox" name="node_status">
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="form-group row" data-name="CmGSgphS">
                                                                
                                                            <div class="col-md-12" data-name="jhjIrpJM">
                                                                <label class="col-form-label">  {{trans('sending_nodes.add_new.form.node_name')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.node_name_help','common.description') !!} </label>
                                                                <input type="text" name="name" class="form-control" value="{{isset($smtp->name) ? $smtp->name : '' }}" required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="qfzNiAUo">
                                                                
                                                            <div class="col-md-6" data-name="UTBdKNRa">
                                                               <label class="col-form-label">
                                                                    {{trans('common.label.group')}}
                                                                    <span class="required"> * </span>
                                                                    <span>
                                                                        <a href="#modal-group-label" data-toggle="modal"><i class="fa fa-plus-square text-success"></i></a>
                                                                    </span>
                                                                     {!! popover('common.label.group_help','common.description') !!}
                                                                </label>
                                                                <select class="form-control m-select2" data-placeholder="{{ trans('common.label.select_group') }}" name="group_id" id="group-id" required="">
                                                                    <option value="">{{ trans('common.label.select_group') }}</option>
                                                                    @foreach($groups as $group)
                                                                        <option value="{{ $group->id }}" {{ (isset($smtp->group_id) && $smtp->group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6  custom-show" data-name="EYloWVHZ">
                                                               <label class="col-form-label">
                                                                    {{trans('sending_nodes.add_new.form.mail_encoding')}}
                                                                    {!! popover('sending_nodes.add_new.form.mail_encoding_help','common.description') !!}
                                                                </label>
                                                                 <select  id="mail_encoding" name="mail_encoding" class="form-control">
                                                                    <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'quoted-printable') ? 'selected' : '' }} value="quoted-printable" selected=""> {{trans('sending_nodes.add_new.form.quoted_printable')}} </option>
                                                                    <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == '8bit') ? 'selected' : '' }} value="8bit"> {{trans('sending_nodes.add_new.form.8bit')}} </option>
                                                                    <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'base64') ? 'selected' : '' }} value="base64"> {{trans('sending_nodes.add_new.form.base64')}} </option>
                                                                    <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'binary') ? 'selected' : '' }} value="binary"> {{trans('sending_nodes.add_new.form.binary')}} </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="YAGJRYow">
                                                <div class="kt-form__section kt-form__section--first" data-name="arerVysQ">
                                                    <div class="kt-wizard-v4__form" data-name="awKTePHj">

                                                             
                                            <div class="form-group row" data-name="dabHYudP">
                                                            <div class="col-md-12" data-name="orSKfbbI">
                                                                <div class="kt-heading kt-heading--md" data-name="PSAOolBK">
                                                                    {{trans('sending_nodes.add_new.sender_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.sender_tab.form.description')}}</p>
                                                            </div>  
                                                        </div>

                                                       <div class="form-group row" data-name="ldxpdRpc">
                                                                
                                                                <div class="col-md-6" data-name="oEcnfEVN">
                                                                    <label class="col-form-label">
                                                                         {{trans('sending_nodes.add_new.form.sender_name')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('sending_nodes.add_new.form.sender_name_help','common.description') !!}
                                                                    </label>
                                                                    <input required="" type="text" id="from_name" name="from_name" class="form-control" value="{{isset($smtp->from_name) ? $smtp->from_name : '' }}"  />
                                                                </div>
    
                                                                <div class="col-md-6" data-name="spOYmEtq">
                                                                    <label class="col-form-label">
                                                                        {{trans('sending_nodes.add_new.form.sender_email')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('sending_nodes.add_new.form.sender_email_help','common.description') !!}
                                                                    </label>
                                                                    <div class="row from-email" data-name="TVVgtntc">
                                                                        <div class="col-md-6" data-name="YhmsDDXH">
                                                                            <div class="input-group" data-name="DTNXdBVK">
                                                                                <input type="text" class="form-control" id="from_email_part11" name="from_email_part1" value="{{ isset($from_email_part1) ? $from_email_part1 : '' }}" required />
                                                                                <div class="input-group-append" data-name="arZCFgKv">
                                                                                    <span class="input-group-text" id="basic-addon2">@</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6" data-name="cjNlIeWp">
                                                                            <div class="input-icon right" data-name="vAKRSBSt">
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
                                                            </div>


                                                        <div class="form-group row custom-show-sender" data-name="pFZWHDul">
                                                            
                                                            <div class="col-md-6" data-name="KIwkxMfp">
                                                                <label class="col-form-label">
                                                                    
                                                                     {{trans('common.label.reply_email')}}
                                                                    <span class="required"> * </span>
                                                                     {!! popover('common.label.reply_email_help','common.description') !!}
                                                                </label>
                                                                <input type="text" name="reply_email" id="reply_email" class="form-control" value="{{isset($smtp->reply_email) ? $smtp->reply_email : '' }}" required />
                                                            </div>
                                                            <div class="col-md-6" data-name="sbNvqLcJ">
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
                                                        </div>
                                                        @if(moduleCheck('masking_domains'))
                                                        <div class="form-group row" data-name="UozyJSyO">
                                                                
                                                            <div class="col-md-12" data-name="dxbluaTm">
                                                                <label class="col-form-label">
                                                                    
                                                                     {{trans('sending_nodes.add_new.form.tracking_domain')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.tracking_domain_help','common.description') !!}
                                                                </label>
                                                               <select class="form-control m-select2" name="masked_domain_id" id="masked_domain_id" required data-placeholder="{{ trans('sending_nodes.add_new.form.choose_tracking_domain') }}">
                                                                        <option>{{ trans('sending_nodes.add_new.form.choose_tracking_domain') }}</option>
                                                                        @foreach($domain_maskings as $masked_domain)
                                                                            <option value="{{ $masked_domain->id }}" {{ (isset($smtp->masked_domain_id) && $smtp->masked_domain_id == $masked_domain->id) ? 'selected' : '' }}>{{ $masked_domain->tracking_domain }}.{{ $masked_domain->domain }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                     <p style="color: red;" id="masked_domain_id_error_message"></p>
                                                            </div>
                                                        </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="FaPPRVvy">
                                                <div class="kt-form__section kt-form__section--first" data-name="ujvfgEgy">
                                                    <div class="kt-wizard-v4__form" data-name="SvgRpRWE">

                                                        <div class="form-group" data-name="kjjglMnR">
                                                            <h3 class="m-form__heading-title">
                                                                 {{trans('sending_nodes.connectivity.smtp2go.title')}}
                                                            </h3>
                                                            <p>{{trans('sending_nodes.connectivity.smtp2go.description')}}</p>
                                                        </div>
                                                        <div class="form-group row" data-name="VFUQZmvk">
                                                                
                                                            <div class="col-md-12" data-name="RNdGRcxM">
                                                                <label class="col-form-label">
                                                                         {{trans('sending_nodes.api_key')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.api_key_help','common.description',['app'=>'SparkPost ']) !!}
                                                                </label>
                                                                <input type="text" required name="api_key" id="api_key" value="{{isset($smtp->api_key) ? $smtp->api_key : '' }}" class="form-control" />
                                                                <div class="help-block" data-name="lFFDqbTG"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="HCAxyccJ">
                                                            <div class="col-md-12" data-name="VqscHIsn">
                                                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6" data-name="yRDavxtO">
                                                                    <div class="card" data-name="ZxTlMmHY">
                                                                        <div class="card-header" id="headingOne6" data-name="OaMEofro">
                                                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="pVqpGBpZ">
                                                                                <i class="flaticon2-copy"></i> {{trans('sending_nodes.api_key_link')}}
                                                                            </div>
                                                                        </div>
                                                                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="bZzMFeyN">
                                                                            <div class="card-body" data-name="NGNsZcyU">
                                                                                <h3 class="m-form__heading-title">
                                                                                    {{trans('sending_nodes.get_api_keys',['app' =>"SMTP2GO"])}}
                                                                                </h3>
                                                                                @lang('sending_nodes.connectivity.smtp2go.form.howto_find_smtp2go_apikey')
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="XgauIPiJ">
                                                            <label class="col-form-label pl12">
                                                                 {{trans('sending_nodes.process_delivery_reports')}}
                                                                        {!! popover('sending_nodes.process_delivery_reports_help','common.description') !!}
                                                            </label>
                                                            @if(isset($smtp->process_delivery_status) && $smtp->process_delivery_status == 1)
                                                            <div class="col-md-12" id="p1" data-name="JLwlNvAE">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                    <label>
                                                                        <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                            @else
                                                            <div class="col-md-12" id="p1" data-name="tVpOeHgZ">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                    <label>
                                                                        <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group row" data-name="OVLJwgFX">
                                                            <div class="col-md-12 kt-radio-list" id="phBncBlk" data-name="uASkYioq">
                                                                @php
                                                                    $pbounce = isset($smtp->process_delivery_reports) ? $smtp->process_delivery_reports : '';
                                                                @endphp
                                                                <label class="pbounceopt kt-radio" for="pbo2">
                                                                    <input type="radio" name="pbounce" id="pbo2" value="WebHooks" checked="checked" {{ isset($pbounce) && $pbounce == 'WebHooks' ? 'checked' : 'checked="checked"' }}>
                                                                    {{trans('sending_nodes.connectivity.sendgrid.form.webhooks_recommended')}}
                                                                    <span></span>
                                                                    {!! popover('sending_nodes.connectivity.sendgrid.form.webhooks_recommended_help','common.description') !!}
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" data-name="aChBopik">
                                                            <div class="col-md-12" id="dtlBlk" data-name="JakMYpsK">
                                                                <div class="pbo11 hide" data-name="BcWkMsQF">
                                                                    <h3 class="m-form__heading-title"></h3>
                                                                    <p></p>
                                                                </div>
                                                                <div class="pbo22 show" data-name="dZuKDbZc">

                                                                    <h3 class="m-form__heading-title">
                                                                        <?php
                                                                            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".'/callbacks/smtp2go';
                                                                            $input=' <div class="urldmn">
                                                                  <input type="text" title="'.trans('sending_nodes.connectivity.sendgrid.form.click_copy_button').'" id="copyurl" class="form-control" name="" value="'. $actual_link.'" readonly="" >
                                                                  <i class="fa fa-copy" onclick="copyFunction()" title="'.trans('common.label.click_copy').'"></i></div>';
                                                                        ?>
                                                                        {{trans('sending_nodes.process_details_title',['app'=>"SMTP2GO"])}}

                                                                    </h3>
                                                                    @lang('sending_nodes.connectivity.smtp2go.form.configuring_smtp2go_apikey',['input'=>$input])
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="pvWCZlkP">
                                                <div class="kt-form__section kt-form__section--first" data-name="zlatsvqP">
                                                    <div class="kt-wizard-v4__form" data-name="kwFpJeeM">

                                                        <div class="form-group row" data-name="dzAqDCKA">
                                                            <div class="col-md-12" data-name="PEBcPZMo">
                                                                <div class="kt-heading kt-heading--md" data-name="CDQrAqhW">
                                                                    {{trans('sending_nodes.add_new.settings_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.settings_tab.form.description')}} <br />
                                                                <small>{{trans('sending_nodes.add_new.settings_tab.form.note')}}</small>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div id="kt_repeater_3" data-name="eTvRNRUm">
                                                            <div class="form-group row mb0" data-name="RBqthhCl">
                                                                        
                                                                <div class="col-md-12" data-repeater-list="subscriber_filter" data-name="sIwDRhZP">
                                                                    <label class="col-form-label col-md-12 pl12">
                                                                            {{trans('sending_nodes.add_new.form.additional_headers')}} 
                                                                    {!! popover('sending_nodes.add_new.form.additional_headers_help','common.description') !!}
                                                                        </label>
                                                                    @if(isset($additional_headers))
                                                                    <div class="mt-repeater" style="display: none;" data-name="rAnzasxn">
                                                                        <div data-repeater-item data-name="bunpHovs">
                                                                            @foreach($additional_headers as $key => $value)
                                                                                <div data-repeater-item="" class="mt-repeater-item" data-name="INwmEBhu">
                                                                                    <div class="row mt-repeater-row" data-name="EWcDjvES">
                                                                                        <div class="col-md-6" data-name="XmJmniHI">
                                                                                            <input type="text" name="header" placeholder="Header" class="form-control" value="{{ isset($value->header) ? $value->header : '' }}">
                                                                                            <span class="clnfld">:</span>
                                                                                        </div>
                                                                                        <div class="col-md-6" data-name="WCeiEnFn">
                                                                                            <input type="text" name="header_value" placeholder="Value" class="form-control" value="{{ isset($value->header_value) ? $value->header_value : ''  }}">
                                                                                        </div>
                                                                                        <div class="col-md-1" data-name="XxuZiiRZ">
                                                                                            <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <div class="mt-repeater" style="display: none;" data-name="uupCGDxw">
                                                                        <div data-repeater-item="" class="mt-repeater-item" data-name="occKxXGp">
                                                                            <div class="row mt-repeater-row" data-name="vrnBXYqI">
                                                                                <div class="col-md-6" data-name="mVWDpSFx">
                                                                                    <input type="text" name="header" placeholder="Header" class="form-control" value="">
                                                                                    <span class="clnfld">:</span>
                                                                                </div>
                                                                                <div class="col-md-6" data-name="dCVZXzfy">
                                                                                    <input type="text" name="header_value" placeholder="Value" class="form-control" value="">
                                                                                </div>
                                                                                <div class="col-md-1" data-name="ECIsqkem">
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
                                                            <div class="row" id="btn-new" data-name="IIWBwYPI">
                                                                <div class="col" data-name="fkOqhRpY">
                                                                    <div data-repeater-create="" class="btn btn btn-info btn-sm" data-name="jfyBTYNy">
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
                                    <div class="kt-form__actions" data-name="xCOrBFIi">
                                        <div class="btn btn-secondary btn-md" data-ktwizard-type="action-prev" data-name="ocSlYDDE">
                                            {{trans('common.form.buttons.back')}}
                                        </div>
                                        <div class="btn btn-success btn-md" data-ktwizard-type="action-submit" data-name="fWcUAuLG">
                                            {{trans('common.form.buttons.submit')}}
                                        </div>
                                        <div class="btn btn-success btn-md" data-ktwizard-type="action-next" data-name="VXDtcdox">
                                            {{trans('common.form.buttons.continue')}}
                                        </div>
                                    </div>
                                </form>

                                 <div class="tab-pane" id="tabSuccess" data-name="wbiwyAoz">
                                    <div class="text-success" data-name="WBjoceRr">
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

<div class="col-md-6 create-form" id="testmail" @if($page_data['action'] != 'edit') style="display: none;" @endif data-name="fdGOIpvs">
    <div class="kt-content" data-name="ZvbrhhpK">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="tzylzGNg">
            <div class="kt-portlet__head" data-name="uBAROGCt">
                <div class="kt-portlet__head-label" data-name="mmBMpRHM">
                    <h3 class="kt-portlet__head-title">
                        {{trans('sending_nodes.test_email.form.heading')}}
                    </h3>
                </div>
            </div>
            <!-- BEGIN FORM-->
            <div class="kt-portlet__body" data-name="HJUtFdoH">
                <form action="" method="POST" id="smtp-validation-frm" class="kt-form kt-form--label-right">
                    <div class="row" data-name="zxOFCNPx">
                        <div class="col-md-12" data-name="OJeRmAGu">
                            <div class="form-group row" data-name="zrKLeBWk">
                                <label class="col-form-label col-md-3" style="text-align: right !important;">{{trans('sending_nodes.test_email.form.heading')}}
                                </label>
                                <div class="col-md-7" data-name="dUllTaUe">
                                    <div class="input-icon right" data-name="nDHUhQob">
                                        <input type="text" placeholder="{{trans('common.label.email_address')}}" name="smtp_email" id="smtp_email" class="form-control" value="" />
                                    </div>
                                    <div id="mail-sent-msg" data-name="OFdTmZSC"></div>
                                </div>
                               
                            </div>
                            @if(isset($phpMailer) && $phpMailer)
                                <div class="form-group row" data-name="bYjEupzY">
                                    <label class="col-form-label col-md-3" style="text-align: right !important;">
                                    </label>
                                    <div class="col-md-7" data-name="KEzzOKzK">
                                    <div class="input-icon right" data-name="INdrprlV">
                                        <input  type="checkbox"   id="php_mailer" name="php_mailer" value="1">   {{trans('sending_nodes.test_email.form.get_debug_log')}}
                                        <span></span>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row" data-name="pItadojI">
                                    <label class="col-form-label col-md-3" style="text-align: right !important;">
                                    </label>
                                <div class="col-md-7" data-name="axgHrwpx">
                                    <span id="modal_span"  style="display: none;"><a onclick="showModalLog()" href="javascript:;">
                                        {{trans('sending_nodes.test_email.form.debug_log')}}
                                    </a></span>
                                    <div id="mail-sent-log" style="display: none;" data-name="ghHaKWGG"></div>
                                </div>
                                </div>

                            @endif
                            <div class="form-group row" data-name="szLBvOzm">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-8" data-name="FXcWUGhA">
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


<div id="modal-group-label" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="jiMQODpi">
    <div class="modal-dialog" data-name="VkQHKjEo">
        <div class="modal-content" data-name="DksmrVDZ">
            <div class="modal-header" data-name="JjslfpWO">
                <h5 class="modal-title">{{trans('common.label.add_new_group')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="GDMDYyjd">
                <div id="msg-group" class="display-hide alert alert-success text-left" data-name="OnkECpeE">
                    <span id='msg-text-group' class="text-left alert-text"><span>
                </div>
                <br>
                <form action="" id="frm-group" method="post" class="form-horizontal">
                    @for ($i = 1; $i < 2; $i++)
                        <div class="col-md-12" data-name="zJkOkoIk">
                            <div class="form-group row" data-name="uTiWXYPR">
                                <label class="col-md-3 col-form-label" >{{trans('common.label.group_name')}}</label>
                                </label>
                                <div class="col-md-8" data-name="aCovVmZc">
                                    <input type="text"  name="name[]" class="form-control"  {{ ($i == 1) ? 'required' : '' }}>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="form-actions col-md-12" data-name="sThJRVsW">
                        <div class="row" data-name="kZesLXlt">
                            <label class="col-md-3 col-form-label" ></label>
                            <div class="col-md-9" data-name="BeIUHNuz">
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

@endsection