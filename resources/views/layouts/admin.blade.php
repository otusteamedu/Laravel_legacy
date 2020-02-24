<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="codeblog.pro"/>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @include('layouts.admin.styles')
</head>
<body>

@include('layouts.admin.header')
@yield('breadcrumbs')
@yield('content')
@include('layouts.admin.footer')
@include('layouts.admin.scripts')
@include('layouts.admin.modals')
</body>
</html>
