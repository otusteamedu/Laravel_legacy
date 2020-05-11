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

<header>
    <nav class="navbar navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLeft">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a href="/" class="navbar-brand mb-0 h1">Codre <small>CRM</small></a>
        @if ($user ?? null)
            @include('blocks.navbar.user')
        @endunless
    </nav>
</header>
<div class="row content">
    @if ($user ?? null)
        <div class="col-md-3 col-lg-2">
            @include('blocks.navbar.left')
        </div>
    @endif

    <div class="{{ empty($user) ? 'container' : 'col-md-9 col-lg-10 content-block' }}">
        @yield('content')
    </div>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
@stack('scripts')

</body>
</html>
