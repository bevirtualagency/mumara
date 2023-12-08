@extends(decide_template())

@section('title', $pageTitle)

@section('page_styles')
<link href="{{ url('/') }}/resources/assets/css/codemirror.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/resources/assets/css/neo.css?v={{$local_version}}" rel="stylesheet" type="text/css" />
<link href="{{ url('/') }}/resources/assets/css/db-check.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')

<script src="/themes/default/js/codemirror.js" type="text/javascript"></script>
<script src="/themes/default/js/javascript.js" type="text/javascript"></script>
<script src="/themes/default/js/htmlmixed.js" type="text/javascript"></script>
<script src="/themes/default/js/css.js" type="text/javascript"></script>
<script type="text/javascript">
	function copyFunction() {
	  var copyText = document.getElementById("queries");
        copyText.select();
        document.execCommand("copy");
	 Command: toastr["success"] ("@lang('dbcheck.sql_copied')"); 
	}
	function move() {
	  var bar = new ProgressBar.Line(progress, {
	  strokeWidth: 4,
	  easing: 'easeInOut',
	  duration: 3000,
	  color: '#333',
	  trailColor: '#eee',
	  trailWidth: 1,
	  svgStyle: {width: '100%', height: '100%'}
	});

	bar.animate(1.0);  // Number from 0.0 to 1.0
    }
    function compare_database() {
        // $(".blockUI ").show();
        $.ajax({
            type: "POST",
            url: '{{route('compare_database')}}',
            cache: false,
            beforeSend: function() {
               $(".step1").removeClass("active");
               $(".error-check").hide();
               $("#run-migrate-block").hide();
               $(".error-check .errors").css("display",'none');
               $(".step2").addClass("active");
            },
            success: function (result) {
                // $(".blockUI ").hide();
                if (result.success==1) { // Database has some changes
                    $(".step2").removeClass("active");
                    $(".step3").addClass("active");
                    if (result.output =="") { // Datatbase is uptodate
                    $(".data-updated").addClass('active');
                    $(".data-missing").removeClass('active');
                    return false;
                    }
                    $("#queries").text(result.output);
                    var code = $("#queries")[0];
                    var editor = CodeMirror.fromTextArea(code, {
                        lineNumbers: !0,
                        matchBrackets: !0,
                        styleActiveLine: !0,
                        theme: "neo",
                        mode: "javascript",
                        readOnly: false
                    });
                    editor.on("change", function(){
                        editor.save();
                    });
                    
                }else{
                    $(".step2").removeClass("active");
                    try {
                    var result=JSON.parse(result.output);
                    var html='';
                    $.each(result.data,function(i,val){
                        var icon= val.host_blocked==1 || val.port_blocked==1 ? '<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>';
                        if(val.host_blocked==1 || val.host_blocked==0){
                            html+='<tr>\
                                        <th> IP</th>\
                                        <td>'+val.host+' </td>\
                                        <td width="50px"> '+icon+'</td>\
                                    </tr>';
                        }
                        if(val.port_blocked==1 || val.port_blocked==0){

                          html+='<tr>\
                                        <th> {{trans('common.label.port')}}</th>\
                                        <td> '+val.port+' </td>\
                                        <td width="50px"> '+icon+'</td>\
                                    </tr>';
                        }
                    });
                        $(".error-check .errors h4").text(result.output);
                        $('.issue-table tbody').html(html);
                        $("#run-migrate-block").hide();
                        $('.issue-table').show();
                        $(".error-check").show();
                        $(".error-check .errors").css("display",'block'); 
  
                    }
                    catch(err) {
                        console.log(err.message);
                        $("#run-migrate-block").hide();
                        $(".error-check").show();
                        $(".error-check .errors h4").text(result.output);
                        $('.issue-table').hide();
                        $(".error-check .errors").css("display",'block'); 
                    }
                    
                    
                }
                
            }
        });
    }
    function rerun_migration() {
        $.ajax({
            type: "POST",
            url: '{{route('rerunMigrations')}}',
            cache: false,
            beforeSend: function() {
                $(".blockUI ").show();
                $("#mg-icon").addClass("fa-spin");
            },
            success: function (result) {
                $(".blockUI ").hide();
                $("#mg-icon").removeClass("fa-spin");
                Command: toastr["success"] ("@lang('dbcheck.migration_run_msg')"); 
            }
        });
    }
    function store_quries() {
        $.ajax({
            type: "POST",
            url: '{{route('store_quries')}}',
            cache: false,
            data: {queries:$('#queries').val()},
            beforeSend: function() {
               $(".overlay").show();
            },
            success: function (result) {
                $(".overlay").hide();
                if (result.success) {
                    $(".step3").removeClass("active");
                    $(".step4").addClass("active");
                    
                }else{
                   alert(result.output);
                }
                
            }, error: function (result) {
                $(".overlay").hide();
            }
        });
    }

	$(document).ready(function() {
		
		$("#fix-no").click(function() {
			$(".overlay").show();
			setTimeout(function() {
				$(".overlay").hide();
				Command: toastr["success"] ("@lang('dbcheck.changes_cancelled')"); 
				$(".step3").removeClass("active");
				$(".step5").addClass("active");
			}, 1500);
		});
		
	});
</script>

@endsection

@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="oZyuBLNL">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="wouonRNG">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="BOkBwkCn">
    <div class="col-md-8" data-name="OblPWunJ">
        <div class="kt-portlet kt-portlet--height-fluid" data-name="RUeSLiGx">
        	<div class="kt-portlet__head" data-name="MhywPQnx">
                <div class="kt-portlet__head-label" data-name="jOEbLQpA">
                    <h3 class="kt-portlet__head-title">{{trans('dbcheck.step2.heading')}}</h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="HOTVwIkG">
            	<div class="overlay" data-name="eAhVKVIr">
            		<i class="fa fa-spinner fa-spin" id="loading"></i>
            	</div>
            	<?php
                    $appliction_setting = getApplicationSettings();
                    $updated_date = isset($appliction_setting["updated_date"]) ? $appliction_setting["updated_date"] : date("d-m-Y", filemtime(base_path('version')));
                      $updated_version = $appliction_setting["updated_version"]; 
                      if(empty($appliction_setting["updated_version"])) {   
                            $newVersionAvailable=checkForNewVersion();
                            if($newVersionAvailable['success']==1){
                               $updated_version=$newVersionAvailable['updated_version'];
                            }
                        }
                     
                    // Loading config file
                    require base_path().'/app/Libraries/dbdiff/config.php';
                    // Pinging Source server
                    $host=$params['server1']['host'];
                    $port=$params['server1']['port'];
                    $username=$params['server1']['user'];
                    $password=$params['server1']['password'];
                    $db=$params['input']['source']['db'];
                    $source_server=ping_server($host,$port);
                    // print_r($source_server);exit;

                    // Check connection
                    $error='';
                    try {
                        $mysqli = new mysqli($host,"$username","$password","$db",$port);
                        if ($mysqli->connect_errno) {
                            throw new \Exception($mysqli ->connect_error, 1);
                            
                        }
                        $connection=true;
                    } catch (\Exception $e) {
                       $error=$e->getMessage();
                        $connection=false;
                    }
                    ?>

                <div class="kt-portlet kt-portlet--bordered" data-name="pJODGrH5" id="run-migrate-block">
                    <div class="kt-portlet__head" data-name="qTHZIBmc">
                        <div class="kt-portlet__head-label" data-name="ATccxBNh">
                            <h3 class="kt-portlet__head-title" style="">{{trans('dbcheck.run_migrations')}}</h3>
                        </div>
                    </div>
                    <div class="kt-portlet__body" data-name="vztGIoPd">
                        <div class="steps step1 active" data-name="TfPjnLHH">
                            <i class="fab fa-galactic-republic" id="mg-icon"></i>
                            <p>{{trans('dbcheck.migration_run_desc')}}</p>
                            
                            <button class="btn btn-info" onclick="rerun_migration();" id="checkUpdateMigration">{{trans('dbcheck.run_migrations')}}</button>
                        </div> 
                    </div>
                </div>   
                   
                
                <div class="hide">
                    <!-- Checking for new version -->
                    @if(trim($updated_version) != trim($local_version) and Auth::user()->role_id == 1) 	
                    <div class="steps error-check active" data-name="rElbldTa">
                        <div class="errors version active" data-name="uMnFEpNf">
                            <div class="kt-portlet kt-portlet--bordered" data-name="pJODGrH5" id="update-app-block">
                                <div class="kt-portlet__head" data-name="qTHZIBmc" style="">
                                    <div class="kt-portlet__head-label" data-name="ATccxBNh">
                                        <h3 class="kt-portlet__head-title" style="">Update Application</h3>
                                    </div>
                                </div>
                                <div class="kt-portlet__body" data-name="vztGIoPd">
                                    <div class="alert alert-danger alert-bold" role="alert" data-name="QMoNdeme">
                                        <div class="alert-text" data-name="UPYRmfdf">
                                            {!! trans('dbcheck.step1.old_version_message') !!}
                                        </div>
                                    </div>
                                    <h4 class="text-danger">{{trans('dbcheck.step1.update_to_latest')}}</h4>
                                    <div class="updateBlk" data-name="myUgLRFt">
                                        <div class="row" data-name="vBLKlvVQ">
                                            <div class="col-md-6 versBlk" data-name="ofHMCPMd">
                                                <span class="nBlk alert-warning">
                                                <small>{{trans('common.label.installed_version')}}</small>
                                            {{$local_version}}
                                                <small>{{trans('common.label.last_updated')}}<br>{{$local_version_date}}</small>
                                                </span>
                                            </div>
                                            <div class="col-md-6 versBlk" data-name="sZZqkokU">
                                                <span class="nBlk alert-success">
                                                <small>{{trans('common.label.latest_version')}}</small>
                                                {{$updated_version}}
                                                <small>{{trans('common.label.release_date')}}<br>{{$updated_date}}</small>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="{{ url('update') }}" class="btn btn-success">{{trans('dbcheck.step1.update_application')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @elseif(!empty($source_server) && ( (isset( $source_server[0]['host_blocked']) && $source_server[0]['host_blocked']==1) || ( isset($source_server[1]['port_blocked']) && $source_server[1]['port_blocked']==1) || $connection==false ))
                    <!-- Step 2 -->
                    <!-- Showing error when not connection to source or target -->
                    <!-- if Error Encountered, Show Error -->
                    <div class="error-check active" data-name="fFACIfFq">
                        <div class="errors connect active" data-name="IRRavmSo">
                            <div class="alert alert-danger alert-bold" role="alert" data-name="qMmOxRlL">
                                <div class="alert-text" data-name="bmUcbqNb">
                                {!! trans('dbcheck.error_step.error_encountered') !!}
                                </div>
                            </div>
                            @if($error)
                            <h4 class="text-danger">Access denied to the remote server</h4>
                            @else
                            <h4 class="text-danger">{!! trans('dbcheck.error_step.unable_to_connect') !!}</h4>
                            @endif
                            <div class="issue-table active" data-name="ABCoYzdl">
                                <table class="table table-striped table-bordered table-hover responsive">
                                    <tbody>
                                        @foreach($source_server as $server)
                                        <tr>
                                            <th>{{( isset($server['host_blocked']) && ($server['host_blocked']==1 || $server['host_blocked']==0)) ? trans('common.label.host') : trans('common.label.port')}}</th>
                                            <td>{{( isset($server['host_blocked']) && ($server['host_blocked']==1 || $server['host_blocked']==0)) ? $server['host'] : $server['port']}}</td>
                                            <td width="50px">{!! ((isset($server['host_blocked']) && $server['host_blocked']==1) || (isset($server['port_blocked']) && $server['port_blocked']==1)) ? '<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>' !!}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center" data-name="DTPDmsOC">
                                <button class="btn btn-info" onclick="location.reload();" id="checkUpdate">{{trans('dbcheck.check_again')}}</button>
                            </div>

                        </div>
                        @if($error)
                        <h4 class="text-danger">{{trans('dbcheck.index_blade.remote_server_heading')}}</h4>
                        @else
                        <h4 class="text-danger">{!! trans('dbcheck.error_step.unable_to_connect') !!}</h4>
                        @endif
                        <div class="issue-table active" data-name="ABCoYzdl">
                            <table class="table table-striped table-bordered table-hover responsive">
                                <tbody>
                                    @foreach($source_server as $server)
                                    <tr>
                                        <th>{{( isset($server['host_blocked']) && ($server['host_blocked']==1 || $server['host_blocked']==0)) ? trans('common.label.host') : trans('common.label.port')}}</th>
                                        <td>{{( isset($server['host_blocked']) && ($server['host_blocked']==1 || $server['host_blocked']==0)) ? $server['host'] : $server['port']}}</td>
                                        <td width="50px">{!! ((isset($server['host_blocked']) && $server['host_blocked']==1) || (isset($server['port_blocked']) && $server['port_blocked']==1)) ? '<i class="fa fa-times text-danger"></i>':'<i class="fa fa-check text-success"></i>' !!}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center" data-name="DTPDmsOC">
                            <button class="btn btn-info" onclick="location.reload();" id="checkUpdate">{{trans('dbcheck.check_again')}}</button>

                        </div>
                    </div>
                    @else
                    <!-- Step 3 -->
                    <!-- Connection established, update DB -->
                    <div class="steps step1 active" data-name="TfPjnLHH">
                        <i class="fa fa-database"></i> 
                        <p>{{trans('dbcheck.step2.press_button')}}</p>
                        <button class="btn btn-info" onclick="compare_database();" id="checkUpdateMigration">{{trans('dbcheck.check_with_remote_schema')}}</button>
                    </div> 
                    <!-- if Error Encountered, Show Error -->
                    <div class="error-check" data-name="XmzoXNFu">
                        <div class="errors connect" data-name="aZJmOOYj">
                            <div class="alert alert-danger alert-bold" role="alert" data-name="ZwcrHDlT">
                                <div class="alert-text" data-name="gGeBTUZW">
                                {!! trans('dbcheck.error_step.error_encountered') !!}
                                </div>
                            </div>
                            <h4 class="text-danger">{!! trans('dbcheck.error_step.unable_to_connect') !!}</h4>
                            <div class="issue-table" data-name="kpPSsGtI">
                                <table class="table table-striped table-bordered table-hover responsive">
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-center" data-name="GjhEZHHo">
                                <button class="btn btn-info" onclick="compare_database();" id="checkUpdate">{{trans('dbcheck.check_again')}}</button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="steps step2 waiting" data-name="mEimxRfZ">
                        <i class="fa fa-cog fa-spin"></i>
                        <span class="checking">{!! trans('dbcheck.checking_db') !!} <span class="one">.</span><span class="two">.</span><span class="three">.</span></span>
                        <div class="progress" data-name="dJNQvPUt">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" id="progress" role="progressbar" style="width: 100%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" data-name="jQIMYqfh"></div>
                        </div>
                    </div>

                    <div class="steps step3 result1" data-name="QTsmvZmv">
                        <div class="data-updated" data-name="RHyApVda">
                            <div class="alert alert-success alert-bold" role="alert" data-name="kwlbwHxd">
                                <div class="alert-text" data-name="dIuALxhi">{!! trans('dbcheck.db_uptodate') !!}</div>
                            </div>
                            <a href="{{ url('/') }}/dashboard" class="btn btn-success">{!! trans('dbcheck.go_to_dashboard') !!}</a>
                        </div>
                        <div class="data-missing active" data-name="QWwDGvDd">
                            <div class="alert alert-warning alert-bold" role="alert" data-name="HqyHKGNY">
                                <div class="alert-text" data-name="JaCWcvNm">{!! trans('dbcheck.sql_found') !!}</div>
                            </div>
                            <div class="codearea" data-name="NqJiLGBp">

                                <a href="javascript:;" class="text-sucess pull-right" onclick="copyFunction()" id="menual"><i class="la la-copy"></i> {!! trans('dbcheck.Copy_SQL') !!}</a>
                                <textarea id="queries" class="codemirror-textarea">	</textarea>
                            </div>
                            <button class="btn btn-default btn-sm" id="fix-no"> @lang('common.form.buttons.cancel') </button>
                            <button class="btn btn-success pull-right btn-sm" onclick="store_quries();" id="finalupdate">@lang('common.form.buttons.update')</button>
                        </div>	
                    </div>

                    <div class="steps step4 finished" data-name="qUhNgqaP">
                        <div class="success text-success" data-name="NttJpHEb">
                            <i class="fa fa-thumbs-up"></i>
                        </div>
                        <p>{!! trans('dbcheck.process_started') !!}</p>
                        <a href="{{ url('/') }}/dashboard" class="btn btn-success">{!! trans('dbcheck.go_to_dashboard') !!}</a>
                    </div>

                    <div class="steps step5 cancel" data-name="xjutbFOF">
                        <div class="cancelled" data-name="GYYeSWyf">
                            <i class="fa fa-window-close"></i>
                        </div>
                        <p>{!! trans('dbcheck.operation_cancelled') !!}</p>
                        <a href="{{ url('/') }}/dashboard" class="btn btn-success">{!! trans('dbcheck.go_to_dashboard') !!}</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


@endsection