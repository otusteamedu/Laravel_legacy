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
                    'title' => __('messages.editCountry'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('countries.blocks.header.edit')
        @include('countries.blocks.form.edit')
    </div>
@endsection
