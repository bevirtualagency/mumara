@extends(decide_template())


@section('title',  $page_data['title'] )

@section('page_styles')
    
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>

<script src="/themes/default/js/includes/sortable.js" type="text/javascript"></script>
<script>
  $( function() {
    $( "#sortable" ).sortable({
     cancel: ".disable-sort-item"
});
    $( "#sortable" ).disableSelection();
    $('#sortable').append('<span style="margin-right:0px" class="kt-list-timeline__badge disable-sort-item"></span><input type="hidden" name="" value=""><span class="kt-list-timeline__text">{{ trans("common.label.email")}}</span>');
   
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

    <div class="col-md-6 create-form" data-name="RXTvGJFy">
        <form action="#" method="POST" id="token-frm" class="kt-form kt-form--label-right">
            <div class="row" data-name="BICYCiRU">
                <div class="kt-portlet kt-portlet--height-fluid" data-name="PTRrZzmy">
                    <div class="kt-portlet__body" data-name="RNVyohqL">
                        <div class="form-body" data-name="TLLaBguC">
                            <div class="form-group row" data-name="BjSZSeNS">
                                <div class="col-md-10" data-name="laPLPGukdsdsd">
                                    <textarea id="from_html" name="from_html">{{ $html_code }}</textarea>                                    
                                </div>                                
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </form>
    </div>





<div id="modal-loading" class="modal" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="vSjCNvWP">
        <i class="fa fa-spinner fa-spin fa-5x"></i>
</div>
<script>
editor = CKEDITOR.replace( 'from_html', {
            fullPage: true,
            allowedContent: true,
            height: 320
        } );



CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
CKEDITOR.config.extraPlugins = 'preview,font,colorbutton,justify,bidi,language';
CKEDITOR.config.language_list = ['en:English','ar:Arabic:rtl', 'fr:French', 'he:Hebrew:rtl', 'es:Spanish'];
CKEDITOR.config.defaultLanguage = 'en';
CKFinder.setupCKEditor( editor );
</script>
@endsection