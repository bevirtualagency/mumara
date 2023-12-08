@extends(decide_template())

@section('title', $pageTitle )

@section('page_styles')
<link href="/resources/assets/css/email-campaign-statistics-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
<style type="text/css">
    span.read_more,a.read_less {display: none;}
    #bot_message{
        float: right;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    var objTable;
    var record_type = 'our_records';
    $(document).on("load", function() {
        $(".tooltips").tooltip();
    });
    $(document).ready(function() {

        $("body").addClass(" kt-aside--minimize");
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Statistics/Broadcast-Stats");

        $('body').tooltip({
            selector: '[data-toggle=tooltip]'
        });
        
        $(document).on('click','.show_dots',function() {
            if(!$(this).is(':visible')){
                $(this).css('display','inline');
                $('span.read_more,a.read_less').hide();
            }else{
                $(this).css('display','none');
                $('span.read_more,a.read_less').css('display','inline');
            }
        });
        $(document).on('click','.read_less',function(){
                $('.show_dots').css('display','inline');
                $('span.read_more,a.read_less').hide();
        });
        // function in master2 layout
        var page_limit=show_per_page('','stats_pageLength',10);  // Params (table,page,default_limit=10)
        var table= $('#statistics').DataTable({
            "aoColumnDefs": [
            {"bSortable": false, "aTargets": [0,6,7,8,9,10,11,12,13], "className": "dt-center"},
            {
                "targets": [ 2 ],
                "visible": <?php echo (Auth::user()->is_client==1) ? 0:1;?>,
                "searchable": true
            }],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[5, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/statistics/getBroadcasts') }}",
            "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });

        page_limit=show_per_page(table,'stats_pageLength');
        objTable = table;
        $(document).on( "click", ".btn-load-data-customer", function() {
            var url = $(this).attr('data');
            var elb = $(this).attr('id');
             $("#running_in_background").prop('checked', true);
            $('#bot_inluded').prop('checked', false);
            $("#botsSection").show();
            var bot_lable = "{{ trans('statistics.modal.download_customer_field.bots_open_click_all') }}";
            $("#openclickFlag").val(1);
            $("#load-data-customer-field").modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
            $("#GoUrl").val(url);
            $("#elb").val(elb);
        });
        
        $("#downloadData").click(function () {
            var customeFieldCheck = 0;
            var running_in_background = 0;
            
            if ($("#isDownlloadCustomfields").is(':checked')) {
                customeFieldCheck = 1;
            }
            if ($("#running_in_background").is(':checked')) {
                running_in_background = 1;
            }

            var Url = $("#GoUrl").val() + "?customeFieldCheck=" + customeFieldCheck;
            var random = (Math.random() + 1).toString(36).substring(2);
            if ($("#openclickFlag").val() == 1) {
                var isBot = 0;
                if ($('#bot_inluded').is(":checked")) {
                    isBot = 1
                }
                Url = Url + '&is_bots=' + isBot;
            }
            Url+='&random='+random;
            $("#load-data-customer-field").modal("hide");

           /* if ($("#elb").val() == 'elb') {
                exportLogsCSV();
            } else {
                $("#elb").val("");
            }*/
            ///console.log(Url);
            if(running_in_background==0 || running_in_background=='0'){
                window.location.href = Url;
            }else{
                $.ajax({
                    type: 'GET',
                    url: Url,
                    data: {'running_in_background':1},
                    beforeSend: function() {
                        $('.blockUI').show();
                    },
                    success: function (data) {
                        if (data)
                            toastr.success(data);
                        else
                            toastr.error("Error");
                    }, error: function (jqXHR, status, err) {
                        $('.blockUI').hide();
                    },
                    complete: function () {
                        $('.blockUI').hide();
                    }
                });
            }

        });

    });
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="UpCagtVA">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if (Session::has('msg'))
<div class="alert alert-success" data-name="KiGflqcu">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="wAEXYyxh">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>



<div class="row" data-name="bsJPSOPo">
    <div class="col-md-12" data-name="olAOEKzV">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="sDIYtqOB">
            <div class="kt-portlet__body" data-name="oezUuNRp">
                <div class="table-scrollable" data-name="ZlYpajGZ">
                    @include('includes.view-pages-filter')
                    <div class="table-scrollable">
                        <?php 
                            $delete_schedule_broadcast_flag = getSetting('delete_schedule_broadcast_flag');
                            $delete_schedule_broadcast = getSetting('delete_schedule_broadcast');
                            if($delete_schedule_broadcast_flag == "on") {
                        ?>

                        <div class="user-table-warning"><b>{{trans('statistics.email_campaigns_blade.bold_heading_note')}}</b>{{trans('statistics.email_campaigns_blade.div_txt_statistics_data')}} <code>{{ $delete_schedule_broadcast}}</code> {{trans('statistics.email_campaigns_blade.div_txt_statistics_data_end_warning')}}</div>
                        <?php } ?>
                        <table class="table table-striped table-hover table-checkable" id="statistics" role="grid" >
                            <thead>
                                <tr role="row">
                                    <th>{{trans('statistics.broadcast.column.id')}}</th>
                                    <th>{{trans('statistics.broadcast.column.label')}}</th>
                                    <th>{{trans('statistics.broadcast.column.schedule_by')}}</th>
                                    <th>{{trans('statistics.broadcast.column.campaign_name')}}</th>
                                    <th>{{trans('statistics.broadcast.column.type')}}</th>
                                    <th>{{trans('statistics.broadcast.column.start_time')}}</th>
                                    <th>{{trans('statistics.broadcast.column.contacts')}}</th>
                                    <th>{{trans('statistics.broadcast.column.sent')}}</th>
                                    <th>{{trans('statistics.broadcast.column.skipped')}}</th>
                                    <th>{{trans('statistics.broadcast.column.opened')}}</th>
                                    <th>{{trans('statistics.broadcast.column.clicked')}}</th>
                                    <th>{{trans('statistics.broadcast.column.unsubscribed')}}</th>
                                    <th>{{trans('statistics.broadcast.column.details')}}</th>
                                    <th>{{trans('statistics.broadcast.column.download')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@include('statistics.common.popup_stats')
@endsection