@extends('layouts.master')

@section('page_styles')
<style>
.addon-box {
    max-width: 200px;
    height: auto;
    position: relative;
    margin: 10px 15px 10px 0;
    text-align: center;
    border: 1px solid #ddd;
    box-shadow: 0 1px 1px -1px rgba(0,0,0,.1);
    box-sizing: border-box;
    float: right;
}
.addon-box .addon-wrapper .addon-thumb .img-responsive {
    display: block;
    height: auto;
    transition: opacity 0.2s ease-in-out 0s, transform 0.2s ease-in-out 0s;
}
.addon-box .addon-wrapper:hover .addon-thumb .img-responsive {
    opacity: 0.3;
    -webkit-transform: scale(1.1);
    transform: scale(1.1);
}
.addon-box .addon-wrapper .addon-thumb {
    width: 100%;
    height: auto;
    border-bottom: 1px solid #ddd;
    background: #000;
    overflow: hidden;
}
.addon-box .addon-wrapper h3.addon-name  {
    line-height: 18px;
    font-weight: 600;
}
.addon-box .addon-wrapper h3.addon-name {
    font-size: 15px;
    font-weight: 600;
    margin: 0;
    padding: 15px;
    box-shadow: inset 0 1px 0 rgba(0,0,0,.1);
    overflow: hidden;
    white-space: nowrap;
    text-overflow: ellipsis;
    background: #fff;
    background: rgba(255,255,255,.65);
    line-height: 1.5;
    display: block;
}
.addon-box .addon-wrapper .theme-actions {
    z-index: 1;
    height: 34px;
    top: 0;
    opacity: 0;
    right: auto;
    transform: translate3d(55%, 60px, 0px);
}
.addon-box .addon-wrapper:focus .theme-actions, .addon-box .addon-wrapper:hover .theme-actions {
    opacity: 1;
}
.addon-box .addon-wrapper .theme-actions {
    position: absolute;
    padding: 0;
}
.addon-box .addon-wrapper .theme-actions span.btn-success {
    padding: 6px 12px;
    border-radius: 4px;
    cursor: default;
    margin-bottom: 0;
    font-weight: 400;
    text-align: center;
    vertical-align: middle;
    touch-action: manipulation;
}
.portlet.box>.portlet-body {
    padding: 50px 15px;
}
.addonBlk {
    display: block;
    float: left;
    position: relative;
    padding-bottom: 10px;
    margin-bottom: 10px;
    border-bottom: 1px solid #ddd;
    width: 96%;
    margin-left: 2%;
}
.addonsContent {
    display: block;
    padding-left: 15px;
}
.adsMain .col-md-12:last-child .addonBlk {
    border: 0;
}
.addonsContent h3 {
    font-weight: 600;
    margin-bottom: 5px;
}
.addonsContent .price {
    font-size: 12px;
    color: #666;
    margin-bottom: 5px;
}
.addonsContent p {
    text-align: justify;
}
</style>
@endsection
@section('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
    
    });
</script>
@endsection
@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="ImknwIfe">
    <ul class="page-breadcrumb">
        <li>
            <span><a href="{{ route('dashboard') }}">{{trans('app.breadcrumbs.dashboard')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('settings.showaddons_available_span')}} </span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('settings.showaddons_campaigns_addons_span')}}</h1>
<!-- END PAGE TITLE-->
<div class="m-heading-1 border-green m-bordered" data-name="nplaIPIf">
    <p>{{trans('settings.showaddons_campaigns_d_para')}} </p>
</div>
<!-- END PAGE HEADER-->




<div class="row" data-name="bniNOpmy">
    <div class="col-md-8 col-md-offset-2" id="licActive" data-name="OQyLWGsR">
        <div class="portlet light bordered" data-name="kyTggpSy">
            <div class="portlet-title" data-name="ygzxgOhJ">
                <div class="caption" data-name="SrspXSme">
                    <span class="caption-subject">{{trans('settings.showaddons_campaigns_addons_span')}} </span>
                </div>
            </div>
            <div class="portlet-body" data-name="BQppEDQO">

                <div class="tabbable tabbable-tabdrop" data-name="BaImFpJA">
                    <ul class="nav nav-tabs">
                        <li class="active">
                            <a href="#tab1" data-toggle="tab" aria-expanded="true">{{trans('settings.showaddons_all_addons_action')}} </a>
                        </li>
                        <li class="">
                            <a href="#tab2" data-toggle="tab" aria-expanded="false">{{trans('settings.showaddons_purchased_action')}} </a>
                        </li>
                        <li class="">
                            <a href="#tab3" data-toggle="tab" aria-expanded="false">{{trans('settings.showaddons_available_action')}} </a>
                        </li>
                    </ul>
                    <div class="tab-content" data-name="bOjTgSzb">
                        <div class="tab-pane active" id="tab1" data-name="rBAUcOkC">
                            <div class="row adsMain" data-name="XQmTqWXl">
                                <div class="col-md-12" data-name="gsPoqmWu">
                                    <div class="row" data-name="AyYsgUOC">
                                        <div class="col-md-9" data-name="aIAgBaUG">
                                            <div class="addonsContent" data-name="XGgUESLS">
                                                <h3>{{trans('settings.showaddons_email_builder_heading')}} </h3>
                                                <div class="price" data-name="OtzaNUcr">
                                                    <b>{{trans('settings.showaddons_price_bold')}} </b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="JRpyBawn">
                                            <div class="addon-box" data-name="ByowNDxM">
                                                <div class="addon-wrapper" data-name="VBVGiivV">
                                                    <div class="addon-thumb" data-name="PXPnpTHO">
                                                        <img src="/resources/assets/images/dragndrop.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    <div class="theme-actions" data-name="LjEpBsnX">
                                                        <a href="javascript:;" class="btn btn-info" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}} </a>
                                                        <span class="btn btn-success hide" title="Purchased">{{trans('settings.showaddons.span_purchased')}} </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="WnnnHHgf"></div>
                                    </div>
                                </div>
                                <div class="col-md-12" data-name="KCKnrKNN">
                                    <div class="row" data-name="twENMrzN">
                                        <div class="col-md-9" data-name="KnrbCBVf">
                                            <div class="addonsContent" data-name="ZlpXpjCW">
                                                <h3 class="addon-name">{{trans('settings.showaddons_emojis_heading')}} </h3>
                                                <div class="price" data-name="DjJVxHUB">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="hQjTwLOG">
                                            <div class="addon-box" data-name="MjTCmXpu">
                                                <div class="addon-wrapper" data-name="BPebJJXc">
                                                    <div class="addon-thumb" data-name="ujDFoQGG">
                                                        <img src="/resources/assets/images/emoji.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    <div class="theme-actions" data-name="xglyNRht">
                                                        <a href="javascript:;" class="btn btn-info hide" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="YXWHklFq"></div>
                                    </div>     
                                </div>
                                <div class="col-md-12" data-name="iPUERaVm">
                                    <div class="row" data-name="eZAxdkwY">
                                        <div class="col-md-9" data-name="ivLMjGnx">
                                            <div class="addonsContent" data-name="koBcWnKj">
                                                <h3 class="addon-name">{{trans('settings.showaddons_powermta_heading')}} </h3>
                                                <div class="price" data-name="HdXCtXry">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="VAOYPfsN">
                                            <div class="addon-box" data-name="NBTWIVko">
                                                <div class="addon-wrapper" data-name="tNidcvHE">
                                                    <div class="addon-thumb" data-name="vTCUTXXe">
                                                        <img src="/resources/assets/images/pmta.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    
                                                    <div class="theme-actions" data-name="qNamjpKn">
                                                        <a href="javascript:;" class="btn btn-info" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success hide" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="eDMSYRyK"></div>
                                    </div>
                                </div>
                                <div class="col-md-12" data-name="hkpBKdaN">
                                    <div class="row" data-name="nSdvMMqN">
                                        <div class="col-md-9" data-name="JaapbdCb">
                                            <div class="addonsContent" data-name="LgyCnpAu">
                                                <h3 class="addon-name">{{trans('settings.showaddons_white_labeling_heading')}} </h3>
                                                <div class="price" data-name="CHTFCOlN">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="DGIUbXcC">
                                            <div class="addon-box" data-name="cafUUPnY">
                                                <div class="addon-wrapper" data-name="wSUvjZQe">
                                                    <div class="addon-thumb" data-name="FXmDlifu">
                                                        <img src="/resources/assets/images/whitelabel.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    
                                                    <div class="theme-actions" data-name="MsuCGYJg">
                                                        <a href="javascript:;" class="btn btn-info hide" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="blHoROWE"></div>
                                    </div>
                                </div>
                                <div class="col-md-12" data-name="tSarJpPh">
                                    <div class="row" data-name="kevTmwHp">
                                        <div class="col-md-9" data-name="LtUhBOvQ">
                                            <div class="addonsContent" data-name="WWlLBbPr">
                                                <h3 class="addon-name">{{trans('settings.showaddons_campaigns_pixel_heading')}} </h3>
                                                <div class="price" data-name="stWCehEE">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="CMiqQxTn">
                                            <div class="addon-box" data-name="nzKwHXqt">
                                                <div class="addon-wrapper" data-name="hYgHoUxn">
                                                    <div class="addon-thumb" data-name="cosocowL">
                                                        <img src="/resources/assets/images/pixel.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    
                                                    <div class="theme-actions" data-name="AfyzJcKB">
                                                        <a href="javascript:;" class="btn btn-info" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success hide" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="bRRmwCiB"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2" data-name="rcbvCNUD">
                            <div class="row adsMain" data-name="tXdVQZkG">
                                <div class="col-md-12" data-name="jxJkpoJu">
                                    <div class="row" data-name="pKKpIPDq">
                                        <div class="col-md-9" data-name="KPzMaFYA">
                                            <div class="addonsContent" data-name="tKGZPUHQ">
                                                <h3 class="addon-name">{{trans('settings.showaddons_emojis_heading')}}</h3>
                                                <div class="price" data-name="WLtjTLRg">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="jmqFIURW">
                                            <div class="addon-box" data-name="VxHAoYOf">
                                                <div class="addon-wrapper" data-name="XAVNjUnj">
                                                    <div class="addon-thumb" data-name="VeNiDpAA">
                                                        <img src="/resources/assets/images/emoji.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    <div class="theme-actions" data-name="mVNqigCb">
                                                        <a href="javascript:;" class="btn btn-info hide" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="xfQMoCaV"></div>
                                    </div>     
                                </div>
                                <div class="col-md-12" data-name="jwswMFWx">
                                    <div class="row" data-name="QDOoNtQX">
                                        <div class="col-md-9" data-name="psBhPpkr">
                                            <div class="addonsContent" data-name="ywjyEioW">
                                                <h3 class="addon-name">{{trans('settings.showaddons_white_labeling_heading')}} </h3>
                                                <div class="price" data-name="tHAuegRd">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="VTcDmQri">
                                            <div class="addon-box" data-name="voZmREXr">
                                                <div class="addon-wrapper" data-name="DLygaxNp">
                                                    <div class="addon-thumb" data-name="qEsPQBPd">
                                                        <img src="/resources/assets/images/whitelabel.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    
                                                    <div class="theme-actions" data-name="MmKAnZzN">
                                                        <a href="javascript:;" class="btn btn-info hide" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="qvFDmgnM"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3" data-name="VOPlcmaj">
                            <div class="row adsMain" data-name="Jlsgwucu">
                                <div class="col-md-12" data-name="MSkBaFUF">
                                    <div class="row" data-name="PoKzDeHV">
                                        <div class="col-md-9" data-name="QYsVVIkM">
                                            <div class="addonsContent" data-name="kTIOdLnq">
                                                <h3>{{trans('settings.showaddons_email_builder_heading')}} </h3>
                                                <div class="price" data-name="NBovbFoy">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="CSkkczsZ">
                                            <div class="addon-box" data-name="bgheZCin">
                                                <div class="addon-wrapper" data-name="hsdQceqz">
                                                    <div class="addon-thumb" data-name="tsEXwcix">
                                                        <img src="/resources/assets/images/dragndrop.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    <div class="theme-actions" data-name="UMdgSDHO">
                                                        <a href="javascript:;" class="btn btn-info" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success hide" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="zaurbCCL"></div>
                                    </div>
                                </div>
                                <div class="col-md-12" data-name="gpFmBXaP">
                                    <div class="row" data-name="TOUGPQqc">
                                        <div class="col-md-9" data-name="CQhbDvks">
                                            <div class="addonsContent" data-name="wFUtViHb">
                                                <h3 class="addon-name">{{trans('settings.showaddons_powermta_heading')}}</h3>
                                                <div class="price" data-name="OvAaoGEv">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="ofjJWSzW">
                                            <div class="addon-box" data-name="hHufkWuP">
                                                <div class="addon-wrapper" data-name="mekJCiHc">
                                                    <div class="addon-thumb" data-name="tiFALmes">
                                                        <img src="/resources/assets/images/pmta.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    
                                                    <div class="theme-actions" data-name="QwZqLbow">
                                                        <a href="javascript:;" class="btn btn-info" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success hide" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="iLjOHTpt"></div>
                                    </div>
                                </div>
                                <div class="col-md-12" data-name="WhkdEXEi">
                                    <div class="row" data-name="JDOXqfiR">
                                        <div class="col-md-9" data-name="lqvbDOEG">
                                            <div class="addonsContent" data-name="xWHNGFkg">
                                                <h3 class="addon-name">{{trans('settings.showaddons_campaigns_pixel_heading')}} </h3>
                                                <div class="price" data-name="TMpOvPHk">
                                                    <b>{{trans('settings.showaddons_price_bold')}}</b> $47
                                                </div>
                                                <p>
                                                    {{trans('settings.showaddons.dummy_data')}} <a href="javascript:;">{{trans('settings.showaddons.action_learn')}}</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-3" data-name="yitInEZU">
                                            <div class="addon-box" data-name="wTdeqAxb">
                                                <div class="addon-wrapper" data-name="aPZBHUzO">
                                                    <div class="addon-thumb" data-name="fQDwGGoP">
                                                        <img src="/resources/assets/images/pixel.jpg" alt="" class="img-responsive">
                                                    </div>
                                                    
                                                    <div class="theme-actions" data-name="YQmzPMie">
                                                        <a href="javascript:;" class="btn btn-info" title="Buy Addon">{{trans('settings.showaddons.action_buy_addon')}}</a>
                                                        <span class="btn btn-success hide" title="Purchased">{{trans('settings.showaddons.span_purchased')}}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 addonBlk" data-name="ziTYFQgf"></div>
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



<div id="preloader" style="display: none;" data-name="RhRlIjUs">
    <div data-loader="circle-side" style="display: block;" data-name="kxVqHVRY"></div>
</div>


@endsection