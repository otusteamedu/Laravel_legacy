<nav class="navbar navbar-main navbar-expand-lg border-bottom">
    <div class="container">

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_nav" aria-controls="main_nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{route('main')}}">Главная</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/auth">Авторизация</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.main.index')}}">Личный кабинет</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/blank">Пустая</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-md-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Get the app</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="http://example.com" data-toggle="dropdown">English</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#">Russian</a>
                        <a class="dropdown-item" href="#">French</a>
                        <a class="dropdown-item" href="#">Spanish</a>
                        <a class="dropdown-item" href="#">Chinese</a>
                    </div>
                </li>
            </ul>
        </div> <!-- collapse .// -->
    </div> <!-- container .// -->
</nav>