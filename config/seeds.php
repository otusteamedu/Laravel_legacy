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
    ],
    'seeds_uploads_path' => 'seed_data/images',
    'seeds_path' => 'storage/uploads/seed_images/',
    'categories' => [
        'topics' => [
            [
                'type' => 'topics',
                'title' => 'Природа',
                'alias' => 'nature',
                'description' => 'Изображения природы',
                'keywords' => 'природа, nature',
                'publish' => 1
            ],
            [
                'type' => 'topics',
                'title' => 'Мегаполис',
                'alias' => 'megapolice',
                'description' => 'Изображения крупных городов (мегаполисов)',
                'keywords' => 'megapolice, мегаполис, небоскреб, большой город',
                'publish' => 1
            ],
            [
                'type' => 'topics',
                'title' => 'Абстракция',
                'alias' => 'abstraction',
                'description' => 'Изображения с абстракцией',
                'keywords' => 'абстракция, abstraction',
                'publish' => 1
            ],
            [
                'type' => 'topics',
                'title' => 'Улочки, скверы, арки',
                'alias' => 'streets-squares-arches',
                'description' => 'Изображения улочек, скверов, арок',
                'keywords' => 'улочки, скверы, арки',
                'publish' => 1
            ],
            [
                'type' => 'topics',
                'title' => 'Море',
                'alias' => 'sea',
                'description' => 'Изображения с видом моря',
                'keywords' => 'море, пляж, sea, beach, long beach, seaside',
                'publish' => 1
            ],
            [
                'type' => 'topics',
                'title' => 'Космос',
                'alias' => 'space',
                'description' => 'Изображения космоса',
                'keywords' => 'космос, звездное небо, space',
                'publish' => 1
            ]
        ],
        'colors' => [
            [
                'type' => 'colors',
                'title' => 'Белый',
                'alias' => 'white',
                'description' => 'Изображения преимущественно белого цвета',
                'keywords' => 'белый, white',
                'publish' => 1
            ],
            [
                'type' => 'colors',
                'title' => 'Черный',
                'alias' => 'black',
                'description' => 'Изображения преимущественно черного цвета',
                'keywords' => 'черный, black',
                'publish' => 1
            ],
            [
                'type' => 'colors',
                'title' => 'Красный',
                'alias' => 'tomato',
                'description' => 'Изображения преимущественно красного цвета',
                'keywords' => 'красный, red',
                'publish' => 1
            ],
            [
                'type' => 'colors',
                'title' => 'Зеленый',
                'alias' => 'limegreen',
                'description' => 'Изображения преимущественно зеленого цвета',
                'keywords' => 'зеленый, green',
                'publish' => 1
            ],
            [
                'type' => 'colors',
                'title' => 'Синий',
                'alias' => 'dodgerblue',
                'description' => 'Изображения преимущественно синего цвета',
                'keywords' => 'синий, blue, голубой',
                'publish' => 1
            ],
            [
                'type' => 'colors',
                'title' => 'Фиолетовый',
                'alias' => 'darkviolet',
                'description' => 'Изображения преимущественно фиолетового цвета',
                'keywords' => 'фиолетовый, violet',
                'publish' => 1
            ]
        ],
        'interiors' => [
            [
                'type' => 'interiors',
                'title' => 'Гостиная',
                'alias' => 'living-room',
                'description' => 'Изображения для гостиной',
                'keywords' => 'гостиная, living room',
                'publish' => 1
            ],
            [
                'type' => 'interiors',
                'title' => 'Спальня',
                'alias' => 'bad-room',
                'description' => 'Изображения для спальной',
                'keywords' => 'спальня, bad room',
                'publish' => 1
            ],
            [
                'type' => 'interiors',
                'title' => 'Кухня',
                'alias' => 'kitchen',
                'description' => 'Изображения для кухни',
                'keywords' => 'кухня, kitchen',
                'publish' => 1
            ],
            [
                'type' => 'interiors',
                'title' => 'Детская',
                'alias' => 'child-room',
                'description' => 'Изображения для детской',
                'keywords' => 'детская, child room',
                'publish' => 1
            ],
            [
                'type' => 'interiors',
                'title' => 'Прихожая',
                'alias' => 'hallway',
                'description' => 'Изображения для коридора',
                'keywords' => 'прихожая, hallway',
                'publish' => 1
            ],
            [
                'type' => 'interiors',
                'title' => 'Офис',
                'alias' => 'office',
                'description' => 'Изображения для офиса',
                'keywords' => 'офис, office',
                'publish' => 1
            ]
        ]
    ]
];
