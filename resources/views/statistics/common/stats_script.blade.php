<script type="text/javascript">
    $(document).ready(function () {
        $(".btn-load-data-customer").click(function () {
            var url = $(this).attr('data');
            var elb = $(this).attr('id');
            $("#running_in_background").prop('checked', true);
            $('#isDownlloadCustomfields').prop('checked', false);
            //$("#div_running_in_background").hide();
            if (elb == 'dbopened' || elb == 'dbclicked' || elb == 'dbexportall') {
                $('#bot_inluded').prop('checked', false);

                $("#botsSection").show();
                var bot_lable = "";
                if (elb == 'dbopened') {
                    bot_lable = "{{ trans('statistics.modal.download_customer_field.bots_open') }}";
                } else if (elb == 'dbclicked') {
                    bot_lable = "{{ trans('statistics.modal.download_customer_field.bots_click') }}";
                } else {
                   /// $("#div_running_in_background").show();
                    bot_lable = "{{ trans('statistics.modal.download_customer_field.bots_open_click_all') }}";
                }
                $("#bot_message").html(bot_lable);
                $("#openclickFlag").val(1);
            } else {
                $("#botsSection").hide();
                $("#openclickFlag").val(0);
            }
            $("#load-data-customer-field").modal({
                show: true,
                backdrop: 'static',
                keyboard: false
            });
            $("#GoUrl").val(url);
            $("#elb").val(elb);
        });
        $("#downloadData").click(function () {
            var customeFieldCheck = 0;
            var running_in_background = 0;
            
            if ($("#isDownlloadCustomfields").is(':checked')) {
                customeFieldCheck = 1;
            }
            if ($("#running_in_background").is(':checked')) {
                running_in_background = 1;
            }

            var Url = $("#GoUrl").val() + "?customeFieldCheck=" + customeFieldCheck;
            var random = (Math.random() + 1).toString(36).substring(2);
            if ($("#openclickFlag").val() == 1) {
                var isBot = 0;
                if ($('#bot_inluded').is(":checked")) {
                    isBot = 1
                }
                Url = Url + '&is_bots=' + isBot;
            }
            Url+='&random='+random;
            $("#load-data-customer-field").modal("hide");

           /* if ($("#elb").val() == 'elb') {
                exportLogsCSV();
            } else {
                $("#elb").val("");
            }*/
            ///console.log(Url);
            if(running_in_background==0 || running_in_background=='0'){
                window.location.href = Url;
            }else{
                $.ajax({
                    type: 'GET',
                    url: Url,
                    data: {'running_in_background':1},
                    beforeSend: function() {
                        $('.blockUI').show();
                    },
                    success: function (data) {
                        if (data=='permission_error')
                            toastr.error("{{ trans('common.message.temp_permission') }}");
                        else
                            toastr.success(data);
                            //toastr.error("Error");
                    }, error: function (jqXHR, status, err) {
                        $('.blockUI').hide();
                    },
                    complete: function () {
                        $('.blockUI').hide();
                    }
                });
            }
            

        });
    });
</script>