<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Instagraphia</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700&display=swap&subset=cyrillic" rel="stylesheet">

    <link rel="stylesheet" href="{{ mix('/css/main/style.css') }}">
    @yield('css')

    <script src="{{ mix('/js/main/script.js') }}"></script>
    @yield('js')

</head>
<body>

<div class="container-fluid main__wrap">
    <div class="row main">
        <div class="col-12 header__wrap">
            @include('layouts.planner.header.index')
        </div>
        <div class="col-12 content__wrap @yield('class', 'text-page')">
            @yield('content')
        </div>
        <div class="col-12">
            @include('layouts.planner.footer.index')
        </div>
    </div>
</div>

</body>
</html>
