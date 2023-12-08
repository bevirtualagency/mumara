var KTFormControls = function() {
    var doamin_masking = function() {
        //var response;
        $.validator.addMethod('validUrl', function(value, element) {
            var url = $.validator.methods.url.bind(this);
            return url(value, element) || url('http://' + value, element);
        }, 'Please enter a valid URL');

            var e = $("#domain-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                ignore: "",
                rules: {
                    domain: {
                        required: true,
                        validUrl: true // <-- change this
                    },
                    
                },
                invalidHandler: function(e, t) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    Command: toastr["error"] ("You have some form errors. Please check below."); 
                    /*$('#msg').css("display", "flex");
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');*/
                },
                success: function(e, r) {
                    var i = $(r).parent(".input-icon").children("i");
                    $(r).closest(".form-group").removeClass("has-error").addClass("has-success"), i.removeClass("fa-warning").addClass("fa-check")
                },
                submitHandler: function(e) {
                    r.hide(), e.submit();
                }
            })
        };
    return {
        init: function() {
            doamin_masking();
        }
    }
}();

jQuery(document).ready(function() {
   KTFormControls.init();
/*
$('#htaccess').click(function() {
        $('.htaccess').show();
        $('.cname').hide();
    });
$('#cname').click(function() {
        $('.cname').show();
        $('.htaccess').hide();
    });

var htaccess = document.getElementById("htaccess");
    if (htaccess.checked){
        $('.htaccess').show();
        $('.cname').hide();
    }
var cname = document.getElementById("cname");
    if (cname.checked){
        $('.cname').show();
        $('.htaccess').hide();
    }
*/
});
