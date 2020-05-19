@extends('layouts.app')

@section('app_content')
    @include('students.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'name' => 'Test',
                'student id' => 'xxx',
                'group' => '111',
                'term' => '1',
            ],
        ],
    ])
@endsection
