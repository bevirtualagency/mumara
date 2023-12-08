@extends('layouts.master')

@section('title', $page_data['title'] )

@section('page_styles')
<link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<style type="text/css">
@media(max-width: 767px) {
button.fa.fa-question {
    margin-top: 10px;
    margin-left: 15px;
    margin-bottom: 0;
}    
.col-md-12.mainBlk {
    padding-left: 0;
    padding-right: 0;
}
.form-actions .btn {
    margin-bottom: 10px;
}
.modal-dialog {
    width: 94%;
    margin: 0;
}
} 
@media(max-width: 480px) {
.uneditable-input {
    min-width: 165px !important;
    max-width: 180px !important;                    
}
.fileinput .btn {
    font-size: 13px;
}
}  
</style>
@endsection

@section('page_scripts')
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/js/includes/email_template.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>

<script>
    function removeImg(id) {
        if(confirm('{{trans('app.email_templates.add_new.messages.image_delete')}}')) {
            $.ajax({
                url: "{{ url('/') }}"+'/email-template/'+id,
                type: "PUT",
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{ url('/') }}"+"/email-template/"+id+"/edit/?view";
                    }
                }
            });
        }
    }
</script>
@endsection

@section('content')
<script src="/js/libs/ckeditor/ckeditor.js"></script>
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="GRTyyHaG">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.email_templates.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{ $page_data['title'] }}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{ $page_data['title'] }}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="AlCOSpXf">
    <p>
        {{getHeading(trans('app.headings.email_templates.add'))}}
    </p>
</div>
@if (Session::has('msg'))
<div class="alert alert-success" data-name="bUPnIWKa">
    {{ Session::get('msg') }}
</div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="PghZlkav">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="tAIXlWMZ">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="yKDUPHCL">
    <!-- BEGIN FORM-->
    @if ($page_data['action'] == 'add')
        <form action="{{ route('email-template.store') }}" method="POST" id="email_template-frm" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" id="action" value="add">
    @else  
        <form action="{{ route('email-template.update',  $email_template->id) }}" method="POST" id="email_template-frm" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" id="template-id" value="{{$email_template->id}}">
        <input type="hidden" name="_method" value="PUT">
    @endif
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-md-12" data-name="SdInHCty">
        <div class="portlet box green" data-name="Glysemxc">
            <div class="portlet-title" data-name="OWIjiRls">
                <div class="caption" data-name="SUsFfDMP">
                    <span class="caption-subject">{{trans('app.email_templates.add_new.table_headings.template_details')}}</span>
                </div>
            </div>
            <div class="portlet-body" data-name="NHEyPGCr">
                <div class="form-body" data-name="HpEQQVIX">
                    <div class="form-group" data-name="hWKjZUOZ">
                        <label class="control-label col-md-2">{{trans('app.email_templates.add_new.fields.group')}}
                            <span class="required"> * </span>
                            <span   data-toggle="tooltip"  title="Add New Group" >
                                <a href="#modal-group-label" data-toggle="modal"><i class="fa fa-plus-square-o fa-fw"></i></a>
                            </span>
                        </label>
                        <div class="col-md-8" data-name="tRWOIvRl">
                            <select class="form-control select2" data-placeholder="Choose Group" name="group_id" id="group-id">
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ (isset($email_template->group_id) && $email_template->group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <i class="fa fa-question-circle-o popovers"  data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.email_templates.add_new.template_group.description')}}" data-original-title="{{trans('app.help.email_templates.add_new.template_group.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="uzWfSJNQ">
                        <label class="control-label col-md-2">{{trans('app.email_templates.add_new.fields.name')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="xsYyhLIc">
                            <div class="input-icon right" data-name="CWZkoKUM">
                                <i class="fa"></i>
                                <input type="text" name="name" class="form-control" value="{{isset($email_template->name) ? $email_template->name : '' }}" required /> 
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.email_templates.add_new.template_name.description')}}" data-original-title="{{trans('app.help.email_templates.add_new.template_name.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="PJKNtXEr">
                        <label class="control-label col-md-2">{{trans('app.email_templates.add_new.fields.html_content')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="EuiaoFHA">
                            <div class="input-icon right" data-name="unMEBRzI">
                                <i class="fa"></i>
                                <textarea id="content_html" name="content_html">{{isset($email_template->content_html) ? $email_template->content_html : '' }}</textarea>
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.email_templates.add_new.html_content.description')}}" data-original-title="{{trans('app.help.email_templates.add_new.html_content.title')}}"></i>
                    </div>
                        <div class="form-group" id="file-from-computer" data-name="aHSvFQKK">
                            <label class="control-label col-md-2">{{trans('app.email_templates.add_new.fields.preview.title')}}
                            </label>
                            <div class="col-md-8" data-name="KtgplgbA">
                                <div class="fileinput fileinput-new" data-provides="fileinput" data-name="HnwkOiDL">
                                    <div class="fileinput fileinput-new" data-provides="fileinput" data-name="OHOSUEax">
                                    <div class="input-group input-large" data-name="dbzpwPor">
                                        <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput" data-name="KcuCWKWt">
                                            <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                            <span class="fileinput-filename"></span>
                                        </div>
                                        <span class="input-group-addon btn default btn-file">
                                            <span class="fileinput-new"> {{trans('app.email_templates.add_new.fields.preview.values.select_file')}} </span>
                                            <span class="fileinput-exists"> {{trans('app.email_templates.add_new.fields.preview.values.change')}} </span>
                                            <input type="hidden" value="" name="...">
                                            <input type="file" name="attachment" id="attachment" value="" onchange="ValidateSize(this)" />
                                            <span style="color:red; display:none"  id="FileSizeError">{{trans('common.email_template.create_blade.file_size_span')}}<span>
                                        </span>
                                        <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> {{trans('app.email_templates.add_new.fields.preview.values.remove')}} 
                                        </a>
                                        @if (!empty($attached_files))
                                        <span style="padding-left: 20px;" id='attachment'>
                                                <a href="javascript:;" onclick="window.open('/assets/templates/{{ $email_template->id }}/{{ $attached_files['basename'] }}')">{{ $attached_files['basename'] }} </a>
                                                <i class="fa fa-remove remove-attachment" onclick="removeImg( {{ $email_template->id }} )"></i>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="form-actions" data-name="RfJDHcIa">
                    <div class="row" data-name="TDjdFAjk">
                        <div class="col-md-offset-2 col-md-9" data-name="CWEAORDD">
                            <button type="submit" name="save_add" class="btn green" value="save_add">{{trans('app.email_templates.add_new.buttons.save_add')}}</button>
                            @if ($page_data['action'] == 'add')
                            <button type="submit" name="save_exit" class="btn green" value="save_exit">{{trans('app.email_templates.add_new.buttons.save_exit')}}</button>
                            @else
                            <button type="submit" name="edit" class="btn green" value="edit">{{trans('app.campaigns.add_new.buttons.save')}}</button>
                            @endif
                            @if(Session::has('view') && Session::get('view') == 'list')
                            <a href="{{ route('email-template.index') }}"><button type="button" class="btn grey-salsa btn-outline">{{trans('app.email_templates.add_new.buttons.return')}}</button></a>
                            @else
                            <a href="{{ route('email.template.view') }}"><button type="button" class="btn grey-salsa btn-outline">{{trans('app.email_templates.add_new.buttons.return')}}</button></a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>

<div id="modal-group-label" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="FyhKsdPT">
    <div class="modal-dialog" data-name="YlXDIkZA">
        <div class="modal-content" data-name="gkbeINaA">
            <div id="msg-group" class="display-hide" data-name="oFgiwnBe">
                <span id='msg-text-group'><span>
            </div>
            <div class="modal-header" data-name="kJivLmpo">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{trans('app.email_templates.add_new.table_headings.add_new_group')}}</h4>
            </div>
            <div class="modal-body" data-name="nMJmNAdk">
            <form action="" id="frm-group" method="post" class="form-horizontal">
                @for ($i = 1; $i < 6; $i++)
                    <div class="form-group" data-name="oNAwrVTq">
                        <label class="col-md-3 control-label" >{{trans('app.email_templates.add_new.fields.group_name')}} {{ $i }}</label>
                        </label>
                        <div class="col-md-9" data-name="LlOOsaxe">
                            <input type="text"  name="name[]" class="form-control"  {{ ($i == 1) ? 'required' : '' }}> 
                        </div>
                    </div>
                @endfor
                <div class="form-actions" data-name="NTRiaVqu">
                    <div class="row" data-name="GbAxErYd">
                        <div class="col-md-offset-3 col-md-9" data-name="JfEOHCIr">
                            <button type="submit" class="btn green">{{trans('app.email_templates.add_new.buttons.submit')}}</button>
                            <button type="reset" class="btn grey-salsa btn-outline">{{trans('app.email_templates.add_new.buttons.reset')}}</button>
                            <input type="hidden" value="4" name="section_id">
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<script>
    CKEDITOR.replace( 'content_html', {
            fullPage: true,
            allowedContent: true,
            height: 320
        });
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKEDITOR.config.extraPlugins = 'imageuploader,preview';
</script>>
@endsection