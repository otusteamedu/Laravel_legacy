@extends('layouts.layout')

@section('title', __('messages.products'))

@section('content')

    <div class="container">

        @php
            $breadcrumbs = [
                [
                    'url' => '/',
                    'title' => __('messages.home'),
                ],
                [
                    'url' => '/cms/countries',
                    'title' => __('messages.countries'),
                ],
                [
                    'title' => __('messages.addCountry'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('countries.blocks.header.create')
        @include('countries.blocks.form.create')
    </div>
@endsection
