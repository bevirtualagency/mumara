@extends('layouts.master2')
@php
$splitAccess = routeAccess('schedule_split_test') && moduleCheck('split_tests');
$segmentAccess = !empty($segmentAccess) && $segmentAccess ? $segmentAccess = routeAccess('schedule_broadcast_to_segment'):false;
@endphp
@section('title', $page_data['title'])
<?php 
    $threadFlag = false;
    $totalThreads = maxThreads();
    if(!empty($totalThreads) and $totalThreads > 1) { 
        $threadFlag = true;
    } 

    $evergreenC = 0; 
    $evergreenLimit = 1; 

    if(!empty($_GET["evergreen"])) $evergreenC = $_GET["evergreen"]; 

    if(!Auth::user()->is_staff) {
        $user_package = DB::table("packages")->where("id" , Auth::user()->package_id)->first();
        $evergreen_count = DB::table("evergreen_campaigns")->where("user_id", Auth::user()->id)->count();
        if(!empty($user_package) && $user_package->evergreen_campaigns != -1 and  $evergreen_count  >= $user_package->evergreen_campaigns ) { 
            $evergreenLimit = 0;
        } 
    } 

    $license_attributes = json_decode(getSetting("license_attributes"), true);
    $license_type = "";
    if(!empty($license_attributes["package"])) { 
        $license_type = $license_attributes["package"];
    }
?>
@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css?v=0.1" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="/themes/default/css/bootstrap-datetimepicker.css">
<link rel="stylesheet" type="text/css" href="/themes/default/css/bootstrap-timepicker.css">
<link href="/resources/assets/css/schedule-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
    #from_email_part1-error {
       position: absolute;
        margin-top: 40px;
        z-index: 2;
    }
    .scroll.scroll-200.bt0 {
        min-height: 200px;
    }
    .pl18 {padding-left:18px;}
    .kt-checkbox-list.list-disabled a.fix-now {
        pointer-events: all;
    }
</style>
<script>
    var custom_sections = 0;
</script>
@endsection
 <?php
  
    $haveSmpts = 0;
    $haveBroadCast = 0;
    $haveSegemnt = 0;
    $haveList = 0;
    $sending_node_p = true; 
    $form_list_p = true; 
    $custom_p = true;
    $sending_options = array();

    $sender_option = $campaign_data["sender_option"];

    if(!empty( $sender_option)) { 
        if( $sender_option == "smtp") { 
            $option="smtp";
        }
        if( $sender_option == "custom") { 
            $option="custom";
        }
        if( $sender_option == "list") { 
            $option="list";
        }
    } else { 
        if(!empty($package)) { 
            $sending_options = json_decode($package->sending_options, true);
        }
       
        if(!empty($sending_options) and empty($sending_options["sending_node"])) { 
            $sending_node_p = false;
        }
        if(!empty($sending_options) and empty($sending_options["form_list"])) { 
            $form_list_p = false;
        }
        if(!empty($sending_options) and empty($sending_options["custom"])) { 
            $custom_p = false;
        }

        if($sending_node_p) { 
            $campaign_data['sender_option']  = "smtp";
            $option="smtp";
        } else if($form_list_p) { 
            $campaign_data['sender_option']  = "list";
             $option="list";
        } else { 
            $campaign_data['sender_option']  = "custom";
             $option="custom";
        }

    }
   
   

    if(empty($campaign_data["name"])) { 
        $sending_info_options = getSetting("sending_info_options");
        $campaign_data['sender_option']  = "smtp";
        $option="smtp";
        if($sending_info_options == "contact_list") { 
            $campaign_data['sender_option']  = "list";
            $option="list";
        }
        if($sending_info_options == "custom") { 
            $campaign_data['sender_option']  = "custom";
            $option="custom";
        }
    } 

    $imap_switch = getApplicationSettings('imap_switch');

    if($imap_switch == 2) { 
        $sending_node_p = false;
    }
  

    
?>
@section('page_scripts')

@include('campaign.customCriteriaScript')

<script src="/themes/default/js/includes/schedule.js?id=1223" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/timepicker-init.js" type="text/javascript"></script>
<script type="text/javascript">
    var KTBootstrapTimepicker = function () {
        var demos = function () {
            $('#kt_timepicker_1').timepicker({
                minuteStep: 1,
                showSeconds: true,
                showMeridian: false,
                snapToStep: true
            });
        }
        return {
            // public functions
            init: function() {
                demos(); 
            }
        };
    }();
    jQuery(document).ready(function() {
        KTBootstrapTimepicker.init();
    });
    
</script>

<script>
    var no_sending_node_msg = "{{ trans('schedule_broadcast.add_new.tab3.form.no_sending_no_select') }}";
    var no_campaign_msg = "{{ trans('schedule_broadcast.add_new.tab3.form.no_campaign_select') }}";
    var no_segment_msg = "{{ trans('schedule_broadcast.add_new.tab3.form.no_segemnt_select') }}";
    var no_spli_test_msg = "{{ trans('schedule_broadcast.add_new.tab1.form.select_split_test') }}";
    var no_list_msg = "{{ trans('schedule_broadcast.add_new.tab1.form.no_list_select') }}";
            @if($lists_count > 0)
                   var lists_arr = [];
                   var split_arr = [];
                @foreach ($list_tree as $group_metadata)
                    @foreach ($group_metadata['children'] as $list_metadata)
                    lists_arr.push({"id":"{{$list_metadata['id']}}","name":"{{strtoupper($list_metadata['name'])}}"});
                    split_arr.push({"id":"{{$list_metadata['id']}}","name":"{{strtoupper($list_metadata['name'])}}"});
                    @endforeach
                @endforeach
            @endif

            @if($segmentAccess)
                var segment_arr = [];
                <?php
                $i=0;
                ?>
            @foreach($segments as $segment)
                segment_arr.push({"id":"{{$segment->id}}","name":"{{strtoupper($segment->name)}}"});
                <?php
                $i++;
                ?>
            @endforeach
            @endif

        $("#contactList").keyup(function(){
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
    $("#segmentList").keyup(function(){
        str = $('#segmentList').val().toUpperCase();
        if(str.length>0)
        {
            for (variable in segment_arr)
            {
                name = segment_arr[variable].name;
                id = segment_arr[variable].id;
                exists = name.indexOf(str) > -1;
                // console.log(exists);
                if(!exists)
                    $('#seg_'+id).slideUp();
                else
                    $('#seg_'+id).slideDown();
            }
        }
        else{
            for (variable in lists_arr)
            {
                id = (lists_arr[variable].id);
                $('#seg_'+id).slideDown();
            }
        }
    });
            var broadcast_arr = [];
            @foreach ($campaign_tree as $group_metadata)
            @foreach ($group_metadata['children'] as $campaign_metadata)
            <?php 
                    $name = str_replace('"' , '\"' , $campaign_metadata['name']);
            ?>
            broadcast_arr.push({"id":"{{$campaign_metadata['id']}}","name":"{!!strtoupper($name)!!}"});
            @endforeach
            @endforeach
            $("#searchBroadcast").keyup(function(){
                str = $('#searchBroadcast').val().toUpperCase();
                if(str.length>0)
                {
                    for (variable in broadcast_arr)
                    {
                        name = broadcast_arr[variable].name;
                        id = broadcast_arr[variable].id;
                        exists = name.indexOf(str) > -1;
                        if(!exists)
                            $('#br_'+id).slideUp();
                        else
                            $('#br_'+id).slideDown();
                    }
                }
                else{
                    for (variable in broadcast_arr)
                    {
                        id = broadcast_arr[variable].id;
                        $('#br_'+id).slideDown();
                    }
                }
            });
            var nodes_arr = []
            @foreach ($smtp_tree as $group_metadata)
            @foreach ($group_metadata['children'] as $smtp_metadata)
            nodes_arr.push({"id":"{{$smtp_metadata['id']}}","name":"{{strtoupper($smtp_metadata['name'])}}"});
            @endforeach
            @endforeach
            $("#searchSmtps").keyup(function(){
                str = $('#searchSmtps').val().toUpperCase();
                if(str.length>0)
                {
                    i = 0;
                    for (variable in nodes_arr)
                    {
                        name = nodes_arr[variable].name;
                        id = nodes_arr[variable].id;
                        exists = name.indexOf(str) > -1;
                        if(!exists)
                            $('#sm_' + id).slideUp();
                        else
                            $('#sm_' + id).slideDown();
                    }

                }
                else{
                    for (variable in nodes_arr)
                    {
                        id = nodes_arr[variable].id;
                        $('#sm_'+id).slideDown();
                    }
                }
            });

            $("#searchList").keyup(function(){
                str2 = $('#searchList').val().toUpperCase();
                if(str2.length>0)
                {
                    i = 0;
                    for (variable in split_arr)
                    {
                        name = split_arr[variable].name;
                        id = split_arr[variable].id;
                        exists2 = name.indexOf(str2) > -1;
                        if(!exists2) {
                            $('#fgmg_' + id).slideUp();
                            $('#fgmg_' + id).hide();
                        } else {
                            $('#fgmg_' + id).slideDown();
                            $('#fgmg_' + id).show();
                        }
                    }

                }
                else{
                    for (variable in split_arr)
                    {
                        id = split_arr[variable].id;
                        $('#fgmg_'+id).slideDown();
                    }
                }
            });
    var segment_count_start = 0;
    var segments_ids = [];
    ///var all_segments = [];
    
    function getSegmentCountStatus(status,segments_ids){
        
        $.ajax({
            url: "{{ route('recount.all.segemnts') }}",
            type: "POST",
            data: {'segments_ids': segments_ids,'status':status},
            cache: false,
            dataType: 'json',
            success: function(data) {
                if(data.status=='counting_is_completed'){
                    $.each(data.segemnts_counts, function( key, value ) {
                        $("#chk_"+key).html("("+value+")");
                    });
                    $(".countsload").hide();
                    $(".counts").show();
                    $("a.button-next").removeAttr("disabled", "disabled");                    
                    $("#counting").attr('disabled',false);
                    segment_count_start= 0;
                }else{
                    segment_count_start= 1;
                }

            }
        });
    }  


    $(document).on('change','#overwrite_subject',function(){
       if($(this).is(':checked')){
            $('#subject_field').slideDown();
        }else{
            $('#subject_field').slideUp();
        } 
    });
    $('#overwrite_subject').change();
    function previewScheduleEmail(){
         $(".blockUI").show();
         $('#mail-sent-msg').html('').hide();
        $.ajax({
            url: "{{ route('previewScheduleEmail') }}",
            type: "POST",
            data: $('#submit_form').serialize(),
            cache: false,
            dataType: 'json',
            success: function(data) {
                 $(".blockUI").hide();
            if(data.status==1){
                $('#mail-sent-msg').css('color','green').html(data.text).show();
            }else{
                $('#mail-sent-msg').css('color','red').html(data.text).show();

            }

            },
            error: function(data) {
                 $(".blockUI").hide();
            }
        });
    }
    
    
    $(document).ready(function() {

        $("#clist").click(function() {
            var checked = $(this).is(":checked");
            if(checked == true) {
                $('input.campaigns').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                $('input.campaigns:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
            } else {
                $('input.campaigns').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
            }
        });

        $("#clist2").click(function() {
            var checked = $(this).is(":checked");
            if(checked == true) {
                $('input.campaign_lists').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                $('input.campaign_lists:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                $('input.group-selector-campaign').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                $('input.group-selector-campaign:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                $('input.checkbox-all-index').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                $('input.checkbox-all-index:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
            } else {
                $('input.campaign_lists').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                $('input.group-selector-campaign').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                $('input.checkbox-all-index').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
            }
        });
        
        $("#clist3").click(function() {
            var checked = $(this).is(":checked");
            if(checked == true) {
                $('input.checkbox-index-sender').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                $('input.checkbox-index-sender:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                $('input.checkbox-all-index-sender').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                $('input.checkbox-all-index-sender:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
            } else {
                $('input.checkbox-index-sender').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                $('input.checkbox-all-index-sender').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
            }
        });

        $("#clist4").click(function() {
            var checked = $(this).is(":checked");
            if(checked == true) {
                $('input.group-selector-subscriber2').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                $('input.group-selector-subscriber2:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                $('input.group-subscriber2').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                $('input.group-subscriber2:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                // $('input.checkbox-all-index').parent(".kt-checkbox").parent(".kt-checkbox-list").hide();
                // $('input.checkbox-all-index:checked').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
            } else {
                $('input.group-selector-subscriber2').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                $('input.group-subscriber2').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
                // $('input.checkbox-all-index').parent(".kt-checkbox").parent(".kt-checkbox-list").show();
            }
        });
        
        $('body').on('keypress','#from_email_part1', function() {
            $(this).val($(this).val().replace(/[^a-z0-9--._]/gi, ''));
        });
        $('body').on('focusout','#from_email_part1', function() {
            $(this).val($(this).val().replace(/[^a-z0-9--._]/gi, ''));
        });
        
        <?php  if(!empty($campaign_data['unsubscribe_header']) and $campaign_data['unsubscribe_header'] == 1) {  ?>
            $(".listUnsubscribe").show();
        <?php } else { ?>
            $(".listUnsubscribe").hide();
            $("#unsubscribe_header_row").hide();
       <?php  } ?>
        <?php  if(!empty($custom_info['unsubscribe_by_email'])) {  ?>
            $("#unsubscribe_header_row").show();
        <?php } else { ?>
            $("#unsubscribe_header_row").hide();
       <?php  } ?>
       
        $("#unsubscribe_by_email").click(function() {
            if($("#unsubscribe_by_email").is(":checked") == true) {
                $("#unsubscribe_header_row").slideDown();
            } else {
                $("#unsubscribe_header_row").slideUp();
            }
        });
      
        $("#unsubscribe_header").click(function() {
            if($("#unsubscribe_header").is(":checked") == true) {
                $(".listUnsubscribe").slideDown();
                if($("#unsubscribe_by_email").is(":checked") == true) {
                    $("#unsubscribe_header_row").slideDown();
                }
            } else {
                $(".listUnsubscribe").slideUp();
                $("#unsubscribe_header_row").slideUp();
            }

        });
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Actions/Schedule-a-Broadcast");
        

        $("#from_name_smtp").click(function() {
            $("#from_name").slideToggle();
            $("#from-name").val('');
        });
        $("#from_name_list").click(function() {
            $("#from_name").slideToggle();
            $("#from-name").val('');
        });
        

        $("#send-later").click(function() {
            $(".sendign-time").show();
        });
        $("#send-now").click(function() {
            $(".sendign-time").hide();
        });

        $(".m-select2").select2({
            placeholder: 'Select Option',
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });

        $('#sending_time').timepicker({
            minuteStep: 5,
            showSeconds: false,
            showMeridian: false,
            snapToStep: true
        });
        $('#send_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: new Date()
        }).datepicker("setDate",'now');

        setInterval(function () {
            if (segment_count_start == 1) {
                getSegmentCountStatus('get_status',segments_ids);
            }
        }, 5000);
        $("#counting").click(function() {
            $.each($("input[name='segment_ids[]']"), function(){            
                segments_ids.push($(this).val());
            });
            if(segments_ids.length>0){
                $(".countsload").css("display", "inline-block");
                $(".counts").hide();
                $("a.button-next").attr("disabled", "disabled");
                $("#counting").attr('disabled',true);
                getSegmentCountStatus('count_status',segments_ids);
                
            }
        });
       

        <?php if(isset($campaign_data['type']) && $campaign_data['type'] == 'split_test') { ?>
            $("div.desc").hide();
            $("#split_test").show();
            $("#campaign_type_remaining").hide();
            $("#type").attr("disabled","disabled");
            $("#split-test-check").val(list_campaign); 
            $("#campaigns-tab2").hide();
            $("#lists-tab2").show();
        <?php } ?>
    
    });

    <?php 
        if($evergreenC == 1) {
    ?>
    $(function() {
        $('#campaign_type').val("evergreen");
        getSegmentList();
    });
       
    <?php } ?>
  
   
       
    function getListSegmentSplittestArea(section)
    {
        $("div.desc").hide();
        $("#"+section).show();
        if(section == "segment"){
            $("#si_list").attr("disabled", "disabled");
            $("#si_list").hide();
            $("#si_list_label").hide();
            $("#customCriterea").hide();            
        }else{
            $("#si_list").removeAttr("disabled");
            $("#si_list").show();
            $("#customCriterea").show(); 
            
        }
    }

    function getSegmentList()
    {
        //split_test
        var section = $('#campaign_type').val();
        $(".mb0").show(); 
        if(section == 'split_test'){
            $("div.desc").hide();
            $("#"+section).show();
            $("#campaign_type_remaining").hide();
            $("#type").attr("disabled","disabled");  

            $("#customCriterea").hide();
            $('.campaigns').prop('checked', false);            
        }else if(section == 'evergreen'){
            $("#evergreen-campaign").show();
            $("#campaign_type_remaining").hide();
            $("#type").attr("disabled","disabled");     
            $(".mb0").hide();       
            $("#customCriterea").show(); 
            $("#split_test").hide();
            $("#subscriber").show();
            $('.split_type').prop('checked', false);
        }else{
            $("#evergreen-campaign").hide();
            var section = 'regular';
            $("#"+section).hide();
            $("#split_test").hide();
            $("#subscriber").show();
            $("#campaign_type_remaining").show();

            $("#type").removeAttr("disabled");
            $("#from_option_list").show();
            
            if($('#type').is(":checked")){
                //$('#is_custom_criteria').prop('checked', true);          
                $("#customCriterea").show(); 
            }else{
                //$('#is_custom_criteria').prop('checked', false);          
                $("#customCriterea").hide(); 
            }           
              
            $('.split_type').prop('checked', false);

        }
    }

  
    function getMaskedDomainArea(section)
    {
        if (section == 'custom') {
            $("#masked-domains-area").show();
        } else {
            $("#masked-domains-area").hide();
        }
    }
    function sendingPattern(pattern) {
        if (pattern == 'batch') {
            $("#sending_pattern").show();
        } else {
            $("#sending_pattern").hide();
        }
    }
    function getSenderInformation(value)
    {
        if (value == 'list') {
            if ( $("#from-name").val()) {
                $("#from_name_list").prop('checked', true);
                $('#from_name').show();
            }else{
                $("#from_name_list").prop('checked', false);
                $('#from_name').hide();
            }
            $('#from_option_list').show();
            $('#from_option_smtp').hide();
            $('#from_option_custom').hide();
        } else if (value == 'smtp') {
            if ( $("#from-name").val()) {
                $("#from_name_smtp").prop('checked', true);
                $('#from_name').show();
            }else{
                $("#from_name_smtp").prop('checked', false);
                $('#from_name').hide();
            }
            $('#from_option_list').hide();
            $('#from_option_smtp').show();
            $('#from_option_custom').hide();
        } else {
            $('#from_name').show();
            $('#from_option_custom').show();
            $('#from_option_list').hide();
            $('#from_option_smtp').hide();
        }
        $('#from-name-list').val('N');
        $('#from-name-smtp').val('N');
        $('#from-name-list').prop('checked', true);
        $('#from-name-smtp').prop('checked', true);
        $('#from-name').prop('disabled', false);
    }

    function loadEvergreenScheduleData (val) {
        $('.sending_timeInput').show();
        $('#evergreen_schedule_year').hide();
        if (val == 'yearly') {
            $('#evergreen_schedule_year').show();
            $('#evergreen_schedule_month').show();
            $('#evergreen_schedule_week').hide();
            $('#evergreen_schedule_hour').hide();
            $('#evergreen_schedule_minute').hide();
        } else if (val == 'monthly') {
            $('#evergreen_schedule_month').show();
            $('#evergreen_schedule_week').hide();
            $('#evergreen_schedule_hour').hide();
            $('#evergreen_schedule_minute').hide();
        } else if (val == 'weekly') {
            $('#evergreen_schedule_week').show();
            $('#evergreen_schedule_month').hide();
            $('#evergreen_schedule_hour').hide();
            $('#evergreen_schedule_minute').hide();
        } else if (val == 'daily') {
            $('#evergreen_schedule_week').hide();
            $('#evergreen_schedule_month').hide();
            $('#evergreen_schedule_hour').hide();
            $('#evergreen_schedule_minute').hide();
        } else if (val == 'hour') {
            $('.sending_timeInput').hide();
            $('#evergreen_schedule_hour').show();
            $('#evergreen_schedule_week').hide();
            $('#evergreen_schedule_month').hide();
            $('#evergreen_schedule_minute').hide();
        } else if (val == 'minute') {
            $('#evergreen_schedule_minute').show();
            $('#evergreen_schedule_hour').hide();
            $('#evergreen_schedule_week').hide();
            $('#evergreen_schedule_month').hide();
        }
    }

    var evergreen = $('input[name=evergreen_schedule]:checked').val();
    getListSegmentSplittestArea("{{ $campaign_data['type'] }}");
    getMaskedDomainArea("{{ $campaign_data['masked_domain'] }}");
    getSenderInformation("{{ $campaign_data['sender_option'] }}");
    loadEvergreenScheduleData (evergreen);
    var list_campaign = 'campaigns';
    $('#from_option_list').click(function() {
        $('#from-name-list').val('Y');
        $('#from-name-smtp').val('N');

        if ($('#from-name-list').prop('checked')) {

        } else {

            $('#from-name-list').val('N');
            $('#from-name-smtp').val('N');
        }
    });
    $(".campaigns").click(function(){
        if($('#campaign_type').val()=='split_test')
        {
            $("#campaigns-tab2").hide();
            $("#lists-tab2").show();
        }
        else {
            $("#campaigns-tab2").show();
            $("#lists-tab2").hide();
            $('.split_type').prop('checked', false);
        }
           
    });
    $(".split_type").click(function(){
        
       list_campaign  = $(this).attr('data');
        if(list_campaign == "campaigns") {
            $("#split-test-check").val(list_campaign);
            $("#campaigns-tab2").hide();
            $("#lists-tab2").show();
        } else {
            $("#split-test-check").val(list_campaign);
            $("#campaigns-tab2").show();
            $("#lists-tab2").hide();
        }
    });

    $('#from_option_smtp').click(function() {

        $('#from-name-smtp').val('Y');
        $('#from-name-list').val('N');


    });

    $('#notification-email').on('switchChange.bootstrapSwitch', function (e, state) {
        if(state){
            $("#notification_email").show();
        }else{
            $("#notification_email").hide();
            $('#email').val('');
        }
    });

    /*$('#from_name_smtp').on('switchChange.bootstrapSwitch', function (e, state) {
        if(state ==false){
            $("#from_name").show();
        }else if(state == true){
            $("#from_name").hide();
        }
    });*/
    $('#from_name_list').on('switchChange.bootstrapSwitch', function (e, state) {
        if(state ==false){
            $("#from_name").hide();
        }else if(state == true){
            $("#from_name").show();
        }
    });
    $('#hourly-speed-switch').prop('checked', function (e, state) {
        var state = $('#hourly-speed-switch').prop("checked");
        if(state ==true){
            $("#hourly_speed").show();
        }else if(state == false){
            $("#hourly_speed").hide();
        }
    });
    $('#hourly-speed-switch').click(function() {
        var state = $('#hourly-speed-switch').prop("checked");
        if(state ==true){
            $("#hourly_speed").show();
        }else if(state == false){
            $("#hourly_speed").hide();
        }
    });
    /*select all sender list select all option*/
    $('.checkbox-all-index-sender').click(function () {
        if($(this).is(':checked')) {
            $('.checkbox-index-sender').prop('checked', true);
        } else {
            $('.checkbox-index-sender').prop('checked', false);
        }
    });
    $('.movetostep1').click(function () {
       $("#step1").trigger("click");
       $("#start").modal("hide");
       $(".blockUI").hide();
    });


    $("#thread_numbers").on("keyup" , function() { 
        $("#thread_numbermsg").html("");
        if(Number($(this).val()) > 5) {
            var total_running_tasks = $("#total_running_tasks").val(); 
            $("#thread_numbermsg").html("<?php echo trans('schedule_broadcast.add_new.tab4.thread_warning_msg'); ?>" + " <u>" + total_running_tasks + "</u>")
        }

        <?php if($threadFlag) { ?>
        if(Number($(this).val()) > <?php echo $totalThreads; ?> && <?php echo $totalThreads; ?> > 0) {
            $("#thread_numbers").val(<?php echo $totalThreads; ?>);
        }
        <?php } ?>

    });
</script>

<script type="text/javascript">
    // var KTFormRepeater = function() {
    //     var demo1 = function() {
    //         $('#kt_repeater_3').repeater({
    //             initEmpty: false,

    //             defaultValues: {
    //                 'text-input': 'foo'
    //             },

    //             show: function() {
    //                 $(this).slideDown();
    //             },

    //             hide: function(deleteElement) {
    //                 if(confirm('@lang("common.message.delete_warning")')) {
    //                     $(this).slideUp(deleteElement);
    //                 }
    //             }
    //         });
    //     }
    //     return {
    //         init: function() {
    //             demo1();
    //         }
    //     };
    // }();
    // jQuery(document).ready(function() {
    //     KTFormRepeater.init();
    // });

    $('body').on("click" , ".group-selector-subscriber", function () {
        var group = this.id;
        //alert(group);
        if($(this).is(':checked')) {
            // var l1 = $('.group-subscriber-'+group).length/2;
            // var l2 = $('.group-subscriber-'+group).not(':disabled').prop('checked', true).length/2;
            // console.log(l1 + " -- " + l2)
            // if (l2 <= 0) {
            //     Command: toastr["error"]("All Lists Disabled!");
            //     $('.group-subscriber-'+group).prop('checked', false);
            //     $('.group-selector-subscriber').prop('checked', false);
            //     return false;
            // } else {
            //     $('.group-subscriber-'+group).not(':disabled').prop('checked', true);
            // }
            $('.group-subscriber-'+group).not(':disabled').prop('checked', true);
            
        } else {
            $('.group-subscriber-'+group).prop('checked', false);
        }
    });
    
    // $('body').on("click" , ".group-selector-subscriber", function () {
    //     var group = this.id;
    //     //alert(group);
    //     // var disabled = $('.group-subscriber-'+group).hasClass("disabled");
    //     var cb = $('.group-subscriber-'+group).attr("disabled");
    //     // var disabled = cb.attr("disabled", !cb.prop('disabled'));
    //     if($(this).is(':checked')) {
    //         if(cb) {
    //             Command: toastr["error"]("All Lists Disabled!");
    //             $('.group-subscriber-'+group).prop('checked', false);
    //             $('.group-selector-subscriber').prop('checked', false);
    //         } else {
    //             $('.group-subscriber-'+group).not(':disabled').prop('checked', true);
    //         }
    //         $('.group-subscriber-'+group).not(':disabled').prop('checked', true);
    //     } else {
    //         $('.group-subscriber-'+group).prop('checked', false);
    //     }
    // });
</script>

                                                                                        
@endsection

@section('content')

@if (Session::has('msg'))
<div class="alert alert-success" data-name="CVvOctis">
    {{ Session::get('msg') }}
</div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="KxgVGCrU">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="mYyEnyxL">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>


<div class="row" data-name="RKEAReFE">
    <div class="col-md-8 create-form" data-name="seFHtQoI">
        <!-- <input class="form-control" id="kt_timepicker_1" readonly placeholder="Select time" type="text"/> -->
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="DshIaeLC">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="TgRbFvSf">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="kVKarkQj">
                    <div class="kt-wizard-v4__nav-items" data-name="DwkcwEjd">
                        <a class="kt-wizard-v4__nav-item"  href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="GNDuAoXu">
                                <div class="kt-wizard-v4__nav-number" data-name="oEcmEsUc">
                                    1
                                </div>
                                <div id="step1"  class="kt-wizard-v4__nav-label" data-name="kzQSppoP">

                                    <div class="kt-wizard-v4__nav-label-title" data-name="qJksvJhV">
                                        {{trans('schedule_broadcast.add_new.tab1.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="RfEgajvs">
                                        {{ trans('schedule_broadcast.add_new.tab1.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="VrcqCkKB">
                                <div class="kt-wizard-v4__nav-number" data-name="oerdgTeD">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="RlYsuUhH">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="GlGkrqLY">
                                        {{trans('schedule_broadcast.add_new.tab2.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="aXAvUstp">
                                        {{ trans('schedule_broadcast.add_new.tab2.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="IlFiBzMn">
                                <div class="kt-wizard-v4__nav-number" data-name="hSxkFBLO">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="knJXRhtx">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="PlMWCRLn">
                                        {{trans('schedule_broadcast.add_new.tab3.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="PgdYDaTl">
                                        {{ trans('schedule_broadcast.add_new.tab3.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="nyySbjyJ">
                                <div class="kt-wizard-v4__nav-number" data-name="RpuIfCmb">
                                    4
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="DNYVYUIp">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="aNqwBdOy">
                                        {{trans('schedule_broadcast.add_new.tab4.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="SYvgBvfu">
                                        {{ trans('schedule_broadcast.add_new.tab4.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="kt-portlet form" data-name="uZjGYRsR">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="meYuWaef">
                        <div class="kt-grid" data-name="KSJkzraP">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="Loymyrjl">
                                <form action="{{ route('broadcast.schedule.store') }}" class="kt-form kt-form--label-right" id="submit_form" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="schedule_id" value="{{ $id }}">
                                    <div class="form-wizard" data-name="UOQxHjoF">
                                        <div class="form-body" data-name="bqfgAqWm">

                                            <div class="tab-content" data-name="RBFaRxDn">
                                                <div class="alert alert-danger display-none" data-name="aYLkLoDk">
                                                    <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} 
                                                </div>
                                                <div class="alert alert-success display-none" data-name="DIbnEWWQ">
                                                    <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} 
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="boSqaMRD">
                                                    <div class="kt-form__section kt-form__section--first" data-name="sffiuOlN">
                                                        <div class="kt-wizard-v4__form" data-name="GJXFwUKv">
                                                            <div class="form-group row" data-name="zYRKkCYQ">
                                                                    
                                                                <div class="col-md-12" data-name="jTewVYLm">
                                                                    <label class="col-form-label">{{trans('schedule_broadcast.add_new.tab1.form.schedule_label')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover( 'schedule_broadcast.add_new.tab1.form.schedule_label_help','common.description' ) !!}
                                                                    </label>
                                                                    @if(isset($saved_criteria) && $saved_criteria == 1)
                                                                    <a href="{{ route('broadcasts.saved.criteria') }}" title="{{trans('aschedule_broadcast.add_new.tab1.form.schedule_label_title')}}"><i class="fa fa-floppy-o fa-2x"></i></a>
                                                                    @endif
                                                                    <input type="text" class="form-control" name="name" value="{{ isset($campaign_data['name']) ? $campaign_data['name'] : '' }}" required />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" data-name="JaPYQUKe">
                                                                        
                                                                <div class="col-md-12" data-name="njYZAKTU">
                                                                    <label class="col-form-label">{{trans('schedule_broadcast.add_new.tab1.form.campaign_type')}} 
                                                                    
                                                                        <span class="required"> * </span>
                                                                         {!! popover( 'schedule_broadcast.add_new.tab1.form.campaign_type_help','common.description' ) !!}
                                                                    </label>
                                                                    <select class="form-control m-select2" name="campaign_type" id="campaign_type" onChange="getSegmentList()"> >
                                                                    @if(isset($campaign_data['campaign_type']) && $campaign_data['campaign_type'] == 'evergreen')
                                                                        @if($evergreenC != 1)
                                                                        <option value="regular">
                                                                            {{trans('common.label.regular')}}
                                                                        </option>
                                                                        @endif  
                                                                        @php $evergreenAddon = addon_license_status("Evergreen Campaigns"); @endphp
                                                                        @if($evergreenAddon == "Active")
                                                                            @if(routeAccess('campaign.evergreen.create'))
                                                                                <option value="evergreen" selected>
                                                                                    {{trans('common.label.evergreen')}}
                                                                                </option>
                                                                            @endif
                                                                        @endif
                                                                    @elseif(isset($campaign_data['type']) && $campaign_data['type'] == 'split_test')
                                                                        @if($evergreenC != 1)
                                                                            <option value="regular" >{{trans('common.label.regular')}}</option>
                                                                            @if($splitAccess)
                                                                                <option value="split_test" selected="">{{trans('common.label.split_test')}}</option>
                                                                            @endif

                                                                        @endif
                                                                        @php $evergreenAddon = addon_license_status("Evergreen Campaigns"); @endphp
                                                                        @if($evergreenAddon == "Active")
                                                                        @if(routeAccess('campaign.evergreen.create'))
                                                                        <option value="evergreen">{{trans('common.label.evergreen')}}</option>
                                                                        @endif
                                                                        @endif
                                                                      
                                                                    @else
                                                                        @if($evergreenC != 1)
                                                                        <option value="regular"  selected="">{{trans('common.label.regular')}}</option>
                                                                      
                                                                        @if($splitAccess)
                                                                        <option value="split_test">{{trans('common.label.split_test')}}</option>
                                                                        @endif
                                                                        @endif
                                                                        @php $evergreenAddon = addon_license_status("Evergreen Campaigns"); @endphp
                                                                        @if($evergreenAddon == "Active")

                                                                        @if(routeAccess('campaign.evergreen.create') and $evergreenLimit)
                                                                            <option value="evergreen">{{trans('common.label.evergreen')}}</option>
                                                                        @endif
                                                                        @endif
                                                                    @endif
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group" id="campaign_type_remaining" data-name="WZjKsose">
                                                                <div class="col-md-12 pt15 kt-radio-inline" data-name="qFwqIQDN">
                                                                    <label for="type" class="kt-radio kt-radio--default">
                                                                        <input type="radio" name="type" id="type" value="subscriber" {{ ($campaign_data['type'] == 'subscriber') ? 'checked' : '' }} onclick="getListSegmentSplittestArea('subscriber')"> {{trans('common.label.contact_lists')}}
                                                                        <span></span>
                                                                    </label>
                                                                    &nbsp;&nbsp;
                                                                @if($segmentAccess)
                                                                    <label for="type2" class="kt-radio kt-radio--default">
                                                                        <input type="radio" name="type" id="type2" value="segment" {{ ($campaign_data['type'] == 'segment')? 'checked' : '' }} onclick="getListSegmentSplittestArea('segment')"> {{trans('common.label.segments')}}
                                                                        <span></span>
                                                                    </label>&nbsp;&nbsp;
                                                                @endif
                                                                </div>  
                                                            </div>
                                                            <div id="subscriber" class="desc" data-name="nAlYnSry">
                                                                <div class="form-group row" id="list-blk" data-name="NPZCiSLZ">
                                                                        
                                                                    <div class="col-md-12" data-name="VIdObadM">
                                                                        <div class="toggle-block">
                                                                            <label class="col-form-label" for="contactList">{{trans('common.label.contact_list')}} <span class="required"> * </span></label>
                                                                            <div class="ts-blk">
                                                                                <label class="col-form-label text-left text-link" for="clist">Filter Checked</label>
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                    <label>
                                                                                        <input type="checkbox" id="clist">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-input-icon kt-input-icon--left" data-name="cTLcyVTg">
                                                                            <input type="text" id="contactList" class="form-control" placeholder="{{trans('schedule_broadcast.search.lists')}}...">
                                                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                                <span><i class="la la-search"></i></span>
                                                                            </span>
                                                                        </div>
                                                                        <?php 
                                                                             $unauth_sending_domain = getApplicationSettings('unauth_sending_domain');  
                                                                        ?> 
                                                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200 bt0" data-name="BzAplZWM">
                                                                            <div class="kt-portlet__body scList" data-name="LzfGSJnm">
                                                                                @if($lists_count > 0)
                                                                                @foreach ($list_tree as $group_metadata)
                                                                                    <div class="kt-checkbox-list" data-name="craJjaEi">
                                                                                        <label for="{{ $group_metadata['id'] }}" class="kt-checkbox parentList">
                                                                                            <input class="group-selector-subscriber campaigns" type="checkbox" value="" id="{{ $group_metadata['id'] }}" name="list_group_tab1[]">  {{ $group_metadata['name'] }} 
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    @foreach ($group_metadata['children'] as $list_metadata)
                                                                                                <?php 
                                                                                                            $domainStatus = \App\Lists::getListDomainStatus($list_metadata['domain_id']); 
                                                                                                            $domainMsg = "Missing Sending Domain";
                                                                                                        ?>
                                                                                        <div id="flag_{{$list_metadata['id']}}" class="kt-checkbox-list @if($list_metadata['is_blocked'] or $list_metadata['total_subscriber'] <= 0 or (!$domainStatus AND $license_type == "Commercial ESP" and $unauth_sending_domain == "on" )) list-disabled @endif" style="padding-left: 20px;" data-name="ThFxEWzg">
                                                                                            <label for="l_{{$list_metadata['id']}}" class="kt-checkbox childList">
                                                                                                @if($list_metadata['is_blocked'] or $list_metadata['total_subscriber'] <= 0 or (!$domainStatus AND $license_type == "Commercial ESP" and $unauth_sending_domain == "on" )) 
                                                                                                <input id="l_{{$list_metadata['id']}}" type="checkbox" value="{{ $list_metadata['id'] }}" name="list_ids[]" required class="group-subscriber-{{ $group_metadata['id'] }} campaigns @if(!$domainStatus or $list_metadata['total_subscriber'] <= 0) disabled @endif"  @if(!$domainStatus or $list_metadata['total_subscriber'] <= 0) disabled @endif class="group-list-ids-tab1-{{ $group_metadata['id'] }} subscriber_list"> <name>{{ $list_metadata['name'] }}</name> 
                                                                                                @else 
                                                                                                <input id="l_{{$list_metadata['id']}}" type="checkbox" value="{{ $list_metadata['id'] }}" name="list_ids[]" required class="group-subscriber-{{ $group_metadata['id'] }} campaigns" class="group-list-ids-tab1-{{ $group_metadata['id'] }} subscriber_list" {{ isset($campaign_data['list_ids']) && $list_metadata['is_blocked'] == 0 && in_array($list_metadata['id'], explode(',', $campaign_data['list_ids'])) ? 'checked' : '' }} > <name>{{ $list_metadata['name'] }}</name> 
                                                                                                @endif
                                                                                                          
                                                                                                    @if(!$domainStatus AND $license_type == "Commercial ESP" and $unauth_sending_domain == "on" )
                                                                                                    <a class="fix-now" href="{{ route('list.edit', $list_metadata['id']) }}" target="_blank">Fix Now</a>
                                                                                                    <small class="btn btn-label-warning label-blocked">{{$domainMsg}}</small>
                                                                                                    @endif
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    @php
                                                                                    $haveList = 1;
                                                                                    @endphp
                                                                                    @endforeach
                                                                                @endforeach
                                                                                @else
                                                                                 <div data-name="PvAFsQOM">
                                                                                    <input type="checkbox" name="list_iddd" value="" required onclick="return false;" onkeydown="return false;">
                                                                                    {{trans('common.label.note_no_list_found')}} <br/>
                                                                                    <a href="{{route('list.create')}}">{{trans('common.label.create_one_here')}}</a>
                                                                                </div>
                                                                                @endif
                                                                                @if($haveList==0)
                                                                               
                                                                                <input type="hidden" name="no_list" id="no_list" value="0" />
                                                                                @else 
                                                                                <input type="hidden" name="no_list" id="no_list" value="1" />
                                                                                @endif
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div id="li-error" class="">{{trans('common.error.single_check')}}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            @include('campaign.customCriteria')
                                                            @if($segmentAccess)
                                                            <div id="segment" class="desc" style="display: none;" data-name="MjKBKjNb">
                                                                <div class="form-group row" id="sgm-blk" data-name="HtBjiAYe">
                                                                        
                                                                    <div class="col-md-12" data-name="GnRqEvMm">
                                                                        <label class="col-form-label" for="segmentList">{{trans('schedule_broadcast.add_new.tab1.form.segment_list')}}
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="kt-input-icon kt-input-icon--left" data-name="hieNyDIF">
                                                                            <input type="text" id="segmentList" class="form-control" placeholder="{{trans('schedule_broadcast.search.segments')}}...">
                                                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                                <span><i class="la la-search"></i></span>
                                                                            </span>
                                                                        </div>
                                                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200 bt0 kt-relative" data-name="OZmvLTEW">
                                                                            <div class="kt-portlet__body scList" data-name="dXoAtpnF">
                                                                                @if($segments)
                                                                                    @foreach($segments as $segment)
                                                                                        <div class="kt-radio-list" id="seg_{{$segment->id}}" data-name="CwJQEzkW">
                                                                                            <label class="kt-radio childList">
                                                                                                <input id="s_{{$segment->id}}" class="segments" type="radio" value="{{$segment->id}}" name="segment_ids[]" required {{ isset($campaign_data['segment_ids']) && in_array($segment->id, explode(',', $campaign_data['segment_ids'])) ? 'checked' : '' }} />  {{$segment->name}} <div class="counts" id="chk_{{$segment->id}}" data-name="YNZpcfNo">({{ $segment['total'] }})</div> <div style="display: none;" class="countsload" data-name="rPYXtcXu"><i class="fa-spin la la-refresh"></i></div>
                                                                                            <span></span> 
                                                                                            </label>
                                                                                        </div>
                                                                                    @php
                                                                                            $haveSegemnt = 1;
                                                                                    @endphp
                                                                                    @endforeach
                                                                                @endif
                                                                                
                                                                                @if($haveSegemnt==0)
                                                                                <input type="hidden" name="no_segemnt" id="no_segemnt" value="0" />
                                                                                @if (routeAccess('segment.add'))
                                                                                        <div data-name="XePNgSpe">
                                                                                            <input type="checkbox" name="segment_iddd" value="" required onclick="return false;" onkeydown="return false;">
                                                                                            {{trans('schedule_broadcast.not_found.segments')}} <br/>
                                                                                            <a href="{{ route('segment.add') }}">{{trans('common.label.create_one_here')}}</a>
                                                                                            <span></span> 
                                                                                        </div>
                                                                                    @endif
                                                                            @else
                                                                            <input type="hidden" name="no_segemnt" id="no_segemnt" value="1" />

                                                                            @endif
                                                                            </div>
                                                                            @if($segments)
                                                                            <span id="counting" class="kt-font-info">
                                                                                <i class="flaticon2-reload"></i>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                        <div id="sn-error" class="">{{trans('common.error.single_check')}}</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if($splitAccess)
                                                            <div id="split_test" class="desc" style="display: none;" data-name="vTTSqOjg">
                                                                <div class="form-group row" data-name="quLOPHqF">
                                                                    
                                                                    <div class="col-md-12" data-name="oZiPvgGv">
                                                                        <label class="col-form-label">{{trans('schedule_broadcast.add_new.tab1.form.split_test_list')}}
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="arxhUpAp">
                                                                            <div class="kt-portlet__body scList" data-name="FhXBKJxH">
                                                                                @if($split_tests_count > 0)
                                                                                    @foreach($split_tests as $split_test)
                                                                                        <div class="kt-radio-list" data-name="cZMaemRZ">
                                                                                            <label for="split-test_{{$split_test->id}}" class="kt-radio"><input type="radio" value="{{$split_test->id}}" id="split-test_{{$split_test->id}}" class="split_type split_test" data="{{$split_test->test_on}}" name="split_test_ids[]" required {{ isset($campaign_data['split_test_ids']) && in_array($split_test->id, explode(',', $campaign_data['split_test_ids'])) ? 'checked' : '' }} />
                                                                                            {{$split_test->name}} <span></span></label> 
                                                                                        </div>
                                                                                    @endforeach
                                                                                <input type="hidden" name="no_split_test" id="no_split_test" value="1" />    
                                                                                @else
                                                                                    <input type="hidden" name="no_split_test" id="no_split_test" value="0" /> 
                                                                                    @if (routeAccess('splittest.create'))
                                                                                    <div data-name="JAozfWAs">
                                                                                        <input type="checkbox" name="split_ids_id" value="" required onclick="return false;" onkeydown="return false;">
                                                                                        {{ trans('schedule_broadcast.add_new.tab1.form.split_test_not_found') }} <br/>
                                                                                        <a href="{{route('splittest.create')}}">{{trans('common.label.create_one_here')}}</a>
                                                                                    </div>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="TGHvRSYL">
                                                    <div class="kt-form__section kt-form__section--first" data-name="YwCrwtlD">
                                                        <div class="kt-wizard-v4__form" data-name="LpSTjImM">
                                                            <div class="form-group row campaing-split-test" id="campaigns-tab2" data-name="UUHXMKYE">
                                                                    
                                                                <div class="col-md-12" data-name="zpIjCPCJ">
                                                                    <div class="toggle-block">
                                                                        <label class="col-form-label" for="searchBroadcast">{{trans('schedule_broadcast.add_new.tab1.form.campaign_list')}}
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <div class="ts-blk">
                                                                            <label class="col-form-label text-left text-link" for="clist2">Filter Checked</label>
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                <label>
                                                                                    <input type="checkbox" id="clist2">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="kt-input-icon kt-input-icon--left" data-name="yCfiPiTX">
                                                                        <input type="text" id="searchBroadcast" class="form-control" placeholder="{{trans('schedule_broadcast.search.camps')}}...">
                                                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                            <span><i class="la la-search"></i></span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200 bt0" data-name="mpWRYTgY">
                                                                        <div class="kt-portlet__body scList" data-name="fZCZdYKP">
                                                                            @if($campaign_count > 0)
                                                                            <div class="kt-checkbox-list" data-name="qEETcYij">
                                                                                <label for="sall_1" class="kt-checkbox">
                                                                                    <input type="checkbox" id="sall_1" class="checkbox-index checkbox-all-index"><b>{{trans('common.label.select_all')}} </b>
                                                                                    <span>
                                                                                </label>
                                                                            </div>
                                                                            
                                                                            
                                                                                @foreach ($campaign_tree as $group_metadata)
                                                                                    <div class="kt-checkbox-list" data-name="eajRoaIO">
                                                                                        <label for="{{ $group_metadata['id'] }}" class="kt-checkbox parentList">
                                                                                            <input class="group-selector-subscriber group-selector-campaign checkbox-index" type="checkbox" id="{{ $group_metadata['id'] }}" value="{{ $group_metadata['id'] }}" name="campaign_group[]">  {{ $group_metadata['name'] }} 
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                        @foreach ($group_metadata['children'] as $campaign_metadata)
                                                                                            <div id="br_{{$campaign_metadata['id']}}" class="kt-checkbox-list" style="padding-left: 20px;" data-name="eMHJNxhJ">
                                                                                                <label for="clist_{{ $campaign_metadata['id'] }}" class="kt-checkbox childList">
                                                                                                    <input type="checkbox" value="{{ $campaign_metadata['id'] }}" name="campaign_ids[]" id="clist_{{ $campaign_metadata['id'] }}" class="group-subscriber-{{ $group_metadata['id'] }} campaign_lists checkbox-index" required {{ isset($campaign_data['campaign_ids']) && in_array($campaign_metadata['id'], explode(',', $campaign_data['campaign_ids'])) ? 'checked' : '' }}> {{ $campaign_metadata['name'] }} <span></span>
                                                                                                </label> 
                                                                                            </div>
                                                                                        @endforeach
                                                                                @endforeach
                                                                                <input type="hidden" name="no_campaign" id="no_campaign" value="1" />
                                                                            @else
                                                                                <input type="hidden" name="no_campaign" id="no_campaign" value="0" />
                                                                                    @if (routeAccess('broadcasts.add'))
                                                                                        <div data-name="XdXOoRbb">
                                                                                            <input type="checkbox" name="campaign_ids_id" value="" required onclick="return false;" onkeydown="return false;">
                                                                                            {{trans('schedule_broadcast.add_new.tab2.campaign_not_found')}} <br/>
                                                                                            <a href="{{route('broadcasts.template')}}"> {{trans('common.label.create_one_here')}}</a>
                                                                                        </div>
                                                                                    @endif
                                                                            @endif    
                                                                                
                                                                        </div>
                                                                    </div>
                                                                    <div id="cl-error" class="">{{trans('common.error.single_check')}}</div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                            <div id="lists-tab2" style="display: none;" data-name="wSkYvDgn">
                                                                <div class="form-group row" data-name="DfkKSTuK">
                                                                    <div class="col-md-12" data-name="zOobPzxp">
                                                                        <div class="toggle-block">
                                                                            <label class="col-form-label" for="searchList">{{trans('common.label.contact_list')}}
                                                                                <span class="required"> * </span>
                                                                            </label>
                                                                            <div class="ts-blk">
                                                                                <label class="col-form-label text-left text-link" for="clist4">Filter Checked</label>
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                    <label>
                                                                                        <input type="checkbox" id="clist4">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="kt-input-icon kt-input-icon--left" data-name="tIodasxBJ">
                                                                            <input type="text" id="searchList" class="form-control" placeholder="{{trans('schedule_broadcast.search.camps')}}...">
                                                                            <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                                <span><i class="la la-search"></i></span>
                                                                            </span>
                                                                        </div>
                                                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="tIoccxBJ">
                                                                            <div class="kt-portlet__body scList" data-name="gfyDkdkt">
                                                                                @foreach ($list_tree as $group_metadata)
                                                                                    <div class="kt-checkbox-list" data-name="ctdWbhUh">
                                                                                        <label for="l-{{ $group_metadata['id'] }}"  class="kt-checkbox">
                                                                                            <input class="group-selector-subscriber group-selector-subscriber2" type="checkbox" value="{{ $group_metadata['id'] }}" id="l-{{ $group_metadata['id'] }}" name="list_group_tab2[]"> <strong>{{ $group_metadata['name'] }}</strong> <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    @foreach ($group_metadata['children'] as $list_metadata)
                                                                                        <div id="fgmg_{{ $list_metadata['id'] }}" class="kt-checkbox-list" style="padding-left: 20px;" data-name="lSJjlWgH">
                                                                                            <label for="gmg_{{ $list_metadata['id'] }}" class="kt-checkbox">
                                                                                                <input type="checkbox" id="gmg_{{ $list_metadata['id'] }}" value="{{ $list_metadata['id'] }}" name="list_ids_tab2[]" required class="group-subscriber2 group-subscriber-l-{{ $group_metadata['id'] }}" {{ isset($campaign_data['list_ids']) && in_array($list_metadata['id'], explode(',', $campaign_data['list_ids'])) ? 'checked' : '' }}> 
                                                                                            
                                                                                                {{ $list_metadata['name'] }}
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="split_test_on" id="split-test-check" value="{{ $campaign_data['split_test_on'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="bbWseZeb">
                                                    <div class="kt-form__section kt-form__section--first" data-name="TsuYfYFh">
                                                        <div class="kt-wizard-v4__form" data-name="VULLbhrP">
                                                            <div class="form-group row" id="sn-blk" data-name="OwaxRWbw">
                                                                    
                                                                <div class="col-md-12" data-name="XSYxeDRG">
                                                                    <div class="toggle-block">
                                                                        <label class="col-form-label" for="searchSmtps">{{trans('schedule_broadcast.add_new.tab3.form.sender_list')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover( 'schedule_broadcast.add_new.tab3.form.sender_list_help','common.description' ) !!}
                                                                        </label>
                                                                        <div class="ts-blk">
                                                                            <label class="col-form-label text-left text-link" for="clist3">Filter Checked</label>
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                <label>
                                                                                    <input type="checkbox" id="clist3">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="kt-input-icon kt-input-icon--left" data-name="NDAmLIDC">
                                                                        <input type="text" id="searchSmtps" class="form-control" placeholder="{{trans('schedule_broadcast.search.nodes')}}...">
                                                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                            <span><i class="la la-search"></i></span>
                                                                        </span>
                                                                    </div>
                                                                    <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200 bt0" data-name="HRhwwndv">
                                                                        <div class="kt-portlet__body scList" data-name="DOkbyihZ">
                                                                            <div class="kt-checkbox-list mhide" data-name="OShhuTyQ" >
                                                                                <label for="sall_2" class="kt-checkbox">
                                                                                    <input type="checkbox" id="sall_2" class="checkbox-index-sebder checkbox-all-index-sender">
                                                                                    <b>{{trans('common.label.select_all')}}</b>
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="kt-checkbox-list" data-error-container="#form_2_services_error" data-name="YdygMuVc">
                                                                            @foreach ($smtp_tree as $group_metadata)
                                                                            <div class="input-icon right mhide kt-checkbox-list" data-name="vTdUGIMz">
                                                                                <label for="{{ $group_metadata['id'] }}" class="kt-checkbox">
                                                                                    <input class="group-selector-subscriber checkbox-index-sender" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group[]" > <strong>{{ $group_metadata['name'] }}</strong>
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                                @if($group_metadata['children'])
                                                                                    @foreach ($group_metadata['children'] as $smtp_metadata)
                                                                                    <div id="sm_{{$smtp_metadata['id']}}" style="padding-left: 20px;" data-name="suqJXVPq" class="kt-checkbox-list">
                                                                                        <label for="smtp_{{ $smtp_metadata['id'] }}" class="kt-checkbox">
                                                                                            <input type="checkbox" value="{{ $smtp_metadata['id'] }}" id="smtp_{{ $smtp_metadata['id'] }}" name="smtp_ids[]" class="group-subscriber-{{ $group_metadata['id'] }} checkbox-index-sender" required {{ isset($campaign_data['smtp_ids']) && in_array($smtp_metadata['id'], explode(',',$campaign_data['smtp_ids'])) ? 'checked' : '' }}> {{ $smtp_metadata['name'] }}
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    
                                                                                    @php
                                                                                        $haveSmpts = 1;
                                                                                    @endphp
                                                                                    @endforeach
                                                                                @endif
                                                                            @endforeach
                                                                            @if($haveSmpts==0)
                                                                            <input type="hidden" name="no_smtp" id="no_smtp" value="0" />
                                                                            <style>
                                                                                .mhide{
                                                                                    display: none;
                                                                                }
                                                                            </style>
                                                                            @if(routeAccess('node.create-new'))
                                                                                <div data-name="pgGbBrwx">
                                                                                    <input type="checkbox" name="smtp_ids_id" value="" required onclick="return false;" onkeydown="return false;">
                                                                                    {{trans('schedule_broadcast.add_new.tab3.form.smtp_not_found')}} <br/>
                                                                                    <a href="{{route('node.create-new')}}">{{trans('common.label.create_one_here')}}</a>
                                                                                </div>
                                                                            @endif
                                                                            @else
                                                                            <input type="hidden" name="no_smtp" id="no_smtp" value="1" />
                                                                            @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div id="sn-error" class="">{{trans('common.error.single_check')}}</div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row rd" data-name="CAxsBVml">
                                                                    
                                                                <div class="col-md-12" data-name="HSdRAxGY">
                                                                    <label class="col-form-label">{{trans('schedule_broadcast.add_new.tab3.form.smtp_sequence')}}
                                                                        {!! popover( 'schedule_broadcast.add_new.tab3.form.smtp_sequence_help','common.description' ) !!}
                                                                    </label>
                                                                    <div class="kt-radio-inline" data-name="ivhpinYl">
                                                                    @if (isset($page_data['action']) == 'saved_criteria')
                                                                        <label for="smtp_sq_1" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="smtp_sequence" id="smtp_sq_1" value="batch" {{ (isset($campaign_data['smtp_sequence']) && $campaign_data['smtp_sequence'] == 'batch') ? 'checked' : '' }} checked onclick="sendingPattern('batch')"> {{trans('schedule_broadcast.add_new.tab3.form.batches')}}
                                                                            <span></span>
                                                                        </label>&nbsp;&nbsp;
                                                                        <label for="smtp_sq_2" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="smtp_sequence" id="smtp_sq_2" value="loop" {{ (isset($campaign_data['smtp_sequence']) && $campaign_data['smtp_sequence'] == 'loop') ? 'checked' : '' }} onclick="sendingPattern('loop')"> 
                                                                        {{trans('schedule_broadcast.add_new.tab3.form.loop')}}
                                                                            <span></span>
                                                                        </label>
                                                                    @else
                                                                        <label for="smtp_sq_3" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="smtp_sequence" id="smtp_sq_3" value="batch" checked onclick="sendingPattern('batch')"> {{trans('schedule_broadcast.add_new.tab3.form.batches')}}
                                                                            <span></span>
                                                                        </label>&nbsp;&nbsp;
                                                                        <label for="smtp_sq_4" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="smtp_sequence" id="smtp_sq_4" value="loop" onclick="sendingPattern('loop')">{{trans('schedule_broadcast.add_new.tab3.form.loop')}}
                                                                            <span></span>
                                                                        </label>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row rd" id="sending_pattern" data-name="aYyifPWp">
                                                                    
                                                                <div class="col-md-12" data-name="SEjacbqb">
                                                                    <label class="col-form-label">{{trans('schedule_broadcast.add_new.tab3.form.smtp_selection')}}
                                                                         {!! popover( 'schedule_broadcast.add_new.tab3.form.smtp_selection_help','common.description' ) !!}
                                                                    </label>
                                                                    <div class="kt-radio-inline" data-name="NbyUGGJo">
                                                                    @if (isset($page_data['action']) == 'saved_criteria')
                                                                        <label for="smtp_sq_11" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="sending_pattern" id="smtp_sq_11" value="sequential" {{ (isset($campaign_data['sending_pattern']) && $campaign_data['sending_pattern'] == 'sequential') ? 'checked' : '' }}> {{trans('schedule_broadcast.add_new.tab3.form.sequential')}}
                                                                            <span></span>
                                                                        </label>&nbsp;&nbsp;
                                                                        <label for="smtp_sq_22"  class="kt-radio kt-radio--defult"> 
                                                                            <input type="radio" name="sending_pattern" id="smtp_sq_22" value="random" {{ (isset($campaign_data['sending_pattern']) && $campaign_data['sending_pattern'] == 'random') ? 'checked' : '' }} checked>  {{trans('schedule_broadcast.add_new.tab3.form.random')}}
                                                                            <span></span>
                                                                        </label>
                                                                     @else
                                                                            <label  class="kt-radio kt-radio--defult">
                                                                                <input type="radio" name="sending_pattern" id="smtp_sq_3" value="sequential"  > 
                                                                                {{trans('schedule_broadcast.add_new.tab3.form.sequential')}}
                                                                                <span></span>
                                                                            </label>&nbsp;&nbsp;
                                                                            <label  class="kt-radio kt-radio--defult">
                                                                                <input type="radio" name="sending_pattern" id="smtp_sq_41" value="random" checked> {{trans('schedule_broadcast.add_new.tab3.form.random')}}
                                                                                <span></span>
                                                                            </label>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php /* 
                                                            <!-- @if(moduleCheck('masking_domains'))
                                                            <div class="form-group row rd">
                                                                <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.sending_domain_option')}}
                                                                </label>
                                                                <div class="col-md-8">
                                                                    <div class="kt-radio-inline">
                                                                        <input type="radio" name="masked_domain" value="not" {{ ($campaign_data['masked_domain'] == 'not') ? 'checked' : '' }} onclick="getMaskedDomainArea('none')"> {{trans('app.campaigns.schedule_email.fields.masked_domain.values.not')}}&nbsp;&nbsp; -->
                                                                        <!--<label for="cdt_01" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" id="cdt_01" name="masked_domain" value="smtp" {{ ($campaign_data['masked_domain'] == 'smtp') ? 'checked' : '' }} onclick="getMaskedDomainArea('none')"> {{trans('app.actions.schedule.add.use_domain_setup_in_smtp')}}
                                                                            <span></span>
                                                                        </label> &nbsp;&nbsp;
                                                                        <label for="cdt_02" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" id="cdt_02" name="masked_domain" value="custom" {{ ($campaign_data['masked_domain'] == 'custom') ? 'checked' : '' }} onclick="getMaskedDomainArea('custom')" {{ count($domain_maskings) ? '' : 'disabled' }}> {{trans('app.actions.schedule.add.custom_selection')}}
                                                                            <span></span>
                                                                         </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else -->
                                                            <input type="hidden" name="masked_domain" value="not">
                                                           <!--  @endif  -->
                                                            <div class="form-group row" id="masked-domains-area" data-name="UcmPcgxz">
                                                                    
                                                                <div class="col-md-12" data-name="DegPeAfo">
                                                                    <label class="col-form-label">{{trans('schedule_broadcast.add_new.tab3.form.sending_domain_option')}}
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="MPxZKqyv">
                                                                        <div class="kt-portlet__body" data-name="hXfnKiGf">
                                                                            @foreach($domain_maskings as $domain)
                                                                                <div class="kt-checkbox-list" data-name="EvwPixti">
                                                                                    <label class="kt-checkbox" for="did_{{$domain->id}}">
                                                                                        <input type="checkbox" id="did_{{$domain->id}}" value="{{$domain->id}}" name="masked_domain_ids[]" {{ isset($campaign_data['masked_domain_ids']) && in_array($domain->id, explode(',', $campaign_data['masked_domain_ids'])) ? 'checked' : '' }} /> {{$domain->domain}}
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> */ ?>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="DIEcXyeg">
                                                    <div class="kt-form__section kt-form__section--first" data-name="VpRjOWPA">
                                                        <div class="kt-wizard-v4__form" data-name="Ghvodfdq">
                                                            <div id="regular-campaign" data-name="uKIblySm">
                                                                <div class="form-group row mb0" data-name="DoHUGCxQ">
                                                                        
                                                                    <div class="col-md-12" data-name="SLuemiBN">
                                                                        <label class="col-form-label">{{trans('schedule_broadcast.add_new.tab4.form.send_campaign')}}
                                                                            {!! popover( 'schedule_broadcast.add_new.tab4.form.send_campaign_help','common.description' ) !!}
                                                                        </label>
                                                                        <div class="kt-radio-inline" data-name="xmyiztED">
                                                                            <label for="send-now" class="kt-radio kt-radio--defult">
                                                                                <input type="radio" name="send_campaign" id="send-now" value="now" checked> {{trans('schedule_broadcast.add_new.tab4.form.send_now')}}
                                                                                <span></span>
                                                                            </label> &nbsp;&nbsp;
                                                                            <label for="send-later" class="kt-radio kt-radio--defult">
                                                                                <input type="radio" name="send_campaign" id="send-later" value="later" > {{trans('schedule_broadcast.add_new.tab4.form.send_later')}}
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row sendign-time" style="display:none;" data-name="sQEizJUY">
                                                                    <label class="col-form-label col-md-12">{{trans('schedule_broadcast.add_new.tab4.form.sending_time')}}</label>
                                                                    <div class="col-md-6" data-name="LycMUoMu">
                                                                        <div class="input-group date" data-date-format="dd-mm-yyyy" data-name="ZFeIuKEf">
                                                                            <input type="text" class="form-control" id="send_date" name="send_date" value="{{ date('d-m-Y') }}" required>
                                                                            <div class="input-group-append" data-name="nCnGLymV">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6" data-name="kBmhVjBh">
                                                                        <div class="input-group" data-name="lnjoVGnv">
                                                                            <input class="form-control" id="kt_timepicker_1" name="send_time" readonly placeholder="Select time" type="text"/>
                                                                            <!-- <input type="text" class="form-control timepicker-default" name="send_time" id="send_time"> -->
                                                                            <div class="input-group-append" data-name="faVhXkdK">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-clock-o"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="evergreen-campaign" style="display: none;" data-name="KUeJrJOW">
                                                                    <div class="form-group row" data-name="XunmEwRJ">
                                                                        <div class="col-md-12">
                                                                            <label class="col-form-label">{{trans('schedule_broadcast.evergreen_select_option')}} {!! popover( 'schedule_broadcast.evergreen_select_option_help','' ) !!}</label>
                                                                        </div>
                                                                        <div class="col-md-12" data-name="JtjaUlPX">
                                                                            <div class="kt-radio-inline" data-name="jXpDbThH">
                                                                                <label for="yearly" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="yearly" checked="checked" name="evergreen_schedule"  value="yearly" onclick="loadEvergreenScheduleData('yearly')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'yearly') ? 'checked' : '' }}> {{trans('broadcasts.schedule_blade.span_yearly')}}
                                                                                    <span></span>
                                                                                </label> 
                                                                                <label for="mnth" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="mnth" checked="checked" name="evergreen_schedule"  value="monthly" onclick="loadEvergreenScheduleData('monthly')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'monthly') ? 'checked' : '' }}> {{trans('common.monthly')}}
                                                                                    <span></span>
                                                                                </label> 
                                                                                <label for="wkly" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="wkly" name="evergreen_schedule" value="weekly" onclick="loadEvergreenScheduleData('weekly')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'weekly') ? 'checked' : '' }}> {{trans('common.weekly')}}
                                                                                    <span></span>
                                                                                </label>
                                                                                <label for="dly" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="dly" name="evergreen_schedule" value="daily" onclick="loadEvergreenScheduleData('daily')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'daily') ? 'checked' : '' }}> {{trans('common.daily')}}
                                                                                    <span></span>
                                                                                </label>
                                                                                <label for="hrly" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="hrly" name="evergreen_schedule" value="hourly" onclick="loadEvergreenScheduleData('hour')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'hour') ? 'checked' : '' }}> {{trans('common.hourly')}}
                                                                                    <span></span>
                                                                                </label>
                                                                                <!-- <label for="mnts" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="mnts" name="evergreen_schedule" value="minutes" onclick="loadEvergreenScheduleData('minute')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'minute') ? 'checked' : '' }}> {{trans('common.minutes')}}
                                                                                    <span></span>
                                                                                </label> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group row" id="evergreen_schedule_year" data-name="wNhdZOmO">
                                                                            
                                                                        <div class="col-md-12" data-name="WSDZwuIP">
                                                                            <label class="col-form-label">{{trans('common.month')}}</label>
                                                                            <select class="form-control m-select2" name="month_of_year" id="month_of_year">
                                                                                @for ($i=1; $i < 13; $i++)
                                                                                    <option value="{{$i}}" {{ (isset($evergreen_campaign->month_of_year) && $evergreen_campaign->month_of_year == $i) ? 'selected' : '' }}>{{$i}}</option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                    <div class="form-group row" id="evergreen_schedule_month" data-name="wNhdZOmO">
                                                                            
                                                                        <div class="col-md-12" data-name="WSDZwuIP">
                                                                            <label class="col-form-label">{{trans('common.day_of_month')}}</label>
                                                                            <select class="form-control m-select2" name="day_of_month" id="day_of_month">
                                                                                @for ($i=1; $i <= 31; $i++)
                                                                                    <option value="{{$i}}" {{ (isset($evergreen_campaign->day_of_month) && $evergreen_campaign->day_of_month == $i) ? 'selected' : '' }}>{{$i}}</option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row" id="evergreen_schedule_week" data-name="jsUFFHVf">
                                                                            
                                                                        <div class="col-md-12" data-name="LTCHMDru">
                                                                            <label class="col-form-label12">{{trans('common.day_of_week')}}</label>
                                                                            <select class="form-control m-select2" name="day_of_week" id="day_of_week">
                                                                                <option value="{{trans('common.sunday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'Sunday') ? 'selected' : '' }}>{{trans('common.sunday')}}</option>
                                                                                <option value="{{trans('common.monday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'selected') ? 'checked' : '' }}>{{trans('common.monday')}}</option>
                                                                                <option value="{{trans('common.tuesday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'tuesday') ? 'selected' : '' }}>{{trans('common.tuesday')}}</option>
                                                                                <option value="{{trans('common.wednesday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'wednesday') ? 'selected' : '' }}>{{trans('common.wednesday')}}</option>
                                                                                <option value="{{trans('common.thursday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'thursday') ? 'selected' : '' }}>{{trans('common.thursday')}}</option>
                                                                                <option value="{{trans('common.friday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'friday') ? 'selected' : '' }}>{{trans('common.friday')}}</option>
                                                                                <option value="{{trans('common.saturday')}}">{{trans('common.saturday')}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row" id="evergreen_schedule_hour" data-name="EhRSdcnE">
                                                                            
                                                                        <div class="col-md-12" data-name="hjFWUdKv">
                                                                            <label class="col-form-label">{{trans('common.after_every')}}</label>
                                                                            <select class="form-control m-select2" name="every_hour" id="every_hour">
                                                                                    @for($i = 0; $i < 60; $i = $i + 5)
                                                                                    <option value="{{$i}}" {{ (isset($evergreen_campaign->every_hour) && $evergreen_campaign->every_hour == $i) ? 'selected' : '' }}>{{$i}} minute</option>
                                                                                    @endfor
                                                                                    <!-- <option value="2" {{ (isset($evergreen_campaign->every_hour) && $evergreen_campaign->every_hour == 2) ? 'selected' : '' }}>2</option>
                                                                                    <option value="3" {{ (isset($evergreen_campaign->every_hour) && $evergreen_campaign->every_hour == 3) ? 'selected' : '' }}>3</option>
                                                                                    <option value="4" {{ (isset($evergreen_campaign->every_hour) && $evergreen_campaign->every_hour == 4) ? 'selected' : '' }}>4</option>
                                                                                    <option value="6" {{ (isset($evergreen_campaign->every_hour) && $evergreen_campaign->every_hour == 6) ? 'selected' : '' }}>6</option>
                                                                                    <option value="8" {{ (isset($evergreen_campaign->every_hour) && $evergreen_campaign->every_hour == 8) ? 'selected' : '' }}>8</option>
                                                                                    <option value="12" {{ (isset($evergreen_campaign->every_hour) && $evergreen_campaign->every_hour == 12) ? 'selected' : '' }}>12</option> -->
                                                                            </select> 
                                                                        </div>
                                                                        <label class="col-form-label col-md-2 text-left"> {{trans('common.hours')}}</label>
                                                                    </div>
                                                                    <div class="form-group row" id="evergreen_schedule_minute" data-name="QWcgqnIQ">
                                                                            
                                                                        <div class="col-md-12" data-name="LddVrwSi">
                                                                            <label class="col-form-label">{{trans('common.after_every')}}</label>
                                                                            <select class="form-control m-select2" name="every_minute" id="every_mintue">
                                                                              <option value="5" {{ (isset($evergreen_campaign->every_mintue) && $evergreen_campaign->every_mintue == 5) ? 'selected' : '' }}>5</option>
                                                                              <option value="15" {{ (isset($evergreen_campaign->every_mintue) && $evergreen_campaign->every_mintue == 15) ? 'selected' : '' }}>15</option>
                                                                              <option value="30" {{ (isset($evergreen_campaign->every_mintue) && $evergreen_campaign->every_mintue == 30) ? 'selected' : '' }}>30</option>
                                                                            </select> 
                                                                        </div>
                                                                        <label class="col-form-label col-md-2 text-left"> {{trans('common.minutes')}}</label>
                                                                    </div>
                                                                    <div class="form-group row sending_timeInput" data-name="yohcpAfd">
                                                                            
                                                                        <div class="col-md-12" data-name="HCrWgXWq">
                                                                            <label class="col-form-label">{{trans('schedule_broadcast.add_new.tab4.form.sending_time')}}

                                                                            </label>
                                                                            <div class="input-group date" data-date-format="dd-mm-yyyy" data-name="MSRGAqTf">
                                                                                <input type="text" class="form-control timepicker timepicker-default"  name="evergreen_schedule_sending_time" id="sending_time">
                                                                                <div class="input-group-append" data-name="pXgVGVXu">
                                                                                    <span class="input-group-text">
                                                                                        <i class="la la-calendar-check-o"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @php 
                                                                    $multi_threading = getSetting("multi_threading");      
                                                                @endphp
                                                                @if((moduleCheck('multi_threading') and (!empty($multi_threading) and $multi_threading == "on")) AND $totalThreads != 1)
                                                                <div class="form-group row" data-name="BUWfUHBq">
                                                                        
                                                                    <div class="col-md-12" data-name="FyfuChNr">
                                                                        <label class="col-form-label">
                                                                            {{trans('schedule_broadcast.add_new.tab4.form.threads')}}
                                                                             {!! popover( 'schedule_broadcast.add_new.tab4.form.threads_help','common.description' ) !!}
                                                                        </label>
                                                                       
                                                                        <input type="number" class="form-control" id="thread_numbers" @if($threadFlag) maxlength="{{$totalThreads}}" @endif name="threads_readonly" value="{{ isset($campaign_data['threads']) ? $campaign_data['threads'] : '1' }}"  required />
                                                                        <input type="hidden" name="threads" value="{{ isset($campaign_data['threads']) ? $campaign_data['threads'] : '1' }}">
                                                                        <span id="thread_numbermsg" style="color:red"> <span>
                                                                    </div>
                                                                </div>
                                                                @else
                                                                    <input type="hidden" class="form-control" name="threads" value="1">
                                                                    <input type="hidden" class="form-control" name="threads_readonly" value="1">
                                                                @endif
                                                                <div class="form-group row" data-name="SJTgWgTR">
                                                                    <div class="col-md-12" data-name="NfayfMvD">
                                                                        <div class="row" data-name="emlmRFVE">
                                                                            <label class="col-form-label col-md-4 text-left">{{trans('schedule_broadcast.add_new.tab4.form.hourly_speed_limit')}}
                                                                                 {!! popover( 'schedule_broadcast.add_new.tab4.form.hourly_speed_limit_help','common.description' ) !!}
                                                                            </label>
                                                                            @if(isset($campaign_data['hourly_speed']))
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox" checked="checked" name="hourly_speed_switch" id="hourly-speed-switch">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @else
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox" name="hourly_speed_switch" id="hourly-speed-switch">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                @if(isset($campaign_data['hourly_speed']))
                                                                <div class="form-group row" id="hourly_speed" data-name="LRuwDMkY">
                                                                @else
                                                                <div class="form-group row" style="display: none;" id="hourly_speed" data-name="DSbZPzrc">
                                                                @endif
                                                                    <div class="col-md-12" data-name="AzrTgKGA">
                                                                       
                                                                        <div class="row" data-name="ZTpqCjnp">
                                                                            <div class="col-md-6" data-name="OTXhmMDS">
                                                                                <div class="lshapeBlk" data-name="yefDaMCV"><i class="la la-level-down lshap"></i></div><div class="lshBlksl" data-name="OcfMeoFl" style="padding-left: 35px;"><input type="text" class="form-control" name="hourly_speed" value="{{ isset($campaign_data['hourly_speed']) ? $campaign_data['hourly_speed'] : '-1' }}"  required /></div>
                                                                            </div>
                                                                        </div> 
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="mpIXQltV">
                                                                    <div class="col-md-12" data-name="MJDNAywm">
                                                                        <div class="row" data-name="BCkxRGFA">
                                                                            <label class="col-form-label col-md-4 text-left">{{trans('common.label.embed_unsubscribe_link')}}
                                                                                {!! popover( 'common.label.embed_unsubscribe_link_help','common.description' ) !!}
                                                                            </label>
                                                                            @if(!empty($campaign_data['unsub_show']))
                                                                                @if($campaign_data['unsub_show'] == 0)
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-3">
                                                                                    <label>
                                                                                        <input type="checkbox" name="unsub_show" id="unsub_show">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                                                @else
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-3">
                                                                                    <label>
                                                                                        <input type="checkbox" checked="checked" name="unsub_show" id="unsub_show">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                                                @endif
                                                                            @else
                                                                            @php
                                                                                $unsubscribe_link = getSetting("unsubscribe_link");
                                                                            @endphp
                                                                            @if($unsubscribe_link == 'on') 
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-3">
                                                                                <label>
                                                                                    <input type="checkbox" checked="checked" name="unsub_show" id="unsub_show">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @else 
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-3">
                                                                                <label>
                                                                                    <input type="checkbox" name="unsub_show" id="unsub_show">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @endif
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="form-group row" data-name="JHLmbKPt">
                                                                    <div class="col-md-12" data-name="tKJUcXpU">
                                                                        <div class="row" data-name="nDYwCNJK">
                                                                            <label class="col-form-label col-md-4 text-left">{{trans('common.label.track_opens')}}
                                                                                 {!! popover( 'common.label.track_opens_help','common.description' ) !!}
                                                                            </label>
                                                                            @if(isset($campaign_data['track_opens']) && $campaign_data['track_opens'] == 0)
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox" {{ trackingStatus() }} name="track_opens" id="track_opens">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @else
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox" {{ trackingStatus() }} checked="checked" name="track_opens" id="track_opens">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                            
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="hyzLSued">
                                                                    <div class="col-md-12" data-name="MmPzuIIx">
                                                                        <div class="row" data-name="gHpWEODG">
                                                                            <label class="col-form-label col-md-4 text-left">{{trans('common.label.track_clicks')}}
                                                                                {!! popover( 'common.label.track_clicks_help','common.description' ) !!}
                                                                            </label>
                                                                            @if(isset($campaign_data['track_clicks']) && $campaign_data['track_clicks'] == 0)
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox" {{ trackingStatus() }} name="track_clicks" id="track_clicks">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @else
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox" {{ trackingStatus() }} checked="checked" name="track_clicks" id="track_clicks">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @endif
                                                                        </div>
                                                                            
                                                                    </div>
                                                                </div>
                                                               
                                                                    <!-- List Unsubscribed --> 
                                                               <div class="form-group row" data-name="leGBttYg">
                                                                    <div class="col-md-12" data-name="zOBJflfY">
                                                                        <div class="row" data-name="zxUqgGTZ">
                                                                            <label class="col-form-label col-md-4 text-left">{{trans('schedule_broadcast.add_new.tab4.form.skip_duplicate')}}
                                                                                {!! popover( 'schedule_broadcast.add_new.tab4.form.skip_duplicate_help','common.description' ) !!}
                                                                            </label>
                                                                            @if(isset($campaign_data['track_duplicate']) && $campaign_data['track_duplicate'] == 0)
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox" name="track_duplicate" id="track_duplicate">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @else
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                    <label>
                                                                                        <input type="checkbox"  checked="checked" name="track_duplicate" id="track_duplicate">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                            
                                                                    </div>  
                                                                </div>

                                                                @php 
                                                                    $allow_sending_email_unconfirmed = getSetting("allow_sending_email_unconfirmed");
                                                                @endphp
                                                                @if($allow_sending_email_unconfirmed  != "on")
                                                                
                                                                <div class="form-group row" data-name="JqaElnGH">
                                                                    <div class="col-md-12" data-name="PoPnjsHN">
                                                                        <div class="row" data-name="MOseVyLY">
                                                                            <label class="col-form-label col-md-4 text-left">{{trans('schedule_broadcast.add_new.tab4.form.skip_unconfirmed')}}
                                                                                {!! popover( 'schedule_broadcast.add_new.tab4.form.skip_unconfirmed_desc','common.description' ) !!}
                                                                            </label>
                                                                                    @if(empty($custom_info) || (!empty($custom_info['skip_unconfirmed']) AND $custom_info['skip_unconfirmed'] == "on"))
                                                                                
                                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                            <label>
                                                                                                <input type="checkbox"  checked="checked"  name="skip_unconfirmed" id="skip_unconfirmed">
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </span>
                                                                                    @else
                                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                                <label>
                                                                                                    <input type="checkbox"  name="skip_unconfirmed" id="skip_unconfirmed">
                                                                                                    <span></span>
                                                                                                </label>
                                                                                            </span>
                                                                                    @endif
                                                                        </div>
                                                                            
                                                                    </div>  
                                                                </div>

                                                                @else
                                                                <input style="display:none;" type="checkbox"  checked="checked"  name="skip_unconfirmed" id="skip_unconfirmed">
                                                                @endif

                                                                <div class="form-group row" data-name="pXsdYORF"> 
                                                                    <div class="col-md-12" data-name="uWhTGdbD">
                                                                        <div class="row" data-name="YvcmfCTM">

                                                                            <label class="col-form-label col-md-4 text-left">{{trans('schedule_broadcast.add_new.tab4.form.list_unsubscribe_header')}}
                                                                            </label>
                                                                            @if(!empty($campaign_data['unsubscribe_header']) and $campaign_data['unsubscribe_header'] == 1)
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox"  checked="checked"  name="unsubscribe_header" id="unsubscribe_header">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @else
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                    <label>
                                                                                        <input type="checkbox"name="unsubscribe_header" id="unsubscribe_header">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div> 


                                                                <?php 
                                                                    $header_unsubscribe_email = "";
                                                                    $unsubscribe_link = "";
                                                                    $applciation_settings =  getApplicationSettings();
                                                                    if (!empty($applciation_settings['header_unsubscribe_email']))
                                                                        $header_unsubscribe_email = $applciation_settings['header_unsubscribe_email'];
                                                                    if (!empty($applciation_settings['unsubscribe_link']))
                                                                        $unsubscribe_link = $applciation_settings['unsubscribe_link'];
                                                                ?>
                                                                

                                                                <div class="form-group row listUnsubscribe bulltOpt" data-name="iNkYMWbi"> 
                                                                    <div class="lshapeBlk" data-name="DwcoSGpQ"><i class="la la-level-down lshap"></i></div>
                                                                    <div class="col-md-12" data-name="RYAFgSYC">
                                                                        <div class="row admin_filter mt0" data-name="TuIJeCUM">
                                                                            <label class="col-form-label col-md-4 text-left"> {{trans('common.label.unsubscribe_link')}}
                                                                                 {!! popover('common.label.unsubscribe_link_help','common.description') !!}
                                                                            </label>
                                                                            @if(!empty($custom_info['unsubscribe_link']) OR  $unsubscribe_link == "on") 
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                <label>
                                                                                    <input type="checkbox"  checked="checked"  name="unsubscribe_link" id="unsubscribe_link">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @else
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                    <label>
                                                                                        <input type="checkbox"name="unsubscribe_link" id="unsubscribe_link">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div> 

                                                                <div class="form-group row listUnsubscribe bulltOpt" data-name="bnGIKcLz" >
                                                                    <div class="lshapeBlk" data-name="xpxUhXUn"><i class="la la-level-down lshap"></i></div> 
                                                                    <div class="col-md-12" data-name="POPGJgSR">
                                                                        <div class="row admin_filter mt0" data-name="mDKiJwgw">
                                                                            <label class="col-form-label col-md-4 text-left">
                                                                            {{trans('common.label.unsubscribe_email')}} 
                                                                                 {!! popover('common.label.unsubscribe_email_help','common.description') !!}
                                                                            </label>
                                                                            @if(!empty($custom_info['unsubscribe_by_email']) OR !empty($header_unsubscribe_email)) 
                                                                           
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                <label>
                                                                                    <input type="checkbox"  checked="checked"  name="unsubscribe_by_email" id="unsubscribe_by_email">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                            @else
                                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                    <label>
                                                                                        <input type="checkbox"name="unsubscribe_by_email" id="unsubscribe_by_email">
                                                                                        <span></span>
                                                                                    </label>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                               

                                                                <div class="form-group row bulltOpt unsubscribe_header" id="unsubscribe_header_row" data-name="NhIsrjrQ">
                                                                    <div class="lshapeBlk" data-name="PcQtuymD"><i class="la la-level-down lshap"></i></div>  
                                                                    <div class="col-md-5 admin_filter mt0" data-name="nuBFEieU">
                                                                        <input type="text"name="unsubscribe_email" id="unsubscribe_email" value="{{ !empty($custom_info['unsubscribe_email']) ? $custom_info['unsubscribe_email']: $header_unsubscribe_email }}" class="form-control">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row sinfo" data-name="DpUVfNzz">
                                                                    <div class="col-md-12" data-name="RcNVwlfU">
                                                                        <div class="row">
                                                                            <label class="col-form-label col-md-4 text-left">{{trans('common.label.sender_info')}}
                                                                                    {!! popover( 'common.label.sender_info_help','common.description' ) !!}
                                                                            </label>
                                                                            <div class="kt-radio-inline col-md-8 pl18" data-name="CLJDTAaU">
                                                                                @if($form_list_p) 
                                                                                <label for="si_list" id="si_list_label" class="kt-radio kt-radio--default"><input type="radio" name="sender_option" id="si_list" value="list" {{ ($option == 'list') ? 'checked' : '' }} onclick="getSenderInformation('list')"> {{trans('common.label.from_list')}}<span></span></label> &nbsp;&nbsp;
                                                                                @endif
                                                                                @if($sending_node_p) 
                                                                                <label for="si_smtp" class="kt-radio kt-radio--default"><input type="radio" name="sender_option" id="si_smtp" value="smtp" {{ ($option == 'smtp') ? 'checked' : '' }} onclick="getSenderInformation('smtp')"> {{trans('common.label.from_smtp')}} <span></span></label> &nbsp;&nbsp;
                                                                                @endif
                                                                                @if($custom_p) 
                                                                                <label for="si_custom" class="kt-radio kt-radio--default"><input type="radio" name="sender_option" id="si_custom" value="custom" {{ ($option == 'custom') ? 'checked' : '' }} onclick="getSenderInformation('custom')"> {{trans('common.label.custom')}} <span></span></label>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" id="from_option_list" data-name="uslAMQMc">
                                                                    <div class="col-md-12" data-name="AJFOMfgW">
                                                                        <div class="row">
                                                                            <label class="col-form-label col-md-4 text-left">{{trans('schedule_broadcast.add_new.tab4.form.choose_from_name_as_listed_in_list')}}</label>
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                                <label>
                                                                                    <input type="checkbox" id="from_name_list" name="from_name_list">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" id="from_option_smtp" data-name="UvaRFpDP">
                                                                        
                                                                    <div class="col-md-12" data-name="khPYdTEV">
                                                                        <div class="row">
                                                                            <label class="col-form-label col-md-4">{{trans('schedule_broadcast.add_new.tab4.form.choose_from_name_as_listed_in_smtp')}}</label>
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                <label>
                                                                                    <input type="checkbox" id="from_name_smtp" name="from_name_smtp">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" id="from_name" style="display: none;" data-name="cPFIQlNJ">
                                                                    <div class="col-md-12" data-name="TPHIHyIJ">
                                                                        <label class="col-form-label">{{trans('common.label.from_name')}}
                                                                             {!! popover('common.label.from_name_help','common.description') !!}
                                                                        </label>
                                                                        <input type="text" class="form-control" name="from_name" value="{{ isset($custom_info['from_name']) ? $custom_info['from_name'] : '' }}" id="from-name" />
                                                                    </div>
                                                                </div>
                                                                <div id="from_option_custom" data-name="kdKgoAGN">
                                                                <div class="form-group row" data-name="qDPPwOrF">
                                                                        
                                                                    <div class="col-md-12" data-name="cZfffBLK">
                                                                        <label class="col-form-label">{{trans('common.label.from_email')}}
                                                                                {!! popover('common.label.from_email_help','common.description') !!}
                                                                        </label>
                                                                        <?php 
                                                                            $form_email_part1 = "";
                                                                            $form_email_part2 = "";
                                                                            if(!empty($custom_info['from_email'])) { 
                                                                                $form_email_parts = explode("@" , $custom_info['from_email']);
                                                                                if(!empty($form_email_parts[1])) { 
                                                                                    $form_email_part1 = $form_email_parts[0];
                                                                                    $form_email_part2 = $form_email_parts[1];
                                                                                }
                                                                            }

                                                                        ?>
                                                                        <div class="row from-email" data-name="KNkbhfBy">
                                                                            <div class="col-md-5" data-name="ZhvekEVe">
                                                                                <div class="input-group" data-name="YFFHeaWB">
                                                                                    <input type="text" class="form-control" id="from_email_part1" name="from_email_part1" value="{{ isset($custom_info['from_email']) ? $form_email_part1 : '' }}" />                                                                           
                                                                                    <div class="input-group-append" data-name="GFfHaRSs">
                                                                                        <span class="input-group-text" id="basic-addon2">@</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>    
                                                                            <div class="col-md-7" data-name="myHAqkat">
                                                                                <select class="form-control m-select2" data-placeholder="Choose Email Domain" name="from_email_part2">
                                                                                    
                                                                                    <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); 
                                                                                        $from_email_part2 = "";
                                                                                    ?>
                                                                                    @php $disableFlag = 0; @endphp
                                                                                    <optgroup label="{{trans('lists.eligible_domains')}}">
                                                                                    @foreach($domain_maskings as $domain)
                                                                                        @php
                                                                                            isset($from_email_part2) ? '@'.$from_email_part2 : '';
                                                                                            $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                                            $replace = '';
                                                                                            $subdomain = str_replace($order, $replace, $domain->domain);
                                                                                        @endphp

                                                                                        @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                                                        <option {{isset($owner_email_part2) && $owner_email_part2==$subdomain ? 'selected' :'' }} value="{{ '@' . $subdomain }}">{{ $subdomain }}</option>
                                                                                        @else 
                                                                                            @php 
                                                                                            $disableTxt = "inactive";
                                                                                                            if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                                                                            if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                                                            
                                                                                            @endphp
                                                                                            @php $disableFlag = 1; @endphp 
                                                                                        @endif
                                                                                    @endforeach
                                                                                    </optgroup>
                                                                                    @if($disableFlag)
                                                                                    <optgroup label="{{trans('lists.ineligible_domains')}}">
                                                                                    @foreach($domain_maskings as $domain)
                                                                                        @php
                                                                                            isset($from_email_part2) ? '@'.$from_email_part2 : '';
                                                                                            $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                                            $replace = '';
                                                                                            $subdomain = str_replace($order, $replace, $domain->domain);
                                                                                        @endphp

                                                                                        @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                                                        
                                                                                        @else 
                                                                                            @php 
                                                                                            $disableTxt = "inactive";
                                                                                                            if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                                                                            if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                                                            
                                                                                            @endphp
                                                                                                <option disabled @if(!empty($from_email_part2) and $from_email_part2 == $domain->domain) selected @endif value="{{ '@' . $subdomain }}">{{ $subdomain }} <small>({{$disableTxt}}) </small></option>
                                                                                        @endif
                                                                                    @endforeach
                                                                                    </optgroup>
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>        
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                    $license_attributes = json_decode(getSetting("license_attributes"), true);
                                                                    $license_type = "";
                                                                    if(!empty($license_attributes["package"])) { 
                                                                        $license_type = $license_attributes["package"];
                                                                    }
                                                                    $imap_switch = getApplicationSettings('imap_switch');
                                                                    if($license_type != "Commercial ESP" OR $imap_switch != 2) { 
                                                                ?>
                                                                <div class="form-group row" data-name="MXwHOeVK">
                                                                        
                                                                    <div class="col-md-12" data-name="cNCyqCTN">
                                                                        <label class="col-form-label">{{trans('common.label.bounce_email')}}
                                                                                {!! popover('common.label.bounce_email_help','common.description') !!}
                                                                        </label>
                                                                        <select class="form-control m-select2" data-placeholder="Choose Bounce Handler" name="bounce_email" id="bounce-id">
                                                                            @foreach($bounce_emails as $bounce_email)
                                                                                <option value="{{ $bounce_email->name }}" {{ (isset($custom_info['bounce_email']) && $custom_info['bounce_email'] == $bounce_email->id) ? 'selected' : '' }}>{{ $bounce_email->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                                <div class="form-group row" data-name="yOAjAXMR">
                                                                        
                                                                    <div class="col-md-12" data-name="HVnuUxyh">
                                                                        <label class="col-form-label">{{trans('common.label.reply_email')}}
                                                                                {!! popover('common.label.reply_email_help','common.description') !!}
                                                                        </label>
                                                                        <input type="email" class="form-control" name="reply_email" value="{{ isset($custom_info['reply_email']) ? $custom_info['reply_email'] : '' }}" />
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        <div class="form-group row" data-name="xxcDpkjO">    
                                                            <div class="col-md-12" data-name="lfFFMpGR">
                                                                <div class="row">
                                                                    <label class="col-form-label text-left col-md-4" for="overwrite_subject"> {{trans('broadcasts.schedule_blade.new_subject_line_label')}}
                                                                    </label>
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success col-md-6">
                                                                        <label>
                                                                            <input type="checkbox" name="overwrite_subject" id="overwrite_subject" {{ isset($custom_info['overwrite_subject']) && $custom_info['overwrite_subject']=="on" ? "checked" : '' }}>
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12 mb15" id="subject_field" style="display: none;" data-name="mYYqlKvm">
                                                                <label class="col-form-label">{{trans('broadcasts.schedule_blade.new_subject_line_label')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Your broadcast subject will be replaced by the given subject line." data-original-title="New Subject Line"></i>
                                                                </label>
                                                                <input value="{{ !empty($custom_info['subject_line']) ? $custom_info['subject_line'] : '' }}" type="text" name="preview_subject" class="form-control" />
                                                            </div>
                                                        </div>

                                                        <div class="form-group row previewBlk" data-name="eUGQOtpx">
                                                            <div class="col-md-12" data-name="hZWOVmUu">
                                                                <label class="col-form-label">{{trans('broadcasts.send_preview.form.send_test_preview')}} <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="A preview of the broadcast will be sent to the given email address." data-original-title="{{trans('broadcasts.send_preview.form.send_test_preview')}}"></i>
                                                                </label>
                                                            </div>
                                                            <div class="col-md-12 test-email-blk" data-name="NhHozzAA">
                                                                <span><input placeholder="Email Address" type="text" name="preview_email" id="preview_email_input" class="form-control" value=""/></span>
                                                                <button onclick="previewScheduleEmail();" type="button" id="preview-campaign" class="btn btn-info"><i class="fa fa-paper-plane"></i></button>                                                           
                                                                <small style="padding: 5px"> {{trans('drip_campaigns.add_new.tab3.system_variable')}}</small>
                                                            </div>
                                                                
                                                            <div class="col-md-12" data-name="rjeshkUm">
                                                                <span id="mail-sent-msg"></span>
                                                            </div>
                                                        </div>
                                                           
                                                            @if(isset($campaign_data['notification_email']) && !empty($campaign_data['notification_email']))
                                                            <div class="form-group row" id="notification_email" data-name="JuqcDwEG">
                                                                @else
                                                            <div class="form-group row" id="notification_email" style="display: none;" data-name="ByRNjEWc">
                                                                @endif
                                                                <div class="col-md-12" data-name="QSpglfmw">
                                                                    <label class="col-form-label">
                                                                        {{trans('common.label.email')}}
                                                                    </label>
                                                                    <input type="text" id="email" class="form-control" name="notification_email" value="{{ isset($campaign_data['notification_email']) ? $campaign_data['notification_email'] : '' }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="kt-form__actions" data-name="eOgHRvgW">
                                            <div class="btn btn-secondary btn-md" data-ktwizard-type="action-prev" data-name="bzxOzBkv">
                                                {{trans('common.form.buttons.back')}}
                                            </div>
                                            @if(config('app.type') !="demo") 
                                            <div class="btn btn-success btn-md" data-ktwizard-type="action-submit" data-name="MTSlKMYZ">
                                                {{trans('common.form.buttons.submit')}}
                                            </div>
                                            @endif
                                            <div class="btn btn-success btn-md" data-ktwizard-type="action-next" data-name="vPTheWZh">
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

<!--begin::Modal-->
<div class="modal fade" id="start" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="RDHrIEkm">
    <div class="modal-dialog" role="document" data-name="fCSxiYPk">
        <div class="modal-content" data-name="EpJbwwzL">
            <div class="modal-body text-center" data-name="kijgpudz">
                <button type="button" class="close movetostep1" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                <h3 class="text-center">{{trans('broadcasts.schedule_blade.opsss_heading')}}</h3>
                <p class="text-center contactZero">{{trans('broadcasts.schedule_blade.scheduling_broadcast_para')}}</p>
                <p class="text-center listZero">{{trans('broadcasts.schedule_blade.scheduling_broadcast_list_zero')}}</p>
                <button type="button"  class="btn btn-success btn-sm movetostep1">{{trans('broadcasts.schedule_blade.schedule_again_button')}}</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

<div id="preloader" style="display: none;" data-name="dIlFHKDT">
    <div data-loader="circle-side" style="display: block;" data-name="gyUmUrVU"></div>
</div>
@endsection