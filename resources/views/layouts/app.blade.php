<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
{{App::setLocale('ru') /*@ToDo: fix it*/}}
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
@include('layouts.header')
@yield('breadcrumbs')
@yield('content')
@include('layouts.footer')
@include('layouts.scripts')
@include('layouts.modals')
</body>
</html>
