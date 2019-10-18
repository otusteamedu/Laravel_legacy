require('./bootstrap');
require('./datapicker.min');


$(document).ready(function(){
    $('#datepicker').datepicker({
        dateFormat: 'yy-mm-dd'
    });

    //отправка формы из модального окна
    $('.send_modal_form').on('click',function () {
        let modal = $(this).parents('.modal');
        let spiner = $('#spiner');

        modal.modal('hide');
        spiner.modal('show');
        modal.find('form').submit();
    });

    $('a.unactive').on('click', function () {
        let id = $(this).data('id');
        $('#modalUserActivate').modal('show');
        $('#modalUserActivate input[name=id]').val(id);
    });

    $('a.active').on('click', function () {
        let id = $(this).data('id');
        $('#modalUserUnactivate').modal('show');
        $('#modalUserUnactivate input[name=id]').val(id);
    });


});
