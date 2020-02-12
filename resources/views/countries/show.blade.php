@extends('layouts.inner')

@section('title', $country['name'])
@section('h1', $country['name'])
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
        'title' => __('admin.created_at'),
        'column' => 'created_at',
    ],
];
?>
@section('content')
    <div class="container">
        @include('admin.blocks.actions',[
            'actions' => [
                'destroy', 'edit',
            ],
            'entity_name' => [
                 's' => 'country',
                 'm' => 'countries',
            ],
            'entity' => $country,
        ])
        @include('blocks.list.table',[
            'entity_name' => [
                 's' => 'city',
                 'm' => 'cities',
            ],
            'headers' => $headers,
            'items' => $cities,
            'links' => [
            ],
        ])
    </div>
@endsection