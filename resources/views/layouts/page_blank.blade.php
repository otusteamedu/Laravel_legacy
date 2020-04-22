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
@include('blocks.header.blank')


@yield('content')


@include('blocks.footer')
</body>
</html>