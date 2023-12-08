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
				package_name: {
                    required: !0
                },
                role_id: {
                    required: !0
                },

				//= Step 2
				

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
			e.preventDefault();

			if (validator.form()) {
				formEl.submit();
				//Command: toastr["success"] ("Record Successfully Saved.");

				// See: src\js\framework\base\app.js
				//KTApp.progress(btn);
				KTApp.block(formEl);

				// See: http://malsup.com/jquery/form/#ajaxSubmit
				formEl.ajaxSubmit({
					success: function() {
						//KTApp.unprogress(btn);
						KTApp.unblock(formEl);

						Command: toastr["success"] ("Record Successfully Saved.");
						window.location = app_url+"/clients/packages";

					}
				});
			}
		});
	}

	return {
		// public functions
		init: function() {
			wizardEl = KTUtil.get('kt_wizard_v4');
			formEl = $('#subuser-frm');

			initWizard(); 
			initValidation();
			initSubmit();
		}
	};
}();

jQuery(document).ready(function() {	
	KTWizard4.init();
});