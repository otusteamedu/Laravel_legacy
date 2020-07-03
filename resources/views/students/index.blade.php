@extends('layouts.app')

@section('app_content')
    @include('students.filter')
    @include('blocks.pages.list', [
        'tableContent' => 'students.table_content',
        'content' => [
            'titles' => $titles,
            'items' => $students,
            'groupService' => $groupService,
            'courseService' => $courseService,
        ],
    ])

    @can('create', \App\Models\Student::class)
        <hr>
        @include('blocks.buttons.add', ['src' => route('students.create')])
    @endcan
@endsection
