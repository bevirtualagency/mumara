@php
// Hook is adding css or other head data
try {
    echo hook_get_output('HeadTop',$vars);
} catch (\Exception $e) {
    \Log::error($e->getMessage());
}


if(!empty(Auth::user()->branding)) { 
    $branding = json_decode(Auth::user()->branding);
    if(!empty($branding->branding_title)) $updated_title = $branding->branding_title;
}


@endphp
<meta charset="UTF-8">
@if(!empty($updated_title))
<title>{{$updated_title}}</title>
@else 
<title>@yield('title') - {{isset($app_settings['title']) && !empty($app_settings['title']) ? $app_settings['title'] : 'Mumara' }}</title>
@endif