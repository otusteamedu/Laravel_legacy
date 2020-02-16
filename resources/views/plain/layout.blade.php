<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Badum</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    @yield('header-styles')
    @yield('header-scripts')
</head>
<body>

    <div class="app-container">
        @yield('content')
    </div>

@yield('end-body-scripts')
</body>
</html>
