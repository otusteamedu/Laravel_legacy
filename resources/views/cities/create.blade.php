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
                    'url' => '/companies',
                    'title' => __('messages.countries'),
                ],
                [
                    'url' => '/cities/create',
                    'title' => __('messages.addCity'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('cities.blocks.header.create')
        @include('cities.blocks.form.create')
    </div>
@endsection
