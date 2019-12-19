@extends('layouts.app')

@section('title', 'Page Title ')

<?php
$arCategories = $categories->mapWithKeys(static function ($category) {
    return [
        $category->id => $category->name
    ];
})->toArray();

$arAuthors = $authors->mapWithKeys(static function ( $author) {
    return [
        $author->id => $author->name
    ];
})->toArray();

$arStatuses = $statuses->mapWithKeys(static function ( $status) {
    return [
        $status->id => $status->name
    ];
})->toArray();
?>

@section('content')
    {{ Form::open(['url' => route('admin.materials.store')]) }}

    <div class="form-group">

        {{Form::label('name', 'Название')}}
        {{Form::text('name', null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('description', 'Описание')}}
        {{Form::text('description', null, ['class' => 'form-control'])}}
    </div>


    <div class="form-group">

        {{Form::label('category', 'Категория')}}
        {{Form::select('category_id',$arCategories, null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('authors', 'Авторы')}}
        {{Form::select('authors_id', $arAuthors, null,array('multiple'=>'multiple','name'=>'authors_id[]'))}}
    </div>

    <div class="form-group">

        {{Form::label('status', 'Статус')}}
        {{Form::select('status_id',$arStatuses, null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('type', 'Тип')}}
        {{Form::text('type', null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('формат', 'Формат')}}
        {{Form::text('format', null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('file', 'Файл')}}
        {{Form::file('file', null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('preview_image', 'Превью картинки')}}
        {{Form::file('preview_image', null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('year_publishing', 'Год публикации')}}
        {{ Form::input('text', 'year_publishing', null, ['id' => 'year_publishing', 'class' => 'form-control']) }}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
