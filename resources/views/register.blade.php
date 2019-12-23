@extends('layouts.inner')

@section('title', __('messages.page.register'))
@section('h1', __('messages.page.register'))

<?php
$countries = [
    '1' => 'Беларусь',
    '2' => 'Россия'
];
$cities = [
    'minsk' => 'Минск', 'grodno' => 'Гродно',
];
?>
@section('content')
    <div class="row justify-content-md-center">
        <div class="col-xs-12 col-md-6">
            @include('blocks.forms.default', [
                'submit_text' => __('messages.register'),
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
                    [
                        'name' => 'password',
                        'label' => 'Пароль',
                        'class' => 'form-control',
                        'type' => 'password',
                        'require' => true,
                    ],
                ],
                'values' => [],
            ])
        </div>
    </div>
@endsection