@extends(decide_template())
@section('title', $pageTitle)

@section('page_styles')
<link href="/resources/assets/css/running-process.css?v={{$local_version}}.02" rel="stylesheet" type="text/css">
@endsection

@section('page_scripts')
<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>
<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#running-process').dataTable({
            "order": [[ 0, "desc" ]]
        });

        $("#users").select2({
            placeholder: "Select User",
            allowClear: true,
             templateResult: function (data, container) {
                    if (data.element) {
                      $(container).addClass($(data.element).attr("class"));
                    }
                    return data.text;
                  }
        });

        $("#users").on("change", function() {
            $(".blockUI").show();
            setTimeout(function() {
                $("#running-process tr.even").hide();
                setTimeout(function() {
                    $("#running-process tr.even").show();
                    $(".blockUI").hide();
                }, 100);
            }, 1000);
        });

       $(document).on("click","i.la-refresh",function() {
            $(this).addClass("fa-spin");
            $(".blockUI").show();
            setTimeout(function() {
                $(".blockUI").hide();
                $("i.la-refresh").removeClass("fa-spin");
                Command: toastr["success"] ("@lang('running_process.message.process_restarted')"); 
            }, 2000);
            var form_data = {
                task_id: $(this).attr("data-id")
            }
            $.ajax({
                url: "{{ route('restart-process') }}",
                type: "POST",
                data: form_data,
                success: function(result) {
                       
                }
            });
        });
        $(document).on("click","i.la-close",function() {
            $(".blockUI").show();
            var form_data = {
                task_id: $(this).attr("data-id")
            }
            $.ajax({
                url: "{{ route('delete-process') }}",
                type: "POST",
                data: form_data,
                success: function(result) {
                    $(".blockUI").hide();
                    Command: toastr["error"] ("@lang('running_process.message.process_killed')");  
                    location.reload();
                }
            });
        });
    });    
</script>
@endsection
@section(decide_content())

<!-- will be used to show any messages -->
@if (Session::has('msg'))
<div class="alert alert-success" data-name="HYQpsIfO">
    {{ Session::get('msg') }}
</div>
@endif
<div id="msg" class="display-hide" data-name="tBnQBsqP">
    <button class="close" data-close="alert"></button>
    <span id='msg-text'><span>
</div>

<div class="row" data-name="bNwSFKSl">
    <div class="col-md-12" data-name="OMEFLVdG">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="ZASqvjqO">
            <div class="kt-portlet__body" data-name="efJOcNcT">
                <!-- <div class="table-toolbar">
                    <div class="form-group row">
                        <div class="col-md-2">
                            <select class="form-control m-select2" id="users" data-placeholder="Select User">
                                <option readonly>Select User</option>
                                <option value="1">Shahbaz Mughal</option>
                                <option value="2">Adnan Rasheed</option>
                                <option value="3">Arfan Ali</option>
                                <option value="4">Imjaad Haider</option>
                            </select>
                        </div>
                    </div>
                </div> -->
                <div class="table-scrollable">
                    <table class="table table-striped table-hover table-checkable responsive" id="running-process" role="grid" >
                        <thead>
                            <tr role="row">
                                <th>@lang('running_process.table_headings.id')</th>
                                <th>@lang('running_process.table_headings.user')</th>
                                <th>@lang('running_process.table_headings.task')</th>
                                <th>@lang('running_process.table_headings.thread')</th>
                                <th>@lang('running_process.table_headings.status')</th>
                                <th>@lang('running_process.table_headings.started')</th>
                                <th>@lang('running_process.table_headings.actions')</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            $tasks_name_array['suppression']          = trans('running_process.task.suppressed_sync');
                            $tasks_name_array['campaign_run']         = trans('running_process.task.running_campaign');
                            $tasks_name_array['campaign_preparation'] = trans('running_process.task.preparing_campaign');
                            $tasks_name_array['exportlist']           = trans('running_process.task.list_exporting');
                            $tasks_name_array['update_contacts']           = trans('running_process.task.updating_contacts');
                        ?>
                            @foreach($tasks as $task)
                            @if(!empty($tasks_name_array[$task->task]))
                            <tr>
                                <td>{{$task->id}}</td>
                                <td>{{$task->name}}</td>
                                <td>{{$tasks_name_array[$task->task]}}  ({{$task->record_id}})</td>
                                <td>{{$task->thread_id}}</td>
                                @if($task->status == 2) 
                                <td><span class="btn btn-bold btn-sm btn-font-sm  btn-label-brand">@lang('common.label.running')</span></td>
                                <td> <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($task->updated_at))->diffForHumans(); ?></td>
                                @elseif($task->status == 0)
                                <td><span class="btn btn-bold btn-sm btn-font-sm  btn-label-warning">@lang('common.label.pending')</span></td>
                                <td>@lang('running_process.scheduled_at'): <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($task->updated_at))->diffForHumans(); ?></td>
                                @endif
                                @if($task->task == "campaign_run")
                                    <td>
                                        <a href="javascript:;" class="kt-font-info" > --- </a>
                                        <a href="javascript:;" class="text-danger" title="@lang('running_process.kill_process')"> <i data-id="{{$task->id}}" class="la la-close text-danger"></i> </a>
                                    </td>   
                                @else 
                                <td>
                                    <a href="javascript:;" class="kt-font-info" title="@lang('common.label.force_restart')"> <i data-id="{{$task->id}}" class="la la-refresh kt-font-info"></i> </a>
                                    <a href="javascript:;" class="text-danger" title="@lang('running_process.kill_process')"> <i data-id="{{$task->id}}" class="la la-close text-danger"></i> </a>
                                </td>
                                @endif
                            </tr>
                            @endif
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>
@endsection