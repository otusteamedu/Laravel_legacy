@extends('layouts.main')

@section('title', __('headers.message.index'))

@section('content')

    @include('blocks._header')

    @include('message._form')

@stop
