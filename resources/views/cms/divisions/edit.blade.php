@extends('layouts.app')


@section('title', 'Админ-панель')

@section('content')

    @include('cms.blocks.header')

    @include('cms.divisions.blocks.form.edit')
    @include('cms.errors')

@endsection
