@extends('layouts.app')

@section('title', 'Page Edit ')

<?php /** @var \App\Models\Material $material */?>
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-primary">
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">Имя - {{$material->name}}</li>
                            <li class="list-group-item">Категория - {{$material->category->name}}</li>
                            <ul class="list-group">Авторы:
                            @foreach ($material->authors as $author)
                                    <li class="list-group-item">{{$author->name}}</li>

                                @endforeach
                            </ul><br/>
                            <li class="list-group-item">Статус - {{$material->status->name}}</li>
                            <li class="list-group-item">Год публикации - {{$material->year_publishing}}</li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
