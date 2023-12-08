@extends(decide_template())
@section('title', $pageTitle)

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
    #modal-email-suppression {
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
         $('#label1').keypress((e) => {
            if (e.which === 13) {
               $("#supsend").trigger("click");
               return false;
            }
        })
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Lists/Suppression#email-suppression");

        $(".m-select2").select2({
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });

        var list_id = $("#listid").val();

        // function in master2 layout
        var page_limit = show_per_page('', 'email_suppression_pageLength', 10); // Params (table,page,default_limit=10)
        var table = $('#email_suppression').DataTable({
            "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0, 7]
            }],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [
                [6, "desc"]
            ],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getSuppressEmails/?listid=') }}" + list_id,
            "pageLength": page_limit,
            "fnServerParams": function(aoData) {
                aoData.push({
                    "name": "record_type",
                    "value": record_type
                });
                aoData.push({
                    "name": "clients",
                    "value": $("#clients").val()
                });
                aoData.push({
                    "name": "admins",
                    "value": $("#admins").val()
                });
            },
            "aLengthMenu": [
                [10, 50, 100, 500],
                [10, 50, 100, 500]
            ]
        });
        objTable = table;
        page_limit = show_per_page(table, 'email_suppression_pageLength');
        $('#suppression-frm').ajaxForm({
            rules: {
                list_id: {
                    required: !0
                },
                file_import: {
                    required: !0
                },
                label1: {
                    required: !0
                }
            },
            url: createImportUrl,
            beforeSend: function() {
                $(".blockUI").show();
            },
            success: function(result) {
                $(".blockUI").hide();
                successProcess(result); // Functin written in email_suppression.js
            }
        });
        
    });
</script>
<!-- Supprssion common scrip  -->
<script src="/themes/default/js/includes/email_suppression.js?t={{time()}}" type="text/javascript"></script>
<script src="/themes/default/js/includes/common_suppression_script.js?t={{time()}}" type="text/javascript"></script>
<script src="/themes/default/js/common.js" type="text/javascript"></script>
<script>
    // delete email suppression
    function EmailDelete(id) {
        if (confirm('{{trans('common.message.alert_delete')}}')) {
            $("#row_" + id).attr("style", "display:none");
            $.ajax({
                url: "{{ url('/') }}" + '/suppression-email/' + id,
                type: "DELETE",
                success: function(result) {
                    if (result == 'delete') {
                        Command: toastr["success"]("{{trans('common.message.delete')}}");
                    }
                    setTimeout(function() {
                        location.reload();
                    },1000)
                }
            });
        }
    }
    // delete selected email suppression
    function deleteAll() {
        if (!$('input:checkbox:checked').length) {
            alert('{{trans('common.message.alert_no_record')}}');
            return false;
        }
        if (confirm("{{trans('common.message.alert_delete')}}")) {
            var email_suppression = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type: "DELETE",
                url: "{{ url('/') }}" + '/suppression-email/' + email_suppression,
                data: {
                    ids: email_suppression
                },
                success: function(result) {
                    if (result == 'delete') {
                        Command: toastr["success"]("{{trans('common.message.delete')}}");
                        location.reload();
                    }
                }
            });

        }
    }
    //// export suppression
    function exportAll() {        
        if($("#user_records").is(":checked") && $("#clients").val()==""){
            alert("{{ trans('suppression.email.message.no_cleint_select_id') }}");            
            return false;
        }
        
        Command: toastr["success"]("{{trans('suppression.message.command_running_background')}}");
        $.ajax({
                type: "POST",
                url: "{{ route('export.all.suppression.emails') }} ",
                data: $("#frm-filters").serialize(),
                success: function(result) {                    
                     $("#loading").hide();
                }
            });
            
    }
    function deleteRefrenceEmails(id, reference) {

        if (confirm('{{trans('suppression.email.message.delete_with_reference')}}')) {
            $.ajax({
                url: "{{ url('/') }}" + '/suppression-email/' + id,
                type: "DELETE",
                data: {
                    'reference': reference
                },
                success: function(result) {
                    if (result == 'delete') {
                        location.reload();
                    }
                }
            });
        }
    }

    $('#modal-email-suppression').on('hidden.bs.modal', function() {
        location.reload();
    })

    $("body").on("click", ".encryptedType" , function(event) {
        var name = $(this).attr("data-value");
        var enable = "no";
        if($(this).is(":checked")) { 
            enable = "yes";
        }
        var form_data = {
            name,
            enable
        };
        $("#loading").show();
        $.ajax({
            url: "{{ url('/') }}" + '/suppression/addType',
            type: "POST",
            data: form_data,
            success: function(result) {
                $("#loading").hide();
            }
        });
    });

    $("body").on("click", "#resync_suppression" , function(event) {
       var name = "";
        var form_data = {
            name
        };
        $("#loading").show();
        $.ajax({
            url: "{{ url('/') }}" + '/suppression/resync',
            type: "POST",
            data: form_data,
            success: function(result) {
                if(result=='success'){
                    Command: toastr["success"]("{{trans('common.label.success')}}");
                }else{
                    Command: toastr["error"]("{{trans('suppression.resync_erro_message')}}");
                }
                
                $("#loading").hide();
            }
        });
    });
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="wqCqmpyo">
    {{ Session::get('msg') }}
</div>
@elseif(Session::has('error_msg'))
<div class="alert alert-danger" data-name="QkKcmvtm">
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

<div id="msg" class="display-hide" data-name="Uvvhveyk">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="loading" id="loading" style="" data-name="zIizyMGk">
    <div class="loader" data-name="UhouNqRs"></div>
    <div id="js_msg" data-name="lLMOkhSj"></div>
</div>
<!--  Loader DIV  -->
<div class="loading usman" id="loading" style="" data-name="smlxJNeB">
    <div class="loader" data-name="umDKEaWn"></div>
    <div id="js_msg" data-name="IdQuZwzB"></div>
</div>
<div class="row" data-name="OKJPCsrT">
    <div class="col-md-12" data-name="gDHwwTdc">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="EajZwJlB">
            <div class="kt-portlet__body" data-name="AqkugHnA">
                <div class="table-toolbar" data-name="kFAOecTo">
                    <div class="form-group row" data-name="bIznNKRP">
                        <div class="col-md-12" data-name="hDBcuCqv">
                            @if (routeAccess('suppression-email.store'))
                            <div class="btn-group" data-name="jAquBSUN">
                                @if(isset($action) && $action == 'true')
                                <a href="#modal-email-suppression" data-toggle="modal">
                                    <button id="sample_editable_1_new" class="btn btn-label-success">
                                        <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                    </button></a> 
                                    
                                    @if(Auth::user()->is_staff)
                                    <button id="resync_suppression" class="btn btn-label-warning" style="margin-left:10px;">
                                         {{trans('suppression.index_blade_email_suppression.resync_suppression_button')}}
                                    </button>
                                    @endif
                                  
                                   
                                    @endif
                                @if (isset($list_id))<h4>{{ trans('suppression.email.sup_email_inside') }}<b>{{ $list_name }}</b></h4> @endif
                                
<!--                                @if (routeAccess('export.all.suppression.emails'))
                                <a href="javascript:;"  onclick="exportAll();" class="exportAll">
                                    <button id="sample_editable_1_new" class="btn btn-label-success">
                                         {{trans('common.form.buttons.export_all')}}
                                    </button>
                                </a> 
                                @endif-->
                            </div>
                            @endif
                            @if (routeAccess('suppression-email.destroy'))
                            <div class="btn-group pull-right" data-name="OJeWJoor">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{ trans('common.actions') }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">

                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="fa fa-remove"></i> {{trans('common.form.buttons.delete')}} </a>
                                    </li>
                                    @if (routeAccess('export.all.suppression.emails'))
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
                  <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable" id="email_suppression" role="grid">
                        <thead>
                            <tr role="row">
                                <th style="width: 25px;">
                                    <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                        <input type="checkbox" class="checkboxes checkbox-all-index">
                                        <span></span>
                                    </label>
                                </th>
                                <th>{{trans('suppression.email.table_headings.id')}}</th>
                                <th>{{trans('suppression.email.table_headings.email')}}</th>
                                @if($showMd5)
                                <th>{{trans('suppression.email.table_headings.md5')}}</th>
                                @endif
                                <th>{{trans('suppression.email.table_headings.reference')}}</th>
                                <th>{{trans('suppression.email.table_headings.contacts')}}</th>
                                <th>{{trans('suppression.email.table_headings.users')}}</th>
                                <th>{{trans('suppression.email.table_headings.added_on')}}</th>
                                <th>{{trans('suppression.email.table_headings.actions')}}</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  </div>
                </div>
                    

            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<!--Add new email suppression Model -->
<div id="modal-email-suppression" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="NmyrHkUd">
    <div class="modal-dialog modal-lg" data-name="qiDFzwZt">
        <div class="modal-content" data-name="njZDIBbN">
            <div class="modal-header" data-name="FVOUcyWy">
                <h5 class="modal-title">{{trans('suppression.email.modal.title')}}</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body" data-name="FqkXjUOo">
                @if($errors->any())
                <!-- For PHP validations errors-->
                <div class="alert alert-danger" data-name="zpsbwZOs">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
                @endif

                <!-- BEGIN FORM-->
                <form action="" method="POST" id="suppression-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                    <input type="hidden" id="listid" value="{{ isset($list_id) ? $list_id : '' }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="write_file" value="1">
                    <input type="hidden" name="suppression_type" id="suppression_type" value="email">
                    <input type="hidden" name="file_destination" id="file_destination" value="{{ config('mumara.storage_path') . Auth::user()->id . '/files/suppression/emails/'}}">
                    <input type="hidden" name="file_name" id="file_name">
                    <input type="hidden" name="total_records" id="total_records">

                    <div class="form-group row" data-name="ZXQAnszf">
                        <div class="col-md-12" data-name="ONTEQvBU">
                            {{trans('suppression.email.modal.description')}}
                        </div>
                    </div>
                    <div class="form-group row" data-name="ZSqKiNwh">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.select_list')}}
                            <span class="required"> * </span>
                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.select_list_help',['type'=>'email(s)'])}}" data-original-title="{{trans('common.description')}}"></i>
                        </label>
                        <div class="col-md-8" data-name="jNoJTutd">
                            <select class="form-control m-select2" name="list_id" id="list-id" required>
                                <option value="0">&nbsp;&nbsp;&nbsp;&nbsp;{{trans('suppression.global')}}</option>
                                @foreach($group_lists as $key => $group)
                                <optgroup label="{{$group['name']}}">
                                    @foreach($group['children'] as $list)
                                    <option value="{{ $list['id'] }}" {{ isset($subscriber->list_id) && ($list['id']  == $subscriber->list_id) ? 'selected' : '' }}>&nbsp;&nbsp;
                                        {{ $list['name'] }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <?php
                         $eArray = array("md5" );
                         
                         $encryptedTypes = getSetting("encrypted_email_types");
                         $et_array = array();
                         if(!empty($encryptedTypes)) { 
                            $encryptedTypes = json_decode($encryptedTypes);
                            foreach($encryptedTypes as $kk=>$et) { 
                                if($et == "yes") $et_array[] = $kk; 
                            }
                         }
                    ?>

                    <div class="form-group row" data-name="KlyVwsot">
                        <label class="col-form-label col-md-3">{{trans('suppression.email.table_headings.email_encryption')}}
                            <span class="required"> * </span>
                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.email.table_headings.email_encryption_desc')}}" data-original-title="{{trans('common.description')}}"></i>
                        </label>
                        <div class="col-md-8" data-name="XdmJUTOa">
                            <select class="form-control" name="email_type" id="email_type">
                                <option value="email">{{trans('suppression.email.table_headings.no_encryption')}}</option>
                                @foreach($et_array as $eta)
                                <option value="{{$eta}}">{{strtoupper($eta)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="form-group row" data-name="VHGWHsLh">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.method')}}
                            <span class="required"> * </span>
                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.method_help',['type'=>'email addresses','path'=>' /storage/users/$user_id/files/suppression/emails/'])}}" data-original-title="{{trans('common.description')}}"></i>
                        </label>
                        <div class="col-md-8" data-name="BwejUMHA">
                            <select class="form-control" name="import_file_selection" id="import-file-selection">
                                <option value="computer"> {{trans('suppression.modal.form.upload_csv_file')}}</option>
                                <option value="folder">{{trans('suppression.modal.form.select_file_from_server')}}</option>
                                <option value="email_input">{{trans('suppression.modal.form.email_input')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="file-from-computer" data-name="udAQwdmS">
                        <label class="col-form-label col-md-3">
                            {{trans('suppression.modal.form.select_file')}}
                            <span class="required"> * </span> <small> ({{trans('suppression.modal.form.max_file_size')}} {{ $max_file }}MB)</small>
                        </label>
                        <div class="col-md-8" data-name="nHPxGVPN">
                            <div class="custom-file" data-name="OcoEYbvN">
                                <input type="file" class="custom-file-input" name="file_import" id="import-id" accept=".csv" onchange="ValidateSizes(this)" />
                                <label class="custom-file-label text-left" id="customFile1">{{trans('suppression.modal.form.choose_file')}}</label>
                                <span style="color:red; display:none" id="FileSizeError">{!! trans('common.message.FileSizeError',['max_file'=>$max_file."MB"]) !!} <span>
                            </div>
                            <div class="uploading-blk" data-name="oKidtiCv">
                                <div class="upl-text" data-name="msrwKyVa">{{trans('suppression.modal.form.uploading_file')}}: </div>
                                <div class="myProgress" data-name="BaTnNbTv">
                                    <div class="bg-info" id="uploading-progress" data-name="oGBHoXgb"></div>
                                </div>
                                <i class="la la-refresh fa-spin"></i>
                                <span class="ups-counter"><span class="count">0</span>%</span>
                                <i class="fa fa-check text-success ups-check"></i>
                                <a href="javascript:;" id="cancel-pen"><i class="fa fa-times text-danger"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="file-from-folder" style="display:none;" data-name="TEROcJDu">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.select_file')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="NemMcUQS">
                            <select class="form-control" name="folder_file_import" id="folder-import-id">
                                @foreach ($folder_files as $file)
                                <option value="{{ $file['basename'] }}">{{ $file['basename'] }}</option>
                                @endforeach
                            </select>
                            <div class="help-text" data-name="SMcABdWu"> {{ trans('suppression.upload_dir',['path'=>'/storage/users/'.Auth::id().'/files/suppression/emails/']) }}</div>
                            <a class="text-danger" href="javascript:void(0)" data-dir="suppression/emails" id="delete_import_files">{{trans('common.delete_all_uploaded_files')}}</a>
                        </div>
                    </div>
                    <div class="form-group row" id="input-in-textarea" style="display:none;" data-name="qnIlhIsn">
                        <label class="col-form-label col-md-3">
                            <span class="wrEmail">{{trans('suppression.modal.form.email_address')}}</span>
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="UsYGLahc">
                            <div class="input-icon right" data-name="SZnuJgGv">
                                <textarea name="email_input" value="" class="form-control" placeholder="One per line e.g. mymail@mail.com" rows="10"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="index_wrap" style="display: none;" data-name="DVDezSiz">
                    <div class="form-group row" data-name="gZPfOOxo">
                        <label class="col-form-label col-md-3"> {{trans('suppression.modal.form.email')}} <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="vESHZMuw">
                            <div class="input-icon right" data-name="RtCPMlPg">
                                <select class="form-control" name="index" id="index"></select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" data-name="PGuEFaJq">
                    <label class="col-form-label col-md-3">{{trans('suppression.modal.form.line_contains_headers')}}
                    </label>
                    <div class="col-md-8" data-name="UswZrJYh">
                        <select class="form-control" name="headers_include">
                            <option value="1">{{trans('common.form.buttons.yes')}}</option>
                            <option value="0">{{trans('common.form.buttons.no')}}</option>
                        </select>
                    </div>
                </div>
                </div>
                    <div class="form-group row" data-name="DlQdMFCz">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.reference')}} <span class="required"> * </span>
                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.reference_help')}}" data-original-title="{{trans('common.description')}}"></i>

                        </label>
                        <div class="col-md-8" data-name="tNLkCWSw">
                            <div class="input-icon right" data-name="WWuNUgjg">
                                <input type="text" required="" name="label1" id="label1" value="" class="form-control" />
                            </div>
                        </div>
                        
                    </div>
                    <div class="form-group row" id="rocket_speed_div" data-name="TDMnKmpV">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.rocket_speed')}}</label>
                        <div class="col-md-8" data-name="kXcsPnpB">
                            <div class="row" data-name="XyyhISLl">
                                <div class="col-md-12" data-name="WefXmJIP">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success" id="rocket-switch2">
                                        <label>
                                            <input type="checkbox" name="rocket_speed" id="rocket-switch" onchange="showHandleRocketSpeed(this)" />
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                <div class="col-md-12" data-name="REVBmwTB">
                                    <div class="form-group row" id="info_msg_div" style="display: none;" data-name="NpnEjDTm">
                                        <div class="col-md-12" id="info_msg_div2" data-name="ixtHpdot">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions row" id="action-row" data-name="ssaKQaMK">
                        <label class="col-form-label col-md-3"></label>
                        <div class="col-md-8" data-name="cepMWXnd">
                            <button type="button" class="btn btn-success" id="supsend">{{trans('suppression.modal.form.button.import')}}</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
                        </div>
                    </div>
                    <div id="progress-import" style="display: none;" data-name="RXRbFbEj">
                        <div id="ajax-spinner-text" data-name="ELBqMVbA"><i class="fa fa-spinner fa-spin"></i><i class="fa fa-check text-success" style="display: none;"></i><i class="fa fa-times text-danger" style="display: none;"></i> {{trans('suppression.index_blade.importing_txt_div')}} <span class="filename"></span> {{trans('suppression.index_blade.into_txt_div')}} <strong id="list_name"></strong></div>
                    </div>
                    <div id="import-result" class="table-responsive" style="display: none;" data-name="ytqofDQx"></div>
                </form>
                <!-- BEGIN END-->
            </div>
        </div>
    </div>
</div>



<!--Add new email suppression Model -->
<div id="modal-email-suppression-data" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="fhFhzylJ">
    <div class="modal-dialog modal-lg" data-name="jblUXBNS">
        <div class="modal-content" data-name="bInwHbbS">
            <div class="modal-header" data-name="tpUrBHiX">
                <h5 class="modal-title">{{trans('suppression.email.modal.title')}}</h5>
                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button> -->
            </div>
            <div class="modal-body" data-name="UtQIjNYS">
                <!-- BEGIN FORM-->
                <form action="" method="POST" id="suppression-types" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                   
                    <div class="form-group row" data-name="SAJYRdEn">
                        <div class="col-md-12" data-name="qKIqeNfq">
                          
                        </div>
                    </div>

                    <div class="form-group row" data-name="TeWamEBU">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.select_list')}}
                            <span class="required"> * </span>
                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.select_list_help',['type'=>'email(s)'])}}" data-original-title="{{trans('common.description')}}"></i>
                        </label>
                        <div class="col-md-8" data-name="EAgNkldl">
                            <select class="form-control m-select2" name="list_id" id="list-id" required>
                                <option value="0">{{trans('suppression.global')}}</option>
                                @foreach($group_lists as $key => $group)
                                <optgroup label="{{$group['name']}}">
                                    @foreach($group['children'] as $list)
                                    <option value="{{ $list['id'] }}" {{ isset($subscriber->list_id) && ($list['id']  == $subscriber->list_id) ? 'selected' : '' }}>&nbsp;&nbsp;
                                        {{ $list['name'] }}</option>
                                    @endforeach
                                </optgroup>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" data-name="kVvICExm">
                        <label class="col-form-label col-md-3">{{trans('suppression.modal.form.method')}}
                            <span class="required"> * </span>
                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('suppression.modal.form.method_help',['type'=>'email addresses','path'=>' /storage/users/$user_id/files/suppression/emails/'])}}" data-original-title="{{trans('common.description')}}"></i>
                        </label>
                        <div class="col-md-8" data-name="zNWWaloX">
                            <select class="form-control" name="import_file_selection" id="import-file-selection">
                                @foreach($eArray as $e) 
                                <option value="{{$e}}"> {{$e}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row" id="file-from-computer" data-name="CTcZbCke">
                        <label class="col-form-label col-md-3">
                            {{trans('suppression.modal.form.select_file')}}
                            <span class="required"> * </span> <small> ({{trans('suppression.modal.form.max_file_size')}} {{ $max_file }}MB)</small>
                        </label>
                        <div class="col-md-8" data-name="gwozpcFp">
                            <div class="custom-file" data-name="MVdIGFpE">
                                <input type="file" class="custom-file-input" name="file_import" id="import-id" accept=".csv" onchange="ValidateSizes(this)" />
                                <label class="custom-file-label text-left" id="customFile1">{{trans('suppression.modal.form.choose_file')}}</label>
                            </div>
                            <div class="uploading-blk" data-name="vCshMQyN">
                                <div class="upl-text" data-name="aIcxVlrz">{{trans('suppression.modal.form.uploading_file')}}: </div>
                                <div class="myProgress" data-name="WfuHCHqX">
                                    <div class="bg-info" id="uploading-progress" data-name="tfGzsLZx"></div>
                                </div>
                                <i class="la la-refresh fa-spin"></i>
                                <span class="ups-counter"><span class="count">0</span>%</span>
                                <i class="fa fa-check text-success ups-check"></i>
                                <a href="javascript:;" id="cancel-pen"><i class="fa fa-times text-danger"></i></a>
                            </div>
                        </div>
                    </div>

                   
                    <div class="form-actions row" id="action-row" data-name="fHTlvFLk">
                       <label class="col-form-label col-md-3"></label>
                        <div class="col-md-8" data-name="sTQOXeHo">
                            <button type="button" class="btn btn-success" id="susppenssionEncrypt">{{trans('suppression.index_blade_email_suppression.save_txt_button')}}</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('common.form.buttons.cancel')}}</button>
                        </div>
                    </div>
                    <div id="progress-import" style="display: none;" data-name="GpIGZASS">
                        <div id="ajax-spinner-text" data-name="ghRBdJLz"><i class="fa fa-spinner fa-spin"></i><i class="fa fa-check text-success" style="display: none;"></i><i class="fa fa-times text-danger" style="display: none;"></i> {{trans('suppression.index_blade.importing_txt_div')}} <span class="filename"></span> {{trans('suppression.index_blade.into_txt_div')}} <strong id="list_name"></strong></div>
                    </div>
                    <div id="import-result" class="table-responsive" style="display: none;" data-name="knCeJBtt"></div>
                </form>
                <!-- BEGIN END-->
            </div>
        </div>
    </div>
</div>


@endsection