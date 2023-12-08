<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1"> 
    <li><a href="{{ route('statistics.broadcasts.download.pdf', $campaign_schedule_id) }}">
            {{trans('statistics.detail.export_options.overview_pdf')}}
        </a></li>
    <li><a data-toggle="modal" class="btn-load-data-customer" id="dbopened" data="{{ route('statistics.broadcasts.opened.csv', $campaign_schedule_id) }}">
            {{trans('statistics.detail.export_options.opened_csv')}}
        </a></li> 
    <li><a data-toggle="modal" class="btn-load-data-customer"id="dbclicked" data="{{ route('statistics.broadcasts.clicked.csv', $campaign_schedule_id) }}">
            {{trans('statistics.detail.export_options.clicked_csv')}}
        </a></li> 
    <li><a data-toggle="modal" class="btn-load-data-customer" id="dbunsub"  data="{{ route('statistics.broadcasts.unsubscribe.csv',  $campaign_schedule_id) }}">
            {{trans('statistics.detail.export_options.unsubscribed_csv')}}
        </a></li> 
    <li><a data-toggle="modal" class="btn-load-data-customer" id="dbound" data="{{ route('statistics.broadcasts.bounced.csv',  $campaign_schedule_id) }}">
            {{trans('statistics.detail.export_options.bounced_csv')}}
        </a></li> 
    <li><a data-toggle="modal" class="btn-load-data-customer" id="complene" data="{{ route('statistics.broadcasts.complaints.csv',  $campaign_schedule_id) }}">
            {{trans('statistics.detail.export_options.complaints_csv')}}
        </a></li>
    <li><a data-toggle="modal" class="btn-load-data-customer" id="elb" data="{{ route('statistics.broadcasts.logs.csv', $campaign_schedule_id) }}">
            {{trans('statistics.detail.export_options.logs_csv')}}
        </a></li>
    <li role="separator" class="divider"></li>
    <li><a data-toggle="modal" id="dbexportall" class="btn-load-data-customer" data="{{ route('statistics.broadcasts.summary.zip',  $campaign_schedule_id) }}">
            {{trans('statistics.detail.export_options.export_all')}}
        </a></li>
</ul>