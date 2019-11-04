@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Review $review */?>
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">Пользователь - {{$review->user->name}}</li>
                            <li class="list-group-item">Материал - {{$review->material->name}}</li>
                            <li class="list-group-item">Отзыв - {{$review->review}}</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
