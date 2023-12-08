var KTFormControls = function() {
    var split_test_campaign = function() {
            var e = $("#split_tests-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                rules: {
                    name: {
                        required: true,
                    },
                    'campaigns[]': {
                        required: true,
                        minlength: 2
                    },
                    send_emails_limit:{
                        required: true,
                    },
                    link_id:{
                        //required: true,
                    },
                },
                invalidHandler: function(event, validator) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    $('#msg').css('display', 'flex');
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                }
            })
        };
    var split_test_list = function() {
            var e = $("#split_tests-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                rules: {
                    name: {
                        required: true,
                    },
                    'lists[]': {
                        required: true,
                        minlength: 2
                    },
                    send_emails_limit:{
                        required: true,
                    },
                    link_id:{
                        //required: true,
                    },
                },
                invalidHandler: function(event, validator) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    $('#msg').css("display", "flex");
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                }
            })
        };
    return {
        init: function() {
            $(".btn-submit").click(function() {
                if( $('#test_on1').is(':checked')) {
                    split_test_campaign();
                } else if( $('#test_on2').is(':checked')) {
                    split_test_list();
                } else {

                }
            });
        }
    }
}();
$(".btn-submit").click(function( event ) {
    KTFormControls.init();
});