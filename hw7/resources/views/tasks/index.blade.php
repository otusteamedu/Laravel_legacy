@extends('layouts.main')

@section('title', __('messages.tasks'))

@section('content')
    <div class="container">
        @php
            $breadcrumbs = [
                [
                    'url' => '/',
                    'title' => __('messages.home'),
                ],
                [
                    'url' => '/registration',
                    'title' =>  __('messages.tasks'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        <div class="row">
            <div class="col col-3">
                @include('tasks.sidebar.index', ['tasks' => $tasks])
            </div>
            <div class="col col-9">
                @include('tasks.list.index', ['tasks' => $tasks])
            </div>
        </div>
    </div>
@endsection