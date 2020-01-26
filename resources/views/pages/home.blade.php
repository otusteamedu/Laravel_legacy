{{-- Имя данного файла --}}
@section('pageName', 'home')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Интернет-магазин фруктов')

@section('pageContent')
    <main>
        <p>views/pages/home.blade.php</p>
        <h4>Кабинет пользователя</h4>
        <br/>
        <p><a href="/profile">Указать свои контакты</a></p>
    </main>

@endsection
