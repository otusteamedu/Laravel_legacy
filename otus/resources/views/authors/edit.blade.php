@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Author $author */?>
@section('content')
    {{ Form::open(
            [
                'url' => route('admin.authors.update', ['author' => $author]),
                'method' => 'PUT'
            ]
         )
    }}

    <div class="form-group">

        {{Form::label('name', 'Имя')}}
        {{Form::text('name', $author->name, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('surname', 'Фамилия')}}
        {{Form::text('surname', $author->surname, ['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
