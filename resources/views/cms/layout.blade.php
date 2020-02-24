<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title') - CMS News Portal</title>
        <link rel="stylesheet" href="{{ mix('css/cms.css') }}">
        @yield('styles')
    </head>
    <body>
        <header class="row mr-0 ml-0">
            <div class="col-2 col-md-3 col-sm-4 bg-light pl-0 pr-0">
                <div class="p-2">
                    <a href="/cms">{{__('cms.index')}}</a>
                </div>
            </div>
            <div class="col-7 col-md-6 col-sm-4 pl-0 pr-0">
                @include('cms.blocks.navibar', ['items' => $cmsMenu->crumbMenu()])
            </div>
            <div class="col-3 col-md-3 col-sm-4 pl-0 pr-0">
                <div class="p-2 text-right breadcrumb-bg">
                    ({{ link_to(route('cms.users.show', ['user' => \Auth::user()->id]), \Auth::user()->name) }})
                    {{link_to(route('portal.logout'), __('cms.actions.logout'))}}
                </div>
            </div>
        </header>
        <main class="row mr-0 ml-0">
            <div class="col-2 col-md-3 col-sm-4 sidebar bg-light pl-0 pr-0">
                <div class="p-2">
                    <h4>{{__('cms.menu')}}</h4>
                    @include('cms.blocks.menu', [
                        'items' => $cmsMenu->roots()->first()->children(),
                        'class' => 'nav flex-column'
                    ])
                </div>
            </div>
            <div class="col-10 col-md-9 col-sm-8 pl-0 pr-0">
                <div class="row mr-0 ml-0 justify-content-between">
                    <h1 class="p-2">@yield('h1')</h1>
                    @yield('controls')
                </div>
                @yield('content')
            </div>
        </main>
        <footer class="bg-dark">
            <div class="float-right">
                <div class="nav-item nav-link text-white-50">
                    &copy CMS News Portal - {{date('Y')}}
                </div>
            </div>
            <div class="clearfix"></div>
        </footer>
        <script src="{{ mix('/js/app.js') }}"></script>
        @stack('scripts')
    </body>
</html>