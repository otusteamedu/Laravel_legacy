
@extends('layouts.app')


@section('title', 'Доска объявлений')

@section('content')

    @include('home.blocks.header')
{{--    @include('layouts.breadcrumbs')--}}

    {{ Breadcrumbs::render('advert', $advert) }}

    @include('cms.adverts.blocks.item')

    @include('home.blocks.footer')


@endsection
