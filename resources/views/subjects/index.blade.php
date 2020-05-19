@extends('layouts.app')

@section('app_content')
    @include('subjects.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'group' => '111',
                'title' => 'Test',
                'teacher' => 'Test',
            ],
        ],
    ])
@endsection
