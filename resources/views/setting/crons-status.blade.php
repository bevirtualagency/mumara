@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/cron-status.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Tools/Cron-Status");
        
    });
    function copyFunction() {
      var copyText = document.getElementById("optkey");
      copyText.select();
      document.execCommand("copy");
      //alert("Copied the text: " + copyText.value);
      //var msg = trans("app.dashboard.lang.success_copied");
      Command: toastr["success"] ("{{ trans("common.message.success_copied") }}"); 
    }
</script>
@endsection
@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="DyFfsSvE">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="uKZLgqtO">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-8 create-form" data-name="JuQClxqX"> 
        <form action="{{ route('setting.crons') }}" method="POST" id="token-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        <div class="row" data-name="ZZmEFWRf">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="qBqXMEXC">
                <div class="kt-portlet__head" data-name="tqHyDNUh">
                    <div class="kt-portlet__head-label" data-name="bAOISGRw">
                        <h3 class="kt-portlet__head-title">{{trans('tools.cron_status.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="QKTJxeZR">
                    <div class="form-body" data-name="pcbcflYV">
                        <div class="form-group row" data-name="RlMLSmyU">
                            <label class="col-form-label col-md-3">{{trans('tools.cron_status.job_command')}}</label>
                            <div class="col-md-6" data-name="UtUisXgy">
                                <?php
                                 try { 
                                    $phpPath = exec("which php");
                                 } catch(\Exception $e) { 
                                    $phpPath = "/usr/bin/php73";
                                 }
                                if(!$phpPath)
                                    $phpPath = "/usr/bin/php";

                                $cron = $phpPath .' '.base_path().DIRECTORY_SEPARATOR.'artisan schedule:run';
                                ?>
                                <div class="input-icon right" data-name="yDCRkiDF">
                                    <i class="fa fa-copy" onclick="copyFunction()"></i>
                                    <input id="optkey" onclick="copyFunction()" type="text" value="{{$cron}}" readonly="" name="main-cron"class="form-control">
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group row bb1s" data-name="PGnVrmfM">
                            <label class="col-form-label col-md-3">{{ $pageTitle}}</label>
                            <div class="col-md-6 col-form-label" style="text-align: left;" data-name="WAdNCkRW">
                                @if(!$is_running)
                                    <span class="croncheck error"><i class="fa fa-remove"></i></span>
                                @else
                                    <span class="croncheck success"><i class="fa fa-check"></i></span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row bb1s" data-name="shOLvHyv">
                            <label class="col-form-label col-md-3">{{trans('tools.cron_status.job_time')}}
                            </label> 
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="wEdeMZBz">
                                    {{ $time }}
                                </div>
                                <!-- <div class="col-md-6 col-form-label" style="text-align: left;">
                                    ---
                                </div> -->
                        </div>
                        <div class="form-group row bb1s" data-name="vCFJYruL">
                            <label class="col-form-label col-md-3">{{trans('tools.cron_status.email_scheduling')}}
                            </label>
                            @if($cron_email_scheduling_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="pxiadJao">
                                    {{trans('tools.cron_status.last_run')}} {{$cron_email_scheduling_ago}} {{trans('tools.cron_status.mins_ago_at')}} {{$cron_email_scheduling_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="dIMDQUCJ">
                                    {{trans('tools.cron_status.not_yet')}} 
                                </div>
                            @endif
                        </div>
                        <div class="form-group row bb1s" data-name="eSfkBdTG">
                            <label class="col-form-label col-md-3">{{trans('tools.cron_status.trigger_processing')}}
                            </label>
                            @if($cron_trigger_processing_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="dYNnGoUa">
                                    {{trans('tools.cron_status.last_run')}} {{$cron_trigger_processing_ago}} {{trans('tools.cron_status.mins_ago_at')}} {{$cron_trigger_processing_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="ISUpIQgl">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif
                        </div>
                        <div class="form-group row bb1s" data-name="YFeONNdF">
                            <label class="col-form-label col-md-3">{{trans('tools.cron_status.bounce_processing')}}
                            </label>
                            @if($cron_bounce_processing_ago  != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="AUwkocOR">
                                    {{trans('tools.cron_status.last_run')}} {{$cron_bounce_processing_ago}} {{trans('tools.cron_status.mins_ago_at')}} {{$cron_bounce_processing_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="HtQePgyZ">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif                            
                        </div>
                        <div class="form-group row bb1s" data-name="iAfQKWkT">
                            <label class="col-form-label col-md-3">{{trans('tools.cron_status.fbl_processing')}}
                            </label>
                            @if($cron_fbl_processing_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="GHWkPryD">
                                    {{trans('tools.cron_status.last_run')}} {{$cron_fbl_processing_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$cron_fbl_processing_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="BdyuCIXi">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>
                        <div class="form-group row bb1s" data-name="mzwebUXa">
                            <label class="col-form-label col-md-3">{{trans('tools.cron_status.callbacks_processing')}}
                            </label>
                            @if($callbacks_processing_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="XinixAKz">
                                    {{trans('tools.cron_status.last_run')}} {{$callbacks_processing_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$callbacks_processing_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="CqakALjG">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>  

                        <div class="form-group row bb1s" data-name="pcFxjXSP">
                            <label class="col-form-label col-md-3">{{trans('tools.cron_status.maintenance_cron')}}
                            </label>
                            @if($maintenance_cron_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="hKzvDFLg">
                                    {{trans('tools.cron_status.last_run')}} {{$maintenance_cron_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$maintenance_cron_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label" style="text-align: left;" data-name="uBIzjaVc">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>


                        <div class="form-group row bb1s" data-name="pcF5hxjXSP">
                            <label class="col-form-label col-md-3">{{trans('settings.cron.form.pending_stats')}}
                            </label>
                            @if($pending_stats_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$pending_stats_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$pending_stats_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>

                        <?php 
                            try {
                                // get Maintenance Cron from cronjob_logs table
                                $delete_exported_files = DB::table('cronjob_logs')->select('cron', 'datetime')->where('cron', 'delete_exported_files')->orderBy('id', 'desc')->first();
                                $delete_exported_files_datetime = showDateTime(getAuthUser(), $delete_exported_files->datetime, 'system');
                                $delete_exported_files_datetime_ago = \Carbon\Carbon::parse($delete_exported_files->datetime)->diffInMinutes(\Carbon\Carbon::now());
                                $delete_exported_files_datetime = date('d F Y h:i:s A', strtotime($delete_exported_files_datetime));
                            } catch (\Exception $e) {
                                $delete_exported_files_datetime_ago = -1;
                                $delete_exported_files_datetime = 0;
                            }

                        ?>
                        <div class="form-group row bb1s" data-name="pcF5hdxjXSP">
                            <label class="col-form-label col-md-3">{{trans('settings.cron.form.delete_exported_files')}}
                            </label>
                            @if($delete_exported_files_datetime_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$delete_exported_files_datetime_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$delete_exported_files_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>

                        <?php 
                            try {
                                // get Maintenance Cron from cronjob_logs table
                                $email_clicked = DB::table('cronjob_logs')->select('cron', 'datetime')->where('cron', 'email_clicked')->orderBy('id', 'desc')->first();
                                $email_clicked_datetime = showDateTime(getAuthUser(), $email_clicked->datetime, 'system');
                                $email_clicked_datetime_ago = \Carbon\Carbon::parse($email_clicked->datetime)->diffInMinutes(\Carbon\Carbon::now());
                                $email_clicked_datetime = date('d F Y h:i:s A', strtotime($email_clicked_datetime));
                            } catch (\Exception $e) {
                                $email_clicked_datetime_ago = -1;
                                $email_clicked_datetime = 0;
                            }

                        ?>

                        <div class="form-group row bb1s" data-name="pcFc5hxjXSP">
                            <label class="col-form-label col-md-3">Click Tracking
                            </label>
                            @if($email_clicked_datetime_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$email_clicked_datetime_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$email_clicked_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>

                        <?php 
                            try {
                                // get Maintenance Cron from cronjob_logs table
                                $email_opened = DB::table('cronjob_logs')->select('cron', 'datetime')->where('cron', 'email_opened')->orderBy('id', 'desc')->first();
                                $email_opened_datetime = showDateTime(getAuthUser(), $email_opened->datetime, 'system');
                                $email_opened_datetime_ago = \Carbon\Carbon::parse($email_opened->datetime)->diffInMinutes(\Carbon\Carbon::now());
                                $email_opened_datetime = date('d F Y h:i:s A', strtotime($email_opened_datetime));
                            } catch (\Exception $e) {
                                $email_opened_datetime_ago = -1;
                                $email_opened_datetime = 0;
                            }

                        ?>

                        <div class="form-group row bb1s" data-name="pcFc5hxjXSP">
                            <label class="col-form-label col-md-3">Open Tracking
                            </label>
                            @if($email_opened_datetime_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$email_opened_datetime_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$email_opened_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>


                        <?php 
                            try {
                                // get Maintenance Cron from cronjob_logs table
                                $track_processing = DB::table('cronjob_logs')->select('cron', 'datetime')->where('cron', 'track_processing')->orderBy('id', 'desc')->first();
                                $track_processing_datetime = showDateTime(getAuthUser(), $track_processing->datetime, 'system');
                                $track_processing_datetime_ago = \Carbon\Carbon::parse($track_processing->datetime)->diffInMinutes(\Carbon\Carbon::now());
                                $track_processing_datetime = date('d F Y h:i:s A', strtotime($track_processing_datetime));
                            } catch (\Exception $e) {
                                $track_processing_datetime_ago = -1;
                                $track_processing_datetime = 0;
                            }

                        ?>

                        <div class="form-group row bb1s" data-name="pcFc5hxjXSP">
                            <label class="col-form-label col-md-3">Track Processing
                            </label>
                            @if($track_processing_datetime_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$track_processing_datetime_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$track_processing_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>
                        
                        <?php 
                            try {
                                // get Maintenance Cron from cronjob_logs table
                                $triggers_checkup = DB::table('cronjob_logs')->select('cron', 'datetime')->where('cron', 'triggers_checkup')->orderBy('id', 'desc')->first();
                                $triggers_checkup_datetime = showDateTime(getAuthUser(), $triggers_checkup->datetime, 'system');
                                $triggers_checkup_datetime_ago = \Carbon\Carbon::parse($triggers_checkup->datetime)->diffInMinutes(\Carbon\Carbon::now());
                                $triggers_checkup_datetime = date('d F Y h:i:s A', strtotime($triggers_checkup_datetime));
                            } catch (\Exception $e) {
                                $triggers_checkup_datetime_ago = -1;
                                $triggers_checkup_datetime = 0;
                            }

                        ?>

                        <div class="form-group row bb1s" data-name="pcFc5hxjXSP">
                            <label class="col-form-label col-md-3">{{trans('settings.cron.form.trigger_checkup')}}
                            </label>
                            @if($triggers_checkup_datetime_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$triggers_checkup_datetime_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$triggers_checkup_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>


                        <?php 
                            try {
                                // get Maintenance Cron from cronjob_logs table
                                $suppress_subscribers = DB::table('cronjob_logs')->select('cron', 'datetime')->where('cron', 'suppress_subscribers')->orderBy('id', 'desc')->first();
                             
                                $suppress_subscribers_datetime = showDateTime(getAuthUser(), $suppress_subscribers->datetime, 'system');
                                $suppress_subscribers_datetime_ago = \Carbon\Carbon::parse($suppress_subscribers->datetime)->diffInMinutes(\Carbon\Carbon::now());
                                $suppress_subscribers_datetime = date('d F Y h:i:s A', strtotime($suppress_subscribers_datetime));
                            } catch (\Exception $e) {
                                $suppress_subscribers_datetime_ago = -1;
                                $suppress_subscribers_datetime = 0;
                            }

                        ?>

                        <div class="form-group row bb1s" data-name="pcFc5hxjXSP">
                            <label class="col-form-label col-md-3">{{trans('settings.cron.form.suppress_subscriber_title')}}
                            </label>
                            @if($suppress_subscribers_datetime_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$suppress_subscribers_datetime_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$suppress_subscribers_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>


                        <?php 
                            try {
                                // get Maintenance Cron from cronjob_logs table
                                $evergreen_cron = DB::table('cronjob_logs')->select('cron', 'datetime')->where('cron', 'evergreen_cron')->orderBy('id', 'desc')->first();
                                $evergreen_cron_datetime = showDateTime(getAuthUser(), $evergreen_cron->datetime, 'system');
                                $evergreen_cron_datetime_ago = \Carbon\Carbon::parse($evergreen_cron->datetime)->diffInMinutes(\Carbon\Carbon::now());
                                $evergreen_cron_datetime = date('d F Y h:i:s A', strtotime($evergreen_cron_datetime));
                            } catch (\Exception $e) {
                                $evergreen_cron_datetime_ago = -1;
                                $evergreen_cron_datetime = 0;
                            }

                        ?>

                        <div class="form-group row bb1s" data-name="pcFc5hxjXSP">
                            <label class="col-form-label col-md-3">{{trans('settings.cron.form.evergreen_campaign_title')}}
                            </label>
                            @if($evergreen_cron_datetime_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$evergreen_cron_datetime_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$evergreen_cron_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>

                        <?php 
                            try {
                                // get Maintenance Cron from cronjob_logs table
                                $stucked_campaigns = DB::table('cronjob_logs')->select('cron', 'datetime')->where('cron', 'stucked_campaigns')->orderBy('id', 'desc')->first();
                                $stucked_campaigns_datetime = showDateTime(getAuthUser(), $stucked_campaigns->datetime, 'system');
                                $stucked_campaigns_datetime_ago = \Carbon\Carbon::parse($stucked_campaigns->datetime)->diffInMinutes(\Carbon\Carbon::now());
                                $stucked_campaigns_datetime = date('d F Y h:i:s A', strtotime($stucked_campaigns_datetime));
                            } catch (\Exception $e) {
                                $stucked_campaigns_datetime_ago = -1;
                                $stucked_campaigns_datetime = 0;
                            }

                        ?>

                        <div class="form-group row bb1s" data-name="pcFc5hxjXSP">
                            <label class="col-form-label col-md-3">{{trans('settings.cron.form.stucked_campaigns')}}
                            </label>
                            @if($stucked_campaigns_datetime_ago != -1)
                                <div class="col-md-6 col-form-label" style="text-align: left;">
                                    {{trans('tools.cron_status.last_run')}} {{$stucked_campaigns_datetime_ago}} {{trans('tools.cron_status.mins_ago_at')}}  {{$stucked_campaigns_datetime}}
                                </div>
                            @else
                                <div class="col-md-6 col-form-label " style="text-align: left;">
                                    {{trans('tools.cron_status.not_yet')}}
                                </div>
                            @endif 
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- END FORM-->
@endsection