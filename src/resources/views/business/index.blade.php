@extends('layouts.main')

@section('title', __('headers.business.index'))

@can('accessBusinessPanel')
    @section('header_button')
        <button type="button" class="btn btn-outline-primary">{{ __('buttons.business.settings') }}</button>
    @stop
@endcan

@section('content')

    @include('blocks._header')

    <div class="border border-info">
        @include('business._constructor')
    </div>

@stop
