@extends('layouts.master2')

@section('title',  $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/web-templates.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script>

	

	$(document).ready(function() {
        var tid = localStorage.getItem("template_id");

		$(".choose-template").click(function() {
			var id =$(this).attr("data-id");
			//window.localStorage.setItem('template_id', id);
			window.location = "{{ url('/form/add') }}/"+id;
		});
		$("#open_blank").click(function() {
			var id =$(this).attr("data-id");
			///window.localStorage.setItem('template_id', id);
			//window.location = "{{route('form.create')}}";
                        window.location = "{{ url('/form/add') }}/"+id;
		});
		$("#close-popup").click(function() {
			$(".popupImgBlk").removeClass("show").addClass("hide");
		});
		$(".viewImage").click(function() {
			var image =$(this).attr("data-image");
			$("#tempImg").attr("src", image)
			$(".blockUI").show();
			setTimeout(() => {
				$(".popupImgBlk").removeClass("hide").addClass("show");
				$(".blockUI").hide();
			}, 500);
			
		});

		$(".m-select2").select2();

		$("#search").on("keyup", function() {
			var q =$('#search').val().toLowerCase();
			if(!q){
				$('.custom-templates').css("display","flex");
			}else if( q){
				$('.custom-templates').each(function() {
		      	var name=$(this).data('name').toLowerCase();
                        
		        if(name.indexOf(q) > -1){
		        	$(this).css("display","flex");
		        }else{
		        	$(this).css("display","none");
		        }

		      });
			}
		});
	});
	
	
</script>
@endsection


@section('content')

<div class="popupImgBlk hide">
	<div class="flaticon2-cross text-link" id="close-popup"></div>
	<div class="pic">
		<img id="tempImg" src="/public/img/url.jpg" >
	</div>
</div>

<div id="no-template">
	<div class="row">
		<div class="col-md-12">
			<div class="no-template-block">
				<div class="no-template">
					<i class="flaticon2-browser-2"></i>
					<span class="no-temp-content">{{trans('web_forms.web_forms_templates_blade.span_template_added')}} </span>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-12">
		<div class="kt-portlet kt-portlet--height-fluid">
			<div class="kt-portlet__body p-0 overflow-x-hidden">
				<div class="row align-items-center">
					<div class="col-md-10 offset-md-1">

						<div class="filter-section row">
							<div class="form-group col-md-3">
								<label class="control-label">{{trans('web_forms.web_forms_templates_blade.label_search_template')}}</label>
								<input type="text" name="search" id="search" placeholder="Search Template" class="form-control" />
							</div>
						</div>

						<div class="row align-items-center" id="all-templates">

                            <div class="col-md-6" key="templates-0" id="blank-template">
                                <div class="cbBlk blank">
                                    <div class="blankImage"><i class="flaticon2-browser-2"></i></div>
                                    <div class="cbMenuBlk"><button id="open_blank" class="btn btn-primary" data-id="0" data-name="Blank" >{{trans('web_forms.web_forms_templates_blade.blank_template_button')}} </button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">{{trans('web_forms.web_forms_templates_blade.blank_template_button')}} </div>
                                    </div>
                                </div>
                            </div>
                            @foreach($templatesData as $templatesRow)                        
                            <?php
                            
                            if($templatesRow['id'] <9 ||  empty($templatesRow['preview_picture'])){
                                $imageUrl = url('themes/default/webforms/'.$templatesRow['category_id'].'/thumbnail.jpg');
                            }else{                                 
                                 $imageUrl = config("mumara.web_form_designs") . $templatesRow['preview_picture'];
                            }
                            ?>
                            <div class="col-md-6 Template_Name custom-templates" key="templates-{{ $templatesRow['id'] }}" data-name="{{ $templatesRow['design_name'] }}">
                                <div class="cbBlk">
                                    <img src="{{ $imageUrl }}" class="" >
                                    <div class="viewImage" data-image="{{ $imageUrl }}">
                                        <i class="fas fa-search" data-image="{{ $imageUrl }}"></i>
                                    </div>
                                    <div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="{{ $templatesRow['id'] }}" data-name="{{ $templatesRow['design_name'] }}">{{trans('web_forms.web_forms_templates_blade.use_this_button')}} </button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">{{ $templatesRow['design_name'] }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

<!--                            <div class="col-md-6 Template_Name custom-templates" key="templates-2" data-name="Template Two">
                                <div class="cbBlk">
                                    <img src="{{ url('themes/default/webforms/2/thumbnail.jpg')}}" class="" >
                                    <div class="viewImage" data-image="{{ url('themes/default/webforms/2/thumbnail.jpg')}}">
                                        <i class="fas fa-search" data-image="{{ url('themes/default/webforms/2/thumbnail.jpg')}}"></i>
                                    </div>
                                    <div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="2" data-name="Template Two">Use This</button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">Template Two</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 Template_Name custom-templates" key="templates-3" data-name="Template Three">
                                <div class="cbBlk">
                                    <img src="{{ url('themes/default/webforms/3/thumbnail.jpg')}}" class="" >
                                    <div class="viewImage" data-image="{{ url('themes/default/webforms/3/thumbnail.jpg')}}">
                                        <i class="fas fa-search" data-image="{{ url('themes/default/webforms/3/thumbnail.jpg')}}"></i>
                                    </div>
                                    <div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="3" data-name="Template Three">Use This</button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">Template Three</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 Template_Name custom-templates" key="templates-4" data-name="Template Four">
                                <div class="cbBlk">
                                    <img src="{{ url('themes/default/webforms/4/thumbnail.jpg')}}" class="" >
                                    <div class="viewImage" data-image="{{ url('themes/default/webforms/4/thumbnail.jpg')}}">
                                        <i class="fas fa-search" data-image="{{ url('themes/default/webforms/4/thumbnail.jpg')}}"></i>
                                    </div>
                                    <div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="4" data-name="Template Four">Use This</button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">Template Four</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 Template_Name custom-templates" key="templates-5" data-name="Template Five">
                                <div class="cbBlk">
                                    <img src="{{ url('themes/default/webforms/5/thumbnail.jpg')}}" class="" >
                                    <div class="viewImage" data-image="{{ url('themes/default/webforms/5/thumbnail.jpg')}}">
                                        <i class="fas fa-search" data-image="{{ url('themes/default/webforms/5/thumbnail.jpg')}}"></i>
                                    </div>
                                    <div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="5" data-name="Template Five">Use This</button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">Template Five</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 Template_Name custom-templates" key="templates-6" data-name="Template Five">
                                <div class="cbBlk">
                                    <img src="{{ url('themes/default/webforms/6/thumbnail.jpg')}}" class="" >
                                    <div class="viewImage" data-image="{{ url('themes/default/webforms/6/thumbnail.jpg')}}">
                                        <i class="fas fa-search" data-image="{{ url('themes/default/webforms/6/thumbnail.jpg')}}"></i>
                                    </div>
                                    <div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="6" data-name="Template Five">Use This</button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">Template Six</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 Template_Name custom-templates" key="templates-7" data-name="Template Five">
                                <div class="cbBlk">
                                    <img src="{{ url('themes/default/webforms/7/thumbnail.jpg')}}" class="" >
                                    <div class="viewImage" data-image="{{ url('themes/default/webforms/7/thumbnail.jpg')}}">
                                        <i class="fas fa-search" data-image="{{ url('themes/default/webforms/7/thumbnail.jpg')}}"></i>
                                    </div>
                                    <div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="7" data-name="Template Five">Use This</button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">Template Seven</div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 Template_Name custom-templates" key="templates-8" data-name="Template Eight">
                                <div class="cbBlk">
                                    <img src="{{ url('themes/default/webforms/8/thumbnail.jpg')}}" class="" >
                                    <div class="viewImage" data-image="{{ url('themes/default/webforms/8/thumbnail.jpg')}}">
                                        <i class="fas fa-search" data-image="{{ url('themes/default/webforms/8/thumbnail.jpg')}}"></i>
                                    </div>
                                    <div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="8" data-name="Template Eight">Use This</button></div>
                                    <div class="template-data">
                                        <div class="tmp-name badge badge-success">Template Eight</div>
                                    </div>
                                </div>
                            </div>-->

						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

				


@endsection