@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/issues-view.css?v={{$local_version}}.022" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
    <script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
    <script src="/themes/default/js/includes/common.js" type="text/javascript"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(".btn-retry").click(function() {
                var btn = $(this);
                //console.log($(this).parent("td").parent("tr").next("tr.notify").html();
                btn.parent("td").parent("tr").next("tr.notify").css("display", "table-row");
                btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-retry").show();
                btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-resolve").hide();
                setTimeout(function(){
                    btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").show();
                    btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-retry").hide();
                }, 3000);
                setTimeout(function(){
                    btn.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").hide();
                    btn.parent("td").parent("tr").next("tr.notify").hide();
                }, 6000);
            });
            $(".btn-resolve").click(function() {
                var btn2 = $(this);
                //console.log($(this).parent("td").parent("tr").next("tr.notify").html();
                btn2.parent("td").parent("tr").next("tr.notify").css("display", "table-row");
                btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-resolve").show();
                btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-retry").hide();

                // console.log('11111');
                setTimeout(function(){
                    btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").show();
                    btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-resolve").hide();
                    // console.log('22222');
                }, 3000);
                setTimeout(function(){
                    btn2.parent("td").parent("tr").next("tr.notify").children("td").find(".notify-success").hide();
                    btn2.parent("td").parent("tr").next("tr.notify").hide();
                    // console.log('33333');
                }, 6000);
            });

        });
        function checkPmtaStatus(error_to_verify,pmta_id,row_id) {
            $.ajax({
                type: "POST",
                url: '{{route('checkPmtaStatus')}}',
                data: {'string':error_to_verify,'pmta_id':pmta_id,'ref':row_id},
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#notify_'+row_id).css('display','table-row');
                    $('#process_'+row_id).slideDown('slow');
                    $('#success_'+row_id).hide();
                    $('#error_'+row_id).hide();
                },
                success: function (data) {
                    if (data.status==true) {
                        btn = $('#btn_'+row_id);
                        setTimeout(function () {
                            $('#process_'+row_id).hide();
                            $('#success_'+row_id).slideDown('slow');
                            btn.fadeOut('slow');
                        },1000);
                         btn_id = btn.siblings().last().attr('id');
                        setTimeout(function () {
                            $('.r_'+btn_id).slideUp('slow');
                            $('#notify_'+row_id).slideUp('slow');
                        },2000);
                    }
                    else {

                        setTimeout(function () {
                            $('#process_'+row_id).hide();
                            $('#error_'+row_id).slideDown('slow');
                        },2000);
                    }
                    return false;
                }
            });
        }
        function deleteIssue(id) {
            $.ajax({
                type: "POST",
                url: '{{route('deleteIssue')}}',
                data: {'id':id},
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $(".blockUI").show();
                    $('.r_'+id).css('background-color','#d65252').fadeIn(500);
                    $('.r_'+id+'_b').hide();
                },
                success: function (data) {
                    $(".blockUI").hide();
                    if (data.status==true) {
                        $('.r_'+id).fadeOut(1000, function () {
                            $(this).remove();
                        });
                    }
                    return false;
                }
            });
        }



        function runIpReputation(error_to_verify,pmta_id,row_id) {
            $.ajax({
                type: "POST",
                url: '{{url("admin/runIpReputation")}}',
                data: {'string':error_to_verify,'pmta_id':pmta_id,'ref':row_id},
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#notify_'+row_id).css('display','table-row');
                    $('#process_'+row_id).slideDown('slow');
                    $('#success_'+row_id).hide();
                    $('#error_'+row_id).hide();
                },
                success: function (data) {
                    if (data.status==true) {
                        btn = $('#btn_'+row_id);
                        setTimeout(function () {
                            $('#process_'+row_id).hide();
                            $('#success_'+row_id).slideDown('slow');
                            btn.fadeOut('slow');
                        },1000);
                         btn_id = btn.siblings().last().attr('id');
                        setTimeout(function () {
                            $('.r_'+btn_id).slideUp('slow');
                            $('#notify_'+row_id).slideUp('slow');
                        },2000);
                    }
                    else {

                        setTimeout(function () {
                            $('#process_'+row_id).hide();
                            $('#error_'+row_id).slideDown('slow');
                        },2000);
                    }
                    return false;
                }
            });
        }



        function runTriggerTasks(trigger_tasks , id, row_id) {
            $.ajax({
                type: "POST",
                url: '{{url("runTriggerTasks")}}',
                data: {'trigger_tasks':trigger_tasks},
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('#notify_'+row_id).css('display','table-row');
                    $('#process_'+row_id).slideDown('slow');
                    $('#success_'+row_id).hide();
                    $('#error_'+row_id).hide();
                },
                success: function (data) {
                    if (data.status==true) {
                        btn = $('#btn_'+row_id);
                        setTimeout(function () {
                            $('#process_'+row_id).hide();
                            $('#success_'+row_id).slideDown('slow');
                            btn.fadeOut('slow');
                        },1000);
                         var btn_id = $('#btn_'+row_id).val();
                        setTimeout(function () {
                            $('.r_'+btn_id).slideUp('slow');
                            $('#notify_'+row_id).slideUp('slow');
                        },2000);
                    }
                    else {

                        setTimeout(function () {
                            $('#process_'+row_id).hide();
                            $('#error_'+row_id).slideDown('slow');
                        },2000);
                    }
                    return false;
                }
            });
        }


    </script>
@endsection

@section(decide_content())

    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="GgRxJcbo">
            {{ Session::get('msg') }}
        </div>
    @endif
    <div id="msg" class="display-hide" data-name="jPbsrZcl">
        <button class="close" data-close="alert"></button>
        <span id='msg-text'><span>
    </div>
    <div class="row" data-name="jgEqHmYk">
        <div class="col-md-12" data-name="BTGpcvTJ">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="kt-portlet kt-portlet--height-fluid" data-name="UEEcdtDk">
                <div class="kt-portlet__body" data-name="opNDeuyy">
                    <div class="table-toolbar" data-name="sZIRgHvi">
                        <div class="form-group row" data-name="HUgwcdOz">
                            <div class="col-md-6" data-name="TEznRvmP">

                            </div>
                            <div class="col-md-6" data-name="RGqxwRwd">
                                <div class="btn-group pull-right" data-name="QKzsmBfA">
                                    <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                        {{trans('breadcrumbs.tools')}}
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                        <li>
                                            <a href="javascript:;" class="kt-font-brand"> <i class="la la-refresh fa-lg"></i> {{trans('issues.Retry_All')}}  </a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" class="kt-font-brand"> <i class="la la-check fa-lg"></i> {{trans('issues.Resolve_All')}}  </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollable table-scroll">
                        <table class="table table-striped- table-hover table-checkable" id="issues">
                            <thead>
                            <tr role="row">

                                <th>{{trans('issues.table_headings.user')}}</th>
                                <th>{{trans('issues.table_headings.module')}}</th>
                                <th>{{trans('issues.table_headings.details')}}</th>
                                <th>{{trans('issues.table_headings.suggestions')}}</th>
                                <th>{{trans('issues.table_headings.actions')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($classes = ["one","two"])
                            @php($i=0)

                            @if(!empty($issues))
                            @foreach($issues as $issue)
                                <tr class="r_{{$issue->id}} {{$classes[$i]}}">
                                    <td>
                                        <div class="kt-user-card-v2" data-name="XVjAMSpS">
                                            <div class="kt-user-card-v2__details" data-name="gLttXFos">
                                                <span class="kt-user-card-v2__name">{{$issue->user}}</span>
                                                <span class="kt-user-card-v2__desc kt-link">{{$issue->user}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        {{$issue->module}}
                                    </td>
                                    <td>
                                        <div class="kt-user-card-v2" data-name="FPtIIshP">
                                            <div class="kt-user-card-v2__details" data-name="DuOMCKZs">
                                                <span class="kt-user-card-v2__name">{!!$issue->issue!!}</span>
                                                <span class="kt-user-card-v2__desc kt-link">@lang('issues.Last_Checked'){{showDateTime(\Illuminate\Support\Facades\Auth::id(),$issue->updated_at,null,'M d, Y h:i:s A')}}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="kt-user-card-v2" data-name="BUQCQdmO">
                                            <div class="kt-user-card-v2__details" data-name="IrhUevLd">
                                                <span class="kt-user-card-v2__name">{!! $issue->resolution !!}</span>

                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button id="{{$issue->id}}" onclick="deleteIssue({{$issue->id}})"  type="button" class="btn btn-success btn-sm"><i class="fa fa-check fa-lg"></i> @lang('issues.Mark_Resolved')</button>
                                        @if($issue->js_test_method!=null)
                                            @php($methodArr = explode(",",$issue->js_test_method))
                                            @php($row_id = $methodArr[2])
                                            <button value="{{$issue->id}}" id="btn_{{rtrim($row_id,')')}}" onclick="{!! $issue->js_test_method !!}" type="button" class="btn btn-info btn-sm"><i class="la la-refresh fa-lg"></i> @lang('issues.Retry')</button>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="notify {{$classes[$i]}}" id="notify_{{$issue->ref_id}}">
                                    <td colspan="5">
                                        <div id="success_{{$issue->ref_id}}" class="alert alert-solid-success alert-bold notify-success" role="alert" data-name="aqHYoIJT">
                                            <div class="alert-text" data-name="niNGmDmX"><i class="fa fa-check fa-lg"></i>@lang('issues.resolved')</div>
                                        </div>
                                        <div id="process_{{$issue->ref_id}}" class="alert alert-solid-dark alert-bold notify-retry" role="alert" data-name="XuPEnCiG">
                                            <div class="alert-text" data-name="ICtfIMlq"><i class="la la-spinner fa-lg fa-spin"></i>{{trans('issues.in_progress')}}</div>
                                        </div>

                                        <div id="error_{{$issue->ref_id}}" class="alert alert-solid-danger alert-bold notify-danger" role="alert" data-name="GNYyEvvm">
                                            <div class="alert-text" data-name="wPeNvSrM"><i class="fa fa-times fa-lg"></i>{{trans('issues.not_resolved')}}</div>
                                        </div>
                                    </td>
                                </tr>
                                @php($i++)
                                @if(!isset($classes[$i]))
                                    @php($i = $i-2)
                                @endif
                            @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                        
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection