<div class="columns">
    <div class="column">
        {{ Form::bulmaText('name', 'episode.name', ['required']) }}
        {{ Form::bulmaSelect('podcast_id', 'episode.podcast_id', $podcasts, ['required']) }}
        {{ Form::bulmaTextarea('show_notes', 'episode.show_notes') }}
        {{ Form::bulmaNumber('season', 'episode.season') }}
        {{ Form::bulmaNumber('no', 'episode.no') }}

    </div>
    <div class="column">
        @include('components.cover', ['url' => $episode->coverUrl(), 'size' => 300])
        <div class="has-text-grey is-size-7">@lang('common.cover_recomendations')</div>
        {{ Form::bulmaFile('cover', 'common.cover_upload') }}
    </div>
</div>
