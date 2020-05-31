<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">


</head>

<body>

<div class="wrapper">

    @include('layouts.accounts.modules.top_nav')

    <div class="container-fluid">
        <div class="row">


            @include('layouts.accounts.modules.sidebar.index')

            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">

                @yield('menu_content')

            </div>

        </div>
    </div>

</div>


<script src="{{asset('js/manifest.js')}}"></script>

<script src="{{asset('js/vendor.js')}}"></script>
<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>
