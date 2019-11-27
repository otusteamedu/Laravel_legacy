@extends('admin.layouts.admin')

@section('pageTitle', __('admin.movies.create'))

@section('pageTop')
    @php
        $pathNav = [
            [
                'url' => route('admin.index'),
                'title' => __('admin.home')
            ], [
                'url' => '#',
                'title' => __('admin.menu.movies.index')
            ], [
                'url' => route('admin.movies.index'),
                'title' => __('admin.menu.movies.movies')
            ], [
                'url' => '#',
                'title' => __('admin.create')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', [
        'breadCrumbs' => $pathNav
    ])
    @include('admin.elements.toppanel', ['title' => __('admin.movies.create')])
@endsection

@section('pageContent')
    {{ Form::open(['url' => route('admin.movies.create'), 'files' => 'true', 'method' => 'post']) }}
    @include('admin.movies.elements.fields')
    {{ Form::close() }}
@endsection

