@extends('layouts.app')

@section('app_content')
    @include('posts.filter')
    @include('blocks.pages.list', [
        'tableContent' => 'posts.table_content',
        'content' => [
            'titles' => $titles,
            'items' => $posts,
        ],
    ])

    @can(\App\Services\Helpers\Ability::CREATE, \App\Models\Post::class)
        <hr>
        @include('blocks.buttons.add', ['src' => route('posts.create')])
    @endcan
@endsection
