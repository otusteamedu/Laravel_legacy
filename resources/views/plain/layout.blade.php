<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Badum</title>

    @yield('header-styles')
    @yield('header-scripts')
</head>
<body>
@yield('content')
@yield('hidden-content')
@yield('end-body-scripts')
</body>
</html>
