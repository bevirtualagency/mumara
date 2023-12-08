var FormValidation = function() {
    var pmta_wizard = function() {
            function e(e) {
                return e.id ? "<img class='flag' src='/assets/global/img/flags/" + e.id.toLowerCase() + ".png'/>&nbsp;&nbsp;" + e.text : e.text
            }
            if (jQuery().bootstrapWizard) {
                var r = $("#pmta-wizard"),
                    t = $(".alert-danger", r),
                    i = $(".alert-success", r);
                r.validate({
                    doNotHideMessage: !0,
                    errorElement: "span",
                    errorClass: "help-block help-block-error",
                    focusInvalid: !1,
                    rules: {
                        server_name: {
                            required: !0
                        },
                        'group_name[]': {
                            required: !0
                        },
                        'masking_domain[]': {
                            required: !0
                        }
                    },
                    errorPlacement: function(e, r) {
                       // "gender" == r.attr("name") ? e.insertAfter("#form_gender_error") : "payment[]" == r.attr("name") ? e.insertAfter("#form_payment_error") : e.insertAfter(r)
                    },
                    invalidHandler: function(e, r) {
                        i.hide(), t.show(), App.scrollTo(t, -200)
                    },
                    highlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-success").addClass("has-error")
                    },
                    unhighlight: function(e) {
                        $(e).closest(".form-group").removeClass("has-error")
                    },
                    success: function(e) {
                        "gender" == e.attr("for") || "payment[]" == e.attr("for") ? (e.closest(".form-group").removeClass("has-error").addClass("has-success"), e.remove()) : e.addClass("valid").closest(".form-group").removeClass("has-error").addClass("has-success")
                    },
                    submitHandler: function(e) {
                        i.show(), t.hide(), r[0].submit()
                    }
                });
                var a = function() {
                    $("#tab5 .form-control-static", r).each(function() {
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
                    1 == o ? $("#form_wizard_1").find(".button-previous").hide() : $("#form_wizard_1").find(".button-previous").show(), o >= i ? ($("#form_wizard_1").find(".button-next").hide(), $("#form_wizard_1").find(".button-submit").show(), a()) : ($("#form_wizard_1").find(".button-next").show(), $("#form_wizard_1").find(".button-submit").hide()), App.scrollTo($(".page-title"))

                    if(o == 2){
                        $("#form_wizard_1").find(".button-next").hide();
                    }
                    if(o == 8){
                        $("#form_wizard_1").find(".button-next").html('Continue');;
                    }
                    if(o == 10){
                        //$("#form_wizard_1").find(".button-previous").hide();
                        //$("#form_wizard_1").find(".button-submit").html('Finish');
                        $("#form_wizard_1").find(".button-previous").hide();
                        $("#form_wizard_1").find(".button-submit").hide();
                    }
                };
                $("#form_wizard_1").bootstrapWizard({
                    nextSelector: ".button-next",
                    previousSelector: ".button-previous",
                    onTabClick: function(e, r, t, i) {
                        return !1
                    },
                    onNext: function(e, a, n) {
                        if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 0) {
                            var web_monitor_url = $('#web_monitor_url').val().split('//');
                            web_monitor_url = web_monitor_url[1].split(':');
                            $('#server_ip').val(web_monitor_url[0]);
                            $('#http_port').val(web_monitor_url[1]);
                        } else if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 4) {

                            var form_data = new Object;
                            form_data['ips']     = $('#ips').val();
                            ips_str = $('#ips').val();
                            $("#ips_array").val(JSON.stringify(ips_str.split("\n")));
                            form_data['domains'] = $('#domains').val();
                            form_data['masking_domain'] = $('#masking-domain-selector').val();
                            $.ajax({
                                url: app_url+'/mapPMTADomainIP',
                                type: "POST",
                                data: { action: "map_pmta_domins_ips", form_data: form_data},
                                beforeSend: function( xhr ) {
                                    $('#split-ips-domains').html('Loading...');
                                },
                                success: function(result) {
                                    $('#split-ips-domains').html(result);
                                    $('.masking-selector').val($('#masking-domain-selector').val());
                                }
                            });
                        } else if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 5) {
                            var form_data =  $("#pmta-wizard").serialize();
                            $.ajax({
                                url: app_url+'/bounce_mail_boxes',
                                type: "POST",
                                data: form_data,
                                beforeSend: function( xhr ) {
                                    $('#bounce-mailboxes').html('Loading...');
                                },
                                success: function(result) {
                                    console.log(result);
                                    $('#bounce-mailboxes').html(result);
                                }
                            });
                        } else if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 6) {
                            var form_data =  $("#pmta-wizard").serialize();
                            $.ajax({
                                url: app_url+'/sending_domains',
                                type: "POST",
                                data: form_data,
                                beforeSend: function( xhr ) {
                                    $('#sending-domains').html('Loading...');
                                },
                                success: function(result) {
                                    console.log(result);
                                    $('#sending-domains').html(result);
                                }
                            });
                        } else if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 7) {
                            $('.button-next').html('Finish');
                            var form_data =  $("#pmta-wizard").serialize();
                            $.ajax({
                                url: app_url+'/pmta/config/view-pre',
                                type: "POST",
                                data: form_data,
                                beforeSend: function( xhr ) {
                                    $('#pmta-summery').html('Loading...');
                                },
                                success: function(result) {
                                    console.log(result);
                                    $('#pmta-summery').html(result);
                                }
                            });

                        } else if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 8) {
                            verifyStepsPmta();

                        }
                        /*else if ($('#form_wizard_1').bootstrapWizard('currentIndex') == 7) {
                            var form_data =  $("#pmta-wizard").serialize();
                            $.ajax({
                                url: '/makePMTASummery',
                                type: "POST",
                                data: form_data,
                                beforeSend: function( xhr ) {
                                    $('#pmta-summery').html('Loading...');
                                },
                                success: function(result) {
                                    console.log(result);
                                    $('#pmta-summery').html(result);
                                }
                            });
                        }*/
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
            pmta_wizard();
        }
    }
}();

jQuery(document).ready(function() {
    FormValidation.init();
});

function verifyStepsPmta() {
    var form_data =  $("#pmta-wizard").serialize();
    $.ajax({
        url: app_url+'/pmta/config/create-pmta',
        type: "POST",
        data: form_data + '&val=0',
        beforeSend: function( xhr ) {
            $('#setup-pmta').html('Loading...');
        },
        success: function(result) {
            console.log(result);
            var obj = JSON.parse(result);
            $('#setup-pmta').html(obj.data_pmta);
            $.ajax({
                url: app_url+'/pmta/config/create-pmta',
                type: "POST",
                data: form_data + '&val=1',
                beforeSend: function( xhr ) {
                    $('#tbl-connet-pmta-web-monitor').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                },
                success: function(result) {
                    console.log(result);
                    var obj = JSON.parse(result);
                    if(obj.status) {
                        $('#tbl-connet-pmta-web-monitor').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                    } else {
                        $('#tbl-connet-pmta-web-monitor').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-exclamation-triangle font-yellow-gold');
                    }

                    if(obj.status || 1) {
                        //$('#tbl-connet-pmta-web-monitor').removeClass('fa-times').addClass('fa-check');
                        $.ajax({
                            url: app_url+'/pmta/config/create-pmta',
                            type: "POST",
                            data: form_data + '&val=2',
                            beforeSend: function( xhr ) {
                                $('#tbl-connet-server').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                            },
                            success: function(result) {
                                console.log(result);
                                var obj = JSON.parse(result);
                                if(obj.status) {
                                    $('#tbl-connet-server').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                    $.ajax({
                                        url: app_url+'/pmta/config/create-pmta',
                                        type: "POST",
                                        data: form_data + '&val=3',
                                        beforeSend: function( xhr ) {
                                            $('#tbl-checking-folder').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                        },
                                        success: function(result) {
                                            console.log(result);
                                            var obj = JSON.parse(result);
                                            if(obj.status) {
                                                $('#tbl-checking-folder').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                                $.ajax({
                                                    url: app_url+'/pmta/config/create-pmta',
                                                    type: "POST",
                                                    data: form_data + '&val=4',
                                                    beforeSend: function( xhr ) {
                                                        $('#tbl-backup-old-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                    },
                                                    success: function(result) {
                                                        console.log(result);
                                                        var obj = JSON.parse(result);
                                                        if(obj.status) {
                                                            $('#tbl-backup-old-pmta').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                                            $.ajax({
                                                                url: app_url+'/pmta/config/create-pmta',
                                                                type: "POST",
                                                                data: form_data + '&val=5',
                                                                beforeSend: function( xhr ) {
                                                                    $('#tbl-config-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                                },
                                                                success: function(result) {
                                                                    console.log(result);
                                                                    var obj = JSON.parse(result);
                                                                    if(obj.status) {
                                                                        $('#tbl-config-pmta').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                                                        $.ajax({
                                                                            url: app_url+'/pmta/config/create-pmta',
                                                                            type: "POST",
                                                                            data: form_data + '&val=6',
                                                                            beforeSend: function( xhr ) {
                                                                                $('#tbl-verify-private-domain').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                                            },
                                                                            success: function(result) {
                                                                                console.log(result);
                                                                                var obj = JSON.parse(result);
                                                                                if(obj.status) {
                                                                                    $('#tbl-verify-private-domain').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                                                                    $.ajax({
                                                                                        url: app_url+'/pmta/config/create-pmta',
                                                                                        type: "POST",
                                                                                        data: form_data + '&val=7',
                                                                                        beforeSend: function( xhr ) {
                                                                                            $('#tbl-configur-bounce').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                                                        },
                                                                                        success: function(result) {
                                                                                            console.log(result);
                                                                                            var obj = JSON.parse(result);
                                                                                            if(obj.status) {
                                                                                                $('#tbl-configur-bounce').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                                                                                $.ajax({
                                                                                                    url: app_url+'/pmta/config/create-pmta',
                                                                                                    type: "POST",
                                                                                                    data: form_data + '&val=8',
                                                                                                    beforeSend: function( xhr ) {
                                                                                                        $('#tbl-adding-sending-domains').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                                                                    },
                                                                                                    success: function(result) {
                                                                                                        console.log(result);
                                                                                                        var obj = JSON.parse(result);
                                                                                                        if(obj.status) {
                                                                                                        $('#tbl-adding-sending-domains').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                                                                                            $.ajax({
                                                                                                                url: app_url+'/pmta/config/create-pmta',
                                                                                                                type: "POST",
                                                                                                                data: form_data + '&val=9',
                                                                                                                beforeSend: function( xhr ) {
                                                                                                                    $('#tbl-sending-nodes').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                                                                                },
                                                                                                                success: function(result) {
                                                                                                                    console.log(result);
                                                                                                                    var obj = JSON.parse(result);
                                                                                                                    if(obj.status) {
                                                                                                                        $('#tbl-sending-nodes').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                                                                                                        $.ajax({
                                                                                                                            url: app_url+'/pmta/config/create-pmta',
                                                                                                                            type: "POST",
                                                                                                                            data: form_data + '&val=10',
                                                                                                                            beforeSend: function( xhr ) {
                                                                                                                                $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                                                                                            },
                                                                                                                            success: function(result) {
                                                                                                                                console.log(result);
                                                                                                                                var obj = JSON.parse(result);
                                                                                                                                if(obj.status) {
                                                                                                                                $('#tbl-start-pmta').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');
                                                                                                                                    $.ajax({
                                                                                                                                        url: app_url+'/pmta/config/create-pmta',
                                                                                                                                        type: "POST",
                                                                                                                                        data: form_data + '&val=11',
                                                                                                                                        beforeSend: function( xhr ) {
                                                                                                                                            $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                                                                                                        },
                                                                                                                                        success: function(result) {
                                                                                                                                            console.log(result);
                                                                                                                                            var obj = JSON.parse(result);
                                                                                                                                            if(obj.status) {
                                                                                                                                                $('#tbl-restart-pmta-http').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');                                                                                                                                                                        $.ajax({
                                                                                                                                                    url: app_url+'/pmta/config/create-pmta',
                                                                                                                                                    type: "POST",
                                                                                                                                                    data: form_data + '&val=12',
                                                                                                                                                    beforeSend: function( xhr ) {
                                                                                                                                                        $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa-cog fa-spin font-blue-dark');
                                                                                                                                                    },
                                                                                                                                                    success: function(result) {
                                                                                                                                                        console.log(result);
                                                                                                                                                        var obj = JSON.parse(result);
                                                                                                                                                        if(obj.status) {
                                                                                                                                                            $('#tbl-verify-connections').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa-check font-green-meadow');  
                                                                                                                                                            //$('#success-msg').html('<span class="text-success">Congratulations!!! Your PowerMTA Server has been Successfully Deployed</span>');
                                                                                                                                                              $('#tbl-steps').hide();
                                                                                                                                                              $('#success').show();
                                                                                                                                                        } else {
                                                                                                                                                            $('#tbl-verify-connections').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                                                                                                                        }
                                                                                                                                                    }
                                                                                                                                                });
                                                                                                                                            } else {
                                                                                                                                                $('#tbl-restart-pmta-http').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                                                                                                                $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                                                            }
                                                                                                                                        }
                                                                                                                                    });
                                                                                                                                } else {
                                                                                                                                    $('#tbl-start-pmta').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                                                                                                    $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                                                    $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                                                }
                                                                                                                            }
                                                                                                                        });
                                                                                                                        
                                                                                                                    } else {
                                                                                                                        $('#tbl-sending-nodes').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                                                                                        $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                                        $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                                        $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                                    }
                                                                                                                }
                                                                                                            });  
                                                                                                        } else {
                                                                                                            $('#tbl-adding-sending-domains').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                                                                            $('#tbl-sending-nodes').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                            $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                            $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                            $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                        }
                                                                                                    }
                                                                                                });

                                                                                            } else {
                                                                                                $('#tbl-configur-bounce').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                                                                $('#tbl-adding-sending-domains').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                $('#tbl-sending-nodes').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                                $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                            }
                                                                                        }
                                                                                    });
                                                                                } else {
                                                                                    $('#tbl-verify-private-domain').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                                                    $('#tbl-configur-bounce').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                    $('#tbl-adding-sending-domains').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                    $('#tbl-sending-nodes').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                    $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                    $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                    $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                                }
                                                                            }
                                                                        });
                                                                    } else {
                                                                        $('#tbl-config-pmta').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                                        $('#tbl-verify-private-domain').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                        $('#tbl-configur-bounce').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                        $('#tbl-adding-sending-domains').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                        $('#tbl-sending-nodes').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                        $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                        $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                        $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                                    }
                                                                }
                                                            });
                                                        } else {
                                                            $('#tbl-backup-old-pmta').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                            $('#tbl-config-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                            $('#tbl-verify-private-domain').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                            $('#tbl-configur-bounce').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                            $('#tbl-adding-sending-domains').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                            $('#tbl-sending-nodes').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                            $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                            $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                            $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                        }
                                                    }
                                                });
                                            } else {
                                                 $('#tbl-checking-folder').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                                 $('#tbl-backup-old-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                 $('#tbl-config-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                 $('#tbl-verify-private-domain').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                 $('#tbl-configur-bounce').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                 $('#tbl-adding-sending-domains').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                 $('#tbl-sending-nodes').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                 $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                 $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                                 $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                            }
                                        }
                                    });
                                } else {
                                     $('#tbl-connet-server').removeClass('fa-cog fa-spin font-blue-dark').addClass('fa fa-close font-red');
                                     $('#tbl-checking-folder').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-backup-old-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-config-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-verify-private-domain').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-configur-bounce').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-adding-sending-domains').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-sending-nodes').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-start-pmta').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-restart-pmta-http').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                     $('#tbl-verify-connections').removeClass('fa-hourglass font-grey-mint').addClass('fa fa-exclamation-triangle font-yellow-gold');
                                }
                            }
                        });
                    }
                }
            });
        }
    });
}

function showDetailBounce(attr, id) {
    var class_name = $("#li-"+id).attr('class');
    if(class_name == 'fa fa-plus-square-o') {
        $("#"+id).show();
        $("#li-"+id).removeClass('fa-plus-square-o');
        $("#li-"+id).addClass('fa-minus-square-o');
    } else {
        $("#"+id).hide();
        $("#li-"+id).removeClass('fa-minus-square-o');
        $("#li-"+id).addClass('fa-plus-square-o');
    }
}

function verifyBounce(id) {
    $('#'+id+'-msg').html('');
    $('#'+id+'-verify-btn').val('Verifying');
    var values = $("input[name='"+id+"[]']").map(function(){
        return $(this).val();
    }).get();
    var encryption = $('#'+id+'-encryption').val();
    var method = $('#'+id+'-method').val();
    $.ajax({
        url: app_url+'/pmta/testBounce',
        type: "POST",
        data: {values: values, method: method, encryption: encryption, verify:'bounce'},
        success: function(result) {
            console.log(result);

            if(result == 'Verified') {
                $('#'+id+'-msg').html("<font color='green'>Verified</font>");
                $("#chk-"+id).removeClass('fa fa-times');
                $("#chk-"+id).addClass('fa fa-check');
            } else {
                $('#'+id+'-msg').html(result);
            }
            $('#'+id+'-verify-btn').val('Verify Connection');
        }
    });
}

function verifyDomain(domain, id) {
    $('#'+id+'-msg').html('');
    $('#'+id+'-domain-verify-btn').val('Verifying');
    $('#'+id+'-msg').html("<font>...</font>");
    $.ajax({
        url: app_url+'/pmta/testBounce',
        type: "POST",
        data: {domain: domain, verify:'domain'},
        success: function(result) {
            console.log(result);

            if(result == 'Verified') {
                $('#'+id+'-msg').html("<font color='green'>Verified</font>");
                $("#chk-"+id).removeClass('fa fa-times');
                $("#chk-"+id).addClass('fa fa-check');
            } else {
                $("#chk-"+id).removeClass('fa fa-check');
                $("#chk-"+id).addClass('fa fa-times');
                $('#'+id+'-msg').html(result);
            }
            $('#'+id+'-domain-verify-btn').val('Refresh');
        }
    });

}

function showDetailMask(attr, id) {
    var class_name = $("#li-"+id).attr('class');
    if(class_name == 'fa fa-plus-square-o') {
        $("#"+id).show();
        $("#li-"+id).removeClass('fa-plus-square-o');
        $("#li-"+id).addClass('fa-minus-square-o');
    } else {
        $("#"+id).hide();
        $("#li-"+id).removeClass('fa-minus-square-o');
        $("#li-"+id).addClass('fa-plus-square-o');
    }
}