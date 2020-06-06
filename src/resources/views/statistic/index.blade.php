@extends('layouts.main')

@section('title', __('headers.statistic.index'))

@section('content')

    @include('blocks._header')

    @include('statistic._small')

    @include('statistic._links')

@stop
