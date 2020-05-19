@extends('layouts.app')

@section('app_content')
    @include('consultations.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'teacher' => 'Test',
                'subject' => 'math',
                'date' => '2020-01-01',
                'time' => '8:00 - 10:35',
                'room' => '103',
                'students' => '10',
            ],
        ],
    ])
@endsection
