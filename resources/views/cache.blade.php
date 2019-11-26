<h2>Кэш</h2>

<a href='/cache/clear'>Очистить все</a>
<br><br>
<a href='/cache/clear_grammar_detail'>Удалить страницы Грамматики</a>
<br><br>
<form action='/cache/clear_key' method='POST'>
    @csrf
    <input name="key" placeholder='Ключ' type='text'>
    <button>Удалить ключ</button>
</form>
<a href='/cache/heating'>Прогрев</a>
