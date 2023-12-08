var KTFormControls = function() {
    var fbl = function() {
            var e = $("#fbl-frm"),
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
                        email: true
                    },
                    host: {
                        required: true,
                    },
                    port: {
                        required: true,
                    },
                    username: {
                        required: true,
                    },
                    folder: {
                        required: true,
                    },
                    processing_protocols: {
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
            fbl();
        }
    }
}();
jQuery(document).ready(function() {
    KTFormControls.init();

    $("#verify-imap").click(function(){
        $("#verify-imap-msg").attr("style", "display:none");

        var form_data = $("#fbl-frm").serialize();
         $.ajax({
            url: app_url+'/fbl/verify/imap',
            type: "GET",
            data: form_data,
            beforeSend: function( xhr ) {
                $("#verify-imap-msg").html("");
                $("#verify-imap-msg").removeClass("alert alert-success");
                $("#verify-imap").prop("type", "button");
                $("#verify-imap").html("Verifying...");
                $("#verify-imap").addClass("disabled")
            },
            success: function(msg) {
                console.log(msg);
                $("#verify-imap-msg").removeAttr("style", "display:none");
                if (msg.status == 1) {
                    $("#verify-imap-msg").removeClass("alert-danger");
                    $("#verify-imap-msg").addClass("alert alert-success");
                    $("#verify-imap-msg").html(msg.text);
                } else {
                    $("#verify-imap-msg").removeClass("alert-success");
                    $("#verify-imap-msg").addClass("alert alert-danger");
                    $("#verify-imap-msg").html(msg.text);
                }

                $("#verify-imap").removeClass("disabled");
                $("#verify-imap").html("Verify Connection");
                $("#verify-imap").prop("type", "submit");
            }
        });
         return false;
    });
});