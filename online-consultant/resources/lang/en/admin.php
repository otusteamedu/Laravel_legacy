<?php

return [
    
    /*
    |--------------------------------------------------------------------------
    | Admin Language Lines
    |--------------------------------------------------------------------------
    */
    
    'admin_panel_name' => 'Admin panel',
    
    /**
     * Admin pages
     */
    'pages'            => [
        'dashboard'    => 'Dashboard',
        'user_profile' => 'Profile'
    ],
    
    /**
     * Admin tables
     */
    'tables'           => [
        'columns' => [
            'actions'    => 'Actions',
            'created_at' => 'Created at'
        ]
    ],
    
    /**
     * Models
     */
    'models'           => [
        'controls' => [
            'edit'         => 'Edit',
            'delete'       => 'Delete',
            'save'         => 'Save',
            'restore'      => 'Restore',
            'force_delete' => 'Force delete'
        ]
    ],
    
    /**
     * Companies
     */
    'companies'        => [
        'model'  => [
            'single_name' => 'Company'
        ],
        'pages'  => [
            'index'  => [
                'title' => 'Companies'
            ],
            'create' => [
                'title' => 'Create company'
            ],
            'edit'   => [
                'title' => 'Edit company'
            ]
        ],
        'fields' => [
            'name'         => 'Name',
            'created_user' => 'Creator of company'
        ],
        'errors' => [
            'not_found' => 'Cannot found company by ID'
        ],
    ],
    
    /**
     * Leads
     */
    'leads'            => [
        'model'  => [
            'single_name' => 'Lead'
        ],
        'pages'  => [
            'index'  => [
                'title' => 'Leads'
            ],
            'create' => [
                'title' => 'Create lead'
            ],
            'edit'   => [
                'title' => 'Edit lead'
            ]
        ],
        'fields' => [
            'created_user' => 'Creator of lead'
        ],
        'errors' => [
            'not_found' => 'Cannot found lead by ID'
        ],
    ],
    
    /**
     * Widgets
     */
    'widgets'          => [
        'model'  => [
            'single_name' => 'Widget'
        ],
        'pages'  => [
            'index'  => [
                'title' => 'Widgets'
            ],
            'create' => [
                'title' => 'Create widget'
            ],
            'edit'   => [
                'title' => 'Edit widget'
            ]
        ],
        'fields' => [
            'created_user' => 'Creator of widget'
        ],
        'errors' => [
            'not_found' => 'Cannot found widget by ID'
        ],
    ],
    
    /**
     * Users
     */
    'users'            => [
        'model'  => [
            'single_name' => 'User'
        ],
        'pages'  => [
            'index'   => [
                'title' => 'Users'
            ],
            'create'  => [
                'title' => 'Create user'
            ],
            'edit'    => [
                'title' => 'Edit user'
            ],
            'profile' => [
                'title' => 'Profile'
            ]
        ],
        'errors' => [
            'not_found' => 'Cannot found user by ID'
        ],
    ],
    
    /**
     * Conversations
     */
    'conversations'    => [
        'model'  => [
            'single_name' => 'Conversation'
        ],
        'pages'  => [
            'index'  => [
                'title' => 'Conversations'
            ],
            'create' => [
                'title' => 'Create conversation'
            ],
            'edit'   => [
                'title' => 'Edit conversation'
            ]
        ],
        'errors' => [
            'not_found' => 'Cannot found conversation by ID'
        ],
    ],
    
    /**
     * Roles
     */
    'roles'            => [
        'model' => [
            'single_name' => 'Role',
            'plural_name' => 'Roles',
        ],
    ],

];
