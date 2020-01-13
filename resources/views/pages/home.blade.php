{{-- Имя данного файла --}}
@section('pageName', 'home')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Интернет-магазин фруктов')

@section('pageContent')
    <main>
        <p>/home</p>
        <div><img src="img/minion.svg"></div>
        <h4>Личный кабинет</h4>
        <p>пользователя</p>
        <br/>
        <p><a href="/profile">Указать свои контакты</a></p>
        <p><a href="/katalog">Перейти к покупкам</a></p>
        @include('blocks.logout')
    </main>

@endsection
