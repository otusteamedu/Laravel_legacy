{{--<h1>{{ Request::url() }}</h1>--}}
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
                    'url' => route('cms.filters.index'),
                    'title' => __('cms.filters.filters'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('blocks.alerts.errors_success')
        {{--        @include('cms.filters.blocks.header.edit')--}}
        @include('cms.filters.blocks.form.edit')
    </div>
@endsection
