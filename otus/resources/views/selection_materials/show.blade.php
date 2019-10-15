@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\SelectionMaterial $selectionMaterial */?>
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="list-group">
                                <li class="list-group-item">Имя - {{$selectionMaterial->name}}</li>
                                <li class="list-group-item">Дата создания - {{$selectionMaterial->created_at}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
