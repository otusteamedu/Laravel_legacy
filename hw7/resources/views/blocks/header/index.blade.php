<div class="header">
    <h1 class="display-4"><a href="/"> {{ $title }} </a></h1>
    <p class="lead">{{ $description }}</p>
    @php
        $menu = [
        [
        'id' => 1,
        'url' =>'/about',
        'title' => 'Как это работает',
        ],
        [
        'id' => 2,
        'url' =>'/registration',
        'title' => 'Регистрация',
        ],
        [
        'id' => 3,
        'url' =>'/help',
        'title' => 'Помощь',
       ],
        [
        'id' => 4,
        'url' =>'/login',
        'title' => 'Вход',
        ],
        [
        'id' => 5,
        'url' =>'/tasks',
        'title' => 'Задачи пользователя',
        ],
        ];
    @endphp
    @include('blocks.menu.index', ['menu' => $menu])

</div>
