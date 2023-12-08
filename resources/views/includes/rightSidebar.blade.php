<style>
#system_notifications,
#changelogbody {
    position: relative;
    height: 100%;
}
.cahrt-loading {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  width: 100%;
}
.cahrt-loading .fa {
  font-size: 60px;
  color: #ddd;
  position: absolute;
  top: 50%;
  left: 50%;
  margin-left: -27px;
  margin-top: -27px;
}    
</style>
<?php
        $user= auth()->user();
        $app_settings =  getApplicationSettings();
        $updated_date = isset($app_settings["updated_date"]) ? $app_settings["updated_date"] : date("d-m-Y", filemtime(base_path('version')));
        $updated_version = $app_settings["updated_version"];
        if(empty($app_settings["updated_version"])) {   
           $newVersionAvailable=checkForNewVersion();
            if($newVersionAvailable['success']==1){
                $updated_version=$newVersionAvailable['updated_version'];
            }
        } 
        
        ?>
    <div id="kt_quick_panel" class="kt-quick-panel" data-name="xEbxYmHh">
    <a href="#" class="kt-quick-panel__close" id="kt_quick_panel_close_btn"><i class="flaticon2-delete"></i></a>
    <div class="kt-quick-panel__nav" kt-hidden-height="66" style="" data-name="LPLwbEhK">
        <ul class="nav nav-tabs" role="tablist">
        @if(trim($updated_version) != trim($local_version) and $user->role_id == 1)
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#update" role="tab">{{ trans('common.label.update') }}</a>
            </li>
           @endif
            
            
            @if($user->is_setup_completed==0)
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#i_setup" role="tab">{{ trans('common.label.initial_setup') }}</a>
            </li>
             @endif
            
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#notifications" role="tab">{{ trans('common.label.notifications') }}</a>
            </li>
             @php $critical_issues = getCriticalIssues(); 
             @endphp
            @if(($user->is_admin or $user->is_staff) && count($critical_issues) )
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#issues" id="tab-issue"  role="tab">{{ trans('common.label.issues') }}</a>
            </li>
            @endif
        </ul>
    </div>

    

    <div class="kt-quick-panel__content" data-name="CQqepaPl">
        <div class="tab-content" data-name="XZtUGWsU">

            <div class="tab-pane fade scroll scroll-800" id="update" role="tabpanel" data-name="kcgOuZgj">
                <div class="kt-notification-v2" data-name="dfAyLPiE">
                    <div class="updateBlk" data-name="gySBDWoo">
                        <div class="row" data-name="yBpayZdv">
                            <div class="col-md-6 versBlk" data-name="SzVVealT">
                                <span class="nBlk alert-warning">
                                    <small>{{ trans('common.label.installed_version') }}</small>
                                    {{$local_version}}
                                    <small>{{ trans('common.label.last_updated') }}<br>{{$local_version_date}}</small>
                                </span>
                            </div>
                            <div class="col-md-6 versBlk" data-name="oMMuubWi">
                                <span class="nBlk alert-success">
                                    <small>{{trans('common.label.latest_version')}}</small>
                                    {{$updated_version}}
                                    <small>{{ trans('common.label.release_date') }}<br>{{$updated_date}}</small>
                                
                                </span>
                            </div>
                        </div>
                        @if(config('app.type') !="demo")
                        <div class="updateBtn" data-name="hRXUMuIs">
                            <a href="/update">
                                <button type="button" class="btn btn-success">{{trans('common.header.update_now')}}</button>
                            </a>
                            <a href="javascript:;" id="logsAllBtn">{{ trans('common.label.view_complete_changelog') }}</a>
                        </div>
                        @endif

                        
                    </div>
                    <div class="updatingBlk" style="display: none;" data-name="BmFKrTaw">
                        <i class="la la-cog fa-spin fa-8x"></i>
                        <h4 class="upMsg">{{ trans('common.label.update_under_progress') }}</h4>
                    </div>
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;" data-name="ziHDarYG">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;" data-name="UaowfZww"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 5px;" data-name="NalGLZCu">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;" data-name="ZtnolSjr"></div>
                </div>
            </div>

            @if($user->is_setup_completed==0)
            <!-- <div class="tab-pane kt-quick-panel__content-padding-x fade scroller kt-scroll ps" id="i_setup" role="tabpanel"  data-scroll="true" data-height="800" data-mobile-height="800"></div> -->
            @endif

            <div class="tab-pane system_notifications fade scroll scroll-800" id="notifications" role="tabpanel" data-name="ihqRTzRB">
                <div class="kt-notification"  id="system_notifications" data-name="loZpPiXX">
                    <span id="loading-system_notifications" class="cahrt-loading"><i class="fa fa-spinner fa-spin"></i></span>
                    <a id="preloadli" style="display: none"></a> 
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;" data-name="OhjSBIto">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;" data-name="frlsjULF"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; right: 5px; height: 459px;" data-name="hNgLlPue">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 259px;" data-name="fuCuCeBd"></div>
                </div>
            </div>
            @if(($user->is_admin or $user->is_staff) && count($critical_issues) )
            <div class="tab-pane issues_notifications fade scroll scroll-800" id="issues" role="tabpanel" data-name="IuxhaUmL">
                <div class="kt-notification" id="issues_notifications" data-name="AdfKBuet">
                    <!-- <li id="m-read2">Mark all read</li> -->
                    @foreach($critical_issues as $issue)
                    <a href="javascript:;" class="kt-notification__item r_{{$issue->id}}" id="li_issue_0">
                        <div class="kt-notification__item-icon" data-name="MWMKYwpv">
                            <i class="flaticon2-cancel kt-font-warning"></i>
                        </div>
                        <div class="kt-notification__item-details" data-name="bSkcUphZ">
                            <div class="kt-notification__item-title" data-name="jYCqejlx">{!! $issue->issue !!}</div>
                            <div class="kt-notification__item-time" data-name="hObQJBOm">
                                <!-- Last Checked Nov 28, 2019 04:52:59 AM -->
                            </div>
                            @if($issue->js_test_method!=null)
                                        @php($methodArr = explode(",",$issue->js_test_method))
                                        @php($row_id = $methodArr[2])

                            <button id="btn_{{rtrim($row_id,')')}}" onclick="{!! $issue->js_test_method !!}" type="button" class="btn btn-default btn-xs retry-btn">@lang('common.label.retry')</button>
                            @endif
                            <button type="button" id="{{$issue->id}}" onclick="deleteIssue({{$issue->id}})" class="btn btn-success btn-xs resolve-btn">@lang('common.label.Mark_Resolved')</button>
                            <div class="kt-notification__item-alert" data-name="oFuiHzht">
                                <div id="success_notify_0" class="alert alert-solid-success alert-bold notify-success" role="alert" data-name="ztjUqQKk">
                                    <div class="alert-text" data-name="TQrXenVn"><i class="fa fa-check fa-lg"></i>@lang('common.message.issue_resolved')</div>
                                </div>
                                <div id="process_notify_0" class="alert alert-solid-dark alert-bold notify-retry" role="alert" data-name="WbdxOAaT">
                                    <div class="alert-text" data-name="wkQrzqwn"><i class="la la-spinner fa-lg fa-spin"></i> @lang('common.label.verifying')...</div>
                                </div>
                                <div id="error_notify_0" class="alert alert-solid-danger alert-bold notify-danger" role="alert" data-name="VShNAzVT">
                                    <div class="alert-text" data-name="lNDKpRsX"><i class="fa fa-times fa-lg"></i> @lang('common.message.error_occurred').</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                   
                    <a href="javascript:;" id="preloadli" class="kt-notification__item" style="display: none"></a>
                </div>
            </div>

            <script>
                 function deleteIssue(id) {
                    $.ajax({
                        type: "POST",
                        url: '{{route('deleteIssue')}}',
                        data: {'id':id},
                        cache: false,
                        dataType: 'json',
                        beforeSend: function() {
                            $(".blockUI").show();
                            // $('.r_'+id).css('background-color','#d65252').fadeIn(500);
                            $('.r_'+id+'_b').hide();
                        },
                        success: function (data) {
                            $(".blockUI").hide();
                            if (data.status==true) {
                                var totalIssues = Number($(".totalIssueCount").text());
                                $(".totalIssueCount").text(totalIssues  -1 );
                                $('.r_'+id).fadeOut(4000, function () {
                                    $(this).remove();
                                });
                            }
                            return false;
                        }
                    });
                }


            </script> 
            @endif
            
        </div>
    </div>
    </div>


<div id="logsAll" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="neMlQejs">
    <div class="modal-dialog modal-lg" data-name="JnVONYAk">
        <div class="modal-content" data-name="iXozVljo">
            <div class="modal-header" data-name="uddiezeE">
                <h4 class="modal-title">{{trans('common.message.view_change_log')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 1.25rem;" id="changelogbody" data-name="ugNEIePT">
                <span id="loading-changelogbody" class="cahrt-loading"><i class="fa fa-spinner fa-spin"></i></span>
                <div class="form-group" data-name="ljCSuWtG">
                    <div class="scroll scroll-500" data-name="yEISfcot">
                        <div class="kt-list-timeline changelogDiv" data-name="fWwCrFLA">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>