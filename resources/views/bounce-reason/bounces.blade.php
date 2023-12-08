@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/bounce-reason-view.css?v={{$local_version}}.021" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
    <script src="/themes/default/js/jquery-ui.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            
            $("a#help-article").css("display", "block");
            $("a#help-article").attr("href", "https://docs.mumara.com/Campaigns/Setup/Bounce-Rules");
            
        });
        function bouncereasonDelete(id) {
            if(confirm('{{trans('common.message.alert_delete')}}')) {
                $("#row_"+id).attr("style", "display:none");
                $.ajax({
                    url: "{{ route('bounce-rules.destroy','') }}/"+id,
                    type: "DELETE",
                    beforeSend: function() {
                        $('#'+id).css('background','#d3103c');
                    },
                    success: function(result) {
                        if(result == 'delete') {
                            $('#msg').css("display", "flex");
                            $('#msg-text').html('{{trans('common.message.delete')}}');
                            $('#msg').removeClass('display-hide').addClass('alert alert-success');
                            $('#'+id).slideUp('slow');
                            setTimeout(2000,$('#'+id).remove());

                        }
                    }
                });
            }
        }
        $( function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        } );
        $('#sortable').sortable({
            items: "li:not(.not_draggable)"
        });


    $( function() {
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    } );
    $('#sortable').sortable({
        items: "li:not(.not_draggable)"
    });
    function saveOrder() {
        $.ajax({
            type: "POST",
            url: "{{route('saveBounceOrder')}}",
            data: $('#saveOrder').serialize(),
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if (data.status)
                    toastr.success(data.message);
                else
                    toastr.error(data.message);
                return false;
            }
        });
    }
     @if(Auth::id()==2)
 
    $(document).on('click','#sync_rules',function(e){
        e.preventDefault();
        if(confirm('{{trans('bounce_rules.message.sync_rule_alert')}}')) {
        $.ajax({
            type: "GET",
            url: "{{ route('sync_rules') }}",
            cache: false,
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if (data.success){
                    toastr.success(data.msg);
                    $.ajax({
                        type: "POST",
                        url: "{{route('nodeNewUi')}}",
                        data:{'column':'bounce_rules_synced','value':1},
                        beforeSend:function ()
                        {
                            $(".blockUI").show();
                        },complete: function () {
                            $('.blockUI').hide();
                            $('#bounceMsg').slideUp('slow');
                        }
                    });
                    location.reload();
                }else{
                    toastr.error(data.msg);
                }
            },
            error: function (data) {
                $('.blockUI').hide();
                toastr.error("Error");
            }
        });
    }
    });
    @endif

    $('#sortable').sortable({
        connectWith: '.dropme',
        cursor: 'pointer',
        stop: function(event, ui) {
            saveOrder()
        }
    });

    function changeStatus(status,url,table) {

        $.ajax({
            type: "PUT",
            url: url,
            data: {"status":status,"table":table},
            cache: false,
            dataType: 'json',
            beforeSend: function() {
                $('.blockUI').show();
            },
            success: function (data) {
                $('.blockUI').hide();
                if (data.status)
                    toastr.success(data.message);
                else
                    toastr.error(data.message);
                return false;
            }
        });

    }
        $('#module_list').on('click',function (){
         $('#sync_rules').trigger('click');
        });
</script>
@endsection

@section(decide_content())
    @if(!bounceRulesSynced() && $super_admin)
<div class="alert alert-info warning issue-note no-icon" role="alert" id="bounceMsg">
    <div class="alert-icon"><i class="flaticon-questions-circular-button"></i></div>
    <div class="alert-text">
        <b>{{trans('bounce_rules.bounce_blade.notice_txt_bold')}} </b>&nbsp; {{trans('bounce_rules.module.message')}}
    </div>                 
    <div class="text-right">
        <a href="javascript:;" class="btn btn-info btn-xs pull-right text-block" id="module_list">{{trans('bounce_rules.module.switch')}}</a>
    </div>
</div>
@endif
    <!-- will be used to show any messages -->
    @if (Session::has('msg'))
        <div class="alert alert-success" data-name="QpnFPCIU">
            {{ Session::get('msg') }}
        </div>
    @endif
    <div id="msg" class="display-hide" data-name="boFhwXcU">
        <button class="close" data-close="alert"></button>
        <span id='msg-text' class="alert-text"><span>
    </div>
    <div class="row" data-name="MAjckrcs">
        <div class="col-md-12" data-name="oIWSaeDs">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="kt-portlet kt-portlet--height-fluid" data-name="RpbZkMDZ">
                <div class="kt-portlet__body" data-name="BDDQSmVn">
                    <div class="caption" data-name="mQFxOcck">
                        @if(routeAccess('bounce-rules.create'))
                            <div class="btn-group" data-name="puZsnadz">
                                <a href="{{ route('bounce-rules.create') }}" style="margin-right:5px; ">
                                    <button id="sample_editable_1_new" class="btn btn-label-success">
                                        <i class="fa fa-plus"></i> {{trans('common.form.buttons.add_new')}}
                                    </button>
                                </a>
                                @if(Auth::id()==2)
                                <a href="{{ route('sync_rules') }}" id="sync_rules">
                                    <button  class="btn btn-label-warning">
                                        <i class='fas fa-sync-alt'></i> {{trans('bounce_rules.page.button.reset')}} 
                                    </button>
                                </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                <div class="portlet-body" data-name="FaLJSUvW">
                    <div class="col-md-12" data-name="xlVRSgtV">
                        <form class="" id="saveOrder" novalidate="novalidate">
                            <ul class="" id="sortable">
                                <li class="ui-state-default not_draggable">
                                    <span class=""></span>
                                    <span class="ui_label"><b>{{trans('bounce_rules.table_headings.label')}}</b></span>
                                    <span class="ui_reason"><b>{{trans('bounce_rules.table_headings.reason')}}</b></span>
                                    <span class="ui_detail"><b>{{trans('bounce_rules.table_headings.details')}}</b></span>
                                    <span class="ui_code"><b>{{trans('bounce_rules.table_headings.code')}}</b></span>
                                    <span class="ui_type types"><b>{{trans('bounce_rules.table_headings.type')}}</b></span>
                                    <span class="ui_type"><b>{{trans('bounce_rules.table_headings.status')}}</b></span>

                                    <span class="ui_action"><b>{{trans('bounce_rules.table_headings.actions')}}</b></span>
                                </li>
                                @php($user = Auth::user())
                                @if(isset($global))
                                    <li class="ui-state-default not_draggable" id="any">

                                        <span class=""></span>
                                        <span class="ui_label" title="Any">{{$global->label}}</span>
                                        <span class="ui_reason" title="Any">{{$global->reason}}</span>


                                        <span class="ui_detail" title="Any">{{$global->details}}</span>

                                        <span class="ui_code">{{trans('bounce_rules.any')}}</span>
                                        <span class="ui_type types">{{$global->type=='no_process'?trans('bounce_rules.no_process'):ucfirst($global->type)}}</span>
                                        {{--<span class="ui_type"><input type="checkbox" id="{{$reason->id}}" data-switch="true" data-on-color="success" {{$reason->status==1?'checked':''}} onclick="changeStatus('{{$url}}','{{$st}}','bounce_reasons')"></span>--}}
                                        <span class="ui_type">
                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                <label>
                                                    <input type="checkbox" readonly checked="">
                                                    <span></span>
                                                </label>
                                            </span>
                                        </span>

                                        <span class="ui_action">
                                   
                                        <a class="pull-right pe-none" title="@lang('common.form.buttons.delete')"><i class="fa fa-trash text-danger"></i></a>
                                   @if(routeAccess('bounce-rules.edit'))
                                        <a href="{{route('bounce-rules.edit', 'global')}}" class="pull-right" title="@lang('common.form.buttons.edit')"><i class="fa fa-edit text-success"></i></a>
                                   @endif
                                    </span>
                                    </li>
                                @endif
                                @foreach($bounce_reasons as $reason)
                                    {{--     @php($default = $reason->is_default)
                                    @if($default && !$user->is_admin)
                                        @continue;
                                        @endif--}}
                                    <li class="ui-state-default" id="{{$reason->id}}">
                                        <input type="hidden" name="ids[]" value="{{$reason->id}}">
                                        <span class="la la-bars"></span>
                                        <span class="ui_label" title="{{$reason->label}}">{{$reason->label}}</span>
                                        <span class="ui_reason" title="{{$reason->reason}}">{{$reason->reason}}</span>


                                        @php($st = $reason->status==1?'0':'1')
                                        @php($url = route('updateStatus', $reason))
                                        <span class="ui_detail" title="{{$reason->details}}">{{$reason->details}}</span>

                                        <span class="ui_code">{{$reason->code}}</span>
                                        <span class="ui_type types">{{$reason->type=='no_process'?trans('bounce_rules.no_process'):ucfirst($reason->type)}}</span>
                                        {{--<span class="ui_type"><input type="checkbox" id="{{$reason->id}}" data-switch="true" data-on-color="success" {{$reason->status==1?'checked':''}} onclick="changeStatus('{{$url}}','{{$st}}','bounce_reasons')"></span>--}}
                                        <span class="ui_type">
                                            <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                                <label>
                                                    <input type="checkbox" onchange="changeStatus('{{$st}}','{{$url}}','bounce_reasons')" {{$reason->status==1?'checked':''}}>
                                                    <span></span>
                                                </label>
                                            </span>
                                        </span>
                                        <span class="ui_action">
                                        @if(routeAccess('bounce-rules.destroy'))
                                        <a href="javascript:;" onclick="bouncereasonDelete('{{$reason->id}}')" class="pull-right" title="@lang('common.form.buttons.delete')"><i class="fa fa-trash text-danger"></i></a>
                                         @endif
                                         @if(routeAccess('bounce-rules.edit'))
                                        <a href="{{route('bounce-rules.edit', $reason->id)}}" class="pull-right" title="@lang('common.form.buttons.edit')"><i class="fa fa-edit text-success"></i></a>
                                    	@endif
                                    </span>
                                    </li>
                                @endforeach
                            </ul>
                        </form>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection