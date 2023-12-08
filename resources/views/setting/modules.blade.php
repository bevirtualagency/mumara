@extends('layouts.master')

@section('title', $page_data['title'])

@section('page_styles')
<style type="text/css">
    .form-horizontal .control-label {
        text-align: left;
    }

    .bootstrap-switch.bootstrap-switch-disabled .bootstrap-switch-handle-on, .bootstrap-switch.bootstrap-switch-disabled .bootstrap-switch-label {
        cursor: not-allowed !important;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script type="text/javascript">
$('.user_module').on('switchChange.bootstrapSwitch', function (e, state) {
    var selected = "#"+$(this).val();

    if(state == true){
        $(selected).html('<i class="fa fa-check fa-2x text-success"></i>');
    }else{
        $(selected).html('<i class="fa fa-times fa-2x text-danger"></i>');
    }
    var user_modules = $('.user_module:checkbox:checked').map(function() {
                return this.value;
        }).get();

    $.ajax({
        type   : "POST",
        url    : "{{ URL::route('setting.modules') }}",
        data   : {modules: user_modules},
        success: function(result) {
           // console.log('success');
        }
    });
});
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="dCIXULFI">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.settings.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.settings.user_modules.title')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{ $page_data['title'] }}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="rAKHwPxA">
    <p>{{trans('settings.modules_heading_para')}} </p>
</div>
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="hHtxYvpm">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="TMmGbQSv">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="GKZnyhuB">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="row" data-name="EQpGlesz">
        <form action="" method="" id="" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-12" data-name="KoalQvHd">
            <div class="portlet box green" data-name="nHbmiRpn">
                <div class="portlet-title" data-name="JwuVbNaa">
                    <div class="caption" data-name="vurHniKC">
                        <span class="caption-subject">{{trans('app.settings.user_modules.table_headings.core_modules')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="ltQbkZXF">
                    <div class="form-body" data-name="WehEOXqX">
                        <div class="form-group" data-name="GEfgrWoW">
                            <label class="control-label col-md-3">{{trans('settings.contact_list.label')}} 
                            </label>
                            <div class="col-md-2" data-name="JzGlDrkO">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="loIfMHVw">
                                <p>{{trans('settings.module.para_dummy_text')}} </p>
                            </div>
                            <div class="col-md-1" data-name="gkcKlFxs">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="sHaHCAuc">
                        <div class="form-group" data-name="gdkPueMF">
                            <label class="control-label col-md-3">{{trans('settings.modules.label_search')}}
                            </label>
                            <div class="col-md-2" data-name="quWqVBDU">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="AdtNoBDC">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="kaxPzPfD">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="hxwrDqGg">
                        <div class="form-group" data-name="nkeSTUVi">
                            <label class="control-label col-md-3">{{trans('settings.contacts_import_export')}} 
                            </label>
                            <div class="col-md-2" data-name="izgeHVcH">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="MiONTApN">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="ZyQSiOWB">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="hSMihOaM">
                        <div class="form-group" data-name="PPsPcExw">
                            <label class="control-label col-md-3">{{trans('settings.contact.list_group')}} 
                            </label>
                            <div class="col-md-2" data-name="yPajhLnp">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="KDwsXznB">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="GBRcPMHs">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="gepfvjuO">
                        <div class="form-group" data-name="mFYgyLzM">
                            <label class="control-label col-md-3">{{trans('settings.modules_custom.label')}}  
                            </label>
                            <div class="col-md-2" data-name="BZCmLBAC">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="fRcHgfvy">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="GkmYmCuB">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="inavVTip">
                        <div class="form-group" data-name="zRYiQXei">
                            <label class="control-label col-md-3">{{trans('settings.label_campaign_editor')}}  
                            </label>
                            <div class="col-md-2" data-name="Yggytsou">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="bwwJfRRT">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="yaQCwNgY">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="RVryedfh">
                        <div class="form-group" data-name="oZAAdrzR">
                            <label class="control-label col-md-3">{{trans('settings.campaign_scheduling_label')}} 
                            </label>
                            <div class="col-md-2" data-name="DyzsWjuC">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="sCIWZzNH">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="PLbBIaaP">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="nSXPCYZy">
                        <div class="form-group" data-name="RMvhhgzE">
                            <label class="control-label col-md-3">{{trans('settings.label_bounce_handle')}} 
                            </label>
                            <div class="col-md-2" data-name="LRSfciVD">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="TJossXba">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="HZExMenl">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="QNOggMUq">
                        <div class="form-group" data-name="PFNocMnl">
                            <label class="control-label col-md-3">{{trans('settings.image_file_label')}} 
                            </label>
                            <div class="col-md-2" data-name="JIRFvsrC">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="CCnpjOMA">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="vGuiYRYE">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="xFWvMzBt">
                        <div class="form-group" data-name="inyYmalL">
                            <label class="control-label col-md-3">{{trans('settings.modules_label_statistics')}}  
                            </label>
                            <div class="col-md-2" data-name="GdPwCbMY">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="PquvhZhu">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="wjrpJOSJ">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="oJItLJJP">
                        <div class="form-group" data-name="AjLJeLMQ">
                            <label class="control-label col-md-3">{{trans('settings.modules_label_security')}}   
                            </label>
                            <div class="col-md-2" data-name="zKNyxUPO">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="DgIwKjkR">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="rotAASsN">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="rvdCFvCD">
                        <div class="form-group" data-name="Fncrertp">
                            <label class="control-label col-md-3">{{trans('settings.modules_label_maintenance_m')}}   
                            </label>
                            <div class="col-md-2" data-name="rgYAtOFV">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="ZsbSmoXA">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="kTJsVUBo">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="qLTvcwQZ">
                        <div class="form-group" data-name="SUnNoVLv">
                            <label class="control-label col-md-3">{{trans('settings.modules_label_auto_upgrade')}}   
                            </label>
                            <div class="col-md-2" data-name="RuPvlhbe">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="qGNGjTvL">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="FZDKucPg">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="VcJHZRXg">
                        <div class="form-group" data-name="jlFZufkO">
                            <label class="control-label col-md-3">{{trans('settings.application.log.title')}} 
                            </label>
                            <div class="col-md-2" data-name="erzJavEw">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="OvKAYYUK">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="QugJCRsy">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                    <div class="form-body" data-name="sxGSemWh">
                        <div class="form-group" data-name="EddrmUsR">
                            <label class="control-label col-md-3">{{trans('settings.modules.label_helpdesk')}} 
                            </label>
                            <div class="col-md-2" data-name="jaPwVKle">
                                 <input type="checkbox" class="make-switch disable" disabled="" name="core_modules[]" checked data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="TRQUxQrQ">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" data-name="XJQTODYn">
                                <i class="fa fa-check fa-2x text-success"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12" data-name="OGczocwX">
            <div class="portlet box green" data-name="NghFMXPB">
                <div class="portlet-title" data-name="kgeVENfe">
                    <div class="caption" data-name="rPpuuknY">
                        <span class="caption-subject">{{trans('app.settings.user_modules.table_headings.premium_modules')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="NkFlLISX">
                    <div class="form-body" data-name="gZYAznNa">
                        <div class="form-group" data-name="dMgFvhiQ">
                            <label class="control-label col-md-3">{{trans('settings.modules_label_segments')}} 
                            </label>
                            <div class="col-md-2" data-name="mcVlhfww">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('segments', explode(',', $user_module)) ? 'checked' : ''}} value="segments" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="iYsYBRbD">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="segments" data-name="WMEgJCKN">
                                @if(isset($user_module) && in_array('segments', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="xbcaWlRq">
                            <label class="control-label col-md-3">{{trans('settings.modules_label_suppression')}}  
                            </label>
                            <div class="col-md-2" data-name="dYkWeIwp">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('suppression', explode(',', $user_module)) ? 'checked' : ''}} value="suppression" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="tHSraxjN">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="suppression" data-name="NGNSpbdq">
                                @if(isset($user_module) && in_array('suppression', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="FuwvuAsP">
                            <label class="control-label col-md-3">{{trans('settings.modules.label_split')}} 
                            </label>
                            <div class="col-md-2" data-name="bhHaVxoB">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('split_tests', explode(',', $user_module)) ? 'checked' : ''}} value="split_tests" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="UBUoavTF">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="split_tests" data-name="uFuQXKsA">
                                @if(isset($user_module) && in_array('split_tests', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="XXijLVED">
                            <label class="control-label col-md-3">{{trans('settings.modules_label_masking')}} 
                            </label>
                            <div class="col-md-2" data-name="sgrVznyV">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('masking_domains', explode(',', $user_module)) ? 'checked' : ''}} value="masking_domains" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="qvFagzRl">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="masking_domains" data-name="qPnHsDvv">
                            @if(isset($user_module) && in_array('masking_domains', explode(',', $user_module)))
                                <i class="fa fa-check fa-2x text-success"></i>
                            @else
                                <i class="fa fa-times fa-2x text-danger"></i>
                            @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="YyIDtcfX">
                            <label class="control-label col-md-3">{{trans('settings.modules_spintags_label')}} 
                            </label>
                            <div class="col-md-2" data-name="stuTdiVD">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('spin_tags', explode(',', $user_module)) ? 'checked' : ''}} value="spin_tags" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="ZhfzJigQ">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="spin_tags" data-name="fvxOtPWh">
                                @if(isset($user_module) && in_array('spin_tags', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="eidZUGtD">
                            <label class="control-label col-md-3">{{trans('settings.modules_autoresponders_label')}} 
                            </label>
                            <div class="col-md-2" data-name="lyXXknJX">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('autoresponders', explode(',', $user_module)) ? 'checked' : ''}} value="autoresponders" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="tAKiuVlD">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="autoresponders" data-name="XzvpwAMd">
                                @if(isset($user_module) && in_array('autoresponders', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="yyJGGgnD">
                            <label class="control-label col-md-3">{{trans('settings.modules_autoresponders_label')}} 
                            </label>
                            <div class="col-md-2" data-name="WwfnPJoD">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('triggers', explode(',', $user_module)) ? 'checked' : ''}} value="triggers" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="AWHHzovh">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="triggers" data-name="osYRMHfU">
                                @if(isset($user_module) && in_array('triggers', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="CWZjkbQe">
                            <label class="control-label col-md-3">{{trans('settings.modules_dynamic_label')}} 
                            </label>
                            <div class="col-md-2" data-name="lrVZLThI">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('dynamic_content', explode(',', $user_module)) ? 'checked' : ''}} value="dynamic_content" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="gNNlTyFc">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="dynamic_content" data-name="ZLdOXvEw">
                                @if(isset($user_module) && in_array('dynamic_content', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="bDSovRqR">
                            <label class="control-label col-md-3">{{trans('settings.modules_website_label')}} 
                            </label>
                            <div class="col-md-2" data-name="jQBFxMvn">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('web_forms', explode(',', $user_module)) ? 'checked' : ''}} value="web_forms" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="GKOsHHvA">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="web_forms" data-name="QOLFHezD">
                                @if(isset($user_module) && in_array('web_forms', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="tTnLfrfV">
                            <label class="control-label col-md-3">{{trans('settings.modules_feedback_label')}} 
                            </label>
                            <div class="col-md-2" data-name="GvtEqrqg">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('feedback_loop', explode(',', $user_module)) ? 'checked' : ''}} value="feedback_loop" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="cqUheJVx">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="feedback_loop" data-name="rbkvVbko">
                                @if(isset($user_module) && in_array('feedback_loop', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="OtlOqosL">
                            <label class="control-label col-md-3">{{trans('settings.modules_email_t_label')}} 
                            </label>
                            <div class="col-md-2" data-name="OETmuNDq">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('email_templates', explode(',', $user_module)) ? 'checked' : ''}} value="email_templates" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="ypvdXYXn">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="email_templates" data-name="OJLHjTHZ">
                                @if(isset($user_module) && in_array('email_templates', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="ImhOGDxe">
                            <label class="control-label col-md-3">{{trans('settings.modules_multi_t_label')}} 
                            </label>
                            <div class="col-md-2" data-name="wcbyspsD">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('multi_threading', explode(',', $user_module)) ? 'checked' : ''}} value="multi_threading" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="uQWjbnwl">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="multi_threading" data-name="WgCaLlAW">
                                @if(isset($user_module) && in_array('multi_threading', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>

                        <div class="form-group" data-name="KZWbTHbX">
                            <label class="control-label col-md-3">{{trans('settings.modules_siteaddress_label')}} 
                            </label>
                            <div class="col-md-2" data-name="bfiLCKzm">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('site_address_smtp', explode(',', $user_module)) ? 'checked' : ''}} value="site_address_smtp" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="zvpvjIro">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="site_address_smtp" data-name="nuaObtLr">
                                @if(isset($user_module) && in_array('site_address_smtp', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                        <div class="form-group" data-name="MhlJFlJB">
                            <label class="control-label col-md-3">{{trans('settings.modules_Dashboard_d_label')}} 
                            </label>
                            <div class="col-md-2" data-name="lxdlHONt">
                                 <input type="checkbox" class="make-switch user_module" {{isset($user_module) && in_array('dashboard_disclaimer', explode(',', $user_module)) ? 'checked' : ''}} value="dashboard_disclaimer" name="modules[]" data-on-text="Yes" data-off-text="No">
                            </div>
                            <div class="form-md-line-input has-info col-md-6" data-name="tykVVrcz">
                                <p>{{trans('settings.module.para_dummy_text')}}</p>
                            </div>
                            <div class="col-md-1" id="dashboard_disclaimer" data-name="TRPwTUUP">
                                @if(isset($user_module) && in_array('dashboard_disclaimer', explode(',', $user_module)))
                                    <i class="fa fa-check fa-2x text-success"></i>
                                @else
                                    <i class="fa fa-times fa-2x text-danger"></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- END FORM-->
@endsection