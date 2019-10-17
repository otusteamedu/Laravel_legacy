<?php
return [
    'users' => [
        'level' => [
            \App\Models\User::LEVEL_USER => 'user',
            \App\Models\User::LEVEL_MODERATOR => 'moderator',
            \App\Models\User::LEVEL_ADMIN => 'admin',
        ],
    ],
];