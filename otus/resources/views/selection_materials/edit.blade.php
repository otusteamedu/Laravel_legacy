@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\SelectionMaterial $selectionMaterial */?>
@section('content')
    {{ Form::open(
            [
                'url' => route('admin.selection-materials.update', ['selectionMaterial' => $selectionMaterial]),
                'method' => 'PUT'
            ]
         )
    }}

    <div class="form-group">

        {{Form::label('name', 'Имя')}}
        {{Form::text('name', $selectionMaterial->name, ['class' => 'form-control'])}}
    </div>



    {{Form::submit('run')}}
    {{Form::close()}}
@endsection
