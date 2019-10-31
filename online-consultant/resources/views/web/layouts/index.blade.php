<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ __('common.app_name') }} | @yield('title')</title>

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,500" media="all">

        @stack('styles')
        <link rel="stylesheet" href="{{ mix('/css/web/web.css') }}">

        @stack('javascript-head')
    </head>
    <body>
        @include('web.layouts.partials.header')

        <div class="page-content">
            @yield('content')
        </div>

        @include('web.layouts.partials.footer')
    
        <script src="{{ mix('/js/web/bootstrap.js') }}"></script>
        @stack('javascript-body')
        <script src="{{ mix('/js/web/web.js') }}"></script>
    </body>
</html>