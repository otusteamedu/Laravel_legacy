@extends('portal.layout')
@section('title', __('messages.user'))
@section('h1', __('messages.user'))
@section('content')
    <h1>@yield('h1')</h1>
    @include('portal.blocks.navigation.menu', [
        'items' => $userMenu->roots(),
        'class' => ''
    ])
    <div class="row">
        <div class="col-2 col-md-2 col-sm-2">Имя</div>
        <div class="col-6 col-md-6 col-sm-6">Алексей</div>
    </div>
    <div class="row">
        <div class="col-2 col-md-2 col-sm-2">E-mail</div>
        <div class="col-6 col-md-6 col-sm-6">elsukov.alexei@yandex.ru</div>
    </div>
@endsection