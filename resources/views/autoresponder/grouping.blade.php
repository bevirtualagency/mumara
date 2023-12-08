@extends('layouts.master2')

@section('title', trans('app.sidebar.view_drip_groups'))

@section('page_styles')
<style type="text/css">
    tr.group td {
        text-align: left !important;
    }
    span.kt-badge.fs {
        font-size: 1rem;
        padding: 0.85rem 1rem;
    }
</style>
@endsection

@section('page_scripts')
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/public/js/row-grouping.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
<script>
    /*$(document).ready(function() {
        $('#groups').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,4]}],
            "bProcessing": true,
            "bServerSide": true,
            "aaSorting": [[3, "desc"]],
            "sPaginationType": "full_numbers",
            "sAjaxSource": "{{ url('/getDripsGroups') }}",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });
    });*/

    function groupDelete(id) {
        if(confirm('{{trans('common.message.alert_delete')}}')) {
                $.ajax({
                    url: "{{ url('/') }}"+'/drip/group/delete/'+id,
                    type: "DELETE",
                    success: function(result) {
                        if(result == 'delete') {
                           /// console.log(id);
                            $("#row_"+id).attr("style", "display:none");
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.delete')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success');
                        }
                        else if(result == 'nodelete'){
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.trigger_used')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                        }
                        else{
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.drip_used')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                        }
                    }
                });
            }
    }
    function deleteAll () {
        if(!$('input:checkbox:checked').length){
           alert('{{trans('common.message.alert_no_record')}}');
           return false;
        }
        if(confirm('{{trans('common.message.alert_delete')}}')) {
            var groups = $('input:checkbox:checked').map(function() {
                return this.value;
            }).get();
            $.ajax({
                type    : "DELETE",
                url     : "{{ url('/') }}"+"/drips/group/delete/"+groups,
                data    : {ids: groups},
                success: function(result) {
                    if(result == 'delete') {
                        window.location.href = "{{ url('/') }}"+"/drips/group/view";
                    }else{
                        $('#msg').css("display", "flex");
                        $('#msg-text').html('{{trans('common.message.trigger_used')}}');
                        $('#msg').removeClass('display-hide').addClass('alert alert-success');   
                    }
                }
            });
        }
    }
</script>
@endsection

@section('content')
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="QsAzstgE">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="mPbNutal">
    <button class="close" data-close="alert"></button>
    <span id='msg-text' class="alert-text"><span>
</div>
<div class="row" data-name="ErwDEXpJ">
    <div class="col-md-12" data-name="nmQJgkXf">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="iwkGsZvB">
            <div class="kt-portlet__body" data-name="hitYXoCK">
                <div class="table-toolbar" data-name="QZFDDuJB">
                    <div class="form-group row" data-name="OZhtLVRN">
                        <div class="col-md-12" data-name="yqsNFkeP">
                            @if (rolePermission(193) || rolePermission(194) || rolePermission(185))
                            <div class="btn-group" data-name="azHGEbHz">
                                <a href="{{ route('drips.group.create') }}">
                                    <button id="sample_editable_1_new" class="btn btn-label-success">
                                        <i class="la la-plus"></i> {{trans('app.autoresponders.view_groups.buttons.add_group')}} 
                                    </button>
                                </a>
                            </div>
                            <!-- <div class="btn-group">
                                <a href="{{ route('drips.create') }}">
                                <button id="sample_editable_1_new" class="btn green">
                                    <i class="fa fa-plus"></i> {{trans('app.autoresponders.add_groups.buttons.add_drip')}} 
                                </button></a>
                            </div> -->
                            @endif
                            <div class="btn-group pull-right" data-name="UoRaveuD">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('common.form.buttons.tools')}}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                  @if (rolePermission(197))
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="la la-close"></i> {{trans('app.autoresponders.view_groups.buttons.tools_delete')}}  </a>
                                    </li>
                                  @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--begin: Datatable -->
                <table class="table table-striped- table-bordered table-hover table-checkable" id="groups">
                    <thead>
                        <tr>
                            <th>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('drip_campaigns.grouping_blade.Drip_name_th')}} </th>
                            <th>{{trans('drip_campaigns.grouping_blade.group_name_th')}} </th>
                            <th>{{trans('drip_campaigns.grouping_blade.delay_txt_th')}} </th>
                            <th>{{trans('drip_campaigns.grouping_blade.status_txt_th')}} </th>
                            <th>{{trans('drip_campaigns.grouping_blade.added_on_txt_th')}} </th>
                            <th>{{trans('drip_campaigns.grouping_blade.actions_txt_th')}} </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.local_leads_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.social_leads_td')}} </td>
                            <td>11 {{trans('drip_campaigns.grouping_blade.days_txt_td')}} </td>
                            <td>1</td>
                            <td>Oct 15, 2018 10:28:22 PM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.local_leads_three_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.social_leads_td')}} </td>
                            <td>4 {{trans('drip_campaigns.grouping_blade.days_txt_td')}}</td>
                            <td>2</td>
                            <td>Sep 21, 2018 10:28:22 PM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.local_leads_one_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.social_leads_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.instant_txt_td')}} </td>
                            <td>1</td>
                            <td>Aug 05, 2018 10:28:22 PM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.test_follow_up_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.wasif_test_td')}} </td>
                            <td>8 {{trans('drip_campaigns.grouping_blade.minutes_txt_td')}} </td>
                            <td>1</td>
                            <td>Oct 18, 2018 10:05:24 PM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.after_send_existing_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.wasif_test_td')}}</td>
                            <td>6 {{trans('drip_campaigns.grouping_blade.minutes_txt_td')}}</td>
                            <td>1</td>
                            <td>Oct 16, 2018 11:11:35 PM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.after_twentyfive_send_existing_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.wasif_test_td')}}</td>
                            <td>25 {{trans('drip_campaigns.grouping_blade.minutes_txt_td')}}</td>
                            <td>2</td>
                            <td>Oct 02, 2018 11:08:03 PM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.after_ten_send_existing_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.wasif_test_td')}}</td>
                            <td>10 {{trans('drip_campaigns.grouping_blade.minutes_txt_td')}}</td>
                            <td>2</td>
                            <td>Sep 23, 2018 11:08:03 PM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.thankyou_subscription_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.lp_leads_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.instant_txt_td')}}</td>
                            <td>1</td>
                            <td>May 14, 2018 08:38:46 AM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.intro_mumara_campaigns_td')}}</td>
                            <td>{{trans('drip_campaigns.grouping_blade.lp_leads_td')}}</td>
                            <td>1 {{trans('drip_campaigns.grouping_blade.days_txt_td')}}</td>
                            <td>1</td>
                            <td>May 14, 2018 08:48:21 AM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.your_inquiry_campaigns_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.lp_leads_td')}}</td>
                            <td>3 {{trans('drip_campaigns.grouping_blade.days_txt_td')}}</td>
                            <td>2</td>
                            <td>May 28, 2018 09:05:18 AM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.after_one_month_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.lp_leads_td')}}</td>
                            <td>1 {{trans('drip_campaigns.grouping_blade.months_txt_td')}} </td>
                            <td>1</td>
                            <td>May 14, 2018 09:04:49 AM</td>
                            <td nowrap></td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index" value="{$aRow->id}">
                                    <span></span>
                                </label>
                            </td>
                            <td>{{trans('drip_campaigns.grouping_blade.after_two_month_td')}} </td>
                            <td>{{trans('drip_campaigns.grouping_blade.lp_leads_td')}}</td>
                            <td>2 {{trans('drip_campaigns.grouping_blade.months_txt_td')}}</td>
                            <td>2</td>
                            <td>May 15, 2018 07:39:44 AM</td>
                            <td nowrap></td>
                        </tr>
                    </tbody>
                </table>
                <!--end: Datatable -->
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection