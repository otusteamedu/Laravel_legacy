@extends('public.account.layout')

@php
    $breadCrumbs = [
        [
            'url' => route('public.start'),
            'title' => __('public.menu.home'),
        ], [
             'url' => \route('public.account.index'),
             'title' => __('public.account.index'),
        ], [
              'url' => \route('login'),
              'title' => __('public.account.reset'),
        ]
    ];
@endphp

@section('pageTitle', __('public.account.reset'))

@section('pageHeader', __('public.account.reset'))

@section('pageContentMain')

    {{ Form::open(['url' => route('password.email'), 'method' => 'post']) }}

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('email', __('public.account.email')) }}
        </div>
        <div class="col-sm-7">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                {{ Form::email('email', old('email', null), ['class' => 'form-control']) }}
            </div>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-5"></div>
        <div class="col-sm-7">
            <input class="btn btn-primary" type="submit" value="@lang('public.account.reset_button')">
        </div>
    </div>
    {{ Form::close() }}
@endsection
