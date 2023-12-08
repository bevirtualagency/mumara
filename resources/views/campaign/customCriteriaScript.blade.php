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
<script>
 $(document).ready(function() {
        showOrHide('#list-status','#is_custom_criteria');
        @if(!empty($id) and $id>0)
        $(".datesystem").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        @else
            $(".datesystem").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).datepicker("setDate",'now');
    
        @endif
        $("#cfrom").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).datepicker("setDate",'now');
        $("#cto").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        }).datepicker("setDate",'now');
        @if(!empty($id) and $id>0)
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
        window.setTimeout(function () {

            $("#custom_field_name_0, #custom_field_condition_0, #subscriber_field_name_0, #subscriber_condition_name_0, #subscriber_field_value_0").select2({
            });

        }, 300);

        $(".country_class").click(function(){
            ///alert("aaaaa");
            chk_id = $(this).attr("id");
            if(chk_id=='country_select'){
                //$('#opens-clicks-country').prop( "disabled", false )
                $("#countrySelect").show();
            }else{
                $("#countrySelect").hide();
                ///$('#opens-clicks-country').prop( "disabled", true )
            }
        });
       
    });
    $(document).on("change", ".date_condition", function (event) {
       var date_condition_id = $(this).attr('id');
       var date_condition_name = $(this).attr('name');

       ///alert(date_condition_name + '   ====   ' + days_time_value);//date_field_dynamic_duration[0][dynamic_filter]====date_field_dynamic_duration[0][days_time_value]
       var date_condition_id_array = date_condition_id.split('_');
       var date_db_id = date_condition_id_array[3];
       custom_date_field_condition_value = $("#custom_field_condition_"+date_db_id).val();
       ///alert(dynamic_filter_val);
       if(custom_date_field_condition_value=='after' || custom_date_field_condition_value=='before' || custom_date_field_condition_value=='exactly'){
           var custom_field_date_value = date_condition_name.replace('custom_field_condition', 'custom_date_field_value');
           var db_date_div = date_div;
           db_date_div = db_date_div.replace('custom_field_date_value_0','custom_field_date_value_'+date_db_id);
           db_date_div = db_date_div.replace('custom_field_date_value',custom_field_date_value);
           ///$("#div_custom_field_value_"+date_db_id).html(db_date_div);
           //var days_time_value_name = date_condition_name.replace('dynamic_filter','days_time_value');
           // var new_date_field_db = date_field_db.replace("days_time_value",'days_time_value_'+date_db_id);
            //new_date_field_db = new_date_field_db.replace("days_time_value_name",days_time_value_name);

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
       }else{
            var days_time_value_name = date_condition_name.replace('custom_field_condition','days_time_value_name');
            var duration_time = date_condition_name.replace('custom_field_condition','duration_time');

            var new_date_field_db = date_duration.replace("days_value_time_1",'days_value_time_'+date_db_id);
            new_date_field_db = new_date_field_db.replace("custom_duration_1",'custom_duration_'+date_db_id);

            new_date_field_db = new_date_field_db.replace("days_time_value_name",days_time_value_name);
            new_date_field_db = new_date_field_db.replace("duration_time",duration_time);

            $("#div_custom_field_value_"+date_db_id).html(''+new_date_field_db);
       }
       ///alert("date_section_"+date_db_id);

       $(".activity_date_section").click(function(){
           ///alert("aaaaaaaaaaaaaa");
       });

    });
    $(document).on("change", ".country_options", function (event) {
       var country_field_id = $(this).attr('id');
       var country_field_name = $(this).attr('name');
       var custom_field_value_db = country_field_name.replace('custom_field_value', 'custom_field_value_countries');
        //alert(custom_field_value_db);
       var custom_field_country_array = country_field_id.split('_');
       var custom_id_country_number = custom_field_country_array[2];

       if($("#"+country_field_id).val()=='custome_country'){
          load_countries_ids(custom_id_country_number,custom_field_value_db);
       }else{
           //custom_field_value_country
           var checkbox_html = '<div id="countrBlk_'+custom_id_country_number+'" class="filterradio cfield kt-radio-inline"><label for="country_any_'+custom_id_country_number+'" class="kt-radio"><input type="radio" checked="" value="any" name="'+$(this).attr('name')+'" class="country_options" id="country_any_'+custom_id_country_number+'">{{ trans("segments.add_new.field.any_country")}} <span></span></label> <label for="country_select_'+custom_id_country_number+'" class="kt-radio"><input type="radio" class="country_options" value="custome_country" name="'+$(this).attr('name')+'"  id="country_select_'+custom_id_country_number+'">{{ trans("segments.add_new.field.selected_country")}} <span></span></label></div><select style="display:none;" class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_'+custom_field_value_db+'"  name="'+$(this).attr('name')+'" ></select>';  ;
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
                 var checkbox_html = '<div id="countrBlk_'+custom_id_number+'" class="filterradio cfield kt-radio-inline"><label for="country_any_'+custom_id_number+'" class="kt-radio"><input type="radio" value="any" name="custom_fields_filter['+custom_id_number+'][custom_field_value_country]" class="country_options" checked="" id="country_any_'+custom_id_number+'">{{ trans("segments.add_new.field.any_country")}} <span></span></label> <label for="country_select_'+custom_id_number+'" class="kt-radio"><input type="radio" class="country_options" value="custome_country" name="custom_fields_filter['+custom_id_number+'][custom_field_value_country]" checked="" id="country_select_'+custom_id_number+'">{{ trans("segments.add_new.field.selected_country")}} <span></span></label></div><select style="display:none;" class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_'+custom_id_number+'"  name="'+custom_field_value+'[]" ></select>';  ;
                $.ajax({
                    url: "{{ URL::route('get.country.options') }}",
                    type: "POST",
                    data: {'token':token},
                    beforeSend: function () {
                        $(".blockUI").show();
                    },
                    complete: function () {
                        $(".blockUI").hide();
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
                 var checkbox_html = '<div id="countrBlk_'+custom_id_number+'" class="filterradio cfield kt-radio-inline"><label for="country_any_'+custom_id_number+'" class="kt-radio"><input type="radio" value="any" name="custom_fields_filter['+custom_id_number+'][custom_field_value_country]" class="country_options" checked="" id="country_any_'+custom_id_number+'">{{ trans("segments.add_new.field.any_country")}} <span></span></label> <label for="country_select_'+custom_id_number+'" class="kt-radio"><input type="radio" class="country_options" value="custome_country" name="custom_fields_filter['+custom_id_number+'][custom_field_value_country]" checked="" id="country_select_'+custom_id_number+'">{{ trans("segments.add_new.field.selected_country")}} <span></span></label></div><select style="display:none;" class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true" id="custom_field_value_'+custom_id_number+'"  name="'+custom_field_value+'[]" ></select>';  ;
                $.ajax({
                    url: "{{ URL::route('get.country.options.ids') }}",
                    type: "POST",
                    data: {'token':token},
                    beforeSend: function () {
                        $(".blockUI").show();
                    },
                    complete: function () {
                        $(".blockUI").hide();
                    },
                    success: function(options) {
                        $("#div_custom_field_value_"+custom_id_number).html(checkbox_html);
                        $("#custom_field_value_"+custom_id_number).html(options);
                        $("#custom_field_value_"+custom_id_number).multiselect('rebuild');
                        $("#div_custom_field_value_"+custom_id_number+" .btn-group").attr( "id", "country_"+custom_id_number );
                    }
                });
    }
    var date_div = '';
        date_div += '<div class="date date-picker" data-date-format="dd-mm-yyyy">';
        date_div += '<input type="text" class="form-control datesystem" placeholder="{{trans('segments.add_new.field.date_field')}}" name="custom_field_date_value" id="custom_field_date_value_0" >';
        date_div += '</div>';

    var date_conditions = '<option></option>';
        date_conditions = '<option value="after">{{trans("segments.add_new.field.date_duration.values.after")}}</option>';
        date_conditions += '<option value="before">{{trans("segments.add_new.field.date_duration.values.before")}}</option>';
        date_conditions += '<option value="exactly">{{trans("segments.add_new.field.date_duration.values.exactly")}}</option>';
        date_conditions += '<option value="between">{{trans("segments.add_new.field.date_duration.values.between")}}</option>';
        date_conditions += '<option value="is_due_in">{{trans("segments.add_new.field.date_duration.values.is_due_in")}}</option>';
        date_conditions += '<option value="is_overdue_for">{{trans("segments.add_new.field.date_duration.values.is_overdue_for")}}</option>';
        date_conditions += '<option value="past">{{trans("segments.add_new.field.date_duration.values.past")}}</option>';
        date_conditions += '<option value="older">{{trans("segments.add_new.field.date_duration.values.older_than")}}</option>';

        var create_date_conditions = '<option value="after">{{trans("segments.add_new.field.date_duration.values.after")}}</option>';
        create_date_conditions += '<option value="exactly">{{trans("segments.add_new.field.date_duration.values.exactly")}}</option>';
        create_date_conditions += '<option value="between">{{trans("segments.add_new.field.date_duration.values.between")}}</option>';
        create_date_conditions += '<option value="is_due_in">{{trans("segments.add_new.field.date_duration.values.is_due_in")}}</option>';
        create_date_conditions += '<option value="is_overdue_for">{{trans("segments.add_new.field.date_duration.values.is_overdue_for")}}</option>';
        create_date_conditions += '<option value="past">{{trans("segments.add_new.field.date_duration.values.past")}}</option>';
        create_date_conditions += '<option value="older">{{trans("segments.add_new.field.date_duration.values.older_than")}}</option>';


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

        var date_duration ="<div class='cusomDate row'>";
                date_duration +="<div class='datefields col-md-6'>";
                     date_duration +="<input type='text' id='days_value_time_1' name='days_time_value_name'  class='form-control' placeholder='{{trans('segments.add_new.field.placeholder.xx_days')}}' />";
                date_duration +="</div>";
                    date_duration +="<div class='datefields pull-right col-md-6'>";
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
    ///var custom_sections = 0;
    var subcriber_sections = 0;
    
    function showOrHide(id,switch_id) {
        if($(switch_id).is(':checked'))
            $(id).slideDown('slow');
        else
            $(id).slideUp('slow');

    }
    
    if ($('#kt_repeater_3').length) {
        var reportRepeater = $('#kt_repeater_3').repeater({
            defaultValues: {
                'textarea-input': 'foo',
                'text-input': 'bar',
            },
            show: function() {
                $(this).slideDown();
                // $('.select2-container').remove();
                $('m-select2').select2({
                    width: '100%',
                    placeholder: "{{trans('broadcasts.custom_criteria_blade.select_option_placeholder')}}",
                    allowClear: true
                });
            },
            hide: function(deleteElement) {
                if (confirm('{{trans('broadcasts.custom_criteria_blade.want_to_delete_confirm')}}')) {
                    $(this).slideUp(deleteElement);
                }
            }

        });
    }
    $("#btn-new").click(function(){
        /*console.log("22");
        $('.select2-container').remove();
        $('.m-select2').select2({
            placeholder: "Placeholder text",
            allowClear: true
        });
        $('.select2-container').css('width','100%');
        $(".mt-repeater").slideDown();
        $('.m-select2').select2('destroy').select2();
        */
    });
    function replaceCustomDivHTML(){
        custom_sections++;
        ///console.log("custom_sections = "+custom_sections);
        window.setTimeout(function () {
             $(".custom_field_name").last().attr('id','custom_field_name_'+custom_sections);
             $(".custom_field_condition").last().attr('id','custom_field_condition_'+custom_sections);
             $(".custom_field_value").last().attr('id','custom_field_value_'+custom_sections);
             $(".div_custom_field_value").last().attr('id','div_custom_field_value_'+custom_sections);
             $("#div_custom_field_value_"+custom_sections).html('<input type="text" id="custom_field_value_'+custom_sections+'" name="custom_field_value" class="form-control textsystem custom_field_value" value="" placeholder="Text Field">');
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
         }, 300);
    }
    function loadCustomFieldsValues(custom_field_name, val,custom_field_id)
    {
        
        var custom_field_array = custom_field_id.split('_');
        var custom_id_number = custom_field_array[3];
        ///console.log("custom_id_number:"+custom_id_number);
        var custom_field_condition = custom_field_name.replace('custom_field_name', 'custom_field_condition');
        var custom_field_value = custom_field_condition.replace('custom_field_condition', 'custom_field_value');
        var custom_field_date_value = custom_field_condition.replace('custom_field_condition', 'custom_date_field_value');
        custom_field_value_country = custom_field_condition.replace('custom_field_condition', 'custom_field_value_country');
        //var select =  $("[name='"+custom_field_condition+"']");
        var type = $("[name='"+custom_field_name+"']").find(':selected').data('type');
        $("#custom_field_condition_"+custom_id_number).removeClass('date_condition');
        if (type == 'text' || type == 'textarea' || type == 'json' || type == 'numeric') {
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
            ///var select =  $("[name='"+custom_field_value+"']");
            if(type == 'textarea')
                $("#div_custom_field_value_"+custom_id_number).html("<textarea  id='custom_field_value_"+custom_id_number+"' placeholder='{{trans('segments.add_new.field.comma_separated_list')}}' class='form-control custom_field_value' name='"+custom_field_value+"'></textarea>");
            else
            $("#div_custom_field_value_"+custom_id_number).html("<input type='text' id='custom_field_value_"+custom_id_number+"' placeholder='{{trans('segments.add_new.field.comma_separated_list')}}' class='form-control custom_field_value' name='"+custom_field_value+"'/>");
            //select.replaceWith( "<input type='text' placeholder='Comma Separated List' class='form-control' name='"+custom_field_value+"' id='custom_field_value' />" );
        }
        else if (type == 'email') {
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
            //var select =  $("[name='"+custom_field_value+"']");

            $("#div_custom_field_value_"+custom_id_number).html("<input type='text' id='custom_field_value_"+custom_id_number+"' placeholder='{{trans('segments.add_new.field.comma_separated_list')}}' class='form-control custom_field_value' name='"+custom_field_value+"'/>");
            ///select.replaceWith( "<input type='text' placeholder='Comma Separated List' class='form-control' name='"+custom_field_value+"' id='custom_field_value' />" );
            //alert("aaaaa");
        }
        else if (type == 'checkbox' || type == 'select' || type == 'radio'){
            ///console.log("check");
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
                        checkbox_html += "<option value='suppressed'>{{trans('broadcasts.custom_criteria_blade.suppressed_checkbox')}}</option>";
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
                           checkbox_html += "<option value='no_process'>{{trans('segments.add_new.field.not_bounced')}}</option>";
                           checkbox_html += "<option value='hard'>{{trans('segments.add_new.field.hard_bounce')}}</option>";
                           checkbox_html += "<option value='soft'>{{trans('segments.add_new.field.soft_bounce')}}</option>";
                       }
                       else{
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

        }
        else if (type == 'date') {
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

            /*<div class="input-group date date-picker mb15" data-date-format="dd-mm-yyyy">
                <input type="text" class="form-control datesystem" placeholder="Date Field" id="datesystem" name="datesystem" >
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button">
                        <i class="la la-calendar"></i>
                    </button>
                </span>
            </div>*/
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
    function loadSubscriberConditions(subscriber_field_name, val, field_id)
    {
        var user_id = null;
           user_id = $('#where_user_id').val();
        if($('#user_broadcasts').is(':checked') && user_id=="") {
            Command: toastr["error"]("{{trans('segments.message.select_user')}}");
            return;
        }
        //var subscriber_condition_name = subscriber_field_name.replace('subscriber_field_name', 'subscriber_condition_name');
        //subscriber_condition_name_1
        var field_id_array = field_id.split('_');
        var id_number = field_id_array[3];


        var subscriber_field_value = subscriber_field_name.replace('subscriber_field_name', 'subscriber_field_value');
        var div_subscriber_field_value = '';
        if(val=='contact_list' || val=='sending_node_type' || val=='sending_node' || val=='sending_domain' || val=='bounce_email'){
            $("#subscriber_condition_name_"+id_number).html(is_isNot_options);
            div_subscriber_field_value += '<select class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300" data-width="100%" data-label="left" data-select-all="true" id="subscriber_field_value_'+id_number+'"  name="'+subscriber_field_value+'[]" >';
            $.ajax({
                url: "{{ URL::route('get.other.options') }}",
                type: "POST",
                data: {'values': val,'user_id':user_id},
                success: function(result) {
                    $("#div_subscriber_field_value_"+id_number).html(div_subscriber_field_value);
                    $("#subscriber_field_value_"+id_number).html(result);
                    $("#subscriber_field_value_"+id_number).multiselect('rebuild');
                }
            });

        }else{
            $("#subscriber_condition_name_"+id_number).html(is_isNot_options+contain_not_contain);
            div_subscriber_field_value ='<input class="form-control" type="text" id="subscriber_field_value_'+id_number+'" name="'+subscriber_field_value+'" value="">';
            $("#div_subscriber_field_value_"+id_number).html(div_subscriber_field_value);
        }
    }
    window.setTimeout(function () {
        $(".from").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $(".to").datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
     }, 300);
</script>