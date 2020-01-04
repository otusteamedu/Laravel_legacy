@extends('layouts.app')

@section('content')
    <h1>
        @empty($run->href)
            {{ $run->url }}
        @else
            <a href="{{ $run->href }}" target="_blank">{{ $run->url }} <i class="small fa fa-external-link-alt"></i></a>
        @endempty
    </h1>

    @if(!empty($run->error_phpinsights))
        <div class="alert alert-danger" role="alert">
            {{ $run->error_phpinsights }}
        </div>
    @endif

    @if(!empty($insightsMetric))
        @include('results.phpinsights.summary', $insightsMetric->getAttributes())
    @endif

    @if(!empty($run->error_phploc))
        <div class="alert alert-danger" role="alert">
            {{ $run->error_phploc }}
        </div>
    @endif

    @include('results.phploc.chart')

@endsection
