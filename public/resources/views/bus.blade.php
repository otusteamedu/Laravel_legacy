@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h3>Автобусы</h3>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th>id</th>
                    <th>Марка</th>
                    <th>Номер</th>
                    <th>Вместимость</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            {{ $item->model }}
                        </td>
                        <td>
                            {{ $item->register }}
                        </td>
                        <td>

                        </td>
                    </tr>
                @endforeach
            </table>
            {{ $items->links() }}
        </div>
    </div>
@endsection
