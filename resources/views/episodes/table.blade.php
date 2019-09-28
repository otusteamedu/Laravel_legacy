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
    @foreach($episodes as $episode)
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
    @endforeach
    </tbody>
</table>
