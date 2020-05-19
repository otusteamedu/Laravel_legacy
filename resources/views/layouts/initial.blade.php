<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <title>@yield('title', "CF")</title>

    </head>
    <body>
    @section('nav')

    @show
    @section('content')

    @show
    @section('footer')

    @show


    <script src="{{ mix('js/app.js') }}"></script>
    <script>
    M.AutoInit();
    @stack('scripts')
    </script>
    </body>
</html>
