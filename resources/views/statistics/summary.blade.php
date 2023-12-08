<table id="summery" class="table table-bordered table-striped">
    <tr>
        <td style="width:40%"> {{trans('statistics.detail.username')}} </td>
        <td style="width:60%">
            <span class="text-muted"> {{ Auth::user()->id }} ({{ Auth::user()->email }}, {{ Auth::user()->id }}</span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.label.name')}} </td>
        <td>
            <span class="text-muted"> {{ $campaign->name }}  </span>
        </td>
    </tr>
    @if(!empty($list_names))
    <tr>
        <td>{{trans('common.label.contact_lists')}}</td>
        <td>
            <span class=""> {{ $list_names }}  </span>
        </td>
    </tr>
    @endif
    @if(!empty($segment_names))
    <tr>
        <td>{{trans('common.label.segments')}}</td>
        <td>
            <span class=""> {{ $segment_names  }}  </span>
        </td>
    </tr>
    @endif
    <tr>
        <td>{{trans('common.label.campaigns')}}</td>
        <td>
            <span class="text-muted"> {{ $campaign_names }} </span>
        </td>
    </tr>
    <tr>
        <td>{{trans('statistics.detail.sending_nodes')}}</td>
        <td>
            <span class="text-muted"> {{ $smtp_names }}  </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('statistics.detail.sending_time')}} </td>
        <td>
            <span class="text-muted"> {{ showDateTime(Auth::user()->id, $campaign->send_datetime)}} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('statistics.detail.finished_time')}} </td>
        <td>
            <span class="text-muted"> {{ showDateTime(Auth::user()->id, $campaign->updated_at)}} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.label.status')}} </td>
        <td>
            <span class="text-muted"> {{ $campaign->status }} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('statistics.detail.total_contacts')}} </td>
        <td>
            <span class="text-muted"> {{$total_emails}} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.stats.sent')}} </td>
        <td>
            <span class="text-muted"> {{$campaign_sent}} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.stats.opened')}} </td>
        <td>
            <span class="text-muted">{{ $opened }}</span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.stats.clicked')}} </td>
        <td>
            <span class="text-muted"> {{ $clicked }}  </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.stats.unsubscribed')}} </td>
        <td>
            <span class="text-muted"> {{$unsubscribed}}  </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.stats.bounced')}} </td>
        <td>
            <span class="text-muted"> {{$campaign_bounced}} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('statistics.detail.threads')}} </td>
        <td>
            <span class="text-muted"> {{ $campaign->thread_settings }} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.label.track_opens')}} </td>
        <td>
            <span class="text-muted"> {{$campaign->track_opens == 1 ? 'Yes' : 'No'}} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('common.label.track_clicks')}} </td>
        <td>
            <span class="text-muted"> {{$campaign->track_clicks == 1 ? 'Yes' : 'No'}} </span>
        </td>
    </tr>
    <tr>
        <td> {{trans('statistics.detail.sender_info')}} </td>
        <td>
            <span class="text-muted">{{trans('statistics.detail.From_SMTP')}}</span>
        </td>
    </tr>
    <tr>
        <td> {{trans('statistics.detail.scheduled_by')}} </td>
        <td>
            <span class="text-muted"> On {{ showDateTime(Auth::user()->id, $campaign->created_at)}} </span>
        </td>
    </tr>
</table>