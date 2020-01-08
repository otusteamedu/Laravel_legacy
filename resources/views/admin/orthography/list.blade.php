@extends('admin.layouts.admin')
@section('content')
    <h1>
        Страницы Орфография
    </h1>

    <hr>
    <ul class="nav flex-column">
        @foreach($list as $item)
            <li class="nav-item"><a href="/admin/orthography/{{$item->id}}" class="nav-link active">{{$item->name}}</a></li>
        @endforeach
    </ul>
    <hr>
    <a href="{{route('admin.orthography.create')}}">Создать страницу Орфография</a>
@endsection

