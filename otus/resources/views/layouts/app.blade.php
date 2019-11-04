<html>
<head>
    <title>App Name - @yield('title')</title>
    {{ Html::style('css/app.css') }}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<div class="container">
    @yield('content')
</div>
</body>
</html>
