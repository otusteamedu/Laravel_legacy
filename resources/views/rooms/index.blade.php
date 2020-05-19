@extends('layouts.app')

@section('app_content')
    @include('rooms.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'room' => '103',
                'date' => '2020-01-01',
                'time' => '8:00 - 10:35',
                'lesson' => 'math',
                'group' => '111',
            ],
        ],
    ])
@endsection
