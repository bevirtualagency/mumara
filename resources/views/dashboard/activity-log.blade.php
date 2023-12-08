@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/activity-logs.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.4/moment.min.js" type="text/javascript"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.25/sorting/datetime-moment.js" type="text/javascript"></script>

<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Tools/Logs");

       // function in master2 layout
       $.fn.dataTable.moment( 'MMM D, YYYY hh:mm:ss A' );
        var page_limit=show_per_page('','activityLog_pageLength',10);  // Params (table,page,default_limit=10)
        var table=  $('#custom-fields').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [0,1,2] }
            ],
            // "aaSorting": [[4, "desc"]],
             "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
        page_limit=show_per_page(table,'activityLog_pageLength');
    });
</script>
@endsection

@section(decide_content())

<div class="row" data-name="oVUIhslV">
    <div class="col-md-12" data-name="POXFMWbA">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="CmJSnlkq">
            <div class="kt-portlet__body" data-name="gcjrgyqn">
                <table class="table table-striped table-hover table-checkable responsive" id="custom-fields" role="grid" >
                    <thead>
                        <tr role="row">
                            <th>{{trans('logs.table.column.id')}}</th>
                            <th>{{trans('logs.table.column.name')}}</th>
                            <th>{{trans('logs.table.column.activity')}}</th>
                            <th>{{trans('logs.table.column.description')}}</th>
                            <th>{{trans('logs.table.column.creation_date')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activity_logs as $index => $activity)
                            <tr class="gradeX odd" role="row">
                                <td class="sorting_1"> {{ $index + 1 }} </td>
                                <td>{{ $activity->name }}</td>
                                <td>{{ $activity->activity }}</td>
                                <td>{!! ucfirst($activity->description) !!}</td>
                                <td>{{showDateTime(Auth::user()->id, $activity->created_at , 1)}}</td>
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