@extends('layouts.master2')

@section('title', trans('segments.view_segment.page.title'))

@section('page_styles')
<!-- page styles -->
<style type="text/css">
    .caption-subject {
        font-size: 1.2rem;
        font-weight: 500;
        color: #464457;
        width: 100%;
        border-bottom: 1px dashed #ddd;
        padding-bottom: 1rem;
    }
    .form-group .col-md-9 label {
        text-align: left;
        white-space: normal;
        word-break: break-word;
    }
</style>
@endsection

@section('page_scripts')
<!-- page script -->
@endsection

@section('content')

@if($errors->any())
<!-- For PHP validations errors-->
<div class="alert alert-danger" data-name="venalLZt">
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="rVUpxKXe">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="ypjBaqlj">
    <span id='msg-text'><span>
</div>
<!-- view segment -->
<div class="row" data-name="BEAJdSzL">
    <div class="col-md-12" data-name="fMCpbjpq">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="SspHCWZa">
            <div class="kt-portlet__body" data-name="rHyEZoUi">
                @if($segmentCriteria['segment_type']==0)
                    <div class="form-group row" data-name="EKpoubRD">
                        <span class="col-md-12 caption-subject">{{ trans('segments.view_segment.filter_by_list') }}</span>
                    </div>
                    <div class="form-group row" data-name="JRUtzyWb">
                        <label class="control-label col-md-3">{{ trans('segments.view_segment.select_list') }}</label>
                        <div class="col-md-9" data-name="eYNRQIEb">
                            <label class="control-label pull-right">@php
                                if($segmentCriteria['segment_list']=='global'){
                                    echo trans('segments.view_segment.any_contact_list');
                                }else if($segmentCriteria['segment_list']=='custom'){
                                    echo trans('segments.view_segment.contact_list');
                                }else if($segmentCriteria['segment_list']=='groups'){
                                    echo trans('segments.view_segment.groups');
                                }else{
                                    echo trans('segments.view_segment.custom_criteria');
                                }
                            @endphp
                            </label>
                        </div>
                    </div>
               
                @if($segmentCriteria['segment_list']=='custom')
                    <div class="form-group row" data-name="wHvBBqrn">
                        <label class="control-label col-md-3">{{ trans('segments.view_segment.contact_list') }}</label>
                        @if(!empty($segmentCriteria['subscriber_lists']))
                        <div class="col-md-9" data-name="lDHzdvrZ">
                            <label class="control-label pull-right">{!! \App\Helpers\Common::getListNamesByIds($segmentCriteria['subscriber_lists']) !!}</label>
                        </div>
                        @endif
                    </div>    
                
                @elseif($segmentCriteria['segment_list']=='groups')
                    <div class="form-group row" data-name="OEGtobYe">
                    <label class="control-label col-md-3">{{ trans('segments.view_segment.groups') }}</label>
                    <div class="col-md-9" data-name="xlVxbCVP">
                        <label class="control-label pull-right">{{ \App\Helpers\Common::getGroupsNamesByIds($segmentCriteria['list_group']) }}</label>
                    </div>
                </div>    
                @elseif($segmentCriteria['segment_list']=='criteria')
                    <div class="form-group row" data-name="aqGMvbVy">
                    <label class="control-label col-md-5">{{ ($segmentCriteria['list_group_name']==1) ? trans('segments.view_segment.list_name'):trans('segments.view_segment.list_group') }}</label>
                    <div class="col-md-2" data-name="lKtzUbyc">
                        <label class="control-label">{{ $segmentCriteria['list_group_condition'] }}</label>
                    </div>
                    <div class="col-md-5" data-name="OXFQigjm">
                        <label class="control-label pull-right">{{ $segmentCriteria['list_group_value'] }}</label>
                    </div>
                </div>
                @endif
                
                @if(array_key_exists("custom_fields_filter", $segmentCriteria)) 
                    @php $i = 0; @endphp
                
                    @foreach($segmentCriteria['custom_fields_filter']  as $customFieldsFilterRow)
                        @php

                            $custom_field_value = "";
                            if(array_key_exists('custom_field_value', $customFieldsFilterRow) && is_array($customFieldsFilterRow['custom_field_value'])){
                                if(count($customFieldsFilterRow['custom_field_value'])>0){
                                    $custom_field_value = implode(",", $customFieldsFilterRow['custom_field_value']);
                                }

                            }
                            else if(array_key_exists('custom_date_field_value', $customFieldsFilterRow)){
                                $custom_field_value = $customFieldsFilterRow['custom_date_field_value'];
                            }
                            else if(array_key_exists('custom_field_value_country', $customFieldsFilterRow)){
                                if($customFieldsFilterRow['custom_field_value_country']=="custome_country"){
                                    $custom_field_value = \App\Helpers\Common::getCountryNamesByIDs($customFieldsFilterRow['custom_field_value_countries']);
                                }else{
                                    $custom_field_value = $customFieldsFilterRow['custom_field_value_country'];
                                }

                            }
                            else{
                                if(count($customFieldsFilterRow)==4)
                                    {
                                       $res = array_slice($customFieldsFilterRow, -2, 2, true);
                                       $custom_field_value = array_keys($res);
                                       $custom_field_value = $customFieldsFilterRow[$custom_field_value[0]]." ".$customFieldsFilterRow[$custom_field_value[1]];
                                    }
                                else
                                $custom_field_value = $customFieldsFilterRow['custom_field_value'];
                            }
                        @endphp


                        @if(array_key_exists("custom_field_name", $customFieldsFilterRow) && $customFieldsFilterRow['custom_field_name']!="" && $customFieldsFilterRow['custom_field_condition']!="" && $custom_field_value!="" )
                        @if($i==0)
                        <div class="form-group row" data-name="AqlBxzWe">
                            <span class="col-md-12 caption-subject">{{ trans('segments.view_segment.apply_filters') }}</span>
                        </div>
                        @endif

                        <div class="form-group row" data-name="svrsiaHZ">
                            <label class="control-label col-md-5">
                                @php
                                    if($customFieldsFilterRow['custom_field_name']=='bounce_status'){
                                       echo trans('segments.view_segment.bounce_status');
                                   }
                                  else if($customFieldsFilterRow['custom_field_name']=='suppression_status'){
                                       echo trans('segments.filter.subscriber.options.suppression_status');
                                   }
                                  else if($customFieldsFilterRow['custom_field_name']=='subscriber_status'){
                                       echo trans('segments.view_segment.status');
                                   }
                                   else if($customFieldsFilterRow['custom_field_name']=='subscription_status'){
                                       echo trans('segments.view_segment.subscription_status');
                                   }
                                   else if($customFieldsFilterRow['custom_field_name']=='confirmation_status'){
                                       echo trans('segments.view_segment.confirmation_status');
                                   }
                                   else if($customFieldsFilterRow['custom_field_name']=='complained_status'){
                                       echo trans('segments.view_segment.complained_status');
                                   }else if($customFieldsFilterRow['custom_field_name']=='content_format'){
                                        echo trans('segments.view_segment.content_format');
                                   }else if($customFieldsFilterRow['custom_field_name']=='creation_date'){
                                       echo trans('segments.view_segment.creation_date');
                                   }else if($customFieldsFilterRow['custom_field_name']=='subscriber_email'){
                                       echo trans('segments.view_segment.email');
                                   }else{
                                       echo \App\Helpers\Common::getCustomFieldNameByID($customFieldsFilterRow['custom_field_name']);
                                   }
                                @endphp
                            </label>
                            <div class="col-md-2" data-name="nRIoXqGv">
                                <label class="control-label">{{ trans('segments.view_segment.'.$customFieldsFilterRow['custom_field_condition']) }}</label>
                            </div>
                            <div class="col-md-5" data-name="UXFJSqvG">
                                <label class="control-label pull-right">{{ $custom_field_value=='no_process' &&  $customFieldsFilterRow['custom_field_name']=='bounce_status' ? trans('segments.view_segment.no_proccess') :$custom_field_value}}</label>
                            </div>
                        </div>
                        @endif
                        @php $i++; @endphp

                    @endforeach
                @endif
                
                @else
                    <div class="form-group row" data-name="cEUjvGKy">
                    <span class="col-md-12 caption-subject">{{ trans('segments.view_segment.filter_by_statistics') }}</span>
                </div>
                    <div class="form-group row" data-name="hyBFvwvp">
                        <label class="control-label col-md-3">{{ trans('segments.view_segment.broadcasts') }}</label>
                        <div class="col-md-9" data-name="fdAtWvob">
                            <label class="control-label pull-right">{{ (!empty($segmentCriteria['campaignChk']) and $segmentCriteria['campaignChk']=='any')? trans('segments.view_segment.any'): trans('segments.view_segment.selected_broadcasts') }}</label>
                        </div>
                    </div>
                    <?php
                    if(!empty($segmentCriteria['campaignChk']) and $segmentCriteria['campaignChk']=='custom' && array_key_exists('opens_clicks_campaign', $segmentCriteria)){
?>  
                <div class="form-group row" data-name="xkSmVesa">
                        <label class="control-label col-md-3">{{ trans('segments.view_segment.selected_broadcasts') }}</label>
                        <div class="col-md-9" data-name="uCPbRiFr">
                            <label class="control-label pull-right">
                            {{ \App\Helpers\Common::getCampaignNamesByIDs($segmentCriteria['opens_clicks_campaign']) }}
                            </label>
                        </div>
                </div>
                    
                <?php
                    }
                    ?>                
                    <div class="form-group row" data-name="YSVtvxpi">
                    <label class="control-label col-md-3">{{ trans('segments.view_segment.select_criteria') }}</label>
                    <div class="col-md-9" data-name="JAbxrWRN">
                        <label class="control-label pull-right">@php
                        if($segmentCriteria['opens_clicks_status']=='has_opened_broadcast'){
                            echo trans('segments.view_segment.has_opened_broadcast');
                        }
                        else if($segmentCriteria['opens_clicks_status']=='hasnt_opened_broadcast'){
                            echo trans('segments.view_segment.hasnt_opened_broadcast');
                        }else if($segmentCriteria['opens_clicks_status']=='has_unsubscribed'){
                            echo trans('segments.view_segment.has_unsubscribed');
                        }else if($segmentCriteria['opens_clicks_status']=='has_complained'){
                            echo trans('segments.view_segment.has_complained');
                        }else if($segmentCriteria['opens_clicks_status']=='is_sent'){
                            echo trans('segments.view_segment.is_sent');
                        }else if($segmentCriteria['opens_clicks_status']=='never_sent'){
                            echo trans('segments.view_segment.never_sent');
                        }else if($segmentCriteria['opens_clicks_status']=='injected'){
                            echo trans('segments.view_segment.injected');
                        }else if($segmentCriteria['opens_clicks_status']=='delivered'){
                            echo trans('segments.view_segment.delivered');
                        }else if($segmentCriteria['opens_clicks_status']=='delayed'){
                            echo trans('segments.view_segment.delayed');
                        }else if($segmentCriteria['opens_clicks_status']=='bounced'){
                            echo trans('segments.view_segment.bounced');
                        }else{
                            
                        }
                        @endphp</label>
                    </div>
                    </div>
                    @if($segmentCriteria['opens_clicks_status']=='has_opened_broadcast')
                        <div class="form-group row" data-name="mhIEXyQl">
                            <label class="control-label col-md-3">{{ trans('segments.view_segment.and') }}</label>
                            <div class="col-md-9" data-name="yhyxSFlO">
                                <label class="control-label pull-right">
                                    @php
                                    if(array_key_exists('open_click', $segmentCriteria)){
                                        $i = 0;
                                        foreach($segmentCriteria['open_click'] as $val){
                                            if($i==1){
                                                echo ',';
                                            }
                                            echo $value = ($val=='clicked_on_a_link') ? trans('segments.view_segment.clicked_on_a_link'):trans('segments.view_segment.has_not_clicked_on_any_link');
                                            $i++;
                                        }
                                    }
                                    @endphp


                                </label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="fOoPftVg">
                            <label class="control-label col-md-3">{{ ($segmentCriteria['any_select_link']=='Any link')? trans('segments.view_segment.any_link'): trans('segments.view_segment.selected_link') }}</label>
                                @if(array_key_exists('links_clicked', $segmentCriteria) && $segmentCriteria['any_select_link']=='Selected Links' && count($segmentCriteria['links_clicked'])>0)
                                <div class="col-md-9" data-name="XIbQsmIq">
                                    <label class="control-label pull-right">
                                    @php $k = 0;@endphp
                                        @foreach($segmentCriteria['links_clicked'] as $link)

                                            {{ $link }}

                                        @php $k ++;@endphp    
                                        @if($k!=count($segmentCriteria['links_clicked'])) , @endif
                                        @endforeach

                                    </label>
                                 </div>
                                @endif
                        </div>
                        <div class="form-group row" data-name="tzQwsXIh">
                            <label class="control-label col-md-3">{{ ($segmentCriteria['countryChk']=='any')? trans('segments.view_segment.any_country'): trans('segments.view_segment.selected_countries') }}</label>
                                @if(array_key_exists('opens_clicks_country', $segmentCriteria) && $segmentCriteria['countryChk']=='custom' && count($segmentCriteria['opens_clicks_country'])>0)
                                <div class="col-md-9" data-name="HLbzuFkI">
                                    <label class="control-label pull-right"> 
                                    @php $k = 0;@endphp
                                        @foreach($segmentCriteria['opens_clicks_country'] as $country)

                                            {{ $country }}

                                        @php $k ++;@endphp    
                                        @if($k!=count($segmentCriteria['opens_clicks_country'])) , @endif
                                        @endforeach

                                    </label>
                                 </div>
                                @endif
                        </div>
                        <div class="form-group row" data-name="oeZBawoq">
                            <label class="control-label col-md-3">{{ ($segmentCriteria['stateChk']=='any')? trans('segments.view_segment.any_state'): trans('segments.view_segment.selected_state') }}</label>
                                @if(array_key_exists('opens_clicks_region', $segmentCriteria) && $segmentCriteria['stateChk']=='custom' && count($segmentCriteria['opens_clicks_region'])>0)
                                    <div class="col-md-9" data-name="ddSswvnI">
                                        <label class="control-label pull-right"> 
                                        @php $k = 0;@endphp
                                            @foreach($segmentCriteria['opens_clicks_region'] as $state)

                                                {{ $state }}

                                            @php $k ++;@endphp    
                                            @if($k!=count($segmentCriteria['opens_clicks_region'])) , @endif
                                            @endforeach

                                        </label>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group row" data-name="BajqjZTH">
                            <label class="control-label col-md-3">{{ ($segmentCriteria['cityChk']=='any')? trans('segments.view_segment.any_city'): trans('segments.view_segment.selected_city') }}</label>
                            @if(array_key_exists('opens_clicks_city', $segmentCriteria) && $segmentCriteria['cityChk']=='custom' && count($segmentCriteria['opens_clicks_city'])>0)
                                <div class="col-md-9" data-name="HgPTvNls">
                                    <label class="control-label pull-right"> 
                                    @php $k = 0;@endphp
                                        @foreach($segmentCriteria['opens_clicks_city'] as $city)

                                            {{ $city }}

                                        @php $k ++;@endphp    
                                        @if($k!=count($segmentCriteria['opens_clicks_city'])) , @endif
                                        @endforeach

                                    </label>
                                </div>
                            @endif
                        </div>
                        <div class="form-group row" data-name="GYLkLwNv">
                            <label class="control-label col-md-3">{{ ($segmentCriteria['zipChk']=='any')? trans('segments.view_segment.any_zip'): trans('segments.view_segment.selected_zip') }}</label>
                            @if(array_key_exists('opens_clicks_zip', $segmentCriteria) && $segmentCriteria['zipChk']=='custom' && count($segmentCriteria['opens_clicks_zip'])>0)
                                <div class="col-md-9" data-name="hTQZlGJW">
                                    <label class="control-label pull-right"> 
                                    @php $k = 0;@endphp
                                        @foreach($segmentCriteria['opens_clicks_zip'] as $zip)

                                            {{ $zip }}

                                        @php $k ++;@endphp    
                                        @if($k!=count($segmentCriteria['opens_clicks_zip'])) , @endif
                                        @endforeach
                                    </label>
                                </div>
                            @endif
                        </div>
                        <div class="form-group row" data-name="Sbdjgqhr">
                            <label class="control-label col-md-3">{{ ($segmentCriteria['browsChk']=='any')? trans('segments.view_segment.any_browser'): trans('segments.view_segment.selected_browser') }}</label>
                            @if(array_key_exists('opens_clicks_brower', $segmentCriteria) && $segmentCriteria['browsChk']=='custom' && count($segmentCriteria['opens_clicks_brower'])>0)
                                <div class="col-md-9" data-name="yWZgpNoN">
                                    <label class="control-label pull-right"> 
                                    @php $k = 0;@endphp
                                        @foreach($segmentCriteria['opens_clicks_brower'] as $brower)

                                            {{ $brower }}

                                        @php $k ++;@endphp    
                                        @if($k!=count($segmentCriteria['opens_clicks_brower'])) , @endif
                                        @endforeach
                                    </label>
                                </div>
                            @endif
                        </div>
                        <div class="form-group row" data-name="UWQFnzza">
                            <label class="control-label col-md-3">{{ ($segmentCriteria['osChk']=='any')? trans('segments.view_segment.any_os'): trans('segments.view_segment.selected_os') }}</label>
                            @if(array_key_exists('opens_clicks_os', $segmentCriteria) && $segmentCriteria['osChk']=='custom' && count($segmentCriteria['opens_clicks_os'])>0)
                                <div class="col-md-9" data-name="ILYtEcAu">
                                    <label class="control-label pull-right"> 
                                    @php $k = 0;@endphp
                                        @foreach($segmentCriteria['opens_clicks_os'] as $os)

                                            {{ $os }}

                                        @php $k ++;@endphp    
                                        @if($k!=count($segmentCriteria['opens_clicks_os'])) , @endif
                                        @endforeach
                                    </label>
                                </div>
                            @endif
                        </div>
                        @if($segmentCriteria['duration']=='none')
                        <div class="form-group row" data-name="nRMMoIDc">
                            <label class="control-label col-md-3">{{ trans('segments.view_segment.duration') }}</label>
                            <div class="col-md-9" data-name="ATAALxRk">
                                        <label class="control-label pull-right">
                                            {{ trans('segments.view_segment.none') }}
                                        </label>
                            </div>    
                        </div>
                        @else
                            <div class="form-group row" data-name="hpVkxUYM">
                                <label class="control-label col-md-3">{{ trans('segments.view_segment.duration') }}</label>
                                    <div class="col-md-9" data-name="othUPUax">
                                        <label class="control-label pull-right"> 
                                        {{ trans('segments.view_segment.by_date') }}
                                        </label>
                                    </div>
                            </div>
                            @if(array_key_exists('opens_clicks_dynamic_filter', $segmentCriteria) && $segmentCriteria['opens_clicks_dynamic_filter']!="" && array_key_exists('duration_date', $segmentCriteria) && $segmentCriteria['duration_date']!="")
                            <div class="form-group row" data-name="EkdObvwD">
                                <label class="control-label col-md-3">@php
                                if($segmentCriteria['opens_clicks_dynamic_filter']=='after'){
                                    echo trans('segments.view_segment.after');
                                }
                                else if($segmentCriteria['opens_clicks_dynamic_filter']=='before'){
                                    echo trans('segments.view_segment.before');
                                }else if($segmentCriteria['opens_clicks_dynamic_filter']=='exactly'){
                                    echo trans('segments.view_segment.exactly_on');
                                }
                                @endphp</label>
                                    <div class="col-md-9" data-name="gOrGgiGS">
                                        <label class="control-label pull-right"> 
                                        {{ $segmentCriteria['duration_date'] }}
                                        </label>
                                    </div>
                            </div>
                            @elseif(array_key_exists('opens_clicks_dynamic_filter', $segmentCriteria) && $segmentCriteria['opens_clicks_dynamic_filter']=="between" && array_key_exists('from', $segmentCriteria) && $segmentCriteria['from']!="" && array_key_exists('to', $segmentCriteria) && $segmentCriteria['to']!="")
                            <div class="form-group row" data-name="fZUPMczm">
                                <label class="control-label col-md-3">{{ trans('segments.view_segment.between') }}</label>
                                    <div class="col-md-9" data-name="DTBdBpKh">
                                        <label class="control-label pull-right"> 
                                        {{ $segmentCriteria['from'] }} {{ trans('segments.view_segment.to') }} {{ $segmentCriteria['to'] }}
                                        </label>
                                    </div>
                            </div>
                            @elseif(array_key_exists('opens_clicks_dynamic_filter', $segmentCriteria) && ($segmentCriteria['opens_clicks_dynamic_filter']=="is_overdue_for" || $segmentCriteria['opens_clicks_dynamic_filter']=="past" || $segmentCriteria['opens_clicks_dynamic_filter']=="older") && array_key_exists('days_time_value', $segmentCriteria) && $segmentCriteria['days_time_value']!="" && array_key_exists('days_time', $segmentCriteria) && $segmentCriteria['days_time']!="")
                            <div class="form-group row" data-name="CsaLxWeO">
                                <label class="control-label col-md-3">
                                    @if($segmentCriteria['opens_clicks_dynamic_filter']=='is_overdue_for')
                                    {{ trans('segments.view_segment.occurred_before') }}
                                    @elseif($segmentCriteria['opens_clicks_dynamic_filter']=='past')
                                    {{ trans('segments.view_segment.for_the_past') }}
                                    @else 
                                    {{ trans('segments.view_segment.older_than') }}
                                    @endif
                                
                                </label>
                                    <div class="col-md-9" data-name="bOEHPZdg">
                                        <label class="control-label pull-right"> 
                                        {{ $segmentCriteria['days_time_value'] }}   {{ $segmentCriteria['days_time'] }}
                                        </label>
                                    </div>
                            </div>
                            @endif
                            
                        @endif
                        
                    
                    @endif
                    <?php
                    
                    ?>
                    @if(array_key_exists('subscriber_filter', $segmentCriteria) && count($segmentCriteria['subscriber_filter']) > 0)
                        @php $j = 0; @endphp
                        @foreach($segmentCriteria['subscriber_filter'] as $filter)
                        @php
                            $subscriber_field_value = "";
                            if(array_key_exists('subscriber_field_name', $filter) && is_array($filter['subscriber_field_value'])){
                                if(count($filter['subscriber_field_value'])>0){
                                    $subscriber_field_value = implode(",", $filter['subscriber_field_value']);
                                }

                            }
                            else if(array_key_exists('subscriber_field_value', $filter)){
                                $subscriber_field_value = $filter['subscriber_field_value'];
                            }
                            
                        @endphp
                            @if(array_key_exists("subscriber_field_name", $filter) && $filter['subscriber_field_name']!="" && $filter['subscriber_condition_name']!="" && $subscriber_field_value!="" )
                                @if($j == 0)
                                    <div class="form-group row" data-name="ZgyGvdRf">
                                        <span class="col-md-12 caption-subject">{{ trans('segments.view_segment.apply_filters') }}</span>
                                    </div>
                                @endif

                                <div class="form-group row" data-name="FkmTEWHA">
                                        <label class="control-label col-md-5">
                                            {{ trans('segments.view_segment.'.$filter['subscriber_field_name']) }}
                                        </label>
                                        <div class="col-md-2" data-name="SNKBYExY">
                                            <label class="control-label">{{ trans('segments.view_segment.'.$filter['subscriber_condition_name']) }}</label>
                                        </div>
                                        <div class="col-md-5" data-name="YfDBbslr">
                                            <label class="control-label pull-right">
                                                @if($filter['subscriber_field_name']=='contact_list')
                                                {!! \App\Helpers\Common::getListNamesByIds($filter['subscriber_field_value']) !!}
                                                @elseif($filter['subscriber_field_name']=='sending_node')
                                                {{ \App\Helpers\Common::getSMTPNamesByIDs($filter['subscriber_field_value']) }}
                                                @elseif($filter['subscriber_field_name']=='sending_domain')
                                                {{ \App\Helpers\Common::getDomainNamesByIDs($filter['subscriber_field_value']) }}
                                                @elseif($filter['subscriber_field_name']=='bounce_email')
                                                {{ \App\Helpers\Common::getBounceEmailsByIDs($filter['subscriber_field_value']) }}
                                                @else
                                                {{ $subscriber_field_value }}
                                                @endif
                                                
                                            
                                            </label>
                                            
                                        </div>
                                </div>
                            @endif    
                        @php $j++; @endphp
                        @endforeach
                    @endif
                    
                @endif    
                
            </div>
        </div>
    </div>
</div>
<!-- view segment -->
@endsection