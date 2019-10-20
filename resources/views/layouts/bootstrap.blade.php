<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <title>{{ config('app.name') }}</title>
</head>
<body>
<h1>Hello, world!</h1>

<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="{{ route('home') }}">СНТ &laquo;Заря&raquo;</a>

    {{--  кнопка открытия меню при малом экране  --}}
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-top"
            aria-controls="navbars-top" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbars-top">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('home') }}">Главная <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>

        @guest
            <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                <li class="nav-item dropdown">
                    <a class="btn btn-primary dropdown-toggle" href="#" id="loginBar"
                       data-toggle="dropdown">@lang('Login')</a>
                    <div class="dropdown-menu dropdown-menu-right mt-2">
                        <form class="px-4 py-3" action="{{ route('login') }}" method="post">
                            @csrf()
                            <div class="form-group">
                                <label for="exampleDropdownFormEmail1">@lang('Email address')</label>
                                <input type="email" class="form-control" id="exampleDropdownFormEmail1"
                                       placeholder="email@example.com">
                            </div>
                            <div class="form-group">
                                <label for="exampleDropdownFormPassword1">@lang('Password')</label>
                                <input type="password" class="form-control" id="exampleDropdownFormPassword1"
                                       placeholder="Password">
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="dropdownCheck">
                                    <label class="form-check-label" for="dropdownCheck">
                                        @lang('Remember me')
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </form>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('register') }}">@lang('New around here? Sign up')</a>
                        <a class="dropdown-item" href="{{ route('password.update') }}">@lang('Forgot password?')</a>
                    </div>
                </li>

                <li class="nav-item pl-2">
                    <a class="btn btn-light" href="{{ route('register') }}">@lang('Register')</a>
                </li>
            </ul>
        @else
            <ul class="nav navbar-nav flex-row justify-content-between ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile')  }}">Profile</a>
                </li>
            </ul>
        @endguest
    </div>
</nav>

@hasSection('sidebar')
    <main class="py-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    @yield('sidebar')
                </div>
                <div class="col-10">
                    @yield('content')
                </div>
            </div>
        </div>
    </main>
@else
    <main class="py-4">
        @yield('content')
    </main>
@endif

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
