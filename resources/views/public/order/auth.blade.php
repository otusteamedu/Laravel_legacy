@extends('public.order.layout')

@php
    $breadCrumbs = [
        [
            'url' => \route('public.start'),
            'title' => __('public.menu.home'),
        ], [
            'url' => \route('public.order.checkout'),
            'title' => __('public.menu.checkout'),
        ]
    ];
@endphp

@section('pageTitle')
    Бронирование мест. Контактная информация
@endsection

@section('pageHeader')
    Познакомимся?
@endsection

@section('pageContentMain')
    <div class="bg-primary d-inline-block text-white p-2">У нас два варианта</div>
    <br /><br />

    <div class="container-fluid order-block i-iblock">
        <div class="row">
            <div class="col-md-5 p-0">
                <h5><b>1. Вы уже бронировали онлайн</b></h5>
                <div style="background-color: #f2f2f2; padding: 10px 15px;">
                    Тогда <a href="{{ route('login', ['redirectTo' => route('public.order.checkout')]) }}" class="btn btn-success">войдите</a> на сайт
                    или <a href="{{ route('password.request') }}" class="btn btn-primary">вспомните пароль</a>
                </div>
            </div>
            <div class="col-md-1 p-0 text-center">

            </div>
            <div class="col-md-6 p-0">
                <h5><b>2. Я впервые на <span class="badge badge-primary">Go</span> в Кинчик</b></h5>

                {{ Form::open(['url' => route('public.order.register'), 'method' => 'post', 'style' => "background-color: #f2f2f2; padding: 10px 0;"]) }}
                <div class="my-2 text-center">
                    <b>Тогда заполните поля ниже и нажмите <span class="badge badge-primary">Продолжить</span></b>
                </div>
                <br />
                <div class="form-group row align-items-center">
                    <div class="col-sm-5 col-form-label">
                        {{ Form::label('name', __('public.account.yourname')) }}
                    </div>
                    <div class="col-sm-7">
                        {{ Form::text('register[name]', null, ['class' => 'form-control', 'id' => 'name']) }}
                        @error('name')
                        <div class="alert alert-danger small p-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <div class="col-sm-5 col-form-label">
                        {{ Form::label('surname', __('public.account.yoursur')) }}
                    </div>
                    <div class="col-sm-7">
                        {{ Form::text('register[surname]', null, ['class' => 'form-control', 'id' => 'surname']) }}
                        @error('surname')
                        <div class="alert alert-danger small p-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <div class="col-sm-5 col-form-label">
                        {{ Form::label('phone', __('public.account.phone')) }}
                    </div>
                    <div class="col-sm-7">
                        {{ Form::text('register[phone]', null, ['class' => 'form-control input-phone', 'placeholder' =>'(999) 999-99-99', 'id' => 'phone']) }}
                        <small>@lang('public.account.useforlogin')</small>
                        @error('phone')
                        <div class="alert alert-danger small p-1">{{ $message }}</div>
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
                            {{ Form::email('register[email]', null, ['class' => 'form-control', 'id' => 'email']) }}
                        </div>
                        <small>@lang('public.account.useforrestorenotify')</small>
                        @error('email')
                        <div class="alert alert-danger small p-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-5"></div>
                    <div class="col-sm-7">
                        <input class="btn btn-primary" type="submit" value="Продолжить">
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection
