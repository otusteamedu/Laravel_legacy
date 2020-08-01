@extends('layouts.main')

@section('title', __('headers.index'))

@section('content')

    @include('blocks._header')

    @can('accessBusinessPanel')
        @include('records._records_table')

        @include('statistic._small')
    @else
        @include('business._empty')
    @endcan

@stop
