<script type="text/javascript">
    function fillThirdField(value,name,id)
    {
        var selectedListsIDs = "";

        if(id=='selectListdb1'){
            selectedListsIDs = $("#selectedAdvnceList0").val();
        }else{
            selectedListsIDs = $("#selectedAdvnceList1").val();
        }
        if(value!=-1) {
            for_users = 0;
            for_users = $('#users').is(':checked');
            if(for_users)
                for_users = 1;
            field_value = value;
            field_index = (name.split("[")[1].slice(0, -1));
            custom_field_col = 'adv_list';
            if (field_value == 2)
                custom_field_col = 'adv_group';
            col = 'advance_filter[' + field_index + '][adv_filter_val][]';
            //select_class = 'class="mt-multiselect btn btn-default form-control MultiSelectBox"';
            select_class = 'class="class="mt-multiselect btn btn-default form-control MultiSelectBox" multiple="multiple" data-width="100%" data-label="left" data-select-all="true"';
            var checkbox_html = '<select ' + select_class + ' id="' + custom_field_col + '_' + field_index + '"  name="' + col + '" >';


            $.ajax({
                url: '{{route('segment.getList')}}',
                type: 'post',
                data: {'field_value':field_value,'type':custom_field_col,'for_users':for_users,'user_id':$('#where_user').val(),'selectedListsIDs':selectedListsIDs},
                beforeSend: function () {
                    $(".blockUI").show();
                },
                complete: function () {
                    $(".blockUI").hide();
                },
                success: function (data) {

                    checkbox_html += data.html;
                    checkbox_html += '</select>';
                    checkbox_html += '<small id="advance_option3-error" class="error invalid-feedback p-right"></small>';
                    $("#div_adv_3_" + field_index).html(checkbox_html);
                    $("#" + custom_field_col + '_' + field_index).multiselect('rebuild');

                }
            });
        }
        else {
            $("#div_adv_3_" + value).html('<input type="text" class="form-control textsystem" ><small id="advance_option3-error" class="error invalid-feedback p-right"></small>');
        }
    } 
</script>
