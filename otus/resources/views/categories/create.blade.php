@extends('layouts.app')

@section('title', 'Page Title ')


@section('content')
    {{ Form::open(
    [
        'url' => route('admin.categories.store'),
        'files'=>true
    ]
    ) }}

    <div class="form-group">

        {{Form::label('name', 'Название')}}
        {{Form::text('name', null, ['class' => 'form-control'])}}
    </div>

    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
