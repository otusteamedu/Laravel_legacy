
@extends('layouts.app')


@section('title', 'Админ-панель')

@section('content')

    @include('cms.blocks.header')

    @include('cms.towns.blocks.form.create')
    @include('cms.errors')

    @include('cms.towns.blocks.list')

@endsection
