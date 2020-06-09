<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? '' }} - Codre CRM</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
<body>
<div id="app">
    <header>
        <nav class="navbar navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLeft">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a href="/" class="navbar-brand mb-0 h1">Codre <small>CRM</small></a>
            @auth
                @include('blocks.navbar.user')
            @endauth
        </nav>
    </header>
    <div class="row content">
        @auth
            <div class="col-md-3 col-lg-2">
                @include('blocks.navbar.left')
            </div>
        @endauth

        <div class="@auth col-md-9 col-lg-10 content-block @endauth @guest container @endguest">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
