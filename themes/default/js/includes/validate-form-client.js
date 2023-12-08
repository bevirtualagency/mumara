function createOrUpdate(method,route,formId,e,btn_id)
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
                },
                success: function (data) {
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
                    }
                    else {

                        if(data.status=='error'){
                            $('#api_access_ips').addClass('is-invalid');
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
                },
                error: function () {
                    $('.blockUI').hide();
                    Command: toastr["success"] ("Record Successfully Saved.");
                    window.location = app_url+"/clients";
                }/*,
                complete: function () {
                    $('.blockUI').hide();
                    Command: toastr["success"] ("Record Successfully Saved.");
                    window.location = app_url+"/clients";
                }*/
            });
}

// function old_createOrUpdate(method,route,formId,e,btn_id){
//     console.log('createOrUpdate function 2');
//     const data = $(formId).serialize()+'&'+btn_id+'=1';
//     console.log('data 2', data);
//     // data = $(formId).serialize()+'&'+btn_id+'=1';
//     $.ajax({
//         type: method,
//         url: route,
//         data: data,
//         cache: false,
//         dataType: 'json',
//         beforeSend: function() {
//             $('.blockUI').show();
//             $('.form-control').removeClass('is-invalid');
//             $('.error').css('display','none');
//         },
//         success: function (data) {
//             console.log('data', data);
//             $('.blockUI').hide();
//             if (data.status==true) {
//                 $('#modal-group-label').hide();
//                 if(data.message!==undefined) {
//                     toastr.success(data.message);
//                     if(data.redirectTo!==undefined) {
//                         setTimeout(function () {
//                             // window.location.href = data.redirectTo;
//                         }, 1000);
//                     }
//                 }
//             }
//             else {
//                 if(data.status=='validation_failed')
//                 {
//                     var x;
//                     messages = data.messages;
//                     for (x in messages) {
//                         $('#'+x).addClass('is-invalid');
//                         id = '#'+x+'-error';
//                         $(id).html(messages[x]);
//                         $(id).css('display','block');
//                     }
//                 }
//                 if(data.message!==undefined) {
//                     toastr.error(data.message);
//                 }
//                 $('html, body').animate({
//                     scrollTop: $(formId).offset().top
//                 }, 800);

//             }
//             return false;
//         },
//         error: function () {
//             $('.blockUI').hide();
//             Command: toastr["success"] ("Record Successfully Saved.");
//             // window.location = app_url+"/clients";
//         }/*,
//         complete: function () {
//             $('.blockUI').hide();
//             Command: toastr["success"] ("Record Successfully Saved.");
//             window.location = app_url+"/clients";
//         }*/
//     });

// }