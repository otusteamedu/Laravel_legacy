<h1>{{ Request::url() }}</h1>
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
                    'url' => route('cms.mpolls.index'),
                    'title' => __('messages.mpolls'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        {{ link_to_route('cms.mpolls.create', $title = 'Create new', $parameters = [], $attributes = ['class' =>'btn btn-primary mb-3']) }}
{{--        @include('cms.filters.mpolls.header.list')--}}
        @include('cms.mpolls.blocks.list.index')
    </div>
@endsection

