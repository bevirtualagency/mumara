@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/staff-roll-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
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
    @if( $permission->childrenAll )
    @foreach($permission->childrenAll as $level1)
    @if($level1->childrenAll)
    lists_arr.push({"id":"{{$level1->id}}","name":"{{strtoupper($level1->title)}}"});
    @endif
    @foreach($level1->childrenAll as $level2)
    @if($level2->childrenAll)
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

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="KrirRFCY">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="vqFTQRUW">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="vvCJAQlX">
    <span id='msg-text'><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="NLAklhuj">
    @if ($page_data['action'] == 'add')
        <form action="{{route('staff.roles.store')}}" method="POST" id="subuser-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else  
        <form action="{{ route('staff.roles.update', $role->id) }}" method="POST" id="subuser-frm" class="kt-form kt-form--label-right">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="user-id" value="{{$role->id}}">
        <input type="hidden" name="_method" value="PUT">
    @endif
        <div class="row" data-name="gVDGaQwN">
            <div class="kt-portlet kt-portlet--bordered" data-name="JvFBDGdo">
                <div class="kt-portlet__head" data-name="KeiMKfIN">
                    <div class="kt-portlet__head-label" data-name="fwvMBheU">
                        <h3 class="kt-portlet__head-title">{{trans('staff.role.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="aAeuNUNP">
                    <div class="form-body" data-name="QBdbgxtE">
                        <div class="form-group row" data-name="fqtgyzRG">
                                
                            <div class="col-md-12" data-name="ZvOzOWdT">
                                <label class="col-form-label">{{trans('staff.role.add_new.form.role_name')}}
                                    <span class="required"> * </span>
                                     {!! popover('staff.role.add_new.form.role_name_help','common.description') !!}
                                </label>
                                <div class="input-icon right" data-name="TIyblEBI">
                                    <input type="text" name="name" value="{{isset($role->name) ? $role->name : '' }}" class="form-control" />
                                </div>
                            </div>

                        </div>

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

                        <div class="form-group row mb0" data-name="oOSnQQlQ">
                            @foreach($permissions as $permission)
                            <?php $role_class = strtolower(str_replace(' ', '-', $permission->title)) ?>
                            <div class="col-md-12" data-name="bRTSXLdw">
                                <div class="kt-portlet kt-portlet--bordered" data-name="rFwIxFYY">
                                    <div class="kt-portlet__head" data-name="LZfoxvbH">
                                        <div class="kt-portlet__head-label" data-name="scHeeFXf">
                                         <input type="button" class="btn btn-default btn-xs" value="Check All" id="{{ $role_class }}" onclick="selectAll('{{ $role_class }}', this.id);" />
                                         </div>
                                    </div>
                                    <div class="kt-input-icon kt-input-icon--left" data-name="cTLcyVTg">
                                        <input type="text" id="roleList" class="form-control" placeholder="Search Permissions...">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                                                                <span><i class="la la-search"></i></span>
                                                                            </span>
                                    </div>
                                    <div class="kt-portlet__body scroll scroll-500 kt-checkbox-list" style="border:0 !important;" data-name="gnCZVyaP">
                                        @if( $permission->childrenAll )
                                            @foreach($permission->childrenAll as $level1)
                                            <?php /** 278 = Evergreen Campaigns */ ?>
                                              
                                        
                                                @if($level1->childrenAll)
                                                @if(empty($evergreenSkipRoutes) || (!empty($evergreenSkipRoutes) AND !in_array($level1->route , $evergreenSkipRoutes)))
                                                <label id="flag_{{$level1->id}}" class="kt-checkbox">
                                                    <input type="checkbox" class="checkbox-all-index {{$role_class}}" id="role-class-{{$level1->id}}" value="{{ $level1->id }}" name="parent[]" {{ (isset($role_permissions) && in_array($level1->id, $role_permissions)) ? 'checked' : '' }} onclick="selectAllSubRole('role-class-{{$level1->id}}', this.id);" /> {{ $level1->title }}
                                                    <span></span>
                                                </label>
                                                @endif
                                                @endif
                                                @foreach($level1->childrenAll as $level2)
                                                    @if($level2->childrenAll)
                                                        @if(empty($evergreenSkipRoutes) || (!empty($evergreenSkipRoutes) AND !in_array($level2->route , $evergreenSkipRoutes)))
                                                        <div style="padding-left: 20px" data-name="YWYstRei">
                                                            <label id="flag_{{$level2->id}}" class="kt-checkbox">
                                                                <input type="checkbox" class="checkbox-index {{$role_class}} role-class-{{$level1->id}}" id="role-class-{{$level2->id}}" value="{{ $level2->id }}" name="child[]" {{ (isset($role_permissions) && in_array($level2->id, $role_permissions)) ? 'checked' : '' }}  onclick="selectAllSubRole('role-class-{{$level2->id}}', this.id);" /> {{ $level2->title }}
                                                                <span></span>
                                                            </label>
                                                        </div>
                                                        @endif
                                                        @foreach($level2->childrenAll as $level3)
                                                            @if($level3->childrenAll)
                                                            <div style="padding-left: 40px" data-name="SnHsVayA">
                                                                <label id="flag_{{$level3->id}}" class="kt-checkbox">
                                                                    <input type="checkbox" id="role-class-{{$level3->id}}" class="checkbox-index-two {{$role_class}} role-class-{{$level1->id}} {{$role_class}} role-class-{{$level2->id}}" value="{{ $level3->id }}" name="child_2[]" {{ (isset($role_permissions) && in_array($level3->id, $role_permissions)) ? 'checked' : '' }} onclick="selectAllSubRole('role-class-{{$level3->id}}', this.id);"/> {{ $level3->title }}
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                            @endif
                                                             @foreach(getChildern($level3->id) as $level4)
                                                          
                                                            <div style="padding-left: 60px" data-name="Ugdapcnx">
                                                                <label id="flag_{{$level4->id}}" class="kt-checkbox">
                                                                    <input type="checkbox" id="role-class-{{$level4->id}}" class="checkbox-index-two role-class-{{$level1->id}} role-class-{{$level2->id}} {{$role_class}} role-class-{{$level3->id}}" value="{{ $level4->id }}" name="child_2[]" {{ (isset($role_permissions) && in_array($level4->id, $role_permissions)) ? 'checked' : '' }}/> {{ $level4->title }}
                                                                    <span></span>
                                                                </label>
                                                            </div>
                                                         @foreach(getChildern($level4->id) as $level5)
                                                          
                                                            <div style="padding-left: 80px" data-name="KwACWjJn">
                                                                <label id="flag_{{$level5->id}}" class="kt-checkbox">
                                                                    <input type="checkbox" class="checkbox-index-two role-class-{{$level1->id}} role-class-{{$level2->id}} {{$role_class}} role-class-{{$level3->id}} role-class-{{$level4->id}}" value="{{ $level5->id }}" name="child_2[]" {{ (isset($role_permissions) && in_array($level5->id, $role_permissions)) ? 'checked' : '' }}/> {{ $level5->title }}
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
                                </div>

                            </div>
                            @break;
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="LoYgDmSW">
                    <div class="form-actions" data-name="naNsJFYr">
                        <div class="row" data-name="aVDUjOvA">
                            <div class="col-md-12" data-name="MTteuDYd">
                                <button type="submit" name="" class="btn btn-success" value="">{{trans('common.form.buttons.save')}}</button>
                                <a href="{{ route('staff.roles.index') }}"><button type="button" class="btn btn-default">{{trans('common.form.buttons.cancel')}}</button></a>
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