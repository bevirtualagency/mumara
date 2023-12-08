@extends(decide_template())

@section('title',  $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/drip-campaign-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style type="text/css">
#email_pre_header_text {
    margin-top: 5px;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/scripts.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/drip.js?t={{time()}}" type="text/javascript"></script>
<script src="/themes/default/js/includes/autoresponder.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.dm-uploader.min.js" type="text/javascript"></script>
<script src="/themes/default/js/demo-ui.js?v={{$local_version}}" type="text/javascript"></script>

@if(in_array('Emojis', whmcsAddOns()))
<!-- <link href="/themes/default/js/emojis/jquery.emojipicker.css" rel="stylesheet">
<script src="//code.jquery.com/jquery.min.js"></script>  
<script src="/themes/default/js/emojis/jquery.emojipicker.js"></script>
<link href="/themes/default/js/emojis/jquery.emojipicker.tw.css" rel="stylesheet">
<script src="/themes/default/js/emojis/jquery.emojis.js"></script>-->
<script src="/themes/default/js/emojies/emojies.min.js"></script>
@endif
<script type="text/html" id="files-template">
    <li class="media">
        <div class="media-body mb-1">
            <input type="hidden" name="has_images[]" value="%%filename%%">
            <p class="mb-2">
                <strong class="filename">%%filename%%</strong>  <span class="text-muted">{{trans('broadcasts.waiting')}}</span>
            <div class="progress progress-striped mb-2">
                <div class="progress-bar progress-bar-success progress-bar-animated"
                     role="progressbar"
                     style="width: 0%"
                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            </p>
            <div class="la la-close font-red pull-right removeFile" data-file=""></div>
            <hr class="mt-1 mb-1" />
        </div>
    </li>
</script>
<script>
jQuery(document).ready(function() {
        $('#enable_preheader').change(function(){
          if($(this).is(':checked')){
            $('#email_pre_header_text').show();
          }else{
            $('#email_pre_header_text').hide();
          }
        });
        $('#enable_preheader').change();
    });
    $('#copyAsText').click(function() {

        var content_html = CKEDITOR.instances['content_html'].getData(); // For CK editor editor
        jQuery('#content_js').html(content_html).find('a').each(function(){
            var href=jQuery(this).attr('href');
            var label=jQuery(this).text();
            if( href && href !="#"){
                var link= (label && label !="") ? label +":"+ href:href;
            }else{
                var link=label;
            }
            jQuery(this).replaceWith(link);
        });
        // Removing extra spaces e.g newline, tabs etc with single one
        // content_html=$.trim(jQuery('#content_js').text()).replace(/\s\s+/g, ' ');
        content_html=jQuery('#content_js').html();
        $(".blockUI").show();
        $.ajax({
            url: "{{ route('converHtmlToText') }}",
            type: "POST",
            data: {html: content_html},
            success: function(result) {
                $(".blockUI").hide();
                $('#content_text').val(result);
            },
            error: function(err) {
                $(".blockUI").hide();
            }
        });

    });
    $(document).ready(function() {
        $(".m-select2").select2({
            placeholder: 'Select Option',
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
    });
    // select system variable and additional field
    function selectTag(field, ckeditor_id) {
        if(field == 'Unsubscribe Link')
            field = '<a href="%%unsubscribelink%%">{{trans('broadcasts.unsubscribe')}}</a>';
        else if(field == 'Confirm Link')
            field = '<a href="%%confirmurl%%">{{trans('broadcasts.confirm')}}</a>';
        else if(field == 'web_version')
            field = '<a href="%%web_version%%">{{trans('broadcasts.web_version')}}</a>';
        else
            field = '%%'+field+'%%';

        CKEDITOR.instances[ckeditor_id].insertHtml(field);
    }
     function replaceVariable(ckeditor_id,selectID){
        var field = $("#"+selectID).val();
        if(field!=""){
            if(selectID=='spintags_variables'){
                selectSpintag(field, ckeditor_id)
            }
            else if(selectID=='dynamic_content_variables'){
                field = "[["+field+"]]";
                selectDynamicContent(field, ckeditor_id)
            }else{
                selectTag(field, ckeditor_id); 
            }
            setTimeout(function() {
                 $("#"+selectID).val(null).trigger('change.select2');
            }, 1000);
        }
    }
    // select spintag 
    function selectSpintag(spintag, ckeditor_id) {
        spintag = '{'+'{'+spintag+'}'+'}';
        CKEDITOR.instances[ckeditor_id].insertText(spintag);
    }
    // select Dynamic content
    function selectDynamicContent(dynamic_content, ckeditor_id) {
        dynamic_content = dynamic_content;
        CKEDITOR.instances[ckeditor_id].insertText(dynamic_content);
    }
    // copy HTML body in text
    $('#copyAsText').click(function() {
        var content_html = CKEDITOR.instances['content_html'].getSnapshot();
        // replace <br> with \n for text content
        var content = content_html.replace(/<br\s*\/?>/mg,"\n");
        // remove all the other html tags for text content
        var regex = /(<([^>]+)>)/ig
        var content = $.trim(content.replace(regex, ""));
        //var regex = /(<([^>]+)>)/ig
        //var content = $.trim(content_html.replace(regex, ""));
        $('#content_text').html(content);
    });
</script>
<script>
    $('#all_contacts').click(function() {
        $('.type').hide();
    });
    $('#selected').click(function() {
        $('.type').show();
    });
    // when to send drip
    $(function() { 
        $('#autoresponder_group_id').change();
    });
    
    $('#autoresponder_group_id').change(function () {
        var senderinformation = $("#autoresponder_group_id option:selected").data("type");
        $(".DripPreviewDomain").hide();
        if(senderinformation == "from_list") { 
            $(".DripPreviewDomain").show();
        }
    });

    $('#perform-action-event').change(function () {
        var action = $('#perform-action-event').val();
        if (action == 'after') {
            $("#durationDB").show();
            $('#perform-action-datetime-count').removeAttr("disabled");
            $('#perform-action-datetime-frequency').removeAttr("disabled");
        } else {
            $("#durationDB").hide();
            $('#perform-action-datetime-count').prop("disabled", true);
            $('#perform-action-datetime-frequency').prop("disabled", true);
        }
    });
    // on page load
     $(window).on("load",function() { 
        var page_data = document.getElementById("page_data_action").value;
        var action = $('#perform-action-event').val();
        if(page_data == "edit"){
            if (action == 'after') {
                $("#perform-action-datetime-count").removeAttr('disabled');
                $("#perform-action-datetime-frequency").removeAttr('disabled');
            } else {
                $('#perform-action-datetime-count').prop("disabled", true);
                $('#perform-action-datetime-frequency').prop("disabled", true);       
            }
        }
     });
    $(document).on("click", ".removeFile", function() {
        var file_name = $(this).parent().children('p.mb-2').find('.filename').html();
        var list_block_id = $(this).parent().parent().attr('id');
        $.ajax({
            url: "{{ route('dripImageDelete') }}",
            type: "POST",
            data:  {"file_name": file_name,'from':'temp'},
            success: function(result) {
                if(result=='success'){
                    $("#"+list_block_id).remove();
                    $("#imgMsg").append("<li> "+ file_name+" {{trans('broadcasts.message.successfully_moved')}} </li>");
                }

            }
        });
    });

    $(document).on("click", ".removeFile2", function() {
        var file_name = $(this).parent().children('p.mb-2').find('.filename').html();
        var list_block_id = $(this).parent().parent().attr('id');
        $.ajax({
            url: "{{ route('dripImageDelete') }}",
            type: "POST",
            data: {"file_name": file_name, "from": $("#drip_id").val()},
            success: function(result) {
                if(result=='success'){
                    $("#"+list_block_id).remove();
                    $("#imgMsg").append("<li> "+ file_name+" {{trans('broadcasts.message.successfully_moved')}} </li>");
                    return false;
                }

            }
        });

    });

    $('#drag-and-drop-zone').dmUploader({ //
        url: '{{route('dripUploadImages')}}?drip_id='+$("#drip_id").val(),
        maxFileSize: 10000000, // 3 Megs
        onDragEnter: function(){
            // Happens when dragging something over the DnD area
            this.addClass('active');
        },
        onDragLeave: function(){
            // Happens when dragging something OUT of the DnD area
            this.removeClass('active');
        },
        onInit: function(){
            // Plugin is ready to use
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.penguin_initialized')}}:)', 'info');
        },
        onComplete: function(){
            // All files in the queue are processed (success or error)
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.all_pending_transfers_finished')}}');
        },
        onNewFile: function(id, file){
            // When a new file is added using the file selector or the DnD area
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.new_file_added')}} #' + id);
            ui_multi_add_file(id, file);
        },
        onBeforeUpload: function(id){
            // about tho start uploading a file
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.starting_the_upload_of')}} #' + id);
            ui_multi_update_file_status(id, 'uploading', '{{trans('broadcasts.add_new.form.drag_drop_zone.uploading')}}...');
            ui_multi_update_file_progress(id, 0, '', true);
        },
        onUploadCanceled: function(id) {
            // Happens when a file is directly canceled by the user.
            ui_multi_update_file_status(id, 'warning', '{{trans('broadcasts.add_new.form.drag_drop_zone.canceled_by_user')}}');
            ui_multi_update_file_progress(id, 0, 'warning', false);
        },
        onUploadProgress: function(id, percent){
            // Updating file progress
            ui_multi_update_file_progress(id, percent);
        },
        onUploadSuccess: function(id, data){
            // A file was successfully uploaded
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.server_response_for_file')}} #' + id + ': ' + JSON.stringify(data));
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.upload_of_file')}} #' + id + ' COMPLETED', 'success');
            ui_multi_update_file_status(id, 'success', '{{trans('broadcasts.add_new.form.drag_drop_zone.upload_complete')}}');
            ui_multi_update_file_progress(id, 100, 'success', false);
        },
        onUploadError: function(id, xhr, status, message){
            ui_multi_update_file_status(id, 'danger', message);
            ui_multi_update_file_progress(id, 0, 'danger', false);
        },
        onFallbackMode: function(){
            // When the browser doesn't support this plugin :(
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.plugin_cannot_be_used_here')}}', 'danger');
        },
        onFileSizeError: function(file){
            ui_add_log('{{trans('broadcasts.add_new.form.drag_drop_zone.file')}} \'' + file.name + '\' {{trans('broadcasts.add_new.form.drag_drop_zone.cannot_be_added')}}: {{trans('broadcasts.add_new.form.drag_drop_zone.add.size_excess_limit')}}', 'danger');
        }

    });

</script>

@if(in_array('Emojis', whmcsAddOns()))
<!-- <script type="text/javascript">
    $(document).ready(function(e) {
        $('#email_subject').emojiPicker();
    });
</script> -->
<style type="text/css">.emoji-picker{margin:0 .5em;border:1px solid #999;border-radius:5px;box-shadow:0 0 3px 1px #ccc;background:#fff;width:20.5rem;height:27.5rem;font-family:Arial,Helvetica,sans-serif}.emoji-picker__content{padding:.5em;height:20.5rem}.emoji-picker__preview{height:2em;padding:.5em;border-top:1px solid #999;display:flex;flex-direction:row;align-items:center}.emoji-picker__preview-emoji{font-size:2em;margin-right:.25em}.emoji-picker__preview-name{color:#666;font-size:.85em;overflow-wrap:break-word;word-break:break-all}.emoji-picker__tabs{margin:0;padding:0;display:flex}.emoji-picker__tab{list-style:none;display:inline-block;padding:0 .5em;cursor:pointer;flex-grow:1;text-align:center}.emoji-picker__tab.active{border-bottom:3px solid #4f81e5;color:#4f81e5}.emoji-picker__tab-body{display:none;margin-top:.5em}.emoji-picker__tab-body h2{font-size:.75rem;text-transform:uppercase;color:#333;margin:0}.emoji-picker__tab-body.active{display:block}.emoji-picker__emojis{height:18rem;overflow-y:scroll;display:flex;flex-wrap:wrap;align-content:flex-start;width:calc(1.3rem * 1.5 * 10);margin:auto}.emoji-picker__emoji{background:0 0;border:none;border-radius:5px;cursor:pointer;font-size:1.3rem;width:1.5em;height:1.5em;padding:0;margin:0}.emoji-picker__emoji:hover{background:#e8f4f9}.emoji-picker__search-container{margin:.5em;position:relative;height:2em;display:flex}.emoji-picker__search-container input{box-sizing:border-box;width:100%;border-radius:5px;border:1px solid #ccc;padding-right:2em}.emoji-picker__search-icon{position:absolute;color:#ccc;width:1em;height:1em;right:.75em;top:calc(50% - .5em)}.emoji-picker__search-not-found{color:#666;text-align:center;margin-top:2em}.emoji-picker__search-not-found-icon{font-size:3em}.emoji-picker__search-not-found h2{margin:.5em 0;font-size:1em}.emoji-block>input#email_subject,#email_pre_header_input {border-top-right-radius: 0;border-bottom-right-radius: 0;} button#emoji-button>svg, #emoji-button-pre-header >svg {width: 20px;height: 20px;} button#emoji-button,#emoji-button-pre-header {border: 1px solid #bec4d0 !important;border-left: 0 !important;width: 40px;text-align: center;align-items: center;justify-content: center;display: flex;border-top-right-radius: 4px;border-bottom-right-radius: 4px;} .emoji-picker__tab>svg {font-size: 20px;} .emoji-picker__tab.active {border-bottom: 3px solid #0f997f;color: #0f997f;} .emoji-picker__preview {height: 4.5em;margin-top: 1em;}</style>
<script>
  window.addEventListener('DOMContentLoaded', () => {
    EmojiButton(document.querySelector('#emoji-button'), function (emoji) {
      document.getElementById('email_subject').value += emoji;
    });
    EmojiButton(document.querySelector('#emoji-button-pre-header'), function (emoji) {
      document.getElementById('email_pre_header_input').value += emoji;
    });
  });
</script>
@endif

@endsection

@section(decide_content())
<input type="hidden" id="page_data_action" value="{{ $page_data['action'] }}">
<script src="/js/libs/ckeditor/ckeditor.js"></script>
<script src="/js/libs/ckeditor/plugins/font/plugin.js"></script>
<script src="/js/libs/ckfinder/ckfinder.js"></script>


@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="xFtrgZMS">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="SCktpgzT">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="JNerUEGA">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="row" data-name="aQuRpMSm">
    <div id="content_js" style="display: none" data-name="tBOkABhS"></div>
    <div class="col-md-8 create-form" data-name="eVyyvNDj">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="jsIseDtY">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="kOeJppoz">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="zXgAcIeI">
                    <div class="kt-wizard-v4__nav-items" data-name="MGCCNhWD">
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="QLPyDBAu">
                                <div class="kt-wizard-v4__nav-number" data-name="Jwiqggyt">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="bNTVOJhF">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="MwSrNRut">
                                        {{trans('drip_campaigns.add_new.tab1.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="UjBpHjpg">
                                        {{ trans('drip_campaigns.add_new.tab1.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="xFlSOSVK">
                                <div class="kt-wizard-v4__nav-number" data-name="aMxOArdD">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="rdwVUwZM">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="nKRaieAa">
                                        {{trans('drip_campaigns.add_new.tab2.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="tuPxVORw">
                                        {{ trans('drip_campaigns.add_new.tab2.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="UsqKDTxg">
                                <div class="kt-wizard-v4__nav-number" data-name="JmJebHuJ">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="HWnYJLry">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="RxiJADtn">
                                        {{trans('drip_campaigns.add_new.tab3.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="kMKkmjol">
                                        {{ trans('drip_campaigns.add_new.tab3.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="kt-portlet form" data-name="YCzZEzKy">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="kIGkKDLt">
                        <div class="kt-grid" data-name="xQIORCSL">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="CrJpuwKg">
                                <!-- BEGIN FORM-->
                                @if ($page_data['action'] == 'add')
                                <form action="{{route('drips.store')}}" class="kt-form kt-form--label-right" id="kt_form" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="EditiorHTMLVal" name="EditiorHTMLVal" value="">
                                    <input type="hidden" id="drip_id" value="0">
                                @else    
                                <form action="{{ route('drips.update', $autoresponder->id) }}" method="POST" id="kt_form" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="edit">
                                    <input type="hidden" name="_id" value="{{$autoresponder->id}}">
                                    <input type="hidden" id="EditiorHTMLVal" name="EditiorHTMLVal" value="">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" id="drip_id" value="{{$autoresponder->id}}">
                                @endif
                                    <div class="form-wizard" id="form_wizard_1" data-name="lZRizSGQ">
                                        <div class="form-body" data-name="kJNjApsE">

                                            <div class="tab-content" data-name="vwdyzWRU">
                                                <div class="alert alert-danger display-none" data-name="cHwqtzLE">
                                                    <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} 
                                                </div>
                                                <div class="alert alert-success display-none" data-name="IRhekPXW">
                                                    <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} 
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="czHIqKDs">
                                                    <div class="kt-form__section kt-form__section--first" data-name="yUJVJyxI">
                                                        <div class="kt-wizard-v4__form" data-name="AihHUpEH">
                                                            <div class="form-group row" data-name="NoFDngUy">
                                                                <div class="col-md-6" data-name="NojHxsJP">
                                                                    <label class="col-form-label">
                                                                      {{trans('drip_campaigns.add_new.tab1.followup_name')}}
                                                                      <span class="required"> * </span>
                                                                      {!! popover( 'drip_campaigns.add_new.tab1.followup_name_help','common.description' ) !!}
                                                                    </label>
                                                                    <input type="text" class="form-control" name="name" value="{{isset($autoresponder->name) ? $autoresponder->name : '' }}" required />
                                                                </div>
                                                                <div class="col-md-6" data-name="JWiwhuqy">
                                                                    <label class="col-form-label">{{trans('common.label.group')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover( 'drip_campaigns.add_new.tab1.group_help','common.description' ) !!}
                                                                    </label>
                                                                    <select class="form-control m-select2" required="" data-placeholder="{{ trans('common.label.select_group')}}" name="autoresponder_group_id" id="autoresponder_group_id">
                                                                        @foreach($groups as $group)
                                                                            <?php 
                                                                                $sender_information = json_decode($group->meta_attributes,true);
                                                                                $sender_information  = !empty($sender_information["sender_information"]) ? $sender_information["sender_information"] : "";
                                                                            ?>
                                                                            <option value="{{ $group->id }}" data-type="{{$sender_information}}" {{ (isset($autoresponder->autoresponder_group_id) && $autoresponder->autoresponder_group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" data-name="woSmOXrS">
                                                                <div class="col-md-6" data-name="EyanVFfa">
                                                                    <label class="col-form-label">{{trans('common.label.status')}}
                                                                         {!! popover( 'drip_campaigns.add_new.tab1.status_help','common.description' ) !!}
                                                                    </label>
                                                                    @if((isset($autoresponder->is_active) && $autoresponder->is_active == 1)|| Request::segment(2)=='create')
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked" id="status" name="status">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                            <label>
                                                                                <input type="checkbox" id="status" name="status">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                                <div class="col-md-6" data-name="IKfDkePp">
                                                                    <label class="col-form-label">{{trans('drip_campaigns.add_new.tab1.send_to_existing')}}
                                                                        {!! popover( 'drip_campaigns.add_new.tab1.send_to_existing_help','common.description' ) !!}
                                                                    </label>
                                                                    @if(isset($autoresponder->send_to_existing) && $autoresponder->send_to_existing == 1)
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                            <label>
                                                                                <input type="checkbox" checked="checked" id="send_to_existing" name="send_to_existing">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
                                                                            <label>
                                                                                <input type="checkbox" id="send_to_existing" name="send_to_existing">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="HYhNLrjc">
                                                    <div class="kt-heading kt-heading--md" data-name="MJHVJVaz">{{ trans('drip_campaigns.add_new.tab2.enter_account_details') }}</div>
                                                    <div class="kt-form__section kt-form__section--first" data-name="KsQBXDmG">
                                                        <div class="kt-wizard-v4__form" data-name="ajWhvmtM">
                                                            <div class="form-group row" data-name="wowpEpPC">
                                                                    
                                                                <div class="col-md-12" data-name="vJQIjcLT">
                                                                    <label class="col-form-label">
                                                                        {{trans('drip_campaigns.add_new.tab2.when_to_send')}}
                                                                        {!! popover( 'drip_campaigns.add_new.tab2.when_to_send_help','common.description' ) !!}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="VRvCwYni">
                                                                        <select class="form-control" name="perform_action_event" id="perform-action-event">
                                                                            <option value="on_event" {{ (isset($meta_data->perform_action_event) && $meta_data->perform_action_event == "on_event") ? 'selected' : '' }}>{{trans('drip_campaigns.add_new.tab2.upon_triggering')}}</option>
                                                                            <option value="after" {{ (isset($autoresponder->perform_action_datetime_frequency) && $autoresponder->perform_action_datetime_frequency != null) ? 'selected' : '' }}>{{trans('drip_campaigns.add_new.tab2.after_triggering')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row" data-name="mnwEawgu" id="durationDB" style="display: {{ (isset($autoresponder->perform_action_datetime_frequency) && $autoresponder->perform_action_datetime_frequency != null) ? 'flex' : 'none' }};">
                                                                <div class="col-md-6" data-name="lUryOWMi">
                                                                    <div class="input-icon right" data-name="RTnNeVaJ">
                                                                        <input class="form-control" name="perform_action_datetime_count" id="perform-action-datetime-count" value="{{isset($autoresponder->perform_action_datetime_count) ? $autoresponder->perform_action_datetime_count : '' }}" disabled="" type="number" />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6" data-name="JOmkFIUF">
                                                                    <div class="input-icon right" data-name="FCDdrnkA">
                                                                        <select class="form-control" name="perform_action_datetime_frequency" id="perform-action-datetime-frequency" disabled="">
                                                                            <option value="minutes" {{ (isset($autoresponder->perform_action_datetime_frequency) && $autoresponder->perform_action_datetime_frequency == "minutes") ? 'selected' : '' }}>{{trans('common.minutes')}}</option>
                                                                            <option value="hours" {{ (isset($autoresponder->perform_action_datetime_frequency) && $autoresponder->perform_action_datetime_frequency == "hours") ? 'selected' : '' }}>{{trans('common.hours')}}</option>
                                                                            <option value="days" {{ (isset($autoresponder->perform_action_datetime_frequency) && $autoresponder->perform_action_datetime_frequency == "days") ? 'selected' : '' }}>{{trans('common.days')}}</option>
                                                                            <option value="weeks" {{ (isset($autoresponder->perform_action_datetime_frequency) && $autoresponder->perform_action_datetime_frequency == "weeks") ? 'selected' : '' }}>{{trans('common.weeks')}}</option>
                                                                            <option value="months" {{ (isset($autoresponder->perform_action_datetime_frequency) && $autoresponder->perform_action_datetime_frequency == "months") ? 'selected' : '' }}>{{trans('common.months')}}</option>
                                                                            <option value="years" {{ (isset($autoresponder->perform_action_datetime_frequency) && $autoresponder->perform_action_datetime_frequency == "years") ? 'selected' : '' }}>{{trans('common.years')}}</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="IsXGHjWh">
                                                    <div class="kt-heading kt-heading--md" data-name="GrGNgvoP">{{ trans('drip_campaigns.add_new.tab3.enter_account_details') }}</div>
                                                    <div class="kt-form__section kt-form__section--first" data-name="kGDWDiKT">
                                                        <div class="kt-wizard-v4__form" data-name="xRQEWlPa">

                                                            <div class="form-group row" data-name="hKXdFMMl">
                                                                    
                                                                <div class="col-md-12" data-name="ZJkbVgDa">
                                                                    <label class="col-form-label">{{trans('drip_campaigns.add_new.tab3.email_subject')}}
                                                                        <span class="required"> * </span>
                                                                         {!! popover( 'drip_campaigns.add_new.tab3.email_subject_help','drip_campaigns.add_new.tab3.email_subject' ) !!}
                                                                    </label>
                                                                    <div class="input-icon right d-flex @if(in_array('Emojis', whmcsAddOns())) emoji-block @endif" data-name="NDTjLhQX">
                                                                        <input type="text" name="email_subject" id="email_subject" value="{{isset($autoresponder->email_subject) ? $autoresponder->email_subject : '' }}" class="form-control" required>
                                                                        @if(in_array('Emojis', whmcsAddOns()))
                                                                            <button id="emoji-button" type="button"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="smile" class="svg-inline--fa fa-smile fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm4 72.6c-20.8 25-51.5 39.4-84 39.4s-63.2-14.3-84-39.4c-8.5-10.2-23.7-11.5-33.8-3.1-10.2 8.5-11.5 23.6-3.1 33.8 30 36 74.1 56.6 120.9 56.6s90.9-20.6 120.9-56.6c8.5-10.2 7.1-25.3-3.1-33.8-10.1-8.4-25.3-7.1-33.8 3.1z"></path></svg></button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row mh40" data-name="MjXkBXHJ">
                                  <div class="col-md-4" data-name="EyanVFfa">
                                    <label class="col-form-label">
                                      @lang('broadcasts.add_new.form.enable_preheader')
                                        {!! popover( 'broadcasts.add_new.form.enable_preheader_help','common.description' ) !!}
                                    </label>
                                          <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12 mt0">
                                            <label>
                                                <input type="checkbox" id="enable_preheader" name="enable_preheader" @if( isset($meta_data->enable_preheader) && $meta_data->enable_preheader=="on") checked @endif>
                                                <span></span>
                                            </label>
                                        </span>
                                  </div>
                                <div class="col-md-12" id="email_pre_header_text" data-name="ULmIVUNw" style="display:none;">
                                  <div class="input-icon right d-flex @if(in_array('Emojis', whmcsAddOns())) emoji-block @endif" data-name="JOULSCteP">
                                  <input id="email_pre_header_input" placeholder="@lang('broadcasts.add_new.form.enable_preheader')" class="form-control" type="text"  name="email_pre_header_text" value="{{isset($meta_data->email_pre_header_text) ? $meta_data->email_pre_header_text : '' }}">
                                  <button id="emoji-button-pre-header" type="button"><svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="smile" class="svg-inline--fa fa-smile fa-w-16" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path fill="currentColor" d="M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 448c-110.3 0-200-89.7-200-200S137.7 56 248 56s200 89.7 200 200-89.7 200-200 200zm-80-216c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm160 0c17.7 0 32-14.3 32-32s-14.3-32-32-32-32 14.3-32 32 14.3 32 32 32zm4 72.6c-20.8 25-51.5 39.4-84 39.4s-63.2-14.3-84-39.4c-8.5-10.2-23.7-11.5-33.8-3.1-10.2 8.5-11.5 23.6-3.1 33.8 30 36 74.1 56.6 120.9 56.6s90.9-20.6 120.9-56.6c8.5-10.2 7.1-25.3-3.1-33.8-10.1-8.4-25.3-7.1-33.8 3.1z"></path></svg></button>
                                </div>
                                </div>
                            </div>
                                                            <div class="form-group row" data-name="zjzXijuX">
                                                                    
                                                                <div class="col-md-12" data-name="FOUNyAFZ">
                                                                    <label class="col-form-label">{{trans('drip_campaigns.add_new.tab3.html_body')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover( 'drip_campaigns.add_new.tab3.html_body_help','common.description' ) !!}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="cIzrmhml">
                                                                        <textarea id="content_html" name="content_html">{{@$meta_data->content_html}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="customFields" data-name="KQzpHJpT">
                                                                <!-- dynamic tags start -->
                                                                @php
                                                                    $ckeditor_id = 'content_html';
                                                                @endphp
                                                                @if($adminOnClient)
                                                                {{ dynamicTags(1, 2, $ckeditor_id,$autoresponder->user_id) }}
                                                                @else
                                                                    {{ dynamicTags(1, 2, $ckeditor_id) }}
                                                                @endif
                                                                <!-- dynamic tags end -->
                                                            </div>
                                                            
                                                            <div class="form-group row" data-name="KEhRSubP">
                                                                    
                                                                <div class="col-md-12" data-name="vtvEEwrO">
                                                                    <label class="col-form-label">{{trans('drip_campaigns.add_new.tab3.text_body')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover( 'drip_campaigns.add_new.tab3.text_body_help','common.description' ) !!}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="UfCbDNMJ">
                                                                        <textarea id="content_text" name="content_text" class="form-control" rows="15" required>{{@$meta_data->content_text}}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" data-name="ddBCWtfQ">

                                                                <div class="col-md-12"  data-repeater-list="files" data-name="DFLOgdHW">
                                                                    <label class="col-form-label">{{trans('broadcasts.add_new.form.attach_file')}}
                                                                        {!! popover( 'broadcasts.add_new.form.attach_file_help','common.description' ) !!}
                                                                    </label>
                                                                    <div id="drag-and-drop-zone" class="dm-uploader mt-repeater" data-name="kCIZQUZU">
                                                                        <div data-repeater-item data-name="QRUCodsP">
                                                                            <div data-repeater-item="" class="mt-repeater-item" data-name="KgPtMYMa">
                                                                                <div class="row mt-repeater-row" data-name="xhoCIHHo">

                                                                                    <div class="btn btn-block fonttest" data-name="YvaAszjs">
                                                                                        <i class="la la-cloud-upload" aria-hidden="true"></i>
                                                                                        {{trans('broadcasts.add_new.form.drop_or_browse_file_here')}}
                                                                                        <input type="file" title='Click to add Files' />
                                                                                    </div>
                                                                                    @if (isset($files_count) && $files_count==0)
                                                                                        <ul class="list-unstyled p-2 flex-column col" id="files">
                                                                                            <li class="text-muted text-center empty">{{trans('common.message.no_files_uploaded')}}</li>
                                                                                        </ul>
                                                                                    @else
                                                                                        <ul class="list-unstyled p-2 flex-column col" id="files">
                                                                                            @for($i = 0; $i < $files_count; $i++)
                                                                                                <li class="media" id='old_attachment_{{ $i }}'>
                                                                                                    <div class="media-body mb-1" data-name="MSRtwpRx">
                                                                                                        <p class="mb-2">
                                                                                                            <strong class="filename">{{ $attached_files[$i]['basename'] }}</strong>
                                                                                                        <div class="progress progress-striped" data-name="BjZgWPhQ">
                                                                                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" data-name="jnoUSnZH">100%</div>
                                                                                                        </div>
                                                                                                        </p>
                                                                                                        <div class="la la-close font-red pull-right removeFile2" data-name="zpEoPjnv"></div>
                                                                                                        <hr class="mt-1 mb-1" />
                                                                                                    </div>
                                                                                                </li>
                                                                                            @endfor
                                                                                        </ul>
                                                                                    @endif
                                                                                    <ul id="imgMsg"></ul>

                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" data-name="aNmBMMQs">
                                                                        
                                                                <div class="col-md-6" style="display:block;" data-name="BjHjDssk">
                                                                    <label class="col-form-label">{{trans('drip_campaigns.add_new.tab3.domain_to_use_for_preview')}}
                                                                    
                                                                         {!! popover( 'drip_campaigns.add_new.tab3.domain_to_use_for_preview_help','common.description' ) !!}
                                                                    </label>
                                                                    <select class="form-control m-select2" name="domain_id" id="domain_id">
                                                                        <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); ?>
                                                                        @php $disableFlag = 0; @endphp
                                                                        <optgroup label="{{trans('lists.eligible_domains')}}"> 
                                                                        @foreach($domain_maskings as $domain)
                                                                            @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')
                                                                            <option value="{{ $domain->id }}" >{{ $domain->domain }}  </option>
                                                                            @else 
                                                                                @php 
                                                                                    $disableTxt = "inactive";
                                                                                    if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                                                    if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                                                
                                                                                @endphp
                                                                                @php $disableFlag = 1; @endphp
                                                                            @endif
                                                                        @endforeach
                                                                        </optgroup>
                                                                        @if($disableFlag)
                                                                        <optgroup label="{{trans('lists.ineligible_domains')}}"> 
                                                                        @foreach($domain_maskings as $domain)
                                                                            @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')
                                                                            
                                                                            @else 
                                                                                @php 
                                                                                    $disableTxt = "inactive";
                                                                                    if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                                                    if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                                                
                                                                                @endphp
                                                                                <option disabled value="{{ $domain->id }}" >{{ $domain->domain }}  <small>({{$disableTxt}}) </small></option>
                                                                            @endif
                                                                        @endforeach
                                                                        </optgroup>
                                                                        @endif
                                                                    </select>
                                                                </div>


                                                                <!-- Domain Selection  -->

                                                                <div class="col-md-6" data-name="ESpQCEQR">
                                                                    <label class="col-form-label">{{trans('drip_campaigns.add_new.tab3.send_preview_to_email')}}
                                                                         {!! popover( 'drip_campaigns.add_new.tab3.send_preview_to_email_help' ,'common.description' ) !!}
                                                                    </label>
                                                                    <div class="input-group" data-name="sTbhXLvX">
                                                                        <input type="text" name="preview_email" id="preview_email" class="form-control" value=""/>
                                                                        <div class="input-group-append" data-name="pDBBZhJk">
                                                                            <button {{!isset($autoresponder) ? 'disabled' : ''}} type="button" class="btn green" id="smpt-send-mail">{{trans('drip_campaigns.add_new.tab3.test_email')}}</button>
                                                                        </div>
                                                                        <small style="padding: 5px"> {{trans('drip_campaigns.add_new.tab3.system_variable')}}</small>
                                                                    </div> 
                                                                    <div class="col-md-12" data-name="QpfjEtNU">
                                                                        <div id="mail-sent-msg" data-name="USGbxuGU"></div>
                                                                        <span id="mail-sent-log-link" style="display: none;"><a>
                                                                            {{trans('drip_campaigns.add_new.tab3.show_log')}}
                                                                        </a></span>
                                                                        <div id="mail-sent-log" style="display: none;" data-name="DeWSkLtT"></div>
                                                                    </div>
                                                                </div>


                                                            

                                                            </div>
                                                            <!-- END FORM-->
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                        <div class="kt-form__actions" data-name="gZqttsGa">
                                            <!-- back button -->
                                            <div class="btn btn-secondary btn-md" data-ktwizard-type="action-prev" data-name="TRxhsTfw">
                                                {{trans('common.form.buttons.back')}}
                                            </div>
                                            <!--  submit button -->
                                            <div class="btn btn-success btn-md" data-ktwizard-type="action-submit" data-name="NcukfEZU">
                                                {{trans('common.form.buttons.submit')}}
                                            </div>
                                            <!-- continue button -->
                                            <div class="btn btn-success btn-md" data-ktwizard-type="action-next" data-name="roAYjuws">
                                                {{trans('common.form.buttons.continue')}}
                                            </div>
                                        </div>
                                       
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="preloader" style="display: none;" data-name="CYGiLwuL">
    <div data-loader="circle-side" style="display: block;" data-name="xGdVCdFa"></div>
</div>
<script>

    editor = CKEDITOR.replace( 'content_html', {
        fullPage: true,
        allowedContent: true,
        height: 320
    });
    // enter work as <br> instead <p>
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKFinder.setupCKEditor( editor );
    //CKEDITOR.config.extraPlugins = 'preview,font,smiley';
    CKEDITOR.config.extraPlugins = 'preview,font,colorbutton,justify,bidi,language,emojione';
    CKEDITOR.config.language_list = ['en:English','ar:Arabic:rtl', 'fr:French', 'he:Hebrew:rtl', 'es:Spanish'];
    CKEDITOR.config.defaultLanguage = 'en';

</script>
@endsection