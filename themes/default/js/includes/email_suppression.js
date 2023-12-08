var KTFormControls = function() {
    var email_suppression = function() {
            var e = $("#suppression-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                rules: {
                    label1: {
                        required: true
                    }
                },
                invalidHandler: function(e, t) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    Command: toastr["error"] ("You have some form errors. Please check below."); 
                    //$('#msg').css("display", "flex");
                    //$('#error-msg-text').html(form_error);
                    $('#error-msg').removeClass('display-hide').addClass('alert alert-danger');
                }
            })
        };
    return {
        init: function() {
            email_suppression();
        }
    }
}();
$('#import-file-selection').on('change', function() {
        var import_file_selection = $('#import-file-selection').val();
        if (import_file_selection == 'computer') {
            $("#file-from-computer").show();
            $("#file-from-folder").hide();
            $("#input-in-textarea").hide();
            $("#import-id").attr("required","required");
            $("#folder-import-id").removeAttr("required");
        } else if(import_file_selection == 'folder') {
            $("#file-from-folder").show();
            $("#file-from-computer").hide();
            $("#input-in-textarea").hide();
            $("#folder-import-id").attr("required","required");
            $("#import-id").removeAttr("required");
        } else {
            $("#input-in-textarea").show();
            $("#file-from-folder").hide();
            $("#file-from-computer").hide();
            $("#folder-import-id").removeAttr("required");
            $("#import-id").removeAttr("required");
        }
    });

jQuery(document).ready(function() {
    KTFormControls.init();
});