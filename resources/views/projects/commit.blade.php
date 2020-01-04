@extends('layouts.app')

@section('content')

    <div class="container">

        @include('projects.partials.view_header')

        @include('projects.partials.tabs')

        <h2 class="mt-5">{{ $commit->summary }}</h2>
        <p>{{ $commit->author }} @ {{ $commit->commit_datetime }}</p>
        <p class="text-black-50">SHA1: {{ $commit->hash }}</p>

        @if(!empty($insightsMetric))
            <div class="mt-5">
            @include('results.phpinsights.summary', $insightsMetric->getAttributes())
            </div>
        @endif

    </div>




@endsection
