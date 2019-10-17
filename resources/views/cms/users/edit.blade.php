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
                    'url' => App\Helpers\RouteBuilder::localeRoute('cms.users.index'),
                    'title' => __('messages.users'),
                ],
                [
                    'title' => __('messages.editUser'),
                ],
            ];
        @endphp
        @include('blocks.breadcrumbs.index', ['breadcrumbs' => $breadcrumbs])
        @include('cms.users.blocks.header.edit')
        @include('cms.users.blocks.form.edit')
    </div>
@endsection
