<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@php isset($name) ? $name : 'Test' @endphp</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
@yield('top_nav')
@yield('slider')
@yield('main')
@yield('footer')
<script src="{{ asset('js/app.js') }}"></script>
@yield('script')
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/owl.autoplay.js') }}"></script>
</body>
</html>