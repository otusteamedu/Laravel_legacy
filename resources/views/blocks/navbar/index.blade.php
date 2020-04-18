@php
    $page = $page ?? '';
@endphp
<nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
    <a class="navbar-brand" href="/">Watchlist</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if ($page == 'index') active @endif">
                <a class="nav-link" href="{{ route('dashboard.index', $locale) }}">@lang('menu.main') <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="/cms/">@lang('menu.cms') <span class="sr-only">(current)</span></a>
            </li>
            {{--
            <li class="nav-item @if ($page == 'profile') active @endif">
                <a class="nav-link" href="/{{ App::getLocale() }}/profile">@lang('menu.profile')</a>
            </li>
            <li class="nav-item @if ($page == 'register') active @endif">
                <a class="nav-link" href="/{{ App::getLocale() }}/register">@lang('menu.register')</a>
            </li>
            --}}
        </ul>
        <!-- Right Side Of Navbar -->
        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    {{ strtoupper(App::getLocale()) }}
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    @php
                    $link = $page == 'index' ? '/' : ('/' . $page);
                    @endphp
                    <li role="presentation"><a href="/ru{{ $link }}" class="language">RU</a></li>
                    <li role="presentation"><a href="/en{{ $link }}" class="language">EN</a></li>
                </ul>
            </li>
        </ul>
    </div>

    {{--
    <form class="form-inline">
        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    --}}
</nav>
<nav class="navbar navbar-light bg-light">

</nav>
