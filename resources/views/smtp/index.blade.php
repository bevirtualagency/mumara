@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/node-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection
@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="NYtzGvYP">
    {{ Session::get('msg') }}
</div>
@elseif(Session::has('error-msg'))
<div class="alert alert-danger" data-name="ETlDpPaE">
    {{ Session::get('error-msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="NopOiSVg">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<?php
$new_ui = useLatestNodeUI();
?>
@if(!$new_ui && $admin)
<div class="alert alert-info warning issue-note no-icon" role="alert" id="meduleMsg">
    <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
    <div class="alert-text">
    <b>{{trans('sending_nodes.index_blade.notice_txt_bold')}} </b>&nbsp; {{trans('sending_nodes.module.message')}}
    </div>                    
    <div class="pull-right text-right">
        <a href="javascript:;" class="btn btn-info btn-xs pull-right text-block" id="module_list">{{trans('sending_nodes.index_blade.switch_now_action')}} </a>
    </div>
</div>
@endif
<div class="row" data-name="YcaARLqA">
    <div class="col-md-12" data-name="HgJFWwvP">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="dCKttzZw">
            <div class="kt-portlet__body" data-name="CpFxnykz">
                <div class="table-toolbar" data-name="zduJJTDr">
                    <div class="form-group row" data-name="pFRaxQbK">
                        <div class="col-md-12" data-name="WEyJHDeD">
                           @if(routeAccess('node.create-new'))
                            <div class="btn-group" data-name="VrpDIggd">
                                <a href="{{$new_ui ? route('node.create') :route('node.create-new') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                           @if(routeAccess('pmta.integration.create'))
                            @if(in_array('PowerMTA Integration', whmcsAddOns()) && isActiveAddon('PowerMTA Integration')=="Active")
                                <div class="btn-group" data-name="VrpDIggd">
                                    <a href="{{route('pmta.integration.create')}}">
                                    <button id="sample_editable_1_new" class="btn btn-label-success">
                                        <i class="la la-plus"></i> {{trans('sending_nodes.index_blade.add_powermta_button')}}
                                    </button></a>
                                </div>
                            @endif
                           @endif
                            <div class="pull-right kt-hide" data-name="TmkoFbzD">
                                <a href="/node?list_view=list" title="{{trans('lists.contact_lists.view.list_view')}}" class="btn btn-label-info"> <i class="la la-list"></i>
                                </a>

                                &nbsp&nbsp
                                <a href="/node?list_view=tree"  class="btn btn-label-success"> <i class="la la-sliders" title="{{trans('lists.contact_lists.view.tree_view')}}"></i>
                                </a>
                                &nbsp&nbsp
                            </div>
                        </div>
                    </div>    
                </div>
                @if ($smtp_view == 'list')

                    <div class="" data-name="WQSMCRuh">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a href="#tab1" class="nav-link active" data-toggle="tab" role="tab">{{trans('sending_nodes.page.tab1.title')}}</a>
                            </li>
                            
                            @if(routeAccess('node.getSmtps') && $pmtas)
                            <li class="nav-item">
                                <a href="#tab2" class="nav-link" data-toggle="tab" role="tab"> 
                                    {{trans('sending_nodes.page.tab2.title')}}
                             </a>
                               
                            </li>
                            @endif
                            
                        </ul>
                        <div class="tab-content" data-name="uakEIFkb">
                            <div class="tab-pane active" id="tab1" role="tabpanel" data-name="slMWvjhA">
                                <div class="row" data-name="sLmwJNav">
                                    <div class="col-md-12" data-name="kCrrAUtg">
                                        <div class="form-group row" data-name="oNavafDc">
                                            <div class="col-md-2" data-name="opSASLYK">
                                                <div class="status_filter" data-name="SxdZvEkh">
                                                    <select class="form-control m-select2" id="typeFilter" name="typeFilter" size="1">
                                                        <option value="all" selected>{{trans('sending_nodes.page.tab1.filter.all')}}</option>
                                                        <option value="smtp">{{trans('sending_nodes.page.tab1.filter.smtp')}}</option>
                                                        <option value="sendgrid">{{trans('sending_nodes.page.tab1.filter.sendgrid')}}</option>
                                                        <option value="mailgun">{{trans('sending_nodes.page.tab1.filter.mailgun')}}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-8" data-name="EJTAzdET"></div>
                                            <div class="col-md-2 pull-right" data-name="ESfVWVKr">
                                                <button class="btn btn-label-info dropdown-toggle pull-right" data-toggle="dropdown">
                                                    {{trans('common.form.buttons.tools')}}
                                                </button>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    @if(routeAccess('node.connection.test'))
                                                    <li>
                                                        <a href="#check-all-smtps"  data-toggle="modal"  class=""> <i class="fa fa-check-square"></i> {{trans('sending_nodes.test_connection.connection')}}</a>
                                                    </li>
                                                    @endif
                                                    @if(routeAccess('node.status.update'))
                                                     <li>
                                                        <a href="javascript:;" onclick="smtpStatus('{{ $type='active'}}')" class=""> <i class="fa fa-thumbs-up"></i> {{trans('common.label.set_active')}}</a>
                                                    </li>
                                                    @endif
													@if(routeAccess('node.status.update'))
                                                    <li>
                                                        <a href="javascript:;" onclick="smtpStatus('{{ $type='inactive'}}')" class=""> <i class="fa fa-minus-square"></i> {{trans('common.label.set_inactive')}}</a>
                                                    </li>
                                                    @endif
                                                     @if(routeAccess('import.smtp'))
                                                    <li>
                                                        <a href="javascript:;" onclick="showImportModal()" class=""><i class="fa fa-upload"></i> {{trans('common.label.import')}} </a>
                                                        <a style="display: none;" data-toggle="modal" data-target="#kt_modal_4" class="mdl"><i class="fa fa-upload"></i> {{trans('common.label.import')}} </a>
                                                    </li>
                                                    @endif
                                                    @if(routeAccess('node.export'))
                                                    <li>
                                                        <a href="javascript:;" onclick="exportAll();" class=""> <i class="fa fa-download"></i> {{trans('common.label.export')}}  </a>
                                                    </li>
                                                    @endif
                                                    @if(routeAccess('node.copy'))
                                                 	<li>
                                                      <a href="javascript:;" onclick="makeCopies()" class=""> <i class="fa fa-copy "></i> @lang('common.label.make_copy')</a>
                                                    </li>
                                                    @endif
                                                    @if(routeAccess('node.destroy'))
                                                    <li>
                                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                                    </li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </div>
                                        @include('includes.view-pages-filter')
                                        @if($smtps_limit > 0)
                                            <div class="climit" data-name="GeOBtTDs">
                                                <button class="btn btn-label-warning btn-sm" id="contacts_limit">{{trans('sending_nodes.index_blade.nodes_limit_button')}} {{$user_smtps }} / {{$smtps_limit}}</button>
                                            </div>
                                        @endif
                                        <table class="table table-striped table-hover responsive table-checkable" id="smtps" role="grid" >
                                            <thead>
                                                <tr role="row">
                                                    <th style="width: 25px;">
                                                        <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                                            <input type="checkbox" class="checkboxes checkbox-all-index">
                                                            <span></span>
                                                        </label>
                                                    </th>
                                                    <th>{{trans('sending_nodes.tab1.table_headings.name')}}</th>
                                                    <th>{{trans('sending_nodes.tab1.table_headings.group')}}</th>
                                                    <th>{{trans('sending_nodes.tab1.table_headings.type')}}</th>
                                                    <th>{{trans('sending_nodes.tab1.table_headings.from_name')}}</th>

                                                {{--    <th>{{trans('sending_nodes.tab1.table_headings.reply_email')}}</th> --}}
                                                    
                                                    <th>{{trans('sending_nodes.tab1.table_headings.status')}}</th>
                                                    @if (isset($_GET['test']))
                                                    <th>{{trans('sending_nodes.tab1.table_headings.status')}}</th>
                                                    @endif
                                                    <th>{{trans('sending_nodes.tab1.table_headings.added_on')}}</th>
                                                    <th>{{trans('sending_nodes.tab1.table_headings.actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane" id="tab2" role="tabpanel" data-name="GrnnLQEO">
                                <div class="row" data-name="DBAMqQHp">
                                    <div class="col-md-12" data-name="ZaauOrIi">
                                        <table class="table table-striped table-hover responsive table-checkable" id="pmtas" role="grid" >
                                            <thead>
                                                <tr role="row">
                                                    <th>{{trans('sending_nodes.tab2.table_headings.sr')}}</th>
                                                    <th>{{trans('sending_nodes.tab2.table_headings.server_name')}}</th>
                                                    <th>{{trans('sending_nodes.tab2.table_headings.host')}}</th>
                                                    <th>{{trans('sending_nodes.tab2.table_headings.server_ip')}}</th>
                                                    <th>{{trans('sending_nodes.index_blade.status_of_th')}}</th>
                                                    <th>{{trans('sending_nodes.tab2.table_headings.added_on')}}</th>
                                                    <th>{{trans('sending_nodes.tab2.table_headings.actions')}}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                @else
                    <style>.dragrows { cursor:move }</style>
                    <script>

                        $(".tree").treetable({ expandable: true });
                          // Highlight selected row
                        $(".tree tbody").on("mousedown", "tr", function() {
                                $(".selected").not(this).removeClass("selected");
                                $(this).toggleClass("selected");
                                saveTreeState()
                        });

                          // Drag & Drop Example Code
                        $(".tree .file, .tree .folder").draggable({
                            helper: "clone",
                            opacity: .75,
                            refreshPositions: true, // Performance?
                            revert: "invalid",
                            revertDuration: 300,
                            scroll: true
                        });

                        $(".tree .folder").each(function() {
                            $(this).parents(".tree tr").droppable({
                              accept: ".file, .folder",
                              drop: function(e, ui) {
                              
                                var droppedEl = ui.draggable.parents("tr");
                                drag_id =  droppedEl.attr('data-tt-id');
                                drop_id =  $(this).attr('data-tt-id');
                                $.ajax({
                                  type: "POST",
                                  url: "{{ url('/') }}"+"/node/tree/move",
                                  data: { action: "Move_smtp", drag_id: drag_id, drop_id : drop_id  }
                                })
                                $(".tree").treetable("move", droppedEl.data("ttId"), $(this).data("ttId"));
                              },
                              hoverClass: "accept",
                              over: function(e, ui) {
                                var droppedEl = ui.draggable.parents("tr");
                                if(this != droppedEl[0] && !$(this).is(".expanded")) {
                                 $(".tree").treetable("expandNode", $(this).data("ttId"));
                                }
                              }
                            });
                        });

                        function saveTreeState() {
                                var expanded_list = new Array();
                                $(".expanded[id^='group']").each(function(){
                                    expanded_list.push($(this).attr('id'));
                                }) 

                                $.ajax({
                                  type: "POST",
                                  url: "{{ url('/') }}"+"/node/tree/move",
                                  data: { action: "SAVE_TREE_STATE", expanded_list: expanded_list },
                                  success: function(result) {
                                    // console.log(result);
                                  }
                                })
                         }
                        function editGroup(group_id) {
                            $("#groupedit-"+group_id).show()
                            $(".grouplabel-"+group_id).hide()
                        }
                        function cancelEdit(group_id) {
                            $("#groupedit-"+group_id).hide()
                            $(".grouplabel-"+group_id).show()
                        }
                        function saveGroup(group_id) {
                                new_group_label = $('#new_smtp_group_name_'+group_id).val();
                                $.ajax({
                                  type: "POST",
                                  url: "{{ url('/') }}"+'/node/tree/move',
                                  data: {action: "SAVE_GROUP_LIST" , group_id : group_id, new_group_label : new_group_label}
                                }).done(function( msg ) {
                                    $("#groupname-"+group_id).html("<strong>"+new_group_label+"<strong>")
                                    $("#groupedit-"+group_id).hide()
                                    $(".grouplabel-"+group_id).show()
                                })
                        }
                        function deleteGroup(group_id) {
                            if(confirm('{{trans('common.message.alert_delete_group')}}'))
                            {
                                $.ajax({
                                  type: "POST",
                                  url: "{{ url('/') }}"+'/node/tree/move',
                                  data: {action: "DELETE_GROUP" , group_id : group_id}
                                }).done(function( msg ) {
                                    // console.log(msg);
                                    $('#alert_delete').show();
                                    $('#alert_delete').focus();
                                    $("#group"+group_id).hide();
                                })
                            
                            }
                        }
                        function deleteGroupSmtp(group_id) {
                            if(confirm('{{trans('common.message.alert_delete')}}'))
                            {
                                $.ajax({
                                  type: "POST",
                                  url: "{{ url('/') }}"+'/node/tree/move',
                                  data: {action: "DELETE_GROUP_LIST" , group_id : group_id}
                                }).done(function( msg ) {
                                   // console.log(msg);
                                    $('#alert_delete').show();
                                    $('#alert_delete').focus();
                                    $("#group"+group_id).hide();
                                     
                                })
                            }
                        }



                        


                    </script>
                    <div class="table-scrollable">
                        <table  id="example-datatable" class="table table-striped table-hover table-checkable tree">
                            <thead>
                                <tr>
                                    <th>{{trans('common.label.group')}}</th>
                                    <th>{{trans('common.table.column.created_on')}}</th>
                                    <th>{{trans('common.table.column.created_by')}}</th>
                                    <th class="text-center">{{trans('common.label.actions')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                {!! $smtp_tree !!}
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<div class="modal fade" id="smtp-modal1" tabindex="-1" role="basic" aria-hidden="true" data-name="bpJelYyl">
    <div class="modal-dialog" data-name="XcsXkxiN">
        <div class="modal-content" data-name="TPdaUOaz">
            <div class="modal-header" data-name="phWKjYgB">
                <h5 class="modal-title">{{trans('app.sending_nodes.modal1_title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="FIpqqbAr"> {{trans('app.sending_nodes.modal1_content')}} </div>
            <div class="modal-footer" data-name="rtPQGhEz">
                <button type="button" id="next1" class="btn green">{{trans('app.dashboard.lang.next')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<div class="modal fade" id="smtp-modal2" tabindex="-1" role="basic" aria-hidden="true" data-name="ckYKyIEB">
    <div class="modal-dialog" data-name="JzwZyYBE">
        <div class="modal-content" data-name="IqQZAiLD">
            <div class="modal-header" data-name="hXcgitWy">
                <h5 class="modal-title">{{trans('app.sending_nodes.modal2_title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="SHvIdwMb"> {{trans('app.sending_nodes.modal2_content')}} </div>
            <div class="modal-footer" data-name="kFpSFAog">
                <button type="button" id="previous1" class="btn green">{{trans('app.dashboard.lang.prev')}}</button>
                <button type="button" id="next2" class="btn green">{{trans('app.dashboard.lang.next')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
<div class="modal fade" id="smtp-modal3" tabindex="-1" role="basic" aria-hidden="true" data-name="NoZRUEAI">
    <div class="modal-dialog" data-name="NWwStoae">
        <div class="modal-content" data-name="WEzLsttH">
            <div class="modal-header" data-name="wfgjdzoa">
                <h5 class="modal-title">{{trans('app.sending_nodes.modal3_title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="OJKWaFsN"> {{trans('app.sending_nodes.modal3_content')}} </div>
            <div class="modal-footer" data-name="UTFGzEuY">
                <button type="button" id="previous2" class="btn green">{{trans('app.dashboard.lang.prev')}}</button>
                <button type="button" class="btn green" data-dismiss="modal">{{trans('app.dashboard.lang.finish')}}</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>



<div id="modal-smtp-failed" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="tZMhTgny">
    <div class="modal-dialog" style="width: 500px;" data-name="hUwrAyfe">
        <div class="modal-content" data-name="BFdqGxSj">
            <div class="modal-header" data-name="TswXQkdG">
                <h5 class="modal-title">{{trans('sending_nodes.smtp_failed_reason')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="GEcfUuvW">
                <div id="smtp-error-data" data-name="qlfMWztY"></div>
            </div>
        </div>
    </div>
</div>
<div id="modal-smtp-test" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="oLTGDOeE">
    <div class="modal-dialog" data-name="extYuKVG">
        <div class="modal-content" data-name="JDNleaDX">
            <div class="modal-header" data-name="lkwzUsxf">
                <h5 class="modal-title">{{trans('common.label.test_connection')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="YqBjXPty">
                <div class="row" data-name="TNknMtSE">
                    <div class="col-md-12" data-name="meTrzvuh">
                        <div class="group-data" id="group-data" data-name="VJvJEyWN"></div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>

<div id="check-all-smtps" class="modal" role="dialog" aria-hidden="true"  data-keyboard="false" data-backdrop="static" data-name="CfzTDulL">
    <div class="modal-dialog" data-name="TpqWIEzF">
        <div class="modal-content" data-name="ojAGevJF">
            <div class="modal-header" data-name="HGWCEVww">
                <h5 class="modal-title" id="resultTitle">{{trans('common.label.test_connection')}}</h5><button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="modelClose"></button>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="modelClose2"style="display: none;"></button>
            </div>
            <div class="modal-body" data-name="HgPtQlgv">
                <div class="row" data-name="pgTTSPPe">
                    <div class="col-md-12" data-name="sbLvkNEH">
                        <div id="chkContent" class="mt-checkbox-list" data-name="scekPCCn">
                            <div data-name="Orpjaumr">
                                {{ trans('sending_nodes.test_connection.connectivity_desc') }}
                            </div>
                            <br>

                            <div class="bulOptions kt-checkbox-list" data-name="ABLxlfcH">

                                <label class="kt-checkbox">
                                    <input type="checkbox" value="1" name="checknodes" id="chkAll">
                                    {{ trans('sending_nodes.test_connection.set_successful') }}
                                    <span></span>
                                </label>
                            </div>
                            <div class="bulOptions kt-checkbox-list" data-name="OkRtWaaw">    
                                <label class="kt-checkbox" style="margin-bottom: 0;">
                                    <input type="checkbox" value="2" name="checknodes" id="unchkAll">
                                    {{ trans('sending_nodes.test_connection.set_unsuccessful') }}
                                    <span></span>
                                </label>
                            </div>
                             <br>
                             <blockquote>
                            <p>{{ trans('sending_nodes.test_connection.note') }}</p>
                            </blockquote>
                             <br>

                            <button type="button" class="btn btn-success" onclick= "checkAllSMTPs();" id="checkAllCons">{{ trans('sending_nodes.test_connection.start') }}</button>
                        </div>
                        <div id="consResult"  class="form-group scroll scroll-300" data-name="MSLldNCN">
                            <table class="table table-hover table-condensed table-striped" id="tableResults">
                                <thead>
                                    <tr>
                                        <th>{{ trans('sending_nodes.test_connection.table_headings.name') }}</th>
                                        <th>{{ trans('sending_nodes.test_connection.table_headings.type') }}</th>
                                        <th>{{ trans('common.label.status') }}</th>
                                    </tr>
                                </thead>
                                <tbody id="SMTPStatus">
                                    
                                </tbody>
                            </table>

                           
                        </div>
                        <div class="row" id="cancle" style="display: none;" data-name="oWizYaCg">
                            <div class="col-md-12" data-name="aYIcrQRi">
                                <button type="button" class="btn btn-info" id="stopConn"> {{ trans('common.form.buttons.cancel') }} </button>
                            </div>
                        </div>
                        <div class="row" id="done" style="display: none;" data-name="QJzUqHIE">
                            <div class="col-md-12" data-name="UInwGhmo">
                                <button type="button" class="btn btn-success" data-dismiss="modal" aria-hidden="true" id="closeConn"> {{ trans('common.label.done') }} </button>
                                <span class="pull-right" id="entries">
                                    <a href="/storage/results.pdf" id="downloadResult" class="btn text-info" download>
                                        <i class="la la-cloud-download"></i> {{ trans('sending_nodes.test_connection.download_results') }}
                                    </a>
                                </span>

                            </div>
                        </div>
                    </div>
                </div>        
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-config" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="nAgLnKUa">
    <div class="modal-dialog modal-dialog-centered" role="document" data-name="yEaVgGLZ">
        <div class="modal-content" data-name="hONCgCho">
            <div class="modal-header" data-name="IhxLhfWi">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('sending_nodes.tab2.Edit_Configuration')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body" data-name="XRAGTfZE">
                <form action="" method="POST" id="config-edit" class="kt-form kt-form--label-right">
                    <div class="form-body" data-name="yPrlirfZ">
                        <div class="form-group row" data-name="YiKmLHSG">
                            <label class="col-form-label col-md-3">{{trans('sending_nodes.tab2.Server_Name')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-7" data-name="onvGBwGy">
                                <div class="input-icon right" data-name="clVKMrNc">
                                    <input type="text" name="name" id="server_name" class="form-control" value=""  /> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="kmODgiFE">
                            <label class="col-form-label col-md-3">{{trans('sending_nodes.tab2.Server_IP')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-7" data-name="KfXgmnZo">
                                <div class="input-icon right" data-name="nRwpyXpn">
                                    <input type="text" name="server_ip" readonly id="config_name" class="form-control" value=""  /> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="hHKIenGQ">
                            <label class="col-form-label col-md-3">{{trans('sending_nodes.tab2.Root_User')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-7" data-name="LxHqUeYT">
                                <div class="input-icon right" data-name="UtmVOfdc">
                                    <input type="text" name="username"  id="config_username" class="form-control" value="" /> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="qFUHhFRc">
                            <label class="col-form-label col-md-3">{{trans('sending_nodes.tab2.Password')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-7" data-name="FbHsQiqM">
                                <div class="input-icon right" data-name="ogNzitcC">
                                    <input type="password" name="password" id="config_password" class="form-control" value=""/> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="OOPAAGPf">
                            <label class="col-form-label col-md-3">{{trans('sending_nodes.tab2.SSH_Port')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-7" data-name="CWSGSHgx">
                                <div class="input-icon right" data-name="qtKvNUsg">
                                    <input type="text" name="host" class="form-control" id="config_port" value="" /> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="gtUFnyHa">
                            <label class="col-form-label col-md-3">{{trans('sending_nodes.tab2.Protocol')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-7" data-name="aOKZlfbE">
                                <div class="input-icon right" data-name="JaBFrmJa">
                                   <select class="form-control" id="protocol"> 
                                        <option value="http">{{trans('sending_nodes.tab2.http')}}</option>
                                        <option value="https">{{trans('sending_nodes.tab2.https')}}</option>
                                   </select>
                                </div>
                            </div>
                        </div> 
                    </div>
                    <div class="form-actions" data-name="blAlJVws">
                        <div class="row" data-name="FrfGUjQa">
                            <label class="col-form-label col-md-3"></label>
                            <div class="col-md-7" data-name="hWysVcxt">
                                <input type="hidden" name="pmta_id" id="pmta_id" class="form-control" value="" /> 
                                <button type="button" name="save_add" class="btn btn-success" id="saveConfig" value="save_add">{{trans('common.form.buttons.save')}}</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--begin::Modal-->
<div class="modal fade" id="kt_modal_4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="unYAdKHb">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" data-name="uQhTCUhi">
        <div class="modal-content" data-name="MJOLTgVp">
            <div class="modal-header" data-name="BqAOWpWB">
                <h5 class="modal-title" id="exampleModalLabel">@lang('sending_nodes.import.modal.title')</h5>
            </div>
            <div class="modal-body" data-name="DdYMbELV">
                <form id="importSmtp" action="" class="kt-form kt-form--label-left" enctype="multipart/form-data" novalidate="novalidate">
                    <div class="form-body" data-name="uWFUQHKq">


                          <div class="form-group" data-name="eCOMrJKw">
                            <label for="smtp-type" class="form-control-label">@lang('sending_nodes.import.modal.smtp_type')</label>
                            <div class="custom-file" data-name="bQDWQDVz">
                                <select name="smtp-type" id="smtp-type" class="form-control">
                                    <option value="smtp">{{trans('sending_nodes.index_blade.select_smtp_option')}}</option>
                                    <option value="gmail">{{trans('sending_nodes.index_blade.select_gmail_option')}}</option>
                                    <option value="outlook">{{trans('sending_nodes.index_blade.select_outlook_option')}}</option>
                                    <option value="aol">{{trans('sending_nodes.index_blade.select_aol_option')}}</option>
                                    <option value="yahoo">{{trans('sending_nodes.index_blade.select_yahoo_option')}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" data-name="GgemfgHx">
                            <label for="recipient-name" class="form-control-label">@lang('common.label.select_file')</label>
                            <div class="custom-file" data-name="umCDJchL">
                                <input type="file" name="file" class="custom-file-input" id="file">
                                <label class="custom-file-label" for="customFile">@lang('common.label.choose_file')</label>
                            </div>
                        </div>

                      

                        <div class="form-group" data-name="HfZDrOUU">
                            <a id="sample_file" href="{{url('downloadCSV/p=assets/files/samples/Sample.csv')}}" class="kt-font-success pull-left">@lang('sending_nodes.import.modal.download_sample')</a>
                            <button id="submit" type="button" class="btn btn-primary pull-right">@lang('common.form.buttons.submit')</button>
                        </div>
                    </div>
                </form>
                <div id="loader" data-name="CgMPylBc"><i class="fa fa-spin fa-spinner fa-lg"></i></div>
                <div id="consResult2" style="display: none;"  class="form-group" data-name="UMHQEQgU" >
                    <table class="table table-striped table-responsive" id="update-zone">
                        <thead>
                        <tr>
                            <th width="5%">@lang('sending_nodes.import.modal.table_headings.sr')</th>
                            <th width="20%">@lang('sending_nodes.import.modal.table_headings.name')</th>
                            <th width="5%">@lang('sending_nodes.import.modal.table_headings.import_status')</th>
                            <th width="70%">@lang('sending_nodes.import.modal.table_headings.errors')</th>
                        </tr>
                        </thead>
                        <tbody id="t_body">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" data-name="HkzlGjJg">
                <button type="button" onclick="hideImportModal()" class="btn btn-default" data-dismiss="modal">@lang('common.form.buttons.close')</button>
                <button style="display: none;" type="button" id="close_modal" class="btn btn-default" data-dismiss="modal">@lang('common.form.buttons.close')</button>
            </div>
        </div>
    </div>
</div>
<!--end::Modal-->

@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>

<script type="text/javascript">
    $('#module_list').on('click',function (){
        $.ajax({
            type: "POST",
            url: "{{route('nodeNewUi')}}",
            beforeSend:function ()
            {
                $(".blockUI").show();
            },complete: function () {
            $('.blockUI').hide();
            $('#meduleMsg').slideUp('slow');
        }
        });
    });
    var objTable;
    var record_type = 'our_records';
    function editConfig(pmta_id) {
            $.ajax({
              type: "POST",
              url: "{{ url('/') }}"+'/pmta/config/get_pmta_detail',
              data: { pmta_id : pmta_id}
            }).done(function( msg ) {
               $("#edit-config").modal("show");

               var obj = JSON.parse(msg);
               $("#server_name").val(obj["server_name"]);
               $("#config_name").val(obj["server_ip"]);
               $("#config_username").val(obj["server_username"]);
               $("#config_password").val(obj["server_password"]);
               $("#config_port").val(obj["ssh_port"]);
               $("#pmta_id").val(obj["pmta_id"]);
               $("#protocol").val(obj["protocol"]);

            })
        }

    $("body").on("change" , "#smtp-type" , function() { 
        if(this.value=="smtp") { 
            <?php $fileP = url('downloadCSV?p=assets/files/samples/Sample.csv'); ?>
            $('#sample_file').attr('href','<?php echo $fileP; ?>');
        } else { 
            <?php $fileP = url('downloadCSV?p=assets/files/samples/Sample_2.csv'); ?>
            $('#sample_file').attr('href','<?php echo $fileP; ?>');
        }
            
    });
    $("#smtp-type").change();
    $("body").on("click" , "#saveConfig" , function() { 
        var server_ip = $("#config_name").val();
        var server_username = $("#config_username").val();
        var server_password = $("#config_password").val();
        var server_name = $("#server_name").val();
        var ssh_port = $("#config_port").val();
        var protocol = $("#protocol").val();
        var pmta_id = $("#pmta_id").val();
        $.ajax({
            type: "POST",
            url: "{{ url('/') }}"+'/pmta/config/save_pmta_detail',
            data: { pmta_id : pmta_id,server_username:server_username,server_password:server_password,ssh_port:ssh_port,server_name:server_name,protocol:protocol}
        }).done(function( msg ) {
            Command: toastr["success"] ("{{trans('sending_nodes.index_blade.record_update_successfully_command')}}");
            location.reload();
        })
    });       

    $(document).ready(function() {

        $("#dontshow").click(function() {
            $(".blockUI").show();
            setTimeout(() => {
                $(".blockUI").hide();
                $("#meduleMsg").fadeOut("slow");
            }, 1000);
        });


            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Sending-Nodes");
        
        $(".m-select2").select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });

        $('#submit').on('click',function (e) {
            formId = '#importSmtp';
            route = "{{route('uploadFile')}}";
            method = 'POST';
            btn_id = 'submit';
            data = $(formId).serialize()+'&'+btn_id+'=1';
            var formData = new FormData();
            formData.append('file', $('#file')[0].files[0]);
            formData.append('duplicate', $('#duplicate').val());
            formData.append('smtp-type', $('#smtp-type').val());
            $.ajax({
                type: method,
                url: route,
                processData: false,
                contentType: false,
                data: formData,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#importSmtp').hide();
                    $('#loader').show();
                    $('.custom-file-input').removeClass('is-invalid');
                    $('.error').remove();
                    $('#error').hide();
                    $('#success').hide();
                },
                success: function (data) {
                    $('#loader').hide();
                    if (data.status==true) {
                        if(data.message!==undefined) {
                            $('#success').show();
                            $('#success').html(data.message);

                        }
                        if(data.string!==undefined) {
                            $('#t_body').append(data.string);
                            $('#consResult2').show();
                            $('#update-zone').DataTable({
                                "aoColumnDefs": [{"bSortable": false, "aTargets": [0,1,2,3]}],
                                "aaSorting": false,
                                dom: 'Bfrtip', buttons: [
                                    'excelHtml5',
                                    'csvHtml5'
                                ],
                                responsive: true,
                                fixedHeader: true,
                                paging: false
                            });
                            $('#importSmtp').hide();
                        }
                    }
                    else {
                        $('#importSmtp').fadeIn('slow');
                        if(data.status=='validation_failed')
                        {
                            var x;
                            var messages;
                            var id;
                            var error_span;
                            messages = data.messages;
                            for (x in messages) {
                                $('#'+x).addClass('is-invalid');
                                error_span = '<span id="'+x+'-error" class="help-block help-block-error invalid-feedback error">'+messages[x]+'</span>';

                                $('#'+x).after(error_span);
                                // id = '#'+x+'-error';
                                // $(id).html(messages[x]);
                                //$(id).css('display','block');
                            }
                        }
                        if(data.message!==undefined) {
                           /* $('#error').slideDown('slow');
                            $('#error').html(data.message);*/
                            if(data.status)
                            Command: toastr["success"] (data.message);
                            else
                                Command: toastr["error"] (data.message);
                        }
                    }
                    return false;
                }
            });
        });
    })
    $(document).ready(function() {

        $("#config-edit").validate({
            rules: {
                username: {
                    required: true
                },
                password: {
                    required: true
                },
                host: {
                    required: true
                },
                server_ip: {
                    required: true
                }
            }
        });

        $(".m-select2").select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });

        function repeat(){
            var content = jQuery('#sample_table tr'),
                size = jQuery('#tableResults >tbody >tr:last-child > td:first-child > span.sn').html(),
                count = ++size;
            element = null,
                element = content.clone();
            element.attr('id', 'row-'+size);
            element.appendTo('#tableResults>tbody');
            element.find('.sn').html(count);
        }

        function removeRow(){
            var id = jQuery("#tableResults tr").first();
            jQuery(id).remove();
        }

        $("#checkAllCons-d").click(function() {
            $(".blockUI").show();
            $("#modelClose").hide();
            $("#modelClose2").show();
            setTimeout(function() {
                $("#chkContent").css("display", "none");
                $("#chkContent").hide();
                $(".blockUI").hide();
                $("#consResult").show();
                $("#cancle").show();
            }, 1500);

            setTimeout(function() {
                $(".loader").hide();
                $("span.chck").show();
                $(".blockUI").show();
            }, 5000);

            setTimeout(function() {
                $(".blockUI").hide();
                repeat();
                $("#consResult").animate({
                    scrollTop: $('#consResult')[0].scrollHeight - $('#consResult')[0].clientHeight
                }, 1000);
                //$('#consResult').scrollTop($('#consResult')[0].scrollHeight);
            }, 6500);

            setTimeout(function() {
                $(".loader2").hide();
                $("span.chck2").show();
                $(".blockUI").show();
            }, 9500);

            setTimeout(function() {
                $(".blockUI").hide();
                $("#cancle").hide();
                $("#done").show();
            }, 11000);

        });

        function removeLastRows(){
            var i ;
            for(i=0 ; i < 10 ; i++ ){
                $('#tableResults tbody tr:last').remove();
            }
        }

        $("#closeConn, #modelClose2").click(function() {
            $("#consResult").hide();
            $("#chkContent").show();
            $("span.chck").hide();
            $("span.chck2").hide();
            $("span.loader").show();
            $("span.loader2").show();
            $("#done").hide();
            removeLastRows();
            var tTop = $( "#tableResults>thead>tr:first" );
            $('#tableResults').scrollTop(0);
            $('input:checkbox[name=checknodes]').attr('checked',false);
            $("#modelClose2").hide();
            $("#modelClose").show();
            location.reload();
        });
        $("#modelClose").click(function() {
            $('input:checkbox[name=checknodes]').attr('checked',false);
        });

         // function in master2 layout
        var page_limit=show_per_page('','smtp_pageLength',10);  // Params (table,page,default_limit=10)
        var smtpsTable;
        smtpsTable = $('#smtps').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,7]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[6, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": app_url + "/getSmtps?test={{$test}}",
            "fnServerParams": function (aoData) {
                aoData.push({"name": "typeFilter", "value": $("#typeFilter").val()});
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "pageLength" : page_limit,
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        page_limit=show_per_page(smtpsTable,'smtp_pageLength');
        objTable = smtpsTable;
        $(".status_filter").change(function () {
            smtpsTable.draw();
        });

  
        var pmmtaTable = $('#pmtas').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,5]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[4, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getPmtas') }}",
            "pageLength" : page_limit,
            "aLengthMenu": [[5, 10, 50], [5, 10, 50]]
        });

        $('#pmtas').on( 'length.dt', function ( e, settings, len ) {
            localStorage.setItem("pmta_pageLength" , len);
        });

    });

    function rollback(id) {
        if(confirm('Are you sure to delete all records.')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/pmta/rollback/'+id,
                type: "POST",
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

    function deletePmta(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/pmta/'+id,
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

    function smtpDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
          //  $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/node/'+id,
                type: "DELETE",
                success: function(result) {
                    if(result == 'delete') {
                        Command: toastr["success"] ("{{trans('common.message.delete')}}");
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                    else{
                        $('#assignedAssets').html(result.content);
                        $("#deleteMe").modal('show');
                        $("#itemToDelete").html('{!!trans('sending_nodes.delete_node.alert')!!}'.replace(':node',result.smtp));
                        $("#new_id").html(result.options);
                        $("#sm").html('{!!trans('sending_nodes.assign.to_other')!!}');
                        $("#unassignedAssets").show();
                        $("#moveToLabel").html(result.moveToLabel);
                        $('#mdlTitle').html(result.mdl_title);
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
            var smtps = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();

            $.ajax({
                type    : "Delete",
                url     : "{{ url('/') }}"+'/node/'+smtps,
                data    : {ids: smtps},
                success: function(result) {
                    if(result == 'delete') {
                        Command: toastr["success"] ("{{trans('common.message.delete')}}");
                        window.location.href = "{{ route('node.index') }}";
                    }
                    else{
                        $('#assignedAssets').html(result.content);
                        $("#deleteMe").modal('show');
                        $("#itemToDelete").html('{!!trans('sending_nodes.delete_node.alert')!!}'.replace(':node',result.smtp));
                        $("#new_id").html(result.options);
                        $("#sm").html('{!!trans('sending_nodes.assign.to_other')!!}');
                        $("#unassignedAssets").show();
                        $("#moveToLabel").html(result.moveToLabel);
                        $('#mdlTitle').html(result.mdl_title);
                    }
                }
            });

        }
    }
    $('#deleteItem').live('click',function (){
        new_id = $('#new_id').val();
        old_id = $('#old_id').val();
        $('#new_id-error').html('').hide();
        if(new_id=="")
            $('#new_id-error').html('select a domain').show();
        else{
            $.ajax({
                url: "{{ route('reAssignAndDeleteNode') }}",
                type: 'POST',
                data: {'old_id': old_id, 'new_id': new_id},
                success: function (result) {
                    if(result=='success')
                    {
                        toastr.success(result.content);
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                }
            });
        }

    });
    $('#new_id').live('change',function (){
        val =  $('#new_id').val();
        if(val=="")
            $('#deleteItem').hide();
        else
            $('#deleteItem').show();
    });
    function exportAll () {
        if(!$('input:checkbox:checked').length){
            alert('{{trans('common.message.alert_no_record')}}');
            return false;
        }
        var smtps = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type    : "POST",
            url     : "{{ route('node.export') }}/all",
            data    : {ids: smtps},
            success: function(result) {
                 window.location.href = "{{url('downloadCSV?p=storage/users/' . Auth::user()->id . '/files/smtps/')}}" +result;
            }
        });
    }

    function smtpErrors(id) {
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/node/errors',
            data    : {id: id},
            success: function(result) {
               // console.log(result);
                $('#smtp-error-data').html(result);
                $("#modal-smtp-failed").modal('show');
            }
        });
    }

    function smtpTest (val) {

        if(!$('input:checkbox:checked').length){
            alert('{{trans('common.message.alert_no_record')}}');
            return false;
        }
        else{
            $(".blockUI").show();
            var smtps = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();

            $.ajax({
                type    : "GET",
                url     : "{{ url('/') }}"+'/node/test',
                data    : {ids: smtps, value: val},
                success: function(result) {

                    $(".blockUI").hide();
                    $('#group-data').html(result);
                    $("#modal-smtp-test").modal('show');

                }
            });
        }
    }

    function testConnection (id) {
        $(".blockUI").show();
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/node/conntection/test/'+id,
            success: function(result) {

                $(".blockUI").hide();
                $('#group-data').html(result);
                $("#modal-smtp-test").modal('show');

            }
        });
    }
    function checkAllSMTPs() {
        $(".blockUI").show();
        $("#consResult").show();
        $i = 0;
        $active=0;
        $inactive = 0;
        if($("#unchkAll").is(":checked")) {
            $inactive = 1;
        }
        if($("#chkAll").is(":checked")) {
            $active = 1;
        }
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/node/check_all_smtps?limit=' + $i + "&active=" + $active + "&inactive=" + $inactive,
            success: function(result) {
                checkSmtps($i);
                $(".blockUI").hide();
                $('#SMTPStatus').html(result);
                $("#check-all-smtps").modal('show');
            }
        });
    }

    function checkSmtps($i) {
        $i++;
        $active=0;
        $inactive = 0;
        if($("#unchkAll").is(":checked")) {
            $inactive = 1;
        }
        if($("#chkAll").is(":checked")) {
            $active = 1;
        }


        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/node/check_all_smtps?limit=' + $i + "&active=" + $active + "&inactive=" + $inactive,
            success: function(result) {
                $(".blockUI").hide();
                $('#SMTPStatus').append(result);

                if(result == "") {
                    $("#done").show();
                    $("#chkContent").hide();
                    $("#downloadResult").hide();
                    $("#consResult").animate({
                        scrollTop: $('#consResult')[0].scrollHeight - $('#consResult')[0].clientHeight
                    }, 1000);
                    return false;
                }
                checkSmtps($i);
            }
        });
    }


    function makeCopies () {
        if(!$('input:checkbox:checked').length){
            alert('{{trans('common.message.alert_no_record')}}');
            return false;
        }
        var smtps = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/node/make_copy/'+smtps,
            data    : {ids: smtps},
            success: function(result) {
                window.location.href = "{{ route('node.index') }}";
            }
        });
    }

    function updateStatus (id, status) {
        $(".blockUI").show();
        $.ajax({
            type    : "PUT",
            url     : "{{ url('/') }}"+'/node/update-status/'+id+'/'+status,
            success: function(result) {
                $(".blockUI").hide();
                window.location.href = "{{ route('node.index') }}";
            }
        });
    }

    function changePmtaStatus(id , status) {
            $('.blockUI').show();
            var form_data = {
                id:id,
                status:status,
            };
            $.ajax({
                type   : "POST",
                url    : "{{ url('/') }}"+'/changePmtaStatus',
                data   : form_data,
                success: function(result) {
                    $('.blockUI').hide();
                    if(result == "success"){
                        Command: toastr["success"] ('{{trans('sending_nodes.index_blade.status_changed_successfully_command')}}');
                    }else{
                        Command: toastr["error"] ('{{trans('sending_nodes.index_blade.status_changed_failed_command')}}');
                    }
                }, 
                complete: function(result) { 
                    $('.blockUI').hide();
                }
            });
        }


    function importSmtp() {

        $("#modal-import-smtp").modal('show');

    }

    $("#modal-smtp-test").click(function(){
        window.location.href = "{{  route('node.index') }}";
    });

    function exportIt(id) {
        $.ajax({
            url: "{{ url('/') }}"+'/node/export/'+id,
            type: "GET",
            success: function(result) {
                
                window.location.href = "{{url('downloadCSV?p=storage/users/' . Auth::user()->id . '/files/smtps/')}}" +result;
            }
        });
    }
    function smtpStatus (type) {
        if(!$('input:checkbox:checked').length){
            alert('{{trans('common.message.alert_no_record')}}');
            return false;
        }
        var smtps = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type    : "GET",
            url     : "{{ url('/') }}"+'/node/status/'+smtps,
            data    : {ids: smtps , type: type},
            success: function(result) {
                window.location.href = "{{ url('/') }}"+"/nodes";
            }
        });
    }

    $('#next1').click(function() {
        $("#smtp-modal1").modal('hide');
        $("#smtp-modal2").modal('show');
    });
    $('#next2').click(function() {
        $("#smtp-modal1").modal('hide');
        $("#smtp-modal2").modal('hide');
        $("#smtp-modal3").modal('show');
    });
    $('#previous1').click(function() {
        $("#smtp-modal1").modal('show');
        $("#smtp-modal2").modal('hide');
        $("#smtp-modal3").modal('hide');
    });
    $('#previous2').click(function() {
        $("#smtp-modal2").modal('show');
        $("#smtp-modal1").modal('hide');
        $("#smtp-modal3").modal('hide');
    });

    <?php 
        $random_name = rand(1111, 999999);
    ?>
    function downloadConfigs (pmta_id) {
        $.ajax({
            type: "POST",
            url: "{{ URL::route('pmta.operation.store') }}",
            data: { action: 'export_configs',pmta_id:pmta_id,  random_name: <?php echo $random_name; ?>},
            success: function (result) {
                window.location.href = "{{ url('/pmta/download_config') }}" + "/" + <?php echo $random_name; ?>;
            }
        });
    }
    function showImportModal() {
        $('#importSmtp').show();
        $('#consResult2').hide();
        $('.mdl').trigger('click');
    }
    $('#close_modal').click(function() { 
        location.reload();
    });
    function hideImportModal() {
        table = $('#update-zone').DataTable();
        table.destroy();
        $('#t_body').html('');
        $('#close_modal').trigger('click');
    }
</script>
@include('includes.view-pages-filter-script')
@include('common.deleteAssetsModal')
@endsection