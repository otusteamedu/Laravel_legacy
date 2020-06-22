<div class="header__sub">
    @if(Auth::user()->role == 'admin')
    <span><a href="/cms/countries">Страны |</a></span>
    <span><a href="/cms/cities">Города |</a></span>
    <span><a href="/cms/tariffs">Тарифы |</a></span>
    <span><a href="/cms/segments">Сегменты |</a></span>
    <span><a href="/cms/users">Пользователи |</a></span>
    <span><a href="/cms/categories">Категории |</a></span>
    @endif
    <span><a href="/cms/projects">Проекты |</a></span>
    <span><a href="/cms/offers">Предложения</a></span>
</div>
