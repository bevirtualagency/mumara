var KTFormControls = function() {
    var spin_tags = function() {
            var e = $("#spintags-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                ignore: "",
                rules: {
                    place_holder: {
                        required: true,
                    },
                    word_list: {
                        required: true,
                    },
                },
                invalidHandler: function(event, validator) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    Command: toastr["error"] ("You have some form errors. Please check below."); 
                    /*$('#msg').css("display", "flex");
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');*/
                },
                submitHandler: function(e) {
                    //r.hide(), e.submit();
                    var action = $('#action').val();
                    if(action == 'add') {
                        var form_data = $("#spintags-frm").serialize();
                        $.ajax({
                            url :  app_url+'/spintag',
                            type:  'POST',
                            data:  form_data,
                            success: function(result) {
                                if (result.response == 'error'){
                                    Command: toastr["error"] ("You have some form errors. Please check below."); 
                                    /*$('#msg').css("display", "flex");
                                    $('#msg-text').html('' + result.spintag + ' has already been taken');
                                    $('#msg').removeClass('display-hide alert-danger').addClass('alert alert-danger ');*/
                                }else{
                                    if (result == 'save_add') {
                                        Command: toastr["success"] ("Record Successfully created.");
                                        window.location = "/spintag/add";
                                    }
                                    else {
                                        window.location = "/spintags";
                                    }
                                }
                            }
                        });
                         return false;
                    }else{
                         r.hide(), e.submit();
                    }
                }
            })
        };
    return {
        init: function() {
            spin_tags();
        }
    }
}();
jQuery(document).ready(function() {
    KTFormControls.init();
});
