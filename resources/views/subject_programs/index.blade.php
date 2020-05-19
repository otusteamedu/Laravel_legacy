@extends('layouts.app')

@section('app_content')
    @include('subject_programs.filter')
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
