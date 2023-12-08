@extends(decide_template())
@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/activity-logs.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        // $("a#help-article").css("display", "block");
        // $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Tools/Logs");

       // function in master2 layout
        var page_limit=show_per_page('','failedJobs_pageLength',10);  // Params (table,page,default_limit=10)
        var table=  $('#failedJobs').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [0] }
            ],
            "aaSorting": [[3, "desc"]],
             "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
        page_limit=show_per_page(table,'failedJobs_pageLength');
    });
</script>
@endsection

@section(decide_content())
<div class="row" data-name="jcTWEokT">
    <div class="col-md-12" data-name="vnmRZjYQ">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="hMmQYBFH">
            <div class="kt-portlet__body" data-name="YTEuuEvW">
                <table class="table table-striped table-hover table-checkable responsive" id="failedJobs" role="grid" >
                    <thead>
                        <tr role="row">
                            <th>@lang('logs.jobs.page.connection')</th>
                            <th>@lang('logs.jobs.page.queue')</th>
                            <th>@lang('logs.jobs.page.exception')</th>
                            <th>@lang('logs.jobs.page.failed_at')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($failedJobs as $index => $activity)
                            <tr class="gradeX odd" role="row">
                                <td>{{ $activity->connection }}</td>
                                <td>{{ $activity->queue }}</td>
                                <td>{{ucfirst($activity->exception)}}</td>
                                <td>{{showDateTime(Auth::user()->id, $activity->failed_at , 1)}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection