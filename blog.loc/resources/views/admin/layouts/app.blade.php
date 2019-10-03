<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@php isset($name) ? $name : 'Test' @endphp</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body>
<div class="container">
@yield('top_nav')
@yield('slider')
@yield('main')
@yield('footer')

<div class="modal fade" id="spiner" tabindex="-1">
    <div class="spinner-border text-success" style="position: absolute; top: 50%; left: 50%; margin-top: -1.5rem; margin-left: -1.5rem; width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>
</div>
<script src="{{ asset('js/admin.js') }}"></script>
@yield('script')
</body>
</html>