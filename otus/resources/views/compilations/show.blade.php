@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Compilation $compilation */?>
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="list-group">
                                <li class="list-group-item">id Подборки(selection_material) - {{$compilation->compilation->id}}</li>
                                <li class="list-group-item">id Материала - {{$compilation->material->id}}</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
