<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/app.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
          integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/custom.css">

    <title>@yield('title')</title>
</head>
<body>
@section('navigation')
    <ul class="nav nav justify-content-end">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('index')}}">Главная</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('about')}}">Возможности</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('home')}}">Вход</a>
        </li>
    </ul>
@show

<div class="container-fluid">
    @yield('content')
</div>

<script src="/js/app.js"></script>
</body>
</html>