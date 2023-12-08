@extends('layouts.master')

@section('title', $page_data['title'])

@section('page_styles')
    <style type="text/css">
    	form.form-horizontal .form-actions .row {
		    margin: 0;
		}
		form.form-horizontal .form-actions .row button.btn.green {
		    margin-left: 10px;
		}
    </style>
@endsection

@section('page_scripts')
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="EVHhCHuy">
    <ul class="page-breadcrumb">
        <li>
            <span><a href="{{ route('dashboard') }}">{{trans('app.breadcrumbs.dashboard')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><a href="javascript:;">{{trans('app.breadcrumbs.settings')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('app.breadcrumbs.license')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{ $page_data['title'] }}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="JYwaRwzM">
    <p>{{getHeading(trans('app.headings.settings.multi_threading'))}}</p>
</div>
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="DoTzbaPU">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="QAgnovth">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="kQOcwJms">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="row" data-name="xVwzseRq">
        <form action="" method="post" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="col-md-8" data-name="aXiWfZUW">
            <div class="portlet box green" data-name="DMAXVeyw">
                <div class="portlet-title" data-name="qyFEaWGM">
                    <div class="caption" data-name="jlGzRRvn">
                        <span class="caption-subject">{{trans('app.settings.multi_threading.table_headings.multi_threading')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="bhyYdQMB">
                    <div class="form-group" data-name="dILEauAx">
                        <label class="control-label col-md-4">{{ trans('app.dashboard.lang.license_key') }}
                        </label>
                        <div class="col-md-7" data-name="VGnbXtPf">
                            <div class="input-icon right" data-name="EVycHdRZ">
                                <i class="fa"></i>
                                <input type="text" class="form-control" name="license-key" value="{{isset($setting->license_key ) ? $setting->license_key : '' }}" required />
                            </div>
                        </div>
                        <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.settings.multi_threading.threads.description')}}" data-original-title="{{trans('app.help.settings.multi_threading.threads.title')}}"></i>
                    </div>
                    <div class="form-actions" data-name="wsBXufoB">
                        <div class="row" data-name="xPneojHK">
                            <div class="col-md-offset-4 col-md-4" data-name="gJEsNpnw">
                                <button type="submit" name="submit" class="btn green">{{trans('app.settings.multi_threading.buttons.save')}}</button>
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