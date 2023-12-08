@extends(decide_template())

@section('title', $page_data['title'])

@section('page_styles')
<link href="/resources/assets/css/splittest-create.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>
<script>
    var form_error="{{trans('common.message.form_error')}}";
</script>
<script src="/themes/default/js/includes/split_test.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script> 
    $(document).ready(function() {
        $(".m-select2").select2({
            placeholder: 'Select Option'
        });
    });  
    // select split test based on campaign or list
    function getListCampaignArea(section)
    {
        $(".lists-campaigns").hide();
        $("#" + section).show();
    }

    getListCampaignArea("{{ $split_test['test_on'] }}");
    // Winning Criteria
    $('#winner_type').change(function(){
        if($('#winner_type').val() == 'link') {
            $('#links').show();
        }else {
            $('#links').hide();
        }
    });

    var winner_type = $('#winner_type').find(":selected").val();
    if(winner_type == 'link') {
        $('#links').show();
    }
    // select group and the campaign under that group
    $('.group-selector-campaign').click(function () {
        var type = $('#type:checked').val();
        if (type == 'split_test') {
            $(".group-selector-campaign").attr("disabled", true);
            return false;
        }
        var group = this.id;
        if($(this).is(':checked')) {
            $('.group-campaign-'+group).prop('checked', true);
        } else {
            $('.group-campaign-'+group).prop('checked', false);
        }
    });
    // select group and the subscriber list under that group
    $('.group-selector-subscriber').click(function () {
        var group = this.id;
        if($(this).is(':checked')) {
            $('.group-list-ids-tab1-'+group).prop('checked', true);
        } else {
            $('.group-list-ids-tab1-'+group).prop('checked', false);
        }
    });
</script>
@endsection

@section(decide_content())

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="vVsHxQEy">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="BWHNFJfE">
    {{ Session::get('msg') }}
</div>
@endif
<!-- will be used to show any messages about form -->
<div id="msg" class="display-hide" data-name="ChRrpPWe">
    <span id='msg-text' class="alert-text"><span>
</div>
<!-- BEGIN FORM-->
<div class="col-md-6 create-form" data-name="ysjqHbkV">
    @if ($page_data['action'] == 'add')
        <form action="{{route('splittest.store')}}" method="POST" id="split_tests-frm" class="kt-form kt-form--label-right">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="action" value="add">
    @else 
        <form action="{{ route('splittest.update',  $split_test['id']) }}" method="POST" id="split_tests-frm" class="kt-form kt-form--label-right">
        <input type="hidden" id="action" value="edit">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" id="split_test-id" value="{{ $split_test['id'] }}">
        <input type="hidden" name="_method" value="PUT">
    @endif

        <div class="row" data-name="NkiAzoXs">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="mFLwBwZS">
                <div class="kt-portlet__head" data-name="dSgvsNBh">
                    <div class="kt-portlet__head-label" data-name="LFeUjNAS">
                        <h3 class="kt-portlet__head-title">{{trans('split_tests.add_new.form.heading')}}</h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="bjzNftut">
                    <div class="form-body" data-name="zcNzoEFO">
                        <!-- Split Test Name -->
                        <div class="form-group row" data-name="tlqHioPZ">                            
                            <div class="col-md-12" data-name="vPWnVOZO">
                                <label class="col-form-label">{{trans('split_tests.add_new.form.split_test_name')}}
                                    <span class="required"> * </span>
                                      {!! popover( 'split_tests.add_new.form.split_test_name_help','common.description' ) !!}
                                </label>
                                <div class="input-icon right mt0" data-name="kAThZAlF">
                                    <input type="text" name="name" value="{{isset($split_test['name']) ? $split_test['name'] : '' }}" class="form-control" /> 
                                </div>
                            </div>
                        </div>
                        <!-- Split Test Name -->

                        <!-- select based on split test -->
                        <div class="form-group row pl10" data-name="xDypmZzu">
                            <div class="col-md-12 basedBar kt-radio-inline" data-name="RCrqcUwC">
                                <label for="test_on1" class="kt-radio based">
                                    <input type="radio" id="test_on1" name="test_on" value="campaigns" {{ ($split_test['test_on'] == 'campaigns') ? 'checked' : '' }} onclick="getListCampaignArea('campaigns')"> {{trans('split_tests.add_new.form.based_on_campaign_performance')}}
                                <span></span>
                                {!! popover( 'split_tests.add_new.form.based_on_campaign_performance_help','common.description' ) !!}
                                </label>&nbsp;&nbsp;
                                
                            </div>
                        </div>
                        <!-- select based on split test -->

                        <!-- show subscriber lists -->
                        <div class="form-group row lists-campaigns" id="lists" data-name="fVJWtTFO">
                                
                            <div class="col-md-12" data-name="wMIRLLZj">
                                <label class="col-form-label">{{trans('common.label.lists')}}
                                    <span class="required"> * </span>
                                    {!! popover( 'split_tests.add_new.form.based_on_help','common.description' ) !!}
                                </label>
                                <div class="kt-portlet kt-portlet--height-fluid scroll scroll-300" data-name="QrepShbF">
                                    <div class="kt-portlet__body" data-name="vsZmaVsB">
                                        @foreach ($list_tree as $group_metadata)
                                            <div class="kt-checkbox-list" data-name="nYgAocjo">
                                                <label class="kt-checkbox parentList" for="{{ $group_metadata['id'] }}">
                                                    <input class="group-selector-subscriber" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group_tab1[]"> {{ $group_metadata['name'] }}
                                                    <span></span>
                                                </label>
                                            </div>
                                            @foreach ($group_metadata['children'] as $list_metadata)
                                                <div style="padding-left: 20px;" class="kt-checkbox-list" data-name="zLYICNgj">
                                                    <label for="list-{{ $list_metadata['id'] }}" class="kt-checkbox childList">
                                                        <input type="checkbox" id="list-{{ $list_metadata['id'] }}" value="{{ $list_metadata['id'] }}" name="lists[]" class="group-list-ids-tab1-{{ $group_metadata['id'] }} subscriber_list" {{ ($split_test['test_on'] == 'lists') && !empty($campaign_list_ids) && in_array($list_metadata['id'], $campaign_list_ids) ? 'checked' : '' }}> {{ $list_metadata['name'] }} 
                                                    <span></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- show subscriber lists -->

                        <!-- show campaigns -->
                        <div class="form-group row lists-campaigns" id="campaigns" data-name="OaNIwsin">
                                
                            <div class="col-md-12" data-name="wuxoxnTK">
                                <label class="col-form-label">{{trans('common.label.campaigns')}}
                                    <span class="required"> * </span>
                                    {!! popover( 'split_tests.add_new.form.based_on_help','common.description' ) !!}
                                </label>
                                <div class="kt-portlet kt-portlet--height-fluid scroll scroll-300" data-name="OXeIHovI">
                                    <div class="kt-portlet__body" data-name="COsVKqgC">
                                        @foreach ($campaign_tree as $group_metadata)
                                            <div class="kt-checkbox-list" data-name="BBTmqKCu">
                                                <label class="kt-checkbox parentList" for="{{ $group_metadata['id'] }}">
                                                    <input class="group-selector-campaign" type="checkbox" id="{{ $group_metadata['id'] }}" value="{{ $group_metadata['id'] }}" name="campaign_group[]"> {{ $group_metadata['name'] }}
                                                    <span></span>
                                                </label>
                                            </div>
                                            @foreach ($group_metadata['children'] as $campaign_metadata)
                                                <div style="padding-left: 20px;" data-name="KJEMvODc">
                                                    <label class="kt-checkbox childList" for="group-campaign-{{ $campaign_metadata['id'] }}">
                                                        <input type="checkbox" id="group-campaign-{{ $campaign_metadata['id'] }}" value="{{ $campaign_metadata['id'] }}" name="campaigns[]" class="group-campaign-{{ $group_metadata['id'] }} campaign_lists" {{ ($split_test['test_on'] == 'campaigns') && !empty($campaign_list_ids) && in_array($campaign_metadata['id'], $campaign_list_ids) ? 'checked' : '' }}> {{ $campaign_metadata['name'] }} 
                                                        <span></span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                                <div id="sn-error" class="">{{trans('common.error.double_check')}}</div>
                            </div>
                        </div>
                        <!-- show campaigns -->

                        <!-- Winning Criteria -->
                        <div class="form-group row" data-name="MyzsMAnZ">
                                
                            <div class="col-md-6" data-name="feDjTiWu">
                                <label class="col-form-label">
                                {{trans('split_tests.add_new.form.winning_criteria')}}
                                {!! popover( 'split_tests.add_new.form.winning_criteria_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="winner_type" id="winner_type">
                                    <option value="opened" {{ (isset($split_test['winner_type']) && $split_test['winner_type'] == "opened") ? 'selected' : '' }}>
                                        {{trans('split_tests.add_new.form.open_rate')}}
                                    </option>
                                    <option value="clicked" {{ (isset($split_test['winner_type']) && $split_test['winner_type'] == "clicked") ? 'selected' : '' }}>
                                        {{trans('split_tests.add_new.form.click_through_rate')}}
                                    </option>
                                    <!-- <option value="link" {{ (isset($split_test['winner_type']) && $split_test['winner_type'] == "link") ? 'selected' : '' }}>
                                        {{trans('split_tests.add_new.form.click_through_rate_specific_link')}}
                                    </option> -->
                                </select>
                            </div>
                            <div class="col-md-6" data-name="EuLbJlAg">
                                <label class="col-form-label">{{trans('split_tests.add_new.form.decision_percentage')}}
                                    {{trans('split_tests.add_new.form.winning_criteria')}}
                                {!! popover( 'split_tests.add_new.form.decision_percentage_help','common.description' ) !!}
                                </label>
                                <div class="input-icon right mt0" data-name="LJCWCrkJ">
                                    <input type="text" name="send_emails_limit" value="{{isset($test_type_attributes['send_emails_limit']) ? $test_type_attributes['send_emails_limit'] : '10' }}" class="form-control" />
                                    <p class="mb0"><font size="1"> 
                                    {{trans('split_tests.message.decision_percentage_note')}}</font></p>
                                </div>
                            </div>

                        </div>
                        <!-- Winning Criteria -->

                        <div id="test-type-send" data-name="qXaHzeIe">
                        <div class="form-group row" data-name="YEisBLoj">
                                
                            <div class="col-md-6" data-name="YVFZdPgK">
                                <div class="row" data-name="bADzyeLu">
                                    <label class="col-form-label col-md-12">{{trans('split_tests.add_new.form.send_remaining_after')}}
                                {!! popover( 'split_tests.add_new.form.send_remaining_after_help','common.description' ) !!}
                                    </label>
                                    <div class="col-md-4" data-name="AtInLOLL">
                                        <div data-name="mRpkcqfv">
                                            <input type="text" name="duration" value="{{isset($test_type_attributes['duration']) ? $test_type_attributes['duration'] : '10' }}" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-8" data-name="VBpkowwP">
                                        <select class="form-control" name="interval">
                                                <option value="minutes" {{ (isset($test_type_attributes['interval']) && $test_type_attributes['interval'] == "minutes") ? 'selected' : '' }}>
                                                    {{trans('common.minutes')}}
                                                </option>
                                                <option value="hours" {{ (isset($test_type_attributes['interval']) && $test_type_attributes['interval'] == "hours") ? 'selected' : '' }}>
                                                    {{trans('common.hours')}}
                                                </option>
                                                <option value="days" {{ (isset($test_type_attributes['interval']) && $test_type_attributes['interval'] == "days") ? 'selected' : '' }}>
                                                    {{trans('common.days')}}
                                                </option>
                                                <option value="weeks" {{ (isset($test_type_attributes['interval']) && $test_type_attributes['interval'] == "weeks") ? 'selected' : '' }}>
                                                    {{trans('common.weeks')}}
                                                </option>
                                        </select>
                                    </div>
                                    <div class="col-md-12" data-name="IsyyWNyb"><p class="mb0"><font size="1"> {{trans('split_tests.message.send_remaining_after_note')}}</font></p></div>
                                </div>
                            </div>
                            <div class="col-md-6" data-name="YIrGIeUQ">
                                <label class="col-form-label">
                                {{trans('split_tests.add_new.form.action_to_perform')}}
                                {!! popover( 'split_tests.add_new.form.action_to_perform_help','common.description' ) !!}
                                </label>
                                <select class="form-control" name="test_type" id="test-type">
                                        <option value="show" {{ (isset($split_test['test_type']) && $split_test['test_type'] == 'show') ? 'selected' : '' }}>
                                            {{trans('split_tests.add_new.form.action_to_perform_opt1')}}
                                        </option>
                                        <option value="send" {{ (isset($split_test['test_type']) && $split_test['test_type'] == 'send') ? 'selected' : '' }}>
                                            {{trans('split_tests.add_new.form.action_to_perform_opt2')}}
                                        </option>
                                </select>
                            </div>
                        </div>
                        
                        </div>
                        <div class="form-group row" data-name="yoUTOGZA">
                              <div class="col-md-6" id="links" style="display: none" data-name="cPMwHZwO">
                                <label class="col-form-label">{{trans('common.label.select')}}</label>
                                <select class="form-control m-select2" name="link_id" id="link-id">
                                    @foreach($links as $link)
                                        <option value="{{ $link->id }}" {{ (isset($split_test['link_id']) && ($link->id  == $split_test['link_id'])) ? 'selected' : '' }}>
                                        {{ $link->link  }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-actions" data-name="lKwAejpN">
                            <div class="row" data-name="kbDqnySb">
                                <div class="col-md-12" data-name="tXjCYrtS">
                                    <!-- save & add new -->
                                    <button type="submit" name="save_add" class="btn btn-success btn-submit" value="save_add">
                                        {{trans('common.form.buttons.save_add')}}
                                    </button>
                                    @if ($page_data['action'] == 'add')
                                    <!-- save & exit -->
                                    <button type="submit" name="save_exit" class="btn btn-success btn-submit" value="save_exit">
                                        {{trans('common.form.buttons.save_exit')}}
                                    </button>
                                    @else
                                    <!-- save -->
                                    <button type="submit" name="edit" class="btn btn-success btn-submit" value="edit">
                                        {{trans('common.form.buttons.save')}}
                                    </button>
                                    @endif
                                    <!-- cancel -->
                                    <a href="{{ route('splittest.index') }}"><button type="button" class="btn btn-default">
                                        {{trans('common.form.buttons.cancel')}}
                                    </button></a>
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