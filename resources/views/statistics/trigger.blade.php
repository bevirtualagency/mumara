@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/trigger-statistics-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
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
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Statistics/Trigger-Stats");

        $('body').tooltip({
            selector: '[data-toggle=tooltip]'
        });
       // function in master2 layout
        var page_limit=show_per_page('','trigger-statistics_pageLength',10);  // Params (table,page,default_limit=10)
        var table= $('#trigger-statistics').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2,3,4,6], "className": "dt-center"}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[5, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/statistics/getTriggers') }}",
            "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
        objTable = table;
        page_limit=show_per_page(table,'trigger-statistics_pageLength');
    });
</script>
    @include('includes.view-pages-filter-script')
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="kyVxMhRb">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="JblsRVGv">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="HFYqtKDT">
    <div class="col-md-12" data-name="AiQZDYpz">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="tNBwaKJD">
            <div class="kt-portlet__body" data-name="MRyRTUJQ">
                @include('includes.view-pages-filter')
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="trigger-statistics" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('statistics.trigger.column.id')}}</th>
                                <th>{{trans('statistics.trigger.column.name')}}</th>
                                <th>{{trans('statistics.trigger.column.criteria')}}</th>
                                <th>{{trans('statistics.trigger.column.action')}}</th>
                                <th>{{trans('statistics.trigger.column.contact_count')}}</th>
                                <th>{{trans('statistics.trigger.column.last_activity')}}</th>
                                <th>{{trans('statistics.trigger.column.details')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection