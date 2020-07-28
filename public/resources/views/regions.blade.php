@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h3>Города</h3>
        </div>
        <div>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Расстояние(ч)</th>
                </tr>
                @foreach ($items as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>
                            {{ $item->name }}
                        </td>
                        <td>
                            {{ $item->distance }}
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection