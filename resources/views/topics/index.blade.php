@extends('layouts.app')

@section('app_content')
    @include('topics.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'subject' => 'math',
                'title' => 'Test',
                'teacher' => 'Test',
                'topic type' => 'lecture',
            ],
        ],
    ])
@endsection
