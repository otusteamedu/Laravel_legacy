<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Scheduler') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        @include('blocks.headers.index')
        <div class="container-fluid">
            <div class="row">
                @include('blocks.sidebar.index')
                <div class="col-md-8 col-lg-9 content-container">
                    @include('blocks.errors.validate')
                    @include('blocks.success.index')
                    @yield('app_content')
                </div>
            </div>
        </div>
        @include('blocks.footers.app')
    </div>
</body>
</html>
