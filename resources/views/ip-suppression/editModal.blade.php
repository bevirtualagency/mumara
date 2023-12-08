<option value="0">{{trans('common.label.global')}}</option>
@foreach($group_lists as $key => $group)
    <optgroup label="{{$group['name']}}">
        @foreach($group['children'] as $list)
            <option value="{{ $list['id'] }}" {{ (isset($ip_suppression->list_id) && ($list['id']  == $ip_suppression->list_id)) || (!empty($list_id) && $list['id'] == $list_id) ? 'selected' : '' }}>
                {{ $list['name'] }}</option>
        @endforeach
    </optgroup>
@endforeach