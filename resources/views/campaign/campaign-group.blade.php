@extends('layouts.master2')

@section('title', trans('app.campaigns.title'))

@section('page_styles')
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>

<script>
   $(document).ready(function() {
    // function in master2 layout
        var page_limit=show_per_page('','groups-pageLength',10);  // Params (table,page,default_limit=10)
       var table= $('#groups').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[1, "asc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getGroupsBroadcasts') }}",
              "pageLength" : page_limit,
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
          page_limit=show_per_page(table,'groups-pageLength'); 
    }); 

    function deleteGroup(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $.ajax({
                url: "{{ url('/') }}"+'/broadcasts/group/'+id,
                type: "DELETE",
                success: function(result) {
                    if(result == 'delete') {
                        // console.log(result);
                        $("#row_"+id).attr("style", "display:none");
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');
                    }else{
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.group_used')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-danger ');
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
        var campaigns = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type  : "Delete",
            url   : "{{ url('/') }}"+'/broadcasts/group/'+campaigns,
            data    : {ids: campaigns},
            success: function(result) {
                if(result == 'delete') {
                    window.location.href = "{{ url('/') }}"+"/broadcasts/groups";
                }else{
                    $('#msg').css("display", "flex");
                    $('#msg-text').html('{{trans('common.message.group_used')}}');
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger ');   
                }
            }
    });

        }
    }

    function editGroup(id)
    {
        $.ajax({
        url: "{{ url('/') }}"+'/broadcasts/group/'+id+'/edit',
        type: "GET",
        contentType: false,
        success: function (data) {
            $('#group-data').html(data);
            $("#modal-campaign-group-edit").modal('show');
            }
        });
    }

    function settingGroup()
    {
        $.ajax({
        url: "{{ url('/') }}"+'/broadcasts/group/settings/',
        type: "GET",
        contentType: false,
        success: function (data) {
            $('#group-settings').html(data);
            $("#modal-campaign-group-settings").modal('show');
            }
        });   
    }

</script>

@endsection

@section('content')

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="eJApCXJY">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="NeYJpvla">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="DxrNWzcH">
    <div class="col-md-12" data-name="RUsUOPsD">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="SrcjeJLC">
            <div class="kt-portlet__body" data-name="Kalsnlrr">
                <div class="table-toolbar" data-name="aQeYwdbL">
                    <div class="row" data-name="BHJkQrAg">
                        <div class="col-md-12" data-name="fqADqGwY">
                            <div class="btn-group pull-right" data-name="mScvSeRD">
                                <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('common.form.buttons.tools')}}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                @if (rolePermission(91))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="la la-close"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                 @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-checkable responsive" id="groups" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('app.campaigns.view_groups.table_headings.group')}}</th>
                            <th>{{trans('app.campaigns.view_groups.table_headings.created_on')}}</th>
                            <th>{{trans('app.campaigns.view_groups.table_headings.actions')}}</th>
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
<div id="modal-campaign-group-edit" class="modal" role="dialog" aria-hidden="true" data-name="WJRlKmOk">
    <div class="modal-dialog" style="width: 500px;" data-name="axXeNwXc">
        <div class="modal-content" data-name="wfGOqWJL">
            <div class="modal-header" data-name="GrKlvNnz">
                <h5 class="modal-title">{{trans('app.campaigns.view_groups.group_edit')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="WzuyubIo">
                <form action="{{ route('campaign.updated') }}" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    
                    <div class="group-data" id="group-data" data-name="EzYZHDfr"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="modal-campaign-group-settings" class="modal" role="dialog" aria-hidden="true" data-name="VBJdKzvc">
    <div class="modal-dialog" style="width: 500px;" data-name="PbFoOndS">
        <div class="modal-content" data-name="vmyPGFax">
            <div class="modal-header" data-name="gQPDlDgz">
                <h5 class="modal-title">{{trans('app.campaigns.view_groups.group_setting')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="wmJLIRQe">
                <form action="" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    
                    <div class="group-settings" id="group-settings" data-name="DfWBNjJi"></div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection