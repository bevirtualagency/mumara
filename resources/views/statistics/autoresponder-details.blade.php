@extends('layouts.master2')

@section('title', trans('app.statistics.autoresponder.detail.title'))

@section('page_styles')
<style type="text/css">
    img#loaderImg {
        position:absolute;
        top: 50%;
        left: 50%;
        margin-left: -32px;
        margin-top: -32px;
    }
    .amcharts-chart-div a {
        display: none !important;
    }
    #chartdiv3 {height:300px;}
    .amcharts-pie-slice {
      transform: scale(2);
    }
    .btn-group>.dropdown-menu:after, .dropdown-toggle>.dropdown-menu:after, .dropdown>.dropdown-menu:after {
        left: auto !important;
        right: 7px !important;
    }
    .btn-group>.dropdown-menu:before, .dropdown-toggle>.dropdown-menu:before, .dropdown>.dropdown-menu:before {
        left: auto !important;
        right: 6px !important;
    }
    .btn-rght {
        position: absolute;
        right: 55px;
        top: 16px;
        z-index: 100;
    }
    .btn-rght ul.dropdown-menu:before {
        left: auto !important;
        right: 9px !important;
    }
    .btn-rght ul.dropdown-menu:after {
        left: auto !important;
        right: 10px !important;
    }
    table.dataTable tbody td, .table>tbody>tr>td {
        line-height: 1.5 !important;
    }
    table#opens tbody td, table#unsubscribed tbody td, table#clicked tbody td, table#spintag tbody td, table#complaints tbody td, table#logs tbody td, div#logs_wrapper tbody td, table#bounced tbody td, table#clicks tbody td {
        padding:20px 10px; 
    }
    @media (max-width: 991px) {
        .btn-rght {
            position: absolute;
            top: 40px;
            left: 55px;
        }
        .btn-rght .pull-right {
            float: left !important;
        }
        .tabbable.tabbable-tabdrop {
            margin-top: 30px;
        }
        .btn-rght ul.dropdown-menu {
            left: 0;
            right: auto;
        }
        .btn-rght ul.dropdown-menu:before {
            left: 9px !important;
            right: auto !important;
        }
        .btn-rght ul.dropdown-menu:after {
            left: 10px !important;
            right: auto !important;
        }
    }
    /*.opens_filter {
        margin-bottom: 15px;
    }*/
    .relative {
        position: relative;
    }
    .injected-thunderbird{
        background-color: #607d8b;
        border-color: #607d8b;
        color:#fff;
    }
    .delayed-thunderbird:hover {
        background: #0392bf !important;
        color: #fff;
        border-color: #0392bf !important;
    }
    .delayed-thunderbird{
        background-color: #11c6ff;
        border-color: #11c6ff;
        color:#fff;
    }
    .injected-thunderbird:hover {
        color: #FFF;
        background: #405c69;
        border-color: #405c69;
    }

    .amcharts-balloon-div {
        z-index: 9999;
    }
    .dataTables_wrapper {
        padding: 15px 10px 10px;
    }
    .amcharts-balloon-div {
        z-index: 9999;
    }
    .btn.green:not(.btn-outline) {
        color: #FFF;
        background-color: #32c5d2;
        border-color: #32c5d2;
    }
    .btn.blue:not(.btn-outline) {
        color: #FFF;
        background-color: #3598dc;
        border-color: #3598dc;
    }
    .btn.green:not(.btn-outline) {
        color: #FFF;
        background-color:#008000;
        border-color:#008000;
    }
    .btn.purple:not(.btn-outline) {
        color: #fff;
        background-color: #8E44AD;
        border-color: #8E44AD;
    }
    .btn-warning {
        color: #fff;
        background-color: #FFA500;
        border-color: #FFA500;
    }
    .btn.yellow-casablanca:not(.btn-outline) {
        color: #fff;
        background-color: #f2784b;
        border-color: #f2784b;
    }
    .btn.red-thunderbird:not(.btn-outline) {
        color: #fff;
        background-color: #D91E18;
        border-color: #D91E18;
    }
    .btn.red:not(.btn-outline) {
        color: #fff;
        background-color: #D91E18;
        border-color: #D91E18;
    }
    .delayed-thunderbird {
        background-color: #11c6ff !important;
        border-color: #11c6ff !important;
        color: #fff !important;
    }
    .injected-thunderbird {
        background-color: #607d8b !important;
        border-color: #607d8b !important;
        color: #fff !important;
    }
    .delayed-thunderbird:hover {
        background: #0392bf !important;
        color: #fff !important;
        border-color: #0392bf !important;
    }
    .injected-thunderbird:hover {
        color: #FFF !important;
        background: #405c69 !important;
        border-color: #405c69 !important;
    }
    i.btn {
        cursor: pointer;
    }
    table#summery tr td:first-child {
        font-weight: 600;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<!-- load data after page content -->
<script type="text/javascript">
    $(document).ready(function() {
        $(".m-select2").select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
    });
    $(window).on("load",function () {
        setTimeout(function () {
        google.charts.load('current', {'packages': ['geochart']});
        google.charts.setOnLoadCallback(drawRegionsMap);
        drawOpenChart();
    }, 1000);
});
</script>
<script>
    function loadOpens() {
        $('#opens').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3,4,5,6,7]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/drips/opens/{{$autoresponder_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadclicked() {
        $('#clicks').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3,4,5,6,7,8]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/drips/clicks/{{$autoresponder_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadUnsubscribed() {
        $('#unsubscribed').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/drips/unsubscribed/{{$autoresponder_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadBounced(){
        $('#bounced').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/drips/bounced/{{$autoresponder_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadComplaints(){
        $('#complaints').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/drips/complaints/{{$autoresponder_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadLogs(){
        $('#logs').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": []}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[6, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/drips/logs/{{$autoresponder_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
</script>

@endsection

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="SAYEkhfl">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="wAoLvIlv">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="KThsvlLt">
    <div class="col-md-12" data-name="clIXSlZl">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="tnYNjYhB">
            <div class="kt-portlet__head" data-name="dnoJOzYH">
                <div class="kt-portlet__head-label" data-name="lRVlKeQb">
                    <h3 class="kt-portlet__head-title">{{ trans('app.statistics.autoresponder.view_all.title') }}</h3>
                </div>
                <div class="kt-portlet__head-toolbar" data-name="SJerqvHN">
                    <a href="{{ route('statistics.drips.summary.zip', $autoresponder_id) }}">
                        <button class="btn btn-label-info btn-sm btn-bold" data-toggle="dropdown" aria-expanded="false"> {{ trans('app.statistics.autoresponder.view_all.export_reports') }} </button>
                    </a>                        
                </div>
            </div>
            <?php $openStats = routeAccess('statistics.broadcasts.opens');
            $clickStats = routeAccess('statistics.broadcasts.clicked');
            $unsubStats = routeAccess('statistics.broadcasts.unsubscribed');
          $bounceStats = routeAccess('statistics.broadcasts.bounced');
            $complaintStats = routeAccess('statistics.broadcasts.complaints');
            ?>
            <div class="kt-portlet__body" data-name="XUJNNICe"> 
                
                <div class="tabbable tabbable-tabdrop" data-name="wnMDouaz">
                    <ul class="nav nav-tabs" role="tablist">

                        <li class="nav-item">
                            <a href="#tab1" class="nav-link active" data-toggle="tab" role="tab">{{trans('app.statistics.autoresponder.detail.view_all.summery.title')}}</a>
                        </li>

                      @if($openStats)
                        <li class="nav-item">
                            <a href="#tab2" onclick="loadOpens();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.autoresponder.detail.view_all.opens.title')}}</a>
                        </li>
                      @endif
                      @if($clickStats)
                        <li class="nav-item">
                            <a href="#tab3" onclick="loadclicked();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.autoresponder.detail.view_all.clicked.title')}}</a>
                        </li>
                      @endif
                      @if($unsubStats)
                        <li class="nav-item">
                            <a href="#tab4" onclick="loadUnsubscribed();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.autoresponder.detail.view_all.unsubscribed.title')}}</a>
                        </li>
                      @endif
                     @if($bounceStats)
                        <li class="nav-item">
                            <a href="#tab5" onclick="loadBounced();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.autoresponder.detail.view_all.bounced.title')}}</a>
                        </li>
                      @endif
                     @if($complaintStats)
                        <li class="nav-item">
                            <a href="#tab6" onclick="loadComplaints();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.autoresponder.detail.view_all.complaints.title')}}</a>
                        </li>
                      @endif
                        <li class="nav-item">
                            <a href="#tab7" onclick="loadLogs();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.autoresponder.detail.view_all.logs.title')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" data-name="mfSEtzHR">
                        <div class="tab-pane active" id="tab1" data-name="EFxAxNun">
                            <div class="form-group row" data-name="bFSdJHLP">
                                <div class="col-md-6" data-name="yVTUGaPb">
                                    <table id="summery" class="table table-striped table-hover table-checkable responsive">
                                        <tbody>
                                            <tr>
                                                <td style="width:40%"> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.label')}} </td>
                                                <td style="width:60%">
                                                    <span class=""> {{ $autoresponder->name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:40%"> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.sent_by')}} </td>
                                                <td style="width:60%">
                                                    <span class=""> {{ $user_name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.group')}} </td>
                                                <td>
                                                    <span class=""> {{ $autoresponder->drip_group_name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.sending_node')}} </td>
                                                <td>
                                                    <span class=""> {{ $smtp_name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.time_start')}} </td>
                                                <td>
                                                    <span class=""> 
                                                        {{ isset($drip_starting_time_final) ? Carbon\Carbon::parse($drip_starting_time_final)->format('M d, Y h:i:s A') : '---'}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.last_activity')}} </td>
                                                <td>
                                                    <span class=""> 
                                                        {{ isset($drip_finishing_time_final) ? Carbon\Carbon::parse($drip_finishing_time_final)->format('M d, Y h:i:s A') : '---'}}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.duration')}} </td>
                                                <td>
                                                    <span class=""> 
                                                        @php
                                                            $start_date = Carbon\Carbon::parse($drip_starting_time_final);
                                                            $end_date = Carbon\Carbon::parse($drip_finishing_time_final);
                                                            $days = $start_date->diffInDays($end_date);
                                                            $hours = $start_date->copy()->addDays($days)->diffInHours($end_date);
                                                            $minutes = $start_date->copy()->addDays($days)->addHours($hours)->diffInMinutes($end_date);
                                                            $seconds = $start_date->copy()->addDays($days)->addHours($hours)->addMinutes($minutes)->diffInSeconds($end_date); 
                                                        @endphp

                                                        @if($days != 0)    
                                                            {{ $days . ' days' }}
                                                        @endif
                                                        @if($hours != 0)
                                                            {{ $hours . ' hours' }}
                                                        @endif
                                                        @if($minutes != 0)
                                                            {{ $minutes . ' minutes ' }}
                                                        @endif
                                                        @if($seconds != 0)    
                                                            {{ $seconds . ' seconds' }}
                                                        @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.sent')}} </td>
                                                <td>
                                                    <span class="">{{$total_sent}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.opened')}} </td>
                                                <td>
                                                    <span class="" title="{{trans('statistics.autoresponder_details_blade.tittle_open_unique_total')}}">
                                                        {{ $total_unique_opens }} / {{$total_opens }}
                                                        {{ ($total_unique_opens) ? "(".round(($total_unique_opens * 100) / $total_sent, 2) ." % )" : "(0  % )" }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.clicked')}} </td>
                                                <td>
                                                    <span class="" title="{{trans('statistics.autoresponder_details_blade.tittle_clicked_unique_total')}}"> {{ $total_unique_clicked }} / {{ $total_clicked }} 
                                                    {{ $total_unique_clicked ? "(".round(($total_unique_clicked * 100) / $total_sent, 2) ." % )" : "(0  % )" }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.ctr')}} </td>
                                                <td>
                                                    <span class="" title="{{trans('statistics.autoresponder_details_blade.tittle_clicked_unique_total')}}"> 
                                                        {{ $total_unique_clicked ? round(($total_unique_clicked/$total_unique_opens) * 100, 2) . " % " : "0  % " }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.bounced')}} </td>
                                                <td>
                                                    <span class="">{{$total_bounced}} 
                                                    {{ $total_bounced ? "(".round(($total_bounced * 100) / $total_sent, 2) ." % )" : "(0  % )" }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.unsubscribed')}} </td>
                                                <td>
                                                    <span class="">{{$unsubscribed}}
                                                    {{ $unsubscribed ? "(".round(($unsubscribed * 100) / $total_sent, 2) ." % )" : "(0  % )" }}    
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.scheduled_by')}} </td>
                                                <td>
                                                    <span class="">{{ $user_email }} On {{ showDateTime($autoresponder->user_id, $autoresponder->created_at, 1)}} </span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 por" data-name="HEqmnRrv">
                                     <div class="kt-portlet kt-portlet--bordered" data-name="CFwFZYxB">
                                        <div class="kt-portlet__head" data-name="kZatjutG">
                                            <div class="kt-portlet__head-label" data-name="KqsIZJkj">
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('app.statistics.autoresponder.detail.view_all.summery.open_stats_title')}}
                                                </h3>
                                            </div>
                                        </div>
                                        <input type="hidden" id="email-opened" value="{{$total_opens}}" />
                                        <input type="hidden" id="email-clicked" value="{{$total_clicked}}" />
                                        <input type="hidden" id="email-bounced" value="{{$total_bounced}}" />
                                        <input type="hidden" id="email-unopend" value="{{(int)$total_sent - (int)$total_opens}}" />
                                        <div class="kt-portlet__body relative" data-name="ektwjeLb">
                                            <!-- Resources -->
                                            <script src="/themes/default/js/graphs/jquery.min.js"></script>
                                            <script src="/themes/default/js/graphs/amcharts.js"></script>
                                            <script src="/themes/default/js/graphs/pie.js"></script>
                                            <script src="/themes/default/js/graphs/light.js"></script>

                                            <!-- Chart code -->
                                            <script>
                                            function drawOpenChart() {
                                                var chart3 = AmCharts.makeChart( "chartdiv3", {
                                                  "type": "pie",
                                                  "theme": "light",
                                                  "dataProvider": [ {
                                                    "country": "Opened",
                                                    "color": "#1CAF9A",
                                                    "value": +$('#email-opened').val(),
                                                  }, {
                                                    "country": "Clicked",
                                                    "color": "#7E0B80",
                                                    "value": +$('#email-clicked').val(),
                                                  }, {
                                                    "country": "Bounced",
                                                    "color": "#FF0000",
                                                    "value": +$('#email-bounced').val(),
                                                  }, {
                                                    "country": "Unopened",
                                                    "color": "#FF8000",
                                                    "value": +$('#email-unopend').val(),
                                                  }],
                                                      "valueField": "value",
                                                      "titleField": "country",
                                                      "startEffect": "elastic",
                                                      "colorField": "color",
                                                      "startDuration": 2,
                                                      "labelRadius": 15,
                                                      "innerRadius": "50%",
                                                      "outlineAlpha": 0.1,
                                                      "depth3D": 10,
                                                      "angle": 15,
                                                       "balloon":{
                                                       "fixedPosition":true
                                                      },
                                                      "export": {
                                                        "enabled": true
                                                      }
                                                });
                                            }
                                            </script>
                                            <div id="chartdiv3" data-name="GpEHwTir"> <img id="loaderImg" class="opensChart" src="\resources\assets\images\loader.gif"></div>
                                        </div>
                                    </div>
                                    <div class="kt-portlet kt-portlet--bordered" data-name="pjKuaSer">
                                        <div class="kt-portlet__head" data-name="roFNFyTV">
                                            <div class="kt-portlet__head-label" data-name="KPENSVcB">
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('app.statistics.autoresponder.detail.view_all.summery.send_stats_title')}}
                                                </h3>
                                            </div>
                                        </div>
                                        <div class="kt-portlet__body relative" data-name="ieiqJWEp">
                                            <script type="text/javascript" src="/themes/default/js/graphs/loader.js"></script>
                                            <script type="text/javascript">
                                                function drawRegionsMap() {
                                                    var jsonData = $.ajax({
                                                        url: app_url+"/drip-chart/"+{{$autoresponder->id}},
                                                        dataType: "json",
                                                        async: false
                                                    }).responseText;
                                                    var newData = JSON.parse(jsonData);
                                                    var data = google.visualization.arrayToDataTable(newData);
                                                    var options = {
                                                        //Put your colour hex code here
                                                        colors: ['#1CAF9A']
                                                    };
                                                    var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));

                                                    chart.draw(data, options);
                                                }
                                            </script>
                                            <div id="regions_div" style="width: 100%; height: 300px;" data-name="IqqpHKnZ"><img id="loaderImg" class="opensChart" src="\resources\assets\images\loader.gif"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                      @if($openStats)
                        <div class="tab-pane" id="tab2" data-name="mEDpQult">
                            <table class="table table-striped table-hover table-checkable responsive" id="opens" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.opens.table_headings.sr'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.opens.table_headings.email'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.opens.table_headings.open_time'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.opens.table_headings.open_ip'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.opens.table_headings.city'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.opens.table_headings.region'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.opens.table_headings.country'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.opens.table_headings.post_code'))}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                      @endif
                      @if($clickStats)
                        <div class="tab-pane" id="tab3" data-name="ZsJOYNqG">
                            <table class="table table-striped table-hover table-checkable responsive" id="clicks" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.sr'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.email'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.click_time'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.click_ip'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.link'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.city'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.region'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.country'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.clicked.table_headings.post_code'))}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                      @endif
                      @if($unsubStats)
                      <div class="tab-pane" id="tab4" data-name="ZkMLcgEw">
                            <table class="table table-striped table-hover table-checkable responsive" id="unsubscribed" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.unsubscribed.table_headings.sr'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.unsubscribed.table_headings.email'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.unsubscribed.table_headings.unsubscribed_time'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.unsubscribed.table_headings.click_ip'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.unsubscribed.table_headings.city'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.unsubscribed.table_headings.region'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.unsubscribed.table_headings.zip'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.unsubscribed.table_headings.country'))}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @if($bounceStats)
                        <div class="tab-pane" id="tab5" data-name="GqSmJwJu">
                            <table class="table table-striped table-hover table-checkable responsive" id="bounced" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.bounced.table_headings.sr'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.bounced.table_headings.email'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.bounced.table_headings.bounce_type'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.bounced.table_headings.bounce_code'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.bounced.table_headings.bounce_reason'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.bounced.table_headings.sending_node'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.bounced.table_headings.message'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.bounced.table_headings.bounce_type'))}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @if($complaintStats)
                        <div class="tab-pane" id="tab6" data-name="zSonVaib">
                            <table class="table table-striped table-hover table-checkable responsive" id="complaints" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.complaints.table_headings.sr'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.complaints.table_headings.email'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.complaints.table_headings.complaint_time'))}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @endif
                        <div class="tab-pane" id="tab7" data-name="YnBETcrm">
                            <i class='btn btn-xs btn-default green'>{{ trans('app.dashboard.lang.opened') }}</i> &nbsp;&nbsp;
                            <i class='btn btn-xs btn-default purple'>{{ trans('app.dashboard.lang.clicked') }}</i>&nbsp;&nbsp;
                            <i class='btn btn-xs btn-warning'>{{ trans('app.dashboard.lang.unsubscribed') }}</i>&nbsp;&nbsp;
                            <i class='btn btn-xs btn-default red'>{{ trans('app.dashboard.lang.failed') }}</i>&nbsp;&nbsp;
                            <br><br>
                            <table class="table table-striped table-hover table-checkable responsive" id="logs" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.logs.table_headings.sr'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.logs.table_headings.email'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.logs.table_headings.activity'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.logs.table_headings.status'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.logs.table_headings.sending_node'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.logs.table_headings.message'))}}</th>
                                        <th>{{trans(trans('app.statistics.autoresponder.detail.view_all.logs.table_headings.created_at'))}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection