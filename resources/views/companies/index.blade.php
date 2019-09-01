@extends('layouts.layout')

@section('title', __('messages.products'))

@section('content')

<div class="container">

    @php
        $breadcrumbs = [
            [
                'url' => '/',
                'title' => __('messages.home'),
            ],
            [
                'url' => '/companies',
                'title' => __('messages.companies'),
            ],
        ];
    @endphp
    @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
    @include('companies.blocks.header.list')
    @include('companies.blocks.list.index', ['companies' => $companies])
</div>
@endsection
