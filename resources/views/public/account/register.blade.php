@extends('public.account.layout')

@section('pageTitle', __('public.account.register'))

@section('pageHeader', __('public.account.register'))

@php
$breadCrumbs = [
    [
        'url' => \route('public.start'),
        'title' => __('public.menu.home'),
    ], [
        'url' => \route('public.account.index'),
        'title' => __('public.account.index'),
    ], [
        'url' => \route('public.account.register'),
        'title' => __('public.account.register'),
    ]
];
@endphp

@section('pageContentMain')
    {{ Form::open(['url' => route('public.account.register'), 'method' => 'post']) }}
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('name', __('public.account.yourname')) }} <span class="i-req">*</span>
        </div>
        <div class="col-sm-7">
            {{ Form::text('name', null, ['class' => 'form-control']) }}
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('surname', __('public.account.yoursur')) }}
        </div>
        <div class="col-sm-7">
            {{ Form::text('surname', null, ['class' => 'form-control']) }}
            @error('surname')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('phone', __('public.account.phone')) }}
        </div>
        <div class="col-sm-7">
            {{ Form::text('phone', null, ['class' => 'form-control input-phone', 'placeholder' =>'(999) 999-99-99']) }}
            <small>@lang('public.account.useforlogin')</small>
            @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('email', __('public.account.email')) }}
        </div>
        <div class="col-sm-7">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                </div>
                {{ Form::email('email', null, ['class' => 'form-control']) }}
            </div>
            <small>@lang('public.account.useforrestorenotify')</small>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('password', __('public.account.password')) }}
        </div>
        <div class="col-sm-7">
            {{ Form::password('password', ['class' => 'form-control']) }}
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('password2', __('public.account.password2')) }}
        </div>
        <div class="col-sm-7">
            {{ Form::password('password2', ['class' => 'form-control']) }}
            @error('password2')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('birth_day', __('public.account.sex')) }}
        </div>
        <div class="col-sm-7">
            <div class="form-check">
                {{ Form::radio('sex', null, true, ['id' => 'sex-none', 'class' => 'form-check-input']) }}
                {{ Form::label('sex-none', __('public.sex_opt.none'), ['class' => 'form-check-label']) }}
            </div>
            <div class="form-check">
                {{ Form::radio('sex', 'male', false, ['id' => 'sex-male', 'class' => 'form-check-input']) }}
                {{ Form::label('sex-male', __('public.sex_opt.male'), ['class' => 'form-check-label']) }}
            </div>
            <div class="form-check">
                {{ Form::radio('sex', 'female', false, ['id' => 'sex-female', 'class' => 'form-check-input']) }}
                {{ Form::label('sex-female', __('public.sex_opt.female'), ['class' => 'form-check-label']) }}
            </div>
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('birthday', __('public.account.birthday')) }}
        </div>
        <div class="col-sm-7">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                </div>
                {{ Form::text('birthday', null, ['class' => 'form-control']) }}
            </div>
            @error('birthday')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="form-group row align-items-center">
        <div class="col-sm-5 col-form-label">
            {{ Form::label('photo', __('public.account.photo')) }}
        </div>
        <div class="col-sm-7">
            <div class="">
                {{ Form::file('photo') }}
            </div>
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-5"></div>
        <div class="col-sm-7">
            <input class="btn btn-primary" type="submit" value="Отправить">
        </div>
    </div>
    <div class="form-group row">
        <div class="col-sm-5"></div>
        <div class="col-sm-7">
            <span class="i-req">*</span> &mdash; @lang('public.fieldsrequired')
        </div>
    </div>
    {{ Form::close() }}
@endsection
