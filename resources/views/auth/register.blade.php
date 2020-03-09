@extends('layouts.app')
@section('breadcrumbs', '')
@section('h1')
    Регистрация
@stop

@section("content")
    @include('layouts.blocks.alerts.registration_form')
@stop
