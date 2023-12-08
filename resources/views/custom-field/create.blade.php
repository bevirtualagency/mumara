@extends(decide_template())

@section('title', $title)

@section('page_styles')
<link href="/resources/assets/css/custom-fields-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
    .error{
        color: #FF0000;
    }
    .edit.readonly .select2-container {
        pointer-events: none;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
   var form_error="{{trans('common.message.form_error')}}";
   var forbidden_error="{{trans('custom_fields.alert.forbidden')}}";

    var list_count_id = 0;
    var lists_ids = [];

    $(document).ready(function() {

        $("#sync_fields").click(function() {
            if($(this).prop("checked") == true){
                $(".check-custom-message").slideDown();
            }
            else if($(this).prop("checked") == false){
                $(".check-custom-message").slideUp();
            }
        }); 

        $('.m-select2').select2({
            placeholder: "Select option",
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
        setInterval(function () {
            if (list_count_id == 1) {
                getSegmentCountStatus('get_status',lists_ids);
            }
        }, 5000);
        $("#counting").click(function() {
            $.each($("input[name='lists[]']"), function(){            
                lists_ids.push($(this).val());
            });
            if(list_count_id>0){
                $(".countsload").show();
                $(".counts").hide();
                $("a.button-next").attr("disabled", "disabled");
                $("#counting").attr('disabled',true);
                getSegmentCountStatus('count_status',lists_ids);
            }
        });
    });
</script><script>
    var storeUrl = "{{route('fields.store')}}";
    var updateUrl = "{{route('fields.update','')}}/";
    var createUrl = "{{route('fields.create')}}";
    var indexUrl = "{{route('fields.index')}}";
    var editUrl = "{{route('fields.edit','|id|')}}/";
    var alphaError = "{{trans('custom_fields.alert.alpha')}}";
    var mixError = "{{trans('custom_fields.alert.mix')}}";
</script>
<script src="/themes/default/js/custom_field.js?v={{time()}}" type="text/javascript"></script>
<script src="/themes/default/js/common.js" type="text/javascript"></script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="bJbCtNdC">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="MFEASMeX">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="wUlmFIlg">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="col-md-6 create-form" data-name="EoUCWIdE">
    <!-- BEGIN FORM-->
    <form action="" method="POST" id="custom-field-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if($action == 'add')
            <input type="hidden" id="action" value="add">
        @else
            <input type="hidden" id="action" value="edit">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" id="custom-field-id" value="{{$custom_field->id}}">
        @endif
        <div class="row" data-name="YkrXSidZ">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="hgjVRQYJ">
                <div class="kt-portlet__head" data-name="vtaoGJDL">
                    <div class="kt-portlet__head-label" data-name="YlFWsCgb">
                        <h3 class="kt-portlet__head-title">{{trans('custom_fields.add_new.form.title')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="KeStsiMD">
                    <div class="form-body" data-name="NsOreXMD">
                        <div class="form-group row" data-name="QBDtKkOb">
                                
                            <div class="col-md-6" data-name="UJhsnPHj">
                                <label class="col-form-label">{{trans('custom_fields.add_new.field.name')}}
                                    <span class="required"> * </span>
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('custom_fields.add_new.field.name_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                </label>
                                <div class="input-icon right" data-name="CunTCPpi">
                                    <input type="text" id="nameDB" name="name" class="form-control" value="{{isset($custom_field->name) ? $custom_field->name : '' }}" {{ isset($custom_field->is_default) && $custom_field->is_default == 1 ? 'readonly' : '' }} {{ $action != 'add' ? 'readonly' : '' }} /> 
                                    <span id="nameDBError" class="error" style="display: none;">{{trans('custom_fields.add_new.form.check_alphanumeric')}}</span>
                                </div>
                            </div>
                            <div class="col-md-6" data-name="ibVmdPco">
                                <label class="col-form-label">{{trans('custom_fields.add_new.field.field_order')}}
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('custom_fields.add_new.field.field_order_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                </label>
                                <div class="input-icon right" data-name="RXBIGNaJ">
                                    <input type="text" name="field_order" class="form-control" value="{{isset($custom_field->field_order) ? $custom_field->field_order : '' }}" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="FFWqMpOG">
                                
                            <div class="col-md-6 edit {{ $action != 'add' ? 'readonly' : '' }}" data-name="ipPWVWEP">
                                <label class="col-form-label">{{trans('custom_fields.add_new.field.field_type')}}
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('custom_fields.add_new.field.field_type_help')}}" data-original-title="{{trans('common.description')}}"></i>

                                </label>
                                <select class="form-control m-select2 {{ $action != 'add' ? 'readonly' : '' }}" name="type" id="type-id">
                                    @foreach($fields_type as $key => $value)
                                        <option value="{{ $key }}" {{(isset($custom_field->type)  && $custom_field->type == $key) ? 'selected' : '' }} >{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6" data-name="NoPqNVWY">
                                <label class="col-form-label" >{{trans('custom_fields.add_new.field.required')}}
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('custom_fields.add_new.field.required_help')}}" data-original-title="{{trans('common.description')}}"></i>

                                </label>
                                <select class="form-control" name="is_required">
                                    <option value="0" {{(isset($custom_field->is_required)  && $custom_field->is_required == 0) ? 'selected' : '' }}>
                                        {{trans('common.form.buttons.no')}}
                                    </option>
                                    <option value="1" {{(isset($custom_field->is_required)  && $custom_field->is_required == 1) ? 'selected' : '' }}>
                                        {{trans('common.form.buttons.yes')}}
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" id="list-of-values" data-name="nqKfmjer">
                            <div class="col-md-12" data-name="bHtWgpWY">
                                <label class="col-form-label">{{trans('custom_fields.add_new.field.list_of_values')}}
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('custom_fields.add_new.field.list_of_values_help')}}" data-original-title="{{trans('common.description')}}"></i>

                                </label>
                                <div class="input-icon right" data-name="ADFUimeZ">
                                    <textarea name="options" class="form-control" rows="5">{{isset($custom_field->options) ? $custom_field->options : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="IjUwmEdI">
                                
                            <div class="col-md-12" data-name="JebvJaur">
                                <label class="col-form-label">
                                    {{trans('custom_fields.add_new.field.contact_list')}}
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('custom_fields.add_new.field.contact_list_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                </label>
                                <div class="scroller scroll scroll-300 kt-checkbox-list" data-name="oflzVxbw">
                                    @foreach ($list_tree as $group_metadata)
                                        <div style="padding: 5px 0;" data-name="ZTACLmQL">
                                            <label class="kt-checkbox">
                                                <input class="group-selector-subscriber" type="checkbox" value="" id="{{ $group_metadata['id'] }}" name="list_group_tab1[]"> <strong>{{ $group_metadata['name'] }}</strong>
                                                <span></span>
                                            </label>
                                        </div>
                                        @foreach ($group_metadata['children'] as $list_metadata)
                                            <div style="padding-left: 20px;" data-name="DVmydzIO">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" value="{{ $list_metadata['id'] }}" name="lists[]" class="group-subscriber-{{ $group_metadata['id'] }}" {{(isset($list_ids) && in_array($list_metadata['id'], $list_ids)) ? 'checked' : '' }}> {{ $list_metadata['name'] }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb0" data-name="ywyNhnXA">
                            <div class="col-md-12" data-name="lLrpiUEo">
                                <div class="kt-checkbox-list mt15" data-name="OQHXboGT">
                                    <label class="kt-checkbox">
                                        <input type="checkbox" value="1" name="sync_fields" id="sync_fields"> {{trans('custom_fields.add_new.form.check_list')}}
                                        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('common.label.check_list_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                        <span></span>
                                    </label>
                                </div>
                                <div class="check-custom-message text-danger" data-name="XcVVGtUl">
                                    <small><b>{{trans('custom_fields.add_new.form.check_list_message_note')}}</b>: {{trans('custom_fields.add_new.form.check_list_message')}}</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="WDctplmR">
                    <div class="row" data-name="FpWdVFbD">
                        <div class="col-md-12" data-name="WVtqGXZV">
                            <button type="submit" name="save_add" class="btn btn-success" value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                            @if($action == 'add')
                            <button type="submit" name="save_add" class="btn btn-success" value="save_exit">{{trans('common.form.buttons.save_exit')}}</button>
                            @else
                            <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                            @endif
                            <a href="{{ route('fields.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
</div>
@endsection