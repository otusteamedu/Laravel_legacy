@extends('layouts.main')

@section('title', __('headers.staff.index'))

@section('header_button')
    <button type="button" class="btn btn-outline-success">Добавить</button>
@stop

@section('content')

    @include('blocks._header')

    @include('staff._staff_table')

@stop
