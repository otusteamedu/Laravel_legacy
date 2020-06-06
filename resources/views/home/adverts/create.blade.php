@extends('layouts.app')


@section('title', 'Доска объявлений')

@section('content')

    @include('home.blocks.header')
    @include('layouts.breadcrumbs')

    @include('home.adverts.blocks.form.create')

    @include('home.blocks.footer')


@endsection
