@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/drip-group-create.css??v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style>
.kt-portlet.kt-portlet--height-fluid.scroll.scroll-300 {
    min-height: 300px;
}
.form-group[data-name="eoROhNDn"] {
    margin-bottom: 15px;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/autorespondergroups.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
    $(document).ready(function() {
        $(".m-select2").select2({
            placeholder: 'Select Option',
            templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });
    });

    <?php if(isset($meta_data->listed_in_list) && $meta_data->listed_in_list == "on") { ?>
        setTimeout(() => {
            $("#listed_in_list").trigger("click");
        }, 1000);
       
    <?php } ?>
    
    // load from name, from email, bounce email and reply-to email data
    function loadData (val) {
        if (val == 'from_list') {
            <?php if(!empty($meta_data->listed_in_smtp)) {  ?>
                $("#listed_in_list").prop('checked', true);
                $("#from-name").hide();
                $("#from_name").removeAttr('required');
           <?php } else {  ?>
                $("#listed_in_list").removeAttr('checked');
                $("#from-name").show();
            <?php } ?>
                $('.listed_in_list').show();
                $('.listed_in_smtp').hide();
                $('.checkBlk').show();
                $('.custom-data').hide();
                $('.custom-data input').attr("disabled", "disabled");
                $('.custom-data select').attr("disabled", "disabled");
        } else if (val == 'from_smtp') {
            <?php if(!empty($meta_data->listed_in_smtp)) {  ?>
                $("#listed_smtp").prop('checked', true);
                $("#from-name").hide();
               
                $("#from_name").removeAttr('required');
                
           <?php } else {  ?>
                $("#listed_smtp").removeAttr('checked');
                $("#from-name").show();
            <?php } ?>
                $('.listed_in_smtp').show();
                $('.listed_in_list').hide();
                $('.checkBlk').show();
                $('.custom-data').hide();
                $('.custom-data input').attr("disabled", "disabled");
                $('.custom-data select').attr("disabled", "disabled");
        } else if (val == 'custom') {
                $("#listed_smtp").attr('checked');
                $('.listed_in_list').hide();
                $('.listed_in_smtp').hide();
                $('.checkBlk').hide();
                $('.custom-data').show();
                $('.custom-data input').removeAttr("disabled");
                $('.custom-data select').removeAttr("disabled");
                $("#from-name").show();
        }
    }
    var selected_data = $("input[name='sender_information']:checked").val()
    loadData(selected_data);

   // switch from name
    $('#listed_in_list').click(function() {
        if($(this).is(":checked") == true) {
            $("#from-name").slideUp();
            $("#from-name").val('');
            $("#from_name").removeAttr('required');
        } else {
            $("#from-name").slideDown();
            $("#from-name").val('');
        }
    });
   
    $("#listed_smtp").click(function() {
        if($(this).is(":checked") == true) {
            $("#from-name").slideUp();
            $("#from-name").val('');
            $("#from_name").removeAttr('required');
        } else {
            $("#from-name").slideDown();
            $("#from-name").val('');
        }
    });
</script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="sQIjiKou">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="gGMJGmDb">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="sJLoXXbR">
    <span class='alert-text' id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="YBQrYyNx">
    @if ($page_data['action'] == 'add')
        <form action="{{ route('drips.group.store') }}" method="POST" id="submit-frm" class="kt-form kt-form--label-right">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else  
        <form action="{{ route('drips.group.update', $autoresponder_group->id) }}" method="POST" id="submit-frm" class="kt-form kt-form--label-right">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="groups-id" value="{{$autoresponder_group->id}}">
        <input type="hidden" name="_method" value="PUT">
        @if(isset($meta_data->campaigns))
            <input type="hidden" id="campaign-type" value="{{$meta_data->campaigns}}">
        @endif
        @if(isset($meta_data->campaigns_ids))
            <input type="hidden" id="campaign-ids"  value="{{implode(",",$meta_data->campaigns_ids)}}">
        @endif
        @if(isset($meta_data->links_clicked))
            <input type="hidden" id="links"  value="{{implode(",",$meta_data->links_clicked)}}">
        @endif
    @endif

        <div class="row" data-name="fXAywxSL">

            <div class="kt-portlet kt-portlet--height-fluid" data-name="ZIOLtDCH">
                <div class="kt-portlet__head" data-name="sLGSHJfU">
                    <div class="kt-portlet__head-label" data-name="HRrFzNjn">
                        <h3 class="kt-portlet__head-title">{{trans('drip_campaigns.groups.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="WmcXgXeQ">
                    <div class="form-body" data-name="NzBoAVdm">
                        <!-- Group -->
                        <div class="form-group row" data-name="TMUqqCIo">
                            <div class="col-md-12" data-name="IVCZsWta">
                                <label class="col-form-label">{{trans('common.label.group')}}
                                    <span class="required"> * </span>
                                     {!! popover( 'common.label.group_help','common.description' ) !!}
                                </label>
                                <input type="text" name="name" value="{{isset($autoresponder_group->name) ? $autoresponder_group->name : '' }}" class="form-control" />
                            </div>
                        </div>
                        <!-- Group -->

                        <!-- sending nodes -->
                        <div class="form-group row" id="smtp-blk" data-name="eoROhNDn">
                            <div class="col-md-12" data-name="jywixsjj">
                                <label class="col-form-label">{{trans('drip_campaigns.groups.add_new.form.smtp_list')}}
                                    <span class="required"> * </span>
                                    {!! popover( 'drip_campaigns.groups.add_new.form.smtp_list_help','common.description' ) !!}
                                </label>
                                <div class="kt-portlet kt-portlet--height-fluid scroll scroll-300" data-name="OMWfaWeX">
                                    <div class="kt-portlet__body smtpList" data-name="MCpIGcYM">
                                        @foreach ($smtp_tree as $group_metadata)
                                            @if(!empty($group_metadata['children']))
                                            <div class="kt-checkbox-list" data-name="exLCMCBv">
                                                <label class="kt-checkbox parentList" for="{{ $group_metadata['id'] }}">
                                                    <input class="group-selector-subscriber" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group[]"> {{ $group_metadata['name'] }}
                                                    <span></span>
                                                </label>
                                            </div>
                                            @endif
                                            @foreach ($group_metadata['children'] as $smtp_metadata)
                                                @if(empty($group_metadata['children']))
                                                <div style="padding-left: 20px;" data-name="koGRRSmm">
                                                    <span class="text-danger">{{trans('drip_campaigns.message.no_smtp_is_selected')}}</span>
                                                </div>
                                                @else
                                                <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="xSlNFdae">
                                                    <label for="group-subscriber-{{ $smtp_metadata['id'] }}" class="kt-checkbox childList">
                                                        <input type="checkbox" id="group-subscriber-{{ $smtp_metadata['id'] }}" value="{{ $smtp_metadata['id'] }}" name="smtp_lists[]" class="form-control group-subscriber-{{ $group_metadata['id'] }}" {{ isset($meta_data->smtp_lists) && in_array($smtp_metadata['id'], $meta_data->smtp_lists) ? 'checked' : '' }}> {{ $smtp_metadata['name'] }} 
                                                        <span></span>
                                                    </label>
                                                </div>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                                <div id="sn-error" class="">{{trans('common.error.single_check')}}</div>
                            </div>
                        </div>
                        <!-- sending nodes -->

                        <!-- Track Opens -->
                        <div class="form-group" data-name="biLttlxX">
                            <div class="col-md-12 row" data-name="uOQJrDyQ">
                                <label class="col-form-label col-md-4">{{trans('common.label.track_opens')}}
                                    {!! popover( 'drip_campaigns.groups.add_new.form.track_opens_help','common.description' ) !!}
                                </label>
                                @if(isset($meta_data->track_opens))
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" checked="checked" name="track_opens" {{ trackingStatus() }}>
                                        <span></span>
                                    </label>
                                </span>
                                @else
                                <div class="col-md-4" data-name="HkxazKkF">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="track_opens" {{ trackingStatus() }}>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- Track Opens -->

                        <!-- Track Clicks  -->
                        <div class="form-group" data-name="wCesKVTt">
                            <div class="col-md-12 row" data-name="iPUXlkfx">
                                <label class="col-form-label col-md-4">{{trans('common.label.track_clicks')}}
                                    {!! popover( 'drip_campaigns.groups.add_new.form.track_clicks_help','common.description' ) !!}
                                </label>
                                @if(isset($meta_data->track_clicks))
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" checked="checked" name="track_clicks" {{ trackingStatus() }}>
                                        <span></span>
                                    </label>
                                </span>
                                @else
                                <div class="col-md-4" data-name="xiRrSpcB">
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="track_clicks" {{ trackingStatus() }}>
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- Track Clicks  -->

                        <!-- Insert Unsubscribe Link -->
                        <div class="form-group" data-name="dZQfDdqc">
                            <div class="col-md-12 row" data-name="hKoYsJFg">
                                <label class="col-form-label col-md-4">{{trans('common.label.embed_unsubscribe_link')}}
                                    {!! popover( 'drip_campaigns.groups.add_new.form.unsubscribe_link_help','common.description' ) !!}
                                </label>
                                @if(isset($meta_data->unsubscribe))
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" checked="checked" name="unsubscribe">
                                        <span></span>
                                    </label>
                                </span>
                                @else
                                <div class="col-md-4" data-name="NZEosLYA">
                                     <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="unsubscribe">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <!-- Insert Unsubscribe Link -->

                        <?php 
                        $allow_sending_email_unconfirmed = getSetting("allow_sending_email_unconfirmed");
                        
                        if($allow_sending_email_unconfirmed  != "on") { 
                        ?>
                        <!-- Insert Unsubscribe Link -->
                        <div class="form-group" data-name="oakhllFh">
                            <div class="col-md-12 row" data-name="pZctyQne">
                                <label class="col-form-label col-md-4">{{trans('schedule_broadcast.add_new.tab4.form.skip_unconfirmed')}}
                                    {!! popover( 'schedule_broadcast.add_new.tab4.form.skip_unconfirmed_desc','common.description' ) !!}
                                </label>
                                @if(isset($meta_data->skip_unconfirmed))
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" checked="checked" name="skip_unconfirmed">
                                        <span></span>
                                    </label>
                                </span>
                                @else
                                <div class="col-md-4" data-name="dgyZlfYm">
                                     <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="skip_unconfirmed">
                                            <span></span>
                                        </label>
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <?php } else { ?>

                            <input style="display:none" type="checkbox" checked name="skip_unconfirmed" id="skip_unconfirmed">
                        <?php } ?>
                        <!-- Insert Unsubscribe Link -->
                        <?php 
                        $package = \App\Package::where("id" , Auth::user()->package_id)->first();
                        $sending_node_p = true; 
                        $form_list_p = true; 
                        $custom_p = true;
                        $sending_options = array();
                        if(!empty($package)) { 
                            $sending_options = json_decode($package->sending_options, true);
                        }
                        if(!empty($sending_options) and empty($sending_options["sending_node"])) { 
                            $sending_node_p = false;
                        }
                        if(!empty($sending_options) and empty($sending_options["form_list"])) { 
                            $form_list_p = false;
                        }
                        if(!empty($sending_options) and empty($sending_options["custom"])) { 
                            $custom_p = false;
                        }

                        $sending_info_options = getSetting("sending_info_options");
                        $sender_information  = "smtp";
                        $smtpChecked = "checked";
                        $listChecked = "";
                        $customChecked = "";

                        if($sending_info_options == "contact_list") { 
                            $listChecked = "checked";
                        }
                        if($sending_info_options == "custom") { 
                            $customChecked = "checked";
                        }

                      
                        if(isset($meta_data->sender_information) && $meta_data->sender_information == "from_smtp") {
                            if($sending_node_p) { 
                                $smtpChecked = "checked";
                                $listChecked = "";
                                $customChecked = "";
                            } 
                        } 
                        if(isset($meta_data->sender_information) && $meta_data->sender_information == "from_list") {
                            if($form_list_p) { 
                                $smtpChecked = "";
                                $listChecked = "checked";
                                $customChecked = "";
                            } 
                        } 
                        if(isset($meta_data->sender_information) && $meta_data->sender_information == "custom") {
                            if($custom_p) { 
                                $smtpChecked = "";
                                $listChecked = "";
                                $customChecked = "checked";
                            } 
                        } 
                        if(isset($meta_data->sender_information)) {
                        ?> 
        
                        <script> 
                        $(function() { 
                            loadData("<?php echo $meta_data->sender_information; ?>");
                        });
                            
                        </script>
                        <?php } ?>


                        <!-- Sender Information  -->
                        <div class="form-group row" data-name="gHfjRjWS">
                            <div class="col-md-12" data-name="EbAvoMfL">
                                <label class="col-form-label">
                                    {{trans('drip_campaigns.groups.add_new.form.sender_info')}}
                                    {!! popover( 'drip_campaigns.groups.add_new.form.sender_info_help','common.description' ) !!}
                                </label>
                                <div class="kt-radio-inline" data-name="KlmUhVYd">
                                    @if($sending_node_p)
                                    <label class="kt-radio" for="smtp">
                                        <input type="radio"  name="sender_information" value="from_smtp" id="smtp" onclick="loadData('from_smtp')" {{ $smtpChecked }}> {{trans('common.label.from_smtp')}}
                                        <span></span>
                                    </label>
                                    @endif
                                    @if($form_list_p)
                                    <label class="kt-radio" for="list">
                                        <input type="radio"  name="sender_information" id="list" value="from_list" onclick="loadData('from_list')" {{ $listChecked }}> {{trans('common.label.from_list')}} <span></span>
                                        <span></span>
                                    </label> 
                                    @endif
                                    @if($custom_p)
                                    <label class="kt-radio" for="custom">
                                        <input type="radio"  name="sender_information" value="custom" id="custom" onclick="loadData('custom')" {{ $customChecked }}> {{trans('common.label.custom')}}
                                        <span></span>
                                    </label>
                                    @endif
                                </div>
                            </div>

                        </div>
                     
                        <div class="form-group row checkBlk" data-name="SaKEPkZz">
                            <div class="col-md-6 listed_in_list" style="display: none;" data-name="dtcQsyLL">
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success" style="margin-top:0 !important">
                                    <label>
                                        <input type="checkbox"  id="listed_in_list" name="listed_in_list" >
                                        <span></span>
                                    </label>
                                </span>
                                <label for="listed_in_list" class="col-form-label col-md-10 text-link">
                                    {{trans('drip_campaigns.groups.add_new.form.choose_from_name_as_listed_in_list')}} 
                                </label>
                            </div>
                            <div class="col-md-6 listed_in_smtp" data-name="hhBNcCPE">
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success" style="margin-top:0 !important">
                                    <label>
                                        <input type="checkbox"  id="listed_smtp" name="listed_in_smtp">
                                        <span></span>
                                    </label>
                                </span>
                                <label class="col-form-label col-md-10 text-link" for="listed_smtp">{{ trans('drip_campaigns.groups.add_new.form.choose_from_name_as_listed_in_smtp') }}</label>
                            </div>
                        </div>

                        <div class="form-group row mb0" data-name="uxXaEvqh">
                            <div class="col-md-6" id="from-name" style="display: none;" data-name="TRjzDplo">
                                <label class="col-form-label">
                                    {{trans('common.label.from_name')}} 
                                    <span class="required"> * </span>
                                     {!! popover('common.label.from_name_help','common.description') !!}
                                </label>
                                <input type="text" required="" name="from_name" value="{{isset($meta_data->from_name) ? $meta_data->from_name : '' }}" class="form-control" id="from_name" />
                            </div>
                            <?php 
                                $form_name = "";
                                $from_domain = "";
                                if(!empty($meta_data->from_email)) { 
                                    $from_email = explode("@" , $meta_data->from_email);
                                    $from_name = !empty($from_email[0]) ? $from_email[0] : "";
                                    $from_domain = !empty($from_email[1]) ? $from_email[1] : "";
                                }
                            ?>
                            <div class="col-md-6" data-name="sUVXMwOX">
                                <div class="form-group custom-data row ownermail mb0" data-name="UaakqzLe">
                                    <div class="col-md-12" data-name="yWPUDUAJ">
                                        <label class="col-form-label">{{trans('common.label.from_email')}} <span class="required"> * </span> 
                                            {!! popover('common.label.from_email_help','common.description') !!}
                                        </label>
                                        <div class="row from-email" data-name="jzfGCJmd">
                                            <div class="col-md-5 email-part" data-name="vaaFtmHA">
                                                <div class="input-group" data-name="jzcJwiFp">
                                                    <input type="text" name="from_email" value="{{isset($from_name) ? $from_name : '' }}" class="form-control"/>
                                                    <div class="input-group-append" data-name="sjyLoScQ"><span class="input-group-text" id="basic-addon2">@</span></div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 domain-part" data-name="szDWgiWi">
                                                <select class="form-control m-select2" name="from_email_domain">
                                                    <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); ?>
                                                    @php $disableFlag = 0; @endphp
                                                    <optgroup label="{{trans('lists.eligible_domains')}}"> 
                                                    @foreach($domains as $domain)
                                                    @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                        <option {{ (isset($from_domain) && $from_domain == $domain->domain) ? 'selected' : '' }} value="{{ $domain->domain }}" ><?php echo $domain->domain;?></option>
                                                    @else 
                                                        @php 
                                                            $disableTxt = "inactive";
                                                            if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                            if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                        
                                                        @endphp
                                                        @php $disableFlag = 1; @endphp    
                                                    @endif
                                                    @endforeach
                                                    </optgroup>
                                                    @if($disableFlag)
                                                    <optgroup label="{{trans('lists.ineligible_domains')}}"> 
                                                    @foreach($domains as $domain)
                                                    @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                        
                                                    @else 
                                                        @php 
                                                            $disableTxt = "inactive";
                                                            if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                            if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                        
                                                        @endphp
                                                        <option disabled {{ (isset($from_domain) && $from_domain == $domain->domain) ? 'selected' : '' }} value="{{ $domain->domain }}" ><?php echo $domain->domain;?> <small>({{$disableTxt}}) </small></option> 
                                                                                            
                                                    @endif
                                                    @endforeach
                                                    </optgroup>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb0" data-name="UtSfdnBz">
                            <?php 
                                $license_attributes = json_decode(getSetting("license_attributes"), true);
                                $license_type = "";
                                if(!empty($license_attributes["package"])) { 
                                    $license_type = $license_attributes["package"];
                                }
                                $imap_switch = getApplicationSettings('imap_switch');
                                if($license_type != "Commercial ESP" OR $imap_switch != 2) { 
                            ?>
                            <div class="col-md-6 custom-data" style="display: none;" data-name="xXXMwsUk">
                                <label class="col-form-label">{{trans('common.label.bounce_email')}} <span class="required"> * </span>
                                    {!! popover('common.label.bounce_email_help','common.description') !!}
                                </label>
                                <select class="form-control m-select2" data-placeholder="{{trans('app.campaigns.groups.add.bounce_email_placeholder')}}" disabled="" name="bounce_email">
                                    @foreach($bounce_emails as $bounce)
                                        <option value="{{ $bounce->name }}" {{ (isset($meta_data->bounce_email) && $meta_data->bounce_email == $bounce->name) ? 'selected' : '' }}>{{ $bounce->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <?php } ?>

                            <div class="col-md-6 custom-data" style="display: none;" data-name="OKJKXjti">
                                <label class="col-form-label">{{trans('common.label.reply_email')}} <span class="required"> * </span>
                                    {!! popover('common.label.reply_email_help','common.description') !!}
                                </label>
                                <input type="email" name="reply_email" disabled="" value="{{isset($meta_data->reply_email) ? $meta_data->reply_email : '' }}" class="form-control"/>
                            </div>
                        </div>
                        <div id="domains_name" style="display: none;" data-name="ZWqHfNiD">
                            <div class="form-group row" data-name="grOtINHm">
                                    
                                <div class="col-md-6" data-name="HmYqBmAp">
                                    <label class="col-form-label">{{trans('drip_campaigns.groups.add_new.form.domain')}}
                                        <span class="required"> * </span>
                                    </label>
                                    <select class="form-control m-select2" data-placeholder="Select Option" name="masking_domain">
                                        @foreach($domains as $domain)
                                            <option value="{{ $domain->id }}" {{ (isset($meta_data->masking_domain) && $meta_data->masking_domain == $domain->id) ? 'selected' : '' }}>{{ $domain->domain }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="fUbiERnR">
                    <div class="row" data-name="jNfHbWmY">
                        <div class="col-md-12 col-sm-12 action-buttons" data-name="cQEQzsIN">
                            <!-- save & add new -->
                            <button type="submit" name="save_add" class="btn btn-success" value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                            @if ($page_data['action'] == 'add')
                            <!-- save & exit -->
                            <button type="submit" name="save_exit" class="btn btn-success" value="save_exit">{{trans('common.form.buttons.save_exit')}}</button>
                            @else
                            <!-- save -->
                            <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                            @endif
                            <!-- cancel -->
                            <a href="{{ route('drips.group.view') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- END FORM-->
@endsection