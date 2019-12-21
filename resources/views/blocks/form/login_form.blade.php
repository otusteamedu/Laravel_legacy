@extends('layouts.blocks.form')

@section('form_content')
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
    @include('blocks.form.login_controls', ['submit_name' => 'Войти'])
    <div class="tm-login__footer uk-inline uk-margin uk-margin-medium-top">
        @include('blocks.form.login_link', ['url' => '/registration', 'value' => 'Еще нет аккаунта?'])
        @include('blocks.form.login_link', ['url' => '/reset-password', 'value' => 'Забыли пароль?'])
    </div>
@endsection
