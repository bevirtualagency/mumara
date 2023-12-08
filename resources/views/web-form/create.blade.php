@extends(decide_template())


@section('title',  $page_data['title'] )

@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/webform-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css" />
    
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/webforms.js?rand={{rand(0,1000)}}" type="text/javascript"></script>
<script src="/themes/default/js/includes/web_form.js?rand={{rand(0,1000)}}" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    function gotoTop(){
        $('html, body').animate({scrollTop:0}, 'slow');
    }
   
    
    
    $(document).ready(function(){
        $("#duplicateDB").change(function(){
            var content = "";
            if($("#duplicateDB").val()=='skip'){
                CKEDITOR.instances['error_content'].setData($("#error_page_text_hidden").val());	
            }
            else{
                CKEDITOR.instances['error_content'].setData($("#update_page_content_text_hidden").val());	
            }
        });
        <?php
       
        if(isset($webform->id) && $webform->id > 0){
            $design_id = $webform->design_id;
        ?>
                window.localStorage.setItem('template_id', "{{ $webform->design_id }}");                
        <?php
        }        
        ?>
        $("#change-template").click(function() {
            $(this).hide();
            $("#cancel-template").show();
            $("#template_div").slideDown();
           // $("#design_id").attr("disabled", false); 
        });
        $("#cancel-template").click(function() {
            $(this).hide();
            $("#change-template").show();
            $("#template_div").slideUp();
            //$("#design_id").attr("disabled", true); 
        });
        
        
        
        var tid = "<?php echo $design_id?>"; 
        
        <?php
        if($design_id!="" && $design_id>0){
        ?>
         $("#design_id").val(tid);
            if(tid == 0 || tid == "0" || tid == "") {
                $("#imageBox").hide();
                $(".template-side").hide();
               // $("#form_name").show();
            }
            else if (tid != "" && tid != 0 && tid > 0) {            
                $("#imageBox").show();

                var image = '/themes/default/webforms/'+ tid +'/thumbnail.jpg';
                <?php 
                   if(empty($designRow['preview_picture'])){
                       $image = $designRow['category_id'];
                       ?>
                           var image = "/themes/default/webforms/<?php echo $image?>/thumbnail.jpg";
                           <?php
                   }else{
                       config("mumara.web_form_designs") . $designRow['preview_picture'];
                       ?>
                         var image = "<?php echo config("mumara.web_form_designs") . $designRow['preview_picture']?>";  
                           <?php
                   }
                   ?>
                       <?php
                   ?>

                $("#imageBox").attr("src", image);
                $("#imageLabel").html("<?php echo $designRow['design_name']?>");
                $(".template-side").show();
               // $("#form_name").hide();
            } 
            else {
                $("#imageBox").show();
                $("#imageBox").attr("src", "/themes/default/webforms/1/thumbnail.jpg");
                $("#imageLabel").html("Template 1");
                $(".template-side").show();
                //$("#form_name").hide();
            }       
        <?php
        }else{
            ?>
              $("#imageBox").hide();
                $(".template-side").hide();      
  <?php
        }
        ?>
        
        // $("#addvars").modal("show");
        $(".m-select2").select2({
            placeholder: 'Select Option'
        });
        $("#have_design_id").change(function(){
            if($("#have_design_id").is(":checked")){
                $("#template_div").slideUp();
                //$("#design_id").attr("disabled", true);                      
            }else{
                $("#template_div").slideDown();
               // $("#design_id").attr("disabled", false);                                
            }
        });
        $("#admin_notify").change(function() {
            if($(this).is(":checked")) {
                $("#admin_notify_blk").slideDown();
                $('.admin_content_div').slideDown();
                $("#setup_email").removeAttr("disabled");
              //  $("#admin_content").removeAttr("disabled");
               //$("#format").removeAttr("disabled");
            } else {
                $("#admin_notify_blk").slideUp();
                $('.admin_content_div').slideUp();
                $("#setup_email").attr("disabled", "disabled");
                //$("#admin_content").attr("disabled", "disabled");
               // $("#format").attr("disabled", "disabled");
            }
        });
    }); 
 
    function selectTag(field, ckeditor_id) {
        if(field == 'Unsubscribe Link'){
            field = '<a href="%%unsubscribelink%%">{{trans('common.label.unsubscribe')}}</a>'; 
        }
        else if(field == 'Confirm Link') {
            field = '<a href="%%confirmurl%%">{{trans('common.label.confirm')}}</a>'; 
        }
        else{
            field = '%%'+field+'%%';
        }
        Command: toastr["success"] ("{{trans('web_forms.web_forms_create_blade.variable_placed_successfully_command')}}"); 
        //tinyMCE.editors[1].execCommand('mceInsertContent', false, field);
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
            }, 150);
        }
        
    }
    function selectSpintag(spintag, ckeditor_id) {
        spintag = '{'+'{'+spintag+'}'+'}';
        CKEDITOR.instances[ckeditor_id].insertText(spintag);
    }
    function selectDynamicContent(dynamic_content, ckeditor_id) {
        dynamic_content = dynamic_content;
        CKEDITOR.instances[ckeditor_id].insertText(dynamic_content);
        
    }
    function t_selectTag(field) {
        if(field == 'Unsubscribe Link')
            field = '<a href="%%unsubscribelink%%">{{trans('common.label.unsubscribe')}}</a>'; 
        else if(field == 'Confirm Link')
            field = '<a href="%%confirmurl%%">{{trans('common.label.confirm')}}</a>'; 
        else
            field = '%%'+field+'%%';
        //tinyMCE.editors[3].execCommand('mceInsertContent', false, field);
        CKEDITOR.instances['thankyou_content'].insertHtml(field);
    }
    
    function replaceVariableWebForm(ckeditor_id,selectID){
        var field = $("#"+selectID).val();
        if(field!=""){
            if(selectID=='spin_tags_variables_webform'){
                t_selectSpintag(field, ckeditor_id)
            }
            else if(selectID=='dynamic_content_variables_webform'){
                field = "[["+field+"]]";
                selectDynamicContent(field, ckeditor_id)
            }else{
                t_selectTag(field, ckeditor_id); 
            }  
            setTimeout(function() {
                 $("#"+selectID).val(null).trigger('change.select2');
            }, 150);
        }
        
    }
    function t_selectSpintag(spintag) {
        spintag = '{'+'{'+spintag+'}'+'}';
        CKEDITOR.instances['thankyou_content'].insertText(spintag);
    }
    $('#copy-email').click(function() {
        var content_html = CKEDITOR.instances['content_html'].getSnapshot();
        var content = content_html.replace(/<br\s*\/?>/mg,"\n");
        // remove all the other html tags for text content
        var regex = /(<([^>]+)>)/ig
        var content = $.trim(content.replace(regex, ""));
        $('#content_text').html(content);
    });
    $('#copy-thanksemail').click(function() {
        var content_html = CKEDITOR.instances['thankyou_content'].getSnapshot();
        var content = content_html.replace(/<br\s*\/?>/mg,"\n");
        // remove all the other html tags for text content
        var regex = /(<([^>]+)>)/ig
        var content = $.trim(content.replace(regex, ""));
        $('#thanks_content_text').html(content);
    });
</script>
<script>
    $('#copyAsText').click(function() {
        var content_html = CKEDITOR.instances['content_html'].getData(); // For CK editor editor
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
    
    $('#c_show_page').on('change', function (e, state) {
        if($(this).is(":checked")) {
            $(".confirmation_custom_vars").show();
            $("#div_json_response_text_content").hide();
        }
    });
    $('#c_goto_web').on('change', function (e, state) {
        if($(this).is(":checked")) {
            $(".confirmation_custom_vars").hide();
            $("#div_json_response_text_content").hide();
        }
    });
    $('#c_json').on('change', function (e, state) {
        if($(this).is(":checked")) {
            $("#div_json_response_text_content").show();
            $(".confirmation_custom_vars").hide();      
            $(".c_goto_web").hide();
            $(".c_show_page").hide();
        }
    });
    $('#double_optin').on('change', function (e, state) {
        if($(this).is(":checked")) {
            $("#c_show_page,#c_goto_web,#c_site_address,#c_name,#c_email_part1,#c_email_part2,#c_replyemail,#c_subject,#content_text").removeAttr('disabled');
            $("#confirmationEmailContent").show();
            $("#confirmationEmailContentDisable").hide();
            $("#overwrite").attr('disabled',true);
            $("#overwrite").hide();
            $("#duplicateDB").val("skip");
            CKEDITOR.instances['error_content'].setData($("#error_page_text_hidden").val());
        } else {             
            $("#c_show_page,#c_goto_web,#c_site_address,#c_name,#c_email_part1,#c_email_part2,#c_replyemail,#c_subject,#content_text").attr('disabled', "disabled");
            $("#confirmationEmailContent").hide();
            $("#confirmationEmailContentDisable").show();
            $("#overwrite").attr('disabled',false);
            $("#overwrite").show();
            
        }
       
    });
    $('#thanks_email').on('change', function (e, state) {
        if($('#thanks_email').is(":checked")){
            $("#t_name,#t_email_part1,#t_email_part2,#t_replyemail,#t_subject,#thanks_content_text").removeAttr('disabled');
            // CKEDITOR.instances['thankyou_content'].setReadOnly(true);
            $("#thankYouEmailContent").show();
        }else{
            $("#t_name,#t_email_part1,#t_email_part2,#t_replyemail,#t_subject,#thanks_content_text").attr('disabled', "disabled");
            // CKEDITOR.instances['thankyou_content'].setReadOnly(false);
            $("#thankYouEmailContent").hide();
        }    
    });
    if($("#double_optin_btn").val() == 'no') {
        $("#c_show_page,#c_goto_web,#c_site_address,#c_name,#c_email_part1,#c_email_part2,#c_replyemail,#c_subject,#content_text").attr('disabled', !this.checked);
        $("#confirmationEmailContent").hide();
        $("#confirmationEmailContentDisable").show();
    }
    if($("#thanks_email_btn").val() == 'no') {
        $("#t_name,#t_email_part1,#t_email_part2,#t_replyemail,#t_subject,#thanks_content_text").attr('disabled', !this.checked);
        // CKEDITOR.instances['thankyou_content'].setReadOnly(true);
        $("#thankYouEmailContent").hide();
    }
    function getCustomFields(id)
    {
        $(".blockUI").show();
        var token = $('#token').val();
        $.ajax({
            url: "{{ url('/') }}"+'/form/custom/fields/'+id,
            type: "POST",
            data: {'_token':token},
            success: function (data) {
                $(".blockUI").hide();
                $('.custom-fields-data').hide();
                $('#custom-fields-data-'+id).toggle().html(data);
            }
        });
        
         $.ajax({
            url: "{{ url('/') }}"+'/get-list-customfields',
            type: "POST",
            data: {'_token':token,'list_id':id},
            success: function (data) {
                $(".blockUI").hide();
                $('#customfieldDD').html(data);
            }
        });
            /*to clear box on other selection*/
            $('#sortable').html("");
            $('#sortable').append('<span style="margin-right:0px" class="kt-list-timeline__badge disable-sort-item"></span><input type="hidden" name="" value=""><span class="kt-list-timeline__text">{{ trans("common.label.email")}}</span>');
    }
    $("body").on("click" , ".submitAction" , function() { 
       /* for (instance in CKEDITOR.instances) {
            console.log(instance);
            CKEDITOR.instances[instance].updateElement();
        }*/
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });
    function up()
    {
        for (instance in CKEDITOR.instances)
            CKEDITOR.instances[instance].updateElement();
    }
</script>
<script type="text/javascript">
    if($('#action').val() == 'edit') {
        var radioValue = $("input[name='subscriber_lists[]']:checked").val();
                if(radioValue){
                    getCustomFields(radioValue);
                }
    }
    $(document).ready(function(){
        
        $("#design_id").change(function() {
            var val = $(this).val();
            if (val !== "" && val !== 0) {
                $("#imageBox").show('');

                $.ajax({
                    type: "POST",
                    url: "{{ route('form.get.design.row') }}",
                    type: "POST",
                    data: {'id':val},
                    dataType:'json',
                    success: function(data){
                      if(data.status=='success'){
                          $("#imageBox").attr("src", data.design_url);
                         $("#imageLabel").html(data.design_name);
                         $(".template-side").show();
                      }
                      
                    }
                });
            } 
            else {
                $("#imageBox").hide();
                $(".template-side").hide();
               // $("#form_name").show()
            }
        });
    });
</script>
<script src="/themes/default/js/includes/sortable.js" type="text/javascript"></script>
<script>
  $( function() {
    $( "#sortable" ).sortable({
     cancel: ".disable-sort-item"
});
    $( "#sortable" ).disableSelection();
    @if ($page_data['action'] == 'add')
     $('#sortable').append('<span style="margin-right:0px" class="kt-list-timeline__badge disable-sort-item"></span><input type="hidden" name="" value=""><span class="kt-list-timeline__text">{{ trans("common.label.email")}}</span>');
    @endif
  } );
</script>
<script type="text/javascript">
    function setupFields (event, id , name , edit)
    {
        if(edit){
            $('#sortable').append('<li id="field-'+id+'" class="all-scroll kt-list-timeline__item"><span class="kt-list-timeline__badge"></span><input type="hidden" name="custom_fields[]" value="'+id+'"><span class="kt-list-timeline__text">'+name+'</span></li>');
        }else if($(event.target).is(":checked")){
            $('#sortable').append('<li id="field-'+id+'" class="all-scroll kt-list-timeline__item"><span class="kt-list-timeline__badge"></span><input type="hidden" name="custom_fields[]" value="'+id+'"><span class="kt-list-timeline__text">'+name+'</span></li>');
        }else {
            $('#field-'+id+'').remove();
        }
    }
    $("#customfields-data li").each(function(){
          setupFields(1, this.id , $(this).text() , 1);                    
    });
    
    
</script>

<script type="text/javascript">
$(document).ready(function(){
    @if ($page_data['action'] != 'add')
        if($('#c_goto_web').is(":checked")) {
           $(".confirmation_custom_vars").hide();
           $("#div_json_response_text_content").hide();
        }
        if($('#c_goto_web').is(":checked")) {
            $(".confirmation_custom_vars").show();
            $("#div_json_response_text_content").hide();
        }
        if($('#c_json').is(":checked")) {
            $("#div_json_response_text_content").show();
            $(".confirmation_custom_vars").hide();      
            $(".c_goto_web").hide();
            $(".c_show_page").hide();
        }     
    @else
            $(".confirmation_custom_vars").show();
            $("#div_json_response_text_content").hide();
    @endif
});
</script>

@endsection

@section(decide_content())

<script src="/js/libs/ckeditor/ckeditor.js"></script>
<script src="/js/libs/ckeditor/plugins/font/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/colorbutton/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/zsuploader/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/smiley/plugin.js"></script>
<script src="/js/libs/ckfinder/ckfinder.js"></script>

@if (Session::has('msg'))
<div class="alert alert-success" data-name="fJijSCTf">
    {{ Session::get('msg') }}
</div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="cTOIeEQy">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<?php
$authId = \Illuminate\Support\Facades\Auth::id();
?>
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="xrBGvMMY">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="wTLcFyyV">
    <div class="col-md-6 create-form" data-name="NZtqzGUB">

        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="oDIXrxBE">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="BoGYKGbw">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="fPCEYZFP">
                    <div class="kt-wizard-v4__nav-items" data-name="vYXReLIg">
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="IVYiNnJJ">
                                <div class="kt-wizard-v4__nav-number" data-name="xvezCWzU">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="JwoPgjCB">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="mPjUZVzO">
                                        {{trans('web_forms.add_new.step1.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="VKNcLwpw">
                                        {{trans('web_forms.add_new.step1.desc')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item confirmation_wizard" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="lCaTjYpe">
                                <div class="kt-wizard-v4__nav-number" data-name="WnsXgJEC">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="jcFihJYX">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="lZfYGthl">
                                        {{trans('web_forms.add_new.step2.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="dawNvhUG">
                                        {{trans('web_forms.add_new.step2.desc')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="tsEOqRyV">
                                <div class="kt-wizard-v4__nav-number" data-name="EgjaGYix">
                                    3
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="vSVmtqWI">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="IkVTVQrD">
                                         {{trans('web_forms.add_new.step3.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="glAPgxfi">
                                       {{trans('web_forms.add_new.step3.desc')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="DySsPHAX">
                                <div class="kt-wizard-v4__nav-number" data-name="kNoIndkH">
                                    4
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="wfTrbwbb">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="CNUcJOWz">
                                         {{trans('web_forms.add_new.step4.heading')}}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="zCtHNYgP">
                                       {{trans('web_forms.add_new.step4.desc')}}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="kt-portlet form" data-name="UohLMiGI">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="vEhEWSrW">
                        <div class="kt-grid" data-name="ueapwRMf">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="QGgkpkof">
        
                                @if ($page_data['action'] == 'add')
                                <form action="{{ route('form.store') }}" method="POST" id="submit_form" class="kt-form kt-form--label-right">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="action" value="add">
                                    <input type="hidden" id="view_design" value="0">
                                @else 
                                <form action="{{ route('form.update',  $webform->id) }}" method="POST" id="submit_form" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="edit">
                                    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="webform-id" value="{{$webform->id}}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <input type="hidden" id="double_optin_btn" value="{{$setup->double_optin}}">
                                    <input type="hidden" id="thanks_email_btn" value="{{$setup->thanks_email}}">
                                    <input type="hidden" id="view_design" value="0">
                                @endif
                                <input type="hidden" id="error_page_text_hidden" value="<?php echo trans("web_forms.add_new.form.error_page_text")?>">
                                <input type="hidden" id="update_page_content_text_hidden" value="<?php echo trans("web_forms.add_new.form.update_page_content_text")?>">
                                    <div class="form-wizard" id="" data-name="oavLzWCZ">
                                        <div class="form-body" data-name="pHwMONFH">

                                            <div class="tab-content" data-name="zdFnzNOq">
                                                
                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="OhcHVHos">
                                                    <div class="kt-form__section kt-form__section--first" data-name="PecaHLGi">
                                                        <div class="kt-wizard-v4__form" data-name="grbcHyla">

                                                            <div class="form-group row" id="template_div" data-name="RfHrfrRcsa" style="display:none">
                                                                    
                                                                <div class="col-md-12" data-name="fvsGliaE">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.form_design')}}
                                                                        <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.help.form_design','common.description') !!}
                                                                    </label>
                                                                    <select class="form-control select2" name="design_id" id="design_id">
                                                                        
                                                                        <option value="">{{ trans('web_forms.add_new.form.select_webform_design') }}</option>
                                                                        @foreach($webFormDesignsData as $webFormDesignsRow)
                                                                            <option {{ isset($webform->design_id) && $webform->design_id==$webFormDesignsRow['id'] ? 'selected' : '' }} value="{{ $webFormDesignsRow['id'] }}">{{ $webFormDesignsRow['design_name'] }}</option>
                                                                        @endforeach
                                                                            
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        
                                                            <div class="form-group row template-side" data-name="dtwAIVor">
                                                                <div class="col-md-12" data-name="bRgsnifN">
                                                                    <label class="col-form-label">{{trans('web_forms.web_forms_create_blade.label_selected_template')}}  <span id="imageLabel"></span></label>
                                                                    <img id="imageBox" drc="" style="max-width:100%" />
                                                                    <a href="javascript:;" class="pull-right" id="change-template">Change Template</a>
                                                                    <a href="javascript:;" class="pull-right" id="cancel-template"><i class='fa fa-times text-success'></i> {{trans('web_forms.web_forms_create_blade.cancel_change_temp_action')}} </a>
                                                                </div>      
                                                            </div>
                                                            
                                                            <div class="form-group row" id="form_name" data-name="RfHrfrRc">
                                                                    
                                                                <div class="col-md-12" data-name="fvsGliaE">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.form_name')}}
                                                                        <span class="required"> * </span>
                                                                         {!! popover('web_forms.add_new.form.form_name_help','common.description') !!}
                                                                    </label>
                                                                    <input type="text" class="form-control" name="form_name" value="{{ isset($webform->name) ? $webform->name : '' }}" required />
                                                                </div>
                                                            </div>
                                                            
                                                            
                                                            <?php $force_double_opt_in_webform = getSetting('force_double_opt_in_webform');?>
                                                           
                                                          
                                                            <div class="form-group row dbl-optins"  @if($force_double_opt_in_webform == "on") style="display:none;"   @endif data-name="lcjVJFBS">
                                                                <div class="col-md-12" data-name="cNyMfZKm">
                                                                    <label class="col-form-label col-md-3 pl12">{{trans('web_forms.add_new.form.double_option')}}
                                                                        {!! popover('web_forms.add_new.form.double_option_help','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-6" data-name="VDWTSDDi">
                                                                    @if(isset($setup->double_optin) && $setup->double_optin == 'yes')
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input checked="checked"  type="checkbox" id="double_optin" name="double_optin">
                                                                                <span></span>
                                                                            </label>
                                                                        </span> 
                                                                    @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>

                                                                                <input type="checkbox" @if($force_double_opt_in_webform == "on" || $page_data['action'] == 'add') checked="checked"  @endif id="double_optin"  name="double_optin">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>  
                                                                   @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                            <div class="form-group row dbl-optins" data-name="dtwAIVor">
                                                                <div class="col-md-12" data-name="bRgsnifN">
                                                                    <label class="col-form-label col-md-3 pl12">{{trans('web_forms.add_new.form.thankyou_email')}}
                                                                        {!! popover('web_forms.add_new.form.thankyou_email_help','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-6" data-name="WdBShYaG">
                                                                    @if(isset($setup->thanks_email) && $setup->thanks_email == 'yes')
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input checked="checked" type="checkbox" id="thanks_email" name="thanks_email">
                                                                                <span></span>
                                                                            </label>
                                                                        </span> 
                                                                    @else
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input @if($page_data['action'] == 'add') checked="checked"  @endif  type="checkbox" id="thanks_email" name="thanks_email">
                                                                                <span></span>
                                                                            </label>
                                                                        </span> 
                                                                    @endif
                                                                    </div>
                                                                </div>      
                                                            </div>
                                                            <!-- Google Recaptcha  Starts -->
                                                            <div class="form-group row dbl-optins" data-name="IukSBttI">
                                                                <div class="col-md-12" data-name="ChbjxZBW">
                                                                    <label class="col-form-label col-md-3 pl12">{{trans('web_forms.btn.gcaptcha')}}
                                                                        {!! popover('web_forms.add_new.form.gcaptcha','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-6" data-name="ngsUuvDl">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                <input onchange="showOrHideElement('#recaptcha','#recaptchaDiv')" type="checkbox" id="recaptcha" {{isset($google_recaptcha) && $google_recaptcha ? 'checked' :''}} name="recaptcha" >
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row" id="recaptchaDiv" style=" {{isset($google_recaptcha) && $google_recaptcha ? '' :'display:none;'}} " data-name="dSiGXoOW">
                                                                <div class="col-md-6" data-name="SeOQFNmy">
                                                                    <label class="col-form-label">{{trans('web_forms.public_key')}}
                                                                        {!! popover('web_forms.add_new.form.public_key','common.description') !!}
                                                                    </label>
                                                                    <input type="text" class="form-control" name="public_key" value="{{ isset($public_key) ? $public_key : '' }}"   />
                                                                </div>
                                                                <div class="col-md-6" data-name="zsuUHtzh">
                                                                    <label class="col-form-label">{{trans('web_forms.secret_key')}}
                                                                        {!! popover('web_forms.add_new.form.secret_key','common.description') !!}
                                                                    </label>
                                                                    <input type="text" class="form-control" name="secret_key" value="{{ isset($secret_key) ? $secret_key : '' }}"   />
                                                                </div>
                                                            </div>

                                                            <div class="form-group row dbl-optins" data-name="RMGtLNfF">
                                                                <div class="col-md-12" data-name="XSKXuqwK">
                                                                    <label class="col-form-label col-md-3 pl12" for="admin_notify">{{trans('web_forms.admin_notification')}}
                                                                        {!! popover('web_forms.admin_notification_help','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-6" data-name="FRxABFTx">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                            <label>
                                                                                @if(isset($setup->admin_notify) && $setup->admin_notify == 'yes')
                                                                                    <input type="checkbox" id="admin_notify" checked name="admin_notify" >
                                                                                @else 
                                                                                    <input type="checkbox" id="admin_notify"  name="admin_notify" >
                                                                                @endif
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div data-name="BCSVdbsl" class="form-group row" id="admin_notify_blk"  @if(isset($setup->admin_notify) && $setup->admin_notify == 'yes')   @else style="display:none;" @endif>
                                                                <div data-name="QDFKgNPQ" class="col-md-6">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.email_new_contact_details')}}
                                                                        {!! popover('web_forms.add_new.form.email_new_contact_details_help','common.description') !!}
                                                                    </label>
                                                                    <input type="text" class="form-control" name="setup_email" id="setup_email" value="{{ isset($setup->setup_email) ? $setup->setup_email : '' }}"   />
                                                                </div>
                                                            </div>
                                                            <div class="form-group row admin_content_div" data-name="phiegiex" @if(isset($setup->admin_notify) && $setup->admin_notify == 'yes')   @else style="display:none;" @endif>

                                                                <div class="col-md-12" data-name="AxzdPla94sw">
                                                                    <label class="col-form-label">{{trans('web_forms.textarea.admin_content.title')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('web_forms.textarea.admin_content.help_desc','common.description') !!}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="Oswnd88fysw">
                                                                        <textarea id="admin_content" name="admin_content">{{ isset($setup->admin_content) ? $setup->admin_content : trans('web_forms.admin_content.default') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div  class="form-group row admin_content_div" data-name="PIgdeuio" @if(isset($setup->admin_notify) && $setup->admin_notify == 'yes')   @else style="display:none;" @endif>

                                                                <div class="col-md-12" data-name="OstrkhniP">
                                                                    <label class="col-form-label">{{trans('web_forms.input.admin_subject.title')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('web_forms.input.admin_subject.help_desc','common.description') !!}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="XjhdePgkdf">
                                                                        <input type="text" class="form-control" id="admin_subject" name="admin_subject" value="{{isset($setup->admin_subject)?$setup->admin_subject: trans('web_forms.admin_subject.default')}}" >
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row" data-name="CvAzmxvx">
                                                                <div class="col-md-6" data-name="MthoWJjm">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.format')}}
                                                                        {!! popover('web_forms.add_new.form.format_help','common.description') !!}
                                                                    </label>
                                                                    <select class="form-control" name="format" id="format">
                                                                        <option value="auto" {{ (isset($setup->format) && $setup->format == 'auto') ? 'selected' : '' }}>
                                                                            {{trans('web_forms.add_new.form.allow_contacts_to_choose')}}
                                                                        </option>
                                                                        <option value="html" {{ (isset($setup->format) && $setup->format == 'html') ? 'selected' : '' }}>
                                                                            {{trans('common.label.html')}}
                                                                        </option>
                                                                        <option value="text" {{ (isset($setup->format) && $setup->format == 'text') ? 'selected' : '' }}>
                                                                            {{trans('common.label.text')}}
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-6" data-name="XYlZmhoO">
                                                                    <label class="col-form-label">{{trans('common.label.duplicates')}}
                                                                         {!! popover('web_forms.add_new.form.duplicates_help','common.description') !!}
                                                                    </label>
                                                                    <select class="form-control" name="duplicate" id="duplicateDB">
                                                                            <option value="skip" {{ (isset($setup->duplicate) && $setup->duplicate == 'skip') ? 'selected' : '' }}>
                                                                                {{trans('common.label.skip')}}
                                                                            </option>
                                                                            <option @if(isset($setup->double_optin) && $setup->double_optin=='yes') style="display: none;" disabled=""  @endif @if(!isset($setup->double_optin)) style="display: none;" disabled="" @endif id="overwrite" value="overwrite" {{ (isset($setup->duplicate) && $setup->duplicate == 'overwrite') ? 'selected' : '' }}>
                                                                                {{trans('common.label.update')}}
                                                                            </option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" id="sn-blk" data-name="abHUjaUm">
                                                                    
                                                                <div class="col-md-12" data-name="ygosivwm">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.sending_nodes')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('web_forms.add_new.form.sending_nodes_help','common.description') !!}
                                                                    </label>
                                                                    <div class="scroll scroll-250 kt-checkbox-list" data-name="udkUVtEf">
                                                                        <div class="scList" data-name="SkRnrXrL">
                                                                            <label class="kt-checkbox">
                                                                                <input type="checkbox" class="checkbox-index checkbox-all-index">&nbsp;<b>{{trans('common.label.select_all')}}</b>
                                                                                <span></span>
                                                                            </label>
                                                                            @foreach ($smtp_tree as $group_metadata)
                                                                            <div class="input-icon right" data-name="KkDZSpDz">
                                                                                <label for="{{ $group_metadata['id'] }}" class="parentList kt-checkbox">
                                                                                    <input class="group-selector-subscriber checkbox-index" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group[]"> {{ $group_metadata['name'] }}
                                                                                    <span></span>
                                                                                </label>
                                                                            </div>
                                                                                @foreach ($group_metadata['children'] as $smtp_metadata)
                                                                                <div style="padding-left: 20px;" data-name="NQJBMYqz">
                                                                                    <label for="list-{{ $smtp_metadata['id'] }}" class="childList kt-checkbox">
                                                                                        <input type="checkbox" id="list-{{ $smtp_metadata['id'] }}" value="{{ $smtp_metadata['id'] }}" name="smtp_lists[]" class="group-subscriber-{{ $group_metadata['id'] }} checkbox-index" {{ isset($smtp_lists['smtp_lists']) && in_array($smtp_metadata['id'], $smtp_lists['smtp_lists']) ? 'checked' : '' }}> {{ $smtp_metadata['name'] }} <span></span>
                                                                                    </label>
                                                                                </div>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div id="sn-error" class="">{{trans('common.error.single_check')}}</div>
                                                                </div>
                                                            </div>
                                                            <?php 
                                                                 $license_attributes = json_decode(getSetting('license_attributes'), true);
                                                                $license_type = '';
                                                                if (! empty($license_attributes['package'])) {
                                                                    $license_type = $license_attributes['package'];
                                                                }
                                                            ?> 
                                                            <div class="form-group row" id="cl-blk" data-name="MkvTrSfS">
                                                                <div class="col-md-12" data-name="ZxzBKUYP">
                                                                    <label class="col-form-label">{{trans('common.label.contact_list')}}
                                                                        <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.contact_list_help','common.description') !!}
                                                                    </label>
                                                                    <div class="scroll scroll-250 kt-radio-list" data-name="YPfOmOYD">
                                                                        <div class="scList" data-name="YPKJfjXC">
                                                                            @foreach ($list_tree as $group_metadata)
                                                                                {{-- @if($authId!=$group_metadata['user_id'])
                                                                                        @continue
                                                                                    @endif--}}
                                                                                <div class="input-icon right" data-name="NVxjkuAJ">
                                                                                    <label class="parentList">{{ $group_metadata['name'] }}</label>
                                                                                </div>
                                                                                @foreach ($group_metadata['children'] as $list_metadata)
                                                                                {{--   @if($authId!=$list_metadata['user_id'])
                                                                                        @continue
                                                                                        @endif--}}
                                                                                    <?php 
                                                                                         $blockedP = "";
                                                                                         $blockedPClass = "";
                                                                                         $blockedText = "";
                                                                                         if($list_metadata["is_blocked"] == 1) { 
                                                                                             $blockedPClass = "list-disabled";
                                                                                             $blockedP = "disabled='disabled'";
                                                                                             $blockedText = "<bar>(Blocked)</bar>";
                                                                                         } 
                                                                                         $domainStatus = \App\Lists::getListDomainStatus($list_metadata['domain_id']); 
                                                                                         $domainMsg = "Missing Sending Domain";
                                                                                         $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); 
                                                                                         if(!$domainStatus AND $license_type == "Commercial ESP" and $unauth_sending_domain == "on") { 
                                                                                            $blockedPClass = "list-disabled";
                                                                                            $blockedP = "disabled='disabled'";
                                                                                            $domainMsg = "Missing Sending Domain";
                                                                                            $fixNowTxt ='<a class="fix-now" href="' . route('list.edit', $list_metadata['id']) . '" target="_blank">Fix Now</a>';
                                                                                            $blockedText = $fixNowTxt .'<small class="btn btn-label-warning label-blocked"> '.$domainMsg.'</small>';
                                                                                        }
                                                                                    ?> 
                                                                                    <div style="padding-left: 20px;" class="{{$blockedPClass}}" data-name="sqZMKBji">
                                                                                        <label class="childList kt-radio"><input {{$blockedP}} type="radio" value="{{ $list_metadata['id'] }}" name="subscriber_lists[]" id="subscriber-lists" onclick="getCustomFields( {{ $list_metadata['id'] }} )" {{ isset($subscriber_lists['id']) && $subscriber_lists['id'][0] == $list_metadata['id'] ? 'checked' : '' }}>
                                                                                            <name>{{ $list_metadata['name'] }}</name> {!!$blockedText!!} 
                                                                                            <span></span>
                                                                                        </label>
                                                                                    </div>
                                                                                    <div class="custom-fields-data" id="custom-fields-data-{{ $list_metadata['id'] }}" data-name="dcSTHJRc"></div>
                                                                                @endforeach
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    <div id="cl-error" class="">{{trans('common.error.single_check')}}</div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row" data-name="QgNEttCB">
                                                                
                                                                <div class="col-md-12" data-name="CdxNIqlA">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.select_fields')}}
                                                                        <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.select_fields_help','common.description') !!}
                                                                    </label>
                                                                    <div class="form-control kt-list-timeline scroll scroll-250" data-name="ahszYnMP">
                                                                        <ul id="sortable" class="kt-list-timeline__items">
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($page_data['action'] == 'edit' && isset($selected_fields))
                                                                <ul id="customfields-data" style="display: none;">
                                                                @foreach ($selected_fields as $key => $field)
                                                                <li id="{{$field->id}}" style="cursor: move;"><input type="hidden" value="{{$field->id}}">{{$field->name}}</li>
                                                                @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="gQTEpWDK">
                                                    <div class="kt-form__section kt-form__section--first" data-name="MnLJATAC">
                                                        <div class="kt-wizard-v4__form" data-name="xPsXySMR">

                                                        <div id="confirmationEmailContentDisable" style="display:none" class="alert alert-info" data-name="tkjmYjxS">@lang('web_forms.message.double_option')</div>
                                                            <div id="confirmationEmailContent" data-name="mJogdTUH">
                                                                <div class="form-group row" data-name="WSgaQyKA">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.confirmation_action')}}
                                                                        <span class="required"> * </span>
                                                                         {!! popover('web_forms.add_new.form.confirmation_action_help','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-12 kt-radio-inline" data-name="RcKFVWrN">
                                                                        <label for="c_show_page" class="kt-radio"><input type="radio" name="display_confirmatin_page" id="c_show_page" checked="checked" value="yes" {{ (isset($confirmation->
                                                                            display_confirmatin_page) && $confirmation->display_confirmatin_page == 'yes') ? 'checked' : '' }}> {{trans('web_forms.add_new.form.show_confirmation_page')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <label for="c_goto_web" class="kt-radio">
                                                                            <input type="radio" name="display_confirmatin_page" id="c_goto_web" value="no" {{ (isset($confirmation->display_confirmatin_page) && $confirmation->display_confirmatin_page == 'no') ? 'checked' : '' }}> {{trans('web_forms.add_new.form.take_contact_to_a_website')}}
                                                                            <span></span>
                                                                        </label>
                                                                        <label for="c_json" class="kt-radio">
                                                                            <input type="radio" name="display_confirmatin_page" id="c_json" value="json" {{ (isset($confirmation->display_confirmatin_page) && $confirmation->display_confirmatin_page == 'json') ? 'checked' : '' }}> {{trans('web_forms.add_new.form.show_json_response')}}
                                                                            <span></span>
                                                                        </label>
                                                                        
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row c_show_page" data-name="JgJphQgp" id="confirmationSkip">
                                                                        
                                                                    <div class="col-md-12" data-name="ZRtErheV">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.confirmation_page_content')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.confirmation_page_content_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="OywqIgVc">
                                                                            <textarea id="confirmation_content" name="confirmation_content">{{ isset($confirmation->confirmation_content) ? $confirmation->confirmation_content : trans('web_forms.add_new.form.confirmation_page_content_text') }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- dynamic tags start -->
                                                                <div class="col-md-12 custom_vars confirmation_custom_vars" data-name="gLWFqbiI">
                                                                @php
                                                                    $ckeditor_id = 'confirmation_content';
                                                                @endphp
                                                                  
                                                                <!-- dynamic tags end -->
                                                                </div>
                                                                <div class="form-group row w100" data-name="qPxAdpEJasas" style="display:none;"  id="div_json_response_text_content">
                                                                        
                                                                    <div class="col-md-12" data-name="rRBOISec">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.json_response_text_content')}}
                                                                            <span class="required"> * </span>
                                                                             {!! popover('web_forms.add_new.form.json_response_text_content_help','common.description') !!}
                                                                        </label>
                                                                        <textarea id="json_response_text_content" name="json_response_text_content" class="form-control" rows="15" required>{!! isset($confirmation->json_response_text_content) ? $confirmation->json_response_text_content : trans('web_forms.add_new.form.confirmation_json_content_text') !!}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row c_goto_web" style="display:none;" data-name="VygQxbow"> 
                                                                    <div class="col-md-6" data-name="yRaxGJVi">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.website_address')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.website_address_help','common.description') !!}
                                                                        </label>
                                                                        <input type="text" class="form-control" id="c_site_address" name="c_site_address" value="{{ isset($confirmation->c_site_address) ? $confirmation->c_site_address : '' }}" />
                                                                    </div>
                                                                    <div class="col-md-6" data-name="BtmaXkRL">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.sender_name')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.sender_name_help','common.description') !!}
                                                                        </label>
                                                                        <input type="text" class="form-control" id="c_name" name="c_name" value="{{ isset($confirmation->c_name) ? $confirmation->c_name : Auth::user()->name }}" />
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="MUafRnha">
                                                                    @php
                                                                          $cemail_default = Auth::user()->email;
                                                                          $cemail_default = explode("@", $cemail_default);
                                                                          $cemail_default_part1 = $cemail_default[0];
                                                                          $cemail_default_part2 = $cemail_default[1];
                                                                           
                                                                    @endphp
                                                                    <div class="col-md-6" data-name="IykLINnM">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.sender_name')}}
                                                                            <span class="required"> * </span>
                                                                        </label>
                                                                        <input type="text" class="form-control" name="c_email_name" id="c_email_name" value="{{ isset($confirmation->c_email_name) ? $confirmation->c_email_name : Auth::user()->name }}" />
                                                                    </div>
                                                                    <div class="col-md-6" data-name="ZeZujgou">
                                                                        <div class="row from-email" data-name="tgYRWgMZ">
                                                                            <label class="col-form-label col-md-12">{{trans('web_forms.add_new.form.sender_email')}}
                                                                                <span class="required"> * </span>
                                                                                {!! popover('web_forms.add_new.form.sender_email_help','common.description') !!}
                                                                            </label>
                                                                            <div class="col-md-6 pr0" data-name="ZKirRyrY">
                                                                                <div class="input-group" data-name="tSpLVTkP">
                                                                                    <input type="text" class="form-control" name="c_email_part1" id="c_email_part1" value="{{ isset($c_email_part1) ? $c_email_part1 : $cemail_default_part1 }}" />
                                                                                    <div class="input-group-append" data-name="oBEWSIwB">
                                                                                        <span class="input-group-text" id="basic-addon2">@</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>    
                                                                           
                                                                            <div class="col-md-6 pl0" data-name="tWNaCKGB">
                                                                                <select class="form-control m-select2" data-placeholder="Choose Domain" name="c_email_part2" id="c_email_part2">
                                                                                    <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); ?>
                                                                                    @php $disableFlag = 0; @endphp
                                                                                    <optgroup label="{{trans('lists.eligible_domains')}}">
                                                                                    @foreach($domain_maskings as $domain)
                                                                                        @php
                                                                                            $selected = "";
                                                                                            $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                                            $replace = '';
                                                                                            $subdomain = str_replace($order, $replace, $domain->domain);
                                                                                            if(!empty($c_email_part2) and trim($subdomain) == trim($c_email_part2)) { 
                                                                                                $selected = "selected";
                                                                                            }
                                                                                        @endphp
                                                                                        @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                                                        <option {{$selected}} value="{{ '@' . $subdomain }}">{{ $subdomain }}  </option>
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
                                                                                        @php
                                                                                            $selected = "";
                                                                                            $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                                            $replace = '';
                                                                                            $subdomain = str_replace($order, $replace, $domain->domain);
                                                                                            if(!empty($c_email_part2) and trim($subdomain) == trim($c_email_part2)) { 
                                                                                                $selected = "selected";
                                                                                            }
                                                                                        @endphp
                                                                                        @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                                                        
                                                                                        @else 
                                                                                            @php 
                                                                                               $disableTxt = "inactive";
                                                                                                if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                                                                if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                                                            
                                                                                            @endphp
                                                                                            <option disabled {{$selected}} value="{{ '@' . $subdomain }}">{{ $subdomain }}  <small>({{$disableTxt}}) </small></option>
                                                                                            
                                                                                        @endif
                                                                                    @endforeach
                                                                                    </optgroup>
                                                                                    @endif
                                                                                </select>   
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="JgRHibwy">
                                                                    <div class="col-md-6" data-name="tKyVNtiw">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.reply_email')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.reply_email_help','common.description') !!}
                                                                        </label>
                                                                        <input type="email" class="form-control" id="c_replyemail" name="c_replyemail" value="{{ isset($confirmation->c_replyemail) ? $confirmation->c_replyemail : Auth::user()->email }}" />
                                                                    </div>
                                                                    <div class="col-md-6" data-name="xgcqlHEu">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.email_subject')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.email_subject_help','common.description') !!}
                                                                        </label>
                                                                        <input type="text" class="form-control" id="c_subject" name="c_subject" value="{{ isset($confirmation->c_subject) ? $confirmation->c_subject : trans('web_forms.add_new.form.confirm_your_subscription') }}" />
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                $imap_switch = getApplicationSettings('imap_switch');
                                                                if($imap_switch != 2) {
                                                                ?>
                                                                <div class="form-group row" data-name="GOq96+XSA">
                                                                    <div class="col-md-6" data-name="xgcqlHEu">
                                                                        <label class="col-form-label">{{trans('web_forms.form_input.return_path')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.input.return_path.help_desc','common.description') !!}
                                                                        </label>

                                                                        <select class="form-control m-select2"  name="return_path" id="return_path">
                                                                            @foreach($bounce_emails as $bounce_email)
                                                                                <option value="{{ $bounce_email->name }}" {{ (isset($confirmation->return_path) && $confirmation->return_path == $bounce_email->name) ? 'selected' : '' }}>{{ isset($bounce_email->name) ? $bounce_email->name : '' }}</option>
                                                                            @endforeach
                                                                        </select>

                                                                       
                                                                    </div>
                                                                </div>
                                                                <?php } ?>

                                                                <div class="form-group" data-name="CCfLJcdB">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.confirmation_email_html_content')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('web_forms.add_new.form.confirmation_email_html_content_help','common.description') !!}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="cTyWpEmf">
                                                                         <textarea id="content_html" name="content_html">{{ isset($confirmation->content_html) ? $confirmation->content_html : trans('web_forms.add_new.form.confirmation_email_html_content_text') }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <!-- dynamic tags start -->
                                                                <div class="col-md-12 custom_vars" data-name="rVqEzmTc">
                                                                    @php
                                                                        $ckeditor_id = 'content_html';
                                                                    @endphp
                                                                    @if($adminOnClient)
                                                                        {{ dynamicTagsWebform(1, 2, $ckeditor_id,$webform->user_id) }}
                                                                    @else
                                                                        {{ dynamicTagsWebform(1, 2, $ckeditor_id) }}
                                                                    @endif
                                                                </div>
                                                                    <!-- dynamic tags end -->
                                                                <div class="form-group row w100" data-name="qPxAdpEJ">
                                                                        
                                                                    <div class="col-md-12" data-name="rRBOISec">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.confirmation_email_text_content')}}
                                                                            <span class="required"> * </span>
                                                                             {!! popover('web_forms.add_new.form.confirmation_email_text_content_help','common.description') !!}
                                                                        </label>
                                                                        <textarea id="content_text" name="content_text" class="form-control" rows="15" required>{!! isset($confirmation->content_text) ? $confirmation->content_text : trans('web_forms.add_new.form.confirmation_email_text_content_text') !!}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="qxPipBzQ">
                                                    <div class="kt-form__section kt-form__section--first" data-name="uLXvudGH">
                                                        <div class="kt-wizard-v4__form" data-name="hktTpowA">
                                                            <div class="form-group row" data-name="sNlADkRK">
                                                                <label class="col-form-label">{{trans('web_forms.add_new.form.thank_you_email_action')}}
                                                                    <span class="required"> * </span>
                                                                     {!! popover('web_forms.add_new.form.thank_you_email_action_help','common.description') !!}
                                                                </label>
                                                                <div class="col-md-12 kt-radio-inline" data-name="PVSeOHkw">
                                                                    <label for="t_show_page" class="kt-radio">
                                                                        <input type="radio" name="display_thanks_page" id="t_show_page" checked="checked" value="yes" {{ (isset($thankyou->display_thanks_page) && $thankyou->display_thanks_page == 'yes') ? 'checked' : '' }}> 
                                                                        {{trans('web_forms.add_new.form.show_thank_you_page')}}
                                                                        <span></span>
                                                                    </label> 
                                                                    <label for="t_goto_web" class="kt-radio">
                                                                        <input type="radio" name="display_thanks_page" id="t_goto_web" value="no" {{ (isset($thankyou->display_thanks_page) && $thankyou->display_thanks_page == 'no') ? 'checked' : '' }}> {{trans('web_forms.add_new.form.take_contact_to_a_website')}}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row t_show_page" data-name="vuCmQFoe">
                                                                <div class="col-md-12" data-name="qQXmPplr">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.thankyou_page')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('web_forms.add_new.form.thankyou_page_help','common.description') !!}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="mWXMgUWR">
                                                                        <textarea id="thanks_page" name="thanks_page">{{isset($thankyou->thanks_page) ? $thankyou->thanks_page : trans('web_forms.add_new.form.thankyou_page_text') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row t_goto_web" style="display: none;" data-name="tTaBPmCe">
                                                                <div class="col-md-12" data-name="yfysdOpL">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.website_address')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('web_forms.add_new.form.website_address_help','common.description') !!}
                                                                    </label>
                                                                    <input type="text" class="form-control" name="t_site_address" value="{{isset($thankyou->t_site_address) ? $thankyou->t_site_address : '' }}" />
                                                                </div>
                                                            </div>
                                                            <div id="thankYouEmailContent" data-name="AslfgJaK">
                                                                <div class="form-group row" data-name="AbigTIVy">
                                                                        
                                                                    <div class="col-md-6" data-name="sEtUXMig">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.thank_you_from_name')}}
                                                                            <span class="required"> * </span>
                                                                             {!! popover('web_forms.add_new.form.thank_you_from_name_help','common.description') !!}
                                                                        </label>
                                                                        <?php $title = !empty(config('appSettings.title')) ? config('appSettings.title') : "Mumara"; ?>
                                                                        <input type="text" class="form-control" id="t_name" name="t_name" value="{{isset($thankyou->t_name) ? $thankyou->t_name : $title }}" />
                                                                    </div>
                                                                    <div class="col-md-6" data-name="bYWDdQbB">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.thank_you_from_email')}}
                                                                            <span class="required"> * </span>
                                                                             {!! popover('web_forms.add_new.form.thank_you_from_email_help','common.description') !!}
                                                                        </label>
                                                                        <div class="row from-email" data-name="XNWCAjyK">
                                                                            <div class="col-md-6" data-name="SGzAjmEq">
                                                                                <div class="input-group" data-name="JRDaTXQG">
                                                                                    <input type="text" class="form-control" name="t_email_part1" id="t_email_part1" value="{{ isset($t_email_part1) ? $t_email_part1 :  $cemail_default_part1 }}" />
                                                                                    <div class="input-group-append" data-name="xBDaUMnn">
                                                                                        <span class="input-group-text" id="basic-addon2">@</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>    
                                                                            <?php $selectedd = "" ?>
                                                                            <div class="col-md-6" data-name="tfDwNxJm">
                                                                                <select class="form-control m-select2" data-placeholder="Choose Domain" name="t_email_part2" id="t_email_part2">
                                                                                    <option value="{{ isset($t_email_part2) ? $t_email_part2 : '' }}">{{ isset($t_email_part2) ? $t_email_part2 : 'Choose a Domain' }}</option>
                                                                                    <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); ?>
                                                                                    @php $disableFlag = 0; @endphp
                                                                                    <optgroup label="{{trans('lists.eligible_domains')}}">  
                                                                                    @foreach($domain_maskings as $domain)
                                                                                        @php
                                                                                        
                                                                                        $selected = "";
                                                                                            $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                                            $replace = '';
                                                                                            $subdomain = str_replace($order, $replace, $domain->domain);
                                                                                            if(!empty($t_email_part2) and trim($subdomain) == trim($t_email_part2)) { 
                                                                                                $selected = "selected";
                                                                                            }
                                                                                            
                                                                                        @endphp
                                                                                       
                                                                                       @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                                                        <option {{$selected}} value="{{ '@' . $subdomain }}">{{ $subdomain }}  </option>
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
                                                                                        @php
                                                                                        
                                                                                        $selected = "";
                                                                                            $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                                            $replace = '';
                                                                                            $subdomain = str_replace($order, $replace, $domain->domain);
                                                                                            if(!empty($t_email_part2) and trim($subdomain) == trim($t_email_part2)) { 
                                                                                                $selected = "selected";
                                                                                            }
                                                                                            
                                                                                        @endphp
                                                                                       
                                                                                       @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                                                        
                                                                                        @else 
                                                                                            @php 
                                                                                                $disableTxt = "inactive";
                                                                                                if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                                                                if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                                                            
                                                                                            @endphp
                                                                                            <option disabled {{$selected}} value="{{ '@' . $subdomain }}">{{ $subdomain }}  <small>({{$disableTxt}}) </small></option>
                                                                                            
                                                                                        @endif
                                                                                       
                                                                                    @endforeach
                                                                                    </optgroup>
                                                                                    @endif
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row" data-name="wrJGDUpV">
                                                                    <div class="col-md-6" data-name="NsLhtbhz">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.thank_you_reply_email')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.thank_you_reply_email_help','common.description') !!}
                                                                        </label>
                                                                        <input type="email" class="form-control" id="t_replyemail" name="t_replyemail" value="{{isset($thankyou->t_replyemail) ? $thankyou->t_replyemail : Auth::user()->email }}" />
                                                                    </div>
                                                                    <div class="col-md-6" data-name="SUGkbRUZ">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.thank_you_email_subject')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.thank_you_email_subject_help','common.description') !!}
                                                                        </label>
                                                                        <input type="text" class="form-control" id="t_subject" name="t_subject" value="{{isset($thankyou->t_subject) ? $thankyou->t_subject : trans('web_forms.add_new.form.thank_you_email_subject_text') }}" />
                                                                    </div>
                                                                </div>
                                                                

                                                                <?php if($imap_switch != 2) { ?>
                                                                    <div class="form-group row" data-name="GOq96+XSA">
                                                                        <div class="col-md-6" data-name="xgcqlHEu">
                                                                            <label class="col-form-label">{{trans('web_forms.form_input.return_path')}}
                                                                                <span class="required"> * </span>
                                                                                {!! popover('web_forms.input.return_path.help_desc','common.description') !!}
                                                                            </label>
                                                                            <select class="form-control m-select2"  name="t_return_path" id="t_return_path">
                                                                                @foreach($bounce_emails as $bounce_email)
                                                                                    <option value="{{ $bounce_email->name }}" {{ (isset($thankyou->return_path) && $thankyou->return_path == $bounce_email->name) ? 'selected' : '' }}>{{ isset($bounce_email->name) ? $bounce_email->name : '' }}</option>
                                                                                @endforeach
                                                                            </select>

                                                                        </div>
                                                                    </div>
                                                                <?php } ?>

                                                                <div class="form-group row" data-name="erUXCUJk">
                                                                    <div class="col-md-12" data-name="CSzJrfKM">
                                                                        <label class="col-form-label">{{trans('web_forms.add_new.form.thankyou_email_html_content')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('web_forms.add_new.form.thankyou_email_html_content_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="MiOfAwGZ">
                                                                            <textarea id="thankyou_content" name="thankyou_content">{{isset($thankyou->thankyou_content) ? $thankyou->thankyou_content : trans('web_forms.add_new.form.thankyou_email_html_content_text')  }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
<!--                                                                <div class="form-group row dynamicTags" data-name="OisubuGu">
                                                                    <label class="col-md-12 col-form-label">{{trans('web_forms.dynamic_tags.title')}}</label>
                                                                    <div class="col-md-12" data-name="FNJSnIrd">
                                                                        <div class="btn-group dropup" data-name="drptvXLr" > <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-success  btn-xs dropdown-toggle">{{trans('web_forms.dynamic_tags.select_custom_variables')}} <span class="caret"></span></a>
                                                                            
                                                                            <ul class="dropdown-menu ">
                                                                                @foreach($additional_fields as $field)
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('{{ $field['tag'] }}')"> {{ $field['name'] }} </a></li>
                                                                                @endforeach
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('Unsubscribe Link')"> {{trans('broadcasts.system_variables.option.unsubscribe_link')}} </a></li>
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('todays_date')"> {{trans('broadcasts.system_variables.option.todays_date')}}</a></li>
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('recipient_email')"> {{trans('broadcasts.system_variables.option.recipient_email')}} </a></li>
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('sender_email')"> {{trans('broadcasts.system_variables.option.sender_email')}}</a></li>
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('tracking_domain')"> {{trans('web_forms.dynamic_tags.tracking_domain')}}</a></li>
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('replyto_email')"> {{trans('broadcasts.system_variables.option.reply_to_Email')}} </a></li>
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('sender_name')"> {{trans('broadcasts.system_variables.option.sender_name')}} </a></li>
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('web_version')"> {{trans('broadcasts.system_variables.option.web_version_url')}} </a></li>
                                                                                    <li><a href="javascript:;" onclick="c_selectTag('Confirm Link')"> {{trans('broadcasts.system_variables.option.confirm_link')}} </a></li>
                                                                            </ul>
                                                                            
                                                                        </div>
                                                                        <div class="btn-group dropup" data-name="BQDCXGQn" > <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-success  btn-xs dropdown-toggle">{{trans('web_forms.dynamic_tags.custom_fields')}} <span class="caret"></span></a>
                                                                            <ul class="dropdown-menu" >
                                                                                @foreach($custom_fields as $field)
                                                                                    <li><a href="javascript:;" onclick="t_selectTag('{{ $field['tag'] }}')"> {{ $field['name'] }} </a></li>
                                                                                @endforeach
                                                                            </ul>                                                                            
                                                                        </div>
                                                                        @if(isset($spin_tags) && count($spin_tags) > 0)
                                                                        <div class="btn-group dropup" data-name="nlhflEtU" > <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-success  btn-xs dropdown-toggle">{{trans('broadcasts.spintags_variables.label')}} <span class="caret"></span></a>
                                                                            <ul class="dropdown-menu">
                                                                                @foreach($spin_tags as $spin_tag)
                                                                                    <li><a href="javascript:;" onclick="t_selectSpintag('{{ $spin_tag['tag'] }}')"> {{ $spin_tag['place_holder'] }} </a></li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                        @endif
                                                                       
                                                                        @if(isset($dynamic_contents) && count($dynamic_contents) > 0)
                                                                            <div class="btn-group dropup" data-name="rUEDRYKE" > <a href="javascript:void(0)" data-toggle="dropdown" class="btn btn-success  btn-xs dropdown-toggle">{{trans("broadcasts.dynamic_content_variables.label")}} <span class="caret"></span></a>
                                                                                <ul class="dropdown-menu" >
                                                                                    @foreach($dynamic_contents as $dynamic_content)
                                                                                        <li><a href="javascript:;" onclick="selectDynamicContent('{{ $dynamic_content['label'] }}','thankyou_content')"> {{ $dynamic_content['name'] }} </a></li>
                                                                                    @endforeach
                                                                                </ul>
                                                                            </div>
                                                                            @endif
                                                                        
                                                                    </div>
                                                                </div>-->
                                                                <div class="form-group row dynamicTags" data-name="OisubuGu">
                                                                    <!-- <label class="col-md-12 col-form-label">{{trans('web_forms.dynamic_tags.title')}}</label> -->
                                                                    <div class="col-md-12 filter-row filter-success" data-name="FNJSnIrd">
                                                                        <div class="filter-dropdown system-field">
                                                                            <select class="form-control m-select2" data-placeholder="{{ trans("broadcasts.system_variables.label") }}" name="system_variables_webform" id="addition_variables_webform" onchange="replaceVariableWebForm('thankyou_content','addition_variables_webform')"  >
                                                                                <option value="">{{ trans("broadcasts.system_variables.label") }}<option>
                                                                              
                                                                                <option value="Unsubscribe Link">{{trans('broadcasts.system_variables.option.unsubscribe_link')}}</option>
                                                                                <option value="todays_date">{{trans('broadcasts.system_variables.option.todays_date')}}</option>
                                                                                <option value="recipient_email"> {{trans('broadcasts.system_variables.option.recipient_email')}}</option>
                                                                                <option value="sender_email">{{trans('broadcasts.system_variables.option.sender_email')}}</option>
                                                                                <option value="tracking_domain">{{trans('web_forms.dynamic_tags.tracking_domain')}}</option>                                                                                
                                                                                <option value="replyto_email">{{trans('broadcasts.system_variables.option.reply_to_Email')}} </option>
                                                                                <option value="sender_name">{{trans('broadcasts.system_variables.option.sender_name')}}</option>
                                                                                <option value="Confirm Link">{{trans('broadcasts.system_variables.option.confirm_link')}} </option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="filter-dropdown additional-field">
                                                                            <select class="form-control m-select2" data-placeholder="{{trans('broadcasts.addition_field_variables.label')}}" name="custom_variables_webform" id="custom_variables_webform" onchange="replaceVariableWebForm('thankyou_content','custom_variables_webform')">
                                                                                <option value="">{{ trans("broadcasts.addition_field_variables.label") }}<option>
                                                                                    @foreach($additional_fields as $field)
                                                                                <option value="{{ $field['tag'] }}">{{ $field['name'] }}</option>
                                                                                @endforeach
                                                                                @foreach($custom_fields as $field)
                                                                                    <option value="{{ $field['tag'] }}">{{ $field['name'] }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <?php  $spin_tags = spinTags(Auth::user()->id); ?>
                                                                            @if(isset($spin_tags) && count($spin_tags) > 0)
                                                                            <div class="filter-dropdown spintag-field">
                                                                                <select class="form-control m-select2" data-placeholder="{{trans('broadcasts.spintags_variables.label')}}" name="spin_tags_variables_webform" id="spin_tags_variables_webform" onchange="replaceVariableWebForm('thankyou_content','spin_tags_variables_webform')">
                                                                                    <option value="">{{trans('broadcasts.spintags_variables.label')}}<option> 
                                                                                    @foreach($spin_tags as $spin_tag)
                                                                                        <option value="{{ $spin_tag['tag'] }}">{{ $spin_tag['place_holder'] }}</option>
                                                                                     @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @endif
                                                                       
                                                                        @if(isset($dynamic_contents) && count($dynamic_contents) > 0)
                                                                            <div class="filter-dropdown dynaic-field">
                                                                                <select class="form-control m-select2" data-placeholder="{{trans("broadcasts.dynamic_content_variables.label")}}" name="dynamic_content_variables_webform" id="dynamic_content_variables_webform" onchange="replaceVariableWebForm('thankyou_content','dynamic_content_variables_webform')">
                                                                                    <option value="">{{trans("broadcasts.dynamic_content_variables.label")}}<option>  
                                                                                    @foreach($dynamic_contents as $dynamic_content)
                                                                                    <?php
                                                                                    $label = (string) $dynamic_content["label"];
                                                                                    $label = str_replace("[[","", $label); //[[petname]]
                                                                                    $label = str_replace("]]","", $label);
                                                                                    ?>
                                                                                        <option value="{{ $label }}">{{ $dynamic_content['name'] }}</option>
                                                                                     @endforeach
                                                                                </select>
                                                                            </div>
                                                                            @endif
                                                                        <div class="btn-group dropup" data-name="JZYCYLmE">
                                                                            <a href="javascript:void(0)" id="copy-thanksemail" class="btn btn-success  btn-xs">{{trans('broadcasts.copy_as_text')}} </a>
                                                                            <div id="htmltotext_content" style="display:none" data-name="PokWResD" ></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="tUNLhCyY">
                                                                    <label class="col-form-label pl12">{{trans('web_forms.add_new.form.thankyou_email_text_content')}}
                                                                        <span class="required"> * </span>
                                                                         {!! popover('web_forms.add_new.form.thankyou_email_text_content_help','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-12" data-name="SpBTvRDy">
                                                                        <div class="input-icon right" data-name="JhIlhDLS">
                                                                            <textarea id="thanks_content_text" name="thanks_content_text" class="form-control" rows="15">{!!isset($thankyou->thanks_content_text) ? $thankyou->thanks_content_text : trans('web_forms.add_new.form.thankyou_email_content_text') !!}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="PxZSUylo">
                                                    <div class="kt-form__section kt-form__section--first" data-name="FuvLKIyZ">
                                                        <div class="kt-wizard-v4__form" data-name="hErIZzEK">
                                                            <div class="form-group row" data-name="qYLbfeWY">
                                                                <label class="col-form-label">{{trans('web_forms.add_new.form.error_actions')}}
                                                                    <span class="required"> * </span>
                                                                    {!! popover('web_forms.add_new.form.error_actions_help','common.description') !!}
                                                                </label>
                                                                <div class="col-md-12 kt-radio-inline" data-name="IQswupGo">
                                                                    <label class="kt-radio">
                                                                        <input type="radio" name="display_error_page" id="e_show_page" checked value="yes" {{ (isset($error->display_error_page) && $error->display_error_page == 'yes') ? 'checked' : '' }}> {{trans('web_forms.add_new.form.show_error_page')}}
                                                                        <span></span>
                                                                    </label>
                                                                    <label class="kt-radio">
                                                                        <input type="radio" name="display_error_page" id="e_goto_web" value="no" {{ (isset($error->display_error_page) && $error->display_error_page == 'no') ? 'checked' : '' }}>{{trans('web_forms.add_new.form.take_the_contact_to_following_website')}}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row e_show_page" data-name="QpQQnIuo">
                                                                    
                                                                <div class="col-md-12" data-name="IWbCsAwu">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.error_page')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('web_forms.add_new.form.error_page_help','common.description') !!}
                                                                    </label>
                                                                    <div class="input-icon right" data-name="GvjAXtex">
                                                                        <textarea id="error_content" name="error_content">{{isset($error->error_content) ? $error->error_content : trans('web_forms.add_new.form.error_page_text') }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12" data-name="IWbCsG34">
                                                                    <button class="btn btn-info btn-xs"  data-toggle="modal" data-target="#addvars">{{trans('web_forms.web_forms_create_blade.variables_button')}} </button>
                                                                </div>
                                                            </div>

                                                            <div class="form-group row e_goto_web" style="display: none;" data-name="KWqCrZcs">
                                                                    
                                                                <div class="col-md-12" data-name="JZxPLLzF">
                                                                    <label class="col-form-label">{{trans('web_forms.add_new.form.website_address')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('web_forms.add_new.form.website_address_help','common.description') !!}
                                                                    </label>
                                                                    <input type="text" class="form-control" name="e_site_address" value="{{isset($error->e_site_address) ? $error->e_site_address : '' }}" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                        <div class="kt-form__actions" data-name="rpaPofmO">
                                            <div class="btn btn-secondary btn-md back" data-ktwizard-type="action-prev" data-name="PfGOxMhX" onclick="gotoTop()">
                                                {{trans('common.form.buttons.back')}}
                                            </div>
                                            <div class="btn btn-success btn-md submitAction" data-ktwizard-type="action-submit" data-name="IZukcxHa" onclick="gotoTop()">
                                                {{trans('common.form.buttons.submit')}}
                                            </div>
                                            
                                            <div class="btn btn-brand btn-md submitAction" data-ktwizard-type="action-next" data-name="GXnrTfqR" onclick="gotoTop()">
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


<div class="modal fade" id="addvars" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <div class="row modal-header-row">
                    <!-- <div class="col-md-4">
                        <img src="/public/img/popup1.png" class="img-modal" />
                    </div> -->
                    <div class="col-md-12 modal-title">
                        <h5 class="modal-title" id="exampleModalLabel">{{trans('web_forms.web_forms_create_blade.additional_system_variables_heading')}} </h5>
                        <p class="model-help">{{trans('web_forms.web_forms_create_blade.system_additional_variables')}} </p>
                    </div>
                </div>
                
                
                <div class="e_show_page" data-name="QpQQnIuoasas" id="customfieldDD"></div>
            </div>
        </div>
    </div>
</div>


<div id="modal-loading" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="vSjCNvWP">
        <i class="fa fa-spinner fa-spin fa-5x"></i>
</div>
<script>
editor = CKEDITOR.replace( 'confirmation_content', {
            fullPage: true,
            allowedContent: true,
            height: 320
        } );

editor = CKEDITOR.replace( 'update_content', {
            fullPage: true,
            allowedContent: true,
            height: 320
        } );


editor2 = CKEDITOR.replace( 'content_html', {
            fullPage: true,
            allowedContent: true,
            height: 320
        } );
editor3 = CKEDITOR.replace( 'thanks_page', {
            fullPage: true,
            allowedContent: true,
            height: 320
        } );
editor4 = CKEDITOR.replace( 'thankyou_content', {
            fullPage: true,
            allowedContent: true,
            height: 320
        } );
editor5 = CKEDITOR.replace( 'error_content', {
            fullPage: true,
            allowedContent: true,
            height: 320
        } );
editor6 = CKEDITOR.replace( 'admin_content', {
    fullPage: true,
    allowedContent: true,
    height: 320
} );
CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
CKEDITOR.config.extraPlugins = 'preview,font,colorbutton,justify,bidi,language,emojione';
CKEDITOR.config.language_list = ['en:English','ar:Arabic:rtl', 'fr:French', 'he:Hebrew:rtl', 'es:Spanish'];
CKEDITOR.config.defaultLanguage = 'en';
CKFinder.setupCKEditor( editor );
CKFinder.setupCKEditor( editor2 );
CKFinder.setupCKEditor( editor3 );
CKFinder.setupCKEditor( editor4 );
CKFinder.setupCKEditor( editor5 );
CKFinder.setupCKEditor( editor6 );
</script>
@endsection