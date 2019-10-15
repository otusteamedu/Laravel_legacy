@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Handbook $handbook */?>
@section('content')
    {{ Form::open(
            [
                'url' => route('admin.handbooks.update', ['handbook' => $handbook]),
                'method' => 'PUT'
            ]
         )
    }}

    <div class="form-group">

        {{Form::label('name', 'Имя')}}
        {{Form::text('name', $handbook->name, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('description', 'Описание')}}
        {{Form::text('description', $handbook->description, ['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
