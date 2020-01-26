{{-- Себе на будущее. Сначала разберись как рационально вызывать View::share в контроллерах. --}}
{{-- @if($userIsLoggedIn ==true) --}}

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="text-align:center;">
    @csrf
    <button type="submit" class="button secondary">Выйти</button>
</form>

{{-- @endif --}}

