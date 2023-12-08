@extends('layouts.master')

@section('title', trans('app.settings.auto_backup.title'))

@section('page_styles')
    <link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .outer-border {
        border: 1px solid #32c5d2;
    }
    </style>
@endsection

@section('page_scripts')
    <script src="/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script>
        $('#daily-backup').on('switchChange.bootstrapSwitch', function (e, state) {
            if(state){
                $("#backup-days").show();
            }else{
                $("#backup-days").hide();
            }
        });

        $('#weekly-backup').on('switchChange.bootstrapSwitch', function (e, state) {
            if(state){
                $("#backup-weekly").show();
            }else{
                $("#backup-weekly").hide();
            }
        });

        $('#monthly-backup').on('switchChange.bootstrapSwitch', function (e, state) {
            if(state){
                $("#backup-monthly").show();
            }else{
                $("#backup-monthly").hide();
            }
        });

        $('#ftp-backup').on('switchChange.bootstrapSwitch', function (e, state) {
            if(state){
                $("#ftp-backup-setting").show();
            }else{
                $("#ftp-backup-setting").hide();
            }
        });

        $('#backup-dropbox').on('switchChange.bootstrapSwitch', function (e, state) {
            if(state){
                $("#dropbox-backup-setting").show();
            }else{
                $("#dropbox-backup-setting").hide();
            }
        });
    </script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="KSnmbmSo">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.settings.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.settings.auto_backup.title')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.settings.auto_backup.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="dXMlEXkA">
    <p>{{trans('settings.para.database_backup')}}</p>
</div>
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="WxxtRisI">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="XXcFfqef">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="HRfEMpdT">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<form action="{{ route('setting.auto.backup') }}" method="post" class="form-horizontal">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="outer-border portlet box" data-name="SzBasqzV">
<div class="row" style="padding: 5px;" data-name="RLaCpJqh">
        <div class="col-md-6" data-name="xkDoqjEn">
            <div class="portlet box green" data-name="rQgahCzF">
                <div class="portlet-title" data-name="WRMNKQfz">
                    <div class="caption" data-name="nKNUwsxW">
                        <span class="caption-subject bold uppercase">{{trans('app.settings.auto_backup.view.table_headings.backup_settings')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="GEQlKqlq">
                    <div class="form-group" data-name="hzuXrlqq">
                        <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.daily_backup')}}
                        </label>
                        <div class="col-md-7" data-name="NTuuilCd">
                            <div class="input-icon right" data-name="XONXFDDd">
                                <i class="fa"></i>
                                <div class="col-md-8" data-name="nXPGoJZB">
                                @if(isset($backup_setting['daily_backup']) && $backup_setting['daily_backup'] == 'on')
                                    <input type="checkbox" class="make-switch" id="daily-backup" name="daily_backup" data-on-text="Yes" data-off-text="No" checked>
                                @else
                                    <input type="checkbox" class="make-switch" id="daily-backup" name="daily_backup" data-on-text="Yes" data-off-text="No">
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($backup_setting['daily_backup']) && $backup_setting['daily_backup'] == 'on')
                    <div id="backup-days" data-name="PHegNnYe">
                    @else
                    <div id="backup-days" style="display: none;" data-name="KtYxmrBO">
                    @endif
                        <div class="form-group" data-name="WbRGLrGt">
                            <label class="control-label col-md-4">{{trans('settings.sun')}}
                            </label>
                            <div class="col-md-7" data-name="mdznuHSb">
                                <div class="input-icon right" data-name="FjQNlsFK">
                                    <i class="fa"></i>
                                    <div class="col-md-8" data-name="VVwNFMsS">
                                    @if(isset($backup_setting['daily_sun']) && $backup_setting['daily_sun'] == 'on')
                                        <input type="checkbox" class="make-switch" name="daily_sun" data-on-text="Yes" data-off-text="No" checked>
                                    @else
                                        <input type="checkbox" class="make-switch" name="daily_sun" data-on-text="Yes" data-off-text="No">
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="hiOLLFkU">
                            <label class="control-label col-md-4">{{trans('settings.monday')}} 
                            </label>
                            <div class="col-md-7" data-name="mSHcOatP">
                                <div class="input-icon right" data-name="cjXTLEEE">
                                    <i class="fa"></i>
                                    <div class="col-md-8" data-name="hljNfrtM">
                                    @if(isset($backup_setting['daily_mon']) && $backup_setting['daily_mon'] == 'on')
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_mon" data-on-text="Yes" data-off-text="No" checked>
                                    @else
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_mon" data-on-text="Yes" data-off-text="No">
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="RdgxPgvb">
                            <label class="control-label col-md-4">{{trans('settings.tuesday')}} 
                            </label>
                            <div class="col-md-7" data-name="ShvGIcxP">
                                <div class="input-icon right" data-name="cCMzPIUP">
                                    <i class="fa"></i>
                                    <div class="col-md-8" data-name="wCnyVNwv">
                                    @if(isset($backup_setting['daily_tue']) && $backup_setting['daily_tue'] == 'on')
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_tue" data-on-text="Yes" data-off-text="No" checked>
                                    @else
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_tue" data-on-text="Yes" data-off-text="No">
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="YvzWbhnN">
                            <label class="control-label col-md-4">{{trans('settings.wednesday')}} 
                            </label>
                            <div class="col-md-7" data-name="KIPiUppb">
                                <div class="input-icon right" data-name="cTbFCpCC">
                                    <i class="fa"></i>
                                    <div class="col-md-8" data-name="WhcNmDqj">
                                    @if(isset($backup_setting['daily_wed']) && $backup_setting['daily_wed'] == 'on')
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_wed" data-on-text="Yes" data-off-text="No" checked>
                                    @else
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_wed" data-on-text="Yes" data-off-text="No">
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="GcBulNcP">
                            <label class="control-label col-md-4">{{trans('settings.thursday')}} 
                            </label>
                            <div class="col-md-7" data-name="BGhlWmgp">
                                <div class="input-icon right" data-name="pfovCYPr">
                                    <i class="fa"></i>
                                    <div class="col-md-8" data-name="tlLgDDOe">
                                    @if(isset($backup_setting['daily_thu']) && $backup_setting['daily_thu'] == 'on')
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_thu" data-on-text="Yes" data-off-text="No" checked>
                                    @else
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_thu" data-on-text="Yes" data-off-text="No">
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="htmOEqqZ">
                            <label class="control-label col-md-4">{{trans('settings.friday')}}
                            </label>
                            <div class="col-md-7" data-name="vWTBOpsO">
                                <div class="input-icon right" data-name="ODWBetnY">
                                    <i class="fa"></i>
                                    <div class="col-md-8" data-name="CStjgNpM">
                                    @if(isset($backup_setting['daily_fri']) && $backup_setting['daily_fri'] == 'on')
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_fri" data-on-text="Yes" data-off-text="No" checked>
                                    @else
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_fri" data-on-text="Yes" data-off-text="No">
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="MgRRJLUJ">
                            <label class="control-label col-md-4">{{trans('settings.saturday')}} 
                            </label>
                            <div class="col-md-7" data-name="XEYCTEML">
                                <div class="input-icon right" data-name="lfOzjHRS">
                                    <i class="fa"></i>
                                    <div class="col-md-8" data-name="UVGnRwNr">
                                    @if(isset($backup_setting['daily_sat']) && $backup_setting['daily_sat'] == 'on')
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_sat" data-on-text="Yes" data-off-text="No" checked>
                                    @else
                                        <input type="checkbox" class="make-switch" id="multi-threading" name="daily_sat" data-on-text="Yes" data-off-text="No">
                                    @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="XOtYeviX">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.retain_daily_backups')}}
                            </label>
                            <div class="col-md-7" data-name="qwuqCuRU">
                                <div class="input-icon right" data-name="ZwXRPNxx">
                                    <i class="fa"></i>
                                    <div class="col-md-5" data-name="VbXdnaxH">
                                        <input type="text" name="daily_backup_count" class="form-control" value="{{isset($backup_setting['daily_backup_count']) ? $backup_setting['daily_backup_count'] : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" data-name="OjZGaoSD">
                        <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.weekly_backup')}}
                        </label>
                        <div class="col-md-7" data-name="SnCiPLFJ">
                            <div class="input-icon right" data-name="IbMmkjIY">
                                <i class="fa"></i>
                                <div class="col-md-8" data-name="nlsQhUrt">
                                @if(isset($backup_setting['weekly_backup']) && $backup_setting['weekly_backup'] == 'on')
                                    <input type="checkbox" class="make-switch" id="weekly-backup" name="weekly_backup" data-on-text="Yes" data-off-text="No" checked>
                                @else
                                    <input type="checkbox" class="make-switch" id="weekly-backup" name="weekly_backup" data-on-text="Yes" data-off-text="No">
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($backup_setting['weekly_backup']) && $backup_setting['weekly_backup'] == 'on')
                    <div id="backup-weekly" data-name="SMXyfAlw">
                    @else
                    <div id="backup-weekly" style="display: none;" data-name="tZMsmbHT">
                    @endif
                        <div class="form-group" data-name="IfgrxwgJ">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.weekly_backup_day')}}
                            </label>
                            <div class="col-md-7" data-name="snVOIEDC">
                                <div class="input-icon right" data-name="iYDIrZEr">
                                    <i class="fa"></i>
                                    <div class="col-md-5" data-name="bnxDlpAo">
                                        <select id="weekly_backup_day" name="weekly_backup_day" class="form-control"> 
                                            <option value="0" {{ (isset($backup_setting['weekly_backup_day']) && $backup_setting['weekly_backup_day'] == 0) ? 'selected' : '' }}> Sun</option>
                                            <option value="1" {{ (isset($backup_setting['weekly_backup_day']) && $backup_setting['weekly_backup_day'] == 1) ? 'selected' : '' }}> Mon</option>
                                            <option value="2" {{ (isset($backup_setting['weekly_backup_day']) && $backup_setting['weekly_backup_day'] == 2) ? 'selected' : '' }}> Tue</option>
                                            <option value="3" {{ (isset($backup_setting['weekly_backup_day']) && $backup_setting['weekly_backup_day'] == 3) ? 'selected' : '' }}> Wed</option>
                                            <option value="4" {{ (isset($backup_setting['weekly_backup_day']) && $backup_setting['weekly_backup_day'] == 4) ? 'selected' : '' }}> Thu</option>
                                            <option value="5" {{ (isset($backup_setting['weekly_backup_day']) && $backup_setting['weekly_backup_day'] == 5) ? 'selected' : '' }}> Fri</option>
                                            <option value="6" {{ (isset($backup_setting['weekly_backup_day']) && $backup_setting['weekly_backup_day'] == 6) ? 'selected' : '' }}> Sat</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="GmkpsBSu">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.retain_weekly_backups')}}
                            </label>
                            <div class="col-md-7" data-name="rtIKPbnj">
                                <div class="input-icon right" data-name="whAffAMF">
                                    <i class="fa"></i>
                                    <div class="col-md-5" data-name="RUbTpggX">
                                        <input type="text" name="weekly_backup_count" class="form-control" value="{{isset($backup_setting['weekly_backup_count']) ? $backup_setting['weekly_backup_count'] : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" data-name="CisGmILj">
                        <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.monthly_backup')}}
                        </label>
                        <div class="col-md-7" data-name="SHXGwMuq">
                            <div class="input-icon right" data-name="BviTeQsZ">
                                <i class="fa"></i>
                                <div class="col-md-8" data-name="dbYQKeJN">
                                @if(isset($backup_setting['monthly_backup']) && $backup_setting['monthly_backup'] == 'on')
                                    <input type="checkbox" class="make-switch" id="monthly-backup" name="monthly_backup" data-on-text="Yes" data-off-text="No" checked>
                                @else
                                    <input type="checkbox" class="make-switch" id="monthly-backup" name="monthly_backup" data-on-text="Yes" data-off-text="No">
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($backup_setting['monthly_backup']) && $backup_setting['monthly_backup'] == 'on')
                    <div id="backup-monthly" data-name="NevDSyqH">
                    @else
                    <div id="backup-monthly" style="display: none;" data-name="ZQfPrFMz">
                    @endif
                        <div class="form-group" data-name="nUkbQQiX">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.ist_of_month')}}
                            </label>
                        <div class="col-md-7" data-name="WCrzEZOk">
                            <div class="input-icon right" data-name="wNRGOrUM">
                                <i class="fa"></i>
                                <div class="col-md-8" data-name="dETiEtKv">
                                @if(isset($backup_setting['monthly_1']) && $backup_setting['monthly_1'] == 'on')
                                    <input type="checkbox" class="make-switch" name="monthly_1" data-on-text="Yes" data-off-text="No" checked>
                                @else
                                    <input type="checkbox" class="make-switch" name="monthly_1" data-on-text="Yes" data-off-text="No">
                                @endif
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group" data-name="bHqaStCS">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.mid_of_month')}}
                            </label>
                        <div class="col-md-7" data-name="MpGxUsFr">
                            <div class="input-icon right" data-name="pIeoNoja">
                                <i class="fa"></i>
                                <div class="col-md-8" data-name="VxYfqksD">
                                @if(isset($backup_setting['monthly_15']) && $backup_setting['monthly_15'] == 'on')
                                    <input type="checkbox" class="make-switch" name="monthly_15" data-on-text="Yes" data-off-text="No" checked>
                                @else
                                    <input type="checkbox" class="make-switch" name="monthly_15" data-on-text="Yes" data-off-text="No">
                                @endif

                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="form-group" data-name="WKYWbqra">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.retain_monthly_backups')}}
                            </label>
                            <div class="col-md-7" data-name="mMSGhdVF">
                                <div class="input-icon right" data-name="NISAeGiK">
                                    <i class="fa"></i>
                                    <div class="col-md-5" data-name="pEWucZSh">
                                        <input type="text" name="monthly_backup_count" class="form-control" value="{{isset($backup_setting['monthly_backup_count']) ? $backup_setting['monthly_backup_count'] : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6" data-name="auTEBtmU">
            <div class="portlet box green" data-name="utQMEois">
                <div class="portlet-title" data-name="hdjniGxN">
                    <div class="caption" data-name="GSIlBIjf">
                        <span class="caption-subject bold uppercase">{{trans('app.settings.auto_backup.view.table_headings.ftp_backup_setting')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="tRuwgwCR">
                    <div class="form-group" data-name="nRdbrPGq">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.ftp.ftp_backup')}}
                            </label>
                        <div class="col-md-7" data-name="iBHinQBR">
                            <div class="input-icon right" data-name="jfJZLRlz">
                                <i class="fa"></i>
                                <div class="col-md-8" data-name="gmXzaBoP">
                                @if(isset($backup_setting['ftp_backup']) && $backup_setting['ftp_backup'] == 'on')
                                    <input type="checkbox" class="make-switch" id="ftp-backup" name="ftp_backup" data-on-text="Yes" data-off-text="No" checked>
                                @else
                                    <input type="checkbox" class="make-switch" id="ftp-backup" name="ftp_backup" data-on-text="Yes" data-off-text="No">
                                @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @if(isset($backup_setting['ftp_backup']) && $backup_setting['ftp_backup'] == 'on')
                    <div id="ftp-backup-setting" data-name="UIgMuzfQ">
                    @else
                    <div id="ftp-backup-setting" style="display: none;" data-name="jPbFcZwO">
                    @endif
                        <div class="form-group" data-name="NOJleVaz">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.ftp.ftp_host')}}
                            </label>
                            <div class="col-md-6" data-name="UpLcnIrX">
                                <div class="input-icon right" data-name="pCLsqtoU">
                                    <i class="fa"></i>
                                        <input type="text" name="ftp_host" class="form-control" value="{{isset($backup_setting['ftp_host']) ? $backup_setting['ftp_host'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="AQupChmq">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.ftp.ftp_username')}}
                            </label>
                            <div class="col-md-6" data-name="UrkgPBwG">
                                <div class="input-icon right" data-name="MHxTBTtF">
                                    <i class="fa"></i>
                                        <input type="text" name="ftp_username" class="form-control" value="{{isset($backup_setting['ftp_username']) ? $backup_setting['ftp_username'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="zchlAZJD">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.ftp.ftp_password')}}
                            </label>
                            <div class="col-md-6" data-name="iZnTleYe">
                                <div class="input-icon right" data-name="zwjFqkaV">
                                    <i class="fa"></i>
                                        <input type="Password" name="ftp_password" class="form-control" value="{{isset($backup_setting['ftp_password']) ? $backup_setting['ftp_password'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="MLNElEXl">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.ftp.ftp_port')}}
                            </label>
                            <div class="col-md-6" data-name="ggaTXKSy">
                                <div class="input-icon right" data-name="TLWsIisp">
                                    <i class="fa"></i>
                                        <input type="text" name="ftp_port" class="form-control" value="{{isset($backup_setting['ftp_port']) ? $backup_setting['ftp_port'] : '' }}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="wEuqsnJc">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.ftp.ftp_path')}}
                            </label>
                            <div class="col-md-6" data-name="OBDjBKHS">
                                <div class="input-icon right" data-name="pAySInhs">
                                    <i class="fa"></i>
                                        <input type="text" name="ftp_path" class="form-control" value="{{isset($backup_setting['ftp_path']) ? $backup_setting['ftp_path'] : '/' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="portlet box green" data-name="mKKMXWjF">
                <div class="portlet-title" data-name="bkaNFEsV">
                    <div class="caption" data-name="MzDcsYLZ">
                        <span class="caption-subject bold uppercase">{{trans('app.settings.auto_backup.view.table_headings.dropbox_backup_setting')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="ueGAlGvt">
                    <div class="form-group" data-name="yxpjlRze">
                        <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.dropbox.backup_to_dropbox')}}
                        </label>
                        <div class="col-md-7" data-name="oWTrCsNO">
                            <div class="input-icon right" data-name="aNZBOIco">
                                <i class="fa"></i>
                                <div class="col-md-8" data-name="vxCFvRsm">
                                    <input type="checkbox" class="make-switch" id="backup-dropbox" name="multi_threading" data-on-text="Yes" data-off-text="No">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dropbox-backup-setting" style="display: none;" data-name="JEXUbOCJ">
                        <div class="form-group" data-name="AHfQPTRx">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.dropbox.dropbox_permission.title')}}
                            </label>
                            <div class="col-md-8" data-name="DISmvKIJ">
                                <div class="input-icon right" data-name="ROvWeyUj">
                                    <i class="fa"></i>
                                        <a href="#">{{trans('settings.action.click_here')}}</a> {{trans('app.settings.auto_backup.view.fields.dropbox.dropbox_permission.description')}}

                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="qwnoJbRq">
                            <label class="control-label col-md-4">{{trans('app.settings.auto_backup.view.fields.dropbox.dropbox_code')}}
                            </label>
                            <div class="col-md-6" data-name="hPlfTczj">
                                <div class="input-icon right" data-name="CZHTOOfd">
                                    <i class="fa"></i>
                                        <input type="text" name="dropbox_code" class="form-control" value="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="form-actions" data-name="QQZuLgTL">
    <div class="row" data-name="HPVFvPTR">
        <div class="col-md-offset-6" data-name="EkAQOneP">
            <button type="submit" name="submit" class="btn green">{{trans('app.settings.auto_backup.view.buttons.save')}}</button>
        </div>
    </div>
</div>
</form>
<!-- END FORM-->
@endsection