@extends('layouts.app')

@section('title', 'Page Title ')


@section('content')
    {{ Form::open(['url' => route('admin.handbooks.store')]) }}

    <div class="form-group">

        {{Form::label('name', 'Имя')}}
        {{Form::text('name', null, ['class' => 'form-control'])}}
    </div>
    <div class="form-group">

        {{Form::label('description', 'Описание')}}
        {{Form::text('description', null, ['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
