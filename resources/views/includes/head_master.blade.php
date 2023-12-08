@php
// Hook is adding css or other head data
try {
    echo hook_get_output('HeadTop',$vars);
} catch (\Exception $e) {
    \Log::error($e->getMessage());
}

    $title = isset($app_settings['title']) && !empty($app_settings['title']) ? $app_settings['title'] : 'Mumara';
	if(!empty(Auth::user()->branding)) { 
		$branding = json_decode(Auth::user()->branding);
		if(!empty($branding->branding_img)) $title = $branding->branding_title;
	}

@endphp
<meta charset="UTF-8">
<title>@yield('title') - {{$title}}</title>