@extends('layouts.main')

@section('title', __('headers.records.history'))

@section('content')

    @include('blocks._header')

    <div class="row">
        <div class="col-md-8">
            @include('records._records_table')
        </div>
        <div class="col-md-4">
            <h5 class="mb-3 text-right">Часто посещаемые</h5>
            @include('statistic._your_popular_records')
        </div>
    </div>

@stop
