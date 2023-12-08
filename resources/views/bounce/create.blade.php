@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/bounce-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/bounce.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/validate-form.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $("body").on("change", "#deleteBounce", function (e) {
            $("#BounceProcessing").hide();
            if($(this).is(":checked")) { 
                $("#BounceProcessing").show();
            } 
           
        });

        $(".m-select2").select2({
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
        $(".sb-form").click(function (e) {
            btn_id = this.id;
            id = $("#id").val();
            method = "POST";
            route = '{{route('bounce.store')}}';
            if(id!==undefined && id>0)
            {
                method = "PUT";
                route = '{{route('bounce.update',"")}}'+'/'+id;
            }
            formId = "#bounce-frm";
            createOrUpdate(method, route, formId,e,btn_id);
        });
    });
    $('.form-control').on('keypress keyup change', function(e) {
        id = this.id;
        id = '#'+id;
        err_id = '#'+this.id+'-error';
        $(id).removeClass('is-invalid');
        $(err_id).css('display','none');
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#bull2").click(function() {
            $("#port").attr("placeholder", "{{trans('bounce_addresses.add_new.form.common_port_143')}}");
        });
        $("#bull1").click(function() {
            $("#port").attr("placeholder", "{{trans('bounce_addresses.add_new.form.common_port_110')}}");
        });
        var bid = $("#bounce-id").val();
        if(bid > 0){
            if($("#pops2").is(":checked")) {
                $("#host, #port, #username, #password, #folder, #validate_certificates, #bounce_encryption, #delete_emails, #bull1, #bull2").attr("disabled", null);
            }
        } else{

        }
    });
    function showOrHide() {
        if($("#pops2").is(':checked')) {
            $("#otions").slideDown('slow');
        } else {
            $("#otions").slideUp('slow');
        }

    }
   </script>

    @if(isset($bounce->process_bounce_report) && $bounce->process_bounce_report==1)
        <script type="text/javascript">
            $("#otions").show();
        </script>
    @else
    <script type="text/javascript">
        $("#otions").hide();
    </script>
    @endif

@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="bXlGVaFf">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="tlXEGzhu">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="HDYefsQO">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="zzuVoayU">

    <form novalidate="novalidate" id="bounce-frm" class="kt-form kt-form--label-right">
        @if ($page_data['action'] == 'add')
            <input type="hidden" id="action" value="add">
        @else
            <input type="hidden" id="action" value="edit">
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="id" value="{{isset($bounce)?$bounce->id:'0'}}">

        <div class="row" data-name="fNNZIliF">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="VEiQQyTJ">
                <div class="kt-portlet__head" data-name="rpPuIaVS">
                    <div class="kt-portlet__head-label" data-name="EFCDMAaZ">
                        <h3 class="kt-portlet__head-title">{{trans('bounce_addresses.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="GffOHtiI">
                    <div class="form-body" data-name="HTOydgZx">

                        <div class="form-group row" data-name="EUOMOFUE">
                                
                            <div class="col-md-6" data-name="ArkNmytX">
                                <label class="col-form-label">{{trans('bounce_addresses.add_new.form.bounce_email')}}
                                    <span class="required"> * </span>
                                    <i class="fa fa-question-circle popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('bounce_addresses.add_new.form.bounce_email_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                </label>
                                <div class="input-icon right" data-name="rprGrCTc">
                                    <input
                                        type="text"
                                        id="bounce_email"
                                        name="bounce_email"
                                        value="{{isset($bounce->name) ? $bounce->name : '' }}"
                                        class="form-control"
                                        autocompleted="off"
                                        readonly onfocus="if (this.hasAttribute('readonly')) { this.removeAttribute('readonly'); this.blur(); this.focus();  } // fix for mobile safari to show virtual keyboard " 
                                        />
                                    <div id="bounce_email-error" class="error invalid-feedback" data-name="QASUYvQc"></div>
                                </div>
                            </div>
                        </div>


                        {{-- <div class="form-group row" data-name="RTjyHyLI">
                            <label class="col-form-label">
                                {{trans('bounce_addresses.add_new.form.process_bounce')}}
                                <span class="required"> * </span>
                                   <i class="fa fa-question-circle popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('bounce_addresses.add_new.form.process_bounce_help')}}" data-original-title="{{trans('common.description')}}"></i>
                            </label>
                            <div class="col-md-6" id="pops" data-name="PpworbRV">
                                <div class="input-icon" data-name="JPKeoRGz">
                                    @if ($page_data['action'] == 'add')

                                    <input type="checkbox" id="pops2"  data-switch="true" data-on-color="success" onchange="showOrHide()"/>
                                    @else
                                    <input type="checkbox" id="pops2" data-switch="true" data-on-color="success" @if($bounce->username != '') checked="" @endif /> 
                                    @endif
                                </div>
                            </div>
                        </div>--}}
                        <div class="form-group row" data-name="BJoYyLHV">
                            <label class="col-form-label pl12">
                                {{trans('bounce_addresses.add_new.form.process_bounce')}}
                                   <i class="fa fa-question-circle popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('bounce_addresses.add_new.form.process_bounce_help')}}" data-original-title="{{trans('common.description')}}"></i>
                            </label>
                            <div class="col-md-2" id="pops" data-name="gTclcHpR">

                                <div class="input-icon dis-dang" data-name="DRupCHlr">

                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
										<label  >
											<input id="pops2" type="checkbox"  onchange="showOrHide()" name="process_bounce_report" @if(isset($bounce) && $bounce->process_bounce_report==2) disabled  @endif  @if(isset($bounce) && $bounce->process_bounce_report==1) checked="" @endif>
											<span></span>
										</label>
									</span>
                                    @if(isset($pmta) && $bounce->process_bounce_report==2)<span class="text-danger"> {{ trans("bounce_addresses.pmta_control")}} ({{$pmta->server_name}} - {{$pmta->id}}) </span>@endif

                                </div>
                            </div>
                        </div>
                        @if ($page_data['action'] == 'add')
                        <div id="otions" data-name="AwlMOdZs">
                        @else
                        <div data-name="AkKZKjna" id="otions" @if($bounce->username != '') style="display:block;" @endif>
                        @endif
                            <div class="form-group row" data-name="oZzKueXf">
                                <label class="col-form-label pl12">
                                        {{trans('common.label.active')}}
                                        <span class="required">  </span>
                                         <i class="fa fa-question-circle popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover"  data-placement="right" data-content="{{trans('bounce_addresses.add_new.form.active_help')}}" data-original-title="{{trans('common.description')}}"></i>    
                                    </label>
                                <div class="col-md-2" id="pops" data-name="HzeHVUdL">
                                    
                                    <div class="input-icon" data-name="ltuJZnXM">
                                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
										    <label>
                                        <input id="pops1"  type="checkbox" name="is_active"  @if( (isset($bounce) && $bounce->is_active==1) || Request::segment(2)=='create')  checked="" @endif>
		                                    <span></span>
										    </label>
									    </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" data-name="ArGkPKiT">
                                <label class="col-form-label pl12">
                                    {{trans('bounce_addresses.add_new.form.method')}}
                                    <span class="required"> * </span>
                                    <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.method_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                </label>
                                <div class="kt-radio-inline" data-name="TRRxwlGl">
                                    <label for="bull1" class="kt-radio kt-radio--default">
                                        <input type="radio" name="processing_protocols" id="bull1" value="pop" checked {{ (isset($bounce->processing_protocols) && $bounce->processing_protocols == 'pop') ? 'checked' : '' }}>
                                        {{trans('common.label.pop')}}
                                        <span></span>
                                    </label>
                                    <label for="bull2" class="kt-radio kt-radio--default">
                                        <input type="radio" name="processing_protocols" id="bull2" value="imap" {{ (isset($bounce->processing_protocols) && $bounce->processing_protocols == 'imap') ? 'checked' : '' }}>
                                        {{trans('common.label.imap')}}
                                        <span></span>
                                    </label>
                                </div>
                            </div>


                            <div class="form-group row" data-name="oZzKueXf">
                                    <label class="col-form-label pl12">
                                            {{trans('bounce_addresses.add_new.form.delete_emails_after_bounce_processing')}}
                                        
                                            <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.delete_emails_after_bounce_processing_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <div class="col-md-2" id="pops" data-name="HzeHVUdL">
                                        
                                        <div class="input-icon" data-name="ltuJZnXM">
                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                <label>
                                            <input id="deleteBounce" name="delete_emails_switch"  type="checkbox"   {{ (isset($bounce->delete_emails) && ($bounce->delete_emails == 1 || $bounce->delete_emails == 2)) ? 'checked' : '' }}>
                                                <span></span>
                                                </label>
                                            </span>
                                        </div>
                                    </div>
                            </div>

                            <div class="form-group row" data-name="ArGkPKiTT" id="BounceProcessing" style="display:{{ (isset($bounce->delete_emails) && ($bounce->delete_emails == 1 || $bounce->delete_emails == 2)) ? 'block' : 'none' }}">
                              
                                <div class="kt-radio-inline" data-name="TRRxwlGl">
                                    <label for="b1" class="kt-radio kt-radio--default">
                                        <input type="radio" name="delete_emails" id="b1" value="1" checked  {{ (isset($bounce->delete_emails) && $bounce->delete_emails == 1) ? 'checked' : '' }}>
                                        {{trans('bounce_addresses.add_new.form.delete_only_processed')}}
                                        <span></span>
                                    </label>
                                    <label for="b2" class="kt-radio kt-radio--default">
                                        <input type="radio" name="delete_emails" id="b2" value="2" {{ (isset($bounce->delete_emails) && $bounce->delete_emails == 2) ? 'checked' : '' }}>
                                        {{trans('bounce_addresses.add_new.form.delete_all_emails')}}
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="form-group row" data-name="MYeecBkH">
                                    
                                <div class="col-md-6" data-name="uTbLrndJ">
                                    <label class="col-form-label">{{trans('bounce_addresses.add_new.form.host')}}
                                        <span class="required"> * </span>
                                         <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.host_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <div class="input-icon right" data-name="UDUcCpWx">
                                        <input type="text" name="host" id="host" value="{{isset($bounce->host) ? $bounce->host : '' }}" class="form-control" />
                                        <div id="host-error" class="error invalid-feedback" data-name="HdNkZmth"></div>
                                    </div>
                                </div>
                                <div class="col-md-6" data-name="uOggWLPW">
                                    <label class="col-form-label">{{trans('bounce_addresses.add_new.form.username')}}
                                        <span class="required"> * </span>
                                        <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.username_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <div class="input-icon right" data-name="totIFBug">
                                        <input type="text" name="username" id="username" value="{{isset($bounce->username) ? $bounce->username : '' }}" class="form-control" />
                                        <div id="username-error" class="error invalid-feedback" data-name="HxrJgapu"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" data-name="uMsnFkbJ">
                                
                                <div class="col-md-6" data-name="xkSultXh">
                                    <label class="col-form-label">
                                        {{trans('bounce_addresses.add_new.form.password')}}
                                         <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.password_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <div class="input-icon right" data-name="AQatucwy">
                                        <input type="password" name="password" id="password" value="{{isset($bounce->password) ? Crypt::decrypt($bounce->password) : '' }}" class="form-control" />
                                        <div id="password-error" class="error invalid-feedback" data-name="mNsMAMGl"></div>
                                    </div>
                                </div>
                                <div class="col-md-6" data-name="ZLwvXGwD">
                                    <label class="col-form-label">{{trans('bounce_addresses.add_new.form.port')}}
                                        <span class="required"> * </span>
                                        <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.port_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <div class="input-icon right" data-name="DpDuoEDB">
                                        <input type="text" name="port" id="port" value="{{isset($bounce->port) ? $bounce->port : '' }}" class="form-control portPop" placeholder="Common Port: 110" />
                                        <div id="port-error" class="error invalid-feedback" data-name="WJCLERGj"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row" data-name="VWKAmZpK">
                                    
                                <div class="col-md-6" data-name="PZqPTWnP">
                                    <label class="col-form-label">{{trans('bounce_addresses.add_new.form.folder')}}
                                        <span class="required"> * </span>
                                        <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.folder_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <div class="input-icon right" data-name="tJiPxvrb">
                                        <input type="text" name="folder" id="folder" value="{{isset($bounce->folder) ? $bounce->folder : 'INBOX' }}" class="form-control" />
                                        <div id="folder-error" class="error invalid-feedback" data-name="eFuCyYON"></div>
                                        <i class="fa"></i>
                                    </div>
                                </div>
                                <div class="col-md-6" data-name="IHocrgae">
                                    <label class="col-form-label">
                                        {{trans('bounce_addresses.add_new.form.validate_certificate')}}
                                          <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.validate_certificate_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <select class="form-control" name="validate_certificates">
                                        <option value="0" {{ (isset($bounce->validate_certificates) && $bounce->validate_certificates == 0) ? 'selected' : '' }}>
                                            {{trans('common.form.buttons.no')}}
                                        </option>
                                        <option value="1" {{ (isset($bounce->validate_certificates) && $bounce->validate_certificates == 1) ? 'selected' : '' }}>
                                            {{trans('common.form.buttons.yes')}}
                                        </option>
                                    </select>
                                    <div id="validate_certificates-error" class="error invalid-feedback" data-name="aHGrKuka"></div>
                                </div>
                            </div>
                            <div class="form-group row" data-name="ofZVgDbt">
                                

                                <div class="col-md-6" data-name="ynvJsUuT">
                                    <label class="col-form-label">
                                    {{trans('bounce_addresses.add_new.form.mail_encryption')}}
                                      <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.mail_encryption_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                </label>
                                    <select class="form-control" name="bounce_encryption">
                                        <option value="notls">
                                            {{trans('bounce_addresses.encryption.none')}}
                                        </option>
                                        <option value="tls" {{ (isset($bounce->bounce_encryption) && $bounce->bounce_encryption == 'tls') ? 'selected' : '' }} >
                                            {{ trans('bounce_addresses.encryption.tls') }}
                                        </option>
                                        <option value="ssl" {{ (isset($bounce->bounce_encryption) && $bounce->bounce_encryption == 'ssl') ? 'selected' : '' }} >
                                            {{ trans('bounce_addresses.encryption.ssl') }}
                                        </option>
                                    </select>
                                    <div id="bounce_encryption-error" class="error invalid-feedback" data-name="GGlXUwVG"></div>
                                </div>
                                <!-- <div class="col-md-6" data-name="gQIKapuB">
                                    <label class="col-form-label">
                                        {{trans('bounce_addresses.add_new.form.delete_emails_after_bounce_processing')}}
                                         <i class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.delete_emails_after_bounce_processing_help')!!}" data-original-title="{{trans('bounce_addresses.add_new.form.delete_emails_after_bounce_processing')}}"></i>
                                    </label>
                                    <select class="form-control" name="delete_emails">
                                        <option value="0" {{ (isset($bounce->delete_emails) && $bounce->delete_emails == 0) ? 'selected' : '' }}>
                                            {{trans('common.form.buttons.no')}}
                                        </option>
                                        <option value="1" {{ (isset($bounce->delete_emails) && $bounce->delete_emails == 1) ? 'selected' : '' }}>
                                            {{trans('common.form.buttons.yes')}}
                                        </option>
                                    </select>
                                    <div id="delete_emails-error" class="error invalid-feedback" data-name="pEKYPNGY"></div>
                                </div> -->
                            </div>
                            <div class="form-group row" data-name="akzwMgzT">
                                <label class="col-form-label"></label>
                                <div class="col-md-12" data-name="UcKWqLDS">
                                    <button type="button" id="verify-imap" name="verify-imap" class="btn btn-info">{{trans('bounce_addresses.add_new.form.verify_connection')}}
                                        <i style="color: #fff;" class="fa fa-question-circle popovers" data-html="true"  data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{!!trans('bounce_addresses.add_new.form.verify_connection_help')!!}" data-original-title="{{trans('common.description')}}"></i>
                                    </button>
                                    <div id="verify-imap-msg" data-name="yaBIwfwx"></div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="omjXEgrZ">
                    <div class="form-actions" data-name="DBoSmReU">
                        <div class="row" data-name="gpXMLZnd">
                            <div class="col-md-12" data-name="unwCNcRg">
                                @if ($page_data['action'] == 'add')
                                    <button type="submit" id="save_exit" class="btn btn-success sb-form" value="save_exit">
                                        {{trans('common.form.buttons.save')}}
                                    </button>
                                @else
                                    <button type="submit" id="edit" class="btn btn-success sb-form" value="edit">{{trans('common.form.buttons.save')}}</button>
                                @endif
                                <button type="submit" id="save_add" class="btn btn-success sb-form" value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                                <a href="{{ route('bounce.index') }}"><button type="button" class="btn btn-default">
                                    {{trans('common.form.buttons.cancel')}}
                                </button></a>
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