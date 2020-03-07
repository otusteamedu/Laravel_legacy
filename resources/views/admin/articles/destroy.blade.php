@extends('layouts.admin')
@section('breadcrumbs', '')
@section('h1')
    Удаление статьи №{{$article->id}}
@stop

@section("content")
    Статья c ID={{$article->id}} успешно удалена. <br>
    <a href="{{route('admin.articles.index')}}">Вернуться к списку</a>
@stop
