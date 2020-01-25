<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="{{ mix('/vendor/materialize/css/materialize.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @stack('styles')
</head>
<body>
    @yield('body')

    <script src="{{ mix('/vendor/materialize/js/materialize.js') }}"></script>
    @stack('scripts')
</body>
</html>
