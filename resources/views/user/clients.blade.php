@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<style>
.mr-2 {
    margin-right: 5px;
}
#add_credits_model .modal-body {
    padding: 30px;
}
.form-group.row.mb0 {
    padding-left: 15px;
}
.table-relative {
    position: relative;
    display: block;
}
.climit {
    position: absolute;
    top: 0px;
    left: 190px;
    z-index: 1;
}
.climit button.btn.btn-label-warning {
    font-weight: 600;
    text-transform: uppercase;
    min-width: 60px !important;
    white-space: nowrap;
    color: #f8a800;
}
@media (max-width: 440px) {
	.climit {
		position: relative;
		width: 100%;
		display: block;
		left: 0;
		top: 0;
	}
}
#users tr th, #users tr td {
    text-align: center !important;
    padding: 12px 6px !important;
}
#users tr th:nth-child(2), #users tr td:nth-child(2) {
    text-align: left !important;
    min-width: 130px;
    max-width: 300px;
    white-space: normal;
    word-break: break-all;
}
#users tr th:nth-child(6), #users tr td:nth-child(6) {
    min-width: 120px;
}
/* .dataTables_wrapper>.row:nth-child(2)>.col-sm-12 {
    overflow-x: scroll;
    overflow-x: overlay;
} */
#users tr th:nth-child(3), #users tr td:nth-child(3),
#users tr th:nth-child(4), #users tr td:nth-child(4) {
    white-space:nowrap;
}
#users.collapsed tr td:first-child, 
#users.collapsed tr th:first-child {
    min-width: 20px;
    text-align: right !important;
    width: 20px !important;
    padding-right: 20px !important;
    padding-left: 30px !important;
}
table.dataTable>tbody>tr.child ul.dtr-details>li {
    display: flex;
}
.dataTables_wrapper .child .dtr-details>li .dtr-title {
    padding: 0.5rem 0.5rem 0;
    min-width: 120px;
    text-align: left;
}
#users.collapsed tr.child td.child {
    padding-left: 0 !important;
}
#users>tbody>tr>td:first-child, #users>thead>tr>th:first-child {
    max-width: 30px !important;
    text-align: center !important;
    width: 30px !important;
}
@media(max-width:360px) {
    table.dataTable>tbody>tr.child ul.dtr-details {
        overflow: auto;
    }
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/User-Management/Users");

        // function in master2 layout
        var page_limit=show_per_page('','all_users_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#users').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,6]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[5, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getClients') }}",
             "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]],
            createdRow: function( row, data, dataIndex ) {
                $( row ).addClass(data['deleted']==1 ? "deleted":"");
            }
        });
         page_limit=show_per_page(table,'all_users_pageLength');
    });

    function userStatus(id, status) {
        if(confirm('{{trans('users.message.user_status_update_alert')}}')) {
            $.ajax({
                url: "{{ url('/') }}"+'/userStatus',
                type: "PUT",
                data: {id: id, status: status},
                success: function(result) {
                    if(result == 'success') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('users.message.user_status_updated')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');

                        $('#users').DataTable().ajax.reload();
                    }
                }
            });
        }
    }
    function addCredits(id) {
        $("#credit_user_id").val(id);
        $("#add_credits_model").modal("show");
    }

    $("body").on("click" , "#AddCreditId" , function() { 
        if($("#user_credits").val() == "") {
            $("#user_credits").addClass("is-invalid");
            Command: toastr["error"] ("{{trans('users.clients_blade.form_errors_command')}}");
            return false;
        }
        else {
            $('.blockUI').show();
            $("#user_credits").removeClass("is-invalid");
            var form_data = {
                id:$("#credit_user_id").val(),
                credits:$("#user_credits").val()
            };
           // console.log(form_data);
            $.ajax({
                url: "{{ route('add_credits') }}",
                type: "POST",
                data :form_data,
                success: function(result) {
                    $('.blockUI').hide();
                    $('#users').DataTable().ajax.reload();
                    $("#add_credits_model").modal("hide");
                    $("#user_credits").val("");
                    $("#user_credits").removeClass("is-invalid");
                }
            });
        }
    });


  
    function restore(id) {
            if(confirm('{{ trans("common.message.confirmation_alert")}}')){
            $('.blockUI').show();
            $.ajax({
                url: "{{ route('restore_user') }}",
                type: "POST",
                data :{ id:id },
                success: function(result) {
                    $('#msg').css("display", "flex");
                    $('#msg-text').html('{{trans('common.message.success_operation')}}');
                    $('#msg').removeClass('display-hide').addClass('alert alert-success');
                    $('.blockUI').hide();
                    window.location.reload();
                }
            });
            }
    }
    function userDelete(id,type='') {
            if(confirm('{{ trans("common.message.confirmation_alert")}}')){
            $("#row_"+id).attr("style", "display:none");
            $('.blockUI').show();
            $.ajax({
                url: "{{ url('/') }}"+'/user/'+id,
                type: "DELETE",
                data :{ type:type },
                success: function(result) {
                 if(result == 'delete') {
                    $('#msg').css("display", "flex");
                    $('#msg-text').html('{{trans('common.message.delete')}}');
                    $('#msg').removeClass('display-hide').addClass('alert alert-success');
                }else{
                        toastr.error(result);
                }
                 $('#soft_hard_delete_confirmation').modal('hide');
                 $('.blockUI').hide();
                }
            });
            }
    }
   
      function deleteAll (type='') {
            if(!$('input:checkbox:checked').length){
               alert('{{trans('common.message.alert_no_record')}}');
               return false;
            }
             $('.blockUI').show();
            $('#soft_hard_delete_confirmation').modal('hide');
            var users = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/user/"+users,
                data    : {ids: users,type:type},
                success: function(result) {
                     $('.blockUI').hide();
                    if(result == 'delete') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        window.location.reload();
                    }else{
                        toastr.error(result);
                    }
                }
            });
                
    }
        // Show user deleting modal
    function showDeleteModal(id=0,type='',delete_all='') {
        
            if(type==''){
                $('#user_id').val(id);
                $('#delete_all').val(delete_all);
                $('#soft_hard_delete_confirmation').modal('show');
                return false;
            }
             var delete_all=$('#delete_all').val();
              if(delete_all !=""){
                deleteAll (type);
            }else{
                var id=$('#user_id').val();
                userDelete(id,type)
            }
            $('#user_id').val('');
            $('#delete_all').val('');
        }
</script>
@endsection

@section(decide_content())
<style type="text/css">
    #users .deleted td, #users .deleted span {
    color: #999 !important;
}
</style>
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="DLPTdiBe">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="GMZJIhaB">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="qgjUZgMC">
    <div class="col-md-12" data-name="ifhswtxu">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="dXebkUVX">
            <div class="kt-portlet__body" data-name="LvTxZjEk">
                <div class="table-toolbar" data-name="zPjUnVjp">
                    <div class="form-group row" data-name="aaKphxff">
                        <div class="col-md-6" data-name="qtNvtNIZ">
                            <div class="btn-group" data-name="Rzwitnmn">
                              @if(rolePermission(229))
                                <a href="{{ route('user.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    {{trans('common.form.buttons.add_new')}} <i class="la la-plus"></i>
                                </button></a>
                              @endif
                            </div>
                        </div>
                        <div class="col-md-6" data-name="PLnKnWjX">
                            <div class="btn-group pull-right" data-name="kHIsshwr">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                 @if(rolePermission(234))
                                    <li>
                                        <a href="javascript:;" onclick="showDeleteModal(0,'',1);"class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                 @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                     $license_attributes = json_decode(getSetting("license_attributes"), true);
                     $license_type = "";
                     if(!empty($license_attributes["package"])) { 
                         $license_type = trim($license_attributes["package"]);
                     }
                ?>
                <div class="table-relative">
                    @if($total_users > 0 and $total_users < 10000)
                    <div class="climit" data-name="GeOBtTDs">
                        <button class="btn btn-label-warning btn-sm" id="contacts_limit">{{trans('users.clients_blade.users_limit_button')}}  {{$total_users}} / {{$users_limit}}</button>
                    </div>
                    @endif
                    <table class="table table-striped table-hover responsive table-checkable" id="users" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkbox checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('users.table_headings.name')}}</th>
                                <th>{{trans('users.table_headings.email')}}</th>
                                <th>{{trans('users.table_headings.package')}}</th>
                                <th>{{trans('users.table_headings.status')}}</th>
                                <th>{{trans('users.table_headings.added_on')}}</th>
                                @if($license_type == "Commercial ESP")
                                <th>{{trans('Credits')}}</th>
                                @endif
                                <th>{{trans('users.table_headings.actions')}}</th>
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
<!-- delete confirmation modal -->
<div id="soft_hard_delete_confirmation" class="modal" tabindex="-1" role="dialog" data-name="qCNHBotY">
  <div class="modal-dialog" role="document" data-name="aTEjopmq">
    <div class="modal-content" data-name="opHoZwIX">
      <div class="modal-header" data-name="IetlzhaY">
        <h5 class="modal-title"> {{trans('lists.contact_lists.modal.soft_or_hard_delete')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" data-name="wVDpOZpN">
        <p> {{trans('lists.contact_lists.modal.soft_or_hard_delete')}}?.</p>
        <p>@lang('staff.message.soft_delete')</p>
        <p>@lang('staff.message.hard_delete')</p>
      </div>
      <input type="hidden" name="delete_all" id="delete_all" value="">
      <input type="hidden" name="user_id" id="user_id" value="">
      <div class="modal-footer" data-name="zNnZsmTz">
        <button type="button" onclick="showDeleteModal(0,2)" class="btn btn-info">{{trans('lists.contact_lists.modal.soft_delete')}}</button>
        <button type="button" onclick="showDeleteModal(0,3)" class="btn btn-danger">{{trans('lists.contact_lists.modal.hard_delete')}}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
      </div>
    </div>
  </div>
</div>
<!-- delete confirmation modal -->

<!-- delete confirmation modal -->
<div id="add_credits_model" class="modal" tabindex="-1" role="dialog" data-name="SbPuVrnM">
  <div class="modal-dialog" role="document" data-name="BreClVoH">
    <div class="modal-content" data-name="kxciIgKi">
      <div class="modal-header" data-name="ricCmVAl">
        <h5 class="modal-title"> {{trans('users.clients_blade.add_credits_heading')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" data-name="aLNwdRRc">
            <div class="form-group row" data-name="ciDgVHls">
                <label class="col-form-label col-md-3">{{trans('users.clients_blade.add_credit_label')}}</label>
                <div class="col-md-7" data-name="CbYkFeaU">
                    <input type="number" name="user_credits" id="user_credits" value="" class="form-control" />
                    <input type="hidden" name="credit_user_id" id="credit_user_id" value="">
                </div>
            </div>
            <div class="form-group row mb0" data-name="KOCrWRhN">
                <button type="button" id="AddCreditId"  class="btn btn-success btn-sm offset-md-3 mr-2">{{trans('users.controller.action_credits_add')}}</button>
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
            </div>
      </div>
    </div>
  </div>
</div>

@endsection