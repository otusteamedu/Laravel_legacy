
@extends('layouts.app')


@section('title', 'Поиск')

@section('content')

    @include('home.blocks.header')

    {{ Breadcrumbs::render('search', $town_id, $text) }}

    @include('home.blocks.card')

    @include('home.blocks.footer')


@endsection
