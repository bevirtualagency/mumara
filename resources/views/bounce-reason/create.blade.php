@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/bounce-reason-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section(decide_content())
    
    @if($errors->any())
        <!-- For PHP validations errors-->
        <div class="alert alert-danger" data-name="gPPkrmah">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="yMyrfdAO">
            {{ Session::get('msg') }}
        </div>
    @endif
    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="EilPEkOU">
        <span id='msg-text'><span>
    </div>
    <!-- BEGIN FORM-->
    <div class="row" data-name="sjhsjpEI">
        <div class="col-md-6 create-form" data-name="rlEuZkQp">
            <form id="bounce_reason-frm" class="kt-form kt-form--label-right" novalidate>
                <div class="kt-portlet kt-portlet--height-fluid" data-name="wHyPSinw">
                    <div class="kt-portlet__head" data-name="rMptoldN">
                        <div class="kt-portlet__head-label" data-name="xPDvKiSN">
                            <h3 class="kt-portlet__head-title">{{ trans('bounce_rules.add_new.form.heading') }}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" data-name="iCbEEcNA">

                        <div class="form-group" data-name="EdKGCMLK">
                            <label class="col-form-label pl12">{{ trans('common.label.status') }}</label>
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                    <label>
                                        <input type="checkbox" id="cstatus" name="status" {{isset($bounce_reason) && $bounce_reason->id=='global'?'readonly':''}} {{(isset($bounce_reason) && $bounce_reason->status == 1) || Request::segment(2)=='create'?'checked':''}}>
                                        <span></span>
                                    </label>
                                </span>
                            
                        </div>

                        <div class="form-group" data-name="sJtaTSRg">
                                
                            <div class="col-md-6" data-name="svDJPAWD">
                                <label class="col-form-label">{{ trans('bounce_rules.add_new.form.label') }}</label>
                                <span class="label error"></span>
                                <input type="text" {{isset($bounce_reason) && $bounce_reason->id=='global'?'readonly':''}} class="form-control" name="label" id="label" value="{{isset($bounce_reason)?$bounce_reason->label:''}}">
                            </div>
                        </div>

                        <hr />

                        <div class="row" id="row1" data-name="JkTMAUow">
                            <div class="col-md-12 mt-repeater" data-name="orVTUlBm">
                                <div data-repeater-list="subscriber_filter" data-name="bsAAmqHW">
                                    <div data-repeater-item class="mt-repeater-item" data-name="egizLPfM">
                                        <div class="form-group row mt-repeater-row" data-name="SJyxhwDT">
                                            <label class="col-form-label col-md-12">{{ trans('bounce_rules.add_new.form.conditions') }}</label>
                                            <div class="col-md-3" data-name="ERmKdDFM">
                                                <select class="form-control m-select2" data-placeholder="@lang('bouce_rules.select_bounce_criteria')" {{isset($bounce_reason) && $bounce_reason->id=='global'?'disabled':''}} name="bounce_criteria1" id="bounce_criteria1">
                                                    <option value="code" > {{ trans('bounce_rules.add_new.form.bounce_code') }} </option>
                                                    <option value="reason" >{{ trans('bounce_rules.add_new.form.bounce_reason') }}</option>
                                                    <option value="details" > {{ trans('bounce_rules.add_new.form.bounce_details') }} </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3" data-name="lSLpWPom">
                                                <select class="form-control m-select2" data-placeholder="@lang('bounce_rules.select_condition')" {{isset($bounce_reason) && $bounce_reason->id=='global'?'disabled':''}}  name="condition1" id="condition1">
                                                    <option value="is" selected> {{ trans('segments.filter.is') }} </option>
                                                </select>
                                            </div>

                                            <div class="col-md-3" data-name="qGXsJJnD">
                                                <input type="text" name="b_rule1" id="b_rule1" class="form-control"
                                                       value="">

                                            </div>

                                            <div class="col-md-3" data-name="UIhNayIR">
                                                <a href="javascript:;" data-repeater-delete
 class="btn btn-danger mt-repeater-delete" id="close1">
                                                    <i class="la la-close"></i>
                                                </a>
                                                <a href="javascript:;" data-repeater-create
 class="btn btn-info mt-repeater-add" id="mt-repeater-add">
                                                    <i class="la la-plus"></i> {{ trans('bounce_rules.add_new.form.add_condition') }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div data-name="RDRpkoMW" class="row" id="row2" style=display:none; data-name="khLhbwlw">
                            <div class="col-md-12 mt-repeater" data-name="FqAjQWmN">
                                <div data-repeater-list="subscriber_filter" data-name="tKbVFrmO">
                                    <div data-repeater-item class="mt-repeater-item" data-name="aNSZVPSa">
                                        <div class="form-group row mt-repeater-row" data-name="CsGTDSnH">
                                            <label class="col-form-label col-md-12">@lang('bounce_rules.and')</label>
                                            <div class="col-md-3" data-name="mXUQHoAj">
                                                <select class="form-control m-select2" data-placeholder="@lang('bouce_rules.select_bounce_criteria')" {{isset($bounce_reason) && $bounce_reason->id=='global'?'disabled':''}} name="bounce_criteria2" id="bounce_criteria2">
                                                <option value="code"> {{ trans('bounce_rules.add_new.form.bounce_code') }} </option>
                                                    <option value="reason" >{{ trans('bounce_rules.add_new.form.bounce_reason') }}</option>
                                                    <option value="details"> {{ trans('bounce_rules.add_new.form.bounce_details') }} </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3" data-name="KHwYiEFv">
                                                <select class="form-control m-select2" data-placeholder="@lang('bounce_rules.select_condition')" {{isset($bounce_reason) && $bounce_reason->id=='global'?'disabled':''}}  name="condition2" id="condition2">
                                                    <option value="is" >@lang('segments.filter.is')</option>
                                                </select>
                                            </div>
                                            <div class="col-md-3" data-name="VYIunliJ">
                                                <input type="text" name="b_rule2" id="b_rule2" class="form-control"
                                                       value="">
                                            </div>
                                            <div class="col-md-3" data-name="jpbmWMjg">
                                                <a href="javascript:;" data-repeater-delete
 class="btn btn-danger mt-repeater-delete" id="close2">
                                                    <i class="la la-close"></i>
                                                </a>
                                                <a href="javascript:;" data-repeater-create
 class="btn btn-info mt-repeater-add"
                                                   id="mt-repeater-add2" {{isset($bounce_reason) ? 'style=display:none;':''}}>
                                                    <i class="la la-plus"></i> @lang('bounce_rules.add_new.form.add_condition')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div data-name="UdOrylyM" class="row" id="row3" style=display:none; data-name="vNatJNAl">
                            <div class="col-md-12 mt-repeater" data-name="crRDWzSR">
                                <div data-repeater-list="subscriber_filter" data-name="rDVaUjKL">
                                    <div data-repeater-item class="mt-repeater-item" data-name="gPdERcEp">
                                        <div class="form-group row mt-repeater-row" data-name="mJOlxrnW">
                                            <label class="col-form-label col-md-12">{{ trans('bounce_rules.and') }}</label>
                                            <div class="col-md-3" data-name="dAdhAyJe">
                                                <select class="form-control m-select2" data-placeholder="@lang('bouce_rules.select_bounce_criteria')" {{isset($bounce_reason) && $bounce_reason->id=='global'?'disabled':''}} name="bounce_criteria3" id="bounce_criteria3">
                                                <option value="code"> {{ trans('bounce_rules.add_new.form.bounce_code') }} </option>
                                                    <option value="reason">{{ trans('bounce_rules.add_new.form.bounce_reason') }}</option>
                                                    <option value="details" > {{ trans('bounce_rules.add_new.form.bounce_details') }} </option>
                                                </select>
                                            </div>
                                            <div class="col-md-3" data-name="hwbLmMPY">
                                                <select class="form-control m-select2" data-placeholder="@lang('bounce_rules.select_condition')" {{isset($bounce_reason) && $bounce_reason->id=='global'?'disabled':''}} name="condition3" id="condition3">
                                                    <option value="is" >@lang('segments.filter.is')</option>

                                                </select>
                                            </div>
                                            <div class="col-md-3" data-name="KBoxAavr">
                                                <input type="text" name="b_rule3" id="b_rule3" class="form-control"
                                                       value="">
                                            </div>
                                            <div class="col-md-1" data-name="FKdGtkBL">
                                                <a href="javascript:;" data-repeater-delete
 class="btn btn-danger mt-repeater-delete" id="close3">
                                                    <i class="la la-close"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>

                        <hr />
                        <div class="form-group row" data-name="CSDGMIBk">
                            <label class="col-form-label col-md-12">{{ trans('bounce_rules.add_new.form.process_as') }}:</label>
                            <div class="col-md-6" data-name="dZPCaTXs">
                                <span class="type error"></span>
                                <select class="form-control m-select2" data-placeholder="{{ trans('bounce_rules.add_new.form.set_bounce_type') }}" name="type"
                                        id="type">
                                    <option value="">{{ trans('bounce_rules.add_new.form.set_bounce_type') }}</option>
                                    <option value="soft" {{isset($bounce_reason) && $bounce_reason->type=='soft'?'selected':''}}>
                                        {{ trans('bounce_rules.add_new.form.soft_bounce') }}
                                    </option>
                                    <option value="hard" {{isset($bounce_reason) && $bounce_reason->type=='hard'?'selected':''}}>
                                        {{ trans('bounce_rules.add_new.form.hard_bounce') }}
                                    </option>
                                    <option value="no_process" {{isset($bounce_reason) && $bounce_reason->type=='no_process'?'selected':''}}>
                                        {{ trans('bounce_rules.add_new.form.dont_process') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot" data-name="gXMacejW">
                        <div class="row" data-name="LVbxyleQ">
                            <div class="col-md-12" data-name="HpQBoJei">
                                <button type="submit" class="btn btn-success" id="saveBtn">{{ trans('common.form.buttons.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>


    <!-- END FORM-->
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    var form_error = "{{trans('common.message.form_error')}}";
    $(document).ready(function () {
        $(".m-select2").select2({
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
        $("#bounce_criteria1").on("change", function () {
            if ($(this).val() === "code") {
                $("#condition1").html("<option value=''></option><option value='is'>{{ trans('segments.filter.is') }}</option>");
                //$("#bounce_criteria2").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria3").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                $("#bounce_criteria2").not(this).find("option[value='reason']").attr('disabled', false);
                $("#bounce_criteria2").not(this).find("option[value='details']").attr('disabled', false);
                $("#bounce_criteria3").not(this).find("option[value='code']").attr('disabled', false);
                $("#bounce_criteria3").not(this).find("option[value='details']").attr('disabled', false);
            }
            if ($(this).val() === "reason") {
                $("#condition1").html("<option value='is'>{{ trans('segments.filter.is') }}</option><option value='contains'>{{ trans('segments.filter.contain') }}</option>");
                //$("#bounce_criteria2").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria3").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                $("#bounce_criteria2").not(this).find("option[value='code']").attr('disabled', false);
                $("#bounce_criteria2").not(this).find("option[value='details']").attr('disabled', false);
                $("#bounce_criteria3").not(this).find("option[value='code']").attr('disabled', false);
                $("#bounce_criteria3").not(this).find("option[value='details']").attr('disabled', false);
                $("#select2-condition1-container").text("{{ trans('segments.filter.is') }}");
            }
            if ($(this).val() === "details") {
                $("#condition1").html("<option value='is'>{{ trans('segments.filter.is') }}</option><option value='contains'>{{ trans('segments.filter.contain') }}</option>");
                //$("#bounce_criteria2").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria3").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                $("#bounce_criteria2").not(this).find("option[value='reason']").attr('disabled', false);
                $("#bounce_criteria2").not(this).find("option[value='code']").attr('disabled', false);
                $("#bounce_criteria3").not(this).find("option[value='reason']").attr('disabled', false);
                $("#bounce_criteria3").not(this).find("option[value='code']").attr('disabled', false);
                $("#select2-condition1-container").text("{{ trans('segments.filter.is') }}");
            }
        });
        $("#bounce_criteria2").live("change", function () {
            if ($(this).val() === "code") {
                $("#condition2").html("<option value=''></option><option value='is'>{{ trans('segments.filter.is') }}</option>");
                //$("#bounce_criteria1").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria3").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
            }
            if ($(this).val() === "reason") {
                $("#condition2").html("<option value='is'>{{ trans('segments.filter.is') }}</option><option value='contains'>{{ trans('segments.filter.contain') }}</option>");
                //$("#bounce_criteria1").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria3").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                $('#b_rule2').attr('placeholder','');
                $("#select2-condition2-container").text("{{ trans('segments.filter.is') }}");
            }
            if ($(this).val() === "details") {
                $("#condition2").html("<option value='is'>{{ trans('segments.filter.is') }}</option><option value='contains'>{{ trans('segments.filter.contain') }}</option>");
                //alert$("#bounce_criteria1").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria3").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                $("#select2-condition2-container").text("{{ trans('segments.filter.is') }}");
            }
        });
        $("#bounce_criteria3").on("change", function () {
            if ($(this).val() === "code") {
                $("#condition3").html("<option value=''></option><option value='is'>{{ trans('segments.filter.is') }}</option>");
                //$("#bounce_criteria1").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria2").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
            }
            if ($(this).val() === "reason") {
                $("#condition3").html("<option value='is'>{{ trans('segments.filter.is') }}</option><option value='contains'>{{ trans('segments.filter.contain') }}</option>");
                //$("#bounce_criteria1").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria2").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                $('#b_rule3').attr('placeholder','');
                $("#select2-condition3-container").text("{{ trans('segments.filter.is') }}");
            }
            if ($(this).val() === "details") {
                $("#condition3").html("<option value='is'>{{ trans('segments.filter.is') }}</option><option value='contains'>{{ trans('segments.filter.contain') }}</option>");
                //alert$("#bounce_criteria1").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                //$("#bounce_criteria2").not(this).find("option[value=" + $(this).val() + "]").attr('disabled', true);
                $("#select2-condition3-container").text("{{ trans('segments.filter.is') }}");
            }
        });
        $("#mt-repeater-add").on("click", function () {
            $(this).hide();
            $("#row2 :input").attr('disabled', false);
            $("#row2 .m-select2").attr('disabled', false);
            $("#row2").fadeIn(1000);
            $("#mt-repeater-add2").fadeIn(1000);
            if ($("#row3").is(":visible")) {
                $(this).hide();
                $("#mt-repeater-add2").hide();
            } else {
            }
        });
        $("#mt-repeater-add2").on("click", function () {
            $(this).hide();
            $("#row3 :input").attr('disabled', false);
            $("#row3 .m-select2").attr('disabled', false);
            $("#row3").fadeIn(1000);
        });
        $("#close3").on("click", function () {
            $("#row3").hide();
            //$("#row3 :input").attr('disabled', true);
            $("#row3 :input").val('');
           // $("#row3 .m-select2").attr('disabled', true);
            $("#row3 .m-select2").val('');
            $("#mt-repeater-add2").fadeIn();
            if ($("#row2").is(":hidden")) {
                $("#mt-repeater-add2").hide();
                $("#mt-repeater-add").show();
            } else {
            }
        });
        $("#close2").on("click", function () {
            $("#row2").hide();
         //   $("#row2 :input").attr('disabled', true);
            $("#row2 :input").val('');
            $("#row2 .m-select2").val('');
           // $("#row2 .m-select2").attr('disabled', true);
            $("#mt-repeater-add2").hide();
            $("#mt-repeater-add").fadeIn();
        });
        $("#close1").on("click", function () {
            alert("@lang('bounce_rules.message.delete')");
        });
        $("#condition").on('change', function () {
            if ($(this).val() === "03") {
                $(".mt-repeater-add").fadeOut();
            } else {
                $(".mt-repeater-add").fadeIn(1000);
            }
        });
    });
</script>
{{--<script src="/themes/default/js/includes/bounce_reason.js" type="text/javascript"></script>--}}
<script>
    function saveOrder() {
        $.ajax({
            type: "POST",
            url: "{{route('saveBounceOrder')}}",
            data: $('#bounce_reason').serialize(),
            cache: false,
            dataType: 'json',
            beforeSend: function () {
                //$('#modal-loading').modal('show');
            },
            success: function (data) {
                $(".blockUI").hide();
                if (data.status)
                    toastr.success(data.message);
                else
                    toastr.error(data.message);
                return false;
            }
        });
    }
    $(function () {
        // Setup form validation on the #registerform element
        $("#bounce_reason-frm").validate({
            // Specify the validation rules
            ignore: [],
            rules: {
                label: "required",
                type: "required",
                bounce_criteria1: "required",
                condition1: "required"
            },
            // Specify the validation error messages
            submitHandler: function (form) {
                type = '{{isset($bounce_reason)?'PUT':"POST"}}';
                $.ajax({
                    type: type,
                    url: "{{isset($bounce_reason)?route('bounce-rules.update', $bounce_reason->id):route('bounce-rules.store')}}",
                    data: $('#bounce_reason-frm').serialize(),
                    cache: false,
                    dataType: 'json',
                    beforeSend: function () {
                        $('.error').text('');
                        $('.error').removeClass('validation_error');
                        $('#modal-loading').modal('show');
                    },
                    success: function (data) {
                        $('#modal-loading').modal('hide');
                        if (data.status) {
                            toastr.success(data.message);
                            if(type==="POST") {
                                window.location.href = "{{route('bounce-rules.index')}}"
                            }
                        }
                        else {
                            toastr.error(data.message);
                            if(data.ajax_validation!==undefined) {
                                $('.' + data.ajax_validation).addClass('validation_error');
                                $('.' + data.ajax_validation).text(data.message);
                            }
                        }
                        return false;
                    }
                });
            }
        });
    });
    @if(isset($bounce_reason))
           @php
           $i = 0;
           $index = 0;
           $ruleCount = count($bncRule);
           @endphp

        @if($ruleCount==2)
            $('.mt-repeater-add').trigger('click');
        @elseif($ruleCount==3)
        $('.mt-repeater-add').trigger('click');
        $('.mt-repeater-add').trigger('click');
        @endif
        @foreach($bncRule as $key => $val)
            @php
            $i++;
            $b_cr = '#bounce_criteria'.$i;
            $b_cn = '#condition'.$i;
            $b_cv = '#b_rule'.$i;
            $row = '#row'.$i;
            @endphp
            $(document).ready(function (){
            $('{{$b_cr}}').val('{{$key}}');
            $('{{$b_cr}}').change();
            $('{{$b_cv}}').val('{{$val}}');
            $('{{$b_cn}}').val('{{$cond[$index]}}');
            $('{{$row}}').show();
             });
            @php
            $index++;
            @endphp
        @endforeach
    @endif
</script>
@endsection