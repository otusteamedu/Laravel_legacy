<?php

return [

    /*
    |--------------------------------------------------------------------------
    | View Storage Paths
    |--------------------------------------------------------------------------
    |
    | Most templating systems load templates from disk. Here you may specify
    | an array of paths that should be checked for your views. Of course
    | the usual Laravel view path has already been registered for you.
    |
    */

    'paths' => [
        resource_path('views'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Compiled View Path
    |--------------------------------------------------------------------------
    |
    | This option determines where all the compiled Blade templates will be
    | stored for your application. Typically, this is within the storage
    | directory. However, as usual, you are free to change this value.
    |
    */

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

    'cms' => [
        'index' => 'cms.index.index',

        'countries' => [
            'index' =>'cms.countries.index',
            'show' => 'cms.countries.show',
            'edit' => 'cms.countries.edit',
            'create' => 'cms.countries.create',
        ],
        'cities' => [
            'index' =>'cms.cities.index',
            'show' => 'cms.cities.show',
            'edit' => 'cms.cities.edit',
            'create' => 'cms.cities.create',
        ],
        'tariffs' => [
            'index' =>'cms.tariffs.index',
            'show' => 'cms.tariffs.show',
            'edit' => 'cms.tariffs.edit',
            'create' => 'cms.tariffs.create',
        ],
        'segments' => [
            'index' =>'cms.segments.index',
            'show' => 'cms.segments.show',
            'edit' => 'cms.segments.edit',
            'create' => 'cms.segments.create',
        ],
        'users' => [
            'index' =>'cms.users.index',
            'show' => 'cms.users.show',
            'edit' => 'cms.users.edit',
            'create' => 'cms.users.create',
        ],
        'categories' => [
            'index' =>'cms.categories.index',
            'show' => 'cms.categories.show',
            'edit' => 'cms.categories.edit',
            'create' => 'cms.categories.create',
        ],
        'projects' => [
            'index' =>'cms.projects.index',
            'show' => 'cms.projects.show',
            'edit' => 'cms.projects.edit',
            'create' => 'cms.projects.create',
        ],
        'offers' => [
            'index' =>'cms.offers.index',
            'show' => 'cms.offers.show',
            'edit' => 'cms.offers.edit',
            'create' => 'cms.offers.create',
        ],
    ],
];
