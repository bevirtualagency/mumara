@extends('layouts.master2')

@section('title', $pageTitle )

@section('page_styles')
<link href="/resources/assets/css/trigger-drip-statistics-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).on("load", function() {
        $(".tooltips").tooltip();
    });
    $(document).ready(function() {
        $('body').tooltip({
            selector: '[data-toggle=tooltip]'
        });
        $('#statistics').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,4,5,6,7,8], "className": "dt-center"}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/statistics/getTriggerDrips/'.$triggerId.'/'.$dripId) }}",
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
    });
</script>
@endsection

@section('content')

<!-- will be used to show any messages -->
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="ATdCcNXt">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if (Session::has('msg'))
<div class="alert alert-success" data-name="XpnIGwuE">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="JtXgZMly">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="GokvAUit">
    <div class="col-md-12" data-name="HNOkJWyy">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="VbCPIgoO">
            <div class="kt-portlet__body" data-name="nIQWebem">
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="statistics" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('statistics.detail.id')}}</th>
                                <th>{{trans('statistics.drip.column.name')}}</th>
                                <th>{{trans('statistics.drip.column.interval')}}</th>
                                <th>{{trans('statistics.drip.column.last_activity')}}</th>
                                <th>{{trans('common.stats.sent')}}</th>
                                <th>{{trans('common.stats.opened')}}</th>
                                <th>{{trans('common.stats.clicked')}}</th>

                                <th>{{trans('common.stats.unsubscribed')}}</th>

                                <th>{{trans('statistics.drip.column.details')}}</th>
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