@extends('layouts.master')

@section('title', $page_data['title'])

@section('page_styles')

@endsection

@section('page_scripts')
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/subuser_role.js" type="text/javascript"></script>
<script>
function selectAll(role_class, id)
{
    if ($('#'+id).val() == 'Check All') {
        $('.'+id).prop('checked', true);
        $('#'+id).val('Uncheck All');
    } else {
        $('.'+id).prop('checked', false);
        $('#'+id).val('Check All');
    }
}

function selectAllSubRole(role_class, id)
{
    if ($('#'+id).prop('checked')) {
        $('.'+id).prop('checked', true);
    } else {
        $('.'+id).prop('checked', false);
    }
}

$('.group-selector-subscriber').click(function () {
            var group = this.id;
            if($(this).is(':checked')) {
                $('.group-subscriber-'+group).prop('checked', true);
            } else {
                $('.group-subscriber-'+group).prop('checked', false);
            }
        });
</script>
@endsection

@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="ioElsHWA">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('users.create_package_blade.client_management_span')}}</span>
            <i class="fa fa-circle"></i>
        </li>
      @if(rolePermission(177))
        <li>
            <span><a href="{{ route('subuser-role.index') }}">{{trans('app.user_management.roles.view_all.title')}}</a></span>
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
<div class="m-heading-1 border-green m-bordered" data-name="uSgfyxQy">
    <p> {{getHeading(trans('app.headings.user_management.roles.add'))}} </p>
</div>
@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="TqWTDpNf">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="FPeDrimg">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="qWJjrIOT">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->

<?php 
    $evergreenAddon = addon_license_status("Evergreen Campaigns");
    $evergreenSkipRoutes = array();
    if($evergreenAddon != "Active") { 
        $evergreenSkipRoutes = array(
            "campaign.evergreen.index",
            "edit.evergreen",
            "delete.evergreen",
            "statistics.evergreen.index"
        );
    }
     
   
?> 
<div class="row" data-name="wsDbtvnr">
    @if ($page_data['action'] == 'add')
        <form action="{{ route('subuser-role.store') }}" method="POST" id="subuser-frm" class="form-horizontal">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else 
        <form action="{{ route('subuser-role.update',  $role->id) }}" method="POST" id="subuser-frm" class="form-horizontal">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="user-id" value="{{$role->id}}">
        <input type="hidden" name="_method" value="PUT">
    @endif
        <div class="col-md-12" data-name="syykasKV">
            <div class="portlet box green" data-name="noCvgEVu">
                <div class="portlet-title" data-name="tWUIlPzg">
                    <div class="caption" data-name="lldpPxQp">
                        <span class="caption-subject bold uppercase">{{trans('users.create_role_blade.client_role_group_span')}}</span>
                    </div>
                </div>
                <div class="portlet-body" data-name="bzWGuMEF">
                    <div class="form-body" data-name="nkUGyIeW">
                        <div class="form-group" data-name="QKyBliKr">
                            <label class="col-md-1">{{trans('app.user_management.roles.add_new.fields.group_name')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-9" data-name="IrLdfnbN">
                                <div class="input-icon right" data-name="IxFNqkCO">
                                    <i class="fa"></i>
                                    <input type="text" name="name" value="{{isset($role->name) ? $role->name : '' }}" class="form-control" />
                                </div>
                            </div>
                            <i class="fa fa-question-circle-o popovers" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('app.help.user_management.role.group_name.description')}}" data-original-title="{{trans('app.help.user_management.role.group_name.title')}}"></i>
                        </div>
                        <div class="form-group" data-name="yStssTDY">
                            @foreach($permissions as $permission)
                            <?php $role_class = strtolower(str_replace(' ', '-', $permission->title)) ?>

                            <div class="col-md-5" data-name="tZtDQLPv">

                                <div class="portlet box green" data-name="JQbTOoUH" >
                                    <div class="portlet-title" data-name="HJeczNzN">
                                        <div class="caption" data-name="rtNoLklG">
                                         {{ $permission->title }} &nbsp;&nbsp;
                                         <input type="button" class="btn btn-info" value="Check All" id="{{ $role_class }}" onclick="selectAll('{{ $role_class }}', this.id);" />
                                         </div>
                                    </div>
                                    <div class="portlet-body" style="height: 200px;overflow-y: scroll;" data-name="PBHgUwix">
                                        @if( $permission->children )
                                            @foreach($permission->children as $level2)
                                                @if($level2->children)
                                                @if(empty($evergreenSkipRoutes) || (!empty($evergreenSkipRoutes) AND !in_array($level2->route , $evergreenSkipRoutes))
                                                <input type="checkbox" class="checkbox-all-index {{$role_class}}" id="role-class-{{$level2->id}}" value="{{ $level2->id }}" name="parent[]" {{ (isset($role_permissions) && in_array($level2->id, $role_permissions)) ? 'checked' : '' }} onclick="selectAllSubRole('role-class-{{$level2->id}}', this.id);" /><b> {{ $level2->title }}</b><br>
                                                <span></span>
                                                @endif
                                                @endif
                                            @foreach($level2->children as $level3)
                                                @if($level3->children)
                                                <div style="padding-left: 20px" data-name="AUevALXF">
                                                <input type="checkbox" class="checkbox-index {{$role_class}} role-class-{{$level2->id}}" value="{{ $level3->id }}" name="child[]" {{ (isset($role_permissions) && in_array($level3->id, $role_permissions)) ? 'checked' : '' }}/> {{ $level3->title }} <br>
                                                <span></span>
                                                </div>
                                                @endif
                                            @endforeach
                                            @endforeach
                                        @endif
                                    </div>
                                </div>

                            </div>
                            @endforeach
                        </div>
                        <div class="form-actions" data-name="XwHHpAKF">
                        <div class="row" data-name="abYXZNbO">
                            <div class="col-md-offset-4" data-name="PwbkKNMG">
                                <button type="submit" name="" class="btn green" value="">{{trans('app.user_management.roles.add_new.buttons.save')}}</button>
                                <button type="reset" class="btn grey-salsa btn-outline">{{trans('app.user_management.roles.add_new.buttons.reset')}}</button>
                                <a href="{{ route('role.index') }}"><button type="button" class="btn grey-salsa btn-outline">{{trans('app.user_management.roles.add_new.buttons.return')}}</button></a>
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