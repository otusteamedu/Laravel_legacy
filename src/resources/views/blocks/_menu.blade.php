<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">
        <a href="/" class="text-decoration-none text-dark">
            <img src="/images/icon.svg" width="30" height="30">
            ServiceTime
        </a>
    </h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="/">Главная</a>
        <a class="p-2 text-dark" href="/business">Салон</a>
        <a class="p-2 text-dark" href="/staff">Персонал</a>
        <a class="p-2 text-dark" href="/records">Записи</a>
        <a class="p-2 text-dark" href="/procedures">Процедуры</a>
        <a class="p-2 text-dark" href="/statistic">Статистика</a>
    </nav>

    @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-sm btn-outline-danger">
                        <i class="fa fa-sign-out-alt"></i> Выход
                    </button>
                </form>
            @endauth
        </div>
    @endif
</div>
