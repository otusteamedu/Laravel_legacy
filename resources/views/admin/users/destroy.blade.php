@extends('layouts.admin')
@section('breadcrumbs', '')
@section('h1')
    Удаление пользователя №{{$user->id}}
@stop

@section("content")
    Пользователь c ID={{$user->id}} успешно удален. <br>
    <a href="{{route('admin.users.index')}}">Вернуться к списку</a>
@stop
