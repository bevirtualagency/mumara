@php($canSeeContacts = routeAccess('contact.index'))
<script type="text/javascript">
var KTFormControls = function() {
    var add_list = function() {
            var e = $("#list-frm"),
                r = $(".alert-danger", e),
                i = $(".alert-success", e);
            $("#list-frm").validate({
                rules: {
                    name: {
                        required: !0
                    },
                    owner_name: {
                        required: !0
                    },
                    owner_email_part1: {
                        required: !0
                    },
                    owner_email_part2: {
                        required: !0
                    },
                    reply_email: {
                        required: !0,
                        email: !0
                    },
                    bounce_email: {
                        required: !0
                    },
                    bounce_email_id: {
                        required: !0
                    }
                },
                invalidHandler: function(event, validator) {
                    //i.hide(), r.show(), App.scrollTo(r, -200)
                    Command: toastr["error"] ("You have some form errors. Please check below."); 
                    //$('#msg').css("display", "flex");
                    //$('#msg-text').html(form_error);
                    //$('#msg').removeClass('display-hide').addClass('alert alert-danger ');
                    $("#modal-loading").modal('hide');
                },
                submitHandler: function(e) {
                    //i.show(), r.hide(), e[0].submit()
                    //r.hide(), e[0].submit()
                    if($("#action").val() == 'add') {
                        var method = 'POST';
                        var url = "{{route('list.store')}}";
                    } else {
                        var id = $('#list-id').val();
                        var method = 'POST';
                        var url = "{{route('list.update',"")}}/"+id;
                    }
                    getCustomFieldOrder();
                        var form_data =  $("#list-frm").serialize();
                        // e.preventDefault();
                        // console.log('url', url);
                        // return;
                        $.ajax({
                            url: url,
                            type: method,
                            data: form_data,
                            success: function(result) {
                                $("#modal-loading").modal('hide');
                                if (result.response == 'save_add') {
                                    Command: toastr["success"] (result.message);
                                    window.location = "{{route('list.create')}}";
                                }
                                else if (result.response == 'edit') {
                                    Command: toastr["success"] (result.message);
                                    window.location = "{{route('list.index')}}";
                                }
                                else if (result.response == 'error'){
                                    //$('#msg').css("display", "flex");
                                    Command: toastr["error"] (result.message);
                                    //$('#msg-text').html('' + result.list + ' already Exists in '+ result.group +' ');
                                    //$('#msg').removeClass('display-hide alert-danger').addClass('alert alert-danger');
                                    $('#msg').delay(3000).hide('slow');
                                }
                                else if (result.response == 'exit') {
                                 //   alert(result.result_id);
                                    Command: toastr["success"] (result.message);
                                  //  window.location = "/list-management/list"
                                @if($canSeeContacts)
                                    //result.list_id
                                    route = "{{route('list.contacts',"id")}}";
                                    window.location = route.replace('/id/', "/"+result.list_id+"/")
                                    @endif
                                    
                                }
                            }
                        });
                        return false;
                    /*} else {
                        r.hide(), e[0].submit();
                    }*/
                }
            })
        };
    return {
        init: function() {
            add_list();
        }
    }
}();
jQuery(document).ready(function() {
    KTFormControls.init();

    $("#frm-group").submit(function(){
        var form_data =  $("#frm-group").serialize();
        // console.log('form_data', form_data);
        // return;
        $.ajax({
            url: app_url+'/group',
            type: "POST",
            data: form_data,
            success: function(result) {
                if (result == 'success') {
                    Command: toastr["success"] ("Group(s) successfully added!");
                    groups_msg = 'Group(s) successfully added!';
                    msg = 'alert alert-success';
                }else{
                    Command: toastr["error"] ('' + result + ' already Exist'); 
                    groups_msg = '' + result + ' already Exist';
                    msg = 'alert alert-danger ';
                }
                $('#msg-group').css("display", "flex");
                $('#msg-text-group').html(groups_msg);
                $('#msg-group').removeClass('display-hide alert-danger').addClass(msg);
                $('#msg-group').hide();

                $.getJSON( app_url+"/group?section_id=1", function( data ) {
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

    $("#frm-bounce-email").submit(function(){
        var form_data =  $("#frm-bounce-email").serialize();
        $.ajax({
            url: app_url+'/bounce',
            type: "POST",
            data: form_data,
            success: function(result) {

                if (result == 'success') {
                    Command: toastr["success"] ("Bounce Email Successfully Configured");
                    groups_msg = 'Bounce Email Successfully Configured';
                    msg = 'alert alert-success';
                }
                $('#msg-bounce').css("display", "flex");
                $('#msg-text-bounce').html(groups_msg);
                $('#msg-bounce').removeClass('display-hide alert-danger').addClass(msg);
                $('#msg-bounce').delay(1500).hide('slow');
                setTimeout(function(){
                    $("#modal-bounce-configuration").modal('hide');
                    $('.modal-body').find('input').val('');
                }, 1500);

                $.getJSON( app_url+"/add-list/bounce", function( data ) {
                    var $el = $("#bounce-id");
                    $el.empty(); // remove old options
                    $.each(data, function(key,value) {
                      $el.append($("<option></option>")
                         .attr("value", value).text(key));
                    });
                });
            }
        });
        return false;
    });

});
</script>