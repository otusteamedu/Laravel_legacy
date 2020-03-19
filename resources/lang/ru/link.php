<?php

return [
    'system' => [
        'label' => [
            'id' => 'Идентификатор',
            'type' => 'Тип меню',
            'name' => 'Название',
            'route_name' => 'Название маршрута',
            'disabled' => 'Флаг выключенного пункта',
        ],
        'create_page' => [
            'title' => 'Создать пункт меню',
            'submit_button' => 'Создать',
        ],
        'list_page' => [
            'actions' => 'Действия',
            'create_nav_button' => 'Создать',
            'no_items' => 'Нет ни одной записи',
        ],
        'show_page' => [
            'edit_nav_button' => 'Редактировать',
        ],
        'edit_page' => [
            'title' => 'Редактировать пункт меню',
            'submit_button' => 'Сохранить',
        ],
        'back_nav_button' => 'Вернуться в список',
        'delete_button' => 'Удалить',
        'action_result' => [
            'destroy' => 'Запись :id успешно удалена',
            'create' => 'Запись :id успешно создана',
            'update' => 'Запись :id успешно обновлена',
        ],
    ],
];
