@extends('layouts.master2')

@section('title', $pageTitle)

@section('page_styles')
@endsection

@section('page_scripts')
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            // function in master2 layout
            var page_limit=show_per_page('','fbl-processed_pageLength',10);  // Params (table,page,default_limit=10)
            var table=$('#fbl-processed').dataTable({
                "aoColumnDefs": [{"bSortable": false, "aTargets": [0,4]}],
                "bProcessing": true,
                "bServerSide": true,
                "aaSorting": [[1, "asc"]],
                "sPaginationType": "full_numbers",
                "sAjaxSource": "{{ route('getProcessedFbls',isset($id)?$id:'') }}",
                "pageLength" : page_limit,
                "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
            });
            page_limit=show_per_page(table,'fbl-processed_pageLength');
        });
    </script>
    @include('includes.view-pages-filter-script')
@endsection

@section('content')

    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="PqwiuPhJ">
            {{ Session::get('msg') }}
        </div>
    @endif
    <div id="msg" class="display-hide" data-name="ujlUDoQm">
        <button class="close" data-close="alert"></button>
        <span id='msg-text'></span>
    </div>
    <div class="row" data-name="vqRnEQVq">
        <div class="col-md-12" data-name="nWFmiOHy">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="kt-portlet kt-portlet--height-fluid" data-name="KiLXGsWG">
                <div class="kt-portlet__body" data-name="PpASQCfC">
                    <div class="table-toolbar" data-name="ZPZScfQu">
                        <div class="form-group row" data-name="jXZDqcuO">
                            <div class="col-md-12" data-name="MFQArKtK">
                            </div>
                        </div>
                    </div>
                    <table class="table table-striped table-hover table-checkable responsive" id="fbl-processed" role="grid" >
                        <thead>
                        <tr role="row">
                            <th>{{trans('fbl.th.sr')}}</th>
                            <th>{{trans('fbl.th.contact')}}</th>
                            <th>{{trans('fbl.th.abuser')}}</th>
                            <th>{{trans('fbl.th.user')}}</th>
                            <th>{{trans('fbl.th.broadcast')}}</th>
                            <th>{{trans('fbl.th.abused_at')}}</th>
                            <th>{{trans('fbl.th.message_id')}}</th>

                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection