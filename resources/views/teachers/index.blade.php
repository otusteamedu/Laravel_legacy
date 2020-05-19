@extends('layouts.app')

@section('app_content')
    @include('teachers.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'full name' => 'Test',
                'email' => '1@1.1',
                'login' => 'test',
                'subjects' => 'math, chemistry',
                'load' => '920',
            ],
        ],
    ])
@endsection
