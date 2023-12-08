@extends('layouts.master2')
@section('title',  $pageTitle)
@section('page_styles')
<link href="/resources/assets/css/add-campaign.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script>
function chooseBuilder(type){
var template_id =localStorage.getItem('template_id') ? localStorage.getItem('template_id'): 'blank';
 jQuery.ajax({
      type: "POST",
      data:{type:type,template_id:template_id},
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
      url: "<?php echo route("broadcasts.useTemplate"); ?>",
      success: function(data) {

        if(data.success==1){
        	window.location.href=data.url;
        }else{
        	 toastr.error(data.message);
        }
      }
    });
	}
</script>
@endsection


@section('content')

<div class="row" data-name="XRJbmQpR">
	<div class="col-md-12" data-name="ItduIFrI">
		<div class="kt-portlet kt-portlet--height-fluid" data-name="FzZgTwbr">
			<div class="kt-portlet__head" data-name="Mjzkarfl">
				<div class="kt-portlet__head-label" data-name="BewTMAzN">
					<h3 class="kt-portlet__head-title">{{ trans('broadcasts.add_new.option_title') }}</h3>
				</div>
			</div>
			<div class="kt-portlet__body p-0 overflow-x-hidden" data-name="trCCRwYv">
				<div class="row align-items-center" data-name="ekhKyuOs">

					<!-- HTML editor -->
					<div class="col col-first" data-name="gbiBHyTG">
						<div class="slEditorBlk start" data-name="tGJvVIwY">
							<div class="edtImgBlk" data-name="QfUIMbsC">
								<a href="javascript:;" data-url='{{ route('broadcasts.create',1) }}' onclick="chooseBuilder(1);">
									<img src="/public/img/editor.jpg" alt="Select Editor">
								</a>
							</div>
							<div class="slEditorCont" data-name="tCRHGfcA">
								<h2>{{trans('broadcasts.add_blade.editor_heading')}}</h2>
								<h1>{{trans('broadcasts.add_blade.html_editor_heading')}}</h1>
								<button type="button" class="btn btn-success"  data-url="{{ route('broadcasts.create',1) }}" onclick="chooseBuilder(1);">{{trans('broadcasts.add_blade.html_editor_button')}}</button>
							</div>
						</div>
					</div>
					<!-- HTML editor -->
					@php
					$is_builder_addon_active=\DB::table('addons')->where('name','Builder')->where('status',"active")->first();
					@endphp
					<!-- Drag & Drop -->
					@if(((isActiveAddon('Drag & Drop Email Builder') || isActiveAddon('Drag &amp; Drop Email Builder')) || $is_builder_addon_active) && routeAccess('drag_and_drop_builder'))
					<div class="col col-middle" data-name="ouMZcJWj">
						<div class="slEditorBlk middle" data-name="IzQhVuqk">
							<div class="edtImgBlk" data-name="zOOeSsfD">
								<a href="javascript:;" data-url='{{ route('broadcasts.create',2) }}' onclick="chooseBuilder(2);">
									<img src="/public/img/builder.jpg" alt="Select Builder">
								</a>
							</div>
							<div class="slEditorCont" data-name="SFHqDZQt">
								<h2>{{trans('broadcasts.add_blade.builder_heading')}}</h2>
								<h1>{{trans('broadcasts.add_blade.drag_drop_heading')}}</h1>
								<button type="button" class="btn btn-success builder-type" data-url='{{ route('broadcasts.create',2) }}' onclick="chooseBuilder(2);">{{trans('broadcasts.add_blade.use_builder_button')}}</button>
							</div>
						</div>
					</div>
					@endif
					<!-- Drag & Drop -->

					<!-- Import from a url -->
					<!-- <div class="col col-last">
						<div class="slEditorBlk last">
							<div class="edtImgBlk">
								<a href="{{ route('broadcasts.create',3) }}">
									<img src="/public/img/url.jpg" alt="URL to Import Template">
								</a>
							</div>
							<div class="slEditorCont">
								<h2>Import</h2>
								<h1>Import From a URL</h1>
								<a href="{{ route('broadcasts.create',3) }}">
									<button type="button" class="btn btn-success">Import Template</button>
								</a>
							</div>
						</div>
					</div> -->
					<!-- Import from a url -->

				</div>
			</div>
		</div>	
	</div>
</div>

@endsection