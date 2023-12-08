@extends(decide_template())

@section('title', trans('contacts.email_history.page.title'))

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/email-history.css?v={{$local_version}}.01">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>

<script> 
$('#triggers').dataTable({
                "bProcessing": false,
                "bServerSide": false,
                "ordering": false,
                "sPaginationType": "full_numbers",
                "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
            });

           $('#campaigns').dataTable({
                "bProcessing": false,
                "bServerSide": false,
                "ordering": false,
                "sPaginationType": "full_numbers",
                "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
            });

</script>

@endsection

@section(decide_content())



<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="sqfQHjBg">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="yzpDLipT">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="owqPWayW">
    <div class="col-md-6" data-name="hdTqyxMl">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="UTGVcAnu">
            <div class="kt-portlet__head" data-name="zwLRMbfE">
                <div class="kt-portlet__head-label" data-name="spavDNJF">
                    <h3 class="kt-portlet__head-title">
                        {{trans('contacts.email_history.subscriber_details')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="VGAHvzFi">
                <table id="summery" class="table table-striped table-hover table-checkable responsive">
                    <tbody>
                        <tr>
                            <td style="width:40%"> {{trans('contacts.add_new.form.email_address')}} </td>
                            <td style="width:60%">
                                <span class="text-muted"> {{isset($subscriber->email) ? $subscriber->email : '' }} </span>
                            </td>
                        </tr>
                        <tr>
                            <td> {{trans('common.label.contact_list')}} </td>
                            <td>
                                <span class="text-muted"> {{isset($subscriber->name) ? $subscriber->name : '' }} </span>
                            </td>
                        </tr>
                        <tr>
                            <td> {{trans('common.label.format')}} </td>
                            <td>
                                <span class="text-muted"> {{isset($subscriber->format) ? strtoupper($subscriber->format) : '' }} </span>
                            </td>
                        </tr>
                        <tr>
                            <td> {{trans('common.label.status')}} </td>
                            <td>
                                <span class="text-muted"> {{$subscriber->is_active == 1 ? 'Active' : 'Inactive'}} </span>
                            </td>
                        </tr>
                        <tr>
                            <td> {{trans('contacts.add_new.form.bounced')}} </td>
                            <td>
                                <span class="text-muted"> {{$subscriber->bounced == 'no_process' ? 'No Process' : ucfirst($subscriber->bounced)}} </span>
                            </td>
                        </tr>
                        <tr>
                            <td> {{trans('common.confirmed')}} </td>
                            <td>
                                <span class="text-muted"> {{$subscriber->is_confirmed == 0 ? trans('common.form.buttons.no') : trans('common.form.buttons.yes')}} </span>
                            </td>
                        </tr>
                        <tr>
                            <td>{{trans('contacts.add_new.form.unsubscribed')}}</td>
                            <td>
                                <span class="text-muted">  {{isset($subscriber->is_unsubscribed) && $subscriber->is_unsubscribed == 1 ? trans('common.form.buttons.yes') : trans('common.form.buttons.no')}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td> {{trans('contacts.email_history.created_at')}} </td>
                            <td>
                                <span class="text-muted"> On {{ showDateTime(Auth::user()->id, $subscriber->created_at, 1)}} </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @if($custom_fields || $default_fields)
<div class="row" data-name="wGonEQTJ">    
    <div class="col-md-6" data-name="bIJcHDSr">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="nYJtOdMN">
            <div class="kt-portlet__head" data-name="ZGdBEcBA">
                <div class="kt-portlet__head-label" data-name="TZSFWDeP">
                    <h3 class="kt-portlet__head-title">
                        {{trans('contacts.detail.modal.contact_info')}} / {{trans('contacts.detail.modal.custom_fields')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="btezJXKL">
                <table id="summery" class="table table-striped table-hover table-checkable responsive">
                    <tbody>
                    @foreach ($custom_fields as $custom_field)
                    @php
                    $name = trim($custom_field->name);
                    $value = trim($custom_field->value);

                    if ($custom_field->custom_field_id == 6) {
                        $value = DB::table('countries')->where('id', $value)->orWhere('country_code', $value)->orWhere('country_name', $value)->value('country_name');
                    }
                    @endphp
                        <tr>
                            <td style="width:40%"> {{$name}} </td>
                            <td style="width:60%">
                                <span class="text-muted"> {{ $custom_field->custom_field_id == 3 ? str_replace(' 00:00:00','',$value):$value }} </span>
                            </td>
                        </tr>
                    @endforeach
                    @foreach ($default_fields as $default_field)
                        <tr>
                            <td style="width:40%"> {{$default_field->name}} </td>
                            <td style="width:60%">
                                <span class="text-muted"> {{ str_replace(' 00:00:00','',$default_field->value) }} </span>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    @endif
    @if(!empty($campaigns) || !empty($triggers))
<div class="row" data-name="WzJhMLTe">    
    <div class="col-md-6" data-name="rSjswxkU">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="gVppWpUN">
            <div class="kt-portlet__head" data-name="WiXdaFIp">
                <div class="kt-portlet__head-label" data-name="vZlGlRZT">
                    <h3 class="kt-portlet__head-title">
                        {{trans('contacts.email_history.event_log')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="NopJaXbn">
                <div class="row" data-name="QEGvGCyF">
                    <div class="col-md-12" data-name="rtOtBiwM">
                    @if(!empty($campaigns))
                        <div class="kt-portlet kt-portlet--height-fluid" data-name="MLHMyzRK">
                            <div class="kt-portlet__head" data-name="jEBdGyIQ">
                                <div class="kt-portlet__head-label" data-name="nJDZxoha">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('contacts.email_history.campaign_table_heading')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body" data-name="MeGuphYq">
                                <table class="table table-striped table-hover table-checkable responsive" id="campaigns" role="grid" >
                                    <thead>
                                        <tr role="row">
                                        <th>{{trans('ID')}}</th>
                                            <th>{{trans('contacts.email_history.event_log_table_heading.name')}}</th>
                                            <th>{{trans('contacts.email_history.event_log_table_heading.sent')}}</th>
                                            <th>{{trans('Date')}}</th>
                                            <th>{{trans('contacts.email_history.event_log_table_heading.bounced')}}</th>
                                            <th>{{trans('contacts.email_history.event_log_table_heading.status')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    @foreach($campaigns as $index => $campaign)
                                    <tr>
                                        <td>{{$campaign->id}}</td>
                                        <td>{{$campaign->name}}</td>
                                        <td>{{$campaign->is_sent == 0 ? trans('common.form.buttons.no') : trans('common.form.buttons.yes')}}</td>
                                        <td>{{date("d M,Y" , strtotime($campaign->created_at))}}</td>
                                        <td>{{$campaign->is_bounced == 0 ? trans('common.form.buttons.no') : trans('common.form.buttons.yes')}}</td>
                                        <td>{{$campaign->status}}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    </div>
                    <div class="col-md-12" data-name="viLYxYfc">
                    @if(!empty($triggers))
                        <div class="kt-portlet kt-portlet--height-fluid" data-name="DyVPCgIB">
                            <div class="kt-portlet__head" data-name="aTGeoBNL">
                                <div class="kt-portlet__head-label" data-name="UOZjAvyv">
                                    <h3 class="kt-portlet__head-title">
                                        {{trans('contacts.email_history.triggers_table_heading')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__body" data-name="mmvkmmgj">
                                <table class="table table-striped table-hover table-checkable responsive" id="triggers" role="grid" >
                                    <thead>
                                        <tr role="row">
                                            <th>{{trans('ID')}}</th>
                                            <th>{{trans('contacts.email_history.event_log_table_heading.name')}}</th>
                                            <th>{{trans('contacts.email_history.event_log_table_heading.sent')}}</th>
                                            <th>{{trans('Date')}}</th>
                                            <th>{{trans('contacts.email_history.event_log_table_heading.bounced')}}</th>
                                            <th>{{trans('contacts.email_history.event_log_table_heading.status')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($triggers as $index => $trigger)
                                        <tr>
                                        <td>{{$trigger->id}}</td>
                                        <td>{{$trigger->name}}</td>
                                        <td>{{$trigger->is_sent == 0 ? trans('common.form.buttons.no') : trans('common.form.buttons.yes')}}</td>
                                        <td>{{date("d M,Y" , strtotime($trigger->created_at))}}</td>
                                        <td>{{$trigger->is_bounced == 0 ? trans('common.form.buttons.no') : trans('common.form.buttons.yes')}}</td>
                                        <td>{{$trigger->status}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endif
    <?php /*  <div class="col-md-12">
        <div class="col-md-8">
        <div class="portlet-body">
            <table id="summery" class="table table-striped table-hover table-checkable responsive">
                <tbody>
                    <tr>
                        <td style="width:40%"> {{trans('app.subscribers.view_all.email_history.fields.email')}} </td>
                        <td style="width:60%">
                            <span class="text-muted"> {{ $subscriber->email }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td> {{trans('app.subscribers.view_all.email_history.fields.unsubscribed')}} </td>
                        <td>
                            <span class="text-muted"> {{isset($subscriber->is_unsubscribe) && $subscriber->is_unsubscribe == 0 ? 'No' : 'Yes'}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td> {{trans('app.subscribers.view_all.email_history.fields.bounced')}} </td>
                        <td>
                            <span class="text-muted"> {{$subscriber->bounced == 'no_process' ? 'No Process' : ucfirst($subscriber->bounced)}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td> {{trans('app.subscribers.view_all.email_history.fields.confirmed')}} </td>
                        <td>
                            <span class="text-muted"> {{$subscriber->is_confirmed == 0 ? 'No' : 'Yes'}} </span>
                        </td>
                    </tr>
                    <tr>
                        <td><a href="#campaigns-list" data-toggle="modal"> {{trans('app.subscribers.view_all.email_history.fields.campaigns.title')}} </a></td>
                        <td>
                            <span class="text-muted"> </span>
                        </td>
                    </tr>
                    <tr>
                        <td> {{trans('app.subscribers.view_all.email_history.fields.created_at')}} </td>
                        <td>
                            <span class="text-muted"> On {{ showDateTime(Auth::user()->id, $subscriber->created_at, 1)}} </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </div> -->
</div>
<!-- <div id="campaigns-list" class="modal" role="dialog" aria-hidden="true">
    <div class="modal-dialog" style="width: 800px;">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h4 class="modal-title">Email Camapings</h4>
        </div>
            <div class="modal-body">
                <table class="table table-striped table-hover table-checkable responsive" id="" role="grid" >
                    <thead>
                        <tr role="row">
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.sr')}}</th>
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.name')}}</th>
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.sent')}}</th>
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.bounced')}}</th>
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.opened')}}</th>
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.open_count')}}</th>
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.clicked')}}</th>
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.click_count')}}</th>
                            <th>{{trans('app.subscribers.view_all.email_history.fields.campaigns.status')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($campaigns as $index => $campaign)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{$campaign->name}}</td>
                        <td>{{$campaign->is_sent == 0 ? 'No' : 'Yes'}}</td>
                        <td>{{$campaign->is_bounced == 0 ? 'No' : 'Yes'}}</td>
                        <td>{{$campaign->is_open == 0 ? 'No' : 'Yes'}}</td>
                        <td>{{$campaign->open_count}}</td>
                        <td>{{$campaign->is_clicked == 0 ? 'No' : 'Yes'}}</td>
                        <td>{{$campaign->clicked_count}}</td>
                        <td>{{$campaign->status}}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div> */ ?>
@endsection