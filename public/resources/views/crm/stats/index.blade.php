@extends('crm.layouts.nav_admin')

@section('content')
    <div>
        <div class="mt-3 mb-3">
            <h3>Статистика по регионам</h3>
        </div>
        <div>
            <table class="table" style="max-width: 990px;">
                <tr>
                    <th>id</th>
                    <th>Регион</th>
                    <th>Количество автосалонов</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->region_id }}</td>
                        <td>{{ $item->amount }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
