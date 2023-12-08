@extends('layouts.master2')

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/dynamic-content-tags-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <script src="/js/libs/ckeditor/ckeditor.js"></script>
    <script src="/js/libs/ckeditor/plugins/font/plugin.js"></script>
    <script src="/js/libs/ckeditor/plugins/colorbutton/plugin.js"></script>
    <script src="/js/libs/ckeditor/plugins/zsuploader/plugin.js"></script>
    <script src="/js/libs/ckeditor/plugins/smiley/plugin.js"></script>
    <script src="/js/libs/ckfinder/ckfinder.js"></script>

    @if($errors->any())
        <!-- For PHP validations errors-->
        <div class="alert alert-danger" data-name="dxgOzRbY">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="GNnjfDmz">
            {{ Session::get('msg') }}
        </div>
    @endif
    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="maIZsfqH">
    <span id='msg-text'><span>
    </div>
    <!-- BEGIN FORM-->
    <div class="col-md-6 create-form" data-name="LmKVOLZK">
        @if ($page_data['action'] == 'add')
            <form  method="POST" id="dynamic-content-frm" class="kt-form kt-form--label-right" novalidate="novalidate">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" id="id" value="0">
                <input type="hidden" id="action" value="add">
                @else
                    <form  id="dynamic-content-frm" class="kt-form kt-form--label-right" novalidate="novalidate">
                        <input type="hidden" id="action" value="edit">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="id" value="{{$dynamic_content->id}}">
                        <input type="hidden" name="_method" value="PUT">
                        @endif
                        <div class="row" data-name="VWJaDPCz">
                            <div class="kt-portlet kt-portlet--height-fluid" data-name="AqDUMqXc">
                                <div class="kt-portlet__head" data-name="SKXsULgr">
                                    <div class="kt-portlet__head-label" data-name="SdXwLWtK">
                                        <h3 class="kt-portlet__head-title">{{trans('dynamictags.add_new.form.heading')}}</h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body" data-name="DjfNtkee">
                                    <div class="form-body" data-name="tuneBDvZ">
                                        <!-- Name -->
                                        <div class="form-group row" data-name="UMjJhRHu">
                                            <div class="col-md-12" data-name="zQBzGYAA">
                                                <label class="col-form-label">{{trans('dynamictags.add_new.form.name')}}
                                                    {!! popover( 'dynamictags.add_new.form.name_help','common.description' ) !!}
                                                </label>
                                                <div class="input-icon right mt0" data-name="cvASsODx">
                                                    <input type="text" id="content_name" name="content_name" {{isset($dynamic_content->name) ? "readonly" : '' }} value="{{isset($dynamic_content->name) ? $dynamic_content->name : '' }}" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Name -->

                                        <!-- Unit Rules -->
                                        {{--row 1--}}
                                        @if(isset($dynamic_content))
                                            {!! $rule !!}
                                            @else
                                        <div class="form-group row mb0" id="row_1" data-name="kzGBWdBg">
                                            <div class="col-md-12" data-name="nJQMcFxc">
                                                <label class="col-form-label">{{trans('dynamictags.add_new.form.unit_rules')}}
                                                    {!! popover( 'dynamictags.add_new.form.unit_rules_help','common.description' ) !!}
                                                </label>
                                                <div data-repeater-list="unit_rules" data-name="FJiUhkyd">
                                                    <div class="mt-repeater" data-name="NlWEiBsh">
                                                        <div data-repeater-item data-name="vCSJWcvt">
                                                            <div data-repeater-item="" class="mt-repeater-item" data-name="ymFHnXNO">
                                                                <div class="row mt-repeater-item" data-name="IKFPpaHS">
                                                                    <div class="col-md-3" id="unitblock" data-name="rKUUIuhw">
                                                                        <select id="select_field_1"  class="form-control m-select2 select" name="field[]"  data-placeholder="{{ trans('dynamictags.add_new.form.select_an_option') }}">
                                                                            <option value="">{{ trans('dynamictags.add_new.form.select_an_option') }}</option>
                                                                            <option value="custom_fields">{{ trans('dynamictags.add_new.form.custom_field') }}</option>
                                                                            <option value="date">{{ trans('dynamictags.add_new.form.date_field') }}</option>
                                                                            <option value="list">{{ trans('dynamictags.add_new.form.contacts_list') }}</option>
                                                                            <option value="broadcast">{{ trans('dynamictags.add_new.form.email_campaign') }}</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-md-3" data-name="RkswIWXb">

                                                                        <select id="select_field_name_1"  class="form-control m-select2 select_2"  name="field_name[]">
                                                                            {!! $custom_fields_opt !!}
                                                                        </select>

                                                                    </div>
                                                                    <div class="col-md-2" data-name="CACWqpQk">

                                                                        <select id="select_condition_1"  name="condition[]"  class="form-control m-select2 select_3" data-placeholder="{{ trans('dynamictags.add_new.form.select_an_option') }}">
                                                                            <option value="{{ trans('dynamictags.controller.is_option_txt') }}">{{ trans('segments.filter.is') }}</option>
                                                                            <option value="{!! trans('dynamictags.controller.isnt_option_txt') !!}">{!! trans('segments.filter.is_not') !!}</option>
                                                                            <option value="{{ trans('dynamictags.controller.contains_option_txt') }}">{{ trans('segments.filter.contain') }}</option>
                                                                            <option value="{{ trans('dynamictags.controller.doesnt_contains_option_txt') }}">{{ trans('segments.filter.does_not_contain') }}</option>
                                                                        </select>

                                                                    </div>
                                                                    <div class="col-md-3" data-name="GjwYwMDm">
                                                                        <div class="value_1" id="textsystem" data-name="qpTyWgjW">
                                                                            <input type="text" class="form-control textsystem" placeholder="Text Field"  name="values[]" >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-1" data-name="uxtBxaPB">
                                                                        <a href="javascript:;" class="btn btn-danger btn-icon btn-sm btn-cancle">
                                                                            <i class="la la-close"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-repeater-create="" class="btn btn-info btn-icon btn-sm btn-add" onclick="showRow(1)" data-name="JIhFvmFY">
                                                <i class="la la-plus"></i>
                                            </div>
                                        </div>
                                        @endif
                                        <!-- Unit Rules -->

                                        <!-- if criteria -->
                                        <div class="form-group row" data-name="QqcDRQWy">
                                            <div class="col-md-12" data-name="frweVpLA">
                                                <label class="col-form-label">
                                                    {{trans('dynamictags.add_new.form.if_criteria_met')}}
                                                    {!! popover( 'dynamictags.add_new.form.if_criteria_met_help','common.description' ) !!}
                                                </label>
                                                <div class="input-icon right" data-name="DxswlaSU">
                                                    <textarea name="content_html_if" id="content_html_if">{!! isset($dynamic_content)?$dynamic_content->content_html_if:'' !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- if criteria -->

                                        <!-- Insert Variables -->
                                        <div class="customFields" data-name="cBYbCKpG">
                                            @php
                                                $ckeditor_id = 'content_html_if';
                                            @endphp
                                            @if($adminOnClient)
                                                {{ dynamicTags(0, 0, $ckeditor_id,$dynamic_content->user_id) }}
                                                @else
                                            {{ dynamicTags(0, 0, $ckeditor_id) }}
                                                @endif
                                        </div>
                                        <!-- Insert Variables -->

                                        <!-- else criteria -->
                                        <div class="form-group row" data-name="XODezRFO">
                                            <div class="col-md-12" data-name="wNJnBrMn">
                                                <label class="col-form-label">{{trans('dynamictags.add_new.form.else')}}
                                                    {!! popover( 'dynamictags.add_new.form.else_help','common.description' ) !!}
                                                </label>
                                                <div class="input-icon right" data-name="XRKRuuLv">
                                                    <textarea name="content_html_then" id="content_html_then">{!! isset($dynamic_content)?$dynamic_content->content_html:'' !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- else criteria -->

                                        <!-- Insert Variables -->                                        
                                        <div class="customFields" data-name="NVfedCof">
                                            @php
                                                $ckeditor_id2 = 'content_html_then';
                                            @endphp
                                            @if($adminOnClient)
                                                {{ dynamicTags(0, 0, $ckeditor_id2,$dynamic_content->user_id) }}
                                            @else
                                                {{ dynamicTags(0, 0, $ckeditor_id2) }}
                                            @endif
                                        </div>
                                        <!-- Insert Variables -->

                                    </div>
                                </div>
                                <div class="kt-portlet__foot" data-name="oBbtRUlk">
                                    <div class="form-group row" data-name="KwujSyay">
                                        <div class="col-md-12" data-name="HoLNxmCs">
                                            <!-- submit -->
                                            <button id="submit" name="" class="btn btn-success" value="">{{trans('common.form.buttons.submit')}}</button>
                                            <!-- reset -->
                                            <button type="reset" id="reset" class="btn btn-default">{{trans('common.form.buttons.reset')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
    </div>
    <!-- END FORM-->

    <script>
        CKEDITOR.replace( 'content_html_if', {
            fullPage: true,
            allowedContent: true,
            height: 180
        });
        CKEDITOR.replace( 'content_html_then', {
            fullPage: true,
            allowedContent: true,
            height: 180
        });
        // enter work as <br> instead <p>
        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
        // CKFinder.setupCKEditor( editor );
        CKEDITOR.config.extraPlugins = 'preview,font,colorbutton,justify,bidi,language';
        CKEDITOR.config.language_list = ['en:English','ar:Arabic:rtl', 'fr:French', 'he:Hebrew:rtl', 'es:Spanish'];
        CKEDITOR.config.defaultLanguage = 'en';
    </script>
@endsection

@section('page_scripts')
    <script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
    <script src="/themes/default/js/init.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
    <script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/datepicker-init.js" type="text/javascript"></script>
    <script src="/themes/default/js/lib.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.input.js" type="text/javascript"></script>
    <script src="/themes/default/js/repeater.js" type="text/javascript"></script>
    <script>
        var form_error="{{trans('common.message.form_error')}}";
        localStorage.removeItem("id");
        @if(isset($storage_var) && $storage_var>1)
        localStorage.setItem("id", {{$storage_var}});
            @endif
    </script>
    {{--<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>--}}
    {{--    <script src="/themes/default/js/includes/dynamic_content.js" type="text/javascript"></script>--}}
    <script>
        // select third dropdown in unit rules
        $(document).on('change', '.select_3', function() {
            select_con_id = this.id;
            string_id = select_con_id.substring(17);
            div_class = 'value_'+string_id;
            select_field_name_id = '#select_field_name_'+string_id;
            val = this.value;
            hd = 'hd_'+string_id
            $('.' + div_class).addClass(hd);
            if($(select_field_name_id).hasClass('dt'))
            {
                if( (val==='after' || val==='before' || val==='exactly')) {
                    div = '<div class="'+div_class+'" >\n' +
                        '<input  type="text" class="form-control datesystem textsystem" placeholder="{{ trans('dynamictags.add_new.form.date_field') }}" id="" name="values[]">\n' +
                        '</div>';
                    $('.' + div_class).after(div);
                    $('.'+hd).remove();
                    $(".datesystem").datepicker({
                        format: 'yyyy-mm-dd',
                        //endDate: '+0d',
                        autoclose: true
                    });
                }
                else if(val==='occurred_before' || val==='for_the_past' || val === 'older_than' || val ==='occurred_after')
                {
                    div = '<div class="'+div_class+'" id="step3_6">\n' +
                        '<div class="datetype22">\n' +
                        '<input type="number"  class="form-control textsystem" id="" name="values[]" placeholder="Text Field">\n' +
                        '</div>\n' +
                        '<div class="datetype33">\n' +
                        '<select  class="form-control multopt2 m-select2" name="values[]" data-placeholder="{{ trans('dynamictags.add_new.form.select_an_option') }}">\n' +
                        '<option value="minutes" >{{ trans("common.minutes")}}</option>\n' +
                        '<option value="days" >{{ trans("common.days")}}</option>\n' +
                        '<option value="weeks" >{{ trans("common.weeks")}}</option>\n' +
                        '<option value="months" >{{ trans("common.months")}}</option>\n' +
                        '<option value="years" >{{ trans("common.years")}}</option>\n' +
                        '</select>'+
                        '</div>\n' +
                        '</div>';
                    $('.' + div_class).after(div);
                    $('.'+hd).remove();
                    $('.m-select2').select2({
                        templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                    });
                }
                else if(val==='between')
                {
                    div = '<div class="'+div_class+'" >\n' +
                        '<div class="input-group date form_datetime bs-datetime" id="datetimepicker-geo" data-date="" data-date-format="yyyy-mm-dd">\n' +
                        '<div class="input-daterange input-group dategroupmap">\n' +
                        '<input  type="text" class="form-control cfrom textsystem" name="values[]" readonly="" data-date-format="yyyy-mm-dd">\n' +
                        '<div class="input-group-append"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>\n' +
                        '<input  type="text" class="form-control cto textsystem" readonly="" name="values[]"  data-date-format="yyyy-mm-dd">\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>';
                    $('.' + div_class).after(div);
                    $(".cfrom, .cto").datepicker();
                    $('.'+hd).remove();
                }
            }
        });
        // select second dropdown in unit rules
        $(document).on('change', '.select_2', function() {
            var id_c = null;
            countries = '{!! $cont_options !!}'
            select_id = this.id;
            string_id = select_id.substring(18);
            hd = 'hd_'+string_id;
            div_class = 'value_'+string_id;
            $('.'+div_class).addClass(hd);
            if(this.value==='gender')
            {
                div = '<div class="'+div_class+'">\n' +
                    '<div class="kt-repeater-input kt-radio-inline">\n' +
                    '<label class="kt-radio">\n' +
                    '<input  type="radio" name="values[]" id="optionsRadios25" value="Male"> Male\n' +
                    '<span></span>\n' +
                    '</label>\n' +
                    '<label class="kt-radio">\n' +
                    '<input  type="radio" name="values[]" id="optionsRadios26" value="Female"> Female\n' +
                    '<span></span>\n' +
                    '</label>\n' +
                    '</div>\n' +
                    '</div>';
                $('.'+div_class).after(div);
                $('.'+hd).remove();
            }
            else if(this.value==='mobile')
            {
                div = '<div class="'+div_class+'" >\n' +
                    '<input  type="tel" name="values[]" id="mobile" class="form-control">\n' +
                    '</div>';
                $('.'+div_class).after(div);
                $('.'+hd).remove();
                $("#mobile").intlTelInput({
                    placeholderNumberType: "MOBILE",
                    separateDialCode: true,
                    utilsScript: '{{ URL("/public/js/utils.js") }}'
                });
                var mobnum = $("#mobile").val();
                var codd = $('#ccode').val();
                $("#mobile").intlTelInput("setNumber", "+" +codd);
                $("#mobile").val(mobnum);
                $("#mobile").on("countrychange", function (e, countryData) {
                    $("#ccode").val(countryData.dialCode);
                });
            }
            else if(this.value==='country')
            {
                div = '<div class="'+div_class+'" >\n' +
                    countries +
                    '</div>';
                $('.'+div_class).after(div);
                $('.m-select2').select2({
                    templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                });
                $('.'+hd).remove();
            }
            else {
                div = '<div class=" '+div_class+'" >\n' +
                    '<input  type="text" class="form-control textsystem" placeholder="Text Field" name="values[]">\n' +
                    '</div>';
                $('.'+div_class).after(div);
                $('.'+hd).remove();
            }
        });

        // add Unit Rules
        function showRow(id)
        {
            var id_c = null;
            vall = $('.select_2').val();
            local_id =  localStorage.getItem("id");
            if(local_id!==null)
                id = parseInt(local_id);
            id_ = id+1;
            localStorage.setItem("id", id_);
            current_div_id = '#row_'+id;
            next_div_id = '#row_'+id_;
            row_id = 'row_'+id_;
            select_field_id = 'select_field_'+id_;
            select_field_name_id = 'select_field_name_'+id_;
            select_condition_id = 'select_condition_'+id_;
            value_class = 'value_'+id_;
            showR = "showRow("+id_+")";
            hideR = "hideRow('"+next_div_id+"')";
            div = '<div class="form-group row mb0" id="'+row_id+'">\n' +
                '<div class="col-md-12">\n' +
                '<label class="col-form-label">{{trans('dynamictags.add_new.form.unit_rules')}}</label>\n' +
                '<div data-repeater-list="unit_rules">\n' +
                '<div class="mt-repeater">\n' +
                '<div data-repeater-item="">\n' +
                '<div data-repeater-item="" class="mt-repeater-item">\n' +
                '<div class="row mt-repeater-item">\n' +
                '<div class="col-md-3">\n' +
                '<select  id="'+select_field_id+'" class="form-control m-select2 select" name="field[]" data-placeholder="Select an option">\n' +
                '<option value="">{{ trans('dynamictags.add_new.form.select_an_option') }}</option>\n' +
                '<option value="custom_fields">{{ trans('dynamictags.add_new.form.custom_field') }}</option>\n' +
                '<option value="date">{{ trans('dynamictags.add_new.form.date_field') }}</option>\n' +
                '<option value="list">{{ trans('dynamictags.add_new.form.contacts_list') }}</option>\n' +
                '<option value="broadcast">{{ trans('dynamictags.add_new.form.email_campaign') }}</option>\n' +
                '</select>\n' +
                '</div>\n' +
                '<div class="col-md-3">\n' +
                '<select  id="'+select_field_name_id+'" class="form-control m-select2 select_2" name="field_name[]">\n' +
                '{!! $custom_fields_opt !!}' +
                '</select>\n' +
                '</div>\n' +
                '<div class="col-md-2">\n' +
                '<select  id="'+select_condition_id+'" name="condition[]" class="form-control m-select2 select_3" data-placeholder="{{ trans('dynamictags.add_new.form.select_an_option') }}">\n' +
                '<option value="is">{{ trans('segments.filter.is') }}</option>\n' +
                '<option value="isn\'t">{{ trans('segments.filter.is_not') }}</option>\n' +
                '<option value="contains">{{ trans('segments.filter.contain') }}</option>\n' +
                '<option value="doesn\'t contain">{{ trans('segments.filter.does_not_contain') }}</option>\n' +
                '</select>\n' +
                '</div>\n' +
                '<div class="col-md-3">\n' +
                '<div class="'+value_class+'" >\n' +
                '<input  type="text" class="form-control textsystem" placeholder="Text Field" name="values[]">\n' +
                '</div>\n'  +
                '</div>\n' +
                '<div class="col-md-1">\n' +
                '<a href="javascript:;" onclick="'+hideR+'" class="btn btn-danger btn-icon btn-sm">\n' +
                '<i class="la la-close"></i>\n' +
                '</a>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>\n' +
                '</div>';
            $(current_div_id).after(div);
            $(next_div_id).hide();
            $(next_div_id).slideDown('slow');
            $('.m-select2').select2({
                templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
            });
            $('.selected').each(function(i, obj) {
                selected = obj.selected;
                if(selected)
                    id_c = obj.getAttribute('cf');
                if(i!==0) {
                    /*      if (id_c !== null)
                              $('option[cf="' + id_c + '"]').attr("disabled", true);*/
                }
            });
        }
        // hide Unit Rules
        function hideRow(id)
        {
            $(id).slideUp('slow');
            setTimeout(function(){ $(id).empty(); }, 1000);
        }
        // select first dropdown in unit rules
        $(document).on('change', '.select', function() {
            conditions = "<option value=\"{{ trans('dynamictags.controller.is_option_txt') }}\">{{ trans('segments.filter.is') }}</option>\n" +
                "<option value=\"{!! trans('dynamictags.controller.isnt_option_txt') !!}\">{!! trans('segments.filter.is_not') !!}</option>\n" +
                "<option value=\"{{ trans('dynamictags.controller.contains_option_txt') }}\">{{ trans('segments.filter.contain') }}</option>\n" +
                "<option value=\"{{ trans('dynamictags.controller.doesnt_contains_option_txt') }}\">{{ trans('segments.filter.does_not_contain') }}</option>";
            var id_c = null;
            select_value = this.value;
            select_id = this.id;
            //$('#'+select_id).attr("disabled",true);
            custom_fields = '{!!$custom_fields_opt!!}';
            lists = '{!!$listOptions!!}';
            broadcasts = '{!!$campOptions!!}';
            date = '{!!$date_options!!}';
            string_id = select_id.substring(13);
            select_field_name = '#select_field_name_' + string_id;
            select_condition = '#select_condition_' + string_id;
            div_class = 'value_'+string_id;
            hd = 'hd_'+string_id
            $('.'+div_class).addClass(hd);
            div = '<div class=" '+div_class+'" >\n' +
                '<input  type="text" class="form-control textsystem" placeholder="Text Field" name="values[]">\n' +
                '</div>';
            $('.'+div_class).after(div);
            $('.'+hd).remove();
            $(select_field_name).removeClass('dt');
            if(select_value=='custom_fields')
                options = custom_fields;
            else if(select_value=='list')
                options = lists;
            else if(select_value=='broadcast')
                options = broadcasts;
            else {
                options = date;
                $(select_field_name).addClass('dt');
                conditions = '<option value="">{{ trans('dynamictags.add_new.form.select_an_option') }}</option><option value="after">{{ trans('segments.filter.after') }}</option>\n' +
                    '<option value="before">{{ trans('segments.filter.before') }}</option>\n' +
                    '<option value="exactly">{{ trans('segments.filter.exactly') }}</option>\n' +
                    '<option value="between">{{ trans('segments.filter.between') }}</option>\n' +
                    '<option value="occurred_before">{{ trans('segments.filter.occurring_before') }}</option>\n' +
                    '<option value="occurred_after">{{ trans('segments.filter.occurred_after') }}</option>\n' +
                    '<option value="for_the_past">{{ trans('segments.filter.for_the_past') }}</option>\n' +
                    '<option value="older_than">{{ trans('segments.filter.older_than') }}</option>';
            }

            if(options!==undefined) {
                $(select_field_name).children().remove();
                $(select_condition).children().remove();
                $(select_condition).append(conditions);
                $(select_field_name).append(options);
            }
            $('.selected').each(function(i, obj) {
                selected = obj.selected;
                if(selected)
                    id_c = obj.getAttribute('cf');
                if(i!==0) {
                }
            });

        });

        $(document).ready(function() {
            $(".m-select2").select2({
                placeholder: "Select option",
                class:"select",
                allowClear: true,
                templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
            });
            $("#datesystem").datepicker({
                format: 'yyyy-mm-dd',
                //endDate: '+0d',
                autoclose: true
            }).datepicker();
            $("input.from").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            }).datepicker();
            $("input.to").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            }).datepicker();
            $('#content_name').keypress(function( e ) {
                if(e.which === 32)
                    return false;
            });
            $('#content_name').keyup(function()
            {
                var yourInput = $(this).val();
                re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
                var isSplChar = re.test(yourInput);
                if(isSplChar)
                {
                    var no_spl_char = yourInput.replace(/[`~!@#$%^&*()|+\_=?;:' ",.<>\{\}\[\]\\\/]/gi, '');
                    $(this).val(no_spl_char);
                }
            });
        });

        var dynamic_id = 0;

        function changeselect2(){

            dynamic_id++;
            window.setTimeout(function () {
                $(".select-change").last().attr('id','main_opt_'+dynamic_id);
                $("#main_opt_"+dynamic_id).select2({
                    placeholder: "Select Option",
                    templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                });
                $(".select-change2").last().attr('id','main_opt2_'+dynamic_id);
                $("#main_opt2_"+dynamic_id).select2({
                     templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                });

                $(".select-change3").last().attr('id','main_opt3_'+dynamic_id);
                $("#main_opt3_"+dynamic_id).select2({
                     templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                });

                $(".select-change4").last().attr('id','main_opt4_'+dynamic_id);
                $("#main_opt4_"+dynamic_id).select2({
                     templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                });

                $(".select-change5").last().attr('id','main_opt5_'+dynamic_id);
                $("#main_opt5_"+dynamic_id).select2({
                     templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                });

                $(".select-change6").last().attr('id','main_opt6_'+dynamic_id);
                $("#main_opt6_"+dynamic_id).select2({
                     templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                });

                $(".select-change7").last().attr('id','main_opt7_'+dynamic_id);
                $("#main_opt7_"+dynamic_id).select2({
                    templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  } 
                });
            }, 100);
        }
        // select system variable & additional variable
        function selectTag(field, ckeditor_id) {
            if(field == 'Unsubscribe Link')
                field = '<a href="%%unsubscribelink%%">{{trans('common.label.unsubscribe')}}</a>';
            else if(field == 'Confirm Link')
                field = '<a href="%%confirmurl%%">{{trans('common.label.confirm')}}</a>';
            else
                field = '%%'+field+'%%';

            CKEDITOR.instances[ckeditor_id].insertHtml(field);
        }
        // select spintag
        function selectSpintag(spintag, ckeditor_id) {
            spintag = '{'+'{'+spintag+'}'+'}';
            CKEDITOR.instances[ckeditor_id].insertText(spintag);
        }
        // select dynamic content tag
        function selectDynamicContent(dynamic_content, ckeditor_id) {
            dynamic_content = dynamic_content;
            CKEDITOR.instances[ckeditor_id].insertText(dynamic_content);
        }

        $('#copy-email').click(function() {
            var content_html = CKEDITOR.instances['content_html'].getSnapshot();
            // replace <br> with \n for text content
            var content = content_html.replace(/<br\s*\/?>/mg,"\n");

            // remove all the other html tags for text content
            var regex = /(<([^>]+)>)/ig
            var content = $.trim(content.replace(regex, ""));
            $('#content_text').html(content);
        });
    </script>
    <script>
        $('#content-unit-frm').submit(function(){
            CKEDITOR.instances.content_html.updateElement();
            var form_data = $("#content-unit-frm").serialize();
            $.ajax({
                url: "{{ URL::route('dynamictag.content.unit') }}",
                type: 'POST',
                data: form_data,
                success: function(result) {
                    $('#unit-of-content').modal('hide'),
                        $("#appendata").html(result);
                }
            });
            return false;
        });

        // $(window).on("load", GetAllProperties);
        function GetAllProperties() {
            $.ajax({
                url: "{{ URL::route('dynamictag.content.unit') }}",
                type: 'Delete',
                data    : {delete_action : 'delete_all'},
                success: function (result) {
                }
            });
        }

        function EditBlock(id , action_type)
        {
            $.ajax({
                url: "{{ URL::route('dynamictag.content.unit') }}",
                type: 'GET',
                data    : {type: 'edit_form_data' , content_id : id , action : action_type},
                dataType: "JSON",
                success: function (response) {
                    var unit_content = JSON.parse( response.data );
                    if(unit_content.is_default == 1){
                        $('.default-checkbox').prop('checked', true);
                    }
                    $('#label').val(unit_content.label);
                    $('#id').val(unit_content.id);
                    CKEDITOR.instances.content_html.setData(unit_content.content_html);
                    $("#append-rules").html(response.html);
                    $("#unit-of-content").modal('show');
                }
            });
        }

        function DeleteBlock(id , action_type , dynamic_content_id)
        {
            $.ajax({
                url: "{{ URL::route('dynamictag.content.unit') }}",
                type: 'Delete',
                data    : {content_id : id ,action_type : action_type , dynamic_content_value : dynamic_content_id},
                success: function (result) {
                    $("#appendata").html(result);
                }
            });
        }
        // cleae modal values on close
        $('#unit-of-content').on('hidden.bs.modal', function () {
            $('.modal-body').find('#label,#id,#unit-rule-condition').val('');
            $(".modal-body").find('input:checkbox').prop('checked', false);
            $(".modal-body").find("option:selected").removeAttr("selected");
            CKEDITOR.instances.content_html.setData('');
        });
    </script>
    <script type="text/javascript">

        var KTFormRepeater = function() {
            var demo1 = function() {
                $('#kt_repeater_3').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function() {
                        $(this).slideDown();
                    },

                    hide: function(deleteElement) {
                        if(confirm('{{ trans('common.message.delete_warning')}}')) {
                            $(this).slideUp(deleteElement);
                        }
                    }
                });
            }
            return {
                init: function() {
                    demo1();
                }
            };
        }();

        jQuery(document).ready(function() {
            KTFormRepeater.init();
            window.setTimeout(function () {
                $("#main_opt, #main_opt2, #main_opt3,#main_opt4, #main_opt5, #main_opt6, #main_opt7").select2({
                     templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                });
            }, 100);
        });

        function CKupdate(){
            for ( instance in CKEDITOR.instances ){
                CKEDITOR.instances[instance].updateElement();
                CKEDITOR.instances[instance].setData('');
            }
        }

        function createOrUpdate(method,route,formId,rules,messages) {
            $('.listo').attr('disabled',false);
            $(formId).validate({
                rules: {
                    content_name: {
                        required: !0
                    }
                },
                messages: messages,
                invalidHandler: function (e) {
                    toastr.error("{{trans('dynamictags.create_blade.error_occurred_return')}}");
                },
                submitHandler: function () {

                    data = $(formId).serialize();
                    $.ajax({
                        type: method,
                        url: route,
                        data: data,
                        cache: false,
                        dataType: 'json',
                        beforeSend: function() {
                            //$("#preloader").show();
                        },
                        success: function (data) {

                            if (data.status) {
                                $('#modal-group-label').hide();
                                toastr.success(data.message);
                                $("#select_field_1").val(null).trigger('change');
                                $("#select_field_name_1").val(null).trigger('change');
                                $("#select_condition_1").val(null).trigger('change');
                                CKupdate();
                                // if(method=='POST') {
                                    // $(formId).trigger("reset");
                                    setTimeout(function(){
                                        window.location = "{{route('dynamictag.index')}}";
                                    }, 1500);
                                // }
                            }
                            else
                                toastr.error(data.message);
                            return false;
                        }
                    });
                    $('.listo').attr('disabled',false);
                    $('.selected').each(function(i, obj) {
                        selected = obj.selected;
                        if(selected)
                            id_c = obj.getAttribute('cf');
                        if(i!==0) {
                  
                        }
                    });
                }
            });
        }


        $(document).ready(function () {

            $("#reset").click(function() {
                CKupdate();
                $(".m-select2").val('').trigger('change');;
                $(formId).trigger("reset");
            });

            $("#submit").click(function () {
                
                var unit_rule = $("#select_field_1").val();
                var name = $("#content_name").val();
                var textfield = $(".textsystem").val();

                if(name == ""){
                    $("#content_name").addClass("is-invalid");
                    toastr.error("{{trans('dynamictags.create_blade.error_occurred_return')}}");
                    return false;
                } else if(unit_rule == ""){
                    $("#content_name").removeClass("is-invalid");
                    $("#unitblock").addClass("unitblock");
                    toastr.error("{{trans('dynamictags.create_blade.error_occurred_return')}}");
                    return false;
                } else if(textfield == "" || textfield == undefined){
                    $("#content_name").removeClass("is-invalid");
                    $("#unitblock").removeClass("unitblock");
                    $(".textsystem").addClass("is-invalid");
                    toastr.error("{{trans('dynamictags.create_blade.error_occurred_return')}}");
                    return false;
                } else {
                    $("#content_name").removeClass("is-invalid");
                    $("#unitblock").removeClass("unitblock");
                    $(".textsystem").removeClass("is-invalid");
                    formId = "#dynamic-content-frm";
                    method = "POST";
                    route = '{{route('dynamictag.save')}}';
                    id = $("#id").val();
                    if(id>0) {
                        method = "PUT";
                        route = '{{route('dynamictag.update',isset($dynamic_content)?$dynamic_content->id:'')}}';
                    }

                    messages = {};
                    rules = {};
                    createOrUpdate(method, route, formId, rules, messages);
                }
            });
        });
    </script>
@endsection