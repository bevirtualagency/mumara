<table id="summery" class="table table-striped table-hover table-checkable responsive">
    <tbody>
        <tr>
            <td style="width:40%"> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.label'))}} </td>
            <td style="width:60%">
                <span class="text-muted"> {{ $autoresponder->name }}</span>
            </td>
        </tr>
        <tr>
            <td> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.contact_list'))}} </td>
            <td>
                <span class="text-muted"> {{$list_names}}</span>
            </td>
        </tr>
        <tr>
            <td> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.sending_time'))}} </td>
        @if($meta_data['perform_action_event'] == 'after')
            <td>
                <span class="text-muted"> {{ucfirst($meta_data['perform_action_event']).' '.$meta_data['perform_action_datetime_count'].' '.$meta_data['perform_action_datetime_frequency']}}</span>
            </td>
        @endif
        </tr>
        <tr>
            <td> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.status'))}} </td>
            <td>
                <span class="text-muted"></span>
            </td>
        </tr>
        <tr>
            <td> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.sent_to'))}} </td>
            <td>
                <span class="text-muted">{{$total_sent}}</span>
            </td>
        </tr>
        <tr>
            <td> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.opened'))}} </td>
            <td>
                <span class="text-muted">{{$total_opens}}</span>
            </td>
        </tr>
        <tr>
            <td> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.clicked'))}} </td>
            <td>
                <span class="text-muted">{{$total_clicked}}</span>
            </td>
        </tr>
        <tr>
            <td> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.unsubscribed'))}} </td>
            <td>
                <span class="text-muted">{{$unsubscribed}}</span>
            </td>
        </tr>
        <tr>
            <td> {{trans(trans('app.statistics.autoresponder.detail.view_all.summery.table_headings.bounced'))}} </td>
            <td>
                <span class="text-muted">{{$total_bounced}}</span>
            </td>
        </tr>
    </tbody>
</table>