@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/jstree.min.css?v={{$local_version}}.02">
@endsection
@section(decide_content())

<!-- BEGIN FORM-->
<div class="row" data-name="zbTZXxLd">
    <div class="col-md-12" data-name="MoMHPZdN"> 
      <div id="filer-demo" class="kt-portlet kt-portlet--height-fluid" data-name="CAxEhphB"></div>
        <div class="modal fade" id="integrats" tabindex="-1" role="dialog" aria-labelledby="integration" aria-hidden="true" data-backdrop="static" data-keyboard="false" data-name="MzYmvEli">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document" data-name="QwMbXSRU">
                <div class="modal-content" data-name="sfAXLaML">
                    <div class="modal-header" data-name="axKcMNyi">
                        <h5 class="modal-title" id="responseFileName">@lang('common.label.response')</h5>
                    </div>
                    <div class="modal-body" data-name="YCVKJtZB">
                       <div class="" data-name="xpamNtol"><textarea class="form-control m-input m-input--air pr-3 pl-3" readonly id="response" rows="10"></textarea></div>
                    </div>
                    <div class="modal-footer" data-name="eSIWTdGg">

                        <button type="button"  class="btn btn-success" onclick="copy('response')" >@lang('common.form.buttons.copy')</button>
                        <button id="dismiss_btn" type="button" class="btn btn-primary" data-dismiss="modal">@lang('common.form.buttons.close')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<!-- END FORM-->
@endsection
@section('page_scripts')
<script src="/themes/default/js/jstree/jstree.min.js"></script>
<script src="/themes/default/js/jsfiler/jsfiler.js"></script>
<script type="text/javascript">
$('#filer-demo').jsfiler({

	  /* 1 - right-click menu, 2 - icon menu, 3 - both */
	  menuMode: 1, 

	  /* path to tree and menu icons */
	  iconPath: '', 

	  /* no tree checkboxes */
	  checkbox: false, 

	  /* allow drag & drop */
	  canDrag: false, 

	  /* allow multiple roots */
	  rootSingle: false, 

	  /* allow leafs for root node */
	  rootLeaf: true, 

	  /* root parent id */
	  rootParent: -1, 

	  /* save opened/selected state */
	  saveState: false, 

	  /* open the node on: 1 - click, 2 - dblclick, 3 - both 04.2017 */
	  selectOpen: 2, 

	  /* knots deletion: 0 - empty only, 1 - +copied, 2 - all */
	  knotRemove: 0, 

	  /* duplicate child names: 2 - allow, 1 - case-sensitive, 0 - no */
	  nameDupl: 0, 

	  /* name trim patterm (leading & trailing spaces */
	  nameTrim: /^\s+|\s+$/g, 

	  /* don't vali<a href="https://www.jqueryscript.net/time-clock/">date</a> */
	  nameValidate: false, 

	  /* user authorization token */
	  userAuth: null, 

	  /* ajax request url */
	  urlAjax: '{{route('getCLogs')}}' 
	  
	});
$('#filer-demo').off("contextmenu.jstree", ".jstree-anchor");


$(document).on('click','.jstree-leaf',function(){
	id = '#'+this.id;
	node = $(id).parent().parent();
	dir_node_id = $(node).attr("id");
	dir_name = $('#'+dir_node_id).children(':nth-child(2)').text();	
	file_name = $(id).text();
	 $.ajax({
         type: "POST",
         url: '{{route('getCLog')}}',
         data: {'file':file_name,'dir':dir_name},
         cache: false,
         dataType: 'json',
         beforeSend: function() {
          $('.blockUI').show();
        	 $('#integrats').modal("hide");
        	 $('#response').val('');
         },
         success: function (data) {
       		    $('.blockUI').hide();
             if (data.status==true) {
                 $('#responseFileName').text(file_name+' (Response)');
                 $("#response").val(JSON.stringify(data.content,null, 4));
            	 $('#integrats').modal("show");

             }
             else {
                 

             }
        
         }
     });
	});
function copy(id) {
    textarea = document.getElementById(id);
    textarea.select();
    document.execCommand("copy");
    toastr.success("@lang('logs.message.response_copied')");
}

</script>

@endsection