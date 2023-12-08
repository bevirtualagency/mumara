@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/splittest-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<!--begin::Page Vendors(used by this page) -->
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script>
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Campaigns/Split-Tests");
        
        // function in master2 layout
        var page_limit=show_per_page('','split_tests_pageLength',10);  // Params (table,page,default_limit=10)
       var table= $('#split_tests').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,1,3,6]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[5, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getSplitTests') }}",
            "pageLength" : page_limit,
           "fnServerParams": function (aoData) {
               aoData.push({"name": "record_type", "value": record_type});
               aoData.push({"name": "clients", "value": $("#clients").val()});
               aoData.push({"name": "admins", "value": $("#admins").val()});
           },
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        page_limit=show_per_page(table,'split_tests_pageLength');
        objTable = table;
    });
    // delete split test
    function splittestDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/splittest/'+id,
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
    // delete selected split test
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var split_tests = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/splittest/"+split_tests,
                data    : {ids: split_tests},
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{route('splittest.index')}}";
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
<div class="alert alert-success" data-name="BnDbWJgT">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="NZNmcHMa">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="eURmHzjQ">
    <div class="col-md-12" data-name="jrkLaHju">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="yARwkiSK">
            <div class="kt-portlet__body" data-name="slYfIKke">
                <div class="table-toolbar" data-name="HYXASEzj">
                    <div class="form-group row" data-name="wfqkCpuj">
                        <div class="col-md-12" data-name="vUHQrjLq">
                           @if (routeAccess('splittest.create'))
                            <div class="btn-group" data-name="KTleGZpR">
                                <a href="{{ route('splittest.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                           @if (routeAccess('splittest.destroy'))
                            <div class="btn-group pull-right" data-name="TeNRDlyV">
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
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="split_tests" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('split_tests.table_headings.id')}}</th>
                                <th>{{trans('split_tests.table_headings.name')}}</th>
                                <th>{{trans('split_tests.table_headings.based_on')}}</th>
                                <th>{{trans('split_tests.table_headings.type')}}</th>
                                <th>{{trans('split_tests.table_headings.added_on')}}</th>
                                <th>{{trans('split_tests.table_headings.actions')}}</th>
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