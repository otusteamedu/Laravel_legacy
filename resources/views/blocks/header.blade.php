<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>@yield('title') · <?=__('messages.app_name')?></title>
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>
<header>
    @include('blocks.navbar.index',[
    'links' => [
        [
            'name' => __('messages.page.profile'),
            'link' => route('profile'),
        ],
        [
            'name' => __('messages.page.register'),
            'link' => route('register'),
        ],
        [
            'name' => __('messages.page.about'),
            'link' => route('about'),
        ],
    ],
    'countries' => [
        [
        'id' => 1,
        'name' => 'Беларусь',
        'active' => true,
        ],
        [
        'id' => 2,
        'name' => 'Россия',
        'active' => false,
        ],
    ],
    'cities' => [
        [
        'id' => 1,
        'name' => 'Минск',
        'active' => true,
        ],
        [
        'id' => 2,
        'name' => 'Брест',
        'active' => false,
        ],
        [
        'id' => 3,
        'name' => 'Гомель',
        'active' => false,
        ],
        [
        'id' => 4,
        'name' => 'Могилев',
        'active' => false,
        ],
        [
        'id' => 5,
        'name' => 'Гродно',
        'active' => false,
        ],
        [
        'id' => 6,
        'name' => 'Витебск',
        'active' => false,
        ],
    ],
    ])
</header>

