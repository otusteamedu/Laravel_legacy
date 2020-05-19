@extends('layouts.app')

@section('app_content')
    @include('posts.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'author' => 'Test',
                'title' => 'test',
                'date' => '2020-01-01',
                'status' => 'public',
                'groups' => '111, 211',
                'subjects' => 'math',
            ],
        ],
    ])
@endsection
