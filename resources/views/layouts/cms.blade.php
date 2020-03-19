<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Watchlist</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body>

@include('blocks.navbar.cms')

<div class="container" id="app">
    @yield('content')
</div>


<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
