<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datepicker-init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/timepicker-init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/repeater2.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<style>
    button.multiselect span.multiselect-selected-text {
    color: #333;
}
button.multiselect:hover span.multiselect-selected-text {
    color: #FFF !important;
}
</style>

<div class="col-md-12" id="kt_repeater_3">
    <div  class="form-group-last row" id="kt_repeater_3">
        <div data-repeater-list="custom_fields_filter" class="col-lg-12">
            <?php
            $custom_id_number = 0;
            $totalFleidDiv = count($customCriteriaFormArray);
            ?>
            <script>
                var custom_sections = 0;
            </script> 
            @foreach($customCriteriaFormArray as $form)
            <div  data-repeater-item class="row align-items-center">
                <div class="col-md-4">
                    <div class="form-group">
                        <select disabled=""   class="form-control m-select2 custom_field_name" id="custom_field_name_{{ $form['f1']['id'] }}" name="<?php echo $form['f1']['name']; ?>" data-placeholder="Select Option" onchange="loadCustomFieldsValues(this.name, this.value, this.id)">
                            <?php
                            $fgroup = 0;
                            ?>
                            @foreach($form['f1']['options'] as $select_field)
                            @if(isset($select_field['optgroup']))
                            <?php
                            if ($fgroup > 0) {
                                ?>
                                </optgroup>  
                                <?php
                            }
                            ?> 
                            <optgroup label="{{ $select_field['optgroup'] }}">
                                <?php
                                $fgroup++;
                                ?>    
                                @endif
                                @if($select_field['lable']!="")
                                <option data_value="{{ $select_field['data_value'] }}" data-type="{{ $select_field['data-type'] }}" @if($select_field['value']==$form['f1']['selected_value']) selected="" @endif value="{{ $select_field['value'] }}" @if(empty($select_field['value'])) readonly="readonly" @endif>{{ $select_field['lable'] }}</option>               
                                @endif
                                @endforeach
                        </select>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="form-group">
                        <select disabled="" class="form-control m-select2 custom_field_condition @if($form['f3']['type']=='date') date_condition @endif" name="custom_field_condition" id="custom_field_condition_{{ $form['f2']['id'] }}" data-placeholder="Select Option">
                            @if(count($form['f2']['options'])>0)
                            @foreach($form['f2']['options'] as $condition)
                            <option value="{{ $condition['value'] }}" @if($condition['value']==$form['f2']['selected_value']) selected="" @endif  >{{ $condition['lable'] }}</option>
                            @endforeach 
                            @endif
                        </select>
                    </div>
                </div>
                @if($form['f1']['selected_value']==6)
                <div class="col-md-3 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                    <div id="countrBlk_{{ $custom_id_number }}" class="filterradio cfield kt-radio-inline">
                        <label for="country_any_{{ $custom_id_number }}" class="kt-radio">
                            <input type="radio" value="any" name="custom_field_value_country"class="country_options" @if(isset($form['f3']['selected_value']['custom_field_value_country'])&& $form['f3']['selected_value']['custom_field_value_country']=='any') checked="" @endif id="country_any_{{ $custom_id_number }}">
                            {{ trans('schedule_broadcast.add_new.tab1.form.any_country') }} <span></span>
                        </label>  

                        <label for="country_select_{{ $custom_id_number }}" class="kt-radio">
                            <input readonly="" type="radio" class="country_options" @if(isset($form['f3']['selected_value']['custom_field_value_country']) && $form['f3']['selected_value']['custom_field_value_country']=='custome_country') checked="" @endif value="custome_country" name="custom_field_value_country" id="country_select_{{ $custom_id_number }}">
                            {{ trans('schedule_broadcast.add_new.tab1.form.selected_country') }} <span></span>
                        </label>
                    </div>
                    <div style="display:@if(isset($form['f3']['selected_value']['custom_field_value_country']) && $form['f3']['selected_value']['custom_field_value_country']=='custome_country')block;@else none;@endif" >
                        <select disabled="" class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_{{ $custom_id_number }}"  name="custom_field_value_countries" >
                            @if($form['f3']['selected_value']['custom_field_value_country']) && $form['f3']['selected_value']['custom_field_value_country']=='custome_country')
                            <option value="">{{ trans('schedule_broadcast.add_new.tab1.form.select_country') }}</option>
                            @foreach($countriesData as $country)
                            <option @if(isset($form['f3']['selected_value']['custom_field_value_countries']) && in_array($country['id'], $form['f3']['selected_value']['custom_field_value_countries'])) selected="" @endif value="{{ $country['id'] }}" >{{ $country['country_name'] }}</option>
                            @endforeach
                            @endif
                        </select>          
                    </div>
                </div>                                                                                    
                @elseif($form['f2']['selected_value']=='between')
                <div class="col-md-3 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                    <div class="dpr ssrange" id="csrange_{{ $custom_id_number }}">
                        <div class='input-daterange input-group'>
                            <input readonly="" type="text" value="@if(isset($form['f3']['selected_value']['cfrom'])) {{ $form['f3']['selected_value']['cfrom'] }} @endif"  class="form-control from" id="sfrom_{{ $custom_id_number }}" name="cfrom"  data-date-format="yyyy-mm-dd" />
                            <div class="input-group-append"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>
                            <input readonly="" type="text" value="@if(isset($form['f3']['selected_value']['cto'])) {{ $form['f3']['selected_value']['cto'] }} @endif" class="form-control to" id="sto_{{ $custom_id_number }}" name="cto"  data-date-format="yyyy-mm-dd" />
                        </div>            
                    </div>
                </div>  
                @elseif($form['f2']['selected_value']=='is_due_in' || $form['f2']['selected_value']=='is_overdue_for' || $form['f2']['selected_value']=='past' || $form['f2']['selected_value']=='older')
                <div class="col-md-3 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                    <div class="cusomDate">
                        <div class="datefields">
                            <input readonly="" type="text" id="days_value_time_{{ $custom_id_number }}" value="@if(isset($form['f3']['selected_value']['days_time_value_name'])){{ $form['f3']['selected_value']['days_time_value_name'] }}@endif" name="days_time_value_name"  class="form-control" placeholder="{{trans('segments.add_new.field.placeholder.xx_days')}}" />
                        </div>
                        <div class="datefields pull-right">
                            <select disabled="" class="form-control" id="custom_duration_{{ $custom_id_number }}"  name="duration_time">
                                <option value="days" @if(isset($form['f3']['selected_value']['duration_time']) && $form['f3']['selected_value']['duration_time'] =='days') selected="" @endif >{{trans("common.days")}}</option>
                                <option value="weeks" @if(isset($form['f3']['selected_value']['duration_time']) && $form['f3']['selected_value']['duration_time'] =='weeks') selected="" @endif>{{trans("common.weeks")}}</option>
                                <option value="months" @if(isset($form['f3']['selected_value']['duration_time']) && $form['f3']['selected_value']['duration_time'] =='months') selected="" @endif>{{trans("common.months")}}</option>
                                <option value="years" @if(isset($form['f3']['selected_value']['duration_time']) && $form['f3']['selected_value']['duration_time'] =='years') selected="" @endif>{{trans("common.years")}}</option>
                            </select>
                        </div>
                    </div>               
                </div>                                                                                    
                @elseif($form['f3']['type']=='select' || $form['f3']['type']=='checkbox' || $form['f3']['type']=='radio')
                <?php
                $select_class = $form['f3']['type'] == 'checkbox' ? 'class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300"' : 'class="form-control m-select2"';
                $selectedoptions = $form['f3']['selected_value'];
                ?>
                <div class="col-md-3 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">

                    <select disabled="" {!! $select_class !!} data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_{{ $custom_id_number }}"  name="custom_fields_filter[{{ $custom_id_number }}][custom_field_value]" >

                        @foreach($form['f3']['options'] as $option)

                        @if($form['f3']['type']=='checkbox')
                            <option @if(in_array($option['value'],$selectedoptions)) selected="" @endif value="{!! $option['value'] !!}">{!! $option['lable'] !!}</option><
                        @else
                            <option @if( (isset($form['f3']['selected_value'][0]) && $form['f3']['selected_value'][0]==$option['value']) || (isset($form['f3']['selected_value']) && $form['f3']['selected_value']==$option['value']) ) selected="" @endif value="{!! $option['value'] !!}">{!! $option['lable'] !!}</option>
                        @endif
                        @endforeach

                    </select>
                </div>

                @elseif($form['f3']['type']=='date')

                <div class="col-md-3 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">                                                                                           
                    <div class="date date-picker" data-date-format="yyyy-mm-dd">
                        <input readonly="" type="text" value="@if(isset($form['f3']['selected_value'])){{ $form['f3']['selected_value'] }}@endif" class="form-control datesystem" placeholder="{{trans('segments.add_new.field.date_field')}}" name="custom_date_field_value" id="custom_field_date_value_{{ $custom_id_number }}" >                
                    </div>
                </div>   
                @elseif($form['f3']['type']=='textarea')
                <div class="col-md-3 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                    <textarea readonly=""  id="custom_field_value_{{ $custom_id_number }}" placeholder="{{trans('segments.add_new.field.comma_separated_list')}}" id="custom_field_value_{{ $form['f3']['id'] }}" class="form-control custom_field_value" name="custom_field_value">@if(isset($form['f3']['selected_value'])) {{ $form['f3']['selected_value'] }} @endif</textarea>
                </div>
                @else

                <div class="col-md-3 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                    <input readonly="" type="text" class="form-control textsystem custom_field_value" value="@if(isset($form['f3']['selected_value'])) {{ $form['f3']['selected_value'] }} @endif" placeholder="Text Field" id="custom_field_value_{{ $form['f3']['id'] }}" name="custom_field_value" >                                                
                </div>

                @endif

            </div>
            <?php
            $custom_id_number++;
            ?>
            @if($totalFleidDiv!=$custom_id_number)
            <script>
                custom_sections++;
            </script>                                                                                
            @endif
            @endforeach
        </div>
    </div>    
</div>