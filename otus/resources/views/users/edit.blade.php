@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\User $user */?>


<?php

$roles = [
    App\Models\User::ADMIN_ROLE => 'Администратор',
    App\Models\User::EDITOR_ROLE => 'Редактор',
    null => 'Простой пользователь',
];
?>

@section('content')
    {{ Form::open(
            [
                'url' => route('admin.users.update', ['user' => $user]),
                'method' => 'PUT'
            ]
         )
    }}

    <div class="form-group">

        {{Form::label('name', 'Имя')}}
        {{Form::text('name', $user->name, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('email', 'Email')}}
        {{Form::text('email', $user->email, ['class' => 'form-control'])}}
    </div>

<!--    --><?php //if($user->isAdmin()):?>
        <div class="form-group">
            {{Form::label('role', 'Роль')}}
            {{Form::select('role', $roles, $user->role,['class' => 'form-control'])}}
        </div>
<!--    --><?php //endif?>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
