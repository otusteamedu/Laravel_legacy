@extends('auth.layout')
@section('title', __('messages.register'))
@section('h1', __('messages.register'))
@section('content')
    @include('auth.form.errors')
    @include('auth.form.register')
@endsection