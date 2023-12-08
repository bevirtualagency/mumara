@extends('layouts.master-dashboard')

@section('title', trans('dashboard.page.title'))
@php
 $app_settings = getApplicationSettings();
 $api_key=isset($app_settings['google_api_key']) && !empty($app_settings['google_api_key']) ? $app_settings['google_api_key'] : '';
@endphp
@section('page_scripts')
    <script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/perfect-scrollbar.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.counterup.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript"></script>
    <script src="/themes/default/js/slick.js" type="text/javascript"></script>
    <script>
        $('#module_list').on('click',function (){
            $.ajax({
                type: "POST",
                url: "{{route('nodeNewUi')}}",
                beforeSend:function ()
                {
                    $(".blockUI").show();
                },complete: function () {
                    $('.blockUI').hide();
                    $('#meduleMsg').slideUp('slow');
                }
            });
        });
        $(document).on('click','#sync_rules',function(e){
            e.preventDefault();
            if(confirm('{{trans('bounce_rules.message.sync_rule_alert')}}')) {
                $.ajax({
                    type: "GET",
                    url: "{{ route('sync_rules') }}",
                    cache: false,
                    beforeSend: function() {
                        $('.blockUI').show();
                    },
                    success: function (data) {
                        $('.blockUI').hide();
                        if (data.success){
                            toastr.success(data.msg);
                            $.ajax({
                                type: "POST",
                                url: "{{route('nodeNewUi')}}",
                                data:{'column':'bounce_rules_synced','value':1},
                                beforeSend:function ()
                                {
                                    $(".blockUI").show();
                                },complete: function () {
                                    $('.blockUI').hide();
                                    $('#bounceMsg').slideUp('slow');
                                }
                            });
                            location.reload();
                        }else{
                            toastr.error(data.msg);
                        }
                    },
                    error: function (data) {
                        $('.blockUI').hide();
                        toastr.error("Error");
                    }
                });
            }
        });

        function dont_show_notify(name)
        {
            $.ajax({
                type: "POST",
                url: "{{route('nodeNewUi')}}",
                data:{'flag':name},
                beforeSend:function ()
                {
                    $(".blockUI").show();
                },complete: function () {
                    $('.blockUI').hide();
                    $('#meduleMsg').slideUp('slow');
                }
            });
        }
        $('#from').datepicker({
            orientation: "bottom"
        });
        $('#to').datepicker({
            orientation: "bottom"
        });
        $('#device_from').datepicker();
        $('#device_to').datepicker();
        $('#domain_from').datepicker();
        $('#domain_to').datepicker();
        $('#geo_from').datepicker();
        $('#geo_to').datepicker();
        // ajax call for top rows dashboard stats
        var liveEventRwquest= 0;
function liveEvents(first_load=false){
    if($('#autorefreshinput').val()==1 || first_load==1){
    if($('#admin_events').is(':checked')){
         var user_id   = $('#admins').val();
         var type      = 'admins';
    }else if($('#user_events').is(':checked')){
         var user_id   = $('#clients').val();
         var type      = 'clients';
    }
       
    if(liveEventRwquest==0 || 1){
        liveEventRwquest = 1;
        $.ajax({
                    url: "{{ route('live_events') }}",
                    type: "GET",
                    data:{user_id:user_id,type:type}, 
                    success: function (data) {

                        if(data.length > 0 ){
                            var html='';
                            var classes=['text-warning','text-success','text-danger','text-info','text-primary'];
                            $.each(data,function(i,val){
                                var color_class = classes[Math.floor(Math.random() * classes.length)];
                                 html+=' <!--begin::Timeline-->\
                                    <div class="timeline timeline-6">\
                                        <!--begin::Item-->\
                                        <div class="timeline-item align-items-start">\
                                            <!--begin::Badge-->\
                                            <div class="timeline-badge">\
                                                <i class="fa fa-genderless '+color_class+' icon-xl"></i>\
                                            </div>\
                                            <!--end::Badge-->\
                                            <!--begin::Desc-->\
                                            <div class="timeline-content pl-3"><div>'+ data[i]['title'] +'</div><div class="timeline-label font-weight-bolder text-muted font-size-lg">'+data[i]['time']+'</div></div>\
                                            <!--end::Desc-->\
                                        </div>\
                                        <!--end::Item-->\
                                    </div>\
                                    <!--end::Timeline-->'; 

                            });
                            liveEventRwquest = 0;
                            $('#live-events').html(html);

                        }else{
                            var html='<div class="alert alert-warning"><div class="alert-text">{{  trans("dashboard.message.no_live_event")}}</div></div>';
                            $('#live-events').html(html);
                        }

                    }
                }); 
        }
    }
}
  
  
  liveEvents(true);
     @php
    $timeout=isset($app_settings['auto_refresh_live_events']) && ((int)$app_settings['auto_refresh_live_events']) >0 ? ((int)$app_settings['auto_refresh_live_events']):3;
    $timeout=$timeout * 1000;
    @endphp
 
    var start = setInterval(function() {
     liveEvents();
    }, {{$timeout}});



function stop() {
  clearInterval(start);
}
  @if(superAdmin(auth()->user()))
   $("#user_events").click(function() {
        $('#admins').val('');
        setTimeout(function(){
            $(".bullData").show();
            $(".treeView").hide();
            $('#admin-filter').hide();
           $('#clients').change();
        }, 250);
        
        
    });
    $("#admin_events").click(function() {
        $('#clients').val('');
        setTimeout(function(){
            $(".bullData").hide();
            $(".treeView").show();
            $('#admin-filter').show();
            $('#admins').change();
        }, 250);
       
    });
    $(document).on('change','#admins,#clients',function(){
         liveEvents(true);
    });
    $(document).on('click','#filter',function(){
        if($('#filter_row').is(':visible')){
            $('#filter_row').hide();
        }else{
            $('#filter_row').show();
        }
    });
  
    @endif
           $(document).on('change','#autorefresh',function(){
          $.ajax({
                url: "{{ route('autoRefresh') }}",
                type: "POST",
                data:{autoRefreshLiveEvents:$(this).is(':checked') ? 1:0},
                success: function (resp) {
                    if(resp==0){
                        stop();
                    }else{
                     start = setInterval(function() {
                             liveEvents();
                            }, {{$timeout}});
                    }
                   $('#autorefreshinput').val(resp);
                   liveEvents(true);

                }
            });
        
    });
        $(document).ready(function () {

            $("#g2").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
            $("#g4").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');
            $("#g3").html('<i class="fa fa-spinner fa-spin fa-lg"></i>');

            setTimeout(function(){
                $.ajax({
                    url: "{{ route('dashboardCounters') }}",
                    type: "POST",
                    success: function (data) {
                        $('#email_sent').html(data.sent_this_month);
                        $('#total_sent').val(data.sent);
                        $('#total_opened').val(data.total_opened);
                        $('#total_clicked').val(data.total_clicked);
                        $('#nodes').html(data.nodes);
                        $('#contacts').html(data.contacts);
                        $('#su').html(data.su);

                        var total_opens = document.getElementById('total_opened').value;
                        var total_clicks = document.getElementById('total_clicked').value;
                        var total_sent = document.getElementById('total_sent').value;

                        var g2 = new JustGage({
                            id: "g2",
                            value: total_sent,
                            min: 0,
                            decimals: 2,
                            max: total_sent,
                            gaugeWidthScale: 0.2,
                            humanFriendly: true,
                            humanFriendlyDecimal: 1,
                            counter: true,
                            title: "Total Sent",
                            label: "Total Sent",
                            titleFontColor: "#666",
                            startAnimationTime: 10000,
                            refreshAnimationTime: 10000,
                            levelColors: [ "#22313F" ]
                        });
                        var g3 = new JustGage({
                            id: "g3",
                            value: total_clicks,
                            min: 0,
                            max: total_sent,
                            gaugeWidthScale: 0.2,
                            humanFriendly: true,
                            humanFriendlyDecimal: 1,
                            counter: true,
                            title: "Total Clicked",
                            label: "Total Clicked",
                            titleFontColor: "#666",
                            startAnimationTime: 10000,
                            refreshAnimationTime: 10000,
                            levelColors: [ "#e05887" ]
                        });
                        var g4 = new JustGage({
                            id: "g4",
                            value: total_opens,
                            min: 0,
                            max: total_sent,
                            gaugeWidthScale: 0.2,
                            humanFriendly: true,
                            humanFriendlyDecimal: 1,
                            counter: true,
                            title: "Total Opened",
                            label: "Total Opened",
                            titleFontColor: "#666",
                            startAnimationTime: 10000,
                            refreshAnimationTime: 10000,
                            levelColors: [ "#1BBC9B" ]
                        });
                    }
                })
            },2500);
        });
    </script>
@endsection
@section('dashboard_scripts')
    <script src="/themes/default/js/morris.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.easypiechart.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/raphael-2.1.4.min.js"></script>
    <script src="/themes/default/js/justgage.js?v={{$local_version}}"></script>
    <script>
        var g1, g2, g3, g4;
        window.onload = function(){

        };
    </script>
    <script type="text/javascript">
        function getUserCampaigns(duration){
            @if($broadcast_filter_dashboard==0 || $broadcast_filter_dashboard=='0')
                return false;
            @endif
            campaign_id = $("#purpose2").val();
            if(duration==11 || duration=='11'){
                duration ="?id=11&from="+$("#from").val()+"&to="+$("#to").val();
            }else{
                duration ="?id="+duration;
            }
            var html ="";
            $.ajax({
                url: "{{ url('get-user-campaigns') }}"+duration,
                type: "GET",
                dataType:"json",
                success: function (data) {
                    html = '<option value=""> select Campaign </option>';
                    html = '<option value="0">{{ trans("common.all") }}</option>';
                    if(data.status=='success'){
                       $.each(data.campaignsData, function(index, item) {
                           var selectedVal ="";
                           if(campaign_id==item.campaign_id){
                               selectedVal = "selected";
                           }else{
                               selectedVal ="";
                           }
                            html +='<option value="'+item.campaign_id+'" '+selectedVal+' >'+item.name+'</option>';
                        }); 
                    }else{
                        html = "";
                    }
                    $("#purpose2").html(html);
                }
            });
        }
        $(document).ready(function () {
            
            $("#purpose2").change(function(){
               ///$("#purpose").trigger('change');
               if($('#purpose').val() != 11 && $('#purpose').val() != 3){

                    $('#datetimepicker-custom').hide();
                    getStats($('#purpose').val(), "{{ url('/') }}");
                }
                else if($('#purpose').val() == 3) {

                    todayStats("{{ url('/') }}");
                }
                else{
                   // getStats(11, "{{ url('/') }}");
                    //  $('#chartdiv01').html('');

                    var now = new Date();
                    var day = ("0" + now.getDate()).slice(-2);
                    var month = ("0" + (now.getMonth() + 1)).slice(-2);
                    var today = now.getFullYear()+"-"+(month)+"-"+(day);

                    var prev = new Date();
                    prev.setDate(now.getDate()-7);
                    var pday = ("0" + prev.getDate()).slice(-2);
                    var pmonth = ("0" + (prev.getMonth() + 1)).slice(-2);
                    var pyear = prev.getFullYear();
                    var previous = pyear+"-"+(pmonth)+"-"+(pday);

                    $('#to').val(today);
                    $('#from').val(previous);

                    $('#datetimepicker-custom').css("display", "inline-block");
                    if($('#purpose').val() != 11){
                        getStats(11, "{{ url('/') }}");
                    }else{
                        var from = $('#from').val();
                        var to = $('#to').val();
                        getCustomStats(from, to, "{{ url('/') }}");
                    }
                    //  getCustomStats(from, to, "{{ url('/') }}");
                }
            });
            
            $(".m-select2").select2();
            $("#f_options").click(function() {
                $(".le-usageBlock").toggleClass("show");
            });
            $("#all_live").click(function() {
                $(".blockUI").show();
                setTimeout(function() {
                    $(".blockUI").hide();
                    $(".select-block").hide();
                }, 1000);
            });
            $("#admin_live").click(function() {
                $(".blockUI").show();
                setTimeout(function() {
                    $(".blockUI").hide();
                    $("#filter-ls").html(`
                  
                        <option value="all">All Admins</option>
                        <?php foreach($admins as $admin) { ?>
                        <option value="{{ $admin->id }}">{{ $admin->name}}</option>
                        <?php } ?>
                        
                    `);
                    $(".select-block").css("display", "inline-block");
                }, 1000);
            });
            $("#user_live").click(function() {
                $(".blockUI").show();
                setTimeout(function() {
                    $(".blockUI").hide();
                    $("#filter-ls").html(`
                        <option value="all">{{trans('dashboard.option.all_user')}}</option>
                        <?php foreach($client_data as $client_row) { ?>
                        <option value="{{ $client_row->id }}">{{ $client_row->name}}</option>
                        <?php } ?>
                       
                    `);
                    $(".select-block").css("display", "inline-block");
                }, 1000);
            });
            
            
            $("#savedmn").click(function() {
                $(".blockUI").show();
                setTimeout(function(){
                    $(".blockUI").hide();
                    $("#checked").fadeIn();
                }, 1500);
                setTimeout(function(){
                    $('#spdomain').modal('hide');
                }, 3000);
            });
            $(function () {
            });
            $('.counter').counterUp({
                delay: 10,
                time: 1000
            });
            $('.counter2').counterUp({
                delay: 10,
                time: 1000
            });
            $('.counterup').counterUp({
                delay: 10,
                time: 1000
            });
            // show Sending Statistics round stats
            $(function() {
                jQuery().easyPieChart && ($(".easy-pie-chart .number.spammed").easyPieChart({
                    animate: 1e3,
                    size: 75,
                    lineWidth: 3,
                    barColor: App.getBrandColor("grey")
                }), $(".easy-pie-chart .number.visits").easyPieChart({
                    animate: 1e3,
                    size: 75,
                    lineWidth: 3,
                    barColor: App.getBrandColor("blue")
                }), $(".easy-pie-chart .number.bounce").easyPieChart({
                    animate: 1e3,
                    size: 75,
                    lineWidth: 3,
                    barColor: App.getBrandColor("red")
                }), $(".easy-pie-chart .number.opened").easyPieChart({
                    animate: 1e3,
                    size: 75,
                    lineWidth: 3,
                    barColor: App.getBrandColor("green")
                }), $(".easy-pie-chart .number.clicked").easyPieChart({
                    animate: 1e3,
                    size: 75,
                    lineWidth: 3,
                    barColor: App.getBrandColor("purple")
                }), $(".easy-pie-chart-reload").click(function () {
                    $(".easy-pie-chart .number").each(function () {
                        var e = Math.floor(100 * Math.random());
                        $(this).data("easyPieChart").update(e), $("span", this).text(e)
                    })
                }))
            })
        });
        $("#reloadStats").click(function(){
            // statChart.js function
            getStats($("#purpose option:selected").val(), "{{ url('/') }}");
        });
        // Sending Statistics custom search
        $("#customSearch").click(function () {
            var from = $('#from').val();
            var to = $('#to').val();
            // statChart.js function
            getCustomStats(from, to, "{{ url('/') }}");
            getUserCampaigns($('#purpose').val());
        });
        // Opened by Device custom search
        $("#deviceCustomSearch").click(function () {
            var from = $('#device_from').val();
            var to = $('#device_to').val();
            to = new Date(to);

            to.setDate(to.getDate() + 1)
            var dd = to.getDate();
            var mm = to.getMonth() + 1; //January is 0!
            var yyyy = to.getFullYear();
            if (dd < 10) { dd = '0' + dd; }
            if (mm < 10) { mm = '0' + mm; }
            to = yyyy + '-' + mm + '-' + dd;
            // pass parameter to other function
            deviceCustomStats(from, to);
        });
        $("#domainCustomSearch").click(function () {
            var from = $('#domain_from').val();
            var to = $('#domain_to').val();
            domainCustomStats(from, to);
        });
        // Opened by Countries custom search
        $("#geoCustomSearch").click(function () {

            var from = $('#geo_from').val();
            var to = $('#geo_to').val();
            drawRegionsMap();
            // pass parameter to other function
            getCountriesCustomStat(from, to);
        });
        // get active logs for Recent Activities
        function loadActivityLogs()
        {
            $.ajax({
                url: "{{ URL::route('dashboard.activity-logs') }}",
                type: "GET",
                success: function (data) {
                    $('#load-activityLogs').html(data);
                }
            });
        }
        loadActivityLogs();
        // get broadcast for Recent Schedules
        function campaignStats()
        {
            $.ajax({
                url: "{{ URL::route('dashboard.campaign.stats') }}",
                type: "GET",
                success: function (data) {
                    $('#campaign_statss').html(data);
                }
            });
        }
        // get trigger for Recent Schedules
        function triggerStats()
        {
            $.ajax({
                url: "{{ URL::route('dashboard.trigger.stats') }}",
                type: "GET",
                success: function (data) {
                    $('#trigger_statss').html(data);
                }
            });
        }
        function dripStats()
        {
            $.ajax({
                url: "{{ URL::route('dashboard.drip.stats') }}",
                type: "GET",
                success: function (data) {
                    $('#drip_statss').html(data);
                }
            });
        }
        campaignStats();
    </script>
    <script type="text/javascript">
        $(document).ready(function () {

            setTimeout(function(){
                $(".kt-page-loader").hide();
                //$(".appSlider").hide();
            }, 1500);

            // setTimeout(function(){
            //     $(".appSlider").slideDown();
            // }, 6000);

            $('.lists').easyPieChart({
                barColor:"#009ee0",
                animate: 1000,
                lineWidth: 8,
                size:180
            });

            $('#next1').click(function() {
                $('.mblock2').show();
                $('.mblock1').hide();
                $('#prev1').show();
                $('#next2').show();
                $('#next1').hide();
            });
            $('#prev1').click(function() {
                $('.mblock1').show();
                $('.mblock2').hide();
                $('#next1').show();
                $('#next2').hide();
                $('#prev1').hide();
            });
            $('#next2').click(function() {
                $('.mblock3').show();
                $('.mblock2').hide();
                $('.mblock1').hide();
                $('#prev2').show();
                $('#next3').show();
                $('#next1').hide();
                $('#next2').hide();
                $('#prev1').hide();
            });
            $('#prev2').click(function() {
                $('.mblock2').show();
                $('.mblock1').hide();
                $('.mblock3').hide();
                $('#prev1').show();
                $('#next2').show();
                $('#prev2').hide();
                $('#next1').hide();
                $('#next3').hide();
            });
            $('#next3').click(function() {
                $('.mblock4').show();
                $('.mblock3').hide();
                $('.mblock2').hide();
                $('.mblock1').hide();
                $('#prev3').show();
                $('#finish').show();
                $('#next1').hide();
                $('#next2').hide();
                $('#next3').hide();
                $('#prev1').hide();
                $('#prev2').hide();
            });
            $('#prev3').click(function() {
                $('.mblock3').show();
                $('.mblock1').hide();
                $('.mblock2').hide();
                $('.mblock4').hide();
                $('#prev2').show();
                $('#next3').show();
                $('#prev1').hide();
                $('#prev3').hide();
                $('#next1').hide();
                $('#next2').hide();
                $('#finish').hide();
            });
        });
    </script>
    <script type="text/javascript">
        if ($("#disclaimer").val() == 1){
            $(window).on('load',function(){
                $('#fwizard').modal('show');
                $('#fwizard').modal({backdrop: 'static', keyboard: false})
            });
        }
    </script>
    <script type="text/javascript">
        function myFunction() {
            if ($('#disclaimer-checkbox').is(":checked")){
                $.ajax({
                    type   : "POST",
                    url    : "{{ url('/') }}"+"/setting/modules",
                    data   : {modules: 'dashboard_module'},
                    success: function(result) {
                       // console.log('success');
                    }
                });
            }
        }
        var count = 0;
        $(".myactivity").click(function(){
            count += 1;
            if (count % 2 === 0) {
                $('.activity_width').css('width', '');
            } else {
                $('.activity_width').css('width', '100%');
            }
        });
    </script>
    <script type="text/javascript">
        $(window).on('load',function(){
            getCountriesStat(3);
        })// get countries list for Opened by Countries stats
        function getCountriesStat(id)
        {
            var table = $("#top-countries tbody");

            $.ajax({
                url: "{{ url('/') }}"+'/geo-countries-stat/'+id,
                type: "GET",
                success: function(result) {
                    table.empty();
                    if(result.length<=0){
                      table.append("<tr><td colspan=2>{{trans('dashboard.no_data')}}</td></tr>");  
                      return false;
                    }
                    $.each(result, function (a, b) {
                        if(b.country_name == "" || b.country_name == null){
                            table.append("<tr><td>{{trans('dashboard.unknown')}}</td>" +
                                "<td>" + b.country_count + "</td></tr>");
                        }else{
                            table.append("<tr><td>"+b.country_name+"</td>" +
                                "<td>" + b.country_count + "</td></tr>");
                        }
                    });
                }
            });
        }
        // get custom countries list for Opened by Countries stats
        function getCountriesCustomStat(from, to)
        {
            var table = $("#top-countries tbody");
            $.ajax({
                url: "{{ url('/') }}"+'/geo-countries-custom-stat/'+from+'/'+to,
                type: "GET",
                success: function(result) {
                    table.empty();
                    if(result.length<=0){
                      table.append("<tr><td colspan=2>{{trans('dashboard.no_data')}}</td></tr>");  
                      return false;
                    }
                    $.each(result, function (a, b) {
                        if(b.country_name == "" || b.country_name == null){
                            table.append("<tr><td>{{trans('dashboard.unknown')}}</td>" +
                                "<td>" + b.country_count + "</td></tr>");
                        }else{
                            table.append("<tr><td>"+b.country_name+"</td>" +
                                "<td>" + b.country_count + "</td></tr>");
                        }
                    });
                }
            });
        }
    </script>
    <script src="/themes/default/js/app.min.js" type="text/javascript"></script>
@endsection
@section('page_styles')
<link href="/resources/assets/css/dashboard.css?v={{$local_version}}?v=1.1" rel="stylesheet" type="text/css">
<link href="/themes/default/css/map/anychart-ui.min.css" rel="stylesheet" type="text/css">
<link href="/themes/default/css/map/anychart-font.min.css" rel="stylesheet" type="text/css">
<style type="text/css">
#maps {
    width: 100%;
    height: 100%;
    margin: 0;
    padding: 0;
    min-height:330px;
}
table#campaignstats tr th:nth-child(2), table#campaignstats tr td:nth-child(2), table#campaignstats tr th:nth-child(3), table#campaignstats tr td:nth-child(3), table#campaignstats tr th:last-child, table#campaignstats tr td:last-child {
    text-align: center;
}
table#top-countries tr th:last-child, table#top-countries tr td:last-child {
    text-align: center;
}
svg text[font-family="Arial"][font-size="10px"][x="114.594"][y="113.5158371040724"] tspan[dy="0"] {
    display: none;
}
small#domain_disclaimer {
    font-weight: 500;
    margin: 5px 0;
}
a#sync_rules {
    margin-top: 15px !important;
    display: inline-block;
}
.fa, .fas {
    font-family: 'Font Awesome 5 Free' !important;
    font-weight: 900;
}
i.btn-default.btn-sm {
    min-width: 20px !important;
}
</style>
@endsection

@section('content')

<div class="col-md-12 content__main" data-name="mpbFNBYK">
    <div class="row" data-name="dwtYatyP">
        <div class="content__loader hidden h90 p20" data-name="XBCyrnJq">
            <div class="box_content_load hidden row" data-name="jWPSnlLq">
                <div class="col-md-8" data-name="qgpPVPmm">
                    <div class="row" data-name="eRfDjqwM">
                        <div class="col-md-6" data-name="lTqAuNiv">
                            <div class="avatar_load3" data-name="zbcpKDty"></div>
                            <div class="box_text_load w25 mt20 m0" data-name="vBCfzLID"></div>
                    </div>
                    </div>
                </div>
                <div class="col-md-4" data-name="dUTmnrTz">
                    <div class="box_text_load w25 mt20 m0 pull-right" data-name="pybTWZoX"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12 content__main" data-name="EuDXdOPQ">
    <div class="row" data-name="KDyzlRvq">
        <div class="content__loader hidden h175" data-name="iVNfAwKt">
            <div class="box_content_load hidden row" data-name="ZEdHQVlm">
                <div class="col-md-6" data-name="apVqWWvW">
                    <div class="row" data-name="OdmsbcOd">
                        <div class="col-md-4 h100oh" data-name="MdNyDvIM"><div class="avatar_load2" data-name="kBZKmdjI"></div></div>
                        <div class="col-md-4 h100oh" data-name="jpfkedWJ"><div class="avatar_load2" data-name="HtrrzCBY"></div></div>
                        <div class="col-md-4 h100oh" data-name="ydgSdgof"><div class="avatar_load2" data-name="CzqfbiEl"></div></div>
                    </div>
                </div>
                <div class="col-md-6" data-name="phelKtAV">
                    <div class="row" data-name="TjYswuyv">
                        <div class="col-md-4" data-name="AOBdtPuX">
                            <div class="box_head_load w40 mt10" data-name="LrrpDnFn"></div>
                            <div class="box_text_load w75" data-name="mtIDYrAQ"></div>
                            <div class="box_text_load w100" data-name="kejAmbDi"></div>
                        </div>
                        <div class="col-md-4" data-name="CpzxFfae">
                            <div class="box_head_load w40 mt10" data-name="shEiZiLY"></div>
                            <div class="box_text_load w75" data-name="aoBgGtBR"></div>
                            <div class="box_text_load w100" data-name="gVLecWhi"></div>
                        </div>
                        <div class="col-md-4" data-name="NSfSfZfU">
                            <div class="box_head_load w40 mt10" data-name="MnZCJTYY"></div>
                            <div class="box_text_load w75" data-name="FQRIHSHI"></div>
                            <div class="box_text_load w100" data-name="rWyXxWYj"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row content__main" data-name="IamCTDci">
    <div class="col-lg-8 col-xs-12 col-sm-12" data-name="JLSGBtSd">
        <div class="kt-portlet kt-portlet--height-fluid h611" data-name="osGgEvPZ">
            <div class="kt-portlet__head" data-name="dxDxxsAU">
                <div class="kt-portlet__head-label box_title_load" data-name="mcnUJqZY">
                    <div class="kt-portlet__head-title" data-name="NYEPOwMO"><div class="box_text_load w25 mt25" data-name="egfwLeUn"></div></div>
                </div>
            </div>
            <div class="kt-portlet__body box_content_load graph" data-name="WFkSOkko">
                <div class="row" data-name="CnKgNFrX">
                    <div class="box_head_load w25 height50 mt10" data-name="fRKopYYZ"></div>
                    <div class="box_head_load w50 empty height1" data-name="FdliMJVy"></div>
                    <div class="box_head_load w25 height50 mt10" data-name="lVZcqAux"></div>
                </div>
                <div class="row" data-name="ILqVhHPm">
                    <div class="col-md-12 box_text_load mb10 mt30" data-name="plwbkyYm"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="EvTtMaJS"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="dPfcXNYg"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="lGpDwZwI"></div>
                    <div class="col-md-12 box_text_load mb50" data-name="nbXqJTsh"></div>
                </div>
                <div class="row" data-name="JZwedjcM">
                    <div class="w20" data-name="ubqxFxxO"><div class="avatar_load3" data-name="jFFokwmo"></div><div class="box_text_load w50 offset-md-3" data-name="PlJOUwlB"></div></div>
                    <div class="w20" data-name="neTCftRE"><div class="avatar_load3" data-name="vKPOuZjI"></div><div class="box_text_load w50 offset-md-3" data-name="zlbRYEqk"></div></div>
                    <div class="w20" data-name="xsNpvLvd"><div class="avatar_load3" data-name="rbZgOsiK"></div><div class="box_text_load w50 offset-md-3" data-name="nVaPDYHv"></div></div>
                    <div class="w20" data-name="UjalGAMY"><div class="avatar_load3" data-name="hecbdbnL"></div><div class="box_text_load w50 offset-md-3" data-name="MNesuqJR"></div></div>
                    <div class="w20" data-name="XOqmqnAf"><div class="avatar_load3" data-name="pEokYtHW"></div><div class="box_text_load w50 offset-md-3" data-name="wRLswLXR"></div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="AxQBbRnC">
        <div class="kt-portlet kt-portlet--height-fluid h611" data-name="rKNYxstw">
            <div class="kt-portlet__body box_content_load" data-name="LWpYWRXL">
                <div class="box_head_load w50 offset-md-3 height50 mt30" data-name="KyIxjUBj"></div>
                <div class="row" data-name="eQoKvnam">
                    <div class="col-md-6" data-name="SJdYmbhz">
                        <div class="box_text_load w50 mt50" data-name="SbnZxZgD"></div>
                        <div class="box_text_load w75 mb50" data-name="oanQaUxm"></div>
                        <div class="box_text_load w50 mt50" data-name="hurVYujl"></div>
                        <div class="box_text_load w75 mb50" data-name="ocrPboTb"></div>
                        <div class="box_text_load w50 mt50" data-name="RibTkkJp"></div>
                        <div class="box_text_load w75 mb40" data-name="BhiFFxsN"></div>
                    </div>
                    <div class="col-md-6" data-name="qXEnUmzM">
                        <div class="box_text_load w50 mt50" data-name="RrFIMRDx"></div>
                        <div class="box_text_load w75 mb50" data-name="TMaqmBxc"></div>
                        <div class="box_text_load w50 mt50" data-name="wDoEyFiA"></div>
                        <div class="box_text_load w75 mb50" data-name="NXPUwTFt"></div>
                        <div class="box_text_load w50 mt50" data-name="cQfxJUxh"></div>
                        <div class="box_text_load w75 mb40" data-name="eOSBUYUC"></div>
                    </div>
                </div>
                <div class="row" data-name="LiYzPxMU">
                    <div class="col-md-12" data-name="EzKFsyoW">
                        <div class="box_text_load w100" data-name="iOHCwpdS"></div>
                        <div class="box_text_load w50" data-name="ovhjgvWM"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row content__main" data-name="AxnVfnKN">
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="AUDFXyyJ">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="mbQQpXSY">
            <div class="kt-portlet__head" data-name="QUwbEDRf">
                <div class="kt-portlet__head-label box_title_load" data-name="COwhaZmJ">
                    <div class="kt-portlet__head-title" data-name="BkyqhiIZ"><div class="box_text_load w25 mt25" data-name="cmMBqAyt"></div></div>
                </div>
            </div>
            <div class="kt-portlet__body box_content_load" data-name="BteGabGR">
                <div class="row" data-name="TXiUvNBa">
                    <div class="box_head_load w25 height50 mt10" data-name="sGPPCeFw"></div>
                </div>
                <div class="row" data-name="FbYEkcrQ">
                    <div class="col-md-12 box_text_load mb10 mt30" data-name="pqVwfHnM"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="xAroZOUt"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="DNMYDbDq"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="vTCqLXeR"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="GktAitlD"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="iYKxQrpE"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="bSVZLtGL">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="PlcXiIGo">
            <div class="kt-portlet__head" data-name="DuAfgAuG">
                <div class="kt-portlet__head-label box_title_load" data-name="tUlisfoJ">
                    <div class="kt-portlet__head-title" data-name="Hbxeddsi"><div class="box_text_load w25 mt25" data-name="jjsCuscq"></div></div>
                </div>
            </div>
            <div class="kt-portlet__body box_content_load" data-name="QvMKdBFl">
                <div class="row" data-name="MPTNNJmh">
                    <div class="box_head_load w25 height50 mt10" data-name="tQPWVfbJ"></div>
                </div>
                <div class="row" data-name="LKCxFnZH">
                    <div class="col-md-12 box_text_load mb10 mt30" data-name="NDAnfElE"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="JTwDaWrB"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="GUATGQyj"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="BStAoeGx"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="PXzNibjA"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="zcXrKjeZ"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="xMwdSUhs">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="CLknXZrf">
            <div class="kt-portlet__head" data-name="butwxcPQ">
                <div class="kt-portlet__head-label box_title_load" data-name="fcAdIyfM">
                    <div class="kt-portlet__head-title" data-name="nWDYWavI"><div class="box_text_load w25 mt25" data-name="BmfGQpWv"></div></div>
                </div>
            </div>
            <div class="kt-portlet__body box_content_load" data-name="soIcEswq">
                <div class="row" data-name="ZvbFlMpX">
                    <div class="box_head_load w25 height50 mt10" data-name="SGMsmKLP"></div>
                </div>
                <div class="row" data-name="svWvrVMB">
                    <div class="col-md-12 box_text_load mb10 mt30" data-name="cCAEyNBd"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="pKoiSbhY"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="EHQDXfwf"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="amRykwrJ"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="fYMlMtxy"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="XIzObuIz"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row content__main mb-195" data-name="JqHhAYop">
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="wPKHwlAe">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="BkMNYeoc">
            <div class="kt-portlet__head" data-name="yRJjQAul">
                <div class="kt-portlet__head-label box_title_load" data-name="pOhBpIXc">
                    <div class="kt-portlet__head-title" data-name="LrDgBwse"><div class="box_text_load w25 mt25" data-name="MUfeaxLL"></div></div>
                </div>
            </div>
            <div class="kt-portlet__body box_content_load" data-name="xocqVqJQ">
                <div class="row" data-name="BRCkYpJp">
                    <div class="col-md-12 box_text_load mb10 mt30" data-name="rWejzjet"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="qQqkvcQP"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="UsnyjTin"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="zLidvccu"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="MpeHJCsn"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="oeKQZnSW"></div>
                    <div class="col-md-12 box_text_load mb10" data-name="VqVTwIkB"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xs-12 col-sm-12" data-name="GcMkpvLb">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="ajDaKqhS">
            <div class="kt-portlet__head" data-name="ntSPXGGt">
                <div class="kt-portlet__head-label box_title_load" data-name="RoXklksU">
                    <div class="kt-portlet__head-title" data-name="lKBqCDZh"><div class="box_text_load w25 mt25" data-name="aykJHWWF"></div></div>
                </div>
            </div>
            <div class="kt-portlet__body box_content_load" data-name="uAALTVMD">
                <div class="row" data-name="FjIPYSnD">
                    <div class="col-md-6" data-name="xFnWMwDt">
                        <div class="col-md-12 box_text_load mb20 mt30" data-name="fyIoYuBt"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="VnYwYfYe"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="YMOPJYmb"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="kJnAdULs"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="XEPYiQMg"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="GMiSHjep"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="wloLtOBe"></div>
                    </div>
                    <div class="col-md-6" data-name="vShYtasM">
                        <div class="box_head_load w50 height50 mt10 empty fl" data-name="sFGCKeIw"></div>
                        <div class="box_head_load w50 height50 mt10 mb50 fr" data-name="PIjhAzKP"></div>
                        <div class="col-md-12 box_text_load mb20 mt50 cb" data-name="AmphiNcH"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="BewYLQSi"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="eUiwuVKK"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="RbNPWMKG"></div>
                        <div class="col-md-12 box_text_load mb20 mt25" data-name="RDxLxmxk"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php 
    $newPkg = session("newPkg");
    session(['newPkg' => '']);
?>
@if($newPkg == "yes") 
<div class="alert alert-success alert-bold plan-upgrarded" id="plan-upgrarded" role="alert" data-name="byoRBHbV">
    <i class="la la-check-circle"></i>
    <div class="alert-text" data-name="HcYvIcCg"><b>Success:</b> Plan has been changed successfully!</div>
    <div class="pull-right" data-name="YXjuORse">
        <a href="/plans/history" class="btn btn-success btn-xs" aria-hidden="true">View History</a>
    </div>
</div>
@endif


<?php

$new_ui = showNotify('dont_show_new_node_ui_notify');
$new_rules = showNotify('dont_show_bounce_sync_notify');

?>

@if($new_ui && $super_admin)
<div class="alert alert-info warning issue-note no-icon" role="alert" id="meduleMsg">
    <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
    <div class="alert-text">
        {{trans('dashboard.b.notice')}}&nbsp; {{trans('sending_nodes.module.message')}}
    </div>                 
    <div class="text-right">
        <a href="javascript:;" class="btn btn-info btn-xs pull-right text-block" id="module_list">{{trans('dashboard.action.switch')}}

        </a>
    </div>
    <div class="alert-close">
        <button onclick="dont_show_notify('dont_show_new_node_ui_notify')" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="la la-close"></i>
        </button>
    </div>
</div>
@endif

@if($new_rules && $super_admin)

<div class="alert alert-info warning issue-note no-icon" role="alert" id="bounceMsg">
    <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
    <div class="alert-text">
        {!! trans('dashboard.b.notice') !!}&nbsp; {{trans('bounce_rules.module.message')}}
    </div>                 
    <div class="text-right">
        <a href="javascript:;" id="sync_rules" class="btn btn-info btn-xs pull-right text-block" >{{trans('bounce_rules.module.switch')}}</a>
    </div>
    <div class="alert-close">
        <button onclick="dont_show_notify('dont_show_bounce_sync_notify')" type="button" class="close" data-dismiss="alert" aria-label="Close">
            <i class="la la-close"></i>
        </button>
    </div>
</div>

@endif

@if(!empty($issues) and $issues > 0 )
<div class="alert alert-danger warning" role="alert" id="issue-note" data-intro="Issues Notifications" data-name="DrcsppuN">
    <div class="alert-icon" data-name="UACnGVEz"><i class="flaticon-questions-circular-button"></i></div>
    <div class="alert-text" data-name="JMHyvvHk">
    <b>{{ trans('common.warning.title')}}</b>&nbsp; {!! $issues==1?str_replace('%%count%%',$issues,trans('dashboard.message.isssue_in_application')):str_replace('%%count%%',"<span>$issues</span>",trans('dashboard.message.isssue_in_application'))!!}
    </div>  
                              
    <div class="pull-right" data-name="YXjuORse">
        <a href="{{ route('issue.index') }}" class="btn btn-default btn-xs" aria-hidden="true">{{ trans('dashboard.view_all_issues') }}</a>
    </div>
</div>
@endif


<?php   

if( \Config('app.debug') == true and $super_admin) { ?>

    <div class="alert alert-warning warning" role="alert" data-intro="Issues Notification" data-name="ksicnekk">
        <div class="alert-text" data-name="QEqAfmRI">
            <b>Security Alert:</b> {{trans('dashboard.debug_mode_alter')}}
        </div>                            
     
    </div>
<?php } ?>

<?php   

if(!$utcTimeFlag) { ?>

    <div class="alert alert-warning warning" role="alert" data-intro="Issues Notification" data-name="ksicnekk">
        <div class="alert-text" data-name="QEqAfmRI">
            <b>Informational Alert:</b> {{trans('dashboard.database_time_not_utc')}}
        </div>                            
     
    </div>
<?php } ?>



<?php 
$clockMethod = 0;
?>
@if($clockMethod > 0)
<div class="alert alert-danger warning" role="alert" id="issue-note" data-intro="Issues Notifications" data-name="DrcsppuN">
    <div class="alert-icon" data-name="UACnGVEz"><i class="flaticon-questions-circular-button"></i></div>
    <div class="alert-text" data-name="JMHyvvHk">
        {!! trans('issues.closeClockAlert' , ['clockMethod'=>$clockMethod]) !!}
        
    </div>  
                              
        <div class="alert-close">
            <button  type="button" class="close closeClockAlert" data-dismiss="alert" aria-label="Close">
                <i class="la la-close"></i>
            </button>
        </div>
   
</div>
@endif

<input type="hidden" id="total_opened" value="0">
<input type="hidden" id="total_clicked" value="0">
<input type="hidden" id="total_sent" value="0">

<!-- start first stats row  -->
<div class="row op0" data-name="TBpJlFoJ">
    <div class="col-md-12" data-name="ihCUSVvs">
        <div class="kt-portlet2 kt-portlet--height-fluid newrow" data-name="gromyjAz">
            <div class="kt-portlet__body pb5 h167" data-name="OBCbSiBC">
                <div class="form-group row mb0" data-name="fTzkFxVW">
                    <div class="col-lg-6 col-sm-12 col-xs-12 text-center charts-main" data-name="XdDXtsFo">
                        <div id="g2" data-name="wxnrDnse" data-title="Total Sent"></div>
                        <div id="g4" data-name="tWRFlLYw" data-title="Total Opened"></div>
                        <div id="g3" data-name="avfWkMak" data-title="Total Clicked"></div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12 dashstats" data-name="HDajPccw">
                        <div class="row" data-name="iLHoBERQ">
                            <div class="col-md-6" data-name="xsseTRaE">

                                <div class="dashboard-stat2" data-name="WLDKqKFu">
                                    <div class="progress-info" data-name="pIcUfyRm">
                                        <div class="progress" data-name="MeKgGDgm">
                                        <span style="width: 100%;" class="progress-bar bg-success">
                                            <span class="sr-only">108% {{trans('dashboard.progress')}}</span>
                                        </span>
                                        </div>
                                        <div class="status" data-name="GJCslkmP">

                                                <div class="status-title" data-name="YrBNTNJd">
                                                    <a href="{{ route('list.index') }}"> {{trans('dashboard.email_sent')}}</a>
                                                </div>
                                                <div class="status-number" data-name="hWtknIJb">
                                                    <span id="email_sent"><i class="fa fa-spinner fa-spin"></i></span>
                                                    <span class="this-month">{{trans('common.this_month')}}</span>
                                                </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-stat2" data-name="BxPDRUnq">
                                    <div class="progress-info" data-name="bTJGVnkQ">
                                        <div class="progress" data-name="dIzuBsZJ">
                                        <span style="width: 100%;" class="progress-bar bg-danger">
                                            <span class="sr-only">80% {{trans('dashboard.progress')}}</span>
                                        </span>
                                        </div>
                                        <div class="status" data-name="YjthWUij">
                                                <div class="status-title" data-name="yfVgYzPr">
                                                    <a href="{{ route('node.index') }}">{{trans('dashboard.sending_nodes')}}</a>
                                                </div>
                                                <div class="status-number" data-name="silGVxmM">
                                                    <span id="nodes"><i class="fa fa-spinner fa-spin"></i></span>
                                                </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6" data-name="ZBWaBmPh">

                                <div class="dashboard-stat2" data-name="ZHnBDYqj">
                                    <div class="progress-info" data-name="tVaDxuUG">
                                        <div class="progress" data-name="bvdAArab">
                                        <span style="width: 100%;" class="progress-bar bg-warning">
                                            <span class="sr-only">100% {{trans('dashboard.progress')}}</span>
                                        </span>
                                        </div>
                                        <div class="status" data-name="cMqJNUlt">
                                                <div class="status-title" data-name="fBYEMcgG">
                                                    <a href="{{ route('contact.index') }}">{{trans('dashboard.contacts')}}</a>
                                                </div>
                                                <div class="status-number" data-name="GGSMyzTM">
                                                    {{-- <span id="contacts">{{ !empty($total_contacts) ? $total_contacts : '0' }}{!! ($client) ? " / ".( (!empty($package->subscribers_limit) &&  $package->subscribers_limit > 0) ? $package->subscribers_limit : "&#8734;") : ($contacts_limit > 0 ? ' / '.$contacts_limit : '')!!}</span> </div> --}}
                                                    <span id="contacts"><i class="fa fa-spinner fa-spin"></i></span> </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard-stat2" data-name="rEYjRODf">
                                    <div class="progress-info" data-name="ADxRqrbJ">
                                        <div class="progress" data-name="NzeTErYM">
                                        <span style="width: 100%;" class="progress-bar bg-info">
                                            <span class="sr-only">80% {{trans('dashboard.progress')}}</span>
                                        </span>
                                        </div>
                                        <div class="status" data-name="BKxrAPRT">
                                            @if($client || config('app.type') == 'saas')
                                                <div class="status-title" data-name="yqJdYFiZ">
                                                    <a href="{{ route('domain.index') }}">{{trans('dashboard.domains')}}</a>
                                                </div>
                                                <div class="status-number" data-name="PpyUHQHc">
                                                <span id="su">{{ !empty($sending_domanis) ? $sending_domanis : '0' }} {!! $client ? " / ".( (!empty($package->sending_domain_limit) && $package->sending_domain_limit > 0) ? $package->sending_domain_limit : "&#8734;") : ''!!}
                                                </span>
                                                </div>
                                            @else
                                                <div class="status-title" data-name="foJEDndy">
                                                    <a href="{{ route('clients.index') }}">{{trans('dashboard.users')}}</a>
                                                </div>
                                                <div class="status-number" data-name="wyyGribG">
                                                @php $users_limit = getUsers(2); @endphp
                                            <span id="su">{{ !empty($users) ? $users : '0' }} / {!!   $users_limit == 500000 ? '&#8734;' : $users_limit !!}</span>

                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    @if(isClient())
                        <?php
                
                function convertToHumaaReadable($numbers) {
                                $numbers = (int) $numbers;
                                $readable = array("", "K", "M", "B");
                                $index = 0;
                                while ($numbers >= 1000) {
                                    $numbers /= 1000;
                                    $index++;
                                }
                                return("" . round($numbers, 1) . " " . $readable [$index]);
                            }

                            $todays_limit = "&#8734;";
                            $sent_today = 0;
                            $monthly_limit = "&#8734;";
                            $sent_this_month  = 0;
                            $trans_daily_limit  = "&#8734;";
                            $trans_monthly_limit  = "&#8734;";
                            $credits = "No Credits";
                            $trans_credits = "No Credits";
                            $segments_limit  = "&#8734;";
                            $triggers_limit  = "&#8734;";
                            $total_lists  = DB::table("lists")->where("user_id" , Auth::user()->id)->where("is_deleted" , 0)->count();
                            $total_campaigns  = DB::table("campaigns")->where("user_id" , Auth::user()->id)->count();
                           

                            
                            if(!empty($user_emails_limits)) {  
                                if(!empty($package) and ($package->daily_email_limit != NULL or $package->daily_email_limit != null)) $todays_limit = convertToHumaaReadable($package->daily_email_limit);
                                if($user_emails_limits->daily_limit != NULL or $user_emails_limits->daily_limit != null) $todays_limit = convertToHumaaReadable($user_emails_limits->daily_limit);	
                                if(!empty($package) and ($package->monthly_email_limit != NULL or $package->monthly_email_limit != null)) $monthly_limit = convertToHumaaReadable($package->monthly_email_limit);
                                if($user_emails_limits->monthly_limit != NULL or $user_emails_limits->monthly_limit != null) $monthly_limit = convertToHumaaReadable($user_emails_limits->monthly_limit);	
                                $sent_this_month = $user_emails_limits->sent_this_month;	
                                $sent_today = $user_emails_limits->sent_today;	
                                if($user_emails_limits->credits != NULL or $user_emails_limits->credits != null) $credits = $user_emails_limits->credits;	

                                if(!empty($package))  $segments_limit  = $package->segments_limit;
                                if(!empty($package))  $triggers_limit  = $package->triggers_limit;

                            } else { 
                                if(!empty($package) and ($package->daily_email_limit != NULL or $package->daily_email_limit != null)) $todays_limit = convertToHumaaReadable($package->daily_email_limit);
                                if(!empty($package) and ($package->monthly_email_limit != NULL or $package->monthly_email_limit != null)) $monthly_limit = convertToHumaaReadable($package->monthly_email_limit);
                                
                            }

                            if($todays_limit == -1) $todays_limit = "&#8734;";
                            if($monthly_limit == -1) $monthly_limit = "&#8734;";

                            if($segments_limit == -1) $segments_limit = "&#8734;";
                            if($triggers_limit == -1) $triggers_limit = "&#8734;";

                        
                            
                          
                        ?>
                        <div class="col-lg-3 col-sm-6 col-xs-12 dashstats" data-name="HDajPccw">
                            <div class="row" data-name="iLHoBERQ">
                                <div class="col-md-6" data-name="xsseTRaE">
                                    <div class="dashboard-stat2" data-name="WLDKqKFu">
                                        <div class="progress-info" data-name="pIcUfyRm">
                                            <div class="progress" data-name="MeKgGDgm">
                                            <span style="width: 100%;" class="progress-bar bg-success">
                                                <span class="sr-only">108% {{trans('dashboard.progress')}}</span>
                                            </span>
                                            </div>
                                            <div class="status" data-name="GJCslkmP">
                                                <div class="status-title" data-name="fBYEMcgG">
                                                    <a href="javascripts:;">{{trans('dashboard.daily_limit')}}</a>
                                                </div>
                                                <div class="status-number" data-name="GGSMyzTM">
                                                    <span id="contacts">{!!convertToHumaaReadable($sent_today)!!} / {!!$todays_limit!!} </span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-stat2" data-name="BxPDRUnq">
                                        <div class="progress-info" data-name="bTJGVnkQ">
                                            <div class="progress" data-name="dIzuBsZJ">
                                            <span style="width: 100%;" class="progress-bar bg-danger">
                                                <span class="sr-only">80% {{trans('dashboard.progress')}}</span>
                                            </span>
                                            </div>
                                            <div class="status" data-name="YjthWUij">
                                                <div class="status-title" data-name="fBYEMcgG">
                                                    <a href="javascripts:;">{{trans('dashboard.monthly_limit')}}</a>
                                                </div>
                                                <div class="status-number" data-name="GGSMyzTM">
                                                    <span id="contacts">{!!convertToHumaaReadable($sent_this_month)!!} / {!!$monthly_limit!!}</span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" data-name="ZBWaBmPh">
                                    <div class="dashboard-stat2" data-name="ZHnBDYqj">
                                        <div class="progress-info" data-name="tVaDxuUG">
                                            <div class="progress" data-name="bvdAArab">
                                                <span style="width: 100%;" class="progress-bar bg-warning">
                                                    <span class="sr-only">100% {{trans('dashboard.progress')}}</span>
                                                </span>
                                            </div>
                                            <div class="status" data-name="cMqJNUlt">
                                                <div class="status-title" data-name="fBYEMcgG">
                                                    <a href="javascripts:;">{{trans('dashboard.contact_lists')}}</a>
                                                </div>
                                                <div class="status-number" data-name="GGSMyzTM">
                                                    <span id="contacts">{{$total_lists}}</span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="dashboard-stat2" data-name="rEYjRODf">
                                        <div class="progress-info" data-name="ADxRqrbJ">
                                            <div class="progress" data-name="NzeTErYM">
                                            <span style="width: 100%;" class="progress-bar bg-info">
                                                <span class="sr-only">80% {{trans('dashboard.progress')}}</span>
                                            </span>
                                            </div>
                                            <div class="status" data-name="BKxrAPRT">
                                                <div class="status-title" data-name="fBYEMcgG">
                                                    <a href="javascripts:;">{{trans('dashboard.broadcasts')}}</a>
                                                </div>
                                                <div class="status-number" data-name="GGSMyzTM">
                                                    <span id="contacts">{{$total_campaigns}}</span> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @else

                    <div class="col-lg-3 col-sm-6 col-xs-12 metered header-meter" data-name="DTyXCXVr">
                        <div class="portlet" data-name="EjjqGkUN">
                            
                            <script type="text/javascript" src="/themes/default/js/meters/fusioncharts.js"></script>
                            <script type="text/javascript" src="/themes/default/js/meters/fusioncharts.theme.fusion.js"></script>
                            <script type="text/javascript" src="/themes/default/js/meters/fusioncharts.widgets.js"></script>
                            <script type="text/javascript">

                                $("body").on("click" , ".closeClockAlert" , function() {
                                    var form_data = {
                                        value:0
                                    }
                                    $.ajax({
                                        url: "{{ url('closeClockAlert') }}",
                                        type: "POST",
                                        data:form_data,
                                        success: function (resp) {
                                            location.reload();
                                        }
                                    });
                                });

                                FusionCharts.ready(function() {
                                    drawChart();
                                });
                                if (screen.width > 1445){
                                    function drawChart() { 
                                        $.get( "{{ URL::route('dashboard.refresh.meter') }}", function( datacpu ) {
                                        var cSatScoreChart = new FusionCharts({
                                            type: 'angulargauge',
                                            renderAt: 'chart_div',
                                            width: '100%',
                                            height: '180',
                                            dataFormat: 'json',
                                            dataSource: {
                                            "chart": {
                                                "caption": "",
                                                "subcaption": "",
                                                "lowerLimit": "0",
                                                "upperLimit": "100",
                                                "showvalue": "1",
                                                "numbersuffix": "%",
                                                "showtooltip": "0",
                                                "showTickMarks": "0",
                                                "showTickValues": "0",
                                                //"gaugeFillMix": "{dark-40},{light-40},{dark-20}",
                                                "theme": "fusion"
                                            },
                                            "colorRange": {
                                                "color": [{
                                                    "minValue": "0",
                                                    "maxValue": "50",
                                                    "code": "#4caf50"
                                                },
                                                {
                                                    "minValue": "50",
                                                    "maxValue": "75",
                                                    "code": "#ffb822"
                                                },
                                                {
                                                    "minValue": "75",
                                                    "maxValue": "100",
                                                    "code": "#f44336"
                                                }
                                                ]
                                            },
                                            "dials": {
                                                "dial": [{
                                                "value": datacpu.cpu
                                                }]
                                            }
                                            }
                                        });
                                        cSatScoreChart.render();

                                        var cSatScoreChart2 = new FusionCharts({
                                            type: 'angulargauge',
                                            renderAt: 'chart_div2',
                                            width: '100%',
                                            height: '180',
                                            dataFormat: 'json',
                                            dataSource: {
                                            "chart": {
                                                "caption": "",
                                                "subcaption": "",
                                                "lowerLimit": "0",
                                                "upperLimit": "100",
                                                "showvalue": "1",
                                                "numbersuffix": "%",
                                                "showtooltip": "0",
                                                "showTickMarks": "0",
                                                "showTickValues": "0",
                                                //"gaugeFillMix": "{dark-40},{light-40},{dark-20}",
                                                "theme": "fusion"
                                            },
                                            "colorRange": {
                                                "color": [{
                                                    "minValue": "0",
                                                    "maxValue": "50",
                                                    "code": "#4caf50"
                                                },
                                                {
                                                    "minValue": "50",
                                                    "maxValue": "75",
                                                    "code": "#ffb822"
                                                },
                                                {
                                                    "minValue": "75",
                                                    "maxValue": "100",
                                                    "code": "#f44336"
                                                }
                                                ]
                                            },
                                            "dials": {
                                                "dial": [{
                                                "value": datacpu.ram
                                                }]
                                            }
                                            }
                                        });
                                        cSatScoreChart2.render();
                                        });
                                    }
                                } else {
                                    function drawChart() { 
                                        $.get( "{{ URL::route('dashboard.refresh.meter') }}", function( datacpu ) {
                                        var cSatScoreChart = new FusionCharts({
                                            type: 'angulargauge',
                                            renderAt: 'chart_div',
                                            width: '100%',
                                            height: '120',
                                            dataFormat: 'json',
                                            dataSource: {
                                            "chart": {
                                                "caption": "",
                                                "subcaption": "",
                                                "lowerLimit": "0",
                                                "upperLimit": "100",
                                                "showvalue": "1",
                                                "numbersuffix": "%",
                                                "showtooltip": "0",
                                                "showTickMarks": "0",
                                                "showTickValues": "0",
                                                //"gaugeFillMix": "{dark-40},{light-40},{dark-20}",
                                                "theme": "fusion"
                                            },
                                            "colorRange": {
                                                "color": [{
                                                    "minValue": "0",
                                                    "maxValue": "50",
                                                    "code": "#4caf50"
                                                },
                                                {
                                                    "minValue": "50",
                                                    "maxValue": "75",
                                                    "code": "#ffb822"
                                                },
                                                {
                                                    "minValue": "75",
                                                    "maxValue": "100",
                                                    "code": "#f44336"
                                                }
                                                ]
                                            },
                                            "dials": {
                                                "dial": [{
                                                "value": datacpu.cpu
                                                }]
                                            }
                                            }
                                        });
                                        cSatScoreChart.render();

                                        var cSatScoreChart2 = new FusionCharts({
                                            type: 'angulargauge',
                                            renderAt: 'chart_div2',
                                            width: '100%',
                                            height: '120',
                                            dataFormat: 'json',
                                            dataSource: {
                                            "chart": {
                                                "caption": "",
                                                "subcaption": "",
                                                "lowerLimit": "0",
                                                "upperLimit": "100",
                                                "showvalue": "1",
                                                "numbersuffix": "%",
                                                "showtooltip": "0",
                                                "showTickMarks": "0",
                                                "showTickValues": "0",
                                                //"gaugeFillMix": "{dark-40},{light-40},{dark-20}",
                                                "theme": "fusion"
                                            },
                                            "colorRange": {
                                                "color": [{
                                                    "minValue": "0",
                                                    "maxValue": "50",
                                                    "code": "#4caf50"
                                                },
                                                {
                                                    "minValue": "50",
                                                    "maxValue": "75",
                                                    "code": "#ffb822"
                                                },
                                                {
                                                    "minValue": "75",
                                                    "maxValue": "100",
                                                    "code": "#f44336"
                                                }
                                                ]
                                            },
                                            "dials": {
                                                "dial": [{
                                                "value": datacpu.ram
                                                }]
                                            }
                                            }
                                        });
                                        cSatScoreChart2.render();
                                        });
                                    }
                                }
                                    
                            </script>
                            
                            <div class="meterBlk" data-name="iLYgpOrn">
                                <div id="chart_div" data-name="LVFuMcWc"><i class="fa fa-spinner fa-spin fa-lg"></i></div>
                                <span class="metername">{{ trans("dashboard.cpu") }}</span>
                            </div>
                            <div class="meterBlk" data-name="mzWrztmS">
                                <div id="chart_div2" data-name="vtfeAuUu"><i class="fa fa-spinner fa-spin fa-lg"></i></div>
                                <span class="metername">{{ trans("dashboard.ram") }}</span>
                            </div>
                            <a href="javascript:;" onclick="drawChart()"class="reload"></a>
                            
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of first stats row -->

<!-- DASHBOARD END 01 -->
<div class="row portel-hide" data-name="oJOPKqel">

    <!-- Live Chart -->
    <div class="col-lg-12 col-xs-12" id="liveblock" data-name="hKwMnIDv">
        <div class="kt-portlet kt-portlet--height-fluid" data-intro='{{ trans("dashboard.integrated_apps") }}' style="display: none;" data-name="XzQIYEVO">
            <div class="kt-portlet__head" data-name="YboBoEJR">
                <div class="kt-portlet__head-label" data-name="nYkdCbBt">
                    <h3 class="kt-portlet__head-title"> {{ trans("dashboard.live_sending") }} </h3>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools" data-name="cNTukbpM">
                    <div class="le-usageBlock" data-name="sChzGxNe">
                        <div class="bullOptions kt-radio-inline" data-name="ncBpIzeo">
                            <label for="all_live" class="kt-radio">
                                <input type="radio" checked="" class="optbulls" name="live_filter" id="all_live" value="all_live">
                                {{ trans("dashboard.everyone") }}
                                <span></span>
                            </label>
                            <label for="admin_live" class="kt-radio">
                                <input type="radio" class="optbulls" name="live_filter" id="admin_live" value="admin_events">
                                {{ trans("dashboard.onliy_admins") }}
                                <span></span>
                            </label>
                            <label for="user_live" class="kt-radio"><input type="radio" class="optbulls" name="live_filter" id="user_live" value="user_live">
                                {{ trans("dashboard.specific_users") }}
                                <span></span>
                            </label>
                        </div>
                        <div class="select-block" data-name="zDoKhTWc">
                            <select class="form-control m-select2" id="filter-ls">
                               
                            </select>
                        </div>
                    </div>
                    @if(Auth::user()->is_staff) 
                    <a href="javascript:void(0)" id="f_options"><i class="fa fa-bars btn btn-default btn-sm" style="font-size:20px"></i></a>
                    @endif
                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                        <label>
                            <input type="checkbox" checked="" name="live_events" id="live_events">
                            <span></span>
                        </label>
                    </span>
                </div>
            </div>
            <input type="hidden" id="last_sent" value="0"/>
            <div class="kt-portlet__body" data-name="DzQBrdTb">
                <!-- Resources -->
                <script src="/themes/default/js/charts/core.js"></script>
                <script src="/themes/default/js/charts/charts.js"></script>
                <script src="/themes/default/js/charts/animated.js"></script>

                <!-- Chart code -->
                <script>

                           $("document").ready(function () { 
                              setTimeout(function () { 
                                if(localStorage.getItem("liveChart") == "off")  { 
                                    $("#live_events").click();
                                }
                              },1000)
                            
                                       
                           });

                   
                    am4core.ready(function() {

                        // Themes begin
                        am4core.useTheme(am4themes_animated);
                        // Themes end

                        var chart = am4core.create("livesending", am4charts.XYChart);
                        chart.hiddenState.properties.opacity = 0;

                        chart.padding(0, 0, 0, 0);

                        chart.zoomOutButton.disabled = true;

                        var data = [];
                        var visits = 10;
                        var i = 0;

                        for (i = 0; i <= 60; i++) {
                            data.push({ date: new Date().setSeconds(i), value: 0 });
                        }

                        chart.data = data;

                        var dateAxis = chart.xAxes.push(new am4charts.DateAxis());
                        dateAxis.renderer.grid.template.location = 0;
                        dateAxis.renderer.minGridDistance = 30;
                        dateAxis.dateFormats.setKey("second", "ss");
                        dateAxis.periodChangeDateFormats.setKey("second", "[bold]h:mm a");
                        dateAxis.periodChangeDateFormats.setKey("minute", "[bold]h:mm a");
                        dateAxis.periodChangeDateFormats.setKey("hour", "[bold]h:mm a");
                        dateAxis.renderer.inside = true;
                        dateAxis.renderer.axisFills.template.disabled = true;
                        dateAxis.renderer.ticks.template.disabled = true;

                        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
                        valueAxis.tooltip.disabled = true;
                        valueAxis.interpolationDuration = 500;
                        valueAxis.rangeChangeDuration = 500;
                        valueAxis.renderer.inside = true;
                        valueAxis.renderer.minLabelPosition = 0.05;
                        valueAxis.renderer.maxLabelPosition = 0.95;
                        valueAxis.renderer.axisFills.template.disabled = true;
                        valueAxis.renderer.ticks.template.disabled = true;

                        var series = chart.series.push(new am4charts.LineSeries());
                        series.dataFields.dateX = "date";
                        series.dataFields.valueY = "value";
                        series.interpolationDuration = 500;
                        series.defaultState.transitionDuration = 0;
                        series.tensionX = 0.8;

                        chart.events.on("datavalidated", function () {
                            dateAxis.zoom({ start: 1 / 15, end: 1.2 }, false, true);
                        });

                        dateAxis.interpolationDuration = 500;
                        dateAxis.rangeChangeDuration = 500;

                        // document.addEventListener("visibilitychange", function() { 
                        //     // if (document.hidden) {
                        //     //     if (interval) {
                        //     //         clearInterval(interval);
                        //     //     }
                        //     // } else {
                        //     //     startInterval();
                        //     // }
                        // }, false);

                        function refreshChart()
                        {
                            var data = [];
                            var visits = 10;
                            var i = 0;

                            for (i = 0; i <= 10; i++) {
                                data.push({ date: new Date().setSeconds(i), value: 0 });
                            }

                            chart.data = data;
                            chart.validateData();
                        }

                        // add data
                        var interval;
                      
                        function startInterval() {
                            interval = setInterval(function() {
                                var all_live = false;
                                var admin_live = false;
                                var user_live = false;
                                if($("#all_live").is(":checked")) all_live = true;
                                if($("#admin_live").is(":checked")) admin_live = true;
                                if($("#user_live").is(":checked")) user_live = true;

                                var form_data = {
                                    id: $("#filter-ls").val(),
                                    last_sent: $("#last_sent").val(),
                                    all_live: all_live,
                                    admin_live: admin_live,
                                    user_live: user_live
                                };

                                $.ajax({
                                    url: "{{ url('liveSending') }}",
                                    type: "POST",
                                    data:form_data,
                                    success: function (resp) {
                                        var obj = JSON.parse(resp);
                                        var lastdataItem = series.dataItems.getIndex(series.dataItems.length - 1);
                                      
                                        chart.addData({ date: new Date().valueOf(), value: obj["last"] },1 );
                                        $("#last_sent").val(obj["current_value"]);
                                    }
                                });
                            }, 5000); 
                        }
                        $("body").on("change" , "#live_events" , function () {
                            localStorage.setItem("liveChart" , "on");
                            if($("#live_events").is(":not(:checked)")) {
                                localStorage.setItem("liveChart" , "off");
                                if (interval) { 
                                    clearInterval(interval);
                                }
                            }  else { 
                                refreshChart();
                                startInterval();
                            }
                        })

                        startInterval();

                        // all the below is optional, makes some fancy effects
                        // gradient fill of the series
                        series.fillOpacity = 1;
                        var gradient = new am4core.LinearGradient();
                        gradient.addColor(chart.colors.getIndex(0), 0.2);
                        gradient.addColor(chart.colors.getIndex(0), 0);
                        series.fill = gradient;

                        // this makes date axis labels to fade out
                        dateAxis.renderer.labels.template.adapter.add("fillOpacity", function (fillOpacity, target) {
                            var dataItem = target.dataItem;
                            return dataItem.position;
                        })

                        // need to set this, otherwise fillOpacity is not changed and not set
                        dateAxis.events.on("validated", function () {
                            am4core.iter.each(dateAxis.renderer.labels.iterator(), function (label) {
                                label.fillOpacity = label.fillOpacity;
                            })
                        })

                        // this makes date axis labels which are at equal minutes to be rotated
                        dateAxis.renderer.labels.template.adapter.add("rotation", function (rotation, target) {
                            var dataItem = target.dataItem;
                            if (dataItem.date && dataItem.date.getTime() == am4core.time.round(new Date(dataItem.date.getTime()), "minute").getTime()) {
                                target.verticalCenter = "middle";
                                target.horizontalCenter = "left";
                                return -90;
                            }
                            else {
                                target.verticalCenter = "bottom";
                                target.horizontalCenter = "middle";
                                return 0;
                            }
                        })

                        // bullet at the front of the line
                        var bullet = series.createChild(am4charts.CircleBullet);
                        bullet.circle.radius = 5;
                        bullet.fillOpacity = 1;
                        bullet.fill = chart.colors.getIndex(0);
                        bullet.isMeasured = false;

                        series.events.on("validated", function() {
                            bullet.moveTo(series.dataItems.last.point);
                            bullet.validatePosition();
                        });

                    }); // end am4core.ready()


                   

                </script>

                <!-- HTML -->
                <div id="livesending" data-name="pMzRcHoL"></div>
            </div>
        </div>
    </div>
    <!-- End Live Chart -->

    <!-- Sending Statistics -->
    <div class="col-md-8" data-name="kBVNALwO">        
        <div class="kt-portlet kt-portlet--height-fluid" data-intro="{{ trans('dashboard.email_stats') }}" data-name="cFhSmXtY">
            <div class="kt-portlet__head" data-name="dVxKiJIu">
                <div class="kt-portlet__head-label" data-name="SQJEeNTL">
                    <h3 class="kt-portlet__head-title">{{trans('dashboard.sending_statistics')}}</h3>
                    <span class="caption-helper">{{trans('dashboard.sending_statistics_helptext')}}</span>
                </div>
                <div class="tools" data-name="LPBchanf">
                    <br>
                 {{trans('dashboard.statistics_refreshed_every_hour')}}
                </div>
            </div>
            <div class="kt-portlet__body graph" style="display: block;" data-name="PXHqbdUp">
                <div class="row" data-name="gIccAfhL">
                    <div class="col-md-12" data-name="ZBgkAZNt">
                        <script src="/themes/default/js/amcharts.js"></script>
                        <script src="/themes/default/js/serial.js"></script>
                        <script src="/themes/default/js/light.js"></script>
                        <script src="/themes/default/js/pie.js"></script>
                        <script src="/themes/default/js/dataloader.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                $('#purpose , #select_types').on('change', function () {
                                    if($('#purpose').val() != 11 && $('#purpose').val() != 3){

                                        $('#datetimepicker-custom').hide();
                                        getStats($('#purpose').val(), "{{ url('/') }}");
                                    }
                                    else if($('#purpose').val() == 3) {

                                        todayStats("{{ url('/') }}");
                                    }
                                    else{
                                        getStats(11, "{{ url('/') }}");
                                        //  $('#chartdiv01').html('');

                                        var now = new Date();
                                        var day = ("0" + now.getDate()).slice(-2);
                                        var month = ("0" + (now.getMonth() + 1)).slice(-2);
                                        var today = now.getFullYear()+"-"+(month)+"-"+(day);

                                        var prev = new Date();
                                        prev.setDate(now.getDate()-7);
                                        var pday = ("0" + prev.getDate()).slice(-2);
                                        var pmonth = ("0" + (prev.getMonth() + 1)).slice(-2);
                                        var pyear = prev.getFullYear();
                                        var previous = pyear+"-"+(pmonth)+"-"+(pday);

                                        $('#to').val(today);
                                        $('#from').val(previous);

                                        $('#datetimepicker-custom').css("display", "inline-block");
                                        //  getCustomStats(from, to, "{{ url('/') }}");
                                    }
                                    getUserCampaigns($('#purpose').val());
                                });
                            });
                        </script>
                        <div class="dfilters">
                            <select class="form-control m-select2" id="purpose" data-placeholder="">
                                <option value="3" selected>{{trans('common.today')}}</option>
                                <option value="4">{{trans('common.yesterday')}}</option>
                                <option value="5">{{trans('common.this_week')}}</option>
                                <option value="6">{{trans('common.last_week')}}</option>
                                <option value="7">{{trans('common.this_month')}}</option>
                                <option value="8">{{trans('common.last_month')}}</option>
                                <option value="9">{{trans('common.this_year')}}</option>
                                <option value="10">{{trans('common.last_year')}}</option>
                                <option value="11">{{trans('common.custom')}}</option>
                            </select>
                            <div class="input-group date form_datetime bs-datetime" id="datetimepicker-custom" data-date="" data-date-format="yyyy-mm-dd" data-name="TVdxruVo">
                                <div class="input-daterange input-group" data-name="qaBJjqrt">
                                    <input type="text" class="form-control from" name="from" readonly="" id="from" data-date-format="yyyy-mm-dd">
                                    <div class="input-group-append" data-name="jjKUpfBv"><span class="input-group-text">-</span></div>
                                    <input type="text" class="form-control to" readonly="" name="to" id="to" data-date-format="yyyy-mm-dd">
                                    <button id="customSearch" class="btn btn-small btn-default"><i class="fa fa-caret-right"></i></button>
                                </div>
                                <div id="customMsg" style="display: none; color: red;" class="error" data-name="qpHNNCdc">{{trans('common.search.search_error')}}</div>
                            </div>
                            @if($broadcast_filter_dashboard==1 || $broadcast_filter_dashboard=='1')
                            <select class="form-control m-select2" id="purpose2" data-placeholder="{{trans('common.select_broadcast')}}">
                                
                            </select>
                            @endif
                            <div class="chart-filter" data-name="Zblhyrwt">
                                <select class="mt-multiselect btn btn-default form-control" name="db_events" id="select_types" multiple="multiple" data-label="left" data-select-all="false" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300">
                                        <option selected value="sent">{{trans('common.stats.sent')}}</option>
                                        <option selected value="opened">{{trans('common.stats.opened')}}</option>
                                        <option selected value="clicked">{{trans('common.stats.clicked')}}</option>
                                        <option  value="delivered">{{trans('common.stats.delivered')}}</option>
                                        <option  value="spammed">{{trans('common.stats.spammed')}}</option>
                                        <option  value="failed">{{trans('common.stats.failed')}}</option>
                                </select>
                            </div>
                        </div>
                        <!-- Chart code -->
                        <script src="/themes/default/js/statCharts.js?v=asqe2" type="text/javascript"></script>
                        <script type="text/javascript">
                        $(document).ready(function () {
                            setTimeout(() => {
                                todayStats("{{ url('/') }}");
                                getUserCampaigns($('#purpose').val());
                            }, 3000);
                        });
                        
                       </script>
                        <!-- HTML -->
                        <div id="chartdiv01" class="chartdiv" data-name="RplHLHlo"></div>
                    </div>
                </div>
                <div class="row" data-name="TZstOMHs">
                    <div class="col20" data-name="GWuNIiWy">
                        <div class="easy-pie-chart" data-name="cDpyljOh">
                            <div id="sent" class="number visits" data-percent="" data-name="ckFOpMqZ"> <span id="sentP" title=""></span><span id="sentPP" title="">0</span></div>
                            <span class="title" title=""> {{trans('common.stats.sent')}} <i class="la la-arrow-circle-o-right"></i> </span> </div>
                    </div>
                    <div class="col20" data-name="ddnAifBC">
                        <div class="easy-pie-chart" data-name="GidmVPAd">
                            <div id="opened" class="number opened" data-percent="" data-name="SEqFnqVz"> <span id="openedSP" title="">0</span></div>
                            <span class="title">
                                {{trans('common.stats.opened')}} <i class="la la-arrow-circle-o-right"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col20" data-name="SnQgMopf">
                        <div class="easy-pie-chart" data-name="GYxynkuk">
                            <div id="clicked" class="number clicked" data-percent="" data-name="AewIzotj"> <span id="clickedSP" title="">0</span></div>
                            <span class="title">
                                {{trans('common.stats.clicked')}} <i class="la la-arrow-circle-o-right"></i>
                            </span>
                        </div>
                    </div>
                    <div class="col20" data-name="usePDQda">
                        <div class="easy-pie-chart" data-name="dVJWPwVL">
                            <div id="spammed" class="number spammed" data-percent="" data-name="cgFFROzb"> <span id="spammedSP" title="">0</span></div>
                            <span class="title"> {{trans('common.stats.spammed')}} <i class="la la-arrow-circle-o-right"></i> </span> </div>
                    </div>
                    <div class="col20" data-name="gGPfSKXK">
                        <div class="easy-pie-chart" data-name="NEqnmDmc">
                            <div id="failed" class="number bounce" data-percent="" data-name="etULDGhU"> <span id="failedSP" title="">0</span></div>
                            <span class="title">
                                {{trans('common.stats.failed')}} <i class="la la-arrow-circle-o-right"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sending Statistics -->
   
    <div class="col-md-4" data-name="EPXBmfdb">
        <!--begin::List Widget 9-->
        <div class="kt-portlet kt-portlet--height-fluid h500 life_eventsBlk" data-name="XfOBIpKy">
            <!--begin::Header-->
            <div class="kt-portlet__head" data-name="bLAUSbrS">

                <div class="kt-portlet__head-label" data-name="NxebuQag">

                    <h3 class="kt-portlet__head-title">
                    {{ trans("dashboard.live_events")}}
                    <!-- <span class="text-muted mt-3 font-weight-bold font-size-sm">890,344 Sales</span> -->
                    </h3>
                </div>
                <div id="switch" data-name="BotWwBRg">
                     <label class="col-form-label text-left" for="autorefresh">
                        {{trans('dashboard.autorefresh')}}
                     </label>
                     <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                        <label>
                            <input type="checkbox" @if(session('autoRefreshLiveEvents')==1 || session('autoRefreshLiveEvents') ==null) checked @endif name="autoRefreshLiveEvents" id="autorefresh">
                            <span></span>
                        </label>
                    </span>
                    <input type="hidden" id="autorefreshinput" value="{{(session('autoRefreshLiveEvents')==1 || session('autoRefreshLiveEvents') ==null) ? 1:0}}">
                </div>
            </div>
            <!--end::Header-->
            <!--begin::Body-->
            
            <div class="kt-portlet__body scroll scroll-475" data-always-visible="1" data-rail-visible="0" data-name="lyFKYimB">
                @if(superAdmin(auth()->user()))
                 <a href="javascript:void(0)" id="filter"><i class="fa fa-bars pull-right btn btn-default btn-sm" style="font-size:20px"></i></a>
                 <div class="row bulltOpt dashboard_bullets" id="filter_row" style="display: none;" data-name="SBbKGThU">
                    <div class="col-md-12 pull-left bulltOpt" data-name="OihxZJRH">
                        <div class="bullOptions kt-radio-inline" data-name="XnvQCGPA">
                            <label for="admin_events" class="kt-radio">
                                <input type="radio" checked="" class="optbulls"  name="event_filter" id="admin_events" value="admin_events">
                                {{ trans('dashboard.admin_events') }}
                                <span></span>
                            </label>
                            <label for="user_events" class="kt-radio"><input type="radio" class="optbulls" name="event_filter" id="user_events" value="user_events" >
                               {{ trans('dashboard.user_events') }}
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12" data-name="NRHdDYzN">
                        <div class="bullData" data-name="pXDGEbER">
                            <div class="lshapeBlk" data-name="ZquqlAWy"><i class="la la-level-down lshap"></i></div>
                            <div class="lshBlksl" data-name="SzZGrBqT">
                                <select class="form-control m-select2" name="clients" id="clients" >
                                    <option value="">{{ trans('common.filter.user_select') }}</option>
                                    @foreach($client_data as $client_row)
                                        <option value="{{ $client_row->id }}">{{ $client_row->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="admin_filter" id="admin-filter" data-name="JKAWpcnx" >
                            <div class="lshapeBlk" data-name="eyOmxGOE"><i class="la la-level-down lshap"></i></div>
                            <div class="lshBlksl" data-name="eNCpBdCS">
                                <select class="form-control m-select2" id="admins" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="true" data-placeholder="{{ trans('common.filter.all_admins') }}">
                                <option value="">{{ trans('Select Admin') }}</option>
                                <option value="all">{{ trans('common.filter.all_admins') }}</option>
                                    @foreach($admins as $admin)
                                        <option value="{{ $admin->id }}">{{ $admin->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="" id="live-events" data-name="JkUtxqTX"></div>
            </div>
            <!--end: Card Body-->
        </div>
        <!--end: List Widget 9-->
    </div>
    
</div>

<div class="row portel-hide" data-name="nYxamCSV">
    <!-- Top Domains -->
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="eecSrrXX">
        <div class="kt-portlet kt-portlet--height-fluid top-domains-blk" data-intro="{{ trans('dashboard.top_domains') }}" data-name="FmOtgEUZ">
            <div class="kt-portlet__head" data-name="AILLfqPW">
                <div class="kt-portlet__head-label" data-name="YdDgdZNk">
                    <h3 class="kt-portlet__head-title">{{trans('dashboard.top_domains')}}</h3>
                    <span class="caption-helper"></span>
                </div>

                <div class="tools" data-name="lIRYqUVG">
                    <a href="" class="reload" data-original-title="" title="" onclick="getTopDomains(3)"> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                </div>

            </div>

            <div class="kt-portlet__body" data-name="fDZPsXTs">
                <script>
                    $(document).ready(function () {
                        $('#datetimepicker-stats-top').hide();
                        $('#stats-top-domains').on('change', function () {
                            var id = $('#stats-top-domains').val();
                            if(id==1 || id==2){
                                $('#domain_disclaimer').hide();
                            }else{
                                $('#domain_disclaimer').show();
                            }
                            getTopDomains(id);
                            // console.log('changed', id);
                        });
                    });
                </script>
                <div class="devfiltBlk" data-name="FrGYUfKr">
                    <select class="form-control" id="stats-top-domains">
                        <option value="1" selected="selected">{{trans('common.today')}}</option>
                        <option value="2">{{trans('common.yesterday')}}</option>
                        <option value="3">{{trans('common.last7days')}}</option>
                        <option value="4">{{trans('common.last30days')}}</option>
                    </select>
                    <div class="input-group date form_datetime bs-datetime" id="datetimepicker-stats-top" data-date="" data-date-format="yyyy-mm-dd" data-name="IJkfKFjT">
                        <div class="input-daterange input-group" data-name="HkCFubBr">
                            <input type="text" class="form-control from" name="domain_from" readonly="" id="domain_from" data-date-format="yyyy-mm-dd">
                            <div class="input-group-append" data-name="svFDPktn"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>
                            <input type="text" class="form-control to" readonly="" name="domain_to" id="domain_to" data-date-format="yyyy-mm-dd">
                        </div>
                        <button id="domainCustomSearch" class="btn btn-small btn-default">{{trans('common.search.title')}}</button>
                        <div id="customMsg" style="display: none; color: red" class="error" data-name="AtKIgyLJ">{{trans('common.search.search_error')}}</div>
                    </div>
                </div>
                <!-- Chart code -->
                <script>
                    const user_id = {{Auth::User()->id}}
                    setTimeout(() => {
                        getTopDomains($("#stats-top-domains").val());
                    }, 3000);
                   
                    function getTopDomains(id) {
                        $('#datetimepicker-stats-top').hide();
                        var chart13 = AmCharts.makeChart("getTopDomains", {
                            "theme": "light",
                            "type": "serial",
                            "startDuration": 2,
                            "dataLoader": {
                                "url": "{{ url('/') }}"+"/top-domains-overall/"+id,
                                "format": "json",
                                "complete": function (chart14) {
                                    if (chart14.dataProvider[0].count == 0) {
                                        setTimeout(() => {
                                            $("#getTopDomains").html("<div class='emptydev'><span class='emptyIcon empty'></span><span class='mtaemptyc'>No data available</span></div>");
                                        }, 1);
                                    }
                                }
                            },
                            "valueAxes": [{
                                "position": "left",
                                "title": ""
                            }],
                            "graphs": [{
                                "balloonText": "[[category]]: <b>[[value]]</b>",
                                "fillColorsField": "color",
                                "fillAlphas": 1,
                                "lineAlpha": 0.1,
                                "type": "column",
                                "valueField": "count"
                            }],
                            "depth3D": 20,
                            "angle": 30,
                            "chartCursor": {
                                "categoryBalloonEnabled": false,
                                "cursorAlpha": 0,
                                "zoomable": false
                            },
                            "categoryField": "Domain",
                            "categoryAxis": {
                                "gridPosition": "start",
                                "labelRotation": 45
                            },
                            "export": {
                                "enabled": true
                            }
                        });
                    }

                    function domainCustomStats(from, to) {

                        var chart13 = AmCharts.makeChart("getTopDomains", {
                            "theme": "light",
                            "type": "serial",
                            "startDuration": 2,
                            "dataLoader": {
                                "url": "{{ url('/') }}"+"/stats-top-domains-custom/"+from+"/"+to,
                                "format": "json",
                                "complete": function (chart14) {
                                    console.log('=========', chart14.dataProvider[0].count);
                                    if (chart14.dataProvider[0].count == 0) {
                                        setTimeout(() => {
                                            $("#getTopDomains").html("<div class='emptydev'><span class='emptyIcon empty'></span><span class='mtaemptyc'>No data available</span></div>");
                                        }, 1);
                                    }
                                }
                            },
                            "valueAxes": [{
                                "position": "left",
                                "title": ""
                            }],
                            "graphs": [{
                                "balloonText": "[[category]]: <b>[[value]]</b>",
                                "fillColorsField": "color",
                                "fillAlphas": 1,
                                "lineAlpha": 0.1,
                                "type": "column",
                                "valueField": "count"
                            }],
                            "depth3D": 20,
                            "angle": 30,
                            "chartCursor": {
                                "categoryBalloonEnabled": false,
                                "cursorAlpha": 0,
                                "zoomable": false
                            },
                            "categoryField": "Domain",
                            "categoryAxis": {
                                "gridPosition": "start",
                                "labelRotation": 45
                            },
                            "export": {
                                "enabled": true
                            }
                        });
                    }
                </script>

                <div class="alert alert-solid-dark alert-bold" id="domain_disclaimer" role="alert" data-name="RKnrTihM" style="display: none;">
                    <div class="alert-text" data-name="PQOLjdjq">@lang('dashboard.message.domain_disclaimer')</div>
                </div>
                <div id="getTopDomains" class="chartdiv2" data-name="GmqSUMBi"><div class='emptydev'><span class='emptyIcon empty'></span><span class='mtaemptyc'>{{trans('dashboard.no_data')}}</span></div></div>

            </div>
        </div>
    </div>
    <!-- Top Domains -->

    <!-- Opened by Device -->
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="iRJBURgj">
        <div class="kt-portlet kt-portlet--height-fluid" data-intro="{{ trans('dashboard.opened_by_device') }}" data-name="LcDkFyxY">
            <div class="kt-portlet__head" data-name="FRRuuAoa">
                <div class="kt-portlet__head-label" data-name="nqTmLVVi">
                    <h3 class="kt-portlet__head-title"> {{trans('dashboard.opened_by_device')}} </h3>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools" data-name="QuejXYNt">
                    <a href="" class="reload" data-original-title="" title="" onClick="deviceStatChart(3)"> </a>
                    <a href="" class="fullscreen myactivity" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="kt-portlet__body" style="display: flex;" data-name="ifcbYmmO">
                <!--  <div class="w300"> -->
                <script>
                    $(document).ready(function () {
                        $('#datetimepicker-device').hide();
                        $('#device-stat-purpose').on('change', function () {
                            var id = $('#device-stat-purpose').val();
                            if(id != 11){
                                $('#datetimepicker-device').hide();
                                deviceStatChart(id);
                            }else{
                                deviceStatChart(11);

                                var now = new Date();
                                var day = ("0" + now.getDate()).slice(-2);
                                var month = ("0" + (now.getMonth() + 1)).slice(-2);
                                var today = now.getFullYear()+"-"+(month)+"-"+(day);

                                var prev = new Date();
                                prev.setDate(now.getDate()-10);
                                var pday = ("0" + prev.getDate()).slice(-2);
                                var pmonth = ("0" + (prev.getMonth() + 1)).slice(-2);
                                var pyear = prev.getFullYear();
                                var previous = pyear+"-"+(pmonth)+"-"+(pday);

                                $('#device_to').val(today);
                                $('#device_from').val(previous);
                                $('#datetimepicker-device').show();
                            }
                        });
                    });
                </script>
                <div class="devfiltBlk" data-name="MZVZoOjN">
                    <select class="form-control" id="device-stat-purpose">
                        <option value="3">{{trans('common.today')}}</option>
                        <option value="4">{{trans('common.yesterday')}}</option>
                        <option value="5">{{trans('common.this_week')}}</option>
                        <option value="6">{{trans('common.last_week')}}</option>
                        <option value="7">{{trans('common.this_month')}}</option>
                        <option value="8">{{trans('common.last_month')}}</option>
                        <option value="9">{{trans('common.this_year')}}</option>
                        <option value="10">{{trans('common.last_year')}}</option>
                        <option value="11">{{trans('common.custom')}}</option>
                    </select>
                    <div class="input-group date form_datetime bs-datetime" id="datetimepicker-device" data-date="" data-date-format="yyyy-mm-dd" data-name="TBwLGEWi">
                        <div class="input-daterange input-group" data-name="HsuRlaNr">
                            <input type="text" class="form-control from" name="device_from" readonly="" id="device_from" data-date-format="yyyy-mm-dd">
                            <div class="input-group-append" data-name="xSILhawq"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>
                            <input type="text" class="form-control to" readonly="" name="device_to" id="device_to" data-date-format="yyyy-mm-dd">
                        </div>
                        <button id="deviceCustomSearch" class="btn btn-small btn-default">{{trans('common.search.title')}}</button>
                        <div id="customMsg" style="display: none; color: red" class="error" data-name="gkMHghsx">{{trans('common.search.search_error')}}</div>
                    </div>
                </div>

                <!-- Chart code -->
                <script>

                    deviceStatChart(3);
                    function deviceStatChart(id)
                    {
                        //  var id = $('#device-stat-purpose').val();
                        var route = "{{ url('/') }}"+"/device-stats/"+id;

                        var chart8 = AmCharts.makeChart( "chartdiv8", {
                            "type": "pie",
                            "theme": "light",
                            "titles": [ {
                                "text": "",
                                "size": 0
                            } ],
                            "legend":{
                                "position":"bottom",
                                "marginRight":100,
                                "autoMargins":false
                            },
                            "dataLoader": {
                                "url": route,
                                "format": "json",
                                "complete": function (chart14) {
                                    if (chart14.dataProvider[0].visits === 0 && chart14.dataProvider[1].visits === 0) {
                                        $("#chartdiv8").html("<div class='emptydev'><span class='emptyIcon empty'></span><span class='mtaemptyc'>{{ trans('dashboard.message.device_stats_error')}}</span></div>");
                                    }
                                }
                            },

                            "valueField": "visits",
                            "titleField": "devices",
                            "labelText": "",
                            "startEffect": "elastic",
                            "colorField": "color",
                            "startDuration": 2,
                            "labelRadius": 15,
                            "innerRadius": "50%",
                            "depth3D": 6,
                            "balloonText": "[[title]] Views<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                            "balloon": {
                                "fixedPosition": true
                            },
                            "angle": 10
                        });
                    }

                    function deviceCustomStats(from, to){
                        const url = "{{ url('/') }}";

                        var route = `${url}/device-custom-stats/${from}/${to}`;
                        // console.log('route..', route);
                        // return;
                        var chart8 = AmCharts.makeChart( "chartdiv8", {
                            "type": "pie",
                            "theme": "light",
                            "titles": [ {
                                "text": "",
                                "size": 0
                            } ],
                            "dataLoader": {
                                "url": route,
                                "format": "json",
                                "complete": function (chart14) {
                                    // console.log('complete:chart14-2', chart14);
                                    if (chart14.dataProvider[0].visits === 0 && chart14.dataProvider[1].visits === 0) {
                                        $("#chartdiv8").html("<div class='emptydev'><span class='emptyIcon empty'></span><span class='mtaemptyc'>{{ trans('dashboard.message.device_stats_error')}}</span></div>");
                                    }
                                }
                            },

                            "valueField": "visits",
                            "titleField": "devices",
                            "startEffect": "elastic",
                            "colorField": "color",
                            "startDuration": 2,
                            "labelRadius": 15,
                            "innerRadius": "50%",
                            "depth3D": 6,
                            "balloonText": "[[title]] Views<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
                            "balloon": {
                                "fixedPosition": true
                            },
                            "angle": 10
                        });

                    }

                </script>
              
                <!-- HTML -->
                <div id="chartdiv8" class="chartdiv2" data-name="bFcQcrjH"></div>
                <!--    </div> -->
            </div>
        </div>
    </div>
    <!-- Opened by Device -->

    <!-- Recent Schedules -->
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="AEmLuKiJ">
        <div class="kt-portlet kt-portlet--height-fluid" data-intro="{{ trans('dashboard.recent_schedules') }}" data-name="peBNcEuH">
            <div class="kt-portlet__head" data-name="QKemolbQ">
                <div class="kt-portlet__head-label" data-name="LjeIgEKq">
                    <h3 class="kt-portlet__head-title"> {{trans('dashboard.recent_schedules')}} </h3>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools" data-name="HSIvGTCG">
                    <a href="" class="reload" onClick="campaignStats()" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen myactivity" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="kt-portlet__body schedules" style="display: block;" data-name="xFBAjibL">
                <div class="scroll scroll-325" data-always-visible="1" data-rail-visible="0" data-name="BErWefaS">
                    <ul class="nav nav-tabs">
                        <!-- broadcast tab -->
                        @if(routeAccess('statistics.broadcasts.page.title'))
                            <li class="nav-item">
                                <a href="#tab1" class="nav-link active" data-toggle="tab" onClick="campaignStats()">{{trans('dashboard.broadcasts')}}</a>
                            </li>
                        @endif
                        <!-- trigger tab -->                        
                        <!-- @if(routeAccess('statistics.trigger.index'))
                            <li class="nav-item">
                                <a href="#tab2" class="nav-link" data-toggle="tab" onClick="triggerStats()">{{trans('dashboard.triggers')}}</a>
                            </li>
                        @endif -->
                        @if(rolePermission(281))
                            {{--<li class="nav-item">
                                <a href="#tab3" class="nav-link" data-toggle="tab" onClick="dripStats()">{{trans('dashboard.drips')}}</a>
                            </li>--}}
                        @endif
                    </ul>
                    <div class="tab-content" data-name="moFvnzAa">
                        <!-- broadcast data -->
                        <div class="tab-pane active" id="tab1" data-name="OLAeEhwk">
                            <div class='table-scrollable' id="campaign_statss" data-name="PIzhkrsB"></div>
                        </div>
                        <!-- trigger data -->
                        <!-- <div class="tab-pane" id="tab2">
                            <div class='table-scrollable' id='trigger_statss'></div>
                        </div> -->
                        @if(rolePermission(281))
                            <div class="tab-pane" id="tab3" data-name="XsDcSgqW">
                                <div class='table-scrollable' id='drip_statss' data-name="cLSOGVll"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Schedules -->
</div>
<div class="row portel-hide" data-name="ycirYYdS">
    <!-- Recent Activities -->
    <div class="col-lg-4 col-xs-12 col-sm-12" data-name="vGpBYWLn">
        <div class="kt-portlet kt-portlet--height-fluid" data-intro="{{ trans('dashboard.activity_log.recent_activities') }}" data-name="lcCcgkbs">
            <div class="kt-portlet__head" data-name="zyCBVtaO">
                <div class="kt-portlet__head-label" data-name="yDUPxBtP">
                    <h3 class="kt-portlet__head-title"> {{trans('dashboard.activity_log.recent_activities')}}</h3>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools" data-name="pguWEEEA">
                    <a href="" class="reload" onclick="loadActivityLogs()" data-original-title="" title=""> </a>
                    <a href="" class="fullscreen myactivity" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit" style="display: block;" data-name="IaosOJbd">
                <div class="scroll scroll-350 ra-scroll" data-always-visible="1" data-rail-visible="0" data-name="pwtdVnju">
                    <div class="kt-widget4 kt-widget4--sticky" data-name="IXzLEODf">
                        <div id="load-activityLogs" class="kt-widget4__items kt-portlet__space-x kt-margin-t-15" data-name="pJLEsnJK">
                        </div>
                    </div>
                </div>
                <div class="scroller-footer ra-footer" data-name="FTkaYZXY">
                    <div class="btn-arrow-link pull-right" data-name="xbZDUmqV"> <a href="{{ route('activity-log.index') }}">{{trans('dashboard.activity_log.see_all')}}</a> <i class="icon-arrow-right"></i> </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recent Activities -->

    <!-- Opened by Countries -->
    <div class="col-lg-8 col-xs-12 col-sm-12" data-name="utOrtAnL">
        <div class="kt-portlet kt-portlet--height-fluid contriesBlk" id="contriesBlk" data-intro="{{trans('dashboard.opened_by_countries')}}" data-name="ABTgeqgN">
            <div class="kt-portlet__head" data-name="tUXvwHNC">
                <div class="kt-portlet__head-label" data-name="YnaVAMJK">
                    <h3 class="kt-portlet__head-title"> {{trans('dashboard.opened_by_countries')}}</h3>
                    <span class="caption-helper"></span>
                </div>
                <div class="tools" data-name="wKybiIog">
                    <a href="" class="reload" data-original-title="" title="" onclick="drawRegionsMap()"> </a>
                    <a href="" class="fullscreen" data-original-title="" title=""> </a>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="ShmsrIne">
                <div class="form-group row" data-name="sRdhEeSD">
                    <div class="col-md-8" data-name="UGjMWYir">
                        <script type="text/javascript" src="/themes/default/js/map/anychart-base.min.js"></script>
                        <script type="text/javascript" src="/themes/default/js/map/anychart-ui.min.js"></script>
                        <script type="text/javascript" src="/themes/default/js/map/anychart-map.min.js"></script>
                        <script type="text/javascript" src="/themes/default/js/map/anychart-data-adapter.min.js"></script>
                        <script type="text/javascript" src="/themes/default/js/map/world.js"></script>
                        
                        <script type="text/javascript">
                            function loadmap() { 

                                anychart.onDocumentReady(function () {

                                    var date_id = $("#geo-stat-purpose-id").val();
                                    if(date_id != ""){
                                        id = date_id;
                                        var url = "{{ url('/') }}"+"/geo-stats/"+id;
                                    }
                                    else{
                                        var from = $("#geo_from").val();
                                        var to = $("#geo_to").val();

                                        if(from != "" && to != ""){
                                            var url = "{{ url('/') }}"+"/geo-stats-custom/"+from+"/"+to;
                                        }else{
                                            id = 3;
                                            var url = "{{ url('/') }}"+"/geo-stats/"+id;
                                        }
                                    }

                                    $("#maps").html("");
                                
                                    // var jsonData = $.ajax({
                                    //     url: url,
                                    //     dataType: "json",
                                    //     async: false
                                    // }).responseText;
                                    // var my_data = JSON.parse(jsonData);

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

                                        // create zoom controls
                                        var zoomController = anychart.ui.zoom();
                                        zoomController.render(map);

                                        // set container id for the chart
                                        map.container('maps');
                                        // initiate chart drawing
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
                                var date_id = $("#geo-stat-purpose-id").val();
                                if(date_id != ""){
                                    id = date_id;
                                    var url = "{{ url('/') }}"+"/geo-stats/"+id;
                                }
                                else{
                                    var from = $("#geo_from").val();
                                    var to = $("#geo_to").val();

                                    if(from != "" && to != ""){
                                        var url = "{{ url('/') }}"+"/geo-stats-custom/"+from+"/"+to;
                                    }else{
                                        id = 3;
                                        var url = "{{ url('/') }}"+"/geo-stats/"+id;
                                    }
                                }
                                var jsonData = $.ajax({
                                    url: url,
                                    dataType: "json",
                                    async: false
                                }).responseText;
                                var newData = JSON.parse(jsonData);
                                var options = {
                                    colors: ['#1CAF9A']
                                };
                            }
                        </script>

                        
                        
                        <div id="maps" data-name="cMfVUfpJ"></div>

                        <div id="regions_div" style="width: 100%; height: 300px; display:none;" data-name="pYkkDuAt"></div>
                    </div>
                    <div class="col-md-4" data-name="obYrgJby">
                        <script>
                            $(document).ready(function () {
                                $('#datetimepicker-geo').hide();
                                $('#geo-stat-purpose').on('change', function () {
                                    var id = $('#geo-stat-purpose').val();
                                    if(id != 11){
                                        $('#datetimepicker-geo').hide();
                                        $("#geo-stat-purpose-id").val(id);
                                        drawRegionsMap();
                                        getCountriesStat(id)
                                    }else{
                                        $("#geo-stat-purpose-id").val('');
                                        drawRegionsMap();
                                        $('#datetimepicker-geo').show();
                                    }
                                });
                            });
                        </script>
                        <div class="devfiltBlk2" data-name="KEijJgeY">
                            <select class="form-control" id="geo-stat-purpose" style="width: 100%;">
                                <option value="3">{{trans('common.today')}}</option>
                                <option value="4">{{trans('common.yesterday')}}</option>
                                <option value="5">{{trans('common.this_week')}}</option>
                                <option value="6">{{trans('common.last_week')}}</option>
                                <option value="7">{{trans('common.this_month')}}</option>
                                <option value="8">{{trans('common.last_month')}}</option>
                                <option value="9">{{trans('common.this_year')}}</option>
                                <option value="10">{{trans('common.last_year')}}</option>
                                <option value="11">{{trans('common.custom')}}</option>
                            </select>
                            <input type="hidden" id="geo-stat-purpose-id" value="">
                            <div class="input-group date form_datetime bs-datetime" id="datetimepicker-geo" data-date="" data-date-format="yyyy-mm-dd" data-name="RWZQysaN">
                                <div class="input-daterange input-group dategroupmap" data-name="KaZfAUoh">
                                    <input type="text" class="form-control from" name="geo_from" readonly="" id="geo_from" data-date-format="yyyy-mm-dd">
                                    <div class="input-group-append" data-name="MskdtPNQ"><span class="input-group-text"><i class="la la-ellipsis-h"></i></span></div>
                                    <input type="text" class="form-control to" readonly="" name="geo_to" id="geo_to" data-date-format="yyyy-mm-dd">
                                </div>
                                <button id="geoCustomSearch" class="btn btn-small btn-default">{{trans('common.search.title')}}</button>
                                <div id="customMsg" style="display: none; color: red" class="error" data-name="yIZWkmwQ">{{trans('common.search.search_error')}}</div>
                            </div>
                        </div>
                        <script>
                           
                        </script>
                        <div class="dataTables_wrapper no-footer table-responsive" data-name="vAtJfRia">
                            <table class="table table-striped table-hover table-checkable responsive" id="top-countries" cellspacing="0">
                                <thead>
                                <tr>
                                    <th class="min-tablet">{{trans('dashboard.country_name')}}</th>
                                    <th class="all">{{trans('dashboard.opens')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Opened by Countries -->
</div>
<div class="clearfix" data-name="yseLNSZR"></div>
<!-- END DASHBOARD STATS 1-->
@endsection