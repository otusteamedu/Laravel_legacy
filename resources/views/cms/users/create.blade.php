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
                [
                    'title' => __('messages.addUser'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('cms.users.blocks.header.create')
        @include('cms.users.blocks.form.create')
    </div>
@endsection
