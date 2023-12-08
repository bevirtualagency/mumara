@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/segment-index.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/common.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    var objTable;
    var requests=[];
    var rows=[];
    var record_type = 'our_records';
    $(document).ready(function() {
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Lists/Segments");
        $(".m-select2").select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
         // function in master2 layout
         var page_limit=show_per_page('','segmentations_pageLength',10);  // Params (table,page,default_limit=10)
         var table =$('#spintag').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,1,4,5,7]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[6, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ route('segmentations.view') }}",
           createdRow: function( row, data, dataIndex ) {
                    if(parseInt(data.DT_impr)==1){
                     var params=$('#spintag').DataTable().ajax.params();
                     rows.push({rowIndex:dataIndex,params:params,id:data.DT_RowId.replace('row_','')});
                    }
            },
             "drawCallback": function( settings, json ) {
                callBack();
                rows=[];
            },
            "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                 aoData.push({"name": "record_type", "value": record_type});
                 aoData.push({"name": "clients", "value": $("#clients").val()});
                 aoData.push({"name": "admins", "value": $("#admins").val()});
             },
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
          page_limit=show_per_page(table,'segmentations_pageLength');
        objTable = table;
function callBack(){
    if(rows.length > 0 && requests.length<=0){
                      
                       var ids=[];
                       $.each(rows,function(i,val){
                        ids.push(val.id);
                       });
                       var data=rows[0].params;
                           data.row_ids=ids;
                        var request=$.ajax({
                            url: "{{route('segmentations.view') }}",
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
}
       

         $(document).on("click", ".view_class", function (event) {
             $("#all_lists").html("");
             var list_data = $(this).attr('data');
             var list_array = list_data.split(",");
             var html = '';
             $.each( list_array, function( key, value ) {
                html += '<div class="lists">'+value+'</div>';
            });
            $("#all_lists").html(html);
        });

        $(document).on("click", ".copyOptions", function (event) {

             $("#main_title_page").html("@lang('segments.copy.heading')");
             var have_global_selected=parseInt($(this).data('global'));
            if(have_global_selected==1){
                $('#frm-copy-move').hide();
                $('#show-alert-copy').show();
                $('#show-alert-move').hide();
            }else{
                $('#frm-copy-move').show();
                $('#show-alert-copy').hide();
                $('#show-alert-move').hide();
            }
        });
        $(document).on("click", ".moveOptions", function (event) {
             $("#main_title_page").html("@lang('segments.move.heading')");
              var have_global_selected=parseInt($(this).data('global'));
             if(have_global_selected==1){
                $('#frm-copy-move').hide();
                $('#show-alert-copy').hide();
                $('#show-alert-move').show();
            }else{
                $('#frm-copy-move').show();
                $('#show-alert-copy').hide();
                $('#show-alert-move').hide();
            }
        });
        
    });

    function paused(id) {
        $("#play-schedule-"+id).attr("style","display: none")
        $("#pause-schedule-"+id).removeAttr("style");
         $.ajax({
            url: "{{ url('/') }}"+'/segments/action/paused/'+id,
            type: "POST",
            success: function(result) {
                requests=[];
                 objTable.ajax.reload( null, false );
            }
        });
    }
    function processing(id) {
        $("#pause-schedule-"+id).attr("style","display: none")
        $("#play-schedule-"+id).removeAttr("style");
        $.ajax({
            url: "{{ url('/') }}"+'/segments/action/processing/'+id,
            type: "POST",
            success: function(result) {
                requests=[];
                 objTable.ajax.reload( null, false );
            }
        });
    }
    function canceled(id) {
        $.ajax({
            url: "{{ url('/') }}"+'/segments/action/canceled/'+id,
            type: "POST",
            success: function(result) {
                window.location.href = "{{ url('/') }}"+"/segments";
            }
        });
    }
    // expot contact lsit
        function stopExportSegment(segment_id) {
            if(confirm('{{trans('lists.contact_lists.export_stop.confirmation')}}')) {             
                $.ajax({
                    url: "{{ url('/') }}"+'/segments/cancelSegmentExport/'+segment_id,
                    type: "GET",
                    dataType:'json',                
                    success: function(result) {
                        if(result.status == 'success') {
                            Command: toastr["success"] (result.message);     
                            location.reload();
                        } else {
                            Command: toastr['error'] (result.message);
                        }
                    }
                });
            }
        }
    // delete segment
    function deleteSegment(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
           // $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ route('segments.destroy',"") }}"+'/'+id,
                    type: "DELETE",
                    success: function(result) {
                    if(result == 'delete') {
                        Command: toastr["success"] ('{{trans('common.message.delete')}}');
                        window.location.href = "{{ route('segments.index') }}";
                    }
                    else
                    {
                        console.log(result);
               /*         $('#domain-data').html(result.content);
                        $("#modal-domain-masking").modal('show');
                        $("#segmentTitle").html('"'+result.segment+'"?');*/

                        $('#assignedAssets').html(result.content);
                        $('#itemToDelete').html('{!! trans('segments.delete_segment.alert') !!}'.replace(':segment',result.segment));
                        $('#mdlTitle').html(result.mdl_title);
                        $("#deleteMe").modal('show');
                        $('.m-select2').select2();
                    }
                        //Command: toastr["error"] (result);
                }
                });
            }
    }
    $('#confirmDelete').live('click',function (){
        id = $('#old_id').val();
        new_id = $('#segment_id').val();
        $.ajax({
            url: "{{ route('segments.destroy',"") }}"+'/'+id,
            type: "DELETE",
            data :{'action':'shift_data','old_id':id,'new_id':new_id},
            beforeSend:function ()
            {
                $('.error').css('display','none');
                $('.blockUI').show();
            },
            success: function(result) {
                $('.blockUI').hide();
                if(result == 'delete') {
                    Command: toastr["success"] ('{{trans('common.message.delete')}}');
                    window.location.href = "{{ route('segments.index') }}";
                }
                else
                {
                    $('#domain-data').html(result.content);
                    $("#modal-domain-masking").modal('show');
                    $("#segmentTitle").html('{{trans('segments.delete_segment.alert')}}"'+result.segment+'"?');
                    $('.m-select2').select2()
                    $('#mdlTitle').html(result.mdl_title);
                }
                //Command: toastr["error"] (result);
            }
        });
    });
    // delete selected segment
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var segmentations = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ route('segments.destroy',"") }}"+"/"+segmentations,
                data    : {ids: segmentations},
                success: function(result) {
                    if(result == 'delete') {
                        Command: toastr["success"] ('{{trans('common.message.delete')}}');  
                        window.location.href = "{{ route('segments.index') }}";
                    }
                    else
                    {
                        $('#assignedAssets').html(result.content);
                        if(result.segmentCount>1){
                            $('#itemToDelete').html('{!! trans('segments.delete_segment.alert2') !!}'.replace(':segment',result.segment));
                        }else{
                            $('#itemToDelete').html('{!! trans('segments.delete_segment.alert') !!}'.replace(':segment',result.segment));
                        }
                        $("#deleteMe").modal('show');
                        $('.m-select2').select2();
                        $('#mdlTitle').html(result.mdl_title);
                    }
                }
            });
        }
    }
    // segment action
    function segmentAction (id, action, list_id,duplicate_action)
    {
        if(confirm('{{trans('common.message.alert_confirm')}}')) {

             if(action=='copy')
                route = '{{route('copySegmentToList')}}';
            else
                route = '{{route('moveSegmentToList')}}';
            $.ajax({
                url: route,
                type: "POST",
                data: 'action='+action+'&segment_id='+id+'&list_id='+list_id+'&duplicate_action='+duplicate_action,
                success: function(result) {
                    if(result=='limit_reached')
                    {
                        Command: toastr["error"]("{{trans('contacts.message.limit_exceeded')}}");
                    }
                   $.ajax({
                        url: "{{ url('segment/start_export') }}",
                        type: "GET",
                        success: function (data) { 
                            
                        }
                    });
                    setTimeout(() => {
                        window.location.href = "{{ url('/') }}"+"/segments";
                    }, 2000);
                  
                }
            });
        }else{
            $('#modal-copy-move').modal('hide');
        }
    }
    // submit copy segment form  
    $("#submit-btn").click(function () {
        var segment_id = $('#segment-id').val();
        var action = $('#segment-action').val();
        var list_id = $("#list-id option:selected").val();
        var duplicate_action = $("#duplicate_action option:selected").val();
        
        if (list_id != 0) {
            $("#msg-copy-move").html('<i class="fa fa-gear fa-spin"></i>');
            segmentAction(segment_id, action, list_id,duplicate_action);
            if (action == 'copy') {
                
            } else if (action == 'move') {
            }
        } else {
            $("#msg-copy-move").html('{{trans('common.message.alert_no_record')}}');
        }
    });

    function logHistory (id)
    {
        $.ajax({
            url: "{{ url('/') }}"+'/segments/log/history/'+id,
            type: "GET",
            success: function(result) {
                $('#tbody-data').html(result);
                $("#modal-log-history").modal('show');
            }
        });
    }
    // recount subscriber
    function recount(id)
    {
        $.ajax({
            url: "{{ route('segment.count') }}",
            data: {'id':id},
            type: "POST",
            dataTyep:'json',
            beforeSend: function () {
                $(".blockUI").show();
            },
            complete: function () {
                $(".blockUI").hide();
            },
            success: function(data) {
                location.reload();
            }
        });
    }
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())

<div id="msg" class="display-hide" data-name="qFtlYuuw">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="OBglobPx">
    <div class="col-md-12" data-name="LCEGDhuO">
    @if (Session::has('error-msg'))
    <div class="alert alert-danger" data-name="XpgruFPO">
        {!! Session::get('error-msg') !!}
    </div>
    @endif
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="ffPRmOgW">
            <div class="kt-portlet__body" data-name="tKCCPpHU">
                <div class="table-toolbar" data-name="UuhiVWSu">
                    <div class="form-group row" data-name="THRQUZyp">
                        <div class="col-md-12" data-name="UxjIjiDL">
                           @if (routeAccess('segment.add'))
                            <div class="btn-group" data-name="YBxZlCKV">
                                <a href="{{ route('segment.add') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i>  {{trans('common.form.buttons.add_new')}}
                                </button></a>
                            </div>
                           @endif
                          @if (routeAccess('segments.destroy'))
                           <div class="btn-group pull-right" data-name="jvUVAiSj">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}} </a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')
                <div class="table-relative">
                     @if($segments_limit > 0)
                    <div class="climit" data-name="GeOBtTDs">
                      
                        <button class="btn btn-label-warning btn-sm" id="contacts_limit">{{trans('segments.index_blade.segments_limit_button')}} {{$segments_count}} / {{$segments_limit}}</button>
                    </div>
                    @endif
                    <table class="table table-striped table-hover table-checkable responsive" id="spintag" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('segments.table_headings.id')}}</th>
                                <th>{{trans('segments.table_headings.name')}}</th>
                                <th>{{trans('segments.table_headings.created_by')}}</th>
                                <th>{{trans('segments.table_headings.type')}}</th>
                                <th>{{trans('segments.table_headings.contacts')}}</th>
                                <th>{{trans('segments.table_headings.creation_date')}}</th>
                                <th align="center">{{trans('segments.table_headings.actions')}}</th>
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

<div class="modal fade bs-modal-sm in" id="selected_lists" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="BzboJJCB">
    <div class="modal-dialog modal-sm" data-name="YWNQoieI">
        <div class="modal-content" data-name="eIawUnpo">
            <div class="modal-header" data-name="fioWZeok">
                <h5 class="modal-title">{{ trans('segments.select_lists') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-name="UoQGFfpW">
                <div class="row lists_row" data-name="PrInCMKT">
                    <div class="col-md-12" id="all_lists" data-name="VHSYxbUB">
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- copy & move modal -->
<div id="modal-copy-move" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="NhHvvplH">
    <div class="modal-dialog modal-lg" data-name="qNBheqOX">
        <div class="modal-content" data-name="sXTRiDnh">
            <div class="modal-header" data-name="blPRetDF">
                <h5 class="modal-title" id="main_title_page">{{trans('segments.modal-copy-move.modal_title')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-name="EjUEjwwk">
               <div id="show-alert-copy" style="display: none;" data-name="jqRvstuL">
                    <!-- <h5>@lang('segments.copy.heading')</h5> -->
                    <div class="alert alert-danger" data-name="VrSTyaCV">
                    <div class="alert-text" data-name="kYQnlakD">
                         @lang('segments.copy.error1')
                    </div>
                    </div>
                        <p> @lang('segments.copy.error2')</p>
                </div>
                <div id="show-alert-move" style="display: none;" data-name="cAtwIdhs">
                    <!-- <h5>@lang('segments.move.heading')</h5> -->
                     <div class="alert alert-danger" data-name="koLgjgAb">
                        <div class="alert-text" data-name="vRpAsyqO">
                         @lang('segments.move.error1')
                        </div>
                    </div>
                        <p> @lang('segments.move.error2')</p>
                 </div>
            <form action="" id="frm-copy-move" method="post" class="kt-form kt-form--label-left">
                <input type="hidden" name="segment_id" id="segment-id" value="" >
                <input type="hidden" name="segment_action" id="segment-action" value="" >
                <div class="form-group row" data-name="TZVfeRVx">
                    <label class="col-md-3 col-form-label" >
                        {{trans('segments.add_new.field.select_list')}}
                    </label>
                    <div class="col-md-9" data-name="wOYcLSjI">
                        <select class="form-control m-select2" data-placeholder="{{trans('segments.modal-copy-move.choose_group')}}" name="list_id" id="list-id">
                            @foreach($group_lists as $key => $group)
                                <optgroup label="{{$key}}">
                                    @foreach($group as $list)
                                    <option value="{{ $list['id'] }}">&nbsp;&nbsp;
                                    {{ $list['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row" data-name="ZVowKeLf">
                    <label class="col-md-3 col-form-label" >
                        {{trans('segments.modal-copy-move.duplicate')}}
                    </label>
                    </label>
                    <div class="col-md-9" data-name="lLdxPyid">
                        <select class="form-control m-select2" data-placeholder="{{trans('segments.modal-copy-move.duplicate_action')}}" name="duplicate_action" id="duplicate_action">
                            <option value="skip_existing" selected>  {{trans("common.form.buttons.skip")}}    </option>
                            <option value="overwrite_existing">      {{trans("common.label.overwrite")}}      </option>
                            <option value="update_existing">         {{trans("common.label.update")}}         </option>
                            <option value="delete_existing">         {{trans("common.form.buttons.delete")}}  </option>
                           
                        </select>
                    </div>
                </div>
                <div class="form-actions" data-name="fFSMSGUV">
                    <div class="" data-name="ibAkscvl">
                        <div class="col-md-9" data-name="vjTxljvR">
                            <label class="col-md-4 col-form-label"></label>
                            <button type="button" id="submit-btn" class="btn btn-success">{{trans('common.form.buttons.copy')}}</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.close')}}</button>
                            <span id="msg-copy-move" class="text-success"></span>
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- copy & move modal -->

<div id="modal-log-history" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="XYPrTKyH">
    <div class="modal-dialog modal-lg" data-name="PSvVaxNb">
        <div class="modal-content" data-name="CQvyjYBY">
            <div class="modal-body" data-name="pTgdDbgK">
                <div class="dataTables_wrapper no-footer" data-name="GMKmhNae">
                    <div id ="tbody-data" data-name="BlVlFRpp"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="modal-domain-masking" class="modal" role="dialog" aria-hidden="true" style="display: none" data-name="AUdTQEcj">
    <div class="modal-dialog" style="width: 600px;" data-name="ftnJWULQ">
        <div class="modal-content" data-name="Tfpoxxzs">
            <div class="modal-header" data-name="RakoFLbB">
                <h5 class="modal-title">{{trans('segments.segments')}}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="GumCidhJ">
                <div class="row" data-name="McKxUHSG">
                    <div class="col-md-12" data-name="knjPmWGU">
                        <span class="alert alert-danger" id="segmentTitle"></span>
                    </div>
                </div>
                <div class="row" data-name="GJHdnrZP">
                    <div class="col-md-12" data-name="MbCjrskL">
                        <div id="domain-data" data-name="kuTJVcqL"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('common.deleteAssetsModal')
@endsection