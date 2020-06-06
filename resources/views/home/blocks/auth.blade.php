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
    </ul>
@endguest
