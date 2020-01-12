$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    //datatables
    var lang = $('meta[name="lang"]').attr('content');
    switch(lang){
        case 'en':
            var url = '/assets/plugins/datatables/media/lang/en.json';
            break;
        default:
            var url = '/assets/plugins/datatables/media/lang/ru.json';
    }
    $(function () {
        $('#myTable').DataTable({
            "language": {
                "url": url
            }
        });
    });

    //вывод операций установленный за период
    $('.index-button-group button').on('click', function () {
        var period = $(this).attr('period');
        $.ajax({
            url: "/operation/period",
            data: {
                period: period
            },
            success: function( result ) {
                console.log('Успех');
                console.log(result);
                var obj = jQuery.parseJSON(result);

                $('#count .income').html(obj.incomeCount);
                $('#count .consumption').html(obj.consumptionCount);

                var table = $('#myTable').DataTable();
                table.clear();

                if(obj.operations.length == 0){
                    table.draw();
                } else {
                    var color;
                    var X_CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                    for(var i =0; i<obj.operations.length; i++){

                        if(obj.operations[i].category.type == 1){
                            color = 'income'
                        } else {
                            color = 'consumption';
                        }

                        table.rows.add([
                            ['<span class="'+ color +'">'+ obj.operations[i].sum +'</span>', obj.operations[i].category.name, obj.operations[i].description, obj.operations[i].updated_at, '<a href="operation/'+ obj.operations[i].id +'/edit"><i class="fas fa-edit" title="Редактировать"></i></a><form action="/operation/'+ obj.operations[i].id +'" method="post"><input type="hidden" name="_token" value="'+ X_CSRF_TOKEN +'"><input type="hidden" name="_method" value="delete"><a href="javascript:void(0);" onclick="parentNode.submit();"><i class="fas fa-trash" title="Удалить"></i></a></form>']
                        ]).draw();
                    }
                }
            },
            error: function (q,w,e) {
                console.log('Ошибка');
                console.log(q);
                console.log(w);
                console.log(e);
            }
        });
    })
});