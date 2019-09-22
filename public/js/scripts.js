$(document).ready(function () {
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
                    for(var i =0; i<obj.operations.length; i++){

                        if(obj.operations[i].category.type == 1){
                            color = 'income';
                        } else {
                            color = 'consumption';
                        }

                        table.rows.add([
                            ['<span class="'+ color +'">'+ obj.operations[i].sum +'</span>', obj.operations[i].category.name, obj.operations[i].description, obj.operations[i].updated_at, '<a href="operation/'+ obj.operations[i].id +'/edit"><i class="fas fa-edit" title="Редактировать"></i></a><a href="operation/'+ obj.operations[i].id +'/destroy"><i class="fas fa-trash" title="Удалить"></i></a>']
                        ]).draw();
                    }
                }
            },
            error: function (q, w, e) {
                console.log(q);
                console.log(w);
                console.log(e);
            }
        });
    })
});