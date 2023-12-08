var KTFormControls = function() {
    var autorespondergroups = function() {

            var e = $("#submit-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            $("#submit-frm").validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                rules: {
                    name: {
                        required: true,
                    },
                    'smtp_lists[]': {
                        required: true
                    }
                   /*,
                    masking_domain: {
                        required: true
                    }*/
                },
                invalidHandler: function(event, validator) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    //Command: toastr["error"] ("You have some form errors. Please check below.");
                    $('#msg').css("display", "flex");
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                }
            })
        };
    return {
        init: function() {
            autorespondergroups();
        }
    }
}();
jQuery(document).ready(function() {
    KTFormControls.init();
});
