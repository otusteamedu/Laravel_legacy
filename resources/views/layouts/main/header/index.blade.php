<div class="header">
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
        <a class="navbar-brand" href="{{ route('home') }}">Navbar</a>
        <button class="navbar-toggler" type="button"
                data-toggle="collapse"
                data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup"
                aria-expanded="false"
                aria-label="Toggle navigation"
        >
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">@lang('pages.main')</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('accounts') }}">@lang('pages.planner')</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('proxy') }}">@lang('pages.proxy')</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ \App\Services\LanguageResolver::getLanguageUrl('ru')  }}">ru</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ \App\Services\LanguageResolver::getLanguageUrl('en')  }}">en</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle{{ (Request::path() == 'personal') ? ' active' : "" }}" href="{{ route('personal') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(Auth::check())
                            <span>{{ Auth::getUser()->email  }}</span>
                        @else
                            <span>@lang('auth.profile')</span>
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::check())
                            <a class="dropdown-item" href="{{ route('personal') }}">@lang('auth.profile')</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">@lang('auth.logout')</a>
                        @endif
                        @guest
                            <a class="dropdown-item" href="{{ route('login') }}">@lang('auth.sign_in')</a>
                            <a class="dropdown-item" href="{{ route('register') }}">@lang('auth.sign_up')</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
