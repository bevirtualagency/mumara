@extends('layouts.master2')

@section('title', trans('app.sidebar.users'))

@section('page_styles')
<link href="/resources/assets/css/client-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/User-Management/Users");

        $('#users').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,6]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[5, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getClients') }}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    });

    function userStatus(id, status) {
        if(confirm('{{trans('app.users.alert_status_msg')}}')) {
            $.ajax({
                url: "{{ url('/') }}"+'/userStatus',
                type: "PUT",
                data: {id: id, status: status},
                success: function(result) {
                    if(result == 'success') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('app.alert_status_success')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');

                        $('#users').DataTable().ajax.reload();
                    }
                }
            });
        }
    }

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
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
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
                        window.location.href = "{{ url('/') }}"+"/clients";
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
<div class="alert alert-success" data-name="IPqhTbEq">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="tXRjZmNc">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="yLcmlTbG">
    <div class="col-md-12" data-name="dFgbweAf">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="IiclbYLc">
            <div class="kt-portlet__body" data-name="ObJUfEoO">
                <div class="table-toolbar" data-name="CCSFsqEe">
                    <div class="form-group row" data-name="PjRykvGM">
                        <div class="col-md-6" data-name="OJuWXefU">
                            <div class="btn-group" data-name="eYQdTlvR">
                              @if(rolePermission(229))
                                <a href="{{ route('user.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    {{trans('common.form.buttons.add_new')}} <i class="la la-plus"></i>
                                </button></a>
                              @endif
                            </div>
                        </div>
                        <div class="col-md-6" data-name="kZugaLnm">
                            <div class="btn-group pull-right" data-name="gOxPzZJD">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }} 
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                 @if(rolePermission(234))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();"class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                 @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="users" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkbox checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('app.dashboard.lang.name')}}</th>
                                <th>{{trans('common.label.email')}}</th>
                                <th>{{trans('app.dashboard.lang.package')}}</th>
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