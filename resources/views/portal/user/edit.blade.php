@extends('portal.layout')
@section('title', __('messages.user'))
@section('h1', __('messages.user'))
@section('content')
    <h1>@yield('h1')</h1>
    @include('portal.user.navigation.menu')
    @include('portal.user.form.edit')
@endsection