@extends('layouts.app')

@section('app_content')
    @include('lessons.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'teacher' => 'Test',
                'group' => '111',
                'subject' => 'math',
                'date' => '2020-01-01',
                'time' => '8:00 - 10:35',
                'room' => '103',
            ],
        ],
    ])
@endsection
