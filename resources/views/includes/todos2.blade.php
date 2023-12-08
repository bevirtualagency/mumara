<?php 
$veriables=\App\Helpers\Common::todos();
extract($veriables);
?>
<div class="headerTodo" data-name="pPJeHgLr">
@if(file_exists ( 'install' ) and Auth::user()->role_id == 1)
<div class="alert alert-warning" id="warning1" data-intro="{{trans('sending_nodes.include_todos_blade.error_notification')}}" data-name="uuNpXiFZ">
    <div class="alert-text" data-name="DyVvqaYr">
        {{trans('common.message.install_folder_warning')}}<a href="{{url('remove_installer')}}" class="pull-right kt-font-danger">[delete]</a>
    </div>
</div>
@endif
@if($update_alter_processing==1)
<div class="alert alert-warning" id="cronsetup" data-name="dDmLLpxX"> 
    <div class="alert-text" data-name="pUGWGiKY" >
        {!! trans('common.message.background_running_warning') !!}
    </div>
</div>
@endif
 @if(!$is_running and Auth::user()->role_id == 1)
<div class="alert alert-danger" role="alert" id="cronsetup" data-intro="{{trans('common.label.warning_notification')}}" data-name="HcLxMuNC">
    <div class="alert-text" data-name="WTxmesgj">
        {!! trans('common.message.no_running_cron') !!}
    </div>
    <div class="pull-right" data-name="wKLIMzhx">
        <button type="button" class="btn btn-default btn-xs" data-dismiss="alert" aria-hidden="true" id="dash-btn" onclick="window.location.href='{{ route('cron-status') }}'">{{trans('common.label.setup_cron')}}</button>
    </div>
</div>
@else

    @if(!empty($todos))
        <div class="alert alert-warning" id="warning1" data-name="zYpShBAo">
            <div class="alert-text" data-name="SqnMsMpz">
                {!!$todos->description!!}
            </div>
            <div class="pull-right" data-name="UofMwhcA">
                <button type="button" class="btn btn-default btn-xs" data-dismiss="alert" aria-hidden="true" id="dash-btn" onclick="window.location.href='{{ route($todos->route) }}'">{{$todos->name}}</button> 
                <button type="button" class="btn btn-default btn-xs" data-dismiss="alert" aria-hidden="true" id="dash-btn" onclick="window.open('https://www.mumara.com/after-installing-campaigns/')">{{trans('common.label.learn_more')}}</button>
            </div>
        </div>
    @endif
@endif
</div>