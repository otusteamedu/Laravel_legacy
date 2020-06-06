@extends('layouts.main')

@section('title', __('headers.index'))

@section('content')

    @include('records._records_table')

    @include('statistic._small')

@stop
