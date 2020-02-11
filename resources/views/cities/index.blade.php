@extends('layouts.inner')

@section('title', __('admin.cities.index'))
@section('h1', __('admin.cities.index'))
<?php
$headers = [
    [
        'title' => __('admin.id'),
        'column' => 'id',
    ],
    [
        'title' => __('admin.cities.name'),
        'column' => 'name',
    ],
    [
        'title' => __('admin.cities.country'),
        'column' => ['country', 'name'],
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
                 's' => 'city',
                 'm' => 'cities',
            ],
        ])
        @include('blocks.list.table',[
            'entity_name' => [
                 's' => 'city',
                 'm' => 'cities',
            ],
            'headers' => $headers,
            'items' => $cities,
            'links' => [
                'show', 'edit'
            ],
        ])
    </div>
@endsection