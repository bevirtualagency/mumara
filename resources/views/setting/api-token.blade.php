@extends('layouts.master2')

@section('title', trans('app.sidebar.api_key'))

@section('page_styles')
<link rel="stylesheet" type="text/css" href="/resources/assets/css/setting-api.css?v={{$local_version}}.02">
@endsection

@section('page_scripts')
<script type="text/javascript">
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Settings/Api-Key");

    });
    function copyFunction() {
      var copyText = document.getElementById("optkey");
      copyText.select();
      document.execCommand("copy");
      //alert("Copied the text: " + copyText.value);
      Command: toastr["success"] ("{{trans('app.dashboard.lang.success_copied')}}"); 
    }
</script>
@endsection

@section('content')

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="QBSgWRlO">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="bcyGmaML">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="llaJlVGB">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-12" data-name="ANhTEOpC"> 
        <form action="{{ route('setting.api',  $user->id) }}" method="POST" id="token-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="_method" value="PUT">

        <div class="row" data-name="JppCQBgz">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="GlyETUPS">
                <div class="kt-portlet__head" data-name="snZXLRqW">
                    <div class="kt-portlet__head-label" data-name="lgrBTvIg">
                        <h3 class="kt-portlet__head-title">{{trans('app.settings.api.token')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="fXVqGpbm">
                    <div class="form-body" data-name="oxxbbVXv">
                        <div class="form-group row" data-name="HWZQiXAL">
                            <label class="col-form-label col-md-3">{{trans('app.dashboard.lang.token')}}
                            </label>
                            <div class="col-md-6" data-name="yvgqjdhG">
                                <div class="input-icon right" data-name="XNZEHSXa">
                                    <i class="la la-copy" onclick="copyFunction()"></i>
                                    <input type="text" name="api_token" value="{{isset($user->api_token) ? $user->api_token : '' }}" id="optkey" class="form-control" readonly="" />
                                </div>
                            </div>
                        </div>
                        <div class="form-actions" data-name="TiCgqUmf">
                            <div class="row" data-name="nYUzGETv">
                                <label class="col-form-label col-md-3"></label>
                                <div class="col-md-6" data-name="BKziQVjj">
                                    <button type="submit" name="btn" class="btn btn-success" value="">{{trans('app.settings.api.generate_token')}}</button>
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