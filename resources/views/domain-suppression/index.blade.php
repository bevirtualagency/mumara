@extends(decide_template())
@section('title', trans('suppression.domain.page.title'))

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/subscriber-import.css?v={{$local_version}}.02">
<link rel="stylesheet" type="text/css" href="/resources/assets/css/email-suppression.css?v={{$local_version}}.021">
<style type="text/css">
    #import-id-error {
        display: none !important;
    }
    .exportAll{
        margin-left: 12px;
    }
    #modal-domain-suppression {
        z-index: 9999;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script>
    // set variable
    var token = "{{ csrf_token() }}";
    var form_error = "{{trans('common.message.form_error')}}";
    var preparing_file = "{{trans('common.message.preparing_file')}}";
    var closeButtonLabel = "{{trans('common.form.buttons.close')}}";
    var local_infile_message = '{!! trans('common.message.local_infile') !!}';
    var delete_all_files = "{{ trans('suppression.message.delete_all_files') }}";
    var import_operation_aborted = "{{ trans('common.message.import_operation_aborted') }}";
    var import_operation_success = "{!!trans('suppression.message.import_operation_success') !!}";
    var objTable;
    var record_type = 'our_records';
    var step = 1;
    var max_file = <?php echo $max_file = (file_upload_max_size() / 1024) / 1024; ?>;
    var doUploadUrl = "{{ route('doUpload') }}";
    var createImportUrl = "{{ route('createImport') }}";
    var csvSplitUrl = '{{ route("csvSplit") }}';
    var gettingDuplicatesUrl = '{{ route("gettingDuplicates") }}';
    var checkImportProcessUrl = '{{ route("checkImportProcess") }}';
    var cancelSuppressionUrl = '{{ route("cancelSuppression") }}';
    // Rocket import html labels
    var total_records_label_rocket = "{{trans('common.import.rocket.total_contacts')}}";
    var imported_label_rocket      = "{{trans('common.import.rocket.importing')}}";
    var duplicates_found_label_rocket = "{{trans('common.import.rocket.removing_duplicates')}}";
    var invalid_email_found_label_rocket = "{{trans('common.import.rocket.removing_invalids')}}";
    // Normal import html labels
    var total_records_label_normal = "{{trans('common.import.normal.total_contacts')}}";
    var imported_successfuly_label = "{{trans('common.import.normal.imported_successfuly')}}";
    var duplicates_normal = "{{trans('common.import.normal.duplicates')}}";
    var invalids_label_normal = "{{trans('common.import.normal.invalids')}}";
    var cancel_import = "{{trans('suppression.cancel_import')}}";
    $(document).ready(function() {

        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Lists/Suppression#domain-suppression");

        $(".m-select2").select2({
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
         // function in master2 layout
        var page_limit=show_per_page('','domain_suppression_pageLength',10);  // Params (table,page,default_limit=10)
         var table= $('#domain_suppression').DataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,5]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[4, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getSuppressDomains') }}",
            "pageLength" : page_limit,
             "fnServerParams": function (aoData) {
                 aoData.push({"name": "record_type", "value": record_type});
                 aoData.push({"name": "clients", "value": $("#clients").val()});
                 aoData.push({"name": "admins", "value": $("#admins").val()});
             },
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]],
        });
         objTable = table;
          page_limit=show_per_page(table,'domain_suppression_pageLength'); 
              var form={
                url:createImportUrl,
                beforeSend: function () {
                     $(".blockUI").show();
                     $('#import-id').val('');
                },
                success: function(result) {
                $(".blockUI").hide();
                successProcess(result); // Functin written in email_suppression.js
                }
              };
         
        $('#suppression-frm').ajaxForm(form);
           var form={
               success: function(result) {
                if(result == 'action-update'){
                     Command: toastr["success"] ('{{trans('suppression.domain.message.domain_update_success')}}');
                    location.reload();
                    return false;
                }else if(result == 'error'){
                    Command: toastr["error"] ('{{trans('suppression.domain.message.invalid')}}');
                    return false;
                }else if(result == 'error_exist'){
                     Command: toastr["error"] ('{{trans('suppression.domain.message.already_exists')}}');
                    return false;
                }
                   
                }
        };
        $('#suppression-frm-edit').ajaxForm(form);
    });

   
</script>
<!-- Supprssion common scrip  -->
<script src="/themes/default/js/includes/common_suppression_script.js?t={{time()}}" type="text/javascript"></script>
<script src="/themes/default/js/includes/domain_suppression.js" type="text/javascript"></script>
<script src="/themes/default/js/common.js" type="text/javascript"></script>
    <script>
    // edit domain suppression
    function editDomainSupress (id, domain, list_id, reference)
    {
        $.ajax({
            url: "{{route('suppressionDomainEdit',"")}}"+'/'+id,
            type: "get",
            dataType:'json',
            success: function(result) {
                if(result.status) {
                    $('#list_id_edit').empty();
                    $('#list_id_edit').html(result.html);
                    $('#list_id_edit').select2({
                        templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
                    });
                    $('#suppress_modal').trigger('click');
                    $('#domain_id').val(id);
                    $('#domain_edit').val(domain);
                    $('#list_id_edit').val(list_id);
                    $('#reference_edit').val(reference);
                    if(result.is_client) {
                        var html = '<span class="alert-text">{{trans('page_title.admin.on.client')}}: (<a href="javascript:;" target="_blank"><b>'+result.owner.name+'</b></a>, '+result.owner.id+')</span>';
                        $('#adminOnClient').empty();
                        $('#adminOnClient').html(html);
                        $('#adminOnClient').show();
                    }
                    else{
                        $('#adminOnClient').empty();
                        $('#adminOnClient').hide();
                    }
                }
            }
        });
    }
    // delete domain suppression
    function DomainDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ url('/') }}"+'/suppression-domain/'+id,
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
    // delete selected domain suppression
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
        var domainsuppression = $('input:checkbox:checked').map(function() {
            return this.value;
        }).get();
        $.ajax({
                type    : "Delete",
                url: "{{ url('/') }}"+'/suppression-domain/'+domain_suppression,
                data    : {ids: domainsuppression},
                success: function(result) {
                        if(result == 'delete') {
                            location.reload();
                        }
                    }
              });

        }
    }
     function exportAll() {
        if($("#user_records").is(":checked") && $("#clients").val()==""){
            alert("{{ trans('suppression.email.message.no_cleint_select_id') }}");            
            return false;
        }
        
        Command: toastr["success"]("{{trans('suppression.message.command_running_background')}}");
        $.ajax({
                type: "POST",
                url: "{{ route('export.all.suppression.domains') }} ",
                data: $("#frm-filters").serialize(),
                success: function(result) {
                    
                     $("#loading").hide();
                }
            });
            
    }
    $('#modal-domain-suppression').on('hidden.bs.modal', function () {
        location.reload();
    });
    $('#btn-add-suppression').click(function(e) {
           $('#import-file-selection').prop("disabled", false);
    });
    // delete domain suppression reference
    function deleteRefrenceDomains(id , reference) {
        if(confirm('{{trans('suppression.domain.message.delete_with_reference')}}')) {
                $.ajax({
                    url: "{{ url('/') }}"+'/suppression-domain/'+id,
                    type: "DELETE",
                    data: {'reference': reference},
                    success: function(result) {
                    if(result == 'delete') {
                            location.reload();
                    }
                }
                });
            }
    }
    // to clear Modal data on close
    $('#modal-domain-suppression').on('hidden.bs.modal', function () {
    $('.modal-body').find('lable,textarea,#domain_supress_id,#list_id').val('');
    });

</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="aYjYCQLt">
    {{ Session::get('msg') }}
</div>
@elseif(Session::has('error_msg'))
<div class="alert alert-danger" data-name="WdZNYHFR">
<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    {{ Session::get('error_msg') }}
</div>
@endif
<?php  
    $runningMinutes =  \App\UserCronSetting::getCronTime("suppress_subscribers"); 
    $runningMinute = $runningMinutes;
    if($runningMinutes < 0 ||  $runningMinutes == NULL) $runningMinute = 5;
    if($runningMinutes === "0" || $runningMinutes === 0 ) $runningMinute = 0;
?>


@if($runningMinute == 0)
@if(Auth::user()->is_client)
<div class="alert alert-warning" data-name="QkKcmvtm">
    {!!trans('suppression.suppression_running_disable_user')!!}
</div>
@else 
<div class="alert alert-warning" data-name="QkKcmvtm">
    {!!trans('suppression.suppression_running_disable')!!}
</div>
@endif
@endif

<div id="msg" class="display-hide" data-name="XQuFxfbt">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<!--  Loader DIV  -->
<div class="loading" id="loading" style="" data-name="UKiAtrXT">
    <div class="loader" data-name="kqVaahSM"></div>
    <div id="js_msg" data-name="tcBIFSUt"></div>
</div>
<div class="row" data-name="SsMBoirx">
    <div class="col-md-12" data-name="kanEZNXn">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="TgvqVTcQ">
            <div class="kt-portlet__body" data-name="vVqdDKkH">
                <div class="table-toolbar" data-name="LPWVfXmi">
                    <div class="form-group row" data-name="iLYPzuOm">
                        <div class="col-md-12" data-name="HOnmsKVY">
                        
                            <div class="btn-group" data-name="JbKGUegh">
                                @if (routeAccess('suppression-domain.store'))
                                <a href="#modal-domain-suppression" data-toggle="modal">
                                <button id="btn-add-suppression" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                </button>                                
                                </a>
                                @endif
<!--                                @if (routeAccess('export.all.suppression.domains'))
                                <a href="javascript:;"  onclick="exportAll();" class="exportAll">
                                    <button id="sample_editable_1_new" class="btn btn-label-success">
                                         {{trans('common.form.buttons.export_all')}}
                                    </button>
                                </a> 
                                @endif-->
                            </div>
                        
                         @if(routeAccess('suppression-domain.destroy'))
                            <div class="btn-group pull-right" data-name="VgHTekSK">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu  dropdown-menu-right">
                                
                                     <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>     
                                    @if (routeAccess('export.all.suppression.domains'))
                                    <li>
                                        <a href="javascript:;" onclick="exportAll();" class=""> <i class="fa fa-download"></i> {{trans('common.form.buttons.export_all')}} </a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                             @endif
                        </div>
                    </div>
                </div>
                @include('includes.view-pages-filter')
                <div class="rel-block">
                    @if($runningMinute > 0)
                    <div class="user-table-warning">{!!trans('suppression.suppression_running_time', ['minutes' => $runningMinute])!!}</div>
                    @endif
                    <table class="table table-striped table-hover table-checkable responsive" id="domain_suppression" role="grid" >
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('suppression.domain.table_headings.domain')}}</th>
                                <th>{{trans('suppression.domain.table_headings.reference')}}</th>
                                <th>{{trans('suppression.domain.table_headings.list')}}</th>
                                <th>{{trans('suppression.domain.table_headings.added_on')}}</th>
                                <th>{{trans('suppression.domain.table_headings.actions')}}</th>
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

<!-- Add new domain suppression Model -->
<div id="modal-domain-suppression" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="OsjYpvdo">
    <div class="modal-dialog modal-lg" data-name="kPwRMnlR">
        <div class="modal-content" data-name="oVvPybLX">
            <div class="modal-header" data-name="ZvUskGuz">
                <h5 class="modal-title">{{trans('suppression.domain.modal.title')}}</h5>
            </div>
            <div class="modal-body" data-name="FPLJDrtw">
            @if($errors->any())
           <!-- For PHP validations errors-->
            <div class="alert alert-danger" data-name="cyjiNJpP">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <!-- Form start -->
            <form action="" method="POST" id="suppression-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="domain_supress_id" id="domain_supress_id" value="">
            <input type="hidden" name="write_file" value="1">
            <input type="hidden" name="suppression_type" id="suppression_type" value="domain">
            <input type="hidden" name="file_destination" id="file_destination" value="{{ config('mumara.storage_path') . Auth::user()->id . '/files/suppression/domains/'}}">
            <input type="hidden" name="file_name" id="file_name">
            <input type="hidden" name="checkDomainLimit" id="checkDomainLimit" value="1">
            <input type="hidden" name="total_records" id="total_records">

                <div class="form-group row" data-name="HhmiMZam">
                    <div class="col-md-12" data-name="AZcNHMAf">
                         {{trans('suppression.domain.modal.description')}}
                    </div>
                </div>
                <div class="form-group row" data-name="jlBabzmK">
                        <label class="col-form-label col-md-3">
                            {{trans('suppression.modal.form.select_list')}}
                            <span class="required"> * </span>
                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.select_list_help',['type'=>'domain(s)'])}}" data-original-title="{{trans('common.description')}}"></i>
                        </label>
                        <div class="col-md-8" data-name="RLidTKuw">
                            <select class="form-control m-select2" name="list_id" id="list_id" required>
                            <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;{{trans('suppression.global')}}</option>
                            @foreach($group_lists as $key => $group)
                                <optgroup label="{{$group['name']}}">
                                    @foreach($group['children'] as $list)
                                    <option value="{{ $list['id'] }}" {{ (isset($domain_suppression->list_id) && ($list['id']  == $domain_suppression->list_id)) || (!empty($list_id) && $list['id'] == $list_id) ? 'selected' : '' }}>&nbsp;&nbsp;
                                    {{ $list['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="form-group row" data-name="rSJbpYJt">
                    <label class="col-form-label col-md-3">
                        {{trans('suppression.modal.form.method')}}
                         <span class="required"> * </span>
                          <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.method_help',['type'=>'domain names','path'=>' /storage/users/$user_id/files/suppression/domains/'])}}" data-original-title="{{trans('common.description')}}"></i>
                    </label>
                    <div class="col-md-8" data-name="EXRjWJfl">
                        <select class="form-control" name="import_file_selection" id="import-file-selection" disabled>
                              <option value="computer"> {{trans('suppression.modal.form.upload_csv_file')}}</option>
                                <option value="folder">{{trans('suppression.modal.form.select_file_from_server')}}</option>
                                <option value="email_input">{{trans('suppression.modal.form.domain_input')}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row" id="file-from-computer" data-name="wnmyVvaa">
                    <label class="col-form-label col-md-3">{{trans('suppression.modal.form.select_file')}}
                            <span class="required"> * </span> <small> ({{trans('suppression.modal.form.max_file_size')}} {{ $max_file }}MB)</small>
                    </label>
                    <div class="col-md-8" data-name="gjjkaGpE">
                        <div class="custom-file" data-name="JcWnLGmS">
                            <input type="file" class="custom-file-input" name="file_import" accept=".csv" required id="import-id" onchange="ValidateSizes(this)" />
                            <label class="custom-file-label text-left" for="customFile" id="customFile1">{{trans('suppression.modal.form.choose_file')}}</label>
                            
                        </div>
                        <div class="uploading-blk" data-name="iHmSqBfx">
                            <div class="upl-text" data-name="XqwAFNNJ">{{trans('suppression.modal.form.uploading_file')}}: </div>
                            <div class="myProgress" data-name="dyjzmBUO" ><div class="bg-info" id="uploading-progress" data-name="ydvGVXKd"></div></div>
                            <i class="la la-refresh fa-spin"></i>
                            <span class="ups-counter"><span class="count">0</span>%</span>
                            <i class="fa fa-check text-success ups-check"></i>
                            <a href="javascript:;" id="cancel-pen"><i class="fa fa-times text-danger"></i></a>
                        </div>
                    </div>
                    </div>
                    <div class="form-group row" id="file-from-folder" style="display:none;" data-name="WbIkFAPu">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.select_file')}}
                        <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="rkDurggM">
                            <select class="form-control" name="folder_file_import" id="folder-import-id">
                                @foreach ($folder_files as $file)
                                    <option value="{{ $file['basename'] }}">{{ $file['basename'] }}</option>
                                @endforeach
                            </select>
                            <div class="help-text" data-name="iVFSGtOK"> {{ trans('suppression.upload_dir',['path'=>'/storage/users/'.Auth::id().'/files/suppression/domains/']) }}</div>
                            <a class="text-danger" href="javascript:void(0)" data-dir="suppression/domains" id="delete_import_files">{{trans('common.delete_all_uploaded_files')}}</a>
                        </div>
                    </div>
                    <div class="form-group row" id="input-in-textarea" style="display:none;" data-name="kPGgNOjD">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.domain')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="iZQwjfUx">
                            <div class="input-icon right" data-name="qqkARYRR">
                                <textarea name="email_input" id="model_domain_edit" value="{{isset($domain_suppression->domain) ? $domain_suppression->domain : '' }}" class="form-control" placeholder="Domain one per line" rows="8"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="index_wrap" style="display: none;" data-name="gsvDytGX">
                    <div class="form-group row" data-name="poDLudhY">
                        <label class="col-form-label col-md-3"> {{trans('suppression.modal.form.domain')}} <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="PsQmdZca">
                            <div class="input-icon right" data-name="MQBefXrD">
                                <select class="form-control" name="index" id="index"></select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" data-name="DClewqKq">
                    <label class="col-form-label col-md-3">{{trans('suppression.modal.form.line_contains_headers')}}
                    </label>
                    <div class="col-md-8" data-name="tJPAhwjJ">
                        <select class="form-control" name="headers_include">
                            <option value="1">{{trans('common.form.buttons.yes')}}</option>
                            <option value="0">{{trans('common.form.buttons.no')}}</option>
                        </select>
                    </div>
                </div>
                </div>
                    <div class="form-group row" data-name="VujXzuuI">
                    <label class="col-form-label col-md-3">{{trans('suppression.modal.form.reference')}}
                    <span class="required"> * </span>
                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.reference_help')}}" data-original-title="{{trans('common.description')}}"></i>
                    </label>
                    <div class="col-md-8" data-name="hjHgEBcE">
                        <div class="input-icon right" data-name="DisXiKTY">
                            <input type="text" id="reference" name="label1" value="{{isset($domain_suppression->reference) ? $domain_suppression->reference : '' }}" class="form-control" required="" />
                        </div>
                        <span style="color:red; display:none"  id="FileSizeError">{!! trans('common.message.FileSizeError',['max_file'=>$max_file."MB"]) !!}</span>
                    </div>
                </div>
                <div class="form-group row"  id="rocket_speed_div" data-name="BaudSNOq">
                    <label class="col-form-label col-md-3">{{trans('suppression.modal.form.rocket_speed')}}</label>
                    <div class="col-md-8" data-name="WuQeaUYA">
                        <div class="row" data-name="dxIWzOiN">
                            <div class="col-md-12" data-name="QhYYEfHv">
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success" id="rocket-switch2">
                                    <label>
                                        <input type="checkbox" name="rocket_speed" id="rocket-switch" onchange="showHandleRocketSpeed(this)" />
                                        <span></span>
                                    </label>
                                </span>
                            </div>

                           <div class="col-md-12" data-name="bvxkZUMy">
                                    <div class="form-group row" id="info_msg_div" style="display: none;" data-name="ClNVhWYz">
                                        <div class="col-md-12" id="info_msg_div2" data-name="HUvXAglc">
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions" id="action-row" data-name="nwbnSrxZ">
                
                    <div class="row" data-name="niHeFiUQ">
                        <label class="col-form-label col-md-3"></label>
                        <div class="col-md-9" data-name="wlMCKMen">
                            <button type="button" class="btn btn-success" id="supsend">{{trans('suppression.modal.form.button.import')}}</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
                        </div>
                    </div>
                </div>
                     <div id="progress-import" style="display: none;" data-name="QFImyVjz">
                        <div id="ajax-spinner-text" data-name="NndfYMKx"><i class="fa fa-spinner fa-spin"></i><i class="fa fa-check text-success" style="display: none;"></i><i class="fa fa-times text-danger" style="display: none;"></i>{{trans('suppression.index_blade.importing_txt_div')}} <span class="filename"></span>{{trans('suppression.index_blade.into_txt_div')}} <strong id="list_name"></strong></div>
                    </div>
                    <div id="import-result" class="table-responsive" style="display: none;" data-name="RngBQFEd"></div>
                </form>
                <!-- End form -->
            </div>
        </div>
    </div>
</div>
<!-- Add new domain suppression Model -->

<!-- Edit domain suppression Model -->
<div id="domain-suppression-edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="EzGmXytK">
    <div class="modal-dialog modal-lg" data-name="qqDhFUsi">
        <div class="modal-content" data-name="dybBhqJS">
            <div class="modal-header" data-name="hnvdNKII">
                <h5 class="modal-title">{{trans('suppression.domain.update_domain')}}</h5>
            </div>
            <div class="modal-body" data-name="girUWGPm">
                <div id="adminOnClient" class="alert alert-warning" style="display: none;" data-name="eQPBzxAv">

                </div>
            @if($errors->any())
           <!-- For PHP validations errors-->
            <div class="alert alert-danger" data-name="gmFiHCep">
                @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
            @endif
            <form action="" method="POST" id="suppression-frm-edit" class="kt-form kt-form--label-right" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="domain_id" id="domain_id" value="">
                <div class="form-group row" data-name="ciDENEtd">
                        <label class="col-form-label col-md-3">{{trans('suppression.domain.contact_list')}}
                        </label>
                        <div class="col-md-8" data-name="fiJBFBmF">
                            <select class="form-control m-select2" name="list_id_edit" id="list_id_edit" required>
                            <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;{{trans('suppression.global')}}</option>
                            @foreach($group_lists as $key => $group)
                                <optgroup label="{{$group['name']}}">
                                    @foreach($group['children'] as $list)
                                    <option value="{{ $list['id'] }}" {{ (isset($domain_suppression->list_id) && ($list['id']  == $domain_suppression->list_id)) || (!empty($list_id) && $list['id'] == $list_id) ? 'selected' : '' }}>&nbsp;&nbsp;
                                    {{ $list['name'] }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        </div>
                    </div>
               
               
                   
                    <div class="form-group row" data-name="WqyYAtjq">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.domain')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="LMMysqaq">
                            <div class="input-icon right" data-name="ghJzSOAS">
                                <input name="domain_edit" id="domain_edit" class="form-control" placeholder="Domain" type="text" required>
                            </div>
                        </div>
                    </div>
                     
                    <div class="form-group row" data-name="FLnTggdX">
                    <label class="col-form-label col-md-3">{{trans('suppression.modal.form.reference')}}
                    <span class="required"> * </span>
                    </label>
                    <div class="col-md-8" data-name="aeYVAcXx">
                        <div class="input-icon right" data-name="WLIKeZoX">
                            <input type="text"  name="reference_edit" id="reference_edit" class="form-control" required>
                        </div>
                        
                    </div>
                </div>
              
                <div class="form-actions" id="action-row" data-name="VoidboYo">
                    <div class="row" data-name="RAnlinuF">
                        <label class="col-form-label col-md-3"></label>
                        <div class="col-md-9" data-name="RiFjnBhg">
                            <button type="submit" class="btn btn-success">{{ trans('common.form.buttons.update') }}</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('common.form.buttons.cancel') }}</button>
                        </div>
                    </div>
                </div>
                     
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit domain suppression Model -->
<a id="suppress_modal" style="display: none" href="#domain-suppression-edit" data-toggle="modal"></a>
@endsection