@extends(decide_template())
@php($authUser = getAuthUser())
@section('title', strip_tags($pageTitle))

@section('page_styles')
<link href="/resources/assets/css/subscriber-index.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
<link href="/themes/default/css/jquery.nestable.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
<!--begin::Page Vendors(used by this page) -->
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>

    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.nestable.js" type="text/javascript"></script>
    <script>
        // open delete confirmation popup
        function forceFullyChecked(){
            $("#cus_contact").attr('checked',true);
        }
        function openConfirmation(contact_id,list_id='') {
            $.ajax({
                url: "{{ route('adminOnClient') }}",
                type: "POST",
                data: {'record_id':contact_id,'table':'subscribers'},
                dataType:'json',
                beforeSend: function () {
                    $(".blockUI").show();
                    $('.adminOnClient').hide();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function(result) 
                {
                        $('.adminOnClient').empty();
                        $('.adminOnClient').empty();
                        if(result.status) {
                            $('.adminOnClient').html(result.span);
                            $('.adminOnClient').show();
                        }
                        var method = 'deleteSubscriber('+contact_id+')';
                        $('.yes').attr('onclick',method);
                        $('#confirmationModal').modal('show');
                }
            });
        }
        $(document).on('click','.no',function () {
            $('#confirmationModal').modal('hide');
        });
        var objTable;
        var record_type = 'our_records';
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
            $("#change_order").click(function() {
                $("#change_model_data").modal({
                    show: true,
                    backdrop: 'static',
                    keyboard: false
                });
            });
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Contacts/Contacts");

            $('.table-scrollable').on('show.bs.dropdown', function () {
                $('.table-scrollable').css( "overflow", "inherit" );
            });

            $('.table-scrollable').on('hide.bs.dropdown', function () {
                $('.table-scrollable').css( "overflow", "auto" );
            });

           // function in master2 layout
            var page_limit=show_per_page('','subscribers_pageLength',10);  // Params (table,page,default_limit=10)

            var list_id = $("#list-id").val();
            var haveSortOrder = "{{ $haveSortOrder }}";
            var visible_fields_json_data = "{{ $visible_fields_json_data }}";
            if(haveSortOrder==0){
                var aTaregt = [0,8];
            }else{
                var myArray = visible_fields_json_data.split(",");
                var aTaregt = [];
                aTaregt.push(0);
                var i = 0;
                $.each(myArray, function(key, value){
                   if($.isNumeric(value)){
                    
                    //aTaregt[]=key;
                    aTaregt.push(key+1);
                   }
                   ///console.log(key+"==",value);
                   i++;
                   
                });
                
                aTaregt.push(myArray.length+1);
                
                /*jQuery.each( myArray, function( i, val ) {
                    if(Number.isInteger(val)){
                        aTaregt[] = val;
                    }
              });
              */
            }
            var sort_order=0;
            var arr=visible_fields_json_data.split(',');
            for (var i = 0; i < arr.length; i++) {
                if(arr[i]=="contact_on"){
                   sort_order=(i+1); 
                }
            }
            var table = $('#subscribers-tbl-id').DataTable({
                "aoColumnDefs": [{"bSortable": false, "aTargets": aTaregt,}],
                "bProcessing": true,
                "bServerSide": true,
                "aaSorting": [[sort_order, "desc"]],
                "sPaginationType": "full_numbers",
                "sAjaxSource": "{{ url('getSubscribers/?listid=') }}"+list_id ,
                "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]],
                "pageLength" : page_limit,
                    columnDefs: [
                        { responsivePriority: 1, targets: 2 },
                        { responsivePriority: 2, targets: 4 }
                    ],
                "fnServerParams": function (aoData) {
                    aoData.push({"name": "record_type", "value": record_type});
                    aoData.push({"name": "clients", "value": $("#clients").val()});
                    aoData.push({"name": "admins", "value": $("#admins").val()});
                    aoData.push({"name": "filter", "value": $("#filter").val()});
                    aoData.push({"name": "haveSortOrder", "value": haveSortOrder});
                    aoData.push({"name": "visible_fields_json_data", "value": visible_fields_json_data});
                },
                "fnPreDrawCallback": function(sAjaxSource) {
                    //   console.log(sAjaxSource);
                    if(sAjaxSource._iRecordsTotal == 0){
                        //$(".subscribers-tbl-ajax").hide();
                    }else{
                        ///        $(".subscribers-tbl-ajax").show();
                    }
                },  initComplete: function () {
                    $('<div class="filter-status" style="width: 150px;">' +
                        '<select id="filter" class="form-control m-select2">'+
                        '<option selected value="all">All</option>'+
                        '<option value="active">Active</option>'+
                        '<option value="inactive">Inactive</option>'+
                        '<option value="confirmed">Confirmed</option>'+
                        '<option value="unconfirmed">Unconfirmed</option>'+
                        '<option value="soft_bounced">Soft Bounced</option>'+
                        '<option value="hard_bounced">Hard Bounced</option>'+
                        '<option value="unsubscribed">Unsubscribed</option>'+
                        '<option value="suppressed">Suppressed</option>'+
                        '<option value="spamed">Spammed</option>'+
                        '</select>' +
                        '</div>').appendTo("#subscribers-tbl-id_wrapper .dataTables_filter");
                    $(".dataTables_filter label").addClass("pull-right");
                    $(".m-select2").select2({
                    });
                    $('[data-toggle="tooltip"]').tooltip();
                }

            });
            objTable = table;
             // function in master2 layout
             page_limit=show_per_page(table,'subscribers_pageLength');  // Params table and page (key)


        });
        $(document).on('change','#filter',function(){
            try {
                objTable.fnReloadAjax();
            }
            catch (e) {
                try {
                    objTable.draw()
                }
                catch (e) {

                }
            }
        });
        // delete subscriber
        function deleteSubscriber(id) {
                $("#row_"+id).remove();
                $(".child").remove();
                $.ajax({
                    url: "{{ url('/') }}"+'/contact/'+id,
                    type: "DELETE",
                    beforeSend: function () {
                        $(".blockUI").show();
                        $('#confirmationModal').modal('hide');
                    },
                    complete: function () {
                        $(".blockUI").hide();
                    },
                    success: function(result) {
                        if(result == 'delete') {
                            Command: toastr["success"] ('{{trans('common.message.delete')}}');
                        }
                    }
                });

        }
        // delete selected subscriber
        function deleteAll () {
            if(!$('#subscribers-tbl-id input:checkbox:checked:not(.checkbox-all-index)').length){
                alert('{{trans('common.message.alert_no_record')}}');
                return false;
            }
            if(confirm('{{trans('common.message.alert_delete')}}')) {
                var subscribers = $('#subscribers-tbl-id  input:checkbox:checked:not(.checkbox-all-index)').map(function() {
                    return this.value;
                }).get();
                $.ajax({
                    type    : "DELETE",
                    url     : "{{ url('/') }}"+'/contact/all',
                    data    : {ids: subscribers,list_id:$('#list-id').val()},
                    beforeSend: function () {
                        $(".blockUI").show();
                    },
                    complete: function () {
                        $(".blockUI").hide();
                    },
                    success: function(result) {
                        objTable.ajax.reload();
                    }
                });
            }
        }
        // open soft bounce confirmation modal
        function launchModel(status,column,model='Subscribers') {
            if($('input:checkbox:checked').length>0){
                $('#bulkActionModel').css('display','block');
                method = 'updateStatus("'+status+'","'+column+'","'+model+'")';
                $('#yes').attr('onclick',method);
            }
        }
        // update subscriber status
        function updateStatus(status,column,model,dataTableId='#subscribers-tbl-id')
        {
            var subscribers = $('input:checkbox:checked').map(function() {
                return this.value;}).get();
            $.ajax({
                type    : "POST",
                url     : "{{route('bulkUpdate')}}",
                data    : {ids: subscribers,status:status,model:model,column:column},
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function(result) {
                    if(result.status) {
                        toastr.success(result.message);
                        var table = $(dataTableId).DataTable();
                        table.draw();
                        $('.no').trigger('click');
                    }
                    else toastr.error(result.message);
                }
            });
        }

        $('.no').on('click',function () {
            $('#yes').removeAttr('onclick');
            $('#bulkActionModel').css('display','none')
        });
    </script>
    <script>
        // view subscriber detail
        
        function getCustomFieldOrder() {
            var idsInOrder = [];
            var idsInOrderAll = [];
            $("ol#sortable li").each(function () {
                var data_id = $(this).attr('data-id');
                if($("#cus_"+data_id).is(":checked")){
                    idsInOrder.push($(this).attr('data-id'));
                }
               // idsInOrderAll.push(data_id);
                //console.log(data_id);
            });
            $("#custom_field_order").val(idsInOrder);
            $('input:checkbox.sortingColums').each(function () {
                ///var sThisVal = (this.checked ? $(this).val() : "");
                var ChechBoxId = $(this).attr("id");
                
                if($("#"+ChechBoxId).is('[disabled]')){
                    
                }else{
                   // console.log($(this).val());
                    idsInOrderAll.push($(this).val());
                    ///idsInOrderAll.push($("#"+idsInOrderAll).val());
                }
                /*if(!$(ChechBoxId+'#').is(':disabled')){
                    console.log( $(this).val());
                }
                */
                
           });
           $("#custom_field_order_all").val(idsInOrderAll);
           $.ajax({
                url: "{{ route('changeOrderField') }}",
                type: "post",
                data: $("#frmChangeOrder").serialize(),
                dataType:'json',
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function (data) {
                    location.reload();
                }
            });
           
            // console.log(idsInOrder);
        }
        function getFormData(id , type , list_id)
        {
            $.ajax({
                url: "{{ url('/') }}"+'/contact/'+id+'/detail',
                type: "GET",
                dataType:'json',
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function (data) {
                    $('#subscriber-data').html(data.html);
                    if(data.is_client) {
                        $('#adminOnClient').empty();
                        $('#adminOnClient').html(data.user_url);
                        $('#adminOnClient').show();
                    }
                    else{
                        $('#adminOnClient').empty();
                        $('#adminOnClient').hide();
                    }
                    $("#modal-subscriber-details").modal('show');
                }
            });
        }
        $(document).ready(function() {
            $('#modal-subscriber-details').on('hidden', function() {
                clear()
            });
        });
        var UINestable = function () {
            var t = function (t) {
                var e = t.length ? t : $(t.target),
                    a = e.data("output");
                window.JSON ? a.val(window.JSON.stringify(e.nestable("serialize"))) : a.val("{{trans('contacts.index_blade.json_browser_val')}}")
            };
            return {
                init: function () {
                    $("#nestable_list_3").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                    $("#nestable_list_4").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                    $("#nestable_list_campaign").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                }
            }
        }();
        jQuery(document).ready(function () {
            UINestable.init()
        }); 
    </script>
    @include('includes.view-pages-filter-script')
@endsection

@section(decide_content())

    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="NjXqnPHT">
            {{ Session::get('msg') }}
        </div>
    @endif

    @if (Session::has('error-msg'))
        <div class="alert alert-danger" data-name="BmeBhzWq">
            {{ Session::get('error-msg') }}
        </div>
    @endif
    <div id="msg" class="display-hide" data-name="QWwEunAv">
        <button class="close" data-close="alert"></button>
        <span id='msg-text'><span>
    </div>
    <input type="hidden" id="list-id" value="{{ isset($list_id) ? $list_id : '' }}">
    <div class="row" data-name="zBZxWRTe">
        <div class="col-md-12" data-name="LroRtnot">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="kt-portlet kt-portlet--height-fluid" data-name="qapcqfyH">
                <div class="kt-portlet__body" data-name="DLohZZIp">
                    <div class="table-toolbar" data-name="TsjDwglD">
                        <div class="form-group row" data-name="qdhThaTW">
                            <div class="col-md-12" data-name="nXpLgbFF">
                                @if (routeAccess('contact.create',$authUser))
                                    <div class="btn-group" data-name="fqQeEUFf">
                                        <a href="{{ isset($list_id) ? route('contactAddToList',$list_id) :$add_new_sub_link }}">
                                            <button id="sample_editable_1_new" class="btn btn-label-success">
                                                <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                            </button></a>
                                    </div>
                                      @endif
                                  @if (routeAccess('contact.import',$authUser))
                                  @if(empty($list))
                                        <div class="btn-group" data-name="UmfBYwHG">
                                            @if($list_id)
                                            <a href="{{ route('importIntoList',$list_id) }}">
                                            @else
                                            <a href="{{ route('contact.import') }}">
                                            @endif
                                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                                    <i class="la la-plus"></i> {{trans('contacts.import_contacts')}}  
                                                </button></a>
                                        </div>
                                        @else 
                                            @if($list->disable_import != 1 or !isClient(Auth::user()))
                                            <div class="btn-group" data-name="dTtvOpjN">
                                                @if($list_id)
                                                <a href="{{ route('importIntoList',$list_id) }}">
                                                @else
                                                <a href="{{ route('contact.import') }}">
                                                @endif
                                                    <button id="sample_editable_1_new" class="btn btn-label-success">
                                                        <i class="la la-plus"></i> {{trans('contacts.import_contacts')}} 
                                                    </button></a>
                                            </div>
                                            @endif
                                        @endif
                                    @endif
                                    <div class="btn-group" data-name="siDEuzSR">
                                        <p id="demo"></p>
                                    </div>
                                    
                              @php($bulkUpdate = routeAccess('contact.bulk-update.store',$authUser))
                              @php($bulkDelete = routeAccess('contact.destroy',$authUser))
                              @php($bulkAction = $bulkUpdate || $bulkDelete)
                              @if($bulkAction)
                                <div class="btn-group pull-right subscribers-tbl-ajax" data-name="UfyjjOCF">
                                    <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                        {{ trans('common.actions') }}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        @if($bulkUpdate)
                                            <li>
                                                <a href="javascript:;" onclick="launchModel('soft','bounced')"> <i class="fa fa-remove"></i> {{trans('contacts.bulk_actions.button.set_soft_bounce')}}  </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="launchModel('hard','bounced')"> <i class="fa fa-times-circle"></i> {{trans('contacts.bulk_actions.button.set_hard_bounce')}}  </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="launchModel('no_process','bounced')"> <i class="fa fa-not-equal"></i> {{trans('contacts.bulk_actions.button.set_not_bounce')}}  </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="launchModel('1','is_confirmed')"> <i class="fa fa-check-square"></i> {{trans('contacts.bulk_actions.button.set_confirmed')}}  </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="launchModel('0','is_confirmed')"> <i class="fa fa-minus-square"></i> {{trans('contacts.bulk_actions.button.set_unconfirmed')}}  </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="launchModel('1','is_active')"> <i class="fa fa-thumbs-up"></i> {{trans('contacts.bulk_actions.button.set_active')}}  </a>
                                            </li>
                                            <li>
                                                <a href="javascript:;" onclick="launchModel('0','is_active')"> <i class="fa fa-thumbs-down"></i> {{trans('contacts.bulk_actions.button.set_inactive')}}  </a>
                                            </li>
                                              @endif
                                            @if($bulkDelete)
                                            <li>
                                                <a href="javascript:;" onclick="deleteAll();"> <i class="fa fa-trash"></i> {{trans('common.form.buttons.delete')}}  </a>
                                            </li>
                                            @endif
                                      
                                    </ul>
                                </div>
                                @endif
                                @if($list_id > 0)
                                <a type="button" data-toggle="modal"  class="btn btn-default btn-sm pull-right popovers" data-placement="top" data-container="body" data-trigger="hover" data-toggle="kt-popover" data-content="{{ trans('contacts.table_headings.re_order') }}" id="change_order" data-original-title="{{trans('common.description')}}"><i class="fa fa-bars"></i></a>
                                @endif
                            </div>
                        </div>
                        @if(!isset($list_id))
                        @include('includes.view-pages-filter')
                            @endif
                    </div>
                    @if(!empty($list) and $list->contacts_limit > 0) 
                        <div class="climit" data-name="GeOBtTDs">
                            <button class="btn btn-label-warning btn-sm" id="contacts_limit">{{trans('contacts.index_blade.button_contacts_limit')}}  {{$list->total_subscribers}} / {{$list->contacts_limit}}</button>
                        </div>
                    @endif
                    <table class="table table-striped table-hover table-checkable responsive" id="subscribers-tbl-id" role="grid" >
                        <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <?php
                            //echo '<pre>';
                            //print_r($visible_fields_array);
                            if($haveSortOrder==0){
                            ?>
                                <th class="contact-block">{{trans('contacts.table_headings.contact')}}</th>
                                <th>{{trans('contacts.table_headings.group_name')}}</th>
                                <th class="list-block">{{trans('contacts.table_headings.list')}}</th>
                                <th>{{ trans('lists.contact_lists.table_headings.created_on') }}</th>
                                <th>{{trans('contacts.table_headings.bounced')}}</th>
                                <th>{{trans('contacts.table_headings.unsubscribed')}}</th>
                                <th>{{trans('contacts.table_headings.confirmed')}}</th>
                                <th>{{trans('contacts.table_headings.actions')}}</th>
                            <?php
                            }else{
                                foreach($visible_fields_array['custome_fields_order'] as $field){
                                    if(is_numeric($field))
                                    { 
                                        $row = getCustomFieldRow($field);
                                        if($row){
                            ?>
                                <th>{{  $row['name'] }}</th>
                                <?php
                                        }
                                    }
                                    else{
                                        if($field=='contact'){
                                        ?>
                                        <th class="contact-block">{{trans('contacts.table_headings.contact')}}</th> 
                                            <?php
                                        }else if($field=='group_name'){    
                                            ?>
                                                <th>{{trans('contacts.table_headings.group_name')}}</th>
                                                <?php
                                        }else if($field=='list'){    
                                            ?>
                                                <th class="list-block">{{trans('contacts.table_headings.list')}}</th>
                                                <?php
                                        }else if($field=='contact_on'){    
                                        ?>
                                            <th>{{ trans('lists.contact_lists.table_headings.created_on') }}</th>
                                            <?php   
                                        }else if($field=='bounced'){  
                                            ?>
                                            <th>{{trans('contacts.table_headings.bounced')}}</th>  
                                        <?php
                                        }else if($field=='unsubscribed'){
                                            ?>
                                            <th>{{trans('contacts.table_headings.unsubscribed')}}</th>  
                                        <?php
                                        }
                                        else if($field=='spammed'){
                                            
                                            
                                        ?>
                                            <th>{{trans('contacts.table_headings.spammed')}}</th>  
                                            <?php
                                        }
                                        else if($field=='suppressed'){
                                            
                                        ?>
                                            <th>{{trans('contacts.table_headings.suppressed')}}</th>  
                                            <?php
                                        }
                                        else if($field=='active'){
                                        
                                            ?>
                                            <th>{{trans('contacts.table_headings.active')}}</th>      
                                                <?php
                                        }
                                        else{
                                            ?>
                                            <th>{{trans('contacts.table_headings.confirmed')}}</th>
                                                <?php
                                        }
                                        
                                    }
                            ?>
                                
                                
                                <?php
                                }
                            ?>
                                <th>{{trans('contacts.table_headings.actions')}}</th>
                                <?php    
                            }
                            ?>
                            
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
    <!-- View Subscriber detail Modal -->
    <div id="modal-subscriber-details" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="TbWOJEmh">
        <div class="modal-dialog" data-name="QiEgWeJS">
            <div class="modal-content" data-name="tGObEKVO">
                <div class="modal-header" data-name="kROlvspd">
                    <h4 class="modal-title">{{trans('contacts.contact_detail')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                </div>
                <div class="modal-body" data-name="VMZGHiKQ">
                    <div id="adminOnClient" class="alert alert-warning" style="display: none;" data-name="EXKmONNu">

                    </div>
                    <form action="#" method="POST" class="form-horizontal">
                        <div class="subscriber-data" id="subscriber-data" data-name="GDGJrjWh"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- View Subscriber detail Modal -->

    <!-- Bulk Action Modal -->
    <div id="bulkActionModel" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" style="padding-right: 17px;" data-name="LLYjgxXi">
        <div class="modal-dialog" data-name="ESZxHUyR">
            <div class="modal-content" data-name="XzrHBajd">
                <div class="modal-header" data-name="jzxpLvod">
                    <h5 class="modal-title">{{ trans('contacts.add_new.form.confirmation') }}</h5>
                </div>
                <div class="modal-body" data-name="tLlzmqcp">
                    <div class="form-actions" data-name="KhdZQfoN">
                                        <span id="split-processing" >
                                <div class="text-info" id="alert-text" data-name="yfFExswP">{{ trans('common.message.alert_confirm') }}</div>
                            </span>
                        <div class="row" data-name="gARewmnr">
                            <div class="offset-md-3 col-md-7" data-name="rQVCneFn">
                                <button id="yes" class="btn btn-success">{{ trans('common.form.buttons.yes') }}</button>
                                <button class="no btn btn-default">{{ trans('common.form.buttons.no') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bulk Action Modal -->

    <!-- Delete Confirmation Modal -->
    <div id="confirmationModal" class="modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false" aria-modal="true" style="padding-right: 17px; display: none;" data-name="IFgpyexP">
        <div class="modal-dialog modal-dialog-centered" data-name="oqIPdSjG">
            <div class="modal-content" data-name="uPtpmJlo">
                <div class="modal-header" data-name="ARoXTOrS">
                    <h5 class="modal-title">{{ trans('contacts.add_new.form.confirmation') }}</h5>
                </div>
                <div class="modal-body" data-name="OOsPtItc">
                    <div class="alert alert-warning adminOnClient" style="display: none;" data-name="eeWUGQbJ">

                    </div>
                    <div class="form-actions" data-name="STieauXK">
                                        <span id="split-processing" class="alert alert-info">
                                <div class="alert-text" id="alert-text" data-name="osJrNfyE">{{ trans('common.message.alert_confirm') }}</div>
                            </span>
                        <div class="row" data-name="DUCXrVOD">
                            <div class="offset-md-3 col-md-7" data-name="sQeJVwLE">
                                <button  class="yes btn btn-success" >{{ trans('common.form.buttons.yes') }}</button>
                                <button class="no btn btn-default">{{ trans('common.form.buttons.no') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Confirmation Modal -->
    <?php
    if($list_id > 0){
        //echo '<pre>';
        //print_r($visible_fields_array); exit;
    ?>
    
    <div class="modal fade load-data-popup" id="change_model_data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="BuUidNBu">
        <div class="modal-dialog modal-dialog-centered" role="document" data-name="SnVgBKZT">
            <form name="frmChangeOrder" id="frmChangeOrder" action="" method="post" style="width: 100%">
            <div class="modal-content" data-name="PcWkBJMN">
                <div class="modal-header" data-name="iMfxxCge">
                    <h5 class="modal-title" id="resultTitle">{{ trans('contacts.table_headings.pre_columns') }}</h5>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    <input type="hidden" id="custom_field_order" name="custom_field_order" value="" />
                    <input type="hidden" id="custom_field_order_all" name="custom_field_order_all" value="" />
                    <input type="hidden" id="model_list_id" name="model_list_id" value="{{ $list_id }}" />
                </div>
                <div class="modal-body" data-name="hGkoLmZU">
                    <p>{{ trans('contacts.table_headings.pre_columns_text') }}</p>
                    <div class="popup-first-blk mt-checkbox-list" data-name="FPPsCLqb">
                        <div class="dd" id="nestable_list_campaign">
                            <ol class="dd-list" id="sortable">
                                <?php

                                foreach($visible_fields_array['custome_fields_all'] as $field_id){

                                                  if(is_numeric($field_id)){
                                                      $added[] = $field_id;
                                                      $field = getCustomFieldRow($field_id);
                                                      if($field){
                                                          ?>
                                                          <li class="dd-item dd3-item custom" data-id="{{ $field['id'] }}" style="" id="cus_li_{{ $field['id'] }}">
                                                                <div class="dd-handle dd3-handle"> </div>
                                                                <div class="dd3-content">
                                                                    <div class="kt-checkbox-list">
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input type="checkbox" value="{{ $field['id'] }}" class="custimCheckBox sortingColums" @if( in_array( $field['id'] ,$custome_fields_order ) ) checked=""  @endif  value="{{ $field['id'] }}" id="cus_{{ $field['id'] }}" name="custome_fields[]" >
                                                                            {{ $field['name'] }}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                <?php
                                                      }
                                                  }else{
                                                      if($field_id=='contact'){
                                                          $added[]='contact';
                                                          ?>
                                                       <li class="dd-item dd3-item" data-id="contact">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="contact" id="cus_contact" onchange="forceFullyChecked()"  name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif  >
                                                                        {{ trans('lists.add_new.form.contact') }} ({{ trans('lists.add_new.form.contact_included') }})
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>     

                                                    <?php
                                                      }
                                                      else if($field_id=='group_name'){
                                                          $added[]='group_name';
                                                          ?>
                                                            <li class="dd-item dd3-item" data-id="group_name">
                                                                <div class="dd-handle dd3-handle"> </div>
                                                                <div class="dd3-content">
                                                                    <div class="kt-checkbox-list">
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input class="sortingColums" type="checkbox" value="group_name" id="cus_group_name" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                            {{ trans('lists.add_new.form.group') }}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php
                                                      }
                                                      else if($field_id=='list'){
                                                          $added[]='list';

                                                      ?>
                                                            <li class="dd-item dd3-item" data-id="list">
                                                                <div class="dd-handle dd3-handle"> </div>
                                                                <div class="dd3-content">
                                                                    <div class="kt-checkbox-list">
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input class="sortingColums" type="checkbox" value="list" id="cus_list" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                            {{ trans('lists.add_new.form.list') }}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                            <?php
                                                      }
                                                      else if($field_id=='contact_on'){
                                                          $added[]='contact_on';
                                                          ?>
                                                            <li class="dd-item dd3-item" data-id="contact_on" checked="">
                                                                <div class="dd-handle dd3-handle"> </div>
                                                                <div class="dd3-content">
                                                                    <div class="kt-checkbox-list">
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input class="sortingColums" type="checkbox" value="contact_on" id="cus_contact_on" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                            {{ trans('lists.contact_lists.table_headings.created_on') }}

                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                      <?php      
                                                      }
                                                      else if($field_id=='bounced'){
                                                          $added[]='bounced';
                                                        ?>
                                                           <li class="dd-item dd3-item" data-id="bounced">
                                                                <div class="dd-handle dd3-handle"> </div>
                                                                <div class="dd3-content">
                                                                    <div class="kt-checkbox-list">
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input class="sortingColums" type="checkbox" value="bounced" id="cus_bounced" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                            {{ trans('lists.add_new.form.bounced') }}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>

                                                    <?php
                                                      }
                                                      else if($field_id=='unsubscribed'){
                                                          $added[]='unsubscribed';
                                                      ?>
                                                            <li class="dd-item dd3-item" data-id="unsubscribed">
                                                                <div class="dd-handle dd3-handle"> </div>
                                                                <div class="dd3-content">
                                                                    <div class="kt-checkbox-list">
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input class="sortingColums" type="checkbox" value="unsubscribed" id="cus_unsubscribed" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                            {{ trans('lists.add_new.form.unsubscribed') }}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                      <?php
                                                      }
                                                      else if($field_id=='spammed'){
                                                          $added[]='spammed';
                                                      ?>
                                                          <li class="dd-item dd3-item" data-id="spammed">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="spammed" id="cus_spammed" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.add_new.form.spammed') }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                         </li>
                                                      <?php
                                                      }
                                                       else if($field_id=='suppressed'){
                                                           $added[]='suppressed';
                                                      ?>
                                                          <li class="dd-item dd3-item" data-id="suppressed">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="suppressed" id="cus_suppressed" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.add_new.form.suppressed') }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            </li>
                                                          <?php     
                                                       }
                                                       else if($field_id=='active'){
                                                           $added[]='active';
                                                           ?>
                                                             <li class="dd-item dd3-item" data-id="active">
                                                                <div class="dd-handle dd3-handle"> </div>
                                                                <div class="dd3-content">
                                                                    <div class="kt-checkbox-list">
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input class="sortingColums" type="checkbox" value="active" id="cus_active" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                            {{ trans('lists.add_new.form.active') }}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>  
                                                               <?php
                                                       }
                                                      else{
                                                          $added[]='confirmed';
                                                          ?>
                                                            <li class="dd-item dd3-item" data-id="confirmed">
                                                                <div class="dd-handle dd3-handle"> </div>
                                                                <div class="dd3-content">
                                                                    <div class="kt-checkbox-list">
                                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                                            <input class="sortingColums" type="checkbox" value="confirmed" id="cus_confirmed" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                            {{ trans('lists.add_new.form.confirmed') }}
                                                                            <span></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                     <?php       
                                                      }
                                                      ?>
                                                 <?php           

                                                  }
                                         ?>

                                        <?php 
                                              }
                                ?>

                            </ol>
                        </div>    
                        
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="load-data-spinner" data-name="WkGRuiTn">
                        <i class="fa fa-spinner fa-spin"></i>
                    </div>
                    <button type="button" class="btn btn-secondary btn-sm pull-left" data-dismiss="modal">{{trans('contacts.index_blade.button_Close')}}</button>
                    <button type="button" class="btn btn-success btn-start btn-sm" onclick="getCustomFieldOrder()">
                        {{ trans('common.form.buttons.submit')}}
                    </button>
                </div>
            </div>
        </form>            
    </div>
    </div>
    <?php
    }
    ?>
    
@endsection