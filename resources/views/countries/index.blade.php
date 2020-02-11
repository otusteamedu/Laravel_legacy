@extends('layouts.inner')

@section('title', __('admin.countries.index'))
@section('h1', __('admin.countries.index'))
<?php
$headers = [
    [
        'title' => __('admin.id'),
        'column' => 'id',
    ],
    [
        'title' => __('admin.countries.name'),
        'column' => 'name',
    ],
    [
        'title' => __('admin.created_at'),
        'column' => 'created_at',
    ],
];
?>
@section('content')
    <div class="container">
        @include('admin.blocks.actions',[
            'actions' => [
                'create',
            ],
            'entity_name' => [
                 's' => 'country',
                 'm' => 'countries',
            ],
        ])
        @include('blocks.list.table',[
            'entity_name' => [
                 's' => 'country',
                 'm' => 'countries',
            ],
            'headers' => $headers,
            'items' => $countries,
            'links' => [
                'show', 'edit'
            ],
        ])
    </div>
@endsection