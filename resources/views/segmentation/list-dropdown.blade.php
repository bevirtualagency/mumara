<div class="col-md-12" data-name="FhNHDhFA">
    <label class="col-form-label">{{trans('common.label.contact_lists')}}
        <i class="fa fa-question-circle popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="{{trans('segments.add_new.field.contact_lists_help')}}" data-original-title="{{trans('common.label.contact_lists')}}"></i>

    </label>
    <div style="display: block;" class="kt-portlet kt-portlet--height-fluid scroll scroll-415" data-name="bMWgPtMc">
        <div class="portlet-body kt-checkbox-list" data-name="oPSfqRBo">
            <label class="kt-checkbox">
                <input type="checkbox" class="checkbox-index parent checkbox-all-index">&nbsp;<b>{{trans('common.label.select_all')}}</b>
                <span></span>
                <small id="subscriber_lists-error" class="error invalid-feedback"></small>
            </label>
            @foreach ($list_tree as $group_metadata)
                <div style="padding: 5px 0;" data-name="WnYduraD">
                    <label class="kt-checkbox">
                        <input class="group-selector-subscriber checkbox-index" type="checkbox" value="{{ $group_metadata['id'] }}" id="{{ $group_metadata['id'] }}" name="list_group[]">
                        <strong>{{ $group_metadata['name'] }}</strong>
                        <span></span>
                    </label>
                </div>
                @foreach ($group_metadata['children'] as $list_metadata)
                <?php 
                    $blockedP = "";
                    $blockedPClass = "";
                    $blockedText = "";
                    if($list_metadata["is_blocked"] == 1) { 
                        $blockedPClass = "list-disabled";
                        $blockedP = "disabled='disabled'";
                        $blockedText = "<bar>(Blocked)</bar>";
                    } 

            ?> 

                    <div style="padding-left: 20px;" class="{{$blockedPClass}}" data-name="YatyIDPv">
                        <label class="kt-checkbox">
                            <input {{$blockedP}} type="checkbox" value="{{ $list_metadata['id'] }}" @if(in_array($list_metadata['id'],$selectedValues)) checked @endif name="subscriber_lists[]" class="group-subscriber-{{ $group_metadata['id'] }} checkbox-index list_array" >
                            {{ $list_metadata['name'] }} {!!$blockedText!!}
                            <span></span>
                        </label>
                    </div>
                @endforeach
            @endforeach
        </div>

    </div>
    <div class="error" id="list_ids_error" style="display:none;" data-name="AzJINpDr">{{ trans('common.message.select_one_list') }}</div>

</div>
<script type="text/javascript">
    $('.popovers').popover();
</script>