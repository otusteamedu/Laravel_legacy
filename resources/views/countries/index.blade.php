@extends('layouts.layout')

@section('title', __('messages.countries'))

@section('content')

<div class="container">
    <h1>{{ $locale }}</h1>
    @php
        $breadcrumbs = [
            [
                'url' => '/',
                'title' => __('messages.home'),
            ],
            [
                'url' => route('cms.countries.index', ['locale' => $locale]),
                'title' => __('messages.countries'),
            ],
        ];
    @endphp
    @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
    @include('countries.blocks.header.list')
    @include('countries.blocks.list.index')
</div>
@endsection
