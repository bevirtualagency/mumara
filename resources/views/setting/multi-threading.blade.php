@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/multithread.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {
            
        $("a#help-article").css("display", "block");
        $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Multi-Threading");

        $('.m-select2').select2({
            placeholder: "Select Threads"
        });
    });

    $('#threads').change(function(){
        $('#div-message').hide();
        if(parseInt(this.value) >= 10){
            $('#div-message').show();
        }
    });
</script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="BFKoxgyq">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="MPIuTsyd">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="LNhcoZUY">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="KJAHplkr">  
    <form action="{{ route('setting.multi-threading',  $user_id) }}" method="post" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="row" data-name="xkgGEbqy">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="OLwXCkdB">
                <div class="kt-portlet__head" data-name="ASqqpKkR">
                    <div class="kt-portlet__head-label" data-name="azcNXCUL">
                        <h3 class="kt-portlet__head-title">{{trans('multithreading.page.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="qqHAFIpZ">
                    <div class="form-group row" data-name="dFjuZesw">
                        <label class="col-form-label pl12">{{trans('common.label.status')}}
                            {!! popover('multithreading.page.form.status_help','common.description') !!}
                        </label>
                        <div class="col-md-6" data-name="CLkOSold">
                            <div class="input-icon right" data-name="TnLwxlON">

                                @if(getSetting('multi_threading') == "on")
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" checked  name="multi_threading">
                                        <span></span>
                                    </label>
                                </span>
                                @else
                                    <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                        <label>
                                            <input type="checkbox" name="multi_threading">
                                            <span></span>
                                        </label>
                                    </span>

                                @endif
                               
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="div-threading" data-name="VZQOMqoo">
                        @php
                            $multi_threads = getSetting("threads");
                        @endphp
                        <div class="col-md-12" data-name="qMtISgnh">
                            <label class="col-form-label">{{trans('multithreading.page.form.threads')}}
                                 {!! popover('multithreading.page.form.threads_help','common.description') !!}
                            </label>
                            <div class="input-icon right" data-name="YElPHVLq">
                                <select class="form-control m-select2" name="threads" id="threads">
                                    @foreach($threads as $thread)
                                        <option value="{{ $thread }}" {{ (isset($multi_threads) && $thread == $multi_threads) ? 'selected' : '' }}>{{ $thread }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="div-message" style="display: none;" data-name="lDCFhYuu">
                        <label class="col-form-label col-md-3"></label>
                        <div class="col-md-6" data-name="zCXSLPWi">
                            <div class="alert alert-solid-warning alert-bold" data-name="OIgjJHCm">{{trans('multithreading.page.form.message')}}</div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="mluwuBKQ">
                    <div class="form-actions" data-name="TnHqJmYY">
                        <div class="row" data-name="YmRGRlHv">
                            <div class="col-md-12" data-name="gNcToUsd">
                                <button type="submit" name="submit" class="btn btn-success">{{trans('common.form.buttons.save')}}</button>
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