@extends('admin.layouts.admin')

@section('pageTitle', __('admin.people.create'))

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
                'url' => route('admin.people.index'),
                'title' => __('admin.menu.movies.people')
            ], [
                'url' => '#',
                'title' => __('admin.create')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', [
        'breadCrumbs' => $pathNav
    ])
    @include('admin.elements.toppanel', ['title' => __('admin.people.create')])
@endsection

@section('pageContent')
    {{ Form::open(['url' => route('admin.people.index'), 'files' => 'true']) }}
    @include('admin.people.elements.fields')
    {{ Form::close() }}
@endsection

