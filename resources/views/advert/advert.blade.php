@extends('layouts.app')


@section('title', 'Объявление')

@section('content')

    @include('home.blocks.header')
    @include('layouts.breadcrumbs')

    @include('advert.blocks.main')

    @include('home.blocks.footer')


@endsection
