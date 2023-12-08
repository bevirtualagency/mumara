@extends(decide_template())
@section('title', $pageTitle)
@section('page_styles')
    <link href="/public/assets/vendors/custom/datatables/datatables.bundle.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
    <style>
        textarea{
            background: url(/assets/images/code-editor.png);
            background-attachment: local;
            background-repeat: no-repeat;
            padding-left: 35px;
            padding-top: 10px;
            margin-bottom:15px !important;
            border-color:#ccc;
            white-space: wrap; /* will prevent the default wrapping of text to next line */
            overflow-x: auto; /* will make horizontal scroll-bar appear only when needed */
        }

    </style>
@endsection
@section('page_scripts')
    <script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
    <script>
        function pmtaOperation(action)
        {
            var pmta_id = $('#pmta-id').val();
            $.ajax({
                type: "POST",
                async: true,
                url: "{{ URL::route('pmta.operation.store') }}",
                data: { action: action, pmta_id : pmta_id},
                beforeSend: function(xhr) {
                    $('.btn,#loader').toggle();
                }
            })
                .done(function(result) {
                    alert(result)
                    $('.btn,#loader').toggle();
                });
        }


        $("body").on("click" , "#saveLive" , function() {
            var r = confirm("@lang('common.message.are_you_sure')");
            if (r == true) {
                var pmta_id = $("#pmta_id").val();
                var pmta_config = $("#pmta_config_live").val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/') }}"+'/pmta/config/save_pmta_config',
                    data: { pmta_id : pmta_id,pmta_config:pmta_config,type:"live"}
                }).done(function( msg ) {
                    Command: toastr["success"] (msg);
                    location.reload();
                })
            }
        });


        $("body").on("click" , "#saveOriginal" , function() {

            var r = confirm("Are you sure?");
            if (r == true) {
                var pmta_id = $("#pmta_id").val();
                var pmta_config = $("#pmta_config").val();
                $.ajax({
                    type: "POST",
                    url: "{{ url('/') }}"+'/pmta/config/save_pmta_config',
                    data: { pmta_id : pmta_id,pmta_config:pmta_config,type:"original"}
                }).done(function( msg ) {
                    Command: toastr["success"] (msg);
                    location.reload();
                })
            }
        });



    </script>
@endsection
@section(decide_content())
    <div id="msg" class="display-hide" data-name="srLUolaJ">
        <button class="close" data-close="alert"></button>
        <span id='msg-text'><span>
    </div>
    <div class="row" data-name="VcYbUPGf">
        <div class="col-md-12" data-name="vmhOFVrp">


            <br><br>

            <div class="kt-portlet kt-portlet--height-fluid" style="clear: both;" data-name="XgxIkzYe">
                <div class="kt-portlet__body" data-name="hIVeTTkE">
                    <div class="table-toolbar" data-name="gKxGDggp">
                        <div class="row" data-name="rRlUinAJ">

                            <div class="table-responsive" data-name="BNnzGKVt">
                                <p style="float:right;" >{{trans('pmta.config.hvaving_trouble')}}<a class="btn text-success" href="https://community.mumara.com/threads/powermta-custom-config-to-work-with-mumara-campaigns.82/"  target="_blank"><b>{{trans('pmta.config.view_this_topic')}} </b></a></p>
                                <table class="table" id="pmtas" role="grid" >
                                    <thead>
                                    <tr role="row">
                                        <th width="20%">{{trans('pmta.config.table_column.server_name')}}</th>
                                        <th width="20%">{{trans('pmta.config.table_column.smtp_host')}}</th>
                                        <th width="20%">{{trans('pmta.config.table_column.smtp_port')}}</th>
                                        <th width="20%">{{trans('pmta.config.table_column.server_ip')}}</th>
                                        <th width="20%">{{trans('pmta.config.table_column.pmta_port')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr role="row">
                                        <?php  $pmta_data = json_decode($pmta->pmta_data, true);
                                            $pmta_port = $pmta->ssh_portl;
                                            if(!empty($pmta_data['http_port'])) {
                                                $pmta_port = $pmta_data['http_port'];
                                            }
                                        ?>
                                        <td>{{ $pmta->server_name }}</td>
                                        <td>{{ $pmta->smtp_host }}</td>
                                        <td>{{ $pmta->smtp_port }}</td>
                                        <td>{{ $pmta->server_ip }}</td>
                                        <td>{{ $pmta_port }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>

                            @if (!$pmta_data_server['error'])
                                <div id="row" class="col-md-12" data-name="wVLQmNfj">
                                    <!-- <div class="col-md-3">
                                @if ($pmta_data_server['exist'])
                                        {{ $pmta_data_server['status'] }} {{ $pmta_data_server['contents'] }}
                                    @else
                                        {{ $pmta_data_server['contents'] }}
                                    @endif
                                    </div> -->
                                    <!-- <div class="col-md-9">
                                <table width=400 style="float:left; margin-left:15px">
                                    <tr>
                                        <td colspan=3 height=50 align=center  style="font-weight:bold"> {{trans('app.integration.pmta.configuration.error.disk_status')}}</td>
                                    </tr>
                                    <tr>
                                        <td ><pre style="background:#f5f5f5; overflow:hidden;">{{ $pmta_data_server['disk_status'] }}</pre></td>
                                    </tr>
                              </table>
                                <table width=400 style="float:left; margin-left:15px">
                                    <tr>
                                        <td colspan=3 height=50 align=center  style="font-weight:bold"> {{trans('app.integration.pmta.configuration.error.memory_status')}}</td>
                                    </tr>
                                    <tr>
                                        <td ><pre style="background:#f5f5f5; overflow:hidden;">{{ $pmta_data_server['ram_status'] }}</pre></td>
                                    </tr>
                                </table>
                            </div> -->
                                    <div class="col-md-12" data-name="DhRpAtOg">

                                        <ul class="nav nav-tabs" role="tablist">
                                            <li class="nav-item">
                                                <a href="#tab2" class="nav-link active" data-toggle="tab" role="tab" aria-selected="false">@lang('common.label.active')</a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#tab1" class="nav-link" data-toggle="tab" role="tab" aria-selected="true">@lang('pmta.config.original')</a>
                                            </li>

                                        </ul>
                                        <div class="tab-content" data-name="BAfLTzkx">

                                            <div class="tab-pane active" id="tab2" role="tabpanel" data-name="pMnvZodE">
                                                <div class="row" data-name="GJCMYEps">
                                                    <div class="col-md-12" data-name="gzwNsmZC">
                                                        <form class="kt-form kt-form--label-right" action="" method="POST">
                                                            <div class="form-body" data-name="uONbUigL">
                                                                <h2>@lang('pmta.page.title')</h2>
                                                                <div class="form-group row mb0" data-name="uQQWlbwo">
                                                                    <div class="col-md-12" data-name="OjgXBXcc">
                                                                        <div class="input-icon right" data-name="KwTVbMXZ">
                                                                            <textarea id="pmta_config_live" name="file"  style="width:100%;box-shadow: 5px 5px 10px #999; border:2px solid #666" rows="30">{{ $pmta_config_live }}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-actions" data-name="LZGcJoqG">
                                                                <div class="row" data-name="hnUKEXIs">
                                                                    <div class="col-md-7" data-name="CtTLmzTU">
                                                                        <input type="hidden" name="pmta_id" id="pmta_id" value="{{$pmta->id}}">
                                                                        <button type="button" name="save_add" class="btn btn-sm btn-success" id="saveLive" value="save_add">{{trans('common.form.buttons.save')}}</button>
                                                                        <input type="button" class="btn btn-sm btn-info" value="@lang('pmta.config.buttons.reload_pmta')" onclick="pmtaOperation('reload_pmta')" >
                                                                        <input type="button" class="btn btn-sm btn-info" value="@lang('pmta.config.buttons.restart_pmta')" onclick="pmtaOperation('restart_pmta')" >
                                                                        <input type="button" class="btn btn-sm btn-info" value="@lang('pmta.config.buttons.restart_pmta_console')" onclick="pmtaOperation('restart_pmtahttp')" >
                                                                        <input type="button" class="btn btn-sm btn-danger" value="@lang('pmta.config.buttons.reboot_server')" onclick="pmtaOperation('restart_server')" >
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="tab-pane" id="tab1" role="tabpanel" data-name="uDFHXMso">
                                                <div class="row" data-name="MyFJQyOb">
                                                    <div class="col-md-12" data-name="ThRPzifg">
                                                        <h2>@lang('pmta.page.title')</h2>
                                                        <textarea id="pmta_config" style="width:100%;box-shadow: 5px 5px 10px #999; border:2px solid #666" rows="30">{{ $pmta_config }}</textarea>
                                                        <br>
                                                        <div id="row" data-name="VnOlMttS">
                                                            <button type="button" name="save_add" class="btn btn-sm btn-success" id="saveOriginal" value="save_add">{{trans('common.form.buttons.save')}}</button>
                                                            <input type="button" class="btn btn-sm btn-info" value="@lang('pmta.config.buttons.reload_pmta')" onclick="pmtaOperation('reload_pmta')" >
                                                            <input type="button" class="btn btn-sm btn-info" value="@lang('pmta.config.buttons.restart_pmta')" onclick="pmtaOperation('restart_pmta')" >
                                                            <input type="button" class="btn btn-sm btn-info" value="@lang('pmta.config.buttons.restart_pmta_console')" onclick="pmtaOperation('restart_pmtahttp')" >
                                                            <input type="button" class="btn btn-sm btn-danger" value="@lang('pmta.config.buttons.reboot_server')" onclick="pmtaOperation('restart_server')" >
                                                            <!--  <input type="button" class="btn btn-sm btn-warning" value="Restart Mysql" onclick="pmtaOperation('restart_mysql')" > -->
                                                            <input type="hidden" id="pmta-id" value='{{ $pmta->id }}' >
                                                            <i class="fa fa-gear fa-spin fa-2x text-info" id="loader" style="display:none"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                            @else
                                <div id="row" class="text-center col-md-12" data-name="TSAiVENx">
                                    @if(!empty($pmta_data_server['error_msg'])) {!! $pmta_data_server['error_msg'] !!} @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>
@endsection