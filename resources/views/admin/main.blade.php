<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
{{--    <base href="{{ env('APP_URL') }}/" />--}}
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>window.Laravel = { csrfToken: '{{ csrf_token() }}' }</script>
    <title>Raduga - administrator</title>
    <link rel="stylesheet" href="{{ mix('/css/admin.app.css') }}">
</head>
<body>

<div id="app"></div>

<script src="{{ mix('/js/admin.app.js') }}" defer></script>
{{--@auth--}}
{{--    <script>--}}
{{--        window.user = @json(auth()->user());--}}
{{--        console.log(window.user.roles);--}}
{{--    </script>--}}
{{--@endauth--}}
</body>
</html>
