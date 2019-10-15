<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- dashboard -->
    <link href="{{ asset('css/admin/dashboard.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    @include('admin.layouts.navigation')
    <main class="py-4">
        <div class="container-fluid">
            <div class="row">
                @include('admin.layouts.left_menu')
                @yield('content')
            </div>
        </div>
    </main>
</div>
</body>
</html>
