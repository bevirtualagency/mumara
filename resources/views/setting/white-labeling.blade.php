@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/setting-branding.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<link href="/themes/default/css/code/prism.css?v={{$local_version}}" rel="stylesheet" type="text/css">
<link href="/themes/default/css/code/prism-line-numbers.css?v={{$local_version}}" rel="stylesheet" type="text/css">
<link href="/themes/default/css/code/prism-okaidia.css?v={{$local_version}}" rel="stylesheet" type="text/css">
<link href="/themes/default/css/code/prism-live.css?v={{$local_version}}" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/code/prism.js" type="text/javascript"></script>
<script src="/themes/default/js/code/prism-java.js" type="text/javascript"></script>
<script src="/themes/default/js/code/prism-line-numbers.js" type="text/javascript"></script>
<script src="/themes/default/js/code/prism-live.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $("#updateHeadSection").click(function(){
            var method = 'PUT';
            var form_data =  $("#custom-head-frm").serialize();
            $.ajax({
                url: '{{ Route("store.head.section") }}',
                type: method,
                data: form_data,
                dataType:'json',
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function(result) {
                    //  console.log(result.response);
                    if (result.response == 'saved') {
                        Command: toastr["success"] ("@lang('settings.message.updated_custom_head')");
                        window.location = "{{route('setting.whitelabel')}}";
                    }
                    else {
                        Command: toastr["warning"] ("@lang('settings.message.no_change')");
                    }
                    return false;
                }
            });
        });


        $(".resetImages").click(function(){
            var method = 'PUT';
            var form_data =  $("#custom-head-frm").serialize();
            $.ajax({
                url: '{{ Route("store.reset.branding") }}',
                type: method,
                data: form_data,
                dataType:'json',
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function(result) {
                    //  console.log(result.response);
                    if (result.response == 'saved') {
                        Command: toastr["success"] ("Reset successfully");
                        window.location = "{{route('setting.whitelabel')}}";
                    }
                    else {
                        Command: toastr["warning"] ("@lang('settings.message.no_change')");
                    }
                    return false;
                }
            });
        });

            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Settings/Branding");

        $("form").submit(function(e){
            @if(config('app.type') =="demo")
              Command: toastr["error"] ("@lang('common.label.demo_service_not_available')");
            return false;
            @endif
        });
        $("#custom-css-frm").validate({
            ignore: [],
            rules: {
                css: {
                    required: !0
                }
            },
            invalidHandler: function(event, validator) {
                Command: toastr["warning"] ("@lang('settings.message.empty_custom_css')");
            },
            submitHandler: function (form) {
                 @if(config('app.type') =="demo")
                  Command: toastr["error"] ("@lang('common.label.demo_service_not_available')");
                return false;
                @endif
                var method = 'PUT';
                var form_data =  $("#custom-css-frm").serialize();
                $.ajax({
                    url: '{{ Route("setting.store.css") }}',
                    type: method,
                    data: form_data,
                    dataType:'json',
                    beforeSend: function () {
                        $(".blockUI").show();
                    },
                    complete: function () {
                        $(".blockUI").hide();
                    },
                    success: function(result) {
                      //  console.log(result.response);
                        if (result.response == 'saved') {
                            Command: toastr["success"] ("@lang('settings.message.updated_custom_css')");
                            window.location = "{{route('setting.whitelabel')}}";
                        }
                        else {
                            Command: toastr["warning"] ("@lang('settings.message.no_change')");
                        }
                        return false;
                    }
                });
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-file>.fileinput-new").text(" Change ");
    });

</script>

@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="gzxKymKt">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<!-- will be used to show any messages -->
@if (Session::has('msg'))
    <div class="alert alert-success" data-name="YANlRBSt">
        {{ Session::get('msg') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" data-name="BoKjLgRd">
        {{ Session::get('error') }}
    </div>
@endif

<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="iZekGiCi">
    <span id='msg-text'><span>
</div>

<!-- BEGIN WIZARD-->
<div class="row" data-name="agIePjsm">
    <div class="col-md-6 create-form" data-name="nsfUOhZJ">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="NueNjcGm">
            <div class="kt-portlet__body" data-name="exWradlm">
                <div class="tabbable tabbable-tabdrop" data-name="ZbcZvYMq">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#tab1" class="nav-link active" data-toggle="tab" role="tab" aria-selected="true">{{trans('settings.branding.step1.title')}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab3" class="nav-link" data-toggle="tab" role="tab" aria-selected="true">{{trans('settings.branding.step2.title')}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab4" class="nav-link" data-toggle="tab" role="tab" aria-selected="true">{{trans('settings.branding.step3.title')}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab5" class="nav-link" data-toggle="tab" role="tab" aria-selected="true">{{trans('settings.branding.step4.title')}}</a>
                        </li>
                    </ul>
                    @php($app_settings =  getApplicationSettings())
                    <div class="tab-content" data-name="SkOicYsZ">
                        <div class="tab-pane active" id="tab1" data-name="ZzOAFrPt">
                            <div class="dataTables_wrapper no-footer" data-name="vVvNBmVL">
                                <div class="row" data-name="nAQmnavF">
                                   <div class="col-md-12" data-name="GIYKojed"> 
                                        <form action="{{ route('setting.whitelabel') }}" method="POST" class="kt-form kt-form--label-right">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="form_type" value="application_settings">
                                            <div class="kt-portlet kt-portlet--bordered" data-name="klGbLuvk">
                                                <div class="kt-portlet__head" data-name="KSeqHyqC">
                                                    <div class="kt-portlet__head-label" data-name="AbOPKeLc">
                                                        <h3 class="kt-portlet__head-title">{{trans('settings.branding.step1.form.heading')}}</h3>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body" data-name="dtwfLzxo">
                                                    <div class="form-body" data-name="OWpHygma">
                                                    
                                                        <div class="form-group row" data-name="CqkKkCjB">
                                                            <label class="col-form-label pl12 switch-label" for="help_icon_switch">
                                                                {{trans('settings.branding.step1.form.help_icon_switch')}}
                                                            </label>
                                                            <div class="pl12" data-name="WpVcEvEp">
                                                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                    <label>
                                                                        <input type="checkbox" @if(getSetting("help_icon_switch") == "on") checked @endif id="help_icon_switch" name="help_icon_switch">
                                                                        <span></span>
                                                                    </label>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <?php
                                                            $title = getSetting("title");
                                                            $copyright = getSetting("copyright");
                                                            $login_title = getSetting("login_title");
                                                            $login_desc = getSetting("login_desc");

                                                        ?>
                                                        <div class="form-group row" data-name="TmEutCJy">
                                                                
                                                            <div class="col-md-6" data-name="kQTmxiSp">
                                                                <label class="col-form-label">{{trans('settings.branding.step1.form.application_title')}}
                                                                    {!! popover('settings.branding.step1.form.application_title_help','common.description') !!}
                                                                </label>
                                                                <div class="input-icon right" data-name="AcUUxgGk">
                                                                    <input type="text" name="title" value="{{isset($title) && !empty($title) ? $title : 'Application Title' }}" class="form-control" />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" data-name="UkCYUnJK">
                                                                <label class="col-form-label">{{trans('settings.branding.step1.form.copyright_statement')}}
                                                                    {!! popover('settings.branding.step1.form.copyright_statement_help','common.description') !!}

                                                                </label>
                                                                <div class="input-icon right" data-name="lAbpofdC">
                                                                    <input type="text" name="copyright" value="{{isset($copyright) && !empty($copyright) ? $copyright : 'Mumara LLC' }}" class="form-control"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row" data-name="LDmBPjCR">
                                                                
                                                            <div class="col-md-6" data-name="DdLJwcsq">
                                                                <label class="col-form-label">{{trans('settings.branding.step1.form.login_screen_title')}}
                                                                    {!! popover('settings.branding.step1.form.login_screen_title_help','common.description') !!}

                                                                </label>
                                                                <div class="input-icon right" data-name="jZxYQzlZ">
                                                                    <input type="text" name="login_title" value="{{isset($login_title) && !empty($login_title) ? $login_title : 'Login to the Application' }}" class="form-control"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6" data-name="nTnPNCpK">
                                                                <label class="col-form-label">{{trans('settings.branding.step1.form.login_screen_slogan')}}
                                                                    {!! popover('settings.branding.step1.form.login_screen_slogan_help','common.description') !!}
                                                                </label>
                                                                <div class="input-icon right" data-name="dAJNRVOl">
                                                                    <input type="text" name="login_desc" value="{{isset($login_desc) && !empty($login_desc) ? $login_desc : 'Use your registered email address and password to log in' }}" class="form-control"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__foot" data-name="TwXhLvET">
                                                    <div class="row" data-name="SrdGllsr">
                                                        <div class="col-md-12" data-name="DmSStcQi">
                                                            <button type="submit" class="btn btn-success" value="">{{trans('common.form.buttons.save')}}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab3" data-name="SzBrgTsp">
                            <div class="dataTables_wrapper no-footer" data-name="hBFfhHmO">
                                <div class="row" data-name="wfnGzkLE">
                                    <div class="col-md-12" data-name="fAMimNgT">
                                        <form action="{{ route('setting.whitelabel') }}" method="POST" class="kt-form kt-form--label-right" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="hidden" name="form_type" value="branding">
                                            <div class="kt-portlet kt-portlet--bordered" data-name="JsmxHbSJ">
                                                <div class="kt-portlet__head" data-name="KqYdLCoM">
                                                    <div class="kt-portlet__head-label" data-name="IYDOWaCq">
                                                        <h3 class="kt-portlet__head-title">{{trans('settings.branding.step2.form.heading')}}</h3>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__body" data-name="kaDkokqj">
                                                    <div class="form-bodyfiles" data-name="NPkEDvYg">
                                                        <div class="row" data-name="bsJexEGj">
                                                            <div class="col-md-6" data-name="UCxKLkiN">
                                                               <div class="form-group row" data-name="ifgMKFmq">
                                                                    <label class="filelabel">{{trans('settings.branding.step2.form.dashboard_logo')}}</label>
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('app.settings.branding.dashboard_logo')}}: 167px by 40px" data-name="gzbpNWgq">
                                                                        <div class="fileinput-new thumbnail" style="height: auto;" data-name="ONAFnFHm">
                                                                            <?php 
                                                                            $logo_name = url("public/img/logo.png");
                                                                                if(!empty(getSetting("logo"))) { 
                                                                                    $logo_name = "storage/branding/" . getSetting("logo") ;
                                                                                }
                                                                             ?>
                                                                            <img src="{{ asset($logo_name)}}" alt="" title="{{trans('app.settings.branding.dashboard_logo')}}" height="40px"> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 150px; line-height: 10px;" data-name="DvFOZJeP"></div>
                                                                        <div class="dimension bg-white" data-name="OZhepiOr">@lang('settings.branding.step2.form.dashboard_logo_help')</div>
                                                                        <div class="files-btn" data-name="SgcAxlVC">
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> {{trans('common.label.select_image')}} </span>
                                                                                <span class="fileinput-exists"> {{trans('common.label.change')}} </span>
                                                                                <input type="hidden" value="" name=""><input type="file" name="attachment"> </span>
                                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('common.label.remove')}} </a>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-6" data-name="qDNtHOQY">
                                                               <div class="form-group row" data-name="XbWGFxtQ">
                                                                    <label class="filelabel">{{trans('settings.branding.step2.form.login_logo')}}</label>
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('app.settings.branding.login_logo')}}: 247px by 60px" data-name="DblaRHBo">
                                                                        <div class="fileinput-new thumbnail bg-white" style="height: auto;" data-name="KRMcBTJl">
                                                                            <?php 
                                                                            $logo_dark = url("public/img/logo_dark.png");
                                                                                if(!empty(getSetting("logo_dark"))) { 
                                                                                    $logo_dark = "storage/branding/" . getSetting("logo_dark");
                                                                                }
                                                                             ?>
                                                                            <img src="{{ asset($logo_dark)}}" alt="" height="40px"> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; height: 40px; line-height: 40px;" data-name="kXiterZe"></div>
                                                                        <div class="dimension bg-white" data-name="jBeMtOaV">@lang('settings.branding.step2.form.login_logo_help')</div>
                                                                        <div class="files-btn" data-name="FuyDwXwb">
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> {{trans('common.label.select_image')}} </span>
                                                                                <span class="fileinput-exists"> {{trans('common.label.change')}} </span>
                                                                                <input type="hidden" value="" name=""><input type="file" name="logo_dark"> </span>
                                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('common.label.remove')}} </a>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-6 favicon" data-name="JuRocSgh">
                                                               <div class="form-group row" data-name="yOojQdar">
                                                                    <label class="filelabel">{{trans('settings.branding.step2.form.favicon')}}</label>
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('app.dashboard.lang.favicon')}}: 16px by 16px" data-name="loumksRR">
                                                                        <div class="fileinput-new thumbnail bg-white" style="" data-name="kBwQfkpD">
                                                                            <?php 
                                                                            $favicon = url("public/img/favicon.ico");
                                                                                if(!empty(getSetting("favicon"))) { 
                                                                                    $favicon = "storage/branding/" . getSetting("favicon");
                                                                                }
                                                                             ?>
                                                                            <img src="{{ asset($favicon)}}" alt="" class="{{trans('app.dashboard.lang.favicon')}}"> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; max-height: 40px; line-height: 10px;" data-name="oXCmwKAD"></div>
                                                                        <div class="dimension bg-white" data-name="buyrCEll">@lang('settings.branding.step2.form.favicon_help')</div>
                                                                        <div class="files-btn" data-name="hxnDkRDQ">
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> {{trans('common.label.select_image')}} </span>
                                                                                <span class="fileinput-exists"> {{trans('common.label.change')}} </span>
                                                                                <input type="hidden" value="" name=""><input type="file" name="favicon"> </span>
                                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('common.label.remove')}} </a>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-6 thumb" data-name="KpRMxpjx">
                                                               <div class="form-group row" data-name="YztyixQv">
                                                                    <label class="filelabel">@lang('settings.branding.step2.form.preloader_image')</label>
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('Preloader Image')}}: 230px by 230px" data-name="jyrwOfVj">
                                                                        <div class="fileinput-new thumbnail bg-white" style="height: auto;" data-name="nIEpWyrT">
                                                                            <?php 
                                                                            $favicon = url("public/img/favicon.ico");
                                                                            $thumb = url("/public/img/thumb.jpg");
                                                                                if(!empty(getSetting("thumb"))) { 
                                                                                    $thumb = "storage/branding/" . getSetting("thumb");
                                                                                }
                                                                             ?>
                                                                            <img src="{{ url($thumb)}}" alt="" height="40px"> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 300px; height: 40px; line-height: 40px;" data-name="wRQZIOQj"></div>
                                                                        <div class="dimension bg-white" data-name="YGjzmUaX">@lang('settings.branding.step2.form.preloader_image_help')</div>
                                                                        <div class="files-btn" data-name="ZoouCpjP">
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> {{trans('common.label.select_image')}} </span>
                                                                                <span class="fileinput-exists"> {{trans('common.label.change')}} </span>
                                                                                <input type="hidden" value="" name=""><input type="file" name="preloader"> </span>
                                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('common.label.remove')}} </a>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            <div class="col-md-6" data-name="UCxKLkiM">
                                                               <div class="form-group row" data-name="ifgMKFmq">
                                                                    <label class="filelabel">{{trans('settings.branding.step2.form.landing_banner')}}</label>
                                                                    <div class="fileinput fileinput-new" data-provides="fileinput" data-toggle="tooltip" data-placement="top" title="{{trans('settings.branding.step2.form.landing_banner')}}: 1800px by 2000px" data-name="gzbpNWgq">
                                                                        <div class="fileinput-new thumbnail bg-white" style="height: auto;" data-name="ONAFnFHm">
                                                                            <?php 
                                                                            $login_background = url("public/img/bg.png");
                                                                                if(!empty(getSetting("login_background"))) { 
                                                                                    $login_background = "/storage/branding/" . getSetting("login_background");
                                                                                }
                                                                             ?>
                                                                            <img src="<?php echo $login_background; ?>" alt="" title="{{trans('settings.branding.step2.form.landing_banner')}}" height="200px"> </div>
                                                                        <div class="fileinput-preview fileinput-exists thumbnail thumbnail2" style="max-width: 300px; max-height: 200px; line-height: 10px;" data-name="DvFOZJeP"></div>
                                                                        <div class="dimension bg-white" data-name="OZhepiOr">@lang('settings.branding.step2.form.landing_banner_help')</div>
                                                                        <div class="files-btn" data-name="SgcAxlVC">
                                                                            <span class="btn default btn-file">
                                                                                <span class="fileinput-new"> {{trans('common.label.select_image')}} </span>
                                                                                <span class="fileinput-exists"> {{trans('common.label.change')}} </span>
                                                                                <input type="hidden" value="" name=""><input type="file" name="login_background"> </span>
                                                                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> {{trans('common.label.remove')}} </a>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="kt-portlet__foot" data-name="mUCbtiim">
                                                    <div class="form-actions" data-name="sWFcuTxI">
                                                        <div class="row" data-name="rsflnvQo">
                                                            <div class="col-md-12 text-center" data-name="iiPpZGyq">
                                                                <button type="submit" class="btn btn-success" value="">{{trans('common.form.buttons.save')}}</button>
                                                                <button type="button" class="btn btn-warning resetImages" value="">{{trans('Reset')}}</button>
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab4" data-name="TIsfvCjF">
                            <div class="dataTables_wrapper no-footer" data-name="vyhPvBSH">
                                <div class="row" data-name="IqUeWGsf">
                                    <div class="col-md-12" data-name="FLfZFRkb">
                                        <form action="" method="POST" id="custom-css-frm" class="kt-form kt-form--label-right">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input name="_method" type="hidden" value="PUT">

                                            <div class="row" data-name="OCNVbUfo">

                                                <div class="kt-portlet kt-portlet--bordered" data-name="AawXFTsv">
                                                    <div class="kt-portlet__head" data-name="khXoikhZ">
                                                        <div class="kt-portlet__head-label" data-name="OGiNNAqV">
                                                            <h3 class="kt-portlet__head-title">{{trans('settings.branding.step3.form.heading')}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="kt-portlet__body" data-name="qStErXNH">
                                                        <div class="form-body" data-name="wXyrmEBd">
                                                            <div class="form-group row" data-name="ZlbNccUH">
                                                                
                                                                <div class="col-md-12" data-name="AhFzVhNP">
                                                                    <label class="col-form-label">{{trans('settings.branding.step3.title')}}</label>
                                                                    <div class="input-icon right" data-name="giKhuxSO">
                                                                        <textarea name="css" class="form-control scroll scroll-250 ccss-area" rows="15">{{isset($css) ? $css : '' }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="kt-portlet__foot" data-name="NSsQmfFg">
                                                        <div class="form-actions" data-name="dfuTEKOn">
                                                            <div class="row" data-name="MGHKWVIP">
                                                                <div class="col-md-12" data-name="IwOluhol">
                                                                    <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab5" data-name="TIsfvCjF">
                            <div class="dataTables_wrapper no-footer" data-name="vyhPvBSH">
                                <div class="row" data-name="IqUeWGsf">
                                    <div class="col-md-12" data-name="FLfZFRkb">
                                        <form action="" method="POST" id="custom-head-frm" name="custom-head-frm" class="kt-form kt-form--label-right">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input name="_method" type="hidden" value="PUT">

                                            <div class="row" data-name="OCNVbUfo">

                                                <div class="kt-portlet kt-portlet--bordered" data-name="AawXFTsv">
                                                    <div class="kt-portlet__head" data-name="khXoikhZ">
                                                        <div class="kt-portlet__head-label" data-name="OGiNNAqV">
                                                            <h3 class="kt-portlet__head-title">{{trans('settings.branding.step4.form.heading')}}</h3>
                                                        </div>
                                                    </div>
                                                    <div class="kt-portlet__body" data-name="qStErXNH">
                                                        <div class="form-body" data-name="wXyrmEBd">
                                                            <div class="form-group header-code-area" data-name="ZlbNccUH">
                                                                <textarea class="prism-live line-numbers language-html fill" name="head_section" id="head_section">{{isset($headSection) ? $headSection : '' }}</textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="kt-portlet__foot" data-name="NSsQmfFg">
                                                        <div class="form-actions" data-name="dfuTEKOn">
                                                            <div class="row" data-name="MGHKWVIP">
                                                                <div class="col-md-12" data-name="IwOluhol">
                                                                    <button type="button" name="edit" id="updateHeadSection" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
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

@endsection