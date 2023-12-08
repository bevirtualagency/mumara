@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/fbl-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
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
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Feedback-Loops");

        // function in master2 layout
        var page_limit=show_per_page('','fbl_pageLength',10);  // Params (table,page,default_limit=10)
        var table = $('#fbl').DataTable({
            "columnDefs": [{"bSortable": false, "aTargets": [0,6]}],
            "processing": true,
            "serverSide": true,
            "order": [[5, "desc"]],
            "pagingType": "full_numbers",
            "ajax": {"url":"{{ url('/getFbls') }}",
                "data": function ( d ) {
                    d.record_type = record_type;
                    d.clients = $("#clients").val();
                    d.admins = $("#admins").val();
                },},
            "pageLength" : page_limit,
            "lengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
         page_limit=show_per_page(table,'fbl_pageLength');
         objTable = table;
    });

    function fblDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: app_url+'/fbl/'+id,
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
            var fbls = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/fbl/"+fbls,
                data    : {ids: fbls},
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{ route('fbl.index') }}";
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
<div class="alert alert-success" data-name="tCrAxMHv">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="NeIWhUHS">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="XzaumYhO">
    <div class="col-md-12" data-name="beEBFYdR">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="ayPrAdQw">
            <div class="kt-portlet__body" data-name="qzeZpvAk">
                <div class="table-toolbar" data-name="DbPAEFvQ">
                    <div class="form-group row" data-name="NePozjFi">
                        <div class="col-md-12" data-name="idqIywjt">
                           @if(routeAccess('fbl.create'))
                            <div class="btn-group" data-name="gECOnhDe">
                                <a href="{{ route('fbl.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif
                                  @if(routeAccess('fbl.destroy'))
                           <div class="btn-group pull-right" data-name="BZbNgrMp">
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
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="fbl" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('fbl.table_headings.email')}}
                                <th>{{trans('fbl.table_headings.complaints')}}</th>
                                <th>{{trans('fbl.table_headings.status')}}</th>
                                <th>{{trans('fbl.table_headings.last_processed')}}</th>
                                <th>{{trans('fbl.table_headings.added_on')}}</th>
                                <th>{{trans('fbl.table_headings.actions')}}</th>
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