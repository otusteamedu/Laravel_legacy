<?php include(__DIR__ . '/../../../resources/views/demo..php') ?>
@extends('layouts.auth.index')
@section('content')
    {{Form::open(['class'=>'form-row'])}}
    <div class="col-12">
        {{Form::label('login', __('forms.auth.email'))}}
        {{Form::text('login', '', ['class'=>'form-control'])}}
    </div>
    <div class="col-12 mt-3">
        {{Form::label('password', __('forms.auth.password.value') )}}
        {{Form::text('password','', ['class'=>'form-control'])}}
    </div>
    <div class="col-12 mt-3">
        {{Form::submit(__('forms.auth.login'), ['class'=>'btn btn-primary btn-block'])}}
    </div>
    <div class="col-12 mt-3 text-right">
        <a class="text-success"
           href="{{route('cms.auth.registration.index')}}">{{ __('forms.auth.registration') }}</a>
    </div>
    {{Form::close()}}
@endsection
