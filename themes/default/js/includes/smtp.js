"use strict";

// Class definition
var KTWizard4 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
	
	// Private functions
	var initWizard = function () {
		// Initialize form wizard
		wizard = new KTWizard('kt_wizard_v4', {
			startStep: 1,
		});

		// Validation before going to next page
		wizard.on('beforeNext', function(wizardObj) {
			if (validator.form() !== true) {
				wizardObj.stop();  // don't go to the next step
			}
		})

		// Change event
		wizard.on('change', function(wizard) {
			//KTUtil.scrollTop();	
		});
	}

	var initValidation = function() {
		validator = formEl.validate({
			// Validate only visible fields
			ignore: ":hidden",

			// Validation rules
			rules: {
				//= Step 1
				name: {
					required: !0
				},
				group_id: {
					required: !0
				},

				//= Step 2

				host: {
					required: !0
				},
				port: {
					required: !0
				},
				from_name: {
					required: !0
				},
				from_email_part11: {
					required: !0
				},
                from_email_part2:{
                        required: !0
                },
                bounce_email_id:{
                        required: !0
                },
				masked_domain_id: {
					required: !0
				},
				reply_email: {
					required: !0
					//email: !0
				}
				

				//= Step 3
				
			},
			
			// Display error  
			invalidHandler: function(event, validator) {	 
				//KTUtil.scrollTop();
				Command: toastr["error"] ("You have some form errors. Please check below.");
			},

			// Submit valid form
			submitHandler: function (form) {
				//i.show(), t.hide(), r[0].submit()
			}
		});   
	}

	var initSubmit = function() {
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');

		btn.on('click', function(e) {
			e.preventDefault();

			if (validator.form()) {
				formEl.submit();
				//Command: toastr["success"] ("Record Successfully Saved.");

				// See: src\js\framework\base\app.js
				//KTApp.progress(btn);
				KTApp.block(formEl);



				if($("#action").val() == 'add') {
                    var method = 'POST';
                    var url = app_url+'/node';
                } else {
                    var id = $('#smtp-id').val();
                    var method = 'PUT';
                    var url = app_url+'/node/'+id;
                }

				var form_data =  $("#smtp-frm").serialize();

				$.ajax({
                    url: url,
                    type: method,
                    data: form_data,
                    success: function(result) {
                        if(result == "success-save") {
                            KTApp.block(formEl);
                            setTimeout(function(){ 
                                $("form#smtp-frm").hide();
                                $("#tabSuccess").fadeIn("1500", function() {});
                                $("#testmail").fadeIn("1500", function() {});
                                KTApp.unblock(formEl);
                            }, 2000);

                        } else {
                            Command: toastr["success"] ("Record Successfully updated.");
                            window.location = "/nodes";
                        } 
                    }
                });



				// See: http://malsup.com/jquery/form/#ajaxSubmit
				/*formEl.ajaxSubmit({
					success: function() {
						//KTApp.unprogress(btn);
						KTApp.unblock(formEl);

						Command: toastr["success"] ("Record Successfully Saved.");
						window.location = "/node";

					}
				});*/
			}
		});
	}

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v4');
			formEl = $('#smtp-frm');

			initWizard(); 
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {	
	KTWizard4.init();

	$("#frm-group").submit(function(){
        var form_data =  $("#frm-group").serialize();
        $.ajax({
            url: app_url+'/group',
            type: "POST",
            data: form_data,
            success: function(result) {
                if (result == 'success') {
                    groups_msg = 'Group(s) successfully added!';
                    Command: toastr["success"] (groups_msg);
                    $('#msg-group').removeClass('alert-danger');
                    $('#msg-group').addClass('alert-success');
                }else{
                    groups_msg = '' + result + ' already Exist';
                    Command: toastr["error"] (groups_msg);
                    $('#msg-group').removeClass('alert-success');
                    $('#msg-group').addClass('alert-danger');
                }
                $('#msg-group').show('slow');
                $('#msg-text-group').html(groups_msg);
                $('#msg-group').removeClass('display-hide').addClass(msg);
                $('#msg-group').delay(2500).hide('slow');

                $.getJSON( app_url+"/group?section_id=2", function( data ) {
                    console.log(data);
                    var $el = $("#group_id");
                    $el.empty(); // remove old options
                    $.each(data, function(key,value) {
                      $el.append($("<option></option>")
                         .attr("value", value).text(key));
                    });
                });
            }
        });
        return false;
    });

    $("#smpt-send-mail").click(function(){
        $("#mail-sent-msg").attr("style", "display:none");
        $("#mail-sent-log-link").attr("style", "display:none");
        $("#mail-sent-log").attr("style", "display:none");
        var el = $('#php_mailer');
        var php_mailer = el!==undefined && $(el).is(":checked");
        if(!php_mailer)
        {
            $("#modal_span").hide();
            $("#mail-sent-log").html('');
            $('#msg_body').html('');
        }
        var email =  $('#smtp_email').val();
        var form_data =  $("#smtp-frm").serialize();
         $.ajax({
            url: app_url+'/node/validation',
            type: "GET",
            data: form_data+'&validate_only=0&email='+email+'&php_mailer='+php_mailer,
            beforeSend: function( xhr ) {
                $("#mail-sent-msg").html("");
                $("#mail-sent-msg").removeClass("alert alert-success");
                $("#smpt-send-mail").prop("type", "button");
                $("#smpt-send-mail").html("Sending Email...");
                $("#smpt-send-mail").addClass("disabled")
            }, 
            success: function(msg) {
                console.log(msg);
                $("#mail-sent-msg").show();
                if (msg.status == 1) {
                    $("#mail-sent-msg").removeClass("alert-danger");
                    $("#mail-sent-msg").addClass("alert alert-success");
                    $("#mail-sent-msg").html(msg.text);
                    $("#modal_span").hide();
                    $("#mail-sent-log").html('');
                    $('#msg_body').html('');
                } else {
                    $("#mail-sent-msg").removeClass("alert-success");
                    $("#mail-sent-msg").addClass("alert alert-danger");
                    $("#mail-sent-msg").html(msg.text);
                }
                if (php_mailer)  {
                    if(msg.log!==undefined) {
                        $("#modal_span").show();
                        $("#mail-sent-log").html(msg.log);
                        $('#msg_body').html(msg.log);
                    }
                    else{
                        $("#modal_span").hide();
                        $("#mail-sent-log").html('');
                        $('#msg_body').html('');
                    }
                }
                else{
                    $("#modal_span").hide();
                    $("#mail-sent-log").html('');
                    $('#msg_body').html('');
                }
                
                $("#smpt-send-mail").removeClass("disabled");
                $("#smpt-send-mail").html("Test Email");
                $("#smpt-send-mail").prop("type", "submit");
            }
        });
         return false;
    });
    $("#mail-sent-log-link").click(function(){
        $("#mail-sent-log").removeAttr("style", "display:none");
    });


    $("#validate-smpt-send-mail").click(function(){
        $("#validate-mail-sent-msg").attr("style", "display:none");
        $("#validate-mail-sent-log-link").attr("style", "display:none");
        $("#validate-mail-sent-log").attr("style", "display:none");
        var email =  'sample@gmail.com';
        var form_data =  $("#smtp-frm").serialize();
         $.ajax({
            url: app_url+'/node/validation',
            type: "GET",
            data: form_data+'&validate_only=1&email='+email,
            beforeSend: function( xhr ) {
                $("#validate-mail-sent-msg").html("");
                $("#validate-mail-sent-msg").removeClass("alert alert-success");
                $("#validate-smpt-send-mail").prop("type", "button");
                $("#validate-smpt-send-mail").html("Validating...");
                $("#validate-smpt-send-mail").addClass("disabled")
            }, 
            success: function(msg) {
                console.log(msg);
                $("#validate-mail-sent-msg").removeAttr("style", "display:none");
                if (msg.status == 1) {
                    $("#validate-mail-sent-msg").removeClass("alert-danger");
                    $("#validate-mail-sent-msg").addClass("alert alert-success");
                    $("#validate-mail-sent-msg").html("SMTP successfully validated!");
                } else {
                    $("#validate-mail-sent-msg").removeClass("alert-success");
                    $("#validate-mail-sent-msg").addClass("alert alert-danger");
                    $("#validate-mail-sent-msg").html(msg.text);
                    if (msg.log.xdebug_message != null)  {
                        $("#validate-mail-sent-log-link").removeAttr("style", "display:none");
                        $("#validate-mail-sent-log").html(msg.log.xdebug_message);
                    }
                }
                
                $("#validate-smpt-send-mail").removeClass("disabled");
                $("#validate-smpt-send-mail").html("Validate SMTP");
                $("#validate-smpt-send-mail").prop("type", "submit");
                $("#validate-smpt-send-mail").html(validate_button);
            }
        });
         return false;
    });
    $("#validate-mail-sent-log-link").click(function(){
        $("#validate-mail-sent-log").removeAttr("style", "display:none");
    });
});