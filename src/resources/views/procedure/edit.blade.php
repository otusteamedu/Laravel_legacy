@extends('layouts.main')

@section('title', __('headers.business.edit'))

@section('header_button')
    <form action="{{ route('procedure.destroy', $procedure->id) }}" method="POST" class="d-inline">
        @csrf
        @method('DELETE')
        <button class="btn btn-outline-danger" title="Delete">
            <i class="fa fa-trash-alt"></i> {{ __('buttons.procedure.delete') }}
        </button>
    </form>
@stop

@section('content')

    @include('blocks._header')

    @include('procedure._form')

@stop
