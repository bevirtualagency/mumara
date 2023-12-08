@extends('layouts.master')

@section('title', trans('app.smtp_management.title'))

@section('page_styles')
<link href="/assets/global/plugins/datatables/datatables.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')

<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>

<script src="/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>

<script>
   $(document).ready(function() {
        $('#groups').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getGroupsSmtp') }}",
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
    }); 

    function deleteGroup(id) {
        // console.log(id);
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $.ajax({
                url: '/node/group/'+id,
                type: "DELETE",
                success: function(result) {
                    if(result == 'delete') {
                       // console.log(result);
                        $("#row_"+id).attr("style", "display:none");
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success ');
                    }else{
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.group_used_smtp')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-danger ');
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
        var campaigns = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type  : "Delete",
            url   : "{{ url('/') }}"+'/node/group/'+campaigns,
            data    : {ids: campaigns},
            success: function(result) {
                if(result == 'delete') {
                    window.location.href = "/node/groups";
                }else{
                    $('#msg').css("display", "flex");
                    $('#msg-text').html('{{trans('common.message.group_used_smtp')}}');
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');   
                }
            }
    });

        }
    }

    function editGroup(id)
    {
        $.ajax({
        url: "{{ url('/') }}"+'/node/group/'+id+'/edit',
        type: "GET",
        contentType: false,
        success: function (data) {
            $('#group-data').html(data);
            $("#modal-smtp-group-edit").modal('show');
            }
        });
    }

</script>

@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="ERhulKWr">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.smtp_management.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.smtp_management.view_groups.title')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.smtp_management.view_groups.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="wRhHaYoF">
    <p>
        {{getHeading(trans('app.headings.smtp_management.group'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="SOwRmFQg">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="qNQuujii">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="ariyUcSW">
    <div class="col-md-12" data-name="uZLHkhqM">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="mvfCEJOt">
            <div class="portlet-body" data-name="ccQeyQkL">
                <div class="table-toolbar" data-name="QwjFzzhs">
                    <div class="row" data-name="vbgGwOHO">
                        <div class="col-md-12" data-name="YwqKpuFl">
                            <div class="btn-group pull-right" data-name="dCZVaEOo">
                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">
                                    {{trans('app.smtp_management.view_all.buttons.tools')}} <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                @if (rolePermission(91))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();"> <i class="glyphicon glyphicon-remove"></i> {{trans('app.smtp_management.view_all.buttons.tools_delete')}}  </a>
                                    </li>
                                 @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dataTables_wrapper no-footer" data-name="FEisIOvO">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="groups" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('app.smtp_management.view_groups.table_headings.group')}}</th> 
                                <th>{{trans('app.smtp_management.view_groups.table_headings.created_on')}}</th>
                                <th>{{trans('app.smtp_management.view_groups.table_headings.actions')}}</th>
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
<div id="modal-smtp-group-edit" class="modal" role="dialog" aria-hidden="true" data-name="FNkBOaJR">
    <div class="modal-dialog" style="width: 500px;" data-name="WJgvyBRw">
        <div class="modal-content" data-name="xhhLFTDC">
            <div class="modal-header" data-name="CidffRTB">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{trans('app.smtp_management.view_groups.group_edit')}}</h4>
            </div>
            <div class="modal-body" data-name="liQsLeCM">
                <form action="{{ route('node.updated') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    
                    <div class="group-data" id="group-data" data-name="nXnwiQMh"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection