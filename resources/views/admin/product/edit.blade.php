@extends('admin.layout')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
        <h1 class="h2">{{__('dashboard.edit')}}</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                {{Form::open(['method'  => 'DELETE', 'route' => ['admin.product.destroy', 'product'=>$product->id,'locale'=>app()->getLocale()]])}}
{{--                <a class="btn btn-md btn-outline-secondary" href="{{ route('admin.category.destroy',[$category->id])}}" role="button">Delete</a>--}}
                    {{Form::submit('Delete', array('class' => 'btn btn-md btn-outline-secondary')) }}
                {{Form::close()}}
            </div>
        </div>
    </div>
    {{Form::model($product,['method'=>'PUT','route'=>['admin.product.update','product'=>$product,'locale'=>app()->getLocale()]])}}
    <div class="form-group">
        {{ Form::label('name', 'Name product') }}
        {{ Form::text('name', $product->name, array('class'=>'form-control','placeholder'=>'123213','id'=>'name')) }}
    </div>
    <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::text('description', $product->description, array('class'=>'form-control','placeholder'=>'text...','id'=>'description')) }}
    </div>
    <div class="form-group">
        {{ Form::label('price', 'Price') }}
        {{ Form::number('price', $product->price, array('class'=>'form-control','placeholder'=>'text...','id'=>'price')) }}
    </div>
    <div class="form-group">
        {{Form::label('category_id', 'Category')}}
        {{Form::select('category_id', $category, $product->category->id, array('class'=>'form-control','id'=>'category_id'))}}
    </div>
    {{ Form::submit('Сохранить', array('class' => 'btn btn-primary')) }}
    {{Form::close()}}

@endsection
