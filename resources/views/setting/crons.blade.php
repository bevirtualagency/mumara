@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/setting-cron.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Settings/Cron-Settings");
        
        $(".blockUI").hide();
        $('.m-select2').select2({
            placeholder: "Select option"
        });
        $("button.btn-success").click(function() {
            $(".blockUI").show();
            setTimeout(function(){
                $("#status").css("display", "flex");
                //Command: toastr["success"] ("Cron successfuly running!");
                $(".blockUI").hide();
            }, 1500);
            setTimeout(function(){
                $("#status").fadeOut();
            }, 6500);
        });
    });
    function runcron(cron) {
        $(".blockUI").show();
        $.ajax({
            url: "{{ URL::route('run.cron.manually') }}",
            type: 'POST',
            data: {cron: cron},
            success: function(result) {
                // console.log(result);
                setTimeout(function(){
                    $("#status").css("display", "flex");
                    //Command: toastr["success"] ("Cron successfuly running!");
                    $(".blockUI").hide();
                }, 1500);
                setTimeout(function(){
                    $("#status").fadeOut();
                    $(".blockUI").hide();
                }, 6500);
            }, 
            error: function(error){
                $(".blockUI").hide();
                console.log(error)
            }
        });
    }
</script>
@endsection

@section(decide_content())
    
    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="jZGdYiMd">
            {{ Session::get('msg') }}
        </div>
    @endif
    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="EqyTuwKU">
    <span id='msg-text'><span>
    </div>
    <!-- BEGIN FORM-->

    <div class="alert alert-success alert-dismissable" id="status" data-name="SYAiheyj">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
        <!-- <strong>{{ trans('app.dashboard.lang.cron') }}</strong>  -->{{ trans('settings.message.running_in_background') }}
    </div>

    <div class="col-md-6 create-form" data-name="RXTvGJFy">
        <form action="{{ route('setting.crons') }}" method="POST" id="token-frm" class="kt-form kt-form--label-right">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="_method" value="PUT">

            <div class="row" data-name="BICYCiRU">
                <div class="kt-portlet kt-portlet--height-fluid" data-name="PTRrZzmy">
                    <div class="kt-portlet__head" data-name="ZYcmGyJB">
                        <div class="kt-portlet__head-label" data-name="svzPolSl">
                            <h3 class="kt-portlet__head-title">{{trans('settings.cron.form.heading')}}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" data-name="RNVyohqL">
                        <div class="form-body" data-name="TLLaBguC">
                            <div class="form-group row" data-name="BjSZSeNS">
                                <label class="col-form-label col-md-12">{{trans('settings.cron.form.email_sending')}}
                                    {!! popover('settings.cron.form.email_sending_help','common.description') !!}
                                </label>
                                <div class="col-md-8" data-name="laPLPGuk">
                                    <select class="form-control m-select2" name="email_send_cron">
                                        <?php $email_send_cron = \App\UserCronSetting::getCronTime("email_send_cron"); ?>
                                        @foreach ($time_1 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{(isset($email_send_cron) &&  $email_send_cron == $time_value) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">{{trans('app.settings.cron.email_sending_note')}}</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('send:campaigns');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                            </div>
                           
                            <div class="form-group row" data-name="cojwyCSi">
                                <label class="col-form-label col-md-12">{{trans('settings.cron.form.trigger_scheduling')}}
                                    {!! popover('settings.cron.form.trigger_scheduling_help','common.description') !!}
                                </label>
                                <div class="col-md-8" data-name="RoEzuSwG">
                                    <select class="form-control m-select2" name="trigger_cron">
                                     <?php $trigger_cron = \App\UserCronSetting::getCronTime("trigger_cron"); ?>
                                        @foreach ($time_2 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{(isset($trigger_cron) && $trigger_cron == $time_value) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">{{trans('app.settings.cron.trigger_scheduling_note')}}</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" style="margin-right:10px"  onclick="runcron('trigger:processing');"><i class="fa fa-angle-right" ></i> {{trans('common.label.run_now')}}</button> 
                                <!-- <button type="button" class="btn btn-warning btn-run" onclick="runcron('trigger:processing --force');"><i class="fa fa-angle-right"></i> Force Run </button>  -->
                            </div>
                            <div class="form-group row" data-name="jWDSQEXc">
                                <label class="col-form-label col-md-12">{{trans('settings.cron.form.bounce_processing')}}
                                    {!! popover('settings.cron.form.bounce_processing_help','common.description') !!}
                                </label>
                                <div class="col-md-8" data-name="jEFadLqJ">
                                    <select class="form-control m-select2" name="bounce_process_cron">
                                    <?php $bounce_process_cron = \App\UserCronSetting::getCronTime("bounce_process_cron"); ?>
                                        @foreach ($time_3 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{(isset($bounce_process_cron) && $bounce_process_cron == $time_value) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">{{trans('app.settings.cron.bounce_processing_note')}}</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" style="margin-right:10px"  onclick="runcron('bounce:processing');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                                <button type="button" class="btn btn-warning btn-run" onclick="runcron('bounce:processing --force');"><i class="fa fa-angle-right"></i> Force Run </button> 
                            </div>
                            <div class="form-group row" data-name="xJlTbfih">
                                <label class="col-form-label col-md-12">
                                    {{trans('settings.cron.form.fbl_processing')}}
                                    {!! popover('settings.cron.form.fbl_processing_help','common.description') !!}
                                </label>
                                <div class="col-md-8" data-name="fLglzHeZ">
                                    <select class="form-control m-select2" name="fbl_cron">
                                    <?php $fbl_cron = \App\UserCronSetting::getCronTime("fbl_cron"); ?>
                                        @foreach ($time_3 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{(isset($fbl_cron) && $fbl_cron == $time_value) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">{{trans('app.settings.cron.fbl_processing_note')}}</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" style="margin-right:10px"  onclick="runcron('fbl:processing');"><i class="fa fa-angle-right"></i>{{trans('common.label.run_now')}}</button> 
                                <button type="button" class="btn btn-warning btn-run" onclick="runcron('fbl:processing --force');"><i class="fa fa-angle-right"></i> Force Run </button> 
                            </div>
                            
                            
                            

                             <div class="form-group row" data-name="VfHXktKq">
                                <label class="col-form-label col-md-12">{{trans('settings.cron.form.maintenance_cron')}}
                                    {!! popover('settings.cron.form.maintenance_cron_help','common.description') !!}
                                </label>
                                <div class="col-md-8" data-name="sCozHdvs">
                                    <select class="form-control m-select2" name="maintenance_cron">
                                    <?php $maintenance_cron = \App\UserCronSetting::getCronTime("maintenance_cron"); ?>
                                         @foreach ($time_3 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{((isset($maintenance_cron) && $maintenance_cron == $time_value) || ( !isset($maintenance_cron) && $time_value==1440) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" style="margin-right:10px" onclick="runcron('run:maintenance');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                                <button type="button" class="btn btn-warning btn-run" onclick="runcron('run:maintenance --force');"><i class="fa fa-angle-right"></i> Force Run </button> 
                            </div>
                            <div class="form-group row" data-name="nCNnhsxMf">
                                <label class="col-form-label col-md-12">{{trans('settings.cron.form.segments_recount')}}
                                    {!! popover('settings.cron.form.segments_recount_help','common.description') !!}
                                </label>
                                <div class="col-md-8" data-name="MiHJWGzw">
                                    <select class="form-control m-select2" name="segments_recount">
                                    <?php $segments_recount = \App\UserCronSetting::getCronTime("segments_recount"); ?>
                                         @foreach ($time_3 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{((isset($segments_recount) && $segments_recount == $time_value) || ( !isset($segments_recount) && $time_value==1440) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('segments:count');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                                <button type="button" class="btn btn-warning btn-run" onclick="runcron('segments:count --force');"><i class="fa fa-angle-right"></i> Force Run </button> 
                            </div>



                            <div class="form-group row " data-name="nCNnhsxMm">
                                <label class="col-form-label col-md-12">{{trans('settings.cron.form.pending_stats')}}
                                    {!! popover('settings.cron.form.pending_stats','common.description') !!}
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control m-select2" name="pending_stats">
                                    <?php $pending_stats = \App\UserCronSetting::getCronTime("pending_stats"); ?>
                                         @foreach ($time_1 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{((isset($pending_stats) && $pending_stats == $time_value) || ( !isset($pending_stats) && $time_value==1440) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('stats:pending');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                            </div>
                            <div class="form-group row" data-name="nCNnhsxd34M">
                                <label class="col-form-label col-md-12">{{trans('settings.cron.form.delete_exported_files')}}
                                    {!! popover('settings.cron.form.delete_exported_files','common.description') !!}
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control m-select2" name="delete_exported_files">
                                    <?php $delete_exported_files = \App\UserCronSetting::getCronTime("delete_exported_files"); ?>
                                         @foreach ($time_3 as $time_value => $time_name) 
                                        <option value="{{$time_value}}" {{((isset($delete_exported_files) && $delete_exported_files == $time_value) || ( !isset($delete_exported_files) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('delete:exportedFiles');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                            </div>


                            <div class="form-group row" data-name="nCNnd56hsxMd">
                                <label class="col-form-label col-md-12">{{trans('Click Tracking')}}
                                    {!! popover('Click Tracking','common.description') !!}
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control m-select2" name="click_tracking">
                                    <?php $click_tracking = \App\UserCronSetting::getCronTime("click_tracking"); ?>
                                         @foreach ($time_1 as $time_value => $time_name) 
                                        <option value="{{$time_value}}" {{((isset($click_tracking) && $click_tracking == $time_value) || ( !isset($click_tracking) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                      
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('email:clicked');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                            </div>

                            <div class="form-group row" data-name="nCNnd56hsxMd">
                                <label class="col-form-label col-md-12">{{trans('Open Tracking')}}
                                    {!! popover('Open Tracking','Open Tracking') !!}
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control m-select2" name="open_tracking">
                                         @foreach ($time_1 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{((isset($cron_setting->open_tracking) && $cron_setting->open_tracking == $time_value) || ( !isset($cron_setting->open_tracking) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('email:opened');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                            </div>


                            <div class="form-group row" data-name="nCNnd56hsxMd">
                                <label class="col-form-label col-md-12">{{trans('Process Tracking')}}
                                    {!! popover('Process Tracking','Process Tracking') !!}
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control m-select2" name="track_processing">
                                         @foreach ($time_1 as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{((isset($cron_setting->track_processing) && $cron_setting->track_processing == $time_value) || ( !isset($cron_setting->track_processing) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('track:processing');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                            </div>



                            
                            <div class="form-group row" data-name="nCNn56hsxgM">
                            <label class="col-form-label col-md-12">{{trans('settings.cron.form.trigger_checkup')}}
                                    {!! popover(trans('settings.cron.form.trigger_checkup_desc'), 'common.description') !!}
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control m-select2" name="triggers_checkup">
                                    <?php $triggers_checkup = \App\UserCronSetting::getCronTime("triggers_checkup"); ?>
                                         @foreach ($time_3 as $time_value => $time_name) 
                                        <option value="{{$time_value}}" {{((isset($triggers_checkup) && $triggers_checkup == $time_value) || ( !isset($triggers_checkup) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                      
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('triggers:checkup');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                            </div>


                            <div class="form-group row" data-name="nCNn56hsxMdds">
                                <label class="col-form-label col-md-12">{{trans('settings.cron.form.suppress_subscriber_title')}}
                                        {!! popover(trans('settings.cron.form.suppress_subscriber_desc'), 'common.description') !!}
                                    </label>
                                    <div class="col-md-8">
                                        <select class="form-control m-select2" name="suppress_subscribers">
                                             @foreach ($time_1 as $time_value => $time_name) {
                                            <option value="{{$time_value}}" {{((isset($cron_setting->suppress_subscribers) && $cron_setting->suppress_subscribers == $time_value) || ( !isset($cron_setting->suppress_subscribers) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                            }
                                            @endforeach
                                        </select>
                                        <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                    </div>
                                    <button type="button" class="btn btn-success btn-run" onclick="runcron('suppress:subscribers');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                                </div>
    
    
                                <div class="form-group row" data-name="nCNn56hsxMdds">
                                    <label class="col-form-label col-md-12">{{trans('settings.cron.form.queue_work')}}
                                        {!! popover(trans('settings.cron.form.queue_work_desc'), 'common.description') !!}
                                    </label>
                                    <div class="col-md-8">
                                        <select class="form-control m-select2" name="queue_work">
                                             @foreach ($time_1 as $time_value => $time_name) {
                                            <option value="{{$time_value}}" {{((isset($cron_setting->queue_work) && $cron_setting->queue_work == $time_value) || ( !isset($cron_setting->queue_work) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                            }
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-success btn-run" onclick="runcron('queue:work --stop-when-empty --force --tries=3');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                                </div>
    
    
                                <div class="form-group row" data-name="nCNn56hsxgds">
                                    <label class="col-form-label col-md-12">{{trans('settings.cron.form.stucked_campaigns')}}
                                        {!! popover(trans('settings.cron.form.stucked_campaigns_desc'), 'common.description') !!}
                                    </label>
                                    <div class="col-md-8">
                                        <select class="form-control m-select2" name="stucked_campaigns">
                                             @foreach ($time_3 as $time_value => $time_name) {
                                            <option value="{{$time_value}}" {{((isset($cron_setting->stucked_campaigns) && $cron_setting->stucked_campaigns == $time_value) || ( !isset($cron_setting->stucked_campaigns) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                            }
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-success btn-run" onclick="runcron('resume:stucked-campaigns');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                                </div>
    
                                <div class="form-group row" data-name="nCNn56hfsxgds">
                                    <label class="col-form-label col-md-12">{{trans('Limits Reset')}}
                                        {!! popover(trans('Reset users limit'), 'common.description') !!}
                                    </label>
                                    <div class="col-md-8">
                                        <select class="form-control m-select2" name="limits_reset">
                                            <option value="0" {{(isset($cron_setting->limits_reset) && $cron_setting->limits_reset == 0) ? 'selected' : ''}}> Disabled </option>
                                            <option value="24" {{(isset($cron_setting->limits_reset) && $cron_setting->limits_reset == 24) ? 'selected' : ''}}> 24 hours </option>
                                        </select>
                                    </div>
                                    <button type="button" class="btn btn-success btn-run" onclick="runcron('limit:reset');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                                </div>
    

                                

                            <div class="form-group row" data-name="nCNn56hsxM">
                            <label class="col-form-label col-md-12">{{trans('settings.cron.form.evergreen_campaign_title')}}
                                    {!! popover(trans('settings.cron.form.evergreen_campaign_desc'), 'common.description') !!}
                                </label>
                                <div class="col-md-8">
                                    <select class="form-control m-select2" name="evergreen_campaigns">
                                        <?php if(!empty($cron_setting->evergreen_campaigns) and $cron_setting->evergreen_campaigns == 1) $cron_setting->evergreen_campaigns = 5; ?>
                                         @foreach ($time_1 as $time_value => $time_name) 
                                         
                                         @if($time_value != 1) 
                                            <option value="{{$time_value}}" {{((isset($cron_setting->evergreen_campaigns) && $cron_setting->evergreen_campaigns == $time_value) || ( !isset($cron_setting->evergreen_campaigns) && $time_value==1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                         @endif
                                        @endforeach
                                    </select>
                                    <!-- <small><span class="help-block">Schedule time for maintenance.</span></small> -->
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('schedule:evergreen');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                            </div>

                           
                      


                            

                            <!-- <div class="form-group row">
                                <label class="col-form-label col-md-12">{{trans('User DSN Counter')}}
                                    {!! popover('It will update the user lifetime counters with the delivery status notifications e.g. delivered, bounced, complaints.','') !!}
                                </label>
                                <div class="col-md-10">
                                    <select class="form-control m-select2" name="stats_increment">
                                         @foreach ($time_stats as $time_value => $time_name) {
                                        <option value="{{$time_value}}" {{((isset($stats_increment) && $stats_increment == $time_value) || ( !isset($stats_increment) && $time_value==-1) ) ? 'selected' : ''}}>{{ $time_name }}</option>
                                        }
                                        @endforeach
                                    </select>
                                    <small><span class="help-block">Schedule time for maintenance.</span></small> 
                                </div>
                                <button type="button" class="btn btn-success btn-run" onclick="runcron('segments:count');"><i class="fa fa-angle-right"></i> {{trans('common.label.run_now')}}</button> 
                             </div> --> 
                        </div>
                    </div>
                    <div class="kt-portlet__foot" data-name="BeefdcDD">
                        <div class="row" data-name="nXYQNpgi">
                            <div class="col-md-12 col-sm-12 action-buttons" data-name="veSimjmL">
                                <button type="submit" name="btn" class="btn btn-success" value="">{{trans('common.form.buttons.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- END FORM-->
@endsection