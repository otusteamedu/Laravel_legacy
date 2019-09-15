@extends('layouts.app')

@section('content')
    <div class="content">
        <div>
            <h3>Личный кабинет</h3>
            <div>
                <a href="/add" class="btn btn-primary btn-lg btn-block">Новый маршрут</a>
                <a href="/formcheck" class="btn btn-warning btn-lg btn-block">Проверить автобус</a>
            </div>
        </div>
    </div>
@endsection
