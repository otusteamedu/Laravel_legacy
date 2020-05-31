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
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Главная</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('about') }}">О нас</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('prices') }}">Цены</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Контакты</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="{{ \App\Services\LanguageResolver::getLanguages('ru')  }}">ru</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ \App\Services\LanguageResolver::getLanguages('en')  }}">en</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle{{ (Request::path() == 'personal') ? ' active' : "" }}" href="{{ route('personal') }}" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        @if(Auth::check())
                            <span>{{ Auth::getUser()->email  }}</span>
                        @else
                            <span>Личный кабинет</span>
                        @endif
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::check())
                            <a class="dropdown-item" href="{{ route('personal') }}">Личный кабинет</a>
                            <a class="dropdown-item" href="{{ route('logout') }}">Выйти</a>
                        @endif
                        @guest
                            <a class="dropdown-item" href="{{ route('login') }}">Войти</a>
                            <a class="dropdown-item" href="{{ route('register') }}">Регистрация</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
