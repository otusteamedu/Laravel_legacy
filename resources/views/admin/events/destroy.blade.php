@extends('layouts.admin')
@section('breadcrumbs', '')
@section('h1')
    Удаление события №{{$event->id}}
@stop

@section("content")
    Событие c ID={{$event->id}} успешно удалено. <br>
    <a href="{{route('admin.events.index')}}">Вернуться к списку</a>
@stop
