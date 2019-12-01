@extends('layouts.main')

@section('title', 'Страница книги ')

@section('content')
    <article class="title">@lang('messages.novelty')</article>

    @include('main_page.blocks.slider')

    <article class="title">@lang('messages.recommendations')</article>

    @include('main_page.blocks.recommendations')

@endsection
