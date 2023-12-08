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
                         console.log(wizardObj.currentStep);
                         console.log($("#campaign_type").val());
                         console.log($("#no_split_test").val());
                         if ($("#type").is(":checked")&& $("#campaign_type").val()!='split_test' && wizardObj.currentStep==1 && $("#no_list").val()==0) {
                            wizardObj.stop();  // don't go to the next step
                            Command: toastr["error"] (no_list_msg);
                            return false;
                         }
                        //no_split_test
                        if ($("#campaign_type").val()=='split_test' && wizardObj.currentStep==1 && $("#no_split_test").val()==0) {
                            wizardObj.stop();  // don't go to the next step
                            Command: toastr["error"] (no_spli_test_msg);
                            return false;
                        }
                        if ($("#type").is(":checked") && wizardObj.currentStep==1 && $("#no_subscriber").val()==0) {
                            wizardObj.stop();  // don't go to the next step
                            Command: toastr["error"] (no_list_msg);
                            return false;
                        }
                        if ($("#type2").is(":checked") && wizardObj.currentStep==1 && $("#no_segemnt").val()==0) {
                            wizardObj.stop();  // don't go to the next step
                            Command: toastr["error"] (no_segment_msg);
                            return false;
                        }
                        if(wizardObj.currentStep==2 && $("#no_campaign").val()==0){
                            wizardObj.stop();  // don't go to the next step
                            Command: toastr["error"] (no_campaign_msg);
                            return false;
                        }
                        if(wizardObj.currentStep==3 && $("#no_smtp").val()==0){
                            wizardObj.stop();  // don't go to the next step
                            Command: toastr["error"] (no_sending_node_msg);
                            return false;
                        }
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
                'list_ids[]': {
                required: !0
                },
                'smtps[]': {
                required: !0
                },
                'masked_domain_ids[]': {
                    required: !0
                },

				//= Step 2
				

                //= Step 3

                //= Step 4
                from_name: {
                    required: !0
                },
                from_email_part1: {
                    required: !0
                },
                from_email_part2: {
                    required: !0
                }
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
			//e.preventDefault();

			if (validator.form()) {
				formEl.submit();
				//Command: toastr["success"] ("Record Successfully Saved.");

				// See: src\js\framework\base\app.js
				//KTApp.progress(btn);
				KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					success: function(data) {
                        //KTApp.unprogress(btn);
                       if(data == "zero_contact") { 
                            $("#start").modal("show");
                            $(".contactZero").show();
                            $(".listZero").hide();
                            return false;
                       }
                       if(data == "zero_list") { 
                            $(".contactZero").hide();
                            $(".listZero").show();
                            $("#start").modal("show");
                            return false;
                       }
						KTApp.unblock(formEl);

						Command: toastr["success"] ("Record Successfully Saved.");
						 window.location = data;

					}
				});
			}
		});
	}

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v4');
			formEl = $('#submit_form');

			initWizard(); 
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {	
	KTWizard4.init();

	$("#smpt-send-mail").click(function(){

        $("#mail-sent-msg").attr("style", "display:none");
        $("#mail-sent-log-link").attr("style", "display:none");
        $("#mail-sent-log").attr("style", "display:none");

        var formData =  $("#submit_form").serialize();
        var content_html = CKEDITOR.instances['content_html'].getData();
        var newformData = formData + '&new_content_html=' + content_html;

        $.ajax({
            url: app_url+'/drips/send_preview_email',
            type: "POST",
            data: newformData,
            beforeSend: function( xhr ) {
                $("#mail-sent-msg").html("");
                $("#mail-sent-msg").removeClass("alert alert-success");
                $("#smpt-send-mail").prop("type", "button");
                $("#smpt-send-mail").html("Sending Email...");
                $("#smpt-send-mail").addClass("disabled")
            }, 
            success: function(msg) {
                console.log(msg);
                $("#mail-sent-msg").removeAttr("style", "display:none");
                if (msg.status == 1) {
                    $("#mail-sent-msg").removeClass("alert-danger");
                    $("#mail-sent-msg").addClass("alert alert-success");
                    $("#mail-sent-msg").html(msg.text);
                } else {
                    $("#mail-sent-msg").removeClass("alert-success");
                    $("#mail-sent-msg").addClass("alert alert-danger");
                    $("#mail-sent-msg").html(msg.text);
                    /*if (msg.log.xdebug_message != null)  {
                        $("#mail-sent-log-link").removeAttr("style", "display:none");
                        $("#mail-sent-log").html(msg.log.xdebug_message);
                    }*/
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
        var email =  'shahbaz.mughal@hostingshouse.com';
        var form_data =  $("#smtp-frm").serialize();
         $.ajax({
            url: app_url+'/smptValidation',
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
                    $("#validate-mail-sent-msg").html(msg.text);
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
            }
        });
         return false;
    });
    $("#validate-mail-sent-log-link").click(function(){
        $("#validate-mail-sent-log").removeAttr("style", "display:none");
    });

});