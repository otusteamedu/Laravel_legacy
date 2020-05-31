@extends('layouts.app')


@section('title', 'Админ-панель')

@section('content')

    @include('cms.blocks.header')

    @include('cms.towns.blocks.item')

@endsection
