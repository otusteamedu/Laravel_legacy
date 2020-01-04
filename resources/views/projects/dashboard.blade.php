@extends('layouts.app')

@section('content')

    <div class="container">

        @include('projects.partials.view_header')

        @include('projects.partials.tabs')

        <div class="mt-5">
            @include('results.phpinsights.chart')
            @include('results.phploc.chart')
        </div>

    </div>


@endsection
