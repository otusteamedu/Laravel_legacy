<?php
use App\Models\Episode;
/** @var Episode $episode */
?>
@extends('layouts.app')

@section('content')
    <div class="content">
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <h1 class="title">@lang('common.episodes')</h1>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <a class="button is-primary is-outlined"
                       href="{{ route('episodes.create') }}"><i class="fa fa-plus"></i>&nbsp;@lang('episode.create')</a>
                </div>
            </div>
        </nav>
        <h1 class="title"></h1>

        <table class="table">
            <thead>
            <tr>
                <th>@lang('common.cover')</th>
                <th>@lang('episode.podcast_id.label')</th>
                <th>@lang('episode.no.label')</th>
                <th>@lang('episode.name.label')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($episodes as $episode)
                <tr>
                    <td>
                        <a href="{{ route('episodes.edit', $episode) }}">
                            @include('components.cover', ['url' => $episode->coverUrl(), 'size' => 150])
                        </a>
                    </td>
                    <td>
                        {{ $episode->podcast->name }}
                    </td>
                    <td>
                        {{ $episode->no }}
                    </td>
                    <td>
                        <a href="{{ route('episodes.edit', $episode) }}">{{ $episode->name }}</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <span class="has-text-grey-light">@lang('episode.no_episodes')</span>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $episodes->links() }}


@endsection
