@extends('layouts.master')

@section('title', $page_data['title'])

@section('page_styles')
        <link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet" type="text/css" />
        <link href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
       <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
       <script src="/js/includes/user.js" type="text/javascript"></script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="mzfaDMqb">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.settings.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.settings.general.setup_log_details.title')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{ $page_data['title'] }}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="NIXyxLuV">
    <p> {{getHeading(trans('app.headings.settings.general'))}} </p>
</div>
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="umUgKFHC">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="KoeSXOrh">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="BjMZGwoH">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="row" data-name="jifCccUI"> 
        <form action="{{ route('setting.update',  $setting->id) }}" method="POST" id="" class="form-horizontal">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="setting-id" value="{{ $setting->id }}">
        <input type="hidden" name="_method" value="PUT">

        <div class="col-md-6" data-name="joasOWux">
            <div class="portlet box green" data-name="UafcnrET">
                <div class="portlet-title" data-name="aFsXQRFY">
                    <div class="caption" data-name="fzTNZGzF">
                        <span class="caption-subject bold uppercase">{{trans('app.settings.general.setup_log_details.table_headings.log_details')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="NdMECwjY">
                    <div class="form-body" data-name="RSNWgXJc">
                        <div class="form-group" data-name="qJniVsjk">
                            <label class="control-label col-md-3">{{trans('app.settings.general.setup_log_details.fields.activity_log.title')}}
                            </label>
                            <div class="col-md-8" data-name="ZqDfPEJt">
                            <div class="input-icon right" data-name="CYZohixf">
                                    <i class="fa"></i>
                            <input type="radio" name="activity_log" value="1" {{ (isset($setting->activity_log) && $setting->activity_log == '1') ? 'checked' : '' }}> {{trans('app.settings.general.setup_log_details.fields.activity_log.values.enable')}}
                            <input type="radio" name="activity_log" value="0" {{ (isset($setting->activity_log) && $setting->activity_log == '0') ? 'checked' : '' }}>{{trans('app.settings.general.setup_log_details.fields.activity_log.values.disable')}}
                        </div>
                        </div>
                        </div>
                        <div class="form-group" data-name="BFvzscnz">
                            <label class="control-label col-md-3">{{trans('app.settings.general.setup_log_details.fields.activity_log_record')}}
                            </label>
                            <div class="col-md-8" data-name="wfbXpvlo">
                                <div class="input-icon right" data-name="MbiQRvFS">
                                    <i class="fa"></i>
                                    <input type="text" name="activity_log_record" value="{{isset($setting->activity_log_record) ? $setting->activity_log_record : '' }}" class="form-control" /> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="rLnKmfPt">
                            <label class="control-label col-md-3">{{ trans('app.dashboard.lang.spf_domain') }}
                            </label>
                            <div class="col-md-8" data-name="YiysFFVp">
                                <div class="input-icon right" data-name="LdmJQTbq">
                                    <i class="fa"></i>
                                    <input type="text" name="spf_domain" value="{{isset($setting->spf_domain) ? $setting->spf_domain : '' }}" class="form-control" /> 
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" data-name="JEcPsmFg">
                            <div class="row" data-name="JDBfSKJz">
                                <div class="col-md-offset-6" data-name="ibdtydaK">
                                    <button type="submit" name="submit" class="btn green">{{trans('app.settings.general.setup_log_details.buttons.save')}}</button>
                                </div>
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