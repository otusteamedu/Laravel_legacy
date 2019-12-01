@php
    $menu = [
        [
            'title' => null,
            'items' => [
                [
                'name' => 'Избранное',
                'link' => '/test/',
                'count' => 3
                ],
                 [
                'name' => 'Читальный зал',
                'link' => '/test/',
                'count' => 2
                ],
                 [
                'name' => 'Читаю',
                'link' => '/test/',
                'count' => 1
                ],
            ]
        ],

         [
            'title' => 'Категории',
            'items' => [
                [
                'name' => 'Програмирование',
                'link' => '/test/',
                ],
                 [
                'name' => 'Менеджемент',
                'link' => '/test/',
                ],
                 [
                'name' => 'Продажи',
                'link' => '/test/',
                ],
                [
                'name' => 'Дизайн',
                'link' => '/test/',
                ],
                [
                'name' => 'Художественная литература',
                'link' => '/test/',
                ],

            ]
        ]
    ]

@endphp

<nav class="navigate">
        @foreach ($menu as  $navItems)
        <ul class="listMenu">
            @if(!empty($navItems['title']))
                <div class="navigate__title">{{$navItems['title']}}</div>
            @endif
            @foreach ($navItems['items'] as $item)
                <li class="listMenu__item"><a class="listMenu__link" href="{{$item['link']}}">{{$item['name']}}</a>
                    @if(!empty($item['count']))
                        <div class="listMenu__icon count blue">{{$item['count']}}</div>
                    @endif
                </li>
            @endforeach
        </ul>
        @endforeach
</nav>
