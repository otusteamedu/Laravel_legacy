@extends('layouts.layout_cms')

@section('title', __('messages.countries'))

@section('content')

    <div class="container">

        @php
            $breadcrumbs = [
                [
                    'url' => route('home'),
                    'title' => __('messages.home'),
                ],
                [
                    'url' => route('cms.filters.index'),
                    'title' => __('cms.filters.filters'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])

        {{ link_to_route('cms.filters.create', $title = 'Create new', $parameters = [], $attributes = ['class' =>'btn btn-primary mb-3']) }}



        @include('blocks.alerts.errors_success')
        {{--        @include('cms.filters.blocks.header.list')--}}
        @include('cms.filters.blocks.list.index')
    </div>
@endsection

