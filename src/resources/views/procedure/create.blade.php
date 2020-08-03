@extends('layouts.main')

@section('title', __('headers.procedure.add'))

@section('content')

    @include('blocks._header')

    @include('procedure._form')

@stop
