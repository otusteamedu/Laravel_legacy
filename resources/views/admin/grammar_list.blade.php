@extends('admin.layouts.admin')
@section('content')
    <h1>
        Страницы
    </h1>

    <hr>
    <ul class="nav flex-column">
        @foreach($list as $item)
            <li class="nav-item"><a href="/admin/grammar/{{$item->id}}" class="nav-link active">{{$item->name}}</a></li>
        @endforeach
    </ul>
    <hr>
    <a href="{{route('admin.grammar.create')}}">Создать страницу</a>
@endsection
