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

        @if($episodes->count())
            @include('episodes.table')
        @else
            <p>@lang('episode.no_episodes')</p>
        @endif

    </div>
    {{ $episodes->links() }}


@endsection
