@extends('layouts.app')

@section('content')
    <div class="content">
        <div>
            <h3>Расписание</h3>
        </div>

        <div>
            <table class="table">
                <tr>
                    <th>id</th>
                    <th>Дата</th>
                    <th>Транспорт</th>
                    <th>Направление</th>
                    <th>В пути(ч)</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>
                            {{ $item->id }}
                        </td>
                        <td>
                            {{ $item->date }}
                        </td>
                        <td>
                            {{ $item->transport->model }} {{ $item->transport->register }}
                        </td>
                        <td>
                            {{ $item->region->name }}
                        </td>
                        <td>
                            {{ $item->interval }}
                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $items->links() }}
        </div>
    </div>
@endsection
