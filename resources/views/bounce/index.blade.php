@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/bounce-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    function getLists(id)
    {
        record_type = $("input[name='list_type']:checked").val();
        $('#bounce_id').val(id);
        $.ajax({
            type    : "post",
            url: "{{ route('getBounceAccounts') }}",
            data    : {"bounce_id": id,'record_type':record_type},
            dataType: "json",
            success: function(result) {
                if(result.message==undefined) {
                    $('#bounce_account').html(result.options);
                    $('#bounceAssets').html(result.data);
                    $('#assignAssets').modal('show');
                }
                else
                {
                    Command: toastr["success"] (result.message);
                    objTable.draw();
                }
            }
        });

    }

    $("#closeMdl").click(function() {
        $("#bounce-change-blk").removeClass("berror");
        $("#bounce-error").hide();
    });

    $("#bounce_account").on("change",function() {
        $("#bounce-change-blk").removeClass("berror");
        $("#bounce-error").hide();
    });

    $('#attachToList').on('click',function ()
    {

        if ($("#bounce_account").val() === ""){
            $("#bounce-change-blk").addClass("berror");
            $("#bounce-error").show();
        } else {
            $("#bounce-change-blk").removeClass("berror");
            $("#bounce-error").hide();
            var bounce_account = $('#bounce_account').val();
            var bounce_id = $('#bounce_id').val();
            $.ajax({
                type    : "post",
                url: "{{ route('assignBounceToList') }}",
                data    : {"bounce_id": bounce_id,"bounce_account":bounce_account},
                dataType    : "json",
                success: function(result) {
                    if(result.status)
                    {
                        Command: toastr["success"] (result.message);
                        objTable.draw();
                        $('#closeMdl').trigger('click');
                    }
                    else{
                        Command: toastr["error"] (result.message);
                    }
                }
            });
        } 
    });
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Bounce-Addresses");
        

// function in master2 layout
        var page_limit=show_per_page('','bounce_emails_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#bounce_emails').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,7]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[6, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/') }}"+"/getBounces?test={{$test}}",
            "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
         page_limit=show_per_page(table,'bounce_emails_pageLength');
        objTable = table;
    });

    function bounceDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/bounce/'+id,
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
    function exportIt(id) {
        if(id == 0) {
            if(!$('input:checkbox:checked').length){
                alert('{{trans('common.message.alert_no_record')}}');
                return false;
            }

            var ids = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
        } else { 
            var ids = id;
        }

        // if(!$('input:checkbox:checked').length){
        //    alert('{{trans('common.message.alert_no_record')}}');
        //    return false;
        // }
        // var ids = $('input:checkbox:checked').map(function() {
        //     return this.value;
        // }).get();
        $.ajax({
            url: "{{ url('/') }}"+'/bounce/export/'+id,
            type: "GET",
            data:{ids: ids},
            success: function(result) {
                // window.location.href = "{{ url('/') }}"+'/bounce/download/'+'{{$authUser->id}}'+'/files/smtps/'+result;
                window.location.href = "{{ url('/') }}"+'/bounce/download/'+result;
            }
        });
    }
    function updateStatus(id, status) {
       
        if(id == 0) {
            if(!$('input:checkbox:checked').length){
                alert('{{trans('common.message.alert_no_record')}}');
                return false;
            }

            var ids = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
        } else { 
            var ids = id;
        }
        

       
        $.ajax({
            url: "{{ url('/') }}"+'/bounce/status/'+id,
            data: {status: status, ids: ids},
            type: "PUT",
            success: function(result) {
                $('#msg').css("display", "flex");
                $('#msg-text').html('{{trans('common.message.updated',["title" =>"Status"])}}');
                $('#msg').removeClass('display-hide').addClass('alert alert-success');
            }
        });
    }
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
        var bounces_email = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
                type    : "Delete",
                url: "{{ url('/') }}"+'/bounce/'+bounces_email,
                data    : {ids: bounces_email},
                success: function(result) {
                        if(result == 'delete') {
                            window.location.href = "{{route('bounce.index')}}";
                        }
                    }
              });

        }
    }

    function verifyBounce () {
        $(".blockUI").show();
        var smtps = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/bounce/test',
            data    : {ids: smtps},
            success: function(result) {
               // console.log(result);
                $(".blockUI").hide();
                window.location.href = "{{route('bounce.index')}}?test=1";
            },
            error: function(result) {
                window.location.href = "{{route('bounce.index')}}?test=1";
            }
        });
    }
    function testConnection (id) {
        $(".blockUI").show();
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/bounce/conntection/test/'+id,
            success: function(result) {                    
                $(".blockUI").hide();
                $('#group-data').html(result);
                $("#modal-smtp-test").modal('show');
        
            }
        });
    }
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="EzUWpmNZ">
    {{ Session::get('msg') }}
</div>
@endif
@if (Session::has('alert'))
<div class="alert alert-danger" data-name="ZWWLvQxE">
    {{ Session::get('alert') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="XCTbqMKi">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="lWDAYnhp">
    <div class="col-md-12" data-name="KGAKqrEE">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="UClRtLDI">
            <div class="kt-portlet__body" data-name="ymuCDqUx">
                <div class="table-toolbar" data-name="PfLSuYtQ">
                    <div class="form-group row" data-name="daBMtBPI">
                        <div class="col-md-12" data-name="KYNfXSHG">
                           @if (routeAccess('bounce.create'))
                            <div class="btn-group" data-name="RlrosoFZ">
                                <a href="{{ route('bounce.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                           <div class="btn-group pull-right" data-name="vKwwBpaB">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="javascript:;" class="" onclick="verifyBounce()"> <i class="fa fa-thumbs-up"></i>{{trans('bounce_addresses.action.test_connect')}}</a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="" onclick="updateStatus(0, 1);"> <i class="fa fa-check-square"></i> {{trans('bounce_addresses.action.set_active')}}  </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;" class="" onclick="updateStatus(0, 0);"> <i class="fa fa-window-close"></i> {{trans('bounce_addresses.action.set_inactive')}}  </a>
                                    </li>
                                     <li>
                                        <a href="javascript:;" class="" onclick="exportIt(0);"> <i class="fa fa-download"></i> {{trans('bounce_addresses.action.export_to_csv')}}  </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')
                <table class="table table-striped table-hover responsive table-checkable" id="bounce_emails" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('bounce_addresses.table_headings.bounce_address')}}</th>
                            <th>{{trans('bounce_addresses.table_headings.host')}}</th>
                            <th>{{trans('bounce_addresses.table_headings.username')}}</th>
                            <th>{{trans('bounce_addresses.table_headings.method')}}</th>
                            <th>{{trans('bounce_addresses.table_headings.port')}}</th>
                            @if (isset($_GET['test']))
                            <th>{{trans('bounce_addresses.table_headings.verify_status')}}</th>
                            @endif
                            <th>{{trans('Error')}}</th>
                            <th>{{trans('bounce_addresses.table_headings.actions')}}</th>
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
<div id="modal-smtp-test" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="scaMvLDp">
    <div class="modal-dialog modal-dialog-centered" data-name="FJOXfSgy">
        <div class="modal-content" data-name="FnnVUQvF">
            <div class="modal-header" data-name="wqeouQSb">
                <h5 class="modal-title">{{trans('bounce_addresses.action.test_connect')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="VGPYpBow">
                <div class="row" data-name="xnTujMVn">
                    <div class="col-md-12" data-name="TbqwmKlQ">
                        <div class="group-data" id="group-data" data-name="bqDaTddv"></div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>
<div id="assignAssets" class="modal" tabindex="-1" data-backdrop="static" role="dialog" data-keyboard="false" data-name="nUTXMsew">
    <div class="modal-dialog" role="document" data-name="HKZnTrQt">
        <div class="modal-content" data-name="KINlFyuh">
            <div class="modal-header" data-name="XwZSjNAp">
                <h5 class="modal-title"> {{trans('bounce_addresses.attach.to_list')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" data-name="JVUasGSz">
                <div class="alert alert-info alert-light alert-bold" data-name="MxahoFeH">
                    <div class="alert-text" data-name="OWmcVuaS">{{trans('bounce_addresses.attach.assets.desc_1')}}</div>
                </div>
                <ul id="bounceAssets" class="scroll scroll-150">
                    {{trans('bounce_addresses.index_blade.sending_node_ul')}} 
                    {{trans('bounce_addresses.index_blade.contact_list_ul')}} 
                </ul>
                <div class="alert alert-solid-dark alert-bold" data-name="LzDBQXDo">
                    <div class="alert-text" data-name="TNXgXwbx">{{trans('bounce_addresses.attach.assets.desc_2')}}</div>
                </div>
                <input type="hidden" id="bounce_id" >
                <div id="bounce-change-blk" class="" data-name="HwlfTGab">
                    <select class="form-control m-select2" data-placeholder="Choose Account" name="bounce_account" id="bounce_account"></select>
                    <div id="bounce-error" class="error invalid-feedback" data-name="SKRVtSmJ">{{trans('bounce_addresses.index_blade.filed_required_div')}} </div>
                </div>
            </div>
            <div class="modal-footer" data-name="DiHxJzeD">
                <button id="attachToList" type="button"  class="btn btn-danger btn-sm"> {{trans('bounce_addresses.attach_and_delete')}}</button>
                <button id="closeMdl" type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
            </div>
        </div>
    </div>
</div>

@endsection