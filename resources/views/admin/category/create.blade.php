@extends('admin.layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{__('dashboard.category.add')}}</h1>
    </div>
{!! Form::open(['url' => route('admin.category.store',['locale'=>app()->getLocale()])]) !!}
    <div class="form-group">
        {{ Form::label('name', __('dashboard.category.name')) }}
        {{ Form::text('name', null, array('class'=>'form-control','placeholder'=>'123213','id'=>'name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', __('dashboard.description')) }}
        {{ Form::text('description', null, array('class'=>'form-control','placeholder'=>'text...','id'=>'description')) }}
    </div>
    {{ Form::submit(__('dashboard.add'), array('class' => 'btn btn-primary')) }}
{!! Form::close() !!}
@endsection
