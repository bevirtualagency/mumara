@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/custom-fields-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="/themes/default/css/code/codemirror.css">
<link rel="stylesheet" type="text/css" href="/themes/default/css/code/neat.css">
<link rel="stylesheet" type="text/css" href="/themes/default/css/code/ambiance.css">
<link rel="stylesheet" type="text/css" href="/themes/default/css/code/material.css">
<link rel="stylesheet" type="text/css" href="/themes/default/css/code/neo.css">
<style>
.picture_review{
    margin: 20px 0;
}
#template_default_image {
    border: 3px solid #e5e5e5;
    border-radius: 15px;
    overflow: hidden;
    position: relative;
    height: 156px;
    width: 100%;
}
#template_default_image_div {
    height: 156px;
    width: 100%;
}
div[data-name="WVtqGXZV"] {
    position: relative;
    display: block;
}
.CodeMirror {
    display: inline-grid;
    width: 100%;
}
.CodeMirror-sizer {
    margin-left: 35px !important;
    margin-bottom: -17px !important;
    border-right-width: 13px !important;
    min-height: 12586px !important;
    min-width: 1352.92px !important;
    padding-right: 17px !important;
    padding-bottom: 17px !important;
}
.CodeMirror, .CodeMirror * {font-size: 15px;}
.CodeMirror-scroll {
    display: inline-grid;
    overflow-y: overlay;
    height:300px;
}
.CodeMirror-scroll::-webkit-scrollbar {
  width: 7px;
  height: 7px;
}
.CodeMirror-scroll::-webkit-scrollbar-track {
  box-shadow: inset 0 0 5px #cccccc; 
  border-radius:0px;
  background: #eaeaea;
}
.CodeMirror-scroll::-webkit-scrollbar-thumb {
  background: #bcbcbc; 
  border-radius: 0px;
}
.CodeMirror-scroll::-webkit-scrollbar-thumb:hover {
  background: #999; 
}
#style {
    margin-top: 10px;
}
#frmdesign {
    margin-top: 55px;
}
#preview-block {
    display: block;
    margin-top: 40px;
}
#preview {
    padding: 6px;
    background: #263238;
}
#preview-block .label-style.css {
    top: -32px;
}
label.label-style {
    position: absolute;
    top: -18px;
    padding: 6px 25px 10px;
    background: #263238;
    color: #FFF;
    border-top-left-radius: 5px;
    border-top-right-radius: 5px;
    font-size: 14px;
    width: 105px;
    text-align: center !important;
}
.CodeMirror-gutter-wrapper .CodeMirror-linenumber {
    background: #263238;
    padding-right: 10px;
}
#style .label-style.css {
    top: -9px !important;
}
a#user_default {
    font-weight: 500;
    margin-bottom: -10px;
    display: block;
}
.editor-block {
    padding: 10px;
    background: #ecf3ff;
    border: 1px solid #dfebff;
    margin-top: 50px;
    border-radius: 5px;
}
.buttons-block {
    position: absolute;
    top: -22px;
    right: -1px;
}
@media (min-width: 1024px) {
    #preview_html .modal-lg, .modal-xl {
        max-width: 1370px!important;
    }
}
button#get_preview {
    min-width: 10px;
    position: absolute;
    right: 15px;
    background: #FFF;
    top: 5px;
    border-radius: 9px;
    padding: 5px 7px;
    min-width: 30px !important;
}
button#get_preview i {
    font-size: 18px;
} 
#preview_html button.close {
    margin-top: 3px;
    margin-right: -3px;
    padding: 4px;
    border: 1px solid #ddd;
} 
#preview_html .modal-body {
    padding: 0;
}
#preview_html .modal-body #web_design_preview {
    margin-bottom: 0;
}
#preview_html {
    padding-right: 0 !important;
    max-width: 100%;
    margin: 0 auto;
}
#preview_html .modal-dialog {
    width: 100%;
}
#preview_html .modal-dialog iframe {
    min-height: 360px;
    max-height: 80vh;
    width: 100%;
}
/* width */
#preview_html .modal-dialog iframe::-webkit-scrollbar {
  width: 7px;
}

/* Track */
#preview_html .modal-dialog iframe::-webkit-scrollbar-track {
  background: #f1f1f1; 
}
 
/* Handle */
#preview_html .modal-dialog iframe::-webkit-scrollbar-thumb {
  background: #888; 
}

/* Handle on hover */
#preview_html .modal-dialog iframe::-webkit-scrollbar-thumb:hover {
  background: #555; 
}
input#file {
    padding: 8px;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.mousewheel.min.js"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/common.js" type="text/javascript"></script>
<script type="text/javascript" src="/themes/default/js/code/codemirror.js"></script>
<script type="text/javascript" src="/themes/default/js/code/javascript.js"></script>
<script type="text/javascript" src="/themes/default/js/code/htmlmixed.js"></script>
<script type="text/javascript" src="/themes/default/js/code/css.js"></script>
<script>
var ComponentsCodeEditors = function () {
    var css = function () {
            $(".CodeMirror").remove();
            var e = document.getElementById("styles");
            var editorStyle = CodeMirror.fromTextArea(e, {
                lineNumbers: !0,
                matchBrackets: !0,
                styleActiveLine: !0,
                theme: "material",
                mode: "css"
            });
            editorStyle.on('change', function(){
                editorStyle.save();
            });
        },
        html = function () {
            var e = document.getElementById("design");
            var editorDesugn = CodeMirror.fromTextArea(e, {
                lineNumbers: !0,
                matchBrackets: !0,
                styleActiveLine: !0,
                theme: "material",
                mode: "css"
            });
            editorDesugn.on('change', function(){
                editorDesugn.save();
            });
        };
    return {
        init: function () {
            css(), html()
        }
    }
}();

function setMirrorRecord(styles,design){
    //var e = document.getElementById("styles");
    //var e = document.getElementById("design");    
    $(".CodeMirror").remove();        
    var editorStyle = CodeMirror.fromTextArea(styles, {
        lineNumbers: !0,
        matchBrackets: !0,
        styleActiveLine: !0,
        theme: "material",
        mode: "css"
    });    
    editorStyle.on('change', function(){
        editorStyle.save();
        $("#styles_value").val($("#styles").val());
    });


    var editorDesugn = CodeMirror.fromTextArea(design, {
        lineNumbers: !0,
        matchBrackets: !0,
        styleActiveLine: !0,
        theme: "material",
        mode: "css"
    });    
    editorDesugn.on('change', function(){
        editorDesugn.save();
       ///console.log($("#design").val());
       $("#design_value").val($("#design").val());
    });
}
jQuery(document).ready(function () {
    ComponentsCodeEditors.init();    
    window.setTimeout(function () {
       var styles = document.getElementById("styles");
       var design = document.getElementById("design");
       setMirrorRecord(styles,design);     
        
       window.setTimeout(function () {
            $("#styles").trigger('click');
            $("#design").trigger('click');
        }, 1000);
        
    }, 1000);
    
    
});    
    function getDefaultDesigs(){
        $.ajax({
            type: "POST",
            url: "{{ route('get.default.design') }}",
            data: {'id': $("#id").val()},
            cache: false,
            dataType:'json',
            success: function (result) {
                //$("#styles").val(result.data.styles);
                //$("#design").val(result.data.design);
                $("#styles").val(result.data.styles);
                $("#design").val(result.data.design);
                $("#styles_value").val(result.data.styles);
                $("#design_value").val(result.data.design);
                //setMirrorRecord(result.data.styles,result.data.design); 
                var styles = document.getElementById("styles");
                var design = document.getElementById("design");
                setMirrorRecord(styles,design);      
                $("#template_default_image").html("<button type='button' class='get_preview btn btn-secondary' id='get_preview'  data-toggle='modal'><i class='la la-eye'></i></button><img src='<?php echo url('/')?>/themes/default/webforms/no-image.jpg'  />");
                $("#template_default_image_div").show();   
                $("#category_id").val(result.row.category_id);
            }

        });
    }

$(document).ready(function(){
    <?php
    if($id > 0){
        if($objDesign->preview_picture!=""){
            $image = config('mumara.web_form_designs').$objDesign->preview_picture;
        }else{
            $image = "/themes/default/webforms/".$objDesign->category_id."/thumbnail.jpg";
        }
        ?>
            $("#template_default_image").html("<button type='button' class='get_preview btn btn-secondary' id='get_preview'  data-toggle='modal'><i class='la la-eye'></i></button><img src='<?php echo $image?>'  />");
            $("#template_default_image_div").show();  
    <?php
    }
    ?>
    $("#category_id").change(function(){
        var catid = $("#category_id").val();
        if(catid > 0){
            $("#template_default_image").html("<button type='button' class='get_preview btn btn-secondary' id='get_preview'  data-toggle='modal'><i class='la la-eye'></i></button><img src='<?php echo url('/')?>/themes/default/webforms/no-image.jpg'  />");
            $("#template_default_image_div").show();  
        }else{
            $("#template_default_image_div").hide();
        }
        $(".blockUI").show();
        $.ajax({
            type: "POST",
            url: "{{ route('get.template.design') }}",
            data: {'category_id': $("#category_id").val()},
            cache: false,
            dataType:'json',
            success: function (result) {
                $("#styles").val(result.data.styles);
                $("#design").val(result.data.design);
                $("#styles_value").val(result.data.styles);
                $("#design_value").val(result.data.design);
                var styles = document.getElementById("styles");
                var design = document.getElementById("design");
                setMirrorRecord(styles,design);
                $(".blockUI").hide();
            }

        });
    });
    

   /// $("#category_id").trigger('change');
    $(document).on('click','#get_preview',function(){
        var style = $("#styles").val();
        var design = $("#design").val();
        $.ajax({
            type: "POST",
            url: "{{ route('load.temp.design') }}",
            data: {'style': style,'design':design},
            cache: false,            
            success: function (result) {
                //$("#styles").val(result.data.styles);
                //$("#design").val(result.data.design);
                $("#web_design_preview").html(result);
                $("#preview_html").modal("show");
            }

        });
    });
    //$("#styles").trigger('click');
    
    ///Command: toastr['error']("error");
$("#frm-web-from-designs").validate({
            rules: {
                'name': {
                    required: true,
                },
                // 'category_id': {
                //     required: true,
                // },
            },
            messages : {
                name: {
                  required: "{{trans('web_forms.create_web_form_design.form_message.name')}}"
                },
                category_id: {
                  required: "{{trans('web_forms.create_web_form_design.form_message.category_id')}}"
                }
                
            },
            invalidHandler: function(event, validator) {


            },
            submitHandler: function (form) {
                 //console.log($("#design").val());
                $.ajax({
                    type: "POST",
                    url: "{{ route('save.web.form.design') }}",
                    data: new FormData($("#frm-web-from-designs")[0]),
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false, // To send DOMDocument or non processed data file it is set to false
                    dataType:'json',
                    beforeSend: function() {
                        $('#save_add').prop('disabled',true);
                        $('.blockUI').show();
                    },
                    success: function (result) {
                        $('.blockUI').hide();                    
                        var cssClass = result.status=='success' ? 'success':"error";
                        Command: toastr[cssClass](result.message);
                        if(result.status=='success'){
                            var newID = result.id;
                            if($("#redirection").val()=='list'){
                                var redirectUrl = "{{ route('view.web.form.design') }}";
                            }else{
                                
                                var redirectUrl = "{{ url('create-web-form-design') }}/"+newID;
                                
                            }
                            window.setTimeout(function () {
                                window.location.href = redirectUrl
                            }, 3000);
                        }
                        $('#save_add').prop('disabled',false);
                    }

                });
                
            }
        });

});
$(document).ready(function(){
    $("#styles").trigger('click');
    $("#design").trigger('click');
});
</script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="bJbCtNdC">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="MFEASMeX">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="wUlmFIlg">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="col-md-6 create-form" data-name="EoUCWIdE">
    <!-- BEGIN FORM-->
    <form action="" method="POST" id="frm-web-from-designs" enctype="multipart/form-data" name="frm-web-from-designs" class="kt-form kt-form--label-right" >
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="id" name="id" value="{{ $id }}">
        <input type="hidden" id="design_value" name="design_value" value="{{ isset($objDesign->design) ? $objDesign->design:'' }}">
        <input type="hidden" id="styles_value" name="styles_value" value="{{ isset($objDesign->styles) ? $objDesign->styles:'' }}">
        <input type="hidden" id="category_id" name="category_id" value="{{ isset($objDesign->category_id) ? $objDesign->category_id:'' }}">
        <input type="hidden" id="redirection" name="redirection" value="list">
        <div class="row" data-name="YkrXSidZ">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="hgjVRQYJ">
                <div class="kt-portlet__body" data-name="KeStsiMD">
                    <div class="form-body" data-name="NsOreXMD">
                        <div class="form-group row" data-name="QBDtKkOb">
                            <!-- <div class="col-md-12" data-name="UJhsnPHjdsd">
                                <label class="col-form-label">{{trans('web_forms.create_web_form_design.label.form_type')}}
                                    <span class="required"> * </span>
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('web_forms.create_web_form_design.label.form_type_help')}}" data-original-title="{{trans('web_forms.create_web_form_design.label.form_type')}}"></i>
                                </label>
                                <div class="input-icon right" data-name="CunTCPpssidsad">
                                    
                                    <select name="category_id"  id="category_id" class="form-control m-select2" required="">
                                        <option value="">{{trans('web_forms.create_web_form_design.select.form_type')}}</option>
                                        @foreach($webFormCategoriesData as $webFormCategoriesRow)
                                            <option value="{{ $webFormCategoriesRow['id'] }}" {{ isset($objDesign->category_id) && $objDesign->category_id==$webFormCategoriesRow['id'] ? 'selected' :'' }}  >{{ $webFormCategoriesRow['category'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> -->
                            
                            <div class="col-md-12" data-name="UJhsnPHj">
                                <label class="col-form-label">{{trans('web_forms.create_web_form_design.label.name')}}
                                    <span class="required"> * </span>
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('web_forms.create_web_form_design.label.name_help')}}" data-original-title="{{trans('web_forms.create_web_form_design.label.name')}}"></i>
                                </label>
                                <div class="input-icon right" data-name="CunTCPpi">
                                    <input type="text" name="name" id="name" class="form-control" value="{{ isset($objDesign->design_name) ? $objDesign->design_name:'' }}"  /> 
                                </div>
                            </div>
                            <div style="display: @if($id > 0 && $id < 9)none; @else block @endif " class="col-md-12 mb1" data-name="UJhsnPHj" id="preview-picture"  >
                                <label class="col-form-label">{{trans('web_forms.create_web_form_design.label.preview_picture')}}                                    
                                    <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('web_forms.create_web_form_design.label.preview_picture_help')}}" data-original-title="{{trans('web_forms.create_web_form_design.label.preview_picture')}}"></i>
                                </label>
                                <div class="input-icon right" data-name="CunTCPpiShab">
                                    <input type="file" class="form-control" name="file" id="file" />
                                    <span class="text-help">{{trans('web_forms.create_web_form_designs_blade.supported_extensions_span')}}</span>
                                </div>
                            </div>
                            
                            @if($id > 0 && $id < 9)                           
                                <div class="col-md-12 picture_review" data-name="UJhsnPHj" style="display: none;" id="template_default_image_div">
                                    <div class="input-icon right" data-name="CunTCPpizAzeen" id="template_default_image">
                                        
                                    </div>
                                </div>
                            @else
                           
                                @if(isset($objDesign->preview_picture) && $objDesign->preview_picture!="")
                                
                                
                                <div class="col-md-12 picture_review" data-name="UJhsnPHj">
                                    <div class="input-icon right" data-name="CunTCPpi">
                                        <button type='button' class='get_preview btn btn-secondary' id='get_preview'  data-toggle='modal'><i class='la la-eye'></i></button><img src="{{ config('mumara.web_form_designs').$objDesign->preview_picture }}" style="height:  auto; width: 100%" />
                                    </div>
                                </div>
                                @elseif(isset($objDesign->category_id))
                                    <div class="col-md-12 picture_review" data-name="UJhsnPHj"  id="template_default_image_div">
                                        <div class="input-icon right" data-name="CunTCPpi" id="template_default_image">
                                            <img src="/themes/default/webforms/{{$objDesign->category_id}}/thumbnail.jpg" style="height:  auto; width: 100%" />
                                        </div>
                                    </div>
                                @else                                    
                                    <div class="col-md-12 picture_review" data-name="UJhsnPHj"  id="template_default_image_div">
                                        <div class="input-icon right" data-name="CunTCPpi" id="template_default_image">
                                            <img src="/themes/default/webforms/no-image.jpg" style="height:  auto; width: 100%" />
                                        </div>
                                    </div>
                                
                                @endif
                            @endif
                            	
                            <div class="col-md-12 editor-block" data-name="JJO90jhd">                                
                                <div class="row " data-name="HOp90KJj">
                                    <div class="col-md-12" data-name="UJhsnPHjdssad" id="style">
                                        
                                        <div class="input-icon right" data-name="CunTCPpidsda">
                                            <label class="label-style css">CSS</label>
                                                <textarea name="styles" id="styles" class="form-control">{{ isset($objDesign->styles) ? $objDesign->styles:'' }}</textarea>
                                        </div>
                                    </div>	
                                    
                                    <div class="col-md-12" data-name="UJhsnPHj" id="frmdesign">                                        
                                        <div class="input-icon right" data-name="CunTCPpi">
                                            <label class="label-style html">{{trans('web_forms.create_web_form_designs_blade.html_txt_label')}}</label>
                                                <textarea name="design" id="design" class="form-control">{{ isset($objDesign->design) ? $objDesign->design:'' }}</textarea>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="WDctplmR">
                    <div class="row" data-name="FpWdVFbD">
                        <div class="col-md-12" data-name="WVtqGXZV">
                            <button type="submit" name="save_add" id="save_add" class="btn btn-success" onclick="$('#redirection').val('add');" value="save_add">{{trans('web_forms.create_web_form_design.keep_editing')}}</button>
                            <button type="submit" name="save_add" id="save_exist" class="btn btn-success" onclick="$('#redirection').val('list');" value="save_exit">{{trans('common.form.buttons.save')}}</button>
                            <a href="{{ route('view.web.form.design') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
</div>



<div class="modal fade" id="preview_html" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('web_forms.create_web_form_designs_blade.web_template_preview_heading')}} </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group" id="web_design_preview">
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection