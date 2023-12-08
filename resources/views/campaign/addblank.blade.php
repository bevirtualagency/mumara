@extends(decide_template())
@section('title',  $pageTitle)
@section('page_styles')
<link href="/resources/assets/css/add-campaign.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script>
	var count=0;
function chooseBuilder(type){
	count++
	if(count>1)
		return;
var template_id=window.localStorage.getItem('template_id');
 jQuery.ajax({
      type: "POST",
      data:{type:type,template_id:template_id},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
      url: "<?php echo route("broadcasts.useTemplate"); ?>",
      beforeSend: function(data) {
      	$(".blockUI").show();
      },
      success: function(data) {
      	$(".blockUI").hide();
        if(data.success==1){
        	window.location.href=data.url;
        }else{
        	 count=0;
        	 toastr.error(data.message);
        }
      }
    });
	}
</script>
@endsection


@section(decide_content())

<div class="row">
	<div class="col-md-12">
		<div class="kt-portlet kt-portlet--height-fluid">
			<div class="kt-portlet__head">
				<div class="kt-portlet__head-label">
					<h3 class="kt-portlet__head-title">{{ trans('broadcasts.add_new.option_title') }}</h3>
				</div>
			</div>
			<div class="kt-portlet__body p-0 overflow-x-hidden">
				<div class="row align-items-center">

					<!-- HTML editor -->
					<div class="col col-first">
						<div class="slEditorBlk start">
							<div class="edtImgBlk">
								<img src="/public/img/editor.jpg" class="text-link" alt="Select Editor" onclick="chooseBuilder(1);">
							</div>
							<div class="slEditorCont">
								<h2>@lang('broadcasts.templates.Editor')</h2>
								<h1>@lang('broadcasts.templates.HTML_Editor')</h1>
								<button type="button" class="btn btn-success" onclick="chooseBuilder(1);">@lang('broadcasts.templates.Use_HTML_Editor')</button>
							</div>
						</div>
					</div>
					<!-- HTML editor -->
					@php
					$is_builder_addon_active=\DB::table('addons')->where('name','Builder')->where('status',"active")->first();
					@endphp
					<!-- Drag & Drop -->
					@if(((isActiveAddon('Drag & Drop Email Builder') || isActiveAddon('Drag &amp; Drop Email Builder')) || $is_builder_addon_active) && routeAccess('drag_and_drop_builder'))
					<div class="col col-middle">
						<div class="slEditorBlk middle">
							<div class="edtImgBlk">
								<img src="/public/img/builder.jpg" class="text-link" alt="Select Builder" onclick="chooseBuilder({{$builder_id}});">
							</div>
							<div class="slEditorCont">
								<h2>@lang('broadcasts.templates.Builder')</h2>
								<h1>@lang('broadcasts.templates.Drag_Drop_Builder')</h1>
								<button type="button" class="btn btn-success" onclick="chooseBuilder({{$builder_id}});">@lang('broadcasts.templates.Use_Builder')</button>
							</div>
						</div>
					</div>
					@endif
					<!-- Drag & Drop -->
				</div>
			</div>
		</div>	
	</div>
</div>

@endsection