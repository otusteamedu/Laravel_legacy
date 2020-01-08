<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('pageTitle')</title>
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @yield('styles')

        <script src="{{ asset('js/app.js') }}"></script>
        <script src="https://kit.fontawesome.com/d36168dd1e.js"></script>
        <script src="http://api-maps.yandex.ru/2.1/?lang=ru_RU"></script>
        @yield('scripts')
    </head>
    <body>
        @include('public.elements.page.top')
        <div class="page-wrapper page-in">
            @include('public.elements.page.header')
            @section('breadCrumbs')
                @isset($breadCrumbs)
                    <nav aria-label="breadcrumb" class="mb-3">
                        <ol class="breadcrumb">
                        @foreach($breadCrumbs as $item)
                            @if (!$loop->last)
                                <li class="breadcrumb-item"><a href="{{ $item['url'] }}">{{ $item['title'] }}</a></li>
                            @else
                                <li class="breadcrumb-item active" aria-current="page">{{ $item['title'] }}</li>
                            @endif
                        @endforeach
                        </ol>
                    </nav>
                @endisset
            @endsection

            @yield('breadCrumbs')

            @section('pageH1')
                @hasSection('pageHeader')
                    <div class="container-fluid">
                        <h1>@yield('pageHeader')</h1>
                    </div>
                @endif
            @endsection

            @yield('pageH1')

            <div class="page-content">
                @include('public.elements.messages')
                @yield('pageContent')
            </div>
        </div>
        @include('public.elements.page.footer')
        @include('public.elements.page.copy')
    </body>
</html>

