
@extends('layouts.app')


@section('title', 'Админ-панель')

@section('content')

    @include('cms.blocks.header')

    @include('cms.messages.blocks.form.create')
    @include('cms.errors')

    @include('cms.messages.blocks.list')

@endsection
