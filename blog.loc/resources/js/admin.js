require('./bootstrap');
$(document).ready(function(){
    //отправка формы из модального окна
    $('.send_modal_form').on('click',function () {
        let modal = $(this).parents('.modal');
        let spiner = $('#spiner');

        modal.modal('hide');
        spiner.modal('show');
        modal.find('form').submit();
    })
});
