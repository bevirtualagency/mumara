@extends('layouts.master2')

@section('title', trans('app.issues.title'))

@section('page_styles')
<style type="text/css">
    .table {
        border: 1px solid #d9e1e8;
    }
    .table td{
        padding: 1rem;
    }
    table#issues thead th {
        vertical-align: middle;
    }
    table#issues label {
        margin: 0 !important;
        vertical-align: middle;
    }
    table#issues .alert {
        margin: 0;
        padding: 10px 15px;
    }
    table#issues .alert i {
        margin-right: 10px;
        font-size: 1.4rem;
    }
    table#issues tr td:last-child .btn {
        float: right;
        margin-left: 5px;
        font-family: "Open Sans",sans-serif;
        font-size: 12px !important;
        font-weight: 400;
    }
    tr.notify, .notify-success, .notify-retry, .notify-resolve, .notify-danger {
        display: none;
    }
    table#issues tr td:last-child .btn {
        float: right;
        margin-left: 5px;
    }
    table#issues tr td .btn-default i {
        color: #a3adbb;
        font-weight: 500;
        font-size: 1.3rem !important;
    }
    table#issues tr td .btn-default:hover i {
        color: #fff;
    }
    table.dataTable {
        border-top: 0;
    }
    .table thead th {
        border-bottom: 0;
    }
    .kt-user-card-v2 .kt-user-card-v2__details .kt-user-card-v2__name {
        font-weight: 400;
        color: inherit;
    }
    .table-toolbar i.la {
        line-height: 1.4;
    }
    pre {
        margin-bottom: 0;
        min-height: 25px;
    }
    code {
        background-color: #f1f1f1;
        padding: 0.4rem 0.5rem;
        border-radius: 4px;
        color: #333 !important;
        line-height: 1 !important;
    }
    .table th, .table td, .kt-user-card-v2 .kt-user-card-v2__details .kt-user-card-v2__name {
        color: #555 !important;
        font-family: "Open Sans",sans-serif;
        font-size: 14px !important;
    }
    .table-scrollable {
        width: 100%;
        overflow: hidden;
        overflow-x: scroll;
    }
    table#issues thead th:nth-child(3), table#issues tbody tr td:nth-child(3), table#issues thead th:nth-child(4), table#issues tbody tr td:nth-child(4) {
        max-width: 320px;
        white-space: normal;
    }
    span pre:first-child {
        margin-top: 5px;
    }
    #issues tr.one {
        background-color: #F2F2F2;
    }
    .table {
        border-top: 1px solid #DCDCDC !important;
        border-color: #DCDCDC !important;
    }
    .table th, .table td {
        border-top: 1px solid #DCDCDC !important;
        border-color: #DCDCDC !important;
        vertical-align: middle;
    }
</style>
@endsection

@section('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $(".btn-retry").click(function() {
            var btn = $(this);
            var id = $(this).attr("id");
            //console.log($(this).parent("td").parent("tr").next("tr.notify").html();
            btn.parent("td").parent("tr").next("tr.notify").css("display", "table-row");
            btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-retry").show();
                btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-danger").hide();
                btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").hide();
            setTimeout(function(){
                btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-danger").show();
                btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").hide();
                btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-retry").hide();
            }, 3000);
            setTimeout(function(){
                btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-danger").hide();
                btn.parent("td").parent("tr").next("tr.notify").hide();
            }, 5000);
        });
        $(".btn-resolve").click(function() {
            var btn2 = $(this);
            var id = $(this).attr("id");
            // console.log(id);
            //console.log($(this).parent("td").parent("tr").next("tr.notify").html();
            btn2.parent("td").parent("tr").next("tr.notify").css("display", "table-row");
            btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-danger").hide();
            btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").hide();
            btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-retry").show();

            setTimeout(function(){
                btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-retry").hide();
                btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").show();
                btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-resolve").hide();
            }, 3000);
            setTimeout(function(){
                btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-retry").hide();
                btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").hide();
                btn2.parent("td").parent("tr").next("tr.notify").hide();
                $('.r_'+id+" td").css('background-color','#d65252').fadeIn(500);
                $('.r_'+id).fadeOut(1000, function () {
                    $(this).remove();
                    btn2.remove();
                });
            }, 5000);
        });

    });
</script>
@endsection

@section('content')

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="SalyrIHS">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="BmTsPZZD">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="knwVZIaJ">
    <div class="col-md-12" data-name="SifwIQSN">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="VFXcZWiN">
            <div class="kt-portlet__body" data-name="aZrtevyR">
                <div class="table-toolbar" data-name="aszsefEK">
                    <div class="form-group row" data-name="upebRJbE">
                        <div class="col-md-12" data-name="aaRLoHCY">
                            <div class="btn-group pull-right" data-name="ICmrnItX">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('common.form.buttons.tools')}}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="javascript:;" class="kt-font-brand"> <i class="la la-refresh fa-lg"></i> Retry All  </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="kt-font-brand"> <i class="la la-check fa-lg"></i> Resolve All  </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-checkable responsive" id="issues" role="grid" >
                    <thead>
                        <tr role="row">
                            <th>{{trans('app.issues.user')}}</th>
                            <th>{{trans('app.issues.module')}}</th>
                            <th>{{trans('app.issues.details')}}</th>
                            <th>{{trans('app.issues.suggestions')}}</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="r_51 one">
                            <td>
                                <div class="kt-user-card-v2" data-name="nDeCGXHW">
                                    <div class="kt-user-card-v2__details" data-name="WPtZVdRZ">
                                        <span class="kt-user-card-v2__name">System</span>
                                        <span class="kt-user-card-v2__desc kt-link">System</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                PowerMTA
                            </td>
                            <td>
                                <div class="kt-user-card-v2" data-name="beoFwwcc">
                                    <div class="kt-user-card-v2__details" data-name="zmFFNbWM">
                                        <span class="kt-user-card-v2__name">cURL error 60: SSL certificate problem: unable to get local issuer certificate (see https://curl.haxx.se/libcurl/c/libcurl-errors.html)</span>
                                        <span class="kt-user-card-v2__desc kt-link">Last Checked Jan 06, 2020 02:32:54 PM</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="kt-user-card-v2" data-name="ZQXLZHXj">
                                    <div class="kt-user-card-v2__details" data-name="WhhphCCd">
                                        <span class="kt-user-card-v2__name">Lorem Ipsum is simply dummy</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button id="51" type="button" class="btn btn-default btn-sm  btn-retry"><i class="fa fa-retry fa-lg"></i> Mark Retry</button>
                                <button id="51" type="button" class="btn btn-success btn-sm btn-resolve"><i class="fa fa-check fa-lg"></i> Mark Resolved</button>
                            </td>
                        </tr>
                        <tr class="notify one" id="notify_51">
                            <td colspan="5">
                                <div id="success_0" class="alert alert-solid-success alert-bold notify-success" role="alert" data-name="wQkDyoHn">
                                    <div class="alert-text" data-name="TUxazTNx"><i class="fa fa-check fa-lg"></i> Issue has been successfully resolved</div>
                                </div>
                                <div id="process_0" class="alert alert-solid-dark alert-bold notify-retry" role="alert" data-name="iZKqWKoH">
                                    <div class="alert-text" data-name="rFhTRAtO"><i class="la la-spinner fa-lg fa-spin"></i>Verifying...</div>
                                </div>

                                <div id="error_0" class="alert alert-solid-danger alert-bold notify-danger" role="alert" data-name="AtpOdlYo">
                                    <div class="alert-text" data-name="JZIWSSFn"><i class="fa fa-times fa-lg"></i> An error occurred.</div>
                                </div>
                            </td>
                        </tr>
                        <tr class="r_52 one">
                            <td>
                                <div class="kt-user-card-v2" data-name="rXsoJAuZ">
                                    <div class="kt-user-card-v2__details" data-name="VvWcqDOV">
                                        <span class="kt-user-card-v2__name">System</span>
                                        <span class="kt-user-card-v2__desc kt-link">System</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                PowerMTA
                            </td>
                            <td>
                                <div class="kt-user-card-v2" data-name="xINpfBTQ">
                                    <div class="kt-user-card-v2__details" data-name="DqigiFED">
                                        <span class="kt-user-card-v2__name">cURL error 60: SSL certificate problem: unable to get local issuer certificate (see https://curl.haxx.se/libcurl/c/libcurl-errors.html)</span>
                                        <span class="kt-user-card-v2__desc kt-link">Last Checked Jan 06, 2020 02:32:54 PM</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="kt-user-card-v2" data-name="IInHdfmu">
                                    <div class="kt-user-card-v2__details" data-name="EvjpmLQc">
                                        <span class="kt-user-card-v2__name">Lorem Ipsum is simply dummy</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button id="52" type="button" class="btn btn-default btn-sm  btn-retry"><i class="fa fa-retry fa-lg"></i> Mark Retry</button>
                                <button id="52" type="button" class="btn btn-success btn-sm btn-resolve"><i class="fa fa-check fa-lg"></i> Mark Resolved</button>
                            </td>
                        </tr>
                        <tr class="notify one" id="notify_52">
                            <td colspan="5">
                                <div id="success_0" class="alert alert-solid-success alert-bold notify-success" role="alert" data-name="jwVRVDNU">
                                    <div class="alert-text" data-name="oAYRhaCT"><i class="fa fa-check fa-lg"></i> Issue has been successfully resolved</div>
                                </div>
                                <div id="process_0" class="alert alert-solid-dark alert-bold notify-retry" role="alert" data-name="OofqKZJC">
                                    <div class="alert-text" data-name="BDXSyTkh"><i class="la la-spinner fa-lg fa-spin"></i>Verifying...</div>
                                </div>

                                <div id="error_0" class="alert alert-solid-danger alert-bold notify-danger" role="alert" data-name="lFYjoJTF">
                                    <div class="alert-text" data-name="VlMPWkso"><i class="fa fa-times fa-lg"></i> An error occurred.</div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection