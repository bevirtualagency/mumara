// this function is to accept only email
jQuery.validator.addMethod("validEmail", function(value, element, param) {
    return value.match(/^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/);
},'Please enter a valid email');
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
                email: {
                    required: !0,
                    validEmail: !0,
                },
                list_id: {
                    required: true
                },
                'lists[]': {
                    required: !0,
                }
            },
            invalidHandler: function (e, t) {
                //i.hide(), r.show(), App.scrollTo(r, -200)



                Command: toastr["error"] ("You have some form errors. Please check below.");
                $('#msg').css('display', 'flex');
                $('#msg-text').html(form_error);
                $('#msg').removeClass('display-hide').addClass('alert alert-danger');
            },
            submitHandler: function (e) {
                //i.show(), r.hide(), e[0].submit()
                //r.hide(), e[0].submit()

                var action = $('#action').val();

                if (action == 'add') {
                    //alert("iiiiiiiiiiiiiiiii");
                    //return false;
                  //  var form_data = $("#subscriber-frm").serialize();
                    var disabled = $('#list-id').is(':disabled');
                    $('#list-id').prop("disabled", false);
                    $.ajax({
                        url: app_url+'/contact',
                        type: "POST",
                        data: $("#subscriber-frm").serialize(),
                        beforeSend: function () {
                            $(".blockUI").show();

                        },
                        complete: function () {
                            $(".blockUI").hide();
                            if (disabled) {
                                $('#list-id').prop("disabled", true);
                            }
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
                                list_id = $("#list-id").val();
                                window.location = addToList.replace('|id|',list_id);
                            } else if (result == 'save_new') {
                                $('#msg').css("display", "flex");
                                $('#msg-text').html(result.message);
                                list_id = $("#list-id").val();
                                window.location = addToList.replace('|id|',list_id);
                            } else {
                                $('#msg').css("display", "flex");
                                $('#msg-text').html('Subscriber successfully created!');
                                $('#msg').removeClass('display-hide alert-danger').addClass('alert alert-success ');
                                //$('#msg').delay(3000).hide('slow');
                                if ($("#redirect_action").val() == 1 || $("#redirect_action").val() == '1') {
                                    window.setTimeout(function () {
                                        list_id= $("#list-id").val();
                                        window.location = listContacts.replace('|id|',list_id);
                                    }, 2000);
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
                        url: updateUrl + id,
                        type: "PUT",
                        data: form_data,
                         beforeSend: function () {
                            $(".blockUI").show();
                        },
                        complete: function () {
                            $(".blockUI").hide();
                        },
                        success: function (result) {
                            if(result == "error") { 
                                Command: toastr["error"] ("Email already exist!");
                                $(".blockUI").hide();
                                return false;
                            } else if (result == 'save_add') {
                                window.location = createUrl;
                            } else if (result == 'edit') {
                                str = editUrl;
                                editUrl= str.replace('|id|',id);
                                window.location = editUrl;
                            } else if (result == 'save_new') {
                                list_id = $("#list-id").val();
                                window.location = addToList.replace('|id|',list_id);
                            } else {
                                window.location = indexUrl;
                            }
                        }
                    });
                    return false;
                }
                else if (action == 'import') {
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
                        file_field_id = '#'+cf_val;
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
                        return;
                    }
                    else if(duplicateColumn)
                    {
                        toastr.error('Duplicate Column Selection');
                        return;
                    }
                    else {
                        $('#msg').removeClass('display-hide alert-danger');
                    }
                    var form_data = $("#subscriber-frm").serialize();

                    file_name = $("input[name=file_name]").val();

               $.get(app_url+"/contacts/import", {file_name: file_name})
                            .done(function (total_records) {
                                // console.log('checking import2', total_records)
                                //line_no = 1;
                                line_no = 0;
                                headers_include = $("input[name=headers_include]").val();
                                if (headers_include == '1') {
                                    //line_no = 0;
                                    total_records = total_records - 1;
                                }
                                // initial values
                                // importSubscriber(form_data, line_no, total_records, total_insert, total_updated, duplicate_found, invalid_email, file_no_import)
                                // $('#btn-next').text('Please Wait...').attr('disabled','disabled');
                                importSubscriber(form_data, line_no, total_records, 0, 0, 0, 0, 1,date_values,date_keys);
                            });

                } else {
                    r.hide(), e[0].submit();
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
    $('#import-file-selection').on('change', function () {
        var import_file_selection = $('#import-file-selection').val();
        if (import_file_selection == 'computer') {
            $("#file-from-computer").show();
            $("#file-from-folder").hide();
            $("#import-id").attr("required", "required");
            $("#folder-import-id").removeAttr("required");
        } else {
            $("#file-from-folder").show();
            $("#file-from-computer").hide();
            $("#folder-import-id").attr("required", "required");
            $("#import-id").removeAttr("required");
        }
    });

    // when user select a list
    $(document).on('change','#list-id', function () {
        loadListCustomField();
    });
    $("#delete_import_files").click(function () {
        var result = confirm("Are you sure want to delete all uploaded files");
        if (result) {
            $.ajax({
                url: app_url+'/delete-uploaded-files',
                type: "POST",
                data: {'_token': token},
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
                        }
                        else {
                            $('#msg').removeClass('display-hide alert-success').addClass('alert alert-danger');
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
            beforeSend: function () {
                $(".blockUI").show();
            },
            complete: function () {
                $(".blockUI").hide();
            },
            success: function (result) {
                $('#custom-fields-data').html(result);
            }
        });
    }
}
if ($('#action').val() == 'add') {
    loadListCustomField();
}

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

function importSubscriber(form_data, line_no, total_records, total_insert, total_updated, duplicate_found, invalid_email, file_no_import,date_values=[],date_keys=[], is_rocket_on=false, terminator=",", filenames=[],slices=0,limit=0,deleted=0 ) {

    const post_data = form_data + "&line_no=" + line_no + "&total_records=" + total_records + "&total_insert=" + total_insert + "&total_updated=" + total_updated +
        "&duplicate_found=" + duplicate_found + "&invalid_email=" + invalid_email + "&file_no_import=" + file_no_import +'&date_values=' +date_values +
        '&date_keys='+date_keys+'&is_rocket_on='+is_rocket_on+'&terminator='+terminator+'&filenames='+filenames+'&slices='+slices+'&limit='+limit+'&deleted='+deleted;

    if ($(".usman")[0]){
        $(".loading").show();
    }

    $.ajax({
        url: app_url+'/contacts/import',
        type: "POST",
        data: post_data,
        beforeSend: function () {
            $('#btn-next').text('Next').attr('disabled','');
            $("#mapping-data-id").hide();
            $("#progress-import").show();
        },
        success: function (result) {
            var obj = parseJson(result);
            line_no = obj.line_no;
            total_insert = obj.total_insert;
            total_updated = obj.total_updated;
            duplicate_found = obj.duplicate_found;
            invalid_email = obj.invalid_email;
            file_no_import = obj.file_no_import;
            rocket_speed = obj.rocket_speed ? obj.rocket_speed : false;

            user_id = obj.user_id;
            var total_import = parseInt(obj.total_insert) - parseInt(obj.duplicate_found) - parseInt(obj.invalid_email);
            total_import = total_import < 0 ? 0 : total_import;

            if (line_no < total_records) {
                $('.loading').removeClass('usman').hide();
                progress = Math.round((total_insert / total_records) * 100);
                duplicate_found = duplicate_found < 0 ? 0 : duplicate_found;
                invalid_email = invalid_email < 0 ? 0 : invalid_email;

                $(".progress-bar").width(progress + '%').html(progress + '%');
                $(".import-progress").html("No of Records Processed: " + line_no);
                $("#import-result").show();
                $("#import-result").html("<table class='table table-hover table-striped table-result'><tbody>" +
                        "<tr><td width='50%'>Total Contacts:</td><td width='50%''>" + total_records + "</td>" +
                        "<tr><td width='50%'>Imported Successfully:</td><td width='50%''>" +  total_import + "</td>" +
                        "<tr><td width='50%'>Duplicates:</td><td width='50%''>" + duplicate_found + "</td>" +
                        "<tr><td width='50%'>Invalid:</td><td width='50%''>" + invalid_email + "</td>" +
                        "</tbody></table>");
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
                    obj.total_number_of_slices,
                    obj.record_insert_limit,
                    obj.affected // deleted rows count
                );
            }
            else {
                $('.loading').addClass('usman').hide();
                $("#ajax-spinner").hide();
                $(".import-progress").hide();
                $(".progress-bar").width(100 + '%').html(100 + '%');
                const duplicate_download_tag = rocket_speed ? "" : "&nbsp;&nbsp;<a href='/storage/users/" + user_id + "/files/imports/subscribers/" + obj.list_id + "_duplicates_emails.csv'>(Click here to download)</a>";
                duplicate_found = duplicate_found < 0 ? 0 : duplicate_found;
                invalid_email = invalid_email < 0 ? 0 : invalid_email;
                total_records++;
                $("#import-result").show();
                $("#import-result").html("<table class='table table-hover table-striped table-result'><tbody>" +
                        "<tr><td width='50%'>Total Contacts:</td><td width='50%''>" + total_records + "</td>" +
                        "<tr><td width='50%'>Imported Successfully:</td><td width='50%''>" + total_import + "</td>" +
                        "<tr><td width='50%'>Duplicates:</td><td width='50%''>" + duplicate_found + duplicate_download_tag +"</font></td>" +
                        "<tr><td width='50%'>Invalid:</td><td width='50%''>" + invalid_email + "&nbsp;&nbsp;<a href='/storage/users/" + user_id + "/files/imports/subscribers/" + obj.list_id +  "_invalid.csv'>(Click here to download)</a></font></td>" +
                        "<tr><td></td><td><a href='"+obj.listContacts+"'><button type='button' name='save_add' class='btn btn-success btn-sm pull-right' value='View Contacts'>View Contacts</button></a></td></tr>"+
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
            // console.log('landed in the end');
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
            data: {},
            success: function (result) {
                sleep(1000);
                $("#loading").hide();
                const response = JSON.parse(result);
                console.log(response);
                let html = '';
                if(response.Value == 'ON'){
                    // Command: toastr["success"] ("Success message here.");

                    $('#threads_div').hide();
                    $("#select_duplicate_id option[value='overwrite']")
                        .attr("disabled", "disabled")
                        .siblings()
                        .removeAttr("disabled");
                    html = `
                        <div class="alert alert-solid-brand alert-bold" role="alert">
                        <div class="alert-icon"><i class="flaticon-exclamation-1"></i></div>
                            <div class="alert-text">
                                <span id="info_msg_label">This option only supports importing Email Addresses. If your file has additional fields then this option may not be suitable for you.</span>
                            </div>
                        </div>
                    `;

                    $('#info_msg_div2').html(html);
                    $('#info_msg_div').show();
                } else {
                    //Command: toastr["error"] ("No Local Infile found. Please activate your Local Infile.");

                    html = `
                        <div class="alert alert-solid-danger alert-bold" role="alert">
                            <div class="alert-icon"><i class="flaticon-close"></i></div>
                            <div class="alert-text">
                                LOAD DATA LOCAL INFILE is disabled in MySql. You need to turn it on before you can use this feature. <a href="https://school.mumara.com/troubleshoot/enabling-load-data-local-infile-in-mysql" class="kt-link kt-font-bold">How to turn it on?</a>
                            </div>
                        </div>
                    `;

                    $('#info_msg_div2').html(html);
                    $('#info_msg_div').show();

                    setTimeout(function(){
                        evt.checked = false;
                        evt.changed();
                        $('#info_msg_div2').html('');
                        $('#info_msg_div').hide();
                    }, 3000);

                }

            }
        });
    } else {
        // $('#info_msg_div').hide();
        $('#threads_div').show();
        $("#select_duplicate_id option[value='overwrite']").removeAttr("disabled");
        //Command: toastr["info"] ("info message here.");
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