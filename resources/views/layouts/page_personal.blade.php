<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@isset($title){{ $title }}@endisset</title>
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

    @include('layouts.scripts')
    @include('layouts.styles')

</head>
<body>
@include('blocks.header.auth')


@if(Request::path() != '/')
    @include('blocks.breadcrumps')
@endif

<div class="container">
    <div class="row py-5">
        <div class="col-12 col-md-4">
            @include('blocks.menu_left.personal')
        </div>
        <div class="col-12 col-md-8">

            @yield('content')

        </div>
    </div>
</div>


@include('blocks.footer')
</body>
</html>