@extends('layouts.user')

@section('title', 'Home')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="count">
                        <h4 class="card-title">Итого за период</h4>
                        <p>Доход: <span class="income">{{$incomeCount}}</span> Расход: <span class="consumption">{{$consumptionCount}}</span></p>
                    </div>
                    <h4 class="card-title">Список операций</h4>
                    <div class="index-button-group">
                        <button type="button" class="btn waves-effect waves-light btn-success" period="today">Сегодня</button>
                        <button type="button" class="btn waves-effect waves-light btn-success" period="yesterday">Вчера</button>
                        <button type="button" class="btn waves-effect waves-light btn-success" period="week">Неделя</button>
                        <button type="button" class="btn waves-effect waves-light btn-success" period="month">Месяц</button>
                        <button type="button" class="btn waves-effect waves-light btn-success" period="quarter">Квартал</button>
                        <button type="button" class="btn waves-effect waves-light btn-success" period="year">Год</button>
                    </div>
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Сумма</th>
                                <th>Категория</th>
                                <th>Описание</th>
                                <th>Дата</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($operations as $operation)
                                <tr>
                                    <td><span class="@if($operation->category->type){{'income'}}@else{{'consumption'}}@endif">{{$operation->sum}}</span></td>
                                    <td>{{$operation->category->name}}</td>
                                    <td>{{$operation->description}}</td>
                                    <td>{{$operation->created_at}}</td>
                                    <td>
                                        <a href="{{route('operation.edit', ['operation' => $operation->id])}}">
                                            <i class="fas fa-edit" title="Редактировать"></i>
                                        </a>
                                        <a href="operation/{{$operation->id}}/destroy">
                                            <i class="fas fa-trash" title="Удалить"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <!-- This is data table -->
    <script src="/assets/plugins/datatables/datatables.min.js"></script>
    <!-- start - This is for export functionality only -->
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <!-- end - This is for export functionality only -->
    <script>
        $(function () {
            $('#myTable').DataTable();
            // $(function () {
            //     var table = $('#example').DataTable({
            //         "columnDefs": [{
            //             "visible": false,
            //             "targets": 2
            //         }],
            //         "order": [
            //             [2, 'asc']
            //         ],
            //         "displayLength": 25,
            //         "drawCallback": function (settings) {
            //             var api = this.api();
            //             var rows = api.rows({
            //                 page: 'current'
            //             }).nodes();
            //             var last = null;
            //             api.column(2, {
            //                 page: 'current'
            //             }).data().each(function (group, i) {
            //                 if (last !== group) {
            //                     $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
            //                     last = group;
            //                 }
            //             });
            //         }
            //     });
            //     // Order by the grouping
            //     $('#example tbody').on('click', 'tr.group', function () {
            //         var currentOrder = table.order()[0];
            //         if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
            //             table.order([2, 'desc']).draw();
            //         } else {
            //             table.order([2, 'asc']).draw();
            //         }
            //     });
            // });
        });
    </script>

    @endsection