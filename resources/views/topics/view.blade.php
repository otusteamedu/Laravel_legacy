@extends('layouts.app')

@section('app_content')
    <h4>@lang('scheduler.view'):</h4>

    @include('blocks.pages.view', [
        'items' => [
            __('scheduler.title') => 'Test',
            __('scheduler.type') => 'lecture',
            __('scheduler.annotation') => 'Test',
            __('scheduler.questions') => 'question1, question2',
            __('scheduler.text') => 'Test',
            __('scheduler.bibliography') => '1, 2',
        ],
    ])

    attachment.pdf <a href="#" type="button" class="btn btn-primary">@lang('buttons.download')</a>
    <hr>
@endsection
