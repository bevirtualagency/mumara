@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<style>
#subUserRole tr th:first-child, #subUserRole tr td:first-child {
    padding: 10px 12px;
    text-align: center;
    max-width: 30px;
    width: 5%;
} 
#subUserRole tr th:nth-child(2), #subUserRole tr td:nth-child(2) {
    padding: 10px 12px;
    text-align: left;
    max-width: 400px;
    width: 40%;
} 
#subUserRole tr th:nth-child(3), #subUserRole tr td:nth-child(3) {
    padding: 10px 12px;
    text-align: left;
    max-width: 250px;
    width: 25%;
} 
#subUserRole tr th:last-child, #subUserRole tr td:last-child {
    padding: 10px 12px;
    text-align: center;
    max-width: 150px;
    width: 10%;
} 
.table>thead>tr>th:first-child, .table>tbody>tr>td:first-child {
    max-width: 40px;
    text-align: center;
    width: 4% !important;
}
#subUserRole tr th, #subUserRole tr td {
    text-align: center !important;
    padding: 12px 6px !important;
}
#subUserRole tr th:nth-child(2), #subUserRole tr td:nth-child(2) {
    text-align: left !important;
}
#deleteMe .alert-danger {
    padding-left: 44px !important;
}
#deleteMe .alert-danger {
    word-break: break-word !important;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/User-Management/User-Roles");

       // function in master2 layout
        var page_limit=show_per_page('','subUserRole_pageLength',10);  // Params (table,page,default_limit=10)
        var table= $('#subUserRole').DataTable({
            "columnDefs": [
                { "orderable": false, "targets": [0,1,2,3] }
            ],
            "aaSorting": [[2, "desc"]],
            "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
         page_limit=show_per_page(table,'subUserRole_pageLength');
    });

    function roleDelete(id)
    {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
           
                $.ajax({
                    url: "{{ url('/') }}"+'/subuser-role/'+id,
                    type: "DELETE",
                    success: function(result) {
                        if(result == 'delete') {
                            $("#row_"+id).attr("style", "display:none");
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.delete')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        } else { 
                            $("#itemToDelete").html('<b>Error:</b> Un-assign the packages from the associated assets and then delete it.');
                            $('#assignedAssets').html(result);
                            $("#deleteMe").modal('show');
                        }
                    }
                });
            }
    }
</script>
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="wNJGRidA">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="Jfnrekpo">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="TGfuULVo">
    <div class="col-md-12" data-name="bXBDAHPP">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="lIEXxHAQ">
            <div class="kt-portlet__body" data-name="XovhwHOa">
                <div class="table-toolbar" data-name="qbqCUyUH">
                    <div class="form-group row" data-name="yfeakuBj">
                        <div class="col-md-6" data-name="apcLBfKx">
                           @if(rolePermission(237))
                            <div class="btn-group" data-name="IbuPgfkY">
                                <a href="{{ route('package.role.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    {{trans('users.roles.create_user_role')}} <i class="la la-plus"></i>
                                </button></a>
                            </div>
                           @endif
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable responsive" id="subUserRole" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('users.roles.table_headings.id')}}</th>
                                <th>{{trans('users.roles.table_headings.role_name')}}</th>
                                <th>{{trans('users.roles.table_headings.added_on')}}</th>
                                <th>{{trans('users.roles.table_headings.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $index => $role)
                            <tr class="gradeX odd" role="row" id="row_{{ $role->id }}">
                                <td>{{($role->id)}}</td>
                                <td>{{ ($role->name)}} </td>
                                <td>{{ showDateTime(Auth::user()->id, $role->created_at , 1)}} </td>
                                <td>
                                <div class="dropdown" data-name="NQMOuRlL">
                                    <a class="btn btn-label-success btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-expanded="false"><i class="flaticon-more-1"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                       @if(rolePermission(239))
                                          <li> 
                                            <a href="{{ route('package.role.edit',  $role->id) }}"> <i class="fa fa-edit icon-size"></i>{{trans('common.form.buttons.edit')}}</a>
                                        </li>
                                       @endif
                                       @if(rolePermission(240))
                                        <li>
                                            <a href="javascript:;" onclick="roleDelete( {{ $role->id }} )" id='role-delete'> <i class="fa fa-remove icon-size"></i>{{trans('common.form.buttons.delete')}} </a>
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


<div id="deleteMe" class="modal deleteMe show" role="dialog" aria-hidden="true" data-keyboard="false" data-backdrop="static" data-name="dUYpphtk">
    <div class="modal-dialog modal-dialog-centered" style="width: 600px;" data-select2-id="13" data-name="GFioYzVb">
        <div class="modal-content" data-select2-id="12" data-name="JJWvkHWS">
            <div class="modal-header" data-name="hVxuPKRo">
                <h5 id="mdlTitle" class="modal-title"></h5>
            </div>
            <div class="modal-body" data-name="gbkdXWDM">
                <div class="row" data-name="JDrCwZwv">
                    <div class="col-md-12" data-name="TGaZsong">
                        <span class="alert alert-danger" ><span class="alert-text" id="itemToDelete"></span></span>
                    </div>
                </div>
                <div class="row" data-name="igUKVYRO">
                    <div class="col-md-12" data-name="jFQSGZuo">
                        <div id="domain-data" data-name="oyaHdXQR">
                            <div class="list-block" data-name="bDplkoVS">
                                <div id="assignedAssets" class="row list-scroll" data-name="BwVlKOtK">
                                    <div class="col-md-12" data-name="ZKtDemZp">
                                        <label class="col-form-label">{{trans('common.delete_assets_modal_blade.label_for_lists')}}</label>
                                        <ul class="no-list">
                                            <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> {{trans('common.delete_assets_modal_blade.action_contact_lists')}} 1</a></li>
                                            <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> {{trans('common.delete_assets_modal_blade.action_contact_lists')}} 2</a></li>
                                        </ul>
                                    </div>
                                </div>

                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" data-name="lCYRZcBU">
                <button type="button" class="btn btn-secondary btn-sm pull-left" data-dismiss="modal">{{trans('common.form.buttons.close')}}</button>
            </div>
        </div>
    </div>
</div>

@endsection