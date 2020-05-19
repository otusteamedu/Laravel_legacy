@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.full_name') => 'Test',
            __('scheduler.email') => '1@1.1',
            __('scheduler.login') => 'team',
            __('scheduler.subjects') => 'math, chemistry',
            __('scheduler.teaching_load') => '920',
        ],
    ])
@endsection
