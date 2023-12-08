@extends('layouts.master2')

@section('title', trans('library.index_blade.library_title'))
<link href="/themes/default/css/code/prism.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<link href="/themes/default/css/code/prism-line-numbers.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
<link href="/themes/default/css/code/prism-okaidia.css?v={{$local_version}}.01" rel="stylesheet" type="text/css">
@section('page_styles')

@endsection

@section('page_scripts')
<script src="/themes/default/js/jquery.form.min.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.validate.js" type="text/javascript"></script>
<script src="/themes/default/js/additional-methods.js" type="text/javascript"></script>
<script src="/themes/default/js/init.js" type="text/javascript"></script>
<script src="/themes/default/js/form-controls.js" type="text/javascript"></script>

<script src="/themes/default/js/select2.full.min.js" type="text/javascript"></script>
<script src="/themes/default/js/select2.js" type="text/javascript"></script>

<script src="/themes/default/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="/themes/default/js/components-bootstrap-multiselect.min.js" type="text/javascript"></script>

<script src="/themes/default/js/datatables.bundle.js" type="text/javascript"></script>
<script src="/themes/default/js/includes/common.js" type="text/javascript"></script>

<script src="/themes/default/js/lib.js" type="text/javascript"></script>
<script src="/themes/default/js/jquery.input.js" type="text/javascript"></script>
<script src="/themes/default/js/repeater.js" type="text/javascript"></script>

<script src="/themes/default/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
<script src="/themes/default/js/datepicker-init.js" type="text/javascript"></script>
<script src="/themes/default/js/bootstrap-datepicker.js" type="text/javascript"></script>

<script src="/themes/default/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>

<script src="/themes/default/js/jquery.dm-uploader.min.js" type="text/javascript"></script>
<script src="/themes/default/js/demo-ui.js" type="text/javascript"></script>

<script src="/themes/default/js/code/prism.js" type="text/javascript"></script>
<script src="/themes/default/js/code/prism-java.js" type="text/javascript"></script>
<script src="/themes/default/js/code/prism-line-numbers.js" type="text/javascript"></script>

<script type="text/javascript">
    function copyFunction() {
          var copyText = document.getElementById("copyurl");
          copyText.select();
          document.execCommand("copy");
          //alert("Copied the text: " + copyText.value);
          Command: toastr["success"] ("{{trans('library.index_blade.api_key_copied_command')}}");
    }
    function copy_user(containerid) {
        var range = document.createRange();
        range.selectNode(containerid); //changed here
        window.getSelection().removeAllRanges(); 
        window.getSelection().addRange(range); 
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        Command: toastr["success"] ("{{trans('library.index_blade.command_value_copied_success')}}");
    }
    function copy_pass(containerid) {
        var range = document.createRange();
        range.selectNode(containerid); //changed here
        window.getSelection().removeAllRanges(); 
        window.getSelection().addRange(range); 
        document.execCommand("copy");
        window.getSelection().removeAllRanges();
        Command: toastr["success"] ("{{trans('library.index_blade.command_password_copied')}}");
    }
    $(document).ready(function() {

        $(".tnmar").on("click", function() {
            $(this).hide();
            $("#system_notifications .kt-notification__item").removeClass("unread");
            $("#noti_count").text("0");
        })

        $(document).on("click", ".notif-read", function() {
            $(this).parent().parent().removeClass("unread");
            $("#system_notifications .tnmar").show();
            var count = $("#noti_count").text();
            $("#noti_count").text(count-1);
        });

        $(document).on("click", ".notif-unread", function() { alert("dddd");
            $(this).parent().parent().addClass("unread");
            $("#system_notifications .tnmar").show();
            var count = $("#noti_count").text();
            $("#noti_count").text(++count);
        });

        $(document).on("click", "a.kt-links", function() {
            var parent = $(this).parent().parent();
            if($(parent).hasClass("unread")) {
                $(parent).removeClass("unread");
                $("#system_notifications .tnmar").show();
                var count = $("#noti_count").text();
                $("#noti_count").text(count-1);
            } else {
                $(parent).addClass("unread");
                $("#system_notifications .tnmar").show();
                var count = $("#noti_count").text();
                $("#noti_count").text(++count);
            }
        });

        $("#deletelist").click(function() {
            $(".blockUI").show();
            var mlist = $("#move-list").val();
            if(mlist === undefined || mlist === "") {
                $(".list-scroll .select2-selection").css("border-color", "red");
                Command: toastr["error"] ("{{trans('library.index_blade.command_select_contact_list')}}");
                $(".blockUI").hide();
            }
            else {
                setTimeout(() => {
                    $(".blockUI").hide();
                    $("#deleteMe").modal("hide");
                    Command: toastr["success"] ("{{trans('library.index_blade.command_contact_successfully')}}");
                }, 1000);
            }
        });

        $('pre').append('<span class="command-copy" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><g fill="none" fill-rule="evenodd" transform="translate(0 -1)"><circle cx="12" cy="13" r="12" fill="#506174"></circle><g stroke="#FFF" stroke-linecap="round" stroke-linejoin="round" opacity=".5"><path d="M7.284 10.716h7v7h-7z"></path><path d="M10.33 8.284h6.25v7.386"></path></g></g></svg></span>');

        $('code span.command-copy').click(function(e) {
            var text = $(this).parent().text().trim(); //.text();
            var copyHex = document.createElement('input');
            copyHex.value = text
            document.body.appendChild(copyHex);
            copyHex.select();
            document.execCommand('copy');
            // console.log(copyHex.value)
            document.body.removeChild(copyHex);
            Command: toastr["success"] ("{{trans('library.index_blade.command_code_copied')}}");
        });

        $('pre span.command-copy').click(function(e) {
            var text = $(this).parent().text().trim();
            var copyHex = document.createElement('input');
            copyHex.value = text
            document.body.appendChild(copyHex);
            copyHex.select();
            document.execCommand('copy');
            //console.log(copyHex.value)
            document.body.removeChild(copyHex);
            Command: toastr["success"] ("{{trans('library.index_blade.command_code_copied')}}");
        });
        // $('#parent-5').addClass('kt-menu__item--open');
        // $('#parent-5 #child-35').addClass('kt-menu__item--active kt-menu__item--open');
        
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });

    });
</script>

<script type="text/javascript">
    var table_data = `<tr class="row_6">
        <td>6</td>
        <td>{{trans('library.index_blade.record_td_txt')}} 6</td>
        <td>
            <i class="fa fa-spinner fa-spin fa-lg processings"></i>
        </td>
        <td class="resp_6">{{trans('library.index_blade.waiting_response_td')}}</td>
    </tr>
    <tr class="row_7">
        <td>7</td>
        <td>{{trans('library.index_blade.record_td_txt')}} 7</td>
        <td>
            <i class="fa fa-spinner fa-spin fa-lg processings"></i>
        </td>
        <td class="resp_7">{{trans('library.index_blade.waiting_response_td')}}</td>
    </tr>
    <tr class="row_8">
        <td>8</td>
        <td>{{trans('library.index_blade.record_td_txt')}} 8</td>
        <td>
            <i class="fa fa-spinner fa-spin fa-lg processings"></i>
        </td>
        <td class="resp_8">{{trans('library.index_blade.waiting_response_td')}}</td>
    </tr>
    <tr class="row_9">
        <td>9</td>
        <td>{{trans('library.index_blade.record_td_txt')}} 9</td>
        <td>
            <i class="fa fa-spinner fa-spin fa-lg processings"></i>
        </td>
        <td class="resp_9">{{trans('library.index_blade.waiting_response_td')}}</td>
    </tr>
    <tr class="row_10">
        <td>10</td>
        <td>{{trans('library.index_blade.record_td_txt')}} 10</td>
        <td>
            <i class="fa fa-spinner fa-spin fa-lg processings"></i>
        </td>
        <td class="resp_10">{{trans('library.index_blade.waiting_response_td')}}</td>
    </tr>`;

    var notificationsHtml = `<div class="kt-notification__item">
        <div class="kt-notification__item-icon"> 
            <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="Description"></i> 
            <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="Description"></i> 
        </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> {{trans('library.index_blade.div_campaign_subscribers')}} </div>
            <div class="kt-notification__item-time"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
            <a href="/storage/list.csv" download="" class="kt-links">{{trans('library.index_blade.action_download_file')}}</a>
        </div>
    </div>
    <div class="kt-notification__item">
        <div class="kt-notification__item-icon"> 
            <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read"data-original-title="Description"></i> 
            <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="Description"></i> 
        </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> {{trans('library.index_blade.div_my_first_segment')}} </div>
            <div class="kt-notification__item-time"> 3 {{trans('library.index_blade.div_hour_before')}} </div>
            <a href="/storage/segment.csv" download="" class="kt-links">{{trans('library.index_blade.action_download_file')}}</a>
        </div>
    </div>
    <div class="kt-notification__item">
        <div class="kt-notification__item-icon"> 
            <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read"data-original-title="Description"></i> 
            <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="Description"></i> 
        </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> {{trans('library.index_blade.div_segment_lahore')}} </div>
            <div class="kt-notification__item-time"> 17 {{trans('library.index_blade.div_seconds_before')}} </div>
            <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_segmented_contacts')}}</a>
        </div>
    </div>
    <div class="kt-notification__item">
        <div class="kt-notification__item-icon"> 
            <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="Description"></i> 
            <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="Description"></i> 
        </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> {{trans('library.index_blade.div_broadcast_finished')}}</div>
            <div class="kt-notification__item-time"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
            <a href="javascript:;" class="kt-links">View statistics</a>
        </div>
    </div>
    <div class="kt-notification__item">
        <div class="kt-notification__item-icon"> 
            <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="Description"></i> 
            <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="Description"></i> 
        </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> {{trans('library.index_blade.div_independence_day')}} </div>
            <div class="kt-notification__item-time"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
            <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_view_broadcasts')}}</a>
        </div>
    </div><div class="data-processing"><i class="fa fa-spinner fa-spin"></i></div>`;

    var issuesHtml = `<a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="fa fa-exclamation-triangle kt-font-warning"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> <b>{{trans('library.index_blade.div_curl_error')}} 6:</b> {{trans('library.index_blade.div_not_resolve_host')}} https://curl.haxx.se/libcurl/c/libcurl-errors.html) </div>
            <div class="kt-notification__item-time"> Last Checked Nov 28, 2020 04:52:59 AM </div>
            <button type="button" id="1" class="btn btn-success btn-xs resolve-btn">{{trans('library.index_blade.button_mark_resolved')}}</button>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="fa fa-exclamation-triangle kt-font-warning"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> <b>{{trans('library.index_blade.div_curl_error')}} 5:</b> {{trans('library.index_blade.div_not_resolve_host')}} https://curl.haxx.se/libcurl/c/libcurl-errors.html) </div>
            <div class="kt-notification__item-time"> Last Checked Nov 19, 2020 11:21:33 PM </div>
            <button type="button" id="1" class="btn btn-success btn-xs resolve-btn">{{trans('library.index_blade.button_mark_resolved')}}</button>
        </div>
    </a>
    <a href="#" class="kt-notification__item">
        <div class="kt-notification__item-icon"> <i class="fa fa-exclamation-triangle kt-font-warning"></i> </div>
        <div class="kt-notification__item-details">
            <div class="kt-notification__item-title"> <b>{{trans('library.index_blade.div_curl_error')}} 4:</b> {{trans('library.index_blade.div_not_resolve_host')}} https://curl.haxx.se/libcurl/c/libcurl-errors.html) </div>
            <div class="kt-notification__item-time"> Last Checked Nov 08, 2020 10:37:17 AM </div>
            <button type="button" id="1" class="btn btn-success btn-xs resolve-btn">{{trans('library.index_blade.button_mark_resolved')}}</button>
        </div>
    </a><div class="data-processing"><i class="fa fa-spinner fa-spin"></i></div>`;
        
    $(document).ready(function() {

        $('#notificationsBlk').on('scroll', function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                setTimeout(() => {
                    $("#notificationsBlk .data-processing").remove();
                    $("#notificationsBlk").append(notificationsHtml);
                }, 2500);
            }
        });
        $('#issuesBlk').on('scroll', function() {
            if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
                setTimeout(() => {
                    $("#issuesBlk .data-processing").remove();
                    $("#issuesBlk").append(issuesHtml);
                }, 2500);
            }
        });

        $(".m-select2").select2({
            templateResult: function (data, container) {
                if (data.element) {
                  $(container).addClass($(data.element).attr("class"));
                }
                return data.text;
            }
        });

        $(".cancel-processing").click(function() {
            $(".load-data-spinner").show();
            setTimeout(function() {
                $(".load-data-spinner").hide();
                $(".cancel-processing").hide();
                $(".popup-btn-close").show();
                $(".processing-cancelled").css("display", "inline-block");
            }, 1000);
        });

        $(".btn-start").click(function() {
            var rowpos = $('#load-data-table tr:last').position();
            $(".load-data-spinner").show();
            setTimeout(function() {
                $(".load-data-spinner").hide();
                $(".popup-first-blk").hide();
                $(".load-data-popup .modal-header button.close").hide();
                $(".popup-last-blk").show();
                setTimeout(function() {
                    $("tr.row_1 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-check text-success");
                    $(".resp_1").text("{{trans('library.index_blade.operation_successful_text')}}");
                    setTimeout(function() {
                        $("tr.row_2 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-check text-success");
                        $(".resp_2").text("{{trans('library.index_blade.operation_successful_text')}}");
                        setTimeout(function() {
                            $("tr.row_3 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-check text-success");
                            $(".resp_3").text("{{trans('library.index_blade.operation_successful_text')}}");
                            setTimeout(function() {
                                $("tr.row_4 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-check text-success");
                                $(".resp_4").text("{{trans('library.index_blade.operation_successful_text')}}");
                                setTimeout(function() {
                                    $("tr.row_5 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-check text-success");
                                    $(".resp_5").text("{{trans('library.index_blade.operation_successful_text')}}");
                                    $(".load-data-spinner").show();
                                    
                                    setTimeout(function() {
                                        $(".load-data-spinner").hide();
                                        $(".load-data-table>tbody").append(table_data);
                                        $('tr.row_10')[0].scrollIntoView("slow");
                                        setTimeout(function() {
                                            $("tr.row_6 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-check text-success");
                                            $(".resp_6").text("{{trans('library.index_blade.operation_successful_text')}}");
                                            setTimeout(function() {
                                                $("tr.row_7 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-check text-success");
                                                $(".resp_7").text("{{trans('library.index_blade.operation_successful_text')}}");
                                                setTimeout(function() {
                                                    $("tr.row_8 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-check text-success");
                                                    $(".resp_8").text("{{trans('library.index_blade.operation_successful_text')}}");
                                                    setTimeout(function() {
                                                        $("tr.row_9 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-times text-danger");
                                                        $(".resp_9").text("{{trans('library.index_blade.operation_failed_text')}}");
                                                        $("tr.row_10 i.processings").removeClass("fa-spinner fa-spin").addClass("fa-exclamation-triangle text-warning");
                                                        $(".resp_10").text("{{trans('library.index_blade.operation_failed_text')}}");
                                                        $(".load-data-msg").css("display", "flex");
                                                        $(".popup-btn-close").show();
                                                        $(".cancel-processing").hide();
                                                        $(".processing-cancelled").hide();
                                                    }, 1000);
                                                }, 1000);
                                            }, 1000);
                                        }, 1000);
                                    }, 1500);
                                    
                                }, 1000);
                            }, 1000);
                        }, 1000);
                    }, 1000);
                }, 2000);
            }, 1000);
        });

        $("#btn-load-data").click(function() {
            $("#load-data").modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
        });
    });
</script>
<script type="text/html" id="files-template">
    <li class="media">
        <div class="media-body mb-1">
            <p class="mb-2">
                <strong class="filename">%%filename%%</strong>  <span class="text-muted">{{trans('app.dashboard.lang.waiting')}}</span>
            <div class="progress progress-striped">
                <div class="progress-bar progress-bar-success progress-bar-animated"
                     role="progressbar"
                     style="width: 0%"
                     aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                </div>
            </div>
            </p>
            <div class="la la-close font-red pull-right removeFile" data-file=""></div>
            <hr class="mt-1 mb-1" />
        </div>
    </li>
</script>

<script type="text/javascript">
    var token = "{{ csrf_token() }}";
    $(function(){
        $(document).on("click", ".removeFile", function() {
            var file_name = $(this).parent().children('p.mb-2').find('.filename').html();
            //var num = Math.random();
            //alert(num);
            var list_block_id = $(this).parent().parent().attr('id');
            //console.log(list_block);
            $.ajax({
                url: "{{ url('/') }}"+'/broadcasts/imgDel',
                type: "POST",
                data: {"_token": token, "file_name": file_name},
                success: function(result) {
                    if(result=='success'){
                        $("#"+list_block_id).remove();
                        $("#imgMsg").append("<li> "+ file_name+" {{trans('app.campaigns.broadcasts.add.successfully_moved')}} </li>");
                    }
                }
            });
        });
        $(document).on("click", ".removeFile2", function() {
            var file_name = $(this).parent().children('p.mb-2').find('.filename').html();
            //alert(file_name);
            //var num = Math.random();
            var list_block_id = $(this).parent().parent().attr('id');
            //alert(list_block_id);
            $.ajax({
                url: "{{ url('/') }}"+'/broadcasts/imgDel2',
                type: "POST",
                data: {"_token": token, "file_name": file_name, "campaign_id": $("#campaign-id").val()},
                success: function(result) {
                    if(result=='success'){
                        $("#"+list_block_id).remove();
                        $("#imgMsg").append("<li> "+ file_name+" {{trans('app.campaigns_broadcasts_add_successfully_moved')}} </li>");
                        return false;
                    }

                }
            });
        });
        $('#drag-and-drop-zone').dmUploader({ //
            url: app_url+'/broadcasts/multiupload?id='+$("#campaign-id").val(),
            maxFileSize: 3000000, // 3 Megs
            onDragEnter: function(){
                // Happens when dragging something over the DnD area
                this.addClass('active');
            },
            onDragLeave: function(){
                // Happens when dragging something OUT of the DnD area
                this.removeClass('active');
            },
            onInit: function(){
                // Plugin is ready to use
                ui_add_log('{{trans('app.campaigns.broadcasts.add.penguin_initialized')}}:)', 'info');
            },
            onComplete: function(){
                // All files in the queue are processed (success or error)
                ui_add_log('{{trans('app.campaigns.broadcasts.add.all_pending_transfers_finished')}}');
            },
            onNewFile: function(id, file){
                // When a new file is added using the file selector or the DnD area
                ui_add_log('{{trans('app.campaigns.broadcasts.add.new_file_added')}} #' + id);
                ui_multi_add_file(id, file);
            },
            onBeforeUpload: function(id){
                // about tho start uploading a file
                ui_add_log('{{trans('app.campaigns.broadcasts.add.starting_the_upload_of')}} #' + id);
                ui_multi_update_file_status(id, 'uploading', '{{trans('app.dashboard.lang.uploading')}}...');
                ui_multi_update_file_progress(id, 0, '', true);
            },
            onUploadCanceled: function(id) {
                // Happens when a file is directly canceled by the user.
                ui_multi_update_file_status(id, 'warning', '{{trans('app.campaigns.broadcasts.add.canceled_by_user')}}');
                ui_multi_update_file_progress(id, 0, 'warning', false);
            },
            onUploadProgress: function(id, percent){
                // Updating file progress
                ui_multi_update_file_progress(id, percent);
            },
            onUploadSuccess: function(id, data){
                // A file was successfully uploaded
                ui_add_log('{{trans('app.campaigns.broadcasts.add.server_response_for_file')}} #' + id + ': ' + JSON.stringify(data));
                ui_add_log('{{trans('app.campaigns.broadcasts.add.upload_of_file')}} #' + id + ' COMPLETED', 'success');
                ui_multi_update_file_status(id, 'success', '{{trans('app.campaigns.broadcasts.add.upload_complete')}}');
                ui_multi_update_file_progress(id, 100, 'success', false);
            },
            onUploadError: function(id, xhr, status, message){
                ui_multi_update_file_status(id, 'danger', message);
                ui_multi_update_file_progress(id, 0, 'danger', false);
            },
            onFallbackMode: function(){
                // When the browser doesn't support this plugin :(
                ui_add_log('{{trans('app.campaigns.broadcasts.add.plugin_cannot_be_used_here')}}', 'danger');
            },
            onFileSizeError: function(file){
                ui_add_log('{{trans('app.dashboard.lang.file')}} \'' + file.name + '\' {{trans('app.campaigns.broadcasts.add.cannot_be_added')}}: {{trans('app.campaigns.broadcasts.add.size_excess_limit')}}', 'danger');
            }
        })
    });
</script>
<script>
    function copy(id) {
        textarea = document.getElementById(id);
        textarea.select();
        document.execCommand("copy");
    toastr.success("{{trans('library.index_blade.data_response_copied_txt')}}", "{{trans('library.index_blade.response_copied_txt')}}");
    }    
    $(document).ready(function() {
        $('#import-id').on('change', function () {
            const import_id = document.getElementById("import-id");
            var filename = import_id.files[0] !== undefined && import_id.files[0].name;
            $("#importIdLabel").html(filename);
        });
        $('#datetimepicker-custom').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#datetimepicker').datetimepicker({
            todayHighlight: true,
            format: "dd MM yyyy - HH:ii P",
            showMeridian: true,
            todayHighlight: true,
            autoclose: true,
            //pickerPosition: 'bottom-right'
        });
        $('#library').dataTable({
            "aoColumnDefs": [{"bSortable": false, "aTargets": [0,8]}],
            "aaSorting": [[2, "asc"]],
            "sPaginationType": "full_numbers",
            "aLengthMenu": [[50, 100, 500], [50, 100, 500]]
        });

        $("#form").validate({
            ignore: [],       
              rules: {
                name: {
                    required: !0
                },
                email: {
                    required: !0,
                    email: !0,
                    minlength: 10 
                },
                password: {
                    required: !0,
                    minlength: 6
                },
                confirm_password: {
                    required: !0,
                    minlength: 6,
                    equalTo: "#password"
                },
            },
            invalidHandler: function(event, validator) {
                Command: toastr["error"] ("{{trans('library.index_blade.command_form_errors')}}"); 
                Command: toastr["warning"] ("{{trans('library.index_blade.command_form_errors')}}"); 
                Command: toastr["info"] ("{{trans('library.index_blade.command_form_errors')}}"); 
                Command: toastr["success"] ("{{trans('library.index_blade.command_form_errors')}}"); 
            },
            submitHandler: function(e) {
                $(".blockUI").show();
                setTimeout(function() {
                    $(".blockUI").hide();
                    Command: toastr["success"] ("{{trans('library.index_blade.command_successfully_submitted')}}");
                }, 1500);
                $("#form")[0].reset();
            }
        });
    });

    function checkSpamScore()
    {
        var content_html = CKEDITOR.instances['content_html'].getSnapshot();
        var subject = $("#subjectt").val();

        if(content_html == "<p><br></p>" || content_html == "" || content_html == "<br>"){
            alert('{{trans('app.campaigns.broadcasts.add.empty_html_contents')}}');
            return false;
        }
        if(subject == ""){
            alert('{{trans('app.campaigns.broadcasts.add.empty_subject_field')}}');
            return false;
        }

        $(".blockUI").show();

        $.ajax({
            url: "{{ url('/') }}"+'/broadcasts/spam/score',
            type: "POST",
            data: {content_html: content_html, subject: subject},
            success: function(result) {

                var obj = JSON.parse(result);

                if(obj.success == true){
                    $(".blockUI").hide();
                    $("#spam-score-modal").modal('show');
                    $('#statusss').html('Success');
                    $('#scoreee').html(obj.score);
                }
                else{
                    $(".blockUI").hide();
                    alert("{{trans('app.campaigns.broadcasts.add.alert_error')}}");
                }
            }
        });
    }

    $('#copy-email').click(function() {
        var content_html = CKEDITOR.instances['content_html'].getSnapshot();
        var content = content_html.replace(/<br\s*\/?>/mg,"\n");
        var regex = /(<([^>]+)>)/ig;
        var content = $.trim(content.replace(regex, ""));
        $('#content_text').val(content);
    });

    function selectTag(field, ckeditor_id) {
        if(field == 'Unsubscribe Link')
            field = '<a href="%%unsubscribelink%%">{{trans('app.dashboard.lang.unsubscribe')}}</a>';
        else if(field == 'Confirm Link')
            field = '<a href="%%confirmurl%%">{{trans('app.dashboard.lang.confirm')}}</a>';
        else if(field == 'web_version')
            field = '<a href="%%web_version%%">{{trans('app.campaigns.schedule.web_version')}}</a>';
        else
            field = '%%'+field+'%%';
        CKEDITOR.instances[ckeditor_id].insertHtml(field);
    }
    function selectSpintag(spintag, ckeditor_id) {
        spintag = '{'+'{'+spintag+'}'+'}';
        CKEDITOR.instances[ckeditor_id].insertText(spintag);
    }
    function selectDynamicContent(dynamic_content, ckeditor_id) {
        dynamic_content = dynamic_content;
        CKEDITOR.instances[ckeditor_id].insertText(dynamic_content);
    }
    $('#copy-email').click(function() {
        var content_html = CKEDITOR.instances['content_html'].getSnapshot();
        var content = content_html.replace(/<br\s*\/?>/mg,"\n");
        var regex = /(<([^>]+)>)/ig
        var content = $.trim(content.replace(regex, ""));
        $('#message').val(content);
    });
</script>
<script type="text/javascript">
    var KTFormRepeater = function() {
        var demo1 = function() {
            $('#kt_repeater_3').repeater({
                initEmpty: false,
               
                defaultValues: {
                    'text-input': 'foo'
                },
                 
                show: function() {
                    $(this).slideDown();                               
                },

                hide: function(deleteElement) {                 
                    if(confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                    }                                  
                }      
            });
        }
        return {
            init: function() {
                demo1();
            }
        };
    }();
    jQuery(document).ready(function() {
        KTFormRepeater.init();
    });
</script>
@endsection

@section('content')

<div id="kt_header" class="kt-header kt-grid__item library-header" style="z-index: 1;" data-name="zgLlQouz">
    <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
    <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper" data-name="wLRxikPa">
        <div id="kt_header_menu" class="kt-header-menu kt-header-menu-mobile  kt-header-menu--layout-default" data-name="qRqNYdWC">
            <ul class="kt-menu__nav repoBugTop">
                <li class="kt-menu__item  kt-menu__item--submenu kt-menu__item--rel kt-menu__item--active" data-ktmenu-submenu-toggle="click" aria-haspopup="true">
                    <a href="#modal-bug-report" data-toggle="modal" class="btn btn-label-info btn-sm btn-bold">
                        <span class="kt-menu__link-text">{{trans('library.index_blade.span_report_bug')}} </span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="kt-header__topbar" data-name="lqeJqeej">
        <div class="kt-header__topbar-item kt-header__topbar-item--time" data-name="ABBezZCd">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" data-name="cbsmiscA">
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--time">
                    <div style="display: none;" data-name="znbMatOD">
                        <span id="server-time-hour">+6</span>
                        <span id="server-time-minutes">+00</span>
                    </div>
                    <div class="ctime" data-name="XpOYeQvo">
                        <div class="clock" data-name="tLqLcbsg">
                            <div id="header_time2" data-name="jFWHeoJC">{{trans('library.index_blade.date_wed_feb')}} 12, 2020 06:38:32 PM</div>
                        </div>
                    </div>
                </span>
            </div>
        </div>
        <!--end: Timezone -->

        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="ClTIztRR">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="uGkJVZEa"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect id="bound" x="0" y="0" width="24" height="24"/>
                            <rect id="Rectangle-7" fill="#000000" x="4" y="4" width="4" height="4" rx="2"/>
                            <rect id="Rectangle-7-Copy-3" fill="#000000" x="4" y="10" width="4" height="4" rx="2"/>
                            <rect id="Rectangle-7-Copy" fill="#000000" x="10" y="4" width="4" height="4" rx="2"/>
                            <rect id="Rectangle-7-Copy-4" fill="#000000" x="10" y="10" width="4" height="4" rx="2"/>
                            <rect id="Rectangle-7-Copy-2" fill="#000000" x="16" y="4" width="4" height="4" rx="2"/>
                            <rect id="Rectangle-7-Copy-5" fill="#000000" x="16" y="10" width="4" height="4" rx="2"/>
                            <rect id="Rectangle-7-Copy-8" fill="#000000" x="4" y="16" width="4" height="4" rx="2"/>
                            <rect id="Rectangle-7-Copy-7" fill="#000000" x="10" y="16" width="4" height="4" rx="2"/>
                            <rect id="Rectangle-7-Copy-6" fill="#000000" x="16" y="16" width="4" height="4" rx="2"/>
                        </g>
                    </svg>
                </span> 
            </div>
            <!-- <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-account kt-hide" >
                <form>
                    <div class="tab-content top-imgBlk">
                        <div class="imgBlk">
                            <a href="https://one.mumara.com" target="_blank">
                                <img src="/public/img/one.png" />
                            </a>
                        </div>
                        <div class="imgBlk">
                            <a href="https://accounts.mumara.com/" target="_blank">
                                <img src="/public/img/accounts.png" />
                            </a>
                        </div>
                        <div class="imgBlk">
                            <a href="https://billing.mumara.com" target="_blank">
                                <img src="/public/img/mumara.png" />
                            </a>
                        </div>
                    </div>
                </form>
            </div> -->
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg quick-navigation" data-name="oXCxXTRn">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="CCOHlqbc">
                        <h3 class="kt-head__title">
                            {{trans('library.index_blade.quick_navigation_head')}} 
                        </h3> 
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="gYGXWSdj">
                        <div class="kt-notification" data-name="qpwtCqPE">

                            <div class="nav-icon-blk" data-name="wkMbiUlf">
                                <a href="https://accounts.mumara.com">
                                    <div class="imgBlk" data-name="xWnBUjOK">
                                        <img src="/public/img/accounts.png" />
                                    </div>
                                    <div class="kt-notification__item-details" data-name="rOWFIOoA">
                                        <div class="kt-notification__item-title" data-name="xuUyMrtQ"> {{trans('library.index_blade.txt_account')}}</div>
                                    </div>
                                </a>
                            </div>
                            
                            <div class="nav-icon-blk" data-name="pAyotEit">
                                <a href="https://one.mumara.com">
                                    <div class="imgBlk" data-name="qWxNrUKk">
                                        <img src="/public/img/one.png" />
                                    </div>
                                    <div class="kt-notification__item-details" data-name="hqdJSacJ">
                                        <div class="kt-notification__item-title" data-name="QaplljWl"> {{trans('library.index_blade.one_txt')}}</div>
                                    </div>
                                </a>
                            </div>
                                
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="wptJobGL">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="RyroWmiQ"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <img src="/public/img/gears.svg">
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" data-name="NrdASeYj">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="ogNJAxiO">
                        <h3 class="kt-head__title">
                           {{trans('library.index_blade.active_processes_head')}}  
                            <span class="kt-badge">2</span>
                        </h3>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" id="list-tab" data-name="glZFwukN">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250" data-name="pxLCxiHm">
                            <a href="javascript:;" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="EFkWnUIp">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="NroscVoH">
                                    <div class="kt-notification__item-title" data-name="qWmSWBLG"><b>{{trans('library.index_blade.running_campaign_txt')}}</b> <small> {{trans('library.index_blade.test_sam_thread')}} </small></div>
                                    <small>
                                        <div class="kt-notification__item-time" data-name="YYohacwm">
                                            3 {{trans('library.index_blade.div_weeks_ago')}}
                                        </div>
                                    </small>
                                </div>
                            </a>
                            <a href="javascript:;" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="KuKxaKnM">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="faHSaLmr">
                                    <div class="kt-notification__item-title" data-name="JwnmtZte"><b>{{trans('library.index_blade.running_campaign_txt')}}</b> <small> {{trans('library.index_blade.txt_thread_shahbaz')}} </small></div>
                                    <small>
                                        <div class="kt-notification__item-time" data-name="zMqMGcgF">
                                            3 {{trans('library.index_blade.div_weeks_ago')}}
                                        </div>
                                    </small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bottom-bar" data-name="pVLusnXf">
                        <a href="https://zone101-one.mumara.com/running-process" class="pull-left">{{trans('library.index_blade.action_view_all_pro')}}</a>
                        <a href="javascript:;" class="btn btn-label-info icon-close pull-right">{{trans('common.form.buttons.close')}}</a>
                    </div>
                </form>
            </div>
        </div>
        <!--end: Notifications -->
        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="bOAJuFYo">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="XFzTYUzV"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <i class="fab fa-cloudversify text-warning"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-246px, 64px, 0px);" data-name="HDCNDuEY">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="qbpJdbRS">
                        <h3 class="kt-head__title">
                           {{trans('library.index_blade.update_mumara_head')}} 
                        </h3> 
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="tnpIdmfG">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250" style="height: 265px; overflow: hidden;" data-name="mXinMZFW">
                            <div class="updateBlk" data-name="UxtziDbV">
                                <div class="row" data-name="izCDSdgS">
                                    <div class="col-md-6 versBlk" data-name="hpsuFIWm">
                                        <span class="nBlk alert-warning">
                                            <small>{{trans('library.index_blade.small_installed_version')}}</small>
                                            5.1.30
                                            <small>{{trans('library.index_blade.small_last_update')}}<br>05-07-2021</small>
                                        </span>
                                    </div>
                                    <div class="col-md-6 versBlk" data-name="GGaqCwTp">
                                        <span class="nBlk alert-success">
                                            <small>{{trans('library.index_blade.small_latest_version')}}</small>
                                            5.1.31
                                            <small>{{trans('library.index_blade.release_date_small')}}<br>28-06-2021</small>
                                        </span>
                                    </div>
                                </div>
                                <div class="updateBtn" data-name="wZVeVnau">
                                    <a href="/update">
                                        <button type="button" class="btn btn-success">{{trans('library.index_blade.button_update_now')}}</button>
                                    </a>
                                    <a href="javascript:;" id="logsAllBtn">{{trans('library.index_blade.action_complete_changelog')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="HHbHrZtt">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="wTMqfeSm"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <i class="flaticon2-list-3"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg intial-setup" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-246px, 64px, 0px);" data-name="HttbnBIT">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="DqyQxayQ">
                        <h3 class="kt-head__title">
                            Get Started
                        </h3> 
                        <div class="is-pb">
                            <div class="is-val">25%</div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content tab-is" data-name="LxlSmWBU">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-300" data-name="MyyRYAHH">
                            <!-- <div class="col-md-12 sidebar-setup-guide mt15" data-name="dEPGDDVe">
                                <h4>Complete the following basic steps to qualify for the first broadcast.</h4> 
                            </div> -->
                            <div class="col-md-12 setep_options" data-name="xHwScAaI">
                                <div class="setepOptions option1 done" data-name="vsypGxiE">
                                    <h3>
                                        <i class="fa fa-check"></i> <span class="option-title">Geoip Dependencies</span>
                                    </h3>
                                    <p class="paraSetup"> 
                                        <span>{{trans('common.label.download_geoip')}}</span>
                                        <button type="button" class="btn btn-info btn-sm mb1" id="download_dependencies">
                                            Geoip Dependencies
                                        </button>
                                        <span class="alert alert-danger mb0" id="geoipDownloadFailed">
                                            <span class="alert-text">License Verification Failed</span>
                                        </span>
                                    </p>
                                </div>
                                <div class="setepOptions option2 done" data-name="vsypGxiE">
                                    <h3><i class="fa fa-check"></i> <span class="option-title">Sending Domain</span></h3>
                                    <p class="paraSetup"> <span>Sending domain appears as the sender’s domain when your recipients receive emails. E.g if a person receives an email from joseph@letscommunicate.com, the sending domain is letscommunicate.com.</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts1" onclick="window.location.href = &quot;http://mumara-laravel.live/domain/add&quot;">Add Sending Domain</button>
                                    </p>
                                </div>
                                <div class="setepOptions option3" data-name="womxVYop">
                                    <h3><i class="fa fa-check"></i> <span class="option-title">Bounce Address</span></h3>
                                    <p class="paraSetup"> <span>Bounce address is the mailbox where Mumara Site sends delivery reports of the failed attempts.</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts2" onclick="window.location.href = &quot;http://mumara-laravel.live/bounce/mailbox/add&quot;">Add a Bounce Address</button>
                                    </p>
                                </div>
                                <div class="setepOptions option4" data-name="uXOokatr">
                                    <h3><i class="fa fa-check"></i> <span class="option-title">Sending Node</span></h3>
                                    <p class="paraSetup"> <span>Sending Node is your email courier and technically called an MTA. You can connect an SMTP or an ESP account from the supported providers.</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts3" onclick="window.location.href = &quot;http://mumara-laravel.live/node/list/view&quot;">Connect Sending Node</button>
                                    </p>
                                </div>
                                <div class="setepOptions option5" data-name="NmfRNrsR">
                                    <h3><i class="fa fa-check"></i> <span class="option-title">Contact List</span></h3>
                                    <p class="paraSetup"> <span>Create a contact list that can store your contacts/subscribers information.</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts4" onclick="window.location.href = &quot;http://mumara-laravel.live/list/add&quot;">Add Contact List</button>
                                    </p>
                                </div>
                                <div class="setepOptions option6" data-name="voXMgPUb">
                                    <h3><i class="fa fa-check"></i> <span class="option-title">Import Contacts</span></h3>
                                    <p class="paraSetup"> <span>Add/Import your contacts whom you want to send your first broadcast.</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts5" onclick="window.location.href = &quot;http://mumara-laravel.live/contact/add&quot;">Add a Contact</button>
                                        <button type="button" class="btn btn-info btn-sm" id="opts55" onclick="window.location.href = &quot;http://mumara-laravel.live/contacts/import&quot;">Import Contacts</button>
                                    </p>
                                </div>
                                <div class="setepOptions option7" data-name="bicVWiln">
                                    <h3><i class="fa fa-check"></i> <span class="option-title">Create First Broadcast</span></h3>
                                    <p class="paraSetup"> <span>broadcasts.note</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts6" onclick="window.location.href = &quot;http://mumara-laravel.live/broadcast/add&quot;">Add New Broadcast</button>
                                    </p>
                                </div>
                                <div class="setepOptions option8" data-name="JyjogRUW">
                                    <h3><i class="fa fa-check"></i> <span class="option-title">Schedule First Broadcast</span></h3>
                                    <p class="paraSetup"> <span>You’re doing excellent job so far. It’s the time now to schedule a broadcast and see how does it perform.</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts7" onclick="window.location.href = &quot;http://mumara-laravel.live/schedule/new&quot;">Schedule Broadcast</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="HHbHrZtt">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="wTMqfeSm"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <i class="flaticon2-list-3"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(-246px, 64px, 0px);" data-name="HttbnBIT">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="DqyQxayQ">
                        <h3 class="kt-head__title">
                            {{trans('library.index_blade.initial_setup_guide_heading')}} 
                        </h3> 
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="LxlSmWBU">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-300" data-name="MyyRYAHH">
                            <div class="col-md-12 sidebar-setup-guide mt15" data-name="dEPGDDVe">
                                <h4>{{trans('library.index_blade.heading_qualify_broadcast')}}</h4> 
                            </div>
                            <div class="col-md-12 setep_options" data-name="xHwScAaI">
                                <div class="setepOptions  done" data-name="vsypGxiE">
                                    <h3>2 -{{trans('library.index_blade.add_sending_domain_txt')}} <i class="la la-check"></i></h3>
                                    <div class="setupico" data-name="RmhIhZTD"> <i class="fa fa-angle-up upside"></i> <i class="fa fa-angle-down downside"></i> </div>
                                    <p class="paraSetup"> <span>{{trans('library.index_blade.span_sending_domain_appears')}}</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts1" onclick="window.location.href = &quot;http://mumara-laravel.live/domain/add&quot;">{{trans('library.index_blade.add_sending_domain_txt')}} </button>
                                    </p>
                                </div>
                                <div class="setepOptions option2  open" data-name="womxVYop">
                                    <h3>3 - {{trans('library.index_blade.button_bounce_address')}} <i class="la la-check"></i></h3>
                                    <div class="setupico" data-name="YAaipvfJ"> <i class="fa fa-angle-up upside"></i> <i class="fa fa-angle-down downside"></i> </div>
                                    <p class="paraSetup"> <span>{{trans('library.index_blade.span_bounce_address_mailbox')}}</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts2" onclick="window.location.href = &quot;http://mumara-laravel.live/bounce/mailbox/add&quot;">{{trans('library.index_blade.button_bounce_address')}}</button>
                                    </p>
                                </div>
                                <div class="setepOptions option3  done" data-name="uXOokatr">
                                    <h3>4 - {{trans('library.index_blade.button_connect_sending')}} <i class="la la-check"></i></h3>
                                    <div class="setupico" data-name="TXgUMYpq"> <i class="fa fa-angle-up upside"></i> <i class="fa fa-angle-down downside"></i> </div>
                                    <p class="paraSetup"> <span>{{trans('library.index_blade.span_sending_email_courier')}} </span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts3" onclick="window.location.href = &quot;http://mumara-laravel.live/node/list/view&quot;">{{trans('library.index_blade.button_connect_sending')}}</button>
                                    </p>
                                </div>
                                <div class="setepOptions option4  done" data-name="NmfRNrsR">
                                    <h3>5 - {{trans('library.index_blade.button_add_contact_list')}} <i class="la la-check"></i></h3>
                                    <div class="setupico" data-name="TsxkKnTC"> <i class="fa fa-angle-up upside"></i> <i class="fa fa-angle-down downside"></i> </div>
                                    <p class="paraSetup"> <span>Create a contact list that can store your contacts/subscribers information.</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts4" onclick="window.location.href = &quot;http://mumara-laravel.live/list/add&quot;">{{trans('library.index_blade.button_add_contact_list')}}</button>
                                    </p>
                                </div>
                                <div class="setepOptions option5  done" data-name="voXMgPUb">
                                    <h3>6 - {{trans('library.index_blade.import_contacts_txt')}} <i class="la la-check"></i></h3>
                                    <div class="setupico" data-name="wFmXejyU"> <i class="fa fa-angle-up upside"></i> <i class="fa fa-angle-down downside"></i> </div>
                                    <p class="paraSetup"> <span>{{trans('library.index_blade.span_add_contacts_broadcast')}}</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts5" onclick="window.location.href = &quot;http://mumara-laravel.live/contact/add&quot;">{{trans('library.index_blade.add_contact_para')}}</button>
                                        <button type="button" class="btn btn-info btn-sm" id="opts55" onclick="window.location.href = &quot;http://mumara-laravel.live/contacts/import&quot;">{{trans('library.index_blade.import_contacts_txt')}}</button>
                                    </p>
                                </div>
                                <div class="setepOptions option6  done" data-name="bicVWiln">
                                    <h3>7 - {{trans('library.index_blade.heading_first_broadcast')}}  <i class="la la-check"></i></h3>
                                    <div class="setupico" data-name="JUWgOetl"> <i class="fa fa-angle-up upside"></i> <i class="fa fa-angle-down downside"></i> </div>
                                    <p class="paraSetup"> <span>broadcasts.note</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts6" onclick="window.location.href = &quot;http://mumara-laravel.live/broadcast/add&quot;">{{trans('library.index_blade.button_add_new')}} </button>
                                    </p>
                                </div>
                                <div class="setepOptions option7  done" data-name="JyjogRUW">
                                    <h3>8 - Schedule Your First Broadcast  <i class="la la-check"></i></h3>
                                    <div class="setupico" data-name="WumWFqqN"> <i class="fa fa-angle-up upside"></i> <i class="fa fa-angle-down downside"></i> </div>
                                    <p class="paraSetup"> <span>{{trans('library.index_blade.span_doing_excellent_job')}}</span>
                                        <button type="button" class="btn btn-info btn-sm" id="opts7" onclick="window.location.href = &quot;http://mumara-laravel.live/schedule/new&quot;">{{trans('library.index_blade.button_schedule_broadcast')}}</button>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="kt-header__topbar-item dropdown top-all-notifications new-notifications" id="system_notifications" data-name="azieXdnF">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="zKeIqaHa"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <span class="new-notif"></span>
                    <i class="flaticon2-bell-1"></i> 
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg head-notification" data-name="OzAITXSk">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="silNzEkP">
                        <h3 class="kt-head__title">
                            <!-- <i class="flaticon2-bell-1"></i> -->
                            {{trans('library.index_blade.heading_notification')}} 
                            <span class="kt-badge" id="noti_count">5</span>
                        </h3> 
                        <a href="#" class="tnmar">{{trans('library.index_blade.mark_all_read_action')}}</a>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="DOPmTyrC">
                        <div id="notificationsBlk" class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-300" data-name="syJSnSuf">
                            <div class="kt-notification__item unread" data-name="JYGtYJDI">
                                <div class="kt-notification__item-icon" data-name="oGFgMqTq"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i> 
                                </div>
                                <div class="kt-notification__item-details" data-name="rJWbAUrH">
                                    <div class="kt-notification__item-title" data-name="ybuxWzUm"> {{trans('library.index_blade.div_contact_employees_list')}}  </div>
                                    <div class="kt-notification__item-time" data-name="ZwPwTUJf"> 17 {{trans('library.index_blade.div_seconds_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_view_con_list')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item unread" data-name="CHPwYbxB">
                                <div class="kt-notification__item-icon" data-name="bvklxJEG"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="FRIXOtmP">
                                    <div class="kt-notification__item-title" data-name="PIvDcAnz"> {{trans('library.index_blade.div_campaign_subscribers')}} </div>
                                    <div class="kt-notification__item-time" data-name="QomKKLWB"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="/storage/list.csv" download class="kt-links">{{trans('library.index_blade.action_download_file')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item unread" data-name="dkqdiRDz">
                                <div class="kt-notification__item-icon" data-name="cbTEvNwD"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="atxOsDGx">
                                    <div class="kt-notification__item-title" data-name="mqIQiRKb"> {{trans('library.index_blade.div_my_first_segment')}} </div>
                                    <div class="kt-notification__item-time" data-name="AFJsMZvl"> 3 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="/storage/segment.csv" download class="kt-links">{{trans('library.index_blade.action_download_file')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item unread" data-name="wmystMzf">
                                <div class="kt-notification__item-icon" data-name="jBYBFhyp"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="XyhmnBCA">
                                    <div class="kt-notification__item-title" data-name="BhFPiXeR"> {{trans('library.index_blade.div_segment_lahore')}} </div>
                                    <div class="kt-notification__item-time" data-name="aLVPOCQH"> 17 {{trans('library.index_blade.div_seconds_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_segmented_contacts')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item unread" data-name="pCfhjCCD">
                                <div class="kt-notification__item-icon" data-name="BTqqQnkR"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="gZGyTNkY">
                                    <div class="kt-notification__item-title" data-name="gGbhHwpl"> {{trans('library.index_blade.div_broadcast_finished')}} </div>
                                    <div class="kt-notification__item-time" data-name="kpeUFlKa"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_statistics')}}</a>
                                </div>
                            </div>

                            <div class="kt-notification__item" data-name="hWrpeJpq">
                                <div class="kt-notification__item-icon" data-name="KpnYHmRH"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="oLxMoYAZ">
                                    <div class="kt-notification__item-title" data-name="VhVVPCIa"> {{trans('library.index_blade.div_scheduled_broadcast')}} </div>
                                    <div class="kt-notification__item-time" data-name="eDeItdMQ"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_go_to_statistics')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item" data-name="IDKVfbSf">
                                <div class="kt-notification__item-icon" data-name="cXZDxnsd"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="amjtlJDt">
                                    <div class="kt-notification__item-title" data-name="GtzLgAiX"> {{trans('library.index_blade.div_independence_day')}} </div>
                                    <div class="kt-notification__item-time" data-name="dnmyWjKq"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_view_broadcasts')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item" data-name="BfAzUzaY">
                                <div class="kt-notification__item-icon" data-name="RoZNwHja"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="LiizjLaR">
                                    <div class="kt-notification__item-title" data-name="skvXMlzp"> {{trans('library.index_blade.div_discount_promo')}} </div>
                                    <div class="kt-notification__item-time" data-name="cjuKkddi"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_view_broadcasts')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item" data-name="BsXLmvWF">
                                <div class="kt-notification__item-icon" data-name="UQUDoFGw"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="UGiQrixQ">
                                    <div class="kt-notification__item-title" data-name="AggphdUA"> {{trans('library.index_blade.div_broadcast_black_friday_promo')}}  </div>
                                    <div class="kt-notification__item-time" data-name="oOkYpPnh"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_view_broadcasts')}}</a>
                                </div>
                            </div>

                            <div class="kt-notification__item" data-name="fRIZPPVc">
                                <div class="kt-notification__item-icon" data-name="YccxQgMe"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="RhsGkrJc">
                                    <div class="kt-notification__item-title" data-name="FEyEQqZU"> {{trans('library.index_blade.div_broadcast_black_friday')}}  </div>
                                    <div class="kt-notification__item-time" data-name="WxjzGxxu"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_view_broadcasts')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item" data-name="bwbbbjGB">
                                <div class="kt-notification__item-icon" data-name="YUbPlYjy"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="JOurUPbc">
                                    <div class="kt-notification__item-title" data-name="xVmyfRFv"> {{trans('library.index_blade.div_sendgrid_smtp')}} </div>
                                    <div class="kt-notification__item-time" data-name="wjCnwMGU"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="javascript:;" class="kt-links">{{trans('library.index_blade.action_sending_node')}}</a>
                                </div>
                            </div>
                            <div class="kt-notification__item" data-name="fTANYePv">
                                <div class="kt-notification__item-icon" data-name="TkyCIBBQ"> 
                                    <i class="fa fa-circle kt-font-success popovers notif-read" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as Read" data-original-title="{{trans('common.description')}}"></i> 
                                    <i class="fa fa-circle-notch kt-font-success popovers notif-unread" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="top" data-content="Mark as unread" data-original-title="{{trans('common.description')}}"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="sWjSflpH">
                                    <div class="kt-notification__item-title" data-name="dScpnpyA"> {{trans('library.index_blade.div_actions_triggers')}} </div>
                                    <div class="kt-notification__item-time" data-name="mDngkcqr"> 1 {{trans('library.index_blade.div_hour_before')}} </div>
                                    <a href="javascript:;" class="kt-links"> {{trans('library.index_blade.action_trigger_statistics')}} </a>
                                </div>
                            </div>
                            <div class="data-processing" data-name="wDrkYsKU">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-bar" data-name="sayzWNpy">
                        <a href="javascript:;" class="pull-left">{{trans('library.index_blade.view_all_action')}}</a>
                        <a href="javascript:;" class="btn btn-label-info icon-close pull-right dd-close">{{trans('common.form.buttons.close')}}</a>
                    </div>
                </form>
            </div>
        </div>

        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="FOWUsLas">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="bYtasbEF"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand issue-icon">
                    <span class="new-notif"></span>
                    <i class="fa fa-exclamation-triangle"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg issue-notification" data-name="VRKZMxQj">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="mfsNrfGR">
                        <h3 class="kt-head__title">
                            Issues 
                            <span class="kt-badge">3</span>
                        </h3> 
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="KvcOrgAW">
                        <div id="issuesBlk" class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-300" data-name="AAYSTZCF">
                            <a href="#" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="NCXhoCke"> <i class="flaticon2-cancel kt-font-warning"></i> </div>
                                <div class="kt-notification__item-details" data-name="ELTdLNJY">
                                    <div class="kt-notification__item-title" data-name="lteLcHWI"> <b>{{trans('library.index_blade.div_curl_error')}} 6:</b> {{trans('library.index_blade.div_not_resolve_host')}} https://curl.haxx.se/libcurl/c/libcurl-errors.html) </div>
                                    <div class="kt-notification__item-time" data-name="QgeVkyQA"> Last Checked Nov 28, 2020 04:52:59 AM </div>
                                    <button type="button" id="1" class="btn btn-success btn-xs resolve-btn">{{trans('library.index_blade.button_mark_resolved')}}</button>
                                </div>
                            </a>
                            <a href="#" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="gyzfpyWE"> <i class="flaticon2-cancel kt-font-warning"></i> </div>
                                <div class="kt-notification__item-details" data-name="FGbCmPKA">
                                    <div class="kt-notification__item-title" data-name="sVhYRABg"> <b>{{trans('library.index_blade.div_curl_error')}} 5:</b> {{trans('library.index_blade.div_not_resolve_host')}} https://curl.haxx.se/libcurl/c/libcurl-errors.html) </div>
                                    <div class="kt-notification__item-time" data-name="SUhxLblP"> Last Checked Nov 19, 2020 11:21:33 PM </div>
                                    <button type="button" id="1" class="btn btn-success btn-xs resolve-btn">{{trans('library.index_blade.button_mark_resolved')}}</button>
                                </div>
                            </a>
                            <a href="#" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="tQwppINR"> <i class="flaticon2-cancel kt-font-warning"></i> </div>
                                <div class="kt-notification__item-details" data-name="HAzZDHrm">
                                    <div class="kt-notification__item-title" data-name="xcjUhexn"> <b>{{trans('library.index_blade.div_curl_error')}} 4:</b> {{trans('library.index_blade.div_not_resolve_host')}} https://curl.haxx.se/libcurl/c/libcurl-errors.html) </div>
                                    <div class="kt-notification__item-time" data-name="immtMKAm"> Last Checked Nov 08, 2020 10:37:17 AM </div>
                                    <button type="button" id="1" class="btn btn-success btn-xs resolve-btn">{{trans('library.index_blade.button_mark_resolved')}}</button>
                                </div>
                            </a>
                            <div class="data-processing" data-name="QawsAFhh">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-bar" data-name="DWkgPctz">
                        <a href="javascript:;" class="pull-left">{{trans('library.index_blade.view_all_action')}}</a>
                        <a href="javascript:;" class="btn btn-label-info icon-close pull-right dd-close">{{trans('common.form.buttons.close')}}</a>
                    </div>
                </form>
            </div>
        </div>

        <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="ZhylSaGT">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="SnTDjmWI"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <span class="new-notif"></span>
                    <i class="flaticon2-gear fa-spin text-success font-21"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg cr-process" data-name="JWyKcCNT">
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="tHpjsdmw">
                        <h3 class="kt-head__title">
                            {{trans('library.index_blade.currently_running_pro_heading')}} 
                            <span class="kt-badge">2</span>
                        </h3>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" id="list-tab" data-name="ickWejRG">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250" data-name="DMTKHzJu">
                            <a href="javascript:;" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="dhFlsUqi">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="RejSTqXy">
                                    <div class="kt-notification__item-title" data-name="jTBizdKi"><b>{{trans('library.index_blade.running_campaign_txt')}}</b> <small> {{trans('library.index_blade.test_sam_thread')}} </small></div>
                                    <small>
                                        <div class="kt-notification__item-time" data-name="mAHVLgrt">
                                            3 {{trans('library.index_blade.div_weeks_ago')}}
                                        </div>
                                    </small>
                                </div>
                            </a>
                            <a href="javascript:;" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="ElACYYAO">
                                    <i class="fa fa-spinner fa-spin"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="XaRCdMei">
                                    <div class="kt-notification__item-title" data-name="aqGWakmi"><b>{{trans('library.index_blade.running_campaign_txt')}}</b> <small> {{trans('library.index_blade.txt_thread_shahbaz')}} </small></div>
                                    <small>
                                        <div class="kt-notification__item-time" data-name="pVLkuxLt">
                                            3 {{trans('library.index_blade.div_weeks_ago')}}
                                        </div>
                                    </small>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bottom-bar" data-name="vyHNNQGM">
                        <a href="https://zone101-one.mumara.com/running-process" class="pull-left">{{trans('library.index_blade.action_view_process')}} </a>
                        <a href="javascript:;" class="btn btn-label-info icon-close pull-right">{{trans('common.form.buttons.close')}}</a>
                    </div>
                </form>
            </div>
        </div>
        <!--end: Notifications -->
        <!--begin: Notifications -->
        <div class="kt-header__topbar-item dropdown top-all-issues new-notifications" data-name="FHWDTYBI">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="30px,0px" aria-expanded="false" data-name="pAKAJyKM"> 
                <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                    <span class="new-notif"></span>
                    <i class="la la-cloud-download font-25"></i>
                </span> 
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-lg download-export" data-name="eIbbbbLS" >
                <form>
                    <!--begin: Head -->
                    <div class="kt-head kt-head--skin-dark kt-head--fit-x kt-head--fit-b" data-name="EgAOhjGl">
                        <h3 class="kt-head__title">
                           {{trans('library.index_blade.heading_download_exported_files')}} 
                            <span class="kt-badge">3</span>
                        </h3>
                    </div>
                    <!--end: Head -->
                    <div class="tab-content" data-name="mlcmUvkH">
                        <div class="kt-notification kt-margin-t-10 kt-margin-b-10 scroll scroll-250" data-name="ejFhzPqS">
                            <a href="http://mumara-laravel.live/list/export/download/csv/17" onclick="changeImportStatus(17)" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="NNoajOJG">
                                    <i class="la la-cloud-download font-25"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="KoYoXefK">
                                    <div class="kt-notification__item-title" data-name="iYrjgRGh">
                                        <b>{{trans('library.index_blade.my_contact_list_txt')}}</b>
                                    </div>
                                    <div class="kt-notification__item-time" data-name="rkjhsOcu">
                                        6 {{trans('library.index_blade.div_seconds_ago')}}
                                    </div>
                                </div>
                            </a>
                            <a href="http://mumara-laravel.live/list/export/download/csv/17" onclick="changeImportStatus(17)" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="DxaNSSOg">
                                    <i class="la la-cloud-download font-25"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="bHcYYWft">
                                    <div class="kt-notification__item-title" data-name="RJqwhEAn">
                                        <b>{{trans('library.index_blade.my_contact_list_txt')}} 2</b>
                                    </div>
                                    <div class="kt-notification__item-time" data-name="jzRIxbNe">
                                        10 {{trans('library.index_blade.div_days_ago')}}
                                    </div>
                                </div>
                            </a>
                            <a href="http://mumara-laravel.live/list/export/download/csv/17" onclick="changeImportStatus(17)" class="kt-notification__item">
                                <div class="kt-notification__item-icon" data-name="brQheeuS">
                                    <i class="la la-cloud-download font-25"></i>
                                </div>
                                <div class="kt-notification__item-details" data-name="RApMSSse">
                                    <div class="kt-notification__item-title" data-name="nUltvnoY">
                                        <b>{{trans('library.index_blade.my_contact_list_txt')}} 3</b>
                                    </div>
                                    <div class="kt-notification__item-time" data-name="DgjHzalc">
                                        2 {{trans('library.index_blade.div_days_ago')}}
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="bottom-bar" data-name="DzVgSDZH">
                        <a href="javascript:;" onclick="clearAllExports();" class="text-danger icon-close pull-left">{{trans('library.index_blade.action_trash_records')}}</a>
                        <a href="javascript:;" class="btn btn-label-info icon-close pull-right">{{trans('common.form.buttons.close')}}</a>
                    </div>
                </form>
            </div>
        </div>
        <!--end: Notifications -->

        <!--begin: Notifications -->
        <div class="kt-header__topbar-item kt-header__topbar-item--links" data-name="zFvxtVUb">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="10px,0px" aria-expanded="false" data-name="RKlpPiOc">
                <span class="kt-header__topbar-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                            <path d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                            <path d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z" id="Combined-Shape" fill="#000000"></path>
                        </g>
                    </svg> <span class="kt-pulse__ring"></span>
                </span>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround" x-placement="bottom-end" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(1146px, 64px, 0px);" data-name="eGqMJdnn">
                <ul class="kt-nav kt-margin-t-10 kt-margin-b-10">
                    <li class="kt-nav__item">
                        <a href="https://help.mumara.com/hc/en-us" class="kt-nav__link" target="_blank">
                            <span class="kt-nav__link-icon">
                                <i class="la la-book"></i></span>
                            <span class="kt-nav__link-text">{{trans('library.index_blade.span_knowledge_base')}}</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="https://community.mumara.com/" target="_blank" class="kt-nav__link">
                            <span class="kt-nav__link-icon">
                                <i class="la la-comments"></i>
                            </span>
                            <span class="kt-nav__link-text">{{trans('library.index_blade.span_community_support')}} </span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="https://community.mumara.com/forums/feature-request.14/" class="kt-nav__link">
                            <span class="kt-nav__link-icon">
                                <i class="la la-edit"></i>
                            </span>
                            <span class="kt-nav__link-text">{{trans('library.index_blade.span_feature_req')}}</span>
                        </a>
                    </li>
                    <li class="kt-nav__item">
                        <a href="https://community.mumara.com/forums/bug-reporting.15/" class="kt-nav__link">
                            <span class="kt-nav__link-icon">
                                <i class="la la-pencil"></i>
                            </span>
                            <span class="kt-nav__link-text">{{trans('library.index_blade.span_report_bug')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!--end: Notifications -->

        <!--begin: Quick panel toggler -->
        <div class="kt-header__topbar-item kt-header__topbar-item--quick-panel kt-hide" data-toggle="kt-tooltip" id="bellIcon" title="" data-placement="right" data-original-title="Notifications" data-name="DokQNvaA">
            <span class="kt-header__topbar-icon" id="kt_quick_panel_toggler_btn">
                <i class="showDotNotification fa fa-circle text-danger" style="display: none;"></i>
                <span class="kt-badge" id="notifCount" style="">2</span>
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect id="bound" x="0" y="0" width="24" height="24"></rect>
                        <rect id="Rectangle-7" fill="#000000" x="4" y="4" width="7" height="7" rx="1.5"></rect>
                        <path d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z" id="Combined-Shape" fill="#000000" opacity="0.3"></path>
                    </g>
                </svg> 
            </span>
        </div>
        <!--end: Quick panel toggler -->
        <!--begin: User Bar -->
        <div class="kt-header__topbar-item kt-header__topbar-item--user" data-name="dGMmcmqb">
            <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px" aria-expanded="false" data-name="nVkQkiQE">

                <div class="kt-header__topbar-icon cursor-pointer symbol symbol-30px symbol-md-40px" data-name="zeTOXDBR">
                    <img class="" alt="Pic" src="/public/img/user.png">

                <div class="kt-header__topbar-user" data-name="zeTOXDBR">
                    <span class="kt-header__topbar-welcome kt-hidden-mobile">{{trans('library.index_blade.hi_span_txt')}},</span>
                    <span class="kt-header__topbar-username kt-hidden-mobile">{{trans('library.index_blade.span_libreria')}}</span>

                    <!--use below badge element instead the user avatar to display username's first letter(remove kt-hidden class to display it) -->
                    <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold  text-uppercase">L</span>

                </div>
            </div>
            <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl" x-placement="bottom-end" style="position: absolute; transform: translate3d(1203px, 64px, 0px); top: 0px; left: 0px; will-change: transform;" data-name="IWRqSnYW">
                <!--begin: Head -->
                <div class="menu-content d-flex align-items-center menu-item" data-name="HivDYYIH">
                    <div class="kt-user-card__avatar symbol symbol-50px me-5" data-name="PAJCSeYA">
                        <img class="" alt="Pic" src="/public/img/user.png">
                    </div>

                    <div class="d-flex flex-column">
                      <div class="d-flex align-items-center user-name">Wasif Ahmed</div>
                      <a href="#" class="text-muted text-hover-primary user-email">admin@mumara.com</a> 
                    </div>
                </div>
                <div class="separator my-2"></div>
                <div class="menu-item px-5">
                    <a href="{{ url('subscription') }}" class="menu-link px-5 popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="left" data-content="{{trans('Learn about your current plan')}}"> <i class="fa fa-dollar-sign"></i> {{trans('Subscription')}}</a>
                </div>
                <div class="menu-item px-5">
                    <a href="https://billing.mumara.com/clientarea.php?action=invoices" class="menu-link px-5 popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="left" data-content="{{trans('Go to your billing area')}}"> <i class="fa fa-file-invoice"></i> {{trans('Billing')}}</a>
                </div>
                <div class="menu-item px-5"> 
                    <a href="/preferences" class="menu-link px-5 popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="left" data-content="Control the notifications that you want to receive"> <i class="fa fa-envelope"></i> Preferences</a>
                </div>
                <div class="menu-item px-5"> 
                    <a href="/profile/2" class="menu-link px-5 popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="left" data-content="View or update your profile information"> <i class="fa fa-user-circle"></i> My Profile</a>

                    <div class="kt-user-card__name" data-name="RMnXezfF">
                        {{trans('library.index_blade.shahbaz_nam')}} 
                    </div>
                </div>
                <!--end: Head -->
                <!--begin: Navigation -->
                <div class="kt-notification" data-name="YzDcTufD">
                    <a href="http://mumara-laravel.live/profile/2" class="kt-notification__item">
                        <div class="kt-notification__item-icon" data-name="mYYhKShN">
                            <i class="flaticon2-calendar-3 kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details" data-name="urNRwXDx">
                            <div class="kt-notification__item-title kt-font-bold" data-name="PcJVgnAx">
                               {{trans('library.index_blade.div_my_profile')}}  
                            </div>
                            <div class="kt-notification__item-time" data-name="kgVMHbog">
                               {{trans('library.index_blade.div_account_settings')}}  
                            </div>
                        </div>
                    </a>
                    <a href="javascript:;" class="kt-notification__item">
                        <div class="kt-notification__item-icon" data-name="uQFJAQYU">
                            <i class="flaticon2-gear kt-font-success"></i>
                        </div>
                        <div class="kt-notification__item-details" data-name="xGazPOgN">
                            <div class="kt-notification__item-title kt-font-bold" data-name="TppmfSdE">
                            {{trans('library.index_blade.settings_div')}} 
                            </div>
                            <div class="kt-notification__item-time" data-name="rQIKJCTs">
                                {{trans('library.index_blade.div_view_update_setting')}} 
                            </div>
                        </div>
                    </a>
                    <a href="http://mumara-laravel.live/account/security" class="kt-notification__item">
                        <div class="kt-notification__item-icon" data-name="yBGvarxz">
                            <i class="fa fa-shield-alt"></i>
                        </div>
                        <div class="kt-notification__item-details" data-name="nBhBVhJX">
                            <div class="kt-notification__item-title kt-font-bold" data-name="xjEddCkp">
                               {{trans('library.index_blade.security_txt')}}
                            </div>
                            <div class="kt-notification__item-time" data-name="lILJJsyr">
                                {{trans('library.index_blade.div_check_account_security')}} 
                            </div>
                        </div>
                    </a>
                    <div class="kt-notification__custom" data-name="jImXxGwl">
                        <a href="http://mumara-laravel.live/logout" class="btn btn-label-brand btn-sm btn-bold" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{trans('common.session.logout')}}  
                        </a>
                        <form id="logout-form" action="http://mumara-laravel.live/logout" method="POST" style="display: none;">
                            <input type="hidden" name="_token" value="L2syGMT6hjjkz5bRbT7MUBAkRjqPY0NSCtMPLWEF">
                            <input type="hidden" name="user_name" value="Librería Saturno">
                            <input type="hidden" name="user_id" value="2">
                        </form>
                    </div>

                </div>
                <div class="menu-item px-5"> 
                    <a href="/account/security" class="menu-link px-5 popovers" data-html="true" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="left" data-content="Check account security or change password"> <i class="fa fa-shield-alt"></i> Security</a>
                </div>
                <div class="separator my-2"></div>
                <div class="menu-item2 px-5">
                    <a href="/logout" class="btn btn-brand btn-sm btn-bold btn-signout">Logout</a>
                </div>
                <!-- <div class="menu-item px-5"> <a href="/logout" class="menu-link px-5">Logout </a> </div> -->
            </div>
        </div>
    </div>
</div>

<div class="kt-space-20" data-name="ZsnKNIQM"></div>

<script src="/js/libs/ckeditor/ckeditor.js"></script>
<script src="/js/libs/ckeditor/plugins/font/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/colorbutton/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/zsuploader/plugin.js"></script>
<script src="/js/libs/ckeditor/plugins/smiley/plugin.js"></script>
<script src="/js/libs/ckfinder/ckfinder.js"></script>

<div class="row" data-name="cXiEVhgj">
    <div class="col-md-12" data-name="IETBqmlX">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <div class="kt-portlet kt-portlet--height-fluid" data-name="BBCJHCSJ">
            <div class="kt-portlet__body" data-name="DjyoKRFd">
                <div class="table-toolbar" data-name="snaQEfOK">
                    <div class="form-group row" data-name="qBBUwvOS">
                        <div class="col-md-12" data-name="qtFqZQlJ">
                            @if (rolePermission(54) || rolePermission(16))
                            <div class="btn-group" data-name="DDGDjpqS">
                                <a href="">
                                <button id="sample_editable_1_new" class="btn btn-label-success">
                                    <i class="la la-plus"></i> {{trans('common.form.buttons.add_new')}}
                                </button></a>
                                
                            </div>
                            @endif
                            <button id="btn-load-data" data-toggle="modal" class="btn btn-label-success">
                              {{trans('library.index_blade.button_load_data')}}
                            </button>
                            <div class="btn-group pull-right" data-name="qUpROunG">
                                <button class="btn btn-label-info dropdown-toggle" data-toggle="dropdown">
                                    {{trans('common.form.buttons.tools')}}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-right">
                                @if (rolePermission(58) || 1)
                                    <li>
                                        <a href="javascript:;" onclick="deleteAll();" class=""> <i class="la la-close"></i> {{trans('common.form.buttons.delete')}}  </a>
                                    </li>
                                @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-checkable responsive" id="library" role="grid" >
                    <thead>
                        <tr role="row">
                            <th style="width: 25px;">
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkboxes checkbox-all-index">
                                    <span></span>
                                </label>
                            </th>
                            <th>{{trans('library.index_blade.th_contact')}}</th>
                            <th>{{trans('library.index_blade.country_label')}}</th>
                            <th>{{trans('library.index_blade.label_list')}}</th>
                            <th>{{trans('library.index_blade.th_added_on')}}</th>
                            <th>{{trans('common.stats.bounced')}}</th>
                            <th>{{trans('common.stats.unsubscribed')}}</th>
                            <th>{{trans('common.confirmed')}}</th>
                            <th>{{trans('common.label.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index">
                                    <span></span>
                                 </label>
                            </td>
                            <td>
                                <div class="kt-user-card-v2" data-name="xhlxyyXh">
                                    <div class="kt-user-card-v2__pic" data-name="vjiDDAoD">
                                        <div class="kt-user-card-v2__pic" data-name="TRMnjbtY">
                                        <div class="kt-badge kt-badge--xl kt-badge--primary" data-name="HoqWmBNQ">S</div>
                                    </div>
                                    </div>
                                    <div class="kt-user-card-v2__details" data-name="AZxFWRUQ">
                                        <span class="kt-user-card-v2__name">{{trans('library.index_blade.shahbaz_nam')}}</span>
                                        <span class="kt-user-card-v2__desc kt-link">shahbazhh01@gmail.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>{{trans('library.index_blade.label_pakistan')}}</td>
                            <td>
                                <a href="javascript:;">{{trans('library.index_blade.mumara_leads_label')}}</a>
                            </td>
                            <td>Dec 23, 2019 06:23:20 PM</td>
                            <td>
                                <span class="kt-font-bold kt-font-danger">{{trans('library.index_blade.span_hard_bounced')}}</span>
                            </td>
                            <td>
                                <span class="kt-font-bold kt-font-warning">{{trans('common.stats.unsubscribed')}}</span>
                            </td>
                            <td>
                                <span class="kt-font-bold kt-font-success">{{trans('common.confirmed')}}</span>
                            </td>
                            <td>
                                <div class="dropdown" data-name="ttPJIbuG">
                                    <a class="btn btn-label-success btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-expanded="false"><i class="flaticon-more-1"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li>
                                          <a href="javascript:;" data-toggle="modal" data-target="#modal-subscriber-details"> <i class="la la-eye"></i> {{trans('library.index_blade.contact_details_action')}}</a>
                                        </li>
                                        <li> 
                                            <a href="javascript:;"> <i class="la la-clock-o"></i> {{trans('library.index_blade.email_history_action')}}</a>
                                        </li>
                                        <li> 
                                            <a href="javascript:;"> <i class="la la-edit"></i> {{trans('library.index_blade.edit_action')}}</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" id="custom-field-delete" data-toggle="modal" data-target="#deleteMe"> <i class="la la-close"></i> {{trans('library.index_blade.delete_action')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label class="kt-checkbox kt-checkbox--single kt-checkbox--all kt-checkbox--solid">
                                    <input type="checkbox" class="checkbox-index">
                                    <span></span>
                                 </label>
                            </td>
                            <td>
                                <div class="kt-user-card-v2" data-name="JLTaEyJS">
                                    <div class="kt-user-card-v2__pic" data-name="XJPaduam">
                                        <div class="kt-badge kt-badge--xl kt-badge--primary" data-name="RhSHzRRt">S</div>
                                    </div>
                                    <div class="kt-user-card-v2__details" data-name="GHUPomEj">
                                        <span class="kt-user-card-v2__name">{{trans('library.index_blade.shahbaz_nam')}}</span>
                                        <span class="kt-user-card-v2__desc kt-link">shahbaz.mughal@hostingshouse.com</span>
                                    </div>
                                </div>
                            </td>
                            <td>Pakistan</td>
                            <td>
                                <a href="javascript:;"> {{trans('library.index_blade.mumara_leads_label')}}</a>
                            </td>
                            <td>Dec 23, 2019 06:23:19 PM</td>
                            <td>
                                <span class="kt-font-bold kt-font-warning">{{trans('library.index_blade.span_soft_bounced')}} </span>
                            </td>
                            <td>
                                <span class="kt-font-bold">{{trans('common.no')}}</span>
                            </td>
                            <td>
                                {{trans('common.no')}}
                            </td>
                            <td>
                                <div class="dropdown" data-name="DLtpifhv">
                                    <a class="btn btn-label-success btn-icon btn-sm btn-icon-md" data-toggle="dropdown" aria-expanded="false"><i class="flaticon-more-1"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li>
                                          <a href="javascript:;" data-toggle="modal" data-target="#modal-subscriber-details"> <i class="la la-eye"></i>{{trans('library.index_blade.contact_details_action')}} </a>
                                        </li>
                                        <li> 
                                            <a href="javascript:;"> <i class="la la-clock-o"></i>{{trans('library.index_blade.email_history_action')}}</a>
                                        </li>
                                        <li> 
                                            <a href="javascript:;"> <i class="la la-edit"></i>{{trans('library.index_blade.edit_action')}}</a>
                                        </li>
                                        <li>
                                            <a href="javascript:;" id="custom-field-delete" data-toggle="modal" data-target="#deleteMe"> <i class="la la-close"></i>  {{trans('library.index_blade.delete_action')}}</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<div class="row" data-name="JvJTMSbW">
    <div class="col-md-12" data-name="xteBESlD">
        <!-- BEGIN EXAMPLE TABLE PORTLET-->
        <form action="" method="POST"  id="form" class="kt-form kt-form--label-right">
            <div class="kt-portlet kt-portlet--height-fluid" data-name="RkMmDPvG">
                <div class="kt-portlet__head" data-name="ygItSOdg">
                    <div class="kt-portlet__head-label" data-name="YbCMPCLF">
                        <h3 class="kt-portlet__head-title">
                            {{trans('library.index_blade.heading_form_elements')}} 
                        </h3>
                    </div>
                </div>
                <div class="kt-portlet__body" data-name="yjbGQViO">
                    <div class="form-body" data-name="nAkoPAeg">
                        <div class="form-group row" data-name="bDEAjQWm">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.label_status')}} 
                            </label>
                            <div class="col-md-6" data-name="jXGkWiZo">
                                <span class="kt-switch kt-switch--outline kt-switch--icon kt-switch--success">
                                    <label>
                                        <input type="checkbox" name="trigger_status">
                                        <span></span>
                                    </label>
                                </span>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Mumara Library Status" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="bDEAjQW4">
                            <label class="col-form-label col-md-3">Update Avatar
                            </label>
                            <div class="col-md-6" data-name="jXGkWiZ9">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload" class="uload-icon"><i class="fa fa-pencil-alt" ></i></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('/public/img/user.png');">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="epNKSzeq">
                            <label class="col-form-label col-md-3">{{trans('common.label.group')}}
                                <span class="required"> * </span>
                                <span data-toggle="tooltip" title="Add New Group">
                                    <a href="javascript:;" data-toggle="modal" data-target="#modal-group-label"><i class="fa fa-plus-square fa-fw"></i></a>
                                </span>
                            </label>
                            <div class="col-md-6" data-name="PrJBUNSL">
                                <select class="form-control m-select2" name="group_id" id="group-id" data-placeholder="Choose Group">
                                    <option value="">{{trans('library.index_blade.select_choose_group')}} </option>
                                    <option value="1" >{{trans('common.label.group')}} One</option>
                                    <option value="2" >{{trans('common.label.group')}} Two</option>
                                    <option value="3" >{{trans('common.label.group')}} Three</option>
                                    <option value="4" >{{trans('common.label.group')}} Four</option>
                                    <option value="5" >{{trans('common.label.group')}} Five</option>
                                    <option value="6" >{{trans('common.label.group')}} Six</option>
                                </select>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Select campaign group name here." data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="saEONHRk">
                            <label class="col-form-label col-md-3"></label>
                            <div class="col-md-6" data-name="XJSWJBQf">
                                <div class="lshapeBlk" data-name="aSyFCRjL"><i class="la la-level-down lshap"></i></div>
                                <div class="lshBlksl" data-name="RFGApEBl">
                                    <select class="form-control m-select2" data-placeholder="Choose options" name="options">
                                        <option value="">{{trans('library.index_blade.select_choose_option')}}</option>
                                        <option value="1" >{{trans('library.index_blade.select_option_one')}}</option>
                                        <option value="2" >{{trans('library.index_blade.select_option_two')}}</option>
                                        <option value="3" >{{trans('library.index_blade.select_option_three')}}</option>
                                        <option value="4" >{{trans('library.index_blade.select_option_four')}}</option>
                                        <option value="5" >{{trans('library.index_blade.select_option_five')}}</option>
                                        <option value="6" >{{trans('library.index_blade.select_option_six')}}</option>
                                    </select>
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Select Option" data-original-title="{{trans('common.description')}}"></i>
                        </div>
                        <div class="form-group row" data-name="gpJTaEAs">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.span_multi_option')}} 
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="QlzksnBh">
                                <select class="mt-multiselect btn btn-default" multiple="multiple" data-label="left" name="clients[]" id="clients" data-width="100%" data-filter="true" data-action-onchange="true" data-select-all="true" data-placeholder="Select Option">
                                    <option value="1">{{trans('library.index_blade.select_option_one')}}</option>
                                    <option value="2">{{trans('library.index_blade.select_option_two')}} </option>
                                    <option value="3">{{trans('library.index_blade.select_option_three')}} </option>
                                    <option value="4">{{trans('library.index_blade.select_option_four')}} </option>
                                    <option value="5">{{trans('library.index_blade.select_option_five')}} </option>
                                    <option value="6">{{trans('library.index_blade.select_option_six')}} </option>
                                </select>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the name of your campaign here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        <div class="form-group row" data-name="RzfhTdQM">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.span_name_txt')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="aPSOzBmC">
                                <div class="input-icon right" data-name="JBfbohFI">
                                    <input type="text" name="name" id="name" class="form-control">
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the name of your campaign here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        <div class="form-group row" data-name="wrjVaKof">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.span_email_add')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="ZhOrybmi">
                                <div class="input-icon right" data-name="ugNvijIt">
                                    <input type="email" name="email" id="email" class="form-control">
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the Email Address here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        <div class="form-group row" data-name="silQfFrG">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.password_txt_label')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="ExMYaGyW">
                                <div class="input-icon right" data-name="iQjjjTAA">
                                    <input type="password" name="password" id="password" class="form-control">
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the password here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        <div class="form-group row" data-name="ftPsjiwA">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.label_confirm_password')}} 
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="SMfJJzmL">
                                <div class="input-icon right" data-name="JizwsBTb">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control">
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the password here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        <div class="form-group row" data-name="CIzeBVJS">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.txt_date')}} </label>
                            <div class="col-md-6" data-name="WWDPUSPe">
                                <div class="input-icon right" data-name="onOMAGKg">
                                    <div class="input-group date" data-date="" data-date-format="mm/dd/yy" data-name="xxCHgJzO">
                                        <input class="form-control" type="text" id="datetimepicker-custom" name="custom_fields" value="" aria-invalid="false">
                                        <div class="input-group-append" data-name="ePsCATrQ">
                                            <span class="input-group-text">
                                                <i class="la la-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the Date here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        <div class="form-group row" data-name="KClRbxMK">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.date_time_label')}} </label>
                            <div class="col-lg-6 col-md-6 col-sm-12" data-name="zfZoHqut">
                                <div class="input-icon right" data-name="YrjpVyGA">
                                    <div class="input-group date" data-name="mguxXSae">
                                        <input type="text" class="form-control" readonly="" id="datetimepicker">
                                        <div class="input-group-append" data-name="WXfLyECO">
                                            <span class="input-group-text">
                                                <i class="la la-calendar glyphicon-th"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the DateTime here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        <div class="form-group row" data-name="WQYIYxix">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.select_file_label')}}  
                                <span class="required"> * </span>
                                <small> {{trans('library.index_blade.small_file_size_limit')}} </small>
                            </label>
                            <div class="col-lg-6 col-md-6 col-sm-12" data-name="CLuyfDbm">
                                <div class="custom-file" data-name="GoWIcQYZ">
                                    <input type="file" class="custom-file-input" onchange="ValidateSize(this)" name="file_import" id="import-id">
                                    <label class="custom-file-label selected" for="customFile" id="importIdLabel"></label>
                                    <span style="color: red; display: none;" id="FileSizeError">{{trans('library.index_blade.span_file_size_exceeds')}} </span>
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the DateTime here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        <div class="form-group row" data-name="WubrHTeh">
                            <label class="col-form-label col-md-3">
                              {{trans('library.index_blade.select_list_label')}} 
                            </label>
                            <div class="col-md-8" data-name="lTSczdwI">
                                <div class="kt-radio-inline" data-name="bgIVkLjo">
                                    <label class="kt-radio kt-radio--default">
                                        <input type="radio" name="list" value="" checked="">{{trans('library.index_blade.input_list_item_one')}} 
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--default">
                                        <input type="radio" name="list" value="">{{trans('library.index_blade.input_list_item_two')}} 
                                        <span></span>
                                    </label>
                                    <label class="kt-radio kt-radio--default">
                                        <input type="radio" name="list" value="">{{trans('library.index_blade.input_list_item_three')}} 
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="GoEQOpGA">
                            <label class="col-form-label col-md-3">
                                Select Lists
                            </label>
                            <div class="col-md-6" data-name="UwpzpZXe">
                                <div class="kt-portlet kt-portlet--height-fluid scroll scroll-300" data-name="RUxBLQWA">
                                    <div class="kt-portlet__body" data-name="euhzsaen">
                                        <div class="kt-checkbox-list" data-name="UPfRWHis">
                                            <label class="kt-checkbox parentList" for="2">
                                            <input class="group-selector-subscriber2" type="checkbox" value="2" id="2" name="list_group"> <strong>{{trans('library.index_blade.strong_unsorted')}}</strong>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="IZgRzJIg">
                                            <label class="kt-checkbox parentList" for="c-1">
                                                <input type="checkbox" id="c-1" value="1" name="list_ids[]" required="" class="group-subscriber-p-2"> {{trans('library.index_blade.input_blog_subscriber')}} (21)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="pxZSthzA">
                                            <label class="kt-checkbox parentList" for="c-14">
                                                <input type="checkbox" id="c-14" value="14" name="list_ids[]" required="" class="group-subscriber-p-2"> {{trans('library.index_blade.input_beta_testers')}} (5203)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="qiDHJCAN">
                                            <label class="kt-checkbox parentList" for="c-25">
                                                <input type="checkbox" id="c-25" value="25" name="list_ids[]" required="" class="group-subscriber-p-2"> {{trans('library.index_blade.shahbaz_nam')}}  (5223)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" data-name="GKuImraB">
                                            <label class="kt-checkbox parentList" for="4">
                                            <input class="group-selector-subscriber2" type="checkbox" value="4" id="4" name="list_group"> <strong>Mumara.com</strong>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="OTxprpdi">
                                            <label class="kt-checkbox parentList" for="c-4">
                                                <input type="checkbox" id="c-4" value="4" name="list_ids[]" required="" class="group-subscriber-p-4">{{trans('library.index_blade.input_contact_us')}}  (108)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="xUsrNzNX">
                                            <label class="kt-checkbox parentList" for="c-5">
                                                <input type="checkbox" id="c-5" value="5" name="list_ids[]" required="" class="group-subscriber-p-4">{{trans('library.index_blade.clients_label')}}  (418)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="uhMxANQq">
                                            <label class="kt-checkbox parentList" for="c-6">
                                                <input type="checkbox" id="c-6" value="6" name="list_ids[]" required="" class="group-subscriber-p-4">{{trans('library.index_blade.mumara_community_input')}} (9)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="aFyaHhVr">
                                            <label class="kt-checkbox parentList" for="c-7">
                                                <input type="checkbox" id="c-7" value="7" name="list_ids[]" required="" class="group-subscriber-p-4">{{trans('library.index_blade.lP_leads_input')}}  (7)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="gAncnppq">
                                            <label class="kt-checkbox parentList" for="c-16">
                                                <input type="checkbox" id="c-16" value="16" name="list_ids[]" required="" class="group-subscriber-p-4">{{trans('library.index_blade.mumara_leads_label')}} (111)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" data-name="KnDmnbdT">
                                            <label class="kt-checkbox parentList" for="15">
                                            <input class="group-selector-subscriber2" type="checkbox" value="15" id="15" name="list_group"> <strong>HH</strong>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="MYhExylf">
                                            <label class="kt-checkbox parentList" for="c-9">
                                                <input type="checkbox" id="c-9" value="9" name="list_ids[]" required="" class="group-subscriber-p-15"> {{trans('library.index_blade.label_employees')}} (5209)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="SUKAcxGm">
                                            <label class="kt-checkbox parentList" for="c-21">
                                                <input type="checkbox" id="c-21" value="21" name="list_ids[]" required="" class="group-subscriber-p-15"> {{trans('library.index_blade.label_employess_copy')}}  1 (2)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="KPbOUzjK">
                                            <label class="kt-checkbox parentList" for="c-37">
                                                <input type="checkbox" id="c-37" value="37" name="list_ids[]" required="" class="group-subscriber-p-15"> sadasdasd (5)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="dzqqMSeU">
                                            <label class="kt-checkbox parentList" for="c-46">
                                                <input type="checkbox" id="c-46" value="46" name="list_ids[]" required="" class="group-subscriber-p-15"> tetsretsfZ000111 (0)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" data-name="SifJLdNB">
                                            <label class="kt-checkbox parentList" for="17">
                                            <input class="group-selector-subscriber2" type="checkbox" value="17" id="17" name="list_group"> <strong>{{trans('library.index_blade.strong_leads_input')}} </strong>
                                                <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="aosMrbLw">
                                            <label class="kt-checkbox parentList" for="c-12">
                                                <input type="checkbox" id="c-12" value="12" name="list_ids[]" required="" class="group-subscriber-p-17"> {{trans('library.index_blade.input_ramzan_edited')}} (5192)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="tQpvzhzS">
                                            <label class="kt-checkbox parentList" for="c-69">
                                                <input type="checkbox" id="c-69" value="69" name="list_ids[]" required="" class="group-subscriber-p-66"> {{trans('library.index_blade.input_test_user')}}  (5)
                                            <span></span>
                                            </label>
                                        </div>
                                        <div class="kt-checkbox-list" style="padding-left: 20px;" data-name="deNZPhcB">
                                            <label class="kt-checkbox parentList" for="c-71">
                                                <input type="checkbox" id="c-71" value="71" name="list_ids[]" required="" class="group-subscriber-p-66"> {{trans('library.index_blade.shahbaz_name')}}  (0)
                                            <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row" data-name="uauWPFNK">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.label_content_html')}} 
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="OzEgUrbC">
                                <div class="input-icon right" data-name="HAjCEZvZ">
                                    <textarea id="content_html" name="content_html"></textarea>
                                </div>
                            </div>
                            
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the name of your campaign here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>
                        @php
                            $ckeditor_id = 'content_html';
                        @endphp

                        <div class="form-group row" data-name="RToswqvO"><label class="col-md-3 col-form-label">AActions </label>
                            <div class="col-md-6" data-name="nqKcUMLP">

                                <div class="btn-group dropup" data-name="DFCdfqUH"><a href="javascript:void(0)" data-toggle="dropdown" id="copy-email" class="btn btn-success  btn-xs dropdown-toggle">{{trans('library.index_blade.action_copy_txt')}}  </a>
                                    <div id="htmltotext" style="display:none" data-name="dRBfKjld">

                                    </div>
                                </div>
                                <div class="btn-group dropup" data-name="brRarfBU">
                                    <button class="btn btn-success btn-xs" type="button" id="spam_score_check" onclick="checkSpamScore()">{{trans('library.index_blade.check_spam_score')}} 
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row" data-name="wsLCvgRF">
                            <label class="col-form-label col-md-3">{{trans('library.index_blade.message_txt')}}
                                <span class="required"> * </span>
                            </label>
                            <div class="col-md-6" data-name="RyPsYiwe">
                                <div class="input-icon right" data-name="LmudAKDB">
                                    <textarea name="message" id="message" class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                            <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Enter the name of your campaign here." data-original-title="{{trans('common.description')}}" aria-describedby="popover615056"></i>
                        </div>

                        <div id="kt_repeater_4" data-name="heqoHAiH">
                            <div class="form-group row mb0" data-name="iLCBZlsy">
                                <label class="col-form-label col-md-3">{{trans('library.index_blade.label_attach_file')}} </label>
                                <div class="col-md-6"  data-repeater-list="files" data-name="BBCJbaHy">
                                    <div id="drag-and-drop-zone" class="dm-uploader mt-repeater" data-name="saQrpkvS">
                                        <div data-repeater-item data-name="YzXusqLO">
                                            <div data-repeater-item="" class="mt-repeater-item" data-name="OfrRYOpI">
                                                <div class="row mt-repeater-row" data-name="HoHPTerT">
                                                    <div class="btn btn-block fonttest" data-name="TIfPYkRF">
                                                        <i class="la la-cloud-upload" aria-hidden="true"></i>
                                                        {{trans('library.index_blade.drop_browse_file_input')}} 
                                                        <input type="file" title='Click to add Files' />
                                                    </div>
                                                    <ul class="list-unstyled p-2 flex-column col" id="files">
                                                        <li class="text-muted text-center empty">{{trans('app.campaigns.broadcasts.add.no_files_uploaded')}}</li>
                                                    </ul>
                                                    <ul id="imgMsg"></ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="kt-space-20" data-name="yuSulLuo"></div>

                        <div id="kt_repeater_3" data-name="PglqRZaF">
                            <div class="form-group row mb0" data-name="eHMnFFOQ">
                                <label class="col-form-label col-md-3">
                                   {{trans('library.index_blade.label_additional_header')}} 
                                </label>
                                <div class="col-md-6" data-repeater-list="subscriber_filter" data-name="qKvorCSm">
                                    <div class="mt-repeater" style="" data-name="YVnnrSXV">
                                        <div data-repeater-item="" class="mt-repeater-item" data-name="DSTshJnF">
                                            <div class="row mt-repeater-row" data-name="kanxkaEP">
                                                <div class="col-md-6" data-name="nFolVFyp">
                                                    <input type="text" name="subscriber_filter[0][header]" placeholder="Header" class="form-control" value="">
                                                    <span class="clnfld">:</span>
                                                </div>
                                                <div class="col-md-5" data-name="gOcPBrjl">
                                                    <input type="text" name="subscriber_filter[0][header_value]" placeholder="Value" class="form-control" value="">
                                                </div>
                                                <div class="col-md-1" data-name="bcmzJtmf">
                                                    <a href="javascript:;" data-repeater-delete="" class="btn btn-danger btn-icon btn-sm"><i class="la la-remove"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                                              
                                </div>
                            </div>
                            <div class="row" id="btn-new" style="display: flex;" data-name="SrUvqpWv">
                                <div class="col-lg-3" data-name="nUWxKmRl"></div>
                                <div class="col" data-name="pfLnSQuG">
                                    <div data-repeater-create="" class="btn btn btn-info btn-sm" data-name="NEcKqTYp">
                                        <span>
                                            <i class="la la-plus"></i>
                                            <span>{{trans('library.index_blade.span_add_new')}}</span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-portlet__foot" data-name="Ujwanzzw">
                    <div class="kt-form__actions" data-name="bLfLYykS">
                        <div class="row" data-name="QPsJpoCN">
                            <div class="col-lg-9 offset-lg-3" data-name="atesvLbH">
                                <button type="submit" class="btn btn-success" data-toggle="modal">{{trans('library.index_blade.save_button')}}</button>
                                <button type="button" class="btn btn-default">{{trans('library.index_blade.button_cancel')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>

<div class="row" data-name="eoFGwyjT">
    <div class="col-md-12" data-name="aJoycCrW">
        <div class="kt-portlet" data-name="crmVajDG">
            <div class="kt-portlet__body" data-name="YZYMFYIU">
                <div class="tabbable tabbable-tabdrop" data-name="PtoeDpIM">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a href="#tab1" class="nav-link active" data-toggle="tab" role="tab" aria-selected="true">{{trans('library.index_blade.Application_action_txt')}}</a>
                        </li>
                        <li class="nav-item">
                            <a href="#tab4" class="nav-link" data-toggle="tab" role="tab" aria-selected="true">{{trans('library.index_blade.custom_css_label')}}</a>
                        </li>
                    </ul>
                    <div class="tab-content" data-name="ucOeXJdJ">
                        <div class="tab-pane active" id="tab1" data-name="lGIBnnbC">
                            <form action="" method="POST" class="kt-form kt-form--label-right">
                                <input type="hidden" name="_token" value="cTd21W2VaXIcSa1PKjBPD6s3K2m3QENFp5KqrkZY">
                                <input type="hidden" name="form_type" value="application_settings">
                                <div class="kt-portlet kt-portlet--bordered" data-name="LDaUxOwW">
                                    <div class="kt-portlet__head" data-name="bIPXriDf">
                                        <div class="kt-portlet__head-label" data-name="HGScsOSV">
                                            <h3 class="kt-portlet__head-title">{{trans('library.index_blade.application_settings_heading')}} </h3>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body" data-name="mFLNmQkB">
                                        <div class="form-body" data-name="qgqnSvPR">
                                            <div class="form-group row" data-name="DKHIcEnu">
                                                <label class="col-form-label col-md-3">{{trans('library.index_blade.label_application_title')}} 
                                                </label>
                                                <div class="col-md-6" data-name="dRTZTtVW">
                                                    <div class="input-icon right" data-name="TimlaDeO">
                                                        <input type="text" name="title" value="Mumara" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" data-name="EBxWKxFm">
                                                <label class="col-form-label col-md-3">{{trans('library.index_blade.label_copyright_statement')}} 
                                                </label>
                                                <div class="col-md-6" data-name="BnsgXMzX">
                                                    <div class="input-icon right" data-name="BcpnTqiO">
                                                        <input type="text" name="copyright" value="Hostings House" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" data-name="vTgXqbvW">
                                                <label class="col-form-label col-md-3">{{trans('library.index_blade.label_login_screen_title')}} 
                                                </label>
                                                <div class="col-md-6" data-name="aEngMRHn">
                                                    <div class="input-icon right" data-name="wircbdUW">
                                                        <input type="text" name="login_title" value="Mumara Email Login" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row" data-name="wZrxEgtY">
                                                <label class="col-form-label col-md-3">{{trans('library.index_blade.label_screen_description')}} 
                                                </label>
                                                <div class="col-md-6" data-name="DsGrGbVX">
                                                    <div class="input-icon right" data-name="dITzSvFu">
                                                        <input type="text" name="login_desc" value="Provide your login details to proceed." class="form-control">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group row" data-name="sCdeqRlq">
                                                <label class="col-form-label col-md-3"></label>
                                                <div class="col-md-2" data-name="KrXBpEUs">
                                                    <button type="submit" class="btn btn-success" value="">{{trans('library.index_blade.save_button')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tab4" data-name="IkhYkisa">
                            <form action="" method="POST" id="custom-css-frm" class="kt-form kt-form--label-right" novalidate="novalidate">
                                <input name="_method" type="hidden" value="PUT">
                                <div class="kt-portlet kt-portlet--bordered" data-name="CowBzbnD">
                                    <div class="kt-portlet__head" data-name="PSlMbcaB">
                                        <div class="kt-portlet__head-label" data-name="ziJoDFbg">
                                            <h3 class="kt-portlet__head-title">{{trans('library.index_blade.heading_override_custom_css')}}</h3>
                                        </div>
                                    </div>
                                    <div class="kt-portlet__body" data-name="JyFcMHHM">
                                        <div class="form-body" data-name="DWKzZRZQ">
                                            <div class="form-group row" data-name="nDwIzbYs">
                                                <label class="col-form-label col-md-3">{{trans('library.index_blade.custom_css_label')}} 
                                                </label>
                                                <div class="col-md-6" data-name="sHfgnMPo">
                                                    <div class="input-icon right" data-name="KccccUlB">
                                                        <textarea name="css" class="form-control scroll scroll-250" rows="15">:root {
    --white:#fff;
    --blue: #007bff;
    --indigo: #6610f2;
    --purple: #6f42c1;
    --pink: #e83e8c;
    --red: #dc3545;
    --orange: #fd7e14;
    --yellow: #ffc107;
    --green: #28a745;
    --teal: #20c997;
    --cyan: #17a2b8;
    --white: #fff;
    --gray: #6c757d;
    --gray-dark: #343a40;
    --primary: #5867dd;
    --secondary: #ffffff;
    --success: #1caf9a;
    --info: #5578eb;
    --warning: #ffb822;
    --danger: #fd397a;
    --light: #f8f9fa;
    --dark: #282a3c;
    --breakpoint-xs: 0;
    --breakpoint-sm: 576px;
    --breakpoint-md: 768px;
    --breakpoint-lg: 1024px;
    --breakpoint-xl: 1399px;
}
                                                        </textarea>
                                                    </div>
                                                </div>
                                                <i class="fa fa-question popovers" data-toggle="kt-popover" data-container="body" data-trigger="hover" data-placement="right" data-content="Custom CSS Help" data-original-title="{{trans('common.description')}}"></i>
                                            </div>
                                        </div>
                                        <div class="form-actions" data-name="UGirmljN">
                                            <div class="row" data-name="FIvTNRnI">
                                                <label class="col-form-label col-md-3"></label>
                                                <div class="col-md-6" data-name="JEZdHNZb">
                                                    <button type="submit" name="edit" class="btn btn-success" value="edit">{{trans('library.index_blade.save_button')}}</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" data-name="wicIQtTy">
    <div class="col-md-6" data-name="WMoenulc">
        <div class="kt-portlet" data-name="IjTBYzku">
            <div class="kt-portlet__head" data-name="qOvHkkFD">
                <div class="kt-portlet__head-label" data-name="bYQOReBd">
                    <h3 class="kt-portlet__head-title">
                        {{trans('library.index_blade.solid_bg_alerts')}} 
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="PeccCqjJ">
                <!--begin::Section-->
                <div class="kt-section mb0" data-name="SXnygjlb">
                    <div class="kt-section__info" data-name="LLnySqDc">{{trans('library.index_blade.alerts_available_for_txt_div')}}</div>
                    <div class="kt-section__content" data-name="niYYvsUf">
                        <div class="alert alert-brand alert-bold" role="alert" data-name="dUvRtdtF" >
                            <div class="alert-text" data-name="OJKxMdOm">{{trans('library.index_blade.primary_alert_check_div')}} </div>
                        </div>
                        <div class="alert alert-success alert-bold" role="alert" data-name="byoRBHbV">
                            <div class="alert-text" data-name="HcYvIcCg">{{trans('library.index_blade.success_alert_check_div')}}</div>
                        </div>
                        <div class="alert alert-danger alert-bold" role="alert" data-name="NubPwFIS">
                            <div class="alert-text" data-name="RGLOYFZg">{{trans('library.index_blade.danger_alert_check_div')}} </div>
                        </div>
                        <div class="alert alert-warning alert-bold" role="alert" data-name="aVevClvQ">
                            <div class="alert-text" data-name="qhhIiuOy">{{trans('library.index_blade.warning_alert_check_div')}} </div>
                        </div>
                        <div class="alert alert-info alert-light alert-bold" role="alert" data-name="VlIfNzgm">
                            <div class="alert-text" data-name="raGvpyJd">{{trans('library.index_blade.light_alert_check_div')}}</div>
                        </div>
                        <div class="alert alert-solid-dark alert-bold" role="alert" data-name="RKnrTihM">
                            <div class="alert-text" data-name="PQOLjdjq">{{trans('library.index_blade.dark_alert_check_div')}}</div>
                        </div>
                    </div>
                </div>
                <!--end::Section-->
                <div class="kt-section mb0" data-name="HfEoWoyA">
                    <div class="kt-space-20" data-name="QAYDUvpQ"></div>
                    <span class="kt-section__info">
                    {{trans('library.index_blade.span_utility_classes_recreate')}} 
                    </span>
                    <div class="kt-section__content kt-section__content--solid" data-name="DuLjcUQA">
                        <h3>
                          {{trans('library.index_blade.fancy_display_heading')}} 
                          <small class="text-muted">{{trans('library.index_blade.small_secondary_txt_faded')}}</small>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6" data-name="EONGcSLV">
        <div class="kt-portlet kt-portlet--tab" data-name="tRgiwxpk">
            <div class="kt-portlet__head" data-name="QbNwGFvU">
                <div class="kt-portlet__head-label" data-name="xoFaHCnk">
                    <span class="kt-portlet__head-icon kt-hide">
                        <i class="la la-gear"></i>
                    </span>
                    <h3 class="kt-portlet__head-title">
                        {{trans('library.index_blade.head_headings')}} 
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="PexTLEVu">
                <!--begin::Section-->
                <div class="kt-section" data-name="wOwANCNU">
                    <span class="kt-section__info">
                        {{trans('library.index_blade.span_html_heading')}} 
                    </span>
                    <div class="kt-section__content kt-section__content--solid" data-name="GfHpIdRQ">
                        <div class="row" data-name="OPKYLUnd">
                            <div class="col-md-6" data-name="svnbUqXY">
                                <h1>h1. {{trans('library.index_blade.head_heading')}} 1</h1>
                                <div class="kt-space-10" data-name="NQWGsulT"></div>
                                <h2>h2. {{trans('library.index_blade.head_heading')}} 2</h2>
                                <div class="kt-space-10" data-name="uHqHRqzM"></div>
                                <h3>h3. {{trans('library.index_blade.head_heading')}} 3</h3>
                                <div class="kt-space-10" data-name="HHmptRXb"></div>
                                <h4>h4. {{trans('library.index_blade.head_heading')}} 4</h4>
                                <div class="kt-space-10" data-name="JIYigaMn"></div>
                                <h5>h5. {{trans('library.index_blade.head_heading')}} 5</h5>
                                <div class="kt-space-10" data-name="LckLQQKG"></div>
                                <h6>h6. {{trans('library.index_blade.head_heading')}} 6</h6>
                            </div>
                            <div class="col-md-6" data-name="npPHcOQC">
                                <h1 class="kt-font-success">h1. {{trans('library.index_blade.head_heading')}} 1</h1>
                                <div class="kt-space-10" data-name="OHvDaniH"></div>
                                <h2 class="kt-font-info">h2. {{trans('library.index_blade.head_heading')}} 2</h2>
                                <div class="kt-space-10" data-name="SUUPwdPC"></div>
                                <h3 class="kt-font-warning">h3. {{trans('library.index_blade.head_heading')}} 3</h3>
                                <div class="kt-space-10" data-name="IKcBmSKv"></div>
                                <h4 class="kt-font-danger">h4. {{trans('library.index_blade.head_heading')}} 4</h4>
                                <div class="kt-space-10" data-name="nUNyuUxJ"></div>
                                <h5 class="kt-font-primary">h5. {{trans('library.index_blade.head_heading')}} 5</h5>
                                <div class="kt-space-10" data-name="gYxIXKlp"></div>
                                <h6 class="kt-font-brand">h6. {{trans('library.index_blade.head_heading')}} 6</h6>
                            </div>
                        </div>

                    </div>
                </div>
                <!--end::Section-->
                <div class="kt-space-20" data-name="zxDryEBC"></div>
                <div class="kt-section mb0" data-name="qfKdZQKV">
                    <h4>Bootstrap buttons:</h4>
                    <div class="kt-section__content kt-section__content--solid" data-name="jetQtNvT">
                        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#integrats">Primary</button> -->
                        <button type="button" class="btn btn-default">{{trans('library.index_blade.button_default')}}</button>
                        <button type="button" class="btn btn-secondary btn-hover-brand">{{trans('library.index_blade.span_secondary')}}</button>
                        <button type="button" class="btn btn-success">{{trans('common.label.success')}}</button>
                        <button type="button" class="btn btn-info">{{trans('library.index_blade.span_info')}}</button>
                        <button type="button" class="btn btn-warning">{{trans('library.index_blade.span_warning')}}</button>
                        <button type="button" class="btn btn-danger">{{trans('library.index_blade.span_danger')}}</button>
                    </div>
                    <div class="kt-section__content kt-section__content--solid" data-name="IhPgeLGt">
                        <span class="btn btn-label-primary">{{trans('library.index_blade.span_primary')}}</span>&nbsp;
                        <span class="btn btn-label-success">{{trans('common.label.success')}}</span>&nbsp;
                        <span class="btn btn-label-info">{{trans('library.index_blade.span_info')}}</span>&nbsp;
                        <span class="btn btn-label-danger">{{trans('library.index_blade.span_danger')}}</span>&nbsp;
                        <span class="btn btn-label-warning">{{trans('library.index_blade.span_warning')}}</span>&nbsp;
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row" data-name="qVEZdLaa">
    <div class="col-md-6" data-name="WeZEJQnP">
        <div class="kt-portlet" style="display: block;" data-name="YCoyktVL">
            <div class="kt-portlet__head" data-name="cEzTEblS">
                <div class="kt-portlet__head-label" data-name="ywhDDsrM">
                    <h3 class="kt-portlet__head-title">
                        <b>{{trans('library.index_blade.methord_heading')}} 1:</b> {{trans('library.index_blade.heading_send_via_smtp')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="ORcgFejP">
                <div class="form-group row mb0" data-name="SQXtWGiG">
                    <div class="method-blk" data-name="DkOwYLQw">
                        <p>{{trans('library.index_blade.para_connect_application_mumara')}}</p>
                    </div>
                    <div class="col-md-6" data-name="WHYbHMkw">
                        <label class="col-form-label">{{trans('common.label.name')}}</label>
                        <div class="input-group" data-name="MFjyzCdT">
                            <h4 class="result-username">
                                <span id="user_copy">{{trans('library.index_blade.span_super_admin')}}</span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-6" data-name="PnwVOqao">
                        <label class="col-form-label">{{trans('common.label.host')}}</label>
                        <div class="input-group" data-name="HaZsXCux">
                            <h4 class="result-username">
                                <!-- <span id="user_host">host.cloude.mumara.com</span> -->
                                <span id="user_host">smtp.mumara.com</span>
                                <span class="copy_blk" id="btn-host" onclick="copy_user(user_host)">
                                    <svg class="octicon octicon-clippy d-inline-block mx-1 js-clipboard-clippy-icon" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M5.75 1a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-3a.75.75 0 00-.75-.75h-4.5zm.75 3V2.5h3V4h-3zm-2.874-.467a.75.75 0 00-.752-1.298A1.75 1.75 0 002 3.75v9.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-9.5a1.75 1.75 0 00-.874-1.515.75.75 0 10-.752 1.298.25.25 0 01.126.217v9.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-9.5a.25.25 0 01.126-.217z"></path></svg>
                                    <svg class="octicon octicon-check js-clipboard-check-icon color-text-success d-inline-block d-none" aria-hidden="true" viewBox="0 0 16 16" version="1.1" height="40" width="16" style="display: block;"><path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb0" data-name="FtUhZmcm">
                    <div class="col-md-6" data-name="zqsnkBjm">
                        <label class="col-form-label">{{trans('common.label.port')}}</label>
                        <div class="input-group" data-name="EiPVVhnD">
                            <h4 class="result-username">
                                <!-- <span id="user_port">587</span> -->
                                <span id="user_port">587</span>
                                <span class="copy_blk" id="btn-port" onclick="copy_user(user_port)">
                                    <svg class="octicon octicon-clippy d-inline-block mx-1 js-clipboard-clippy-icon" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M5.75 1a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-3a.75.75 0 00-.75-.75h-4.5zm.75 3V2.5h3V4h-3zm-2.874-.467a.75.75 0 00-.752-1.298A1.75 1.75 0 002 3.75v9.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-9.5a1.75 1.75 0 00-.874-1.515.75.75 0 10-.752 1.298.25.25 0 01.126.217v9.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-9.5a.25.25 0 01.126-.217z"></path></svg>
                                    <svg class="octicon octicon-check js-clipboard-check-icon color-text-success d-inline-block d-none" aria-hidden="true" viewBox="0 0 16 16" version="1.1" height="40" width="16" style="display: block;"><path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-6" data-name="pRaCpPQt">
                        <label class="col-form-label">{{trans('common.label.username')}}</label>
                        <div class="input-group" data-name="dhpDGbCS">
                            <h4 class="result-username">
                                <span id="user_copyname">LVNNVFAtMTYyMjAzNjUyNA</span>
                                <span class="copy_blk" id="btn-copy" onclick="copy_user(user_copyname)">
                                    <svg class="octicon octicon-clippy d-inline-block mx-1 js-clipboard-clippy-icon" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M5.75 1a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-3a.75.75 0 00-.75-.75h-4.5zm.75 3V2.5h3V4h-3zm-2.874-.467a.75.75 0 00-.752-1.298A1.75 1.75 0 002 3.75v9.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-9.5a1.75 1.75 0 00-.874-1.515.75.75 0 10-.752 1.298.25.25 0 01.126.217v9.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-9.5a.25.25 0 01.126-.217z"></path></svg>
                                    <svg class="octicon octicon-check js-clipboard-check-icon color-text-success d-inline-block d-none" aria-hidden="true" viewBox="0 0 16 16" version="1.1" height="40" width="16" style="display: block;"><path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>
                                </span>
                            </h4>
                        </div>
                    </div>
                </div>
                <div class="form-group row mb0" data-name="WRFwVEiA">
                    <div class="col-md-6" data-name="wUGrgMpC">
                        <label class="col-form-label">{{trans('common.label.password')}}</label>
                        <div class="input-group" data-name="hcrSpFGS">
                            <h4 class="result-username mb0">
                                <span id="pass_copy">60ae502c5a96e1622036524</span>
                                <span class="copy_blk" id="btn-copy2" onclick="copy_user(pass_copy)">
                                    <svg class="octicon octicon-clippy d-inline-block mx-1 js-clipboard-clippy-icon" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M5.75 1a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-3a.75.75 0 00-.75-.75h-4.5zm.75 3V2.5h3V4h-3zm-2.874-.467a.75.75 0 00-.752-1.298A1.75 1.75 0 002 3.75v9.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-9.5a1.75 1.75 0 00-.874-1.515.75.75 0 10-.752 1.298.25.25 0 01.126.217v9.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-9.5a.25.25 0 01.126-.217z"></path></svg>
                                    <svg class="octicon octicon-check js-clipboard-check-icon color-text-success d-inline-block d-none" aria-hidden="true" viewBox="0 0 16 16" version="1.1" height="40" width="16" style="display: block;"><path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>
                                </span>
                            </h4>
                        </div>
                    </div>
                    <div class="col-md-6" data-name="JAqWMLrH">
                        <label class="col-form-label">{{trans('common.label.encryption')}}</label>
                        <div class="input-group" data-name="AVWepHjv">
                            <h4 class="result-username">
                                <!-- <span id="user_copy">TLS</span> -->
                                <span id="user_copy">TLS</span>
                            </h4>
                        </div>
                        <a download href="/storage/credentials.csv" class="cr-action download-file"> 
                            <i class="la la-download"></i> {{trans('library.index_blade.action_download_smtp')}}
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet" style="display: block;" data-name="migjTWxb">
            <div class="kt-portlet__head" data-name="EXDtTnsF">
                <div class="kt-portlet__head-label" data-name="XwbqUbhT">
                    <h3 class="kt-portlet__head-title">
                        <b>{{trans('library.index_blade.heading_notification_icon')}}:</b> {{trans('library.index_blade.label_list')}}
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="TJUujhmB">
                <table class="table table-striped table-hover table-checkable responsive" id="table-nil">
                    <thead>
                        <tr>
                            <th align="left">{{trans('library.index_blade.th_notification_title')}}</th>
                            <th align="center">{{trans('library.index_blade.th_icon')}}</th>
                            <th align="left">{{trans('library.index_blade.th_notification_title')}}</th>
                            <th align="center">{{trans('library.index_blade.th_icon')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{trans('library.index_blade.td_import_list')}}</td>
                            <td><i class="flaticon2-graphic-design kt-font-dark"></i></td>
                            <td>{{trans('library.index_blade.td_export_list')}}</td>
                            <td><i class="flaticon2-download-1 kt-font-success"></i></td>
                        </tr>
                        <tr>
                            <td>{{trans('library.index_blade.td_segment_creat')}}</td>
                            <td><i class="flaticon2-medical-records kt-font-info"></i></td>
                            <td>{{trans('library.index_blade.td_broadcast_sched')}}</td>
                            <td><i class="flaticon2-time kt-font-warning"></i></td>
                        </tr>
                        <tr>
                            <td>{{trans('library.index_blade.td_broadcast_complete')}}</td>
                            <td><i class="flaticon2-hourglass-1 kt-font-success"></i></td>
                            <td>{{trans('library.index_blade.td_segment_exported')}}</td>
                            <td><i class="flaticon2-paper-plane kt-font-info"></i></td>
                        </tr>
                        <tr>
                            <td>{{trans('library.index_blade.campaign_start_td')}}</td>
                            <td><i class="flaticon2-mail-1 kt-font-success"></i></td>
                            <td>{{trans('library.index_blade.td_campaign_paused')}}</td>
                            <td><i class="flaticon2-email kt-font-danger"></i></td>
                        </tr>
                        <tr>
                            <td>{{trans('library.index_blade.td_daily_reached')}}</td>
                            <td><i class="flaticon2-calendar-7 kt-font-info"></i></td>
                            <td>{{trans('library.index_blade.td_monthly_limit')}}</td>
                            <td><i class="flaticon2-calendar-8 kt-font-success"></i></td>
                        </tr>
                        <tr>
                            <td>{{trans('library.index_blade.smtp_fail_td')}}</td>
                            <td><i class="flaticon2-cancel kt-font-danger"></i></td>
                            <td>{{trans('library.index_blade.td_domain_verification')}} </td>
                            <td><i class="flaticon2-correct kt-font-success"></i></td>
                        </tr>
                        <tr>
                            <td>{{trans('library.index_blade.trigger_td')}}</td>
                            <td><i class="flaticon2-send-1 kt-font-info"></i></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6" data-name="WecqLkFz">
        <div class="kt-portlet" style="display: block;" data-name="KBpUPQRT">
            <div class="kt-portlet__head" data-name="mdTFuImM">
                <div class="kt-portlet__head-label" data-name="ccMpRjVD">
                    <h3 class="kt-portlet__head-title">
                        <b>{{trans('library.index_blade.methord_heading')}} 2:</b>{{trans('library.index_blade.heading_send_api')}} 
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body" data-name="CfqLrUDl">
                <div class="method-blk step2" data-name="UDRIDGOM">
                    <p>{{trans('library.index_blade.send_emails_mumara_para')}}</p>
                    <label class="col-form-label">{{trans('library.index_blade.label_api_key')}}</label>
                    <div class="input-group" data-name="YsqjdVsk">
                        <h4 class="result-username">
                            <input type="text" id="copyurl" class="form-control" name="" value="LVNNVFAtMTYyMjAzNjUyNA-60ae502c5a96e1622036524" readonly="" aria-invalid="false">
                            <span class="copy_blk" id="btn-host" onclick="copyFunction()">
                                <svg class="octicon octicon-clippy d-inline-block mx-1 js-clipboard-clippy-icon" viewBox="0 0 16 16" version="1.1" width="16" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M5.75 1a.75.75 0 00-.75.75v3c0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75v-3a.75.75 0 00-.75-.75h-4.5zm.75 3V2.5h3V4h-3zm-2.874-.467a.75.75 0 00-.752-1.298A1.75 1.75 0 002 3.75v9.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-9.5a1.75 1.75 0 00-.874-1.515.75.75 0 10-.752 1.298.25.25 0 01.126.217v9.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-9.5a.25.25 0 01.126-.217z"></path></svg>
                                <svg class="octicon octicon-check js-clipboard-check-icon color-text-success d-inline-block d-none" aria-hidden="true" viewBox="0 0 16 16" version="1.1" height="40" width="16" style="display: block;"><path fill-rule="evenodd" d="M13.78 4.22a.75.75 0 010 1.06l-7.25 7.25a.75.75 0 01-1.06 0L2.22 9.28a.75.75 0 011.06-1.06L6 10.94l6.72-6.72a.75.75 0 011.06 0z"></path></svg>
                            </span>
                        </h4>
                    </div>
                </div>
                <div class="form-group row mb0 blk-api" data-name="JACUTjgS">
                    <div class="col-md-12" id="apiBlk" data-name="NKgywCHJ">
                        <ul class="nav nav-tabs  nav-tabs-line nav-tabs-line-2x nav-tabs-line-success" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#curl" role="tab">cURL</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#python" role="tab">Python</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#java" role="tab">Java</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#php" role="tab">PHP</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#ccc" role="tab">C#</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#javascript">Javascript</a>
                            </li>
                        </ul>
                        <div class="tab-content" data-name="wNJYQqAs">
                            <div class="tab-pane active" id="curl" role="tabpanel" data-name="LathxKyw">
                                <pre class="line-numbers"><code class="language-js" id="code-curl">curl -X POST \
-H "Content-Type: application/json" \
-d '{
     "personalizations":[  \
     {  \
     "to":[  \
     { \
     "email":"john@domain.com"  \
     "name":"John"  \
      } \
     ],  \
     "send_at":"1409348513"  \
     "subject":"Good Morning" \
     "content":[  \
     {  \
     "type":"text/plain"  \
     "value":"Heya"   \
     }, \
     { \
    "type":"text/html"  \
    "value":"<p>this is Email body </p>" \
      } \
     ],\
     "from":{\
     "email":"from@domain.com" \
     "name":"Richard White" \
     },\
     "reply_to":{ \
     "email":"reply@domain.com" \
     "name":"Richard white" \
      },\    
       "api_token":"LVNNVFAtMTYyMjAzNjUyNA-60ae502c5a96e1622036524" \
}' 'https://api.mumara.com/sendMail'
</code></pre>
                            </div>
                            <div class="tab-pane" id="python" role="tabpanel" data-name="CGIJrPlb">
                                <pre class="line-numbers"><code class="language-js" id="code-python">url = "https://api.mumara.com/sendMail"
payload = "{
  "personalizations": [
    {
      "to": [
        {
          "email": "john@domain.com",
          "name": "john"
        }
      ],
      "send_at": 1409348513,
      "subject": "Hello, World!"
    }
  ],
  "content": [
    {
      "type": "text/plain",
      "value": "Heya!"
    },
    {
      "type": "text/html",
      "value": "<p>Hello </p>"
    }
  ],
  "from": {
    "email": "info@domain.com",
    "name": "John"
  },
  "reply_to": {
    "email": "richard@domain.com",
    "name": "Richard"
  },
  "api_token": "LVNNVFAtMTYyMjAzNjUyNA-60ae502c5a96e1622036524"
}"
headers = {
    'Accept': "application/json",
    'Content-Type': "application/json",
    }

response = requests.request("POST", url, data=payload, headers=headers)

print(response.text)</code></pre>
                            </div>
                            <div class="tab-pane" id="java" role="tabpanel" data-name="EoeNbKZt">
                                <pre class="line-numbers"><code class="language-js" id="code-java">URL url = new URL("https://api.mumara.com/sendMail");
HttpURLConnection http = (HttpURLConnection)url.openConnection();
http.setRequestMethod("POST");
http.setDoOutput(true);
http.setRequestProperty("Accept", "application/json");
http.setRequestProperty("Content-Type", "application/json");

String data = "{\n  \"personalizations\": [\n    {\n      \"to\": [\n        {\n          \"email\": \"john@domain.com\",\n          \"name\": \"john\"\n        }\n      ],\n      \"send_at\": 1409348513,\n      \"subject\": \"Hello, World!\"\n    }\n  ],\n  \"content\": [\n    {\n      \"type\": \"text/plain\",\n      \"value\": \"Heya!\"\n    },\n    {\n      \"type\": \"text/html\",\n      \"value\": \"<p>Hello </p>\"\n    }\n  ],\n  \"from\": {\n    \"email\": \"info@domain.com\",\n    \"name\": \"John\"\n  },\n  \"reply_to\": {\n    \"email\": \"richard@domain.com\",\n    \"name\": \"Richard\"\n  },\n  \"api_token\": \"LVNNVFAtMTYyMjAzNjUyNA-60ae502c5a96e1622036524\"\n}";

byte[] out = data.getBytes(StandardCharsets.UTF_8);

OutputStream stream = http.getOutputStream();
stream.write(out);

System.out.println(http.getResponseCode() + " " + http.getResponseMessage());
http.disconnect();</code></pre>
                            </div>
                            
                            <div class="tab-pane" id="php" role="tabpanel" data-name="pPgjkMDQ">
                                <pre class="line-numbers"><code class="language-js" id="code-php">$api_token = "LVNNVFAtMTYyMjAzNjUyNA-60ae502c5a96e1622036524";
$request = new HttpRequest();
$request->setUrl('https://api.mumara.com/sendMail');
$request->setMethod(HTTP_METH_POST);

$request->setHeaders(array(
  'Content-Type' => 'application/json',
  'Accept' => 'application/json'
));

$request->setBody('{
  "personalizations": [
    {
      "to": [
        {
          "email": "john@domain.com",
          "name": "john"
        }
      ],
      "send_at": 1409348513,
      "subject": "Hello, World!"
    }
  ],
  "content": [
    {
      "type": "text/plain",
      "value": "Heya!"
    },
    {
      "type": "text/html",
      "value": "<p>Hello </p>"
    }
  ],
  "from": {
    "email": "info@domain.com",
    "name": "John"
  },
  "reply_to": {
    "email": "richard@domain.com",
    "name": "Richard"
  },   
  "api_token": "$api_token"
}');

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}
</code></pre>
                            </div>
                            <div class="tab-pane" id="ccc" role="tabpanel" data-name="JAdPVlEy">
                                <pre class="line-numbers"><code class="language-js" id="code-ccc">var url = "https://api.mumara.com/sendMail";

var httpRequest = (HttpWebRequest)WebRequest.Create(url);
httpRequest.Method = "POST";

httpRequest.Accept = "application/json";
httpRequest.ContentType = "application/json";

var data = @"{
  ""personalizations"": [
    {
      ""to"": [
        {
          ""email"": ""john@domain.com"",
          ""name"": ""john""
        }
      ],
      ""send_at"": 1409348513,
      ""subject"": ""Hello, World!""
    }
  ],
  ""content"": [
    {
      ""type"": ""text/plain"",
      ""value"": ""Heya!""
    },
    {
      ""type"": ""text/html"",
      ""value"": ""<p>Hello </p>""
    }
  ],
  ""from"": {
    ""email"": ""info@domain.com"",
    ""name"": ""John""
  },
  ""reply_to"": {
    ""email"": ""richard@domain.com"",
    ""name"": ""Richard""
  },
  ""api_token"": ""LVNNVFAtMTYyMjAzNjUyNA-60ae502c5a96e1622036524""
}";

using (var streamWriter = new StreamWriter(httpRequest.GetRequestStream()))
{
   streamWriter.Write(data);
}

var httpResponse = (HttpWebResponse)httpRequest.GetResponse();
using (var streamReader = new StreamReader(httpResponse.GetResponseStream()))
{
   var result = streamReader.ReadToEnd();
}

Console.WriteLine(httpResponse.StatusCode);</code></pre>
                            </div>
                            <div class="tab-pane" id="javascript" role="tabpanel" data-name="siLxtRvw">
                                <pre class="line-numbers"><code class="language-js" id="code-javascript">const url = new URL("https://api.mumara.com/sendMail");
let params = {
    "personalizations": [
    {
      "to": [
        {
          "email": "john@domain.com",
          "name": "john"
        }
      ],
      "send_at": 1409348513,
      "subject": "Hello, World!"
    }
  ],
  "content": [
    {
      "type": "text/plain",
      "value": "Heya!"
    },
    {
      "type": "text/html",
      "value": "<p>Hello </p>"
    }
  ],
  "from": {
    "email": "info@domain.com",
    "name": "John"
  },
  "reply_to": {
    "email": "richard@domain.com",
    "name": "Richard"
  },
  "api_token": "LVNNVFAtMTYyMjAzNjUyNA-60ae502c5a96e1622036524"
};

let headers = {
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: params
})
    .then(response => response.json())
    .then(json => console.log(json));</code></pre>
                            </div>
                        </div>
                    </div>
                    <div class="api-link" data-name="DehWwJTo">
                        <a href="https://developers.mumara.com/One/API" target="_blank">
                            {{trans('library.index_blade.action_api_docu')}} <i class="fa fa-external-link-alt"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="deleteMe" class="modal deleteMe" role="dialog" aria-hidden="true" data-name="wcpsyYmN">
    <div class="modal-dialog modal-dialog-centered" style="width: 600px;" data-select2-id="13" data-name="teIxcOCQ">
        <div class="modal-content" data-select2-id="12" data-name="WdBFjsPY">
            <div class="modal-header" data-name="GDRVDfWo">
                <h5 class="modal-title">{{trans('library.index_blade.delete_confirmation_heading')}}</h5>
            </div>
            <div class="modal-body" data-name="QlAQvwDp">
                <div class="row" data-name="vExUvSYW">
                    <div class="col-md-12" data-name="UPDcHZXK">
                        <span class="alert alert-danger">{{trans('library.index_blade.span_error_domain')}}</span>
                    </div>
                </div>
                <div class="row" data-name="hGLBSCvQ">
                    <div class="col-md-12" data-name="oiTDOBYM">
                        <div id="domain-data" data-name="SBPevEfl">
                            <div class="list-block" data-name="sPvusXON">
                                <div class="row list-scroll" id="assignedAssets" data-name="FXYmlFqY">
                                    <div class="row" data-name="XWjKMXAc">
                                        <div class="col-md-12" data-name="NZcoeIHJ">
                                            <label class="col-form-label">{{trans('common.label.lists')}}</label>
                                            <ul class="no-list">
                                                <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> {{trans('common.label.contact_list')}} 1</a></li>
                                                <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> {{trans('common.label.contact_list')}} 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row" data-name="ISpOfyei">
                                        <div class="col-md-12" data-name="vTQiqXGO">
                                            <label class="col-form-label">{{trans('library.index_blade.sending_nodes_label')}}</label>
                                            <ul class="no-list">
                                                <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> smtp.mumara.com</a></li>
                                                <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> smtp.sendgrid.com</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row" data-name="QCIIlGyp">
                                        <div class="col-md-12" data-name="WJsZdbHy">
                                            <label class="col-form-label">{{trans('library.index_blade.label_sending_domain')}}</label>
                                            <ul class="no-list">
                                                <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> hostingshouse.com</a></li>
                                                <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> mumara.com</a></li>
                                                <li><a href="javascript:;"><i class="fa fa-angle-double-right"></i> shahbazmughal.com</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="unassignedAssets" data-name="Zybibauo">
                                    <div class="col-md-12" data-name="KYZQnXBL">
                                        <label class="col-form-label">{{trans('library.index_blade.label_shift_assets')}}</label>
                                        <div class="form-group mb0" data-name="XzsHlvMs">
                                            <select class="form-control m-select2" id="move-list">
                                                <option value="">{{trans('common.label.select_list')}}</option>
                                                <option value="1">{{trans('common.label.contact_list')}} 1</option>
                                                <option value="2">{{trans('common.label.contact_list')}} 2</option>
                                                <option value="3">{{trans('common.label.contact_list')}} 3</option>
                                                <option value="4">{{trans('common.label.contact_list')}} 4</option>
                                                <option value="5">{{trans('common.label.contact_list')}} 5</option>
                                            </select>
                                        </div>
                                        <small id="sm">{{trans('library.index_blade.small_reassign_another_domain')}}</small>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer" data-name="UlUMDEKM">
                <button type="button" class="btn btn-secondary btn-sm pull-left" data-dismiss="modal">{{trans('library.index_blade.button_cancel')}}</button>
                <button type="button" class="btn btn-primary btn-sm pull-right" id="deletelist">{{trans('common.delete_assets_modal_blade.button_assign_delete')}}</button>
            </div>
        </div>
    </div>
</div>

<!--  Group Modal  -->
<div id="modal-group-label" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="HHHdmwNP">
    <div class="modal-dialog" data-name="fkuldUfv">
        <div class="modal-content" data-name="aOawPlua">
            <div id="msg-group" class="display-hide" data-name="UGNVUyKH">
            <span id="msg-text-group"><span>
            </span></span></div>
            <div class="modal-header" data-name="onIBegCt">
                <h5 class="modal-title">{{trans('library.index_blade.heading_add_group')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="kurMuDUR">
                <form action="" id="frm-group" method="post" class="kt-form kt-form--label-right">
                                                <div class="form-group row" data-name="vvurrYqt">
                            <label class="col-md-3 col-form-label">{{trans('common.label.group')}} 1</label>
                            
                            <div class="col-md-8" data-name="WStvurTy">
                                <input type="text" name="name[]" class="form-control" required="">
                            </div>
                        </div>
                                                <div class="form-group row" data-name="iPtqLtSo">
                            <label class="col-md-3 col-form-label">{{trans('common.label.group')}} 2</label>
                            
                            <div class="col-md-8" data-name="tfnhzuBo">
                                <input type="text" name="name[]" class="form-control">
                            </div>
                        </div>
                                                <div class="form-group row" data-name="aRiCwLZZ">
                            <label class="col-md-3 col-form-label">{{trans('common.label.group')}} 3</label>
                            
                            <div class="col-md-8" data-name="AJhIeoOG">
                                <input type="text" name="name[]" class="form-control">
                            </div>
                        </div>
                        <div class="form-group row" data-name="CHbycdaE">
                            <label class="col-md-3 col-form-label">{{trans('common.label.group')}} 4</label>
                            
                            <div class="col-md-8" data-name="pfuyDePN">
                                <input type="text" name="name[]" class="form-control">
                            </div>
                        </div>
                                                <div class="form-group row" data-name="TsLjtizM">
                            <label class="col-md-3 col-form-label">{{trans('common.label.group')}} 5</label>
                            
                            <div class="col-md-8" data-name="FTPJyrVj">
                                <input type="text" name="name[]" class="form-control">
                            </div>
                        </div>
                                            <div class="form-actions" data-name="BHbYLwBH">
                        <div class="row" data-name="zhXZEIoW">
                            <div class="offset-md-3 col-md-8" data-name="RvhmCrkv">
                                <button type="submit" class="btn btn-success">{{trans('library.index_blade.submit_button')}}</button>
                                <button type="reset" class="btn btn-default">{{trans('library.index_blade.reset_button')}}</button>
                                <input type="hidden" value="3" name="section_id">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="modal-subscriber-details" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="ckNwSswV">
    <div class="modal-dialog" data-name="ygtjUssK">
        <div class="modal-content" data-name="mHlfCDAs">
            <div class="modal-header" data-name="GRkxQHXk">
                <h4 class="modal-title">{{trans('library.index_blade.contact_detail_heading')}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="VGcYsaGx">
                <form action="#" method="POST" class="form-horizontal">
                    <div class="subscriber-data" id="subscriber-data" data-name="yVwOhcPG">
                        <div class="form-group row" data-name="hUnjqTYa">
                            <label class="pull-right col-md-12">
                                <a href="javascript:;" target="_blank" class="btn btn-sm btn-label-brand pull-right">{{trans('library.index_blade.label_edit_contact')}}</a>
                            </label>
                        </div>
                        <div class="form-group row" data-name="aGCqRnIn">
                            <label class="control-label col-md-3">{{trans('common.label.email')}}</label>
                            <div class="col-md-9" data-name="zIRckMaS">
                                <label class="control-label pull-right">nicogallina10@gmail.com</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="yKcULqXp">
                            <label class="control-label col-md-3">{{trans('library.index_blade.label_list')}}
                            </label>
                            <div class="col-md-9" data-name="xzvcELjP">
                                <label class="control-labe pull-right">{{trans('library.index_blade.option_mumara_leads')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" style="display:none;" data-name="CXBoZVBs">
                            <label class="control-label col-md-3">{{trans('common.label.contact_list')}}</label>
                            <div class="col-md-9" data-name="dptJIieD">
                                <select class="form-control select2 pull-right" name="list_id" id="list-id" disabled="">
                                    <option value="100">{{trans('library.index_blade.option_mumara_leads')}} 3</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row" data-name="kWqGjxpo">
                            <label class="control-label col-md-3">{{trans('library.index_blade.label_email_format')}}
                            </label>
                            <div class="col-md-9" data-name="BXAQuBBV">
                                <label class="control-label pull-right">{{trans('common.label.html')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="xMJTdAYK">
                            <label class="control-label col-md-3">{{trans('library.index_blade.conformation_label')}}
                            </label>
                            <div class="col-md-9" data-name="CbjOHpSM">
                                <label class="control-label pull-right">{{trans('common.confirmed')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="dFcEVECw">
                            <label class="control-label col-md-3">{{trans('common.label.status')}}
                            </label>
                            <div class="col-md-9" data-name="ITYagUPM">
                                <label class="control-label pull-right">{{trans('common.label.active')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="vkylbRYl">
                            <label class="control-label col-md-3">{{trans('common.stats.bounced')}}</label>
                            <div class="col-md-9" data-name="PbwjYVIM">
                                <label class="control-label pull-right">{{trans('common.hard')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="cqgoRHcD">
                            <label class="control-label col-md-3">{{trans('common.stats.unsubscribed')}}
                            </label>
                            <div class="col-md-9" data-name="tMKhKLKk">
                                <label class="control-label pull-right">{{trans('common.yes')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="KxrwuBPD">
                            <span class="col-md-12 caption-subject">{{trans('library.index_blade.contact_information_span')}}</span>
                        </div>
                        <div class="form-group row" data-name="pihjPjPL">
                            <label class="control-label col-md-3">{{trans('library.index_blade.title_txt')}}</label>
                            <div class="col-md-9" data-name="EaLWFKWY">
                                <label class="control-label pull-right">{{trans('library.index_blade.shahbaz_name')}} {{trans('library.index_blade.mughal_name')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="gZmIvfbY">
                            <label class="control-label col-md-3">{{trans('library.index_blade.label_first_name')}}
                            </label>
                            <div class="col-md-9" data-name="FterkAaD">
                                <label class="control-label pull-right">{{trans('library.index_blade.shahbaz_name')}} </label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="xRKNqFmn">
                            <label class="control-label col-md-3">{{trans('library.index_blade.label_last_name')}} </label>
                            <div class="col-md-9" data-name="xRyfEvrj">
                                <label class="control-label pull-right">{{trans('library.index_blade.mughal_name')}} </label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="QFclxGuV">
                            <label class="control-label col-md-3">{{trans('library.index_blade.label_phone')}}</label>
                            <div class="col-md-9" data-name="fzQtILyi">
                                <label class="control-label pull-right">+923004497869</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="KuRQFzTQ">
                            <label class="control-label col-md-3">{{trans('library.index_blade.mobile_label')}}</label>
                            <div class="col-md-9" data-name="eNBDqZfb">
                                <label class="control-label pull-right"></label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="AsvtKXeI">
                            <label class="control-label col-md-3">{{trans('library.index_blade.company_label')}}</label>
                            <div class="col-md-9" data-name="NUzOZDhW">
                                <label class="control-label pull-right">{{trans('library.index_blade.hostings_house_label')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="srIWQSii">
                            <label class="control-label col-md-3">{{trans('library.index_blade.country_label')}}</label>
                            <div class="col-md-9" data-name="lHZlwpUI">
                                <label class="control-label pull-right">{{trans('library.index_blade.label_pakistan')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="EQIgXXfo">
                            <label class="control-label col-md-3">{{trans('library.index_blade.label_state')}} 
                            </label>
                            <div class="col-md-9" data-name="WDYWBsTh">
                                <label class="control-label pull-right">{{trans('library.index_blade.label_punjab')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="sEkSqwaa">
                            <label class="control-label col-md-3">{{trans('library.index_blade.label_city')}}</label>
                            <div class="col-md-9" data-name="BHfZhLHQ">
                                <label class="control-label pull-right">{{trans('library.index_blade.label_lahore')}}</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="bsHPGDqf">
                            <label class="control-label col-md-3">{{trans('library.index_blade.label_zip_code')}}
                            </label>
                            <div class="col-md-9" data-name="kuWYVgCH">
                                <label class="control-label pull-right">54000</label>
                            </div>
                        </div>
                        <div class="form-group row" data-name="KxxfabIZ">
                            <label class="control-label col-md-3">{{trans('library.index_blade.lead_source_label')}}</label>
                            <div class="col-md-9" data-name="rLTUbOCM">
                                <label class="control-label pull-right">PK</label>
                            </div>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade load-data-popup" id="load-data" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-name="BuUidNBu">
    <div class="modal-dialog modal-dialog-centered" role="document" data-name="SnVgBKZT">
        <div class="modal-content" data-name="PcWkBJMN">
            <div class="modal-header" data-name="iMfxxCge">
                <h5 class="modal-title" id="resultTitle">{{trans('library.index_blade.load_data_heading')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" data-name="hGkoLmZU">
                <div class="popup-first-blk mt-checkbox-list" data-name="FPPsCLqb">
                    <p>
                   {{trans('library.index_blade.dummy_random_txt')}}
                    </p>
                    <blockquote>
                        <p>
                            {{trans('library.index_blade.dummy_random_txt')}}
                        </p>
                    </blockquote>
                    <button type="button" class="btn btn-success btn-start" >{{trans('library.index_blade.button_start')}} </button>
                </div>
                <div class="load-data-spinner" data-name="WkGRuiTn">
                    <i class="fa fa-spinner fa-spin"></i>
                </div>
                <div class="popup-last-blk" data-name="RQDDTaeP">
                    <div class="alert alert-danger alert-bold load-data-msg" role="alert" style="display:none;" data-name="ycwYExvI">
                        <div class="alert-text" data-name="ZTEPokKE">{{trans('library.index_blade.unexpected_error_occurred_div')}}</div>
                    </div>
                    <div class="alert alert-success alert-bold load-data-msg-success" role="alert" style="display:none;" data-name="RWvXDAwi">
                        <div class="alert-text" data-name="QlTZhcqs">{{trans('library.index_blade.data_successfully_processed_div')}}</div>
                    </div>
                    <div class="table-block" data-name="oPBnEjrX">
                        <table id="load-data-table" class="table table-bordered table-responsive table-strip load-data-table">
                            <thead>
                                <tr>
                                    <th width="50">Sr.</th>
                                    <th width="150">{{trans('library.index_blade.record_td_txt')}}</th>
                                    <th width="50">{{trans('common.label.status')}}</th>
                                    <th width="200">{{trans('common.label.response')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="row_1">
                                    <td width="50">1</td>
                                    <td width="150">{{trans('library.index_blade.record_td_txt')}} 1</td>
                                    <td width="50">
                                        <i class="fa fa-spinner fa-spin fa-lg processings"></i>
                                    </td>
                                    <td width="200" class="resp_1">{{trans('library.index_blade.waiting_response_td')}}</td>
                                </tr>
                                <tr class="row_2">
                                    <td>2</td>
                                    <td>{{trans('library.index_blade.record_td_txt')}} 2</td>
                                    <td>
                                        <i class="fa fa-spinner fa-spin fa-lg processings"></i>
                                    </td>
                                    <td class="resp_2">{{trans('library.index_blade.waiting_response_td')}}</td>
                                </tr>
                                <tr class="row_3">
                                    <td>3</td>
                                    <td>{{trans('library.index_blade.record_td_txt')}} 3</td>
                                    <td>
                                        <i class="fa fa-spinner fa-spin fa-lg processings"></i>
                                    </td>
                                    <td class="resp_3">{{trans('library.index_blade.waiting_response_td')}}</td>
                                </tr>
                                <tr class="row_4">
                                    <td>4</td>
                                    <td>{{trans('library.index_blade.record_td_txt')}} 4</td>
                                    <td>
                                        <i class="fa fa-spinner fa-spin fa-lg processings"></i>
                                    </td>
                                    <td class="resp_4">{{trans('library.index_blade.waiting_response_td')}}</td>
                                </tr>
                                <tr class="row_5">
                                    <td>5</td>
                                    <td>{{trans('library.index_blade.record_td_txt')}} 5</td>
                                    <td>
                                        <i class="fa fa-spinner fa-spin fa-lg processings"></i>
                                    </td>
                                    <td class="resp_5">{{trans('library.index_blade.waiting_response_td')}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="popup-action-block" data-name="EWvKTiSs">
                        <span class="text-danger text-link text-underline cancel-processing">{{trans('library.index_blade.span_cancel_operation')}}</span>
                        <span class="text-grey processing-cancelled">{{trans('library.index_blade.operation_canceled_span')}}</span>
                        <button class="btn btn-secondary btn-sm pull-right popup-btn-close" data-dismiss="modal" aria-label="Close" onClick="window.location.reload();">{{trans('common.form.buttons.close')}}</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="integrats" tabindex="-1" role="dialog" aria-labelledby="integration" data-backdrop="static" data-keyboard="false" aria-hidden="true" data-name="pCLQzNeH">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document" data-name="McMGfKuP">
        <div class="modal-content" data-name="dVmUHiOS">
            <div class="modal-header" data-name="PHiJFGww">
                <h5 class="modal-title" id="responseFileName">laravel-2020-02-13 14:52:50.json (Response)</h5>
            </div>
            <div class="modal-body" data-name="OGaKQhel">
               <div class="" data-name="GdrGoFPn">
                    <textarea class="form-control m-input m-input--air pr-3 pl-3" readonly="" id="response" rows="10">{
    "signature": {
        "timestamp": "1581605569",
        "token": "91165d6b016cd01614cc59b4002eb6adad58c424110f68eed7",
        "signature": "ddbf5ccdc7c9aeb2bd8936937a366ca376d13f29d57020018b9198ee444e1bb3"
    },
    "event-data": {
        "severity": "temporary",
        "tags": [],
        "timestamp": 1581605569.783822,
        "storage": {
            "url": "https://sw.api.mailgun.net/v3/domains/mailgun.mumara.co/messages/AgEFxj4a3ZXMto4ATXBKvaxjSclGHSOJZA==",
            "key": "AgEFxj4a3ZXMto4ATXBKvaxjSclGHSOJZA=="
        },
        "recipient-domain": "yahoo.com",
        "id": "-J3X9szJSIORipdiSgxQhg",
        "campaigns": [],
        "reason": "generic",
        "user-variables": [],
        "flags": {
            "is-routed": false,
            "is-authenticated": true,
            "is-system-test": false,
            "is-test-mode": false
        },
        "log-level": "warn",
        "envelope": {
            "sending-ip": "198.61.254.60",
            "sender": "admin@mailgun.mumara.co",
            "transport": "smtp",
            "targets": "hh_test@yahoo.com"
        },
        "message": {
            "headers": {
                "to": "hh_test@yahoo.com",
                "message-id": "93d138c4aadbc1809e5b0b120e23f33f1@mailgun.mumara.co",
                "from": "Mailgun <admin@mailgun.mumara.co>",
                "subject": "drag and drop"
            },
            "attachments": [],
            "size": 23041
        },
        "recipient": "hh_test@yahoo.com",
        "event": "failed",
        "delivery-status": {
            "tls": true,
            "mx-host": "mta7.am0.yahoodns.net",
            "attempt-no": 3,
            "description": null,
            "session-seconds": 0.9402329921722412,
            "retry-seconds": 1800,
            "code": 421,
            "message": "4.7.0 [TSS04] Messages from 198.61.254.60 temporarily deferred due to user complaints - 4.16.55.1; see https://help.yahoo.com/kb/postmaster/SLN3434.html",
            "certificate-verified": true
        }
    }
}</textarea>
               </div>
            </div>
            <div class="modal-footer" data-name="kxuspHfd">
                <button type="button" class="btn btn-success" onclick="copy('response')">{{trans('library.index_blade.copy_clipboard_button')}}</button>
                <button id="dismiss_btn" type="button" class="btn btn-secondary" data-dismiss="modal">{{trans('common.form.buttons.close')}}</button>
            </div>
        </div>
    </div>
</div>

<div id="spam-score-modal" class="modal" tabindex="-1" role="dialog" aria-hidden="true" data-name="DzveqYRk">
    <div class="modal-dialog modal-lg" data-name="GHEKXNcQ">
        <div class="modal-content" data-name="fKhWrhxG">
            <div id="msg-group" class="display-hide" data-name="XlGrhCKd">
            <span id='msg-text-group'><span>
            </div>
            <div class="modal-header" data-name="gDgCeWBS">
                <h5 class="modal-title">{{trans('app.dashboard.lang.check_spam_score')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
            </div>
            <div class="modal-body" data-name="HjDvSUpS">
                <div class="alert alert-success" role="alert" data-name="rfVljwmW">
                    <div class="alert-text" data-name="upmAojcZ">
                        <h4 class="alert-heading">{{ trans('app.important.note') }}:</h4>
                        <p>{{ trans('app.campaigns.broadcasts.add.note_msg1') }}</p>
                        <p>{{ trans('app.campaigns.broadcasts.add.note_msg2') }}</p>
                    </div>
                </div>
                <table class="table">
                    <tr>
                        <th style="width: 50%; border-top: 0;">{{ trans('app.dashboard.lang.status') }}</th>
                        <td style="width: 50%; border-top: 0;" id="statusss"></td>
                    </tr>
                    <tr>
                        <th>{{ trans('app.dashboard.lang.score') }}</th>
                        <td id="scoreee"></td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer" data-name="xCarYFFS">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('app.dashboard.lang.close')}}</button>
            </div>
        </div>
    </div>
</div>

<script>
    editor = CKEDITOR.replace( 'content_html', {
        fullPage: true,
        allowedContent: true,
        height: 320
    });
    // enter work as <br> instead <p>
    CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;
    CKFinder.setupCKEditor( editor );
    CKEDITOR.config.extraPlugins = 'preview,font,colorbutton';
</script>
@endsection