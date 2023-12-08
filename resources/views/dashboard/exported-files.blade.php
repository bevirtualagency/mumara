@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/export-list.css?v={{$local_version}}.01" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.plugin.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.countdown.js" type="text/javascript"></script>

<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Campaigns/Broadcasts");
        
         // function in master2 layout
        var page_limit=show_per_page('','campaign_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#campaigns').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,2,3,4,5,7]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[6, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ route('get.exported.files') }}",
            "pageLength" : page_limit,"fnServerParams": function (aoData) {
                
            },
             "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        objTable = table;
        page_limit=show_per_page(table,'campaign_pageLength'); 
    });
    // delete Campaign
    function deleteExportFile(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/tools/exported-files/'+id,
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
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
        var idsData = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type  : "POST",
            url   : "{{ route('delete.exported.all.file') }}",
            data    : {ids: idsData},
            success: function(result) {
                if(result == 'delete') {
                   location.reload();
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
<div class="alert alert-success" data-name="vjiqgzWI">
    {{ Session::get('msg') }}
</div>
@endif

<div id="msg" class="display-hide" data-name="xwBJqrix">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="cYpvQbCz">
    <div class="col-md-12" data-name="uHArZwwr">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="bVWOwzlA">
            <div class="kt-portlet__body" data-name="lSejTQCY">
                <div class="table-toolbar" data-name="ZUtVHfao">
                    @include('includes.view-pages-filter')
                    @if (routeAccess('delete.exported.all.file'))
                    <div class="form-group row" data-name="mLiXhZhM">
                        <div class="col-md-12" data-name="xlRhMNKf">
                           <div class="btn-group pull-right" data-name="hXNwBlhD">
                              
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('common.actions')}}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                              
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="la la-close"></i> {{trans('tools.exported_files.label.delete_all')}}  </a>
                                    </li>
                            
                                </ul>
                            </div>
                             
                        </div>
                    </div>
                    @endif
                    
                </div>
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="campaigns" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>                                                        
                                <th>{{trans('tools.exported_files.label.file_name')}}</th>
                                <th>{{trans('tools.exported_files.label.download')}}</th>
                                <th>{{trans('tools.exported_files.label.file_type')}}</th>
                                <th>{{trans('tools.exported_files.label.deleted_time')}}</th>
                                <th>{{trans('tools.exported_files.label.username')}}</th>
                                <th>{{trans('tools.exported_files.label.created_at')}}</th>
                                <th>{{trans('tools.exported_files.label.action')}}</th>
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
@endsection