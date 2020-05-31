@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Автор: {{ $author->name }}</h3>
                </div>

                <div class="card-body">
                    @if($errors->count())
                        <div class="alert alert-danger errors">
                            @foreach($errors->toArray() as $error)
                                @foreach($error as $err)
                                    {{ $err }}
                                @endforeach
                            @endforeach
                        </div>
                    @endif

                    @include('cms.blog.author.components.form.edit')

                </div>
            </div>
        </div>
    </div>
@stop

@section('content')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
