@extends('layouts.master')

@section('title', trans('app.user_management.package.view_all.title'))

@section('page_styles')
@endsection

@section('page_scripts')
<script src="/assets/global/scripts/datatable.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/table-datatables-managed.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/User-Management/Packages");

        $('#package').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [1,3] }
            ]
        });
    });

    function packageDelete(id)
    {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/role/package/delete/'+id,
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
<div class="page-bar" data-name="cDIdrCQR">
    <ul class="page-breadcrumb">
        <li>
            <span>
                {{trans('users.create_package_blade.client_management_span')}}
            </span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>
                {{trans('app.user_management.package.view_all.title')}}
            </span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.user_management.package.view_all.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="omLxrHFp">
    <p>
        {{getHeading(trans('app.headings.user_management.package.view'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="MFXCHXOw">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="rZCabVfc">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="wnXUIINb">
    <div class="col-md-12" data-name="eZNkOUbJ">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="portlet light bordered" data-name="zNpcsuEM">
            <div class="portlet-body" data-name="IGCnhIrs">
                <div class="table-toolbar" data-name="gEzeeHvA">
                    <div class="row" data-name="wICHpbSA">
                        <div class="col-md-6" data-name="SbXMdyGQ">
                           @if(rolePermission(176) || 1)
                            <div class="btn-group" data-name="JslGISgA">
                                <a href="{{ route('role.package.index') }}">
                                <button id="sample_editable_1_new" class="btn sbold green">
                                    {{trans('app.user_management.package.view_all.buttons.add_new_package')}} <i class="fa fa-plus"></i>
                                </button></a>
                            </div>
                           @endif
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer" id="package" role="grid" >
                        <thead>
                            <tr role="row">
                            <th style="display:none"></th>
                                <th>{{trans('app.user_management.package.view_all.table_headings.sr')}}</th>
                                <th>{{trans('users.view_pacage_blade.package_name_th')}} </th>
                                <th>{{trans('app.user_management.package.view_all.table_headings.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($packages as $index => $package)
                            <tr class="gradeX odd" role="row" id="row_{{ $package->id }}">
                            <td style="display:none"></td>
                                <td>{{$index + 1}}</td>
                                <td>{{ ($package->package_name)}} </td>
                                <td>
                                <div class="btn-group" data-name="HilXqzLL">
                                    <button class="btn btn-xs green dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                                        {{trans('app.user_management.package.view_all.buttons.actions')}} <i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                       @if(rolePermission(245))
                                          <li> 
                                            <a href="{{ route('role.package.edit', $package->id) }}"> <i class="glyphicon glyphicon-edit"></i>{{trans('app.user_management.package.view_all.buttons.edit')}}</a>
                                        </li>
                                       @endif
                                       @if(rolePermission(246))
                                        <li>
                                            <a href="javascript:;" onclick="packageDelete( {{ $package->id }} )" id='role-delete'> <i class="glyphicon glyphicon-remove"></i>{{trans('app.user_management.package.view_all.buttons.delete')}} </a>
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