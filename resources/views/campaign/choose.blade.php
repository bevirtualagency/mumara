@extends(decide_template())
@section('title',  $pageTitle)
@section('page_styles')
<link href="/resources/assets/css/template-campaign.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
.vt {
    padding: 5px 10px;
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    min-width: 60px;
    margin-top: 8px;
}
</style>
@endsection
<?php
$categories=[];
$html='';
$htmlblank = '<div class="col-md-3" key="templates-0" id="blank-template">
				<div class="cbBlk blank">
					<div class="blankImage"><i class="flaticon2-browser-2"></i></div>
					<div class="cbMenuBlk"><button id="open_blank" class="btn btn-primary" data-id="0" data-name="Blank" >'.trans('broadcasts.templates.Blank_Template').'</button></div>
					<div class="template-data">
						<div class="tmp-name">'.trans('broadcasts.templates.Blank_Template').'</div>
						<span class="badge badge-info">'.trans('broadcasts.templates.Blank').'</span>
					</div>
				</div>
			</div>';
			//  $is_builder_addon_active=\DB::table('addons')->where('name','Builder')->where('status',"active")->first();
	  //       if($is_builder_addon_active){
			// 	$configs= rglob(base_path("/Addons/Builder/Editor/templates/custom/*.json"));
			// }else{
			// 	$configs= rglob(base_path("/public/editor/templates/main/templates/*.json"));
			// }
			$configs=getTemplates(true);
            foreach($configs as $row){
            // $row=json_decode(file_get_contents($config),true);
          $flag= (auth()->user()->role_id !=1 && auth()->id() != $row['user_id']) ? '<span class="badge badge-grey pull-right">Assigned by Admin</span>':'';

            if(!empty($row) && $row['status']==1){
            $categories[]=$row['category'];
				$html .= '<div class="col-md-3 '.$row['id'].' custom-templates" key="templates-'.$row['id'].'" data-name="'.$row['name'].'" data-category="'.$row['category'].'" data-tags="'.implode(',',(!empty($row['tags']) && is_array($row['tags'])  ? $row['tags']:[])).'" data-keywords="'.(!empty($row['keywords']) ? $row['keywords']:'').'" data-desc="'.$row['description'].'" data-short-desc="'.$row['short_description'].'">
				<div class="cbBlk">
					<img src="'.$row['thumbnail'].'" class="" >
					<div class="viewImage" data-image="'.$row['thumbnail'].'"><i class="fas fa-eye" data-image="'.$row['thumbnail'].'"></i></div>
					<div class="cbMenuBlk"><button class="btn btn-primary btn-new choose-template" data-id="'.$row['id'].'" data-name="'.$row['name'].'">Use This</button></div>
					<div class="template-data">
						<div class="tmp-name">'.$row['name'].'</div>
						<span class="badge badge-success">'.$row['category'].'</span>
						'.$flag.'
						<!-- <span class="reviews">(5) <i class="fa fa-star"></i></span> -->
					</div>
				</div>
			</div>';
		  }
	    }
	    $categories=array_unique($categories);
	    sort($categories);

?>
@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script>

	

	$(document).ready(function() {

		$("body").click(function(){
			$(".popupImgBlk").fadeOut().removeClass("show");
		})
		
		$("#open_blank,.choose-template").click(function() {
			var id =$(this).attr("data-id");
			window.localStorage.setItem('template_id', (id !='0' ? id :"blank"));
			window.location = "{{route('broadcasts.addblank')}}";
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
			console.log(image);
		});

		$(".m-select2").select2();

		$(document).on("change","#filter,#search", function() {
			var val =$('#filter').val().toLowerCase();
			var q =$('#search').val().toLowerCase();
			if(val=="all" && !q){
				$(document).find('.custom-templates').css("display","flex");
			}else if(val=="all" && q){
				$(document).find('.custom-templates').each(function() {
		      	var name=$(this).data('name').toLowerCase();
		      	var tags=$(this).data('tags').toLowerCase();
		      	var desc=$(this).data('desc').toLowerCase();
		      	var keywords=$(this).data('keywords').toLowerCase();
		      	var short_desc=$(this).data('short-desc').toLowerCase();
		      	var conditions= name.indexOf(q) > -1 || tags.indexOf(q) > -1 || desc.indexOf(q) > -1 || keywords.indexOf(q) > -1 || short_desc.indexOf(q) > -1;
		        if(conditions){
		        	$(this).css("display","flex");
		        }else{
		        	$(this).css("display","none");
		        }

		      });
			}else if(val!="all" && q){
				$(document).find('.custom-templates').each(function() {
		      	var name=$(this).data('name').toLowerCase();
		      	var tags=$(this).data('tags').toLowerCase();
		      	var desc=$(this).data('desc').toLowerCase();
		      	var keywords=$(this).data('keywords').toLowerCase();
		      	var short_desc=$(this).data('short-desc').toLowerCase();
		      	var category=$(this).data('category').toLowerCase();
		      	var conditions=category.indexOf(val) > -1 && (name.indexOf(q) > -1 || tags.indexOf(q) > -1 || desc.indexOf(q) > -1 || keywords.indexOf(q) > -1 || short_desc.indexOf(q) > -1);
		        if(conditions){
		        	$(this).css("display","flex");
		        }else{
		        	$(this).css("display","none");
		        }
		      });
			}else if(val!="all" && !q){
				$(document).find('.custom-templates').each(function() {
		      	var name=$(this).data('name').toLowerCase();
		      	var category=$(this).data('category').toLowerCase();
		      	var desc=$(this).data('desc').toLowerCase();
		      	var conditions=category.indexOf(val) > -1
		        if(conditions){
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


@section(decide_content())

<div class="popupImgBlk hide">
	<div class="flaticon2-cross text-link" id="close-popup"></div>
	<div class="pic scroll">
		<img id="tempImg" src="/public/img/empty.png" >
	</div>
</div>

<div id="no-template">
	<div class="row">
		<div class="col-md-12">
			<div class="no-template-block">
				<div class="no-template">
					<i class="flaticon2-browser-2"></i>
					<span class="no-temp-content">@lang('broadcasts.templates.No_Template_Added')</span>
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
								<label class="control-label">@lang('broadcasts.templates.Select_Category')</label>
								<select id="filter" class="form-control m-select2" placeholder="Select Category">
									<option value="All">@lang('broadcasts.templates.All_Categories')</option>
									@foreach($categories as $category)
									<option value="{{ $category }}">{{ $category }}</option>
									@endforeach
								</select>
							</div>
							<div class="form-group col-md-3">
								<label class="control-label">@lang('broadcasts.templates.Search_Template')</label>
								<input type="text" name="search" id="search" placeholder="@lang('broadcasts.templates.Search_Template')" class="form-control" />
							</div>
							<div class="form-group col-md-6 pul-right">
								<label class="control-label col-md-12"></label>
								<a href="/broadcast/templates" class="btn btn-label-info pull-right vt" style="">View Templates</a>
							</div>
						</div>

						<div class="row align-items-center" id="all-templates">
							{!! $htmlblank.$html !!}
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>

				


@endsection