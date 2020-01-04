@extends('layouts.app')

@section('content')

    <div class="container">

        @include('projects.partials.view_header')

        @include('projects.partials.tabs')


        <table class="table mt-5">
            <thead>
            <tr>
                <th>Summary</th>
                <th>Lines of Code</th>
                <th>@lang('phpinsights.code')</th>
                <th>@lang('phpinsights.complexity')</th>
                <th>@lang('phpinsights.architecture')</th>
                <th>@lang('phpinsights.style')</th>
                <th>@lang('phpinsights.security_issues')</th>
            </tr>
            </thead>
            <tbody>
            @foreach($commits as $commit)
                <tr>
                    <td>
                        <a href="{{ route('projects.commit', [$project, $commit->hash]) }}">{{ $commit->summary }}</a>
                        <div
                            title="{{ $commit->commit_datetime }}">{{ $commit->author }} {{ $commit->commit_datetime->diffForHumans() }}</div>
                        <div class="text-black-50">{{ $commit->hash }}</div>
                    </td>
                    <td class="text-center">
                        {{ $commit->locMetrics[0]['loc'] ?? '' }}
                    </td>
                    @include('projects.partials.commits_table_cell_insights', ['value' => $commit->insightsMetrics[0]['code'] ?? ''])
                    @include('projects.partials.commits_table_cell_insights', ['value' => $commit->insightsMetrics[0]['complexity'] ?? ''])
                    @include('projects.partials.commits_table_cell_insights', ['value' => $commit->insightsMetrics[0]['architecture'] ?? ''])
                    @include('projects.partials.commits_table_cell_insights', ['value' => $commit->insightsMetrics[0]['style'] ?? ''])
                    <td class="text-center @if($commit->insightsMetrics[0]['security_issues'] ?? 0) text-danger @else text-black-50 @endif">
                        {{ $commit->insightsMetrics[0]['security_issues'] ?? '' }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $commits->links() }}

    </div>



@endsection
