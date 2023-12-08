@extends('layouts.master2')

@section('title', trans('app.sidebar.triggers'))

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/triggers-index.css?v={{$local_version}}.01">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Actions/Triggers");
        
        
        $('#spintag').dataTable({

            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2,4]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[3, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getTriggers') }}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]],
            "initComplete": function(settings, json) {
                setTimeout(function(){ $(".make-switch").bootstrapSwitch() }, 100);
            }
        });

    }); 
    $(document).on('click','.sorting_desc,.sorting_asc',function(){
        setTimeout(function(){ $(".make-switch").bootstrapSwitch() }, 500);
    });
    function deleteTrigger(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/trigger/'+id,
                    type: "DELETE",
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

    function changeStatus(id) {
    
        $.ajax({
            url: "{{ url('/') }}"+'/trigger/status/'+id,
            type: "GET",
            success: function(result) {
            if(result == 'success') {
               // console.log('success');
            }
            else{
               // console.log(result);
            }
           }
        });
       
    }

    function deleteAll () {
        if(!$('input:checkbox[name=ids]:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
        var ids = $('input:checkbox[name=ids]:checked').map(function() {
            return this.value;
        }).get();

        $.ajax({
            type    : "Delete",
            url: "{{ url('/') }}"+'/trigger/'+ids,
            data    : {ids: ids},
            success: function(result) {
                if(result == 'delete') {
                    window.location.href = "{{ url('/') }}"+"/trigger";
                }
            }
          });

        }
    }

 function changeState(id) {

    $.ajax({
        type   : "GET",
        url    : "{{ url('/') }}"+'/trigger/status/'+id,
        success: function(result) {
           if(result == "success"){
              alert("{{trans('app.actions.triggers.alert_success')}}");
           }else{
              alert("{{trans('app.actions.triggers.alert_failed')}}");
           }
        }
    });
 }
</script>
@endsection

@section('content')

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="pvXtyygu">
    {{ Session::get('msg') }}
</div>
@endif

<div id="msg" class="display-hide" data-name="cOJjiEQG">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="eDmfbpmp">
    <div class="col-md-12" data-name="FPgTiNTZ">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="IgMYUQeq">
            <div class="kt-portlet__body" data-name="sFmIIeMg">
                <div class="table-toolbar" data-name="MlBmyAmm">
                    <div class="form-group row" data-name="gpreHKdt">
                        <div class="col-md-12" data-name="ymDiAGCG">
                           @if(routeAccess('trigger.create'))
                            <div class="btn-group" data-name="GGOCwhBY">
                                <a href="{{ route('trigger.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="fa fa-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                           @if(routeAccess('trigger.destroy'))
                           <div class="btn-group pull-right" data-name="YDHHcLwg">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('common.form.buttons.tools')}}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class="kt-font-brand"> <i class="la la-close kt-font-brand"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="table-responsive" data-name="eQyFdjKx">
                    <table class="table table-striped table-hover table-checkable responsive" id="spintag" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('app.dashboard.lang.name')}}</th>
                                <th>{{trans('app.dashboard.lang.status')}}</th>
                                <th>{{trans('app.dashboard.lang.added_on')}}</th>
                                <th>{{trans('app.dashboard.lang.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="myid">
                        </tbody>        
                    </table>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

@endsection