@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.room') => 'Test',
            __('scheduler.date') => '2020-01-01',
            __('scheduler.lesson_time') => '8:00 - 10:35',
            __('scheduler.subject') => 'math',
            __('scheduler.consultation') => 'math',
            __('scheduler.group') => '111',
            __('scheduler.teacher') => 'Test',
        ],
    ])
@endsection
