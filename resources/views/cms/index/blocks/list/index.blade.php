<table class="table table-striped">
    @include('cms.index.blocks.list.header')
    <tbody>

    @php
    {{ if (Auth::check()) $user = Auth::user(); }}
    @endphp

    @if($user->canDo('view','country'))
        <tr>
            <th scope="row"><a href="/cms/countries">Страны</a></th>
            <td>Редактирование списка стран</td>
        </tr>
    @endif
    @if($user->canDo('view','city'))
        <tr>
            <th scope="row"><a href="/cms/cities">Города</a></th>
            <td>Редактирование списка городов</td>
        </tr>
    @endif
    @if($user->canDo('view','tariff'))
        <tr>
            <th scope="row"><a href="/cms/tariffs">Тарифы</a></th>
            <td>Редактирование списка тарифов</td>
        </tr>
    @endif
    @if($user->canDo('view','segment'))
        <tr>
            <th scope="row"><a href="/cms/segments">Сегменты</a></th>
            <td>Редактирование списка сегментов</td>
        </tr>
    @endif
    @if($user->canDo('view','user'))
        <tr>
            <th scope="row"><a href="/cms/users">Пользователи</a></th>
            <td>Редактирование списка пользователей</td>
        </tr>
    @endif
    @if($user->canDo('view','category'))
        <tr>
            <th scope="row"><a href="/cms/categories">Категории</a></th>
            <td>Редактирование списка категорий</td>
        </tr>
    @endif
    @if($user->canDo('view','project'))
        <tr>
            <th scope="row"><a href="/cms/projects">Проекты</a></th>
            <td>Редактирование списка проектов</td>
        </tr>
    @endif
    @if($user->canDo('view','offer'))
        <tr>
            <th scope="row"><a href="/cms/offers">Предложения</a></th>
            <td>Редактирование списка предложений</td>
        </tr>
    @endif

    </tbody>
</table>

