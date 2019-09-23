@extends('admin.layouts.admin')

@section('pageTitle', __('admin.countries.create'))

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
                'url' => route('admin.countries.index'),
                'title' => __('admin.menu.movies.countries')
            ], [
                'url' => '#',
                'title' => __('admin.create')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', [
        'breadCrumbs' => $pathNav
    ])
    @include('admin.elements.toppanel', ['title' => __('admin.countries.create')])
@endsection

@section('pageContent')
    {{ Form::open(['url' => route('admin.countries.index')]) }}

    <div class="form-group row align-items-center">
        <div class="col-sm-3 col-form-label">
            {{ Form::label('name', __('admin.name')) }} <span class="i-req">*</span>
        </div>
        <div class="col-sm-4">
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="form-group row align-items-center">
        <div class="col-sm-3 col-form-label"></div>
        <div class="col-sm-4">
            {{ Form::submit(__('admin.countries.create'), array('class' => 'btn btn-success')) }}
            <a href="{{ route('admin.countries.index') }}" class="btn btn-danger">@lang('admin.cancel')</a>
        </div>
    </div>
    {{ Form::close() }}
@endsection
