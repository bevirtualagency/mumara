<style type="text/css">
    .datetimepicker.dropdown-menu:before, .datetimepicker.dropdown-menu:after {
        left: auto;
        right: 10px;
    }
    .datetimepicker.dropdown-menu {
        left: auto !important;
        right: 107px !important;
        margin-top: 10px;
    }
</style>
<div class="" style="display:block !important;" data-name="wdFzAIMM">
    @if(!$contact_info->isEmpty())
    <div class="kt-portlet kt-portlet--height-fluid" style="display:block !important;" data-name="TLFXZksk">
        <div class="kt-portlet__head" data-name="oMHbbnYx">
            <div class="kt-portlet__head-label" data-name="IfKXAJHj">
                <h3 class="kt-portlet__head-title">
                    {{trans('contacts.detail.modal.contact_info')}}
                </h3>
            </div>
        </div>
        <div class="kt-portlet__body" data-name="XQrkLJSi">
            <div class="form-group row" data-name="kDlecuiD">
            @foreach ($contact_info as $data)
                <div class="col-md-6" data-name="ycVsnObD">
                    <label class="col-form-label">{{ $data->name }}
                        @if($data->is_required)
                            <span class="required"> * </span>
                        @endif 
                    </label>
                                           
                    <div class="input-icon right" data-name="nHVEfZpn">
                            @if ($data->type != 'select')
                                @if ($data->type == 'date')
                                  
                                <div class="input-group date" data-date="" data-date-format="mm/dd/yy" data-name="keXXWLNY">
                                    <input class="form-control" type="text" id="datetimepicker-custom" name="custom_fields[{{$data->id}}]" value="{{ isset($subscriber_custom_fields) && !empty($subscriber_custom_fields[$data->id]) ? str_replace(' 00:00:00','',$subscriber_custom_fields[$data->id]) : '' }}" {{ $data->is_required ? 'required' : '' }}>
                                    <div class="input-group-append" data-name="QDDqdlYz">
                                        <span class="input-group-text">
                                            <i class="la la-calendar"></i>
                                        </span>
                                    </div>
                                </div>
                                @else
                                <input  type="{{$data->tag=='mobile'?'number':'text'}}" name="custom_fields[{{$data->id}}]" value="{{ isset($subscriber_custom_fields) && !empty($subscriber_custom_fields[$data->id]) ? $subscriber_custom_fields[$data->id] : '' }}" class="form-control {{ $data->is_required ? 'required' : '' }}" />
                                @endif
                            @else
                            @php
                                $value=$subscriber_custom_fields[$data->id] ?? 'none';
                                if ($data->id == 6) {
                                    $value = DB::table('countries')->where('id', $value)->orWhere('country_code', $value)->orWhere('country_name', $value)->value('country_name');
                                }
                            @endphp
                                <select data-placeholder="{{ trans('contacts.select_country') }}" class="form-control m-select2" name="custom_fields[{{$data->id}}]" {{ $data->is_required ? 'required' : '' }}>
                                    <option value="">{{ trans('contacts.select_country') }}</option>
                                    @foreach ($countries as $country)
                                       <option value="{{ $country->id }}" {{ $value == $country->country_name ? 'selected' : '' }}>{{ $country->country_name }}</option>
                                    @endforeach
                               </select>
                            @endif
                    </div>
                </div>
            @endforeach
            </div>
        </div>
    </div>
    @endif
    @if (count($custom_fields) > 0)
    <div style="display:block !important;" data-name="MXQLFsMf">
        <div class="kt-portlet kt-portlet--height-fluid" style="display:block !important;" data-name="ivArYaHq">
            <div class="kt-portlet__head" data-name="ijCotNNY">
                <div class="kt-portlet__head-label" data-name="rPYJTECe">
                    <h3 class="kt-portlet__head-title">
                        {{trans('contacts.detail.modal.custom_fields')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="zcFCXHNu">
                <div data-name="jFuRqcJV">
                    <div class="form-group row" data-name="VCkTLrhC">
                    @foreach ($custom_fields as $data)
                        <div class="col-md-6" data-name="rinRyCUF">
                            <label class="col-form-label">{{ $data->name }}
                                @if($data->is_required)
                                    <span class="required"> * </span>
                                @endif 
                                </label>
                            <div class="input-icon right" data-name="kodJdXNk">
                            @if ($data->type == 'text')
                                <input type="text" name="custom_fields[{{$data->id}}]" value="{{ isset($subscriber_custom_fields[$data->id]) ? $subscriber_custom_fields[$data->id] : '' }}" class="form-control" {{ $data->is_required ? 'required' : '' }} />
                                @elseif($data->type == 'number')
                                <input type="number" name="custom_fields[ {{$data->id}} ]" value="{{ isset($subscriber_custom_fields[$data->id]) ? $subscriber_custom_fields[$data->id] : '' }}" class="form-control" {{ $data->is_required ? 'required' : '' }} />
                            @elseif ($data->type == 'textarea' || $data->type == 'json')
                                <textarea name="custom_fields[ {{$data->id }}]" class="form-control" rows="3" {{ $data->is_required ? 'required' : '' }} >{{ isset($subscriber_custom_fields[$data->id]) ? $subscriber_custom_fields[$data->id] : '' }}</textarea>
                            @elseif ($data->type == 'checkbox')
                                @if ($data->options != "")
                                   <div class="kt-checkbox-inline" data-name="HaAaAEWZ">
                                        @foreach (preg_split('/\r\n|[\r\n]/', $data->options) as $option)
                                            <label class="kt-checkbox">
                                                <input type="checkbox" value="{{ $option }}" name="custom_fields[{{$data->id}}][] " {{ $data->is_required ? 'required' : '' }}
                                                {{ isset($subscriber_custom_fields[$data->id]) && in_array($option, explode(',', $subscriber_custom_fields[$data->id])) ? 'checked' : '' }}
                                                 />
                                                {{ $option }}
                                                <span></span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            @elseif ($data->type == 'select')
                                @if ($data->options != "")
                                    <select class="form-control m-select2" name="custom_fields[{{$data->id}}]" {{ $data->is_required ? 'required' : '' }}>
                                        <option value="">{{trans('contacts.custom_fields_blade.Option_chosse')}}</option>
                                        @foreach (preg_split('/\r\n|[\r\n]/', $data->options) as $option)
                                            <option value="{{ $option }}" {{ isset($subscriber_custom_fields[$data->id]) && $subscriber_custom_fields[$data->id] == $option ? 'selected' : '' }}>{{ $option }}</option>
                                        @endforeach
                                    </select>
                                @endif
                            @elseif ($data->type == 'radio')
                                @if ($data->options != "")
                                   <div class="kt-radio-inline" data-name="VsDzAxho">
                                       @foreach (preg_split('/\r\n|[\r\n]/', $data->options) as $option)
                                            <label class="kt-radio">
                                                <input type="radio" name="custom_fields[{{$data->id}}]" value="{{ $option }}"  {{ $data->is_required ? 'required' : '' }} {{ isset($subscriber_custom_fields[$data->id]) && $subscriber_custom_fields[$data->id] == $option ? 'checked' : '' }}>{{ $option }}
                                                <span></span>
                                            </label>
                                        @endforeach
                                    </div>
                                @endif
                            @elseif ($data->type == 'date')
                                        <div class="input-group date" data-name="tHwCJVlF" >
                                        <input class="form-control datetimepicker-custom" id="{{$data->id}}" type="text" name="custom_fields[{{$data->id}}]" value="{{ isset($subscriber_custom_fields[$data->id]) ? str_replace(' 00:00:00','',$subscriber_custom_fields[$data->id]) : '' }}" {{ $data->is_required ? 'required' : '' }}>
                                        <div class="input-group-append" data-name="BhCwvsfn">
                                            <span class="input-group-text">
                                                <i class="la la-calendar glyphicon-th"></i>
                                            </span>
                                        </div>
                                    </div>
                            @endif
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
</div>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datepicker.js" type="text/javascript"></script>

<script>
$('#datetimepicker').datetimepicker({
    autoclose: true,
    pickerPosition: 'top-left',
    format: 'yyyy-mm-dd hh:ii:ss'
});
$('#datetimepicker-custom').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
});
$('.datetimepicker-custom').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true
});
$(document).ready(function() {
    $(".m-select2").select2({
         templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
    });
    //$('#datetimepicker').datetimepicker();
});
</script>