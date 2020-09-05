$(document).ready(function () {

    // Заполнение формы модального окна значениями
    let dataTable = $('#data-list');
    $('button[class$="edit"]', dataTable).on('click', function (e) {
        let id = $(this).data('id');
        let href = location.origin+location.pathname;
        let data_target = $(this).data('target');
        let modalWindow = $('#modal-edit');
        let url = `${href}/${id}/edit`;
        $.ajax({
            dataType: "json",
            type: 'GET',
            url: url,
            async: true,
            success: function (data, textStatus, jqXHR) {
                $.each(data, function (i, v) {
                    let field = $(`#modalField-${i}`);
                    if (field.length) {
                        field.val(v);
                    }
                });
                modalWindow.modal('show');
                $("#modal-edit-form", modalWindow).data('id', id);
            },
            error: function (jqXHR, textStatus, errorThrown) {
                modalWindow.modal('show');
                $('.modal-body', modalWindow).html('Ошибка: ' + errorThrown);
            }
        });
    });
    // Отправка данных формы
    $("#modal-add-form").add("#modal-edit-form").submit(function (e) {
        e.preventDefault();
        let id = $(this).data('id') ? $(this).data('id') : null;
        let flashMessageElement = $('#flash-message', this);
        let formURL = $(this).attr("action");
        let formMethod = $(this).attr("method");
        let postData = $(this).serialize();
        formURL = id ? formURL.replace(/#id/gi, id) : formURL;
        $.ajax({
            type: formMethod,
            url: formURL,
            data: postData,
            cache: false,
            success: function (jqXHR, textStatus, errorThrown) {
                $(flashMessageElement).fadeOut();
                if (jqXHR.status === 'ok') {
                    window.location.href = jqXHR.redirect;
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 422) { // when status code is 422, it's a validation issue
                    $(flashMessageElement).fadeIn().html(jqXHR.responseJSON.message);
                    $.each(jqXHR.responseJSON.errors, function (i, error) {
                        flashMessageElement.append('<li style="color: red;">' + error[0] + '</li>');
                    });
                }
            }
        });

        return false;
    });

    $('#modal-add').add('#modal-edit').on('hidden.bs.modal', function () {
        $('#flash-message', this).hide();
    });
});
