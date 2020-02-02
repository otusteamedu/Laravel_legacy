<?php

return [
    'formats' => [
        '1' => [
            'title' => 'Портрет',
            'alias' => 'portrait',
            'icon' => 'crop_portrait',
            'min' => 0.1,
            'max' => 0.8
        ],
        '2' => [
            'title' => 'Альбом',
            'alias' => 'landscape',
            'icon' => 'crop_landscape',
            'min' => 1.2,
            'max' => 1.9
        ],
        '3' => [
            'title' => 'Квадрат',
            'alias' => 'square',
            'icon' => 'crop_square',
            'min' => 0.8,
            'max' => 1.2
        ],
        '4' => [
            'title' => 'Панорама',
            'alias' => 'panorama',
            'icon' => 'crop_7_5',
            'min' => 1.9,
            'max' => 9.9
        ]
    ],
//    'roles' => [
//        'default_role' => 'user'
//    ],
    'deliveries' => [
        [
            'title' => 'Самовывоз',
            'cost' => 0,
            'publish' => 1,
            'description' => 'г. Брянск'
        ],
        [
            'title' => 'Транспортная компания',
            'cost' => 800,
            'publish' => 1,
            'description' => 'до пункта самовывоза'
        ],
        [
            'title' => 'Курьер',
            'cost' => 900,
            'publish' => 1,
            'description' => 'до двери'
        ]
    ],
    'setting_groups' => [
        [
            'title' => 'Основные',
            'description' => 'Основные настройки сайта'
        ],
        [
            'title' => 'Контакты',
            'description' => 'Телефон, email, адрес, социальные сети'
        ],
        [
            'title' => 'Изображения',
            'description' => 'Изображения для оформления сайта'
        ]
    ],
    'settings' => [
        [
            'display_name' => 'Название сайта',
            'key_name' => 'site_name',
            'type' => 'text',
            'group_id' => 1
        ],
        [
            'display_name' => 'Название компании',
            'key_name' => 'company_name',
            'type' => 'text',
            'group_id' => 1
        ],
        [
            'display_name' => 'Основной телефон',
            'key_name' => 'company_phone',
            'type' => 'text',
            'group_id' => 2
        ],
        [
            'display_name' => 'Email',
            'key_name' => 'company_email',
            'type' => 'text',
            'group_id' => 2
        ],
        [
            'display_name' => 'Адрес',
            'key_name' => 'company_address',
            'type' => 'text',
            'group_id' => 2
        ],
        [
            'display_name' => 'Аккаунт группы VK',
            'key_name' => 'vk_account',
            'type' => 'text',
            'group_id' => 2
        ],
        [
            'display_name' => 'Аккаунт группы Facebook',
            'key_name' => 'facebook_account',
            'type' => 'text',
            'group_id' => 2
        ],
        [
            'display_name' => 'Аккаунт группы Instagram',
            'key_name' => 'instagram_account',
            'type' => 'text',
            'group_id' => 2
        ],
        [
            'display_name' => 'Изображение 1',
            'key_name' => 'image_1',
            'type' => 'file',
            'group_id' => 3
        ],
        [
            'display_name' => 'Изображение 2',
            'key_name' => 'image_2',
            'type' => 'file',
            'group_id' => 3
        ],
        [
            'display_name' => 'Изображение 3',
            'key_name' => 'image_3',
            'type' => 'file',
            'group_id' => 3
        ],
        [
            'display_name' => 'Изображение 4',
            'key_name' => 'image_4',
            'type' => 'file',
            'group_id' => 3
        ],
        [
            'display_name' => 'Изображение 5',
            'key_name' => 'image_5',
            'type' => 'file',
            'group_id' => 3
        ],
        [
            'display_name' => 'Изображение 6',
            'key_name' => 'image_6',
            'type' => 'file',
            'group_id' => 3
        ]
    ],
    'owners' => [
        [
            'title' => 'Shutterstock',
            'description' => 'https://shutterstock.com/ru/',
            'publish' => 1
        ],
        [
            'title' => 'Depositphotos',
            'description' => 'https://ru.depositphotos.com/',
            'publish' => 1
        ],
        [
            'title' => 'Эдуард',
            'description' => '',
            'publish' => 1
        ],
    ],
    'tags' => [
        [
            'title' => 'Праздники',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Машинки',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Мультики',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Мстители',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Железный человек',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Халк',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Звездные войны',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Дарт Вейдер',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Чубака',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Футбол',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Месси',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Роналду',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Леброн Джеймс',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Баскетбол',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Майкл Джордан',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Стефен Карри',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Формула 1',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Ferrari',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Lamborghini',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Aston Martin',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Mercedes Benz',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'BMV',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'Audi',
            'description' => '',
            'publish' => 1
        ],
        [
            'title' => 'McLaren',
            'description' => '',
            'publish' => 1
        ]
    ]
];
