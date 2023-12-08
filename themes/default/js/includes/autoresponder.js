var KTFormControls = function() {
    var autoresponder = function() {
            function e(e) {
                return e.id ? "<img class='flag' src='/assets/global/img/flags/" + e.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + e.text : e.text
            }
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
                        name: {
                            required: !0
                        },
                        autoresponder_group_id: {
                            required: !0
                        },
                        'subscriber_lists[]': {
                        required: !0
                        },
                        'smtp_lists[]': {
                        required: !0
                        },
                        from_email : {
                        required: !0
                        },
                        bounce_email : {
                        required: !0
                        },
                        reply_email : {
                        required: !0
                        },
                        sender_information : {
                            required: !0
                        },
                        email_subject : {
                            required: !0
                        },
                        content_text : {
                            required: !0
                        },
                    },
                    errorPlacement: function(event, validator) {
                        Command: toastr["error"] ("You have some form errors. Please check below."); 
                        $('#msg').css("display", "flex");
                        $('#msg-text').html(form_error);
                        $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                       // "gender" == r.attr("name") ? e.insertAfter("#form_gender_error") : "payment[]" == r.attr("name") ? e.insertAfter("#form_payment_error") : e.insertAfter(r)
                    }
                });
                var a = function() {
                        $("#tab4 .form-control-static", r).each(function() {
                            var e = $('[name="' + $(this).attr("data-display") + '"]', r);
                            if (e.is(":radio") && (e = $('[name="' + $(this).attr("data-display") + '"]:checked', r)), e.is(":text") || e.is("textarea")) $(this).html(e.val());
                            else if (e.is("select")) $(this).html(e.find("option:selected").text());
                            else if (e.is(":radio") && e.is(":checked")) $(this).html(e.attr("data-title"));
                            else if ("payment[]" == $(this).attr("data-display")) {
                                var t = [];
                                $('[name="payment[]"]:checked', r).each(function() {
                                    t.push($(this).attr("data-title"))
                                }), $(this).html(t.join("<br>"))
                            }
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
                        return i.hide(), t.hide(), 0 == r.valid() ? !1 : void o(e, a, n)
                    },
                    onPrevious: function(e, r, a) {
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
                }).hide(), $("#country_list", r).change(function() {
                    r.validate().element($(this))
                })
            }
        };
    return {
        init: function() {
            autoresponder();
        }
    }
}();

jQuery(document).ready(function() {
    KTFormControls.init();

    // $("#smpt-send-mail").click(function(){

    //     $("#mail-sent-msg").attr("style", "display:none");
    //     $("#mail-sent-log-link").attr("style", "display:none");
    //     $("#mail-sent-log").attr("style", "display:none");

    //     var formData =  $("#submit_form").serialize();
    //     var content_html = CKEDITOR.instances['content_html'].getData();
    //     var newformData = formData + '&new_content_html=' + content_html;

    //     $.ajax({
    //         url: app_url+'/drips/send_preview_email',
    //         type: "POST",
    //         data: newformData,
    //         beforeSend: function( xhr ) {
    //             $("#mail-sent-msg").html("");
    //             $("#mail-sent-msg").removeClass("alert alert-success");
    //             $("#smpt-send-mail").prop("type", "button");
    //             $("#smpt-send-mail").html("Sending Email...");
    //             $("#smpt-send-mail").addClass("disabled")
    //         }, 
    //         success: function(msg) {
    //             console.log(msg);
    //             $("#mail-sent-msg").removeAttr("style", "display:none");
    //             if (msg.status == 1) {
    //                 $("#mail-sent-msg").removeClass("alert-danger");
    //                 $("#mail-sent-msg").addClass("alert alert-success");
    //                 $("#mail-sent-msg").html(msg.text);
    //             } else {
    //                 $("#mail-sent-msg").removeClass("alert-success");
    //                 $("#mail-sent-msg").addClass("alert alert-danger");
    //                 $("#mail-sent-msg").html(msg.text);
    //                 /*if (msg.log.xdebug_message != null)  {
    //                     $("#mail-sent-log-link").removeAttr("style", "display:none");
    //                     $("#mail-sent-log").html(msg.log.xdebug_message);
    //                 }*/
    //             }
                
    //             $("#smpt-send-mail").removeClass("disabled");
    //             $("#smpt-send-mail").html("Test Email");
    //             $("#smpt-send-mail").prop("type", "submit");
    //         }
    //     });
    //      return false;
    // });

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

