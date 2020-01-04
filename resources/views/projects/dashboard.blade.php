@extends('layouts.app')

@section('content')

    <div class="container">

        @include('projects.partials.view_header')

        @include('projects.partials.tabs')

        <form action="{{ route('projects.analyze', $project) }}" method="post" class="mt-4">
            @csrf
            <input type="submit" class="btn btn-primary" value="@lang('projects.analyze_button')" data-disable-with="@lang('projects.analyze_button_in_progress')">
        </form>

        @include('results.phpinsights.chart')
        @include('results.phploc.chart')

    </div>


@endsection
