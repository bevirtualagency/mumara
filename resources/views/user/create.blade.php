@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/client-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/clients.js?t={{time()}}" type="text/javascript"></script>
<script src="/themes/default/js/includes/clientWizard.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/validate-form-client.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/passtrength.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){

        $("#sender_info_list_hour").click(function() {
            if($(this).is(":checked")){
                $("#hour_blk").hide();
            } else {
                $("#hour_blk").show();
            }
        });

        $("#sender_info_list_daily").click(function() {
            if($(this).is(":checked")){
                $("#daily_blk").hide();
            } else {
                $("#daily_blk").show();
            }
        });

        $("#sender_info_option_monthy").click(function() {
            if($(this).is(":checked")){
                $("#monthly_blk").hide();
            } else {
                $("#monthly_blk").show();
            }
        });
        $("#sender_info_option_trigger").click(function() {
            if($(this).is(":checked")){
                $("#trigger_blk").hide();
            } else {
                $("#trigger_blk").show();
            }
        });
        $("#suppress_domains_limit_info").click(function() {
            if($(this).is(":checked")){
                $("#suppress_blk").hide();
            } else {
                $("#suppress_blk").show();
            }
        });
        $("#user_contacts_limit_info").click(function() {
            if($(this).is(":checked")){
                $("#contacts_blk").hide();
            } else {
                $("#contacts_blk").show();
            }
        });

        $('#password').passtrength({
          minChars: 6,
          passwordToggle: true,
          tooltip: true
        });
        $(".m-select2").select2({
            placeholder: '@lang("common.label.select_option")'
        });
    });
    var form_error="{{trans('common.message.form_error')}}";
</script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="UnykjrMG">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="ehsTwcjd">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="OmeymoEd">
    <span id='msg-text'><span>
</div>
@if($packages->count()<=0)
<div class="col-md-12" data-name="upleLjiu">
    <div class="note prDomain" data-name="jjEvNAVx">
        <p>
           {{trans('users.create_blade.create_package_para')}}
            <a href="{{ route('client.package.view') }}" class="btn btn-warning btn-sm">{{trans('users.sub_user_controller.create_pacage_title')}} </a>
        </p>
    </div>
</div>
@else
<!-- BEGIN FORM-->
<div class="row" data-name="PvBtaRZW">
    <div class="col-md-6 create-form" data-name="XllHgfCH">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="munREMuN">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="nenoWBsA">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="yazgkuxq">
                    <div class="kt-wizard-v4__nav-items" data-name="vHcsvmIW">
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="vKGLyfUn">
                                <div class="kt-wizard-v4__nav-number" data-name="RHwVyunM">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="CRZzUErp">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="IowEkBYa">
                                        {{ trans('users.add_new.step1.heading') }}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="obBbOnoE">
                                        {{ trans('users.add_new.step1.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="bxOATRoX">
                                <div class="kt-wizard-v4__nav-number" data-name="enmnTuzJ">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="LJSeHlmk">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="iLsPHGer">
                                       {{ trans('users.add_new.step2.heading') }}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="HsUzdteh">
                                        {{ trans('users.add_new.step2.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 

                <div class="kt-portlet form" data-name="VubSAwtS">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="JSmfUbCl">
                        <div class="kt-grid" data-name="IpGeveBY">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="FTgZSSOx">

                                @if ($page_data['action'] == 'add')
                                <form action="{{ route('user.store') }}" method="POST" id="user-frm" class="kt-form kt-form--label-right">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="action" value="add">
                                @else 
                                <form action="{{ route('user.update', $user->id) }}" method="POST" id="user-frm" class="kt-form kt-form--label-right">
                                    <input type="hidden" id="action" value="edit">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="user-id" value="{{$user->id}}">
                                    <!-- <input type="hidden" name="_method" value="POST"> -->
                                @endif
                                    <div class="form-wizard" id="form_wizard_1" data-name="QQZPkWYA">
                                        <div class="form-body" data-name="VXljERZQ">
                                            <div class="form-wizard" id="form_wizard_1" data-name="SnbKnYsp">

                                                <div class="tab-content" data-name="HORXObri">

                                                    <div class="alert alert-danger display-none" data-name="DqWUrHYY">
                                                        <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} 
                                                    </div>
                                                    <div class="alert alert-success display-none" data-name="TOPQAEdW">
                                                        <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} 
                                                    </div>

                                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="rFDMBtBl">
                                                        <div class="kt-form__section kt-form__section--first" data-name="yxeojEJZ">
                                                            <div class="kt-wizard-v4__form" data-name="ZyWacoRW">

                                                                <div class="form-group row" data-name="bnxejYlO">
                                                                        
                                                                    <div class="col-md-6" data-name="iUcPamuZ">
                                                                        <label class="col-form-label">{{trans('users.add_new.step1.form.name')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('users.add_new.step1.form.name_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="rfyTdYvB">
                                                                            <input id="name" type="text" name="name" value="{{isset($user->name) ? $user->name : '' }}" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6" data-name="zDExIdNM">
                                                                        <label class="col-form-label">{{trans('users.add_new.step1.form.email')}}
                                                                            <span class="required"> * </span>
                                                                            {!! popover('users.add_new.step1.form.email_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="CuQiNBaq">
                                                                            <input type="text" id="email" name="email" value="{{isset($user->email) ? $user->email : '' }}" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row" data-name="PjDKPadW">
                                                                        
                                                                    <div class="col-md-12" data-name="duRsMJrX">
                                                                        <label class="col-form-label">
                                                                            {{trans('users.add_new.step1.form.allowed_ips')}}
                                                                            <span class="required"></span>
                                                                            {!! popover('users.add_new.step1.form.allowed_ips_help','common.description') !!}
                                                                        </label>
                                                                        <textarea id="login_ips" rows="5" class="form-control textarea" name="login_ips" placeholder="192.168.0.1\n192.168.0.1" >{{isset($user) && isset($user->login_ips)?str_replace(",","\r\n",$user->login_ips):''}}</textarea>
                                                                    </div>
                                                                </div>
                                                                <script>
                                                                var textAreas = document.getElementsByClassName('textarea');
                                                                Array.prototype.forEach.call(textAreas, function(elem) {
                                                                    elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
                                                                });
                                                                </script>
                                                                <div class="form-group row" data-name="UaxYyiRd">
                                                                        
                                                                    <div class="col-md-6" data-name="SFCTHRjk">
                                                                        <label class="col-form-label">{{trans('users.add_new.step1.form.password')}}
                                                                        @if ($page_data['action'] == 'add')<span class="required"> * </span> @else @endif
                                                                            {!! popover('users.add_new.step1.form.password_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="VpwCFSbt">
                                                                            <input type="password" name="password" id="password" value="" class="form-control" /> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6" data-name="AbnXnjYr">
                                                                        <label class="col-form-label">{{trans('users.add_new.step1.form.confirm_password')}}
                                                                        @if ($page_data['action'] == 'add')<span class="required"> * </span> @else @endif
                                                                            {!! popover('users.add_new.step1.form.confirm_password_help','common.description') !!}
                                                                        </label>
                                                                        <div class="input-icon right" data-name="IXwIOpzW">
                                                                            <input type="password" name="confirm_password" value="" class="form-control" /> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="ThTnIihB">
                                                        <div class="kt-form__section kt-form__section--first" data-name="qatZGxVm">
                                                            <div class="kt-wizard-v4__form" id="users_optionsBlk" data-name="itfByXBU">

                                                                <div class="form-group row" data-name="SGpCfcZE">
                                                                    <div class="col-md-12" data-name="yHXYNhrZ">
                                                                        <label class="col-form-label">{{trans('users.add_new.step2.form.package')}}
                                                                            <span class="required"> * </span>
                                                                             {!! popover('users.add_new.step2.form.package_help','common.description') !!}
                                                                        </label>
                                                                        <select class="form-control m-select2" data-placeholder="Choose Package" name="package_id">
                                                                            @foreach($packages as $package)
                                                                                <option value="{{ $package->id }}" {{ (isset($user->package_id) && $user->package_id == $package->id) ? 'selected' : '' }}>{{ $package->package_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row" data-name="mUZVMyVw">
                                                                    <div class="col-md-12 row" data-name="SVRGuVrY">
                                                                        <label class="col-form-label pl12" for="sender_info_list_hour">
                                                                            {{trans('users.create_blade.inherit_hourly_rate_label')}}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input type="checkbox" @if(!empty($user_email_limits) and $user_email_limits->hourly_rate  > 0) @else checked  @endif  id="sender_info_list_hour" name="sender_info_list_hour">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div data-name="RzZQEtep" class="col-md-3" id="hour_blk" @if(!empty($user_email_limits) and $user_email_limits->hourly_rate  > 0)  style="display:block;" @else   @endif>
                                                                            <input type="text" @if(!empty($user_email_limits)) value="{{$user_email_limits->hourly_rate}}" @endif class="form-control user-input-val" name="sender_info_hour" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row" data-name="gXccsuYQ">
                                                                    <div class="col-md-12 row" data-name="aaDMxPmy">
                                                                        <label class="col-form-label pl12" for="sender_info_list_daily">
                                                                            {{trans('users.create_blade.inherit_daily_limit_label')}}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input @if(!empty($user_email_limits) and $user_email_limits->daily_limit  > 0) @else checked  @endif  type="checkbox"  id="sender_info_list_daily" name="sender_info_list_daily">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div data-name="jqMrThPG" class="col-md-3" id="daily_blk" @if(!empty($user_email_limits) and $user_email_limits->daily_limit > 0) style="display:block;" @else checked  @endif>
                                                                            <input type="text" @if(!empty($user_email_limits)) value="{{$user_email_limits->daily_limit}}" @endif class="form-control user-input-val" name="sender_info_daily" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="UiFVTFMG">
                                                                    <div class="col-md-12 row" data-name="atIAvfhT">
                                                                        <label class="col-form-label pl12" for="sender_info_option_monthy">
                                                                            {{trans('users.create_blade.inherit_monthly_limit_label')}}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input  type="checkbox" @if(!empty($user_email_limits) and $user_email_limits->monthly_limit  > 0) @else checked  @endif  type="checkbox"  id="sender_info_option_monthy" name="sender_info_option_monthy">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div data-name="AQjUPmFb" class="col-md-3" id="monthly_blk" @if(!empty($user_email_limits) and $user_email_limits->monthly_limit  > 0) style="display:block;" @else checked  @endif>
                                                                            <input type="text" @if(!empty($user_email_limits)) value="{{$user_email_limits->monthly_limit}}" @endif class="form-control user-input-val" name="sender_info_monthly" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                
                                                                <div class="form-group row" data-name="UiFVTFMG">
                                                                    <div class="col-md-12 row" data-name="atIAvfhT">
                                                                        <label class="col-form-label pl12" for="sender_info_option_trigger">
                                                                            {{trans('users.create_blade.inherit_triggers_limit_label')}}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input  type="checkbox" @if(!empty($user_email_limits) and $user_email_limits->trigger_actions_limit  > 0) @else checked  @endif  type="checkbox"  id="sender_info_option_trigger" name="sender_info_option_trigger">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div data-name="AQjUPmFb" class="col-md-3" id="trigger_blk" @if(!empty($user_email_limits) and $user_email_limits->trigger_actions_limit  > 0) style="display:block;" @else style="display:none;"  @endif>
                                                                            <input type="text" @if(!empty($user_email_limits)) value="{{$user_email_limits->trigger_actions_limit}}" @endif class="form-control user-input-val" name="sender_info_trigger" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                @if(!empty($license_type) && $license_type == "Commercial ESP")
                                                                <div class="form-group row" data-name="UiFVTFMGg">
                                                                    <div class="col-md-12 row" data-name="atIAvfhTt">
                                                                        <label class="col-form-label pl12" for="suppress_domains_limit_info">

                                                                            {{ trans("suppression.suppress_user_limit_title") }}

                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input  type="checkbox" @if(!empty($user_email_limits) and $user_email_limits->domain_suppression_limit  !="") @else checked  @endif  type="checkbox"  id="suppress_domains_limit_info" name="suppress_domains_limit_info">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div data-name="AQjUPmFb" class="col-md-3" id="suppress_blk" @if(!empty($user_email_limits) and $user_email_limits->domain_suppression_limit  !="") style="display:block;" @else style="display:none;"  @endif>
                                                                            <input type="text" @if(!empty($user_email_limits)) value="{{$user_email_limits->domain_suppression_limit}}" @endif class="form-control user-input-val" name="suppress_domains_limit" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row" data-name="UiFVTFMGg">
                                                                    <div class="col-md-12 row" data-name="atIAvfhTt">
                                                                        <label class="col-form-label pl12" for="user_contacts_limit_info">

                                                                            {{ trans("users.inherit_contacts_limit") }}

                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input  type="checkbox" @if(!empty($user_email_limits) and ($user_email_limits->contacts_limit  !="" || $user_email_limits->contacts_limit != NULL)) @else checked  @endif  type="checkbox"  id="user_contacts_limit_info" name="user_contacts_limit_info">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div data-name="AQjUPmFb" class="col-md-3" id="contacts_blk" @if(!empty($user_email_limits) and $user_email_limits->contacts_limit  !="") style="display:block;" @else style="display:none;"  @endif>
                                                                            <input type="text" @if(!empty($user_email_limits)) value="{{$user_email_limits->contacts_limit}}" @endif class="form-control user-input-val" name="user_contacts_limit" placeholder="Contacts">
                                                                        </div>
                                                                    </div>
                                                                </div>


                                                                <div class="form-group row" data-name="UiFVTFMGg">
                                                                    <div class="col-md-12 row" data-name="atIAvfhTt">
                                                                        <label class="col-form-label pl12" for="allow_branding">

                                                                            {{ trans("users.allow_user_branding") }}

                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input  type="checkbox" @if(!empty($user) and ($user->allow_branding)) checked @else   @endif  type="checkbox"  id="allow_branding" name="allow_branding">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        
                                                                    </div>
                                                                </div>


                                                                @endif
                                                                

                                                                <div class="form-group row" data-name="UiFVTFMG">
                                                                    <div class="col-md-12 row" data-name="atIAvfhT">
                                                                        <label class="col-form-label pl12" for="sender_info_option_monthy">
                                                                            {{ trans('users.threads') }}
                                                                        </label>
                                                                        <div data-name="AQjUPmFb" class="col-md-6" id="max_threads">
                                                                            <input type="text" value="{{isset($user->max_threads) ? $user->max_threads : '' }}" class="form-control user-input-val" name="max_threads" placeholder="Threads">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="kt-form__actions" data-name="lfguJRYH">
                                            <div class="btn btn-secondary btn-md" data-ktwizard-type="action-prev" data-name="NzUMbvxx">
                                                {{trans('common.form.buttons.back')}}
                                            </div>
                                            <div class="btn btn-success btn-md" data-ktwizard-type="action-submit" data-name="OaIcCyGh">
                                                {{trans('common.form.buttons.submit')}}
                                            </div>
                                            <div class="btn btn-brand btn-md" data-ktwizard-type="action-next" data-name="IAmhbKuw">
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
@endif
@endsection