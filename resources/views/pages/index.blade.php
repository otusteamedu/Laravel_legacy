{{-- Имя данного файла --}}
@section('pageName', 'index')

{{-- Унаследуй layout файл --}}
@extends('layouts.default')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Интернет-магазин фруктов')

@section('pageContent')
    <main>
        <p>views/pages/index.blade.php</p>
        <div><img src="img/girl.jpg"></div>
        <h4>Фруктовая Лавка</h4>
        <p>интернет-магазин<br/>спелых фруктов</p>
    </main>

@endsection
