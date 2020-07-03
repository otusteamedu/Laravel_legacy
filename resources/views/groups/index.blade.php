@extends('layouts.app')

@section('app_content')
    @include('groups.filter')
    @include('blocks.pages.list', [
        'tableContent' => 'groups.table_content',
        'content' => [
            'titles' => $titles,
            'items' => $groups,
        ],
        'addRoute' => 'groups.create',
    ])
@endsection
