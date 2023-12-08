@extends(decide_template())

@section('title', trans('lists.add_new.page.title'))

@section('page_styles')

<link href="/resources/assets/css/list-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<link href="/themes/default/css/jquery.nestable.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .dd-handle, .dd3-content {
        -webkit-border-radius: 0px;
        border-radius: 0px;
    }
    .dd3-content .kt-checkbox, .dd3-content .mt-radio {
        margin-bottom: 0;
    }
    .dd3-content .kt-checkbox-list, .dd3-content .mt-radio-list {
        padding: 0;
    }
    .dd3-content {
        height: 34px;
    }
    .dd3-handle {
        width: 34px;
        background: #eee;
    }
    .dd-handle {
        height: 34px;
    }
    .dd3-handle:before {
        content: '≡';
        top: 6px;
        color: #999;
    }
    .dd3-content .kt-checkbox-list {
        padding-left: 9px;
        margin-top: 1px;
    }
    .dd3-content {
        margin: 7px 0;
        background: #f9f9f9;
    }
    .btn {
        min-width: 80px;
    }
    form#frm_export_segemnt h3 {
        margin-bottom: 5px;
    }
    @media (min-width: 992px) {
        .page-content-wrapper .page-content {
            min-height: 780px;
            overflow-x: hidden;
        }
    }
    .kt-checkbox-list {
        padding: 0;
        padding-left: 10px;
    }
    .kt-checkbox-list .kt-checkbox:last-child {
        margin-bottom: 0;
        margin-top: 1px;
    }
    @media (max-width:767px) {
        .kt-checkbox-list .kt-checkbox {
            display: block;
            white-space: normal;
            word-break: break-word;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }
        .dd3-content {
            height: auto;
            display: flow-root;
            min-height: 34px;
        }
    }
    #nestable_list_campaign {
        width: 100%;
        max-height: 470px;
        overflow: hidden;
        overflow-y: scroll;
        overflow-y: overlay;
    }
    #nestable_list_campaign::-webkit-scrollbar {
        width: 5px;
        height: 5px;
    }
    ::-webkit-scrollbar-button {
        display: none;
    }
    #nestable_list_campaign::-webkit-scrollbar-thumb {
        background: #bcbcbc;
        border-radius: 0px;
    }
    #nestable_list_campaign::-webkit-scrollbar-track {
        border-radius: 0px;
        background: #eaeaea;
    }
    a.btn-cancel {
        min-width: 20px;
    }
    .col-md-12.p-0, .col-md-9.p-0, .col-md-8.p-0, .col-md-6.p-0 {
        padding: 0;
    }
    .col.p-0 {
        padding: 0;
    }
    .kt-heading.kt-heading--md {
        margin-bottom: 10px;
    }
</style>
@section('page_scripts')
    <script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/select2.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
    <script src="/themes/default/js/init.js" type="text/javascript"></script>
    <script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
    <script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
    <script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>
    <script src="/themes/default/js/lib.js" type="text/javascript"></script>
    <script src="/themes/default/js/jquery.input.js" type="text/javascript"></script>
    <script src="/themes/default/js/repeater.js" type="text/javascript"></script>
    <script>
        var form_error="{{trans('common.message.form_error')}}";
        var groups_msg="{{trans('common.message.groups_created')}}";
    </script>
    <?php $canSeeContacts = routeAccess('contact.index');
    ?>
    @include('list.scripts')
    <script src="/themes/default/js/jquery.nestable.js" type="text/javascript"></script>
    <script type="text/javascript">
        function forceFullyChecked(){
            $("#cus_contact").attr('checked',true);
        }
        $(document).ready(function() {
            $("#owner_email_part2").select2({dropdownCssClass : 'bigdrop'});
            $("a#help-article").css("display", "block");
            $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Lists/Add-Contact-List");
            $(".m-select2").select2();
            $("#sync_fields").click(function() {
                if($(this).prop("checked") == true){
                    $(".check-contact-message").slideDown();
                }
                else if($(this).prop("checked") == false){
                    $(".check-contact-message").slideUp();
                }
            });
            $(document).on("click",".customField",function(){
                
            });
            
            $('#addistional-fields').change(function(){
                $(".custom").hide();
                $('.custimCheckBox').attr('disabled',true);
                var selectIds = $(this).val();
                if(selectIds.length > 0){
                    $.each( selectIds, function( key, value ) {
                        $("#cus_li_"+value).show();
                        $('#cus_'+value).attr('disabled',false);
                    });
                }
                
            });           
                        
            /*$("#addistional-fields").change(function(){
                 var selectedCountry = ($(this).select2('val'));
                //var selectedCountry = $(this).children("option:selected").html();
                console.log(selectedCountry);
            });
            */
        });
        function addFieldToVisibel(selectValues){
            /*var html = '';
            if(selectValues.length > 0){
                $.each( selectValues, function( key, value ) {
                    html + ='<li class="dd-item dd3-item customValue" data-id="country" id="li_'+value+'">';
                        html + ='<div class="dd-handle dd3-handle"> </div>';
                        html + ='<div class="dd3-content">';
                            html + ='<div class="kt-checkbox-list">';
                                html + ='<label class="kt-checkbox kt-checkbox-outline">';   
                                    html + ='<input type="checkbox" value="country" id="group_name_'+value+'" name="custome_fields[]">';
                                    html + = value
                                    html + ='<span></span>';
                                html + ='</label>';    
                            html + ='</div>';
                        html + ='</div>';
                    html + ='</li>';
                });
                $(".customValue").remove();
                $(html).insertBefore("#customFieldHidden");
            }
            */
        }
        /*<li class="dd-item dd3-item" data-id="country">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input type="checkbox" value="country" id="group_name" name="custome_fields[]" checked="">
                                                    {{ trans('lists.add_new.form.country') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>*/
        function getCustomFieldOrder() {
            var idsInOrder = [];
            var idsInOrderAll = [];
            $("ol#sortable li").each(function () {
                var data_id = $(this).attr('data-id');
                if($("#cus_"+data_id).is(":checked")){
                    idsInOrder.push($(this).attr('data-id'));
                }
               // idsInOrderAll.push(data_id);
                //console.log(data_id);
            });
            $("#custom_field_order").val(idsInOrder);
            $('input:checkbox.sortingColums').each(function () {
                ///var sThisVal = (this.checked ? $(this).val() : "");
                var ChechBoxId = $(this).attr("id");
                
                if($("#"+ChechBoxId).is('[disabled]')){
                    
                }else{
                    // console.log($(this).val());
                    idsInOrderAll.push($(this).val());
                    ///idsInOrderAll.push($("#"+idsInOrderAll).val());
                }
                /*if(!$(ChechBoxId+'#').is(':disabled')){
                    console.log( $(this).val());
                }
                */
                
           });
           $("#custom_field_order_all").val(idsInOrderAll);
            // console.log(idsInOrder);
        }
        
        var UINestable = function () {
            var t = function (t) {
                var e = t.length ? t : $(t.target),
                    a = e.data("output");
                window.JSON ? a.val(window.JSON.stringify(e.nestable("serialize"))) : a.val("JSON browser support required for this demo.")
            };
            return {
                init: function () {
                    $("#nestable_list_3").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                    $("#nestable_list_4").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                    $("#nestable_list_campaign").nestable({
                        maxDepth: 1,
                        noDragClass:'dd-nodrag'
                    });
                }
            }
        }();
        jQuery(document).ready(function () {
            UINestable.init()
        }); 
   </script>
<script>
var KTFormRepeater = function() {
        var demo1 = function() {
            $('#kt_repeater_3').repeater({
                initEmpty: false,

                defaultValues: {
                    'text-input': 'foo'
                },

                show: function() {
                    $(this).slideDown();
                },

                hide: function(deleteElement) {
                    if(confirm('@lang("common.message.delete_warning")')) {
                        $(this).slideUp(deleteElement);
                    }
                }
            });
        }
        return {
            init: function() {
                demo1();
            }
        };
    }();
    jQuery(document).ready(function() {
        KTFormRepeater.init();
    });


</script>
@endsection

@section(decide_content())

    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="jURBHjwL">
        <span id='msg-text'><span>
    </div>
    <form action="" method="POST" id="list-frm" class="kt-form kt-form--label-right" novalidate="novalidate">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @if($page_data['action'] == 'add')
            <input type="hidden" id="action" value="add">
        @elseif($page_data['action'] == 'edit')
            <input type="hidden" id="list-id" value="{{$list->id}}">
            <input type="hidden" id="action" value="edit">
            <input name="_method" type="hidden" value="PUT">
        @endif
        <div class="row" data-name="GBoqGCEB">
            <!-- BEGIN FORM-->
            <div class="col-md-6 create-form" data-name="kJymocHN">
                <div class="kt-portlet kt-portlet--height-fluid" data-name="NVFWhrDQ">
                    <div class="kt-portlet__head" data-name="iHmRjKxJ">
                        <div class="kt-portlet__head-label" data-name="uHosdKpH">
                            <h3 class="kt-portlet__head-title">
                                {{ trans('lists.add_new.form.title') }}
                            </h3>
                        </div>
                    </div>

                    <div class="kt-portlet__body" data-name="dAZHzoqo">
                        <div class="form-group form-group-last kt-hide" data-name="SYcVsKBC">
                            <div class="alert alert-danger" role="alert" id="kt_form_1_msg" data-name="yobIDqUw">
                                <div class="alert-icon" data-name="WIhBUkjK"><i class="flaticon-warning"></i></div>
                                <div class="alert-text" data-name="IOUptTCN">
                                    {{trans('lists.add_new.form.alert_danger_msg')}}
                                </div>
                                <div class="alert-close" data-name="wXRXbGaC">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true"><i class="la la-close"></i></span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="" data-name="YIQQJCNB">
                            <div class="alert alert-danger display-hide" data-name="IbcmOPab">
                                <button class="close" data-close="alert"></button>
                                </div>
                            <div class="alert alert-success display-hide" data-name="VCevgDiU">
                                <button class="close" data-close="alert"></button>
                            </div>
                            <div class="form-group row" data-name="QNkcmHMl">
                                
                                <div class="col-md-6" data-name="nrNnKoWQ">
                                    <label class="col-form-label">
                                        {{trans('lists.add_new.form.list_name')}}
                                        <span class="required"> * </span>
                                        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('lists.add_new.form.list_name_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <input type="text" name="name" value="{{isset($list->name) ? $list->name : '' }}" class="form-control" />
                                </div>
                                <div class="col-md-6" data-name="mQVHIPDu">
                                    <label class="col-form-label">{{trans('lists.add_new.form.group')}}
                                        @if(!$adminOnClient)
                                        <span   data-toggle="tooltip"  title="{{trans('lists.add_new.form.new_group')}}" ><a href="#modal-group-label" data-toggle="modal"><i class="fa fa-plus-square text-success"></i></a></span>
                                        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('lists.add_new.form.group_help')}}" data-original-title="{{trans('common.description')}}"></i>

                                        @endif
                                    </label>
                                    <select class="form-control m-select2" data-placeholder="{{trans('lists.add_new.form.choose_a_group')}}" name="group_id" id="group-id">
                                        <option value="">{{trans('lists.add_new.form.choose_a_group')}}</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" {{ (isset($list->group_id) && $list->group_id == $group->id) ? 'selected' : ''  }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                            </div>
                            <div class="form-group row" id="customFieldData" data-name="LlQQOhIn">
                                <div class="col-md-12" data-name="myxCbllC">
                                    <label class="col-form-label">{{trans('lists.add_new.form.additional_fields')}}
                                        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('lists.add_new.form.additional_fields_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <select class="mt-multiselect btn btn-default" multiple="multiple" data-label="left" name="list_fields[]"  id="addistional-fields" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="false" data-placeholder="Select {{trans('lists.add_new.form.assign_fields')}}">
                                        <optgroup label="{{trans('lists.add_new.form.assign_fields')}}">
                                            @foreach($additional_fields as $field)
                                            <option id="ad_{{$field['id']}}" class="customField"  @if(isset($list_fields) and in_array($field['id'] , $list_fields))) selected @endif value="{{$field['id']}}">{{ $field['name'] }}</option>
                                            @endforeach
                                        </optgroup>
                                        <optgroup label="{{trans('lists.add_new.form.custom_fields')}}">
                                            @foreach($custom_fields as $field)

                                            <option id="ad_{{$field['id']}}" class="customField"  @if(isset($list_fields) and in_array($field['id'] , $list_fields))) selected @endif  value="{{$field['id']}}">{{ $field['name'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row" data-name="KguxqySm">
                                <div class="col-md-6" data-name="SyAfdZLA">
                                    <label class="col-form-label">{{trans('lists.add_new.form.owner_name')}}
                                        <span class="required"> * </span>
                                        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('lists.add_new.form.owner_name_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <input type="text" name="owner_name" value="{{isset($list->owner_name) ? $list->owner_name : '' }}"  class="form-control" />
                                </div>
                                <div class="col-md-6" data-name="qnpaVmrJ">
                                    <div class="form-group row ownermail mb0" data-name="EoLIxhtM">
                                        <div class="col-md-12" data-name="zBDoqtJh">
                                            <label class="col-form-label" >{{trans('lists.add_new.form.owner_email')}}
                                                <span class="required"> * </span>
                                                <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('lists.add_new.form.owner_email_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                            </label>
                                            <div class="row from-email" data-name="MsETNTwS">
                                                <div class="col-md-5 email-part" data-name="BvkmOgOb">
                                                    <div class="input-group" data-name="KBFzjnxl">
                                                        <input type="text" class="form-control" name="owner_email_part1" value="{{ isset($owner_email_part1) ? $owner_email_part1 : '' }}" />
                                                        <div class="input-group-append" data-name="ZtAdJXRD"><span class="input-group-text" id="basic-addon2">@</span></div>
                                                    </div>
                                                        
                                                </div>
                                                <?php $unauth_sending_domain = getApplicationSettings('unauth_sending_domain'); ?>
                                                <div class="col-md-7 domain-part" data-name="FbjvfdOw">
                                                    <select class="form-control m-select2" data-placeholder="{{trans('lists.add_new.form.choose_domain')}}" name="owner_email_part2" id="owner_email_part2">
                                                        @php $disableFlag = 0; @endphp

                                                        <option selected value=""> {{trans('lists.add_new.form.choose_domain')}} </option>

                                                        <optgroup label="{{trans('lists.eligible_domains')}}"> 
                                                        @foreach($domain_maskings as $domain)
                                                            @php
                                                                $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                $replace = '';
                                                                $subdomain = str_replace($order, $replace, (isset($domain->domain) ? $domain->domain : ''));
                                                            @endphp

                                                            @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                            <option {{isset($owner_email_part2) && $owner_email_part2==$subdomain ? 'selected' :'' }} value="{{ '@' . $subdomain }}">{{ $subdomain }}</option>
                                                            @else 
                                                                @php $disableFlag = 1; @endphp
                                                            @endif
                                                        @endforeach
                                                        </optgroup>
                                                        @if($disableFlag)
                                                        <optgroup label="{{trans('lists.ineligible_domains')}}">
                                                        @foreach($domain_maskings as $domain)
                                                            @php
                                                                $order = array("http://", "https://", "www", "http://www", "https://www");
                                                                $replace = '';
                                                                $subdomain = str_replace($order, $replace, (isset($domain->domain) ? $domain->domain : ''));
                                                            @endphp

                                                            @if($domain->domain_status == 1 || $unauth_sending_domain != 'on')  
                                                            @else 
                                                                @php 
                                                                   $disableTxt = "inactive";
                                                                    if($domain->domain_status == 3) $disableTxt = "authentication failed";
                                                                    if($domain->domain_status == 4) $disableTxt = "pending authentication";
                                                                
                                                                @endphp
                                                                <option disabled  value="{{ '@' . $subdomain }}">{{ $subdomain }} <small>({{$disableTxt}}) </small></option>
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
                                      
                            <div class="form-group row" data-name="ADWWKayq">
                                <div class="col-md-6" data-name="rUxtuOMm">
                                    <label class="col-form-label" >{{trans('common.label.reply_email')}}
                                        <span class="required"> * </span>
                                        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('common.label.reply_email_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <input type="text" name="reply_email" value="{{ isset($list->reply_email) ? $list->reply_email : '' }}" class="form-control" />
                                </div>
                                <?php 
                                    $license_attributes = json_decode(getSetting("license_attributes"), true);
                                    $license_type = "";
                                    if(!empty($license_attributes["package"])) { 
                                        $license_type = $license_attributes["package"];
                                    }
                                    $imap_switch = getApplicationSettings('imap_switch');
                                    if($license_type != "Commercial ESP" OR $imap_switch != 2) { 
                                ?>

                                <div class="col-md-6" data-name="OoHOejCo">
                                    <label class="col-form-label">{{trans('common.label.bounce_email')}}
                                        <span data-toggle="tooltip"  title="Configure Bounce Email" ></span>
                                        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('common.label.bounce_email_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                    </label>
                                    <select class="form-control m-select2" data-placeholder="{{trans('lists.add_new.form.choose_a_bounce_handler')}}" name="bounce_email_id" id="bounce-id">
                                        @foreach($bounce_emails as $bounce_email)
                                            <option value="{{ $bounce_email->id }}" {{ (isset($list->bounce_email_id) && $list->bounce_email_id == $bounce_email->id) ? 'selected' : '' }}>{{ isset($bounce_email->name) ? $bounce_email->name : '' }}</option>
                                        @endforeach
                                    </select>
                                    @if($bounce_emails->isEmpty())
                                        <span class="text-danger">{{trans('lists.add_new.form.bounce.email_msg')}}</span>
                                    @endif
                                </div>
                                <?php } ?>
                            </div>

                            @if($page_data['action'] == 'edit')
                            <div class="form-group row mb0" data-name="ijJpWeAq">
                                <div class="col-md-12" data-name="pwYwglhr">
                                    <div class="kt-checkbox-list mt15" data-name="RPpPXtqP">
                                        <label class="kt-checkbox">
                                            <input type="checkbox" value="1" name="sync_fields" id="sync_fields"> {{trans('lists.add_new.form.check_contacts')}}
                                            <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('common.label.check_list_help')}}" data-original-title="{{trans('common.description')}}"></i>
                                            <span></span>
                                        </label>
                                    </div>
                                    <div class="check-contact-message text-danger" data-name="BvAdvYNX">
                                        <small><b>{{trans('lists.add_new.form.check_contacts_message_note')}}</b>: {{trans('lists.add_new.form.check_contacts_message')}}</small>
                                    </div>
                                </div>
                            </div>
                            @endif
                            
                        </div>

                        <div class="form-group row mb0">
                            <div class="col-md-12">
                                <div class="kt-heading kt-heading--md">
                                    {{ trans('lists.additional_header.heading') }}
                                </div>
                                <p>{{ trans('lists.additional_header.description') }}<br>
                                    <small>{{ trans('lists.additional_header.note') }}</small>
                                </p>
                            </div>
                        </div>

                        <div id="kt_repeater_3" >
                            <div class="form-group row mb0">
                                <div class="col-md-9  p-0" data-repeater-list="subscriber_filter">
                                    <label class="col-form-label col-md-12 pl12">
                                        {{ trans('lists.additional_header.title') }}
                                        {!! popover('sending_nodes.add_new.form.additional_headers_help','common.description') !!}
                                    </label>
                                    @if(isset($additional_headers) && is_array($additional_headers))
                                        <div class="mt-repeater" >
                                            <div data-repeater-item >
                                                @foreach($additional_headers as $key => $value)
                                                    <div data-repeater-item class="mt-repeater-item" >
                                                        <div class="row mt-repeater-row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="header" placeholder="Header" class="form-control" value="{{ isset($value->header) ? $value->header : '' }}">
                                                                <span class="clnfld">:</span>
                                                            </div>
                                                            <div class="col-md-5">
                                                                <input type="text" name="header_value" placeholder="Value" class="form-control" value="{{ isset($value->header_value) ? $value->header_value : ''  }}">
                                                            </div>
                                                            <div class="col-md-1">
                                                                <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm  btn-cancel"><i class="la la-remove"></i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                    <div class="mt-repeater">
                                        <div data-repeater-item="" class="mt-repeater-item">
                                            <div class="row mt-repeater-row">
                                                <div class="col-md-6">
                                                    <input type="text" name="header" placeholder="Header" class="form-control" value="">
                                                    <span class="clnfld">:</span>
                                                </div>
                                                <div class="col-md-5">
                                                    <input type="text" name="header_value" placeholder="Value" class="form-control" value="">
                                                </div>
                                                <div class="col-md-1">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm  btn-cancel"><i class="la la-remove"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endif
                                </div>
                            </div>
                            <div class="row" id="btn-new">
                                <div class="col p-0">
                                    <div data-repeater-create="" class="btn btn btn-info btn-sm">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>{{ trans('lists.additional_header.btn_add') }}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="kt-portlet__foot" data-name="pxSIvGjb">
                        <div class="row" data-name="BRrXALDX">
                            <div class="col-md-12 col-sm-12 action-buttons" data-name="fUNfmhAV">
                                @if ($page_data['action'] == 'add')
                                    <button type="submit" name="save_exit" class="btn btn-success" onclick="getCustomFieldOrder()" value="save_exit" data-toggle="modal">
                                       @if($canSeeContacts)
                                            {{trans('common.form.buttons.save_exit')}}
                                        @else 
                                            Save
                                        @endif
                                    </button>
                                @else
                                    <button type="submit" name="edit" onclick="getCustomFieldOrder()" class="btn btn-success" value="edit">{{trans('common.form.buttons.save_exit')}}</button>
                                @endif
                                <input type="hidden" id="custom_field_order" name="custom_field_order" value="" />
                                <input type="hidden" id="custom_field_order_all" name="custom_field_order_all" value="" />
                                <button type="submit" name="save_add" class="btn btn-success" onclick="getCustomFieldOrder()" value="save_add" data-toggle="modal">{{trans('common.form.buttons.save_add')}}</button>
                                <a href="{{ route('list.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 create-form">
                <div class="kt-portlet kt-portlet--height-fluid">
                    <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                            <h3 class="kt-portlet__head-title">
                                {{ trans('contacts.table_headings.pre_columns') }}
                            </h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body">
                        <p>{{ trans('contacts.table_headings.pre_columns_text') }}</p>
                        <div class="form-group">
                            <div class="dd" id="nestable_list_campaign">
                                <ol class="dd-list" id="sortable">
                                    <?php
                                    if($page_data['action'] == 'add'){
                                    ?>
                                    <li class="dd-item dd3-item" data-id="contact">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="contact" onchange="forceFullyChecked()" id="cus_contact"  name="custome_fields[]"  checked="" >
                                                    {{ trans('lists.add_new.form.contact') }} ({{ trans('lists.add_new.form.contact_included') }})
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="group_name">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="group_name" id="cus_group_name" name="custome_fields[]" checked="">
                                                    {{ trans('lists.add_new.form.group') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="list">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="list" id="cus_list" name="custome_fields[]" checked="">
                                                    {{ trans('lists.add_new.form.list') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="contact_on" checked="">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="contact_on" id="cus_contact_on" name="custome_fields[]" checked="">
                                                    {{ trans('lists.contact_lists.table_headings.created_on') }}

                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="confirmed">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="confirmed" id="cus_confirmed" name="custome_fields[]" checked="">
                                                    {{ trans('lists.add_new.form.confirmed') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="bounced">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="bounced" id="cus_bounced" checked="" name="custome_fields[]">
                                                    {{ trans('lists.add_new.form.bounced') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="unsubscribed">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="unsubscribed" checked="" id="cus_unsubscribed" name="custome_fields[]">
                                                    {{ trans('lists.add_new.form.unsubscribed') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="spammed">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="spammed" id="cus_spammed" name="custome_fields[]">
                                                    {{ trans('lists.add_new.form.spammed') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="suppressed">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="suppressed" id="cus_suppressed" name="custome_fields[]">
                                                    {{ trans('lists.add_new.form.suppressed') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="dd-item dd3-item" data-id="active">
                                        <div class="dd-handle dd3-handle"> </div>
                                        <div class="dd3-content">
                                            <div class="kt-checkbox-list">
                                                <label class="kt-checkbox kt-checkbox-outline">
                                                    <input class="sortingColums" type="checkbox" value="active" id="cus_active" name="custome_fields[]">
                                                    {{ trans('lists.add_new.form.active') }}
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </li>
                                    
                                    @foreach($additional_fields as $field)
                                        @if($field['id']!=1 && $field['id']!=2)    
                                        <li class="dd-item dd3-item custom" data-id="{{ $field['id'] }}" style="display: none" id="cus_li_{{ $field['id'] }}">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input type="checkbox" value="{{ $field['id'] }}" class="custimCheckBox sortingColums" @if( !in_array( $field['id'] ,$visible_fields_array ) ) disabled="" @endif value="{{ $field['id'] }}" id="cus_{{ $field['id'] }}" name="custome_fields[]" >
                                                        {{ $field['name'] }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        @endif
                                        @endforeach
                                        @foreach($custom_fields as $field)
                                        <li class="dd-item dd3-item custom" data-id="{{ $field['id'] }}" style="display: none" id="cus_li_{{ $field['id'] }}">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="{{ $field['id'] }}" class="custimCheckBox sortingColums" @if( !in_array( $field['id'] ,$visible_fields_array ) ) disabled="" @endif  value="{{ $field['id'] }}" id="cus_{{ $field['id'] }}" name="custome_fields[]" >
                                                            {{ $field['name'] }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    <?php
                                    }
                                    else{
                                      $added = array();
                                      if($haveCustomeFieldsAll==1){
                                          
                                          foreach($visible_fields_array['custome_fields_all'] as $field_id){
                                              
                                              if(is_numeric($field_id)){
                                                  $added[] = $field_id;
                                                  $field = getCustomFieldRow($field_id);
                                                  if($field_id!=1 && $field_id!=2 && !empty($field)){
                                                      ?>
                                                      <li class="dd-item dd3-item custom" data-id="{{ $field['id'] }}" style="" id="cus_li_{{ $field['id'] }}">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input type="checkbox" value="{{ $field['id'] }}" class="custimCheckBox sortingColums" @if( in_array( $field['id'] ,$custome_fields_order ) ) checked=""  @endif  value="{{ $field['id'] }}" id="cus_{{ $field['id'] }}" name="custome_fields[]" >
                                                                        {{ $field['name'] }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>
                                            <?php
                                                  }
                                              }else{
                                                  if($field_id=='contact'){
                                                      $added[]='contact';
                                                      ?>
                                                   <li class="dd-item dd3-item" data-id="contact">
                                                        <div class="dd-handle dd3-handle"> </div>
                                                        <div class="dd3-content">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox-outline">
                                                                    <input class="sortingColums" type="checkbox" value="contact" id="cus_contact" onchange="forceFullyChecked()"  name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif  >
                                                                    {{ trans('lists.add_new.form.contact') }} ({{ trans('lists.add_new.form.contact_included') }})
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </li>     
                                                          
                                                <?php
                                                  }
                                                  else if($field_id=='group_name'){
                                                      $added[]='group_name';
                                                      ?>
                                                        <li class="dd-item dd3-item" data-id="group_name">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="group_name" id="cus_group_name" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.add_new.form.group') }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php
                                                  }
                                                  else if($field_id=='list'){
                                                      $added[]='list';
                                                      
                                                  ?>
                                                        <li class="dd-item dd3-item" data-id="list">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="list" id="cus_list" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.add_new.form.list') }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <?php
                                                  }
                                                  else if($field_id=='contact_on'){
                                                      $added[]='contact_on';
                                                      ?>
                                                        <li class="dd-item dd3-item" data-id="contact_on" checked="">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="contact_on" id="cus_contact_on" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.contact_lists.table_headings.created_on') }}

                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                  <?php      
                                                  }
                                                  else if($field_id=='bounced'){
                                                      $added[]='bounced';
                                                    ?>
                                                       <li class="dd-item dd3-item" data-id="bounced">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="bounced" id="cus_bounced" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.add_new.form.bounced') }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        
                                                <?php
                                                  }
                                                  else if($field_id=='unsubscribed'){
                                                      $added[]='unsubscribed';
                                                  ?>
                                                        <li class="dd-item dd3-item" data-id="unsubscribed">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="unsubscribed" id="cus_unsubscribed" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.add_new.form.unsubscribed') }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                  <?php
                                                  }
                                                  else if($field_id=='spammed'){
                                                      $added[]='spammed';
                                                  ?>
                                                      <li class="dd-item dd3-item" data-id="spammed">
                                                        <div class="dd-handle dd3-handle"> </div>
                                                        <div class="dd3-content">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox-outline">
                                                                    <input class="sortingColums" type="checkbox" value="spammed" id="cus_spammed" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                    {{ trans('lists.add_new.form.spammed') }}
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                     </li>
                                                  <?php
                                                  }
                                                   else if($field_id=='suppressed'){
                                                       $added[]='suppressed';
                                                  ?>
                                                      <li class="dd-item dd3-item" data-id="suppressed">
                                                        <div class="dd-handle dd3-handle"> </div>
                                                        <div class="dd3-content">
                                                            <div class="kt-checkbox-list">
                                                                <label class="kt-checkbox kt-checkbox-outline">
                                                                    <input class="sortingColums" type="checkbox" value="suppressed" id="cus_suppressed" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                    {{ trans('lists.add_new.form.suppressed') }}
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        </li>
                                                      <?php     
                                                   }
                                                   else if($field_id=='active'){
                                                       $added[]='active';
                                                       ?>
                                                         <li class="dd-item dd3-item" data-id="active">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="active" id="cus_active" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.add_new.form.active') }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>  
                                                           <?php
                                                   }
                                                  else{
                                                      $added[]='confirmed';
                                                      ?>
                                                        <li class="dd-item dd3-item" data-id="confirmed">
                                                            <div class="dd-handle dd3-handle"> </div>
                                                            <div class="dd3-content">
                                                                <div class="kt-checkbox-list">
                                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                                        <input class="sortingColums" type="checkbox" value="confirmed" id="cus_confirmed" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                                        {{ trans('lists.add_new.form.confirmed') }}
                                                                        <span></span>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </li>
                                                 <?php       
                                                  }
                                                  ?>
                                             <?php           
                                                  
                                              }
                                     ?>
                                        
                                    <?php 
                                          }
                                          if(!in_array("contact", $added)){
                                              ?>
                                          <li class="dd-item dd3-item" data-id="contact">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="contact" id="cus_contact"  name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.contact') }} ({{ trans('lists.add_new.form.contact_included') }})
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>                
                                          <?php
                                          }
                                          if(!in_array("group_name", $added)){
                                              ?>
                                           <li class="dd-item dd3-item" data-id="group_name">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="group_name" id="cus_group_name" name="custome_fields[]">
                                                            {{ trans('lists.add_new.form.group') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>   
                                        <?php
                                          }
                                          if(!in_array("list", $added)){
                                           ?>
                                            <li class="dd-item dd3-item" data-id="list">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="list" id="cus_list" name="custome_fields[]">
                                                            {{ trans('lists.add_new.form.list') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>   
                                               
                                               <?php   
                                          }
                                          if(!in_array("contact_on", $added)){
                                              ?>
                                                  
                                            <li class="dd-item dd3-item" data-id="contact_on" checked="">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="contact_on" id="cus_contact_on" name="custome_fields[]">
                                                           {{ trans('lists.contact_lists.table_headings.created_on') }}

                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                                  
                                            <?php
                                          }
                                          if(!in_array("bounced", $added)){
                                              ?>
                                            <li class="dd-item dd3-item" data-id="bounced">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="bounced" id="cus_bounced" name="custome_fields[]" @if( in_array( $field_id ,$custome_fields_order ) ) checked="" @endif>
                                                            {{ trans('lists.add_new.form.bounced') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                                  
                                                  <?php
                                          }
                                          if(!in_array("unsubscribed", $added)){
                                              ?>
                                            <li class="dd-item dd3-item" data-id="unsubscribed">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="unsubscribed" id="cus_unsubscribed" name="custome_fields[]">
                                                            {{ trans('lists.add_new.form.unsubscribed') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                          <?php  
                                          }
                                          if(!in_array("confirmed", $added)){
                                              ?>
                                              <li class="dd-item dd3-item" data-id="confirmed">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="confirmed" id="cus_confirmed" name="custome_fields[]">
                                                            {{ trans('lists.add_new.form.confirmed') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>    
                                            <?php
                                          }
                                          if(!in_array("spammed", $added)){
                                              ?>
                                            <li class="dd-item dd3-item" data-id="spammed">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="spammed" id="cus_spammed" name="custome_fields[]">
                                                            {{ trans('lists.add_new.form.spammed') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                          <?php
                                          }
                                          if(!in_array("suppressed", $added)){
                                              ?>
                                            <li class="dd-item dd3-item" data-id="suppressed">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="suppressed" id="cus_suppressed" name="custome_fields[]">
                                                            {{ trans('lists.add_new.form.suppressed') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>      
                                                  
                                          <?php
                                          }
                                          if(!in_array("active", $added)){
                                              ?>
                                            <li class="dd-item dd3-item" data-id="active">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input class="sortingColums" type="checkbox" value="active" id="cus_active" name="custome_fields[]">
                                                            {{ trans('lists.add_new.form.active') }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>      
                                                  
                                            <?php
                                          }
//                                          echo '<pre>';
//                                          print_r($added);
//                                          echo '</pre>';
                                         ?>
                                             @foreach($additional_fields as $field)
                                             <?php
                                             if(!in_array($field['id'], $added))
                                             {
                                                if($field['id']!=1 && $field['id']!=2)
                                                {
                                             ?>
                                            <li class="dd-item dd3-item custom" data-id="{{ $field['id'] }}" style="display: @if(isset($list_fields) and in_array($field['id'] , $list_fields))) block: @else none; @endif" id="cus_li_{{ $field['id'] }}">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="{{ $field['id'] }}" class="custimCheckBox sortingColums"  value="{{ $field['id'] }}" @if(isset($list_fields) and in_array($field['id'] , $list_fields)))  @else disabled @endif id="cus_{{ $field['id'] }}" name="custome_fields[]" >
                                                            {{ $field['name'] }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            
                                            <?php
                                                }
                                             }
                                            ?>
                                            @endforeach
                                            @foreach($custom_fields as $field)
                                            <?php
                                             if(!in_array($field['id'], $added))
                                             {
                                             ?>
                                            <li class="dd-item dd3-item custom" data-id="{{ $field['id'] }}" style="display: @if(isset($list_fields) and in_array($field['id'] , $list_fields))) block: @else none; @endif" id="cus_li_{{ $field['id'] }}">
                                                    <div class="dd-handle dd3-handle"> </div>
                                                    <div class="dd3-content">
                                                        <div class="kt-checkbox-list">
                                                            <label class="kt-checkbox kt-checkbox-outline">
                                                                <input type="checkbox" value="{{ $field['id'] }}" class="custimCheckBox sortingColums" @if(isset($list_fields) and in_array($field['id'] , $list_fields)))  @else disabled @endif  value="{{ $field['id'] }}" id="cus_{{ $field['id'] }}" name="custome_fields[]" >
                                                                {{ $field['name'] }}
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                             <?php
                                             }
                                            ?>   
                                            @endforeach 
                                             <?php
                                      }else{
                                          ?>
                                           <li class="dd-item dd3-item" data-id="contact">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="contact" id="cus_contact"  name="custome_fields[]" >
                                                        {{ trans('lists.add_new.form.contact') }} ({{ trans('lists.add_new.form.contact_included') }})
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="group_name">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="group_name" id="cus_group_name" name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.group') }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="list">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="list" id="cus_list" name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.list') }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="contact_on" checked="">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="contact_on" id="cus_contact_on" name="custome_fields[]">
                                                        {{ trans('lists.contact_lists.table_headings.created_on') }}

                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="bounced">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="bounced" id="cus_bounced" name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.bounced') }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="unsubscribed">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="unsubscribed" id="cus_unsubscribed" name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.unsubscribed') }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="confirmed">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="confirmed" id="cus_confirmed" name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.confirmed') }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        
                                        <li class="dd-item dd3-item" data-id="spammed">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="spammed" id="cus_spammed" name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.spammed') }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="suppressed">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="suppressed" id="cus_suppressed" name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.suppressed') }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="dd-item dd3-item" data-id="active">
                                            <div class="dd-handle dd3-handle"> </div>
                                            <div class="dd3-content">
                                                <div class="kt-checkbox-list">
                                                    <label class="kt-checkbox kt-checkbox-outline">
                                                        <input class="sortingColums" type="checkbox" value="active" id="cus_active" name="custome_fields[]">
                                                        {{ trans('lists.add_new.form.active') }}
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </li>
                                        @foreach($additional_fields as $field)

                                            <li class="dd-item dd3-item custom" data-id="{{ $field['id'] }}" style="display: @if(isset($list_fields) and in_array($field['id'] , $list_fields)) block: @else none; @endif" id="cus_li_{{ $field['id'] }}">
                                                <div class="dd-handle dd3-handle"> </div>
                                                <div class="dd3-content">
                                                    <div class="kt-checkbox-list">
                                                        <label class="kt-checkbox kt-checkbox-outline">
                                                            <input type="checkbox" value="{{ $field['id'] }}" class="custimCheckBox sortingColums" @if(isset($list_fields) and in_array($field['id'] , $list_fields))  @else disabled="" @endif   value="{{ $field['id'] }}" id="cus_{{ $field['id'] }}" name="custome_fields[]" >
                                                            {{ $field['name'] }}
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            @foreach($custom_fields as $field)
                                            <li class="dd-item dd3-item custom" data-id="{{ $field['id'] }}" style="display: @if(isset($list_fields) and in_array($field['id'] , $list_fields)) block: @else none; @endif" id="cus_li_{{ $field['id'] }}">
                                                    <div class="dd-handle dd3-handle"> </div>
                                                    <div class="dd3-content">
                                                        <div class="kt-checkbox-list">
                                                            <label class="kt-checkbox kt-checkbox-outline">
                                                                <input type="checkbox" value="{{ $field['id'] }}" class="custimCheckBox sortingColums" @if(isset($list_fields) and in_array($field['id'] , $list_fields))  @else disabled="" @endif  value="{{ $field['id'] }}" id="cus_{{ $field['id'] }}" name="custome_fields[]" >
                                                                {{ $field['name'] }}
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach             

                                            <?php
                                          }  
                                        }
                                        ?>
                                    <input type="hidden" name="customFieldHidden" id="customFieldHidden" value="" />
                                    
                                </ol>
                            </div>
                         </div>
                     </div>
                </div>
                
            </div>
        </div>
    </form>
     <!-- END FORM-->

     <!-- show modal Add New Group  -->
    <div id="modal-group-label" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="FkaxpRIW">
        <div class="modal-dialog" data-name="wfulBGGR">
            <div class="modal-content" data-name="AYgCVVuL">
                <div class="modal-header" data-name="VuRZoqpk">
                    <h5 class="modal-title">{{trans('lists.add_new.form.new_group')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" data-name="KdrFdWsu">
                    <div id="msg-group" class="display-hide" data-name="IWLdanis">
                        <span id='msg-text-group'></span>
                    </div>
                    <form action="" id="frm-group" method="post" class="kt-form kt-form--label-right">
                        @for ($i = 1; $i < 2; $i++)
                            <div class="form-group row" data-name="JKgbhKWC">
                                <label class="col-md-3 col-form-label" >{{trans('lists.add_new.form.group')}} </label>
                                <div class="col-md-8" data-name="RFXNabUC">
                                    <input type="text" id="group_name"  name="name[]" class="form-control"  {{ ($i == 1) ? 'required' : '' }}> 
                                </div>
                            </div>
                        @endfor
                        <div class="form-actions" data-name="fXdhSacX">
                            <div class="row" data-name="fltpqaAL">
                                <label class="col-md-3 col-form-label" ></label>
                                <div class="col-md-8" data-name="gNJcNCHT">
                                    <button type="submit" class="btn btn-success">{{trans('common.form.buttons.submit')}}</button>
                                    <button type="reset" class="btn btn-default">{{trans('common.form.buttons.reset')}}</button>
                                    <input type="hidden" value="1" name="section_id">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
     <!-- show modal Add New Group  -->
    
    <div id="infowiz" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-width="600" data-keyboard="false" data-backdrop="static" data-name="uSYcLQHX">
        <div class="modal-dialog" data-name="jFiljijF">
            <div class="modal-content" data-name="LhRQwuTU">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body" data-name="iyKaRzGF">
                    <div class="portlet helpInfo" data-name="WiVaXxvv">
                        <div class="headingport" data-name="IeoEIKQE">
                            <div class="title" data-name="SkCcCrXc">{{trans('lists.add_new.infowiz.welcome_msg')}}</div>
                            <div class="desc" data-name="OqmzvIzI"></div>
                            <i class="fa fa-info-circle"></i>
                        </div>
                        <div class="portlet-body" data-name="vxoZPZOn">
                            <div class="row" data-name="uTYBiemg">
                                <div class="col-md-12" data-name="addKlPcK">
                                    <div class="flexslider-wrapper" data-name="veVisvzO">
                                        <div class="flexslider" data-name="FaybuukS">
                                            <ul class="slides">
                                                <li class="slide">
                                                    <div class="text-wrapper" data-name="LWgTiTKB"> 
                                                        <div class="congs" data-name="EEOPTthG">
                                                            <h1>{{trans('lists.add_new.infowiz.congratulations')}}</h1>
                                                            <h2 class="msg">{{trans('lists.add_new.infowiz.welcome_content')}}</h2>
                                                        </div>
                                                        
                                                        <h2>{{trans('lists.add_new.infowiz.welcome_question')}}</h2>
                                                        <ul>
                                                            <li><i class="icon-envelope"></i><span class="wel1opts">{{trans('lists.add_new.infowiz.welcome_question_point1')}}</span></li>
                                                            <li><i class="icon-envelope"></i><span class="wel1opts">{{trans('lists.add_new.infowiz.welcome_question_point2')}}</span></li>
                                                            <li><i class="icon-envelope"></i><span class="wel1opts">{{trans('lists.add_new.infowiz.welcome_question_point3')}}</span></li>
                                                            <li><i class="icon-envelope"></i><span class="wel1opts">{{trans('lists.add_new.infowiz.welcome_question_point4')}}</span></li>
                                                            <li><i class="icon-envelope"></i><span class="wel1opts">{{trans('lists.add_new.infowiz.welcome_question_point5')}}</span></li>
                                                            <li><i class="icon-envelope"></i><span class="wel1opts">{{trans('lists.add_new.infowiz.welcome_question_point6')}}</span></li>
                                                            <li><i class="icon-envelope"></i><span class="wel1opts">{{trans('lists.add_new.infowiz.welcome_question_point8')}}</span></li>
                                                            <li><i class="icon-envelope"></i><span class="wel1opts">{{trans('lists.add_new.infowiz.welcome_question_point7')}}</span></li>
                                                        </ul>
                                                        <ul style="list-style-type: none;margin: 0;margin-left:20px;">
                                                            <li><a href="javascript:;">{{trans('lists.add_new.infowiz.welcome_more')}}</a></li>
                                                        </ul>
                                                        
                                                    </div>
                                                </li>
                                                <li class="slide">
                                                    <div class="text-wrapper" data-name="hmZRpNbW"> 
                                                        <div class="congs" style="margin-bottom: 0;" data-name="sQtKWsJN">
                                                            <h2 class="slideMnTitle">{{trans('lists.add_new.infowiz.import_your_contacts')}}</h2>
                                                        </div>
                                                        <a href="https://www.mumara.com/campaignsplus/campaign-feature/contact-management/#import" target="_blank"><img src="/resources/assets/images/impcont.png" height="300px"></a>
                                                        <p>{{trans('lists.add_new.infowiz.csv')}} <a href="https://www.mumara.com/campaignsplus/campaign-feature/contact-management/#import" target="_blank">{{trans('lists.add_new.infowiz.read_more')}}</a></p>
                                                    </div>
                                                </li>
                                                <li class="slide">
                                                    <div class="text-wrapper" data-name="aoSEeRca">
                                                        <div class="congs" style="margin-bottom: 0;" data-name="TsMluTcB">
                                                            <h2 class="slideMnTitle">{{trans('lists.add_new.infowiz.automate_your_marketing')}}</h2>
                                                        </div> 
                                                        <a href="https://www.mumara.com/campaignsplus/campaign-feature/triggers/" target="_blank"><img src="/resources/assets/images/automate.png" height="200px"></a>
                                                        <p>{{trans('lists.add_new.infowiz.automate_your_marketing_desc')}} <a href="https://www.mumara.com/campaignsplus/campaign-feature/triggers/" target="_blank">{{trans('lists.add_new.infowiz.read_more')}}</a></p>
                                                    </div>
                                                </li>
                                                <li class="slide">
                                                    <div class="text-wrapper" data-name="JWEAIvYy">
                                                        <div class="congs" style="margin-bottom: 0;" data-name="oUtAPnmb">
                                                            <h2 class="slideMnTitle">{{trans('lists.add_new.infowiz.segment_your_data')}}</h2>
                                                        </div> 
                                                        <a href="https://www.mumara.com/campaignsplus/campaign-feature/smart-segments/" target="_blank"><img src="/resources/assets/images/sagmentnew.png" height="200px"></a>
                                                        <p>{{trans('lists.add_new.infowiz.segment_your_data_desc')}} <a href="https://www.mumara.com/campaignsplus/campaign-feature/smart-segments/" target="_blank">{{trans('lists.add_new.infowiz.read_more')}}</a></p>
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="nsa" data-name="xsVCXaZZ">
                                                <input type="checkbox" name="nshow" id="nshow">
                                                <label for="nshow">
                                                    {{trans('lists.add_new.infowiz.check_here_and_close')}}
                                                </label>
                                                <div class="mclose" data-name="UkcBfUEq"><a href="javascript:;" type="button" class="closed" data-dismiss="modal">X</a></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection