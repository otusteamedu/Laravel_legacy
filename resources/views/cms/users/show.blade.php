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
                    'url' => route('cms.users.index'),
                    'title' => __('messages.users'),
                ],
                [
                    'title' => $user->name,
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('cms.users.blocks.header.show', ['user' => $user])
    </div>
@endsection
