@extends('admin.layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Add category product</h1>
    </div>
{!! Form::open(['url' => route('admin.category.store')]) !!}
    <div class="form-group">
        {{ Form::label('name', 'Category name') }}
        {{ Form::text('name', null, array('class'=>'form-control','placeholder'=>'123213','id'=>'name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', null, array('class'=>'form-control','placeholder'=>'text...','id'=>'description')) }}
    </div>
    {{ Form::submit('Добавить', array('class' => 'btn btn-primary')) }}
{!! Form::close() !!}
@endsection
