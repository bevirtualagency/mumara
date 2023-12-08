@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/setting-domain.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Settings/Primary-Domain");

        $(".btn-file>.fileinput-new").text(" Change ");

        var primary_domain_counter = $("#primary_domain_counter_hidden").val();

        if(primary_domain_counter == 1){
            $("#savee_buttonn").hide();
            $("#edit_button").show();
            $("#close_button").hide();
        }else if(primary_domain_counter == 2 || primary_domain_counter == 3){
            $("#savee_buttonn").hide();
            $("#edit_button").show();
            $("#close_button").hide();
        }else{
            $("#savee_buttonn").hide();
             $("#edit_button").show();
            $("#close_button").hide();
        }
    });

    function removeDisabledAttr() {

        $("#primary_domain").removeAttr('disabled');
        $("#edit_button").hide();
        $("#savee_buttonn").show();
        $("#close_button").show();

    }

    function closeEditing() {
        $("#primary_domain").attr('disabled', 'disabled');
        $("#edit_button").show();
        $("#savee_buttonn").hide();
        $("#close_button").hide();
    }

    function confirmDomain() {

        var domain = $("#primary_domain").val();

        $.ajax({
            url: "{{ url('/') }}"+'/setting/confirm/domain/'+domain,
            type: 'GET',
            success: function(data) {
                if(data == 'confirm'){
                    Command: toastr["success"] ("{{trans('settings.message.primary_domain_success')}}");
                }else{
                //    Command: toastr["error"] ("{{trans('settings.message.primary_domain_failed')}}");
                }
              window.location.reload()
            }
        });

    }
</script>
@endsection

@section(decide_content())


@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="FDSGscCV">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<!-- will be used to show any messages -->
@if (Session::has('msg'))
    <div class="alert alert-success" data-name="PCmOcLrY">
        {{ Session::get('msg') }}
    </div>
@endif

@if (Session::has('error'))
    <div class="alert alert-danger" data-name="gPrHLuqY">
        {{ Session::get('error') }}
    </div>
@endif

<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="ztfrxgiv">
    <span id='msg-text'><span>
</div>

<!-- BEGIN WIZARD-->

<div class="tab-pane active" id="tab2" data-name="RyrphUTS">
    <div class="dataTables_wrapper no-footer" data-name="PLQUVJqI">
        <div class="row" data-name="BtFzIDvu">
            <div class="col-md-6 create-form" data-name="dHoySauq">
                <form action="{{ route('setting.primary.domain') }}" id="primary_domain_form" method="POST" class="kt-form kt-form--label-left">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="form_type" value="primary_domain_settings">
                    <div class="kt-portlet kt-portlet--height-fluid" data-name="bsaaKOCa">
                        <div class="kt-portlet__head" data-name="JGlVNdEj">
                            <div class="kt-portlet__head-label" data-name="WQIDpDwC">
                                <h3 class="kt-portlet__head-title">
                                    {{trans('settings.primary_domain.form.heading')}}
                                </h3>
                            </div>
                            <div class="kt-portlet__head-toolbar" data-name="wfQRMCmN"> <!-- id="dnscheck" -->
                                <button type="button" class="btn btn-default" onClick="confirmDomain()">{{trans('settings.primary_domain.form.recheck')}}</button>
                            </div>
                        </div>
                        <div class="kt-portlet__body" data-name="PIsnGJel">
                            <div class="form-body" data-name="QHUBQMLp">
                                <div class="form-group row" data-name="IgnvYsrO">
                                    <div class="dmnTitle" data-name="UvjaffMG">
                                       <label class="col-md-12">
                                            <h2>{{trans('settings.primary_domain.page.title')}}</h2>
                                            <p>{{trans('settings.primary_domain.page.desc')}}</p>
                                        </label>
                                    </div>
                                    <div class="col-md-9" data-name="QQDFqMrE">
                                        <div class="input-group" data-name="KdTHZzyf">
                                            <input type="text" placeholder="example.com" name="primary_domain" id="primary_domain" value="{{ isset($primary_domain) && !empty($primary_domain) ? $primary_domain : '' }}" {{ isset($primary_domain) ? 'disabled' : '' }} class="form-control"/>
                                            <input type="hidden" id="primary_domain_counter_hidden" value="{{ $primary_domain_counter }}"> 
                                            <span class="input-group-append"> 
                                                <span class="input-group-text">
                                                @php

                                                if(!empty($primary_domain) && $primary_domain_counter == 1) {

                                                    echo '<i class="fa fa-question fa-2x text-warning"></i>';

                                                }

                                                else if(!empty($primary_domain) && $primary_domain_counter == 2) {

                                                    echo '<i class="fa fa-check fa-2x text-success"></i>'; 

                                                }

                                                else if(!empty($primary_domain) && $primary_domain_counter == 3) {

                                                    echo '<i class="fa fa-times fa-2x text-danger"></i>';

                                                }

                                                else {

                                                }

                                                @endphp
                                                </span>
                                            </span>
                                        </div>
                                    </div>


                                    @if(config('app.type') !="demo")
                                    <button type='button' class='btn btn-success btn-chk' id='edit_button' name='edit' onClick='removeDisabledAttr()'><i class='la la-edit'></i></button>
                                      

                                    <button type="submit" class="btn btn-success btn-chk" id="savee_buttonn" name='submit'><i class="la la-save"></i></button>

                                    <button type='button' class='btn btn-danger btn-chk' id='close_button' name='close' onClick='closeEditing()'><i class='la la-close'></i></button>
                                    @endif

                                </div>

                                @php

                                    if(!empty($primary_domain)) {

                                @endphp

                                <div class="row" data-name="rZkrKgbJ">
                                    <div class="col-md-12" data-name="QquBMHDK">
                                        <div class="contentBlk1 contentBlk" data-name="YvqNyaOQ">
                                            <h2>{{trans('settings.primary_domain.form.add_a_record')}}</h2>
                                            <div class="content" data-name="WkvBHqMq">@lang('settings.primary_domain.form.login_to_dns_zone',['domain'=>$primary_domain])</div>
                                        </div>

                                        <table class="table table-striped table-hover table-checkable responsive" id="dSetting2">
                                            <thead>
                                                <tr>
                                                    <th width="30%"> {{trans('common.label.host')}} </th>
                                                    <th> {{trans('common.label.type')}} </th>
                                                    <th> {{trans('common.label.value')}} </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="cnm" style="">
                                                    <td>
                                                        <div class="option rh30" data-name="rxFpQLub">
                                                            <div class="domaintrack" data-name="NybrVCEl">
                                                                {{ $primary_domain }}
                                                            </div>

                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="option" data-name="QBaQGRuj">
                                                            {{trans('settings.primary_domain.form.a_record')}}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="option" data-name="nCSaoysW">
                                                            @php
                                                                echo "{$_SERVER['SERVER_ADDR']}";
                                                            if(isset($ip) && $ip == $_SERVER['SERVER_ADDR']) {
                                                            }
                                                            @endphp
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="form-group row mb0" data-name="DMjOUiOp">
                                    <div class="col-md-12" data-name="vfPnenHw">
                                        <span id='confirm-button'>

                                            @if($primary_domain_counter == 1)

                                            <button type="button" class="btn btn-success" id="confirm_button" onClick="confirmDomain()">{{trans('common.label.confirm')}}</button>

                                            @endif

                                        </span>
                                    </div>
                                </div>

                                @php

                                    }

                                @endphp

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection