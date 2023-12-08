@extends('layouts.master')

@section('title', $page_data['title'])
@section('page_scripts')
       <script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
       <script>
            var form_error="{{trans('common.message.form_error')}}";
       </script>
       <script src="/js/includes/notification.js" type="text/javascript"></script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="zadgwHKX">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.settings.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span><a href="{{ route('notification.index') }}">{{trans('app.settings.notifications.view_all.title')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{ $page_data['title'] }}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{ $page_data['title'] }}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="WDyjOIpG">
    <p>{{getHeading(trans('app.headings.settings.notifications.add'))}}</p>
</div>
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="QBgeaYCL">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="pjLPVcDq">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="qWxCCSKg">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="row" data-name="AuCqfpDi">
    @if ($page_data['action'] == 'add')
        <form action="{{route('notification.store')}}" method="POST" id="notification-frm" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else 
        <form action="{{ route('notification.update', $notifications->id) }}" method="POST" id="notification-frm" class="form-horizontal">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="fbl-id" value="{{$notifications->id}}">
        <input type="hidden" name="_method" value="PUT">
    @endif

        <div class="col-md-12" data-name="otZzdMvR">
            <div class="portlet box green" data-name="kKNbtBfg">
                <div class="portlet-title" data-name="zxGzqWsV">
                    <div class="caption" data-name="YhWlhvJS">
                        <span class="caption-subject">{{trans('app.settings.notifications.add_new.table_headings.notification')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="slbwVIqB">
                    <div class="form-body" data-name="CiXuXbPL">
                        <div class="form-group" data-name="mxGgcNwD">
                            <label class="control-label col-md-3">{{trans('app.settings.notifications.add_new.fields.title')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="aRiDooBh">
                                <div class="input-icon right" data-name="srkvVzUQ">
                                    <i class="fa"></i>
                                    <input type="text" name="title" value="{{isset($notifications->title) ? $notifications->title : '' }}" class="form-control" /> 
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="CjQnORKd">
                            <label class="control-label col-md-3">{{trans('app.settings.notifications.add_new.fields.description')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="BJMhNBPA">
                                <div class="input-icon right" data-name="rXGXGMbb">
                                    <i class="fa"></i>
                                    <textarea name="description" class="form-control" rows="12">{{@$notifications->description}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group" data-name="pwtftZgw">
                            <label class="control-label col-md-3">{{trans('app.settings.notifications.add_new.fields.publish.title')}}
                            </label>
                            <div class="col-md-6" data-name="nVTMNJap">
                                <select class="form-control" name="is_publish">
                                        <option value="0" {{ (isset($notifications->is_publish) && $notifications->is_publish == 0) ? 'selected' : '' }}>
                                            {{trans('app.settings.notifications.add_new.fields.publish.values.yes')}}
                                        </option>
                                        <option value="1" {{ (isset($notifications->is_publish) && $notifications->is_publish == 1) ? 'selected' : '' }}>
                                            {{trans('app.settings.notifications.add_new.fields.publish.values.no')}}
                                        </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions" data-name="XLkrSgFO">
                            <div class="row" data-name="YgjwjxEs">
                                <div class="col-md-6 col-md-offset-3" data-name="RJvITUtW">
                                    <button type="submit" name="save_add" class="btn green" value="save_add">{{trans('app.settings.notifications.add_new.buttons.save_add')}}</button>
                                    @if ($page_data['action'] == 'add')
                                    <button type="submit" name="save_exit" class="btn green" value="save_exit">{{trans('app.settings.notifications.add_new.buttons.save_exit')}}</button>
                                    @else
                                    <button type="submit" name="edit" class="btn green" value="edit">{{trans('app.settings.notifications.add_new.buttons.save')}}</button>
                                    @endif
                                    <a href="{{ route('notification.index') }}"><button type="button" class="btn grey-salsa btn-outline">{{trans('app.settings.notifications.add_new.buttons.return')}}</button></a>
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
<style type="text/css">
.form-actions .btn {margin-bottom: 10px;}    
</style>
@endsection