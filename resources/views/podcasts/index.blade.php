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
                    <h1 class="title">@lang('common.podcasts')</h1>
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

        @if($podcasts->count())
            @include('podcasts.table')
        @else
            <p>@lang('podcast.no_podcasts')</p>
        @endif

    </div>
    {{ $podcasts->links() }}


@endsection
