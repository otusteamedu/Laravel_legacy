@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Author $author */?>
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="list-group">
                                <li class="list-group-item">Имя - {{$author->name}}</li>
                                <li class="list-group-item">Фамилия - {{$author->surname}}</li>
                                <li class="list-group-item">Дата создания - {{$author->created_at}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
