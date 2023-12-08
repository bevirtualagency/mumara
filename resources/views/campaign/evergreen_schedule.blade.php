@extends('layouts.master2')

@section('title', trans('app.sidebar.schedule'))

@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .bootstrap-switch.bootstrap-switch-disabled .bootstrap-switch-handle-on, .bootstrap-switch.bootstrap-switch-disabled .bootstrap-switch-label {
        cursor: not-allowed !important;
    }
    .pt5 {
        padding-top: 5px;
    }
    @media(max-width: 767px) {
        button.fa.fa-question {
        margin-left: 15px;
        margin-top: 10px;
        }
        .input-group.input-medium.date.date-picker {
            margin-bottom: 10px;
        }
        .col-md-4 .portlet {
            margin-bottom: 0;
        }
        .datepicker.datepicker-dropdown.dropdown-menu.datepicker-orient-left.datepicker-orient-top {
            left: 32px !important;
            top: 594px !important;
        }
        .datepicker-dropdown.datepicker-orient-left:before {
            left: auto;
            right: 12px;
        }
        .datepicker-dropdown.datepicker-orient-left:after {
            left: auto;
            right: 13px;
        }
        .form-group.row .kt-radio-inline {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
    .form-wizard .progress {
        position: relative;
        overflow: visible;
        height: 10px;
    }
    .progress-bar-success {
        background-color: #34bfa3;
        position: relative;
        border-radius: .71rem;
        display: flex;
    }
    .progress-bar-success:after {
        content: '';
        float: right;
        display: block;
        position: absolute;
        width: 1.3rem;
        height: 1.3rem;
        right: -.65rem;
        border-radius: 50%;
        z-index: 1;
        top: -0.3rem;
        background-color: #34bfa3;
    }
    .form-wizard .steps>li>a.step {
        display: table !important;
        vertical-align: middle;
        line-height: 1;
        width: 100%;
    }
    .form-wizard .steps>li.active>a.step .number {
        background-color: #7ddcc9 !important;
    }

    .form-wizard .steps>li>a.step>.number {
        background-color: #e2e5ec !important;
        font-weight: bold !important;
        font-size: 18px !important;
        line-height: 1.2;
    }
    .nav-justified>li, .nav-tabs.nav-justified>li {
        width: 25%;
        display: table-cell;
        vertical-align: middle;
        text-decoration: none;
        outline: none !important;
    }
    .form-wizard .steps, .form-wizard .steps>li>a.step {
        display: table;
    }
    .form-wizard .steps>li.done>a.step .desc {
        display: table-cell;
        vertical-align: middle;
        font-weight: 500;
    }
    .form-wizard .steps>li>a .line {
        margin-left: 0.2rem;
        margin-right: 0.7rem;
        width: 2.5rem;
        height: 0.25rem;
        border-radius: .6rem;
        background-color: #e2e5ec;
        display: table-cell !important;
        float: left;
        vertical-align: middle;
        margin-top: 20px;
    }
    .form-wizard .steps>li>a .desc {
        display: table-cell;
        vertical-align: middle;
        font-weight: 600 !important;
        color: #9699a2 !important;
        font-size: 14px !important;
        letter-spacing: 1px;
        line-height: 44px;
        float: left;
    }
    .form-wizard .steps>li>a.step .number {
    //    background-color: #34bfa3 !important;
        color: #fff;
        display: table-cell !important;
        vertical-align: middle;
        text-decoration: none;
        outline: none !important;
        float: left;
    }
    .form-wizard .steps>li.done>a.step .number {
        background-color: #34bfa3 !important;
        color: #fff;
        display: table-cell;
        vertical-align: middle;
        text-decoration: none;
        outline: none !important;
        float: left;
    }
    .btn.green:not(.btn-outline) {
        color: #FFF;
        background-color: #34bfa3 !important;
        border-color: #34bfa3 !important;
    }
    .btn.green:not(.btn-outline).focus, .btn.green:not(.btn-outline):focus {
        color: #FFF;
        background-color: #28ab90 !important;
        border-color: #21a087 !important;
    }
    input[type=checkbox], input[type=radio] {
        width: 16px;
        height: 16px;
        vertical-align: sub !important;
        margin: 0;
        margin-bottom: 5px;
    }
    .form-control {
        border-color: #ebedf2;
    //    border-radius: 2px;
    }
    .form-horizontal .form-group .portlet.light.bordered {
        border-color: #ebedf2 !important;
    //    border-radius: 2px;
    }
    .form-control:focus {
        border-color: #34bfa3;
    }
    .form-horizontal .form-group .mt-radio-list {
        margin-top: 7px;
    }
    .btn-success {
        color: #fff;
        background-color: #34bfa3;
        border-color: #34bfa3;
    }

    #preloader {
        position:fixed;
        top:0;
        left:0;
        right:0;
        width:100%;
        height:100%;
        bottom:0;
        z-index:99999999999!important
    }
    #preloader {background-color:rgba(0,0,0, 0.5)}
    [data-loader=circle-side],[data-loader=circle-side-2] {
        position:absolute;
        width:50px;
        height:50px;
        top:50%;
        left:50%;
        margin-left:-25px;
        margin-top:-25px;
        -webkit-animation:circle infinite .95s linear;
        -moz-animation:circle infinite .95s linear;
        -o-animation:circle infinite .95s linear;
        animation:circle infinite .95s linear;
        border: 3px solid #34bfa3;
        border-top-color: rgba(255,255,255,.3);
        border-right-color: rgba(255,255,255,.3);
        border-bottom-color: rgba(255,255,255,.3);
        -webkit-border-radius:100%;
        -moz-border-radius:100%;
        -ms-border-radius:100%;
        border-radius:100% !important;
    }
    @-webkit-keyframes circle {
        0% {
        -webkit-transform:rotate(0);
        -moz-transform:rotate(0);
        -ms-transform:rotate(0);
        -o-transform:rotate(0);
        transform:rotate(0)
        }
        100% {
        -webkit-transform:rotate(360deg);
        -moz-transform:rotate(360deg);
        -ms-transform:rotate(360deg);
        -o-transform:rotate(360deg);
        transform:rotate(360deg)
        }
    }
    @-moz-keyframes circle {
        0% {
        -webkit-transform:rotate(0);
        -moz-transform:rotate(0);
        -ms-transform:rotate(0);
        -o-transform:rotate(0);
        transform:rotate(0)
        }
        100% {
        -webkit-transform:rotate(360deg);
        -moz-transform:rotate(360deg);
        -ms-transform:rotate(360deg);
        -o-transform:rotate(360deg);
        transform:rotate(360deg)
        }
    }
    @-o-keyframes circle {
        0% {
        -webkit-transform:rotate(0);
        -moz-transform:rotate(0);
        -ms-transform:rotate(0);
        -o-transform:rotate(0);
        transform:rotate(0)
        }
        100% {
        -webkit-transform:rotate(360deg);
        -moz-transform:rotate(360deg);
        -ms-transform:rotate(360deg);
        -o-transform:rotate(360deg);
        transform:rotate(360deg)
        }
    }
    @keyframes  circle {
        0% {
        -webkit-transform:rotate(0);
        -moz-transform:rotate(0);
        -ms-transform:rotate(0);
        -o-transform:rotate(0);
        transform:rotate(0)
        }
        100% {
        -webkit-transform:rotate(360deg);
        -moz-transform:rotate(360deg);
        -ms-transform:rotate(360deg);
        -o-transform:rotate(360deg);
        transform:rotate(360deg)
        }
    }
    input[type=checkbox] {
        margin: 0;
        vertical-align: middle !important;
    }
    label.parentList {
        font-weight: bold;
        vertical-align: top;
        line-height: 1.5;
    }
    label.childList {
        margin: 0;
        vertical-align: middle;
        margin-left: 5px;
    }
    .input-icon.right {
        margin-top: 12px;
    }
    .scList .input-icon.right:first-child {
        margin-top: 0;
    }
    .scList .input-icon.right {
        line-height: 1.5 !important;
    }
    .scList .input-icon.right label.parentList {
        line-height: 1.5;
    }
    span#counting {
        position: absolute;
        right: 15px;
        bottom: 25px;
        padding: 4px 12px;
    }
    .kt-checkbox-list .kt-checkbox div {
        position: relative;
        display: inline-block;
    }
    .kt-checkbox-list .kt-checkbox .countsload {
        display: none;
    }
    .kt-portlet.kt-portlet--height-fluid.kt-scroll, 
    .kt-portlet.kt-portlet--height-fluid.scroll {
        border: 1px solid #ebedf2;
        border-radius: 4px;
        box-shadow: 0 0 0 transparent;
    }
    .kt-scroll .kt-checkbox-list, 
    .scroll .kt-checkbox-list {
        padding-top: 0;
        padding-bottom: 0;
    }
    /***************************************/
    .kt-wizard-v4 .kt-wizard-v4__nav .kt-wizard-v4__nav-items .kt-wizard-v4__nav-item[data-ktwizard-state="current"] .kt-wizard-v4__nav-body .kt-wizard-v4__nav-number {
        color: #ffffff;
        background-color: #1caf9a;
    }
    .kt-wizard-v4 .kt-wizard-v4__nav .kt-wizard-v4__nav-items .kt-wizard-v4__nav-item[data-ktwizard-state="current"] .kt-wizard-v4__nav-body .kt-wizard-v4__nav-label .kt-wizard-v4__nav-label-title {
        color: #1caf9a;
    }
    .kt-wizard-v4 .kt-wizard-v4__nav .kt-wizard-v4__nav-items .kt-wizard-v4__nav-item .kt-wizard-v4__nav-body .kt-wizard-v4__nav-number {
        background-color: rgba(28, 175, 154, 0.08);
        color: #1caf9a;
    }
    .form-group.is-invalid .select2-container--default .select2-selection--single {
        border-color: #e73d4a;
    }
    .customFields .col-md-6 {
        display: inline-block;
        -webkit-box-flex: 0;
        -ms-flex: 0 0 66.66667%;
        flex: 0 0 66.66667%;
        max-width: 66.66667%;
    }
    .select2-container--default .select2-results__option .select2-results__option {
        padding: 5px 15px;
    }
    .customFields .col-md-6 ul.dropdown-menu {
        max-height: 300px;
        overflow: overlay;
        width: 220px;
    }
    .kt-checkbox-list {
        padding: 0;
    }
    .form-group.row .kt-radio-inline {
        margin-top: 0;
    }
    .form-group.row.rd .kt-radio-inline {
        padding-top: 9px;
    }
    .form-group.sinfo .kt-radio-inline {
        margin-top: 0.75rem;
    }
    .show > .btn.btn-default i, .btn.btn-default.active i, .btn.btn-default:active i, .btn.btn-default:hover i {
        color: #ffffff !important;
    }
    .display-none { 
        display:none !important;
    }
    table.dataTable td, table.dataTable th {
        text-align:center !important
    }
    #custom-fields tr th:nth-child(3), #custom-fields tr td:nth-child(3), #custom-fields tr th:nth-child(4), #custom-fields tr td:nth-child(4) {
        min-width: 120px;
    }

    #custom-fields tr th:nth-child(2), #custom-fields tr td:nth-child(2) {
        min-width: 250px;
        text-align: left !important;
        white-space:normal !important;
        word-break: break-all;
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
<script src="/public/js/evergreen-schedule.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
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
                    $(".counts").css("display", "inline-block");
                    $("a.button-next").removeAttr("disabled", "disabled");                    
                    $("#counting").attr('disabled',false);
                    segment_count_start= 0;
                }else{
                    segment_count_start= 1;
                }

            }
        });
    }
    
    
    $(document).ready(function() {

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

        $('#send_time, #sending_time').timepicker({
            minuteStep: 1,
            showSeconds: true,
            showMeridian: false,
            snapToStep: true
        });
        $('#send_date').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
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
    });
    
    function getListSegmentSplittestArea(section)
    {
        $("div.desc").hide();
        $("#"+section).show();
        if(section == "segment"){
            $("#si_list").attr("disabled", "disabled");
            $("#si_list").hide();
            $("#si_list_label").hide();
            $("#from_option_list").hide();
        }else{
            $("#si_list").removeAttr("disabled");
            $("#si_list").show();
            $("#si_list_label").show();
        //    $("#from_option_list").show();
        }
    }

    function getSegmentList()
    {
        //split_test
        var section = $('#campaign_type').val();
        if(section == 'split_test'){
            $("div.desc").hide();
            $("#"+section).show();
            $("#campaign_type_remaining").hide();
            $("#type").attr("disabled","disabled");
        }else{
            var section = 'regular';
            $("#"+section).hide();
            $("#split_test").hide();
            $("#subscriber").show();
            $("#campaign_type_remaining").show();
            $("#type").removeAttr("disabled");
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
            if ( $("#from-name").val() != '' ) {
                $("#from_name_list").prop('checked', false);
                $('#from_name').show();
            }else{
                $("#from_name_list").prop('checked', true);
                $('#from_name').hide();
            }
            $('#from_option_list').show();
            $('#from_option_smtp').hide();
            $('#from_option_custom').hide();
        } else if (value == 'smtp') {
            if ( $("#from-name").val() != '' ) {
                $("#from_name_smtp").prop('checked', false);
                $('#from_name').show();
            }else{
                $("#from_name_smtp").prop('checked', true);
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
        if (val == 'monthly') {
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
    $(".split_type").click(function(){
       list_campaign  =$(this).attr('data');

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
            $("#from_name").show();
        }else if(state == true){
            $("#from_name").hide();
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
</script>
@endsection

@section('content')

@if (Session::has('msg'))
<div class="alert alert-success" data-name="jyKbBCgD">
    {{ Session::get('msg') }}
</div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="mGwuBfQk">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="lMjuHFsY">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>


<div class="row" data-name="EZBsKdUH">
    <div class="col-md-12" data-name="ptoCgnrb">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="QBAClnpb">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="VPHNJHCq">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="OXcmxgxW">
                    <div class="kt-wizard-v4__nav-items" data-name="hlnGngAs">
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="wcaCYzuG">
                                <div class="kt-wizard-v4__nav-number" data-name="XNpXtBLO">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="myFsKerJ">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="KpDLaeIP">
                                        {{trans('app.dashboard.lang.setup')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="fbNpICpk">
                                        {{ trans('app.dashboard.lang.campaign_setup') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="cTgvmkjl">
                                <div class="kt-wizard-v4__nav-number" data-name="IFwYlNXz">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="pUFWrOtS">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="PevxNMBE">
                                        {{trans('app.dashboard.lang.type')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="oUlUoKOW">
                                        {{ trans('app.schedule_broadcast.setup_type') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="VmcqfdiS">
                                <div class="kt-wizard-v4__nav-number" data-name="oPDuqEmz">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="LkURnSkO">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="JQkrlXoT">
                                        {{trans('app.dashboard.lang.sender')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="YqzZLSbW">
                                        {{ trans('app.schedule_broadcast.sender_detail') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="fwzaImMf">
                                <div class="kt-wizard-v4__nav-number" data-name="eqjgauJc">
                                    4
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="UDKyyjyZ">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="zaGEvPml">
                                        {{trans('app.dashboard.lang.settings')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="rGICreza">
                                        {{ trans('app.schedule_broadcast.final_setting') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="kt-portlet form" data-name="dmafkVHI">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="iFbQSlmv">
                        <div class="kt-grid" data-name="mUhkDgFV">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="uWitXfRC">
                                <form action="{{ route('broadcast.evergreen.store') }}" class="kt-form kt-form--label-right" id="submit_form" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-wizard" data-name="tTAUSogf">
                                        <div class="form-body" data-name="IAyHzODf">

                                            <div class="tab-content" data-name="kzbiIbFk">
                                                <div class="alert alert-danger display-none" data-name="dUAGqKkT">
                                                    <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} 
                                                </div>
                                                <div class="alert alert-success display-none" data-name="vyKPOmci">
                                                    <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} 
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="PcOjyGwi">
                                                    <div class="kt-form__section kt-form__section--first" data-name="BuhSTJuG">
                                                        <div class="kt-wizard-v4__form" data-name="NophgivE">
                                                            <div class="form-group row" data-name="ZScCLjdj">
                                                                <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.schedule_label')}}
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                    <div class="col-md-8" data-name="VTxnasqH">
                                                                    @if(isset($saved_criteria) && $saved_criteria == 1)
                                                                    <a href="{{ route('broadcasts.saved.criteria') }}" title="{{trans('app.actions.schedule.add.schedule_label_title')}}"><i class="fa fa-floppy-o fa-2x"></i></a>
                                                                    @endif
                                                                        <input type="text" class="form-control" name="name" value="{{ isset($campaign_data['name']) ? $campaign_data['name'] : '' }}" required />
                                                                    </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.schedule_label_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                            </div>
                                                            <div class="form-group row" data-name="iGIaSBhu">
                                                                <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.campaign_type')}}
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                    <div class="col-md-8" data-name="LIGfOqbT">
                                                                        <select class="form-control m-select2" name="campaign_type" id="campaign_type" onChange="getSegmentList()"> >
                                                                        @if(isset($campaign_data['campaign_type']) && $campaign_data['campaign_type'] == 'evergreen')


                                                                            <option value="evergreen" selected>
                                                                                {{trans('app.dashboard.lang.evergreen')}}
                                                                            </option>

                                                                        @else

                                                                            <option value="evergreen">{{trans('app.dashboard.lang.evergreen')}}</option>


                                                                        @endif
                                                                        </select>
                                                                    </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.campaign_type_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                            </div>
                                                            <div class="form-group row" id="campaign_type_remaining" data-name="GpkVmilG">
                                                                <label class="col-form-label col-md-3">
                                                                </label>
                                                                    <div class="col-md-8 pt5 kt-radio-inline" data-name="WPznvNcE">
                                                                        <label for="type" class="kt-radio kt-radio--default">
                                                                            <input type="radio" name="type" id="type" value="subscriber" {{ ($campaign_data['type'] == 'subscriber') ? 'checked' : '' }} onclick="getListSegmentSplittestArea('subscriber')"> {{trans('app.dashboard.lang.contact_lists')}}
                                                                            <span></span>
                                                                        </label>
                                                                        &nbsp;&nbsp;
                                                                    @if(moduleCheck('segments'))
                                                                        <label for="type2" class="kt-radio kt-radio--default">
                                                                            <input type="radio" name="type" id="type2" value="segment" {{ ($campaign_data['type'] == 'segment')? 'checked' : '' }} onclick="getListSegmentSplittestArea('segment')"> {{trans('app.dashboard.lang.segments')}}
                                                                            <span></span>
                                                                        </label>&nbsp;&nbsp;
                                                                    @endif
                                                                     
                                                                    </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.campaign_type_help2')}}" data-original-title="{{trans('common.description')}}"></i>
                                                            </div>
                                                            <div id="subscriber" class="desc" data-name="oRazqEiM">
                                                                <div class="form-group row" data-name="MGLHcOdj">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.contact_list')}}
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-8" data-name="ZNRErmEm">
                                                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="dSSWxKzX">
                                                                            <div class="kt-portlet__body scList" data-name="NqQHrLBa">
                                                                                @if($lists_count > 0)
                                                                                @foreach ($list_tree as $group_metadata)
                                                                                    <div class="kt-checkbox-list" data-name="AwTtbYOf">
                                                                                        <label for="{{ $group_metadata['id'] }}" class="kt-checkbox parentList">
                                                                                            <input class="group-selector-subscriber" type="checkbox" value="" id="{{ $group_metadata['id'] }}" name="list_group_tab1[]">  {{ $group_metadata['name'] }} 
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    @foreach ($group_metadata['children'] as $list_metadata)
                                                                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="OXaxmSDP">
                                                                                            <label for="l_{{$list_metadata['id']}}" class="kt-checkbox childList">
                                                                                                <input id="l_{{$list_metadata['id']}}" type="checkbox" value="{{ $list_metadata['id'] }}" name="list_ids[]" required class="group-subscriber-{{ $group_metadata['id'] }}" {{ isset($campaign_data['list_ids']) && in_array($list_metadata['id'], explode(',', $campaign_data['list_ids'])) ? 'checked' : '' }}> {{ $list_metadata['name'] }} 
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @endforeach
                                                                                @else
                                                                                <div data-name="ggMBkwtx">
                                                                                    <input type="checkbox" name="list_iddd" value="" required onclick="return false;" onkeydown="return false;">
                                                                                    {{trans('app.dashboard.lang.note_no_list_found')}} <br/>
                                                                                    <a href="/list/create">{{trans('app.actions.schedule.add.create_one_here')}}</a>
                                                                                </div>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.contact_list_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                            </div>
                                                            @if(moduleCheck('segments'))
                                                            <div id="segment" class="desc" style="display: none;" data-name="RbvkMRvg">
                                                                <div class="form-group row" data-name="icjSXhuw">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.segment_list')}}
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-8" data-name="VBywfWZv">
                                                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="IKyzFIoD">
                                                                            <div class="kt-portlet__body scList" data-name="mFOhycpB">
                                                                                @foreach($segments as $segment)
                                                                                    <div class="kt-checkbox-list" data-name="LxDkFpXQ">
                                                                                        <label class="kt-checkbox childList">
                                                                                            <input id="s_{{$segment->id}}" type="checkbox" value="{{$segment->id}}" name="segment_ids[]" required {{ isset($campaign_data['segment_ids']) && in_array($segment->id, explode(',', $campaign_data['segment_ids'])) ? 'checked' : '' }} />  {{$segment->name}} <div class="counts" id="chk_{{$segment->id}}" data-name="QCPNmjjB">({{ $segment['total'] }})</div> <div class="countsload" data-name="omuVFHMs"><i class="fa-spin la la-refresh"></i></div>
                                                                                        <span></span> 
                                                                                        </label>
                                                                                    </div>
                                                                                @endforeach
                                                                                <span id="counting" class="btn btn-default btn-xs">
                                                                                    <i class="flaticon2-reload"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.segment_list_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @if(moduleCheck('split_tests'))
                                                            <div id="split_test" class="desc" style="display: none;" data-name="OjWyQEgj">
                                                                <div class="form-group row" data-name="iETyLthT">
                                                                <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.split_test_list')}}
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8" data-name="KSdsxkoi">
                                                                    <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="SluozqzR">
                                                                        <div class="kt-portlet__body scList" data-name="JWaaDuqh">
                                                                            @foreach($split_tests as $split_test)
                                                                                <div class="kt-radio-list" data-name="IUhdGyll">
                                                                                    <label for="split-test_{{$split_test->id}}" class="kt-radio"><input type="radio" value="{{$split_test->id}}" id="split-test_{{$split_test->id}}" class="split_type" data="{{$split_test->test_on}}" name="split_test_ids[]" required {{ isset($campaign_data['split_test_ids']) && in_array($split_test->id, explode(',', $campaign_data['split_test_ids'])) ? 'checked' : '' }} />
                                                                                    {{$split_test->name}} <span></span></label> 
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="npbuSDwt">
                                                    <div class="kt-form__section kt-form__section--first" data-name="jsfrzzJE">
                                                        <div class="kt-wizard-v4__form" data-name="FzFgtjFU">
                                                            <div class="form-group row campaing-split-test" id="campaigns-tab2" data-name="tTUBPgXS">
                                                                <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.campaign_list')}}
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8" data-name="DLlxXlME">
                                                                    <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="DKdZdvfI">
                                                                        <div class="kt-portlet__body scList" data-name="JSKzWVTR">
                                                                            <div class="kt-checkbox-list" data-name="CIOkWrrQ">
                                                                                <label for="sall_1" class="kt-checkbox">
                                                                                    <input type="checkbox" id="sall_1" class="checkbox-index checkbox-all-index"><b>{{trans('common.label.select_all')}} </b>
                                                                                    <span>
                                                                                </label>
                                                                            </div>
                                                                            @foreach ($campaign_tree as $group_metadata)
                                                                                <div class="kt-checkbox-list" data-name="qSMTtwxu">
                                                                                    <label for="{{ $group_metadata['id'] }}" class="kt-checkbox parentList">
                                                                                        <input class="group-selector-subscriber group-selector-campaign checkbox-index" type="checkbox" id="{{ $group_metadata['id'] }}" value="{{ $group_metadata['id'] }}" name="campaign_group[]">  {{ $group_metadata['name'] }} 
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                                @foreach ($group_metadata['children'] as $campaign_metadata)
                                                                                    <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="MJrmmcli">
                                                                                        <label for="clist_{{ $campaign_metadata['id'] }}" class="kt-checkbox childList">
                                                                                            <input type="checkbox" value="{{ $campaign_metadata['id'] }}" name="campaign_ids[]" id="clist_{{ $campaign_metadata['id'] }}" class="group-subscriber-{{ $group_metadata['id'] }} campaign_lists checkbox-index" required {{ isset($campaign_data['campaign_ids']) && in_array($campaign_metadata['id'], explode(',', $campaign_data['campaign_ids'])) ? 'checked' : '' }}> {{ $campaign_metadata['name'] }} <span></span>
                                                                                        </label> 
                                                                                    </div>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.campaign_list_help')}}" data-original-title="{{trans('common.description')}}"></i><br><br>
                                                                <div id="campaign_disclaimer" style="display: none;" data-name="pOmbuQnW">
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.campaign_list_note')}}" data-original-title="{{trans('common.description')}}"></i></div>
                                                            </div>

                                                            <div id="lists-tab2" style="display: none;" data-name="JuImUvSx">
                                                                <div class="form-group row" data-name="GxEmjWrm">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.contact_list')}}
                                                                        <span class="required"> * </span>
                                                                    </label>
                                                                    <div class="col-md-8" data-name="ZyGPQeQA">
                                                                        <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="KNqqfXJG">
                                                                            <div class="kt-portlet__body scList" data-name="CjOFXzOo">
                                                                                @foreach ($list_tree as $group_metadata)
                                                                                    <div class="kt-checkbox-list" data-name="cenwncjv">
                                                                                        <label for="{{ $group_metadata['id'] }}" class="kt-checkbox">
                                                                                            <input class="group-selector-subscriber" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group_tab2[]"> <strong>{{ $group_metadata['name'] }}</strong> <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    @foreach ($group_metadata['children'] as $list_metadata)
                                                                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="MFyZNFKj">
                                                                                            <label for="gmg_{{ $list_metadata['id'] }}" class="kt-checkbox">
                                                                                                <input type="checkbox" id="gmg_{{ $list_metadata['id'] }}" value="{{ $list_metadata['id'] }}" name="list_ids_tab2[]" required class="group-subscriber-{{ $group_metadata['id'] }}" {{ isset($campaign_data['list_ids']) && in_array($list_metadata['id'], explode(',', $campaign_data['list_ids'])) ? 'checked' : '' }}> 
                                                                                            
                                                                                                {{ $list_metadata['name'] }}
                                                                                                <span></span>
                                                                                            </label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.contact_list_help')}}" data-original-title="{{trans('common.description')}}"></i><br><br>
                                                                    <div id="subscriber_disclaimer" style="display: none;" data-name="nlASrISF">
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('common.description')}}"></i></div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="split_test_on" id="split-test-check" value="{{ $campaign_data['split_test_on'] }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="MtUyqzAt">
                                                    <div class="kt-form__section kt-form__section--first" data-name="ZFSMiNrX">
                                                        <div class="kt-wizard-v4__form" data-name="PgQRHyzS">
                                                            <div class="form-group row" data-name="tzbWBZKi">
                                                                <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.sender_list')}}
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8" data-name="PKNPuZiB">
                                                                    <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="tvqmhABt">
                                                                        <div class="kt-portlet__body scList" data-name="suttebpg">
                                                                            <div class="kt-checkbox-list" data-name="dXRrypiH" >
                                                                                <label for="sall_2" class="kt-checkbox">
                                                                                    <input type="checkbox" id="sall_2" class="checkbox-index-sebder checkbox-all-index-sender">
                                                                                    <b>{{trans('common.label.select_all')}}</b>
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                            <div class="kt-checkbox-list" data-error-container="#form_2_services_error" data-name="xKkcemFx">
                                                                            @foreach ($smtp_tree as $group_metadata)
                                                                            <div class="input-icon right" data-name="WElKQVUr">
                                                                                <label for="{{ $group_metadata['id'] }}" class="kt-checkbox">
                                                                                    <input class="group-selector-subscriber checkbox-index-sender" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group[]" > <strong>{{ $group_metadata['name'] }}</strong>
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                            
                                                                                @foreach ($group_metadata['children'] as $smtp_metadata)
                                                                                <div style="padding-left: 20px;" data-name="IxKYHDqM">
                                                                                    <label for="smtp_{{ $smtp_metadata['id'] }}" class="kt-checkbox">
                                                                                        <input type="checkbox" value="{{ $smtp_metadata['id'] }}" id="smtp_{{ $smtp_metadata['id'] }}" name="smtp_ids[]" class="group-subscriber-{{ $group_metadata['id'] }} checkbox-index-sender" required {{ isset($campaign_data['smtp_ids']) && in_array($smtp_metadata['id'], explode(',',$campaign_data['smtp_ids'])) ? 'checked' : '' }}> {{ $smtp_metadata['name'] }}
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                                @endforeach

                                                                            @endforeach
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.sender_list_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                            </div>
                                                            <div class="form-group row rd" data-name="KvtWqmiR">
                                                                <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.smtp_sequence')}}
                                                                </label>
                                                                <div class="col-md-8" data-name="oKrqKJcv">
                                                                    <div class="kt-radio-inline" data-name="GpREOgfg">
                                                                    @if (isset($page_data['action']) == 'saved_criteria')
                                                                        <label for="smtp_sq_1" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="smtp_sequence" id="smtp_sq_1" value="batch" {{ (isset($campaign_data['smtp_sequence']) && $campaign_data['smtp_sequence'] == 'batch') ? 'checked' : '' }} checked onclick="sendingPattern('batch')"> {{trans('app.actions.schedule.add.batches')}}
                                                                            <span></span>
                                                                        </label>&nbsp;&nbsp;
                                                                        <label for="smtp_sq_2" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="smtp_sequence" id="smtp_sq_2" value="loop" {{ (isset($campaign_data['smtp_sequence']) && $campaign_data['smtp_sequence'] == 'loop') ? 'checked' : '' }} onclick="sendingPattern('loop')"> 
                                                                        {{trans('app.dashboard.lang.loop')}}
                                                                            <span></span>
                                                                        </label>
                                                                    @else
                                                                        <label for="smtp_sq_3" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="smtp_sequence" id="smtp_sq_3" value="batch" checked onclick="sendingPattern('batch')"> {{trans('app.actions.schedule.add.batches')}}
                                                                            <span></span>
                                                                        </label>&nbsp;&nbsp;
                                                                        <label for="smtp_sq_4" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="smtp_sequence" id="smtp_sq_4" value="loop" onclick="sendingPattern('loop')">{{trans('app.dashboard.lang.loop')}}
                                                                            <span></span>
                                                                        </label>
                                                                    @endif
                                                                    </div>
                                                                </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.smtp_sequence_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                            </div>
                                                            <div class="form-group row rd" id="sending_pattern" data-name="QWVTLYDk">
                                                                <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.smtp_selection')}}</label>
                                                                <div class="col-md-8" data-name="kimLswPi">
                                                                <div class="kt-radio-inline" data-name="GekjjfOs">
                                                                @if (isset($page_data['action']) == 'saved_criteria')
                                                                    <label for="smtp_sq_11" class="kt-radio kt-radio--defult">
                                                                        <input type="radio" name="sending_pattern" id="smtp_sq_11" value="sequential" {{ (isset($campaign_data['sending_pattern']) && $campaign_data['sending_pattern'] == 'sequential') ? 'checked' : '' }} checked> {{trans('app.actions.schedule.sending_pattern.sequential')}}
                                                                        <span></span>
                                                                    </label>&nbsp;&nbsp;
                                                                    <label for="smtp_sq_22"  class="kt-radio kt-radio--defult"> 
                                                                        <input type="radio" name="sending_pattern" id="smtp_sq_22" value="random" {{ (isset($campaign_data['sending_pattern']) && $campaign_data['sending_pattern'] == 'random') ? 'checked' : '' }}> {{trans('app.actions.schedule.sending_pattern.random')}}
                                                                        <span></span>
                                                                    </label>
                                                                 @else
                                                                        <label  class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="sending_pattern" id="smtp_sq_3" value="sequential" checked> 
                                                                            {{trans('app.actions.schedule.sending_pattern.sequential')}}
                                                                            <span></span>
                                                                        </label>&nbsp;&nbsp;
                                                                        <label  class="kt-radio kt-radio--defult">
                                                                            <input type="radio" name="sending_pattern" id="smtp_sq_41" value="random" > {{trans('app.actions.schedule.sending_pattern.random')}}
                                                                            <span></span>
                                                                        </label>
                                                                    @endif
                                                                </div>
                                                             </div>
                                                            </div>
                                                            @if(moduleCheck('masking_domains'))
                                                            <div class="form-group row rd" data-name="nIGMyjOy">
                                                                <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.sending_domain_option')}}
                                                                </label>
                                                                <div class="col-md-8" data-name="wLaXJRqA">
                                                                    <div class="kt-radio-inline" data-name="nLvZLXtD">
                                                                        <!-- <input type="radio" name="masked_domain" value="not" {{ ($campaign_data['masked_domain'] == 'not') ? 'checked' : '' }} onclick="getMaskedDomainArea('none')"> {{trans('app.campaigns.schedule_email.fields.masked_domain.values.not')}}&nbsp;&nbsp; -->
                                                                        <label for="cdt_01" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" id="cdt_01" name="masked_domain" value="smtp" {{ ($campaign_data['masked_domain'] == 'smtp') ? 'checked' : '' }} onclick="getMaskedDomainArea('none')"> {{trans('app.actions.schedule.add.use_domain_setup_in_smtp')}}
                                                                            <span></span>
                                                                        </label> &nbsp;&nbsp;
                                                                        <label for="cdt_02" class="kt-radio kt-radio--defult">
                                                                            <input type="radio" id="cdt_02" name="masked_domain" value="custom" {{ ($campaign_data['masked_domain'] == 'custom') ? 'checked' : '' }} onclick="getMaskedDomainArea('custom')" count($domain_maskings) 'disabled'> {{trans('app.actions.schedule.add.custom_selection')}}
                                                                            <span></span>
                                                                         </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @else
                                                            <input type="hidden" name="masked_domain" value="not">
                                                            @endif
                                                            <div class="form-group row" id="masked-domains-area" data-name="GsDoJTAL">
                                                                <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.sending_domain_option')}}
                                                                    <span class="required"> * </span>
                                                                </label>
                                                                <div class="col-md-8" data-name="nDCgcOef">
                                                                    <div class="kt-portlet kt-portlet--height-fluid scroll scroll-200" data-name="nWjVNfuS">
                                                                        <div class="kt-portlet__body" data-name="UAYVkWLl">
                                                                            @foreach($domain_maskings as $domain)
                                                                                <div class="kt-checkbox-list" data-name="DgoWVFEq">
                                                                                    <label class="kt-checkbox" for="did_{{$domain->id}}">
                                                                                        <input type="checkbox" id="did_{{$domain->id}}" value="{{$domain->id}}" name="masked_domain_ids[]" {{ isset($campaign_data['masked_domain_ids']) && in_array($domain->id, explode(',', $campaign_data['masked_domain_ids'])) ? 'checked' : '' }} /> {{$domain->domain}}
                                                                                        <span></span>
                                                                                    </label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="zEmQfWSy">
                                                    <div class="kt-form__section kt-form__section--first" data-name="NuUvRvZB">
                                                        <div class="kt-wizard-v4__form" data-name="JlYeTNJe">
                                                            <div id="regular-campaign" data-name="kbCQnPYW">
                                                                <div class="form-group row" data-name="FyXGfuRv">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.send_campaign')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="HinpDDFY">
                                                                        <div class="kt-radio-inline" data-name="ehSunHaf">
                                                                            <label for="send-now" class="kt-radio kt-radio--defult">
                                                                                <input type="radio" name="send_campaign" id="send-now" value="now" checked> {{trans('app.dashboard.lang.send_now')}}
                                                                                <span></span>
                                                                            </label> &nbsp;&nbsp;
                                                                            <label for="send-later" class="kt-radio kt-radio--defult">
                                                                                <input type="radio" name="send_campaign" id="send-later" value="later" > {{trans('app.dashboard.lang.send_later')}}
                                                                                <span></span>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.send_campaign_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>

                                                                <div class="form-group row sendign-time" style="display:none;" data-name="TEgrXQol">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.sending_time')}}</label>
                                                                    <div class="col-md-4" data-name="vLZWghYn">
                                                                        <div class="input-group date" data-date-format="dd-mm-yyyy" data-name="cujFlozj">
                                                                            <input type="text" class="form-control" id="send_date" name="send_date" value="{{ date('d-m-Y') }}" required>
                                                                            <div class="input-group-append" data-name="BrBfUrus">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-calendar-check-o"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4" data-name="LBAWYblq">
                                                                        <div class="input-group timepicker" data-name="hVIjPnhl">
                                                                            <input type="text" class="form-control timepicker timepicker-default" name="send_time" id="send_time">
                                                                            <div class="input-group-append" data-name="GcJgvRAd">
                                                                                <span class="input-group-text">
                                                                                    <i class="la la-clock-o"></i>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div id="evergreen-campaign" style="" data-name="NiUHrjGt">
                                                                    <div class="form-group row" data-name="MULlUbWQ">
                                                                        <label class="col-form-label col-md-3"></label>
                                                                        <div class="col-md-8" data-name="DrvjYkoe">
                                                                            <div class="kt-radio-inline" data-name="YEIcwoFY">
                                                                                <label for="mnth" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="mnth" checked="checked" name="evergreen_schedule"  value="{{trans('app.dashboard.lang.monthly')}}" onclick="loadEvergreenScheduleData('monthly')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'monthly') ? 'checked' : '' }}> {{trans('app.dashboard.lang.monthly')}}
                                                                                    <span></span>
                                                                                </label> 
                                                                                <label for="wkly" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="wkly" name="evergreen_schedule" value="{{trans('app.dashboard.lang.weekly')}}" onclick="loadEvergreenScheduleData('weekly')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'weekly') ? 'checked' : '' }}> {{trans('app.dashboard.lang.weekly')}}
                                                                                    <span></span>
                                                                                </label>
                                                                                <label for="dly" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="dly" name="evergreen_schedule" value="{{trans('app.dashboard.lang.daily')}}" onclick="loadEvergreenScheduleData('daily')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'daily') ? 'checked' : '' }}> {{trans('app.dashboard.lang.daily')}}
                                                                                    <span></span>
                                                                                </label>
                                                                                <label for="hrly" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="hrly" name="evergreen_schedule" value="{{trans('app.dashboard.lang.hourly')}}" onclick="loadEvergreenScheduleData('hour')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'hour') ? 'checked' : '' }}> {{trans('app.dashboard.lang.hourly')}}
                                                                                    <span></span>
                                                                                </label>
                                                                                <label for="mnts" class="kt-radio kt-radio--default">
                                                                                    <input type="radio" id="mnts" name="evergreen_schedule" value="{{trans('app.dashboard.lang.minutes')}}" onclick="loadEvergreenScheduleData('minute')" {{ (isset($evergreen_campaign->evergreen_schedule) && $evergreen_campaign->evergreen_schedule == 'minute') ? 'checked' : '' }}> {{trans('app.dashboard.lang.minutes')}}
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row" id="evergreen_schedule_month" data-name="WEtUVRmV">
                                                                        <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.day_of_month')}}</label>
                                                                        <div class="col-md-4" data-name="wlqKHZZG">
                                                                            <select class="form-control m-select2" name="day_of_month" id="day_of_month">
                                                                                @for ($i=1; $i <= 31; $i++)
                                                                                    <option value="{{$i}}" {{ (isset($evergreen_campaign->day_of_month) && $evergreen_campaign->day_of_month == $i) ? 'selected' : '' }}>{{$i}}</option>
                                                                                @endfor
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row" id="evergreen_schedule_week" data-name="JobWyenu">
                                                                        <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.day_of_week')}}</label>
                                                                        <div class="col-md-4" data-name="arVwfNZS">
                                                                            <select class="form-control m-select2" name="day_of_week" id="day_of_week">
                                                                                <option value="{{trans('app.dashboard.lang.sunday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'Sunday') ? 'selected' : '' }}>{{trans('app.dashboard.lang.sunday')}}</option>
                                                                                <option value="{{trans('app.dashboard.lang.monday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'selected') ? 'checked' : '' }}>{{trans('app.dashboard.lang.monday')}}</option>
                                                                                <option value="{{trans('app.dashboard.lang.tuesday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'tuesday') ? 'selected' : '' }}>{{trans('app.dashboard.lang.tuesday')}}</option>
                                                                                <option value="{{trans('app.dashboard.lang.wednesday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'wednesday') ? 'selected' : '' }}>{{trans('app.dashboard.lang.wednesday')}}</option>
                                                                                <option value="{{trans('app.dashboard.lang.thursday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'thursday') ? 'selected' : '' }}>{{trans('app.dashboard.lang.thursday')}}</option>
                                                                                <option value="{{trans('app.dashboard.lang.friday')}}" {{ (isset($evergreen_campaign->day_of_week) && $evergreen_campaign->day_of_week == 'friday') ? 'selected' : '' }}>{{trans('app.dashboard.lang.friday')}}</option>
                                                                                <option value="{{trans('app.dashboard.lang.saturday')}}">{{trans('app.dashboard.lang.saturday')}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row" id="evergreen_schedule_hour" data-name="LdwKltjs">
                                                                        <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.after_every')}}</label>
                                                                        <div class="col-md-4" data-name="yepqphiG">
                                                                            <select class="form-control m-select2" name="every_hour" id="every_hour">
                                                                                @for ($i=1; $i < 23; $i++)
                                                                                    <option value="{{$i}}" {{ (isset($evergreen_campaign->every_hour) && $evergreen_campaign->every_hour == $i) ? 'selected' : '' }}>{{$i}}</option>
                                                                                @endfor
                                                                            </select> 
                                                                        </div>
                                                                        <label class="col-form-label col-md-2 text-left"> {{trans('app.dashboard.lang.hours')}}</label>
                                                                    </div>
                                                                    <div class="form-group row" id="evergreen_schedule_minute" data-name="qGDsDRaw">
                                                                        <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.after_every')}}</label>
                                                                        <div class="col-md-4" data-name="szIdlkfG">
                                                                            <select class="form-control m-select2" name="every_minute" id="every_mintue">
                                                                                @for ($i=5; $i <= 55; $i+=5)
                                                                                    <option value="{{$i}}" {{ (isset($evergreen_campaign->every_mintue) && $evergreen_campaign->every_mintue == $i) ? 'selected' : '' }}>{{$i}}</option>
                                                                                @endfor
                                                                            </select> 
                                                                        </div>
                                                                        <label class="col-form-label col-md-2 text-left"> {{trans('app.dashboard.lang.minutes')}}</label>
                                                                    </div>
                                                                    <div class="form-group row" data-name="vZvDftGg">
                                                                        <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.sending_time')}}</label>
                                                                        <div class="col-md-4" data-name="sDcHkCPh">
                                                                            <div class="input-group date" data-date-format="dd-mm-yyyy" data-name="NQFtsArA">
                                                                                <input type="text" class="form-control timepicker timepicker-default" name="evergreen_schedule_sending_time" id="sending_time">
                                                                                <div class="input-group-append" data-name="LMXSzIhX">
                                                                                    <span class="input-group-text">
                                                                                        <i class="la la-calendar-check-o"></i>
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php $application_settings =  getApplicationSettings(); ?>
                                                                @if(moduleCheck('multi_threading') and (empty($application_settings["multi_threading"]) or $application_settings["multi_threading"] == "on"))
                                                                <div class="form-group row" data-name="JwFjXYbb">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.threads')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="wQKqoRvU">
                                                                        <input type="number" class="form-control" name="threads_readonly" value="{{ isset($campaign_data['threads']) ? $campaign_data['threads'] : '5' }}"  required />
                                                                        <input type="hidden" name="threads" value="{{ isset($campaign_data['threads']) ? $campaign_data['threads'] : '5' }}">
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.threads_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                                @else
                                                                    <input type="hidden" class="form-control" name="threads" value="1">
                                                                    <input type="hidden" class="form-control" name="threads_readonly" value="1">
                                                                @endif
                                                                <div class="form-group row" data-name="MfzbNcpP">
                                                                    <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.hourly_speed_limit')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="jlDoMMFp">
                                                                    @if(isset($campaign_data['hourly_speed']))
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked" name="hourly_speed_switch" id="hourly-speed-switch">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" name="hourly_speed_switch" id="hourly-speed-switch">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @endif
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.hourly_speed_limit_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                                @if(isset($campaign_data['hourly_speed']))
                                                                    <div class="form-group row" id="hourly_speed" data-name="kxlPKVNQ">
                                                                @else
                                                                    <div class="form-group row" style="display: none;" id="hourly_speed" data-name="EsctEjpe">
                                                                @endif
                                                                    <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.hourly_speed_limit')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="kNfjFcXl">
                                                                        <input type="text" class="form-control" name="hourly_speed" value="{{ isset($campaign_data['hourly_speed']) ? $campaign_data['hourly_speed'] : '-1' }}"  required />
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.hourly_speed_limit_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                                <div class="form-group row" data-name="kNNvGJee">
                                                                    <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.unsubscribe_link')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="qIaNjEEC">
                                                                    @if(isset($campaign_data['unsub_show']) && $campaign_data['unsub_show'] == 0)
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" name="unsub_show" id="unsub_show">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked" name="unsub_show" id="unsub_show">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @endif
                                                                    </div>
                                                                    <!-- <button class="fa fa-question btn btn-sm btn-info popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="Add an automatic unsubscribe link by keeping this button on default position, work this button towards left, if you already have added an unsubscribe link." data-original-title="Unsubscribe Link"></button> -->
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.unsubscribe_link_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                                <div class="form-group row" data-name="HGSxYGuI">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.track_opens')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="zMcxRQcS">
                                                                    @if(isset($campaign_data['track_opens']) && $campaign_data['track_opens'] == 0)
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" {{ trackingStatus() }} name="track_opens" id="track_opens">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" {{ trackingStatus() }} checked="checked" name="track_opens" id="track_opens">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @endif
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.track_opens_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                                <div class="form-group row" data-name="XtKtNFGd">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.track_clicks')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="FFZMmwmY">
                                                                        @if(isset($campaign_data['track_clicks']) && $campaign_data['track_clicks'] == 0)
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" {{ trackingStatus() }} name="track_clicks" id="track_clicks">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" {{ trackingStatus() }} checked="checked" name="track_clicks" id="track_clicks">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        @endif
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.track_clicks_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                                <div class="form-group row" data-name="rYwitmuG">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.skip_duplicate')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="moqQBpTk">
                                                                        @if(isset($campaign_data['track_duplicate']) && $campaign_data['track_duplicate'] == 0)
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input type="checkbox" name="track_duplicate" id="track_duplicate">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        @else
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                                <label>
                                                                                    <input type="checkbox" checked="checked" name="track_duplicate" id="track_duplicate">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        @endif
                                                                    </div>
                                                                    <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.track_duplicates_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                                </div>
                                                                <div class="form-group row sinfo" data-name="MVVYuPep">
                                                                <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.sender_information')}}
                                                                </label>
                                                                <div class="col-md-8" data-name="TlfaHSAh">
                                                                    <div class="kt-radio-inline" data-name="IAuICVbh">

                                                                        <label for="si_list" id="si_list_label" class="kt-radio kt-radio--default"><input type="radio" name="sender_option" id="si_list" value="list" {{ ($campaign_data['sender_option'] == 'list') ? 'checked' : '' }} onclick="getSenderInformation('list')"> {{trans('app.dashboard.lang.from_list')}}<span></span></label> &nbsp;&nbsp;
                                                                        <label for="si_smtp" class="kt-radio kt-radio--default"><input type="radio" name="sender_option" id="si_smtp" value="smtp" {{ ($campaign_data['sender_option'] == 'smtp') ? 'checked' : '' }} onclick="getSenderInformation('smtp')"> {{trans('app.dashboard.lang.from_smtp')}} <span></span></label> &nbsp;&nbsp;
                                                                        <label for="si_custom" class="kt-radio kt-radio--default"><input type="radio" name="sender_option" id="si_custom" value="custom" {{ ($campaign_data['sender_option'] == 'custom') ? 'checked' : '' }} onclick="getSenderInformation('custom')"> {{trans('app.dashboard.lang.custom')}} <span></span></label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="from_option_list" data-name="uqAameap">
                                                                <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.use_from_name_as_listed_in_the_list')}}</label>
                                                                <div class="col-md-8" data-name="ATmjrwSG">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                        <label>
                                                                            <input type="checkbox" checked="checked" id="from_name_list" name="from_name_list">
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="from_option_smtp" data-name="QPhwtJXn">
                                                                <label class="col-form-label col-md-3">{{trans('app.actions.schedule.add.choose_from_name_as_listed_in_smtp')}}</label>
                                                                <div class="col-md-8" data-name="GBYtmglG">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                        <label>
                                                                            <input type="checkbox" checked="checked" id="from_name_smtp" name="from_name_smtp">
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="from_name" style="display: none;" data-name="yeSgtbbt">
                                                                <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.from_name')}}
                                                                </label>
                                                                <div class="col-md-8" data-name="PlnSAhrh">
                                                                    <input type="text" class="form-control" name="from_name" value="{{ isset($custom_info['from_name']) ? $custom_info['from_name'] : '' }}" id="from-name" />
                                                                </div>
                                                            </div>
                                                            <div id="from_option_custom" data-name="cuzGbwPj">
                                                                <div class="form-group row" data-name="SlmeEqPr">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.from_email')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="PJgnDGDb">
                                                                        <div class="row" data-name="wnGsUPQT">
                                                                            <div class="col-md-6" data-name="iVlSDHrF">
                                                                                <input type="text" class="form-control" name="from_email_part1" value="{{ isset($custom_info['from_email']) ? $custom_info['from_email'] : '' }}" />
                                                                            </div>    
                                                                            <div class="col-md-6" data-name="zSqKaKcR">
                                                                                <select class="form-control m-select2" data-placeholder="Choose Email Domain" name="from_email_part2">
                                                                                    <option value="">{{trans('common.label.select_domain')}}</option>
                                                                                    <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); 
                                                                                        $from_email_part2 = "";
                                                                                    ?>
                                                                                    @foreach($domain_maskings as $domain)
                                                                                        @include('common.domain_list_smtp_1' , compact("from_email_part2", "domain" , "unauth_sending_domain"));
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>        
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="XfIaefzZ">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.bounce_email')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="mlkkxLZy">
                                                                        <select class="form-control m-select2" data-placeholder="Choose Bounce Handler" name="bounce_email" id="bounce-id">
                                                                            @foreach($bounce_emails as $bounce_email)
                                                                                <option value="{{ $bounce_email->name }}" {{ (isset($custom_info['bounce_email']) && $custom_info['bounce_email'] == $bounce_email->id) ? 'selected' : '' }}>{{ $bounce_email->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="hgaWARng">
                                                                    <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.reply_email')}}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="bSJqBsdW">
                                                                        <input type="email" class="form-control" name="reply_email" value="{{ isset($custom_info['reply_email']) ? $custom_info['reply_email'] : '' }}" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!--    <div class="form-group row">
                                                                <label class="col-form-label col-md-3">{{trans('app.campaigns.schedule_email.fields.from_attributes.notification_email')}}
                                                                </label>
                                                                <div class="col-md-4">
                                                                @if(isset($campaign_data['notification_email']) && !empty($campaign_data['notification_email']))
                                                                    <input type="checkbox" data-switch="true" data-on-color="success" id="notification-email" checked name="track_clicks" data-on-text="Yes" data-off-text="No">
                                                                @else
                                                                    <input type="checkbox" data-switch="true" data-on-color="success" id="notification-email" name="track_clicks" data-on-text="Yes" data-off-text="No">
                                                                @endif
                                                                </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.campaigns.schedule_email.notification_email.description')}}" data-original-title="{{trans('app.help.campaigns.schedule_email.notification_email.title')}}"></i>
                                                            </div> -->
                                                            @if(isset($campaign_data['notification_email']) && !empty($campaign_data['notification_email']))
                                                            <div class="form-group row" id="notification_email" data-name="mZvfXnRw">
                                                            @else
                                                            <div class="form-group row" id="notification_email" style="display: none;" data-name="jXEWkxxX">
                                                            @endif
                                                                <label class="col-form-label col-md-3">{{trans('common.label.email')}}
                                                                </label>
                                                                <div class="col-md-8" data-name="MvKdEOyo">
                                                                    <input type="text" id="email" class="form-control" name="notification_email" value="{{ isset($campaign_data['notification_email']) ? $campaign_data['notification_email'] : '' }}" />
                                                                </div>
                                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.actions.schedule.add.email_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="kt-form__actions" data-name="owspvQYI">
                                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev" data-name="tITAfeCC">
                                                {{trans('common.form.buttons.back')}}
                                            </div>
                                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-submit" data-name="oLvXGXHs">
                                                {{trans('common.form.buttons.submit')}}
                                            </div>
                                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next" data-name="tIkZgfun">
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


<div id="preloader" style="display: none;" data-name="ATmrcDKe">
    <div data-loader="circle-side" style="display: block;" data-name="RsACONMF"></div>
</div>
@endsection