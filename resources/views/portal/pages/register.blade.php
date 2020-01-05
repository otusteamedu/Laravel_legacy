@extends('portal.layout')
@section('title', __('messages.register'))
@section('content')
    @include('portal.user.form.register')
@endsection