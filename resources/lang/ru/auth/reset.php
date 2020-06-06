<?php

return [
    'title' => 'Восстановление пароля',
    'form'  => [
        'email'  => [
            'label'       => 'E-mail',
            'placeholder' => 'Введите e-mail',
        ],
        'password' => [
            'label' => 'Пароль',
            'placeholder' => 'Введите пароль',
        ],
        'password_confirmation' => [
            'label' => 'Подтвердите пароль',
            'placeholder' => 'Введите пароль ещё раз',
        ],
        'submit' => 'Восстановить пароль',
        'auth'   => 'или <a href=":link">Войти</a>',
    ],
];
