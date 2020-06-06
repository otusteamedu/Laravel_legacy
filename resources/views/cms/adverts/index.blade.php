
@extends('layouts.app')


@section('title', 'Админ-панель, объявления')

@section('content')

    @include('cms.blocks.header')

{{--    @include('cms.adverts.blocks.form.create')--}}
    <a href="/adverts/create" class="nav-link">Добавить объявление</a>

    @include('cms.adverts.blocks.list')

@endsection
