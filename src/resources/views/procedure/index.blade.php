@extends('layouts.main')

@section('title', __('headers.procedure.index'))

@section('header_button')
    <a href="{{ route('procedure.create') }}" class="btn btn-outline-success">
        {{ __('buttons.procedure.add') }}
    </a>
@stop

@section('content')

    @include('blocks._header')

    @include('procedure._table')

@stop
