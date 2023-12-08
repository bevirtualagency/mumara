var FormValidation = function() {
    var web_forms = function() {
            if (jQuery().bootstrapWizard) {
                var r = $("#submit_form"),
                    t = $(".alert-danger", r),
                    i = $(".alert-success", r);
                r.validate({
                    doNotHideMessage: !0,
                    errorElement: "span",
                    errorClass: "help-block help-block-error",
                    focusInvalid: !1,
                    rules: {
                       
                        'smtp_lists[]': {
                            required: !0
                        },
                        'subscriber_lists[]': {
                            required: !0
                        },
						
                        c_email_part1: {
                            required: !0
                        },
                        c_email_part2: {
                            required: !0
                        },
                        t_email_part1: {
                            required: !0
                        },
                        t_email_part2: {
                            required: !0
                        }
                    },
                    errorPlacement: function(e, r) {
                    },
                    invalidHandler: function(e, r) {
                    //    i.hide(), t.show(), App.scrollTo(t, -200)
                    },
                    highlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
                    },
                    unhighlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-error")
                    },
                    success: function(e) {
                        var i = $(r).parent(".input-icon").children("i");
                    $(r).closest(".form-group").removeClass("has-error").addClass("has-success"), i.removeClass("fa-warning").addClass("fa-check")
                    },
                    submitHandler: function(e) {
                        i.show(), t.hide(), r[0].submit()
                    }
                });
                var a = function() {
                        $("#tab4 .form-control-static", r).each(function() {
                            var e = $('[name="' + $(this).attr("data-display") + '"]', r);
                        })
                    },
                    o = function(e, r, t) {
                        var i = r.find("li").length,
                            o = t + 1;
                        $(".step-title", $("#form_wizard_1")).text("Step " + (t + 1) + " of " + i), jQuery("li", $("#form_wizard_1")).removeClass("done");
                        for (var n = r.find("li"), s = 0; t > s; s++) jQuery(n[s]).addClass("done");
                        1 == o ? $("#form_wizard_1").find(".button-previous").hide() : $("#form_wizard_1").find(".button-previous").show(), o >= i ? ($("#form_wizard_1").find(".button-next").hide(), $("#form_wizard_1").find(".button-submit").show(), a()) : ($("#form_wizard_1").find(".button-next").show(), $("#form_wizard_1").find(".button-submit").hide())//, App.scrollTo($(".page-title"))
                    };
                $("#form_wizard_1").bootstrapWizard({
                    nextSelector: ".button-next",
                    previousSelector: ".button-previous",
                    onTabClick: function(e, r, t, i) {
                        return !1
                    },
                    onNext: function(e, a, n) {
                        
                        if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 0) {  
                            $action = $('#action').val();        

                            if($('#double_optin').bootstrapSwitch('state') == false && $('#thanks_email').bootstrapSwitch('state') != false) {
                                $('#form_wizard_1').bootstrapWizard('show', 2);
                                $("#form_wizard_1").find(".button-previous").show();
                                $("#form_wizard_1").find(".button-next").show();
                                return false;
                            } else if($('#double_optin').bootstrapSwitch('state') != false && $('#thanks_email').bootstrapSwitch('state') == false) {
                                $('#form_wizard_1').bootstrapWizard('show', 1);
                                $("#form_wizard_1").find(".button-previous").show();
                                $("#form_wizard_1").find(".button-next").show();
                                return false;
                            } else if($('#thanks_email').bootstrapSwitch('state') == false && $('#double_optin').bootstrapSwitch('state') == false) {
                                $('#form_wizard_1').bootstrapWizard('show', 3);
                                $("#form_wizard_1").find(".button-previous").show();
                                $("#form_wizard_1").find(".button-submit").show();
                                return false;
                            } 
                        } else if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 1) {  
                            $action = $('#action').val();        

                            if($('#thanks_email').bootstrapSwitch('state') == false) {
                                $('#form_wizard_1').bootstrapWizard('show', 3);
                                $("#form_wizard_1").find(".button-previous").show();
                                $("#form_wizard_1").find(".button-next").show();
                                return false;
                            }
                        } 
                        return i.hide(), t.hide(), 0 == r.valid() ? !1 : void o(e, a, n)
                    },
                    onPrevious: function(e, r, a) {

                        if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 3) {  
                            $action = $('#action').val();        

                            if($('#thanks_email').bootstrapSwitch('state') == false && $('#double_optin').bootstrapSwitch('state') == false) {
                                $('#form_wizard_1').bootstrapWizard('show', 0);
                                $("#form_wizard_1").find(".button-previous").show();
                                $("#form_wizard_1").find(".button-next").show();
                                $("#form_wizard_1").find(".button-submit").hide();
                                return false;
                            } else if($('#thanks_email').bootstrapSwitch('state') == false && $('#double_optin').bootstrapSwitch('state') != false) {
                                $('#form_wizard_1').bootstrapWizard('show', 1);
                                $("#form_wizard_1").find(".button-previous").show();
                                $("#form_wizard_1").find(".button-next").show();
                                return false;
                            }
                        }

                        if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 2) {  
                            $action = $('#action').val();  

                            if($('#double_optin').bootstrapSwitch('state') == false) {
                                $('#form_wizard_1').bootstrapWizard('show', 0);
                                $("#form_wizard_1").find(".button-previous").show();
                                $("#form_wizard_1").find(".button-next").show();
                                return false;
                            }
                        }

                        i.hide(), t.hide(), o(e, r, a)
                    },
                    onTabShow: function(e, r, t) {
                        var i = r.find("li").length,
                            a = t + 1,
                            o = a / i * 100;
                        $("#form_wizard_1").find(".progress-bar").css({
                            width: o + "%"
                        })
                    }
                }), $("#form_wizard_1").find(".button-previous").hide(), $("#form_wizard_1 .button-submit").click(function() {
                    //alert("Finished! Hope you like it :)")
                    r[0].submit();
                    location.reload();
                }).hide()
            }
        };
    return {
        init: function() {
            web_forms();
        }
    }
}();
jQuery(document).ready(function() {
    FormValidation.init();

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
            $("#div_json_response_text_content").hide();
        }
   var conf_action_josn = document.getElementById("c_json");
        if (conf_action.checked){
            $('.c_goto_web').hide();
            $('.c_show_page').hide();
            $("#div_json_response_text_content").show();
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