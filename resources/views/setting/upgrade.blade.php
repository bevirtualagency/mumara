@extends('layouts.master')

@section('title', 'Upgrade')

@section('page_styles')
<style>
    .vtitle {
        font-weight: 600;
        border-bottom: 3px solid #333;
        display: table;
        margin-bottom: 25px;
    }
    .tblhd {
        font-size: 18px !important;
        background: #22313f;
        color: #f7f7f7;
    }
    input.aupdate {
        width: 19px;
        height: 19px;
        margin: 0;
    }
    label.aupdlbl {
        margin: 0;
        vertical-align: super;
        margin-left: 5px;
    }
    .unp {
        color: #999;
    }
    .unp.success {
        color: #333;
    }
    tr.unp.success td i.fa {
        color: #1cb09a;
    }
    .pross {
        display: inline-block;
        width: auto;
        float: left;
    }
    .prog {
        display: none;
        width: auto;
        float: right;
        margin-left: 12px !important;
    }
    .done {display: none;}
    .unp.success .pross {
        display: none;
    }
    .unp.success .done {
        display: block;
    }
    .pross.running .prog {
        display: block;
        height: 20px;
    }
    .running .pross {
        color: #2196F3;
    }
    .running .pross .prog {
        display: block;
    }
    .msg {
        display: none;
    }
    .unp.success .msg {
        display: table-cell;
        transition: 1s ease all;
    }
    #currentvers, #verslogs {
        display: table;
        width: 100%;
        min-height: 230px !important;
        border: 1px solid #e7ecf1;
        text-align: center;
        font-size: 14px;
        line-height: 24px;
        color: #999;
    }
    .cver {
        font-size: 50px;
        font-weight:  600;
        color: #22313f;
        line-height: 75px;
        padding: 20px;

    }
    #changes {
        display: table;
        width: 100%;
        min-height: 100px !important;
        border: 1px solid #e7ecf1;
        text-align: left;
        font-size: 14px;
        line-height: 24px;
        color: #999;
    }
    ul.upchanges {
        margin: 0;
        list-style-type: none;
        padding: 25px;
        color: #999;
    }
    ul.upchanges li i.fa {
        color: #1cb09a;
        padding-right: 5px;
    }
    .thumb img {
        margin-bottom: 20px;
    }
    a#detail {
        display: inline-block;
        float: right;
        padding-right: 25px;
    }
    a#vlogs {
        display: inline-block;
        float: left;
        padding-left: 25px;
    }
    table#verslogs a#crlogs {
        float: right;
        padding-right: 25px;
    }
    .vlmain {
        display: block;
        padding: 10px 20px;
    }
    table#verslogs tr td {
        padding:25px 20px;
    }
    .vlmain .vldtl {
        text-align: left;
        margin-bottom: 5px;
        padding-bottom: 5px;
        border-bottom: 1px dashed #ddd;
        padding-right: 5px;
    }
    .vlmain .vldtl a.vlvers {
        display: inline-block;
        float: right;
    }
    table#verslogs .cver {
        font-size: 50px;
        left: 50px;
        padding: 0;
    }
    table#changes tbody {
        width: 100%;
        display: table;
    }
    table#changes tbody tr td {
        border-top: 0;
    }
    tr#step6 td i.fa {
        opacity: 0;
        transition: 1s ease all;
    }
    #step6.success td i.fa {
        opacity: 1;
        transition: 1s ease all;
    }
    @media (max-width: 767px) {
        .vtitle {
            margin: 20px auto;
        }
        .thumb img {
            margin: 20px auto;
            display: block;
        }
        .cver {
            font-size: 50px;
        }
        ul.upchanges {
            padding: 10px;
        }
    }
    table.table tr.success td {
        background-color: inherit !important;
    }
    table#currentvers tr td {
        padding: 50px 25px 30px;
    }
</style>
@endsection
@section('page_scripts')

<script type="text/javascript">
    $(document).ready(function () {
        $('#detail').click(function () {
            $("#changes").fadeToggle("");
        });
        $('#vlogs').click(function () {
            $("#changes").fadeOut();
            $("#currentvers").fadeOut();
            $("#verslogs").fadeIn(4000, function(){

            });
        });
        $('#crlogs').click(function () {
            $("#changes").fadeOut();
            $("#verslogs").fadeOut();
            $("#currentvers").fadeIn(4000, function(){

            });
        });

        $('.vlvers').click(function(){
            $('#changes').fadeOut(1000);
            setTimeout(function(){
                $('#changes').fadeIn(1000, function(){
            });
            });
        });
    });
    function checkUpdateProcess() {
        $.ajax({
            type: "GET",
            url: "{{ URL::route('upgrade.status') }}",
            success: function (result) {
               // console.log(result)
                $("#update1").hide();
                $("#update2").show();
                if (result == 1) {
                    $("#step1").removeClass('running');
                    $("#step1").addClass('running');
                } else if (result == 2) {
                    $("#step1").removeClass('success');
                    $("#step1").addClass('success');
                    $("#step2").removeClass('running');
                    $("#step2").addClass('running');
                } else if (result == 3) {
                    $("#step1").removeClass('success');
                    $("#step1").addClass('success');
                    $("#step2").removeClass('success');
                    $("#step2").addClass('success');
                    $("#step3").removeClass('running');
                    $("#step3").addClass('running');
                } else if (result == 4) {
                    $("#step1").removeClass('success');
                    $("#step1").addClass('success');
                    $("#step2").removeClass('success');
                    $("#step2").addClass('success');
                    $("#step3").removeClass('success');
                    $("#step3").addClass('success');
                    $("#step4").removeClass('running');
                    $("#step4").addClass('running');
                } else if (result == 5) {
                    $("#step1").removeClass('success');
                    $("#step1").addClass('success');
                    $("#step2").removeClass('success');
                    $("#step2").addClass('success');
                    $("#step3").removeClass('success');
                    $("#step3").addClass('success');
                    $("#step4").removeClass('success');
                    $("#step4").addClass('success');
                    $("#step5").removeClass('running');
                    $("#step5").addClass('running');
                } else {
                    $("#step1").removeClass('success');
                    $("#step1").addClass('success');
                    $("#step2").removeClass('success');
                    $("#step2").addClass('success');
                    $("#step3").removeClass('success');
                    $("#step3").addClass('success');
                    $("#step4").removeClass('success');
                    $("#step4").addClass('success');
                    $("#step5").removeClass('success');
                    $("#step5").addClass('success');
                    $("#step6").addClass('success');
                    $("#changes").show();
                    $("#processStart").val(0);
                }
            }
        });
    }
</script>
@endsection
@section('content')
<!-- BEGIN PAGE BAR -->
<div class="page-bar" data-name="hTpIyhye">
    <ul class="page-breadcrumb">
        <li>
            <span>{{trans('app.settings.title')}}</span>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>{{trans('settings.upgrade.tittle_upgrade')}}</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">{{trans('settings.upgrade.tittle_upgrade')}}</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="m-heading-1 border-green m-bordered" data-name="mUjgotVR">
    <p>{{trans('settings.upgrade_campaigns_latest_para')}}</p>
</div>

@if($errors->any())
    <!-- For PHP validations errors-->
    <div class="alert alert-danger" data-name="TRagzWBD">
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif
<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="gHjLCJRX">
    {{ Session::get('msg') }}
</div>
@endif

<div class="row" data-name="CQmJjdYP">
    <!-- Start Process-->

    <div class="col-md-12" data-name="UOEzEptU">
        <div class="col-md-12" data-name="qoofVhWG"><h3 class="vtitle">{{trans('settings.upgrade_version_heading')}}</h3></div>
        <div class="col-md-2" data-name="qixJninf">
            <div class="thumb" data-name="CmTEpQtB">
                <img src="{{ asset('resources/assets/images/thumb.jpg')}}" align="Mumara New Version">
                <input type="hidden" name="processStart" id="processStart" value="0">
            </div>
        </div>
        <div class="col-md-6 col-md-offset-1" data-name="QPxngHbS">

            @if($local_version < $updated_version)

            <table class="table table-responsive table-strip update1" id="update1">
                <thead>
                    <tr>
                        <th width="30%" colspan="2" class="tblhd">{{trans('settings.upgrade_update_version_th')}} </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{trans('settings.upgrade_description_td')}}</td>
                        <td>{{trans('settings.upgrade_campaign_adminpannel_td')}} </td>
                    </tr>
                    <tr>
                        <td>{{trans('settings.upgrade_old_version_td')}}</td>
                        <td>{{trans('settings.upgrade_campaign_plus_td')}} {{$local_version}}</td>
                    </tr>
                    <tr>
                        <td>{{trans('settings.upgrade_available_version_td')}}</td>
                        <td>{{trans('settings.upgrade_campaign_plus_td')}} {{$updated_version}}</td>
                    </tr>
                    <tr>
                        <td>{{trans('settings.upgrade_last_update_td')}}</td>
                        <td>{{trans('settings.upgrade_campaign_plus_td')}} {{ isset($last_update) ? Carbon\Carbon::parse($last_update)->format('M d, Y h:i:s A') : '---'}}</td>
                    </tr>
                    <!-- <tr>
                        <td>Auto Update</td>
                        <td class="auchk">
                            <input type="checkbox" name="autoupdate" id="autoupdate" class="aupdate">
                            <label for="autoupdate" class="aupdlbl">Enable ( Check this option for auto update latest version )</label>
                        </td>
                    </tr> -->
                    <tr>
                        <td>{{trans('settings.upgrade_new_versionupdate_td')}}</td>
                        <td><button class="btn green" id="updatevers">{{trans('settings.upgrade_update_version_td')}}</button></td>
                    </tr>
                </tbody>
            </table>
            <script src="/js/dashboard/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#updatevers").click(function () {
                        $("#update1").hide();
                        $("#update2").show();
                        $("#processStart").val(1);
                        $("#step1").removeClass('running');
                        $("#step1").addClass('running');
                        $.ajax({
                            type: "GET",
                            url: "{{ URL::route('upgrade.status') }}",
                            success: function (data) {
                            }
                        });

                    });
                });
            </script>
            <script type="text/javascript">
                $(document).ready(function () {
                    setInterval(function () {
                        if ($("#processStart").val() == 1 || $("#processStart").val() == '1') {
                            checkUpdateProcess();
                        }
                    }, 5000);
                });
            </script>

            @elseif($local_version < $updated_version && $status != 0)
            <table class="table table-responsive table-strip update1" id="update1"></table>
            <script src="/js/dashboard/jquery.min.js"></script>
            <script type="text/javascript">
                $(document).ready(function () {
                    $("#update1").fadeToggle("");
                    $("#update2").fadeToggle(3000);
                    $("#processStart").val(1);
                    checkUpdateProcess();
                    setInterval(function () {
                        if ($("#processStart").val() == 1 || $("#processStart").val() == '1') {
                            checkUpdateProcess();
                        }
                    }, 5000);
                });
            </script>
            @else

            <table class="table table-responsive table-strip" id="currentvers">
                <tbody>
                    <tr>
                        <td>
                            {{trans('settings.upgrade_last_update_td')}}: {{ isset($last_update) ? Carbon\Carbon::parse($last_update)->format('M d, Y h:i:s A') : '---'}}<br>
                            <strong>{{trans('settings.upgrade_latest_version_td')}}</strong><br>
                            <div class="cver" data-name="NVYhRLGE">{{trans('settings.upgrade_campaign_plus_td')}} {{$local_version}}</div>
                            <!-- <a href="javascript:;" id="vlogs">Version Logs</a>
                            <a href="javascript:;" id="detail">Detail</a> -->
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-responsive table-strip" id="verslogs" style="display: none;">
                <tbody>
                    <tr>
                        <td>
                            <strong>{{trans('settings.upgrade_latest_version_td')}}</strong><br>
                            <div class="cver" data-name="CjdzAKnu">{{trans('settings.upgrade_campaign_plus_td')}} {{$local_version}}</div>
                            <div class="vlmain" data-name="VPmvHqod">
                                <div class="vldtl" data-name="FHgiuqgx">{{trans('settings.upgrade_campaign_plus_td')}} 0.6 <a href="javascript:;" class="vlvers">{{trans('settings.upgrade_detail_action_td')}}</a></div>
                                <div class="vldtl" data-name="kSBwItgv">{{trans('settings.upgrade_campaign_plus_td')}} 0.8 <a href="javascript:;" class="vlvers">{{trans('settings.upgrade_detail_action_td')}}</a></div>
                                <div class="vldtl" data-name="TgKIaWWM">{{trans('settings.upgrade_campaign_plus_td')}} 1.0 <a href="javascript:;" class="vlvers">{{trans('settings.upgrade_detail_action_td')}}</a></div>
                            </div>
                            <a href="javascript:;" id="crlogs">{{trans('settings.upgrade_current_version_action_td')}}</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            @endif

            <table class="table table-responsive table-strip update1" id="update2" style="display: none">
                <thead>
                    <tr>
                        <th  colspan="3" class="tblhd">{{trans('settings.upgrade_version_process_td')}} </th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="step1" class="unp">
                        <td width="10%" align="center"><i class="fa fa-check-square-o"></i></td>
                        <td width="40%">{{trans('settings.upgrade_download_zip_td')}}</td>
                        <td width="50%">
                            <div class="pross" data-name="wXZlvxPU">
                                {{trans('settings.upgrade_downloading_div')}} <img class="prog" src="{{ asset('resources/assets/images/proccess.gif')}}">
                            </div>
                            <div class="done" data-name="cnFaDsPx">{{trans('settings.upgrade_zip_downloading')}} ...</div>
                        </td>
                    </tr>
                    <tr id="step2" class="unp">
                        <td width="10%" align="center"><i class="fa fa-check-square-o"></i></td>
                        <td>{{trans('settings.upgrade_extract_zip_td')}} </td>
                        <td>
                            <div class="pross" data-name="DhyvXqiz">
                                {{trans('settings.upgrade_extracting_div')}} <img class="prog" src="{{ asset('resources/assets/images/proccess.gif')}}">
                            </div>
                            <div class="done" data-name="pVmIQJJI">{{trans('settings.upgrade_zip_extracted')}} ...</div>
                        </td>
                    </tr>
                    <tr id="step3" class="unp">
                        <td width="10%" align="center"><i class="fa fa-check-square-o"></i></td>
                        <td>{{trans('settings.upgrade_Installation_update_td')}} </td>
                        <td>
                            <div class="pross" data-name="JwgsHTDC">
                                {{trans('settings.upgrade_updating_div')}}  <img class="prog" src="{{ asset('resources/assets/images/proccess.gif')}}">
                            </div>
                            <div class="done" data-name="fMsHpZGL">{{trans('settings.upgrade_files_updated_div')}} ...</div>
                        </td>
                    </tr>
                    <tr id="step4" class="unp">
                        <td width="10%" align="center"><i class="fa fa-check-square-o"></i></td>
                        <td>{{trans('settings.upgrade_update_sql_td')}}</td>
                        <td>
                            <div class="pross" data-name="QRrljikb">
                                {{trans('settings.upgrade_updating_div')}} <img class="prog" src="{{ asset('resources/assets/images/proccess.gif')}}">
                            </div>
                            <div class="done" data-name="foLnYAZF">{{trans('settings.upgrade_sql_updated_div')}} ...</div>
                        </td>
                    </tr>
                    <tr id="step5" class="unp">
                        <td width="10%" align="center"><i class="fa fa-check-square-o"></i></td>
                        <td>{{trans('settings.upgrade_remove_old_files_td')}} </td>
                        <td>
                            <div class="pross" data-name="TYvWsfWz">
                                {{trans('settings.upgrade_removing_old_files_div')}} <img class="prog" src="{{ asset('resources/assets/images/proccess.gif')}}">
                            </div>
                            <div class="done" data-name="XrSSKfmw">{{trans('settings.upgrade_removed_old_files_div')}} ...</div>
                        </td>
                    </tr>
                    <tr id="step6" class="unp">
                        <td width="10%" align="center"><i class="fa fa-check-square-o"></i></td>
                        <td colspan="2" class="msg">{{trans('settings.upgrade_campaign_plus_td')}} {{$local_version}} {{trans('settings.upgrade_successfully_updated')}}  {{$updated_version}}</td>
                    </tr>
                </tbody>
            </table>


            <!-- <table class="table table-responsive table-strip" id="changes" valign="top" style="display: none;">
                <tbody>
                    <tr>
                        <td>
                            <ul class="upchanges">
                                <li><i class="fa fa-check-square-o"></i> Contacts importing process change.</li>
                                <li><i class="fa fa-check-square-o"></i> Clients lists delete option for Admin.</li>
                                <li><i class="fa fa-check-square-o"></i> User Profile previous Photos change option.</li>
                                <li><i class="fa fa-check-square-o"></i> Admin change Zone pricing for any user.</li>
                                <li><i class="fa fa-check-square-o"></i> Broadcast Schedual option integrated.</li>
                                <li><i class="fa fa-check-square-o"></i> Remove Downgrade/Upgrade in Packages.</li>
                                <li><i class="fa fa-check-square-o"></i> Admin Allow Multiple SenderID to any user.</li>
                            </ul>
                        </td>
                    </tr>
                </tbody>
            </table> -->
        </div>
    </div>
    <!-- End Proccess-->
</div>
@endsection