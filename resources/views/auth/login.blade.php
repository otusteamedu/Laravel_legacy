@extends('auth.layout')
@section('title', __('messages.auth'))
@section('h1', __('messages.auth'))
@section('content')
    @include('auth.form.errors')
    @include('auth.form.login')
@endsection