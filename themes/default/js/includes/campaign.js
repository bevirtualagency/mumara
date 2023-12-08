var KTFormControls = function() {
    var add_campaign = function() {
            var e = $("#campaign-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                ignore: [],
                rules: {
                    group_name: {
                        required: true,
                    },
                    group_id: {
                        required: !0
                    },
                    contents_url: {
                        required: true,
                    }

                },
                messages: {
                    group_name: {
                    required: "Please select group name",
                   },      
                   group_id: {
                     required: "Please select group name",
                   },     

                },
                invalidHandler: function(event, validator) {
                     
                    console.log('error');
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    $('#msg').css('display', 'flex');
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                    setTimeout(function(){
                      $([document.documentElement, document.body]).animate({
                        scrollTop: $('.is-invalid').eq(0).offset().top
                    }, 1000);  
                  },200);
                    
                },
                submitHandler: function(e) {
                    r.hide(), e.submit();
                }
            })
    };
    var send_preview_email = function() {
            var e = $("#send_preview_email"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            e.validate({
                errorElement: "span",
                errorClass: "help-block help-block-error",
                focusInvalid: !1,
                ignore: [],
                rules: {
                    group_name: {
                        required: true,
                    },
                    group_id: {
                        required: !0
                    },
                    preview_email: {
                        required: true
                    }
                },

                messages: {
                    group_name: {
                    required: "Please select group name",
                   },      
                   group_id: {
                     required: "Please select group name",
                   },     

                },

                invalidHandler: function(e, t) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    $('#msg').css("display", "flex");
                    $('#msg-text').html(form_error);
                    $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                },
                submitHandler: function(e) {
                    //r.hide(), e[0].submit();
                    $(".blockUI").show();
                    var form_data =  $("#send_preview_email").serialize();
                    $.ajax({
                        url: app_url+'/broadcasts/send_preview_email',
                        type: "POST",
                        data: form_data,
                        beforeSend: function( xhr ) {
                            $("#mail-sent-msg").html("");
                            $("#mail-sent-msg").removeClass("alert alert-success");
                            $("#preview-campaign").prop("type", "button");
                            $("#preview-campaign").html("Sending Email...");
                            $("#preview-campaign").addClass("disabled")
                        },
                        success: function(msg) {
                            //console.log(msg);
                            $(".blockUI").hide();
                            if (msg.status == 1) {
                                $("#mail-sent-msg").removeClass("alert-danger");
                                $("#mail-sent-msg").addClass("alert alert-success");
                            } else {
                                $("#mail-sent-msg").removeClass("alert-success");
                                $("#mail-sent-msg").addClass("alert alert-danger");
                            }
                            $("#mail-sent-msg").html(msg.text);
                            $("#preview-campaign").removeClass("disabled");
                            $("#preview-campaign").html("Send Preview Email");
                            $("#preview-campaign").prop("type", "submit");
                        },complete: function () {
                            $("#preview-campaign").removeClass("disabled");
                            $("#preview-campaign").prop("type", "submit");
                            $('.blockUI').hide();
                        }
                    });
                }
            })
    };
    var schedule_campaign = function() {
            function e(e) {
                return e.id ? "<img class='flag' src='/assets/global/img/flags/" + e.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + e.text : e.text
            }
            if (jQuery().bootstrapWizard) {
                var r = $("#submit_form"),
                    t = $(".alert-danger", r),
                    i = $(".alert-success", r);
                r.validate({
                    doNotHideMessage: !0,
                    errorElement: "span",
                    errorClass: "help-block help-block-error",
                    focusInvalid: !1,
                    ignore: [],
                    rules: {
                        group_name: {
                            required: true,
                        },
                        group_id: {
                            required: !0
                        },
                        name: {
                            required: !0
                        },
                        'smtps[]': {
                        required: !0
                        },
                        'masked_domain_ids[]': {
                            required: !0
                        }
                    },
                    messages: {
                        group_name: {
                        required: "Please select group name",
                       },      
                       group_id: {
                         required: "Please select group name",
                       },     
    
                    },
                    invalidHandler: function(event, validator) {
                    //    i.hide(), t.show(), App.scrollTo(t, -200)
                    Command: toastr["error"] ("You have some form errors. Please check below."); 
                    },
                    submitHandler: function(e) {
                        i.show(), t.hide(), r[0].submit()
                    }
                });
                var a = function() {
                        $("#tab4 .form-control-static", r).each(function() {
                            var e = $('[name="' + $(this).attr("data-display") + '"]', r);
                            if (e.is(":radio") && (e = $('[name="' + $(this).attr("data-display") + '"]:checked', r)), e.is(":text") || e.is("textarea")) $(this).html(e.val());
                            else if (e.is("select")) $(this).html(e.find("option:selected").text());
                            else if (e.is(":radio") && e.is(":checked")) $(this).html(e.attr("data-title"));
                            else if ("payment[]" == $(this).attr("data-display")) {
                                var t = [];
                                $('[name="payment[]"]:checked', r).each(function() {
                                    t.push($(this).attr("data-title"))
                                }), $(this).html(t.join("<br>"))
                            }
                        })
                    },
                    o = function(e, r, t) {
                        var i = r.find("li").length,
                            o = t + 1;
                        $(".step-title", $("#form_wizard_1")).text("Step " + (t + 1) + " of " + i), jQuery("li", $("#form_wizard_1")).removeClass("done");
                        for (var n = r.find("li"), s = 0; t > s; s++) jQuery(n[s]).addClass("done");
                        1 == o ? $("#form_wizard_1").find(".button-previous").hide() : $("#form_wizard_1").find(".button-previous").show(), o >= i ? ($("#form_wizard_1").find(".button-next").hide(), $("#form_wizard_1").find(".button-submit").show(), a()) : ($("#form_wizard_1").find(".button-next").show(), $("#form_wizard_1").find(".button-submit").hide())//, App.scrollTo($(".page-title"))
                    };
                $("#form_wizard_1").bootstrapWizard({
                    nextSelector: ".button-next",
                    previousSelector: ".button-previous",
                    onTabClick: function(e, r, t, i) {
                        return !1
                    },
                    onNext: function(e, a, n) {
                        if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 0) {
                            var type = $('#type:checked').val();

                            if (type == 'split_test') {
                                var value = $('#split-test:checked').attr("data");
                                if (value == 'lists') {
                                    $('#campaigns-tab2').show();
                                    $('#lists-tab2').hide();
                                    $('#split-test-check').val('lists');
                                    $('#campaign_disclaimer').show();
                                } else {
                                    $('#lists-tab2').show();
                                    $('#campaigns-tab2').hide();
                                    $('#subscriber_disclaimer').show();
                                }
                            } else {
                                $('#campaigns-tab2').show();
                                $('#lists-tab2').hide();
                                $('#split-test-check').val('campaigns');
                                $('#campaign_disclaimer').hide();
                            }

                            if(list_campaign=='campaigns' && $("#campaign_type").val()=='split_test'){
                                $('#lists-tab2').show();
                                $('#campaigns-tab2').hide();
                            }else{
                                $('#lists-tab2').hide();
                                $('#campaigns-tab2').show();
                            }


                            if($('#campaign_type option:selected').val() == 'regular' && type == 'subscriber'){
                            var values = $('input:checkbox:checked').map(function () {
                            return this.value;
                            }).get();
                            $.ajax({
                                    url: app_url+'/broadcasts/schedule/create',
                                    type: 'POST',
                                    data: {ids: values},
                                    success: function(result) {
                                        if(result == 'false'){
                                            $('#form_wizard_1').bootstrapWizard('show',0);
                                            $('#msg').css("display", "flex");
                                            $('#msg-text').html('selected list have no subscribers');
                                            $('#msg').removeClass('display-hide').addClass('alert alert-danger');
                                            return false;
                                        }
                                    }
                                });
                            };
                        }
                        if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 2) {
                            var campaign_type = $('#campaign_type').val();
                            if (campaign_type == 'regular' || campaign_type == 'split_test') {
                                $('#regular-campaign').show();
                                $('#evergreen-campaign').hide();
                            } else {
                                $('#evergreen-campaign').show();
                                $('#regular-campaign').hide();
                            }
                        }
                        return i.hide(), t.hide(), 0 == r.valid() ? !1 : void o(e, a, n)
                    },
                    onPrevious: function(e, r, a) {
                        i.hide(), t.hide(), o(e, r, a)
                    },
                    onTabShow: function(e, r, t) {
                        var i = r.find("li").length,
                            a = t + 1,
                            o = a / i * 100;
                        $("#form_wizard_1").find(".progress-bar").css({
                            width: o + "%"
                        })
                    }
                }), $("#form_wizard_1").find(".button-previous").hide(), $("#form_wizard_1 .button-submit").click(function() {
                    //alert("Finished! Hope you like it :)")
                    r[0].submit();
                }).hide(), $("#country_list", r).change(function() {
                    r.validate().element($(this))
                })
            }
        };
    return {
        init: function() {
            add_campaign();
            send_preview_email();
            schedule_campaign();
        }
    }
}();

jQuery(document).ready(function() {
    KTFormControls.init();

    $("#frm-group").submit(function(){
        var form_data =  $("#frm-group").serialize();
        $.ajax({
            url: app_url+'/group',
            type: "POST",
            data: form_data,
            success: function(result) {
                if (result == 'success') {
                    groups_msg = 'Group(s) successfully added!';
                    msg = 'alert alert-success';
                }else{
                    groups_msg = '' + result + ' already Exist';
                    msg = 'alert alert-danger';
                }
                $('#msg-group').css("display", "flex");
                $('#msg-text-group').html(groups_msg);
                $('#msg-group').removeClass('display-hide alert-danger').addClass(msg);
                $('#msg-group').delay(2500).hide('slow');

                $.getJSON( "/group?section_id=3", function( data ) {
                    var $el = $("#group-id");
                    $el.select2("destroy");
                    $el.empty(); // remove old options
                    $.each(data, function(key,value) {
                        var child=$("<option></option>").attr("value", value).text(key);
                        // Selected last value
                      if($('#group_name').val()==key){
                         child.attr("selected", "selected");
                         $el.append(child);
                      }else{
                        $el.append(child);
                      }
                    });
                         $el.select2();
                });
            }
        });
        return false;
    });
    

    $('.remove-attachment').click(function() {
        console.log('amjad:', $(this).data("id"));
        var attachment_id = $(this).data("id");
        var old_attchment_name = $('#old_attachment_name_'+attachment_id).val();
        $('#attachment_'+attachment_id).hide();
        $('#old_attachment_'+attachment_id).val(old_attchment_name);
    });

    $('#send-now').click(function() {
        $('.sendign-time').hide();
    });

    $('#send-later').click(function() {
        $('.sendign-time').show();
    });

    $('body').on("click" , ".group-selector-subscriber", function () {
        var group = this.id;
        if($(this).is(':checked')) {
            $('.group-subscriber-'+group).not(':disabled').prop('checked', true);
        } else {
            $('.group-subscriber-'+group).prop('checked', false);
        }
    });

    $('body').on("click" , ".group-selector-campaign", function () {
        var type = $('#type:checked').val();
        if (type == 'split_test') {
            $(".group-selector-campaign").attr("disabled", true);
            return false;
        }
        var group = this.id;
        if($(this).is(':checked')) {
            $('.group-campaign-'+group).not(':disabled').prop('checked', true);
        } else {
            $('.group-campaign-'+group).prop('checked', false);
        }
    });
});