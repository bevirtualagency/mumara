function processFrom(method,route,formId,e,btn_id,success_div=null,error_div=null)
{
    e.preventDefault();
    data = $(formId).serialize()+'&'+btn_id+'=1';
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
            $('#'+error_div).hide();
            $('#'+success_div).hide();
        },
        success: function (data) {
            $('.blockUI').hide();
            if (data.status==true) {
                if(method=='post' || method=='POST')
                    $(formId).trigger("reset");
                $('#modal-group-label').hide();
                if(data.message!==undefined) {
                    if(success_div!==undefined) {
                        $('#'+success_div).show();
                        $('#'+success_div).html(data.message);
                    }
                    else {
                        toastr.success(data.message);
                    }
                    if(data.redirectTo!==undefined) {
                        setTimeout(function () {
                            window.location.href = data.redirectTo;
                        }, 1000);
                    }
                }
            }
            else {
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
                    if(success_div!==undefined) {
                        $('#'+error_div).show();
                        $('#'+error_div).html(data.message);
                    }
                    else
                    toastr.error(data.message);
                }
                $('html, body').animate({
                    scrollTop: $(formId).offset().top
                }, 800);

            }
            return false;
        },complete: function (data) {

            $('.blockUI').hide();

            var  status = data['status']
            if(status==422)
            {
                var response =data['responseJSON']['errors'];
                for (x in response) {
                    $('#'+x).addClass('is-invalid');
                    id = '#'+x+'-error';
                    $(id).html(response[x]);
                    $(id).css('display','block');
                }
                console.log(response);
            }

        }
    });
}
