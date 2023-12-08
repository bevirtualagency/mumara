@extends(decide_template())
@section('title', trans('lists.contact_lists.page.title'))
@php
    $authUser = getAuthUser();
@endphp
@section('page_styles')
<link href="/resources/assets/css/list-view.css?v={{$local_version}}.022" rel="stylesheet" type="text/css">
<style type="text/css">
table#lists tr td .dropdown {
    display: inline-block;
    float: none;
}
.btn-added {
    display: inline-block;
    float: left;
    position: relative;
    margin-left: 5px;
}
a.btn-icon-md {
    min-width: 31px !important;
}
#import-result table tr td:first-child {
    width: 220px;
    max-width: 200px;
    text-align: left;
}
</style>
@endsection

@section('page_scripts')
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript"></script>
    <script src="/themes/default/js/common.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/fnReloadAjax.js" type="text/javascript"></script>

@if ($list_view == 'tree')
<style>
    .dragrows{ cursor:move }
    #example-datatable .kt-checkbox > span {top: -9px !important; }
    table.treetable tbody tr td.kt-checkbox-inline {
        white-space: nowrap !important;
    }
    .kt-checkbox-inline .kt-checkbox {
        display: inline-block;
        margin-right: 0 !important;
        margin-bottom: 5px !important;
    }
    table#example-datatable {
        margin-top: 30px;
    }
</style>

<script type="text/javascript" src="/themes/default/js/gridtree/jquery.ui.core.js"></script>
<script type="text/javascript" src="/themes/default/js/gridtree/jquery.ui.widget.js"></script>
<script type="text/javascript" src="/themes/default/js/gridtree/jquery.ui.mouse.js"></script>
<script type="text/javascript" src="/themes/default/js/gridtree/jquery.ui.draggable.js"></script>
<script type="text/javascript" src="/themes/default/js/gridtree/jquery.ui.droppable.js"></script>
<script type="text/javascript" src="/themes/default/js/gridtree/jquery.treetable.js" ></script>
<script>
    
    function treeTable(){
      $(".tree").treetable({ expandable: true },true);
      // Highlight selected row
      $(".tree tbody").on("mousedown", "tr", function() {
            $(".selected").not(this).removeClass("selected");
            $(this).toggleClass("selected");
            $(this).toggleClass("selected");
            saveTreeState(1);
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
          accept: ".file",
          drop: function(e, ui) {

            var droppedEl = ui.draggable.parents("tr");

            drag_id =  droppedEl.attr('data-tt-id');
            drop_id =  $(this).attr('data-tt-id');

            drag_movable =  droppedEl.attr('data-tt-movable');
            drop_movable =  $(this).attr('data-tt-movable');

            directory_level =  $(this).attr('data-tt-root');

            var data_ttID = $(this).data("ttId");

            // .. directory not move and not accept file to drop
            if (drag_movable == 0 || (drop_movable == 0 && directory_level == 'root' && drag_id.indexOf("list") != -1) || (drag_id.indexOf("group") >= 0 && drop_id == 'group2')) {
              //  alert(drag_movable);
               // return;
            }
            $.ajax({
            type: "POST",
            url: "{{ url('/') }}"+"/list/tree/move",
            data: { action: "Move_List", drag_id: drag_id, drop_id : drop_id  },
                success: function(result) {
                    if (result.response == 'error'){
                        alert('' + result.list + '{{trans('lists.list.exist')}}'+ result.group +' ');
                        return false;
                    } else {
                        //$(".tree").treetable("move", droppedEl.data("ttId"), data_ttID);
                        window.location.href = "{{ route('list.index') }}";
                        //$('#example-datatable').Datatable().ajax().reload();
                    }
                }
            })
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
      <?php
    if(isset($list_tree_state) && count($list_tree_state) > 0 ) {
        foreach($list_tree_state as $group) { ?>
            if($(document).find('#<?php echo $group;?>').length>0){
             $('.tree').treetable("expandNode", '<?php echo $group;?>');;
            }
<?php }} ?> 
    }
setTimeout(function(){
 treeTable();   
},1000);
    

    function saveTreeState(val) {
        var expanded_list = new Array();
        $(".expanded[id^='group']").each(function(){
            expanded_list.push($(this).attr('id'));
        }) 
        $.ajax({
          type: "POST",
          url: "{{ url('/') }}"+"/list/tree/move",
          data: { action: "SAVE_TREE_STATE", expanded_list: expanded_list, val: val },
          success: function(result) {
            // need to execute 2 times because save the opened states
            if (result == '1') {
                saveTreeState(2);
            }
          }
        })
     }
     // edit group in tree view
     function editGroup(group_id) {
        $("#groupedit-"+group_id).css("display", "inline")
        $(".grouplabel-"+group_id).hide()
    }
    // cancel edit in tree view
    function cancelEdit(group_id) {
        $("#groupedit-"+group_id).hide()
        $(".grouplabel-"+group_id).show()
    }
    // update group in tree view
    function saveGroup(group_id) {
        new_group_label = $('#new_list_group_name_'+group_id).val();
        $.ajax({
          type: "POST",
          url: "{{ url('/') }}"+'/list/tree/move',
          data: {action: "SAVE_GROUP_LIST" , group_id : group_id, new_group_label : new_group_label}
        }).done(function( msg ) {
            Command: toastr["success"] ("{{trans('lists.contact_lists.message.success_group_saved')}}");
            $("#groupname-"+group_id).html("<strong>"+new_group_label+"<strong>")
            $("#groupedit-"+group_id).hide()
            $(".grouplabel-"+group_id).show()
        })
    }

    function deleteGroupList(group_id) {
        if(confirm('{{trans('lists.contact_lists.message.alert_delete_group')}}'))
        {
            $.ajax({
              type: "POST",
              url: "{{ url('/') }}"+'/list/tree/move',
              data: {action: "DELETE_GROUP_LIST" , group_id : group_id}
            }).done(function( msg ) {
                // console.log(msg);
                Command: toastr["success"] ("{{trans('lists.contact_lists.message.success_delete')}}"); 
                bulkActions();
            })
        }
    }
    // delete group in tree view
    function deleteGroup(group_id) {
        if(confirm('{{trans('common.message.alert_delete')}}'))
        {
            $.ajax({
              type: "POST",
              url: "{{ url('/') }}"+'/list/tree/move',
              data: {action: "DELETE_GROUP" , group_id : group_id}
            }).done(function( msg ) {
               // console.log(msg);
                window.location.href = "{{ route('list.index') }}";
                Command: toastr["success"] ("{{trans('lists.contact_lists.message.success_group_deleted')}}");
             
            })
        }
    }

    $('.group-selector-subscriber').click(function () {
        var group = this.id;
        if($(this).is(':checked')) {
            $('.group-subscriber-'+group).prop('checked', true);
        } else {
            $('.group-subscriber-'+group).prop('checked', false);
        }
    });
    
    // check/uncheck all checkbox
    $('[data-tt-parent-id="group0"] .checkbox-all-index-root:first').click(function () {
        if($(this).is(':checked')) {
            $('.checkbox-index').prop('checked', true);
        } else {
            $('.checkbox-index').prop('checked', false);
        }
    });
</script>
@endif
    <script>
        var objTable;
        var request;
        var record_type = 'our_records';
        let list_id_to_delete = null;
        $(document).ready(function() {
            $("a#help-article").css("display", "block");
            $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Lists/Contact-Lists");
            $('.m-select2').select2({
                templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
            });
            $("#all_lists").click(function() {
                //$(".blockUI").show();
                setTimeout(function(){
                    $(".bullData").hide();
                    $(".treeView").show();
                    //$(".blockUI").hide();
                }, 1000);
            });


            $(".optbulls").click(function(){
             
            });

            $(".blockUI").hide();
             var rows=[];
             var requests=[];
            // function in master2 layout
            var page_limit=show_per_page('','list_pageLength',10);  // Params (table,page,default_limit=10)
            objTable = $('#lists').dataTable({
                "aoColumnDefs": [{"bSortable": false, "aTargets": [0,4,{{$client?6:7}}]}],
                "bProcessing": true,
                "bServerSide": true,
                "aaSorting": [[{{$client?5:6}}, "desc"]],
                "sPaginationType": "full_numbers",
                "sAjaxSource": "{{ url('/getLists') }}",
                 createdRow: function( row, data, dataIndex ) {
                    if(parseInt(data.DT_impr)==1){
                     var params=$('#lists').DataTable().ajax.params();
                     rows.push({rowIndex:dataIndex,params:params,list_id:data.DT_RowId.replace('row','')});
                    }
                },
                  "drawCallback": function( settings, json ) {

                    if(rows.length > 0 && requests.length<=0){
                       var list_ids=[];
                       $.each(rows,function(i,val){
                        list_ids.push(val.list_id);
                       });
                       var data=rows[0].params;
                           data.list_ids=list_ids;
                        request=$.ajax({
                            url: "{{ url('getLists') }}",
                            type: "GET",
                            data:data,
                            success: function(result) {
                                var data=JSON.parse(result);
                                var retry=0;
                               $.each(data.aaData,function(i,val){
                                for (var key in val) {
                                    if (val.hasOwnProperty(key) && key !="DT_RowId" && key !="DT_impr") {
                                         $('#'+val.DT_RowId).find('td').eq(key).html(val[key]);
                                    }
                                } 
                                    if(parseInt(val.DT_impr)==1 ){
                                        retry++;
                                    }

                                }); 
                               if(retry >0 ){
                                var $this=this;
                                setTimeout(function(){
                                  $.ajax($this);
                                },3000);
                               }
                            }
                        });
                        requests.push(request);
                    }
                  rows=[];
                },
                "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
                },
                "pageLength" : page_limit,
                "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
            });

            page_limit=show_per_page(objTable,'list_pageLength');

             
           
            @if ($list_view == 'tree')
                $("#clients").change(function () {
                var clients=$("#clients :selected").map(function(i, el) {
                        return $(el).val();
                    }).get();
                var list=$('input.optbulls:checked').attr('id');
                $.ajax({
                    url: "{{  url('lists') }}/?list_view={{ $list_view }}&user_id="+clients+"&list="+list,
                    type: "GET",
                    data:{tree:1},
                    success: function(result) {
                        $("#list_tree").html(result);
                           treeTable();
                         
                    }
                });
            });
               
                @endif
            // split the contact list
            $("#frm-split-list").submit(function(){
                var form_data =  $("#frm-split-list").serialize();
                $.ajax({
                    url: "{{ URL::route('list.split') }}",
                    type: "POST",
                    data: form_data+'&confirm=0',
                    success: function(result) {
                        var obj = JSON.parse(result);
                        if (confirm(obj.msg) ) {
                            $("#split-processing").removeAttr("style", "display:none");
                            $.ajax({
                                url: "{{ URL::route('list.split') }}",
                                type: "POST",
                                data: 'confirm=1&list_id='+obj.list_id+'&contacts_per_list='+obj.contacts_per_list+'&no_of_lists='+obj.no_of_lists,
                                success: function(result) {
                                    $("#split-processing").attr("style", "display:none");
                                     window.location.href = "{{ route('list.index') }}";
                                }
                            });
                        }
                    }
                });
                return false;
            });
            // change the label on selecting split by option
            $('#split-by').on('change', function() {
                if (this.value == 'contacts') {
                    $('#label-input-split').html('{{trans('lists.contact_lists.actions.no_of_contacts_per_list')}}');
                } else {
                    $('#label-input-split').html('{{trans('lists.contact_lists.actions.no_of_contact_lists')}}');
                }
            });
        });
        // show deleting contact list modal
        function showDeleteModal(list_id,id) {
            if(id=="single"){
              $('#single').show();
              $('#double').hide();  
            }else{
               $('#single').hide();
               $('#double').show();  
            }
            
            list_id_to_delete = list_id;
            $('#soft_hard_delete_confirmation').modal('show');
        }


          // show deleting contact list modal
          function showDuplicateModal(list_id) {
             $("#duplicateListId").val(list_id);
            $('#duplicate_list_remove_modal').modal('show');
          }


          function hideDuplicateModal() {
              var delete_action = $("#duplicateSelection").val();
              var list_id_to_delete = $("#duplicateListId").val();
            $('#duplicate_list_remove_modal').modal('hide');
            duplicateList(list_id_to_delete, delete_action);
         }

          // delete list function
        function duplicateList(list_id, type=2) {
            $.post("{{ URL::route('list.duplicatelList') }}", {list_id, type},
                function(response){
                    if(response == 'success') {
                        Command: toastr["success"] ('{{trans('lists.task.background')}}');
                        
                    } else {
                        Command: toastr['error'] (response);
                    }
                }
            );
           
        }

        // delete list function
        $('#confirmDelete').live('click',function (){
            deleteList(list_id_to_delete, 3,'forcefully');
        });
        function deleteList(list_id, type=2,action=null) {
            $.ajax({
                type    : "post",
                url     : "{{ route('list.delList') }}",
                data    : {list_id, type,'action':action},
                beforeSend: function ()
                {
                    $(".blockUI").show();
                },
                success: function(response) {
                    $(".blockUI").hide();
                    $('#soft_hard_delete_confirmation').modal('hide');
                    if(response == 'success') {
                        Command: toastr["success"] ('{{trans('lists.contact_lists.message.success_delete')}}');
                        location.reload();
                    }
                    else
                    {
                        $('#assignedAssets').html(response.content);
                        $("#deleteMe").modal('show');
                        $("#itemToDelete").html('{!!trans('lists.delete_list.alert')!!}');
                        $('#mdlTitle').html(response.mdl_title);
                    }
                }
            });
           
        }

        function hideDeleteModal(delete_action=2) {
           // $('#soft_hard_delete_confirmation').modal('hide');
            deleteList(list_id_to_delete, delete_action);
        }
        // expot contact lsit
        function stopExportList (list_id) {
            if(confirm('{{trans('lists.contact_lists.export_stop.confirmation')}}')) {             
                $.ajax({
                    url: "{{ url('/') }}"+'/list/cancelExport/'+list_id,
                    type: "GET",
                    dataType:'json',                
                    success: function(result) {
                        if(result.status == 'success') {
                            Command: toastr["success"] (result.message);    
                        } else {
                            Command: toastr['error'] (result.message);
                       }
                       location.reload();
                        
                    }
                });
            }
        }
        var retryExport = 0;
        function retryExportList (list_id) {
            if(retryExport==0){
                retryExport = 1;
                $.ajax({
                        url: "{{ url('/') }}"+'/list/retryExport/'+list_id,
                        type: "GET",
                        dataType:'json',                
                        success: function(result) {
                            if(result.status == 'success') {
                                Command: toastr["success"] (result.message);    
                            } else {
                                Command: toastr['error'] (result.message);
                           }
                           retryExport = 0;
                           location.reload();
                        }
                    });
            }    
        }
        function exportList (list_id) {
        //   $("#modal-export-list").modal('show');
            Command: toastr["success"] ("{{trans('lists.contact_lists.actions.export_process_started')}}");
            $("#export-processing").removeAttr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/list/export/csv/'+list_id,
                type: "GET",
                success: function(result) {
                    if(result=='permission_error'){
                         Command: toastr["error"] ("{{trans('common.message.temp_permission')}}");
                    }else{
                        location.reload();
                    }
                    
                }
            });
            ///location.reload();
        }
        // delete the the selected record
        function deleteAll () {
            if(!$('input:checkbox:checked').length){
            alert('{{trans('common.message.alert_no_record')}}');
            return false;
            }
            if(confirm('{{trans('common.message.alert_delete')}}')) {
                var lists = $('input:checkbox:checked').map(function() {
                    return this.value;
                }).get();
                $.ajax({
                    type    : "Delete",
                    url     : "{{ url('/') }}"+'/list/'+lists,
                    data    : {ids: lists},
                    success: function(result) {
                                if(result == 'delete') {
                                    Command: toastr["error"] ("{{trans('lists.contact_lists.message.success_delete')}}");
                                    window.location.href = "{{ url('/') }}"+"/list";
                                }
                            }
                });
            }
        }
// recount the subscriber 
$(document).on('click','#reCountListSubscribers',function(){
    var list_ids = [$(this).data('id')];
    reCountListSubscribers(list_ids);
});
// function for recount subscriber 
function reCountListSubscribers(list_ids){
      if(!list_ids.length){
            alert('{{trans('common.message.alert_no_record')}}');
            return false;
            }
                $.ajax({
                    type    : "POST",
                    url     : "{{ url('list/reCountListSubscribers') }}",
                    data    : {list_ids: list_ids},
                    beforeSend: function() {
                        $(".blockUI").show();
                    },
                    success: function(result) {
                                if(result.success) {
                                    Command: toastr["success"] ('{{trans('common.message.success_operation')}}');
                                    location.reload();
                                }else{
                                   Command: toastr["error"] (result.msg);  
                                }
                                $(".blockUI").hide();
                            },
                    error: function(error) {
                           Command: toastr["error"] ('{{trans('common.message.went_wrong')}}'); 
                           $(".blockUI").hide(); 
                    }
                });
}
  
        function verifylist(list_id) {
            $('#verify-status_'+list_id).html('{{trans('common.message.verifying')}}...');
            $.ajax({
                type    : "post",
                url     : "{{ url('/') }}"+'/list/validate',
                data    : {list_id: list_id},
                success: function(result) {
                }
            });
        }
        // show move list modal
        function moveList(id)
        {
            $('#list_id').val(id);
            $.ajax({
                url: "{{ url('/') }}"+'/list/move/'+id,
                type: "GET",
                success: function (data) {
                    $('#group-name').html(data);
                    $("#modal-move-list").modal('show');
                }
            });
        }
        // submit move list form
        $("#frm-move-list").submit(function() {
            var form_data =  $("#frm-move-list").serialize();
            $.ajax({
                url: "{{ url('/') }}"+'/list/group/update',
                type: "POST",
                data: form_data,
                success: function(result) {
                    window.parent.scrollTo(0,0);
                    if(result == 'success'){
                        $("#modal-move-list").modal('hide');
                        $('#error-msg').hide();
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('lists.contact_lists.message.success_list_moved')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success ');
                        setTimeout(function(){
                            window.location.href = "{{ route('list.index') }}";
                            }, 1000);
                    } else if(result == 'error'){
                        $('#msg').hide();
                        $('#error-msg').css("display", "flex");
                        $('#error-msg').delay(3000).hide(1);
                        $('#error-text').html('{{trans('lists.contact_lists.message.alert_list_exists')}}');
                        $('#error-msg').removeClass('display-hide').addClass('alert alert-danger  ');
                    }
                }
            });
            return false;
        });
        // show modal for merge list
        function mergeList(id)
        {
            $('#list-id').val(id);
            $.ajax({
                url: "{{ url('/') }}"+'/list/merge/'+id,
                type: "GET",
            //   data    : {type: 'get'},
                success: function (data) {
                    $('#list-name').html(data.list);
                    $("#modal-merge-list #list-id-select").html(data.all_lists);
                    $("#list-id-select").select2("destroy");
                    $("#list-id-select").select2({
                templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
            });
                    $("#modal-merge-list").modal('show');
                }
            });
        }
        // form submit for merge list
        $("#frm-merge-list").submit(function(){
            var form_data =  $("#frm-merge-list").serialize();
                if (confirm('{{trans('lists.contact_lists.message.alert_merge')}}')) {
                    $("#merge-processing").removeAttr("style", "display:none");
                    $.ajax({
                        url: "{{ url('/') }}"+'/list/merge',
                        type: "POST",
                        data: form_data,
                        success: function(result) {
                            $("#merge-processing").attr("style", "display:none");
                            window.location.href = "{{ route('list.index') }}";
                        }
                    });
                }
            return false;
        });
        // function for copy list
        function copyList(id){

            $('#copy-listname').empty();
            $('#copy-list-id').val(id);
                $.ajax({
                    url: "{{ url('/') }}"+'/list/copy/'+id,
                    type: "GET",
                    data    : {type: 'get'},
                    success: function (result) {
                        if(result.status)
                        $('#copy-listname').html(result.response);
                        if(result.is_client) {
                            var html = '<span class="alert-text">{{trans('page_title.admin.on.client')}}: (<a href="javascript:;" target="_blank"><b>'+result.owner.name+'</b></a>, '+result.owner.id+')</span>';
                            $('#adminOnClient').empty();
                            $('#adminOnClient').html(html);
                            $('#adminOnClient').show();
                        }
                        else{
                            $('#adminOnClient').empty();
                            $('#adminOnClient').hide();
                        }
                    }
                });
        }
        // show and hide message on copy contact list modal
        $(".copy_contacts").click(function() {
            if($(this).val() == "Yes") { 
                $(".copyContacts").show();
            } else { 
                $(".copyContacts").hide();
            }
        });
        $("#btn-close").click(function(){
            window.location.href = "{{ route('list.index') }}";
        });
        // top bulk action function
        function bulkActions(){

            <?php  if ($list_view == 'list') { ?>

                if(!$('#lists tbody input:checkbox:checked').length){
                alert('{{trans('common.message.alert_no_record')}}');
                return false;
            }if($('#bulk_action option:selected').val() == ''){
                alert('{{trans('common.message.alert_no_action')}}');
                return false;
            }
            var type = $('#bulk_action option:selected').val();
            var lists = $('#lists tbody input:checkbox:checked').map(function() {
                    return this.value;
               }).get(); 
            <?php } else {  ?>
                if(!$('#example-datatable tbody input:checkbox:checked').length){
                    alert('{{trans('common.message.alert_no_record')}}');
                    return false;
                }if($('#bulk_action option:selected').val() == ''){
                    alert('{{trans('common.message.alert_no_action')}}');
                    return false;
                }
                var type = $('#bulk_action option:selected').val();
                var lists = $('#example-datatable tbody input:checkbox:checked').map(function() {
                        return this.value;
                }).get(); 
            <?php } ?>

               
             if(type=='delete_list')
                {
                    showDeleteModal(lists,'double');
                }else {
                        if(confirm('{{trans("lists.contact_lists.message.confirmation_message")}} '+ $('#bulk_action option:selected').text() +' for {{trans('lists.contact_lists.message.selected_lists')}}')) {

                            if(type=="reCountListSubscribers"){
                              reCountListSubscribers(lists);
                                return false;
                            }
                    
                            $.ajax({
                                type    : "GET",
                                url     : "{{ url('/') }}"+'/list/bulk/actions/'+lists,
                                data    : {ids: lists , action_type : type},
                                success: function(result) {
                                    if(result.status==false)
                                        Command: toastr["error"](result.message);
                                    else
                                        window.location.href = "{{ route('list.index') }}";
                                }
                            });
                    }

          }
            
           
        }
        // bottom bulk action function
        function bulkActions2()
        { 

             <?php  if ($list_view == 'list') { ?>

                if(!$('#lists tbody input:checkbox:checked').length){
                    alert('{{trans('common.message.alert_no_record')}}');
                    return false;
                }if($('#bulk_action2 option:selected').val() == ''){
                    alert('{{trans('common.message.alert_no_action')}}');
                    return false;
                }
                var lists = $('#lists tbody input:checkbox:checked').map(function() {return this.value;}).get();
                var type = $('#bulk_action2 option:selected').val();
            <?php } else {  ?>

                if(!$('#example-datatable tbody input:checkbox:checked').length){
                    alert('{{trans('common.message.alert_no_record')}}');
                    return false;
                }if($('#bulk_action2 option:selected').val() == ''){
                    alert('{{trans('common.message.alert_no_action')}}');
                    return false;
                }
                var lists = $('#example-datatable tbody input:checkbox:checked').map(function() {return this.value;}).get();
                var type = $('#bulk_action2 option:selected').val();
            <?php } ?>

              if(type=='delete_list')
                {
                    showDeleteModal(lists,'double');
                   
                }
                else {
                    if(confirm('{{trans('lists.contact_lists.message.confirmation_message')}} '+ $('#bulk_action2 option:selected').text() +' for {{trans('lists.contact_lists.message.selected_lists')}}')) {
                            $.ajax({
                                type    : "GET",
                                url     : "{{ url('/') }}"+'/list/bulk/actions/'+lists,
                                data    : {ids: lists , action_type : type},
                                success: function(result) {
                                    window.location.href = "{{ route('list.index') }}";
                                }
                            });
                        }
            }
        }

        function importSubscriberSummery(import_id, list_id, list_name) {

            $("#modal-import").modal("show");
            $("#progress-import").show();
            $("#list_name").html(list_name);
           

            $.ajax({
                type    : "GET",
                url     : "{{ url('/') }}"+'/list/import/summary',
                data    : {id: import_id},
                success: function(result) {
                    var obj = JSON.parse(result);
                    line_no = obj.line_no;
                    total_insert = parseInt(obj.total_insert);
                    duplicate_found = parseInt(obj.duplicate_found);
                    var overwritten = parseInt(obj.overwritten);
                    invalid_email = parseInt(obj.invalid_email);
                    total_records = obj.total_records;
                    user_id = obj.user_id;

                    if(line_no < total_records){
                         var imported = total_insert + duplicate_found + invalid_email+ overwritten;
                         var total_import = imported - duplicate_found - invalid_email - overwritten;
                         progress = Math.round((total_insert / total_records) * 100);
                        $(".progress-bar").width(progress + '%').html( progress + '%');
                        importSubscriberSummery(import_id, list_id);
                        $(".import-progress").html("{{trans('contacts.import.form.record_processed')}}: "+line_no);
                        $("#import-result").show();

                        $("#import-result").html("<table class='table table-striped table-hover table-checkable responsive mb0'>"+
                            "<tr><td>{{trans('common.import.normal.total_contacts')}}:</td><td>"+total_records+"</td></tr>"+
                            "<tr><td>{{trans('common.import.normal.imported_successfuly')}}:</td><td>"+total_insert+"</td></tr>"+
                            "<tr><td>{{trans('common.import.normal.duplicates')}}:</td><td>"+duplicate_found+"</td></tr>"+
                            "<tr><td>{{trans('common.import.normal.invalids')}}:</td><td>"+invalid_email+"</td></tr>"+
                            "<tr><td>{{trans('common.form.buttons.cancel')}}:</td><td>&nbsp;&nbsp; &nbsp;&nbsp;<a href='javascript:void(0)' onclick='cancelImport("+ import_id +",1,1)' class='btn btn-danger btn-xs'>{{trans('common.form.buttons.cancel')}}</a></td></tr>"+
                        "</table>");
                    }
                    else{
                        var style_duplicate_found=duplicate_found==0? "style='pointer-events:none;'":"";
                        var style_invalid_email= invalid_email==0 ? "style='pointer-events:none;'":"";
                        $(".progress-bar").width(100 + '%').html( 100 + '%');
                        $("#progress-import").hide();
                        $("#import-result").html("<table class='table table-striped table-hover table-checkable responsive mb0'>"+
                            "<tr><td>{{trans('common.import.normal.total_contacts')}}:</td><td>"+total_records+"</td></tr>"+
                            "<tr><td>{{trans('common.import.normal.imported_successfuly')}}:</td><td>"+total_insert+"</td></tr>"+
                            "<tr><td>{{trans('common.import.normal.duplicates')}}:</td><td>"+duplicate_found+"&nbsp;&nbsp;<a "+style_duplicate_found+" href='/downloadCSV?p=storage/users/" + user_id + "/files/imports/subscribers/" + import_id + "/"+import_id + "_duplicates_emails.csv' class='btn btn-info btn-xs pull-right'>{{trans('common.label.download')}}</a></td></tr>"+
                            "<tr><td>{{trans('common.import.normal.invalids')}}:</td><td>"+invalid_email+"&nbsp;&nbsp;<a "+style_invalid_email+" href='/downloadCSV?p=storage/users/" + user_id + "/files/imports/subscribers/" + import_id + "/"+import_id + "_invalid.csv' class='btn btn-info btn-xs pull-right'>{{trans('common.label.download')}}</a></td></tr>"+
                        "</table>");
                    } 
                }
            });
        }

            $("input[name='number_of_copies']").click(function () {
                if ($("#single-copy").is(":checked")) {
                    $("#copy-div").hide();
                } else {
                    $("#copy-div").show();
                }
            });
        // submit copy list form
        $("#frm-copy-list").submit(function(){
            var form_data =  $(this).serialize();
            $("#copy-processing").removeAttr("style", "display:none");
            $('#btn-copy').prop('disabled', true);

            $.ajax({
                url: "{{ url('/') }}"+'/list/copied',
                type: "POST",
                data: form_data,
                dataType: 'json',
                success: function(data) {
                    $('#copy_tbody').html('');
                    // if( parseInt(data.total_contacts) > 0)
                    if( false)
                    {
                        $('#mdl_header').show();
                        $('#frm-copy-list').hide();
                        $('#copy_table_div').slideDown('slow');
                        lists = data.lists;
                        contacts = data.total_contacts;
                        tr = '';
                        arr =[];
                        lists.forEach(function(obj) {
                            arr.push(obj.id);
                            progress = '<div class="progress progress-striped active" >\n' +
                                '<div id="progress_'+obj.id+'" class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>\n' +
                                '</div>';
                            tr += '<tr>';
                            tr += '<td>'+obj.name+'</td>';
                            tr += '<td id="contacts_'+obj.id+'">0/'+data.total_contacts+'</td>';
                            tr += '<td>'+progress+'</td>';
                            tr += '</tr>';
                        });
                        $('#copy_tbody').append(tr);
                        updateProgressBars(arr,contacts);
                    }
                    else {
                        if(data.status==false){
                            $('#btn-copy').prop('disabled', false);
                            $("#copy-processing").attr("style", "display:none");
                            Command: toastr["error"](data.message);
                        }
                        else {
                        $("#copy-processing").attr("style", "display:none");
                        Command: toastr["success"]("{{trans('lists.contact_lists.message.success_copied')}}");
                        setTimeout(function () {
                            window.location.href = "{{ route('list.index') }}";
                        }, 3000);
                        }
                    }

                },
                 error: function(data) {
                     $("#copy-processing").html('Error').show();
                     $('#btn-copy').prop('disabled', false);
                 }
            });
            return false;
        });

        function updateProgressBars(arr,contacts) {
            var new_arr = [];
            $.ajax({
                url: "{{ route('countContacts') }}",
                type: "POST",
                data: {'list_ids':arr,'contacts':contacts},
                dataType: 'json',
                success: function(data) {
                    if(data.result!==undefined)
                    {
                        data.result.forEach(function(obj) {
                        percent = obj.percent;
                        copied = obj.copied;
                        total = obj.total;
                        $('#progress_'+obj.id).css('width',percent+'%');
                        $('#progress_'+obj.id).text(percent+'%');
                        $('#contacts_'+obj.id).text(copied+'/'+total);
                        if(percent<100)
                            new_arr.push(obj.id);
                        else{

                        }
                        });
                        if(new_arr.length>0)
                            setTimeout(updateProgressBars(new_arr,contacts),1500)

                    }
                    else {
                    }

                }
            });
        }


        $(".m-select2").select2({
                templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
            });
        $("#user_records").click(function() {
            //$(".blockUI").show();
            $('#admin_lists').val('');
            setTimeout(function(){
                $(".bullData").show();
                $(".treeView").hide();
                $('#admin-list-filter').hide();
            }, 250);
            record_type = 'user_records';
            getTreeView(record_type,[]);

        });
        $("#our_records").click(function() {
            //$(".blockUI").show();
            $('#client_list').val('');
            setTimeout(function(){
                $(".bullData").hide();
                $(".treeView").show();
                $('#admin-list-filter').show();
            }, 250);
            record_type = 'our_records';
            getTreeView(record_type,[]);

        });


        $("#client_list").change(function(){
           var val = $('#client_list').val();
            getTreeView(record_type,[val]);

        });
        $("#admin_lists").change(function(){
            var val = $('#admin_lists').val();
            getTreeView(record_type,val);

        });

        function getTreeView(record_type,ids) {
            $.ajax({
                url: "{{route('getListTree')}}",
                type: "get",
                data: {'record_type':record_type,'ids':ids},
                dataType: 'json',
                beforeSend:function ()
                {
                    $(".blockUI").show();
                },
                success: function(data) {
                    $(".blockUI").hide();
                    if(data.status)
                    {
                        $('#list_tree').html(data.html);
                        setTimeout(function(){
                            treeTable();
                            },800)
                    }
                },error: function (jqXHR, exception) {
                    $(".blockUI").hide();
                   var msg = 'Uncaught Error.\n' + jqXHR.responseText;
                    Command: toastr["error"] (msg);
                }
            });
        }

    </script>
    @if ($list_view == 'list')
        @include('includes.view-pages-filter-script')
    @endif
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="DNwqMndk">
    {{ Session::get('msg') }}
</div>
@endif
@if (Session::has('error-msg'))
    <div class="alert alert-danger" data-name="AVajLFdZ">
        {{ Session::get('error-msg') }}
    </div>
@endif
<div id="msg" class="display-hide" data-name="GSuZiCys">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div id="msg-del" class="display-hide" data-name="GfrNQjdQ">
    <button class="close" data-close="alert"></button>
    <span id='del-msg-text'><span>
</div>
@php
    $canDeleteList = routeAccess('list.delList');
    $canDeleteContact = routeAccess('contact.destroy');
    $canUpdateContact = routeAccess('contact.edit');

@endphp
<div class="col-md-12" data-name="jAMaZmXZ">
    <div class="row" data-name="PagbBGMH">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="SmTVHjeR">
            <div class="kt-portlet__body" data-name="WGoPpGbM">
                <div class="table-toolbar" data-name="MoSsbLPm">
                    <button type="submit" onclick="bulkActions();" class="btn btn-success flmrmb"> {{ trans('lists.contact_lists.actions.go') }} </button>
                    <div class="row flmrmb minw260" data-name="yLGDZhNn">
                        <select name="bulk_action" id="bulk_action" class="form-control m-select2" data-placeholder="Select an Action">
                            <option value="">{{trans('lists.contact_lists.actions.select')}}</option>
                             @if($canDeleteList)
                            <option value="delete_list">{{trans('lists.contact_lists.actions.delete_lists')}}</option>
                            @endif
                            <option value="reCountListSubscribers">{{trans('lists.contact_lists.actions.reCountListSubscribers')}}</option>
                            @if($canUpdateContact)
                            <option value="update_confirmed">{{trans('lists.contact_lists.actions.mark_confirm')}}</option>
                            <option value="update_unconfirmed">{{trans('lists.contact_lists.actions.mark_unconfirm')}}</option>
                            <option value="update_html">{{trans('lists.contact_lists.actions.receive_html')}}</option>
                            <option value="update_text">{{trans('lists.contact_lists.actions.receive_text')}}</option>
                            <option value="convert_soft_active">{{trans('lists.contact_lists.actions.mark_soft_bounce_active')}}</option>
                            <option value="convert_hard_active">{{trans('lists.contact_lists.actions.mark_hard_bounce_active')}}</option>
                            <option value="convert_unsubscribe_active">{{trans('lists.contact_lists.actions.mark_unsubscribed_active')}}</option>
                            <option value="update_status_active">{{trans('lists.contact_lists.actions.contacts_status_to_ctive')}}</option>
                            <option value="update_status_inactive">{{trans('lists.contact_lists.actions.contacts_status_to_inctive')}}</option>
                            @endif
                            @if($canDeleteContact)
                            <option value="delete_contacts">{{trans('lists.contact_lists.actions.delete_lists_contacts')}}</option>
                            <option value="delete_soft_bounce">{{trans('lists.contact_lists.actions.delete_soft_bounced_contacts')}}</option>
                            <option value="delete_hard_bounce">{{trans('lists.contact_lists.actions.delete_hard_bounced_contacts')}}</option>
                            <option value="delete_suppressed">{{trans('lists.contact_lists.actions.delete_suppressed_contacts')}}</option>
                            <option value="delete_unsubscribed">{{trans('lists.contact_lists.actions.delete_unsubscribed_contacts')}}</option>
                            @endif
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="row" data-name="sFTsPOnl">
    <div class="col-md-12" data-name="bOjPwjDU">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="BFGKvGsN">
            <div class="kt-portlet__body" data-name="YdPwTWVn">
                <div class="table-toolbar" data-name="fUzYDAeg">
                    <div class="form-group row" data-name="DetMetjQ">
                        <div class="col-md-12" data-name="qVBrmdZX">
                            @if (routeAccess('list.create'))
                            <a href="{{route('list.create')}}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                </button>
                            </a>
                            @endif
                            <div class="pull-right" data-name="AjWCnWGd">
                               
                                <a href="{{route('list.index')}}?list_view=list" title="{{trans('lists.contact_lists.view.list_view')}}" class="btn btn-label-success btn-xs"> <li class="fa fa-list"></li>
                                </a>
                                &nbsp&nbsp
                                <a href="{{route('list.index')}}?list_view=tree" title="{{trans('lists.contact_lists.view.tree_view')}}" style="" class="btn btn-label-info btn-xs">
                                    <li class="fa fa-sitemap" style=""></li>
                                </a>
                             
                                &nbsp&nbsp
                            </div>
                        </div>

                    </div>

                    @if ($list_view == 'list')
                        @include('includes.view-pages-filter')
                    @endif
                </div>
                @if ($list_view == 'list')
                <table class="table table-striped table-hover table-checkable responsive" id="lists" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('lists.contact_lists.table_headings.list_name')}}</th>
                            <th>{{trans('lists.contact_lists.table_headings.group_name')}}</th>
                            <th>{{trans('lists.contact_lists.table_headings.subscribers')}}</th>
                            @if(!isClient(Auth::user()))
                                <th>{{trans('lists.contact_lists.table_headings.created_by')}}</th>
                            @endif
                            <th>{{trans('lists.contact_lists.table_headings.last_activity')}}</th>
                            <!-- <th>Verify</th> -->
                            <th>{{trans('lists.contact_lists.table_headings.created_on')}}</th>
                            <th>{{trans('lists.contact_lists.table_headings.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                @else

                    @include('includes.list-tree-filter')
                    <table  id="example-datatable"  class="table table-striped table-hover table-checkable responsive tree">
                        <thead>
                            <tr>
                                <th width="20%">{{trans('lists.contact_lists.table_headings.list_name')}}</th>
                                <th>{{trans('lists.contact_lists.table_headings.subscribers')}}</th>
                                @if(!isClient(Auth::user()))
                                    <th>{{trans('lists.contact_lists.table_headings.created_by')}}</th>
                                @endif
                                <th>{{trans('lists.contact_lists.table_headings.created_on')}}</th>
                                <th>{{trans('lists.contact_lists.table_headings.updated_on')}}</th>
                                <th class="text-left">{{trans('lists.contact_lists.table_headings.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody id="list_tree">
                        {!! $list_tree !!}
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
 
<div class="col-md-12" data-name="WuWLUrPN">
    <div class="row" data-name="fQRcEDyQ">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="aaNpJBiK">
            <div class="kt-portlet__body" data-name="yrninPME">
                <div class="row filter_bottom" data-name="FhVHsnmd">
                    <div class="col-md-4" data-name="xhbMOlIm">
                        <select name="bulk_action2" id="bulk_action2" class="form-control m-select2" data-placeholder="{{trans('lists.contact_lists.actions.select')}}">
                            <option value="">{{trans('lists.contact_lists.actions.select')}}</option>
                             @if($canDeleteList)
                            <option value="delete_list">{{trans('lists.contact_lists.actions.delete_lists')}}</option>
                            @endif
                            <option value="reCountListSubscribers">{{trans('lists.contact_lists.actions.reCountListSubscribers')}}</option>
                            @if($canUpdateContact)
                            <option value="update_confirmed">{{trans('lists.contact_lists.actions.mark_confirm')}}</option>
                            <option value="update_unconfirmed">{{trans('lists.contact_lists.actions.mark_unconfirm')}}</option>
                            <option value="update_html">{{trans('lists.contact_lists.actions.receive_html')}}</option>
                            <option value="update_text">{{trans('lists.contact_lists.actions.receive_text')}}</option>
                            <option value="convert_soft_active">{{trans('lists.contact_lists.actions.mark_soft_bounce_active')}}</option>
                            <option value="convert_hard_active">{{trans('lists.contact_lists.actions.mark_hard_bounce_active')}}</option>
                            <option value="convert_unsubscribe_active">{{trans('lists.contact_lists.actions.mark_unsubscribed_active')}}</option>
                            <option value="update_status_active">{{trans('lists.contact_lists.actions.contacts_status_to_ctive')}}</option>
                            <option value="update_status_inactive">{{trans('lists.contact_lists.actions.contacts_status_to_inctive')}}</option>
                            @endif
                            @if($canDeleteContact)
                            <option value="delete_contacts">{{trans('lists.contact_lists.actions.delete_lists_contacts')}}</option>
                            <option value="delete_soft_bounce">{{trans('lists.contact_lists.actions.delete_soft_bounced_contacts')}}</option>
                            <option value="delete_hard_bounce">{{trans('lists.contact_lists.actions.delete_hard_bounced_contacts')}}</option>
                            <option value="delete_suppressed">{{trans('lists.contact_lists.actions.delete_suppressed_contacts')}}</option>
                            <option value="delete_unsubscribed">{{trans('lists.contact_lists.actions.delete_unsubscribed_contacts')}}</option>
                            @endif
                        </select>
                    </div>
                    <button type="submit" onclick="bulkActions2();"  class="btn btn-success flmrmb"> {{ trans('lists.contact_lists.actions.go') }} </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- split list modal -->
<div id="modal-split-list" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="FZmAJhxs">
    <div class="modal-dialog" data-name="txROtNUd">
        <div class="modal-content" data-name="Ilhgirfe">
            <div class="modal-header" data-name="mVcKlhTd">
                <h5 class="modal-title">{{trans('lists.contact_lists.modal.split.title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="MMfNJLAx">
            <form action="" id="frm-split-list" method="post" class="kt-form kt-form--label-right">
                <input type="hidden" name="split_list_id" id="split_list_id" value="" >
                <div id='split-processing' style='display:none;' data-name="veMQCLNk">
                    <h4 class="process-block text-info"><i class='la la-gear fa-spin'></i> {{trans('lists.contact_lists.modal.merge.processing')}}...</h4>
                    <div class="alert alert-info" data-name="HeWtYbSL">{{trans('lists.contact_lists.modal.merge.processing_note')}}</div>
                </div>
                <div class="form-group row" data-name="fSPTFNEd">
                    <label class="col-md-3 col-form-label" >
                        {{trans('lists.contact_lists.modal.split.split_by')}}
                    </label>
                    </label>
                    <div class="col-md-7" data-name="IJRbuaLO">
                        <select class="form-control select" name="split_by" id="split-by">
                            <option value="contacts">
                                {{trans('lists.contact_lists.actions.no_of_contacts_per_list')}}
                            </option>
                            <option value="lists">
                                {{trans('lists.contact_lists.actions.no_of_contact_lists')}}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" data-name="UJcJFpRk">
                    <label class="col-md-3 col-form-label" id="label-input-split" >
                        {{trans('lists.contact_lists.actions.no_of_contacts_per_list')}}
                    </label>
                    <div class="col-md-7" data-name="USsZxQXJ">
                        <input type="text"  name="no_of_contacts" class="form-control" required>
                    </div>
                </div>
                <div class="form-actions" data-name="GQOcMJSe">
                    <div class="row" data-name="nRTdOsCM">
                        <div class="offset-md-3 col-md-7" data-name="VdNxexOo">
                            <button type="submit" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                            <button type="reset" class="btn btn-default">
                                {{trans('common.form.buttons.reset')}}
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- split list modal -->

<!-- move list modal -->
<div id="modal-move-list" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="FBZgnFKT">
    <div class="modal-dialog" data-name="fHFGPouW">
        <div class="modal-content" data-name="boaONCzu">
            <div class="modal-header" data-name="pBZcnjYd">
                <h5 class="modal-title">{{trans('lists.contact_lists.modal.move-list.move_list')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div id="error-msg" class="display-hide" data-name="oWonXFVZ">
                <span id='error-text' class="alert-text"><span>
            </div>
            <div class="modal-body" data-name="SrNRegLA">
                <form action="" id="frm-move-list" method="post" class="kt-form kt-form--label-right">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="list_id" id="list_id" value="" >
                    <div class="group-name" id="group-name" data-name="njxLhyGX"></div>
                    <div class="form-group row" data-name="SRaZgeQw">
                        <label class="col-form-label col-md-3">{{trans('lists.contact_lists.modal.move-list.choose_group')}}
                        </label>
                        <div class="col-md-7" data-name="EGNIcWUf">
                            <select class="form-control m-select2" name="group_id" id="group-id" required="">
                                <option value="">{{trans('lists.contact_lists.modal.move-list.choose_group')}}</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}">
                                    {{ $group->name  }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-actions" data-name="RaJvakaL">
                        <div class="row" data-name="EpyjvPvr">
                            <div class="offset-md-3 col-md-7" data-name="ZEGmokSG">
                                <button type="submit" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- move list modal -->

<!-- merge list modal -->
<div id="modal-merge-list" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="ArDlLbut">
    <div class="modal-dialog" data-name="byPhNGNN">
        <div class="modal-content" data-name="EvonaPNT">
            <div class="modal-header" data-name="mWIOevMu">
                <h5 class="modal-title">{{trans('lists.contact_lists.modal.merge.title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="cnTqQsqz">
            <form action="" id="frm-merge-list" method="post" class="kt-form kt-form--label-right">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="list_id" id="list-id" value="" >
                <div id='merge-processing' style='display:none;' data-name="TgFWhhtZ">
                    <h4 class="text-center text-info"><i class='la la-gear fa-spin'></i> {{trans('lists.contact_lists.modal.merge.processing')}}...</h4>
                    <div class="alert alert-info" data-name="rxFvsPki">{{trans('lists.contact_lists.modal.merge.processing_note')}}</div>
                </div>
                <div class="list-name" id="list-name" data-name="hhsGqkYl"></div>
                <div class="form-group row" data-name="fUteYuNo">
                    <label class="col-form-label col-md-3">{{trans('lists.contact_lists.modal.merge.into')}}
                    </label>
                    <div class="col-md-7" data-name="BxOxjGbj">
                        <select class="form-control m-select2" name="merge_to_list" id="list-id-select" required="">
                           
                        </select>
                    </div>
                </div>
                <div class="form-actions" data-name="kNQAGnIa">
                    <div class="row" data-name="dGiEtuTa">
                        <div class="offset-md-3 col-md-7" data-name="txvMUihB">
                            <button type="submit" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- merge list modal -->

<!-- copy list modal -->
<div id="modal-copy-list" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="srQDBgDP">
    <div class="modal-dialog" data-name="pXpaTeiZ">
        <div class="modal-content" data-name="kJAuErbW">
            <div id="mdl_header" class="modal-header" style="display: none;" data-name="ylwQenuh">
                <h5 class="modal-title">{{trans('lists.contact_lists.modal.copy-list.progress')}}</h5>
            </div>
            <div class="modal-body" data-name="JrAzWCpD">
                <div id="adminOnClient" class="alert alert-warning" style="display: none;" data-name="kveOWAxe">

                </div>
                <form action="" id="frm-copy-list" method="post" class="kt-form kt-form--label-right">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="list_id" id="copy-list-id" value="" >

                    <h4 id='copy-processing' class="kt-font-info text-center" style='display:none;'>
                        <i class='la la-gear fa-spin'></i> {{trans('lists.contact_lists.modal.copy-list.copying')}}...
                        {{--<div class="text-danger offset-md-4" data-name="FeWszXEA">{{trans('lists.contact_lists.modal.copy-list.copying_note')}}</div>--}}
                    </h4>

                    <div class="row" data-name="zkIVZUCl">
                        <div class="col-md-12" data-name="lNpTqTDY">
                            <div class="copy-listname" id="copy-listname" data-name="tIUQpOSW"></div>
                            <div class="alert alert-warning copyContacts" style="display:none" data-name="uuyInzJW">
                                {{trans('lists.contact_lists.modal.copy-list.copy_contacts')}}
                            </div>
                            <div class="form-group row mb1" id="copy-div" data-name="njUzuXpw">
                                <label class="col-form-label col-md-4">{{trans('lists.contact_lists.modal.copy-list.no_of_copies')}}</label>
                                <div class="col-md-7" data-name="liwfkKtK">
                                    <select class="form-control" name="copies_number">
                                        @for ($i = 1; $i <=30; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb1" id="copy-div" data-name="hwCIdqyS">
                                <label class="col-form-label col-md-4">{{trans('lists.contact_lists.modal.copy-list.copy_contacts_label')}}</label>
                                <div class="col-md-7" data-name="FcSjlYLu">
                                    <div class="kt-radio-inline" data-name="kSVgPyho">
                                        <label class="kt-radio">
                                            <input class="copy_contacts" type="radio" name="copy_contacts" value="Yes"> {{trans('common.form.buttons.yes')}}
                                            <span></span>
                                        </label>
                                        <label class="kt-radio">
                                            <input class="copy_contacts" type="radio" name="copy_contacts" checked value="No"> {{trans('common.form.buttons.no')}}
                                            <span></span>
                                        </label>

                                    </div>
                                </div>
                            </div>

                            <div class="row" data-name="aUtEPuFf">
                                <div class="offset-md-4 col-md-8" data-name="ISKopzhu">
                                    <button type="submit" class="btn btn-success" id="btn-copy">{{trans('lists.contact_lists.modal.copy-list.copy')}}</button>
                                    <button type="button" id="btn-close" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.close')}}</button>
                                </div>
                            </div>

                            <div id="copy_table_div" style="display: none;" data-name="JMxlHZCr">
                                <span style="display: none;"  class="spinner spinner_2"><i class="fa fa-spinner fa-spin"></i></span>
                                <div style="display: none;"   class="alert_msg alert alert-danger" data-name="RwmfFGCH"></div>
                                <div id="consResult"  class="form-group scroll scroll-300" data-name="aMVSpFhR">
                                    <table class="table table-striped table-bordered" id="copy_table">
                                        <thead>
                                        <tr>
                                            <th>List Name</th>
                                            <th>Contacts</th>
                                            <th>Progress</th>
                                        </tr>
                                        </thead>
                                        <tbody id="copy_tbody">

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- copy list modal -->

<div id="modal-import" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="SJIRZqJP">
    <div class="modal-dialog" data-name="QxnievMS">
        <div class="modal-content" data-name="msNRJTxw">
            <div class="modal-header" data-name="GnfxAXKe">
                <h5 class="modal-title">{{trans('lists.contact_lists.modal.import.import_history')}}</h5>
                <button type="button" class="close"  onclick="location.reload()" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="szNygNcN">
                <div id="progress-import" data-name="CpsLmXVL">
                    <div class="la la-asterisk fa-spin fa-2x kt-font-success" id="ajax-spinner" data-name="XUmpNqQW"></div>
                    <div id="ajax-spinner-text" data-name="kZWHUHJc">                                         {{trans('lists.contact_lists.modal.import.importing')}}... 
                        <strong><span id="list_name"></span></strong>
                    </div>
                    <div class="progress progress-striped" data-name="xZLkqCDm" >
                        <div class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%" data-name="ZEtbSqBc">0%</div>
                    </div>
                    <div class="import-progress" data-name="ynqTsjVx"></div>
                </div>
                <div id="import-result" data-name="qTjJavdH">

                </div>
            </div>
        </div>
    </div>
</div>

<!-- delete confirmation modal -->
<div id="soft_hard_delete_confirmation" class="modal" tabindex="-1" role="dialog" data-name="uAJPTpuN">
  <div class="modal-dialog" role="document" data-name="aKxgkNIr">
    <div class="modal-content" data-name="omRMNNUz">
      <div class="modal-header" data-name="HjfXTwol">
        <h5 class="modal-title"> {{trans('common.form.buttons.delete')}}</h5>
        <!-- <h5 class="modal-title"> {{trans('lists.contact_lists.modal.soft_or_hard_delete')}}</h5> -->
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" data-name="XTsosyvH">
        <!-- <p> {{trans('lists.contact_lists.modal.soft_or_hard_delete')}}?.</p> -->
        <div style="display: none;" id="single" class="alert alert-danger" data-name="HKtChiuO"><span class="alert-text">{{trans('lists.contact_lists.modal.delete.list')}}</span></div>
        <div style="display: none;" id="double" class="alert alert-danger" data-name="ptMRygnz"><span class="alert-text">{{trans('lists.contact_lists.modal.delete.selected_list')}}</span></div>
        <!-- <div id="double" class="alert alert-danger"><span class="alert-text">@lang('lists.contact_lists.message.soft_or_hard_delete')</span></div> -->
      </div>
      <div class="modal-footer" data-name="hRFgLVDG">
        <!-- <button type="button" onclick="hideDeleteModal(2)" class="btn btn-info">{{trans('lists.contact_lists.modal.soft_delete')}}</button> -->
        <button type="button" onclick="hideDeleteModal(3)" class="btn btn-danger">{{trans('common.form.buttons.delete')}}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
      </div>
    </div>
  </div>
</div>
<!-- delete confirmation modal -->


<!-- delete confirmation modal -->
<div id="duplicate_list_remove_modal" class="modal" tabindex="-1" role="dialog" data-name="EgczDZGa">
  <div class="modal-dialog" role="document" data-name="Jbjeyqya">
    <div class="modal-content" data-name="YoEMKaOl">
      <div class="modal-header" data-name="zXhKvfvT">
        <h5 class="modal-title"> {{trans('lists.dedupe_contact')}}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        </button>
      </div>
      <div class="modal-body" data-name="EVTuTJpC">
        <p> {{trans('lists.contact.contact_list')}} ?.</p>
        <select id="duplicateSelection" class="form-control">
        
            <option value="2">{{trans('lists.delete.all_contact_list')}}</option>
            <option value="1">{{trans('lists.delete.selected_contact_list')}}</option>
        </select> 
      </div>
      <input type="hidden" value="" id="duplicateListId">
      <div class="modal-footer" data-name="RYsAweko">
        <button type="button" onclick="hideDuplicateModal()" class="btn btn-info">{{trans('lists.dedupe')}}</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
      </div>
    </div>
  </div>
</div>
<!-- delete confirmation modal -->

<div id="modal-export-list" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="LmgXhnJJ">
    <i class="la la-spinner fa-spin fa-5x"></i> 
</div>

<div id="modal-list" class="modal" role="dialog" aria-hidden="true" style="display: none" data-name="MRzVuMhm">
    <div class="modal-dialog" style="width: 600px;" data-name="EIjPkZrR">
        <div class="modal-content" data-name="HsihRfTe">
            <div class="modal-header" data-name="rqnchfSj">
                <h5 class="modal-title">{{trans('lists.all_lists')}} 
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="KdANTqlh">
                <div class="row" data-name="tBJRSehz">
                    <div class="col-md-12" data-name="JWgWeezR">
                        <span class="alert alert-danger" id="listToDel"></span>
                    </div>
                </div>
                <div class="row" data-name="SDfogEZY">
                    <div class="col-md-12" data-name="ggfMthjy">
                        <div id="listData" data-name="yqslGUQd"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @include('common.deleteAssetsModal')
@endsection