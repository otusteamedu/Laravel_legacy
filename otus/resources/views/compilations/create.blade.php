@extends('layouts.app')

@section('title', 'Page Title ')

<?php


$arSelectionMaterials = $selectionMaterials->mapWithKeys(static function ( $selectionMaterial) {
    return [
        $selectionMaterial->id => $selectionMaterial->name
    ];
})->toArray();

$arMaterials = $materials->mapWithKeys(static function ( $material) {
    return [
        $material->id => $material->name
    ];
})->toArray();
?>

@section('content')
    {{ Form::open(['url' => route('admin.compilations.store')]) }}


    <div class="form-group">

        {{Form::label('compilation_id', 'Подборка')}}
        {{Form::select('compilation_id',$arSelectionMaterials, null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('materials', 'Материалы')}}
        {{Form::select('material_id', $arMaterials, null,['class' => 'form-control'])}}
    </div>



    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
