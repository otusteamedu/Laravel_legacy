@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Статьи</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Стаьи</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col" style="margin-bottom: 15px;">
                    <a href="{{ route('cms.blog.author.create') }}" class="btn btn-primary">Добавить</a>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Название</th>
                            <th>Редактировать</th>
                            <th>Удалить</th>
                        </tr>
                        </thead>
                        @foreach ($authors as $author)
                            <tr>
                                <td>{{ $author->id }}</td>
                                <td>{{ $author->name }}</td>
                                <td>
                                    <a href="{{ route('cms.blog.author.delete', $author->id) }}" class="btn btn-danger">Удалить</a>
                                </td>
                                <td>
                                    <a href="{{ route('cms.blog.author.edit', ['author' => $author->id]) }}" class="btn btn-primary">Редактировать</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12 col-md-5">
                    <div class="dataTables_info" id="example1_info" role="status" aria-live="polite">Показано {{  $authors->count() }} элементов из {{  $authors->total() }}</div>
                </div>
                <div class="col-sm-12 col-md-7">
                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
                        {{ $authors->links() }}
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
