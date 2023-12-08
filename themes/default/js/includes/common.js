$(document).ready(function() {
    $('.checkbox-all-index').click(function () {
        if($(this).is(':checked')) {
            $('.checkbox-index').not(':disabled').prop('checked', true);
        } else {
            $('.checkbox-index').prop('checked', false);
        }
    });
    /*$('.checkbox-index').click(function () {
        if($(this).is(':checked')) {
            $('.checkbox-all-index').prop('checked', true);
        } else {
            $('.checkbox-all-index').prop('checked', false);
        }
    });*/
    $('body').on("click" , ".group-selector-subscriber2", function () {
        var group = this.id;
        //alert(group);
        if($(this).is(':checked')) {
            $('.group-subscriber-p-'+group).not(':disabled').prop('checked', true);
        } else {
            $('.group-subscriber-p-'+group).prop('checked', false);
        }
    });
    
    $('body').on("click" , ".group-selector-subscriber", function () {
        var group = this.id;
        //alert(group);
        if($(this).is(':checked')) {
            $('.group-subscriber-'+group).not(':disabled').prop('checked', true);
        } else {
            $('.group-subscriber-'+group).prop('checked', false);
        }
    });

    $('.campaign_lists').click(function(){
        var val = $("input[name='type']:checked").val();
        if(val == 'split_test'){
            $('.campaign_lists').each(function(){
            $(this).prop('checked', false);
        });
            $(this).prop('checked', true);
        }
    });
});