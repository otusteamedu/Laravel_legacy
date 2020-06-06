@extends('layouts.main')

@section('title', __('headers.procedures.index'))

@section('header_button')
    <button type="button" class="btn btn-outline-success">Добавить</button>
@stop

@section('content')

    @include('blocks._header')

    @include('procedures._procedures_table')

@stop
