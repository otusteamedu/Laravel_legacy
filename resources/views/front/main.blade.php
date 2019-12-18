<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Мониторинг и поддержка Ваших сайтов 24/7</title>
    <meta name="description" content="Мониторинг и поддержка Ваших сайтов 24/7">
    <link rel="icon" type="image/png" href="favicons/favicon.ico" sizes="16x16">
    <link rel="stylesheet" href="{{asset('theme/css/all.css')}}">
    <link rel="icon" type="image/png" href="{{asset('theme/favicons/favicon.ico')}}" sizes="16x16">
    <link rel="stylesheet" href="{{asset('theme/fonts/font-awesome-4.3.0/css/font-awesome.min.css')}}">
</head>
<body>
@include('front.include.header')
@yield('content')
<script src="{{asset('theme/js/all.js')}}"></script>
</body>
</html>
