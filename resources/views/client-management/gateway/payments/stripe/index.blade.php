@extends('layouts.master')

@section('title', trans('client.stripe.main_title'))

@section('page_styles')
    <link href="/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
@endsection

@section('page_scripts')
    <script src="/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
    <script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
{{--    <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js" type="text/javascript"></script>
    <script>
        var form_error="{{trans('common.message.form_error')}}";
        $(document).ready(function () {
           $('#pay_now').on('click',function(){
               alert();
               $("#pay-with-stripe").validate({
                   rules: {
                       'card_no': {
                           required: true
                       },
                       'cvvNumber': {
                           required: true
                       },

                       'ccExpiryMonth': {
                           required: true
                       },
                       'ccExpiryYear': {
                           required: true
                       }
                   },
                   messages: {
                       'card_no': "{{ trans('file.add_currencies.validation_msg.code') }}",
                       'cvvNumber': "{{ trans('file.add_currencies.validation_msg.prefix') }}",
                       'ccExpiryMonth': "{{ trans('file.add_currencies.validation_msg.sufix') }}",
                       'ccExpiryYear': "{{ trans('file.add_currencies.validation_msg.format') }}"
                   },
                   submitHandler: function () {
                       $.ajax({
                           type: "POST",
                           url: "{{ route('postPaymentWithStripe') }}",
                           data: $("#pay-with-stripe").serialize(),
                           cache: false,
                           dataType: 'JSON',
                           beforeSend: function () {

                           },
                           success: function (data) {
                               if (data.status) {
                                   alert(data.message);
                               }
                               else
                               {
                                   alert(data.message);
                               }
                           }
                       });
                   }
               });
           })
        });

    </script>
    {{--<script src="/js/includes/user.js" type="text/javascript"></script>--}}
@endsection

@section('content')
    <!-- BEGIN PAGE BAR -->
    <div class="page-bar" data-name="hGPCVljA">
        <ul class="page-breadcrumb">
            <li>
                <span>{{trans('client.stripe.breadCrumb.0')}}</span>
                <i class="fa fa-circle"></i>
            </li>

            <li>
                <span><a href="{{ route('user.index') }}">{{trans('client.stripe.breadCrumb.1')}}</a></span>
                <i class="fa fa-circle"></i>
            </li>
        </ul>
    </div>
    <!-- END PAGE BAR -->
    <!-- BEGIN PAGE TITLE-->
    <h1 class="page-title">{{trans('client.stripe.page_title')}}</h1>
    <!-- END PAGE TITLE-->
    <!-- END PAGE HEADER-->
    <div class="m-heading-1 border-green m-bordered" data-name="ZoYgXmGU">
        <p> {{(trans('client.stripe.page_heading'))}}</p>
    </div>
    @if($errors->any())
        <!-- For PHP validations errors-->
        <div class="alert alert-danger" data-name="JjDBIgEX">
            @foreach($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="WeJJDVSx">
            {{ Session::get('msg') }}
        </div>
    @endif
    <!-- will be used to show any messages about form -->
    <div id="msg" class="display-hide" data-name="AybBJPFt">
        <span id='msg-text'></span>
    </div>
    <!-- BEGIN FORM-->
    <div class="row" data-name="PvtTkjhC">

        <form id="pay-with-stripe" class="form-horizontal"  novalidate="novalidate">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="id" value="{{ $package->id }}">
            <div class="col-md-12" data-name="NBCSObtd">
                <div class="portlet light bordered" data-name="FzHIMewH">
                    <div class="portlet-title" data-name="imdeEwQs">
                        <div class="caption" data-name="LdUnkaap">
                            <span class="caption-subject sbold">{{(trans('client.stripe.form_heading'))}}</span>
                        </div>
                    </div>
                    <div class="portlet-body" data-name="MagWzLCG">
                        <div class="form-body" data-name="oZYcQUxM">
                            <div class="form-group" data-name="kidRYxPt">
                                <label class="control-label col-md-3">{{(trans('client.stripe.label_input.package_name'))}}
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-6" data-name="NhPKHgfR">
                                    <div class="input-icon right" data-name="JHywWHZh">
                                        <i class="fa"></i>
                                        <input type="text" name="name" value="{{isset($package) ? $package->package_name : '' }}" class="form-control" readonly>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group" data-name="WpRfjpPI">
                                <label class="control-label col-md-3">{{(trans('client.stripe.label_input.price'))}}
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-6" data-name="GQNHTwBD">
                                    <div class="input-icon right" data-name="VGxaTJMC">
                                        <i class="fa"></i>
                                        <input type="text" name="amount" value="{{isset($package) ? $package->price : '' }}" class="form-control" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group" data-name="QgPWirXY">
                                <label class="control-label col-md-3">{{(trans('client.stripe.label_input.card_no'))}}
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-6" data-name="feguGswR">
                                    <div class="input-icon right" data-name="HhLOvDLZ">
                                        <i class="fa"></i>
                                        <input type="text" name="card_no" class="form-control" value="4242424242424242">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group" data-name="fPJmhSwk">
                                <label class="control-label col-md-3">{{(trans('client.stripe.label_input.cvvNumber'))}}
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-6" data-name="paCqnioE">
                                    <div class="input-icon right" data-name="KwafWHhd">
                                        <i class="fa"></i>
                                        <input type="text" name="cvvNumber" class="form-control" value="798" >
                                    </div>
                                </div>
                            </div>



                            <div class="form-group" data-name="XbQAjsco">
                                <label class="control-label col-md-3">{{(trans('client.stripe.label_input.ccExpiryMonth'))}}
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-6" data-name="WapCclma">
                                    <div class="input-icon right" data-name="AizhSYKa">
                                        <i class="fa"></i>
                                        <input type="text" name="ccExpiryMonth" class="form-control" value="12" >
                                    </div>
                                </div>
                            </div>




                            <div class="form-group" data-name="WudTtOcc">
                                <label class="control-label col-md-3">{{(trans('client.stripe.label_input.ccExpiryYear'))}}
                                    <span class="required"> * </span>
                                </label>
                                <div class="col-md-6" data-name="vLAgknol">
                                    <div class="input-icon right" data-name="RUxZKDBD">
                                        <i class="fa"></i>
                                        <input type="text" name="ccExpiryYear" class="form-control" value="2018" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions" data-name="YTaBxBTE">
                                <div class="row" data-name="ALQBmMBX">
                                    <div class="col-md-offset-4" data-name="ySxMfyxL">
                                        <button type="button" id="pay_now" class="btn green">{{(trans('client.stripe.label_btn.pay'))}}</button>
                                    </div>
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