<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="codeblog.pro"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.styles')
</head>
<body>
@include('layouts.blocks.yandexmap.scripts') <!-- @ToDo:Перенести ниже -->
@include('layouts.header')
@yield('breadcrumbs')
@yield('content')
@include('layouts.footer')
@include('layouts.modals')
@include('layouts.scripts') <!-- @ToDo: вынести js код Yandex map в отдельные модули webpack, правильно подключить и перенести подключение скриптов ниже -->

</body>
</html>
