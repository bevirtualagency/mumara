var KTFormControls = function () {
    var add_subscriber = function () {
        var e = $("#subscriber-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
        e.validate({
            errorElement: "span",
            errorClass: "help-block help-block-error",
            focusInvalid: !1,
            ignore: "",
            rules: {
                // file_import: {
                //     required: !0
                // },
                list_id: {
                    required: true
                }
            },
            invalidHandler: function (e, t) {
                //i.hide(), r.show(), App.scrollTo(r, -200)
                Command: toastr["error"] (form_error);
                $('#msg').css("display", "flex");
                $('#msg-text').html(form_error);
                $('#msg').removeClass('display-hide').addClass('alert alert-danger ');
            },
            submitHandler: function (e) {
                //i.show(), r.hide(), e[0].submit()
                //r.hide(), e[0].submit()

                var action = $('#action').val();

                if (action == 'add') {
                    //alert("iiiiiiiiiiiiiiiii");
                    //return false;
                    var form_data = $("#subscriber-frm").serialize();
                    $.ajax({
                        url: app_url+'/contact',
                        type: "POST",
                        data: form_data,
                        beforeSend: function () {
                            $(".blockUI").show();
                        },
                        complete: function () {
                            $(".blockUI").hide();
                        },
                        success: function (result) {
                            console.log(result);
                            if (result.response == 'exit') {
                                $('#msg').css("display", "flex");
                                $('#msg-text').html(result.message);
                                $('#msg').removeClass('display-hide alert-success').addClass('alert alert-danger');
                                //$('#msg').delay(3000).hide('slow');
                            } else if (result == 'save_add') {
                                $('#msg').css("display", "flex");
                                $('#msg-text').html(result.message);
                                window.location = "/contact/add";
                            } else if (result == 'save_new') {
                                $('#msg').css("display", "flex");
                                $('#msg-text').html(result.message);
                                window.location = basae_url + '/contacts?list_id=' + $("#list-id").val()
                            } else {
                                $('#msg').css("display", "flex");
                                $('#msg-text').html('Subscriber successfully created!');
                                $('#msg').removeClass('display-hide alert-danger').addClass('alert alert-success');
                                //$('#msg').delay(3000).hide('slow');
                                if ($("#redirect_action").val() == 1 || $("#redirect_action").val() == '1') {
                                    window.setTimeout(function () {
                                        window.location = app_url+'/contacts?list_id=' + $("#list-id").val();
                                    }, 3000);
                                    return false;
                                } else if ($("#redirect_action").val() == 0 || $("#redirect_action").val() == '0') {
                                    $( '#subscriber-frm' ).each(function(){
                                        this.reset();
                                    });
                                } else {}

                            }


                        }
                    });
                } else if (action == 'edit') {
                    var id = $('#subscriber-id').val();
                    var form_data = $("#subscriber-frm").serialize();

                    $.ajax({
                        url: app_url+'/contact/' + id,
                        type: "PUT",
                        data: form_data,
                         beforeSend: function () {
                            $(".blockUI").show();
                        },
                        complete: function () {
                            $(".blockUI").hide();
                        },
                        success: function (result) {
                            if (result == 'save_add') {
                                window.location = app_url+"/contact/add"
                            } else if (result == 'edit') {
                                window.location = app_url+'/contact/' + id + '/edit';
                            } else if (result == 'save_new') {
                                window.location = basae_url + '/contact/add?list_id=' + $("#list-id").val();
                            } else {
                                window.location = app_url+"/contacts"
                            }
                        }
                    });
                    return false;
                } else if (action == 'import') {
                    // one field mapping must be an email
                    $('#btn-next').text('Please Wait...').attr('disabled','disabled');
                    var email_exist = false;
                    var sub_emails = [];
                    fields = [];
                    var indx = 0;
                    var fail = false;
                    var  date_keys=[];
                    var  date_values=[];
                    var file_fields=[];
                    var duplicateColumn = false;
                  $('.date_').each(function (index) {
                      txt = $(this).children(':selected').text();
                      id_i = this.id;
                      el = $('select[name=' + id_i +']');
                      val = el.val();
                      if(txt!=='None') {
                          date_values.push(val);
                          date_keys.push(id_i);
                      }
                    });
                    $('.custom-field-id').each(function (index) {
                        cf_val = $(this).val();
                        file_field_id = '#cf_'+cf_val;
                        ff_val = $(file_field_id).val();
                            fields[index] = ff_val;
                            $("#sub-emails").val(fields);
                    });
                    $('.file_field_id').each(function (index) {
                        ff_val = $(this).val();
                        if(ff_val!=='' && ff_val!=='None')
                        {
                            if(jQuery.inArray( ff_val, file_fields )!==-1)
                            {
                               duplicateColumn = true;
                            }
                            file_fields[index]= ff_val;
                        }
                    });
                    email_exist = true;
                    if (!email_exist) {
                        $('#msg').css("display", "flex");
                        $('#msg-text').html(import_error);
                        $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                        $('#btn-next').text('Next').prop('disabled',false);
                        return;
                    }
                    else if(duplicateColumn)
                    {
                        toastr.error('Duplicate Column Selection');
                        $('#btn-next').text('Next').prop('disabled',false);
                        return;
                    }
                    else {
                        $('#msg').removeClass('display-hide alert-danger');
                    }
                    var form_data = $("#subscriber-frm").serialize();

                    file_name = $("input[name=file_name]").val();
                    $('#import-id').val('').removeAttr("required");

               $.get(app_url+"/contacts/import", {file_name: file_name})
                            .done(function (total_records) {
                                line_no = 0;
                                headers_include = $("input[name=headers_include]").val();
                                if (headers_include == '1') {
                                    //line_no = 0;
                                    total_records = total_records - 1;
                                }
                                var import_type = "normal";
                                var show_files_progress = true;
                                var rocket_speed = $("input[name=rocket_speed]").val();
                                
                                if (rocket_speed == '1') {
                                    import_type = 'rocket_import';
                                } 
   

                                 var post_data = form_data + "&line_no=" + line_no + "&total_records=" + total_records + '&total_insert=0&total_updated=0&duplicate_found=0&invalid_email=0&date_values=' +date_values +'&date_keys='+date_keys+'&is_rocket_on=false&terminator=,&filenames=[]&slices=0&limit=0&deleted=0';
                                 $.ajax({
                                    url: app_url+'/contacts/import',
                                    type: "POST",
                                    data: post_data+'&createImport=1',
                                    success: function (result) {
                                    var obj = JSON.parse(result);
                                    if(obj.error){
                                        $('#aborted').removeClass('alert-warning').addClass('alert-danger').text(obj.error).css('display','flex');
                                        return;
                                     }
                                    importSubscriber(form_data, line_no, total_records, 0, 0, 0, 0, obj.file_no_import,date_values,date_keys, false, ",", [],obj.total_number_of_slices,0,0,show_files_progress,import_type,obj.error);
                                    
                                    },
                                    error: function () {
                                         $('.loading').addClass('usman').hide();
                                         $("#ajax-spinner").hide();
                                         $(".import-progress").hide();
                                        alert('Something Went Wrong');
                                    }
                             });
    
                                
                               
                            }).fail(function (jqXHR, textStatus) {
                                $('#btn-next').text('Next').prop('disabled',false);
                            });

                } else {
                    r.hide(), e.submit();
                }
            }
        })
    };
    return {
        init: function () {
            add_subscriber()
        }
    }
}();
jQuery(document).ready(function () {
    KTFormControls.init();

    // if click edit first time for subscriber
    if ($('#action').val() == 'edit') {
        var list_id = $('#list-id').val();
        var subsbriber_id = $('#subscriber-id').val();

        if (list_id == '') {
            $('#custom-fields-data').html('');
        } else {
            $.ajax({
                url: app_url+'/contact/custom/fields/' + list_id,
                type: "GET",
                data: {action: "edit", "subscriber_id": subsbriber_id},
                success: function (result) {
                    $('#custom-fields-data').html(result);
                }
            });
        }
    }

    $('#import-id').on('change', function () {
        const import_id = document.getElementById("import-id");
        var filename = import_id.files[0] !== undefined && import_id.files[0].name;
        $("#importIdLabel").html(filename);

    });
    $('#folder-import-id').on('change', function () {
        $('#js_file_name').val($("#folder-import-id option:selected").val());
        if(this.value !='')
            $('#next-btn').prop('disabled',false);
    });
    $('#import-file-selection').on('change', function () {
        var import_file_selection = $('#import-file-selection').val();
        if (import_file_selection == 'computer') {
            $("#file-from-computer").show();
            $("#file-from-folder").hide();
            $("#import-id").attr("required", "required");
            $("#import-id").removeAttr("disabled", "disabled");
            $("#folder-import-id").attr("disabled", "disabled");
            $("#folder-import-id").removeAttr("required");
            $(".uploading-blk").hide();
            $("#import-id").val('').prop('required',true);
            $("#importIdLabel").html('Choose File');

        } else {
            $("#file-from-folder").show();
            $("#file-from-computer").hide();
            $("#folder-import-id").attr("required", "required");
            $("#import-id").removeAttr("required");
            $("#folder-import-id").removeAttr("disabled", "disabled");
            $("#import-id").attr("disabled", "disabled");
            $("#import-id").val('').prop('required',false);
            
        }
    });

    // when user select a list
    $('#list-id').on('change', function () {
        loadListCustomField();
    });
    $("#delete_import_files").click(function () {
        var result = confirm(delete_all_files+"?");
        if (result) {
            $.ajax({
                url: app_url+'/delete-uploaded-files',
                type: "POST",
                data: {'_token': token,folder:"imports/subscribers"},
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
                            $('#msg').removeClass('display-hide alert-danger').addClass('alert alert-success ');
                            $('#msg').delay(3000).hide('slow');
                            location.reload();
                        }
                        else {
                            $('#msg').removeClass('display-hide alert-success').addClass('alert alert-danger ');
                            $('#msg').delay(3000).hide('slow');
                        }
                        $('#msg-text').html(data.message);
                        $('#msg').css("display", "flex");
                    }

                }
            });
        }
    });

});

function loadListCustomField() {
    var list_id = $('#list-id').val();
    if (list_id == '') {
        $('#custom-fields-data').html('');
    } else {
        $.ajax({
            url: app_url+'/contact/custom/fields/' + list_id,
            type: "GET",
            data: {action: "add"},
            success: function (result) {
                $('#custom-fields-data').html(result);
            }
        });
    }
}

loadListCustomField();

function renderLoader(){
    return `<div class="loading" id="loading" style=""><div class="loader"></div></div>`;
}

function parseJson(res) {
    try {
        // try to pase the it to json
        return JSON.parse(res);
    } catch (e) {
        try{
            // If string could not parse it to JSON,
            // Search currly braces in the string data and try parsing it to JSON Object.
            const response = res.match(/{([^}]+)}/);
            return JSON.parse(response[0]);
        }catch(e){
            // if that attempt fails send an empty object;
            return {};
        }
    }
}
function checkFilesProcess(post_data,import_type){
 var xhr=$.ajax({
        url: app_url+'/contacts/import',
        type: "POST",
        data: post_data+'&step=1'+'&import_type='+import_type,
        success: function (result) {
             var th=this;
             var obj = JSON.parse(result);
             if(obj.imported_files < obj.total_files){
                 // $.ajax(this);
                  setTimeout(function(){
                  $.ajax(th);
                },2000);
            }else{
                $('.loading').addClass('usman').hide();
                $("#ajax-spinner").hide();
                $(".import-progress").hide(); 
                $('#import-result').show();
                xhr.abort();
            }
            progress = Math.round((obj.imported_files / obj.total_files) * 100);
            $("#filesProgress").width(progress + '%').html(progress + '%');
        },
        error: function (result) {
            var th=this;
             setTimeout(function(){
                  $.ajax(th);
                },2000);
        }
 });
}
function checkDuplicates(post_data,list_id,import_id,total,imported,import_cancel){
    $("span.counter2").hide();
    $("#removing_duplicates_row").show();
    $("#removing_duplicates_row i.check3").hide();
    $("#removing_duplicates_row .zero3").hide();
    $("#removing_duplicates_row span.waiting3").hide();
    
    $("#invalid_row i.check4").hide();
    $("#invalid_row .counter4").show();
    $("#removing_duplicates_row .counter3").show();
    $("#duplicate_count_progress").show();
 var xhr=$.ajax({
        url: app_url+'/checkDuplicates',
        type: "GET",
        total:total,
        import_cancel:import_cancel,
        data: post_data+'&list_id='+list_id+"&import_id="+import_id,
        success: function (obj) {
            var th=this;
             if(obj.is_complete == 0){ // Running request untill import is completed
                setTimeout(function(){
                  $.ajax(th);
                },2000);
            }
            $("#removing_duplicates_row #duplicate_count_progress").html(obj.progress);
            $("#progressbar3").width(obj.progress).html(obj.progress);
            $("#duplicates_found").html(obj.duplicates);
            if(this.import_cancel==1)
            $('#aborted').css('display','flex');
            var imported = obj.imported;
                imported = (imported - obj.duplicates);
                imported = imported < 0 ? 0:imported;   
            
            
            $("#total_alert").html(this.total);
            $("#imported_alert").html(imported);
             if(imported ==1 ){
                $('#grammar').html('was');
            }
            if(obj.is_complete == 1){
                xhr.abort();
                    //Hiding progress count and display check
                $("#removing_duplicates_row i.check3").fadeIn();
                $("#removing_duplicates_row .counter3").hide();
                setTimeout(function(){
                $("#invalid_row span.waiting4").hide();
                $("#invalid_found").html(obj.invalids);
                $("#invalid_found_percent").html(obj.progress);
                $("#invalid_progress_bar").width(obj.progress).html(obj.progress);
                $("#invalid_row .counter4").hide();
                $("#import-result i.check4").fadeIn();
                $("#ajax-spinner-text i.fa.fa-spinner").hide();
                $("#ajax-spinner-text i.fa.fa-check").css("display", "inline");
                if( parseInt(obj.duplicates) > 0)
                $('#download-duplicates i').show();
                if(parseInt(obj.invalids) > 0)
                $('#download-invalid i').show();
                $("#cancel_div").hide();
                $("#view-contacts").attr('href',obj.listContacts);
                $("#view-contacts").show();
                $("#resultbar").css("display", "flex");
                },2000);
                 

            }
                
            
            
            
        },
        error: function (result) {
           $.ajax(this);
        }
 });
}
function importSubscriber(form_data, line_no, total_records, total_insert, total_updated, duplicate_found, invalid_email, file_no_import,date_values=[],date_keys=[], is_rocket_on=false, terminator=",", filenames=[],slices=0,limit=0,deleted=0,show_files_progress,import_type,error='') {
   
    var post_data = form_data + "&line_no=" + line_no + "&total_records=" + total_records + "&total_insert=" + total_insert + "&total_updated=" + total_updated +
        "&duplicate_found=" + duplicate_found + "&invalid_email=" + invalid_email + "&file_no_import=" + file_no_import +'&date_values=' +date_values +
        '&date_keys='+date_keys+'&is_rocket_on='+is_rocket_on+'&terminator='+terminator+'&filenames='+filenames+'&slices='+slices+'&limit='+limit+'&deleted='+deleted;
$(document).find('#total_contacts_js').html(total_records);
    if ($(".usman")[0]){
        $(".loading").show();
    }
    if(show_files_progress){
      // Files spliting check
        checkFilesProcess(post_data,import_type);    
    }
       
     $.ajax({
        url: app_url+'/contacts/import',
        type: "POST",
        data: post_data,
        beforeSend: function () {
            $('#btn-next').text('Next').attr('disabled','');
            $("#mapping-data-id").hide();
            $("#progress-import").show();
            // var msg='<h6>Waiting for the process to start, please hold!</h6>';
             var msg='<h6>\
             '+preparing_file+'\
             <div class="progress progress-striped active" >\
                <div id="filesProgress" class="progress-bar bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">0%</div>\
            </div>\
             </h6>';
            $(document).find("#js_msg").empty().html(msg);
        },
        success: function (result) {
             $('#import-result').show();
            $(document).find("#js_msg").empty();
             var duplicates_selection = $("input[name=duplicates]").val();
            var obj = parseJson(result);
            line_no = obj.line_no;
            total_insert = parseInt(obj.total_insert);
            total_updated = parseInt(obj.total_updated);
            duplicate_found = parseInt(obj.duplicate_found);
            var overwritten = parseInt(obj.overwritten);
            invalid_email = parseInt(obj.invalid_email);
            file_no_import = obj.file_no_import;
            rocket_speed = obj.rocket_speed ? obj.rocket_speed : false;
            // Hide summary in case of rocket import
            // var style=(import_type=="rocket_import") ? "display:none;":"display:block;";

            user_id = obj.user_id;
            var imported = total_insert + duplicate_found + invalid_email+ overwritten;
            var total_import = imported - duplicate_found - invalid_email - overwritten;
            total_import = total_import < 0 ? 0 : total_import;
            duplicate_found = duplicate_found < 0 ? 0 : duplicate_found;
            invalid_email = invalid_email < 0 ? 0 : invalid_email;
             progress = Math.round((total_insert / total_records) * 100);
             var label=(duplicates_selection=="overwrite") ? "Overwritten":(duplicates_selection=="update") ? "Updated":duplicates_label;
             if(rocket_speed==1) {
            // Total row in case of rocket import
            $(document).find('#total_contacts_js').html(total_records);
            $(document).find('#total_imported_js').html(total_import);
            // Importing  row in case of rocket import
            $("#importing_contacts_row i.check2,#importing_contacts_row span.waiting2").hide();
            $("#importing_contacts_row .counter2").show();
            $("#importing_contacts_row .count2").css("display", "inline-block");
            $("#total_imported_js").html(total_import);
            $("#importing_contacts_row #progress_count").html(progress);
            $("#progressbar2").width(progress + '%').html(progress + '%');
             total_import = (duplicates_selection =="skip" || duplicates_selection=="overwrite") ? (duplicate_found + total_import):total_import;
           }else{
             duplicate_found = (duplicates_selection=="skip") ? duplicate_found:overwritten;
             // total_import = (duplicates_selection=="overwrite") ? (duplicate_found + total_import):total_import;
             progress = Math.round((imported / total_records) * 100);
           }

                
            if (imported < total_records && obj.import_cancel==0 && !obj.error) {
                $('.loading').removeClass('usman').hide();
                $("#cancel_div").html('<a href="javascript:;" style="float: none;"  onclick="cancelImport('+file_no_import+',0)" class="text-danger pull-right">'+cancel_import_label+'</a>');
                if(rocket_speed==0) {
                $("#import_progress_bar").width(progress + '%').html(progress + '%');
                $(".import-progress").html("No of Records Processed: " + line_no);
                $("#normal_import").show();
                var table="<table class='table table-hover table-striped table-result'><tbody>" +
                "<tr><td width='50%'>"+total_records_label+":</td><td width='50%''>" + total_records + "</td></tr>" +
                "<tr><td width='50%'>"+imported_label+":</td><td width='50%''>" +  total_import + "</td>";

                var summary="<tr class='summary'><td width='50%'>"+label+":</td><td id='duplicates_found1' width='50%''>" + duplicate_found + "</td>" +
                "<tr class='summary'><td width='50%'>"+invalids_label+":</td><td id='invalid_found1'  width='50%''>" + invalid_email + "</td>";
                table+=summary;
                table+='<tr><td></td><td><a href="javascript:;" style="float: none;" onclick="cancelImport('+file_no_import+',0,1)"  class="text-danger">'+cancel_import_label+'</a></td></tr>';
                table+="</tbody></table>";
                $("#normal_import").html(table);
                }
            setTimeout(function(){
                 importSubscriber(
                                form_data,
                                line_no,
                                total_records,
                                total_insert,
                                total_updated,
                                duplicate_found,
                                invalid_email,
                                file_no_import,
                                [],
                                [],
                                rocket_speed,
                                obj.field_terminator,
                                obj.file_names,
                                obj.slices,
                                obj.record_insert_limit,
                                obj.affected, // deleted rows count,
                                0,
                                import_type,
                                obj.error
                            );
                },2000);
               
            }
            else {
                var download_duplicates_link='/downloadCSV?p=storage/users/' + user_id + "/files/imports/subscribers/" + obj.file_no_import + "/"+file_no_import+"_duplicates_emails.csv";
                var download_invalid_link="/downloadCSV?p=storage/users/" + user_id + "/files/imports/subscribers/" + obj.file_no_import + "/"+file_no_import+"_invalid.csv";
                if(rocket_speed==1) {
                $("#cancel_div").hide();
                $('#download-duplicates').attr('href',download_duplicates_link);
                $('#download-invalid').attr('href',download_invalid_link);
                $('#view-contacts').attr('href',+obj.listContacts);
                //Hiding progress count and display check in case of rocket import
                $("#importing_contacts_row i.check2").fadeIn();
                $("#importing_contacts_row .counter2").hide();
                }

                $('.loading').addClass('usman').hide();
                $("#ajax-spinner").hide();
                $(".import-progress").hide();
                if(obj.import_cancel==0){
                    $("#import_progress_bar").width(100 + '%').html(100 + '%');
                    if(rocket_speed) {
                    // 100% In case of rocket import
                    $("#progressbar2").width(100 + '%').html(100 + '%');
                    $("#importing_contacts_row #progress_count").html(100);
                   }
                }
               
                if(rocket_speed==0) {
                // const duplicate_download_tag = rocket_speed ? "" : "&nbsp;&nbsp;<a href='/storage/users/" + user_id + "/files/imports/subscribers/" + obj.list_id + "_duplicates_emails.csv'><i class='fa fa-download'></i></a>";
                const duplicate_download_tag = duplicate_found ? "&nbsp;&nbsp;<a href="+download_duplicates_link+"><i class='fa fa-download'></i></a>":'';
                const invalid_download_tag   = invalid_email ? "&nbsp;&nbsp;<a href="+download_invalid_link+"><i class='fa fa-download'></i></a>":'';
                // total_records;
                $("#normal_import").show();
                $("#normal_import").html("<table class='table table-hover table-striped table-result'><tbody>" +
                        "<tr><td width='50%'>"+total_records_label+":</td><td width='50%''>" + total_records + "</td>" +
                        "<tr><td width='50%'>"+imported_label+":</td><td width='50%''>" + total_import + "</td>" +
                        "<tr class='summary' class='summary'><td width='50%'>"+label+":</td><td width='50%''>" + duplicate_found + duplicate_download_tag +"</font></td>" +
                        "<tr class='summary' class='summary'><td width='50%'>"+invalids_label+":</td><td width='50%''>" + invalid_email+invalid_download_tag+"</font></td>" +
                        "<tr class='summary' class='summary'><td></td><td><a  style='float: none;'  href='"+obj.listContacts+"'><button type='button' style='float: none;' name='save_add' class='btn btn-success btn-sm pull-right' value='View Contacts'>"+view_contacts_label+"</button></a></td></tr>"+
                        "</tbody></table>");
                $.ajax({
                    url: app_url+'/contact/cleanUp',
                    type: 'POST',
                    data: {list_id: obj.list_id, duplicates: obj.duplicates},
                    success: function (result) {
                        console.log(result)
                    }
                });
            }
             $("#resultbar .alert-text").css("display", "block");
            if(import_type !="rocket_import"){
                if(obj.import_cancel==1)
                $('#aborted').css('display','flex');
                $("#total_alert").html(total_records);
                $("#imported_alert").html(total_import);
                if(total_import ==1 ){
                    $('#grammar').html('was');
                }
                 if(duplicates_selection=="update")
                $("#updated_alert").html("&nbsp;and <b>"+overwritten+"</b>&nbsp;contacts&nbsp;were&nbsp;updated&nbsp;");
                $("#resultbar").css("display", "flex");
                $("#ajax-spinner-text i.fa.fa-spinner").hide();
                $("#ajax-spinner-text i.fa.fa-check").css("display", "inline"); 
            }
            
            $('#action,#file_name_js').val('');
                if(rocket_speed ) {
                 // Check duplicate removing process
                checkDuplicates(post_data,obj.list_id,file_no_import,total_records,total_import,obj.import_cancel, obj.error);
               }
               if(obj.hasOwnProperty("error") && obj.error){
                $('#aborted').removeClass('alert-warning').addClass('alert-danger').text(obj.error).css('display','flex');
               }
            }
        },
        error: function () {
            $.ajax(this);
        }
    });
           
       
    
   
}

function in_array(needle, haystack) {
    for(var i in haystack) {
        if(haystack[i] == needle) return true;
    }
    return false;
}

function showHandleRocketSpeed(evt) {
    $('#info_msg_div').hide();


    if(evt.checked) {
        $("#loading").show();
        $.ajax({
            url: app_url+'/checkLocals',
            type: 'POST',
            data: {"_token": token},
            success: function (result) {
                sleep(1000);
                $("#loading").hide();
                const response = JSON.parse(result);
                console.log(response);
                if(response.Value == 'ON'){
                    // Command: toastr["success"] ("Success message here.");

                    $('#threads_div').hide();
                    $("#select_duplicate_id option[value='update']")
                        .attr("disabled", "disabled")
                        .siblings()
                        .removeAttr("disabled");

                    $('#info_msg_div').hide();
                    // $('#next-btn').prop('disabled',false);
                } else {
                   $("#select_duplicate_id option[value='update']").removeAttr("disabled");

                    $('#next-btn').prop('disabled',true);
                    $('#info_msg_div').show();

                    setTimeout(function(){
                        evt.checked = false;
                        evt.changed();
                        $('#info_msg_div').hide();
                    }, 3000);

                }

            }
        });
        $("#updateOption").hide();
    } else {
        $('#threads_div').show();
        $("#select_duplicate_id option[value='update']").removeAttr("disabled");
        $("#updateOption").show();
    }
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function setLocalInfile(btn){
    btn.innerText = 'Please wait...';
    btn.disabled = true;
    $.ajax({
        url: app_url+'/setLocals',
        type: 'POST',
        data: {},
        success: function (result) {
            btn.disabled = false;
            const response = JSON.parse(result);
            console.log(response);
            let html = '';
            if(response.Value == 'ON'){
                html = '<span id="info_msg_label">This option only supports importing Email Addresses. If your file has additional fields then this option may not be suitable for you.</span>';
            } else {
                html = `<span id="info_msg_label">No Local Infile found. click on the button to try to activate.</span>
                <button type="button" class="btn btn-primary btn-xs" id="set_locals_infile" onclick="setLocalInfile(this)">Activate</button>`;
            }
            $('#info_msg_div2').html(html);
            $('#info_msg_div').show();
        }
    });
    console.log(btn);
}

function sleep(milliseconds) {
    var start = new Date().getTime();
    for (var i = 0; i < 1e7; i++) {
        if ((new Date().getTime() - start) > milliseconds){
            break;
        }
    }
}