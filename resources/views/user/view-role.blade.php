@extends('layouts.master')

@section('title', trans('app.user_management.roles.view_all.title'))

@section('page_styles')
@endsection

@section('page_scripts')
<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('#subUserRole').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [1,3] }
            ]
        });
    });

    function roleDelete(id)
    {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/subuser-role/'+id,
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
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="BuQSVDTo">
    <ul class="page-breadcrumb">
        <li>
            <span>
                {{trans('users.create_package_blade.client_management_span')}}
            </span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>
                {{trans('users.view_role_blade.view_client_role_group')}}
            </span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('users.view_role_blade.view_client_role_group')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="GSYphpKH">
    <p>
        {{getHeading(trans('app.headings.user_management.roles.view'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="BAPACaXf">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="LjfbRQNN">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="nefyfish">
    <div class="col-md-12" data-name="oCqCVMoh">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="wSVOyUeU">
            <div class="portlet-body" data-name="CjKWdfhD">
                <div class="table-toolbar" data-name="MWymxKKW">
                    <div class="row" data-name="NxbtKJOS">
                        <div class="col-md-6" data-name="VhgWFxlF">
                           @if(rolePermission(237))
                            <div class="btn-group" data-name="hVmgCMzf">
                                <a href="{{ route('role.create') }}">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    {{trans('users.view_role_blade.create_client_role_button')}} <i class="fa fa-plus"></i>
                                </button></a>
                            </div>
                           @endif
                        </div>
                    </div>
                </div>
                <div class="dataTables_wrapper no-footer" data-name="FLWoFoIF">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="subUserRole" role="grid" >
                        <thead>
                            <tr role="row">
                            <th style="display:none"></th>
                                <th>{{trans('app.user_management.roles.view_all.table_headings.sr')}}</th>
                                <th>{{trans('app.user_management.roles.view_all.table_headings.group_name')}}</th>
                                <th>{{trans('app.user_management.roles.view_all.table_headings.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $index => $role)
                            <tr class="gradeX odd" role="row" id="row_{{ $role->id }}">
                            <td style="display:none"></td>
                                <td>{{$index + 1}}</td>
                                <td>{{ ($role->name)}} </td>
                                <td>
                                <div class="btn-group" data-name="VifooIoX">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        {{trans('app.user_management.roles.view_all.buttons.actions')}} <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                       @if(rolePermission(239))
                                          <li> 
                                            <a href="{{ route('subuser-role.edit', $role->id) }}"> <i class="glyphicon glyphicon-edit"></i>{{trans('app.user_management.roles.view_all.buttons.edit')}}</a>
                                        </li>
                                       @endif
                                       @if(rolePermission(240))
                                        <li>
                                            <a href="javascript:;" onclick="roleDelete( {{ $role->id }} )" id='role-delete'> <i class="glyphicon glyphicon-remove"></i>{{trans('app.user_management.roles.view_all.buttons.delete')}} </a>
                                        </li>
                                       @endif
                                    </ul>
                                </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection