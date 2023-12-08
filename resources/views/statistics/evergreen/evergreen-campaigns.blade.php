@extends(decide_template())

@section('title', $pageTitle )

@section('page_styles')
<link href="/resources/assets/css/email-campaign-statistics-view.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style type="text/css">
span.read_more,a.read_less {display: none;}
#bot_message{
    float: right;
}
.dataTables_wrapper .dataTable td:first-child, .dataTables_wrapper .dataTable th:first-child {
    width: 5% !important;
    max-width: 30px !important;
    min-width: 20px !important;
}
.table thead tr th:nth-child(2), .table tbody tr td:nth-child(2) {
    text-align: left !important;
    white-space: nowrap !important;
}
.table thead tr th, .table tbody tr td {
    white-space: nowrap;
}
.dataTables_wrapper .dataTable td:last-child, .dataTables_wrapper .dataTable th:last-child {
    max-width: 60px;
    text-align: center;
    padding: 12px 15px !important;
}
.dataTables_wrapper .dataTable th:last-child:before,
.dataTables_wrapper .dataTable th:last-child:after,
.dataTables_wrapper .dataTable th:nth-child(4):before,
.dataTables_wrapper .dataTable th:nth-child(4):after
 {
    display:none
}
.table thead tr th:nth-child(3), .table tbody tr td:nth-child(3),
.table thead tr th:nth-child(4), .table tbody tr td:nth-child(4) {
    max-width: 180px;
    text-align: left;
    padding: 12px 15px !important;
}
.table thead tr th:nth-child(5), .table tbody tr td:nth-child(5) {
    max-width: 200px;
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

        // $("body").addClass(" kt-aside--minimize");
            
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
            {"bSortable": false, "aTargets": [0,1,2,3,4,5], "className": "dt-center"},
            {
                "targets": [ 2 ],
                "visible": <?php echo (Auth::user()->is_client==1) ? 0:1;?>,
                "searchable": true
            }],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[5, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/statistics/evergreen/emailCampaignsAjax') }}",
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
        
        $("#downloadData").click(function(){
            var customeFieldCheck = 0;
            
            if ($("#isDownlloadCustomfields").is(':checked')) {
                customeFieldCheck = 1;
            }
            
            var Url  = $("#GoUrl").val()+"?customeFieldCheck="+customeFieldCheck;
            if ($("#openclickFlag").val() == 1) {
                var isBot = 0;
                if ($('#bot_inluded').is(":checked")) {
                    isBot = 1
                }
                Url = Url + '&is_bots=' + isBot;
            }
            $("#load-data-customer-field").modal("hide");
            
            if($("#elb").val()=='elb'){
                exportLogsCSV();
            }else{
                $("#elb").val("");
            }
            window.location.href = Url;
            
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
                        <table class="table table-striped table-hover table-checkable" id="statistics" role="grid" >
                            <thead>
                                <tr role="row">
                                    <th>{{trans('evergreen.id')}}</th>
                                    <th>{{trans('evergreen.name')}}</th>
                                    <th>{{trans('evergreen.runs')}}</th>
                                    <th>{{trans('evergreen.last_run')}}</th>
                                    <th>{{trans('evergreen.next_run')}}</th>
                                    <th>{{trans('statistics.broadcast.column.details')}}</th>
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