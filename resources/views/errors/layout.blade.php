<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,400,700" rel="stylesheet">

    <link type="text/css" rel="stylesheet" href="https://colorlib.com/etc/404/colorlib-error-404-4/css/style.css">

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div id="notfound">
    <div class="notfound">
        <div class="notfound-404">
            <h1>@lang('Oops!')</h1>
            <h2>@yield('code') - @yield('message')</h2>
        </div>
        <a href="#">@lang('Go TO Homepage')</a>
    </div>
</div>

</body>
</html>