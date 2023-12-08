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
                    required: !0
                },
                'list_ids[]': {
                    required: !0
                },
                'smtps[]': {
                    required: !0
                },
				'segment_ids[]': {
                    required: !0
                },
				field_custom: {
					required: !0
				},
				values_custom: {
					required: !0
				},
				values_custom2: {
					required: !0
				},
				custom_fields: {
					required: !0
				},
				any_field_text: {
					required: !0
				},
				any_field_text2: {
					required: !0
				}

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
			//e.preventDefault();

            var value = CKEDITOR.instances['content_html'].getData();
            $('#EditiorHTMLVal').val(value);

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
						KTApp.unblock(formEl);
						if(data.has_errors!==undefined)
						{
							if(data.elem=='list_blocked') {
								Command: toastr["error"] ("This trigger contains a blocked contact list and can't be activated");
								return false;
							}

							if(data.elem=='content_html') {
								$('#cke_content_html').css('border-color', 'red');
								$('html, body').animate({
									scrollTop: $("#cke_content_html").offset().top
								}, 1000);
							} else {
								$('#content_text').css('border-color', 'red');
								$('html, body').animate({
									scrollTop: $("#content_text").offset().top
								}, 1000);
							}
							Command: toastr["error"] ("Syntax error.");
						}
						else {
							Command: toastr["success"]("Record Successfully Saved.");
							window.location.href  = "/triggers";
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
});

$('body').on('click', "input[name='trigger_list']", function() {
    var list = $('input[name="trigger_list"]:checked').val();
    if(list == 'list_custom'){
        $('.loader').html('<div id="loading" style="width: 70px; height: 40px; display: inline-block;" />');
    }
    $.ajax({
        url: app_url+'/trigger/loadTriggerData',
        type: 'POST',
        data: {'trigger_type': 'trigger_list', 'list': list},
        success: function (data) {
			if(list=='list_custom')
			{
				$('#lists').html(data.html);
				lists_arr = data.lists;
			}
			else
            $('#lists').html(data);
            $('#loading').hide();
        }
    });
});

$('body').on('click', "input[name='trigger_segment']", function() {
    var segment = $('input[name="trigger_segment"]:checked').val();
    if(segment == 'segment_custom'){
        $('.loader').html('<div id="loading" style="width: 70px; height: 40px; display: inline-block;" />');
    }
    $.ajax({
        url: app_url+'/trigger/loadTriggerData',
        type: 'POST',
        data: {'trigger_type': 'trigger_segment', 'segment': segment},
        success: function (data) {
            $('#segments').html(data);
            $('#loading').hide();
        }
    });
});

$('body').on('click', "input[name='trigger_campaign']", function() {
    var campaign = $('input[name="trigger_campaign"]:checked').val();
    if(campaign == 'campaign_custom'){
        $('.loader').html('<div id="loading" style="width: 70px; height: 40px; display: inline-block;" />');
    }
    $.ajax({
        url: app_url+'/trigger/loadTriggerData',
        type: 'POST',
        data: {'trigger_type': 'trigger_campaign', 'campaign': campaign},
        success: function (data) {
            $('#campaigns').html(data);
            $('#loading').hide();
        }
    });
});

$('body').on('change', "#custom-variable-date-list", function() {
    var list_id = $('#custom-variable-date-list').val();

    $.ajax({
        url: app_url+'/trigger/loadTriggerData',
        type: 'POST',
        data: {'trigger_type': 'get_list_custom_fields', 'list_id': list_id},
        success: function (data) {
            $('#custom-variable-date-custom-field').html(data);
            $('#loading').hide();
        }
    });
});