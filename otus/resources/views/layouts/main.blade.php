<!DOCTYPE html>
<html lang="ru">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no"/>
    <meta charset="utf-8"/>
    <title> @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}"/>
</head>
<body>
<header class="header">
    @include('layouts.blocks.logo')
    @include('layouts.blocks.nav-menu')
</header>

<main class="main" role="main">
    <div class="panel">
        @include('layouts.blocks.burger-menu-button')
        @include('layouts.blocks.search')
        @include('layouts.blocks.user-option')
    </div>
    @yield('content')
</main>
<script src="{{'js/app.js'}}"></script>
</body>
</html>
