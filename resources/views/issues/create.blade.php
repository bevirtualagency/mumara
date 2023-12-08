@extends('admin.layouts.master2')

@section('title', trans('issues.create_blade.add_issue_notification_title'))

@section('page_styles')
<style type="text/css">
    .icon_select_container {
        height: 263px;
        overflow: auto;
        width: 100%;
        border: 1px solid #bec4d0;
        overflow-x: hidden;
        margin-top: 25px;
    }
    .icon_select_container .icon_preview {
        position: relative;
        font-size: 1.1rem;
        line-height: 36px;
        width: 5.42%;
        height: 36px;
        color: #494949;
        background: #fff;
        display: block;
        text-align: center;
        float: left;
        border: 1px solid #e1e1e1;
        margin-left: -1px;
        margin-top: -1px;
        transition: all 0.1s ease-out;
        cursor: pointer;
    }
    .icon_select_container .selected-element, .icon_select_container .selected-element:hover {
        color: #ffffff;
        background-color: #1caf9a;
    }
    #selected-icon {
        display: block;
        width: 100%;
        height: calc(1.5em + 1.3rem + 2px);
        padding: 0.65rem 1rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #bec4d0;
        border-radius: 4px;
        -webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
    }
    #selected-icon i#icon-icon {
        font-size: 1.8rem;
        line-height: 1;
        vertical-align: middle;
        color: #494949;
    }
    #selected-icon span#icon-title {
        text-transform: capitalize;
        margin-left: 40px;
    }
    button.jscolor {
        width: 20px;
        height: 20px;
        border: 1px solid #bec4d0;
    }
    div#selected-icon .input-group-prepend {
        position: absolute;
        left: 0;
        top: 0;
        height: 100%;
        border: 0 !important;
    }
    div#selected-icon .input-group-prepend span.input-group-text {
        border: 0 !important;
        border-right: 1px solid #bec4d0 !important;
        text-align: center !important;
        padding: 5px !important;
        width: 40px;
    }
    div#selected-icon .input-group-prepend span.input-group-text i {
        padding: 0;
        margin: 0;
        width: 100%;
    }
    form#client-template hr {
        margin-top: 3.5rem;
        margin-bottom: 4rem;
    }
    .p610 {
        padding: 6px 10px !important;
        border-color: #bec4d0!important;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/public/js/jscolor.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".icon_preview").click(function() {
            $(".icon_select_container>.icon_preview").removeClass("selected-element");
            $(this).addClass("selected-element");
            var title = $(this).attr("title");
            $("#icon-title").html(title);
            var icon = $(this).children("i").attr("class");
            $("#icon").val(icon);
            $("#icon-icon").attr("class", icon);
            // console.log(icon);
        });
    });
</script>
@endsection

@section('content')

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="eNToTnJj">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="DJlRjxcu">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="rQbTOcrq">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>
<div class="col-md-12" data-name="PvKgzkQt">
    <!-- BEGIN FORM-->
    <form action="" method="POST" id="issue-template" class="kt-form kt-form--label-right">
        <div class="row" data-name="vehsWUet">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="kxmTfGzI">
                <div class="kt-portlet__head" data-name="uvsqjfaC">
                    <div class="kt-portlet__head-label" data-name="eWYMjbAa">
                        <h3 class="kt-portlet__head-title">{{trans('issues.create_blade.issue_notification_heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="DHdFBzAq">
                    <div class="form-body" data-name="tuBaDhyU">
                        <div class="form-group row" data-name="bgXEhApz">
                            <label class="col-form-label col-md-3">{{trans('app.create_client_template.label.name')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="yYqYhbKb">
                                <div class="input-icon right" data-name="UVSplYLQ">
                                    <input type="text" name="template_name" id="template_name" class="form-control" value="{{ @$template_row['template_name'] }}" />
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.create_client_template.label.name_help')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        

                        <div class="form-group row" data-name="pFxardNq">
                            <label class="col-form-label col-md-3">{{trans('issues.create_blade.notification_message_label')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="uYZTjogI">
                                <div class="input-icon right" data-name="eBaoIWmp">
                                    <input type="text" name="notification-text" class="form-control">
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Notification Message" data-original-title="{{trans('common.description')}}"></i>
                        </div>

                        <div class="form-group row" data-name="ZeXPLFlu">
                            <label class="col-form-label col-md-3">{{trans('issues.create_blade.notification_icon_label')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="DXcnTNzG">
                                <div class="fusion-iconpicker" data-name="DronlfVM">
                                    <div class="row" data-name="hrngjkDj">
                                        <div class="col-md-6" data-name="BXtZbZIs">
                                            <div id="selected-icon" class="input-group" data-name="UUKjUyQd">
                                                <div class="input-group-prepend" data-name="taVuEHOS">
                                                    <span class="input-group-text">
                                                        <i class="fa-apple fab jscolor" id="icon-icon"></i>
                                                    </span>
                                                </div>
                                                <span id="icon-title">{{trans('issues.create_blade.apple_brands_span')}}  </span>
                                            </div>
                                        </div>
                                        <div class="col-md-6" data-name="YBkMnwqx">
                                            <div class="input-group" data-name="ykvdLSdR">
                                                <input type="text" id="chosen-value" class="form-control" aria-label="Choose Color" value="494949">
                                                <div class="input-group-append" data-name="iDpYVdGH">
                                                    <span class="input-group-text p610">
                                                        <button class="jscolor {valueElement:'chosen-value', onFineChange:'setTextColor(this)'}"></button>
                                                        <script>
                                                            function setTextColor(picker) {
                                                                document.getElementsByTagName('body')[0].style.color = '#' + picker.toString();
                                                                document.getElementById("icon-icon").style.color = '#' + picker.toString();
                                                            }
                                                        </script>
                                                    </span>
                                                </div>                                      
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="icon_select_container" data-name="DsxPTdvh">
                                        <span class="icon_preview icon-fa-500px" title="500px - Brands"><i class="fa-500px fab" data-name="500px"></i></span>
                                        <span class="icon_preview icon-fa-accessible-icon" title="accessible-icon - Brands"><i class="fa-accessible-icon fab" data-name="accessible-icon"></i></span>
                                        <span class="icon_preview icon-fa-accusoft" title="accusoft - Brands"><i class="fa-accusoft fab" data-name="accusoft"></i></span>
                                        <span class="icon_preview icon-fa-acquisitions-incorporated" title="acquisitions-incorporated - Brands"><i class="fa-acquisitions-incorporated fab" data-name="acquisitions-incorporated"></i></span>
                                        <span class="icon_preview icon-fa-ad" title="ad - Solid"><i class="fa-ad fas" data-name="ad"></i></span>
                                        <span class="icon_preview icon-fa-address-book" title="address-book - Solid"><i class="fa-address-book fas" data-name="address-book"></i></span>
                                        <span class="icon_preview icon-fa-address-book" title="address-book - Regular"><i class="fa-address-book far" data-name="address-book"></i></span>
                                        <span class="icon_preview icon-fa-address-card" title="address-card - Solid"><i class="fa-address-card fas" data-name="address-card"></i></span>
                                        <span class="icon_preview icon-fa-address-card" title="address-card - Regular"><i class="fa-address-card far" data-name="address-card"></i></span>
                                        <span class="icon_preview icon-fa-adjust" title="adjust - Solid"><i class="fa-adjust fas" data-name="adjust"></i></span>
                                        <span class="icon_preview icon-fa-adn" title="adn - Brands"><i class="fa-adn fab" data-name="adn"></i></span>
                                        <span class="icon_preview icon-fa-adobe" title="adobe - Brands"><i class="fa-adobe fab" data-name="adobe"></i></span>
                                        <span class="icon_preview icon-fa-adversal" title="adversal - Brands"><i class="fa-adversal fab" data-name="adversal"></i></span>
                                        <span class="icon_preview icon-fa-affiliatetheme" title="affiliatetheme - Brands"><i class="fa-affiliatetheme fab" data-name="affiliatetheme"></i></span>
                                        <span class="icon_preview icon-fa-air-freshener" title="air-freshener - Solid"><i class="fa-air-freshener fas" data-name="air-freshener"></i></span>
                                        <span class="icon_preview icon-fa-algolia" title="algolia - Brands"><i class="fa-algolia fab" data-name="algolia"></i></span>
                                        <span class="icon_preview icon-fa-align-center" title="align-center - Solid"><i class="fa-align-center fas" data-name="align-center"></i></span>
                                        <span class="icon_preview icon-fa-align-justify" title="align-justify - Solid"><i class="fa-align-justify fas" data-name="align-justify"></i></span>
                                        <span class="icon_preview icon-fa-align-left" title="align-left - Solid"><i class="fa-align-left fas" data-name="align-left"></i></span>
                                        <span class="icon_preview icon-fa-align-right" title="align-right - Solid"><i class="fa-align-right fas" data-name="align-right"></i></span>
                                        <span class="icon_preview icon-fa-alipay" title="alipay - Brands"><i class="fa-alipay fab" data-name="alipay"></i></span>
                                        <span class="icon_preview icon-fa-allergies" title="allergies - Solid"><i class="fa-allergies fas" data-name="allergies"></i></span>
                                        <span class="icon_preview icon-fa-amazon" title="amazon - Brands"><i class="fa-amazon fab" data-name="amazon"></i></span>
                                        <span class="icon_preview icon-fa-amazon-pay" title="amazon-pay - Brands"><i class="fa-amazon-pay fab" data-name="amazon-pay"></i></span>
                                        <span class="icon_preview icon-fa-ambulance" title="ambulance - Solid"><i class="fa-ambulance fas" data-name="ambulance"></i></span>
                                        <span class="icon_preview icon-fa-american-sign-language-interpreting" title="american-sign-language-interpreting - Solid"><i class="fa-american-sign-language-interpreting fas" data-name="american-sign-language-interpreting"></i></span>
                                        <span class="icon_preview icon-fa-amilia" title="amilia - Brands"><i class="fa-amilia fab" data-name="amilia"></i></span>
                                        <span class="icon_preview icon-fa-anchor" title="anchor - Solid"><i class="fa-anchor fas" data-name="anchor"></i></span>
                                        <span class="icon_preview icon-fa-android" title="android - Brands"><i class="fa-android fab" data-name="android"></i></span>
                                        <span class="icon_preview icon-fa-angellist" title="angellist - Brands"><i class="fa-angellist fab" data-name="angellist"></i></span>
                                        <span class="icon_preview icon-fa-angle-double-down" title="angle-double-down - Solid"><i class="fa-angle-double-down fas" data-name="angle-double-down"></i></span>
                                        <span class="icon_preview icon-fa-angle-double-left" title="angle-double-left - Solid"><i class="fa-angle-double-left fas" data-name="angle-double-left"></i></span>
                                        <span class="icon_preview icon-fa-angle-double-right" title="angle-double-right - Solid"><i class="fa-angle-double-right fas" data-name="angle-double-right"></i></span>
                                        <span class="icon_preview icon-fa-angle-double-up" title="angle-double-up - Solid"><i class="fa-angle-double-up fas" data-name="angle-double-up"></i></span>
                                        <span class="icon_preview icon-fa-angle-down" title="angle-down - Solid"><i class="fa-angle-down fas" data-name="angle-down"></i></span>
                                        <span class="icon_preview icon-fa-angle-left" title="angle-left - Solid"><i class="fa-angle-left fas" data-name="angle-left"></i></span>
                                        <span class="icon_preview icon-fa-angle-right" title="angle-right - Solid"><i class="fa-angle-right fas" data-name="angle-right"></i></span>
                                        <span class="icon_preview icon-fa-angle-up" title="angle-up - Solid"><i class="fa-angle-up fas" data-name="angle-up"></i></span>
                                        <span class="icon_preview icon-fa-angry" title="angry - Solid"><i class="fa-angry fas" data-name="angry"></i></span>
                                        <span class="icon_preview icon-fa-angry" title="angry - Regular"><i class="fa-angry far" data-name="angry"></i></span>
                                        <span class="icon_preview icon-fa-angrycreative" title="angrycreative - Brands"><i class="fa-angrycreative fab" data-name="angrycreative"></i></span>
                                        <span class="icon_preview icon-fa-angular" title="angular - Brands"><i class="fa-angular fab" data-name="angular"></i></span>
                                        <span class="icon_preview icon-fa-ankh" title="ankh - Solid"><i class="fa-ankh fas" data-name="ankh"></i></span>
                                        <span class="icon_preview icon-fa-app-store" title="app-store - Brands"><i class="fa-app-store fab" data-name="app-store"></i></span>
                                        <span class="icon_preview icon-fa-app-store-ios" title="app-store-ios - Brands"><i class="fa-app-store-ios fab" data-name="app-store-ios"></i></span>
                                        <span class="icon_preview icon-fa-apper" title="apper - Brands"><i class="fa-apper fab" data-name="apper"></i></span>
                                        <span class="icon_preview icon-fa-apple selected-element" title="apple - Brands"><i class="fa-apple fab" data-name="apple"></i></span>
                                        <span class="icon_preview icon-fa-apple-alt" title="apple-alt - Solid"><i class="fa-apple-alt fas" data-name="apple-alt"></i></span>
                                        <span class="icon_preview icon-fa-apple-pay" title="apple-pay - Brands"><i class="fa-apple-pay fab" data-name="apple-pay"></i></span>
                                        <span class="icon_preview icon-fa-archive" title="archive - Solid"><i class="fa-archive fas" data-name="archive"></i></span>
                                        <span class="icon_preview icon-fa-archway" title="archway - Solid"><i class="fa-archway fas" data-name="archway"></i></span>
                                        <span class="icon_preview icon-fa-arrow-alt-circle-down" title="arrow-alt-circle-down - Solid"><i class="fa-arrow-alt-circle-down fas" data-name="arrow-alt-circle-down"></i></span>
                                        <span class="icon_preview icon-fa-arrow-alt-circle-down" title="arrow-alt-circle-down - Regular"><i class="fa-arrow-alt-circle-down far" data-name="arrow-alt-circle-down"></i></span>
                                        <span class="icon_preview icon-fa-arrow-alt-circle-left" title="arrow-alt-circle-left - Solid"><i class="fa-arrow-alt-circle-left fas" data-name="arrow-alt-circle-left"></i></span>
                                        <span class="icon_preview icon-fa-arrow-alt-circle-left" title="arrow-alt-circle-left - Regular"><i class="fa-arrow-alt-circle-left far" data-name="arrow-alt-circle-left"></i></span>
                                        <span class="icon_preview icon-fa-arrow-alt-circle-right" title="arrow-alt-circle-right - Solid"><i class="fa-arrow-alt-circle-right fas" data-name="arrow-alt-circle-right"></i></span>
                                        <span class="icon_preview icon-fa-arrow-alt-circle-right" title="arrow-alt-circle-right - Regular"><i class="fa-arrow-alt-circle-right far" data-name="arrow-alt-circle-right"></i></span>
                                        <span class="icon_preview icon-fa-arrow-alt-circle-up" title="arrow-alt-circle-up - Solid"><i class="fa-arrow-alt-circle-up fas" data-name="arrow-alt-circle-up"></i></span>
                                        <span class="icon_preview icon-fa-arrow-alt-circle-up" title="arrow-alt-circle-up - Regular"><i class="fa-arrow-alt-circle-up far" data-name="arrow-alt-circle-up"></i></span>
                                        <span class="icon_preview icon-fa-arrow-circle-down" title="arrow-circle-down - Solid"><i class="fa-arrow-circle-down fas" data-name="arrow-circle-down"></i></span>
                                        <span class="icon_preview icon-fa-arrow-circle-left" title="arrow-circle-left - Solid"><i class="fa-arrow-circle-left fas" data-name="arrow-circle-left"></i></span>
                                        <span class="icon_preview icon-fa-arrow-circle-right" title="arrow-circle-right - Solid"><i class="fa-arrow-circle-right fas" data-name="arrow-circle-right"></i></span>
                                        <span class="icon_preview icon-fa-arrow-circle-up" title="arrow-circle-up - Solid"><i class="fa-arrow-circle-up fas" data-name="arrow-circle-up"></i></span>
                                        <span class="icon_preview icon-fa-arrow-down" title="arrow-down - Solid"><i class="fa-arrow-down fas" data-name="arrow-down"></i></span>
                                        <span class="icon_preview icon-fa-arrow-left" title="arrow-left - Solid"><i class="fa-arrow-left fas" data-name="arrow-left"></i></span>
                                        <span class="icon_preview icon-fa-arrow-right" title="arrow-right - Solid"><i class="fa-arrow-right fas" data-name="arrow-right"></i></span>
                                        <span class="icon_preview icon-fa-arrow-up" title="arrow-up - Solid"><i class="fa-arrow-up fas" data-name="arrow-up"></i></span>
                                        <span class="icon_preview icon-fa-arrows-alt" title="arrows-alt - Solid"><i class="fa-arrows-alt fas" data-name="arrows-alt"></i></span>
                                        <span class="icon_preview icon-fa-arrows-alt-h" title="arrows-alt-h - Solid"><i class="fa-arrows-alt-h fas" data-name="arrows-alt-h"></i></span>
                                        <span class="icon_preview icon-fa-arrows-alt-v" title="arrows-alt-v - Solid"><i class="fa-arrows-alt-v fas" data-name="arrows-alt-v"></i></span>
                                        <span class="icon_preview icon-fa-artstation" title="artstation - Brands"><i class="fa-artstation fab" data-name="artstation"></i></span>
                                        <span class="icon_preview icon-fa-assistive-listening-systems" title="assistive-listening-systems - Solid"><i class="fa-assistive-listening-systems fas" data-name="assistive-listening-systems"></i></span>
                                        <span class="icon_preview icon-fa-asterisk" title="asterisk - Solid"><i class="fa-asterisk fas" data-name="asterisk"></i></span>
                                        <span class="icon_preview icon-fa-asymmetrik" title="asymmetrik - Brands"><i class="fa-asymmetrik fab" data-name="asymmetrik"></i></span>
                                        <span class="icon_preview icon-fa-at" title="at - Solid"><i class="fa-at fas" data-name="at"></i></span>
                                        <span class="icon_preview icon-fa-atlas" title="atlas - Solid"><i class="fa-atlas fas" data-name="atlas"></i></span>
                                        <span class="icon_preview icon-fa-atlassian" title="atlassian - Brands"><i class="fa-atlassian fab" data-name="atlassian"></i></span>
                                        <span class="icon_preview icon-fa-atom" title="atom - Solid"><i class="fa-atom fas" data-name="atom"></i></span>
                                        <span class="icon_preview icon-fa-audible" title="audible - Brands"><i class="fa-audible fab" data-name="audible"></i></span>
                                        <span class="icon_preview icon-fa-audio-description" title="audio-description - Solid"><i class="fa-audio-description fas" data-name="audio-description"></i></span>
                                        <span class="icon_preview icon-fa-autoprefixer" title="autoprefixer - Brands"><i class="fa-autoprefixer fab" data-name="autoprefixer"></i></span>
                                        <span class="icon_preview icon-fa-avianex" title="avianex - Brands"><i class="fa-avianex fab" data-name="avianex"></i></span>
                                        <span class="icon_preview icon-fa-aviato" title="aviato - Brands"><i class="fa-aviato fab" data-name="aviato"></i></span>
                                        <span class="icon_preview icon-fa-award" title="award - Solid"><i class="fa-award fas" data-name="award"></i></span>
                                        <span class="icon_preview icon-fa-aws" title="aws - Brands"><i class="fa-aws fab" data-name="aws"></i></span>
                                        <span class="icon_preview icon-fa-baby" title="baby - Solid"><i class="fa-baby fas" data-name="baby"></i></span>
                                        <span class="icon_preview icon-fa-baby-carriage" title="baby-carriage - Solid"><i class="fa-baby-carriage fas" data-name="baby-carriage"></i></span>
                                        <span class="icon_preview icon-fa-backspace" title="backspace - Solid"><i class="fa-backspace fas" data-name="backspace"></i></span>
                                        <span class="icon_preview icon-fa-backward" title="backward - Solid"><i class="fa-backward fas" data-name="backward"></i></span>
                                        <span class="icon_preview icon-fa-bacon" title="bacon - Solid"><i class="fa-bacon fas" data-name="bacon"></i></span>
                                        <span class="icon_preview icon-fa-balance-scale" title="balance-scale - Solid"><i class="fa-balance-scale fas" data-name="balance-scale"></i></span>
                                        <span class="icon_preview icon-fa-ban" title="ban - Solid"><i class="fa-ban fas" data-name="ban"></i></span>
                                        <span class="icon_preview icon-fa-band-aid" title="band-aid - Solid"><i class="fa-band-aid fas" data-name="band-aid"></i></span>
                                        <span class="icon_preview icon-fa-bandcamp" title="bandcamp - Brands"><i class="fa-bandcamp fab" data-name="bandcamp"></i></span>
                                        <span class="icon_preview icon-fa-barcode" title="barcode - Solid"><i class="fa-barcode fas" data-name="barcode"></i></span>
                                        <span class="icon_preview icon-fa-bars" title="bars - Solid"><i class="fa-bars fas" data-name="bars"></i></span>
                                        <span class="icon_preview icon-fa-baseball-ball" title="baseball-ball - Solid"><i class="fa-baseball-ball fas" data-name="baseball-ball"></i></span>
                                        <span class="icon_preview icon-fa-basketball-ball" title="basketball-ball - Solid"><i class="fa-basketball-ball fas" data-name="basketball-ball"></i></span>
                                        <span class="icon_preview icon-fa-bath" title="bath - Solid"><i class="fa-bath fas" data-name="bath"></i></span>
                                        <span class="icon_preview icon-fa-battery-empty" title="battery-empty - Solid"><i class="fa-battery-empty fas" data-name="battery-empty"></i></span>
                                        <span class="icon_preview icon-fa-battery-full" title="battery-full - Solid"><i class="fa-battery-full fas" data-name="battery-full"></i></span>
                                        <span class="icon_preview icon-fa-battery-half" title="battery-half - Solid"><i class="fa-battery-half fas" data-name="battery-half"></i></span>
                                        <span class="icon_preview icon-fa-battery-quarter" title="battery-quarter - Solid"><i class="fa-battery-quarter fas" data-name="battery-quarter"></i></span>
                                        <span class="icon_preview icon-fa-battery-three-quarters" title="battery-three-quarters - Solid"><i class="fa-battery-three-quarters fas" data-name="battery-three-quarters"></i></span>
                                        <span class="icon_preview icon-fa-bed" title="bed - Solid"><i class="fa-bed fas" data-name="bed"></i></span>
                                        <span class="icon_preview icon-fa-beer" title="beer - Solid"><i class="fa-beer fas" data-name="beer"></i></span>
                                        <span class="icon_preview icon-fa-behance" title="behance - Brands"><i class="fa-behance fab" data-name="behance"></i></span>
                                        <span class="icon_preview icon-fa-behance-square" title="behance-square - Brands"><i class="fa-behance-square fab" data-name="behance-square"></i></span>
                                        <span class="icon_preview icon-fa-bell" title="bell - Solid"><i class="fa-bell fas" data-name="bell"></i></span>
                                        <span class="icon_preview icon-fa-bell" title="bell - Regular"><i class="fa-bell far" data-name="bell"></i></span>
                                        <span class="icon_preview icon-fa-bell-slash" title="bell-slash - Solid"><i class="fa-bell-slash fas" data-name="bell-slash"></i></span>
                                        <span class="icon_preview icon-fa-bell-slash" title="bell-slash - Regular"><i class="fa-bell-slash far" data-name="bell-slash"></i></span>
                                        <span class="icon_preview icon-fa-bezier-curve" title="bezier-curve - Solid"><i class="fa-bezier-curve fas" data-name="bezier-curve"></i></span>
                                        <span class="icon_preview icon-fa-bible" title="bible - Solid"><i class="fa-bible fas" data-name="bible"></i></span>
                                        <span class="icon_preview icon-fa-bicycle" title="bicycle - Solid"><i class="fa-bicycle fas" data-name="bicycle"></i></span>
                                        <span class="icon_preview icon-fa-bimobject" title="bimobject - Brands"><i class="fa-bimobject fab" data-name="bimobject"></i></span>
                                        <span class="icon_preview icon-fa-binoculars" title="binoculars - Solid"><i class="fa-binoculars fas" data-name="binoculars"></i></span>
                                        <span class="icon_preview icon-fa-biohazard" title="biohazard - Solid"><i class="fa-biohazard fas" data-name="biohazard"></i></span>
                                        <span class="icon_preview icon-fa-birthday-cake" title="birthday-cake - Solid"><i class="fa-birthday-cake fas" data-name="birthday-cake"></i></span>
                                        <span class="icon_preview icon-fa-bitbucket" title="bitbucket - Brands"><i class="fa-bitbucket fab" data-name="bitbucket"></i></span>
                                        <span class="icon_preview icon-fa-bitcoin" title="bitcoin - Brands"><i class="fa-bitcoin fab" data-name="bitcoin"></i></span>
                                        <span class="icon_preview icon-fa-bity" title="bity - Brands"><i class="fa-bity fab" data-name="bity"></i></span>
                                        <span class="icon_preview icon-fa-black-tie" title="black-tie - Brands"><i class="fa-black-tie fab" data-name="black-tie"></i></span>
                                        <span class="icon_preview icon-fa-blackberry" title="blackberry - Brands"><i class="fa-blackberry fab" data-name="blackberry"></i></span>
                                        <span class="icon_preview icon-fa-blender" title="blender - Solid"><i class="fa-blender fas" data-name="blender"></i></span>
                                        <span class="icon_preview icon-fa-blender-phone" title="blender-phone - Solid"><i class="fa-blender-phone fas" data-name="blender-phone"></i></span>
                                        <span class="icon_preview icon-fa-blind" title="blind - Solid"><i class="fa-blind fas" data-name="blind"></i></span>
                                        <span class="icon_preview icon-fa-blog" title="blog - Solid"><i class="fa-blog fas" data-name="blog"></i></span>
                                        <span class="icon_preview icon-fa-blogger" title="blogger - Brands"><i class="fa-blogger fab" data-name="blogger"></i></span>
                                        <span class="icon_preview icon-fa-blogger-b" title="blogger-b - Brands"><i class="fa-blogger-b fab" data-name="blogger-b"></i></span>
                                        <span class="icon_preview icon-fa-bluetooth" title="bluetooth - Brands"><i class="fa-bluetooth fab" data-name="bluetooth"></i></span>
                                        <span class="icon_preview icon-fa-bluetooth-b" title="bluetooth-b - Brands"><i class="fa-bluetooth-b fab" data-name="bluetooth-b"></i></span>
                                        <span class="icon_preview icon-fa-bold" title="bold - Solid"><i class="fa-bold fas" data-name="bold"></i></span>
                                        <span class="icon_preview icon-fa-bolt" title="bolt - Solid"><i class="fa-bolt fas" data-name="bolt"></i></span>
                                        <span class="icon_preview icon-fa-bomb" title="bomb - Solid"><i class="fa-bomb fas" data-name="bomb"></i></span>
                                        <span class="icon_preview icon-fa-bone" title="bone - Solid"><i class="fa-bone fas" data-name="bone"></i></span>
                                        <span class="icon_preview icon-fa-bong" title="bong - Solid"><i class="fa-bong fas" data-name="bong"></i></span>
                                        <span class="icon_preview icon-fa-book" title="book - Solid"><i class="fa-book fas" data-name="book"></i></span>
                                        <span class="icon_preview icon-fa-book-dead" title="book-dead - Solid"><i class="fa-book-dead fas" data-name="book-dead"></i></span>
                                        <span class="icon_preview icon-fa-book-medical" title="book-medical - Solid"><i class="fa-book-medical fas" data-name="book-medical"></i></span>
                                        <span class="icon_preview icon-fa-book-open" title="book-open - Solid"><i class="fa-book-open fas" data-name="book-open"></i></span>
                                        <span class="icon_preview icon-fa-book-reader" title="book-reader - Solid"><i class="fa-book-reader fas" data-name="book-reader"></i></span>
                                        <span class="icon_preview icon-fa-bookmark" title="bookmark - Solid"><i class="fa-bookmark fas" data-name="bookmark"></i></span>
                                        <span class="icon_preview icon-fa-bookmark" title="bookmark - Regular"><i class="fa-bookmark far" data-name="bookmark"></i></span>
                                        <span class="icon_preview icon-fa-bowling-ball" title="bowling-ball - Solid"><i class="fa-bowling-ball fas" data-name="bowling-ball"></i></span>
                                        <span class="icon_preview icon-fa-box" title="box - Solid"><i class="fa-box fas" data-name="box"></i></span>
                                        <span class="icon_preview icon-fa-box-open" title="box-open - Solid"><i class="fa-box-open fas" data-name="box-open"></i></span>
                                        <span class="icon_preview icon-fa-boxes" title="boxes - Solid"><i class="fa-boxes fas" data-name="boxes"></i></span>
                                        <span class="icon_preview icon-fa-braille" title="braille - Solid"><i class="fa-braille fas" data-name="braille"></i></span>
                                        <span class="icon_preview icon-fa-brain" title="brain - Solid"><i class="fa-brain fas" data-name="brain"></i></span>
                                        <span class="icon_preview icon-fa-bread-slice" title="bread-slice - Solid"><i class="fa-bread-slice fas" data-name="bread-slice"></i></span>
                                        <span class="icon_preview icon-fa-briefcase" title="briefcase - Solid"><i class="fa-briefcase fas" data-name="briefcase"></i></span>
                                        <span class="icon_preview icon-fa-briefcase-medical" title="briefcase-medical - Solid"><i class="fa-briefcase-medical fas" data-name="briefcase-medical"></i></span>
                                        <span class="icon_preview icon-fa-broadcast-tower" title="broadcast-tower - Solid"><i class="fa-broadcast-tower fas" data-name="broadcast-tower"></i></span>
                                        <span class="icon_preview icon-fa-broom" title="broom - Solid"><i class="fa-broom fas" data-name="broom"></i></span>
                                        <span class="icon_preview icon-fa-brush" title="brush - Solid"><i class="fa-brush fas" data-name="brush"></i></span>
                                        <span class="icon_preview icon-fa-btc" title="btc - Brands"><i class="fa-btc fab" data-name="btc"></i></span>
                                        <span class="icon_preview icon-fa-bug" title="bug - Solid"><i class="fa-bug fas" data-name="bug"></i></span>
                                        <span class="icon_preview icon-fa-building" title="building - Solid"><i class="fa-building fas" data-name="building"></i></span>
                                        <span class="icon_preview icon-fa-building" title="building - Regular"><i class="fa-building far" data-name="building"></i></span>
                                        <span class="icon_preview icon-fa-bullhorn" title="bullhorn - Solid"><i class="fa-bullhorn fas" data-name="bullhorn"></i></span>
                                        <span class="icon_preview icon-fa-bullseye" title="bullseye - Solid"><i class="fa-bullseye fas" data-name="bullseye"></i></span>
                                        <span class="icon_preview icon-fa-burn" title="burn - Solid"><i class="fa-burn fas" data-name="burn"></i></span>
                                        <span class="icon_preview icon-fa-buromobelexperte" title="buromobelexperte - Brands"><i class="fa-buromobelexperte fab" data-name="buromobelexperte"></i></span>
                                        <span class="icon_preview icon-fa-bus" title="bus - Solid"><i class="fa-bus fas" data-name="bus"></i></span>
                                        <span class="icon_preview icon-fa-bus-alt" title="bus-alt - Solid"><i class="fa-bus-alt fas" data-name="bus-alt"></i></span>
                                        <span class="icon_preview icon-fa-business-time" title="business-time - Solid"><i class="fa-business-time fas" data-name="business-time"></i></span>
                                        <span class="icon_preview icon-fa-buysellads" title="buysellads - Brands"><i class="fa-buysellads fab" data-name="buysellads"></i></span>
                                        <span class="icon_preview icon-fa-calculator" title="calculator - Solid"><i class="fa-calculator fas" data-name="calculator"></i></span>
                                        <span class="icon_preview icon-fa-calendar" title="calendar - Solid"><i class="fa-calendar fas" data-name="calendar"></i></span>
                                        <span class="icon_preview icon-fa-calendar" title="calendar - Regular"><i class="fa-calendar far" data-name="calendar"></i></span>
                                        <span class="icon_preview icon-fa-calendar-alt" title="calendar-alt - Solid"><i class="fa-calendar-alt fas" data-name="calendar-alt"></i></span>
                                        <span class="icon_preview icon-fa-calendar-alt" title="calendar-alt - Regular"><i class="fa-calendar-alt far" data-name="calendar-alt"></i></span>
                                        <span class="icon_preview icon-fa-calendar-check" title="calendar-check - Solid"><i class="fa-calendar-check fas" data-name="calendar-check"></i></span>
                                        <span class="icon_preview icon-fa-calendar-check" title="calendar-check - Regular"><i class="fa-calendar-check far" data-name="calendar-check"></i></span>
                                        <span class="icon_preview icon-fa-calendar-day" title="calendar-day - Solid"><i class="fa-calendar-day fas" data-name="calendar-day"></i></span>
                                        <span class="icon_preview icon-fa-calendar-minus" title="calendar-minus - Solid"><i class="fa-calendar-minus fas" data-name="calendar-minus"></i></span>
                                        <span class="icon_preview icon-fa-calendar-minus" title="calendar-minus - Regular"><i class="fa-calendar-minus far" data-name="calendar-minus"></i></span>
                                        <span class="icon_preview icon-fa-calendar-plus" title="calendar-plus - Solid"><i class="fa-calendar-plus fas" data-name="calendar-plus"></i></span>
                                        <span class="icon_preview icon-fa-calendar-plus" title="calendar-plus - Regular"><i class="fa-calendar-plus far" data-name="calendar-plus"></i></span>
                                        <span class="icon_preview icon-fa-calendar-times" title="calendar-times - Solid"><i class="fa-calendar-times fas" data-name="calendar-times"></i></span>
                                        <span class="icon_preview icon-fa-calendar-times" title="calendar-times - Regular"><i class="fa-calendar-times far" data-name="calendar-times"></i></span>
                                        <span class="icon_preview icon-fa-calendar-week" title="calendar-week - Solid"><i class="fa-calendar-week fas" data-name="calendar-week"></i></span>
                                        <span class="icon_preview icon-fa-camera" title="camera - Solid"><i class="fa-camera fas" data-name="camera"></i></span>
                                        <span class="icon_preview icon-fa-camera-retro" title="camera-retro - Solid"><i class="fa-camera-retro fas" data-name="camera-retro"></i></span>
                                        <span class="icon_preview icon-fa-campground" title="campground - Solid"><i class="fa-campground fas" data-name="campground"></i></span>
                                        <span class="icon_preview icon-fa-canadian-maple-leaf" title="canadian-maple-leaf - Brands"><i class="fa-canadian-maple-leaf fab" data-name="canadian-maple-leaf"></i></span>
                                        <span class="icon_preview icon-fa-candy-cane" title="candy-cane - Solid"><i class="fa-candy-cane fas" data-name="candy-cane"></i></span>
                                        <span class="icon_preview icon-fa-cannabis" title="cannabis - Solid"><i class="fa-cannabis fas" data-name="cannabis"></i></span>
                                        <span class="icon_preview icon-fa-capsules" title="capsules - Solid"><i class="fa-capsules fas" data-name="capsules"></i></span>
                                        <span class="icon_preview icon-fa-car" title="car - Solid"><i class="fa-car fas" data-name="car"></i></span>
                                        <span class="icon_preview icon-fa-car-alt" title="car-alt - Solid"><i class="fa-car-alt fas" data-name="car-alt"></i></span>
                                        <span class="icon_preview icon-fa-car-battery" title="car-battery - Solid"><i class="fa-car-battery fas" data-name="car-battery"></i></span>
                                        <span class="icon_preview icon-fa-car-crash" title="car-crash - Solid"><i class="fa-car-crash fas" data-name="car-crash"></i></span>
                                        <span class="icon_preview icon-fa-car-side" title="car-side - Solid"><i class="fa-car-side fas" data-name="car-side"></i></span>
                                        <span class="icon_preview icon-fa-caret-down" title="caret-down - Solid"><i class="fa-caret-down fas" data-name="caret-down"></i></span>
                                        <span class="icon_preview icon-fa-caret-left" title="caret-left - Solid"><i class="fa-caret-left fas" data-name="caret-left"></i></span>
                                        <span class="icon_preview icon-fa-caret-right" title="caret-right - Solid"><i class="fa-caret-right fas" data-name="caret-right"></i></span>
                                        <span class="icon_preview icon-fa-caret-square-down" title="caret-square-down - Solid"><i class="fa-caret-square-down fas" data-name="caret-square-down"></i></span>
                                        <span class="icon_preview icon-fa-caret-square-down" title="caret-square-down - Regular"><i class="fa-caret-square-down far" data-name="caret-square-down"></i></span>
                                        <span class="icon_preview icon-fa-caret-square-left" title="caret-square-left - Solid"><i class="fa-caret-square-left fas" data-name="caret-square-left"></i></span>
                                        <span class="icon_preview icon-fa-caret-square-left" title="caret-square-left - Regular"><i class="fa-caret-square-left far" data-name="caret-square-left"></i></span>
                                        <span class="icon_preview icon-fa-caret-square-right" title="caret-square-right - Solid"><i class="fa-caret-square-right fas" data-name="caret-square-right"></i></span>
                                        <span class="icon_preview icon-fa-caret-square-right" title="caret-square-right - Regular"><i class="fa-caret-square-right far" data-name="caret-square-right"></i></span>
                                        <span class="icon_preview icon-fa-caret-square-up" title="caret-square-up - Solid"><i class="fa-caret-square-up fas" data-name="caret-square-up"></i></span>
                                        <span class="icon_preview icon-fa-caret-square-up" title="caret-square-up - Regular"><i class="fa-caret-square-up far" data-name="caret-square-up"></i></span>
                                        <span class="icon_preview icon-fa-caret-up" title="caret-up - Solid"><i class="fa-caret-up fas" data-name="caret-up"></i></span>
                                        <span class="icon_preview icon-fa-carrot" title="carrot - Solid"><i class="fa-carrot fas" data-name="carrot"></i></span>
                                        <span class="icon_preview icon-fa-cart-arrow-down" title="cart-arrow-down - Solid"><i class="fa-cart-arrow-down fas" data-name="cart-arrow-down"></i></span>
                                        <span class="icon_preview icon-fa-cart-plus" title="cart-plus - Solid"><i class="fa-cart-plus fas" data-name="cart-plus"></i></span>
                                        <span class="icon_preview icon-fa-cash-register" title="cash-register - Solid"><i class="fa-cash-register fas" data-name="cash-register"></i></span>
                                        <span class="icon_preview icon-fa-cat" title="cat - Solid"><i class="fa-cat fas" data-name="cat"></i></span>
                                        <span class="icon_preview icon-fa-cc-amazon-pay" title="cc-amazon-pay - Brands"><i class="fa-cc-amazon-pay fab" data-name="cc-amazon-pay"></i></span>
                                        <span class="icon_preview icon-fa-cc-amex" title="cc-amex - Brands"><i class="fa-cc-amex fab" data-name="cc-amex"></i></span>
                                        <span class="icon_preview icon-fa-cc-apple-pay" title="cc-apple-pay - Brands"><i class="fa-cc-apple-pay fab" data-name="cc-apple-pay"></i></span>
                                        <span class="icon_preview icon-fa-cc-diners-club" title="cc-diners-club - Brands"><i class="fa-cc-diners-club fab" data-name="cc-diners-club"></i></span>
                                        <span class="icon_preview icon-fa-cc-discover" title="cc-discover - Brands"><i class="fa-cc-discover fab" data-name="cc-discover"></i></span>
                                        <span class="icon_preview icon-fa-cc-jcb" title="cc-jcb - Brands"><i class="fa-cc-jcb fab" data-name="cc-jcb"></i></span>
                                        <span class="icon_preview icon-fa-cc-mastercard" title="cc-mastercard - Brands"><i class="fa-cc-mastercard fab" data-name="cc-mastercard"></i></span>
                                        <span class="icon_preview icon-fa-cc-paypal" title="cc-paypal - Brands"><i class="fa-cc-paypal fab" data-name="cc-paypal"></i></span>
                                        <span class="icon_preview icon-fa-cc-stripe" title="cc-stripe - Brands"><i class="fa-cc-stripe fab" data-name="cc-stripe"></i></span>
                                        <span class="icon_preview icon-fa-cc-visa" title="cc-visa - Brands"><i class="fa-cc-visa fab" data-name="cc-visa"></i></span>
                                        <span class="icon_preview icon-fa-centercode" title="centercode - Brands"><i class="fa-centercode fab" data-name="centercode"></i></span>
                                        <span class="icon_preview icon-fa-centos" title="centos - Brands"><i class="fa-centos fab" data-name="centos"></i></span>
                                        <span class="icon_preview icon-fa-certificate" title="certificate - Solid"><i class="fa-certificate fas" data-name="certificate"></i></span>
                                        <span class="icon_preview icon-fa-chair" title="chair - Solid"><i class="fa-chair fas" data-name="chair"></i></span>
                                        <span class="icon_preview icon-fa-chalkboard" title="chalkboard - Solid"><i class="fa-chalkboard fas" data-name="chalkboard"></i></span>
                                        <span class="icon_preview icon-fa-chalkboard-teacher" title="chalkboard-teacher - Solid"><i class="fa-chalkboard-teacher fas" data-name="chalkboard-teacher"></i></span>
                                        <span class="icon_preview icon-fa-charging-station" title="charging-station - Solid"><i class="fa-charging-station fas" data-name="charging-station"></i></span>
                                        <span class="icon_preview icon-fa-chart-area" title="chart-area - Solid"><i class="fa-chart-area fas" data-name="chart-area"></i></span>
                                        <span class="icon_preview icon-fa-chart-bar" title="chart-bar - Solid"><i class="fa-chart-bar fas" data-name="chart-bar"></i></span>
                                        <span class="icon_preview icon-fa-chart-bar" title="chart-bar - Regular"><i class="fa-chart-bar far" data-name="chart-bar"></i></span>
                                        <span class="icon_preview icon-fa-chart-line" title="chart-line - Solid"><i class="fa-chart-line fas" data-name="chart-line"></i></span>
                                        <span class="icon_preview icon-fa-chart-pie" title="chart-pie - Solid"><i class="fa-chart-pie fas" data-name="chart-pie"></i></span>
                                        <span class="icon_preview icon-fa-check" title="check - Solid"><i class="fa-check fas" data-name="check"></i></span>
                                        <span class="icon_preview icon-fa-check-circle" title="check-circle - Solid"><i class="fa-check-circle fas" data-name="check-circle"></i></span>
                                        <span class="icon_preview icon-fa-check-circle" title="check-circle - Regular"><i class="fa-check-circle far" data-name="check-circle"></i></span>
                                        <span class="icon_preview icon-fa-check-double" title="check-double - Solid"><i class="fa-check-double fas" data-name="check-double"></i></span>
                                        <span class="icon_preview icon-fa-check-square" title="check-square - Solid"><i class="fa-check-square fas" data-name="check-square"></i></span>
                                        <span class="icon_preview icon-fa-check-square" title="check-square - Regular"><i class="fa-check-square far" data-name="check-square"></i></span>
                                        <span class="icon_preview icon-fa-cheese" title="cheese - Solid"><i class="fa-cheese fas" data-name="cheese"></i></span>
                                        <span class="icon_preview icon-fa-chess" title="chess - Solid"><i class="fa-chess fas" data-name="chess"></i></span>
                                        <span class="icon_preview icon-fa-chess-bishop" title="chess-bishop - Solid"><i class="fa-chess-bishop fas" data-name="chess-bishop"></i></span>
                                        <span class="icon_preview icon-fa-chess-board" title="chess-board - Solid"><i class="fa-chess-board fas" data-name="chess-board"></i></span>
                                        <span class="icon_preview icon-fa-chess-king" title="chess-king - Solid"><i class="fa-chess-king fas" data-name="chess-king"></i></span>
                                        <span class="icon_preview icon-fa-chess-knight" title="chess-knight - Solid"><i class="fa-chess-knight fas" data-name="chess-knight"></i></span>
                                        <span class="icon_preview icon-fa-chess-pawn" title="chess-pawn - Solid"><i class="fa-chess-pawn fas" data-name="chess-pawn"></i></span>
                                        <span class="icon_preview icon-fa-chess-queen" title="chess-queen - Solid"><i class="fa-chess-queen fas" data-name="chess-queen"></i></span>
                                        <span class="icon_preview icon-fa-chess-rook" title="chess-rook - Solid"><i class="fa-chess-rook fas" data-name="chess-rook"></i></span>
                                        <span class="icon_preview icon-fa-chevron-circle-down" title="chevron-circle-down - Solid"><i class="fa-chevron-circle-down fas" data-name="chevron-circle-down"></i></span>
                                        <span class="icon_preview icon-fa-chevron-circle-left" title="chevron-circle-left - Solid"><i class="fa-chevron-circle-left fas" data-name="chevron-circle-left"></i></span>
                                        <span class="icon_preview icon-fa-chevron-circle-right" title="chevron-circle-right - Solid"><i class="fa-chevron-circle-right fas" data-name="chevron-circle-right"></i></span>
                                        <span class="icon_preview icon-fa-chevron-circle-up" title="chevron-circle-up - Solid"><i class="fa-chevron-circle-up fas" data-name="chevron-circle-up"></i></span>
                                        <span class="icon_preview icon-fa-chevron-down" title="chevron-down - Solid"><i class="fa-chevron-down fas" data-name="chevron-down"></i></span>
                                        <span class="icon_preview icon-fa-chevron-left" title="chevron-left - Solid"><i class="fa-chevron-left fas" data-name="chevron-left"></i></span>
                                        <span class="icon_preview icon-fa-chevron-right" title="chevron-right - Solid"><i class="fa-chevron-right fas" data-name="chevron-right"></i></span>
                                        <span class="icon_preview icon-fa-chevron-up" title="chevron-up - Solid"><i class="fa-chevron-up fas" data-name="chevron-up"></i></span>
                                        <span class="icon_preview icon-fa-child" title="child - Solid"><i class="fa-child fas" data-name="child"></i></span>
                                        <span class="icon_preview icon-fa-chrome" title="chrome - Brands"><i class="fa-chrome fab" data-name="chrome"></i></span>
                                        <span class="icon_preview icon-fa-church" title="church - Solid"><i class="fa-church fas" data-name="church"></i></span>
                                        <span class="icon_preview icon-fa-circle" title="circle - Solid"><i class="fa-circle fas" data-name="circle"></i></span>
                                        <span class="icon_preview icon-fa-circle" title="circle - Regular"><i class="fa-circle far" data-name="circle"></i></span>
                                        <span class="icon_preview icon-fa-circle-notch" title="circle-notch - Solid"><i class="fa-circle-notch fas" data-name="circle-notch"></i></span>
                                        <span class="icon_preview icon-fa-city" title="city - Solid"><i class="fa-city fas" data-name="city"></i></span>
                                        <span class="icon_preview icon-fa-clinic-medical" title="clinic-medical - Solid"><i class="fa-clinic-medical fas" data-name="clinic-medical"></i></span>
                                        <span class="icon_preview icon-fa-clipboard" title="clipboard - Solid"><i class="fa-clipboard fas" data-name="clipboard"></i></span>
                                        <span class="icon_preview icon-fa-clipboard" title="clipboard - Regular"><i class="fa-clipboard far" data-name="clipboard"></i></span>
                                        <span class="icon_preview icon-fa-clipboard-check" title="clipboard-check - Solid"><i class="fa-clipboard-check fas" data-name="clipboard-check"></i></span>
                                        <span class="icon_preview icon-fa-clipboard-list" title="clipboard-list - Solid"><i class="fa-clipboard-list fas" data-name="clipboard-list"></i></span>
                                        <span class="icon_preview icon-fa-clock" title="clock - Solid"><i class="fa-clock fas" data-name="clock"></i></span>
                                        <span class="icon_preview icon-fa-clock" title="clock - Regular"><i class="fa-clock far" data-name="clock"></i></span>
                                        <span class="icon_preview icon-fa-clone" title="clone - Solid"><i class="fa-clone fas" data-name="clone"></i></span>
                                        <span class="icon_preview icon-fa-clone" title="clone - Regular"><i class="fa-clone far" data-name="clone"></i></span>
                                        <span class="icon_preview icon-fa-closed-captioning" title="closed-captioning - Solid"><i class="fa-closed-captioning fas" data-name="closed-captioning"></i></span>
                                        <span class="icon_preview icon-fa-closed-captioning" title="closed-captioning - Regular"><i class="fa-closed-captioning far" data-name="closed-captioning"></i></span>
                                        <span class="icon_preview icon-fa-cloud" title="cloud - Solid"><i class="fa-cloud fas" data-name="cloud"></i></span>
                                        <span class="icon_preview icon-fa-cloud-download-alt" title="cloud-download-alt - Solid"><i class="fa-cloud-download-alt fas" data-name="cloud-download-alt"></i></span>
                                        <span class="icon_preview icon-fa-cloud-meatball" title="cloud-meatball - Solid"><i class="fa-cloud-meatball fas" data-name="cloud-meatball"></i></span>
                                        <span class="icon_preview icon-fa-cloud-moon" title="cloud-moon - Solid"><i class="fa-cloud-moon fas" data-name="cloud-moon"></i></span>
                                        <span class="icon_preview icon-fa-cloud-moon-rain" title="cloud-moon-rain - Solid"><i class="fa-cloud-moon-rain fas" data-name="cloud-moon-rain"></i></span>
                                        <span class="icon_preview icon-fa-cloud-rain" title="cloud-rain - Solid"><i class="fa-cloud-rain fas" data-name="cloud-rain"></i></span>
                                        <span class="icon_preview icon-fa-cloud-showers-heavy" title="cloud-showers-heavy - Solid"><i class="fa-cloud-showers-heavy fas" data-name="cloud-showers-heavy"></i></span>
                                        <span class="icon_preview icon-fa-cloud-sun" title="cloud-sun - Solid"><i class="fa-cloud-sun fas" data-name="cloud-sun"></i></span>
                                        <span class="icon_preview icon-fa-cloud-sun-rain" title="cloud-sun-rain - Solid"><i class="fa-cloud-sun-rain fas" data-name="cloud-sun-rain"></i></span>
                                        <span class="icon_preview icon-fa-cloud-upload-alt" title="cloud-upload-alt - Solid"><i class="fa-cloud-upload-alt fas" data-name="cloud-upload-alt"></i></span>
                                        <span class="icon_preview icon-fa-cloudscale" title="cloudscale - Brands"><i class="fa-cloudscale fab" data-name="cloudscale"></i></span>
                                        <span class="icon_preview icon-fa-cloudsmith" title="cloudsmith - Brands"><i class="fa-cloudsmith fab" data-name="cloudsmith"></i></span>
                                        <span class="icon_preview icon-fa-cloudversify" title="cloudversify - Brands"><i class="fa-cloudversify fab" data-name="cloudversify"></i></span>
                                        <span class="icon_preview icon-fa-cocktail" title="cocktail - Solid"><i class="fa-cocktail fas" data-name="cocktail"></i></span>
                                        <span class="icon_preview icon-fa-code" title="code - Solid"><i class="fa-code fas" data-name="code"></i></span>
                                        <span class="icon_preview icon-fa-code-branch" title="code-branch - Solid"><i class="fa-code-branch fas" data-name="code-branch"></i></span>
                                        <span class="icon_preview icon-fa-codepen" title="codepen - Brands"><i class="fa-codepen fab" data-name="codepen"></i></span>
                                        <span class="icon_preview icon-fa-codiepie" title="codiepie - Brands"><i class="fa-codiepie fab" data-name="codiepie"></i></span>
                                        <span class="icon_preview icon-fa-coffee" title="coffee - Solid"><i class="fa-coffee fas" data-name="coffee"></i></span>
                                        <span class="icon_preview icon-fa-cog" title="cog - Solid"><i class="fa-cog fas" data-name="cog"></i></span>
                                        <span class="icon_preview icon-fa-cogs" title="cogs - Solid"><i class="fa-cogs fas" data-name="cogs"></i></span>
                                        <span class="icon_preview icon-fa-coins" title="coins - Solid"><i class="fa-coins fas" data-name="coins"></i></span>
                                        <span class="icon_preview icon-fa-columns" title="columns - Solid"><i class="fa-columns fas" data-name="columns"></i></span>
                                        <span class="icon_preview icon-fa-comment" title="comment - Solid"><i class="fa-comment fas" data-name="comment"></i></span>
                                        <span class="icon_preview icon-fa-comment" title="comment - Regular"><i class="fa-comment far" data-name="comment"></i></span>
                                        <span class="icon_preview icon-fa-comment-alt" title="comment-alt - Solid"><i class="fa-comment-alt fas" data-name="comment-alt"></i></span>
                                        <span class="icon_preview icon-fa-comment-alt" title="comment-alt - Regular"><i class="fa-comment-alt far" data-name="comment-alt"></i></span>
                                        <span class="icon_preview icon-fa-comment-dollar" title="comment-dollar - Solid"><i class="fa-comment-dollar fas" data-name="comment-dollar"></i></span>
                                        <span class="icon_preview icon-fa-comment-dots" title="comment-dots - Solid"><i class="fa-comment-dots fas" data-name="comment-dots"></i></span>
                                        <span class="icon_preview icon-fa-comment-dots" title="comment-dots - Regular"><i class="fa-comment-dots far" data-name="comment-dots"></i></span>
                                        <span class="icon_preview icon-fa-comment-medical" title="comment-medical - Solid"><i class="fa-comment-medical fas" data-name="comment-medical"></i></span>
                                        <span class="icon_preview icon-fa-comment-slash" title="comment-slash - Solid"><i class="fa-comment-slash fas" data-name="comment-slash"></i></span>
                                        <span class="icon_preview icon-fa-comments" title="comments - Solid"><i class="fa-comments fas" data-name="comments"></i></span>
                                        <span class="icon_preview icon-fa-comments" title="comments - Regular"><i class="fa-comments far" data-name="comments"></i></span>
                                        <span class="icon_preview icon-fa-comments-dollar" title="comments-dollar - Solid"><i class="fa-comments-dollar fas" data-name="comments-dollar"></i></span>
                                        <span class="icon_preview icon-fa-compact-disc" title="compact-disc - Solid"><i class="fa-compact-disc fas" data-name="compact-disc"></i></span>
                                        <span class="icon_preview icon-fa-compass" title="compass - Solid"><i class="fa-compass fas" data-name="compass"></i></span>
                                        <span class="icon_preview icon-fa-compass" title="compass - Regular"><i class="fa-compass far" data-name="compass"></i></span>
                                        <span class="icon_preview icon-fa-compress" title="compress - Solid"><i class="fa-compress fas" data-name="compress"></i></span>
                                        <span class="icon_preview icon-fa-compress-arrows-alt" title="compress-arrows-alt - Solid"><i class="fa-compress-arrows-alt fas" data-name="compress-arrows-alt"></i></span>
                                        <span class="icon_preview icon-fa-concierge-bell" title="concierge-bell - Solid"><i class="fa-concierge-bell fas" data-name="concierge-bell"></i></span>
                                        <span class="icon_preview icon-fa-confluence" title="confluence - Brands"><i class="fa-confluence fab" data-name="confluence"></i></span>
                                        <span class="icon_preview icon-fa-connectdevelop" title="connectdevelop - Brands"><i class="fa-connectdevelop fab" data-name="connectdevelop"></i></span>
                                        <span class="icon_preview icon-fa-contao" title="contao - Brands"><i class="fa-contao fab" data-name="contao"></i></span>
                                        <span class="icon_preview icon-fa-cookie" title="cookie - Solid"><i class="fa-cookie fas" data-name="cookie"></i></span>
                                        <span class="icon_preview icon-fa-cookie-bite" title="cookie-bite - Solid"><i class="fa-cookie-bite fas" data-name="cookie-bite"></i></span>
                                        <span class="icon_preview icon-fa-copy" title="copy - Solid"><i class="fa-copy fas" data-name="copy"></i></span>
                                        <span class="icon_preview icon-fa-copy" title="copy - Regular"><i class="fa-copy far" data-name="copy"></i></span>
                                        <span class="icon_preview icon-fa-copyright" title="copyright - Solid"><i class="fa-copyright fas" data-name="copyright"></i></span>
                                        <span class="icon_preview icon-fa-copyright" title="copyright - Regular"><i class="fa-copyright far" data-name="copyright"></i></span>
                                        <span class="icon_preview icon-fa-couch" title="couch - Solid"><i class="fa-couch fas" data-name="couch"></i></span>
                                        <span class="icon_preview icon-fa-cpanel" title="cpanel - Brands"><i class="fa-cpanel fab" data-name="cpanel"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons" title="creative-commons - Brands"><i class="fa-creative-commons fab" data-name="creative-commons"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-by" title="creative-commons-by - Brands"><i class="fa-creative-commons-by fab" data-name="creative-commons-by"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-nc" title="creative-commons-nc - Brands"><i class="fa-creative-commons-nc fab" data-name="creative-commons-nc"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-nc-eu" title="creative-commons-nc-eu - Brands"><i class="fa-creative-commons-nc-eu fab" data-name="creative-commons-nc-eu"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-nc-jp" title="creative-commons-nc-jp - Brands"><i class="fa-creative-commons-nc-jp fab" data-name="creative-commons-nc-jp"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-nd" title="creative-commons-nd - Brands"><i class="fa-creative-commons-nd fab" data-name="creative-commons-nd"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-pd" title="creative-commons-pd - Brands"><i class="fa-creative-commons-pd fab" data-name="creative-commons-pd"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-pd-alt" title="creative-commons-pd-alt - Brands"><i class="fa-creative-commons-pd-alt fab" data-name="creative-commons-pd-alt"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-remix" title="creative-commons-remix - Brands"><i class="fa-creative-commons-remix fab" data-name="creative-commons-remix"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-sa" title="creative-commons-sa - Brands"><i class="fa-creative-commons-sa fab" data-name="creative-commons-sa"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-sampling" title="creative-commons-sampling - Brands"><i class="fa-creative-commons-sampling fab" data-name="creative-commons-sampling"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-sampling-plus" title="creative-commons-sampling-plus - Brands"><i class="fa-creative-commons-sampling-plus fab" data-name="creative-commons-sampling-plus"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-share" title="creative-commons-share - Brands"><i class="fa-creative-commons-share fab" data-name="creative-commons-share"></i></span>
                                        <span class="icon_preview icon-fa-creative-commons-zero" title="creative-commons-zero - Brands"><i class="fa-creative-commons-zero fab" data-name="creative-commons-zero"></i></span>
                                        <span class="icon_preview icon-fa-credit-card" title="credit-card - Solid"><i class="fa-credit-card fas" data-name="credit-card"></i></span>
                                        <span class="icon_preview icon-fa-credit-card" title="credit-card - Regular"><i class="fa-credit-card far" data-name="credit-card"></i></span>
                                        <span class="icon_preview icon-fa-critical-role" title="critical-role - Brands"><i class="fa-critical-role fab" data-name="critical-role"></i></span>
                                        <span class="icon_preview icon-fa-crop" title="crop - Solid"><i class="fa-crop fas" data-name="crop"></i></span>
                                        <span class="icon_preview icon-fa-crop-alt" title="crop-alt - Solid"><i class="fa-crop-alt fas" data-name="crop-alt"></i></span>
                                        <span class="icon_preview icon-fa-cross" title="cross - Solid"><i class="fa-cross fas" data-name="cross"></i></span>
                                        <span class="icon_preview icon-fa-crosshairs" title="crosshairs - Solid"><i class="fa-crosshairs fas" data-name="crosshairs"></i></span>
                                        <span class="icon_preview icon-fa-crow" title="crow - Solid"><i class="fa-crow fas" data-name="crow"></i></span>
                                        <span class="icon_preview icon-fa-crown" title="crown - Solid"><i class="fa-crown fas" data-name="crown"></i></span>
                                        <span class="icon_preview icon-fa-crutch" title="crutch - Solid"><i class="fa-crutch fas" data-name="crutch"></i></span>
                                        <span class="icon_preview icon-fa-css3" title="css3 - Brands"><i class="fa-css3 fab" data-name="css3"></i></span>
                                        <span class="icon_preview icon-fa-css3-alt" title="css3-alt - Brands"><i class="fa-css3-alt fab" data-name="css3-alt"></i></span>
                                        <span class="icon_preview icon-fa-cube" title="cube - Solid"><i class="fa-cube fas" data-name="cube"></i></span>
                                        <span class="icon_preview icon-fa-cubes" title="cubes - Solid"><i class="fa-cubes fas" data-name="cubes"></i></span>
                                        <span class="icon_preview icon-fa-cut" title="cut - Solid"><i class="fa-cut fas" data-name="cut"></i></span>
                                        <span class="icon_preview icon-fa-cuttlefish" title="cuttlefish - Brands"><i class="fa-cuttlefish fab" data-name="cuttlefish"></i></span>
                                        <span class="icon_preview icon-fa-d-and-d" title="d-and-d - Brands"><i class="fa-d-and-d fab" data-name="d-and-d"></i></span>
                                        <span class="icon_preview icon-fa-d-and-d-beyond" title="d-and-d-beyond - Brands"><i class="fa-d-and-d-beyond fab" data-name="d-and-d-beyond"></i></span>
                                        <span class="icon_preview icon-fa-dashcube" title="dashcube - Brands"><i class="fa-dashcube fab" data-name="dashcube"></i></span>
                                        <span class="icon_preview icon-fa-database" title="database - Solid"><i class="fa-database fas" data-name="database"></i></span>
                                        <span class="icon_preview icon-fa-deaf" title="deaf - Solid"><i class="fa-deaf fas" data-name="deaf"></i></span>
                                        <span class="icon_preview icon-fa-delicious" title="delicious - Brands"><i class="fa-delicious fab" data-name="delicious"></i></span>
                                        <span class="icon_preview icon-fa-democrat" title="democrat - Solid"><i class="fa-democrat fas" data-name="democrat"></i></span>
                                        <span class="icon_preview icon-fa-deploydog" title="deploydog - Brands"><i class="fa-deploydog fab" data-name="deploydog"></i></span>
                                        <span class="icon_preview icon-fa-deskpro" title="deskpro - Brands"><i class="fa-deskpro fab" data-name="deskpro"></i></span>
                                        <span class="icon_preview icon-fa-desktop" title="desktop - Solid"><i class="fa-desktop fas" data-name="desktop"></i></span>
                                        <span class="icon_preview icon-fa-dev" title="dev - Brands"><i class="fa-dev fab" data-name="dev"></i></span>
                                        <span class="icon_preview icon-fa-deviantart" title="deviantart - Brands"><i class="fa-deviantart fab" data-name="deviantart"></i></span>
                                        <span class="icon_preview icon-fa-dharmachakra" title="dharmachakra - Solid"><i class="fa-dharmachakra fas" data-name="dharmachakra"></i></span>
                                        <span class="icon_preview icon-fa-dhl" title="dhl - Brands"><i class="fa-dhl fab" data-name="dhl"></i></span>
                                        <span class="icon_preview icon-fa-diagnoses" title="diagnoses - Solid"><i class="fa-diagnoses fas" data-name="diagnoses"></i></span>
                                        <span class="icon_preview icon-fa-diaspora" title="diaspora - Brands"><i class="fa-diaspora fab" data-name="diaspora"></i></span>
                                        <span class="icon_preview icon-fa-dice" title="dice - Solid"><i class="fa-dice fas" data-name="dice"></i></span>
                                        <span class="icon_preview icon-fa-dice-d20" title="dice-d20 - Solid"><i class="fa-dice-d20 fas" data-name="dice-d20"></i></span>
                                        <span class="icon_preview icon-fa-dice-d6" title="dice-d6 - Solid"><i class="fa-dice-d6 fas" data-name="dice-d6"></i></span>
                                        <span class="icon_preview icon-fa-dice-five" title="dice-five - Solid"><i class="fa-dice-five fas" data-name="dice-five"></i></span>
                                        <span class="icon_preview icon-fa-dice-four" title="dice-four - Solid"><i class="fa-dice-four fas" data-name="dice-four"></i></span>
                                        <span class="icon_preview icon-fa-dice-one" title="dice-one - Solid"><i class="fa-dice-one fas" data-name="dice-one"></i></span>
                                        <span class="icon_preview icon-fa-dice-six" title="dice-six - Solid"><i class="fa-dice-six fas" data-name="dice-six"></i></span>
                                        <span class="icon_preview icon-fa-dice-three" title="dice-three - Solid"><i class="fa-dice-three fas" data-name="dice-three"></i></span>
                                        <span class="icon_preview icon-fa-dice-two" title="dice-two - Solid"><i class="fa-dice-two fas" data-name="dice-two"></i></span>
                                        <span class="icon_preview icon-fa-digg" title="digg - Brands"><i class="fa-digg fab" data-name="digg"></i></span>
                                        <span class="icon_preview icon-fa-digital-ocean" title="digital-ocean - Brands"><i class="fa-digital-ocean fab" data-name="digital-ocean"></i></span>
                                        <span class="icon_preview icon-fa-digital-tachograph" title="digital-tachograph - Solid"><i class="fa-digital-tachograph fas" data-name="digital-tachograph"></i></span>
                                        <span class="icon_preview icon-fa-directions" title="directions - Solid"><i class="fa-directions fas" data-name="directions"></i></span>
                                        <span class="icon_preview icon-fa-discord" title="discord - Brands"><i class="fa-discord fab" data-name="discord"></i></span>
                                        <span class="icon_preview icon-fa-discourse" title="discourse - Brands"><i class="fa-discourse fab" data-name="discourse"></i></span>
                                        <span class="icon_preview icon-fa-divide" title="divide - Solid"><i class="fa-divide fas" data-name="divide"></i></span>
                                        <span class="icon_preview icon-fa-dizzy" title="dizzy - Solid"><i class="fa-dizzy fas" data-name="dizzy"></i></span>
                                        <span class="icon_preview icon-fa-dizzy" title="dizzy - Regular"><i class="fa-dizzy far" data-name="dizzy"></i></span>
                                        <span class="icon_preview icon-fa-dna" title="dna - Solid"><i class="fa-dna fas" data-name="dna"></i></span>
                                        <span class="icon_preview icon-fa-dochub" title="dochub - Brands"><i class="fa-dochub fab" data-name="dochub"></i></span>
                                        <span class="icon_preview icon-fa-docker" title="docker - Brands"><i class="fa-docker fab" data-name="docker"></i></span>
                                        <span class="icon_preview icon-fa-dog" title="dog - Solid"><i class="fa-dog fas" data-name="dog"></i></span>
                                        <span class="icon_preview icon-fa-dollar-sign" title="dollar-sign - Solid"><i class="fa-dollar-sign fas" data-name="dollar-sign"></i></span>
                                        <span class="icon_preview icon-fa-dolly" title="dolly - Solid"><i class="fa-dolly fas" data-name="dolly"></i></span>
                                        <span class="icon_preview icon-fa-dolly-flatbed" title="dolly-flatbed - Solid"><i class="fa-dolly-flatbed fas" data-name="dolly-flatbed"></i></span>
                                        <span class="icon_preview icon-fa-donate" title="donate - Solid"><i class="fa-donate fas" data-name="donate"></i></span>
                                        <span class="icon_preview icon-fa-door-closed" title="door-closed - Solid"><i class="fa-door-closed fas" data-name="door-closed"></i></span>
                                        <span class="icon_preview icon-fa-door-open" title="door-open - Solid"><i class="fa-door-open fas" data-name="door-open"></i></span>
                                        <span class="icon_preview icon-fa-dot-circle" title="dot-circle - Solid"><i class="fa-dot-circle fas" data-name="dot-circle"></i></span>
                                        <span class="icon_preview icon-fa-dot-circle" title="dot-circle - Regular"><i class="fa-dot-circle far" data-name="dot-circle"></i></span>
                                        <span class="icon_preview icon-fa-dove" title="dove - Solid"><i class="fa-dove fas" data-name="dove"></i></span>
                                        <span class="icon_preview icon-fa-download" title="download - Solid"><i class="fa-download fas" data-name="download"></i></span>
                                        <span class="icon_preview icon-fa-draft2digital" title="draft2digital - Brands"><i class="fa-draft2digital fab" data-name="draft2digital"></i></span>
                                        <span class="icon_preview icon-fa-drafting-compass" title="drafting-compass - Solid"><i class="fa-drafting-compass fas" data-name="drafting-compass"></i></span>
                                        <span class="icon_preview icon-fa-dragon" title="dragon - Solid"><i class="fa-dragon fas" data-name="dragon"></i></span>
                                        <span class="icon_preview icon-fa-draw-polygon" title="draw-polygon - Solid"><i class="fa-draw-polygon fas" data-name="draw-polygon"></i></span>
                                        <span class="icon_preview icon-fa-dribbble" title="dribbble - Brands"><i class="fa-dribbble fab" data-name="dribbble"></i></span>
                                        <span class="icon_preview icon-fa-dribbble-square" title="dribbble-square - Brands"><i class="fa-dribbble-square fab" data-name="dribbble-square"></i></span>
                                        <span class="icon_preview icon-fa-dropbox" title="dropbox - Brands"><i class="fa-dropbox fab" data-name="dropbox"></i></span>
                                        <span class="icon_preview icon-fa-drum" title="drum - Solid"><i class="fa-drum fas" data-name="drum"></i></span>
                                        <span class="icon_preview icon-fa-drum-steelpan" title="drum-steelpan - Solid"><i class="fa-drum-steelpan fas" data-name="drum-steelpan"></i></span>
                                        <span class="icon_preview icon-fa-drumstick-bite" title="drumstick-bite - Solid"><i class="fa-drumstick-bite fas" data-name="drumstick-bite"></i></span>
                                        <span class="icon_preview icon-fa-drupal" title="drupal - Brands"><i class="fa-drupal fab" data-name="drupal"></i></span>
                                        <span class="icon_preview icon-fa-dumbbell" title="dumbbell - Solid"><i class="fa-dumbbell fas" data-name="dumbbell"></i></span>
                                        <span class="icon_preview icon-fa-dumpster" title="dumpster - Solid"><i class="fa-dumpster fas" data-name="dumpster"></i></span>
                                        <span class="icon_preview icon-fa-dumpster-fire" title="dumpster-fire - Solid"><i class="fa-dumpster-fire fas" data-name="dumpster-fire"></i></span>
                                        <span class="icon_preview icon-fa-dungeon" title="dungeon - Solid"><i class="fa-dungeon fas" data-name="dungeon"></i></span>
                                        <span class="icon_preview icon-fa-dyalog" title="dyalog - Brands"><i class="fa-dyalog fab" data-name="dyalog"></i></span>
                                        <span class="icon_preview icon-fa-earlybirds" title="earlybirds - Brands"><i class="fa-earlybirds fab" data-name="earlybirds"></i></span>
                                        <span class="icon_preview icon-fa-ebay" title="ebay - Brands"><i class="fa-ebay fab" data-name="ebay"></i></span>
                                        <span class="icon_preview icon-fa-edge" title="edge - Brands"><i class="fa-edge fab" data-name="edge"></i></span>
                                        <span class="icon_preview icon-fa-edit" title="edit - Solid"><i class="fa-edit fas" data-name="edit"></i></span>
                                        <span class="icon_preview icon-fa-edit" title="edit - Regular"><i class="fa-edit far" data-name="edit"></i></span>
                                        <span class="icon_preview icon-fa-egg" title="egg - Solid"><i class="fa-egg fas" data-name="egg"></i></span>
                                        <span class="icon_preview icon-fa-eject" title="eject - Solid"><i class="fa-eject fas" data-name="eject"></i></span>
                                        <span class="icon_preview icon-fa-elementor" title="elementor - Brands"><i class="fa-elementor fab" data-name="elementor"></i></span>
                                        <span class="icon_preview icon-fa-ellipsis-h" title="ellipsis-h - Solid"><i class="fa-ellipsis-h fas" data-name="ellipsis-h"></i></span>
                                        <span class="icon_preview icon-fa-ellipsis-v" title="ellipsis-v - Solid"><i class="fa-ellipsis-v fas" data-name="ellipsis-v"></i></span>
                                        <span class="icon_preview icon-fa-ello" title="ello - Brands"><i class="fa-ello fab" data-name="ello"></i></span>
                                        <span class="icon_preview icon-fa-ember" title="ember - Brands"><i class="fa-ember fab" data-name="ember"></i></span>
                                        <span class="icon_preview icon-fa-empire" title="empire - Brands"><i class="fa-empire fab" data-name="empire"></i></span>
                                        <span class="icon_preview icon-fa-envelope" title="envelope - Solid"><i class="fa-envelope fas" data-name="envelope"></i></span>
                                        <span class="icon_preview icon-fa-envelope" title="envelope - Regular"><i class="fa-envelope far" data-name="envelope"></i></span>
                                        <span class="icon_preview icon-fa-envelope-open" title="envelope-open - Solid"><i class="fa-envelope-open fas" data-name="envelope-open"></i></span>
                                        <span class="icon_preview icon-fa-envelope-open" title="envelope-open - Regular"><i class="fa-envelope-open far" data-name="envelope-open"></i></span>
                                        <span class="icon_preview icon-fa-envelope-open-text" title="envelope-open-text - Solid"><i class="fa-envelope-open-text fas" data-name="envelope-open-text"></i></span>
                                        <span class="icon_preview icon-fa-envelope-square" title="envelope-square - Solid"><i class="fa-envelope-square fas" data-name="envelope-square"></i></span>
                                        <span class="icon_preview icon-fa-envira" title="envira - Brands"><i class="fa-envira fab" data-name="envira"></i></span>
                                        <span class="icon_preview icon-fa-equals" title="equals - Solid"><i class="fa-equals fas" data-name="equals"></i></span>
                                        <span class="icon_preview icon-fa-eraser" title="eraser - Solid"><i class="fa-eraser fas" data-name="eraser"></i></span>
                                        <span class="icon_preview icon-fa-erlang" title="erlang - Brands"><i class="fa-erlang fab" data-name="erlang"></i></span>
                                        <span class="icon_preview icon-fa-ethereum" title="ethereum - Brands"><i class="fa-ethereum fab" data-name="ethereum"></i></span>
                                        <span class="icon_preview icon-fa-ethernet" title="ethernet - Solid"><i class="fa-ethernet fas" data-name="ethernet"></i></span>
                                        <span class="icon_preview icon-fa-etsy" title="etsy - Brands"><i class="fa-etsy fab" data-name="etsy"></i></span>
                                        <span class="icon_preview icon-fa-euro-sign" title="euro-sign - Solid"><i class="fa-euro-sign fas" data-name="euro-sign"></i></span>
                                        <span class="icon_preview icon-fa-exchange-alt" title="exchange-alt - Solid"><i class="fa-exchange-alt fas" data-name="exchange-alt"></i></span>
                                        <span class="icon_preview icon-fa-exclamation" title="exclamation - Solid"><i class="fa-exclamation fas" data-name="exclamation"></i></span>
                                        <span class="icon_preview icon-fa-exclamation-circle" title="exclamation-circle - Solid"><i class="fa-exclamation-circle fas" data-name="exclamation-circle"></i></span>
                                        <span class="icon_preview icon-fa-exclamation-triangle" title="exclamation-triangle - Solid"><i class="fa-exclamation-triangle fas" data-name="exclamation-triangle"></i></span>
                                        <span class="icon_preview icon-fa-expand" title="expand - Solid"><i class="fa-expand fas" data-name="expand"></i></span>
                                        <span class="icon_preview icon-fa-expand-arrows-alt" title="expand-arrows-alt - Solid"><i class="fa-expand-arrows-alt fas" data-name="expand-arrows-alt"></i></span>
                                        <span class="icon_preview icon-fa-expeditedssl" title="expeditedssl - Brands"><i class="fa-expeditedssl fab" data-name="expeditedssl"></i></span>
                                        <span class="icon_preview icon-fa-external-link-alt" title="external-link-alt - Solid"><i class="fa-external-link-alt fas" data-name="external-link-alt"></i></span>
                                        <span class="icon_preview icon-fa-external-link-square-alt" title="external-link-square-alt - Solid"><i class="fa-external-link-square-alt fas" data-name="external-link-square-alt"></i></span>
                                        <span class="icon_preview icon-fa-eye" title="eye - Solid"><i class="fa-eye fas" data-name="eye"></i></span>
                                        <span class="icon_preview icon-fa-eye" title="eye - Regular"><i class="fa-eye far" data-name="eye"></i></span>
                                        <span class="icon_preview icon-fa-eye-dropper" title="eye-dropper - Solid"><i class="fa-eye-dropper fas" data-name="eye-dropper"></i></span>
                                        <span class="icon_preview icon-fa-eye-slash" title="eye-slash - Solid"><i class="fa-eye-slash fas" data-name="eye-slash"></i></span>
                                        <span class="icon_preview icon-fa-eye-slash" title="eye-slash - Regular"><i class="fa-eye-slash far" data-name="eye-slash"></i></span>
                                        <span class="icon_preview icon-fa-facebook" title="facebook - Brands"><i class="fa-facebook fab" data-name="facebook"></i></span>
                                        <span class="icon_preview icon-fa-facebook-f" title="facebook-f - Brands"><i class="fa-facebook-f fab" data-name="facebook-f"></i></span>
                                        <span class="icon_preview icon-fa-facebook-messenger" title="facebook-messenger - Brands"><i class="fa-facebook-messenger fab" data-name="facebook-messenger"></i></span>
                                        <span class="icon_preview icon-fa-facebook-square" title="facebook-square - Brands"><i class="fa-facebook-square fab" data-name="facebook-square"></i></span>
                                        <span class="icon_preview icon-fa-fantasy-flight-games" title="fantasy-flight-games - Brands"><i class="fa-fantasy-flight-games fab" data-name="fantasy-flight-games"></i></span>
                                        <span class="icon_preview icon-fa-fast-backward" title="fast-backward - Solid"><i class="fa-fast-backward fas" data-name="fast-backward"></i></span>
                                        <span class="icon_preview icon-fa-fast-forward" title="fast-forward - Solid"><i class="fa-fast-forward fas" data-name="fast-forward"></i></span>
                                        <span class="icon_preview icon-fa-fax" title="fax - Solid"><i class="fa-fax fas" data-name="fax"></i></span>
                                        <span class="icon_preview icon-fa-feather" title="feather - Solid"><i class="fa-feather fas" data-name="feather"></i></span>
                                        <span class="icon_preview icon-fa-feather-alt" title="feather-alt - Solid"><i class="fa-feather-alt fas" data-name="feather-alt"></i></span>
                                        <span class="icon_preview icon-fa-fedex" title="fedex - Brands"><i class="fa-fedex fab" data-name="fedex"></i></span>
                                        <span class="icon_preview icon-fa-fedora" title="fedora - Brands"><i class="fa-fedora fab" data-name="fedora"></i></span>
                                        <span class="icon_preview icon-fa-female" title="female - Solid"><i class="fa-female fas" data-name="female"></i></span>
                                        <span class="icon_preview icon-fa-fighter-jet" title="fighter-jet - Solid"><i class="fa-fighter-jet fas" data-name="fighter-jet"></i></span>
                                        <span class="icon_preview icon-fa-figma" title="figma - Brands"><i class="fa-figma fab" data-name="figma"></i></span>
                                        <span class="icon_preview icon-fa-file" title="file - Solid"><i class="fa-file fas" data-name="file"></i></span>
                                        <span class="icon_preview icon-fa-file" title="file - Regular"><i class="fa-file far" data-name="file"></i></span>
                                        <span class="icon_preview icon-fa-file-alt" title="file-alt - Solid"><i class="fa-file-alt fas" data-name="file-alt"></i></span>
                                        <span class="icon_preview icon-fa-file-alt" title="file-alt - Regular"><i class="fa-file-alt far" data-name="file-alt"></i></span>
                                        <span class="icon_preview icon-fa-file-archive" title="file-archive - Solid"><i class="fa-file-archive fas" data-name="file-archive"></i></span>
                                        <span class="icon_preview icon-fa-file-archive" title="file-archive - Regular"><i class="fa-file-archive far" data-name="file-archive"></i></span>
                                        <span class="icon_preview icon-fa-file-audio" title="file-audio - Solid"><i class="fa-file-audio fas" data-name="file-audio"></i></span>
                                        <span class="icon_preview icon-fa-file-audio" title="file-audio - Regular"><i class="fa-file-audio far" data-name="file-audio"></i></span>
                                        <span class="icon_preview icon-fa-file-code" title="file-code - Solid"><i class="fa-file-code fas" data-name="file-code"></i></span>
                                        <span class="icon_preview icon-fa-file-code" title="file-code - Regular"><i class="fa-file-code far" data-name="file-code"></i></span>
                                        <span class="icon_preview icon-fa-file-contract" title="file-contract - Solid"><i class="fa-file-contract fas" data-name="file-contract"></i></span>
                                        <span class="icon_preview icon-fa-file-csv" title="file-csv - Solid"><i class="fa-file-csv fas" data-name="file-csv"></i></span>
                                        <span class="icon_preview icon-fa-file-download" title="file-download - Solid"><i class="fa-file-download fas" data-name="file-download"></i></span>
                                        <span class="icon_preview icon-fa-file-excel" title="file-excel - Solid"><i class="fa-file-excel fas" data-name="file-excel"></i></span>
                                        <span class="icon_preview icon-fa-file-excel" title="file-excel - Regular"><i class="fa-file-excel far" data-name="file-excel"></i></span>
                                        <span class="icon_preview icon-fa-file-export" title="file-export - Solid"><i class="fa-file-export fas" data-name="file-export"></i></span>
                                        <span class="icon_preview icon-fa-file-image" title="file-image - Solid"><i class="fa-file-image fas" data-name="file-image"></i></span>
                                        <span class="icon_preview icon-fa-file-image" title="file-image - Regular"><i class="fa-file-image far" data-name="file-image"></i></span>
                                        <span class="icon_preview icon-fa-file-import" title="file-import - Solid"><i class="fa-file-import fas" data-name="file-import"></i></span>
                                        <span class="icon_preview icon-fa-file-invoice" title="file-invoice - Solid"><i class="fa-file-invoice fas" data-name="file-invoice"></i></span>
                                        <span class="icon_preview icon-fa-file-invoice-dollar" title="file-invoice-dollar - Solid"><i class="fa-file-invoice-dollar fas" data-name="file-invoice-dollar"></i></span>
                                        <span class="icon_preview icon-fa-file-medical" title="file-medical - Solid"><i class="fa-file-medical fas" data-name="file-medical"></i></span>
                                        <span class="icon_preview icon-fa-file-medical-alt" title="file-medical-alt - Solid"><i class="fa-file-medical-alt fas" data-name="file-medical-alt"></i></span>
                                        <span class="icon_preview icon-fa-file-pdf" title="file-pdf - Solid"><i class="fa-file-pdf fas" data-name="file-pdf"></i></span>
                                        <span class="icon_preview icon-fa-file-pdf" title="file-pdf - Regular"><i class="fa-file-pdf far" data-name="file-pdf"></i></span>
                                        <span class="icon_preview icon-fa-file-powerpoint" title="file-powerpoint - Solid"><i class="fa-file-powerpoint fas" data-name="file-powerpoint"></i></span>
                                        <span class="icon_preview icon-fa-file-powerpoint" title="file-powerpoint - Regular"><i class="fa-file-powerpoint far" data-name="file-powerpoint"></i></span>
                                        <span class="icon_preview icon-fa-file-prescription" title="file-prescription - Solid"><i class="fa-file-prescription fas" data-name="file-prescription"></i></span>
                                        <span class="icon_preview icon-fa-file-signature" title="file-signature - Solid"><i class="fa-file-signature fas" data-name="file-signature"></i></span>
                                        <span class="icon_preview icon-fa-file-upload" title="file-upload - Solid"><i class="fa-file-upload fas" data-name="file-upload"></i></span>
                                        <span class="icon_preview icon-fa-file-video" title="file-video - Solid"><i class="fa-file-video fas" data-name="file-video"></i></span>
                                        <span class="icon_preview icon-fa-file-video" title="file-video - Regular"><i class="fa-file-video far" data-name="file-video"></i></span>
                                        <span class="icon_preview icon-fa-file-word" title="file-word - Solid"><i class="fa-file-word fas" data-name="file-word"></i></span>
                                        <span class="icon_preview icon-fa-file-word" title="file-word - Regular"><i class="fa-file-word far" data-name="file-word"></i></span>
                                        <span class="icon_preview icon-fa-fill" title="fill - Solid"><i class="fa-fill fas" data-name="fill"></i></span>
                                        <span class="icon_preview icon-fa-fill-drip" title="fill-drip - Solid"><i class="fa-fill-drip fas" data-name="fill-drip"></i></span>
                                        <span class="icon_preview icon-fa-film" title="film - Solid"><i class="fa-film fas" data-name="film"></i></span>
                                        <span class="icon_preview icon-fa-filter" title="filter - Solid"><i class="fa-filter fas" data-name="filter"></i></span>
                                        <span class="icon_preview icon-fa-fingerprint" title="fingerprint - Solid"><i class="fa-fingerprint fas" data-name="fingerprint"></i></span>
                                        <span class="icon_preview icon-fa-fire" title="fire - Solid"><i class="fa-fire fas" data-name="fire"></i></span>
                                        <span class="icon_preview icon-fa-fire-alt" title="fire-alt - Solid"><i class="fa-fire-alt fas" data-name="fire-alt"></i></span>
                                        <span class="icon_preview icon-fa-fire-extinguisher" title="fire-extinguisher - Solid"><i class="fa-fire-extinguisher fas" data-name="fire-extinguisher"></i></span>
                                        <span class="icon_preview icon-fa-firefox" title="firefox - Brands"><i class="fa-firefox fab" data-name="firefox"></i></span>
                                        <span class="icon_preview icon-fa-first-aid" title="first-aid - Solid"><i class="fa-first-aid fas" data-name="first-aid"></i></span>
                                        <span class="icon_preview icon-fa-first-order" title="first-order - Brands"><i class="fa-first-order fab" data-name="first-order"></i></span>
                                        <span class="icon_preview icon-fa-first-order-alt" title="first-order-alt - Brands"><i class="fa-first-order-alt fab" data-name="first-order-alt"></i></span>
                                        <span class="icon_preview icon-fa-firstdraft" title="firstdraft - Brands"><i class="fa-firstdraft fab" data-name="firstdraft"></i></span>
                                        <span class="icon_preview icon-fa-fish" title="fish - Solid"><i class="fa-fish fas" data-name="fish"></i></span>
                                        <span class="icon_preview icon-fa-fist-raised" title="fist-raised - Solid"><i class="fa-fist-raised fas" data-name="fist-raised"></i></span>
                                        <span class="icon_preview icon-fa-flag" title="flag - Solid"><i class="fa-flag fas" data-name="flag"></i></span>
                                        <span class="icon_preview icon-fa-flag" title="flag - Regular"><i class="fa-flag far" data-name="flag"></i></span>
                                        <span class="icon_preview icon-fa-flag-checkered" title="flag-checkered - Solid"><i class="fa-flag-checkered fas" data-name="flag-checkered"></i></span>
                                        <span class="icon_preview icon-fa-flag-usa" title="flag-usa - Solid"><i class="fa-flag-usa fas" data-name="flag-usa"></i></span>
                                        <span class="icon_preview icon-fa-flask" title="flask - Solid"><i class="fa-flask fas" data-name="flask"></i></span>
                                        <span class="icon_preview icon-fa-flickr" title="flickr - Brands"><i class="fa-flickr fab" data-name="flickr"></i></span>
                                        <span class="icon_preview icon-fa-flipboard" title="flipboard - Brands"><i class="fa-flipboard fab" data-name="flipboard"></i></span>
                                        <span class="icon_preview icon-fa-flushed" title="flushed - Solid"><i class="fa-flushed fas" data-name="flushed"></i></span>
                                        <span class="icon_preview icon-fa-flushed" title="flushed - Regular"><i class="fa-flushed far" data-name="flushed"></i></span>
                                        <span class="icon_preview icon-fa-fly" title="fly - Brands"><i class="fa-fly fab" data-name="fly"></i></span>
                                        <span class="icon_preview icon-fa-folder" title="folder - Solid"><i class="fa-folder fas" data-name="folder"></i></span>
                                        <span class="icon_preview icon-fa-folder" title="folder - Regular"><i class="fa-folder far" data-name="folder"></i></span>
                                        <span class="icon_preview icon-fa-folder-minus" title="folder-minus - Solid"><i class="fa-folder-minus fas" data-name="folder-minus"></i></span>
                                        <span class="icon_preview icon-fa-folder-open" title="folder-open - Solid"><i class="fa-folder-open fas" data-name="folder-open"></i></span>
                                        <span class="icon_preview icon-fa-folder-open" title="folder-open - Regular"><i class="fa-folder-open far" data-name="folder-open"></i></span>
                                        <span class="icon_preview icon-fa-folder-plus" title="folder-plus - Solid"><i class="fa-folder-plus fas" data-name="folder-plus"></i></span>
                                        <span class="icon_preview icon-fa-font" title="font - Solid"><i class="fa-font fas" data-name="font"></i></span>
                                        <span class="icon_preview icon-fa-font-awesome" title="font-awesome - Brands"><i class="fa-font-awesome fab" data-name="font-awesome"></i></span>
                                        <span class="icon_preview icon-fa-font-awesome-alt" title="font-awesome-alt - Brands"><i class="fa-font-awesome-alt fab" data-name="font-awesome-alt"></i></span>
                                        <span class="icon_preview icon-fa-font-awesome-flag" title="font-awesome-flag - Brands"><i class="fa-font-awesome-flag fab" data-name="font-awesome-flag"></i></span>
                                        <span class="icon_preview icon-fa-fonticons" title="fonticons - Brands"><i class="fa-fonticons fab" data-name="fonticons"></i></span>
                                        <span class="icon_preview icon-fa-fonticons-fi" title="fonticons-fi - Brands"><i class="fa-fonticons-fi fab" data-name="fonticons-fi"></i></span>
                                        <span class="icon_preview icon-fa-football-ball" title="football-ball - Solid"><i class="fa-football-ball fas" data-name="football-ball"></i></span>
                                        <span class="icon_preview icon-fa-fort-awesome" title="fort-awesome - Brands"><i class="fa-fort-awesome fab" data-name="fort-awesome"></i></span>
                                        <span class="icon_preview icon-fa-fort-awesome-alt" title="fort-awesome-alt - Brands"><i class="fa-fort-awesome-alt fab" data-name="fort-awesome-alt"></i></span>
                                        <span class="icon_preview icon-fa-forumbee" title="forumbee - Brands"><i class="fa-forumbee fab" data-name="forumbee"></i></span>
                                        <span class="icon_preview icon-fa-forward" title="forward - Solid"><i class="fa-forward fas" data-name="forward"></i></span>
                                        <span class="icon_preview icon-fa-foursquare" title="foursquare - Brands"><i class="fa-foursquare fab" data-name="foursquare"></i></span>
                                        <span class="icon_preview icon-fa-free-code-camp" title="free-code-camp - Brands"><i class="fa-free-code-camp fab" data-name="free-code-camp"></i></span>
                                        <span class="icon_preview icon-fa-freebsd" title="freebsd - Brands"><i class="fa-freebsd fab" data-name="freebsd"></i></span>
                                        <span class="icon_preview icon-fa-frog" title="frog - Solid"><i class="fa-frog fas" data-name="frog"></i></span>
                                        <span class="icon_preview icon-fa-frown" title="frown - Solid"><i class="fa-frown fas" data-name="frown"></i></span>
                                        <span class="icon_preview icon-fa-frown" title="frown - Regular"><i class="fa-frown far" data-name="frown"></i></span>
                                        <span class="icon_preview icon-fa-frown-open" title="frown-open - Solid"><i class="fa-frown-open fas" data-name="frown-open"></i></span>
                                        <span class="icon_preview icon-fa-frown-open" title="frown-open - Regular"><i class="fa-frown-open far" data-name="frown-open"></i></span>
                                        <span class="icon_preview icon-fa-fulcrum" title="fulcrum - Brands"><i class="fa-fulcrum fab" data-name="fulcrum"></i></span>
                                        <span class="icon_preview icon-fa-funnel-dollar" title="funnel-dollar - Solid"><i class="fa-funnel-dollar fas" data-name="funnel-dollar"></i></span>
                                        <span class="icon_preview icon-fa-futbol" title="futbol - Solid"><i class="fa-futbol fas" data-name="futbol"></i></span>
                                        <span class="icon_preview icon-fa-futbol" title="futbol - Regular"><i class="fa-futbol far" data-name="futbol"></i></span>
                                        <span class="icon_preview icon-fa-galactic-republic" title="galactic-republic - Brands"><i class="fa-galactic-republic fab" data-name="galactic-republic"></i></span>
                                        <span class="icon_preview icon-fa-galactic-senate" title="galactic-senate - Brands"><i class="fa-galactic-senate fab" data-name="galactic-senate"></i></span>
                                        <span class="icon_preview icon-fa-gamepad" title="gamepad - Solid"><i class="fa-gamepad fas" data-name="gamepad"></i></span>
                                        <span class="icon_preview icon-fa-gas-pump" title="gas-pump - Solid"><i class="fa-gas-pump fas" data-name="gas-pump"></i></span>
                                        <span class="icon_preview icon-fa-gavel" title="gavel - Solid"><i class="fa-gavel fas" data-name="gavel"></i></span>
                                        <span class="icon_preview icon-fa-gem" title="gem - Solid"><i class="fa-gem fas" data-name="gem"></i></span>
                                        <span class="icon_preview icon-fa-gem" title="gem - Regular"><i class="fa-gem far" data-name="gem"></i></span>
                                        <span class="icon_preview icon-fa-genderless" title="genderless - Solid"><i class="fa-genderless fas" data-name="genderless"></i></span>
                                        <span class="icon_preview icon-fa-get-pocket" title="get-pocket - Brands"><i class="fa-get-pocket fab" data-name="get-pocket"></i></span>
                                        <span class="icon_preview icon-fa-gg" title="gg - Brands"><i class="fa-gg fab" data-name="gg"></i></span>
                                        <span class="icon_preview icon-fa-gg-circle" title="gg-circle - Brands"><i class="fa-gg-circle fab" data-name="gg-circle"></i></span>
                                        <span class="icon_preview icon-fa-ghost" title="ghost - Solid"><i class="fa-ghost fas" data-name="ghost"></i></span>
                                        <span class="icon_preview icon-fa-gift" title="gift - Solid"><i class="fa-gift fas" data-name="gift"></i></span>
                                        <span class="icon_preview icon-fa-gifts" title="gifts - Solid"><i class="fa-gifts fas" data-name="gifts"></i></span>
                                        <span class="icon_preview icon-fa-git" title="git - Brands"><i class="fa-git fab" data-name="git"></i></span>
                                        <span class="icon_preview icon-fa-git-square" title="git-square - Brands"><i class="fa-git-square fab" data-name="git-square"></i></span>
                                        <span class="icon_preview icon-fa-github" title="github - Brands"><i class="fa-github fab" data-name="github"></i></span>
                                        <span class="icon_preview icon-fa-github-alt" title="github-alt - Brands"><i class="fa-github-alt fab" data-name="github-alt"></i></span>
                                        <span class="icon_preview icon-fa-github-square" title="github-square - Brands"><i class="fa-github-square fab" data-name="github-square"></i></span>
                                        <span class="icon_preview icon-fa-gitkraken" title="gitkraken - Brands"><i class="fa-gitkraken fab" data-name="gitkraken"></i></span>
                                        <span class="icon_preview icon-fa-gitlab" title="gitlab - Brands"><i class="fa-gitlab fab" data-name="gitlab"></i></span>
                                        <span class="icon_preview icon-fa-gitter" title="gitter - Brands"><i class="fa-gitter fab" data-name="gitter"></i></span>
                                        <span class="icon_preview icon-fa-glass-cheers" title="glass-cheers - Solid"><i class="fa-glass-cheers fas" data-name="glass-cheers"></i></span>
                                        <span class="icon_preview icon-fa-glass-martini" title="glass-martini - Solid"><i class="fa-glass-martini fas" data-name="glass-martini"></i></span>
                                        <span class="icon_preview icon-fa-glass-martini-alt" title="glass-martini-alt - Solid"><i class="fa-glass-martini-alt fas" data-name="glass-martini-alt"></i></span>
                                        <span class="icon_preview icon-fa-glass-whiskey" title="glass-whiskey - Solid"><i class="fa-glass-whiskey fas" data-name="glass-whiskey"></i></span>
                                        <span class="icon_preview icon-fa-glasses" title="glasses - Solid"><i class="fa-glasses fas" data-name="glasses"></i></span>
                                        <span class="icon_preview icon-fa-glide" title="glide - Brands"><i class="fa-glide fab" data-name="glide"></i></span>
                                        <span class="icon_preview icon-fa-glide-g" title="glide-g - Brands"><i class="fa-glide-g fab" data-name="glide-g"></i></span>
                                        <span class="icon_preview icon-fa-globe" title="globe - Solid"><i class="fa-globe fas" data-name="globe"></i></span>
                                        <span class="icon_preview icon-fa-globe-africa" title="globe-africa - Solid"><i class="fa-globe-africa fas" data-name="globe-africa"></i></span>
                                        <span class="icon_preview icon-fa-globe-americas" title="globe-americas - Solid"><i class="fa-globe-americas fas" data-name="globe-americas"></i></span>
                                        <span class="icon_preview icon-fa-globe-asia" title="globe-asia - Solid"><i class="fa-globe-asia fas" data-name="globe-asia"></i></span>
                                        <span class="icon_preview icon-fa-globe-europe" title="globe-europe - Solid"><i class="fa-globe-europe fas" data-name="globe-europe"></i></span>
                                        <span class="icon_preview icon-fa-gofore" title="gofore - Brands"><i class="fa-gofore fab" data-name="gofore"></i></span>
                                        <span class="icon_preview icon-fa-golf-ball" title="golf-ball - Solid"><i class="fa-golf-ball fas" data-name="golf-ball"></i></span>
                                        <span class="icon_preview icon-fa-goodreads" title="goodreads - Brands"><i class="fa-goodreads fab" data-name="goodreads"></i></span>
                                        <span class="icon_preview icon-fa-goodreads-g" title="goodreads-g - Brands"><i class="fa-goodreads-g fab" data-name="goodreads-g"></i></span>
                                        <span class="icon_preview icon-fa-google" title="google - Brands"><i class="fa-google fab" data-name="google"></i></span>
                                        <span class="icon_preview icon-fa-google-drive" title="google-drive - Brands"><i class="fa-google-drive fab" data-name="google-drive"></i></span>
                                        <span class="icon_preview icon-fa-google-play" title="google-play - Brands"><i class="fa-google-play fab" data-name="google-play"></i></span>
                                        <span class="icon_preview icon-fa-google-plus" title="google-plus - Brands"><i class="fa-google-plus fab" data-name="google-plus"></i></span>
                                        <span class="icon_preview icon-fa-google-plus-g" title="google-plus-g - Brands"><i class="fa-google-plus-g fab" data-name="google-plus-g"></i></span>
                                        <span class="icon_preview icon-fa-google-plus-square" title="google-plus-square - Brands"><i class="fa-google-plus-square fab" data-name="google-plus-square"></i></span>
                                        <span class="icon_preview icon-fa-google-wallet" title="google-wallet - Brands"><i class="fa-google-wallet fab" data-name="google-wallet"></i></span>
                                        <span class="icon_preview icon-fa-gopuram" title="gopuram - Solid"><i class="fa-gopuram fas" data-name="gopuram"></i></span>
                                        <span class="icon_preview icon-fa-graduation-cap" title="graduation-cap - Solid"><i class="fa-graduation-cap fas" data-name="graduation-cap"></i></span>
                                        <span class="icon_preview icon-fa-gratipay" title="gratipay - Brands"><i class="fa-gratipay fab" data-name="gratipay"></i></span>
                                        <span class="icon_preview icon-fa-grav" title="grav - Brands"><i class="fa-grav fab" data-name="grav"></i></span>
                                        <span class="icon_preview icon-fa-greater-than" title="greater-than - Solid"><i class="fa-greater-than fas" data-name="greater-than"></i></span>
                                        <span class="icon_preview icon-fa-greater-than-equal" title="greater-than-equal - Solid"><i class="fa-greater-than-equal fas" data-name="greater-than-equal"></i></span>
                                        <span class="icon_preview icon-fa-grimace" title="grimace - Solid"><i class="fa-grimace fas" data-name="grimace"></i></span>
                                        <span class="icon_preview icon-fa-grimace" title="grimace - Regular"><i class="fa-grimace far" data-name="grimace"></i></span>
                                        <span class="icon_preview icon-fa-grin" title="grin - Solid"><i class="fa-grin fas" data-name="grin"></i></span>
                                        <span class="icon_preview icon-fa-grin" title="grin - Regular"><i class="fa-grin far" data-name="grin"></i></span>
                                        <span class="icon_preview icon-fa-grin-alt" title="grin-alt - Solid"><i class="fa-grin-alt fas" data-name="grin-alt"></i></span>
                                        <span class="icon_preview icon-fa-grin-alt" title="grin-alt - Regular"><i class="fa-grin-alt far" data-name="grin-alt"></i></span>
                                        <span class="icon_preview icon-fa-grin-beam" title="grin-beam - Solid"><i class="fa-grin-beam fas" data-name="grin-beam"></i></span>
                                        <span class="icon_preview icon-fa-grin-beam" title="grin-beam - Regular"><i class="fa-grin-beam far" data-name="grin-beam"></i></span>
                                        <span class="icon_preview icon-fa-grin-beam-sweat" title="grin-beam-sweat - Solid"><i class="fa-grin-beam-sweat fas" data-name="grin-beam-sweat"></i></span>
                                        <span class="icon_preview icon-fa-grin-beam-sweat" title="grin-beam-sweat - Regular"><i class="fa-grin-beam-sweat far" data-name="grin-beam-sweat"></i></span>
                                        <span class="icon_preview icon-fa-grin-hearts" title="grin-hearts - Solid"><i class="fa-grin-hearts fas" data-name="grin-hearts"></i></span>
                                        <span class="icon_preview icon-fa-grin-hearts" title="grin-hearts - Regular"><i class="fa-grin-hearts far" data-name="grin-hearts"></i></span>
                                        <span class="icon_preview icon-fa-grin-squint" title="grin-squint - Solid"><i class="fa-grin-squint fas" data-name="grin-squint"></i></span>
                                        <span class="icon_preview icon-fa-grin-squint" title="grin-squint - Regular"><i class="fa-grin-squint far" data-name="grin-squint"></i></span>
                                        <span class="icon_preview icon-fa-grin-squint-tears" title="grin-squint-tears - Solid"><i class="fa-grin-squint-tears fas" data-name="grin-squint-tears"></i></span>
                                        <span class="icon_preview icon-fa-grin-squint-tears" title="grin-squint-tears - Regular"><i class="fa-grin-squint-tears far" data-name="grin-squint-tears"></i></span>
                                        <span class="icon_preview icon-fa-grin-stars" title="grin-stars - Solid"><i class="fa-grin-stars fas" data-name="grin-stars"></i></span>
                                        <span class="icon_preview icon-fa-grin-stars" title="grin-stars - Regular"><i class="fa-grin-stars far" data-name="grin-stars"></i></span>
                                        <span class="icon_preview icon-fa-grin-tears" title="grin-tears - Solid"><i class="fa-grin-tears fas" data-name="grin-tears"></i></span>
                                        <span class="icon_preview icon-fa-grin-tears" title="grin-tears - Regular"><i class="fa-grin-tears far" data-name="grin-tears"></i></span>
                                        <span class="icon_preview icon-fa-grin-tongue" title="grin-tongue - Solid"><i class="fa-grin-tongue fas" data-name="grin-tongue"></i></span>
                                        <span class="icon_preview icon-fa-grin-tongue" title="grin-tongue - Regular"><i class="fa-grin-tongue far" data-name="grin-tongue"></i></span>
                                        <span class="icon_preview icon-fa-grin-tongue-squint" title="grin-tongue-squint - Solid"><i class="fa-grin-tongue-squint fas" data-name="grin-tongue-squint"></i></span>
                                        <span class="icon_preview icon-fa-grin-tongue-squint" title="grin-tongue-squint - Regular"><i class="fa-grin-tongue-squint far" data-name="grin-tongue-squint"></i></span>
                                        <span class="icon_preview icon-fa-grin-tongue-wink" title="grin-tongue-wink - Solid"><i class="fa-grin-tongue-wink fas" data-name="grin-tongue-wink"></i></span>
                                        <span class="icon_preview icon-fa-grin-tongue-wink" title="grin-tongue-wink - Regular"><i class="fa-grin-tongue-wink far" data-name="grin-tongue-wink"></i></span>
                                        <span class="icon_preview icon-fa-grin-wink" title="grin-wink - Solid"><i class="fa-grin-wink fas" data-name="grin-wink"></i></span>
                                        <span class="icon_preview icon-fa-grin-wink" title="grin-wink - Regular"><i class="fa-grin-wink far" data-name="grin-wink"></i></span>
                                        <span class="icon_preview icon-fa-grip-horizontal" title="grip-horizontal - Solid"><i class="fa-grip-horizontal fas" data-name="grip-horizontal"></i></span>
                                        <span class="icon_preview icon-fa-grip-lines" title="grip-lines - Solid"><i class="fa-grip-lines fas" data-name="grip-lines"></i></span>
                                        <span class="icon_preview icon-fa-grip-lines-vertical" title="grip-lines-vertical - Solid"><i class="fa-grip-lines-vertical fas" data-name="grip-lines-vertical"></i></span>
                                        <span class="icon_preview icon-fa-grip-vertical" title="grip-vertical - Solid"><i class="fa-grip-vertical fas" data-name="grip-vertical"></i></span>
                                        <span class="icon_preview icon-fa-gripfire" title="gripfire - Brands"><i class="fa-gripfire fab" data-name="gripfire"></i></span>
                                        <span class="icon_preview icon-fa-grunt" title="grunt - Brands"><i class="fa-grunt fab" data-name="grunt"></i></span>
                                        <span class="icon_preview icon-fa-guitar" title="guitar - Solid"><i class="fa-guitar fas" data-name="guitar"></i></span>
                                        <span class="icon_preview icon-fa-gulp" title="gulp - Brands"><i class="fa-gulp fab" data-name="gulp"></i></span>
                                        <span class="icon_preview icon-fa-h-square" title="h-square - Solid"><i class="fa-h-square fas" data-name="h-square"></i></span>
                                        <span class="icon_preview icon-fa-hacker-news" title="hacker-news - Brands"><i class="fa-hacker-news fab" data-name="hacker-news"></i></span>
                                        <span class="icon_preview icon-fa-hacker-news-square" title="hacker-news-square - Brands"><i class="fa-hacker-news-square fab" data-name="hacker-news-square"></i></span>
                                        <span class="icon_preview icon-fa-hackerrank" title="hackerrank - Brands"><i class="fa-hackerrank fab" data-name="hackerrank"></i></span>
                                        <span class="icon_preview icon-fa-hamburger" title="hamburger - Solid"><i class="fa-hamburger fas" data-name="hamburger"></i></span>
                                        <span class="icon_preview icon-fa-hammer" title="hammer - Solid"><i class="fa-hammer fas" data-name="hammer"></i></span>
                                        <span class="icon_preview icon-fa-hamsa" title="hamsa - Solid"><i class="fa-hamsa fas" data-name="hamsa"></i></span>
                                        <span class="icon_preview icon-fa-hand-holding" title="hand-holding - Solid"><i class="fa-hand-holding fas" data-name="hand-holding"></i></span>
                                        <span class="icon_preview icon-fa-hand-holding-heart" title="hand-holding-heart - Solid"><i class="fa-hand-holding-heart fas" data-name="hand-holding-heart"></i></span>
                                        <span class="icon_preview icon-fa-hand-holding-usd" title="hand-holding-usd - Solid"><i class="fa-hand-holding-usd fas" data-name="hand-holding-usd"></i></span>
                                        <span class="icon_preview icon-fa-hand-lizard" title="hand-lizard - Solid"><i class="fa-hand-lizard fas" data-name="hand-lizard"></i></span>
                                        <span class="icon_preview icon-fa-hand-lizard" title="hand-lizard - Regular"><i class="fa-hand-lizard far" data-name="hand-lizard"></i></span>
                                        <span class="icon_preview icon-fa-hand-middle-finger" title="hand-middle-finger - Solid"><i class="fa-hand-middle-finger fas" data-name="hand-middle-finger"></i></span>
                                        <span class="icon_preview icon-fa-hand-paper" title="hand-paper - Solid"><i class="fa-hand-paper fas" data-name="hand-paper"></i></span>
                                        <span class="icon_preview icon-fa-hand-paper" title="hand-paper - Regular"><i class="fa-hand-paper far" data-name="hand-paper"></i></span>
                                        <span class="icon_preview icon-fa-hand-peace" title="hand-peace - Solid"><i class="fa-hand-peace fas" data-name="hand-peace"></i></span>
                                        <span class="icon_preview icon-fa-hand-peace" title="hand-peace - Regular"><i class="fa-hand-peace far" data-name="hand-peace"></i></span>
                                        <span class="icon_preview icon-fa-hand-point-down" title="hand-point-down - Solid"><i class="fa-hand-point-down fas" data-name="hand-point-down"></i></span>
                                        <span class="icon_preview icon-fa-hand-point-down" title="hand-point-down - Regular"><i class="fa-hand-point-down far" data-name="hand-point-down"></i></span>
                                        <span class="icon_preview icon-fa-hand-point-left" title="hand-point-left - Solid"><i class="fa-hand-point-left fas" data-name="hand-point-left"></i></span>
                                        <span class="icon_preview icon-fa-hand-point-left" title="hand-point-left - Regular"><i class="fa-hand-point-left far" data-name="hand-point-left"></i></span>
                                        <span class="icon_preview icon-fa-hand-point-right" title="hand-point-right - Solid"><i class="fa-hand-point-right fas" data-name="hand-point-right"></i></span>
                                        <span class="icon_preview icon-fa-hand-point-right" title="hand-point-right - Regular"><i class="fa-hand-point-right far" data-name="hand-point-right"></i></span>
                                        <span class="icon_preview icon-fa-hand-point-up" title="hand-point-up - Solid"><i class="fa-hand-point-up fas" data-name="hand-point-up"></i></span>
                                        <span class="icon_preview icon-fa-hand-point-up" title="hand-point-up - Regular"><i class="fa-hand-point-up far" data-name="hand-point-up"></i></span>
                                        <span class="icon_preview icon-fa-hand-pointer" title="hand-pointer - Solid"><i class="fa-hand-pointer fas" data-name="hand-pointer"></i></span>
                                        <span class="icon_preview icon-fa-hand-pointer" title="hand-pointer - Regular"><i class="fa-hand-pointer far" data-name="hand-pointer"></i></span>
                                        <span class="icon_preview icon-fa-hand-rock" title="hand-rock - Solid"><i class="fa-hand-rock fas" data-name="hand-rock"></i></span>
                                        <span class="icon_preview icon-fa-hand-rock" title="hand-rock - Regular"><i class="fa-hand-rock far" data-name="hand-rock"></i></span>
                                        <span class="icon_preview icon-fa-hand-scissors" title="hand-scissors - Solid"><i class="fa-hand-scissors fas" data-name="hand-scissors"></i></span>
                                        <span class="icon_preview icon-fa-hand-scissors" title="hand-scissors - Regular"><i class="fa-hand-scissors far" data-name="hand-scissors"></i></span>
                                        <span class="icon_preview icon-fa-hand-spock" title="hand-spock - Solid"><i class="fa-hand-spock fas" data-name="hand-spock"></i></span>
                                        <span class="icon_preview icon-fa-hand-spock" title="hand-spock - Regular"><i class="fa-hand-spock far" data-name="hand-spock"></i></span>
                                        <span class="icon_preview icon-fa-hands" title="hands - Solid"><i class="fa-hands fas" data-name="hands"></i></span>
                                        <span class="icon_preview icon-fa-hands-helping" title="hands-helping - Solid"><i class="fa-hands-helping fas" data-name="hands-helping"></i></span>
                                        <span class="icon_preview icon-fa-handshake" title="handshake - Solid"><i class="fa-handshake fas" data-name="handshake"></i></span>
                                        <span class="icon_preview icon-fa-handshake" title="handshake - Regular"><i class="fa-handshake far" data-name="handshake"></i></span>
                                        <span class="icon_preview icon-fa-hanukiah" title="hanukiah - Solid"><i class="fa-hanukiah fas" data-name="hanukiah"></i></span>
                                        <span class="icon_preview icon-fa-hard-hat" title="hard-hat - Solid"><i class="fa-hard-hat fas" data-name="hard-hat"></i></span>
                                        <span class="icon_preview icon-fa-hashtag" title="hashtag - Solid"><i class="fa-hashtag fas" data-name="hashtag"></i></span>
                                        <span class="icon_preview icon-fa-hat-wizard" title="hat-wizard - Solid"><i class="fa-hat-wizard fas" data-name="hat-wizard"></i></span>
                                        <span class="icon_preview icon-fa-haykal" title="haykal - Solid"><i class="fa-haykal fas" data-name="haykal"></i></span>
                                        <span class="icon_preview icon-fa-hdd" title="hdd - Solid"><i class="fa-hdd fas" data-name="hdd"></i></span>
                                        <span class="icon_preview icon-fa-hdd" title="hdd - Regular"><i class="fa-hdd far" data-name="hdd"></i></span>
                                        <span class="icon_preview icon-fa-heading" title="heading - Solid"><i class="fa-heading fas" data-name="heading"></i></span>
                                        <span class="icon_preview icon-fa-headphones" title="headphones - Solid"><i class="fa-headphones fas" data-name="headphones"></i></span>
                                        <span class="icon_preview icon-fa-headphones-alt" title="headphones-alt - Solid"><i class="fa-headphones-alt fas" data-name="headphones-alt"></i></span>
                                        <span class="icon_preview icon-fa-headset" title="headset - Solid"><i class="fa-headset fas" data-name="headset"></i></span>
                                        <span class="icon_preview icon-fa-heart" title="heart - Solid"><i class="fa-heart fas" data-name="heart"></i></span>
                                        <span class="icon_preview icon-fa-heart" title="heart - Regular"><i class="fa-heart far" data-name="heart"></i></span>
                                        <span class="icon_preview icon-fa-heart-broken" title="heart-broken - Solid"><i class="fa-heart-broken fas" data-name="heart-broken"></i></span>
                                        <span class="icon_preview icon-fa-heartbeat" title="heartbeat - Solid"><i class="fa-heartbeat fas" data-name="heartbeat"></i></span>
                                        <span class="icon_preview icon-fa-helicopter" title="helicopter - Solid"><i class="fa-helicopter fas" data-name="helicopter"></i></span>
                                        <span class="icon_preview icon-fa-highlighter" title="highlighter - Solid"><i class="fa-highlighter fas" data-name="highlighter"></i></span>
                                        <span class="icon_preview icon-fa-hiking" title="hiking - Solid"><i class="fa-hiking fas" data-name="hiking"></i></span>
                                        <span class="icon_preview icon-fa-hippo" title="hippo - Solid"><i class="fa-hippo fas" data-name="hippo"></i></span>
                                        <span class="icon_preview icon-fa-hips" title="hips - Brands"><i class="fa-hips fab" data-name="hips"></i></span>
                                        <span class="icon_preview icon-fa-hire-a-helper" title="hire-a-helper - Brands"><i class="fa-hire-a-helper fab" data-name="hire-a-helper"></i></span>
                                        <span class="icon_preview icon-fa-history" title="history - Solid"><i class="fa-history fas" data-name="history"></i></span>
                                        <span class="icon_preview icon-fa-hockey-puck" title="hockey-puck - Solid"><i class="fa-hockey-puck fas" data-name="hockey-puck"></i></span>
                                        <span class="icon_preview icon-fa-holly-berry" title="holly-berry - Solid"><i class="fa-holly-berry fas" data-name="holly-berry"></i></span>
                                        <span class="icon_preview icon-fa-home" title="home - Solid"><i class="fa-home fas" data-name="home"></i></span>
                                        <span class="icon_preview icon-fa-hooli" title="hooli - Brands"><i class="fa-hooli fab" data-name="hooli"></i></span>
                                        <span class="icon_preview icon-fa-hornbill" title="hornbill - Brands"><i class="fa-hornbill fab" data-name="hornbill"></i></span>
                                        <span class="icon_preview icon-fa-horse" title="horse - Solid"><i class="fa-horse fas" data-name="horse"></i></span>
                                        <span class="icon_preview icon-fa-horse-head" title="horse-head - Solid"><i class="fa-horse-head fas" data-name="horse-head"></i></span>
                                        <span class="icon_preview icon-fa-hospital" title="hospital - Solid"><i class="fa-hospital fas" data-name="hospital"></i></span>
                                        <span class="icon_preview icon-fa-hospital" title="hospital - Regular"><i class="fa-hospital far" data-name="hospital"></i></span>
                                        <span class="icon_preview icon-fa-hospital-alt" title="hospital-alt - Solid"><i class="fa-hospital-alt fas" data-name="hospital-alt"></i></span>
                                        <span class="icon_preview icon-fa-hospital-symbol" title="hospital-symbol - Solid"><i class="fa-hospital-symbol fas" data-name="hospital-symbol"></i></span>
                                        <span class="icon_preview icon-fa-hot-tub" title="hot-tub - Solid"><i class="fa-hot-tub fas" data-name="hot-tub"></i></span>
                                        <span class="icon_preview icon-fa-hotdog" title="hotdog - Solid"><i class="fa-hotdog fas" data-name="hotdog"></i></span>
                                        <span class="icon_preview icon-fa-hotel" title="hotel - Solid"><i class="fa-hotel fas" data-name="hotel"></i></span>
                                        <span class="icon_preview icon-fa-hotjar" title="hotjar - Brands"><i class="fa-hotjar fab" data-name="hotjar"></i></span>
                                        <span class="icon_preview icon-fa-hourglass" title="hourglass - Solid"><i class="fa-hourglass fas" data-name="hourglass"></i></span>
                                        <span class="icon_preview icon-fa-hourglass" title="hourglass - Regular"><i class="fa-hourglass far" data-name="hourglass"></i></span>
                                        <span class="icon_preview icon-fa-hourglass-end" title="hourglass-end - Solid"><i class="fa-hourglass-end fas" data-name="hourglass-end"></i></span>
                                        <span class="icon_preview icon-fa-hourglass-half" title="hourglass-half - Solid"><i class="fa-hourglass-half fas" data-name="hourglass-half"></i></span>
                                        <span class="icon_preview icon-fa-hourglass-start" title="hourglass-start - Solid"><i class="fa-hourglass-start fas" data-name="hourglass-start"></i></span>
                                        <span class="icon_preview icon-fa-house-damage" title="house-damage - Solid"><i class="fa-house-damage fas" data-name="house-damage"></i></span>
                                        <span class="icon_preview icon-fa-houzz" title="houzz - Brands"><i class="fa-houzz fab" data-name="houzz"></i></span>
                                        <span class="icon_preview icon-fa-hryvnia" title="hryvnia - Solid"><i class="fa-hryvnia fas" data-name="hryvnia"></i></span>
                                        <span class="icon_preview icon-fa-html5" title="html5 - Brands"><i class="fa-html5 fab" data-name="html5"></i></span>
                                        <span class="icon_preview icon-fa-hubspot" title="hubspot - Brands"><i class="fa-hubspot fab" data-name="hubspot"></i></span>
                                        <span class="icon_preview icon-fa-i-cursor" title="i-cursor - Solid"><i class="fa-i-cursor fas" data-name="i-cursor"></i></span>
                                        <span class="icon_preview icon-fa-ice-cream" title="ice-cream - Solid"><i class="fa-ice-cream fas" data-name="ice-cream"></i></span>
                                        <span class="icon_preview icon-fa-icicles" title="icicles - Solid"><i class="fa-icicles fas" data-name="icicles"></i></span>
                                        <span class="icon_preview icon-fa-id-badge" title="id-badge - Solid"><i class="fa-id-badge fas" data-name="id-badge"></i></span>
                                        <span class="icon_preview icon-fa-id-badge" title="id-badge - Regular"><i class="fa-id-badge far" data-name="id-badge"></i></span>
                                        <span class="icon_preview icon-fa-id-card" title="id-card - Solid"><i class="fa-id-card fas" data-name="id-card"></i></span>
                                        <span class="icon_preview icon-fa-id-card" title="id-card - Regular"><i class="fa-id-card far" data-name="id-card"></i></span>
                                        <span class="icon_preview icon-fa-id-card-alt" title="id-card-alt - Solid"><i class="fa-id-card-alt fas" data-name="id-card-alt"></i></span>
                                        <span class="icon_preview icon-fa-igloo" title="igloo - Solid"><i class="fa-igloo fas" data-name="igloo"></i></span>
                                        <span class="icon_preview icon-fa-image" title="image - Solid"><i class="fa-image fas" data-name="image"></i></span>
                                        <span class="icon_preview icon-fa-image" title="image - Regular"><i class="fa-image far" data-name="image"></i></span>
                                        <span class="icon_preview icon-fa-images" title="images - Solid"><i class="fa-images fas" data-name="images"></i></span>
                                        <span class="icon_preview icon-fa-images" title="images - Regular"><i class="fa-images far" data-name="images"></i></span>
                                        <span class="icon_preview icon-fa-imdb" title="imdb - Brands"><i class="fa-imdb fab" data-name="imdb"></i></span>
                                        <span class="icon_preview icon-fa-inbox" title="inbox - Solid"><i class="fa-inbox fas" data-name="inbox"></i></span>
                                        <span class="icon_preview icon-fa-indent" title="indent - Solid"><i class="fa-indent fas" data-name="indent"></i></span>
                                        <span class="icon_preview icon-fa-industry" title="industry - Solid"><i class="fa-industry fas" data-name="industry"></i></span>
                                        <span class="icon_preview icon-fa-infinity" title="infinity - Solid"><i class="fa-infinity fas" data-name="infinity"></i></span>
                                        <span class="icon_preview icon-fa-info" title="info - Solid"><i class="fa-info fas" data-name="info"></i></span>
                                        <span class="icon_preview icon-fa-info-circle" title="info-circle - Solid"><i class="fa-info-circle fas" data-name="info-circle"></i></span>
                                        <span class="icon_preview icon-fa-instagram" title="instagram - Brands"><i class="fa-instagram fab" data-name="instagram"></i></span>
                                        <span class="icon_preview icon-fa-intercom" title="intercom - Brands"><i class="fa-intercom fab" data-name="intercom"></i></span>
                                        <span class="icon_preview icon-fa-internet-explorer" title="internet-explorer - Brands"><i class="fa-internet-explorer fab" data-name="internet-explorer"></i></span>
                                        <span class="icon_preview icon-fa-invision" title="invision - Brands"><i class="fa-invision fab" data-name="invision"></i></span>
                                        <span class="icon_preview icon-fa-ioxhost" title="ioxhost - Brands"><i class="fa-ioxhost fab" data-name="ioxhost"></i></span>
                                        <span class="icon_preview icon-fa-italic" title="italic - Solid"><i class="fa-italic fas" data-name="italic"></i></span>
                                        <span class="icon_preview icon-fa-itunes" title="itunes - Brands"><i class="fa-itunes fab" data-name="itunes"></i></span>
                                        <span class="icon_preview icon-fa-itunes-note" title="itunes-note - Brands"><i class="fa-itunes-note fab" data-name="itunes-note"></i></span>
                                        <span class="icon_preview icon-fa-java" title="java - Brands"><i class="fa-java fab" data-name="java"></i></span>
                                        <span class="icon_preview icon-fa-jedi" title="jedi - Solid"><i class="fa-jedi fas" data-name="jedi"></i></span>
                                        <span class="icon_preview icon-fa-jedi-order" title="jedi-order - Brands"><i class="fa-jedi-order fab" data-name="jedi-order"></i></span>
                                        <span class="icon_preview icon-fa-jenkins" title="jenkins - Brands"><i class="fa-jenkins fab" data-name="jenkins"></i></span>
                                        <span class="icon_preview icon-fa-jira" title="jira - Brands"><i class="fa-jira fab" data-name="jira"></i></span>
                                        <span class="icon_preview icon-fa-joget" title="joget - Brands"><i class="fa-joget fab" data-name="joget"></i></span>
                                        <span class="icon_preview icon-fa-joint" title="joint - Solid"><i class="fa-joint fas" data-name="joint"></i></span>
                                        <span class="icon_preview icon-fa-joomla" title="joomla - Brands"><i class="fa-joomla fab" data-name="joomla"></i></span>
                                        <span class="icon_preview icon-fa-journal-whills" title="journal-whills - Solid"><i class="fa-journal-whills fas" data-name="journal-whills"></i></span>
                                        <span class="icon_preview icon-fa-js" title="js - Brands"><i class="fa-js fab" data-name="js"></i></span>
                                        <span class="icon_preview icon-fa-js-square" title="js-square - Brands"><i class="fa-js-square fab" data-name="js-square"></i></span>
                                        <span class="icon_preview icon-fa-jsfiddle" title="jsfiddle - Brands"><i class="fa-jsfiddle fab" data-name="jsfiddle"></i></span>
                                        <span class="icon_preview icon-fa-kaaba" title="kaaba - Solid"><i class="fa-kaaba fas" data-name="kaaba"></i></span>
                                        <span class="icon_preview icon-fa-kaggle" title="kaggle - Brands"><i class="fa-kaggle fab" data-name="kaggle"></i></span>
                                        <span class="icon_preview icon-fa-key" title="key - Solid"><i class="fa-key fas" data-name="key"></i></span>
                                        <span class="icon_preview icon-fa-keybase" title="keybase - Brands"><i class="fa-keybase fab" data-name="keybase"></i></span>
                                        <span class="icon_preview icon-fa-keyboard" title="keyboard - Solid"><i class="fa-keyboard fas" data-name="keyboard"></i></span>
                                        <span class="icon_preview icon-fa-keyboard" title="keyboard - Regular"><i class="fa-keyboard far" data-name="keyboard"></i></span>
                                        <span class="icon_preview icon-fa-keycdn" title="keycdn - Brands"><i class="fa-keycdn fab" data-name="keycdn"></i></span>
                                        <span class="icon_preview icon-fa-khanda" title="khanda - Solid"><i class="fa-khanda fas" data-name="khanda"></i></span>
                                        <span class="icon_preview icon-fa-kickstarter" title="kickstarter - Brands"><i class="fa-kickstarter fab" data-name="kickstarter"></i></span>
                                        <span class="icon_preview icon-fa-kickstarter-k" title="kickstarter-k - Brands"><i class="fa-kickstarter-k fab" data-name="kickstarter-k"></i></span>
                                        <span class="icon_preview icon-fa-kiss" title="kiss - Solid"><i class="fa-kiss fas" data-name="kiss"></i></span>
                                        <span class="icon_preview icon-fa-kiss" title="kiss - Regular"><i class="fa-kiss far" data-name="kiss"></i></span>
                                        <span class="icon_preview icon-fa-kiss-beam" title="kiss-beam - Solid"><i class="fa-kiss-beam fas" data-name="kiss-beam"></i></span>
                                        <span class="icon_preview icon-fa-kiss-beam" title="kiss-beam - Regular"><i class="fa-kiss-beam far" data-name="kiss-beam"></i></span>
                                        <span class="icon_preview icon-fa-kiss-wink-heart" title="kiss-wink-heart - Solid"><i class="fa-kiss-wink-heart fas" data-name="kiss-wink-heart"></i></span>
                                        <span class="icon_preview icon-fa-kiss-wink-heart" title="kiss-wink-heart - Regular"><i class="fa-kiss-wink-heart far" data-name="kiss-wink-heart"></i></span>
                                        <span class="icon_preview icon-fa-kiwi-bird" title="kiwi-bird - Solid"><i class="fa-kiwi-bird fas" data-name="kiwi-bird"></i></span>
                                        <span class="icon_preview icon-fa-korvue" title="korvue - Brands"><i class="fa-korvue fab" data-name="korvue"></i></span>
                                        <span class="icon_preview icon-fa-landmark" title="landmark - Solid"><i class="fa-landmark fas" data-name="landmark"></i></span>
                                        <span class="icon_preview icon-fa-language" title="language - Solid"><i class="fa-language fas" data-name="language"></i></span>
                                        <span class="icon_preview icon-fa-laptop" title="laptop - Solid"><i class="fa-laptop fas" data-name="laptop"></i></span>
                                        <span class="icon_preview icon-fa-laptop-code" title="laptop-code - Solid"><i class="fa-laptop-code fas" data-name="laptop-code"></i></span>
                                        <span class="icon_preview icon-fa-laptop-medical" title="laptop-medical - Solid"><i class="fa-laptop-medical fas" data-name="laptop-medical"></i></span>
                                        <span class="icon_preview icon-fa-laravel" title="laravel - Brands"><i class="fa-laravel fab" data-name="laravel"></i></span>
                                        <span class="icon_preview icon-fa-lastfm" title="lastfm - Brands"><i class="fa-lastfm fab" data-name="lastfm"></i></span>
                                        <span class="icon_preview icon-fa-lastfm-square" title="lastfm-square - Brands"><i class="fa-lastfm-square fab" data-name="lastfm-square"></i></span>
                                        <span class="icon_preview icon-fa-laugh" title="laugh - Solid"><i class="fa-laugh fas" data-name="laugh"></i></span>
                                        <span class="icon_preview icon-fa-laugh" title="laugh - Regular"><i class="fa-laugh far" data-name="laugh"></i></span>
                                        <span class="icon_preview icon-fa-laugh-beam" title="laugh-beam - Solid"><i class="fa-laugh-beam fas" data-name="laugh-beam"></i></span>
                                        <span class="icon_preview icon-fa-laugh-beam" title="laugh-beam - Regular"><i class="fa-laugh-beam far" data-name="laugh-beam"></i></span>
                                        <span class="icon_preview icon-fa-laugh-squint" title="laugh-squint - Solid"><i class="fa-laugh-squint fas" data-name="laugh-squint"></i></span>
                                        <span class="icon_preview icon-fa-laugh-squint" title="laugh-squint - Regular"><i class="fa-laugh-squint far" data-name="laugh-squint"></i></span>
                                        <span class="icon_preview icon-fa-laugh-wink" title="laugh-wink - Solid"><i class="fa-laugh-wink fas" data-name="laugh-wink"></i></span>
                                        <span class="icon_preview icon-fa-laugh-wink" title="laugh-wink - Regular"><i class="fa-laugh-wink far" data-name="laugh-wink"></i></span>
                                        <span class="icon_preview icon-fa-layer-group" title="layer-group - Solid"><i class="fa-layer-group fas" data-name="layer-group"></i></span>
                                        <span class="icon_preview icon-fa-leaf" title="leaf - Solid"><i class="fa-leaf fas" data-name="leaf"></i></span>
                                        <span class="icon_preview icon-fa-leanpub" title="leanpub - Brands"><i class="fa-leanpub fab" data-name="leanpub"></i></span>
                                        <span class="icon_preview icon-fa-lemon" title="lemon - Solid"><i class="fa-lemon fas" data-name="lemon"></i></span>
                                        <span class="icon_preview icon-fa-lemon" title="lemon - Regular"><i class="fa-lemon far" data-name="lemon"></i></span>
                                        <span class="icon_preview icon-fa-less" title="less - Brands"><i class="fa-less fab" data-name="less"></i></span>
                                        <span class="icon_preview icon-fa-less-than" title="less-than - Solid"><i class="fa-less-than fas" data-name="less-than"></i></span>
                                        <span class="icon_preview icon-fa-less-than-equal" title="less-than-equal - Solid"><i class="fa-less-than-equal fas" data-name="less-than-equal"></i></span>
                                        <span class="icon_preview icon-fa-level-down-alt" title="level-down-alt - Solid"><i class="fa-level-down-alt fas" data-name="level-down-alt"></i></span>
                                        <span class="icon_preview icon-fa-level-up-alt" title="level-up-alt - Solid"><i class="fa-level-up-alt fas" data-name="level-up-alt"></i></span>
                                        <span class="icon_preview icon-fa-life-ring" title="life-ring - Solid"><i class="fa-life-ring fas" data-name="life-ring"></i></span>
                                        <span class="icon_preview icon-fa-life-ring" title="life-ring - Regular"><i class="fa-life-ring far" data-name="life-ring"></i></span>
                                        <span class="icon_preview icon-fa-lightbulb" title="lightbulb - Solid"><i class="fa-lightbulb fas" data-name="lightbulb"></i></span>
                                        <span class="icon_preview icon-fa-lightbulb" title="lightbulb - Regular"><i class="fa-lightbulb far" data-name="lightbulb"></i></span>
                                        <span class="icon_preview icon-fa-line" title="line - Brands"><i class="fa-line fab" data-name="line"></i></span>
                                        <span class="icon_preview icon-fa-link" title="link - Solid"><i class="fa-link fas" data-name="link"></i></span>
                                        <span class="icon_preview icon-fa-linkedin" title="linkedin - Brands"><i class="fa-linkedin fab" data-name="linkedin"></i></span>
                                        <span class="icon_preview icon-fa-linkedin-in" title="linkedin-in - Brands"><i class="fa-linkedin-in fab" data-name="linkedin-in"></i></span>
                                        <span class="icon_preview icon-fa-linode" title="linode - Brands"><i class="fa-linode fab" data-name="linode"></i></span>
                                        <span class="icon_preview icon-fa-linux" title="linux - Brands"><i class="fa-linux fab" data-name="linux"></i></span>
                                        <span class="icon_preview icon-fa-lira-sign" title="lira-sign - Solid"><i class="fa-lira-sign fas" data-name="lira-sign"></i></span>
                                        <span class="icon_preview icon-fa-list" title="list - Solid"><i class="fa-list fas" data-name="list"></i></span>
                                        <span class="icon_preview icon-fa-list-alt" title="list-alt - Solid"><i class="fa-list-alt fas" data-name="list-alt"></i></span>
                                        <span class="icon_preview icon-fa-list-alt" title="list-alt - Regular"><i class="fa-list-alt far" data-name="list-alt"></i></span>
                                        <span class="icon_preview icon-fa-list-ol" title="list-ol - Solid"><i class="fa-list-ol fas" data-name="list-ol"></i></span>
                                        <span class="icon_preview icon-fa-list-ul" title="list-ul - Solid"><i class="fa-list-ul fas" data-name="list-ul"></i></span>
                                        <span class="icon_preview icon-fa-location-arrow" title="location-arrow - Solid"><i class="fa-location-arrow fas" data-name="location-arrow"></i></span>
                                        <span class="icon_preview icon-fa-lock" title="lock - Solid"><i class="fa-lock fas" data-name="lock"></i></span>
                                        <span class="icon_preview icon-fa-lock-open" title="lock-open - Solid"><i class="fa-lock-open fas" data-name="lock-open"></i></span>
                                        <span class="icon_preview icon-fa-long-arrow-alt-down" title="long-arrow-alt-down - Solid"><i class="fa-long-arrow-alt-down fas" data-name="long-arrow-alt-down"></i></span>
                                        <span class="icon_preview icon-fa-long-arrow-alt-left" title="long-arrow-alt-left - Solid"><i class="fa-long-arrow-alt-left fas" data-name="long-arrow-alt-left"></i></span>
                                        <span class="icon_preview icon-fa-long-arrow-alt-right" title="long-arrow-alt-right - Solid"><i class="fa-long-arrow-alt-right fas" data-name="long-arrow-alt-right"></i></span>
                                        <span class="icon_preview icon-fa-long-arrow-alt-up" title="long-arrow-alt-up - Solid"><i class="fa-long-arrow-alt-up fas" data-name="long-arrow-alt-up"></i></span>
                                        <span class="icon_preview icon-fa-low-vision" title="low-vision - Solid"><i class="fa-low-vision fas" data-name="low-vision"></i></span>
                                        <span class="icon_preview icon-fa-luggage-cart" title="luggage-cart - Solid"><i class="fa-luggage-cart fas" data-name="luggage-cart"></i></span>
                                        <span class="icon_preview icon-fa-lyft" title="lyft - Brands"><i class="fa-lyft fab" data-name="lyft"></i></span>
                                        <span class="icon_preview icon-fa-magento" title="magento - Brands"><i class="fa-magento fab" data-name="magento"></i></span>
                                        <span class="icon_preview icon-fa-magic" title="magic - Solid"><i class="fa-magic fas" data-name="magic"></i></span>
                                        <span class="icon_preview icon-fa-magnet" title="magnet - Solid"><i class="fa-magnet fas" data-name="magnet"></i></span>
                                        <span class="icon_preview icon-fa-mail-bulk" title="mail-bulk - Solid"><i class="fa-mail-bulk fas" data-name="mail-bulk"></i></span>
                                        <span class="icon_preview icon-fa-mailchimp" title="mailchimp - Brands"><i class="fa-mailchimp fab" data-name="mailchimp"></i></span>
                                        <span class="icon_preview icon-fa-male" title="male - Solid"><i class="fa-male fas" data-name="male"></i></span>
                                        <span class="icon_preview icon-fa-mandalorian" title="mandalorian - Brands"><i class="fa-mandalorian fab" data-name="mandalorian"></i></span>
                                        <span class="icon_preview icon-fa-map" title="map - Solid"><i class="fa-map fas" data-name="map"></i></span>
                                        <span class="icon_preview icon-fa-map" title="map - Regular"><i class="fa-map far" data-name="map"></i></span>
                                        <span class="icon_preview icon-fa-map-marked" title="map-marked - Solid"><i class="fa-map-marked fas" data-name="map-marked"></i></span>
                                        <span class="icon_preview icon-fa-map-marked-alt" title="map-marked-alt - Solid"><i class="fa-map-marked-alt fas" data-name="map-marked-alt"></i></span>
                                        <span class="icon_preview icon-fa-map-marker" title="map-marker - Solid"><i class="fa-map-marker fas" data-name="map-marker"></i></span>
                                        <span class="icon_preview icon-fa-map-marker-alt" title="map-marker-alt - Solid"><i class="fa-map-marker-alt fas" data-name="map-marker-alt"></i></span>
                                        <span class="icon_preview icon-fa-map-pin" title="map-pin - Solid"><i class="fa-map-pin fas" data-name="map-pin"></i></span>
                                        <span class="icon_preview icon-fa-map-signs" title="map-signs - Solid"><i class="fa-map-signs fas" data-name="map-signs"></i></span>
                                        <span class="icon_preview icon-fa-markdown" title="markdown - Brands"><i class="fa-markdown fab" data-name="markdown"></i></span>
                                        <span class="icon_preview icon-fa-marker" title="marker - Solid"><i class="fa-marker fas" data-name="marker"></i></span>
                                        <span class="icon_preview icon-fa-mars" title="mars - Solid"><i class="fa-mars fas" data-name="mars"></i></span>
                                        <span class="icon_preview icon-fa-mars-double" title="mars-double - Solid"><i class="fa-mars-double fas" data-name="mars-double"></i></span>
                                        <span class="icon_preview icon-fa-mars-stroke" title="mars-stroke - Solid"><i class="fa-mars-stroke fas" data-name="mars-stroke"></i></span>
                                        <span class="icon_preview icon-fa-mars-stroke-h" title="mars-stroke-h - Solid"><i class="fa-mars-stroke-h fas" data-name="mars-stroke-h"></i></span>
                                        <span class="icon_preview icon-fa-mars-stroke-v" title="mars-stroke-v - Solid"><i class="fa-mars-stroke-v fas" data-name="mars-stroke-v"></i></span>
                                        <span class="icon_preview icon-fa-mask" title="mask - Solid"><i class="fa-mask fas" data-name="mask"></i></span>
                                        <span class="icon_preview icon-fa-mastodon" title="mastodon - Brands"><i class="fa-mastodon fab" data-name="mastodon"></i></span>
                                        <span class="icon_preview icon-fa-maxcdn" title="maxcdn - Brands"><i class="fa-maxcdn fab" data-name="maxcdn"></i></span>
                                        <span class="icon_preview icon-fa-medal" title="medal - Solid"><i class="fa-medal fas" data-name="medal"></i></span>
                                        <span class="icon_preview icon-fa-medapps" title="medapps - Brands"><i class="fa-medapps fab" data-name="medapps"></i></span>
                                        <span class="icon_preview icon-fa-medium" title="medium - Brands"><i class="fa-medium fab" data-name="medium"></i></span>
                                        <span class="icon_preview icon-fa-medium-m" title="medium-m - Brands"><i class="fa-medium-m fab" data-name="medium-m"></i></span>
                                        <span class="icon_preview icon-fa-medkit" title="medkit - Solid"><i class="fa-medkit fas" data-name="medkit"></i></span>
                                        <span class="icon_preview icon-fa-medrt" title="medrt - Brands"><i class="fa-medrt fab" data-name="medrt"></i></span>
                                        <span class="icon_preview icon-fa-meetup" title="meetup - Brands"><i class="fa-meetup fab" data-name="meetup"></i></span>
                                        <span class="icon_preview icon-fa-megaport" title="megaport - Brands"><i class="fa-megaport fab" data-name="megaport"></i></span>
                                        <span class="icon_preview icon-fa-meh" title="meh - Solid"><i class="fa-meh fas" data-name="meh"></i></span>
                                        <span class="icon_preview icon-fa-meh" title="meh - Regular"><i class="fa-meh far" data-name="meh"></i></span>
                                        <span class="icon_preview icon-fa-meh-blank" title="meh-blank - Solid"><i class="fa-meh-blank fas" data-name="meh-blank"></i></span>
                                        <span class="icon_preview icon-fa-meh-blank" title="meh-blank - Regular"><i class="fa-meh-blank far" data-name="meh-blank"></i></span>
                                        <span class="icon_preview icon-fa-meh-rolling-eyes" title="meh-rolling-eyes - Solid"><i class="fa-meh-rolling-eyes fas" data-name="meh-rolling-eyes"></i></span>
                                        <span class="icon_preview icon-fa-meh-rolling-eyes" title="meh-rolling-eyes - Regular"><i class="fa-meh-rolling-eyes far" data-name="meh-rolling-eyes"></i></span>
                                        <span class="icon_preview icon-fa-memory" title="memory - Solid"><i class="fa-memory fas" data-name="memory"></i></span>
                                        <span class="icon_preview icon-fa-mendeley" title="mendeley - Brands"><i class="fa-mendeley fab" data-name="mendeley"></i></span>
                                        <span class="icon_preview icon-fa-menorah" title="menorah - Solid"><i class="fa-menorah fas" data-name="menorah"></i></span>
                                        <span class="icon_preview icon-fa-mercury" title="mercury - Solid"><i class="fa-mercury fas" data-name="mercury"></i></span>
                                        <span class="icon_preview icon-fa-meteor" title="meteor - Solid"><i class="fa-meteor fas" data-name="meteor"></i></span>
                                        <span class="icon_preview icon-fa-microchip" title="microchip - Solid"><i class="fa-microchip fas" data-name="microchip"></i></span>
                                        <span class="icon_preview icon-fa-microphone" title="microphone - Solid"><i class="fa-microphone fas" data-name="microphone"></i></span>
                                        <span class="icon_preview icon-fa-microphone-alt" title="microphone-alt - Solid"><i class="fa-microphone-alt fas" data-name="microphone-alt"></i></span>
                                        <span class="icon_preview icon-fa-microphone-alt-slash" title="microphone-alt-slash - Solid"><i class="fa-microphone-alt-slash fas" data-name="microphone-alt-slash"></i></span>
                                        <span class="icon_preview icon-fa-microphone-slash" title="microphone-slash - Solid"><i class="fa-microphone-slash fas" data-name="microphone-slash"></i></span>
                                        <span class="icon_preview icon-fa-microscope" title="microscope - Solid"><i class="fa-microscope fas" data-name="microscope"></i></span>
                                        <span class="icon_preview icon-fa-microsoft" title="microsoft - Brands"><i class="fa-microsoft fab" data-name="microsoft"></i></span>
                                        <span class="icon_preview icon-fa-minus" title="minus - Solid"><i class="fa-minus fas" data-name="minus"></i></span>
                                        <span class="icon_preview icon-fa-minus-circle" title="minus-circle - Solid"><i class="fa-minus-circle fas" data-name="minus-circle"></i></span>
                                        <span class="icon_preview icon-fa-minus-square" title="minus-square - Solid"><i class="fa-minus-square fas" data-name="minus-square"></i></span>
                                        <span class="icon_preview icon-fa-minus-square" title="minus-square - Regular"><i class="fa-minus-square far" data-name="minus-square"></i></span>
                                        <span class="icon_preview icon-fa-mitten" title="mitten - Solid"><i class="fa-mitten fas" data-name="mitten"></i></span>
                                        <span class="icon_preview icon-fa-mix" title="mix - Brands"><i class="fa-mix fab" data-name="mix"></i></span>
                                        <span class="icon_preview icon-fa-mixcloud" title="mixcloud - Brands"><i class="fa-mixcloud fab" data-name="mixcloud"></i></span>
                                        <span class="icon_preview icon-fa-mizuni" title="mizuni - Brands"><i class="fa-mizuni fab" data-name="mizuni"></i></span>
                                        <span class="icon_preview icon-fa-mobile" title="mobile - Solid"><i class="fa-mobile fas" data-name="mobile"></i></span>
                                        <span class="icon_preview icon-fa-mobile-alt" title="mobile-alt - Solid"><i class="fa-mobile-alt fas" data-name="mobile-alt"></i></span>
                                        <span class="icon_preview icon-fa-modx" title="modx - Brands"><i class="fa-modx fab" data-name="modx"></i></span>
                                        <span class="icon_preview icon-fa-monero" title="monero - Brands"><i class="fa-monero fab" data-name="monero"></i></span>
                                        <span class="icon_preview icon-fa-money-bill" title="money-bill - Solid"><i class="fa-money-bill fas" data-name="money-bill"></i></span>
                                        <span class="icon_preview icon-fa-money-bill-alt" title="money-bill-alt - Solid"><i class="fa-money-bill-alt fas" data-name="money-bill-alt"></i></span>
                                        <span class="icon_preview icon-fa-money-bill-alt" title="money-bill-alt - Regular"><i class="fa-money-bill-alt far" data-name="money-bill-alt"></i></span>
                                        <span class="icon_preview icon-fa-money-bill-wave" title="money-bill-wave - Solid"><i class="fa-money-bill-wave fas" data-name="money-bill-wave"></i></span>
                                        <span class="icon_preview icon-fa-money-bill-wave-alt" title="money-bill-wave-alt - Solid"><i class="fa-money-bill-wave-alt fas" data-name="money-bill-wave-alt"></i></span>
                                        <span class="icon_preview icon-fa-money-check" title="money-check - Solid"><i class="fa-money-check fas" data-name="money-check"></i></span>
                                        <span class="icon_preview icon-fa-money-check-alt" title="money-check-alt - Solid"><i class="fa-money-check-alt fas" data-name="money-check-alt"></i></span>
                                        <span class="icon_preview icon-fa-monument" title="monument - Solid"><i class="fa-monument fas" data-name="monument"></i></span>
                                        <span class="icon_preview icon-fa-moon" title="moon - Solid"><i class="fa-moon fas" data-name="moon"></i></span>
                                        <span class="icon_preview icon-fa-moon" title="moon - Regular"><i class="fa-moon far" data-name="moon"></i></span>
                                        <span class="icon_preview icon-fa-mortar-pestle" title="mortar-pestle - Solid"><i class="fa-mortar-pestle fas" data-name="mortar-pestle"></i></span>
                                        <span class="icon_preview icon-fa-mosque" title="mosque - Solid"><i class="fa-mosque fas" data-name="mosque"></i></span>
                                        <span class="icon_preview icon-fa-motorcycle" title="motorcycle - Solid"><i class="fa-motorcycle fas" data-name="motorcycle"></i></span>
                                        <span class="icon_preview icon-fa-mountain" title="mountain - Solid"><i class="fa-mountain fas" data-name="mountain"></i></span>
                                        <span class="icon_preview icon-fa-mouse-pointer" title="mouse-pointer - Solid"><i class="fa-mouse-pointer fas" data-name="mouse-pointer"></i></span>
                                        <span class="icon_preview icon-fa-mug-hot" title="mug-hot - Solid"><i class="fa-mug-hot fas" data-name="mug-hot"></i></span>
                                        <span class="icon_preview icon-fa-music" title="music - Solid"><i class="fa-music fas" data-name="music"></i></span>
                                        <span class="icon_preview icon-fa-napster" title="napster - Brands"><i class="fa-napster fab" data-name="napster"></i></span>
                                        <span class="icon_preview icon-fa-neos" title="neos - Brands"><i class="fa-neos fab" data-name="neos"></i></span>
                                        <span class="icon_preview icon-fa-network-wired" title="network-wired - Solid"><i class="fa-network-wired fas" data-name="network-wired"></i></span>
                                        <span class="icon_preview icon-fa-neuter" title="neuter - Solid"><i class="fa-neuter fas" data-name="neuter"></i></span>
                                        <span class="icon_preview icon-fa-newspaper" title="newspaper - Solid"><i class="fa-newspaper fas" data-name="newspaper"></i></span>
                                        <span class="icon_preview icon-fa-newspaper" title="newspaper - Regular"><i class="fa-newspaper far" data-name="newspaper"></i></span>
                                        <span class="icon_preview icon-fa-nimblr" title="nimblr - Brands"><i class="fa-nimblr fab" data-name="nimblr"></i></span>
                                        <span class="icon_preview icon-fa-nintendo-switch" title="nintendo-switch - Brands"><i class="fa-nintendo-switch fab" data-name="nintendo-switch"></i></span>
                                        <span class="icon_preview icon-fa-node" title="node - Brands"><i class="fa-node fab" data-name="node"></i></span>
                                        <span class="icon_preview icon-fa-node-js" title="node-js - Brands"><i class="fa-node-js fab" data-name="node-js"></i></span>
                                        <span class="icon_preview icon-fa-not-equal" title="not-equal - Solid"><i class="fa-not-equal fas" data-name="not-equal"></i></span>
                                        <span class="icon_preview icon-fa-notes-medical" title="notes-medical - Solid"><i class="fa-notes-medical fas" data-name="notes-medical"></i></span>
                                        <span class="icon_preview icon-fa-npm" title="npm - Brands"><i class="fa-npm fab" data-name="npm"></i></span>
                                        <span class="icon_preview icon-fa-ns8" title="ns8 - Brands"><i class="fa-ns8 fab" data-name="ns8"></i></span>
                                        <span class="icon_preview icon-fa-nutritionix" title="nutritionix - Brands"><i class="fa-nutritionix fab" data-name="nutritionix"></i></span>
                                        <span class="icon_preview icon-fa-object-group" title="object-group - Solid"><i class="fa-object-group fas" data-name="object-group"></i></span>
                                        <span class="icon_preview icon-fa-object-group" title="object-group - Regular"><i class="fa-object-group far" data-name="object-group"></i></span>
                                        <span class="icon_preview icon-fa-object-ungroup" title="object-ungroup - Solid"><i class="fa-object-ungroup fas" data-name="object-ungroup"></i></span>
                                        <span class="icon_preview icon-fa-object-ungroup" title="object-ungroup - Regular"><i class="fa-object-ungroup far" data-name="object-ungroup"></i></span>
                                        <span class="icon_preview icon-fa-odnoklassniki" title="odnoklassniki - Brands"><i class="fa-odnoklassniki fab" data-name="odnoklassniki"></i></span>
                                        <span class="icon_preview icon-fa-odnoklassniki-square" title="odnoklassniki-square - Brands"><i class="fa-odnoklassniki-square fab" data-name="odnoklassniki-square"></i></span>
                                        <span class="icon_preview icon-fa-oil-can" title="oil-can - Solid"><i class="fa-oil-can fas" data-name="oil-can"></i></span>
                                        <span class="icon_preview icon-fa-old-republic" title="old-republic - Brands"><i class="fa-old-republic fab" data-name="old-republic"></i></span>
                                        <span class="icon_preview icon-fa-om" title="om - Solid"><i class="fa-om fas" data-name="om"></i></span>
                                        <span class="icon_preview icon-fa-opencart" title="opencart - Brands"><i class="fa-opencart fab" data-name="opencart"></i></span>
                                        <span class="icon_preview icon-fa-openid" title="openid - Brands"><i class="fa-openid fab" data-name="openid"></i></span>
                                        <span class="icon_preview icon-fa-opera" title="opera - Brands"><i class="fa-opera fab" data-name="opera"></i></span>
                                        <span class="icon_preview icon-fa-optin-monster" title="optin-monster - Brands"><i class="fa-optin-monster fab" data-name="optin-monster"></i></span>
                                        <span class="icon_preview icon-fa-osi" title="osi - Brands"><i class="fa-osi fab" data-name="osi"></i></span>
                                        <span class="icon_preview icon-fa-otter" title="otter - Solid"><i class="fa-otter fas" data-name="otter"></i></span>
                                        <span class="icon_preview icon-fa-outdent" title="outdent - Solid"><i class="fa-outdent fas" data-name="outdent"></i></span>
                                        <span class="icon_preview icon-fa-page4" title="page4 - Brands"><i class="fa-page4 fab" data-name="page4"></i></span>
                                        <span class="icon_preview icon-fa-pagelines" title="pagelines - Brands"><i class="fa-pagelines fab" data-name="pagelines"></i></span>
                                        <span class="icon_preview icon-fa-pager" title="pager - Solid"><i class="fa-pager fas" data-name="pager"></i></span>
                                        <span class="icon_preview icon-fa-paint-brush" title="paint-brush - Solid"><i class="fa-paint-brush fas" data-name="paint-brush"></i></span>
                                        <span class="icon_preview icon-fa-paint-roller" title="paint-roller - Solid"><i class="fa-paint-roller fas" data-name="paint-roller"></i></span>
                                        <span class="icon_preview icon-fa-palette" title="palette - Solid"><i class="fa-palette fas" data-name="palette"></i></span>
                                        <span class="icon_preview icon-fa-palfed" title="palfed - Brands"><i class="fa-palfed fab" data-name="palfed"></i></span>
                                        <span class="icon_preview icon-fa-pallet" title="pallet - Solid"><i class="fa-pallet fas" data-name="pallet"></i></span>
                                        <span class="icon_preview icon-fa-paper-plane" title="paper-plane - Solid"><i class="fa-paper-plane fas" data-name="paper-plane"></i></span>
                                        <span class="icon_preview icon-fa-paper-plane" title="paper-plane - Regular"><i class="fa-paper-plane far" data-name="paper-plane"></i></span>
                                        <span class="icon_preview icon-fa-paperclip" title="paperclip - Solid"><i class="fa-paperclip fas" data-name="paperclip"></i></span>
                                        <span class="icon_preview icon-fa-parachute-box" title="parachute-box - Solid"><i class="fa-parachute-box fas" data-name="parachute-box"></i></span>
                                        <span class="icon_preview icon-fa-paragraph" title="paragraph - Solid"><i class="fa-paragraph fas" data-name="paragraph"></i></span>
                                        <span class="icon_preview icon-fa-parking" title="parking - Solid"><i class="fa-parking fas" data-name="parking"></i></span>
                                        <span class="icon_preview icon-fa-passport" title="passport - Solid"><i class="fa-passport fas" data-name="passport"></i></span>
                                        <span class="icon_preview icon-fa-pastafarianism" title="pastafarianism - Solid"><i class="fa-pastafarianism fas" data-name="pastafarianism"></i></span>
                                        <span class="icon_preview icon-fa-paste" title="paste - Solid"><i class="fa-paste fas" data-name="paste"></i></span>
                                        <span class="icon_preview icon-fa-patreon" title="patreon - Brands"><i class="fa-patreon fab" data-name="patreon"></i></span>
                                        <span class="icon_preview icon-fa-pause" title="pause - Solid"><i class="fa-pause fas" data-name="pause"></i></span>
                                        <span class="icon_preview icon-fa-pause-circle" title="pause-circle - Solid"><i class="fa-pause-circle fas" data-name="pause-circle"></i></span>
                                        <span class="icon_preview icon-fa-pause-circle" title="pause-circle - Regular"><i class="fa-pause-circle far" data-name="pause-circle"></i></span>
                                        <span class="icon_preview icon-fa-paw" title="paw - Solid"><i class="fa-paw fas" data-name="paw"></i></span>
                                        <span class="icon_preview icon-fa-paypal" title="paypal - Brands"><i class="fa-paypal fab" data-name="paypal"></i></span>
                                        <span class="icon_preview icon-fa-peace" title="peace - Solid"><i class="fa-peace fas" data-name="peace"></i></span>
                                        <span class="icon_preview icon-fa-pen" title="pen - Solid"><i class="fa-pen fas" data-name="pen"></i></span>
                                        <span class="icon_preview icon-fa-pen-alt" title="pen-alt - Solid"><i class="fa-pen-alt fas" data-name="pen-alt"></i></span>
                                        <span class="icon_preview icon-fa-pen-fancy" title="pen-fancy - Solid"><i class="fa-pen-fancy fas" data-name="pen-fancy"></i></span>
                                        <span class="icon_preview icon-fa-pen-nib" title="pen-nib - Solid"><i class="fa-pen-nib fas" data-name="pen-nib"></i></span>
                                        <span class="icon_preview icon-fa-pen-square" title="pen-square - Solid"><i class="fa-pen-square fas" data-name="pen-square"></i></span>
                                        <span class="icon_preview icon-fa-pencil-alt" title="pencil-alt - Solid"><i class="fa-pencil-alt fas" data-name="pencil-alt"></i></span>
                                        <span class="icon_preview icon-fa-pencil-ruler" title="pencil-ruler - Solid"><i class="fa-pencil-ruler fas" data-name="pencil-ruler"></i></span>
                                        <span class="icon_preview icon-fa-penny-arcade" title="penny-arcade - Brands"><i class="fa-penny-arcade fab" data-name="penny-arcade"></i></span>
                                        <span class="icon_preview icon-fa-people-carry" title="people-carry - Solid"><i class="fa-people-carry fas" data-name="people-carry"></i></span>
                                        <span class="icon_preview icon-fa-pepper-hot" title="pepper-hot - Solid"><i class="fa-pepper-hot fas" data-name="pepper-hot"></i></span>
                                        <span class="icon_preview icon-fa-percent" title="percent - Solid"><i class="fa-percent fas" data-name="percent"></i></span>
                                        <span class="icon_preview icon-fa-percentage" title="percentage - Solid"><i class="fa-percentage fas" data-name="percentage"></i></span>
                                        <span class="icon_preview icon-fa-periscope" title="periscope - Brands"><i class="fa-periscope fab" data-name="periscope"></i></span>
                                        <span class="icon_preview icon-fa-person-booth" title="person-booth - Solid"><i class="fa-person-booth fas" data-name="person-booth"></i></span>
                                        <span class="icon_preview icon-fa-phabricator" title="phabricator - Brands"><i class="fa-phabricator fab" data-name="phabricator"></i></span>
                                        <span class="icon_preview icon-fa-phoenix-framework" title="phoenix-framework - Brands"><i class="fa-phoenix-framework fab" data-name="phoenix-framework"></i></span>
                                        <span class="icon_preview icon-fa-phoenix-squadron" title="phoenix-squadron - Brands"><i class="fa-phoenix-squadron fab" data-name="phoenix-squadron"></i></span>
                                        <span class="icon_preview icon-fa-phone" title="phone - Solid"><i class="fa-phone fas" data-name="phone"></i></span>
                                        <span class="icon_preview icon-fa-phone-slash" title="phone-slash - Solid"><i class="fa-phone-slash fas" data-name="phone-slash"></i></span>
                                        <span class="icon_preview icon-fa-phone-square" title="phone-square - Solid"><i class="fa-phone-square fas" data-name="phone-square"></i></span>
                                        <span class="icon_preview icon-fa-phone-volume" title="phone-volume - Solid"><i class="fa-phone-volume fas" data-name="phone-volume"></i></span>
                                        <span class="icon_preview icon-fa-php" title="php - Brands"><i class="fa-php fab" data-name="php"></i></span>
                                        <span class="icon_preview icon-fa-pied-piper" title="pied-piper - Brands"><i class="fa-pied-piper fab" data-name="pied-piper"></i></span>
                                        <span class="icon_preview icon-fa-pied-piper-alt" title="pied-piper-alt - Brands"><i class="fa-pied-piper-alt fab" data-name="pied-piper-alt"></i></span>
                                        <span class="icon_preview icon-fa-pied-piper-hat" title="pied-piper-hat - Brands"><i class="fa-pied-piper-hat fab" data-name="pied-piper-hat"></i></span>
                                        <span class="icon_preview icon-fa-pied-piper-pp" title="pied-piper-pp - Brands"><i class="fa-pied-piper-pp fab" data-name="pied-piper-pp"></i></span>
                                        <span class="icon_preview icon-fa-piggy-bank" title="piggy-bank - Solid"><i class="fa-piggy-bank fas" data-name="piggy-bank"></i></span>
                                        <span class="icon_preview icon-fa-pills" title="pills - Solid"><i class="fa-pills fas" data-name="pills"></i></span>
                                        <span class="icon_preview icon-fa-pinterest" title="pinterest - Brands"><i class="fa-pinterest fab" data-name="pinterest"></i></span>
                                        <span class="icon_preview icon-fa-pinterest-p" title="pinterest-p - Brands"><i class="fa-pinterest-p fab" data-name="pinterest-p"></i></span>
                                        <span class="icon_preview icon-fa-pinterest-square" title="pinterest-square - Brands"><i class="fa-pinterest-square fab" data-name="pinterest-square"></i></span>
                                        <span class="icon_preview icon-fa-pizza-slice" title="pizza-slice - Solid"><i class="fa-pizza-slice fas" data-name="pizza-slice"></i></span>
                                        <span class="icon_preview icon-fa-place-of-worship" title="place-of-worship - Solid"><i class="fa-place-of-worship fas" data-name="place-of-worship"></i></span>
                                        <span class="icon_preview icon-fa-plane" title="plane - Solid"><i class="fa-plane fas" data-name="plane"></i></span>
                                        <span class="icon_preview icon-fa-plane-arrival" title="plane-arrival - Solid"><i class="fa-plane-arrival fas" data-name="plane-arrival"></i></span>
                                        <span class="icon_preview icon-fa-plane-departure" title="plane-departure - Solid"><i class="fa-plane-departure fas" data-name="plane-departure"></i></span>
                                        <span class="icon_preview icon-fa-play" title="play - Solid"><i class="fa-play fas" data-name="play"></i></span>
                                        <span class="icon_preview icon-fa-play-circle" title="play-circle - Solid"><i class="fa-play-circle fas" data-name="play-circle"></i></span>
                                        <span class="icon_preview icon-fa-play-circle" title="play-circle - Regular"><i class="fa-play-circle far" data-name="play-circle"></i></span>
                                        <span class="icon_preview icon-fa-playstation" title="playstation - Brands"><i class="fa-playstation fab" data-name="playstation"></i></span>
                                        <span class="icon_preview icon-fa-plug" title="plug - Solid"><i class="fa-plug fas" data-name="plug"></i></span>
                                        <span class="icon_preview icon-fa-plus" title="plus - Solid"><i class="fa-plus fas" data-name="plus"></i></span>
                                        <span class="icon_preview icon-fa-plus-circle" title="plus-circle - Solid"><i class="fa-plus-circle fas" data-name="plus-circle"></i></span>
                                        <span class="icon_preview icon-fa-plus-square" title="plus-square - Solid"><i class="fa-plus-square fas" data-name="plus-square"></i></span>
                                        <span class="icon_preview icon-fa-plus-square" title="plus-square - Regular"><i class="fa-plus-square far" data-name="plus-square"></i></span>
                                        <span class="icon_preview icon-fa-podcast" title="podcast - Solid"><i class="fa-podcast fas" data-name="podcast"></i></span>
                                        <span class="icon_preview icon-fa-poll" title="poll - Solid"><i class="fa-poll fas" data-name="poll"></i></span>
                                        <span class="icon_preview icon-fa-poll-h" title="poll-h - Solid"><i class="fa-poll-h fas" data-name="poll-h"></i></span>
                                        <span class="icon_preview icon-fa-poo" title="poo - Solid"><i class="fa-poo fas" data-name="poo"></i></span>
                                        <span class="icon_preview icon-fa-poo-storm" title="poo-storm - Solid"><i class="fa-poo-storm fas" data-name="poo-storm"></i></span>
                                        <span class="icon_preview icon-fa-poop" title="poop - Solid"><i class="fa-poop fas" data-name="poop"></i></span>
                                        <span class="icon_preview icon-fa-portrait" title="portrait - Solid"><i class="fa-portrait fas" data-name="portrait"></i></span>
                                        <span class="icon_preview icon-fa-pound-sign" title="pound-sign - Solid"><i class="fa-pound-sign fas" data-name="pound-sign"></i></span>
                                        <span class="icon_preview icon-fa-power-off" title="power-off - Solid"><i class="fa-power-off fas" data-name="power-off"></i></span>
                                        <span class="icon_preview icon-fa-pray" title="pray - Solid"><i class="fa-pray fas" data-name="pray"></i></span>
                                        <span class="icon_preview icon-fa-praying-hands" title="praying-hands - Solid"><i class="fa-praying-hands fas" data-name="praying-hands"></i></span>
                                        <span class="icon_preview icon-fa-prescription" title="prescription - Solid"><i class="fa-prescription fas" data-name="prescription"></i></span>
                                        <span class="icon_preview icon-fa-prescription-bottle" title="prescription-bottle - Solid"><i class="fa-prescription-bottle fas" data-name="prescription-bottle"></i></span>
                                        <span class="icon_preview icon-fa-prescription-bottle-alt" title="prescription-bottle-alt - Solid"><i class="fa-prescription-bottle-alt fas" data-name="prescription-bottle-alt"></i></span>
                                        <span class="icon_preview icon-fa-print" title="print - Solid"><i class="fa-print fas" data-name="print"></i></span>
                                        <span class="icon_preview icon-fa-procedures" title="procedures - Solid"><i class="fa-procedures fas" data-name="procedures"></i></span>
                                        <span class="icon_preview icon-fa-product-hunt" title="product-hunt - Brands"><i class="fa-product-hunt fab" data-name="product-hunt"></i></span>
                                        <span class="icon_preview icon-fa-project-diagram" title="project-diagram - Solid"><i class="fa-project-diagram fas" data-name="project-diagram"></i></span>
                                        <span class="icon_preview icon-fa-pushed" title="pushed - Brands"><i class="fa-pushed fab" data-name="pushed"></i></span>
                                        <span class="icon_preview icon-fa-puzzle-piece" title="puzzle-piece - Solid"><i class="fa-puzzle-piece fas" data-name="puzzle-piece"></i></span>
                                        <span class="icon_preview icon-fa-python" title="python - Brands"><i class="fa-python fab" data-name="python"></i></span>
                                        <span class="icon_preview icon-fa-qq" title="qq - Brands"><i class="fa-qq fab" data-name="qq"></i></span>
                                        <span class="icon_preview icon-fa-qrcode" title="qrcode - Solid"><i class="fa-qrcode fas" data-name="qrcode"></i></span>
                                        <span class="icon_preview icon-fa-question" title="question - Solid"><i class="fa-question fas" data-name="question"></i></span>
                                        <span class="icon_preview icon-fa-question-circle" title="question-circle - Solid"><i class="fa-question-circle fas" data-name="question-circle"></i></span>
                                        <span class="icon_preview icon-fa-question-circle" title="question-circle - Regular"><i class="fa-question-circle far" data-name="question-circle"></i></span>
                                        <span class="icon_preview icon-fa-quidditch" title="quidditch - Solid"><i class="fa-quidditch fas" data-name="quidditch"></i></span>
                                        <span class="icon_preview icon-fa-quinscape" title="quinscape - Brands"><i class="fa-quinscape fab" data-name="quinscape"></i></span>
                                        <span class="icon_preview icon-fa-quora" title="quora - Brands"><i class="fa-quora fab" data-name="quora"></i></span>
                                        <span class="icon_preview icon-fa-quote-left" title="quote-left - Solid"><i class="fa-quote-left fas" data-name="quote-left"></i></span>
                                        <span class="icon_preview icon-fa-quote-right" title="quote-right - Solid"><i class="fa-quote-right fas" data-name="quote-right"></i></span>
                                        <span class="icon_preview icon-fa-quran" title="quran - Solid"><i class="fa-quran fas" data-name="quran"></i></span>
                                        <span class="icon_preview icon-fa-r-project" title="r-project - Brands"><i class="fa-r-project fab" data-name="r-project"></i></span>
                                        <span class="icon_preview icon-fa-radiation" title="radiation - Solid"><i class="fa-radiation fas" data-name="radiation"></i></span>
                                        <span class="icon_preview icon-fa-radiation-alt" title="radiation-alt - Solid"><i class="fa-radiation-alt fas" data-name="radiation-alt"></i></span>
                                        <span class="icon_preview icon-fa-rainbow" title="rainbow - Solid"><i class="fa-rainbow fas" data-name="rainbow"></i></span>
                                        <span class="icon_preview icon-fa-random" title="random - Solid"><i class="fa-random fas" data-name="random"></i></span>
                                        <span class="icon_preview icon-fa-raspberry-pi" title="raspberry-pi - Brands"><i class="fa-raspberry-pi fab" data-name="raspberry-pi"></i></span>
                                        <span class="icon_preview icon-fa-ravelry" title="ravelry - Brands"><i class="fa-ravelry fab" data-name="ravelry"></i></span>
                                        <span class="icon_preview icon-fa-react" title="react - Brands"><i class="fa-react fab" data-name="react"></i></span>
                                        <span class="icon_preview icon-fa-reacteurope" title="reacteurope - Brands"><i class="fa-reacteurope fab" data-name="reacteurope"></i></span>
                                        <span class="icon_preview icon-fa-readme" title="readme - Brands"><i class="fa-readme fab" data-name="readme"></i></span>
                                        <span class="icon_preview icon-fa-rebel" title="rebel - Brands"><i class="fa-rebel fab" data-name="rebel"></i></span>
                                        <span class="icon_preview icon-fa-receipt" title="receipt - Solid"><i class="fa-receipt fas" data-name="receipt"></i></span>
                                        <span class="icon_preview icon-fa-recycle" title="recycle - Solid"><i class="fa-recycle fas" data-name="recycle"></i></span>
                                        <span class="icon_preview icon-fa-red-river" title="red-river - Brands"><i class="fa-red-river fab" data-name="red-river"></i></span>
                                        <span class="icon_preview icon-fa-reddit" title="reddit - Brands"><i class="fa-reddit fab" data-name="reddit"></i></span>
                                        <span class="icon_preview icon-fa-reddit-alien" title="reddit-alien - Brands"><i class="fa-reddit-alien fab" data-name="reddit-alien"></i></span>
                                        <span class="icon_preview icon-fa-reddit-square" title="reddit-square - Brands"><i class="fa-reddit-square fab" data-name="reddit-square"></i></span>
                                        <span class="icon_preview icon-fa-redhat" title="redhat - Brands"><i class="fa-redhat fab" data-name="redhat"></i></span>
                                        <span class="icon_preview icon-fa-redo" title="redo - Solid"><i class="fa-redo fas" data-name="redo"></i></span>
                                        <span class="icon_preview icon-fa-redo-alt" title="redo-alt - Solid"><i class="fa-redo-alt fas" data-name="redo-alt"></i></span>
                                        <span class="icon_preview icon-fa-registered" title="registered - Solid"><i class="fa-registered fas" data-name="registered"></i></span>
                                        <span class="icon_preview icon-fa-registered" title="registered - Regular"><i class="fa-registered far" data-name="registered"></i></span>
                                        <span class="icon_preview icon-fa-renren" title="renren - Brands"><i class="fa-renren fab" data-name="renren"></i></span>
                                        <span class="icon_preview icon-fa-reply" title="reply - Solid"><i class="fa-reply fas" data-name="reply"></i></span>
                                        <span class="icon_preview icon-fa-reply-all" title="reply-all - Solid"><i class="fa-reply-all fas" data-name="reply-all"></i></span>
                                        <span class="icon_preview icon-fa-replyd" title="replyd - Brands"><i class="fa-replyd fab" data-name="replyd"></i></span>
                                        <span class="icon_preview icon-fa-republican" title="republican - Solid"><i class="fa-republican fas" data-name="republican"></i></span>
                                        <span class="icon_preview icon-fa-researchgate" title="researchgate - Brands"><i class="fa-researchgate fab" data-name="researchgate"></i></span>
                                        <span class="icon_preview icon-fa-resolving" title="resolving - Brands"><i class="fa-resolving fab" data-name="resolving"></i></span>
                                        <span class="icon_preview icon-fa-restroom" title="restroom - Solid"><i class="fa-restroom fas" data-name="restroom"></i></span>
                                        <span class="icon_preview icon-fa-retweet" title="retweet - Solid"><i class="fa-retweet fas" data-name="retweet"></i></span>
                                        <span class="icon_preview icon-fa-rev" title="rev - Brands"><i class="fa-rev fab" data-name="rev"></i></span>
                                        <span class="icon_preview icon-fa-ribbon" title="ribbon - Solid"><i class="fa-ribbon fas" data-name="ribbon"></i></span>
                                        <span class="icon_preview icon-fa-ring" title="ring - Solid"><i class="fa-ring fas" data-name="ring"></i></span>
                                        <span class="icon_preview icon-fa-road" title="road - Solid"><i class="fa-road fas" data-name="road"></i></span>
                                        <span class="icon_preview icon-fa-robot" title="robot - Solid"><i class="fa-robot fas" data-name="robot"></i></span>
                                        <span class="icon_preview icon-fa-rocket" title="rocket - Solid"><i class="fa-rocket fas" data-name="rocket"></i></span>
                                        <span class="icon_preview icon-fa-rocketchat" title="rocketchat - Brands"><i class="fa-rocketchat fab" data-name="rocketchat"></i></span>
                                        <span class="icon_preview icon-fa-rockrms" title="rockrms - Brands"><i class="fa-rockrms fab" data-name="rockrms"></i></span>
                                        <span class="icon_preview icon-fa-route" title="route - Solid"><i class="fa-route fas" data-name="route"></i></span>
                                        <span class="icon_preview icon-fa-rss" title="rss - Solid"><i class="fa-rss fas" data-name="rss"></i></span>
                                        <span class="icon_preview icon-fa-rss-square" title="rss-square - Solid"><i class="fa-rss-square fas" data-name="rss-square"></i></span>
                                        <span class="icon_preview icon-fa-ruble-sign" title="ruble-sign - Solid"><i class="fa-ruble-sign fas" data-name="ruble-sign"></i></span>
                                        <span class="icon_preview icon-fa-ruler" title="ruler - Solid"><i class="fa-ruler fas" data-name="ruler"></i></span>
                                        <span class="icon_preview icon-fa-ruler-combined" title="ruler-combined - Solid"><i class="fa-ruler-combined fas" data-name="ruler-combined"></i></span>
                                        <span class="icon_preview icon-fa-ruler-horizontal" title="ruler-horizontal - Solid"><i class="fa-ruler-horizontal fas" data-name="ruler-horizontal"></i></span>
                                        <span class="icon_preview icon-fa-ruler-vertical" title="ruler-vertical - Solid"><i class="fa-ruler-vertical fas" data-name="ruler-vertical"></i></span>
                                        <span class="icon_preview icon-fa-running" title="running - Solid"><i class="fa-running fas" data-name="running"></i></span>
                                        <span class="icon_preview icon-fa-rupee-sign" title="rupee-sign - Solid"><i class="fa-rupee-sign fas" data-name="rupee-sign"></i></span>
                                        <span class="icon_preview icon-fa-sad-cry" title="sad-cry - Solid"><i class="fa-sad-cry fas" data-name="sad-cry"></i></span>
                                        <span class="icon_preview icon-fa-sad-cry" title="sad-cry - Regular"><i class="fa-sad-cry far" data-name="sad-cry"></i></span>
                                        <span class="icon_preview icon-fa-sad-tear" title="sad-tear - Solid"><i class="fa-sad-tear fas" data-name="sad-tear"></i></span>
                                        <span class="icon_preview icon-fa-sad-tear" title="sad-tear - Regular"><i class="fa-sad-tear far" data-name="sad-tear"></i></span>
                                        <span class="icon_preview icon-fa-safari" title="safari - Brands"><i class="fa-safari fab" data-name="safari"></i></span>
                                        <span class="icon_preview icon-fa-sass" title="sass - Brands"><i class="fa-sass fab" data-name="sass"></i></span>
                                        <span class="icon_preview icon-fa-satellite" title="satellite - Solid"><i class="fa-satellite fas" data-name="satellite"></i></span>
                                        <span class="icon_preview icon-fa-satellite-dish" title="satellite-dish - Solid"><i class="fa-satellite-dish fas" data-name="satellite-dish"></i></span>
                                        <span class="icon_preview icon-fa-save" title="save - Solid"><i class="fa-save fas" data-name="save"></i></span>
                                        <span class="icon_preview icon-fa-save" title="save - Regular"><i class="fa-save far" data-name="save"></i></span>
                                        <span class="icon_preview icon-fa-schlix" title="schlix - Brands"><i class="fa-schlix fab" data-name="schlix"></i></span>
                                        <span class="icon_preview icon-fa-school" title="school - Solid"><i class="fa-school fas" data-name="school"></i></span>
                                        <span class="icon_preview icon-fa-screwdriver" title="screwdriver - Solid"><i class="fa-screwdriver fas" data-name="screwdriver"></i></span>
                                        <span class="icon_preview icon-fa-scribd" title="scribd - Brands"><i class="fa-scribd fab" data-name="scribd"></i></span>
                                        <span class="icon_preview icon-fa-scroll" title="scroll - Solid"><i class="fa-scroll fas" data-name="scroll"></i></span>
                                        <span class="icon_preview icon-fa-sd-card" title="sd-card - Solid"><i class="fa-sd-card fas" data-name="sd-card"></i></span>
                                        <span class="icon_preview icon-fa-search" title="search - Solid"><i class="fa-search fas" data-name="search"></i></span>
                                        <span class="icon_preview icon-fa-search-dollar" title="search-dollar - Solid"><i class="fa-search-dollar fas" data-name="search-dollar"></i></span>
                                        <span class="icon_preview icon-fa-search-location" title="search-location - Solid"><i class="fa-search-location fas" data-name="search-location"></i></span>
                                        <span class="icon_preview icon-fa-search-minus" title="search-minus - Solid"><i class="fa-search-minus fas" data-name="search-minus"></i></span>
                                        <span class="icon_preview icon-fa-search-plus" title="search-plus - Solid"><i class="fa-search-plus fas" data-name="search-plus"></i></span>
                                        <span class="icon_preview icon-fa-searchengin" title="searchengin - Brands"><i class="fa-searchengin fab" data-name="searchengin"></i></span>
                                        <span class="icon_preview icon-fa-seedling" title="seedling - Solid"><i class="fa-seedling fas" data-name="seedling"></i></span>
                                        <span class="icon_preview icon-fa-sellcast" title="sellcast - Brands"><i class="fa-sellcast fab" data-name="sellcast"></i></span>
                                        <span class="icon_preview icon-fa-sellsy" title="sellsy - Brands"><i class="fa-sellsy fab" data-name="sellsy"></i></span>
                                        <span class="icon_preview icon-fa-server" title="server - Solid"><i class="fa-server fas" data-name="server"></i></span>
                                        <span class="icon_preview icon-fa-servicestack" title="servicestack - Brands"><i class="fa-servicestack fab" data-name="servicestack"></i></span>
                                        <span class="icon_preview icon-fa-shapes" title="shapes - Solid"><i class="fa-shapes fas" data-name="shapes"></i></span>
                                        <span class="icon_preview icon-fa-share" title="share - Solid"><i class="fa-share fas" data-name="share"></i></span>
                                        <span class="icon_preview icon-fa-share-alt" title="share-alt - Solid"><i class="fa-share-alt fas" data-name="share-alt"></i></span>
                                        <span class="icon_preview icon-fa-share-alt-square" title="share-alt-square - Solid"><i class="fa-share-alt-square fas" data-name="share-alt-square"></i></span>
                                        <span class="icon_preview icon-fa-share-square" title="share-square - Solid"><i class="fa-share-square fas" data-name="share-square"></i></span>
                                        <span class="icon_preview icon-fa-share-square" title="share-square - Regular"><i class="fa-share-square far" data-name="share-square"></i></span>
                                        <span class="icon_preview icon-fa-shekel-sign" title="shekel-sign - Solid"><i class="fa-shekel-sign fas" data-name="shekel-sign"></i></span>
                                        <span class="icon_preview icon-fa-shield-alt" title="shield-alt - Solid"><i class="fa-shield-alt fas" data-name="shield-alt"></i></span>
                                        <span class="icon_preview icon-fa-ship" title="ship - Solid"><i class="fa-ship fas" data-name="ship"></i></span>
                                        <span class="icon_preview icon-fa-shipping-fast" title="shipping-fast - Solid"><i class="fa-shipping-fast fas" data-name="shipping-fast"></i></span>
                                        <span class="icon_preview icon-fa-shirtsinbulk" title="shirtsinbulk - Brands"><i class="fa-shirtsinbulk fab" data-name="shirtsinbulk"></i></span>
                                        <span class="icon_preview icon-fa-shoe-prints" title="shoe-prints - Solid"><i class="fa-shoe-prints fas" data-name="shoe-prints"></i></span>
                                        <span class="icon_preview icon-fa-shopping-bag" title="shopping-bag - Solid"><i class="fa-shopping-bag fas" data-name="shopping-bag"></i></span>
                                        <span class="icon_preview icon-fa-shopping-basket" title="shopping-basket - Solid"><i class="fa-shopping-basket fas" data-name="shopping-basket"></i></span>
                                        <span class="icon_preview icon-fa-shopping-cart" title="shopping-cart - Solid"><i class="fa-shopping-cart fas" data-name="shopping-cart"></i></span>
                                        <span class="icon_preview icon-fa-shopware" title="shopware - Brands"><i class="fa-shopware fab" data-name="shopware"></i></span>
                                        <span class="icon_preview icon-fa-shower" title="shower - Solid"><i class="fa-shower fas" data-name="shower"></i></span>
                                        <span class="icon_preview icon-fa-shuttle-van" title="shuttle-van - Solid"><i class="fa-shuttle-van fas" data-name="shuttle-van"></i></span>
                                        <span class="icon_preview icon-fa-sign" title="sign - Solid"><i class="fa-sign fas" data-name="sign"></i></span>
                                        <span class="icon_preview icon-fa-sign-in-alt" title="sign-in-alt - Solid"><i class="fa-sign-in-alt fas" data-name="sign-in-alt"></i></span>
                                        <span class="icon_preview icon-fa-sign-language" title="sign-language - Solid"><i class="fa-sign-language fas" data-name="sign-language"></i></span>
                                        <span class="icon_preview icon-fa-sign-out-alt" title="sign-out-alt - Solid"><i class="fa-sign-out-alt fas" data-name="sign-out-alt"></i></span>
                                        <span class="icon_preview icon-fa-signal" title="signal - Solid"><i class="fa-signal fas" data-name="signal"></i></span>
                                        <span class="icon_preview icon-fa-signature" title="signature - Solid"><i class="fa-signature fas" data-name="signature"></i></span>
                                        <span class="icon_preview icon-fa-sim-card" title="sim-card - Solid"><i class="fa-sim-card fas" data-name="sim-card"></i></span>
                                        <span class="icon_preview icon-fa-simplybuilt" title="simplybuilt - Brands"><i class="fa-simplybuilt fab" data-name="simplybuilt"></i></span>
                                        <span class="icon_preview icon-fa-sistrix" title="sistrix - Brands"><i class="fa-sistrix fab" data-name="sistrix"></i></span>
                                        <span class="icon_preview icon-fa-sitemap" title="sitemap - Solid"><i class="fa-sitemap fas" data-name="sitemap"></i></span>
                                        <span class="icon_preview icon-fa-sith" title="sith - Brands"><i class="fa-sith fab" data-name="sith"></i></span>
                                        <span class="icon_preview icon-fa-skating" title="skating - Solid"><i class="fa-skating fas" data-name="skating"></i></span>
                                        <span class="icon_preview icon-fa-sketch" title="sketch - Brands"><i class="fa-sketch fab" data-name="sketch"></i></span>
                                        <span class="icon_preview icon-fa-skiing" title="skiing - Solid"><i class="fa-skiing fas" data-name="skiing"></i></span>
                                        <span class="icon_preview icon-fa-skiing-nordic" title="skiing-nordic - Solid"><i class="fa-skiing-nordic fas" data-name="skiing-nordic"></i></span>
                                        <span class="icon_preview icon-fa-skull" title="skull - Solid"><i class="fa-skull fas" data-name="skull"></i></span>
                                        <span class="icon_preview icon-fa-skull-crossbones" title="skull-crossbones - Solid"><i class="fa-skull-crossbones fas" data-name="skull-crossbones"></i></span>
                                        <span class="icon_preview icon-fa-skyatlas" title="skyatlas - Brands"><i class="fa-skyatlas fab" data-name="skyatlas"></i></span>
                                        <span class="icon_preview icon-fa-skype" title="skype - Brands"><i class="fa-skype fab" data-name="skype"></i></span>
                                        <span class="icon_preview icon-fa-slack" title="slack - Brands"><i class="fa-slack fab" data-name="slack"></i></span>
                                        <span class="icon_preview icon-fa-slack-hash" title="slack-hash - Brands"><i class="fa-slack-hash fab" data-name="slack-hash"></i></span>
                                        <span class="icon_preview icon-fa-slash" title="slash - Solid"><i class="fa-slash fas" data-name="slash"></i></span>
                                        <span class="icon_preview icon-fa-sleigh" title="sleigh - Solid"><i class="fa-sleigh fas" data-name="sleigh"></i></span>
                                        <span class="icon_preview icon-fa-sliders-h" title="sliders-h - Solid"><i class="fa-sliders-h fas" data-name="sliders-h"></i></span>
                                        <span class="icon_preview icon-fa-slideshare" title="slideshare - Brands"><i class="fa-slideshare fab" data-name="slideshare"></i></span>
                                        <span class="icon_preview icon-fa-smile" title="smile - Solid"><i class="fa-smile fas" data-name="smile"></i></span>
                                        <span class="icon_preview icon-fa-smile" title="smile - Regular"><i class="fa-smile far" data-name="smile"></i></span>
                                        <span class="icon_preview icon-fa-smile-beam" title="smile-beam - Solid"><i class="fa-smile-beam fas" data-name="smile-beam"></i></span>
                                        <span class="icon_preview icon-fa-smile-beam" title="smile-beam - Regular"><i class="fa-smile-beam far" data-name="smile-beam"></i></span>
                                        <span class="icon_preview icon-fa-smile-wink" title="smile-wink - Solid"><i class="fa-smile-wink fas" data-name="smile-wink"></i></span>
                                        <span class="icon_preview icon-fa-smile-wink" title="smile-wink - Regular"><i class="fa-smile-wink far" data-name="smile-wink"></i></span>
                                        <span class="icon_preview icon-fa-smog" title="smog - Solid"><i class="fa-smog fas" data-name="smog"></i></span>
                                        <span class="icon_preview icon-fa-smoking" title="smoking - Solid"><i class="fa-smoking fas" data-name="smoking"></i></span>
                                        <span class="icon_preview icon-fa-smoking-ban" title="smoking-ban - Solid"><i class="fa-smoking-ban fas" data-name="smoking-ban"></i></span>
                                        <span class="icon_preview icon-fa-sms" title="sms - Solid"><i class="fa-sms fas" data-name="sms"></i></span>
                                        <span class="icon_preview icon-fa-snapchat" title="snapchat - Brands"><i class="fa-snapchat fab" data-name="snapchat"></i></span>
                                        <span class="icon_preview icon-fa-snapchat-ghost" title="snapchat-ghost - Brands"><i class="fa-snapchat-ghost fab" data-name="snapchat-ghost"></i></span>
                                        <span class="icon_preview icon-fa-snapchat-square" title="snapchat-square - Brands"><i class="fa-snapchat-square fab" data-name="snapchat-square"></i></span>
                                        <span class="icon_preview icon-fa-snowboarding" title="snowboarding - Solid"><i class="fa-snowboarding fas" data-name="snowboarding"></i></span>
                                        <span class="icon_preview icon-fa-snowflake" title="snowflake - Solid"><i class="fa-snowflake fas" data-name="snowflake"></i></span>
                                        <span class="icon_preview icon-fa-snowflake" title="snowflake - Regular"><i class="fa-snowflake far" data-name="snowflake"></i></span>
                                        <span class="icon_preview icon-fa-snowman" title="snowman - Solid"><i class="fa-snowman fas" data-name="snowman"></i></span>
                                        <span class="icon_preview icon-fa-snowplow" title="snowplow - Solid"><i class="fa-snowplow fas" data-name="snowplow"></i></span>
                                        <span class="icon_preview icon-fa-socks" title="socks - Solid"><i class="fa-socks fas" data-name="socks"></i></span>
                                        <span class="icon_preview icon-fa-solar-panel" title="solar-panel - Solid"><i class="fa-solar-panel fas" data-name="solar-panel"></i></span>
                                        <span class="icon_preview icon-fa-sort" title="sort - Solid"><i class="fa-sort fas" data-name="sort"></i></span>
                                        <span class="icon_preview icon-fa-sort-alpha-down" title="sort-alpha-down - Solid"><i class="fa-sort-alpha-down fas" data-name="sort-alpha-down"></i></span>
                                        <span class="icon_preview icon-fa-sort-alpha-up" title="sort-alpha-up - Solid"><i class="fa-sort-alpha-up fas" data-name="sort-alpha-up"></i></span>
                                        <span class="icon_preview icon-fa-sort-amount-down" title="sort-amount-down - Solid"><i class="fa-sort-amount-down fas" data-name="sort-amount-down"></i></span>
                                        <span class="icon_preview icon-fa-sort-amount-up" title="sort-amount-up - Solid"><i class="fa-sort-amount-up fas" data-name="sort-amount-up"></i></span>
                                        <span class="icon_preview icon-fa-sort-down" title="sort-down - Solid"><i class="fa-sort-down fas" data-name="sort-down"></i></span>
                                        <span class="icon_preview icon-fa-sort-numeric-down" title="sort-numeric-down - Solid"><i class="fa-sort-numeric-down fas" data-name="sort-numeric-down"></i></span>
                                        <span class="icon_preview icon-fa-sort-numeric-up" title="sort-numeric-up - Solid"><i class="fa-sort-numeric-up fas" data-name="sort-numeric-up"></i></span>
                                        <span class="icon_preview icon-fa-sort-up" title="sort-up - Solid"><i class="fa-sort-up fas" data-name="sort-up"></i></span>
                                        <span class="icon_preview icon-fa-soundcloud" title="soundcloud - Brands"><i class="fa-soundcloud fab" data-name="soundcloud"></i></span>
                                        <span class="icon_preview icon-fa-sourcetree" title="sourcetree - Brands"><i class="fa-sourcetree fab" data-name="sourcetree"></i></span>
                                        <span class="icon_preview icon-fa-spa" title="spa - Solid"><i class="fa-spa fas" data-name="spa"></i></span>
                                        <span class="icon_preview icon-fa-space-shuttle" title="space-shuttle - Solid"><i class="fa-space-shuttle fas" data-name="space-shuttle"></i></span>
                                        <span class="icon_preview icon-fa-speakap" title="speakap - Brands"><i class="fa-speakap fab" data-name="speakap"></i></span>
                                        <span class="icon_preview icon-fa-spider" title="spider - Solid"><i class="fa-spider fas" data-name="spider"></i></span>
                                        <span class="icon_preview icon-fa-spinner" title="spinner - Solid"><i class="fa-spinner fas" data-name="spinner"></i></span>
                                        <span class="icon_preview icon-fa-splotch" title="splotch - Solid"><i class="fa-splotch fas" data-name="splotch"></i></span>
                                        <span class="icon_preview icon-fa-spotify" title="spotify - Brands"><i class="fa-spotify fab" data-name="spotify"></i></span>
                                        <span class="icon_preview icon-fa-spray-can" title="spray-can - Solid"><i class="fa-spray-can fas" data-name="spray-can"></i></span>
                                        <span class="icon_preview icon-fa-square" title="square - Solid"><i class="fa-square fas" data-name="square"></i></span>
                                        <span class="icon_preview icon-fa-square" title="square - Regular"><i class="fa-square far" data-name="square"></i></span>
                                        <span class="icon_preview icon-fa-square-full" title="square-full - Solid"><i class="fa-square-full fas" data-name="square-full"></i></span>
                                        <span class="icon_preview icon-fa-square-root-alt" title="square-root-alt - Solid"><i class="fa-square-root-alt fas" data-name="square-root-alt"></i></span>
                                        <span class="icon_preview icon-fa-squarespace" title="squarespace - Brands"><i class="fa-squarespace fab" data-name="squarespace"></i></span>
                                        <span class="icon_preview icon-fa-stack-exchange" title="stack-exchange - Brands"><i class="fa-stack-exchange fab" data-name="stack-exchange"></i></span>
                                        <span class="icon_preview icon-fa-stack-overflow" title="stack-overflow - Brands"><i class="fa-stack-overflow fab" data-name="stack-overflow"></i></span>
                                        <span class="icon_preview icon-fa-stamp" title="stamp - Solid"><i class="fa-stamp fas" data-name="stamp"></i></span>
                                        <span class="icon_preview icon-fa-star" title="star - Solid"><i class="fa-star fas" data-name="star"></i></span>
                                        <span class="icon_preview icon-fa-star" title="star - Regular"><i class="fa-star far" data-name="star"></i></span>
                                        <span class="icon_preview icon-fa-star-and-crescent" title="star-and-crescent - Solid"><i class="fa-star-and-crescent fas" data-name="star-and-crescent"></i></span>
                                        <span class="icon_preview icon-fa-star-half" title="star-half - Solid"><i class="fa-star-half fas" data-name="star-half"></i></span>
                                        <span class="icon_preview icon-fa-star-half" title="star-half - Regular"><i class="fa-star-half far" data-name="star-half"></i></span>
                                        <span class="icon_preview icon-fa-star-half-alt" title="star-half-alt - Solid"><i class="fa-star-half-alt fas" data-name="star-half-alt"></i></span>
                                        <span class="icon_preview icon-fa-star-of-david" title="star-of-david - Solid"><i class="fa-star-of-david fas" data-name="star-of-david"></i></span>
                                        <span class="icon_preview icon-fa-star-of-life" title="star-of-life - Solid"><i class="fa-star-of-life fas" data-name="star-of-life"></i></span>
                                        <span class="icon_preview icon-fa-staylinked" title="staylinked - Brands"><i class="fa-staylinked fab" data-name="staylinked"></i></span>
                                        <span class="icon_preview icon-fa-steam" title="steam - Brands"><i class="fa-steam fab" data-name="steam"></i></span>
                                        <span class="icon_preview icon-fa-steam-square" title="steam-square - Brands"><i class="fa-steam-square fab" data-name="steam-square"></i></span>
                                        <span class="icon_preview icon-fa-steam-symbol" title="steam-symbol - Brands"><i class="fa-steam-symbol fab" data-name="steam-symbol"></i></span>
                                        <span class="icon_preview icon-fa-step-backward" title="step-backward - Solid"><i class="fa-step-backward fas" data-name="step-backward"></i></span>
                                        <span class="icon_preview icon-fa-step-forward" title="step-forward - Solid"><i class="fa-step-forward fas" data-name="step-forward"></i></span>
                                        <span class="icon_preview icon-fa-stethoscope" title="stethoscope - Solid"><i class="fa-stethoscope fas" data-name="stethoscope"></i></span>
                                        <span class="icon_preview icon-fa-sticker-mule" title="sticker-mule - Brands"><i class="fa-sticker-mule fab" data-name="sticker-mule"></i></span>
                                        <span class="icon_preview icon-fa-sticky-note" title="sticky-note - Solid"><i class="fa-sticky-note fas" data-name="sticky-note"></i></span>
                                        <span class="icon_preview icon-fa-sticky-note" title="sticky-note - Regular"><i class="fa-sticky-note far" data-name="sticky-note"></i></span>
                                        <span class="icon_preview icon-fa-stop" title="stop - Solid"><i class="fa-stop fas" data-name="stop"></i></span>
                                        <span class="icon_preview icon-fa-stop-circle" title="stop-circle - Solid"><i class="fa-stop-circle fas" data-name="stop-circle"></i></span>
                                        <span class="icon_preview icon-fa-stop-circle" title="stop-circle - Regular"><i class="fa-stop-circle far" data-name="stop-circle"></i></span>
                                        <span class="icon_preview icon-fa-stopwatch" title="stopwatch - Solid"><i class="fa-stopwatch fas" data-name="stopwatch"></i></span>
                                        <span class="icon_preview icon-fa-store" title="store - Solid"><i class="fa-store fas" data-name="store"></i></span>
                                        <span class="icon_preview icon-fa-store-alt" title="store-alt - Solid"><i class="fa-store-alt fas" data-name="store-alt"></i></span>
                                        <span class="icon_preview icon-fa-strava" title="strava - Brands"><i class="fa-strava fab" data-name="strava"></i></span>
                                        <span class="icon_preview icon-fa-stream" title="stream - Solid"><i class="fa-stream fas" data-name="stream"></i></span>
                                        <span class="icon_preview icon-fa-street-view" title="street-view - Solid"><i class="fa-street-view fas" data-name="street-view"></i></span>
                                        <span class="icon_preview icon-fa-strikethrough" title="strikethrough - Solid"><i class="fa-strikethrough fas" data-name="strikethrough"></i></span>
                                        <span class="icon_preview icon-fa-stripe" title="stripe - Brands"><i class="fa-stripe fab" data-name="stripe"></i></span>
                                        <span class="icon_preview icon-fa-stripe-s" title="stripe-s - Brands"><i class="fa-stripe-s fab" data-name="stripe-s"></i></span>
                                        <span class="icon_preview icon-fa-stroopwafel" title="stroopwafel - Solid"><i class="fa-stroopwafel fas" data-name="stroopwafel"></i></span>
                                        <span class="icon_preview icon-fa-studiovinari" title="studiovinari - Brands"><i class="fa-studiovinari fab" data-name="studiovinari"></i></span>
                                        <span class="icon_preview icon-fa-stumbleupon" title="stumbleupon - Brands"><i class="fa-stumbleupon fab" data-name="stumbleupon"></i></span>
                                        <span class="icon_preview icon-fa-stumbleupon-circle" title="stumbleupon-circle - Brands"><i class="fa-stumbleupon-circle fab" data-name="stumbleupon-circle"></i></span>
                                        <span class="icon_preview icon-fa-subscript" title="subscript - Solid"><i class="fa-subscript fas" data-name="subscript"></i></span>
                                        <span class="icon_preview icon-fa-subway" title="subway - Solid"><i class="fa-subway fas" data-name="subway"></i></span>
                                        <span class="icon_preview icon-fa-suitcase" title="suitcase - Solid"><i class="fa-suitcase fas" data-name="suitcase"></i></span>
                                        <span class="icon_preview icon-fa-suitcase-rolling" title="suitcase-rolling - Solid"><i class="fa-suitcase-rolling fas" data-name="suitcase-rolling"></i></span>
                                        <span class="icon_preview icon-fa-sun" title="sun - Solid"><i class="fa-sun fas" data-name="sun"></i></span>
                                        <span class="icon_preview icon-fa-sun" title="sun - Regular"><i class="fa-sun far" data-name="sun"></i></span>
                                        <span class="icon_preview icon-fa-superpowers" title="superpowers - Brands"><i class="fa-superpowers fab" data-name="superpowers"></i></span>
                                        <span class="icon_preview icon-fa-superscript" title="superscript - Solid"><i class="fa-superscript fas" data-name="superscript"></i></span>
                                        <span class="icon_preview icon-fa-supple" title="supple - Brands"><i class="fa-supple fab" data-name="supple"></i></span>
                                        <span class="icon_preview icon-fa-surprise" title="surprise - Solid"><i class="fa-surprise fas" data-name="surprise"></i></span>
                                        <span class="icon_preview icon-fa-surprise" title="surprise - Regular"><i class="fa-surprise far" data-name="surprise"></i></span>
                                        <span class="icon_preview icon-fa-suse" title="suse - Brands"><i class="fa-suse fab" data-name="suse"></i></span>
                                        <span class="icon_preview icon-fa-swatchbook" title="swatchbook - Solid"><i class="fa-swatchbook fas" data-name="swatchbook"></i></span>
                                        <span class="icon_preview icon-fa-swimmer" title="swimmer - Solid"><i class="fa-swimmer fas" data-name="swimmer"></i></span>
                                        <span class="icon_preview icon-fa-swimming-pool" title="swimming-pool - Solid"><i class="fa-swimming-pool fas" data-name="swimming-pool"></i></span>
                                        <span class="icon_preview icon-fa-synagogue" title="synagogue - Solid"><i class="fa-synagogue fas" data-name="synagogue"></i></span>
                                        <span class="icon_preview icon-fa-sync" title="sync - Solid"><i class="fa-sync fas" data-name="sync"></i></span>
                                        <span class="icon_preview icon-fa-sync-alt" title="sync-alt - Solid"><i class="fa-sync-alt fas" data-name="sync-alt"></i></span>
                                        <span class="icon_preview icon-fa-syringe" title="syringe - Solid"><i class="fa-syringe fas" data-name="syringe"></i></span>
                                        <span class="icon_preview icon-fa-table" title="table - Solid"><i class="fa-table fas" data-name="table"></i></span>
                                        <span class="icon_preview icon-fa-table-tennis" title="table-tennis - Solid"><i class="fa-table-tennis fas" data-name="table-tennis"></i></span>
                                        <span class="icon_preview icon-fa-tablet" title="tablet - Solid"><i class="fa-tablet fas" data-name="tablet"></i></span>
                                        <span class="icon_preview icon-fa-tablet-alt" title="tablet-alt - Solid"><i class="fa-tablet-alt fas" data-name="tablet-alt"></i></span>
                                        <span class="icon_preview icon-fa-tablets" title="tablets - Solid"><i class="fa-tablets fas" data-name="tablets"></i></span>
                                        <span class="icon_preview icon-fa-tachometer-alt" title="tachometer-alt - Solid"><i class="fa-tachometer-alt fas" data-name="tachometer-alt"></i></span>
                                        <span class="icon_preview icon-fa-tag" title="tag - Solid"><i class="fa-tag fas" data-name="tag"></i></span>
                                        <span class="icon_preview icon-fa-tags" title="tags - Solid"><i class="fa-tags fas" data-name="tags"></i></span>
                                        <span class="icon_preview icon-fa-tape" title="tape - Solid"><i class="fa-tape fas" data-name="tape"></i></span>
                                        <span class="icon_preview icon-fa-tasks" title="tasks - Solid"><i class="fa-tasks fas" data-name="tasks"></i></span>
                                        <span class="icon_preview icon-fa-taxi" title="taxi - Solid"><i class="fa-taxi fas" data-name="taxi"></i></span>
                                        <span class="icon_preview icon-fa-teamspeak" title="teamspeak - Brands"><i class="fa-teamspeak fab" data-name="teamspeak"></i></span>
                                        <span class="icon_preview icon-fa-teeth" title="teeth - Solid"><i class="fa-teeth fas" data-name="teeth"></i></span>
                                        <span class="icon_preview icon-fa-teeth-open" title="teeth-open - Solid"><i class="fa-teeth-open fas" data-name="teeth-open"></i></span>
                                        <span class="icon_preview icon-fa-telegram" title="telegram - Brands"><i class="fa-telegram fab" data-name="telegram"></i></span>
                                        <span class="icon_preview icon-fa-telegram-plane" title="telegram-plane - Brands"><i class="fa-telegram-plane fab" data-name="telegram-plane"></i></span>
                                        <span class="icon_preview icon-fa-temperature-high" title="temperature-high - Solid"><i class="fa-temperature-high fas" data-name="temperature-high"></i></span>
                                        <span class="icon_preview icon-fa-temperature-low" title="temperature-low - Solid"><i class="fa-temperature-low fas" data-name="temperature-low"></i></span>
                                        <span class="icon_preview icon-fa-tencent-weibo" title="tencent-weibo - Brands"><i class="fa-tencent-weibo fab" data-name="tencent-weibo"></i></span>
                                        <span class="icon_preview icon-fa-tenge" title="tenge - Solid"><i class="fa-tenge fas" data-name="tenge"></i></span>
                                        <span class="icon_preview icon-fa-terminal" title="terminal - Solid"><i class="fa-terminal fas" data-name="terminal"></i></span>
                                        <span class="icon_preview icon-fa-text-height" title="text-height - Solid"><i class="fa-text-height fas" data-name="text-height"></i></span>
                                        <span class="icon_preview icon-fa-text-width" title="text-width - Solid"><i class="fa-text-width fas" data-name="text-width"></i></span>
                                        <span class="icon_preview icon-fa-th" title="th - Solid"><i class="fa-th fas" data-name="th"></i></span>
                                        <span class="icon_preview icon-fa-th-large" title="th-large - Solid"><i class="fa-th-large fas" data-name="th-large"></i></span>
                                        <span class="icon_preview icon-fa-th-list" title="th-list - Solid"><i class="fa-th-list fas" data-name="th-list"></i></span>
                                        <span class="icon_preview icon-fa-the-red-yeti" title="the-red-yeti - Brands"><i class="fa-the-red-yeti fab" data-name="the-red-yeti"></i></span>
                                        <span class="icon_preview icon-fa-theater-masks" title="theater-masks - Solid"><i class="fa-theater-masks fas" data-name="theater-masks"></i></span>
                                        <span class="icon_preview icon-fa-themeco" title="themeco - Brands"><i class="fa-themeco fab" data-name="themeco"></i></span>
                                        <span class="icon_preview icon-fa-themeisle" title="themeisle - Brands"><i class="fa-themeisle fab" data-name="themeisle"></i></span>
                                        <span class="icon_preview icon-fa-thermometer" title="thermometer - Solid"><i class="fa-thermometer fas" data-name="thermometer"></i></span>
                                        <span class="icon_preview icon-fa-thermometer-empty" title="thermometer-empty - Solid"><i class="fa-thermometer-empty fas" data-name="thermometer-empty"></i></span>
                                        <span class="icon_preview icon-fa-thermometer-full" title="thermometer-full - Solid"><i class="fa-thermometer-full fas" data-name="thermometer-full"></i></span>
                                        <span class="icon_preview icon-fa-thermometer-half" title="thermometer-half - Solid"><i class="fa-thermometer-half fas" data-name="thermometer-half"></i></span>
                                        <span class="icon_preview icon-fa-thermometer-quarter" title="thermometer-quarter - Solid"><i class="fa-thermometer-quarter fas" data-name="thermometer-quarter"></i></span>
                                        <span class="icon_preview icon-fa-thermometer-three-quarters" title="thermometer-three-quarters - Solid"><i class="fa-thermometer-three-quarters fas" data-name="thermometer-three-quarters"></i></span>
                                        <span class="icon_preview icon-fa-think-peaks" title="think-peaks - Brands"><i class="fa-think-peaks fab" data-name="think-peaks"></i></span>
                                        <span class="icon_preview icon-fa-thumbs-down" title="thumbs-down - Solid"><i class="fa-thumbs-down fas" data-name="thumbs-down"></i></span>
                                        <span class="icon_preview icon-fa-thumbs-down" title="thumbs-down - Regular"><i class="fa-thumbs-down far" data-name="thumbs-down"></i></span>
                                        <span class="icon_preview icon-fa-thumbs-up" title="thumbs-up - Solid"><i class="fa-thumbs-up fas" data-name="thumbs-up"></i></span>
                                        <span class="icon_preview icon-fa-thumbs-up" title="thumbs-up - Regular"><i class="fa-thumbs-up far" data-name="thumbs-up"></i></span>
                                        <span class="icon_preview icon-fa-thumbtack" title="thumbtack - Solid"><i class="fa-thumbtack fas" data-name="thumbtack"></i></span>
                                        <span class="icon_preview icon-fa-ticket-alt" title="ticket-alt - Solid"><i class="fa-ticket-alt fas" data-name="ticket-alt"></i></span>
                                        <span class="icon_preview icon-fa-times" title="times - Solid"><i class="fa-times fas" data-name="times"></i></span>
                                        <span class="icon_preview icon-fa-times-circle" title="times-circle - Solid"><i class="fa-times-circle fas" data-name="times-circle"></i></span>
                                        <span class="icon_preview icon-fa-times-circle" title="times-circle - Regular"><i class="fa-times-circle far" data-name="times-circle"></i></span>
                                        <span class="icon_preview icon-fa-tint" title="tint - Solid"><i class="fa-tint fas" data-name="tint"></i></span>
                                        <span class="icon_preview icon-fa-tint-slash" title="tint-slash - Solid"><i class="fa-tint-slash fas" data-name="tint-slash"></i></span>
                                        <span class="icon_preview icon-fa-tired" title="tired - Solid"><i class="fa-tired fas" data-name="tired"></i></span>
                                        <span class="icon_preview icon-fa-tired" title="tired - Regular"><i class="fa-tired far" data-name="tired"></i></span>
                                        <span class="icon_preview icon-fa-toggle-off" title="toggle-off - Solid"><i class="fa-toggle-off fas" data-name="toggle-off"></i></span>
                                        <span class="icon_preview icon-fa-toggle-on" title="toggle-on - Solid"><i class="fa-toggle-on fas" data-name="toggle-on"></i></span>
                                        <span class="icon_preview icon-fa-toilet" title="toilet - Solid"><i class="fa-toilet fas" data-name="toilet"></i></span>
                                        <span class="icon_preview icon-fa-toilet-paper" title="toilet-paper - Solid"><i class="fa-toilet-paper fas" data-name="toilet-paper"></i></span>
                                        <span class="icon_preview icon-fa-toolbox" title="toolbox - Solid"><i class="fa-toolbox fas" data-name="toolbox"></i></span>
                                        <span class="icon_preview icon-fa-tools" title="tools - Solid"><i class="fa-tools fas" data-name="tools"></i></span>
                                        <span class="icon_preview icon-fa-tooth" title="tooth - Solid"><i class="fa-tooth fas" data-name="tooth"></i></span>
                                        <span class="icon_preview icon-fa-torah" title="torah - Solid"><i class="fa-torah fas" data-name="torah"></i></span>
                                        <span class="icon_preview icon-fa-torii-gate" title="torii-gate - Solid"><i class="fa-torii-gate fas" data-name="torii-gate"></i></span>
                                        <span class="icon_preview icon-fa-tractor" title="tractor - Solid"><i class="fa-tractor fas" data-name="tractor"></i></span>
                                        <span class="icon_preview icon-fa-trade-federation" title="trade-federation - Brands"><i class="fa-trade-federation fab" data-name="trade-federation"></i></span>
                                        <span class="icon_preview icon-fa-trademark" title="trademark - Solid"><i class="fa-trademark fas" data-name="trademark"></i></span>
                                        <span class="icon_preview icon-fa-traffic-light" title="traffic-light - Solid"><i class="fa-traffic-light fas" data-name="traffic-light"></i></span>
                                        <span class="icon_preview icon-fa-train" title="train - Solid"><i class="fa-train fas" data-name="train"></i></span>
                                        <span class="icon_preview icon-fa-tram" title="tram - Solid"><i class="fa-tram fas" data-name="tram"></i></span>
                                        <span class="icon_preview icon-fa-transgender" title="transgender - Solid"><i class="fa-transgender fas" data-name="transgender"></i></span>
                                        <span class="icon_preview icon-fa-transgender-alt" title="transgender-alt - Solid"><i class="fa-transgender-alt fas" data-name="transgender-alt"></i></span>
                                        <span class="icon_preview icon-fa-trash" title="trash - Solid"><i class="fa-trash fas" data-name="trash"></i></span>
                                        <span class="icon_preview icon-fa-trash-alt" title="trash-alt - Solid"><i class="fa-trash-alt fas" data-name="trash-alt"></i></span>
                                        <span class="icon_preview icon-fa-trash-alt" title="trash-alt - Regular"><i class="fa-trash-alt far" data-name="trash-alt"></i></span>
                                        <span class="icon_preview icon-fa-trash-restore" title="trash-restore - Solid"><i class="fa-trash-restore fas" data-name="trash-restore"></i></span>
                                        <span class="icon_preview icon-fa-trash-restore-alt" title="trash-restore-alt - Solid"><i class="fa-trash-restore-alt fas" data-name="trash-restore-alt"></i></span>
                                        <span class="icon_preview icon-fa-tree" title="tree - Solid"><i class="fa-tree fas" data-name="tree"></i></span>
                                        <span class="icon_preview icon-fa-trello" title="trello - Brands"><i class="fa-trello fab" data-name="trello"></i></span>
                                        <span class="icon_preview icon-fa-tripadvisor" title="tripadvisor - Brands"><i class="fa-tripadvisor fab" data-name="tripadvisor"></i></span>
                                        <span class="icon_preview icon-fa-trophy" title="trophy - Solid"><i class="fa-trophy fas" data-name="trophy"></i></span>
                                        <span class="icon_preview icon-fa-truck" title="truck - Solid"><i class="fa-truck fas" data-name="truck"></i></span>
                                        <span class="icon_preview icon-fa-truck-loading" title="truck-loading - Solid"><i class="fa-truck-loading fas" data-name="truck-loading"></i></span>
                                        <span class="icon_preview icon-fa-truck-monster" title="truck-monster - Solid"><i class="fa-truck-monster fas" data-name="truck-monster"></i></span>
                                        <span class="icon_preview icon-fa-truck-moving" title="truck-moving - Solid"><i class="fa-truck-moving fas" data-name="truck-moving"></i></span>
                                        <span class="icon_preview icon-fa-truck-pickup" title="truck-pickup - Solid"><i class="fa-truck-pickup fas" data-name="truck-pickup"></i></span>
                                        <span class="icon_preview icon-fa-tshirt" title="tshirt - Solid"><i class="fa-tshirt fas" data-name="tshirt"></i></span>
                                        <span class="icon_preview icon-fa-tty" title="tty - Solid"><i class="fa-tty fas" data-name="tty"></i></span>
                                        <span class="icon_preview icon-fa-tumblr" title="tumblr - Brands"><i class="fa-tumblr fab" data-name="tumblr"></i></span>
                                        <span class="icon_preview icon-fa-tumblr-square" title="tumblr-square - Brands"><i class="fa-tumblr-square fab" data-name="tumblr-square"></i></span>
                                        <span class="icon_preview icon-fa-tv" title="tv - Solid"><i class="fa-tv fas" data-name="tv"></i></span>
                                        <span class="icon_preview icon-fa-twitch" title="twitch - Brands"><i class="fa-twitch fab" data-name="twitch"></i></span>
                                        <span class="icon_preview icon-fa-twitter" title="twitter - Brands"><i class="fa-twitter fab" data-name="twitter"></i></span>
                                        <span class="icon_preview icon-fa-twitter-square" title="twitter-square - Brands"><i class="fa-twitter-square fab" data-name="twitter-square"></i></span>
                                        <span class="icon_preview icon-fa-typo3" title="typo3 - Brands"><i class="fa-typo3 fab" data-name="typo3"></i></span>
                                        <span class="icon_preview icon-fa-uber" title="uber - Brands"><i class="fa-uber fab" data-name="uber"></i></span>
                                        <span class="icon_preview icon-fa-ubuntu" title="ubuntu - Brands"><i class="fa-ubuntu fab" data-name="ubuntu"></i></span>
                                        <span class="icon_preview icon-fa-uikit" title="uikit - Brands"><i class="fa-uikit fab" data-name="uikit"></i></span>
                                        <span class="icon_preview icon-fa-umbrella" title="umbrella - Solid"><i class="fa-umbrella fas" data-name="umbrella"></i></span>
                                        <span class="icon_preview icon-fa-umbrella-beach" title="umbrella-beach - Solid"><i class="fa-umbrella-beach fas" data-name="umbrella-beach"></i></span>
                                        <span class="icon_preview icon-fa-underline" title="underline - Solid"><i class="fa-underline fas" data-name="underline"></i></span>
                                        <span class="icon_preview icon-fa-undo" title="undo - Solid"><i class="fa-undo fas" data-name="undo"></i></span>
                                        <span class="icon_preview icon-fa-undo-alt" title="undo-alt - Solid"><i class="fa-undo-alt fas" data-name="undo-alt"></i></span>
                                        <span class="icon_preview icon-fa-uniregistry" title="uniregistry - Brands"><i class="fa-uniregistry fab" data-name="uniregistry"></i></span>
                                        <span class="icon_preview icon-fa-universal-access" title="universal-access - Solid"><i class="fa-universal-access fas" data-name="universal-access"></i></span>
                                        <span class="icon_preview icon-fa-university" title="university - Solid"><i class="fa-university fas" data-name="university"></i></span>
                                        <span class="icon_preview icon-fa-unlink" title="unlink - Solid"><i class="fa-unlink fas" data-name="unlink"></i></span>
                                        <span class="icon_preview icon-fa-unlock" title="unlock - Solid"><i class="fa-unlock fas" data-name="unlock"></i></span>
                                        <span class="icon_preview icon-fa-unlock-alt" title="unlock-alt - Solid"><i class="fa-unlock-alt fas" data-name="unlock-alt"></i></span>
                                        <span class="icon_preview icon-fa-untappd" title="untappd - Brands"><i class="fa-untappd fab" data-name="untappd"></i></span>
                                        <span class="icon_preview icon-fa-upload" title="upload - Solid"><i class="fa-upload fas" data-name="upload"></i></span>
                                        <span class="icon_preview icon-fa-ups" title="ups - Brands"><i class="fa-ups fab" data-name="ups"></i></span>
                                        <span class="icon_preview icon-fa-usb" title="usb - Brands"><i class="fa-usb fab" data-name="usb"></i></span>
                                        <span class="icon_preview icon-fa-user" title="user - Solid"><i class="fa-user fas" data-name="user"></i></span>
                                        <span class="icon_preview icon-fa-user" title="user - Regular"><i class="fa-user far" data-name="user"></i></span>
                                        <span class="icon_preview icon-fa-user-alt" title="user-alt - Solid"><i class="fa-user-alt fas" data-name="user-alt"></i></span>
                                        <span class="icon_preview icon-fa-user-alt-slash" title="user-alt-slash - Solid"><i class="fa-user-alt-slash fas" data-name="user-alt-slash"></i></span>
                                        <span class="icon_preview icon-fa-user-astronaut" title="user-astronaut - Solid"><i class="fa-user-astronaut fas" data-name="user-astronaut"></i></span>
                                        <span class="icon_preview icon-fa-user-check" title="user-check - Solid"><i class="fa-user-check fas" data-name="user-check"></i></span>
                                        <span class="icon_preview icon-fa-user-circle" title="user-circle - Solid"><i class="fa-user-circle fas" data-name="user-circle"></i></span>
                                        <span class="icon_preview icon-fa-user-circle" title="user-circle - Regular"><i class="fa-user-circle far" data-name="user-circle"></i></span>
                                        <span class="icon_preview icon-fa-user-clock" title="user-clock - Solid"><i class="fa-user-clock fas" data-name="user-clock"></i></span>
                                        <span class="icon_preview icon-fa-user-cog" title="user-cog - Solid"><i class="fa-user-cog fas" data-name="user-cog"></i></span>
                                        <span class="icon_preview icon-fa-user-edit" title="user-edit - Solid"><i class="fa-user-edit fas" data-name="user-edit"></i></span>
                                        <span class="icon_preview icon-fa-user-friends" title="user-friends - Solid"><i class="fa-user-friends fas" data-name="user-friends"></i></span>
                                        <span class="icon_preview icon-fa-user-graduate" title="user-graduate - Solid"><i class="fa-user-graduate fas" data-name="user-graduate"></i></span>
                                        <span class="icon_preview icon-fa-user-injured" title="user-injured - Solid"><i class="fa-user-injured fas" data-name="user-injured"></i></span>
                                        <span class="icon_preview icon-fa-user-lock" title="user-lock - Solid"><i class="fa-user-lock fas" data-name="user-lock"></i></span>
                                        <span class="icon_preview icon-fa-user-md" title="user-md - Solid"><i class="fa-user-md fas" data-name="user-md"></i></span>
                                        <span class="icon_preview icon-fa-user-minus" title="user-minus - Solid"><i class="fa-user-minus fas" data-name="user-minus"></i></span>
                                        <span class="icon_preview icon-fa-user-ninja" title="user-ninja - Solid"><i class="fa-user-ninja fas" data-name="user-ninja"></i></span>
                                        <span class="icon_preview icon-fa-user-nurse" title="user-nurse - Solid"><i class="fa-user-nurse fas" data-name="user-nurse"></i></span>
                                        <span class="icon_preview icon-fa-user-plus" title="user-plus - Solid"><i class="fa-user-plus fas" data-name="user-plus"></i></span>
                                        <span class="icon_preview icon-fa-user-secret" title="user-secret - Solid"><i class="fa-user-secret fas" data-name="user-secret"></i></span>
                                        <span class="icon_preview icon-fa-user-shield" title="user-shield - Solid"><i class="fa-user-shield fas" data-name="user-shield"></i></span>
                                        <span class="icon_preview icon-fa-user-slash" title="user-slash - Solid"><i class="fa-user-slash fas" data-name="user-slash"></i></span>
                                        <span class="icon_preview icon-fa-user-tag" title="user-tag - Solid"><i class="fa-user-tag fas" data-name="user-tag"></i></span>
                                        <span class="icon_preview icon-fa-user-tie" title="user-tie - Solid"><i class="fa-user-tie fas" data-name="user-tie"></i></span>
                                        <span class="icon_preview icon-fa-user-times" title="user-times - Solid"><i class="fa-user-times fas" data-name="user-times"></i></span>
                                        <span class="icon_preview icon-fa-users" title="users - Solid"><i class="fa-users fas" data-name="users"></i></span>
                                        <span class="icon_preview icon-fa-users-cog" title="users-cog - Solid"><i class="fa-users-cog fas" data-name="users-cog"></i></span>
                                        <span class="icon_preview icon-fa-usps" title="usps - Brands"><i class="fa-usps fab" data-name="usps"></i></span>
                                        <span class="icon_preview icon-fa-ussunnah" title="ussunnah - Brands"><i class="fa-ussunnah fab" data-name="ussunnah"></i></span>
                                        <span class="icon_preview icon-fa-utensil-spoon" title="utensil-spoon - Solid"><i class="fa-utensil-spoon fas" data-name="utensil-spoon"></i></span>
                                        <span class="icon_preview icon-fa-utensils" title="utensils - Solid"><i class="fa-utensils fas" data-name="utensils"></i></span>
                                        <span class="icon_preview icon-fa-vaadin" title="vaadin - Brands"><i class="fa-vaadin fab" data-name="vaadin"></i></span>
                                        <span class="icon_preview icon-fa-vector-square" title="vector-square - Solid"><i class="fa-vector-square fas" data-name="vector-square"></i></span>
                                        <span class="icon_preview icon-fa-venus" title="venus - Solid"><i class="fa-venus fas" data-name="venus"></i></span>
                                        <span class="icon_preview icon-fa-venus-double" title="venus-double - Solid"><i class="fa-venus-double fas" data-name="venus-double"></i></span>
                                        <span class="icon_preview icon-fa-venus-mars" title="venus-mars - Solid"><i class="fa-venus-mars fas" data-name="venus-mars"></i></span>
                                        <span class="icon_preview icon-fa-viacoin" title="viacoin - Brands"><i class="fa-viacoin fab" data-name="viacoin"></i></span>
                                        <span class="icon_preview icon-fa-viadeo" title="viadeo - Brands"><i class="fa-viadeo fab" data-name="viadeo"></i></span>
                                        <span class="icon_preview icon-fa-viadeo-square" title="viadeo-square - Brands"><i class="fa-viadeo-square fab" data-name="viadeo-square"></i></span>
                                        <span class="icon_preview icon-fa-vial" title="vial - Solid"><i class="fa-vial fas" data-name="vial"></i></span>
                                        <span class="icon_preview icon-fa-vials" title="vials - Solid"><i class="fa-vials fas" data-name="vials"></i></span>
                                        <span class="icon_preview icon-fa-viber" title="viber - Brands"><i class="fa-viber fab" data-name="viber"></i></span>
                                        <span class="icon_preview icon-fa-video" title="video - Solid"><i class="fa-video fas" data-name="video"></i></span>
                                        <span class="icon_preview icon-fa-video-slash" title="video-slash - Solid"><i class="fa-video-slash fas" data-name="video-slash"></i></span>
                                        <span class="icon_preview icon-fa-vihara" title="vihara - Solid"><i class="fa-vihara fas" data-name="vihara"></i></span>
                                        <span class="icon_preview icon-fa-vimeo" title="vimeo - Brands"><i class="fa-vimeo fab" data-name="vimeo"></i></span>
                                        <span class="icon_preview icon-fa-vimeo-square" title="vimeo-square - Brands"><i class="fa-vimeo-square fab" data-name="vimeo-square"></i></span>
                                        <span class="icon_preview icon-fa-vimeo-v" title="vimeo-v - Brands"><i class="fa-vimeo-v fab" data-name="vimeo-v"></i></span>
                                        <span class="icon_preview icon-fa-vine" title="vine - Brands"><i class="fa-vine fab" data-name="vine"></i></span>
                                        <span class="icon_preview icon-fa-vk" title="vk - Brands"><i class="fa-vk fab" data-name="vk"></i></span>
                                        <span class="icon_preview icon-fa-vnv" title="vnv - Brands"><i class="fa-vnv fab" data-name="vnv"></i></span>
                                        <span class="icon_preview icon-fa-volleyball-ball" title="volleyball-ball - Solid"><i class="fa-volleyball-ball fas" data-name="volleyball-ball"></i></span>
                                        <span class="icon_preview icon-fa-volume-down" title="volume-down - Solid"><i class="fa-volume-down fas" data-name="volume-down"></i></span>
                                        <span class="icon_preview icon-fa-volume-mute" title="volume-mute - Solid"><i class="fa-volume-mute fas" data-name="volume-mute"></i></span>
                                        <span class="icon_preview icon-fa-volume-off" title="volume-off - Solid"><i class="fa-volume-off fas" data-name="volume-off"></i></span>
                                        <span class="icon_preview icon-fa-volume-up" title="volume-up - Solid"><i class="fa-volume-up fas" data-name="volume-up"></i></span>
                                        <span class="icon_preview icon-fa-vote-yea" title="vote-yea - Solid"><i class="fa-vote-yea fas" data-name="vote-yea"></i></span>
                                        <span class="icon_preview icon-fa-vr-cardboard" title="vr-cardboard - Solid"><i class="fa-vr-cardboard fas" data-name="vr-cardboard"></i></span>
                                        <span class="icon_preview icon-fa-vuejs" title="vuejs - Brands"><i class="fa-vuejs fab" data-name="vuejs"></i></span>
                                        <span class="icon_preview icon-fa-walking" title="walking - Solid"><i class="fa-walking fas" data-name="walking"></i></span>
                                        <span class="icon_preview icon-fa-wallet" title="wallet - Solid"><i class="fa-wallet fas" data-name="wallet"></i></span>
                                        <span class="icon_preview icon-fa-warehouse" title="warehouse - Solid"><i class="fa-warehouse fas" data-name="warehouse"></i></span>
                                        <span class="icon_preview icon-fa-water" title="water - Solid"><i class="fa-water fas" data-name="water"></i></span>
                                        <span class="icon_preview icon-fa-weebly" title="weebly - Brands"><i class="fa-weebly fab" data-name="weebly"></i></span>
                                        <span class="icon_preview icon-fa-weibo" title="weibo - Brands"><i class="fa-weibo fab" data-name="weibo"></i></span>
                                        <span class="icon_preview icon-fa-weight" title="weight - Solid"><i class="fa-weight fas" data-name="weight"></i></span>
                                        <span class="icon_preview icon-fa-weight-hanging" title="weight-hanging - Solid"><i class="fa-weight-hanging fas" data-name="weight-hanging"></i></span>
                                        <span class="icon_preview icon-fa-weixin" title="weixin - Brands"><i class="fa-weixin fab" data-name="weixin"></i></span>
                                        <span class="icon_preview icon-fa-whatsapp" title="whatsapp - Brands"><i class="fa-whatsapp fab" data-name="whatsapp"></i></span>
                                        <span class="icon_preview icon-fa-whatsapp-square" title="whatsapp-square - Brands"><i class="fa-whatsapp-square fab" data-name="whatsapp-square"></i></span>
                                        <span class="icon_preview icon-fa-wheelchair" title="wheelchair - Solid"><i class="fa-wheelchair fas" data-name="wheelchair"></i></span>
                                        <span class="icon_preview icon-fa-whmcs" title="whmcs - Brands"><i class="fa-whmcs fab" data-name="whmcs"></i></span>
                                        <span class="icon_preview icon-fa-wifi" title="wifi - Solid"><i class="fa-wifi fas" data-name="wifi"></i></span>
                                        <span class="icon_preview icon-fa-wikipedia-w" title="wikipedia-w - Brands"><i class="fa-wikipedia-w fab" data-name="wikipedia-w"></i></span>
                                        <span class="icon_preview icon-fa-wind" title="wind - Solid"><i class="fa-wind fas" data-name="wind"></i></span>
                                        <span class="icon_preview icon-fa-window-close" title="window-close - Solid"><i class="fa-window-close fas" data-name="window-close"></i></span>
                                        <span class="icon_preview icon-fa-window-close" title="window-close - Regular"><i class="fa-window-close far" data-name="window-close"></i></span>
                                        <span class="icon_preview icon-fa-window-maximize" title="window-maximize - Solid"><i class="fa-window-maximize fas" data-name="window-maximize"></i></span>
                                        <span class="icon_preview icon-fa-window-maximize" title="window-maximize - Regular"><i class="fa-window-maximize far" data-name="window-maximize"></i></span>
                                        <span class="icon_preview icon-fa-window-minimize" title="window-minimize - Solid"><i class="fa-window-minimize fas" data-name="window-minimize"></i></span>
                                        <span class="icon_preview icon-fa-window-minimize" title="window-minimize - Regular"><i class="fa-window-minimize far" data-name="window-minimize"></i></span>
                                        <span class="icon_preview icon-fa-window-restore" title="window-restore - Solid"><i class="fa-window-restore fas" data-name="window-restore"></i></span>
                                        <span class="icon_preview icon-fa-window-restore" title="window-restore - Regular"><i class="fa-window-restore far" data-name="window-restore"></i></span>
                                        <span class="icon_preview icon-fa-windows" title="windows - Brands"><i class="fa-windows fab" data-name="windows"></i></span>
                                        <span class="icon_preview icon-fa-wine-bottle" title="wine-bottle - Solid"><i class="fa-wine-bottle fas" data-name="wine-bottle"></i></span>
                                        <span class="icon_preview icon-fa-wine-glass" title="wine-glass - Solid"><i class="fa-wine-glass fas" data-name="wine-glass"></i></span>
                                        <span class="icon_preview icon-fa-wine-glass-alt" title="wine-glass-alt - Solid"><i class="fa-wine-glass-alt fas" data-name="wine-glass-alt"></i></span>
                                        <span class="icon_preview icon-fa-wix" title="wix - Brands"><i class="fa-wix fab" data-name="wix"></i></span>
                                        <span class="icon_preview icon-fa-wizards-of-the-coast" title="wizards-of-the-coast - Brands"><i class="fa-wizards-of-the-coast fab" data-name="wizards-of-the-coast"></i></span>
                                        <span class="icon_preview icon-fa-wolf-pack-battalion" title="wolf-pack-battalion - Brands"><i class="fa-wolf-pack-battalion fab" data-name="wolf-pack-battalion"></i></span>
                                        <span class="icon_preview icon-fa-won-sign" title="won-sign - Solid"><i class="fa-won-sign fas" data-name="won-sign"></i></span>
                                        <span class="icon_preview icon-fa-wordpress" title="wordpress - Brands"><i class="fa-wordpress fab" data-name="wordpress"></i></span>
                                        <span class="icon_preview icon-fa-wordpress-simple" title="wordpress-simple - Brands"><i class="fa-wordpress-simple fab" data-name="wordpress-simple"></i></span>
                                        <span class="icon_preview icon-fa-wpbeginner" title="wpbeginner - Brands"><i class="fa-wpbeginner fab" data-name="wpbeginner"></i></span>
                                        <span class="icon_preview icon-fa-wpexplorer" title="wpexplorer - Brands"><i class="fa-wpexplorer fab" data-name="wpexplorer"></i></span>
                                        <span class="icon_preview icon-fa-wpforms" title="wpforms - Brands"><i class="fa-wpforms fab" data-name="wpforms"></i></span>
                                        <span class="icon_preview icon-fa-wpressr" title="wpressr - Brands"><i class="fa-wpressr fab" data-name="wpressr"></i></span>
                                        <span class="icon_preview icon-fa-wrench" title="wrench - Solid"><i class="fa-wrench fas" data-name="wrench"></i></span>
                                        <span class="icon_preview icon-fa-x-ray" title="x-ray - Solid"><i class="fa-x-ray fas" data-name="x-ray"></i></span>
                                        <span class="icon_preview icon-fa-xbox" title="xbox - Brands"><i class="fa-xbox fab" data-name="xbox"></i></span>
                                        <span class="icon_preview icon-fa-xing" title="xing - Brands"><i class="fa-xing fab" data-name="xing"></i></span>
                                        <span class="icon_preview icon-fa-xing-square" title="xing-square - Brands"><i class="fa-xing-square fab" data-name="xing-square"></i></span>
                                        <span class="icon_preview icon-fa-y-combinator" title="y-combinator - Brands"><i class="fa-y-combinator fab" data-name="y-combinator"></i></span>
                                        <span class="icon_preview icon-fa-yahoo" title="yahoo - Brands"><i class="fa-yahoo fab" data-name="yahoo"></i></span>
                                        <span class="icon_preview icon-fa-yandex" title="yandex - Brands"><i class="fa-yandex fab" data-name="yandex"></i></span>
                                        <span class="icon_preview icon-fa-yandex-international" title="yandex-international - Brands"><i class="fa-yandex-international fab" data-name="yandex-international"></i></span>
                                        <span class="icon_preview icon-fa-yarn" title="yarn - Brands"><i class="fa-yarn fab" data-name="yarn"></i></span>
                                        <span class="icon_preview icon-fa-yelp" title="yelp - Brands"><i class="fa-yelp fab" data-name="yelp"></i></span>
                                        <span class="icon_preview icon-fa-yen-sign" title="yen-sign - Solid"><i class="fa-yen-sign fas" data-name="yen-sign"></i></span>
                                        <span class="icon_preview icon-fa-yin-yang" title="yin-yang - Solid"><i class="fa-yin-yang fas" data-name="yin-yang"></i></span>
                                        <span class="icon_preview icon-fa-yoast" title="yoast - Brands"><i class="fa-yoast fab" data-name="yoast"></i></span>
                                        <span class="icon_preview icon-fa-youtube" title="youtube - Brands"><i class="fa-youtube fab" data-name="youtube"></i></span>
                                        <span class="icon_preview icon-fa-youtube-square" title="youtube-square - Brands"><i class="fa-youtube-square fab" data-name="youtube-square"></i></span>
                                        <span class="icon_preview icon-fa-zhihu" title="zhihu - Brands"><i class="fa-zhihu fab" data-name="zhihu"></i></span>
                                    </div>
                                    <input type="hidden" class="fusion-iconpicker-input" value="" id="icon" name="icon">
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.create_admin_template.label.content_text_help')}}" ></i>
                        </div>
                    </div>
                    <div class="form-actions" data-name="mGMmgdHp">
                        <div class="row" data-name="xDgThtND">
                            <label class="col-form-label col-md-3"></label>
                            <div class="col-md-6" data-name="xGpmNQui">
                                <button type="submit" name="add" class="btn btn-success" value="add">{{trans('app.lang_save')}}</button>
                                <a href="{{ route('admin.issue.index') }}"><button type="button" class="btn btn-default">{{trans('app.lang_cancel')}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- END FORM-->
</div>

@endsection