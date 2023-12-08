var KTFormControls = function() {
    var bounce = function() {
            var e = $("#bounce-frm"),
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
                        required: true
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
                invalidHandler: function(e, t) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    Command: toastr["error"] (form_error); 
                    /*$('#msg').css("display", "flex");
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger ');*/
                },
                submitHandler: function(e) {
                    r.hide(), e[0].submit();
                }
            })
        };
    return {
        init: function() {
            bounce();
        }
    }
}();
jQuery(document).ready(function() {
    KTFormControls.init();

    $("#verify-imap").click(function(){
        $("#verify-imap-msg").attr("style", "display:none");
        $(".blockUI").show();

        var form_data = $("#bounce-frm").serialize();
         $.ajax({
            url: app_url+'/verify-imap',
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
                $(".blockUI").hide();
                $("#verify-imap").removeClass("disabled");
                $("#verify-imap").html("Verify Connection");
                $("#verify-imap").prop("type", "submit");
            }
        });
         return false;
    });

});