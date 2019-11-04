@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\User $user */?>
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


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
