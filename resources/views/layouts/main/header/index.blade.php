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
                <li class="nav-item"><a class="nav-link{{ (Request::path() == '/') ? ' active' : "" }}" href="/">Главная <span class="sr-only">(current)</span></a></li>
                <li class="nav-item"><a class="nav-link{{ (Request::path() == 'about') ? ' active' : "" }}" href="/about/">О нас</a></li>
                <li class="nav-item"><a class="nav-link{{ (Request::path() == 'prices') ? ' active' : "" }}" href="/prices/">Цены</a></li>
                <li class="nav-item"><a class="nav-link{{ (Request::path() == 'contacts') ? ' active' : "" }}" href="/contacts/">Контакты</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle{{ (Request::path() == 'personal') ? ' active' : "" }}" href="/personal" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Личный кабинет</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="/personal">Личный кабинет</a>
                        <a class="dropdown-item" href="/registration">Регистрация</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
