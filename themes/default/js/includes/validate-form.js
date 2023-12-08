function createOrUpdate(method,route,formId,e,btn_id,reload)
{
    e.preventDefault();
    var btn_val;
            try{
                btn_val = $('#'+btn_id).val();
                if(btn_val===undefined || btn_val=="")
                    btn_val = 1;
            }
            catch (error)
            {
                btn_val = 1
            }
            data = $(formId).serialize()+'&'+btn_id+'='+btn_val;
            $.ajax({
                type: method,
                url: route,
                data: data,
                cache: false,
                dataType: 'json',
                beforeSend: function() {
                    $('.blockUI').show();
                    $('.form-control').removeClass('is-invalid');
                    $('.error').css('display','none');
                    $(".btn-set").addClass("pnone");
                    $(".cancel").addClass("pnone");
                    $(".btn-set").removeClass("kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light");
                    $("#"+btn_id).addClass("kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light");
                    $(".btn-set").attr("disabled", "disabled");
                },
                success: function (data) {
                    $(".btn-set").removeClass("kt-spinner kt-spinner--right kt-spinner--md kt-spinner--light");
                    $(".btn-set").removeAttr("disabled", "disabled");
                    $(".btn-set, cancel").removeClass("pnone");
                    $('.blockUI').hide();
                    if (data.status==true) {
                        $('#modal-group-label').hide();
                        if(data.message!==undefined) {
                            toastr.success(data.message);
                            if(data.redirectTo!==undefined) {
                                setTimeout(function () {
                                    window.location.href = data.redirectTo;
                                }, 1000);
                            }
                        }
                        if(reload)
                            location.reload();
                        else if(method=='post'||method=='POST')
                            $(formId).trigger('reset');

                    }
                    else {
                         if(data.status=='error'){
                             if(data.message==undefined) {
                                 $('#api_access_ips').addClass('is-invalid');
                                 $('#api_access_ips-error').addClass("The api access ips must be a valid IP address");
                                 toastr.error("The api access ips must be a valid IP address");
                             }
                             else
                                 toastr.error(data.message);
                             return false;
                        }
                        if(data.status=='validation_failed')
                        {
                            var x;
                            messages = data.messages;
                            for (x in messages) {
                             $('#'+x).addClass('is-invalid');
                             id = '#'+x+'-error';
                             $(id).html(messages[x]);
                             $(id).css('display','block');
                            }
                        }
                        if(data.message!==undefined) {
                            toastr.error(data.message);
                        }
                        $('html, body').animate({
                            scrollTop: $(formId).offset().top
                        }, 800);

                    }
                    return false;
                },complete: function () {
                         $('.blockUI').hide();
                    }
            });
}
