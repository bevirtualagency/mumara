@extends(decide_template())

@section('title',$pageTitle)

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
       Command: toastr["success"] ("{{trans('sending_nodes.message.domain_url_copied')}}");    }

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
            //   $(".new-btn").hide();
        }

    });
    
    $(document).ready(function() {

        $(".m-select2").select2({
            placeholder: 'Select Option',
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
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
            // if(node_id_db==1 || node_id_db==2 || node_id_db==3 || node_id_db==4 || node_id_db==10){
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
                    if(confirm('@lang("common.message.delete_warning")') ) {
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
    <div class="alert alert-success" data-name="oovjwVGo">
        {{ Session::get('msg') }}
    </div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="zOpGsDaM">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="AUrZwPmu">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>


<div class="row" data-name="uFMcFPkO">
    <div class="col-md-6 create-form wizardNew" data-name="TmEAjERq">

        <div class="kt-content  kt-grid__item kt-grid__item--fluid pb0" id="kt_content" data-name="uSDbcKyw">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="OomXBsqd">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="otuBfIJI">
                    <div class="kt-wizard-v4__nav-items" data-name="VwqxCvyl">
                       <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="wNVtxMlV">
                                <div class="kt-wizard-v4__nav-number" data-name="AYtTYekn">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="rWwCppqI">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="cMteIQqH">
                                        {{trans('sending_nodes.add_new.account_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="PoJoZISD">
                                        {{trans('sending_nodes.add_new.account_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="yFhjRKSv">
                                <div class="kt-wizard-v4__nav-number" data-name="bmekaBjm">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="TGEWivqH">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="YVwbgpWc">
                                        {{trans('sending_nodes.add_new.sender_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="rIeklnuJ">
                                        {{trans('sending_nodes.add_new.sender_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="dQqClLVb">
                                <div class="kt-wizard-v4__nav-number" data-name="tvfSTUlm">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="oGlucTfk">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="XLtvDJJt">
                                        {{trans('sending_nodes.add_new.connectivity_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="BgILkQPm">
                                         {{trans('sending_nodes.add_new.connectivity_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" style="pointer-events: none;" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="YUcMyNAX"> 
                                <div class="kt-wizard-v4__nav-number" data-name="yGuzJotD">
                                    4
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="WrnvgBBG">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="VRPaFvmL">
                                        {{trans('sending_nodes.add_new.settings_tab.title')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="aNmRxEBV">
                                        {{trans('sending_nodes.add_new.settings_tab.description')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="kt-portlet" data-name="nwJARfAS">
                    <div id="kt-portlet__body kt-portlet__body--fit" data-name="dEASXQos">
                        <div class="kt-grid" data-name="FnBqOAiO">

                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="faoCEJug">
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

                                    <div class="form-body" data-name="PXGBGmWA">
                                        
                                        <div class="tab-content" data-name="eRzZCqIP">

                                            <div class="alert alert-danger display-none" data-name="egBFstNV">
                                                <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} 
                                            </div>

                                            <div class="alert alert-success display-none" data-name="csgYPJWx">
                                                <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} 
                                            </div>

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="wBUAPOlf">
                                                <div class="kt-form__section kt-form__section--first" data-name="BsSVXtYx">
                                                    <div class="kt-wizard-v4__form" data-name="BoYMXVvO">

                                                        <div class="signme" data-name="CRCHxMRN">
                                                           {{trans('sending_nodes.signup',['app'=>"Elastic Email"])}}
                                                            <a href="https://elasticemail.com/account/#/create-account" target="_blank" class="">{{trans('sending_nodes.signup_here')}}.</a>
                                                        </div>
                                                        <div class="form-group row mb0" data-name="NjNhojOS">
                                                            <div class="col-md-12" data-name="XLhPFRkk">
                                                                <div class="kt-heading kt-heading--md" data-name="doTAORgW">
                                                                    {{trans('sending_nodes.add_new.account_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.account_tab.form.description')}}</p>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="JnfGDUjK">
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
                                                                <div class="col-md-8" data-name="TqOSbJjB">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                        <label>
                                                                            <input type="checkbox" name="node_status">
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>

                                                        <div class="form-group row" data-name="KrmplOuX">
                                                                
                                                            <div class="col-md-12" data-name="YswzBFJt">
                                                                <label class="col-form-label">
                                                                    
                                                                     {{trans('sending_nodes.add_new.form.node_name')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.node_name_help','common.description') !!}
                                                                </label>
                                                                <input type="text" name="name" class="form-control" value="{{isset($smtp->name) ? $smtp->name : '' }}" required />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="efFYPxfS">
                                                                
                                                              <div class="col-md-6" data-name="OJjysFPg">
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
                                                            <div class="col-md-6" data-name="TCeGaPvk">
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

                                                        <div class="form-group row custom-show" data-name="wkWLgEWS" >
                                                            
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="NLNMVasy">
                                                <div class="kt-form__section kt-form__section--first" data-name="sGIsumVi">
                                                    <div class="kt-wizard-v4__form" data-name="seJWSvVC">

                                                        <div class="form-group row" data-name="rmfrogkf">
                                                              <div class="col-md-12" data-name="WBxwqhIe">
                                                                <div class="kt-heading kt-heading--md" data-name="pbQNXEvY">
                                                                    {{trans('sending_nodes.add_new.sender_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.sender_tab.form.description')}}</p>
                                                            </div> 
                                                        </div>

                                                        <div class="form-group row" data-name="djByrWat">
                                                                
                                                            <div class="col-md-6" data-name="mbGqCXyI">
                                                                <label class="col-form-label">
                                                                     {{trans('sending_nodes.add_new.form.sender_name')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.sender_name_help','common.description') !!}
                                                                </label>
                                                                <input required="" type="text" id="from_name" name="from_name" class="form-control" value="{{isset($smtp->from_name) ? $smtp->from_name : '' }}"  />
                                                            </div>
                                                            <div class="col-md-6" data-name="WWSaTvzT">
                                                                <label class="col-form-label">
                                                                    {{trans('sending_nodes.add_new.form.sender_email')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.add_new.form.sender_email_help','common.description') !!}
                                                                </label>
                                                                <div class="row from-email" data-name="tOErCHVN">
                                                                    <div class="col-md-6" data-name="gJSHyrvk">
                                                                        <div class="input-group" data-name="bKEdsMio">
                                                                            <input type="text" class="form-control" id="from_email_part11" name="from_email_part1" value="{{ isset($from_email_part1) ? $from_email_part1 : '' }}" required />
                                                                            <div class="input-group-append" data-name="EHIdoMyS">
                                                                                <span class="input-group-text" id="basic-addon2">@</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                   <div class="col-md-6" data-name="xtgXGzWw">
                                                                        <div class="input-icon right" data-name="fbGqBjmB">
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

                                                       <div class="form-group row custom-show-sender" data-name="tpvGyEvV">
                                                            
                                                            <div class="col-md-6" data-name="nfjnYVuq">
                                                                <label class="col-form-label">
                                                                    
                                                                     {{trans('common.label.reply_email')}}
                                                                    <span class="required"> * </span>
                                                                     {!! popover('common.label.reply_email_help','common.description') !!}
                                                                </label>
                                                                <input type="text" name="reply_email" id="reply_email" class="form-control" value="{{isset($smtp->reply_email) ? $smtp->reply_email : '' }}" required />
                                                            </div>
                                                            <div class="col-md-6" data-name="PBNSXIwo">
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
                                                        <div class="form-group row" data-name="uONemPUL">
                                                                
                                                            <div class="col-md-12" data-name="oyptllwT">
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

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="vHoIHsIR">
                                                <div class="kt-form__section kt-form__section--first" data-name="SPrsLIXV">
                                                    <div class="kt-wizard-v4__form" data-name="EnfWjouG">

                                                        <div class="form-group row" data-name="HLdLbrid">
                                                            <div class="col-md-12" data-name="BaNFHXtX">
                                                                <div class="kt-heading kt-heading--md" data-name="WqBAyHKk">
                                                                    {{trans('sending_nodes.connectivity.elastic_email.title')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.connectivity.elastic_email.description')}}</p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row" data-name="fnbhbSdy">
                                                                
                                                            <div class="col-md-12" data-name="eTagbiUD">
                                                                <label class="col-form-label">
                                                                     
                                                                    {{trans('sending_nodes.api_key')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('sending_nodes.api_key_help','common.description',['app'=>'Elastic Email ']) !!}
                                                                </label>
                                                                <input type="text" required name="api_key" id="api_key" value="{{isset($smtp->api_key) ? $smtp->api_key : '' }}" class="form-control" />
                                                                <div class="help-block" data-name="bcdizNUW"></div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="OWrKTLBS">
                                                            <div class="col-md-12" data-name="EltGGPpX">
                                                                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6" data-name="DqCeYULf">
                                                                    <div class="card" data-name="mSfOislP">
                                                                        <div class="card-header" id="headingOne6" data-name="QHgITTmE">
                                                                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6" data-name="oCCiVxQs">
                                                                                <i class="flaticon2-copy"></i>  {{trans('sending_nodes.api_key_link')}}
                                                                            </div>
                                                                        </div>
                                                                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6" data-name="WSuoGHdd">
                                                                            <div class="card-body" data-name="CtZwDEPX">
                                                                                <h3 class="m-form__heading-title">
                                                                                     {{trans('sending_nodes.get_api_keys',['app' =>"Elastic Email"])}}
                                                                                </h3>
                                                                                @lang('sending_nodes.connectivity.elastic_email.form.howto_find_elastic_email_apikey')
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="kywPECmK">
                                                            <label class="col-form-label pl12">
                                                                {{trans('sending_nodes.process_delivery_reports')}}
                                                                        {!! popover('sending_nodes.process_delivery_reports_help','common.description') !!}
                                                            </label>
                                                            @if(isset($smtp->process_delivery_status) && $smtp->process_delivery_status == 1)
                                                            <div class="col-md-12" id="p1" data-name="lnFAkmLx">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                    <label>
                                                                        <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                            @else
                                                            <div class="col-md-12" id="p1" data-name="yqwyJTkn">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                    <label>
                                                                        <input type="checkbox" checked="checked" name="pbounce_status" id="pbounce_status">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                            @endif
                                                        </div>
                                                        <div class="form-group row" data-name="ZQexSxhW">
                                                            <div class="col-md-12 kt-radio-list" id="phBncBlk" data-name="fGNQQNHf">
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
                                                        <div class="form-group row" data-name="JhfWJXzB">
                                                            <div class="col-md-12" id="dtlBlk" data-name="tiafLucy">
                                                                <div class="pbo11 hide" data-name="RZBgKkTQ">
                                                                    <h3 class="m-form__heading-title"></h3>
                                                                    <p></p>
                                                                </div>
                                                                <div class="pbo22 show" data-name="XGBaSWjr">

                                                                    <h3 class="m-form__heading-title">
                                                                        @php
                                                                            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".'/callbacks/elastic';
                                                                        @endphp
                                                                        {{trans('sending_nodes.process_details_title',['app'=>"Elastic Email"])}}
                                                                    </h3>
                                                                    <?php 
                                                                    $input='<div class="urldmn"><input type="text" id="copyurl" class="form-control" name="" value="'. $actual_link.' " readonly="" ><i class="fa fa-copy" title="'.trans('sending_nodes.connectivity.sendgrid.form.click_copy_button').'" onclick="copyFunction()"></i></div>';
                                                                    ?>
                                                                    @lang('sending_nodes.connectivity.elastic_email.form.configuring_apikey',['urlInput' =>$input])
                                                                  

                                                                    @if(isset($smtp->domain_name))
                                                                        @php
                                                                            $url = $actual_link;
                                                                        @endphp
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="hsLAdGdY">
                                                <div class="kt-form__section kt-form__section--first" data-name="OmgRAKLP">
                                                    <div class="kt-wizard-v4__form" data-name="nuEdluaX">

                                                        <div class="form-group row" data-name="JMsODDNy">
                                                             <div class="col-md-12" data-name="MqPFgvoj">
                                                                <div class="kt-heading kt-heading--md" data-name="iWaHRunA">
                                                                    {{trans('sending_nodes.add_new.settings_tab.form.heading')}}
                                                                </div>
                                                                <p>{{trans('sending_nodes.add_new.settings_tab.form.description')}} <br />
                                                                <small>{{trans('sending_nodes.add_new.settings_tab.form.note')}}</small>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div id="kt_repeater_3" data-name="tpGfMziT">
                                                            <div class="form-group row mb0" data-name="DmumkYIQ">
                                                                <label class="col-form-label col-md-12 pl12">
                                                                   {{trans('sending_nodes.add_new.form.additional_headers')}} 
                                                                    {!! popover('sending_nodes.add_new.form.additional_headers_help','common.description') !!}
                                                                </label>
                                                                <div class="col-md-12" data-repeater-list="subscriber_filter" data-name="wWHwABDq">
                                                                    @if(isset($additional_headers) and is_array($additional_headers))
                                                                    <div class="mt-repeater" style="display: none;" data-name="unZzhoBp">
                                                                        <div data-repeater-item data-name="HIYLqeGO">
                                                                        @foreach($additional_headers as $key => $value)
                                                                            <div data-repeater-item="" class="mt-repeater-item" data-name="edzUExAQ">
                                                                                <div class="row mt-repeater-row" data-name="luEbpsIc">
                                                                                    <div class="col-md-6" data-name="kdzZJnuN">
                                                                                        <input type="text" name="header" placeholder="Header" class="form-control header_class" value="{{ isset($value->header) ? $value->header : '' }}">
                                                                                        <span class="clnfld">:</span>
                                                                                    </div>
                                                                                    <div class="col-md-6" data-name="dijTzjBD">
                                                                                        <input type="text" name="header_value" placeholder="Value" class="form-control" value="{{ isset($value->header_value) ? $value->header_value : ''  }}">
                                                                                    </div>
                                                                                    <div class="col-md-1" data-name="iyLTUKxK">
                                                                                        <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    @else
                                                                    <div class="mt-repeater" style="display: none;" data-name="lYfwRBJO">
                                                                        <div data-repeater-item="" class="mt-repeater-item" data-name="BGQvWMjD">
                                                                            <div class="row mt-repeater-row" data-name="mezXRQHE">
                                                                                <div class="col-md-6" data-name="cyUbFkJs">
                                                                                    <input type="text" name="header" placeholder="Header" class="form-control header_class" value="">
                                                                                    <span class="clnfld">:</span>
                                                                                </div>
                                                                                <div class="col-md-6" data-name="eDAzguty">
                                                                                    <input type="text" name="header_value" placeholder="Value" class="form-control" value="">
                                                                                </div>
                                                                                <div class="col-md-1" data-name="sHxIZZMt">
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
                                                            <div class="row" id="btn-new" data-name="BHPJKzpA">
                                                                <div class="col" data-name="ZPzscvJE">
                                                                    <div data-repeater-create="" class="btn btn btn-info btn-sm" data-name="mOHDYyws">
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
                                    <div class="kt-form__actions" data-name="eWgEEtOe">
                                        <div class="btn btn-secondary btn-md" data-ktwizard-type="action-prev" data-name="NViORgaC">
                                            {{trans('common.form.buttons.back')}}
                                        </div>
                                        <div class="btn btn-success btn-md" data-ktwizard-type="action-submit" data-name="ThvxTckf">
                                            {{trans('common.form.buttons.submit')}}
                                        </div>
                                        <div class="btn btn-success btn-md" data-ktwizard-type="action-next" data-name="JvQqoLNN">
                                            {{trans('common.form.buttons.continue')}}
                                        </div>
                                    </div>
                                </form>

                                <div class="tab-pane" id="tabSuccess" data-name="yWEjNrxm">
                                    <div class="text-success" data-name="YIMlbgEB">
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

<div class="col-md-6 create-form" id="testmail" @if($page_data['action'] != 'edit') style="display: none;" @endif data-name="YBByLVIb">
    <div class="kt-content" data-name="bFgebBkJ">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="zyHCABGM">
            <div class="kt-portlet__head" data-name="fmctlgcx">
                <div class="kt-portlet__head-label" data-name="HQJbfIbr">
                    <h3 class="kt-portlet__head-title">
                        {{trans('sending_nodes.test_email.form.heading')}}
                    </h3>
                </div>
            </div>
            <!-- BEGIN FORM-->
            <div class="kt-portlet__body" data-name="qDJMDhBA">
                <form action="" method="POST" id="smtp-validation-frm" class="kt-form kt-form--label-right">
                    <div class="row" data-name="UccOfDRH">
                        <div class="col-md-12" data-name="OBQCXxmz">
                            <div class="form-group row" data-name="ncvPAeeB">
                                <label class="col-form-label col-md-3" style="text-align: right !important;">{{trans('sending_nodes.test_email.form.heading')}}
                                </label>
                                <div class="col-md-7" data-name="uHAIFoIK">
                                    <div class="input-icon right" data-name="YeSEtBAk">
                                        <input type="text" placeholder="{{trans('common.label.email_address')}}" name="smtp_email" id="smtp_email" class="form-control" value="" />
                                    </div>
                                    <div id="mail-sent-msg" data-name="rQzaTtUC"></div>
                                </div>
                               
                            </div>
                            @if(isset($phpMailer) && $phpMailer)
                                <div class="form-group row" data-name="kyJmEtMQ">
                                    <label class="col-form-label col-md-3" style="text-align: right !important;">
                                    </label>
                                    <div class="col-md-7" data-name="TLvEtIBb">
                                    <div class="input-icon right" data-name="OmFNpRby">
                                        <input  type="checkbox"   id="php_mailer" name="php_mailer" value="1">   {{trans('sending_nodes.test_email.form.get_debug_log')}}
                                        <span></span>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group row" data-name="PHQFszmY">
                                    <label class="col-form-label col-md-3" style="text-align: right !important;">
                                    </label>
                                <div class="col-md-7" data-name="MIEmdPPf">
                                    <span id="modal_span"  style="display: none;"><a onclick="showModalLog()" href="javascript:;">
                                        {{trans('sending_nodes.test_email.form.debug_log')}}
                                    </a></span>
                                    <div id="mail-sent-log" style="display: none;" data-name="EjYYwgZz"></div>
                                </div>
                                </div>

                            @endif
                            <div class="form-group row" data-name="sicHMazC">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-8" data-name="EcTFOTrZ">
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

<div id="modal-group-label" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="ZUsdJuWi">
    <div class="modal-dialog" data-name="nBfuivTr">
        <div class="modal-content" data-name="WyMtCgjf">
            <div class="modal-header" data-name="jeaxiREY">
                <h5 class="modal-title">{{trans('common.label.add_new_group')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="HtDvwDRi">
                <div id="msg-group" class="display-hide alert alert-success text-left" data-name="zeCSAhCk">
                    <span id='msg-text-group' class="text-left alert-text"><span>
                </div>
                <br>
                <form action="" id="frm-group" method="post" class="form-horizontal">
                    @for ($i = 1; $i < 2; $i++)
                        <div class="col-md-12" data-name="UeeDtYIY">
                            <div class="form-group row" data-name="YmRAxYcv">
                                <label class="col-md-3 col-form-label" >{{trans('common.label.group_name')}}</label>
                                </label>
                                <div class="col-md-8" data-name="qXXtiidX">
                                    <input type="text"  name="name[]" class="form-control"  {{ ($i == 1) ? 'required' : '' }}>
                                </div>
                            </div>
                        </div>
                    @endfor
                    <div class="form-actions col-md-12" data-name="qxgdQxbc">
                        <div class="row" data-name="ZloZPENs">
                            <label class="col-md-3 col-form-label" ></label>
                            <div class="col-md-9" data-name="yzkKLMqq">
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