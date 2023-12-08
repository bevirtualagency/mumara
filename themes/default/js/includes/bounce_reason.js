var FormValidation = function() {
    var bounce_reason = function() {
            var e = $("#bounce_reason-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                ignore: "",
                rules: {
                    label: {
                        required: true,
                    },
                },
                invalidHandler: function(e, t) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    $('#msg').css("display", "flex");
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                },
                errorPlacement: function(e, r) {
                    var i = $(r).parent(".input-icon").children("i");
                    i.removeClass("fa-check").addClass("fa-warning"), i.attr("data-original-title", e.text()).tooltip({
                        container: "body"
                    })
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
            })
        };
    return {
        init: function() {
            bounce_reason();
        }
    }
}();
jQuery(document).ready(function() {
    FormValidation.init();
});