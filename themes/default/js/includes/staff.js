var KTFormControls = function() {
    var users = function() {
            var e = $("#staff-frm"),
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
                    role_id: {
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