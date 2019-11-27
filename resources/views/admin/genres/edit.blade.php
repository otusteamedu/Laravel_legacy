@extends('admin.layouts.admin')

@section('pageTitle', __('admin.genres.edit'))

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
                'url' => route('admin.genres.index'),
                'title' => __('admin.menu.movies.genres')
            ], [
                'url' => '#',
                'title' => __('admin.edit')
            ]
        ];
    @endphp

    @include('admin.elements.breadcrumbs', [
        'breadCrumbs' => $pathNav
    ])
    @include('admin.elements.toppanel', ['title' => __('admin.genres.edit')])
@endsection

@section('pageContent')
    {{ Form::model($dataItem, ['url' => route('admin.genres.update', ['genre' => $dataItem]), 'method' => 'put']) }}

    <div class="form-group row align-items-center">
        <div class="col-sm-3 col-form-label">
            {{ Form::label('name', __('admin.name')) }} <span class="i-req">*</span>
        </div>
        <div class="col-sm-4">
            {{ Form::text('name', $dataItem->name, ['class' => 'form-control']) }}
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-3 col-form-label">
            {{ Form::label('description', __('admin.description')) }}
        </div>
        <div class="col-sm-4">
            {{ Form::textarea('description', $dataItem->description, ['class' => 'form-control', 'rows' => 5]) }}
            @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-3 col-form-label"></div>
        <div class="col-sm-4">
            {{ Form::submit(__('admin.genres.edit'), array('class' => 'btn btn-success')) }}
            <a href="{{ route('admin.genres.index') }}" class="btn btn-danger">@lang('admin.cancel')</a>
        </div>
    </div>
    {{ Form::close() }}
@endsection
