<?php
use App\Models\Podcast;
/** @var Podcast $podcast */
?>
@extends('layouts.app')

@section('content')
    <div class="content">
        <nav class="level">
            <div class="level-left">
                <div class="level-item">
                    <h1 class="title">@lang('podcast.list_h1')</h1>
                </div>
            </div>
            <div class="level-right">
                <div class="level-item">
                    <a class="button is-primary is-outlined"
                       href="{{ route('podcasts.create') }}"><i class="fa fa-plus"></i>&nbsp;@lang('podcast.create')</a>
                </div>
            </div>
        </nav>
        <h1 class="title"></h1>

        <table class="table">
            <thead>
            <tr>
                <th>@lang('Обложка')</th>
                <th>@lang('Название подкаста')</th>
                <th>@lang('Последний эпизод')</th>
            </tr>
            </thead>
            <tbody>
            @forelse($podcasts as $podcast)
                <tr>
                    <td>
                        <a href="{{ route('podcasts.edit', $podcast) }}">
                            @include('components.cover', ['url' => $podcast->coverUrl(), 'size' => 150])
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('podcasts.edit', $podcast) }}">{{ $podcast->name }}</a>
                    </td>
                    <td>
                        @if(!empty($podcast->latestEpisode))
                            № {{ $podcast->latestEpisode->no }}
                            {{ $podcast->latestEpisode->name }}
                        @else
                            <span class="has-text-grey-light">Нет эпизодов</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">
                        <span class="has-text-grey-light">Нет подкастов</span>
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    {{ $podcasts->links() }}


@endsection
