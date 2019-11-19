@extends('admin.layouts.admin')
@section('content')
    <h1>
        Меню
    </h1>
    <hr>
    <ul class="nav flex-column">
        <li class="nav-item"><a href="/admin/grammar" class="nav-link ">Грамматика</a></li>
        <li class="nav-item"><a href="/admin/orthography" class="nav-link ">Орфография</a></li>
        <li class="nav-item">
            <hr>
            <a href="/admin/settings" class="nav-link ">Настройки</a></li>
    </ul>
@endsection
