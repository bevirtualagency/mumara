<?php
	$thumb = url("/public/img/thumb.jpg");
	if(isset($app_settings["thumb"]) && !empty($app_settings["thumb"])) {
		$thumb = url("storage/branding/" . $app_settings["thumb"]);
	}
	$hide_footer_disclaimer = true;
	if(!empty(Auth::user()->branding)) { 
		$branding = json_decode(Auth::user()->branding);
		if(!empty($branding->hide_footer_disclaimer)) $hide_footer_disclaimer = false;
		if(!empty($branding->preloader_image)) $thumb = asset($branding->preloader_image);
		
	}

?>

<div class="kt-footer kt-grid__item kt-grid kt-grid--desktop kt-grid--ver-desktop" data-name="OUujlojk">
	<div class="kt-footer__logo" data-name="VHJFFIPl">
		<a href="{{ url('/') }}">
			<img alt="Logo" src="{{$thumb}}" height="27px">
		</a>
		&nbsp;&nbsp;
		@if($hide_footer_disclaimer)
		<div class="kt-footer__copyright" data-name="BVVAwIte">
			{{ date('Y') }}&nbsp;&copy;&nbsp;{{isset($app_settings['copyright']) && !empty($app_settings['copyright']) ? $app_settings['copyright'] : 'Mumara LLC' }}
		</div>
		@endif
	</div>
	<div class="kt-footer__menu" data-name="OqVsWyqL">
		{{trans('common.header.version')}} <i class="fa fa-bolt fa-fw"></i> {{$local_version}}
	</div>
</div>
