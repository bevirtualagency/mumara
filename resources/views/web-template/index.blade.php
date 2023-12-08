@extends('layouts.master')

@section('title', trans('web_templates.web_create_blade.web_templates_span'))

@section('page_styles')
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.checkbox-all-index').click(function () {
            if($(this).is(':checked')) {
                $('.checkbox-index').prop('checked', true);
            } else {
                $('.checkbox-index').prop('checked', false);
            }
        });
        $('#web-templates').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getAllTemplates') }}",
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
    });
    function deleteTemplate(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/delete-templates/'+id,
                type: "DELETE",
                beforeSend: function () {
                    $("#modal-loading").modal('show');
                },
                complete: function () {
                    $("#modal-loading").modal('hide');
                },
                success: function(result) {
                    if(result == 'delete') {
                        Command: toastr["error"] ("{{trans('web_templates.web_index_blade.template_successfully_deleted_command')}}");
                        window.location.href = "{{ url('/') }}"+"/web-templates";
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
        var custom_fields = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            url: "{{ url('/') }}"+'/delete-templates/'+custom_fields,
            type: "DELETE",
            data: {ids: custom_fields},
            beforeSend: function () {
                $("#modal-loading").modal('show');
            },
            complete: function () {
                $("#modal-loading").modal('hide');
            },
            success: function(result) {
                if(result == 'delete') {
                    Command: toastr["error"] ("{{trans('common.message.delete')}}");
                    window.location.href = "{{ url('/') }}"+"/web-templates";
                }else if(result == 'exists'){
                    Command: toastr["error"] ("{{trans('web_templates.web_index_blade.web_templat_used_command')}}");
                    window.location.href = "{{ url('/') }}"+"/web-templates";
                }
            }
        });

        }
    }
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="rwYezyEI">
    <ul class="page-breadcrumb">
        <li>
            <span><a href="{{ route('dashboard') }}">{{trans('app.breadcrumbs.dashboard')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><a href="{{ route('webtemplate.index') }}">{{trans('web_templates.web_create_blade.web_templates_span')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('web_templates.web_index_blade.span_all_templates')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('web_templates.web_create_blade.web_templates_span')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="LDesAcCs">
    <p>
        {{getHeading(trans('app.headings.list_management.custom_fields.view'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="cWNrBApn">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="NhsHVCGM">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="UztWGaPH">
    <div class="col-md-12" data-name="HVaUaCuq">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="VCbGbQot">
            <div class="portlet-body" data-name="weDxOWsv">
                <div class="table-toolbar" data-name="CDLznPwz">
                    <div class="row" data-name="dIOZEmTM">
                        <div class="col-md-12" data-name="NuIkclIB">
                        @if (rolePermission(54) || rolePermission(16))
                            <div class="btn-group" data-name="hHrdCXDR">
                                <a href="{{ route('webtemplate.create') }}">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    <i class="fa fa-plus"></i> {{trans('web_templates.web_create_blade.web_templates_span')}}
                                </button></a>
                            </div>
                            <div class="btn-group pull-right" data-name="PBJdMPAS">
                                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    Tools <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();"> <i class="fa fa-remove"></i> {{trans('web_templates.web_index_blade.action_delete_all')}}   </a>
                                    </li>
                                </ul>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
                <div class="table-scrollable" data-name="wwxwOmUb">
                    <table class="table table-striped table-bordered table-hover dataTable" id="web-templates" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('web_templates.web_index_blade.name_th_txt')}}</th>
                                <th>{{trans('web_templates.web_index_blade.creation_date_th')}}</th>
                                <th>{{trans('web_templates.web_index_blade.actions_th_txt')}}</th>
                                <!-- <th></th> -->
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