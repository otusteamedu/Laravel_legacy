<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - News Portal</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body>
    <header>
        <div class="bg-light pt-1 pb-1 text-center">
            <h1>@yield('h1')</h1>
        </div>
    </header>
    <main>
        <div class="d-flex justify-content-center pt-3 pb-3 auth_forms">
            @yield('content')
        </div>
    </main>
    <footer class="bg-dark">
        <div class="float-right">
            <div class="nav-item nav-link text-white-50">
                &copy News Portal - {{date('Y')}}
            </div>
        </div>
        <div class="clearfix"></div>
    </footer>
    <script src="{{ mix('/js/app.js') }}"></script>
    @stack('scripts')
</body>