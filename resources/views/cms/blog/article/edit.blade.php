@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>{{ $article->name }}</h1>
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Quick Example</h3>
                </div>
                {!! Form::model($article, array('url' => route('cms.blog.article.store', [ 'article' => $article ]), 'method' => 'post')) !!}
                <div class="card-body">
                    <div class="form-group">
                        @if($article->preview_picture_id)
                            <img src="" alt="">
                        @endif
                        {!! Form::label('Картинка для анонса'); !!}
                        {!! Form::file('preview_picture_id', ['class' => 'form-control-file']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Наименование'); !!}
                        {!! Form::text('name', $article->name, ['class' => 'form-control']); !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('Текст'); !!}
                        {!! Form::textarea('text', $article->text, ['class' => 'form-control', 'aria-describedby' => '']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('Автор'); !!}
                        {!! Form::select('author', $authors, ['class' => 'form-control']); !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit(trans('Сохранить'), array('class' => 'btn btn-success')) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('content')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
