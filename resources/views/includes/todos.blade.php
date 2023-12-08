<?php 
$veriables=\App\Helpers\Common::todos();
extract($veriables);
?>
@if(file_exists ( 'install' ))
<div class="panel warning dash-panel2" id="warning1" data-intro="{{trans('sending_nodes.include_todos_blade.error_notification')}}" data-name="lhFokkFe">
            <div class="panel-body" data-name="UPATswld">
                <div class="DashbMsg font-dark" data-name="uDwBFEsM">
                {{trans('common.message.install_folder_warning')}} <a href="{{url('remove_installer')}}">[{{trans('common.buttons.form.delete')}}]</a>
                </div>
            </div>
        </div>
@endif
@if($update_alter_processing==1)
<div class="panel warning dash-panel2" id="cronsetup" data-name="CcynFFGX">
    <div class="panel-body" data-name="FBhEOAng">
        <div class="DashbMsg font-dark" data-name="HFrfNJHY" >
           {!! trans('common.message.background_running_warning') !!}
        </div>
    </div>
</div>
@endif
 @if(!$is_running and Auth::user()->role_id == 1)
<div class="panel warning dash-panel" id="cronsetup" data-intro="{{trans('common.label.warning_notification')}}" data-name="anhlQNHk">
    <div class="panel-body" data-name="xASenMgv">
        <div class="pull-right" data-name="BvvjyNmW"><button type="button" class="btn btn-default btn-xs" data-dismiss="alert" aria-hidden="true" id="dash-btn" onclick="window.location.href='{{ route('cron-status') }}'">{{trans('common.label.setup_cron')}}</button></div>
        <div class="DashbMsg font-white" data-name="vSFpOFqx">
        {!! trans('common.message.no_running_cron') !!}
        </div>
    </div>
</div>
@else

    @if(!empty($todos))
        <div class="panel warning dash-panel2" id="warning1" data-name="QtfmbOmr">
            <div class="panel-body" data-name="bQGjiALH">
                <div class="pull-right" data-name="uRHsnuhz"><button type="button" class="btn btn-default btn-xs" data-dismiss="alert" aria-hidden="true" id="dash-btn" onclick="window.location.href='{{ route($todos->route) }}'">{{$todos->name}}</button> <button type="button" class="btn btn-default btn-xs" data-dismiss="alert" aria-hidden="true" id="dash-btn" onclick="window.open('https://www.mumara.com/after-installing-campaigns/')">{{trans('common.label.learn_more')}}</button></div>
                <div class="DashbMsg font-dark" data-name="VvmETfjV">
                    {!! $todos->description !!}
                </div>
            </div>
        </div>
    @endif
@endif