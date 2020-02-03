$( document ).ready(function() {

    $('#account_select').change(function(){
        $('#account_select_form').submit();
    });

    $('#from-form-go').change(function(){
        alert('ok');
        //$('#from-form').submit();
    });


    $('.account_details_class').click(function(){

        $('#acc_data_field').val( $(this).attr('account_data') );
        $('#account_form_go').submit();
    });






});