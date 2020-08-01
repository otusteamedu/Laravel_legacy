@extends('layouts.main')

@section('title', __('headers.business.add'))

@section('content')

    @include('blocks._header')

    @include('business._form')

@stop
