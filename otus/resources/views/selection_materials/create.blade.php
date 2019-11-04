@extends('layouts.app')

@section('title', 'Page Title ')


@section('content')
    {{ Form::open(['url' => route('admin.selection-materials.store')]) }}

    <div class="form-group">

        {{Form::label('name', 'Имя')}}
        {{Form::text('name', null, ['class' => 'form-control'])}}
    </div>

    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
