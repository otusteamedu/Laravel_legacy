@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.group') => '111',
            __('scheduler.subjects_teachers') => ' chemistry - Ivanov',
        ],
    ])
@endsection
