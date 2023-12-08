@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/drip-group-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script>
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Campaigns/Drip-Campaigns");
        
        // function in master2 layout
        var page_limit=show_per_page('','View-Drip-Groups-pageLength',10);  // Params (table,page,default_limit=10)
       var table= $('#groups').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,4]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[3, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getDripsGroups') }}",
             'pageLength' : page_limit,
           "fnServerParams": function (aoData) {
               aoData.push({"name": "record_type", "value": record_type});
               aoData.push({"name": "clients", "value": $("#clients").val()});
               aoData.push({"name": "admins", "value": $("#admins").val()});
           },
            'aLengthMenu': [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        objTable = table;
        page_limit=show_per_page(table,'View-Drip-Groups-pageLength');
    });
    // delete drip group
    function groupDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
                $.ajax({
                    url: "{{ url('/') }}"+'/drip/group/delete/'+id,
                    type: "DELETE",
                    success: function(result) {
                        if(result == 'delete') {
                         //   console.log(id);
                            $("#row_"+id).attr("style", "display:none");
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.delete')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        }
                        else if(result == 'nodelete'){
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.trigger_used')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                        }
                        else{
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.drip_used')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                        }
                    }
                });
            }
    }
    // delete selected drip group
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var groups = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/drip/group/delete/"+groups,
                data    : {ids: groups},
                success: function(result) {
                    if(result == 'delete') {
                        location.reload();
                    }else{
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.trigger_used')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-danger');   
                    }
                }
            });
        }
    }
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="pOEAyCMn">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="UqTNjdGj">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="wOMqsGMI">
    <div class="col-md-12" data-name="hQFknPRZ">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="XhXvVokw">
            <div class="kt-portlet__body" data-name="RewPxNEx">
                <div class="table-toolbar" data-name="UszZzjYh">
                    <div class="form-group row" data-name="XLOqKwdo">
                        <div class="col-md-12" data-name="hnibZJPq">
                            @if (routeAccess('drips.group.create'))
                            <div class="btn-group" data-name="CFsCUzDK">
                                <a href="{{ route('drips.group.create') }}">
                                    <button id="sample_editable_1_new" class="btn btn-label-success">
                                        <i class="la la-plus"></i> {{trans('drip_campaigns.groups.page.add_group')}} 
                                    </button>
                                </a>
                            </div>
                               @endif
						@if (routeAccess('drips.create'))
                            <div class="btn-group" data-name="UGTxEaxO">
                                <a href="{{ route('drips.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('drip_campaigns.groups.page.add_new_drip')}} 
                                </button></a>
                            </div>
                         @endif
                            <div class="btn-group pull-right" data-name="vUhxtvFH">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                  @if (routeAccess('drips.destroy'))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                  @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')
                <table class="table table-striped table-hover responsive table-checkable" id="groups" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('drip_campaigns.groups.table_headings.name')}}</th>
                            <th>{{trans('drip_campaigns.groups.table_headings.drip_count')}}</th>
                            <th>{{trans('drip_campaigns.groups.table_headings.created_date')}}</th>
                            <th>{{trans('drip_campaigns.groups.table_headings.actions')}}</th>
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
@endsection