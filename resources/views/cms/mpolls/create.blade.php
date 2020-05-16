@extends('layouts.layout_cms')

@section('title', __('messages.mpolls'))

@section('content')

    <div class="container">

        @php
            $breadcrumbs = [
                [
                    'url' => route('home'),
                    'title' => __('cms.home'),
                ],
                [
                    'url' => route('cms.mpolls.index'),
                    'title' => __('cms.mpolls'),
                ],
             [
                    'url' => route('cms.mpolls.edit', 1),
                    'title' => __('cms.mpolls'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
{{--        @include('cms.mpolls.blocks.header.edit')--}}
        @include('blocks.alerts.errors_success')
        @include('cms.mpolls.blocks.form.create')
    </div>
@endsection
