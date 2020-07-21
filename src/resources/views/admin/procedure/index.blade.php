@extends('admin.layouts.main')

@section('title', __('headers.procedures.index'))

@section('header_button')
    <a href="{{ route('admin.procedure.create') }}" class="btn btn-outline-success">
        <i class="fa fa-plus"></i> Add
    </a>
@stop

@section('content')

    @include('admin.blocks._header')

    @include('admin.procedure._table')

@stop
