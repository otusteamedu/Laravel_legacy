<!doctype html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Backend: Strava Clone</title>
    {{-- TODO Заменить стили (генерировать независимые стили для backend) --}}
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('styles')
</head>
{{-- TODO Формировать body_class автоматически на основе текущего route --}}
<body class="@yield('body_class')">

<div class="flex-column">
    @include('backend.partials.header')
    @yield('content')
    @include('backend.partials.footer')
</div>
{{-- TODO Заменить скрипты (генерировать независимые скрипты для backend) --}}
<script src="{{ mix('/js/app.js') }}"></script>
@yield('scripts')
</body>
</html>
