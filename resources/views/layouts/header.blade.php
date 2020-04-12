<nav class="navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <header class="py-3">
                    <div class="row">
                        <div class="col-12 col-md-1 col-lg-1 pt-1">
                            <a class="py-2" href="{{ route('index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
                            </a>
                        </div>
                        <div class="col-11 col-md-11 col-lg-6">
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('about.index') }}">@lang('layouts/header.top_menu_about')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('events.index') }}">@lang('layouts/header.top_menu_event_list')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('news.index') }}">@lang('layouts/header.top_menu_news')</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/articles/">@lang('layouts/header.top_menu_articles')</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 col-md-6 col-lg-3 mt-1 text-center">
                            <div class="btn-group">
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @lang('global.language')
                                </button>
                                <div class="dropdown-menu">
                                    @foreach ($alLocaleList as $locale)
                                        <a href="{{ route('set.locale', $locale['code']) }}" class="dropdown-item">
                                            {{ucfirst($locale['code'])}} ({{ ($locale['name']) }})
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                            <a class="text-muted" href="{{ route('index') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                     stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                     class="mx-3">
                                    <circle cx="10.5" cy="10.5" r="7.5"></circle>
                                    <line x1="21" y1="21" x2="15.8" y2="15.8"></line>
                                </svg>
                                @lang('global.search')
                            </a>
                        </div>
                        <div class="col-12 col-md-6 col-lg-2 justify-content-end">
                            <nav class="navbar-expand navbar-light">
                                <div id="navbarNav">
                                    <ul class="navbar-nav">
                                        @guest
                                            <li class="nav-item active <?// @ToDo: подставлять active только на соответствующей странице?> mx-auto mx-md-0 js-auth">
                                                <a class="nav-link" data-toggle="modal" data-target=".bd-modal-auth" href="{{ route('login') }}">Вход</a>
                                            </li>
                                            @if (Route::has('register'))
                                                <li class="nav-item active <?// @ToDo: подставлять active только на соответствующей странице?> mx-auto mx-md-0 js-register">
                                                    <a class="nav-link" data-toggle="modal" data-target=".bd-modal-registration" href="{{ route('register') }}">Регистрация</a>
                                                </li>
                                            @endif
                                        @else
                                            <li class="nav-item active <?// @ToDo: подставлять active только на соответствующей странице?> mx-auto mx-md-0 dropdown">
                                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                    {{ Auth::user()->name }} {{ Auth::user()->last_name }} <span class="caret"></span>
                                                </a>

                                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                                    <a class="dropdown-item" href="{{ route('personal.index') }}">
                                                        @lang('pages/personal_index.profile')
                                                    </a>
                                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                        @lang('global.quit')
                                                    </a>

                                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                        @csrf
                                                    </form>
                                                </div>
                                            </li>
                                        @endguest
                                    </ul>
                                </div>
                            </nav>
                        </div>
                    </div>
                </header>
            </div>
        </div>
    </div>
</nav>
<main role="main" class="container">
@if (!Route::is('index'))
    <div class="row">
        @if (Route::is('events.index'))
            <div class="col-lg-12">
        @else
            <div class="col-lg-8">
        @endif
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Главная</a></li>
                    <li class="breadcrumb-item"><a href="#">Раздел</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Детальная</li>
                </ol>
            </nav>
        </div>
        <div class="col-lg-4"></div>
    </div>
    <div class="row">
    @if (Route::is('events.index'))
        <div class="col-lg-12">
    @else
        <div class="col-lg-8">
    @endif
            <div style="height: 50px">
                <h1 class="text-left">@yield('h1')</h1>
            </div>

@endif


