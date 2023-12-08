@extends('layouts.master')

@section('title', trans('app.statistics.title'))

@section('page_styles')
<style>
th.dt-center, td.dt-center { text-align: center; }
@media(max-width: 767px) {
.table-scrollable .dataTable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
    position: relative !important;
}
.table-scrollable .dropdown-menu, .table-responsive .dropdown-toggle {
    position: static !important;
}
.dropdown-backdrop {
    position: relative;
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
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0;
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
        $('#pixel-statistics').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2,3,4,5], "className": "dt-center"}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/statistics/getPixels') }}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    });
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="shdNPbfZ">
    <ul class="page-breadcrumb">
        <li>
            <span><a href="{{ route('dashboard') }}">{{trans('app.breadcrumbs.dashboard')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><a href="javascript:;">{{trans('app.breadcrumbs.statistics')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><a href="javascript:;">{{trans('app.breadcrumbs.trigger')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.breadcrumbs.view_all')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.statistics.pixel.view_all.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="tMeISHhI">
    <p>
        {{trans('app.statistics.pixel.view_all.description')}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="XmiaAgZQ">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="XSjQPdBv">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="MQCYMKLa">
    <div class="col-md-12" data-name="gkanVUPi">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="WpErgoZw">
            <div class="portlet-body" data-name="gGvsFeJG">
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="pixel-statistics" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('app.statistics.pixel.view_all.table_headings.sr')}}</th>
                                <th>{{trans('app.statistics.pixel.view_all.table_headings.event')}}</th>
                                <th>{{trans('app.statistics.pixel.view_all.table_headings.url')}}</th>
                                <th>{{trans('app.statistics.pixel.view_all.table_headings.browser')}}</th>
                                <th>{{trans('app.statistics.pixel.view_all.table_headings.os')}}</th>
                                <th>{{trans('app.statistics.pixel.view_all.table_headings.ip')}}</th>
                                <th>{{trans('app.statistics.pixel.view_all.table_headings.created')}}</th>
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