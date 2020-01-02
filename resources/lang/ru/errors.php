<?php

return [
    'required' => 'Поле ":field" обязательно для заполнения :attribute',
    'movies' => [
    ],
    'users' => [
    ],
    'tickets' => [
        'invalidplace' => 'Неверное место для бронирования, возможно объект удален',
        'invalidshowing' => 'Неверно задан сеанс, возможно объект был удален',
        'released' => 'Билет уже куплен',
        'createTicket' => 'Ошибка получения билета на :row ряд :place место'
    ],
    'showings' => [
        'expired' => 'Указанный сеанс просрочен'
    ],
    'orders' => [
        'addproduct' => 'Невозможно добавить к заказу ":name"',
        'productNo' => '":name" нет в заказе',
        'itemNo' => 'Позиция :itemid не найдена в заказе :orderid',
        'place_access' => 'Авторизуйтесь, чтобы сделать заказ',
        'order_empty' => 'Заказ пуст',
        'item_not_available' => '":name" не доступен для покупки'
    ]
];
