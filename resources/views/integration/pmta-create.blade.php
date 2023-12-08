@extends('layouts.master2')

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/wizard-2.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/codemirror.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/neo.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/integration-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/codemirror.js" type="text/javascript"></script>
<script src="/themes/default/js/javascript.js" type="text/javascript"></script>
<script src="/themes/default/js/htmlmixed.js" type="text/javascript"></script>
<script src="/themes/default/js/css.js" type="text/javascript"></script>
<script src="/themes/default/js/wizard-2.js?t={{time()}}" type="text/javascript"></script>
{{--<script src="/themes/default/js/includes/pmta.js?t={{time()}}" type="text/javascript"></script>--}}

<script>
    $("a#help-article").css("display", "block");
    $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/add-ons/powermta-integration");
    function copyFunction() {
        var copyText = document.getElementById("optkey");
        copyText.select();
        document.execCommand("copy");
    //    alert("Copied the text: " + copyText.value);
        Command: toastr["success"] ("{{trans('common.label.copy_success')}}: " + copyText.value); 
    }
    function copyFunction2() {
        var copyText = document.getElementById("optkey2");
        copyText.select();
        document.execCommand("copy");
        Command: toastr["success"] ("{{trans('common.label.copy_success')}}: " + copyText.value); 
    }
    function copyFunction3() {
        var copyText = document.getElementById("optkey3");
        copyText.select();
        document.execCommand("copy");
        Command: toastr["success"] ("{{trans('common.label.copy_success')}}: " + copyText.value); 
    }
    function copyFunction4() {
        var copyText = document.getElementById("optkey4");
        copyText.select();
        document.execCommand("copy");
        Command: toastr["success"] ("{{trans('common.label.copy_success')}}: " + copyText.value); 
    }
    function copyFunction5() {
        var copyText = document.getElementById("optkey5");
        copyText.select();
        document.execCommand("copy");
        Command: toastr["success"] ("{{trans('common.label.copy_success')}}: " + copyText.value); 
    }
    function copyFunction6() {
        var copyText = document.getElementById("optkey6");
        copyText.select();
        document.execCommand("copy");
        Command: toastr["success"] ("{{trans('common.label.copy_success')}}: " + copyText.value); 
    }

    function copyFunctionForAll(id) {
        var copyText = document.getElementById("optkey" + id);
        copyText.select();
        document.execCommand("copy");
        Command: toastr["success"] ("{{trans('common.label.copy_success')}}: " + copyText.value); 
    }

    $(document).ready(function() {

        $("#web_monitor_url").keydown(function() {
          $("#btn-next").removeClass("disabled");
        });

        $(".kt-form__actions>.btn-brand").click(function() {
            /*var web_monitor_url = $('#web_monitor_url').val().split('//');
            web_monitor_url = web_monitor_url[1].split(':');
            $('#server_ip').val(web_monitor_url[0]);
            $('#http_port').val(web_monitor_url[1]);*/
        });

        setTimeout(function(){
             $(".form-wizard .steps").fadeIn('300');
        }, 300);

        $("input[name$='type']").click(function() {
            var show = $(this).val();
            $("div.desc").hide();
            $("#type" + show).show();
        });

        //$("#form_wizard_1").find(".button-next").hide();

        $('#verify-connection').click(function() {
            var server_data = new Object;
            server_data['ip'] = $('#server_ip').val();
            server_data['username'] = $('#server_username').val();
            server_data['password'] = $('#server_password').val();
            server_data['ssh_port'] = $('#ssh_port').val();
            $.ajax({
              type: "POST",
              url: "{{ URL::route('pmta.operation.store') }}",
              data: { action: 'verify_connection', server_data: server_data},
              beforeSend: function(xhr) {
                $('#verify-connection').val('{{trans('pmta.message.verifying')}}...');
                $('#verify-connection-msg').html('');
              },
              success: function (result) {
                var obj = JSON.parse(result);
                 if(obj.status == 0) {
                    $('#verify-connection-msg').html(obj.msg);
                    $('#verify-connection').val('{{trans('pmta.verify_connection')}}');
                    $("#btn-next").addClass("disabled");
                 } else {
                    $("#form_wizard_1").find(".button-next").show();
                    $('#verify-connection-msg').html(obj.msg);
                    $('#verify-connection').val('{{trans('pmta.verify_connection')}}');
                    $("#btn-next").removeClass("disabled");
                 }
              }
            });
        });

        $('#verify-web-url').click(function() {
            var web_monitor_url = $("#http").text()  + $('#web_monitor_url').val();
            // console.log(web_monitor_url);
            setTimeout(function () {
                if($('#verify-web-url').val()== '{{trans('pmta.message.verifying')}}...')
                {
                    $('#verify-web-url-msg').html('<span class="alert alert-warning"><div class="alert-text">{{trans("pmta.message.Unable_to_connect")}}</div></span>');
                    $('#verify-web-url').val('{{trans('common.label.verify')}}');
                }

            },5000);
            $.ajax({
              type: "POST",
              url: app_url+"/pmta-operations",
              data: { action: 'web_monitor_url', web_monitor_url: web_monitor_url},
              beforeSend: function(xhr) {
                $('#verify-web-url').val('{{trans('pmta.message.verifying')}}...');
                $('#verify-web-url-msg').html('');
              },
              success: function (result) {
                $("#btn-next").removeClass("disabled");
                var obj = JSON.parse(result);
                 if(obj.status == 0) {
                    $('#verify-web-url-msg').html(obj.msg);
                    $('#verify-web-url').val('{{trans('common.label.verify')}}');
                 } else {
                    $('#verify-web-url-msg').html(obj.msg);
                    $('#verify-web-url').val('{{trans('common.label.verify')}}');
                 }
              }
            });
        });

        $('#submit-subnet-ips').click(function () {
            var subnet_ips = $('#subnet-ips').val();
            if (subnet_ips.length !== 0 ) {
                $.ajax({
                  type: "POST",
                  url: "{{ URL::route('pmta.operation.store') }}",
                  data: { action: 'subnet_ips', subnet_ips: subnet_ips},
                  beforeSend: function(xhr) {
                  },
                  success: function (result) {
                    $('#ips').val(result);
                    $('#modal-subnet-ips').modal('hide');
                  }
                });
            }
        });
    });

    function downloadKeys() {
        var form_data =  $("#pmta-wizard").serialize();
        $.ajax({
            url: app_url+'/pmta/download/keys',
            type: "POST",
            data: form_data,
            success: function(result) {
               // console.log(result);
                //window.location.href = "/storage/pmta-config.zip";
            }
        });
    }
    function showOrHide() {
        if(!$("#pmta").is(':checked')) {
            $('#pop_imap_desc').show();
            $("#accordionExample6 .card").first().children(".card-header").children(".card-title").removeClass("collapsed");
            $("#accordionExample6 .card").first().children(".collapse").addClass("show");
            $('#accordionExample6').show();
        }
        else {
            $('#pop_imap_desc').hide();
            $("#accordionExample6 .card").first().children(".card-header").children(".card-title").addClass("collapsed");
            $("#accordionExample6 .card").first().children(".collapse").removeClass("show");
            $('#accordionExample6').hide();
        }

    }


</script>
<script src="/themes/default/js/jquery-ui.js"></script>
@endsection

@section('content')

@if (Session::has('msg'))
<div class="alert alert-success" data-name="aPqXgkuu">
    {{ Session::get('msg') }}
</div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="gRnExGdc">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="HISTQKsZ">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="hqFyFMsR">
    <div class="col-md-12 wizardNew" data-name="pNrEBeXK">

        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="wWpzrsST">
            <div class="kt-portlet" data-name="sdFpLqRV">
                <div class="kt-portlet__body kt-portlet__body--fit" data-name="opOgBMKQ">
                    <div class="kt-grid  kt-wizard-v2 kt-wizard-v2--white" id="kt_wizard_v2" data-ktwizard-state="step-first" data-name="rCvYJqVB">

                        <div class="kt-grid__item kt-wizard-v2__aside" data-name="OPpuHqOq">

                            <!--begin: Form Wizard Nav -->
                            <div class="kt-wizard-v2__nav" data-name="lyaHFYmt">
                                <div class="kt-wizard-v2__nav-items" data-name="mbZFRfIW">
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                                        <div class="kt-wizard-v2__nav-body" data-name="ZyZTCWMY">
                                            <div class="kt-wizard-v2__nav-icon" data-name="IFTXBFLR">
                                                <i class="flaticon-globe"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="vlLtazPH">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="VgvWSEwG">
                                                    {{trans('pmta.add_new.step1.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="VJPLXieO">
                                                    {{trans('pmta.add_new.step1.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="kegLupfH">
                                            <div class="kt-wizard-v2__nav-icon" data-name="jxHDfvuc">
                                                <i class="flaticon-layers"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="DqThuMyz">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="sWdEZSST">
                                                    {{trans('pmta.add_new.step2.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="iJdZXpYf">
                                                    {{trans('pmta.add_new.step2.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="ihUYCidU">
                                            <div class="kt-wizard-v2__nav-icon" data-name="AvfcRkNe">
                                                <i class="flaticon-clipboard"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="XKnVIbXC">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="EGBtsZQg">
                                                    {{trans('pmta.add_new.step3.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="wrkNkfZB">
                                                    {{trans('pmta.add_new.step3.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="vCssNSQn">
                                            <div class="kt-wizard-v2__nav-icon" data-name="YJfQUKxK">
                                                <i class="flaticon-cogwheel-1"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="qoKqvODo">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="SMsEoWhH">
                                                     {{trans('pmta.add_new.step4.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="oIVPwSiY">
                                                    {{trans('pmta.add_new.step4.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="JdIurhKM">
                                            <div class="kt-wizard-v2__nav-icon" data-name="FTnPbGVO">
                                                <i class="flaticon-earth-globe"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="JjDiTcRi">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="rEpVPapk">
                                                    {{trans('pmta.add_new.step5.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="VKUkJjFk">
                                                   {{trans('pmta.add_new.step5.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="neNwcOBJ">
                                            <div class="kt-wizard-v2__nav-icon" data-name="DLYMxdgP">
                                                <i class="flaticon-map-location"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="zYSXALer">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="LnuBuLHp">
                                                    {{trans('pmta.add_new.step6.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="rCeAcQsF">
                                                    {{trans('pmta.add_new.step6.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="SdghdWca">
                                            <div class="kt-wizard-v2__nav-icon" data-name="ZjEpKiFA">
                                                <i class="flaticon-notes"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="QZePzdOS">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="NrAOTfTX">
                                                    {{trans('pmta.add_new.step7.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="YpqKQICj">
                                                    {{trans('pmta.add_new.step7.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="eDEevAoG">
                                            <div class="kt-wizard-v2__nav-icon" data-name="eypgLEBs">
                                                <i class="flaticon-paper-plane"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="XYaMCZmf">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="xtPVGdhH">
                                                    {{trans('pmta.add_new.step8.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="EUsiuPDz">
                                                    {{trans('pmta.add_new.step8.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="DUphNzEA">
                                            <div class="kt-wizard-v2__nav-icon" data-name="dxoPwuvm">
                                                <i class="flaticon-statistics"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="YZiDKiCl">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="BIJSSrRX">
                                                   {{trans('pmta.add_new.step9.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="RAdvQpEz">
                                                  {{trans('pmta.add_new.step9.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a class="kt-wizard-v2__nav-item" href="#" data-ktwizard-type="step">
                                        <div class="kt-wizard-v2__nav-body" data-name="TUBYmMOn">
                                            <div class="kt-wizard-v2__nav-icon" data-name="MGonjwuQ">
                                                <i class="flaticon-confetti"></i>
                                            </div>
                                            <div class="kt-wizard-v2__nav-label" data-name="zlCHAaiu">
                                                <div class="kt-wizard-v2__nav-label-title" data-name="AlLZbCvE">
                                                    {{trans('pmta.add_new.step10.title')}}
                                                </div>
                                                <div class="kt-wizard-v2__nav-label-desc" data-name="JvRubBBV">
                                                    {{trans('pmta.add_new.step10.description')}}
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>

                            <!--end: Form Wizard Nav -->
                        </div>

                        <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v2__wrapper" data-name="YxysMaLM">

                            @if ($page_data['action'] == 'add')
                             <form action="{{ route('pmta.store') }}" class="kt-form" id="pmta-wizard" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}" autocomplete="off">
                            @else
                             <form action="{{ route('pmta.integration.update',  $pmta->id) }}" method="POST" id="pmta-wizard" class="kt-form">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" name="_method" value="PUT">
                            @endif
                            @if($allow == 1)

                                <div class="tab-content" data-name="ngVbXnyW">
                                    <div class="alert alert-danger display-none" data-name="giVelrbM">
                                        <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} </div>
                                    <div class="alert alert-success display-none" data-name="pXOOHIGL">
                                        <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} </div>

                                    <!--begin: Form Wizard Step 1-->
                                    <div class="kt-wizard-v2__content" id="tab1" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="wJhBnlRS">
                                        <div class="form-group row" data-name="AkersahW">
                                            <h3 class="m-form__heading-title">
                                                {{trans('pmta.add_new.step1.form.heading')}}
                                            </h3>
                                            <p>{{trans('pmta.add_new.step1.form.description')}}</p>
                                        </div>

                                        <div class="form-group row" data-name="dqNLbzHE">
                                            <label class="col-form-label col-md-3">{{trans('pmta.pmta_create_blade.version_label')}}</label>
                                            <div class="col-md-2" data-name="mCtbNWhe">
                                                <select class="form-control select2-multiple" name="pmta_version">
                                                    <option value="4">{{trans('4.x')}} </option>
                                                    <option value="5" selected>{{trans('5.x')}} </option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row" data-name="rfOHawyb">
                                            <label class="col-form-label col-md-3">@lang('pmta.add_new.step1.form.protocol')
                                            </label>
                                            <div class="col-md-8" data-name="doCMBQaT">
                                                <div class="kt-radio-inline" data-name="IaIjeJSw">
                                                    <label class="kt-radio text-right">
                                                        <input type="radio" name="protocol" value="http" onchange="changeProtocol('http')" checked> @lang('common.label.http')
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="protocol" value="https" onchange="changeProtocol('https')" > @lang('common.label.https')
                                                        <span></span>
                                                    </label>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <script> 
                                                function changeProtocol(protocol) { 
                                                    $("#http").text(protocol + "://");
                                                }
                                        </script>
                                        

                                        <div class="form-group row" data-name="JyvjBoku">
                                            <label class="col-form-label col-md-3">@lang('pmta.add_new.step1.form.pmta_access_url')
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step1.form.pmta_access_url_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8 input-group" data-name="ssiBRGJl">
                                                <div class="input-group-prepend" data-name="JgzYcbXQ">
                                                    <span class="input-group-text" id="http">http://</span>
                                                </div>
                                                <input type="text" class="form-control" id="web_monitor_url" name="web_monitor_url" value="{{isset($pmta->web_monitor_url) ? $pmta->web_monitor_url : '' }}" required="required" />
                                                <div class="help-block" data-name="kCjOFTRt"> @lang('pmta.add_new.step1.form.pmta_access_url_note',['ip'=>$_SERVER['SERVER_ADDR']])</div>
                                            </div>
                                           
                                        </div>

                                        <div class="form-group row" data-name="EERByGla">
                                            <div class="col-md-8 offset-md-3" data-name="xVGLAqnE">
                                                <label>
                                                    
                                                <input type="button" name="verify_web_url" id="verify-web-url" value="{{trans('common.label.verify')}}" class="btn btn-info btn-sm">
                                                {!! popover('pmta.add_new.step1.form.verify_help','common.description') !!}
                                                </label>
                                                <span id='verify-web-url-msg'></span>
                                                <br>
                                                <span class="alert alert-info">
                                                   @lang('pmta.add_new.step1.form.failed_note')
                                                </span>
                                            </div>
                                        </div>

                                       

                                    </div>
                                    <!--end: Form Wizard Step 1-->

                                    <!--begin: Form Wizard Step 2-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab2" data-name="afYFvTxM">
                                        <div class="form-group row" data-name="gQybESPL">
                                            <h3 class="m-form__heading-title">
                                                {{trans('pmta.add_new.step2.form.heading')}}
                                            </h3>
                                            <p>{{trans('pmta.add_new.step2.form.description')}}</p>
                                        </div>
                                        <div class="form-group row" data-name="WTnbgqne">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step2.form.server_name')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step2.form.server_name_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="RKSJRjQC">
                                                <input type="text" class="form-control" id="server-name" name="server_name" value="{{isset($pmta->server_name) ? $pmta->server_name : '' }}" required="required" />
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row" data-name="aOPmbOhy">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step2.form.server_ip')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step2.form.server_ip_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="gBPXPUvC">
                                                <input type="text" class="form-control" name="server_ip" id="server_ip" value="{{isset($pmta->server_ip) ? $pmta->server_ip : '' }}" required="required" />
                                            </div>
                                           
                                        </div>
                                        <div class="form-group row" data-name="KneuFyvA">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step2.form.ssh_port')}}
                                                 {!! popover('pmta.add_new.step2.form.ssh_port_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="qXyaiaCD">
                                                <input type="text" class="form-control" id="ssh_port" name="ssh_port" value="{{isset($pmta->ssh_port) ? $pmta->ssh_port : '22' }}" />
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row" data-name="GulMnkzs">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step2.form.username')}}
                                                {!! popover('pmta.add_new.step2.form.username_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="BwKbgIQD">
                                                <input type="text" class="form-control" autocomplete="off" name="server_username" id="server_username" value="{{isset($pmta_data->server_username) ? $pmta_data->server_username : 'root' }}" />
                                            </div>
                                            
                                        </div>
                                        <div class="form-group row" data-name="TWoZKbKh">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step2.form.password')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step2.form.password_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="krOAwBHk">
                                                <input type="password" class="form-control" autocomplete="off" name="server_password" id="server_password" value="{{isset($pmta_data->server_password) ? $pmta_data->server_password : '' }}" required="required" />
                                            </div>
                                            

                                        </div>
                                        <div class="form-group row" data-name="GWHIEwpH">
                                            <label class="col-form-label col-md-3">
                                                {{trans('pmta.add_new.step2.form.operating_system')}}
                                                {!! popover('pmta.add_new.step2.form.operating_system_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="vhYMPvwl">
                                                <select class="form-control select2-multiple" name="os">
                                                    <option value="centos6">{{trans('pmta.add_new.step2.form.centos6')}}</option>
                                                    <option value="centos7">{{trans('pmta.add_new.step2.form.centos7')}}</option>
                                                    <option value="ubuntu">{{trans('pmta.add_new.step2.form.ubuntu')}}</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row" data-name="mLgfyxOo">
                                            <div class="col-md-8 offset-md-3" data-name="kdmhfCyq">
                                                <input type="button" name="verify_connection" id="verify-connection" value="{{trans('pmta.verify_connection')}}" class="btn btn-info btn-sm">
                                                <span id='verify-connection-msg'></span>
                                                <div class="alert alert-warning alert-bold" role="alert" id="ssh-connection-msg" data-name="HgBnPuRq">
                                                    <div class="alert-text" data-name="HFLjqgIx">{{ trans('pmta.add_new.step2.form.step2_help') }}</div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                    <!--end: Form Wizard Step 2-->

                                    <!--begin: Form Wizard Step 3-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab3" data-name="HxkHaewz">
                                        <div class="form-group row" data-name="tkQlZkiB">
                                            <h3 class="m-form__heading-title">
                                                 {{trans('pmta.add_new.step3.form.heading')}}
                                            </h3>
                                            <p>{{trans('pmta.add_new.step3.form.description')}}</p>
                                        </div>
                                        <div class="form-group row" data-name="oJwczKcg">
                                            <label class="col-form-label col-md-3">{{trans('common.label.host')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step3.form.host_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="CvFtCXFR">
                                            <?php $pp_domain = str_replace(array("https://" , "http://", "www.") , "" , $primary_domain) ?>
                                                <input type="text" class="form-control" name="smtp_host" value="{{isset($pmta->smtp_host) ? $pmta->smtp_host : 'smtp.' . $pp_domain }}" placeholder="selector" required="required" />
                                                <small> {{trans('pmta.add_new.step3.form.host_suggestion')}}</small>
                                                <!-- <div class="dmnName">.{{$primary_domain}}</div> -->
                                            </div>
                                           
                                        </div>
                                        <div class="form-group row" data-name="yspeTvwS">
                                            <label class="col-form-label col-md-3">{{trans('common.label.port')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step3.form.port_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="aFVGbuSo">
                                                <input type="number" class="form-control" name="smtp_port" value="{{isset($pmta->smtp_port) ? $pmta->smtp_port : '25' }}" placeholder="25" />
                                            </div>
                                           
                                        </div>
                                        <div class="form-group row" data-name="TOoUTLvX">
                                            <label class="col-form-label col-md-3">
                                                {{trans('common.label.encryption')}} 
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step3.form.encryption_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="DnlxExAL">
                                                <select class="form-control" name="smtp_encryption" required="">
                                                    <option value="none">{{trans('common.label.none')}}</option>
                                                    <option value="tls" selected>{{trans('common.label.tls')}}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 3-->

                                    <!--begin: Form Wizard Step 4-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab4" data-name="enpauDCx">
                                        <div class="form-group row" data-name="xIiCARzD">
                                            <h3 class="m-form__heading-title">
                                                {{trans('pmta.add_new.step4.form.heading')}}
                                            </h3>
                                            <p>{{trans('pmta.add_new.step4.form.description')}}</p>
                                        </div>
                                        <div class="form-group row" data-name="SxoYAHCS">
                                            <label class="col-form-label col-md-3">
                                                {{trans('pmta.add_new.step4.form.physical_path')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step4.form.physical_path_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="OmdeQZDo">
                                                <input type="text" class="form-control" name="pmta_physical_location" value="/etc/pmta" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="WxLQVmSY">
                                            <label class="col-form-label col-md-3">
                                                {{trans('pmta.add_new.step4.form.management_port')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step4.form.management_port_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="QhZdmAYW">
                                                <input type="text" class="form-control" name="http_port" id="http_port" value="{{isset($pmta_data->http_port) ? $pmta_data->http_port : '8080' }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="zVHvdYPV">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.admin_ips')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step4.form.admin_ips_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="AqnFCHDP">
                                                <input type="text" class="form-control" name="ips_admin_access" value="{{isset($pmta_data->ips_admin_access) ? $pmta_data->ips_admin_access : $_SERVER['SERVER_ADDR'] }}" required="required" />
                                            </div>
                                        </div>
                                        <!-- <div class="form-group row">
                                            <label class="col-form-label col-md-3">{{trans('app.integration.pmta.add_new.fields.ip_domains.values.local_dsn')}}</label>
                                            <div class="col-md-8">
                                                <input type="checkbox" class="make-switch" name="deliver_local_dns" checked data-on-text="Yes" data-off-text="No">
                                            </div>
                                        </div> -->
                                        <div class="form-group row" data-name="TvGEFGpT">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.log_file')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step4.form.log_file_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="MeZjOgay">
                                                <input type="text" class="form-control" name="log_files_path" value="{{isset($pmta_data->log_files_path) ? $pmta_data->log_files_path : '/var/log/pmta/pmta.log' }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="nABWmXZC">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.log_rotation')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step4.form.log_rotation_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="ATXEyUdD">
                                                <input type="text" class="form-control" name="log_files_rotation" value="{{isset($pmta_data->log_files_rotation) ? $pmta_data->log_files_rotation : '1' }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="PCpqnOSp">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.accounting_files')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step4.form.accounting_files_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="GsZyjHaL">
                                                <input type="text" class="form-control" name="accounting_files_path" value="{{isset($pmta_data->accounting_files_path) ? $pmta_data->accounting_files_path : '/etc/pmta/files/acct/acct.csv' }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="oYwBVpuq">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.account_files_rotation')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step4.form.account_files_rotation_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="EVJvBCQf">
                                                <input type="text" class="form-control" name="accounting_files_rotation" value="{{isset($pmta_data->accounting_files_rotation) ? $pmta_data->accounting_files_rotation : '7d' }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="eeQgZfXF">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.diag_files')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step4.form.diag_files_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="hKYrXVLo">
                                                <input type="text" class="form-control" name="diag_files_path" value="{{isset($pmta_data->diag_files_path) ? $pmta_data->diag_files_path : '/etc/pmta/files/diag/diag.csv' }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="yUxXoFSJ">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.diag_files_rotation')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step4.form.diag_files_rotation_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="TJoTESTz">
                                                <input type="text" class="form-control" name="diag_files_rotation" value="{{isset($pmta_data->diag_files_rotation) ? $pmta_data->diag_files_rotation : '7d' }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="AIyfUQKw">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.spool_path')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step4.form.spool_path_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="apSOCNuq">
                                                <input type="text" class="form-control" name="spool_path" value="{{isset($pmta_data->spool_path) ? $pmta_data->spool_path : '/var/spool/pmta' }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="rPKlzEHq">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.domain_keys_path')}}
                                                <span class="required"> * </span>
                                                 {!! popover('pmta.add_new.step4.form.domain_keys_path_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="vgRhIheQ">
                                                <input type="text" class="form-control" name="private_domain_key_path" value="{{isset($pmta_data->private_domain_key_path) ? $pmta_data->private_domain_key_path : '/etc/pmta/dkim' }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="XokVemwa">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.dkim_selector')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step4.form.dkim_selector_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="oRVWRhQw">
                                                <input type="text" class="form-control" name="dkim_selector" value="{{isset($pmta_data->dkim_selector) ? $pmta_data->dkim_selector : $default_dkim_selector }}" required="required" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="WjJwuktv">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.tracking_domain_prefix')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step4.form.tracking_domain_prefix_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="AgtULsvZ">
                                                <input type="text" id="masking-domain-selector" class="form-control" name="masking_domain_selector" value="{{isset($pmta_data->masking_domain_selector) ? $pmta_data->masking_domain_selector : $default_tracking_selector }}" />
                                            </div>
                                        </div>
                                        <div class="form-group row" data-name="NRYeuKuY">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.vmta_prefix')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step4.form.vmta_prefix_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="gCnacPkz">
                                                <input type="text" class="form-control" name="vmta_selector" value="{{isset($pmta_data->vmta_selector) ? $pmta_data->vmta_selector : 'vmta' }}" />
                                            </div>
                                        </div>
                                        <hr />
                                        <div class="col-md-offset-2" data-name="qhMIOhRX">
                                            <span class="font-green-sharp bold uppercase">{{trans('pmta.add_new.step4.form.authentications')}}</span>
                                        </div>
                                        <hr />
                                        <div class="form-group row" data-name="uZwlEoDp">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step4.form.dkim_fallback_domain')}}
                                                <span class="required"> * </span>
                                                  {!! popover('pmta.add_new.step4.form.dkim_fallback_domain_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="klwhAZVt">
                                                <input type="text" class="form-control" name="dkim_fallback_domain" value="{{rtrim(str_replace(array('http://','https://', 'www.'),array('','' , ''),config('app.domain_url')),'/')}}" />
                                            </div>
                                        </div>
                                        <!--
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3">{{trans('app.integration.pmta.add_new.fields.ip_domains.values.spf_include_domain')}}
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="spf_include_domain" value="{{config('app.domain_url')}}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3">{{trans('app.integration.pmta.add_new.fields.ip_domains.values.cname_domain')}}
                                            </label>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" name="cname_domain" value="{{str_replace('www.', '', config('app.domain_url'))}}" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-form-label col-md-3">{{trans('app.integration.pmta.add_new.fields.ip_domains.values.domain_key_size_in_bits')}}
                                            </label>
                                            <div class="col-md-8">
                                                <input type="checkbox" class="make-switch" name="key_size" checked data-on-text="1024" data-off-text="2048" data-off-color="success">
                                            </div>
                                        </div> -->
                                        <div class="form-group row" data-name="rwBMsIqM">
                                            <label class="col-form-label col-md-3">
                                                {{trans('pmta.add_new.step4.form.domain_key_size_in_bits')}}
                                                 {!! popover('pmta.add_new.step4.form.domain_key_size_in_bits_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="makDjSii">
                                                <div class="kt-radio-inline" data-name="yOhBfnGu">
                                                    <label class="kt-radio">
                                                        <input type="radio" name="domain_key_size" value="1024" checked="checked"> 1024
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="domain_key_size" value="2048"> 2048
                                                        <span></span>
                                                    </label>
                                                    <label class="kt-radio">
                                                        <input type="radio" name="domain_key_size" value="4096"> 4096
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 4-->

                                    <!--begin: Form Wizard Step 5-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab5" data-name="hJWDAgMF">
                                        <div class="form-group row" data-name="RhxVdmka">
                                            <h3 class="m-form__heading-title">
                                                {{trans('pmta.add_new.step5.form.heading')}}
                                            </h3>
                                            <p>{{trans('pmta.add_new.step5.form.description')}}</p>
                                        </div>
                                        <div class="form-group row" data-name="SBnYKmte">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step5.form.ip_addresses')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step5.form.ip_addresses_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="xhcrGJgq">
                                                <textarea id="ips" name="ips" class="form-control" rows="5">{{@$pmta_data->ips}}</textarea>
                                                <label class="mt5">
                                                <a href="#modal-subnet-ips" data-toggle="modal" class="btn btn-success btn-xs">{{trans('pmta.add_new.step5.form.enter_a_subnet')}} </a>
                                                {!! popover('pmta.add_new.step5.form.enter_a_subnet_help','common.description') !!}
                                                </label>
                                            </div>
                                        </div>

                                        <div class="form-group row" data-name="jfMDsOYg">
                                            <label class="col-form-label col-md-3">{{trans('pmta.add_new.step5.form.sending_domains')}}
                                                <span class="required"> * </span>
                                                {!! popover('pmta.add_new.step5.form.sending_domains_help','common.description') !!}
                                            </label>
                                            <div class="col-md-8" data-name="spHdQnFj">
                                                <textarea id="domains" name="domains" class="form-control" rows="5">{{@$pmta_data->domains}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 5-->

                                    <!--begin: Form Wizard Step 6-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab6" data-name="YmkJQAWO">
                                        <div class="form-group row" data-name="mVpUKnXK">
                                            <h3 class="m-form__heading-title">
                                                {{trans('pmta.add_new.step6.form.heading')}}
                                            </h3>
                                            <p>{{trans('pmta.add_new.step6.form.description')}}</p>
                                        </div>
                                        <div id="split-ips-domains" data-name="MKNncQeM"></div>
                                        <textarea id="ips_array" style="display:none"  name="ips_array"></textarea>
                                    </div>
                                    <!--end: Form Wizard Step 6-->

                                    <!--begin: Form Wizard Step 7-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab7" data-name="SxhynKGL">
                                        <div class="form-group mb0" data-name="FEOHPbTn">
                                            <h3 class="m-form__heading-title">
                                               {{trans('pmta.add_new.step7.form.heading')}}
                                            </h3>
                                        </div>
                                        <div class="form-group row  mb0" data-name="IQYlDAzV">
                                            <label class="col-form-label col-md-4">
                                               {{trans('pmta.add_new.step7.form.description')}}
                                                <span class="required"> * </span>
                                            </label>
                                            <div class="col-md-6" id="pops" data-name="zBoIXDjk">
                                                <div class="input-icon" data-name="NfXaqwAm">
                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                        <label>
                                                            <input id="pmta" value="1" checked type="checkbox" onchange="showOrHide()" name="pmta">
                                                            <span></span>
                                                        </label>
                                                    </span>

                                                </div>
                                            </div>
                                        </div>
                                        <p id="pop_imap_desc" style="display: none;" > {{trans('pmta.add_new.step7.form.heading')}}</p>
                                        <br>
                                        <div class="row" data-name="ReKAQIBs">
                                            <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6" data-name="uYgBoxFu">
                                                <div id="bounce-mailboxes" data-name="qQEkYQts"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 7-->

                                    <!--begin: Form Wizard Step 8-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab8" data-name="lpScJhqX">
                                        <div class="form-group row" data-name="NVyGkWNQ">
                                            <h3 class="m-form__heading-title">
                                                 {{trans('pmta.add_new.step8.form.heading')}}
                                            </h3>
                                            @php 
                                                    $random_name = rand(1111,999999);
                                            @endphp
                                            <input type="hidden" value="{{$random_name}}" name="random_name">
                                            <p class="">{{trans('pmta.add_new.step8.form.description')}}</p>
                                            <a target="_blank" href="{{ url('/pmta/download_config/' . $random_name) }}" class="btn btn-brand btn-sm"  data-name="AImEtliEc">
                                               {{trans('pmta.pmta_create_blade.download_records_action')}}
                                            </a>
                                             <br>
                                        </div>

                                      

                                      


                                        <div class="row" data-name="MaoVXWcr">
                                            <div class="accordion accordion-solid accordion-toggle-arrow" id="accordionExample5" data-name="slmWYuaS">
                                                <div id="sending-domains" data-name="INjCtwXS"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 8-->

                                    <!--begin: Form Wizard Step 9-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab9" data-name="HhtOAWth">
                                        <div class="form-group row" data-name="iLDhQMrE">
                                            <h3 class="m-form__heading-title">
                                                {{trans('pmta.add_new.step9.form.heading')}}
                                            </h3>
                                            <p>{{trans('pmta.add_new.step9.form.description')}}</p>
                                        </div>
                                        <div id="pmta-summery" class="mt0" data-name="nkhdhzDf"></div>
                                    </div>
                                    <!--end: Form Wizard Step 9-->

                                    <!--begin: Form Wizard Step 10-->
                                    <div class="kt-wizard-v2__content" data-ktwizard-type="step-content" id="tab10" data-name="qBtShUHH">
                                        <div id="setup-pmta" data-name="XYzYeDdk"></div>
                                        <div id="success" data-name="qyaiHgsd">
                                            <div class="text-success" data-name="KQZABFyR">
                                                <i class="fa fa-thumbs-up font-green-meadow"></i>
                                                <h1 class="font-green-meadow">{{trans('pmta.congratulations')}}</h1>
                                                <h3 class="font-green-meadow">
                                                    {{trans('pmta.congratulations_help')}}
                                                </h3>
                                                <a href="{{ url('nodes') }}" class="btn btn-outline green btn-lg">{{trans('common.label.finish')}}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end: Form Wizard Step 10-->

                                    <!--begin: Form Actions -->
                                    <div class="kt-form__actions" data-name="RNnwTirK">
                                        <div class="btn btn-secondary btn-md" id="btn-prev" data-ktwizard-type="action-prev" data-name="oRcBTfxR">
                                            @lang('common.label.previous')
                                        </div>
                                        <div class="btn btn-success btn-md" id="btn-finish" data-ktwizard-type="action-submit" data-name="cMynFTUq">
                                            @lang('common.form.buttons.submit')
                                        </div>
                                        <div class="btn btn-brand btn-md" id="btn-next" data-ktwizard-type="action-next" data-name="AImEtliE">
                                            @lang('common.label.next_step')
                                        </div>
                                    </div>
                                    <!--end: Form Actions -->

                                </div>

                            @else
                                <div class="col-md-12" data-name="CJAsTDjT">
                                    <div class="note prDomain" data-name="zrAuctwH">
                                        <p>
                                            {{trans('pmta.message.propagated')}}
                                            <a href="{{ route('setting.primary.domain') }}" type="button" class="btn btn-warning btn-md">{{trans('pmta.set_primary_domain')}}</a>
                                        </p>
                                    </div>
                                </div>
                            @endif
                            </form>

                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div id="modal-subnet-ips" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="pcAXOVwq">
    <div class="modal-dialog" data-name="qAtucvkp">
        <div class="modal-content" data-name="mCecjomX">
            <div id="msg-group" class="display-hide" data-name="bnvtptPd">
                <span id='msg-text-group'><span>
            </div>
            <div class="modal-header" data-name="XDQMKLVn">
                <h5 class="modal-title">{{trans('pmta.enter_subnet')}}</h5>

                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="HrJVdVks">
            <form action="" id="frm-group" method="post" class="form-horizontal" autocomplete="off">
                <div class="form-group row" data-name="nwarunGf">
                    <div class="col-md-12" data-name="kfEbrJmP">
                        <input type="text"  name="subnet_ips" id="subnet-ips" class="form-control" placeholder="{{trans('pmta.enter_subnet')}}" > 
                    </div>
                </div>
                <div class="form-actions" data-name="kvFuCfHd">
                    <div class="row" data-name="mwEmSejO">
                        <div class="col-md-9" data-name="EvlRqbrJ">
                            <button type="button" id="submit-subnet-ips" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                            <button type="reset" class="btn btn-default">{{trans('common.form.buttons.reset')}}</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection