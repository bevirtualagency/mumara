<?php 

$thumb = "/public/img/thumb.jpg";
	if(!empty($application_settings["thumb"])) { 
$thumb = "/storage/branding/" . $application_settings["thumb"];

	}
 ?>
<div class="kt-page-loader kt-page-loader--logo" style="display: none;" data-name="TkAFnTIS">
			<img alt="Logo" src="{{$thumb}}" height="100px">
			<div class="kt-spinner kt-spinner--success" data-name="tOVWkpgT"></div>
		</div>