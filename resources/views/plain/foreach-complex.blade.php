@extends('plain.layout')

@section('content')
    <h1>Foreach Complex </h1>
    @include('plain.blocks.nav.index')

    @php($newsList = [
        [
            'title' => '<b>Worlds fastest man</b> Coleman investigated over three alleged missed drugs tests',
            'url' => 'https://bbc.com/news-page',
            'tags' => [
                'breaking',
                'stub',
                'new',
                'hot',
            ],
        ],
        [
            'title' => '<i>Serena Williams</i> and Maria Sharapova before the 2015 Australian Open final',
            'url' => 'https://bbc.com/news-page',
            'tags' => [
                'Serena',
                'Sharapova',
                'ustralian Open final',
            ],
        ],
        [
            'title' => '3habout 3 hours agoFrom the section Cricket',
            'url' => 'https://bbc.com/news-page',
            'tags' => [],
        ],
    ])

    <h2>News: </h2>
    <ul>
        @foreach($newsList as $news)
            <li>
                {!! $news['title'] !!}
                Tags:
                @forelse($news['tags'] as $tag)
                    @if($loop->parent->first && $loop->first) <b>First</b> @endif
                    {{ $tag }}
                @empty
                    No Tags
                @endforelse
            </li>
        @endforeach
    </ul>
@endsection

