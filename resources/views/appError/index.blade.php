@extends('layouts.master2')

@section('title', $pageTitle)

@section('page_styles')
    <style type="text/css">
        .table-scrollable .dataTable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
        //position: absolute !important;
        //margin-top: -10px !important;
        }
        @media(max-width: 767px) {
            .table-scrollable .dataTable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
                position: relative !important;
                margin-top: 0px !important;
            }
            .table-scrollable .dropdown-menu, .table-responsive .dropdown-toggle {
                position: static !important;
            }
            .dropdown-backdrop {
                position: relative;
            }
            .dataTables_wrapper .dataTables_paginate .paginate_button {
                padding: 0;
            }
            .dataTables_wrapper .row .col-md-6.col-sm-6 {
                width: 50%;
                float: left;
                text-align: left;
            }
            .dataTables_wrapper .dataTables_filter {
                margin-top: 0;
            }
            .dataTables_wrapper .dataTables_filter .input-small {
                width: 85px!important;
            }
        }
        @media (max-width: 1366px) and (min-width: 1025px) {
            .table-scrollable {
                overflow: hidden !important;
                overflow-x: visible !important;
                overflow-y: auto !important;
            }
            .table-scrollable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
                position: relative !important;
                margin-top: 0 !important;
            }
            .dataTables_wrapper .row:last-child {
                margin: 0 !important;
            }
            .dataTables_wrapper {
                overflow: hidden;
            }
        }
        @media (min-width: 1367px) {
            .table-scrollable {
                min-height: auto;
                overflow: hidden !important;
                overflow-y: visible !important;
                overflow-x: visible !important;
            }
            table.table-bordered.dataTable {
                min-height: auto;
                overflow: visible;
                overflow-x: visible;
                overflow-y: visible !important;
            }
            .table-scrollable>.table-bordered>tbody>tr>td:last-child {
                text-align: left;
            }
        }
        div#example_ddl {
            position: relative;
            display: inline-block;
            min-width: 300px;
            max-width: 300px;
            margin-left: 5px;
        }
    </style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
    <script>
            var table = $('#campaigns').DataTable({
                "aoColumnDefs": [{"bSortable": false, "aTargets": [0,1,3]}],
                "bProcessing": true,
                "bServerSide": true,
                "aaSorting": [[2, "desc"]],
                "sPaginationType": "full_numbers",
                "sAjaxSource": "{{ route('getErrors') }}",
                "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]],
            });

$('#select').change(function () {
    table
        .columns( 1 )
        .search( this.value )
        .draw();
});


        function deleteCampaign(id) {
            if(confirm('{{trans('common.message.alert_delete')}}')) {
                $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/broadcasts/'+id,
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
        function deleteRecords (id=null) {
            if(!$('input:checkbox:checked').length && id==null){
                alert('{{trans('common.message.alert_no_record')}}');
                return false;
            }
            if(confirm('{{trans('common.message.alert_delete')}}')) {
                if(id!=null)
                    logs = [id];
                    else
                var logs = $('input:checkbox:checked').map(function() {
                    return this.value;
                }).get();
                $.ajax({
                    type  : "DELETE",
                    url   : "{{route('errors.destroy',0)}}",
                    data    : {ids: logs},
                    success: function(result) {
                        if(result == 'delete') {
                     window.location.reload();
                        }
                    }
                });

            }
        }
    </script>
@endsection

@section('content')
    <!-- will be used to show any messages -->
    <div class="row" data-name="YsXDVHGF">
        <div class="col-md-12" data-name="BGLXCuVf">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="kt-portlet kt-portlet--height-fluid" data-name="EOgFmyfW">
                <div class="kt-portlet__body" data-name="twacvbCZ">
                    <div class="table-toolbar" data-name="uarofXPF">
                        <div class="form-group row" data-name="ODnxYGBD">
                            <div class="col-md-12" data-name="gCJTdgZx">
                                <div class="btn-group" data-name="mhQjJcad">
                                    <a href="#">
                                        <button id="sample_editable_1_new" class="btn btn-label-success">
                                            <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                        </button>
                                    </a>
                                </div>
                                <div id="example_ddl" data-name="XgHHDetU">
                                    <select id="select" class="form-control m-select2">
                                        <option value="">@lang('common.label.type')</option>
                                        @foreach($types as $type)
                                        <option value="{{$type->type}}">{{ucfirst($type->type)}}</option>
                                            @endforeach
                                    </select>
                                </div>
                                <div class="btn-group pull-right" data-name="TOWDGvFL">
                                    <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                        {{trans('common.form.buttons.tools')}}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="javascript:;" onclick="deleteRecords();" class=""> <i class="la la-close"></i> {{trans('common.form.buttons.delete')}}  </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped table-hover table-checkable responsive" id="campaigns" role="grid" >

                        <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('app_errors.table_headings.type')}}</th>
                            <th>{{trans('app_errors.table_headings.error')}}</th>
                            <th>{{trans('app_errors.table_headings.added_on')}}</th>
                            <th>{{trans('app_errors.table_headings.actions')}}</th>

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
@endsection