@extends('layouts.app')

@section('app_content')
    @include('groups.filter')
    @include('blocks.pages.list', [
        'items' => [
            ['group' => '211', 'term' => '2'],
            ['group' => '111', 'term' => '1'],
            ['group' => '311', 'term' => '3'],
            ['group' => '411', 'term' => '4'],
        ],
    ])
@endsection
