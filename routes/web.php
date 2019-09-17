<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Route;

$GLOBALS = array_merge($GLOBALS, [
    'arCinemas' => [
        [
            'ID' => 1,
            'NAME' => 'Ромашка',
            'PICTURE' => 'images/cinemas/romashka.jpg',
            'ADDRESS' => 'г.Тамань, Овчинниковская набережная, д.20',
            'POINT' => ["45.2153138764426","36.708756415655266"]
        ], [
            'ID' => 2,
            'NAME' => 'Ударник',
            'PICTURE' => 'images/cinemas/udarnik.jpg',
            'ADDRESS' => 'г.Тамань, ул. Карла Маркса, д.123',
            'POINT' => ["45.21767029091418","36.7207834408776"]
        ], [
            'ID' => 3,
            'NAME' => 'Красный октябрь',
            'PICTURE' => 'images/cinemas/krasniy.jpg',
            'ADDRESS' => 'г.Тамань, ул. Карла Маркса, д.100',
            'POINT' => ["45.20593085156893","36.71771499376365"]
        ], [
            'ID' => 4,
            'NAME' => 'Космос',
            'PICTURE' => 'images/cinemas/kosmos.jpg',
            'ADDRESS' => 'г.Тамань, ул.Некрасова, д.5',
            'POINT' => ["45.218003936068165","36.74455854158469"]
        ], [
            'ID' => 5,
            'NAME' => 'Люксембург',
            'PICTURE' => 'images/cinemas/lux.jpg',
            'ADDRESS' => 'г.Тамань, ул. Розы Люксембург, д.5',
            'POINT' => ["45.201653088161805","36.69623586396975"]
        ]
    ],
    'arMovies' => [
        [
            'id' => 392,
            'name' => 'Оно 2 (It Chapter Two)',
            'premiereDate' => new DateTime('2019-09-05'),
            'ageLimit' => '18',
            'slogan' => 'Поплаваем опять (You\'ll Float Again)',
            'description' => 'Проходит 27 лет после первой встречи ребят с демоническим Пеннивайзом. 
                Они уже выросли, и у каждого своя жизнь. Но неожиданно их спокойное существование нарушает 
                странный телефонный звонок, который заставляет старых друзей вновь собраться вместе.',
            'poster' => 'images/films/7.jpg',
            'actors' => [
                [
                    'id' => 1,
                    'name' => 'Джессика Честейн'
                ], [
                    'id' => 2,
                    'name' => 'Джессика Честейн'
                ], [
                    'id' => 4,
                    'name' => 'Джеймс МакЭвой'
                ], [
                    'id' => 5,
                    'name' => 'Билл Хейдер'
                ], [
                    'id' => 7,
                    'name' => 'Айзая Мустафа'
                ], [
                    'id' => 8,
                    'name' => 'Джей Райан'
                ], [
                    'id' => 12,
                    'name' => 'Джеймс Рэнсон'
                ], [
                    'id' => 14,
                    'name' => 'Энди Бин'
                ], [
                    'id' => 17,
                    'name' => 'Билл Скарсгард'
                ], [
                    'id' => 21,
                    'name' => 'Джейден Мартелл'
                ], [
                    'id' => 27,
                    'name' => 'Уайатт Олефф'
                ]
            ],
            'countries' => [
                [
                    'id' => 1,
                    'name' => 'Канада',
                ], [
                    'id' => 2,
                    'name' => 'США',
                ]
            ],
            'genres' => [
                [
                    'id' => 10,
                    'name' => 'Ужасы',
                ], [
                    'id' => 12,
                    'name' => 'Триллер',
                ]
            ],
            'producer' => [
                'id' => 331,
                'name' => 'Андрес Мускетти'
            ],
            'duration' => 169,
            'trailer' => 'https://www.youtube.com/watch?v=T1PbbofT1Hg'
        ], [
            'id' => 1,
            'name' => 'Седьмой сукин сын',
            'premiereDate' => '',
            'ageLimit' => '',
            'slogan' => '',
            'poster' => 'images/films/1.jpg',
            'description' => '',
            'actors' => [],
            'countries' => [],
            'genres' => [],
            'producer' => false,
            'duration' => 169,
            'trailer' => false
        ], [
            'id' => 2,
            'name' => 'За 2 дня до послезавтра',
            'premiereDate' => '',
            'ageLimit' => '',
            'slogan' => '',
            'poster' => 'images/films/2.jpg',
            'description' => '',
            'actors' => [],
            'countries' => [],
            'genres' => [],
            'producer' => false,
            'duration' => 169,
            'trailer' => false
        ], [
            'id' => 3,
            'name' => 'Улицы разбитых фонарей 17',
            'premiereDate' => '',
            'ageLimit' => '',
            'slogan' => '',
            'poster' => 'images/films/3.jpg',
            'description' => '',
            'actors' => [],
            'countries' => [],
            'genres' => [],
            'producer' => false,
            'duration' => 169,
            'trailer' => false
        ], [
            'id' => 4,
            'name' => 'Протрезвевшие',
            'premiereDate' => '',
            'ageLimit' => '',
            'slogan' => '',
            'poster' => 'images/films/4.jpg',
            'description' => '',
            'actors' => [],
            'countries' => [],
            'genres' => [],
            'producer' => false,
            'duration' => 169,
            'trailer' => false
        ], [
            'id' => 5,
            'name' => 'Люди Икс. Что-то на 2 строчки',
            'premiereDate' => '',
            'ageLimit' => '',
            'slogan' => '',
            'poster' => 'images/films/5.jpg',
            'description' => '',
            'actors' => [],
            'countries' => [],
            'genres' => [],
            'producer' => false,
            'duration' => 169,
            'trailer' => false
        ]
    ]
]);

Route::get('/', function () {
    return view('public.start.index', [
        'premierMovies' => [
            [
                'id' => 1,
                'name' => 'Большой и необрезанный',
                'premiereDate' => new DateTime('2019-09-21'),
                'ageLimit' => '18',
                'slogan' => 'Никогда не знаешь где есть конец',
                'poster' => 'images/slider/sample1.jpg'
            ], [
                'id' => 2,
                'name' => 'Приключения Тома и Фрица',
                'premiereDate' => new DateTime('2019-09-25'),
                'ageLimit' => '0',
                'slogan' => 'Друзья &mdash; они и в Африке опрокинут друг друга',
                'poster' => 'images/slider/sample2.jpg'
            ], [
                'id' => 2,
                'name' => 'Страх и ненависть в Три-Майл-Айленд',
                'premiereDate' => new DateTime('2019-09-28'),
                'ageLimit' => '12',
                'slogan' => 'Увлекательная история мадам Кюри',
                'poster' => 'images/slider/sample3.jpg'
            ]
        ],
        'showingMovies' => $GLOBALS['arMovies']
    ]);
})->name('public.start');

Route::get('/about', function () {
    return view('public.about.index', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ],
            [
                'url' => \route('public.about'),
                'title' => __('public.menu.about'),
            ]
        ],
        'cinemasList' => $GLOBALS['arCinemas']
    ]);
})->name('public.about');

Route::get('/movies', function () {
    return view('public.movies.index', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ],
            [
                'url' => \route('public.movies.showing'),
                'title' => __('public.menu.showing'),
            ]
        ],
        'showingMovies' => $GLOBALS['arMovies']
    ]);
})->name('public.movies.showing');

Route::get('/movies/archived', function () {
    return view('public');
})->name('public.movies.archived');

Route::get('/movies/soon', function () {
    return view('public');
})->name('public.movies.premier');

Route::get('/movies/view/{id}', function (int $id) {
    $found_key = array_search($id, array_column($GLOBALS['arMovies'], 'id'));
    if($found_key === false)
        abort(404);

    $item = $GLOBALS['arMovies'][$found_key];
    return view('public.movies.view', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ], [
                'url' => \route('public.movies.showing'),
                'title' => __('public.menu.showing'),
            ], [
                'url' => \route('public.movies.info', ['id' => $item['id']]),
                'title' => $item['name'],
            ]
        ],
        'item' => $item,
        'showingMovies' => [
            [
                'id' => 3,
                'name' => 'Улицы разбитых фонарей 17',
                'premiereDate' => '',
                'ageLimit' => '',
                'slogan' => '',
                'poster' => 'images/films/3.jpg',
                'description' => '',
                'actors' => [],
                'countries' => [],
                'genres' => [],
                'producer' => false,
                'duration' => 169,
                'trailer' => false
            ], [
                'id' => 4,
                'name' => 'Протрезвевшие',
                'premiereDate' => '',
                'ageLimit' => '',
                'slogan' => '',
                'poster' => 'images/films/4.jpg',
                'description' => '',
                'actors' => [],
                'countries' => [],
                'genres' => [],
                'producer' => false,
                'duration' => 169,
                'trailer' => false
            ], [
                'id' => 5,
                'name' => 'Люди Икс. Что-то на 2 строчки',
                'premiereDate' => '',
                'ageLimit' => '',
                'slogan' => '',
                'poster' => 'images/films/5.jpg',
                'description' => '',
                'actors' => [],
                'countries' => [],
                'genres' => [],
                'producer' => false,
                'duration' => 169,
                'trailer' => false
            ]
        ]
    ]);
})->where(['id' => '[0-9]+'])->name('public.movies.info');

Route::get('/movies/order/{id}', function (int $id) {
    $found_key = array_search($id, array_column($GLOBALS['arMovies'], 'id'));
    if($found_key === false)
        abort(404);

    $item = $GLOBALS['arMovies'][$found_key];

    $cinemas = $GLOBALS['arCinemas'];
    $format = 'Y-m-d H:i';

    return view('public.movies.order', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ], [
                'url' => \route('public.movies.showing'),
                'title' => __('public.menu.showing'),
            ], [
                'url' => \route('public.movies.info', ['id' => $item['id']]),
                'title' => $item['name'],
            ], [
                'url' => \route('public.movies.order', ['id' => $item['id']]),
                'title' => __('public.orderTicket'),
            ]
        ],
        'movie' => $item,
        'movieShowing' => [
            [
                'cinema' => $cinemas[0],
                'showings' => [
                    [
                        'id' => 12131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 09:40')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 11:30')
                    ], [
                        'id' => 12134,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 17:30')
                    ], [
                        'id' => 14131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 20:00')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 22:10')
                    ]
                ]
            ], [
                'cinema' => $cinemas[2],
                'showings' => [
                    [
                        'id' => 12131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 12:00')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 17:30')
                    ], [
                        'id' => 12134,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 21:20')
                    ]
                ]
            ], [
                'cinema' => $cinemas[4],
                'showings' => [
                    [
                        'id' => 12131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 09:40')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 11:30')
                    ], [
                        'id' => 12134,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 17:30')
                    ], [
                        'id' => 14131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 20:00')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 22:10')
                    ]
                ]
            ]
        ]
    ]);
})->where(['id' => '[0-9]+'])->name('public.movies.order');

Route::get('/cinemas', function () {
    return view('public.cinemas.index', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ],
            [
                'url' => \route('public.cinemas.index'),
                'title' => __('public.menu.cinemas'),
            ]
        ],
        'cinemasList' => $GLOBALS['arCinemas']
    ]);
})->name('public.cinemas.index');

Route::get('/cinemas/{id}', function (int $id) {
    $found_key = array_search($id, array_column($GLOBALS['arCinemas'], 'ID'));
    if($found_key === false)
        abort(404);

    $item = $GLOBALS['arCinemas'][$found_key];
    $movies = $GLOBALS['arMovies'];
    $format = 'Y-m-d H:i';

    return view('public.cinemas.item', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ], [
                'url' => \route('public.cinemas.index'),
                'title' => __('public.menu.cinemas'),
            ], [
                'url' => \route('public.cinemas.item', ['id' => $item['ID']]),
                'title' => $item['NAME'],
            ]
        ],
        'cinema' => $item,
        'movieShowing' => [
            [
                'movie' => $movies[0],
                'showings' => [
                    [
                        'id' => 12131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 09:40')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 11:30')
                    ], [
                        'id' => 12134,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 17:30')
                    ], [
                        'id' => 14131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 20:00')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 22:10')
                    ]
                ]
            ], [
                'movie' => $movies[2],
                'showings' => [
                    [
                        'id' => 12131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 12:00')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 17:30')
                    ], [
                        'id' => 12134,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 21:20')
                    ]
                ]
            ], [
                'movie' => $movies[4],
                'showings' => [
                    [
                        'id' => 12131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 09:40')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 11:30')
                    ], [
                        'id' => 12134,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 17:30')
                    ], [
                        'id' => 14131,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 20:00')
                    ], [
                        'id' => 12731,
                        'date' => DateTime::createFromFormat($format, '2019-09-15 22:10')
                    ]
                ]
            ]
        ]
    ]);
})->where(['id' => '[0-9]+'])->name('public.cinemas.item');

Route::get('/cinema/map_data', function () {
    return response()->json($GLOBALS['arCinemas']);
})->name('public.cinemas.json');

Route::get('/account', function () {
    return view('public.account.index', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ],
            [
                'url' => \route('public.account.index'),
                'title' => __('public.account.index'),
            ]
        ]
    ]);
})->name('public.account.index');

Route::get('/account/profile', function () {
    return view('public.account.profile');
})->name('public.account.profile');

Route::get('/account/order', function () {
    return view('public.account.order');
})->name('public.account.order');

Route::get('/account/ordered', function () {
    return view('public.account.ordered');
})->name('public.account.ordered');

Route::get('/account/register', function () {
    return view('public.account.register', [
        'breadCrumbs' => [
            [
                'url' => \route('public.start'),
                'title' => __('public.menu.home'),
            ],
            [
                'url' => \route('public.account.index'),
                'title' => __('public.account.index'),
            ],
            [
                'url' => \route('public.account.register'),
                'title' => __('public.account.register'),
            ]
        ]
    ]);
})->name('public.account.register');
