@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/client-package-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/lib.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.input.js" type="text/javascript"></script>
<script src="/themes/default/js/repeater.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/package.js?v=14" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){

        jQuery('#bounce_addresses').live('click', function(event) {
            if($(this).is(":checked")) { 
                jQuery('#showBounceAddresses').show();
            } else { 
                jQuery('#showBounceAddresses').hide();
            } 
        });
        jQuery('#sending_domains').live('click', function(event) {
            if($(this).is(":checked")) { 
                jQuery('#showDomains').show();
            } else { 
                jQuery('#showDomains').hide();
            } 
        });

        $(".m-select2").select2({
            placeholder: '@lang('common.label.select_option')',
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
    });

    var form_error="{{trans('common.message.form_error')}}";

    function overSending() {
        if($("#over-sending").is(":checked")) {
            $("#oversending-area").show();
        } else {
            $("#oversending-area").hide();
        }
    }
    overSending();
</script>
<script type="text/javascript">
    var KTFormRepeater = function() {
        var demo1 = function() {
            $('#kt_repeater_3').repeater({
                initEmpty: false,
               
                defaultValues: {
                    'text-input': 'foo'
                },
                 
                show: function() {
                    $(this).slideDown();                               
                },

                hide: function(deleteElement) {                 
                    if(confirm('@lang("common.message.delete_warning")')) {
                        $(this).slideUp(deleteElement);
                    }                                  
                }      
            });
        }
        return {
            init: function() {
                demo1();
            }
        };
    }();
    jQuery(document).ready(function() {
        KTFormRepeater.init();
    });

    $("body").on("change" , "#sending_nodes" , function() { 
        if($(this).is(":checked")) { 
           $("#sending_node").val("yes");
           $("#showSMTPType").show();
           if($("#smtp_type").val() == "group") { 
           $("#showGroups").show();
        } else { 
            $("#showSMTPs").hide();
        }
        } else { 
            $("#sending_node").val("no");
            $("#showSMTPType").hide();
            $("#showSMTPs").hide();
            $("#showGroups").hide();
        }
    });
    $("body").on("change" , "#smtp_type" , function() { 
        if($(this).val() == "group") { 
           $("#showGroups").show();
           $("#showSMTPs").hide();
        } else { 
            $("#showSMTPs").show();
            $("#showGroups").hide();
        }
    });


    $("#allow_suppress_domains_limit").click(function() {
        if($(this).is(":checked")){
            $("#monthly_blk").show();
        } else {
            $("#monthly_blk").hide();
        }
    });


    $("#bounce_rate_limitBtn").click(function() {
        if($(this).is(":checked")){
            $("#bounce_rate_limitCheck").show();
        } else {
            $("#bounce_rate_limitCheck").hide();
        }
    });

</script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="fURIHKYh">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="DOSNPspR">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="VxlbNGcu">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="row" data-name="UoBKNLzi">
    <div class="col-md-6 create-form" data-name="HWRvLKqR">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="IibIEZYW">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="cWyxkbUn">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="UlMLlgsi">
                    <div class="kt-wizard-v4__nav-items" data-name="mawhcLDK">
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="aEoNMMNy">
                                <div class="kt-wizard-v4__nav-number" data-name="obxGLwBv">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="bvEGtLJD">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="kAhHjjoq">
                                        {{ trans('users.packages.add_new.step1.heading') }}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="NwfAlbWv">
                                        {{ trans('users.packages.add_new.step1.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="JSxSJmja">
                                <div class="kt-wizard-v4__nav-number" data-name="DUnOQmmt">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="vQpCvzSP">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="XLchYcPt">
                                         {{ trans('users.packages.add_new.step2.heading') }}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="YcMRrUxj">
                                       {{ trans('users.packages.add_new.step2.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="kt-portlet form" data-name="lgoSChpA">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="ndaoujYm">
                        <div class="kt-grid" data-name="EUmtMTEk">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="kTGscJBj">

                                @if ($page_data['action'] == 'add')
                                    <form action="{{ route('client.package.save') }}" method="POST" id="subuser-frm" class="kt-form kt-form--label-right">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="action" value="add">
                                @else 
                                    <form action="{{ route('client.package.update', $package->id) }}" method="POST" id="subuser-frm" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="edit">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="user-id" value="{{$package->id}}">
                                    <input type="hidden" name="_method" value="PUT">
                                @endif

                                    <div class="form-wizard" id="form_wizard_1" data-name="EMCMUDtE">
                                        <div class="form-body" data-name="qBcLSPYV">
                                            <div class="form-wizard" id="form_wizard_1" data-name="EbtxQtkX">
                                                
                                                <div class="tab-content" data-name="GcayvMPX">
                                                    <div class="alert alert-danger display-none" data-name="xrVPuoCT">
                                                        <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} 
                                                    </div>
                                                    <div class="alert alert-success display-none" data-name="immUafKY">
                                                        <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} 
                                                    </div>

                                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="pyqPjOSo">
                                                        <div class="kt-form__section kt-form__section--first" data-name="RRnvWFmH">
                                                            <div class="kt-wizard-v4__form" data-name="fHcWBXqy">

                                                                <div class="form-group row" data-name="QdnSINwi">
                                                                        
                                                                    <div class="col-md-6" data-name="aGpIRskk">
                                                                        <label class="col-form-label">{{trans('users.packages.add_new.step1.form.package')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('users.packages.add_new.step1.form.package_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="kMYXuGbM">
                                                                            <input type="text" name="package_name" value="{{isset($package->package_name) ? $package->package_name : '' }}" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6" data-name="gqZJkYPR">
                                                                        <label class="col-form-label">{{trans('users.packages.add_new.step1.form.role_group')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('users.packages.add_new.step1.form.role_group_help','common.description') !!}
                                                                        </label>
                                                                        <select class="form-control m-select2" data-placeholder="Choose Role" name="role_id" id="role-id">
                                                                            @foreach($roles as $role)
                                                                                <option value="{{ $role->id }}" {{ (isset($package->role_id) && $package->role_id == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="form-group row" data-name="GtkQTJVD">
                                                                        
                                                                    <div class="col-md-6" data-name="GivTCHUU">
                                                                        <label class="col-form-label">{{trans('users.packages.add_new.step1.form.hourly_speed')}}
                                                                            {!! popover('users.packages.add_new.step1.form.hourly_speed_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="SdhTRWTF">
                                                                            <input type="text" name="hourly_email_limit" value="{{isset($package->hourly_email_limit) ? $package->hourly_email_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                    <div class="col-md-6" data-name="lOaEhkpL">
                                                                        <label class="col-form-label">{{trans('users.packages.add_new.step1.form.daily_limit')}}
                                                                            {!! popover('users.packages.add_new.step1.form.daily_limit_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="aQvnEIKa">
                                                                            <input type="text" name="daily_email_limit" value="{{isset($package->daily_email_limit) ? $package->daily_email_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                </div>
                                                                

                                                                <div class="form-group row" data-name="QcWwoXCq">
                                                                        
                                                                    <div class="col-md-6" data-name="jtZWJPti">
                                                                        <label class="col-form-label">{{trans('users.packages.add_new.step1.form.monthly_quota')}}
                                                                            {!! popover('users.packages.add_new.step1.form.monthly_quota_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="jaKFHsnj">
                                                                            <input type="text" name="monthly_email_limit" value="{{isset($package->monthly_email_limit) ? $package->monthly_email_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                    <div class="col-md-6" data-name="prTGZarP">
                                                                        <label class="col-form-label">{{trans('users.packages.add_new.step1.form.maximum_contacts')}}
                                                                            {!! popover('users.packages.add_new.step1.form.maximum_contacts_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="RTDNmHtK">
                                                                            <input type="text" name="subscribers_limit" value="{{isset($package->subscribers_limit) ? $package->subscribers_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                </div>
                                                                

                                                                <div class="form-group row" data-name="zzdtUvVO">
                                                                        
                                                                    <div class="col-md-6" data-name="IVSRnSyE">
                                                                        <label class="col-form-label">{{trans('users.packages.add_new.step1.form.maximum_sending_domains')}}
                                                                            {!! popover('users.packages.add_new.step1.form.maximum_sending_domains_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="HWUhJgqx">
                                                                            <input type="text" name="sending_domain_limit" value="{{isset($package->sending_domain_limit) ? $package->sending_domain_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                    <div class="col-md-6" data-name="bXVRAFHt">
                                                                        <label class="col-form-label">{{trans('users.packages.add_new.step1.form.maximum_sending_nodes')}}
                                                                            {!! popover('users.packages.add_new.step1.form.maximum_sending_nodes_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="thipaKzB">
                                                                            <input type="text" name="smtps_limit" value="{{isset($package->smtps_limit) ? $package->smtps_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row" data-name="lwdUonqi">
                                                                    <div class="col-md-6" data-name="niFncByc">
                                                                        <label class="col-form-label">{{trans('users.create_pacage_blade.label_max_segments')}}
                                                                           
                                                                        </label>
                                                                        <div class="input-icon right" data-name="KRXpHXBP">
                                                                            <input type="text" name="segments_limit" value="{{isset($package->segments_limit) ? $package->segments_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                    <div class="col-md-6" data-name="FIGJsbGo">
                                                                        <label class="col-form-label">{{trans('users.create_pacage_blade.label_max_triggers')}}
                                                                           
                                                                        </label>
                                                                        <div class="input-icon right" data-name="TlCSMXuX">
                                                                            <input type="text" name="triggers_limit" value="{{isset($package->triggers_limit) ? $package->triggers_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                </div>



                                                                <div class="form-group row" data-name="lwdUonqi">
                                                                    <div class="col-md-6" data-name="niFncByc">
                                                                        <label class="col-form-label">{{trans('users.create_pacage_blade.label_trigger_actions_limit')}}
                                                                        {!! popover('','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="KRXpHXBP">
                                                                            <input type="text" name="trigger_actions" value="{{isset($package->trigger_actions) ? $package->trigger_actions : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                    <?php 
                                                                        $evergreenAddon = addon_license_status("Evergreen Campaigns");
                                                                        if($evergreenAddon == "Active") { 
                                                                    ?>
                                                                    <div class="col-md-6" data-name="niFncByc">
                                                                        <label class="col-form-label">{{trans('users.create_pacage_blade.label_max_evergreen_campaigns')}}
                                                                        {!! popover('','users.create_pacage_blade.popover_max_evergreen_add') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="KRXpHXBP">
                                                                            <input type="text" name="evergreen_campaigns" value="{{isset($package->evergreen_campaigns) ? $package->evergreen_campaigns : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                    <?php } ?>
                                                                    
                                                                </div>


                                                               

                                                                <!-- <div class="form-group row" data-name="lwdUonqi">
                                                                    <div class="col-md-6" data-name="niFncByc">
                                                                        <label class="col-form-label">{{trans('Suppress domains limit')}}
                                                                        {!! popover('','') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="KRXpHXBP">
                                                                            <input type="text" name="suppress_domains_limit" value="{{isset($package->suppress_domains_limit) ? $package->suppress_domains_limit : '' }}" class="form-control"/>
                                                                        </div>
                                                                        <small>{{trans('common.minus_1_for_unlimited')}}</small>
                                                                    </div>
                                                                    
                                                                    
                                                                </div> -->



                                                              


                                                            <?php 
                                                            
                                                            $update_existing_users_setting = !empty($package->update_existing_users_setting) ? "" :  ""; 
                                                            $allow_overuse =  !empty($package->allow_overuse) ? "checked" :  ""; 
                                                            $allow_branding =  !empty($package->allow_branding) ? "checked" :  ""; 
                                                            $credits_enable =  !empty($package->credits_enabled) ? "checked" :  ""; 
                                                            
                                                            if(!empty($license_type) and $license_type == "Commercial ESP") { ?>

                                                                 <div class="form-group row" data-name="ZoGfLBsP">   
                                                                     <div class="col-md-6 allow-switch" data-name="RNsUoLTW">
                                                                        <label class="col-form-label pl12" >

                                                                            {{ trans("suppression.suppress_package_limit_title") }}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input  type="checkbox" @if(!empty($package) and $package->suppress_domains_limit  != "") checked  @else   @endif  type="checkbox" name="allow_suppress_domains_limit"  id="allow_suppress_domains_limit" >
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div data-name="AQjUPmFfb" class="col-md-6" id="monthly_blk" @if(!empty($package) and $package->suppress_domains_limit  != "")  @else style="display:none;"  @endif>
                                                                            <input type="text" @if(!empty($package)) value="{{$package->suppress_domains_limit}}" @endif class="form-control user-input-val" name="suppress_domains_limit" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                     <div class="col-md-6 allow-switch" data-name="RNsUoLTW">
                                                                        <label class="col-form-label pl12" >

                                                                            {{ trans("common.bounce_rate_limit_in_package") }}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input  type="checkbox" @if(!empty($package) and $package->bounce_rate_limit > 0) checked  @else   @endif  type="checkbox" name="bounce_rate_limitBtn"  id="bounce_rate_limitBtn" >
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div data-name="AQjUPmFfb" class="col-md-6" id="bounce_rate_limitCheck" @if(!empty($package) and $package->bounce_rate_limit  > 0)  @else style="display:none;"  @endif>
                                                                            <input type="text" @if(!empty($package)) value="{{$package->bounce_rate_limit}}" @endif class="form-control user-input-val" name="bounce_rate_limit" placeholder="Value">
                                                                        </div>
                                                                    </div>

                                                                    
                                                                </div>
                                                                


                                                                  <div class="form-group row" data-name="ZoGfLBsP">   
                                                                     <div class="col-md-12 allow-switch" data-name="RNsUoLTW">
                                                                        <label class="col-form-label pl12" for="credits_enable">
                                                                            {{trans('users.create_pacage_blade.label_credit_enable')}}
                                                                            {!! popover('users.create_pacage_blade.popover_check_credit','common.description') !!}
                                                                        </label>
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input {{$credits_enable}} type="checkbox" id="credits_enable" name="credits_enable">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row" data-name="ZrdodJnn">   
                                                                     <div class="col-md-12 allow-switch" data-name="KnmqrQmQ">
                                                                        <label class="col-form-label pl12" for="allow_overuse">
                                                                            {{trans('users.create_pacage_blade.label_allow_overuse')}} 
                                                                            {!! popover('users.create_pacage_blade.popover_allow_email_overuse','common.description') !!}
                                                                        </label>
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input {{$allow_overuse}} type="checkbox" id="allow_overuse" name="allow_overuse">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row" data-name="ZrdodJnn">   
                                                                    <div class="col-md-12 allow-switch" data-name="KnmqrQmQ">
                                                                       <label class="col-form-label pl12" for="allow_branding">
                                                                           {{trans('Allow Branding')}} 
                                                                           {!! popover('Allow Branding','common.description') !!}
                                                                       </label>
                                                                           <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                               <label>
                                                                                   <input {{$allow_branding}} type="checkbox" id="allow_branding" name="allow_branding">
                                                                                   <span></span>
                                                                               </label>
                                                                           </span>
                                                                   </div>
                                                               </div>
                                                         

                                                          
                                                                <?php } ?>


                                                             

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="kt-wizard-v4__content steps2" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="WCkPCBRc">
                                                        <div class="kt-form__section kt-form__section--first" data-name="xZYlGRth">
                                                            <div class="kt-wizard-v4__form" data-name="OJaLnPbA">

                                                                <div id="kt_repeater_3" data-name="tEsXGiuU">
                                                                    <h5 class="col-md-12">{{trans('users.create_pacage_blade.additional_header_heading')}}</h5>
                                                                    <div class="form-group row mb0" data-name="TaUpyJdg">
                                                                        <div class="col-md-12" data-repeater-list="additonal_headers" data-name="KaEAPCqK">
                                                                            <div class="mt-repeater-item" data-name="yDqWPmnK">
                                                                                @if(!empty($additional_headers))
                                                                                @php $i = 0; @endphp
                                                                                    @foreach($additional_headers as $header)
                                                                                    @php $i++; @endphp
                                                                                    <div data-repeater-item="" class="mt-repeater-item" data-name="aHGzvTuy">
                                                                                        <div class="row mt-repeater-row" data-name="PWllOxIU">
                                                                                            <div class="col-md-6" data-name="gDzlhWVW">
                                                                                                <input type="text" name="additonal_headers[{{$i}}]['header']" placeholder="Header" class="form-control" value="{{ isset($header['header']) ? $header['header'] : '' }}">
                                                                                                <span class="clnfld">:</span>
                                                                                            </div>
                                                                                            <div class="col-md-5" data-name="uHaIPfuB">
                                                                                                <input type="text" name="additonal_headers[{{$i}}]['value']" placeholder="Value" class="form-control" value="{{ isset($header['value']) ? $header['value'] : '' }}">
                                                                                            </div>
                                                                                            <div class="col-md-1" data-name="KPbhBmwI">
                                                                                                <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                            @else
                                                                            <div class="mt-repeater-item" data-name="cFxFpArF">
                                                                                <div data-repeater-item="" class="mt-repeater-item" data-name="amrzxAgL">
                                                                                    <div class="row mt-repeater-row" data-name="WqZnmxor">
                                                                                        <div class="col-md-6" data-name="GWXliOMu">
                                                                                            <input type="text" name="header" placeholder="Header" class="form-control" value="">
                                                                                            <span class="clnfld">:</span>
                                                                                        </div>
                                                                                        <div class="col-md-5" data-name="DujDUrKG">
                                                                                            <input type="text" name="value" placeholder="Value" class="form-control" value="">
                                                                                        </div>
                                                                                        <div class="col-md-1" data-name="tBfTazUE">
                                                                                            <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            @endif
                                                                        </div> 
                                                                    </div>
                                                                    <div class="" id="btn-new" data-name="hXEIygiY">
                                                                        <div class="col-lg-2" data-name="RrJuqmYf"></div>
                                                                        <div class="col" data-name="OmPuUwlz">
                                                                            <div data-repeater-create="" class="btn btn btn-info btn-sm" data-name="EDHqramV">
                                                                                <span>
                                                                                    <i class="la la-plus"></i>
                                                                                    <span>{{ trans('common.form.buttons.add_new') }}</span>
                                                                                </span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <hr />

                                                                <div class="form-group row assign-assetsBlk" data-name="LOJyngSs">
                                                                    <?php
                                                                        $smtp_ids = !empty($package->smtp_ids) ? json_decode($package->smtp_ids, true) : array(); 
                                                                        $group_ids = !empty($package->smtp_groups) ? json_decode($package->smtp_groups, true) : array(); 
                                                                        $sending_options = !empty($package->sending_options) ? json_decode($package->sending_options, true) : array(); 
                                                                        $bounce_emails = !empty($package->bounce_emails) ? json_decode($package->bounce_emails, true) : array(); 
                                                                        $sending_domains_array = !empty($package->sending_domains) ? json_decode($package->sending_domains, true) : array(); 
                                                                       
                                                                        $sending_node = "checked"; 
                                                                        $form_list = "checked"; 
                                                                        $custom = "checked";
                                                                        if(!empty($sending_options) and empty($sending_options["sending_node"])) { 
                                                                            $sending_node = "";
                                                                        }
                                                                        if(!empty($sending_options) and empty($sending_options["form_list"])) { 
                                                                            $form_list = "";
                                                                        }
                                                                        if(!empty($sending_options) and empty($sending_options["custom"])) { 
                                                                            $custom = "";
                                                                        }

                                                                        
                                                                    ?>
                                                                    <h5 class="col-md-12">{{ trans('users.packages.pre_build_assets') }}</h5>
                                                                    <div class="col-md-12 row" data-name="TSfxWGau">
                                                                        <label class="col-form-label pl12" for="sending_nodes">
                                                                            {{ trans('users.packages.sending_nodes') }}
                                                                        </label>
                                                                        <div class="col-md-4" data-name="YnnrvQHg">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input @if(!empty($smtp_ids) or !empty( $group_ids)) checked @endif type="checkbox" id="sending_nodes" name="sending_nodes">
                                                                                    <input  type="hidden" @if(!empty($smtp_ids) or !empty( $group_ids)) value="yes" @else @endif id ="sending_node" name="sending_node">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6" id="showSMTPType" @if(!empty($smtp_ids) or !empty( $group_ids)) @else style="display:none" @endif data-name="xFsIKfUq">
                                                                        <label class="col-form-label"> 
                                                                        {{ trans('users.packages.select_type') }}
                                                                        </label>
                                                                        <div class="form-group" data-name="iTcAhprc">
                                                                            <div class="input-icon right" data-name="PCXjoxYC">
                                                                                <select class="form-control" name="smtp_type" id="smtp_type" >
                                                                                    <option @if(isset($package->smtp_type) and $package->smtp_type =="group") selected @endif value="group">Groups</option>
                                                                                    <option  @if(isset($package->smtp_type) and $package->smtp_type =="smtp") selected @endif  value="smtp">SMTPs</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6" id="showSMTPs" @if(!empty($smtp_ids)) @else style="display:none" @endif data-name="WxbhCTbz">
                                                                        <label class="col-form-label"> 
                                                                            {{ trans('users.packages.select_nodes') }}
                                                                        </label>
                                                                        <div class="form-group" data-name="ZBsmgaGG">
                                                                            <div class="input-icon right" data-name="kueLJgUC">
                                                                                
                                                                                <select class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300" name="smtp_ids[]">
                                                                                    @foreach($adminSMTPs as $smtp)
                                                                                    <option @if(!empty( $smtp_ids) and in_array($smtp->smtp_id, $smtp_ids)) selected @endif value="{{$smtp->smtp_id}}">{{$smtp->smtp_name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div data-name="qOsCndAT" class="col-md-6" id="showGroups" @if(!empty($group_ids)> 0)  @else style="display:none" @endif>
                                                                        <label class="col-form-label"> 
                                                                        {{ trans('users.packages.select_group') }}
                                                                        </label>
                                                                        <div class="form-group" data-name="yqkEVjWp">
                                                                            <div class="input-icon right" data-name="ylYvIuGV">
                                                                                <select class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300" name="smtp_groups[]">
                                                                                    @foreach($adminGroups as $group)
                                                                                    <option @if(!empty( $group_ids) and in_array($group->id, $group_ids)) selected @endif value="{{$group->id}}">{{$group->name}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 row" data-name="ZUrDpDgO">
                                                                        <label class="col-form-label pl12" for="bounce_addresses">
                                                                            {{trans('users.create_pacage_blade.label_bounce_addresses')}} 
                                                                        </label>
                                                                        <div class="col-md-4" data-name="NdLJOyPi">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input type="checkbox" @if(!empty($bounce_emails)) checked @endif id="bounce_addresses" name="bounce_addresses">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6" data-name="AbeEimrb">
                                                                        <div class="form-group" id="showBounceAddresses" @if(!empty($bounce_emails)) @else style="display:none;" @endif data-name="scaABfiH">
                                                                            <label class="col-form-label"> 
                                                                                {{trans('users.create_pacage_blade.label_select_bounce_address')}}
                                                                            </label>
                                                                            <div class="input-icon right" data-name="uGVinYaQ">
                                                                                <select class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" data-select-all="true" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300" name="bounces[]">
                                                                                @foreach($bounceEmails as $bemail)
                                                                                    <option  @if(!empty( $bounce_emails) and in_array($bemail->id, $bounce_emails)) selected @endif value="{{$bemail->id}}">{{$bemail->name}}</option>
                                                                                @endforeach
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-12 row" data-name="TPWPaFPz">
                                                                        <label class="col-form-label pl12">
                                                                            {{trans('users.create_pacage_blade.label_sending_domains')}}
                                                                        </label>
                                                                        <div class="col-md-4" data-name="AGpozuhT">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input type="checkbox" @if(!empty($sending_domains_array)) checked @endif id="sending_domains" name="sending_domains">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <?php 
                                                                    $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); 
                                                                    ?>
                                                                    <div class="col-md-6" data-name="GiQpkPCl">
                                                                        <div class="form-group" id="showDomains" @if(!empty($sending_domains_array)) @else style="display:none;" @endif data-name="nvHZajAW">
                                                                            <label class="col-form-label"> 
                                                                                  {{trans('users.create_pacage_blade.label_select_sending_domains')}}
                                                                            </label>
                                                                            <div class="input-icon right" data-name="pDdprNWg">
                                                                                <select class="mt-multiselect btn btn-default form-control" multiple="multiple" data-label="left" data-select-all="false" data-width="100%" data-filter="true" data-action-onchange="true" data-height="300" name="domains[]">
                                                                                <optgroup label="Eligible Domains">
                                                                                @foreach($sendingDomains as $bdomain)
                                                                                    <?php 
                                                                                    
                                                                                        $domainStatus = \App\Lists::getListDomainStatus($bdomain->id);
                                                                                        $disabled = "";
                                                                                        if(!$domainStatus and $license_type == "Commercial ESP" and $unauth_sending_domain == "on") { 
                                                                                            $disabled = "disabled";
                                                                                        } else { ?>
                                                                                            <option  @if(!empty($sending_domains_array) and in_array($bdomain->id, $sending_domains_array)) selected @endif value="{{$bdomain->id}}">{{$bdomain->domain}}</option>
                                                                                        <?php }
                                                                                    ?>
                                                                                @endforeach
                                                                                </optgroup>
                                                                                <optgroup label="Ineligible Domains">
                                                                                @foreach($sendingDomains as $bdomain)
                                                                                    <?php 
                                                                                        $domainStatus = \App\Lists::getListDomainStatus($bdomain->id);
                                                                                        $disabled = "";
                                                                                        if(!$domainStatus and $license_type == "Commercial ESP" and $unauth_sending_domain == "on") { 
                                                                                            $disabled = "disabled";
                                                                                            ?>
                                                                                            <option disabled  @if(!empty($sending_domains_array) and in_array($bdomain->id, $sending_domains_array)) selected @endif value="{{$bdomain->id}}">{{$bdomain->domain}}</option>
                                                                                        <?php }
                                                                                    ?>
                                                                                @endforeach
                                                                                </optgroup>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                </div>

                                                                <hr />

                                                                <div class="form-group row miscellaneous" data-name="UkfgIszx">
                                                                    <h5  class="col-md-12">{{ trans('users.packages.miscellaneous') }}</h5>
                                                                    <div class="col-md-12 row" data-name="ezlPtVOx">
                                                                        <label class="col-form-label pl12" for="sender_info_nodes">
                                                                            {{ trans('users.packages.sending_nodes_allow') }}
                                                                        </label>
                                                                        <div class="col-md-4" data-name="AeHEParn">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input {{$sending_node}} type="checkbox" id="sender_info_nodes" name="sender_info_nodes">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 row" data-name="aTCRNuxl">
                                                                        <label class="col-form-label pl12" for="sender_info_list">
                                                                            {{ trans('users.packages.sending_list_allow') }}
                                                                        </label>
                                                                        <div class="col-md-4" data-name="ZZvYvsjV">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input {{$form_list}} type="checkbox" id="sender_info_list" name="sender_info_list">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 row" data-name="esxeJKGe">
                                                                        <label class="col-form-label pl12" for="sender_info_option">
                                                                            {{ trans('users.packages.custom_allow') }}
                                                                        </label>
                                                                        <div class="col-md-4" data-name="thYFLQIt">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input {{$custom}} type="checkbox" id="sender_info_option" name="sender_info_option">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12 row" data-name="esxeJKGe">
                                                                             <label class="col-form-label pl12" for="sender_info_option">
                                                                                {{ trans('users.threads') }}
                                                                            </label>
                                                                            <div data-name="AQjUPmFb" class="col-md-6" id="max_threads">
                                                                                <input type="text" value="{{!empty($package->max_threads) ? $package->max_threads : '' }}" class="form-control user-input-val" name="max_threads" placeholder="Threads">
                                                                            </div>
                                                                    </div>
                                                                    

                                                                </div>


                                                                <hr />

                                                                
                                                                <?php 
                                                                    if(!empty($license_type) and $license_type == "Commercial ESP") { 
                                                                    $dkim_restriction = "";
                                                                    $tracking_restriction = "";
                                                                    $bounce_restriction = "";
                                                                    $tracking_restrictions = !empty($package->tracking_restrictions) ? json_decode($package->tracking_restrictions , true) : [];
                                                                    if(!empty($tracking_restrictions["dkim_restriction"]) AND  $tracking_restrictions["dkim_restriction"] == "on") { 
                                                                        $dkim_restriction = "checked";
                                                                    }
                                                                    if(!empty($tracking_restrictions["tracking_restriction"]) AND  $tracking_restrictions["tracking_restriction"] == "on") { 
                                                                        $tracking_restriction = "checked";
                                                                    }
                                                                    if(!empty($tracking_restrictions["bounce_restriction"]) AND  $tracking_restrictions["bounce_restriction"] == "on") { 
                                                                        $bounce_restriction = "checked";
                                                                    }
                                                                ?>

                                                                <div class="form-group row restrictions" data-name="UkfgIszx">
                                                                    <h5  class="col-md-12">{{ trans('users.packages.restrictions.title') }}</h5>
                                                                    <div class="col-md-12 row" data-name="ezlPtVOx">
                                                                        <label class="col-form-label pl12" for="dkim_restriction">
                                                                            {{ trans('users.packages.restrictions.dkim') }}
                                                                        </label>
                                                                        <div class="col-md-4" data-name="AeHEParn">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input {{$dkim_restriction}} type="checkbox" id="dkim_restriction" name="dkim_restriction">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 row" data-name="aTCRNuxl">
                                                                        <label class="col-form-label pl12" for="tracking_restriction">
                                                                            {{ trans('users.packages.restrictions.tracking') }}
                                                                        </label>
                                                                        <div class="col-md-4" data-name="ZZvYvsjV">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input {{$tracking_restriction}} type="checkbox" id="tracking_restriction" name="tracking_restriction">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12 row" data-name="esxeJKGe">
                                                                        <label class="col-form-label pl12" for="bounce_restriction">
                                                                            {{ trans('users.packages.restrictions.bounce') }}
                                                                        </label>
                                                                        <div class="col-md-4" data-name="thYFLQIt">
                                                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch">
                                                                                <label>
                                                                                    <input {{$bounce_restriction}} type="checkbox" id="bounce_restriction" name="bounce_restriction">
                                                                                    <span></span>
                                                                                </label>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    

                                                                </div>

                                                                <?php } ?>


                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-form__actions" data-name="bciFrRhk">
                                            <div class="btn btn-secondary btn-md" data-ktwizard-type="action-prev" data-name="YUFUJBfh">
                                                {{trans('common.form.buttons.back')}}
                                            </div>
                                            <div class="btn btn-success btn-md" data-ktwizard-type="action-submit" data-name="tKhNdncR">
                                                {{trans('common.form.buttons.submit')}}
                                            </div>
                                            <div class="btn btn-brand btn-md" data-ktwizard-type="action-next" data-name="qJeFDasQ">
                                                {{trans('common.form.buttons.continue')}}
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
<!-- END FORM-->
@endsection