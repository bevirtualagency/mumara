@extends(decide_template())
@section('title', trans('logs.logs_campaign_blade.campaign_schedule_blade_title'))

@section('page_styles')
<link href="/assets/global/plugins/datatables/datatables.min.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<style type="text/css">
    @media(max-width: 1600px) {
        .table-scrollable, table.table-bordered.dataTable {
            min-height: auto!important;
            overflow: visible!important;
            overflow-x: auto!important;
            overflow-y: visible!important;
        }
        .table-scrollable .dataTable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
            position: relative!important;
            margin-top: 0px!important;
        }
    }
    div#navbarNav {
        position: absolute;
        line-height: 1;
        left: 130px;
        padding-top: 0px;
        font-size: 14px;
    }
    #navbarNav ul.navbar-nav.mr-auto {
        width: 100%;
        display: block;
    }
    #navbarNav ul li.nav-item {
        position: relative;
        float: left;
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
        $('#spintag').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": []}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[3, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getCampaignLogs') }}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    });
</script>
@endsection

@section(decide_content())
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="RDhNfkIg">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('logs.logs_campaign_blade.logs_txt_span')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.campaigns.logs.title')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.campaigns.logs.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="PZuIzadO">
    <p>
        {{trans('app.campaigns.logs.description')}} 
    </p>
</div>
<div class="row" data-name="btOPalLe">
    <div class="col-md-12" data-name="nepbhjXL">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="uypFGbWs">
            <div class="portlet-body" data-name="EOokdKbq">
                <div class="table-scrollable" data-name="RsAxtdSo">
                    <table class="table table-striped table-bordered table-hover" id="spintag" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('app.campaigns.logs.table_headings.id')}}</th>
                                <th>{{trans('app.campaigns.logs.table_headings.email')}}</th>
                                <th>{{trans('app.campaigns.logs.table_headings.message_id')}}</th>
                                <th>{{trans('app.campaigns.logs.table_headings.created_at')}}</th>
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