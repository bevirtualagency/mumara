@extends(decide_template())

@section('title', $pageTitle)
<link href="/resources/assets/css/templates.css?v={{$local_version}}.02" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/codemirror.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/neo.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
@section('page_styles')
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/sweetalert.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.alphanumeric.pack.js" type="text/javascript"></script>
<script src="/themes/default/js/codemirror.js" manual type="text/javascript"></script>
<script src="/themes/default/js/javascript.js" type="text/javascript"></script>
<script src="/themes/default/js/htmlmixed.js" type="text/javascript"></script>
<script src="/themes/default/js/css.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery-ui.js"></script>
<script>
    $(document).ready(function() {
        $("body").click(function(){
			$(".popupImgBlk").fadeOut().removeClass("show");
		})
        var editor = CodeMirror.fromTextArea(document.getElementById("htmldata"), {
            lineNumbers: true,
        });
     $(document).on('change',"#status",function(){
             var id= $(this).data('id');
             var status= $(this).is(':checked') ? 1:0;
             changeStatus(id,status,$(this));      
             
        });
@if(auth()->user()->role_id==1)
     $(document).on('change',"#show_to_user",function(){
             var id= $(this).data('id');
             var status= $(this).is(':checked') ? 3:4;
             changeStatus(id,status,$(this));      
             
        });
@endif
    function changeStatus(id,status,elem){
       $(".blockUI").show();
               $.ajax({
                url: "{{ route('templatesActions') }}",
                type: "POST",
                data: {id:id,status:status},
                success:function(data){
                    if(status==1){
                        elem.addClass('active');
                    }else{
                        elem.removeClass('active');
                    }
                    $(".blockUI").hide();
                    Command: toastr["success"] (data.message); 
                    // swal(data.message, {
                    //         icon: data.alert,
                    //         });
                },
                error:function(){
                    $(".blockUI").hide();
                },
            });  
    }
       
        $(".clanel-modal").click(function() {
            $("#upload_popup").modal("hide");
            $("#import-result>.alert").hide();
            $(".processingBlk").hide();
            $(".filename").text("");
            $("#progress-simple").css("width", "0%");
            $("#import").removeAttr("disabled");
        });

         

        $("#template-frm").validate({
            ignore: [],       
            rules: {
                file: {
                    required: !0
                }
            },
            invalidHandler: function(event, validator) {
                 Command: toastr["error"] ("@lang('common.message.form_error')");  
            },
            submitHandler: function(e) {

               
                $('#import-result .alert').hide();
                var filename = $('input[type=file]').val().split('\\').pop();

                $(".filename").text(filename);

                $(".processingBlk").show();
                $("#progress-simple").css("width", "0%");
                $('#import').prop('disabled',true);
                var i = $("#template_zip").prop("files")[0];
                var r = new FormData;
                r.append("file", i)
                // r.append("user_id", "{{ auth()->id()}}");
                // r.append("url", "{{ url('') }}");
                // $(".blockUI").show();
            $.ajax({
                 xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                          if (evt.lengthComputable) {
                            var percentComplete = evt.loaded / evt.total;
                            percentComplete = parseInt(percentComplete * 100);
                              var elem = document.getElementById("progress-simple");
                                  elem.style.width = percentComplete + "%";

                          }
                        }, false);

                        return xhr;
                      },
                url: "{{ route('uploadTemplate') }}",
                type: "POST",
                dataType: "json",
                contentType: !1,
                processData: !1,
                data: r
            }).done((function(e, n, i) {
               Command: toastr["success"] ("@lang('broadcasts.message.template_uploaded')");
               location.reload();
            })).fail((function(e, t, n) {
               var msg_t =JSON.parse(e.responseText);
               Command: toastr["error"] (msg_t.message);
               // $(".blockUI").hide();
               $('#import').prop('disabled',false);
               $(".progress-block,#ajax-spinner-text").hide();
            }))

                    
               
                return false; 
            }
        });

        $(".delete-me").click(function(){
            var $this=$(this);
            swal({
                title: "@lang('common.message.are_you_sure')",
                text: "@lang('broadcasts.message.template_remove_warning')",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    changeStatus($this.data('id'),2,$this);
                    $this.parents('tr').remove();
                    
                } 
            });
        });

        @php
        $user  = auth()->user();
        if($user->role_id==1){
            $storage_path  = "/storage/builder/templates";
        }else{
            $storage_path  = "/storage/users/{$user->id}/broadcasts/templates";
        }
         
        @endphp
        $("#templates").dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [2,3,@if($user->role_id==1)5 @endif]}],
            "aaSorting": [[4, "desc"]],
            "aLengthMenu": [[10,50, 100, 500], [10,50, 100, 500]],
        });
        // $("#templates").dataTable({
        //     order: [[4, 'desc']],
        // });
        $("#close-popup").on("click",function() {
			$(".popupImgBlk").removeClass("show").addClass("hide");
		});
		$("#templates").on("click", ".viewImage", function() {
			var image =$(this).attr("data-image");
			$("#tempImg").attr("src", image)
			$(".blockUI").show();
			setTimeout(() => {
				$(".popupImgBlk").removeClass("hide").addClass("show");
				$(".blockUI").hide();
			}, 500);
		});

        

        $("#templates").on("click", ".edit-template", function() {
            let r = (Math.random() + 1).toString(36).substring(7);
            var id = $(this).attr("data-id");
            var name = $(this).attr("data-name");
            var tempUrl = "{{$storage_path}}/"+id+"/index.html?r="+r;
            $('#update-html').attr('data-uid',id);
            $("#htmldata").html("");
            $("#html-label").text("Edit Template ("+name+") HTML");
            $("#htmldata").focus();
            jQuery.get(tempUrl, function(data) {
                $("#htmldata").html(data);
               
                // $("#viewhtml-popup .CodeMirror").remove();
                editor.setValue(data);
                $('.CodeMirror').each(function(i, el){
                        el.CodeMirror.refresh();
                    });

                $(".blockUI").show();
                setTimeout(() => {
                    $("#htmldata").html(data);
                    $(".blockUI").hide();
                    $("#viewhtml-popup").modal("show");
                    
                    setTimeout(() => {
                        $("#htmldata").trigger("click");
                        $('.CodeMirror').each(function(i, el){
                            el.CodeMirror.refresh();
                        });
                    }, 500);
                }, 500);
            });
        });


        $("#update-html").click(function() {

              $(".blockUI").show();
               $.ajax({
                url: "{{ route('updateContent') }}",
                type: "POST",
                data: {uid:$(this).data('uid'),content:editor.getValue()},
                context:this,
                success:function(data){
                    $(".blockUI").hide();
                    $("#viewhtml-popup").modal("hide");
                    // $("#viewhtml-popup .CodeMirror").remove();
                    swal(data.message, {
                            icon: data.alert,
                            });
                },
                error:function(){
                    $(".blockUI").hide();
                },
            });
                   
        });        
        $("#html-close").click(function() {
            $("#viewhtml-popup").modal("hide");
            setTimeout(() => {
                // $("#viewhtml-popup .CodeMirror").remove();
            }, 1000);
        });
        
        $("#upload-none").click(function() {

            Command: toastr["error"] ("{{trans('templates.templates_blade.contact_support_command')}}");  

        });
      
    });
</script>
@include('includes.view-pages-filter-script')
@endsection

@section(decide_content())
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="popupImgBlk hide">
	<div class="flaticon2-cross text-link" id="close-popup"></div>
	<div class="pic scroll">
		<img id="tempImg" src="/public/img/empty.png" >
	</div>
</div>
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid">
            <div class="kt-portlet__body">
                <div class="table-toolbar">
                    <div class="form-group row">
                        <div class="col-md-12">
                            @if($access)
                            <div class="btn-group">
                                <button data-toggle="modal" data-target="#upload_popup" class="btn btn-label-success">
                                    {{trans('broadcasts.templates.button_upload')}}
                                </button>
                            </div>
                            @endif
                            @if(!$access && $user->role_id==1)
                            <div class="btn-group">
                                <button class="btn btn-label-success" id="upload-none">
                                    {{trans('broadcasts.templates.button_upload')}}
                                </button>
                            </div>
                            @endif

                            @if(auth()->user()->role_id !=1 && !$access)
                            
                            @else
                            <div class="btn-group">
                                <a href="{{ route('templates.marketplace') }}">
                                <button id="sample_editable_1_new" class="btn btn-label-info">
                                    {{trans('broadcasts.templates.button_temp_marketplace')}}
                                </button></a>
                            </div>
                            @endif
                            
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-checkable responsive" id="templates" role="grid" >
                    <thead>
                        <tr role="row">
                            <th width="30%">{{trans('broadcasts.templates.table.template')}}</th>
                            <th width="15%">{{trans('broadcasts.templates.table.category')}}</th>
                            <th width="20%">{{trans('broadcasts.templates.table.status')}}</th>
                            @if(auth()->user()->role_id==1)
                            <th width="20%">{{trans('broadcasts.templates.table.client_enabled')}}</th>
                            @endif
                            <th width="15%">{{trans('broadcasts.templates.table.created_on')}}</th>
                            <th width="20%">{{trans('broadcasts.templates.table.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($templates as $name => $template)
                        <tr>
                            <td width="30%">
                                <div class="d-flex align-items-center title-block">
                                    <div class="symbol symbol-50 symbol-light">
                                        <span class="symbol-label bg-white ">
                                            <i class="fa fa-eye viewImage" data-image="{{$template['thumbnail']}}"></i>
                                            <img class=" viewImage" data-image="{{$template['thumbnail']}}" src="{{$template['thumbnail']}}" alt="Template thumbnail">
                                        </span>
                                    </div>
                                    <div>
                                        <div href="javascript:;" class="font-weight-bolder mb-1">{{$template['name']}} 
                                            @if(auth()->user()->role_id !=1 && auth()->id() != $template['user_id'])
                                            <span class="badge badge-grey">{{trans('templates.templates_blade.assigned_by_admin_span')}}</span>
                                            @endif
                                        </div>
                                        <span class="d-block">{{$template['short_description']}}</span>
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <span class="text-dark-75 font-weight-bolder d-block">{{$template['category']}}</span>
                            </td>
                            <td width="20%">
                                @if($template['user_id']==auth()->id())
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                       <input data-id="{{ $template['id'] }}" id="status" type="checkbox" {{ $template['status'] ==1 ? 'checked':''}}>
                                        <span></span>
                                    </label>
                                </span>
                                @else
                                ----
                                @endif
                            </td>
                            @if(auth()->user()->role_id==1)
                             <td width="20%">
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                       <input data-id="{{ $template['id'] }}" id="show_to_user" type="checkbox" {{ !empty($template['show_to_user']) && $template['show_to_user'] ==1 ? 'checked':''}}>
                                        <span></span>
                                    </label>
                                </span>
                            </td>
                            @endif
                            <td width="15%">
                                {{ $template['date'] }}
                            </td>
                            <td width="20%">
                                @if($template['user_id']==auth()->id())
                                <div class="dropdown btn-link"> <a class="btn btn-label-success btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-expanded="false"><i class="flaticon-more-1"></i></a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu" x-placement="bottom-end" style="position: absolute; transform: translate3d(-215px, 31px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <li>
                                            <a href="javascript:;" data-id="{{ $template['id'] }}" data-name="{{ $template['name'] }}" class="edit-template"> <i class="fa fa-edit icon-size"></i> {{trans('templates.templates_blade.edit_template_action')}}</a>
                                        </li>
                                        <li>
                                            <a data-id="{{ $template['id'] }}"  href="javascript:;" class="delete-me" > <i class="fa fa-remove icon-size"></i> {{trans('templates.templates_blade.delete_action')}} </a>
                                        </li>
                                    </ul>
                                </div>
                                @else
                                ----
                                @endif
                            </td>
                        </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<div class="modal fade" id="upload_popup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" data-backdrop="static" data-keyboard="false" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">{{trans("templates.temmplates.upload")}}</h5>
         </div>
         <div class="modal-body">
            <div class="form-group row">
               <div class="col-md-12">
                  {{trans('templates.templates_blade.upload_zip_file_div')}}                    
               </div>
            </div>
            <form action="" method="POST" id="template-frm" class="kt-form kt-form--label-right" enctype="multipart/form-data" novalidate="novalidate">
               <div class="form-group row">
                  <label class="col-form-label col-md-3">{{trans('common.label.select_file')}} <span class="required"> * </span></label>
                  <div class="col-md-8">
                     <div class="input-icon right">
                        <input type="file" required="" name="file" id="template_zip" class="form-control">
                     </div>
                  </div>
               </div>
               <div class="form-actions row" id="action-row">
                  <label class="col-form-label col-md-3"></label>
                  <div class="col-md-8">
                     <button type="submit" class="btn btn-success" id="import">{{trans('templates.templates_blade.upload_button')}}</button>
                     <button type="button" class="btn btn-default clanel-modal" >{{trans('templates.templates_blade.cancel_button')}}</button>
                  </div>
               </div>
            </form>
            <div class="processingBlk">
               <div id="ajax-spinner-text">
                    <i class="fa fa-spinner fa-spin" style="display: inline-block;"></i>
                    {{trans('templates.templates_blade.template_zip_strong')}}  <strong class="filename">{{trans('templates.templates_blade.template_zip_strong')}}</strong>
                </div>
                <div class="progress-block">
                     <div class="bg-success" id="progress-simple" style="width: 0%;">0%</div>
                </div>
                <div id="import-result">
                  <div class="alert alert-danger alert-light alert-bold" role="alert" id="aborted">
                     <div class="alert-text"></div>
                  </div>
                  <div class="alert alert-success alert-light alert-bold" role="alert" id="resultbar">
                     <div class="alert-text"></div>
                  </div>
                </div>
            </div>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="viewhtml-popup" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="html-label">{{trans("builder::templates.Edit_Template_HTML")}}</h5>
                <button type="button" id="html-close" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <textarea class="form-control codemirror-textarea" id="htmldata"></textarea>
                <button type="button" class="btn btn-success btn-sm" id="update-html">@lang('common.form.buttons.update')</button>
            </div>
        </div>
    </div>
</div>
@endsection