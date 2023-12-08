@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/subscriber-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<style type="text/css">
    #custom-fields-data .help-block-error {
    width: 150px!important;
    height: auto !important;
    top: 15px;
}
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datepicker-init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-timepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/timepicker-init.js" type="text/javascript"></script>
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
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Contacts/Add-a-Contact");
        $(".m-select2").select2({
            placeholder: 'Select Option'
        });

    $("body").on("change", "#list-id" , function() { 
        var option = $('option:selected', this).attr('data-unconfirm');
        $("#is_confirmed option[value=1]").prop('disabled' , false);
        $("#is_confirmed option[value=0]").prop('disabled' , false);
        $("#is_confirmed option[value=1]").text("Confirmed");
       if(option == 1) { 
         $("#is_confirmed option[value=1]").prop('disabled' , true);
         $("#is_confirmed option[value=1]").text("Confirmed (option disabled)");
         $("#is_confirmed").val(0);
       }
    });

    <?php if (!empty($list_id)) { ?>
        $('#list-id').val(<?php echo $list_id; ?>).trigger('change');
    <?php } ?>
    });
    var basae_url = "{{ config('app.url') }}";
    // get contact list
    $('input[name="list_type"]').click(function(){

            var val = $(this).val();
            if(val=='users') {
                $('#list-id').empty();
                $('.bullData').show();
            }
            else
        {
                $('.bullData').hide();
                getListDropDown(val);
                $('#user_ids').val('');
        }

    });
    $("#user_ids").change(function(){
        u_id = $('#user_ids').val();
        getListDropDown(null,u_id);
    });

    // function for get contact list
    function getListDropDown(list_type,user_id=null) {
        $.ajax({
            type: 'POST',
            url: '{{route('listDropDown')}}',
            data: {'list_type':list_type,'user_id':user_id},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
                $('.form-control').removeClass('is-invalid');
                $('.error').css('display','none');
            },
            success: function (data) {
                $('.blockUI').hide();
                $('#list_type').empty();
                $('#list_type').html(data.html);
                $(".m-select2").select2();
            }
        });
    }
</script>
<script>
var storeUrl = "{{route('contact.store')}}";
var createUrl = "{{route('contact.create')}}";
var updateUrl = "{{route('contact.update','')}}/";
var editUrl = "{{route('contact.edit','|id|')}}";
var indexUrl = "{{route('contact.index')}}";
var listContacts = "{{route('list.contacts',"|id|")}}";
var addToList = "{{route('contactAddToList',"|id|")}}";
</script>
<script src="/themes/default/js/includes/subscriber.js?t={{time()}}" type="text/javascript"></script>
@endsection

@section(decide_content())
@if(Session::has('error_message'))
<div class="alert alert-danger alert-bold" role="alert" data-name="ToGdcUxX">
    <div class="alert-text" data-name="KClGANUY">{{ Session::get('error_message') }}</div>
</div>
@endif
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="pCrXoKkf">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="kuLfWzZk">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="tfwMwaPx">
    <span id='msg-text' class="alert-text"><span>
</div>


<!-- BEGIN FORM-->
@if($isExist==1)
<form action="" method="POST" id="subscriber-frm" class="kt-form kt-form--label-right">
    <div class="row" data-name="QCiGqdKB">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="redirect_action" id="redirect_action" value="0" />
        @if($page_data['action'] == 'add')
            <input type="hidden" id="action" value="add">
        @else
            <input type="hidden" id="subscriber-id" value="{{$subscriber->id}}">
            <input type="hidden" id="action" value="edit">
            
        @endif
        <div class="col-md-6 create-form" id="subscriber-firstBlk" data-name="MPmIrWrD">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="oItCKKNh">
                <div class="kt-portlet__head" data-name="vrXAVUQC">
                    <div class="kt-portlet__head-label" data-name="TbqjaKCT">
                        <h3 class="kt-portlet__head-title">{{trans('contacts.add_new.form.title')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="iYsTBvqG">
                    <div class="form-body" data-name="UbTBqlRy">
                        <div class="form-group row" id="list_type" data-name="AINrSPfl">
                                
                            <div class="col-md-12" data-name="IyDwpYyq">
                                <label class="col-form-label">{{trans('common.label.contact_list')}}
                                    <span class="required"> * </span>
                                    {!! popover( 'contacts.add_new.form.contact_list_help','common.description' ) !!}
                                </label>
                                <select class="form-control m-select2" data-placeholder="Choose List"  name="list_id" id="list-id" {{ ($page_data['action'] == 'edit') || isset($listOwnerId) || isset($list_id)? 'disabled' : '' }}>
                                    <option value="">{{trans('contacts.choose_a_list')}}</option>
                                    @foreach($group_lists as $key => $group)
                                    <optgroup label="{{$key}}">
                                        @foreach($group as $list)
                                        <option data-unconfirm="{{ $list['force_unconfirmed'] }}" value="{{ $list['id'] }}" {{ (isset($subscriber->list_id) && ($list['id']  == $subscriber->list_id)) || (!empty($list_id) && $list['id'] == $list_id) ? 'selected' : '' }}>{{ $list['name'] }}</option>
                                        @endforeach
                                    </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>

                        @php 
                            $allow_edit_email_address = getSetting("allow_edit_email_address");
                        @endphp

                        <div class="form-group row" data-name="hziBiFyp">
                            <div class="col-md-6" data-name="ecqhQGAA">
                                <label class="col-form-label">{{trans('contacts.add_new.form.email_address')}}
                                    <span class="required"> * </span>
                                    {!! popover( 'contacts.add_new.form.email_address_help','common.description' ) !!}
                                </label>
                                <div class="input-icon right" data-name="KvEsWxYt">
                                    <input type="text" name="email" @if(!empty($subscriber) and $allow_edit_email_address == "on") readonly style="background:#f9f9f9" @endif class="form-control" value="{{ isset($subscriber->email) ? $subscriber->email : '' }}"  />
                                </div>
                            </div>    
                            <div class="col-md-6" data-name="jNsdWCNp">
                                <label class="col-form-label">{{trans('common.label.format')}}
                                     {!! popover( 'contacts.add_new.form.format_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="format">
                                    <option value="html" {{ isset($subscriber->format) && ($subscriber->format == 'html') ? 'selected' : '' }}>{{trans('common.label.html')}}</option>
                                    <option value="text" {{ isset($subscriber->format) && ($subscriber->format == 'text') ? 'selected' : '' }}>{{trans('common.label.text')}}</option>
                                </select>
                            </div>
                            

                        </div>

                        @php 
                            $allow_sending_email_unconfirmed = getSetting("user_import_contacts_confirmed");
                        @endphp

                        <div class="form-group row" data-name="kBEwhUXo">
                            <div class="col-md-6" data-name="TJqSfSgb">
                                <label class="col-form-label">{{trans('contacts.add_new.form.confirmation')}}
                                    {!! popover( 'contacts.add_new.form.confirmation_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="is_confirmed" id="is_confirmed">
                                    @if($allow_sending_email_unconfirmed != "on" or (!empty($subscriber) and $subscriber->is_confirmed == 1))
                                        <option value="1" {{ isset($subscriber->is_confirmed) && $subscriber->is_confirmed ? 'selected' : '' }}>{{trans('common.confirmed')}}</option>
                                    @endif
                                    <option value="0" {{ isset($subscriber->is_confirmed) && !$subscriber->is_confirmed ? 'selected' : '' }}>{{trans('common.unconfirmed')}}</option>
                                  
                                </select>
                                @if($allow_sending_email_unconfirmed == "on")
                                    @if(!empty($subscriber) and $subscriber->is_confirmed == 1)
                                        
                                    @else 
                                    <small class="text-info">{{trans('contacts.create_blade.small_note_confirm_email_subscription')}}</small>
                                    @endif
                                @endif
                            </div>    
                            <div class="col-md-6" data-name="jxRrVcPz">
                                <label class="col-form-label">{{trans('common.label.status')}}
                                     {!! popover( 'contacts.add_new.form.status_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="is_active">
                                    <option value="1" {{ isset($subscriber->is_active) && $subscriber->is_active ? 'selected' : '' }}>{{trans('common.label.active')}}</option>
                                    <option value="0" {{ isset($subscriber->is_active) && !$subscriber->is_active ? 'selected' : '' }}>{{trans('common.label.inactive')}}</option>
                                </select>
                            </div>
                            
                        </div>

                        <div class="form-group row" data-name="kRZMlMob">
                             <div class="col-md-6" data-name="pPaVskgL">
                                <label class="col-form-label">{{trans('contacts.add_new.form.bounced')}}
                                    {!! popover( 'contacts.add_new.form.bounced_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="bounced">
                                    <option value="no_process" {{ isset($subscriber->bounced) && ($subscriber->bounced == 'no_process') ? 'selected' : '' }}>{{trans('contacts.add_new.form.not_bounced')}}</option>
                                    <option value="soft" {{ isset($subscriber->bounced) && ($subscriber->bounced == 'soft') ? 'selected' : '' }}>{{trans('contacts.add_new.form.soft_bounced')}}</option>
                                    <option value="hard" {{ isset($subscriber->bounced) && ($subscriber->bounced == 'hard') ? 'selected' : '' }}>{{trans('contacts.add_new.form.hard_bounced')}}</option>
                                </select>
                            </div>   
                            <div class="col-md-6" data-name="fRkCPafm">
                                <label class="col-form-label">{{trans('contacts.add_new.form.unsubscribed')}}
                                    {!! popover( 'contacts.add_new.form.unsubscribed_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="is_unsubscribed">
                                    <option value="0" {{ isset($subscriber->is_unsubscribed) && !$subscriber->is_unsubscribed ? 'selected' : '' }}>{{trans('common.form.buttons.no')}}</option>
                                    <option value="1" {{ isset($subscriber->is_unsubscribed) && $subscriber->is_unsubscribed ? 'selected' : '' }}>{{trans('common.form.buttons.yes')}}</option>
                                </select>
                            </div>
                            
                        </div>
                    </div>
                </div>
                {{--<div class="kt-portlet__foot" data-name="pTmEETwt">
                    <div class="form-actions" data-name="DXbxDtUN">
                        <div class="col-md-12action-buttons" data-name="UjXoTXfr">
                           
                            @if($page_data['action'] == 'add')
                            <button type="submit" name="save_add" class="btn btn-success" onclick="$('#redirect_action').val(0)"  value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                            <button type="submit" name="save_add" class="btn btn-success" onclick="$('#redirect_action').val(1)" value="save_exit">{{trans('common.form.buttons.save_exit')}}</button>
                            @else
                            <button type="submit" name="save_new" class="btn btn-success" onclick="$('#redirect_action').val(0)"  value="save_new">{{trans('common.form.buttons.save_add')}}</button>
                            <button type="submit" name="edit" class="btn btn-success" onclick="$('#redirect_action').val(0)" value="edit">{{trans('common.form.buttons.save')}}</button>
                            @endif
                            <a href="{{ route('contact.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                        </div>
                    </div> 
                </div>--}}
            </div>
        </div>
    </div>
    <div class="row" data-name="SnZVWNbh">
        <div class="col-md-6 create-form" id="custom-fields-data" data-name="IeRlCXjK">
        </div> 
    </div>
    <div class="row" data-name="nxMKsuJt">
        <div class="col-md-6 create-form" data-name="pmplIqjK">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="OsLSVeXr">
                <div class="kt-portlet__foot" data-name="GEzKlfsV">
                    <div class="form-actions" data-name="xFJxHgVH">
                        <div class="col-md-12action-buttons" data-name="tpjDGBaa">
                            @if($page_data['action'] == 'add')
                            <button type="submit" name="save_add" class="btn btn-success" onclick="$('#redirect_action').val(0)"  value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                            <button type="submit" name="save_add" class="btn btn-success" onclick="$('#redirect_action').val(1)" value="save_exit">{{trans('common.form.buttons.save_exit')}}</button>
                            @else
                            <button type="submit" name="save_new" class="btn btn-success" onclick="$('#redirect_action').val(0)"  value="save_new">{{trans('common.form.buttons.save_add')}}</button>
                            <button type="submit" name="edit" class="btn btn-success" onclick="$('#redirect_action').val(0)" value="edit">{{trans('common.form.buttons.save')}}</button>
                            @endif
                            <a href="{{ route('contact.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</form>
<!-- END FORM-->
@endif
@endsection