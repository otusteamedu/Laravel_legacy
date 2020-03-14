<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">
    {{-- todo вынести получение из шаблона, пока здесь, так как не требуется внедрение --}}
    @php
    $navbar = [
        'id' => 'main-nav',
        'brand' => ['url' => route('main'), 'name' => 'Главная'],
        'list' => [
            ['url' => route('news'), 'name' => 'Новости', 'current' => true, 'disabled' => false],
            ['url' => route('personal'), 'name' => 'Личный кабинет', 'current' => false, 'disabled' => false],
            ['url' => route('register'), 'name' => 'Зарегистрироваться', 'current' => false, 'disabled' => false],
        ],
    ];
    @endphp

    @component('blocks.navbar.default', ['navbar' => $navbar])
    @endcomponent
    @yield('content')
</div>
</body>
</html>
