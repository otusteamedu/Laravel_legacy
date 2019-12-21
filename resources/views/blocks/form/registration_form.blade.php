@extends('layouts.blocks.form')

@section('form_content')
    @include('blocks.form.input_large', [
        'type' => 'text',
        'icon' => 'user',
        'name' => 'name',
        'attributes' => ['placeholder' => 'Имя']
    ])
    @include('blocks.form.input_large', [
        'type' => 'email',
        'icon' => 'mail',
        'name' => 'email',
        'attributes' => ['placeholder' => 'Email']
    ])
    @include('blocks.form.input_password_large', [
        'name' => 'password',
        'attributes' => ['placeholder' => 'Пароль']
    ])
    @include('blocks.form.input_password_large', [
        'name' => 'password_confirmation',
        'attributes' => ['placeholder' => 'Подтверждение пароля']
    ])
    @include('blocks.form.login_controls', ['submit_name' => 'Зарегистрироваться'])
    <div class="tm-login__footer uk-inline uk-margin uk-margin-medium-top">
        @include('blocks.form.login_link', ['url' => '/login', 'value' => 'Уже есть аккаунт?'])
    </div>
@endsection
