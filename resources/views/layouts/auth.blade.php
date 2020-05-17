<!-- Основной шаблон приложения -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="yandex-verification" content="1e4b7d2cb3f2f906" />
    <meta name='wmail-verification' content='48b82434d510086788c12abce25b1a0d' />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Scripts -->
    <!-- Styles -->
    <link href="{{ asset('css/register.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

</head>

<body>
    <div class="container">
        <div class="dt_box ">
            <div class="logo">
            <a href="/">
                <h1 class="text">Sckatik-tv</h1>
            </a>
            </div>
            @yield('content')

            <div class="text_ft">Sckatik-tv © 2020</div>
        </div>
    </div>
</body>

</html>
