<div class="header">
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg">
        <a class="navbar-brand" href="/">Navbar</a>
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
                @guest
                    <li class="nav-item"><a class="nav-link{{ (Request::path() == '/') ? ' active' : "" }}" href="/">Главная</a></li>
                    <li class="nav-item"><a class="nav-link{{ (Request::path() == 'about') ? ' active' : "" }}" href="/about/">О нас</a></li>
                    <li class="nav-item"><a class="nav-link{{ (Request::path() == 'prices') ? ' active' : "" }}" href="/prices/">Цены</a></li>
                    <li class="nav-item"><a class="nav-link{{ (Request::path() == 'contacts') ? ' active' : "" }}" href="/contacts/">Контакты</a></li>
                @else
                    <li class="nav-item"><a class="nav-link{{ (Request::path() == '/') ? ' active' : "" }}" href="/planner">Запланированные посты</a></li>
                    <li class="nav-item"><a class="nav-link{{ (Request::path() == '/') ? ' active' : "" }}" href="">Галерея изображений</a></li>
                    <li class="nav-item"><a class="nav-link{{ (Request::path() == '/') ? ' active' : "" }}" href="/">Мои Прокси</a></li>
                    <li class="nav-item"><a class="nav-link{{ (Request::path() == '/') ? ' active' : "" }}" href="/">Мои аккаунты</a></li>
                @endif
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle{{ (Request::path() == 'personal') ? ' active' : "" }}" href="/personal" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Личный кабинет</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::check())
                            <a class="dropdown-item" href="/personal">Личный кабинет</a>
                            <a class="dropdown-item" href="/logout">Выйти</a>
                        @endif
                        @guest
                            <a class="dropdown-item" href="/login">Войти</a>
                            <a class="dropdown-item" href="/register">Регистрация</a>
                        @endif
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
