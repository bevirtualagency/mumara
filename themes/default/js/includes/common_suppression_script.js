function ValidateSizes(file) {
        $("#FileSizeError").hide();
        var FileSize = file.files[0].size / 1024 / 1024; // in MB
        if (FileSize > max_file) {
           $("#FileSizeError").show();
        } else {
            uploadFile();
           
        }
    }
    function uploadFile(flag=0){
         var filename = $('#import-id').val().split('\\').pop();
            $("#customFile1").text(filename);
            $(".uploading-blk i.ups-check").hide();
            $("#cancel-pen,#import-id-error").hide();
            $("#import-id").addClass("pen");
            $("#import-file-selection").addClass("pen");
            $("#uploading-progress").css("width", "0%");
            $(".uploading-blk").show(1000);
           
            var formData = new FormData($('#suppression-frm')[0]);
            $.ajax({
              xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function(evt) {
                  if (evt.lengthComputable) {
                    $(".uploading-blk i.fa-spin").hide();
                     $(".uploading-blk .ups-counter").css("display", "inline-block");
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                      var elem = document.getElementById("uploading-progress");
                          elem.style.width = percentComplete + "%";
                        $(".uploading-blk .ups-counter>.count").html(percentComplete);
                    // if (percentComplete === 100) {

                    // }

                  }
                }, false);

                return xhr;
              },
               url: doUploadUrl,
               type: 'POST',
               async: true,
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
              success: function(result) {
                if(result.success){
                $("#FileSizeError").hide();
                var filename = $('#import-id').val().split('\\').pop();
                $("#customFile1").text(filename);
                $(".filename").text(result.file_name);
                $("#supsend").removeAttr("disabled");
                reset();
                    var selection = $('#import-file-selection').val();
                    var html='';
                    $.each(result.csv_data,function(i,val){
                     html+='<option value="'+i+'">'+val+'</option>'
                    });
                    $('#index').html(html);
                    if(selection == 'computer' || selection == 'folder'){
                        $('#index_wrap').show();
                    }else{
                        $('#index_wrap').hide();
                    }
                    $('#file_name').val(result.file_name);
                    $('#total_records').val(result.total_records);
                    // $('#import-id').val('');
                    if(flag==1){
                        $('#suppression-frm').submit();
                    }  

                }else{
                  $("#supsend").attr("disabled", "disabled");
                  $("#FileSizeError").text(result.msg);
                  $("#FileSizeError").show();
                }
                 $(".uploading-blk .ups-counter").hide();
                 $('#import-id').val('').removeAttr("required");
              },
              error: function (err) {
                $('.uploading-blk').hide();
                // Command: toastr["error"] (err.responseJSON.message);
                $("#supsend").attr("disabled", "disabled");
                $("#FileSizeError").text(result.msg);
                $("#FileSizeError").show();
                reset();
                }
            });

    }
    function reset(){
        $(".uploading-blk i.fa-spin").hide();
        $(".uploading-blk i.fa.fa-check").css("display", "inline-block");
        $("#cancel-pen").css("display", "inline-block");
        $("#import-id").removeClass("pen");
        $("#import-file-selection").removeClass("pen");
        $(".select2.select2-container").removeClass("pen");
        $("#select2-list-id-container").removeClass("pen");  
    }
    $("#supsend").attr("disabled", "disabled");

        $("#cancel-pen").click(function() {
            $(".blockUI").show();
            setTimeout(function() {
                $(this).hide();
                $(".uploading-blk i.ups-check").hide();
                $(".blockUI").hide();
                $(".uploading-blk").hide();
                $(".uploading-blk i.la-refresh").show();
                $("#import-id").removeClass("pen");
                $("#uploading-progress").css("width", "0%");
                $("#import-file-selection").removeClass("pen");
                $(".select2.select2-container").removeClass("pen");
                $("#select2-list-id-container").removeClass("pen");
                $("#import-id").val("");
                $("#customFile1").text("Choose file");
                $(".custom-file>label.custom-file-label").text("Choose file");
                $("#suppression-frm")[0].reset();
            }, 1000);
        });
        function checkFilesProcess(post_data){
         var xhr=$.ajax({
                url: csvSplitUrl,
                type: "POST",
                data: post_data,
                success: function (result) {
                     var obj = JSON.parse(result);
                     if(obj.imported_files < obj.total_files){
                         $.ajax(this);
                    }else{
                        $('.loading').addClass('usman').hide();
                        $("#ajax-spinner").hide();
                        $(".import-progress").hide(); 
                        xhr.abort();
                    }
                    progress = Math.round((obj.imported_files / obj.total_files) * 100);
                    $("#filesProgress").width(progress + '%').html(progress + '%');
                },
                error: function (result) {
                    $.ajax(this);
                }
         });
}
function gettingDuplicates(import_id,suppression_type,total,imported,rocket_speed,is_cancelled){
    $("tr#row3 td i.la-refresh").hide();
    $("tr#row3 td .counter").show(2000);
 var xhr=$.ajax({
        url: gettingDuplicatesUrl,
        type: "POST",
        data: {import_id:import_id,suppression_type},
        success: function (obj) {
             if(obj.is_complete == 0){ // Running request untill import is completed
               $.ajax(this);
            }
            if(!is_cancelled){
             $("tr#row3 td .counter .count").html(obj.progress);
             $("#progress3").width(obj.progress).html(obj.progress);
            }
           
            $("#duplicates_found").html(obj.duplicates);
            if(obj.is_complete == 1){
                xhr.abort();
                    //Hiding progress count and display check
                $("tr#row3 td .counter").hide();
                $("tr#row3 td i.fa-check").show(500);
                $("tr#row4 td i.la-refresh").hide();
                $("tr#row4 td .counter").show();
                setTimeout(function(){
                if(!is_cancelled){
                $("#invalid_found").html(obj.invalids);
                $("tr#row4 td .counter count").html(obj.progress);
                $("#progress4").width(obj.progress).html(obj.progress);
                 }
                
                $("tr#row4 td .counter").hide();
                $("tr#row4 td i.fa-check").show();
                end_Operation(total,imported,rocket_speed,is_cancelled); 
                if( parseInt(obj.duplicates) > 0){
                   $('tr#row3 td .result i').show();   
                }else{
                    $('tr#row3 td .result i').hide();
                }
                if(parseInt(obj.invalids) > 0){
                    $('tr#row4 td .result i').show();
                }else{
                    $('tr#row4 td .result i').hide();
                }
                },2000);
                 

            }
                
            
            
            
        },
        error: function (result) {
           $.ajax(this);
        }
 });
}

       var is_cancelled=0                      
    function checkImportProcess (file_no_import,rocket_speed) {
        $.ajax({
            async: true,
            url: checkImportProcessUrl,
            type: 'POST',
            data: {file_no_import:file_no_import,rocket_speed:rocket_speed},
            beforeSend: function () {
                $("form#suppression-frm input, form#suppression-frm textarea, form#suppression-frm select").addClass('pen');
                $("#progress-import,#import-result").show();
            },
            success: function(obj) {
                $("#label1").addClass("pen");
                $("#rocket-switch2").addClass("pen");
                $("#rocket-switch2").addClass("bg-clear");
                $(".select2.select2-container").addClass("pen");
                $("#select2-list-id-container").addClass("pen");
                $("a#cancel-pen").hide();
                $("#ajax-spinner").hide();
                $("#action-row").hide();
                $("#ajax-spinner-text").show();
                $(".import-progress").hide();
                $("#import-result").show();
                $("#list_name").html(obj.list_name);
                $(".filename").html($('#file_name').val());
                var total_records = parseInt(obj.total_records);
                var total_insert = parseInt(obj.total_insert);
                var duplicates = parseInt(obj.duplicates);
                var invalids = parseInt(obj.invalids);
                var file_no_import = obj.file_no_import;
                var imported = total_insert + duplicates + invalids;
                var total_import = imported - duplicates - invalids ;
                    total_import = total_import < 0 ? 0 : total_import;
                    duplicates = duplicates < 0 ? 0 : duplicates;
                    invalids = invalids < 0 ? 0 : invalids;
                    
                var duplicate_email_path = obj.temp_dir+'_duplicates.csv';
                var invalid_email_path =obj.temp_dir+'_invalids.csv';
                   
                    if(obj.rocket_speed=="true") {
                        progress = Math.round((total_insert / total_records) * 100);
                        $("#import-result").html("<div class='alert alert-warning alert-light alert-bold' role='alert' id='aborted'>"+import_operation_aborted+"</div>"+import_operation_success+"<table class='table table-striped table-hover table-checkable responsive'>"+
                             "<tr id='row1'><td width='36%'>"+total_records_label_rocket+":</td><td><span class='result'>"+total_records+"</span></td><td width='150px'><div class='myProgress' ><div class='bg-success' id='progress1' style='width:100%;'></div></div></td><td width='25%' class='action'><i style='display:inline-block;' class='fa fa-check text-success pro-check'></i><i class='fa fa-times text-danger pro-check'></i></td></tr>"+

                             "<tr id='row2'><td>"+imported_label_rocket+":</td><td><span class='result'>"+total_insert+"</span></td><td><div class='myProgress' ><div class='bg-success' id='progress2'></div></div></td><td class='action'><i class='la la-refresh fa-spin'></i><i class='fa fa-check text-success pro-check'></i><i class='fa fa-times text-danger pro-check'></i><span class='counter'><span class='count'>0%</span></span></td></tr>"+

                             "<tr id='row3'><td>"+duplicates_found_label_rocket+":</td><td><span class='result'><div id='duplicates_found' style='display: inline-block;'>"+duplicates+"</div>&nbsp;&nbsp;<a href='"+duplicate_email_path+"' ><i class='fa fa-download'></i></a></span></td><td><div class='myProgress' ><div class='bg-success' id='progress3'></div></div></td><td class='action'><i class='la la-refresh fa-spin'></i><i class='fa fa-check text-success pro-check'></i><i class='fa fa-times text-danger pro-check'></i><span class='counter'><span class='count'>0%</span></span></td></tr>"+

                              "<tr id='row4'><td>"+invalid_email_found_label_rocket+":</td><td><span class='result'><div id='invalid_found' style='display: inline-block;'>"+invalids+"</div>&nbsp;&nbsp;<a href='"+invalid_email_path+"'><i class='fa fa-download'></i></a></span></td><td><div class='myProgress' ><div class='bg-success' id='progress4'></div></div></td><td class='action'><i class='la la-refresh fa-spin'></i><i class='fa fa-check text-success pro-check'></i><i class='fa fa-times text-danger pro-check'></i><span class='counter'><span class='count'>0%</span></span></td></tr>"+

                              "<tr id='row5'><td></td><td></td><td><a href='javascript:;' id='cancel-import' onclick='cancelSuppression("+file_no_import+")' class='text-danger pull-right'>"+cancel_import+"</a></td><td>\
                              <a href='javascript:;' class='btn btn-info pull-right btn-sm' id='btn-close' data-dismiss='modal'>"+closeButtonLabel+"</a>\
                              <a href='javascript:;' class='btn btn-success pull-right btn-sm' id='success-close' data-dismiss='modal'>"+closeButtonLabel+"</a></td></tr>"+
                             "</table>");
                             $("tr#row2 td i.la-refresh").hide();
                             $("tr#row2 td .counter").show();
                             $("#progress2").width(progress + '%').html( progress + '%');
                             $("tr#row2 td .counter .count").html( progress + '%');
                       
                    } else {
                        
                        $("#import-result").html("<div class='alert alert-warning alert-light alert-bold' role='alert' id='aborted2'>"+import_operation_aborted+"</div>"+import_operation_success+"<div class='progress-block'><div class='myProgress full'><div class='bg-success' id='progress-simple'>0%</div></div><div class='prog-data'><i class='la la-refresh fa-spin'></i><span id='npc'>0%</span><i class='fa fa-check text-success pro-check'></i><i class='fa fa-times text-danger pro-check'></i></div></div><table class='table table-striped table-hover table-checkable responsive' id='simple-table'>"+
                         "<tr><td width='52%'>"+total_records_label_normal+":</td><td width='48%'><span>"+total_records+"</span></td></tr>"+
                         
                         "<tr><td>"+imported_successfuly_label+":</td><td><span>"+total_insert+"</span></td></tr>"+
                         
                         "<tr><td>"+duplicates_normal+":</td><td><span>"+duplicates+"</span> <a href='"+duplicate_email_path+"' class='download'><i class='fa fa-download'></i></a></td></tr>"+
                          
                          "<tr><td>"+invalids_label_normal+":</td><td><span>"+invalids+"</span> <a href='"+invalid_email_path+"' class='download'><i class='fa fa-download'></i></a></td></tr>"+

                          "<tr id='row5'><td></td><td><a href='javascript:;' id='cancel-import' onclick='cancelSuppression("+file_no_import+")' class='text-danger'>"+cancel_import+"</a><a href='javascript:;' class='btn btn-info pull-right btn-sm' id='btn-close' data-dismiss='modal'>"+closeButtonLabel+"</a><a href='javascript:;' class='btn btn-success pull-right btn-sm' id='success-close' data-dismiss='modal'>"+closeButtonLabel+"</a></td></tr>"+
                         "</table>");
                        progress = Math.round((imported / total_records) * 100);
                        $("#npc").text(progress + "%");
                        $("#progress-simple").css("width", progress + "%") .text(progress + "%");
                        if(progress>0){
                            $(".progress-block .prog-data i.la.la-refresh").hide();
                            $("#npc").show(); 
                        }else{
                            $("#npc").hide(); 
                        }
                        
                    }
                   
                    if (imported < total_records && obj.is_complete==0) {
                      var $this=this;
                      setTimeout(function(){
                        $.ajax($this);
                      },1000);
                    }
                    else{ 
                        $("tr#row2 td .counter").hide();
                        $("tr#row2 td i.fa-check").show(500); 
                        if(obj.rocket_speed=="true"){
                            gettingDuplicates(file_no_import,obj.suppression_type,total_records,total_import,obj.rocket_speed,is_cancelled)
                        }else{
                            end_Operation(total_records,total_import,obj.rocket_speed,is_cancelled); 
                            if( duplicates > 0){
                            $('#simple-table .download:eq(0)').show();   
                            }else{
                                $('#simple-table .download:eq(0)').hide();
                            }
                            if(invalids > 0){
                                $('#simple-table .download:eq(1)').show();
                            }else{
                                $('#simple-table .download:eq(1)').hide();
                            } 
                        }
                    }
            }
        });
        return false;
  }
  function end_Operation(total_records,total_import,rocket_speed,is_cancelled) {
    $("#total_alert").html(total_records);
    $("#imported").html(total_import);
        if(rocket_speed=="true"){
        if(is_cancelled==1){
            $("#import-result tr#row1 td .counter").hide(); 
            $("#import-result tr#row1 td .counter, #import-result tr#row2 td .counter, #import-result tr#row3 td .counter, #import-result tr#row4 td .counter").remove();
            $("tr#row2>td>i.fa-check, tr#row3>td>i.fa-check, tr#row4>td>i.fa-check").remove();
            $("#import-result tr td i.la-refresh").remove();
            $("#import-result tr#row2 td i.fa-times, #import-result tr#row3 td i.fa-times, #import-result tr#row4 td i.fa-times").show();
            $("#progress2 .myProgress>div, #progress3 .myProgress>div, #progress4 .myProgress>div").removeClass("bg-success");
            $(" #progress2, #progress3, #progress4").removeAttr("id");
            $("#ajax-spinner-text i.fa-spinner").remove();
            $("#ajax-spinner-text i.fa-check").remove();
            $("#ajax-spinner-text i.fa-times").show();
            $("#import-result td i.fa.fa-download").remove();
            $("#success-close").remove();
            $("#cancel-import").hide();
            $("#btn-close").show();
            $("#aborted").show();
        }else{
            $("table#simple-table a#cancel-import").hide();
            $("table#simple-table a#success-close").show();
            $("table#simple-table a.download").css("display", "inline-block");
            $("#resultbar2").show();
            $("#import-result td i.fa-download").css("display", "inline-block");
            $("#ajax-spinner-text i.fa-spinner").hide();
            $("#ajax-spinner-text i.fa-check").css("display", "inline-block");
            $("#success-close").show();
            $("#cancel-import").hide();
        }
    }else{
        if(is_cancelled==1){
        $(".progress-block .prog-data i.la.la-refresh").remove();
        $(".progress-block .prog-data i.fa-times").show();
        $("#ajax-spinner-text i.fa-spinner").remove();
        $("#ajax-spinner-text i.fa-check").remove();
        $("#ajax-spinner-text i.fa-times").show();
        // $("#import-result td i.fa.fa-download").remove();
        $("#success-close").remove();
        $("#cancel-import").hide();
        $("#btn-close").show();
        $("#npc").remove();
        $(".progress-block .prog-data i.fa.fa-check").remove(); 
        $("#aborted2").show();
        }else{
         $("#npc").hide();
         $(".progress-block .prog-data i.fa-check").show();
         $("#ajax-spinner-text i.fa-spinner").hide();
         $("#ajax-spinner-text i.fa-check").css("display", "inline-block");
         $("#success-close").show();
         $("#cancel-import").hide();
        }
        
    }
   $("#resultbar").css("display", "flex");
  }
  function cancelSuppression(file_no_import)
{
    $.ajax({
        url: cancelSuppressionUrl,
        type: 'POST',
        data: {file_no_import:file_no_import},
        beforeSend: function (result) {
           $(".blockUI").show();
        },
        success: function (result) {
            is_cancelled=1;
            setTimeout(function(){
            $(".blockUI").hide();
            },1000);
        }
    });
}
  function showHandleRocketSpeed(evt) {
    $('#info_msg_div').hide();


    if(evt.checked) {
        $("#loading").show();
        $.ajax({
            url: app_url+'/checkLocals',
            type: 'POST',
            data: {},
            success: function (result) {
                $("#loading").hide();
                const response = JSON.parse(result);
                console.log(response);
                let html = '';
                if(response.Value == 'ON'){
                    html = ``;
                    $('#info_msg_div2').html(html);
                    $('#info_msg_div').show();
                } else {
                    html = `
                        <div class="alert alert-danger alert-bold" role="alert">
                            <div class="alert-text">
                                `+local_infile_message+`
                            </div>
                        </div>
                    `;

                    $('#info_msg_div2').html(html);
                    $('#info_msg_div').show();
                    evt.checked = false;
                    evt.changed();
                    $('#info_msg_div2').html('');
                    $('#info_msg_div').hide();
                    
                }

            }
        });
    } 
}
function successProcess(result){
   if(result.success){
                var rocket_speed= $("#rocket-switch").prop("checked");
                if(!rocket_speed){
                    checkImportProcess(result.file_no_import,rocket_speed);
                    return false;  
                }
                var dir=$('#file_destination').val();
                var label=$('#label1').val();
                var data={
                  file_path:result.file,
                  dir:dir,
                  file_no_import:result.file_no_import,
                  index:result.index,
                  recored_insert_limit:result.recored_insert_limit,
                  file_no_import:result.file_no_import,
                  total_number_of_slices:result.total_number_of_slices,
                  label:label,
                  headers_include:result.headers_include,
                  suppression_type:result.suppression_type
                };
                 $.ajax({
                        url:csvSplitUrl,
                        type: "POST",
                        data: data,
                        beforeSend: function () {
                             var selection = $('#import-file-selection').val();
                             if(selection != 'email_input'){
                               var msg='<h6>\
                             '+preparing_file+'\
                             <div class="progress progress-striped active" >\
                                <div id="filesProgress" class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>\
                            </div>\
                             </h6>';
                            $(document).find("#js_msg").empty().html(msg);
                            $(".loading").show();
                            data.step=1;
                            checkFilesProcess(data); 
                             }
                             
                        },
                        success: function (res) {
                            if(res.success){
                                checkImportProcess(result.file_no_import,rocket_speed);
                            }else{
                                Command: toastr["error"] (res.msg);
                            }
                            $('.loading').addClass('usman').hide();
                        },
                        error: function (err) {
                             $('.loading').addClass('usman').hide();
                             $("#ajax-spinner").hide();
                             $(".import-progress").hide();
                             Command: toastr["error"] (err.responseJSON.message);
                        }
                    });
            }else{
                Command: toastr["error"] (result.msg);
            }
}

$("#folder-import-id").change(function() {
    if(this.value)
      uploadFile();

  });
  $("#import-file-selection").change(function() {
    $('#index_wrap').hide();
    var selection = $('#import-file-selection').val();
    if(selection == 'computer'){
        $(".computer").show();
        $(".folder").hide();
        $(".email_input").hide();
        $(".upCSV").css("display", "inline-flex");
        $(".slSRVR").hide();
        $(".wrEmail").hide();
        $("#supsend").attr("disabled", "disabled");
        $('.uploading-blk').hide();
        $('#rocket_speed_div').show();
        $("[name='email_input']").removeAttr("required");
    }else if(selection == 'folder'){
      $('#rocket_speed_div').show();
        $("#supsend").removeAttr("disabled");
        $("[name='email_input']").removeAttr("required");
        $(".folder").show();
        $(".computer").hide();
        $(".email_input").hide();
        $(".upCSV").hide();
        $(".slSRVR").css("display", "inline-flex");
        var file_name=$('#folder-import-id option:selected').val();
        $("#file_name").val(file_name);
        $(".file_name").val(file_name);
        $(".wrEmail").hide();
        if(file_name)
        uploadFile();
        
    }else if(selection == 'email_input'){
        // $('#index_wrap').hide();
        $('#rocket_speed_div').prop('checked',false).hide();
        $('[name="email_input"]').attr('required','required');
        $("#supsend").removeAttr("disabled");
        $(".email_input").show();
        $(".folder").hide();
        $(".computer").hide();
        $(".upCSV").hide();
        $(".slSRVR").hide();
        $(".wrEmail").css("display", "inline-flex");
        
    }
    // $("#import-result").hide();
    // $("#progress-import").hide();
  });

  $(document).on('click',"#supsend", function(){
         var selection = $('#import-file-selection').val();
         var email_input = $('[name="email_input"]').val();
         if(selection == 'email_input' && email_input !=''){
             uploadFile(1); // Functin written in email_suppression.js
         }else{
            $('#suppression-frm').submit();
         }

    });
    $("#delete_import_files").click(function () {
        var result = confirm(delete_all_files);
        var dir=$(this).data('dir');
        if (result) {
            $.ajax({
                url: app_url+'/delete-uploaded-files',
                type: "POST",
                data: {'_token': token,folder:dir},
                cache: false,
                dataType: 'json',
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function (data) {
                    if (data) {
                        if (data.status == 'success') {
                            Command: toastr["success"] (data.message);
                            location.reload();
                        }
                        else {
                            Command: toastr["error"] (data.message);
                        }
                    }

                }
            });
        }
    });