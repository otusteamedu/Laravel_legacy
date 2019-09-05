<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="{{ asset('public/css/signin.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('public/css/cover.css') }}" rel="stylesheet" type="text/css" >
    <title>iLogistics</title>
</head>

<body class="text-center">
<div id="app" class="d-flex h-100 p-3 mx-auto flex-column">
    <header style="margin-bottom:50px;">
        <div class="inner">
            <h3 class="masthead-brand">
                <a href="/">
                    <img src="data:image/png;base64,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">
                    iLogistics</a>
            </h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <nav class="nav nav-masthead justify-content-center">
                <a class="nav-link" href="/">Главная</a>
                <a  class="nav-link"  href="/schedule">Расписание</a>
                <a  class="nav-link"  href="/buses">Автобусы</a>
                <a  class="nav-link"  href="/regions">Города</a>
                <!-- Authentication Links -->
                @if (Route::has('login'))
                    <div class="form-inline my-2 my-lg-0" style="margin-left: 20px;">
                        @auth
                            <a class="btn btn-dark btn-sm" href="/home" class="btn btn-secondary">Личный кабинет</a>
                            <a class="btn btn-dark btn-sm" href="/logout" class="btn btn-secondary">Выйти</a>
                        @else

                            <a class="btn btn-dark btn-sm" href="{{ route('login') }}">Вход</a>
                            <a class="btn btn-dark btn-sm"  href="{{ route('register') }}">Регистрация</a>
                        @endauth
                    </div>
                @endif
            </nav>
        </div>
    </header>

    @yield('content')
    <footer class="mastfoot mt-auto">
        <div class="inner">
            <p>iLogistics</p>
        </div>
    </footer>
</div>

<!-- Scripts -->
<script src="public/js/app.js"></script>
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
    feather.replace()
</script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>


