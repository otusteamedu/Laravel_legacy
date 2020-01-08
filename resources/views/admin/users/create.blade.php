@extends('admin.layouts.admin')

@section('pageTitle', __('admin.users.create'))

@section('pageTop')
    @php
        $pathNav = [
            [
                'url' => route('admin.index'),
                'title' => __('admin.home')
            ], [
                'url' => '#',
                'title' => __('admin.menu.security.index')
            ], [
                'url' => route('admin.movies.index'),
                'title' => __('admin.menu.security.users')
            ], [
                'url' => '#',
                'title' => __('admin.create')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', [
        'breadCrumbs' => $pathNav
    ])
    @include('admin.elements.toppanel', ['title' => __('admin.users.create')])
@endsection

@section('pageContent')
    {{ Form::open(['url' => route('admin.users.create'), 'files' => 'true', 'method' => 'post']) }}
    @include('admin.users.elements.fields')
    {{ Form::close() }}
@endsection

