<div class="modal fade load-data-popup" id="load-data-customer-field" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="XvDSoyJr">
    <div class="modal-dialog modal-dialog-centered" role="document" data-name="GFNcySYN">
        <input type="hidden" name="GoUrl" id="GoUrl" value="" />
        <input type="hidden" name="elb" id="elb" value="0" />
        <div class="modal-content" data-name="zGieAejK">
            <div class="modal-header" data-name="CdsxLDbF">
                <h5 class="modal-title" id="resultTitle">{{ trans('statistics.modal.download_customer_field.title') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-name="xctwoHeI">
                <div class="alert alert-info alert-light alert-bold" role="alert" data-name="YmCMwFGW">
                    <div class="alert-text" data-name="MFihRTyz">{{ trans('statistics.modal.download_customer_field.description') }}</div>
                </div>
                <div class="kt-section mb0" data-name="enOONQoQ">
                    <div class="kt-section__content kt-section__content--solid" data-name="qGQgnGol">
                        <div class="kt-checkbox-list" data-name="CqljSWNZ">
                            <label class="kt-checkbox">
                                <input type="checkbox" id="isDownlloadCustomfields" value="1" name="isDownlloadCustomfields"  class="group-subscriber-p-2"> {{ trans('statistics.modal.download_customer_field.checkbox') }}
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="kt-section mb0" data-name="ennhytoQ" id="div_running_in_background">
                    <div class="kt-section__content kt-section__content--solid" data-name="qGQqwsxl">
                        <div class="kt-checkbox-list" data-name="Cqljbhi">
                            <label class="kt-checkbox">
                                <input type="checkbox" id="running_in_background" value="1" name="running_in_background"  class="group-subscriber-p-2"> {{ trans('statistics.modal.stats_download.running_in_background') }}
                                <span></span>
                            </label>
                        </div>
                    </div>
                </div>
                
                <div class="kt-section mb0" data-name="enOONQoQ" id="botsSection" style="display: none;">
                    <input type="hidden" id="openclickFlag" name="openclickFlag" value="0">
                    <div class="kt-section__content kt-section__content--solid" data-name="qGQgnGol">
                        <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success top-switch">
                            <label>
                                <input id="bot_inluded" type="checkbox" value="1" name="bot_inluded"> 
                                <span></span>
                            </label>
                            <div id="bot_message">{{ trans('Bots included?') }}</div>
                        </span>
                        
                    </div>
                </div>
                
            </div>
            <div class="modal-footer" data-name="BFLThkKT">
                <button type="button" id="downloadData"  class="btn btn-info btn-sm" style="float: right;" > {{ trans('statistics.modal.download_customer_field.button_name') }}</button>
            </div>
        </div>
    </div>
</div>