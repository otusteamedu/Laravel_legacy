@extends('layouts.blocks.form')

@section('form_content')
    @include('blocks.form.input_large', [
        'type' => 'email',
        'icon' => 'mail',
        'name' => 'email',
        'attributes' => ['placeholder' => 'Email']
    ])
    @include('blocks.form.login_controls', ['submit_name' => 'Сбросить пароль'])
@endsection
