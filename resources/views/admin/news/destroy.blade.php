@extends('layouts.admin')
@section('breadcrumbs', '')
@section('h1')
    Удаление новости №{{$news->id}}
@stop

@section("content")
    Новость c ID={{$news->id}} успешно удалена. <br>
    <a href="{{route('admin.articles.index')}}">Вернуться к списку</a>
@stop
