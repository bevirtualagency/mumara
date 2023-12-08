@extends(decide_template())

@section('title', $pageTitle )

@section('page_styles')
<style type="text/css">
   .assign-option {
        margin-bottom: 15px;
    }
    #admins {
        margin-left: 25px;
    }
    #admins .ddset {
        max-width: 300px;
        margin-top: 0;
        margin-bottom: 10px;
    }
    #admins p {
        padding: 0 2px;
    }
    .text-muted {
        color: #74788d !important;
        font-size: 13px;
    }
    .kt-radio-list .kt-radio {
        font-weight: 500;
    }
    .modal-dialog-centered {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-align: center;
        -ms-flex-align: center;
        align-items: center;
        min-height: calc(100% - 1rem);
    }
    #deleted-text {
        margin-left: 30px;
        display: none;
    }  
    .semi-bold {
        font-weight: 600;
    }
    @media (min-width: 576px) {
        .modal-dialog-centered {
            min-height: calc(100% - 3.5rem);
        }
    }
    @media (min-width: 576px) {
        .modal-dialog {
            max-width: 630px;
            margin: 1.75rem auto;
        }
    }
    .select2-container--default .select2-results__option[aria-disabled=true] {
        display: none;
    }
    
    #users tr th, #users tr td {
        text-align: center !important;
        padding: 12px  !important;
    }
    #users tr th:nth-child(2), #users tr td:nth-child(2) {
        text-align: left !important;
        min-width: 130px;
        max-width: 300px;
        white-space: normal;
        word-break: break-all;
    }
    #users>tbody>tr>td:first-child, #users>thead>tr>th:first-child {
        max-width: 15% !important;
        text-align: left !important;
        width: 15% !important;
    }
    .dataTables_wrapper>.row:nth-child(2)>.col-sm-12 {
        overflow-x: scroll;
        overflow-x: overlay;
    }
    #users tr th:nth-child(3), #users tr td:nth-child(3),
    #users tr th:nth-child(4), #users tr td:nth-child(4) {
        white-space:nowrap;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {

        $('.m-select2').select2();
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Staff-Management#Administrators");

         // function in master2 layout
        var page_limit=show_per_page('','administrators_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#users').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [4]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "asc"]],
            "sPaginationType": "full_numbers",
             "sAjaxSource": "{{ url('/getStaff') }}",
            "pageLength" : page_limit,
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]],
            createdRow: function( row, data, dataIndex ) {
                $( row ).addClass(data['deleted']==1 ? "deleted":"");
            }
        });
        page_limit=show_per_page(table,'administrators_pageLength');
    });
 function retryOperation(id) {
            $('.blockUI').show();
            $.ajax({
                url: "{{ route('staff.retryOperation') }}",
                type: "POST",
                data :{ user_id:id },
                success: function(result) {
                     toastr.success('{{ trans("common.message.success_operation") }}');
                    $('.blockUI').hide();
                    window.location.reload();
                }
            });
    }
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
                    $('#msg').removeClass('display-hide').addClass('alert alert-success ');
                    $('.blockUI').hide();
                    window.location.reload();
                }
            });
            }
    }
     function userDelete(id,type='') {
         if(confirm('{{ trans("common.message.confirmation_alert")}}')){
            
            var delete_option=$('.delete_option:checked').val();
             var admin_id=$('#admin_id').val();
             if(delete_option=="assign_assets" && !admin_id){
                alert('Please select admin');
                return;
             }
            $("#row_"+id).attr("style", "display:none");
             $('.blockUI').show();
            $.ajax({
                url: "{{ url('/') }}"+'/staff/'+id,
                type: "DELETE",
                data :{ type:type ,admin_id:admin_id,delete_option:delete_option},
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
             var delete_option=$('.delete_option:checked').val();
             var admin_id=$('#admin_id').val();
             if(delete_option=="assign_assets" && !admin_id){
                alert('Please select admin');
                return;
             }
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/staff/"+users,
                data    : {ids: users,type:type,admin_id:admin_id,delete_option:delete_option},
                success: function(result) {
                     $('.blockUI').hide();
                    if(result == 'delete') {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        window.location.href = "{{ route('staff.index') }}";
                    }else{
                        toastr.error(result);
                    }
                }
            });
                
    }

    // Show user deleting modal
    function showDeleteModal(id=0,type='',delete_all='',name='') {
            $('span.semi-bold').text(name);
            if(type==''){
                $('#admin_id option').prop('disabled',false);
                $('#user_id').val(id);
                $('#admin_id option[value="'+id+'"]').prop('disabled',true);
                $('.m-select2').select2("destroy").select2();
                $('#admin_id').val('');
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
        $(document).on('change','.delete_option',function(){
            var option=$(this).val();
            if(option=="assign_assets"){
                $('#admins').slideDown();
                $("#deleted-text").slideUp();
            }else{
                $('#admins').slideUp();
                $("#deleted-text").slideDown();
            }
        });
       
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
<div class="alert alert-success" data-name="sAfjmflX">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="noLhVZmT">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="aNBPTMAA">
    <div class="col-md-12" data-name="JiYlXmIJ">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="hbsRTbQG">
            <div class="kt-portlet__body" data-name="JwlibVoG">
                <div class="table-toolbar" data-name="KOeXLGpg">
                    <div class="form-group row" data-name="GBlTyntS">
                        <div class="col-md-12" data-name="YtQwPsZp">
                            <div class="btn-group" data-name="mhYDHaeH">
                              @if(routeAccess('staff.create'))
                                <a href="{{ route('staff.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                              @endif
                            </div>
                                @if(routeAccess('staff.destroy'))
                            <div class="btn-group pull-right" data-name="cOsJGKZM">
                               <!--  <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('common.form.buttons.tools')}}
                                </button> -->
                                <!-- <ul class="dropdown-menu dropdown-menu-right">
                            
                                    <li>
                                        <a href="javascript:;" onclick="showDeleteModal(0,'',1)" class=""> <i class="la la-close"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                             
                                </ul> -->
                            </div>
                               @endif
                        </div>
                    </div>
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable " id="users" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>{{trans('staff.admin.table_headings.name')}}</th>
                                <th>{{trans('staff.admin.table_headings.email')}}</th>
                                <th>{{trans('staff.admin.table_headings.role')}}</th>
                                <th>{{trans('staff.admin.table_headings.added_on')}}</th>
                                <th>{{trans('staff.admin.table_headings.actions')}}</th>
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
<div id="soft_hard_delete_confirmation" class="modal" tabindex="-1" role="dialog" data-name="KouIWzqk">
  <div class="modal-dialog modal-dialog-centered" role="document" data-name="LGIHblZX">
    <div class="modal-content" data-name="ULuNtNDl">
      <div class="modal-header" data-name="OogqoVZT">
        <h5 class="modal-title"> {{trans('staff.modal.title')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" data-name="BtGPWDHh">
        
        <div class="kt-radio-list assign-option" data-name="EOXPVxgm">
            <label class="kt-radio">
                <input type="radio" checked name="delete_option" value="assign_assets" class="delete_option"> @lang('staff.assign_assets')
                <span></span>
            </label>
        </div>

        <div id="admins" data-name="adOnxzTf">
            @php
                $admins=App\User::where('is_staff',1)->orderBy('name','asc')->get();
            @endphp
            <div class="ddset" data-name="ceGaJPmi">
                <select name="admin_id" id="admin_id" class="form-control m-select2" data-placeholder="{{trans('staff.modal.select_admin')}}">
                    <option value="">{{trans('staff.modal.select_admin')}}</option>
                    @foreach( $admins as $admin)
                        <option value="{{$admin->id}}">{{$admin->name}}</option>
                    @endforeach
                </select>
            </div>
            <p class="text-muted">
                {{trans('staff.modal.delete_option_help1')}} <span class="semi-bold"></span> {{trans('staff.modal.delete_option_help2')}}<br />
                {{trans('staff.modal.delete_option_help3')}} <span class="semi-bold"></span>{{trans('staff.modal.delete_option_help4')}}
            </p>
        </div>

        <div class="kt-radio-list delete-option" data-name="objZAlzY">
            <label class="kt-radio">
                <input type="radio" name="delete_option" value="delete_assets" class="delete_option"> @lang('staff.delete_assets')
                <span></span>
            </label>
            <p class="text-muted" id="deleted-text">
                {{trans('staff.modal.assign_option_help1')}}
            </p>
        </div>
        <input type="hidden" name="delete_all" id="delete_all" value="">
        <input type="hidden" name="user_id" id="user_id" value="">
      </div>
      <div class="modal-footer" data-name="AhFSMUdY">
        <!-- <button type="button" onclick="showDeleteModal(0,2)" class="btn btn-info">{{trans('lists.contact_lists.modal.soft_delete')}}</button> -->
        <!-- <button type="button" onclick="showDeleteModal(0,3)" class="btn btn-danger">{{trans('lists.contact_lists.modal.hard_delete')}}</button> -->
        <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
        <button type="button" onclick="showDeleteModal(0,3)" class="btn btn-danger">{{trans('common.form.buttons.delete')}}</button>
      </div>
    </div>
  </div>
</div>
<!-- delete confirmation modal -->
@endsection