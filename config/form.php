<?php
return [
    'city' => [
        [
            'name' => 'name',
            'label' => 'Название',
            'class' => 'form-control',
            'type' => 'text',
            'require' => true,
        ],
        [
            'postfix' => 'id',
            'name' => 'country',
            'label' => 'Страна',
            'class' => 'form-control',
            'options_in' => 'countries',
            'type' => 'select',
            'require' => true,
        ],
    ],
    'country' => [
        [
            'name' => 'name',
            'label' => 'Название',
            'class' => 'form-control',
            'type' => 'text',
            'require' => true,
        ],
    ],
    'profile' => [
        [
            'name' => 'name',
            'label' => 'Имя',
            'class' => 'form-control',
            'type' => 'text',
            'require' => true,
        ],
        [
            'name' => 'email',
            'label' => 'E-mail',
            'class' => 'form-control',
            'type' => 'email',
            'require' => true,
        ],
        [
            'name' => 'country',
            'label' => 'Страна',
            'class' => 'form-control',
            'options_in' => 'countries',
//            'options' => $countries,
            'type' => 'select',
            'require' => true,
        ],
        [
            'name' => 'city',
            'label' => 'Город',
            'class' => 'form-control',
            'options_in' => 'cities',
//            'options' => $cities,
            'type' => 'select',
            'require' => true,
        ],
        [
            'name' => 'avatar',
            'label' => 'Аватар',
            'class' => '',
            'type' => 'file',
            'require' => false,
        ],
    ],
];