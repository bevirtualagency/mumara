@extends('layouts.master2')

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/dynamic-content-tags-create.css?v={{$local_version}}?v=1" rel="stylesheet" type="text/css">
<link href="/themes/default/css/sweetalert2.min.css" rel="stylesheet" type="text/css">
<link href="/themes/default/css/bootstrap-timepicker.css" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/profile.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>.kt-portlet__foot a.btn {margin-right: 1px;}.kt-portlet .kt-portlet__foot {padding: 25px!important;margin-top: 0;}</style>
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
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success">
            {{ Session::get('msg') }}
        </div>
    @endif
    <div id="content_js" style="display: none"></div>
    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide">
    <span id='msg-text'><span>
    </div>
    <!-- BEGIN FORM-->
    <div class="col-md-6 create-form">
        <form method="POST" id="dynamic-content-frm" class="kt-form kt-form--label-right" novalidate="novalidate">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" id="dynamic_tag_id" value="{{isset($dynamic_content) ? $dynamic_content->id:'0'}}">
            <div class="row">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">{{isset($dynamic_content) ? trans('dynamictags.add_new.form.edit_title') :trans('dynamictags.add_new.form.add_title')}}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <div class="form-body">
                            <!-- Name -->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">{{trans('dynamictags.add_new.form.name')}}
                                        {!! popover( 'dynamictags.add_new.form.name_help','common.description' ) !!}
                                    </label>
                                    <div class="input-icon right mt0">
                                        <input type="text" id="tag_name"  name="content_name" {{isset($dynamic_content->name) ? "disabled" : '' }} value="{{isset($dynamic_content) ? $dynamic_content->name : '' }}" class="form-control"/>
                                        <small>{{trans('dynamictags.add_new.form.name_help_bottom')}}</small>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <div class="kt-radio-inline">
                                        <label  class="kt-radio">
                                            <input  @if($return_content=='return_single_content') checked @endif type="radio" name="return_content" value="return_single_content" >
                                            {{trans('dynamictags.return_content.single')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input @if($return_content=='return_all_content') checked @endif  type="radio" name="return_content" value="return_all_content" >
                                            {{trans('dynamictags.return_content.all')}}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <!-- Name -->

                            <!-- Unit Rules -->
                            {{--row 1--}}

                            <!-- Unit Rules -->
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label class="col-form-label">
                                        {{trans('dynamictags.add_new.form.if_criteria_met')}}
                                        {!! popover( 'dynamictags.add_new.form.if_criteria_met_help','common.description' ) !!}
                                    </label>
                                    <label class="col-form-label text-right pull-right" >
                                        <a href="javascript:;" onclick="displayModal()">[+] {{trans('dynamictags.add_blade.add_unit_action')}} </a>
                                    </label>
                                    <div class="input-icon right">
                                        <div class="form-control scroll scroll-365" style="height:370px" name="content_rules"
                                             id="content_rules">
                                            <ul class="" id="sortable">
                                                {!! isset($str) ? $str : '' !!}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot">
                       <!-- submit -->
                       <a href="javascript:;" onclick="testing()"  class="btn btn-success">{{trans('common.form.buttons.save')}}</a>
                        <!-- reset -->
                        <a href="/dynamictags" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('dynamictags.add_new.form.heading')}}</h5>
                </div>
                <div class="modal-body scroll scroll-600">
                    <form id="add_rule_form">
                        <div class="form-group first-row">
                            <label for="rule_name" class="col-form-label">{{trans('dynamictags.add_new.form.title')}}</label>
                            <input type="text" class="form-control" id="rule_name" name="rule_name">
                        </div>
                        <span class="repeater-popup-block" >
                            <div class="form-group row mb0" id="row_1">
                                <div class="col-md-12">
                                    <label class="col-form-label">{{trans('dynamictags.add_new.form.unit_rules')}}
                                        {!! popover( 'dynamictags.add_new.form.unit_rules_help','common.description' ) !!}
                                    </label>
                                    <div data-repeater-list="unit_rules">
                                        <div class="mt-repeater">
                                            <div data-repeater-item>
                                                <div data-repeater-item="" class="mt-repeater-item">
                                                    <div class="row mt-repeater-item" id="rep">
                                                        <div class="col-md-3">
                                                            <select id="select_field_1"
                                                                    class="form-control m-select2 select" name="field[]"
                                                                    data-placeholder="{{ trans('dynamictags.add_new.form.select_an_option') }}">
                                                                <optgroup label="{{trans('dynamictags.opt.recipient')}}">
                                                                    <option value="custom_fields">{{ trans('dynamictags.opt.profile') }}</option>
                                                                    <option value="email">{{ trans('dynamictags.opt.email') }}</option>
                                                                    <option value="member_of">{{ trans('dynamictags.opt.member_of') }}</option>
                                                                    <option value="confirmation">{{ trans('dynamictags.opt.confirmation') }}</option>
                                                                    <option value="created_at">{{ trans('dynamictags.opt.created_at') }}</option>
                                                                    <option value="list_name">{{ trans('dynamictags.opt.list_name') }}</option>
                                                                </optgroup>
                                                                  <optgroup label="{{trans('dynamictags.opt_grp.timeDate')}}">
                                                                      <option value="now">{{ trans('dynamictags.opt.now') }}</option>
                                                                      <option value="today">{{ trans('dynamictags.opt.today') }}</option>
                                                                      <option value="day">{{ trans('dynamictags.opt.day_of_month') }}</option>
                                                                      <option value="day_of_week">{{ trans('dynamictags.opt.week') }}</option>
                                                                      <option value="this_month">{{ trans('dynamictags.opt.month') }}</option>
                                                                  </optgroup>
                                                                <optgroup label="{{trans('dynamictags.opt_grp.broadcast')}}">
                                                                    <option value="broadcast_name">{{trans('dynamictags.opt.broadcast')}}</option>
                                                                    <option value="broadcast_creation">{{trans('dynamictags.opt.broadcast_creation')}}</option>
                                                                    <option value="broadcast_group">{{trans('dynamictags.opt.broadcast_group')}}</option>
                                                                    <option value="broadcast_subject">{{trans('dynamictags.opt.broadcast_subject')}}</option>
                                                                    <option value="broadcast_attachment">{{trans('dynamictags.opt.attachment')}}</option>
                                                                </optgroup>
                                                                <optgroup label="{{trans('dynamictags.opt_grp.sch_details')}}">
                                                                    <option value="sch_label">{{trans('dynamictags.opt.schedule')}}</option>
                                                                    <option value="camp_type">{{trans('dynamictags.opt.camp_type')}}</option>
                                                                    <option value="aud_type">{{trans('dynamictags.opt.aud_type')}}</option>
                                                                </optgroup>
                                                            </select>

                                                        </div>
                                                        <div class="col-md-3">

                                                            <select id="select_field_name_1"
                                                                    class="form-control m-select2 select_2"
                                                                    name="field_name[]">
                                                                {!! $custom_fields_opt !!}
                                                            </select>

                                                        </div>
                                                        <div class="col-md-2">
                                                            <select id="select_condition_1" name="condition[]" class="form-control m-select2 select_3" data-placeholder="{{ trans('dynamictags.add_new.form.select_an_option') }}">
                                                                <option value="{{ trans('dynamictags.controller.is_option_txt') }}">{{ trans('segments.filter.is') }}</option>
                                                                <option value="is_not">{!! trans('dynamictags.is_not') !!}</option>
                                                                <option value="{{ trans('dynamictags.controller.contains_option_txt') }}">{{ trans('segments.filter.contain') }}</option>
                                                                <option value="does_not_contain">{{ trans('dynamictags.does_not_contain') }}</option>
                                                            </select>

                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="col_4 value_1">
                                                                <input type="text" class="form-control textsystem"
                                                                    placeholder="Text Field" name="values[]">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <a href="javascript:;"
                                                            class="btn btn-danger btn-icon btn-sm btn-cancle">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div data-repeater-create="" class="btn btn-info btn-icon btn-sm btn-add"
                                    onclick="showRow(1)">
                                    <i class="la la-plus"></i>
                                </div>
                            </div>
                        </span>
                        <!-- -->
                        <br/>
                        <!-- -->
                        <div class="if-portion">
                            <h3><i class="fa fa-check-square"></i> {{trans('dynamictags.add_new.form.if_qualify')}}</h3>
                            <div class="form-group row mb0" data-name="XoBCUTdF">
                                <label class="col-form-label col-md-2">
                                    @lang('dynamictags.content_type.select')
                                </label>
                                <div class="pt5 kt-radio-inline pl12" id="session-check" data-name="BDSrYLUBrg">
                                    <label class="kt-radio kt-radio--default" for="_format_html">
                                        <input id="_format_html" checked type="radio" name="_format" value="html">
                                        <span></span>
                                    @lang('dynamictags.content_type.html')
                                    </label>
                                    <label class="kt-radio kt-radio--default" for="_format_text">
                                        <input id="_format_text" type="radio" name="_format" value="text">
                                        <span></span>
                                        @lang('dynamictags.content_type.text')
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="content_html" class="content_title col-form-label">{{trans('dynamictags.add_new.form.html_body')}}</label>
                                <textarea class="form-control" rows="10" name="content_html" id="content_html"></textarea>
                            </div>
                            @php
                                $ckeditor_id = 'content_html';
                            @endphp
                            @if($adminOnClient)
                                {{ dynamicTags(0, 0, $ckeditor_id,$dynamic_content->user_id,false) }}
                            @else
                                {{ dynamicTags(0, 0, $ckeditor_id,null,false) }}
                            @endif
                     {{--       <div class="form-group">
                                <label for="content_text" class="col-form-label">{{trans('dynamictags.add_new.form.text_body')}}</label>
                                <textarea id="content_text" name="content_text" class="form-control" rows="5"></textarea>
                            </div>--}}
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button onclick="hideMdl()" type="button" class="btn btn-secondary" >{{trans('dynamictags.add_new.form.cancel')}}</button>
                    <button id="mkR" onclick="makeRule()" type="button" class="btn btn-success">{{trans('dynamictags.add_new.form.add_rule')}}</button>
                </div>
            </div>
        </div>
    </div>
    <script>
      var  editor = CKEDITOR.replace('content_html', {
            fullPage: true,
            allowedContent: true,
            height: 150
        });
        CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
        CKFinder.setupCKEditor( editor );

        CKEDITOR.config.extraPlugins = 'preview,font,colorbutton,justify,bidi,language,emojione';
        CKEDITOR.config.language_list = ['en:English', 'ar:Arabic:rtl', 'fr:French', 'he:Hebrew:rtl', 'es:Spanish'];
        CKEDITOR.config.defaultLanguage = 'en';
        CKEDITOR.on('dialogDefinition', function (e) {
            $('#kt_modal_4').removeAttr('tabindex');
        });
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
    <script src="/themes/default/js/jquery-ui.js" type="text/javascript"></script>
    <script src="/themes/default/js/sweetalert2.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-timepicker.init.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/intlTelInput.js" type="text/javascript"></script>
    <script>
        $( document ).ready(function() {
            $('#copyAsText').remove();
        });

        $('#copyAsText2').click(function() {
            var content_html_2 = CKEDITOR.instances['content_html_then'].getData(); // For CK editor editor
            jQuery('#content_js').html(content_html_2).find('a').each(function(){
                var href=jQuery(this).attr('href');
                var label=jQuery(this).text();
                if( href && href !="#"){
                    var link= (label && label !="") ? label +":"+ href:href;
                }else{
                    var link=label;
                }
                jQuery(this).replaceWith(link);
            });
            // Removing extra spaces e.g newline, tabs etc with single one
            // content_html=$.trim(jQuery('#content_js').text()).replace(/\s\s+/g, ' ');
            content_html_2=jQuery('#content_js').html();
            $(".blockUI").show();
            $.ajax({
                url: "{{ route('converHtmlToText') }}",
                type: "POST",
                data: {html: content_html_2},
                success: function(result) {
                    $(".blockUI").hide();
                    $('#content_then_text').val(result);
                },
                error: function(err) {
                    $(".blockUI").hide();
                }
            });

        });

        $('#copyAsText').click(function() {
            var content_html = CKEDITOR.instances['content_html'].getData(); // For CK editor editor
            jQuery('#content_js').html(content_html).find('a').each(function(){
                var href=jQuery(this).attr('href');
                var label=jQuery(this).text();
                if( href && href !="#"){
                    var link= (label && label !="") ? label +":"+ href:href;
                }else{
                    var link=label;
                }
                jQuery(this).replaceWith(link);
            });
            // Removing extra spaces e.g newline, tabs etc with single one
            // content_html=$.trim(jQuery('#content_js').text()).replace(/\s\s+/g, ' ');
            content_html=jQuery('#content_js').html();
            $(".blockUI").show();
            $.ajax({
                url: "{{ route('converHtmlToText') }}",
                type: "POST",
                data: {html: content_html},
                success: function(result) {
                    $(".blockUI").hide();
                    $('#content_text').val(result);
                },
                error: function(err) {
                    $(".blockUI").hide();
                }
            });

        });
        var countries = '{!! $cont_options !!}';
        var conditions = "<option value=\"{{ trans('dynamictags.controller.is_option_txt') }}\">{{ trans('segments.filter.is') }}</option>\n" +
            "<option value=\"is_not\">{!! trans('dynamictags.is_not') !!}</option>\n" +
            "<option value=\"{{ trans('dynamictags.controller.contains_option_txt') }}\">{{ trans('segments.filter.contain') }}</option>\n" +
            "<option value=\"does_not_contain\">{{ trans('dynamictags.does_not_contain') }}</option>";
        var custom_fields = '{!!$custom_fields_opt!!}';
        var lists = '{!!$listOptions!!}';
        var broadcasts = '{!!$broadcast_options!!}';
        var dates = '{!!$date_options!!}';

        function editRule(id)
        {
            $(".blockUI").show();
             rule = $(document).find('[data-id="'+id+'"]').val();
            $('#exampleModalLabel').html('{{trans('dynamictags.add_new.form.heading_edit')}}');
            rule = JSON.parse(rule);
            title = rule.rule_name;
            $('#rule_name').val(title);
            rule_fields = rule.fields;
            rule_field_names = rule.field_names;
            rule_conditions = rule.conditions;
            rule_values = rule.values;
            rule_content = rule.content.replace(/\\"/g, '"');
            content_type = rule.content_type;
            optionsArr = {!! $optionsArr !!};

            for(i=0; i < rule_fields.length; i++)
            {
                col1_value = rule_fields[i];
                col2_value = rule_field_names[i].name;
                col3_value = rule_conditions[i].name;
                col4_value = rule_values[i];

                if(i>0)
                    $('.btn-add').trigger('click');
                if(i===0) {
                    $('#select_field_1').val(col1_value).trigger('change');
                if(col2_value!=null)
                    $('#select_field_name_1').val(col2_value).trigger('change');
                    //$('#select_field_name_1').children().remove();
                   // if(col1_value!='broadcast_group')
                    $('#select_condition_1').val(col3_value).trigger('change');
                    if(optionsArr[col2_value]!==undefined || ['country','lists','groups'].includes(col2_value) || ['broadcast_group','day','day_of_week','this_month'].includes(col1_value))
                    {
                        if(optionsArr[col2_value]!==undefined) {
                            if(optionsArr[col2_value].includes('<optgroup')) {
                                contList = col4_value.value;
                                result = Object.values(contList);
                                $('.value_1' + ' select').multiselect('select', result);
                            }
                            else{
                                $('.value_1' + ' :input').val(col4_value.value);
                            }
                        }
                        else{
                            contList = col4_value.value;
                            result = Object.values(contList);
                            $('.value_1' + ' select').multiselect('select', result);
                        }
                    }
                    else{
                        oneC = ['exactly','after','before']
                        if(oneC.includes(col3_value))
                            $('.value_1'+' :input').val(col4_value.value);
                        else if(col3_value=='between') {
                            $('#from_1').val(col4_value.key);
                            $('#to_1').val(col4_value.value);
                        }
                        else if(['occurred_before','occurred_after','for_the_past','older_than'].includes(col3_value))
                        {
                            keyS = col4_value.key;
                            $('.value_1'+' :input').val(col4_value.value);
                            $('#filter_1').val(keyS);
                        }
                        else {
                            if($('.value_1').find('input.mobile').length>0)
                                $('.value_1').find('input.mobile').intlTelInput("setNumber", "+" + col4_value.key+col4_value.value);
                            else
                            $('.value_1' + ' :input').val(col4_value.value);

                        }
                    }
                }
            }
            var b  = parseInt(localStorage.getItem("id"))-rule_fields.length+1;
            for(i=0; i < rule_fields.length; i++)
            {
                col1_value = rule_fields[i];
                col2_value = rule_field_names[i].name;
                col3_value = rule_conditions[i].name;
                col4_value = rule_values[i];
                col1_id = '#select_field_'+b+'';
                col2_id = '#select_field_name_'+b+'';
                col3_id = '#select_condition_'+b+'';
                col4_div_class = '.value_'+b+'';
                $(col1_id).val(col1_value).trigger('change');
                if(col2_value!=null)
                    $(col2_id).val(col2_value).trigger('change');
                $(col3_id).val(col3_value).trigger('change');
                if(optionsArr[col2_value]!==undefined  || ['country','lists','groups'].includes(col2_value) || ['broadcast_group','day','day_of_week','this_month'].includes(col1_value))
                {
                    if(optionsArr[col2_value]!==undefined) {
                        if(optionsArr[col2_value].includes('<optgroup')) {
                            contList = col4_value.value;
                            result = Object.values(contList);
                            $(col4_div_class+ ' select').multiselect('select', result);
                        }
                        else{
                            $(col4_div_class+' :input').val(col4_value.value);
                        }
                    }
                    else{

                        contList = col4_value.value;
                        result = Object.values(contList);
                        $(col4_div_class+ ' select').multiselect('select', result);
                    }
                }
                else{
                    oneC = ['exactly','after','before']
                    if(oneC.includes(col3_value))
                        $(col4_div_class+' :input').val(col4_value.value);
                    else if(col3_value=='between') {
                        $('#from_'+b).val(col4_value.key);
                        $('#to_'+b).val(col4_value.value);
                    }
                    else if(['occurred_before','occurred_after','for_the_past','older_than'].includes(col3_value))
                    {
                        keyS = col4_value.key;
                        $(col4_div_class+' :input').val(col4_value.value);
                        $('#filter_'+b).val(keyS);
                    }
                    else {
                        if ($(col4_div_class).find('input.mobile').length > 0)
                            $(col4_div_class).find('input.mobile').intlTelInput("setNumber", "+" + col4_value.key + col4_value.value);
                        else
                            $(col4_div_class+' :input').val(col4_value.value);
                    }
                }
                b++;
            }
            $('#kt_modal_4').modal('show');
            $('.m-select2').select2();
            if(content_type=='html' || content_type===undefined)
            {
                $('#content_html').val('');
                $('#_format_html').trigger('click');
                CKEDITOR.instances['content_html'].setData(rule_content);
            }
           else
           {
               try {
                   CKEDITOR.instances['content_html'].setData('');
               }
               catch (e) {
                   
               }
                $('#_format_text').trigger('click');
                $('#content_html').val(rule_content);
           }
            $('#mkR').attr('onclick','makeRule('+id+')').html('{{trans('dynamictags.btn.edit')}}');
            $(".blockUI").hide();
        }
        function deleteRule(id)
        {
            $(".swal2-confirm").css("background-color", "#dd3333");
            $(".swal2-cancel").css("background-color", "#95a0a8");
            Swal.fire({
                title: "{{trans('dynamictags.delete.popup_sure')}}",
                text: "{!! trans('dynamictags.delete.popup_not_revert') !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{trans('dynamictags.delete.popup_button_delete')}}"
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        "{{trans('dynamictags.delete.popup_deleted')}}" ,
                        "{{trans('dynamictags.delete.popup_tag_deleted')}}",
                        'success',
                        $('#list_'+id).remove()
                    )
                }
            });
        }function array_combine( keys, values ) {
            var new_array = {}, keycount=keys.length, i;

            if( !keys || !values || keys.constructor !== Array || values.constructor !== Array ){
                return false;
            }
            if(keycount != values.length){
                return false;
            }
            for ( i=0; i < keycount; i++ ){
                new_array[keys[i]] = values[i];
            }
            return new_array;
        }

        localStorage.setItem('i', '0');
        function escapeHtml(unsafe)
        {
            return unsafe
                .replace(/&/g, "&amp;")
                .replace(/</g, "&lt;")
                .replace(/>/g, "&gt;")
                .replace(/'/g, "&#039;");
        }
        function createIdForRow(id)
        {
           var new_id = '#list_'+id;
            if($(new_id).length == 0)
                return id;
            for(var i = id; i >= 0; i++)
            {
                new_id = '#list_'+i;
                if($(new_id).length == 0)
                {
                    id = i;
                    localStorage.setItem('i', '' + i + '');
                    break;
                }
            }
            return id;
        }
        function filterString(variable)
        {
            if (typeof variable === 'string')
          return   variable.replace(/'/g, '&#39;')
            return variable
        }
        function makeRule(id=null)
        {
            $("#content_text").css("border-color", "");
            $("#rule_name").css("border-color", "#bec4d0");
            $(".textsystem").css("border-color", "#bec4d0");
            $("#rule_name").css("border-color", "#bec4d0");
            $(".textsystem").css("border-color", "#bec4d0");
            $('.error').remove();
            var rule_name = filterString($('#rule_name').val());
          if (rule_name.length==0)
            {
                $("#rule_name").css("border-color", "red");
                Command: toastr["error"] ("{{trans('dynamictags.add_blade.unit_required_command')}}");
                return false;
            }

            var fields = $("select[name='field[]']")
                .map(function(){return $(this).val();}).get();
            var field_names = $("select[name='field_name[]']")
                .map(function(){return {'name':$(this).val()};}).get();
            var conditions = $("select[name='condition[]']")
                .map(function(){return {'name':$(this).val()};}).get();
            var values = $("[name='values[]']")
                .map(function(){
                    if($(this).hasClass('mobile'))
                        return {'key':$(this).intlTelInput("getSelectedCountryData").dialCode,'value':filterString($(this).val().replace(/ /g,''))};
                    return {'key':filterString($(this).val())};
                }).get();
            try {
                var content = CKEDITOR.instances['content_html'].getData().replace(/&quot;/g, '\\"');
            }
            catch (e) {
                var content = $('#content_html').val();
            }
            content = escapeHtml(content);
            var content_text = null;
            if(content_text==''){
                $("#content_text").css("border-color", "red");
                Command: toastr["error"] ("{{trans('dynamictags.add_blade.body_required_command')}}");
                return false;
            }
            var values_=[];
            var  val_key = 0;
            var between;
            for (var i=0; i < conditions.length; i++) {
                    if (conditions[i].name == 'between') {
                        val = values[val_key].key;
                        val2 = values[val_key + 1].key;
                        values_.push({'key': val, 'value': val2});
                        val_key++;
                    } else {
                        if (['occurred_before', 'occurred_after', 'for_the_past', 'older_than'].includes(conditions[i].name)) {
                            val = values[val_key].key == undefined ? null : values[val_key].key;
                            key = values[val_key+1].key == undefined ? null : values[val_key+1].key;
                            values_.push({'key': key, 'value': val});
                            val_key++;
                        }
                        else {
                            key = values[val_key].value!==undefined ? values[val_key].key: null;
                            val = values[val_key].value!==undefined ? values[val_key].value : values[val_key].key;
                            values_.push({'key': key, 'value': val});
                            between = false;
                        }
                    }
                val_key++;
            }
            values = values_;
           var content_type = $('#_format_html').is(':checked') ? 'html' :'text';
            var json = JSON.stringify({rule_name,fields,field_names,conditions,values,content,content_type});
            // console.log(json);
            $.ajax({
                url:'{{route('validateDynamicTagRule')}}',
                method:'post',
                data:{'data':json},
                beforeSend:function ()
                {
                    $(".blockUI").show();
                },
                success:function (response)
                {
                    $(".blockUI").hide();
                    if(response.status=='success') {
                        console.log(values);
                        console.log(json);
                        if(id!==null) {
                            i = id;
                            v2 = i+1
                            localStorage.setItem('i', '' + v2 + '');
                        }
                        else {
                            @if(isset($dynamic_content))
                            localStorage.setItem("i", '{{$storage_var}}');
                            @endif
                                i = parseInt(localStorage.getItem('i'));
                            i++;
                            localStorage.setItem('i', '' + i + '');
                            i = createIdForRow(i);
                        }

                        edit_func = 'editRule(' + i + ')';
                        delete_func = 'deleteRule(' + i + ')';
                        lid = 'id="list_' + i + '"';
                        html = '<li ' + lid + ' class="ui-state-default ui-sortable-handle"><i class="fa fa-bars"></i> <span class="li-text">' + rule_name + '</span> <span class="li-action"> <a onclick="' + delete_func + '" href="javascript:;" title="Delete" class="deleteme pull-right"><i class="la la-trash"></i></a> <a href="javascript:;" onclick="' + edit_func + '" class="pull-right" title="Edit"><i class="la la-edit"></i></a> <!--<a href="javascript:;" class="pull-right" title="Copy"><i class="la la-copy"></i></a>--> <input type="hidden" name="rule[]" class="rule" value=' + "'" + json + "'" + ' data-id="' + i + '"></span> </li>';
                       $('.hr').trigger('click');
                        setTimeout(() => {
                            if(id!==null)
                                $('#list_'+i+'').replaceWith(html);
                            else
                            $('#sortable').append(html);
                            $("#kt_modal_4").modal('hide');
                            $("#add_rule_form")[0].reset();
                            $(".blockUI").hide();
                        }, 500);
                    }
                    else{
                        $(".blockUI").hide();
                    }
                },complete: function () {
                    $('.blockUI').hide();
                }
            });


        }
        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        } );
        function displayModal() {
            $('#content_html').val('');
            $('#_format_html').trigger('click');
            $('#select_field_1').val('custom_fields').change();
            $('#select_field_name_1').change();
            $('#exampleModalLabel').html('{{trans('dynamictags.add_new.form.heading')}}');
            $('#mkR').attr('onclick','makeRule()').html('{{trans('dynamictags.btn.add')}}');
            $('#rule_name').val('');
            $('.hr').trigger('click');
            CKEDITOR.instances['content_html'].setData('');
            $('#kt_modal_4').modal('show');
        }
        function hideMdl()
        {
            $('#kt_modal_4').modal('hide');
            $('#select_field_1').val('custom_fields').trigger('change');
            $('.hr').trigger('click');
            $('#_format_text').trigger('click');
            $('#content_html').val('');
            $('#_format_html').trigger('click');
            CKEDITOR.instances['content_html'].setData('');

        }
        var form_error = "{{trans('common.message.form_error')}}";
        localStorage.removeItem("id");
        @if(isset($storage_var) && $storage_var>1)
        localStorage.setItem("i", '{{$storage_var}}');
        @endif
    </script>
    <script>
        $(document).on('change', '.select_3', function () {
            select_con_id = this.id;
            string_id = select_con_id.substring(17);
            div_class = 'value_' + string_id;
            select_field_name_id = '#select_field_name_' + string_id;
            select_field_id = '#select_field_' + string_id;
            val = this.value;
            hd = 'hd_' + string_id;
            dates_arr = {!!$dates!!};
            select_field_name = $(select_field_name_id).val();
            $('.' + div_class).addClass(hd);
            if (dates_arr.includes(select_field_name) || ['created_at','broadcast_creation'].includes($(select_field_id).val()) || val === 'exactly') {
                if ((val === 'after' || val === 'before' || val === 'exactly')) {
                    div = '<div class="col_4 ' + div_class + '" >\n' +
                        '<input  type="text" class="form-control datesystem" placeholder="{{ trans('dynamictags.add_new.form.date_field') }}" id="" name="values[]">\n' +
                        '</div>';
                    $('.' + div_class).after(div);
                    $('.' + hd).remove();
                    $(".datesystem").datepicker({
                        dateFormat: 'yy-mm-dd',
                        autoclose: true
                    });
                } else if (val === 'occurred_before' || val === 'for_the_past' || val === 'older_than' || val === 'occurred_after') {
                    date_filter = 'filter_'+string_id;
                    div = '<div class="col_4 ' + div_class + '" >\n' +
                        '<div class="datetype22">\n' +
                        '<input type="number"  class="form-control" id="" name="values[]" placeholder="Text Field">\n' +
                        '</div>\n' +
                        '<div class="datetype33">\n' +
                        '<select id="'+date_filter+'"  class="form-control m-select2" name="values[]" data-placeholder="{{ trans('dynamictags.add_new.form.select_an_option') }}">\n' +
                        '<option value="minutes" >{{ trans("common.minutes")}}</option>\n' +
                        '<option value="hours" >{{ trans("common.hours")}}</option>\n' +
                        '<option value="days" >{{ trans("common.days")}}</option>\n' +
                        '<option value="weeks" >{{ trans("common.weeks")}}</option>\n' +
                        '<option value="months" >{{ trans("common.months")}}</option>\n' +
                        '<option value="years" >{{ trans("common.years")}}</option>\n' +
                        '</select>' +
                        '</div>\n' +
                        '</div>';
                    $('.' + div_class).after(div);
                    $('.' + hd).remove();
                    $('.m-select2').select2({
                        templateResult: function (data, container) {
                            if (data.element) {
                                $(container).addClass($(data.element).attr("class"));
                            }
                            return data.text;
                        }
                    });
                } else if (val === 'between') {
                    from_id = 'from_'+string_id;
                    to_id = 'to_'+string_id;
                    div = '<div class="' + div_class + '" >\n' +
                        '<div class="input-group date form_datetime bs-datetime" id="datetimepicker-geo" data-date="" data-date-format="yyyy-mm-dd">\n' +
                        '<div class="input-daterange input-group dategroupmap">\n' +
                        '<input id="'+from_id+'"  type="text" class="form-control cfrom" name="values[]" readonly="" data-date-format="yyyy-mm-dd">\n' +
                        '<div class="input-group-append"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>\n' +
                        '<input id="'+to_id+'" type="text" class="form-control cto" readonly="" name="values[]"  data-date-format="yyyy-mm-dd">\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>';
                    $('.' + div_class).after(div);
                    $(".cfrom, .cto").datepicker({ dateFormat: 'yy-mm-dd' ,autoclose: true});
                    $('.' + hd).remove();
                }
            }
        });

        // select second dropdown in unit rules
        $(document).on('change', '.select_2', function () {
            var id_c = null;
            countries = '{!! $cont_options !!}';
            optionsArr = {!! $optionsArr !!};
            numbersArr = {!! $numbersArr !!};
            lists = '{!!$listOptions!!}';
            broadcasts = '{!!$broadcast_options!!}';
            listGroups = '{!!$listGroups!!}';
            dates_arr = {!!$dates!!};
            select_id = this.id;
            string_id = select_id.substring(18);
            hd = 'hd_' + string_id;
            div_class = 'value_' + string_id;
            select_condition = '#select_condition_' + string_id;
            $('.' + div_class).addClass(hd);
             if (this.value === 'mobile') {
                div = '<div class="' + div_class + '" >\n' +
                    '<input  type="tel" name="values[]"  class="form-control mobile">\n' +
                    '</div>';
                $('.' + div_class).after(div);
                $('.' + hd).remove();
                 conditions = '<option value="is">{{ trans('segments.filter.is') }}</option>\n' +
                     "<option value=\"is_not\">{!! trans('dynamictags.is_not') !!}</option>\n" +
                     '<option value="contains">{{ trans('segments.filter.contain') }}</option>\n' +
                     '<option value="does_not_contain">{{ trans('dynamictags.does_not_contain') }}</option>';
                 $(select_condition).children().remove();
                 $(select_condition).append(conditions);
                var elm = $(".mobile").intlTelInput({
                    placeholderNumberType: "MOBILE",
                    separateDialCode: true,
                    utilsScript: '{{ URL("/themes/default/js/includes/utils.js") }}'
                });
            }
             else if (this.value === 'country')
             {
                conditions = '<option value="is">{{ trans('segments.filter.is') }}</option>\n' +
                    "<option value=\"is_not\">{!! trans('dynamictags.is_not') !!}</option>\n";
                $(select_condition).children().remove();
                $(select_condition).append(conditions);
                div = '<div class="' + div_class + '" >\n' +
                    countries +
                    '</div>';
                $('.' + div_class).after(div);
                $('.' + div_class+' select').multiselect({'rebuild':true, includeSelectAllOption: true});
                $('.' + hd).remove();
            }
            else if (this.value=='lists')
            {
                    options = lists;
                mselectId = 'm_select_'+string_id;
                listSelect = '<select id="'+mselectId+'" class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" name="values[]" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="false" data-placeholder="Select Lists">';
                div = '<div class="' + div_class + '" >\n' +
                    listSelect+ options +'</select>';
                    '</div>';
                $('.' + div_class).replaceWith(div);
                $('#'+mselectId).multiselect({'rebuild':true, includeSelectAllOption: true});
                $('.' + hd).remove();
            }
            else if (this.value=='groups')
            {
                options = listGroups;
                mselectId = 'm_select_'+string_id;
                listSelect = '<select id="'+mselectId+'" class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" name="values[]" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="false" data-placeholder="Select {{trans('Groups')}}">';
                div = '<div class="' + div_class + '" >\n' +
                    listSelect+ options +'</select></div>';
                $('.' + div_class).replaceWith(div);
                $('#'+mselectId).multiselect({'rebuild':true, includeSelectAllOption: true});
                $('.' + hd).remove();
            }
            else
            {
                if(dates_arr.includes(this.value))
                {
                    conditions = '<option value="">{{ trans('dynamictags.add_new.form.select_an_option') }}</option>\n' +
                        '<option value="after">{{ trans('segments.filter.after') }}</option>\n' +
                        '<option value="before">{{ trans('segments.filter.before') }}</option>\n' +
                        '<option value="exactly">{{ trans('segments.filter.exactly') }}</option>\n' +
                        '<option value="between">{{ trans('segments.filter.between') }}</option>\n' +
                        '<option value="occurred_before">{{ trans('segments.filter.occurring_before') }}</option>\n' +
                        '<option value="occurred_after">{{ trans('dynamictags.opt.occurred_after') }}</option>\n' +
                        '<option value="for_the_past">{{ trans('segments.filter.for_the_past') }}</option>\n' +
                        '<option value="older_than">{{ trans('segments.filter.older_than') }}</option>';
                    $(select_condition).children().remove();
                    $(select_condition).append(conditions);
                }
                else {
                    fv  = this.value;
                    if(optionsArr[fv]!==undefined)
                    {
                        conditions = '<option value="is">{{ trans('segments.filter.is') }}</option>';
                        $(select_condition).children().remove();
                        $(select_condition).append(conditions);
                        options_ = optionsArr[fv];
                        if(options_.includes('<optgroup'))
                        {
                            mselectId = 'm_select_'+string_id;
                            listSelect = '<select id="'+mselectId+'" class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" name="values[]" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="false">';
                            div = '<div class="' + div_class + '" >\n' +
                                listSelect+ options_ +'</select></div>';
                            $('.' + div_class).after(div);
                            $('.' + div_class+' select').multiselect({'rebuild':true, includeSelectAllOption: true});
                            $('.' + hd).remove();
                        }
                        else{
                            val_options = '<select class="select_23 m-select2 form-control"  name="values[]">';
                            val_options +=options_;
                            div = '<div class="' + div_class + '" >\n'+val_options +'</select>\n'+
                                '</div>';
                            $('.' + div_class).replaceWith(div);
                            $('.select_23').select2();
                        }
                    }
                    else {
                        if (numbersArr.includes(this.value)) {
                            conditions = '<option value="equal">{{ trans('dynamictags.equal') }}</option>\n' +
                                "<option value=\"not_equal\">{!! trans('dynamictags.not_equal') !!}</option>\n" +
                                '<option value="greater_than">{{ trans('dynamictags.greater_than') }}</option>\n' +
                                '<option value="greater_and_equal">{{ trans('dynamictags.greater_and_equal') }}</option>'+
                                '<option value="lesser_than">{{ trans('dynamictags.lesser_than') }}</option>'+
                                '<option value="lesser_and_equal">{{ trans('dynamictags.lesser_and_equal') }}</option>'+
                                '<option value="first_char">{{ trans('dynamictags.first_char') }}</option>\n'+
                                '<option value="contains">{{ trans('segments.filter.contain') }}</option>\n' +
                                '<option value="does_not_contain">{{ trans('dynamictags.does_not_contain') }}</option>';
                            $(select_condition).children().remove();
                            $(select_condition).append(conditions);
                            div = '<div class=" ' + div_class + '" >\n' +
                                '<input  type="number" class="form-control textsystem" placeholder="Number Field" name="values[]">\n' +
                                '</div>';
                            $('.' + div_class).after(div);
                            $('.' + hd).remove();
                        } else {
                            conditions = '<option value="is">{{ trans('segments.filter.is') }}</option>\n' +
                                "<option value=\"is_not\">{!! trans('dynamictags.is_not') !!}</option>\n" +
                                '<option value="contains">{{ trans('segments.filter.contain') }}</option>\n' +
                                '<option value="does_not_contain">{{ trans('dynamictags.does_not_contain') }}</option>';
                            $(select_condition).children().remove();
                            $(select_condition).append(conditions);
                            div = '<div class=" ' + div_class + '" >\n' +
                                '<input  type="text" class="form-control textsystem" placeholder="Text Field" name="values[]">\n' +
                                '</div>';
                            $('.' + div_class).after(div);
                            $('.' + hd).remove();
                        }
                    }
                }
            }
        });

        // add Unit Rules
        function showRow(id) {
            var id_c = null;
            vall = $('.select_2').val();
            local_id = localStorage.getItem("id");
            if (local_id !== null)
                id = parseInt(local_id);
            id_ = id + 1;
            localStorage.setItem("id", id_);
            current_div_id = '#row_' + id;
            next_div_id = '#row_' + id_;
            row_id = 'row_' + id_;
            select_field_id = 'select_field_' + id_;
            select_field_name_id = 'select_field_name_' + id_;
            select_condition_id = 'select_condition_' + id_;
            value_class = 'value_' + id_;
            showR = "showRow(" + id_ + ")";
            hideR = "hideRow('" + next_div_id + "')";
            div = '<div class="form-group row mb0" id="' + row_id + '">\n' +
                '<div class="col-md-12">\n' +
                '<label class="col-form-label">{{trans('dynamictags.add_new.form.unit_rules')}}</label>\n' +
                '<div data-repeater-list="unit_rules">\n' +
                '<div class="mt-repeater">\n' +
                '<div data-repeater-item="">\n' +
                '<div data-repeater-item="" class="mt-repeater-item">\n' +
                '<div class="row mt-repeater-item">\n' +
                '<div class="col-md-3">\n' +
                '<select  id="' + select_field_id + '" class="form-control m-select2 select" name="field[]" data-placeholder="Select an option">\n' +
                '<optgroup label="{{trans('dynamictags.opt.recipient')}}">\n'+
                '<option value="custom_fields">{{ trans('dynamictags.opt.profile') }}</option>\n' +
                '<option value="email">{{ trans('dynamictags.opt.email') }}</option>\n' +
                '<option value="member_of">{{ trans('dynamictags.opt.member_of') }}</option>\n' +
                '<option value="confirmation">{{ trans('dynamictags.opt.confirmation') }}</option>\n' +
                '<option value="created_at">{{ trans('dynamictags.opt.created_at') }}</option>\n' +
                '<option value="list_name">{{ trans('dynamictags.opt.list_name') }}</option>\n'+
                '</optgroup>\n' +
                '<optgroup label="{{trans('dynamictags.opt_grp.timeDate')}}">\n'+
                '<option value="now">{{ trans('dynamictags.opt.now') }}</option>\n' +
                '<option value="today">{{ trans('dynamictags.opt.today') }}</option>\n'+
                '<option value="day">{{ trans('dynamictags.opt.day_of_month') }}</option>\n'+
                '<option value="day_of_week">{{ trans('dynamictags.opt.week') }}</option>\n'+
                '<option value="this_month">{{ trans('dynamictags.opt.month') }}</option>\n'+
                '</optgroup>\n'+
                '<optgroup label="{{trans('dynamictags.opt_grp.broadcast')}}">\n'+
                '<option value="broadcast_name">{{trans('dynamictags.opt.broadcast')}}</option>\n'+
                '<option value="broadcast_creation">{{trans('dynamictags.opt.broadcast_creation')}}</option>\n'+
                '<option value="broadcast_group">{{trans('dynamictags.opt.broadcast_group')}}</option>\n'+
                '<option value="broadcast_subject">{{trans('dynamictags.opt.broadcast_subject')}}</option>\n'+
                '<option value="broadcast_attachment">{{trans('dynamictags.opt.attachment')}}</option>\n'+
                '</optgroup>\n'+
                '<optgroup label="{{trans('dynamictags.opt_grp.sch_details')}}">\n'+
                '<option value="sch_label">{{trans('dynamictags.opt.schedule')}}</option>\n'+
                '<option value="camp_type">{{trans('dynamictags.opt.camp_type')}}</option>\n'+
                '<option value="aud_type">{{trans('dynamictags.opt.aud_type')}}</option>\n'+
                '</optgroup>\n'+
                '</select>\n' +
                '</div>\n' +
                '<div class="col-md-3">\n' +
                '<select  id="' + select_field_name_id + '" class="form-control m-select2 select_2" name="field_name[]">\n' +
                '{!! $custom_fields_opt !!}' +
                '</select>\n' +
                '</div>\n' +
                '<div class="col-md-2">\n' +
                '<select  id="' + select_condition_id + '" name="condition[]" class="form-control m-select2 select_3" data-placeholder="{{ trans('dynamictags.add_new.form.select_an_option') }}">\n' +
                '<option value="is">{{ trans('segments.filter.is') }}</option>\n' +
                "<option value=\"is_not\">{!! trans('dynamictags.is_not') !!}</option>\n" +
                '<option value="contains">{{ trans('segments.filter.contain') }}</option>\n' +
                '<option value="does_not_contain">{{ trans('dynamictags.does_not_contain') }}</option>\n' +
                '</select>\n' +
                '</div>\n' +
                '<div class="col-md-3">\n' +
                '<div class="col_4 ' + value_class + '" >\n' +
                '<input  type="text" class="form-control textsystem" placeholder="Text Field" name="values[]">\n' +
                '</div>\n' +
                '</div>\n' +
                '<div class="col-md-1">\n' +
                '<a href="javascript:;" onclick="' + hideR + '" class="btn hr btn-danger btn-icon btn-sm">\n' +
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
            $('#'+select_field_name_id).change();
            $('.m-select2').select2({
                templateResult: function (data, container) {
                    if (data.element) {
                        $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                }
            });
            $('.selected').each(function (i, obj) {
                selected = obj.selected;
                if (selected)
                    id_c = obj.getAttribute('cf');
                if (i !== 0) {
                }
            });
        }

        // hide Unit Rules
        function hideRow(id) {
            $(id).slideUp('slow');
            setTimeout(function () {
                $(id).empty();
            }, 1000);
        }

        // select first dropdown in unit rules
        $(document).on('change', '.select', function () {
            conditions = "<option value=\"{{ trans('dynamictags.controller.is_option_txt') }}\">{{ trans('segments.filter.is') }}</option>\n" +
                "<option value=\"is_not\">{!! trans('dynamictags.is_not') !!}</option>\n" +
                "<option value=\"{{ trans('dynamictags.controller.contains_option_txt') }}\">{{ trans('segments.filter.contain') }}</option>\n" +
                "<option value=\"does_not_contain\">{{ trans('dynamictags.does_not_contain') }}</option>";
            var id_c = null;
            select_value = this.value;
            select_id = this.id;
            custom_fields = '{!!$custom_fields_opt!!}';
            broadcasts = '{!!$broadcast_options!!}';
            date = '{!!$date_options!!}';
            string_id = select_id.substring(13);
            select_field_name = '#select_field_name_' + string_id;
            select_condition = '#select_condition_' + string_id;
            div_class = 'value_' + string_id;
            hd = 'hd_' + string_id
            $('.' + div_class).addClass(hd);
            div = '<div class=" ' + div_class + '" >\n' +
                '<input  type="text" class="form-control textsystem" placeholder="Text Field" name="values[]">\n' +
                '</div>';
            $('.' + div_class).after(div);
            $('.' + hd).remove();
            $(select_field_name).removeClass('dt');
            if (select_value == 'custom_fields')
                options = custom_fields;
            else if (select_value == 'member_of') {
                options = '<option selected value="lists">{{ trans('dynamictags.opt.lists') }}</option>\n' +
                    '<option value="groups">{{ trans('dynamictags.opt.groups') }}</option>' ;
                conditions = '';
            }
            else if (['email','confirmation'].includes(select_value)) {
                if(select_value=='confirmation') {
                    val_options = '<select class="select_2_1 m-select2 form-control"  name="values[]">';
                    conditions = '<option value="is">' + '{{ trans('segments.filter.is') }}' + '</option>';
                    val_options += '<option selected value="1">Confirmed</option>\n'+
                        '<option value="0">Unconfirmed</option>';

                    div = '<div class="' + div_class + '" >\n'+val_options +'</select>\n'+
                        '</div>';
                    $('.' + div_class).replaceWith(div);
                    $('.select_2_1').select2();
                }
                options ='';
            }
            else if(['now','today','day','day_of_week','this_month'].includes(select_value)) {
                options ='';
                if(select_value=='now') {
                    conditions = '<option value="between">{{ trans('segments.filter.between') }}</option>';
                    from_id = 'from_' + string_id;
                    to_id = 'to_' + string_id;
                    div = '<div class="' + div_class + '" >\n' +
                        '<div class="input-group date form_datetime bs-datetime" id="datetimepicker-geo" data-date="" data-date-format="yyyy-mm-dd">\n' +
                        '<div class="input-daterange input-group dategroupmap">\n' +
                        '<input id="' + from_id + '"  type="text" class="form-control" readonly name="values[]" placeholder="From">\n' +
                        '<div class="input-group-append"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>\n' +
                        '<input id="' + to_id + '" type="text" class="form-control" readonly name="values[]" placeholder="To">\n' +
                        '</div>\n' +
                        '</div>\n' +
                        '</div>';
                    $('.' + div_class).replaceWith(div);
                    $('#' + from_id + ', #' + to_id).timepicker({
                        defaultTime: '',
                        showMeridian: false,
                        snapToStep: true
                    });
                    $('.' + div_class).addClass(hd);
                }
                else if(select_value=='today')
                    conditions = '<option value="exactly">{{ trans('segments.filter.is') }}</option>';
                else{
                    conditions = '<option value="is">{{ trans('segments.filter.is') }}</option>';
                    mselectId = 'm_this_select_'+string_id;
                    val_options = '<select id="'+mselectId+'" class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" name="values[]" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="false"><optgroup="Select all">'
                    if(select_value=='day')
                        val_options += '<option value="01">01</option><option value="02">02</option><option value="03">03</option> <option value="04">04</option> <option value="05">05</option><option value="06">06</option><option value="07">07</option><option value="08">08</option><option value="09">09</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>';
                    else if(select_value=='day_of_week')
                        val_options +='<option value="7">Sunday</option><option value="1">Monday</option><option value="2">Tuesday</option><option value="3">Wednesday</option><option value="4">Thursday</option><option value="5">Friday</option><option value="6">Sat</option>';
                    else
                    val_options += '<option value="1">January</option>\n'+
                    '<option value="2">February</option>\n'+
                    '<option value="3">March</option>\n'+
                    '<option value="4">April</option>\n'+
                    '<option value="5">May</option>\n'+
                    '<option value="6">June</option>\n'+
                    '<option value="7">July</option>\n'+
                    '<option value="8">August</option>\n'+
                    '<option value="9">September</option>\n'+
                    '<option value="10">October</option>\n'+
                    '<option value="11">November</option>\n'+
                    '<option value="12">December</option>';

                    div = '<div class="' + div_class + '" >\n'+val_options +'</optgroup></select>\n'+
                    '</div>';
                    $('.' + div_class).replaceWith(div);
                    $('#'+mselectId).multiselect({'rebuild':true, includeSelectAllOption: true});
                    $('.' + hd).remove();
                }


            }
            else if(['broadcast_name','broadcast_subject','sch_label','list_name'].includes(select_value))
            {
                options = '';
                conditions = '<option value="is">' + '{{ trans('segments.filter.is') }}' + '</option>\n'+
                    "<option value=\"is_not\">" + "{!! trans('dynamictags.is_not') !!}" + "</option>\n"+
                    '<option value="contains">' + '{{trans('segments.filter.contain')}}' + '</option>\n'+
                    '<option value="does_not_contain">' + '{{trans('dynamictags.does_not_contain') }}' + '</option>';
            }
            else if(['camp_type','aud_type'].includes(select_value))
            {
                val_options = '<select class="select_2222 m-select2 form-control"  name="values[]">';
                if(select_value=='camp_type')
                    val_options += '<option value="campaigns">' + '{{ trans('dynamictags.opt.camp') }}' + '</option>\n' +
                        '<option value="split_list">' + '{!! trans('dynamictags.opt.split_list') !!}' + '</option>';
                else
                    val_options += '<option value="segment">' + '{{ trans('dynamictags.opt.segment') }}' + '</option>\n' + '<option value="subscriber">' + '{{trans('dynamictags.opt.list')}}' + '</option>';
                conditions = '<option value="is">' + '{{ trans('segments.filter.is') }}' + '</option>\n' +
                    "<option value=\"is_not\">" + "{!!trans('dynamictags.is_not')!!}" + "</option>";
                div = '<div class="' + div_class + '" >\n'+val_options +'</select>\n'+
                    '</div>';
                $('.' + div_class).replaceWith(div);
                $('.select_2222').select2();
                options = '';

            }
            else if(select_value=='broadcast_attachment')
            {
                options = '';
                val_options = '<select class="select_222 m-select2 form-control"  name="values[]">';
                val_options += '<option selected value="1">Yes</option>\n'+
                    '<option value="0">No</option>\n';
                conditions = '<option value="has">{{ trans('dynamictags.filter.has') }}</option>\n';
                div = '<div class="' + div_class + '" >\n'+val_options +'</select>\n'+
                    '</div>';
                $('.' + div_class).replaceWith(div);
                $('.select_222').select2();
            }
            else if(select_value=='broadcast_group')
            {
                conditions = '<option value="is">'+'{{ trans('segments.filter.is') }}'+'</option>\n' +
                    "<option value=\"is_not\">"+"{!! trans('dynamictags.is_not') !!}"+"</option>";
                options = ''
                mselectId = 'm_select_'+string_id;
                slect = '<select id="'+mselectId+'" class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" name="values[]" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="false" data-placeholder="Select Groups"><optgroup label="Groups">'
                div = '<div class="' + div_class + '" >\n' +slect+broadcasts+'</select>';
                '</div>';
                $('.' + div_class).replaceWith(div);
                $('#'+mselectId).multiselect({'rebuild':true, includeSelectAllOption: true});
                $('.' + hd).remove();
            }
            else {
                options = date;
                $(select_field_name).addClass('dt');
                conditions =
                    '<option selected value="after">{{ trans('segments.filter.after') }}</option>\n' +
                    '<option value="before">{{ trans('segments.filter.before') }}</option>\n' +
                    '<option value="exactly">{{ trans('segments.filter.exactly') }}</option>\n' +
                    '<option value="between">{{ trans('segments.filter.between') }}</option>\n' +
                    '<option value="occurred_before">{{ trans('segments.filter.occurring_before') }}</option>\n' +
                    '<option value="occurred_after">{{ trans('dynamictags.opt.occurred_after') }}</option>\n' +
                    '<option value="for_the_past">{{ trans('segments.filter.for_the_past') }}</option>\n' +
                    '<option value="older_than">{{ trans('segments.filter.older_than') }}</option>';
            }
            $(select_condition).parent().show();
            $(select_field_name).parent().show();
            if (options !== undefined) {
                $(select_field_name).children().remove();
                $(select_condition).children().remove();
                $(select_condition).append(conditions);
                if(select_value !== 'list')
                $(select_field_name).append(options);
                if(['member_of'].includes(select_value)) {
                    $(select_condition).parent().hide();
                    $(select_field_name).trigger('change');
                }
                else if(['confirmation','email','created_at','now','today','day','day_of_week','this_month','broadcast_group','broadcast_creation','broadcast_name','broadcast_subject','broadcast_attachment','sch_label','camp_type','aud_type','list_name'].includes(select_value))
                {
                    $(select_field_name).parent().hide();
                    $(select_condition).trigger('change');
                }
            }
            $('.selected').each(function (i, obj) {
                selected = obj.selected;
                if (selected)
                    id_c = obj.getAttribute('cf');
                if (i !== 0) {
                }
            });

        });


        function validate(evt) {
            var theEvent = evt || window.event;
            if (theEvent.type === 'paste') {
                key = event.clipboardData.getData('text/plain');
            } else {
                var key = theEvent.keyCode || theEvent.which;
                key = String.fromCharCode(key);
            }
            if(key.length>0)
                $("#tag_name").css("border-color", "");
            var regex = /[a-z0-9--]|\./;
            if( !regex.test(key) ) {
                theEvent.returnValue = false;
                if(theEvent.preventDefault) theEvent.preventDefault();
            }
        }
            $("#else-switch").click(function () {
                var checkBoxes = $("#else-switch").is(':checked');
                console.log(checkBoxes);
                if(checkBoxes === true) {
                    $("#else-switch").val("1");
                    $(".else-portion").slideDown();
                } else{
                    $("#else-switch").val("0");
                    $(".else-portion").slideUp();
                }
            });

            (function($) {
                $.fn.inputFilter = function(inputFilter) {
                    return this.on("{{trans('dynamictags.add_blade.keydown_keyup_return')}} ", function() {
                    if (inputFilter(this.value)) {
                        this.oldValue = this.value;
                        this.oldSelectionStart = this.selectionStart;
                        this.oldSelectionEnd = this.selectionEnd;
                    } else if (this.hasOwnProperty("oldValue")) {
                        this.value = this.oldValue;
                        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                    } else {
                        this.value = "";
                    }
                    });
                };
            }(jQuery));
            $("#tag_name2").inputFilter(function(value) { return /^[a-z0-9--]*$/i.test(value); });

            $(".m-select2").select2({
                placeholder: "Select an option",
                class: "select",
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
            $('#content_name').keypress(function (e) {
                if (e.which === 32)
                    return false;
            });
            $('#content_name').keyup(function () {
                var yourInput = $(this).val();
                re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
                var isSplChar = re.test(yourInput);
                if (isSplChar) {
                    var no_spl_char = yourInput.replace(/[`~!@#$%^&*()|+\_=?;:' ",.<>\{\}\[\]\\\/]/gi, '');
                    $(this).val(no_spl_char);
                }
            });


        var dynamic_id = 0;

        function changeselect2() {

            dynamic_id++;
            window.setTimeout(function () {
                $(".select-change").last().attr('id', 'main_opt_' + dynamic_id);
                $("#main_opt_" + dynamic_id).select2({
                    placeholder: "Select Option",
                    templateResult: function (data, container) {
                        if (data.element) {
                            $(container).addClass($(data.element).attr("class"));
                        }
                        return data.text;
                    }
                });
                $(".select-change2").last().attr('id', 'main_opt2_' + dynamic_id);
                $("#main_opt2_" + dynamic_id).select2({
                    templateResult: function (data, container) {
                        if (data.element) {
                            $(container).addClass($(data.element).attr("class"));
                        }
                        return data.text;
                    }
                });

                $(".select-change3").last().attr('id', 'main_opt3_' + dynamic_id);
                $("#main_opt3_" + dynamic_id).select2({
                    templateResult: function (data, container) {
                        if (data.element) {
                            $(container).addClass($(data.element).attr("class"));
                        }
                        return data.text;
                    }
                });

                $(".select-change4").last().attr('id', 'main_opt4_' + dynamic_id);
                $("#main_opt4_" + dynamic_id).select2({
                    templateResult: function (data, container) {
                        if (data.element) {
                            $(container).addClass($(data.element).attr("class"));
                        }
                        return data.text;
                    }
                });

                $(".select-change5").last().attr('id', 'main_opt5_' + dynamic_id);
                $("#main_opt5_" + dynamic_id).select2({
                    templateResult: function (data, container) {
                        if (data.element) {
                            $(container).addClass($(data.element).attr("class"));
                        }
                        return data.text;
                    }
                });

                $(".select-change6").last().attr('id', 'main_opt6_' + dynamic_id);
                $("#main_opt6_" + dynamic_id).select2({
                    templateResult: function (data, container) {
                        if (data.element) {
                            $(container).addClass($(data.element).attr("class"));
                        }
                        return data.text;
                    }
                });

                $(".select-change7").last().attr('id', 'main_opt7_' + dynamic_id);
                $("#main_opt7_" + dynamic_id).select2({
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
            if (field == 'Unsubscribe Link')
                field = '<a href="%%unsubscribelink%%">{{trans('common.label.unsubscribe')}}</a>';
            else if (field == 'Confirm Link')
                field = '<a href="%%confirmurl%%">{{trans('common.label.confirm')}}</a>';
            else if(field == 'web_version')
                field = '<a href="%%web_version%%">{{trans('broadcasts.web_version')}}</a>';
            else
                field = '%%' + field + '%%';
            if($('#_format_html').is(':checked'))
                CKEDITOR.instances[ckeditor_id].insertHtml(field);
            else {
                c_text = $('#content_html').val();
                $('#content_html').val(c_text+field);
            }
        }
        function replaceVariable(ckeditor_id,selectID){
            var field = $("#"+selectID).val();
            if(field!=""){
                if(selectID=='spintags_variables'){
                    selectSpintag(field, ckeditor_id)
                }
                else if(selectID=='dynamic_content_variables'){
                    field = "[["+field+"]]";
                    selectDynamicContent(field, ckeditor_id)
                }else{
                    selectTag(field, ckeditor_id);
                }
                setTimeout(function() {
                     $("#"+selectID).val(null).trigger('change.select2');
                }, 300);
            }

        }
        // select spintag
        function selectSpintag(spintag, ckeditor_id) {
            spintag = '{' + '{' + spintag + '}' + '}';
            if($('#_format_html').is(':checked'))
                CKEDITOR.instances[ckeditor_id].insertText(spintag);
            else {
                c_text = $('#content_html').val();
                $('#content_html').val(c_text+spintag);
            }
        }

        // select dynamic content tag
        function selectDynamicContent(dynamic_content, ckeditor_id) {
            dynamic_content = dynamic_content;
            CKEDITOR.instances[ckeditor_id].insertText(dynamic_content);
        }

        $('#copy-email').click(function () {
            var content_html = CKEDITOR.instances['content_html'].getSnapshot();
            var regex = /(<([^>]+)>)/ig
            var content = $.trim(content.replace(regex, ""));
            $('#content_text').html(content);
        });
    </script>
    <script>
        $('#content-unit-frm').submit(function () {
            CKEDITOR.instances.content_html.updateElement();
            var form_data = $("#content-unit-frm").serialize();
            $.ajax({
                url: "{{ URL::route('dynamictag.content.unit') }}",
                type: 'POST',
                data: form_data,
                success: function (result) {
                    $('#unit-of-content').modal('hide'),
                        $("#appendata").html(result);
                }
            });
            return false;
        });
        function GetAllProperties() {
            $.ajax({
                url: "{{ URL::route('dynamictag.content.unit') }}",
                type: 'Delete',
                data: {delete_action: 'delete_all'},
                success: function (result) {
                }
            });
        }

        function EditBlock(id, action_type) {
            $.ajax({
                url: "{{ URL::route('dynamictag.content.unit') }}",
                type: 'GET',
                data: {type: 'edit_form_data', content_id: id, action: action_type},
                dataType: "JSON",
                success: function (response) {
                    var unit_content = JSON.parse(response.data);
                    if (unit_content.is_default == 1) {
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

        function DeleteBlock(id, action_type, dynamic_content_id) {
            $.ajax({
                url: "{{ URL::route('dynamictag.content.unit') }}",
                type: 'Delete',
                data: {content_id: id, action_type: action_type, dynamic_content_value: dynamic_content_id},
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
        var txt,html;
        var KTFormRepeater = function () {
            var demo1 = function () {
                $('#kt_repeater_3').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function () {
                        $(this).slideDown();
                    },

                    hide: function (deleteElement) {
                        if (confirm('{{ trans('common.message.delete_warning')}}')) {
                            $(this).slideUp(deleteElement);
                        }
                    }
                });
            }
            return {
                init: function () {
                    demo1();
                }
            };
        }();

        jQuery(document).ready(function () {
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

        function CKupdate() {
            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
                CKEDITOR.instances[instance].setData('');
            }
        }

        function createOrUpdate(method, route, formId, rules, messages) {
            $('.listo').attr('disabled', false);
                    var rules_ = document.getElementsByClassName("rules");
                    for (var i = 0; i < rules_.length; i++) {

                    }
                    return;
                    data = $(formId).serialize()+'rules='+rules;
                    $.ajax({
                        type: method,
                        url: route,
                        data: data,
                        cache: false,
                        dataType: 'json',
                        beforeSend: function () {
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
                                setTimeout(function () {
                                    window.location = "{{route('dynamictag.index')}}";
                                }, 1500);
                                // }
                            } else
                                toastr.error(data.message);
                            return false;
                        }
                    });
                    $('.listo').attr('disabled', false);
                    $('.selected').each(function (i, obj) {
                        selected = obj.selected;
                        if (selected)
                            id_c = obj.getAttribute('cf');
                        if (i !== 0) {

                        }
                    });


        }
            function testing() {
                tag_name = $('#tag_name').val();
                var regexp = /^[a-zA-Z0-9-_]+$/;
                if (tag_name.search(regexp) === -1)
                {
                    $("#tag_name").css("border-color", "red");
                    Command: toastr["error"] ("{{trans('dynamictags.add_blade.tag_alphanumeric_command')}}");
                    return false;
                }
                $(".blockUI").show();
                var rules_ = document.getElementsByClassName("rule");
                var arr = [];
                for (var i = 0; i < rules_.length; i++)
                    arr[i] = (rules_.item(i).value);
                var dyn_id = $('#dynamic_tag_id').val();
                $.ajax({
                    type: 'POST',
                    url: '{{route('dynamictag.store')}}',
                    data: {arr,'name':tag_name,'id':$('#dynamic_tag_id').val(),'return_content':$("input[name=return_content]:checked").val()},
                    cache: false,
                    dataType: 'json',
                    beforeSend: function () {
                        //$("#preloader").show();
                    },
                    success: function (data) {
                        $(".blockUI").hide();
                        if (data.status) {
                            $('#modal-group-label').hide();
                            toastr.success(data.message);
                            $("#select_field_1").val(null).trigger('change');
                            $("#select_field_name_1").val(null).trigger('change');
                            $("#select_condition_1").val(null).trigger('change');
                            CKupdate();
                            if(dyn_id==0)
                            setTimeout(function () {
                                window.location = "{{route('dynamictag.index')}}";
                            }, 1500);
                        } else
                            toastr.error(data.message);
                        return false;
                    }, error: function () {
                        $('.blockUI').hide();
                    }
                });
            }

        $('#tag_name').on('keyup keyup change', function(e) {
            tag  = $(this).val();
            var regexp = /^[a-zA-Z0-9-_]+$/;
            if (tag.search(regexp) === -1)
                $("#tag_name").css("border-color", "red");
            else
                $("#tag_name").css("border-color", "");
        });
        $('#rule_name').on('keyup keyup change', function(e) {
            ruleName  = $(this).val();
            if (ruleName.length == 0)
                $(this).css("border-color", "red");
            else
                $(this).css("border-color", "");
        });
        $('input[type=radio][name=_format]').change(function() {
            if (this.value == 'html') {
                $('.content_title').html('{{trans('dynamictags.add_new.form.html_body')}}');
               txt = $('#content_html').val();
                try {
                    editor.destroy();
                    data = $('#content_html').val();
                    editor = CKEDITOR.replace('content_html', {
                        fullPage: true,
                        allowedContent: true,
                        height: 150
                    });
                    CKEDITOR.instances['content_html'].setData(html);
                }
                catch (e) {

                }
            }
            else {
                $('.content_title').html('{{trans('dynamictags.add_new.form.text_body')}}');
                try {
                    html = CKEDITOR.instances['content_html'].getData();
                }
                catch (e) {

                }
                editor.setData('');
                editor.destroy();
                $('#content_html').val(txt);

            }
        });
    </script>

@endsection