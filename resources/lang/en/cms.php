<?php
/**
 * Description of cms.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Egor Gerasimchuk <egor@mister.am>
 */

return [
    'users' => [
        'level' => [
            \App\Models\User::LEVEL_USER => 'User',
            \App\Models\User::LEVEL_MODERATOR => 'Moderator',
            \App\Models\User::LEVEL_ADMIN => 'Admin',
        ]
    ]
];