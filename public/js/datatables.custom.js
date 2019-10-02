$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function () {
    //вывод операций установленный за период
    $('.index-button-group button').on('click', function () {
        var period = $(this).attr('period');
        $.ajax({
            url: "/operation/period",
            data: {
                period: period
            },
            success: function( result ) {
                var obj = jQuery.parseJSON(result);
                console.log(obj);

                $('#count p').html('Доход: <span class="income">'+ obj.incomeCount +'</span> Расход: <span class="consumption">'+ obj.consumptionCount +'</span>');

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
            }
        });
    })
});