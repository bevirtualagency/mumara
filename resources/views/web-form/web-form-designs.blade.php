@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/themes/default/css/lightgallery.css?v={{$local_version}}" rel="stylesheet">
<link href="/resources/assets/css/webform-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
<link href="/resources/assets/css/webfor-template-view.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/picturefill.min.js"></script>
<script src="/themes/default/js/lightgallery-all.min.js"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>


@include('includes.view-pages-filter-script')
<script>
   
    var objTable;
    var record_type = 'our_records';
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Web-Forms");

        var page_limit=show_per_page('','web_forms_pageLength',10);  // Params (table,page,default_limit=10)
        var table=$('#web_forms').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,1,2,4]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[0, "ASC"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ route('get.web.form.designs') }}",
            "pageLength" : page_limit,
             drawCallback: function(settings) {
                 $('.gallery').lightGallery();
            },
            "fnServerParams": function (aoData) {    
                aoData.push({"name": "record_type", "value": record_type});
                aoData.push({"name": "clients", "value": $("#clients").val()});
                aoData.push({"name": "admins", "value": $("#admins").val()});
        },
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]]
        });
         page_limit=show_per_page(table,'web_forms_pageLength');
         objTable = table;
         
    });
    
    function webformDesignDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/delete-web-form-design/'+id,
                    type: "DELETE",
                    success: function(result) {
                    if(result == 'delete') {
                        $('#msg').show();
                        $('#msg-text').html('{{trans('common.message.delete')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success display-show');
                        objTable.draw();
                    }
                }
                });
            }
    }
    

</script>
@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="xdFutVzs">
    {{ Session::get('msg') }}
</div>
@endif

@if (Session::has('error'))
<div class="alert alert-danger" data-name="jBashwjJ">
    {{ Session::get('error') }}
</div>
@endif

<div id="msg" class="display-hide" data-name="sdFsfVPt">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="nGwEQivl">
    <div class="col-md-12" data-name="xQEnqYLg">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="PRROOaVT">
            <div class="kt-portlet__body" data-name="zpsDKRXS">
                <div class="table-toolbar" data-name="ZFAwxcsx">
                    <div class="form-group row" data-name="iWdREVOu">
                        <div class="col-md-12" data-name="BtKXrmcs">
                           @if(routeAccess('form.create'))
                            <div class="btn-group" data-name="CIIwjeJb">
                                <a href="{{ route('create.web.form.design') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}} 
                                </button></a>
                            </div>
                           @endif                           
                        </div>
                    </div>
                </div>         
                @include('includes.view-pages-filter')
                <table class="table table-striped table-hover table-checkable responsive" id="web_forms" role="grid" >
                    <thead>
                        <tr role="row">
                            <th>{{trans('web_forms.web_form_design.name')}}</th>
                            <th>{{trans('web_forms.web_form_design.view_design')}}</th>
                            <th>{{trans('web_forms.web_form_design.default')}}</th>                            
                            <th>{{trans('web_forms.web_form_design.created_on')}}</th>
                            <th>{{trans('web_forms.web_form_design.action')}}</th>
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