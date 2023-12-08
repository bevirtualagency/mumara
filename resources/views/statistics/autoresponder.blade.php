@extends('layouts.master2')

@section('title', trans('app.sidebar.drip_campaign_stats'))

@section('page_styles')
<style>
    th.dt-center, td.dt-center { text-align: center; }
    .table>thead>tr>th, .table>tbody>tr>td {
        white-space: normal !important;
    }
    .table-scrollable, table.table-bordered.dataTable {
        min-height: auto;
        overflow: visible;
        overflow-x: auto;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).on("load", function() {
        $(".tooltips").tooltip();
    });
    $(document).ready(function() {
        $('body').tooltip({
            selector: '[data-toggle=tooltip]'
        });
        var dripsTable;
        dripsTable = $('#autoresponder-statistics').DataTable({
     //   $('#autoresponder-statistics').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2,3,4,5,6,8], "className": "dt-center"}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[7, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/statistics/getDrips') }}",
            "fnServerParams": function (aoData) {
                aoData.push({"name": "typeFilter", "value": $("#typeFilter").val()});
            },
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]],
        });

        $(".status_filter").change(function () {
            dripsTable.draw();
        });
    });
</script>
@endsection

@section('content')

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="oVmPpwXX">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="jaSqMSkL">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="irfDpotm">
    <div class="col-md-12" data-name="CPugJOhq">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="rDmDDQck">
            <div class="kt-portlet__body" data-name="JuKVBJpp">
                <div class="table-toolbar" data-name="AfhJhxuH">
                    <div class="form-group row" data-name="HJopKSqG">
                        <div class="col-md-12" data-name="LEQJjsZy">
                            <div class="btn-group status_filter" data-name="vUyurBZZ">
                                <select class="form-control" id="typeFilter" name="typeFilter">
                                        <option value="">{{trans('common.label.select_group')}}</option>
                                        @foreach($autoresponderGroups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                </select>
                            </div> 
                        </div>
                    </div> 
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="autoresponder-statistics" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('app.dashboard.lang.sr')}}</th>
                                <th>{{trans('app.dashboard.lang.label')}}</th>
                                <th>{{trans('app.dashboard.lang.sent')}}</th>
                                <th>{{trans('app.dashboard.lang.opened')}}</th>
                                <th>{{trans('app.dashboard.lang.clicked')}}</th>
                                <th>{{trans('app.dashboard.lang.bounced')}}</th>
                                <th>{{trans('app.dashboard.lang.status')}}</th>
                                <th>{{trans('app.dashboard.lang.recent_activity')}}</th>
                            <!--    <th>{{trans('common.label.group')}}</th> -->
                                <th>{{trans('app.dashboard.lang.details')}}</th>
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