$( document ).ready(function() {

    $('#account_select').change(function(){
        $('#account_select_form').submit();
    });

    $('.from_radio').click(function(){
        if( $(this).prop("checked") ){
            var id_from = $(this).attr('data-id');
            $('#from_bill_field').val(id_from);
        }
    });

    $('#make_payment_button').click(function () {

        if( $('#from_bill_field').val() == '' ){
                alert('Выбирите счет с которого нужно сделать перевод');
            return ;
        }

        if( $('#to_bill_field').val() == '' ){
                alert('Выбирите счет на который нужно сделать перевод');
            return ;
        }

        if($('#from_bill_field').val() == $('#to_bill_field').val()){
            alert('Выбирите разные счета');
            return ;
        }

        $("#go_btn").trigger('click');;
        //$('#between_form').submit();

    });

    $('.to_radio').click(function(){
        if( $(this).prop("checked") ){
            let id_to = $(this).attr('data-id');
            $('#to_bill_field').val(id_to);
        }
    });


    $('.account_details_class').click(function(){

        $('#acc_data_field').val( $(this).attr('account_data') );
        $('#account_form_go').submit();
    });



    $('.clicker').click(function () {
        $('.clicker').prop("checked", false);
        $(this).prop("checked", true);
        $('#num_id').val( $(this).attr('data-val') );
    });
    
    $('#op_go').click(function (e) {
        e.preventDefault();
        if( $('#num_id').val() != '' ){
            location.href="/transactions/info/" + $('#num_id').val();
        }
    });






});