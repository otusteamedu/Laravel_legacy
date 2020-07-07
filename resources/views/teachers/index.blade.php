@extends('layouts.app')

@section('app_content')
    @include('teachers.filter')

    @include('blocks.pages.list', [
        'tableContent' => 'teachers.table_content',
        'content' => [
            'titles' => $titles,
            'items' => $teachers,
            'subjectService' => $subjectService,
            'educationPlanService' => $educationPlanService,
        ],
    ])

    @can(\App\Services\Helpers\Ability::CREATE_TEACHER)
        <hr>
        @include('blocks.buttons.add', ['src' => route('teachers.create')])
    @endcan
@endsection
