@extends('layouts.master2')

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/wizard-v4.default.css" rel="stylesheet" type="text/css" />
<link href="/resources/assets/css/client-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script type="text/javascript" src="/public/js/passtrength.js"></script>
<script src="/themes/default/js/includes/clients.js" type="text/javascript"></script>
<script>
    $(document).ready(function(){
        $('#password').passtrength({
          minChars: 6,
          passwordToggle: true,
          tooltip: true
        });
        $(".m-select2").select2({
            placeholder: '@lang("common.label.select_option")',
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
    });
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/clientWizard.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/validate-form-client.js" type="text/javascript"></script>
    <script>
        $(document).ready(function () {
            $("#createUser").click(function (e) {
                btn_id = this.id;
                id = $("#id").val();
                method = "POST";
                route = '{{route('client.store')}}';

                if(id!==undefined && id>0)
                {
                    method = "PUT";
                    route = '{{route('client.update',"")}}'+'/'+id;
                }
                formId = "#user-frm";
                // console.log('I am clicked', route);
                createOrUpdate(method, route, formId, e, btn_id);
                return false;
            });
        });

    </script>
@endsection

@section('content')

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="NchECVnE">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="HaojvDXA">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="tHYMDFEu">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="row" data-name="TCKFjFjy">
    <div class="col-md-12" data-name="bYHjvROB">
        <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content" data-name="PXMdqIQC">
            <div class="kt-wizard-v4" id="kt_wizard_v4" data-ktwizard-state="step-first" data-name="zEhGiUVb">
                <!--begin: Form Wizard Nav -->
                <div class="kt-wizard-v4__nav" data-name="srCXUUUt">
                    <div class="kt-wizard-v4__nav-items" data-name="ZCZLWgSJ">
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step" data-ktwizard-state="current">
                            <div class="kt-wizard-v4__nav-body" data-name="EMOdEUXZ">
                                <div class="kt-wizard-v4__nav-number" data-name="KNzqSkYG">
                                    1
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="JFWDPVmP">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="TaypKTBt">
                                       {{ trans('users.add_new.step1.heading') }}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="iPYRxsXv">
                                        {{ trans('users.add_new.step1.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a class="kt-wizard-v4__nav-item" href="#" data-ktwizard-type="step">
                            <div class="kt-wizard-v4__nav-body" data-name="yDwEBjCA">
                                <div class="kt-wizard-v4__nav-number" data-name="NQTOQxpf">
                                    2
                                </div>
                                <div class="kt-wizard-v4__nav-label" data-name="YudOZkES">
                                    <div class="kt-wizard-v4__nav-label-title" data-name="nqjCixFe">
                                       {{ trans('users.add_new.step2.heading') }}
                                    </div>
                                    <div class="kt-wizard-v4__nav-label-desc" data-name="exgeRrTW">
                                        {{ trans('users.add_new.step2.desc') }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div> 

                <div class="kt-portlet form" data-name="dKeibDAY">
                    <div class="kt-portlet__body kt-portlet__body--fit" data-name="hHzdcKTp">
                        <div class="kt-grid" data-name="KDTGpcKf">
                            <div class="kt-grid__item kt-grid__item--fluid kt-wizard-v4__wrapper" data-name="RcSfVudJ">


                                <form  id="user-frm" class="kt-form kt-form--label-right" novalidate="novalidate">
                                    @if ($page_data['action'] == 'add')
                                    <input type="hidden" id="action" value="add">
                                    @else
                                    <input type="hidden" id="action" value="edit">
                                    @endif
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="id" value="{{isset($user) ? $user->id:'0'}}">


                                    
                                    <div class="form-wizard" id="form_wizard_1" data-name="GoGNxYoY">
                                        <div class="form-body" data-name="PpAnWvuP">
                                            <div class="form-wizard" id="form_wizard_1" data-name="vVFTBaPr">

                                                <div class="tab-content" data-name="YbgxyTeQ">
                                                    <div class="alert alert-danger display-none" data-name="ZzMwhQjH">
                                                        <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_error')}} 
                                                    </div>
                                                    <div class="alert alert-success display-none" data-name="AHqtKSDM">
                                                        <button class="close" data-dismiss="alert"></button> {{trans('common.message.form_success')}} 
                                                    </div>

                                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="iETAiZDM">
                                                        <div class="kt-form__section kt-form__section--first" data-name="SHrfRbNt">
                                                            <div class="kt-wizard-v4__form" data-name="kLuFxrtH">

                                                                <div class="form-group row" data-name="TRxoGtgw">
                                                                    <label class="col-form-label col-md-2"> {{trans('users.add_new.step1.form.name')}}
                                                                        <span class="required"> * </span>

                                                                    {!! popover('users.add_new.step1.form.name_help','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="qpzgLQGM">
                                                                        <div class="input-icon right" data-name="elMbbjgq">
                                                                            
                                                                            <input type="text" name="name" value="{{isset($user->name) ? $user->name : '' }}" class="form-control" /> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="nMriBOrj">
                                                                    <label class="col-form-label col-md-2">{{trans('users.add_new.step1.form.email')}}
                                                                        <span class="required"> * </span>
                                                                        {!! popover('users.add_new.step1.form.email_help','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="udYThSiC">
                                                                        <div class="input-icon right" data-name="QjSuFCvR">
                                                                            
                                                                            <input type="email" name="email" value="{{isset($user->email) ? $user->email : '' }}" class="form-control" /> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                                      <div class="form-group row" data-name="evCyhGyc">
                                                        <label class="col-form-label col-md-2">
                                                             {{trans('users.add_new.step1.form.allowed_ips')}}
                                                            <span class="required"> * </span>
                                                            {!! popover('users.add_new.step1.form.allowed_ips_help','common.description') !!}
                                                        </label>
                                                        <div class="col-md-8" data-name="aLyHlQsr">
                                                           <textarea rows="5" class="form-control textarea" name="login_ips" placeholder="192.168.0.1\n192.168.0.1" >{{isset($user) && isset($user->login_ips)?str_replace(",","\r\n",$user->login_ips):''}}</textarea>
                                                           <div id="login_ips-error" class="error invalid-feedback" data-name="xSVJSeIK"></div>
                                                       		             <!--  <small>Write the IP addresses from where your account can be accessed. one IP per line</small> -->
                                                        </div>
                                          
                                                        
                                                    </div>
                                                    <script>
                                                    var textAreas = document.getElementsByClassName('textarea');
                                                    Array.prototype.forEach.call(textAreas, function(elem) {
                                                        elem.placeholder = elem.placeholder.replace(/\\n/g, '\n');
                                                    });
                                                    </script>
                                                                <div class="form-group row" data-name="sDaUVmxu">
                                                                     <label class="col-form-label col-md-2">{{trans('users.add_new.step1.form.password')}}
                                                                        @if ($page_data['action'] == 'add')<span class="required"> * </span> @else @endif
                                                                            {!! popover('users.add_new.step1.form.password_help','common.description') !!}
                                                                        </label>
                                                                    <div class="col-md-8" data-name="ZFwOGkFG">
                                                                        <div class="input-icon right" data-name="TpJDEqXn">
                                                                            
                                                                            <input type="password" name="password" id="password" value="" class="form-control" /> 
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="AUvtSgeO">
                                                                   <label class="col-form-label col-md-2">{{trans('users.add_new.step1.form.confirm_password')}}
                                                                        @if ($page_data['action'] == 'add')<span class="required"> * </span> @else @endif
                                                                            {!! popover('users.add_new.step1.form.confirm_password_help','common.description') !!}
                                                                        </label>
                                                                    <div class="col-md-8" data-name="esFDDSWF">
                                                                        <div class="input-icon right" data-name="pdguGApY">
                                                                            <input type="password" name="password_confirmation" value="" class="form-control" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="jlpyfGdS">
                                                        <div class="kt-form__section kt-form__section--first" data-name="bWfizXAw">
                                                            <div class="kt-wizard-v4__form" data-name="fSpkbtcU">

                                                                <div class="form-group row" data-name="fOoCUNzd">
                                                                    <label class="col-form-label col-md-2">{{trans('users.add_new.step2.form.package')}}
                                                                        <span class="required"> * </span>
                                                                         {!! popover('users.add_new.step2.form.package_help','common.description') !!}
                                                                    </label>
                                                                    <div class="col-md-8" data-name="VYJoJuXp">
                                                                        <select class="form-control m-select2" data-placeholder="Choose Package" name="package_id" id="package_id">
                                                                            @foreach($packages as $package)
                                                                                <option value="{{ $package->id }}" {{ (isset($user->package_id) && $user->package_id == $package->id) ? 'selected' : '' }}>{{ $package->package_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="kt-form__actions" data-name="zFwvssMs">
                                            <div class="btn btn-secondary btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-prev" data-name="pVvzOewo">
                                                {{trans('common.form.buttons.back')}}
                                            </div>
                                            <div class="btn btn-success btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" id="createUser" data-name="jToPdqnB">
                                                {{trans('common.form.buttons.submit')}}
                                            </div>
                                            <div class="btn btn-brand btn-md btn-tall btn-wide kt-font-bold kt-font-transform-u" data-ktwizard-type="action-next" data-name="YhXYBUAL">
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