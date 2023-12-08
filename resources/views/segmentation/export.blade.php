@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
    <link href="/themes/default/css/jquery.nestable.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .dd-handle, .dd3-content {
            -webkit-border-radius: 0px;
            border-radius: 0px;
        }
        .dd3-content .kt-checkbox, .dd3-content .mt-radio {
            margin-bottom: 0;
        }
        .dd3-content .kt-checkbox-list, .dd3-content .mt-radio-list {
            padding: 0;
        }
        .dd3-content {
            height: 34px;
        }
        .dd3-handle {
            width: 34px;
            background: #eee;
        }
        .dd-handle {
            height: 34px;
        }
        .dd3-handle:before {
            content: '≡';
            top: 6px;
            color: #999;
        }
        .dd3-content .kt-checkbox-list {
            padding-left: 9px;
            margin-top: 1px;
        }
        .dd3-content {
            margin: 7px 0;
            background: #f9f9f9;
        }
        .btn {
            min-width: 80px;
        }
        form#frm_export_segemnt h3 {
            margin-bottom: 5px;
        }
        @media (min-width: 992px) {
            .page-content-wrapper .page-content {
                min-height: 780px;
                overflow-x: hidden;
            }
        }
        .kt-checkbox-list {
            padding: 0;
            padding-left: 10px;
        }
        .kt-checkbox-list .kt-checkbox:last-child {
            margin-bottom: 0;
            margin-top: 1px;
        }
    </style>
@endsection

@section('page_scripts')
    <script src="/themes/default/js/jquery.nestable.js" type="text/javascript"></script>
    <script type="text/javascript">
        function getCustomFieldOrder() {
            var idsInOrder = [];
            $("ol#sortable li").each(function () {
                var data_id = $(this).attr('data-id');
                if($("#custom_field_"+data_id).is(":checked")){
                    idsInOrder.push($(this).attr('data-id'));
                }

            });
            $("#custom_field_order").val(idsInOrder);
            // console.log(idsInOrder);
        }
        function getGeoStatsOrder() {
            var idsGeoInOrder = [];
            $("ol#get_stats_ol li").each(function () {
                var data_id = $(this).attr('data-id');
                if(data_id=='country' && $("#country").is(":checked")){
                    idsGeoInOrder.push(data_id);
                }
                else if(data_id=='state' && $("#state").is(":checked")){
                    idsGeoInOrder.push(data_id);
                }
                else if(data_id=='city' && $("#city").is(":checked")){
                    idsGeoInOrder.push(data_id);
                }
                else if(data_id=='zip' && $("#zip").is(":checked")){
                    idsGeoInOrder.push(data_id);
                }
                else if(data_id=='browse' && $("#browse").is(":checked")){
                    idsGeoInOrder.push(data_id);
                }
                else if(data_id=='os' && $("#os").is(":checked")){
                    idsGeoInOrder.push(data_id);
                }
                else if(data_id=='link_clicked' && $("#link_clicked").is(":checked")){
                    idsGeoInOrder.push(data_id);
                }else if(data_id=='message_id' && $("#message_id").is(":checked")){
                    idsGeoInOrder.push(data_id);
                }
            });


            $("#geo_stats_order").val(idsGeoInOrder);
            // console.log(idsInOrder);
        }
        function getCampaignMetaOrder() {
            var idsCampaignMetaOrder = [];
            $("ol#get_campaign_meta_ol li").each(function () {
                var data_id = $(this).attr('data-id');
                if(data_id=='campaign_name' && $("#campaign_name").is(":checked")){
                    idsCampaignMetaOrder.push(data_id);
                }
                else if(data_id=='group_name' && $("#group_name").is(":checked")){
                    idsCampaignMetaOrder.push(data_id);
                }
                else if(data_id=='subject_line' && $("#subject_line").is(":checked")){
                    idsCampaignMetaOrder.push(data_id);
                }
                else if(data_id=='campaign_date_created' && $("#campaign_date_created").is(":checked")){
                    idsCampaignMetaOrder.push(data_id);
                }
                else if(data_id=='campaign_date_sent' && $("#campaign_date_sent").is(":checked")){
                    idsCampaignMetaOrder.push(data_id);
                }
            });


            $("#campaign_meta_order").val(idsCampaignMetaOrder);
            // console.log(idsInOrder);
        }
        var UINestable = function () {
            var t = function (t) {
                var e = t.length ? t : $(t.target),
                    a = e.data("output");
                window.JSON ? a.val(window.JSON.stringify(e.nestable("serialize"))) : a.val("JSON browser support required for this demo.")
            };
            return {
                init: function () {
                    $("#nestable_list_3").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                    $("#nestable_list_4").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                    $("#nestable_list_campaign").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                }
            }
        }();
        jQuery(document).ready(function () {
            UINestable.init()
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function () {
            $("#export_segement").click(function () {
                getCustomFieldOrder();
                getGeoStatsOrder();
                getCampaignMetaOrder();
                if($("#custom_field_order").val()!="" || $("#geo_stats_order").val()!=""){
                    $("#error_message").hide();
                    $.ajax({
                        url: "{{ URL::route('schedule.export.segment') }}",
                        type: "POST",
                        data: $("#frm_export_segemnt").serialize(),
                        dataType: 'json',
                        beforeSend: function () {
                            Command: toastr["success"]("{{trans('segments.export_segments.waiting_to_export')}}");
                            $("#modal-loading").modal('show');
                        },
                        complete: function () {
                            $("#modal-loading").modal('hide');
                        },
                        success: function (data) {
                            if(data.status=='permission_error'){
                                Command: toastr["error"] ("{{trans('common.message.temp_permission')}}");
                                return false;
                            }
                            else if(data.status=='success'){
                               
                                $.ajax({
                                    url: "{{ url('segment/start_export') }}",
                                    type: "GET",
                                    data: $("#frm_export_segemnt").serialize(),
                                    success: function (data) { 
                                        
                                    }
                                });
                               
                                window.setTimeout(function () {
                                    Command: toastr["success"]("{{trans('segments.export_segments.message.success')}}");
                                }, 3000);
                                window.setTimeout(function () {
                                    window.location.href = "{{ route('segments.index') }}";
                                }, 3000);
                            }
                            else{
                                Command: toastr["error"]("{{trans('segments.export_segments.message.error')}}");
                            }
                        }
                    });
                }else{
                    $("#error_message").show();
                }

            });
        });
    </script>
@endsection

@section(decide_content())

    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="ejAuhFwf">
    <span id='msg-text'><span>
    </div>

    <!-- BEGIN FORM-->
    <form action="" method="POST" id="frm_export_segemnt" name="frm_export_segemnt" class="kt-form kt-form--label-right" novalidate="novalidate">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="id" name="id" value="{{ $id }}">
        <input type="hidden" name="custom_field_order" id="custom_field_order" value="" />
        <input type="hidden" name="geo_stats_order" id="geo_stats_order" value="" />
        <input type="hidden" name="campaign_meta_order" id="campaign_meta_order" value="" />

        <div class="col-md-12" data-name="TIDIJBhw">
            <div class="row" data-name="XglseXYd">
                <div class="kt-portlet kt-portlet--height-fluid" data-name="MaupVbsG">
                    <div class="kt-portlet__head" data-name="FNCfYNwz">
                        <div class="kt-portlet__head-label" data-name="zxMyJjCg">
                            <h3 class="kt-portlet__head-title">{!! trans('segments.export_segments.exporting',['title'=>$segment_data['name']]) !!}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" data-name="YZRjazSB">
                        <div class="row" data-name="wujDAeIG">
                            <label class="col-form-label col-md-3"></label>
                            <div class="col-md-6" data-name="OcCByHHt">
                                <h3>{{ trans('segments.export_segments.choose_custom_fields') }}</h3>
                            </div>
                        </div>
                        <div class="form-group" data-name="LjkAmrRe">
                            <div class="col-md-6 offset-md-3" data-name="YMGPRwdT">
                                <div class="dd" id="nestable_list_4" data-name="mFmNvNsI">
                                    <ol class="dd-list" id="sortable">
                                        <li class="dd-item dd3-item" data-id="email">
                                            <div class="dd-handle dd3-handle" data-name="tqUgKHNW"> </div>
                                            <div class="dd3-content" data-name="BrYyQfEm">
                                                <div class="kt-checkbox-list" data-name="RDZdvXUv">
                                                    <label class="kt-checkbox kt-checkbox-outline"> {{trans('segments.export_segments.email')}}
                                                        <input type="checkbox" value="email" checked="" name="custome_fields[]" id="custom_field_email">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        @php
                                            $i=0
                                        @endphp
                                        @foreach($custom_fields_data as $custom_fields_row)
                                            @php
                                                $i++;
                                            @endphp
                                            <li class="dd-item dd3-item" data-id="{{ $custom_fields_row['id'] }}">
                                                <div class="dd-handle dd3-handle" data-name="LMWUoqKX"> </div>
                                                <div class="dd3-content" data-name="LAzhUltc">
                                                    <div class="kt-checkbox-list" data-name="zSstKLcb">
                                                        <label class="kt-checkbox kt-checkbox-outline"> {{ $custom_fields_row['name'] }}
                                                            <input type="checkbox" value="{{ $custom_fields_row['id'] }}" name="custome_fields[]" id="custom_field_{{ $i }}">
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ol>
                                </div>
                            </div>
                        </div>
                        @if($segment_data['segment_type']==0)
                            <div class="form-group row" data-name="pdrrntdN">
                                <div class="offset-md-3 col-md-6" data-name="hhyXyfQG">
                                    <input type="button" name="export_segement" id="export_segement" class="btn btn-success" value="{{trans('breadcrumbs.export')}}" />
                                    <br />
                                    <div class="error" id="error_message"  style="display: none;" data-name="UWXhFNia">{{ trans('segments.export_segments.select_one_field') }}</div>
                                </div>
                            </div>
                        @endif
                    </div>
                    @if($segment_data['segment_type']==1)
                        <div class="portlet-body" style="" data-name="NXIULkcc">
                            <div class="row" data-name="gjFOzCwM">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-6" data-name="SAgzZrWu">
                                    <h3>{{ trans('segments.export_segments.labels.geo_stats') }}</h3>
                                </div>
                            </div>
                            <div class="form-group row" data-name="iXKFNNuy">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-6" data-name="FTniGyVO">
                                    <div class="dd" id="nestable_list_3" data-name="NMmEdjtD">
                                        <ol class="dd-list" id="get_stats_ol">
                                            <li class="dd-item dd3-item" data-id="country">
                                                <div class="dd-handle dd3-handle" data-name="uKGNeeHD"> </div>
                                                <div class="dd3-content" data-name="FxREuGkR">
                                                    <div class="kt-checkbox-list" data-name="FtQkkYrs">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="country" id="country" name="country">
                                                            {{ trans('segments.export_segments.labels.geo_country') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="state">
                                                <div class="dd-handle dd3-handle" data-name="QGbpfxbI"> </div>
                                                <div class="dd3-content" data-name="LABLNaXb">
                                                    <div class="kt-checkbox-list" data-name="TQRkpNTU">
                                                        <label class="kt-checkbox kt-checkbox-outline"> 
                                                            <input type="checkbox" value="state" name="state" id="state">
                                                            {{ trans('segments.export_segments.labels.geo_state') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="city">
                                                <div class="dd-handle dd3-handle" data-name="XmUtTknj"> </div>
                                                <div class="dd3-content" data-name="sMhhaJRv">
                                                    <div class="kt-checkbox-list" data-name="gXJpZrqr">
                                                        <label class="kt-checkbox kt-checkbox-outline"> 
                                                            <input type="checkbox" value="city" name="city" id="city">
                                                            {{ trans('segments.export_segments.labels.geo_city') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="zip">
                                                <div class="dd-handle dd3-handle" data-name="raZDqFes"> </div>
                                                <div class="dd3-content" data-name="KNtOoGuI">
                                                    <div class="kt-checkbox-list" data-name="PalxidIE">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="zip" name="zip" id="zip">
                                                            {{ trans('segments.export_segments.labels.geo_zip') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="browse">
                                                <div class="dd-handle dd3-handle" data-name="yMXweYMB"> </div>
                                                <div class="dd3-content" data-name="NwTEgEtq">
                                                    <div class="kt-checkbox-list" data-name="RCuWhXIr">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="browse" name="browse" id="browse">
                                                            {{ trans('segments.export_segments.labels.browser') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="os">
                                                <div class="dd-handle dd3-handle" data-name="ALgvRqGe"> </div>
                                                <div class="dd3-content" data-name="TpxeQURW">
                                                    <div class="kt-checkbox-list" data-name="UYRBIGNn">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="os" name="os" id="os">
                                                            {{ trans('segments.export_segments.labels.operating_system') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="link_clicked">
                                                <div class="dd-handle dd3-handle" data-name="LlBBWgmf"> </div>
                                                <div class="dd3-content" data-name="GntSQmrL">
                                                    <div class="kt-checkbox-list" data-name="sVjTmSpC">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="link_clicked" name="link_clicked" id="link_clicked">
                                                            {{ trans('segments.export_segments.labels.link_clicked') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="message_id">
                                                <div class="dd-handle dd3-handle" data-name="BdgJlxvq"> </div>
                                                <div class="dd3-content" data-name="VsDOQgmr">
                                                    <div class="kt-checkbox-list" data-name="HtSiAzKm">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="Message_id" name="message_id" id="message_id">
                                                            {{ trans('segments.export_segments.labels.message_id') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                            <div class="row" data-name="nqZzGyFD">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-6" data-name="NdLETilL">
                                    <h3>{{ trans('segments.export_segments.campaign') }}</h3>
                                </div>
                            </div>
                            <div class="form-group row" data-name="oSdzTnJc">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-6" data-name="tbAwcWvK">
                                    <div class="dd" id="nestable_list_campaign" data-name="usQdjlvc">
                                        <ol class="dd-list" id="get_campaign_meta_ol">
                                            <li class="dd-item dd3-item" data-id="campaign_name">
                                                <div class="dd-handle dd3-handle" data-name="khKASYBJ"> </div>
                                                <div class="dd3-content" data-name="DvghpgLP">
                                                    <div class="kt-checkbox-list" data-name="XCnJAAWD">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="campaign_name" id="campaign_name" name="campaign_name">
                                                            {{ trans('segments.export_segments.labels.campaign_name') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="group_name">
                                                <div class="dd-handle dd3-handle" data-name="WGvshyUp"> </div>
                                                <div class="dd3-content" data-name="oXZIenes">
                                                    <div class="kt-checkbox-list" data-name="KEJkiJrt">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="group_name" id="group_name" name="group_name">
                                                            {{ trans('segments.export_segments.labels.group_name') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="subject_line">
                                                <div class="dd-handle dd3-handle" data-name="UpIQnbtO"> </div>
                                                <div class="dd3-content" data-name="znUkOrIv">
                                                    <div class="kt-checkbox-list" data-name="JPYufOER">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="subject_line" id="subject_line" name="subject_line">
                                                            {{ trans('segments.export_segments.labels.subject_line') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="campaign_date_created">
                                                <div class="dd-handle dd3-handle" data-name="TdTbHrqA"> </div>
                                                <div class="dd3-content" data-name="wfamBDHR">
                                                    <div class="kt-checkbox-list" data-name="QxDRQhPC">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="campaign_date_created" id="campaign_date_created" name="campaign_date_created">
                                                            {{ trans('segments.export_segments.labels.broadcast_creation_date') }}
                                                            
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="dd-item dd3-item" data-id="campaign_date_sent">
                                                <div class="dd-handle dd3-handle" data-name="EzHvGnZZ"> </div>
                                                <div class="dd3-content" data-name="tqwVwKWW">
                                                    <div class="kt-checkbox-list" data-name="hAJhGEkW">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="campaign_date_sent" id="campaign_date_sent" name="campaign_date_sent">
                                                            {{ trans('segments.export_segments.labels.campaign_sent_date') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>                
                                            
                            <div class="form-group" data-name="znJDnwEp">
                                <div class="offset-md-3 col-md-6" data-name="RfcENrYN">
                                    <input type="button" name="export_segement" id="export_segement" class="btn btn-success" value="{{trans('common.form.buttons.save')}}" />
                                    <br />
                                    <div class="error" id="error_message" style="display: none;" data-name="XbZpBoPO">{{ trans('segments.export_segments.select_one_field') }}</div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
@endsection