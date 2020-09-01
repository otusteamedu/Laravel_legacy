@extends('layouts.app')


@section('title', 'Личный кабинет')

@section('content')

    @include('home.blocks.header')
{{--        @include('layouts.breadcrumbs')--}}

    {{ Breadcrumbs::render('lk', $town_id) }}

    @include('home.lk.adverts_list')

    @include('home.blocks.footer')


@endsection
