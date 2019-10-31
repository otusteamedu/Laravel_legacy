<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */
    
    'failed'   => 'These credentials do not match our records.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    
    'policies' => [
        'common'        => [
            'not_allowed' => 'You are not allowed to view this page.',
        ],
        'users'         => [
            'view_any'     => 'You are not allowed to view list of users.',
            'create'       => 'You are not allowed to create users.',
            'update'       => 'You are not allowed to update users.',
            'delete'       => 'You are not allowed to delete users.',
            'restore'      => 'You are not allowed to restore users.',
            'force_delete' => 'You are not allowed to completely delete users.',
        ],
        'companies'     => [
            'view_any'     => 'You are not allowed to view list of companies.',
            'create'       => 'You are not allowed to create companies.',
            'update'       => 'You are not allowed to update companies.',
            'delete'       => 'You are not allowed to delete companies.',
            'restore'      => 'You are not allowed to restore companies.',
            'force_delete' => 'You are not allowed to completely delete companies.',
        ],
        'conversations' => [
            'view_any'     => 'You are not allowed to view list of conversations.',
            'create'       => 'You are not allowed to create conversations.',
            'update'       => 'You are not allowed to update conversations.',
            'delete'       => 'You are not allowed to delete conversations.',
            'restore'      => 'You are not allowed to restore conversations.',
            'force_delete' => 'You are not allowed to completely delete conversations.',
        ],
        'leads'         => [
            'view_any'     => 'You are not allowed to view list of leads.',
            'create'       => 'You are not allowed to create leads.',
            'update'       => 'You are not allowed to update leads.',
            'delete'       => 'You are not allowed to delete leads.',
            'restore'      => 'You are not allowed to restore leads.',
            'force_delete' => 'You are not allowed to completely delete leads.',
        ],
        'widgets'       => [
            'view_any'     => 'You are not allowed to view list of widgets.',
            'create'       => 'You are not allowed to create widgets.',
            'update'       => 'You are not allowed to update widgets.',
            'delete'       => 'You are not allowed to delete widgets.',
            'restore'      => 'You are not allowed to restore widgets.',
            'force_delete' => 'You are not allowed to completely delete widgets.',
        ],
    ],

];
