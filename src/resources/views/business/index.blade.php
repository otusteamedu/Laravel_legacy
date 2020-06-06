@extends('layouts.main')

@section('title', __('headers.business.index'))

@section('header_button')
    <button type="button" class="btn btn-outline-primary">Настройки</button>
@stop

@section('content')

    @include('blocks._header')

    <div class="border border-info">
        @include('business._constructor')
    </div>

@stop
