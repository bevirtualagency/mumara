<label class="col-form-label col-md-3">{{trans('common.label.contact_list')}}
    <span class="required"> * </span>
</label>
<div class="col-md-8" data-name="dEhABzpD">
    <select class="form-control m-select2" data-placeholder="Choose List" name="list_id" id="list-id"  >
        <option value="">{{trans('contacts.choose_a_list')}}</option>
        @foreach($group_lists as $key => $group)
            <optgroup label="{{$key}}">
                @foreach($group as $list)
                    <option value="{{ $list['id'] }}" {{ (isset($subscriber->list_id) && ($list['id']  == $subscriber->list_id)) || (!empty($list_id) && $list['id'] == $list_id) ? 'selected' : '' }}>{{ $list['name'] }}</option>
                @endforeach
            </optgroup>
        @endforeach
    </select>
</div>