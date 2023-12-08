<?php 

$logo_name = "/public/img/logo.png";
	if(!empty($app_settings["logo"])) { 
$logo_name = "/storage/branding/" . $app_settings["logo"];

	}
 ?>
<div id="kt_header_mobile" class="kt-header-mobile" data-name="pZfNOSBb">
			<div class="kt-header-mobile__logo" data-name="CryByfIQ">
				<a href="{{ url('/') }}">
					<img alt="Logo" src="{{$logo_name}}" height="38px" />
				</a>
			</div>
			<div class="kt-header-mobile__toolbar" data-name="ffQllbrH">
				<button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
				<button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
			</div>
		</div>