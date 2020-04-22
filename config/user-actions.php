<?php

return [
    'default-value-if-null' => false,

    \App\Models\User::LEVEL_ADMIN => [
        'view-cms' => true,

        'view-country' => true,
        'view-city' => true,
        'view-user' => true,
        'view-tariff' => true,
        'view-segment' => true,
        'view-category' => true,
        'view-project' => true,
        'view-offer' => true,

        'create-country' => true,
        'create-city' => true,
        'create-user' => true,
        'create-tariff' => true,
        'create-segment' => true,
        'create-category' => true,
        'create-project' => true,
        'create-offer' => true,

        'update-country' => true,
        'update-city' => true,
        'update-user' => true,
        'update-tariff' => true,
        'update-segment' => true,
        'update-category' => true,
        'update-project' => true,
        'update-offer' => true,

        'delete-country' => true,
        'delete-city' => true,
        'delete-user' => true,
        'delete-tariff' => true,
        'delete-segment' => true,
        'delete-category' => true,
        'delete-project' => true,
        'delete-offer' => true,

    ],
    \App\Models\User::LEVEL_MARKETING => [
        'view-cms' => true,
        'create-tariff' => true,
        'create-segment' => true,
        'create-category' => true,
        'create-project' => true,
        'create-offer' => true,

        'update-tariff' => true,
        'update-segment' => true,
        'update-category' => true,
        'update-project' => true,
        'update-offer' => true,

        'delete-tariff' => true,
        'delete-segment' => true,
        'delete-category' => true,
        'delete-project' => true,
        'delete-offer' => true,
    ],
    'user' => [

    ],
];
