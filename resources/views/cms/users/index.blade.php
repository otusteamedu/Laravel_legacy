@extends('layouts.layout')

@section('title', __('messages.users'))

@section('content')

<div class="container">

    @php
        $breadcrumbs = [
            [
                'url' => '/',
                'title' => __('messages.home'),
            ],
            [
                'url' => App\Helpers\RouteBuilder::localeRoute('cms.users.index'),
                'title' => __('messages.users'),
            ],
        ];
    @endphp
    <h1>{{ $locale }}</h1>
    <h1>{{ $name }}</h1>
    @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
    @include('cms.users.blocks.header.list')

    @include('cms.blocks.form.messages')

    @include('cms.users.blocks.list.index')
</div>
@endsection
