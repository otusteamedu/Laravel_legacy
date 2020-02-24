<head>
    <base href="{{URL::asset('/')}}" target="_top">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Telegram Helper">
    <meta name="author" content="Ivan Ivanov">
    <meta name="keywords" content="Telegram Helper">

    <!-- Title Page-->
    <title>Main</title>

    <!-- Fontfaces CSS-->
    <link href="{{{ URL::asset('css/font-face.css') }}}" rel="stylesheet" media="all">
    <link href="{{{ URL::asset('vendor/font-awesome-4.7/css/font-awesome.min.css')}}}" rel="stylesheet" media="all">
    <link href="{{{ URL::asset('vendor/font-awesome-5/css/fontawesome-all.min.css')}}}" rel="stylesheet" media="all">
    <link href="{{{ URL::asset('vendor/mdi-font/css/material-design-iconic-font.min.css')}}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{{ URL::asset('vendor/bootstrap-4.1/bootstrap.min.css')}}}" rel="stylesheet" media="all">

    <link href="{{{ URL::asset('vendor/animsition/animsition.min.css')}}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{{ URL::asset('css/theme.css')}}}" rel="stylesheet" media="all">


</head>

<body class="">
    <div class="page-wrapper">
        @include('blocks.header')
        @include('blocks.sidebar')
        <div class="page-container">
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                    @yield('content')
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
            @include('blocks.footer')
            </div>
        </div>
    </div>
    @include('blocks.js')
</body>
