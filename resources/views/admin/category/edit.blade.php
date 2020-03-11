@extends('admin.layout')
@section('content')

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">{{__('dashboard.edit')}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                {{Form::open(['method'  => 'DELETE', 'route' => ['admin.category.destroy', 'category'=>$category->id,'locale'=>app()->getLocale()]])}}
{{--                <a class="btn btn-md btn-outline-secondary" href="{{ route('admin.category.destroy',[$category->id])}}" role="button">Delete</a>--}}
                    {{Form::submit(__('dashboard.delete'), array('class' => 'btn btn-md btn-outline-secondary')) }}
                {{Form::close()}}
            </div>
        </div>
    </div>
    {{Form::model($category,['method'=>'PUT','route'=>['admin.category.update','category'=>$category,'locale'=>app()->getLocale()]])}}
    <div class="form-group">
        {{ Form::label('name', __('dashboard.category.name')) }}
        {{ Form::text('name', $category->name, array('class'=>'form-control','placeholder'=>'123213','id'=>'name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', __('dashboard.description')) }}
        {{ Form::text('description', $category->description, array('class'=>'form-control','placeholder'=>'text...','id'=>'description')) }}
    </div>
    {{ Form::submit('Сохранить', array('class' => 'btn btn-primary')) }}
    {{Form::close()}}

@endsection
