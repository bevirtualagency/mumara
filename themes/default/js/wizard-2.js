"use strict";

// Class definition
var KTWizard2 = function () {
    // Base elements
    var wizardEl;
    var formEl;
    var validator;
    var wizard;
    
    // Private functions
    var initWizard = function () {
        // Initialize form wizard
        wizard = new KTWizard('kt_wizard_v2', {
            startStep: 1,
            //manualStepForward: true,
        });



        // Validation before going to next page
        wizard.on('beforeNext', function(wizardObj) {
            if (validator.form() !== true) {
                wizardObj.stop();  // don't go to the next step
            }

            if (wizard.isFirstStep()) {
				try {
					var web_monitor_url = $('#web_monitor_url').val();
					web_monitor_url = web_monitor_url.split(':');
					$('#server_ip').val(web_monitor_url[0]);
					$('#http_port').val(web_monitor_url[1]);
                    $("#btn-next").addClass("disabled");
                    $("#btn-prev").click(function() {
                        $("#btn-next").removeClass("disabled");
                    });
				} catch(err) {
					console.log(err.message);
				}
			} else if (wizard.getStep() == 5) {
                var form_data = new Object;
                form_data['ips']     = $('#ips').val();
                 // var ips_str = $('#ips').val();
                 // var domains_str = $('#domains').val();
                // // $("#ips_array").val(JSON.stringify(ipsArray));
                // var ips_array_s = ips_str.split("\n");
                // var domains_array = domains_str.split("\n");
                // var ipsArray = [];

                 // $.each([ ips_array_s ], function( index, value ) {
                    // ipsArray.push(domains_array[index]); 
                    // ipsArray.push(ips_array_s[index]); 
                  // });
                  
                // $("#ips_array").val(JSON.stringify(ipsArray));

                form_data['domains'] = $('#domains').val();

                form_data['masking_domain'] = $('#masking-domain-selector').val();
                $.ajax({
                    url: app_url+'/mapPMTADomainIP',
                    type: "POST",
                    data: { action: "map_pmta_domins_ips", form_data: form_data},
                    beforeSend: function( xhr ) {
                        $('#split-ips-domains').html('Loading...');
                    },
                    success: function(result) {
                        $('#split-ips-domains').html(result);
                        $('.masking-selector').val($('#masking-domain-selector').val());
                    }
                });
			} else if (wizard.getStep() == 6) {
                var form_data =  $("#pmta-wizard").serialize();
                $.ajax({
                    url: app_url+'/bounce_mail_boxes',
                    type: "POST",
                    data: form_data,
                    beforeSend: function( xhr ) {
                        $('#bounce-mailboxes').html('Loading...');
                    },
                    success: function(result) {
                        //console.log(result);
                        $('#bounce-mailboxes').html(result);
                        $("#accordionExample6 .card").first().children(".card-header").children(".card-title").removeClass("collapsed1");
                        $("#accordionExample6 .card").first().children(".collapse").addClass("sh");
                        $("#accordionExample6").hide();
                    }
                });

			} else if (wizard.getStep() == 7) {
                var form_data =  $("#pmta-wizard").serialize();
                $.ajax({
                    url: app_url+'/sending_domains',
                    type: "POST",
                    data: form_data,
                    beforeSend: function( xhr ) {
                        $('#sending-domains').html('Loading...');
                    },
                    success: function(result) {
                        //console.log(result);
                        $('#sending-domains').html(result);
                        $("#accordionExample5 .card").first().children(".card-header").children(".card-title").removeClass("collapsed");
                        $("#accordionExample5 .card").first().children(".collapse").addClass("show");
                    }
                });
			} else if (wizard.getStep() == 8) {
                $('.button-next').html('Finish');
                var form_data =  $("#pmta-wizard").serialize();
                $.ajax({
                    url: app_url+'/pmta/config/view-pre',
                    type: "POST",
                    data: form_data,
                    beforeSend: function( xhr ) {
                        $('#pmta-summery').html('Loading...');
                    },
                    success: function(result) {
                        //console.log(result);
                        $('#pmta-summery').html(result);

                    }
                });
            } else if (wizard.getStep() == 9) {
                $(".kt-form__actions").hide();
                verifyStepsPmta();
            }
        })



        // Change event
        wizard.on('change', function(wizard) {
            //KTUtil.scrollTop();
            //console.log(getStep());
        });
    }

    var initValidation = function() {
        validator = formEl.validate({
            // Validate only visible fields
            ignore: ":hidden",

            // Validation rules
            rules: {
               	//= Step 1
                web_monitor_url: {
                            required: !0,
                            //validIpPort:!0 // in views/includes/validator-functions.blade.php
                        },

				//= Step 2
                server_name: {
					required: true 
				},
                server_ip: {
					required: true,
                    //IP4Checker:true // in views/includes/validator-functions.blade.php
				},
                ssh_port: {
                    required: true,
                    digits: true 
                },
                http_port: {
                    required: true,
                    digits: true 
                },
                log_files_rotation: {
                    required: true,
                    digits: true 
                },
                'bounce-app[]': {
                    required: true,
                    digits: true 
                },
                accounting_files_rotation: {
                    required: true,
                    alphanumeric: true
                },
                diag_files_rotation: {
                    required: true,
                    alphanumeric: true
                },
                server_password: {
					required: true
				},

				//= Step 3
                smtp_host: {
                    required: true
                },
                 smtp_port: {
                    required: true,
                    digits: true 
                },
                 smtp_encryption: {
                    required: true
                },

				//= Step 4
                pmta_physical_location: {
                    required: true
                },
                http_port: {
                    required: true
                },
                ips_admin_access: {
                    required: true
                },
                log_files_path: {
                    required: true
                },
                log_files_rotation: {
                    required: true
                },
                accounting_files_path: {
                    required: true
                },
                accounting_files_rotation: {
                    required: true
                },
                diag_files_path: {
                    required: true
                },
                diag_files_rotation: {
                    required: true
                },
                spool_path: {
                    required: true
                },
                private_domain_key_path: {
                    required: true
                },
                dkim_selector: {
                    required: true
                },
                masking_domain_selector: {
                    required: true
                },
                vmta_selector: {
                    required: true
                },
                dkim_fallback_domain: {
                    required: true
                },

                //= Step 5
                ips: {
                    required: true,
                    //IP4Checker:true
                },
                domains: {
                    required: true
                },

                //= Step 6
                'group_name[]': {
                    required: !0
                },
                'masking_domain[]': {
                    required: !0
                }

                //= Step 7

                //= Step 8

                //= Step 9

                //= Step 10

            },
            
            // Display error  
            invalidHandler: function(event, validator) {     
                //KTUtil.scrollTop();

                /*swal.fire({
                    "title": "", 
                    "text": "There are some errors in your submission. Please correct them.", 
                    "type": "error",
                    "confirmButtonClass": "btn btn-secondary"
                });*/

                Command: toastr["error"] ("You have some form errors. Please check below.");
            },

            // Submit valid form
            submitHandler: function (form) {
                //i.show(), t.hide(), r[0].submit()
                //console.log(getStep());
            }
        });   
    }

    var initSubmit = function() {
        var btn = formEl.find('[data-ktwizard-type="action-submit"]');

        btn.on('click', function(e) {
            e.preventDefault();

            if (validator.form()) {
                formEl.submit();
                // See: src\js\framework\base\app.js
                //KTApp.progress(btn);
                KTApp.block(formEl);

                // See: http://malsup.com/jquery/form/#ajaxSubmit
                formEl.ajaxSubmit({
                    success: function() {
                        //KTApp.unprogress(btn);
                        KTApp.unblock(formEl);

                        Command: toastr["success"] ("Record Successfully Saved.");
                        window.location = app_url+"/node";

                        /*swal.fire({
                            "title": "", 
                            "text": "The application has been successfully submitted!", 
                            "type": "success",
                            "confirmButtonClass": "btn btn-secondary"
                        });*/
                    }
                });
            }
        });
    }

    return {
        // public functions
        init: function() {
            wizardEl = KTUtil.get('kt_wizard_v2');
            formEl = $('#pmta-wizard');

            initWizard(); 
            initValidation();
            initSubmit();
        }
    };
}();

jQuery(document).ready(function() {    
    KTWizard2.init();
});


function verifyStepsPmta() {
    var form_data =  $("#pmta-wizard").serialize();
    $.ajax({
        url: app_url+'/pmta/config/create-pmta',
        type: "POST",
        data: form_data + '&val=0',
        beforeSend: function( xhr ) {
            $('#setup-pmta').html('Loading...');
        },
        success: function(result) {
            //console.log(result);
            var obj = JSON.parse(result);
            $('#setup-pmta').html(obj.data_pmta);
            $.ajax({
                url: app_url+'/pmta/config/create-pmta',
                type: "POST",
                data: form_data + '&val=1',
                beforeSend: function( xhr ) {
                    $('#tbl-connet-pmta-web-monitor').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                },
                success: function(result) {
                    //console.log(result);
                    var obj = JSON.parse(result);
                    if(obj.status) {
                        $('#tbl-connet-pmta-web-monitor').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                    } else {
                        $('#tbl-connet-pmta-web-monitor').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-exclamation-triangle kt-font-warning');
                    }

                    if(obj.status || 1) {
                        //$('#tbl-connet-pmta-web-monitor').removeClass('fa-times').addClass('fa-check');
                        $.ajax({
                            url: app_url+'/pmta/config/create-pmta',
                            type: "POST",
                            data: form_data + '&val=2',
                            beforeSend: function( xhr ) {
                                $('#tbl-connet-server').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                            },
                            success: function(result) {
                                //console.log(result);
                                var obj = JSON.parse(result);
                                if(obj.status) {
                                    $('#tbl-connet-server').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                    $.ajax({
                                        url: app_url+'/pmta/config/create-pmta',
                                        type: "POST",
                                        data: form_data + '&val=3',
                                        beforeSend: function( xhr ) {
                                            $('#tbl-checking-folder').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                        },
                                        success: function(result) {
                                            //console.log(result);
                                            var obj = JSON.parse(result);
                                            if(obj.status) {
                                                $('#tbl-checking-folder').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                $.ajax({
                                                    url: app_url+'/pmta/config/create-pmta',
                                                    type: "POST",
                                                    data: form_data + '&val=4',
                                                    beforeSend: function( xhr ) {
                                                        $('#tbl-backup-old-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                    },
                                                    success: function(result) {
                                                        //console.log(result);
                                                        var obj = JSON.parse(result);
                                                        if(obj.status) {
                                                            $('#tbl-backup-old-pmta').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                            $.ajax({
                                                                url: app_url+'/pmta/config/create-pmta',
                                                                type: "POST",
                                                                data: form_data + '&val=5',
                                                                beforeSend: function( xhr ) {
                                                                    $('#tbl-config-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                                },
                                                                success: function(result) {
                                                                    //console.log(result);
                                                                    var obj = JSON.parse(result);
                                                                    if(obj.status) {
                                                                        $('#tbl-config-pmta').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                                        $.ajax({
                                                                            url: app_url+'/pmta/config/create-pmta',
                                                                            type: "POST",
                                                                            data: form_data + '&val=6',
                                                                            beforeSend: function( xhr ) {
                                                                                $('#tbl-verify-private-domain').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                                            },
                                                                            success: function(result) {
                                                                                //console.log(result);
                                                                                var obj = JSON.parse(result);
                                                                                if(obj.status) {
                                                                                    $('#tbl-verify-private-domain').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                                                    $.ajax({
                                                                                        url: app_url+'/pmta/config/create-pmta',
                                                                                        type: "POST",
                                                                                        data: form_data + '&val=7',
                                                                                        beforeSend: function( xhr ) {
                                                                                            $('#tbl-configur-bounce').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                                                        },
                                                                                        success: function(result) {
                                                                                            //console.log(result);
                                                                                            var obj = JSON.parse(result);
                                                                                            if(obj.status) {
                                                                                                $('#tbl-configur-bounce').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                                                                $.ajax({
                                                                                                    url: app_url+'/pmta/config/create-pmta',
                                                                                                    type: "POST",
                                                                                                    data: form_data + '&val=8',
                                                                                                    beforeSend: function( xhr ) {
                                                                                                        $('#tbl-adding-sending-domains').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                                                                    },
                                                                                                    success: function(result) {
                                                                                                        //console.log(result);
                                                                                                        var obj = JSON.parse(result);
                                                                                                        if(obj.status) {
                                                                                                            $('#tbl-adding-sending-domains').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                                                                            $.ajax({
                                                                                                                url: app_url+'/pmta/config/create-pmta',
                                                                                                                type: "POST",
                                                                                                                data: form_data + '&val=9',
                                                                                                                beforeSend: function( xhr ) {
                                                                                                                    $('#tbl-sending-nodes').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                                                                                },
                                                                                                                success: function(result) {
                                                                                                                    //console.log(result);
                                                                                                                    var obj = JSON.parse(result);
                                                                                                                    if(obj.status) {
                                                                                                                        $('#tbl-sending-nodes').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                                                                                        $.ajax({
                                                                                                                            url: app_url+'/pmta/config/create-pmta',
                                                                                                                            type: "POST",
                                                                                                                            data: form_data + '&val=10',
                                                                                                                            beforeSend: function( xhr ) {
                                                                                                                                $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                                                                                            },
                                                                                                                            success: function(result) {
                                                                                                                                //console.log(result);
                                                                                                                                var obj = JSON.parse(result);
                                                                                                                                if(obj.status) {
                                                                                                                                    $('#tbl-start-pmta').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                                                                                                    $.ajax({
                                                                                                                                        url: app_url+'/pmta/config/create-pmta',
                                                                                                                                        type: "POST",
                                                                                                                                        data: form_data + '&val=11',
                                                                                                                                        beforeSend: function( xhr ) {
                                                                                                                                            $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                                                                                                        },
                                                                                                                                        success: function(result) {
                                                                                                                                            //console.log(result);
                                                                                                                                            var obj = JSON.parse(result);
                                                                                                                                            if(obj.status) {
                                                                                                                                                $('#tbl-restart-pmta-http').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');                                                                                                                                                                        $.ajax({
                                                                                                                                                    url: app_url+'/pmta/config/create-pmta',
                                                                                                                                                    type: "POST",
                                                                                                                                                    data: form_data + '&val=12',
                                                                                                                                                    beforeSend: function( xhr ) {
                                                                                                                                                        $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa-cog fa-spin kt-font-dark');
                                                                                                                                                    },
                                                                                                                                                    success: function(result) {
                                                                                                                                                        //console.log(result);
                                                                                                                                                        var obj = JSON.parse(result);
                                                                                                                                                        if(obj.status) {
                                                                                                                                                            $('#tbl-verify-connections').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa-check kt-font-success');
                                                                                                                                                            //$('#success-msg').html('<span class="text-success">Congratulations!!! Your PowerMTA Server has been Successfully Deployed</span>');
                                                                                                                                                            $('#tbl-steps').hide();
                                                                                                                                                            $('#success').show();
                                                                                                                                                        } else {
                                                                                                                                                            $('#tbl-verify-connections').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                });
                                                                                                                                            } else {
                                                                                                                                                $('#tbl-restart-pmta-http').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                                                                                                                $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    });
                                                                                                                                } else {
                                                                                                                                    $('#tbl-start-pmta').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                                                                                                    $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                                                    $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                                                }
                                                                                                                            }
                                                                                                                        });

                                                                                                                    } else {
                                                                                                                        $('#tbl-sending-nodes').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                                                                                        $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                                        $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                                        $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                                    }
                                                                                                                }
                                                                                                            });
                                                                                                        } else {
                                                                                                            $('#tbl-adding-sending-domains').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                                                                            $('#tbl-sending-nodes').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                            $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                            $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                            $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                        }
                                                                                                    }
                                                                                                });

                                                                                            } else {
                                                                                                $('#tbl-configur-bounce').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                                                                $('#tbl-adding-sending-domains').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                $('#tbl-sending-nodes').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                                $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                            }
                                                                                        }
                                                                                    });
                                                                                } else {
                                                                                    $('#tbl-verify-private-domain').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                                                    $('#tbl-configur-bounce').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                    $('#tbl-adding-sending-domains').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                    $('#tbl-sending-nodes').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                    $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                    $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                    $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                                }
                                                                            }
                                                                        });
                                                                    } else {
                                                                        $('#tbl-config-pmta').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                                        $('#tbl-verify-private-domain').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                        $('#tbl-configur-bounce').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                        $('#tbl-adding-sending-domains').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                        $('#tbl-sending-nodes').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                        $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                        $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                        $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            $('#tbl-backup-old-pmta').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                            $('#tbl-config-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                            $('#tbl-verify-private-domain').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                            $('#tbl-configur-bounce').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                            $('#tbl-adding-sending-domains').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                            $('#tbl-sending-nodes').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                            $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                            $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                            $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                        }
                                                    }
                                                });
                                            } else {
                                                $('#tbl-checking-folder').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                                $('#tbl-backup-old-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                $('#tbl-config-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                $('#tbl-verify-private-domain').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                $('#tbl-configur-bounce').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                $('#tbl-adding-sending-domains').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                $('#tbl-sending-nodes').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                                $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                            }
                                        }
                                    });
                                } else {
                                    $('#tbl-connet-server').removeClass('fa-cog fa-spin kt-font-dark').addClass('fa fa-times kt-font-danger');
                                    $('#tbl-checking-folder').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-backup-old-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-config-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-verify-private-domain').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-configur-bounce').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-adding-sending-domains').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-sending-nodes').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-start-pmta').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-restart-pmta-http').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                    $('#tbl-verify-connections').removeClass('fa-hourglass kt-font-info').addClass('fa fa-exclamation-triangle kt-font-warning');
                                }
                            }
                        });
                    }
                }
            });
        }
    });
}

function showDetailBounce(attr, id) {
    var class_name = $("#li-"+id).attr('class');
    if(class_name == 'fa fa-plus-square-o') {
        $("#"+id).show();
        $("#li-"+id).removeClass('fa-plus-square');
        $("#li-"+id).addClass('fa-minus-square');
    } else {
        $("#"+id).hide();
        $("#li-"+id).removeClass('fa-minus-square');
        $("#li-"+id).addClass('fa-plus-square');
    }
}

function verifyBounce(id) {
    $('#'+id+'-msg').html('');
    $('#'+id+'-verify-btn').val('Verifying');
    var values = $("input[name='"+id+"[]']").map(function(){
        return $(this).val();
    }).get();
    var encryption = $('#'+id+'-encryption').val();
    var method = $('#'+id+'-method').val();
    $.ajax({
        url: app_url+'/pmta/testBounce',
        type: "POST",
        data: {values: values, method: method, encryption: encryption, verify:'bounce'},
        success: function(result) {
            //console.log(result);

            if(result == 'Verified') {
                $('#'+id+'-msg').html("<font color='green'>Verified</font>");
                $("#chk-"+id).removeClass('fa fa-times');
                $("#chk-"+id).addClass('fa fa-check');
            } else {
                $('#'+id+'-msg').html(result);
            }
            $('#'+id+'-verify-btn').val('Verify Connection');
        }
    });
}

function verifyDomain(domain, id) {
    $('#'+id+'-msg').html('');
    $('#'+id+'-domain-verify-btn').val('Verifying');
    $('#'+id+'-msg').html("<font>...</font>");
    $.ajax({
        url: app_url+'/pmta/testBounce',
        type: "POST",
        data: {domain: domain, verify:'domain'},
        success: function(result) {
            //console.log(result);

            if(result == 'Verified') {
                $('#'+id+'-msg').html("<font color='green'>Verified</font>");
                $("#chk-"+id).removeClass('fa fa-times');
                $("#chk-"+id).addClass('fa fa-check');
            } else {
                $("#chk-"+id).removeClass('fa fa-check');
                $("#chk-"+id).addClass('fa fa-times');
                $('#'+id+'-msg').html(result);
            }
            $('#'+id+'-domain-verify-btn').val('Refresh');
        }
    });

}

function showDetailMask(attr, id) {
    var class_name = $("#li-"+id).attr('class');
    if(class_name == 'fa-plus-square') {
        $("#"+id).show();
        $("#li-"+id).removeClass('fa-plus-square');
        $("#li-"+id).addClass('fa-minus-square');
    } else {
        $("#"+id).hide();
        $("#li-"+id).removeClass('fa-minus-square');
        $("#li-"+id).addClass('fa-plus-square');
    }
}