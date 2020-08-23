@extends('layouts.app')


@section('title', 'Доска объявлений')

@section('content')

    @include('home.blocks.header')
{{--    @include('layouts.breadcrumbs')--}}

    {{ Breadcrumbs::render('division', $division, $town_id) }}

    @include('home.blocks.card')

    @include('home.blocks.footer')


@endsection
