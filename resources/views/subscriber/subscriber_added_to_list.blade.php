@extends('layouts.master2')

@section('title', 'Subscriber Added to List')

@section('page_styles')
<style>
    .select2-results__group {
        color: #000000 !important;
        font-size: 14px !important;
    }
    @media(max-width: 767px){
        button.fa.fa-question {
            margin-top: 10px;
            margin-left: 15px;
        }
        .form-actions button {
            margin-bottom: 10px;
        }
    }
    @media (max-width: 1400px) and (min-width: 1024px) {
        .offset-lg-3 {
            margin-left: 0% !important;
        }
        .action-buttons {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
        .action-buttons>button, .action-buttons>a>button {
            margin-bottom: 5px !important;
            font-size: 80% !important;
            padding: 8px !important;
            min-width: 80px !important;
        }
        span.mailsign {
            position: absolute;
            left: 3px !important;
            top: 6px !important;
        }
    }
    @media (max-width: 1024px) and (min-width: 699px) {
        span.mailsign {
            position: absolute;
            left: 3px !important;
            top: 6px !important;
        }
    }
    @media (max-width: 414px){
        .action-buttons>button, .action-buttons>a>button {
            margin-bottom: 5px !important;
            font-size: 80% !important;
            padding: 8px !important;
            min-width: 80px !important;
        }
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
    jQuery(document).ready(function() {  
    	$(".m-select2").select2({
            placeholder: 'Select Option'
        });  
            // when user select a list
        $('#list-id').on('change', function() {
            loadListCustomField ();
        });

    });
    function loadListCustomField () {
        var list_id = $('#list-id').val();
        if (list_id == '') {
            $('#custom-fields-data').html('');
        } else{
            $.ajax({
                url: app_url+'/contact/custom/fields/'+list_id,
                type: "GET",
                data: { action: "add" },
                success: function(result) {
                    $('#custom-fields-data').html(result);
                }
            });
        }
    }

    loadListCustomField ();
</script>
 <!--   <script src="/js/includes/subscriber.js" type="text/javascript"></script> -->
@endsection

@section('content')

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="jtQeZBBH">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="eWRKsdcp">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="zxynSOpq">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<form action="{{ route('contact.list.store') }}" method="POST" class="kt-form kt-form--label-right">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row" data-name="MChRCyoU">
        <div class="col-md-6" data-name="XfcvlZkI">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="TkzxxhGp">
                <div class="kt-portlet__head" data-name="duVDMsqu">
                    <div class="kt-portlet__head-label" data-name="wWkPQXGT">
                        <h3 class="kt-portlet__head-title">{{trans('app.subscribers.add_new.table_headings.contact_detail')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="DlfCNsHJ">
                    <div class="form-body" data-name="OLRzOWUz">
                        <div class="form-group row" data-name="ohdmEVFM">
                            <label class="col-form-label col-md-3">{{trans('app.subscribers.add_new.fields.email')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-8" data-name="RsMOKAUN">
                                <div class="input-icon right" data-name="WpLItFGS">

                                    <input type="text" name="email" value="{{ isset($subscriber->email) ? $subscriber->email : '' }}" class="form-control" /> 
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.add_new.email.description')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="ZVrkKUEa">
                            <label class="col-form-label col-md-3">{{trans('app.subscribers.add_new.fields.lists')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-8" data-name="jwqGvBET">
                                <select class="form-control m-select2" data-placeholder="Choose List" name="list_id" id="list-id" >
                                    <option value="">{{ trans('app.subscribers.added_to_list.choose_list') }}</option>
                                    @foreach($group_lists as $key => $group)
                                        <optgroup label="{{$key}}">
                                            @foreach($group as $list)
                                            <option value="{{ $list['id'] }}" {{ isset($list_id) && $list['id']  == $list_id ? 'selected' : '' }}>
                                            {{ $list['name'] }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.add_new.list.description')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="NjFgJkXo">
                            <label class="col-form-label col-md-3">{{trans('app.subscribers.add_new.fields.format.title')}}
                            </label>
                            <div class="col-md-8" data-name="EGoYWnbd">
                                <select class="form-control" name="format">
                                        <option value="html">{{trans('app.subscribers.add_new.fields.format.values.html')}}</option>
                                        <option value="text">{{trans('app.subscribers.add_new.fields.format.values.text')}}</option>
                                </select>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.add_new.format.description')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="DsrioAPI">
                            <label class="col-form-label col-md-3">{{trans('app.subscribers.add_new.fields.confirmation_status.title')}}
                            </label>
                            <div class="col-md-8" data-name="JwYPEjmI">
                                <select class="form-control" name="is_confirmed">
                                        <option value="1">{{trans('app.subscribers.add_new.fields.confirmation_status.values.confirmed')}}</option>
                                        <option value="0">{{trans('app.subscribers.add_new.fields.confirmation_status.values.unconfirmed')}}</option>
                                </select>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.add_new.confirmation_status.description')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="yWCyrZgi">
                            <label class="col-form-label col-md-3">{{trans('app.subscribers.add_new.fields.status.title')}}
                            </label>
                            <div class="col-md-8" data-name="khJNBkik">
                                <select class="form-control" name="is_active">
                                        <option value="1">{{trans('app.subscribers.add_new.fields.status.values.active')}}</option>
                                        <option value="0">{{trans('app.subscribers.add_new.fields.status.values.inactive')}}</option>
                                </select>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.add_new.status.description')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="PyDtbSfJ">
                            <label class="col-form-label col-md-3">{{trans('app.subscribers.add_new.fields.bounced.title')}}
                            </label>
                            <div class="col-md-8" data-name="fhqlZtWa">
                                <select class="form-control" name="bounced">
                                        <option value="no_process">{{trans('app.subscribers.add_new.fields.bounced.values.no')}}</option>
                                        <option value="soft">{{trans('app.subscribers.add_new.fields.bounced.values.soft')}}</option>
                                        <option value="hard">{{trans('app.subscribers.add_new.fields.bounced.values.hard')}}</option>
                                </select>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.add_new.bounced.description')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="nkcLnruL">
                            <label class="col-form-label col-md-3">{{trans('app.subscribers.add_new.fields.unsubscribed.title')}}
                            </label>
                            <div class="col-md-8" data-name="OxFCSqEZ">
                                <select class="form-control" name="is_unsubscribed">
                                        <option value="0">{{trans('app.subscribers.add_new.fields.unsubscribed.values.no')}}</option>
                                        <option value="1">{{trans('app.subscribers.add_new.fields.unsubscribed.values.yes')}}</option>
                                </select>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.subscribers.add_new.unsubscribed.description')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                   <div class="form-actions" data-name="AwCfdpyr">
                        <div class="row" data-name="PIIcwmTz">
                           <div class="col-lg-9 col-md-12 col-sm-12 offset-lg-3 action-buttons" data-name="jRUQOHKI">
                                <button type="submit" name="save_add" class="btn btn-success" onclick="$('#redirect_action').val(0)"  value="save_add">{{trans('common.form.buttons.save_add')}}</button>
                                    <button type="submit" name="save_add" class="btn btn-success" onclick="$('#redirect_action').val(1)" value="save_exit">{{trans('common.form.buttons.save_exit')}}</button>
                                    
                                    <a href="{{ route('contact.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
                            </div>
                        </div>
                    </div> 
          </div>
       </div>
    </div>
</div>

        <div id='custom-fields-data' class="col-md-6" data-name="yjYdIpmc"></div>
</form>
<!-- END FORM-->
@endsection