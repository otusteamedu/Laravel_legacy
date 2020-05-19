@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.author') => 'Test',
            __('scheduler.title') => 'test',
            __('scheduler.text') => 'text',
            __('scheduler.date') => '2020-01-01',
            __('scheduler.status') => 'public',
            __('scheduler.groups') => '111, 211',
            __('scheduler.subjects') => 'math',
        ],
    ])
@endsection
