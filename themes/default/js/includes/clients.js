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
			
			var trigger_type = $('#trigger-type').val();
            if(trigger_type == 'date') {
                $('#frequency-row').show();
            } else {
                $('#frequency-row').hide();
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
                    required: true,
                },
                email: {
                    required: true,
                    email: true,
                },
                password: {
                    required: $("#action").val() == "add",
                    minlength: 6,
                },
                confirm_password: {
                    required: $("#action").val() == "add",
                    minlength: 6,
                    equalTo : "#password",
                },

				//= Step 2
				package_id: {
                    required: true,
                },

				//= Step 3
				
			},
			
			// Display error  
			invalidHandler: function(event, validator) {	 
				//KTUtil.scrollTop();
				Command: toastr["error"] ("You have some form errors. Please check below.");
			},

			/*onNext: function(e, a, n) {
                if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 0) {
                    var trigger_type = $('#trigger-type').val();
                    if(trigger_type == 'date') {
                        $('#frequency-row').show();
                    } else {
                        $('#frequency-row').hide();
                    }
                }
                return i.hide(), t.hide(), 0 == r.valid() ? !1 : void o(e, a, n)
            },*/

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
			$('.error').remove();
			if (validator.form()) {

				formEl.submit();

				//Command: toastr["success"] ("Record Successfully Saved.");

				// See: src\js\framework\base\app.js
				//KTApp.progress(btn);
				KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					success: function(data) {
						 
						if(data.result) {

						}
						//KTApp.unprogress(btn);
						KTApp.unblock(formEl);
						if(data.status=='validation_failed')
                        {
                            var x;
                            var id;
                            var btn_2 = formEl.find('[data-ktwizard-type="action-prev"]');
                            btn_2.trigger("click");
                            for (x in data.messages) {
                             $('#'+x).addClass('is-invalid');
                            // id = '#'+x+'-error';
                             $('#'+x).after('<small class="error invalid-feedback">'+data.messages[x]+'</small>');
                             $('.error').css('display','block');
                            }
                        }
						 if(data.message!==undefined) {
	                            toastr.error(data.message);
	                        }
						else{
						Command: toastr["success"] ("Record Successfully Saved.");
						  window.location = app_url+"/clients";
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
			formEl = $('#user-frm');

			initWizard(); 
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {	
	KTWizard4.init();

	/*$("#submit_1").click(function() {
        if($("#package_id").val() != "" && $("#package_id").val()>0) {
            alert("aaa");
            $("#user-frm").submit();
        } else {
            alert("aaaa");
            $("#msg").removeClass("display-hide");
            $("#msg").addClass("alert alert-danger");
            $('#msg').css("display", "flex");
            $("#msg-text").html("Package Require");
            $(".select2-selection").css("border-color", "red");
            return false;
        }
    });*/
    
});