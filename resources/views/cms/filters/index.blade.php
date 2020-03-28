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
                    'url' => route('cms.filters.index'),
                    'title' => __('messages.countries'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('cms.filters.blocks.header.list')
        @include('cms.filters.blocks.list.index')
    </div>
@endsection

