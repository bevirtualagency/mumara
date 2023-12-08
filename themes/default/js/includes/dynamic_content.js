var KTFormControls = function() {
    var dynamic_content = function() {
            var e = $("#dynamic-content-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
        $("#dynamic-content-frm").validate({
                rules: {
                    content_name: {
                        required: !0
                    }
                },
                /*invalidHandler: function(e, t) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    Command: toastr["error"] ("You have some form errors. Please check below.");
                    $('#msg').css("display", "flex");
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger ');
                },
                submitHandler: function(e) {
                    r.hide(), e[0].submit();
                }*/
            })
        };
    return {
        init: function() {
            dynamic_content();
        }
    }
}();
jQuery(document).ready(function() {
    KTFormControls.init();
});