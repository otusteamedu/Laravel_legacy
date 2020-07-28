@extends('layouts.app')

@section('content')
    <div class="content">
        <div>
            <h3>Результат</h3>
        </div>
        @if ($result)
            Данные записаны
            @else
            Транспорт занят
            @endif
    </div>
@endsection
