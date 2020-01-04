@extends('portal.layout')
@section('title', __('messages.auth'))
@section('content')
    @include('portal.user.form.auth')
@endsection