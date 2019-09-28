<table class="table">
    <thead>
    <tr>
        <th>@lang('common.cover')</th>
        <th>@lang('podcast.name.label')</th>
        <th>@lang('podcast.latest_episode')</th>
    </tr>
    </thead>
    <tbody>
    @foreach($podcasts as $podcast)
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
                    <span class="has-text-grey-light">@lang('episode.no_episodes')</span>
                @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
