@extends('layouts.master')

@section('title', trans('View Clients'))

@section('page_styles')
@endsection

@section('page_scripts')
<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/User-Management/Users");

        $('#users').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,5]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getUsers') }}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    });

    function userDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/user/'+id,
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
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var users = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/user/"+users,
                data    : {ids: users},
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{ url('/') }}"+"/user";
                    }
                }
            });
        }
    }
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="OSzOrFSg">
    <ul class="page-breadcrumb">
        <li>
            <span>
                {{trans('users.create_package_blade.client_management_span')}}
            </span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>
                {{trans('users.index_blade.view_clients_span')}}
            </span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('users.index_blade.view_all_clients_heading')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="SMofeCaS">
    <p>
        {{getHeading(trans('app.headings.user_management.view'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="GefDXhhP">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="jWasezIg">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="owcEGIlX">
    <div class="col-md-12" data-name="MAamsEHb">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="oqTjnFmt">
            <div class="portlet-body" data-name="bErRqQKN">
                <div class="table-toolbar" data-name="ydpiKBhH">
                    <div class="row" data-name="qjgTJKJJ">
                        <div class="col-md-6" data-name="igxDQLta">
                            <div class="btn-group" data-name="tMOFAKXZ">
                              @if(rolePermission(229))
                                <a href="{{ route('user.create') }}">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    {{trans('users.index_blade.add_client_button')}} <i class="fa fa-plus"></i>
                                </button></a>
                              @endif
                            </div>
                        </div>
                        <div class="col-md-6" data-name="vUPvsYRd">
                            <div class="btn-group pull-right" data-name="NybmerQh">
                                <button class="btn green  btn-outline dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }} <i class="fa fa-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu pull-right">
                                 @if(rolePermission(234))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();"> <i class="glyphicon glyphicon-remove"></i> {{trans('app.user_management.view_all.buttons.tools_delete')}}  </a>
                                    </li>
                                 @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dataTables_wrapper no-footer" data-name="vJTkwtPL">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="users" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="mt-checkbox mt-checkbox-single mt-checkbox-outline">
                                        <input type="checkbox" class="checkbox checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('app.user_management.view_all.table_headings.name')}}</th>
                                <th>{{trans('app.user_management.view_all.table_headings.email')}}</th>
                                <th>{{trans('users.index_blade.package_txt_th')}}</th>
                                <th>{{trans('app.user_management.view_all.table_headings.created_at')}}</th>
                                <th>{{trans('app.user_management.view_all.table_headings.actions')}}</th>
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