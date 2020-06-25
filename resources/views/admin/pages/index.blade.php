@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1 class="m-0 text-dark">Dashboard</h1>
@stop

@section('content')

@include('admin.pages.blocks.header.list')
<div class="card">
    @include('admin.pages.blocks.list.index')
</div>

@stop
