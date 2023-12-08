var KTFormControls = function() {
    var users = function() {
            var e = $("#subuser-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                ignore: "",
                rules: {
                    name: {
                        required: true,
                    },
                },
                invalidHandler: function(event, validator) {
                    Command: toastr["error"] ("You have some form errors. Please check below.");
                },
                submitHandler: function(e) {
                    r.hide(), e.submit();
                }
            })
        };
    return {
        init: function() {
            users();
        }
    }
}();
jQuery(document).ready(function() {
    KTFormControls.init();
});