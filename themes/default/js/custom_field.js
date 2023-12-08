var KTFormControls = function() {
    var add_list = function() {
            var e = $("#custom-field-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
        jQuery.validator.addMethod("lettersonly", function(value, element) {
            return this.optional(element) || /^[A-Za-z]+$/i.test(value[0]);
        }, alphaError);
        jQuery.validator.addMethod("aun", function(value, element) {
            if(value.length>1)
                return /^[\w\s]+$/.test(value.substring(1));
            return true;
        }, mixError);
        e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                ignore: "",
                rules: {
                    name: {
                        required: !0,
                        lettersonly: true,
                        aun:true
                    },
                    type: {
                        required: !0
                    },
                    field_order: {
                        number: true
                    }

                },
                //                    'lists[]': {
//                        required: !0,
//                        minlength: 1
//                    }
                invalidHandler: function(event, validator) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    Command: toastr["error"] ("You have some form errors. Please check below."); 
                    //$('#msg').css("display", "flex");
                    //$('#msg-text').html(form_error);
                    //$('#msg').removeClass('display-hide').addClass('alert alert-danger');
                },
                success: function(e, r) {
                    var i = $(r).parent(".input-icon").children("i");
                    $(r).closest(".form-group").removeClass("has-error").addClass("has-success"), i.removeClass("fa-warning").addClass("fa-check")
                },
                submitHandler: function(e) {
                    //i.show(), r.hide(), e[0].submit()
                    //r.hide(), e[0].submit()
                  //  var action = $('#action').val();
                  var type=$('#type-id').val();
                  if(type=="checkbox" || type=="select" || type=="radio"){
                    var options=$('textarea[name="options"]').val();
                    if(options){
                        var flag=0;
                        $.each(options.split(/\n/),function(i,val){
                            if (val.indexOf(',') != -1) {
                                flag=1;
                              return false; // breaks
                            }
                        });
                        if(flag==1){
                            $('textarea[name="options"]').addClass("is-invalid");
                             Command: toastr["error"](forbidden_error);
                            return;
                        }else{
                          $('textarea[name="options"]').removeClass("is-invalid"); 
                        }
                    }

                    }
      

                        if($("#action").val() == 'add') {
                            var method = 'POST';
                            var url = storeUrl;
                        } else {
                            var id = $('#custom-field-id').val();
                            var method = 'PUT';
                            var url = updateUrl+id;
                        }
                        var name = $('#nameDB').val();
                        var check = $.isNumeric(name); 
                        if(check){
                            $("#nameDBError").show();
                            return false;
                        }else{
                            $("#nameDBError").hide();
                        }
                    //    if(action == 'edit') {
                        
                        var form_data =  $("#custom-field-frm").serialize();
                        $.ajax({
                            url: url,
                            type: method,
                            data: form_data,
                            success: function(result) {
                                //$('#msg').css("display", "flex");
                                //$('#msg-text').html('Custom Field successfully updated!');
                                //$('#msg').removeClass('display-hide alert-danger').addClass('alert alert-success ');
                                //$('#msg').delay(1000).hide('slow');
                                if (result.response == 'save_add') {
                                        Command: toastr["success"] (result.msg);
                                        window.location = createUrl;
                                    } else if (result.response == 'edit') {
                                    str = editUrl;
                                    res = str.replace("|id|", id);
                                        window.location = res;
                                    } else if (result.response == 'duplicate') {
                                    Command: toastr["error"] (result.msg);
                                    } else if (result.response == 'error') {
                                    Command: toastr["error"] (result.msg);
                                    } else {
                                        Command: toastr["success"] (result.msg);
                                        window.location = indexUrl;
                                    }
                            }
                        });
                     //   return false;
                  //  } else {
                     //   r.hide(), e[0].submit();
                  //  }
                }
            })
        };
    return {
        init: function() {
            add_list()
        }
    }
}();
jQuery(document).ready(function() {
    KTFormControls.init();

    var list_of_values = $('#type-id').val();
    if(list_of_values == 'checkbox' || list_of_values == 'select' || list_of_values == 'radio') {
        $('#list-of-values').show();
    } else {
        $('#list-of-values').hide();
    }

    $('#type-id').on('change', function() {
        if(this.value == 'checkbox' || this.value == 'select' || this.value == 'radio') {
            $('#list-of-values').show();
        } else {
            $('#list-of-values').hide();
        }
    });
});