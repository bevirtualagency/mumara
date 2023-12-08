@extends('layouts.master')

@section('title', trans('app.settings.notifications.view_all.title'))

@section('page_styles')
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#notifications').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,6]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getNotifications') }}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    });

    function notificationDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/notification/'+id,
                type: "DELETE",
                success: function(result) {
                    if(result == 'delete') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success ');
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
            var notifications = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/notification/"+notifications,
                data    : {ids: notifications},
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{ url('/') }}"+"/notification";
                    }
                }
            });
        }
    }
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="zQEGkWoR">
    <ul class="page-breadcrumb">
        <li>
            <span>
                {{trans('app.settings.title')}}
            </span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>
                {{trans('app.settings.notifications.title')}}
            </span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.settings.notifications.view_all.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="cJTLUvAw">
    <p>
        {{getHeading(trans('app.headings.settings.notifications.view'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="hYKuCkMj">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="eNhyDBsd">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="zryhBkZD">
    <div class="col-md-12" data-name="ikCxhMhr">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="ulstPptN">
            <div class="portlet-body" data-name="iQVjXYIY">
                <div class="table-toolbar" data-name="sxAHdfNR">
                    <div class="row" data-name="FgWrQZzN">
                        <div class="col-md-12" data-name="qyaJlKLz">
                        @if(rolePermission(265))
                            <div class="btn-group" data-name="GsKUZhip">
                                <a href="{{route('notification.create')}}">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    <i class="fa fa-plus"></i> {{trans('app.settings.notifications.view_all.buttons.add_notification')}} 
                                </button></a>
                            </div>
                        @endif
                            <div class="btn-group pull-right" data-name="rROctFUb">
                                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('app.settings.notifications.view_all.buttons.tools')}} <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                @if(rolePermission(268))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();"> <i class="glyphicon glyphicon-remove"></i> {{trans('app.settings.notifications.view_all.buttons.tools_delete')}}  </a>
                                    </li>
                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dataTables_wrapper no-footer" data-name="JSvpWWSS">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="notifications" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkbox checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('app.settings.notifications.view_all.table_headings.sr')}}</th>
                                <th>{{trans('app.settings.notifications.view_all.table_headings.title')}}</th>
                                <th>{{trans('app.settings.notifications.view_all.table_headings.description')}}</th>
                                <th>{{trans('app.settings.notifications.view_all.table_headings.publish')}}</th>
                                <th>{{trans('app.settings.notifications.view_all.table_headings.created_at')}}</th>
                                <th>{{trans('app.settings.notifications.view_all.table_headings.actions')}}</th>
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