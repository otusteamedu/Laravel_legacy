<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">--}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body>

{{--@include('products.blocks.navbar.index')--}}

<div class="container">
    @yield('content')
</div>

{{--@include('products.blocks.footer.index')--}}

<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
