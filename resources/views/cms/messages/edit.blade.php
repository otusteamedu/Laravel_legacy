@extends('layouts.app')


@section('title', 'Админ-панель')

@section('content')

    @include('cms.blocks.header')

    @include('cms.messages.blocks.form.edit')
    @include('cms.errors')

@endsection
