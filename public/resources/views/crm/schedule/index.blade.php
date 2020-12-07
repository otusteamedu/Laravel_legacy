@extends($layout)

@section('content')
    <div>
        <div class="mt-3 mb-3">
            <h3>Расписание</h3>
        </div>
        <div>
            <table class="table" style="max-width: 900px;">
                <tr>
                    <th>id</th>
                    <th>Дата</th>
                    <th>Транспорт</th>
                    <th>Регион</th>
                    <th>Время</th>
                    <th style="max-width: 150px;">&nbsp;</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->date }}</td>
                        <td>{{ $item['transport']['plate'] }}</td>
                        <td>{{ $item['region']['name'] }}</td>
                        <td>{{ $item->interval }}</td>
                        <td style="max-width: 150px;">

                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
