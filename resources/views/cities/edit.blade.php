@extends('layouts.layout')

@section('title', __('messages.cities'))

@section('content')

    <div class="container">

        @php
            $breadcrumbs = [
                [
                    'url' => '/',
                    'title' => __('messages.home'),
                ],
                [
                    'url' => '/countries',
                    'title' => __('messages.countries'),
                ],
                [
                    'url' => '/countries/create',
                    'title' => __('messages.addCity'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('cities.blocks.header.edit')
        @include('cities.blocks.form.edit')
    </div>
@endsection
