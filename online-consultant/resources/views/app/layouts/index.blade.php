<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ __('common.app_name') }} | @yield('title')</title>

        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        @yield('styles')
        <link href="{{ mix('/css/app/app.css') }}" rel="stylesheet">

        @yield('javascript-head')
    </head>
    <body>
        @include('app.layouts.header')

        @yield('content')

        @include('app.layouts.footer')

        @yield('javascript-body')
        <script src="{{ mix('/js/app/app.js') }}"></script>
    </body>
</html>
