"use strict";

// Class definition
var KTWizard4 = function () {
	// Base elements
	var wizardEl;
	var formEl;
	var validator;
	var wizard;
    var current_step;
	
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
				
        
                'smtp_lists[]': {
                    required: !0
                },
                'subscriber_lists[]': {
                    required: !0
                },
                'setup_email': {
                    required: !0,
                    email:true
                },
				

				//= Step 2
				c_name: {
                    required: !0
                },
                c_email_name: {
                    required: !0
                },
                c_email_part1: {
                    required: !0
                },
                c_subject: {
                    required: !0
                },
                return_path: {
                    required: !0
                },
                content_text: {
                    required: !0
                },
                content_text: {
                    required: !0
                },
                c_site_address: {
                    required: !0
                },


				//= Step 3
				t_name: {
                    required: !0
                },
                t_email_part1: {
                    required: !0
                },
                t_email_part2: {
                    required: !0
                },
                t_subject: {
                    required: !0
                },
                thanks_content_text: {
                    required: !0
                },
                t_email_part2: {
                    required: !0
                },

                //= Step 4
                e_site_address: {
                    required: !0
                },
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
        wizard = new KTWizard('kt_wizard_v4', {
        });
        wizard.on('beforeNext', function(wizardObj) {
            current_step = wizardObj.currentStep;
        });
		var btn = formEl.find('[data-ktwizard-type="action-submit"]');

		btn.on('click', function(e) {
			//e.preventDefault();

			if (validator.form()) {
			    up();
                $('#cke_content_html').css('border-color','');
                $('#cke_thankyou_content').css('border-color','');
                $('#content_text').removeClass('is-invalid');
                $('#thanks_content_text').removeClass('is-invalid');
				formEl.submit();
				//Command: toastr["success"] ("Record Successfully Saved.");

				// See: src\js\framework\base\app.js
				//KTApp.progress(btn);
				KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					success: function(data) {
						//KTApp.unprogress(btn);
						KTApp.unblock(formEl);
                                                        //console.log(data);
                        if(data=='success') {
                            Command: toastr["success"]("Record Successfully Saved.");
                            // location.reload();
                            window.location.href  = "/forms";
                        }
                        else {
                            var clicks = 0
                            if(data=='content_text' || data=='content_html')
                                 clicks = 2
                            else if(data=='thankyou_content' || data=='thanks_content_text')
                                 clicks = 1
                            for (var i = 1; i <= clicks; i++)
                                $('.back').trigger('click');
                                if(data=='content_text')
                                    $('#content_text').addClass('is-invalid');
                                else if(data=='content_html')
                                    $('#cke_content_html').css('border-color','red');
                                else if(data=='thankyou_content')
                                    $('#cke_thankyou_content').css('border-color','red');
                                else
                                    $('#thanks_content_text').addClass('is-invalid');
                            Command: toastr["error"]("Syntax Error.");


                        }


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

    $('#c_show_page').click(function() {
        $('.c_goto_web').hide();
        $('.c_show_page').show();
    });
    $('#c_goto_web').click(function() {
        $('.c_show_page').hide();
        $('.c_goto_web').show();
    });

    $('#t_show_page').click(function() {
        $('.t_goto_web').hide();
        $('.t_show_page').show();
    });
    $('#t_goto_web').click(function() {
        $('.t_show_page').hide();
        $('.t_goto_web').show();
    });

    $('#e_show_page').click(function() {
        $('.e_goto_web').hide();
        $('.e_show_page').show();
    });
    $('#e_goto_web').click(function() {
        $('.e_show_page').hide();
        $('.e_goto_web').show();
    });
    var conf_action = document.getElementById("c_goto_web");
        if (conf_action.checked){
            $('.c_goto_web').show();
            $('.c_show_page').hide();
        }
    var thanks_action = document.getElementById("t_goto_web");
        if (thanks_action.checked){
            $('.t_goto_web').show();
            $('.t_show_page').hide();
        }
    var error_action = document.getElementById("e_goto_web");
        if (error_action.checked){
            $('.e_goto_web').show();
            $('.e_show_page').hide();
        }

});

function validateStep(step_no)
{
    $.ajax({
        url: '/testings',
        type: 'GET',
        async: false,
        cache: false,
        timeout: 30000,
        fail: function(){
            return true;
        },
        done: function(msg){
            if (parseFloat(msg)){
                return false;
            } else {
                return true;
            }
        }
    });
}