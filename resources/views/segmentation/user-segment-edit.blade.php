@extends('layouts.master2')
@php($authUser = getAuthUser())
@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/segment-add.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
    b#fromNameSmtp { 
        font-weight:400 !important;
    }

    .list-disabled>label {
        opacity: 0.7;
    }

    .list-disabled>label bar {
        font-size: 10px;
        font-weight: 500;
    }
    
    div#div_advance{
        margin-top:15px; 
        display: none;
    }
    .advshow{
        padding: 6px !important;
    }
    #addPLus{
        margin: auto !important;
    }
    .spinner_count{
        margin-left: 10px;
        display: inline-block;
    }
    #segment_total_count {
        font-weight: 600;
    } .div_custom_field_value .multiselect {
        margin-top: 0 !important;
    }
    .div_custom_field_value .multiselect-native-select ul.multiselect-container li a label.kt-checkbox {
        margin-bottom: 0 !important;
        font-weight: 400 !important;
    }
</style>
@endsection

@section('page_scripts')
    <script src="/themes/default/js/lib.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.input.js" type="text/javascript"></script>
    <script src="/themes/default/js/repeater.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/datepicker-init.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/timepicker-init.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
    <script src="/themes/default/js/init.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript"></script>
    <script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/themes/default/js/common.js" type="text/javascript"></script>
    <script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script type="text/javascript">
        
        var log_notification = 0;
        var log_notification_filter = 0;
                //segment_type = $('input[name=segment_type]:checked').val();
        $(document).ready(function(){
 $('.checkbox-all-index2').click(function () {
        if($(this).is(':checked')) {
            $('.checkbox-index2').not(':disabled').prop('checked', true);
        } else {
            $('.checkbox-index2').prop('checked', false);
        }
    });


            $("#campaignList").keyup(function(){
                str = $('#campaignList').val().toLowerCase();
              
                if(str.length>0)
                {
                    $(".scList .campiagnsNameList").each(function() {
                        var name = $(this).attr("data-name");
                        var id = $(this).attr("data-id");
                        exists = name.indexOf(str) > -1;
                        if(!exists)
                            $('#flag_'+id).hide();
                        else
                            $('#flag_'+id).show();
                    });
                } else{
                    $(".scList .campiagnsNameList").each(function() {
                        var id = $(this).attr("data-id");
                        $('#flag_'+id).show();
                    });
                }
            });
            
            //$(".advance_option1").select2();
            //$(".advance_option2").select2();
            $("#list_group_name").select2();
            $("#list_group_condition").select2();

            $("#segment_type_list").click(function(){
                console.log("list type");
            });
            $('input[type=radio][name=segment_type]').change(function() {
                if (this.value == 0) {
                    $("#listBtn2").show();
                    $("#campBtn2").hide();
                    $("#lists").show();
                    $("#camps").hide();
                    // $("#camps > .kt-portlet").hide();
                    $("#filters").show();
                    $("#filters2").hide();
                    $("#save").show();
                    
                }else{
                    $("#listBtn2").hide();
                    $("#campBtn2").show();
                    $("#lists").hide();
                    $("#camps").show();
                    // $("#camps > .kt-portlet").show();
                    $("#filters").hide();
                    $("#filters2").show();
                    $("#save").show();
                    console.log("statsOpts");
                }
                
            });
            $(".listOps").click(function() {
                
            });
            $(".statsOpts").click(function() {
               
            });
        });
        function fillThirdField(value,name,id)
        {
            var selectedListsIDs = "";

            if(id=='selectListdb1'){
                selectedListsIDs = $("#selectedAdvnceList0").val();
            }else{
                selectedListsIDs = $("#selectedAdvnceList1").val();
            }
            if(value!=-1) {
                for_users = 1;
                field_value = value;
                field_index = (name.split("[")[1].slice(0, -1));
                custom_field_col = 'adv_list';
                if (field_value == 2)
                    custom_field_col = 'adv_group';
                
                col = 'advance_filter[' + field_index + '][adv_filter_val][]';
                //select_class = 'class="mt-multiselect btn btn-default form-control MultiSelectBox"';
                select_class = 'class="class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true"';
                var checkbox_html = '<select ' + select_class + ' id="' + custom_field_col + '_' + field_index + '"  name="' + col + '" >';
                
                console.log("field_value");
                console.log(field_value);

                $.ajax({
                    url: '{{route('segment.getList')}}',
                    type: 'post',
                    data: {'field_value':field_value,'type':custom_field_col,'for_users':for_users,'user_id':"{{ Auth::user()->id }}",'selectedListsIDs':selectedListsIDs},
                    beforeSend: function () {
                        $(".blockUI").show();
                    },
                    complete: function () {
                        $(".blockUI").hide();
                    },
                    success: function (data) {

                        checkbox_html += data.html;
                        checkbox_html += '</select>';
                        checkbox_html += '<small id="advance_option3-error" class="error invalid-feedback p-right"></small>';
                        $("#div_adv_3_" + field_index).html(checkbox_html);
                        $("#" + custom_field_col + '_' + field_index).multiselect('rebuild');

                    }
                });
            }
            else {
                $("#div_adv_3_" + value).html('<input type="text" class="form-control textsystem" ><small id="advance_option3-error" class="error invalid-feedback p-right"></small>');
            }
        } 
        
        function getIndex()
        {
            $('.div_adv').each(function(i, obj) {
                if(i==1)
                    $('#btn-new3').css('pointer-events','none');
                $(this).attr('id','div_adv_3_'+i);
            });
        }
        function enableDiv()
        {
            $('#btn-new3').removeAttr('style');
        }
        function hasError()
        {
            $('.error').hide();
            error = true;
           // broadcast_type = $('input[name="broadcast_type"]:checked').val();
            campaignChk = $('input[name="campaignChk"]:checked').val();
            segment_type = $('input[name=segment_type]:checked').val();
            criteria = $('#opens-clicks-status').val();
            criteria_camp = $('#opens-clicks-campaign').val();
            if(segment_type==1)
            {
                 if(campaignChk==undefined)
                {
                    Command: toastr["error"]("{{trans('segments.add.error.broadcast')}}");
                    error = false;
                }
                 else if(campaignChk=='custom' && criteria_camp=="")
                 {
                     Command: toastr["error"]("{{trans('segments.add.error.select_broadcast')}}");
                     error = false;
                 }
                else if(criteria=="")
                {
                    Command: toastr["error"]("{{trans('segments.add.error.criteria')}}");
                    error = false;
                }

            }
            return error;
        }
        $(document).ready(function () {
            /*$("#advanceMemberSelect1").select2();
            $("#advanceMemberSelect2").select2();
            $("#selectList1").select2();
            $("#selectList12").select2();
            */
            $('.segment_list').prop('checked',false);
            $("#submit").click(function(){
                $("#segmentation").submit();
            });
        });
        $(document).ready(function () {
            // validate rules
            $("#segmentation").validate({
                rules: {
                    'name': "required",
                },
                messages: {
                    "name": "Enter the Segment Name"
                },
                submitHandler: function (form) {
                    $('#submit').prop("disabled", true);
                    if($("#segment_type_list").is(':checked')){
                        var list_array = [];
                        $('.list_array:checked').each(function() {
                            list_array.push($(this).val());
                        });
                        if($("#segment-list-custom").is(':checked')){
                            if(list_array.length==0){ console.log("sssss");
                                $("#list_ids_error").show();
                                $('#submit').prop("disabled", false);
                                return false;
                            }

                        }else{
                            $("#list_ids_error").hide();
                        }
                    }

                    var form_data = $("#segmentation").serialize();
                    if($("input[name='segment_type']:checked").val()==0){
                        form_data += '&segment_list_db='+$("input[name='segment_list']:checked").val();
                    }
                    if($('#advance').is(':checked'))
                        form_data +='&list_type=advance'
                    
                    var method = 'POST';
                        //var url = "{{route('segments.update','')}}/"+$('#segment-id').val();
                        url = "{{ route('segments.store') }}";
                        messsage = "{{trans('common.message.update')}}";
                    

                    $.ajax({
                        url: url,
                        type: method,
                        data: form_data,
                        beforeSend: function () {
                            $(".blockUI").show();
                            $("#modal-loading").modal('show');
                            $('#submit').prop("disabled", true);
                        },
                        complete: function () {
                            $(".blockUI").hide();
                            $("#modal-loading").modal('hide');
                            $('#submit').prop("disabled", false);
                        },
                        success: function (data) {
                            $('#submit').prop("disabled", false);
                            if(data.hasOwnProperty('status') && data.status=="error")
                            {
                                 Command: toastr["error"](data.message);
                                return;
                            }
                            if(data.validation_failed!=undefined)
                            {
                                var x;
                                messages = data.messages;
                                for (x in messages) {
                                    $('#'+x).addClass('is-invalid');
                                    id = '#'+x+'-error';
                                    $(id).html(messages[x]);
                                    $(id).css('display','block');
                                }
                            }
                            else {
                                Command: toastr["success"]("{{trans('common.message.create')}}");
                                window.setTimeout(function () {
                                    window.location.href = "{{ route('segments.index') }}";
                                }, 3000);
                            }

                        }
                    });
                }
            });
        });
        // load custom field in apply filter when segment Based on Contact Lists
        function loadCustomFieldsValues(custom_field_name, val,custom_field_id)
        {
            var custom_field_array = custom_field_id.split('_');
            var custom_id_number = custom_field_array[3];
            var custom_field_condition = custom_field_name.replace('custom_field_name', 'custom_field_condition');
            var custom_field_value = custom_field_condition.replace('custom_field_condition', 'custom_field_value');
            var custom_field_date_value = custom_field_condition.replace('custom_field_condition', 'custom_date_field_value');
            custom_field_value_country = custom_field_condition.replace('custom_field_condition', 'custom_field_value_country');
            var type = $("[name='"+custom_field_name+"']").find(':selected').data('type');
            $("#custom_field_condition_"+custom_id_number).removeClass('date_condition');
            if (type == 'text' || type == 'textarea') {
                $("#custom_field_condition_"+custom_id_number).html(
                    "<option value='is'>{{trans('segments.filter.is')}}</option>"+
                    "<option value='is_not'>{{trans('segments.filter.is_not')}}</option>"+
                    "<option value='contain'>{{trans('segments.filter.contain')}}</option>"+
                    "<option value='not_contain'>{{trans('segments.filter.does_not_contain')}}</option>"+
                    "<option value='start_with'>{{trans('segments.filter.starts_with')}}</option>"+
                    "<option value='end_at'>{{trans('segments.filter.ends_at')}}</option>"+
                    "<option value='first_alpha_greater_equal'>{{trans('segments.filter.first_alphabet_greater_equal')}}</option>"+
                    "<option value='first_alpha_lesser_equal'>{{trans('segments.filter.first_alphabet_lesser_equal')}}</option>");
                $("#custom_field_condition_"+custom_id_number).select2({
                });

                if(type == 'textarea')
                    $("#div_custom_field_value_"+custom_id_number).html("<textarea  id='custom_field_value_"+custom_id_number+"' placeholder='{{trans('segments.add_new.field.comma_separated_list')}}' class='form-control custom_field_value' name='"+custom_field_value+"'></textarea>");
                else
                    $("#div_custom_field_value_"+custom_id_number).html("<input type='text' id='custom_field_value_"+custom_id_number+"' placeholder='{{trans('segments.add_new.field.comma_separated_list')}}' class='form-control custom_field_value' name='"+custom_field_value+"'/>");
            }else if (type == 'email') {

                $("#custom_field_condition_"+custom_id_number).html( "<option value='is'>{{trans('segments.filter.is')}}</option>"+
                    "<option value='is_not'>{{trans('segments.filter.is_not')}}</option>"+
                    "<option value='contain'>{{trans('segments.filter.contain')}}</option>"+
                    "<option value='not_contain'>{{trans('segments.filter.does_not_contain')}}</option>"+
                    "<option value='start_with'>{{trans('segments.filter.starts_with')}}</option>"+
                    "<option value='end_at'>{{trans('segments.filter.ends_at')}}</option>"+
                    "<option value='domain_is'>{{trans('segments.filter.domain_is')}}</option>"+
                    "<option value='domain_is_not'>{{trans('segments.filter.domain_is_not')}}</option>"+
                    "<option value='first_alpha_greater_equal'>{{trans('segments.filter.first_alphabet_greater_equal')}}</option>"+
                    "<option value='first_alpha_lesser_equal'>{{trans('segments.filter.first_alphabet_lesser_equal')}}</option>"
                );
                $("#custom_field_condition_"+custom_id_number).select2({
                });
                var custom_field_value = custom_field_condition.replace('custom_field_condition', 'custom_field_value');

                $("#div_custom_field_value_"+custom_id_number).html("<input type='text' id='custom_field_value_"+custom_id_number+"' placeholder='{{trans('segments.add_new.field.comma_separated_list')}}' class='form-control custom_field_value' name='"+custom_field_value+"'/>");
            }else if (type == 'checkbox' || type == 'select' || type == 'radio'){
                $("#custom_field_condition_"+custom_id_number).html(is_isNot_options);
                $("#custom_field_condition_"+custom_id_number).select2({
                });

                if($("#custom_field_name_"+custom_id_number).val()==6){
                    var checkbox_html = '<div id="countrBlk_'+custom_id_number+'" class="filterradio cfield kt-radio-inline"><label for="country_any_'+custom_id_number+'" class="kt-radio"><input type="radio" value="any" name="'+custom_field_value_country+'" class="country_options" checked="" id="country_any_'+custom_id_number+'">Any Country <span></span></label> <label for="country_select_'+custom_id_number+'" class="kt-radio"><input type="radio" class="country_options" value="custome_country" name="'+custom_field_value+'" id="country_select_'+custom_id_number+'">Selected Country <span></span></label></div><select style="display:none;" class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_'+custom_id_number+'"  name="'+custom_field_value+'" ></select>';
                    $("#div_custom_field_value_"+custom_id_number).html(checkbox_html);
                }
                else{
                    if(type == 'checkbox')
                        select_class = 'class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300"';
                    else
                        select_class = 'class="form-control m-select2"';


                    var checkbox_html = '<select '+select_class+' data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_'+custom_id_number+'"  name="'+custom_field_value+'[]" >';


                    if($("#custom_field_name_"+custom_id_number).val()=='subscriber_status'){
                        checkbox_html +="<option value='active'>{{trans('segments.filter.subscriber.values.active')}}</option>";
                    }else if($("#custom_field_name_"+custom_id_number).val()=='subscription_status'){
                        checkbox_html += "<option value='unsubscribed'>{{trans('segments.filter.subscriber.values.unsubscribed')}}</option>";
                    }else if($("#custom_field_name_"+custom_id_number).val()=='suppression_status'){
                        checkbox_html += "<option value='suppressed'>{{trans('Suppressed')}}</option>";
                    }else if($("#custom_field_name_"+custom_id_number).val()=='confirmation_status'){
                        checkbox_html += "<option value='confirmed'>{{trans('segments.add_new.field.confirmed')}}</option>";
                    }else if($("#custom_field_name_"+custom_id_number).val()=='complained_status'){
                        checkbox_html += "<option value='1'>{{trans('segments.filter.subscriber.options.spammed')}}</option>";
                    }else if($("#custom_field_name_"+custom_id_number).val()=='content_format'){
                        checkbox_html += "<option value='html'>{{trans('segments.add_new.field.html')}}</option>";
                        checkbox_html += "<option value='text'>{{trans('segments.add_new.field.text')}}</option>";
                    }
                    else if($("#custom_field_name_"+custom_id_number).val()=='bounce_status')
                    {
//                        checkbox_html += "<option value='no_process'>{{trans('segments.add_new.field.not_bounced')}}</option>";
                        checkbox_html += "<option value='hard'>{{trans('segments.add_new.field.hard_bounce')}}</option>";
                        checkbox_html += "<option value='soft'>{{trans('segments.add_new.field.soft_bounce')}}</option>";
                    }else{
                        var data_value = $("#custom_field_name_"+custom_id_number).find(':selected').attr('data_value');

                        if(data_value!=""){
                            var data_value_array = data_value.split("\n");
                            $.each( data_value_array, function( key, value ) {
                                checkbox_html +='<option value="'+value+'">'+value+'</option>';
                            });
                        }
                    }

                    checkbox_html +='</select>';
                    $("#div_custom_field_value_"+custom_id_number).html(checkbox_html);

                    if(type == 'checkbox')
                        $("#custom_field_value_"+custom_id_number).multiselect('rebuild');
                    else{
                        $("#custom_field_value_"+custom_id_number).select2({
                        });
                    }
                }

            } else if (type == 'date') {

                if($("#custom_field_name_"+custom_id_number).val()=='creation_date'){
                    $("#custom_field_condition_"+custom_id_number).html(create_date_conditions);
                }else{
                    $("#custom_field_condition_"+custom_id_number).html(date_conditions);
                }
                $("#custom_field_condition_"+custom_id_number).addClass('date_condition');

                var db_date_div = date_div;
                db_date_div = db_date_div.replace('custom_field_date_value_0','custom_field_date_value_'+custom_id_number);
                db_date_div = db_date_div.replace('custom_field_date_value',custom_field_date_value);
                //var days_time_value_name = custom_field_date_value.replace('dynamic_filter','days_time_value');
                //custom_field_date_value

                $("#div_custom_field_value_"+custom_id_number).html(db_date_div);
                $("#custom_field_date_value_"+custom_id_number).datepicker({
                    format: 'yyyy-mm-dd',
                    //endDate: '+0d',
                    autoclose: true
                }).datepicker("setDate",'');

                
            }
            else if(type == 'number')
            {
                $("#custom_field_condition_"+custom_id_number).html(
                    "<option value='is'>{{trans('segments.filter.is')}}</option>"+
                    "<option value='is_not'>{{trans('segments.filter.is_not')}}</option>"+
                    "<option value='contain'>{{trans('segments.filter.contain')}}</option>"+
                    "<option value='not_contain'>{{trans('segments.filter.does_not_contain')}}</option>"+
                    "<option value='lesser_than'>{{trans('segments.filter.lesser_than')}}</option>"+
                    "<option value='greater_than'>{{trans('segments.filter.greater_than')}}</option>");
                $("#custom_field_condition_"+custom_id_number).select2({
                });
                $("#div_custom_field_value_"+custom_id_number).html("<input type='number' id='custom_field_value_"+custom_id_number+"'  class='form-control custom_field_value' name='"+custom_field_value+"'/>");
            }
        }
        // load subscriber condition in apply filter when segment Based on Statistics
        function loadSubscriberConditions(subscriber_field_name, val, field_id)
        {
            var field_id_array = field_id.split('_');
            var id_number = field_id_array[3];


            var subscriber_field_value = subscriber_field_name.replace('subscriber_field_name', 'subscriber_field_value');
            var div_subscriber_field_value = '';
            if(val=='sending_node' || val=='sending_domain' || val=='bounce_email' || val=='send_from_email' || val=='reply_to_email' || val=='recipient_email' || val=='schedule_label'  || val=='message_id'){
                log_notification_filter++;
            }else{
                log_notification_filter--;
            }
            showLogNotification();
            if(val=='contact_list' || val=='sending_node' || val=='sending_domain' || val=='bounce_email'){
                $("#subscriber_condition_name_"+id_number).html(is_isNot_options);
                div_subscriber_field_value += '<select class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300" data-width="100%" data-label="left" data-select-all="true" id="subscriber_field_value_'+id_number+'"  name="'+subscriber_field_value+'[]" >';
                $.ajax({
                    url: "{{ URL::route('get.other.options') }}",
                    type: "POST",
                    data: {'values': val},
                    success: function(result) {
                        $("#div_subscriber_field_value_"+id_number).html(div_subscriber_field_value);
                        $("#subscriber_field_value_"+id_number).html(result);
                        $("#subscriber_field_value_"+id_number).multiselect('rebuild');
                    }
                });

            }else if(val=='subscription_status'){ 
                $("#subscriber_condition_name_"+id_number).html(is_isNot_options);
                var condition = '<select class="form-control m-select2" data-width="100%" data-label="left" data-select-all="true" id="subscriber_field_value_'+id_number+'"  name="'+subscriber_field_value+'" >';
                condition += "<option value='unsubscribed'>{{trans('segments.filter.subscriber.values.unsubscribed')}}</option>";
                $("#div_subscriber_field_value_"+id_number).html(condition); 
            }else{
                $("#subscriber_condition_name_"+id_number).html(is_isNot_options+contain_not_contain);
                div_subscriber_field_value ='<input class="form-control" type="text" id="subscriber_field_value_'+id_number+'" name="'+subscriber_field_value+'" value="">';
                $("#div_subscriber_field_value_"+id_number).html(div_subscriber_field_value);
            }
        }
        function showLogNotification(){
            if(log_notification==1 || log_notification_filter>0){
                $("#log_notification").show();
            }else{
                $("#log_notification").hide();
            }
        }
        function enableActivityFields(check_uncheck){
            $(".has_bounce").hide();
            if(check_uncheck==0){
                $("#lick_click, #not_a_click, #linksType, #linksType2, #country_any, #country_select, #state_any, #state_select, #city_any, #city_select, #zip_any, #zip_select, #brows_any, #brows_select,#os_any, #os_select").attr("disabled", true);
                $('#linksType').prop('checked',true);
                $('#country_any').prop('checked',true);
                $('#state_any').prop('checked',true);
                $('#city_any').prop('checked',true);
                $('#zip_any').prop('checked',true);
                $('#brows_any').prop('checked',true);
                $('#os_any').prop('checked',true);
                //$("#none").prop('checked',true);
                $('#linksType2').prop('checked',false);
                $('#country_select').prop('checked',false);
                $('#state_select').prop('checked',false);
                $('#city_select').prop('checked',false);
                $('#zip_select').prop('checked',false);
                $('#brows_select').prop('checked',false);
                $('#os_select').prop('checked',false);
                $('#custom').prop('checked',false);

                $("#selected_links").hide();
                $("#countrySelect").hide();
                $("#state_block").hide();
                $("#city_block").hide();
                $("#zip_block").hide();
                $("#brows_block").hide();
                $("#os_block").hide();
                $("#duration_filter").hide();
                $("#selected_links").html("");
                $("#opens_clicks_region").html("");
                $("#opens_clicks_city").html("");
                $("#opens_clicks_zip").html("");
                $(".group_1").hide();
                $(".group_2").hide();
                $(".has_opened_broadcast").hide();
            }else{
                $("#lick_click, #not_a_click, #linksType, #linksType2, #country_any, #country_select, #state_any, #state_select, #city_any, #city_select, #zip_any, #zip_select, #brows_any, #brows_select,#os_any, #os_select").attr("disabled", false);
                $(".group_1").css("display", "flex");
                $(".group_2").css("display", "flex");
                $('#linksType').prop('checked',true);
                $('#country_any').prop('checked',true);
                $('#state_any').prop('checked',true);
                $('#city_any').prop('checked',true);
                $('#zip_any').prop('checked',true);
                $('#brows_any').prop('checked',true);
                $('#os_any').prop('checked',true);
                //$("#none").prop('checked',true);
                $('#linksType2').prop('checked',false);
                $('#country_select').prop('checked',false);
                $('#state_select').prop('checked',false);
                $('#city_select').prop('checked',false);
                $('#zip_select').prop('checked',false);
                $('#brows_select').prop('checked',false);
                $('#os_select').prop('checked',false);
                $('#custom').prop('checked',false);
                $(".has_opened_broadcast").show();
                $("#duration_filter").hide();
            }
        }
        // get value from selected Criteria when segment Based on Statistics
        function getValue(field_id, table, get_value, field, value,block_id="")
        {
            if (value != '') {
                if(value == 'has_opened_broadcast'){
                    
                    $("#boptsType, #boptsReason, #soft_bounces, #hard_bounced, #chsRs1, #bounce_condition, #bounce_value").prop( "disabled", true);
                    enableActivityFields(1);
                    $(".group_2").show();
                    log_notification = 0;
                    showLogNotification();
                }
                else if(value == 'hasnt_opened_broadcast' || value == 'has_unsubscribed' || value == 'has_complained'){
                    $('#country_any, #country_select, #state_any, #state_select, #city_any, #city_select , #zip_any, #zip_select, #brows_any, #brows_select, #os_any, #os_select, #links_any, #links_select').prop( "disabled", true );
                   
                    $("#boptsType, #boptsReason, #soft_bounces, #hard_bounced, #chsRs1, #bounce_condition, #bounce_value").prop( "disabled", true);
                    enableActivityFields(0);
                    if(value == 'hasnt_opened_broadcast'){
                        $(".group_2").show();
                        log_notification = 1;
                    }else{
                        $(".group_2").hide();
                        log_notification = 0;
                    }
                    
                   showLogNotification();
                    return ;
                }
                else if(value == 'delivery_status' || value == 'injected' || value == 'delivered' || value == 'delayed' || value == 'is_sent' || value == 'never_sent'){
                    $('#country_any, #country_select, #state_any, #state_select, #city_any, #city_select , #zip_any, #zip_select, #brows_any, #brows_select, #os_any, #os_select, #links_any, #links_select').prop( "disabled", true );
                    $(".group_1").hide();
                    //$(".group_2").css("display", "flex");
                    $(".group_2").hide();
                    $("#none, #custom").prop( "disabled", false );
                    $(".has_bounce").hide();
                    $(".has_opened_broadcast").hide();
                    $("#boptsType, #boptsReason, #soft_bounces, #hard_bounced, #chsRs1, #bounce_condition, #bounce_value").prop( "disabled", true);
                    enableActivityFields(0);
                     window.setTimeout(function () {
                        let isChecked = $('#takenBefore').is(':checked');
                        
                        if(value == 'never_sent' && isChecked){
                           log_notification = 0;
                        }else{
                            log_notification = 1;
                        }
                        showLogNotification();
                     }, 3000);
                    if(value == 'is_sent'){
                        $(".group_2").show();
                    }else{
                        $(".group_2").hide();
                    }
                    showLogNotification();
                    return ;
                }
                else if(value == 'bounced'){
                    $('#country_any, #country_select, #state_any, #state_select, #city_any, #city_select , #zip_any, #zip_select, #brows_any, #brows_select, #os_any, #os_select, #links_any, #links_select').prop( "disabled", true );
                    $(".group_1").hide();
                    //$(".group_2").css("display", "flex");
                    $(".group_2").hide();
                    $("#none, #custom").prop( "disabled", false );
                    $("#boptsType, #boptsReason, #soft_bounces, #hard_bounced, #chsRs1, #bounce_condition, #bounce_value").prop( "disabled", false);
                    $(".has_bounce").show();
                    $(".has_opened_broadcast").hide();
                    ////enableActivityFields(0);
                    return ;
                }
                else {

                }
                if(log_notification == 1){
                    $("#log_notification").show();
                } 
            } else {
                if(value=='')
                {
                    $('#country_any, #country_select, #state_any, #state_select, #city_any, #city_select , #zip_any, #zip_select, #brows_any, #brows_select, #os_any, #os_select, #links_any, #links_select').prop( "disabled", true );
                    /*$(".group_1").hide();
                    $(".group_2").hide();
                    $("#countryBlk").hide();
                    $("#state_block").hide();
                    $("#city_block").hide();
                    $("#zip_block").hide();
                    $("#duration_filter").hide();
                    $("#countrySelect").hide();
                    $(".has_bounce").hide();
                    $(".has_opened_broadcast").hide();
                    */
                    $("#boptsType, #boptsReason, #soft_bounces, #hard_bounced, #chsRs1, #bounce_condition, #bounce_value").prop( "disabled", true);
                    enableActivityFields(0);
                    return ;
                }
                if (field_id == 'opens_clicks_region') {
                    $('#opens_clicks_city').empty();
                    $('#opens_clicks_zip').empty();
                    $('#opens_clicks_city').prop( "disabled", true );
                    $('#opens_clicks_zip').prop( "disabled", true );
                } else if (field_id == 'opens_clicks_city') {
                    $('#opens_clicks_zip').empty();
                    $('#opens_clicks_zip').prop( "disabled", true );
                }
                $('#'+field_id).empty();

                $('#'+field_id).prop( "disabled", true );
            }
            showLogNotification();
            if(value == 'hasnt_opened_broadcast' || value == 'has_opened_broadcast'){
                    $("#custom").attr('disabled',false); ///$('#custom')
                    $("#none").attr('disabled',false); ///$('#custom')                
                    $("#custom").show();
                    $("#none").show(); 
                    $(".group_2").show();
                   /// console.log("custm none");
            }else{
                $("#custom").attr('disabled',true);
                $("#none").attr('disabled',true);                
                $("#custom").hide();
                $("#none").hide(); 
                $(".group_2").hide();
            }
            return false;
        }
        function getStates(){
        $.ajax({
            url: "{{ URL::route('segment.get.states') }}",
            type: "POST",
            data: {'countries':$("#opens-clicks-country").val(),'selectedOpensClicksRegion':$("#selectedOpensClicksRegion").val()},
            success: function(options) {
                $('#state_block').html(options);
                $('#opens_clicks_region').multiselect({'rebuild':true, includeSelectAllOption: true});
                if($("#selectedOpensClicksRegion").val()!=""){
                    getCities();
                }
            }
        });
    }
    function getCities(){
        $.ajax({
            url: "{{ URL::route('segment.get.cities') }}",
            type: "POST",
            data: {'opens_clicks_region':$("#opens_clicks_region").val(),'selectedOpensClicksCity':$("#selectedOpensClicksCity").val()},
            success: function(options) {
                $('#city_block').html(options);
                $('#opens_clicks_city').multiselect({'rebuild':true, includeSelectAllOption: true});
                if($("#selectedOpensClicksCity").val()!=""){
                    getZips();
                }
            }
        });
    }
    function getZips(){
        $.ajax({
            url: "{{ URL::route('segment.get.zips') }}",
            type: "POST",
            data: {'opens_clicks_city':$("#opens_clicks_city").val(),'selectedopensClicksZip':$("#selectedopensClicksZip").val()},
            success: function(options) {
                $('#zip_block').html(options);
                $('#opens_clicks_zip').multiselect({'rebuild':true, includeSelectAllOption: true});
            }
        });
    }
        function replaceCustomDivHTML(){

            custom_sections++;
            window.setTimeout(function () {
                $(".custom_field_name").last().attr('id','custom_field_name_'+custom_sections);
                $(".custom_field_condition").last().attr('id','custom_field_condition_'+custom_sections);
                $(".custom_field_value").last().attr('id','custom_field_value_'+custom_sections);
                $(".div_custom_field_value").last().attr('id','div_custom_field_value_'+custom_sections);
                $("#grip_0").attr("id","grip_"+custom_sections);
                //$("#custom_field_name_"+custom_sections).select2({
                //});
                $("#custom_field_condition_"+custom_sections).select2({
                });
                $("#select2-custom_field_name_"+custom_sections+"-container").text($("#select2-custom_field_name_0-container").text());
                $("#select2-custom_field_condition_"+custom_sections+"-container").text($("#select2-custom_field_condition_0-container").text());
                for (step = 0; step <= custom_sections; step++) {

                    $("#custom_field_name_"+step).select2({
                    });
                }
            }, 100);

        }
        // add filters html 
        function replaceSubscriberDivHTML(){
            subcriber_sections++;        
            window.setTimeout(function () {
                 $(".subscriber_field_name").last().attr('id','subscriber_field_name_'+subcriber_sections);
                 $(".subscriber_condition_name").last().attr('id','subscriber_condition_name_'+subcriber_sections);
                 $(".subscriber_field_value").last().attr('id','subscriber_field_value_'+subcriber_sections);
                 $(".div_subscriber_field_value").last().attr('id','div_subscriber_field_value_'+subcriber_sections);

                 $("#div_subscriber_field_value_"+subcriber_sections).html('<input type="text" name="subscriber_field_value" class="form-control">');

                 $("#subsciber_grid_0").attr("id","subsciber_grid_"+subcriber_sections);
                 $("#subsciber_grid_"+subcriber_sections).addClass('system_data');
                 $("#subscriber_field_name_"+subcriber_sections).select2({
                });
                $("#subscriber_condition_name_"+subcriber_sections).select2({
                });
                $("#subscriber_field_value_"+subcriber_sections).select2({
                });
                $("#select2-subscriber_field_name_"+subcriber_sections+"-container").text($("#select2-subscriber_field_name_0-container").text());
                $("#select2-subscriber_condition_name_"+subcriber_sections+"-container").text($("#select2-subscriber_condition_name_0-container").text());


             }, 100);

        }

        function updateDays(days="") {  
    
            if(days == "") { 
                $("#log_notification").hide();
            
            }  else { 
                var codeText = $('.alert-text.keepLogFor code').text();
                $('.alert-text.keepLogFor code').text( days + " days");
            }
        }
        $(function() { 
            getCampaignLinks();
        });

        //replaceCustomDivHTML
        //added by azeem dated 11-3-2019
        //added by azeem dated 03-4-2196**************** get campaign links ************************
        function getCampaignLinks(){
            var campaignChk = $("input[name=campaignChk]:checked").val();
            var opens_clicks_campaign = $("#opens-clicks-campaign").val();
            var broadcast_type = $("input[type='radio'][name='broadcast_type']:checked").val();
            log_notification = 1;
            showLogNotification();
            updateDays(<?php echo $keep_log_for; ?>);
            if($("#opens-clicks-status").val()== 'has_opened_broadcast')  updateDays(<?php if(getSetting("delete_emailopenlogs_flag") == "on") echo  getSetting("delete_emailopenlogs"); ?>);
            if($("#opens-clicks-status").val()== 'hasnt_opened_broadcast') updateDays(<?php if(getSetting("delete_emailclicks_flag") == "on") echo getSetting("delete_emailopenlogs"); ?>);
            if($("#opens-clicks-status").val()== 'bounced') updateDays(<?php if(getSetting("delete_emailbounced_flag") == "on") echo getSetting("delete_emailbounced"); ?>);
            if($("#opens-clicks-status").val()== 'has_unsubscribed') updateDays(<?php if(getSetting("delete_unsubscribed_flag") == "on") echo getSetting("delete_unsubscribed"); ?>);


            if(broadcast_type=='global_broadcasts'){
                opens_clicks_campaign = []
            }
            if(typeof broadcast_type !== 'undefined'){ 
                $.ajax({
                    url: "{{ URL::route('get.campaign.links') }}",
                    type: "POST",
                    data: {'campaignChk': campaignChk, 'opens_clicks_campaign':opens_clicks_campaign,'broadcast_type':broadcast_type,'selectedClickedLinks':$("#selectedClickedLinks").val()},
                    success: function(options) {
                        $('#selected_links').html(options);
                        $("#links_clicked").multiselect({'rebuild':true, includeSelectAllOption: true});
                    }
                });
            }
        }
        //end added by azeem dated 03-4-2196**************** get campaign links ************************

        $(document).ready(function() {

            //added by azeem dated 03-4-2196**************** get campaign links ************************
            $("#opens-clicks-status").change(function(){
                getCampaignLinks();
            });
            //end added by azeem dated 03-4-2196**************** get campaign links ************************

            $('#listBtn2').on('click', function(){
                if($("#name").val() == "") {
                    $("#name").css("border-color", "red");
                    return false;
                } else {
                    var segName = $("#name").val();
                    $("#segOpts2").hide();
                    $(".segName").html(segName);
                    $(".segName").fadeIn(500);
                    $("#segOpts").hide();
                    $("#lists").show();
                    $("#filters").show();
                    $("#filters2").hide();
                    $("#save").show();
                    $("#modal-loading").modal("hide");
                }
            });
            $('#campBtn2').on('click', function(){
                if($("#name").val() == "") {
                    $("#name").css("border-color", "red");
                    return false;
                } else {
                    var segName = $("#name").val();
                    $("#segOpts2").hide();
                    $(".segName").html(segName);
                    $(".segName").fadeIn(500);
                    $("#segOpts").hide();
                    $("#camps").show();
                    $("#filters").hide();
                    $("#filters2").show();
                    $("#save").show();
                }
            });

//            $(".listOps").click(function() {
//                $("#listBtn2").show();
//                $("#campBtn2").hide();
//            });
//            $(".statsOpts").click(function() {
//                $("#listBtn2").hide();
//                $("#campBtn2").show();
//            });

            $("#boptsType").click(function() {
                $("#chsType").show();
                $("#chsReas").hide();
            });
            $("#boptsReason").click(function() {
                $("#chsType").hide();
                $("#chsReas").css("display", "flex");
            });
            $("#chsRs1").on("change", function() {
                if($(this).val()=='bounce_code' || $(this).val()=='bounce_reason'){
                    var bounce_html = '<select class="form-control m-select2" name="bounce_value[]" id="bounce_value" multiple=""></select>';
                    if($(this).val()=='bounce_code'){
                        var newUrl = "{{ url('/') }}"+'/bounce/data/code';
                    }else{
                        var newUrl = "{{ url('/') }}"+'/bounce/data/reason';
                    }
                    $("#bounce_condition").html(is_isNot_options);
                    $.ajax({
                        url: newUrl,
                        type: 'GET',
                        success: function(result) {
                            $("#div_bounce_value").html(bounce_html);
                            $("#bounce_value").html(result);
                            $("#bounce_value").multiselect('rebuild');
                        }
                    });
                }else{
                    $("#bounce_condition").html(is_isNot_options+"<option value='contain'>{{trans('segments.filter.contain')}}</option>");
                    $("#div_bounce_value").html('<input type="text" name="bounce_reason_detail" id="bounce_reason_detail" class="form-control">');
                }


            });

            $("#lick_click").click(function() {
                $("#andLinks").toggleClass("hide");
            });
            $("#linksType2").click(function() {
                $("#selected_links").show();
            });
            $("#linksType").click(function() {
                $("#selected_links").hide();
            });

            $("#name").keydown(function(){
                $(this).css("border-color", "#c2cad8");
            });

            $("#campaign_any").click(function() {
                $("#opens-clicks-campaign").attr("disabled", "disabled");
                $("#campaign_block").hide();
                getCampaignLinks();
                //$('.has_opened_broadcast').show();
                $('#selected_links').hide();
                // log_notification = 0;
                // showLogNotification();
            });

            $("#campaign_select").click(function() {
                $("#opens-clicks-campaign").removeAttr("disabled");
               $("#campaign_block").show();
               getCampaignLinks();

               ///$("#links_clicked").empty();
           });

            $("#country_any").click(function() {
                $("#countryBlk").hide();
            });

            $("#country_select").click(function() {
                $("#countryBlk").show();
            });

            $("#state_any").click(function() {
                $("#state_block").hide();

            });

            $("#state_select").click(function() {
                $('.error').hide();
                if($('#country_select').is(':checked')==false)
                {
                    $('#country_select-error').show();
                    return false;
                }
                $("#state_block").show();
            });

            $("#city_any").click(function() {
                $("#city_block").hide();
            });

            $("#city_select").click(function() {
                $('.error').hide();
                if($('#country_select').is(':checked')==false)
                {
                    $('#country_select-error').show();
                    return false;
                }
                if($('#state_select').is(':checked')==false)
                {
                    $('#state_select-error').show();
                    return false;
                }
                $("#city_block").show();
            });

            $("#zip_any").click(function() {
                $("#zip_block").hide();
            });

            $("#zip_select").click(function() {
                $('.error').hide();
                if($('#country_select').is(':checked')==false)
                {
                    $('#country_select-error').show();
                    return false;
                }
                if($('#state_select').is(':checked')==false)
                {
                    $('#state_select-error').show();
                    return false;
                }
                if($('#city_select').is(':checked')==false)
                {
                    $('#city_select-error').show();
                    return false;
                }
                $("#zip_block").show();
            });

            $("#brows_any").click(function() {
                $("#opens-clicks-browser").attr("disabled", "disabled");
                $("#brows_block").hide();
            });

            $("#brows_select").click(function() {
                $("#opens-clicks-browser").removeAttr("disabled");
                $("#brows_block").show();
            });

            $("#os_any").click(function() {
                $("#opens-clicks-os").attr("disabled", "disabled");
                $("#os_block").hide();
            });

            $("#os_select").click(function() {
                $("#opens-clicks-os").removeAttr("disabled");
                $("#os_block").show();
            });

            $("#campaign_select").click(function() {
                $("#campaign_block").show();
            });

            $("#links_any").click(function() {
                $("#links_block").hide();
            });

            $("#links_select").click(function() {
                $("#links_block").show();
            });

            $(document).on("change", ".mt-repeater-row>.col-md-4:first-child>select", function () {
                el_class = this.value;
                $('.'+el_class).attr('disabled','disabled');
                $('.'+el_class).addClass('selected');
            });

            $(".fromto").datepicker({
                format: 'yyyy-mm-dd',
                //endDate: '+0d',
                autoclose: true
            });


            $("#custom").click(function() {
                $("#duration_filter").show();
                // $("#opens_clicks_dynamic_filter").attr("disabled", false);
            });
            $("#none").click(function() {
                $("#duration_filter").hide();
                ///$("#opens_clicks_dynamic_filter").attr("disabled", true);
            });

            $(".dynamic_duration").hide();
            $(".custom_duration").hide();
            ///$("#opens_clicks_dynamic_filter").attr("disabled","disabled");
            $("#days_time_value").attr("disabled","disabled");
            $("#days_time").attr("disabled","disabled");
            $('#opens_clicks_start_date').attr("disabled","disabled");
            $('#opens_clicks_start_time').attr("disabled","disabled");
            $('#opens_clicks_end_date').attr("disabled","disabled");
            $('#opens_clicks_end_time').attr("disabled","disabled");
            // select list
            $('.segment_list').on('click', function(){
                $('.checkbox-index').prop('checked', false);
                var value = $(this).val();
                if(value == "global"){
                    $('#contacts_list').hide();
                    $('#contacts_list2').hide();
                    $('#contacts_list3').hide();
                    $('#advance_list').hide();
                    $('#group').hide();
                }
                else if(value == "custom"){

                    $('#contacts_list').show();
                    $('#contacts_list2').hide();
                    $('#contacts_list3').hide();
                    $('#advance_list').hide();
                    $('#group').hide();

                } else if(value == "groups") {
                    $('#contacts_list').hide();
                    $('#contacts_list2').show();
                    $('#contacts_list3').hide();
                    $('#advance_list').hide();

                } 
                else if(value=='advance') {
                    $('#advance_list').show();
                    $('#where_div').hide();
                    $('#contacts_list').hide();
                    $('#contacts_list2').hide();
                    $('#contacts_list3').hide();
                    $('.advance_option2').val('');
                    //contacts_list2
                }
                else{
                    $('#contacts_list').hide();
                    $('#contacts_list2').hide();
                    $('#group').hide();
                    $('#contacts_list3').show();
                    $('#advance_list').hide();

                }
            });
            // duration by date
            $("#opens_clicks_dynamic_filter").change(function(){
                var opens_clicks_dynamic_filter = $("#opens_clicks_dynamic_filter").val();
                var activity_date_section_html = '';
                if(opens_clicks_dynamic_filter=='after' || opens_clicks_dynamic_filter=='before' || opens_clicks_dynamic_filter=='exactly'){
                    activity_date_section_html = '<div class="input-group date date-picker" data-date-format="dd-mm-yyyy"><input type="text" class="form-control activity_duration"  placeholder="yyyy-mm-dd" id="duration_date" name="duration_date"> <span class="input-group-btn"><button class="btn btn-default" type="button"><i class="la la-calendar"></i></button></span></div>';
                }else if(opens_clicks_dynamic_filter=='between'){
                    activity_date_section_html ='<div class="dpr actrange">';
                    activity_date_section_html +='<div class="input-daterange input-group">';
                    activity_date_section_html +='<input type="text" class="form-control fromto" id="from" name="from" data-date-format="yyyy-mm-dd">';
                    activity_date_section_html +='<div class="input-group-append"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>';
                    activity_date_section_html +='<input type="text" class="form-control fromto" id="to" name="to" data-date-format="yyyy-mm-dd">';
                    activity_date_section_html +='</div>';
                    activity_date_section_html +='</div>';
                }else{
                    activity_date_section_html ='<div class="cusomDate">';
                    activity_date_section_html +='<div class="datefields">';
                    activity_date_section_html +='<input type="number" id="days_time_value" name="days_time_value" class="form-control" placeholder="XX no. of days / time">';
                    activity_date_section_html +='</div>';
                    activity_date_section_html +='<div class="datefields pull-right">';
                    activity_date_section_html +='<select class="form-control m-select2" data-placeholder="{{ trans('segments.add_new.field.select_duration')}}" id="days_time" name="days_time">';
                    activity_date_section_html +='<option value="days" >{{ trans("common.days") }}</option>';
                    activity_date_section_html +='<option value="weeks" >{{ trans("common.weeks") }}</option>';
                    activity_date_section_html +='<option value="months" >{{ trans("common.months") }}</option>';
                    activity_date_section_html +='<option value="years" >{{ trans("common.years") }}</option>';
                    activity_date_section_html +='</select>';
                    activity_date_section_html +='</div>';
                    activity_date_section_html +='</div>';
                }
                $("#activity_date_section").html(activity_date_section_html);
                @if ($page_data['action'] == 'add')
                $(".activity_duration, .fromto, .to").datepicker({
                    format: 'yyyy-mm-dd',
                    //endDate: '+0d',
                    autoclose: true
                }).datepicker("setDate",'');
                @else
                $(".activity_duration, .fromto, .to").datepicker({
                    format: 'yyyy-mm-dd',
                    //endDate: '+0d',
                    autoclose: true
                });
                @endif
            });
        });


        $(document).ready(function() {
            $(".datesystem").datepicker({
                format: 'yyyy-mm-dd',
                //endDate: '+0d',
                autoclose: true
            });
            $("#cfrom").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            $("#cto").datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });
            @if ($page_data['action'] == 'add')
            $(".activity_duration").datepicker({
                format: 'yyyy-mm-dd',
                //endDate: '+0d',
                autoclose: true
            });
            @else
            $(".activity_duration").datepicker({
                format: 'yyyy-mm-dd',
                //endDate: '+0d',
                autoclose: true
            });
            @endif
            @if(count($subscriberFilterFormArray)==0)
            window.setTimeout(function () {

                $("#custom_field_name_0, #custom_field_condition_0, #subscriber_field_name_0, #subscriber_condition_name_0, #subscriber_field_value_0").select2({
                });

            }, 300);
            @endif            
            // select country class
            $(".country_class").click(function(){
                chk_id = $(this).attr("id");
                if(chk_id=='country_select'){
                    $("#countrySelect").show();
                }else{
                    $("#countrySelect").hide();
                }
            });
            $(".opens_clicks_status_class").click(function(){
                $("#opens-clicks-status").closest('.m-select2').remove();
                $('#opens-clicks-status').val("");
                $("#opens-clicks-status").select2({
                });
                $('.m-select2').css('width','100%');
                
                $('option', $('#opens-clicks-country')).each(function(element) { ////console.log("1111");
                    $(this).removeAttr('selected').prop('selected', false);
                });
                $("#opens-clicks-country").multiselect('refresh');

                $("#opens_clicks_region").empty();
                $("#opens_clicks_city").empty();
                $("#opens_clicks_zip").empty();

                if($(this).val()=='custom'){

                    $('#opens_clicks_status_div').show();
                    $('#country_any, #country_select, #state_any, #state_select, #city_any, #city_select , #zip_any, #zip_select, #opens-clicks-browser, #opens-clicks-os, .duration, #opens_clicks_dynamic_filter, #duration_date, #from, #to, #days_time_value, #days_time, #links_any, #links_select, #brows_any, #brows_select, #os_any, #os_select').prop( "disabled", false );
                }else{
                    $('#opens_clicks_status_div').hide();
                    $("#opens_clicks_status").hide();
                    $("#opens-clicks-country").hide();
                    $("#links_block").hide();
                    $("#countrySelect").hide();
                    $("#state_block").hide();
                    $("#city_block").hide();
                    $("#zip_block").hide();
                    $("#brows_block").hide();
                    $("#os_block").hide();
                    $("#country_any").click();
                    $("#state_any").click();
                    $("#city_any").click();
                    $("#zip_any").click();
                    $("#links_any").click();
                    $("#brows_any").click();
                    $("#os_any").click();
                    $('.m-select2').css('width','100%');
                    $('#country_any, #country_select, #state_any, #state_select, #city_any, #city_select , #zip_any, #zip_select, #opens-clicks-browser, #opens-clicks-os , #opens_clicks_dynamic_filter, #duration_date, #from, #to, #days_time_value, #days_time, #links_any, #links_select, #brows_any, #brows_select, #os_any, #os_select').prop( "disabled", true );

                }
            });
            $("#count_segment").click(function(){
                if(!hasError())
                    return false;
                $("#count_segment").attr('disabled',true);
                var form_data = $("#segmentation").serialize();
                if($('#advance').is(':checked'))
                    form_data +='&list_type=advance'
                $.ajax({
                    url: "{{ URL::route('get.segment.count') }}",
                    type: "POST",
                    data: form_data,
                    dataType:'json',
                    timeout:30000,
                    beforeSend: function () {
                        $(".spinner_count").show();
                        $("#segment_total_count").html('<i class="fa fa-spinner fa-spin fa-lg" id="countSegmentSpinner"></i>');
                    },
                    complete: function () {
                       //$(".blockUI").hide();
                        //$("#modal-loading").modal('hide');
                        $("#count_segment").attr('disabled',false);
                    },
                    error: function(jqXHR, textStatus){
                        if(textStatus === 'timeout')
                        {
                            alert("{{trans('segments.user_segment_create_blade.taking_time_segment_alert')}}");
                        }
                    },
                    success: function(data) {
                        if(data.validation_failed!=undefined)
                        {
                            var x;
                            messages = data.messages;
                            $(".spinner_count").hide();
                            for (x in messages) {
                                $('#'+x).addClass('is-invalid');
                                id = '#'+x+'-error';
                                $(id).html(messages[x]);
                                $(id).css('display','block');
                            }
                            $("html, body").animate({ scrollTop: 0 }, "slow");
                        }
                        else if(data.status='success'){                            
                            $("#segment_total_count").html(data.count);
                        }else{
                            alert("{{trans('segments.user_segment_create_blade.fill_compulsary_alert')}}");
                        }

                    }
                });

            });

        });
        $(document).on("change", ".date_condition", function (event) {
            var date_condition_id = $(this).attr('id');
            var date_condition_name = $(this).attr('name');
            var date_condition_id_array = date_condition_id.split('_');
            var date_db_id = date_condition_id_array[3];
            custom_date_field_condition_value = $("#custom_field_condition_"+date_db_id).val();
            if(custom_date_field_condition_value=='after' || custom_date_field_condition_value=='before' || custom_date_field_condition_value=='exactly'){
                var custom_field_date_value = date_condition_name.replace('custom_field_condition', 'custom_date_field_value');
                var db_date_div = date_div;
                db_date_div = db_date_div.replace('custom_field_date_value_0','custom_field_date_value_'+date_db_id);
                db_date_div = db_date_div.replace('custom_field_date_value',custom_field_date_value);

                window.setTimeout(function () {
                    $("#div_custom_field_value_"+date_db_id).html(''+db_date_div);
                    $("#custom_field_date_value_"+date_db_id).datepicker({
                        format: 'yyyy-mm-dd',
                        //endDate: '+0d',
                        autoclose: true
                    });
                }, 300);

            }else if(custom_date_field_condition_value=='between'){
                var days_time_value_from = date_condition_name.replace('custom_field_condition','cfrom');
                var days_time_value_to = date_condition_name.replace('custom_field_condition','cto');

                var new_date_field_db = date_range.replace("csrange",'csrange_'+date_db_id);
                new_date_field_db = new_date_field_db.replace("sfrom_1",'sfrom_'+date_db_id);
                new_date_field_db = new_date_field_db.replace("cfrom",days_time_value_from);

                new_date_field_db = new_date_field_db.replace("sto_1",'sto_'+date_db_id);
                new_date_field_db = new_date_field_db.replace("cto",days_time_value_to);


                window.setTimeout(function () {
                    $("#div_custom_field_value_"+date_db_id).html(''+new_date_field_db);
                    $(".from").datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true
                    });
                    $(".to").datepicker({
                        format: 'yyyy-mm-dd',
                        autoclose: true
                    });
                }, 300);
            }else if(custom_date_field_condition_value=='is_today'){
                var custom_field_date_value = date_condition_name.replace('custom_field_condition', 'custom_date_field_value');
                var db_date_div = date_div_hidden;
                db_date_div = db_date_div.replace('custom_field_date_value_0','custom_field_date_value_'+date_db_id);
                db_date_div = db_date_div.replace('custom_field_date_value',custom_field_date_value);
                $("#div_custom_field_value_"+date_db_id).html(db_date_div);
            }else if(custom_date_field_condition_value=='day_of_month'){
                var custom_field_date_value = date_condition_name.replace('custom_field_condition', 'custom_date_field_value');
                var db_date_div = daysOptions;
                db_date_div = db_date_div.replace('custom_field_date_value_0','custom_field_date_value_'+date_db_id);
                db_date_div = db_date_div.replace('custom_field_date_value',custom_field_date_value);
                $("#div_custom_field_value_"+date_db_id).html(db_date_div);
                $("#custom_field_date_value_"+date_db_id).select2({
                 });
            }else if(custom_date_field_condition_value=='month_of_year'){
                var custom_field_date_value = date_condition_name.replace('custom_field_condition', 'custom_date_field_value');
                var db_date_div = monthOptions;
                db_date_div = db_date_div.replace('custom_field_date_value_0','custom_field_date_value_'+date_db_id);
                db_date_div = db_date_div.replace('custom_field_date_value',custom_field_date_value);
                $("#div_custom_field_value_"+date_db_id).html(db_date_div);
                $("#custom_field_date_value_"+date_db_id).select2({
                 });
            }else{
                var days_time_value_name = date_condition_name.replace('custom_field_condition','days_time_value_name');
                var duration_time = date_condition_name.replace('custom_field_condition','duration_time');

                var new_date_field_db = date_duration.replace("days_value_time_1",'days_value_time_'+date_db_id);
                new_date_field_db = new_date_field_db.replace("custom_duration_1",'custom_duration_'+date_db_id);

                new_date_field_db = new_date_field_db.replace("days_time_value_name",days_time_value_name);
                new_date_field_db = new_date_field_db.replace("duration_time",duration_time);

                $("#div_custom_field_value_"+date_db_id).html(''+new_date_field_db);
            }

            $(".activity_date_section").click(function(){
            });

        });
        $(document).on("change", ".country_options", function (event) {
            var country_field_id = $(this).attr('id');
            var country_field_name = $(this).attr('name');
            var custom_field_value_db = country_field_name.replace('custom_field_value', 'custom_field_value_countries');
            var custom_field_country_array = country_field_id.split('_');
            var custom_id_country_number = custom_field_country_array[2];

            if($("#"+country_field_id).val()=='custome_country'){
                load_countries_ids(custom_id_country_number,custom_field_value_db);
            }else{
                //custom_field_value_country
                var checkbox_html = '<div id="countrBlk_'+custom_id_country_number+'" class="filterradio kt-radio-inline"><label for="country_any_'+custom_id_country_number+'" class="kt-radio"><input type="radio" checked="" value="any" name="'+$(this).attr('name')+'" class="country_options" id="country_any_'+custom_id_country_number+'">{{ trans("segments.add_new.field.any_country")}} <span></span></label> <label for="country_select_'+custom_id_country_number+'" class="kt-radio"><input type="radio" class="country_options" value="custome_country" name="'+$(this).attr('name')+'"  id="country_select_'+custom_id_country_number+'">{{ trans("segments.add_new.field.selected_country")}} <span></span></label></div><select style="display:none;" class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_'+custom_field_value_db+'"  name="'+$(this).attr('name')+'" ></select>';  ;
                $("#div_custom_field_value_"+custom_id_country_number).html(checkbox_html);
                $("#country_"+custom_id_country_number).remove();
            }


        });

        function load_status_fields(){

            status_sections++;
            window.setTimeout(function () {
                $(".my_subs_options").last().attr('id','subscriber_options_'+status_sections);
                $("#subscriber_options_"+status_sections).select2({
                });
                $(".my_subs_conditions").last().attr('id','subscriber_conditions_'+status_sections);
                $("#subscriber_conditions_"+status_sections).select2({
                });
                $(".my_subs_valus").last().attr('id','subscriber_values_'+status_sections);
                $("#subscriber_values_"+status_sections).select2({
                });
                //subscriber_values_0
            }, 300);

        }
        function load_countries(custom_id_number,custom_field_value){
            var token = "{{ csrf_token() }}";
            var checkbox_html = '<div id="countrBlk_'+custom_id_number+'" class="filterradio kt-radio-inline"><label for="country_any_'+custom_id_number+'" class="kt-radio"><input type="radio" value="any" name="custom_fields_filter['+custom_id_number+'][custom_field_value_country]" class="country_options" checked="" id="country_any_'+custom_id_number+'">{{ trans("segments.add_new.field.any_country")}} <span></span></label> <label for="country_select_'+custom_id_number+'" class="kt-radio"><input type="radio" class="country_options" value="custome_country" name="custom_fields_filter['+custom_id_number+'][custom_field_value_country]" checked="" id="country_select_'+custom_id_number+'">{{ trans("segments.add_new.field.selected_country")}} <span></span></label></div><select style="display:none;" class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_'+custom_id_number+'"  name="'+custom_field_value+'[]" ></select>';  ;
            $.ajax({
                url: "{{ URL::route('get.country.options') }}",
                type: "POST",
                data: {'token':token},
                beforeSend: function () {
                    $("#modal-loading").modal('show');
                },
                complete: function () {
                    $("#modal-loading").modal('hide');
                },
                success: function(options) {
                    $("#div_custom_field_value_"+custom_id_number).html(checkbox_html);
                    $("#custom_field_value_"+custom_id_number).html(options);
                    $("#custom_field_value_"+custom_id_number).multiselect('rebuild');
                    $("#div_custom_field_value_"+custom_id_number+" .btn-group").attr( "id", "country_"+custom_id_number );
                }
            });
        }
        function load_countries_ids(custom_id_number,custom_field_value){
            var token = "{{ csrf_token() }}";
            var checkbox_html = '<div id="countrBlk_'+custom_id_number+'" class="filterradio kt-radio-inline"><label for="country_any_'+custom_id_number+'" class="kt-radio"><input type="radio" value="any" name="custom_fields_filter['+custom_id_number+'][custom_field_value_country]" class="country_options" checked="" id="country_any_'+custom_id_number+'">{{ trans("segments.add_new.field.any_country")}} <span></span></label> <label for="country_select_'+custom_id_number+'" class="kt-radio"><input type="radio" class="country_options" value="custome_country" name="custom_fields_filter['+custom_id_number+'][custom_field_value_country]" checked="" id="country_select_'+custom_id_number+'">{{ trans("segments.add_new.field.selected_country")}} <span></span></label></div><select style="display:none;" class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_'+custom_id_number+'"  name="'+custom_field_value+'[]" ></select>';  ;
            $.ajax({
                url: "{{ URL::route('get.country.options.ids') }}",
                type: "POST",
                data: {'token':token},
                beforeSend: function () {
                    $("#modal-loading").modal('show');
                },
                complete: function () {
                    $("#modal-loading").modal('hide');
                },
                success: function(options) {
                    $("#div_custom_field_value_"+custom_id_number).html(checkbox_html);
                    $("#custom_field_value_"+custom_id_number).html(options);
                    $("#custom_field_value_"+custom_id_number).multiselect('rebuild');
                    $("#div_custom_field_value_"+custom_id_number+" .btn-group").attr( "id", "country_"+custom_id_number );
                }
            });
        }
    </script>
    <script>
        $(document).ready(function(){
           
           $("#advhide").click(function(){
            $("#div_advance").removeAttr("style");
            $("#div_advance").hide(500);
            $("#advanceMemberSelect2").attr('disabled',true);
            $("#selectList2").attr('disabled',true);
            $("#adv_list_1").attr('disabled',true);
            
        });
            $("#advshow").click(function(){
            $("#div_advance").show(500);
            $("#div_advance").css("display", "flex");
            $("#advanceMemberSelect2").attr('disabled',false);
            $("#selectList2").attr('disabled',false);
            $("#adv_list_1").attr('disabled',false);
        });
        });
    </script>
    <script type="text/javascript">
        var KTFormRepeater = function() {
            var demo1 = function() {
                $('#kt_repeater_3, #kt_repeater_4, #kt_repeater_5').repeater({
                    initEmpty: false,

                    defaultValues: {
                        'text-input': 'foo'
                    },

                    show: function() {
                        $(this).slideDown();
                    },

                    hide: function(deleteElement) {
                        if(confirm('{{ trans("common.message.delete_warning")}}')) {
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
        });
        $('input[name="segment_list"]').click(function(){
            var val = $(this).val();
            if(val=='custom') {
                $('#list').slideDown('slow');
                // $('#list').slideUp('slow');
            }
            else if(val=='groups')
            {
                $('#list').slideUp('slow');
                $('#group').slideDown('slow');
            }
            else
                $('#list').slideUp('slow');
        });
        $(function() {
            var val = $('input[name="segment_list"]').val();
            var $radios = $('input:radio[name=segment_list]');
            if($radios.is(':checked')) {
                $radios.filter('[value='+val+']').prop('checked', true);
            }
        });
        $('input[name="list_type"]').click(function(){

            var val = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{route('groupListDropDown')}}',
                data: {'list_type':val},
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('.blockUI').show();
                    $('.form-control').removeClass('is-invalid');
                    $('.error').css('display','none');
                    $('#contacts_list').slideDown('slow');
                },
                success: function (data) {
                    $('.blockUI').hide();
                    $('#contacts_list').empty();
                    $('#contacts_list').html(data.html);

                    $(".m-select2").select2({
                        placeholder: '{{ trans("segments.add_new.field.select_option")}}'
                    });
                }
            });

        });
        $(document).on('click','.lt',function (e) {
            if($(this).is(':checked'))
                $('.ltc').prop('checked',true);
            else
                $('.ltc').prop('checked',false);
        });
        $(document).on('click','.grp',function (e) {

        });
        var selectedLists = "";
    $('input[name="list_type"]').click(function(){
        $(".lt").attr("checked",false);
        $(this).attr("checked",true);
        var val = $(this).val();
        var user_id = null;
        var any = false;
        if(val=='any') {
            $('#contacts_list3').slideUp('slow');
            $('#contacts_list2').slideUp('slow');
            $('#advance_list').slideUp('slow');
            any = true;
        }
        @if(isset($meta_attributes['list_type']) && $meta_attributes['list_type']!='users')
            @if(isset($meta_attributes['where_user']))
                 $('#where_user').val("{{ $meta_attributes['where_user'] }}");
                console.log("ccc");
            @endif                 
        @endif
        if($('#users').is(':checked'))
        {
            user_id = $('#where_user').val();
            if(user_id=="") {
                Command: toastr["error"]("{{trans('segments.message.select_user')}}");
                return;
            }
            if(val=='groups')
            {
                groups(null,user_id,$("#selectedlistGroups").val());
                return;
            }
           else if(val=='where')
            {
                $('.checkbox-index').prop('checked',false);
                $('#contacts_list').slideUp('slow');
                $('#contacts_list2').slideUp('slow');
                $('#contacts_list3').slideDown('slow');
                $('#advance_list').slideUp('slow');
                return;
            }
            else if(val=='specific')
            {
                $('#contacts_list2').slideUp('slow');
                $('#contacts_list3').slideUp('slow');
                $('#advance_list').slideUp('slow');
            }
            else if(val=='advance')
            {
               $('#advance_list').slideDown('slow');
                getRquiredLists($("#selectedAdvLists").val());   
            }
            val = null;
        }
        var flag = null;
        if(val=='groups')
        {
            $("#group_type_admin").trigger('click');
           // $('#where_div').hide();
            val = 'users'
            if($("#segment-list-custom").is(':checked'))
                val = 'admin';
            groups(val,null,$("#selectedlistGroups").val());
            //console.log("zzzzzzzzzzzzzzz");
            return;
        }
        else if(val=='any' || val=='specific')
        {
            $('#contacts_list2').hide();
           // $('#where_div').hide();
            $('#contacts_list3').slideUp('slow');
            $('#advance_list').hide();
        }
        else if(val=='where')
        {
            $('.checkbox-index').prop('checked',false);
            $('#contacts_list').slideUp('slow');
            $('#contacts_list2').slideUp('slow');
            $('#contacts_list3').slideDown('slow');
            $('#advance_list').slideUp('slow');
            $('.div_adv').each(function(i, obj) {
                $(this).html('<input type="text" class="form-control textsystem">');
            });
            return;
        }
        else if(val=='advance')
        {
            $('.checkbox-index').prop('checked',false);
            $('#contacts_list').slideUp('slow');
            $('#contacts_list2').slideUp('slow');
            $('#contacts_list3').slideUp('slow');
            $('#advance_list').slideDown('slow');
            
            getRquiredLists($("#selectedAdvLists").val());
            
            return;
        }
        if(!$('#advance').is(':checked')) {
            $.ajax({
                type: 'POST',
                url: '{{route('groupListDropDown')}}',
                data: {'list_type': val, 'user_id': user_id,'selectedLists':$("#selectedLists").val()},
                cache: false,
                dataType: 'json',
                beforeSend: function () {
                    $('.blockUI').show();
                    $('.form-control').removeClass('is-invalid');
                    $('.error').css('display', 'none');
                    $('.list_array').prop('checked', false);
                    $('#contacts_list').slideUp('slow');
                },
                success: function (data) {
                    $('.blockUI').hide();
                    // $('#contacts_list').hide('slow');
                    $('#contacts_list').empty();
                    $('#contacts_list').html(data.html);
                    if (any) {
                        $('#contacts_list').hide();
                        $('.list_array').prop('checked', true);
                    } else {
                        $('#contacts_list').slideDown('slow');
                    }
                    //   $("#where_user").select2();
                    $('.div_adv').each(function(i, obj) {
                        $(this).html('<input type="text" class="form-control textsystem">');
                        ///console.log($(this).attr("id"));
                    });
                    $(".advance_option1").select2();
                    $(".advance_option2").select2();
                }
            });
        }
        else
        {
            $('#contacts_list').slideUp('slow');
            $('#contacts_list2').slideUp('slow');
            $('#contacts_list3').slideUp('slow');
            $('#contacts_list2').empty();
            $('#contacts_list').empty();
            $('#advance_list').slideDown('slow');
            //$(".advance_option1").select2();
            //$(".advance_option2").select2();
        }
    });
    $(document).on('click','.checkbox-all-index',function (e) {
        if($(this).is(':checked'))
            $('.checkbox-index').prop('checked',true);
        else
            $('.checkbox-index').prop('checked',false);
    });
    $(document).on('click','.broadcast_type',function (e) {
       var type = $(this).val();
        if(type=='our_broadcasts' || type=='user_broadcasts') {
           // $('.system_data').remove();
            $('#btn-new').trigger('click');
            $('#selected_links').empty();
            $('#campaign_block').empty();
            $('.campaign_class').prop('checked',false);
            if(type=='user_broadcasts') {
                $('#where_div_broadcast').slideDown('slow');
                $('.m-select2').select2();
            }
            else {
                $('#where_div_broadcast').slideUp('slow');
                $('#broadcast_type').slideDown('slow');
                $('#where_user_id').val('');
            }
        }
        else
        {
            $('#where_div_broadcast').slideUp('slow');
            $('#broadcast_type').slideUp('slow');
            $('.campaign_class').prop('checked',false);
            $('#campaign_block').slideUp();
            $('#campaign_block').empty();
            $('#links_clicked').empty();
            $('#where_user_id').val('');
        }
		
        getCampaignLinks();
    });
    
    
    
    @if(isset($meta_attributes['broadcast_type']) && $meta_attributes['broadcast_type']!='')
        var broadcastType= "{{ $meta_attributes['broadcast_type'] }}";
        $("#"+broadcastType).trigger('click');
    @endif
   
    @if(isset($meta_attributes['campaignChk']) && $meta_attributes['campaignChk']=='any')
        window.setTimeout(function () {
            $("#campaign_any").trigger('click');
        }, 1500);
    @endif
    
     @if(isset($meta_attributes['campaignChk']) && $meta_attributes['campaignChk']=='custom')
        window.setTimeout(function () {
            $("#campaign_select").trigger('click');
        }, 1500);
    @endif
        $('input[name="group_type"]').click(function(){

            var val = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{route('getGroups')}}',
                data: {'group_type':val},
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('.blockUI').show();
                    $('.form-control').removeClass('is-invalid');
                    $('.error').css('display','none');
                    $('#contacts_list2').slideDown('slow');
                },
                success: function (data) {
                    $('.blockUI').hide();
                    $('#contacts_list2').empty();
                    $('#contacts_list2').html(data.html);

                    $(".m-select2").select2({
                        placeholder: '{{ trans("segments.add_new.field.select_option")}}'
                    });
                }
            });

        });
        
        @if(isset($meta_attributes['segment_list_db']))
            
                
                $(document).ready(function(){
                     
                     
                    window.setTimeout(function () {
                        @if($meta_attributes['segment_list_db']=='global') 
                            $("#segment-list-global").trigger('click');
                        @endif  
                        @if($meta_attributes['segment_list_db']=='custom') 
                            $("#segment-list-custom").trigger('click');                            
                        @endif 
                        @if($meta_attributes['segment_list_db']=='groups') 
                            $("#segment-list-groups").trigger('click');                            
                        @endif 
                        @if($meta_attributes['segment_list_db']=='criteria') 
                            $("#segment-list-custom-criteria").trigger('click');                            
                        @endif 
                        @if($meta_attributes['segment_list_db']=='advance') 
                            $("#advance").trigger('click');    
                            @if(isset($meta_attributes['advance_filter'][0]['advance_option1']) && $meta_attributes['advance_filter'][0]['advance_option1']!='')
                                $("#advanceMemberSelect1").val("{{ $meta_attributes['advance_filter'][0]['advance_option1'] }}");
                            @endif
                            @if(isset($meta_attributes['advance_filter'][1]['advance_option1']) && $meta_attributes['advance_filter'][1]['advance_option1']!='')
                                $("#advshow").click();
                                $("#advanceMemberSelect2").val("{{ $meta_attributes['advance_filter'][1]['advance_option1'] }}");
                            @endif
                            @if(isset($meta_attributes['advance_filter'][0]['advance_option2']) && $meta_attributes['advance_filter'][0]['advance_option2']!='')        
                                $("#selectListdb1").val(1);
                                console.log("dddd");
                                window.setTimeout(function () {
                                    $("#selectListdb1").trigger('change');               
                                }, 3000);        
                            @endif
                            @if(isset($meta_attributes['advance_filter'][1]['advance_option2']) && $meta_attributes['advance_filter'][1]['advance_option2']!='')  
                                $("#selectList2").val(1);
                                window.setTimeout(function () {
                                    $("#selectList2").trigger('change');
                                }, 3000);
                            @endif    
                        @endif 
                        
               }, 1000);
               
                    window.setTimeout(function () {
                        $(".advance_option1").select2();
                        $(".advance_option2").select2(); 
                        //advance_option2
                    }, 3000);

               });
        @endif      
        @if(isset($meta_attributes['advance_filter'][0]['advance_option2']) && $meta_attributes['advance_filter'][0]['advance_option2']!='')        
            $(document).ready(function(){           
                $("#selectListdb1").val(1);
                window.setTimeout(function () {
                    $("#selectListdb1").trigger('change');               
                }, 3000);

            });         
        @endif
        
        @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']!='')
            $(document).ready(function(){
                $("#opens-clicks-status").trigger('change');            
            });    
            @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='has_opened_broadcast')
                $(document).ready(function(){
                    window.setTimeout(function () {

                    @if(isset($meta_attributes['open_click']) && in_array('clicked_on_a_link',$meta_attributes['open_click']))
                        $("#lick_click").attr('checked',true);
                    @else
                        $("#lick_click").attr('checked',false);
                    @endif

                    @if(isset($meta_attributes['open_click']) && in_array('has_not_clicked_on_any_link',$meta_attributes['open_click']))
                        $("#not_a_click").attr('checked',true);
                    @else
                        $("#not_a_click").attr('checked',false);
                    @endif

                    @if(isset($meta_attributes['any_select_link']) && $meta_attributes['any_select_link']=='Any link')                    
                        $("#linksType").trigger('click');     
                    @endif
                    @if(isset($meta_attributes['any_select_link']) && $meta_attributes['any_select_link']=='custom')   
                        $("#any_select_link").trigger('click');                   
                        $("#linksType2").trigger('click');                   
                    @endif

                    @if(isset($meta_attributes['countryChk']) && $meta_attributes['countryChk']=='any')                    
                        $("#country_any").trigger('click');                   
                    @else
                        $("#country_select").trigger('click');    
                        getStates();
                    @endif

                    @if(isset($meta_attributes['stateChk']) && $meta_attributes['stateChk']=='any')                    
                        $("#state_any").trigger('click');                   
                    @else
                        $("#state_select").trigger('click');     
                    @endif

                    @if(isset($meta_attributes['cityChk']) && $meta_attributes['cityChk']=='any')                    
                        $("#city_any").trigger('click');                   
                    @else
                        $("#city_select").trigger('click');                         
                    @endif

                    @if(isset($meta_attributes['zipChk']) && $meta_attributes['zipChk']=='any')                    
                        $("#zip_any").trigger('click');                   
                    @else
                        $("#zip_select").trigger('click');                         
                    @endif

                    @if(isset($meta_attributes['browsChk']) && $meta_attributes['browsChk']=='any')                    
                        $("#brows_any").trigger('click');                   
                    @else
                        $("#brows_select").trigger('click');                         
                    @endif

                    @if(isset($meta_attributes['osChk']) && $meta_attributes['osChk']=='any')                    
                        $("#os_any").trigger('click');                   
                    @else
                        $("#os_select").trigger('click');                         
                    @endif

                    @if(isset($meta_attributes['duration']) && $meta_attributes['duration']=='none')                    
                        $("#none").trigger('click');                   
                    @else
                        $("#custom").trigger('click');       
                        @if(isset($meta_attributes['opens_clicks_dynamic_filter']))
                            $("#opens_clicks_dynamic_filter").val("{{ $meta_attributes['opens_clicks_dynamic_filter'] }}");
                            $("#opens_clicks_dynamic_filter").trigger('change'); 
                            @if($meta_attributes['opens_clicks_dynamic_filter']=='after' || $meta_attributes['opens_clicks_dynamic_filter']=='before' || $meta_attributes['opens_clicks_dynamic_filter']=='exactly')
                                @if(isset($meta_attributes['duration_date']))
                                    window.setTimeout(function () {
                                        $("#duration_date").val("{{ $meta_attributes['duration_date'] }}");
                                    }, 500);
                                @endif
                            @endif

                            @if($meta_attributes['opens_clicks_dynamic_filter']=='between')
                                    @if(isset($meta_attributes['from']))
                                        window.setTimeout(function () {
                                            $("#from").val("{{ $meta_attributes['from'] }}");
                                        }, 500);
                                    @endif
                                    @if(isset($meta_attributes['to']))
                                        window.setTimeout(function () {
                                            $("#to").val("{{ $meta_attributes['to'] }}");
                                        }, 500);
                                    @endif
                            @endif    

                            @if($meta_attributes['opens_clicks_dynamic_filter']=='is_overdue_for' || $meta_attributes['opens_clicks_dynamic_filter']=='past' || $meta_attributes['opens_clicks_dynamic_filter']=='older')

                                @if(isset($meta_attributes['days_time_value']))
                                        window.setTimeout(function () {
                                            $("#days_time_value").val("{{ $meta_attributes['days_time_value'] }}");
                                        }, 500);
                                @endif
                                @if(isset($meta_attributes['days_time']))
                                    window.setTimeout(function () {
                                        $("#days_time").val("{{ $meta_attributes['days_time'] }}");
                                    }, 500);
                                @endif

                            @endif    
                        @endif    
                    @endif


                }, 3000);
                });            
            @endif
            @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='hasnt_opened_broadcast' || $meta_attributes['opens_clicks_status']=='is_sent')
            @if(isset($meta_attributes['duration']) && $meta_attributes['duration']=='none')                    
                $(document).ready(function(){
                    window.setTimeout(function () {
                       $("#none").trigger('click');   
                    }, 1000);

                });
                
            @else
                $(document).ready(function(){
                    window.setTimeout(function () {
                       $("#custom").trigger('click');       
                        @if(isset($meta_attributes['opens_clicks_dynamic_filter']))
                            $("#opens_clicks_dynamic_filter").val("{{ $meta_attributes['opens_clicks_dynamic_filter'] }}");
                            $("#opens_clicks_dynamic_filter").trigger('change'); 
                            @if($meta_attributes['opens_clicks_dynamic_filter']=='after' || $meta_attributes['opens_clicks_dynamic_filter']=='before' || $meta_attributes['opens_clicks_dynamic_filter']=='exactly')
                                @if(isset($meta_attributes['duration_date']))
                                    window.setTimeout(function () {
                                        $("#duration_date").val("{{ $meta_attributes['duration_date'] }}");
                                    }, 500);
                                @endif
                            @endif

                            @if($meta_attributes['opens_clicks_dynamic_filter']=='between')
                                    @if(isset($meta_attributes['from']))
                                        window.setTimeout(function () {
                                            $("#from").val("{{ $meta_attributes['from'] }}");
                                        }, 500);
                                    @endif
                                    @if(isset($meta_attributes['to']))
                                        window.setTimeout(function () {
                                            $("#to").val("{{ $meta_attributes['to'] }}");
                                        }, 500);
                                    @endif
                            @endif    

                            @if($meta_attributes['opens_clicks_dynamic_filter']=='is_overdue_for' || $meta_attributes['opens_clicks_dynamic_filter']=='past' || $meta_attributes['opens_clicks_dynamic_filter']=='older')

                                @if(isset($meta_attributes['days_time_value']))
                                        window.setTimeout(function () {
                                            $("#days_time_value").val("{{ $meta_attributes['days_time_value'] }}");
                                        }, 500);
                                @endif
                                @if(isset($meta_attributes['days_time']))
                                    window.setTimeout(function () {
                                        $("#days_time").val("{{ $meta_attributes['days_time'] }}");
                                    }, 500);
                                @endif

                            @endif    
                        @endif 
                    }, 1000);

                });
            @endif
        @endif
    @endif
        
        
        
    </script>
@endsection

@section('content')
    <script>

        var date_div = '';
        date_div += '<div class="date date-picker" data-date-format="dd-mm-yyyy">';
        date_div += '<input type="text" class="form-control datesystem" placeholder="{{trans('segments.add_new.field.date_field')}}" name="custom_field_date_value" id="custom_field_date_value_0" >';
        date_div += '</div>';
        var date_div_hidden = '';
        date_div_hidden += '<div class="">';
        date_div_hidden += '<input type="hidden" class="form-control" name="custom_field_date_value" id="custom_field_date_value_0" value="today" >';
        date_div_hidden += '</div>';   
    
        var daysOptions = '<div class="">';
        daysOptions += '<select class="form-control m-select2" name="custom_field_date_value" id="custom_field_date_value_0">';
        daysOptions += '<option value="-1">{{ trans("segments.filter.todays_date") }}</option>';
        for (let i = 1; i < 32; i++) {         
            daysOptions += '<option value="'+i+'">'+i+'</option>'
        }
        daysOptions +='</select>';             
        daysOptions += '</div>'; 

        var monthOptions = '<div class="">';
        monthOptions += '<select class="form-control m-select2" name="custom_field_date_value" id="custom_field_date_value_0">';    
        monthOptions += '<option value="-1">{{ trans("segments.filter.this_month") }}</option>';    
        monthOptions += '<option value="1">{{ trans("segments.filter.january") }}</option>';
        monthOptions += '<option value="2">{{ trans("segments.filter.february") }}</option>';
        monthOptions += '<option value="3">{{ trans("segments.filter.march") }}</option>';
        monthOptions += '<option value="4">{{ trans("segments.filter.april") }}</option>';
        monthOptions += '<option value="5">{{ trans("segments.filter.may") }}</option>';
        monthOptions += '<option value="6">{{ trans("segments.filter.june") }}</option>';
        monthOptions += '<option value="7">{{ trans("segments.filter.july") }}</option>';
        monthOptions += '<option value="8">{{ trans("segments.filter.august") }}</option>';
        monthOptions += '<option value="9">{{ trans("segments.filter.september") }}</option>';
        monthOptions += '<option value="10">{{ trans("segments.filter.october") }}</option>';
        monthOptions += '<option value="11">{{ trans("segments.filter.november") }}</option>';
        monthOptions += '<option value="12">{{ trans("segments.filter.december") }}</option>';
        monthOptions +='</select>';             
        monthOptions += '</div>';

        var date_conditions = '<option></option>';
        date_conditions = '<option value="after">{{trans("segments.add_new.field.date_duration.values.after")}}</option>';
        date_conditions += '<option value="before">{{trans("segments.add_new.field.date_duration.values.before")}}</option>';
        date_conditions += '<option value="exactly">{{trans("segments.add_new.field.date_duration.values.exactly")}}</option>';
        date_conditions += '<option value="between">{{trans("segments.add_new.field.date_duration.values.between")}}</option>';
        date_conditions += '<option value="is_due_in">{{trans("segments.add_new.field.date_duration.values.is_due_in")}}</option>';
        date_conditions += '<option value="is_overdue_for">{{trans("segments.add_new.field.date_duration.values.is_overdue_for")}}</option>';
        date_conditions += '<option value="past">{{trans("segments.add_new.field.date_duration.values.past")}}</option>';
        date_conditions += '<option value="older">{{trans("segments.add_new.field.date_duration.values.older_than")}}</option>';
        date_conditions += '<option value="is_today"> {{ trans("segments.filter.is_today") }}</option>';
        date_conditions += '<option value="day_of_month"> {{ trans("segments.filter.day_of_month") }}</option>';
        date_conditions += '<option value="month_of_year"> {{ trans("segments.filter.month_of_year") }}</option>';

        var create_date_conditions = '<option value="after">{{trans("segments.add_new.field.date_duration.values.after")}}</option>';
        create_date_conditions += '<option value="exactly">{{trans("segments.add_new.field.date_duration.values.exactly")}}</option>';
        create_date_conditions += '<option value="between">{{trans("segments.add_new.field.date_duration.values.between")}}</option>';
        create_date_conditions += '<option value="is_due_in">{{trans("segments.add_new.field.date_duration.values.is_due_in")}}</option>';
        create_date_conditions += '<option value="is_overdue_for">{{trans("segments.add_new.field.date_duration.values.is_overdue_for")}}</option>';
        create_date_conditions += '<option value="past">{{trans("segments.add_new.field.date_duration.values.past")}}</option>';
        create_date_conditions += '<option value="older">{{trans("segments.add_new.field.date_duration.values.older_than")}}</option>';
        create_date_conditions += '<option value="is_today">{{ trans("segments.filter.is_today") }}</option>';
        create_date_conditions += '<option value="day_of_month">{{ trans("segments.filter.day_of_month") }}</option>';
        create_date_conditions += '<option value="month_of_year">{{ trans("segments.filter.month_of_year") }}</option>';

        var date_field_db ="<input type='text' class='form-control datesystem'  placeholder='{{trans('segments.add_new.field.date_field')}}' id='days_time_value' name='days_time_value_name' >";
        var is_isNot_options = '<option value="is">{{trans("segments.filter.is")}}</option>';
        is_isNot_options += '<option value="is_not">{{trans("segments.filter.is_not")}}</option>';

        var contain_not_contain = "<option value='contain'>{{trans('segments.filter.contain')}}</option>";
        contain_not_contain += "<option value='not_contain'>{{trans('segments.filter.does_not_contain')}}</option>";


        var date_range = "<div class='dpr ssrange' id='csrange'>";
        date_range +="<div class='input-daterange input-group'>";
        date_range +="<input type='text' class='form-control from' id='sfrom_1' name='cfrom'  data-date-format='yyyy-mm-dd'>";
        date_range +="<div class='input-group-append'><span class='input-group-text'><i class='la la-ellipsis-h'></i></span></div>";
        date_range +="<input type='text' class='form-control to' id='sto_1' name='cto'  data-date-format='yyyy-mm-dd'>";
        date_range += "</div>";
        date_range += "</div>";

        var date_duration ="<div class='cusomDate'>";
        date_duration +="<div class='datefields'>";
        date_duration +="<input type='number' id='days_value_time_1' name='days_time_value_name'  class='form-control' placeholder='{{trans('segments.add_new.field.placeholder.xx_days')}}' />";
        date_duration +="</div>";
        date_duration +="<div class='datefields pull-right'>";
        date_duration +="<select class='form-control' id='custom_duration_1'  name='duration_time'>";
        date_duration +="";
        date_duration +="<option value='days'>{{trans('common.days')}}</option>";
        date_duration +="<option value='weeks'>{{trans('common.weeks')}}</option>";
        date_duration +="<option value='months'>{{trans('common.months')}}</option>";
        date_duration +="<option value='years'>{{trans('common.years')}}</option>";
        date_duration +="</select>";
        date_duration +="</div>";
        date_duration +="</div>";

         var status_sections = 0;
        var custom_sections = 0;
        var subcriber_sections = 0;

        //$("#segment-list-custom").trigger('click');
        
    </script>

    @if($errors->any())
        <!-- For PHP validations errors-->
        <div class="alert alert-danger" data-name="VBJVAyLp">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="UynOsthC">
            {{ Session::get('msg') }}
        </div>
    @endif
    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="Ypotpfaw">
    <span id='msg-text'><span>
    </div>
    <!-- BEGIN FORM-->
    <form action="" method="POST" name="segmentation" id="segmentation" class="kt-form kt-form--label-right" novalidate="novalidate">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="selectedLists" value="{{ isset($meta_attributes['subscriber_lists']) ? implode(",",$meta_attributes['subscriber_lists']):'' }}">
        <input type="hidden" id="selectedlistGroups" value="{{ isset($meta_attributes['listGroups']) ? implode(",",$meta_attributes['listGroups']):'' }}">
        <input type="hidden" id="selectedAdvLists" value="{{ isset($meta_attributes['adv_lists']) ? implode(",",$meta_attributes['adv_lists']):'' }}">
        <input type="hidden" id="selectedOpensClicksCampaign" value="{{ isset($meta_attributes['opens_clicks_campaign']) ? implode(",",$meta_attributes['opens_clicks_campaign']):'' }}">
    <input type="hidden" id="selectedClickedLinks" value="{{ isset($meta_attributes['links_clicked']) ? implode(",",$meta_attributes['links_clicked']):'' }}">
    <input type="hidden" id="selectedOpensClicksRegion" value="{{ isset($meta_attributes['opens_clicks_region']) ? implode(",",$meta_attributes['opens_clicks_region']):'' }}">
    <input type="hidden" id="selectedOpensClicksCity" value="{{ isset($meta_attributes['opens_clicks_city']) ? implode(",",$meta_attributes['opens_clicks_city']):'' }}">
    <input type="hidden" id="selectedopensClicksZip" value="{{ isset($meta_attributes['opens_clicks_zip']) ? implode(",",$meta_attributes['opens_clicks_zip']):'' }}">
        <input type="hidden" id="selectedAdvnceList0" value="{{ isset($meta_attributes['advance_filter']['0']['adv_filter_val']) ? implode(",",$meta_attributes['advance_filter']['0']['adv_filter_val']):'' }}">
        <input type="hidden" id="selectedAdvnceList1" value="{{ isset($meta_attributes['advance_filter']['1']['adv_filter_val']) ? implode(",",$meta_attributes['advance_filter']['1']['adv_filter_val']):'' }}">
    
        <input type="hidden" id="action" value="edit">
        <input type="hidden" id="id" name="id" value="{{ $id }}">

        <div class="col-md-8 create-form" data-name="KvesranD">

            <div class="row" id="main" data-name="wEenLxQa">
                <div class="kt-portlet kt-portlet--height-fluid" data-name="fbbfyLRE">
                    <div class="kt-portlet__head" data-name="BzCozDwO">
                        <div class="kt-portlet__head-label" data-name="QFYNDCdl">
                            <h3 class="kt-portlet__head-title">{{trans('segments.add_new.form.title')}}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body topBlks" data-name="dpYnpXVd">
                        <div class="row" data-name="GlbWvScs">
                            <div class="col-md-12" data-name="EXSPpmeq">
                                <span class="segName dmnlbl"></span>
                            </div>
                        </div>
                        <div class="form-group row" id="segOpts2" data-name="SZXuGKhe">
                            <label class="col-form-label col-md-12 text-left">{{trans('segments.add_new.field.segment_name')}}</label>
                            <div class="col-md-12" data-name="jQUCwYLC">
                                <div class="input-icon right" data-name="KsxVWttl">
                                    <input type="text" name="name" id="name" value="{{isset($segmentation->name) ? $segmentation->name : '' }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" id="segOpts" data-name="EQRRIBKK" style="display: none;">
                        <label class="col-form-label"></label>
                        <div class="col-md-12" data-name="YvYguDcK">
                            <div class="row mb10" data-name="jADDUChC">
                                <div class="col-lg-6" data-name="OcaHhWwe">
                                    <label class="kt-option">
                                        <span class="kt-option__control">
                                            <span class="kt-radio kt-radio--check-bold mt-radio">
                                                <input type="radio" name="segment_type" id="segment_type_list" class="listOps" value="0" @if($meta_attributes['segment_type']==0) checked="" @endif>
                                                <span></span>
                                            </span>
                                        </span>
                                        <span class="kt-option__label">
                                            <span class="kt-option__head">
                                                <span class="kt-option__title">
                                                     {{trans('segments.add_new.field.based_list')}}
                                                </span>
                                                <span class="kt-option__focus">
                                                </span>
                                            </span>
                                            <span class="kt-option__body">
                                                {{trans('segments.add_new.field.based_list_description')}}
                                            </span>
                                        </span>
                                    </label>
                                </div>
                                <div class="col-lg-6" data-name="cfvlmOjy">
                                    <label class="kt-option">
                                        <span class="kt-option__control">
                                            <span class="kt-radio kt-radio--check-bold mt-radio">
                                                <input type="radio" id="segment_type_stats" name="segment_type" class="statsOpts" value="1" @if($meta_attributes['segment_type']==1) checked="" @endif>
                                                <span></span>
                                            </span>
                                        </span>
                                        <span class="kt-option__label">
                                            <span class="kt-option__head">
                                                <span class="kt-option__title">
                                                    {{trans('segments.add_new.field.based_statistics')}}
                                                </span>
                                                <span class="kt-option__focus">
                                                </span>
                                            </span>
                                            <span class="kt-option__body">
                                                {{trans('segments.add_new.field.based_statistics_description')}}
                                            </span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                <!--                            <div class="input-icon right" id="nextOpts" data-name="hBQSmPTb">
                                <button type="button" class="btn btn-success" id="listBtn2">{{ trans('common.form.buttons.next') }}</button>
                                <button type="button" class="btn btn-success" id="campBtn2">{{ trans('common.form.buttons.next') }}</button>
                            </div>-->
                        </div>
                    </div>
                    </div>
                </div>
            </div>



            <div class="" id="lists" data-name="tKZVcQzM" style="display: @if($meta_attributes['segment_type']==0) block; @else none; @endif">
                <div class="row" data-name="TPCOxdwf">
                    <div class="kt-portlet kt-portlet--height-fluid" data-name="MDkyXEAE">
                        <div class="kt-portlet__head" data-name="PkYYcuTE">
                            <div class="kt-portlet__head-label" data-name="FksQeegc">
                                <h3 class="kt-portlet__head-title">{{trans('segments.add_new.field.filter_by_list')}}</h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body topBlks" data-name="TPvHVvPD">
                            <div class="form-group row" data-name="UZJsmRGz">
                                <label class="col-form-label pl12">
                                    {{trans('common.label.select_list')}}
                                    <span class="required">*</span>
                                    <small id="segment_list-error" class="error invalid-feedback p-right"></small>
                                </label>
                                <div class="col-md-10 mt5" data-name="FayioiSr">
                                    <div class="kt-radio-inline" data-name="NbqTkYQb">
                                        <label class="kt-radio">
                                            <input type="radio" name="segment_list" class="segment_list" id="segment-list-global" value="global" >{{trans('segments.add_new.field.any_contact_list')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" name="segment_list"  class="segment_list" id="segment-list-custom" value="custom" @if ($page_data['action'] == 'add') checked @endif {{ isset($segmentation_data->list_type) && $segmentation_data->list_type == 'custom' ? 'checked' : '' }}>{{trans('segments.filter.contact_list')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" name="segment_list" class="segment_list" id="segment-list-groups" value="groups">{{trans('segments.add_new.field.groups')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" name="segment_list" class="segment_list" id="segment-list-custom-criteria" value="criteria">{{trans('segments.add_new.field.custom_criteria')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input type="radio" name="segment_list" class="segment_list" id="advance" value="advance">{{trans('segments.add_new.field.advance_criteria')}}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="contacts_list" style="display: none;" data-name="GvHHdwgp">

                                    <label class="col-form-label col-md-12">{{trans('segments.add_new.field.contact_lists')}}</label>

                                    <div class="col-md-12" data-name="wBKsOipY">
                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-415" data-name="foLWKBDS">
                                            <div class="portlet-body kt-checkbox-list" data-name="OfiVGmGu">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" class="checkbox-index checkbox-all-index2 lt">&nbsp;<b>{{trans('segments.add_new.field.select_all')}}</b>
                                                    <span></span>
                                                    <small id="subscriber_lists-error" class="error invalid-feedback"></small>
                                                </label>
                                                @foreach ($list_tree as $group_metadata)
                                                    <div style="padding: 5px 0;" data-name="jafHqCvu">
                                                        <label class="kt-checkbox">
                                                            <input class="group-selector-subscriber checkbox-index2 ltc" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" {{--name="list_group[]"--}}>
                                                            <strong>{{ $group_metadata['name'] }}</strong>
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                    @foreach ($group_metadata['children'] as $list_metadata)
                                                        <div id="flag_{{$list_metadata['id']}}"  @if($list_metadata['is_blocked']) class="list-disabled" @else class="kt-checkbox-list" @endif  style="padding-left: 20px;" data-name="ThFxEWzg">
                                                            <label for="l_{{$list_metadata['id']}}" class="kt-checkbox childList">
                                                                <input id="l_{{$list_metadata['id']}}" @if($list_metadata['is_blocked']) disabled="'disabled'"@endif type="checkbox" value="{{ $list_metadata['id'] }}" name="subscriber_lists[]" class="group-subscriber-{{ $group_metadata['id'] }} list_array group-list-ids-tab1-{{ $group_metadata['id'] }} subscriber_list checkbox-index2" {{ isset($meta_attributes['subscriber_lists']) && in_array($list_metadata['id'], $meta_attributes['subscriber_lists']) ? 'checked' : '' }} > {{ $list_metadata['name'] }} @if($list_metadata['is_blocked']) <bar>(Blocked)</bar>@endif
                                                                <span></span>
                                                            </label>
                                                        </div>                                                 
                                                    @endforeach
                                                @endforeach
                                            </div>

                                        </div>
                                        <div class="error" id="list_ids_error" style="display:none;" data-name="QhZSIySp">{{ trans('segments.add_new.field.select_one_list') }}</div>

                                    </div>
                            </div>

                            <div class="form-group row" id="contacts_list2" style="display:none;" data-name="IDZGpjMg">

                                    <label class="col-form-label col-md-12">{{trans('segments.add_new.field.select_group')}}</label>
                                    <div class="col-md-12" data-name="DhVXAKLQ">
                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-415" data-name="pRlETxQL">
                                            <div class="portlet-body kt-checkbox-list" data-name="KzvAzAsZ">
                                                <label class="kt-checkbox">
                                                    <input type="checkbox" class="checkbox-index checkbox-all-index" >&nbsp;<b>{{trans('common.label.select_all')}}</b>
                                                    <span></span>
                                                    <small id="listGroups-error" class="error invalid-feedback"></small>
                                                </label>
                                                @foreach ($groups_data as $group_metadata)
                                                    <div style="padding: 5px 0 5px 20px;" data-name="QlJDEDcw">
                                                        <label class="kt-checkbox">
                                                            <input class="" {{ isset($meta_attributes['listGroups']) && in_array($group_metadata['id'], $meta_attributes['listGroups']) ? 'checked' : '' }} type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="listGroups[]">
                                                            {{ $group_metadata['name'] }}
                                                            <span></span>
                                                        </label>

                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                        <div class="error" id="group_ids_error" style="display:none;" data-name="xyNHyZce">{{ trans('segments.add_new.field.select_one_list') }}</div>

                                    </div>

                            </div>
                            <div class="form-group row" id="contacts_list3" style="display:none;" data-name="FJyIzAyd">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.select_criteria')}}</label>
                                <div class="col-md-12" data-name="VQUQhEpW">
                                    <div class="row" data-name="lDQoQTXz">
                                        <div class="col-md-4" data-name="RViTmZwc">
                                            <select class="form-control m-select2" name="list_group_name" id="list_group_name">
                                                <option value="1" @if(isset($meta_attributes['list_group_name']) && $meta_attributes['list_group_name']==1) selected="" @endif >{{trans('segments.add_new.field.list_name')}}</option>
                                                <option value="2" @if(isset($meta_attributes['list_group_name']) && $meta_attributes['list_group_name']==2) selected="" @endif>{{trans('segments.add_new.field.group_name')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" data-name="LeeoauMM">
                                            <select class="form-control m-select2" name="list_group_condition" id="list_group_condition">
                                                 <option value="is" @if(isset($meta_attributes['list_group_condition']) && $meta_attributes['list_group_condition']=='is') selected="" @endif>{{trans('segments.filter.is')}}</option>
                                                <option value="is_not" @if(isset($meta_attributes['list_group_condition']) && $meta_attributes['list_group_condition']=='is_not') selected="" @endif>{{trans('segments.filter.is_not')}}</option>
                                                <option value="contain" @if(isset($meta_attributes['list_group_condition']) && $meta_attributes['list_group_condition']=='contain') selected="" @endif>{{trans('segments.filter.contain')}}</option>
                                                <option value="not_contain" @if(isset($meta_attributes['list_group_condition']) && $meta_attributes['list_group_condition']=='not_contain') selected="" @endif>{{trans('segments.filter.does_not_contain')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" data-name="igOZcebZ">
                                            <input type="text" class="form-control" name="list_group_value" id="list_group_value" value="{{ isset($meta_attributes['list_group_value'])? $meta_attributes['list_group_value']:'' }}">
                                            <small id="list_group_value-error" class="error invalid-feedback"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" id="advance_list" style="display:none;" data-name="zbuDvzCa">
                        <label class="col-form-label col-md-12">{{trans('segments.add_new.field.select_criteria')}}</label>
                        <div class="col-md-12" data-name="kXYLEwOc">
                            
                            <div class="row" data-name="Ynakbtqe">
                                <div class="col-md-4" data-name="ZAQFoIaA">
                                    <select class="form-control advance_option1 m-select2" name="advance_filter[0][advance_option1]" id="advanceMemberSelect1">
                                        <option selected>{{trans('segments.add_new.field.select_option')}}</option>
                                        <option value="1">{{trans('segments.admin_segment_create_blade.is_member_option')}}</option>
                                        <option value="2">{{trans('segments.admin_segment_create_blade.is_not_member_option')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3" data-name="YIoudafi">
                                    <select onchange="fillThirdField(this.value,this.name,this.id)"  class="form-control advance_option2 m-select2" name="advance_filter[0][advance_option2]" id="selectListdb1">
                                        <option selected value="-1">{{trans('segments.add_new.field.select_option')}}</option>
                                        <option value="1">{{trans('segments.admin_segment_create_blade.list_select_opt')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 div_adv" id="div_adv_3_0" data-name="fWPrxCuY">
                                   <input type="text" class="form-control textsystem"  >
                                   <small id="advance_option3-error" class="error invalid-feedback p-right"></small>
                                </div>
                                <div class="col-md-1"  data-name="fWPrxCuY" id="addPLus">
                                    <div id="advshow" data-name="rhLmjxHY"><div data-repeater-create="" class="btn btn btn-info btn-sm advshow" data-name="YfCBsQce" ><span><i class="la la-plus"></i></span></div></div>
                                </div>
                            </div>
                            <div class="row" data-name="Ynakbtqe" id="div_advance">
                                <div class="col-md-4" data-name="ZAQFoIaA">
                                    <select class="form-control advance_option1 m-select2" name="advance_filter[1][advance_option1]" id="advanceMemberSelect2">
                                        <option selected>{{trans('segments.add_new.field.select_option')}}</option>
                                        <option value="1">{{trans('segments.admin_segment_create_blade.is_member_option')}}</option>
                                        <option value="2">{{trans('segments.admin_segment_create_blade.is_not_member_option')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-3" data-name="YIoudafi">
                                    <select onchange="fillThirdField(this.value,this.name,this.id)"  class="form-control  advance_option2 m-select2" name="advance_filter[1][advance_option2]" id="selectList2">
                                        <option selected value="-1">{{trans('segments.add_new.field.select_option')}}</option>
                                        <option value="1">{{trans('segments.admin_segment_create_blade.list_select_opt')}}</option>
                                    </select>
                                </div>
                                <div class="col-md-4 div_adv" id="div_adv_3_1" data-name="fWPrxCuY">
                                   <input type="text" class="form-control textsystem"  >
                                   <small id="advance_option3-error" class="error invalid-feedback p-right"></small>
                                </div>
                                <div class="col-md-1"  data-name="fWPrxCuY">
                                    <a href="javascript:;" class="btn btn-danger btn-icon btn-sm" id="advhide"><i class="la la-close"></i></a>
                                </div>
                            </div>   
                            
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="" id="camps" data-name="HLZgLgKI" style="display: @if($meta_attributes['segment_type']==0) none; @else block; @endif">
                <div class="row" data-name="uwabFSeV">
                    <div class="kt-portlet kt-portlet--height-fluid" data-name="gKdiZOBE">
                        <div class="kt-portlet__head" data-name="qKapOywh">
                            <div class="kt-portlet__head-label" data-name="aKjpXNtS">
                                <h3 class="kt-portlet__head-title">{{trans('segments.filter.by_activity')}}</h3>
                            </div>
                        </div>
                        <div class="kt-portlet__body topBlks" style="" data-name="ViYwqDBE">
                            <div class="alert alert-info alert-light alert-bold" role="alert" data-name="VlIfNzgm" id="log_notification" style="display: none;">
                            <div class="alert-text keepLogFor" data-name="raGvpyJd">
                                <b>{{trans('segments.add.note')}}:</b> {!! str_replace("%%keep_log_for%%", $keep_log_for,trans('segments.add.log_notification')) !!}
                            </div>
                        </div>
                        <div class="kt-portlet__body topBlks" style="" data-name="ViYwqDBE">
                            <div class="form-group row" data-name="zBQIWymB">
                                <label class="col-form-label col-md-12">
                                    {{trans('segments.add_new.field.broadcasts')}}
                                </label>
                                <div class="col-md-12" data-name="ZSdneLQs">
                                    <div id="campaignBlk" class="filterradio kt-radio-inline" data-name="EmxVdnxW">

                                        <label for="campaign_any"class="kt-radio">
                                            <input type="radio" name="campaignChk" checked="" id="campaign_any" class="campaign_class" value="any">
                                            {{trans('segments.add_new.field.any_broadcast')}}
                                            <span></span>
                                        </label>

                                        <label for="campaign_select"class="kt-radio">
                                            <input type="radio" name="campaignChk" id="campaign_select" class="campaign_class" value="custom">
                                            {{trans('segments.add_new.field.select_broadcast')}}
                                            <span></span>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row" id="campaign_block" style="display: @if ($page_data['action'] == 'add') none; @else  @if(isset($segmentation->opens_clicks_campaign))) block; @else none; @endif  @endif" data-name="raNbpLfJ">
                                <label class="col-form-label col-md-12">
                                    {{trans('segments.add_new.field.select_broadcast')}}
                                </label>

                                <div class="col-md-6" data-name="VIdObadM">
                                    <div class="kt-input-icon kt-input-icon--left" data-name="cTLcyVTg">
                                        <input type="text" id="campaignList" class="form-control" placeholder="Search Campaign..."> 
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span> 
                                        </span>
                                    </div>
                                    <div class="kt-portlet kt-portlet--height-fluid scroll scroll-150 bt0 broadcast-dropdown" data-name="BzAplZWM">
                                        <div class="kt-portlet__body scList" data-name="LzfGSJnm">
                                            <div class="kt-checkbox-list" data-name="craJjaEi">
                                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all" for="select-all">
                                                    <input class="checkboxes checkbox-all-index" type="checkbox" id="select-all"> {{trans('segments.add_new.field.select_all')}} <span></span> 
                                                </label>
                                                @foreach ($campaigns as $key=>$campaign)
                                                <label class="kt-checkbox childList" for="c_{{$key}}" id="flag_{{$key}}">
                                                    <input name="opens_clicks_campaign[]" type="checkbox" {{ isset($meta_attributes['opens_clicks_campaign']) && in_array($campaign->id, $meta_attributes['opens_clicks_campaign']) ? 'checked' : '' }}  data-name="{{ strtolower($campaign->name) }}" data-id="{{ $key}}"  value="{{ $campaign->id }}" class="checkbox-index campiagnsNameList" id="c_{{$key}}"> {{ $campaign->name }} 
                                                    <span></span> 
                                                </label>
                                                @endforeach
                                               
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6" data-name="JznbAVJV">
                                    <select id="opens-clicks-campaign" class="mt-multiselect btn btn-default form-control" data-placeholder="{{trans('segments.add_new.field.choose.campaign')}}" name="opens_clicks_campaign[]" onchange="getCampaignLinks()" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300">
                                        @foreach ($campaigns as $campaign)
                                            <option value="{{ $campaign->id }}" {{ isset($meta_attributes['opens_clicks_campaign']) && in_array($campaign->id, $meta_attributes['opens_clicks_campaign']) ? 'selected' : '' }}>{{ $campaign->name }}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                            </div>

                            <div class="form-group row" data-name="YNYMvUwZ">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.select_criteria')}}</label>
                                <div class="col-md-6" data-name="yAHlpYGT">
                                    <div id="opensClicksStatusBlk" data-name="HwKxQxrd">
                                        <select class="form-control m-select2"  name="opens_clicks_status" id="opens-clicks-status" placeholder="{{trans('segments.add_new.field.select_criteria')}}" onchange="getValue('opens-clicks-country', 'email_trackings', 'country', 'none', this.value, this.id,'')" data-placeholder="{{trans('segments.add_new.field.select_criteria')}}">
                                            <option value="" readonly="readonly">{{trans('segments.add_new.field.select_criteria')}}</option>
                                            <optgroup label="By Contact’s activity">
                                                <option value="has_opened_broadcast" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='has_opened_broadcast') selected="" @endif  >{{trans('segments.add_new.field.has_opened_broadcast')}}</option>
                                                        <option value="hasnt_opened_broadcast" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='hasnt_opened_broadcast') selected="" @endif>{{trans('segments.add_new.field.hasnt_opened_any_broadcast')}}</option>
                                                        <option value="has_unsubscribed" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='has_unsubscribed') selected="" @endif>{{trans('segments.add_new.field.has_unsubscribe')}}</option>
                                                        <option value="has_complained" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='has_complained') selected="" @endif>{{trans('segments.add_new.field.has_complained')}}</option>
                                                    </optgroup>
                                                    <optgroup label="By Delivery Status">
                                                        <option value="is_sent" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='is_sent') selected="" @endif>{{trans('segments.add_new.field.sent')}}</option>
                                                        <option value="never_sent" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='never_sent') selected="" @endif>{{trans('segments.add_new.field.never_sent')}}</option>
                                                        <option value="injected" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='injected') selected="" @endif>{{trans('segments.add_new.field.injected_into_mta')}}</option>
                                                        <option value="delivered" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='delivered') selected="" @endif>{{trans('segments.add_new.field.delivered')}}</option>
                                                        <option value="delayed" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='delayed') selected="" @endif>{{trans('segments.add_new.field.delayed')}}</option>
                                                        <option value="bounced" @if(isset($meta_attributes['opens_clicks_status']) && $meta_attributes['opens_clicks_status']=='bounced') selected="" @endif>{{trans('segments.add_new.field.bounced')}}</option>
                                                    </optgroup>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row has_opened_broadcast" style="display: none;" data-name="RpSNqJAq">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.and')}}</label>
                                <div class="input-group col-md-12" data-name="DjcPDawf">
                                    <div class="kt-checkbox-inline col-md-12" id="linkType" data-name="qfjpftrC">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" id="lick_click" checked="" value="clicked_on_a_link" name="open_click[]">
                                            {{trans('segments.add_new.field.clicked_on_link')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-checkbox">
                                            <input type="checkbox" id="not_a_click" checked="" value="has_not_clicked_on_any_link" name="open_click[]">
                                            {{trans('segments.add_new.field.hasnt_clicked_on_link')}}
                                            <span></span>
                                        </label>
                                    </div>
                                    <div id="andLinks" class="col-md-6" data-name="mKuppzQh">
                                        <div class="kt-radio-inline filterradio" data-name="mXectpFg">
                                            <label class="kt-radio">
                                                <input type="radio" id="linksType" checked="" name="any_select_link" value="Any link"> {{trans('segments.add_new.field.any_link')}}
                                                <span></span>
                                            </label>
                                            <label class="kt-radio">
                                                <input type="radio" id="linksType2" name="any_select_link" value="custom"> {{trans('segments.add_new.field.selected_links')}}
                                                <span></span>
                                            </label>
                                        </div>
                                        <div id="selected_links" class="col-md-12" style="display: none;" data-name="hVmbrIDB">
                                            <select id="links_clicked" name="links_clicked[]" multiple="" class="form-control"></select>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row has_bounce" style="display: none;" data-name="yTLpshQV">
                                <label class="col-form-label col-md-12"></label>
                                <div class="input-group col-md-12" data-name="gMKTmfvw">
                                    <div class="input-group" data-name="KMMWXeYc">
                                        <div class="kt-radio-inline" data-name="NHcVgHRv">
                                            <label class="kt-radio">
                                                <input type="radio" id="boptsType" checked="" name="bounce_options" value="Type" disabled=""> {{trans('segments.add_new.field.type')}}
                                                <span></span>
                                            </label>
                                            <label class="kt-radio">
                                                <input type="radio" id="boptsReason" name="bounce_options" value="boptsReason" disabled=""> {{trans('segments.add_new.field.bounce_reason')}}
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="kt-checkbox-inline" id="chsType" data-name="aTcmRwkf">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" checked="" value="soft" name="bounced_type[]" id="soft_bounces" disabled="">
                                            {{trans('segments.add_new.field.soft_bounce')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-checkbox">
                                            <input type="checkbox" checked="" value="hard" name="bounced_type[]" id="hard_bounced" disabled="">
                                            {{trans('segments.add_new.field.hard_bounce')}}
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="form-group row" id="chsReas" data-name="WXRTlrCw">
                                        <div class="col-md-4" data-name="dNKLfnzg">
                                            <select class="form-control m-select2" id="chsRs1" name="bounces" disabled="">
                                                <option value="bounce_code">{{trans('segments.add_new.field.bounce_code')}}</option>
                                                <option value="bounce_reason">{{trans('segments.add_new.field.bounce_reason')}}</option>
                                                <option value="bounce_details">{{trans('segments.add_new.field.bounce_details')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" data-name="ePspSdlJ">
                                            <select class="form-control m-select2" id="bounce_condition" name="bounce_condition" disabled="">
                                                <option value="is">{{trans('segments.add_new.field.filter_is')}}</option>
                                                <option value="is_not">{{trans('segments.add_new.field.filter_isnt')}}</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4" id="div_bounce_value" data-name="XpdkIeyP">
                                            <select class="form-control m-select2" name="bounce_value" id="bounce_value" disabled="">
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row group_1" data-name="lHiVHiJX">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.country')}}</label>
                                <div class="col-md-6" data-name="lEvmjqNj">
                                    <div id="countrBlk" class="filterradio kt-radio-inline" data-name="PJtHyoBy">
                                        <label for="country_any" class="kt-radio">
                                            <input type="radio" name="countryChk" value="any" disabled="" checked=""  id="country_any" class="country_class">
                                            {{trans('segments.add_new.field.any_country')}}
                                            <span></span>
                                        </label>
                                        <label for="country_select" class="kt-radio">
                                            <input type="radio" name="countryChk" value="custom" id="country_select" class="country_class">
                                            {{trans('segments.add_new.field.selected_country')}}
                                            <span></span>
                                            <small id="country_select-error" class="error invalid-feedback">{{trans('segments.view_segment.create.select_country.required')}}</small>
                                        </label>
                                    </div>

                                    <div id="countrySelect" class="actOpt" style=" display: none " data-name="WdgeUjzr" >
                                        <select id="opens-clicks-country" class="mt-multiselect btn btn-default form-control"  data-placeholder="{{trans('segments.add_new.field.choose.country')}}" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300" name="opens_clicks_country[]" onchange="getStates()" style="display: none;">
                                            @foreach ($countries as $country)
                                         <option @if(isset($meta_attributes['countryChk']) && $meta_attributes['countryChk']=='custom' && isset($meta_attributes['opens_clicks_country']) && is_array($meta_attributes['opens_clicks_country']) && in_array($country->country_code,$meta_attributes['opens_clicks_country'])) selected @endif value="{{ $country->country_code }}"> {{ $country->country_name }} </option>
                                         @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row group_1" data-name="NJXxsYOM">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.state')}}</label>
                                <div class="col-md-6" data-name="TupXCVJy">
                                    <div id="stateBlk" class="filterradio kt-radio-inline" data-name="kVwAiUKw">
                                        <label for="state_any" class="kt-radio">
                                            <input type="radio" value="any" name="stateChk" checked="" disabled="" id="state_any" class="state_class">
                                            {{trans('segments.add_new.field.any_state')}}
                                            <span></span>
                                        </label>
                                        <label for="state_select" class="kt-radio">
                                            <input type="radio" value="custom" name="stateChk" id="state_select" disabled="" class="state_class">
                                            {{trans('segments.add_new.field.selected_state')}}
                                            <span></span>
                                            <small id="state_select-error" class="error invalid-feedback">{{trans('segments.view_segment.create.select_state.required')}}</small>
                                        </label>
                                    </div>
                                    <div class="input-icon right actOpt" id="state_block" style="display:none" data-name="boiNHHas">
                                        <select id="opens_clicks_region" class="form-control m-select2" data-placeholder="{{trans('segments.add_new.field.choose.state')}}" name="opens_clicks_region[]" onchange="getCities()" multiple="multiple" >
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row group_1" data-name="mLrlpAxt">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.city')}}</label>
                                <div class="col-md-6" data-name="kLyjfZip">
                                    <div id="cityBlk" class="filterradio kt-radio-inline" data-name="EwrwDpFZ">
                                        <label for="city_any" class="kt-radio">
                                            <input type="radio" value="any" name="cityChk" id="city_any" checked="" dir="" class="city_class">
                                            {{trans('segments.add_new.field.any_city')}}
                                            <span></span>
                                        </label>
                                        <label for="city_select" class="kt-radio">
                                            <input type="radio" value="custom" name="cityChk" id="city_select" class="city_class" disabled="">
                                            {{trans('segments.add_new.field.selected_city')}}
                                            <span></span>
                                            <small id="city_select-error" class="error invalid-feedback">{{trans('segments.view_segment.create.select_city.required')}}</small>
                                        </label>
                                    </div>
                                    <div class="input-icon right actOpt" id="city_block" style="display:none" data-name="nqIAWKsS">
                                        <select id="opens_clicks_city" class="form-control m-select2" data-placeholder="{{trans('segments.add_new.field.choose.city')}}" name="opens_clicks_city[]" onchange="" multiple="multiple">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row group_1" data-name="JVMsMgfe">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.zip')}}</label>
                                <div class="col-md-6" data-name="ffJjZbVl">
                                    <div id="zipBlk" class="filterradio kt-radio-inline" data-name="qSChXcQT">

                                        <label for="zip_any" class="kt-radio">
                                            <input type="radio" value="any" name="zipChk" id="zip_any" checked="" disabled="" class="zip_class">
                                            {{trans('segments.add_new.field.any_zip')}}
                                            <span></span>
                                        </label>

                                        <label for="zip_select" class="kt-radio">
                                            <input type="radio" value="custom" name="zipChk" id="zip_select" class="zip_class" disabled="" >
                                            {{trans('segments.add_new.field.selected_zip')}}
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="input-icon right actOpt" id="zip_block" style="display:none;" data-name="iPJFRKCl">
                                        <select id="opens_clicks_zip" class="form-control m-select2" multiple="multiple" data-placeholder="{{trans('segments.add_new.field.choose.zip')}}" name="opens_clicks_zip[]" style="display:none">
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row group_1" data-name="ecbbyCXW">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.browser')}}</label>
                                <div class="col-md-6" data-name="SNqBSxmr">
                                    <div id="browsBlk" class="filterradio kt-radio-inline" data-name="hMmocgkb">

                                        <label for="brows_any" class="kt-radio">
                                            <input type="radio" value="any" disabled="" name="browsChk" checked="" id="brows_any" class="brows_class">
                                            {{trans('segments.add_new.field.any_browser')}}
                                            <span></span>
                                        </label>

                                        <label for="brows_select" class="kt-radio">
                                            <input type="radio" value="custom" disabled="" name="browsChk" id="brows_select" class="brows_class">
                                            {{trans('segments.add_new.field.selected_browser')}}
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="input-icon right actOpt" id="brows_block" style="display: none;" data-name="kjBpDSOL">

                                        <select id="opens-clicks-browser" class="mt-multiselect btn btn-default form-control"  multiple data-placeholder="{{trans('segments.add_new.field.choose.browser')}}" name="opens_clicks_brower[]" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300">
                                            @foreach ($browsers as $browser)
                                                <option @if(isset($meta_attributes['browsChk']) && $meta_attributes['browsChk']=='custom' && isset($meta_attributes['opens_clicks_brower']) && is_array($meta_attributes['opens_clicks_brower']) && in_array($browser,$meta_attributes['opens_clicks_brower'])) selected @endif value="{{ $browser }}"> {{ $browser}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row group_1" data-name="PgyzVJWP">
                                <label class="col-form-label col-md-12">{{trans('segments.add_new.field.os')}}</label>
                                <div class="col-md-6" data-name="JwvWlzco">
                                    <div id="osBlk" class="filterradio kt-radio-inline" data-name="aIEQYPLM">

                                        <label for="os_any" class="kt-radio">
                                            <input type="radio" value="any" disabled="" name="osChk" checked="" id="os_any" class="os_class">
                                            {{trans('segments.add_new.field.any_os')}}
                                            <span></span>
                                        </label>

                                        <label for="os_select" class="kt-radio">
                                            <input type="radio" value="custom" disabled="" name="osChk" id="os_select" class="os_class">
                                            {{trans('segments.add_new.field.selected_os')}}
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="input-icon right actOpt" id="os_block" style="display: none;" data-name="ldAAuoRD">
                                        <select id="opens-clicks-os" class="mt-multiselect btn btn-default form-control" multiple data-placeholder="{{trans('segments.add_new.field.choose.os')}}" name="opens_clicks_os[]"  data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300">
                                            @foreach ($os as $key=>$os_name)
                                                <option value="{{ $key }}" @if(isset($meta_attributes['osChk']) && $meta_attributes['osChk']=='custom' && isset($meta_attributes['opens_clicks_os']) && is_array($meta_attributes['opens_clicks_os']) && in_array($key,$meta_attributes['opens_clicks_os'])) selected @endif >{{ $os_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row group_2" data-name="MgCZAJmR">
                                <label class="col-form-label col-md-12">
                                    {{trans('segments.add_new.field.duration')}}
                                </label>
                                <div class="col-md-12 filterradio" data-name="VWlNVYzJ">

                                    <div class="kt-radio-inline" data-name="kGqofbQF">
                                        <label for="none" class="kt-radio">
                                            <input type="radio" name="duration" id="none"  class="duration" value="none">
                                            {{trans('segments.add_new.field.none')}}
                                            <span></span>
                                        </label>

                                        <label for="custom" class="kt-radio">
                                            <input type="radio" name="duration" id="custom" class="duration" value="custom" >
                                            {{trans('segments.view_segment.by_date')}}
                                            <span></span>
                                        </label>
                                    </div>

                                    <div class="form-group row actOpt" id="duration_filter" style="display: none" data-name="tagwiWVl">
                                        <div class="col-md-12" data-name="MvIDBdHO">
                                            <div class="row" data-name="ctRFHusW">
                                                <div class="col-md-5" data-name="HhbNxwSD">
                                                    <select class="form-control m-select2" name="opens_clicks_dynamic_filter" id="opens_clicks_dynamic_filter">
                                                        <option value="after" @if(isset($segmentation->opens_clicks_dynamic_filter) && $segmentation->opens_clicks_dynamic_filter=='after')) selected="" @endif>
                                                            {{trans('segments.filter.after')}}</option>
                                                        <option value="before" @if(isset($segmentation->opens_clicks_dynamic_filter) && $segmentation->opens_clicks_dynamic_filter=='before')) selected="" @endif>
                                                            {{trans('segments.filter.before')}}</option>
                                                        <option value="exactly" @if(isset($segmentation->opens_clicks_dynamic_filter) && $segmentation->opens_clicks_dynamic_filter=='exactly')) selected="" @endif>
                                                            {{trans('segments.filter.exactly')}}</option>
                                                        <option value="between" @if(isset($segmentation->opens_clicks_dynamic_filter) && $segmentation->opens_clicks_dynamic_filter=='between')) selected="" @endif>
                                                            {{trans('segments.filter.between')}}</option>
                                                        <option value="is_overdue_for" @if(isset($segmentation->opens_clicks_dynamic_filter) && $segmentation->opens_clicks_dynamic_filter=='is_overdue_for')) selected="" @endif>
                                                            {{trans('segments.filter.occurring_before')}}</option>
                                                        <option value="past" @if(isset($segmentation->opens_clicks_dynamic_filter) && $segmentation->opens_clicks_dynamic_filter=='past')) selected="" @endif>
                                                            {{trans('segments.filter.for_the_past')}}</option>
                                                        <option value="older" @if(isset($segmentation->opens_clicks_dynamic_filter) && $segmentation->opens_clicks_dynamic_filter=='older')) selected="" @endif>
                                                            {{trans('segments.filter.older_than')}}
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-md-7" id="activity_date_section" data-name="uMHkXWHl">
                                                    <div class="input-group date date-picker" data-date-format="dd-mm-yyyy" data-name="XBtMKcNo">
                                                        <input type="text" class="form-control activity_duration"  placeholder="yyyy-mm-dd" id="duration_date" name="duration_date" value="" >
                                                        <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button">
                                                            <i class="la la-calendar"></i>
                                                        </button>
                                                    </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            </div>    
            <div class="row" id="filters" data-name="DHAxLctl" style="display: @if($meta_attributes['segment_type']==0) block; @else none; @endif">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="QAWxTJoZ">
                <div class="kt-portlet__head" data-name="ROnGZZxR">
                    <div class="kt-portlet__head-label" data-name="ZmHEIIni">
                        <h3 class="kt-portlet__head-title">{{trans('segments.add_new.field.apply_filters')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="tJZlUcBo">
                    <div class="form-group row" data-name="wPbsqldO">
                         <div class="col-md-12" data-name="MjGOLrMP">
                            <div id="kt_repeater_3" data-name="YSqpffNQ">
                                 <div class="form-group mt-repeater repeater3" data-name="PJilXmXw">
                                    <div data-repeater-list="custom_fields_filter" data-name="hFMSvXUJ">
                                        <?php
                                        $custom_id_number = 0;
                                        $totalFleidDiv = count($customCriteriaFormArray);
                                        ?>
                                        @foreach($customCriteriaFormArray as $form)
                                        <div data-repeater-item class="mt-repeater-item" id="grip_0" data-name="suHeiLbb">
                                            <div class="row mt-repeater-row" data-name="NAhzsebJ">
                                                <div class="col-md-4" data-name="oXeBPQpn">
                                                    <select class="form-control m-select2 custom_field_name" id="custom_field_name_{{ $form['f1']['id'] }}" name="<?php echo $form['f1']['name'];?>" data-placeholder="Select Option" onchange="loadCustomFieldsValues(this.name, this.value,this.id)">
                                                    <?php
                                                    $fgroup = 0;
                                                    ?>
                                                    @foreach($form['f1']['options'] as $select_field)
                                                        @if(isset($select_field['optgroup']))
                                                        <?php
                                                            if($fgroup>0){
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
                                                <div class="col-md-3" data-name="gqsptMkY">
                                                    <select class="form-control m-select2 custom_field_condition @if($form['f3']['type']=='date') date_condition @endif" name="custom_field_condition" id="custom_field_condition_{{ $form['f2']['id'] }}" data-placeholder="Select Option">
                                                        @if(count($form['f2']['options'])>0)
                                                            @foreach($form['f2']['options'] as $condition)
                                                             <option value="{{ $condition['value'] }}" @if($condition['value']==$form['f2']['selected_value']) selected="" @endif  >{{ $condition['lable'] }}</option>
                                                            @endforeach 
                                                        @endif
                                                    </select>
                                                </div>
                                                @if($form['f1']['selected_value']==6)
                                                    <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                                                        <div id="countrBlk_{{ $custom_id_number }}" class="filterradio cfield kt-radio-inline">
                                                            <label for="country_any_{{ $custom_id_number }}" class="kt-radio">
                                                                <input type="radio" value="any" name="custom_field_value_country"class="country_options" @if(isset($form['f3']['selected_value']['custom_field_value_country'])&& $form['f3']['selected_value']['custom_field_value_country']=='any') checked="" @endif id="country_any_{{ $custom_id_number }}">
                                                                {{ trans('schedule_broadcast.add_new.tab1.form.any_country') }} <span></span>
                                                            </label>  

                                                            <label for="country_select_{{ $custom_id_number }}" class="kt-radio">
                                                                <input type="radio" class="country_options" @if(isset($form['f3']['selected_value']['custom_field_value_country']) && $form['f3']['selected_value']['custom_field_value_country']=='custome_country') checked="" @endif value="custome_country" name="custom_field_value_country" id="country_select_{{ $custom_id_number }}">
                                                                {{ trans('schedule_broadcast.add_new.tab1.form.selected_country') }} <span></span>
                                                            </label>
                                                        </div>
                                                        <span style="display:@if(isset($form['f3']['selected_value']['custom_field_value_country']) && $form['f3']['selected_value']['custom_field_value_country']=='custome_country')contents;@else none;@endif" >
                                                            <select class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_{{ $custom_id_number }}"  name="custom_field_value_countries" >
                                                                @if($form['f3']['selected_value']['custom_field_value_country']) && $form['f3']['selected_value']['custom_field_value_country']=='custome_country')
                                                                    <option value="">{{ trans('schedule_broadcast.add_new.tab1.form.select_country') }}</option>
                                                                    @foreach($countriesData as $country)
                                                                    <option @if(isset($form['f3']['selected_value']['custom_field_value_countries']) && in_array($country['id'], $form['f3']['selected_value']['custom_field_value_countries'])) selected="" @endif value="{{ $country['id'] }}" >{{ $country['country_name'] }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>          
                                                        </span>
                                                    </div>                                                                                    
                                                @elseif($form['f2']['selected_value']=='between')
                                                    <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                                                            <div class="dpr ssrange" id="csrange_{{ $custom_id_number }}">
                                                                <div class='input-daterange input-group'>
                                                                    <input type="text" value="@if(isset($form['f3']['selected_value']['cfrom'])) {{ $form['f3']['selected_value']['cfrom'] }} @endif"  class="form-control from" id="sfrom_{{ $custom_id_number }}" name="cfrom"  data-date-format="yyyy-mm-dd" />
                                                                    <div class="input-group-append"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>
                                                                    <input type="text" value="@if(isset($form['f3']['selected_value']['cto'])) {{ $form['f3']['selected_value']['cto'] }} @endif" class="form-control to" id="sto_{{ $custom_id_number }}" name="cto"  data-date-format="yyyy-mm-dd" />
                                                                </div>            
                                                            </div>
                                                    </div>  
                                                @elseif($form['f2']['selected_value']=='is_due_in' || $form['f2']['selected_value']=='is_overdue_for' || $form['f2']['selected_value']=='past' || $form['f2']['selected_value']=='older')
                                                    <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                                                        <div class="cusomDate row">
                                                            <div class="datefields col-md-6">
                                                                <input type="number" id="days_value_time_{{ $custom_id_number }}" value="@if(isset($form['f3']['selected_value']['days_time_value_name'])){{ $form['f3']['selected_value']['days_time_value_name'] }}@endif" name="days_time_value_name"  class="form-control" placeholder="{{trans('segments.add_new.field.placeholder.xx_days')}}" />
                                                            </div>
                                                            <div class="datefields pull-right  col-md-6">
                                                                <select class="form-control" id="custom_duration_{{ $custom_id_number }}"  name="duration_time">
                                                                    <option value="days" @if(isset($form['f3']['selected_value']['duration_time']) && $form['f3']['selected_value']['duration_time'] =='days') selected="" @endif >{{trans("common.days")}}</option>
                                                                    <option value="weeks" @if(isset($form['f3']['selected_value']['duration_time']) && $form['f3']['selected_value']['duration_time'] =='weeks') selected="" @endif>{{trans("common.weeks")}}</option>
                                                                    <option value="months" @if(isset($form['f3']['selected_value']['duration_time']) && $form['f3']['selected_value']['duration_time'] =='months') selected="" @endif>{{trans("common.months")}}</option>
                                                                    <option value="years" @if(isset($form['f3']['selected_value']['duration_time']) && $form['f3']['selected_value']['duration_time'] =='years') selected="" @endif>{{trans("common.years")}}</option>
                                                                </select>
                                                            </div>
                                                        </div>               
                                                    </div>      
                                                @elseif($form['f2']['selected_value']=='day_of_month')
                                                
                                                <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">                                                                                           
                                                    <div>
                                                        <select class="form-control m-select2 monthYear" id="custom_field_date_value_{{ $custom_id_number }}"  name="custom_date_field_value">
                                                            <option value="-1" @if($form['f3']['selected_value']==-1) selected  @endif>{{ trans("segments.filter.todays_date") }}</option>    
                                                            <?php
                                                               for($i=1;$i<32;$i++){
                                                                   ?>
                                                                  <option @if($form['f3']['selected_value']==$i) selected  @endif value="{{ $i }}">{{ $i }}</option> 
                                                               <?php
                                                               }
                                                               ?>    
                                                        </select>             
                                                    </div>
                                                 </div>
                                                @elseif($form['f2']['selected_value']=='month_of_year')
                                                
                                                <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">                                                                                           
                                                    <div>
                                                        <select class="form-control m-select2 monthYear" id="custom_field_date_value_{{ $custom_id_number }}"  name="custom_date_field_value">
                                                            <option value="-1"  @if($form['f3']['selected_value']==-1) selected  @endif>{{ trans("segments.filter.this_month") }}</option>
                                                            <option value="1"  @if($form['f3']['selected_value']==1) selected  @endif>{{ trans("segments.filter.january") }}</option>
                                                            <option value="2"  @if($form['f3']['selected_value']==2) selected  @endif>{{ trans("segments.filter.february") }}</option>
                                                            <option value="3"  @if($form['f3']['selected_value']==3) selected  @endif>{{ trans("segments.filter.march") }}</option>
                                                            <option value="4"  @if($form['f3']['selected_value']==4) selected  @endif>{{ trans("segments.filter.april") }}</option>
                                                            <option value="5"  @if($form['f3']['selected_value']==5) selected  @endif>{{ trans("segments.filter.may") }}</option>
                                                            <option value="6"  @if($form['f3']['selected_value']==6) selected  @endif>{{ trans("segments.filter.june") }}</option>
                                                            <option value="7"  @if($form['f3']['selected_value']==7) selected  @endif>{{ trans("segments.filter.july") }}</option>
                                                            <option value="8"  @if($form['f3']['selected_value']==8) selected  @endif>{{ trans("segments.filter.august") }}</option>
                                                            <option value="9"  @if($form['f3']['selected_value']==9) selected  @endif>{{ trans("segments.filter.september") }}</option>
                                                            <option value="10"  @if($form['f3']['selected_value']==10) selected  @endif>{{ trans("segments.filter.october") }}</option>
                                                            <option value="11"  @if($form['f3']['selected_value']==11) selected  @endif>{{ trans("segments.filter.november") }}</option>
                                                            <option value="12"  @if($form['f3']['selected_value']==12) selected  @endif>{{ trans("segments.filter.december") }}</option>
                                                        </select>             
                                                    </div>
                                                 </div>
                                                @elseif($form['f2']['selected_value']=='is_today')
                                                
                                                <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">                                                                                           
                                                    <div class="" data-date-format="yyyy-mm-dd">
                                                        <input type="hidden" value="today" name="custom_date_field_value" id="custom_field_date_value_{{ $custom_id_number }}" >                
                                                    </div>
                                                 </div> 
                                                
                                                
                                                @elseif($form['f3']['type']=='select' || $form['f3']['type']=='checkbox' || $form['f3']['type']=='radio')
                                                <?php
                                                $select_class = $form['f3']['type'] == 'checkbox'? 'class="mt-multiselect btn btn-default form-control custom_field_value" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300"':'class="form-control m-select2 custom_field_value"';
                                                $selectedoptions = $form['f3']['selected_value'];
                                                ?>
                                                    <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">

                                                            <select {!! $select_class !!} data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_{{ $custom_id_number }}"  name="custom_fields_filter[{{ $custom_id_number }}][custom_field_value]" >

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

                                                 <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">                                                                                           
                                                    <div class="date date-picker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" value="@if(isset($form['f3']['selected_value'])){{ $form['f3']['selected_value'] }}@endif" class="form-control datesystem custom_field_value" placeholder="{{trans('segments.add_new.field.date_field')}}" name="custom_date_field_value" id="custom_field_date_value_{{ $custom_id_number }}" >                
                                                    </div>
                                                 </div>   
                                                @elseif($form['f3']['type']=='textarea')
                                                <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                                                    <textarea  id="custom_field_value_{{ $custom_id_number }}" placeholder="{{trans('segments.add_new.field.comma_separated_list')}}" id="custom_field_value_{{ $form['f3']['id'] }}" class="form-control custom_field_value" name="custom_field_value">@if(isset($form['f3']['selected_value'])) {{ $form['f3']['selected_value'] }} @endif</textarea>
                                                </div>
                                                @else

                                                <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_{{ $form['f3']['id'] }}" data-name="vCQzDarx">
                                                    <input type="text" id="custom_field_value_{{ $form['f3']['id'] }}" name="custom_field_value" class="form-control textsystem custom_field_value" value="@if(isset($form['f3']['selected_value'])) {{ is_array($form['f3']['selected_value']) ? $form['f3']['selected_value'][0]: $form['f3']['selected_value'] }} @endif" placeholder="Text Field"  >                                                
                                                </div>

                                               @endif
                                                <div class="col-md-1" data-name="SniVXvjI">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger btn-icon btn-sm">
                                                        <i class="la la-close"></i>
                                                    </a>
                                                </div>
                                            </div>
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
                                        @if($totalFleidDiv==0)
                                        <div data-repeater-item class="mt-repeater-item" id="grip_0" data-name="suHeiLbb">
                                            <div class="row mt-repeater-row" data-name="NAhzsebJ">
                                                <div class="col-md-4" data-name="oXeBPQpn">
                                                    <select id="custom_field_name_0" class="form-control m-select2 custom_field_name" name="custom_field_name" data-placeholder="{{ trans('common.label.select_option') }}" onchange="loadCustomFieldsValues(this.name, this.value,this.id)">
                                                        <option readonly="readonly">{{ trans('common.label.select_option') }}</option>
                                                        <optgroup label="By Contact Details">
                                                            <option value="subscriber_status" data_value="" data-type="select">{{ trans('segments.filter.subscriber.options.status') }}</option>
                                                            <option value="subscription_status" data_value="" data-type="select">{{ trans('segments.filter.subscriber.options.subscription_status') }}</option>
                                                            <option value="confirmation_status" data_value="" data-type="select">{{ trans('segments.filter.subscriber.options.confirmation_status') }}</option>
                                                            <option value="complained_status" data_value="" data-type="select">{{ trans('segments.filter.subscriber.options.complained_status') }}</option>
                                                            <option value="content_format" data_value="" data-type="select">{{ trans('segments.filter.subscriber.options.content_format') }}</option>
                                                            <option value="creation_date" data_value="" data-type="date">{{ trans('segments.filter.subscriber.options.creation_date') }}</option>
                                                            <option value="bounce_status" data_value="" data-type="select">{{ trans('segments.filter.subscriber.options.bounce_status') }}</option>
                                                            <option value="suppression_status" data_value="" data-type="select">{{ trans('segments.filter.subscriber.options.suppression_status') }}</option>
                                                        </optgroup>
                                                        <optgroup label="{{ trans('segments.filter.subscriber.options.by_field_value') }}">
                                                            <option value="subscriber_email" data-type='email'>
                                                                {{trans("common.label.email")}}
                                                            </option>
                                                            @foreach ($custom_fields as $key => $field)
                                                                <option value="{{ $field['id'] }}" data_value="{{ $field['options'] }}" data-type="{{ $field['type'] }}">{{ $field['name'] }}</option>
                                                            @endforeach
                                                        </optgroup>
                                                    </select>
                                                </div>
                                                <div class="col-md-3" data-name="gqsptMkY">
                                                    <select id="custom_field_condition_0" class="form-control custom_field_condition" name="custom_field_condition" data-placeholder="{{ trans('segments.filter.subscriber.options.select_option') }}">
                                                                <option readonly="readonly">{{ trans('segments.filter.subscriber.options.select_option') }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 div_custom_field_value" id="div_custom_field_value_0" data-name="vCQzDarx">
                                                    <input type="text" class="form-control textsystem custom_field_value" placeholder="Text Field" id="custom_field_value_0" name="custom_field_value" >                                                
                                                </div>
                                                <div class="col-md-1" data-name="SniVXvjI">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger btn-icon btn-sm">
                                                        <i class="la la-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div id="btn-new_" data-name="EQEZvkBH"><div data-repeater-create="" class="btn btn btn-info btn-sm" onclick="replaceCustomDivHTML()" data-name="njwScUwq"><span><i class="la la-plus"></i></span></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="row" id="filters2" data-name="yADlIVXV" style="display: @if($meta_attributes['segment_type']==0) none; @else block; @endif">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="toXBYReM">
                <div class="kt-portlet__head" data-name="kmMJIvbl">
                    <div class="kt-portlet__head-label" data-name="wyyRqOKu">
                        <h3 class="kt-portlet__head-title">{{trans('segments.add_new.field.apply_filters')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="dKnqcrml">
                    <div class="form-group row" data-name="JXTzyGfD">
                         <div class="col-md-12" data-name="yBgyMQYK">
                            <div id="kt_repeater_4" data-name="cjTZkElv">
                                 <div class="form-group mt-repeater repeater2" data-name="vbjXVbeI">
                                    <div data-repeater-list="subscriber_filter" data-name="iGVCgVnq">
                                        <?php
                                        $susbcriber_id_number = 0;
                                        $subscriberFilterFormArrayCount = count($subscriberFilterFormArray);
                                        
                                        ?>
                                        @if($subscriberFilterFormArrayCount>0)
                                            @foreach($subscriberFilterFormArray as $form)

                                                <div data-repeater-item class="mt-repeater-item system_data" id="subsciber_grid_0" data-name="TbBZBvkq" >
                                                    <div class="row mt-repeater-row" data-name="eXeVhSqD">
                                                        <div class="col-md-4" data-name="JWBItmzK">
                                                             <select id="subscriber_field_name_{{ $form['f1']['id'] }}" name="<?php echo $form['f1']['name'];?>"  class="form-control subscriber_field_name"  data-placeholder="{{ trans('segments.filter.subscriber.options.select_option') }}" onchange="loadSubscriberConditions(this.name, this.value,this.id)">
                                                                @foreach($form['f1']['options'] as $select_field)
                                                                    @if($select_field['lable']!="")
                                                                        <option @if($select_field['value']==$form['f1']['selected_value']) selected="" @endif value="{{ $select_field['value'] }}">{{ $select_field['lable'] }}</option>               
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-3" data-name="kqBkZEQY">
                                                            
                                                            <select class="form-control subscriber_condition_name" id="subscriber_condition_name_{{ $form['f2']['id'] }}" name="subscriber_condition_name" data-placeholder="Select Option" >
                                                                @if(count($form['f2']['options'])>0)
                                                                    @foreach($form['f2']['options'] as $condition)
                                                                     <option value="{{ $condition['value'] }}" @if($condition['value']==$form['f2']['selected_value']) selected="" @endif  >{{ $condition['lable'] }}</option>
                                                                    @endforeach 
                                                                @endif
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4 div_subscriber_field_value" id="div_subscriber_field_value_{{ $form['f3']['id'] }}" data-name="ZgNBtOtL">
                                                            @if($form['f1']['selected_value']=='contact_list' || $form['f1']['selected_value']=='sending_node' || $form['f1']['selected_value']=='sending_domain' || $form['f1']['selected_value']=='bounce_email')
                                                            <select class="mt-multiselect btn btn-default form-control" multiple="" data-width="100%" data-label="left" data-select-all="true" id="subscriber_field_value_{{ $susbcriber_id_number }}"  name="subscriber_filter[{{ $custom_id_number }}][subscriber_field_value]" >
                                                                    @foreach($form['f3']['options'] as $option)
                                                                        <option @if(in_array($option['value'],$form['f3']['selected_value'])) selected="" @endif value="{!! $option['value'] !!}">{!! $option['lable'] !!}</option>
                                                                    @endforeach
                                                                </select>
                                                            @else
                                                            <input type="text" name="subscriber_filter[{{ $susbcriber_id_number }}][subscriber_field_value]" value="{{ $form['f3']['selected_value'] }}" id="subscriber_field_value_{{ $form['f3']['id'] }}" class="form-control">
                                                            @endif

                                                        </div>
                                                        <div class="col-md-1" data-name="kLewCgbm">
                                                            <a href="javascript:;" data-repeater-delete class="btn btn-danger btn-icon btn-sm">
                                                                <i class="la la-close"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <?php
                                                $susbcriber_id_number++;
                                                ?>
                                                @if($subscriberFilterFormArrayCount!=$susbcriber_id_number)
                                                <script>
                                                    subcriber_sections++;
                                                    console.log(subcriber_sections);//subcriber_sections
                                                </script>                                                                                
                                                @endif
                                            @endforeach
                                        @endif
                                        @if($subscriberFilterFormArrayCount==0)
                                        <div data-repeater-item class="mt-repeater-item system_data" id="subsciber_grid_0" data-name="TbBZBvkq" >
                                            <div class="row mt-repeater-row" data-name="eXeVhSqD">
                                                <div class="col-md-4" data-name="JWBItmzK">
                                                     <select id="subscriber_field_name_0" class="form-control subscriber_field_name" name="subscriber_field_name" data-placeholder="{{ trans('segments.filter.subscriber.options.select_option') }}" onchange="loadSubscriberConditions(this.name, this.value,this.id)">
                                                                <option readonly="readonly">{{ trans('segments.filter.subscriber.options.select_option') }}</option>
                                                                <option value="contact_list">{{ trans('segments.filter.contact_list') }}</option>
                                                                <option value="sending_node">{{ trans('segments.filter.sending_node') }}</option>
                                                                <option value="sending_domain">{{ trans('segments.filter.sending_domain') }}</option>
                                                                <option value="send_from_email">{{ trans('segments.filter.send_from_email') }}</option>
                                                                <option value="bounce_email">{{ trans('segments.filter.bounce_email') }}</option>
                                                                <option value="reply_to_email">{{ trans('segments.filter.reply_to_email') }}</option>
                                                                <option value="recipient_email">{{ trans('segments.filter.recipient_email') }}</option>
                                                                <option value="schedule_label">{{ trans('segments.filter.schedule_email') }}</option>
                                                                <option value="message_id">{{ trans('segments.filter.message_id') }}</option>
                                                                <option value="subscription_status">{{ trans('segments.filter.subscriber.options.subscription_status') }}</option>
                                                            </select>
                                                </div>
                                                <div class="col-md-3" data-name="kqBkZEQY">
                                                    <select class="form-control subscriber_condition_name" id="subscriber_condition_name_0" name="subscriber_condition_name" data-placeholder="Select Option" >
                                                        <option readonly="readonly">{{ trans('common.label.select_option') }}</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 div_subscriber_field_value" id="div_subscriber_field_value_0" data-name="ZgNBtOtL">
                                                    <input type="text" name="subscriber_field_value" class="form-control">
                                                </div>
                                                <div class="col-md-1" data-name="kLewCgbm">
                                                    <a href="javascript:;" data-repeater-delete class="btn btn-danger btn-icon btn-sm">
                                                        <i class="la la-close"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div id="btn-new" data-name="YJhQGbFM"><div data-repeater-create="" class="btn btn btn-info btn-sm" onclick="replaceSubscriberDivHTML()" data-name="qbAXsUIK"><span><i class="la la-plus"></i></span></div></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        </div>
        <div class="col-md-8 create-form" data-name="yLSuKdvd">
            <div id="save" class="row" data-name="ujNxsKum">
                <div class="kt-portlet kt-portlet--height-fluid" data-name="ckRkTwgu">
                    <div class="kt-portlet__body" data-name="MLuQmnON">
                        <div class="form-actions" data-name="fJwJpHaG">
                            <div class="" data-name="EdhORgSR">
                                <input type="submit" name="submit" id="submit" class="btn btn-success" value="{{trans('common.form.buttons.save')}}" />
                                <input type="button" name="count_segment" id="count_segment" class="btn btn-info" value="Count" />
                                <div class="spinner_count" style="display:none;">{{ trans('segments.contacts_count') }}: <span id="segment_total_count"><i class="fa fa-spinner fa-spin fa-lg" id="countSegmentSpinner"></i></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- END FORM-->
@endsection