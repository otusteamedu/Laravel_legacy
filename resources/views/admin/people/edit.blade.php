@extends('admin.layouts.admin')

@section('pageTitle', __('admin.people.edit'))

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
                'title' => __('admin.edit')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', [
        'breadCrumbs' => $pathNav
    ])
    @include('admin.elements.toppanel', ['title' => __('admin.people.edit')])
@endsection

@section('pageContent')
    {{ Form::model($dataItem, ['url' => route('admin.people.update', ['person' => $dataItem]), 'method' => 'put']) }}

    @include('admin.people.elements.fields')

    {{ Form::close() }}
@endsection
