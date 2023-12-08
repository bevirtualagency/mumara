@extends('layouts.master')

@section('title', $page_data['title'])

@section('page_styles')
@endsection

@section('page_scripts')
<script src="/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/package.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="OpiEFzfl">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('users.create_package_blade.client_management_span')}}</span>
            <i class="fa fa-circle"></i>
        </li>
      @if(rolePermission(177))
        <li>
            <span><a href="{{ route('role.package.view') }}">{{trans('app.user_management.package.view_all.title')}}</a></span>
            <i class="fa fa-circle"></i>
        </li>
      @endif
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
<div class="m-heading-1 border-green m-bordered" data-name="YxUVUhdU">
    <p> {{getHeading(trans('app.headings.user_management.package.add'))}} </p>
</div>
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="uSAIdKon">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="zPQBnUAG">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="MSZVHvuy">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="row" data-name="NtjqAZoT">
    @if ($page_data['action'] == 'add')
        <form action="{{ route('role.package.create') }}" method="POST" id="subuser-frm" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else 
        <form action="{{ route('role.package.update',  $package->id) }}" method="POST" id="subuser-frm" class="form-horizontal">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="user-id" value="{{$package->id}}">
        <input type="hidden" name="_method" value="PUT">
    @endif
        <div class="col-md-8" data-name="uYaYagBq">
            <div class="portlet box green" data-name="wCgmHkYY">
                <div class="portlet-title" data-name="nJgwMQcW">
                    <div class="caption" data-name="ULsUTwMx">
                        <span class="caption-subject bold uppercase">{{trans('app.user_management.package.add_new.table_headings.package_details')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="usSoNhYj">
                    <div class="form-body" data-name="ihkQbvnB">
                        <div class="form-group" data-name="GQMyxHgD">
                            <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.package_name')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-8" data-name="YlHLTwgj">
                                <div class="input-icon right" data-name="QTawDzFc">
                                    <i class="fa"></i>
                                    <input type="text" name="package_name" value="{{isset($package->package_name) ? $package->package_name : '' }}" class="form-control" />
                                </div>
                            </div>
                            <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.package_name.description')}}" data-original-title="{{trans('app.help.user_management.package.package_name.title')}}"></button>
                        </div>
                        <div class="form-group" data-name="MdjJyLOk">
                            <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.role_group')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-8" data-name="cIQAYoMb">
                            <select class="form-control select2" data-placeholder="Choose Role" name="role_id" id="role-id">
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ (isset($package->role_id) && $package->role_id == $role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>
                        <div class="form-group" data-name="FzasJzAW">
                            <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.lists_limit')}}
                            </label>
                            <div class="col-md-8" data-name="fXyGsjmF">
                                <div class="input-icon right" data-name="XKSsfueK">
                                    <i class="fa"></i>
                                    <input type="text" name="lists_limit" value="{{isset($package->lists_limit) ? $package->lists_limit : '' }}" class="form-control"/>
                                </div>
                                <small>{{trans('app.user_management.package.add_new.fields.help.title')}}</small>
                            </div>
                            <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.lists_limit.description')}}" data-original-title="{{trans('app.help.user_management.package.lists_limit.title')}}"></button>
                        </div>
                        <div class="form-group" data-name="nxfgPnBN">
                            <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.subscribers_limit')}}
                            </label>
                            <div class="col-md-8" data-name="zNaCoKWm">
                                <div class="input-icon right" data-name="IGwOPfgh">
                                    <i class="fa"></i>
                                    <input type="text" name="subscribers_limit" value="{{isset($package->subscribers_limit) ? $package->subscribers_limit : '' }}" class="form-control"/>
                                </div>
                                <small>{{trans('app.user_management.package.add_new.fields.help.title')}}</small>
                            </div>
                            <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.subscribers_limit.description')}}" data-original-title="{{trans('app.help.user_management.package.subscribers_limit.title')}}"></button>
                        </div>
                        <div class="form-group" data-name="ZBqtykzF">
                            <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.smtps_limit')}}
                            </label>
                            <div class="col-md-8" data-name="YXmqDMjW">
                                <div class="input-icon right" data-name="RQDjpmQA">
                                    <i class="fa"></i>
                                    <input type="text" name="smtps_limit" value="{{isset($package->smtps_limit) ? $package->smtps_limit : '' }}" class="form-control"/>
                                </div>
                                <small>{{trans('app.user_management.package.add_new.fields.help.title')}}</small>
                            </div>
                            <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.smtps_limit.description')}}" data-original-title="{{trans('app.help.user_management.package.smtps_limit.title')}}"></button>
                        </div>
                        <div class="form-group" data-name="mNoLdGGJ">
                            <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.monthly_email_limit')}}
                            </label>
                            <div class="col-md-8" data-name="gjPvXZyw">
                                <div class="input-icon right" data-name="iNWNmzKJ">
                                    <i class="fa"></i>
                                    <input type="text" name="monthly_email_limit" value="{{isset($package->monthly_email_limit) ? $package->monthly_email_limit : '' }}" class="form-control"/>
                                </div>
                                <small>{{trans('app.user_management.package.add_new.fields.help.title')}}</small>
                            </div>
                            <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.monthly_email_limit.description')}}" data-original-title="{{trans('app.help.user_management.package.monthly_email_limit.title')}}"></button>
                        </div>
                        <div class="form-group" data-name="wmLJSElH">
                            <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.daily_email_limit')}}
                            </label>
                            <div class="col-md-8" data-name="iQjAIxoi">
                                <div class="input-icon right" data-name="auuypTOK">
                                    <i class="fa"></i>
                                    <input type="text" name="daily_email_limit" value="{{isset($package->daily_email_limit) ? $package->daily_email_limit : '' }}" class="form-control"/>
                                </div>
                                <small>{{trans('app.user_management.package.add_new.fields.help.title')}}</small>
                            </div>
                            <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.daily_email_limit.description')}}" data-original-title="{{trans('app.help.user_management.package.daily_email_limit.title')}}"></button>
                        </div>
                        <div class="form-group" data-name="EzqsWhnO">
                            <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.hourly_email_limit')}}
                            </label>
                            <div class="col-md-8" data-name="gjRtbjEH">
                                <div class="input-icon right" data-name="RwzmpQaM">
                                    <i class="fa"></i>
                                    <input type="text" name="hourly_email_limit" value="{{isset($package->hourly_email_limit) ? $package->hourly_email_limit : '' }}" class="form-control"/>
                                </div>
                                <small>{{trans('app.user_management.package.add_new.fields.help.title')}}</small>
                            </div>
                            <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.hourly_email_limit.description')}}" data-original-title="{{trans('app.help.user_management.package.hourly_email_limit.title')}}"></button>
                        </div>
                        <!-- <div class="form-group">
                        <label class="control-label col-md-3">{{trans('Modules')}}</label>
                        <div class="col-md-8">
                            <div class="portlet light bordered" style="overflow: auto; height: 380px;">
                                <div class="portlet-body">
                                @foreach ($modules_array as $key => $module)
                                    <input type="checkbox" value="{{$key}}" name="modules[]" {{ isset($package->modules) && in_array($key, explode(',', $package->modules)) ? 'checked' : '' }}> {{$module}} <br>
                                @endforeach
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group" data-name="sIWwlhQc">
                        <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.list_permission')}}</label>
                        <div class="col-md-8" data-name="oPSicxni">
                            <div class="portlet light bordered" style="overflow: auto; height: 380px;" data-name="mlRBizpf">
                                <div class="portlet-body" data-name="DVNowUVZ">
                                    @foreach ($list_tree as $group_metadata)
                                        <div data-name="QGNoUuLc">
                                            <input class="group-selector-subscriber" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group[]"> <strong>{{ $group_metadata['name'] }}</strong>
                                        </div>
                                        @foreach ($group_metadata['children'] as $list_metadata)
                                            <div style="padding-left: 20px;" data-name="jIMwaqcu">
                                                <input type="checkbox" value="{{ $list_metadata['id'] }}" name="lists[]" class="group-subscriber-{{ $group_metadata['id'] }}" {{ isset($lists['lists_ids']) && in_array($list_metadata['id'] , $lists['lists_ids']) ? 'checked' : '' }}> {{ $list_metadata['name'] }}
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.list_permission.description')}}" data-original-title="{{trans('app.help.user_management.package.list_permission.title')}}"></button>
                    </div>
                    <div class="form-group" data-name="jTTDfzWq">
                        <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.segment_permission')}}</label>
                        <div class="col-md-8" data-name="ExoTflSO">
                            <div class="portlet light bordered" style="overflow: auto; height: 380px;" data-name="pzKSPLlK">
                                <div class="portlet-body" data-name="ptPoTmAK">
                                    @foreach($segments as $segment)
                                        <div data-name="tlVwSIFL">
                                            <input type="checkbox" value="{{$segment->id}}" name="segments[]" {{ isset($role_segments['segment_ids']) && in_array($segment->id , $role_segments['segment_ids']) ? 'checked' : '' }} />
                                            {{$segment->name}}
                                            <span></span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.segment_permission.description')}}" data-original-title="{{trans('app.help.user_management.package.segment_permission.title')}}"></button>
                    </div>
                    <div class="form-group" data-name="MeEJoUJb">
                        <label class="control-label col-md-3">{{trans('app.user_management.package.add_new.fields.email_template_permission')}}</label>
                        <div class="col-md-8" data-name="TDJzMIBG">
                            <div class="portlet light bordered" style="overflow: auto; height: 480px;" data-name="DCYtumrb">
                                <div class="portlet-body" data-name="fVBJnYKF">
                                    @foreach ($email_template_tree as $group_metadata)
                                        <div data-name="hSMIaHip">
                                            <input class="group-selector-subscriber" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group[]"> <strong>{{ $group_metadata['name'] }}</strong>
                                        </div>
                                        @foreach ($group_metadata['children'] as $list_metadata)
                                            <div style="padding-left: 20px;" data-name="qObVayLp">
                                                <input type="checkbox" value="{{ $list_metadata['id'] }}" name="email_templates[]" class="group-subscriber-{{ $group_metadata['id'] }}" {{ isset($email_templates['email_template_ids']) && in_array($list_metadata['id'] , $email_templates['email_template_ids']) ? 'checked' : '' }}> {{ $list_metadata['name'] }}
                                            </div>
                                        @endforeach
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <button type="button" tabindex="-1" class="fa fa-question btn green btn-sm popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.package.email_template_permission.description')}}" data-original-title="{{trans('app.help.user_management.package.email_template_permission.title')}}"></button>
                    </div>

                    <div class="form-group row" data-name="UiFVTFMG">
                        <div class="col-md-12 row" data-name="atIAvfhT">
                            <label class="col-form-label pl12" for="sender_info_option_monthy">
                                {{ trans('users.threads') }}
                            </label>
                            <div data-name="AQjUPmFb" class="col-md-6" id="max_threads">
                                <input type="text" value="{{isset($package->max_threads) ? $package->max_threads : '' }}" class="form-control user-input-val" name="max_threads" placeholder="Threads">
                            </div>
                        </div>
                    </div>

                    <div class="form-actions" data-name="HIrDiCLu">
                        <div class="row" data-name="PzUInPNY">
                            <div class="col-md-offset-4" data-name="YtaONiRH">
                                <button type="submit" name="" class="btn green" value="">{{trans('app.user_management.package.add_new.buttons.save')}}</button>
                                <button type="reset" class="btn grey-salsa btn-outline">{{trans('app.user_management.package.add_new.buttons.reset')}}</button>
                                <a href="{{ route('role.package.view') }}"><button type="button" class="btn grey-salsa btn-outline">{{trans('app.user_management.package.add_new.buttons.return')}}</button></a>
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