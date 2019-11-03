@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\user $user */?>
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="list-group">
                                <li class="list-group-item">Имя - {{$user->name}}</li>
                                <li class="list-group-item">Email - {{$user->email}}</li>
                                <li class="list-group-item">Фотография - <img src="{{ asset('storage/' . $user->photo) }}"></li>
                                <li class="list-group-item">Дата создания - {{$user->created_at}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
