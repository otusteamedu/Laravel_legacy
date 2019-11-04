@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\User $user */?>
@section('content')
    {{ Form::open(
            [
                'url' => route('admin.categories.update', ['category' => $category]),
                'method' => 'PUT'
            ]
         )
    }}

    <div class="form-group">

        {{Form::label('name', 'Название')}}
        {{Form::text('name', $category->name, ['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
