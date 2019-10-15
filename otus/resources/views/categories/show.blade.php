@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var Category $category */?>use App\Models\Category;
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="list-group">
                                <li class="list-group-item">Название - {{$category->name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
