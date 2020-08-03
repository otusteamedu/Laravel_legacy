<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a href="/" class="text-decoration-none text-dark">
            <img src="/images/icon.svg" width="30" height="30">
            ServiceTime
        </a>
    </h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="#">Главная</a>
        <a class="p-2 text-dark" href="#features">Преимущества</a>
        <a class="p-2 text-dark" href="#about">О продукте</a>
    </nav>

    @if (Route::has('login'))
        <div class="top-right links">
            @guest
                <a class="btn btn-outline-primary" href="{{ route('login') }}">Вход</a>

                @if (Route::has('register'))
                    <a class="btn btn-success ml-2" href="{{ route('register') }}">Регистрация</a>
                @endif
            @endauth
        </div>
    @endif

</div>
