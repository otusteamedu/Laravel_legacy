
@extends('layouts.app')


@section('title', 'Админ-панель')

@section('content')

    @include('cms.blocks.header')

    @include('cms.divisions.blocks.form.create')
    @include('cms.errors')

    @include('cms.divisions.blocks.list')

@endsection
