@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/fbl-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/fbl.js" type="text/javascript"></script>
@endsection

@section(decide_content())


@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="OipVZnnf">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="pSItKUfB">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="cHrIQxsg">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="NfrmXZBv">
    @if ($page_data['action'] == 'add')
        <form action="{{ route('fbl.store') }}" method="POST" id="fbl-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else 
        <form action="{{ route('fbl.update', $fbl->id) }}" method="POST" id="fbl-frm" class="kt-form kt-form--label-right">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="fbl-id" value="{{$fbl->id}}">
        <input type="hidden" name="_method" value="PUT">
    @endif

        <div class="row" data-name="hCPdgWqh">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="oCmSREnT">
                <div class="kt-portlet__head" data-name="whmoNsuQ">
                    <div class="kt-portlet__head-label" data-name="LEKlEmeX">
                        <h3 class="kt-portlet__head-title">{{trans('fbl.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="xguYgpcp">
                    <div class="form-body" data-name="otfErcjz">
                        <div class="form-group row" data-name="AbbJzLbN">
                            <div class="col-md-6" data-name="kLmoAfat">
                                <label class="col-form-label">{{trans('fbl.add_new.form.email')}}
                                    <span class="required"> * </span>
                                    {!! popover('fbl.add_new.form.email_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="YcOeJDyC">
                                    <input type="email" name="name" value="{{isset($fbl->name) ? $fbl->name : old('name') }}" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-6" data-name="ynpeICYP">
                                <label class="col-form-label">{{trans('fbl.add_new.form.host')}}
                                    <span class="required"> * </span>
                                    {!! popover('fbl.add_new.form.host_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="CBlnIQQd">
                                    <input type="text" name="host" value="{{isset($fbl->host) ? $fbl->host : old('host') }}" class="form-control" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" data-name="sNLfUhTJ">
                            <div class="col-md-6" data-name="wXByZFQm">
                                <label class="col-form-label">{{trans('fbl.add_new.form.port')}}
                                    <span class="required"> * </span>
                                    {!! popover('fbl.add_new.form.port_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="dcFooNbZ">
                                    <input type="text" name="port" value="{{isset($fbl->port) ? $fbl->port : old('port') }}" class="form-control" /> 
                                </div>
                            </div>
                            <div class="col-md-6" data-name="gaTbAQSu">
                                <label class="col-form-label">{{trans('fbl.add_new.form.username')}}
                                    <span class="required"> * </span>
                                    {!! popover('fbl.add_new.form.username_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="nAzukEYH">
                                    <input type="text" name="username" value="{{isset($fbl->username) ? $fbl->username : old('username') }}" class="form-control" /> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" data-name="UZabRTWZ">
                            <div class="col-md-6" data-name="esPYxQTI">
                                <label class="col-form-label">{{trans('fbl.add_new.form.password')}}
                                    {!! popover('fbl.add_new.form.password_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="GGrJNmzs">
                                    <input type="password" name="password" id="password" value="{{isset($fbl->password) ? Crypt::decrypt($fbl->password) : old('password') }}" class="form-control" /> 
                                </div>
                            </div>
                            <div class="col-md-6" data-name="ABSSgpCd">
                                <label class="col-form-label">{{trans('fbl.add_new.form.folder')}}
                                    <span class="required"> * </span>
                                    {!! popover('fbl.add_new.form.folder_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="yECTTAza">
                                    <input type="text" name="folder" value="{{isset($fbl->folder) ? $fbl->folder : 'INBOX' }}" class="form-control" /> 
                                </div>
                            </div>
                        </div>

                        <div class="form-group row" data-name="kQRaKzHi">
                                
                            <div class="col-md-6" data-name="ICpvcCAA">
                                <label class="col-form-label">{{trans('fbl.add_new.form.validate_certificate')}}
                                    {!! popover('fbl.add_new.form.validate_certificate_help','common.description') !!}
                                </label>
                                <select class="form-control" name="validate_certificates">
                                    <option value="0" {{ (isset($fbl->validate_certificates) && $fbl->validate_certificates == 0) ? 'selected' : '' }}>
                                        {{trans('common.form.buttons.no')}}
                                    </option>
                                    <option value="1" {{ (isset($fbl->validate_certificates) && $fbl->validate_certificates == 1) ? 'selected' : '' }}>
                                        {{trans('common.form.buttons.yes')}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6" data-name="xKCsZbLl">
                                <label class="col-form-label">{{trans('common.label.encryption')}}
                                    {!! popover('fbl.add_new.form.encryption_help','common.description') !!}
                                </label>
                                <select class="form-control" name="fbl_encryption">
                                    <option value="">
                                        {{trans('common.label.none')}}
                                    </option>
                                    <option value="tls" {{ (isset($fbl->fbl_encryption) && $fbl->fbl_encryption == 'tls') ? 'selected' : '' }}>{{trans('common.label.tls')}}</option>
                                    <option value="ssl" {{ (isset($fbl->fbl_encryption) && $fbl->fbl_encryption == 'ssl') ? 'selected' : '' }}>{{trans('common.label.ssl')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row" data-name="pwArxvcW">
                                
                            <div class="col-md-6" data-name="jWrZHCZX">
                                <label class="col-form-label">{{trans('fbl.add_new.form.delete_emails')}}
                                     {!! popover('fbl.add_new.form.delete_emails_help','common.description') !!}
                                </label>
                                <select class="form-control" name="delete_emails">
                                    <option value="0" {{ (isset($fbl->delete_emails) && $fbl->delete_emails == 0) ? 'selected' : '' }}>
                                        {{trans('common.form.buttons.no')}}
                                    </option>
                                    <option value="1" {{ (isset($fbl->delete_emails) && $fbl->delete_emails == 1) ? 'selected' : '' }}>
                                        {{trans('common.form.buttons.yes')}}
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-6" data-name="MZNZRRea">
                                <label class="col-form-label">
                                    {{trans('fbl.add_new.form.connection_method')}}
                                    <span class="required"> * </span>
                                     {!! popover('fbl.add_new.form.connection_method_help','common.description') !!}
                                </label>
                                <div class="input-icon right kt-radio-inline" data-name="tLLksUVU">
                                    <label for="rpop" class="kt-radio">
                                        <input type="radio" name="processing_protocols" value="pop" id="rpop" {{ (isset($fbl->processing_protocols) && $fbl->processing_protocols == 'pop' || $page_data['action'] == 'add') ? 'checked' : '' }}> {{trans('common.label.pop')}}
                                        <span></span>
                                    </label>
                                    <label for="rimap" class="kt-radio">
                                        <input type="radio" name="processing_protocols" value="imap" id="rimap" {{ (isset($fbl->processing_protocols) && $fbl->processing_protocols == 'imap') ? 'checked' : '' }}> {{trans('common.label.imap')}}
                                        <span></span>
                                    </label> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="RwjMJXrB">
                            <div class="col-md-6" data-name="qzhxjiSC">
                            <label class="col-form-label pl12">
                                {{trans('common.label.status')}} 
                            </label>

                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success pl12">
										<label>
											<input id="status" @if(isset($fbl) && $fbl->status=='active') checked @endif type="checkbox"  name="status">
											<span></span>
										</label>
									</span>

                            </div>
                        </div>
                        <br>
                        <div id="verify-imap-msg" data-name="qYZpQKTE"></div>
                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="HlhXJDgN">
                    <div class="form-actions" data-name="REjIGcxI">
                        <div class="row" data-name="YyxRZWkJ">
                            <div class="col-md-12" data-name="fspxfDxJ">
                                <button type="submit" name="save_add" class="btn btn-success" value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                                @if ($page_data['action'] == 'add')
                                <button type="submit" name="save_exit" class="btn btn-success" value="save_exit">{{trans('common.form.buttons.save_exit')}}</button>
                                @else
                                <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                                @endif
                                <a href="{{ route('fbl.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                                <button type="button" id="verify-imap" name="verify-imap" class="btn btn-success">{{trans('fbl.validate_connection')}}</button>
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