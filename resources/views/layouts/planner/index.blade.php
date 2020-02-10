<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Instagraphia</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="/css/app.css">
        @yield('css')

        <script src="/js/app.js"></script>
        @yield('js')

    </head>
    <body>
    <div class="container-fluid main__wrap">
        <div class="row main">
            <div class="col-3 sidebar__wrap">
                @include('layouts.planner.sidebar.index')
            </div>
            <div class="col-9">
                @yield('content')
            </div>
        </div>
    </div>

    </body>
</html>
