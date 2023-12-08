@extends('layouts.master')

@section('title', trans('app.email_templates.view_all.title'))

@section('page_styles')
<link href="/assets/global/plugins/datatables/datatables.min.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<style type="text/css">
@media(max-width: 767px) {
    .modal-dialog {
        width: 94%;
        margin: 0;
    }
}      
</style>
@endsection

@section('page_scripts')
<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#email_template').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,5]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getEmailTemplates') }}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    });

    function templateDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/email-template/'+id,
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
            var email_template = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/email-template/"+email_template,
                data    : {ids: email_template},
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{ url('/') }}"+"/email-template";
                    }
                }
            });
        }
    }
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="zlDGszvg">
    <ul class="page-breadcrumb">
        <li>
            <span>
                {{trans('app.email_templates.title')}}
            </span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>
                {{trans('app.email_templates.view_all.title')}}
            </span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.email_templates.view_all.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="TcFWdovm">
    <p>
        {{getHeading(trans('app.headings.email_templates.view'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="gKuUcIAT">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="dSIzzKtK">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="QvmMJKVh">
    <div class="col-md-12" data-name="ykFviSJk">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="YONIBkAr">
            <div class="portlet-body" data-name="kPKDuGMz">
                <div class="table-toolbar" data-name="agUyCGjM">
                    <div class="row" data-name="RhDgxCYS">
                        <div class="col-md-12" data-name="xmrAVsaN">
                           @if(rolePermission(150))
                            <div class="btn-group" data-name="CSXCgWwK">
                                <a href="/email-template/create/?view=list">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    <i class="fa fa-plus"></i> {{trans('app.email_templates.view_all.buttons.add_template')}} 
                                </button></a>
                            </div>
                           @endif
                           <div class="btn-group pull-right" data-name="eKmwTqIu">
                                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('app.email_templates.view_all.buttons.tools')}} <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                 @if(rolePermission(155))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();"> <i class="glyphicon glyphicon-remove"></i> {{trans('app.email_templates.view_all.buttons.delete')}}  </a>
                                    </li>
                                 @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dataTables_wrapper no-footer" data-name="VAWzXwOU">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="email_template" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkbox checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('app.email_templates.view_all.table_headings.sr')}}</th>
                                <th>{{trans('app.email_templates.view_all.table_headings.group')}}</th>
                                <th>{{trans('app.email_templates.view_all.table_headings.name')}}</th>
                                <th>{{trans('app.email_templates.view_all.table_headings.created_on')}}</th>
                                <th>{{trans('app.email_templates.view_all.table_headings.actions')}}</th>
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