<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <a class="navbar-brand" href="#">@lang('scheduler.name')</a>
    <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
            @include('vrnvgasu::localization.index')
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        @auth
            <li class="nav-item active">
                @if(Route::currentRouteName() === 'main')
                    <a class="nav-link" href="{{ route('dashboard') }}">@lang('scheduler.home')</a>
                @endif
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                    @lang('auth.Logout')
                </a>
            </li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <li class="nav-item active">
                <a class="nav-link" href="{{ route('login') }}">@lang('auth.Login')</a>
            </li>
        {{--Регистрации не будет--}}
            {{--@if (Route::has('register'))
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('register') }}">@lang('auth.Register')</a>
                </li>
            @endif--}}
        @endauth
    </ul>
</nav>
