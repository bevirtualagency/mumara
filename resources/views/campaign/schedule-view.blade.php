@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/schedule-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
<style>
 
    .hideLoader{
        display: none;
    }
#custom-fields tr td:last-child>div {margin-right: 5px !important}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script  src="/themes/default/js/fnReloadAjax.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.plugin.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.countdown.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>

<script>
    var stopExecution = 0;
    
    
    function editSpeed(speed,broadcast_id) {
        $('#broadcast_id').val(broadcast_id);
        $('#hourly_speed').val(speed);
        $('#editSpeed').modal('show');
    }
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
        
 
        
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Campaigns/Scheduled-Broadcasts");
        
        $('.m-select2').select2({
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
 // function in master2 layout
        var page_limit=show_per_page('','schedule-view-pageLength',10);  // Params (table,page,default_limit=10)
        var startDB = 0;
        var autoDB = 0;
        var campaignsTable;
        var rows=[];
        var requests=[];
        var oldRandom='';
        campaignsTable = $('#custom-fields').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,6,7,8]}],
            "bProcessing": false,
            "bServerSide": true,
            "aaSorting": [[3, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getScheduledBroadcasts') }}",
            "pageLength" : page_limit,
            "stateSave" : true,
            "bStateSave": true,
            "fnStateSave": function (oSettings, oData) {
                localStorage.setItem('offersDataTables', JSON.stringify(oData));
            },
            "fnStateLoad": function (oSettings) {
                return JSON.parse(localStorage.getItem('offersDataTables'));
            },
           createdRow: function( row, data, dataIndex ) {
                    if(parseInt(data.DT_impr)==1){
                     var params=$('#custom-fields').DataTable().ajax.params();
                     rows.push({rowIndex:dataIndex,params:params,segment_id:data.DT_RowId.replace('row_','')});
                    }
                },
                  "drawCallback": function( settings, json ) {

                    if(rows.length > 0 && requests.length<=0){
                        $(document).find('.is-countdown').countdown('toggle');
                       var segment_ids=[];
                       $.each(rows,function(i,val){
                        segment_ids.push(val.segment_id);
                       });
                       var data=rows[0].params;
                           data.segment_ids=segment_ids;
                        request=$.ajax({
                            url: "{{ url('getScheduledBroadcasts') }}",
                            type: "GET",
                            data:data,
                            success: function(result) {
                                var data=JSON.parse(result);
                                var retry=0;
                               $.each(data.aaData,function(i,val){
                                for (var key in val) {
                                    if (val.hasOwnProperty(key) && key !="DT_RowId" && key !="DT_impr") {
                                         $('#'+val.DT_RowId).find('td').eq(key).html(val[key]);
                                    }
                                } 
                                    if(parseInt(val.DT_impr)==1 ){
                                        retry++;
                                    }

                                }); 
                               if(retry >0 ){
                                var $this=this;
                                var random = (Math.random() + 1).toString(36).substring(2);
                                if(oldRandom)
                                 $this.url=($this.url).replace(oldRandom,random);
                                else
                                 $this.url=($this.url)+"&random="+random; 
                                 oldRandom=random;
                                setTimeout(function(){
                                    $(document).find('.is-countdown').countdown('toggle');
                                  $.ajax($this);
                                },3000);
                               }
                            }
                        });
                        requests.push(request);
                    }
                  rows=[];
                },
            "fnServerParams": function (aoData) {
                aoData.push({"name": "campaign_type", "value": $('input[name=campaign_type]:checked').val()},{"name": "statusFilter", "value": $("#statusFilter").val()});
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
                stopExecution = 0;
            },
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        
        objTable = campaignsTable;
       
        $(".form-control-sm").keydown(function(e){
            if(e.which === 13){ //if (key == 8 || key == 46) {
                requests=[];
                objTable.ajax.reload( null, false );
            }
            
        });
        
        
        $('.dataTables_filter input').on('click', function(e) {
            if($('.dataTables_filter input').val()!=""){
                requests=[];
                objTable.ajax.reload( null, false );
            }
        });
        
        
     
        //form-control-sm
      
        ///getPrepairing();
         page_limit=show_per_page(campaignsTable,'schedule-view-pageLength'); 
        $("#campaign_type, #statusFilter").change(function () {
            //campaignsTable.draw();
            requests=[];
            objTable.ajax.reload( null, false );
        });
        
    });
    
    // submit hourly speed form
   
    $('#saveSpeed').on('click',function () {

        $.ajax({
            type    : "POST",
            url     : "{{ route('saveBroadcastSpeed') }}",
            data    : $('#editSpeedForm').serialize(),
            dataType: 'json',
            success: function(result) {
                if(result.status)
                {
                    Command: toastr["success"] ("{{trans('response.broadcast.speed_updated')}}");
                    $('#editSpeed').modal('hide');
                    requests=[];
                    objTable.draw();
                }
                else
                    Command: toastr["error"] ("{{trans('response.opps.error')}}");

            }
        });
    });

    function systemPaused(id) {
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/broadcasts/system-paused',
            data    : {id: id},
            success: function(result) {                
                $('#smtp-error-data').html(result);
                $("#modal-smtp-failed").modal('show');
            }
        });
    }
    function systemStoppedByPolicy(id) {
        $("#systemStoppedByPolicy").modal('show');
        // $.ajax({
        //     type    : "GET",
        //     url     : "{{ url('/') }}"+'/broadcasts/system-paused',
        //     data    : {id: id},
        //     success: function(result) {                
        //         $('#smtp-error-data').html(result);
        //         $("#systemStoppedByPolicy").modal('show');
        //     }
        // });
    }
    // delete schedule campaign
    function deleteScheduleCampaign(id) {
        //id_to_delete = id;
        $("#delSchedileID").val(id);
        $("#isDeleteSingle").val(1);
        $('#soft_hard_delete_confirmation').modal('show');
        //if(confirm('{{trans('common.message.alert_delete')}}')) {
        //}
    }
    // play or resume campaign
    function sendCampaign(id) {
        $.ajax({
            url: "{{ url('/') }}"+'/broadcasts/scheduled/pause/'+id+'/processing',
            type: "POST",
            success: function(result) {
                requests=[];
                objTable.draw();
            }
        });
    }
    // pause campaign
    function pauseCampaign(id) {
        $.ajax({
            url: "{{ url('/') }}"+'/broadcasts/scheduled/pause/'+id+'/pause',
            type: "POST",
            success: function(result) {
                requests=[];
                objTable.draw();
            }
        });
    }

    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        var campaigns = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type  : "POST",
            url   : "{{ route('delete.selected.schedule.campaigns') }}",
            data    : {ids: campaigns},
            beforeSend: function() {
                $('.blockUI').show();    
            },
           success: function(result) {
               $('.blockUI').hide();    
                if(result == 'delete') {
                   location.reload();
                }
            }
    });

    }
</script>

<script>

    $("body").on("click" , ".runCampaign" , function() { 
        $(this).hide();
        var id = $(this).attr("data-id");
        var form_data = {
            id : id,
        }
        $.ajax({
            url: "{{ url('/') }}"+'/broadcasts/schedule/run',
            type: "POST",
            data:form_data,
            success: function (data) {
               
            }
        });
        
    })
    $(document).ready(function() {
        $.ajax({
            url: "{{ url('/') }}"+'/broadcasts/schedule/initiate',
            type: "get",
            success: function (data) {
            }
        });
        
	$("#bulk_operation").change(function(){
            if($(this).val()==1){
                if(!$('input:checkbox:checked').length){
                    alert('{{trans('common.message.alert_no_record')}}');
                    $("#bulk_operation").val("");
                    return false;
                }
                $('#soft_hard_delete_confirmation').modal('show');
                $("#isDeleteSingle").val(0);
            }
        });
    });

    function deleteCampaign() {
        if(!$('input:checkbox:checked').length){
            alert('{{trans('common.message.alert_no_record')}}');
            $("#bulk_operation").val("");
            return false;
        }
        $('#soft_hard_delete_confirmation').modal('show');
        $("#isDeleteSingle").val(0);
    }

    function showDeleteModal(id) {
            id_to_delete = id;
            $('#soft_hard_delete_confirmation').modal('show');
        }
    function hideDeleteModal() {
        $('#soft_hard_delete_confirmation').modal('hide');
        if($("#isDeleteSingle").val()==0){
            deleteAll();
        }else{
            var id = $("#delSchedileID").val();
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/broadcasts/schedule/delete/'+id,
                type: "POST",
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
    function deleteCancel(){
	$("#isDeleteSingle").val(1);
        $("#delSchedileID").val("");
        $("#bulk_operation").val("");
    }
		


</script>

@if(Session::get('queue_job') == 'true')
@php Session::forget('queue_job'); @endphp
<script>
    $(document).ready(function() {
        $.ajax({
            url: "{{ url('/') }}"+'/broadcasts/prepare',
            type: "post",
            success: function (data) {
            }
        });
    });
</script>
@endif
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())
<!-- if Primary domain not verified -->
@if($primary_domain_check != 'confirm' && Auth::user()->id == 2)
<div class="panel warning dash-panel" id="cronsetup" data-name="bVirqSDP">
    <div class="alert alert-warning" role="alert" data-name="iTNCYLAc">
        <div class="alert-icon" data-name="qIsoYunO"><i class="flaticon-warning"></i></div>
        <div class="alert-text" data-name="VWKhfBkQ">
            <b>{{ trans('common.warning.title') }}</b> {{ trans('schedule_broadcast.view.page.primary_domain_unverified') }}
            <div class="pull-right" data-name="YmvQOZgJ"><button type="button" class="btn btn-danger btn-xs" data-dismiss="alert" aria-hidden="true" id="dash-btn" onclick="window.location.href='/settings/primary/domain'">{{ trans('schedule_broadcast.view.page.setup_primary_domain') }}</button></div>
        </div>
    </div>
</div>
@endif
<!-- if Primary domain not verified -->

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="DkiRWUax">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="kPymdNcw">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>

<div class="row schedule-view" data-name="CujRoJDA">
    <div class="col-md-12" data-name="HBrDDqhe">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="gzoaiofk">
            <div class="kt-portlet__body" data-name="WoSZzKPV">
                <div class="table-toolbar" data-name="koobPMMR">
                    <div class="form-group row mb0" data-name="hbliQLmd">
                        <div class="col-md-12 col-sm-12 mb1" data-name="THyvtGFb">
                           @if (routeAccess('broadcast.schedule.create'))
                            <div class="btn-group" data-name="kCHDPEcd">
                                <a href="{{ route('broadcast.schedule.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('schedule_broadcast.view.page.schedule_email_campaign')}}
                                </button></a>
                            </div>
                           @endif
                           <div class="btn-group pull-right" data-name="moCsUQYT">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="javascript:;" onclick="deleteCampaign();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb1" data-name="wgVeyLic">
                    <div class="col-md-10  col-sm-6" data-name="jiIioJks">
                        <div id="campaign_type" class="kt-radio-inline" data-name="XveCApQK">
                            <label class="kt-radio kt-radio--solid" for="all">
                                <input type="radio" name="campaign_type" checked="" value="all" id="all"> {{trans('schedule_broadcast.view.page.sort.all')}}
                                <span></span>
                            </label>
                            <label class="kt-radio kt-radio--solid" for="subscriber">
                                <input type="radio" name="campaign_type" value="subscriber" id="subscriber">{{trans('schedule_broadcast.view.page.filters.regular_campaigns')}}
                                <span></span>
                            </label>
                            <label class="kt-radio kt-radio--solid" for="segment">
                                <input type="radio" name="campaign_type" value="segment" id="segment"> {{trans('schedule_broadcast.view.page.filters.segmented_campaigns')}}
                                <span></span>
                            </label>
                            <label class="kt-radio kt-radio--solid" for="split_test">
                                <input type="radio" class="kt-radio kt-radio--solid" name="campaign_type" value="split_test" id="split_test"> {{trans('schedule_broadcast.view.page.filters.split_test')}}
                                <span></span>
                            </label>
                            @php $evergreenAddon = addon_license_status("Evergreen Campaigns"); @endphp
                             @if($evergreenAddon == "Active")
                            <label class="kt-radio kt-radio--solid" for="evergreen">
                                <input type="radio" class="kt-radio kt-radio--solid" name="campaign_type" value="evergreen" id="evergreen"> {{trans('schedule_broadcast.view.page.filters.evergreen')}}
                                <span></span>
                            </label>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-6 mb1 pull-right" data-name="VilSOiol">
                            <div class="status_filter" data-name="zBYPFOtg" >
                                <select class="form-control m-select2 mb15" id="statusFilter" name="statusFilter" size="1">
                                <option value="scheduled">{{trans('schedule_broadcast.view.page.sort.scheduled')}}</option>
                                    <option value="processing">{{trans('schedule_broadcast.view.page.sort.processing')}}</option>
                                    <option value="complete">{{trans('schedule_broadcast.view.page.sort.complete')}}</option>
                                    <option value="paused">{{trans('schedule_broadcast.view.page.sort.paused')}}</option>
                                    <option value="system paused">{{trans('schedule_broadcast.view.page.sort.system_paused')}}</option>
                                    <option value="prepared">{{trans('schedule_broadcast.view.page.sort.prepared')}}</option>
                                    <option value="resumed">{{trans('schedule_broadcast.view.page.sort.resumed')}}</option>
                                    <!-- <option value="WaitingForResult">{{trans('Waiting For Result')}}</option> -->
                                    <option value="all" selected>{{trans('schedule_broadcast.view.page.sort.all')}}</option>
                                </select>
                            </div>
                        </div>
                </div>  
                @include('includes.view-pages-filter')
                <div class="rel-block" data-name="onwYwkLn">
                    <?php 
                        $delete_schedule_broadcast_flag = getSetting('delete_schedule_broadcast_flag');
                        $delete_schedule_broadcast = getSetting('delete_schedule_broadcast');
                        if($delete_schedule_broadcast_flag == "on") {
                    ?>
                    <div class="user-table-warning"><b>{{trans('broadcasts.schedule_view_blade.txt_note_bold')}}</b>{{trans('broadcasts.schedule_view_blade.statistics_data_div')}} <code>{{ $delete_schedule_broadcast}}</code>{{trans('broadcasts.schedule_view_blade.days_deleted_div')}}</div>
                    <?php } ?>
                    
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-checkable" id="custom-fields" role="grid" >
                            <thead>
                                <tr role="row">
                                    <th style="width: 25px;">
                                        <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                            <input type="checkbox" class="checkboxes checkbox-all-index" onclick="$('#bulk_operation').val('')">
                                            <span></span>
                                        </label>
                                    </th>
                                    <th>{{trans('schedule_broadcast.view.table_headings.id')}}</th>
                                    <th>{{trans('schedule_broadcast.view.table_headings.name')}}</th>
                                    <th>{{trans('schedule_broadcast.view.table_headings.start_time')}}</th>
                                    <th>{{trans('schedule_broadcast.view.table_headings.status')}}</th>
                                    <th>{{trans('schedule_broadcast.view.table_headings.contacts')}}</th>
                                    <th>{{trans('broadcasts.schedule_view_blade.hourly_speed_th')}}</th>
                                    <th>{{trans('schedule_broadcast.view.table_headings.progress')}}</th>
                                    <th>{{trans('schedule_broadcast.view.table_headings.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- SMTP Failed Modal -->
<div id="modal-smtp-failed" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="iHcTTUSG">
    <div class="modal-dialog" style="width: 500px;" data-name="TRroNmBX">
        <div class="modal-content" data-name="lTaClAmS">
            <div class="modal-header" data-name="IINDblxw">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{ trans('schedule_broadcast.view.page.system_paused') }}</h4>
            </div>
            <div class="modal-body" data-name="qoKCJXyD">
                <div id="smtp-error-data" data-name="FZRCvLGs"></div>
            </div>
        </div>
    </div>
</div>
<!-- SMTP Failed Modal -->


<!-- SMTP Failed Modal -->
<div id="systemStoppedByPolicy" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="iHcTTUSG">
    <div class="modal-dialog" style="width: 500px;" data-name="TRroNmBX">
        <div class="modal-content" data-name="lTaClAmS">
            <div class="modal-header" data-name="IINDblxw">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{ trans('notifications.campaign_stopped_by_policy_title') }}</h4>
            </div>
            <div class="modal-body" data-name="qoKCJXyD">
                <div id="smtp-error-data" data-name="FZRCvLGs">{{ trans('notifications.campaign_stopped_by_policy_hardbounce') }}</div>
            </div>
        </div>
    </div>
</div>
<!-- SMTP Failed Modal -->


<!-- Edit Hourly Speed Modal -->
<div id="editSpeed" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="UneZObIA">
    <div class="modal-dialog" data-name="KNiQZRej">
        <div class="modal-content" data-name="bcIbLvZk">
            <div class="modal-header" data-name="dLzYBKUN">
                <h5 class="modal-title">{{trans('schedule_broadcast.view.page.edit_hourly_speed')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-name="YdSvmKlk">
                <form action="" id="editSpeedForm" method="post" class="kt-form kt-form--label-right">
                    <div class="form-group row" data-name="AruxrnLk">
                        <label class="col-md-3 col-form-label" >{{trans('schedule_broadcast.view.page.hourly_speed')}} </label>
                        <div class="col-md-8" data-name="fQBTLQsP">
                            <input type="number" id="hourly_speed"  name="hourly_speed" class="form-control">
                            <small>{{trans('common.label.minus_1_for_unlimited')}}</small>
                        </div>
                    </div>
                    <div class="form-actions" data-name="aMgzEAsg">
                        <div class="row" data-name="sNlhblyi">
                            <label class="col-md-3 col-form-label" ></label>
                            <div class="col-md-8" data-name="DKelWXBW">
                                <button id="saveSpeed" type="button" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                                <input type="hidden" id="broadcast_id" value="" name="broadcast_id">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Hourly Speed Modal -->
<!-- delete confirmation modal -->
<div id="soft_hard_delete_confirmation" class="modal" tabindex="-1" role="dialog" data-name="lUStLzlG">    
    <input type="hidden" name="isDeleteSingle" id="isDeleteSingle" value="1" />
    <input type="hidden" name="delSchedileID" id="delSchedileID" value="" />
  <div class="modal-dialog" role="document" data-name="aZDECfWt">
    <div class="modal-content" data-name="CNQEEpwV">
      <div class="modal-header" data-name="AEYNGPAJ">
        <h5 class="modal-title"> {{trans('common.form.buttons.delete')}}</h5>
        <!-- <h5 class="modal-title"> {{trans('lists.contact_lists.modal.soft_or_hard_delete')}}</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" data-name="hLDdUdQT">
        <div class="alert alert-danger" data-name="pmiqGrMS"><span class="alert-text"> {{trans('schedule_broadcast.view.page.delete_message')}} </span></div>
      </div>
      <div class="modal-footer" data-name="ovFKfUEZ">
        <!-- <button type="button" onclick="hideDeleteModal(2)" class="btn btn-info">{{trans('lists.contact_lists.modal.soft_delete')}}</button> -->
        <button type="button" onclick="hideDeleteModal()" class="btn btn-danger">{{trans('common.form.buttons.delete')}}</button>
        <button type="button" class="btn btn-secondary" onclick="deleteCancel()" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
      </div>
    </div>
  </div>
</div>
<!-- delete confirmation modal -->
@endsection