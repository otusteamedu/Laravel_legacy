<?php

return [
    'default-value-if-null' => false,

    \App\Models\User::LEVEL_ADMIN => [
        'cms' => [
            'view' => true,

            'country' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'city' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'user' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'tariff' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'segment' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'category' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'project' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'offer' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
        ],
    ],

    \App\Models\User::LEVEL_MARKETING => [

        'cms' => [
            'view' => true,

            'tariff' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'segment' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'category' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'project' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'offer' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
        ],
    ],
    \App\Models\User::LEVEL_USER => [
        'cms' => [
            'view' => true,

            'project' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
            'offer' => [
                'view' => true,
                'create' => true,
                'update' => true,
                'delete' => true,
            ],
        ],
    ],
];
