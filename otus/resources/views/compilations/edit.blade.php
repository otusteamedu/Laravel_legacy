@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Favorite $favorite */?>
@section('content')
    {{ Form::open(
            [
                'url' => route('admin.compilations.update', ['compilation' => $compilation]),
                'method' => 'PUT'
            ]
         )
    }}

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

    <div class="form-group">

        {{Form::label('compilations', 'Подборка')}}
        {{Form::select('compilation_id',$arSelectionMaterials, $compilation->compilation->id, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{Form::label('materials', 'Материалы')}}
        {{Form::select('material_id', $arMaterials, $compilation->material->id,['class' => 'form-control'])}}
    </div>


    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
