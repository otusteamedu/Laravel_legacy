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
              'title' => __('public.account.login'),
        ]
    ];
@endphp

@section('pageTitle', __('public.account.login'))

@section('pageHeader', __('public.account.login'))

@section('pageContentMain')

{{ Form::open(['url' => route('login'), 'method' => 'post']) }}
<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('email', __('public.account.email')) }}
    </div>
    <div class="col-sm-6">
        {{ Form::text('email', old('email', null), ['class' => 'form-control']) }}
        @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row align-items-center">
    <div class="col-sm-4 col-form-label">
        {{ Form::label('password', __('public.account.password')) }}
    </div>
    <div class="col-sm-6">
        {{ Form::password('password', ['class' => 'form-control']) }}
        @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="form-group row align-items-center">
    <div class="col-sm-4">
        <div class="form-check">
            {{ Form::checkbox('remember', old('remember', null), true, ['id' => 'remember', 'class' => 'form-check-input']) }}
            {{ Form::label('remember', __('public.account.remember'), ['class' => 'form-check-label']) }}
        </div>
    </div>
    <div class="col-sm-6">
        {{ Form::submit(__('public.account.login'), array('class' => 'btn btn-primary')) }}
    </div>
</div>

<div class="form-group row align-items-center">
    <div class="col-sm-10">
        @if (Route::has('public.account.register'))
            <div>
                <a class="btn btn-link" href="{{ route('public.account.register') }}">
                    {{ __('public.account.register') }}
                </a>
            </div>
        @endif
        @if (Route::has('password.request'))
            <div>
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('public.account.fogot') }}
                </a>
            </div>
        @endif
    </div>
</div>

{{ Form::close() }}

@endsection
