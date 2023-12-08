@extends(decide_template())

@section('title', $tabTitle)

@section('page_styles')
<link href="/themes/default/css/datatables.bundle.css?v={{$local_version}}.01" rel="stylesheet" type="text/css" />
<link href="/themes/default/css/bootstrap-multiselect.css?v={{$local_version}}.01" rel="stylesheet" type="text/css" />
<style>
.dataTables_wrapper .dataTable tbody tr td a {
    cursor: pointer;
}
.dataTables_wrapper .dataTable tbody tr td, .table th {
    text-align: left !important;
}
#subscriber-data .form-group .control-label {
    white-space: normal;
    word-break: break-all;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() { 
        var segment_id = $("#segment-id").val();
        $('#subscribers-tbl-id').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url+"/segments/get-subscribers?id="+segment_id ,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
    });

    function deleteSubscriber(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/contact/'+id,
                type: "DELETE",
                success: function(result) {
                    if(result == 'delete') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success ');
                        $('#row_'+id).remove();
                    }
                }
            });
            }
    }
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var subscribers = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+'/contact/'+subscribers,
                data    : {ids: subscribers},
                success: function(result) {
                        window.location.reload();
                }
            });
        }
    }

    function getFormData(id , type , list_id)
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

    $(document).ready(function() {
        $('#modal-subscriber-details').on('hidden', function() {
    clear()
    });
});
</script>
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="XticLvgI">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="CCnvqbZF">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<input type="hidden" id="segment-id" value="{{ isset($id) ? $id : '' }}">
<div class="row" data-name="ORWLZFIP">
    <div class="col-md-12" data-name="srwAfIMq">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="jKHcKQjA">
            <div class="kt-portlet__body" data-name="hFtPNfIe">
                <div class="table-toolbar" data-name="CZMNhkrM">
                    <div class="form-group row" data-name="achkKKhY">
                        <div class="col-md-12" data-name="JRWPHRFY">
                            <div class="btn-group pull-right" data-name="DBquxTZe">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('segments.segment_subscribers.tools')}}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="la la-close"></i>  {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-checkable responsive" id="subscribers-tbl-id" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('segments.segment_subscribers.table_headings.id')}}</th>
                            <th>{{trans('segments.segment_subscribers.table_headings.email')}}</th>
                            @if($segment->segment_type==0)
                            <th>{{trans('lists.activity_title')}}</th>
                            @endif
                            <th>{{trans('segments.segment_subscribers.table_headings.bounced')}}</th>
                            <th>{{trans('segments.segment_subscribers.table_headings.unsubscribed')}}</th>
                            <th>{{trans('segments.segment_subscribers.table_headings.confirmed')}}</th>
                            <th>{{trans('segments.segment_subscribers.table_headings.created_date')}}</th>
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
<div id="modal-subscriber-details" class="modal" role="dialog" aria-hidden="true" data-name="SVJgkmCE">
    <div class="modal-dialog" style="width: 500px;" data-name="phCqGLJR">
        <div class="modal-content" data-name="cGdlEBgm">
            <div class="modal-header" data-name="IZPxpHfo">
                <h5 class="modal-title">{{trans('segments.segment_subscribers.modal.title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="hqrCpYSb">
                <form action="#" method="POST" class="kt-form kt-form--label-left">
                    <div class="subscriber-data" id="subscriber-data" data-name="HkdtGgQk"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection