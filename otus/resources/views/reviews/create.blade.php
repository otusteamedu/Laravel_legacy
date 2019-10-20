@extends('layouts.app')

@section('title', 'Page Title ')

<?php


$arUsers = $users->mapWithKeys(static function ( $user) {
    return [
        $user->id => $user->name
    ];
})->toArray();

$arMaterials = $materials->mapWithKeys(static function ( $material) {
    return [
        $material->id => $material->name
    ];
})->toArray();
?>

@section('content')
    {{ Form::open(['url' => route('admin.reviews.store')]) }}


    <div class="form-group">

        {{Form::label('users', 'Пользователи')}}
        {{Form::select('user_id',$arUsers, null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('materials', 'Материалы')}}
        {{Form::select('material_id', $arMaterials, null,['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('review', 'Отзыв')}}
        {{Form::textarea('review', null,['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
