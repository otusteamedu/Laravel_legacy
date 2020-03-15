@extends('portal.layout')
@section('title', __('messages.user'))
@section('h1', __('messages.user'))
@section('content')
    <h1>@yield('h1')</h1>
    @include('portal.blocks.navigation.menu', [
        'items' => $userMenu->roots(),
        'class' => ''
    ])
    @include('portal.user.form.edit')
@endsection