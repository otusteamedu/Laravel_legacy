<form id="logout-form" action="{{ route('logout') }}" method="POST" style="text-align:center;">
    @csrf
    <button type="submit" class="button secondary">Выйти</button>
</form>
