<h1>{{ Request::url() }}</h1>
@extends('layouts.layout_cms')

@section('title', __('messages.countries'))

@section('content')

    <div class="container">

        @php
            $breadcrumbs = [
                [
                    'url' => route('home'),
                    'title' => __('cms.home'),
                ],
                [
                    'url' => route('cms.filters.index'),
                    'title' => __('cms.filters.filters'),
                ],
            [
                    'url' => route('cms.filters.create'),
                    'title' => __('cms.create'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('blocks.alerts.errors_success')
{{--        @include('cms.filters.blocks.header.create')--}}
        @include('cms.filters.blocks.form.create')
    </div>
@endsection
