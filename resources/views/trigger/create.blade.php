@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/triggers-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<!--  CK Editor Plugins  -->
<script src="/js/libs/ckeditor/ckeditor.js"></script>
<script src="/js/libs/ckeditor/plugins/font/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/colorbutton/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/zsuploader/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/smiley/plugin.js"></script>
<script src="/js/libs/ckfinder/ckfinder.js"></script>
<style>
    b#fromNameSmtp { 
        font-weight:400 !important;
    }

    .kt-checkbox-list.list-disabled>label {
        /* opacity: 0.7; */
    }
    
    .kt-checkbox-list.list-disabled>label name {
        opacity: 0.7;
    }

    .kt-checkbox-list.list-disabled>label bar {
        font-size: 10px;
        font-weight: 500;
    }

    .kt-radio.kt-radio--disabled {
        opacity: 0.6;
    }
    .la-search:before {
        content: "\f2eb";
    }
    #contactList {
        padding-left: 38px;
        margin-bottom: -1px;
        border-radius: 0 !important;
        border-bottom: 1px solid #d1d7e2 !important;
    }
    .kt-input-icon > .kt-input-icon__icon {
        position: absolute;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        top: 0;
        width: 44px;
        height: 39px;
    }
    .kt-input-icon > .kt-input-icon__icon.kt-input-icon__icon--left {
        left: 0;
    }
    .kt-input-icon > .kt-input-icon__icon > span {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        height: 100%;
    }
    .kt-input-icon > .kt-input-icon__icon > span i {
        font-size: 18px;
    }
    .kt-input-icon.kt-input-icon--left {
        position: relative;
    }
    #contactList:focus {
        border-color: #d1d7e2 !important;
    }
</style>
<!--  END CK Editor Plugins  -->
@endsection

@section('page_scripts')

@include('campaign.customCriteriaScript')


<script src="/themes/default/js/scripts.bundle.js" type="text/javascript"></script>
        <script src="/themes/default/js/app.bundle.min.js" type="text/javascript"></script>
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
<script src="/themes/default/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datepicker.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/triggers.js?v={{$local_version}}" type="text/javascript"></script>
<script>
    var lists_arr;
    $(document).on('keyup','#contactList',function(){
        str = $('#contactList').val().toUpperCase();
        if(str.length>0)
        {
            for (variable in lists_arr)
            {
                name = lists_arr[variable].name;
                id = lists_arr[variable].id;
                exists = name.indexOf(str) > -1;
                if(!exists)
                    $('#flag_'+id).slideUp();
                else
                    $('#flag_'+id).slideDown();
            }
        }
        else{
            for (variable in lists_arr)
            {

                id = (lists_arr[variable].id);

                $('#flag_'+id).slideDown();
            }
        }
    });
function selectTag(field, ckeditor_id) {
    if(field == 'Unsubscribe Link')
        field = '<a href="%%unsubscribelink%%">{{trans('common.label.unsubscribe')}}</a>';
    else if(field == 'Confirm Link')
        field = '<a href="%%confirmurl%%">{{trans('common.label.confirm')}}</a>';
    else
        field = '%%'+field+'%%';
    CKEDITOR.instances[ckeditor_id].insertHtml(field);
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
function selectSpintag(spintag, ckeditor_id) {
    spintag = '{'+'{'+spintag+'}'+'}';
    CKEDITOR.instances[ckeditor_id].insertText(spintag);
}

$(function() {
    $("#customCriterea").hide(); 
});


<?php 
    if(!empty($meta_data["is_custom_criteria"]) and $meta_data["is_custom_criteria"] == "on") {
?>
$("#is_custom_criteria").prop("checked", true);  
<?php } ?>



function selectDynamicContent(dynamic_content, ckeditor_id) {
    dynamic_content = dynamic_content;
    CKEDITOR.instances[ckeditor_id].insertText(dynamic_content);
}
$('#trigger-type').change(function () {
    $(".blockUI").show();
    var action = $('#action').val();
    if(action == 'add'){
        var trigger_type = $('#trigger-type').val();
        /*if(trigger_type == 'calander_date'){
            $('#on-date').prop("disabled", false);
            $("#on-date").removeAttr('style');
            $('#perform_action_interval').val('on_date');
        }else{
            $('#on-date').prop("disabled", true);
            $("#on-date").css("display","none");
            $('#perform_action_interval').val('next_anniversary');
        }*/
    }else{
        var trigger_type = $("#trigger-type option:selected").val();
        var meta_data    = $('#meta-data').val();
        /*if(trigger_type == 'calander_date'){
            $('#on-date').prop("disabled", false);
            $("#on-date").removeAttr('style');
        }else{
            $('#on-date').prop("disabled", true);
            $("#on-date").css("display","none");
        }*/
    }

    var token = $('#token').val();
    $('#trigger-type-data-date').html('');
    $("#customCriterea").hide(); 
    $.ajax({
        url: "{{ URL::route('trigger.load.data') }}",
        type: 'POST',
        data: {'_token':token, 'trigger_type': trigger_type,'meta_data':meta_data},
        success: function (data) {
            $('#trigger-type-data').html(data);
            $('#trigger-type-custom').hide();
            $('.blockUI').show();
            $("#perform-action-event").removeAttr("disabled");
            var title_val = "start_autoresponder";
            $("#trigger-action option[value=" + title_val + "]").prop("disabled" , false);
            // load lists if campign type is custom in edit
            if(trigger_type == "")
                $('.blockUI').hide();
            if(trigger_type == "add_sub_list")
                $('.blockUI').hide();
            if(trigger_type == "add_sub_custom") {
                $("#perform-action-event").attr("disabled", "disabled");
                $('.blockUI').show();
                $("#trigger-type-data").empty();
                setTimeout(() => {
                    $('.blockUI').hide();
                    $('#trigger-type-custom').show();
                }, 1000);

                var title_val = "start_autoresponder";
                $("#trigger-action option[value=" + title_val + "]").prop("disabled" , true);

                return false;
            }
            if($('#trigger-list-custom').is(':checked')) {
                $('.loader').html('<div id="loading" style="width: 70px; height: 40px; display: inline-block;" />');
                $.ajax({
                    url: "{{ URL::route('trigger.load.data') }}",
                    type: 'POST',
                    data: {'trigger_type': 'trigger_list' , 'list':'list_custom','meta_data':meta_data},
                    success: function (data) {
                        $('#lists').html(data.html);
                        lists_arr = data.lists;
                        //$(".make-switch").bootstrapSwitch();
                        $('.blockUI').hide();
                        $('#loading').hide();
                    }
                });
            }
            if($('#trigger-segment-custom').is(':checked')) {
                tid = $('#tid').val();
                $('.loader').html('<div id="loading" style="width: 70px; height: 40px; display: inline-block;" />');
                $.ajax({
                    url: "{{ URL::route('trigger.load.data') }}",
                    type: 'POST',
                    data: {'trigger_type': 'trigger_segment' , 'segment':'segment_custom','meta_data':meta_data,'tid':tid},
                    success: function (data) {
                        $('#segments').html(data);
                        $('.blockUI').hide();
                        $('#loading').hide();
                    }
                });
            }
            if(trigger_type == "add_sub_segment") {
                tid = $('#tid').val();
                $('.loader').html('<div id="loading" style="width: 70px; height: 40px; display: inline-block;" />');
                $.ajax({
                    url: "{{ URL::route('trigger.load.data') }}",
                    type: 'POST',
                    data: {'trigger_type': 'trigger_segment' , 'segment':'segment_custom','meta_data':meta_data,'tid':tid},
                    success: function (data) {
                        $('#segments').html(data);
                        $('.blockUI').hide();
                        $('#loading').hide();
                    }
                });
            }
            if($('#trigger-campaign-custom').is(':checked')) {
                $('.loader').html('<div id="loading" style="width: 70px; height: 40px; display: inline-block;" />');
                $.ajax({
                    url: "{{ URL::route('trigger.load.data') }}",
                    type: 'POST',
                    data: {'trigger_type': 'trigger_campaign' , 'campaign':'campaign_custom','meta_data':meta_data},
                    success: function (data) {
                        $('#campaigns').html(data);
                        $('.blockUI').hide();
                        $('#loading').hide();
                    }
                });
            }
            if($("#based-campaign option:selected").val() == 'link_click'){
                $.ajax({
                    url: "{{ URL::route('trigger.load.data') }}",
                    type: 'POST',
                    data: {'trigger_type': 'link_click','meta_data':meta_data},
                    success: function (data) {
                        $('#links-input').html(data);
                        $('.blockUI').hide();
                    }
                });
            }
            if($("#based-date option:selected").val() == 'calander_date'){
                $.ajax({
                    url: "{{ URL::route('trigger.load.data') }}",
                    type: 'POST',
                    data: {'trigger_type': 'calander_date','meta_data':meta_data},
                    success: function (data) {
                        $('#select-date').html(data);
                        $('.blockUI').hide();
                    }
                });
            }

            if(trigger_type == "add_sub_list"){
                // $("#customCriterea").show();
            }

        }
    });
});
    //load trigger rules in edit
    var action = $('#action').val();
    if(action == 'edit'){
        $("#trigger-type").change();
    }
$('#perform-action-event').change(function () {
    var action_type = $('#action').val();
    if(action_type == 'add'){
        var action = $('#perform-action-event').val();
    }else{
        var action = $("#perform-action-event option:selected").val();
    }
    if (action == 'after') {
        $("#durationDB").show();
        $('#perform-action-datetime-count').prop("disabled", false);
        $('#perform-action-datetime-count').val("{{ !empty($meta_data['perform_action_datetime_count']) ? $meta_data['perform_action_datetime_count'] : '1' }}");
        $('#perform-action-datetime-frequency').prop("disabled", false);
    } else {
        $("#durationDB").hide();
        $('#perform-action-datetime-count').prop("disabled", true);
        $('#perform-action-datetime-count').val("");
        $('#perform-action-datetime-frequency').prop("disabled", true);
    }
});
    // load event in trigger
    var action = $('#action').val();
    if(action == 'edit'){
        $("#perform-action-event").change();
    }
$(document).ready(function(){
    $("#field_custom1").click(function() {
        $("#custom_value1").val("any");
        $(".blockUI").show();
        setTimeout(() => {
            $(".blockUI").hide();
            $(".slection2").show();
            $(".slection3").hide();
            $(".slection4").hide();
            $(".slection5").hide();
            $(".slection6").hide();
            //$("#values_custom1").prop("checked", true);
        }, 1000);
    });
    $("#field_custom2").click(function() {
        $("#custom_value1").val("selected");
      
        $(".blockUI").show();
        setTimeout(() => {
            $(".blockUI").hide();
            $(".slection2").hide();
            $(".slection3").hide();
            $(".slection4").show();
        }, 1000);
    });
    $("#values_custom1").click(function() {
        $("#custom_value2").val("any_value");
        $(".slection3").hide();
       
    });
    $("#values_custom2").click(function() {
        $("#custom_value2").val("this_value");
        $(".blockUI").show();
        setTimeout(() => {
            $(".blockUI").hide();
            $(".slection3").show();
        }, 1000);
    });
    $("#custom_fields").change(function() {
        $(".blockUI").show();
        setTimeout(() => {
            $(".blockUI").hide();
            $(".slection5").show();
            $(".slection6").hide();
        }, 1000);
    });
    $("#values_custom11").change(function() {
      
        $(".blockUI").show();
        setTimeout(() => {
            $(".blockUI").hide();
            $(".slection6").hide();
        }, 1000);
    });
    $("#values_custom22").change(function() {
        
        $(".blockUI").show();
        setTimeout(() => {
            $(".blockUI").hide();
            $(".slection6").show();
        }, 1000);
    });

    $(".m-select2").select2();
    $('#trigger-action').change(function () {
        var action_type = $('#action').val();
        if(action_type == 'add'){
            var action = $('#trigger-action').val();
            var  meta_data = '';
        }else{
            var action = $("#trigger-action option:selected").val();
            var meta_data  = $('#meta-data').val();
        }
        var listIds = [];
        var list_ids = $("input[name='list_ids[]']:checked").each(function(){
            var value = $(this).val();
            listIds.push(parseInt(value));
        });
        var token = $('#token').val();
        $.ajax({
            url: "{{ URL::route('trigger.load.data') }}",
            type: 'POST',
            dataType: 'html',
            data: {'trigger_type':action, 'listIds':listIds, 'meta_data':meta_data, '_token': token},
            beforeSend: function ()
            {
                if(action!=='send_notification')
                    $('#DragNDrop').slideUp('slow');
            },
            success: function (data) {
                $('#trigger-action-div').html(data);
                if(action=='send_notification')
                    $('#DragNDrop').slideDown('slow');
                if($('#action').val() == 'edit'){
                    if($("#action-suppression option:selected").val() == 'campaign_associated' || $("#action-suppression option:selected").val() == 'list_associated'){
                        var meta_data    = $('#meta-data').val();
                        var trigger_type = $("#action-suppression option:selected").val();
                        $.ajax({
                            url: '/trigger/loadTriggerData',
                            type: 'POST',
                            data: {'trigger_type': trigger_type ,'meta_data':meta_data},
                            success: function (data) {
                                $('#trigger-suppression-data').html(data);
                            }
                        });
                    }
                }
                $(".popovers").popover();
            }
        });
    });
});
function loadData(action) {
    var token = $('#token').val();
    $.ajax({
        url: "{{ URL::route('trigger.load.data') }}",
        type: 'POST',
        data: {'trigger_type': action,'_token': token},
        success: function (data) {
            $('#trigger-type-data-date').html(data);
        }
    });
};
var action = $('#action').val();
    if(action == 'edit'){
        $("#trigger-action").change();
    }
$('body').on('click', "#from_option_smtp", function() {
    $('#from-name-smtp').val('Y');
    if ($('#from-name-smtp').prop('checked')) {
        $('#from-name').prop('disabled', true);
    } else {
        $('#from-name').prop('disabled', false);
    }
});
$(document).ready(function(){
    $('.text-editor-ck').hide();
    $("#trigger-action").change(function(){
        $(this).find("option:selected").each(function(){
            var optionValue = $(this).attr("value");
            if(optionValue == 'send_notification'){
                $('.text-editor-ck').show();
            } else{
                $('.text-editor-ck').hide();
            }
        });
    }).change();
}); 
function getCustomFieldValue(selectObject) {
    var id = selectObject.value;
    $.ajax({
        type   : "GET",
        url    : "{{ url('/') }}"+'/trigger/fields/'+id,
        success: function(result) {
          //  console.log(result);
          $("#custom_field_value").html(result);
        }
    }); 
 }
 function validateTriggerAction()
 {
    var action = $("#trigger-action option:selected").val();
    if(action == ""){
        alert('{{trans('triggers.message.empty_field_true')}}');
    }
 }
function getSenderInformation(value)
{

    <?php 
         $smtptext = trans("common.label.choose_from_name_as_listed_in_smtp");
       
         $listtext = trans("common.label.choose_from_name_as_listed_in_list");   
    ?>
    if (value == 'smtp') {
        $("#fromNameSmtp").text("<?php echo $smtptext; ?>");
        $('#from_option_smtp').show();
        $('#from_option_custom').hide();
    } else if(value == 'list') {
        $("#fromNameSmtp").text("<?php echo $listtext; ?>");
        $('#from_option_smtp').show();
        $('#from_option_custom').hide();
    } else {
        $('#from_option_custom').show();
        $('#from_option_smtp').hide();
    }
    /*$('#from-name-smtp').val('N');
    $('#from-name-smtp').prop('checked', false);
    $('#from-name').prop('disabled', false);*/
}
var action = $('#action').val();
    if(action == 'edit'){
    value =  $('#sender-option').val();
        if(value == 'custom'){
        }
    }
function triggerRule (name, val)
{
    var select_name = name.replace('name', 'option');
    var select_name =  $("[name='"+select_name+"']");
    var select_contition_name = name.replace('name', 'condition');
    var select_condition =  $("[name='"+select_contition_name+"']");
    select_condition.remove();
    var trigger_rule_condition_div_name = name.replace('name', 'trigger-rule-condition-div');
    var trigger_rule_condition_div =  $("[name='"+trigger_rule_condition_div_name+"']");
    select_name.empty();
    if (val == 'country' || val == 'day_of_week' || val == 'day_of_month') {
        var html = "<select name='"+select_contition_name+"[]' class='form-control select2-multiple' multiple data-placeholder='Choose Option' value='' /></select>"+
                    "<script src='/assets/pages/scripts/components-select2.min.js'><\/script>";
        trigger_rule_condition_div.html(html);
        var select_condition =  $("[name='"+select_contition_name+"[]']");
    } else if (val == 'email_fomat' || val == 'confirmation_status') {
        var html = "<select name="+select_contition_name+" class='form-control select2-multiple' value='' /></select>";
        trigger_rule_condition_div.html(html);
        var select_condition =  $("[name='"+select_contition_name+"']");
    } else if (val == 'email_address' || val == 'custom_field_contain' || val == 'custom_field_not_contain' || val == 'custom_field_is_equal' || val == 'custom_field_not_equal') {
        var html = "<input name="+select_contition_name+" type='textbox' class='form-control' value='' />";
        trigger_rule_condition_div.html(html);
    } 
    if (val == 'country') {
        select_name.append('<option value="{{trans('common.include')}}">{{trans('common.include')}}</option>');
        select_name.append('<option value="{{trans('common.exclude')}}">{{trans('common.exclude')}}</option>');
        $.ajax({
            url: "{{ URL::route('trigger.load.data') }}",
            type: 'POST',
            data: {'trigger_type': 'country_rule'},
            success: function (data) {
                select_condition.append(data);
            }
        });
    } else if (val == 'day_of_week' || val == 'day_of_month') {
        select_name.append('<option value="{{trans('common.on')}}">{{trans('common.on')}}</option>');
        select_name.append('<option value="{{trans('common.not_on')}}">{{trans('common.not_on')}}</option>');
        if (val == 'day_of_week') {
            select_condition.append('<option value="{{trans('common.sunday')}}">{{trans('common.sunday')}}</option>');
            select_condition.append('<option value="{{trans('common.monday')}}">{{trans('common.monday')}}</option>');
            select_condition.append('<option value="{{trans('common.tuesday')}}">{{trans('common.tuesday')}}</option>');
            select_condition.append('<option value="{{trans('common.wednesday')}}">{{trans('common.wednesday')}}</option>');
            select_condition.append('<option value="{{trans('common.thursday')}}">{{trans('common.thursday')}}</option>');
            select_condition.append('<option value="{{trans('common.friday')}}">{{trans('common.friday')}}</option>');
            select_condition.append('<option value="{{trans('common.saturday')}}">{{trans('common.saturday')}}</option>');
        } else {
            $.ajax({
            url: "{{ URL::route('trigger.load.data') }}",
            type: 'POST',
            data: {'trigger_type': 'day_of_month_rule'},
            success: function (data) {
                select_condition.append(data);
            }
        });
        }
    } else if (val == 'time_range') {
        select_name.append('<option value="within">{{trans('common.within')}}</option>');
        select_name.append('<option value="not_within">{{trans('common.not_within')}}</option>');
    } else if (val == 'email_address') {
        select_name.append('<option value="contain">{{trans('segments.filter.contain')}}</option>');
        select_name.append('<option value="not_contain">{{trans('segments.filter.does_not')}}</option>');
        select_name.append('<option value="equal">{{trans('common.equals')}}</option>');
        select_name.append('<option value="not_equal">{{trans('common.does_not_equals')}}</option>');
    } else if (val == 'email_fomat' || val == 'confirmation_status') {
        select_name.append('<option value="{{trans('segments.filter.is')}}">{{trans('segments.filter.is')}}</option>');
        select_name.append('<option value="{{trans('segments.filter.is_not')}}">{{trans('segments.filter.is_not')}}</option>');
        if (val == 'email_fomat') {
            select_condition.append('<option value="{{trans('common.label.html')}}">{{trans('common.label.html')}}</option>');
            select_condition.append('<option value="{{trans('common.label.text')}}">{{trans('common.label.text')}}</option>');
        } else  {
            select_condition.append('<option value="{{trans('common.confirmed')}}">{{trans('common.confirmed')}}</option>');
            select_condition.append('<option value="{{trans('common.not_confirmed')}}">{{trans('common.not_confirmed')}}</option>');
        }
    } else if (val == 'custom_field_contain' || val == 'custom_field_not_contain' || val == 'custom_field_is_equal' || val == 'custom_field_not_equal') {
        $.ajax({
            url: "{{ URL::route('trigger.load.data') }}",
            type: 'POST',
            data: {'trigger_type': 'custom_variables'},
            success: function (data) {
                select_name.append(data);
                $('.popovers').popover({
                  trigger: 'hover'
                })
            }
        });
    }
}
$(function () {
$('.popovers').popover({
                  trigger: 'hover'
                });
});
$('body').on('click', "#campaigns_ids", function() {
    var campaigns_ids = $('input:checkbox:checked').map(function() {
        return this.value;
    }).get();
    $.ajax({
            url: "{{ URL::route('trigger.links') }}",
            type: 'POST',
            data: {ids: campaigns_ids},
            success: function(result) {
                $("#appendata").html(result);
            }
        });
});
$('body').on('click', "#trigger-campaign-custom", function() {
    $.ajax({
            url: "{{ URL::route('trigger.links') }}",
            type: 'POST',
            data: {type:'custom'},
            success: function(result) {
                $("#appendata").html(result);
            }
        });
});
$('body').on('click', "#trigger-campaign-global", function() {
    $.ajax({
            url: "{{ URL::route('trigger.links') }}",
            type: 'POST',
            data: {type:'global'},
            success: function(result) {
                $("#appendata").html(result);
            }
        });
});
function loadSuppressionData(action) {
    var token = $('#token').val();
    $.ajax({
        url: "{{ URL::route('trigger.load.data') }}",
        type: 'POST',
        data: {'trigger_type': action,'_token': token},
        success: function (data) {
            $('#trigger-suppression-data').html(data);
        }
    });
};
getSenderInformation('smtp');
</script>

<script>
    editor = CKEDITOR.replace( 'content_html', {
        fullPage: true,
        allowedContent: true,
        height: 320
    });

    // enter work as <br> instead <p>
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKFinder.setupCKEditor( editor );
  //  CKEDITOR.config.extraPlugins = 'imageuploader,preview,font,';
    CKEDITOR.config.extraPlugins = 'preview,font,smiley';
    
  //  config.uploadUrl = '/uploader/upload.php';


$(document).ready(function(){
    $('body').on('click', "input[name=\"segment_ids[]\"]", function() {
        $('input[name="segment_ids[]"]').not(this).prop('checked', false);
    });
});



</script>
<script src="/themes/default/js/jquery.dm-uploader.min.js" type="text/javascript"></script>
<script src="/themes/default/js/demo-ui.js?v=123" type="text/javascript"></script>
<script type="text/html" id="files-template">
    <li class="media">
        <div class="media-body mb-1">
            <input type="hidden" name="has_images[]" value="%%filename%%">
            <p class="mb-2">
                <strong class="filename">%%filename%%</strong>  <span class="text-muted">{{trans('broadcasts.waiting')}}</span>
            <div class="progress progress-striped mb-2">
                <div class="progress-bar progress-bar-success progress-bar-animated"
                     role="progressbar"
                     style="width: 0%"
                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            </p>
            <div class="la la-close font-red pull-right removeFile" data-file=""></div>
            <hr class="mt-1 mb-1" />
        </div>
    </li>
</script>
<script>
    $('#drag-and-drop-zone').dmUploader({ //
        url: '{{route('triggerUploadImages')}}?trigger_id='+$("#tid").val(),
        maxFileSize: 10000000, // 3 Megs
        onDragEnter: function(){
            // Happens when dragging something over the DnD area
            this.addClass('active');
        },
        onDragLeave: function(){
            // Happens when dragging something OUT of the DnD area
            this.removeClass('active');
        },
        onInit: function(){
            // Plugin is ready to use
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.penguin_initialized')}}:)', 'info');
        },
        onComplete: function(){
            // All files in the queue are processed (success or error)
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.all_pending_transfers_finished')}}');
        },
        onNewFile: function(id, file){
            // When a new file is added using the file selector or the DnD area
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.new_file_added')}} #' + id);
            ui_multi_add_file(id, file);
        },
        onBeforeUpload: function(id){
            // about tho start uploading a file
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.starting_the_upload_of')}} #' + id);
            ui_multi_update_file_status(id, 'uploading', '{{trans('broadcasts.add_new.form.drag_drop_zone.uploading')}}...');
            ui_multi_update_file_progress(id, 0, '', true);
        },
        onUploadCanceled: function(id) {
            // Happens when a file is directly canceled by the user.
            ui_multi_update_file_status(id, 'warning', '{{trans('broadcasts.add_new.form.drag_drop_zone.canceled_by_user')}}');
            ui_multi_update_file_progress(id, 0, 'warning', false);
        },
        onUploadProgress: function(id, percent){
            // Updating file progress
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data){
            // A file was successfully uploaded
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.server_response_for_file')}} #' + id + ': ' + JSON.stringify(data));
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.upload_of_file')}} #' + id + ' COMPLETED', 'success');
            ui_multi_update_file_status(id, 'success', '{{trans('broadcasts.add_new.form.drag_drop_zone.upload_complete')}}');
            ui_multi_update_file_progress(id, 100, 'success', false);
        },
        onUploadError: function(id, xhr, status, message){
            ui_multi_update_file_status(id, 'danger', message);
            ui_multi_update_file_progress(id, 0, 'danger', false);
        },
        onFallbackMode: function(){
            // When the browser doesn't support this plugin :(
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.plugin_cannot_be_used_here')}}', 'danger');
        },
        onFileSizeError: function(file){
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.file')}} \'' + file.name + '\' {{trans('broadcasts.add_new.form.drag_drop_zone.cannot_be_added')}}: {{trans('broadcasts.add_new.form.drag_drop_zone.add.size_excess_limit')}}', 'danger');
        }

    });
    $(document).on("click", ".removeFile", function() {
        var file_name = $(this).parent().children('p.mb-2').find('.filename').html();
        var list_block_id = $(this).parent().parent().attr('id');
        $.ajax({
            url: "{{ route('triggerImageDelete') }}",
            type: "POST",
            data:  {"file_name": file_name,'from':'temp'},
            success: function(result) {
                if(result=='success'){
                    $("#"+list_block_id).remove();
                    $("#imgMsg").append("<li> "+ file_name+" {{trans('broadcasts.message.successfully_moved')}} </li>");
                }

            }
        });
    });

    $(document).on("click", ".removeFile2", function() {
        var file_name = $(this).parent().children('p.mb-2').find('.filename').html();
        var list_block_id = $(this).parent().parent().attr('id');
        $.ajax({
            url: "{{ route('triggerImageDelete') }}",
            type: "POST",
            data: {"file_name": file_name, "from": $("#tid").val()},
            success: function(result) {
                if(result=='success'){
                    $("#"+list_block_id).remove();
                    $("#imgMsg").append("<li> "+ file_name+" {{trans('broadcasts.message.successfully_moved')}} </li>");
                    return false;
                }

            }
        });

    });

    $('body').on("click" , ".group-selector-subscriber2", function () {
        var group = this.id;
        //alert(group);
        if($(this).is(':checked')) {
            $('.group-subscriber-p-'+group).not(':disabled').prop('checked', true);
        } else {
            $('.group-subscriber-p-'+group).prop('checked', false);
        }
    });

    // $('body').on("click" , ".group-selector-subscriber2", function () {
    //     var group = this.id;
    //     //alert(group);
    //     // var disabled = $('.group-subscriber-'+group).hasClass("disabled");
    //     var cb = $('.group-subscriber-p-'+group).attr("disabled");
    //     // var disabled = cb.attr("disabled", !cb.prop('disabled'));
    //     if($(this).is(':checked')) {
    //         if(cb) {
    //             Command: toastr["error"]("All Lists Disabled!");
    //             $('.group-subscriber-p-'+group).prop('checked', false);
    //             $('.group-selector-subscriber2').prop('checked', false);
    //         } else {
    //             $('.group-subscriber-p-'+group).not(':disabled').prop('checked', true);
    //         }
    //         $('.group-subscriber-p-'+group).not(':disabled').prop('checked', true);
    //     } else {
    //         $('.group-subscriber-p-'+group).prop('checked', false);
    //     }
    // });
</script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="dcrJgeGb">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="ptlCCxoC">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="UEcFzfPT">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="WedaPEPX">
    <div class="col-md-6 create-form" data-name="gHYtrJZj">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="YniwaTUz">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="cAZEcpCN">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="ytaLAzeA">
                    <div class="kt-wizard-v4__nav-items" data-name="gITqIfOe">
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="sZRJmPij">
                                <div class="kt-wizard-v4__nav-number" data-name="EMpNCTeC">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="yoIPkuyc">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="BaruxsNj">
                                        {{trans('triggers.add_new.tab1.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="omvJuLBi">
                                        {{ trans('triggers.add_new.tab1.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="dpaWbuHj">
                                <div class="kt-wizard-v4__nav-number" data-name="UxJQUiXh">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="Logyivvd">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="QGjgtPob">
                                        {{trans('triggers.add_new.tab2.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="VlpuZhZX">
                                        {{ trans('triggers.add_new.tab2.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>    
                <div class="kt-portlet form" data-name="WLKgVUan">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="PHIIiZiE">
                        <div class="kt-grid" data-name="CyuDfNQL">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="WhOgajxb">
                                <!-- BEGIN FORM-->
                                @if ($page_data['action'] == 'add')
                                <form action="{{route('trigger.store')}}" class="kt-form kt-form--label-right" id="submit_form" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="action" value="add">
                                    <input type="hidden" id="tid" value="0">
                                    <input type="hidden" id="EditiorHTMLVal" name="EditiorHTMLVal" value="">
                                @else
                                <form action="/trigger/{{$trigger->id}}" method="POST" id="submit_form" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="edit">
                                    <input type="hidden" id="EditiorHTMLVal" name="EditiorHTMLVal" value="">
                                    <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" id="tid" value="{{$trigger->id}}">
                                    @if(isset($trigger->meta_attributes))
                                    <input type="hidden" id="meta-data" value="{{$trigger->meta_attributes}}">
                                    @endif
                                @endif
                                    <div class="form-wizard" id="form_wizard_1" data-name="dXyQBEjW">
                                        <div class="form-body" data-name="SQkOlWCs">
                                            <div class="tab-content" data-name="LGCKrzsp">
                                                <div class="alert alert-danger display-none" data-name="RUYiTsnj">
                                                    <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} </div>
                                                <div class="alert alert-success display-none" data-name="ptJoYpPW">
                                                    <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="meMcSehB">
                                                    <div class="kt-form__section kt-form__section--first" data-name="OByMJtdo">
                                                        <div class="kt-wizard-v4__form" data-name="nRUgWLEW">
                                                            <div class="form-group row" data-name="cpukMvhz">
                                                                <label class="col-form-label text-left">{{trans('triggers.add_new.tab1.form.status')}}
                                                                     <i class="fa fa-question-circle popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('triggers.add_new.tab1.form.status_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </label>
                                                                @if(!empty($trigger) && $trigger->status == 0)
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                    <label>
                                                                        <input type="checkbox" name="trigger_status" >
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                @else
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                    <label>
                                                                        <input type="checkbox" name="trigger_status" checked="">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                                @endif
                                                               
                                                            </div>
                                                            <div class="form-group row" data-name="dxxqYNdT">
                                                                    
                                                                <div class="col-md-12" data-name="fGaBHBpM">
                                                                    <label class="col-form-label">
                                                                      {{trans('triggers.add_new.tab1.form.name')}}
                                                                      <span class="required"> * </span>
                                                                      <i class="fa fa-question-circle popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('triggers.add_new.tab1.form.name_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                    </label>
                                                                    <input type="text" class="form-control" name="name" value="{{ isset($trigger->name) ? $trigger->name : '' }}" required />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" data-name="BJtmHBeh">
                                                                    
                                                                <div class="col-md-12" data-name="PECVEUVK">
                                                                    <label class="col-form-label">
                                                                        {{trans('triggers.add_new.tab1.form.event_criteria')}}
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="input-icon right" data-name="dIOcHjOK">
                                                                        <select class="form-control m-select2" name="trigger_type" id="trigger-type" required="required">
                                                                            <option value="">{{ trans('triggers.add_new.tab1.form.select_criteria') }}</option>
                                                                            <option value="add_sub_list" {{ (isset($meta_data['trigger_type']) && $meta_data['trigger_type'] == 'add_sub_list') ? 'selected' : '' }}> {{trans('triggers.add_new.tab1.form.event_criteria_option1')}}
                                                                            </option>
                                                                            @if($segmentAccess)
                                                                                <option value="add_sub_segment" {{ (!empty($meta_data['trigger_type']) && $meta_data['trigger_type'] == 'add_sub_segment') ? 'selected' : '' }}>
                                                                                    {{trans('triggers.add_new.tab1.form.event_criteria_option2')}}
                                                                                </option>
                                                                            @endif
                                                                            <option value="add_sub_custom"  {{ (!empty($meta_data['trigger_type']) && $meta_data['trigger_type'] == 'add_sub_custom') ? 'selected' : '' }}>
                                                                            {{trans('triggers.create_blade.select_field_value_change')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="trigger-type-data" data-name="JwZbEbmB"></div>

                                                            @include('campaign.customCriteria')

                                                            <div id="trigger-type-data-date" data-name="cmzYOABN"></div>
                                                            <div id="trigger-type-custom" data-name="jxwxmjxt">
                                                                <div class="slection1" data-name="CBgpoSmh">
                                                                    <div class="kt-radio-inline" data-name="phBYgAMT">
                                                                        <label class="kt-radio">
                                                                            <input type="radio"  value="any" name="field_custom" id="field_custom1"  {{ (!empty($meta_data['field_custom']) && $meta_data['field_custom'] == 'any') ? 'checked' : '' }}> {{trans('triggers.create_blade.any_field_span')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="kt-radio">
                                                                            <input type="radio"  value="selected" name="field_custom" id="field_custom2"  {{ (!empty($meta_data['field_custom']) && $meta_data['field_custom'] == 'selected') ? 'checked' : '' }}> {{trans('triggers.create_blade.selected_field_span')}} 
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" value="" id="custom_value1"> 
                                                                <input type="hidden" value="" id="custom_value2"> 
                                                                <div class="slection2" style="{{ (isset($meta_data['field_custom']) && $meta_data['field_custom'] == 'any') ? 'display:block;' : '' }}" data-name="fXAaobEu">
                                                                    <div class="kt-radio-inline" data-name="EHnuwIHk">
                                                                        <label class="kt-radio">
                                                                            <input type="radio"  value="any_value" name="values_custom" id="values_custom1" {{ (!empty($meta_data['values_custom']) && $meta_data['values_custom'] == 'any_value') ? 'checked' : '' }}> {{trans('triggers.create_blade.changed_any_value_span')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="kt-radio">
                                                                            <input type="radio" value="this_value" name="values_custom" id="values_custom2" {{ (!empty($meta_data['values_custom']) && $meta_data['values_custom'] == 'this_value') ? 'checked' : '' }}> {{trans('triggers.create_blade.changed_this_value_span')}}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="slection3" style="{{ (isset($meta_data['values_custom']) && $meta_data['values_custom'] == 'this_value' && $meta_data['field_custom'] == 'any') ? 'display:block;' : '' }}" data-name="iYCZhuQt">
                                                                    <div class="form-group" data-name="VGJaLNYr">
                                                                        <input type="text" class="form-control" name="field_text1" value="{{ (isset($meta_data['field_text1'])) ? $meta_data['field_text1'] : '' }}" placeholder="Value" />
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                    if(Auth::user()->is_client==0)
                                                                    {
                                                                        $custom_fields = DB::table("custom_fields")->select('custom_fields.id','custom_fields.name', 'custom_fields.is_default', 'custom_fields.field_order','custom_fields.type','custom_fields.created_at')->join('users as usr','usr.id','custom_fields.user_id')->where('usr.is_client',0)->get();
                                                                    }else{
                                                                    $custom_fields = DB::table("custom_fields")->where("is_default" , 1)->orWhere("user_id", Auth::user()->id)->get();
                                                                    }
                                                                ?>
                                                                <div class="slection4" style="{{ (isset($meta_data['field_custom']) && $meta_data['field_custom'] == 'selected') ? 'display:block;' : '' }}" data-name="FfvoGiLs"> 
                                                                    <div class="form-group" data-name="PCLakiFv">
                                                                        <select class="form-control m-select2" name="custom_fields" id="custom_fields" data-placeholder="Select a Field">
                                                                            <option value="">{{trans('triggers.create_blade.select_field_option')}}</option>
                                                                            @foreach($custom_fields as $custom)
                                                                                <option {{ (isset($meta_data['custom_fields']) && $meta_data['custom_fields'] == $custom->id) ? 'selected' : '' }} value="{{$custom->id}}">{{$custom->name}}</option>
                                                                            @endforeach
                                                                           
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="slection5" style="{{ (isset($meta_data['field_custom']) && $meta_data['field_custom'] == 'selected') ? 'display:block;' : '' }}" data-name="MvofRbud">
                                                                    <div class="kt-radio-inline" data-name="hXyNyTJY">
                                                                        <label class="kt-radio">
                                                                            <input type="radio"   value="any_value" name="values_custom2" id="values_custom11" {{ (!empty($meta_data['values_custom2']) && $meta_data['values_custom2'] == 'any_value') ? 'checked' : '' }}> {{trans('triggers.create_blade.changed_any_value_span')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <label class="kt-radio">
                                                                            <input type="radio"   value="this_value" name="values_custom2" id="values_custom22" {{ (!empty($meta_data['values_custom2']) && $meta_data['values_custom2'] == 'this_value') ? 'checked' : '' }}> {{trans('triggers.create_blade.changed_this_value_span')}}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                <div class="slection6" style="{{ (!empty($meta_data['values_custom2']) && $meta_data['values_custom2'] == 'this_value' && $meta_data['field_custom'] == 'selected') ? 'display:block;' : '' }}" data-name="kdrdaaUS">

                                                                    <div class="form-group" data-name="CCjJwUaS">
                                                                        <input type="text" class="form-control" name="field_text2" placeholder="Value" value="{{ (isset($meta_data['field_text2'])) ? $meta_data['field_text2'] : '' }}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="UYhaqIeM">
                                                    <div class="kt-form__section kt-form__section--first" data-name="qjjrqXoJ">
                                                        <div class="kt-wizard-v4__form" data-name="HyNDGlfk">
                                                            <div class="form-group row" data-name="VbaMaYIC">

                                                                <div class="col-md-12" data-name="DPdnhVYc">
                                                                    <label>
                                                                    {{trans('triggers.add_new.tab2.form.when_to_execute')}}
                                                                             {!! popover( 'triggers.add_new.tab2.form.when_to_execute_help','common.description' ) !!}
                                                                </label>
                                                                    <div class="input-icon right" data-name="ekLTPvoH">
                                                                        <select class="form-control m-select2" name="perform_action_event" id="perform-action-event">
                                                                            <option value="on_event" {{ (isset($meta_data['perform_action_event']) && $meta_data['perform_action_event'] == 'on_event') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.tab2.form.instantly')}}
                                                                            </option>
                                                                            <option value="after" {{ (isset($meta_data['perform_action_event']) && $meta_data['perform_action_event'] == 'after') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.tab2.form.after_the_event')}}
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" data-name="QdHkUXTZ" id="durationDB" style="display: {{ (isset($meta_data['perform_action_event']) && $meta_data['perform_action_event'] == 'after') ? 'flex' : 'none' }};">
                                                                <div class="col-md-6" data-name="cdEZpvDg">
                                                                    <div class="input-icon right" data-name="GdNJvgar">
                                                                        <input class="form-control" name="perform_action_datetime_count" id="perform-action-datetime-count" value="{{ isset($meta_data['perform_action_datetime_count']) ? $meta_data['perform_action_datetime_count'] : '' }}" disabled="" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6" data-name="VnPBVmVi">
                                                                    <div class="input-icon right" data-name="WCEvVARK">
                                                                        <select class="form-control m-select2" name="perform_action_datetime_frequency" id="perform-action-datetime-frequency" disabled="">
                                                                            <option value="minutes" {{ (isset($meta_data['perform_action_datetime_frequency']) && $meta_data['perform_action_datetime_frequency'] == 'hours') ? 'selected' : '' }}>{{trans('common.minutes')}}</option>
                                                                            <option value="hours" {{ (isset($meta_data['perform_action_datetime_frequency']) && $meta_data['perform_action_datetime_frequency'] == 'hours') ? 'selected' : '' }}>{{trans('common.hours')}}</option>
                                                                            <option value="days" {{ (isset($meta_data['perform_action_datetime_frequency']) && $meta_data['perform_action_datetime_frequency'] == 'days') ? 'selected' : '' }}>{{trans('common.days')}}</option>
                                                                            <option value="weeks" {{ (isset($meta_data['perform_action_datetime_frequency']) && $meta_data['perform_action_datetime_frequency'] == 'weeks') ? 'selected' : '' }}>{{trans('common.weeks')}}</option>
                                                                            <option value="months" {{ (isset($meta_data['perform_action_datetime_frequency']) && $meta_data['perform_action_datetime_frequency'] == 'months') ? 'selected' : '' }}>{{trans('common.months')}}</option>
                                                                            <option value="years" {{ (isset($meta_data['perform_action_datetime_frequency']) && $meta_data['perform_action_datetime_frequency'] == 'years') ? 'selected' : '' }}>{{trans('common.years')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="frequency-row" data-name="awZKGUWD">
                                                                    
                                                                <div class="col-md-12" data-name="swKgruHB">
                                                                    <label class="col-form-label">
                                                                        {{trans('triggers.add_new.frequency.title')}}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="PlrgAQUE">
                                                                        <select class="form-control m-select2" name="perform_action_interval" id="perform_action_interval">
                                                                            <option value="on_date" id="on-date" {{ (isset($meta_data['perform_action_interval']) && $meta_data['perform_action_interval'] == 'on_date') ? 'selected' : '' }}>{{trans('triggers.add_new.frequency.values.run_once')}} </option>
                                                                            <option value="next_anniversary" {{ (isset($meta_data['perform_action_interval']) && $meta_data['perform_action_interval'] == 'next_anniversary') ? 'selected' : '' }}>{{trans('triggers.add_new.frequency.values.repeat_every_month')}}</option>
                                                                            <option value="each_anniversary" {{ (isset($meta_data['perform_action_interval']) && $meta_data['perform_action_interval'] == 'each_anniversary') ? 'selected' : '' }}>{{trans('triggers.add_new.frequency.values.repeat_every_year')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                                               
                                                            <div class="form-group row" data-name="lCLLGkpA">
                                                                <div class="col-md-12" data-name="iVVnfHlt">
                                                                    <label class="col-form-label">{{trans('triggers.add_new.action_to_perform.title')}}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="lJnTgHBt">
                                                                        @if ($page_data['action'] == 'edit')
                                                                        <input type="hidden" name="trigger_action" value="{{ isset($meta_data['trigger_action']) ? $meta_data['trigger_action'] : '' }}">
                                                                        @endif
                                                                        <select required="required" class="form-control m-select2"  @if ($page_data['action'] == 'edit')  disabled="disabled"  @endif name="trigger_action" id="trigger-action" {{ isset($meta_data['trigger_action']) ? '' : '' }}>
                                                                            <option value="">{{trans('common.label.select_option')}}</option>
                                                                            @if(routeAccess('broadcast.schedule.create'))
                                                                            <option value="send_mail" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'send_mail') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.action_to_perform.send_broadcast')}}
                                                                                @endif
                                                                            </option>
                                                                            <option value="send_notification" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'send_notification') ? 'selected' : '' }}>
                                                                            {{trans('triggers.add_new.action_to_perform.send_notification_email')}}
                                                                            </option>
                                                                                @if(routeAccess('start_drip_campaigns'))
                                                                            <option value="start_autoresponder" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'start_autoresponder') ? 'selected' : '' }}>
                                                                            {{trans('triggers.add_new.action_to_perform.start_drip_group')}}
                                                                            </option>
                                                                                @endif
                                                                            {{--<option value="stop_autoresponder" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'stop_autoresponder') ? 'selected' : '' }}>
                                                                            {{trans('triggers.add_new.action_to_perform.stop_drip_group')}}
                                                                            </option>--}}
                                                                            @if(routeAccess('contact.edit'))
                                                                            <option value="sub_status" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'sub_status') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.action_to_perform.change_subscriber_status')}}
                                                                            </option>
                                                                            <option value="sub_format" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'sub_format') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.action_to_perform.change_subscriber_format')}}
                                                                            </option>
                                                                            {{--<option value="sub_validation" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'sub_validation') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.action_to_perform.change_subscriber_validation_status')}}
                                                                            </option>--}}
                                                                            <option value="update_filed" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'update_filed') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.action_to_perform.update_field_value')}}
                                                                            </option>
                                                                            <option value="move_contacts" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'move_contacts') ? 'selected' : '' }}>
                                                                               {{trans('triggers.add_new.action_to_perform.move_subscriber')}}
                                                                            </option>
                                                                                @endif
                                                                                @if(routeAccess('contact.create'))
                                                                            <option value="copy_contacts" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'copy_contacts') ? 'selected' : '' }}>
                                                                            {{trans('triggers.add_new.action_to_perform.copy_subscriber')}}
                                                                            </option>
                                                                                @endif
                                                                             
                                                                            @if(routeAccess('contact.destroy'))
                                                                            <option value="remove_contacts" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'remove_contacts') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.action_to_perform.remove_subscriber')}}
                                                                            </option>
                                                                            @endif
                                                                            @if(routeAccess('suppression-email.store'))
                                                                            <option value="suppression" {{ (isset($meta_data['trigger_action']) && $meta_data['trigger_action'] == 'suppression') ? 'selected' : '' }}>
                                                                                {{trans('triggers.add_new.action_to_perform.add_to_suppresion')}}
                                                                            </option>
                                                                                @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.triggers.add.action.help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                            </div>
                                                            <!-- display only when action is send_notification -->
                                                            <div class="form-group row text-editor-ck" data-name="XsfxQZLg">
                                                                    
                                                                <div class="col-md-12" data-name="uwOLgkHO">
                                                                    <label class="col-form-label">
                                                                        {{trans('triggers.add_new.tab2.form.to_email')}}
                                                                    </label>
                                                                    @php
                                                                        $to_email = getAuthUser()->email;
                                                                    @endphp
                                                                    <input class="form-control" type="email" value="{{ isset($meta_data['to_email']) ? $meta_data['to_email'] : $to_email }}" id="to_email" name="to_email"> 
                                                                </div>
                                                            </div>
                                                            <div class="form-group row text-editor-ck" data-name="IeFmMcls">
                                                                    
                                                                <div class="col-md-12" data-name="jpmhJAsm">
                                                                    <label class="col-form-label">
                                                                        {{trans('triggers.add_new.tab2.form.subject')}}
                                                                    </label>
                                                                    <input class="form-control" type="text" value="{{ isset($meta_data['subject']) ? $meta_data['subject'] : '' }}" id="subject" name="subject"> 
                                                                </div>
                                                            </div>
                                                            <div class="form-group row text-editor-ck" data-name="zJkJblma">
                                                                <div class="col-md-12" data-name="cTHNYwyR">
                                                                    <textarea id="content_html" name="content_html">{{ isset($meta_data['content_html']) ? $meta_data['content_html'] : '' }}</textarea>
                                                                </div>
                                                            </div>
                                                            <!-- dynamic tags start -->
                                                            <div class="dtags" data-name="iqMKatTP">
                                                                @php
                                                                    $ckeditor_id = 'content_html';
                                                                @endphp
                                                                {{ dynamicTags2($ckeditor_id , true) }}
                                                            </div>
                                                            <!-- dynamic tags end -->
                                                            <div id="trigger-action-div" data-name="zEmEEruw"></div>
                                                            <div id="DragNDrop" class="form-group row" data-name="ddBCWtfQ" style="display: none;">

                                                                <div class="col-md-12"  data-repeater-list="files" data-name="DFLOgdHW">
                                                                    <label class="col-form-label">{{trans('broadcasts.add_new.form.attach_file')}}
                                                                        {!! popover( 'broadcasts.add_new.form.attach_file_help','common.description' ) !!}
                                                                    </label>
                                                                    <div id="drag-and-drop-zone" class="dm-uploader mt-repeater" data-name="kCIZQUZU">
                                                                        <div data-repeater-item data-name="QRUCodsP">
                                                                            <div data-repeater-item="" class="mt-repeater-item" data-name="KgPtMYMa">
                                                                                <div class="row mt-repeater-row" data-name="xhoCIHHo">

                                                                                    <div class="btn btn-block fonttest" data-name="YvaAszjs">
                                                                                        <i class="la la-cloud-upload" aria-hidden="true"></i>
                                                                                        {{trans('broadcasts.add_new.form.drop_or_browse_file_here')}}
                                                                                        <input type="file" title='Click to add Files' />
                                                                                    </div>
                                                                                    @if (isset($files_count) && $files_count==0)
                                                                                        <ul class="list-unstyled p-2 flex-column col" id="files">
                                                                                            <li class="text-muted text-center empty">{{trans('common.message.no_files_uploaded')}}</li>
                                                                                        </ul>
                                                                                    @else
                                                                                        <ul class="list-unstyled p-2 flex-column col" id="files">
                                                                                            @for($i = 0; $i < $files_count; $i++)
                                                                                                <li class="media" id='old_attachment_{{ $i }}'>
                                                                                                    <div class="media-body mb-1" data-name="MSRtwpRx">
                                                                                                        <p class="mb-2">
                                                                                                            <strong class="filename">{{ $attached_files[$i]['basename'] }}</strong>
                                                                                                        <div class="progress progress-striped" data-name="BjZgWPhQ">
                                                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" data-name="jnoUSnZH">100%</div>
                                                                                                        </div>
                                                                                                        </p>
                                                                                                        <div class="la la-close font-red pull-right removeFile2" data-name="zpEoPjnv"></div>
                                                                                                        <hr class="mt-1 mb-1" />
                                                                                                    </div>
                                                                                                </li>
                                                                                            @endfor
                                                                                        </ul>
                                                                                    @endif
                                                                                    <ul id="imgMsg"></ul>

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
                                        <div class="kt-form__actions" data-name="xGwGYmvS">
                                            <div class="btn btn-secondary btn-md" data-ktwizard-type="action-prev" data-name="ZOLPfMbq">
                                                {{trans('common.form.buttons.back')}}
                                            </div>
                                            <div class="btn btn-success btn-md" data-ktwizard-type="action-submit" data-name="uCeXXFkD">
                                                {{trans('common.form.buttons.submit')}}
                                            </div>
                                            <div class="btn btn-success btn-md" data-ktwizard-type="action-next" data-name="atAnJDHD">
                                                {{trans('common.form.buttons.continue')}}
                                            </div>

                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
@section('dashboard_scripts')

@endsection