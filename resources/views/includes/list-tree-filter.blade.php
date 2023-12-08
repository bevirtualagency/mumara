<?php
$getTrashedClients=\App\Helpers\Common\UserHandler::getTrashedClients()->select('id', 'name','is_client','deleted_at')->get();
$getTrashedAdmins=\App\Helpers\Common\UserHandler::getTrashedAdmins()->select('id', 'name','is_client','deleted_at')->get();
?>
<style type="text/css">
    .line-throgh {
    text-decoration: line-through;
}
</style>
@if ($admin)
<div class="row bulltOpt" data-name="DgZcpAsX">
    <div class="col-md-12 pull-left bulltOpt" data-name="lhVFzxcc">
        <div class="bullOptions kt-radio-inline" data-name="rMbUYoWw">
            <label for="our_records" class="kt-radio"><input type="radio" checked="" class="optbulls"  name="list_type" id="our_records" value="our_records">
                {{ trans('common.filter.our_records') }}
                <span></span>
            </label>
            <label for="user_records" class="kt-radio"><input type="radio" class="optbulls" name="list_type" id="user_records" value="user_records" >
                {{ trans('common.filter.user_records') }}
                <span></span>
            </label>
        </div>
    </div>
    <div class="col-md-12" data-name="rtqSJwVg">
        <div class="bullData" data-name="qDHbBufB">
            <div class="lshapeBlk" data-name="QGQfUOTM"><i class="la la-level-down lshap"></i></div>
            <div class="lshBlksl" data-name="VQYihBSg">
                <select class="form-control m-select2" name="clients_list" id="client_list" >
                    <option value="">{{ trans('common.filter.user_select') }}</option>
                    @foreach($client_data as $client_row)
                        <option value="{{ $client_row->id }}">{{ $client_row->name}}</option>
                    @endforeach
                     @if($getTrashedClients->count() >0)
                    <optgroup label="Deleted Users">
                    @foreach($getTrashedClients as $row)
                        <option @if(!is_null($row->deleted_at)) class="line-throgh" @endif  value="{{ $row->id }}">
                            {{ $row->name}}
                        </option>
                    @endforeach
                    </optgroup>
                    @endif
                </select>
            </div>
        </div>
        <div class="admin_filter" id="admin-list-filter" data-name="crQnGQDk" >
            <div class="lshapeBlk" data-name="JrAELfWC"><i class="la la-level-down lshap"></i></div>
            <div class="lshBlksl" data-name="RlqVLCbu">
                <select class="mt-multiselect btn btn-default" multiple="multiple" data-label="left" name="admin_lists[]" id="admin_lists" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="true" data-placeholder="{{ trans('common.filter.filter_by_admin') }}">
                    @foreach($admins as $admin)
                        <option @if(!is_null($admin->deleted_at)) class="line-throgh" @endif value="{{ $admin->id }}">{{ $admin->name}}</option>
                    @endforeach
                     @if($getTrashedAdmins->count() >0)
                    <optgroup label="Deleted Users">
                       @foreach($getTrashedAdmins as $admind)
                        <option  @if(!is_null($admind->deleted_at)) class="line-throgh" @endif value="{{ $admind->id }}">
                            {{ $admind->name}}
                        </option>
                    @endforeach 
                     @endif
                </select>
            </div>
        </div>
    </div>
</div>
@endif