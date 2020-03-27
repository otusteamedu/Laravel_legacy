<head>
    <meta charset="utf-8" />
    <base href="{{ env('APP_URL') }}/" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1" />
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="{{ mix("/css/app.css")}}"/>
    @stack('styles')
</head>
