@extends('admin.layouts.main')

@section('title', 'Businesses')

@section('header_button')
    <a href="{{ route('admin.business.create') }}" class="btn btn-outline-success">
        <i class="fa fa-plus"></i> Add
    </a>
@stop

@section('content')

    @include('admin.blocks._header')

    @include('admin.business._table')

@stop
