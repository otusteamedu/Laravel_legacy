<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Панель администратора </title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body>
<div class="wrapper">

    <div class="container">

        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <a class="navbar-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
            </ul>


        </nav>


        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        <div class="row">
            <div class="col col-3">
                @php
                    $menu = [
                    [
                    'id' => 1,
                    'url' =>'/users',
                    'title' => 'Пользователи',
                    ],
                    [
                    'id' => 2,
                    'url' =>'/registration',
                    'title' => 'Регистрация',
                    ],
                    [
                    'id' => 3,
                    'url' =>'/help',
                    'title' => 'Помощь',
                   ],
                    [
                    'id' => 4,
                    'url' =>'/login',
                    'title' => 'Вход',
                    ],
                    [
                    'id' => 5,
                    'url' =>'/tasks',
                    'title' => 'Задачи пользователя',
                    ],
                    ];
                @endphp
                @include('admin.dashboard.sidebar.index', ['menu' => $menu])
            </div>
            <div class="col col-9">
                @yield('content')
            </div>
        </div>
    </div>


</div>

@include('blocks.footer.index')


<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>