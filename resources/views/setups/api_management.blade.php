@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<!-- <link href="/public/assets/vendors/general/sweetalert2/dist/sweetalert2.css?v={{$local_version}}" rel="stylesheet" type="text/css" /> -->
<link rel="stylesheet" type="text/css" href="/resources/assets/css/api-management.css?v={{$local_version}}.03">
<style>
    #apikey, #apirole {
        z-index:9999;
    }
</style>
@endsection
@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<!--<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>-->
@endif
@if (Session::has('error-msg'))
    <div class="alert alert-danger" data-name="LMoxgReI">
        {{ Session::get('error-msg') }}
    </div>
@endif
<div id="msg" class="display-hide" data-name="MHEAkHbX">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div id="msg-del" class="display-hide" data-name="aIpvmcyj">
    <button class="close" data-close="alert"></button>
    <span id='del-msg-text'><span>
</div>

<div class="kt-portlet kt-portlet--height-fluid" data-name="qGwwqpNX">
    <div class="kt-portlet__body" data-name="JmXqKQpG">
        <div class="tabbable tabbable-tabdrop" data-name="VurHJbDn">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#tab1" class="nav-link active" data-toggle="tab">@lang("settings.api.step1.title")</a>
                </li>
                @if(!$client)
                <li class="nav-item">
                    <a href="#tab2" class="nav-link" data-toggle="tab">@lang("settings.api.step2.title")</a>
                </li>
                @endif
            </ul>
            <div class="tab-content" data-name="xiIWuzDZ">
                <div class="tab-pane active" id="tab1" data-name="qGRevaVs">
                	<div class="table-toolbar" data-name="ivQLHySW">
	                    <div class="form-group row" data-name="zUiLNjeL">
	                        <div class="col-md-12" data-name="PkzBMVkI">
	                            <button class="btn btn-label-success" onclick="loadTokenModal(0,{{$client==true?1:0}},0)">
	                                <i class="la la-plus"></i> {{trans('settings.api.step1.form.generate_new')}}
	                            </button>
	                        </div>
	                    </div>
	                </div>
                    <div class="table-scrollable">
                        <table class="table table-striped table-hover table-checkable" id="api-token">
                            <thead>
                                <tr>
                                    <th>@lang("settings.api.step1.column.api_token")</th>
                                    <th>@lang("settings.api.step1.column.description")</th>
                                    <th>@lang("settings.api.step1.column.token_name")</th>
                                    <th>@lang("settings.api.step1.column.user")</th>
                                    <th>@lang("settings.api.step1.column.ip_ddresses")</th>
                                    <th>@lang("settings.api.step1.column.last_access")</th>
                                    <th>@lang("settings.api.step1.column.status")</th>
                                    <th>@lang("settings.api.step1.column.action")</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($tokens as $token)
                                <tr>
                                    <td>{{$token->api_token}}</td>
                                    <td>{{$token->name}}</td>
                                    <td>{{$token->role_name}}</td>
                                    <td>{{$user->name}} ({{$user->email}})</td>
                                    <td>{{$token->auth_ips}}</td>
                                    <td>{{$token->last_access==null?'Never':showDateTime($user->id,$token->last_access)}}</td>
                                    <td>
                                        <div class="input-icon dis-dang" data-name="WkYqZIqX">
                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                <label>
                                                    <input id="api_status_{{$token->id}}" {{$token->status==1?'checked':''}} id="api_status" type="checkbox" onchange="changeStatus({{$token->id}},{{$token->status==1?0:1}})" name="api_status">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:;" onclick="loadTokenModal({{$token->id}},{{$client==true?1:0}},{{$token->role_id}})" class="text-info edit"><i class="fa fa-edit"></i></a>
                                        <a data="{{$token->id}}" id="delete_token_{{$token->id}}" href="#deleteKey" data-toggle="modal" class="text-danger delete"><i class="fa fa-trash"></i></a>
                                        
                                    </td>
                                </tr>
                            @endforeach
                        
                            
                            </tbody>
                        </table>
                    </div>
                </div>
                @if(!$client)
                <div class="tab-pane" id="tab2" data-name="zSburMTC">
                	<div class="table-toolbar" data-name="nEXvZCId">
	                    <div class="form-group row" data-name="QlQHbVJM">
	                        <div class="col-md-12" data-name="Mluvptyw">
	                            <button class="btn btn-label-success" data-toggle="modal" onclick="loadPermission(0)">
	                                <i class="la la-plus"></i> @lang("settings.api.step2.form.create_new")
	                            </button>
	                        </div>
	                    </div>
	                </div>
                    
                    <table class="table table-striped table-hover table-checkable responsive table-roles">
                		<thead>
                			<tr>
                				<th width="40%">@lang("settings.api.step2.column.role_name")</th>
                				<th width="50%">@lang("settings.api.step2.column.description")</th>
                				<th width="10%">@lang("settings.api.step2.column.action")</th>
                			</tr>
                		</thead>
                		<tbody>
                		@foreach($roles as $role)
                			<tr>
                				<td colspan="3">
                					<div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6" data-name="ZLzNGhfA">
									    <div class="card" data-name="IWjiPPTk">
									        <div class="card-header" id="headingOne6{{$role->id}}" data-name="TGTvrEuZ">
	                                            <table class="table table-striped table-responsive table-tabs">
	                                                <tbody><tr>
	                                                	<td width="40%">
	                                                		<div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6{{$role->id}}" aria-expanded="false" aria-controls="collapseOne6{{$role->id}}" data-name="ChwdxTTk">
												                {{$role->name}}
												            </div>
	                                                	</td>
	                                                	<td width="50%">{{$role->description}}</td>
	                                                	<td width="10%">
	                                                		<a onclick="loadPermission({{$role->id}})" href="javascript:;" data-toggle="modal" class="text-info edit"><i class="fa fa-edit"></i></a>
					                						<a data="{{$role->id}}" id="delete_role_{{$role->id}}" href="#deleteRole" data-toggle="modal" class="text-danger delete"><i class="fa fa-trash"></i></a>
	                                                	</td></tr>
	                                                </tbody>
	                                            </table>
	                                        </div>
	                                        <div id="collapseOne6{{$role->id}}" class="collapse" aria-labelledby="headingOne6{{$role->id}}" data-parent="#accordionExample6" style="" data-name="oUiBysjz">
									            <div class="card-body" data-name="ykarAmOQ">
									                <div class="apiroleBlk" data-name="vebxWtEP">
	                                                	<h4><a href="javascript:;">@lang("settings.api.step2.form.allowes_api_actions")</a></h4>
	                                                	<div class="apiMain" data-name="nzOmuloD">
	                                                		<div class="allowedApi" data-name="xMfDULdT">
	                                                			<a href="javascript:;"><i class="fa fa-circle"></i> @lang("settings.api.step2.form.add_client")</a>
	                                                		</div>
	                                                	</div>
	                                                </div>
									            </div>
									        </div>
	                                    </div>
	                                </div>
                				</td>
                			</tr>
        			@endforeach
                		</tbody>
                	</table>
                    
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
    


<!--begin::Modal-->
<div class="modal fade" id="apikey" tabindex="-1" role="dialog" data-keyboard="false" aria-hidden="true" data-backdrop="static" data-name="MCLilgsF">
    <div class="modal-dialog" role="document" data-name="dRFualwX">
        <div class="modal-content" id="modal_content_api" data-name="bzNlfyKG">
            
       
        </div>
    </div>
</div>
<div class="modal fade" id="apirole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="gAlOKmDt">
    <div class="modal-dialog modal-lg" role="document" data-name="lUiQkFhk">
        <div class="modal-content" id="modal_content" data-name="hWudOiWi">
   
        </div>
    </div>
</div>
<!--end::Modal-->


<button id="api_role" style="display: none;" class="btn btn-label-success" data-toggle="modal" data-target="#apirole">
			                                <i class="la la-plus"></i> {{trans('settings.api.step1.form.api_role')}}
			                            </button>
			                            
<button id="api_token" style="display: none;" class="btn btn-label-success" data-toggle="modal" data-target="#apikey">
			                                <i class="la la-plus"></i> {{trans('settings.api.step1.form.generate_new')}}
			                            </button>
@endsection
@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/sweetalert2.min.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/validate-form.js" type="text/javascript"></script>
<script>
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Settings/Api-Key");

    	$(document).on('click','a.listTab', function(){
		   var target = $(this).attr('rel');
		   $("#"+target).show().siblings("div").hide();
		});

    	$("#checkAll").click(function(){
			if($("#checkAll").attr("data-type")==="check")
	        {
	            $(".addons").prop("checked",true); 
				$("#checkAll").attr("data-type","uncheck");			
				$(this).val("Checked");	
				$(this).addClass("btn-success");
				$(this).removeClass("btn-default");	
				$(this).removeClass("btn-warning");	
				$(this).focusout();
	        }
	        else
	        {
	            $(".").prop("checked",false);
			    $("#checkAll").attr("data-type","check");	
			    $(this).val("Unhecked");	
			    $(this).addClass("btn-warning");
				$(this).removeClass("btn-default");	
				$(this).removeClass("btn-success");	
				$(this).focusout();
	        }
		}); 

		$("#checkAll2").click(function(){
			if($("#checkAll2").attr("data-type")==="check")
	        {
	            $(".affiliates").prop("checked",true); 
				$("#checkAll2").attr("data-type","uncheck");			
				$(this).val("Checked");	
				$(this).addClass("btn-success");
				$(this).removeClass("btn-default");	
				$(this).removeClass("btn-warning");	
				$(this).focusout();
	        }
	        else
	        {
	            $(".affiliates").prop("checked",false);
			    $("#checkAll2").attr("data-type","check");	
			    $(this).val("Unhecked");	
			    $(this).addClass("btn-warning");
				$(this).removeClass("btn-default");	
				$(this).removeClass("btn-success");	
				$(this).focusout();
	        }
		});

    	$("#createtoken").validate({
            ignore: [],       
            rules: {
                description: {
                    required: !0
                },
                select_role: {
                    required: !0
                },
                ip_address: {
                    required: !0
                }
            },
                invalidHandler: function(event, validator) {
                    Command: toastr["error"] ("@lang('common.message.form_error')"); 
                },
                submitHandler: function(e) {
                    $(".blockUI").show();
                    setTimeout(function() {
                        $(".blockUI").hide();
                        Command: toastr["success"] ("@lang('settings.message.credential_successfully_created')");
                        return false;
                    }, 2000);
                    setTimeout(function() {
                        $("#apikey").modal("hide");
                    },3500);
                }
        });

    	$("#createap").validate({
            ignore: [],       
            rules: {
                roll_name: {
                    required: !0
                }
            },
                invalidHandler: function(event, validator) {
                    Command: toastr["error"] ("@lang('common.message.form_error')"); 
                },
                submitHandler: function(e) {
                    $(".blockUI").show();
                    setTimeout(function() {
                        $(".blockUI").hide();
                        Command: toastr["success"] ("@lang('settings.message.role_successfully_created')");
                        return false;
                    }, 2000);
                    setTimeout(function() {
                        $("#apikey").modal("hide");
                    },3500);
                }
        });

        $('.m-select2').select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });

        objTable = $('#api-token').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,4]}],
            "bProcessing": true,
            //"bServerSide": true,
            "aaSorting": [[0, "desc"]],
            "sPaginationType": "full_numbers",
            //"pageLength" : page_limit,
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });

    });
</script>
<script type="text/javascript">
	"use strict";
    // Set defaults
    swal.mixin({
        width: 400,
        heightAuto: false,
        padding: '2.5rem',
        buttonsStyling: false,
        confirmButtonClass: 'btn btn-success',
        confirmButtonColor: null,
        cancelButtonClass: 'btn btn-secondary',
        cancelButtonColor: null
    });
    "use strict";
    // Class definition
    var KTSweetAlert2Demo = function() {

        // Demos
        var initDemos = function() {
            $('.delete').click(function(e) {
                var id = this.id;
                var route = '{{route('deleteRole')}}';
                if (id.indexOf("delete_token_") >= 0)
               	 route = '{{route('deleteToken')}}';
                
               var data =$('#'+id).attr('data');
            
                swal.fire({
                    title: '@lang("common.message.are_you_sure")',
                    text: "@lang('common.message.cannot_revert')",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: '@lang('common.form.buttons.yes'), @lang('common.form.buttons.delete')'
                }).then(function(result) {
                    if (result.value) {
                  
                   	 $.ajax({
                         type: 'POST',
                         url: route,
                         data: {'id' : data},
                         cache: false,
                         dataType: 'json',
                         beforeSend: function() {
                             //$('.blockUI').show();
                             $('.form-control').removeClass('is-invalid');
                             $('.error').css('display','none');
                         },
                         success: function (data) {
                             $('.blockUI').hide();
                             if (data.status==true) {
                             	 swal.fire(
                                         'Deleted!',
                                         '@lang("common.message.delete")',
                                         'success'
                                     );
                             	 setTimeout(function () {
                                     window.location.reload();
                                 }, 500);
                             }
                             else {
                                 toastr.error(data.message);
                             }
                             return false;
                         }
                     }); 
                        
                    }
                });
            });
        };

        return {
            // Init
            init: function() {
                initDemos();
            },
        };
    }();

    // Class Initialization
    jQuery(document).ready(function() {
        KTSweetAlert2Demo.init();
    });

    $(document).on('click','.select_all',function(e){
       var id = this.id;
        var val = $('#'+id).val();
        if(val == 'Check All'){
            $('.'+id).prop('checked',true);
            $('#'+id).val('Uncheck All');
			$('#'+id).addClass("btn-warning");
			$('#'+id).removeClass("btn-default");	
			$('#'+id).removeClass("btn-success");
        }
        else {
        	$('.'+id).prop('checked',false);
            $('#'+id).val('Check All');
            $('#'+id).addClass("btn-success");
			$('#'+id).removeClass("btn-default");	
			$('#'+id).removeClass("btn-warning");	
        }
	    });
    $(document).ready(function(){
    	$(document).on('change','#api_access_switch',function(e){
    		if($(this).is(':checked')){
    			$('#allowed_ip_addresses').css('display','flex');
    		}else{
    			$('#allowed_ip_addresses').css('display','none');
    			$('#api_access_ips').val('');
    		}
    	});
    	$(document).on('click','.save_role',function(e){
       	 e.preventDefault();
        	var role_id = $('#role_id').val();
            	var method = 'POST';
            	var route = "{{route('api_management.store')}}";
            	var formId = '#createRole';
            	createOrUpdate(method,route,formId,e,1);
        	});
        });
    //createtoken
    $(document).ready(function(){
    	$(document).on('click','.save_token',function(e){
       	 e.preventDefault();
        	var role_id = $('#user').val();
            	var method = 'POST';
            	var route = "{{route('save_token')}}";
            	var formId = '#createtoken';
            	createOrUpdate(method,route,formId,e,1);
        	});
        });
    function loadPermission(role_id,token_id=0)
    {
        $.ajax({
            type: 'POST',
            url: '{{route('role_permissions')}}',
            data: {'role_id' : role_id,'token_id':token_id},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
                $('.form-control').removeClass('is-invalid');
                $('.error').css('display','none');
            },
            success: function (data) {
                $('.blockUI').hide();
                if (data.status==true) {
                   $('#modal_content').html(data.html);
                   $('#api_role').trigger('click');
                }
                else {
                   
                }
                return false;
            }
        }); 
    }
    function loadTokenModal(token_id,is_client,role_id)
    {
        if(is_client==1)
        	loadPermission(role_id,token_id);
        else
        $.ajax({
            type: 'POST',
            url: '{{route('load_users')}}',
            data: {'token_id' : token_id},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
                $('.form-control').removeClass('is-invalid');
                $('.error').css('display','none');
            },
            success: function (data) {
                $('.blockUI').hide();
                if (data.status==true) {
                   $('#modal_content_api').html(data.html);
                   $('#api_token').trigger('click');
                   $('#api_access_switch').change();
                }
                else {
                   
                }
                return false;
            }
        }); 
    }
    function changeStatus(id,status)
    {
        var id = id;
        var ids = {0:id};
  	  $.ajax({
          type: 'POST',
          url: '{{route('bulkUpdate')}}',
          data: {'ids' : ids,'model':'APIToken','column':'status','status':status},
          cache: false,
          dataType: 'json',
          beforeSend: function() {
              $('.blockUI').show();
              $('.form-control').removeClass('is-invalid');
              $('.error').css('display','none');
          },
          success: function (data) {
              $('.blockUI').hide();
              if (data.status==true) {
            	  toastr.success(data.message);
            	  setTimeout(function () {
                      window.location.reload();
                  }, 500);
              }
              else {
            	  toastr.error(data.message);
              }
              return false;
          }
      }); 
    }
/*    $(document).ready(function(){
        $(document).on('click','#sync_permission',function(e){
            $.ajax({
                type: 'POST',
                url: '#',
                data: {},
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('.blockUI').show();
                },
                success: function (data) {
                    $('.blockUI').hide();
                    if (data.status==true) {
                        toastr.success(data.message);
                    }
                    else {
                        toastr.error(data.message);
                    }
                    return false;
                }
            });
        });
    });*/
</script>
@endsection