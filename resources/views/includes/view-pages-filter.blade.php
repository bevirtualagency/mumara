<?php
$getTrashedClients=\App\Helpers\Common\UserHandler::getTrashedClients()->select('id', 'name','is_client','deleted_at')->get();
$getTrashedAdmins=\App\Helpers\Common\UserHandler::getTrashedAdmins()->select('id', 'name','is_client','deleted_at')->get();
?>

<style type="text/css">
    .line-throgh{
     text-decoration: line-through;
    }
</style>
@if($admin)
<form action="" method="POST" id="frm-filters" name="frm-filters" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="row bulltOpt" data-name="TwNFSgas">
    
    <div class="col-md-12 pull-left bulltOpt" data-name="EOHtonkv">
        <div class="bullOptions kt-radio-inline" data-name="cYaNZIcl">
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
    
    <div class="col-md-12" data-name="VyIIguAw">
        
        <div class="bullData" data-name="wPsPjEmH">
            <div class="lshapeBlk" data-name="HooeAqMT"><i class="la la-level-down lshap"></i></div>
            <div class="lshBlksl" data-name="jdsxheGH">
                <select class="form-control m-select2" name="clients" id="clients" >
                    <option value="">{{ trans('common.filter.user_select') }}</option>
                    @foreach($client_data as $client_row)
                        <option  value="{{ $client_row->id }}">
                            {{ $client_row->name}}
                        </option>
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

        <div class="admin_filter" id="admin-filter" data-name="BwiBVlgX" >
            <div class="lshapeBlk" data-name="DryEbTIz"><i class="la la-level-down lshap"></i></div>
            <div class="lshBlksl" data-name="MQacFCdo">
                <select class="mt-multiselect btn btn-default" multiple="multiple" data-label="left" name="admins[]" id="admins" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="true" data-placeholder="{{ trans('common.filter.filter_by_admin') }}">
                    @foreach($admins as $admin)
                        <option  value="{{ $admin->id }}">
                            {{ $admin->name}}
                        </option>
                    @endforeach
                    @if($getTrashedAdmins->count() >0)
                    <optgroup label="Deleted Users">
                       @foreach($getTrashedAdmins as $admind)
                        <option  @if(!is_null($admind->deleted_at)) class="line-throgh" @endif value="{{ $admind->id }}">
                            {{ $admind->name}}
                        </option>
                    @endforeach 
                    </optgroup>
                    @endif
                     
                </select>
            </div>
        </div>

        @if(\Route::currentRouteName()=='broadcast.schedule.view.all')
        <!-- <div class="admin_filter" id="Bulk" style="float: right" data-name="hoHOzSjo">
            <div class="lshBlksl" data-name="oknDlikw">
                 <select class="form-control" name="bulk_operation" id="bulk_operation" >
                     <option value="" >{{ trans('schedule_broadcast.view.page.select_options') }}</option>
                     <option value="1">{{ trans('schedule_broadcast.view.page.delete') }}</option>
                </select>
            </div>
        </div> -->
        @endif
        
    </div>
</div>
</form>
@else

    @if(routeAccess('delete.selected.schedule.campaigns'))
    
        @if(\Route::currentRouteName()=='broadcast.schedule.view.all')
        <!-- <div class="row bulltOpt" data-name="jTvKtKFk">
            <div class="col-md-12" data-name="WKooxAqT">
                <div class="admin_filter" id="Bulk" style="float: right" data-name="JlzdRbQp">
                    <div class="lshBlksl" data-name="iQSZfTCF">
                         <select class="form-control" name="bulk_operation" id="bulk_operation" >
                             <option value="" >{{ trans('schedule_broadcast.view.page.select_options') }}</option>
                             <option value="1">{{ trans('schedule_broadcast.view.page.delete') }}</option>
                        </select>
                    </div>
                </div>
            </div>
        </div> -->
        @endif

    @endif

@endif