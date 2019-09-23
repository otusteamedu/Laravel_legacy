<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('pageTitle') - @lang('admin.sitename')</title>
        <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
        @yield('styles')

        <script src="{{ asset('js/admin.js') }}"></script>
        <script src="https://kit.fontawesome.com/d36168dd1e.js"></script>
        @yield('scripts')
    </head>
    <body>
        @include('admin.elements.page.top')
        <div class="container-fluid">
            <div class="row">
                @include('admin.elements.page.left')

                <main role="main" class="col-md-9 ml-sm-auto col-lg-9 px-4">
                    @yield('pageTop')
                    <div class="page-content container-fluid">
                        @yield('pageContent')
                    </div>
                </main>
            </div>
        </div>
        @include('admin.elements.page.footer')
    </body>
</html>
