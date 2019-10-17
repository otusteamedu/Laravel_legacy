@extends('layouts.layout')

@section('title', __('messages.countries'))

@section('content')

<div class="container">

    @php
        $breadcrumbs = [
            [
                'url' => '/',
                'title' => __('messages.home'),
            ],
            [
                'url' => App\Helpers\RouteBuilder::localeRoute('cms.cities.index'),
                'title' => __('messages.cities'),
            ],
        ];
    @endphp
    @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
    @include('cities.blocks.header.list')

</div>
@endsection
