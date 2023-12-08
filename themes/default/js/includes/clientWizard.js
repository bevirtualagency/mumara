var FormValidation = function() {
    var user = function() {
            function e(e) {
                return e.id ? "<img class='flag' src='/assets/global/img/flags/" + e.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + e.text : e.text
            }
            if (jQuery().bootstrapWizard) {
                var r = $("#user-frm"),
                    t = $(".alert-danger", r),
                    i = $(".alert-success", r);
                r.validate({
                    doNotHideMessage: !0,
                    errorElement: "span",
                    errorClass: "help-block help-block-error",
                    focusInvalid: !1,
                    rules: {
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
                        package_id: {
                            required: true,
                        },
                    },

                    errorPlacement: function(e, r) {
                        var i = $(r).parent(".input-icon").children("i");
                        i.removeClass("fa-check").addClass("fa-warning"), i.attr("data-original-title", e.text()).tooltip({
                            container: "body"
                        })
                    },
                    invalidHandler: function(e, t) {
                        //i.hide(), r.show(), App.scrollTo(r, -200)
                        $('#msg').css("display", "flex");
                        $('#msg-text').html(form_error);
                        $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                    },
                    highlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
                    },
                    unhighlight: function(e) {},
                    success: function(e, r) {
                        var i = $(r).parent(".input-icon").children("i");
                        $(r).closest(".form-group").removeClass("has-error").addClass("has-success"), i.removeClass("fa-warning").addClass("fa-check")
                    },
                    submitHandler: function(e) {
                        r.hide(), e[0].submit();
                    }
                });

                var a = function() {
                        $("#tab2 .form-control", r).each(function() {
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
                            
                        } 
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
                }).hide(), $("#package_id", r).change(function() {
                    r.validate().element($(this))
                })
            }
        };
    return {
        init: function() {
            user();
        }
    }
}();





jQuery(document).ready(function() {
    
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
    
    FormValidation.init();
});