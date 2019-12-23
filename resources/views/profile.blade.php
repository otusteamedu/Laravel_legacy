@extends('layouts.inner')

@section('title', __('messages.page.profile'))
@section('h1', __('messages.page.profile'))

<?php
$countries = [
    '1' => 'Беларусь',
    '2' => 'Россия'
];
$cities = [
    '1' => 'Минск', '2' => 'Гродно',
];
?>
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-xs-12 col-md-6">
            @include('blocks.forms.default', [
                'submit_text' => __('messages.edit'),
                'fields' => [
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
                        'options' => $countries,
                        'type' => 'select',
                        'require' => true,
                    ],
                    [
                        'name' => 'city',
                        'label' => 'Город',
                        'class' => 'form-control',
                        'options' => $cities,
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
                'values' => [
                    'name' => 'Имя Фамилия',
                    'email' => 'test@test.test',
                    'country' => '1',
                    'city' => '2',
                    'avatar' => '/img/5.jpg',
                ],
            ])
        </div>
    </div>
@endsection