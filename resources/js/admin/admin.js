$(document).ready( function () {
    console.log('admin.js added');
    // Заполнение формы модального окна значениями
    let dataTable = $('#data-list');
    $('button[class$="edit"]', dataTable).on('click', function (e) {
        let id = $(this).data('id');
        let data_target = $(this).data('target');
        $.ajax({
            dataType: "json",
            type: 'GET',
            url: `/admin/${data_target}/${id}/edit`,
            async: true,
            success: function (data, textStatus, jqXHR) {
                $.each(data, function (i, v) {
                    let field = $(`#modalField-${i}`);
                    if (field.length) {
                        field.val(v);
                    }
                });
                $('#modal-edit').modal('show');
            },
            error: function (jqXHR, textStatus, errorThrown) {
                $('#modal-edit').modal('show');
                $('.modal-body').html('Ошибка: ' + errorThrown);
            }
        });
    });
});
