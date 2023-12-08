@extends(decide_template())
@section('title',  $pageTitle)
@section('page_styles')
<link href="/resources/assets/css/template-campaign.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
.cbBlk .cbMenuBlk {
    top: 30%;
}
.short-desc {
    position: absolute;
    bottom: 76px;
    height: auto;
    padding: 10px;
    background: rgba(0,0,0, 0.5);
    color: #FFF;
    font-size: 12px;
    left: 0;
    right: 0;
    opacity: 0;
    transition: 1s ease all;
}  
.cbBlk:hover .viewImage {
    margin-top: -10px;
}  
.cbBlk:hover .short-desc {
    opacity: 1;
    transition: 1s ease all;
}
button#loadmore {
    display: block;
    margin: 50px auto;
}
button#loadmore {
    display: block;
    margin: 50px auto;
}
.height-50 {
    min-height: 50px;
    position: relative;
    margin-top: 50px;
}
.loadmore {
    position: absolute;
    top: 0;
    left: 50%;
    z-index: 2;
    display: inline-block;
    -webkit-transform: translate(0, -50%);
    transform: translate(0, -50%);
    color: #111;
    font: normal 400 14px/1 'Poppins', sans-serif;
    letter-spacing: .1em;
    text-decoration: none;
    transition: opacity .3s;
    padding-top: 60px;
    margin-left: -38px;
    font-size: 16px;
    font-weight: 400;
}
.loadmore span {
    position: absolute;
    top: 0;
    left: 50%;
    width: 20px;
    height: 20px;
    margin-left: -10px;
    border-left: 1px solid #333;
    border-bottom: 1px solid #333;
    -webkit-transform: rotate(-45deg);
    transform: rotate(-45deg);
    -webkit-animation: sdb07 2s infinite;
    animation: sdb05 2s infinite;
    opacity: 0;
    box-sizing: border-box;
}
.loadmore span:nth-of-type(1), .loadmore-container .lm span:nth-of-type(1) {
    -webkit-animation-delay: 0s;
    animation-delay: 0s;
}
.loadmore-container .lm span {
    color: #a1a5b7;
    font-size: 20px;
    line-height: 1;
    margin-left: 1px;
    -webkit-animation: sdb07 2s infinite;
    animation: sdb07 2s infinite;
    top: 0 !important;
}
.end-timeline {
    position: relative;
    width: 220px;
    margin: 0 auto;
    font-size: 16px;
    font-weight: 500;
    display: none;
}
.btemplates {
    position: absolute;
    right: 25px;
    top: 25px;
}
@-webkit-keyframes sdb05 {
    0% {
      -webkit-transform: rotate(-45deg) translate(0, 0);
      opacity: 0;
    }
    50% {
      opacity: 1;
    }
    100% {
      -webkit-transform: rotate(-45deg) translate(-20px, 20px);
      opacity: 0;
    }
}
@keyframes sdb05 {
    0% {
      transform: rotate(-45deg) translate(0, 0);
      opacity: 0;
    }
    50% {
      opacity: 1;
    }
    100% {
      transform: rotate(-45deg) translate(-20px, 20px);
      opacity: 0;
    }
}
@keyframes sdb07 {
    0% {
        opacity: 0;
    }
    50% {
        opacity: 1;
    }
    100% {
        opacity: 0;
    }
}
.goback {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    font-weight: 500;
    cursor: pointer;
    top: 24px;
}
.goback:hover {
    color: #1caf9a;
}
.btn-label-grey {
    font-weight: 600;
}
.disabled_button{
	cursor: not-allowed !important;
	pointer-events: none !important;
}
.cbBlk .cbMenuBlk button.disabled_button {
    margin-left: -18px;
    padding: 8px 13px;
}
label.kt-checkbox {
    padding-left: 30px !important;
    margin: 0 !important;
}
.kt-checkbox-inline {
    display: block;
    padding-top: 12px;
}
img.no-templates {
    cursor: not-allowed;
}
.fa-expeditedssl:before {
    content: "\f23e";
}
.fa-shield-alt:before {
    content: "\f3ed";
}
#not-allowed-popup .iconBlk {
    display: block;
    text-align: center;
    font-size: 80px;
    line-height: 1;
    color: #888;
    margin: 0px auto 20px;
}
#not-allowed-popup p {
    margin-top: 10px;
    font-size: 14px;
    color: #333;
    margin-bottom: 20px;
}
#not-allowed-popup .modal-body {
    padding: 40px;
}
.fa-long-arrow-alt-left:before {
    content: "\f30a";
}
.action-back a:hover {
    color: #2c50c7 !important;
}
.action-back a i {
    transition: 1s ease all;
}
.action-back a:hover i {
    display: inline-block;
    margin-left: -5px;
    transition: 1s ease all;
    margin-right: 5px;
}
.fa-eye:before {
    content: "\f06e";
}
</style>
@endsection
@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
@if($access)
<script>

	$(document).ready(function() {

		$("body").click(function(){
			$(".popupImgBlk").fadeOut().removeClass("show");
		})
		
        $("#back").click(function (){
            window.location.href = "/broadcast/templates";
        });
		
		var t=<?php echo $templates;?>;
		var filter=0;
		var page=1;
        var size= 12;
        var total= 0;
        var category= [];
		function loadMarketePlaceTemplates(page=1,size=4,filter=0){
            $(".blockUI").show();
               $.ajax({	
                url: "{{ route('loadMarketePlaceTemplates') }}",
                type: "GET",
                async:true,
                success:function(resp){
                	if(resp.success==1){
                	var data="["+(resp.data.substring(0, resp.data.length - 1))+"]";
                	var resp = JSON.parse(data) || [];

                	    if($('#filter option').length < 2)
                	     for (var i = 0; i < resp.length; i++) {
                	     	var row=resp[i];
                	     	category.push(row['category']);
                	     }
                	     if(filter==0){
                	     	total=resp.length;
	                		resp=resp.slice((page - 1) * size, page * size);
	                	}
                		else
                		$('#all-templates').empty();
                		var found=0;
                	    for (var i = 0; i < resp.length; i++) {
                	      var row=resp[i];
                	      if(jQuery.inArray(row['template_id'], t) !== -1){
                	       var title="Already Installed";
                	       var id='';
                	       var folder_name='';
                	       var pclass='disabled_button';
                	       var button='btn-label-grey';
                	       var label='<span class="badge badge-grey pull-right">Installed</span>';
                	       var i_template='installed-template';
                	  	  }else{
                	  	   var title="Install";
                	       var id=row['template_id'];
                	       var folder_name=row['folder_name'];
                	       var pclass='choose-template';
                	       var button='btn-primary';
                	       var label='';
                	       var i_template='';
                	  	  }
                	  	  var thumb=row['thumbnail'];

                	  	  var name=row['name'] ? row['name'].toLowerCase():'';
                	  	  var tags=row['tags'] ? row['tags'].join().toLowerCase():'';
                	  	  var desc=row['description'] ? row['description'].toLowerCase():'';
                	  	  var keywords=row['keywords'] ? row['keywords'].toLowerCase():'';
                	  	  var c=row['category'] ? row['category'].toLowerCase():'';
                	  	  var short_desc=row['short_description'] ? row['short_description'].toLowerCase():'';
                	  	

                	      var val =$('#filter').val().toLowerCase();
						  var q =$('#search').val().toLowerCase();
						  if(val=="all" && q){
							var conditions= name.indexOf(q) > -1 || tags.indexOf(q) > -1 || desc.indexOf(q) > -1 || keywords.indexOf(q) > -1 || short_desc.indexOf(q) > -1;
						  }else if(val!="all" && q){
					      	var conditions=c.indexOf(val) > -1 && (name.indexOf(q) > -1 || tags.indexOf(q) > -1 || desc.indexOf(q) > -1 || keywords.indexOf(q) > -1 || short_desc.indexOf(q) > -1);
						  }else if(val!="all" && !q){
					      	var conditions=c.indexOf(val) > -1
						  }else{
						  	var conditions=true;
						  }
						  if(!conditions)
					        	continue;
					      var isChecked = $('#hide').is(':checked');
                	      var hideIinstalled=(isChecked && i_template=="installed-template") ? true:false;
                	      if(hideIinstalled)
                	      	continue;

                	       var html = `<div class="col-md-3 timeline-item custom-templates ${i_template}"  data-category="${c}" data-name="${name}" data-desc="${desc}" data-short-desc="${short_desc}" data-tags="${tags}" data-keywords="${keywords}">
							<div class="cbBlk">
								<img src="${thumb}" class="" >
								<div class="viewImage" data-image="${thumb}"><i class="fas fa-eye" data-image="${thumb}'"></i></div>
								<div class="cbMenuBlk"><button class="btn ${button} btn-new ${pclass}" data-name="${folder_name}" data-id="${id}" data-version="${row['version']}">${title}</button></div>
			                    <div class="short-desc">'${short_desc}</div>
								<div class="template-data">
									<div class="tmp-name">${name}</div>
									<span class="badge badge-success">${c}</span>
									${label}
								</div>
							</div>
						</div>`;
						found++;
						$('#all-templates').append(html);
                	    }
                	    if(found==0){
                	    	var html=`<div class="alert alert-warning col-12">
							            <div class="content" data-name="sazlRgtd">
							                <span>No record found.</span>
							            </div>
							        </div>`;
							$('#all-templates').html(html);
							$('.loadmore-container').hide();
                	    }

                	    if(filter==1)
                	    total=found;
                	    if($('#filter option').length < 2){
                	    	var uniq = category.reduce(function(a,b){
					    if (a.indexOf(b) < 0 ) a.push(b);
					    return a;
					  },[]);
                	    uniq.sort();
                	    $('#filter option').not('option:eq(0)').remove();
                	    for (var j = 0; j < uniq.length; j++) {
                	    	var item=uniq[j];
                	        $('#filter').append(`<option value="${item}">${item}</option>`);
                	    }
                	    }
                	    
                	 }
                	    
    				
                },
                complete: function(xhr, textStatus) {
			      // console.log(resp)
                    $(".blockUI").hide();
			    },
                error:function(){
                    $(".blockUI").hide();
                },
            });  
    	}


		var scroll_enabled = true;

		function load_ajax() {
			filter = 0;
			scroll_enabled = true;
			loadMarketePlaceTemplates(page,size,filter);
			page++;
		}
		load_ajax();

		$(window).bind('scroll', function() {
			if(filter==1)
				return;
			if (scroll_enabled) {
				
				if(($(window).scrollTop() + $(window).height()+2) >= $(document).height()) {
					scroll_enabled = false;  
					$(".blockUI").show();
					if((page * size) <= (total+size)) { // && filter==0
							load_ajax();
					} else {
						setTimeout(() => {
							$(".blockUI").hide();
							$(".loadmore-container").hide();
							$(".end-timeline").show();
						}, 1000);
					}
				}
			}
		});

       $(document).on("change","#filter,#search,#hide", function() {
          	$('#all-templates').empty();
			var val =$('#filter').val().toLowerCase();
			var q =$('#search').val().toLowerCase();
			var isChecked = $('#hide').is(':checked');
			if(val !="all" || q || isChecked){
				$(".loadmore-container").hide();
				$(".end-timeline").show();
				filter=1;
				page=1;
				loadMarketePlaceTemplates(page,size,filter);
			}else{
				$(".loadmore-container").show();
				$(".end-timeline").hide();
				filter=0;
				load_ajax();
			}	
		});
		
		$(document).on('click',".choose-template",function() {
			var $this=$(this);
			$this.prop("disabled",true);
			var name =$this.attr("data-name");
			var id =$this.attr("data-id");
			var version =$this.attr("data-version");
			if(!id || id=="undefined"){
				Command: toastr["error"] ("{{trans('templates.marketplace_blade.template_id_blank_command')}}");
				return;
			}


			$(".blockUI").show();
			setTimeout(function(){
			$.ajax({
                url: "{{ route('installTemplate') }}",
                type: "GET",
                data:{name:name,_token:"{{ csrf_token() }}",version:version},
                success:function(resp){
                	$(".blockUI").hide();
                	if(resp.success==1){
                		$(".blockUI").show();
                		setTimeout(function(){
			            $.ajax({
			                url: "{{ route('uploadTemplate')}}",
			                type: "POST",
			              	data: {template:name,id:id,_token:"{{ csrf_token() }}"},
			                success:function(resp){
			                    $(".blockUI").hide();
			                    if(resp.success==1){
			                    	Command: toastr["success"] (resp.message);
			                    	$this.removeClass('choose-template');
			                    	$this.addClass('disabled_button');
			                    	$this.parents('.custom-templates').addClass('installed-template');
			                    	$this.text("{{trans('templates.marketplace_blade.already_installedtext')}}");
			                    }else{
			                        Command: toastr["error"] (resp.message);	
			                        $this.prop("disabled",false);
			                    }
			                	
			                },
			                complete: function(xhr, textStatus) {
						        // console.log(xhr.status);
						    },
			                error:function(){
			                    $(".blockUI").hide();
			                },
			            });
			           },3000);
                	}else{
                		 Command: toastr["error"] (resp.message);
                		 $this.prop("disabled",false);	
                	}
                },
                error:function(resp){
                	$(".blockUI").hide();
                }
                });	
			},3000);
			
            
		});
	
		$(document).on('click',"#close-popup",function() {
			$(".popupImgBlk").removeClass("show").addClass("hide");
		});
		$(document).on('click',".viewImage",function() {
			var image =$(this).attr("data-image");
			$("#tempImg").attr("src", image)
			$(".blockUI").show();
			setTimeout(() => {
				$(".popupImgBlk").removeClass("hide").addClass("show");
				$(".blockUI").hide();
			}, 500);
		});
		

		$("#not-allowed-popup").modal("show");
	});
	
</script>
@endif

@if(!$access && $user->role_id==1)
<script>
	$(document).ready(function() {
		$("#not-allowed-popup").modal("show");
	});
</script>
@endif

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
						@if(!$access && $user->role_id==1)
						<div class="form-group col-md-12">
							<a href="/broadcast/templates/" class="btn btn-label-grey pull-right">{{trans('templates.marketplace_blade.back_templates_action')}} </a>
							<img src="/public/img/no_templates.jpg" class="img-responsive no-templates" />
						</div>
						@endif
						@if($access)
						<div class="filter-section row">
							<div class="form-group col-md-3">
								<label class="control-label">@lang('broadcasts.templates.Select_Category')</label>
								<select id="filter" class="form-control m-select2" placeholder="Select Category">
									<option value="all">@lang('broadcasts.templates.All_Categories')</option>
									
								</select>
							</div>
							<div class="form-group col-md-3">
								<label class="control-label">@lang('broadcasts.templates.Search_Template')</label>
								<input type="text" name="search" id="search" placeholder="@lang('broadcasts.templates.Search_Template')" class="form-control" />
							</div>
							<div class="form-group col-md-3">
								<label class="control-label"></label>
								<div class="kt-checkbox-inline">
									<label class="kt-checkbox">
										<input type="checkbox" id="hide">@lang('broadcasts.templates.hide_installed')<span></span>
										 {!! popover( 'broadcasts.templates.hide_installed_description','common.description' ) !!}
									</label>
								</div>
							</div>
                            <div class="form-group col-md-3">
                                <a href="/broadcast/templates/" class="btn btn-label-grey pull-right">{{trans('templates.marketplace_blade.back_templates_action')}}</a>
                            </div>
						</div>

						<div class="row align-items-center timeline" id="all-templates">
							
						</div>

                        <div class="timeline-item height-50 loadmore-container" id="load_1">
                            <div class="loadmore"><span></span> {{trans('templates.marketplace_blade.span_scroll')}}</div>
                        </div>
                        <div class="end-timeline fs-4 fw-semibold pt-2 text-center">- {{trans('templates.marketplace_blade.end_templates_div')}} -</div>
						@endif	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@if(!$access && $user->role_id==1)
<div class="modal fade" id="not-allowed-popup" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
				<a href="/broadcast/templates/" class="btn btn-label-grey pull-right btemplates">{{trans('templates.marketplace_blade.back_templates_action')}}</a>
				<div class="iconBlk"><i class="fab fa-expeditedssl"></i><i class="fa fa-shield-alt kt-hide"></i></div>
				<div class="instal-ssl-desc">
					<h4 class="modal-title">{{trans('templates.marketplace_blade.commercial_feature_heading')}} </h4>
					<p>{{trans('templates.marketplace_blade.feature_not_supported_para')}} </p>
				</div>
				<a href="https://billing.mumara.com/clientarea.php" target="_blank"><button type="button" class="btn btn-primary btn-sm" id="btn-install">{{trans('templates.marketplace_blade.upgrade_license_button')}}</button></a>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
