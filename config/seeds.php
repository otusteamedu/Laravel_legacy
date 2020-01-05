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
        '1' => [
            'title' => 'Самовывоз',
            'cost' => 0,
            'publish' => 1,
            'description' => 'г. Брянск'
        ],
        '2' => [
            'title' => 'Транспортная компания',
            'cost' => 700,
            'publish' => 1,
            'description' => 'до пункта самовывоза в Вашем регионе'
        ],
        '3' => [
            'title' => 'Курьер',
            'cost' => 900,
            'publish' => 1,
            'description' => 'до двери'
        ]
    ],
    'order_statuses' => [
        '1' => [
            'title' => 'В корзине',
            'description' => 'Заказ ожидает оформления'
        ],
        '2' => [
            'title' => 'В обработке',
            'description' => 'Заказ создан и ожидает обработки администратора'
        ],
        '3' => [
            'title' => 'Ожидает оплаты',
            'description' => 'Заказ обработан администратором и ожидает оплаты'
        ],
        '4' => [
            'title' => 'Отправлен',
            'description' => 'Заказ отправлен покупателю'
        ],
        '5' => [
            'title' => 'Выполнен',
            'description' => 'Заказ передан покупателю'
        ],
        '6' => [
            'title' => 'Отменен',
            'description' => 'Заказ отменен'
        ]
    ],
//    'order_item' => [
//        '1' => [
//            'order_id' => 1,
//            'image_id' => 1,
//            'texture_id' => 1,
//            'width' => 350,
//            'height' => 270,
//            'cost' => 7500
//        ],
//        '2' => [
//            'order_id' => 1,
//            'image_id' => 2,
//            'texture_id' => 1,
//            'width' => 300,
//            'height' => 250,
//            'cost' => 7000
//        ],
//        '3' => [
//            'order_id' => 2,
//            'image_id' => 3,
//            'texture_id' => 3,
//            'width' => 250,
//            'height' => 250,
//            'cost' => 5500
//        ],
//        '4' => [
//            'order_id' => 3,
//            'image_id' => 4,
//            'texture_id' => 2,
//            'width' => 400,
//            'height' => 250,
//            'cost' => 9500
//        ]
//    ],
//    'orders' => [
//        '1' => [
//            'number' => '201001',
//            'user_id' => 5,
//            'price' => 14500,
//            'address' => '',
//            'delivery' => 1,
//            'user_message' => 'Жду мой заказ с нетерпением!',
//            'status_id' => 1
//        ],
//        '2' => [
//            'number' => '201002',
//            'user_id' => 6,
//            'price' => 5500,
//            'address' => 2,
//            'delivery' => 1,
//            'user_message' => 'Жду мой заказ с нетерпением!',
//            'status_id' => 1
//        ],
//        '3' => [
//            'number' => '201003',
//            'user_id' => 7,
//            'price' => 9500,
//            'address' => 1,
//            'delivery' => 1,
//            'user_message' => 'Жду мой заказ с нетерпением!',
//            'status_id' => 1
//        ]
//    ]
];
