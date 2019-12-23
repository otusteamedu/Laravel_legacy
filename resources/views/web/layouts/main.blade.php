<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>

{{-- TODO Формировать body_class автоматически на основе текущего route --}}
<body class="@yield('body_class')">

<div id="app">
    <div class="flex-column">
        @include('web.partials.header')
        @yield('content')
        @include('web.partials.footer')
    </div>
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>
@yield('scripts')

</body>
</html>
