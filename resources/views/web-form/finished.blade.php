@extends('layouts.master')

@section('title', trans('Web Forms'))

@section('page_styles')
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.table-scrollable .dataTable td>.btn-group, .table-scrollable .dataTable th>.btn-group {
    position: absolute !important;
    margin-top: -10px !important;
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

@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="UhKRMQdh">
    <ul class="page-breadcrumb">
        <li>
            <span><a href="{{ route('dashboard') }}">{{trans('app.breadcrumbs.dashboard')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><a href="javascript:;">{{trans('app.breadcrumbs.setup')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><a href="javascript:;">{{trans('app.breadcrumbs.forms')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.breadcrumbs.webform_completed')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.website_forms.subscription.complete.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="AgLBVwNW">
    {{ Session::get('msg') }}
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger" data-name="FWPJmsgB">
    {{ Session::get('error') }}
</div>
@endif

<div id="msg" class="display-hide" data-name="mGFWfDYp">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="eKSYesuH">
    <div class="col-md-12" data-name="hnPwqgIC">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="mBCAmcPD">
            <div class="portlet-body" data-name="RQSzHhvo">
                <div class="table-toolbar" data-name="ximabsKs">
                    <div class="row" data-name="FFYTnefN">
                        <div class="col-md-12" data-name="qJSIfjYr">
                           <div class="btn-group pull-right" data-name="mKrhJsZW">
                                <button class="btn btn-info">
                                    <a href="{{ route('form.html.download',  $web_form_id) }}" style="color: #ffffff;"> <i class="fa fa-download fa-fw"></i> {{ trans('app.website_forms.subscription.view_all.buttons.download') }}</a>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <textarea class="form-control" rows="20">
                    {!! $html_code !!}
                </textarea>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

@endsection