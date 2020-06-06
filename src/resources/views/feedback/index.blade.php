@extends('layouts.main')

@section('title', __('headers.feedback.index'))

@section('content')

    @include('blocks._header')

    @include('feedback._form')

@stop
