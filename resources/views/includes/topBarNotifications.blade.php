<style>
#system_notifications {
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
    $llv = str_replace("." , "" , $local_version);
    $uuv = str_replace("." , "" , $updated_version);
    if(empty($app_settings["updated_version"]) or $llv > $uuv) {   
        $newVersionAvailable=checkForNewVersion();
        if($newVersionAvailable['success']==1){
            $updated_version=$newVersionAvailable['updated_version'];
        }
    } 
        
?>

@if(class_exists('ThemeTemplate'))
<div class="kt-header__topbar-item dropdown top-all-issues new-notifications">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <span class="new-notif"></span>
                    <i class="la la-cloud-download font-25"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" >
                @php
                  $files=glob(base_path('storage/users/'.auth()->id().'/export/*.csv'));
                  usort($files, function($x, $y) {
                   return filemtime($x) < filemtime($y);
                });
                @endphp
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b">
                        <h3 class="kt-head__title">
                            Download Exported Files
                            <span class="kt-badge">{{ count($files) }}</span>
                          </h3>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 kt-scroll ps ps--active-y" data-scroll="true" data-height="250" data-mobile-height="200" style="height: 250px; overflow: hidden;">
                            @if(count($files)<=0)
                            <div class="alert alert-warning">
                            <div class="alert-text">No data found</div>
                            </div>
                            @endif
                            @foreach($files as $file)
                           
                            <a target="_blank" href="{{ url('log/exportCSVDownload') }}?file={{basename($file)}}"  class=" download_csv kt-notification__item">
                                <div class="kt-notification__item-icon">
                                    <i class="la la-cloud-download"></i>
                                </div>
                                <div class="kt-notification__item-details">
                                    <div class="kt-notification__item-title">
                                        <b>{{ str_replace('.csv','',basename($file))}}</b>
                                    </div>
                                    <div class="kt-notification__item-time">
                                        <?php echo \Carbon\Carbon::createFromTimeStamp(filectime($file))->diffForHumans(); ?>
                                    </div>
                                </div>
                            </a>
                            @endforeach
                            
                        </div>
                    </div>
                    <div class="bottom-bar">
                        @if(count($files)>0)
                        <a href="javascript:;" onclick="deleteLogExportFiles();" class="text-danger icon-close pull-left">Trash All Records</a>
                        @endif
                        <a href="javascript:;" class="btn btn-label-info icon-close pull-right">Close</a>
                    </div>
                </form>
            </div>
        </div>
        @endif 
@php
$import=isImport();
$suppressionImport=false;
$dbUpgradeRunning=dbUpgradeRunning();
$lists=isDeleteList();
$total_lists=count($lists);
$domainKey = checkDomainNameAdded();
$getRunningTasks = getRunningTasks();
$total_tasks = count(json_decode(json_encode($getRunningTasks) , true));
$is_any_import_running= $import || $suppressionImport || $total_tasks > 0 || $dbUpgradeRunning || $total_lists > 0 || $domainKey == "yes";
$total_running_tasks = 0; 
@endphp
@if($is_any_import_running)
<!--begin: Notifications -->


<div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="bbIAeuyr">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="aGaMGPDE"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <span class="new-notif"></span>
                    <i class="flaticon2-gear fa-spin text-success font-21"></i>
                </span> 
            </div>
            @if($is_any_import_running)
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg cr-process" data-name="mYDEPwol">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="lOOnMhMx">
                        <h3 class="kt-head__title">
                        {{trans('dashboard.topbar.Currently_Running_Processes')}}
                            <span class="kt-badge">{{$total_tasks}}</span>
                        </h3>
                    </div>


        <div class="tab-content" data-name="unffVqCj">
            <div class="tab-pane active show" id="list-tab" role="tabpanel" data-name="YbFvpKnj">
                <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250" data-name="OOXqylny">
                                                                    
                    @if($import)
                    <div class="kt-notification__item" data-name="uKhzNzbT">
                        <div class="kt-notification__item-icon" data-name="pvboGAGx">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        <div class="kt-notification__item-details" data-name="nsZHHNZu">
                            <div class="kt-notification__item-title" data-name="eeBwgJeK">
                                {{trans('dashboard.topbar.import_subscribers')}}
                            </div>
                            <div class="kt-notification__item-time" data-name="YZPyVCtb">
                                <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($import->created_at))->diffForHumans(); ?> <a href='javascript:void(0)' onclick='cancelImport({{$import->id}},1,1)' class='cancel_link btn btn-label-warning btn-xs' title="{{trans('common.form.buttons.cancel')}}"><i class="la la-times"></i></a>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($suppressionImport)
                    <a href="javascript:;"  class="kt-notification__item">
                        <div class="kt-notification__item-icon" data-name="zfZGlieQ">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        <div class="kt-notification__item-details" data-name="WFqpzJSu">
                            <div class="kt-notification__item-title" data-name="yCfAzluB">
                            {{trans('dashboard.topbar.suppression_import')}}
                            </div>
                            <div class="kt-notification__item-time" data-name="LnaVtqyb">
                            <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($suppressionImport->created_at))->diffForHumans(); ?> <a href='javascript:void(0)' onclick='cancelImport({{$suppressionImport->id}},1,1)' class='cancel_link btn btn-label-warning btn-xs' title="{{trans('common.form.buttons.cancel')}}"><i class="la la-times"></i></a>
                            </div>
                        </div>
                    </a>
                    @endif
                    @if($total_tasks > 0)
                    @php 

                        $tasks_array = array("suppression","campaign_run","campaign_preparation","exportlist","update_contacts","downloadCsvInBackground");
                    @endphp
                    @foreach($getRunningTasks as $task)
                        @if(in_array($task->task , $tasks_array))
                        <a href="javascript:;"  class="kt-notification__item">
                            <div class="kt-notification__item-icon" data-name="ZkYzdufl">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                            <div class="kt-notification__item-details" data-name="HvqMyLXc">
                                <div class="kt-notification__item-title" data-name="oJVGhUOJ">
                                    @if($task->task == "suppression") {{trans('running_process.task.suppressed_sync')}} @endif
                                    @if($task->task == "campaign_run") {{trans('running_process.task.running_campaign')}} @endif
                                    @if($task->task == "campaign_preparation") {{trans('running_process.task.preparing_campaign')}} @endif
                                    @if($task->task == "exportlist") {{trans('running_process.task.list_exporting')}} @endif
                                    @if($task->task == "update_contacts") {{trans('running_process.task.updating_contacts')}} @endif
                                    @if($task->task == "downloadCsvInBackground") {{trans('Exporting Logs')}} @endif
                                    <?php
                                    if(!empty($task->data)) { 
                                        $t_data = json_decode($task->data , true); 
                                        echo !empty($t_data["campaign_name"]) ? "<b>" . $t_data["campaign_name"] . "</b> <br>" . $task->total_thread . " Thread "  : "";
                                        $total_running_tasks  +=  $task->total_thread;
                                    }
                                 ?>
                                </div>
                                
                                <div class="kt-notification__item-time" data-name="WdVsNeFl">
                                <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($task->updated_at))->diffForHumans(); ?> 
                                </div>
                            </div>
                        </a>
                        @endif
                    @endforeach
                    @endif
                    @if($dbUpgradeRunning)
                    <div href="javascript:;"  class="kt-notification__item" data-name="tfLABLEj">
                        <div class="kt-notification__item-icon" data-name="HWwOUkPk">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        <div class="kt-notification__item-details" data-name="aTuLNUbm">
                            <div class="kt-notification__item-title" data-name="oRxIkBgD">
                            {{trans('dashboard.topbar.database_update_progress')}}
                            </div>
                            <div class="kt-notification__item-time" data-name="tVHxCkcP">
                                <div class="kt-notification__item-time" data-name="rvwhiZaw">
                                   <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($dbUpgradeRunning->updated_at))->diffForHumans(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                  

                    @if($domainKey)
                    <div href="javascript:;"  class="kt-notification__item" data-name="asDhJgSp">
                        <div class="kt-notification__item-icon" data-name="btHUIbsH">
                            <i class="fa fa-spinner fa-spin"></i>
                        </div>
                        <div class="kt-notification__item-details" data-name="AwaoqgxE">
                            <div class="kt-notification__item-title" data-name="RarLyamq">
                                {{trans('dashboard.topbar.optimizing_tables')}}
                            </div>
                            <div class="kt-notification__item-time" data-name="usUTuSoY">
                                <div class="kt-notification__item-time" data-name="WtGXSrFY">
                                        
                                        <?php if((time() - $file_time = filemtime("storage/optimize.json"))/60 >= 30) {  ?>
                                        <a onclick='restartOptimizaing()' href='javascript:void(0)' title="{{trans('dashboard.topbar.restart_optimizing')}}" class='cancel_link btn btn-label-info btn-xs'><i class="la la-refresh"></i></a>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    @endif

                    @if($total_lists > 0)
                        @foreach($lists as $list)
                        <div href="javascript:;"  class="kt-notification__item" data-name="SWrKrydG">
                            <div class="kt-notification__item-icon" data-name="WnJXnLYv">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                            <div class="kt-notification__item-details" data-name="ekwWyqcP">
                                <div class="kt-notification__item-title" data-name="MvPMhJKO">
                                <?php echo trans('dashboard.topbar.deleting_list').": ".$list->name; ?>
                                </div>
                                <div class="kt-notification__item-time" data-name="zasZIsZk">
                                <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($list->updated_at))->diffForHumans(); 
                                    $startTime = \Carbon\Carbon::parse($list->updated_at);
                                    $finishTime = \Carbon\Carbon::now();
                                    $totalDuration = $finishTime->diffInMinutes($startTime);
                                    // Force Restart List for deletion after 1 hour
                                    if($totalDuration >=59){ // 1 Hour
                                    ?>
                                <a onclick='restartDeletingList({{$list->id}})' href='javascript:void(0)' title="{{trans('dashboard.topbar.force_delete')}}" class='cancel_link btn btn-label-danger btn-xs'><i class="la la-trash"></i></a>
                            <?php } ?>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="bottom-bar" data-name="jwbXAKBC">
            <a href="{{ route('running-process') }}" class="pull-left">{{ trans('running_process.view_all_process') }}</a>
            <a href="javascript:;" class="btn btn-label-info icon-close pull-right">@lang('common.form.buttons.close')</a>
        </div>
        <form>
    </div>
    @else 
    <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" data-name="xuBmsdLP">
    <form>
        <!--begin: Head -->
        <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="afqXkkHG">
            <h3 class="kt-head__title">
            {{trans('dashboard.topbar.Currently_Running_Processes')}}
                <span class="kt-badge">0</span>
            </h3>
        </div>
        <div class="tab-content" data-name="smSRxSLH">
            <div class="tab-pane active show" id="list-tab" role="tabpanel" data-name="fenezgcI">
                <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250"  data-name="naHMjVRx">
                    <div class="kt-notification__item no-processing" data-name="ohcsFJfu">
                         {{trans('dashboard.topbar.no_process_running')}}
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-bar" data-name="txQcJNvX">
            <a href="{{ route('running-process') }}" class="pull-left">{{ trans('running_process.view_all_process') }}</a>
            <a href="javascript:;" class="btn btn-label-info icon-close pull-right">@lang('common.form.buttons.close')</a>
        </div>
        <form>
    </div>
    @endif

</div>
@endif

<input type="hidden" id="total_running_tasks" value="{{$total_running_tasks}}">





        @if(trim($updated_version) != trim($local_version) and $user->role_id == 1)
        <!--end: Notifications -->
        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="gGGVXNeX">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="SPsIIXJI"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <i class="fa fa-download text-warning"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-246px, 64px, 0px);" data-name="AixjjuGi">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="wpRHDthv">
                        <h3 class="kt-head__title">
                            {{trans('sending_nodes.include_topbar_notifications_blade.update_mumara_heading')}}
                        </h3> 
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="muWaSfBE">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250" style="height: 265px; overflow: hidden;" data-name="MEDlEjLI">
                            <div class="updateBlk" data-name="HSWDosdq">
                                <div class="row" data-name="jqZuCXQd">
                                    <div class="col-md-6 versBlk" data-name="quIahPDg">
                                        <span class="nBlk alert-warning">
                                            <small>{{ trans('common.label.installed_version') }}</small>
                                            {{$local_version}}
                                            <small>{{ trans('common.label.last_updated') }}<br>{{$local_version_date}}</small>
                                        </span>
                                    </div>
                                    <div class="col-md-6 versBlk" data-name="fhcZoBAK">
                                        <span class="nBlk alert-success">
                                            <small>{{trans('common.label.latest_version')}}</small>
                                            {{$updated_version}}
                                            <small>{{ trans('common.label.release_date') }}<br>{{$updated_date}}</small>
                                        
                                        </span>
                                    </div>
                                </div>
                                @if(config('app.type') !="demo")
                                <div class="updateBtn" data-name="BrCJMwZa">
                                    <a href="/update">
                                        <button type="button" class="btn btn-success">{{trans('common.header.update_now')}}</button>
                                    </a>
                                    <a href="javascript:;" id="logsAllBtn">{{ trans('common.label.view_complete_changelog') }}</a>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif
            
  


           
        @if(Auth::user()->is_setup_completed==0)
        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="ftRHYWTe">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="wTMqfeSm"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <i class="flaticon2-list-3"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg intial-setup" x-placement="bottom-end" data-name="ujgbgcYv">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="DqyQxayQ">
                        <h3 class="kt-head__title">
                            {{trans('sending_nodes.include_topbar_notifications_blade.inital_setup_guide_heading')}} 
                        </h3> 
                        <div class="is-pb">
                            <div class="is-val">0%</div>
                            <div class="progress">
                                <div class="progress-bar" id="initial-setup" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content tab-is" data-name="hzBEJAEL">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-300" style="height: 300px; overflow: hidden;" data-name="VecpRPuX">
                            <div class="col-md-12 sidebar-setup-guide mt15 hide" data-name="XdsQgLsk">
                                <h4>{{trans('sending_nodes.include_topbar_notifications_blade.complete_qualiy_broadcast_heading')}} </h4> 
                            </div>
                            <div class="col-md-12 setep_options" id="i_setup" data-name="fivKaQxU"><i class="fa fa-spinner fa-spin fa-lg"></i></div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        @endif


        
        <script> 
            @if(class_exists('ThemeTemplate'))
            function deleteLogExportFiles(){
                if(confirm("{{trans('sending_nodes.include_topbar_notifications_blade.sure_delete_all_files')}}")){
                $.ajax({
                        url: "{{ route('deleteLogExportFiles') }}",
                        type: "POST",
                        data: {},
                        cache: false,
                        dataType: 'json',                        
                        success : function(data) {
                            if(data.success ==1  ){                                
                                Command: toastr["success"]("{{trans('sending_nodes.include_topbar_notifications_blade.operation_successfull_command')}}");
                                setTimeout(function(){
                                    location.reload();
                                },1000);
                            }
                        }
                    });
            }
            }

            @endif
                $("body").on("click", "#notifcationRead", function() {                    
                    $.ajax({
                        url: "{{ route('mark.all.notifications.read') }}",
                        type: "POST",
                        data: {},
                        cache: false,
                        dataType: 'json',                        
                        success : function(result) {
                            if(result.status == 'success' ){                                
                                $('#unreadNotification').hide();  
                                $('.unread').removeClass("unread");  
                                $("#notifCount").html(0).hide(); 
                                $("#notifcationRead").hide();
                                $(".newnotiFy").removeClass("new-notif");
                            }
                        }
                    });
                });


                $("body").on("click", ".unread", function() {
                    /*var li_id = $(this).attr('id');
                    $.ajax({
                        url: "{{ route('read.notification') }}",
                        type: "POST",
                        data: {'id':li_id},
                        cache: false,
                        dataType: 'json',                        
                        success : function(result) {
                            if(result.status = 'success' ){                                
                                $("#unreadNotification").show();
                                $("#unreadNotification").html(result.is_read);
                                $("#"+li_id).removeClass("unread");   
                                if(result.is_read==0){
                                    $("#unreadNotification").hide();
                                    $("#m-read").hide();
                                }
                            }
                        }
                    });
                    */
                });


                $("body").on('click',"#logsAllBtn",function() {
                     $.ajax({
                        url: '{{ route("fetchVersion") }}',
                        beforeSend: function() {
                            $(".changelogDiv").html('');
                            // $("#changelogbody").LoadingOverlay("show", {
                            //     background  : "rgba(255, 255, 255, 1)",
                            //     size        : 50,    // Float/String/Boolean
                            //     minSize     : 20,    // Integer/String
                            //     maxSize     : 50   // Integer/String
                            // });
                            $("#loading-changelogbody").show();
                            $("#logsAll").modal("show");
                        },
                        success: function (data) {
                            if(data.success){
                                $(".changelogDiv").html(data.html);
                                // $("#changelogbody").LoadingOverlay("hide", true);
                                $("#loading-changelogbody").hide();
                                
                                // $("#notifies").slideToggle("slow");
                            }
                           
                        }
                    });
                }); 
                
                
                var  start  = 0;
                $('#system_notifications').on('scroll', function() {
                    if($(".data-processing").text() == "End of notifications") return false;
                    if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight-3) {
                        if(start==0){
                            setTimeout(
                            function() 
                            {
                                var skip = $("#skip").val();
                                $("#skip").val(Number(skip) + 5);
                                var records = $("#records").val();
                                var flag= 0;
                                $(".data-processing").hide();   
                                $.ajax({
                                    url: "{{ route('get.all.notifications') }}",
                                    type: "POST",
                                    data: {'skip':skip,'records':records,'flag':flag},
                                    cache: false,
                                    dataType: 'json',
                                    beforeSend: function() {
                                        start  = 1;
                                    },
                                    success : function(result) {
                                        if(result){
                                            more = result.more_record;
                                            $(".pdb1").remove();
                                            $("#system_notifications").append(result.notifications_data);
                                            $(".popovers").popover();
                                            start = 0;
                                            if(more == 1) { 
                                                $(".data-processing").show();   
                                            } else {
                                                $(".data-processing").show();  
                                                $(".data-processing").html("{{trans('common.label.end_of_notification')}}");  
                                            } 
                                        } else {
                                            scroll=0;
                                        }
                                    }
                                });
                            }, 1000);
                        }
                    }
                });



        </script>
        <input type="hidden" id="skip" value="5">
        <input type="hidden" id="records" value="5">


        <div class="kt-header__topbar-item dropdown top-all-notifications new-notifications" data-name="UUlUliCJ">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="lbxgPheA"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand" id="myIconDB">
                    <span class="newnotiFy" id="dotIcon"></span>
                    <i class="flaticon2-bell-1"></i> 
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg head-notification" data-name="pPWqXDfS">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="CIsHkogW">
                        <h3 class="kt-head__title">
                            <!-- <i class="flaticon2-bell-1"></i> -->
                            {{trans('sending_nodes.include_topbar_notifications_blade.notifications_heading')}} 
                            <span class="kt-badge" id="unreadNotification">0</span> 
                        </h3> 
                        <a href="javascript:void(0)" id="notifcationRead" class="tnmar">{{trans('users.user_notifications.mark_all_read')}}</a>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="FMmtcxpT">
                        <div id="system_notifications" class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250" data-name="OuEfgwxp">
                            <!-- <span id="loading-system_notifications" class="cahrt-loading"><i class="fa fa-spinner fa-spin"></i></span> -->
                             <i class="fa fa-spin fa-spinner fa-lg notif-loader"></i>
                            <input type="hidden" id="scrolerData"/>
                        </div>
                        
                    </div>
                    <div class="bottom-bar" data-name="KMZZUBEr">
                        <!-- <a href="javascript:;" class="pull-left">View All</a> -->
                        <a href="javascript:;" class="btn btn-label-info icon-close pull-right dd-close">                                            {{trans('common.form.buttons.close')}}</a>
                    </div>
                </form>
            </div>
        </div>

        @php $critical_issues = getCriticalIssues(); @endphp
            @if(($user->is_admin or $user->is_staff) && count($critical_issues) )
        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="eChPQQqg">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="bazWfgAx"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand issue-icon">
                    @if(count($critical_issues) > 0) <span class="new-notif"></span> @endif
                    <i class="fa fa-exclamation-triangle"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg issue-notifications" data-name="JsOeptdl">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="QusbRDNI">
                        <h3 class="kt-head__title">
                            Issues
                            <span class="kt-badge totalIssueCount">{{count($critical_issues)}}</span>
                        </h3> 
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="MWXhGaKS">
                        <div id="issuesBlk" class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-300" style="height: 300px; overflow: hidden;" data-name="JiWaoqLr">
                            @foreach($critical_issues as $issue)
                                <a href="javascript:;" class="kt-notification__item r_{{$issue->id}}" id="li_issue_0">
                                    <div class="kt-notification__item-icon" data-name="SjvjRZOE">
                                        <i class="flaticon2-cancel kt-font-warning"></i>
                                    </div>
                                    <div class="kt-notification__item-details" data-name="MYwdMhAu">
                                        <div class="kt-notification__item-title" data-name="ucyaTbvB">{!! $issue->issue !!}</div>
                                        <div class="kt-notification__item-time" data-name="cfnyVphq">
                                            {{trans('sending_nodes.include_topbar_notifications_blade.last_checked_div')}} 
                                        </div>
                                        @if($issue->js_test_method!=null)
                                                    @php($methodArr = explode(",",$issue->js_test_method))
                                                    @php($row_id = $methodArr[2])

                                        <button id="btn_{{rtrim($row_id,')')}}" onclick="{!! $issue->js_test_method !!}" type="button" class="btn btn-default btn-xs retry-btn">@lang('common.label.retry')</button>
                                        @endif
                                        <button type="button" id="{{$issue->id}}" onclick="deleteIssue({{$issue->id}})" class="btn btn-success btn-xs resolve-btn">@lang('common.label.Mark_Resolved')</button>
                                        <div class="kt-notification__item-alert" data-name="OaxMOFyD">
                                            <div id="success_notify_0" class="alert alert-solid-success alert-bold notify-success" role="alert" data-name="DByZOuxB">
                                                <div class="alert-text" data-name="hkFmTIAO"><i class="fa fa-check fa-lg"></i>@lang('common.message.issue_resolved')</div>
                                            </div>
                                            <div id="process_notify_0" class="alert alert-solid-dark alert-bold notify-retry" role="alert" data-name="UZvCsXPy">
                                                <div class="alert-text" data-name="PQTZaxoO"><i class="la la-spinner fa-lg fa-spin"></i> @lang('common.label.verifying')...</div>
                                            </div>
                                            <div id="error_notify_0" class="alert alert-solid-danger alert-bold notify-danger" role="alert" data-name="zFWLrwJh">
                                                <div class="alert-text" data-name="LcZttwiF"><i class="fa fa-times fa-lg"></i> @lang('common.message.error_occurred').</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="bottom-bar" data-name="JYUIavlU">
                         <a href="{{url('issues')}}" class="pull-left">{{trans('sending_nodes.include_topbar_notifications_blade.view_all_action')}} </a>
                        <a href="javascript:;" class="btn btn-label-info icon-close pull-right dd-close">{{trans('common.form.buttons.close')}}</a>
                    </div>
                </form>
            </div>
        </div>
        @endif