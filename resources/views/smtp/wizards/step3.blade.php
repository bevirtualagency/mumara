<style>
    #amazonResponse:before {
        position: absolute;
        left: 13px;
    }
    #amazonResponse {
        padding-left: 45px;
        display: block;
        padding-right: 30px;
    }
    #amazonRes, #disc {
        line-height: 1.6;
    }
    #amazonRes {
        display: block;
        margin-bottom:15px;
    }
    #disc {
        border-top: 1px solid;
        padding-top: 3px;
        font-size: 10px;
    }
</style>

 <?php
        $apiCred = isset($smtp) && $smtp->api_credentials!=null ? json_decode($smtp->api_credentials,true) : null;
        $smtps = smtps();
        ?>
 @if(!in_array($config['type'],$smtps))
        @foreach($config['form'] as $key => $field)
            <?php $type = isset($field) ?  $field['type'] : null;
            ?>
            <div class="form-group row">

                <div class="col-md-12">
                    <label class="col-form-label">
                        {{$field['label']}}
                        <span class="required"> * </span>
                    </label>
                    @if($field['type']=="checkbox")
                        @foreach( $field['options'] as $option)
                            <input type="{{$field['type']}}" name="{{$field['name']}}[]" id="{{$field['name']}}" value="{{  $option }}" @if( (!isset($apiCred) && $option==$field['default']) || (isset($apiCred) && in_array($option,$apiCred[$field['name']]))) checked @endif class="{{$field['class']}}" /> {{  $option }}
                        @endforeach
                        <span id="{{$key}}-error" class="error invalid-feedback"></span>
                    @elseif($field['type']=="radio")
                        @foreach( $field['options'] as $option)
                            <input type="{{$field['type']}}" name="{{$field['name']}}" id="{{$field['name']}}" value="{{  $option }}" @if( (!isset($apiCred) && $option==$field['default']) || (isset($apiCred) && $apiCred[$field['name']] ==$option)) checked @endif class="{{$field['class']}}" /> {{  ucwords(str_replace(['-'],' ',$option)) }}
                        @endforeach
                        <span id="{{$key}}-error" class="error invalid-feedback"></span>
                    @elseif($field['type']=="select")
                        <select  name="{{$field['name']}}" id="{{$field['name']}}"  @if($field['width']) style="width: {{$field['width']}} !important"  @endif class="{{$field['class']}}">
                            @foreach( $field['options'] as $key => $option)
                                @php
                                $int = is_int($key)
                                @endphp
                                <option value="{{  $option }}" @if( (!isset($apiCred) && $option==$field['default']) || (isset($apiCred) && isset($apiCred[$field['name']]) && $apiCred[$field['name']] ==$option)) selected @endif>{{ $int ?  ucwords(str_replace(['-'],' ',$option)) :$key }}</option>
                            @endforeach
                        </select>
                        <span id="{{$key}}-error" class="error invalid-feedback"></span>
                    @elseif($field['type']=="textarea")
                        <textarea name="{{$field['name']}}"  placeholder="{{$field['label']}}" class="{{$field['class']}}" rows="8" cols="8" @if($field['width']) style="width: {{$field['width']}} !important"  @endif>{{isset($apiCred) ? $apiCred[$field['name']]: $field['default']}}</textarea>
                    @else
                        @if(!empty($field['insertTop']))
                            @foreach( $field['insertTop'] as $top)

                                @foreach( $top['options'] as $option)
                                    <input type="{{$top['type']}}" name="{{$top['name']}}" value="{{$option}}" @if( (!isset($apiCred) && $option==$top['default']) || (isset($apiCred) && $apiCred[$top['name']] ==$option)) checked @endif class="{{$top['class']}}" /> {{  ucwords(str_replace(['-'],' ',$option)) }}
                                @endforeach
                            @endforeach
                        @endif
                        <input {{isset($field['required']) && $field['required'] ? 'required' : ''}} placeholder="{{$field['label']}}" type="{{$field['type']}}" name="{{$field['name']}}" id="{{$field['name']}}" value="{{isset($apiCred)?$apiCred[$field['name']]: $field['default']}}" @if($field['width']) style="width: {{$field['width']}} !important"  @endif class="{{$field['class']}}" />
                        <span id="{{$field['name']}}-error" class="error invalid-feedback"></span>
                    @endif
                </div>

            </div>
        @endforeach



        <div class="form-group row">
            <div class="col-md-12">
                <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                    <div class="card">
                        <div class="card-header" id="headingOne6">
                            <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
                                <i class="flaticon2-copy"></i> {{trans('sending_nodes.api_key_link')}}
                            </div>
                        </div>
                        <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                            <div class="card-body">
                                <h3 class="m-form__heading-title">
                                    {{isset($config['card_title']) ? $config['card_title']:''}}
                                </h3>
                                {!! isset($config['how_to_get_keys'])?$config['how_to_get_keys']:'' !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-form-label pl12">
                {{trans('sending_nodes.process_delivery_reports')}}
                {!! popover('sending_nodes.process_delivery_reports_help','common.description') !!}
            </label>
                <div class="col-md-8" id="p1">
                                                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                                        <label>
                                                                            <input type="checkbox" {{(isset($smtp) && $smtp->process_delivery_status == 1) || (!isset($smtp)) ? 'checked':''}}  name="pbounce_status" id="pbounce_status">
                                                                            <span></span>
                                                                        </label>
                                                                    </span>
                </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12 kt-radio-list" id="phBncBlk" style="display: {{isset($smtp) && $smtp->process_delivery_status==0 ? 'none;':''}}">
                @php
                    $pbounce = isset($smtp->process_delivery_reports) ? $smtp->process_delivery_reports : '';
                @endphp
                <label class="pbounceopt kt-radio" for="pbo2">
                    <input type="radio" name="pbounce" id="pbo2" value="WebHooks" checked="checked" {{ isset($pbounce) && $pbounce == 'WebHooks' ? 'checked' : 'checked="checked"' }}>
                    {{isset($config['web_hook_radio_btn_title'])?$config['web_hook_radio_btn_title'] :trans('sending_nodes.connectivity.sendgrid.form.webhooks_recommended')}}
                    <span></span>
                    {!! popover('sending_nodes.connectivity.sendgrid.form.webhooks_recommended_help','common.description') !!}
                </label>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-12" id="dtlBlk" style="display: {{isset($smtp) && $smtp->process_delivery_status==0 ? 'none;':''}}">
                <div class="pbo11 hide">
                    <h3 class="m-form__heading-title"></h3>
                    <p></p>
                </div>
                <div class="pbo22 show">
                    <h3 class="m-form__heading-title">
                        <?php
                        $actual_link = isset($config['hook_url']) ? $config['hook_url'] : null;
                        if(is_null($actual_link))
                        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]".'/callbacks/'.$config['esp_name'];
                        $input=' <div class="urldmn">
                                                                  <input type="text" title="'.trans('sending_nodes.connectivity.sendgrid.form.click_copy_button').'" id="copyurl" class="form-control" name="" value="'. $actual_link.'" readonly="" >
                                                                  <i class="fa fa-copy" onclick="copyFunction()" title="'.trans('common.label.click_copy').'"></i></div>';
                        ?>
                        {{isset($config['how_to_set_hook_heading'])? $config['how_to_set_hook_heading']:''}}
                    </h3>
                    {!! isset($config['how_to_set_hook_guide']) ? trans($config['how_to_set_hook_guide'],['input'=>isset($config['hook_link'])?$config['hook_link']:$input]) :''!!}
                @if($config['type']=='amazon')
                        <div class="form-group" id="pro3Blk">
                            <a id="confirm-sub-amazon" href="javascript:;" ><button type="button" id="process3" class="btn btn-info btn-sm" disabled="">{{trans('sending_nodes.connectivity.amazon.form.confirm_subscription')}}</button></a>
                        </div>
                        <div class="alert alert-info" id="amazonResponse" style="display: none;">
                            <div id="amazonRes"></div>
                            <div id="disc"></div>
                        </div>

                        <div class="form-group">
                            {{trans('sending_nodes.connectivity.amazon.form.you_are_all_set_now')}}
                        </div>
                        <div class="form-group">
                            <label class="col-form-label sbold pull-left col-md-12">{{trans('sending_nodes.connectivity.amazon.form.configuration_set_name')}}</label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="config_name" name="config_name" value="{{isset($apiCred) ? $apiCred['config_name'] : ''}}">
                                <span id="config_name-error" class="error invalid-feedback"></span>
                                <div class="form-text text-muted">
                                    {{trans('sending_nodes.connectivity.amazon.form.configuration_set_name_step4')}}
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
     @else
     @php
         $port = '';
         $smtp_host = '';
         $smtp_encryption = '';
         $type = $config['type'];
          if(!isset($smtp) && $type=='gmail') {
                                                                            $port = '587';
                                                                            $smtp_host = 'smtp.gmail.com';
                                                                            $smtp_encryption = 'tls';
                                                                        } elseif($type=='outlook') {
                                                                            $port = '587';
                                                                            //$smtp_host = 'smtp.live.com';
                                                                            $smtp_host = 'smtp-mail.outlook.com';
                                                                            $smtp_encryption = 'tls';
                                                                        } elseif($type=='yahoo') {
                                                                            $port = '587';
                                                                            $smtp_host = 'smtp.mail.yahoo.com';
                                                                            $smtp_encryption = 'tls';
                                                                        } elseif($type=='aol') {
                                                                            $port = '587';
                                                                            $smtp_host = 'smtp.aol.com';
                                                                            $smtp_encryption = 'tls';
                                                                        }
     @endphp
     <div class="form-group row">
         <div class="col-md-6 mb1">
             <label class="col-form-label">
                 {{trans('sending_nodes.add_new.form.host')}}
                 <span class="required"> * </span>
                 {!! popover('sending_nodes.add_new.form.host_help','common.description') !!}
             </label>
             <input id="host" type="text" name="host" class="form-control" value="{{isset($smtp) ? $smtp->host : $smtp_host }}" required />
             <small id="host-error" class="error invalid-feedback"></small>
         </div>
        <div class="col-md-6 mb1">
             <label class="col-form-label">
                 {{trans('common.label.username')}}
                 @if($config['type']!='smtp')<span class="required"> * </span>@endif
                     {!! popover('sending_nodes.add_new.form.username_help','common.description') !!}

             </label>
             <input type="text" name="username" id="username" class="form-control" value="{{isset($smtp->name) ? $smtp->username : '' }}"  required="required" >
             <small id="username-error" class="error invalid-feedback"></small>
        </div>
        <div class="col-md-6 mb1">
             <label class="col-form-label">
                 {{trans('common.label.password')}}
               @if($config['type']!='smtp')<span class="required"> * </span> @endif
                 {!! popover('sending_nodes.add_new.form.password_help','common.description') !!}
             </label>
             <input type="password" name="password" id="password" value="{{isset($smtp->password) && !empty($smtp->password) ? Crypt::decrypt($smtp->password) : '' }}" class="form-control" required>
             <small id="password-error" class="error invalid-feedback"></small>
        </div>

        <div class="col-md-6 custom-show mb1" >
             <label class="col-form-label">
                 {{trans('sending_nodes.add_new.form.port')}}
                 <span class="required"> * </span>
                 {!! popover('sending_nodes.add_new.form.port_help','common.description') !!}
             </label>
             <input type="number" id="port" name="port" class="form-control" value="{{isset($smtp) ? $smtp->port : $port }}" required />
             <small id="port-error" class="error invalid-feedback"></small>
         </div>
        <div class="col-md-6 custom-show mb1">
             <label class="col-form-label">
                 {{trans('common.label.encryption')}}
                 {!! popover('sending_nodes.add_new.form.encryption_help','common.description') !!}
             </label>
             <select class="form-control" name="smtp_encryption" id="smtp_encryption">
                 <option value="">{{trans('common.label.none')}}</option>
                 <option value="tls" {{ (isset($smtp->smtp_encryption) && $smtp->smtp_encryption == 'tls') ? 'selected': ((isset($smtp_encryption) && $smtp_encryption=='tls'?'selected':''))  }}>{{trans('common.label.tls')}}</option>
                 <option value="ssl" {{ (isset($smtp->smtp_encryption) && $smtp->smtp_encryption == 'ssl') ? 'selected' : ((isset($smtp_encryption) && $smtp_encryption=='ssl'?'selected':'')) }}>{{trans('common.label.ssl')}}</option>
             </select>
        </div>
        <div class="col-md-6  custom-show mb1" id="mail_encoding_div">
            <label class="col-form-label">
                {{trans('sending_nodes.add_new.form.mail_encoding')}}
                {!! popover('sending_nodes.add_new.form.mail_encoding_help','common.description') !!}
            </label>
                <select  id="mail_encoding" name="mail_encoding" class="form-control">
                <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'quoted-printable') ? 'selected' : '' }} value="quoted-printable" selected=""> {{trans('sending_nodes.add_new.form.quoted_printable')}} </option>
                <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == '8bit') ? 'selected' : '' }} value="8bit"> {{trans('sending_nodes.add_new.form.8bit')}} </option>
                <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'base64') ? 'selected' : '' }} value="base64"> {{trans('sending_nodes.add_new.form.base64')}} </option>
                <option {{ (isset($smtp->mail_encoding) && $smtp->mail_encoding == 'binary') ? 'selected' : '' }} value="binary"> {{trans('sending_nodes.add_new.form.binary')}} </option>
            </select>
        </div>
         <div @if(isset($smtp->smtp_encryption) && ($smtp->smtp_encryption == 'tls' || $smtp->smtp_encryption == 'ssl' ))  style="display:block;" @else @if($type=='smtp') style="display:none;" @endif @endif class="col-md-12 custom-show mt15" id="smtp_options">
             <div class="form-group smtp-ssl-option mb1">
                 <label class="col-form-label">
                     {{trans('sending_nodes.step_blade.self_signed_certificates_label')}}
                 </label>
                 <label for="allow_self_signed" class="kt-radio kt-radio--default">
                     <input type="radio" name="allow_self_signed" id="allow_self_signed" value="1" @if((isset($smtp->allow_self_signed) && $smtp->allow_self_signed == 1)) checked @endif> {{trans('sending_nodes.step_blade.yes_only_label')}}
                     <span></span>
                 </label>

                 <label for="allow_self_signed_no" class="kt-radio kt-radio--default">
                     <input type="radio" name="allow_self_signed" id="allow_self_signed_no" value="0" @if((isset($smtp->allow_self_signed) && $smtp->allow_self_signed == 0)  || Request::segment(3)=='add') checked @endif>{{trans('sending_nodes.step_blade.no_only_label')}}
                     <span></span>
                 </label>
             </div>
             <div class="form-group smtp-ssl-option mb1">
                 <label class="col-form-label">
                     {{trans('sending_nodes.step_blade.verify_peer_certificates_label')}} 
                 </label>
                 <label for="verify_peer" class="kt-radio kt-radio--default">
                     <input type="radio" name="verify_peer" id="verify_peer" value="1" @if((isset($smtp->verify_peer) && $smtp->verify_peer == 1)) checked @endif>{{trans('sending_nodes.step_blade.yes_only_label')}}
                     <span></span>
                 </label>
                 <label for="verify_peer_no" class="kt-radio kt-radio--default">
                     <input type="radio" name="verify_peer" id="verify_peer_no" value="0" @if((isset($smtp->verify_peer) && $smtp->verify_peer == 0)  || Request::segment(3)=='add') checked @endif>{{trans('sending_nodes.step_blade.no_only_label')}}
                     <span></span>
                 </label>
             </div>
             <div class="form-group smtp-ssl-option">
                 <label class="col-form-label">
                     {{trans('sending_nodes.step_blade.verify_peer_name_label')}} 
                 </label>
                 <label for="verify_peer_name" class="kt-radio kt-radio--default">
                     <input type="radio" name="verify_peer_name" id="verify_peer_name" value="1" @if((isset($smtp->verify_peer_name) && $smtp->verify_peer_name == 1)) checked @endif>{{trans('sending_nodes.step_blade.yes_only_label')}}
                     <span></span>
                 </label>
                 <label for="verify_peer_name_no" class="kt-radio kt-radio--default">
                     <input type="radio" name="verify_peer_name" id="verify_peer_name_no" value="0" @if((isset($smtp->verify_peer_name) && $smtp->verify_peer_name == 0)  || Request::segment(3)=='add') checked @endif >{{trans('sending_nodes.step_blade.no_only_label')}}
                     <span></span>
                 </label>
             </div>
         </div>
<!--             <div class="col-md-12">
                 <button type="button" class="btn btn-info" id="validate-smpt-send-mail">Validate</button>
                 <div id="validate-mail-sent-msg"></div>
                 <span id="validate-mail-sent-log-link" style="display: none;"><a href="javascript:;">
                                                                                Show Logs
                                                                            </a></span>
                 <div id="validate-mail-sent-log" style="display: none;"></div>
             </div>-->

     </div>
     <div class="form-group row">
         <div class="col-md-12">
             <div class="accordion accordion-solid accordion-toggle-plus" id="accordionExample6">
                 <div class="card">
                     <div class="card-header" id="headingOne6">
                         <div class="card-title collapsed" data-toggle="collapse" data-target="#collapseOne6" aria-expanded="false" aria-controls="collapseOne6">
                             <i class="flaticon2-copy"></i> {{isset($config['having_trouble']) ? $config['having_trouble']:''}}
                         </div>
                     </div>
                     <div id="collapseOne6" class="collapse" aria-labelledby="headingOne6" data-parent="#accordionExample6">
                         <div class="card-body">
                             {!! isset($config['card_body']) ? $config['card_body']:'' !!}
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>

 @endif

