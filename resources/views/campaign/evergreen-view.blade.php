@extends('layouts.master2')

@section('title', trans('evergreen.title'))

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/evergreen-view.css?v={{$local_version}}.02">
<link href="/themes/default/css/sweetalert2.min.css" rel="stylesheet" type="text/css">
<style>
#custom-fields tr th:last-child, #custom-fields tr td:last-child {
    white-space: nowrap !important;
    max-width: 80px !important;
    text-align: center;
}    
.table thead th:first-child, .table tbody td:first-child {
    text-align: center;
    max-width: 50px !important;
    width: 4% !important;
}
table.dataTable td, table.dataTable th {
    text-align:center !important;
    white-space: nowrap !important;
}
#custom-fields tr th:nth-child(2), #custom-fields tr td:nth-child(2) {
    text-align: left !important;
}
/* #custom-fields tr th:nth-child(2), #custom-fields tr td:nth-child(2), #custom-fields tr th:nth-child(3), #custom-fields tr td:nth-child(3), #custom-fields tr td:nth-child(2), #custom-fields tr th:nth-child(4), #custom-fields tr td:nth-child(4), #custom-fields tr td:nth-child(2), #custom-fields tr th:nth-child(8), #custom-fields tr td:nth-child(8) {
    width: 300px;
    min-width: 200px !important;
}
#custom-fields tr th:nth-child(2), #custom-fields tr td:nth-child(2) {
    white-space: normal !important;
    word-break: break-word;
    max-width: 400px;
    width: 100%;
} */
table.dataTable td, table.dataTable th {
    text-align:center !important
}
#custom-fields tr th:nth-child(3), #custom-fields tr td:nth-child(3), #custom-fields tr th:nth-child(4), #custom-fields tr td:nth-child(4) {
    min-width: 120px;
}

#custom-fields tr th:nth-child(2), #custom-fields tr td:nth-child(2) {
    min-width: 250px;
    text-align: left !important;
    white-space:normal !important;
    word-break: break-all;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
    <script src="/themes/default/js/sweetalert2.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script>
     var objTable;
      var record_type = 'our_records';
    $(document).ready(function() {

        $(".m-select2").select2();

        $("body").on("click", ".schedule-delete",function() {
            var id = $(this).attr('id');
            // console.log(id);
            Swal.fire({
                title: "{{trans('dynamictags.delete.popup_sure')}}",
                text: "{!! trans('dynamictags.delete.popup_not_revert') !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{trans('dynamictags.delete.popup_button_delete')}}"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "{{ url('/') }}"+'/broadcasts/evergreen/delete/'+id,
                        type: "GET",
                        success: function(result) {
                            if(result == 'delete') {
                                Swal.fire(
                                    "{{trans('dynamictags.delete.popup_deleted')}}" ,
                                    "{{trans('common.campaign_delete')}}",
                                    'success'
                                );
                                setTimeout(function() {
                                    Swal.close()
                                    location.reload();
                                }, 2000);
                            }
                        }
                    });

                    
                   
                }
            });
        });

       
        // function in master2 layout
        var page_limit=show_per_page('','evergreen-view-pageLength',10);  // Params (table,page,default_limit=10)
        var campaignsTable;
      
      
        campaignsTable = $('#custom-fields').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3,5,6,8]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/campaign/get-evergreen-campaign') }}",
            "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                // aoData.push({"name": "record_type", "value": "our_records"});
                // aoData.push({"name": "clients", "value": $("#clients").val()});
                // aoData.push({"name": "admins", "value": $("#admins").val()});
                aoData.push(
                    {"name": "campaign_type", "value": $('input[name=campaign_type]:checked').val()},
                    {"name": "statusFilter", "value": $("#statusFilter").val()},
                    {"name": "record_type", "value": record_type},
                    {"name": "clients", "value": $("#clients").val()},
                    {"name": "admins", "value": $("#admins").val()}
                );
              
            },
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        objTable = campaignsTable;
         page_limit=show_per_page(campaignsTable,'evergreen-view-pageLength'); 
        $("#campaign_type, #statusFilter , #admins, #clients").change(function () {
            campaignsTable.draw();
        });
    });

    function systemPaused(id) {
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/broadcasts/system-paused',
            data    : {id: id},
            success: function(result) {
                // console.log(result);
                $('#smtp-error-data').html(result);
                $("#modal-smtp-failed").modal('show');
            }
        });
    }
    

    function deleteScheduleCampaign(id , type) {
        if(type == 1) { 
            if(confirm('{{trans('common.message.alert_delete_evergreen_all')}}')) {
                $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/broadcasts/evergreen/deleteall/'+id,
                    type: "POST",
                    success: function(result) {
                        if(result == 'delete') {
                            $('#msg').show();
                            $('#msg-text').html('{{trans('common.message.delete')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success display-show');
                            toastr.success("{{trans('evergreen.delete_success')}}");
                        }
                    }
                });
            }
        } else { 
            if(confirm('{{trans('common.message.alert_delete_evergreen')}}')) {
                // $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/broadcasts/evergreen/delete/'+id,
                    type: "POST",
                    success: function(result) {
                        if(result == 'delete') {
                            $('#msg').show();
                            $('#msg-text').html('{{trans('common.message.delete')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success display-show');
                            toastr.success("{{trans('evergreen.flush_success')}}");
                        }
                    }
                });
            }
        }
        
    }

    function sendCampaign(id) {
        $("#play-schedule-"+id).attr("style","display: none")
        $("#pause-schedule-"+id).removeAttr("style");
        $.ajax({
            url: "{{ url('/') }}"+'/broadcasts/scheduled/pause/'+id+'/processing',
            type: "POST",
            success: function(result) {
            }
        });
    }

    // function pauseCampaign(id , action) {
        $("body").on("change" , ".statusC", function() { 
            let action = "inactive";
            let id = $(this).attr("data-id");
            if($(this).is(":checked")) { 
                action = "active";
            }
            $.ajax({
                url: "{{ url('/') }}"+'/evergreen/scheduled/pause/'+id+'/' + action,
                type: "POST",
                success: function(result) {
                    toastr.success("{{trans('evergreen.status_update_success')}}");
                }
            });
        });
</script>
@include('includes.view-pages-filter-script')
@endsection
@section('content')
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="SFFBfmXv">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="CUGkkFtk">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>

<div class="row" data-name="hEGiqMlF">
    <div class="col-md-12" data-name="KEmwouSp">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="xeYGmFdz">
            <div class="kt-portlet__body" data-name="voBjAhOf">
                <div class="table-toolbar mb1" data-name="HwGuUMau">
                    <div class="form-group row mb0" data-name="jGnpjCrY">
                        <div class="col-md-10 col-sm-6 mb1" data-name="ilGrsOZo">
                            <?php 
                                $canAdd = routeAccess('campaign.evergreen.create');
                                $isadmin = Auth::user()->is_staff;
                            ?>
                           @if ($canAdd )
                            <div class="btn-group" data-name="SCQZHrrZ">
                                <a href="{{ url('schedule/new?evergreen=1') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('evergreen.schedule_email_campaign')}}
                                </button></a>
                            </div>
                           @endif
                           @if($evergreen_count > 0 && !$isadmin)
                                <button class="btn btn-label-warning btn-sm" id="contacts_limit">{{trans('evergreen.evergreen_limit')}} : {{$evergreen_count}} / {{$evergreen_campaigns_limit}}</button> 
                            @endif  

                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 mb1 pull-right" data-name="lByybmNE">
                            <div class="status_filter" data-name="OXHrtxUH" >
                                <select class="form-control m-select2 mb15" id="statusFilter" name="statusFilter" data-placeholder="Select Option">
                                    <option value="inactive">{{trans('evergreen.inactive')}}</option>
                                    <option value="active">{{trans('evergreen.active')}}</option>
                                    <option value="all" selected>{{trans('schedule_broadcast.view.page.sort.all')}}</option>
                                </select>
                            </div>
                            
                        </div>
                       

                    </div>
                </div>
                <div class="form-group row mb1 hide" data-name="CffnITxX">
                    <div class="col-md-12" data-name="ditmoTrI">
                        <div id="campaign_type" class="kt-radio-inline" data-name="UzxNGMCm">
                            <label class="kt-radio kt-radio--solid" for="all">
                                <input type="radio" name="campaign_type" checked="" value="all" id="all">  {{trans('schedule_broadcast.view.page.sort.all')}}
                                <span></span>
                            </label>
                        </div>
                        
                    </div>
                </div>
                @include('includes.view-pages-filter')
                <table class="table table-striped table-hover table-checkable responsive" id="custom-fields" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('evergreen.schedule_label')}}</th>
                            <th>{{trans('evergreen.last_run')}}</th>
                            <th>{{trans('evergreen.next_run')}}</th>
                            <th>{{trans('evergreen.no_of_runs')}}</th>
                            <th>{{trans('evergreen.frequency')}}</th>
                        
                            <th>{{trans('schedule_broadcast.view.table_headings.status')}}</th>
                            <th>{{trans('evergreen.created_at')}}</th>
                            <!-- <th>{{trans('app.dashboard.lang.progress')}}</th> -->
                            <!--   <th>{{trans('app.campaigns.view_schedule.table_headings.notice')}}</th> -->
                            <th>{{trans('schedule_broadcast.view.table_headings.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<div id="modal-smtp-failed" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="CvFgcyYO">
    <div class="modal-dialog" style="width: 500px;" data-name="rnmffQup">
        <div class="modal-content" data-name="FJGNwbWc">
            <div class="modal-header" data-name="krmTHwtq">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">{{ trans('app.campaigns.broadcasts.create.system_paused') }}</h4>
            </div>
            <div class="modal-body" data-name="YDzQWxKa">
                <div id="smtp-error-data" data-name="IAmRpbzP"></div>
            </div>
        </div>
    </div>
</div>
@endsection