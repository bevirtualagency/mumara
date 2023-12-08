@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/campaign-view.css?v={{$local_version}}.023" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
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
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,5]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[4, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getBroadcasts') }}",
            "pageLength" : page_limit,"fnServerParams": function (aoData) {
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
    function deleteCampaign(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}"+'/broadcasts/'+id,
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
    // delete selected Campaign
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
            url   : "{{ url('/') }}"+'/broadcasts/'+campaigns,
            data    : {ids: campaigns},
            success: function(result) {
                if(result == 'delete') {
                   location.reload();
                }
            }
    });

        }
    }


    // function builder_selction() {
        
    //   var builder_selction=$('#builder_selction').val();
    //   if(!builder_selction)
    //     return;
    //     $.ajax({
    //         type  : "POST",
    //         url   : "{{ route('save_builder_selection') }}",
    //         data    : {builder_selction: builder_selction},
    //         beforeSend: function() {
    //              $(".blockUI").show(); 
    //         },
    //         success: function(result) {
    //             $(".blockUI").hide();
    //             if(result.success == 1) {
    //                setTimeout(() => {
    //                     location.reload();
    //                 }, 3000);
    //                Command: toastr["success"] (result.message);
    //             }else{
    //                Command: toastr["error"] (result.message);
    //             }
    //         },
    //         error: function() {
    //              $(".blockUI").hide(); 
    //         },
    // });

    // }
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('error'))
<div class="alert alert-danger" data-name="vjiqgzWI">
    {{ Session::get('error') }}
</div>
@endif
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
                    <div class="form-group row" data-name="mLiXhZhM">
                        <div class="col-md-12" data-name="xlRhMNKf">
                           @if (routeAccess('broadcasts.add'))
                            <div class="btn-group" data-name="hgQfEpVj">
                                <a href="{{ route('broadcasts.template') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                </button></a>
                            </div>
                           @endif
                          
                             @if (routeAccess('broadcasts.destroy'))
                           <div class="btn-group pull-right" data-name="hXNwBlhD">
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
                         <?php /*
                          <div class="builder_selction pull-right" data-name="hAQfEpWj" style="margin-right:10px;">
                           <select onchange="builder_selction();" class="form-control" id="builder_selction">
                               <option value="grapesjs">Select Campaign Builder</option>
                               <option value="grapesjs" {{ $builder_selction=='grapesjs' || $builder_selction=='' ? 'selected':'' }}>GrapesJs</option>
                               @if($is_builderjs_addon_active)
                               <option value="builderjs" {{ $builder_selction=='builderjs' ? 'selected':'' }}>BuilderJs</option>
                               @endif
                           </select>
                          </div>
                          */?>
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')
                <table class="table table-striped table-hover table-checkable responsive" id="campaigns" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('broadcasts.table_headings.name')}}</th>
                            <th>{{trans('broadcasts.table_headings.group')}}</th>
                            <th>{{trans('broadcasts.table_headings.subject')}}</th>
                            <th>{{trans('broadcasts.table_headings.added_on')}}</th>
                            <th>{{trans('broadcasts.table_headings.actions')}}</th>
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