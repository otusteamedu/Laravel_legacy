@extends('layouts.app')

@section('app_content')
    @include('groups.filter')
    @include('blocks.pages.list', [
        'tableContent' => 'groups.table_content',
        'content' => [
            'titles' => $titles,
            'items' => $groups,
        ],
    ])

    @can(\App\Services\Helpers\Ability::CREATE, \App\Models\Group::class)
        <hr>
        @include('blocks.buttons.add', ['src' => route('groups.create')])
    @endcan
@endsection
