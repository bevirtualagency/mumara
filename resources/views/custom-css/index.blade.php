@extends('layouts.master2')

@section('title', trans('app.custom_css.title'))

@section('page_styles')
<style type="text/css">
    textarea.form-control {
        height: auto;
        /*background: #333;
        color: #ddd;*/
        font-size: 1.03rem;
        letter-spacing: 0.5px;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
    <script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
    <script src="/themes/default/js/init.js" type="text/javascript"></script>
    <script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<!-- <script src="/public/js/custom_css.js" type="text/javascript"></script> -->
<script type="text/javascript">
    $(document).ready(function() {

        $("#custom-css-frm").validate({
            ignore: [],       
            rules: {
                css: {
                    required: !0
                }
            },
            invalidHandler: function(event, validator) {     
                Command: toastr["error"] ("{{trans('common.custome_css_blade.command_empty_css')}}");
            },
            submitHandler: function (form) {
                var method = 'PUT';
                var form_data =  $("#custom-css-frm").serialize();
                $.ajax({
                    url: '{{ Route("store.css") }}',
                    type: method,
                    data: form_data,
                    dataType:'json',
                    beforeSend: function () {
                        $(".blockUI").show();
                    },
                    complete: function () {
                        $(".blockUI").hide();
                    },
                    success: function(result) {
                        // console.log(result.response);
                        if (result.response == 'saved') {
                            Command: toastr["success"] ("{{trans('common.custome_css_blade.command_custome_styling')}}");
                            window.location = app_url+"/custom-css";
                        }    
                        else {
                            Command: toastr["error"] ("{{trans('common.custome_css_blade.command_nothing_change')}}");
                        }
                        return false;
                    }
                });
            }
        });
    });
</script>
@endsection

@section('content')

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="KunHFqkY">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="EqwVUSWY">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages -->
<div id="msg" class="display-hide" data-name="jNSjpkxO">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="col-md-12" data-name="bIsFhnzj">

    <form action="" method="POST" id="custom-css-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input name="_method" type="hidden" value="PUT">

        <div class="row" data-name="IbBDpNsw">

            <div class="kt-portlet kt-portlet--height-fluid" data-name="skEYVBDd">
                <div class="kt-portlet__head" data-name="XWohMwSA">
                    <div class="kt-portlet__head-label" data-name="NfcMJfQZ">
                        <h3 class="kt-portlet__head-title">{{trans('app.custom_css.block_title')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="lrPEhfvn">
                    <div class="form-body" data-name="WQIzzZjo">
                        <div class="form-group row" data-name="EygdWEFh">
                            <label class="col-form-label col-md-3">{{trans('app.custom_css.title')}}
                            </label>
                            <div class="col-md-6" data-name="YbLyYUFN">
                                <div class="input-icon right" data-name="HrDCqcAM">
                                    <textarea name="css" class="form-control scroll scroll-200" rows="15" >{{isset($css) ? $css : '' }}</textarea>
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.custom_css.help')}}" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                    </div>
                    <div class="form-actions" data-name="VtslVDJS">
                        <div class="row" data-name="DxQfnLrR">
                            <label class="col-form-label col-md-3"></label>
                            <div class="col-md-6" data-name="GEntPdhe">
                                <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('common.form.buttons.save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </form>

</div>
@endsection