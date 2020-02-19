{{-- Имя данного файла --}}
@section('pageName', 'blank')

{{-- Унаследуй layout файл --}}
@extends('layouts.blank')

{{-- Передай значение в тэг <title></title> внутри layout'a --}}
@section('pageTitle', 'Пустая страница')

@section('pageContent')
    <main>
        <div>
            <p>¯\_(ツ)_/¯<br/>Сайт недоступен.</p>
        </div>
    </main>

@endsection
