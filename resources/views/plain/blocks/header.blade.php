<div class="wrapper">
    <div class="header-content">
        <div class="logo"><a href="/"><img src="/img/logo.svg" alt=""></a></div>
        <div class="geo"><span><img src="/img/geo.svg" alt=""></span>г. Санкт-Петербург</div>

        <ul class="navbar-nav ml-auto">
            <!-- Authentication Links -->
            <div class="login">
            @guest
                    <button class="js-login" onclick="location.href='/login'">Войти</button>
            @else
                    <button class="" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Выход {{ Auth::user()->name  }}
                    </button>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
            @endguest
            </div>
        </ul>
        <div class="user-login hidden">
            <div class="favorite-link"><a href="">Избранное</a></div>
            <div class="logout"><span>Выход</span></div>
        </div>
    </div>
</div>
