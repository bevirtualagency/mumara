<script>
    idsStr = $("#typeFilter").val();
    // $(".m-select2").select2({
    //      templateResult: function (data, container) {
    //                 if (data.element) {
    //                   $(container).addClass($(data.element).attr("class"));
    //                 }
    //                 return data.text;
    //               }
    // });
    $("#user_records").click(function() {
        //$(".blockUI").show();
        $('#admins').val('');
        setTimeout(function(){
            $(".bullData").show();
            $(".treeView").hide();
            $('#admin-filter').hide();
        }, 250);
        record_type = 'user_records';
        try {
            objTable.fnReloadAjax();
        }
        catch (e) {
            try {
                objTable.draw();
            }
            catch (e) {
                getDrips();
            }
        }
    });
    $("#our_records").click(function() {
        //$(".blockUI").show();
        $('#clients').val('');
        setTimeout(function(){
            $(".bullData").hide();
            $(".treeView").show();
            $('#admin-filter').show();
        }, 250);
        record_type = 'our_records';
        try {
            objTable.fnReloadAjax();
        }
        catch (e) {
            try {
                objTable.draw();
            }
            catch (e) {
                getDrips();
            }
        }
    });


    $("#clients").change(function(){
        try {
            objTable.fnReloadAjax();
        }
        catch (e) {
            try {
                objTable.draw()
            }
            catch (e) {
                getDrips();
            }
        }
    });
    $("#admins").change(function(){
        try {
            objTable.fnReloadAjax();
        }
        catch (e) {
            try {
                objTable.draw()
            }
            catch (e) {
                getDrips();
            }
        }
    });
    function getDrips() {
        if($("#" + 'autoresponders').length>0)
            $('#autoresponders').DataTable().ajax.reload();
    }
</script>