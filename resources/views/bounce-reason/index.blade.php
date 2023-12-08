@extends('layouts.master2')

@section('title', trans('app.sidebar.bounce.rules'))

@section('page_styles')
<style type="text/css">
    .dropdown-backdrop {
        position: relative;
    }    
    table.dataTable thead > tr> th:nth-child(4), table.dataTable tbody > tr> td:nth-child(4) {
        max-width: 500px;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        // function in master2 layout
        var page_limit=show_per_page('','bounce_reasons_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#bounce_reasons').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,7]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getBounceReasons') }}",
            "pageLength" : page_limit,
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        page_limit=show_per_page(table,'bounce_reasons_pageLength');
    });

    function bouncereasonDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/bounce-rules/'+id,
                    type: "DELETE",
                    success: function(result) {
                    if(result == 'delete') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success ');
                    }
                }
                });
            }
    }
</script>
@endsection

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="ZwUHHnCP">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="orApBdvM">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="OdAnJphg">
    <div class="col-md-12" data-name="IcrrvMwb">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="zlwhOCed">
            <div class="kt-portlet__body" data-name="wukMttgd">
                <div class="table-toolbar" data-name="TzIEIYky">
                    <div class="form-group row" data-name="hWgmQsXw">
                        <div class="col-md-6" data-name="GeHnbKHF">
                           @if(rolePermission(115)|| rolePermission(29))
                            <div class="btn-group" data-name="BLcGVYgs">
                                <a href="{{ route('bounce-rules.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                        </div>
                    </div> 
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="bounce_reasons" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('app.setup.rules.name')}}</th>
                                <th>{{trans('app.dashboard.lang.code')}}</th>
                                <th>{{trans('app.dashboard.lang.reason')}}</th>
                                <th>{{trans('app.dashboard.lang.type')}}</th>
                                <th>{{trans('app.dashboard.lang.status')}}</th>
                                <th>{{trans('app.dashboard.lang.added_on')}}</th>
                                <th>{{trans('app.dashboard.lang.actions')}}</th>
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