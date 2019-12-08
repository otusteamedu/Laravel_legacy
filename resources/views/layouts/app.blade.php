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
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img
                    src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNTAiIGhlaWdodD0iNTIiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PHBhdGggZD0iTTQ5LjYyNiAxMS41NjRhLjgwOS44MDkgMCAwMS4wMjguMjA5djEwLjk3MmEuOC44IDAgMDEtLjQwMi42OTRsLTkuMjA5IDUuMzAyVjM5LjI1YzAgLjI4Ni0uMTUyLjU1LS40LjY5NEwyMC40MiA1MS4wMWMtLjA0NC4wMjUtLjA5Mi4wNDEtLjE0LjA1OC0uMDE4LjAwNi0uMDM1LjAxNy0uMDU0LjAyMmEuODA1LjgwNSAwIDAxLS40MSAwYy0uMDIyLS4wMDYtLjA0Mi0uMDE4LS4wNjMtLjAyNi0uMDQ0LS4wMTYtLjA5LS4wMy0uMTMyLS4wNTRMLjQwMiAzOS45NDRBLjgwMS44MDEgMCAwMTAgMzkuMjVWNi4zMzRjMC0uMDcyLjAxLS4xNDIuMDI4LS4yMS4wMDYtLjAyMy4wMi0uMDQ0LjAyOC0uMDY3LjAxNS0uMDQyLjAyOS0uMDg1LjA1MS0uMTI0LjAxNS0uMDI2LjAzNy0uMDQ3LjA1NS0uMDcxLjAyMy0uMDMyLjA0NC0uMDY1LjA3MS0uMDkzLjAyMy0uMDIzLjA1My0uMDQuMDc5LS4wNi4wMjktLjAyNC4wNTUtLjA1LjA4OC0uMDY5aC4wMDFsOS42MS01LjUzM2EuODAyLjgwMiAwIDAxLjggMGw5LjYxIDUuNTMzaC4wMDJjLjAzMi4wMi4wNTkuMDQ1LjA4OC4wNjguMDI2LjAyLjA1NS4wMzguMDc4LjA2LjAyOC4wMjkuMDQ4LjA2Mi4wNzIuMDk0LjAxNy4wMjQuMDQuMDQ1LjA1NC4wNzEuMDIzLjA0LjAzNi4wODIuMDUyLjEyNC4wMDguMDIzLjAyMi4wNDQuMDI4LjA2OGEuODA5LjgwOSAwIDAxLjAyOC4yMDl2MjAuNTU5bDguMDA4LTQuNjExdi0xMC41MWMwLS4wNy4wMS0uMTQxLjAyOC0uMjA4LjAwNy0uMDI0LjAyLS4wNDUuMDI4LS4wNjguMDE2LS4wNDIuMDMtLjA4NS4wNTItLjEyNC4wMTUtLjAyNi4wMzctLjA0Ny4wNTQtLjA3MS4wMjQtLjAzMi4wNDQtLjA2NS4wNzItLjA5My4wMjMtLjAyMy4wNTItLjA0LjA3OC0uMDYuMDMtLjAyNC4wNTYtLjA1LjA4OC0uMDY5aC4wMDFsOS42MTEtNS41MzNhLjgwMS44MDEgMCAwMS44IDBsOS42MSA1LjUzM2MuMDM0LjAyLjA2LjA0NS4wOS4wNjguMDI1LjAyLjA1NC4wMzguMDc3LjA2LjAyOC4wMjkuMDQ4LjA2Mi4wNzIuMDk0LjAxOC4wMjQuMDQuMDQ1LjA1NC4wNzEuMDIzLjAzOS4wMzYuMDgyLjA1Mi4xMjQuMDA5LjAyMy4wMjIuMDQ0LjAyOC4wNjh6bS0xLjU3NCAxMC43MTh2LTkuMTI0bC0zLjM2MyAxLjkzNi00LjY0NiAyLjY3NXY5LjEyNGw4LjAxLTQuNjExem0tOS42MSAxNi41MDV2LTkuMTNsLTQuNTcgMi42MS0xMy4wNSA3LjQ0OHY5LjIxNmwxNy42Mi0xMC4xNDR6TTEuNjAyIDcuNzE5djMxLjA2OEwxOS4yMiA0OC45M3YtOS4yMTRsLTkuMjA0LTUuMjA5LS4wMDMtLjAwMi0uMDA0LS4wMDJjLS4wMzEtLjAxOC0uMDU3LS4wNDQtLjA4Ni0uMDY2LS4wMjUtLjAyLS4wNTQtLjAzNi0uMDc2LS4wNThsLS4wMDItLjAwM2MtLjAyNi0uMDI1LS4wNDQtLjA1Ni0uMDY2LS4wODQtLjAyLS4wMjctLjA0NC0uMDUtLjA2LS4wNzhsLS4wMDEtLjAwM2MtLjAxOC0uMDMtLjAyOS0uMDY2LS4wNDItLjEtLjAxMy0uMDMtLjAzLS4wNTgtLjAzOC0uMDl2LS4wMDFjLS4wMS0uMDM4LS4wMTItLjA3OC0uMDE2LS4xMTctLjAwNC0uMDMtLjAxMi0uMDYtLjAxMi0uMDlWMTIuMzNMNC45NjUgOS42NTQgMS42MDIgNy43MnptOC44MS01Ljk5NEwyLjQwNSA2LjMzNGw4LjAwNSA0LjYwOSA4LjAwNi00LjYxLTguMDA2LTQuNjA4em00LjE2NCAyOC43NjRsNC42NDUtMi42NzRWNy43MTlsLTMuMzYzIDEuOTM2LTQuNjQ2IDIuNjc1djIwLjA5NmwzLjM2NC0xLjkzN3pNMzkuMjQzIDcuMTY0bC04LjAwNiA0LjYwOSA4LjAwNiA0LjYwOSA4LjAwNS00LjYxLTguMDA1LTQuNjA4em0tLjgwMSAxMC42MDVsLTQuNjQ2LTIuNjc1LTMuMzYzLTEuOTM2djkuMTI0bDQuNjQ1IDIuNjc0IDMuMzY0IDEuOTM3di05LjEyNHpNMjAuMDIgMzguMzNsMTEuNzQzLTYuNzA0IDUuODctMy4zNS04LTQuNjA2LTkuMjExIDUuMzAzLTguMzk1IDQuODMzIDcuOTkzIDQuNTI0eiIgZmlsbD0iZ3JleSIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+"
                    alt="{{ config('app.name', 'Laravel') }}">
                <img class="bs-popover-right"
                     src="data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTE0IiBoZWlnaHQ9IjI5IiB2aWV3Qm94PSIwIDAgMTE0IDI5IiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciPjx0aXRsZT5Mb2dvdHlwZTwvdGl0bGU+PHBhdGggZD0iTTQuNzczLjkxN3YyMy4wNDZoOC4zMzh2My45NzZILjMzM1YuOTE3aDQuNDR6bTI0LjAxIDExLjQ2NVY5Ljk1aDQuMjA4djE3Ljk5aC00LjIwN3YtMi40MzNjLS41NjcuOTAxLTEuMzcgMS42MDktMi40MTMgMi4xMjMtMS4wNDIuNTE1LTIuMDkxLjc3Mi0zLjE0Ni43NzItMS4zNjUgMC0yLjYxMy0uMjUtMy43NDUtLjc1MmE4Ljc1OCA4Ljc1OCAwIDAgMS0yLjkxNS0yLjA2NiA5LjYgOS42IDAgMCAxLTEuODktMy4wMSA5LjcxNyA5LjcxNyAwIDAgMS0uNjc3LTMuNjNjMC0xLjI2LjIyNS0yLjQ2NC42NzYtMy42MWE5LjU2IDkuNTYgMCAwIDEgMS44OTEtMy4wMyA4Ljc2NiA4Ljc2NiAwIDAgMSAyLjkxNS0yLjA2NWMxLjEzMi0uNTAyIDIuMzgtLjc1MiAzLjc0NS0uNzUyIDEuMDU1IDAgMi4xMDQuMjU3IDMuMTQ2Ljc3MiAxLjA0Mi41MTUgMS44NDYgMS4yMjIgMi40MTMgMi4xMjN6bS0uMzg2IDguNzYzYTYuMjkzIDYuMjkzIDAgMCAwIC4zODctMi4yYzAtLjc3My0uMTMtMS41MDYtLjM4Ny0yLjJhNS41OCA1LjU4IDAgMCAwLTEuMDgtMS44MTUgNS4yMzMgNS4yMzMgMCAwIDAtMS42OC0xLjIzNmMtLjY1Ni0uMzA4LTEuMzgzLS40NjMtMi4xOC0uNDYzLS43OTkgMC0xLjUyLjE1NS0yLjE2My40NjNhNS4yOSA1LjI5IDAgMCAwLTEuNjYgMS4yMzYgNS4zMDcgNS4zMDcgMCAwIDAtMS4wNiAxLjgxNCA2LjU2IDYuNTYgMCAwIDAtLjM2OCAyLjJjMCAuNzcyLjEyMiAxLjUwNi4zNjcgMi4yLjI0NC42OTYuNTk4IDEuMyAxLjA2MiAxLjgxNWE1LjI3OSA1LjI3OSAwIDAgMCAxLjY2IDEuMjM2Yy42NDIuMzA5IDEuMzYzLjQ2MyAyLjE2MS40NjNzMS41MjUtLjE1NCAyLjE4MS0uNDYzYTUuMjIyIDUuMjIyIDAgMCAwIDEuNjgtMS4yMzYgNS41NzUgNS41NzUgMCAwIDAgMS4wOC0xLjgxNHptNy45MTQgNi43OTRWOS45NWgxMS40Mjd2NC4xNDFoLTcuMjJ2MTMuODVoLTQuMjA3em0yNi42NzUtMTUuNTU3VjkuOTVoNC4yMDh2MTcuOTloLTQuMjA4di0yLjQzM2MtLjU2Ni45MDEtMS4zNyAxLjYwOS0yLjQxMyAyLjEyMy0xLjA0Mi41MTUtMi4wOS43NzItMy4xNDYuNzcyLTEuMzY0IDAtMi42MTItLjI1LTMuNzQ0LS43NTJhOC43NTggOC43NTggMCAwIDEtMi45MTUtMi4wNjYgOS42IDkuNiAwIDAgMS0xLjg5MS0zLjAxIDkuNzE3IDkuNzE3IDAgMCAxLS42NzYtMy42M2MwLTEuMjYuMjI1LTIuNDY0LjY3Ni0zLjYxYTkuNTYgOS41NiAwIDAgMSAxLjg5LTMuMDMgOC43NjYgOC43NjYgMCAwIDEgMi45MTYtMi4wNjVjMS4xMzItLjUwMiAyLjM4LS43NTIgMy43NDQtLjc1MiAxLjA1NSAwIDIuMTA0LjI1NyAzLjE0Ni43NzIgMS4wNDMuNTE1IDEuODQ3IDEuMjIyIDIuNDEzIDIuMTIzem0tLjM4NiA4Ljc2M2E2LjI5MyA2LjI5MyAwIDAgMCAuMzg2LTIuMmMwLS43NzMtLjEzLTEuNTA2LS4zODYtMi4yYTUuNTggNS41OCAwIDAgMC0xLjA4LTEuODE1IDUuMjMzIDUuMjMzIDAgMCAwLTEuNjgtMS4yMzZjLS42NTYtLjMwOC0xLjM4NC0uNDYzLTIuMTgxLS40NjMtLjc5OCAwLTEuNTE5LjE1NS0yLjE2Mi40NjNhNS4yOSA1LjI5IDAgMCAwLTEuNjYgMS4yMzYgNS4zMDcgNS4zMDcgMCAwIDAtMS4wNjEgMS44MTQgNi41NiA2LjU2IDAgMCAwLS4zNjcgMi4yYzAgLjc3Mi4xMjEgMS41MDYuMzY3IDIuMi4yNDQuNjk2LjU5OCAxLjMgMS4wNjEgMS44MTVhNS4yNzkgNS4yNzkgMCAwIDAgMS42NiAxLjIzNmMuNjQzLjMwOSAxLjM2NC40NjMgMi4xNjIuNDYzLjc5NyAwIDEuNTI1LS4xNTQgMi4xODEtLjQ2M2E1LjIyMiA1LjIyMiAwIDAgMCAxLjY4LTEuMjM2IDUuNTc1IDUuNTc1IDAgMCAwIDEuMDgtMS44MTR6TTg0LjA2MyA5Ljk1aDQuMjYyTDgxLjQyIDI3Ljk0SDc2LjEzTDY5LjIyNCA5Ljk1aDQuMjYybDUuMjg5IDEzLjc3Nkw4NC4wNjMgOS45NXptMTMuNDQtLjQ2M2M1LjcyOSAwIDkuNjM2IDUuMDc4IDguOTAyIDExLjAyMUg5Mi40NDZjMCAxLjU1MiAxLjU2NyA0LjU1MiA1LjI4OCA0LjU1MiAzLjIgMCA1LjM0NS0yLjgxNSA1LjM0Ni0yLjgxN2wyLjg0MyAyLjJjLTIuNTQyIDIuNzEzLTQuNjIzIDMuOTYtNy44ODIgMy45Ni01LjgyMyAwLTkuNzctMy42ODQtOS43Ny05LjQ1OCAwLTUuMjIzIDQuMDc5LTkuNDU4IDkuMjMxLTkuNDU4em0tNS4wNDYgNy44OTRoMTAuMDg0Yy0uMDMxLS4zNDYtLjU3OC00LjU1Mi01LjA3Mi00LjU1Mi00LjQ5NSAwLTQuOTggNC4yMDYtNS4wMTIgNC41NTJ6bTE2LjY4OCAxMC41NThWLjkxN2g0LjIwOHYyNy4wMjJoLTQuMjA4eiIgZmlsbD0iZ3JleSIgZmlsbC1ydWxlPSJldmVub2RkIi8+PC9zdmc+"
                     alt="{{ config('app.name', 'Laravel') }}">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{url('/')}}">Main</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('profile')}}">User profile prototype</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('page')}}">Abstract page</a>
                    </li>
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

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    <footer class="bg-white fixed-bottom modal-footer shadow">
        <div class="btn-toolbar btn-sm">
            <a class="nav-link" href="https://laravel.com/docs">Docs</a>
            <a class="nav-link" href="https://laracasts.com">Laracasts</a>
            <a class="nav-link" href="https://laravel-news.com">News</a>
            <a class="nav-link" href="https://blog.laravel.com">Blog</a>
            <a class="nav-link" href="https://nova.laravel.com">Nova</a>
            <a class="nav-link" href="https://forge.laravel.com">Forge</a>
            <a class="nav-link" href="https://vapor.laravel.com">Vapor</a>
            <a class="nav-link" href="https://github.com/laravel/laravel">GitHub</a>
        </div>
    </footer>

</div>
</body>
</html>
