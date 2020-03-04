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
        {{Form::label('password_confirmation', __('forms.auth.password.confirmation') )}}
        {{Form::text('password_confirmation','', ['class'=>'form-control'])}}
    </div>
    <div class="col-12 mt-3">
        {{Form::submit(__('forms.auth.registration'), ['class'=>'btn btn-primary btn-block'])}}
    </div>
    {{Form::close()}}
@endsection
