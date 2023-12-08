@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/client-role-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/subuser_role.js" type="text/javascript"></script>
<script>
    @if(count($permissions) > 0)
    var lists_arr = [];
    @php($mapping = getNodesAclMapping())
    @foreach($permissions as $permission)
    <?php $role_class = strtolower(str_replace(' ', '-', $permission->title)) ?>
    lists_arr.push({"id":"{{$permission->id}}","name":"{{strtoupper($permission->title)}}"});
    @if( $permission->userChildrenAll )
    @foreach($permission->userChildrenAll as $level1)
    @if($level1->userChildrenAll)
    lists_arr.push({"id":"{{$level1->id}}","name":"{{strtoupper($level1->title)}}"});
    @endif
    @foreach($level1->userChildrenAll as $level2)
    @if($level2->userChildrenAll)
    lists_arr.push({"id":"{{$level2->id}}","name":"{{strtoupper($level2->title)}}"});
    @foreach(getChildern($level2->id) as $level3)
    @if($level3->access_level=='super_admin')
    @continue
    @endif
    lists_arr.push({"id":"{{$level3->id}}","name":"{{strtoupper($level3->title)}}"});
    @foreach(getChildern($level3->id) as $level4)
    lists_arr.push({"id":"{{$level4->id}}","name":"{{strtoupper($level4->title)}}"});
    @foreach(getChildern($level4->id) as $level5)
    lists_arr.push({"id":"{{$level5->id}}","name":"{{strtoupper($level5->title)}}"});
    @endforeach
    @endforeach
    @endforeach
    @endif
    @endforeach
    @endforeach
    @endif
    @endforeach
    @endif
    $("#roleList").keyup(function(){
        str = $('#roleList').val().toUpperCase();
        if(str.length>0)
        {
            for (variable in lists_arr)
            {
                name = lists_arr[variable].name;
                id = lists_arr[variable].id;
                exists = name.indexOf(str) > -1;
                if(!exists)
                    $('#flag_'+id).slideUp();
                else
                    $('#flag_'+id).slideDown();
            }
        }
        else{
            for (variable in lists_arr)
            {

                id = (lists_arr[variable].id);

                $('#flag_'+id).slideDown();
            }
        }
    });
    function selectAll(role_class, id)
    {
        if ($('#'+id).val() == 'Check All') {
            $('.head').prop('checked', true);
            $('#'+id).val('Uncheck All');
        } else {
            $('.head').prop('checked', false);
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

    $(document).ready(function() {
        $("#reset").click(function() {
            var group = $('.group-selector-subscriber').id;
            var group2 = $('.list-management').id;
            $('.group-subscriber-'+group).prop('checked', false);
            $('#role-class-'+group).prop('checked', false);
            $('.list-management').prop('checked', false);
            $("#list-management").val("Check All");
        });
    });

    $(document).ready(function() {
        $(".head").click(function() {
       		id = this.id;
       		res = id.split("-");
       		id = res[2];
       		class_ = '.child_'+id;
       		if($(this).is(":checked"))
       		$(class_).prop('checked',true);
       		else
       			$(class_).prop('checked',false);
        });
    });
</script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="gnKERGfm">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="nWzluUZj">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="iVovIgXl">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="YWdiMOUn">
    @if ($page_data['action'] == 'add')
        <form action="{{ route('package.role.store') }}" method="POST" id="subuser-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else 
        <form action="{{ route('package.role.update', $role->id) }}" method="POST" id="subuser-frm" class="kt-form kt-form--label-right">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="user-id" value="{{$role->id}}">
        <input type="hidden" name="_method" value="PUT">
    @endif
        <div class="row" data-name="DVLLlZxc">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="oUMbvugo">
                <div class="kt-portlet__head" data-name="XXkAWone">
                    <div class="kt-portlet__head-label" data-name="lRRabLeT">
                        <h3 class="kt-portlet__head-title">{{trans('users.roles.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="ctMoGnUs">
                    <div class="form-body" data-name="zQqTAiAh">
                        <div class="form-group row" data-name="CzJGFlEn">
                                
                            <div class="col-md-12" data-name="MsHhWWJi">
                                <label class="col-form-label">{{trans('users.roles.add_new.form.role_name')}}
                                    <span class="required"> * </span>
                                     {!! popover('users.roles.add_new.form.role_name_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="MdIPfwCG">
                                    <input type="text" name="name" value="{{isset($role->name) ? $role->name : '' }}" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="QbTaPzsF">
                            <div class="col-md-12" data-name="aVLrDElw">
                                <div class="kt-portlet kt-portlet--bordered" data-name="cuZUPRua">
                                    <div class="kt-portlet__head" data-name="VepEYBNS">
                                        <div class="kt-portlet__head-label" data-name="rgCfNrtw">
                                            <input type="button" class="btn btn-default btn-xs" value="Check All" id="list-management" onclick="selectAll('list-management', this.id);" aria-invalid="false" />
                                        </div>
                                    </div>
                                    <div class="kt-input-icon kt-input-icon--left" data-name="cTLcyVTg">
                                        <input type="text" id="roleList" class="form-control" placeholder="Search Permissions...">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                                <span><i class="la la-search"></i></span>
                                                                            </span>
                                    </div>
                                    <div class="kt-portlet__body scroll scroll-300" style="border:0 !important;" data-name="GeHjMocV">

                                    
<?php 
    $evergreenAddon = addon_license_status("Evergreen Campaigns");
    $evergreenSkipRoutes = array();
    if($evergreenAddon != "Active") { 
        $evergreenSkipRoutes = array(
            "campaign.evergreen.index",
            "edit.evergreen",
            "campaign.evergreen.create",
            "delete.evergreen",
            "statistics.evergreen.index"
        );
    }
    
?> 

                                   @php($mapping = getNodesAclMapping())
                                    @foreach($permissions as $permission)
                                    <?php $role_class = strtolower(str_replace(' ', '-', $permission->title)) ?>
                                        <div class="kt-checkbox-list"  data-name="fwMReNCC">

                     
                                              @if( $permission->userChildrenAll )
                                            @foreach($permission->userChildrenAll as $level1)
                                                @if($level1->userChildrenAll)
                                                    @if(empty($evergreenSkipRoutes) || (!empty($evergreenSkipRoutes) AND !in_array($level1->route , $evergreenSkipRoutes)))
                                                    <label id="flag_{{$level1->id}}" class="kt-checkbox">
                                                        <input type="checkbox" class="checkbox-all-index {{$role_class}}" id="role-class-{{$level1->id}}" value="{{ $level1->id }}" name="parent[]" {{ (isset($role_permissions) && in_array($level1->id, $role_permissions)) ? 'checked' : '' }} onclick="selectAllSubRole('role-class-{{$level1->id}}', this.id);" /> {{ $level1->title }}
                                                        <span></span>
                                                    </label>
                                                    @endif 
                                                @endif
                                                @foreach($level1->userChildrenAll as $level2)
                                                    @if($level2->userChildrenAll)
                                                    @if(empty($evergreenSkipRoutes) || (!empty($evergreenSkipRoutes) AND !in_array($level2->route , $evergreenSkipRoutes)))
                                                        <div id="flag_{{$level2->id}}" style="padding-left: 20px;" data-name="jeijDnco">
                                                            <label class="kt-checkbox">
                                                                <input type="checkbox" class="checkbox-index {{$role_class}} role-class-{{$level1->id}}" id="role-class-{{$level2->id}}" value="{{ $level2->id }}" name="parent[]" {{ (isset($role_permissions) && in_array($level2->id, $role_permissions)) ? 'checked' : '' }}  onclick="selectAllSubRole('role-class-{{$level2->id}}', this.id);" /> {{ $level2->title }}
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                        @endif 
                                                        @foreach(getChildern($level2->id) as $level3)
                                                           @if($level3->access_level=='super_admin')
                                                               @continue
                                                                @endif
                                                            <div id="flag_{{$level3->id}}" style="padding-left: 40px;" data-name="FMlXxntX">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" id="role-class-{{$level3->id}}" class="checkbox-index-two {{$role_class}} role-class-{{$level1->id}} {{$role_class}} role-class-{{$level2->id}}" value="{{ $level3->id }}" name="parent[]" {{ (isset($role_permissions) && in_array($level3->id, $role_permissions)) ? 'checked' : '' }} onclick="selectAllSubRole('role-class-{{$level3->id}}', this.id);"/> {{ $level3->title }}
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                         @foreach(getChildern($level3->id) as $level4)
                                                           
                                                            <div  id="flag_{{$level4->id}}" style="padding-left: 60px;" data-name="RpzkUFFu">
                                                                <label class="kt-checkbox">
                                                                    <input type="checkbox" id="role-class-{{$level4->id}}" class="checkbox-index-two {{$role_class}} role-class-{{$level1->id}} {{$role_class}} role-class-{{$level3->id}} role-class-{{$level2->id}}" value="{{ $level4->id }}" name="parent[]" {{ (isset($role_permissions) && in_array($level4->id, $role_permissions)) ? 'checked' : '' }}/> {{ $level4->title }} ({{$level4->id}})
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                                    @foreach(getChildern($level4->id) as $level5)

                                                                        <div  id="flag_{{$level5->id}}" style="padding-left: 80px;" data-name="FGlDsUiR">
                                                                            <label class="kt-checkbox">
                                                                                <input type="checkbox" class="checkbox-index-two {{$role_class}} role-class-{{$level4->id}} role-class-{{$level1->id}} {{$role_class}} role-class-{{$level3->id}} role-class-{{$level2->id}}" value="{{ $level5->id }}" name="parent[]" {{ (isset($role_permissions) && in_array($level5->id, $role_permissions)) ? 'checked' : '' }}/> {{ $level5->title }} ({{$level5->id}})
                                                                                <span></span>
                                                                            </label>
                                                                        </div>

                                                                    @endforeach
                                                        @endforeach
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endforeach
                                        @endif
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="LVYNFcoh">
                    <div class="row" data-name="IUecXlpq">
                        <div class="col-md-12" data-name="rLtESprU">
                            <button type="submit" name="" class="btn btn-success" value="">{{trans('common.form.buttons.save')}}</button>
                            <button type="button" class="btn btn-default" id="reset">{{trans('common.form.buttons.reset')}}</button>
                            <a href="{{ route('package.role.view') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.back')}}</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- END FORM-->
@endsection