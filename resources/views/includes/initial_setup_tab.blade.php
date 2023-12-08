<div class="col-md-12 sidebar-setup-guide hide" data-name="SIYSIYgG">
                    <h2>{{ trans('common.label.Setup_Guide') }}</h2>
                    <h4>{{ trans('common.message.following_basic_steps') }}</h4>
                </div>
                <div class="col-md-12 setep_options" data-name="xWAYuylS">
                    @if(Auth::user()->is_staff == 1)
                    <?php $dest_file = base_path() . '/geoip/version'; ?>
                    <div class="setepOptions option1 @if(file_exists($dest_file)) { done @else @endif" data-name="cmFtKsYF">
                        <h3><i class="fa fa-check"></i> <span class="option-title">{{ trans('common.label.download_geoip_dependencies') }}</span></h3>
                        <p class="paraSetup">
                            <span>{{ trans('common.label.download_geoip') }}</span>
                            <button type="button" class="btn btn-info btn-sm mb1" id="download_dependencies" >{{ trans('common.label.geoip_dependencies') }}</button>
                            <span id="geoipDownloadFailed" style="display:none"><span class="alert alert-danger mb0"><span class="alert-text">{{ trans('common.message.license_verification_failed') }}</span></span></span>
                        </p>
                    </div>
                    @else 
                    <?php 
                        $dest_file = null; 
                    ?>
                    @endif

                    <div class="setepOptions option2 @if(empty($domain_maskings)) @else done @endif" data-name="EGknLOZR">
                        <h3><i class="fa fa-check"></i> <span class="option-title">{{ trans('sending_domains.add_new.page.title') }}</span></h3>
                        <p class="paraSetup">
                            <span>{{ trans('sending_domains.message.note') }}</span>
                            <button type="button" class="btn btn-info btn-sm" id="opts1" onclick='window.location.href = "{{ route('domain.create') }}"'>{{ trans('sending_domains.add_new.page.title') }}</button>
                        </p>
                    </div>
                    @php
                    $is_admin_panel_addon_active=\DB::table('addons')->where('type','AdminPanel')->where('status','active')->first();
                    @endphp
                    @if(!$is_admin_panel_addon_active)
                    <div class="setepOptions option3 @if($intial_bounces>0) done @else @endif" data-name="VmBYXQnq">
                        <h3><i class="fa fa-check"></i> <span class="option-title">{{ trans('bounce_addresses.add_new.page.title') }}</span></h3>
                        <p class="paraSetup">
                            <span>{{ trans('bounce_addresses.message.note') }}</span>
                            <button type="button" class="btn btn-info btn-sm" id="opts2" onclick='window.location.href = "{{ route('bounce.create') }}"'>{{ trans('bounce_addresses.add_new.page.title') }}</button>
                        </p>
                    </div>
                    <div class="setepOptions option4 @if($intial_sending_nodes>0) done @else @endif" data-name="MPieWUKA">
                        <h3><i class="fa fa-check"></i> <span class="option-title">{{ trans('sending_nodes.Connect_Sending_Node') }}</span></h3>
                        <div class="setupico" data-name="RzWWgMwj">
                            <i class="fa fa-angle-up upside"></i>
                            <i class="fa fa-angle-down downside"></i>
                        </div>
                        <p class="paraSetup">
                            <span>{{ trans('sending_nodes.message.note') }}</span>
                            <button type="button" class="btn btn-info btn-sm" id="opts3" onclick='window.location.href = "{{ route('node.create-new') }}"'>{{ trans('sending_nodes.Connect_Sending_Node') }}</button>
                        </p>
                    </div>
                    @endif
                    <div class="setepOptions option5 @if($intial_lists_count>0) done @else @endif" data-name="WymSCvAZ"> 
                        <h3><i class="fa fa-check"></i> <span class="option-title">{{ trans('lists.add_new.page.title') }}</span></h3>
                        <div class="setupico" data-name="hdPpUoja">
                            <i class="fa fa-angle-up upside"></i>
                            <i class="fa fa-angle-down downside"></i>
                        </div>
                        <p class="paraSetup">
                            <span>{{ trans('lists.note') }}</span>
                            <button type="button" class="btn btn-info btn-sm" id="opts4" onclick='window.location.href = "{{ route('list.create') }}"'>{{ trans('lists.add_new.page.title') }}</button>
                        </p>
                    </div>
                    <div class="setepOptions option6 @if($intial_contact_count>0) done @else @endif" data-name="XyczrkLi"> 
                        <h3><i class="fa fa-check"></i> <span class="option-title">{{ trans('contacts.import_contacts') }}</span></h3>
                        <div class="setupico" data-name="OWFyLRGz">
                            <i class="fa fa-angle-up upside"></i>
                            <i class="fa fa-angle-down downside"></i>
                        </div>
                        <p class="paraSetup">
                            <span>{{ trans('contacts.note') }}</span>
                            <button type="button" class="btn btn-info btn-sm" id="opts5" onclick='window.location.href = "{{ route('contact.create') }}"'>{{ trans('contacts.add_new.page.title') }}</button>
                            <button type="button" class="btn btn-info btn-sm" id="opts55" onclick='window.location.href = "{{ route('contact.import') }}"'>{{ trans('contacts.import_contacts') }}</button>
                        </p>
                        
                    </div>
                    <div class="setepOptions option7 @if($intial_campaigns_count>0) done @else @endif" data-name="GjsAvngz">
                        <h3><i class="fa fa-check"></i> <span class="option-title">{{ trans('broadcasts.First_Broadcast') }}</span></h3>
                        <div class="setupico" data-name="nRJQIfoK">
                            <i class="fa fa-angle-up upside"></i>
                            <i class="fa fa-angle-down downside"></i>
                        </div>
                        <p class="paraSetup">
                            <span>{{ trans('broadcasts.note') }}</span>
                            <button type="button" class="btn btn-info btn-sm" id="opts6" onclick='window.location.href = "{{ route('broadcasts.template') }}"'>{{ trans('broadcasts.add_new.page.title') }}</button>
                        </p>
                    </div>
                    <div class="setepOptions option8 @if($intial_campaign_schedules_count>0) done @else @endif" data-name="CpOQoxCE"> 
                        <h3><i class="fa fa-check"></i> <span class="option-title">{{ trans('broadcasts.Schedule_First_Broadcast') }}</span></h3>
                        <div class="setupico" data-name="QGYAtCJT">
                            <i class="fa fa-angle-up upside"></i>
                            <i class="fa fa-angle-down downside"></i>
                        </div>
                        <p class="paraSetup">
                            <span>{{ trans('broadcasts.message.doing_excellent_job') }}</span>
                            <button type="button" class="btn btn-info btn-sm" id="opts7" onclick='window.location.href = "{{ route('broadcast.schedule.create') }}"'>{{ trans('broadcasts.Schedule_Broadcast') }}</button>
                        </p>
                    </div>
                </div>
            </div>

            

<?php 
try { 
    $completedBar = 0;
    if(file_exists($dest_file)) $completedBar += 14;
    if(!empty($domain_maskings)) $completedBar += 14;
    if(!empty($intial_bounces)) $completedBar += 14;
    if(!empty($intial_sending_nodes)) $completedBar += 14;
    if(!empty($intial_lists_count)) $completedBar += 14;
    if(!empty($intial_contact_count)) $completedBar += 14;
    if(!empty($intial_campaigns_count)) $completedBar += 14;
    if(!empty($intial_campaign_schedules_count)) $completedBar += 14;
} catch(Exception $e) {
    echo $e->getMessage();
    $completedBar = 0;
}
    

   
?>

<script> 
 
    $(".is-val").html( "<?php echo $completedBar; ?>%");
    $("#initial-setup").css("width", "<?php echo $completedBar; ?>%");
    $("#initial-setup").attr("aria-valuenow", "<?php echo $completedBar; ?>%");
</script>