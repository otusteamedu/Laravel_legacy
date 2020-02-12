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
    @include('admin.blocks.navbar.index',[
    'links' => [
        [
            'name' => __('admin.countries.index'),
            'link' => route('admin.countries.index'),
        ],
        [
            'name' => __('admin.cities.index'),
            'link' => route('admin.cities.index'),
        ],
    ],
    ])
</header>

