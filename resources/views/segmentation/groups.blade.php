<div class="col-md-12" data-name="FNpVdSdo">
    <label class="col-form-label">{{trans('segments.add_new.field.select_group')}}
        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('segments.add_new.field.select_group_help')}}" data-original-title="{{trans('segments.add_new.field.select_group')}}"></i>


    </label>
    <div style="display: block;" class="kt-portlet kt-portlet--height-fluid scroll scroll-415" data-name="wTWOQwZA">
        <div class="portlet-body kt-checkbox-list" data-name="kQCJrFby">
            <label class="kt-checkbox">
                <input type="checkbox" class="checkbox-index checkbox-all-index" >&nbsp;<b>{{trans('common.label.select_all')}}</b>
                <span></span>
                <small id="listGroups-error" class="error invalid-feedback"></small>
            </label>
            @foreach ($groups_data as $group_metadata)
                <div style="padding: 5px 0 5px 20px;" data-name="EeNzRotH">
                    <label class="kt-checkbox">
                        <input class="checkbox-index group_array" @if(in_array($group_metadata['id'],$selectedValues)) checked @endif type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="listGroups[]">
                        {{ $group_metadata['name'] }}
                        <span></span>
                    </label>

                </div>
            @endforeach
        </div>

    </div>
    <div class="error" id="group_ids_error" style="display:none;" data-name="AfjrWfCi">{{ trans('common.message.select_one_list') }}</div>

</div>
<script type="text/javascript">
    $('.popovers').popover();
</script>