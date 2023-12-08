@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/statistics-details.css?v={{$local_version}}.02">

<style>
    #logs > tbody > tr > td:first-child a { 
        cursor: pointer;
    }
    table#opens tr td a {
        cursor: pointer;
    }
    .btn-load-data-customer{
        cursor: pointer;
    }
    #bot_message{
        float: right;
    }
    .ci-hide {
        position: absolute;
        width: 70px;
        height: 30px;
        bottom: 20px;
        left: 20px;
        background: white;
        z-index: 99;
    }
    #chartdiv {
        width: 100%;
        height: 400px;
    }
    .progress .progress-bar.bg-success {
        background-color: #1caf9a!important;
    }
    .progress .progress-bar.bg-warning {
        background-color: #ff8000!important;
    }
    #top-domains {
        width: 100%;
        height: 310px;
        margin-bottom: -30px;
    }
    svg g[aria-labelledby="id-66-title"] {
        display: none;
    }
    .summary-stats .topevents {
        word-wrap: break-word;
        background-clip: border-box;
        border: 1px solid #d1d7e2;
        border-radius: 6px;
        display: flex;
        flex-direction: row;
        min-width: 0;
        position: relative;
        background-color: #fff;
        margin-bottom: 20px;
        padding: 10px;
        justify-content: flex-start;
        align-items: center;
    }
    .summary-stats .topevents .icon {
        background: #FFF;
        width: 50px;
        height: 50px;
        display: inline-block;
        border: 0;
        float: left;
        text-align: center;
        line-height: 54px;
    }
    .summary-stats .topevents .content {
        display: inline-block;
        width: auto;
        height: 100%;
        margin-left: 5px;
        float: left;
        font-size: 13px;
        color: #666;
        font-weight: 500;
        margin-top: 0px;
        white-space: nowrap;
    }
    .summary-stats .topevents .content>span {
        display: block;
        font-size: 14px;
        font-weight: 700;
        line-height: 1;
        color: #333;
        letter-spacing: 0px;
        margin-top: 3px;
        white-space: normal;
        word-break: break-all;
    }
    .summary-stats .topevents .content>span>small {
        font-weight: 600;
    }
    .progress {
        /* height: 12px; */
    }
    .progress .progress-bar {
        font-size: 12px !important;
        color: #fff;
        font-weight: 600;
    }
    svg.text-success g [fill] {
        fill: #0abb87 !important;
    }
    svg.text-info g [fill] {
        fill: #5578eb !important;
    }
    svg.text-warning g [fill] {
        fill: #ffb822 !important;
    }
    svg.text-danger g [fill] {
        fill: #fd397a !important;
    }
    .summary-stats .topevents .icon i.fa {
        font-size: 24px;
        vertical-align: middle;
    }
    .summary-stats .topevents .icon svg {
        width: 50px !important;
        height: 50px !important;
        margin-left: -3px;
    }
    .summary-stats .topevents .icon i.fa {
        font-size: 38px;
        vertical-align: middle;
        margin-top: -1px;
        margin-left: -3px;
    }
    @media (max-width:1550px) {
        .col-md-3.summary-stats {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
</style>

<link href="/themes/default/css/map/anychart-ui.min.css" rel="stylesheet" type="text/css">
<link href="/themes/default/css/map/anychart-font.min.css" rel="stylesheet" type="text/css">

@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<!-- load data after page content -->
<script type="text/javascript">
    $(document).ready(function() {

        $(".m-select2").select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
        
        $(".btn-load-data-customer").click(function() {
            var url = $(this).attr('data');
            var elb = $(this).attr('id');
            $("#load-data-customer-field").modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
            $("#GoUrl").val(url);
            $("#elb").val(elb);
        });
        
//        $("#downloadData").click(function () {
//            var customeFieldCheck = 0;
//            var running_in_background = 0;
//            
//            if ($("#isDownlloadCustomfields").is(':checked')) {
//                customeFieldCheck = 1;
//            }
//            if ($("#running_in_background").is(':checked')) {
//                running_in_background = 1;
//            }
//
//            var Url = $("#GoUrl").val() + "?customeFieldCheck=" + customeFieldCheck;
//            var random = (Math.random() + 1).toString(36).substring(2);
//            if ($("#openclickFlag").val() == 1) {
//                var isBot = 0;
//                if ($('#bot_inluded').is(":checked")) {
//                    isBot = 1
//                }
//                Url = Url + '&is_bots=' + isBot;
//            }
//            Url+='&random='+random;
//            $("#load-data-customer-field").modal("hide");
//
//           /* if ($("#elb").val() == 'elb') {
//                exportLogsCSV();
//            } else {
//                $("#elb").val("");
//            }*/
//            ///console.log(Url);
//            if(running_in_background==0 || running_in_background=='0'){
//                window.location.href = Url;
//            }else{
//                $.ajax({
//                    type: 'GET',
//                    url: Url,
//                    data: {'running_in_background':1},
//                    beforeSend: function() {
//                        $('.blockUI').show();
//                    },
//                    success: function (data) {
//                        if (data)
//                            toastr.success(data);
//                        else
//                            toastr.error("Error");
//                    }, error: function (jqXHR, status, err) {
//                        $('.blockUI').hide();
//                    },
//                    complete: function () {
//                        $('.blockUI').hide();
//                    }
//                });
//            }
//
//        });
    });

    // $(window).on("load", function () {
    //     setTimeout(function () {
    //         drawOpenChart();
    //     }, 1000);
    // });
</script>
@include('statistics.common.stats_script')
<script>
    $(".blockUI").hide();
    function loadBounced(){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }


        $('#spintag').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[6, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/bounced/{{$campaign_schedule_id}}",
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    var opensTable;
    function loadOpens(){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }

        opensTable = $('#opens').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,8]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[11, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/opens/{{$campaign_schedule_id}}",
            "fnServerParams": function (aoData) {
                aoData.push({"name": "opensType", "value": $("#opensType").val()});
                aoData.push({"name": "exclude_bots", "value": ($("#exclude_bots").is(":checked")) ? 1 : 0});
                aoData.push({"name": "showEmail", "value": ($("#showEmail").is(":checked")) ? 1 : 0});
            },
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
        $("#opensType").change(function () {
            opensTable.draw();
        });

        $("#exclude_bots").change(function () {
            opensTable.draw();
        });
        $("#showEmail").change(function () {
            opensTable.draw();
        });

    }
    var clicksTable;
    function loadClicked(){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }

        clicksTable = $('#clicked').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,9]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[12, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/clicked/{{$campaign_schedule_id}}",
            "fnServerParams": function (aoData) {
                aoData.push({"name": "clicksType", "value": $("#clicksType").val()});
                aoData.push({"name": "exclude_bots", "value": ($("#click_exclude_bots").is(":checked")) ? 1 : 0});
                aoData.push({"name": "showEmail", "value": ($("#clickShowEmail").is(":checked")) ? 1 : 0});
            },
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
        $("#clicksType").change(function () {
            clicksTable.draw();
        });

        $("#click_exclude_bots").change(function () {
            clicksTable.draw();
        });
        $("#clickShowEmail").change(function () {
            clicksTable.draw();
        });
    }
    function loadUnsubscribed(){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }

        $('#unsubscribed').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,1]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[10, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/unsubscribed/{{$campaign_schedule_id}}",
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadComplaints(){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }
        $('#complaints').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/complaints/{{$campaign_schedule_id}}",
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadLogs(type='all'){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }
        var table = $('#logs').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": []}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[7, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/logs/{{$campaign_schedule_id}}",
            "fnServerParams": function (aoData) {
                aoData.push({"name": "clicksType", "value": type});
            },
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });

        $('#logs').on( 'length.dt', function ( e, settings, len ) {
            localStorage.setItem("stats_pageLength" , len);
        });

    }
    function loadDelivered(){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }

        $('#delivered').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": []}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[0, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/delivered/{{$campaign_schedule_id}}",
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadContentAB(){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }

        $('#abs').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": []}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[0, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/ab/from_smtp/{{$campaign_schedule_id}}",
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadConversation(){
        var page_limit = 50;
        if(localStorage.getItem("stats_pageLength") > 0 ) { 
            page_limit = localStorage.getItem("stats_pageLength");
        }

        $('#conversation').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": []}],
            "destroy"    : true,
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[0, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/statistics/broadcasts/conversation/{{$campaign_schedule_id}}",
            "pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    }
    function loadContent(type , id) {
            $(".blockUI").show();
            $.ajax({
                url: '/statistics/broadcasts/content/'+type+'/'+id,
                type: "GET",
                success: function(data) {
                    if(data.type == 'contact_list'){
                        $("#abs").html(data.html);
                    }else if(data.type == 'campaign_list'){
                        $("#abs").html(data.html);
                    }else if(data.type == 'smtp_list'){
                        $("#abs").html(data.html);
                    }else if(data.type == 'top_ten_clicks'){
                        $("#abs").html("<div class='table-scrollable'>"+data.html+"</div>");
                    }
                    else if(data.type == 'clicks_by_browser'){
                        $("#abs").html("<div class='table-scrollable'>"+data.html+"</div>");
                    }
                    //$(".blockUI").modal('hide');
                    $(".blockUI").hide();
                }
            });
    }

    function getFormData(id, type)
    {
        $.ajax({
            url: "{{ url('/') }}"+'/contact/'+id+'/edit',
            type: "GET",
            data: {type: type},
            success: function (data) {
                $('#subscriber-data').html(data.html);
                $("#modal-subscriber-details").modal('show');
            }
        });
    }

    function exportLogsCSV() {
     
        Command: toastr["success"] ("@lang('common.message.export_process_background')");
    }

    $(document).ready(function() {

        $('#modal-subscriber-details').on('hidden', function() {
            clear()
        });
    });

    $("body").on("click" , ".refreshResult" , function() { 
        $(".refreshResult").html('<span class="bg-icon"><i class="la la-refresh fa-spin"></i></span>');
        $.ajax({
            url: "{{url('campaign/clicked-ajax/' . $campaign_schedule_id)}}",
            success: function(data) {
                location.reload();
            }
        });
    });




<?php 
try {  $spammed_emails = count(file( storage_path() . "/campaigns/" . $campaign_schedule_id . "/spammed_emails.csv"));  } catch(\Exception $e) {  $spammed_emails = 0; }
try {   $suppression_emails = count(file( storage_path() . "/campaigns/" . $campaign_schedule_id . "/suppression_emails.csv")); } catch(\Exception $e) {  $suppression_emails = 0; }
try {    $suppression_domains = count(file(storage_path() . "/campaigns/" . $campaign_schedule_id . "/suppressed_domains.csv")); } catch(\Exception $e) {  $suppression_domains = 0; }
try {    $notconfirmed = count(file("storage/campaigns/" . $campaign_schedule_id . "/notconfirmed.csv")); } catch(\Exception $e) {  $notconfirmed = 0; }
try {    $inactive = count(file("storage/campaigns/" . $campaign_schedule_id . "/inactive.csv")); } catch(\Exception $e) {  $inactive = 0; }
try {    $unsubscribe_s = count(file("storage/campaigns/" . $campaign_schedule_id . "/unsubscribe.csv")); } catch(\Exception $e) {  $unsubscribe_s = 0; }
try {    $bounced_s = count(file("storage/campaigns/" . $campaign_schedule_id . "/bounced.csv")); } catch(\Exception $e) {  $bounced_s = 0; }
try {   $duplicate_emails = count(file("storage/campaigns/" . $campaign_schedule_id . "/duplicate_emails.csv")); } catch(\Exception $e) {  $duplicate_emails = 0; }
try {   $deleted_emails = count(file("storage/campaigns/" . $campaign_schedule_id . "/deleted_emails.csv")); } catch(\Exception $e) {  $deleted_emails = 0; }
?> 




    
$("body").on("click" , ".viewEmail", function() {
        var contact_id = $(this).attr("data-id");
        $.ajax({
            type: 'POST',
            url: '{{url("getSubscriber")}}',
            data: {contact_id},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                // var obj = JSON.parse(data);
                $(".viewEmail" + data["id"]).html(data["email"]);
                $(".viewList" + data["id"]).html(data["list_name"]);
            }, error: function (jqXHR, status, err) {
                $('.blockUI').hide();
            },
                complete: function () {
                    $('.blockUI').hide();
                }
        });

    });


    $("body").on("click" , ".skippedView", function() {
            var campaign_id = $(this).attr("data-id");
          //  console.log(campaign_id);
            
            var bounced = $(this).attr("data-bounced");
            var duplicate = $(this).attr("data-duplicate");
            var unsubscribed = $(this).attr("data-unsubscribed");
            var in_active = $(this).attr("data-in_active");
            var not_confirmed = $(this).attr("data-not_confirmed");
            var suppressed = $(this).attr("data-suppressed");
            var suppressed_domains = $(this).attr("data-suppressed_domains");
            var spammed_emails = $(this).attr("data-spammed_emails");

            $("#SuppressedCount").html(<?php echo $suppression_emails; ?> + " <a target='_blank' href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/suppression_emails.csv'><i class='la la-download'></i></a>");
            $("#NotConfirmedCount").html(<?php echo $notconfirmed; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/notconfirmed.csv'><i class='la la-download'></i></a>");
            $("#DomainSuppressedCount").html(<?php echo $notconfirmed; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/suppressed_domains.csv'><i class='la la-download'></i></a>");
            $("#InActiveCount").html(<?php echo $inactive; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/inactive.csv'><i class='la la-download'></i></a>");
            $("#UnsubscribedCount").html(<?php echo $unsubscribe_s; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/unsubscribe.csv'><i class='la la-download'></i></a>");
            $("#BouncedCount").html(<?php echo $bounced_s; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/bounced.csv'><i class='la la-download'></i></a>");
            $("#DuplicateCount").html(<?php echo $duplicate_emails; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/duplicate_emails.csv'><i class='la la-download'></i></a>");
            $("#SpammedCount").html(<?php echo $spammed_emails; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/spammed_emails.csv'><i class='la la-download'></i></a>");
            @if($deleted_emails>0)
                $("#deletedSubscribers").html(<?php echo $deleted_emails; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/deleted_emails.csv'><i class='la la-download'></i></a>");
            @else 
                $("#trDeletedSubscribers").hide();
            @endif
            if(duplicate <= 0) { 
                $(".DuplicateCount").hide();
            }
            $("#skippedModal").modal("show");
        });
        

</script>
<script> 
<?php 
try {  $spammed_emails = count(file( storage_path() . "/campaigns/" . $campaign_schedule_id . "/spammed_emails.csv"));  } catch(\Exception $e) {  $spammed_emails = 0; }
try {   $suppression_emails = count(file( storage_path() . "/campaigns/" . $campaign_schedule_id . "/suppression_emails.csv")); } catch(\Exception $e) {  $suppression_emails = 0; }
try {    $suppression_domains = count(file(storage_path() . "/campaigns/" . $campaign_schedule_id . "/suppressed_domains.csv")); } catch(\Exception $e) {  $suppression_domains = 0; }
try {    $notconfirmed = count(file("storage/campaigns/" . $campaign_schedule_id . "/notconfirmed.csv")); } catch(\Exception $e) {  $notconfirmed = 0; }
try {    $inactive = count(file("storage/campaigns/" . $campaign_schedule_id . "/inactive.csv")); } catch(\Exception $e) {  $inactive = 0; }
try {    $unsubscribe_s = count(file("storage/campaigns/" . $campaign_schedule_id . "/unsubscribe.csv")); } catch(\Exception $e) {  $unsubscribe_s = 0; }
try {    $bounced_s = count(file("storage/campaigns/" . $campaign_schedule_id . "/bounced.csv")); } catch(\Exception $e) {  $bounced_s = 0; }
try {   $duplicate_emails = count(file("storage/campaigns/" . $campaign_schedule_id . "/duplicate_emails.csv")); } catch(\Exception $e) {  $duplicate_emails = 0; }
?> 
    $("body").on("click" , ".viewEmail", function() {
        var contact_id = $(this).attr("data-id");
        $.ajax({
            type: 'POST',
            url: '{{url("getSubscriber")}}',
            data: {contact_id},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                // var obj = JSON.parse(data);
                $(".viewEmail" + data["id"]).html(data["email"]);
                $(".viewList" + data["id"]).html(data["list_name"]);
            }, error: function (jqXHR, status, err) {
                $('.blockUI').hide();
            },
                complete: function () {
                    $('.blockUI').hide();
                }
        });

    });

    $("body").on("click" , ".skippedView", function() {
        var campaign_id = $(this).attr("data-id");
        //  console.log(campaign_id);
        
        var bounced = $(this).attr("data-bounced");
        var duplicate = $(this).attr("data-duplicate");
        var unsubscribed = $(this).attr("data-unsubscribed");
        var in_active = $(this).attr("data-in_active");
        var not_confirmed = $(this).attr("data-not_confirmed");
        var suppressed = $(this).attr("data-suppressed");
        var suppressed_domains = $(this).attr("data-suppressed_domains");
        var spammed_emails = $(this).attr("data-spammed_emails");

        $("#SuppressedCount").html(<?php echo $suppression_emails; ?> + " <a target='_blank' href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/suppression_emails.csv'><i class='la la-download'></i></a>");
        $("#NotConfirmedCount").html(<?php echo $notconfirmed; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/notconfirmed.csv'><i class='la la-download'></i></a>");
        $("#DomainSuppressedCount").html(<?php echo $notconfirmed; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/suppressed_domains.csv'><i class='la la-download'></i></a>");
        $("#InActiveCount").html(<?php echo $inactive; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/inactive.csv'><i class='la la-download'></i></a>");
        $("#UnsubscribedCount").html(<?php echo $unsubscribe_s; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/unsubscribe.csv'><i class='la la-download'></i></a>");
        $("#BouncedCount").html(<?php echo $bounced_s; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/bounced.csv'><i class='la la-download'></i></a>");
        $("#DuplicateCount").html(<?php echo $duplicate_emails; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/duplicate_emails.csv'><i class='la la-download'></i></a>");
        $("#SpammedCount").html(<?php echo $spammed_emails; ?> + " <a target='_blank'  href='{{url('/downloadCSV?p=storage/campaigns/')}}/" +   campaign_id  + "/spammed_emails.csv'><i class='la la-download'></i></a>");
        if(duplicate <= 0) { 
            $(".DuplicateCount").hide();
        }
        $("#skippedModal").modal("show");
    });
</script>
@endsection

@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="CGoLyXWk">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="uthSmhQp">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
 
<div class="row" data-name="tStAmOPr">    
    <div class="col-md-12" data-name="YYJjysDf">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="qnokvXGD">
            <div class="kt-portlet__head" data-name="TWiqnXCa">
                <div class="kt-portlet__head-label" data-name="mMOcatCY">
                    <h3 class="kt-portlet__head-title">
                        @if($isDrip)
                           {{ trans('statistics.detail.drip_result') }}
                        @else
                            {{ $pageDescription }}
                        @endif
                        
                    </h3>
                </div>
                <div class="kt-portlet__head-toolbar" data-name="SmaqeJpx">
                    <!-- <span class="refreshResult" style="font-size:15px;font-weight:bold; padding-right:15px;cursor: pointer;padding-top: 5px;">
                        <small> @lang('statistics.every_minute') @if (!empty($last_run->datetime))@lang('statistics.last_updated') {{date("h:iA" , strtotime(convertUtctoCustomer(2, $last_run->datetime)))}} @endif</small> <i class="la la-refresh"></i>
                    </span> -->
					@if(routeAccess('export_trigger_stats'))
                    <button class="btn btn-label-info btn-sm btn-bold dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    {{trans('statistics.detail.export_options.title')}}
                    </button>
                   
                    @include('statistics.common.download_options')  
                     
                     @endif                       
                </div>
            </div>
           <?php $openStats = routeAccess('get_broadcast_open_stats');
           $clickStats = routeAccess('get_broadcast_click_stats');
           $unsubStats = routeAccess('get_broadcast_unsub_stats');
           $bounceStats = routeAccess('get_broadcast_bounce_stats');
           $complaintStats = routeAccess('get_broadcast_spam_stats');
           $broadcastLogs = routeAccess('get_broadcast_log_stats');
           $campaignContent = routeAccess('get_broadcast_ab_stats');
           ?>
            <div class="kt-portlet__body" data-name="sXHpUZTz"> 
                <div class="" data-name="SSUaFjSe">
                    <ul class="nav nav-tabs" role="tablist">
    
                        <li class="nav-item">
                            <a href="#tab1" class="nav-link active" data-toggle="tab" role="tab">{{trans('statistics.detail.summary.title')}}</a>
                        </li>
                   
                        <!--    <li class="nav-item">
                            <a href="#tab8" onclick="loadDelivered();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.campaign.detail.view_all.delivered.title')}}</a>
                        </li> -->
                      @if($openStats)
                        <li class="nav-item">
                            <a href="#tab3" onclick="loadOpens();" class="nav-link" data-toggle="tab" role="tab">{{trans('common.stats.opened')}}</a>
                        </li>
                      @endif
                      @if($clickStats)
                        <li class="nav-item">
                            <a href="#tab4" onclick="loadClicked();" class="nav-link" data-toggle="tab" role="tab">{{trans('common.stats.clicked')}}</a>
                        </li>
                      @endif
                      @if($unsubStats)
                        <li class="nav-item">
                            <a href="#tab5" onclick="loadUnsubscribed();" class="nav-link" data-toggle="tab" role="tab">{{trans('common.stats.unsubscribed')}}</a>
                        </li>
                      @endif
                      @if($bounceStats)
                        <li class="nav-item">
                            <a href="#tab2" onclick="loadBounced();" class="nav-link" data-toggle="tab" role="tab">{{trans('common.stats.bounced')}}</a>
                        </li>
                      @endif
                     @if($complaintStats)
                        <li class="nav-item">
                            <a href="#tab6" onclick="loadComplaints();" class="nav-link" data-toggle="tab" role="tab">{{trans('common.stats.complaints')}}</a>
                        </li>
                      @endif
                      @if($broadcastLogs)
                        <li class="nav-item">
                            <a href="#tab7" onclick="loadLogs('all');" class="nav-link" data-toggle="tab" role="tab">{{trans('common.stats.logs')}}</a>
                        </li>
                        @endif
                        @if($campaignContent)
                        <li class="nav-item">
                            <a href="#tab9"  class="nav-link" data-toggle="tab" role="tab" onClick="loadContent('contact_list' , {{$campaign_schedule_id}});$('#contact_list_db').trigger('click')">{{trans('common.stats.ab')}}</a>
                        </li>
                        @endif
                        <!-- <li>
                            <a href="#tab10" onclick="loadConversation();" class="nav-link" data-toggle="tab" role="tab">{{trans('app.statistics.campaign.detail.view_all.conversation.title')}}</a>
                        </li> -->
                    </ul>
                    <div class="tab-content" data-name="lhbyeFIa">
                        @if($isDrip)
                            <div class="tab-pane active" id="tab1" data-name="nzfssErz">
                                <div class="form-group row" data-name="AsrjqGty">
                                    <div class="col-md-6" data-name="jevUiXjc">
                                        <table id="summery" class="table table-striped table-hover table-checkable responsive">
                                            <tbody>
                                            <tr>
                                                <td> {{trans('statistics.detail.schedule_label')}} </td>
                                                <td>
                                                    <span class=""> {{ $dripName }} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('statistics.detail.drip_group')}} </td>
                                                <td>
                                                    <span class=""> {{ $dripGroupName }} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('statistics.detail.trigger')}} </td>
                                                <td>
                                                    <span class=""> {{ $triggerName }} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('statistics.detail.audience')}}</td>
                                                <td>
                                                    <span class=""> {{ $criteria }}  </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{$listHeading}}</td>
                                                <td>
                                                    <span class=""> {{ $listStr }}  </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('statistics.detail.sending_nodes')}}</td>
                                                <td>
                                                    <span class=""> {{ $smtp_names }}  </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('statistics.detail.sending_time')}} </td>
                                                <td>
                                                    <span class=""> {{ !empty($firstActivityAt) ? showDateTime(\Illuminate\Support\Facades\Auth::user(),$firstActivityAt) : '---'}} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('statistics.detail.drip_age')}} </td>
                                                <td>
                                                    <span class="">
                                                      @if(!empty($firstActivityAt))
                                                       <?php
                                                           $start_date = Carbon\Carbon::parse($firstActivityAt);
                                                           $end_date  = Carbon\Carbon::now();
                                                           echo $diff = $start_date->diffForHumans($end_date, true);
                                                       ?>
                                                      @else
                                                       ---
                                                      @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.label.status')}} </td>
                                                <td>
                                                    <span class=""> {{ $triggerStatus }} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.sent')}} </td>
                                                <td>
                                                    <span class=""> {{$campaign_sent}} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.opened')}} </td>
                                                <td>
                                                    <span data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="@lang('statistics.detail.opened_title')">{{ $opened }} / {{$total_opens }}
                                                        {{ ($opened) ? "(".round(($opened* 100) / $campaign_sent, 2) ." % )" : "(0  % )" }}

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.clicked')}} </td>
                                                <td>
                                                    <span data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="@lang('statistics.detail.clicked_title')"> {{ $clicked }} / {{ $total_clicked }}
                                                        {{ $clicked ? "(".round(($clicked* 100) / $campaign_sent, 2) ." % )" : "(0  % )" }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.ctr')}} </td>
                                                <td>
                                                    <?php 
                                                        $ctr_formula = getSetting("ctr_formula");
                                                        $ctrFinal = 0;
                                                        if($opened > 0)  $ctrFinal = $clicked/$opened;
                                                        if($campaign_sent > 0 && $ctr_formula == "sent")  $ctrFinal = $clicked/$campaign_sent;
                                                        if($total_delivered > 0 && $ctr_formula == "delivered")  $ctrFinal = $clicked/$total_delivered;    
                                                    ?>
                                                    <span class="" title="{{trans('statistics.detail.ctr')}}">
                                                        {{ round(($ctrFinal) * 100, 2) . " % "  }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.bounced')}} </td>
                                                <td>
                                                    <span data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="@lang('statistics.detail.bounces_title')"> {{$campaign_bounced}}
                                                        @if($campaign_sent > 0) {{ $campaign_bounced ? "(".round(($campaign_bounced * 100) / $campaign_sent, 2) ." % )" : "(0  % )" }} @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.unsubscribed')}} </td>
                                                <td>
                                                    <span data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="@lang('statistics.detail.unsubs_title')"> {{$unsubscribed}}
                                                        @if($campaign_sent > 0) {{ $unsubscribed ? "(".round(($unsubscribed * 100) / $campaign_sent, 2) ." % )" : "(0  % )" }}  @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.label.track_opens')}} </td>
                                                <td>
                                                    <span class=""> {{$campaign->track_opens == 1 ? trans('common.form.buttons.yes') : trans('common.form.buttons.no')}} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.label.track_clicks')}} </td>
                                                <td>
                                                    <span class=""> {{$campaign->track_clicks == 1 ? trans('common.form.buttons.yes') : trans('common.form.buttons.no')}} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.label.embed_unsubscribe_link')}} </td>
                                                <td>
                                                    <span class=""> {{$campaign->unsub_show == 1 ? trans('common.form.buttons.yes') : trans('common.form.buttons.no')}} </span>
                                                </td>
                                            </tr>
                                            <!--<tr>
                                                <td> {{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.title')}} </td>
                                                <td>
                                                    <span class=""><a href="javascript:;" onclick="loadContent('from_smtp', {{$campaign_schedule_id}})"> {{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.values.from_smtp')}} </a></span>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td> {{trans('statistics.detail.scheduled_by')}} </td>
                                                <td>
                                                    <span class="">{{getUserName($campaign->user_id)}} ({{ getUserEmail($campaign->user_id) }}, {{ $campaign->user_id  }}) On {{ showDateTime(Auth::user()->id, $campaign->created_at, 1)}} </span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 por" data-name="AprJyCPP">
                                        <div class="row">
                                            <div class="col-md-3 summary-stats">
                                                <div class="topevents">
                                                    <div class="icon">
                                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon text-success">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                                <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                                                <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" id="Combined-Shape" fill="#000000"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="content">
                                                        {{trans('common.stats.opened')}}
                                                        <span>{{ $opened }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 summary-stats">
                                                <div class="topevents">
                                                    <div class="icon">
                                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon text-info">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                                <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" id="check" fill="#000000" fill-rule="nonzero" opacity="0.8"/>
                                                                <path d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z" id="Combined-Shape" fill="#000000"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="content">
                                                        {{trans('common.stats.clicked')}}
                                                        <span>{{ $clicked }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 summary-stats">
                                                <div class="topevents">
                                                    <div class="icon">
                                                        <i class="fa fa fa-hand-paper text-warning fa-lg"></i>
                                                    </div>
                                                    <div class="content">
                                                        {{trans('common.stats.unsubscribed')}}
                                                        <span>{{$unsubscribed}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 summary-stats">
                                                <div class="topevents">
                                                    <div class="icon">
                                                        <i class="fa fa-window-close text-danger fa-lg"></i>
                                                    </div>
                                                    <div class="content">
                                                        {{trans('common.stats.bounced')}}
                                                        <span>{{$campaign_bounced}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="email-opened" value="{{$opened}}" />
                                        <input type="hidden" id="email-clicked" value="{{$clicked}}" />
                                        <input type="hidden" id="email-bounced" value="{{$campaign_bounced}}" />
                                        <input type="hidden" id="email-unopend" value="{{(int)$campaign_sent - (int)$opened - (int)$campaign_bounced}}" />
<!--                                         Top domain Chart for the campaign-->
                                        @if($topDomainData!="")   
                                        <div class="kt-portlet kt-portlet--bordered" data-name="dDgGVYur">
                                            <div class="kt-portlet__head" data-name="FfdwTJfD">
                                                <div class="kt-portlet__head-label" data-name="smiRuUNg">
                                                    <h3 class="kt-portlet__head-title">
                                                        {{trans('dashboard.top_domains')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            
                                            <div class="kt-portlet__body relative" data-name="DMLfwPjx">
                                                <script src="/themes/default/js/charts/core.js"></script>
                                                <script src="/themes/default/js/charts/charts.js"></script>
                                                <script src="/themes/default/js/charts/animated.js"></script>
                                                <script>
                                                    am4core.useTheme(am4themes_animated);
                                                    var topDomainData = <?php echo $topDomainData?>;
                                                    var chart = am4core.create("top-domains", am4charts.XYChart);
                                                    chart.scrollbarX = new am4core.Scrollbar();
                                                    // chart.zoomOutButton.disabled = true;
                                                    chart.data = topDomainData;
                                                    
                                                    chart.scrollbarX.disabled = true;
                                                    chart.scrollbarX.startGrip.disabled = true;
                                                    chart.scrollbarX.endGrip.disabled = true;

                                                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                                                    categoryAxis.dataFields.category = "domain";
                                                    categoryAxis.renderer.grid.template.location = 0;
                                                    categoryAxis.renderer.minGridDistance = 30;
                                                    categoryAxis.renderer.labels.template.horizontalCenter = "right";
                                                    categoryAxis.renderer.labels.template.verticalCenter = "middle";
                                                    categoryAxis.renderer.labels.template.rotation = -50;
                                                    categoryAxis.tooltip.disabled = true;
                                                    categoryAxis.renderer.minHeight = 80;

                                                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                                                    valueAxis.renderer.minWidth = 50;

                                                    var series = chart.series.push(new am4charts.ColumnSeries());
                                                    series.sequencedInterpolation = true;
                                                    series.dataFields.valueY = "visits";
                                                    series.dataFields.categoryX = "domain";
                                                    series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
                                                    series.columns.template.strokeWidth = 0;

                                                    series.tooltip.pointerOrientation = "vertical";

                                                    //series.columns.template.column.cornerRadiusTopLeft = 10;
                                                    //series.columns.template.column.cornerRadiusTopRight = 10;
                                                    series.columns.template.column.fillOpacity = 0.7;

                                                    var hoverState = series.columns.template.column.states.create("hover");
                                                    //hoverState.properties.cornerRadiusTopLeft = 0;
                                                    //hoverState.properties.cornerRadiusTopRight = 0;
                                                    hoverState.properties.fillOpacity = 1;

                                                    series.columns.template.adapter.add("fill", function(fill, target) {
                                                        return chart.colors.getIndex(target.dataItem.index);
                                                    });

                                                    chart.cursor = new am4charts.XYCursor();
                                                </script>
                                                <div id="top-domains"></div>	
                                            </div>
                                        </div>
                                        @endif
                                        <?php
                                            $openPercentage = 0;
                                            $total_emails = $total_emails<$opened ? $campaign_sent:$total_emails;
                                            $unopened = 0;
                                            if($total_emails > 0){
                                                    $openPercentage = ceil(($opened/$total_emails)*100);
                                                    $unopened = $total_emails-$opened;
                                            }
                                            $unopendEnd = ceil(100-$openPercentage);
                                        ?>
                                        @if($open_unopen_chart=='horizontal_bar_graph')
                                        <div class="kt-portlet kt-portlet--bordered" data-name="dDgGVYur">
                                            <div class="kt-portlet__head" data-name="FfdwTJfD">
                                                <div class="kt-portlet__head-label" data-name="smiRuUNg">
                                                    <h3 class="kt-portlet__head-title">
                                                        {{trans('common.stats.chart_opened')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body relative" data-name="DMLfwPjx">

                                                <div class="row ouc-blk">
                                                    <div class="col-md-6">
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-success"></span>
                                                            <span class="kt-widget14__stats" style="">{{ $openPercentage }}% Opened</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                            <span class="kt-widget14__stats" style="">{{ $unopendEnd }}% Unopened</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $openPercentage }}%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Opened {{ $openPercentage }}%">{{ $openPercentage }}%</div>
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $unopendEnd }}%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Unopened {{ $unopendEnd }}%">{{ $unopendEnd }}%</div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="kt-portlet kt-portlet--bordered" data-name="dDgGVYur">
                                            <div class="kt-portlet__head" data-name="FfdwTJfD">
                                                <div class="kt-portlet__head-label" data-name="smiRuUNg">
                                                    <h3 class="kt-portlet__head-title">
                                                        {{trans('common.stats.chart_opened')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body relative" data-name="DMLfwPjx">
                                                <!-- Resources -->
                                                <script src="/themes/default/js/charts/core.js"></script>
                                                <script src="/themes/default/js/charts/charts.js"></script>
                                                <script src="/themes/default/js/charts/animated.js"></script>

                                                <!-- Chart code -->
                                                <script>
                                                    am4core.ready(function() {
                                                        am4core.useTheme(am4themes_animated);
                                                        var chart = am4core.create("chartdiv3", am4charts.PieChart);
                                                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                                                        pieSeries.dataFields.value = "value";
                                                        pieSeries.dataFields.category = "country";
                                                        pieSeries.dataFields.fill = "color";
                                                        chart.innerRadius = am4core.percent(30);
                                                        pieSeries.slices.template.stroke = am4core.color("#fff");
                                                        pieSeries.slices.template.strokeWidth = 2;
                                                        pieSeries.slices.template.strokeOpacity = 1;
                                                        pieSeries.slices.template.propertyFields.fill = "color";
                                                        pieSeries.slices.template
                                                        .cursorOverStyle = [
                                                            {
                                                            "property": "cursor",
                                                            "value": "pointer"
                                                            }
                                                        ];
                                                        pieSeries.alignLabels = false;
                                                        pieSeries.labels.template.bent = false;
                                                        pieSeries.labels.template.radius = 3;
                                                        pieSeries.labels.template.padding(0,0,0,0);
                                                        pieSeries.ticks.template.disabled = true;
                                                        var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
                                                        shadow.opacity = 0;
                                                        var hoverState = pieSeries.slices.template.states.getKey("hover");
                                                        var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
                                                        hoverShadow.opacity = 0.7;
                                                        hoverShadow.blur = 5;
                                                        chart.legend = new am4charts.Legend();

                                                        chart.data = [{
                                                            "country": "Opened",
                                                            "color": "#1CAF9A",
                                                            "value": {{ $opened }}
                                                            },{
                                                            "country": "Unopened",
                                                            "color": "#FF8000",
                                                            "value": {{ $unopened }}
                                                        }];

                                                    });
                                                </script>
                                                <div id="chartdiv3" data-name="RpfOgSjL"> <img id="loaderImg" class="opensChart" src="/resources/assets/images/loader.gif"></div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="kt-portlet kt-portlet--bordered" data-name="IWWavdQE">
                                            <div class="kt-portlet__head" data-name="vvhnaqwk">
                                                <div class="kt-portlet__head-label" data-name="ICAKQmEY">
                                                    <h3 class="kt-portlet__head-title">
                                                        {{trans('common.stats.sent')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body relative" data-name="youjaQYP">
                                                <script type="text/javascript" src="/themes/default/js/map/anychart-base.min.js"></script>
                                                <script type="text/javascript" src="/themes/default/js/map/anychart-ui.min.js"></script>
                                                <script type="text/javascript" src="/themes/default/js/map/anychart-map.min.js"></script>
                                                <script type="text/javascript" src="/themes/default/js/map/anychart-data-adapter.min.js"></script>
                                                <script type="text/javascript" src="/themes/default/js/map/world.js"></script>
                                                <script type="text/javascript">

                                                    function loadmap() { 

                                                        anychart.onDocumentReady(function () {

                                                            var url = app_url+"/campaign-chart/"+{{$campaign_schedule_id}};

                                                            anychart.data.loadJsonFile(url,
                                                                function (data) {
                                                                var map = anychart.map();
                                                                map.geoData('anychart.maps.world');
                                                                map.interactivity().selectionMode('none');
                                                                map.padding(0);

                                                                var dataSet = anychart.data.set(data);
                                                                var densityData = dataSet.mapAs({ value: 'values' });
                                                                var series = map.choropleth(densityData);

                                                                series.labels(false);

                                                                series
                                                                    .hovered()
                                                                    .fill('#1caf9a')
                                                                    .stroke(anychart.color.darken('#1caf9a'));

                                                                series
                                                                    .selected()
                                                                    .fill('#c2185b')
                                                                    .stroke(anychart.color.darken('#c2185b'));

                                                                series
                                                                    .tooltip()
                                                                    .useHtml(true)
                                                                    .format(function () {
                                                                        return (
                                                                            '<span style="color: #d9d9d9">Value</span>: ' +
                                                                            parseFloat(this.value).toLocaleString() 
                                                                        );
                                                                    });

                                                                var scale = anychart.scales.ordinalColor([
                                                                    { less: 10 },
                                                                    { from: 10, to: 30 },
                                                                    { from: 30, to: 50 },
                                                                    { from: 50, to: 100 },
                                                                    { from: 100, to: 200 },
                                                                    { from: 200, to: 300 },
                                                                    { from: 300, to: 500 },
                                                                    { from: 500, to: 1000 },
                                                                    { greater: 1000 }
                                                                ]);
                                                                scale.colors([
                                                                    '#81d4fa',
                                                                    '#4fc3f7',
                                                                    '#29b6f6',
                                                                    '#039be5',
                                                                    '#0288d1',
                                                                    '#0277bd',
                                                                    '#01579b',
                                                                    '#014377',
                                                                    '#000000'
                                                                ]);

                                                                var colorRange = map.colorRange();
                                                                colorRange.enabled(true).padding([0, 0, 20, 0]);
                                                                colorRange
                                                                    .ticks()
                                                                    .enabled(true)
                                                                    .stroke('3 #ffffff')
                                                                    .position('center')
                                                                    .length(7);
                                                                colorRange.colorLineSize(5);
                                                                colorRange.marker().size(7);
                                                                colorRange
                                                                    .labels()
                                                                    .fontSize(11)
                                                                    .padding(3, 0, 0, 0)
                                                                    .format(function () {
                                                                    var range = this.colorRange;
                                                                    var name;
                                                                    if (isFinite(range.start + range.end)) {
                                                                        name = range.start + ' - ' + range.end;
                                                                    } else if (isFinite(range.start)) {
                                                                        name = 'More than ' + range.start;
                                                                    } else {
                                                                        name = 'Less than ' + range.end;
                                                                    }
                                                                    return name;
                                                                    });

                                                                    series.colorScale(scale);
                                                                    var zoomController = anychart.ui.zoom();
                                                                    zoomController.render(map);
                                                                    map.container('regions_div');
                                                                    map.draw();
                                                                }
                                                            );
                                                        });
                                                    }
                                                    loadmap();
                                                </script>
                                                <script type="text/javascript">
                                                    function drawRegionsMap() {
                                                        loadmap();
                                                        var jsonData = $.ajax({
                                                            url: "/campaign-chart/"+{{$campaign_schedule_id}},
                                                            dataType: "json",
                                                            async: false
                                                        }).responseText;
                                                        var newData = JSON.parse(jsonData);
                                                        var options = {
                                                            colors: ['#1CAF9A']
                                                        };

                                                        chart.draw(data, options);
                                                    }
                                                </script>
                                                <div id="regions_div" style="width: 100%; height: 300px;" data-name="DsansZnc"><img id="loaderImg" class="opensChart" src="/resources/assets/images/loader.gif"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                          <div class="tab-pane active" id="tab1" data-name="pWgvMrCB">
                                <div class="form-group row" data-name="jmSduEhr">
                                    <div class="col-md-6" data-name="ElCgPgus">
                                        <table id="summery" class="table table-striped table-hover table-checkable responsive">
                                            <tbody>
                                            <tr>
                                                <td> {{trans('statistics.detail.schedule_label')}} </td>
                                                <td>
                                                    <span class=""> {{ $campaign->name }}  </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:40%"> {{trans('statistics.detail.username')}} </td>
                                                <td style="width:60%">
                                                    <span class="">{{Auth::user()->name}} ({{ Auth::user()->email }}, {{ Auth::user()->id }})</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('common.label.contact_lists')}}</td>
                                                <td>
                                                    @if(!empty($list_names))
                                                    <span class=""> {{ $list_names }}  </span>
                                                    @else
                                                    <span class=""> {{trans('statistics.detail.deleted_list')}}  </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('statistics.detail.broadcasts')}}</td>
                                                <td>
                                                    <span class=""> {{ $campaign_names }} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('statistics.detail.sending_nodes')}}</td>
                                                <td>
                                                    <span class=""> {{ $smtp_names }}  </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>{{trans('statistics.detail.sending_time')}} </td>
                                                <td>
                                                    <span class=""> {{ isset($campaign->start_datetime) ?  showDateTime(Auth::user(), $campaign->start_datetime) : '---'}} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('statistics.detail.finished_time')}} </td>
                                                <td>
                                                    <span class=""> {{ ($campaign->end_datetime) && $campaign_sent >= $total_emails ? showDateTime(Auth::user(), $campaign->end_datetime) : '---'}}</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> {{trans('statistics.detail.campaign_duration')}} </td>
                                                @if($campaign->type == "trigger") 
                                                <td>
                                                    <span class="">
                                                      @if(!empty($firstActivityAt))
                                                       <?php
                                                           $start_date = Carbon\Carbon::parse($firstActivityAt);
                                                           $end_date  = Carbon\Carbon::now();
                                                           echo $diff = $start_date->diffForHumans($end_date, true);
                                                       ?>
                                                      @else
                                                       ---
                                                      @endif
                                                    </span>
                                                </td>
                                                @else

                                                <td>
                                                    <span class="">

                                                        @if($campaign_sent && ($campaign_sent >= $total_emails))
                                                            @php
                                                                $days = $hours = $minutes = $seconds = 0;
                                                                    $start_date = Carbon\Carbon::parse($campaign->start_datetime);
                                                                    $end_date = Carbon\Carbon::parse($campaign->end_datetime);
                                                                    if(($campaign->end_datetime) && $start_date < $end_date) {
                                                                        $days = $start_date->diffInDays($end_date);
                                                                        $hours = $start_date->copy()->addDays($days)->diffInHours($end_date);
                                                                        $minutes = $start_date->copy()->addDays($days)->addHours($hours)->diffInMinutes($end_date);
                                                                        $seconds = $start_date->copy()->addDays($days)->addHours($hours)->addMinutes($minutes)->diffInSeconds($end_date);
                                                                    } else {
                                                                        echo '---';
                                                                    }
                                                            @endphp

                                                            @if(($campaign->end_datetime) && $campaign_sent >= $total_emails && ($campaign->end_datetime) >= $campaign->start_datetime)
                                                                @if($days != 0)
                                                                    {{ $days . ' days' }}
                                                                @endif
                                                                @if($hours != 0)
                                                                    {{ $hours . ' hours' }}
                                                                @endif
                                                                @if($minutes != 0)
                                                                    {{ $minutes . ' minutes ' }}
                                                                @endif
                                                                @if($seconds != 0)
                                                                    {{ $seconds . ' seconds' }}
                                                                @endif
                                                            @endif
                                                        @else
                                                            ---
                                                        @endif

                                                    </span>
                                                </td>
                                                @endif
                                            </tr>

                                            <tr>
                                                <td> {{trans('common.label.status')}} </td>
                                                <td>
                                                    @if($campaign->type == "trigger") 
                                                        <span class=""> {{ $triggerStatus }} </span>
                                                    @else 
                                                        <span class=""> {{ $campaign->status == 'processing' ? 'Running' : ucfirst($campaign->status) }} </span>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $total = $skipped + $total_emails;
                                                if($total > 0){
                                                    $skipped_percent = ($skipped/$total) * 100;
                                                }
                                                else{
                                                    $skipped_percent = 0;
                                                }
                                                ?>
                                                <td> {{trans('statistics.detail.total_contacts')}} </td>
                                                <td>
                                                    <span class=""> {{$total}} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.sent')}} </td>
                                                <td>
                                                    <span class=""> {{$campaign_sent}} </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> {{ trans('common.stats.skipped') }} </td>
                                                <td>
                                                    <span class=""> {{ $skipped }}  @if($skipped > 0) <a class="skippedView" data-duplicate="{{$duplicates}}" data-suppressed_domains="{{$suppressed_domains}}" data-bounced="{{$campaign_bounced}}"  data-unsubscribed="{{$unsubscribed}}" data-in_active="{{$in_active}}" data-not_confirmed="{{$not_confirmed}}" data-suppressed="{{$suppressed}}" data-id="{{$campaign_schedule_id}}" href="javascript:void(0);"> <i class="la la-eye"></i> </a> @endif</span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> {{trans('common.stats.opened')}} </td>
                                                <td>
                                                    <span data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="@lang('statistics.detail.opened_title')">{{ $opened }} / {{$total_opens }}
                                                        {{ ($opened) ? "(".round(($opened* 100) / $campaign_sent, 2) ." % )" : "(0  % )" }}

                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.clicked')}} </td>
                                                <td>
                                                    <span data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="@lang('statistics.detail.clicked_title')"> {{ $clicked }} / {{ $total_clicked }}
                                                        {{ $clicked ? "(".round(($clicked* 100) / $campaign_sent, 2) ." % )" : "(0  % )" }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.ctr')}} </td>
                                                <td>
                                                    <span class="" title="{{trans('common.stats.ctr')}}">
                                                        <?php 
                                                            if($opened <= 0) { 
                                                                $opened = $clicked;
                                                            }
                                                        ?>

                                                        {{ $clicked ? round(($clicked/$opened) * 100, 2) . " % " : "0  % " }}
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.bounced')}} </td>
                                                <td>
                                                    <span data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="@lang('statistics.detail.bounces_title')"> {{$campaign_bounced}}
                                                        @if($campaign_sent > 0) {{ $campaign_bounced ? "(".round(($campaign_bounced * 100) / $campaign_sent, 2) ." % )" : "(0  % )" }} @endif
                                                    </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.stats.unsubscribed')}} </td>
                                                <td>
                                                    <span data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="@lang('statistics.detail.unsubs_title')"> {{$unsubscribed}}
                                                        @if($campaign_sent > 0) {{ $unsubscribed ? "(".round(($unsubscribed * 100) / $campaign_sent, 2) ." % )" : "(0  % )" }}  @endif
                                                    </span>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> {{trans('statistics.detail.threads')}} </td>
                                                <td>
                                                    <span class=""> {{ isset($campaign->thread_settings) ? $campaign->thread_settings : 10  }}</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.label.track_opens')}} </td>
                                                <td>
                                                    <span class=""> {{$campaign->track_opens == 1 ? trans('common.form.buttons.yes') : trans('common.form.buttons.no')}} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.label.track_clicks')}} </td>
                                                <td>
                                                    <span class=""> {{$campaign->track_clicks == 1 ? trans('common.form.buttons.yes') : trans('common.form.buttons.no')}} </span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{trans('common.label.embed_unsubscribe_link')}} </td>
                                                <td>
                                                    <span class=""> {{$campaign->unsub_show == 1 ? trans('common.form.buttons.yes') : trans('common.form.buttons.no')}} </span>
                                                </td>
                                            </tr>
                                            <!--<tr>
                                                <td> {{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.title')}} </td>
                                                <td>
                                                    <span class=""><a href="javascript:;" onclick="loadContent('from_smtp', {{$campaign_schedule_id}})"> {{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.values.from_smtp')}} </a></span>
                                                </td>
                                            </tr> -->
                                            <tr>
                                                <td> {{trans('statistics.detail.scheduled_by')}} </td>
                                                <td>
                                                    <span class="">{{ getUserEmail($campaign->user_id) }} On {{ showDateTime(Auth::user()->id, $campaign->created_at, 1)}} </span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 por" data-name="IIIVhxiI">
                                        <div class="row">
                                            <div class="col-md-3 summary-stats">
                                                <div class="topevents">
                                                    <div class="icon">
                                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon text-success">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                                <path d="M6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,12 C19,12.5522847 18.5522847,13 18,13 L6,13 C5.44771525,13 5,12.5522847 5,12 L5,3 C5,2.44771525 5.44771525,2 6,2 Z M7.5,5 C7.22385763,5 7,5.22385763 7,5.5 C7,5.77614237 7.22385763,6 7.5,6 L13.5,6 C13.7761424,6 14,5.77614237 14,5.5 C14,5.22385763 13.7761424,5 13.5,5 L7.5,5 Z M7.5,7 C7.22385763,7 7,7.22385763 7,7.5 C7,7.77614237 7.22385763,8 7.5,8 L10.5,8 C10.7761424,8 11,7.77614237 11,7.5 C11,7.22385763 10.7761424,7 10.5,7 L7.5,7 Z" id="Combined-Shape" fill="#000000" opacity="0.3"/>
                                                                <path d="M3.79274528,6.57253826 L12,12.5 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 Z" id="Combined-Shape" fill="#000000"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="content">
                                                        {{trans('common.stats.opened')}}
                                                        <span>{{ $opened }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 summary-stats">
                                                <div class="topevents">
                                                    <div class="icon">
                                                        <svg width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon text-info">
                                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                                <rect id="bound" x="0" y="0" width="24" height="24"/>
                                                                <path d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z" id="check" fill="#000000" fill-rule="nonzero" opacity="0.8"/>
                                                                <path d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z" id="Combined-Shape" fill="#000000"/>
                                                            </g>
                                                        </svg>
                                                    </div>
                                                    <div class="content">
                                                        {{trans('common.stats.clicked')}}
                                                        <span>{{ $clicked }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 summary-stats">
                                                <div class="topevents">
                                                    <div class="icon">
                                                        <i class="fa fa fa-hand-paper text-warning fa-lg"></i>
                                                    </div>
                                                    <div class="content">
                                                        {{trans('common.stats.unsubscribed')}}
                                                        <span>{{$unsubscribed}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 summary-stats">
                                                <div class="topevents">
                                                    <div class="icon">
                                                        <i class="fa fa-window-close text-danger fa-lg"></i>
                                                    </div>
                                                    <div class="content">
                                                        {{trans('common.stats.bounced')}}
                                                        <span>{{$campaign_bounced}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" id="email-opened" value="{{$opened}}" />
                                        <input type="hidden" id="email-clicked" value="{{$clicked}}" />
                                        <input type="hidden" id="email-bounced" value="{{$campaign_bounced}}" />
                                        <input type="hidden" id="email-unopend" value="{{(int)$campaign_sent - (int)$opened - (int)$campaign_bounced}}" />
<!--                                         Top domain Chart for the campaign-->      
                                        @if($topDomainData!="")
                                        <div class="kt-portlet kt-portlet--bordered" data-name="dDgGVYur">
                                            <div class="kt-portlet__head" data-name="FfdwTJfD">
                                                <div class="kt-portlet__head-label" data-name="smiRuUNg">
                                                    <h3 class="kt-portlet__head-title">
                                                        {{trans('dashboard.top_domains')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            
                                            <div class="kt-portlet__body relative" data-name="DMLfwPjx">
                                                <script src="/themes/default/js/charts/core.js"></script>
                                                <script src="/themes/default/js/charts/charts.js"></script>
                                                <script src="/themes/default/js/charts/animated.js"></script>
                                                <script>
                                                    am4core.useTheme(am4themes_animated);
                                                    var topDomainData = <?php echo $topDomainData?>;
                                                    var chart = am4core.create("top-domains", am4charts.XYChart);
                                                    chart.scrollbarX = new am4core.Scrollbar();
                                                    // chart.zoomOutButton.disabled = true;

                                                    chart.data = topDomainData;

                                                    chart.scrollbarX.disabled = true;
                                                    chart.scrollbarX.startGrip.disabled = true;
                                                    chart.scrollbarX.endGrip.disabled = true;

                                                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                                                    categoryAxis.dataFields.category = "domain";
                                                    categoryAxis.renderer.grid.template.location = 0;
                                                    categoryAxis.renderer.minGridDistance = 30;
                                                    categoryAxis.renderer.labels.template.horizontalCenter = "right";
                                                    categoryAxis.renderer.labels.template.verticalCenter = "middle";
                                                    categoryAxis.renderer.labels.template.rotation = -50;
                                                    categoryAxis.tooltip.disabled = true;
                                                    categoryAxis.renderer.minHeight = 80;

                                                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                                                    valueAxis.renderer.minWidth = 50;

                                                    var series = chart.series.push(new am4charts.ColumnSeries());
                                                    series.sequencedInterpolation = true;
                                                    series.dataFields.valueY = "visits";
                                                    series.dataFields.categoryX = "domain";
                                                    series.tooltipText = "{categoryX}: [bold]{valueY}[/]";
                                                    series.columns.template.strokeWidth = 0;

                                                    series.tooltip.pointerOrientation = "vertical";

                                                    //series.columns.template.column.cornerRadiusTopLeft = 10;
                                                    //series.columns.template.column.cornerRadiusTopRight = 10;
                                                    series.columns.template.column.fillOpacity = 0.7;

                                                    var hoverState = series.columns.template.column.states.create("hover");
                                                    //hoverState.properties.cornerRadiusTopLeft = 0;
                                                    //hoverState.properties.cornerRadiusTopRight = 0;
                                                    hoverState.properties.fillOpacity = 1;

                                                    series.columns.template.adapter.add("fill", function(fill, target) {
                                                        return chart.colors.getIndex(target.dataItem.index);
                                                    });

                                                    chart.cursor = new am4charts.XYCursor();
                                                </script>
                                                <div id="top-domains"></div>	
                                            </div>
                                        </div>
                                        @endif
                                        <?php
                                                    $openPercentage = 0;
                                                    $total_emails = $total_emails<$opened ? $campaign_sent:$total_emails;
                                                    $unopened = 0;
                                                    if($total_emails > 0){
                                                            $openPercentage = ceil(($opened/$total_emails)*100);
                                                            $unopened = $total_emails-$opened;
                                                    }
                                                    $unopendEnd = ceil(100-$openPercentage);
                                                ?>
                                        @if($open_unopen_chart=='horizontal_bar_graph')
                                        <div class="kt-portlet kt-portlet--bordered" data-name="dDgGVYur">
                                            <div class="kt-portlet__head" data-name="FfdwTJfD">
                                                <div class="kt-portlet__head-label" data-name="smiRuUNg">
                                                    <h3 class="kt-portlet__head-title">
                                                        {{trans('common.stats.chart_opened')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body relative" data-name="DMLfwPjx">
                                                
                                                <div class="row ouc-blk">
                                                    <div class="col-md-6">
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-success"></span>
                                                            <span class="kt-widget14__stats" style="">{{ $openPercentage }}% {{trans('common.status.span_opened_total')}}</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="kt-widget14__legend">
                                                            <span class="kt-widget14__bullet kt-bg-warning"></span>
                                                            <span class="kt-widget14__stats" style="">{{ $unopendEnd }}% {{trans('common.status.span_unopen_total')}} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress">
                                                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ $openPercentage }}%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Opened {{ $openPercentage }}%">{{ $openPercentage }}%</div>
                                                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{ $unopendEnd }}%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100" data-toggle="kt-tooltip" data-placement="top" title="" data-original-title="Unopened {{ $unopendEnd }}%">{{ $unopendEnd }}%</div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="kt-portlet kt-portlet--bordered" data-name="dDgGVYur">
                                            <div class="kt-portlet__head" data-name="FfdwTJfD">
                                                <div class="kt-portlet__head-label" data-name="smiRuUNg">
                                                    <h3 class="kt-portlet__head-title">
                                                        {{trans('common.stats.chart_opened')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body relative" data-name="DMLfwPjx">
                                                <!-- Resources -->
                                                <script src="/themes/default/js/charts/core.js"></script>
                                                <script src="/themes/default/js/charts/charts.js"></script>
                                                <script src="/themes/default/js/charts/animated.js"></script>

                                                <!-- Chart code -->
                                                <script>
                                                    am4core.ready(function() {
                                                        am4core.useTheme(am4themes_animated);
                                                        var chart = am4core.create("chartdiv3", am4charts.PieChart);
                                                        var pieSeries = chart.series.push(new am4charts.PieSeries());
                                                        pieSeries.dataFields.value = "value";
                                                        pieSeries.dataFields.category = "country";
                                                        pieSeries.dataFields.fill = "color";
                                                        chart.innerRadius = am4core.percent(30);
                                                        pieSeries.slices.template.stroke = am4core.color("#fff");
                                                        pieSeries.slices.template.strokeWidth = 2;
                                                        pieSeries.slices.template.strokeOpacity = 1;
                                                        pieSeries.slices.template.propertyFields.fill = "color";
                                                        pieSeries.slices.template
                                                        .cursorOverStyle = [
                                                            {
                                                            "property": "cursor",
                                                            "value": "pointer"
                                                            }
                                                        ];
                                                        pieSeries.alignLabels = false;
                                                        pieSeries.labels.template.bent = false;
                                                        pieSeries.labels.template.radius = 3;
                                                        pieSeries.labels.template.padding(0,0,0,0);
                                                        pieSeries.ticks.template.disabled = true;
                                                        var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
                                                        shadow.opacity = 0;
                                                        var hoverState = pieSeries.slices.template.states.getKey("hover");
                                                        var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
                                                        hoverShadow.opacity = 0.7;
                                                        hoverShadow.blur = 5;
                                                        chart.legend = new am4charts.Legend();

                                                        chart.data = [{
                                                            "country": "Opened",
                                                            "color": "#1CAF9A",
                                                            "value": {{ $opened }}
                                                            },{
                                                            "country": "Unopened",
                                                            "color": "#FF8000",
                                                            "value": {{ $unopened }}
                                                        }];

                                                    });
                                                </script>
                                                <div id="chartdiv3" data-name="RpfOgSjL"> <img id="loaderImg" class="opensChart" src="/resources/assets/images/loader.gif"></div>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        <div class="kt-portlet kt-portlet--bordered" data-name="cLnXdosC">
                                            <div class="kt-portlet__head" data-name="BBACFDXl">
                                                <div class="kt-portlet__head-label" data-name="pZWcFYnB">
                                                    <h3 class="kt-portlet__head-title">
                                                        {{trans('common.stats.country_clicked')}}
                                                    </h3>
                                                </div>
                                            </div>
                                            <div class="kt-portlet__body relative" data-name="sKLeDTSJ">
                                                <script type="text/javascript" src="/themes/default/js/map/anychart-base.min.js"></script>
                                                <script type="text/javascript" src="/themes/default/js/map/anychart-ui.min.js"></script>
                                                <script type="text/javascript" src="/themes/default/js/map/anychart-map.min.js"></script>
                                                <script type="text/javascript" src="/themes/default/js/map/anychart-data-adapter.min.js"></script>
                                                <script type="text/javascript" src="/themes/default/js/map/world.js"></script>
                                                <script type="text/javascript">

                                                    function loadmap() { 

                                                        anychart.onDocumentReady(function () {

                                                            var url = app_url+"/campaign-chart/"+{{$campaign_schedule_id}};

                                                            anychart.data.loadJsonFile(url,
                                                                function (data) {
                                                                var map = anychart.map();
                                                                map.geoData('anychart.maps.world');
                                                                map.interactivity().selectionMode('none');
                                                                map.padding(0);

                                                                var dataSet = anychart.data.set(data);
                                                                var densityData = dataSet.mapAs({ value: 'values' });
                                                                var series = map.choropleth(densityData);

                                                                series.labels(false);

                                                                series
                                                                    .hovered()
                                                                    .fill('#1caf9a')
                                                                    .stroke(anychart.color.darken('#1caf9a'));

                                                                series
                                                                    .selected()
                                                                    .fill('#c2185b')
                                                                    .stroke(anychart.color.darken('#c2185b'));

                                                                series
                                                                    .tooltip()
                                                                    .useHtml(true)
                                                                    .format(function () {
                                                                        return (
                                                                            '<span style="color: #d9d9d9">Value</span>: ' +
                                                                            parseFloat(this.value).toLocaleString() 
                                                                        );
                                                                    });

                                                                var scale = anychart.scales.ordinalColor([
                                                                    { less: 10 },
                                                                    { from: 10, to: 30 },
                                                                    { from: 30, to: 50 },
                                                                    { from: 50, to: 100 },
                                                                    { from: 100, to: 200 },
                                                                    { from: 200, to: 300 },
                                                                    { from: 300, to: 500 },
                                                                    { from: 500, to: 1000 },
                                                                    { greater: 1000 }
                                                                ]);
                                                                scale.colors([
                                                                    '#81d4fa',
                                                                    '#4fc3f7',
                                                                    '#29b6f6',
                                                                    '#039be5',
                                                                    '#0288d1',
                                                                    '#0277bd',
                                                                    '#01579b',
                                                                    '#014377',
                                                                    '#000000'
                                                                ]);

                                                                var colorRange = map.colorRange();
                                                                colorRange.enabled(true).padding([0, 0, 20, 0]);
                                                                colorRange
                                                                    .ticks()
                                                                    .enabled(true)
                                                                    .stroke('3 #ffffff')
                                                                    .position('center')
                                                                    .length(7);
                                                                colorRange.colorLineSize(5);
                                                                colorRange.marker().size(7);
                                                                colorRange
                                                                    .labels()
                                                                    .fontSize(11)
                                                                    .padding(3, 0, 0, 0)
                                                                    .format(function () {
                                                                    var range = this.colorRange;
                                                                    var name;
                                                                    if (isFinite(range.start + range.end)) {
                                                                        name = range.start + ' - ' + range.end;
                                                                    } else if (isFinite(range.start)) {
                                                                        name = 'More than ' + range.start;
                                                                    } else {
                                                                        name = 'Less than ' + range.end;
                                                                    }
                                                                    return name;
                                                                    });

                                                                    series.colorScale(scale);
                                                                    var zoomController = anychart.ui.zoom();
                                                                    zoomController.render(map);
                                                                    map.container('regions_div');
                                                                    map.draw();
                                                                }
                                                            );
                                                        });
                                                    }
                                                    loadmap();
                                                </script>
                                                <script type="text/javascript">
                                                    function drawRegionsMap() {
                                                        loadmap();
                                                        var jsonData = $.ajax({
                                                            url: app_url+"/campaign-chart/"+{{$campaign_schedule_id}},
                                                            dataType: "json",
                                                            async: false
                                                        }).responseText;
                                                        var newData = JSON.parse(jsonData);
                                                        var options = {
                                                            colors: ['#1CAF9A']
                                                        };

                                                        chart.draw(data, options);
                                                    }
                                                </script>
                                                <div id="regions_div" style="width: 100%; height: 300px;" data-name="qmUthtZp">
                                                    <!-- <img id="loaderImg" class="opensChart" src="/resources/assets/images/loader.gif"> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                      @if($bounceStats)
                        <div class="tab-pane" id="tab2" data-name="OZBywzAf">
                            <div class="table-scrollable col-md-12">
                                <table class="table table-striped table-hover table-checkable" id="spintag" role="grid" >
                                    <thead>
                                        <tr role="row">
                                            <th>{{trans('statistics.detail.ocu.column.id')}}</th>
                                            <th>{{trans('statistics.detail.ocu.column.email')}}</th>
                                            <th>{{trans('statistics.detail.bounced.column.bounce_type')}}</th>
                                            <th>{{trans('statistics.detail.bounced.column.code')}}</th>
                                            <th>{{trans('statistics.detail.bounced.column.bounce_reason')}}</th>
                                            <th>{{trans('statistics.detail.bounced.column.bounce_details')}}</th>
                                            <th>{{trans('statistics.detail.ocu.column.open_time')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      @endif
                      @if($openStats)
                        <div class="tab-pane" id="tab3" data-name="GSIuYMRi">
                            <div class="dataTables_wrapper no-footer" data-name="QeYhmhsS">
                                <div class="row opens_filter" style="padding-bottom: 15px; width:150px; padding-left: 10px;" data-name="hJUwGtEL" >
                                    <select class="form-control m-select2 mb15" id="opensType" name="opensType" size="1">
                                        <option value="all">{{trans('statistics.all')}}</option>
                                        <option value="unique">{{trans('statistics.unique')}}</option>                                                      
                                    </select>
                                </div>

                                <div id="open_bots" class="bots_block">
                                    <label class="col-form-label" for="exclude_bots">Exclude bots</label>
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                        <label>
                                            <input type="checkbox" name="exclude_bots" id="exclude_bots">
                                            <span></span>
                                        </label>
                                    </span>
                                    <label class="col-form-label" for="showEmail">Display Emails</label>
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                        <label>
                                            <input type="checkbox" name="showEmail" id="showEmail">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>

                                <div class="table-scrollable col-md-12">
                                    <table class="table table-striped table-hover table-checkable" id="opens" role="grid" >
                                        <thead>
                                            <tr role="row">
                                                <th>{{trans('statistics.detail.ocu.column.id')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.email')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.list')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.open_ip')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.bots')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.city')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.region')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.zip')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.country')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.browser')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.os')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.open_time')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      @endif
                      @if($clickStats)
                        <div class="tab-pane" id="tab4" data-name="FhDpMCHP">
                            <span class="refreshResult clicked">
                                <span> @lang('statistics.every_minute') @if (!empty($last_run->datetime))@lang('statistics.last_updated') {{date("h:iA" , strtotime(convertUtctoCustomer(2, $last_run->datetime)))}} @endif</span> <span class="bg-icon"><i class="la la-refresh"></i></span>
                            </span>
                            <div class="dataTables_wrapper no-footer" data-name="cVlElBbv">
                                <div class="row opens_filter" style="padding-bottom: 15px; width:150px; padding-left: 10px;" data-name="VESesmkX" >
                                    <select class="form-control m-select2 mb15" id="clicksType" name="clicksType" size="1">
                                        <option value="all">{{trans('statistics.all')}}</option>
                                        <option value="unique">{{trans('statistics.unique')}}</option>   
                                    </select>
                                </div>


                                <div id="click_bots" class="bots_block">
                                    <label class="col-form-label" for="click_exclude_bots">Exclude bots</label>
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                        <label>
                                            <input type="checkbox" name="click_exclude_bots" id="click_exclude_bots">
                                            <span></span>
                                        </label>
                                    </span>

                                    <label class="col-form-label" for="clickShowEmail">Display Emails</label>
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                        <label>
                                            <input type="checkbox" name="clickShowEmail" id="clickShowEmail">
                                            <span></span>
                                        </label>
                                    </span>

                                </div>

                                <div class="table-scrollable col-md-12">
                                    <table class="table table-striped table-hover table-checkable" id="clicked" role="grid" >
                                        <thead>
                                            <tr role="row">
                                                <th>{{trans('statistics.detail.ocu.column.id')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.email')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.list')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.link_clicked')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.open_ip')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.bots')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.city')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.region')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.zip')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.country')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.browser')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.os')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.open_time')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                      @endif
                      @if($unsubStats)
                        <div class="tab-pane" id="tab5" data-name="PsKUQKKT">
                            <div class="table-scrollable col-md-12">
                                <table class="table table-striped table-hover table-checkable" id="unsubscribed" role="grid" >
                                    <thead>
                                        <tr role="row">
                                        <th>{{trans('statistics.detail.ocu.column.id')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.email')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.list')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.open_ip')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.city')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.region')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.zip')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.country')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.browser')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.os')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.open_time')}}</th>  
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      @endif
                      @if($complaintStats)
                        <div class="tab-pane" id="tab6" data-name="DdZEklNA">
                            <div class="table-scrollable col-md-12">
                                <table class="table table-striped table-hover table-checkable" id="complaints" role="grid" >
                                    <thead>
                                        <tr role="row">
                                            <th>{{trans('statistics.detail.ocu.column.id')}}</th>
                                            <th>{{trans('statistics.detail.ocu.column.email')}}</th>
                                            <th>{{trans('statistics.detail.ocu.column.open_time')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                      @endif
                      <div class="tab-pane" id="tab7" data-name="yWQsKqMJ">
                            <div class="dataTables_wrapper no-footer" data-name="gOCnfRHs">
                                 <i class='btn btn-xs btn-default green'><span onclick="loadLogs('all')">{{trans('statistics.all')}}</span>
                                </i> &nbsp;&nbsp;
                                @if($statuses[0]->delivered)
                                <i class='btn btn-xs btn-default blue'><span onclick="loadLogs('delivered')">{{trans('common.stats.delivered')}}</span>
                                </i> &nbsp;&nbsp;
                                @endif
                                @if($statuses[0]->opened)
                                <i class='btn btn-xs btn-default green'><span onclick="loadLogs('open')">{{trans('common.stats.opened')}}</span>
                                </i> &nbsp;&nbsp;
                                @endif
                                @if($statuses[0]->clicked)
                                <i class='btn btn-xs btn-default purple'><span onclick="loadLogs('click')">
                                {{trans('common.stats.clicked')}}</span>
                                </i>&nbsp;&nbsp;
                                @endif
                                @if($statuses[0]->unsubscribed)
                                <i class='btn btn-xs btn-warning'><span onclick="loadLogs('unsub')">
                                {{trans('common.stats.unsubscribed')}}</span>
                                </i>&nbsp;&nbsp;
                                @endif
                                
                                @if($statuses[0]->bounced)
                                <i class='btn btn-xs btn-default yellow-casablanca'><span onclick="loadLogs('bounce')">
                                {{trans('common.stats.bounced')}}</span>
                                </i>&nbsp;&nbsp;
                                @endif
                                @if($statuses[0]->spammed)
                                <i class='btn btn-xs btn-default red-thunderbird'><span onclick="loadLogs('spam')">
                                {{trans('common.stats.abuse')}}</span>
                                </i>&nbsp;&nbsp;
                                 @endif
                                 
                                @if($statuses[0]->delayed)
                                <i class='btn btn-xs btn-default delayed-thunderbird'><span onclick="loadLogs('delayed')">
                                {{trans('common.stats.delayed')}}</span>
                                </i>&nbsp;
                                @endif
                                @if($statuses[0]->injected)
                                <i class='btn btn-xs btn-default injected-thunderbird'><span onclick="loadLogs('injected')">
                                {{trans('common.stats.injected')}}</span>
                                </i>&nbsp;
                                @endif
                                <br><br>
                                <div class="table-scrollable col-md-12">
                                    <table class="table table-striped table-hover table-checkable" id="logs" role="grid" >
                                        <thead>
                                            <tr role="row">
                                            <th>{{trans('statistics.detail.ocu.column.id')}}</th>
                                                <th>{{trans('statistics.detail.ocu.column.email')}}</th>
                                                <th>{{trans('statistics.detail.logs.column.activity')}}</th>
                                                <th>{{trans('statistics.detail.logs.column.status')}}</th> 
                                                <th>{{trans('statistics.detail.logs.column.sending_node')}}</th>
                                                <th>{{trans('statistics.detail.logs.column.message')}}</th>
                                                <th>{{trans('statistics.detail.logs.column.mta_response')}}</th>
                                                <th>{{trans('statistics.detail.logs.column.created_at')}}</th>
                                                <th>{{trans('statistics.detail.logs.column.last_activity')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab8" data-name="XylVbwIS">
                            <div class="table-scrollable col-md-12">
                                <table class="table table-striped table-hover table-checkable" id="delivered" role="grid" >
                                    <thead>
                                        <tr role="row">
                                            <th>{{trans('statistics.detail.ocu.column.id')}}</th>
                                            <th>{{trans('statistics.detail.ocu.column.email')}}</th>
                                            <th>{{trans('statistics.detail.logs.column.status')}}</th> 
                                            <th>{{trans('statistics.detail.logs.column.sending_node')}}</th>
                                            <th>{{trans('statistics.detail.logs.column.message')}}</th>
                                            <th>{{trans('statistics.detail.logs.column.created_at')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab9" data-name="hWzkEOgW">
                            <div class="dataTables_wrapper no-footer" data-name="UrrIjvcA">
                                <div class="row" data-name="uinBQDfF">
                                    <div class="col-md-6" data-name="NhBaxJbc">
                                       <div class="kt-radio-inline" data-name="UtdtVFuQ">
                                            <label class="kt-radio">
                                                <input type="radio" name="optionsRadios" onClick="loadContent('contact_list' , {{$campaign_schedule_id}})" checked="" id="contact_list_db"> {{trans('common.label.contact_lists')}}
                                                <span></span>
                                            </label>
                                            <label class="kt-radio">
                                                <input type="radio" name="optionsRadios" onClick="loadContent('campaign_list' , {{$campaign_schedule_id}})"> {{trans('common.label.campaigns')}}
                                                <span></span>
                                            </label>
                                            <label class="kt-radio">
                                                <input type="radio" name="optionsRadios" onClick="loadContent('smtp_list' , {{$campaign_schedule_id}})"> {{trans('common.apps.smtp')}}
                                                <span></span>
                                            </label>
                                           <label class="kt-radio">
                                                <input type="radio" name="optionsRadios" onClick="loadContent('top_ten_clicks' , {{$campaign_schedule_id}})"> {{trans('common.apps.top_ten_clicks')}}
                                                <span></span>
                                            </label>

                                            <label class="kt-radio">
                                                <input type="radio" name="optionsRadios" onClick="loadContent('clicks_by_browser' , {{$campaign_schedule_id}})"> {{trans('common.apps.clicks_by_browser')}}
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div id="abs" data-name="ARYZYXtl">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="tab-pane" id="tab10">
                            <div class="dataTables_wrapper no-footer">
                                <table class="table table-striped table-hover table-checkable responsive" id="conversation" role="grid" >
                                    <thead>
                                        <tr role="row">
                                            <th>{{trans('app.statistics.campaign.detail.view_all.conversation.table_headings.sr')}}</th>
                                            <th>{{trans('app.statistics.campaign.detail.view_all.conversation.table_headings.subscriber')}}</th>
                                            <th>{{trans('app.statistics.campaign.detail.view_all.conversation.table_headings.email')}}</th>
                                            <th>{{trans('app.statistics.campaign.detail.view_all.conversation.table_headings.message')}}</th>
                                            <th>{{trans('app.statistics.campaign.detail.view_all.conversation.table_headings.event')}}</th>
                                            <th>{{trans('app.statistics.campaign.detail.view_all.conversation.table_headings.created_at')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div> -->

                       

                        <div id="campaign-list" class="modal" role="dialog" aria-hidden="true" data-name="IBfsvKlj">
                            <div class="modal-dialog" style="width: 700px;" data-name="KnYGnalQ">
                                <div class="modal-content" data-name="pQkCwOxA">
                                <div class="modal-header" data-name="cjSblAYl">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.campaign_list.modal_headings.title')}}</h4>
                                </div>
                                    <div class="modal-body" style="max-height: 500px;overflow-y:auto;" data-name="uUskBMNQ">
                                        <table class="table table-striped table-hover table-checkable responsive" id="tbl-campaign-lists" role="grid" >
                                            <thead>
                                                <tr role="row">
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.campaign_list.modal_headings.sr')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.campaign_list.modal_headings.campaign')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.campaign_list.modal_headings.sent')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.campaign_list.modal_headings.opened')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.campaign_list.modal_headings.clicked')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="contact-list" class="modal" role="dialog" aria-hidden="true" data-name="xqbYtiqI">
                            <div class="modal-dialog" style="width: 700px;" data-name="ldBHsOdG">
                                <div class="modal-content" data-name="pNnQrsoB">
                                <div class="modal-header" data-name="vXpPykBJ">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.contact_list.modal_headings.title')}}</h4>
                                </div>
                                    <div class="modal-body" style="max-height: 500px;overflow-y:auto;" data-name="RMFZCGjc">
                                        <table class="table table-striped table-hover table-checkable responsive" id="tbl-contact-lists" role="grid" >
                                            <thead>
                                                <tr role="row">
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.contact_list.modal_headings.sr')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.contact_list.modal_headings.list')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.contact_list.modal_headings.sent')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.contact_list.modal_headings.opened')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.contact_list.modal_headings.clicked')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="smtp-list" class="modal" role="dialog" aria-hidden="true" data-name="bgVibyKK">
                            <div class="modal-dialog" style="width: 700px;" data-name="nlARuPjB">
                                <div class="modal-content" data-name="VYmvLGqT">
                                <div class="modal-header" data-name="aIZvaAzu">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title">{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.smtp_list.modal_headings.title')}}</h4>
                                </div>
                                    <div class="modal-body" style="max-height: 500px;overflow-y:auto;" data-name="IinRAqJu">
                                        <table class="table table-striped table-hover table-checkable responsive" id="tbl-smtp-lists" role="grid" >
                                            <thead>
                                                <tr role="row">
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.smtp_list.modal_headings.sr')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.smtp_list.modal_headings.smtp')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.smtp_list.modal_headings.sent')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.smtp_list.modal_headings.opened')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.smtp_list.modal_headings.clicked')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="from-smtp" class="modal" role="dialog" aria-hidden="true" data-name="GuUqxWmV">
                            <div class="modal-dialog" style="width: 900px;" data-name="RVLgNQFu">
                                <div class="modal-content" data-name="RLbHSwDp">
                                <div class="modal-header" data-name="RxTLwRnY">
                                    <h5 class="modal-title">{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.values.modal_headings.title')}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                </div>
                                    <div class="modal-body" style="max-height: 500px;overflow-y:auto;" data-name="arVBVtAq">
                                        <table class="table table-striped table-hover table-checkable responsive" id="tbl-from-smtps" role="grid" >
                                            <thead>
                                                <tr role="row">
                                                    <th width="20%">{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.values.modal_headings.from_name')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.values.modal_headings.from_email')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.values.modal_headings.bounce_email')}}</th>
                                                    <th>{{trans('app.statistics.campaign.detail.view_all.summery.table_headings.sender.values.modal_headings.reply_email')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody></tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
<!-- <div id="modal-loading" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
        <i id="modal-loading" class="la la-spinner fa-spin fa-5x"></i>
</div> -->
@include('statistics.common.popup_stats')

<div id="modal-subscriber-details" class="modal" role="dialog" aria-hidden="true" data-name="VvbevVTx">
    <div class="modal-dialog" style="width: 500px;" data-name="VVnsiZFa">
        <div class="modal-content" data-name="rmBAWscD">
            <div class="modal-header" data-name="JGqUXFYM">
                <h5 class="modal-title">{{trans('statistics.modal.contact_details')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="GmwDxBos">
                <form action="#" method="POST" class="form-horizontal">
                    <div class="subscriber-data" id="subscriber-data" data-name="CIGnHKgi"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- skippedModal -->
<div class="modal fade" id="skippedModal" role="dialog" data-name="sxzBLuDB">
    <div class="modal-dialog" data-name="DUZWMJeo">
    <!-- Modal content-->
    <div class="modal-content" data-name="ViyRcQvA">
        <div class="modal-header" data-name="UQuSbglc">
        <h5 class="modal-title">{{ trans('statistics.modal.skipped_details') }}</h5>
        <button type="button" class="close" data-dismiss="modal"></button>
        </div>
        <div class="modal-body" data-name="ZocsLtGH">
            <table class="table table-striped table-hover table-checkable responsive"  role="grid" >
                <tbody>
                    <tr> 
                        <td> {{ trans('statistics.modal.suppressed') }} </td>
                        <td><span id="SuppressedCount"> </span>  </td>
                    </tr>
                   
                    <tr> 
                        <td> {{ trans('common.stats.unsubscribed') }} </td>
                        <td id=""> <span id="UnsubscribedCount"> </span></td>
                    </tr>
                    <tr> 
                        <td> {{ trans('common.not_confirmed') }} </td>
                        <td id=""><span id="NotConfirmedCount"> </span> </td>
                    </tr>
                    <tr> 
                        <td> {{ trans('common.label.inactive') }}  </td>
                        <td id=""> <span id="InActiveCount"> </span> </td>
                    </tr>
                    <tr> 
                        <td> {{ trans('common.stats.bounced') }}  </td>
                        <td id=""> <span id="BouncedCount"> </span>  </td>
                    </tr>
                    <tr class="DuplicateCount"> 
                        <td> {{ trans('statistics.modal.duplicate_email') }}  </td>
                        <td id=""> <span id="DuplicateCount"> </span>  </td>
                    </tr>
                    <tr> 
                        <td> {{ trans('common.stats.spammed') }}  </td>
                        <td id=""> <span id="SpammedCount"> </span>  </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer" data-name="XyHqrZNc">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('common.form.buttons.close') }}</button>
        </div>
    </div>
    
    </div>
</div>

@endsection