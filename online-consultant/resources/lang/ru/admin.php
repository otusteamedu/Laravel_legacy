<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Языковые ресурсы админской части приложения
    |--------------------------------------------------------------------------
    */
    
    'admin_panel_name' => 'Панель управления',
    
    /**
     * Admin pages
     */
    'pages'            => [
        'dashboard'    => 'Главная панель',
        'user_profile' => 'Профиль'
    ],
    
    /**
     * Admin tables
     */
    'tables'           => [
        'columns' => [
            'actions'    => 'Действия',
            'created_at' => 'Дата создания'
        ]
    ],
    
    /**
     * Models
     */
    'models'           => [
        'controls' => [
            'edit'         => 'Редактировать',
            'delete'       => 'Удалить',
            'save'         => 'Сохранить',
            'restore'      => 'Восстановить',
            'force_delete' => 'Удалить навсегда'
        ]
    ],
    
    /**
     * Companies
     */
    'companies'        => [
        'model'  => [
            'single_name' => 'Компания'
        ],
        'pages'  => [
            'index'  => [
                'title' => 'Компании'
            ],
            'create' => [
                'title' => 'Создать компанию'
            ],
            'edit'   => [
                'title' => 'Редактировать компанию'
            ],
        ],
        'fields' => [
            'name'         => 'Название',
            'created_user' => 'Создатель компании'
        ],
        'errors' => [
            'not_found' => 'Не получилось найти компанию по ID'
        ],
    ],
    
    /**
     * Leads
     */
    'leads'            => [
        'model'  => [
            'single_name' => 'Лид'
        ],
        'pages'  => [
            'index'  => [
                'title' => 'Лиды'
            ],
            'create' => [
                'title' => 'Создать лида'
            ],
            'edit'   => [
                'title' => 'Редактировать лида'
            ]
        ],
        'fields' => [
            'created_user' => 'Создатель лида'
        ],
        'errors' => [
            'not_found' => 'Не получилось найти лида по ID'
        ],
    ],
    
    /**
     * Widgets
     */
    'widgets'          => [
        'model'  => [
            'single_name' => 'Виджет'
        ],
        'pages'  => [
            'index'  => [
                'title' => 'Виджеты'
            ],
            'create' => [
                'title' => 'Создать виджет'
            ],
            'edit'   => [
                'title' => 'Редактировать виджет'
            ]
        ],
        'fields' => [
            'created_user' => 'Создатель виджета'
        ],
        'errors' => [
            'not_found' => 'Не получилось найти виджет по ID'
        ],
    ],
    
    /**
     * Users
     */
    'users'            => [
        'model'  => [
            'single_name' => 'Пользователь'
        ],
        'pages'  => [
            'index'   => [
                'title' => 'Пользователи'
            ],
            'create'  => [
                'title' => 'Создать пользователя'
            ],
            'edit'    => [
                'title' => 'Редактировать пользователя'
            ],
            'profile' => [
                'title' => 'Профиль'
            ]
        ],
        'errors' => [
            'not_found' => 'Не получилось найти пользователя по ID'
        ],
    ],
    
    /**
     * Conversations
     */
    'conversations'    => [
        'model'  => [
            'single_name' => 'Беседа'
        ],
        'pages'  => [
            'index'  => [
                'title' => 'Беседы'
            ],
            'create' => [
                'title' => 'Создать беседу'
            ],
            'edit'   => [
                'title' => 'Редактировать беседу'
            ]
        ],
        'errors' => [
            'not_found' => 'Не получилось найти беседу по ID'
        ],
    ],
    
    /**
     * Roles
     */
    'roles'            => [
        'model' => [
            'single_name' => 'Роль',
            'plural_name' => 'Роли',
        ],
    ],

];
