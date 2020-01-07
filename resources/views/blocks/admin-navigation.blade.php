<ul class="menu" style="max-width:480px;margin:auto;">
    <li><a href="/users">&larr; Список</a></li>
    <li><a href="/users/{{$user->id}}">Смотреть</a></li>
    <li><a href="/users/{{$user->id}}/edit">Редактировать</a></li>
    <li>
        <form id="delete" method="POST" action="/users/{{$user->id}}">
            @method('DELETE')
            @csrf
            <button class="button secondary" type="submit">Удалить</button>
        </form>
    </li>
</ul>
