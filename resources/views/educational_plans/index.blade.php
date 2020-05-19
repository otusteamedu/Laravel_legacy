@extends('layouts.app')

@section('app_content')
    @include('educational_plans.filter')
    @include('blocks.pages.list', [
        'items' => [
            [
                'group' => '111',
                'subject - teacher' => 'math - Test, chemistry - Ivanov',
            ],
        ],
    ])
@endsection
