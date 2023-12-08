@extends('layouts.master')

@section('title', $page_data['title'] )

@section('page_styles')
<link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
<link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<style>
.alert {
   padding: 6px;
}
</style>
@endsection

@section('page_scripts')
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
    var groups_msg="{{trans('app.smtp_management.add_new.messages.groups_msg')}}";
</script>
<script src="/js/includes/smtp.js" type="text/javascript"></script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="zzpNfyyR">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.settings.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{ $page_data['title'] }}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{ $page_data['title'] }}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="eZKxvVsA">
    <p>
        {{getHeading(trans('app.headings.settings.notification_smtp'))}}
    </p>
</div>
@if (Session::has('msg'))
<div class="alert alert-success" data-name="deiatEqn">
    {{ Session::get('msg') }}
</div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="YXXWSeNu">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="zwECtOMM">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="wnWkWQab">
    <!-- BEGIN FORM--> 
        <form action="{{ URL::route('setting.notification.smtp', $setting->id) }}" method="POST" id="smtp-frm" class="form-horizontal">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="smtp-id" value="{{$setting->id}}">
        <input type="hidden" name="_method" value="PUT">
    <div class="col-md-9" data-name="GViMhgkJ">
        <div class="portlet box green" data-name="hAiTeTIB">
            <div class="portlet-title" data-name="woRfRKlp">
                <div class="caption" data-name="GZpziHsW">
                    <span class="caption-subject">{{trans('app.settings.notification_smtp.table_headings.setup_notification_smtp')}}</span>
                </div>
            </div>
            <div class="portlet-body" data-name="ucSftlmx">
                <div class="form-body" data-name="KTySBaHB">
                    <div class="form-group" data-name="OETmdpAt">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.smtp_account_name')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="bLFZmpsF">
                            <div class="input-icon right" data-name="OrmvPwbn">
                                <i class="fa"></i>
                                <input type="text" name="name" class="form-control" value="{{isset($notification_setting->name) ? $notification_setting->name : '' }}" required />
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.smtp_group_name')}}
                            <span class="required"> * </span><br />
                            <span   data-toggle="tooltip"  title="Add New Group" >
                                <a href="#modal-group-label" data-toggle="modal"><i class="fa fa-plus-square-o fa-fw"></i></a>
                            </span>
                        </label>
                        <div class="col-md-8">
                            <select class="form-control select2" name="group_id" id="group-id">
                                <option value="">Choose a Group</option>
                                @foreach($groups as $group)
                                    <option value="{{ $group->id }}" {{ (isset($notification_setting->group_id) && $notification_setting->group_id == $group->id) ? 'selected' : '' }}>{{ $group->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.smtp_group_name.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.smtp_group_name.title')}}"></button>
                    </div> -->
                    <div class="form-group" data-name="moQheGMe">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.smtp_host')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="bDPYpdrv">
                            <div class="input-icon right" data-name="MbwLllUk">
                                <i class="fa"></i>
                                <input type="text" name="host" class="form-control" value="{{isset($notification_setting->host) ? $notification_setting->host : '' }}" required />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.smtp_host.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.smtp_host.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="smGGTQES">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.smtp_username')}}</label>
                        <div class="col-md-8" data-name="JIgTQHJO">
                            <div class="input-icon right" data-name="nAwVnAKn">
                                <i class="fa"></i>
                                <input type="text" name="username" class="form-control" value="{{isset($notification_setting->name) ? $notification_setting->username : '' }}" />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.smtp_username.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.smtp_username.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="swBNUnBT">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.smtp_password')}}</label>
                        <div class="col-md-8" data-name="rWPegUlF">
                            <div class="input-icon right" data-name="NXMGtIwq">
                                <i class="fa"></i>
                                <input type="password" name="password" id="password" value="{{isset($notification_setting->password) ? Crypt::decrypt($notification_setting->password) : '' }}" class="form-control" />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.smtp_password.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.smtp_password.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="BjyThfqs">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.smtp_port')}}</label>
                        <div class="col-md-8" data-name="JZwjYRbX">
                            <div class="input-icon right" data-name="sYqrHqwP">
                                <i class="fa"></i>
                                <input type="text" name="port" class="form-control" value="{{isset($notification_setting->port) ? $notification_setting->port : '' }}" />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.smtp_port.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.smtp_port.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="jRfrtawN">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.encryption.title')}}</label>
                        <div class="col-md-8" data-name="AYKXVJDv">
                            <select class="form-control" name="smtp_encryption">
                                <option value="">{{trans('app.smtp_management.add_new.fields.encryption.values.none')}}</option>
                                <option value="tsl" {{ (isset($notification_setting->smtp_encryption) && $notification_setting->smtp_encryption == 'tsl') ? 'selected' : '' }}>TSL</option>
                                <option value="ssl" {{ (isset($notification_setting->smtp_encryption) && $notification_setting->smtp_encryption == 'ssl') ? 'selected' : '' }}>SSL</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" data-name="LLPNNoVT">
                            <label class="control-label col-md-3">{{trans('app.settings.notification_smtp.fields.ip_pool')}}</label>
                            <div class="col-md-8" data-name="wrAOQjMq">
                                <div class="input-icon right" data-name="BygmgNvL">
                                    <i class="fa"></i>
                                    <textarea name="ip_pool" class="form-control" rows="6">{{@$notification_setting->ip_pool}}</textarea>
                                </div>
                            </div>
                            <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.settings.notification_smtp.ip_pool.description')}}" data-original-title="{{trans('app.help.settings.notification_smtp.ip_pool.title')}}"></i>
                        </div>
                    <div class="form-group" data-name="oPqtgYKy">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.from_name')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="PmQWDxRR">
                            <div class="input-icon right" data-name="tQXKTfmy">
                                <i class="fa"></i>
                                <input type="text" name="from_name" class="form-control" value="{{isset($notification_setting->from_name) ? $notification_setting->from_name : '' }}" required />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.from_name.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.from_name.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="OwnZdnpU">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.from_email')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="RDdKCXRg">
                            <div class="input-icon right" data-name="qgqlROvS">
                                <i class="fa"></i>
                                <input type="text" name="from_email" class="form-control" value="{{isset($notification_setting->from_email) ? $notification_setting->from_email : '' }}" required />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.from_email.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.from_email.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="xbSCNfPh">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.bounce_email')}} <span class="required"> * </span> </label>
                        <div class="col-md-8" data-name="BJfNTRFb">
                            <select class="form-control select2" data-placeholder="Choose Bounce Email" name="bounce_email_id" id="group-id">
                                <option value="">{{trans('app.smtp_management.add_new.fields.bounce_email_choose')}}</option>
                                @foreach($bounce_emails as $bounce_email)
                                    <option value="{{ $bounce_email->id }}" {{ (isset($notification_setting->bounce_email_id) && $notification_setting->bounce_email_id == $bounce_email->id) ? 'selected' : '' }}>{{ $bounce_email->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.bounce_email.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.bounce_email.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="atlZRCjs">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.masked_domain.title')}}</label>
                        <div class="col-md-8" data-name="UoivVbzp">
                            <select class="form-control select2" data-placeholder="Choose Masked Domain" name="masked_domain_id" id="group-id">
                                @foreach($domain_maskings as $masked_domain)
                                    <option value="{{ $masked_domain->id }}" {{ (isset($notification_setting->masked_domain_id) && $notification_setting->masked_domain_id == $masked_domain->id) ? 'selected' : '' }}>{{ $masked_domain->domain }}</option>
                                @endforeach
                            </select>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.masked_domain.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.masked_domain.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="leHCxedn">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.reply_to_email')}}
                            <span class="required"> * </span>
                        </label>
                        <div class="col-md-8" data-name="gReJfsHz">
                            <div class="input-icon right" data-name="MYnNyDZX">
                                <i class="fa"></i>
                                <input type="text" name="reply_email" class="form-control" value="{{isset($notification_setting->reply_email) ? $notification_setting->reply_email : '' }}" required />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.reply_to_email.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.reply_to_email.title')}}"></i>
                    </div>
                    <div class="form-group" data-name="GNzfttKN">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.status.title')}}</label>
                        <div class="col-md-8" data-name="OaTXLDNX">
                            <select class="form-control" name="status">
                                <option value="1" {{ (isset($notification_setting->status) && $notification_setting->status == 1) ? 'selected' : '' }}>
                                    {{trans('app.smtp_management.add_new.fields.status.values.active')}}
                                </option>
                                <option value="0" {{ (isset($notification_setting->status) && $notification_setting->status == 0) ? 'selected' : '' }}>
                                    {{trans('app.smtp_management.add_new.fields.status.values.inactive')}}
                                </option>
                            </select>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.status.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.status.title')}}"></i>
                    </div>
                </div>
                <div class="form-actions" data-name="ZYbQvRip">
                    <div class="row" data-name="hhpxeHAP">
                        <div class="col-md-offset-6 col-md-9" data-name="COJkecFM">
                            <button type="submit" name="submit" class="btn green" value="submit">
                                {{trans('app.settings.notification_smtp.buttons.submit')}}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- END FORM-->
</div>

<div class="row" data-name="aCnFPNVA">
    <!-- BEGIN FORM-->
    <form action="" method="POST" id="smtp-validation-frm" class="form-horizontal">
    <div class="col-md-9" data-name="DxnzuZbN">
        <div class="portlet box green" data-name="OqYzlMqi">
            <div class="portlet-title" data-name="IgsuYYcn">
                <div class="caption" data-name="sVRXRujS">
                    <span class="caption-subject bold">{{trans('app.smtp_management.add_new.table_headings.test_email')}}</span>
                </div>
            </div>
            <div class="portlet-body" data-name="HJCYfsrv">
                <div class="form-body" data-name="scmLsZfb">
                    <div class="form-group" data-name="RXKEWLtI">
                        <label class="control-label col-md-3">{{trans('app.smtp_management.add_new.fields.email_address')}}
                        </label>
                        <div class="col-md-8" data-name="wOOgeMAo">
                            <div class="input-icon right" data-name="iCQtKGpI">
                                <i class="fa"></i>
                                <input type="text" name="smtp_email" id="smtp_email" class="form-control" value="" required />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.smtp_management.add_new.email_address.description')}}" data-original-title="{{trans('app.help.smtp_management.add_new.email_address.title')}}"></i>
                    </div>
                </div>
                <div class="form-actions" data-name="kVOXdxqW">
                    <div class="row" data-name="BdreQvDm">
                        <div class="col-md-offset-3 col-md-9" data-name="rErouWYx">
                            <button type="button" class="btn green" id="smpt-send-mail">{{trans('app.smtp_management.add_new.buttons.test_email')}}</button>
                            <div id="mail-sent-msg" data-name="tGWuRrQz"></div>
                            <span id="mail-sent-log-link" style="display: none;"><a>
                                {{trans('app.smtp_management.add_new.messages.show_log')}}
                            </a></span>
                            <div id="mail-sent-log" style="display: none;" data-name="SnghCLrW"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- END FORM-->
</div>

<div id="modal-group-label" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="fDVGuZYM">
    <div class="modal-dialog" data-name="IfATQCYD">
        <div class="modal-content" data-name="vEQjAsPY">
            <div id="msg-group" class="display-hide" data-name="RDFyxHRf">
                <span id='msg-text-group'><span>
            </div>
            <div class="modal-header" data-name="VqZNaqzX">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">{{trans('app.smtp_management.add_new.table_headings.add_new_group')}}</h4>
            </div>
            <div class="modal-body" data-name="uTXhmtrE">
            <form action="" id="frm-group" method="post" class="form-horizontal">
                @for ($i = 1; $i < 6; $i++)
                    <div class="form-group" data-name="LegjVsOu">
                        <label class="col-md-3 control-label" >{{trans('app.smtp_management.add_new.fields.group_name')}} {{ $i }}</label>
                        </label>
                        <div class="col-md-9" data-name="MlOcEEiM">
                            <input type="text"  name="name[]" class="form-control"  {{ ($i == 1) ? 'required' : '' }}> 
                        </div>
                    </div>
                @endfor
                <div class="form-actions" data-name="sqsaBItP">
                    <div class="row" data-name="dCEPGhKq">
                        <div class="col-md-offset-3 col-md-9" data-name="YiirYxYx">
                            <button type="submit" class="btn green">{{trans('app.smtp_management.add_new.buttons.submit')}}</button>
                            <button type="reset" class="btn grey-salsa btn-outline">{{trans('app.smtp_management.add_new.buttons.reset')}}</button>
                            <input type="hidden" value="2" name="section_id">
                        </div>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection