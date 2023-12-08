@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/staff-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";

    $(document).ready(function() {
        $('.m-select2').select2({
            placeholder: "Select Admin Role"
        });
    });    
</script>

<script>
    $(document).ready(function(){
        @if(!empty($user_email_limit) and $user_email_limit->hourly_rate > 0) 
        $("#hour_blk").show();
        @else  
        $("#hour_blk").hide();
        @endif
        @if(!empty($user_email_limit) and $user_email_limit->daily_limit > 0) 
        $("#daily_blk").show();
        @else  
        $("#daily_blk").hide();
        @endif
        @if(!empty($user_email_limit) and $user_email_limit->monthly_limit > 0) 
        $("#monthly_blk").show();
        @else  
        $("#monthly_blk").hide();
        @endif
  
        $("#sender_info_list_hour").click(function() {
            if($(this).is(":checked")){
                $("#hour_blk").show();
            } else {
                $("#hour_blk").hide();
            }
        });

        $("#sender_info_list_daily").click(function() {
            if($(this).is(":checked")){
                $("#daily_blk").show();
            } else {
                $("#daily_blk").hide();
            }
        });

        $("#sender_info_option_monthy").click(function() {
            if($(this).is(":checked")){
                $("#monthly_blk").show();
            } else {
                $("#monthly_blk").hide();
            }
        });

    
    });
    var form_error="{{trans('common.message.form_error')}}";
</script>

<script src="/themes/default/js/includes/staff.js" type="text/javascript"></script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="WXPunXLn">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="USXpuKVy">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="ltijsmzX">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="cvuXUxtF">
    @if ($page_data['action'] == 'add')
        <form action="{{ route('staff.store') }}" method="POST" id="staff-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else 
        <form action="{{ route('staff.update',  $user->id) }}" method="POST" id="staff-frm" class="kt-form kt-form--label-right">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="user-id" value="{{ $user->id }}">
        <input type="hidden" name="_method" value="PUT">
    @endif

        <div class="row" data-name="vpkxrMEH">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="FqrRgcIk">
                <div class="kt-portlet__head" data-name="yfMIqqOA">
                    <div class="kt-portlet__head-label" data-name="AhklNaff">
                        <h3 class="kt-portlet__head-title">{{trans('staff.admin.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="mvhgUBlv">
                    <div class="form-body" data-name="YXTpNles">
                        <div class="form-group row" data-name="DZqodGJC">
                                
                            <div class="col-md-6" data-name="APObAnuC">
                                <label class="col-form-label">{{trans('staff.admin.add_new.form.name')}}
                                    <span class="required"> * </span>
                                     {!! popover('staff.admin.add_new.form.name_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="Wdtcaatu">
                                    <input type="text" name="name" value="{{isset($user->name) ? $user->name : '' }}" class="form-control" /> 
                                </div>
                            </div>
                            <div class="col-md-6" data-name="LkFTrqVZ">
                                <label class="col-form-label">{{trans('staff.admin.add_new.form.email')}}
                                    <span class="required"> * </span>
                                     {!! popover('staff.admin.add_new.form.email_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="xmkhOBiv">
                                    <input type="email" name="email" value="{{isset($user->email) ? $user->email : '' }}" class="form-control" /> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" data-name="YQDczpOG">
                                
                            <div class="col-md-6" data-name="SozsrwrV">
                                <label class="col-form-label">{{trans('staff.admin.add_new.form.password')}}
                                    <span class="required"> * </span>
                                     {!! popover('staff.admin.add_new.form.password_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="gLCaQavP">
                                    <input type="password" name="password" id="password" value="" class="form-control" /> 
                                </div>
                            </div>
                            <div class="col-md-6" data-name="nSGMNwkn">
                                <label class="col-form-label">{{trans('staff.admin.add_new.form.confirm_password')}}
                                @if ($page_data['action'] == 'add')<span class="required"> * </span> @else @endif
                                     {!! popover('staff.admin.add_new.form.confirm_password_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="NKDkJwcK">
                                    <input type="password" name="confirm_password" value="" class="form-control" /> 
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row" data-name="cEkNsOOX">
                                
                            <div class="col-md-12" data-name="uVzthABP">
                                <label class="col-form-label">{{trans('staff.admin.add_new.form.admin_role')}}
                                    <span class="required"> * </span>
                                     {!! popover('staff.admin.add_new.form.admin_role_help','common.description') !!}
                                </label>
                                <select class="form-control m-select2" data-placeholder="Choose Role" name="role_id">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" {{ (isset($user->role_id) && $user->role_id == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="kt-wizard-v4__content" data-ktwizard-type="step-content" data-ktwizard-state="current" data-name="WwjplKNS">
                                                        <div class="kt-form__section kt-form__section--first" data-name="vzUVOuNa">
                                                            <div class="kt-wizard-v4__form" id="users_optionsBlk" data-name="kznnKosg">

                                              

                                                                <div class="form-group row" data-name="cgWsVsoS">
                                                                    <div class="col-md-12 row" data-name="zaIuWtIs">
                                                                        <label class="col-form-label pl12" for="sender_info_list_hour">
                                                                            {{trans('staff.create_blade.hourly_sending_rate_label')}}
                                                                            {!! popover('staff.create_blade.not_set_value_popover' , 'common.description') !!}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input type="checkbox" @if(!empty($user_email_limit) and $user_email_limit->hourly_rate > 0) checked @endif id="sender_info_list_hour" name="sender_info_list_hour">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div class="col-md-3" id="hour_blk" data-name="LGUnzAEc">
                                                                            <input type="text" @if(!empty($user_email_limit) and $user_email_limit->hourly_rate > 0)  value="{{$user_email_limit->hourly_rate}}" @endif  class="form-control user-input-val" name="sender_info_hour" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row" data-name="btPAiceU">
                                                                    <div class="col-md-12 row" data-name="sLcSCqye">
                                                                        <label class="col-form-label pl12" for="sender_info_list_daily">
                                                                            {{trans('staff.create_blade.daily_sending_limit_label')}} 
                                                                            {!! popover('staff.create_blade.not_set_value_dailylimit_popover' , "common.description") !!}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input   type="checkbox" @if(!empty($user_email_limit) and $user_email_limit->daily_limit > 0) checked @endif id="sender_info_list_daily" name="sender_info_list_daily">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div class="col-md-3" id="daily_blk" data-name="wrKZmZks">
                                                                            <input type="text"   @if(!empty($user_email_limit) and $user_email_limit->daily_limit > 0)  value="{{$user_email_limit->daily_limit}}" @endif  class="form-control user-input-val" name="sender_info_daily" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row" data-name="kOoOTlsF">
                                                                    <div class="col-md-12 row" data-name="mendjWst">
                                                                        <label class="col-form-label pl12" for="sender_info_option_monthy">
                                                                            {{trans('staff.create_blade.monthly_sending_limit_label')}} 
                                                                            {!! popover('not_set_value_monthlylimit_popover' , "common.description") !!}
                                                                        </label>
                                                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success secure-switch pl12 mr20">
                                                                            <label>
                                                                                <input  type="checkbox" @if(!empty($user_email_limit) and $user_email_limit->monthly_limit > 0) checked  @endif  id="sender_info_option_monthy" name="sender_info_option_monthy">
                                                                                <span></span>
                                                                            </label>
                                                                        </span>
                                                                        <div class="col-md-3" id="monthly_blk" data-name="mPshThcJ">
                                                                            <input type="text" @if(!empty($user_email_limit) and $user_email_limit->monthly_limit > 0)  value="{{$user_email_limit->monthly_limit}}" @endif  class="form-control user-input-val" name="sender_info_monthly" placeholder="Value">
                                                                        </div>
                                                                    </div>
                                                                </div>


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
                <div class="kt-portlet__foot" data-name="uQvKzJcg">
                    <div class="form-actions" data-name="CnQQmjEB">
                        <div class="row" data-name="FkLJcZOf">
                            <div class="col-md-6" data-name="HwMtWyPi">
                                <button type="submit" name="save_add" class="btn btn-success" value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                                @if ($page_data['action'] == 'add')
                                <button type="submit" name="save_exit" class="btn btn-success" value="save_exit">{{trans('common.form.buttons.save_exit')}}</button>
                                @else
                                <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                                @endif
                                <a href="{{ route('staff.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- END FORM-->
@endsection