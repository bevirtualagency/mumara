@extends('layouts.master2')

@section('title', trans('fbl.processed.title'))

@section('page_styles')
<link href="/assets/global/plugins/datatables/datatables.min.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<style type="text/css">
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
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        // function in master2 layout
        var page_limit=show_per_page('','fbl-processed_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#fbl-processed').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getProcessedFbls') }}",
            "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
        page_limit=show_per_page(table,'fbl-processed_pageLength');
    });


</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="kpujWmqR">
    <ul class="page-breadcrumb">
        <li>
            <span>
                {{trans('app.fbl.title')}}
            </span>
            <i class="fa fa-circle"></i>
        </li>
      @if(routeAccess('fbl.index'))
        <li>
            <span>
                {{trans('app.fbl.processed.title')}}
            </span>
        </li>
      @endif
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.fbl.processed.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row" data-name="OSAcxzaL">
    <div class="col-md-12" data-name="ORCSQYny">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="sqNmNrDX">
            <div class="portlet-body" data-name="kPWIWpBL">
                <div class="table-toolbar" data-name="frCRhpXF">
                    <div class="row" data-name="dxpNDjSe">
                        <div class="col-md-6" data-name="brLsBoNB">
                    </div>
                </div>
                <div class="dataTables_wrapper no-footer" data-name="ltyZbaUK">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="fbl-processed" role="grid" >
                        <thead>
                                <th>{{trans('app.fbl.processed.table_headings.sr')}}</th>
                                <th>{{trans('app.fbl.processed.table_headings.email')}}</th>
                                <th>{{trans('app.fbl.processed.table_headings.spammed_time')}}</th>
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