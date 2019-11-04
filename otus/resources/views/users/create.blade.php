@extends('layouts.app')

@section('title', 'Page Title ')


@section('content')
    {{ Form::open(
    [
        'url' => route('admin.users.store'),
        'files'=>true
    ]
    ) }}

    <div class="form-group">

        {{Form::label('name', 'Имя')}}
        {{Form::text('name', null, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">

        {{Form::label('email', 'Email')}}
        {{Form::text('email', null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('photo', 'Фотография')}}
        {{Form::file('photo', null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('password', 'Пароль')}}
        {{Form::text('password', null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('password_confirm', 'Подтверждение пароля')}}
        {{Form::text('password_confirm', null, ['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
