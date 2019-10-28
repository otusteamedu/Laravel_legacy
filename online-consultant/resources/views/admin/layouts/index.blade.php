<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ __('common.app_name') }} | @yield('title')</title>

        <link rel="dns-prefetch" href="//fonts.gstatic.com">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,500" media="all">

        @stack('styles')
        <link href="{{ mix('/css/admin/admin.css') }}" rel="stylesheet">

        @stack('javascript-head')
    </head>
    <body>
        @include('admin.layouts.partials.header')

        <div class="page-content">
            @yield('content')
        </div>

        @include('admin.layouts.partials.footer')
    
        <script src="https://browser.sentry-cdn.com/5.6.3/bundle.min.js" integrity="sha384-/Cqa/8kaWn7emdqIBLk3AkFMAHBk0LObErtMhO+hr52CntkaurEnihPmqYj3uJho" crossorigin="anonymous">
        </script>
        <script src="{{ mix('/js/admin/bootstrap.js') }}"></script>
        @stack('javascript-body')
        <script src="{{ mix('/js/admin/admin.js') }}"></script>
    </body>
</html>
