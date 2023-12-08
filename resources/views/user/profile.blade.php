@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/profile.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
    label.cancel-upload {
        display: inline-block;
        width: 26px;
        height: 26px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #FFFFFF;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 12%);
        cursor: pointer;
        transition: all 0.2s ease-in-out;
        position: absolute;
        bottom: -10px;
        right: 4px;
    }
    label.cancel-upload i {
        color: #a5a5a5;
        position: absolute;
        top: 0;
        left: 0;
        margin: auto;
        text-align: center;
        width: 24px;
        line-height: 27px;
    }
    label.cancel-upload:hover i {
        color: #333;
    }
    label.cancel-upload:hover {
        background: #ffffff;
        border-color: #e9e6e6;
    }
    .kt-checkbox-list.pl12 {
        padding-top: 8px;
    }
    .kt-portlet .kt-portlet.kt-portlet--bordered .kt-portlet__foot {
        padding: 20px 20px!important;
        margin-top: 0;
    }
    .kt-portlet__body.p-0 {
        padding:0
    }
    .dmnTitle h2 {
        margin-top: 10px!important;
        margin-bottom: 10px!important;
        font-size: 16px!important;
        font-weight: 500!important;
    }
    button.btn-chk {
        height: 38px;
        min-width: 12px!important;
        width: 38px;
        font-size: 16px;
        margin-right: 10px;
        padding: 0;
        text-align: center;
    }
    button.btn-chk i {
        font-size: 1.3rem !important;
    }
    .btn:not(.btn-sm):not(.btn-lg) {
        vertical-align: bottom;
    }
    .contentBlk {
        margin-top: 25px;
        margin-bottom: 25px;
    }
    .contentBlk1 h2 {
        margin-top: 10px;
        margin-bottom: 10px;
        font-size: 16px;
        font-weight: 600;
    }
    .table {
        border: 1px solid #e7ecf1!important;
        border-top: 0!important;
    }
    .table td, .table th {
        padding: 10px;
        vertical-align: middle;
        border-top: 1px solid #ebedf2;
    }
    .fileinput {
        margin: 0 auto;
        max-width: 250px;
        position:relative;
    }
    .fileinput .thumbnail {
        display: inline-block;
        margin-bottom: 5px;
        overflow: hidden;
        text-align: center;
        vertical-align: middle;
    }
    .thumbnail {
        padding: 5px;
    }

    .fileinput .thumbnail>img {
        max-height: 40px;
        max-width: 100%;
    }
    .thumbnail img {
        border-radius: 0;
    }

    .fileinput-exists .fileinput-new, .fileinput-new .fileinput-exists {
        display: none;
    }

    .fileinput .thumbnail {
        width: 100%!important;
        height: 100px !important;
        margin-bottom: 0;
        border: 4px solid #eee !important;
        border-color: #eee;
        min-height: 100px;
        border-bottom: 0;
        background: #1b1e25;
        padding: 0;
        border-radius: 20px;
        line-height: 88px;
    }
    .bg-white {
        background: #FFF !important;
        color: #666;
    }
    .dimension {
        color: #979eaf;
        background: #1b1e25;
        display: block;
        position: relative;
        padding: 7px 0;
        text-align: center;
        font-size: 11px;
        font-weight: 500;
    }
    .files-btn {
        position: absolute;
        top: 0;
        right: 0;
        cursor: pointer;
        left: 0;
        bottom: 0;
    }
    .files-btn .btn.default:not(.btn-outline) {
        padding: 0;
        position: absolute;
        right: -10px;
        top: -5px;
    }
    .btn-file>input {
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100%;
        margin: 0;
        font-size: 23px;
        cursor: pointer;
        opacity: 0;
        direction: ltr;
    }
    .fileinput-preview.fileinput-exists img {
        max-height: 40px;
        margin-top: -10px;
    }
    .fileinput .thumbnail.bg-white+.thumbnail {
        background: #FFF !important;
    }
    input.uploadimage {
        position: absolute;
        width: calc(100% + 8px);
        height: 100px;
        z-index: 5;
        opacity: 0;
        cursor: pointer;
        left: 0;
        top: 0;
    }
    a.btn.red.fileinput-exists {
        position: absolute;
        z-index: 5;
    }
    span.fileinput-new {
        display: inline-block;
        width: 26px;
        height: 26px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #ffffff;
        border-color: #e9e6e6;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 12%);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
        line-height: 24px;
    }
    span.fileinput-exists {
        display: inline-block;
        width: 26px;
        height: 26px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #ffffff;
        border-color: #e9e6e6;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 12%);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
        line-height: 24px;
    }
    a.btn.red.fileinput-exists {
        position: absolute;
        z-index: 10;
        padding: 0;
        width: 26px;
        height: 26px;
        margin-bottom: 0;
        border-radius: 100%;
        background: #ffffff;
        border-color: #e9e6e6;
        border: 1px solid transparent;
        box-shadow: 0px 2px 4px 0px rgb(0 0 0 / 12%);
        cursor: pointer;
        font-weight: normal;
        transition: all 0.2s ease-in-out;
        line-height: 24px;
        bottom: 0;
        right: -9px;
        color: #a5a5a5 !important;
    }
    a.btn.red.fileinput-exists:hover {color: #333 !important;}
    .col-md-6.mb-5 {
        margin-bottom: 15px;
    }
    .default.btn-file i.fa {
        color: #a5a5a5 !important;
    }
    .fileinput:hover .default.btn-file i.fa {
        color: #333 !important;
    }
    .fileinput.banner .thumbnail {
        height: 200px !important;
        line-height: 191px;
    }
    .fileinput.banner .thumbnail>img {
        max-height: 180px;
        max-width: 100%;
    }
    h3.mini_heading {
        margin: 0;
        padding: 0;
        font-size: 17px;
        font-weight: 500;
        color: var(--kt-portlet__head-title-color);
        margin-top: 20px;
    }
    span.input-group-text i.fa-2x {
        font-size: 16px;
    }
</style>
@endsection

@section(decide_content())

<!-- END PAGE HEADER-->
@if($errors->any())
<!-- For PHP validations errors-->
<div class="alert alert-danger" data-name="aXaeRRAF">
    @foreach($errors->all() as $error)
    <p>{{ $error }}</p>
    @endforeach
</div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="fYbTqLqs">
    {{ Session::get('msg') }}
</div>

@endif
@if (Session::has('error'))
<div class="alert alert-danger" data-name="hmZHvQIt">
    <p>{{ Session::get('error') }}</p>
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="vqhKEXdr">
    <span id='msg-text'><span>
</div>
<?php
$setting = new \stdClass();
?>

<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="XsoOeiyX">
    <div class="row" data-name="BapuoDZD">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="prkSruuU">
            <div class="kt-portlet__body" data-name="VdCSpNWV">
                <div class="tabbable tabbable-tabdrop" data-name="YcCSXTyE">
                    <ul class="nav nav-tabs" role="tablist">
                        <?php 
                        $license_attributes = json_decode(getSetting('license_attributes'), true);
                        $license_type = '';
                        if (! empty($license_attributes['package'])) {
                            $license_type = trim($license_attributes['package']);
                        }

                        $tab = request()->get("t");
                        $profileTab = "";
                        $localeTab = "";
                        $brandingTab = "";
                        if(empty($tab) or $tab == "p") $profileTab = "active";
                        if($tab == "l") $localeTab = "active";
                        if($tab == "b") $brandingTab = "active";
                        ?>

                        <li class="nav-item">
                            <a href="#tab1" class="nav-link {{$profileTab}}" data-toggle="tab">
                                {{trans('users.profile.title')}}
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab2" class="nav-link {{$localeTab}}" data-toggle="tab">
                                {{trans('common.label.locale')}}
                            </a>
                        </li>
                       
                    

                        <?php 
                        $allowBranding = DB::table("users")->where("id" , Auth::user()->id)->value("allow_branding");
                        if($allowBranding == NULL) { 
                            $allowBranding = DB::table("packages")->where("id" , Auth::user()->package_id)->value("allow_branding");
                        }  
                        if($allowBranding == NULL) { 
                            $allow_user_branding = getSetting("allow_user_branding");
                            if( $allow_user_branding == "on") { 
                                $allowBranding = 1;
                            }
                        }  
                        
                        if($license_type == "Commercial ESP" && $allowBranding) { 

                        ?>
                        <li class="nav-item">
                            <a href="#tab3" class="nav-link {{$brandingTab}}" data-toggle="tab">
                                {{ trans('profile.branding.tab_label') }}
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <div class="tab-content" data-name="VotfZrsj">
                        <div class="tab-pane {{$profileTab}} AsXQAAOwn" id="tab1" data-name="PgJqlMMM">
                            <div class="col-md-12" data-name="AsXQAAOw">
                                <form action="{{ route('user.profile',  $user->id) }}" method="POST"
                                  enctype="multipart/form-data" id="profile-frm" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="profile">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="user-id" value="{{$user->id}}">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="kt-portlet__body" data-name="RPszXpdK">
                                        <div class="form-body" data-name="iyskiVEK">
                                            <div class="form-group row" data-name="XESSJOYs">
                                                <div class="col-md-12" data-name="YvXpotCP">
                                                    <label class="col-form-label">
                                                        {{trans('Update Avatar')}}
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input name="profile_img" type='file' id="imageUpload" id="profile_img" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload" class="uload-icon"><i class="fa fa-pencil-alt" ></i></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <?php 
                                                            if($gravatar_update_value=='on'){
                                                                 //if profile image not exists then check gravator 
                                                                $hashemail = md5(strtolower(trim($user->email)));
                                                                $url = 'https://www.gravatar.com/avatar/' . $hashemail . '?d=404';

                                                                $headers = @get_headers($url);
                                                                if ($headers === false || !preg_match("|200|", $headers[0])) {
                                                                    // Internet is not working or Gravatar image doesn't exist
                                                                    $has_valid = FALSE;
                                                                } else {
                                                                    // Gravatar image exists
                                                                    $has_valid = TRUE;
                                                                }
                                                            }
                                                           
                                                            ?>
                                                            @if ($user->profile_img_store)
                                                                <div id="imagePreview" style="background-image: url('{{ asset('/storage/' . $user->profile_img_store) }}');"></div>
                                                            @else
                                                                @if($gravatar_update_value=='on' && $user->profile_img_store=='' && $has_valid==1)
                                                                     <div id="imagePreview" style="background-image: url({{ $url }});"></div>
                                                                @else
                                                                <div id="imagePreview" style="background-image: url('/public/img/user.png');"></div>
                                                                @endif 

                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" data-name="XESSJOYs">
                                                <div class="col-md-6" data-name="YvXpotCP">
                                                    <label class="col-form-label">
                                                        {{trans('common.label.email_address')}}
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="email" name="email" value="{{isset($user->email) ? $user->email : '' }}" class="form-control" />
                                                </div>
                                                <div class="col-md-6" data-name="SLYNvvrO">
                                                    <label class="col-form-label">{{trans('common.label.name')}}
                                                        <span class="required"> * </span>
                                                    </label>
                                                    <input type="text" name="name" value="{{isset($user->name) ? $user->name : '' }}" class="form-control" />
                                                </div>
                                            </div>
                                            <!-- <div class="form-group row" data-name="NNYIaeeJ"> 
                                                <div class="col-md-6" data-name="PDyJpzXD">
                                                    <label class="col-form-label">{{trans('common.label.password')}}
                                                    </label>
                                                    <input type="password" name="password" id="password" value="" class="form-control" />
                                                </div>
                                                <div class="col-md-6" data-name="SVFAFwXa">
                                                    <label class="col-form-label">{{trans('common.label.confirm_password')}}
                                                    </label>
                                                    <input type="password" id="confirm_password" name="confirm_password" value="" class="form-control" />
                                                </div>
                                            </div> -->
                                            <div class="form-group row" data-name="QHEbvBPr">
                                                <div class="col-md-6" data-name="OutJkYzn">
                                                    <label class="col-form-label">{{trans('common.label.country')}} </label>
                                                    <select name="country" class="form-control m-select2"
                                                        id="country">{
                                                        @foreach ($countries as $country) {
                                                        <option value="{{$country->country_code}}"
                                                            {{ (isset($user->country) && $user->country == $country->country_code) ? 'selected' : ''  }}>
                                                            {{ $country->country_name }}</option>
                                                        }
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-md-6" data-name="OzggMswM">
                                                     <label class="col-form-label">{{trans('users.profile.mobile')}}</label>
                                                    <input type="text" name="mobile" value="{{isset($user->mobile) ? $user->mobile : '' }}" class="form-control" id="mobile" />
                                                    <input type="hidden" name="countrycode" value="{{isset($user->countrycode) ? $user->countrycode : '' }}" id="ccode">
                                                </div>
                                                
                                               
                                            </div>
                                            <div class="form-group row" data-name="IKNlalPn">
                                                <div class="col-md-6" data-name="JPpCQlXL">
                                                    <label class="col-form-label">{{trans('users.profile.address_line1')}}</label>
                                                    <input type="text" name="address_line_1" value="{{isset($user->address_line_1) ? $user->address_line_1 : '' }}" class="form-control" />
                                                </div>
                                                <div class="col-md-6" data-name="cOZXeLul">
                                                    <label class="col-form-label">{{trans('users.profile.address_line2')}}</label>
                                                    <input type="text" name="address_line_2" value="{{isset($user->address_line_2) ? $user->address_line_2 : '' }}" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row" data-name="bfzhhFWb">
                                                <div class="col-md-6" data-name="PciYSkyC">
                                                    <label class="col-form-label">{{trans('common.label.city')}}</label>
                                                    <input type="text" name="city" value="{{isset($user->city) ? $user->city : '' }}" class="form-control" />
                                                </div>
                                                <div class="col-md-6" data-name="iQCHvbwN">
                                                    <label class="col-form-label">{{trans('common.label.state')}} </label>
                                                    <input type="text" name="state" value="{{isset($user->state) ? $user->state : '' }}" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="form-group row" data-name="BjqJziDc">
                                                    
                                                <div class="col-md-6" data-name="irXQsVUp">
                                                    <label class="col-form-label">{{trans('users.profile.post_code')}}</label>
                                                    <input type="text" name="post_code" value="{{isset($user->post_code) ? $user->post_code : '' }}" class="form-control" />
                                                </div>
                                                <div class="col-md-6" data-name="llgBokns">
                                                    <label class="col-form-label">{{trans('users.profile.phone')}}</label>
                                                    <input type="text" name="phone" value="{{isset($user->phone) ? $user->phone : '' }}" class="form-control" />
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="kt-portlet__foot" data-name="MYjgXlLh">
                                            <div class="form-actions" data-name="iSHiUExt">
                                                <div class="row" data-name="cdpEhWCD">
                                                    <div class="col-md-12" data-name="zLlxwDde">
                                                        <button type="submit" name="save_add" class="btn btn-success" value="save_add">
                                                            {{trans('common.form.buttons.save')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane {{$localeTab}}" id="tab2" data-name="XRHiiBhn">
                            <div class="col-md-12" data-name="DhzxMJfK">
                                <form action="{{ route('user.setting',  $user->id) }}" method="POST"
                                    id="profile-frm1" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="profile">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="user-id" value="{{$user->id}}">
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="kt-portlet__body" data-name="IsoQJgWV">
                                        <div class="form-body" data-name="gKHGwhht">
                                           
                                            <div class="form-group row" data-name="lLaoOCJT">
                                           

                                                <div class="col-md-6" data-name="wPPlPjgG">
                                                    <label class="col-form-label">{{trans('common.label.time_zone')}} </label>
                                                    <select name="time_zone" class="form-control m-select2"
                                                        id="time_zone">{
                                                        @foreach ($timezones as $time_zone => $time_zone_name)
                                                        {
                                                        <option value="{{$time_zone}}"
                                                            {{ ($time_zone == $users->timezone) ? 'selected' : '' }}>
                                                            {{ $time_zone_name }}</option>
                                                        }
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" data-name="lLaoOCsasJT">
                                           

                                                <div class="col-md-6" data-name="wPPlPjasasgG">
                                                    <label class="col-form-label">{{ trans('common.label.language') }} </label>
                                                    <select name="language" class="form-control m-select2" id="language2">
                                                        <option value="english">{{ trans('common.label.english') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row" data-name="e8iMXdCQid">


                                                <div class="col-md-6" data-name="p5t7UPRxtN">
                                                    <label class="col-form-label">{{trans('common.label.time_format')}} </label>
                                                    <select name="time_format" class="form-control m-select2"id="time_format">
                                                        @foreach ($time_formats as $key => $time_format)
                                                            {
                                                            <option value="{{$time_format}}"
                                                                    {{ ($time_format == $user_time_format) ? 'selected' : '' }}>
                                                                {{ $key }}</option>
                                                            }
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                        <div class="kt-portlet__foot" data-name="lXJrqRqh">
                                            <div class="form-actions" data-name="BvcNhBxO">
                                                <div class="row" data-name="DnbCtPmu">
                                                    <div class="col-md-12" data-name="lmeoVHTw">
                                                        <button type="submit" name="save_add" class="btn btn-success" value="save_add">
                                                            {{trans('common.form.buttons.save')}}
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>


                        <div class="tab-pane {{$brandingTab}}" id="tab3" data-name="XRHiiBhn">
                            <div class="col-md-12" data-name="DhzxMJfK">
                                
                                    <div class="kt-portlet__body p-0" data-name="IsoQJgWV">
                                        <div class="form-body" data-name="gKHGwhht">

                                            <form action="{{ route('user.setting',  $user->id) }}" method="POST" enctype="multipart/form-data" id="branding-frm" class="kt-form kt-form--label-right">
                                            
                                            <input type="hidden" id="action" name="action"  value="branding">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="_method" value="POST">
                                            <?php 
                                                $branding_img = "public/img/logo.png"; 
                                                $branding_img_logo = "public/img/logo_dark.png"; 
                                                $branding_title = ""; 
                                                $hide_footer_disclaimer = false;
                                                $masked_domain = Auth::user()->application_domain; 
                                                $masked_domain_status = 0; 

                                                $favicon = url("public/img/favicon.ico");
                                                if(!empty(getSetting("favicon"))) { 
                                                    $favicon = "storage/branding/" . getSetting("favicon");
                                                }

                                                $thumb = url("/public/img/thumb.jpg");
                                                if(!empty(getSetting("thumb"))) { 
                                                    $thumb = "storage/branding/" . getSetting("thumb");
                                                }


                                                if(!empty(Auth::user()->branding)) { 
                                                    $branding = json_decode(Auth::user()->branding); 

                                                    if(!empty($branding->branding_img)) $branding_img = $branding->branding_img; 
                                                    if(!empty($branding->branding_img_logo)) $branding_img_logo = $branding->branding_img_logo; 
                                                    if(!empty($branding->favicon_img)) $favicon = $branding->favicon_img; 
                                                    if(!empty($branding->preloader_image)) $thumb = $branding->preloader_image; 
                                                    if(!empty($branding->banner_image)) $banner_image = $branding->banner_image; 
                                                    if(!empty($branding->branding_img_logo)) $branding_img_logo = $branding->branding_img_logo; 
                                                    if(!empty($branding->branding_title)) $branding_title = $branding->branding_title; 
                                                    if(!empty($branding->hide_footer_disclaimer)) $hide_footer_disclaimer = $branding->hide_footer_disclaimer; 
                                                    
                                                    if(!empty($branding->masked_domain_status)) $masked_domain_status = $branding->masked_domain_status; 
                                                    
                                                }


                                            ?>

                                            <div class="kt-portlet kt-portlet--bordered" data-name="AuGdxGia">
                                                <div class="kt-portlet__head" data-name="AuGdxGia">
                                                    <div class="kt-portlet__head-label" data-name="dpltxRVy">                                                
                                                        <h3 class="kt-portlet__head-title">
                                                            {{ trans('Branding Options') }}
                                                        </h3>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body" data-name="vztGIoPd">
                                                    <div class="form-group row" data-name="lLaoOCJT">
                                                        <div class="col-md-6" data-name="PciYSkyC">
                                                            <label class="col-form-label">{{ trans('profile.branding.application_title') }}</label>
                                                            <input type="text"  name="branding_title" id="branding_title" value="{{ $branding_title}}" class="form-control" />
                                                            <small id="bMsg" style="display:none; color:red;">Application title is required</small>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row" data-name="e8iMXdCQid">
                                                        <label class="col-form-label col-md-5">{{ trans('profile.branding.hide_footer') }} </label>
                                                        <div class="kt-checkbox-list">
                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                <label>
                                                                    <input type="checkbox" id="hide_footer_disclaimer" name="hide_footer_disclaimer" @if($hide_footer_disclaimer) checked @endif>
                                                                    <span></span>
                                                                </label>
                                                            </span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group" data-name="AiHTiXge">
                                                        <h3 class="mini_heading">Brand Images</h3>
                                                        <hr>
                                                    </div>
                                                
                                                    <div class="form-group row" data-name="lLaoOCsasJT">
                                                        <div class="col-md-6 mb-5">
                                                            <label class="col-form-label text-center w100">{{ trans('settings.branding.step2.form.dashboard_logo') }} </label>
                                                            <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('app.settings.branding.dashboard_logo')}}: 247px by 60px" data-name="DblaRHBo">
                                                                <input type="file" class="uploadimage" name="profile_logo">
                                                                <div class="fileinput-new thumbnail" style="height: auto;" data-name="KRMcBTJl">
                                                                <img src="{{ asset($branding_img)}}" alt="" height="40px"> </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; height: 40px; line-height: 40px;" data-name="kXiterZe"></div>
                                                                <div class="files-btn" data-name="FuyDwXwb">
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <span class="fileinput-exists"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <input type="hidden" value="" name=""> 
                                                                    </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> <i class="fa fa-remove"></i> </a>
                                                                </div>
                                                            </div>
                                                            <div class="dimension bg-white" data-name="jBeMtOaV">@lang('settings.branding.step2.form.login_logo_help')</div>
                                                        </div>
                                                        <div class="col-md-6 mb-5">
                                                            <label class="col-form-label text-center w100">{{ trans('settings.branding.step2.form.login_logo') }} </label>
                                                            <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('app.settings.branding.login_logo')}}: 247px by 60px" data-name="DblaRHBo">
                                                                <input type="file" class="uploadimage" name="profile_logo_login">
                                                                <div class="fileinput-new thumbnail bg-white" style="height: auto;" data-name="KRMcBTJl">
                                                                <img src="{{ asset($branding_img_logo)}}" alt="" height="40px"> </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; height: 40px; line-height: 40px;" data-name="kXiterZe"></div>
                                                                <div class="files-btn" data-name="FuyDwXwb">
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <span class="fileinput-exists"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <input type="hidden" value="" name=""> 
                                                                    </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 
                                                                        <i class="fa fa-remove"></i> 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="dimension bg-white" data-name="jBeMtOaV">@lang('settings.branding.step2.form.login_logo_help')</div>
                                                        </div>

                                                        
                                                        <div class="col-md-6 mb-5">
                                                            <label class="col-form-label text-center w100">{{trans('settings.branding.step2.form.favicon')}} </label>
                                                            <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('app.settings.branding.login_logo')}}: 247px by 60px" data-name="DblaRHBo">
                                                                <input type="file" class="uploadimage" name="favicon_img">
                                                                <div class="fileinput-new thumbnail bg-white" style="height: auto;" data-name="KRMcBTJl">
                                                                <img src="{{ asset($favicon)}}" alt="" height="24px"> </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; height: 40px; line-height: 40px;" data-name="kXiterZe"></div>
                                                                <div class="files-btn" data-name="FuyDwXwb">
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <span class="fileinput-exists"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <input type="hidden" value="" name=""> 
                                                                    </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 
                                                                        <i class="fa fa-remove"></i> 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="dimension bg-white" data-name="jBeMtOaV">@lang('settings.branding.step2.form.favicon_help')</div>
                                                        </div>
                                                        
                                                        <div class="col-md-6 mb-5">
                                                            <label class="col-form-label text-center w100">{{ trans('settings.branding.step2.form.preloader_image') }} </label>
                                                            <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('app.settings.branding.login_logo')}}: 247px by 60px" data-name="DblaRHBo">
                                                                <input type="file" class="uploadimage" name="preloader_image">
                                                                <div class="fileinput-new thumbnail bg-white" style="height: auto;" data-name="KRMcBTJl">
                                                                <img src="{{ url($thumb)}}" alt="" height="40px"> </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; height: 40px; line-height: 40px;" data-name="kXiterZe"></div>
                                                                <div class="files-btn" data-name="FuyDwXwb">
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <span class="fileinput-exists"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <input type="hidden" value="" name=""> 
                                                                    </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 
                                                                        <i class="fa fa-remove"></i> 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="dimension bg-white" data-name="jBeMtOaV">@lang('settings.branding.step2.form.preloader_image_help')</div>
                                                        </div>
                                                        <?php 
                                                            $login_background = url("public/img/bg.png");
                                                            if(!empty(getSetting("login_background"))) { 
                                                                $login_background = "/storage/branding/" . getSetting("login_background");
                                                            }

                                                            if(!empty($banner_image)) { 
                                                                $login_background = $banner_image;
                                                            }
                                                        ?>
                                                        <div class="col-md-6 mb-5">
                                                            <label class="col-form-label text-center w100">{{ trans('settings.branding.step2.form.landing_banner') }} </label>
                                                            <div class="fileinput fileinput-new banner" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('app.settings.branding.login_logo')}}: 247px by 60px" data-name="DblaRHBo">
                                                                <input type="file" class="uploadimage" name="banner_image">
                                                                <div class="fileinput-new thumbnail bg-white" style="height: auto;" data-name="KRMcBTJl">
                                                                <img src="{{ asset($login_background)}}" alt="" height="160px"> </div>
                                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; height: 40px; line-height: 40px;" data-name="kXiterZe"></div>
                                                                <div class="files-btn" data-name="FuyDwXwb">
                                                                    <span class="btn default btn-file">
                                                                        <span class="fileinput-new"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <span class="fileinput-exists"> <i class="fa fa-pencil-alt"></i> </span>
                                                                        <input type="hidden" value="" name=""> 
                                                                    </span>
                                                                    <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> 
                                                                        <i class="fa fa-remove"></i> 
                                                                    </a>
                                                                </div>
                                                            </div>
                                                            <div class="dimension bg-white" data-name="jBeMtOaV">@lang('settings.branding.step2.form.landing_banner_help')</div>
                                                        </div>

                                                        {{--<div class="col-md-6" data-name="wPPlPjasasgG">
                                                            <label class="col-form-label">{{ trans('settings.branding.step2.form.dashboard_logo') }} </label>
                                                            <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                    <input name="profile_logo" type='file' id="logoUpload" id="profile_logo" accept=".png, .jpg, .jpeg" />
                                                                    <label for="logoUpload" class="uload-icon"><i class="fa fa-pencil-alt" ></i></label>
                                                                </div>
                                                                <div class="avatar-preview">
                                                                    <?php 
                                                                    ?>
                                                                    @if ($branding_img)
                                                                        <div id="imagePreview" style="background-image: url('{{ asset($branding_img) }}');"></div>
                                                                    @else
                                                                        <div id="imagePreview" style="background-image: url('/resources/assets/images/images.png');"></div>
                                                                    @endif
                                                                </div>
                                                                <label id="cancel" class="cancel-icon cancel-upload"><i class="fa fa-times" ></i></label>
                                                            </div>
                                                        </div> --}}
                                                        {{--<div class="col-md-6" data-name="wPPlPjasasgG">
                                                            <label class="col-form-label">{{ trans('settings.branding.step2.form.login_logo') }} </label>
                                                            <div class="avatar-upload">
                                                                <div class="avatar-edit">
                                                                    <input name="profile_logo_login" type='file' id="logoUploadlogin" id="profile_logo_login" accept=".png, .jpg, .jpeg" />
                                                                    <label for="logoUploadlogin" class="uload-icon"><i class="fa fa-pencil-alt" ></i></label>
                                                                </div>
                                                                <div class="avatar-preview">
                                                                    <?php 
                                                                    ?>
                                                                    @if ($branding_img_logo)
                                                                        <div id="imagePreview" style="background-image: url('{{ asset($branding_img_logo) }}');"></div>
                                                                    @else
                                                                        <div id="imagePreview" style="background-image: url('/resources/assets/images/images.png');"></div>
                                                                    @endif
                                                                </div>
                                                                <label id="cancel2" class="cancel-icon cancel-upload"><i class="fa fa-times" ></i></label>
                                                            </div>
                                                        </div>--}}
                                                    </div>                                                    
                                                </div>
                                                <div class="kt-portlet__foot" data-name="WYZUBGCt">
                                                    <div class="form-actions" data-name="bPwGmyom">
                                                        <div class="row" data-name="xCnTvrRF">
                                                            <div class="col-md-6" data-name="txYhMMGs">
                                                                <button type="submit" name="save_brand" class="btn btn-success" value="save_add">
                                                                    {{trans('common.form.buttons.save')}}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            </form>


                                            <div class="kt-portlet kt-portlet--bordered" data-name="AuGdxGia">
                                                <div class="kt-portlet__head" data-name="AuGdxGia">
                                                    <div class="kt-portlet__head-label" data-name="dpltxRVy">                                                
                                                        <h3 class="kt-portlet__head-title">
                                                            {{ trans('Branding Domain') }}
                                                        </h3>
                                                    </div>
                                                    <div class="kt-portlet__head-toolbar" data-name="wfQRMCmN"> <!-- id="dnscheck" -->
                                                        <button type="button" onClick="confirmDomain()" class="btn btn-default">{{ trans('profile.branding.recheck') }}</button>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body" data-name="vztGIoPd">
                                                    <form action="{{ route('saveRedirectUrl') }}" method="POST" id="domain-frm1" class="kt-form kt-form--label-right">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <input type="hidden" name="id" value="{{Auth::user()->id}}">
                                                    <div class="form-group row mb0" data-name="IgnvYsrO">
                                                        <label class="col-form-label col-md-12">Domain Name</label>
                                                    </div>
                                                    <div class="form-group row" data-name="IgnvYsrO">
                                                        <div class="col-md-9" data-name="QQDFqMrE">
                                                            
                                                            <div class="input-group" data-name="KdTHZzyf">
                                                                <input type="text" placeholder="example.com" name="primary_domain" id="primary_domain" @if(!empty($masked_domain)) disabled @endif value="{{$masked_domain}}" class="form-control"/>
                                                                <input type="hidden" id="primary_domain_counter_hidden" value=""> 
                                                                <span class="input-group-append"> 
                                                                    <span class="input-group-text">
                                                                       
                                                                            <i class="fa fa-check fa-2x text-success DSuccess"  @if($masked_domain_status == 1)  @else style="display:none;" @endif></i>
                                                                       
                                                                       
                                                                        <i class="fa fa-question fa-2x text-warning DPending"   @if($masked_domain_status == 0)   @else style="display:none;" @endif></i>
                                                                       
                                                                        <i class="fa fa-times fa-2x text-danger DFailed"  @if($masked_domain_status == 2) @else style="display:none;" @endif ></i>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <?php 
                                                            $editBtn = "display:none;";
                                                            $saveBtn = "";
                                                            $closeBtn = "display:none;";
                                                            if(!empty($masked_domain)) { 
                                                                $editBtn = "";
                                                                $saveBtn = "display:none";
                                                                $closeBtn = "display:none;";
                                                            }
                                                        ?>
                                                        <button type='button' class='btn btn-info btn-chk' id='edit_button' name='edit'  style="{{$editBtn}}" onClick='removeDisabledAttr()'><i class='la la-edit'></i></button>
                                                        <button type="submit" class="btn btn-success btn-chk" id="savee_buttonn" name='submit' style="{{$saveBtn}}"><i class="la la-save"></i></button>
                                                        <button type='button' class='btn btn-default' id='close_button' name='close' style="{{$closeBtn}}" onClick='closeEditing()'>Cancel</button>
                                                   
                                                    </div>
                                                </form>
                                                    <div class="row" data-name="rZkrKgbJ">
                                                        <div class="col-md-12" data-name="QquBMHDK">
                                                            <div class="contentBlk1 contentBlk" data-name="YvqNyaOQ">
                                                                <h2>{{trans('profile.branding.a_record_desc_part1')}}</h2>
                                                                <div class="content" data-name="WkvBHqMq">{{trans('profile.branding.a_record_desc_part1')}} <b>{{$masked_domain}}</b> {{trans('profile.branding.a_record_desc_part2')}}.</div>
                                                            </div>
                                                            <table class="table table-striped table-hover table-checkable responsive" id="dSetting2">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="30%"> {{trans('profile.branding.host')}} </th>
                                                                        <th> {{trans('profile.branding.type')}} </th>
                                                                        <th> {{trans('profile.branding.value')}} </th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr id="cnm" style="">
                                                                        <td>
                                                                            <div class="option rh30" data-name="rxFpQLub">
                                                                                <div class="domaintrack" data-name="NybrVCEl">
                                                                                   {{$masked_domain}}
                                                                                </div>

                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="option" data-name="QBaQGRuj">
                                                                                {{trans('CNAME')}}
                                                                            </div>
                                                                        </td>
                                                                        <td>
                                                                            <div class="option" data-name="nCSaoysW">
                                                                                @php
                                                                                    echo getSetting("primary_domain");
                                                                            @endphp
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php 
                                                             if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
                                                                // The site is running on HTTPS
                                                                $protocol = 'https://';
                                                            } else {
                                                                // The site is running on HTTP
                                                                $protocol = 'http://';
                                                            }
                                                            $tracking_url = $protocol.trim($masked_domain).'/version?id='.rand(0, 100);
                                                            $result = requestCurl($tracking_url);

                                                        
                                                        ?>
                                                        @if(!empty($masked_domain))
                                                            @if (empty($result) OR (!empty($result) and strlen($result)  > 10) )
                                                            <br>
                                                            <small> It takes up to 48 hours to propagate DNS records globally. This message will disappear automatically when your branded domain becomes operational.</small>
                                                            <br>
                                                            @endif
                                                        @endif
                                                    </div>

                                                    <div class="form-group row mb0" data-name="DMjOUiOp">
                                                        <div class="col-md-12" data-name="vfPnenHw">
                                                            <span id='confirm-button'>
                    
                                                                @if($masked_domain_status == 0)
                    
                                                                <button type="button" class="btn btn-success" id="confirm_button" onClick="confirmDomain()">{{trans('common.label.confirm')}}</button>
                    
                                                                @endif
                    
                                                            </span>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                           
                                        </div>
                                    </div>
                                
                            </div>
                        </div>



                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>



    <!-- END FORM-->
    @endsection
    @section('page_scripts')
    <script src="/themes/default/js/jquery.form.min.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validate.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/additional-methods.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/init.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/select2.full.min.js"
        type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript">
    </script>
    <script src="/themes/default/js/form-controls.js"
        type="text/javascript"></script>

    <script src="/themes/default/js/includes/intlTelInput.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/validate-form.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/profile.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-fileinput.js" type="text/javascript"></script>
    <script type="text/javascript">

function confirmDomain() {
var domain = $("#primary_domain").val();
$.ajax({
    url: "{{ url('/') }}"+'/update/profile/verify/'+domain,
    type: 'GET',
    success: function(data) {
        if(data == 'confirm'){
            $(".DSuccess").show();
            $(".DFailed").hide();
            $(".DPending").hide();
            Command: toastr["success"] ("{{trans('Confirmed Successfully')}}");
        }else{
            $(".DSuccess").hide();
            $(".DFailed").show();
            $(".DPending").hide();
        //    Command: toastr["error"] ("{{trans('settings.message.primary_domain_failed')}}");
        }
        // window.location.href = "/profile/{{ $user->id }}?t=b";
    //   window.location.reload()
    }
});

}


$('#branding-frm').submit(function(e){
    $("#bMsg").hide();
    if($("#branding_title").val() == "") {
        $("#branding_title").focus();
        $("#bMsg").show();
       
        return false;
    }
    var form = $('#branding-frm');
    var action = $(this).data('action');
    form.attr('action', action);
    form.submit();
});


function removeDisabledAttr() {

    $("#primary_domain").removeAttr('disabled');
    $("#edit_button").hide();
    $("#savee_buttonn").show();
    $("#close_button").show();

}


function closeEditing() {
        $("#primary_domain").attr('disabled', 'disabled');
        $("#edit_button").show();
        $("#savee_buttonn").hide();
        $("#close_button").hide();
    }

    $(document).ready(function () {
        // $(".btn-file>.fileinput-new").text(" Change ");
        $(".sb-form").click(function (e) {
            btn_id = this.id;
            id = '{{$user->id}}';
                method = "POST";
                route = '{{route('updateProfile')}}';
            
            formId = "#security";
            createOrUpdate(method, route, formId,e,btn_id);
        });
    });
    $('.form-control').on('keypress keyup change', function(e) {
        id = this.id;
        id = '#'+id;
        err_id = '#'+this.id+'-error';
        if(id !="#")
        $(id).removeClass('is-invalid');
        $(err_id).css('display','none');
    });
</script>
    <script type="text/javascript">
    function copyFunction() {
        var range = document.createRange();
        range.selectNode(document.getElementById("bc_code"));
        window.getSelection().removeAllRanges(); // clear current selection
        window.getSelection().addRange(range); // to select text
        document.execCommand("copy");
        window.getSelection().removeAllRanges(); // to deselect
        // console.log("Copied the text: " + range);
        Command: toastr["success"]("@lang('users.message.Backup_Code_Copied')");
    }
    </script>
    <script type="text/javascript">
    $(document).ready(function() {

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                    $('#avatar').attr('src', e.target.result);
                    $('#avatar').hide();
                    $('#avatar').fadeIn(650);
                    $('#profile-image').attr('src', e.target.result);
                    $('#profile-image').hide();
                    $('#profile-image').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
        $("#logoUpload").change(function() {
            readURL(this);
        });

        $("#mobile").intlTelInput({
            placeholderNumberType: "MOBILE",
            separateDialCode: true,
            utilsScript: '{{ URL("/themes/default/js/includes/utils.js") }}'
        });

        var mobnum = $("#mobile").val();
        var codd = $('#ccode').val();
        $("#mobile").intlTelInput("setNumber", "+" + codd);
        $("#mobile").val(mobnum);
        $("#mobile").on("countrychange", function(e, countryData) {
            $("#ccode").val(countryData.dialCode);
        });

        $("#code-confirm").click(function() {
            $('.blockUI').show();
            setTimeout(function() {
                $(".qr-codeBlk").hide();
                $('.blockUI').show();
                $("form#s_step").show();
                $('.blockUI').hide();
            }, 1000);
        });

        $("#backtocode").click(function() {
            $("form#s_step").hide();
            $(".qr-codeBlk").show();
        });

        if ($("#2fa").is(":checked")) {
            $("#twofaModal .modal-header").html(
                '<i class="la la-info-circle"></i><h5 class="modal-title" id="twoMT"></h5><button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>'
            );
            $("#twoMT").html("@lang('users.profile.Disable_Two_Factor')");
            $("#twofaModal .modal-header").addClass("disable2fa");
            $("#twofaModal .modal-footer").hide();
        } else {
            $("#twoMT").html("@lang('users.profile.Enable_Two_Factor')");
        }
        $('#time_zone, #country, #time_format','#language2').select2({
            placeholder: "Select option"
        });
        $('#language2').select2({
            placeholder: "Select option"
        });
         

    });


    function addToList()
    {
        ip = $('.ipaddress').text();
     	ips = $('#login_ips').val();
     	if(ips!=="")
         	ips = ips+"\n"+ip;
     	else ips =ip;
     	$('#login_ips').val(ips);
     	$('.bt').prop('disabled',true);
     	
        
    }
    </script>
    @endsection