<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Онлайн-консультант') }} | @yield('title')</title>

        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        @yield('styles')
        <link rel="stylesheet" href="{{ mix('/css/web/web.css') }}">

        @yield('javascript-head')
    </head>
    <body>
        @include('web.layouts.header')

        @yield('content')

        @include('web.layouts.footer')

        @yield('javascript-body')
        <script src="{{ mix('/js/web/web.js') }}"></script>
    </body>
</html>
