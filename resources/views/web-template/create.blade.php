@extends('layouts.master')

@section('title', trans('web_templates.web_create_blade.create_template_titile'))

@section('page_styles')
<style type="text/css">
    .form-control.error {
        border: 1px solid red;
    }
    .error {
        color: red;
    }
</style>
@endsection

@section('page_scripts')
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script type="text/javascript">

    function insertIntoCkeditor(str){
        CKEDITOR.instances['content_html'].setData(str);
    }

    $(document).on("change", "#name", function() {

        var tempID = $("#name").select2('val');
        $("#tempID").val(tempID);
        var getTempID = $("#tempID").val(tempID);

        var method = 'GET';
        var url = '{{ Route("webtemplate.getTemplate","") }}';

        $.ajax({
            url: url+'/'+tempID,
            type: method,
            dataType:'json',
            beforeSend: function () {
                $("#modal-loading").modal('show');
            },
            complete: function () {
                $("#modal-loading").modal('hide');
            },
            success: function(result) {
                 $("#content_html").text(result.content);
                 insertIntoCkeditor(result.content);
            }
        });
    });   
    $(document).ready(function () {

        //var editor_data = CKEDITOR.instances['content_html'].getData();

        $("#web-template-frm").validate({
            submitHandler: function (form) {
                var id = $("#name").select2('val');
                var method = 'PUT';
                var url = '{{ Route("webtemplate.update","") }}';
                var form_data =  $("#web-template-frm").serialize();
                $.ajax({
                    url: url+'/'+id,
                    type: method,
                    data: form_data,
                    dataType:'json',
                    beforeSend: function () {
                        $("#modal-loading").modal('show');
                    },
                    complete: function () {
                        $("#modal-loading").modal('hide');
                    },
                    success: function(result) {
                        if (result.response == 'saved') {
                            Command: toastr["success"] ("{{trans('web_templates.web_create_blade.successfully_Updated_command')}}");
                        }    
                        else {
                            Command: toastr["error"] ("{{trans('web_templates.web_create_blade.something_went_wrong_command')}}");
                        }
                        return false;
                    }
                });
            }
        });        
    });
</script>
@endsection

@section('content')

<script src="/js/libs/ckeditor/ckeditor.js"></script>
<script src="/js/libs/ckeditor/plugins/font/plugin.js"></script> 
<script src="/js/libs/ckeditor/plugins/colorbutton/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/zsuploader/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/smiley/plugin.js"></script>

<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="KgZmaxcm">
    <ul class="page-breadcrumb">
        <li>
            <span><a href="{{ route('dashboard') }}">{{trans('app.breadcrumbs.dashboard')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><a href="{{ route('webtemplate.create') }}">{{trans('web_templates.web_create_blade.web_templates_span')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('web_templates.web_controller.add_new_title')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('web_templates.web_create_blade.add_template_heading')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="DSEYXFcp">
    <p>
        {{getHeading(trans('app.headings.list_management.custom_fields.view'))}}
    </p>
</div>
<!-- will be used to show any messages -->
@if($errors->any())
    <div class="alert alert-danger" data-name="ISwseJYO">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
@if (Session::has('msg'))
<div class="alert alert-success" data-name="isWLGeIF">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="wxOOnqui">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="ZtNtocfN">
    <!-- BEGIN FORM-->
    <form accept-charset="UTF-8" action="" method="POST" id="web-template-frm" class="form-horizontal" enctype="multipart/form-data">
        <input type="hidden" id="action" value="add">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="col-md-12" data-name="kQYPivgE">
            <div class="portlet light bordered" data-name="iAgNxfNS">
                <div class="portlet-title" data-name="HEJkLOMR">
                    <div class="caption" data-name="sHbZWNVK">
                        <span class="caption-subject">{{trans('web_templates.web_create_blade.web_template_detail_span')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="TXkebLJN">
                    <div class="form-body" data-name="dRtHwnUO">
                        <div class="form-group" data-name="mMkPrZCo">
                            <label class="control-label col-md-3">{{trans('web_templates.web_create_blade.choose_template_label')}}
                                <span class="required"> * </span>
                            </label>
                           
                            <div class="col-md-6" data-name="cZKZxGlq">
                                <div class="input-icon right" data-name="wigFfloH">
                                    <i class="fa"></i>
                                    <select class="form-control select2" name="name" id="name">
                                        @php($flag=0)
                                       @foreach($web_templates as $template)
                                           @if ($template->active==1)
                                         @php($temp = $template)
                                         @php($selected = 'selected')
                                          @php($flag ++)
                                         @else
                                         @php($selected = '')
                                        @endif
                                        <option {{ $selected }} value="{{ $template->id }}">{{ $template->name }}</option>
                                        @endforeach
                                    </select>       
                                    <input type="hidden" name="tempID" id="tempID" value="">                
                                </div>
                            </div>
                            <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('web_templates.web_create_blade.template_name_here_data')}}" data-original-title="{{trans('web_templates.web_create_blade.template_name_title')}}"></i>
                        </div>
                        <div class="form-group" data-name="mDPKTiso">
                            <label class="control-label col-md-3">{{trans('web_templates.web_create_blade.page_html_label')}}
                                <span class="required"></span>
                            </label>
                            <div class="col-md-6" data-name="UylsWzfA">
                                <div class="input-icon right" data-name="LjKVuvXB">
                                    <i class="fa"></i>
                                    <textarea name="content_html" id="content_html">
                                        {!! $temp->content_html !!}
                                    </textarea>
                                </div>
                            </div>
                            <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('web_templates.web_create_blade.insert_page_html_data')}}" data-original-title="{{trans('web_templates.web_create_blade.page_html_label')}}"></i>
                        </div>
                    </div>
                    <div class="form-actions" data-name="xqiPoBeu">
                        <div class="row" data-name="YPDByopV">
                            <div class="col-md-offset-3 col-md-6" data-name="EtsJphdD">
                                <button type="submit" id="submit" name="save_add" class="btn green" value="save_add">{{trans('web_templates.web_create_blade.save_template_button')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
</div>

<script>
    editor = CKEDITOR.replace( 'content_html', {
        fullPage: true,
        allowedContent: true,
        height: 220
    });
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKEDITOR.config.extraPlugins = 'preview,font,zsuploader,smiley';
</script>
@endsection