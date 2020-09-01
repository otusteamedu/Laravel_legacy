@php(App::setLocale('ru'))
<div class="container">
    <div class="row alert alert-primary justify-content-center ">
        <h1> @lang('home.admin-title')</h1>
    </div>
</div>

<div class="container">
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active" href="/divisions">@lang('home.admin-header.divisions')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/towns">@lang('home.admin-header.towns')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/adverts">@lang('home.admin-header.adverts')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/messages">@lang('home.admin-header.messages')</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">@lang('home.admin-header.any')</a>
        </li>
    </ul>

    @guest
        <ul class="nav justify-content-center">
            <li class="nav-item ml-auto">
                <a class="nav-link" href="{{ route('login') }}">Войти</a>
            </li>
    @if (Route::has('register'))
            <li class="nav-item pl-0">
                <a class="nav-link" href="{{ route('register') }}">Зарегистрироваться</a>
            </li>
    @endif
            <li class="nav-item pl-0">
                <a class="nav-link" href="{{ route('lk', ['locale'=>'ru']) }}">Кабинет</a>
            </li>
        </ul>

    @else
    <ul class="nav justify-content-center">
        <li class="nav-item ml-auto">
            <a class="nav-link alert-link" href="#"> {{ Auth::user()->name }} </a>

        </li>
        <li class="nav-item pl-0">
            <form action="{{ route('logout') }}" method="POST" >
                @csrf
                <button type="submit" class="btn btn-link">(logout)</button>
            </form>
        </li>
        <li class="nav-item pl-0">
            <a class="nav-link" href="{{ route('lk', ['locale'=>'ru']) }}">Кабинет</a>
        </li>
    </ul>
    @endguest


</div>


