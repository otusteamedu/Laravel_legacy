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
                    'url' => route('cms.countries.index'),
                    'title' => __('messages.countries'),
                ],
                [
                    'url' => route('cms.countries.create'),
                    'title' => __('messages.addCountry'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('countries.blocks.header.show', ['country' => $country])
        @include('countries.blocks.cities-list.index', ['country' => $country, 'cities' => $cities])
    </div>
@endsection
