<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">@lang('scheduler.name')</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                @lang('scheduler.lang')
            </a>
            <div class="dropdown-menu bg-dark">
                <a class="dropdown-item text-light" href="#">рус</a>
                <a class="dropdown-item text-light" href="#">en</a>
            </div>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @auth
        <li class="nav-item active">
                <a class="nav-link" href="#">@lang('auth.Logout')</a>
        </li>
            @else
            <li class="nav-item active">
                <a class="nav-link" href="#">@lang('auth.Login')</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="#">@lang('auth.Register')</a>
            </li>
            @endauth

    </ul>
</nav>
