@extends('layouts.master')

@section('title', trans('pmta.title'))

@section('page_styles')
<link href="/assets/global/plugins/datatables/datatables.min.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
$(document).ready(function() {
    $('#pmtas').dataTable({
        "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3,8]}],
        "bProcessing": true,
        "bServerSide": true,
        "aaSorting": [[0, "desc"]],
        "sPaginationType": "full_numbers",
        "sAjaxSource": "{{ url('/getPmtas') }}",
        "aLengthMenu": [[10, 50, 100], [10, 50, 100]]
    });
});

function downloadConfigs (pmta_id) {
    $.ajax({
      type: "POST",
      url: "{{ URL::route('pmta.operation.store') }}",
      data: { action: 'export_configs', pmta_id: pmta_id},
      success: function (result) {
        window.location.href = "{{ url('/') }}"+"/assets/files/exports/pmtas/"+pmta_id+"/pmta-config.zip";
      }
    });
}

function deletePmta(id) {
    if(confirm('{{trans('common.message.alert_delete')}}')) {
        $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/pmta/'+id,
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

function deleteAll () {
    if(!$('input:checkbox:checked').length){
       alert('{{trans('common.message.alert_no_record')}}');
       return false;
    }
    if(confirm('{{trans('common.message.alert_delete')}}')) {
        var pmta = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type    : "DELETE",
            url     : "{{ url('/') }}"+"/pmta/"+pmta,
            data    : {ids: pmta},
            success: function(result) {
                if(result == 'delete') {
                    window.location.href = "{{ url('/') }}"+"/pmta/integration";
                }
            }
        });
    }
}
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="DkqYVbOy">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.integration.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.integration.pmta.title')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.integration.pmta.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="GimYjeVd">
    <p>
        {{getHeading(trans('app.headings.integration.pmta.view'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="EbuIuggQ">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="SKhnBRkE">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="VommQZov">
    <div class="col-md-12" data-name="TbqHGCxs">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="vTgmzVpS">
            <div class="portlet-body" data-name="pTKJwUMF">
                <div class="table-toolbar" data-name="WvaaynHv">
                    <div class="row" data-name="nuqXbKDS">
                        <div class="col-md-6" data-name="oPOOWwEr">
                           @if(routeAccess('pmta.integration.create'))
                            <div class="btn-group" data-name="VSadAFwz">
                                <a href="{{ route('pmta.integration.create') }}">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    {{trans('app.integration.pmta.view_all.buttons.add_pmta')}} <i class="fa fa-plus"></i>
                                </button></a>
                            </div>
                           @endif
                        </div>
                        <div class="col-md-6" data-name="PtYzBBNm">
                            <div class="btn-group pull-right" data-name="OzBFdaXk">
                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">
                                    {{trans('app.integration.pmta.view_all.buttons.tools')}} <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                 @if(routeAccess('pmta.destroy'))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();"> <i class="glyphicon glyphicon-remove"></i> {{trans('app.integration.pmta.view_all.buttons.tools_delete')}} </a>
                                    </li>
                                 @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dataTables_wrapper no-footer" data-name="UhFgQyaG">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="pmtas" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('app.integration.pmta.view_all.table_headings.sr')}}</th>
                                <th>{{trans('app.integration.pmta.view_all.table_headings.server_name')}}</th>
                                <th>{{trans('app.integration.pmta.view_all.table_headings.smtp_host')}}</th>
                                <th>{{trans('app.integration.pmta.view_all.table_headings.smtp_port')}}</th>
                                <th>{{trans('app.integration.pmta.view_all.table_headings.server_ip')}}</th>
                                <th>{{trans('app.integration.pmta.view_all.table_headings.pmta_port')}}</th>
                                <th>{{trans('pmta.pmta_blade.created_at_th')}}</th>
                                <th>{{trans('app.integration.pmta.view_all.table_headings.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection