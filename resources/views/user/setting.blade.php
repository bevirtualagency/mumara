@extends('layouts.master2')

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/profile.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('content')

<!-- END PAGE HEADER-->
@if($errors->any())
<!-- For PHP validations errors-->
<div class="alert alert-danger" data-name="pAGKpNcx">
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="DofdxpxH">
    {{ Session::get('msg') }}
</div>

@endif
@if (Session::has('error'))
<div class="alert alert-danger" data-name="EGfPjTYV">
    <p>{{ Session::get('error') }}</p>
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="phEfnZHp">
    <span id='msg-text'><span>
</div>
<?php
$setting = new \stdClass();
?>

<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="wQlzfZyd">
    <div class="row" data-name="BsGgVmkN">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="SgQSamlp">
            <div class="kt-portlet__body" data-name="sghrvmhg">
                <div class="tabbable tabbable-tabdrop" data-name="kquBNyLG">
                    <ul class="nav nav-tabs" role="tablist">

                        <li class="nav-item">
                            <a href="#tab1" class="nav-link active" data-toggle="tab">
                                {{trans('users.user_setting_blade.user_setting_txt')}}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content" data-name="VFADfJFl">
                        <div class="tab-pane active" id="tab1" data-name="YXyXlaJE">
                            <div class="col-md-12" data-name="NWZwHBDn">
                                <form action="{{ route('user.setting',  $user->id) }}" method="POST"
                                    id="profile-frm" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="profile">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="user-id" value="{{$user->id}}">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="kt-portlet__body" data-name="OEHetgQF">
                                        <div class="form-body" data-name="uMgmACXR">
                                           
                                            <div class="form-group row" data-name="QlpaeEae">
                                           

                                                <div class="col-md-6" data-name="xgeYaDyJ">
                                                    <label class="col-form-label">{{trans('common.label.time_zone')}} </label>
                                                    <select name="time_zone" class="form-control m-select2"
                                                        id="time_zone">{
                                                        @foreach ($timezones as $time_zone => $time_zone_name)
                                                        {
                                                        <option value="{{$time_zone}}"
                                                            {{ ($time_zone == $users->timezone) ? 'selected' : '' }}>
                                                            {{ $time_zone_name }}</option>
                                                        }
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="kt-portlet__foot" data-name="DbCAXQRY">
                                            <div class="form-actions" data-name="NUOcrMFH">
                                                <div class="row" data-name="sRQjikcH">
                                                    <div class="col-md-12" data-name="WSdtLDZq">
                                                        <button type="submit" name="save_add" class="btn btn-success" value="save_add">
                                                            {{trans('common.form.buttons.save')}}
                                                        </button>
                                                    </div>
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
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>



    <!-- END FORM-->
    @endsection
    @section('page_scripts')
    <script src="/themes/default/js/jquery.form.min.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validate.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/additional-methods.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/init.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/select2.full.min.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript">
    </script>
    <script src="/themes/default/js/form-controls.js"
        type="text/javascript"></script>

    <script src="/themes/default/js/includes/intlTelInput.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/validate-form.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/profile.js" type="text/javascript"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $(".sb-form").click(function (e) {
            btn_id = this.id;
            id = '{{$user->id}}';
                method = "POST";
                route = '{{route('updateProfile')}}';
            
            formId = "#security";
            createOrUpdate(method, route, formId,e,btn_id);
        });
    });
    $('.form-control').on('keypress keyup change', function(e) {
        id = this.id;
        id = '#'+id;
        err_id = '#'+this.id+'-error';
        $(id).removeClass('is-invalid');
        $(err_id).css('display','none');
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
    <script type="text/javascript">
    $(document).ready(function() {

        $("#mobile").intlTelInput({
            placeholderNumberType: "MOBILE",
            separateDialCode: true,
            utilsScript: '{{ URL("/themes/default/js/includes/utils.js") }}'
        });

        var mobnum = $("#mobile").val();
        var codd = $('#ccode').val();
        $("#mobile").intlTelInput("setNumber", "+" + codd);
        $("#mobile").val(mobnum);
        $("#mobile").on("countrychange", function(e, countryData) {
            $("#ccode").val(countryData.dialCode);
        });

        $("#code-confirm").click(function() {
            $('.blockUI').show();
            setTimeout(function() {
                $(".qr-codeBlk").hide();
                $('.blockUI').show();
                $("form#s_step").show();
                $('.blockUI').hide();
            }, 1000);
        });

        $("#backtocode").click(function() {
            $("form#s_step").hide();
            $(".qr-codeBlk").show();
        });

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
        $('#time_zone, #country').select2({
            placeholder: "Select option"
        });
    });


    function addToList()
    {
        ip = $('.ipaddress').text();
     	ips = $('#login_ips').val();
     	if(ips!=="")
         	ips = ips+"\n"+ip;
     	else ips =ip;
     	$('#login_ips').val(ips);
     	$('.bt').prop('disabled',true);
     	
        
    }
    </script>
    @endsection