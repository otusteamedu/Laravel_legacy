@extends('admin.layouts.admin')

@section('pageTitle', __('admin.movies.edit'))

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
                'title' => __('admin.edit')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', [
        'breadCrumbs' => $pathNav
    ])
    @include('admin.elements.toppanel', ['title' => __('admin.movies.edit')])
@endsection

@section('pageContent')
    {{ Form::model($dataItem, ['url' => route('admin.movies.update', ['movie' => $dataItem]), 'method' => 'put']) }}

    @include('admin.movies.elements.fields')

    {{ Form::close() }}
@endsection
