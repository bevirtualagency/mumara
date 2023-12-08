@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/dynamic-content-tags-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Campaigns/Dynamic-Content-Tags");
        
        // function in master2 layout
        var page_limit=show_per_page('','dynamic_content_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#dynamic-content').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getDynamicContents') }}",
            "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        objTable = table;
        page_limit=show_per_page(table,'dynamic_content_pageLength');
    });
    // delete Dynamic Content Tags
    function contentDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/dynamictag/'+id,
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
    // delete selected Dynamic Content Tags
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var dynamic_content = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/dynamictag/"+dynamic_content,
                data    : {ids: dynamic_content},
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{route('dynamictag.index')}}";
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
<div class="alert alert-success" data-name="LuVxkEHx">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="znmUMPmB">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="PdftqkBI">
    <div class="col-md-12" data-name="vIUlmmBQ">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="ZEdqjGCy">
            <div class="kt-portlet__body" data-name="EtanMTDZ">
                <div class="table-toolbar" data-name="EvduZWcD">
                    <div class="form-group roww" data-name="KPPPDikY">
                        <div class="col-md-12" data-name="UNMHheeu">
                           @if(routeAccess('dynamictags.create'))
                            <div class="btn-group" data-name="tipwEtVA">
                                <a href="{{ route('dynamictag.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                            @if(routeAccess('dynamictags.destroy'))
                           <div class="btn-group pull-right" data-name="pXbTlxgE">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                              
                                </ul>
                            </div>
                               @endif
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')
                <table class="table table-striped table-hover table-checkable responsive" id="dynamic-content" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('dynamictags.table_headings.dynamic_tag')}}</th>

                            <th>{{trans('dynamictags.table_headings.added_on')}}</th>
                            <th>{{trans('dynamictags.table_headings.actions')}}</th>
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