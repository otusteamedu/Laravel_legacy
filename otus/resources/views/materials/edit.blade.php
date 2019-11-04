@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Material $material */?>
@section('content')
    {{ Form::open(
            [
                'url' => route('admin.materials.update', ['material' => $material]),
                'method' => 'PUT'
            ]
         )
    }}

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

    <div class="form-group">

        {{Form::label('name', 'Название')}}
        {{Form::text('name', $material->name, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('category', 'Категория')}}
        {{Form::select('category_id',$arCategories, $material->category_id, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('authors', 'Авторы')}}
        {{Form::select('authors_id', $arAuthors, $material->authors ,array('multiple'=>'multiple','name'=>'authors_id[]'))}}
    </div>

    <div class="form-group">

        {{Form::label('status', 'Статус')}}
        {{Form::select('status_id',$arStatuses, $material->status_id, ['class' => 'form-control'])}}
    </div>


    <div class="form-group">

        {{Form::label('file', 'Файл')}}
        {{Form::file('file', ['value' => $material->value, 'class' => 'form-control'])}}
    </div>

    <div class="form-group">

        {{Form::label('year_publishing', 'Год публикации')}}
        {{ Form::input('text', 'year_publishing', $material->year_publishing, ['id' => 'year_publishing', 'class' => 'form-control']) }}
    </div>

    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
