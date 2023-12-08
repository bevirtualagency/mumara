@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/triggers-view.css?v={{$local_version}}.02">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery-ui.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Actions/Triggers");
        
        $(".checkboxBlk2").hide();
        setTimeout(function(){
            $(".checkboxBlk2").css("display", "inline-block");
        }, 500);
    });

    $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    } );
    $('#sortable').sortable({
        items: "li:not(.not_draggable)"
    });
    function saveOrder() {
        var sortedIDs = $('#sortable').sortable("toArray");
        $('.blockUI').show();

        $.ajax({
            type: "POST",
            url: "{{route('triggerSaveOrder')}}",
            data: {"ids":sortedIDs},
            cache: false,
            dataType: 'json',
            success: function (data) {
                $('.blockUI').hide();
                if(data.status == "success"){
                    Command: toastr["success"] ('{{trans('triggers.message.save_order')}}');
                }
                else{
                    Command: toastr["error"] ('{{trans('common.message.opps')}}');
                }
            }
        });
    }
    $('#sortable').sortable({
        connectWith: '.dropme',
        cursor: 'pointer',
        stop: function(event, ui) {
            saveOrder()
        }
    });

    function changeStatus(id) {
        $('.blockUI').show();
        $.ajax({
            type   : "GET",
            url    : "{{ url('/') }}"+'/trigger/status/'+id,
            success: function(result) {
                $('.blockUI').hide();
                if(result == "success"){
                    Command: toastr["success"] ('{{trans('triggers.message.alert_success')}}');
                } else if(result == "list_blocked"){
                    Command: toastr["warning"] ('{{trans('triggers.sorting_blade.triggers_blocked_contact_list_command')}}');
                }else{
                    Command: toastr["error"] ('{{trans('triggers.message.alert_failed')}}');
                }
            }
        });
    }

    function deleteTrigger(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/trigger/'+id,
                type: "DELETE",
                success: function(result) {
                    if(result == 'delete') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
                    }
                }
            });
        }
    }

    function deleteAll() {
        if(!$('input:checkbox[name=ids]:checked').length){
            alert('{{trans('common.message.alert_no_record')}}');
            return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var ids = $('input:checkbox[name=ids]:checked').map(function() {
                return this.value;
            }).get();

            $.ajax({
                type    : "Delete",
                url: "{{ url('/') }}"+'/trigger/'+ids,
                data    : {ids: ids},
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{ route('trigger.index') }}";
                    }
                }
            });

        }
    }
</script>
@endsection

@section(decide_content())

    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="dPgORGRh">
            {{ Session::get('msg') }}
        </div>
    @endif
    @if (Session::has('error-msg'))
    <div class="alert alert-danger" data-name="aVAnDlnO">
        {!! Session::get('error-msg') !!}
    </div>
    @endif


    <?php 
        $trigger_actions_this_month = DB::table("user_email_limits")->where("user_id" , Auth::user()->id)->value("trigger_actions_this_month");
        $trigger_actions_limit = DB::table("packages")->where("id" , Auth::user()->package_id)->value("trigger_actions");
    ?>
    @if($trigger_actions_limit > 0 and  $trigger_actions_this_month < $trigger_actions_limit) 
    
    <div class="alert alert-info" data-name="aVAnDlnO">
        {{trans('triggers.trigger_actions_usage' , ['precentage' => number_format((($trigger_actions_this_month * 100)/$trigger_actions_limit)) , 'usedLimit' => $trigger_actions_this_month, 'totalLimit' => $trigger_actions_limit])}}
    </div>

    @elseif($trigger_actions_limit == 0 && Auth::user()->is_client)
    <div class="alert alert-danger" data-name="aVAnDlnO">
        {{trans('triggers.trigger_actions_limit')}}
    </div>
    @elseif(($trigger_actions_this_month >= $trigger_actions_limit) && ($trigger_actions_limit != -1 && $trigger_actions_limit != NULL ) && Auth::user()->is_client)
    <div class="alert alert-danger" data-name="aVAnDlnO">
        {{trans('triggers.trigger_actions_limit')}}
    </div>
    @endif
   

    <div id="msg" class="display-hide" data-name="DxqSnCnO">
        <button class="close" data-close="alert"></button>
        <span id='msg-text' class="alert-text"><span>
    </div>


    <div class="row" data-name="ZyiKkmRC">
        <div class="col-md-12" data-name="KxaVEuYY">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="kt-portlet kt-portlet--height-fluid" data-name="rdnZNvgR">
                <div class="kt-portlet__body" data-name="SlpjrTOX">
                    <div class="table-toolbar" data-name="hcmKlbSI">
                        <div class="form-group row" data-name="YciKZqLw">
                            <div class="col-md-12 p025" data-name="TeHYvjgy">
                               
                                
                                    <div class="btn-group" data-name="TsseVhqC">
                                        @if(routeAccess('trigger.create'))
                                            <a href="{{ route('trigger.create') }}">
                                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                                    <i class="fa fa-plus"></i> {{trans('common.form.buttons.add_new')}}
                                                </button>
                                            </a>
                                        @endif
                                        @if($triggers_limit > 0)
                                        <button class="btn btn-label-warning btn-sm" id="contacts_limit">Triggers Limit: {{$triggers_count}} / {{$triggers_limit}}</button> 
                                        @endif   
                                    </div>
                             

                                @if(routeAccess('trigger.destroy'))
                                <div class="btn-group pull-right mb1" data-name="xhjFiXcW">
                                    <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                        {{ trans('common.actions') }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                        </li>
                                    </ul>
                                </div>
                                @endif  
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <form class="" id="saveOrder" novalidate="novalidate">
                            <div class="user-table-warning"><b>{{trans('triggers.sorting_blade.bold_note')}}:</b> {{trans('triggers.sorting_blade.triggers_set_run_ever')}}  <code>{{ \App\UserCronSetting::getCronTime("trigger_cron")}}</code> {{trans('triggers.sorting_blade.minutes_txt')}}  @if(!isClient()) {{trans('triggers.sorting_blade.change_this_cron_setting')}} @endif</div>
                            
                            <ul class="" id="sortable">
                                <li class="ui-state-default not_draggable">
                                    <span class="la la-bars"></span>
                                    <span class="ui_check"><label class="kt-checkbox kt-checkbox--single kt-checkbox--all"><input type="checkbox" class="checkboxes checkbox-all-index"><span></span></label></span>
                                    <span class="ui_label uibold">{{trans('triggers.table_headings.name')}}</span>
                                    <span class="ui_reason uibold">{{trans('triggers.table_headings.status')}}</span>
                                    <span class="ui_detail uibold">{{trans('triggers.table_headings.added_on')}}</span>
                                    <span class="ui_detail uibold">{{trans('triggers.table_headings.trigger_action')}}</span>
                                    <span class="ui_action uibold">{{trans('triggers.table_headings.actions')}}</span>
                                </li>
                                @php
                                $canDel  = routeAccess('trigger.destroy');
                                $canEdit = routeAccess('trigger.edit');
                                @endphp
                                @if(count($triggersData) > 0)
                                    @foreach($triggersData as $trigger)

                                    <?php $number_of_actions = DB::table("trigger_actions")->where("trigger_id" , $trigger->id)->value("action_count"); ?>
                                    
                                        <li class="ui-state-default ui-sortable-handle" id="<?php echo $trigger['id'];?>">
                                            <span class="la la-bars"></span>
                                            <span class="ui_check"><label class="kt-checkbox kt-checkbox--single kt-checkbox--all"><input type="checkbox" class="checkbox-index" name="ids" value="<?php echo $trigger['id'];?>"><span></span></label></span>
                                            <?php
                                            $bhtml = ""; 
                                                if($trigger["status"] == 2 and $trigger["disable_reason"] == "list_blocked") { 
                                                    $bhtml = '<a href="javascript:;" class="text-warning" data-toggle="modal" data-target="#pauseModel" style="display: inline-block;margin-left: 5px;"><i class="fa fa-exclamation-triangle"></i></a>';
                                                }
                                                if($trigger["status"] == 2 and $trigger["disable_reason"] == "limit_reached") { 
                                                    $bhtml = '<a href="javascript:;" class="text-warning" data-toggle="modal" data-target="#limitReachedModel" style="display: inline-block;margin-left: 5px;"><i class="fa fa-exclamation-triangle"></i></a>';
                                                }
                                            ?>
                                            <span class="ui_label"><?php echo $bhtml; ?> <?php echo $trigger['name']; ?> </span>
                                            <span class="ui_reason">
                                                @if($canEdit)
                                                <div class="checkboxBlk2" data-name="olqMZKso">
                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                        <label>
                                                            <input {{ $trigger['status']==1 ? "checked":''}} {{!$canEdit?'disabled':''}} type="checkbox" name="status" class="trigger_status" @if($canEdit) onchange="changeStatus(<?php echo $trigger['id']?>)" @endif NO NUMERIC NOISE KEY 1011>
                                                            <span></span>
                                                        </label>
                                                    </span>
                                                </div>
                                                    @endif
                                            </span>
                                            <span class="ui_detail"><?php echo showDateTime(Auth::user()->id, $trigger['created_at']) ?></span>
                                            <span class="ui_detail">{{$number_of_actions}}</span>
                                            <span class="ui_action">

                                            @if($canDel)
                                            <a href="javascript:;" onclick="deleteTrigger(<?php echo $trigger['id'];?>)" class="pull-right @if(!$canDel) disabled @endif" title="{{ trans('common.form.buttons.delete')}}"><i class="fa fa-trash text-danger"></i></a>
                                            @endif
                                            @if($canEdit)
                                            <a href="<?php echo route('trigger.edit', $trigger['id']);?>" class="pull-right @if(!$canEdit) disabled @endif" title="{{ trans('common.form.buttons.edit')}}"><i class="fa fa-edit text-success"></i></a>
                                            @endif

                                </span>
                                        </li>
                                    @endforeach
                                @else
                                    <li class="ui-state-default not_draggable">
                                        <span class="la la-bars"></span>
                                        <span class="empty">{{ trans('common.message.no_record_found') }}</span>
                                    </li>
                                @endif
                            </ul>
                        </form>
                    </div>
                    <div class="paginationBlk" data-name="KQiUDNOM">
                        <?php echo $triggersData->links();?>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>



    <!-- SMTP Failed Modal -->
<div id="pauseModel" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="iHcTTUSG">
    <div class="modal-dialog" style="width: 500px;" data-name="TRroNmBX">
        <div class="modal-content" data-name="lTaClAmS">
            <div class="modal-header" data-name="IINDblxw">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{ trans('triggers.triggerPauseTitle') }}</h4>
            </div>
            <div class="modal-body" data-name="qoKCJXyD">
                <div id="smtp-error-data" data-name="FZRCvLGs">
                {{ trans('triggers.triggerPauseDescription') }}
                <br>
                <br>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- SMTP Failed Modal -->
<div id="limitReachedModel" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="iHcTTUSG">
    <div class="modal-dialog" style="width: 500px;" data-name="TRroNmBX">
        <div class="modal-content" data-name="lTaClAmS">
            <div class="modal-header" data-name="IINDblxw">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{ trans('triggers.monthlyActionLimit') }}</h4>
            </div>
            <div class="modal-body" data-name="qoKCJXyD">
                <div id="smtp-error-data" data-name="FZRCvLGs">
                    {{ trans('triggers.monthlyActionLimit') }}
                <br>
                <br>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SMTP Failed Modal -->


@endsection