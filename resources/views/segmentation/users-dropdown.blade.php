<label class="col-form-label col-md-2">
</label>
<label class="col-form-label col-md-2">
    <select class="form-control m-select2" name="where_user" id="where_user">
        <option value="">{{trans('segments.users_dropdown_blade.select_an_option')}} </option>
        @foreach($users as $user)
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
</label>