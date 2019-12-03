
<nav class="navbar navbar-expand-md">
    <a class="navbar-brand" href="#">My Blog</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04" aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item @if(Request::route()->getName() == 'admin.users.index') active @endif ">
                <a class="nav-link" href="{{ route('admin.users.index') }}">Пользователи <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.blog.posts.index') }}">Блог</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.blog.categories.index') }}">Категории</a>
            </li>
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="#">About Me</a>--}}
            {{--</li>--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" href="{{ route('contact') }}">Contacts</a>--}}
            {{--</li>--}}
        </ul>
        <ul class="navbar-nav my-2 my-md-0">
            <li class="nav-item">
                {{--<a class="nav-link" href="{{ route('login') }}">Login</a>--}}
                <div class="btn-group">
                    <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{--TODO: имя пользователя--}}
                        Иванов Иван
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#">Профиль</a>
                        {{--<a class="dropdown-item" href="#">Another action</a>--}}
                        {{--<a class="dropdown-item" href="#">Something else here</a>--}}
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Выход</a>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</nav>
