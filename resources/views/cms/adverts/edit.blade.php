@extends('layouts.app')


@section('title', 'Админ-панель, объявления')

@section('content')

    @include('cms.blocks.header')

    @include('cms.adverts.blocks.form.edit')
    @include('cms.errors')

@endsection
