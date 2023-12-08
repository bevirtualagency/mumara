@extends('layouts.master')

@section('title', trans('app.subscribers.import.title'))

@section('page_styles')
        <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        <style>
        .select2-results__group {
            color: #000000 !important;
            font-size: 14px !important;
        }
        </style>
@endsection

@section('page_scripts')
       <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
       <script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
       <script src="/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
       <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
       <script>
            var form_error="{{trans('common.message.form_error')}}";
            var import_error = "{{trans('app.subscribers.import.messages.import_error')}}";
       </script>

       <script>
           $('#import-file-selection').on('change', function() {
                var import_file_selection = $('#import-file-selection').val();
                if (import_file_selection == 'computer') {
                    $("#file-from-computer").show();
                    $("#file-from-folder").hide();
                    $("#import-id").attr("required","required");
                    $("#folder-import-id").removeAttr("required");
                } else {
                    $("#file-from-folder").show();
                    $("#file-from-computer").hide();
                    $("#folder-import-id").attr("required","required");
                    $("#import-id").removeAttr("required");
                }
            });
       </script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="ZeOxxSgV">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.smtp_management.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.smtp_management.import.title')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('app.smtp_management.import.title')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="ZOqgmXgT">
    <p>{{trans('sending_nodes.important_blade.fields_dropdown_para')}}</p>
</div>

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="erbOumWM">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if(Session::has('error-msg'))
<div class="alert alert-danger" data-name="PBigtaZC">
    {{ Session::get('error-msg') }}
</div>
@endif

<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="VWlwtDAg">
    <span id='msg-text'><span>
</div>

<div class="row" data-name="yRCaychw">
    <div class="col-md-12" data-name="pLiwdQoi">
        @if ($action == 'first')
            <!-- BEGIN FORM-->
            <form action="{{ route('node.import.index') }}" method="POST" id="subscriber-frm" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="action" value="next">
                <input type="hidden" id="listid" value="">
                <div class="row" data-name="PEZpFqJn">
                    <div class="col-md-8" data-name="QFIVEirG">
                        <div class="portlet box green" data-name="eblIDDnl">
                            <div class="portlet-title" data-name="PfGhQSoA">
                                <div class="caption" data-name="ZgRRYLOX">
                                    <span class="caption-subject">{{trans('app.smtp_management.import.table_headings.smtp_details')}}</span>
                                </div>
                            </div>
                            <div class="portlet-body" data-name="RbVFMMBR">
                                <div class="form-body" data-name="pYsATOBp">
                                    <div class="form-group" data-name="eeTtnIAf">
                                        <label class="control-label col-md-3">{{trans('app.smtp_management.import.fields.import_file.title')}}
                                        </label>
                                        <div class="col-md-8" data-name="saUKCHhA">
                                            <select class="form-control" name="import_file_selection" id="import-file-selection">
                                                    <option value="computer"> {{trans('app.smtp_management.import.fields.import_file.values.upload.title')}}</option>
                                                    <option value="folder">{{trans('app.smtp_management.import.fields.import_file.values.choose.title')}}</option>
                                            </select>
                                        </div>
                                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.import.import_file.description')}}" data-original-title="{{trans('app.help.subscribers.import.import_file.title')}}"></i>
                                    </div>
                                    <div class="form-group" id="file-from-computer" data-name="xGzTWXsT">
                                        <label class="control-label col-md-3">{{trans('app.smtp_management.import.fields.import_file.values.upload.select_file')}}
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8" data-name="tIdIlrRp">
                                            <div class="fileinput fileinput-new" data-provides="fileinput" data-name="qxNWFpvG">
                                                <div class="fileinput fileinput-new" data-provides="fileinput" data-name="RtJROmSZ">
                                                <div class="input-group input-large" data-name="MzsVALCc">
                                                    <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput" data-name="OPISAZCQ">
                                                        <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                        <span class="fileinput-filename"></span>
                                                    </div>
                                                    <span class="input-group-addon btn default btn-file">
                                                        <span class="fileinput-new"> {{trans('app.subscribers.import.fields.select_file.values.select_file')}} </span>
                                                        <span class="fileinput-exists"> {{trans('app.subscribers.import.fields.select_file.values.change')}} </span>
                                                        <input type="hidden" value="" name="...">
                                                        <input type="file" id="import-id" name="file_import" required></span>
                                                    <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> {{trans('app.subscribers.import.fields.select_file.values.remove')}} </a>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.import.select_file.description')}}" data-original-title="{{trans('app.help.subscribers.import.select_file.title')}}"></i>
                                    </div>
                                    <div class="form-group" id="file-from-folder" style="display:none;" data-name="QGdrkzHM">
                                        <label class="control-label col-md-3">{{trans('app.smtp_management.import.fields.import_file.values.choose.import_file')}}
                                        <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-8" data-name="ZveqDnZM">
                                            <select class="form-control" name="folder_file_import" id="folder-import-id">
                                                @foreach ($folder_files as $file)
                                                    <option value="{{ $file['basename'] }}">{{ $file['basename'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group" data-name="LkZJmjIJ">
                                        <label class="control-label col-md-3">{{trans('app.smtp_management.import.fields.headers_included.title')}}
                                        </label>
                                        <div class="col-md-8" data-name="oDbHHlPk">
                                            <select class="form-control" name="headers_include">
                                                    <option value="1">{{trans('app.smtp_management.import.fields.headers_included.values.yes')}}</option>
                                                    <option value="0">{{trans('app.smtp_management.import.fields.headers_included.values.no')}}</option>
                                            </select>
                                        </div>
                                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.import.headers_included.description')}}" data-original-title="{{trans('app.help.subscribers.import.headers_included.title')}}"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-actions" data-name="WDOCdRmV">
                            <div class="row" data-name="OhauBDlu">
                                <div class="col-md-offset-6" data-name="KDApnaBE">
                                    <button type="submit" id="next-btn" class="btn green">{{trans('app.smtp_management.import.buttons.next')}}</button>
                                </div>
                            </div>
                        </div>
                    </div>
            </form>
            @elseif ($action == 'next')
                <!-- BEGIN FORM-->
                <form action="{{ route('node.import.index') }}" method="POST" id="" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="action" id="action" value="import">
                    <input type="hidden" name="file_name" value="{{ $file_name }}">
                    <input type="hidden" name="header_included" value="{{ $header_included }}">
                    <div class="row" data-name="VAgrPlyk">
                        <div class="col-md-8" data-name="ROrvQbzK">
                            <div class="portlet box green" data-name="PJnekRiF">
                                <div class="portlet-title" data-name="iKAyiElr">
                                    <div class="caption" data-name="UxtWXzuH">
                                        <span class="caption-subject">{{trans('sending_nodes.important_blade.importing_smtps_span')}} <strong>{{ $file_name }}</strong></span>
                                    </div>
                                </div>
                                <div class="portlet-body" data-name="ertwOHpS">
                                    <div class="form-body" data-name="QCvcXwYw">
                                        @foreach ($file_headers as $header)
                                            <div class="form-group" data-name="kEtBrVnl">
                                                <label class="control-label col-md-3">{{ $header }}
                                                </label>
                                                <div class="col-md-8" data-name="lirdIibp">
                                                    <select class="form-control custom-field-id" name="smtp_data[]" >
                                                        @foreach($db_header as $key => $value)
                                                            <option value="{{$key}}">{{$value}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions" data-name="kwHwtsty">
                                <div class="row" data-name="qioHNlkh">
                                    <div class="col-md-offset-6" data-name="XCRvMqae">
                                        <button type="submit" class="btn green">{{trans('app.smtp_management.import.buttons.import')}}</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
        @endif
    </div>
</div>
@endsection