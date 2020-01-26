<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Вставь значение переменной pageTitle, ну а если такогого не будет - используй дефолтное значение 'Some Page' --}}
    <title>@yield('pageTitle', 'Без имени')</title>

    <!-- Common CSS -->
    @include('blocks/common-CSS')

    <!-- This page CSS -->
    <link rel="stylesheet" href="/css/@yield('pageName').css">

    <!--Favicon-->
    <link rel="icon" href="{{asset('img/favicon.png')}}" type="image/png">

</head>
<body>

@include('blocks/top-nav')

{{-- вставь сюда раздел файла --}}
@yield('pageContent')

@include('blocks/footer')



<!-- Common JS -->
@include('blocks/common-JS')

<!-- This page JS -->
<script src="/js/@yield('pageName').js"></script>
</body>
</html>
