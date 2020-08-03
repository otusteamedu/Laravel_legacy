@extends('layouts.main')

@section('title', __('headers.business.edit'))

@section('header_button')
    <form action="{{ route('business.destroy', $business->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger" title="Delete">
            <i class="fa fa-trash-alt"></i> {{ __('buttons.business.delete') }}
        </button>
    </form>
@stop

@section('content')

    @include('blocks._header')

    @include('business._form')

@stop
