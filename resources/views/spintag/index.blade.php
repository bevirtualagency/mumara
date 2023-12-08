@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/spintags-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Campaigns/Spintags");
        
// function in master2 layout
        var page_limit=show_per_page('','spintag_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#spintag').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,3]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[2, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getSpintags') }}",
            "pageLength" : page_limit,
            "fnServerParams": function (aoData) {
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
            },
            "aLengthMenu": [[10, 50, 100, 500], [10, 50, 100, 500]]
        });
        objTable = table;
        page_limit=show_per_page(table,'spintag_pageLength');
    });
    // delete spintag
    function deleteSpintag(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/spintag/'+id,
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
    // delete selected spintag
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
        var spintags = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
            type    : "Delete",
            url: "{{ url('/') }}"+'/spintag/'+spintags,
            data    : {ids: spintags},
            success: function(result) {
                            if(result == 'delete') {
                                window.location.href = "{{route('spintag.index')}}";
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
<div class="alert alert-success" data-name="vImslclh">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="MMdZaaxz">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="WcNBieyo">
    <div class="col-md-12" data-name="XmpxcKeQ">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="JHBkYrYy">
            <div class="kt-portlet__body" data-name="ryjVLgtd">
                <div class="table-toolbar" data-name="slIdLFad">
                    <div class="form-group row" data-name="rVNLHXmd">
                        <div class="col-md-12" data-name="ZsiERIPI">
                           @if(routeAccess('spintag.create'))
                            <div class="btn-group" data-name="xZOwbdmu">
                                <a href="{{ route('spintag.create') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                            @endif
                             @if(routeAccess('spintag.destroy'))
                            <div class="btn-group pull-right" data-name="moCsUQYT">
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
                    <table class="table table-striped table-hover table-checkable" id="spintag" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('spintags.table_headings.tag')}}</th>
                                <th>{{trans('spintags.table_headings.added_on')}}</th>
                                <th>{{trans('spintags.table_headings.actions')}}</th>
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