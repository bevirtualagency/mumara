@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/license.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection
@section('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Settings/Licensing");

        $("#refresh").click(function() {
            location.href = '{{route('license')}}';
        });

        $("#keycheck").click(function() {
            if($("#key").val() == "") {
                $("#key").css("border-color", "red");
                $("#msger").show("");
                $("#msger").text("{{trans('settings.message.alert_licensing')}}");
                return false;
            }
            else {
                $(".blockUI").show();
               
               setTimeout(function(){
                    $(".blockUI").hide();
                    $(".success").fadeIn(1500);
                }, 2000);
               
               return true;

            }
        });
        $("#key").keydown(function() {
            $("#msger").hide("");
             $("#key").css("border-color", "#32c5d2");
        });
    });
</script>
@endsection
@section(decide_content())

@if((isset($whmcs_status) && $whmcs_status != 'Active' && $whmcs_status != 'Invalid'))
<div class="row" data-name="FsrILxNj">
    <div class="col-md-12" data-name="hKRygNAQ">
        <div class="alert alert-warning alert-button" data-name="NxedpLgh">
            
            <div class="alert-text lh25" data-name="dzhkeNyx">
                @if(config('app.type') == 'saas')
                    {{trans('settings.message.alert_license_key')}}
                    @else
                {!!trans('settings.message.alert_license_key')!!}
                @endif
                <a href="https://billing.mumara.com/clientarea.php" type="button" class="btn btn-warning btn-xs pull-right">@lang('settings.license.form.client_area')</a>
            </div>
        </div>
    </div>
</div>
@endif


@if((isset($whmcs_status) && $whmcs_status == 'Invalid'))
<div class="row" data-name="MIDGUiVK">
    <div class="col-md-12" data-name="tMIImEkM">
        <div class="alert alert-warning alert-button" data-name="jiwjjgAu">
            <div class="alert-text lh25" data-name="lHqeHbzx">
                @lang('settings.message.invalid_license_key')
                <a href="https://billing.mumara.com/clientarea.php" type="button" class="btn btn-warning btn-xs pull-right">@lang('settings.license.form.client_area')</a>
            </div>
        </div>
    </div>
</div>
@endif


<div class="row" style="display: none;" data-name="wpZUFDSv">
    <div class="col-md-6" data-name="qwVQfQOy">
        <div class="alert alert-warning alert-button" data-name="etdygAhA">
          
            <div class="alert-text lh25" data-name="OFNzCBdF">
                {{trans('settings.message.alert_unregistered')}}
                <a href="https://www.mumara.com/contact-us" type="button" class="btn btn-warning btn-sm pull-right">{{trans('settings.license.form.contact_us')}}</a>
            </div>
        </div>
    </div>
</div>


@if($licenseType != "selfhosted")
<div class="col-md-12" id="saasblock" data-name="ofOsxgIU">
    <div class="row" id="licActive" data-name="ygFZtHHv">
        <div class="kt-portlet kt-portlet--height-fluid" style="width: 100%;" data-name="TrAyhEUO">
            <div class="kt-portlet__head" data-name="xsrSMcvP">
                <div class="kt-portlet__head-label" data-name="vcIVySQI">
                    <h3 class="kt-portlet__head-title">{{trans('settings.license.form.license_activation')}}</h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="yjuWVOeo">
                <div class="row" data-name="pFLMjLLx">
                    <div class="col-md-12" data-name="wwTVEuHN">
                        <h2><b>{{trans('settings.license.form.licensed_to')}}:</b> {{$_SERVER['SERVER_ADDR']}} ({{ isset($host_name) ? ($host_name) : '' }}) </h2>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endif

@if($licenseType == "selfhosted")

<div class="col-md-12" id="selfblock" data-name="nhtaMROk">
    <div class="row" id="licActive" data-name="kEtYDrHe">
        <div class="kt-portlet kt-portlet--height-fluid" style="width: 100%;" data-name="DzbZWVAh">
            <div class="kt-portlet__head" data-name="FvdOiOcn">
                <div class="kt-portlet__head-label" data-name="yIvIHLtE">
                    <h3 class="kt-portlet__head-title">{{trans('settings.license.form.license_activation')}}</h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="erqQxFKC">
                <form action="" method="post" class="kt-form kt-form--label-right">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group row" style="display: flex" data-name="ZrygvudJ">
                        <label class="col-form-label col-md-3 text-right">{{trans('settings.license.form.license_key')}}
                        </label>
                        <div class="col-md-6" data-name="DErSUdpp">
                            <div class="input-icon right" data-name="btzpBhNt">
                                <input type="text" class="form-control" name="license-key" value="{{isset($license_key ) ? $license_key : '' }}" required />
                                <div id="msger" data-name="gQaBemZG"></div>
                            </div>
                        </div>
                        <button type="submit" name="submit" id="keycheck" class="btn btn-success">{{trans('common.form.buttons.update')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endif



<div class="col-md-12" data-name="tGcxkAye">
    <div class="row" id="stats" data-name="qyhqfmJL">
        <div class="kt-portlet kt-portlet--height-fluid" style="width: 100%;" data-name="MUqHjkKs">
            <div class="kt-portlet__body" data-name="JUdPVuJG">
                <div class="table-scrollable" data-name="cudvDspS">
                    <table class="table table-striped table-bordered table-hover">
                        <tbody>
                            <tr>
                                <td width="50%">{{trans('common.label.status')}}:</td>
                                <td width="50%">
                                    <label class="statusMsg {{(isset($whmcs_status) && $whmcs_status != 'Active') ? 'label-danger' : 'label-success'}}">{{(isset($whmcs_status)) ? $whmcs_status : 'Active'}} @if(!empty($invalid_reason)) ({{$invalid_reason}}) @endif</label>
                                    <span class="fresh-btn pull-right">
                                        <span class="referIcon"><i class="fa fa-refresh fa-spin"></i></span>
                                        <a href="{{ route('license')}}?refresh=1" class="btn btn-success btn-xs" id="refresh">{{trans('common.label.refresh')}}</a>
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{trans('settings.license.form.registeredto')}}:</td>
                                <td>{{isset($license_attributes->registeredname) ? $license_attributes->registeredname : ''}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('settings.license.form.license_type')}}</td>
                                <td>{{ ucfirst(config('app.type')) }}</td>
                            </tr>
                            @if(config('app.type') == "selfhosted")
                            <tr>
                                <td>{{trans('settings.license.form.license_key')}}:</td>
                                <td>{{$license_key}}</td>
                            </tr>
                            @endif
                            <tr>
                                <td>{{trans('settings.license.form.plan')}}:</td>
                                @if(isset($license_attributes->package))
                                    <td>{{isset($license_attributes->package) ? $license_attributes->package : ''}} <small>(<a class="kt-font-bold kt-font-info change-plan" href="https://billing.mumara.com">Change Plan</a>)</small></td>
                                @else
                                    <td>{{isset($license_attributes->productname) ? $license_attributes->productname : ''}} <small>(<a class="kt-font-bold kt-font-info change-plan" href="https://billing.mumara.com">Change Plan</a>)</small>)</td>
                                @endif
                            </tr>
                            <!-- <tr>
                                <td>Contacts Count / Limit:</td>
                                <td>45 / 1,000</td>
                            </tr> -->
                            @if(isset($license_attributes->productname))
                            
                            <tr>
                                <td>{{trans('settings.license.form.valid_domain')}}:</td>
                                <td>{{$_SERVER['HTTP_HOST']}}</td>
                            </tr>
                            <tr>
                                <td>{{trans('settings.license.form.valid_ip')}}:</td>
                                <td>{{$_SERVER['SERVER_ADDR']}}</td>
                            </tr>
                            @if($licenseType == "selfhosted")
                            <tr>
                                <td>{{trans('settings.license.form.valid_directory')}}:</td>
                                <td>{{base_path()}}</td>
                            </tr>
                            @endif
                            @endif
                            <tr>
                                <td>{{trans('settings.license.form.addons')}}:</td>
                                <td>
                                   <ul id="addon">
                                        @if(!empty($whmcs_addons) && isset($whmcs_addons))
                                            @if(!$selfhosted && 0)
                                                @foreach($whmcs_addons as $addon)
                                                    @if(!empty($addon['status']) && ($addon['status'] == 'Active'))
                                                        <li><span class="addonIcon"><i class="la la-check"></i></span> {{$addon['name']}}</li>
                                                    @else
                                                        @if(!empty($addon['name']))
                                                            <li><span class="addonIcon"><i class="la la-close"></i></span> {{$addon['name']}} <span class="cancelAddon">({{$addon['status']}})</span></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach($whmcs_addons as $addon)
                                                    @if(!empty($addon) && ($addon['status'] == 'Active'))
                                                        <li><span class="addonIcon"><i class="la la-check"></i></span> {{html_entity_decode($addon['name'],ENT_NOQUOTES)}}</li>
                                                    @else
                                                        @if(!empty($addon))
                                                            <li><span class="addonIcon"><i class="la la-close red"></i></span> {{html_entity_decode($addon['name'],ENT_NOQUOTES)}} <span class="cancelAddon"><!-- ({{ !empty($addon['status']) ? $addon['status'] : '' }}) --></span></li>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                            @if(isset($license_attributes->regdate))
                            <tr>
                                <td>{{trans('settings.license.form.created')}}:</td>
                                <td>{{Carbon\Carbon::parse($license_attributes->regdate)->format('Y-m-d') }}</td>
                            </tr>
                            @endif
                            @if(isset($license_attributes->nextduedate))
                            <tr>
                                <td>{{trans('settings.license.form.expires')}}:</td>
                                <td>
                                    @if($license_attributes->nextduedate != "0000-00-00")
                                        {{ Carbon\Carbon::parse($license_attributes->nextduedate)->format('Y-m-d') }}
                                    @else
                                        {{trans('settings.license.form.no_expiry')}}
                                    @endif
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection