@extends('layouts.master2')

@section('title', trans('app.statistics.trigger.detail.title'))

@section('page_styles')
<link href="/resources/assets/css/trigger-statistics-detail.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="//www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Status', 'Counter'],
      ['Opened',     +$('#opened').val()],
      ['Unopened',   +$('#clicked').val()],
      ['Bounced',    +$('#bounced').val()]
    ]);

    var options = {
      title: '',
      fontName: 'Open Sans',
      chartArea:{left:0,top:20,width:'100%',height:'80%'},
      legend: {position: 'right', textStyle: {color: 'blue', fontSize: 10}},
      
       slices: {
            0: { color: 'green' , offset: 0.1 },
            1: { color: 'orange'  , offset: 0.1 },
            2: { color: '#990000'  , offset: 0.1 }
          }
    };

    var chart = new google.visualization.PieChart(document.getElementById('summary-chart'));

    chart.draw(data, options);
  }
</script>
<script>
    function loadOpens() {
        $('#opens').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2,3,4,5,6,7]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/triggers/detail/opens/{{$trigger_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadclicked() {
        $('#clicks').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2,3,4,5,6,7,8]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/triggers/detail/clicks/{{$trigger_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadUnsubscribed() {
        $('#unsubscribed').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/triggers/detail/unsubscribed/{{$trigger_id}}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
</script>
@endsection
@section('content')

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="muIHMhir">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="UCnSCSqK">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="kBiQlGks">
    <div class="col-md-12" data-name="xntpwNCj">
     @php($openStats = routeAccess('triggerOpens'))
            @php($clickStats = routeAccess('triggerClicks'))
            @php($unsubStats = routeAccess('triggerUnsubscribed'))
      
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="MwSeNMTb">
            <div class="kt-portlet__head" data-name="anEciFPv">
                <div class="kt-portlet__head-label" data-name="fAdiqlHq">
                    <h3 class="kt-portlet__head-title">{{ trans('app.sidebar.trigger_stats') }}</h3>
                </div>
                @if(routeAccess('statistics.triggers.summary.zip'))
                <div class="kt-portlet__head-toolbar" data-name="iBgNEUZl">
                    <a href="{{ route('statistics.triggers.summary.zip',  $trigger_id) }}">
                        <button class="btn btn-label-info btn-sm btn-bold" data-toggle="dropdown" aria-expanded="false"> {{ trans('app.statistics.export_report') }} </button>
                    </a>
                </div>
                @endif
            </div>
            <div class="kt-portlet__body" data-name="GkgKvabA">
                <div class="tabbable tabbable-tabdrop" data-name="MqIYCgjC">
                    <ul class="nav nav-tabs" role="tablist">

                        <li class="nav-item">
                            <a href="#tab1" class="nav-link active" data-toggle="tab" role="tab">{{trans('app.statistics.trigger.detail.view_all.summery.title')}}</a>
                        </li>
                   
                      @if($openStats)
                        <li class="nav-item">
                            <a href="#tab2" onclick="loadOpens();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.trigger.detail.view_all.opens.title')}}</a>
                        </li>
                      @endif
                      @if($clickStats)
                        <li class="nav-item">
                            <a href="#tab3" onclick="loadclicked();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.trigger.detail.view_all.clicked.title')}}</a>
                        </li>
                      @endif
                      @if($unsubStats )
                        <li class="nav-item">
                            <a href="#tab4" onclick="loadUnsubscribed();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.trigger.detail.view_all.unsubscribed.title')}}</a>
                        </li>
                      @endif
                    </ul>
                    <div class="tab-content" data-name="aLddukPa">
                        <div class="tab-pane active" id="tab1" data-name="EsMAILGu">
                            <div class="form-group row" data-name="LDlirARb">
                                <div class="col-md-6" data-name="YnQIIqqW">
                                    <table id="summery" class="table table-striped table-hover table-checkable responsive">
                                        <tbody>
                                            <tr>
                                                <td style="width:40%"> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.trigger_label')}} </td>
                                                <td style="width:60%">
                                                    <span class="text-muted"> {{ $trigger->name }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.trigger_type')}} </td>
                                                <td>
                                                    <span class="text-muted"> {{ucwords(str_replace("_", " ", $trigger->type))}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.sending_time')}} </td>
                                            @if($meta_data['perform_action_event'] == 'after')
                                                <td>
                                                    <span class="text-muted"> {{ucfirst($meta_data['perform_action_event']).' '.$meta_data['perform_action_datetime_count'].' '.$meta_data['perform_action_datetime_frequency']}}</span>
                                                </td>
                                            @else
                                                <td>
                                                    <span class="text-muted"> {{ucwords(str_replace("_", " ", $meta_data['perform_action_interval']))}}</span>
                                                </td>
                                            @endif
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.status')}} </td>
                                                <td>
                                                    <span class="text-muted"></span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.sent_to')}} </td>
                                                <td>
                                                    <span class="text-muted">{{$total_sent}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.opened')}} </td>
                                                <td>
                                                    <span class="text-muted">{{$total_opens}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.clicked')}} </td>
                                                <td>
                                                    <span class="text-muted">{{$total_clicked}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.unsubscribed')}} </td>
                                                <td>
                                                    <span class="text-muted">{{$unsubscribed}}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('app.statistics.trigger.detail.view_all.summery.table_headings.bounced')}} </td>
                                                <td>
                                                    <span class="text-muted">{{$total_bounced}}</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-6 por" data-name="TXGuClGK">
                                    <div class="kt-portlet kt-portlet--bordered" data-name="utKRzvlI">
                                        <div class="kt-portlet__head" data-name="BoLiETMf">
                                            <div class="kt-portlet__head-label" data-name="xBVrQGam">
                                                <h3 class="kt-portlet__head-title">
                                                    {{trans('app.statistics.trigger.detail.view_all.summery.send_stat_title')}}
                                                </h3>
                                            </div>
                                        </div>
                                        <input type="hidden" id="opened" value="{{$total_opens}}" />
                                        <input type="hidden" id="clicked" value="{{$total_clicked}}" />
                                        <input type="hidden" id="bounced" value="{{$total_bounced}}" />
                                        <div class="kt-portlet__body relative" data-name="vIzjypua">
                                            <div id="summary-chart" style="height:300px;" data-name="pSLkIdAc"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
     
                      @if($openStats)
                        <div class="tab-pane" id="tab2" data-name="EepPBXlq">
                            <table class="table table-striped table-hover table-checkable responsive" id="opens" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans('app.statistics.trigger.detail.view_all.opens.table_headings.sr')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.opens.table_headings.email')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.opens.table_headings.open_time')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.opens.table_headings.open_ip')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.opens.table_headings.city')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.opens.table_headings.region')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.opens.table_headings.country')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.opens.table_headings.post_code')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                      @endif
                      @if($clickStats)
                        <div class="tab-pane" id="tab3" data-name="ReLjGUYt">
                            <table class="table table-striped table-hover table-checkable responsive" id="clicks" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.sr')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.email')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.click_time')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.click_ip')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.link')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.city')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.region')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.country')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.clicked.table_headings.post_code')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                      @endif
                       @if($unsubStats)
                      <div class="tab-pane" id="tab4" data-name="rTPayQVp">
                            <table class="table table-striped table-hover table-checkable responsive" id="unsubscribed" role="grid" >
                                <thead>
                                    <tr role="row">
                                        <th>{{trans('app.statistics.trigger.detail.view_all.unsubscribed.table_headings.sr')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.unsubscribed.table_headings.email')}}</th>
                                        <th>{{trans('app.statistics.trigger.detail.view_all.unsubscribed.table_headings.unsubscribed_time')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection